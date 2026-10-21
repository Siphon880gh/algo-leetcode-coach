#!/usr/bin/env python3
"""Turn cached LeetCode GraphQL responses into committed, sanitized statement files.

Reads  context/leetcode-problems/{n}.json   (raw cache, gitignored; see fetch.py)
Writes content/problems/{n}.html            (allowlisted HTML, one per free problem)
       content/problems/premium.json        (sorted list of premium / no-content numbers)
Only numbers used by content/guides or content/coaching are written.
"""
import html, json, os, re, sys
from html.parser import HTMLParser

ROOT = os.path.abspath(os.path.join(os.path.dirname(__file__), '../../../..'))
CACHE = os.path.join(ROOT, 'context', 'leetcode-problems')
OUT = os.path.join(ROOT, 'content', 'problems')
sys.path.insert(0, os.path.dirname(__file__))
from fetch import content_numbers  # noqa: E402

ALLOWED = {'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'code', 'pre', 'ul', 'ol', 'li',
           'sup', 'sub', 'img', 'table', 'thead', 'tbody', 'tr', 'th', 'td', 'div', 'span',
           'blockquote', 'hr', 'kbd', 'var'}
VOID = {'br', 'img', 'hr'}
DROP_WITH_CONTENT = {'script', 'style', 'iframe', 'object', 'embed', 'svg', 'math', 'form'}


class Sanitizer(HTMLParser):
    def __init__(self):
        super().__init__(convert_charrefs=False)
        self.out, self.stack, self.skip = [], [], 0

    def handle_starttag(self, tag, attrs):
        if tag in DROP_WITH_CONTENT:
            self.skip += 1
            return
        if self.skip or tag not in ALLOWED:
            return
        a = ''
        if tag == 'img':
            d = dict(attrs)
            src = (d.get('src') or '').strip()
            if src.startswith('//'):
                src = 'https:' + src
            if not src.startswith('https://'):
                return
            a = f' src="{html.escape(src, quote=True)}" alt="{html.escape(d.get("alt") or "", quote=True)}" loading="lazy"'
        self.out.append(f'<{tag}{a}>')
        if tag not in VOID:
            self.stack.append(tag)

    def handle_startendtag(self, tag, attrs):
        self.handle_starttag(tag, attrs)

    def handle_endtag(self, tag):
        if tag in DROP_WITH_CONTENT:
            self.skip = max(0, self.skip - 1)
            return
        if self.skip or tag not in ALLOWED or tag in VOID or tag not in self.stack:
            return
        while self.stack:
            t = self.stack.pop()
            self.out.append(f'</{t}>')
            if t == tag:
                break

    def handle_data(self, data):
        if not self.skip:
            self.out.append(html.escape(data, quote=False))

    def handle_entityref(self, name):
        if not self.skip:
            self.out.append(html.escape(html.unescape(f'&{name};'), quote=False))

    def handle_charref(self, name):
        if not self.skip:
            self.out.append(html.escape(html.unescape(f'&#{name};'), quote=False))

    def result(self):
        while self.stack:
            self.out.append(f'</{self.stack.pop()}>')
        return ''.join(self.out)


def sanitize(src):
    s = Sanitizer()
    s.feed(src)
    s.close()
    out = s.result().replace('\u00a0', ' ').replace('\u200b', '')
    out = re.sub(r'<p>\s*</p>', '', out)              # LeetCode spacer paragraphs
    out = re.sub(r'(<br>\s*){3,}', '<br><br>', out)
    out = re.sub(r'\n{3,}', '\n\n', out)
    return out.strip() + '\n'


def main():
    os.makedirs(OUT, exist_ok=True)
    premium, written, missing = [], 0, []
    extra = {int(a) for a in sys.argv[1:] if a.isdigit()}
    for n in sorted(set(content_numbers()) | extra):
        p = os.path.join(CACHE, f'{n}.json')
        if not os.path.exists(p):
            missing.append(n)
            continue
        q = json.load(open(p, encoding='utf-8'))
        if q.get('isPaidOnly') or not q.get('content'):
            premium.append(n)
            target = os.path.join(OUT, f'{n}.html')
            if os.path.exists(target):
                os.remove(target)
            continue
        open(os.path.join(OUT, f'{n}.html'), 'w', encoding='utf-8').write(sanitize(q['content']))
        written += 1
    json.dump(sorted(premium), open(os.path.join(OUT, 'premium.json'), 'w'), indent=1)
    open(os.path.join(OUT, 'premium.json'), 'a').write('\n')
    print(f'written={written} premium={len(premium)} missing_cache={len(missing)} {missing[:20]}')


if __name__ == '__main__':
    main()
