#!/usr/bin/env python3
"""Fetch LeetCode problem statements for every guide/session in content/ (or given numbers).

Raw GraphQL responses are cached in context/leetcode-problems/{n}.json (gitignored).
Usage:
  python3 .agents/skills/fetch-leetcode-problems/scripts/fetch.py            # all content pages
  python3 .agents/skills/fetch-leetcode-problems/scripts/fetch.py 1 2 560   # specific numbers
  --refresh   refetch even if cached
"""
import json, os, re, subprocess, sys, time, urllib.request

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '../../../..'))
CACHE = os.path.join(ROOT, 'context', 'leetcode-problems')
URLS = os.path.join(ROOT, 'context-leetcode-urls', 'data-cleaned.json')
QUERY = ('query q($titleSlug:String!){question(titleSlug:$titleSlug){'
         'questionId questionFrontendId title titleSlug content isPaidOnly exampleTestcases}}')
DELAY = 1.2  # seconds between requests (polite)


def content_numbers():
    nums = set()
    for typ in ('guides', 'coaching'):
        base = os.path.join(ROOT, 'content', typ)
        for slug in os.listdir(base):
            meta = os.path.join(base, slug, 'meta.php')
            if not os.path.isfile(meta):
                continue
            m = re.search(r"'leetcode'\s*=>\s*(\d+)", open(meta, encoding='utf-8').read())
            if m:
                nums.add(int(m.group(1)))
    return sorted(nums)


def title_slug(n, urls):
    u = urls.get(str(n))
    return u.rstrip('/').rsplit('/', 1)[-1] if u else None


def fetch(slug):
    body = json.dumps({'query': QUERY, 'variables': {'titleSlug': slug}}).encode()
    req = urllib.request.Request('https://leetcode.com/graphql', data=body, headers={
        'Content-Type': 'application/json',
        'Referer': f'https://leetcode.com/problems/{slug}/',
        'User-Agent': 'Mozilla/5.0 (Macintosh) leetcode-coach-local/1.0',
    })
    with urllib.request.urlopen(req, timeout=30) as r:
        return json.loads(r.read().decode())


def main(argv):
    refresh = '--refresh' in argv
    args = [a for a in argv if a != '--refresh']
    nums = [int(a) for a in args] if args else content_numbers()
    urls = json.load(open(URLS, encoding='utf-8'))
    os.makedirs(CACHE, exist_ok=True)
    done = skipped = failed = 0
    for n in nums:
        path = os.path.join(CACHE, f'{n}.json')
        if os.path.exists(path) and not refresh:
            skipped += 1
            continue
        slug = title_slug(n, urls)
        if not slug:
            print(f'{n}: no URL in data-cleaned.json', flush=True); failed += 1
            continue
        for attempt in range(4):
            try:
                data = fetch(slug)
                q = (data.get('data') or {}).get('question')
                if q is None:
                    raise RuntimeError(f'no question in response: {str(data)[:200]}')
                json.dump(q, open(path, 'w', encoding='utf-8'), ensure_ascii=False, indent=1)
                done += 1
                print(f'{n} {slug} {"PAID" if q.get("isPaidOnly") else "ok"}', flush=True)
                break
            except Exception as e:  # back off and retry
                wait = DELAY * (4 ** attempt)
                print(f'{n} {slug} error {e!r}; retry in {wait:.0f}s', flush=True)
                time.sleep(wait)
        else:
            failed += 1
        time.sleep(DELAY)
    print(f'DONE fetched={done} cached={skipped} failed={failed} total={len(nums)}', flush=True)


if __name__ == '__main__':
    main(sys.argv[1:])
