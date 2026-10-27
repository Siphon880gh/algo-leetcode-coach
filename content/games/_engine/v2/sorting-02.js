/* v2 games: sorting (02). Guides scored in the 3483–4041 pass. */
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

  D('minimum-swaps-to-sort-by-digit-sum', {
    t: 'Minimum Swaps to Sort by Digit Sum',
    r: 'Sort by (digit sum, value) to learn where each number belongs. The positions form cycles; a cycle of length L needs L − 1 swaps, so the answer is n minus the number of cycles.',
    g: R => ({ nums: R.distinct(R.int(2, 6), 1, 60) }),
    s(I, T) { const a = I.nums, ds = x => sum(digits(x)), sorted = a.slice().sort((x, y) => ds(x) - ds(y) || x - y), to = new Map(sorted.map((v, i) => [v, i])); a.slice(0, 4).forEach((v, i) => { T.at({ nums: A(a, { i }), digitSum: A(a.map(ds)) }); T.n(`Target index of ${v}?`, to.get(v), 'Order by digit sum, then by value.'); }); const seen = Array(a.length).fill(false); let cyc = 0; for (let i = 0; i < a.length; i++) { if (seen[i]) continue; cyc++; let j = i; while (!seen[j]) { seen[j] = true; j = to.get(a[j]); } } T.at({ nums: A(a), target: A(sorted) }); T.n('How many cycles in the position mapping?', cyc, 'Follow i → target(nums[i]) until it returns; each fixed point is its own cycle.'); return a.length - cyc; }
  });

  D('smallest-subarray-to-sort-in-every-sliding-window', {
    t: 'Smallest Subarray to Sort in Every Sliding Window',
    r: 'For each window, the segment to sort runs from the first index where the window differs from its sorted copy to the last such index (or a scan: last index below the running max, first index above the running min from the right).',
    g: R => { const n = R.int(3, 7); return { nums: R.ints(n, 1, 9), k: R.int(2, n) }; },
    s(I, T) { const out = []; for (let s = 0; s + I.k <= I.nums.length; s++) { const w = I.nums.slice(s, s + I.k), so = w.slice().sort((a, b) => a - b); let l = 0, r = w.length - 1; while (l < w.length && w[l] === so[l]) l++; while (r > l && w[r] === so[r]) r--; const len = l >= w.length ? 0 : r - l + 1; if (s < 5) { T.at({ nums: A(I.nums, { win: [s, s + I.k - 1] }), sorted: A(so) }); T.n(`Shortest segment to sort in window ${s}?`, len, len ? `Mismatch from offset ${l} to ${r}.` : 'Already sorted.'); } out.push(len); } return out; }
  });

  D('minimum-absolute-difference-in-sliding-submatrix', {
    t: 'Minimum Absolute Difference in Sliding Submatrix',
    r: 'For each k × k window, collect the distinct values and sort them: the closest pair of distinct values is always adjacent in sorted order. One distinct value → 0.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 4); return { grid: R.grid(m, n, -4, 8), k: R.int(1, Math.min(m, n)) }; },
    s(I, T) { const g = I.grid, k = I.k, m = g.length, n = g[0].length, out = []; for (let i = 0; i + k <= m; i++) { const row = []; for (let j = 0; j + k <= n; j++) { const v = new Set(); for (let a = i; a < i + k; a++) for (let b = j; b < j + k; b++) v.add(g[a][b]); const s = [...v].sort((x, y) => x - y); let d = s.length < 2 ? 0 : Infinity; for (let t = 1; t < s.length; t++) d = Math.min(d, s[t] - s[t - 1]); row.push(d); const hl = []; for (let a = i; a < i + k; a++) for (let b = j; b < j + k; b++) hl.push([a, b]); T.at({ grid: G(g, { hl }), sortedDistinct: A(s) }); T.n(`Minimum difference in the window at (${i},${j})?`, d, s.length < 2 ? 'Only one distinct value.' : 'Smallest gap between neighbors in sorted order.'); } out.push(row); } return out; }
  });

  D('coupon-code-validator', {
    t: 'Coupon Code Validator',
    r: 'Keep a coupon if it is active, its business line is one of the four, and its code is non-empty with only letters, digits and underscores. Sort by business-line order, then by code.',
    g: R => { const n = R.int(2, 5), lines = ['electronics', 'grocery', 'pharmacy', 'restaurant', 'invalid']; return { code: Array.from({ length: n }, () => R.pick(['SAVE20', 'A_1', '', 'X@1', 'B2', 'ZED', 'c_9'])), businessLine: Array.from({ length: n }, () => R.pick(lines)), isActive: Array.from({ length: n }, () => R.chance(0.75)) }; },
    s(I, T) { const order = ['electronics', 'grocery', 'pharmacy', 'restaurant'], keep = []; I.code.forEach((c, i) => { const ok = /^\w+$/.test(c) && order.includes(I.businessLine[i]) && I.isActive[i]; T.at({ code: JSON.stringify(c), businessLine: I.businessLine[i], isActive: String(I.isActive[i]) }); T.yn(`Is coupon ${i} valid?`, ok, !I.isActive[i] ? 'Inactive.' : !order.includes(I.businessLine[i]) ? 'Unknown business line.' : !/^\w+$/.test(c) ? 'Code is empty or has a bad character.' : 'All three checks pass.'); if (ok) keep.push(i); }); return keep.sort((a, b) => order.indexOf(I.businessLine[a]) - order.indexOf(I.businessLine[b]) || (I.code[a] < I.code[b] ? -1 : I.code[a] > I.code[b] ? 1 : 0)).map(i => I.code[i]); }
  });

  D('sort-threats-by-severity-and-exploitability', {
    t: 'Sort Threats by Severity and Exploitability',
    r: 'Score each threat as 2 × severity + exploitability, then sort by score descending and ID ascending on ties.',
    g: R => ({ threats: R.distinct(R.int(2, 5), 101, 109).map(id => [id, R.int(1, 5), R.int(1, 5)]) }),
    s(I, T) { const sc = t => 2 * t[1] + t[2]; I.threats.forEach((t, i) => { if (i < 4) { T.at({ threat: `ID ${t[0]}: sev ${t[1]}, exp ${t[2]}` }); T.n(`Score of threat ${t[0]}?`, sc(t), '2 × sev + exp.'); } }); const out = I.threats.slice().sort((a, b) => sc(b) - sc(a) || a[0] - b[0]); T.at({ scores: K(I.threats.map(t => [t[0], sc(t)])) }); T.c('Which ID comes first?', I.threats.map(t => t[0]), out[0][0], 'Highest score; smaller ID wins ties.'); return out; }
  });

  D('maximize-sum-of-at-most-k-distinct-elements', {
    t: 'Maximize Sum of At Most K Distinct Elements',
    r: 'Drop duplicates, sort descending, and take the first k (all of them if fewer). Everything is positive, so taking more never hurts.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 9), k: R.int(1, 5) }),
    s(I, T) { const d = [...new Set(I.nums)].sort((a, b) => b - a), out = d.slice(0, I.k); T.at({ nums: A(I.nums) }); T.n('How many distinct values are there?', d.length, 'Duplicates cannot both be chosen.'); out.forEach((v, i) => { if (i < 3) { T.at({ distinctDesc: A(d, { i }), chosen: A(out.slice(0, i)) }); T.n(`Chosen value #${i + 1}?`, v, 'Next largest distinct value.'); } }); return out; }
  });

  D('maximum-alternating-sum-of-squares', {
    t: 'Maximum Alternating Sum of Squares',
    r: 'Only squares matter. Sort the squares; the ⌈n/2⌉ even positions get the largest ones (added) and the ⌊n/2⌋ odd positions get the smallest (subtracted).',
    g: R => ({ nums: R.ints(R.int(1, 7), -5, 5) }),
    s(I, T) { const sq = I.nums.map(x => x * x).sort((a, b) => b - a), e = Math.ceil(sq.length / 2), plus = sum(sq.slice(0, e)), minus = sum(sq.slice(e)); T.at({ squares: A(sq) }); T.n('How many squares are added (even positions)?', e, '⌈n/2⌉ even indices.'); T.n('Sum of the added squares?', plus, 'The largest squares go on even indices.'); T.n('Sum of the subtracted squares?', minus, 'The smallest squares go on odd indices.'); return plus - minus; }
  });

  D('count-elements-with-at-least-k-greater-values', {
    t: 'Count Elements With At Least K Greater Values',
    r: 'Sort. For each value, the number of strictly greater elements is n minus the index of its last copy minus 1 (binary search). Count values where that is at least k.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 6), k: R.int(0, n - 1) }; },
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length; let c = 0; I.nums.forEach((x, i) => { const g = a.filter(y => y > x).length; if (g >= I.k) c++; if (i < 6) { T.at({ sorted: A(a, { hl: a.map((y, j) => y > x ? j : -1).filter(j => j >= 0) }), value: x, k: I.k }); T.n(`How many elements are strictly greater than ${x}?`, g, g >= I.k ? 'Enough: qualified.' : 'Fewer than k: not qualified.'); } }); return c; }
  });

  D('sort-integers-by-binary-reflection', {
    t: 'Sort Integers by Binary Reflection',
    r: 'Compute each number\'s reflection (reverse its binary digits), then sort by (reflection, original value).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 16) }),
    s(I, T) { const rf = x => parseInt(x.toString(2).split('').reverse().join(''), 2); I.nums.slice(0, 4).forEach(x => { T.at({ x, binary: x.toString(2) }); T.n(`Binary reflection of ${x}?`, rf(x), `Reverse ${x.toString(2)} → ${x.toString(2).split('').reverse().join('')}.`); }); return I.nums.slice().sort((a, b) => rf(a) - rf(b) || a - b); }
  });

  D('sum-of-sortable-integers', {
    t: 'Sum of Sortable Integers',
    r: 'For each divisor k of n, every block must be a rotation of a sorted run (at most one cyclic descent), and after rotating, each block\'s max must not exceed the next block\'s min. Check blocks left to right.',
    g: R => ({ nums: R.ints(R.pick([2, 3, 4, 6]), 1, 6) }),
    s(I, T) { const a = I.nums, n = a.length; let tot = 0; range(1, n + 1).filter(k => n % k === 0).forEach(k => { let ok = true, prevMax = -Infinity; for (let s = 0; s < n && ok; s += k) { const b = a.slice(s, s + k); let best = null; for (let r = 0; r < k; r++) { const c = [...b.slice(r), ...b.slice(0, r)]; if (c.every((x, i) => !i || x >= c[i - 1])) { best = c; break; } } if (!best || best[0] < prevMax) ok = false; else prevMax = best[k - 1]; } if (ok) tot += k; T.at({ nums: A(a), k }); T.yn(`Is k = ${k} sortable?`, ok, ok ? 'Every block rotates into a sorted run that chains to the next.' : 'Some block cannot be rotated sorted, or blocks overlap in value.'); }); return tot; }
  });

  D('maximum-team-size-with-overlapping-intervals', {
    t: 'Maximum Team Size With Overlapping Intervals',
    r: 'The team is the leader plus everyone overlapping the leader. Sort starts and ends; intervals not overlapping i either end before start_i or start after end_i. Two binary searches give n minus those, and the best leader wins.',
    g: R => { const n = R.int(1, 6), s = R.ints(n, 0, 8); return { startTime: s, endTime: s.map(x => x + R.int(0, 4)) }; },
    s(I, T) { const n = I.startTime.length, S = I.startTime.slice().sort((a, b) => a - b), E = I.endTime.slice().sort((a, b) => a - b); let best = 0; for (let i = 0; i < n; i++) { const before = E.filter(e => e < I.startTime[i]).length, after = S.filter(s => s > I.endTime[i]).length, c = n - before - after; best = Math.max(best, c); if (i < 5) { T.at({ interval: `[${I.startTime[i]}, ${I.endTime[i]}]`, sortedStarts: A(S), sortedEnds: A(E) }); T.n(`Team size with employee ${i} as the leader?`, c, `${before} end before it, ${after} start after it.`); } } return best; }
  });

  D('maximum-value-of-concatenated-binary-segments', {
    t: 'Maximum Value of Concatenated Binary Segments',
    r: 'Order the segments with the exchange rule: X goes before Y when X followed by Y beats Y followed by X as strings (all-ones segments first, then more leading ones and fewer trailing zeros). Then build the value, as a remainder by 1e9+7, by appending bits (doubling).',
    g: R => { const n = R.int(1, 4); return { nums1: R.ints(n, 0, 3), nums0: R.ints(n, 1, 3) }; },
    s(I, T) { const res = (() => { const seg = I.nums1.map((a, i) => '1'.repeat(a) + '0'.repeat(I.nums0[i])), ord = seg.slice().sort((x, y) => (y + x).localeCompare(x + y)); T.at({ segments: A(seg) }); T.n('How many segments?', seg.length, 'One per pair of counts.'); ord.slice(0, 4).forEach((sg, i) => { T.at({ segments: A(seg), chosen: A(ord.slice(0, i)) }); T.c(`Which segment goes in position ${i}?`, [...new Set(ord.slice(i))], sg, 'Pick the one that wins the X then Y against Y then X comparison.'); }); let v = 0; for (const ch of ord.join('')) v = (v * 2 + (ch === '1' ? 1 : 0)) % MOD; return v; })(); T.n('Final value (remainder by 1e9+7)?', res, 'Double and add each bit in order.'); return res; }
  });

  D('minimum-energy-to-maintain-brightness', {
    t: 'Minimum Energy to Maintain Brightness',
    r: 'One bulb lights at most 3 positions, and c bulbs can light min(n, 3c), so every required time unit needs ⌈brightness / 3⌉ bulbs. Sort and merge the intervals to count the covered time units, then multiply.',
    g: R => { const n = R.int(1, 8); return { n, brightness: R.int(1, n), intervals: Array.from({ length: R.int(1, 4) }, () => { const s = R.int(0, 12); return [s, s + R.int(0, 4)]; }) }; },
    s(I, T) { const b = Math.min(I.brightness, I.n), per = Math.ceil(b / 3), iv = I.intervals.slice().sort((x, y) => x[0] - y[0]), mg = []; T.at({ n: I.n, brightness: b }); T.n('Bulbs needed per covered time unit?', per, 'Each bulb lights itself and its two neighbours.'); iv.forEach(([s, e], i) => { const last = mg[mg.length - 1]; if (last && s <= last[1] + 1) last[1] = Math.max(last[1], e); else mg.push([s, e]); if (i < 4) { T.at({ intervals: A(iv.map(x => `[${x}]`), { i }), merged: A(mg.map(x => `[${x}]`)) }); T.n('Covered time units so far?', sum(mg.map(x => x[1] - x[0] + 1)), 'Merge overlapping or touching intervals.'); } }); return per * sum(mg.map(x => x[1] - x[0] + 1)); }
  });

  D('maximum-subarray-sum-after-at-most-k-swaps', {
    t: 'Maximum Subarray Sum After At Most K Swaps',
    r: 'Fix the subarray. Each swap trades its smallest inside value for the largest outside value while that helps, up to k times. Grow each left end to the right and keep the inside values in a sorted structure and the outside values in another, adjusting as elements move across.',
    g: R => ({ nums: R.ints(R.int(1, 6), -5, 6), k: R.int(0, 2) }),
    s(I, T) { const a = I.nums, n = a.length, val = (l, r) => { const ins = a.slice(l, r + 1).sort((x, y) => x - y), out = a.slice(0, l).concat(a.slice(r + 1)).sort((x, y) => y - x); let s = sum(ins); for (let t = 0; t < Math.min(I.k, ins.length, out.length); t++) if (out[t] > ins[t]) s += out[t] - ins[t]; return s; }; let best = -Infinity, asks = 0; for (let l = 0; l < n; l++) for (let r = l; r < n; r++) { const v = val(l, r); best = Math.max(best, v); if (asks < 4 && (r - l === 1 || n === 1 || (asks < 2 && r === l))) { asks++; T.at({ nums: A(a, { win: [l, r] }), k: I.k }); T.n(`Best sum of window [${l}, ${r}] after up to ${I.k} swaps?`, v, 'Swap its smallest values for the biggest outside ones while that helps.'); } } return best; }
  });

  D('filter-occupied-intervals', {
    t: 'Filter Occupied Intervals',
    r: 'Sort by start and merge intervals that overlap or touch (next start ≤ current end + 1). Then cut [freeStart, freeEnd] out of each merged interval, keeping the left piece and/or right piece that survive.',
    g: R => { const f = R.int(1, 10); return { occupiedIntervals: Array.from({ length: R.int(1, 4) }, () => { const s = R.int(1, 12); return [s, s + R.int(0, 3)]; }), freeStart: f, freeEnd: f + R.int(0, 4) }; },
    s(I, T) { const fe = I.freeEnd, iv = I.occupiedIntervals.slice().sort((a, b) => a[0] - b[0]), mg = []; iv.forEach(([s, e]) => { const l = mg[mg.length - 1]; if (l && s <= l[1] + 1) l[1] = Math.max(l[1], e); else mg.push([s, e]); }); T.at({ intervals: A(iv.map(x => `[${x}]`)) }); T.n('How many intervals after merging?', mg.length, 'Merge overlapping or touching ones.'); const out = []; mg.forEach(([s, e], i) => { const before = out.length; if (s < I.freeStart) out.push([s, Math.min(e, I.freeStart - 1)]); if (e > fe) out.push([Math.max(s, fe + 1), e]); if (i < 3) { T.at({ merged: A(mg.map(x => `[${x}]`), { i }), free: `[${I.freeStart}, ${fe}]` }); T.n(`Pieces left from [${s}, ${e}]?`, out.length - before, 'Keep what lies outside the free window.'); } }); return out; }
  });

  D('sort-array-using-prefix-reversals', {
    t: 'Sort Array Using Prefix Reversals',
    r: 'n ≤ 8, so there are at most 40320 permutations. BFS from nums, where each move reverses one of the allowed prefix lengths, until the sorted permutation appears.',
    g: R => { const n = R.int(1, 4); return { nums: R.perm(n), pre: R.distinct(R.int(1, n), 1, n) }; },
    s(I, T) { const key = a => a.join(','), goal = key(range(0, I.nums.length)), d = new Map([[key(I.nums), 0]]); let fr = [I.nums], lvl = 0; T.at({ nums: A(I.nums), pre: A(I.pre) }); T.yn('Is nums already sorted?', key(I.nums) === goal, 'Then the answer is 0.'); while (fr.length && !d.has(goal)) { const nf = []; fr.forEach(a => I.pre.forEach(x => { const b = a.slice(0, x).reverse().concat(a.slice(x)); if (!d.has(key(b))) { d.set(key(b), lvl + 1); nf.push(b); } })); lvl++; if (lvl <= 3) { T.at({ level: lvl, pre: A(I.pre) }); T.n(`New permutations reached at BFS level ${lvl}?`, nf.length, 'Apply every allowed prefix reversal to the previous frontier.'); } fr = nf; } return d.has(goal) ? d.get(goal) : -1; }
  });

  D('minimum-adjacent-swaps-to-partition-array', {
    t: 'Minimum Adjacent Swaps to Partition Array',
    r: 'Label each element 0 (< a), 1 (in [a, b]) or 2 (> b). Adjacent swaps sorting the labels cost exactly the number of inversions, so sweep while counting how many larger labels were seen before each element.',
    g: R => { const a = R.int(2, 5); return { nums: R.ints(R.int(1, 7), 1, 9), a, b: a + R.int(1, 3) }; },
    s(I, T) { const lab = I.nums.map(x => x < I.a ? 0 : x > I.b ? 2 : 1), seen = [0, 0, 0]; let inv = 0; lab.forEach((c, i) => { const add = c === 0 ? seen[1] + seen[2] : c === 1 ? seen[2] : 0; if (i < 6) { T.at({ nums: A(I.nums, { i }), labels: A(lab, { i }) }); T.n(`Swaps charged to index ${i} (label ${c})?`, add, 'Count larger labels seen earlier: each must hop over it.'); } inv += add; seen[c]++; }); return inv % MOD; }
  });
})();
