/* v2 games: dynamic programming (13). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const pc = m => { let c = 0; while (m) { c += m & 1; m >>= 1; } return c; };
  const Cb = (n, k) => { if (k < 0 || k > n) return 0; let r = 1; for (let i = 0; i < k; i++) r = r * (n - i) / (i + 1); return Math.round(r); };
  const build = (I, T) => { const t = I.target, n = t.length, dp = Array(n + 1).fill(Infinity); dp[0] = 0; for (let i = 0; i < n; i++) { if (dp[i] === Infinity) continue; I.words.forEach((w, k) => { if (t.startsWith(w, i)) dp[i + w.length] = Math.min(dp[i + w.length], dp[i] + I.costs[k]); }); } for (let i = 1; i <= n; i++) { T.at({ target: A([...t], { win: [0, i - 1] }), words: A(I.words.map((w, k) => `${w}:${I.costs[k]}`)) }); T.n(`Cheapest cost to build "${t.slice(0, i)}" (inf if impossible)?`, dp[i], 'Best dp[i − |w|] + cost over words ending here.'); } return dp[n] === Infinity ? -1 : dp[n]; };
  const genBuild = R => { const target = R.str(R.int(3, 5), 'ab'); const words = [...new Set([target.slice(0, 2), target.slice(2), 'a', 'b', R.str(2, 'ab')])].filter(Boolean).slice(0, 4); return { target, words, costs: words.map(() => R.int(1, 6)) }; };
  const rooks = (I, T) => { const b = I.board, m = b.length, n = b[0].length; let best = -Infinity; for (let r1 = 0; r1 < m; r1++) { const rowBest = Math.max(...b[r1]); T.at({ board: G(b, { hl: b[r1].map((v, c) => v === rowBest ? [r1, c] : null).filter(Boolean) }) }); T.n(`Best single cell in row ${r1}?`, rowBest, 'The full solution keeps the top 3 cells per row.'); } for (let r1 = 0; r1 < m; r1++) for (let r2 = r1 + 1; r2 < m; r2++) for (let r3 = r2 + 1; r3 < m; r3++) for (let c1 = 0; c1 < n; c1++) for (let c2 = 0; c2 < n; c2++) for (let c3 = 0; c3 < n; c3++) if (c1 !== c2 && c2 !== c3 && c1 !== c3) best = Math.max(best, b[r1][c1] + b[r2][c2] + b[r3][c3]); T.at({ board: G(b) }); T.n('Best total for three non-attacking rooks?', best, 'Distinct rows and distinct columns.'); return best; };

  D('equalize-strings-by-adding-or-removing-characters-at-ends', {
    t: 'Equalize Strings at the Ends: keep the longest common substring',
    r: 'Only a contiguous block of initial can survive. Keep the longest common substring L: remove the rest of initial, add the rest of target. Answer = |initial| + |target| − 2L.',
    g: R => ({ initial: R.str(R.int(3, 5), 'abc'), target: R.str(R.int(3, 5), 'abc') }),
    s(I, T) { const a = I.initial, b = I.target, dp = mk(a.length + 1, b.length + 1, 0); let L = 0; for (let i = 1; i <= a.length; i++) { for (let j = 1; j <= b.length; j++) if (a[i - 1] === b[j - 1]) dp[i][j] = dp[i - 1][j - 1] + 1; const rowBest = Math.max(...dp[i]); T.at({ dp: G(dp, { rh: ['', ...a], ch: ['', ...b], hl: dp[i].map((_, j) => [i, j]) }) }); T.n(`Longest common substring ending at initial[${i - 1}]?`, rowBest, 'Max diagonal run in this row.'); L = Math.max(L, rowBest); } return a.length + b.length - 2 * L; }
  });

  D('minimum-substring-partition-of-equal-character-frequency', {
    t: 'Minimum Balanced Partition: every letter appears equally often',
    r: 'dp[i] = fewest balanced pieces for s[0 to i). Grow the last piece s[j to i−1] leftward, tracking counts; it is balanced if every present letter has the same count.',
    g: R => ({ s: R.str(R.int(4, 7), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, dp = [0]; for (let i = 1; i <= n; i++) { let b = Infinity; const c = {}; for (let j = i - 1; j >= 0; j--) { c[s[j]] = (c[s[j]] || 0) + 1; const v = Object.values(c); if (v.every(x => x === v[0])) b = Math.min(b, dp[j] + 1); } T.at({ s: A([...s], { hl: [i - 1] }), dp: A(dp.concat('?')) }); T.n(`dp[${i}]?`, b, 'Best balanced last piece.'); dp.push(b); } return dp[n]; }
  });

  D('taking-maximum-energy-from-the-mystic-dungeon', {
    t: 'Taking Maximum Energy: suffix sums with step k',
    r: 'Starting at i you collect energy[i] + energy[i + k] + … to the end. From the right: s[i] = energy[i] + s[i + k]. Take the max.',
    g: R => ({ energy: R.ints(R.int(5, 7), -6, 6), k: R.int(2, 3) }),
    s(I, T) { const e = I.energy, n = e.length, s = Array(n).fill(0); let best = -Infinity; for (let i = n - 1; i >= 0; i--) { s[i] = e[i] + (i + I.k < n ? s[i + I.k] : 0); T.at({ energy: A(e, { hl: [i] }), sums: A(s.map((v, j) => j >= i ? v : '?')), k: I.k }); T.n(`Energy starting at ${i}?`, s[i], `${e[i]} + start at ${i + I.k}.`); best = Math.max(best, s[i]); } return best; }
  });

  D('maximum-difference-score-in-a-grid', {
    t: 'Maximum Difference Score in a Grid: end minus start',
    r: 'Scores telescope: a path\'s score is last − first. For each cell, find the smallest value strictly up-left reachable (above or left, at least one move): best = cell − that minimum.',
    g: R => ({ grid: R.grid(R.int(2, 3), R.int(3, 4), 1, 9) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, mn = mk(m, n, Infinity); let best = -Infinity; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) { const prev = Math.min(r ? Math.min(mn[r - 1][c], g[r - 1][c]) : Infinity, c ? Math.min(mn[r][c - 1], g[r][c - 1]) : Infinity); mn[r][c] = prev; if (prev < Infinity) { T.at({ grid: G(g, { hl: [[r, c]] }) }); T.n(`Best score ending at (${r},${c})?`, g[r][c] - prev, `${g[r][c]} − smallest earlier value ${prev}.`); best = Math.max(best, g[r][c] - prev); } } return best; }
  });

  D('find-the-minimum-cost-array-permutation', {
    t: 'Minimum Cost Array Permutation: a cycle starting at 0',
    r: 'score = the sum of |perm[i] − nums[perm[i+1]]| around the cycle. Rotation does not change it, so start at 0. Bitmask DP f(mask, last) = cheapest finish; build the lexicographically smallest optimal order greedily.',
    g: R => ({ nums: R.perm(R.int(3, 4)) }),
    s(I, T) {
      const a = I.nums, n = a.length, full = (1 << n) - 1, memo = new Map(), f = (m, l) => { if (m === full) return Math.abs(l - a[0]); const k = m * 16 + l; if (memo.has(k)) return memo.get(k); let b = Infinity; for (let j = 0; j < n; j++) if (!(m >> j & 1)) b = Math.min(b, Math.abs(l - a[j]) + f(m | 1 << j, j)); memo.set(k, b); return b; };
      const p = [0]; let m = 1; while (m !== full) { const l = p[p.length - 1]; let pick = -1; for (let j = 0; j < n && pick < 0; j++) if (!(m >> j & 1) && Math.abs(l - a[j]) + f(m | 1 << j, j) === f(m, l)) pick = j; T.at({ nums: A(a), perm: A(p) }); T.k(`Next element after ${l} (smallest that stays optimal)?`, [...Array(n).keys()].filter(j => !(m >> j & 1)).map(j => [String(j), `${j} (cost ${Math.abs(l - a[j])})`]), String(pick), `Optimal remaining cost is ${f(m, l)}.`); p.push(pick); m |= 1 << pick; }
      return p;
    }
  });

  D('find-number-of-ways-to-reach-the-k-th-stair', {
    t: 'Ways to Reach the k-th Stair: count ups and downs',
    r: 'After j up-jumps (1, then 2, then 4, doubling each time) and d single downs, Alice stands on 2 to the power j, minus d. Downs cannot be consecutive, so they go into j plus 1 gaps: choose d of the j plus 1 gaps. Add this over every j where d (2 to the power j, minus k) is between 0 and j plus 1.',
    g: R => ({ k: R.int(0, 6) }),
    s(I, T) { const res = (() => { let tot = 0; let j0 = 0; while (2 ** j0 < I.k) j0++; T.at({ k: I.k }); T.n('Fewest up-jumps whose total reaches stair k?', j0, 'Smallest j with 2 to the power j at least k.'); for (let j = 0; j <= 31; j++) { const d = 2 ** j - I.k; if (d > j + 1) break; if (d < 0) continue; T.at({ k: I.k, 'up jumps': j }); T.n(`With ${j} up-jumps: ways to end on stair ${I.k}?`, Cb(j + 1, d), `${d} downs in ${j + 1} gaps: choose ${d} of ${j + 1}.`); tot += Cb(j + 1, d); } return tot; })(); T.n('Total ways?', res, 'Add the counts for every number of up-jumps.'); return res; }
  });

  const goodSeq = (I, T) => { const a = I.nums, n = a.length, k = I.k, dp = mk(n, k + 1, 0); let best = 0; for (let i = 0; i < n; i++) { for (let j = 0; j <= k; j++) { let v = 1; for (let p = 0; p < i; p++) { if (a[p] === a[i]) v = Math.max(v, dp[p][j] + 1); else if (j) v = Math.max(v, dp[p][j - 1] + 1); } dp[i][j] = v; } T.at({ nums: A(a, { hl: [i] }), k }); T.n(`Longest good subsequence ending at ${i} with up to ${k} changes?`, dp[i][k], 'Equal predecessor keeps j; a different one uses one change.'); best = Math.max(best, dp[i][k]); } return best; };
  D('find-the-maximum-length-of-a-good-subsequence-i', { t: 'Maximum Length of a Good Subsequence I: at most k value changes', r: 'dp[i][j] = longest good subsequence ending at i using j changes: from p < i with the same value (dp[p][j] + 1) or a different value (dp[p][j−1] + 1).', g: R => ({ nums: R.ints(R.int(4, 6), 1, 3), k: R.int(0, 2) }), s: goodSeq });
  D('find-the-maximum-length-of-a-good-subsequence-ii', { t: 'Maximum Length of a Good Subsequence II: best per value and per change count', r: 'Same dp[i][j], but keep best[j] over all values and bestByValue[v][j] so each step is O(k): dp = max(byValue[v][j] + 1, best[j−1] + 1).', g: R => ({ nums: R.ints(R.int(5, 7), 1, 3), k: R.int(0, 2) }), s: goodSeq });

  const reward = (I, T) => { const v = [...new Set(I.rewardValues)].sort((a, b) => a - b); let can = new Set([0]); for (const x of v) { for (const s of [...can]) if (x > s) can.add(s + x); T.at({ sorted: A(v, { hl: [v.indexOf(x)] }) }); T.n(`After value ${x}: largest reachable total?`, Math.max(...can), `Add ${x} to every reachable total smaller than ${x}.`); } return Math.max(...can); };
  D('maximum-total-reward-using-operations-i', { t: 'Maximum Total Reward I: add only values bigger than your total', r: 'Sort. A value v can be added to total x only if v > x. Keep the set of reachable totals; each v extends totals below v.', g: R => ({ rewardValues: R.ints(R.int(3, 6), 1, 9) }), s: reward });
  D('maximum-total-reward-using-operations-ii', { t: 'Maximum Total Reward II: bitset of reachable totals', r: 'Same idea as part I with a bitset: for each sorted v, OR in (bits below v) shifted left by v.', g: R => ({ rewardValues: R.ints(R.int(4, 7), 1, 12) }), s: reward });

  D('the-number-of-ways-to-make-the-sum', {
    t: 'The Number of Ways to Make the Sum: unlimited 1s, 2s and 6s, at most two 4s',
    r: 'Count combinations with coins 1, 2, 6 (coin-change DP, coin by coin). Then add the 4s: answer = dp[n] + dp[n − 4] + dp[n − 8].',
    g: R => ({ n: R.int(4, 14) }),
    s(I, T) { const dp = Array(I.n + 1).fill(0); dp[0] = 1; for (const c of [1, 2, 6]) { for (let s = c; s <= I.n; s++) dp[s] = (dp[s] + dp[s - c]) % MOD; T.at({ coins: `up to ${c}`, n: I.n }); T.n(`Ways to make ${I.n} with coins up to ${c}?`, dp[I.n], 'Coin-change, one coin type at a time.'); } const g = x => x >= 0 ? dp[x] : 0; return (g(I.n) + g(I.n - 4) + g(I.n - 8)) % MOD; }
  });

  D('maximum-total-damage-with-spell-casting', {
    t: 'Maximum Total Damage: no damage within 2 of another',
    r: 'Group by damage value: total[v] = v times count. Sorted distinct values: dp[i] = max(dp[i−1], total[i] + dp[j]) where j is the last value < v − 2.',
    g: R => ({ power: R.ints(R.int(4, 7), 1, 9) }),
    s(I, T) { const c = {}; I.power.forEach(x => c[x] = (c[x] || 0) + 1); const v = Object.keys(c).map(Number).sort((a, b) => a - b), dp = []; v.forEach((x, i) => { let j = i - 1; while (j >= 0 && v[j] >= x - 2) j--; const val = Math.max(i ? dp[i - 1] : 0, x * c[x] + (j >= 0 ? dp[j] : 0)); T.at({ values: A(v, { hl: [i] }), dp: A(dp.concat('?')) }); T.n(`Best damage using values up to ${x}?`, val, `Skip it, or take ${x} times ${c[x]} plus the best below ${x - 2}.`); dp.push(val); }); return dp[v.length - 1]; }
  });

  D('minimum-operations-to-make-binary-array-elements-equal-to-one-ii', {
    t: 'Make Binary Array All Ones II: flip suffixes, track parity',
    r: 'Scan left to right with flips = suffix flips so far. The current value is nums[i] XOR (flips odd). If it is 0, flip the suffix here.',
    g: R => ({ nums: Array.from({ length: R.int(4, 7) }, () => R.int(0, 1)) }),
    s(I, T) { let f = 0; I.nums.forEach((x, i) => { const cur = x ^ (f & 1); T.at({ nums: A(I.nums, { hl: [i] }), flips: f }); T.yn(`Flip the suffix at ${i}?`, cur === 0, `Current value ${x} after ${f} flips is ${cur}.`); if (!cur) f++; }); return f; }
  });

  D('count-the-number-of-inversions', {
    t: 'Count the Number of Inversions: insert the next element by rank',
    r: 'dp[i][c] = permutations of the first i + 1 positions with c inversions. The new element can create 0 to i inversions: dp[i][c] = the sum of dp[i−1][c − t]. If a requirement exists for end i, keep only that c.',
    g: R => { const n = R.int(3, 4); return { n, requirements: [[n - 1, R.int(0, Math.min(4, n * (n - 1) / 2))], [0, 0]] }; },
    s(I, T) { const req = new Map(I.requirements.map(([e, c]) => [e, c])), M = 400; let dp = Array(M + 1).fill(0); dp[0] = 1; for (let i = 1; i < I.n; i++) { const nx = Array(M + 1).fill(0); for (let c = 0; c <= M; c++) for (let t = 0; t <= i && t <= c; t++) nx[c] = (nx[c] + dp[c - t]) % MOD; if (req.has(i)) nx.forEach((_, c) => { if (c !== req.get(i)) nx[c] = 0; }); dp = nx; T.at({ prefix: i + 1, requirement: req.has(i) ? `exactly ${req.get(i)}` : 'none' }); T.n(`Valid arrangements of the first ${i + 1} positions?`, dp.reduce((a, b) => (a + b) % MOD, 0), 'The new element adds 0 to i inversions; filter by the requirement.'); } return dp.reduce((a, b) => (a + b) % MOD, 0); }
  });

  D('maximize-total-cost-of-alternating-subarrays', {
    t: 'Maximize Total Cost of Alternating Subarrays: add or subtract each',
    r: 'Each element is added or subtracted, but two neighbors cannot both be subtracted (a split restarts with +). add = max(add, sub) + x; sub = add_prev − x.',
    g: R => ({ nums: R.ints(R.int(4, 6), -5, 5) }),
    s(I, T) { let add = I.nums[0], sub = -Infinity; for (let i = 1; i < I.nums.length; i++) { const x = I.nums[i], na = Math.max(add, sub) + x, ns = add - x; T.at({ nums: A(I.nums, { hl: [i] }), add, sub: sub === -Infinity ? '−∞' : sub }); T.n(`Best total with ${x} subtracted?`, ns, `Previous must be added: ${add} − ${x}.`); add = na; sub = ns; } return Math.max(add, sub); }
  });

  D('find-the-maximum-length-of-valid-subsequence-i', {
    t: 'Maximum Length of Valid Subsequence I: three patterns',
    r: 'All adjacent sums share a parity, so the subsequence is all even, all odd, or alternating parity. Count the evens, the odds, and the longest alternating subsequence (greedy).',
    g: R => ({ nums: R.ints(R.int(5, 7), 1, 9) }),
    s(I, T) { const a = I.nums, ev = a.filter(x => x % 2 === 0).length, od = a.length - ev; let alt = 1; for (let i = 1; i < a.length; i++) if (a[i] % 2 !== a[i - 1] % 2) alt++; T.at({ nums: A(a) }); T.n('How many even numbers?', ev, 'All-even pattern.'); T.n('How many odd numbers?', od, 'All-odd pattern.'); T.n('Longest alternating-parity subsequence?', alt, 'Count parity switches + 1.'); return Math.max(ev, od, alt); }
  });

  D('find-the-maximum-length-of-valid-subsequence-ii', {
    t: 'Maximum Length of Valid Subsequence II: last two remainders',
    r: 'Valid means remainders alternate between two values x, y (mod k). dp[x][y] = longest valid subsequence ending in remainder y whose previous is x: dp[prev][cur] = dp[cur][prev] + 1.',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 9), k: R.int(2, 3) }),
    s(I, T) { const k = I.k, dp = mk(k, k, 0); let best = 0; I.nums.forEach((x, i) => { const c = x % k; for (let p = 0; p < k; p++) { dp[p][c] = dp[c][p] + 1; best = Math.max(best, dp[p][c]); } T.at({ nums: A(I.nums, { hl: [i] }), dp: G(dp, { rh: [...Array(k).keys()].map(r => 'prev ' + r), ch: [...Array(k).keys()].map(r => 'cur ' + r) }) }); T.n(`Best length so far (after ${x}, remainder ${c})?`, best, 'dp[p][c] = dp[c][p] + 1 for every p.'); }); return best; }
  });

  D('maximum-array-hopping-score-i', {
    t: 'Maximum Array Hopping Score I: hop to j earns (j − i) times nums[j]',
    r: 'dp[j] = max over i < j of dp[i] + (j − i) times nums[j]. (Greedy: always hop to the largest value to the right.)',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 9) }),
    s(I, T) { const a = I.nums, dp = [0]; for (let j = 1; j < a.length; j++) { let b = -Infinity; for (let i = 0; i < j; i++) b = Math.max(b, dp[i] + (j - i) * a[j]); T.at({ nums: A(a, { hl: [j] }), dp: A(dp.concat('?')) }); T.n(`dp[${j}]?`, b, 'Best earlier landing plus (j − i) times nums[j].'); dp.push(b); } return dp[a.length - 1]; }
  });

  D('construct-string-with-minimum-cost', { t: 'Construct String With Minimum Cost: DP over target prefixes', r: 'dp[i] = cheapest way to build target[0 to i). From every reachable i, append each word that matches target at i (Aho-Corasick or hashing in the fast version).', g: genBuild, s: build });
  D('construct-string-with-minimum-cost-easy', { t: 'Construct String With Minimum Cost (Easy): DP over target prefixes', r: 'dp[i] = cheapest way to build target[0 to i). From each reachable i, try every word that matches target starting at i.', g: genBuild, s: build });

  D('minimum-cost-for-cutting-cake-i', {
    t: 'Minimum Cost for Cutting Cake I: expensive cuts first',
    r: 'Sort both cut lists descending. Repeatedly make the more expensive next cut; it is paid once per piece across the other direction (pieces = cuts made in the other direction + 1).',
    g: R => { const m = R.int(2, 4), n = R.int(2, 4); return { m, n, horizontalCut: R.ints(m - 1, 1, 9), verticalCut: R.ints(n - 1, 1, 9) }; },
    s(I, T) { const h = I.horizontalCut.slice().sort((a, b) => b - a), v = I.verticalCut.slice().sort((a, b) => b - a); let i = 0, j = 0, tot = 0; while (i < h.length || j < v.length) { const hor = j >= v.length || (i < h.length && h[i] >= v[j]); const c = hor ? h[i] * (j + 1) : v[j] * (i + 1); T.at({ horizontal: A(h, { i }), vertical: A(v, { i: j }), total: tot }); T.n(`Cost of the next ${hor ? 'horizontal' : 'vertical'} cut (${hor ? h[i] : v[j]})?`, c, `${hor ? h[i] : v[j]} times ${hor ? j + 1 : i + 1} pieces.`); tot += c; if (hor) i++; else j++; } return tot; }
  });

  D('maximum-score-from-grid-operations', {
    t: 'Maximum Score From Grid Operations: column heights',
    r: 'Each column is painted black from the top down to some height. A white cell scores if a horizontally adjacent cell is black. The full DP walks columns keeping the last two heights; here, score configurations directly.',
    g: R => ({ grid: R.grid(3, 3, 0, 5) }),
    s(I, T) {
      const g = I.grid, n = g.length, score = h => { let s = 0; for (let c = 0; c < n; c++) for (let r = 0; r < n; r++) if (r >= h[c] && ((c && h[c - 1] > r) || (c < n - 1 && h[c + 1] > r))) s += g[r][c]; return s; };
      const sample = [[1, 0, 2], [0, 3, 0]].map(h => h.slice(0, n)); sample.forEach(h => { T.at({ grid: G(g, { hl: h.flatMap((v, c) => [...Array(v).keys()].map(r => [r, c])) }), heights: A(h) }); T.n('Score with these black heights?', score(h), 'Sum white cells next to a black cell.'); });
      let best = 0; const h = Array(n).fill(0), rec = c => { if (c === n) { best = Math.max(best, score(h)); return; } for (let v = 0; v <= n; v++) { h[c] = v; rec(c + 1); } }; rec(0); T.at({ grid: G(g) }); T.n('Best possible score?', best, 'Search over every column height.'); return best;
    }
  });

  D('minimum-operations-to-make-array-equal-to-target', {
    t: 'Minimum Operations to Make Array Equal to Target: climb the differences',
    r: 'd[i] = target[i] − nums[i]. Pay the new height whenever |d| rises in the same direction (|d[i]| − |d[i−1]|) or the sign flips (|d[i]|). Sum it.',
    g: R => { const n = R.int(3, 5); return { nums: R.ints(n, 1, 6), target: R.ints(n, 1, 6) }; },
    s(I, T) { const d = I.nums.map((x, i) => I.target[i] - x); let tot = 0; d.forEach((x, i) => { const p = i ? d[i - 1] : 0, c = (x > 0) === (p > 0) && p !== 0 && x !== 0 ? Math.max(0, Math.abs(x) - Math.abs(p)) : Math.abs(x); T.at({ diff: A(d, { hl: [i] }), total: tot }); T.n(`New operations needed at index ${i}?`, c, (x > 0) === (p > 0) && p !== 0 ? 'Same direction: only the extra height.' : 'Direction changes (or starts): the full height.'); tot += c; }); return tot; }
  });

  D('number-of-subsequences-with-odd-sum', {
    t: 'Number of Subsequences With Odd Sum: even and odd counts',
    r: 'odd and even = subsequences with odd or even sum so far. An odd x: odd\' = odd + even + 1, even\' = even + odd. An even x: odd\' = 2 times odd, even\' = 2 times even + 1.',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 6) }),
    s(I, T) { let o = 0, e = 0; I.nums.forEach((x, i) => { const no = x % 2 ? (o + e + 1) % MOD : 2 * o % MOD, ne = x % 2 ? (e + o) % MOD : (2 * e + 1) % MOD; T.at({ nums: A(I.nums, { hl: [i] }), odd: o, even: e }); T.n(`After ${x}: odd-sum subsequences?`, no, x % 2 ? 'An odd number flips parity: odd + even + 1.' : 'An even number keeps parity: odd doubles.'); o = no; e = ne; }); return o; }
  });

  const mono = (I, T) => { const a = I.nums; let dp = Array(a[0] + 1).fill(1); for (let i = 1; i < a.length; i++) { const d = Math.max(0, a[i] - a[i - 1]), pre = []; dp.reduce((s, v, k) => (pre[k] = (s + v) % MOD, pre[k]), 0); dp = [...Array(a[i] + 1).keys()].map(v => v - d >= 0 ? pre[Math.min(v - d, pre.length - 1)] : 0); T.at({ nums: A(a, { hl: [i] }), shift: d }); T.n(`Through index ${i}: monotonic pairs so far?`, dp.reduce((x, y) => (x + y) % MOD, 0), `arr1[${i}] = v takes every u at most v − ${d}.`); } return dp.reduce((x, y) => (x + y) % MOD, 0); };
  D('find-the-count-of-monotonic-pairs-i', { t: 'Count of Monotonic Pairs I: arr1 rises, arr2 falls', r: 'Pick arr1[i] = v (arr2[i] = nums[i] − v). Need u at most v and nums[i−1] − u at least nums[i] − v, i.e. u at most v − max(0, nums[i] − nums[i−1]). dp with prefix sums over v.', g: R => ({ nums: R.ints(R.int(2, 4), 1, 5) }), s: mono });
  D('find-the-count-of-monotonic-pairs-ii', { t: 'Count of Monotonic Pairs II: the same DP with prefix sums', r: 'dp[i][v] = the sum of dp[i−1][u] for u at most v − max(0, nums[i] − nums[i−1]); prefix sums make each row O(max value).', g: R => ({ nums: R.ints(R.int(3, 4), 1, 6) }), s: mono });

  D('maximum-value-sum-by-placing-three-rooks-i', { t: 'Three Rooks I: distinct rows and columns', r: 'Only the top 3 cells of each row can matter. Try triples of rows with their top-3 candidates, keeping columns distinct.', g: R => ({ board: R.grid(3, R.int(3, 4), -3, 6) }), s: rooks });
  D('maximum-value-sum-by-placing-three-rooks-ii', { t: 'Three Rooks II: prune to the top cells', r: 'Keep the top 3 cells per row (and per column), then search the few remaining candidates for three non-attacking rooks.', g: R => ({ board: R.grid(R.int(3, 4), 3, -3, 6) }), s: rooks });

  D('maximum-energy-boost-from-two-drinks', {
    t: 'Maximum Energy Boost From Two Drinks: switching costs an hour',
    r: 'A[i] = best ending with drink A at hour i = a[i] + max(A[i−1], B[i−2]) (switching skips an hour). Same for B.',
    g: R => { const n = R.int(3, 6); return { energyDrinkA: R.ints(n, 1, 9), energyDrinkB: R.ints(n, 1, 9) }; },
    s(I, T) { const a = I.energyDrinkA, b = I.energyDrinkB, n = a.length, A2 = [], B2 = []; for (let i = 0; i < n; i++) { A2.push(a[i] + Math.max(i ? A2[i - 1] : 0, i > 1 ? B2[i - 2] : 0)); B2.push(b[i] + Math.max(i ? B2[i - 1] : 0, i > 1 ? A2[i - 2] : 0)); T.at({ A: A(a, { hl: [i] }), B: A(b, { hl: [i] }) }); T.n(`Best total drinking A at hour ${i}?`, A2[i], 'Stay on A, or switch from B two hours back.'); } return Math.max(A2[n - 1], B2[n - 1]); }
  });

  D('find-the-largest-palindrome-divisible-by-k', {
    t: 'Largest Palindrome Divisible by k: greedy digits with a remainder DP',
    r: 'Fill mirrored digit pairs from the outside in. reach[i][r] says whether the inner pairs can make the total a multiple of k. Pick the largest digit for each pair that keeps a zero remainder reachable.',
    g: R => ({ n: R.int(1, 4), k: R.int(2, 9) }),
    s(I, T) {
      const n = I.n, k = I.k, h = Math.ceil(n / 2), p10 = [1]; for (let i = 1; i < n; i++) p10.push(p10[i - 1] * 10 % k); const w = [...Array(h).keys()].map(i => i === n - 1 - i ? p10[i] : (p10[i] + p10[n - 1 - i]) % k);
      const R2 = Array.from({ length: h + 1 }, () => Array(k).fill(false)); for (let r = 0; r < k; r++) R2[h][r] = r === 0; for (let i = h - 1; i >= 0; i--) for (let r = 0; r < k; r++) for (let d = (i === 0 ? 1 : 0); d <= 9; d++) if (R2[i + 1][(r + d * w[i]) % k]) { R2[i][r] = true; break; }
      T.at({ n, k }); T.n('Digit positions to choose (half the length, rounded up)?', h, 'The other half mirrors them.'); const digs = []; let r = 0; for (let i = 0; i < h; i++) { let pick = -1; for (let d = 9; d >= (i === 0 ? 1 : 0); d--) if (R2[i + 1][(r + d * w[i]) % k]) { pick = d; break; } T.at({ n, k, sofar: digs.join('') || '""' }); T.n(`Digit for position ${i} (and its mirror)?`, pick, 'Largest digit that keeps a multiple of k reachable.'); digs.push(pick); r = (r + pick * w[i]) % k; }
      T.at({ n, k, digits: digs.join('') }); T.n('Remainder of the palindrome divided by k?', r, 'Every pick kept a multiple of k reachable.'); const left = digs.join(''); return left + left.slice(0, n - h).split('').reverse().join('');
    }
  });

  D('constructing-two-increasing-arrays', {
    t: 'Constructing Two Increasing Arrays: smallest next number with the right parity',
    r: '0 becomes an even positive number, 1 an odd one; both arrays increase and all numbers are distinct. dp[i][j] = smallest possible largest number after the first i of nums1 and j of nums2: take the next value > dp from either array.',
    g: R => ({ nums1: Array.from({ length: R.int(0, 3) }, () => R.int(0, 1)), nums2: Array.from({ length: R.int(1, 3) }, () => R.int(0, 1)) }),
    s(I, T) { const a = I.nums1, b = I.nums2, nx = (x, bit) => { let y = x + 1; if (y % 2 !== bit) y++; return y; }, dp = mk(a.length + 1, b.length + 1, Infinity); dp[0][0] = 0; for (let i = 0; i <= a.length; i++) for (let j = 0; j <= b.length; j++) { if (i) dp[i][j] = Math.min(dp[i][j], nx(dp[i - 1][j], a[i - 1])); if (j) dp[i][j] = Math.min(dp[i][j], nx(dp[i][j - 1], b[j - 1])); if (i + j) { T.at({ dp: G(dp.map(r => r.map(v => v === Infinity ? '?' : v)), { rh: ['', ...a], ch: ['', ...b], hl: [[i, j]] }) }); T.n(`dp[${i}][${j}]?`, dp[i][j], 'Smallest next value with the needed parity, from either array.'); } } return dp[a.length][b.length]; }
  });

  D('select-cells-in-grid-with-maximum-score', {
    t: 'Select Cells With Maximum Score: values high to low, mask of used rows',
    r: 'Distinct values, at most one per row. Go through values in decreasing order; dp[mask] = best sum using the rows in mask. A value can be placed in any unused row that contains it.',
    g: R => ({ grid: R.grid(R.int(2, 3), 3, 1, 6) }),
    s(I, T) { const g = I.grid, m = g.length, vals = [...new Set(g.flat())].sort((a, b) => b - a); let dp = new Map([[0, 0]]); for (const v of vals) { const rows = g.map((r, i) => r.includes(v) ? i : -1).filter(i => i >= 0), nx = new Map(dp); for (const [mask, s] of dp) for (const r of rows) if (!(mask >> r & 1)) nx.set(mask | 1 << r, Math.max(nx.get(mask | 1 << r) || 0, s + v)); dp = nx; T.at({ grid: G(g, { hl: g.flatMap((r, i) => r.map((x, c) => x === v ? [i, c] : null)).filter(Boolean) }), value: v }); T.n(`After value ${v}: best score so far?`, Math.max(...dp.values()), 'Place it in any free row containing it, or skip it.'); } return Math.max(...dp.values()); }
  });

  D('maximum-xor-score-subarray-queries', {
    t: 'Maximum XOR Score Subarray Queries: a Pascal-like XOR table',
    r: 'score[l][r] = score[l][r−1] XOR score[l+1][r] (the repeated-XOR reduction). best[l][r] = max(score[l][r], best[l][r−1], best[l+1][r]). Answer each query from best.',
    g: R => ({ nums: R.ints(R.int(3, 5), 0, 9), queries: [[0, 2], [1, 3], [0, 3]] }),
    s(I, T) { const a = I.nums, n = a.length, sc = mk(n, n, 0), be = mk(n, n, 0); for (let i = 0; i < n; i++) sc[i][i] = be[i][i] = a[i]; for (let len = 2; len <= n; len++) for (let l = 0; l + len <= n; l++) { const r = l + len - 1; sc[l][r] = sc[l][r - 1] ^ sc[l + 1][r]; be[l][r] = Math.max(sc[l][r], be[l][r - 1], be[l + 1][r]); if (len <= 3) { T.at({ nums: A(a, { win: [l, r] }) }); T.n(`score[${l}][${r}]?`, sc[l][r], `${sc[l][r - 1]} XOR ${sc[l + 1][r]}.`); } } return I.queries.filter(([l, r]) => r < n).map(([l, r]) => be[l][r]); }
  });

  D('maximum-number-of-moves-to-kill-all-pawns', {
    t: 'Maximum Moves to Kill All Pawns: knight distances + minimax',
    r: 'BFS gives knight distances between the knight and every pawn. Players alternately pick a pawn to capture: Alice maximizes total moves, Bob minimizes. Memoize on (position, remaining pawns).',
    g: R => ({ kx: R.int(0, 5), ky: R.int(0, 5), positions: R.distinct(R.int(1, 3), 0, 35).map(v => [v % 6, Math.floor(v / 6)]) }),
    s(I, T) {
      const P = I.positions.filter(p => !(p[0] === I.kx && p[1] === I.ky)), pts = [[I.kx, I.ky], ...P], N = 50, bfs = ([x, y]) => { const d = Array.from({ length: N }, () => Array(N).fill(-1)); d[x][y] = 0; const q = [[x, y]]; for (let h = 0; h < q.length; h++) { const [a, b] = q[h]; for (const [dx, dy] of [[1, 2], [2, 1], [-1, 2], [-2, 1], [1, -2], [2, -1], [-1, -2], [-2, -1]]) { const u = a + dx, v = b + dy; if (u >= 0 && v >= 0 && u < N && v < N && d[u][v] < 0) { d[u][v] = d[a][b] + 1; q.push([u, v]); } } } return d; };
      const dist = pts.map(p => { const d = bfs(p); return pts.map(([x, y]) => d[x][y]); });
      P.forEach((p, i) => { T.at({ knight: `(${I.kx},${I.ky})`, pawn: `(${p})` }); T.n(`Knight moves from the start to pawn (${p})?`, dist[0][i + 1], 'BFS on the board.'); });
      const n = P.length, memo = new Map(), f = (at, m) => { if (m === (1 << n) - 1) return 0; const k = at * 1e5 + m; if (memo.has(k)) return memo.get(k); const alice = pc(m) % 2 === 0; let b = alice ? -Infinity : Infinity; for (let i = 0; i < n; i++) if (!(m >> i & 1)) { const v = dist[at][i + 1] + f(i + 1, m | 1 << i); b = alice ? Math.max(b, v) : Math.min(b, v); } memo.set(k, b); return b; };
      const res = f(0, 0); T.n('Total moves under optimal play?', res, 'Alice maximizes, Bob minimizes, alternating.'); return res;
    }
  });
})();
