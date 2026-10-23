/* v2 games: Fenwick / segment trees (01). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const MOD = 1000000007;
  const BIT = n => { const t = Array(n + 1).fill(0); return { add(i, v) { for (i++; i <= n; i += i & -i) t[i] += v; }, sum(i) { let s = 0; for (i++; i > 0; i -= i & -i) s += t[i]; return s; } }; };

  D('count-of-smaller-numbers-after-self', {
    t: 'Count of Smaller Numbers After Self',
    r: 'Scan from the right with a Fenwick tree over value ranks: counts[i] = how many already-inserted values are strictly smaller; then insert nums[i].',
    g: R => ({ nums: R.ints(R.int(1, 7), -3, 6) }),
    s(I, T) { const v = [...new Set(I.nums)].sort((a, b) => a - b), rk = x => v.indexOf(x), b = BIT(v.length), out = []; for (let i = I.nums.length - 1; i >= 0; i--) { out[i] = rk(I.nums[i]) ? b.sum(rk(I.nums[i]) - 1) : 0; if (I.nums.length - i <= 5) { T.at({ nums: A(I.nums, { i }) }); T.n('Smaller values to the right?', out[i], 'Fenwick prefix count of smaller ranks.'); } b.add(rk(I.nums[i]), 1); } return out; }
  });

  D('count-of-range-sum', {
    t: 'Count of Range Sum',
    r: 'With prefix sums P, a range (i, j] qualifies iff lower ≤ P[j] − P[i] ≤ upper. For each j count earlier P[i] in [P[j] − upper, P[j] − lower] (Fenwick tree or merge sort).',
    g: R => { const lo = R.int(-3, 2); return { nums: R.ints(R.int(1, 6), -4, 5), lower: lo, upper: lo + R.int(0, 4) }; },
    s(I, T) { const P = [0]; I.nums.forEach(x => P.push(P[P.length - 1] + x)); let c = 0; for (let j = 1; j < P.length; j++) { const k = P.slice(0, j).filter(p => P[j] - I.upper <= p && p <= P[j] - I.lower).length; c += k; if (j <= 5) { T.at({ prefix: A(P, { i: j }), window: `[${P[j] - I.upper}, ${P[j] - I.lower}]` }); T.n('Earlier prefixes in the window?', k, 'Each one starts a valid range ending here.'); } } return c; }
  });

  D('reverse-pairs', {
    t: 'Reverse Pairs',
    r: 'Merge sort: before merging two sorted halves, for each left element count right elements with left > 2·right using a moving pointer. Sum across levels.',
    g: R => ({ nums: R.ints(R.int(1, 7), -4, 9) }),
    s(I, T) { let k = 0; const go = a => { if (a.length < 2) return [a, 0]; const m = a.length >> 1, [l, c1] = go(a.slice(0, m)), [r, c2] = go(a.slice(m)); let c = 0, j = 0; for (const x of l) { while (j < r.length && x > 2 * r[j]) j++; c += j; } if (k++ < 4) { T.at({ left: A(l), right: A(r) }); T.n('Cross pairs with left > 2·right?', c, 'Two-pointer count on sorted halves.'); } const out = []; let i = 0; j = 0; while (i < l.length || j < r.length) out.push(j >= r.length || (i < l.length && l[i] <= r[j]) ? l[i++] : r[j++]); return [out, c1 + c2 + c]; }; return go(I.nums)[1]; }
  });

  D('falling-squares', {
    t: 'Falling Squares',
    r: 'For each square [left, side], its base is the max height over [left, left + side) among landed squares (segment tree with range max/assign); its top = base + side. Report the running maximum.',
    g: R => ({ positions: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 8), R.int(1, 4)]) }),
    s(I, T) { const sq = []; let best = 0; return I.positions.map(([l, s], i) => { let base = 0; sq.forEach(([a, b, h]) => { if (a < l + s && l < b) base = Math.max(base, h); }); sq.push([l, l + s, base + s]); best = Math.max(best, base + s); if (i < 5) { T.at({ square: `[${l}, ${l + s}) side ${s}` }); T.n('Height it lands on?', base, 'Max top among overlapping squares.'); } return best; }); }
  });

  D('rectangle-area-ii', {
    t: 'Rectangle Area II',
    r: 'Coordinate-compress x and y; sweep over x-strips and, for each strip, measure the covered y-length (segment tree of cover counts). Area = Σ width × covered length, mod 1e9+7.',
    g: R => ({ rectangles: Array.from({ length: R.int(1, 4) }, () => { const x = R.int(0, 5), y = R.int(0, 5); return [x, y, x + R.int(1, 4), y + R.int(1, 4)]; }) }),
    s(I, T) { const xs = [...new Set(I.rectangles.flatMap(r => [r[0], r[2]]))].sort((a, b) => a - b); let area = 0n; for (let i = 0; i + 1 < xs.length; i++) { const w = xs[i + 1] - xs[i], ys = I.rectangles.filter(r => r[0] <= xs[i] && xs[i + 1] <= r[2]).map(r => [r[1], r[3]]).sort((a, b) => a[0] - b[0]); let cov = 0, cur = -Infinity; for (const [a, b] of ys) { if (b <= cur) continue; cov += b - Math.max(a, cur); cur = b; } area += BigInt(w) * BigInt(cov); if (i < 5) { T.at({ strip: `x ∈ [${xs[i]}, ${xs[i + 1]}]` }); T.n('Covered y-length in this strip?', cov, 'Union of active y-intervals.'); } } return Number(area % BigInt(MOD)); }
  });

  D('create-sorted-array-through-instructions', {
    t: 'Create Sorted Array through Instructions',
    r: 'Insert values one by one into a Fenwick tree over values. Each insertion costs min(#strictly less, #strictly greater) already present. Sum mod 1e9+7.',
    g: R => ({ instructions: R.ints(R.int(1, 8), 1, 6) }),
    s(I, T) { const b = BIT(7); let c = 0; I.instructions.forEach((x, i) => { const less = b.sum(x - 1), greater = i - b.sum(x), cost = Math.min(less, greater); c += cost; b.add(x, 1); if (i < 6) { T.at({ instructions: A(I.instructions, { i }) }); T.n('Cost of this insertion?', cost, `min(less ${less}, greater ${greater}).`); } }); return c % MOD; }
  });

  D('count-good-triplets-in-an-array', {
    t: 'Count Good Triplets in an Array',
    r: 'Map each value to its position in nums2, then walk nums1: for each middle element, (# earlier with smaller nums2 position) × (# later with larger position) — both from a Fenwick tree.',
    g: R => { const n = R.int(3, 6); return { nums1: R.perm(n), nums2: R.perm(n) }; },
    s(I, T) { const n = I.nums1.length, pos = []; I.nums2.forEach((v, i) => pos[v] = i); const p = I.nums1.map(v => pos[v]); let tot = 0; p.forEach((x, i) => { const left = p.slice(0, i).filter(y => y < x).length, right = (n - 1 - x) - (i - left); tot += left * right; if (i < 6) { T.at({ positionsIn2: A(p, { i }) }); T.n('Good triplets with this as the middle?', left * right, `${left} smaller before × ${right} larger after.`); } }); return tot; }
  });

  D('minimum-number-of-moves-to-make-palindrome', {
    t: 'Minimum Number of Moves to Make Palindrome',
    r: 'Greedy: match the first character with its last occurrence and move that one to the end (cost = distance). If it has no partner (the odd middle char), it costs ⌊len/2⌋ to move to the center. Repeat on the inner string.',
    g: R => { const h = [...R.str(R.int(1, 4), 'abc')]; const mid = R.chance(0.4) ? [R.pick(['a', 'b', 'c'])] : []; return { s: R.shuffle([...h, ...mid, ...h]).join('') }; },
    s(I, T) { let s = [...I.s], ans = 0, k = 0; while (s.length) { const j = s.lastIndexOf(s[0]); let c; if (j === 0) { c = Math.floor(s.length / 2); s.shift(); } else { c = s.length - 1 - j; s.splice(j, 1); s.shift(); } ans += c; if (k++ < 5) { T.at({ remaining: A(s.slice()) }); T.n('Swaps for this step?', c, 'Move the partner to the end (or the lone char to the middle).'); } } return ans; }
  });

  D('longest-substring-of-one-repeating-character', {
    t: 'Longest Substring of One Repeating Character',
    r: 'A segment tree stores, per node, its longest run plus the runs touching its left and right ends. A point update recomputes O(log n) nodes; the root holds the answer.',
    g: R => { const s = R.str(R.int(1, 7), 'ab'), k = R.int(1, 4); return { s, queryCharacters: R.str(k, 'abc'), queryIndices: R.ints(k, 0, s.length - 1) }; },
    s(I, T) { const a = [...I.s]; return I.queryIndices.map((i, q) => { a[i] = I.queryCharacters[q]; let best = 0, run = 0; a.forEach((c, j) => { run = j && a[j - 1] === c ? run + 1 : 1; best = Math.max(best, run); }); if (q < 5) { T.at({ s: A(a.slice(), { i }) }); T.n('Longest one-character run?', best, 'Root of the segment tree.'); } return best; }); }
  });

  D('count-number-of-rectangles-containing-each-point', {
    t: 'Count Number of Rectangles Containing Each Point',
    r: 'Heights are small (≤ 100): bucket rectangle lengths by height and sort each bucket. For point (x, y), sum over heights ≥ y the count of lengths ≥ x via binary search.',
    g: R => ({ rectangles: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 6), R.int(1, 5)]), points: Array.from({ length: R.int(1, 4) }, () => [R.int(1, 6), R.int(1, 5)]) }),
    s(I, T) { return I.points.map(([x, y], i) => { const c = I.rectangles.filter(([l, h]) => l >= x && h >= y).length; if (i < 4) { T.at({ point: `(${x}, ${y})`, rects: A(I.rectangles.map(r => r.join('×'))) }); T.n('Rectangles containing it?', c, 'l ≥ x and h ≥ y.'); } return c; }); }
  });

  D('longest-increasing-subsequence-ii', {
    t: 'Longest Increasing Subsequence II',
    r: 'dp[v] = longest valid subsequence ending with value v. For x, dp[x] = 1 + max(dp over values [x − k, x − 1]) — a range-max segment tree over values.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 12), k: R.int(1, 4) }),
    s(I, T) { const dp = {}; let best = 0; I.nums.forEach((x, i) => { let m = 0; for (let v = x - I.k; v < x; v++) m = Math.max(m, dp[v] || 0); dp[x] = Math.max(dp[x] || 0, m + 1); best = Math.max(best, dp[x]); if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.n(`Longest valid subsequence ending in ${x}?`, m + 1, `1 + max over values [${x - I.k}, ${x - 1}].`); } }); return best; }
  });

  D('number-of-pairs-satisfying-inequality', {
    t: 'Number of Pairs Satisfying Inequality',
    r: 'Rewrite with d[i] = nums1[i] − nums2[i]: count i < j with d[i] ≤ d[j] + diff. Scan j, querying a Fenwick tree (or merge sort) for earlier d[i] ≤ d[j] + diff.',
    g: R => { const n = R.int(2, 6); return { nums1: R.ints(n, -3, 5), nums2: R.ints(n, -3, 5), diff: R.int(-2, 2) }; },
    s(I, T) { const d = I.nums1.map((v, i) => v - I.nums2[i]); let c = 0; d.forEach((x, j) => { const k = d.slice(0, j).filter(y => y <= x + I.diff).length; c += k; if (j < 6) { T.at({ d: A(d, { i: j }) }); T.n('Earlier d[i] ≤ d[j] + diff?', k, 'Fenwick query.'); } }); return c; }
  });

  D('count-the-number-of-k-big-indices', {
    t: 'Count the Number of K-Big Indices',
    r: 'Index i is k-big if at least k smaller values lie before it and at least k after. Two Fenwick sweeps (left-to-right and right-to-left) count smaller values on each side.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6), k: R.int(1, 2) }),
    s(I, T) { let c = 0; I.nums.forEach((x, i) => { const l = I.nums.slice(0, i).filter(y => y < x).length, r = I.nums.slice(i + 1).filter(y => y < x).length, ok = l >= I.k && r >= I.k; if (ok) c++; if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.yn('k-big?', ok, `${l} smaller before, ${r} after.`); } }); return c; }
  });

  D('handling-sum-queries-after-update', {
    t: 'Handling Sum Queries After Update',
    r: 'Keep sum(nums2) directly. Type 2 adds p × (number of 1s in nums1), so maintain the 1-count with a lazy segment tree supporting range flips (type 1). Type 3 reports the sum.',
    g: R => { const n = R.int(1, 5); return { nums1: R.ints(n, 0, 1), nums2: R.ints(n, 0, 5), queries: [...Array.from({ length: R.int(1, 4) }, () => { const t = R.int(1, 3), l = R.int(0, n - 1); return t === 1 ? [1, l, R.int(l, n - 1)] : t === 2 ? [2, R.int(1, 3), 0] : [3, 0, 0]; }), [3, 0, 0]] }; },
    s(I, T) { const a = I.nums1.slice(); let s = I.nums2.reduce((x, y) => x + y, 0); const out = []; I.queries.forEach(([t, x, y], i) => { if (t === 1) for (let j = x; j <= y; j++) a[j] ^= 1; else if (t === 2) s += x * a.reduce((p, q) => p + q, 0); else out.push(s); if (i < 5) { T.at({ nums1: A(a.slice()), query: `[${t}, ${x}, ${y}]` }); T.n('Sum of nums2 now?', s, 'Type 2 adds p × (ones in nums1).'); } }); return out; }
  });

  D('make-array-empty', {
    t: 'Make Array Empty',
    r: 'Elements are removed in sorted order. Moving from one removed position to the next costs the number of still-present elements passed (Fenwick tree); wrapping around costs a full pass of the remaining ones.',
    g: R => ({ nums: R.distinct(R.int(1, 6), -5, 9) }),
    s(I, T) { const q = I.nums.slice(); let ops = 0, k = 0; while (q.length) { const mn = Math.min(...q); let moved = 0; while (q[0] !== mn) { q.push(q.shift()); ops++; moved++; } q.shift(); ops++; if (k++ < 5) { T.at({ queue: A(q.slice()), removed: mn }); T.n('Rotations before removing the minimum?', moved, 'Elements passed.'); } } return ops; }
  });

  D('maximum-sum-queries', {
    t: 'Maximum Sum Queries',
    r: 'Offline: sort points by nums1 descending and queries by x descending; insert points with nums1 ≥ x into a structure keyed by nums2 (monotonic stack + binary search, or a max segment tree) and query max sum with nums2 ≥ y.',
    g: R => { const n = R.int(1, 5); return { nums1: R.ints(n, 1, 9), nums2: R.ints(n, 1, 9), queries: Array.from({ length: R.int(1, 4) }, () => [R.int(1, 9), R.int(1, 9)]) }; },
    s(I, T) { return I.queries.map(([x, y], i) => { let b = -1; I.nums1.forEach((v, j) => { if (v >= x && I.nums2[j] >= y) b = Math.max(b, v + I.nums2[j]); }); if (i < 4) { T.at({ query: `x ≥ ${x}, y ≥ ${y}` }); T.n('Best nums1 + nums2 (−1 if none)?', b, 'Among points dominating the query.'); } return b; }); }
  });

  D('maximum-profitable-triplets-with-increasing-prices-i', {
    t: 'Maximum Profitable Triplets With Increasing Prices I',
    r: 'For each middle j, take the best profit to the left with a smaller price and the best to the right with a larger price (Fenwick max trees over prices). Maximize the sum; −1 if none.',
    g: R => { const n = R.int(3, 6); return { prices: R.ints(n, 1, 8), profits: R.ints(n, 1, 9) }; },
    s(I, T) { const p = I.prices, f = I.profits, n = p.length; let best = -1; for (let j = 1; j + 1 < n; j++) { const l = Math.max(-1, ...p.slice(0, j).map((x, i) => x < p[j] ? f[i] : -1)), r = Math.max(-1, ...p.slice(j + 1).map((x, i) => x > p[j] ? f[j + 1 + i] : -1)); if (l < 0 || r < 0) continue; best = Math.max(best, l + f[j] + r); T.at({ prices: A(p, { i: j }) }); T.n('Best triplet profit with this middle?', l + f[j] + r, 'Best cheaper on the left + best pricier on the right.'); } return best; }
  });

  D('subarrays-distinct-element-sum-of-squares-ii', {
    t: 'Subarrays Distinct Element Sum of Squares II',
    r: 'Sweep the right end r. Adding nums[r] increments the distinct count of every subarray starting after its previous occurrence; a lazy segment tree maintains Σ count and Σ count² under range +1.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 3) }),
    s(I, T) { const n = I.nums.length; let tot = 0; for (let r = 0; r < n; r++) { let add = 0; for (let l = 0; l <= r; l++) { const d = new Set(I.nums.slice(l, r + 1)).size; add += d * d; } tot += add; if (r < 5) { T.at({ nums: A(I.nums, { i: r }) }); T.n('Sum of squares over subarrays ending here?', add, 'Σ distinct² for each start.'); } } return tot % MOD; }
  });

  D('maximum-profitable-triplets-with-increasing-prices-ii', {
    t: 'Maximum Profitable Triplets With Increasing Prices II',
    r: 'Same as I but large: sweep left-to-right with a Fenwick max over prices for the best left profit, and right-to-left for the best right profit; combine at each middle.',
    g: R => { const n = R.int(3, 6); return { prices: R.ints(n, 1, 8), profits: R.ints(n, 1, 9) }; },
    s(I, T) { const p = I.prices, f = I.profits, n = p.length, L = [], Rt = []; for (let j = 0; j < n; j++) L[j] = Math.max(-1, ...p.slice(0, j).map((x, i) => x < p[j] ? f[i] : -1)); for (let j = n - 1; j >= 0; j--) Rt[j] = Math.max(-1, ...p.slice(j + 1).map((x, i) => x > p[j] ? f[j + 1 + i] : -1)); T.at({ prices: A(p), bestLeft: A(L) }); T.n('Best left profit for the second item?', L[1], 'Fenwick max over smaller prices.'); let best = -1; for (let j = 0; j < n; j++) if (L[j] >= 0 && Rt[j] >= 0) best = Math.max(best, L[j] + f[j] + Rt[j]); return best; }
  });
})();
