/* v2 games: strings (8). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
(function () {
  'use strict';
  const { D, A, G, K, S, Q, X, Tr, TR, GR, LL, Ls, IV, show } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const lcm = (a, b) => a / gcd(a, b) * b;
  const MOD = 1000000007;
  const range = (a, b) => Array.from({ length: Math.max(0, b - a) }, (_, i) => a + i);
  const fmt = a => typeof a === 'string' ? JSON.stringify(a) : Array.isArray(a) ? JSON.stringify(a) : String(a);
  const digits = x => String(Math.abs(x)).split('').map(Number);
  const isPal = s => s === s.split('').reverse().join('');
  const popc = x => { let c = 0; while (x) { c += x & 1; x >>>= 1; } return c; };
  const isPrime = x => { if (x < 2) return false; for (let d = 2; d * d <= x; d++) if (x % d === 0) return false; return true; };
  // Design problems: ops[0] constructs, the rest are method calls; asks about returned values.
  // o.view(obj) -> board, o.why(op, args, r, obj) -> feedback, o.strOpts / o.arrOpts(obj, r) -> distractors, o.skip(op) -> don't ask.
  const play = (I, T, make, o) => { o = o || {}; const obj = make(...(I.args[0] || [])), out = [null]; let asks = 0; const max = o.max || 7; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], args = I.args[i] || [], before = o.view ? o.view(obj) : {}; let r = obj[op](...args); if (r === undefined) r = null; out.push(r); if (asks >= max || r === null || (o.skip && o.skip(op))) continue; const label = `${op}(${args.map(fmt).join(', ')})`, why = o.why ? o.why(op, args, r, obj) : 'Follow the structure\'s invariant.'; T.at(Object.assign({ call: label }, before)); if (typeof r === 'number' && Number.isFinite(r)) { T.n(`What does ${label} return?`, r, why); asks++; } else if (typeof r === 'boolean') { T.yn(`Does ${label} return true?`, r, why); asks++; } else if (typeof r === 'string') { const opts = [...new Set([r, ...(o.strOpts ? o.strOpts(obj, r) : []), r === '' ? 'null' : ''])].slice(0, 4); if (opts.length > 1) { T.c(`What does ${label} return?`, opts.map(x => x === '' ? '""' : x), r === '' ? '""' : r, why); asks++; } } else if (Array.isArray(r)) { const opts = o.arrOpts ? o.arrOpts(obj, r, op) : null; if (opts) { T.c(`What does ${label} return?`, [r, ...opts].map(show), show(r), why); } else T.n(`How many items does ${label} return?`, r.length, why); asks++; } } if (!asks) { T.at({ calls: I.ops.length - 1 }); T.n('How many method calls follow the constructor?', I.ops.length - 1, 'Count the operations.'); } return out; };
  const seq = (R, ctor, ctorArgs, n, step, st) => { const ops = [ctor], args = [ctorArgs]; st = st || {}; for (let i = 0; i < n; i++) { const x = step(R, st); if (!x) break; ops.push(x[0]); args.push(x[1]); } return { ops, args }; };
  // Children lists of a tree given as undirected edges ([u, v] or [u, v, w]); ids 0..n-1 (or 1..n with base 1).
  const kids = (n, edges, root, base) => { base = base || 0; const adj = Array.from({ length: n + base }, () => []); edges.forEach(e => { adj[e[0]].push([e[1], e[2]]); adj[e[1]].push([e[0], e[2]]); }); const ch = Array.from({ length: n + base }, () => []), par = Array(n + base).fill(-1), order = [root], seen = new Set([root]); for (let i = 0; i < order.length; i++) for (const [v, w] of adj[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; ch[order[i]].push(v); order.push(v); } return { ch, par, order, adj }; };

  const isPalN = x => isPal(String(x));
  const primesTo = n => { const s = Array(n + 1).fill(true), out = []; for (let i = 2; i <= n; i++) if (s[i]) { out.push(i); for (let j = i * i; j <= n; j += i) s[j] = false; } return out; };


  const utf8 = cp => cp < 0x80 ? 1 : cp < 0x800 ? 2 : cp < 0x10000 ? 3 : 4;

  D('character-encoding', {
    t: 'Character Encoding: UTF-8 Bytes',
    r: 'UTF-8 stores each code point in 1 to 4 bytes: below 128 (ASCII) uses 1 byte, below 2048 uses 2, below 65536 uses 3, the rest (like most emoji) use 4. Byte length and character count are different numbers.',
    exs: [{ in: { text: 'hi👍' }, out: 6 }, { in: { text: 'é中' }, out: 5 }],
    g: R => { const pool = ['a', 'h', 'z', 'é', 'ß', '中', '日', '€', '👍', '😀']; let s = ''; for (let i = R.int(3, 5); i > 0; i--) s += R.pick(pool); return { text: s }; },
    s(I, T) { const cs = [...I.text]; let tot = 0; cs.forEach((c, i) => { const cp = c.codePointAt(0), b = utf8(cp); tot += b; if (i < 5) { T.at({ text: A(cs, { hl: i }), 'code point': 'U+' + cp.toString(16).toUpperCase().padStart(4, '0') + ' (' + cp + ')' }); T.n(`How many UTF-8 bytes for "${c}"?`, b, cp < 128 ? 'ASCII: 1 byte.' : cp < 2048 ? 'Below 2048: 2 bytes.' : cp < 65536 ? 'Below 65536: 3 bytes.' : 'Above 65535: 4 bytes.'); } }); T.at({ text: A(cs) }); T.n('Total bytes?', tot, 'Add the bytes of every character.'); T.n('How many code points?', cs.length, 'Characters as Unicode sees them.'); return tot; }
  });

  D('offer05', {
    t: 'Replace Spaces with %20',
    r: 'Each space becomes the three characters %20, so the length grows by 2 per space. Grow the buffer, then fill it from the end with two pointers: read i from the old end, write j from the new end. Writing backward never overwrites a character not yet read.',
    exs: [{ in: { s: 'We are' }, out: 'We%20are' }, { in: { s: 'a b c' }, out: 'a%20b%20c' }],
    g: R => { let s = R.str(R.int(1, 3), 'abcd'); for (let i = R.int(1, 2); i > 0; i--) s += ' ' + R.str(R.int(1, 3), 'abcd'); return { s }; },
    s(I, T) { const s = I.s, sp = s.split(' ').length - 1, N = s.length + 2 * sp, buf = s.split('').concat(Array(2 * sp).fill('_')); T.at({ s: A(s.split('').map(c => c === ' ' ? '␣' : c)) }); T.n('How many spaces?', sp, 'Count them.'); T.n('New length?', N, `${s.length} + 2 times ${sp}.`); let j = N - 1, asked = 0; for (let i = s.length - 1; i >= 0; i--) { if (s[i] === ' ') { buf[j--] = '0'; buf[j--] = '2'; buf[j--] = '%'; if (asked < 2) { asked++; T.at({ buffer: A(buf.map(c => c === ' ' ? '␣' : c), { i, j: j + 1 }) }); T.n(`The space at index ${i} becomes %20. At which index is the % written?`, j + 1, 'Three slots back from where j was.'); } } else buf[j--] = s[i]; } return buf.join(''); }
  });

  D('offer58-ii', {
    t: 'Left Rotate a String by Reversals',
    r: 'Split s into A (the first n characters) and B (the rest). Reverse the whole string to get reverse(B) + reverse(A), then reverse each of those two parts in place. The result is B + A.',
    exs: [{ in: { s: 'abcdefg', n: 2 }, out: 'cdefgab' }],
    g: R => { const s = R.str(R.int(5, 8), 'abcdefgh'); return { s, n: R.int(1, s.length - 1) }; },
    s(I, T) { const s = I.s, n = I.n, rev = x => x.split('').reverse().join(''), all = rev(s), k = s.length - n, p1 = rev(all.slice(0, k)) + all.slice(k), fin = p1.slice(0, k) + rev(p1.slice(k)); const opt = (g, xs) => [...new Set([g, ...xs])]; T.at({ s: A(s.split(''), { win: [0, n - 1] }) }); T.c('After reversing the whole string?', opt(all, [s, rev(s.slice(n)) + s.slice(0, n), s.slice(n) + s.slice(0, n)]), all, 'Read it backward.'); T.at({ s: A(all.split(''), { win: [0, k - 1] }) }); T.c(`After reversing the first ${k} characters?`, opt(p1, [all, rev(p1), s]), p1, 'Only that part flips.'); T.at({ s: A(p1.split(''), { win: [k, s.length - 1] }) }); T.c(`After reversing the last ${n} characters?`, opt(fin, [p1, s, rev(fin)]), fin, 'That gives B + A.'); return fin; }
  });
})();
