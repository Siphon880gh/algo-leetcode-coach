/* v2 games: binary search (03). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const firstTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search left (hi = mid).' : 'Not feasible: search right (lo = mid + 1).'); asks++; } if (v) hi = mid; else lo = mid + 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };
  const lastTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi + 1) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search right (lo = mid).' : 'Not feasible: search left (hi = mid − 1).'); asks++; } if (v) lo = mid; else hi = mid - 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };
  const lowerBound = (a, x) => { let lo = 0, hi = a.length; while (lo < hi) { const m = (lo + hi) >> 1; if (a[m] < x) lo = m + 1; else hi = m; } return lo; };
  const upperBound = (a, x) => { let lo = 0, hi = a.length; while (lo < hi) { const m = (lo + hi) >> 1; if (a[m] <= x) lo = m + 1; else hi = m; } return lo; };
  const asc = a => a.slice().sort((x, y) => x - y);
  const gcd = (a, b) => b ? gcd(b, a % b) : a;
  const pc = x => { let c = 0; while (x) { c += x & 1; x = Math.floor(x / 2); } return c; };

  D('pour-water-between-buckets-to-make-water-levels-equal', {
    t: 'Pour Water to Equal Levels: search the level',
    r: 'Binary search level L (real). Water above L poured out arrives with (1 − loss%) efficiency; L works if that covers the deficit below L.',
    cmp: 'float',
    g: R => ({ buckets: R.ints(R.int(1, 4), 0, 9), loss: R.pick([0, 10, 50, 80]) }),
    s(I, T) { const b = I.buckets, f = 1 - I.loss / 100, ok = L => b.reduce((s, x) => s + Math.max(0, x - L), 0) * f >= b.reduce((s, x) => s + Math.max(0, L - x), 0); const lo0 = Math.min(...b), hi0 = Math.max(...b), mid = (lo0 + hi0) / 2; T.at({ buckets: A(b), loss: I.loss }); T.n('Lowest bucket?', lo0, 'The answer is at least this.'); T.n('Highest bucket?', hi0, 'The answer is at most this.'); T.yn(`Can every bucket reach level ${mid}?`, ok(mid), 'Poured water times what survives, compared with the deficit.'); let lo = lo0, hi = hi0; for (let it = 0; it < 60; it++) { const m = (lo + hi) / 2; if (ok(m)) lo = m; else hi = m; } return lo; }
  });

  D('maximum-running-time-of-n-computers', {
    t: 'Maximum Running Time of n Computers',
    r: 'Binary search time t: each battery contributes at most t; t works if Σ min(b, t) ≥ n·t.',
    g: R => ({ n: R.int(1, 3), batteries: R.ints(R.int(3, 6), 1, 9) }),
    s(I, T) { const ok = t => I.batteries.reduce((s, b) => s + Math.min(b, t), 0) >= I.n * t; return lastTrue(0, Math.floor(I.batteries.reduce((a, b) => a + b, 0) / I.n), ok, T, t => ({ batteries: A(I.batteries), usable: I.batteries.reduce((s, b) => s + Math.min(b, t), 0) }), t => `Can ${I.n} computers run for ${t} minutes?`); }
  });

  D('minimum-time-to-complete-trips', {
    t: 'Minimum Time to Complete Trips',
    r: 'Binary search t: trips = Σ ⌊t / time[i]⌋; the first t with trips ≥ total.',
    g: R => ({ time: R.ints(R.int(1, 4), 1, 6), totalTrips: R.int(1, 12) }),
    s(I, T) { const tr = t => I.time.reduce((s, x) => s + Math.floor(t / x), 0); return firstTrue(1, Math.min(...I.time) * I.totalTrips, t => tr(t) >= I.totalTrips, T, t => ({ trips: tr(t) }), t => `By time ${t}, are there ≥ ${I.totalTrips} trips?`); }
  });

  D('sum-of-scores-of-built-strings', {
    t: 'Sum of Scores of Built Strings: Z-function',
    r: 'Each built string is a suffix of s; its score is its longest common prefix with s = z[i] (and n for the whole string). Sum the Z-array.',
    g: R => ({ s: R.str(R.int(1, 9), 'ab') }),
    s(I, T) { const s = I.s, n = s.length, z = Array(n).fill(0); let l = 0, r = 0; for (let i = 1; i < n; i++) { if (i < r) z[i] = Math.min(r - i, z[i - l]); while (i + z[i] < n && s[z[i]] === s[i + z[i]]) z[i]++; if (i + z[i] > r) { l = i; r = i + z[i]; } if (i <= 5) { T.at({ s: A([...s], { hl: [i] }), z: A(z.slice(0, i + 1)) }); T.n(`z[${i}]?`, z[i], 'Longest common prefix of s and s[i..].'); } } if (n === 1) T.n('Score of a one-letter string?', 1, 'It matches itself.'); return n + z.reduce((a, b) => a + b, 0); }
  });

  D('maximum-candies-allocated-to-k-children', {
    t: 'Maximum Candies for k Children',
    r: 'Binary search pile size x: Σ ⌊c / x⌋ piles; the largest x giving ≥ k piles (0 if none).',
    g: R => ({ candies: R.ints(R.int(1, 4), 1, 12), k: R.int(1, 12) }),
    s(I, T) { const piles = x => I.candies.reduce((s, c) => s + Math.floor(c / x), 0); return lastTrue(0, Math.max(...I.candies), x => x === 0 || piles(x) >= I.k, T, x => ({ candies: A(I.candies), piles: x ? piles(x) : '—' }), x => `Can ${I.k} children each get ${x}?`); }
  });

  D('maximum-total-beauty-of-the-gardens', {
    t: 'Maximum Total Beauty of Gardens',
    r: 'Sort. Try each count of complete gardens (the largest ones). Pay to raise them to target, then binary search the best minimum (< target) for the rest with the leftover flowers.',
    g: R => ({ flowers: R.ints(R.int(1, 5), 1, 8), newFlowers: R.int(1, 12), target: R.int(2, 8), full: R.int(1, 10), partial: R.int(1, 5) }),
    s(I, T) { const res = (() => { const n = I.flowers.length, f = asc(I.flowers.map(x => Math.min(x, I.target))), P = [0]; f.forEach(x => P.push(P[P.length - 1] + x)); const pre = f.filter(x => x >= I.target).length; let best = 0, cost = 0; for (let c = 0; c <= n; c++) { if (c > 0) cost += I.target - f[n - c]; if (c < pre) continue; if (cost > I.newFlowers) break; const rem = I.newFlowers - cost, m = n - c; let v = c * I.full; if (m > 0) { let lo = f[0], hi = I.target - 1; while (lo < hi) { const mid = Math.floor((lo + hi + 1) / 2), k = lowerBound(f.slice(0, m), mid); if (mid * k - P[k] <= rem) lo = mid; else hi = mid - 1; } v += lo * I.partial; if (c <= pre + 2) { T.at({ flowers: A(f, { win: [m, n - 1] }), leftover: rem }); T.n(`Best minimum of the incomplete gardens with ${c} complete?`, lo, 'Binary search the level the leftovers can reach.'); } } best = Math.max(best, v); } return best; })(); T.n('Maximum total beauty?', res, 'Best over every count of complete gardens.'); return res; }
  });

  D('number-of-flowers-in-full-bloom', {
    t: 'Flowers in Full Bloom: two sorted lists',
    r: 'Sort starts and ends. Blooming at t = (#starts ≤ t) − (#ends < t), each found by binary search.',
    g: R => ({ flowers: Array.from({ length: R.int(1, 5) }, () => { const s = R.int(1, 9); return [s, s + R.int(0, 4)]; }), people: R.ints(R.int(1, 4), 1, 12) }),
    s(I, T) { const st = asc(I.flowers.map(f => f[0])), en = asc(I.flowers.map(f => f[1])); return I.people.map(t => { const a = upperBound(st, t), b = lowerBound(en, t); T.at({ starts: A(st), ends: A(en), time: t }); T.n(`Flowers started by ${t}?`, a, 'Starts ≤ t.'); return a - b; }); }
  });

  D('maximum-white-tiles-covered-by-a-carpet', {
    t: 'Maximum White Tiles Under a Carpet',
    r: 'Sort tiles. Starting the carpet at each tile\'s left end is optimal; with prefix sums and a binary search for the last tile it reaches, add full tiles plus the partial last one.',
    g: R => { const t = []; let x = 1; for (let i = 0; i < R.int(1, 4); i++) { x += R.int(0, 3); const l = x; x += R.int(0, 3); t.push([l, x]); x += 1; } return { tiles: R.shuffle(t), carpetLen: R.int(1, 8) }; },
    s(I, T) { const t = I.tiles.slice().sort((a, b) => a[0] - b[0]); let best = 0; t.forEach(([l], i) => { const end = l + I.carpetLen - 1; let c = 0; for (const [a, b] of t) c += Math.max(0, Math.min(b, end) - Math.max(a, l) + 1); T.at({ tiles: A(t.map(x => x.join('-'))), carpet: `${l}..${end}` }); T.n(`Tiles covered starting at ${l}?`, c, 'Full tiles plus the partial last one.'); best = Math.max(best, c); }); return best; }
  });

  D('successful-pairs-of-spells-and-potions', {
    t: 'Successful Pairs of Spells and Potions',
    r: 'Sort potions. For each spell s, binary search the first potion ≥ ⌈success / s⌉; everything after works.',
    g: R => ({ spells: R.ints(R.int(1, 4), 1, 6), potions: R.ints(R.int(1, 6), 1, 6), success: R.int(1, 30) }),
    s(I, T) { const p = asc(I.potions); return I.spells.map(s => { const need = Math.ceil(I.success / s), k = lowerBound(p, need); T.at({ potions: A(p, { win: [k, p.length - 1] }), spell: s }); T.n(`Minimum potion strength for spell ${s}?`, need, `⌈${I.success}/${s}⌉.`); return p.length - k; }); }
  });

  D('count-subarrays-with-score-less-than-k', {
    t: 'Subarrays With Score Less Than k',
    r: 'Sliding window: extend right, shrink left while sum × length ≥ k; every window ending at r with start ≥ l counts.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6), k: R.int(1, 40) }),
    s(I, T) { let l = 0, s = 0, c = 0; for (let r = 0; r < I.nums.length; r++) { s += I.nums[r]; while (l <= r && s * (r - l + 1) >= I.k) s -= I.nums[l++]; if (r < 6) { T.at({ nums: A(I.nums, { win: [l, r] }) }); T.n(`Valid subarrays ending at ${r}?`, r - l + 1, 'All starts from l to r.'); } c += r - l + 1; } return c; }
  });

  D('the-latest-time-to-catch-a-bus', {
    t: 'Latest Time to Catch a Bus',
    r: 'Simulate boarding in time order. For the last bus: if it has room, try its departure time; else the last boarded passenger\'s time − 1. Step back past times already taken by passengers.',
    g: R => ({ buses: R.distinct(R.int(1, 3), 2, 20), passengers: R.distinct(R.int(1, 6), 2, 20), capacity: R.int(1, 3) }),
    s(I, T) { const res = (() => { const b = asc(I.buses), p = asc(I.passengers); let j = 0, cnt = 0; for (const t of b) { cnt = 0; while (j < p.length && p[j] <= t && cnt < I.capacity) { j++; cnt++; } } T.at({ buses: A(b), passengers: A(p, { win: [0, j - 1] }) }); T.n('Passengers who board a bus?', j, 'Fill buses in time order.'); T.yn('Does the last bus leave with room?', cnt < I.capacity, `${cnt} of ${I.capacity} seats used.`); let cand = cnt < I.capacity ? b[b.length - 1] : p[j - 1], k = j - 1; while (k >= 0 && p[k] === cand) { cand--; k--; } return cand; })(); T.n('Latest arrival time?', res, 'Step back past anyone already at that time.'); return res; }
  });

  D('minimum-sum-of-squared-difference', {
    t: 'Minimum Sum of Squared Difference',
    r: 'Only |d| matters and k = k1 + k2 unit moves. Binary search the cap L where cutting every difference to L costs ≤ k; spend the rest lowering capped ones by 1.',
    g: R => { const n = R.int(1, 5); return { nums1: R.ints(n, 0, 9), nums2: R.ints(n, 0, 9), k1: R.int(0, 4), k2: R.int(0, 4) }; },
    s(I, T) { const d = I.nums1.map((x, i) => Math.abs(x - I.nums2[i])), k = I.k1 + I.k2; T.at({ diffs: A(d), moves: k }); T.n('Total unit moves available?', k, 'k1 + k2 are interchangeable.'); if (d.reduce((a, b) => a + b, 0) <= k) return 0; const cost = L => d.reduce((s, x) => s + Math.max(0, x - L), 0); const L = firstTrue(0, Math.max(...d), L => cost(L) <= k, T, L => ({ cost: cost(L) }), L => `Can every difference be cut to ≤ ${L}?`); let r = k - cost(L); const e = d.map(x => Math.min(x, L)); for (let i = 0; i < e.length && r > 0; i++) if (e[i] === L && L > 0) { e[i]--; r--; } return e.reduce((s, x) => s + x * x, 0); }
  });

  D('number-of-excellent-pairs', {
    t: 'Number of Excellent Pairs: popcount',
    r: 'popcount(a OR b) + popcount(a AND b) = popcount(a) + popcount(b). Count distinct values by bit count; add cnt[i] · cnt[j] for every i + j ≥ k.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 15), k: R.int(1, 6) }),
    s(I, T) { const res = (() => { const u = [...new Set(I.nums)], c = Array(32).fill(0); u.forEach(x => c[pc(x)]++); T.at({ distinct: A(u), bitCounts: A(u.map(pc)) }); T.n('Distinct values?', u.length, 'Duplicates do not add pairs.'); T.n(`Bit count of ${u[0]}?`, pc(u[0]), 'Set bits.'); let t = 0; for (let i = 0; i < 32; i++) for (let j = 0; j < 32; j++) if (i + j >= I.k) t += c[i] * c[j]; return t; })(); T.n('Excellent pairs?', res, 'Pairs of bit counts adding to at least k.'); return res; }
  });

  D('maximum-number-of-groups-entering-a-competition', {
    t: 'Maximum Groups Entering a Competition',
    r: 'Sorting makes later groups bigger in sum automatically; only sizes 1, 2, 3, … matter. The answer is the largest g with g(g + 1)/2 ≤ n.',
    g: R => ({ grades: R.ints(R.int(1, 20), 1, 20) }),
    s(I, T) { const n = I.grades.length; return lastTrue(1, n, g => g * (g + 1) / 2 <= n, T, g => ({ needed: g * (g + 1) / 2, n }), g => `Can we form ${g} groups (needs ${g * (g + 1) / 2} students)?`); }
  });

  D('median-of-a-row-wise-sorted-matrix', {
    t: 'Median of a Row-Wise Sorted Matrix',
    r: 'Binary search value x: count entries ≤ x with a binary search per row. The first x with count > half is the median.',
    g: R => { const m = 2 * R.int(0, 2) + 1, n = 2 * R.int(0, 2) + 1; return { grid: Array.from({ length: m }, () => asc(R.ints(n, 1, 9))) }; },
    s(I, T) { const g = I.grid, half = Math.floor(g.length * g[0].length / 2), cnt = x => g.reduce((s, r) => s + upperBound(r, x), 0); return firstTrue(1, 9, x => cnt(x) > half, T, x => ({ grid: G(g), countLE: cnt(x) }), x => `Are more than ${half} entries ≤ ${x}?`); }
  });

  D('longest-subsequence-with-limited-sum', {
    t: 'Longest Subsequence With Limited Sum',
    r: 'Take the smallest values first: sort, build prefix sums, and binary search how many fit under each query.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 9), queries: R.ints(R.int(1, 3), 1, 25) }),
    s(I, T) { const s = asc(I.nums), P = []; let x = 0; for (const v of s) P.push(x += v); return I.queries.map(q => { const k = upperBound(P, q); T.at({ prefix: A(P, { hl: [k - 1] }), query: q }); T.n(`Longest subsequence with sum ≤ ${q}?`, k, 'Prefix sums ≤ q.'); return k; }); }
  });

  D('maximum-number-of-robots-within-budget', {
    t: 'Maximum Robots Within Budget',
    r: 'Binary search window size k: slide a window with a monotonic deque for max(chargeTimes) and a running sum of costs; k works if some window costs ≤ budget.',
    g: R => { const n = R.int(1, 6); return { chargeTimes: R.ints(n, 1, 9), runningCosts: R.ints(n, 1, 5), budget: R.int(1, 60) }; },
    s(I, T) { const c = I.chargeTimes, r = I.runningCosts, n = c.length; const ok = k => { for (let i = 0; i + k <= n; i++) { const mx = Math.max(...c.slice(i, i + k)), s = r.slice(i, i + k).reduce((a, b) => a + b, 0); if (mx + k * s <= I.budget) return true; } return false; }; return lastTrue(0, n, k => k === 0 || ok(k), T, () => ({ charge: A(c), cost: A(r) }), k => `Can ${k} consecutive robots fit in the budget?`); }
  });

  D('smallest-subarrays-with-maximum-bitwise-or', {
    t: 'Smallest Subarrays With Maximum OR',
    r: 'Go right to left keeping, for each bit, the nearest index ≥ i where it is set. The answer for i reaches the farthest of those positions.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 7) }),
    s(I, T) { const n = I.nums.length, last = Array(31).fill(-1), ans = Array(n); for (let i = n - 1; i >= 0; i--) { for (let b = 0; b < 31; b++) if (I.nums[i] >> b & 1) last[b] = i; let far = i; for (let b = 0; b < 31; b++) far = Math.max(far, last[b]); ans[i] = far - i + 1; T.at({ nums: A(I.nums, { win: [i, far] }) }); T.n(`Smallest length from index ${i}?`, ans[i], 'Reach the nearest holder of every bit.'); } return ans; }
  });

  D('minimum-cost-to-make-array-equal', {
    t: 'Minimum Cost to Make Array Equal',
    r: 'cost(x) = Σ cost[i]·|nums[i] − x| is convex, minimized at the weighted median. Binary search where cost(x + 1) − cost(x) turns non-negative.',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, 1, 9), cost: R.ints(n, 1, 6) }; },
    s(I, T) { const f = x => I.nums.reduce((s, v, i) => s + I.cost[i] * Math.abs(v - x), 0); const x = firstTrue(Math.min(...I.nums), Math.max(...I.nums), x => f(x + 1) >= f(x), T, x => ({ cost: f(x), next: f(x + 1) }), x => `Is cost(${x + 1}) ≥ cost(${x})?`); return f(x); }
  });

  D('next-greater-element-iv', {
    t: 'Next Greater Element IV: two stacks',
    r: 'Keep two decreasing stacks: s1 (waiting for a first greater) and s2 (waiting for a second). Each value pops s2 first (answers), then moves popped s1 items to s2 in order.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 9) }),
    s(I, T) { const a = I.nums, n = a.length, ans = Array(n).fill(-1); let s1 = [], s2 = []; for (let i = 0; i < n; i++) { while (s2.length && a[s2[s2.length - 1]] < a[i]) ans[s2.pop()] = a[i]; const moved = []; while (s1.length && a[s1[s1.length - 1]] < a[i]) moved.push(s1.pop()); s2.push(...moved.reverse()); s1.push(i); if (i < 6) { T.at({ nums: A(a, { hl: [i] }), waiting1: A(s1.map(j => a[j])), waiting2: A(s2.map(j => a[j])) }); T.n(`Answers resolved so far after index ${i}?`, ans.filter(x => x >= 0).length, 'Popped from the second stack.'); } } return ans; }
  });

  D('split-message-based-on-limit', {
    t: 'Split Message Based on Limit',
    r: 'Try part counts b = 1, 2, …: part a holds limit − |"<a/b>"| characters. The first b whose total capacity covers the message wins; stop if the suffix alone fills the limit.',
    g: R => ({ message: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 5), 'ab')).join(' '), limit: R.int(5, 12) }),
    s(I, T) { const res = (() => { const L = I.message.length, dig = x => String(x).length; T.at({ length: L, limit: I.limit }); T.n('Message length?', L, 'Every character must be placed.'); for (let b = 1; b <= L; b++) { if (3 + 2 * dig(b) >= I.limit) { T.at({ limit: I.limit }); T.yn(`Can parts with ${b} total fit a suffix and text?`, false, 'The suffix alone fills the limit.'); return []; } let cap = 0; for (let a = 1; a <= b; a++) cap += I.limit - 3 - dig(a) - dig(b); if (cap >= L) { T.at({ length: L, limit: I.limit }); T.n('Fewest parts?', b, 'First b whose capacity covers the message.'); T.n('Text characters in part 1?', Math.min(L, I.limit - 3 - 1 - dig(b)), 'The limit minus the suffix length.'); const out = []; let i = 0; for (let a = 1; a <= b; a++) { const w = I.limit - 3 - dig(a) - dig(b); out.push(I.message.slice(i, i + w) + `<${a}/${b}>`); i += w; } return out; } } return []; })(); if (!res.length) T.n('Parts returned?', 0, 'It cannot be split.'); return res; }
  });

  D('frog-jump-ii', {
    t: 'Frog Jump II: skip every other stone',
    r: 'Going out on even stones and back on odd ones is optimal, so the cost is max(stones[i + 2] − stones[i]) (and stones[1] − stones[0]).',
    g: R => ({ stones: [0, ...R.distinct(R.int(1, 6), 1, 20).sort((a, b) => a - b)] }),
    s(I, T) { const s = I.stones; let best = s[1] - s[0]; for (let i = 0; i + 2 < s.length; i++) { const d = s[i + 2] - s[i]; T.at({ stones: A(s, { hl: [i, i + 2] }) }); T.n(`Jump from stone ${i} to ${i + 2}?`, d, 'Skip one stone.'); best = Math.max(best, d); } if (s.length === 2) T.n('Only jump length?', best, 'Out and back.'); return best; }
  });

  D('minimize-the-maximum-of-two-arrays', {
    t: 'Minimize the Maximum of Two Arrays',
    r: 'Binary search x: need x − ⌊x/d1⌋ ≥ c1, x − ⌊x/d2⌋ ≥ c2 and x − ⌊x/lcm⌋ ≥ c1 + c2.',
    g: R => ({ divisor1: R.int(2, 6), divisor2: R.int(2, 6), uniqueCnt1: R.int(1, 6), uniqueCnt2: R.int(1, 6) }),
    s(I, T) { const l = I.divisor1 / gcd(I.divisor1, I.divisor2) * I.divisor2; const ok = x => x - Math.floor(x / I.divisor1) >= I.uniqueCnt1 && x - Math.floor(x / I.divisor2) >= I.uniqueCnt2 && x - Math.floor(x / l) >= I.uniqueCnt1 + I.uniqueCnt2; return firstTrue(1, 4 * (I.uniqueCnt1 + I.uniqueCnt2), ok, T, x => ({ notDiv1: x - Math.floor(x / I.divisor1), notDiv2: x - Math.floor(x / I.divisor2) }), x => `Is max value ${x} enough?`); }
  });

  D('maximum-tastiness-of-candy-basket', {
    t: 'Maximum Tastiness of a Candy Basket',
    r: 'Sort prices. Binary search gap g: greedily pick candies at least g apart; g works if you pick ≥ k.',
    g: R => { const n = R.int(2, 7); return { price: R.ints(n, 1, 20), k: R.int(2, n) }; },
    s(I, T) { const p = asc(I.price), cnt = g => { let c = 1, last = p[0]; for (const x of p) if (x - last >= g) { c++; last = x; } return c; }; return lastTrue(0, p[p.length - 1] - p[0], g => cnt(g) >= I.k, T, g => ({ prices: A(p), picked: cnt(g) }), g => `Can ${I.k} candies be ≥ ${g} apart?`); }
  });

  D('maximize-the-minimum-powered-city', {
    t: 'Maximize the Minimum Powered City',
    r: 'Binary search the minimum power m. Sweep cities with a sliding window of current power; when a city falls short, add stations at i + r (farthest useful spot) using a difference array.',
    g: R => { const n = R.int(1, 6); return { stations: R.ints(n, 0, 5), r: R.int(0, 2), k: R.int(0, 5) }; },
    s(I, T) { const n = I.stations.length, base = I.stations.map((_, i) => { let s = 0; for (let j = Math.max(0, i - I.r); j <= Math.min(n - 1, i + I.r); j++) s += I.stations[j]; return s; }); const ok = m => { const add = Array(n + 1).fill(0); let extra = 0, used = 0; for (let i = 0; i < n; i++) { extra += add[i]; const p = base[i] + extra; if (p < m) { const need = m - p; used += need; if (used > I.k) return false; extra += need; const end = Math.min(n - 1, i + 2 * I.r); add[end + 1] -= need; } } return true; }; return lastTrue(Math.min(...base), Math.min(...base) + I.k, ok, T, () => ({ power: A(base) }), m => `Can every city reach power ${m}?`); }
  });

  D('maximum-count-of-positive-integer-and-negative-integer', {
    t: 'Max Count of Positives and Negatives',
    r: 'Binary search the first index ≥ 0 (negatives before it) and the first index > 0 (positives after it).',
    g: R => ({ nums: asc(R.ints(R.int(1, 8), -4, 4)) }),
    s(I, T) { const res = (() => { const a = I.nums, neg = lowerBound(a, 0), pos = a.length - upperBound(a, 0); T.at({ nums: A(a) }); T.n('How many negatives?', neg, 'First index with a value of at least 0.'); T.n('How many positives?', pos, 'After the last 0.'); return Math.max(neg, pos); })(); T.n('Larger of the two counts?', res, 'Compare them.'); return res; }
  });

  D('minimum-common-value', {
    t: 'Minimum Common Value: two pointers',
    r: 'Advance the pointer at the smaller value; the first equal pair is the answer.',
    g: R => ({ nums1: asc(R.ints(R.int(1, 5), 1, 9)), nums2: asc(R.ints(R.int(1, 5), 1, 9)) }),
    s(I, T) { let i = 0, j = 0; while (i < I.nums1.length && j < I.nums2.length) { const a = I.nums1[i], b = I.nums2[j]; T.at({ nums1: A(I.nums1, { hl: [i] }), nums2: A(I.nums2, { hl: [j] }) }); T.c(`${a} vs ${b}?`, ['found', 'i++', 'j++'], a === b ? 'found' : a < b ? 'i++' : 'j++', 'Move the smaller side.'); if (a === b) return a; if (a < b) i++; else j++; } return -1; }
  });

  D('maximize-win-from-two-segments', {
    t: 'Maximize Win From Two Segments',
    r: 'Slide a window [l, r] with positions[r] − positions[l] ≤ k. best[r + 1] = best prize count of one segment within the first r + 1 prizes; combine the current window with best[l].',
    g: R => ({ prizePositions: asc(R.ints(R.int(1, 8), 1, 9)), k: R.int(0, 3) }),
    s(I, T) { const p = I.prizePositions, n = p.length, best = Array(n + 1).fill(0); let l = 0, ans = 0; for (let r = 0; r < n; r++) { while (p[r] - p[l] > I.k) l++; const w = r - l + 1; best[r + 1] = Math.max(best[r], w); ans = Math.max(ans, w + best[l]); if (r < 6) { T.at({ prizes: A(p, { win: [l, r] }) }); T.n(`Prizes in the window ending at ${r}?`, w, 'Shrink until it spans ≤ k.'); } } return ans; }
  });

  D('maximum-number-of-integers-to-choose-from-a-range-ii', {
    t: 'Choose Integers From a Range II',
    r: 'Take the smallest allowed numbers. Between consecutive banned values, take as many from the gap as the remaining budget allows (arithmetic series + binary search).',
    g: R => ({ banned: R.ints(R.int(1, 4), 1, 10), n: R.int(1, 10), maxSum: R.int(1, 40) }),
    s(I, T) { const res = (() => { const b = [...new Set(I.banned.filter(x => x <= I.n))].sort((x, y) => x - y); b.push(I.n + 1); let prev = 0, left = I.maxSum, cnt = 0; for (const x of b) { const lo = prev + 1, len = x - prev - 1; if (len > 0 && left >= lo) { let a = 0, h = len; while (a < h) { const m = Math.floor((a + h + 1) / 2); if (m * lo + m * (m - 1) / 2 <= left) a = m; else h = m - 1; } T.at({ gap: `${lo} to ${x - 1}`, budget: left }); T.n(`How many from ${lo} to ${x - 1} fit?`, a, 'Smallest first, sum at most the budget.'); cnt += a; left -= a * lo + a * (a - 1) / 2; if (a < len) break; } prev = x; } if (!cnt) { T.at({ budget: I.maxSum }); T.n('Integers chosen?', 0, 'Nothing fits.'); } return cnt; })(); T.n('Most integers chosen?', res, 'Add the counts from each gap.'); return res; }
  });

  D('house-robber-iv', {
    t: 'House Robber IV: minimize the capability',
    r: 'Binary search capability c: greedily rob any house ≤ c that is not adjacent to the last robbed. c works if you rob ≥ k houses.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 9), k: R.int(1, Math.floor((n + 1) / 2)) }; },
    s(I, T) { const cnt = c => { let k = 0, last = -2; I.nums.forEach((v, i) => { if (v <= c && i > last + 1) { k++; last = i; } }); return k; }; return firstTrue(Math.min(...I.nums), Math.max(...I.nums), c => cnt(c) >= I.k, T, c => ({ nums: A(I.nums), robbed: cnt(c) }), c => `With capability ${c}, can we rob ${I.k} houses?`); }
  });

  D('count-the-number-of-fair-pairs', {
    t: 'Count Fair Pairs',
    r: 'Sort. For each i, binary search j > i with lower − a[i] ≤ a[j] ≤ upper − a[i].',
    g: R => ({ nums: R.ints(R.int(1, 7), -3, 9), lower: R.int(0, 8), upper: R.int(8, 14) }),
    s(I, T) { const a = asc(I.nums); let c = 0; a.forEach((x, i) => { const rest = a.slice(i + 1), k = upperBound(rest, I.upper - x) - lowerBound(rest, I.lower - x); if (i < 4) { T.at({ sorted: A(a, { hl: [i] }) }); T.n(`Fair partners for ${x} to its right?`, k, `Values in [${I.lower - x}, ${I.upper - x}].`); } c += k; }); return c; }
  });

  D('subsequence-with-the-minimum-score', {
    t: 'Subsequence With the Minimum Score',
    r: 'Remove one block t[i..j−1]. pre[i] = where in s the prefix t[0..i) ends (greedy); suf[j] = latest start of the suffix t[j..]. Valid if pre[i] ≤ suf[j]; minimize j − i.',
    g: R => ({ s: R.str(R.int(1, 7), 'abc'), t: R.str(R.int(1, 5), 'abcz') }),
    s(I, T) { const res = (() => { const s = I.s, t = I.t, n = s.length, m = t.length, pre = [0], suf = Array(m + 1).fill(-1); suf[m] = n; for (let i = 0, p = 0; i < m; i++) { while (p < n && s[p] !== t[i]) p++; if (p >= n) break; pre.push(++p); } for (let j = m - 1, p = n - 1; j >= 0; j--) { while (p >= 0 && s[p] !== t[j]) p--; if (p < 0) break; suf[j] = p--; } T.at({ s: A([...s]), t: A([...t]) }); T.n('Longest prefix of t that is a subsequence of s?', pre.length - 1, 'Greedy left to right.'); T.n('Longest suffix of t that is a subsequence of s?', suf.slice(0, m).filter(v => v >= 0).length, 'Greedy right to left.'); let best = m; for (let i = 0; i < pre.length; i++) for (let j = i; j <= m; j++) if (suf[j] >= pre[i]) { best = Math.min(best, j - i); break; } return best; })(); T.n('Minimum score?', res, 'Smallest gap between a good prefix and a good suffix.'); return res; }
  });

  D('find-the-maximum-number-of-marked-indices', {
    t: 'Maximum Marked Indices',
    r: 'Sort. Match the smallest half against the largest half with two pointers: pair a[i] with the next a[j] (from the middle) where 2·a[i] ≤ a[j].',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 12) }),
    s(I, T) { const a = asc(I.nums), n = a.length; let i = 0, c = 0; for (let j = Math.ceil(n / 2); j < n && i < Math.floor(n / 2); j++) { const ok = 2 * a[i] <= a[j]; T.at({ sorted: A(a, { hl: [i, j] }) }); T.yn(`Can ${a[i]} pair with ${a[j]}?`, ok, '2·small ≤ big.'); if (ok) { c++; i++; } } if (n < 2) T.n('Pairs possible?', 0, 'Need two numbers.'); return 2 * c; }
  });

  D('minimum-time-to-complete-all-tasks', {
    t: 'Minimum Time to Complete All Tasks',
    r: 'Sort tasks by end. For each, count seconds already on inside [start, end]; switch on the missing seconds as late as possible (from end backward) so later tasks can share them.',
    g: R => ({ tasks: Array.from({ length: R.int(1, 4) }, () => { const s = R.int(1, 8), e = s + R.int(0, 4); return [s, e, R.int(1, e - s + 1)]; }) }),
    s(I, T) { const on = new Set(), tk = I.tasks.slice().sort((a, b) => a[1] - b[1]); for (const [s, e, d] of tk) { let have = 0; for (let x = s; x <= e; x++) if (on.has(x)) have++; T.at({ task: `${s}-${e} needs ${d}`, on: A([...on].sort((a, b) => a - b)) }); T.n('Seconds already on in its window?', have, 'Shared with earlier tasks.'); for (let x = e; x >= s && have < d; x--) if (!on.has(x)) { on.add(x); have++; } } return on.size; }
  });

  D('minimum-time-to-repair-cars', {
    t: 'Minimum Time to Repair Cars',
    r: 'A mechanic of rank r fixes ⌊√(t / r)⌋ cars in time t. Binary search the first t where the total ≥ cars.',
    g: R => ({ ranks: R.ints(R.int(1, 4), 1, 5), cars: R.int(1, 12) }),
    s(I, T) { const fx = t => I.ranks.reduce((s, r) => s + Math.floor(Math.sqrt(t / r)), 0); return firstTrue(1, Math.min(...I.ranks) * I.cars * I.cars, t => fx(t) >= I.cars, T, t => ({ repaired: fx(t) }), t => `In time ${t}, can ${I.cars} cars be repaired?`); }
  });

  D('prime-subtraction-operation', {
    t: 'Prime Subtraction to Make Strictly Increasing',
    r: 'Greedy left to right: make each value as small as possible but above the previous by subtracting the largest prime p < nums[i] − prev (binary search a prime list).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 20) }),
    s(I, T) { const primes = []; for (let x = 2; x < 1000; x++) if (primes.every(p => p * p > x || x % p)) primes.push(x); let prev = 0; for (const v of I.nums) { const lim = v - prev, k = lowerBound(primes, lim) - 1, nv = k >= 0 ? v - primes[k] : v; T.at({ prev, value: v }); T.n(`Smallest new value for ${v} (above ${prev})?`, nv > prev ? nv : -1, k >= 0 ? `Subtract ${primes[k]}.` : 'No prime fits.'); if (nv <= prev) return false; prev = nv; } return true; }
  });

  D('minimum-operations-to-make-all-array-elements-equal', {
    t: 'Operations to Make All Elements Equal to q',
    r: 'Sort with prefix sums. For query q, binary search the split k: cost = q·k − P[k] + (P[n] − P[k]) − q·(n − k).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 9), queries: R.ints(R.int(1, 3), 1, 10) }),
    s(I, T) { const a = asc(I.nums), n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); return I.queries.map(q => { const k = lowerBound(a, q); T.at({ sorted: A(a, { win: [0, k - 1] }), q }); T.n(`How many values are below ${q}?`, k, 'Binary search the split.'); return q * k - P[k] + P[n] - P[k] - q * (n - k); }); }
  });

  D('minimum-time-to-eat-all-grains', {
    t: 'Minimum Time to Eat All Grains',
    r: 'Binary search time t. Greedily give each hen (left to right) the leftmost uneaten grain: if it is to the left at distance d ≤ t, the hen can still reach max(t − 2d, (t − d)/2) to the right.',
    g: R => ({ hens: R.ints(R.int(1, 3), 0, 12), grains: R.ints(R.int(1, 5), 0, 12) }),
    s(I, T) { const h = asc(I.hens), g = asc(I.grains); const ok = t => { let j = 0; for (const x of h) { if (j === g.length) break; let reach; if (g[j] < x) { const d = x - g[j]; if (d > t) return false; reach = x + Math.max(t - 2 * d, Math.floor((t - d) / 2)); } else reach = x + t; while (j < g.length && g[j] <= reach) j++; } return j === g.length; }; return firstTrue(0, 30, ok, T, () => ({ hens: A(h), grains: A(g) }), t => `Can all grains be eaten in ${t} seconds?`); }
  });

  D('minimum-operations-to-make-numbers-non-positive', {
    t: 'Make Numbers Non-Positive',
    r: 'Binary search the operation count t: every element loses t·y; element v still needs ⌈(v − t·y) / (x − y)⌉ targeted operations. t works if that total ≤ t.',
    g: R => { const y = R.int(1, 3); return { nums: R.ints(R.int(1, 5), 1, 12), x: y + R.int(1, 3), y }; },
    s(I, T) { const need = t => I.nums.reduce((s, v) => s + Math.max(0, Math.ceil((v - t * I.y) / (I.x - I.y))), 0); return firstTrue(0, Math.max(...I.nums), t => need(t) <= t, T, t => ({ nums: A(I.nums), targeted: need(t) }), t => `Are ${t} operations enough?`); }
  });

  D('maximum-beauty-of-an-array-after-applying-operation', {
    t: 'Maximum Beauty After Operations',
    r: 'Each value can move within ±k, so equal values are possible iff max − min ≤ 2k. Sort and find the largest window with a[r] − a[l] ≤ 2k.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 12), k: R.int(0, 3) }),
    s(I, T) { const a = asc(I.nums); let l = 0, best = 0; for (let r = 0; r < a.length; r++) { while (a[r] - a[l] > 2 * I.k) l++; if (r < 6) { T.at({ sorted: A(a, { win: [l, r] }), k: I.k }); T.n(`Window size ending at ${r}?`, r - l + 1, 'Span ≤ 2k.'); } best = Math.max(best, r - l + 1); } return best; }
  });
})();
