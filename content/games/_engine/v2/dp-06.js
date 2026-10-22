/* v2 games: dynamic programming (6). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const r4 = x => Math.round(x * 1e4) / 1e4;

  D('n-th-tribonacci-number', {
    t: 'N-th Tribonacci Number: roll three values forward',
    r: 'T0 = 0, T1 = 1, T2 = 1, then each term is the sum of the previous three.',
    g: R => ({ n: R.int(4, 12) }),
    s(I, T) { const t = [0, 1, 1]; for (let i = 3; i <= I.n; i++) { const v = t[i - 1] + t[i - 2] + t[i - 3]; T.at({ T: A(t.slice(-6)) }); T.n(`T${i}?`, v, `${t[i - 3]} + ${t[i - 2]} + ${t[i - 1]}.`); t.push(v); } return t[I.n]; }
  });

  D('largest-1-bordered-square', {
    t: 'Largest 1-Bordered Square: runs of 1s to the left and up',
    r: 'left[r][c] / up[r][c] = consecutive 1s ending at (r,c). For bottom-right corner (r,c) and size s: need left and up at the corner ≥ s, up at the bottom-left corner ≥ s and left at the top-right corner ≥ s.',
    g: R => ({ grid: R.grid(R.int(3, 4), R.int(3, 4), 0, 1).map(r => r.map(x => R.chance(0.75) ? 1 : x)) }),
    s(I, T) {
      const g = I.grid, m = g.length, n = g[0].length, L = mk(m, n, 0), U = mk(m, n, 0); let best = 0;
      for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (g[r][c]) { L[r][c] = (c ? L[r][c - 1] : 0) + 1; U[r][c] = (r ? U[r - 1][c] : 0) + 1; }
      for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) { let b = 0; for (let s = Math.min(L[r][c], U[r][c]); s > 0; s--) if (U[r][c - s + 1] >= s && L[r - s + 1][c] >= s) { b = s; break; } if (b >= 2 || (r === m - 1 && c === n - 1)) { T.at({ grid: G(g, { hl: [[r, c]] }), best }); T.n(`Largest bordered square with bottom-right corner (${r},${c}): side length?`, b, 'Largest s where all four borders have runs ≥ s.'); } best = Math.max(best, b); }
      return best * best;
    }
  });

  D('stone-game-ii', {
    t: 'Stone Game II: take up to 2M piles',
    r: 'f(i, M) = most stones the player to move can get from piles i..end. Take X piles (1 ≤ X ≤ 2M): suffix(i) − f(i + X, max(M, X)). If 2M covers the rest, take everything.',
    g: R => ({ piles: R.ints(R.int(4, 6), 1, 9) }),
    s(I, T) {
      const p = I.piles, n = p.length, suf = Array(n + 1).fill(0); for (let i = n - 1; i >= 0; i--) suf[i] = suf[i + 1] + p[i]; const memo = new Map();
      const f = (i, M) => { if (i >= n) return 0; if (i + 2 * M >= n) return suf[i]; const k = i * 100 + M; if (memo.has(k)) return memo.get(k); let b = 0; for (let x = 1; x <= 2 * M; x++) b = Math.max(b, suf[i] - f(i + x, Math.max(M, x))); memo.set(k, b); return b; };
      let i = 0, M = 1, who = 0; const got = [0, 0];
      while (i < n) { const opts = [], ok = []; for (let x = 1; x <= Math.min(2 * M, n - i); x++) { opts.push([String(x), `take ${x}`]); if (suf[i] - f(i + x, Math.max(M, x)) === f(i, M)) ok.push(String(x)); }
        T.at({ piles: A(p, { dim: p.map((_, j) => j < i ? j : -1).filter(j => j >= 0) }), M, Alice: got[0], Bob: got[1] }); T.k(`${who ? 'Bob' : 'Alice'} to move (M = ${M}). How many piles (optimal)?`, opts, ok, `The best guaranteed total from here is ${f(i, M)}.`);
        const x = +ok[0]; got[who] += suf[i] - suf[i + x]; i += x; M = Math.max(M, x); who ^= 1; }
      return f(0, 1);
    }
  });

  D('number-of-dice-rolls-with-target-sum', {
    t: 'Number of Dice Rolls With Target Sum: add one die at a time',
    r: 'ways[d][s] = Σ ways[d−1][s − face] over faces 1..k.',
    g: R => ({ n: R.int(2, 3), k: R.int(2, 4), target: R.int(3, 8) }),
    s(I, T) { let w = Array(I.target + 1).fill(0); w[0] = 1; for (let d = 1; d <= I.n; d++) { const nx = Array(I.target + 1).fill(0); for (let s = 1; s <= I.target; s++) for (let f = 1; f <= I.k && f <= s; f++) nx[s] = (nx[s] + w[s - f]) % MOD; T.at({ prev: A(w, { label: `sums with ${d - 1} dice` }), k: I.k }); T.n(`With ${d} dice, ways to total ${Math.min(I.target, d * I.k >= I.target ? I.target : d * I.k)}?`, nx[Math.min(I.target, d * I.k >= I.target ? I.target : d * I.k)], 'Sum the previous row over faces 1..k.'); w = nx; } return w[I.target]; }
  });

  D('shortest-distance-to-target-color', {
    t: 'Shortest Distance to Target Color: nearest on each side',
    r: 'Precompute, for every index and color, the distance to the nearest occurrence on the left and on the right. A query takes the smaller (−1 if the color never appears).',
    g: R => ({ colors: Array.from({ length: R.int(6, 8) }, () => R.int(1, 3)), queries: Array.from({ length: 3 }, () => [R.int(0, 5), R.int(1, 3)]) }),
    s(I, T) { const c = I.colors; return I.queries.map(([i, col]) => { let b = Infinity; c.forEach((x, j) => { if (x === col) b = Math.min(b, Math.abs(i - j)); }); const v = b === Infinity ? -1 : b; T.at({ colors: A(c, { i }) }); T.n(`Nearest color ${col} to index ${i}: distance (−1 if none)?`, v, 'Smaller of the nearest left and nearest right.'); return v; }); }
  });

  D('maximum-subarray-sum-with-one-deletion', {
    t: 'Max Subarray Sum With One Deletion: kept and deleted states',
    r: 'keep = best sum ending here with no deletion (Kadane). del = best ending here with one deletion = max(del + x, keep before this element) (delete x).',
    g: R => ({ arr: R.ints(R.int(5, 7), -6, 6) }),
    s(I, T) { const a = I.arr; let keep = a[0], del = -Infinity, best = a[0]; for (let i = 1; i < a.length; i++) { const nd = Math.max(del + a[i], keep), nk = Math.max(keep + a[i], a[i]); T.at({ arr: A(a, { hl: [i] }), keep, del: del === -Infinity ? '−∞' : del }); T.n(`Best sum ending at ${i} with one deletion used?`, nd, `max(${del === -Infinity ? '−∞' : del} + ${a[i]}, delete it: ${keep}).`); keep = nk; del = nd; best = Math.max(best, keep, del); } return best; }
  });

  D('make-array-strictly-increasing', {
    t: 'Make Array Strictly Increasing: last value → fewest operations',
    r: 'State: map from the last value to the fewest operations. For each arr1[i]: keep it if it exceeds the last value; or replace it with the smallest arr2 value above the last value (+1 op).',
    g: R => ({ arr1: R.ints(R.int(4, 5), 1, 9), arr2: R.distinct(R.int(2, 4), 1, 9) }),
    s(I, T) {
      const b = [...new Set(I.arr2)].sort((x, y) => x - y); let dp = new Map([[-Infinity, 0]]);
      for (let i = 0; i < I.arr1.length; i++) { const x = I.arr1[i], nx = new Map(), up = (k, v) => { if (!nx.has(k) || nx.get(k) > v) nx.set(k, v); };
        for (const [last, ops] of dp) { if (x > last) up(x, ops); const r = b.find(v => v > last); if (r !== undefined) up(r, ops + 1); }
        dp = nx; T.at({ arr1: A(I.arr1, { hl: [i] }), arr2: A(b) }); if (!dp.size) { T.yn('Can the prefix still be made increasing?', false, 'No state survives: −1.'); return -1; }
        T.n(`Fewest operations to make arr1[0..${i}] strictly increasing?`, Math.min(...dp.values()), 'Smallest count over every possible last value.'); }
      return Math.min(...dp.values());
    }
  });

  D('k-concatenation-maximum-sum', {
    t: 'K-Concatenation Maximum Sum: two copies plus the middle',
    r: 'If k = 1, Kadane. Otherwise run Kadane on two copies; if the total sum is positive, add (k − 2) · sum. The empty subarray (0) is allowed.',
    g: R => ({ arr: R.ints(R.int(3, 4), -5, 5), k: R.int(1, 4) }),
    s(I, T) {
      const kad = a => { let c = 0, b = 0; for (const x of a) { c = Math.max(0, c + x); b = Math.max(b, c); } return b; }, S = I.arr.reduce((a, b) => a + b, 0);
      T.at({ arr: A(I.arr), k: I.k }); const one = kad(I.arr); T.n('Kadane on one copy (empty allowed)?', one, 'Best subarray sum, at least 0.'); if (I.k === 1) return one;
      const two = kad(I.arr.concat(I.arr)); T.n('Kadane on two copies?', two, 'Lets the best run wrap across the seam.'); T.n('Sum of one copy?', S, 'Positive totals add a full copy for each middle repetition.');
      return (two + Math.max(0, S) * (I.k - 2)) % MOD;
    }
  });

  D('valid-palindrome-iii', {
    t: 'Valid Palindrome III: deletions = n − longest palindromic subsequence',
    r: 'lps[i][j] = longest palindromic subsequence of s[i..j]. The fewest deletions is n − lps of the whole string; compare with k.',
    g: R => ({ s: R.str(R.int(4, 6), 'abc'), k: R.int(1, 2) }),
    s(I, T) { const s = I.s, n = s.length, dp = mk(n, n, 0); for (let i = n - 1; i >= 0; i--) { dp[i][i] = 1; for (let j = i + 1; j < n; j++) dp[i][j] = s[i] === s[j] ? dp[i + 1][j - 1] + 2 : Math.max(dp[i + 1][j], dp[i][j - 1]); if (i <= 1) { T.at({ s: A([...s], { win: [i, n - 1] }) }); T.n(`Longest palindromic subsequence of "${s.slice(i)}"?`, dp[i][n - 1], 'Equal ends add 2; otherwise drop one end.'); } } T.at({ s: A([...s]), k: I.k }); T.n('Fewest deletions needed?', n - dp[0][n - 1], `${n} − ${dp[0][n - 1]}.`); return n - dp[0][n - 1] <= I.k; }
  });

  D('longest-arithmetic-subsequence-of-given-difference', {
    t: 'Longest Arithmetic Subsequence of Given Difference: chain from x − d',
    r: 'dp[x] = longest chain ending with value x = dp[x − difference] + 1.',
    g: R => ({ arr: R.ints(R.int(6, 8), 1, 8), difference: R.pick([-2, -1, 1, 2]) }),
    s(I, T) { const dp = new Map(); let best = 0; I.arr.forEach((x, i) => { const v = (dp.get(x - I.difference) || 0) + 1; T.at({ arr: A(I.arr, { hl: [i] }), dp: K([...dp].map(([a, b]) => ['ends ' + a, b])) }); T.n(`dp[${x}]?`, v, `dp[${x - I.difference}] + 1.`); dp.set(x, v); best = Math.max(best, v); }); return best; }
  });

  D('count-vowels-permutation', {
    t: 'Count Vowels Permutation: who may come before each vowel?',
    r: 'Rules: a→e, e→a|i, i→anything but i, o→i|u, u→a. Count strings ending in each vowel: new[a] = e + i + u, new[e] = a + i, new[i] = e + o, new[o] = i, new[u] = i + o.',
    g: R => ({ n: R.int(2, 5) }),
    s(I, T) { let c = { a: 1, e: 1, i: 1, o: 1, u: 1 }; for (let l = 2; l <= I.n; l++) { const nx = { a: (c.e + c.i + c.u) % MOD, e: (c.a + c.i) % MOD, i: (c.e + c.o) % MOD, o: c.i, u: (c.i + c.o) % MOD }; const v = R4(l); T.at({ length: l - 1, ends: K(c) }); T.n(`Length ${l}: strings ending in "${v}"?`, nx[v], 'Sum the counts of vowels allowed right before it.'); c = nx; } return Object.values(c).reduce((a, b) => (a + b) % MOD, 0); function R4(l) { return 'aeiou'[(l * 3) % 5]; } }
  });

  D('dice-roll-simulation', {
    t: 'Dice Roll Simulation: count by face and run length',
    r: 'dp[f][r] = sequences ending in face f repeated exactly r times (r ≤ rollMax[f]). Rolling a different face starts r = 1 from the total; the same face extends r.',
    g: R => ({ n: R.int(2, 3), rollMax: Array.from({ length: 6 }, () => R.int(1, 2)) }),
    s(I, T) {
      let dp = Array.from({ length: 6 }, (_, f) => { const a = Array(I.rollMax[f] + 1).fill(0); a[1] = 1; return a; });
      for (let k = 2; k <= I.n; k++) { const tot = dp.map(a => a.reduce((x, y) => x + y, 0)), all = tot.reduce((x, y) => x + y, 0) % MOD;
        dp = dp.map((a, f) => { const b = Array(a.length).fill(0); b[1] = (all - tot[f] + MOD) % MOD; for (let r = 2; r < a.length; r++) b[r] = a[r - 1]; return b; });
        T.at({ rollMax: A(I.rollMax, { labels: [1, 2, 3, 4, 5, 6] }), 'total before': all }); T.n(`Roll ${k}: sequences ending in a single (fresh) 1?`, dp[0][1], 'All sequences that did not end in 1.'); }
      return dp.flat().reduce((a, b) => (a + b) % MOD, 0);
    }
  });

  D('toss-strange-coins', {
    t: 'Toss Strange Coins: probability of j heads so far',
    r: 'dp[j] = probability of exactly j heads so far. Each coin p: new[j] = dp[j]·(1 − p) + dp[j − 1]·p.', cmp: 'float',
    g: R => ({ prob: Array.from({ length: R.int(2, 4) }, () => R.pick([0.1, 0.2, 0.25, 0.5, 0.75, 0.8])), target: R.int(0, 2) }),
    s(I, T) { let dp = [1]; I.prob.forEach((p, i) => { const nx = Array(dp.length + 1).fill(0); dp.forEach((v, j) => { nx[j] += v * (1 - p); nx[j + 1] += v * p; }); dp = nx; if (I.target <= i + 1) { T.at({ prob: A(I.prob, { hl: [i] }), dp: A(dp.map(r4)) }); T.n(`After coin ${i}: probability of exactly ${I.target} heads?`, dp[I.target], 'dp[j]·(1 − p) + dp[j − 1]·p.'); } }); return dp[I.target] || 0; }
  });

  D('maximum-profit-in-job-scheduling', {
    t: 'Maximum Profit in Job Scheduling: take it or skip it, sorted by end',
    r: 'Sort jobs by end time. best[i] = max(best[i−1], profit[i] + best of the last job ending at or before start[i]) (binary search).',
    g: R => { const n = R.int(4, 5), s = [], e = [], p = []; for (let i = 0; i < n; i++) { const a = R.int(1, 8); s.push(a); e.push(a + R.int(1, 4)); p.push(R.int(1, 9) * 10); } return { startTime: s, endTime: e, profit: p }; },
    s(I, T) { const J = I.startTime.map((s, i) => [s, I.endTime[i], I.profit[i]]).sort((a, b) => a[1] - b[1]), best = [0]; J.forEach(([s, e, p], i) => { let k = i - 1; while (k >= 0 && J[k][1] > s) k--; const v = Math.max(best[i], p + best[k + 1]); T.at({ jobs: A(J.map(j => `${j[0]}-${j[1]}:$${j[2]}`), { hl: [i] }), best: A(best) }); T.n(`Best profit using the first ${i + 1} jobs (by end time)?`, v, `max(skip ${best[i]}, take ${p} + ${best[k + 1]}).`); best.push(v); }); return best[J.length]; }
  });

  D('palindrome-removal', {
    t: 'Palindrome Removal: pair the first element with an equal one',
    r: 'dp[i][j] = fewest moves to clear arr[i..j]. Remove arr[i] alone: 1 + dp[i+1][j]. If arr[i] == arr[i+1]: 1 + dp[i+2][j]. For k > i+1 with arr[k] == arr[i]: dp[i+1][k−1] + dp[k+1][j] (arr[i] and arr[k] ride on the last move inside).',
    g: R => ({ arr: R.ints(R.int(4, 5), 1, 3) }),
    s(I, T) { const a = I.arr, n = a.length, dp = mk(n + 1, n + 1, 0), g = (i, j) => i > j ? 0 : dp[i][j]; for (let i = n - 1; i >= 0; i--) for (let j = i; j < n; j++) { if (i === j) { dp[i][j] = 1; continue; } let b = 1 + g(i + 1, j); if (a[i] === a[i + 1]) b = Math.min(b, 1 + g(i + 2, j)); for (let k = i + 2; k <= j; k++) if (a[k] === a[i]) b = Math.min(b, g(i + 1, k - 1) + g(k + 1, j)); dp[i][j] = b; if (j - i >= 2) { T.at({ arr: A(a, { win: [i, j] }) }); T.n(`dp[${i}][${j}]?`, b, 'Best of removing arr[i] alone or pairing it with an equal value.'); } } return dp[0][n - 1]; }
  });

  D('handshakes-that-dont-cross', {
    t: 'Handshakes That Don\'t Cross: Catalan numbers',
    r: 'Person 0 shakes with person 2k+1, splitting the circle into two smaller groups: dp[n] = Σ dp[k] · dp[n − 1 − k] over pairs.',
    g: R => ({ numPeople: 2 * R.int(2, 6) }),
    s(I, T) { const m = I.numPeople / 2, dp = [1]; for (let p = 1; p <= m; p++) { let v = 0; for (let k = 0; k < p; k++) v = (v + dp[k] * dp[p - 1 - k]) % MOD; T.at({ dp: A(dp, { label: 'by pairs' }) }); T.n(`Ways with ${2 * p} people?`, v, 'Σ dp[k]·dp[p−1−k].'); dp.push(v); } return dp[m]; }
  });

  D('greatest-sum-divisible-by-three', {
    t: 'Greatest Sum Divisible by Three: best sum per remainder',
    r: 'best[r] = largest sum with remainder r. For each x, try adding it to every best[r] and keep the max per new remainder.',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 12) }),
    s(I, T) { let b = [0, -Infinity, -Infinity]; I.nums.forEach((x, i) => { const nb = b.slice(); b.forEach(v => { if (v > -Infinity) { const s = v + x; nb[s % 3] = Math.max(nb[s % 3], s); } }); T.at({ nums: A(I.nums, { hl: [i] }), best: K([['r0', b[0]], ['r1', b[1]], ['r2', b[2]]].map(([k, v]) => [k, v === -Infinity ? '−∞' : v])) }); T.n(`After ${x}: best sum divisible by 3?`, nb[0], 'Max of the old best[0] and best[(−x) mod 3] + x.'); b = nb; }); return b[0]; }
  });

  D('number-of-ways-to-stay-in-the-same-place-after-some-steps', {
    t: 'Number of Ways to Stay in the Same Place: left, right or stay',
    r: 'ways[p] = ways to be at p. Each step: new[p] = ways[p−1] + ways[p] + ways[p+1], staying inside the array. Only positions ≤ steps/2 can come back.',
    g: R => ({ steps: R.int(2, 5), arrLen: R.int(2, 4) }),
    s(I, T) { const L = Math.min(I.arrLen, Math.floor(I.steps / 2) + 1); let w = Array(L).fill(0); w[0] = 1; for (let s = 1; s <= I.steps; s++) { const nx = w.map((v, p) => (v + (p ? w[p - 1] : 0) + (p + 1 < L ? w[p + 1] : 0)) % MOD); T.at({ ways: A(w, { label: 'after step ' + (s - 1) }) }); T.n(`After step ${s}: ways to be at index 0?`, nx[0], 'ways[0] + ways[1].'); w = nx; } return w[0]; }
  });

  D('count-square-submatrices-with-all-ones', {
    t: 'Count Square Submatrices: min of three neighbors + 1',
    r: 'dp[r][c] = side of the largest all-ones square with bottom-right corner (r,c) = 1 + min(up, left, diag) for a 1. It is also how many squares end there. Sum it.',
    g: R => ({ matrix: R.grid(3, R.int(3, 4), 0, 1).map(r => r.map(x => R.chance(0.6) ? 1 : x)) }),
    s(I, T) { const g = I.matrix, dp = g.map(r => r.slice()); let tot = 0; for (let r = 0; r < g.length; r++) for (let c = 0; c < g[0].length; c++) { if (g[r][c] && r && c) dp[r][c] = 1 + Math.min(dp[r - 1][c], dp[r][c - 1], dp[r - 1][c - 1]); if (g[r][c] && r && c) { T.at({ dp: G(dp.map((row, i) => row.map((v, j) => i < r || (i === r && j < c) ? v : '?')), { hl: [[r, c]] }), total: tot }); T.n(`dp[${r}][${c}]?`, dp[r][c], '1 + min(up, left, diagonal).'); } tot += dp[r][c]; } return tot; }
  });

  D('palindrome-partitioning-iii', {
    t: 'Palindrome Partitioning III: change cost, then split',
    r: 'cost[i][j] = changes to make s[i..j] a palindrome (mismatched mirror pairs). dp[p][j] = best for the first j letters in p parts = min over i of dp[p−1][i] + cost[i][j−1].',
    g: R => ({ s: R.str(R.int(4, 6), 'abc'), k: R.int(2, 3) }),
    s(I, T) {
      const s = I.s, n = s.length, cost = (i, j) => { let c = 0; while (i < j) { if (s[i] !== s[j]) c++; i++; j--; } return c; };
      T.at({ s: A([...s]) }); T.n('Changes to make the whole string a palindrome?', cost(0, n - 1), 'Count mismatched mirror pairs.');
      let dp = Array(n + 1).fill(Infinity); dp[0] = 0;
      for (let p = 1; p <= I.k; p++) { const nx = Array(n + 1).fill(Infinity); for (let j = p; j <= n; j++) for (let i = p - 1; i < j; i++) nx[j] = Math.min(nx[j], dp[i] + cost(i, j - 1)); dp = nx; T.at({ s: A([...s]), parts: p }); T.n(`Fewest changes using exactly ${p} part(s) for the whole string?`, dp[n], 'Best previous split + cost of the last part.'); }
      return dp[n];
    }
  });

  D('minimum-falling-path-sum-ii', {
    t: 'Minimum Falling Path Sum II: remember the two smallest',
    r: 'For each row, keep the smallest and second smallest totals from the row above. A cell adds the smallest unless it sits in that same column, then the second smallest.',
    g: R => ({ grid: R.grid(R.int(3, 4), 3, 1, 9) }),
    s(I, T) { let prev = I.grid[0].slice(); for (let r = 1; r < I.grid.length; r++) { const s = prev.slice().sort((a, b) => a - b), mi = prev.indexOf(s[0]); const cur = I.grid[r].map((v, c) => v + (c === mi ? s[1] : s[0])); T.at({ grid: G(I.grid, { hl: [[r, 0], [r, 1], [r, 2]] }), above: A(prev) }); T.n(`Row ${r}: smallest total ending in this row?`, Math.min(...cur), 'Each cell adds the best total from a different column.'); prev = cur; } return Math.min(...prev); }
  });

  D('number-of-paths-with-max-score', {
    t: 'Number of Paths with Max Score: best score and its count',
    r: 'From S (bottom-right) move up, left or up-left to E, avoiding X. For each cell keep (best score, ways). Take the best of the three neighbors toward S, summing the ways of all tied neighbors.',
    g: R => { const n = 3, b = Array.from({ length: n }, () => Array.from({ length: n }, () => R.chance(0.15) ? 'X' : String(R.int(1, 4)))); b[0][0] = 'E'; b[n - 1][n - 1] = 'S'; return { board: b.map(r => r.join('')) }; },
    s(I, T) {
      const b = I.board, n = b.length, sc = mk(n, n, -1), wy = mk(n, n, 0); sc[n - 1][n - 1] = 0; wy[n - 1][n - 1] = 1;
      for (let r = n - 1; r >= 0; r--) for (let c = n - 1; c >= 0; c--) { if ((r === n - 1 && c === n - 1) || b[r][c] === 'X') continue; let best = -1, w = 0;
        for (const [dr, dc] of [[1, 0], [0, 1], [1, 1]]) { const x = r + dr, y = c + dc; if (x < n && y < n && wy[x][y]) { if (sc[x][y] > best) { best = sc[x][y]; w = wy[x][y]; } else if (sc[x][y] === best) w = (w + wy[x][y]) % MOD; } }
        if (w) { sc[r][c] = best + (b[r][c] === 'E' ? 0 : +b[r][c]); wy[r][c] = w; }
        if (r + c <= 2) { T.at({ board: G(b.map(x => [...x]), { hl: [[r, c]] }) }); T.n(`Best score reaching (${r},${c}) from S (−1 if unreachable)?`, sc[r][c], 'Best neighbor below/right/diagonal + this digit.'); } }
      return wy[0][0] ? [sc[0][0], wy[0][0]] : [0, 0];
    }
  });

  D('minimum-insertion-steps-to-make-a-string-palindrome', {
    t: 'Minimum Insertion Steps to Make a Palindrome: interval DP',
    r: 'dp[i][j] = insertions for s[i..j]. Equal ends: dp[i+1][j−1]. Otherwise 1 + min(dp[i+1][j], dp[i][j−1]).',
    g: R => ({ s: R.str(R.int(4, 5), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, dp = mk(n + 1, n + 1, 0); for (let len = 2; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1, v = s[i] === s[j] ? (len > 2 ? dp[i + 1][j - 1] : 0) : 1 + Math.min(dp[i + 1][j], dp[i][j - 1]); T.at({ s: A([...s], { win: [i, j] }) }); T.n(`Insertions for "${s.slice(i, j + 1)}"?`, v, s[i] === s[j] ? 'Equal ends: solve the inside.' : '1 + the better of dropping either end.'); dp[i][j] = v; } return dp[0][n - 1]; }
  });

  D('minimum-distance-to-type-a-word-using-two-fingers', {
    t: 'Minimum Distance to Type a Word Using Two Fingers: where is the other finger?',
    r: 'Letters sit on a 6-wide grid (A at (0,0)). One finger always types the previous letter. dp[other] = cheapest cost with the other finger on that letter (or free). Typing the next letter moves either finger.',
    g: R => ({ word: R.str(R.int(3, 5), 'ABCHKPRYZ') }),
    s(I, T) {
      const w = [...I.word].map(c => c.charCodeAt(0) - 65), d = (a, b) => a < 0 ? 0 : Math.abs(Math.floor(a / 6) - Math.floor(b / 6)) + Math.abs(a % 6 - b % 6); let dp = new Map([[-1, 0]]);
      for (let i = 1; i < w.length; i++) { const nx = new Map(), up = (k, v) => { if (!nx.has(k) || nx.get(k) > v) nx.set(k, v); };
        for (const [o, c] of dp) { up(o, c + d(w[i - 1], w[i])); up(w[i - 1], c + d(o, w[i])); } dp = nx;
        T.at({ word: A([...I.word], { hl: [i] }), keyboard: 'A-F / G-L / M-R / S-X / YZ' }); T.n(`Cheapest total after typing "${I.word.slice(0, i + 1)}"?`, Math.min(...dp.values()), 'Move whichever finger is cheaper overall.'); }
      return Math.min(...dp.values());
    }
  });

  D('minimum-difficulty-of-a-job-schedule', {
    t: 'Minimum Difficulty of a Job Schedule: where does the last day start?',
    r: 'dp[d][i] = least difficulty doing the first i jobs in d days = min over j of dp[d−1][j] + max(jobs j..i−1). Fewer jobs than days: −1.',
    g: R => ({ jobDifficulty: R.ints(R.int(3, 6), 1, 9), d: R.int(1, 3) }),
    s(I, T) {
      const J = I.jobDifficulty, n = J.length; T.at({ jobs: A(J), d: I.d }); T.yn(`Can ${n} jobs fill ${I.d} days (at least one per day)?`, n >= I.d, 'Need at least one job per day.'); if (n < I.d) return -1;
      let dp = Array(n + 1).fill(Infinity); dp[0] = 0;
      for (let day = 1; day <= I.d; day++) { const nx = Array(n + 1).fill(Infinity); for (let i = day; i <= n; i++) { let m = 0; for (let j = i - 1; j >= day - 1; j--) { m = Math.max(m, J[j]); nx[i] = Math.min(nx[i], dp[j] + m); } } dp = nx; T.at({ jobs: A(J), days: day }); T.n(`Least difficulty for all ${n} jobs in ${day} day(s)?`, dp[n], 'Best previous split + hardest job on the last day.'); }
      return dp[n];
    }
  });

  D('jump-game-v', {
    t: 'Jump Game V: process from lowest to highest',
    r: 'From i you may jump up to d steps left or right, only over strictly lower bars, landing lower. dp[i] = 1 + max dp of reachable lower indices; compute in increasing height order.',
    g: R => ({ arr: R.ints(R.int(5, 7), 1, 9), d: R.int(1, 3) }),
    s(I, T) {
      const a = I.arr, n = a.length, dp = Array(n).fill(0), ord = a.map((_, i) => i).sort((x, y) => a[x] - a[y]);
      for (const i of ord) { let b = 1; for (const s of [-1, 1]) for (let x = 1; x <= I.d; x++) { const j = i + s * x; if (j < 0 || j >= n || a[j] >= a[i]) break; b = Math.max(b, dp[j] + 1); } dp[i] = b; T.at({ arr: A(a, { hl: [i] }), dp: A(dp.map(v => v || '?')) }); T.n(`dp[${i}] (height ${a[i]})?`, b, 'Best lower landing within d, stopping at the first bar that is not lower.'); }
      return Math.max(...dp);
    }
  });

  D('maximum-students-taking-exam', {
    t: 'Maximum Students Taking Exam: row masks',
    r: 'Each row picks a mask of good seats with no two adjacent. A row\'s mask must not have a student diagonally in front of one in the previous row (mask & (prev << 1) and mask & (prev >> 1) are 0). dp over rows.',
    g: R => ({ seats: Array.from({ length: R.int(2, 3) }, () => Array.from({ length: R.int(3, 4) === 3 ? 4 : 4 }, () => R.chance(0.3) ? '#' : '.')) }),
    s(I, T) {
      const S = I.seats, n = S[0].length, pc = m => m.toString(2).split('1').length - 1; let dp = new Map([[0, 0]]);
      S.forEach((row, r) => { const good = row.reduce((m, c, j) => c === '.' ? m | 1 << j : m, 0), nx = new Map();
        for (let m = 0; m < 1 << n; m++) { if ((m & good) !== m || (m & (m << 1))) continue; for (const [p, v] of dp) if (!(m & (p << 1)) && !(m & (p >> 1))) nx.set(m, Math.max(nx.get(m) ?? -1, v + pc(m))); }
        dp = nx; T.at({ seats: G(S, { hl: row.map((_, j) => [r, j]) }) }); T.n(`Most students in rows 0..${r}?`, Math.max(...dp.values()), 'Best compatible mask pair, row by row.'); });
      return Math.max(...dp.values());
    }
  });

  D('sort-integers-by-the-power-value', {
    t: 'Sort Integers by the Power Value: Collatz steps',
    r: 'power(x) = steps to reach 1 (halve if even, 3x + 1 if odd). Sort lo..hi by (power, value) and return the k-th.',
    g: R => { const lo = R.int(2, 20); return { lo, hi: lo + R.int(2, 4), k: 1 + R.int(0, 2) }; },
    s(I, T) { const pw = x => { let s = 0; while (x !== 1) { x = x % 2 ? 3 * x + 1 : x / 2; s++; } return s; }, xs = []; for (let x = I.lo; x <= I.hi; x++) { T.at({ x }); T.n(`power(${x})?`, pw(x), 'Count the Collatz steps to 1.'); xs.push(x); } xs.sort((a, b) => pw(a) - pw(b) || a - b); return xs[I.k - 1]; }
  });

  D('pizza-with-3n-slices', {
    t: 'Pizza With 3n Slices: n non-adjacent slices on a circle',
    r: 'You end up with n slices, no two adjacent, around a circle. Solve twice as a line (drop the last slice, or drop the first): dp[i][j] = max(dp[i−1][j], dp[i−2][j−1] + slice).',
    g: R => ({ slices: R.ints(3 * R.int(1, 2), 1, 9) }),
    s(I, T) {
      const n = I.slices.length / 3, line = (a, nm) => { const m = a.length, dp = mk(m + 1, n + 1, -Infinity); for (let i = 0; i <= m; i++) dp[i][0] = 0; for (let i = 1; i <= m; i++) for (let j = 1; j <= n; j++) dp[i][j] = Math.max(dp[i - 1][j], (i >= 2 ? dp[i - 2][j - 1] : j === 1 ? 0 : -Infinity) + a[i - 1]); T.at({ line: A(a), take: n, case: nm }); T.n(`Best total of ${n} non-adjacent slices in this line?`, dp[m][n], 'Skip or take (and skip the neighbor).'); return dp[m][n]; };
      return Math.max(line(I.slices.slice(0, -1), 'without the last slice'), line(I.slices.slice(1), 'without the first slice'));
    }
  });

  D('find-all-good-strings', {
    t: 'Find All Good Strings: count ≤ s2 minus count < s1, avoiding evil',
    r: 'Digit DP over positions with the KMP state of how much of evil is matched. count(bound) = strings ≤ bound avoiding evil. Answer = count(s2) − count(s1) + (s1 is good).',
    g: R => ({ n: 2, s1: R.str(2, 'abc'), s2: 'c' + R.str(1, 'abc'), evil: R.str(R.int(1, 2), 'ab') }),
    s(I, T) {
      const ev = I.evil, m = ev.length, fail = Array(m).fill(0); for (let i = 1, k = 0; i < m; i++) { while (k && ev[i] !== ev[k]) k = fail[k - 1]; if (ev[i] === ev[k]) k++; fail[i] = k; }
      if (m > 1) { T.at({ evil: A([...ev]) }); T.n(`KMP failure value for evil[${m - 1}]?`, fail[m - 1], 'Longest proper prefix that is also a suffix.'); }
      const step = (k, c) => { while (k && ev[k] !== c) k = fail[k - 1]; return ev[k] === c ? k + 1 : 0; };
      const count = b => { const memo = new Map(); const f = (i, k, tight) => { if (k === m) return 0; if (i === I.n) return 1; const key = i * 1e4 + k * 2 + (tight ? 1 : 0); if (memo.has(key)) return memo.get(key); let r = 0; const hi = tight ? b.charCodeAt(i) : 122; for (let c = 97; c <= hi; c++) r = (r + f(i + 1, step(k, String.fromCharCode(c)), tight && c === hi)) % MOD; memo.set(key, r); return r; }; return f(0, 0, true); };
      const c2 = count(I.s2), c1 = count(I.s1), good = I.s1.includes(ev) ? 0 : 1;
      T.at({ s1: I.s1, s2: I.s2, evil: ev }); T.n(`Good strings ≤ "${I.s2}"?`, c2, 'Digit DP with the KMP state.'); T.n(`Good strings ≤ "${I.s1}"?`, c1, 'Same DP on the lower bound.'); T.yn(`Is "${I.s1}" itself good?`, !!good, 'It is good unless it contains evil.');
      return ((c2 - c1 + good) % MOD + MOD) % MOD;
    }
  });

  D('stone-game-iii', {
    t: 'Stone Game III: best lead from each index',
    r: 'dp[i] = the best (my total − opponent total) from stone i on. Take 1, 2 or 3 stones: sum − dp[i + x]. Alice wins if dp[0] > 0, Bob if < 0, else Tie.',
    g: R => ({ stoneValue: R.ints(R.int(4, 6), -4, 8) }),
    s(I, T) { const v = I.stoneValue, n = v.length, dp = Array(n + 1).fill(0); for (let i = n - 1; i >= 0; i--) { let b = -Infinity, s = 0; for (let x = 1; x <= 3 && i + x <= n; x++) { s += v[i + x - 1]; b = Math.max(b, s - dp[i + x]); } dp[i] = b; T.at({ stones: A(v, { hl: [i] }), dp: A(dp.map((x, j) => j > i ? x : j === i ? '?' : '')) }); T.n(`dp[${i}]?`, b, 'Best of taking 1–3 stones minus the opponent\'s dp after them.'); } return dp[0] > 0 ? 'Alice' : dp[0] < 0 ? 'Bob' : 'Tie'; }
  });

  D('number-of-ways-to-paint-n-3-grid', {
    t: 'Number of Ways to Paint N × 3 Grid: ABA and ABC rows',
    r: 'Rows are type ABA (6 ways) or ABC (6 ways). Next row: ABA\' = 3·ABA + 2·ABC, ABC\' = 2·ABA + 2·ABC.',
    g: R => ({ n: R.int(2, 5) }),
    s(I, T) { let a = 6, b = 6; for (let i = 2; i <= I.n; i++) { const na = (3 * a + 2 * b) % MOD, nb = (2 * a + 2 * b) % MOD; T.at({ row: i - 1, ABA: a, ABC: b }); T.n(`Row ${i}: ABA-type count?`, na, `3·${a} + 2·${b}.`); T.n(`Row ${i}: ABC-type count?`, nb, `2·${a} + 2·${b}.`); a = na; b = nb; } return (a + b) % MOD; }
  });
})();
