/* v2 games: Fenwick / segment trees (02). */
(function () {
  'use strict';
  const { D, A } = LCGame.H;
  const MOD = 1000000007;
  const kadane = a => { let b = -Infinity, c = 0; for (const x of a) { c = Math.max(x, c + x); b = Math.max(b, c); } return b; };

  D('maximum-balanced-subsequence-sum', {
    t: 'Maximum Balanced Subsequence Sum',
    r: 'The condition is nums[i] − i non-decreasing along the subsequence. dp[i] = nums[i] + max(0, best dp[j] with key[j] ≤ key[i]) — a Fenwick max over compressed keys.',
    g: R => ({ nums: R.ints(R.int(1, 7), -5, 8) }),
    s(I, T) { const a = I.nums, k = a.map((x, i) => x - i), dp = []; a.forEach((x, i) => { let m = 0; for (let j = 0; j < i; j++) if (k[j] <= k[i]) m = Math.max(m, dp[j]); dp[i] = x + m; if (i < 6) { T.at({ key: A(k, { i }) }); T.n('Best balanced sum ending here?', dp[i], 'nums[i] + best earlier with key ≤ key[i] (or 0).'); } }); return Math.max(...dp); }
  });

  D('find-building-where-alice-and-bob-can-meet', {
    t: 'Find Building Where Alice and Bob Can Meet',
    r: 'With a ≤ b: if a = b or heights[a] < heights[b], answer b. Otherwise find the leftmost j > b with heights[j] > max(heights[a], heights[b]) — offline with a monotonic stack or a segment-tree descent.',
    g: R => { const h = R.ints(R.int(1, 7), 1, 9); return { heights: h, queries: Array.from({ length: R.int(1, 4) }, () => [R.int(0, h.length - 1), R.int(0, h.length - 1)]) }; },
    s(I, T) { const h = I.heights; return I.queries.map(([a, b], q) => { let ans = -1; for (let j = Math.max(a, b); j < h.length; j++) if ((j === a || h[a] < h[j]) && (j === b || h[b] < h[j])) { ans = j; break; } if (q < 4) { T.at({ heights: A(h, { a, b }) }); T.n('Leftmost meeting building (−1 if none)?', ans, 'Both must be able to jump there (or already be there).'); } return ans; }); }
  });

  D('maximum-number-of-intersections-on-the-chart', {
    t: 'Maximum Number of Intersections on the Chart',
    r: 'Each segment covers a y-interval; a horizontal line meets it once, but a shared vertex counts once. Sweep events on doubled coordinates (half-open intervals to avoid double counting) and take the max coverage.',
    g: R => { const y = [R.int(1, 5)]; for (let i = R.int(1, 6); i > 0; i--) { let v; do v = R.int(1, 5); while (v === y[y.length - 1]); y.push(v); } return { y }; },
    s(I, T) { const y = I.y, lo = Math.min(...y) * 2, hi = Math.max(...y) * 2; let best = 0; for (let c = lo; c <= hi; c++) { let k = 0; for (let i = 0; i + 1 < y.length; i++) { const a = Math.min(y[i], y[i + 1]) * 2, b = Math.max(y[i], y[i + 1]) * 2; if (a < c && c < b) k++; } y.forEach(v => { if (v * 2 === c) k++; }); best = Math.max(best, k); if (c % 2 === 1 && c < lo + 8) { T.at({ y: A(y), line: `y = ${c / 2}` }); T.n('Intersections at this height?', k, 'Segments crossing strictly + vertices on the line.'); } } return best; }
  });

  D('distribute-elements-into-two-arrays-ii', {
    t: 'Distribute Elements Into Two Arrays II',
    r: 'greaterCount needs "how many elements > val" in each array as they grow — two Fenwick trees over compressed values. Compare counts, then sizes, then default to arr1.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 6) }),
    s(I, T) { const a = [I.nums[0]], b = [I.nums[1]]; for (let i = 2; i < I.nums.length; i++) { const v = I.nums[i], ga = a.filter(x => x > v).length, gb = b.filter(x => x > v).length, toA = ga > gb || (ga === gb && a.length <= b.length); if (i < 7) { T.at({ arr1: A(a.slice()), arr2: A(b.slice()), val: v }); T.yn('Goes to arr1?', toA, `greater counts ${ga} vs ${gb}; then sizes.`); } (toA ? a : b).push(v); } return [...a, ...b]; }
  });

  D('find-the-index-of-permutation', {
    t: 'Find the Index of Permutation',
    r: 'Lehmer code: index = Σ (# unused values smaller than perm[i]) × (n − 1 − i)!. A Fenwick tree counts the smaller unused values. Mod 1e9+7.',
    g: R => ({ perm: R.perm(R.int(1, 6)).map(x => x + 1) }),
    s(I, T) { const n = I.perm.length, f = [1]; for (let i = 1; i <= n; i++) f[i] = f[i - 1] * i; let idx = 0; I.perm.forEach((x, i) => { const c = I.perm.slice(i + 1).filter(y => y < x).length; idx += c * f[n - 1 - i]; T.at({ perm: A(I.perm, { i }) }); T.n('Unused values smaller than this one?', c, `Each contributes ${f[n - 1 - i]} = (n−1−i)!.`); }); return idx % MOD; }
  });

  D('block-placement-queries', {
    t: 'Block Placement Queries',
    r: 'Maintain obstacles in a sorted set and a segment tree storing, at each obstacle, the gap to the previous one. For [2, x, sz]: max(range-max gap up to x, x − last obstacle ≤ x) ≥ sz.',
    g: R => ({ queries: Array.from({ length: R.int(1, 6) }, () => R.chance(0.5) ? [1, R.int(1, 9)] : [2, R.int(1, 10), R.int(1, 5)]).filter((q, i, arr) => q[0] === 2 || !arr.slice(0, i).some(p => p[0] === 1 && p[1] === q[1])).concat([[2, R.int(1, 10), R.int(1, 5)]]) }),
    s(I, T) { const ob = [], out = []; I.queries.forEach(q => { if (q[0] === 1) { ob.push(q[1]); return; } const [, x, sz] = q, ps = [0, ...ob.filter(o => o <= x).sort((a, b) => a - b), x]; let g = 0; for (let i = 1; i < ps.length; i++) g = Math.max(g, ps[i] - ps[i - 1]); const ok = g >= sz; if (out.length < 5) { T.at({ obstacles: A(ob.slice().sort((a, b) => a - b)), query: `x=${x}, sz=${sz}` }); T.n('Largest free gap in [0, x]?', g, 'Gaps between consecutive obstacles, and to x.'); } out.push(ok); }); return out; }
  });

  D('maximum-sum-of-subsequence-with-non-adjacent-elements', {
    t: 'Maximum Sum of Subsequence With Non-adjacent Elements',
    r: 'A segment tree whose nodes store four values: best sum with/without taking the leftmost and rightmost element. Point updates recombine in O(log n); the root gives each answer. Sum answers mod 1e9+7.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, -4, 8), queries: Array.from({ length: R.int(1, 4) }, () => [R.int(0, n - 1), R.int(-4, 8)]) }; },
    s(I, T) { const a = I.nums.slice(); let tot = 0; I.queries.forEach(([p, x], q) => { a[p] = x; let t = 0, s = 0; for (const v of a) [t, s] = [s + v, Math.max(t, s)]; const best = Math.max(t, s, 0); tot += best; if (q < 4) { T.at({ nums: A(a.slice(), { i: p }) }); T.n('Best non-adjacent sum now?', best, 'Root of the 2×2 segment tree.'); } }); return tot % MOD; }
  });

  D('find-subarray-with-bitwise-or-closest-to-k', {
    t: 'Find Subarray With Bitwise OR Closest to K',
    r: 'ORs of subarrays ending at r take at most ~30 distinct values; carry that set forward (or binary search on a sparse/segment tree). Track min |k − OR|.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 12), k: R.int(1, 15) }),
    s(I, T) { let set = new Set(), best = Infinity; I.nums.forEach((x, i) => { set = new Set([x, ...[...set].map(v => v | x)]); const m = Math.min(...[...set].map(v => Math.abs(I.k - v))); best = Math.min(best, m); if (i < 5) { T.at({ nums: A(I.nums, { i }), ors: A([...set].sort((a, b) => a - b)) }); T.n('Closest |k − OR| ending here?', m, 'Check every distinct OR value.'); } }); return best; }
  });

  D('peaks-in-array', {
    t: 'Peaks in Array',
    r: 'Fenwick tree over isPeak[i]. Query [l, r] = peaks strictly inside (l, r). An update at idx can only change peak status at idx − 1, idx, idx + 1.',
    g: R => { const n = R.int(3, 7); return { nums: R.ints(n, 1, 6), queries: Array.from({ length: R.int(1, 4) }, () => { if (R.chance(0.5)) { const l = R.int(0, n - 1); return [1, l, R.int(l, n - 1)]; } return [2, R.int(0, n - 1), R.int(1, 6)]; }).concat([[1, 0, n - 1]]) }; },
    s(I, T) { const a = I.nums.slice(), out = []; I.queries.forEach(q => { if (q[0] === 2) { a[q[1]] = q[2]; return; } const [, l, r] = q; let c = 0; for (let i = l + 1; i < r; i++) if (a[i] > a[i - 1] && a[i] > a[i + 1]) c++; if (out.length < 4) { T.at({ nums: A(a.slice(), { l, r }) }); T.n('Peaks strictly inside the range?', c, 'Endpoints of the subarray never count.'); } out.push(c); }); return out; }
  });

  D('number-of-subarrays-with-and-value-of-k', {
    t: 'Number of Subarrays With AND Value of K',
    r: 'ANDs of subarrays ending at r form at most ~30 distinct values; keep a map value → count and carry it forward, adding the count for value k at each r.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 7), k: R.int(0, 7) }),
    s(I, T) { let m = new Map(), c = 0; I.nums.forEach((x, i) => { const n = new Map([[x, 1]]); m.forEach((v, key) => n.set(key & x, (n.get(key & x) || 0) + v)); m = n; const add = m.get(I.k) || 0; c += add; if (i < 5) { T.at({ nums: A(I.nums, { i }) }); T.n('Subarrays ending here with AND = k?', add, 'Lookup in the carried AND map.'); } }); return c; }
  });

  D('alternating-groups-iii', {
    t: 'Alternating Groups III',
    r: 'Track maximal alternating runs around the circle (ordered set of break points) and a Fenwick tree over run lengths; a run of length L contributes L − size + 1 groups. A fully alternating circle contributes n.',
    g: R => { const n = R.int(4, 7); return { colors: R.ints(n, 0, 1), queries: Array.from({ length: R.int(1, 4) }, () => R.chance(0.5) ? [2, R.int(0, n - 1), R.int(0, 1)] : [1, R.int(3, n - 1)]).concat([[1, R.int(3, n - 1)]]) }; },
    s(I, T) { const a = I.colors.slice(), n = a.length, out = []; I.queries.forEach(q => { if (q[0] === 2) { a[q[1]] = q[2]; return; } const sz = q[1]; let c = 0; for (let s = 0; s < n; s++) { let ok = true; for (let j = 0; j + 1 < sz; j++) if (a[(s + j) % n] === a[(s + j + 1) % n]) { ok = false; break; } if (ok) c++; } if (out.length < 4) { T.at({ colors: A(a.slice()), size: sz }); T.n('Alternating groups of this size?', c, 'Count valid start positions around the circle.'); } out.push(c); }); return out; }
  });

  D('minimum-number-of-valid-strings-to-form-target-ii', {
    t: 'Minimum Number of Valid Strings to Form Target II',
    r: 'For each position i, compute the longest prefix of any word matching target[i..] (Z-function / hashing). Then it is a jump game: greedy over reach intervals gives the min pieces, or −1.',
    g: R => ({ words: Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 4), 'ab')), target: R.str(R.int(1, 7), 'ab') }),
    s(I, T) { const t = I.target, n = t.length, reach = []; for (let i = 0; i < n; i++) { let m = 0; I.words.forEach(w => { let k = 0; while (k < w.length && i + k < n && w[k] === t[i + k]) k++; m = Math.max(m, k); }); reach[i] = m; if (i < 5) { T.at({ target: A([...t], { i }) }); T.n('Longest word-prefix match starting here?', m, 'Jump length available from i.'); } } const dp = Array(n + 1).fill(Infinity); dp[0] = 0; for (let i = 0; i < n; i++) if (dp[i] < Infinity) for (let k = 1; k <= reach[i]; k++) dp[i + k] = Math.min(dp[i + k], dp[i] + 1); return dp[n] === Infinity ? -1 : dp[n]; }
  });

  D('maximum-area-rectangle-with-point-constraints-ii', {
    t: 'Maximum Area Rectangle With Point Constraints II',
    r: 'Candidate rectangles come from points adjacent in x-sorted columns and their y-neighbors; a Fenwick tree over y (offline sweep) verifies no other point lies inside or on the border. −1 if none.',
    g: R => { const pts = new Set(); for (let k = R.int(3, 7); k > 0; k--) pts.add(R.int(0, 4) + ',' + R.int(0, 4)); const p = [...pts].map(s => s.split(',').map(Number)); return { xCoord: p.map(q => q[0]), yCoord: p.map(q => q[1]) }; },
    s(I, T) { const P = I.xCoord.map((x, i) => [x, I.yCoord[i]]), has = new Set(P.map(p => p + '')); let best = -1, shown = 0; for (const [x1, y1] of P) for (const [x2, y2] of P) { if (x2 <= x1 || y2 <= y1 || !has.has([x1, y2] + '') || !has.has([x2, y1] + '')) continue; const ok = P.filter(([x, y]) => x >= x1 && x <= x2 && y >= y1 && y <= y2).length === 4; if (shown++ < 3) { T.at({ rect: `(${x1},${y1})–(${x2},${y2})` }); T.yn('Valid (no other point inside or on the border)?', ok, 'Exactly the four corners may lie in it.'); } if (ok) best = Math.max(best, (x2 - x1) * (y2 - y1)); } if (!shown) { T.at({ points: A(P.map(p => `(${p})`)) }); T.n('Rectangles with all four corners present?', 0, 'No axis-aligned corner set exists, so the answer is −1.'); } return best; }
  });

  D('maximize-subarray-sum-after-removing-all-occurrences-of-one-element', {
    t: 'Maximize Subarray Sum After Removing All Occurrences of One Element',
    r: 'Segment tree storing max-subarray info (sum, best prefix, best suffix, best). Removing value x = setting its positions to 0-length; evaluate each candidate negative x by point updates and restore. Array must stay non-empty.',
    g: R => ({ nums: R.ints(R.int(1, 7), -4, 5) }),
    s(I, T) { let best = kadane(I.nums); T.at({ nums: A(I.nums) }); T.n('Max subarray sum with no removal?', best, 'Kadane.'); [...new Set(I.nums)].forEach(x => { const b = I.nums.filter(y => y !== x); if (b.length) best = Math.max(best, kadane(b)); }); return best; }
  });

  D('count-non-decreasing-subarrays-after-k-operations', {
    t: 'Count Non-Decreasing Subarrays After K Operations',
    r: 'Cost of a subarray = Σ (running max − nums[i]). Cost is monotone in window size, so two pointers work; a monotonic stack (or segment tree) maintains the cost as the window shrinks/grows.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 7), k: R.int(0, 6) }),
    s(I, T) { const a = I.nums, n = a.length; let c = 0; for (let l = 0; l < n; l++) { let mx = 0, cost = 0, cnt = 0; for (let r = l; r < n; r++) { mx = Math.max(mx, a[r]); cost += mx - a[r]; if (cost > I.k) break; cnt++; } c += cnt; if (l < 5) { T.at({ nums: A(a, { i: l }) }); T.n('Valid subarrays starting here?', cnt, 'Extend while running-max cost ≤ k.'); } } return c; }
  });

  D('separate-squares-ii', {
    t: 'Separate Squares II',
    r: 'Sweep y: between consecutive event y-values the covered x-width of the union is constant (segment tree over compressed x). Accumulate area strip by strip and solve linearly inside the strip where it reaches half.',
    cmp: 'float',
    g: R => ({ squares: Array.from({ length: R.int(1, 4) }, () => [R.int(0, 5), R.int(0, 5), R.int(1, 3)]) }),
    s(I, T) { const S = I.squares, ys = [...new Set(S.flatMap(([, y, l]) => [y, y + l]))].sort((a, b) => a - b), width = (a, b) => { const iv = S.filter(([, y, l]) => y <= a && b <= y + l).map(([x, , l]) => [x, x + l]).sort((p, q) => p[0] - q[0]); let w = 0, cur = -Infinity; for (const [p, q] of iv) { if (q <= cur) continue; w += q - Math.max(p, cur); cur = q; } return w; }; const strips = []; let total = 0; for (let i = 0; i + 1 < ys.length; i++) { const w = width(ys[i], ys[i + 1]); strips.push([ys[i], ys[i + 1], w]); total += w * (ys[i + 1] - ys[i]); } T.at({ squares: A(S.map(s => s.join(','))) }); T.n('Total union area?', total, 'Σ strip width × strip height.'); let cum = 0; const half = total / 2; for (const [a, b, w] of strips) { if (cum + w * (b - a) >= half) return a + (half - cum) / w; cum += w * (b - a); } return ys[ys.length - 1]; }
  });

  D('fruits-into-baskets-iii', {
    t: 'Fruits Into Baskets III',
    r: 'Segment tree of basket capacities (range max). For each fruit, descend to the leftmost basket with capacity ≥ fruit, then set it to 0. Count unplaced fruits.',
    g: R => { const n = R.int(1, 6); return { fruits: R.ints(n, 1, 8), baskets: R.ints(n, 1, 8) }; },
    s(I, T) { const b = I.baskets.slice(); let un = 0; I.fruits.forEach((f, i) => { const j = b.findIndex(c => c >= f); if (j < 0) un++; else b[j] = 0; if (i < 5) { T.at({ baskets: A(b.slice()), fruit: f }); T.n('Basket index used (−1 if none)?', j, 'Leftmost capacity ≥ fruit via segment-tree descent.'); } }); return un; }
  });

  D('maximize-subarrays-after-removing-one-conflicting-pair', {
    t: 'Maximize Subarrays After Removing One Conflicting Pair',
    r: 'For each left end l, the subarray can extend up to (smallest b among pairs with a ≥ l) − 1. Track the smallest and second-smallest b; removing the pair that owns the smallest gains (second − smallest) for those l. Pick the pair with the largest total gain.',
    g: R => { const n = R.int(2, 6); return { n, conflictingPairs: Array.from({ length: R.int(1, 3) }, () => { const a = R.int(1, n - 1); return [a, R.int(a + 1, n)]; }) }; },
    s(I, T) { const n = I.n, count = pairs => { let c = 0; for (let l = 1; l <= n; l++) { let lim = n + 1; pairs.forEach(([a, b]) => { const x = Math.min(a, b), y = Math.max(a, b); if (x >= l) lim = Math.min(lim, y); }); c += lim - l; } return c; }; let best = 0; I.conflictingPairs.forEach((p, i) => { const rest = I.conflictingPairs.filter((_, j) => j !== i), v = count(rest); best = Math.max(best, v); if (i < 4) { T.at({ removed: `[${p.join(', ')}]` }); T.n('Valid subarrays after removing this pair?', v, 'Σ over l of (limit − l).'); } }); return best; }
  });
})();
