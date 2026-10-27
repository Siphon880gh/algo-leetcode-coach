/* v2 games: arrays (02). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);
  const street = (I, T, canOpen) => { const d = I.street.slice(), n = d.length, k = I.k; let pos = 0; const mv = () => { pos = (pos + 1) % n; }; if (canOpen) { for (let i = 0; i < k; i++) { d[pos] = 0; mv(); } d[pos] = 1; let steps = 0; do { mv(); steps++; if (steps <= 4 || d[pos]) { T.at({ doors: A(d.slice(), { i: pos }) }); T.yn('Is this door open?', !!d[pos], 'Only the one we opened is.'); } } while (!d[pos]); return steps; } while (!d[pos]) mv(); let ans = 0; for (let i = 1; i <= k; i++) { mv(); if (d[pos]) { d[pos] = 0; ans = i; T.at({ doors: A(d.slice(), { i: pos }), step: i }); T.n('Distance recorded (last open door seen)?', ans, 'Close it and remember how far we walked.'); } } return ans; };

  D('the-employee-that-worked-on-the-longest-task', {
    t: 'The Employee That Worked on the Longest Task',
    r: 'Each task lasts leaveTime − previous leaveTime (the first starts at 0). Track the longest, breaking ties by the smaller id.',
    g: R => { let t = 0; return { n: 5, logs: Array.from({ length: R.int(1, 5) }, () => [R.int(0, 4), t += R.int(1, 6)]) }; },
    s(I, T) { let prev = 0, best = -1, id = -1; I.logs.forEach(([e, t], i) => { const d = t - prev; prev = t; if (d > best || (d === best && e < id)) { best = d; id = e; } if (i < 5) { T.at({ log: `employee ${e} leaves at ${t}` }); T.n('Task duration?', d, 'leaveTime − previous leaveTime.'); } }); return id; }
  });

  D('find-the-maximum-divisibility-score', {
    t: 'Find the Maximum Divisibility Score',
    r: 'For each divisor count the nums it divides; return the divisor with the highest score, smallest on ties.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 20), divisors: R.ints(R.int(1, 4), 1, 6) }),
    s(I, T) { let best = -1, bd = 0; I.divisors.forEach((d, i) => { const s = I.nums.filter(x => x % d === 0).length; if (s > best || (s === best && d < bd)) { best = s; bd = d; } if (i < 4) { T.at({ nums: A(I.nums), divisor: d }); T.n('Divisibility score?', s, 'How many nums it divides.'); } }); return bd; }
  });

  D('number-of-adjacent-elements-with-the-same-color', {
    t: 'Number of Adjacent Elements With the Same Color',
    r: 'Maintain the count of equal colored neighbor pairs. Before recoloring index i, remove pairs it formed with i−1 and i+1; after, add the new ones.',
    g: R => { const n = R.int(1, 5); return { n, queries: Array.from({ length: R.int(1, 5) }, () => [R.int(0, n - 1), R.int(1, 2)]) }; },
    s(I, T) { const c = Array(I.n).fill(0); let cnt = 0; return I.queries.map(([i, col], k) => { for (const j of [i - 1, i + 1]) if (j >= 0 && j < I.n && c[i] && c[j] === c[i]) cnt--; c[i] = col; for (const j of [i - 1, i + 1]) if (j >= 0 && j < I.n && c[j] === col) cnt++; if (k < 5) { T.at({ colors: A(c.slice(), { i }) }); T.n('Equal adjacent pairs?', cnt, 'Update only around i.'); } return cnt; }); }
  });

  D('count-houses-in-a-circular-street', {
    t: 'Count Houses in a Circular Street',
    r: 'Close every door while walking k houses (k ≥ n, so all are closed). Open the current door, then walk forward counting steps until you see an open door again — that count is n.',
    g: R => ({ street: R.ints(R.int(1, 6), 0, 1), k: 8 }),
    s(I, T) { return street(I, T, true); }
  });

  D('count-houses-in-a-circular-street-ii', {
    t: 'Count Houses in a Circular Street II',
    r: 'Some door is open. Walk to an open door, then keep walking: each open door you meet, close it and remember the distance from your start. When a full lap passes with no open door left within k steps, the last recorded distance is n.',
    g: R => { const s = R.ints(R.int(1, 6), 0, 1); s[R.int(0, s.length - 1)] = 1; return { street: s, k: 8 }; },
    s(I, T) { return street(I, T, false); }
  });

  D('collecting-chocolates', {
    t: 'Collecting Chocolates',
    r: 'With k rotations (cost k·x), chocolate type i can be bought at the cheapest of nums[i..i+k] (circularly). Try every k from 0 to n − 1, keeping a running min per type.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 20), x: R.int(1, 10) }),
    s(I, T) { const n = I.nums.length, m = I.nums.slice(); let best = sum(m); for (let k = 0; k < n; k++) { if (k) for (let i = 0; i < n; i++) m[i] = Math.min(m[i], I.nums[(i + k) % n]); const c = k * I.x + sum(m); best = Math.min(best, c); if (k < 4) { T.at({ cheapest: A(m.slice()), rotations: k }); T.n('Total cost with this many rotations?', c, 'k·x + Σ cheapest.'); } } return best; }
  });

  D('longest-alternating-subarray', {
    t: 'Longest Alternating Subarray',
    r: 'From each start where nums[i+1] = nums[i] + 1, extend while the differences keep alternating +1, −1, …; track the longest (−1 if none).',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 4) }),
    s(I, T) { const res = (() => { let best = -1; T.at({ nums: A(I.nums) }); T.n('Neighbouring pairs that go up by exactly 1?', I.nums.filter((x, i) => i && x === I.nums[i - 1] + 1).length, 'Each one can start a run.'); for (let i = 0; i + 1 < I.nums.length; i++) { if (I.nums[i + 1] !== I.nums[i] + 1) continue; let j = i + 1; while (j + 1 < I.nums.length && I.nums[j + 1] - I.nums[j] === ((j - i) % 2 ? -1 : 1)) j++; best = Math.max(best, j - i + 1); T.at({ nums: A(I.nums, { i, j }) }); T.n('Alternating length from here?', j - i + 1, 'Up 1, down 1, up 1, and so on.'); } return best; })(); T.n('Longest alternating length? (−1 if none)', res, 'Best over every start.'); return res; }
  });

  D('number-of-employees-who-met-the-target', {
    t: 'Number of Employees Who Met the Target',
    r: 'Count hours[i] ≥ target.',
    g: R => ({ hours: R.ints(R.int(1, 6), 0, 9), target: R.int(0, 9) }),
    s(I, T) { let c = 0; I.hours.forEach((h, i) => { if (h >= I.target) c++; if (i < 6) { T.at({ hours: A(I.hours, { i }) }); T.yn('Met the target?', h >= I.target, `≥ ${I.target}.`); } }); return c; }
  });

  D('minimum-right-shifts-to-sort-the-array', {
    t: 'Minimum Right Shifts to Sort the Array',
    r: 'Find the single descent (if any). Sortable by rotation only if there is at most one descent and the last element is below the first; the shifts needed are n − (descent index + 1).',
    g: R => { const s = R.distinct(R.int(1, 6), 1, 20).sort((a, b) => a - b), k = R.int(0, s.length - 1), a = [...s.slice(k), ...s.slice(0, k)]; if (R.chance(0.3) && a.length > 2) [a[0], a[1]] = [a[1], a[0]]; return { nums: a }; },
    s(I, T) { const res = (() => { const n = I.nums.length, drops = []; for (let i = 0; i + 1 < n; i++) if (I.nums[i] > I.nums[i + 1]) drops.push(i); T.at({ nums: A(I.nums) }); T.n('Descents inside the array?', drops.length, 'Places where a value drops.'); T.n('Index of the smallest value?', I.nums.indexOf(Math.min(...I.nums)), 'It must end up at index 0.'); if (!drops.length) return 0; if (drops.length > 1 || I.nums[n - 1] > I.nums[0]) return -1; return n - drops[0] - 1; })(); T.n('Fewest right shifts? (−1 if impossible)', res, 'Shift the smallest value to the front.'); return res; }
  });

  D('maximum-value-of-an-ordered-triplet-i', {
    t: 'Maximum Value of an Ordered Triplet I',
    r: 'Scan k left to right keeping the best prefix max and the best (max_i − nums[j]) so far; value = bestDiff × nums[k] (or 0).',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 20) }),
    s(I, T) { let mx = 0, diff = 0, best = 0; I.nums.forEach((x, k) => { best = Math.max(best, diff * x); diff = Math.max(diff, mx - x); mx = Math.max(mx, x); if (k < 6) { T.at({ nums: A(I.nums, { i: k }), bestDiff: diff }); T.n('Best value so far?', best, 'bestDiff × nums[k].'); } }); return best; }
  });

  D('maximum-value-of-an-ordered-triplet-ii', {
    t: 'Maximum Value of an Ordered Triplet II',
    r: 'One pass: as each element arrives, first use it as k (bestDiff × x), then as j (update bestDiff = max(prefixMax − x)), then as i (update prefixMax).',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 20) }),
    s(I, T) { let mx = 0, diff = 0, best = 0; I.nums.forEach((x, k) => { best = Math.max(best, diff * x); diff = Math.max(diff, mx - x); mx = Math.max(mx, x); if (k < 6) { T.at({ nums: A(I.nums, { i: k }), prefixMax: mx }); T.n('Best (prefixMax − nums[j]) so far?', diff, 'Update after using x as k.'); } }); return best; }
  });

  D('minimum-sum-of-mountain-triplets-i', {
    t: 'Minimum Sum of Mountain Triplets I',
    r: 'For each peak j, take the smallest value left of it and the smallest right of it; if both are below nums[j], that triplet is a candidate.',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 12) }),
    s(I, T) { const a = I.nums, n = a.length; let best = Infinity; for (let j = 1; j + 1 < n; j++) { const l = Math.min(...a.slice(0, j)), r = Math.min(...a.slice(j + 1)); const ok = l < a[j] && r < a[j]; if (ok) best = Math.min(best, l + a[j] + r); if (j < 6) { T.at({ nums: A(a, { i: j }) }); T.yn('Is this a valid peak?', ok, 'Both side minima must be smaller.'); } } return best === Infinity ? -1 : best; }
  });

  D('minimum-operations-to-maximize-last-elements-in-arrays', {
    t: 'Minimum Operations to Maximize Last Elements in Arrays',
    r: 'Try two cases: keep the last pair as is, or swap it (1 op). For every other index, it must fit under both maxima either as is or swapped (count a swap); if neither, the case fails.',
    g: R => { const n = R.int(1, 5); return { nums1: R.ints(n, 1, 9), nums2: R.ints(n, 1, 9) }; },
    s(I, T) { const res = (() => { const n = I.nums1.length, run = (l1, l2, base) => { let c = base; for (let i = 0; i + 1 < n; i++) { const a = I.nums1[i], b = I.nums2[i]; if (a <= l1 && b <= l2) continue; if (b <= l1 && a <= l2) c++; else return Infinity; } return c; }; const k = run(I.nums1[n - 1], I.nums2[n - 1], 0), s = run(I.nums2[n - 1], I.nums1[n - 1], 1); T.at({ nums1: A(I.nums1), nums2: A(I.nums2) }); T.n('Operations if we keep the last pair? (−1 if impossible)', k === Infinity ? -1 : k, 'Swap whatever does not fit.'); T.n('Operations if we swap the last pair? (−1 if impossible)', s === Infinity ? -1 : s, 'One swap at the end, plus fixes.'); const r = Math.min(k, s); return r === Infinity ? -1 : r; })(); T.n('Fewest operations? (−1 if impossible)', res, 'The better of the two plans.'); return res; }
  });

  D('find-the-peaks', {
    t: 'Find the Peaks',
    r: 'Return interior indices strictly greater than both neighbors.',
    g: R => ({ mountain: R.ints(R.int(3, 8), 1, 9) }),
    s(I, T) { const m = I.mountain, out = []; for (let i = 1; i + 1 < m.length; i++) { const p = m[i] > m[i - 1] && m[i] > m[i + 1]; if (p) out.push(i); if (i < 6) { T.at({ mountain: A(m, { i }) }); T.yn('Peak?', p, 'Strictly above both neighbors.'); } } return out; }
  });

  D('maximum-area-of-longest-diagonal-rectangle', {
    t: 'Maximum Area of Longest Diagonal Rectangle',
    r: 'Compare squared diagonals l² + w²; among the longest, take the largest area.',
    g: R => ({ dimensions: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 9), R.int(1, 9)]) }),
    s(I, T) { let bd = -1, ba = 0; I.dimensions.forEach(([l, w], i) => { const d = l * l + w * w; if (d > bd || (d === bd && l * w > ba)) { bd = d; ba = l * w; } if (i < 5) { T.at({ rect: `${l} × ${w}` }); T.n('Squared diagonal?', d, 'l² + w².'); } }); return ba; }
  });

  D('minimum-operations-to-exceed-threshold-value-i', {
    t: 'Minimum Operations to Exceed Threshold Value I',
    r: 'Removing the smallest repeatedly removes exactly the elements below k, so count them.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12), k: R.int(1, 10) }),
    s(I, T) { let c = 0; I.nums.forEach((x, i) => { if (x < I.k) c++; if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.yn(`Below ${I.k}?`, x < I.k, 'Must be removed.'); } }); return c; }
  });

  D('maximum-increasing-triplet-value', {
    t: 'Maximum Increasing Triplet Value',
    r: 'For each middle j, use the largest value to its right (suffix max, must exceed nums[j]) and the largest value to its left that is smaller than nums[j] (ordered set). Value = left − nums[j] + right.',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 12) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length; let best = -Infinity; for (let j = 1; j + 1 < n; j++) { const left = a.slice(0, j).filter(x => x < a[j]), right = Math.max(...a.slice(j + 1)); if (!left.length || right <= a[j]) continue; const v = Math.max(...left) - a[j] + right; best = Math.max(best, v); T.at({ nums: A(a, { i: j }) }); T.n('Best value with this middle?', v, 'Largest smaller value on the left, minus the middle, plus the largest on the right.'); } return best; })(); T.n('Maximum triplet value?', res, 'Best over every middle.'); return res; }
  });

  D('longest-strictly-increasing-or-strictly-decreasing-subarray', {
    t: 'Longest Strictly Increasing or Strictly Decreasing Subarray',
    r: 'Track the current increasing run and decreasing run lengths; reset each when the direction breaks.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 5) }),
    s(I, T) { let inc = 1, dec = 1, best = 1; for (let i = 1; i < I.nums.length; i++) { inc = I.nums[i] > I.nums[i - 1] ? inc + 1 : 1; dec = I.nums[i] < I.nums[i - 1] ? dec + 1 : 1; best = Math.max(best, inc, dec); if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.n('Increasing run ending here?', inc, 'Reset when not strictly larger.'); } } return best; }
  });

  D('find-the-integer-added-to-array-i', {
    t: 'Find the Integer Added to Array I',
    r: 'Adding x shifts every element, so x = min(nums2) − min(nums1).',
    g: R => { const a = R.ints(R.int(1, 5), 0, 9), x = R.int(-5, 5); return { nums1: a, nums2: R.shuffle(a.map(v => v + x)) }; },
    s(I, T) { const res = (() => { T.at({ nums1: A(I.nums1), nums2: A(I.nums2) }); T.n('Smallest value in nums1?', Math.min(...I.nums1), 'Smallest maps to smallest.'); T.n('Smallest value in nums2?', Math.min(...I.nums2), 'Its partner.'); return Math.min(...I.nums2) - Math.min(...I.nums1); })(); T.n('Integer added?', res, 'Difference of the two minimums.'); return res; }
  });

  D('special-array-i', {
    t: 'Special Array I',
    r: 'Every adjacent pair must have different parity.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const res = (() => { for (let i = 1; i < I.nums.length; i++) { const ok = I.nums[i] % 2 !== I.nums[i - 1] % 2; T.at({ nums: A(I.nums, { i, j: i - 1 }) }); T.yn('Different parity?', ok, 'One odd, one even.'); if (!ok) return false; } return true; })(); T.yn('Is the array special?', res, 'Every neighbouring pair differs in parity.'); return res; }
  });

  D('find-indices-of-stable-mountains', {
    t: 'Find Indices of Stable Mountains',
    r: 'Mountain i (i ≥ 1) is stable if height[i − 1] > threshold.',
    g: R => ({ height: R.ints(R.int(2, 7), 1, 9), threshold: R.int(1, 8) }),
    s(I, T) { const out = []; for (let i = 1; i < I.height.length; i++) { const ok = I.height[i - 1] > I.threshold; if (ok) out.push(i); if (i < 6) { T.at({ height: A(I.height, { i, j: i - 1 }) }); T.yn('Stable?', ok, 'Previous mountain above threshold.'); } } return out; }
  });

  D('adjacent-increasing-subarrays-detection-i', {
    t: 'Adjacent Increasing Subarrays Detection I',
    r: 'Compute inc[i] = length of the strictly increasing run ending at i. Two adjacent increasing windows of length k exist if some run is ≥ 2k, or two consecutive runs are both ≥ k.',
    g: R => { const k = R.int(1, 3); return { nums: R.ints(R.int(2 * k, 9), 1, 9), k }; },
    s(I, T) { const a = I.nums, k = I.k, inc = a.map(() => 1); for (let i = 1; i < a.length; i++) if (a[i] > a[i - 1]) inc[i] = inc[i - 1] + 1; for (let s = 0; s + 2 * k <= a.length; s++) { const ok = inc[s + k - 1] >= k && inc[s + 2 * k - 1] >= k; if (s < 5) { T.at({ nums: A(a, { i: s, j: s + 2 * k - 1 }) }); T.yn('Both windows strictly increasing?', ok, 'Run length at each window end ≥ k.'); } if (ok) return true; } return false; }
  });

  D('minimum-total-operations', {
    t: 'Minimum Total Operations',
    r: 'An operation on a prefix can fix one "step" between neighbors. Each index where nums[i] ≠ nums[i + 1] needs exactly one operation.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 4) }),
    s(I, T) { let c = 0; for (let i = 0; i + 1 < I.nums.length; i++) { const d = I.nums[i] !== I.nums[i + 1]; if (d) c++; if (i < 6) { T.at({ nums: A(I.nums, { i, j: i + 1 }) }); T.yn('Is there a step here?', d, 'Different neighbors.'); } } return c; }
  });

  D('button-with-longest-push-time', {
    t: 'Button with Longest Push Time',
    r: 'Push time = time − previous event\'s time (the first event\'s time counts from 0). Return the button with the longest, smallest index on ties.',
    g: R => { let t = 0; return { events: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 5), t += R.int(1, 6)]) }; },
    s(I, T) { let prev = I.events[0][1], best = I.events[0][1], b = I.events[0][0]; I.events.forEach(([id, t], i) => { const d = i ? t - prev : t; prev = t; if (d > best || (d === best && id < b)) { best = d; b = id; } if (i < 5) { T.at({ event: `button ${id} at ${t}` }); T.n('Push time?', d, 'Difference from the previous event.'); } }); return b; }
  });

  D('count-subarrays-of-length-three-with-a-condition', {
    t: 'Count Subarrays of Length Three With a Condition',
    r: 'Check every window [a, b, c]: count it if 2·(a + c) == b.',
    g: R => ({ nums: R.ints(R.int(3, 8), -4, 8) }),
    s(I, T) { let c = 0; for (let i = 0; i + 2 < I.nums.length; i++) { const ok = 2 * (I.nums[i] + I.nums[i + 2]) === I.nums[i + 1]; if (ok) c++; if (i < 6) { T.at({ nums: A(I.nums, { i, j: i + 2 }) }); T.yn('Is a + c exactly half of the middle?', ok, '2(a + c) == b.'); } } return c; }
  });

  D('maximum-difference-between-adjacent-elements-in-a-circular-array', {
    t: 'Maximum Difference Between Adjacent Elements in a Circular Array',
    r: 'Take the max |nums[i] − nums[(i+1) mod n]| including the wrap-around pair.',
    g: R => ({ nums: R.ints(R.int(2, 6), -9, 9) }),
    s(I, T) { const n = I.nums.length; let b = 0; for (let i = 0; i < n; i++) { const d = Math.abs(I.nums[i] - I.nums[(i + 1) % n]); b = Math.max(b, d); if (i < 6) { T.at({ nums: A(I.nums, { i, j: (i + 1) % n }) }); T.n('Difference here?', d, 'Absolute difference.'); } } return b; }
  });

  D('sum-of-good-numbers', {
    t: 'Sum of Good Numbers',
    r: 'nums[i] is good if it is strictly greater than nums[i − k] and nums[i + k] whenever those exist. Sum the good ones.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 9), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums, k = I.k; let s = 0; a.forEach((x, i) => { const ok = (i - k < 0 || x > a[i - k]) && (i + k >= a.length || x > a[i + k]); if (ok) s += x; if (i < 6) { T.at({ nums: A(a, { i }) }); T.yn('Good?', ok, 'Beats the elements k away (if present).'); } }); return s; }
  });
})();
