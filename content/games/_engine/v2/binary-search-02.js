/* v2 games: binary search (02). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const MOD = 1000000007;
  const sorted = (R, n, lo, hi) => R.ints(n, lo, hi).sort((a, b) => a - b);
  const firstTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search left (hi = mid).' : 'Not feasible: search right (lo = mid + 1).'); asks++; } if (v) hi = mid; else lo = mid + 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };
  const lastTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi + 1) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search right (lo = mid).' : 'Not feasible: search left (hi = mid − 1).'); asks++; } if (v) lo = mid; else hi = mid - 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };
  const lowerBound = (a, x) => { let lo = 0, hi = a.length; while (lo < hi) { const m = (lo + hi) >> 1; if (a[m] < x) lo = m + 1; else hi = m; } return lo; };
  const upperBound = (a, x) => { let lo = 0, hi = a.length; while (lo < hi) { const m = (lo + hi) >> 1; if (a[m] <= x) lo = m + 1; else hi = m; } return lo; };
  const lisLen = (a, strict) => { const t = []; for (const x of a) { const i = strict ? lowerBound(t, x) : upperBound(t, x); t[i] = x; } return t.length; };

  D('leftmost-column-with-at-least-a-one', {
    t: 'Leftmost Column With a One: staircase',
    r: 'Start at the top-right. On a 1, move left (a better column); on a 0, move down. The last column where you saw a 1 is the answer.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { mat: Array.from({ length: m }, () => { const z = R.int(0, n); return Array.from({ length: n }, (_, j) => j >= z ? 1 : 0); }) }; },
    s(I, T) { const g = I.mat; let r = 0, c = g[0].length - 1, ans = -1; while (r < g.length && c >= 0) { T.at({ mat: G(g, { hl: [[r, c]] }) }); T.c('Move?', ['left', 'down'], g[r][c] ? 'left' : 'down', g[r][c] ? 'A 1: try further left.' : 'A 0: this row cannot help further left.'); if (g[r][c]) { ans = c; c--; } else r++; } return ans; }
  });

  D('minimum-number-of-days-to-make-m-bouquets', {
    t: 'Minimum Days to Make m Bouquets',
    r: 'Binary search the day d. Count bouquets of k adjacent bloomed flowers greedily; d works if that is at least m. If m times k > n, return −1.',
    g: R => ({ bloomDay: R.ints(R.int(1, 8), 1, 12), m: R.int(1, 3), k: R.int(1, 2) }),
    s(I, T) { const b = I.bloomDay; T.at({ bloomDay: A(b) }); T.yn('Are there enough flowers at all (m times k at most n)?', I.m * I.k <= b.length, `${I.m} times ${I.k} vs ${b.length}.`); if (I.m * I.k > b.length) return -1; const bq = d => { let c = 0, run = 0; for (const x of b) { run = x <= d ? run + 1 : 0; if (run === I.k) { c++; run = 0; } } return c; }; return firstTrue(Math.min(...b), Math.max(...b), d => bq(d) >= I.m, T, d => ({ bouquets: bq(d) }), d => `By day ${d}, can we make ${I.m} bouquets?`); }
  });

  D('avoid-flood-in-the-city', {
    t: 'Avoid Flood: dry the right lake on a sunny day',
    r: 'Keep sunny-day indices in a sorted set. When a full lake rains again, binary search the first sunny day after it last filled and dry that lake there; if none, flooding is unavoidable.',
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && o.length === 0; if (!Array.isArray(o) || o.length !== I.rains.length) return false; const full = new Set(); for (let i = 0; i < o.length; i++) { const r = I.rains[i]; if (r) { if (o[i] !== -1 || full.has(r)) return false; full.add(r); } else { if (o[i] < 1) return false; full.delete(o[i]); } } return true; },
    g: R => ({ rains: Array.from({ length: R.int(1, 8) }, () => R.chance(0.4) ? 0 : R.int(1, 3)) }),
    s(I, T) { const res = (() => { const r = I.rains, ans = r.map(x => x ? -1 : 1), last = new Map(), dry = []; T.at({ rains: A(r) }); T.n('Sunny days?', r.filter(x => !x).length, 'Days with 0 can dry a lake.'); for (let i = 0; i < r.length; i++) { if (!r[i]) { dry.push(i); continue; } if (last.has(r[i])) { const k = upperBound(dry, last.get(r[i])); T.at({ rains: A(r, { hl: [last.get(r[i]), i] }), sunny: A(dry) }); T.yn(`Is there a sunny day to dry lake ${r[i]} before day ${i}?`, k < dry.length, 'First sunny day after it last filled.'); if (k === dry.length) return []; ans[dry[k]] = r[i]; dry.splice(k, 1); } last.set(r[i], i); } return ans; })(); T.yn('Can every flood be avoided?', res.length > 0, 'Each refill found a sunny day in time.'); return res; }
  });

  D('range-sum-of-sorted-subarray-sums', {
    t: 'Range Sum of Sorted Subarray Sums',
    r: 'List all subarray sums, sort them, and add positions left to right (1-indexed), mod 1e9+7. Faster: binary search the k-th sum and count with two pointers.',
    g: R => { const n = R.int(1, 5), t = n * (n + 1) / 2, l = R.int(1, t); return { nums: R.ints(n, 1, 9), n, left: l, right: R.int(l, t) }; },
    s(I, T) { const res = (() => { const s = []; for (let i = 0; i < I.nums.length; i++) { let x = 0; for (let j = i; j < I.nums.length; j++) s.push(x += I.nums[j]); } s.sort((a, b) => a - b); T.at({ nums: A(I.nums) }); T.n('How many subarray sums?', s.length, 'n times n plus 1, halved.'); T.at({ sums: A(s, { win: [I.left - 1, I.right - 1] }) }); T.n(`The ${I.left}-th smallest subarray sum?`, s[I.left - 1], 'Sorted order.'); return s.slice(I.left - 1, I.right).reduce((a, b) => (a + b) % MOD, 0); })(); T.n('Sum of that range (mod 1e9+7)?', res, 'Add the sorted sums from left to right.'); return res; }
  });

  D('find-the-index-of-the-large-integer', {
    t: 'Find the Large Integer: compare halves',
    r: 'Compare the sums of two equal halves of the range (leaving out the middle if odd). The heavier half has it; if equal, it is the middle element.',
    exIn: I => ({ arr: I.arr || I.nums }),
    g: R => { const n = R.int(2, 9), v = R.int(1, 9), a = Array(n).fill(v); a[R.int(0, n - 1)] = v + R.int(1, 5); return { arr: a }; },
    s(I, T) { const a = I.arr, sum = (l, r) => a.slice(l, r + 1).reduce((x, y) => x + y, 0); let lo = 0, hi = a.length - 1; while (lo < hi) { const len = hi - lo + 1, h = Math.floor(len / 2), l1 = lo, r1 = lo + h - 1, l2 = hi - h + 1, r2 = hi, c = Math.sign(sum(l1, r1) - sum(l2, r2)); T.at({ arr: A(a, { win: [lo, hi] }) }); T.c(`compareSub(${l1},${r1},${l2},${r2})?`, ['left heavier', 'right heavier', 'equal'], c > 0 ? 'left heavier' : c < 0 ? 'right heavier' : 'equal', 'Equal means it is the left-out middle.'); if (c > 0) hi = r1; else if (c < 0) lo = l2; else return r1 + 1; } return lo; }
  });

  D('kth-missing-positive-number', {
    t: 'Kth Missing Positive Number',
    r: 'Before index i, arr[i] − i − 1 numbers are missing. Binary search the first i with that at least k; the answer is i + k.',
    g: R => ({ arr: R.distinct(R.int(1, 6), 1, 15).sort((a, b) => a - b), k: R.int(1, 8) }),
    s(I, T) { const a = I.arr, i = firstTrue(0, a.length, i => i === a.length || a[i] - i - 1 >= I.k, T, i => ({ arr: A(a, { hl: [i] }), missing: i < a.length ? a[i] - i - 1 : '—' }), i => `Are at least ${I.k} numbers missing before arr[${i}]?`); return i + I.k; }
  });

  D('magnetic-force-between-two-balls', {
    t: 'Magnetic Force Between Balls: maximize the minimum gap',
    r: 'Sort positions. Binary search gap g: greedily place balls from the left whenever the gap at least g; g works if you place at least m balls.',
    g: R => { const n = R.int(2, 7); return { position: R.distinct(n, 1, 20), m: R.int(2, n) }; },
    s(I, T) { const p = I.position.slice().sort((a, b) => a - b), cnt = g => { let c = 1, last = p[0]; for (const x of p) if (x - last >= g) { c++; last = x; } return c; }; return lastTrue(1, p[p.length - 1] - p[0], g => cnt(g) >= I.m, T, g => ({ positions: A(p), placed: cnt(g) }), g => `Can ${I.m} balls be at least ${g} apart?`); }
  });

  D('shortest-subarray-to-be-removed-to-make-array-sorted', {
    t: 'Shortest Subarray to Remove for Sorted',
    r: 'Find the longest sorted prefix [0 to l] and suffix [r to n−1]. Answer starts at min(n − l − 1, r); then two-pointer join prefix elements with suffix elements at least them.',
    g: R => ({ arr: R.ints(R.int(1, 8), 0, 9) }),
    s(I, T) { const res = (() => { const a = I.arr, n = a.length; let l = 0; while (l + 1 < n && a[l] <= a[l + 1]) l++; if (l === n - 1) { T.at({ arr: A(a) }); T.yn('Is the array already sorted?', true, 'Remove nothing.'); T.n('Last index of the sorted prefix?', l, 'It runs to the end.'); return 0; } let r = n - 1; while (r > 0 && a[r - 1] <= a[r]) r--; T.at({ arr: A(a, { win: [0, l] }) }); T.n('Last index of the sorted prefix?', l, 'Extend while non-decreasing.'); T.n('First index of the sorted suffix?', r, 'Extend left while non-decreasing.'); let best = Math.min(n - l - 1, r), j = r; for (let i = 0; i <= l; i++) { while (j < n && a[j] < a[i]) j++; best = Math.min(best, j - i - 1); } return best; })(); T.n('Shortest subarray to remove?', res, 'Join the best prefix and suffix.'); return res; }
  });

  D('special-array-with-x-elements-greater-than-or-equal-x', {
    t: 'Special Array With x Elements at least x',
    r: 'Sort; for each x in 0 to n, count elements at least x (binary search). Return x if the count equals x.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 7) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length; for (let x = 0; x <= n; x++) { const c = n - lowerBound(a, x); if (x <= 3) { T.at({ sorted: A(a), x }); T.n(`How many elements are at least ${x}?`, c, 'n − lowerBound(x).'); } if (c === x) return x; } return -1; }
  });

  D('maximum-font-to-fit-a-sentence-in-a-screen', {
    t: 'Maximum Font to Fit a Sentence',
    r: 'Width and height grow with the font size, so binary search the sorted fonts for the largest that fits. In this game FontInfo is mocked: each character is fontSize wide (plus 1 for letters after "m") and the height equals fontSize.',
    ex: false,
    g: R => ({ text: R.str(R.int(1, 6), 'aemz'), w: R.int(5, 60), h: R.int(3, 20), fonts: R.distinct(R.int(1, 6), 1, 15).sort((a, b) => a - b) }),
    s(I, T) { const W = f => [...I.text].reduce((s, c) => s + f + (c > 'm' ? 1 : 0), 0), fits = f => W(f) <= I.w && f <= I.h; const f = I.fonts; T.at({ fonts: A(f), w: I.w, h: I.h }); T.yn(`Does the smallest font ${f[0]} fit?`, fits(f[0]), `Width ${W(f[0])}, height ${f[0]}.`); if (!fits(f[0])) return -1; const i = lastTrue(0, f.length - 1, i => fits(f[i]), T, i => ({ width: W(f[i]) }), i => `Does font ${f[i]} fit?`); return f[i]; }
  });

  D('sell-diminishing-valued-colored-balls', {
    t: 'Sell Diminishing-Valued Balls',
    r: 'Binary search the threshold t such that selling every ball above t uses at most orders. Sell those (arithmetic series), then sell the remaining orders at price t.',
    g: R => { const inv = R.ints(R.int(1, 4), 1, 9); return { inventory: inv, orders: R.int(1, inv.reduce((a, b) => a + b, 0)) }; },
    s(I, T) { const inv = I.inventory, above = t => inv.reduce((s, x) => s + Math.max(0, x - t), 0); const t = firstTrue(0, Math.max(...inv), t => above(t) <= I.orders, T, t => ({ inventory: A(inv), sold: above(t) }), t => `Selling everything above ${t}: is that at most ${I.orders} balls?`); let profit = 0, left = I.orders; for (const x of inv) if (x > t) { profit += (x + t + 1) * (x - t) / 2; left -= x - t; } profit += left * t; return profit % MOD; }
  });

  D('ways-to-split-array-into-three-subarrays', {
    t: 'Ways to Split Into Three Subarrays',
    r: 'With prefix sums P, for each end i of left, mid end j must satisfy P[j] − P[i] at least P[i] and P[n] − P[j] at least P[j] − P[i]. Binary search the valid j range.',
    g: R => ({ nums: R.ints(R.int(3, 7), 0, 5) }),
    s(I, T) { const a = I.nums, n = a.length, P = [0]; for (const x of a) P.push(P[P.length - 1] + x); let tot = 0; for (let i = 1; i <= n - 2; i++) { let c = 0; for (let j = i + 1; j <= n - 1; j++) if (P[j] - P[i] >= P[i] && P[n] - P[j] >= P[j] - P[i]) c++; if (i <= 3) { T.at({ nums: A(a, { win: [0, i - 1] }), prefix: A(P) }); T.n(`Valid mid ends when left = first ${i}?`, c, 'mid from left to right.'); } tot += c; } return tot % MOD; }
  });

  D('minimum-operations-to-make-a-subsequence', {
    t: 'Make Target a Subsequence: LIS on indices',
    r: 'Map arr values to their index in target (drop others). The longest strictly increasing subsequence of those indices is the part already in order; answer = |target| − LIS.',
    g: R => ({ target: R.distinct(R.int(1, 6), 1, 9), arr: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const res = (() => { const pos = new Map(I.target.map((v, i) => [v, i])), idx = I.arr.filter(v => pos.has(v)).map(v => pos.get(v)); T.at({ target: A(I.target), indices: A(idx) }); T.n('Values of arr that appear in target?', idx.length, 'Others never help.'); const L = lisLen(idx, true); T.n('LIS length of the mapped indices?', L, 'Patience sorting with binary search.'); return I.target.length - L; })(); T.n('Fewest insertions?', res, 'Target length minus the LIS.'); return res; }
  });

  D('building-boxes', {
    t: 'Building Boxes: full pyramids, then grow the floor',
    r: 'Stack complete corner pyramids (layer i adds i(i+1) divided by 2 boxes) while they fit. Then add floor boxes one by one: the j-th new floor box lets j boxes total be added.',
    g: R => ({ n: R.int(1, 60) }),
    s(I, T) { const res = (() => { let tot = 0, floor = 0, i = 1; while (tot + i * (i + 1) / 2 <= I.n) { tot += i * (i + 1) / 2; floor = i * (i + 1) / 2; i++; } T.at({ n: I.n, boxes: tot }); T.n('Layers in the largest full pyramid?', i - 1, 'Stop before the boxes run out.'); T.n('Floor boxes of the largest full pyramid?', floor, 'Triangular number of the last full layer.'); let j = 1; while (tot < I.n) { floor++; tot += j; j++; } return floor; })(); T.n('Fewest boxes touching the floor?', res, 'Add floor boxes one at a time for the rest.'); return res; }
  });

  D('minimum-limit-of-balls-in-a-bag', {
    t: 'Minimum Limit of Balls in a Bag',
    r: 'Binary search penalty p: a bag of x needs (x divided by p, rounded up) − 1 splits. p works if total splits at most maxOperations.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 20), maxOperations: R.int(1, 6) }),
    s(I, T) { const ops = p => I.nums.reduce((s, x) => s + Math.ceil(x / p) - 1, 0); return firstTrue(1, Math.max(...I.nums), p => ops(p) <= I.maxOperations, T, p => ({ nums: A(I.nums), splits: ops(p) }), p => `Can every bag be at most ${p} with at most ${I.maxOperations} splits?`); }
  });

  D('maximum-value-at-a-given-index-in-a-bounded-array', {
    t: 'Maximum Value at an Index With Bounded Sum',
    r: 'Binary search v at index. Each side decreases by 1 down to a floor of 1; compute its sum with arithmetic series. v works if the total at most maxSum.',
    g: R => { const n = R.int(1, 7); return { n, index: R.int(0, n - 1), maxSum: R.int(n, 30) }; },
    s(I, T) { const side = (v, len) => len <= 0 ? 0 : v - 1 >= len ? (2 * (v - 1) - len + 1) * len / 2 : (v - 1) * v / 2 + (len - (v - 1)); const need = v => v + side(v, I.index) + side(v, I.n - I.index - 1); return lastTrue(1, I.maxSum, v => need(v) <= I.maxSum, T, v => ({ total: need(v) }), v => `Is the minimum sum with nums[${I.index}] = ${v} at most ${I.maxSum}?`); }
  });

  D('minimum-absolute-sum-difference', {
    t: 'Minimum Absolute Sum Difference',
    r: 'Sort a copy of nums1. For each i, binary search the value closest to nums2[i]; the best single replacement maximizes the saving |a−b| − |best−b|.',
    g: R => { const n = R.int(1, 6); return { nums1: R.ints(n, 1, 12), nums2: R.ints(n, 1, 12) }; },
    s(I, T) { const s = I.nums1.slice().sort((a, b) => a - b); let tot = 0, save = 0; I.nums1.forEach((a, i) => { const b = I.nums2[i], d = Math.abs(a - b), k = lowerBound(s, b); let best = d; if (k < s.length) best = Math.min(best, s[k] - b); if (k) best = Math.min(best, b - s[k - 1]); tot += d; if (i < 4) { T.at({ sorted1: A(s, { hl: [k - 1, k] }), b }); T.n(`Smallest |x − ${b}| using nums1 values?`, best, 'Neighbors of the insertion point.'); } save = Math.max(save, d - best); }); return (tot - save) % MOD; }
  });

  D('closest-room', {
    t: 'Closest Room: big-enough rooms, nearest id',
    r: 'Sort queries by minSize descending and add rooms of at least that size into a sorted id list; binary search the nearest id (ties to smaller).',
    g: R => { const n = R.int(1, 5), ids = R.distinct(n, 1, 12); return { rooms: ids.map(id => [id, R.int(1, 6)]), queries: Array.from({ length: R.int(1, 3) }, () => [R.int(1, 12), R.int(1, 6)]) }; },
    s(I, T) { return I.queries.map(([p, ms]) => { const ids = I.rooms.filter(r => r[1] >= ms).map(r => r[0]).sort((a, b) => a - b); let best = -1; for (const id of ids) if (best < 0 || Math.abs(id - p) < Math.abs(best - p) || (Math.abs(id - p) === Math.abs(best - p) && id < best)) best = id; T.at({ eligibleIds: A(ids), preferred: p }); T.n(`Rooms with size at least ${ms}?`, ids.length, 'Filter by size.'); return best; }); }
  });

  D('maximum-distance-between-a-pair-of-values', {
    t: 'Maximum Distance Between a Pair of Values',
    r: 'Both arrays are non-increasing. Two pointers: if nums1[i] at most nums2[j], record j − i and advance j; else advance i.',
    g: R => ({ nums1: R.ints(R.int(1, 6), 1, 9).sort((a, b) => b - a), nums2: R.ints(R.int(1, 6), 1, 9).sort((a, b) => b - a) }),
    s(I, T) { let i = 0, j = 0, best = 0, asks = 0; while (i < I.nums1.length && j < I.nums2.length && asks++ < 10) { const ok = I.nums1[i] <= I.nums2[j]; T.at({ nums1: A(I.nums1, { hl: [i] }), nums2: A(I.nums2, { hl: [j] }) }); T.c(`nums1[${i}] = ${I.nums1[i]} vs nums2[${j}] = ${I.nums2[j]}: move?`, ['j++', 'i++'], ok ? 'j++' : 'i++', ok ? 'Valid pair: try a farther j.' : 'Too big: move i.'); if (ok) { if (j >= i) best = Math.max(best, j - i); j++; } else i++; } while (i < I.nums1.length && j < I.nums2.length) { if (I.nums1[i] <= I.nums2[j]) { if (j >= i) best = Math.max(best, j - i); j++; } else i++; } return best; }
  });

  D('sum-of-floored-pairs', {
    t: 'Sum of Floored Pairs',
    r: 'Count values with a frequency prefix array. For each distinct d, numbers in [k times d, (k+1) times d) contribute k each: add cnt(d) times k times count in range. Mod 1e9+7.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 12) }),
    s(I, T) { let tot = 0; const d = [...new Set(I.nums)].sort((a, b) => a - b); for (const x of d) { const c = I.nums.filter(v => v === x).length; let row = 0; for (const v of I.nums) row += Math.floor(v / x); T.at({ nums: A(I.nums), divisor: x }); T.n(`the sum of v divided by ${x}, rounded down over all v?`, row, 'Sum by multiples ranges.'); tot += c * row; } return tot % MOD; }
  });

  D('minimum-speed-to-arrive-on-time', {
    t: 'Minimum Speed to Arrive on Time',
    r: 'Each ride but the last waits until the next integer hour. Binary search speed s: time = the sum of d divided by s, rounded up (all but last) + last divided by s; s works if time at most hour.',
    g: R => { const n = R.int(1, 4); return { dist: R.ints(n, 1, 9), hour: R.int(n - 1, n + 4) + R.pick([0, 0.5, 0.25]) || 1 }; },
    s(I, T) { const d = I.dist, n = d.length, H = Math.round(I.hour * 100); if (H <= (n - 1) * 100) { T.at({ dist: A(d), hour: I.hour }); T.yn(`Is ${I.hour} more than the ${n - 1} forced whole hours?`, false, 'Impossible.'); return -1; } const ok = s => { let t = 0; for (let i = 0; i < n - 1; i++) t += Math.ceil(d[i] / s); return t * 100 * s + d[n - 1] * 100 <= H * s; }; return firstTrue(1, 10000000, ok, T, null, s => `Can speed ${s} arrive on time?`); }
  });

  D('count-pairs-in-two-arrays', {
    t: 'Count Pairs in Two Arrays',
    r: 'Let d[i] = nums1[i] − nums2[i]; count pairs i < j with d[i] + d[j] > 0. Sort d and use two pointers (or binary search the partner).',
    g: R => { const n = R.int(1, 7); return { nums1: R.ints(n, 1, 9), nums2: R.ints(n, 1, 9) }; },
    s(I, T) { const d = I.nums1.map((x, i) => x - I.nums2[i]).sort((a, b) => a - b); let l = 0, r = d.length - 1, c = 0; while (l < r) { const ok = d[l] + d[r] > 0; T.at({ diffs: A(d, { hl: [l, r] }) }); T.yn(`Is ${d[l]} + ${d[r]} > 0?`, ok, ok ? `All ${r - l} partners of d[r] from l work.` : 'Move l right.'); if (ok) { c += r - l; r--; } else l++; } if (d.length < 2) { T.at({ diffs: A(d) }); T.n('Pairs with one element?', 0, 'Need two indices.'); } return c; }
  });

  D('minimum-space-wasted-from-packaging', {
    t: 'Minimum Space Wasted From Packaging',
    r: 'Sort packages with prefix sums. For each supplier (sorted boxes), each box takes the packages in (previous box, box] found by binary search: waste += box times count − their sum. Skip suppliers whose largest box is too small.',
    g: R => ({ packages: R.ints(R.int(1, 5), 1, 9), boxes: Array.from({ length: R.int(1, 3) }, () => R.distinct(R.int(1, 3), 1, 10)) }),
    s(I, T) { const p = I.packages.slice().sort((a, b) => a - b), P = [0]; p.forEach(x => P.push(P[P.length - 1] + x)); let best = Infinity; I.boxes.forEach((bx, s) => { const b = bx.slice().sort((x, y) => x - y); const ok = b[b.length - 1] >= p[p.length - 1]; T.at({ packages: A(p), boxes: A(b) }); T.yn(`Can supplier ${s} fit every package?`, ok, 'Largest box vs largest package.'); if (!ok) return; let w = 0, prev = 0; for (const x of b) { const k = upperBound(p, x); w += x * (k - prev) - (P[k] - P[prev]); prev = k; } best = Math.min(best, w); }); return best === Infinity ? -1 : best % MOD; }
  });

  D('cutting-ribbons', {
    t: 'Cutting Ribbons',
    r: 'Binary search length L: pieces = the sum of r divided by L, rounded down. The largest L with pieces at least k is the answer (0 if none).',
    g: R => ({ ribbons: R.ints(R.int(1, 4), 1, 15), k: R.int(1, 8) }),
    s(I, T) { const pc = L => I.ribbons.reduce((s, r) => s + Math.floor(r / L), 0); return lastTrue(0, Math.max(...I.ribbons), L => L === 0 || pc(L) >= I.k, T, L => ({ ribbons: A(I.ribbons), pieces: L ? pc(L) : '—' }), L => `Can we get ${I.k} pieces of length ${L}?`); }
  });

  D('find-the-student-that-will-replace-the-chalk', {
    t: 'Student Who Replaces the Chalk',
    r: 'Full rounds don\'t matter: k mod total. Then binary search the prefix sums for the first student whose prefix exceeds the remainder.',
    g: R => ({ chalk: R.ints(R.int(1, 5), 1, 6), k: R.int(1, 60) }),
    s(I, T) { const res = (() => { const tot = I.chalk.reduce((a, b) => a + b, 0), r = I.k % tot, P = []; let s = 0; for (const c of I.chalk) P.push(s += c); T.at({ chalk: A(I.chalk), prefix: A(P) }); T.n('Chalk used per full round?', tot, 'Sum of all students.'); T.n('Chalk left after full rounds?', r, `Remainder of ${I.k} divided by ${tot}.`); return upperBound(P, r); })(); T.n('Student who replaces the chalk?', res, 'First prefix sum above the leftover chalk.'); return res; }
  });

  D('maximum-number-of-removable-characters', {
    t: 'Maximum Removable Characters',
    r: 'Binary search k: remove the first k indices in removable and check whether p is still a subsequence of s.',
    g: R => { const s = R.str(R.int(2, 8), 'abc'); const p = [...s].filter(() => R.chance(0.4)).join('') || s[0]; return { s, p, removable: R.shuffle([...Array(s.length).keys()]).slice(0, R.int(0, s.length - 1)) }; },
    s(I, T) { const res = (() => { const ok = k => { const gone = new Set(I.removable.slice(0, k)); let j = 0; for (let i = 0; i < I.s.length && j < I.p.length; i++) if (!gone.has(i) && I.s[i] === I.p[j]) j++; return j === I.p.length; }; return lastTrue(0, I.removable.length, ok, T, k => ({ s: A([...I.s], { hl: I.removable.slice(0, k) }), p: I.p }), k => `After removing the first ${k} indices, is p still a subsequence?`); })(); T.n('Most characters you can remove?', res, 'The largest k that keeps p a subsequence.'); return res; }
  });

  D('find-a-peak-element-ii', {
    t: 'Find a Peak Element II: binary search columns',
    r: 'Binary search a column: take its maximum row. If the right neighbor is bigger go right; if the left is bigger go left; otherwise it is a peak.',
    cmp: (o, e, I) => { if (!Array.isArray(o)) return false; const [r, c] = o, g = I.mat, v = g[r] && g[r][c]; if (v === undefined) return false; return [[0, 1], [1, 0], [0, -1], [-1, 0]].every(([dr, dc]) => { const x = g[r + dr] && g[r + dr][c + dc]; return x === undefined || x < v; }); },
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), v = R.shuffle([...Array(m * n).keys()].map(x => x + 1)); return { mat: Array.from({ length: m }, (_, i) => v.slice(i * n, i * n + n)) }; },
    s(I, T) { const res = (() => { const g = I.mat, n = g[0].length; let lo = 0, hi = n - 1; for (;;) { const c = (lo + hi) >> 1; let r = 0; for (let i = 1; i < g.length; i++) if (g[i][c] > g[r][c]) r = i; const L = c ? g[r][c - 1] : -1, Rr = c + 1 < n ? g[r][c + 1] : -1, mv = Rr > g[r][c] ? 'right' : L > g[r][c] ? 'left' : 'peak'; T.at({ mat: G(g, { hl: [[r, c]] }) }); T.c(`The max of column ${c} is ${g[r][c]}. Which way next?`, ['left', 'right', 'peak'], mv, 'Move toward a bigger neighbor.'); if (mv === 'peak') return [r, c]; if (mv === 'right') lo = c + 1; else hi = c - 1; } })(); T.n('Value at the peak?', I.mat[res[0]][res[1]], 'Bigger than all its neighbours.'); return res; }
  });

  D('kth-smallest-subarray-sum', {
    t: 'Kth Smallest Subarray Sum',
    r: 'Binary search s: count subarrays with sum at most s using a sliding window (all values positive). The first s with count at least k.',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, 1, 6), k: R.int(1, n * (n + 1) / 2) }; },
    s(I, T) { const a = I.nums, cnt = s => { let c = 0, l = 0, w = 0; for (let r = 0; r < a.length; r++) { w += a[r]; while (w > s) w -= a[l++]; c += r - l + 1; } return c; }; return firstTrue(Math.min(...a), a.reduce((x, y) => x + y, 0), s => cnt(s) >= I.k, T, s => ({ nums: A(a), countLE: cnt(s) }), s => `Are at least ${I.k} subarray sums at most ${s}?`); }
  });

  D('longest-common-subpath', {
    t: 'Longest Common Subpath: search the length',
    r: 'If all paths share a subpath of length L, they share one of length L − 1. Binary search L; check by intersecting sets of length-L windows (rolling hash in practice).',
    g: R => { const n = R.int(2, 5); return { n, paths: Array.from({ length: R.int(2, 3) }, () => { const p = []; for (let i = 0; i < R.int(1, 6); i++) { let v; do v = R.int(0, n - 1); while (p.length && p[p.length - 1] === v); p.push(v); } return p; }) }; },
    s(I, T) { const res = (() => { const win = (p, L) => { const s = new Set(); for (let i = 0; i + L <= p.length; i++) s.add(p.slice(i, i + L).join(',')); return s; }; const ok = L => { let s = win(I.paths[0], L); for (const p of I.paths.slice(1)) { const t = win(p, L); s = new Set([...s].filter(x => t.has(x))); } return s.size > 0; }; return lastTrue(0, Math.min(...I.paths.map(p => p.length)), L => L === 0 || ok(L), T, () => ({ paths: A(I.paths.map(p => p.join(' '))) }), L => `Do all paths share a subpath of length ${L}?`); })(); T.n('Longest common subpath?', res, 'The largest length every path shares.'); return res; }
  });

  D('minimum-garden-perimeter-to-collect-enough-apples', {
    t: 'Minimum Garden Perimeter for Enough Apples',
    r: 'A square of half-side n holds 2n(n+1)(2n+1) apples. Binary search the smallest n reaching the target; perimeter = 8n.',
    g: R => ({ neededApples: R.int(1, 2000) }),
    s(I, T) { const ap = n => 2 * n * (n + 1) * (2 * n + 1); const n = firstTrue(1, 100000, n => ap(n) >= I.neededApples, T, n => ({ apples: ap(n) }), n => `Does half-side ${n} give at least ${I.neededApples} apples?`); return 8 * n; }
  });

  D('minimum-time-for-k-virus-variants-to-spread', {
    t: 'Minimum Time for k Variants to Meet',
    r: 'A variant reaches a cell after its Manhattan distance in days. For each candidate cell, the time when k variants are present is the k-th smallest distance; take the minimum over cells (binary search on days works too).',
    g: R => { const n = R.int(2, 4); return { points: Array.from({ length: n }, () => [R.int(1, 9), R.int(1, 9)]), k: R.int(2, n) }; },
    s(I, T) { const res = (() => { const xs = I.points.map(p => p[0]), ys = I.points.map(p => p[1]); let best = Infinity; for (let x = Math.min(...xs); x <= Math.max(...xs); x++) for (let y = Math.min(...ys); y <= Math.max(...ys); y++) { const d = I.points.map(([a, b]) => Math.abs(a - x) + Math.abs(b - y)).sort((p, q) => p - q)[I.k - 1]; if (d < best) best = d; } const d0 = I.points.map(([a, b]) => Math.abs(a - I.points[0][0]) + Math.abs(b - I.points[0][1])).sort((p, q) => p - q)[I.k - 1]; T.at({ points: A(I.points.map(p => p.join(', '))), k: I.k }); T.n(`Days until ${I.k} variants are at point ${I.points[0].join(', ')}?`, d0, 'k-th smallest Manhattan distance.'); return best; })(); if (I.points.length > 1) T.n('Distance between the first two points?', Math.abs(I.points[0][0] - I.points[1][0]) + Math.abs(I.points[0][1] - I.points[1][1]), 'Manhattan distance.'); else T.n('Variants needed?', I.k, 'Given as k.'); T.n('Fewest days?', res, 'Best meeting cell over the grid.'); return res; }
  });

  D('binary-searchable-numbers-in-an-unsorted-array', {
    t: 'Binary-Searchable Numbers',
    r: 'A value is always found exactly when it is greater than everything to its left and smaller than everything to its right. Compute prefix maxima and suffix minima.',
    g: R => ({ nums: R.distinct(R.int(1, 7), -5, 9) }),
    s(I, T) { const a = I.nums, n = a.length, pm = [], sm = Array(n); let m = -Infinity; for (let i = 0; i < n; i++) { pm.push(m); m = Math.max(m, a[i]); } m = Infinity; for (let i = n - 1; i >= 0; i--) { sm[i] = m; m = Math.min(m, a[i]); } let c = 0; for (let i = 0; i < n; i++) { const ok = a[i] > pm[i] && a[i] < sm[i]; T.at({ nums: A(a, { hl: [i] }) }); T.yn(`Is ${a[i]} always found?`, ok, 'Bigger than all left, smaller than all right.'); if (ok) c++; } return c; }
  });

  D('minimum-number-of-operations-to-make-array-continuous', {
    t: 'Make Array Continuous',
    r: 'Sort unique values. For each start value x, binary search how many unique values lie in [x, x + n − 1]; keep the most and replace the rest.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12) }),
    s(I, T) { const n = I.nums.length, u = [...new Set(I.nums)].sort((a, b) => a - b); let best = 0; u.forEach((x, i) => { const c = upperBound(u, x + n - 1) - i; if (i < 4) { T.at({ unique: A(u, { win: [i, i + c - 1] }), range: `${x}..${x + n - 1}` }); T.n(`Values kept if the range starts at ${x}?`, c, 'Binary search the range end.'); } best = Math.max(best, c); }); return n - best; }
  });

  D('kth-smallest-product-of-two-sorted-arrays', {
    t: 'Kth Smallest Product of Two Sorted Arrays',
    r: 'Binary search product p; for each a in nums1 count b with a times b at most p (binary search, with direction depending on the sign of a). First p with count at least k.',
    g: R => { const a = sorted(R, R.int(1, 4), -4, 5), b = sorted(R, R.int(1, 4), -4, 5); return { nums1: a, nums2: b, k: R.int(1, a.length * b.length) }; },
    s(I, T) { const cnt = p => { let c = 0; for (const a of I.nums1) for (const b of I.nums2) if (a * b <= p) c++; return c; }; const all = []; for (const a of I.nums1) for (const b of I.nums2) all.push(a * b); return firstTrue(Math.min(...all), Math.max(...all), p => cnt(p) >= I.k, T, p => ({ countLE: cnt(p) }), p => `Are at least ${I.k} products at most ${p}?`); }
  });

  D('plates-between-candles', {
    t: 'Plates Between Candles',
    r: 'Precompute plate prefix counts, the nearest candle to the right of each index and to the left. A query counts plates between those two candles.',
    g: R => { const s = R.str(R.int(3, 10), '**|'); return { s, queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, s.length - 1); return [l, R.int(l, s.length - 1)]; }) }; },
    s(I, T) { const s = I.s, n = s.length, P = [0], L = Array(n), Rt = Array(n); for (const c of s) P.push(P[P.length - 1] + (c === '*' ? 1 : 0)); let x = -1; for (let i = 0; i < n; i++) { if (s[i] === '|') x = i; L[i] = x; } x = n; for (let i = n - 1; i >= 0; i--) { if (s[i] === '|') x = i; Rt[i] = x; } return I.queries.map(([l, r]) => { const a = Rt[l], b = L[r], v = a < b ? P[b] - P[a] : 0; T.at({ s: A([...s], { win: [l, r] }) }); T.n(`Plates between candles in [${l}, ${r}]?`, v, 'First candle at least l to last candle at most r.'); return v; }); }
  });

  D('minimized-maximum-of-products-distributed-to-any-store', {
    t: 'Minimized Maximum Products per Store',
    r: 'Binary search the cap x: product type q needs q divided by x (rounded up) stores. x works if the total at most n.',
    g: R => { const m = R.int(1, 4); return { n: R.int(m, m + 6), quantities: R.ints(m, 1, 15) }; },
    s(I, T) { const need = x => I.quantities.reduce((s, q) => s + Math.ceil(q / x), 0); return firstTrue(1, Math.max(...I.quantities), x => need(x) <= I.n, T, x => ({ quantities: A(I.quantities), stores: need(x) }), x => `With at most ${x} per store, are ${I.n} stores enough?`); }
  });

  D('most-beautiful-item-for-each-query', {
    t: 'Most Beautiful Item for Each Query',
    r: 'Sort items by price and keep a running max beauty. For each query, binary search the last price at most query and read the running max.',
    g: R => ({ items: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 8), R.int(1, 9)]), queries: R.ints(R.int(1, 4), 0, 9) }),
    s(I, T) { const it = I.items.slice().sort((a, b) => a[0] - b[0]), pr = it.map(x => x[0]), mx = []; let m = 0; for (const x of it) mx.push(m = Math.max(m, x[1])); return I.queries.map(q => { const k = upperBound(pr, q), v = k ? mx[k - 1] : 0; T.at({ prices: A(pr, { hl: [k - 1] }), bestSoFar: A(mx) }); T.n(`Best beauty with price at most ${q}?`, v, 'Running max at the last affordable item.'); return v; }); }
  });

  D('maximum-number-of-tasks-you-can-assign', {
    t: 'Maximum Tasks You Can Assign',
    r: 'Binary search k: try the k easiest tasks with the k strongest workers. Go from the hardest task down: use the strongest worker if able; otherwise give a pill to the weakest worker who can then do it.',
    g: R => ({ tasks: R.ints(R.int(1, 5), 0, 9), workers: R.ints(R.int(1, 5), 0, 9), pills: R.int(0, 2), strength: R.int(0, 5) }),
    s(I, T) { const res = (() => { const t = I.tasks.slice().sort((a, b) => a - b), w = I.workers.slice().sort((a, b) => a - b); const ok = k => { const ws = w.slice(w.length - k); let p = I.pills; for (let i = k - 1; i >= 0; i--) { if (ws[ws.length - 1] >= t[i]) { ws.pop(); continue; } if (!p) return false; const j = lowerBound(ws, t[i] - I.strength); if (j === ws.length) return false; ws.splice(j, 1); p--; } return true; }; return lastTrue(0, Math.min(t.length, w.length), k => k === 0 || ok(k), T, () => ({ tasks: A(t), workers: A(w) }), k => `Can the ${k} easiest tasks all be done?`); })(); T.n('Most tasks assigned?', res, 'The largest k that works.'); return res; }
  });

  D('maximum-fruits-harvested-after-at-most-k-steps', {
    t: 'Maximum Fruits Within k Steps',
    r: 'A reachable range [L, R] around start costs min(2 times (s−L) + (R−s), 2 times (R−s) + (s−L)) steps. Slide over ranges with prefix sums (binary search the matching end).',
    g: R => { const ps = R.distinct(R.int(1, 5), 0, 12).sort((a, b) => a - b); return { fruits: ps.map(p => [p, R.int(1, 9)]), startPos: R.int(0, 12), k: R.int(0, 8) }; },
    s(I, T) { const res = (() => { const f = I.fruits, s = I.startPos; let best = 0; const pts = [...new Set([s, ...f.map(x => x[0])])]; for (const L of pts) for (const Rr of pts) { if (L > s || Rr < s) continue; const cost = Math.min(2 * (s - L) + (Rr - s), 2 * (Rr - s) + (s - L)); if (cost > I.k) continue; best = Math.max(best, f.filter(x => x[0] >= L && x[0] <= Rr).reduce((a, x) => a + x[1], 0)); } const here = f.filter(x => x[0] === s).reduce((a, x) => a + x[1], 0); T.at({ fruits: A(f.map(x => `${x[1]} at ${x[0]}`)), start: s, k: I.k }); T.n('Fruits available without moving?', here, 'Only the start position.'); T.n('Leftmost position you could reach?', s - I.k, 'Walk left the whole way.'); return best; })(); T.n('Most fruits?', res, 'Best range you can cover in k steps.'); return res; }
  });

  D('minimum-operations-to-make-the-array-k-increasing', {
    t: 'Make the Array K-Increasing',
    r: 'Split into k chains (indices i, i + k, …). Each chain keeps its longest non-decreasing subsequence (binary search, upper bound); change the rest.',
    g: R => { const n = R.int(1, 8); return { arr: R.ints(n, 1, 6), k: R.int(1, n) }; },
    s(I, T) { let ops = 0; for (let r = 0; r < I.k; r++) { const ch = []; for (let i = r; i < I.arr.length; i += I.k) ch.push(I.arr[i]); const L = lisLen(ch, false); if (r < 4) { T.at({ chain: A(ch) }); T.n(`Longest non-decreasing subsequence of chain ${r}?`, L, 'Patience sorting with upper bound.'); } ops += ch.length - L; } return ops; }
  });
})();
