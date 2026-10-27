/* v2 games: dynamic programming (11). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const sqf = x => { const P = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29]; let m = 0; for (let i = 0; i < 10; i++) if (x % P[i] === 0) { if (x % (P[i] * P[i]) === 0) return -1; m |= 1 << i; } return m; };

  D('number-of-subarrays-having-even-product', {
    t: 'Number of Subarrays Having Even Product: remember the last even number',
    r: 'A subarray ending at i has an even product exactly when it contains an even number. If the last even index is e, there are e + 1 such subarrays ending at i.',
    g: R => ({ nums: R.ints(R.int(4, 7), 1, 9) }),
    s(I, T) { let e = -1, tot = 0; I.nums.forEach((x, i) => { if (x % 2 === 0) e = i; T.at({ nums: A(I.nums, { hl: [i] }), lastEven: e, total: tot }); T.n(`Even-product subarrays ending at ${i}?`, e + 1, `Any start up to the last even index ${e}.`); tot += e + 1; }); return tot; }
  });

  D('longest-square-streak-in-an-array', {
    t: 'Longest Square Streak: chain each value to its square root',
    r: 'Sort the distinct values. streak[x] = streak[√x] + 1 if √x is an integer in the set, else 1. Answer: longest streak if at least 2, else −1.',
    g: R => ({ nums: R.shuffle([2, 4, 16, 3, 9, 5, 25, 6, 8, 7].slice(0, R.int(5, 8))) }),
    s(I, T) { const v = [...new Set(I.nums)].sort((a, b) => a - b), st = new Map(); let best = 0; for (const x of v) { const r = Math.round(Math.sqrt(x)), s = r * r === x && st.has(r) ? st.get(r) + 1 : 1; T.at({ sorted: A(v, { hl: [v.indexOf(x)] }), streaks: K([...st].map(([a, b]) => [String(a), b])) }); T.n(`Streak ending at ${x}?`, s, r * r === x && st.has(r) ? `${x} = ${r}²: extend ${r}'s streak.` : 'No square root in the set.'); st.set(x, s); best = Math.max(best, s); } return best >= 2 ? best : -1; }
  });

  D('check-if-there-is-a-path-with-equal-number-of-0s-and-1s', {
    t: 'Path With Equal 0s and 1s: min and max ones per cell',
    r: 'The path has m + n − 1 cells, which must be even. Track the fewest and most 1s on any path to each cell; every count in between is achievable. Check that half the length lies in [min, max] at the end.',
    g: R => ({ grid: R.grid(R.int(2, 3), R.int(2, 4), 0, 1) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, L = m + n - 1; T.at({ grid: G(g) }); T.yn(`Is the path length ${L} even?`, L % 2 === 0, 'Equal counts need an even length.'); if (L % 2) return false; const lo = mk(m, n, 0), hi = mk(m, n, 0); for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) { const p = []; if (r) p.push([lo[r - 1][c], hi[r - 1][c]]); if (c) p.push([lo[r][c - 1], hi[r][c - 1]]); lo[r][c] = (p.length ? Math.min(...p.map(x => x[0])) : 0) + g[r][c]; hi[r][c] = (p.length ? Math.max(...p.map(x => x[1])) : 0) + g[r][c]; } T.n('Fewest 1s on a path to the end?', lo[m - 1][n - 1], 'Min from above or left plus this cell.'); T.n('Most 1s on a path to the end?', hi[m - 1][n - 1], 'Max from above or left plus this cell.'); return lo[m - 1][n - 1] <= L / 2 && L / 2 <= hi[m - 1][n - 1]; }
  });

  D('number-of-great-partitions', {
    t: 'Number of Great Partitions: subtract the bad ones',
    r: 'If total < 2k, nothing works. Otherwise a partition is bad if one group sums to < k. Count subsets with sum < k (knapsack); answer = 2 to the power n − 2 times that count.',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 6), k: R.int(2, 6) }),
    s(I, T) { const S = I.nums.reduce((a, b) => a + b, 0); T.at({ nums: A(I.nums), k: I.k }); T.yn(`Is the total ${S} at least 2k = ${2 * I.k}?`, S >= 2 * I.k, 'Both groups need at least k.'); if (S < 2 * I.k) return 0; const dp = Array(I.k).fill(0); dp[0] = 1; I.nums.forEach((x, i) => { for (let s = I.k - 1; s >= x; s--) dp[s] = (dp[s] + dp[s - x]) % MOD; T.at({ nums: A(I.nums, { hl: [i] }), 'sums < k': A(dp) }); T.n(`After ${x}: subsets with sum < ${I.k}?`, dp.reduce((a, b) => (a + b) % MOD, 0), 'Knapsack counts below k.'); }); let p = 1; for (let i = 0; i < I.nums.length; i++) p = p * 2 % MOD; return ((p - 2 * dp.reduce((a, b) => (a + b) % MOD, 0)) % MOD + MOD) % MOD; }
  });

  D('partition-string-into-substrings-with-values-at-most-k', {
    t: 'Partition String Into Values at most k: extend while it fits',
    r: 'Greedy: keep appending digits to the current piece while its value stays at most k; otherwise start a new piece. A single digit > k makes it impossible.',
    g: R => ({ s: R.str(R.int(5, 7), '123456789'), k: R.int(5, 70) }),
    s(I, T) { let cur = 0, cnt = 1; for (let i = 0; i < I.s.length; i++) { const d = +I.s[i]; if (d > I.k) { T.at({ s: A([...I.s], { hl: [i] }), k: I.k }); T.yn(`Digit ${d} alone exceeds k. Is a good partition possible?`, false, '−1.'); return -1; } const nv = cur * 10 + d, ext = nv <= I.k; T.at({ s: A([...I.s], { hl: [i] }), current: cur, k: I.k }); T.yn(`Append ${d} to the current piece (${cur})?`, ext, ext ? `${nv} at most ${I.k}.` : `${nv} > ${I.k}: start a new piece.`); if (ext) cur = nv; else { cur = d; cnt++; } } return cnt; }
  });

  D('number-of-good-binary-strings', {
    t: 'Number of Good Binary Strings: append a whole block',
    r: 'Each block of 1s has a length multiple of oneGroup, each block of 0s a multiple of zeroGroup, so build by appending oneGroup ones or zeroGroup zeros: dp[l] = dp[l − oneGroup] + dp[l − zeroGroup]. Sum over min to max length.',
    g: R => { const mn = R.int(2, 5); return { minLength: mn, maxLength: mn + R.int(0, 2), oneGroup: R.int(1, 2), zeroGroup: R.int(1, 3) }; },
    s(I, T) { const dp = [1]; let tot = 0; for (let l = 1; l <= I.maxLength; l++) { const v = ((l >= I.oneGroup ? dp[l - I.oneGroup] : 0) + (l >= I.zeroGroup ? dp[l - I.zeroGroup] : 0)) % MOD; T.at({ dp: A(dp.concat('?')), oneGroup: I.oneGroup, zeroGroup: I.zeroGroup }); T.n(`dp[${l}]?`, v, `dp[${l} − ${I.oneGroup}] + dp[${l} − ${I.zeroGroup}].`); dp.push(v); if (l >= I.minLength) tot = (tot + v) % MOD; } return tot; }
  });

  D('minimum-cost-to-split-an-array', {
    t: 'Minimum Cost to Split an Array: k plus the repeated elements',
    r: 'importance(sub) = k + (number of elements whose value repeats in sub). dp[i] = min over j of dp[j] + importance(nums[j to i−1]), growing j leftward while counting repeats.',
    g: R => ({ nums: R.ints(R.int(4, 6), 0, 3), k: R.int(1, 4) }),
    s(I, T) { const a = I.nums, n = a.length, dp = [0]; for (let i = 1; i <= n; i++) { let b = Infinity; const cnt = {}; let tr = 0; for (let j = i - 1; j >= 0; j--) { cnt[a[j]] = (cnt[a[j]] || 0) + 1; if (cnt[a[j]] === 2) tr += 2; else if (cnt[a[j]] > 2) tr++; b = Math.min(b, dp[j] + I.k + tr); } T.at({ nums: A(a, { hl: [i - 1] }), dp: A(dp.concat('?')), k: I.k }); T.n(`dp[${i}]?`, b, 'Best last piece: dp[j] + k + repeated count.'); dp.push(b); } return dp[n]; }
  });

  D('count-increasing-quadruplets', {
    t: 'Count Increasing Quadruplets: fix the middle pair (j, k)',
    r: 'For i < j < k < l we need nums[i] < nums[k] < nums[j] < nums[l]. For each j < k with nums[k] < nums[j]: (count of i < j with nums[i] < nums[k]) times (count of l > k with nums[l] > nums[j]).',
    g: R => ({ nums: R.perm(R.int(5, 6)).map(x => x + 1) }),
    s(I, T) { const a = I.nums, n = a.length; let tot = 0; for (let j = 1; j < n - 2; j++) for (let k = j + 1; k < n - 1; k++) if (a[k] < a[j]) { let L = 0, Rr = 0; for (let i = 0; i < j; i++) if (a[i] < a[k]) L++; for (let l = k + 1; l < n; l++) if (a[l] > a[j]) Rr++; T.at({ nums: A(a, { hl: [j, k] }), total: tot }); T.n(`Middle pair (j=${j}, k=${k}): quadruplets?`, L * Rr, `${L} valid i times ${Rr} valid l.`); tot += L * Rr; } return tot; }
  });

  D('minimum-operations-to-reduce-an-integer-to-0', {
    t: 'Minimum Operations to Reduce an Integer to 0: runs of ones',
    r: 'Look at the low bits. If the lowest two bits are 11, add 1 (merges a run of ones); if only the lowest bit is 1, subtract 1. Each add or subtract is one operation; then shift right.',
    g: R => ({ n: R.int(5, 120) }),
    s(I, T) { let n = I.n, ops = 0; while (n > 0) { let act; if ((n & 3) === 3) act = 'add 1'; else if (n & 1) act = 'subtract 1'; else act = 'shift'; T.at({ n, binary: n.toString(2), ops }); T.c(`n = ${n} (${n.toString(2)}): next move?`, ['add 1', 'subtract 1', 'shift'], act, act === 'add 1' ? 'Low bits 11: adding carries through the run.' : act === 'subtract 1' ? 'A lone low 1: remove it.' : 'Low bit is 0: move on.'); if (act === 'add 1') { n++; ops++; } else if (act === 'subtract 1') { n--; ops++; } else n >>= 1; if (n === 1) { ops++; n = 0; } } return ops; }
  });

  D('count-the-number-of-square-free-subsets', {
    t: 'Count Square-Free Subsets: prime masks must be disjoint',
    r: 'A usable value is square-free (a prime mask). dp[mask] = subsets whose product uses exactly these primes. Each element joins a subset if its mask is disjoint. Answer: every non-empty subset counted.',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 10) }),
    s(I, T) { let dp = new Map([[0, 1]]); I.nums.forEach((x, i) => { const m = sqf(x); T.at({ nums: A(I.nums, { hl: [i] }) }); T.yn(`Is ${x} square-free?`, m >= 0, m >= 0 ? 'No squared prime divides it.' : 'A squared prime divides it: never usable.'); if (m < 0) return; const nx = new Map(dp); for (const [k, v] of dp) if (!(k & m)) nx.set(k | m, ((nx.get(k | m) || 0) + v) % MOD); dp = nx; }); let t = 0; for (const v of dp.values()) t = (t + v) % MOD; return (t - 1 + MOD) % MOD; }
  });

  D('number-of-ways-to-earn-points', {
    t: 'Number of Ways to Earn Points: bounded knapsack per type',
    r: 'dp[s] = ways to score s with the types so far. For each type (count, marks), take 0 to count questions: new[s] = the sum of dp[s − t times marks].',
    g: R => ({ target: R.int(3, 8), types: Array.from({ length: R.int(2, 3) }, () => [R.int(1, 3), R.int(1, 3)]) }),
    s(I, T) { let dp = Array(I.target + 1).fill(0); dp[0] = 1; I.types.forEach(([c, m], i) => { const nx = Array(I.target + 1).fill(0); for (let s = 0; s <= I.target; s++) for (let t = 0; t <= c && t * m <= s; t++) nx[s] = (nx[s] + dp[s - t * m]) % MOD; dp = nx; T.at({ type: `${c} questions times ${m} marks`, target: I.target }); T.n(`After type ${i}: ways to score exactly ${I.target}?`, dp[I.target], 'Take 0 to count of this type.'); }); return dp[I.target]; }
  });

  D('find-the-substring-with-maximum-cost', {
    t: 'Find the Substring With Maximum Cost: Kadane on letter values',
    r: 'Letter value: vals[k] if it is chars[k], else its alphabet position. Kadane with the empty substring allowed (cost 0).',
    g: R => ({ s: R.str(R.int(4, 6), 'abcd'), chars: 'bd', vals: [R.int(-5, 2), R.int(-5, 2)] }),
    s(I, T) { const val = c => { const k = I.chars.indexOf(c); return k >= 0 ? I.vals[k] : c.charCodeAt(0) - 96; }; let cur = 0, best = 0; [...I.s].forEach((c, i) => { cur = Math.max(0, cur + val(c)); T.at({ s: A([...I.s], { hl: [i] }), values: A([...I.s].map(val)), best }); T.n(`Best cost of a substring ending at ${i} (0 = empty)?`, cur, `max(0, previous + ${val(c)}).`); best = Math.max(best, cur); }); return best; }
  });

  D('minimize-the-maximum-difference-of-pairs', {
    t: 'Minimize the Maximum Difference of Pairs: binary search + greedy pairing',
    r: 'Sort. For a candidate d, greedily pair neighbors with difference at most d (skip both when paired). If you get at least p pairs, d works. Binary search the smallest d.',
    g: R => { const nums = R.ints(R.int(4, 6), 0, 12); return { nums, p: R.int(1, Math.floor(nums.length / 2)) }; },
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), ok = d => { let c = 0; for (let i = 0; i + 1 < a.length; i++) if (a[i + 1] - a[i] <= d) { c++; i++; } return c >= I.p; }; let lo = 0, hi = a[a.length - 1] - a[0]; while (lo < hi) { const m = (lo + hi) >> 1; T.at({ sorted: A(a), lo, hi, p: I.p }); T.yn(`Can we form ${I.p} pairs with max difference at most ${m}?`, ok(m), 'Greedy: pair adjacent sorted values when close enough.'); if (ok(m)) hi = m; else lo = m + 1; } return lo; }
  });

  D('count-the-number-of-k-free-subsets', {
    t: 'Count k-Free Subsets: independent chains, Fibonacci each',
    r: 'Values only conflict within the same residue mod k, and only neighbors differing by exactly k. Split sorted values into chains of consecutive +k steps; a chain of length L has Fib(L + 2) independent subsets. Multiply.',
    g: R => ({ nums: R.distinct(R.int(3, 6), 1, 15), k: R.int(1, 4) }),
    s(I, T) { const s = I.nums.slice().sort((a, b) => a - b), used = new Set(); let tot = 1; for (const x of s) { if (used.has(x)) continue; let L = 0, y = x; while (s.includes(y)) { used.add(y); L++; y += I.k; } let a = 1, b = 2; for (let i = 1; i < L; i++) [a, b] = [b, a + b]; T.at({ sorted: A(s), k: I.k, chain: `${x}…${x + (L - 1) * I.k}` }); T.n(`Chain starting at ${x} (length ${L}): independent subsets?`, b, 'No two consecutive members: a Fibonacci count.'); tot *= b; } return tot; }
  });

  D('minimum-additions-to-make-valid-string', {
    t: 'Minimum Additions to Make a Valid String: count abc groups',
    r: 'A new "abc" group starts whenever a letter is not strictly after the previous one. With g groups, the final length is 3g: add 3g − length letters.',
    g: R => ({ word: R.str(R.int(3, 6), 'abc') }),
    s(I, T) { let g = 1; for (let i = 1; i < I.word.length; i++) { const nw = I.word[i] <= I.word[i - 1]; T.at({ word: A([...I.word], { hl: [i - 1, i] }), groups: g }); T.yn(`Does "${I.word[i]}" start a new abc group?`, nw, nw ? 'It does not come after the previous letter.' : 'It continues the current group.'); if (nw) g++; } T.at({ word: I.word, groups: g }); T.n('Letters to insert?', 3 * g - I.word.length, `3 times ${g} − ${I.word.length}.`); return 3 * g - I.word.length; }
  });

  D('power-of-heroes', {
    t: 'Power of Heroes: each value as the maximum',
    r: 'Sort. With x as the group maximum, the minimum ranges over earlier values: x² times (x + s), where s = the sum of nums[j] times 2 to the power (i−j−1) over j < i, updated as s = 2s + previous value.',
    g: R => ({ nums: R.ints(R.int(2, 4), 1, 5) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let s = 0, tot = 0; a.forEach((x, i) => { const c = x * x * (x + s); T.at({ sorted: A(a, { hl: [i] }), s }); T.n(`Power from groups whose max is ${x} (index ${i})?`, c % MOD, `${x}² times (${x} + ${s}).`); tot = (tot + c) % MOD; s = 2 * s + x; }); return tot; }
  });

  D('maximum-number-of-moves-in-a-grid', {
    t: 'Maximum Number of Moves in a Grid: reachable cells column by column',
    r: 'Start on every first-column cell. A cell in the next column is reachable from up-right, right, or down-right moves into a strictly larger value. The answer is the last column with any reachable cell.',
    g: R => ({ grid: R.grid(R.int(3, 4), R.int(3, 5), 1, 9) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; let reach = g.map(() => true); for (let c = 1; c < n; c++) { const nx = g.map((row, r) => [-1, 0, 1].some(d => r + d >= 0 && r + d < m && reach[r + d] && g[r + d][c - 1] < row[c])); T.at({ grid: G(g, { hl: reach.map((v, r) => v ? [r, c - 1] : null).filter(Boolean) }) }); T.n(`Reachable cells in column ${c}?`, nx.filter(Boolean).length, 'From a reachable neighbor in the previous column, into a larger value.'); if (!nx.some(Boolean)) return c - 1; reach = nx; } return n - 1; }
  });

  D('minimum-cost-to-make-all-characters-equal', {
    t: 'Minimum Cost to Make All Characters Equal: fix each boundary',
    r: 'Every place where s[i] not equal to s[i−1] must be fixed once: flip the prefix (cost i) or the suffix (cost n − i). Sum min(i, n − i).',
    g: R => ({ s: R.str(R.int(4, 7), '01') }),
    s(I, T) { const s = I.s, n = s.length; let tot = 0; for (let i = 1; i < n; i++) if (s[i] !== s[i - 1]) { T.at({ s: A([...s], { hl: [i - 1, i] }), total: tot }); T.n(`Boundary before index ${i}: cost to fix?`, Math.min(i, n - i), `min(prefix ${i}, suffix ${n - i}).`); tot += Math.min(i, n - i); } return tot; }
  });

  D('maximum-strictly-increasing-cells-in-a-matrix', {
    t: 'Max Strictly Increasing Cells: process values in order, best per row and column',
    r: 'Sort cells by value. A cell\'s best path = 1 + max(bestRow[r], bestCol[c]) from strictly smaller values. Update rows or columns only after the whole group of equal values is computed.',
    g: R => ({ mat: R.grid(R.int(2, 3), R.int(2, 3), 1, 6) }),
    s(I, T) { const g = I.mat, cells = []; g.forEach((row, r) => row.forEach((v, c) => cells.push([v, r, c]))); cells.sort((a, b) => a[0] - b[0]); const rb = Array(g.length).fill(0), cb = Array(g[0].length).fill(0); let best = 0, i = 0; while (i < cells.length) { let j = i; while (j < cells.length && cells[j][0] === cells[i][0]) j++; const res = cells.slice(i, j).map(([v, r, c]) => 1 + Math.max(rb[r], cb[c])); cells.slice(i, j).forEach(([v, r, c], k) => { T.at({ mat: G(g, { hl: [[r, c]] }), rowBest: A(rb), colBest: A(cb) }); T.n(`Longest path ending at (${r},${c}) (value ${v})?`, res[k], '1 + best of its row and column among smaller values.'); }); cells.slice(i, j).forEach(([v, r, c], k) => { rb[r] = Math.max(rb[r], res[k]); cb[c] = Math.max(cb[c], res[k]); best = Math.max(best, res[k]); }); i = j; } return best; }
  });

  D('count-of-integers', {
    t: 'Count of Integers: digit DP with a digit-sum window',
    r: 'count(N) = numbers in [0, N] with min_sum at most digit sum at most max_sum, by digit DP (position, sum, tight). Answer = count(num2) − count(num1) + (num1 is good).',
    g: R => { const a = R.int(1, 30); return { num1: String(a), num2: String(a + R.int(5, 40)), min_sum: R.int(1, 4), max_sum: R.int(4, 9) }; },
    s(I, T) {
      const cnt = N => { const memo = new Map(), f = (i, s, t) => { if (s > I.max_sum) return 0; if (i === N.length) return s >= I.min_sum ? 1 : 0; const k = i * 1e4 + s * 2 + (t ? 1 : 0); if (memo.has(k)) return memo.get(k); let r = 0; const hi = t ? +N[i] : 9; for (let d = 0; d <= hi; d++) r = (r + f(i + 1, s + d, t && d === hi)) % MOD; memo.set(k, r); return r; }; return f(0, 0, true); };
      const ds = x => [...x].reduce((s, c) => s + +c, 0), good = ds(I.num1) >= I.min_sum && ds(I.num1) <= I.max_sum, a = cnt(I.num2), b = cnt(I.num1);
      T.at({ num1: I.num1, num2: I.num2, window: `${I.min_sum}..${I.max_sum}` }); T.n(`Good numbers in [0, ${I.num2}]?`, a, 'Digit DP on num2.'); T.n(`Good numbers in [0, ${I.num1}]?`, b, 'Digit DP on num1.'); T.yn(`Is ${I.num1} itself good?`, good, `Its digit sum is ${ds(I.num1)}.`);
      return ((a - b + (good ? 1 : 0)) % MOD + MOD) % MOD;
    }
  });

  D('special-permutations', {
    t: 'Special Permutations: bitmask with the last element',
    r: 'dp[mask][last] = orderings of the elements in mask ending in last, where every neighbor pair divides one way. Extend with next if next % last == 0 or last % next == 0.',
    g: R => ({ nums: R.distinct(R.int(3, 4), 1, 12) }),
    s(I, T) { const a = I.nums, n = a.length, ok = (x, y) => x % y === 0 || y % x === 0, full = (1 << n) - 1, dp = mk(1 << n, n, 0); for (let i = 0; i < n; i++) dp[1 << i][i] = 1; for (let m = 1; m <= full; m++) for (let l = 0; l < n; l++) if (dp[m][l]) for (let j = 0; j < n; j++) if (!(m >> j & 1) && ok(a[l], a[j])) dp[m | 1 << j][j] = (dp[m | 1 << j][j] + dp[m][l]) % MOD; for (let l = 0; l < n; l++) { T.at({ nums: A(a, { hl: [l] }) }); T.n(`Special permutations ending with ${a[l]}?`, dp[full][l], 'dp[full mask][last].'); } return dp[full].reduce((x, y) => (x + y) % MOD, 0); }
  });

  D('painting-the-walls', {
    t: 'Painting the Walls: the paid painter buys time',
    r: 'While the paid painter spends time[i] on wall i, the free painter paints time[i] other walls. So paying for wall i covers time[i] + 1 walls. dp[j] = least cost to cover j walls (0-1 knapsack, capped at n).',
    g: R => { const n = R.int(3, 5); return { cost: R.ints(n, 1, 9), time: R.ints(n, 1, 3) }; },
    s(I, T) { const n = I.cost.length, dp = Array(n + 1).fill(Infinity); dp[0] = 0; I.cost.forEach((c, i) => { for (let j = n; j >= 1; j--) dp[j] = Math.min(dp[j], dp[Math.max(0, j - I.time[i] - 1)] + c); T.at({ wall: `cost ${c}, covers ${I.time[i] + 1}`, dp: A(dp.map(v => v === Infinity ? '∞' : v)) }); T.n(`After wall ${i}: least cost to cover all ${n} walls (inf if not yet)?`, dp[n], 'Pay for it or not.'); }); return dp[n]; }
  });

  D('decremental-string-concatenation', {
    t: 'Decremental String Concatenation: only the ends matter',
    r: 'State: (first letter, last letter) of the joined string, mapped to the least length. Add each word on the right or the left; a matching boundary letter saves 1.',
    g: R => ({ words: Array.from({ length: R.int(2, 4) }, () => R.str(R.int(1, 3), 'ab')) }),
    s(I, T) { const w = I.words; let dp = new Map([[w[0][0] + w[0].slice(-1), w[0].length]]); for (let i = 1; i < w.length; i++) { const x = w[i], nx = new Map(), up = (k, v) => { if (!nx.has(k) || nx.get(k) > v) nx.set(k, v); }; for (const [k, v] of dp) { up(k[0] + x.slice(-1), v + x.length - (k[1] === x[0] ? 1 : 0)); up(x[0] + k[1], v + x.length - (x.slice(-1) === k[0] ? 1 : 0)); } dp = nx; T.at({ words: A(w, { hl: [i] }), states: K([...dp]) }); T.n(`After word ${i}: shortest total length?`, Math.min(...dp.values()), 'Join on either side; a shared boundary letter saves 1.'); } return Math.min(...dp.values()); }
  });

  D('ways-to-split-array-into-good-subarrays', {
    t: 'Ways to Split Into Good Subarrays: multiply the gaps',
    r: 'Each subarray holds exactly one 1. Between consecutive 1s at positions p and q, the cut can go in q − p places. Multiply those; 0 if there are no 1s.',
    g: R => ({ nums: Array.from({ length: R.int(5, 8) }, () => R.chance(0.35) ? 1 : 0) }),
    s(I, T) { const ones = I.nums.map((x, i) => x ? i : -1).filter(i => i >= 0); T.at({ nums: A(I.nums) }); if (!ones.length) { T.yn('Is any split possible?', false, 'No 1 at all.'); return 0; } let r = 1; for (let k = 1; k < ones.length; k++) { T.at({ nums: A(I.nums, { hl: [ones[k - 1], ones[k]] }), ways: r }); T.n(`Places to cut between the 1s at ${ones[k - 1]} and ${ones[k]}?`, ones[k] - ones[k - 1], 'Any boundary between them.'); r = r * (ones[k] - ones[k - 1]) % MOD; } return r; }
  });

  D('maximum-number-of-jumps-to-reach-the-last-index', {
    t: 'Maximum Number of Jumps: longest chain of allowed jumps',
    r: 'dp[j] = most jumps to reach j = max over i < j with |nums[j] − nums[i]| at most target of dp[i] + 1 (unreachable stays −∞).',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 8), target: R.int(1, 3) }),
    s(I, T) { const a = I.nums, dp = [0]; for (let j = 1; j < a.length; j++) { let b = -1; for (let i = 0; i < j; i++) if (dp[i] >= 0 && Math.abs(a[j] - a[i]) <= I.target) b = Math.max(b, dp[i] + 1); T.at({ nums: A(a, { hl: [j] }), dp: A(dp.concat('?')), target: I.target }); T.n(`dp[${j}] (−1 if unreachable)?`, b, 'Best reachable i within the target difference, plus one.'); dp.push(b); } return dp[a.length - 1]; }
  });

  D('longest-non-decreasing-subarray-from-two-arrays', {
    t: 'Longest Non-Decreasing Subarray From Two Arrays: two run lengths',
    r: 'd1 divided by d2 = longest run ending at i choosing nums1[i] divided by nums2[i]. Each extends from whichever previous choice is at most the current value.',
    g: R => { const n = R.int(4, 6); return { nums1: R.ints(n, 1, 6), nums2: R.ints(n, 1, 6) }; },
    s(I, T) { const a = I.nums1, b = I.nums2; let d1 = 1, d2 = 1, best = 1; for (let i = 1; i < a.length; i++) { const n1 = 1 + Math.max(a[i - 1] <= a[i] ? d1 : 0, b[i - 1] <= a[i] ? d2 : 0), n2 = 1 + Math.max(a[i - 1] <= b[i] ? d1 : 0, b[i - 1] <= b[i] ? d2 : 0); T.at({ nums1: A(a, { hl: [i] }), nums2: A(b, { hl: [i] }), d1, d2 }); T.n(`Longest run ending at ${i} if you pick nums1[${i}] = ${a[i]}?`, n1, 'Extend from a previous pick that is at most it.'); d1 = n1; d2 = n2; best = Math.max(best, d1, d2); } return best; }
  });

  D('visit-array-positions-to-maximize-score', {
    t: 'Visit Array Positions to Maximize Score: best by parity',
    r: 'best[p] = best score ending on a number of parity p. For x: score = x + max(best[same parity], best[other parity] − x_penalty). Update best[parity of x].',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 9), x: R.int(1, 5) }),
    s(I, T) { const a = I.nums, best = [-Infinity, -Infinity]; best[a[0] % 2] = a[0]; for (let i = 1; i < a.length; i++) { const p = a[i] % 2, v = a[i] + Math.max(best[p], best[1 - p] - I.x); T.at({ nums: A(a, { hl: [i] }), 'best even': best[0] === -Infinity ? '−∞' : best[0], 'best odd': best[1] === -Infinity ? '−∞' : best[1], penalty: I.x }); T.n(`Best score ending at index ${i}?`, v, `${a[i]} + max(same parity, other parity − ${I.x}).`); best[p] = Math.max(best[p], v); } return Math.max(...best); }
  });

  D('ways-to-express-an-integer-as-sum-of-powers', {
    t: 'Ways to Express as Sum of Powers: 0-1 knapsack over i to the power x',
    r: 'Items are 1 to the power x, 2 to the power x, … at most n, each used at most once. dp[s] counts ways to make s; process items with s descending.',
    g: R => ({ n: R.int(4, 30), x: R.int(1, 2) }),
    s(I, T) { const dp = Array(I.n + 1).fill(0); dp[0] = 1; for (let i = 1; i ** I.x <= I.n; i++) { const p = i ** I.x; for (let s = I.n; s >= p; s--) dp[s] = (dp[s] + dp[s - p]) % MOD; T.at({ item: `${i} to the power ${I.x} = ${p}`, n: I.n }); T.n(`Using bases up to ${i}: ways to make ${I.n}?`, dp[I.n], '0-1 knapsack.'); } return dp[I.n]; }
  });

  D('count-stepping-numbers-in-range', {
    t: 'Count Stepping Numbers in Range: neighbors differ by 1',
    r: 'Digit DP over (position, last digit, tight, started): the next digit must be last ± 1. Answer = count(high) − count(low) + (low is stepping).',
    g: R => { const a = R.int(1, 40); return { low: String(a), high: String(a + R.int(5, 60)) }; },
    s(I, T) {
      const cnt = N => { const memo = new Map(), f = (i, last, t, st) => { if (i === N.length) return st ? 1 : 0; const k = [i, last, t, st].join(); if (memo.has(k)) return memo.get(k); let r = 0; const hi = t ? +N[i] : 9; for (let d = 0; d <= hi; d++) { if (st && Math.abs(d - last) !== 1) continue; r = (r + f(i + 1, d, t && d === hi, st || d > 0)) % MOD; } memo.set(k, r); return r; }; return f(0, -1, true, false); };
      const step = s => [...s].every((c, i) => !i || Math.abs(+c - +s[i - 1]) === 1), a = cnt(I.high), b = cnt(I.low);
      T.at({ low: I.low, high: I.high }); T.n(`Stepping numbers in [1, ${I.high}]?`, a, 'Digit DP.'); T.n(`Stepping numbers in [1, ${I.low}]?`, b, 'Digit DP.'); T.yn(`Is ${I.low} a stepping number?`, step(I.low), 'Check its neighbor digits.');
      return ((a - b + (step(I.low) ? 1 : 0)) % MOD + MOD) % MOD;
    }
  });

  D('minimum-time-to-make-array-sum-at-most-x', {
    t: 'Minimum Time to Make Array Sum at most x: reset the slow growers first',
    r: 'Sort by nums2. Resetting index i at second j saves nums1[i] + j times nums2[i]. dp[j] = most saved with j resets. At time t the sum is sum1 + t times sum2 − dp[t]; find the smallest t with that at most x.',
    g: R => { const n = R.int(2, 4); return { nums1: R.ints(n, 1, 6), nums2: R.ints(n, 0, 4), x: R.int(2, 12) }; },
    s(I, T) { const P = I.nums1.map((v, i) => [v, I.nums2[i]]).sort((a, b) => a[1] - b[1]), n = P.length, dp = Array(n + 1).fill(0); for (const [a, b] of P) for (let j = n; j >= 1; j--) dp[j] = Math.max(dp[j], dp[j - 1] + a + j * b); const s1 = I.nums1.reduce((p, q) => p + q, 0), s2 = I.nums2.reduce((p, q) => p + q, 0); for (let t = 0; t <= n; t++) { const v = s1 + t * s2 - dp[t]; T.at({ nums1: A(I.nums1), nums2: A(I.nums2), x: I.x }); T.n(`Smallest possible sum after ${t} seconds?`, v, `${s1} + ${t} times ${s2} − best savings ${dp[t]}.`); if (v <= I.x) return t; } return -1; }
  });

  D('sorting-three-groups', {
    t: 'Sorting Three Groups: longest non-decreasing subsequence of 1s, 2s and 3s',
    r: 'keep[v] = longest non-decreasing subsequence ending with value at most v. For x: keep[x] = max(keep[1 to x]) + 1. Removals = n − max keep.',
    g: R => ({ nums: Array.from({ length: R.int(5, 7) }, () => R.int(1, 3)) }),
    s(I, T) { const k = [0, 0, 0, 0]; I.nums.forEach((x, i) => { const v = Math.max(...k.slice(1, x + 1)) + 1; T.at({ nums: A(I.nums, { hl: [i] }), keep: A(k.slice(1), { labels: ['1', '2', '3'] }) }); T.n(`Longest sorted subsequence ending with this ${x}?`, v, `1 + best ending in a value at most ${x}.`); k[x] = Math.max(k[x], v); }); return I.nums.length - Math.max(...k); }
  });

  D('number-of-beautiful-integers-in-the-range', {
    t: 'Number of Beautiful Integers: even count = odd count, divisible by k',
    r: 'Digit DP over (position, even − odd balance, remainder mod k, tight, started). Here: check each number in the range — equal even or odd digit counts and divisible by k.',
    g: R => { const lo = R.int(10, 60); return { low: lo, high: lo + R.int(4, 12), k: R.int(1, 5) }; },
    s(I, T) { let c = 0; for (let x = I.low; x <= I.high; x++) { const s = String(x), ev = [...s].filter(d => +d % 2 === 0).length, ok = ev * 2 === s.length && x % I.k === 0; T.at({ x, k: I.k }); T.yn(`Is ${x} beautiful?`, ok, `${ev} even, ${s.length - ev} odd digits; ${x} mod ${I.k} = ${x % I.k}.`); if (ok) c++; } return c; }
  });
})();
