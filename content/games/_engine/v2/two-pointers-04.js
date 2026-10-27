/* v2 games: two-pointers (04). Guides scored in the 3483–4041 pass. */
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

  D('maximum-product-of-first-and-last-elements-of-a-subsequence', {
    t: 'Maximum Product of First and Last Elements of a Subsequence',
    r: 'If the last element is at j, the first can be at any i at most j − m + 1. Sweep j and keep the max and min of nums[0 to j−m+1]; the best product with nums[j] uses one of them (sign matters).',
    g: R => { const n = R.int(2, 7); return { nums: R.ints(n, -6, 6), m: R.int(1, Math.min(3, n)) }; },
    s(I, T) { const a = I.nums, m = I.m; let mx = -Infinity, mn = Infinity, best = -Infinity; for (let j = m - 1; j < a.length; j++) { const i = j - m + 1; mx = Math.max(mx, a[i]); mn = Math.min(mn, a[i]); const v = Math.max(mx * a[j], mn * a[j]); best = Math.max(best, v); if (j - m + 1 < 6) { T.at({ nums: A(a, { i, j, win: [0, i] }), max: mx, min: mn }); T.n(`Best product with the last element at index ${j}?`, v, a[j] >= 0 ? `nums[j] at least 0 pairs with the max (${mx}).` : `nums[j] < 0 pairs with the min (${mn}).`); } } return best; }
  });

  D('flip-square-submatrix-vertically', {
    t: 'Flip Square Submatrix Vertically',
    r: 'Two row pointers, top = x and bottom = x plus k minus 1. Swap the k cells in columns y to y plus k minus 1 between them, then move both pointers inward until they meet.',
    g: R => { const m = R.int(2, 5), n = R.int(2, 4), k = R.int(2, Math.min(m, n)); return { grid: R.grid(m, n, 1, 9), x: R.int(0, m - k), y: R.int(0, n - k), k }; },
    s(I, T) { const res = (() => { const g = I.grid.map(r => r.slice()); T.at({ grid: G(I.grid), x: I.x, y: I.y, k: I.k }); T.n('Row swaps needed?', Math.floor(I.k / 2), 'Half of k, rounded down.'); for (let t = I.x, b = I.x + I.k - 1; t < b; t++, b--) { T.at({ grid: G(g.map(r => r.slice()), { hl: range(I.y, I.y + I.k).flatMap(j => [[t, j], [b, j]]) }), top: t, bottom: b }); T.n(`After swapping rows ${t} and ${b}, what is grid[${t}][${I.y}]?`, g[b][I.y], 'The bottom row\'s slice moves up.'); T.n(`And grid[${b}][${I.y + I.k - 1}]?`, g[t][I.y + I.k - 1], 'The top row\'s slice moves down.'); for (let j = I.y; j < I.y + I.k; j++) [g[t][j], g[b][j]] = [g[b][j], g[t][j]]; } if (I.k < 2) { T.at({ grid: G(g) }); T.yn('Is the grid unchanged?', true, 'A single row is its own mirror.'); } return g; })(); T.at({ grid: G(res) }); T.n(`Final value at grid[${I.x}][${I.y}]?`, res[I.x][I.y], 'It came from the bottom row of the square.'); return res; }
  });

  D('number-of-perfect-pairs', {
    t: 'Number of Perfect Pairs',
    r: 'With x = |a| at most y = |b|, the two conditions reduce to y at most 2x. Sort the absolute values and, for each right end, move the left pointer until 2 times left at least right; every index in between pairs with it.',
    g: R => ({ nums: R.ints(R.int(2, 7), -9, 9) }),
    s(I, T) { const a = I.nums.map(Math.abs).sort((x, y) => x - y); let l = 0, tot = 0; for (let r = 0; r < a.length; r++) { while (2 * a[l] < a[r]) l++; tot += r - l; if (r < 6) { T.at({ abs: A(a, { l, r }) }); T.n(`Perfect pairs with right end ${r} (|value| ${a[r]})?`, r - l, `Indices l to r−1 with 2 times |a| at least ${a[r]}.`); } } return tot; }
  });

  D('sort-array-by-absolute-value', {
    t: 'Sort Array by Absolute Value',
    r: 'Sort the values, then use two pointers at both ends: the larger absolute value sits at one of the ends, so fill the answer from the back with whichever end is bigger in magnitude.',
    cmp: (o, e) => Array.isArray(o) && o.length === e.length && o.every((v, i) => !i || Math.abs(v) >= Math.abs(o[i - 1])) && JSON.stringify(o.slice().sort((a, b) => a - b)) === JSON.stringify(e.slice().sort((a, b) => a - b)),
    g: R => ({ nums: R.ints(R.int(2, 7), -9, 9) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), out = Array(a.length); let l = 0, r = a.length - 1; for (let w = a.length - 1; w >= 0; w--) { const pickL = Math.abs(a[l]) > Math.abs(a[r]); T.at({ sorted: A(a, { l, r }), out: A(out.map(v => v === undefined ? '·' : v)) }); T.c(`Which value fills out[${w}]?`, [...new Set([a[l], a[r]])], pickL ? a[l] : a[r], 'Take the end with the larger absolute value.'); out[w] = pickL ? a[l++] : a[r--]; } return out; }
  });

  D('lexicographically-smallest-string-after-reverse', {
    t: 'Lexicographically Smallest String After Reverse',
    r: 'There are only 2n candidates: reverse the first k or the last k characters. Build each and keep the smallest (comparisons can stop at the first difference).',
    g: R => ({ s: R.str(R.int(1, 6), 'abcd') }),
    s(I, T) { const s = I.s, n = s.length, rv = x => x.split('').reverse().join(''); let bp = null, bs = null; for (let k = 1; k <= n; k++) { const a = rv(s.slice(0, k)) + s.slice(k), b = s.slice(0, n - k) + rv(s.slice(n - k)); if (bp === null || a < bp) bp = a; if (bs === null || b < bs) bs = b; } T.at({ s: A(s.split('')) }); T.n('Candidates to try?', 2 * n, 'Each k from 1 to n, once for the prefix and once for the suffix.'); T.c('Best result from reversing a prefix?', [...new Set([bp, s, rv(s), s + s[0]])], bp, 'Try every k for the first k characters.'); T.c('Best result from reversing a suffix?', [...new Set([bs, s, rv(s), s + s[0]])], bs, 'Try every k for the last k characters.'); return bp < bs ? bp : bs; }
  });

  D('lexicographically-smallest-string-after-reverse-ii', {
    t: 'Lexicographically Smallest String After Reverse II',
    r: 'Same 2n candidates as part I, but n is 1e5: compare candidates with rolling hashes plus binary search for the first difference (O(log n) each) instead of building strings.',
    g: R => ({ s: R.str(R.int(1, 7), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, rv = x => x.split('').reverse().join(''); let bp = null, bk = 0, bs = null, bq = 0; for (let k = 1; k <= n; k++) { const a = rv(s.slice(0, k)) + s.slice(k), b = s.slice(0, n - k) + rv(s.slice(n - k)); if (bp === null || a < bp) { bp = a; bk = k; } if (bs === null || b < bs) { bs = b; bq = k; } } T.at({ s: A(s.split('')) }); T.n('Best k for reversing a prefix (smallest k on ties)?', bk, `Gives "${bp}".`); T.n('Best k for reversing a suffix (smallest k on ties)?', bq, `Gives "${bs}".`); T.c('Overall smallest result?', [...new Set([bp, bs])], bp < bs ? bp : bs, 'Compare the two winners.'); return bp < bs ? bp : bs; }
  });

  D('minimum-number-of-flips-to-reverse-binary-string', {
    t: 'Minimum Number of Flips to Reverse Binary String',
    r: 'The target is s reversed, so position i must become s[n−1−i]. Walk i from the left and j from the right: each mismatched pair needs a flip on both sides (2 flips).',
    g: R => ({ n: R.int(1, 200) }),
    s(I, T) { const s = I.n.toString(2), n = s.length; let f = 0; for (let i = 0, j = n - 1; i < j; i++, j--) { const m = s[i] !== s[j]; if (m) f += 2; T.at({ bits: A(s.split(''), { i, j }), flips: f }); T.yn(`Do bits ${i} and ${j} differ?`, m, m ? 'Both must flip: +2.' : 'Already mirrored.'); } if (n < 2) { T.at({ bits: A(s.split('')) }); T.n('Flips needed for a single bit?', 0, 'A single bit is its own reverse.'); } return f; }
  });

  D('reverse-letters-then-special-characters-in-a-string', {
    t: 'Reverse Letters Then Special Characters in a String',
    r: 'Two passes of the two-pointer reverse: first swap letters from both ends (skipping non-letters), then do the same for the special characters.',
    g: R => ({ s: R.str(R.int(1, 8), 'abcd!@#') }),
    s(I, T) { const a = I.s.split(''), isL = c => /[a-z]/.test(c); let asks = 0; [isL, c => !isL(c)].forEach((ok, pass) => { let i = 0, j = a.length - 1; while (i < j) { if (!ok(a[i])) { i++; continue; } if (!ok(a[j])) { j--; continue; } if (asks++ < 4) { T.at({ s: A(a.slice(), { i, j }), pass: pass ? 'special characters' : 'letters' }); T.c(`Which character moves to index ${i}?`, [...new Set([a[j], a[i]])], a[j], 'Swap the two ends of this class.'); } [a[i], a[j]] = [a[j], a[i]]; i++; j--; } }); if (asks < 2) { T.at({ s: A(a) }); T.n('Length of the result?', a.length, 'Nothing else changes.'); T.yn('Did the string keep its length?', true, 'Reversals only move characters.'); } return a.join(''); }
  });

  D('first-matching-character-from-both-ends', {
    t: 'First Matching Character From Both Ends',
    r: 'Move i from the left and j = n − 1 − i from the right together; the first position where s[i] = s[j] is the answer (the middle of an odd string always matches itself).',
    g: R => ({ s: R.str(R.int(1, 8), 'abcd') }),
    s(I, T) { const n = I.s.length; for (let i = 0; i <= n - 1 - i; i++) { const ok = I.s[i] === I.s[n - 1 - i]; T.at({ s: A(I.s.split(''), { i, j: n - 1 - i }) }); T.yn(`Does s[${i}] match s[${n - 1 - i}]?`, ok, ok ? 'Found it.' : 'Move both pointers inward.'); if (ok) return i; } return -1; }
  });

  D('minimum-swaps-to-move-zeros-to-end', {
    t: 'Minimum Swaps to Move Zeros to End',
    r: 'With z zeros, the last z slots must end up all zeros. Each non-zero sitting in those slots needs one swap with a zero from the front, so the answer is the number of non-zeros among the last z positions.',
    g: R => ({ nums: Array.from({ length: R.int(1, 7) }, () => R.chance(0.4) ? 0 : R.int(1, 9)) }),
    s(I, T) { const n = I.nums.length, z = I.nums.filter(x => x === 0).length; T.at({ nums: A(I.nums) }); T.n('How many zeros are there?', z, 'They must fill the tail.'); const tail = I.nums.slice(n - z); T.at({ nums: A(I.nums, { win: [n - z, n - 1] }) }); T.n('How many non-zeros are there?', n - z, 'They must fill the front.'); T.n('How many non-zeros sit in the last z slots?', tail.filter(x => x).length, 'Each needs one swap.'); return tail.filter(x => x).length; }
  });

  D('limit-occurrences-in-sorted-array', {
    t: 'Limit Occurrences in Sorted Array',
    r: 'The array is sorted, so copies of a value are adjacent. Keep a write pointer; copy nums[i] only if fewer than k elements back the written value differs (write < k or nums[write − k] not equal to nums[i]).',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 4).sort((a, b) => a - b), k: R.int(1, 3) }),
    s(I, T) { const out = []; I.nums.forEach((x, i) => { const keep = out.length < I.k || out[out.length - I.k] !== x; if (i < 7) { T.at({ nums: A(I.nums, { i }), kept: A(out.slice()), k: I.k }); T.yn(`Keep nums[${i}] = ${x}?`, keep, keep ? 'Fewer than k copies written so far.' : `Already wrote ${I.k} copies.`); } if (keep) out.push(x); }); return out; }
  });

  D('subsequence-after-one-replacement', {
    t: 'Subsequence After One Replacement',
    r: 'pre[i] = where in t the greedy match of s[0 to i) ends, suf[i] = where the greedy match of s[i..] from the right begins. Replacing s[i] works if some character of t lies strictly between pre[i] and suf[i + 1], i.e. pre[i] < suf[i + 1].',
    g: R => ({ s: R.str(R.int(1, 4), 'abc'), t: R.str(R.int(1, 6), 'abc') }),
    s(I, T) { const s = I.s, t = I.t, n = s.length, pre = [0]; for (let i = 0, j = 0; i < n; i++) { while (j < t.length && t[j] !== s[i]) j++; j = j < t.length ? j + 1 : Infinity; pre.push(j); if (j === Infinity) { for (let q = i + 2; q <= n; q++) pre.push(Infinity); break; } } const suf = Array(n + 1).fill(-Infinity); suf[n] = t.length; for (let i = n - 1, j = t.length - 1; i >= 0; i--) { while (j >= 0 && t[j] !== s[i]) j--; if (j < 0) break; suf[i] = j; j--; } T.at({ s: A(s.split('')), t: A(t.split('')) }); T.yn('Is s already a subsequence of t?', pre[n] !== Infinity, 'Greedy left-to-right match.'); let ok = pre[n] !== Infinity; for (let i = 0; i < n; i++) { const can = pre[i] < suf[i + 1]; if (i < 3) { T.at({ s: A(s.split(''), { i }), t: A(t.split('')) }); T.yn(`Does replacing s[${i}] make it work?`, can, 'Needs a free character of t between the prefix match and the suffix match.'); } ok = ok || can; } return ok; }
  });

  D('aggregate-two-time-series', {
    t: 'Aggregate Two Time Series',
    r: 'Merge the two sorted timestamp lists with two pointers. At each timestamp, a series contributes its own value if it has that timestamp, else the value at its next timestamp, else 0 once it is exhausted.',
    g: R => { const mk = () => R.distinct(R.int(1, 3), 1, 9).sort((a, b) => a - b).map(t => [t, R.int(1, 5)]); return { series1: mk(), series2: mk() }; },
    s(I, T) { const a = I.series1, b = I.series2, out = []; let i = 0, j = 0; while (i < a.length || j < b.length) { const t = Math.min(i < a.length ? a[i][0] : Infinity, j < b.length ? b[j][0] : Infinity), va = i < a.length ? a[i][1] : 0, vb = j < b.length ? b[j][1] : 0; if (out.length < 5) { T.at({ series1: A(a.map(x => `${x[0]}:${x[1]}`), { i }), series2: A(b.map(x => `${x[0]}:${x[1]}`), { i: j }), time: t }); T.n(`Aggregated value at time ${t}?`, va + vb, 'Each series gives its value at or after t, or 0 if exhausted.'); } out.push([t, va + vb]); if (i < a.length && a[i][0] === t) i++; if (j < b.length && b[j][0] === t) j++; } return out; }
  });
})();
