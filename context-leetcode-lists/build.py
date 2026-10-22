#!/usr/bin/env python3
"""Rebuild lists.json (Blind 75 + NeetCode 150, grouped by NeetCode pattern).

Source: NeetCode's own problem data that powers neetcode.io/practice:
  https://raw.githubusercontent.com/neetcode-gh/leetcode/main/.problemSiteData.json
Blind 75 follows the original Blind post (yangshun, "New Year Gift - Curated List of
Top 75 LeetCode Questions"), which lists Combination Sum IV (377) where NeetCode's
blind75 flag uses Combination Sum (39). Everything else matches NeetCode's flag.

Usage: python3 context-leetcode-lists/build.py [path-to-problemSiteData.json]
"""
import json
import os
import sys
import urllib.request

SOURCE_URL = "https://raw.githubusercontent.com/neetcode-gh/leetcode/main/.problemSiteData.json"
HERE = os.path.dirname(os.path.abspath(__file__))

# Original Blind post vs NeetCode's blind75 flag.
BLIND_ORIGINAL_ADD = ["combination-sum-iv"]
BLIND_ORIGINAL_DROP = ["combination-sum"]


def load(path):
    if path:
        with open(path) as f:
            return json.load(f)
    with urllib.request.urlopen(SOURCE_URL) as r:
        return json.load(r)


def row(x):
    slug = x["link"].strip("/")
    number = int(x["code"].split("-", 1)[0])
    return {
        "n": number,
        "slug": slug,
        "title": x["problem"],
        "difficulty": x["difficulty"],
        "pattern": x["pattern"],
    }


def main():
    data = load(sys.argv[1] if len(sys.argv) > 1 else None)
    patterns = []
    for x in data:
        if x.get("neetcode150") and x["pattern"] not in patterns:
            patterns.append(x["pattern"])

    def build(pred):
        rows = [row(x) for x in data if pred(x)]
        order = {p: i for i, p in enumerate(patterns)}
        rows.sort(key=lambda r: order.get(r["pattern"], len(order)))  # stable: keeps NeetCode order inside a pattern
        return rows

    def in_blind(x):
        slug = x["link"].strip("/")
        if slug in BLIND_ORIGINAL_DROP:
            return False
        return bool(x.get("blind75")) or slug in BLIND_ORIGINAL_ADD

    lists = [
        {
            "id": "blind-75",
            "name": "Blind 75",
            "summary": "The original curated 75 from the Blind post: the core patterns with no filler.",
            "source": "Original Blind post by yangshun (teamblind.com), grouped by NeetCode's pattern names",
            "sourceUrl": "https://www.teamblind.com/post/New-Year-Gift---Curated-List-of-Top-75-LeetCode-Questions-to-Save-Your-Time-OaM1orEU",
            "problems": build(in_blind),
        },
        {
            "id": "neetcode-150",
            "name": "NeetCode 150",
            "summary": "Blind 75 plus 75 more, organized pattern by pattern in NeetCode's roadmap order.",
            "source": "neetcode.io/practice (neetcode-gh/leetcode .problemSiteData.json)",
            "sourceUrl": "https://neetcode.io/practice",
            "problems": build(lambda x: bool(x.get("neetcode150"))),
        },
    ]
    out = {"patterns": patterns, "lists": lists}
    with open(os.path.join(HERE, "lists.json"), "w") as f:
        json.dump(out, f, indent=2)
        f.write("\n")
    for l in lists:
        print(l["id"], len(l["problems"]))


if __name__ == "__main__":
    main()
