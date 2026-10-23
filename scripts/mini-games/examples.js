// Parse the Input/Output examples from a problem statement (content/problems/{n}.html,
// or the gitignored content/problems/premium/{n}.php when present).
// usage: node examples.js <leetcode-number>
const fs = require('fs'), path = require('path');
const ROOT = path.resolve(__dirname, '..', '..');
function stmtHtml(n) {
  let p = path.join(ROOT, 'content/problems', n + '.html');
  if (fs.existsSync(p)) return fs.readFileSync(p, 'utf8');
  p = path.join(ROOT, 'content/problems/premium', n + '.php');
  if (fs.existsSync(p)) { let r = fs.readFileSync(p, 'utf8'); if (r.startsWith('<?php')) r = r.slice(r.indexOf('\n') + 1); return r; }
  return '';
}
function text(html) {
  return html.replace(/<sup>(.*?)<\/sup>/gs, '^$1').replace(/<sub>(.*?)<\/sub>/gs, '_$1').replace(/<img[^>]*>/g, ' [image] ')
    .replace(/<li>/g, '- ').replace(/<\/(p|li|pre|div|tr|ul|ol|table)>|<br\s*\/?>/g, '\n').replace(/<[^>]+>/g, '')
    .replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"').replace(/&#39;/g, "'").replace(/&nbsp;/g, ' ').replace(/&amp;/g, '&')
    .replace(/[ \t]+\n/g, '\n').replace(/\n{3,}/g, '\n\n').trim();
}
// Split `a = [1,2], b = "x,y"` at top-level commas that precede `name =`.
function splitTop(s) {
  const parts = []; let depth = 0, q = false, cur = '';
  for (let i = 0; i < s.length; i++) {
    const ch = s[i];
    if (q) { cur += ch; if (ch === '\\') { cur += s[++i] || ''; continue; } if (ch === '"') q = false; continue; }
    if (ch === '"') { q = true; cur += ch; continue; }
    if (ch === '[' || ch === '{' || ch === '(') depth++;
    if (ch === ']' || ch === '}' || ch === ')') depth--;
    if (ch === ',' && depth === 0 && /^\s*[A-Za-z_][A-Za-z0-9_]*\s*=/.test(s.slice(i + 1))) { parts.push(cur); cur = ''; continue; }
    cur += ch;
  }
  if (cur.trim()) parts.push(cur);
  return parts;
}
function val(v) {
  v = v.trim().replace(/,$/, '');
  try { return JSON.parse(v); } catch (e) {}
  try { return JSON.parse(v.replace(/'/g, '"')); } catch (e) {}
  if (/^-?\d+(\.\d+)?$/.test(v)) return Number(v);
  return { __raw: v }; // not machine-readable; the oracle test skips it
}
function examples(n) {
  const t = text(stmtHtml(n)), out = [];
  const re = /Input:?\s*([\s\S]*?)\n?\s*Output:?\s*([\s\S]*?)(?=\n\s*(Explanation|Example|Constraints|Note|Follow|Input)|\n\n|$)/g;
  let m;
  while ((m = re.exec(t))) {
    const inp = m[1].trim(), outp = m[2].trim();
    let I = {};
    if (/^\[/.test(inp) && !/^\s*[A-Za-z_]\w*\s*=/.test(inp)) { // design problems: ops line + args line
      const lines = inp.split('\n').map(x => x.trim()).filter(Boolean);
      I = lines.length >= 2 ? { ops: val(lines[0]), args: val(lines.slice(1).join('')) } : { __raw: inp };
    } else {
      for (const part of splitTop(inp.replace(/\n/g, ' '))) {
        const k = part.indexOf('='); if (k < 0) { I.__raw = inp; break; }
        I[part.slice(0, k).trim()] = val(part.slice(k + 1));
      }
    }
    out.push({ input: I, output: val(outp.split('\n')[0]), rawIn: inp, rawOut: outp.split('\n')[0] });
  }
  return out;
}
module.exports = { ROOT, stmtHtml, text, examples };
if (require.main === module) console.log(JSON.stringify(examples(+process.argv[2]), null, 1));
