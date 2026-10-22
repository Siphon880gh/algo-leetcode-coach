#!/usr/bin/env python3
"""Build full statements for premium problems from the doocs/leetcode clone.

Reads  context/doocs-leetcode/solution/*/{nnnn}.*/README_EN.md   (gitignored clone)
       content/problems/premium.json                             (premium numbers)
Writes content/problems/premium/{n}.php                          (gitignored)

Each output file is a one-line PHP guard (a direct web request gets a 404 and
nothing else) followed by sanitized HTML of the statement only: the
<!-- description:start --> ... <!-- description:end --> block (description,
examples, constraints). Solution sections are never copied. includes/problem.php
shows it only to visitors who unlocked premium (includes/premium.php).

Usage:
  build_premium.py            premium numbers used by content/guides or content/coaching
  build_premium.py --all      every number in premium.json
  build_premium.py 512 1158   these numbers too
"""
import glob, json, os, re, sys

sys.path.insert(0, os.path.dirname(__file__))
from build import ROOT, sanitize  # noqa: E402
from fetch import content_numbers  # noqa: E402

DOOCS = os.path.join(ROOT, 'context', 'doocs-leetcode', 'solution')
PREMIUM_JSON = os.path.join(ROOT, 'content', 'problems', 'premium.json')
OUT = os.path.join(ROOT, 'content', 'problems', 'premium')
GUARD = "<?php http_response_code(404); exit; ?>\n"
DESC = re.compile(r'<!--\s*description:start\s*-->(.*?)<!--\s*description:end\s*-->', re.S)


def doocs_readme(n):
    """(path, lang) for problem n, English preferred."""
    for d in sorted(glob.glob(os.path.join(DOOCS, '*', f'{n:04d}.*'))):
        if not os.path.isdir(d):
            continue
        for name, lang in (('README_EN.md', 'en'), ('README.md', 'zh')):
            p = os.path.join(d, name)
            if os.path.isfile(p):
                return p, lang
    return None, None


def statement_html(path):
    m = DESC.search(open(path, encoding='utf-8').read())
    if not m:
        return None
    body = m.group(1)
    # Relative images (rare) → absolute jsDelivr URLs, like the rest of doocs.
    rel_dir = os.path.relpath(os.path.dirname(path), os.path.join(DOOCS, '..'))
    body = re.sub(r'src="(?!https?:|//)\.?/?([^"]+)"',
                  lambda mm: f'src="https://fastly.jsdelivr.net/gh/doocs/leetcode@main/{rel_dir}/{mm.group(1)}"',
                  body)
    html = sanitize(body)
    return html if html.strip() else None


def main():
    args = sys.argv[1:]
    premium = set(json.load(open(PREMIUM_JSON, encoding='utf-8')))
    if '--all' in args:
        targets = set(premium)
    else:
        targets = premium & set(content_numbers())
    targets |= {int(a) for a in args if a.isdigit()} & premium
    os.makedirs(OUT, exist_ok=True)
    written, zh, no_readme, no_desc = 0, [], [], []
    for n in sorted(targets):
        path, lang = doocs_readme(n)
        if path is None:
            no_readme.append(n)
            continue
        html = statement_html(path)
        if html is None:
            no_desc.append(n)
            continue
        if lang == 'zh':
            zh.append(n)
        with open(os.path.join(OUT, f'{n}.php'), 'w', encoding='utf-8') as f:
            f.write(GUARD + html)
        written += 1
    print(f'targets={len(targets)} written={written} chinese_only={len(zh)} {zh[:20]} '
          f'no_readme={len(no_readme)} {no_readme[:20]} no_description={len(no_desc)} {no_desc[:20]}')


if __name__ == '__main__':
    main()
