/* v2 games: monotonic stacks (01). */
(function () {
  'use strict';
  const { D, A, G, S } = LCGame.H;
  const MOD = 1000000007;
  const subs = a => { const out = []; for (let i = 0; i < a.length; i++) for (let j = i; j < a.length; j++) out.push(a.slice(i, j + 1)); return out; };
  const largestHist = h => { const st = []; let best = 0; for (let i = 0; i <= h.length; i++) { const x = i < h.length ? h[i] : 0; while (st.length && h[st[st.length - 1]] >= x) { const t = h[st.pop()], l = st.length ? st[st.length - 1] + 1 : 0; best = Math.max(best, t * (i - l)); } st.push(i); } return best; };
  const dedupe = (I, T) => { const s = I.s, last = {}, st = [], inSt = new Set(); [...s].forEach((c, i) => last[c] = i); [...s].forEach((c, i) => { if (inSt.has(c)) return; while (st.length && st[st.length - 1] > c && last[st[st.length - 1]] > i) inSt.delete(st.pop()); st.push(c); inSt.add(c); if (i < 7) { T.at({ s: A([...s], { i }), stack: S(st.slice()) }); T.n('Stack size after this letter?', st.length, 'Pop bigger letters that appear again later.'); } }); return st.join(''); };

  D('maximal-rectangle', {
    t: 'Maximal Rectangle',
    r: 'Row by row, build histogram heights of consecutive 1s ending at that row, and run "largest rectangle in histogram" (monotonic stack) on each.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 5); return { matrix: Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.65) ? '1' : '0')) }; },
    s(I, T) { const n = I.matrix[0].length, h = Array(n).fill(0); let best = 0; I.matrix.forEach((row, r) => { row.forEach((c, j) => h[j] = c === '1' ? h[j] + 1 : 0); const b = largestHist(h); best = Math.max(best, b); T.at({ matrix: G(I.matrix, { row: r }), heights: A(h.slice()) }); T.n('Largest rectangle in this histogram?', b, 'Monotonic stack over heights.'); }); return best; }
  });

  D('remove-duplicate-letters', {
    t: 'Remove Duplicate Letters',
    r: 'Greedy stack: skip letters already kept; otherwise pop larger letters from the top while they occur again later, then push. The stack is the smallest result.',
    g: R => ({ s: R.str(R.int(1, 9), 'abcd') }),
    s: dedupe
  });

  D('132-pattern', {
    t: '132 Pattern',
    r: 'Scan from the right keeping a decreasing stack; popped values become the best "2" (third). If any element is smaller than that "2", a 132 pattern exists.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 6) }),
    s(I, T) { const st = []; let third = -Infinity; for (let i = I.nums.length - 1; i >= 0; i--) { const x = I.nums[i]; if (x < third) { T.at({ nums: A(I.nums, { i }), third }); T.yn('Does this complete a 132 pattern?', true, 'It is smaller than a popped "2".'); return true; } while (st.length && st[st.length - 1] < x) third = st.pop(); st.push(x); T.at({ nums: A(I.nums, { i }), stack: S(st.slice()) }); T.n('Best "2" candidate so far (−∞ shown as −99)?', third === -Infinity ? -99 : third, 'Largest value popped by a bigger element.'); } return false; }
  });

  D('max-chunks-to-make-sorted-ii', {
    t: 'Max Chunks To Make Sorted II',
    r: 'Stack of chunk maxima. For each x: if x at least top, push; else pop all chunks with max > x and push back the largest popped max (merging). Answer = stack size.',
    g: R => ({ arr: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { const st = []; I.arr.forEach((x, i) => { if (!st.length || x >= st[st.length - 1]) st.push(x); else { const m = st.pop(); while (st.length && st[st.length - 1] > x) st.pop(); st.push(m); } if (i < 7) { T.at({ arr: A(I.arr, { i }), chunkMaxes: S(st.slice()) }); T.n('Chunks so far?', st.length, 'Merge every chunk whose max exceeds x.'); } }); return st.length; }
  });

  D('car-fleet', {
    t: 'Car Fleet',
    r: 'Sort by position descending and compute each car\'s arrival time. A car forms a new fleet only if its time exceeds the fleet ahead (stack of times); otherwise it merges.',
    g: R => { const n = R.int(1, 5), target = R.int(8, 14); return { target, position: R.distinct(n, 0, target - 1), speed: R.ints(n, 1, 4) }; },
    s(I, T) { const cars = I.position.map((p, i) => [p, (I.target - p) / I.speed[i]]).sort((a, b) => b[0] - a[0]); let fleets = 0, cur = 0; cars.forEach(([p, t], i) => { const nw = t > cur; if (nw) { fleets++; cur = t; } if (i < 5) { T.at({ position: p, time: +t.toFixed(2), slowestAhead: +cur.toFixed(2) }); T.yn('Starts a new fleet?', nw, 'Slower than everything ahead?'); } }); return fleets; }
  });

  D('number-of-valid-subarrays', {
    t: 'Number of Valid Subarrays',
    r: 'For each start i, the subarray can extend until the next strictly smaller element. Next-smaller indices come from a monotonic stack; sum (next − i).',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 6) }),
    s(I, T) { const a = I.nums, n = a.length; let c = 0; for (let i = 0; i < n; i++) { let j = i + 1; while (j < n && a[j] >= a[i]) j++; c += j - i; if (i < 6) { T.at({ nums: A(a, { i }) }); T.n('Valid subarrays starting here?', j - i, 'Until the next strictly smaller value.'); } } return c; }
  });

  D('smallest-subsequence-of-distinct-characters', {
    t: 'Smallest Subsequence of Distinct Characters',
    r: 'Same greedy stack as Remove Duplicate Letters: pop a larger top while it reappears later; never push a letter already in the stack.',
    g: R => ({ s: R.str(R.int(1, 9), 'abcd') }),
    s: dedupe
  });

  D('longest-well-performing-interval', {
    t: 'Longest Well-Performing Interval',
    r: 'Map tiring days to +1 and others to −1; find the longest subarray with positive sum. With prefix sums P, a decreasing stack of candidate left ends, scanned from the right, finds the widest P[j] > P[i].',
    g: R => ({ hours: Array.from({ length: R.int(1, 8) }, () => R.chance(0.5) ? R.int(9, 12) : R.int(0, 8)) }),
    s(I, T) { const v = I.hours.map(h => h > 8 ? 1 : -1), P = [0]; v.forEach(x => P.push(P[P.length - 1] + x)); let best = 0; for (let j = 1; j < P.length; j++) { let b = 0; for (let i = 0; i < j; i++) if (P[j] > P[i]) { b = j - i; break; } best = Math.max(best, b); if (j <= 5) { T.at({ score: A(v, { i: j - 1 }), prefix: A(P, { i: j }) }); T.n('Longest well-performing interval ending here?', b, 'Earliest prefix strictly lower than this one.'); } } return best; }
  });

  D('find-the-most-competitive-subsequence', {
    t: 'Find the Most Competitive Subsequence',
    r: 'Increasing stack: pop larger tops while enough elements remain to still reach size k; push if the stack has room.',
    g: R => { const n = R.int(1, 8); return { nums: R.ints(n, 0, 9), k: R.int(1, n) }; },
    s(I, T) { const a = I.nums, n = a.length, st = []; a.forEach((x, i) => { while (st.length && st[st.length - 1] > x && st.length - 1 + n - i >= I.k) st.pop(); if (st.length < I.k) st.push(x); if (i < 7) { T.at({ nums: A(a, { i }), stack: S(st.slice()) }); T.n('Stack size now?', st.length, 'Pop bigger tops only if k is still reachable.'); } }); return st; }
  });

  D('buildings-with-an-ocean-view', {
    t: 'Buildings With an Ocean View',
    r: 'Scan from the right tracking the tallest building seen; a building has a view exactly when it is strictly taller than all to its right.',
    g: R => ({ heights: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { const out = []; let mx = 0; for (let i = I.heights.length - 1; i >= 0; i--) { const v = I.heights[i] > mx; if (v) out.unshift(i); mx = Math.max(mx, I.heights[i]); if (I.heights.length - i <= 6) { T.at({ heights: A(I.heights, { i }) }); T.yn('Ocean view?', v, 'Taller than everything to the right.'); } } return out; }
  });

  D('car-fleet-ii', {
    t: 'Car Fleet II',
    r: 'Process cars from the back with a stack of candidates ahead. Pop a car if it is not slower than us, or if it collides (joins a fleet) before we would reach it. The top then gives our collision time.',
    cmp: (o, e) => Array.isArray(o) && o.length === e.length && o.every((x, i) => Math.abs(x - e[i]) < 1e-5),
    g: R => { const n = R.int(1, 5); return { cars: R.distinct(n, 1, 12).sort((a, b) => a - b).map(p => [p, R.int(1, 4)]) }; },
    s(I, T) { const c = I.cars, n = c.length, ans = Array(n).fill(-1), st = []; const tm = (i, j) => (c[j][0] - c[i][0]) / (c[i][1] - c[j][1]); for (let i = n - 1; i >= 0; i--) { while (st.length) { const j = st[st.length - 1]; if (c[i][1] <= c[j][1] || (ans[j] !== -1 && tm(i, j) > ans[j])) st.pop(); else break; } if (st.length) ans[i] = tm(i, st[st.length - 1]); st.push(i); if (n - i <= 5) { T.at({ car: `pos ${c[i][0]}, speed ${c[i][1]}`, stack: S(st.slice()) }); T.yn('Does this car ever collide?', ans[i] !== -1, 'Is there a slower car ahead it reaches in time?'); } } return ans; }
  });

  D('maximum-subarray-min-product', {
    t: 'Maximum Subarray Min-Product',
    r: 'Treat each element as the minimum: monotonic stacks give the widest span where it is the min; prefix sums give that span\'s sum. Maximize min times sum, then mod 1e9+7.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 8) }),
    s(I, T) { const a = I.nums; let best = 0; a.forEach((x, i) => { let l = i, r = i; while (l > 0 && a[l - 1] >= x) l--; while (r + 1 < a.length && a[r + 1] >= x) r++; const s = a.slice(l, r + 1).reduce((p, q) => p + q, 0); best = Math.max(best, x * s); if (i < 5) { T.at({ nums: A(a, { i, l, r }) }); T.n('Min-product with this as the minimum?', x * s, `${x} times span sum ${s}.`); } }); return best % MOD; }
  });

  D('number-of-visible-people-in-a-queue', {
    t: 'Number of Visible People in a Queue',
    r: 'Scan from the right with a decreasing stack. Person i sees everyone it pops (shorter), plus the first taller one left on the stack.',
    g: R => ({ heights: R.distinct(R.int(1, 7), 1, 12) }),
    s(I, T) { const h = I.heights, n = h.length, ans = Array(n).fill(0), st = []; for (let i = n - 1; i >= 0; i--) { while (st.length && st[st.length - 1] < h[i]) { st.pop(); ans[i]++; } if (st.length) ans[i]++; st.push(h[i]); if (n - i <= 6) { T.at({ heights: A(h, { i }), stack: S(st.slice()) }); T.n('People this person sees?', ans[i], 'Popped shorter ones + the next taller.'); } } return ans; }
  });

  D('maximum-of-minimum-values-in-all-subarrays', {
    t: 'Maximum of Minimum Values in All Subarrays',
    r: 'For each element, find the widest window where it is the minimum (monotonic stacks); it is a candidate for that window length. Then propagate maxima from longer to shorter lengths.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 9) }),
    s(I, T) { const a = I.nums, n = a.length, ans = Array(n).fill(0); a.forEach((x, i) => { let l = i, r = i; while (l > 0 && a[l - 1] >= x) l--; while (r + 1 < n && a[r + 1] >= x) r++; const w = r - l + 1; ans[w - 1] = Math.max(ans[w - 1], x); if (i < 5) { T.at({ nums: A(a, { i, l, r }) }); T.n('Widest window where it is the minimum?', w, 'Next smaller on both sides.'); } }); for (let i = n - 2; i >= 0; i--) ans[i] = Math.max(ans[i], ans[i + 1]); return ans; }
  });
})();
