/* v2 games: sorting (01). */
(function () {
  'use strict';
  const { D, A } = LCGame.H;
  const MOD = 1000000007;
  const merge = iv => { const s = iv.slice().sort((a, b) => a[0] - b[0]), out = []; for (const [a, b] of s) { if (out.length && a <= out[out.length - 1][1]) out[out.length - 1][1] = Math.max(out[out.length - 1][1], b); else out.push([a, b]); } return out; };

  D('h-index', {
    t: 'H-Index',
    r: 'Sort citations descending; h is the largest i such that the i-th paper has at least i citations. (Counting sort makes it O(n).)',
    g: R => ({ citations: R.ints(R.int(1, 7), 0, 8) }),
    s(I, T) { const c = I.citations.slice().sort((a, b) => b - a); let h = 0; c.forEach((x, i) => { const ok = x >= i + 1; if (ok) h = i + 1; if (i < 6) { T.at({ sorted: A(c, { i }) }); T.yn(`At least ${i + 1} papers with ≥ ${i + 1} citations?`, ok, 'Compare the i-th largest with i.'); } }); return h; }
  });

  D('third-maximum-number', {
    t: 'Third Maximum Number',
    r: 'Track the top three distinct values in one pass (or sort distinct values). Return the third if it exists, otherwise the maximum.',
    g: R => ({ nums: R.ints(R.int(1, 7), -3, 6) }),
    s(I, T) { const d = [...new Set(I.nums)].sort((a, b) => b - a); T.at({ distinctDesc: A(d) }); T.n('How many distinct values?', d.length, 'Need at least three for a third maximum.'); return d.length >= 3 ? d[2] : d[0]; }
  });

  D('sort-an-array', {
    t: 'Sort an Array',
    r: 'Merge sort: split in halves, sort each recursively, merge with two pointers. O(n log n) guaranteed.',
    g: R => ({ nums: R.ints(R.int(1, 8), -5, 9) }),
    s(I, T) { let k = 0; const ms = a => { if (a.length < 2) return a; const m = a.length >> 1, l = ms(a.slice(0, m)), r = ms(a.slice(m)), o = []; let i = 0, j = 0; while (i < l.length || j < r.length) o.push(j >= r.length || (i < l.length && l[i] <= r[j]) ? l[i++] : r[j++]); if (k++ < 4) { T.at({ left: A(l), right: A(r) }); T.n('First element of the merged run?', o[0], 'Smaller of the two heads.'); } return o; }; return ms(I.nums); }
  });

  D('height-checker', {
    t: 'Height Checker',
    r: 'Sort a copy (counting sort works since heights are small) and count positions where it differs from the original.',
    g: R => ({ heights: R.ints(R.int(1, 8), 1, 6) }),
    s(I, T) { const e = I.heights.slice().sort((a, b) => a - b); let c = 0; I.heights.forEach((h, i) => { const bad = h !== e[i]; if (bad) c++; if (i < 6) { T.at({ heights: A(I.heights, { i }), expected: A(e, { i }) }); T.yn('Mismatch here?', bad, 'Compare with the sorted order.'); } }); return c; }
  });

  D('minimum-absolute-difference', {
    t: 'Minimum Absolute Difference',
    r: 'Sort; the minimum difference is between neighbours. Collect every adjacent pair achieving it, in order.',
    g: R => ({ arr: R.distinct(R.int(2, 7), -6, 12) }),
    s(I, T) { const a = I.arr.slice().sort((x, y) => x - y); let m = Infinity; for (let i = 1; i < a.length; i++) m = Math.min(m, a[i] - a[i - 1]); T.at({ sorted: A(a) }); T.n('Minimum adjacent difference?', m, 'Only neighbours in sorted order matter.'); const out = []; for (let i = 1; i < a.length; i++) if (a[i] - a[i - 1] === m) out.push([a[i - 1], a[i]]); return out; }
  });

  D('filter-restaurants-by-vegan-friendly-price-and-distance', {
    t: 'Filter Restaurants by Vegan-Friendly, Price and Distance',
    r: 'Filter by the three constraints (vegan only if required), then sort by rating desc, id desc and return ids.',
    g: R => ({ restaurants: R.distinct(R.int(1, 6), 1, 9).map(id => [id, R.int(1, 9), R.int(0, 1), R.int(10, 50), R.int(1, 10)]), veganFriendly: R.int(0, 1), maxPrice: R.int(20, 50), maxDistance: R.int(3, 10) }),
    s(I, T) { const ok = I.restaurants.filter((r, i) => { const v = (!I.veganFriendly || r[2] === 1) && r[3] <= I.maxPrice && r[4] <= I.maxDistance; if (i < 5) { T.at({ restaurant: `id ${r[0]}, rating ${r[1]}, vegan ${r[2]}, $${r[3]}, ${r[4]}km` }); T.yn('Passes the filters?', v, 'Vegan (if required), price, distance.'); } return v; }); return ok.sort((a, b) => b[1] - a[1] || b[0] - a[0]).map(r => r[0]); }
  });

  D('mean-of-array-after-removing-some-elements', {
    t: 'Mean of Array After Removing Some Elements',
    r: 'Sort, drop n/20 elements from each end, and average the rest.',
    cmp: 'float',
    g: R => ({ arr: R.ints(20 * R.int(1, 2), 0, 9) }),
    s(I, T) { const a = I.arr.slice().sort((x, y) => x - y), k = a.length / 20, mid = a.slice(k, a.length - k); T.at({ sorted: A(a) }); T.n('Elements removed from each end?', k, '5% of n.'); return mid.reduce((x, y) => x + y, 0) / mid.length; }
  });

  D('widest-vertical-area-between-two-points-containing-no-points', {
    t: 'Widest Vertical Area Between Two Points Containing No Points',
    r: 'Only x matters: sort the x-coordinates and take the largest gap between neighbours.',
    g: R => ({ points: Array.from({ length: R.int(2, 6) }, () => [R.int(0, 12), R.int(0, 9)]) }),
    s(I, T) { const xs = I.points.map(p => p[0]).sort((a, b) => a - b); let b = 0; for (let i = 1; i < xs.length; i++) { b = Math.max(b, xs[i] - xs[i - 1]); if (i < 5) { T.at({ xs: A(xs, { i }) }); T.n('Gap to the previous x?', xs[i] - xs[i - 1], 'Neighbouring x-coordinates.'); } } return b; }
  });

  D('reduction-operations-to-make-the-array-elements-equal', {
    t: 'Reduction Operations to Make the Array Elements Equal',
    r: 'Sort ascending. An element whose value is the k-th distinct value (0-based) needs exactly k operations; sum over all elements.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 5) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let rank = 0, tot = 0; a.forEach((x, i) => { if (i && x !== a[i - 1]) rank++; tot += rank; if (i < 6) { T.at({ sorted: A(a, { i }) }); T.n('Operations for this element?', rank, 'Number of distinct smaller values.'); } }); return tot; }
  });

  D('maximum-product-difference-between-two-pairs', {
    t: 'Maximum Product Difference Between Two Pairs',
    r: 'Use the two largest for (a, b) and the two smallest for (c, d). A single pass or a sort finds them.',
    g: R => ({ nums: R.ints(R.int(4, 7), 1, 10) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length; T.at({ sorted: A(a) }); T.n('Product of the two largest?', a[n - 1] * a[n - 2], 'Maximize a·b.'); return a[n - 1] * a[n - 2] - a[0] * a[1]; }
  });

  D('find-array-given-subset-sums', {
    t: 'Find Array Given Subset Sums',
    r: 'Sort sums; d = s[1] − s[0] is |some element|. Split the multiset into pairs (x, x + d). If the "without" half contains 0, the element is d; otherwise it is −d and the "with" half continues. Recurse n times.',
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== I.n) return false; let s = [0]; o.forEach(x => s = s.concat(s.map(y => y + x))); return JSON.stringify(s.sort((a, b) => a - b)) === JSON.stringify(I.sums.slice().sort((a, b) => a - b)); },
    g: R => { const a = R.ints(R.int(1, 3), -4, 4); let s = [0]; a.forEach(x => s = s.concat(s.map(y => y + x))); return { n: a.length, sums: R.shuffle(s) }; },
    s(I, T) { let s = I.sums.slice().sort((a, b) => a - b); const out = []; for (let k = 0; k < I.n; k++) { const d = s[1] - s[0], cnt = new Map(); s.forEach(x => cnt.set(x, (cnt.get(x) || 0) + 1)); const without = [], withd = []; for (const x of s) { if (!cnt.get(x)) continue; cnt.set(x, cnt.get(x) - 1); cnt.set(x + d, cnt.get(x + d) - 1); without.push(x); withd.push(x + d); } const pos = without.includes(0); T.at({ sums: A(s) }); T.n('Difference d = s[1] − s[0]?', d, 'The absolute value of one element.'); out.push(pos ? d : -d); s = pos ? without : withd; } return out; }
  });

  D('sort-even-and-odd-indices-independently', {
    t: 'Sort Even and Odd Indices Independently',
    r: 'Pull out even-index values (sort ascending) and odd-index values (sort descending), then interleave them back.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const e = I.nums.filter((_, i) => i % 2 === 0).sort((a, b) => a - b), o = I.nums.filter((_, i) => i % 2).sort((a, b) => b - a); T.at({ even: A(e), odd: A(o) }); T.n('Value placed at index 0?', e[0], 'Smallest even-index value.'); return I.nums.map((_, i) => i % 2 ? o[i >> 1] : e[i >> 1]); }
  });

  D('sort-the-jumbled-numbers', {
    t: 'Sort the Jumbled Numbers',
    r: 'Map each number digit by digit to its jumbled value, then stable-sort by the mapped value (keeping original order on ties).',
    g: R => ({ mapping: R.perm(10), nums: R.ints(R.int(1, 5), 0, 999) }),
    s(I, T) { const mv = x => +String(x).split('').map(d => I.mapping[+d]).join(''); I.nums.forEach((x, i) => { if (i < 4) { T.at({ number: x, mapping: A(I.mapping) }); T.n('Mapped value?', mv(x), 'Replace each digit, drop leading zeros.'); } }); return I.nums.map((x, i) => [mv(x), i, x]).sort((a, b) => a[0] - b[0] || a[1] - b[1]).map(p => p[2]); }
  });

  D('maximum-consecutive-floors-without-special-floors', {
    t: 'Maximum Consecutive Floors Without Special Floors',
    r: 'Sort special floors; the answer is the max of (first − bottom), gaps between consecutive specials minus one, and (top − last).',
    g: R => { const b = R.int(1, 5), t = b + R.int(0, 10); return { bottom: b, top: t, special: R.distinct(R.int(1, Math.min(4, t - b + 1)), b, t) }; },
    s(I, T) { const s = I.special.slice().sort((a, b) => a - b), gaps = [s[0] - I.bottom]; for (let i = 1; i < s.length; i++) gaps.push(s[i] - s[i - 1] - 1); gaps.push(I.top - s[s.length - 1]); T.at({ special: A(s), range: `${I.bottom}..${I.top}` }); T.n('Free floors below the first special?', gaps[0], 'first − bottom.'); return Math.max(...gaps); }
  });

  D('sort-array-by-moving-items-to-empty-space', {
    t: 'Sort Array by Moving Items to Empty Space',
    r: 'Try both targets (0 first or 0 last). For a permutation, each cycle of length L costs L − 1 if it contains the empty slot, otherwise L + 1 (borrow the empty slot). Take the cheaper target.',
    g: R => ({ nums: R.perm(R.int(2, 6)) }),
    s(I, T) { const n = I.nums.length, cost = tgt => { const pos = new Map(tgt.map((v, i) => [v, i])), seen = Array(n).fill(false); let c = 0; for (let i = 0; i < n; i++) { if (seen[i] || pos.get(I.nums[i]) === i) { seen[i] = true; continue; } let L = 0, hasZero = false, j = i; while (!seen[j]) { seen[j] = true; if (I.nums[j] === 0) hasZero = true; j = pos.get(I.nums[j]); L++; } c += hasZero ? L - 1 : L + 1; } return c; }; const a = cost([...Array(n).keys()]), b = cost([...Array(n - 1).keys()].map(x => x + 1).concat(0)); T.at({ nums: A(I.nums) }); T.n('Moves for target [0, 1, …, n−1]?', a, 'Sum of cycle costs.'); T.n('Moves for target [1, …, n−1, 0]?', b, 'Same, other target.'); return Math.min(a, b); }
  });

  D('count-ways-to-group-overlapping-ranges', {
    t: 'Count Ways to Group Overlapping Ranges',
    r: 'Sort and merge overlapping ranges into connected components; each component goes to either group: 2^components mod 1e9+7.',
    g: R => ({ ranges: Array.from({ length: R.int(1, 6) }, () => { const a = R.int(0, 12); return [a, a + R.int(0, 3)]; }) }),
    s(I, T) { const c = merge(I.ranges).length; T.at({ ranges: A(I.ranges.map(r => r.join('–'))) }); T.n('Connected components after merging?', c, 'Overlapping ranges must share a group.'); let p = 1; for (let i = 0; i < c; i++) p = p * 2 % MOD; return p; }
  });

  D('find-maximal-uncovered-ranges', {
    t: 'Find Maximal Uncovered Ranges',
    r: 'Sort ranges by start; sweep a "covered up to" pointer and emit every gap [pointer + 1, start − 1], plus the tail up to n − 1.',
    g: R => { const n = R.int(1, 12); return { n, ranges: Array.from({ length: R.int(0, 4) }, () => { const a = R.int(0, n - 1); return [a, R.int(a, n - 1)]; }) }; },
    s(I, T) { const out = []; let cur = -1; merge(I.ranges).forEach(([a, b], i) => { if (a > cur + 1) out.push([cur + 1, a - 1]); cur = Math.max(cur, b); if (i < 4) { T.at({ range: `[${a}, ${b}]`, gaps: A(out.map(g => g.join('–'))) }); T.n('Covered up to (after this range)?', cur, 'Advance the sweep pointer.'); } }); if (cur < I.n - 1) out.push([cur + 1, I.n - 1]); if (!I.ranges.length) { T.at({ n: I.n }); T.n('Length of the single uncovered range?', I.n, 'Nothing is covered.'); } return out; }
  });

  D('neither-minimum-nor-maximum', {
    t: 'Neither Minimum nor Maximum',
    r: 'Any three distinct values contain a middle one: sort the first three and return the middle; fewer than three elements → −1.',
    cmp: (o, e, I) => I.nums.length < 3 ? o === -1 : o !== Math.min(...I.nums) && o !== Math.max(...I.nums) && I.nums.includes(o),
    g: R => ({ nums: R.distinct(R.int(1, 6), 1, 12) }),
    s(I, T) { T.at({ nums: A(I.nums) }); T.yn('At least three elements?', I.nums.length >= 3, 'Otherwise every value is min or max.'); return I.nums.length < 3 ? -1 : I.nums.slice(0, 3).sort((a, b) => a - b)[1]; }
  });

  D('find-the-value-of-the-partition', {
    t: 'Find the Value of the Partition',
    r: 'The best split is between two neighbours in sorted order, so the answer is the minimum adjacent difference after sorting.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 20) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let m = Infinity; for (let i = 1; i < a.length; i++) { m = Math.min(m, a[i] - a[i - 1]); if (i < 5) { T.at({ sorted: A(a, { i }) }); T.n('Partition value splitting before this element?', a[i] - a[i - 1], 'max(left) − min(right).'); } } return m; }
  });

  D('happy-students', {
    t: 'Happy Students',
    r: 'Selecting k students only works by taking the k smallest values. k is valid iff (k = 0 or sorted[k−1] < k) and (k = n or sorted[k] > k). Count valid k.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 0, n - 1) }; },
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length; let c = 0; for (let k = 0; k <= n; k++) { const ok = (k === 0 || a[k - 1] < k) && (k === n || a[k] > k); if (ok) c++; if (k < 6) { T.at({ sorted: A(a, { k }) }); T.yn(`Can exactly ${k} students be selected?`, ok, 'Check the boundary values.'); } } return c; }
  });

  D('maximize-area-of-square-hole-in-grid', {
    t: 'Maximize Area of Square Hole in Grid',
    r: 'Sort each bar list and find its longest run of consecutive indices L; removing them opens a gap of L + 1. Side = min of both gaps; area = side².',
    g: R => { const n = R.int(1, 6), m = R.int(1, 6); return { n, m, hBars: R.distinct(R.int(1, n), 2, n + 1), vBars: R.distinct(R.int(1, m), 2, m + 1) }; },
    s(I, T) { const run = b => { const s = b.slice().sort((x, y) => x - y); let best = 1, cur = 1; for (let i = 1; i < s.length; i++) { cur = s[i] === s[i - 1] + 1 ? cur + 1 : 1; best = Math.max(best, cur); } return best + 1; }; const h = run(I.hBars), v = run(I.vBars); T.at({ hBars: A(I.hBars.slice().sort((x, y) => x - y)) }); T.n('Widest horizontal gap?', h, 'Longest consecutive run + 1.'); T.at({ vBars: A(I.vBars.slice().sort((x, y) => x - y)) }); T.n('Widest vertical gap?', v, 'Longest consecutive run + 1.'); return Math.min(h, v) ** 2; }
  });

  D('divide-an-array-into-subarrays-with-minimum-cost-i', {
    t: 'Divide an Array Into Subarrays With Minimum Cost I',
    r: 'The first subarray always starts at nums[0]; the other two starts can be any two later elements, so add the two smallest of nums[1..].',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 9) }),
    s(I, T) { const r = I.nums.slice(1).sort((a, b) => a - b); T.at({ rest: A(r) }); T.n('Smallest later start?', r[0], 'Pick the two smallest after index 0.'); return I.nums[0] + r[0] + r[1]; }
  });

  D('count-days-without-meetings', {
    t: 'Count Days Without Meetings',
    r: 'Sort and merge meeting intervals; subtract the covered length from the total days.',
    g: R => { const d = R.int(1, 15); return { days: d, meetings: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(1, d); return [a, R.int(a, d)]; }) }; },
    s(I, T) { const m = merge(I.meetings.map(([a, b]) => [a, b + 1])).map(([a, b]) => [a, b - 1]), cov = m.reduce((s, [a, b]) => s + b - a + 1, 0); T.at({ merged: A(m.map(x => x.join('–'))) }); T.n('Days covered by meetings?', cov, 'Sum of merged lengths.'); return I.days - cov; }
  });

  D('check-if-grid-can-be-cut-into-sections', {
    t: 'Check if Grid Can be Cut into Sections',
    r: 'Project rectangles onto one axis as intervals [start, end); sort and count gaps where no interval crosses. Two gaps on either axis means three sections are possible.',
    g: R => { const n = R.int(3, 6), rs = []; for (let k = R.int(1, 5); k > 0; k--) { const x = R.int(0, n - 1), y = R.int(0, n - 1), r = [x, y, R.int(x + 1, n), R.int(y + 1, n)]; if (!rs.some(q => q[0] < r[2] && r[0] < q[2] && q[1] < r[3] && r[1] < q[3])) rs.push(r); } return { n, rectangles: rs }; },
    s(I, T) { const gaps = (a, b) => { const iv = I.rectangles.map(r => [r[a], r[b]]).sort((p, q) => p[0] - q[0]); let end = iv[0][1], g = 0; for (const [s, e] of iv.slice(1)) { if (s >= end) g++; end = Math.max(end, e); } return g; }; const gx = gaps(0, 2), gy = gaps(1, 3); T.at({ xIntervals: A(I.rectangles.map(r => `${r[0]}–${r[2]}`)) }); T.n('Clean cut points along x?', gx, 'Gaps no rectangle crosses.'); T.at({ yIntervals: A(I.rectangles.map(r => `${r[1]}–${r[3]}`)) }); T.n('Clean cut points along y?', gy, 'Same along y.'); return gx >= 2 || gy >= 2; }
  });
})();
