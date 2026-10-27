/* v2 games: trie (03). Guides scored in the 3483–4041 pass. */
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

  D('longest-common-prefix-of-k-strings-after-removal', {
    t: 'Longest Common Prefix of K Strings After Removal',
    r: 'Count how many words pass through every prefix (a trie). Removing words[i] lowers the count by one only on words[i]\'s own prefixes, so the answer is the deepest prefix whose adjusted count is still at least k.',
    g: R => { const n = R.int(2, 5); return { words: Array.from({ length: n }, () => R.str(R.int(1, 4), 'ab')), k: R.int(1, Math.min(3, n)) }; },
    s(I, T) { const W = I.words, k = I.k, cnt = new Map(); W.forEach(w => { for (let L = 1; L <= w.length; L++) { const p = w.slice(0, L); cnt.set(p, (cnt.get(p) || 0) + 1); } }); const board = K(Object.fromEntries([...cnt].sort((a, b) => b[0].length - a[0].length || (a[0] < b[0] ? -1 : 1)).slice(0, 8))); return W.map((w, i) => { let best = 0; if (W.length - 1 >= k) for (const [p, c] of cnt) { const cc = c - (w.startsWith(p) ? 1 : 0); if (cc >= k && p.length > best) best = p.length; } if (i < 5) { T.at({ words: A(W, { i, dim: [i] }), k, prefixCount: board }); T.n(`Remove words[${i}] = "${w}". Length of the longest prefix still shared by at least k words?`, best, W.length - 1 < k ? 'Fewer than k words remain, so the answer is 0.' : 'Subtract 1 from the counts of this word\'s own prefixes, then take the deepest prefix with count at least k.'); } return best; }); }
  });

  D('subarrays-with-xor-at-least-k', {
    t: 'Subarrays with XOR at Least K',
    r: 'With prefix XORs P, a subarray (j, i] has XOR P[i] ^ P[j]. Insert prefixes into a binary trie storing counts; for each P[i], walk the trie bit by bit against k to count earlier prefixes with P[i] ^ P[j] at least k.',
    g: R => ({ nums: R.ints(R.int(2, 6), 0, 7), k: R.int(0, 6) }),
    s(I, T) { const P = [0]; I.nums.forEach(x => P.push(P[P.length - 1] ^ x)); let tot = 0; for (let i = 1; i < P.length; i++) { let c = 0; for (let j = 0; j < i; j++) if ((P[i] ^ P[j]) >= I.k) c++; tot += c; if (i <= 6) { T.at({ nums: A(I.nums, { i: i - 1 }), prefixXor: A(P.slice(0, i + 1), { i }), k: I.k }); T.n(`Subarrays ending at index ${i - 1} with XOR at least ${I.k}?`, c, `Count earlier prefixes P[j] with P[${i}] ^ P[j] at least k.`); } } return tot; }
  });

  D('convert-number-words-to-digits', {
    t: 'Convert Number Words to Digits',
    r: 'Put the ten digit words in a trie. At each position walk the trie; if a word ends along the way (no word is a prefix of another), append its digit and jump past it, else skip one character.',
    g: R => { const W = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine']; let s = ''; for (let i = 0; i < R.int(1, 4); i++) s += R.chance(0.7) ? R.pick(W) : R.str(R.int(1, 2), 'xoet'); return { s }; },
    s(I, T) { const W = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine']; let i = 0, out = '', asks = 0; while (i < I.s.length) { const d = W.findIndex(w => I.s.startsWith(w, i)); if (asks++ < 6) { T.at({ s: A(I.s.split(''), { i }), result: out || '·' }); T.c(`What happens at index ${i}?`, ['skip one character', ...W.map((w, k) => `read "${w}" as ${k}`).filter((_, k) => k === d || [1, 2, 3].includes(k))].slice(0, 4), d < 0 ? 'skip one character' : `read "${W[d]}" as ${d}`, d < 0 ? 'No digit word starts here.' : 'The trie walk reaches a word end.'); } if (d >= 0) { out += d; i += W[d].length; } else i++; } return out; }
  });
})();
