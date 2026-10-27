/* v2 games: prefix sums & difference arrays (01). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const pre = a => { const p = [0]; for (const x of a) p.push(p[p.length - 1] + x); return p; };
  const pc = x => { let c = 0; while (x) { c += x & 1; x >>= 1; } return c; };
  const isPal = s => s === [...s].reverse().join('');

  D('maximum-size-subarray-sum-equals-k', {
    t: 'Maximum Size Subarray Sum Equals k',
    r: 'Store the FIRST index of each prefix sum. At j, if prefix − k was seen at i, the subarray (i, j] sums to k; maximize j − i.',
    g: R => ({ nums: R.ints(R.int(1, 8), -3, 5), k: R.int(-3, 6) }),
    s(I, T) { const first = new Map([[0, 0]]); let p = 0, best = 0; I.nums.forEach((x, j) => { p += x; if (first.has(p - I.k)) best = Math.max(best, j + 1 - first.get(p - I.k)); if (!first.has(p)) first.set(p, j + 1); if (j < 8) { T.at({ nums: A(I.nums, { j }), prefix: p, need: p - I.k }); T.n('Longest so far?', best, 'Earliest index of prefix − k.'); } }); return best; }
  });

  D('range-addition', {
    t: 'Range Addition',
    r: 'Difference array: for each update add inc at start and subtract it at end + 1. One prefix-sum pass gives the final array.',
    g: R => { const n = R.int(1, 7); return { length: n, updates: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(0, n - 1); return [a, R.int(a, n - 1), R.int(-3, 5)]; }) }; },
    s(I, T) { const d = Array(I.length + 1).fill(0); I.updates.forEach(([a, b, v], i) => { d[a] += v; d[b + 1] -= v; if (i < 4) { T.at({ update: `[${a}, ${b}] += ${v}`, diff: A(d.slice(0, I.length)) }); T.n(`diff[${a}] after this update?`, d[a], 'Add at the start, subtract after the end.'); } }); const out = []; let s = 0; for (let i = 0; i < I.length; i++) out.push(s += d[i]); return out; }
  });

  D('super-washing-machines', {
    t: 'Super Washing Machines',
    r: 'If total is not divisible by n: −1. With avg = total divided by n, the running balance the sum of (m − avg) is the flow across each boundary; answer = max(max |balance|, max(m − avg)).',
    g: R => { const n = R.int(1, 5), avg = R.int(0, 4), m = Array(n).fill(avg); for (let t = 0; t < 4; t++) { const i = R.int(0, n - 1), j = R.int(0, n - 1); if (m[i]) { m[i]--; m[j]++; } } if (R.chance(0.15)) m[0]++; return { machines: m }; },
    s(I, T) { const m = I.machines, n = m.length, tot = m.reduce((a, b) => a + b, 0); T.at({ machines: A(m), total: tot }); T.yn('Is the total divisible by n?', tot % n === 0, 'Otherwise impossible.'); if (tot % n) return -1; const avg = tot / n; let bal = 0, best = 0; m.forEach((x, i) => { bal += x - avg; best = Math.max(best, Math.abs(bal), x - avg); if (i < 5) { T.at({ machines: A(m, { i }), avg }); T.n('Running balance after this machine?', bal, 'Dresses that must cross the boundary.'); } }); return best; }
  });

  D('continuous-subarray-sum', {
    t: 'Continuous Subarray Sum',
    r: 'Two prefixes with the same remainder mod k bound a subarray whose sum is a multiple of k. Store the first index of each remainder and require length at least 2.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 9), k: R.int(1, 7) }),
    s(I, T) { const first = new Map([[0, -1]]); let p = 0; for (const [i, x] of I.nums.entries()) { p = (p + x) % I.k; if (i < 8) { T.at({ nums: A(I.nums, { i }), remainders: K(Object.fromEntries(first)) }); T.n('Prefix remainder here?', p, `Running sum mod ${I.k}.`); } if (first.has(p)) { if (i - first.get(p) >= 2) return true; } else first.set(p, i); } return false; }
  });

  D('split-array-with-equal-sum', {
    t: 'Split Array with Equal Sum',
    r: 'Fix the middle cut j. For each i on the left where sum(0 to i−1) = sum(i+1 to j−1), put that sum in a set; then scan k on the right for sum(j+1 to k−1) = sum(k+1 to n−1) in the set.',
    g: R => ({ nums: R.ints(R.int(1, 9), -1, 3) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length, P = pre(a), S = (l, r) => P[r + 1] - P[l]; let asks = 0; T.at({ nums: A(a) }); T.n('Total sum?', P[n], 'Last prefix sum.'); for (let j = 3; j < n - 3; j++) { const set = new Set(); for (let i = 1; i < j - 1; i++) if (S(0, i - 1) === S(i + 1, j - 1)) set.add(S(0, i - 1)); let hit = false; for (let k = j + 2; k < n - 1; k++) if (S(j + 1, k - 1) === S(k + 1, n - 1) && set.has(S(k + 1, n - 1))) hit = true; if (asks++ < 5) { T.at({ nums: A(a, { j }), leftSums: A([...set]) }); T.yn('Does this middle cut work?', hit, 'A right split must match a left sum.'); } if (hit) return true; } if (!asks) { T.at({ n }); T.yn('Is the array long enough (at least 7)?', false, 'Need three cuts with parts between.'); } return false; })(); T.yn('Can the array be split?', res, 'Some middle cut worked.'); return res; }
  });

  D('brick-wall', {
    t: 'Brick Wall',
    r: 'Prefix sums of each row (excluding the full width) are edge positions. Count them in a map; the line through the most common edge crosses rows − maxCount bricks.',
    g: R => { const w = R.int(2, 6); return { wall: Array.from({ length: R.int(1, 5) }, () => { const r = []; let left = w; while (left) { const b = R.int(1, left); r.push(b); left -= b; } return r; }) }; },
    s(I, T) { const c = {}; I.wall.forEach((row, i) => { let p = 0; for (let j = 0; j < row.length - 1; j++) { p += row[j]; c[p] = (c[p] || 0) + 1; } if (i < 5) { T.at({ row: A(row), edges: K({ ...c }) }); T.n('Most common edge count so far?', Math.max(0, ...Object.values(c)), 'Edges at the same position.'); } }); return I.wall.length - Math.max(0, ...Object.values(c)); }
  });

  D('smallest-rotation-with-highest-score', {
    t: 'Smallest Rotation with Highest Score',
    r: 'Element nums[i] scores for rotations k where it lands at an index at least its value: a contiguous (circular) range of k. Mark each range on a difference array, prefix-sum, and take the first max.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 0, n - 1) }; },
    s(I, T) { const a = I.nums, n = a.length; let best = -1, bk = 0; for (let k = 0; k < n; k++) { let s = 0; for (let i = 0; i < n; i++) if (a[i] <= (i - k + n) % n) s++; if (s > best) { best = s; bk = k; } if (k < 6) { T.at({ rotated: A([...a.slice(k), ...a.slice(0, k)]), k }); T.n('Score of this rotation?', s, 'Count elements at most their index.'); } } return bk; }
  });

  D('shifting-letters', {
    t: 'Shifting Letters',
    r: 'Letter i is shifted by shifts[i] + shifts[i+1] + … (a suffix sum). Walk from the right accumulating mod 26.',
    g: R => { const n = R.int(1, 6); return { s: R.str(n, 'abcxyz'), shifts: R.ints(n, 0, 30) }; },
    s(I, T) { const n = I.s.length, out = Array(n); let suf = 0; for (let i = n - 1; i >= 0; i--) { suf = (suf + I.shifts[i]) % 26; out[i] = String.fromCharCode(97 + (I.s.charCodeAt(i) - 97 + suf) % 26); if (n - i <= 6) { T.at({ shifts: A(I.shifts, { i }), s: I.s }); T.n(`Total shift for letter ${i} (mod 26)?`, suf, 'Suffix sum.'); } } return out.join(''); }
  });

  D('partition-array-into-disjoint-intervals', {
    t: 'Partition Array into Disjoint Intervals',
    r: 'Precompute suffix minimums. The first i where prefix max(0 to i) at most suffix min(i+1..) gives left length i + 1.',
    g: R => { const a = R.ints(R.int(2, 8), 0, 9); a[a.length - 1] = 9; return { nums: a }; },
    s(I, T) { const a = I.nums, n = a.length, sm = Array(n); sm[n - 1] = a[n - 1]; for (let i = n - 2; i >= 0; i--) sm[i] = Math.min(a[i], sm[i + 1]); let mx = -Infinity; for (let i = 0; i < n - 1; i++) { mx = Math.max(mx, a[i]); const ok = mx <= sm[i + 1]; T.at({ nums: A(a, { i }), leftMax: mx, rightMin: sm[i + 1] }); T.yn('Can we cut after this index?', ok, 'left max at most right min.'); if (ok) return i + 1; } return n - 1; }
  });

  D('subarray-sums-divisible-by-k', {
    t: 'Subarray Sums Divisible by K',
    r: 'Count prefix remainders (normalized to be non-negative). Each prefix pairs with every earlier prefix of the same remainder.',
    g: R => ({ nums: R.ints(R.int(1, 8), -5, 9), k: R.int(2, 6) }),
    s(I, T) { const c = { 0: 1 }; let p = 0, t = 0; I.nums.forEach((x, i) => { p = ((p + x) % I.k + I.k) % I.k; t += c[p] || 0; c[p] = (c[p] || 0) + 1; if (i < 8) { T.at({ nums: A(I.nums, { i }), seen: K({ ...c }) }); T.n('Count so far?', t, 'Earlier prefixes with the same remainder.'); } }); return t; }
  });

  D('partition-array-into-three-parts-with-equal-sum', {
    t: 'Partition Array Into Three Parts With Equal Sum',
    r: 'Total must be divisible by 3. Scan with a running sum; each time it hits total divided by 3, count a part and reset. Valid if at least 3 parts form (the third may absorb the rest).',
    g: R => ({ arr: R.ints(R.int(3, 9), -3, 4) }),
    s(I, T) { const res = (() => { const tot = I.arr.reduce((a, b) => a + b, 0); T.at({ arr: A(I.arr), total: tot }); T.yn('Is the total divisible by 3?', tot % 3 === 0, 'Each part needs a third of the total.'); if (tot % 3) { T.n('Remainder of the total divided by 3?', tot % 3, 'Not 0, so it fails.'); return false; } let s = 0, parts = 0; I.arr.forEach(x => { s += x; if (s === tot / 3) { parts++; s = 0; } }); T.n('Parts found greedily?', parts, 'Reset each time you reach a third of the total.'); return parts >= 3; })(); T.yn('Can it be split into three parts?', res, 'At least 3 greedy parts.'); return res; }
  });

  D('car-pooling', {
    t: 'Car Pooling',
    r: 'Difference array over locations: +passengers at from, −passengers at to. Sweep with a running sum; it must never exceed capacity.',
    g: R => ({ trips: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(0, 6); return [R.int(1, 4), a, R.int(a + 1, 8)]; }), capacity: R.int(1, 8) }),
    s(I, T) { const d = Array(10).fill(0); I.trips.forEach(([p, a, b]) => { d[a] += p; d[b] -= p; }); let s = 0, asks = 0; for (let x = 0; x < 10; x++) { s += d[x]; if (d[x] && asks++ < 6) { T.at({ location: x, diff: A(d) }); T.n('Passengers in the car here?', s, 'Running sum.'); } if (s > I.capacity) return false; } return true; }
  });

  D('corporate-flight-bookings', {
    t: 'Corporate Flight Bookings',
    r: 'Difference array: for booking [first, last, seats] add seats at first and subtract after last; a prefix sum gives each flight\'s total.',
    g: R => { const n = R.int(1, 6); return { bookings: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(1, n); return [a, R.int(a, n), R.int(1, 30)]; }), n }; },
    s(I, T) { const d = Array(I.n + 2).fill(0); I.bookings.forEach(([a, b, s]) => { d[a] += s; d[b + 1] -= s; }); const out = []; let s = 0; for (let i = 1; i <= I.n; i++) { s += d[i]; out.push(s); if (i <= 6) { T.at({ diff: A(d.slice(1, I.n + 1), { i: i - 1 }) }); T.n(`Seats on flight ${i}?`, s, 'Prefix sum of the difference array.'); } } return out; }
  });

  D('can-make-palindrome-from-substring', {
    t: 'Can Make Palindrome from Substring',
    r: 'Prefix parity masks: mask[r+1] XOR mask[l] gives letters with odd counts. With odd letters m, we need half of m (rounded down) replacements at most k.',
    g: R => { const s = R.str(R.int(1, 8), 'abcd'); return { s, queries: Array.from({ length: R.int(1, 4) }, () => { const l = R.int(0, s.length - 1); return [l, R.int(l, s.length - 1), R.int(0, 2)]; }) }; },
    s(I, T) { const m = [0]; for (const c of I.s) m.push(m[m.length - 1] ^ 1 << (c.charCodeAt(0) - 97)); return I.queries.map(([l, r, k], i) => { const odd = pc(m[r + 1] ^ m[l]); if (i < 5) { T.at({ s: A([...I.s], { win: [l, r] }), k }); T.n('Letters with odd count in the substring?', odd, 'XOR of prefix masks.'); } return Math.floor(odd / 2) <= k; }); }
  });

  D('xor-queries-of-a-subarray', {
    t: 'XOR Queries of a Subarray',
    r: 'Prefix XOR p; the XOR of arr[l to r] is p[r+1] ^ p[l].',
    g: R => { const a = R.ints(R.int(1, 7), 0, 15); return { arr: a, queries: Array.from({ length: R.int(1, 4) }, () => { const l = R.int(0, a.length - 1); return [l, R.int(l, a.length - 1)]; }) }; },
    s(I, T) { const p = [0]; I.arr.forEach(x => p.push(p[p.length - 1] ^ x)); return I.queries.map(([l, r], i) => { const v = p[r + 1] ^ p[l]; if (i < 5) { T.at({ prefixXor: A(p, { l, r: r + 1 }) }); T.n(`XOR of arr[${l}..${r}]?`, v, 'p[r+1] ^ p[l].'); } return v; }); }
  });

  D('how-many-numbers-are-smaller-than-the-current-number', {
    t: 'How Many Numbers Are Smaller Than the Current Number',
    r: 'Count each value (0 to 100), take a prefix sum of the counts; the answer for x is the prefix count of values < x.',
    g: R => ({ nums: R.ints(R.int(2, 8), 0, 9) }),
    s(I, T) { const c = Array(11).fill(0); I.nums.forEach(x => c[x + 1]++); for (let i = 1; i < 11; i++) c[i] += c[i - 1]; return I.nums.map((x, i) => { if (i < 6) { T.at({ nums: A(I.nums, { i }), prefixCounts: A(c) }); T.n(`How many numbers are smaller than ${x}?`, c[x], 'Prefix count below x.'); } return c[x]; }); }
  });

  D('find-the-longest-substring-containing-vowels-in-even-counts', {
    t: 'Find the Longest Substring Containing Vowels in Even Counts',
    r: 'Track a 5-bit parity mask of vowel counts. Store the first index of each mask; when it repeats, the substring between has every vowel even.',
    g: R => ({ s: R.str(R.int(1, 12), 'aeiobc') }),
    s(I, T) { const first = { 0: -1 }; let m = 0, best = 0; [...I.s].forEach((c, i) => { const v = 'aeiou'.indexOf(c); if (v >= 0) m ^= 1 << v; if (m in first) best = Math.max(best, i - first[m]); else first[m] = i; if (i < 8) { T.at({ s: A([...I.s], { i }), mask: m.toString(2).padStart(5, '0') }); T.n('Longest so far?', best, 'Distance to the first time this mask appeared.'); } }); return best; }
  });

  D('minimum-value-to-get-positive-step-by-step-sum', {
    t: 'Minimum Value to Get Positive Step by Step Sum',
    r: 'The running sum must stay at least 1, so startValue = max(1, 1 − minPrefix).',
    g: R => ({ nums: R.ints(R.int(1, 7), -5, 5) }),
    s(I, T) { let p = 0, mn = 0; I.nums.forEach((x, i) => { p += x; mn = Math.min(mn, p); if (i < 7) { T.at({ nums: A(I.nums, { i }), prefix: p }); T.n('Minimum prefix so far (0 if none negative)?', mn, 'Track the lowest point.'); } }); return Math.max(1, 1 - mn); }
  });

  D('maximum-score-after-splitting-a-string', {
    t: 'Maximum Score After Splitting a String',
    r: 'Score = zeros on the left + ones on the right. Start with all ones on the right and move the split one character at a time (both sides non-empty).',
    g: R => ({ s: R.str(R.int(2, 9), '01') }),
    s(I, T) { let z = 0, o = [...I.s].filter(c => c === '1').length, best = 0; for (let i = 0; i < I.s.length - 1; i++) { if (I.s[i] === '0') z++; else o--; best = Math.max(best, z + o); if (i < 7) { T.at({ s: A([...I.s], { win: [0, i] }) }); T.n('Score for this split?', z + o, 'Left zeros + right ones.'); } } return best; }
  });

  D('count-triplets-that-can-form-two-arrays-of-equal-xor', {
    t: 'Count Triplets That Can Form Two Arrays of Equal XOR',
    r: 'a == b exactly when XOR(arr[i to k]) = 0, i.e. prefix[i] == prefix[k+1]. Each such pair contributes k − i choices of j.',
    g: R => ({ arr: R.ints(R.int(1, 8), 1, 7) }),
    s(I, T) { const p = [0]; I.arr.forEach(x => p.push(p[p.length - 1] ^ x)); let t = 0, asks = 0; for (let i = 0; i < p.length; i++) for (let k = i + 2; k < p.length; k++) if (p[i] === p[k]) { t += k - i - 1; if (asks++ < 6) { T.at({ prefixXor: A(p, { i, k }) }); T.n('Triplets contributed by this pair?', k - i - 1, 'Any j strictly inside.'); } } if (!asks) { T.at({ prefixXor: A(p) }); T.n('Pairs of equal prefixes?', 0, 'No zero-XOR subarray of length at least 2.'); } return t; }
  });

  D('running-sum-of-1d-array', {
    t: 'Running Sum of 1d Array',
    r: 'runningSum[i] = runningSum[i − 1] + nums[i].',
    g: R => ({ nums: R.ints(R.int(1, 7), -5, 9) }),
    s(I, T) { let s = 0; return I.nums.map((x, i) => { s += x; if (i < 7) { T.at({ nums: A(I.nums, { i }) }); T.n('Running sum here?', s, 'Previous + current.'); } return s; }); }
  });

  D('number-of-sub-arrays-with-odd-sum', {
    t: 'Number of Sub-arrays With Odd Sum',
    r: 'Count even and odd prefix sums. An odd prefix pairs with every earlier even one (and vice versa) to make an odd subarray.',
    g: R => ({ arr: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { let ev = 1, od = 0, p = 0, t = 0; I.arr.forEach((x, i) => { p += x; if (p % 2) { t += ev; od++; } else { t += od; ev++; } if (i < 8) { T.at({ arr: A(I.arr, { i }), evenPrefixes: ev, oddPrefixes: od }); T.n('Odd-sum subarrays so far?', t, 'Pair with prefixes of opposite parity.'); } }); return t % 1000000007; }
  });

  D('find-longest-awesome-substring', {
    t: 'Find Longest Awesome Substring',
    r: 'Awesome = at most one digit with odd count. With a 10-bit parity mask, look up the first index of the same mask and of each mask differing in one bit.',
    g: R => ({ s: R.str(R.int(1, 10), '0123') }),
    s(I, T) { const first = { 0: -1 }; let m = 0, best = 0; [...I.s].forEach((c, i) => { m ^= 1 << +c; if (m in first) best = Math.max(best, i - first[m]); for (let d = 0; d < 10; d++) { const x = m ^ 1 << d; if (x in first) best = Math.max(best, i - first[x]); } if (!(m in first)) first[m] = i; if (i < 8) { T.at({ s: A([...I.s], { i }), mask: m.toString(2) }); T.n('Longest awesome so far?', best, 'Same mask, or one bit different.'); } }); return best; }
  });

  D('maximum-number-of-non-overlapping-subarrays-with-sum-equals-target', {
    t: 'Maximum Number of Non-Overlapping Subarrays With Sum Equals Target',
    r: 'Greedy: keep a set of prefix sums since the last cut. As soon as prefix − target is in it, take that subarray, count it, and reset the set to {0} with prefix 0.',
    g: R => ({ nums: R.ints(R.int(1, 9), -2, 4), target: R.int(1, 4) }),
    s(I, T) { let S = new Set([0]), p = 0, c = 0; I.nums.forEach((x, i) => { p += x; const hit = S.has(p - I.target); if (i < 8) { T.at({ nums: A(I.nums, { i }), prefix: p, seen: A([...S]) }); T.yn('Does a subarray ending here hit target?', hit, 'prefix − target seen since the last cut.'); } if (hit) { c++; S = new Set([0]); p = 0; } else S.add(p); }); return c; }
  });

  D('sum-of-all-odd-length-subarrays', {
    t: 'Sum of All Odd Length Subarrays',
    r: 'arr[i] appears in (i + 1)(n − i) subarrays, and half of that, rounded up of them have odd length. Sum arr[i] times that count.',
    g: R => ({ arr: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const n = I.arr.length; let s = 0; I.arr.forEach((x, i) => { const c = Math.ceil((i + 1) * (n - i) / 2); s += c * x; if (i < 6) { T.at({ arr: A(I.arr, { i }) }); T.n(`Odd-length subarrays containing index ${i}?`, c, 'half of (i + 1)(n − i), rounded up.'); } }); return s; }
  });

  D('maximum-sum-obtained-of-any-permutation', {
    t: 'Maximum Sum Obtained of Any Permutation',
    r: 'Count how many requests cover each index (difference array + prefix sum). Sort counts and numbers; pair largest with largest.',
    g: R => { const a = R.ints(R.int(1, 7), 0, 9); return { nums: a, requests: Array.from({ length: R.int(1, 4) }, () => { const l = R.int(0, a.length - 1); return [l, R.int(l, a.length - 1)]; }) }; },
    s(I, T) { const res = (() => { const n = I.nums.length, d = Array(n + 1).fill(0); I.requests.forEach(([l, r]) => { d[l]++; d[r + 1]--; }); const c = []; let s = 0; for (let i = 0; i < n; i++) c.push(s += d[i]); T.at({ coverCounts: A(c) }); T.n('Most-covered index count?', Math.max(...c), 'Prefix sum of the difference array.'); T.n('Largest number in nums?', Math.max(...I.nums), 'Put it on the most-covered index.'); const cs = c.slice().sort((a, b) => b - a), ns = I.nums.slice().sort((a, b) => b - a); return cs.reduce((t, v, i) => t + v * ns[i], 0) % 1000000007; })(); T.n('Maximum total (mod 1e9+7)?', res, 'Pair sorted counts with sorted numbers.'); return res; }
  });

  D('make-sum-divisible-by-p', {
    t: 'Make Sum Divisible by P',
    r: 'Need to remove a subarray with sum ≡ total (mod p). Store the latest index of each prefix remainder; at j look up (prefix − need) mod p. Removing the whole array is not allowed.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9), p: R.int(2, 9) }),
    s(I, T) { const res = (() => { const need = I.nums.reduce((a, b) => a + b, 0) % I.p; T.at({ nums: A(I.nums), p: I.p }); T.n('Total of nums?', I.nums.reduce((a, b) => a + b, 0), 'Add everything.'); T.n('Remainder of the total divided by p?', need, 'The removed subarray must match it.'); if (!need) return 0; const last = new Map([[0, -1]]); let p = 0, best = Infinity; I.nums.forEach((x, j) => { p = (p + x) % I.p; const want = (p - need + I.p) % I.p; if (last.has(want)) best = Math.min(best, j - last.get(want)); last.set(p, j); }); return best >= I.nums.length ? -1 : best; })(); T.n('Shortest subarray to remove? (−1 if impossible)', res, 'Match prefix remainders.'); return res; }
  });

  D('ways-to-make-a-fair-array', {
    t: 'Ways to Make a Fair Array',
    r: 'Removing index i flips the parity of everything after it. With prefix even or odd sums: newEven = evenBefore + oddAfter, newOdd = oddBefore + evenAfter. Count i where they match.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6) }),
    s(I, T) { const a = I.nums, n = a.length; let te = 0, to = 0; a.forEach((x, i) => i % 2 ? to += x : te += x); let e = 0, o = 0, c = 0; a.forEach((x, i) => { const ea = te - e - (i % 2 ? 0 : x), oa = to - o - (i % 2 ? x : 0), ne = e + oa, no = o + ea; if (ne === no) c++; if (i < 7) { T.at({ nums: A(a, { i }) }); T.yn(`Fair after removing index ${i}?`, ne === no, `even ${ne}, odd ${no}.`); } if (i % 2) o += x; else e += x; }); return c; }
  });

  D('minimum-moves-to-make-array-complementary', {
    t: 'Minimum Moves to Make Array Complementary',
    r: 'For each pair (a, b) and target sum s: 0 moves if s = a + b, 1 move if s ∈ [min + 1, max + limit], else 2. Encode these ranges on a difference array over s ∈ [2, 2 times limit] and take the minimum.',
    g: R => { const n = 2 * R.int(1, 3), lim = R.int(1, 5); return { nums: R.ints(n, 1, lim), limit: lim }; },
    s(I, T) { const res = (() => { const a = I.nums, n = a.length; let best = Infinity, bs = 0; for (let s = 2; s <= 2 * I.limit; s++) { let m = 0; for (let i = 0; i < n / 2; i++) { const x = a[i], y = a[n - 1 - i]; m += x + y === s ? 0 : (s >= Math.min(x, y) + 1 && s <= Math.max(x, y) + I.limit) ? 1 : 2; } if (m < best) { best = m; bs = s; } } T.at({ nums: A(a), limit: I.limit }); T.n('Pairs to fix?', n / 2, 'Index i with n minus 1 minus i.'); T.n('A best target sum?', bs, 'Smallest target with minimal moves.'); return best; })(); T.n('Fewest moves?', res, 'Moves at the best target sum.'); return res; }
  });

  D('sum-of-absolute-differences-in-a-sorted-array', {
    t: 'Sum of Absolute Differences in a Sorted Array',
    r: 'With prefix sums: result[i] = x times i − left sum + right sum − x times (n − 1 − i).',
    g: R => ({ nums: R.sorted(R.int(1, 7), 1, 12) }),
    s(I, T) { const a = I.nums, n = a.length, P = pre(a); return a.map((x, i) => { const v = x * i - P[i] + (P[n] - P[i + 1]) - x * (n - 1 - i); if (i < 6) { T.at({ nums: A(a, { i }), leftSum: P[i], rightSum: P[n] - P[i + 1] }); T.n('Sum of differences for this element?', v, 'x times i − left + right − x times (n−1−i).'); } return v; }); }
  });

  D('find-the-highest-altitude', {
    t: 'Find the Highest Altitude',
    r: 'The altitudes are prefix sums of gain, starting at 0. Return the largest one.',
    g: R => ({ gain: R.ints(R.int(1, 7), -6, 6) }),
    s(I, T) { let h = 0, best = 0; I.gain.forEach((g, i) => { h += g; best = Math.max(best, h); if (i < 7) { T.at({ gain: A(I.gain, { i }) }); T.n('Altitude after this step?', h, 'Prefix sum.'); } }); return best; }
  });

  D('change-minimum-characters-to-satisfy-one-of-three-conditions', {
    t: 'Change Minimum Characters to Satisfy One of Three Conditions',
    r: 'Count letters of a and b. For each boundary letter c (b to z): a < c at most b costs (a letters at least c) + (b letters < c), and symmetric. Condition 3 costs |a| + |b| − (max count of a letter in a) − (in b). Prefix sums of counts make each boundary O(1).',
    g: R => ({ a: R.str(R.int(1, 5), 'abcd'), b: R.str(R.int(1, 5), 'abcd') }),
    s(I, T) { const res = (() => { const ca = Array(26).fill(0), cb = Array(26).fill(0); for (const c of I.a) ca[c.charCodeAt(0) - 97]++; for (const c of I.b) cb[c.charCodeAt(0) - 97]++; const m = I.a.length, n = I.b.length, c3 = m + n - Math.max(...ca) - Math.max(...cb); T.at({ a: I.a, b: I.b }); T.n('Most common letter count in a?', Math.max(...ca), 'Keep it for condition 3.'); T.n('Cost of condition 3 (each string one letter)?', c3, 'Keep the most common letter in each.'); let best = c3, pa = 0, pb = 0; for (let i = 0; i < 25; i++) { pa += ca[i]; pb += cb[i]; best = Math.min(best, m - pa + pb, n - pb + pa); } return best; })(); T.n('Fewest changes?', res, 'Best of the three conditions.'); return res; }
  });

  D('can-you-eat-your-favorite-candy-on-your-favorite-day', {
    t: 'Can You Eat Your Favorite Candy on Your Favorite Day?',
    r: 'With prefix counts P, by day d you eat between d + 1 and (d + 1) times cap candies. You can reach type t on day d exactly when (d + 1) times cap > P[t] and d + 1 at most P[t + 1].',
    g: R => { const c = R.ints(R.int(1, 5), 1, 8); return { candiesCount: c, queries: Array.from({ length: R.int(1, 4) }, () => [R.int(0, c.length - 1), R.int(0, 15), R.int(1, 5)]) }; },
    s(I, T) { const P = pre(I.candiesCount); return I.queries.map(([t, d, cap], i) => { const ok = (d + 1) * cap > P[t] && d + 1 <= P[t + 1]; if (i < 5) { T.at({ prefix: A(P, { i: t }), day: d, cap }); T.yn(`Can you eat type ${t} on day ${d}?`, ok, `Eaten range [${d + 1}, ${(d + 1) * cap}] must overlap (${P[t]}, ${P[t + 1]}].`); } return ok; }); }
  });

  D('minimum-number-of-operations-to-move-all-balls-to-each-box', {
    t: 'Minimum Number of Operations to Move All Balls to Each Box',
    r: 'Two passes: left to right, carry the number of balls seen and the accumulated cost (cost += balls each step); same from the right. Sum both.',
    g: R => ({ boxes: R.str(R.int(1, 8), '01') }),
    s(I, T) { const n = I.boxes.length, out = Array(n).fill(0); let b = 0, c = 0; for (let i = 0; i < n; i++) { out[i] += c; b += +I.boxes[i]; c += b; } b = 0; c = 0; for (let i = n - 1; i >= 0; i--) { out[i] += c; b += +I.boxes[i]; c += b; } out.slice(0, 6).forEach((v, i) => { T.at({ boxes: A([...I.boxes], { i }) }); T.n(`Operations to gather everything at box ${i}?`, v, 'Left cost + right cost.'); }); return out; }
  });

  D('maximize-the-beauty-of-the-garden', {
    t: 'Maximize the Beauty of the Garden',
    r: 'Keep the first and last flower with equal value v, and every positive flower between. With a prefix sum of max(0, x), for each value use its first and last positions: 2v + positive sum strictly inside.',
    g: R => { const f = R.ints(R.int(2, 8), -4, 5); f[f.length - 1] = f[R.int(0, f.length - 2)]; return { flowers: f }; },
    s(I, T) { const f = I.flowers, P = pre(f.map(x => Math.max(0, x))), first = {}; let best = -Infinity; f.forEach((v, j) => { if (v in first) { const i = first[v], b = 2 * v + P[j] - P[i + 1]; if (b > best) best = b; T.at({ flowers: A(f, { i, j }) }); T.n('Beauty with these two ends?', b, '2v + positives between.'); } else first[v] = j; }); return best; }
  });

  D('maximum-xor-for-each-query', {
    t: 'Maximum XOR for Each Query',
    r: 'Let X be the XOR of the current array. The best k is X XOR (2 to the power maximumBit − 1). Answer, then remove the last element from X.',
    g: R => { const mb = R.int(1, 4); return { nums: R.sorted(R.int(1, 6), 0, (1 << mb) - 1), maximumBit: mb }; },
    s(I, T) { let X = I.nums.reduce((a, b) => a ^ b, 0); const full = (1 << I.maximumBit) - 1, out = []; for (let i = I.nums.length - 1; i >= 0; i--) { const k = X ^ full; out.push(k); if (out.length <= 6) { T.at({ nums: A(I.nums.slice(0, i + 1)), xor: X }); T.n('Best k?', k, `XOR with ${full}.`); } X ^= I.nums[i]; } return out; }
  });

  D('maximum-population-year', {
    t: 'Maximum Population Year',
    r: 'Difference array over years: +1 at birth, −1 at death (alive in [birth, death)). Sweep and return the earliest year with the maximum running total.',
    g: R => ({ logs: Array.from({ length: R.int(1, 5) }, () => { const b = R.int(1950, 1958); return [b, R.int(b + 1, 1960)]; }) }),
    s(I, T) { const d = {}; I.logs.forEach(([b, e]) => { d[b] = (d[b] || 0) + 1; d[e] = (d[e] || 0) - 1; }); let s = 0, best = 0, yr = 1950, asks = 0; for (let y = 1950; y <= 2050; y++) { s += d[y] || 0; if (s > best) { best = s; yr = y; } if (d[y] && asks++ < 6) { T.at({ year: y, change: d[y] }); T.n('Population this year?', s, 'Running sum of changes.'); } } return yr; }
  });

  D('check-if-all-the-integers-in-a-range-are-covered', {
    t: 'Check if All the Integers in a Range Are Covered',
    r: 'Difference array over 1 to 50: +1 at start, −1 after end. Prefix-sum it and check every x in [left, right] has coverage > 0.',
    g: R => { const l = R.int(1, 8); return { ranges: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(1, 10); return [a, R.int(a, 10)]; }), left: l, right: R.int(l, 10) }; },
    s(I, T) { const d = Array(53).fill(0); I.ranges.forEach(([a, b]) => { d[a]++; d[b + 1]--; }); let s = 0; for (let x = 1; x <= I.right; x++) { s += d[x]; if (x >= I.left) { T.at({ x, ranges: A(I.ranges.map(r => r.join(' to '))) }); T.n(`Coverage of ${x}?`, s, 'Prefix sum of the difference array.'); if (!s) return false; } } return true; }
  });

  D('minimum-absolute-difference-queries', {
    t: 'Minimum Absolute Difference Queries',
    r: 'Values are 1 to 100, so keep prefix counts per value. For a query, list the values present in the range (count difference > 0) in order; the answer is the smallest gap between consecutive ones (−1 if one value).',
    g: R => { const a = R.ints(R.int(2, 7), 1, 8); return { nums: a, queries: Array.from({ length: R.int(1, 4) }, () => { const l = R.int(0, a.length - 2); return [l, R.int(l + 1, a.length - 1)]; }) }; },
    s(I, T) { return I.queries.map(([l, r], i) => { const v = [...new Set(I.nums.slice(l, r + 1))].sort((a, b) => a - b); let best = Infinity; for (let j = 1; j < v.length; j++) best = Math.min(best, v[j] - v[j - 1]); if (i < 5) { T.at({ nums: A(I.nums, { win: [l, r] }), present: A(v) }); T.n('Distinct values present?', v.length, 'Prefix count differences > 0.'); } return best === Infinity ? -1 : best; }); }
  });

  D('number-of-wonderful-substrings', {
    t: 'Number of Wonderful Substrings',
    r: 'Keep counts of 10-bit parity masks seen so far. At each position add count[mask] (all even) plus count[mask ^ (1 << c)] for each letter c (exactly one odd).',
    g: R => ({ word: R.str(R.int(1, 9), 'abc') }),
    s(I, T) { const c = { 0: 1 }; let m = 0, t = 0; [...I.word].forEach((ch, i) => { m ^= 1 << (ch.charCodeAt(0) - 97); let add = c[m] || 0; for (let b = 0; b < 10; b++) add += c[m ^ 1 << b] || 0; t += add; c[m] = (c[m] || 0) + 1; if (i < 8) { T.at({ word: A([...I.word], { i }), mask: m.toString(2) }); T.n('Wonderful substrings ending here?', add, 'Same mask or one bit off.'); } }); return t; }
  });

  D('unique-length-3-palindromic-subsequences', {
    t: 'Unique Length-3 Palindromic Subsequences',
    r: 'For each letter c, take its first and last occurrence; every distinct letter strictly between gives a palindrome c?c. Sum over letters.',
    g: R => ({ s: R.str(R.int(3, 10), 'abc') }),
    s(I, T) { let t = 0; for (const c of 'abcdefghijklmnopqrstuvwxyz') { const i = I.s.indexOf(c), j = I.s.lastIndexOf(c); if (i < 0 || j - i < 2) continue; const k = new Set(I.s.slice(i + 1, j)).size; t += k; T.at({ s: A([...I.s], { i, j }), letter: c }); T.n(`Palindromes of the form ${c}?${c}?`, k, 'Distinct letters between first and last.'); } return t; }
  });

  D('maximum-product-of-the-length-of-two-palindromic-substrings', {
    t: 'Maximum Product of the Length of Two Palindromic Substrings',
    r: 'Manacher gives the longest odd palindrome at each center; build best[i] = longest odd palindrome ending at or before i (prefix max) and the same from the right, then maximize left[i] times right[i + 1].',
    g: R => ({ s: R.str(R.int(2, 10), 'ab') }),
    s(I, T) { const s = I.s, n = s.length, L = Array(n).fill(1), Rt = Array(n).fill(1); for (let i = 0; i < n; i++) for (let j = i; j < n; j += 2) if (isPal(s.slice(i, j + 1))) { L[j] = Math.max(L[j], j - i + 1); Rt[i] = Math.max(Rt[i], j - i + 1); } for (let i = 1; i < n; i++) L[i] = Math.max(L[i], L[i - 1]); for (let i = n - 2; i >= 0; i--) Rt[i] = Math.max(Rt[i], Rt[i + 1]); let best = 0; for (let i = 0; i + 1 < n; i++) { const v = L[i] * Rt[i + 1]; best = Math.max(best, v); if (i < 6) { T.at({ s: A([...s], { i }), leftBest: L[i], rightBest: Rt[i + 1] }); T.n('Product for a cut after this index?', v, 'Best odd palindrome on each side.'); } } return best; }
  });

  D('widest-pair-of-indices-with-equal-range-sum', {
    t: 'Widest Pair of Indices With Equal Range Sum',
    r: 'Equal range sums exactly when equal prefix sums of d = nums1 − nums2. Store the first index of each prefix difference; widest = j − first[prefix].',
    g: R => { const n = R.int(1, 8); return { nums1: R.ints(n, 0, 1), nums2: R.ints(n, 0, 1) }; },
    s(I, T) { const first = { 0: -1 }; let p = 0, best = 0; I.nums1.forEach((x, j) => { p += x - I.nums2[j]; if (p in first) best = Math.max(best, j - first[p]); else first[p] = j; if (j < 8) { T.at({ diff: A(I.nums1.map((v, i) => v - I.nums2[i]), { j }), prefix: p }); T.n('Widest so far?', best, 'First index with the same prefix.'); } }); return best; }
  });

  D('find-the-middle-index-in-array', {
    t: 'Find the Middle Index in Array',
    r: 'Scan with the left sum; the right sum is total − left − nums[i]. Return the first index where they match.',
    g: R => ({ nums: R.ints(R.int(1, 7), -2, 5) }),
    s(I, T) { const tot = I.nums.reduce((a, b) => a + b, 0); let l = 0; for (const [i, x] of I.nums.entries()) { const r = tot - l - x; T.at({ nums: A(I.nums, { i }), left: l, right: r }); T.yn('Middle index?', l === r, 'Left sum = right sum.'); if (l === r) return i; l += x; } return -1; }
  });

  D('sum-of-beauty-in-the-array', {
    t: 'Sum of Beauty in the Array',
    r: 'Precompute prefix maxima and suffix minima. Beauty 2 if max(left) < x < min(right); else 1 if nums[i−1] < x < nums[i+1]; else 0.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, sm = Array(n); sm[n - 1] = a[n - 1]; for (let i = n - 2; i >= 0; i--) sm[i] = Math.min(a[i], sm[i + 1]); let mx = a[0], t = 0; for (let i = 1; i < n - 1; i++) { const b = mx < a[i] && a[i] < sm[i + 1] ? 2 : a[i - 1] < a[i] && a[i] < a[i + 1] ? 1 : 0; t += b; mx = Math.max(mx, a[i]); if (i < 7) { T.at({ nums: A(a, { i }) }); T.n('Beauty of this element?', b, '2 if it splits everything; 1 if it splits its neighbors.'); } } return t; }
  });

  D('maximum-number-of-ways-to-partition-an-array', {
    t: 'Maximum Number of Ways to Partition an Array',
    r: 'A pivot works when prefix = total divided by 2. Changing nums[i] to k shifts total by δ = k − nums[i]: pivots left of i need prefix = (total + δ) divided by 2, pivots at or after i need prefix + δ = (total + δ) divided by 2. Count with left or right prefix maps.',
    g: R => ({ nums: R.ints(R.int(2, 7), -2, 3), k: R.int(-2, 3) }),
    s(I, T) { const res = (() => { const ways = a => { const P = pre(a), tot = P[a.length]; let c = 0; for (let p = 1; p < a.length; p++) if (2 * P[p] === tot) c++; return c; }; let best = ways(I.nums); T.at({ nums: A(I.nums) }); T.n('Total sum?', I.nums.reduce((a, b) => a + b, 0), 'Each side must be half of it.'); T.n('Ways with no change?', best, 'Pivots where the prefix is half the total.'); I.nums.forEach((_, i) => { const b = I.nums.slice(); b[i] = I.k; best = Math.max(best, ways(b)); }); return best; })(); T.n('Most ways after at most one change?', res, 'Try replacing each value with k.'); return res; }
  });

  D('count-subarrays-with-more-ones-than-zeros', {
    t: 'Count Subarrays With More Ones Than Zeros',
    r: 'Map 0 to −1. A subarray has more ones exactly when its sum > 0, i.e. prefix[j] > prefix[i]. Count earlier smaller prefixes (a running count array works since prefixes move by ±1).',
    g: R => ({ nums: R.ints(R.int(1, 9), 0, 1) }),
    s(I, T) { const seen = [0]; let p = 0, t = 0; I.nums.forEach((x, i) => { p += x ? 1 : -1; const add = seen.filter(v => v < p).length; t += add; seen.push(p); if (i < 8) { T.at({ nums: A(I.nums, { i }), prefix: p }); T.n('Good subarrays ending here?', add, 'Earlier prefixes smaller than this one.'); } }); return t % 1000000007; }
  });

  D('intervals-between-identical-elements', {
    t: 'Intervals Between Identical Elements',
    r: 'Group indices by value. In each sorted group with prefix sums, the k-th index p contributes p times k − (sum before) + (sum after) − p times (m − 1 − k).',
    g: R => ({ arr: R.ints(R.int(1, 8), 1, 3) }),
    s(I, T) { const g = {}; I.arr.forEach((v, i) => (g[v] = g[v] || []).push(i)); const out = Array(I.arr.length); let asks = 0; for (const idx of Object.values(g)) { const P = pre(idx), m = idx.length; idx.forEach((p, k) => { out[p] = p * k - P[k] + (P[m] - P[k + 1]) - p * (m - 1 - k); if (asks++ < 6) { T.at({ arr: A(I.arr, { i: p }), sameValueAt: A(idx) }); T.n('Sum of intervals for this index?', out[p], 'Prefix sums within the group.'); } }); } return out; }
  });
})();
