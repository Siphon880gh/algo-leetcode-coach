#!/usr/bin/env python3
"""Refresh the LeetCode number -> URL and difficulty maps from the public GraphQL problem list.

No login, no cookies. Pages through `questionList` at https://leetcode.com/graphql and writes
  context-leetcode-urls/data-cleaned.json      problem number -> https://leetcode.com/problems/{slug}
  context-leetcode-urls/data-difficulty.json   problem number -> Easy | Med | Hard

Usage (repo root):
  python3 .agents/skills/update-leetcode-urls/scripts/fetch_list.py            # full refresh
  python3 .agents/skills/update-leetcode-urls/scripts/fetch_list.py --dry-run  # report only
  python3 .agents/skills/update-leetcode-urls/scripts/fetch_list.py --premium  # also list paid-only numbers above the old max

Existing entries are kept. A number whose URL changes is reported and the script stops
without writing (stop-and-ask). Fewer rows than the reported total also stops without writing.
"""
from __future__ import annotations

import json
import sys
import time
import urllib.request
from pathlib import Path

ENDPOINT = "https://leetcode.com/graphql"
QUERY = (
    "query q($skip:Int,$limit:Int){questionList(categorySlug:\"\",limit:$limit,skip:$skip,filters:{})"
    "{totalNum data{questionFrontendId titleSlug difficulty isPaidOnly}}}"
)
PAGE = 100  # the endpoint caps a page at 100 rows
DELAY = 1.2  # seconds between requests (polite)
DIFF_LABEL = {"easy": "Easy", "medium": "Med", "hard": "Hard"}


def repo_root() -> Path:
    here = Path(__file__).resolve()
    for parent in here.parents:
        if (parent / "context-leetcode-urls").is_dir() and (parent / "includes" / "content.php").is_file():
            return parent
    return Path.cwd()


def post(skip: int, limit: int) -> dict:
    body = json.dumps({"query": QUERY, "variables": {"skip": skip, "limit": limit}}).encode()
    req = urllib.request.Request(ENDPOINT, data=body, headers={
        "Content-Type": "application/json",
        "Referer": "https://leetcode.com/problemset/",
        "User-Agent": "Mozilla/5.0 (Macintosh) leetcode-coach-local/1.0",
    })
    for attempt in range(4):
        try:
            with urllib.request.urlopen(req, timeout=60) as r:
                data = json.loads(r.read().decode())
            ql = (data.get("data") or {}).get("questionList")
            if ql is None:
                raise RuntimeError(f"no questionList in response: {str(data)[:200]}")
            return ql
        except Exception as e:  # back off and retry
            wait = DELAY * (4 ** attempt)
            print(f"skip={skip} error {e!r}; retry in {wait:.0f}s", file=sys.stderr, flush=True)
            time.sleep(wait)
    raise SystemExit(f"giving up at skip={skip}")


def load(path: Path) -> dict[int, str]:
    if not path.is_file():
        return {}
    return {int(k): v for k, v in json.loads(path.read_text(encoding="utf-8")).items()}


def main(argv: list[str]) -> int:
    dry = "--dry-run" in argv
    root = repo_root()
    dest = root / "context-leetcode-urls" / "data-cleaned.json"
    dest_diff = root / "context-leetcode-urls" / "data-difficulty.json"
    urls, diffs = load(dest), load(dest_diff)
    old_max = max(urls) if urls else 0

    rows, skip, total = [], 0, None
    while total is None or skip < total:
        ql = post(skip, PAGE)
        total = int(ql["totalNum"])
        batch = ql.get("data") or []
        if not batch:
            break
        rows.extend(batch)
        skip += len(batch)
        print(f"fetched {len(rows)}/{total}", flush=True)
        time.sleep(DELAY)

    if total is None or len(rows) < total:
        print(f"only {len(rows)} of {total} rows; not writing", file=sys.stderr)
        return 1

    conflicts, added, paid_new = [], [], []
    new_urls, new_diffs = dict(urls), dict(diffs)
    for q in rows:
        fid = str(q.get("questionFrontendId") or "")
        if not fid.isdigit():
            continue  # non-numbered entries (e.g. LCP/LCR) are not in the map
        n = int(fid)
        url = "https://leetcode.com/problems/" + q["titleSlug"]
        if n in new_urls and new_urls[n] != url:
            conflicts.append(f"{n}: {new_urls[n]} vs {url}")
            continue
        if n not in new_urls:
            added.append(n)
            if q.get("isPaidOnly"):
                paid_new.append(n)
        new_urls[n] = url
        label = DIFF_LABEL.get(str(q.get("difficulty") or "").lower())
        if label:
            new_diffs[n] = label

    if conflicts:
        print("conflicting URLs for the same problem number (stop and ask):", file=sys.stderr)
        for line in conflicts[:20]:
            print(f"  {line}", file=sys.stderr)
        return 1

    print(f"total {total} rows {len(rows)} map {len(new_urls)} old_max {old_max} new_max {max(new_urls)}")
    print(f"added {len(added)} {added[:5]}{'…' if len(added) > 5 else ''}")
    print(f"paid_only among added {paid_new}")
    missing = [n for n in range(1, max(new_urls) + 1) if n not in new_urls]
    print(f"gaps {len(missing)} {missing[:20]}")
    if dry:
        print("dry run: nothing written")
        return 0

    dest.write_text(json.dumps({str(k): new_urls[k] for k in sorted(new_urls)}, indent=2, ensure_ascii=False) + "\n", encoding="utf-8")
    dest_diff.write_text(json.dumps({str(k): new_diffs[k] for k in sorted(new_diffs)}, indent=2, ensure_ascii=False) + "\n", encoding="utf-8")
    print(f"wrote {dest}\nwrote {dest_diff}")
    print(f"1 {new_urls.get(1)} {new_diffs.get(1)}")
    return 0


if __name__ == "__main__":
    raise SystemExit(main(sys.argv[1:]))
