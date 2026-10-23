/* v2 games: stacks & parsing (01). */
(function () {
  'use strict';
  const { D, A, K, S, X } = LCGame.H;
  const num = R => String(R.int(0, 12));
  const sp = (R, t) => R.chance(0.3) ? ' ' + t + ' ' : t;
  const genSigned = (R, d) => { const parts = []; for (let i = 0; i < R.int(1, 3); i++) { let t = d > 0 && R.chance(0.35) ? '(' + genSigned(R, d - 1) + ')' : num(R); if (i === 0 && R.chance(0.25)) t = '-' + t; parts.push(t); if (i < 2) parts.push(sp(R, R.pick(['+', '-']))); } if (/[+-] ?$/.test(parts[parts.length - 1])) parts.pop(); return parts.join(''); };
  const genArith = (R, d, paren) => { const parts = []; const n = R.int(1, 4); for (let i = 0; i < n; i++) { const prev = parts[parts.length - 1]; const div = prev && prev.trim() === '/'; parts.push(div ? String(R.int(1, 9)) : paren && d > 0 && R.chance(0.3) ? '(' + genArith(R, d - 1, paren) + ')' : num(R)); if (i < n - 1) parts.push(sp(R, R.pick(['+', '-', '*', '/']))); } return parts.join(''); };
  const vps = s => { let d = 0; for (const c of s) { d += c === '(' ? 1 : -1; if (d < 0) return false; } return d === 0; };
  const depth = s => { let d = 0, m = 0; for (const c of s) { d += c === '(' ? 1 : -1; m = Math.max(m, d); } return m; };
  const genParens = (R, n) => { let s = '', open = 0, left = n; while (left || open) { if (left && (!open || R.chance(0.5))) { s += '('; open++; left--; } else { s += ')'; open--; } } return s; };

  D('basic-calculator', {
    t: 'Basic Calculator',
    r: 'Scan left to right with a running result and sign. On "(", push (result, sign) and start fresh; on ")", finish the inner value and combine it with the popped result and sign.',
    g: R => ({ s: genSigned(R, 2) }),
    s(I, T) { const st = []; let res = 0, sign = 1, n = 0, k = 0; for (const c of I.s + ' ') { if (c >= '0' && c <= '9') { n = n * 10 + +c; continue; } res += sign * n; n = 0; if (c === '+') sign = 1; else if (c === '-') sign = -1; else if (c === '(') { st.push([res, sign]); res = 0; sign = 1; } else if (c === ')') { const [r, sg] = st.pop(); res = r + sg * res; if (k++ < 4) { T.at({ s: X(I.s), stack: S(st.map(x => `${x[0]},${x[1] > 0 ? '+' : '−'}`)) }); T.n('Running result after closing this ")"?', res, 'outer + sign × inner.'); } } } if (!k) { T.at({ s: X(I.s) }); T.n('Result?', res, 'Sum with signs.'); } return res; }
  });

  D('basic-calculator-ii', {
    t: 'Basic Calculator II',
    r: 'Keep a stack of terms and the previous operator. When a number ends: + pushes it, − pushes its negation, * and / combine with the top (truncating division). Sum the stack.',
    g: R => ({ s: genArith(R, 0, false) }),
    s(I, T) { const st = []; let n = 0, op = '+', k = 0; for (const c of I.s.replace(/ /g, '') + '+') { if (c >= '0' && c <= '9') { n = n * 10 + +c; continue; } if (op === '+') st.push(n); else if (op === '-') st.push(-n); else if (op === '*') st.push(st.pop() * n); else st.push(Math.trunc(st.pop() / n)); if (k++ < 5) { T.at({ s: X(I.s), stack: S(st.slice()) }); T.n('Top of the stack?', st[st.length - 1], `Applied "${op}" to ${n}.`); } op = c; n = 0; } return st.reduce((a, b) => a + b, 0); }
  });

  D('mini-parser', {
    t: 'Mini Parser',
    r: 'Scan with a stack of open lists: "[" pushes a new list, digits (with optional "−") build an integer added to the current list, "]" pops and appends the finished list to its parent.',
    g: R => { const gen = d => d > 0 && R.chance(0.5) ? Array.from({ length: R.int(0, 3) }, () => gen(d - 1)) : R.int(-20, 99); const v = gen(3); return { s: JSON.stringify(v) }; },
    s(I, T) { if (I.s[0] !== '[') { T.at({ s: I.s }); T.yn('Is it a single integer?', true, 'No brackets.'); return +I.s; } const st = []; let cur = null, tok = '', k = 0; for (const c of I.s) { if (c === '[') { if (cur) st.push(cur); cur = []; } else if (c === ',' || c === ']') { if (tok) { cur.push(+tok); tok = ''; } if (c === ']') { if (k++ < 4) { T.at({ s: X(I.s), depth: st.length + 1 }); T.n('Items in the list being closed?', cur.length, 'Then attach it to its parent.'); } if (st.length) { const p = st.pop(); p.push(cur); cur = p; } } } else tok += c; } return cur; }
  });

  D('longest-absolute-file-path', {
    t: 'Longest Absolute File Path',
    r: 'Process lines; the number of tabs is the depth. Keep a stack of cumulative path lengths per depth: len[d] = len[d−1] + name length + 1. Files (names with ".") update the answer.',
    g: R => { const lines = []; const gen = (d, n) => { for (let i = 0; i < n; i++) { const isFile = d > 0 && R.chance(0.4); lines.push('\t'.repeat(d) + (isFile ? R.pick(['a', 'fi', 'long']) + '.' + R.pick(['x', 'ext']) : R.pick(['dir', 'd', 'sub']) + R.int(1, 9))); if (!isFile && d < 3) gen(d + 1, R.int(0, 2)); } }; gen(0, 1); return { input: lines.join('\n') }; },
    s(I, T) { const len = [0]; let best = 0, k = 0; I.input.split('\n').forEach(line => { const d = line.lastIndexOf('\t') + 1, name = line.slice(d); len[d + 1] = len[d] + name.length + 1; if (name.includes('.')) { best = Math.max(best, len[d + 1] - 1); if (k++ < 4) { T.at({ line: X(line.replace(/\t/g, '→')) }); T.n('Path length to this file?', len[d + 1] - 1, 'Parent length + name + "/" separators.'); } } }); return best; }
  });

  D('decode-string', {
    t: 'Decode String',
    r: 'Stack of (previous string, repeat count). On "[", push and start a new string; on "]", pop and set cur = prev + cur repeated k times.',
    g: R => { const gen = d => Array.from({ length: R.int(1, 2) }, () => d > 0 && R.chance(0.5) ? R.int(1, 3) + '[' + gen(d - 1) + ']' : R.str(R.int(1, 2), 'abc')).join(''); return { s: gen(2) }; },
    s(I, T) { const st = []; let cur = '', k = 0, t = 0; for (const c of I.s) { if (c >= '0' && c <= '9') k = k * 10 + +c; else if (c === '[') { st.push([cur, k]); cur = ''; k = 0; } else if (c === ']') { const [p, n] = st.pop(); cur = p + cur.repeat(n); if (t++ < 4) { T.at({ s: X(I.s), stack: S(st.map(x => `${x[0] || '""'}×${x[1]}`)) }); T.n('Length of the string after this "]"?', cur.length, 'prev + inner × k.'); } } else cur += c; } return cur; }
  });

  D('ternary-expression-parser', {
    t: 'Ternary Expression Parser',
    r: 'Scan from right to left with a stack. When the character before the top is "?", pop the two branches and push the one chosen by the condition letter.',
    g: R => { const gen = d => d > 0 && R.chance(0.6) ? R.pick(['T', 'F']) + '?' + gen(d - 1) + ':' + gen(d - 1) : R.pick(['1', '2', '3', 'T', 'F']); let e; do e = gen(3); while (e.length < 5); return { expression: e }; },
    s(I, T) { const e = I.expression, st = []; let k = 0; for (let i = e.length - 1; i >= 0; i--) { const c = e[i]; if (c === '?' || c === ':') continue; if (i + 1 < e.length && e[i + 1] === '?') { const a = st.pop(), b = st.pop(), v = c === 'T' ? a : b; st.push(v); if (k++ < 4) { T.at({ expr: A([...e], { i }), stack: S(st.slice()) }); T.c(`${c} ? ${a} : ${b} gives?`, [...new Set([a, b])], v, 'T picks the first branch.'); } } else st.push(c); } return st[0]; }
  });

  D('find-permutation', {
    t: 'Find Permutation',
    r: 'Start from [1..n] and reverse every maximal run covered by consecutive "D"s (the block of positions i..j where s[i..j−1] are all "D"). This gives the lexicographically smallest permutation.',
    g: R => ({ s: R.str(R.int(1, 7), 'ID') }),
    s(I, T) { const n = I.s.length + 1, p = Array.from({ length: n }, (_, i) => i + 1); for (let i = 0; i < I.s.length;) { if (I.s[i] !== 'D') { i++; continue; } let j = i; while (j < I.s.length && I.s[j] === 'D') j++; p.splice(i, j - i + 1, ...p.slice(i, j + 1).reverse()); T.at({ s: A([...I.s], { i, j: j - 1 }), perm: A(p.slice()) }); T.n('Length of the reversed block?', j - i + 1, 'D-run length + 1.'); i = j; } return p; }
  });

  D('tag-validator', {
    t: 'Tag Validator',
    r: 'Parse with a stack of open tag names. The code must be inside one closed tag. CDATA (only inside a tag) is skipped to "]]>"; a start tag name must be 1–9 uppercase letters; an end tag must match the top. Anything left over, or content outside the root tag, is invalid.',
    g: R => { const name = () => R.str(R.int(1, R.chance(0.1) ? 10 : 4), R.chance(0.1) ? 'ABa' : 'ABC'); const body = d => Array.from({ length: R.int(0, 3) }, () => { const r = R.int(0, 3); if (r === 0 && d > 0) { const nm = name(); return '<' + nm + '>' + body(d - 1) + '</' + (R.chance(0.9) ? nm : name()) + '>'; } if (r === 1) return '<![CDATA[' + R.pick(['<div>', 'x', ']>']) + ']]>'; return R.pick(['text', ' ', '>>', '!']); }).join(''); const nm = name(); let c = '<' + nm + '>' + body(2) + '</' + nm + '>'; if (R.chance(0.2)) c = R.pick([c + 'x', c.slice(0, -1), 'x' + c]); return { code: c }; },
    s(I, T) { const c = I.code, st = []; let i = 0, k = 0; const say = (msg, v, why) => { if (k++ < 5) { T.at({ code: X(c), at: i, stack: S(st.slice()) }); T.yn(msg, v, why); } }; while (i < c.length) { if (i > 0 && !st.length) { say('Is there content outside the root tag?', true, 'Invalid.'); return false; } if (c.startsWith('<![CDATA[', i)) { if (!st.length) return false; const j = c.indexOf(']]>', i + 9); if (j < 0) return false; i = j + 3; } else if (c.startsWith('</', i)) { const j = c.indexOf('>', i + 2); if (j < 0) return false; const nm = c.slice(i + 2, j), ok = st.length && st[st.length - 1] === nm; say(`Does </${nm}> match the open tag?`, !!ok, 'Must close the top tag.'); if (!ok) return false; st.pop(); i = j + 1; } else if (c[i] === '<') { const j = c.indexOf('>', i + 1); if (j < 0) return false; const nm = c.slice(i + 1, j), ok = /^[A-Z]{1,9}$/.test(nm); say(`Is <${nm}> a valid start tag?`, ok, '1–9 uppercase letters.'); if (!ok) return false; st.push(nm); i = j + 1; } else { if (!st.length) return false; i++; } } return st.length === 0; }
  });

  D('exclusive-time-of-functions', {
    t: 'Exclusive Time of Functions',
    r: 'Keep a stack of running function ids and the previous timestamp. On "start", charge the elapsed time to the current top, then push. On "end", charge (t − prev + 1) to the top, pop, and set prev = t + 1.',
    g: R => { const n = R.int(1, 3), logs = []; let t = 0; const gen = d => { const id = R.int(0, n - 1); logs.push(`${id}:start:${t}`); t += R.int(0, 2); if (d > 0) for (let i = 0; i < R.int(0, 2); i++) { gen(d - 1); t += R.int(1, 2); } logs.push(`${id}:end:${t}`); t++; }; gen(2); return { n, logs }; },
    s(I, T) { const out = Array(I.n).fill(0), st = []; let prev = 0; I.logs.forEach((l, i) => { const [id, ty, ts] = l.split(':'), t = +ts; if (ty === 'start') { if (st.length) out[st[st.length - 1]] += t - prev; st.push(+id); prev = t; } else { out[st.pop()] += t - prev + 1; prev = t + 1; } if (i < 6) { T.at({ log: l, stack: S(st.slice()) }); T.n(`Exclusive time of function ${id} so far?`, out[+id], 'Charge elapsed time to the running function.'); } }); return out; }
  });

  D('dota2-senate', {
    t: 'Dota2 Senate',
    r: 'Two queues of senator indices. Repeatedly compare the fronts: the earlier one bans the other and re-enters at index + n; the party whose queue survives wins.',
    g: R => ({ senate: R.str(R.int(1, 7), 'RD') }),
    s(I, T) { const n = I.senate.length, r = [], d = []; [...I.senate].forEach((c, i) => (c === 'R' ? r : d).push(i)); let k = 0; while (r.length && d.length) { const a = r.shift(), b = d.shift(); if (k++ < 5) { T.at({ radiant: A(r.concat()), dire: A(d.concat()), duel: `R@${a} vs D@${b}` }); T.c('Who bans the other?', ['Radiant', 'Dire'], a < b ? 'Radiant' : 'Dire', 'Earlier index acts first.'); } if (a < b) r.push(a + n); else d.push(b + n); } return r.length ? 'Radiant' : 'Dire'; }
  });

  D('valid-parenthesis-string', {
    t: 'Valid Parenthesis String',
    r: 'Track the range [lo, hi] of possible open counts: "(" raises both, ")" lowers both, "*" lowers lo and raises hi. Fail if hi < 0; clamp lo at 0; valid if lo is 0 at the end.',
    g: R => ({ s: R.str(R.int(1, 8), '()*') }),
    s(I, T) { let lo = 0, hi = 0; for (const [i, c] of [...I.s].entries()) { if (c === '(') { lo++; hi++; } else if (c === ')') { lo--; hi--; } else { lo--; hi++; } if (hi < 0) { T.at({ s: A([...I.s], { i }) }); T.yn('Too many ")" even with every * as "("?', true, 'hi < 0.'); return false; } lo = Math.max(lo, 0); if (i < 6) { T.at({ s: A([...I.s], { i }) }); T.n('Max possible open count (hi)?', hi, '"(" and "*" can open.'); } } return lo === 0; }
  });

  D('number-of-atoms', {
    t: 'Number of Atoms',
    r: 'Stack of count maps. "(" pushes a new map; ")" followed by a multiplier pops, multiplies every count, and merges into the map below. Atoms (uppercase + lowercase letters, optional count) add to the top map. Output names sorted with counts > 1.',
    g: R => { const el = () => R.pick(['H', 'O', 'Mg', 'C', 'Na']) + (R.chance(0.5) ? R.int(2, 4) : ''); const gen = d => Array.from({ length: R.int(1, 3) }, () => d > 0 && R.chance(0.35) ? '(' + gen(d - 1) + ')' + (R.chance(0.7) ? R.int(2, 3) : '') : el()).join(''); return { formula: gen(2) }; },
    s(I, T) { const f = I.formula, st = [{}]; let i = 0, k = 0; const rd = () => { let j = i; while (j < f.length && f[j] >= '0' && f[j] <= '9') j++; const v = j > i ? +f.slice(i, j) : 1; i = j; return v; }; while (i < f.length) { if (f[i] === '(') { st.push({}); i++; } else if (f[i] === ')') { i++; const m = rd(), top = st.pop(), below = st[st.length - 1]; for (const a in top) below[a] = (below[a] || 0) + top[a] * m; if (k++ < 4) { T.at({ formula: X(f), merged: K({ ...below }) }); T.n('Multiplier applied to this group?', m, 'Digits after ")" (1 if none).'); } } else { let j = i + 1; while (j < f.length && f[j] >= 'a' && f[j] <= 'z') j++; const a = f.slice(i, j); i = j; const c = rd(); st[st.length - 1][a] = (st[st.length - 1][a] || 0) + c; } } const m = st[0]; return Object.keys(m).sort().map(a => a + (m[a] > 1 ? m[a] : '')).join(''); }
  });

  D('parse-lisp-expression', {
    t: 'Parse Lisp Expression',
    r: 'Recursive evaluation with a stack of scopes. A number evaluates to itself, a variable to the innermost binding; "add"/"mult" evaluate both operands; "let" pushes a scope, assigns pairs in order, evaluates the final expression, then pops.',
    g: R => { const names = ['x', 'y', 'a1']; const gen = (scope, d) => { if (d === 0 || R.chance(0.3)) return scope.length && R.chance(0.6) ? R.pick(scope) : String(R.int(-3, 5)); const k = R.int(0, 2); if (k < 2) return `(${k ? 'mult' : 'add'} ${gen(scope, d - 1)} ${gen(scope, d - 1)})`; const parts = [], sc = scope.slice(); for (let i = 0; i < R.int(1, 2); i++) { const v = R.pick(names); parts.push(v, gen(sc, d - 1)); if (!sc.includes(v)) sc.push(v); } return `(let ${parts.join(' ')} ${gen(sc, d - 1)})`; }; let e; do e = gen([], 3); while (e[0] !== '('); return { expression: e }; },
    s(I, T) { const tok = I.expression.replace(/\(/g, ' ( ').replace(/\)/g, ' ) ').trim().split(/\s+/); let p = 0, k = 0; const scopes = [{}]; const look = v => { for (let i = scopes.length - 1; i >= 0; i--) if (v in scopes[i]) return scopes[i][v]; }; const ev = () => { const t = tok[p++]; if (t !== '(') return /^-?\d/.test(t) ? +t : look(t); const op = tok[p++]; let v; if (op === 'add' || op === 'mult') { const a = ev(), b = ev(); v = op === 'add' ? a + b : a * b; if (k++ < 5) { T.at({ expr: X(I.expression) }); T.n(`${op} ${a} ${b} = ?`, v, op === 'add' ? 'Sum.' : 'Product.'); } } else { scopes.push({}); for (;;) { if (tok[p] !== '(' && tok[p + 1] !== ')' && !/^-?\d/.test(tok[p]) && tok[p] !== ')') { const nm = tok[p++]; scopes[scopes.length - 1][nm] = ev(); } else { v = ev(); break; } } scopes.pop(); } p++; return v; }; return ev(); }
  });

  D('basic-calculator-iii', {
    t: 'Basic Calculator III',
    r: 'Recursive descent / stack: evaluate each parenthesized group as a number, and inside a level use the Calculator II stack rule (+/− push, */÷ combine with the top, truncating).',
    g: R => ({ s: genArith(R, 2, true).replace(/ /g, '') }),
    s(I, T) { let i = 0, k = 0; const s = I.s; const level = () => { const st = []; let n = 0, op = '+'; while (i <= s.length) { const c = s[i++]; if (c >= '0' && c <= '9') { n = n * 10 + +c; continue; } if (c === '(') { n = level(); continue; } if (op === '+') st.push(n); else if (op === '-') st.push(-n); else if (op === '*') st.push(st.pop() * n); else st.push(Math.trunc(st.pop() / n)); if (c === ')' || c === undefined) { const v = st.reduce((a, b) => a + b, 0); if (k++ < 4) { T.at({ s: X(s), at: i }); T.n('Value of the group just closed?', v, 'Sum of its stack.'); } return v; } op = c; n = 0; } }; return level(); }
  });

  D('score-of-parentheses', {
    t: 'Score of Parentheses',
    r: 'Only "()" pairs score: each contributes 2^depth, where depth is the number of enclosing pairs. Sum them.',
    g: R => ({ s: genParens(R, R.int(1, 5)) }),
    s(I, T) { let d = 0, sc = 0, k = 0; [...I.s].forEach((c, i) => { if (c === '(') d++; else { d--; if (I.s[i - 1] === '(') { sc += 2 ** d; if (k++ < 5) { T.at({ s: A([...I.s], { i }) }); T.n('Points from this "()"?', 2 ** d, '2^depth.'); } } } }); return sc; }
  });

  D('decoded-string-at-index', {
    t: 'Decoded String at Index',
    r: 'Compute the decoded length, then walk backward: k %= size; a letter with k == 0 is the answer; a digit d divides size by d, a letter decrements size.',
    g: R => { let s = R.pick(['a', 'le', 'ha']), size = s.length; for (let i = 0; i < R.int(1, 4); i++) { if (R.chance(0.5)) { const d = R.int(2, 3); s += d; size *= d; } else { const t = R.str(R.int(1, 2), 'xyz'); s += t; size += t.length; } } return { s, k: R.int(1, size) }; },
    s(I, T) { let size = 0; for (const c of I.s) size = /\d/.test(c) ? size * +c : size + 1; T.at({ s: I.s }); T.n('Decoded length?', size, 'Multiply on digits, +1 on letters.'); let k = I.k; for (let i = I.s.length - 1; i >= 0; i--) { const c = I.s[i]; k %= size; if (k === 0 && !/\d/.test(c)) return c; size = /\d/.test(c) ? size / +c : size - 1; } }
  });

  D('stamping-the-sequence', {
    t: 'Stamping the Sequence',
    r: 'Work backward: repeatedly find a window that matches the stamp where every non-"?" character agrees, turn it into "?"s, and record it. If no window makes progress before everything is "?", it is impossible. Reverse the recorded order.',
    g: R => { const stamp = R.str(R.int(1, 3), 'ab'), n = R.int(stamp.length, 6); if (R.chance(0.7)) { const t = Array(n).fill(null), pos = [0, n - stamp.length]; for (let i = 0; i < R.int(0, 2); i++) pos.push(R.int(0, n - stamp.length)); pos.forEach(p => { for (let j = 0; j < stamp.length; j++) t[p + j] = stamp[j]; }); if (t.every(x => x)) return { stamp, target: t.join('') }; } return { stamp, target: R.str(n, 'ab') }; },
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && !o.length; if (!Array.isArray(o) || !o.length || o.length > 10 * I.target.length) return false; const s = Array(I.target.length).fill('?'); for (const p of o) { if (p < 0 || p + I.stamp.length > s.length) return false; for (let j = 0; j < I.stamp.length; j++) s[p + j] = I.stamp[j]; } return s.join('') === I.target; },
    s(I, T) { const m = I.stamp.length, s = [...I.target], n = s.length, done = Array(n).fill(false), res = []; let q = 0, k = 0; while (q < n) { let prog = false; for (let i = 0; i + m <= n; i++) { if (done[i]) continue; let ok = true, fresh = 0; for (let j = 0; j < m; j++) { if (s[i + j] === '?') continue; if (s[i + j] !== I.stamp[j]) { ok = false; break; } fresh++; } if (!ok || !fresh) continue; done[i] = true; for (let j = 0; j < m; j++) if (s[i + j] !== '?') { s[i + j] = '?'; q++; } res.push(i); prog = true; if (k++ < 4) { T.at({ target: A(s.slice(), { i, j: i + m - 1 }) }); T.n('Characters still not "?"?', n - q, 'Un-stamp a matching window.'); } } if (!prog) { T.at({ target: A(s.slice()) }); T.yn('Can any window still be un-stamped?', false, 'Impossible.'); return []; } } return res.reverse(); }
  });

  D('validate-stack-sequences', {
    t: 'Validate Stack Sequences',
    r: 'Push in order; after each push, pop while the top equals the next value of popped. Valid iff the stack ends empty.',
    g: R => { const n = R.int(1, 6), pushed = R.perm(n).map(x => x + 1); return { pushed, popped: R.chance(0.5) ? R.shuffle(pushed.slice()) : (() => { const st = [], out = []; let i = 0; while (out.length < n) { if (i < n && (!st.length || R.chance(0.5))) st.push(pushed[i++]); else out.push(st.pop()); } return out; })() }; },
    s(I, T) { const st = []; let j = 0; I.pushed.forEach((x, i) => { st.push(x); while (st.length && st[st.length - 1] === I.popped[j]) { st.pop(); j++; } if (i < 6) { T.at({ pushed: A(I.pushed, { i }), stack: S(st.slice()) }); T.n('Values popped so far?', j, 'Pop while the top matches.'); } }); return st.length === 0; }
  });

  D('reveal-cards-in-increasing-order', {
    t: 'Reveal Cards In Increasing Order',
    r: 'Simulate the reveal process on positions with a queue of indices: the front index gets the next smallest card, then the following index moves to the back.',
    g: R => ({ deck: R.distinct(R.int(1, 7), 1, 20) }),
    s(I, T) { const s = I.deck.slice().sort((a, b) => a - b), q = I.deck.map((_, i) => i), out = []; s.forEach((v, k) => { const i = q.shift(); out[i] = v; if (q.length) q.push(q.shift()); if (k < 5) { T.at({ queue: A(q.slice()) }); T.n(`Position receiving card ${v}?`, i, 'Front of the index queue.'); } }); return out; }
  });

  D('check-if-word-is-valid-after-substitutions', {
    t: 'Check If Word Is Valid After Substitutions',
    r: 'Push characters; whenever the top three are "a", "b", "c", pop them. Valid iff the stack ends empty.',
    g: R => { let s = ''; for (let i = 0; i < R.int(1, 3); i++) { const p = R.int(0, s.length); s = s.slice(0, p) + 'abc' + s.slice(p); } if (R.chance(0.3)) s = R.shuffle([...s]).join(''); return { s }; },
    s(I, T) { const st = []; [...I.s].forEach((c, i) => { st.push(c); const hit = st.length >= 3 && st.slice(-3).join('') === 'abc'; if (hit) st.length -= 3; if (i < 7) { T.at({ s: A([...I.s], { i }), stack: S(st.slice()) }); T.yn('Did "abc" just complete?', hit, 'Then remove it.'); } }); return st.length === 0; }
  });

  D('clumsy-factorial', {
    t: 'Clumsy Factorial',
    r: 'Apply * / + − in rotation with a stack: * and / combine with the top (floor division of positives), + pushes, − pushes the negation. Sum the stack.',
    g: R => ({ n: R.int(1, 12) }),
    s(I, T) { const st = [I.n]; let k = 0; for (let x = I.n - 1; x >= 1; x--, k++) { const op = k % 4; if (op === 0) st.push(st.pop() * x); else if (op === 1) { const t = st.pop(); st.push(t < 0 ? -Math.floor(-t / x) : Math.floor(t / x)); } else if (op === 2) st.push(x); else st.push(-x); if (k < 5) { T.at({ op: '*/+-'[op], x, stack: S(st.slice()) }); T.n('Top of the stack?', st[st.length - 1], 'Multiply/divide combine; +/− push.'); } } return st.reduce((a, b) => a + b, 0); }
  });

  D('remove-outermost-parentheses', {
    t: 'Remove Outermost Parentheses',
    r: 'Track depth: keep "(" when depth was already > 0 before it, and ")" when depth stays > 0 after it.',
    g: R => ({ s: Array.from({ length: R.int(1, 3) }, () => genParens(R, R.int(1, 3))).join('') }),
    s(I, T) { let d = 0, out = ''; [...I.s].forEach((c, i) => { let keep; if (c === '(') { keep = d > 0; d++; } else { d--; keep = d > 0; } if (keep) out += c; if (i < 7) { T.at({ s: A([...I.s], { i }) }); T.yn('Keep this character?', keep, 'Drop the outermost pair of each primitive.'); } }); return out; }
  });

  D('parsing-a-boolean-expression', {
    t: 'Parsing A Boolean Expression',
    r: 'Push characters (skipping commas). On ")", pop values until "(", pop the operator, apply it (! not, & all, | any), and push the result.',
    g: R => { const gen = d => { if (d === 0 || R.chance(0.3)) return R.pick(['t', 'f']); const op = R.pick(['!', '&', '|']); if (op === '!') return '!(' + gen(d - 1) + ')'; return op + '(' + Array.from({ length: R.int(1, 3) }, () => gen(d - 1)).join(',') + ')'; }; return { expression: gen(3) }; },
    s(I, T) { const st = []; let k = 0; for (const c of I.expression) { if (c === ',') continue; if (c !== ')') { st.push(c); continue; } const vals = []; while (st[st.length - 1] !== '(') vals.push(st.pop()); st.pop(); const op = st.pop(), v = op === '!' ? (vals[0] === 'f') : op === '&' ? vals.every(x => x === 't') : vals.some(x => x === 't'); st.push(v ? 't' : 'f'); if (k++ < 5) { T.at({ expr: X(I.expression), operands: A(vals.reverse()) }); T.yn(`Result of ${op}(…)?`, v, op === '!' ? 'Negate.' : op === '&' ? 'All true.' : 'Any true.'); } } return st[0] === 't'; }
  });

  D('maximum-nesting-depth-of-two-valid-parentheses-strings', {
    t: 'Maximum Nesting Depth of Two Valid Parentheses Strings',
    r: 'Alternate nesting levels between A and B: give "(" at depth d (after opening) to group d % 2, and its matching ")" the same group. Each half then has depth ⌈depth/2⌉.',
    g: R => ({ seq: genParens(R, R.int(1, 5)) }),
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== I.seq.length) return false; const a = [...I.seq].filter((_, i) => o[i] === 0).join(''), b = [...I.seq].filter((_, i) => o[i] === 1).join(''); if (!o.every(x => x === 0 || x === 1) || !vps(a) || !vps(b)) return false; return Math.max(depth(a), depth(b)) === Math.ceil(depth(I.seq) / 2); },
    s(I, T) { let d = 0; return [...I.seq].map((c, i) => { let g; if (c === '(') { d++; g = d % 2; } else { g = d % 2; d--; } if (i < 6) { T.at({ seq: A([...I.seq], { i }) }); T.n('Group for this character?', g, 'Depth parity.'); } return g; }); }
  });

  D('reverse-substrings-between-each-pair-of-parentheses', {
    t: 'Reverse Substrings Between Each Pair of Parentheses',
    r: 'Stack of partial strings: "(" pushes the current string and starts a new one; ")" reverses the current string and appends it to the popped one.',
    g: R => { const gen = d => Array.from({ length: R.int(1, 2) }, () => d > 0 && R.chance(0.5) ? '(' + gen(d - 1) + ')' : R.str(R.int(1, 3), 'abcd')).join(''); return { s: gen(3) }; },
    s(I, T) { const st = []; let cur = '', k = 0; for (const c of I.s) { if (c === '(') { st.push(cur); cur = ''; } else if (c === ')') { cur = st.pop() + [...cur].reverse().join(''); if (k++ < 4) { T.at({ s: X(I.s), stack: S(st.slice()) }); T.c('Current string after this ")"?', [...new Set([cur, [...cur].reverse().join('')])], cur, 'Reverse the inner part, append to the outer.'); } } else cur += c; } return cur; }
  });
})();
