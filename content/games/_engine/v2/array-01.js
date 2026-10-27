/* v2 games: arrays (01). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);

  D('maximum-gap', {
    t: 'Maximum Gap',
    r: 'Bucket sort by pigeonhole: with n numbers spanning [min, max], some gap is at least (max − min)/(n − 1), so use buckets of that size and only compare each bucket\'s min with the previous non-empty bucket\'s max.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 30) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length; if (n < 2) { T.at({ nums: A(a) }); T.n('How many numbers?', n, 'Need at least two for a gap.'); T.yn('Are there fewer than two?', true, 'Then the gap is 0.'); return 0; } const lo = Math.min(...a), hi = Math.max(...a); if (lo === hi) { T.at({ nums: A(a) }); T.n('Smallest value?', lo, 'Scan for the min.'); T.yn('Are all values equal?', true, 'Then every gap is 0.'); return 0; } const size = Math.max(1, Math.floor((hi - lo) / (n - 1))), cnt = Math.floor((hi - lo) / size) + 1, mn = Array(cnt).fill(Infinity), mx = Array(cnt).fill(-Infinity); a.forEach(x => { const b = Math.floor((x - lo) / size); mn[b] = Math.min(mn[b], x); mx[b] = Math.max(mx[b], x); }); T.at({ nums: A(a), min: lo, max: hi }); T.n('Bucket size?', size, '(max minus min) divided by (n minus 1), rounded down, at least 1.'); T.n('Number of buckets?', cnt, 'The range divided by the bucket size, plus 1.'); let prev = lo, best = 0; for (let b = 0; b < cnt; b++) if (mn[b] !== Infinity) { best = Math.max(best, mn[b] - prev); prev = mx[b]; } return best; })(); T.n('Maximum gap?', res, 'Next bucket min minus previous bucket max.'); return res; }
  });

  D('majority-element', {
    t: 'Majority Element',
    r: 'Boyer–Moore voting: keep a candidate and a count; a matching element adds 1, a different one subtracts 1, and at 0 the next element becomes the candidate.',
    g: R => { const n = R.int(1, 7), m = R.int(1, 5), k = Math.floor(n / 2) + 1; return { nums: R.shuffle([...Array(k).fill(m), ...R.ints(n - k, 1, 5)]) }; },
    s(I, T) { let c = null, k = 0; I.nums.forEach((x, i) => { if (k === 0) c = x; k += x === c ? 1 : -1; if (i < 7) { T.at({ nums: A(I.nums, { i }), candidate: c }); T.n('Count now?', k, '+1 if it matches, −1 otherwise.'); } }); return c; }
  });

  D('majority-element-ii', {
    t: 'Majority Element II',
    r: 'At most two values can exceed n/3. Run Boyer–Moore with two candidates, then verify each candidate\'s real count.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 4) }),
    cmp: 'set',
    s(I, T) { const res = (() => { let c1 = null, c2 = null, k1 = 0, k2 = 0; I.nums.forEach(x => { if (x === c1) k1++; else if (x === c2) k2++; else if (!k1) { c1 = x; k1 = 1; } else if (!k2) { c2 = x; k2 = 1; } else { k1--; k2--; } }); T.at({ nums: A(I.nums) }); T.n('Count a value must beat?', Math.floor(I.nums.length / 3), 'n divided by 3, rounded down.'); T.n(`Count of ${I.nums[0]}?`, I.nums.filter(x => x === I.nums[0]).length, 'Verify candidates with a second pass.'); return [...new Set([c1, c2])].filter(c => c !== null && I.nums.filter(x => x === c).length > Math.floor(I.nums.length / 3)); })(); T.n('How many values pass?', res.length, 'At most two can.'); return res; }
  });

  D('product-of-array-except-self', {
    t: 'Product of Array Except Self',
    r: 'answer[i] = (product of everything left of i) × (product of everything right of i): one pass left to right, one pass right to left.',
    g: R => ({ nums: R.ints(R.int(2, 6), -3, 4) }),
    s(I, T) { const n = I.nums.length, out = Array(n).fill(1); let p = 1; for (let i = 0; i < n; i++) { out[i] = p; if (i < 5) { T.at({ nums: A(I.nums, { i }) }); T.n('Product of everything to the left?', p || 0, 'Running prefix product.'); } p *= I.nums[i]; } p = 1; for (let i = n - 1; i >= 0; i--) { out[i] = (out[i] * p) || 0; p *= I.nums[i]; } return out; }
  });

  D('max-consecutive-ones', {
    t: 'Max Consecutive Ones',
    r: 'Keep the current run of 1s (reset on 0) and the best run seen.',
    g: R => ({ nums: R.ints(R.int(1, 10), 0, 1) }),
    s(I, T) { let c = 0, b = 0; I.nums.forEach((x, i) => { c = x ? c + 1 : 0; b = Math.max(b, c); if (i < 7) { T.at({ nums: A(I.nums, { i }) }); T.n('Current run?', c, 'Reset on 0.'); } }); return b; }
  });

  D('largest-number-at-least-twice-of-others', {
    t: 'Largest Number At Least Twice of Others',
    r: 'Find the largest and second largest. The answer is the largest\'s index if it is ≥ 2 × second, else −1.',
    g: R => ({ nums: R.distinct(R.int(1, 6), 0, 20) }),
    s(I, T) { const res = (() => { let i1 = 0; I.nums.forEach((x, i) => { if (x > I.nums[i1]) i1 = i; }); const second = Math.max(0, ...I.nums.filter((_, i) => i !== i1)); T.at({ nums: A(I.nums, { i: i1 }) }); T.n('Largest value?', I.nums[i1], 'Track its index.'); T.n('Second largest?', I.nums.length > 1 ? second : 0, 'Compare to it.'); return I.nums[i1] >= 2 * second ? i1 : -1; })(); T.n('Answer index? (−1 if not twice as big)', res, 'Largest compared with twice the second.'); return res; }
  });

  D('monotonic-array', {
    t: 'Monotonic Array',
    r: 'Track whether any step goes up and whether any step goes down; it is monotonic unless both happen.',
    g: R => ({ nums: R.chance(0.5) ? R.sorted(R.int(1, 6), 1, 9) : R.ints(R.int(1, 6), 1, 9) }),
    s(I, T) { let up = false, dn = false; for (let i = 1; i < I.nums.length; i++) { if (I.nums[i] > I.nums[i - 1]) up = true; if (I.nums[i] < I.nums[i - 1]) dn = true; if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.yn('Seen both an increase and a decrease?', up && dn, 'Then not monotonic.'); } } return !(up && dn); }
  });

  D('distance-between-bus-stops', {
    t: 'Distance Between Bus Stops',
    r: 'Sum the clockwise distance from start to destination; the counter-clockwise distance is total − that. Return the smaller.',
    g: R => { const n = R.int(1, 6); return { distance: R.ints(n, 0, 9), start: R.int(0, n - 1), destination: R.int(0, n - 1) }; },
    s(I, T) { const res = (() => { const [a, b] = [Math.min(I.start, I.destination), Math.max(I.start, I.destination)], cw = sum(I.distance.slice(a, b)), tot = sum(I.distance); T.at({ distance: A(I.distance, { i: a, j: b }) }); T.n('Distance one way around?', cw, 'Sum between the two stops.'); T.n('Total loop length?', tot, 'The other way is the rest.'); return Math.min(cw, tot - cw); })(); T.n('Shortest distance?', res, 'The smaller direction.'); return res; }
  });

  D('number-of-ships-in-a-rectangle', {
    t: 'Number of Ships in a Rectangle',
    r: 'Divide and conquer: if hasShips(rect) is false, return 0; if the rectangle is a single point, return 1; otherwise split it into four quadrants and sum.',
    g: R => ({ ships: [...new Set(Array.from({ length: R.int(0, 5) }, () => R.int(0, 6) + ',' + R.int(0, 6)))].map(s => s.split(',').map(Number)), topRight: [R.int(3, 6), R.int(3, 6)], bottomLeft: [0, 0] }),
    exIn: I => I.ships ? I : { ships: I.ans, topRight: I.topRight, bottomLeft: I.bottomLeft },
    s(I, T) { const has = (x1, y1, x2, y2) => I.ships.some(([x, y]) => x >= x1 && x <= x2 && y >= y1 && y <= y2); let calls = 0; const go = (x1, y1, x2, y2) => { if (x1 > x2 || y1 > y2) return 0; calls++; const h = has(x1, y1, x2, y2); if (calls <= 4) { T.at({ rect: `(${x1},${y1})–(${x2},${y2})` }); T.yn('hasShips?', h, 'Prune empty rectangles.'); } if (!h) return 0; if (x1 === x2 && y1 === y2) return 1; const mx = (x1 + x2) >> 1, my = (y1 + y2) >> 1; return go(x1, y1, mx, my) + go(mx + 1, y1, x2, my) + go(x1, my + 1, mx, y2) + go(mx + 1, my + 1, x2, y2); }; return go(I.bottomLeft[0], I.bottomLeft[1], I.topRight[0], I.topRight[1]); }
  });

  D('element-appearing-more-than-25-in-sorted-array', {
    t: 'Element Appearing More Than 25% In Sorted Array',
    r: 'In a sorted array, the frequent element x occupies more than n/4 consecutive slots, so arr[i] == arr[i + ⌊n/4⌋] for some i.',
    g: R => { const n = R.int(1, 10), k = Math.floor(n / 4) + 1, m = R.int(1, 9), rest = R.ints(n - k, 1, 9).filter(x => x !== m); return { arr: [...Array(k).fill(m), ...rest].sort((a, b) => a - b) }; },
    s(I, T) { const q = Math.floor(I.arr.length / 4); for (let i = 0; i + q < I.arr.length; i++) { const ok = I.arr[i] === I.arr[i + q]; T.at({ arr: A(I.arr, { i, j: i + q }) }); T.yn('Same value a quarter-length apart?', ok, 'Then it fills > 25%.'); if (ok) return I.arr[i]; } }
  });

  D('sequential-digits', {
    t: 'Sequential Digits',
    r: 'Every sequential-digit number is a substring of "123456789". Enumerate by length and start, keeping those in [low, high].',
    g: R => { const lo = R.int(10, 3000); return { low: lo, high: lo + R.int(0, 5000) }; },
    s(I, T) { const res = (() => { const out = []; for (let L = 2; L <= 9; L++) for (let s = 0; s + L <= 9; s++) { const v = +'123456789'.slice(s, s + L); if (v >= I.low && v <= I.high) out.push(v); } T.at({ low: I.low, high: I.high }); T.n(`Digits in ${I.low}?`, String(I.low).length, 'Start with numbers of that length.'); T.n('How many fit?', out.length, 'Substrings of 123456789.'); return out; })(); T.n('Smallest one that fits? (0 if none)', res.length ? res[0] : 0, 'Shorter lengths come first.'); return res; }
  });

  D('replace-elements-with-greatest-element-on-right-side', {
    t: 'Replace Elements with Greatest Element on Right Side',
    r: 'Scan from the right keeping the max seen so far; write it, then update with the current element. The last becomes −1.',
    g: R => ({ arr: R.ints(R.int(1, 7), 1, 20) }),
    s(I, T) { const out = []; let m = -1; for (let i = I.arr.length - 1; i >= 0; i--) { out[i] = m; if (I.arr.length - i <= 5) { T.at({ arr: A(I.arr, { i }) }); T.n('Greatest to the right?', m, 'Max of the suffix (−1 if none).'); } m = Math.max(m, I.arr[i]); } return out; }
  });

  D('decompress-run-length-encoded-list', {
    t: 'Decompress Run-Length Encoded List',
    r: 'For each pair [freq, val], append val freq times.',
    g: R => ({ nums: Array.from({ length: R.int(1, 4) }, () => [R.int(1, 3), R.int(1, 9)]).flat() }),
    s(I, T) { const out = []; for (let i = 0; i < I.nums.length; i += 2) { for (let k = 0; k < I.nums[i]; k++) out.push(I.nums[i + 1]); T.at({ nums: A(I.nums, { i, j: i + 1 }) }); T.n('Length so far?', out.length, `${I.nums[i]} copies of ${I.nums[i + 1]}.`); } return out; }
  });

  D('number-of-times-binary-string-is-prefix-aligned', {
    t: 'Number of Times Binary String Is Prefix-Aligned',
    r: 'After step i (1-based), the string is prefix-aligned iff the largest flipped position so far equals i.',
    g: R => ({ flips: R.perm(R.int(1, 7)).map(x => x + 1) }),
    s(I, T) { let m = 0, c = 0; I.flips.forEach((f, i) => { m = Math.max(m, f); const ok = m === i + 1; if (ok) c++; if (i < 7) { T.at({ flips: A(I.flips, { i }), maxSoFar: m }); T.yn('Prefix-aligned now?', ok, 'max == number of flips.'); } }); return c; }
  });

  D('kids-with-the-greatest-number-of-candies', {
    t: 'Kids With the Greatest Number of Candies',
    r: 'Find the current max; kid i qualifies if candies[i] + extra ≥ max.',
    g: R => ({ candies: R.ints(R.int(2, 6), 1, 9), extraCandies: R.int(1, 5) }),
    s(I, T) { const res = (() => { const m = Math.max(...I.candies); T.at({ candies: A(I.candies) }); T.n('Current maximum?', m, 'Target to reach.'); T.n('Kids who already have the max?', I.candies.filter(c => c === m).length, 'They are true for sure.'); return I.candies.map(c => c + I.extraCandies >= m); })(); T.n('Kids who can reach the max?', res.filter(Boolean).length, 'Candies plus extra at least the max.'); return res; }
  });

  D('check-if-all-1s-are-at-least-length-k-places-away', {
    t: 'Check If All 1\'s Are at Least Length K Places Away',
    r: 'Remember the index of the previous 1; each new 1 must have at least k zeros between them (i − prev − 1 ≥ k).',
    g: R => ({ nums: R.ints(R.int(1, 9), 0, 1), k: R.int(0, 3) }),
    s(I, T) { const res = (() => { let prev = -Infinity; for (let i = 0; i < I.nums.length; i++) if (I.nums[i]) { if (prev > -Infinity) { const ok = i - prev - 1 >= I.k; T.at({ nums: A(I.nums, { i, j: prev }) }); T.yn('Far enough from the previous 1?', ok, `${i - prev - 1} zeros between.`); if (!ok) return false; } prev = i; } return true; })(); T.yn('Are all 1s far enough apart?', res, 'Every gap had at least k zeros.'); return res; }
  });

  D('number-of-students-doing-homework-at-a-given-time', {
    t: 'Number of Students Doing Homework at a Given Time',
    r: 'Count students with startTime[i] ≤ queryTime ≤ endTime[i].',
    g: R => { const n = R.int(1, 5), s = R.ints(n, 1, 6); return { startTime: s, endTime: s.map(x => x + R.int(0, 4)), queryTime: R.int(1, 8) }; },
    s(I, T) { let c = 0; I.startTime.forEach((s, i) => { const ok = s <= I.queryTime && I.queryTime <= I.endTime[i]; if (ok) c++; if (i < 5) { T.at({ student: `[${s}, ${I.endTime[i]}]`, query: I.queryTime }); T.yn('Busy at queryTime?', ok, 'Inclusive interval.'); } }); return c; }
  });

  D('maximum-product-of-two-elements-in-an-array', {
    t: 'Maximum Product of Two Elements in an Array',
    r: 'Take the two largest values a ≥ b; the answer is (a − 1)(b − 1).',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 10) }),
    s(I, T) { const res = (() => { const s = I.nums.slice().sort((a, b) => b - a); T.at({ nums: A(I.nums) }); T.n('Largest value?', s[0], 'Track the top two.'); T.n('Second largest?', s[1], 'May equal the largest.'); return (s[0] - 1) * (s[1] - 1); })(); T.n('Maximum product?', res, '(largest minus 1) times (second minus 1).'); return res; }
  });

  D('shuffle-the-array', {
    t: 'Shuffle the Array',
    r: 'Interleave: out[2i] = nums[i], out[2i+1] = nums[i + n].',
    g: R => { const n = R.int(1, 4); return { nums: R.ints(2 * n, 1, 9), n }; },
    s(I, T) { const out = []; for (let i = 0; i < I.n; i++) { out.push(I.nums[i], I.nums[i + I.n]); if (i < 4) { T.at({ nums: A(I.nums, { i, j: i + I.n }) }); T.n(`out[${2 * i + 1}]?`, I.nums[i + I.n], 'The y partner.'); } } return out; }
  });

  D('average-salary-excluding-the-minimum-and-maximum-salary', {
    t: 'Average Salary Excluding the Minimum and Maximum Salary',
    r: '(sum − min − max) / (n − 2).',
    g: R => ({ salary: R.distinct(R.int(3, 6), 1, 20).map(x => x * 1000) }),
    cmp: 'float',
    s(I, T) { const s = sum(I.salary), mn = Math.min(...I.salary), mx = Math.max(...I.salary); T.at({ salary: A(I.salary) }); T.n('Minimum salary?', mn, 'Drop it.'); T.n('Maximum salary?', mx, 'Drop it too.'); T.n('Sum without min and max?', s - mn - mx, 'Remove both extremes.'); return (s - mn - mx) / (I.salary.length - 2); }
  });

  D('count-good-triplets', {
    t: 'Count Good Triplets',
    r: 'Enumerate i < j < k; check |a_i − a_j| ≤ a, |a_j − a_k| ≤ b, |a_i − a_k| ≤ c (skip k early when the first test fails).',
    g: R => ({ arr: R.ints(R.int(3, 6), 0, 9), a: R.int(0, 5), b: R.int(0, 5), c: R.int(0, 5) }),
    s(I, T) { const x = I.arr; let cnt = 0, k2 = 0; for (let i = 0; i < x.length; i++) for (let j = i + 1; j < x.length; j++) { if (Math.abs(x[i] - x[j]) > I.a) continue; for (let k = j + 1; k < x.length; k++) { const ok = Math.abs(x[j] - x[k]) <= I.b && Math.abs(x[i] - x[k]) <= I.c; if (ok) cnt++; if (k2++ < 4) { T.at({ arr: A(x, { i, j, k }) }); T.yn('Good triplet?', ok, 'All three distance limits hold.'); } } } return cnt; }
  });

  D('three-consecutive-odds', {
    t: 'Three Consecutive Odds',
    r: 'Count the current run of odd numbers; return true when it reaches 3.',
    g: R => ({ arr: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { let c = 0; for (const [i, x] of I.arr.entries()) { c = x % 2 ? c + 1 : 0; T.at({ arr: A(I.arr, { i }) }); T.n('Odd run length?', c, 'Reset on even.'); if (c === 3) return true; } return false; }
  });

  D('detect-pattern-of-length-m-repeated-k-or-more-times', {
    t: 'Detect Pattern of Length M Repeated K or More Times',
    r: 'Count consecutive positions where arr[i] == arr[i + m]; a streak of (k − 1)·m such matches means a pattern repeated k times.',
    g: R => ({ arr: R.ints(R.int(2, 9), 1, 3), m: R.int(1, 2), k: R.int(2, 3) }),
    s(I, T) { let c = 0; for (let i = 0; i + I.m < I.arr.length; i++) { c = I.arr[i] === I.arr[i + I.m] ? c + 1 : 0; if (i < 6) { T.at({ arr: A(I.arr, { i, j: i + I.m }) }); T.n('Matching streak?', c, `Need ${(I.k - 1) * I.m}.`); } if (c === (I.k - 1) * I.m) return true; } return false; }
  });

  D('check-if-array-is-sorted-and-rotated', {
    t: 'Check if Array Is Sorted and Rotated',
    r: 'Count "drops" where nums[i] > nums[(i+1) mod n], including the wrap-around. Sorted-and-rotated means at most one drop.',
    g: R => { const s = R.sorted(R.int(1, 6), 1, 9), k = R.int(0, s.length - 1), a = [...s.slice(k), ...s.slice(0, k)]; if (R.chance(0.4)) { const i = R.int(0, a.length - 1), j = R.int(0, a.length - 1); [a[i], a[j]] = [a[j], a[i]]; } return { nums: a }; },
    s(I, T) { const n = I.nums.length; let d = 0; for (let i = 0; i < n; i++) { if (I.nums[i] > I.nums[(i + 1) % n]) d++; if (i < 6) { T.at({ nums: A(I.nums, { i, j: (i + 1) % n }) }); T.n('Drops so far?', d, 'Include the wrap-around pair.'); } } return d <= 1; }
  });

  D('maximum-ascending-subarray-sum', {
    t: 'Maximum Ascending Subarray Sum',
    r: 'Keep a running sum that resets whenever the sequence stops strictly increasing; track the best.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 20) }),
    s(I, T) { let c = 0, b = 0; I.nums.forEach((x, i) => { c = i && x > I.nums[i - 1] ? c + x : x; b = Math.max(b, c); if (i < 7) { T.at({ nums: A(I.nums, { i }) }); T.n('Current ascending sum?', c, 'Reset when not increasing.'); } }); return b; }
  });

  D('minimum-distance-to-the-target-element', {
    t: 'Minimum Distance to the Target Element',
    r: 'Scan outward (or over all indices) for nums[i] == target and keep the smallest |i − start|.',
    g: R => { const a = R.ints(R.int(1, 7), 1, 5); return { nums: a, target: R.pick(a), start: R.int(0, a.length - 1) }; },
    s(I, T) { const res = (() => { let b = Infinity; I.nums.forEach((x, i) => { if (x === I.target) { b = Math.min(b, Math.abs(i - I.start)); T.at({ nums: A(I.nums, { i, j: I.start }) }); T.n('Best distance so far?', b, 'Distance between i and start.'); } }); return b; })(); T.n('Minimum distance?', res, 'Best over every target position.'); return res; }
  });

  D('smallest-index-with-equal-value', {
    t: 'Smallest Index With Equal Value',
    r: 'Return the first i with i mod 10 == nums[i], or −1.',
    g: R => ({ nums: R.ints(R.int(1, 12), 0, 9) }),
    s(I, T) { for (let i = 0; i < I.nums.length; i++) { const ok = i % 10 === I.nums[i]; if (i < 6 || ok) { T.at({ nums: A(I.nums, { i }) }); T.yn('i mod 10 == nums[i]?', ok, 'First match wins.'); } if (ok) return i; } return -1; }
  });

  D('count-equal-and-divisible-pairs-in-an-array', {
    t: 'Count Equal and Divisible Pairs in an Array',
    r: 'Check every pair i < j with nums[i] == nums[j] and i·j divisible by k.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 3), k: R.int(1, 4) }),
    s(I, T) { let c = 0, s = 0; for (let i = 0; i < I.nums.length; i++) for (let j = i + 1; j < I.nums.length; j++) if (I.nums[i] === I.nums[j]) { const ok = (i * j) % I.k === 0; if (ok) c++; if (s++ < 5) { T.at({ nums: A(I.nums, { i, j }) }); T.yn(`Is ${i}·${j} divisible by ${I.k}?`, ok, 'Equal values found.'); } } return c; }
  });

  D('count-hills-and-valleys-in-an-array', {
    t: 'Count Hills and Valleys in an Array',
    r: 'Collapse runs of equal values (they form one hill or valley). Then count interior points higher or lower than both neighbors.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 5) }),
    s(I, T) { const res = (() => { const a = I.nums.filter((x, i) => !i || x !== I.nums[i - 1]); T.at({ collapsed: A(a) }); T.n('Length after collapsing equal runs?', a.length, 'Equal neighbors share a hill or valley.'); let c = 0; for (let i = 1; i + 1 < a.length; i++) if ((a[i] > a[i - 1] && a[i] > a[i + 1]) || (a[i] < a[i - 1] && a[i] < a[i + 1])) c++; return c; })(); const a = I.nums.filter((x, i) => !i || x !== I.nums[i - 1]); let h = 0; for (let i = 1; i + 1 < a.length; i++) if (a[i] > a[i - 1] && a[i] > a[i + 1]) h++; T.n('Hills only?', h, 'Higher than both neighbours.'); T.n('Hills plus valleys?', res, 'Valleys are lower than both neighbours.'); return res; }
  });

  D('find-closest-number-to-zero', {
    t: 'Find Closest Number to Zero',
    r: 'Track the value with the smallest |x|; on ties prefer the larger value.',
    g: R => ({ nums: R.ints(R.int(1, 6), -9, 9) }),
    s(I, T) { let b = I.nums[0]; I.nums.forEach((x, i) => { if (Math.abs(x) < Math.abs(b) || (Math.abs(x) === Math.abs(b) && x > b)) b = x; if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.n('Closest so far?', b, 'Smaller |x|, ties to the larger.'); } }); return b; }
  });
})();
