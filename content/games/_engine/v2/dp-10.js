/* v2 games: dynamic programming (10). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const pc = m => { let c = 0; while (m) { c += m & 1; m >>= 1; } return c; };
  const gcd = (a, b) => b ? gcd(b, a % b) : a;
  const C = (n, k) => { if (k < 0 || k > n) return 0; let r = 1; for (let i = 0; i < k; i++) r = r * (n - i) / (i + 1); return Math.round(r); };

  D('substring-with-largest-variance', {
    t: 'Substring With Largest Variance: Kadane for every letter pair',
    r: 'For each ordered pair (a, b): +1 for a, −1 for b, Kadane-style, but only count a value once the run contains at least one b (remember a b seen earlier in case the run resets).',
    g: R => ({ s: R.str(R.int(5, 8), 'abc') }),
    s(I, T) {
      const s = I.s, L = [...new Set(s)].sort(); let best = 0;
      for (const a of L) for (const b of L) if (a !== b) {
        let bv = 0; for (let i = 0; i < s.length; i++) { let ca = 0, cb = 0; for (let j = i; j < s.length; j++) { if (s[j] === a) ca++; if (s[j] === b) cb++; if (cb) bv = Math.max(bv, ca - cb); } }
        T.at({ s: A([...s]), pair: `${a} (+1) vs ${b} (−1)` }); T.n(`Largest count(${a}) − count(${b}) over substrings containing "${b}"?`, bv, 'Kadane on ±1, requiring at least one b.'); best = Math.max(best, bv); }
      return best;
    }
  });

  D('maximum-profit-from-trading-stocks', {
    t: 'Maximum Profit From Trading Stocks: 0-1 knapsack on the budget',
    r: 'Each stock costs present[i] and earns future[i] − present[i]. dp[b] = best profit with budget b; process each stock with b descending.',
    g: R => { const n = R.int(3, 5); return { present: R.ints(n, 1, 6), future: R.ints(n, 1, 9), budget: R.int(4, 10) }; },
    s(I, T) { const dp = Array(I.budget + 1).fill(0); I.present.forEach((p, i) => { const g = I.future[i] - p; if (g > 0) for (let b = I.budget; b >= p; b--) dp[b] = Math.max(dp[b], dp[b - p] + g); T.at({ stock: `cost ${p}, profit ${g}`, budget: I.budget }); T.n(`After stock ${i}: best profit with budget ${I.budget}?`, dp[I.budget], g > 0 ? 'Buy it or not (knapsack).' : 'No profit: skip it.'); }); return dp[I.budget]; }
  });

  D('minimum-path-cost-in-a-grid', {
    t: 'Minimum Path Cost in a Grid: pay the cell and the move',
    r: 'cost[r][c] = grid[r][c] + min over previous-row cells p of cost[r−1][p] + moveCost[grid[r−1][p]][c].',
    g: R => { const m = R.int(2, 3), n = 2; const vals = R.shuffle([...Array(m * n).keys()]); return { grid: Array.from({ length: m }, (_, r) => vals.slice(r * n, r * n + n)), moveCost: Array.from({ length: m * n }, () => R.ints(n, 1, 9)) }; },
    s(I, T) { const g = I.grid; let prev = g[0].slice(); for (let r = 1; r < g.length; r++) { const cur = g[r].map((v, c) => v + Math.min(...prev.map((pv, p) => pv + I.moveCost[g[r - 1][p]][c]))); cur.forEach((v, c) => { T.at({ grid: G(g, { hl: [[r, c]] }), above: A(prev), moveCost: K(g[r - 1].map(x => ['from ' + x, I.moveCost[x].join(',')])) }); T.n(`Cheapest cost ending at (${r},${c})?`, v, `${g[r][c]} + min(prev + moveCost).`); }); prev = cur; } return Math.min(...prev); }
  });

  D('sum-of-numbers-with-units-digit-k', {
    t: 'Sum of Numbers With Units Digit K: try 1 to 10 numbers',
    r: 'With c numbers ending in k, the sum ends in c times k mod 10 and is at least c times k. Try c = 1 to 10; the first c with c times k at most num and (num − c times k) % 10 == 0 works. num = 0 needs 0 numbers.',
    g: R => ({ num: R.int(0, 60), k: R.int(0, 9) }),
    s(I, T) { if (I.num === 0) { T.at({ num: 0 }); T.n('How many numbers for num = 0?', 0, 'The empty set.'); return 0; } for (let c = 1; c <= 10; c++) { const ok = c * I.k <= I.num && (I.num - c * I.k) % 10 === 0; T.at({ num: I.num, k: I.k, count: c }); T.yn(`Can ${c} numbers ending in ${I.k} sum to ${I.num}?`, ok, `${c} times ${I.k} = ${c * I.k}; the rest must be a multiple of 10.`); if (ok) return c; } return -1; }
  });

  D('longest-binary-subsequence-less-than-or-equal-to-k', {
    t: 'Longest Binary Subsequence at most k: all zeros, plus cheap ones from the right',
    r: 'Every 0 is free. Scan from the right: a 1 at bit position p is kept if adding 2 to the power p keeps the value at most k (positions count kept characters).',
    g: R => ({ s: R.str(R.int(5, 8), '01'), k: R.int(1, 12) }),
    s(I, T) { const s = I.s; let val = 0, len = 0; for (let i = s.length - 1; i >= 0; i--) { if (s[i] === '0') { len++; continue; } const add = len < 31 ? 2 ** len : Infinity, ok = val + add <= I.k; T.at({ s: A([...s], { hl: [i] }), value: val, kept: len, k: I.k }); T.yn(`Keep the "1" at index ${i} (worth ${add})?`, ok, ok ? 'Still at most k.' : 'Would exceed k.'); if (ok) { val += add; len++; } } return len; }
  });

  D('selling-pieces-of-wood', {
    t: 'Selling Pieces of Wood: sell whole or cut once',
    r: 'dp[h][w] = best money for an h times w piece = max(price of that exact shape, best horizontal cut dp[i][w] + dp[h−i][w], best vertical cut dp[h][j] + dp[h][w−j]).',
    g: R => ({ m: R.int(2, 3), n: R.int(2, 4), prices: [[1, 1, R.int(1, 3)], [1, 2, R.int(2, 6)], [2, 1, R.int(2, 6)], [2, 2, R.int(4, 12)]] }),
    s(I, T) { const P = new Map(I.prices.map(([h, w, p]) => [h * 1000 + w, p])), dp = mk(I.m + 1, I.n + 1, 0); for (let h = 1; h <= I.m; h++) for (let w = 1; w <= I.n; w++) { let b = P.get(h * 1000 + w) || 0; for (let i = 1; i < h; i++) b = Math.max(b, dp[i][w] + dp[h - i][w]); for (let j = 1; j < w; j++) b = Math.max(b, dp[h][j] + dp[h][w - j]); dp[h][w] = b; if (h + w > 2) { T.at({ prices: A(I.prices.map(p => `${p[0]} by ${p[1]}: ${p[2]}`)), dp: G(dp.slice(1).map(r => r.slice(1)), { rh: [...Array(I.m).keys()].map(x => 'h' + (x + 1)), ch: [...Array(I.n).keys()].map(x => 'w' + (x + 1)), hl: [[h - 1, w - 1]] }) }); T.n(`dp[${h}][${w}]?`, b, 'Whole-piece price or the best single cut.'); } } return dp[I.m][I.n]; }
  });

  D('number-of-distinct-roll-sequences', {
    t: 'Number of Distinct Roll Sequences: remember the last two rolls',
    r: 'dp[a][b] = sequences ending with rolls a, b. Next roll c needs gcd(b, c) = 1, c not equal to b and c not equal to a.',
    g: R => ({ n: R.int(2, 4) }),
    s(I, T) {
      if (I.n === 1) return 6; let dp = mk(7, 7, 0); for (let a = 1; a <= 6; a++) for (let b = 1; b <= 6; b++) if (a !== b && gcd(a, b) === 1) dp[a][b] = 1;
      const tot = () => dp.flat().reduce((x, y) => (x + y) % MOD, 0); T.at({ rolls: 2 }); T.n('Valid sequences of 2 rolls?', tot(), 'Pairs with gcd 1 and different values.');
      for (let k = 3; k <= I.n; k++) { const nx = mk(7, 7, 0); for (let a = 1; a <= 6; a++) for (let b = 1; b <= 6; b++) if (dp[a][b]) for (let c = 1; c <= 6; c++) if (c !== a && c !== b && gcd(b, c) === 1) nx[b][c] = (nx[b][c] + dp[a][b]) % MOD; dp = nx; T.at({ rolls: k }); T.n(`Valid sequences of ${k} rolls?`, tot(), 'Extend each (a, b) by every allowed c.'); }
      return tot();
    }
  });

  D('count-number-of-ways-to-place-houses', {
    t: 'Count Number of Ways to Place Houses: one side, squared',
    r: 'The two sides are independent. One side: no two adjacent houses, so ways follow Fibonacci (empty or house states). Answer = (ways for one side)².',
    g: R => ({ n: R.int(2, 6) }),
    s(I, T) { let e = 1, h = 1; for (let i = 2; i <= I.n; i++) { const ne = (e + h) % MOD; h = e; e = ne; T.at({ plots: i }); T.n(`Ways for one side with ${i} plots?`, (e + h) % MOD, 'Last plot empty (any before) + last plot built (previous empty).'); } const one = (e + h) % MOD; return one * one % MOD; }
  });

  D('maximum-score-of-spliced-array', {
    t: 'Maximum Score of Spliced Array: Kadane on the difference',
    r: 'Swapping [l, r] adds the sum of (nums2 minus nums1) on that range to nums1\'s total. Kadane on the differences gives the best gain (or 0). Do it both ways and take the better total.',
    g: R => { const n = R.int(4, 5); return { nums1: R.ints(n, 1, 9), nums2: R.ints(n, 1, 9) }; },
    s(I, T) { const res = (() => { const run = (a, b, nm) => { let cur = 0, best = 0; a.forEach((x, i) => { cur = Math.max(0, cur + b[i] - x); best = Math.max(best, cur); }); const tot = a.reduce((s, x) => s + x, 0); T.at({ keep: A(a), swapFrom: A(b), diff: A(b.map((v, i) => v - a[i])) }); T.n(`Best total for ${nm}?`, tot + best, `${tot} plus best gain ${best}.`); return tot + best; }; return Math.max(run(I.nums1, I.nums2, 'nums1'), run(I.nums2, I.nums1, 'nums2')); })(); T.n('Maximum score?', res, 'The better of the two totals.'); return res; }
  });

  D('number-of-people-aware-of-a-secret', {
    t: 'Number of People Aware of a Secret: new learners per day',
    r: 'new[d] = number of people who learn on day d = the sum of new[j] for j in [d − forget + 1, d − delay] (those currently sharing). Aware on day n = the sum of new over the last forget days.',
    g: R => { const delay = R.int(1, 2); return { n: R.int(4, 7), delay, forget: delay + R.int(1, 3) }; },
    s(I, T) { const nw = [0, 1]; for (let d = 2; d <= I.n; d++) { let v = 0; for (let j = Math.max(1, d - I.forget + 1); j <= d - I.delay; j++) v += nw[j]; T.at({ day: d, learned: A(nw.slice(1), { labels: nw.slice(1).map((_, i) => 'd' + (i + 1)) }), delay: I.delay, forget: I.forget }); T.n(`How many people learn on day ${d}?`, v % MOD, 'Sum of those who learned between d − forget + 1 and d − delay.'); nw.push(v % MOD); } let a = 0; for (let j = Math.max(1, I.n - I.forget + 1); j <= I.n; j++) a += nw[j]; return a % MOD; }
  });

  D('count-the-number-of-ideal-arrays', {
    t: 'Count the Number of Ideal Arrays: divisor chains',
    r: 'dp[len][v] = ideal arrays of length len ending in v = the sum of dp[len−1][d] over divisors d of v. (The fast version counts strictly increasing chains and spreads them with combinations.)',
    g: R => ({ n: R.int(2, 4), maxValue: R.int(2, 6) }),
    s(I, T) { let dp = Array(I.maxValue + 1).fill(1); dp[0] = 0; for (let l = 2; l <= I.n; l++) { const nx = Array(I.maxValue + 1).fill(0); for (let v = 1; v <= I.maxValue; v++) for (let d = 1; d <= v; d++) if (v % d === 0) nx[v] = (nx[v] + dp[d]) % MOD; dp = nx; T.at({ length: l, prev: A(dp.slice(1), { labels: dp.slice(1).map((_, i) => 'ends ' + (i + 1)) }) }); T.n(`Ideal arrays of length ${l} ending in ${I.maxValue}?`, dp[I.maxValue], 'Sum over divisors of the previous counts.'); } return dp.reduce((a, b) => (a + b) % MOD, 0); }
  });

  D('maximum-number-of-books-you-can-take', {
    t: 'Maximum Number of Books You Can Take: strictly fewer to the left',
    r: 'End at shelf r taking books[r]; moving left, each shelf takes min(books[i], previous − 1) and stops at 0. (A monotonic stack makes this O(n).)',
    g: R => ({ books: R.ints(R.int(4, 6), 0, 9) }),
    s(I, T) { const b = I.books; let best = 0; for (let r = 0; r < b.length; r++) { let take = b[r], s = 0; for (let i = r; i >= 0 && take > 0; i--) { take = Math.min(take, b[i]); s += take; take--; } T.at({ books: A(b, { hl: [r] }), best }); T.n(`Most books ending at shelf ${r}?`, s, 'Each shelf to the left takes min(its books, one less than the next).'); best = Math.max(best, s); } return best; }
  });

  D('minimum-costs-using-the-train-line', {
    t: 'Minimum Costs Using the Train Line: regular or express lane',
    r: 'reg = cheapest to reach stop i on the regular route; exp = on the express route. reg\' = min(reg, exp) + regular[i]; exp\' = min(exp, reg + expressCost) + express[i]. Answer per stop: min(reg\', exp\').',
    g: R => { const n = R.int(3, 5); return { regular: R.ints(n, 1, 9), express: R.ints(n, 1, 9), expressCost: R.int(1, 6) }; },
    s(I, T) { let reg = 0, exp = Infinity; return I.regular.map((r, i) => { const nr = Math.min(reg, exp) + r, ne = Math.min(exp, reg + I.expressCost) + I.express[i]; T.at({ regular: A(I.regular, { hl: [i] }), express: A(I.express, { hl: [i] }), reg, exp: exp === Infinity ? '∞' : exp, switch: I.expressCost }); T.n(`Cheapest cost to reach stop ${i + 1}?`, Math.min(nr, ne), `min(regular ${nr}, express ${ne}).`); reg = nr; exp = ne; return Math.min(nr, ne); }); }
  });

  D('check-if-there-is-a-valid-partition-for-the-array', {
    t: 'Valid Partition: blocks of 2 equal, 3 equal, or 3 consecutive',
    r: 'ok[i] = the first i numbers can be partitioned. ok[i] = (ok[i−2] and last two equal) or (ok[i−3] and last three equal or consecutive increasing).',
    g: R => ({ nums: R.ints(R.int(4, 7), 1, 4) }),
    s(I, T) { const a = I.nums, ok = [true, false]; for (let i = 2; i <= a.length; i++) { const x = a[i - 1], y = a[i - 2], z = a[i - 3]; const v = (ok[i - 2] && x === y) || (i >= 3 && ok[i - 3] && ((x === y && y === z) || (y === z + 1 && x === y + 1))); T.at({ nums: A(a, { win: [Math.max(0, i - 3), i - 1] }), ok: A(ok.map(b => b ? 'T' : 'F')) }); T.yn(`Can the first ${i} numbers be partitioned?`, v, 'Check a 2-block on ok[i−2] and a 3-block on ok[i−3].'); ok.push(v); } return ok[a.length]; }
  });

  D('longest-ideal-subsequence', {
    t: 'Longest Ideal Subsequence: best per letter',
    r: 'dp[c] = longest ideal subsequence ending in letter c. For a new letter c: dp[c] = 1 + max dp over letters within k of c.',
    g: R => ({ s: R.str(R.int(5, 7), 'abcdef'), k: R.int(0, 2) }),
    s(I, T) { const dp = {}; [...I.s].forEach((ch, i) => { const c = ch.charCodeAt(0); let b = 0; for (const [l, v] of Object.entries(dp)) if (Math.abs(l.charCodeAt(0) - c) <= I.k) b = Math.max(b, v); T.at({ s: A([...I.s], { hl: [i] }), dp: K(dp), k: I.k }); T.n(`dp["${ch}"] after index ${i}?`, b + 1, 'Best dp among letters within k, plus 1.'); dp[ch] = b + 1; }); return Math.max(...Object.values(dp)); }
  });

  D('count-special-integers', {
    t: 'Count Special Integers: distinct digits up to n',
    r: 'Shorter lengths L: 9 times P(9, L − 1). Same length: at each position, count unused smaller digits (no leading zero) times P(remaining digits, remaining positions); stop if n repeats a digit; add 1 if n itself is special.',
    g: R => ({ n: R.int(10, 999) }),
    s(I, T) {
      const s = String(I.n), L = s.length, P = (m, r) => { let v = 1; for (let i = 0; i < r; i++) v *= m - i; return v; }; let cnt = 0;
      for (let l = 1; l < L; l++) { T.at({ n: s, count: cnt }); T.n(`Special ${l}-digit numbers?`, 9 * P(9, l - 1), `9 times P(9, ${l - 1}).`); cnt += 9 * P(9, l - 1); }
      const used = new Set(); for (let i = 0; i < L; i++) { const d = +s[i]; let c = 0; for (let x = i ? 0 : 1; x < d; x++) if (!used.has(x)) c++; const v = c * P(9 - i, L - i - 1); T.at({ n: A([...s], { hl: [i] }), used: A([...used]), count: cnt }); T.n(`Position ${i}: special numbers branching off with a smaller digit?`, v, `${c} unused smaller digits times P(${9 - i}, ${L - i - 1}).`); cnt += v; if (used.has(d)) return cnt; used.add(d); }
      return cnt + 1;
    }
  });

  D('time-needed-to-rearrange-a-binary-string', {
    t: 'Time Needed to Rearrange a Binary String: ones wait in line',
    r: 'Scan left to right counting zeros. Each 1 with zeros before it needs time = max(previous time + 1, zeros) (it either waits behind the previous 1 or walks past all zeros).',
    g: R => ({ s: R.str(R.int(5, 8), '01') }),
    s(I, T) { let z = 0, t = 0; [...I.s].forEach((c, i) => { if (c === '0') z++; else if (z) { const v = Math.max(t + 1, z); T.at({ s: A([...I.s], { hl: [i] }), zeros: z, time: t }); T.n(`"1" at ${i}: seconds until it settles?`, v, `max(${t} + 1, ${z}).`); t = v; } }); return t; }
  });

  D('count-strictly-increasing-subarrays', {
    t: 'Count Strictly Increasing Subarrays: run length',
    r: 'run = length of the strictly increasing run ending at i (reset to 1 when not increasing). Add run for each i.',
    g: R => ({ nums: R.ints(R.int(5, 7), 1, 6) }),
    s(I, T) { let run = 0, tot = 0; I.nums.forEach((x, i) => { run = i && x > I.nums[i - 1] ? run + 1 : 1; T.at({ nums: A(I.nums, { hl: [i] }), total: tot }); T.n(`Increasing subarrays ending at ${i}?`, run, run > 1 ? 'Extends the run.' : 'Run restarts.'); tot += run; }); return tot; }
  });

  D('number-of-ways-to-reach-a-position-after-exactly-k-steps', {
    t: 'Ways to Reach a Position in Exactly k Steps: choose the right steps',
    r: 'With R right steps and k minus R left steps, the net move is 2R minus k, which must equal d. So R = (k plus d) divided by 2 must be a whole number from 0 to k; the answer is k choose R.',
    g: R => ({ startPos: R.int(1, 5), endPos: R.int(1, 7), k: R.int(1, 8) }),
    s(I, T) { const res = (() => { const d = Math.abs(I.endPos - I.startPos), ok = d <= I.k && (I.k + d) % 2 === 0; T.at({ start: I.startPos, end: I.endPos, k: I.k }); T.n('Distance between start and end?', d, 'Absolute difference.'); T.yn('Is the target reachable in exactly k steps?', ok, 'The distance must be at most k and have the same parity as k.'); if (!ok) return 0; const Rr = (I.k + d) / 2; T.n('How many steps go toward the target?', Rr, `(k plus distance) divided by 2: (${I.k} plus ${d}) divided by 2.`); return C(I.k, Rr) % MOD; })(); T.n('Number of ways?', res, 'k choose the steps toward the target; 0 if unreachable.'); return res; }
  });

  D('minimum-time-to-kill-all-monsters', {
    t: 'Minimum Time to Kill All Monsters: bitmask over the killed',
    r: 'gain = killed + 1, so killing monster i next takes ceil(power[i] divided by gain) days. dp[mask] = least days to kill the monsters in mask.',
    g: R => ({ power: R.ints(R.int(2, 4), 1, 9) }),
    s(I, T) {
      const p = I.power, n = p.length, dp = Array(1 << n).fill(Infinity); dp[0] = 0; for (let m = 0; m < 1 << n; m++) if (dp[m] < Infinity) for (let i = 0; i < n; i++) if (!(m >> i & 1)) dp[m | 1 << i] = Math.min(dp[m | 1 << i], dp[m] + Math.ceil(p[i] / (pc(m) + 1)));
      const full = (1 << n) - 1, rest = m => { const memo = new Map(), f = x => { if (x === full) return 0; if (memo.has(x)) return memo.get(x); let b = Infinity; for (let i = 0; i < n; i++) if (!(x >> i & 1)) b = Math.min(b, Math.ceil(p[i] / (pc(x) + 1)) + f(x | 1 << i)); memo.set(x, b); return b; }; return f(m); };
      let m = 0; while (m !== full) { const g = pc(m) + 1, opts = [], ok = []; for (let i = 0; i < n; i++) if (!(m >> i & 1)) { opts.push([String(i), `#${i} (power ${p[i]}: ${Math.ceil(p[i] / g)} days)`]); if (Math.ceil(p[i] / g) + rest(m | 1 << i) === rest(m)) ok.push(String(i)); } T.at({ power: A(p, { dim: p.map((_, i) => m >> i & 1 ? i : -1).filter(i => i >= 0) }), gain: g }); T.k(`Gain is ${g}. Which monster next (optimal)?`, opts, ok, `Best remaining time is ${rest(m)} days.`); m |= 1 << +ok[0]; }
      return dp[full];
    }
  });

  D('find-all-good-indices', {
    t: 'Find All Good Indices: k non-increasing before, k non-decreasing after',
    r: 'dec[i] = non-increasing run length ending at i; inc[i] = non-decreasing run starting at i. Index i is good if dec[i−1] at least k and inc[i+1] at least k.',
    g: R => ({ nums: R.ints(R.int(6, 8), 1, 4), k: R.int(1, 2) }),
    s(I, T) { const a = I.nums, n = a.length, dec = Array(n).fill(1), inc = Array(n).fill(1); for (let i = 1; i < n; i++) if (a[i] <= a[i - 1]) dec[i] = dec[i - 1] + 1; for (let i = n - 2; i >= 0; i--) if (a[i] <= a[i + 1]) inc[i] = inc[i + 1] + 1; const out = []; for (let i = I.k; i < n - I.k; i++) { const ok = dec[i - 1] >= I.k && inc[i + 1] >= I.k; T.at({ nums: A(a, { hl: [i] }), dec: A(dec), inc: A(inc), k: I.k }); T.yn(`Is index ${i} good?`, ok, `dec[${i - 1}] = ${dec[i - 1]}, inc[${i + 1}] = ${inc[i + 1]}.`); if (ok) out.push(i); } return out; }
  });

  D('maximum-deletions-on-a-string', {
    t: 'Maximum Deletions on a String: delete a repeated prefix',
    r: 'dp[i] = most operations on suffix s[i..]. If s[i to i+j) equals s[i+j to i+2j), you can delete it: 1 + dp[i+j]. Otherwise delete everything: 1. (An LCP table makes the comparison O(1).)',
    g: R => ({ s: R.str(R.int(4, 7), 'ab') }),
    s(I, T) { const s = I.s, n = s.length, dp = Array(n + 1).fill(0); for (let i = n - 1; i >= 0; i--) { let b = 1; for (let j = 1; i + 2 * j <= n; j++) if (s.slice(i, i + j) === s.slice(i + j, i + 2 * j)) b = Math.max(b, 1 + dp[i + j]); dp[i] = b; T.at({ s: A([...s], { win: [i, n - 1] }) }); T.n(`dp[${i}] for "${s.slice(i)}"?`, b, 'Best repeated prefix to delete, or delete everything (1).'); } return dp[0]; }
  });

  D('maximize-total-tastiness-of-purchased-fruits', {
    t: 'Maximize Total Tastiness: knapsack with coupons',
    r: 'dp[a][c] = best tastiness with amount a spent and c coupons used. Each fruit: skip, buy at full price, or buy at floor(price divided by 2) using a coupon.',
    g: R => { const n = R.int(2, 4); return { price: R.ints(n, 2, 10), tastiness: R.ints(n, 1, 9), maxAmount: R.int(5, 15), maxCoupons: R.int(0, 2) }; },
    s(I, T) { let dp = mk(I.maxAmount + 1, I.maxCoupons + 1, 0); I.price.forEach((p, i) => { const t = I.tastiness[i], nx = dp.map(r => r.slice()); for (let a = 0; a <= I.maxAmount; a++) for (let c = 0; c <= I.maxCoupons; c++) { if (a >= p) nx[a][c] = Math.max(nx[a][c], dp[a - p][c] + t); const h = Math.floor(p / 2); if (c && a >= h) nx[a][c] = Math.max(nx[a][c], dp[a - h][c - 1] + t); } dp = nx; T.at({ fruit: `price ${p}, taste ${t}`, budget: I.maxAmount, coupons: I.maxCoupons }); T.n(`After fruit ${i}: best tastiness?`, dp[I.maxAmount][I.maxCoupons], 'Skip, pay full, or pay half with a coupon.'); }); return dp[I.maxAmount][I.maxCoupons]; }
  });

  D('paths-in-matrix-whose-sum-is-divisible-by-k', {
    t: 'Paths Whose Sum Is Divisible by k: count by remainder',
    r: 'dp[r][c][m] = paths to (r, c) with sum ≡ m (mod k), from the cell above and the cell to the left, shifted by grid[r][c].',
    g: R => ({ grid: R.grid(R.int(2, 3), R.int(2, 3), 0, 9), k: R.int(2, 4) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, k = I.k, dp = Array.from({ length: m }, () => Array.from({ length: n }, () => Array(k).fill(0))); for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) { const v = g[r][c] % k; if (!r && !c) dp[0][0][v] = 1; else for (let x = 0; x < k; x++) dp[r][c][(x + v) % k] = ((r ? dp[r - 1][c][x] : 0) + (c ? dp[r][c - 1][x] : 0)) % MOD; if (r + c >= 1) { T.at({ grid: G(g, { hl: [[r, c]] }), k }); T.n(`Paths to (${r},${c}) with sum divisible by ${k}?`, dp[r][c][0], 'Shift the remainder counts from above and left by this cell.'); } } return dp[m - 1][n - 1][0]; }
  });

  D('minimum-split-into-subarrays-with-gcd-greater-than-one', {
    t: 'Minimum Split Into Subarrays With GCD > 1: cut when the gcd hits 1',
    r: 'Keep a running gcd. If including the next number makes it 1, start a new subarray at that number.',
    g: R => ({ nums: Array.from({ length: R.int(4, 6) }, () => R.pick([2, 3, 4, 6, 8, 9, 10, 12, 15])) }),
    s(I, T) { let g = 0, cnt = 1; I.nums.forEach((x, i) => { const ng = gcd(g, x); T.at({ nums: A(I.nums, { hl: [i] }), gcd: g, pieces: cnt }); T.n(`Running gcd after including ${x} (restart if it would be 1)?`, ng === 1 ? x : ng, ng === 1 ? `gcd would be 1: start a new subarray at ${x}.` : `gcd(${g}, ${x}).`); if (ng === 1) { cnt++; g = x; } else g = ng; }); return cnt; }
  });

  D('minimize-maximum-of-array', {
    t: 'Minimize Maximum of Array: averages of prefixes',
    r: 'Values can only move left. The first i + 1 numbers can be no flatter than ceil(prefix sum divided by (i + 1)). The answer is the largest such ceiling.',
    g: R => ({ nums: R.ints(R.int(3, 5), 0, 12) }),
    s(I, T) { let s = 0, best = 0; I.nums.forEach((x, i) => { s += x; const v = Math.ceil(s / (i + 1)); T.at({ nums: A(I.nums, { win: [0, i] }), sum: s, best }); T.n(`ceil(prefix sum divided by ${i + 1})?`, v, `ceil(${s} divided by ${i + 1}).`); best = Math.max(best, v); }); return best; }
  });

  D('minimum-total-distance-traveled', {
    t: 'Minimum Total Distance Traveled: sorted robots go to sorted factories in blocks',
    r: 'Sort both. dp[i][j] = least distance fixing the first i robots with the first j factories = min over t at most limit_j of dp[i−t][j−1] + distance of robots i−t to i−1 to factory j.',
    g: R => ({ robot: R.distinct(R.int(2, 4), 0, 10), factory: R.distinct(2, 0, 10).map(p => [p, R.int(1, 2)]).concat([[R.int(0, 10), 2]]) }),
    s(I, T) {
      const r = I.robot.slice().sort((a, b) => a - b), f = I.factory.slice().sort((a, b) => a[0] - b[0]), n = r.length; let dp = Array(n + 1).fill(Infinity); dp[0] = 0;
      f.forEach(([pos, lim], j) => { const nx = dp.slice(); for (let i = 1; i <= n; i++) { let d = 0; for (let t = 1; t <= lim && t <= i; t++) { d += Math.abs(r[i - t] - pos); nx[i] = Math.min(nx[i], dp[i - t] + d); } } dp = nx; T.at({ robots: A(r), factory: `#${j} at ${pos}, limit ${lim}` }); T.n(`After factory ${j}: least distance to fix all ${n} robots (inf if not yet possible)?`, dp[n], 'Give this factory the last t robots, t at most limit.'); });
      return dp[n];
    }
  });

  D('minimum-subarrays-in-a-valid-split', {
    t: 'Minimum Subarrays in a Valid Split: first and last share a factor',
    r: 'dp[i] = fewest subarrays for nums[0 to i). The last subarray nums[j to i−1] is valid if gcd(nums[j], nums[i−1]) > 1: dp[i] = min dp[j] + 1.',
    g: R => ({ nums: Array.from({ length: R.int(3, 5) }, () => R.pick([2, 3, 4, 5, 6, 9, 10])) }),
    s(I, T) { const a = I.nums, n = a.length, dp = [0]; for (let i = 1; i <= n; i++) { let b = Infinity; for (let j = 0; j < i; j++) if (gcd(a[j], a[i - 1]) > 1 && dp[j] < Infinity) b = Math.min(b, dp[j] + 1); T.at({ nums: A(a, { hl: [i - 1] }), dp: A(dp.map(v => v === Infinity ? '∞' : v).concat('?')) }); T.n(`dp[${i}] (inf if impossible)?`, b, 'Best start j whose value shares a factor with the last.'); dp.push(b); } return dp[n] === Infinity ? -1 : dp[n]; }
  });

  D('count-ways-to-build-good-strings', {
    t: 'Count Ways to Build Good Strings: append a zero-block or a one-block',
    r: 'dp[len] = strings of exactly that length = dp[len − zero] + dp[len − one]. Sum dp over low to high.',
    g: R => { const low = R.int(2, 5); return { low, high: low + R.int(0, 2), zero: R.int(1, 2), one: R.int(1, 3) }; },
    s(I, T) { const dp = [1]; let tot = 0; for (let l = 1; l <= I.high; l++) { const v = ((l >= I.zero ? dp[l - I.zero] : 0) + (l >= I.one ? dp[l - I.one] : 0)) % MOD; T.at({ dp: A(dp.concat('?')), zero: I.zero, one: I.one }); T.n(`dp[${l}]?`, v, `dp[${l} − ${I.zero}] + dp[${l} − ${I.one}].`); dp.push(v); if (l >= I.low) tot = (tot + v) % MOD; } return tot; }
  });

  D('maximum-number-of-non-overlapping-palindrome-substrings', {
    t: 'Non-Overlapping Palindrome Substrings: only lengths k and k + 1 matter',
    r: 'dp[i] = most palindromes in s[0 to i). dp[i] = max(dp[i−1], dp[i−k] + 1 if s[i−k to i) is a palindrome, dp[i−k−1] + 1 if s[i−k−1 to i) is).',
    g: R => ({ s: R.str(R.int(6, 8), 'ab'), k: R.int(2, 3) }),
    s(I, T) { const s = I.s, k = I.k, pal = (i, j) => { while (i < j) if (s[i++] !== s[j--]) return false; return true; }, dp = [0]; for (let i = 1; i <= s.length; i++) { let v = dp[i - 1]; if (i >= k && pal(i - k, i - 1)) v = Math.max(v, dp[i - k] + 1); if (i >= k + 1 && pal(i - k - 1, i - 1)) v = Math.max(v, dp[i - k - 1] + 1); T.at({ s: A([...s], { hl: [i - 1] }), dp: A(dp.concat('?')), k }); T.n(`dp[${i}]?`, v, 'Skip, or end a palindrome of length k or k + 1 here.'); dp.push(v); } return dp[s.length]; }
  });

  D('number-of-beautiful-partitions', {
    t: 'Number of Beautiful Partitions: prime start, non-prime end',
    r: 'Each part starts with a prime digit (2, 3, 5, 7), ends with a non-prime, and has length at least minLength. dp[p][i] = ways to split s[0 to i) into p parts, cutting only where s[i−1] is non-prime and s[i] is prime.',
    g: R => ({ s: '2' + R.str(R.int(4, 7), '123456789') + '1', k: R.int(1, 3), minLength: R.int(1, 2) }),
    s(I, T) {
      const s = I.s, n = s.length, P = c => '2357'.includes(c); if (!P(s[0]) || P(s[n - 1])) return 0; let dp = Array(n + 1).fill(0); dp[0] = 1;
      for (let p = 1; p <= I.k; p++) { const nx = Array(n + 1).fill(0); for (let i = I.minLength; i <= n; i++) if (!P(s[i - 1]) && (i === n || P(s[i]))) for (let j = 0; j + I.minLength <= i; j++) if (dp[j] && (j === 0 || (!P(s[j - 1]) && P(s[j])))) nx[i] = (nx[i] + dp[j]) % MOD; dp = nx; T.at({ s: A([...s], { cls: [...s].map(c => P(c) ? 'ok' : '') }), parts: p, minLength: I.minLength }); T.n(`Ways to split the whole string into ${p} parts?`, dp[n], 'Cuts only between a non-prime and a prime.'); }
      return dp[n];
    }
  });

  D('count-palindromic-subsequences', {
    t: 'Count Palindromic Subsequences of Length 5: pairs on both sides',
    r: 'For each middle index, count digit pairs (a, b) before it and (b, a) after it: the sum of pre[a][b] times suf[b][a].',
    g: R => ({ s: R.str(R.int(5, 7), '01') }),
    s(I, T) { const s = I.s, n = s.length; let tot = 0; for (let m = 2; m < n - 2; m++) { let v = 0; for (const a of '0123456789') for (const b of '0123456789') { let pre = 0, suf = 0; for (let i = 0; i < m; i++) for (let j = i + 1; j < m; j++) if (s[i] === a && s[j] === b) pre++; for (let i = m + 1; i < n; i++) for (let j = i + 1; j < n; j++) if (s[i] === b && s[j] === a) suf++; v += pre * suf; } T.at({ s: A([...s], { hl: [m] }), total: tot }); T.n(`Length-5 palindromes with middle index ${m}?`, v, 'the sum of pairs (a, b) before times pairs (b, a) after.'); tot = (tot + v) % MOD; } return tot; }
  });
})();
