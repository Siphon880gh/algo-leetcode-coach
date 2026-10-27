/* v2 games: dynamic programming (15). */
(function () {
  'use strict';
  const { D, A, G } = LCGame.H;

  D('maximum-coin-collection', {
    t: 'Maximum Coin Collection',
    r: 'dp[s] = best coins for a trip ending at the current mile having made s switches (lane = s even ? 1 : 2). Each mile: dp[s] = coin(lanes) + max(0 [enter here], dp[s], dp[s−1]). Track the best value seen.',
    g: R => { const n = R.int(1, 6); return { lane1: R.ints(n, -5, 6), lane2: R.ints(n, -5, 6) }; },
    s(I, T) { let dp = [-Infinity, -Infinity, -Infinity], best = -Infinity; I.lane1.forEach((_, i) => { const v = s => s % 2 ? I.lane2[i] : I.lane1[i], nd = [0, 1, 2].map(s => v(s) + Math.max(0, dp[s], s ? dp[s - 1] : -Infinity)); dp = nd; best = Math.max(best, ...nd); if (i < 5) { T.at({ lanes: G([I.lane1, I.lane2], { c: i }), dp: A(nd) }); T.n('Best trip ending here with 0 switches?', nd[0], 'Lane 1 only: extend or start fresh.'); } }); return best; }
  });

  D('find-minimum-cost-to-remove-array-elements', {
    t: 'Find Minimum Cost to Remove Array Elements',
    r: 'The front is always one carried-over element plus the next untouched ones, so state = (index of leftover, next index). Try the three ways to remove two of the first three; memoize.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length, memo = new Map(); const f = (j, i) => { if (i >= n) return a[j]; if (i === n - 1) return Math.max(a[j], a[i]); const k = j * 100 + i; if (memo.has(k)) return memo.get(k); const v = Math.min(Math.max(a[i], a[i + 1]) + f(j, i + 2), Math.max(a[j], a[i]) + f(i + 1, i + 2), Math.max(a[j], a[i + 1]) + f(i, i + 2)); memo.set(k, v); return v; }; const ans = f(0, 1); if (n >= 3) { T.at({ first3: A(a.slice(0, 3)) }); T.n('Cost if we remove the two largest of the first three?', Math.max(...a.slice(0, 3)), 'Their max is the cost.'); T.n('Cost if we remove the first two instead?', Math.max(a[0], a[1]), 'The larger of the two.'); } else { T.at({ nums: A(a) }); T.n('Cost to remove everything at once?', Math.max(...a), 'Fewer than three left.'); T.n('How many elements?', n, 'With fewer than three, one step removes them all.'); } return ans; })(); T.n('Minimum total cost?', res, 'Memoized over the leftover index and the next index.'); return res; }
  });

  D('longest-palindromic-subsequence-after-at-most-k-operations', {
    t: 'Longest Palindromic Subsequence After at Most K Operations',
    r: 'Interval DP with a budget: dp[i][j][k]. Either drop s[i] or s[j], or pair them at a cost equal to the smaller of their letter distance d and 26 minus d, and add 2 plus dp[i plus 1][j minus 1][k minus cost].',
    g: R => ({ s: R.str(R.int(1, 7), 'abcxyz'), k: R.int(0, 5) }),
    s(I, T) { const res = (() => { const s = I.s, n = s.length, memo = new Map(), cost = (a, b) => { const d = Math.abs(a.charCodeAt(0) - b.charCodeAt(0)); return Math.min(d, 26 - d); }; const f = (i, j, k) => { if (i > j) return 0; if (i === j) return 1; const key = `${i},${j},${k}`; if (memo.has(key)) return memo.get(key); let v = Math.max(f(i + 1, j, k), f(i, j - 1, k)); const c = cost(s[i], s[j]); if (c <= k) v = Math.max(v, 2 + f(i + 1, j - 1, k - c)); memo.set(key, v); return v; }; if (n > 1) { T.at({ s: A([...s], { i: 0, j: n - 1 }) }); T.n('Operations to make the two ends equal?', cost(s[0], s[n - 1]), 'Shorter way around the alphabet.'); T.yn('Can the two ends be paired within the budget k?', cost(s[0], s[n - 1]) <= I.k, `The budget is ${I.k}.`); } else { T.at({ s: A([...s]) }); T.n('Length of s?', 1, 'Just one character.'); T.yn('Is a single character a palindrome?', true, 'It reads the same both ways.'); } return f(0, n - 1, I.k); })(); T.n('Longest palindromic subsequence?', res, 'Interval DP with the remaining budget.'); return res; }
  });

  D('sum-of-k-subarrays-with-length-at-least-m', {
    t: 'Sum of K Subarrays With Length at Least M',
    r: 'dp[t][i] = best sum using t subarrays within nums[..i). Either skip element i−1, or end the t-th subarray at i with start at most i − m (prefix sums plus a running max of dp[t−1][j] − P[j]).',
    g: R => { const m = R.int(1, 3), k = R.int(1, 3); return { nums: R.ints(R.int(k * m, Math.max(7, k * m)), -5, 6), k, m }; },
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); let prev = Array(n + 1).fill(0); for (let t = 1; t <= I.k; t++) { const cur = Array(n + 1).fill(-Infinity); for (let i = 1; i <= n; i++) { cur[i] = cur[i - 1]; for (let j = 0; j <= i - I.m; j++) if (prev[j] > -Infinity) cur[i] = Math.max(cur[i], prev[j] + P[i] - P[j]); } if (t <= 3) { T.at({ nums: A(a), round: t }); T.n(`Best total with ${t} subarrays?`, cur[n], `Each subarray has length at least ${I.m}.`); } prev = cur; } return prev[n]; }
  });
})();
