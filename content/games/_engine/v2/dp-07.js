/* v2 games: dynamic programming (7). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const pc = m => { let c = 0; while (m) { c += m & 1; m >>= 1; } return c; };

  D('restore-the-array', {
    t: 'Restore the Array: how many ways to cut the digits?',
    r: 'dp[i] = ways to split s[i..]. A number s[i..j] is valid if it has no leading zero and is ≤ k: dp[i] = Σ dp[j+1] over valid j.',
    g: R => ({ s: String(R.int(1, 9)) + R.str(R.int(2, 4), '0123'), k: R.pick([10, 20, 100, 300]) }),
    s(I, T) { const s = I.s, n = s.length, dp = Array(n + 1).fill(0); dp[n] = 1; for (let i = n - 1; i >= 0; i--) { if (s[i] !== '0') for (let j = i; j < n; j++) { if (+s.slice(i, j + 1) > I.k) break; dp[i] = (dp[i] + dp[j + 1]) % MOD; } T.at({ s: A([...s], { hl: [i] }), k: I.k, dp: A(dp.map((v, j) => j > i ? v : '?')) }); T.n(`dp[${i}]?`, dp[i], s[i] === '0' ? 'No number may start with 0.' : 'Sum dp after every valid first number.'); } return dp[0]; }
  });

  D('build-array-where-you-can-find-the-maximum-exactly-k-comparisons', {
    t: 'Build Array with Exactly k Max Updates: length, max, cost',
    r: 'dp[i][j][c] = arrays of length i with maximum j and c updates. Appending a value at most j keeps both, so multiply by j. Appending a new maximum j after a smaller maximum adds one update, so add dp[i minus 1][smaller max][c minus 1] over every smaller max.',
    g: R => ({ n: R.int(2, 3), m: R.int(2, 3), k: R.int(1, 2) }),
    s(I, T) {
      const { n, m, k } = I; let dp = mk(m + 1, k + 1, 0); for (let j = 1; j <= m; j++) dp[j][1] = 1; T.at({ n, m, k }); T.n('Most updates any array can have?', Math.min(n, m), 'Each update needs a new, larger maximum.'); T.n('Length 1: arrays with exactly 1 update?', m, 'Any single value from 1 to m.'); if (n === 1) T.n(`Arrays with exactly ${k} updates?`, k === 1 ? m % MOD : 0, 'A single element always costs 1.');
      for (let i = 2; i <= n; i++) { const nx = mk(m + 1, k + 1, 0); for (let j = 1; j <= m; j++) for (let c = 1; c <= k; c++) { let v = dp[j][c] * j; for (let p = 1; p < j; p++) v += dp[p][c - 1]; nx[j][c] = v % MOD; }
        dp = nx; T.at({ length: i, table: G(dp.slice(1).map(r => r.slice(1)), { rh: dp.slice(1).map((_, j) => 'max ' + (j + 1)), ch: dp[0].slice(1).map((_, c) => 'cost ' + (c + 1)) }) }); T.n(`Length ${i}: arrays with exactly ${k} updates?`, dp.reduce((s, r) => s + r[k], 0) % MOD, 'Sum the cost-k column.'); }
      return dp.reduce((s, r) => (s + r[k]) % MOD, 0);
    }
  });

  D('constrained-subsequence-sum', {
    t: 'Constrained Subsequence Sum: best of the last k, via a deque',
    r: 'dp[i] = nums[i] + max(0, max dp[i−k..i−1]). A decreasing deque of dp values gives the window max in O(1).',
    g: R => ({ nums: R.ints(R.int(5, 7), -6, 8), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums, dp = []; a.forEach((x, i) => { const w = dp.slice(Math.max(0, i - I.k), i), v = x + Math.max(0, ...w); T.at({ nums: A(a, { hl: [i] }), dp: A(dp.concat('?'), { win: [Math.max(0, i - I.k), i - 1] }) }); T.n(`dp[${i}]?`, v, `${x} + max(0, best in the last ${I.k}).`); dp.push(v); }); return Math.max(...dp); }
  });

  D('number-of-ways-to-wear-different-hats-to-each-other', {
    t: 'Number of Ways to Wear Different Hats: iterate hats, mask the people',
    r: 'People are few, hats are many: dp[mask] = ways to dress exactly the people in mask using hats so far. For each hat, either skip it or give it to one person who likes it and is not yet dressed.',
    g: R => ({ hats: Array.from({ length: R.int(2, 3) }, () => R.distinct(R.int(1, 3), 1, 5)) }),
    s(I, T) {
      const n = I.hats.length, full = (1 << n) - 1; let dp = Array(1 << n).fill(0); dp[0] = 1; const maxH = Math.max(...I.hats.flat());
      for (let h = 1; h <= maxH; h++) { const who = I.hats.map((l, p) => l.includes(h) ? p : -1).filter(p => p >= 0); if (!who.length) continue; const nx = dp.slice(); for (let m = 0; m <= full; m++) if (dp[m]) for (const p of who) if (!(m >> p & 1)) nx[m | 1 << p] = (nx[m | 1 << p] + dp[m]) % MOD; dp = nx;
        T.at({ hat: h, likes: A(who.map(p => 'person ' + p)), hats: K(I.hats.map((l, p) => ['person ' + p, l.join(',')])) }); T.n(`After hat ${h}: ways with everyone dressed?`, dp[full], 'dp[full mask].'); }
      return dp[full];
    }
  });

  D('number-of-ways-of-cutting-a-pizza', {
    t: 'Number of Ways of Cutting a Pizza: every piece needs an apple',
    r: 'ways(k, r, c) = ways to cut the sub-pizza from (r, c) into k pieces. Cut horizontally at row x (top piece given away) or vertically at column y; the given piece must have an apple. Apple counts come from a suffix-sum table.',
    g: R => ({ pizza: Array.from({ length: 3 }, () => R.str(3, 'A..')), k: R.int(2, 3) }),
    s(I, T) {
      const P = I.pizza, m = P.length, n = P[0].length, S = mk(m + 1, n + 1, 0);
      for (let r = m - 1; r >= 0; r--) for (let c = n - 1; c >= 0; c--) S[r][c] = (P[r][c] === 'A' ? 1 : 0) + S[r + 1][c] + S[r][c + 1] - S[r + 1][c + 1];
      const memo = new Map(), f = (k, r, c) => { if (S[r][c] === 0) return 0; if (k === 1) return 1; const key = k * 1e4 + r * 100 + c; if (memo.has(key)) return memo.get(key); let v = 0; for (let x = r + 1; x < m; x++) if (S[r][c] - S[x][c] > 0) v += f(k - 1, x, c); for (let y = c + 1; y < n; y++) if (S[r][c] - S[r][y] > 0) v += f(k - 1, r, y); v %= MOD; memo.set(key, v); return v; };
      T.at({ pizza: G(P.map(x => [...x])) }); T.n('Apples on the whole pizza?', S[0][0], 'Suffix sum at (0,0).');
      for (let x = 1; x < m; x++) { T.at({ pizza: G(P.map(x => [...x]), { hl: [...Array(n).keys()].map(c => [x, c]) }), k: I.k }); T.n(`Cut above row ${x} first: ways to finish (0 if the top has no apple)?`, S[0][0] - S[x][0] > 0 ? f(I.k - 1, x, 0) : 0, 'The top piece needs an apple; then solve the rest with k − 1 pieces.'); }
      return f(I.k, 0, 0);
    }
  });

  D('form-largest-integer-with-digits-that-add-up-to-target', {
    t: 'Form Largest Integer: most digits first, then biggest digits',
    r: 'dp[t] = most digits with total cost exactly t (−∞ if impossible). Then build greedily: at each step take the largest digit d with dp[t − cost[d]] == dp[t] − 1.',
    g: R => ({ cost: Array.from({ length: 9 }, () => R.int(2, 7)), target: R.int(5, 12) }),
    s(I, T) {
      const c = I.cost, dp = Array(I.target + 1).fill(-Infinity); dp[0] = 0; for (let t = 1; t <= I.target; t++) for (const x of c) if (x <= t) dp[t] = Math.max(dp[t], dp[t - x] + 1);
      T.at({ cost: A(c, { labels: [1, 2, 3, 4, 5, 6, 7, 8, 9] }), target: I.target }); T.n('Most digits you can paint (0 if impossible)?', dp[I.target] < 0 ? 0 : dp[I.target], 'Unbounded knapsack on count.'); if (dp[I.target] < 0) return '0';
      let t = I.target, out = ''; while (t > 0) { for (let d = 9; d >= 1; d--) if (c[d - 1] <= t && dp[t - c[d - 1]] === dp[t] - 1) { T.at({ cost: A(c, { labels: [1, 2, 3, 4, 5, 6, 7, 8, 9] }), left: t, so_far: out || '""' }); T.n('Next digit?', d, 'Largest digit that keeps the maximum count reachable.'); out += d; t -= c[d - 1]; break; } }
      return out;
    }
  });

  D('max-dot-product-of-two-subsequences', {
    t: 'Max Dot Product of Two Subsequences: pair, extend, or skip',
    r: 'dp[i][j] = best for nums1[0..i] and nums2[0..j] (non-empty). Options: a[i]·b[j] alone, a[i]·b[j] + dp[i−1][j−1], or skip one side: dp[i−1][j], dp[i][j−1].',
    g: R => ({ nums1: R.ints(R.int(2, 3), -4, 5), nums2: R.ints(R.int(2, 3), -4, 5) }),
    s(I, T) { const a = I.nums1, b = I.nums2, dp = mk(a.length, b.length, 0); for (let i = 0; i < a.length; i++) for (let j = 0; j < b.length; j++) { const p = a[i] * b[j]; let v = p; if (i && j) v = Math.max(v, p + dp[i - 1][j - 1]); if (i) v = Math.max(v, dp[i - 1][j]); if (j) v = Math.max(v, dp[i][j - 1]); T.at({ dp: G(dp.map((r, x) => r.map((y, z) => x < i || (x === i && z < j) ? y : '?')), { rh: a, ch: b, hl: [[i, j]] }) }); T.n(`dp[${i}][${j}]?`, v, `Best of ${p} alone, ${p} + diagonal, or skipping a side.`); dp[i][j] = v; } return dp[a.length - 1][b.length - 1]; }
  });

  D('cherry-pickup-ii', {
    t: 'Cherry Pickup II: two robots, one row at a time',
    r: 'dp[c1][c2] = most cherries with robots in columns c1 and c2 on the current row. Each moves −1, 0 or +1 columns per row; a shared cell counts once.',
    g: R => ({ grid: R.grid(R.int(3, 4), R.int(3, 4), 0, 5) }),
    s(I, T) {
      const g = I.grid, m = g.length, n = g[0].length; let dp = mk(n, n, -Infinity); dp[0][n - 1] = g[0][0] + (n > 1 ? g[0][n - 1] : 0);
      for (let r = 1; r < m; r++) { const nx = mk(n, n, -Infinity); for (let a = 0; a < n; a++) for (let b = 0; b < n; b++) { let best = -Infinity; for (const da of [-1, 0, 1]) for (const db of [-1, 0, 1]) { const x = a + da, y = b + db; if (x >= 0 && y >= 0 && x < n && y < n) best = Math.max(best, dp[x][y]); } if (best > -Infinity) nx[a][b] = best + g[r][a] + (a !== b ? g[r][b] : 0); }
        dp = nx; T.at({ grid: G(g, { hl: [...Array(n).keys()].map(c => [r, c]) }) }); T.n(`After row ${r}: most cherries so far?`, Math.max(...dp.flat()), 'Best over every pair of robot columns.'); }
      return Math.max(...dp.flat());
    }
  });

  D('paint-house-iii', {
    t: 'Paint House III: color and neighborhood count',
    r: 'dp[c][t] = cheapest cost with the last house color c and t neighborhoods. Same color as before keeps t; a different color makes t + 1. Pre-painted houses cost 0 but force their color.',
    g: R => { const m = R.int(3, 4), n = 2; return { houses: Array.from({ length: m }, () => R.chance(0.3) ? R.int(1, n) : 0), cost: Array.from({ length: m }, () => R.ints(n, 1, 9)), m, n, target: R.int(1, 3) }; },
    s(I, T) {
      const { houses, cost, n, target } = I; let dp = mk(n + 1, target + 2, Infinity);
      houses.forEach((h, i) => { const nx = mk(n + 1, target + 2, Infinity); for (let c = 1; c <= n; c++) { if (h && h !== c) continue; const pay = h ? 0 : cost[i][c - 1];
          if (i === 0) nx[c][1] = pay; else for (let p = 1; p <= n; p++) for (let t = 1; t <= target; t++) if (dp[p][t] < Infinity) { const nt = p === c ? t : t + 1; if (nt <= target) nx[c][nt] = Math.min(nx[c][nt], dp[p][t] + pay); } }
        dp = nx; const best = Math.min(...dp.slice(1).map(r => Math.min(...r.slice(1, target + 1)))); T.at({ houses: A(houses, { hl: [i] }), cost: G(cost, { hl: [[i, 0], [i, 1]] }), target }); T.n(`Cheapest cost for houses 0..${i} with at most ${target} neighborhoods (inf if none)?`, best, 'Min over colors and neighborhood counts so far.'); });
      const ans = Math.min(...dp.slice(1).map(r => r[target])); return ans === Infinity ? -1 : ans;
    }
  });

  D('find-two-non-overlapping-sub-arrays-each-with-target-sum', {
    t: 'Two Non-Overlapping Sub-arrays With Target Sum: best one so far',
    r: 'Sliding window (all positive). When a window [l, r] sums to target, pair it with best[l−1] = shortest window ending before l. Keep best[r] = shortest window ending at or before r.',
    g: R => ({ arr: R.ints(R.int(6, 8), 1, 4), target: R.int(3, 5) }),
    s(I, T) {
      const a = I.arr, n = a.length, best = Array(n).fill(Infinity); let l = 0, s = 0, ans = Infinity;
      for (let r = 0; r < n; r++) { s += a[r]; while (s > I.target) s -= a[l++]; let cur = Infinity; if (s === I.target) { cur = r - l + 1; if (l > 0 && best[l - 1] < Infinity) ans = Math.min(ans, cur + best[l - 1]); }
        best[r] = Math.min(r ? best[r - 1] : Infinity, cur); T.at({ arr: A(a, { win: [l, r] }), sum: s, best: A(best.map((v, j) => j < r ? (v === Infinity ? '∞' : v) : '?')) }); T.n(`best[${r}] (shortest window ending by ${r}; inf if none)?`, best[r], s === I.target ? `This window has length ${cur}.` : 'No window ends here: copy best[r−1].'); }
      return ans === Infinity ? -1 : ans;
    }
  });

  D('allocate-mailboxes', {
    t: 'Allocate Mailboxes: one mailbox per group, at the median',
    r: 'Sort houses. cost[i][j] = total distance from houses i..j to their median. dp[b][j] = min over i of dp[b−1][i] + cost[i][j−1].',
    g: R => ({ houses: R.distinct(R.int(4, 5), 1, 20), k: R.int(1, 3) }),
    s(I, T) {
      const h = I.houses.slice().sort((a, b) => a - b), n = h.length, cost = (i, j) => { const md = h[(i + j) >> 1]; let s = 0; for (let x = i; x <= j; x++) s += Math.abs(h[x] - md); return s; };
      T.at({ houses: A(h) }); T.n('Cost of one mailbox serving every house?', cost(0, n - 1), `Put it at the median ${h[(n - 1) >> 1]}.`);
      let dp = Array(n + 1).fill(Infinity); dp[0] = 0; for (let b = 1; b <= I.k; b++) { const nx = Array(n + 1).fill(Infinity); for (let j = 1; j <= n; j++) for (let i = 0; i < j; i++) nx[j] = Math.min(nx[j], dp[i] + cost(i, j - 1)); dp = nx; if (b > 1) { T.at({ houses: A(h), mailboxes: b }); T.n(`Least total distance with ${b} mailboxes?`, dp[n], 'Best previous split + cost of the last group.'); } }
      return dp[n];
    }
  });

  D('count-submatrices-with-all-ones', {
    t: 'Count Submatrices With All Ones: heights, then widen left',
    r: 'h[c] = consecutive 1s ending at the current row in column c. For bottom-right corner (r, c), walk left keeping the minimum height: each step adds that minimum.',
    g: R => ({ mat: R.grid(3, 3, 0, 1).map(r => r.map(x => R.chance(0.5) ? 1 : x)) }),
    s(I, T) { const g = I.mat, n = g[0].length, h = Array(n).fill(0); let tot = 0; g.forEach((row, r) => { row.forEach((v, c) => h[c] = v ? h[c] + 1 : 0); for (let c = 0; c < n; c++) { let mn = Infinity, cnt = 0; for (let x = c; x >= 0 && h[x]; x--) { mn = Math.min(mn, h[x]); cnt += mn; } if (g[r][c]) { T.at({ mat: G(g, { hl: [[r, c]] }), heights: A(h), total: tot }); T.n(`Submatrices with bottom-right corner (${r},${c})?`, cnt, 'Walk left, adding the running minimum height.'); } tot += cnt; } }); return tot; }
  });

  D('stone-game-iv', {
    t: 'Stone Game IV: win if some square leaves a losing pile',
    r: 'win[i] = true if some square s ≤ i makes win[i − s] false.',
    g: R => ({ n: R.int(4, 12) }),
    s(I, T) { const w = [false]; for (let i = 1; i <= I.n; i++) { let v = false; for (let s = 1; s * s <= i; s++) if (!w[i - s * s]) v = true; T.at({ win: A(w.map(x => x ? 'W' : 'L')) }); T.yn(`Does the player to move win with ${i} stones?`, v, v ? 'Some square removal leaves a losing pile.' : 'Every square removal leaves a winning pile.'); w.push(v); } return w[I.n]; }
  });

  D('number-of-good-ways-to-split-a-string', {
    t: 'Number of Good Ways to Split a String: distinct counts on both sides',
    r: 'Precompute distinct letters in every prefix and every suffix. A split after index i is good if prefix[i] == suffix[i+1].',
    g: R => ({ s: R.str(R.int(5, 7), 'abc') }),
    s(I, T) { const s = I.s, n = s.length; let c = 0; for (let i = 0; i < n - 1; i++) { const l = new Set(s.slice(0, i + 1)).size, r = new Set(s.slice(i + 1)).size; T.at({ s: A([...s], { win: [0, i] }) }); T.yn(`Split after index ${i}: good?`, l === r, `Left has ${l} distinct letters, right has ${r}.`); if (l === r) c++; } return c; }
  });

  D('string-compression-ii', {
    t: 'String Compression II: keep a run, delete the rest of it',
    r: 'f(i, k) = shortest encoding of s[i..] with k deletions left. Either delete s[i], or keep it and extend its run to j, deleting every different letter in between (if k allows). Run length L costs 1, 2 (L in 2–9), 3 (10–99)…',
    g: R => ({ s: R.str(R.int(5, 7), 'ab'), k: R.int(1, 2) }),
    s(I, T) {
      const s = I.s, n = s.length, memo = new Map(), len = c => c === 1 ? 1 : c < 10 ? 2 : c < 100 ? 3 : 4;
      const f = (i, k) => { if (k < 0) return Infinity; if (n - i <= k) return 0; const key = i * 200 + k; if (memo.has(key)) return memo.get(key); let b = f(i + 1, k - 1), same = 0, diff = 0; for (let j = i; j < n; j++) { if (s[j] === s[i]) same++; else diff++; if (diff > k) break; b = Math.min(b, len(same) + f(j + 1, k - diff)); } memo.set(key, b); return b; };
      for (let i = Math.min(n - 1, 4); i >= 0; i--) { T.at({ s: A([...s], { win: [i, n - 1] }), k: I.k }); T.n(`Shortest encoding of "${s.slice(i)}" with ${I.k} deletion(s)?`, f(i, I.k), 'Delete s[i], or keep it and grow its run.'); }
      return f(0, I.k);
    }
  });

  D('get-the-maximum-score', {
    t: 'Get the Maximum Score: switch tracks at shared values',
    r: 'Walk both sorted arrays with two pointers, summing each side between shared values. At a shared value, both sums collapse to max(sum1, sum2) + value.',
    g: R => { const s = R.distinct(R.int(3, 4), 1, 9), t = R.distinct(R.int(3, 4), 1, 9); return { nums1: [...new Set(s)].sort((a, b) => a - b), nums2: [...new Set(t)].sort((a, b) => a - b) }; },
    s(I, T) { const a = I.nums1, b = I.nums2; let i = 0, j = 0, s1 = 0, s2 = 0; while (i < a.length || j < b.length) { if (j >= b.length || (i < a.length && a[i] < b[j])) s1 += a[i++]; else if (i >= a.length || b[j] < a[i]) s2 += b[j++]; else { const v = Math.max(s1, s2) + a[i]; T.at({ nums1: A(a, { i }), nums2: A(b, { i: j }), sum1: s1, sum2: s2 }); T.n(`Shared value ${a[i]}: both sums become?`, v, `max(${s1}, ${s2}) + ${a[i]}.`); s1 = s2 = v; i++; j++; } } T.at({ sum1: s1, sum2: s2 }); T.n('Final score?', Math.max(s1, s2) % MOD, 'The larger tail sum.'); return Math.max(s1, s2) % MOD; }
  });

  D('minimum-cost-to-cut-a-stick', {
    t: 'Minimum Cost to Cut a Stick: interval DP over cut points',
    r: 'Sort cuts and add 0 and n. dp[i][j] = cheapest way to make every cut strictly between points i and j = (p[j] − p[i]) + min over m of dp[i][m] + dp[m][j].',
    g: R => { const n = R.int(6, 10); return { n, cuts: R.distinct(R.int(2, 3), 1, n - 1) }; },
    s(I, T) { const p = [0, ...I.cuts.slice().sort((a, b) => a - b), I.n], m = p.length, dp = mk(m, m, 0); for (let len = 2; len < m; len++) for (let i = 0; i + len < m; i++) { const j = i + len; let b = Infinity; for (let k = i + 1; k < j; k++) b = Math.min(b, dp[i][k] + dp[k][j]); dp[i][j] = b + p[j] - p[i]; T.at({ points: A(p, { win: [i, j] }) }); T.n(`dp[${i}][${j}] (stick ${p[i]}..${p[j]})?`, dp[i][j], `Length ${p[j] - p[i]} + the best first cut inside.`); } return dp[0][m - 1]; }
  });

  D('minimum-number-of-days-to-eat-n-oranges', {
    t: 'Minimum Days to Eat N Oranges: eat singles only to reach a multiple',
    r: 'f(n) = 1 + min(n % 2 + f(n / 2), n % 3 + f(n / 3)) (floor division), with f(0) = 0 and f(1) = 1. Eating one at a time is only useful to reach a multiple of 2 or 3.',
    g: R => ({ n: R.int(5, 40) }),
    s(I, T) { const memo = new Map([[0, 0], [1, 1]]), f = n => { if (memo.has(n)) return memo.get(n); const v = 1 + Math.min(n % 2 + f(Math.floor(n / 2)), n % 3 + f(Math.floor(n / 3))); memo.set(n, v); return v; }; f(I.n); let n = I.n; while (n > 1) { const a = n % 2 + f(Math.floor(n / 2)), b = n % 3 + f(Math.floor(n / 3)); T.at({ n, memo: K([...memo].filter(([k]) => k < n).slice(-6).map(([k, v]) => ['f(' + k + ')', v])) }); T.c(`${n} oranges: head for halving or for thirds?`, ['halve', 'third'], a <= b ? 'halve' : 'third', `Halving costs ${a} + 1, thirds cost ${b} + 1.`); n = a <= b ? Math.floor(n / 2) : Math.floor(n / 3); } return f(I.n); }
  });

  D('stone-game-v', {
    t: 'Stone Game V: Bob throws away the bigger half',
    r: 'dp[i][j] = Alice\'s best from row i..j. For each split, the smaller-sum side is kept (its sum is scored and play continues on it); on a tie Alice picks the better side.',
    g: R => ({ stoneValue: R.ints(R.int(3, 5), 1, 7) }),
    s(I, T) { const v = I.stoneValue, n = v.length, P = [0]; v.forEach(x => P.push(P[P.length - 1] + x)); const S = (i, j) => P[j + 1] - P[i], dp = mk(n, n, 0); for (let len = 2; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1; let b = 0; for (let m = i; m < j; m++) { const l = S(i, m), r = S(m + 1, j); b = Math.max(b, l < r ? l + dp[i][m] : l > r ? r + dp[m + 1][j] : l + Math.max(dp[i][m], dp[m + 1][j])); } dp[i][j] = b; T.at({ stones: A(v, { win: [i, j] }) }); T.n(`dp[${i}][${j}]?`, b, 'Best split: score the smaller side and keep playing it.'); } return dp[0][n - 1]; }
  });

  D('maximum-length-of-subarray-with-positive-product', {
    t: 'Max Length Subarray With Positive Product: positive and negative lengths',
    r: 'pos / neg = longest subarray ending here with positive / negative product. Positive x: pos+1, neg+1 (if neg > 0). Negative x: swap them. Zero resets both.',
    g: R => ({ nums: R.ints(R.int(6, 8), -3, 3) }),
    s(I, T) { let pos = 0, neg = 0, best = 0; I.nums.forEach((x, i) => { if (x > 0) { pos++; neg = neg ? neg + 1 : 0; } else if (x < 0) { const p = pos; pos = neg ? neg + 1 : 0; neg = p + 1; } else pos = neg = 0; T.at({ nums: A(I.nums, { hl: [i] }), best }); T.n(`Longest positive-product subarray ending at ${i}?`, pos, x === 0 ? 'Zero resets.' : x < 0 ? 'A negative swaps the roles of pos and neg.' : 'A positive extends both.'); best = Math.max(best, pos); }); return best; }
  });

  D('count-all-possible-routes', {
    t: 'Count All Possible Routes: memo on (city, fuel)',
    r: 'f(city, fuel) = (city == finish ? 1 : 0) + Σ f(next, fuel − |loc[city] − loc[next]|) over other cities with enough fuel.',
    g: R => ({ locations: R.distinct(R.int(3, 4), 1, 8), start: 0, finish: R.int(0, 2), fuel: R.int(2, 6) }),
    s(I, T) { const L = I.locations, memo = new Map(), f = (c, fu) => { const k = c * 1000 + fu; if (memo.has(k)) return memo.get(k); let v = c === I.finish ? 1 : 0; L.forEach((x, j) => { const d = Math.abs(x - L[c]); if (j !== c && d <= fu) v = (v + f(j, fu - d)) % MOD; }); memo.set(k, v); return v; }; for (let fu = 0; fu <= I.fuel; fu++) { T.at({ locations: A(L, { hl: [I.start] }), finish: I.finish }); T.n(`f(start, ${fu}): routes with ${fu} fuel?`, f(I.start, fu), 'Arrive-here counts 1, plus every next city you can afford.'); } return f(I.start, I.fuel); }
  });

  D('maximum-non-negative-product-in-a-matrix', {
    t: 'Maximum Non-Negative Product: keep the max and the min',
    r: 'For each cell keep the largest and smallest product reaching it. A negative cell swaps which one becomes the new max. Answer: max at the end mod 1e9+7, or −1 if negative.',
    g: R => ({ grid: R.grid(3, 3, -3, 3) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, hi = mk(m, n, 0), lo = mk(m, n, 0); for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) { const x = g[r][c]; if (!r && !c) { hi[0][0] = lo[0][0] = x; continue; } const cand = []; if (r) cand.push(hi[r - 1][c] * x, lo[r - 1][c] * x); if (c) cand.push(hi[r][c - 1] * x, lo[r][c - 1] * x); hi[r][c] = Math.max(...cand); lo[r][c] = Math.min(...cand); if (r + c >= 2) { T.at({ grid: G(g, { hl: [[r, c]] }) }); T.n(`Largest product reaching (${r},${c})?`, hi[r][c], x < 0 ? 'Negative cell: the old minimum times x.' : 'The old maximum times x (or the minimum if x ≤ 0).'); } } const v = hi[m - 1][n - 1]; return v < 0 ? -1 : v % MOD; }
  });

  D('minimum-cost-to-connect-two-groups-of-points', {
    t: 'Minimum Cost to Connect Two Groups: mask the right side',
    r: 'f(i, mask) = cheapest way to connect left points i.. given right points in mask are already connected. Each left point picks one right point. At the end, every unconnected right point uses its cheapest edge.',
    g: R => { const a = R.int(2, 3), b = R.int(2, a); return { cost: Array.from({ length: a }, () => R.ints(b, 1, 9)) }; },
    s(I, T) {
      const C = I.cost, n1 = C.length, n2 = C[0].length, mn = [...Array(n2).keys()].map(j => Math.min(...C.map(r => r[j]))), memo = new Map();
      const f = (i, m) => { if (i === n1) { let s = 0; for (let j = 0; j < n2; j++) if (!(m >> j & 1)) s += mn[j]; return s; } const k = i * 4096 + m; if (memo.has(k)) return memo.get(k); let b = Infinity; for (let j = 0; j < n2; j++) b = Math.min(b, C[i][j] + f(i + 1, m | 1 << j)); memo.set(k, b); return b; };
      for (let j = 0; j < n2; j++) { T.at({ cost: G(C, { hl: C.map((_, i) => [i, j]) }) }); T.n(`Cheapest edge into right point ${j}?`, mn[j], 'Column minimum: used if nobody else connects it.'); }
      let m = 0; for (let i = 0; i < n1; i++) { const ok = [...Array(n2).keys()].filter(j => C[i][j] + f(i + 1, m | 1 << j) === f(i, m)).map(String); T.at({ cost: G(C, { hl: [...Array(n2).keys()].map(j => [i, j]) }), connected: A([...Array(n2).keys()].filter(j => m >> j & 1)) }); T.k(`Left point ${i} connects to which right point (optimal)?`, [...Array(n2).keys()].map(j => [String(j), `right ${j} (${C[i][j]})`]), ok, `Optimal remaining cost is ${f(i, m)}.`); m |= 1 << +ok[0]; }
      return f(0, 0);
    }
  });

  D('number-of-sets-of-k-non-overlapping-line-segments', {
    t: 'Number of Sets of k Non-Overlapping Segments: C(n + k − 1, 2k)',
    r: 'Segments may share endpoints. Stretch each shared point into two: choosing k segments becomes choosing 2k distinct endpoints from n + k − 1 points.',
    g: R => { const n = R.int(3, 6); return { n, k: R.int(1, n - 1) }; },
    s(I, T) { const N = I.n + I.k - 1, K2 = 2 * I.k; T.at({ n: I.n, k: I.k }); T.n('How many points after stretching the shared endpoints?', N, 'n plus k minus 1.'); T.n('Endpoints to choose?', K2, 'Two per segment.'); let c = 1; for (let i = 0; i < K2; i++) c = c * (N - i) / (i + 1); T.n(`Ways to choose ${K2} of the ${N} points?`, c, 'Choose 2k endpoints.'); return c % MOD; }
  });

  D('best-team-with-no-conflicts', {
    t: 'Best Team With No Conflicts: sort by age, then non-decreasing scores',
    r: 'Sort by (age, score). A team is valid if scores never decrease along that order. dp[i] = score[i] + best dp[j] with j < i and score[j] ≤ score[i].',
    g: R => { const n = R.int(4, 6); return { scores: R.ints(n, 1, 9), ages: R.ints(n, 1, 4) }; },
    s(I, T) { const P = I.scores.map((s, i) => [I.ages[i], s]).sort((a, b) => a[0] - b[0] || a[1] - b[1]), dp = []; P.forEach(([a, s], i) => { let b = s; for (let j = 0; j < i; j++) if (P[j][1] <= s) b = Math.max(b, dp[j] + s); T.at({ players: A(P.map(p => `age ${p[0]}: ${p[1]}`), { hl: [i] }), dp: A(dp.concat('?')) }); T.n(`dp[${i}]?`, b, 'Best earlier dp with score ≤ this one, plus this score.'); dp.push(b); }); return Math.max(...dp); }
  });

  D('count-substrings-that-differ-by-one-character', {
    t: 'Count Substrings That Differ by One Character: grow around each mismatch',
    r: 'For each mismatched pair (s[i], t[j]), count equal letters extending left (L) and right (R). That mismatch is the single difference in (L + 1)·(R + 1) substring pairs.',
    g: R => ({ s: R.str(R.int(2, 3), 'ab'), t: R.str(R.int(2, 3), 'ab') }),
    s(I, T) { const s = I.s, t = I.t; let tot = 0; for (let i = 0; i < s.length; i++) for (let j = 0; j < t.length; j++) if (s[i] !== t[j]) { let l = 0, r = 0; while (i - l - 1 >= 0 && j - l - 1 >= 0 && s[i - l - 1] === t[j - l - 1]) l++; while (i + r + 1 < s.length && j + r + 1 < t.length && s[i + r + 1] === t[j + r + 1]) r++; T.at({ s: A([...s], { hl: [i] }), t: A([...t], { hl: [j] }), total: tot }); T.n(`Mismatch s[${i}] vs t[${j}]: how many pairs?`, (l + 1) * (r + 1), `(${l} + 1)·(${r} + 1).`); tot += (l + 1) * (r + 1); } return tot; }
  });

  D('number-of-ways-to-form-a-target-string-given-a-dictionary', {
    t: 'Number of Ways to Form a Target: letter counts per column',
    r: 'cnt[k][c] = words with letter c at column k. dp[i][k] = ways to form target[0..i) using columns before k = dp[i][k−1] + dp[i−1][k−1]·cnt[k−1][target[i−1]].',
    g: R => { const L = R.int(3, 4); return { words: Array.from({ length: R.int(2, 3) }, () => R.str(L, 'ab')), target: R.str(R.int(2, 3), 'ab') }; },
    s(I, T) {
      const W = I.words, L = W[0].length, t = I.target, cnt = [...Array(L).keys()].map(k => { const m = {}; W.forEach(w => m[w[k]] = (m[w[k]] || 0) + 1); return m; });
      let dp = Array(t.length + 1).fill(0); dp[0] = 1;
      for (let k = 0; k < L; k++) { for (let i = t.length; i >= 1; i--) dp[i] = (dp[i] + dp[i - 1] * (cnt[k][t[i - 1]] || 0)) % MOD; T.at({ words: G(W.map(w => [...w]), { hl: W.map((_, r) => [r, k]) }), target: t, dp: A(dp) }); T.n(`After column ${k}: ways to form the whole target?`, dp[t.length], 'dp[i] += dp[i−1] · (count of target[i−1] in this column).'); }
      return dp[t.length];
    }
  });

  D('count-sorted-vowel-strings', {
    t: 'Count Sorted Vowel Strings: how many end with each vowel',
    r: 'cnt[v] = sorted strings ending in vowel v. Next length: new cnt[v] = Σ cnt[u] for u ≤ v (a running prefix sum).',
    g: R => ({ n: R.int(2, 5) }),
    s(I, T) { let c = [1, 1, 1, 1, 1]; for (let l = 2; l <= I.n; l++) { const nx = []; c.reduce((s, x, i) => (nx[i] = s + x, s + x), 0); T.at({ ends: A(c, { labels: [...'aeiou'] }) }); T.n(`Length ${l}: strings ending in "u"?`, nx[4], 'Prefix sum over every vowel ≤ u.'); c = nx; } return c.reduce((a, b) => a + b, 0); }
  });

  D('minimum-deletions-to-make-string-balanced', {
    t: 'Minimum Deletions to Make String Balanced: delete this a or every earlier b',
    r: 'Scan with bCount. On "b": bCount++. On "a": del = min(del + 1, bCount).',
    g: R => ({ s: R.str(R.int(6, 8), 'ab') }),
    s(I, T) { let b = 0, d = 0; [...I.s].forEach((c, i) => { if (c === 'b') b++; else { const v = Math.min(d + 1, b); T.at({ s: A([...I.s], { hl: [i] }), b, del: d }); T.n(`"a" at ${i}: new deletions?`, v, `min(${d} + 1, ${b}).`); d = v; } }); return d; }
  });

  D('maximize-grid-happiness', {
    t: 'Maximize Grid Happiness: score a placement',
    r: 'Introverts start at 120 and lose 30 per neighbor; extroverts start at 40 and gain 20 per neighbor. Neighbors are the 4 adjacent cells. Search placements for the best total.',
    g: R => ({ m: 2, n: 2, introvertsCount: R.int(0, 2), extrovertsCount: R.int(1, 2) }),
    s(I, T) {
      const { m, n } = I, N = m * n, score = g => { let s = 0; for (let i = 0; i < N; i++) if (g[i]) { const r = Math.floor(i / n), c = i % n; let nb = 0; for (const [dr, dc] of [[1, 0], [-1, 0], [0, 1], [0, -1]]) { const x = r + dr, y = c + dc; if (x >= 0 && y >= 0 && x < m && y < n && g[x * n + y]) nb++; } s += g[i] === 1 ? 120 - 30 * nb : 40 + 20 * nb; } return s; };
      let best = 0; const g = Array(N).fill(0), rec = (i, a, b) => { if (i === N) { best = Math.max(best, score(g)); return; } rec(i + 1, a, b); if (a) { g[i] = 1; rec(i + 1, a - 1, b); g[i] = 0; } if (b) { g[i] = 2; rec(i + 1, a, b - 1); g[i] = 0; } }; rec(0, I.introvertsCount, I.extrovertsCount);
      for (let t = 0; t < 2; t++) { const p = Array(N).fill(0); let a = I.introvertsCount, b = I.extrovertsCount; for (let i = 0; i < N; i++) { const r = (i * 7 + t * 3 + a + b) % 3; if (r === 1 && a) { p[i] = 1; a--; } else if (r === 2 && b) { p[i] = 2; b--; } } T.at({ grid: G([...Array(m).keys()].map(r => p.slice(r * n, r * n + n).map(x => ['.', 'I', 'E'][x]))) }); T.n('Total happiness of this placement?', score(p), 'I: 120 − 30·neighbors, E: 40 + 20·neighbors.'); }
      T.at({ m, n, introverts: I.introvertsCount, extroverts: I.extrovertsCount }); T.n('Best possible total happiness?', best, 'Search every placement (memoized row profiles in the full solution).');
      return best;
    }
  });

  D('minimum-number-of-removals-to-make-mountain-array', {
    t: 'Minimum Removals to Make Mountain Array: LIS in, LDS out',
    r: 'inc[i] = LIS ending at i; dec[i] = longest decreasing run starting at i (LIS from the right). A peak needs both > 1. Removals = n − max(inc + dec − 1).',
    g: R => ({ nums: R.ints(R.int(5, 7), 1, 8).map((x, i, a) => i === 2 ? 9 : x) }),
    s(I, T) { const a = I.nums, n = a.length, inc = Array(n).fill(1), dec = Array(n).fill(1); for (let i = 0; i < n; i++) for (let j = 0; j < i; j++) if (a[j] < a[i]) inc[i] = Math.max(inc[i], inc[j] + 1); for (let i = n - 1; i >= 0; i--) for (let j = n - 1; j > i; j--) if (a[j] < a[i]) dec[i] = Math.max(dec[i], dec[j] + 1); let best = 0; for (let i = 1; i < n - 1; i++) if (inc[i] > 1 && dec[i] > 1) { T.at({ nums: A(a, { hl: [i] }), inc: A(inc), dec: A(dec) }); T.n(`Mountain length with peak at ${i}?`, inc[i] + dec[i] - 1, `${inc[i]} + ${dec[i]} − 1.`); best = Math.max(best, inc[i] + dec[i] - 1); } return n - best; }
  });

  D('minimum-incompatibility', {
    t: 'Minimum Incompatibility: bitmask over used numbers',
    r: 'Split into k groups of size n/k, each with distinct values; a group\'s incompatibility is max − min. dp[mask] = best for the used numbers, always placing the lowest unused index in the next group.',
    g: R => { const k = R.int(2, 3), sz = 2; return { nums: R.ints(k * sz, 1, k * sz), k }; },
    s(I, T) {
      const a = I.nums, n = a.length, sz = n / I.k, full = (1 << n) - 1, inc = new Map();
      for (let m = 1; m <= full; m++) if (pc(m) === sz) { const v = a.filter((_, i) => m >> i & 1); if (new Set(v).size === sz) inc.set(m, Math.max(...v) - Math.min(...v)); }
      const cnt = {}; a.forEach(x => cnt[x] = (cnt[x] || 0) + 1); const ok = Math.max(...Object.values(cnt)) <= I.k;
      T.at({ nums: A(a), k: I.k }); T.n('Size of each group?', sz, 'n divided by k.'); T.yn(`Can ${n} numbers split into ${I.k} groups of distinct values?`, ok, `No value may appear more than ${I.k} times.`); if (!ok) { T.n('Answer?', -1, 'Impossible, so the answer is −1.'); return -1; }
      const memo = new Map(), f = m => { if (m === full) return 0; if (memo.has(m)) return memo.get(m); let low = 0; while (m >> low & 1) low++; let b = Infinity; for (const [g, c] of inc) if ((g & m) === 0 && (g >> low & 1)) b = Math.min(b, c + f(m | g)); memo.set(m, b); return b; };
      const ans = f(0); T.n('Minimum total incompatibility?', ans, 'Bitmask DP over the groups.'); return ans;
    }
  });
})();
