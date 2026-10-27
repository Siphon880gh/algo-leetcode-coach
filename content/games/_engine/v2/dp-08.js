/* v2 games: dynamic programming (8). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const pc = m => { let c = 0; while (m) { c += m & 1; m >>= 1; } return c; };
  const gcd = (a, b) => b ? gcd(b, a % b) : a;

  D('longest-palindromic-subsequence-ii', {
    t: 'Longest Palindromic Subsequence II: even length, no repeated neighbors',
    r: 'dp[i][j] = (length, outer letter) of the best good palindrome in s[i to j]. If s[i] == s[j] and differs from the inner best\'s outer letter, wrap it: length + 2. Otherwise take the better of dropping either end.',
    g: R => ({ s: R.str(R.int(4, 6), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, L = mk(n, n, 0), C = mk(n, n, ''); for (let len = 2; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1, inL = len > 2 ? L[i + 1][j - 1] : 0, inC = len > 2 ? C[i + 1][j - 1] : ''; if (s[i] === s[j] && s[i] !== inC) { L[i][j] = inL + 2; C[i][j] = s[i]; } else if (L[i + 1][j] >= L[i][j - 1]) { L[i][j] = L[i + 1][j]; C[i][j] = C[i + 1][j]; } else { L[i][j] = L[i][j - 1]; C[i][j] = C[i][j - 1]; } T.at({ s: A([...s], { win: [i, j] }) }); T.n(`Best good palindrome length in "${s.slice(i, j + 1)}"?`, L[i][j], s[i] === s[j] && s[i] !== inC ? 'Equal ends that differ from the inner outer letter: wrap.' : 'Drop one end.'); } return L[0][n - 1]; }
  });

  D('delivering-boxes-from-storage-to-ports', {
    t: 'Delivering Boxes: which boxes ride on the last trip?',
    r: 'dp[i] = fewest trips for the first i boxes. The last trip carries boxes j to i−1 if they fit the box and weight limits: dp[j] + (port changes inside) + 2 (first stop and the return).',
    g: R => ({ boxes: Array.from({ length: R.int(4, 5) }, () => [R.int(1, 3), R.int(1, 3)]), portsCount: 3, maxBoxes: R.int(2, 3), maxWeight: R.int(3, 6) }),
    s(I, T) { const b = I.boxes, n = b.length, dp = [0]; for (let i = 1; i <= n; i++) { let best = Infinity, w = 0, ch = 0; for (let j = i - 1; j >= 0 && i - j <= I.maxBoxes; j--) { w += b[j][1]; if (w > I.maxWeight) break; if (j < i - 1 && b[j][0] !== b[j + 1][0]) ch++; best = Math.min(best, dp[j] + ch + 2); } T.at({ boxes: A(b.map(x => `p${x[0]}/w${x[1]}`), { hl: [i - 1] }), dp: A(dp.concat('?')), limits: `${I.maxBoxes} boxes, ${I.maxWeight} weight` }); T.n(`dp[${i}]?`, best, 'Try every last load that fits: dp[j] + port changes + 2.'); dp.push(best); } return dp[n]; }
  });

  D('stone-game-vii', {
    t: 'Stone Game VII: score the remaining sum',
    r: 'dp[i][j] = best difference for the player to move on stones i to j. Removing the left stone scores sum(i+1 to j); removing the right scores sum(i to j−1). Subtract the opponent\'s dp after the move.',
    g: R => ({ stones: R.ints(R.int(3, 5), 1, 9) }),
    s(I, T) { const s = I.stones, n = s.length, P = [0]; s.forEach(x => P.push(P[P.length - 1] + x)); const S = (i, j) => i > j ? 0 : P[j + 1] - P[i], dp = mk(n, n, 0); for (let len = 2; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1; dp[i][j] = Math.max(S(i + 1, j) - dp[i + 1][j], S(i, j - 1) - dp[i][j - 1]); T.at({ stones: A(s, { win: [i, j] }) }); T.n(`dp[${i}][${j}]?`, dp[i][j], `max(${S(i + 1, j)} − ${dp[i + 1][j]}, ${S(i, j - 1)} − ${dp[i][j - 1]}).`); } return dp[0][n - 1]; }
  });

  D('maximum-height-by-stacking-cuboids', {
    t: 'Maximum Height by Stacking Cuboids: sort dims, then LIS',
    r: 'Rotate each cuboid so its dims are sorted (tallest as height). Sort cuboids. dp[i] = height[i] + max dp[j] where every dim of j at most dim of i.',
    g: R => ({ cuboids: Array.from({ length: R.int(3, 4) }, () => R.ints(3, 1, 9)) }),
    s(I, T) { const C = I.cuboids.map(c => c.slice().sort((a, b) => a - b)).sort((a, b) => a[0] - b[0] || a[1] - b[1] || a[2] - b[2]), dp = []; C.forEach((c, i) => { let b = c[2]; for (let j = 0; j < i; j++) if (C[j][0] <= c[0] && C[j][1] <= c[1] && C[j][2] <= c[2]) b = Math.max(b, dp[j] + c[2]); T.at({ cuboids: A(C.map(x => x.join(' by ')), { hl: [i] }), dp: A(dp.concat('?')) }); T.n(`Tallest stack topped by ${c.join(' by ')}?`, b, 'Its height + the best stack it can sit on.'); dp.push(b); }); return Math.max(...dp); }
  });

  D('count-ways-to-distribute-candies', {
    t: 'Count Ways to Distribute Candies: Stirling numbers',
    r: 'dp[i][j] = ways to put i candies in j non-empty unlabeled bags = dp[i−1][j−1] (new bag) + j times dp[i−1][j] (join one of j bags).',
    g: R => { const n = R.int(3, 5); return { n, k: R.int(2, n) }; },
    s(I, T) { const dp = mk(I.n + 1, I.k + 1, 0); dp[0][0] = 1; for (let i = 1; i <= I.n; i++) for (let j = 1; j <= Math.min(i, I.k); j++) { dp[i][j] = (dp[i - 1][j - 1] + j * dp[i - 1][j]) % MOD; if (j > 1 && j < i) { T.at({ dp: G(dp, { rh: dp.map((_, x) => x + ' candies'), ch: dp[0].map((_, x) => x + ' bags'), hl: [[i, j]] }) }); T.n(`dp[${i}][${j}]?`, dp[i][j], `${dp[i - 1][j - 1]} + ${j} times ${dp[i - 1][j]}.`); } } return dp[I.n][I.k]; }
  });

  D('jump-game-vi', {
    t: 'Jump Game VI: best of the last k',
    r: 'dp[i] = nums[i] + max dp[i−k to i−1]. A decreasing deque keeps that window maximum.',
    g: R => ({ nums: R.ints(R.int(5, 7), -6, 8), k: R.int(2, 3) }),
    s(I, T) { const a = I.nums, dp = [a[0]]; for (let i = 1; i < a.length; i++) { const m = Math.max(...dp.slice(Math.max(0, i - I.k))); T.at({ nums: A(a, { hl: [i] }), dp: A(dp.concat('?'), { win: [Math.max(0, i - I.k), i - 1] }) }); T.n(`dp[${i}]?`, a[i] + m, `${a[i]} + best in the window (${m}).`); dp.push(a[i] + m); } return dp[a.length - 1]; }
  });

  D('sum-of-special-evenly-spaced-elements-in-array', {
    t: 'Sum of Special Evenly-Spaced Elements: step through the array',
    r: 'Query [x, y] sums nums[x], nums[x + y], nums[x + 2y], … For small y, precomputed suffix sums per step make it O(1); large y walks few elements.',
    g: R => ({ nums: R.ints(R.int(6, 8), 0, 9), queries: Array.from({ length: 3 }, () => [R.int(0, 5), R.int(1, 3)]) }),
    s(I, T) { return I.queries.map(([x, y]) => { let s = 0; const idx = []; for (let j = x; j < I.nums.length; j += y) { s += I.nums[j]; idx.push(j); } T.at({ nums: A(I.nums, { hl: idx }) }); T.n(`Query [${x}, ${y}]: sum?`, s % MOD, `Indices ${idx.join(', ')}.`); return s % MOD; }); }
  });

  D('palindrome-partitioning-iv', {
    t: 'Palindrome Partitioning IV: three palindromes',
    r: 'Precompute isPal[i][j]. Try every pair of cuts (i, j): s[0 to i], s[i+1 to j], s[j+1..] must all be palindromes.',
    g: R => ({ s: R.str(R.int(5, 7), 'ab') }),
    s(I, T) { const res = (() => { const s = I.s, n = s.length, p = (i, j) => { while (i < j) if (s[i++] !== s[j--]) return false; return true; }; T.at({ s: A([...s]) }); T.n('Length of s?', n, 'Each of the three parts needs at least one letter.'); for (let i = 0; i < n - 2; i++) if (p(0, i)) { let ok = false; for (let j = i + 1; j < n - 1; j++) if (p(i + 1, j) && p(j + 1, n - 1)) ok = true; T.at({ s: A([...s], { win: [0, i] }) }); T.yn(`First part "${s.slice(0, i + 1)}" (a palindrome): can the rest split into two palindromes?`, ok, 'Try every second cut.'); if (ok) return true; } return false; })(); T.yn('Can s split into three palindromes?', res, 'Some first cut and second cut both work.'); return res; }
  });

  D('maximum-subarray-sum-after-one-operation', {
    t: 'Max Subarray Sum After One Squaring: used or not used',
    r: 'no = best sum ending here with no square used (Kadane); yes = best ending here with the square used = max(no_prev + x², yes_prev + x, x²).',
    g: R => ({ nums: R.ints(R.int(4, 6), -4, 4) }),
    s(I, T) { let no = 0, yes = -Infinity, best = -Infinity; I.nums.forEach((x, i) => { const ny = Math.max(no + x * x, yes + x, x * x), nn = Math.max(no + x, x); T.at({ nums: A(I.nums, { hl: [i] }), no, yes: yes === -Infinity ? '−∞' : yes }); T.n(`Best sum ending at ${i} with the square used?`, ny, `max(${no} + ${x * x}, ${yes === -Infinity ? '−∞' : yes} + ${x}, ${x * x}).`); no = Math.max(nn, 0); yes = ny; best = Math.max(best, yes); }); return best; }
  });

  D('maximum-absolute-sum-of-any-subarray', {
    t: 'Maximum Absolute Sum: Kadane both ways',
    r: 'Track the largest and the smallest sum ending at each index. The answer is max(best max, −best min).',
    g: R => ({ nums: R.ints(R.int(5, 7), -5, 5) }),
    s(I, T) { let hi = 0, lo = 0, best = 0; I.nums.forEach((x, i) => { hi = Math.max(x, hi + x); lo = Math.min(x, lo + x); T.at({ nums: A(I.nums, { hl: [i] }), best }); T.n(`Largest |sum| of a subarray ending at ${i}?`, Math.max(hi, -lo), `max(${hi}, ${-lo}).`); best = Math.max(best, hi, -lo); }); return best; }
  });

  D('maximum-number-of-events-that-can-be-attended-ii', {
    t: 'Max Events Attended II: k picks, sorted by end',
    r: 'Sort events by end. dp[c][i] = best value using the first i events and at most c attendances = max(skip: dp[c][i−1], take: value + dp[c−1][last event ending before this start]).',
    g: R => ({ events: Array.from({ length: R.int(3, 5) }, () => { const s = R.int(1, 8); return [s, s + R.int(0, 3), R.int(1, 9)]; }), k: R.int(1, 3) }),
    s(I, T) {
      const E = I.events.slice().sort((a, b) => a[1] - b[1]), n = E.length, prev = E.map(([s], i) => { let j = i - 1; while (j >= 0 && E[j][1] >= s) j--; return j + 1; });
      let dp = Array(n + 1).fill(0); for (let c = 1; c <= I.k; c++) { const nx = [0]; for (let i = 1; i <= n; i++) nx.push(Math.max(nx[i - 1], E[i - 1][2] + dp[prev[i - 1]])); dp = nx; T.at({ events: A(E.map(e => `${e[0]}-${e[1]}:${e[2]}`)), picks: c }); T.n(`Best total with at most ${c} events?`, dp[n], 'Skip or take each event (sorted by end).'); }
      return dp[n];
    }
  });

  D('closest-subsequence-sum', {
    t: 'Closest Subsequence Sum: meet in the middle',
    r: 'Split nums in half. List every subset sum of each half. Sort the right sums; for each left sum, binary search the right sum closest to goal − left.',
    g: R => ({ nums: R.ints(R.int(4, 6), -7, 9), goal: R.int(-5, 15) }),
    s(I, T) {
      const h = I.nums.length >> 1, sums = a => a.reduce((s, x) => s.concat(s.map(v => v + x)), [0]), L = sums(I.nums.slice(0, h)), Rs = sums(I.nums.slice(h)).sort((a, b) => a - b);
      T.at({ left: A(I.nums.slice(0, h)), right: A(I.nums.slice(h)) }); T.n('How many subset sums does the right half have (with repeats)?', Rs.length, `2 to the power ${I.nums.length - h}.`);
      let best = Infinity; for (const l of [...new Set(L)].slice(0, 6)) { let b = Infinity; for (const r of Rs) b = Math.min(b, Math.abs(l + r - I.goal)); T.at({ 'left sum': l, goal: I.goal, 'right sums': A(Rs) }); T.n(`Left sum ${l}: closest |total − goal|?`, b, `Look for the right sum nearest ${I.goal - l}.`); best = Math.min(best, b); }
      for (const l of L) for (const r of Rs) best = Math.min(best, Math.abs(l + r - I.goal)); return best;
    }
  });

  D('maximum-score-from-performing-multiplication-operations', {
    t: 'Max Score from Multiplication Operations: left or right end?',
    r: 'f(i, l) = best score from operation i with l numbers taken from the left (so i − l from the right). Take nums[l] or nums[n − 1 − (i − l)] times multipliers[i].',
    g: R => ({ nums: R.ints(R.int(3, 5), -5, 6), multipliers: R.ints(R.int(2, 3), -3, 4) }),
    s(I, T) {
      const a = I.nums, m = I.multipliers, n = a.length, M = m.length, memo = new Map(), f = (i, l) => { if (i === M) return 0; const k = i * 1000 + l; if (memo.has(k)) return memo.get(k); const v = Math.max(a[l] * m[i] + f(i + 1, l + 1), a[n - 1 - (i - l)] * m[i] + f(i + 1, l)); memo.set(k, v); return v; };
      let l = 0; for (let i = 0; i < M; i++) { const L = a[l] * m[i] + f(i + 1, l + 1), Rt = a[n - 1 - (i - l)] * m[i] + f(i + 1, l), ok = []; if (L === f(i, l)) ok.push('L'); if (Rt === f(i, l)) ok.push('R');
        T.at({ nums: A(a, { win: [l, n - 1 - (i - l)] }), multiplier: m[i] }); T.k(`Operation ${i} (multiplier ${m[i]}): take from which end (optimal)?`, [['L', 'left ' + a[l]], ['R', 'right ' + a[n - 1 - (i - l)]]], ok, `Left leads to ${L}, right to ${Rt}.`); if (ok[0] === 'L') l++; }
      return f(0, 0);
    }
  });

  D('maximize-palindrome-length-from-subsequences', {
    t: 'Maximize Palindrome Length From Subsequences: an outer pair must cross',
    r: 'Run longest-palindromic-subsequence DP on word1 + word2. Only count dp[i][j] + 2 when s[i] == s[j] with i in word1 and j in word2, so both parts are non-empty.',
    g: R => ({ word1: R.str(R.int(2, 3), 'abc'), word2: R.str(R.int(2, 3), 'abc') }),
    s(I, T) {
      const s = I.word1 + I.word2, n = s.length, w = I.word1.length, dp = mk(n + 1, n + 1, 0); let best = 0;
      for (let i = n - 1; i >= 0; i--) { dp[i][i] = 1; for (let j = i + 1; j < n; j++) { if (s[i] === s[j]) { dp[i][j] = dp[i + 1][j - 1] + 2; if (i < w && j >= w) best = Math.max(best, dp[i][j]); } else dp[i][j] = Math.max(dp[i + 1][j], dp[i][j - 1]); } }
      T.at({ combined: A([...s], { win: [0, w - 1] }) }); T.n('Longest palindromic subsequence of the combined string?', dp[0][n - 1], 'Plain LPS (it might not cross).');
      for (let i = 0; i < w; i++) for (let j = n - 1; j >= w; j--) if (s[i] === s[j]) { T.at({ combined: A([...s], { hl: [i, j] }) }); T.n(`Outer pair word1[${i}] and word2[${j - w}]: palindrome length?`, dp[i][j], 'LPS strictly inside + 2.'); }
      return best;
    }
  });

  D('make-the-xor-of-all-segments-equal-to-zero', {
    t: 'Make the XOR of All Segments Zero: one value per residue class',
    r: 'All indices with the same i mod k must hold the same value, and the k values must XOR to 0. dp[x] = fewest changes for the first groups with XOR x. A group either keeps one of its values v (dp[x ^ v] + size − count[v]) or changes all (min dp + size).',
    g: R => ({ nums: R.ints(R.int(4, 6), 0, 3), k: R.int(1, 3) }),
    s(I, T) {
      let B = 1; while (B <= Math.max(...I.nums)) B <<= 1; let dp = Array(B).fill(Infinity); dp[0] = 0;
      for (let g = 0; g < I.k; g++) { const vals = I.nums.filter((_, i) => i % I.k === g), cnt = {}; vals.forEach(v => cnt[v] = (cnt[v] || 0) + 1); const lo = Math.min(...dp), nx = Array(B).fill(lo + vals.length);
        for (let x = 0; x < B; x++) for (const v in cnt) nx[x] = Math.min(nx[x], dp[x ^ +v] + vals.length - cnt[v]); dp = nx;
        T.at({ group: A(vals, { label: `indices ≡ ${g} (mod ${I.k})` }), dp: A(dp.map(v => v === Infinity ? '∞' : v), { labels: dp.map((_, x) => 'xor ' + x) }) }); T.n(`After group ${g}: fewest changes so far for XOR 0?`, dp[0], 'Keep a common value, or change the whole group.'); }
      return dp[0];
    }
  });

  D('maximize-score-after-n-operations', {
    t: 'Maximize Score After N Operations: later operations weigh more',
    r: 'f(mask) = best score with the numbers in mask used; operation number = pairs used + 1. Try every free pair: op times gcd(a, b), plus f of the mask with that pair added.',
    g: R => ({ nums: R.ints(2 * R.int(1, 2), 1, 12) }),
    s(I, T) {
      const a = I.nums, n = a.length, full = (1 << n) - 1, memo = new Map(), f = m => { if (m === full) return 0; if (memo.has(m)) return memo.get(m); const op = pc(m) / 2 + 1; let b = 0; for (let i = 0; i < n; i++) if (!(m >> i & 1)) for (let j = i + 1; j < n; j++) if (!(m >> j & 1)) b = Math.max(b, op * gcd(a[i], a[j]) + f(m | 1 << i | 1 << j)); memo.set(m, b); return b; };
      T.at({ nums: A(a) }); T.n('Operations to perform?', n / 2, 'Each removes two numbers.'); let m = 0; while (m !== full) { const op = pc(m) / 2 + 1, opts = [], ok = []; for (let i = 0; i < n; i++) if (!(m >> i & 1)) for (let j = i + 1; j < n; j++) if (!(m >> j & 1)) { const k = i + '-' + j; opts.push([k, `${a[i]} & ${a[j]} (gcd ${gcd(a[i], a[j])})`]); if (op * gcd(a[i], a[j]) + f(m | 1 << i | 1 << j) === f(m)) ok.push(k); }
        T.at({ nums: A(a, { dim: a.map((_, i) => m >> i & 1 ? i : -1).filter(i => i >= 0) }), op }); T.k(`Operation ${op}: which pair (optimal)?`, opts, ok, `The best remaining score is ${f(m)}.`); const [i, j] = ok[0].split('-').map(Number); m |= 1 << i | 1 << j; }
      T.at({ nums: A(a) }); T.n('Maximum score?', f(0), 'Sum of op times gcd over the optimal pairs.'); return f(0);
    }
  });

  D('maximum-number-of-groups-getting-fresh-donuts', {
    t: 'Fresh Donuts: only remainders matter',
    r: 'A group is happy if it starts a fresh batch (leftover 0). Replace each group size by size mod batchSize. Remainder-0 groups are always happy; complementary pairs (r, b − r) make one happy each; memoize the rest on remainder counts.',
    g: R => ({ batchSize: R.int(2, 4), groups: R.ints(R.int(4, 6), 1, 9) }),
    s(I, T) {
      const b = I.batchSize, cnt = Array(b).fill(0); I.groups.forEach(g => cnt[g % b]++);
      T.at({ batch: b, remainders: A(I.groups.map(g => g % b)) }); T.n('Groups with remainder 0 (always happy)?', cnt[0], 'Their size is a multiple of the batch size.'); T.n('Groups with a non-zero remainder?', I.groups.length - cnt[0], 'These need a good order.');
      const memo = new Map(), f = (c, left) => { const k = c.join(',') + '|' + left; if (memo.has(k)) return memo.get(k); let best = 0; for (let r = 1; r < b; r++) if (c[r]) { c[r]--; best = Math.max(best, (left === 0 ? 1 : 0) + f(c, (left + r) % b)); c[r]++; } memo.set(k, best); return best; };
      const res = cnt[0] + f(cnt.slice().map((v, i) => i ? v : 0), 0); T.n('Maximum happy groups?', res, 'Remainder-0 groups plus the best ordering of the rest.'); return res;
    }
  });

  D('minimum-sideway-jumps', {
    t: 'Minimum Sideway Jumps: best per lane at each point',
    r: 'dp[lane] = fewest side jumps to stand in that lane at point i. An obstacle makes its lane ∞. Then any open lane can be reached from the best open lane with +1.',
    g: R => { const n = R.int(5, 7), o = [0]; for (let i = 1; i < n; i++) o.push(R.chance(0.6) ? R.int(1, 3) : 0); o.push(0); return { obstacles: o }; },
    s(I, T) { let dp = [1, 0, 1]; for (let i = 1; i < I.obstacles.length; i++) { const o = I.obstacles[i]; if (o) dp[o - 1] = Infinity; const m = Math.min(...dp); dp = dp.map((v, l) => o === l + 1 ? Infinity : Math.min(v, m + 1)); T.at({ obstacles: A(I.obstacles, { hl: [i] }), lanes: A(dp.map(v => v === Infinity ? '∞' : v), { labels: ['lane 1', 'lane 2', 'lane 3'] }) }); T.n(`Point ${i}: fewest side jumps to be here in any lane?`, Math.min(...dp), 'Block the obstacle lane, then allow a side jump from the best lane.'); } return Math.min(...dp); }
  });

  D('number-of-ways-to-rearrange-sticks-with-k-sticks-visible', {
    t: 'Rearrange Sticks with k Visible: place the shortest stick',
    r: 'dp[n][k]: put the shortest stick first (it is visible: dp[n−1][k−1]) or anywhere else, hidden behind a taller one ((n − 1) times dp[n−1][k]).',
    g: R => { const n = R.int(3, 5); return { n, k: R.int(1, n) }; },
    s(I, T) { const dp = mk(I.n + 1, I.k + 1, 0); dp[0][0] = 1; for (let i = 1; i <= I.n; i++) for (let j = 1; j <= I.k; j++) { dp[i][j] = (dp[i - 1][j - 1] + (i - 1) * dp[i - 1][j]) % MOD; if (j < i && j > 0 && i > 1) { T.at({ dp: G(dp, { rh: dp.map((_, x) => 'n=' + x), ch: dp[0].map((_, x) => 'k=' + x), hl: [[i, j]] }) }); T.n(`dp[${i}][${j}]?`, dp[i][j], `${dp[i - 1][j - 1]} + ${i - 1} times ${dp[i - 1][j]}.`); } } return dp[I.n][I.k]; }
  });

  D('jump-game-vii', {
    t: 'Jump Game VII: count reachable spots in the window',
    r: 'Index i ("0") is reachable if some reachable index lies in [i − maxJump, i − minJump]. Keep a running count of reachable indices in that sliding window.',
    g: R => ({ s: '0' + R.str(R.int(5, 7), '001') + '0', minJump: R.int(1, 2), maxJump: R.int(2, 3) }),
    s(I, T) { const s = I.s, n = s.length, ok = Array(n).fill(false); ok[0] = true; for (let i = 1; i < n; i++) { if (s[i] === '1') continue; for (let j = Math.max(0, i - I.maxJump); j <= i - I.minJump; j++) if (ok[j]) ok[i] = true; T.at({ s: A([...s], { hl: [i], win: [Math.max(0, i - I.maxJump), Math.max(0, i - I.minJump)] }), reach: A(ok.map((v, j) => j < i ? (v ? 'Y' : '-') : '?')) }); T.yn(`Is index ${i} reachable?`, ok[i], 'Is any reachable index in the window?'); } return ok[n - 1]; }
  });

  D('stone-game-viii', {
    t: 'Stone Game VIII: every move scores a prefix sum',
    r: 'Each move scores some prefix sum P[i] (i at least 1). dp from the right: dp = P[n−1]; for i = n−2 down to 1: dp = max(dp, P[i] − dp).',
    g: R => ({ stones: R.ints(R.int(3, 6), -5, 8) }),
    s(I, T) { const P = []; I.stones.reduce((s, x) => (P.push(s + x), s + x), 0); const n = P.length; let dp = P[n - 1]; for (let i = n - 2; i >= 1; i--) { const v = Math.max(dp, P[i] - dp); T.at({ prefix: A(P, { hl: [i] }), dp }); T.n(`dp after considering prefix ${i}?`, v, `max(${dp}, ${P[i]} − ${dp}).`); dp = v; } return dp; }
  });

  D('minimum-xor-sum-of-two-arrays', {
    t: 'Minimum XOR Sum: assign nums2 with a bitmask',
    r: 'f(i, mask) = cheapest way to pair nums1[i..] with the unused nums2 elements. Try every free j: (nums1[i] XOR nums2[j]) + f(i + 1, mask | j).',
    g: R => { const n = R.int(2, 3); return { nums1: R.ints(n, 0, 7), nums2: R.ints(n, 0, 7) }; },
    s(I, T) {
      const a = I.nums1, b = I.nums2, n = a.length, memo = new Map(), f = (i, m) => { if (i === n) return 0; const k = i * 64 + m; if (memo.has(k)) return memo.get(k); let v = Infinity; for (let j = 0; j < n; j++) if (!(m >> j & 1)) v = Math.min(v, (a[i] ^ b[j]) + f(i + 1, m | 1 << j)); memo.set(k, v); return v; };
      let m = 0; for (let i = 0; i < n; i++) { const opts = b.map((x, j) => [String(j), `${x} (xor ${a[i] ^ x})`]).filter((_, j) => !(m >> j & 1)), ok = opts.map(o => +o[0]).filter(j => (a[i] ^ b[j]) + f(i + 1, m | 1 << j) === f(i, m)).map(String); T.at({ nums1: A(a, { hl: [i] }), nums2: A(b, { dim: b.map((_, j) => m >> j & 1 ? j : -1).filter(j => j >= 0) }) }); T.k(`Pair nums1[${i}] = ${a[i]} with (optimal)?`, opts, ok, `The best remaining sum is ${f(i, m)}.`); m |= 1 << +ok[0]; }
      return f(0, 0);
    }
  });

  D('minimum-skips-to-arrive-at-meeting-on-time', {
    t: 'Minimum Skips to Arrive on Time: time in units of 1 divided by speed',
    r: 'Scale time by speed to stay in integers. dp[j] = least scaled time after these roads with j skips. Not skipping rounds up to the next multiple of speed; skipping does not. The answer is the least j with dp[j] at most hoursBefore times speed.',
    g: R => ({ dist: R.ints(R.int(3, 4), 1, 7), speed: R.int(2, 4), hoursBefore: R.int(3, 8) }),
    s(I, T) {
      const d = I.dist, sp = I.speed, n = d.length, up = x => Math.ceil(x / sp) * sp; let dp = [0];
      for (let i = 0; i < n; i++) { const nx = Array(i + 2).fill(Infinity); for (let j = 0; j <= i; j++) { const t = dp[j] + d[i]; nx[j] = Math.min(nx[j], i === n - 1 ? t : up(t)); nx[j + 1] = Math.min(nx[j + 1], t); } dp = nx; }
      T.at({ dist: A(d), speed: sp, limit: I.hoursBefore * sp }); T.n('Scaled finish time with no skips?', dp[0], 'Every rest rounds up to a multiple of speed.');
      for (let j = 0; j <= n; j++) { const ok = dp[j] <= I.hoursBefore * sp; T.at({ 'scaled times': A(dp.map(v => v === Infinity ? '∞' : v)), limit: I.hoursBefore * sp }); T.yn(`On time with ${j} skips?`, ok, `Least time ${dp[j]} vs limit ${I.hoursBefore * sp}.`); if (ok) return j; }
      return -1;
    }
  });

  D('egg-drop-with-2-eggs-and-n-floors', {
    t: 'Egg Drop With 2 Eggs: t drops cover t + (t−1) + … + 1 floors',
    r: 'With t drops and 2 eggs, drop first from floor t, then t − 1 floors higher, and so on. That covers t(t + 1) divided by 2 floors. Find the least t covering n.',
    g: R => ({ n: R.int(3, 40) }),
    s(I, T) { let t = 0; while (t * (t + 1) / 2 < I.n) { t++; T.at({ n: I.n, drops: t }); T.n(`Floors covered with ${t} drops?`, t * (t + 1) / 2, `${t} times ${t + 1} divided by 2.`); } return t; }
  });

  D('minimum-cost-to-change-the-final-value-of-expression', {
    t: 'Minimum Cost to Flip an Expression: value and flip cost per subexpression',
    r: 'Each operand carries (value, cost to flip). &: 1&1 becomes (1, min), 0&0 becomes (0, min + 1), mixed: (0, 1). |: 0|0 becomes (0, min), 1|1 becomes (1, min + 1), mixed: (1, 1). Evaluate left to right with a stack for parentheses.',
    g: R => { const leaf = () => R.pick(['0', '1']), op = () => R.pick(['&', '|']); return { expression: R.chance(0.5) ? `${leaf()}${op()}(${leaf()}${op()}${leaf()})` : `(${leaf()}${op()}${leaf()})${op()}${leaf()}${op()}${leaf()}` }; },
    s(I, T) {
      const comb = (x, o, y) => { const [v1, c1] = x, [v2, c2] = y, m = Math.min(c1, c2); let r; if (o === '&') r = v1 && v2 ? [1, m] : !v1 && !v2 ? [0, m + 1] : [0, 1]; else r = !v1 && !v2 ? [0, m] : v1 && v2 ? [1, m + 1] : [1, 1]; T.at({ expression: I.expression, left: `value ${v1}, flip ${c1}`, right: `value ${v2}, flip ${c2}` }); T.n(`${v1} ${o} ${v2}: cost to flip the result?`, r[1], o === '&' ? 'AND: both 1: flip one side; both 0: flip one and change & to |; mixed: change the operator.' : 'OR: both 0: flip one side; both 1: flip one and change | to &; mixed: change the operator.'); return r; };
      const st = [[null, null]]; for (const ch of I.expression) { const top = st[st.length - 1]; if (ch === '(') st.push([null, null]); else if (ch === '&' || ch === '|') top[1] = ch; else { const val = ch === ')' ? st.pop()[0] : [+ch, 1], t2 = st[st.length - 1]; t2[0] = t2[0] ? comb(t2[0], t2[1], val) : val; } }
      return st[0][0][1];
    }
  });

  D('the-earliest-and-latest-rounds-where-players-compete', {
    t: 'Earliest and Latest Rounds: simulate every outcome',
    r: 'Each round, player i faces player n − 1 − i (the middle one advances). The two stars always win other matches; try every outcome of the rest (memoized on the stars\' positions and n).',
    g: R => { const n = R.int(4, 8); const a = R.int(1, n - 1); return { n, firstPlayer: a, secondPlayer: R.int(a + 1, n) }; },
    s(I, T) {
      const memo = new Map(), f = (n, a, b) => { if (a + b === n - 1) return [1, 1]; const key = n * 1e4 + a * 100 + b; if (memo.has(key)) return memo.get(key); let lo = Infinity, hi = 0; const m = Math.ceil(n / 2);
        for (let mask = 0; mask < 1 << Math.floor(n / 2); mask++) { const win = []; let bad = false; for (let i = 0; i < Math.floor(n / 2); i++) { const j = n - 1 - i; let w = mask >> i & 1 ? i : j; if (i === a || i === b) w = i; if (j === a || j === b) w = j; if ((i === a || i === b) && (mask >> i & 1) === 0 && !(j === a || j === b)) bad = true; if ((j === a || j === b) && (mask >> i & 1) === 1 && !(i === a || i === b)) bad = true; win.push(w); } if (bad) continue; if (n % 2) win.push(Math.floor(n / 2)); win.sort((x, y) => x - y); const [e, l] = f(m, win.indexOf(a), win.indexOf(b)); lo = Math.min(lo, e + 1); hi = Math.max(hi, l + 1); }
        memo.set(key, [lo, hi]); return [lo, hi]; };
      const a = I.firstPlayer - 1, b = I.secondPlayer - 1; T.at({ players: A([...Array(I.n).keys()].map(x => x + 1), { hl: [a, b] }) }); T.yn('Do they face each other in round 1?', a + b === I.n - 1, `Player i meets player n + 1 − i: ${I.firstPlayer} + ${I.secondPlayer} vs ${I.n + 1}.`);
      const r = f(I.n, a, b); T.n('Earliest round they can meet?', r[0], 'Best case over every outcome.'); T.n('Latest round they can meet?', r[1], 'Worst case over every outcome.'); return r;
    }
  });

  D('maximum-alternating-subsequence-sum', {
    t: 'Maximum Alternating Subsequence Sum: even and odd ends',
    r: 'even = best sum with the last pick added; odd = best with the last pick subtracted. even = max(even, odd + x); odd = max(odd, even − x).',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 9) }),
    s(I, T) { let ev = 0, od = 0; I.nums.forEach((x, i) => { const ne = Math.max(ev, od + x); T.at({ nums: A(I.nums, { hl: [i] }), even: ev, odd: od }); T.n(`After ${x}: best sum ending with an added element?`, ne, `max(${ev}, ${od} + ${x}).`); od = Math.max(od, ev - x); ev = ne; }); return ev; }
  });

  D('painting-a-grid-with-three-different-colors', {
    t: 'Painting a Grid With Three Colors: column patterns',
    r: 'List every valid column of m cells (no equal vertical neighbors). Two columns can sit side by side if no row repeats. dp over columns counts the ways ending in each pattern.',
    g: R => ({ m: R.int(1, 2), n: R.int(2, 4) }),
    s(I, T) {
      const pats = []; const gen = (p) => { if (p.length === I.m) { pats.push(p.slice()); return; } for (let c = 0; c < 3; c++) if (!p.length || p[p.length - 1] !== c) { p.push(c); gen(p); p.pop(); } }; gen([]);
      T.at({ m: I.m }); T.n(`Valid single columns of height ${I.m}?`, pats.length, '3 times 2 to the power (m−1).');
      let dp = pats.map(() => 1); for (let col = 2; col <= I.n; col++) { dp = pats.map(p => pats.reduce((s, q, j) => p.every((c, r) => c !== q[r]) ? (s + dp[j]) % MOD : s, 0)); T.at({ columns: col }); T.n(`Ways to paint ${col} columns?`, dp.reduce((a, b) => (a + b) % MOD, 0), 'Sum over compatible previous patterns.'); }
      return dp.reduce((a, b) => (a + b) % MOD, 0);
    }
  });

  D('maximum-number-of-points-with-cost', {
    t: 'Maximum Points with Cost: left and right sweeps',
    r: 'From the previous row, best reachable into column c is max over k of prev[k] − |k − c|. A left-to-right sweep (left[c] = max(left[c−1] − 1, prev[c])) and a right-to-left sweep give it in O(n).',
    g: R => ({ points: R.grid(R.int(3, 4), R.int(3, 4), 0, 6) }),
    s(I, T) { let prev = I.points[0].slice(); for (let r = 1; r < I.points.length; r++) { const n = prev.length, L = prev.slice(), Rt = prev.slice(); for (let c = 1; c < n; c++) L[c] = Math.max(L[c - 1] - 1, prev[c]); for (let c = n - 2; c >= 0; c--) Rt[c] = Math.max(Rt[c + 1] - 1, prev[c]); const cur = I.points[r].map((v, c) => v + Math.max(L[c], Rt[c])); T.at({ points: G(I.points, { hl: prev.map((_, c) => [r, c]) }), prev: A(prev) }); T.n(`Row ${r}: best total ending anywhere in this row?`, Math.max(...cur), 'Each cell adds the best previous value minus the column distance.'); prev = cur; } return Math.max(...prev); }
  });

  D('count-number-of-special-subsequences', {
    t: 'Count Special Subsequences: 0s, then 1s, then 2s',
    r: 'a = subsequences of 0s, b = of 0s then 1s, c = complete ones. A 0: a = 2a + 1. A 1: b = 2b + a. A 2: c = 2c + b.',
    g: R => ({ nums: Array.from({ length: R.int(5, 7) }, () => R.int(0, 2)) }),
    s(I, T) { let a = 0, b = 0, c = 0; I.nums.forEach((x, i) => { if (x === 0) a = (2 * a + 1) % MOD; else if (x === 1) b = (2 * b + a) % MOD; else c = (2 * c + b) % MOD; T.at({ nums: A(I.nums, { hl: [i] }) }); T.n(`After index ${i} (${x}): ${x === 0 ? 'a' : x === 1 ? 'b' : 'c'}?`, x === 0 ? a : x === 1 ? b : c, x === 0 ? 'Extend or not, plus this 0 alone.' : x === 1 ? 'Extend or not every b, plus start 1s after every a.' : 'Extend or not every c, plus finish every b.'); }); return c; }
  });

  D('minimum-total-space-wasted-with-k-resizing-operations', {
    t: 'Minimum Space Wasted with k Resizes: k + 1 segments',
    r: 'k resizes give k + 1 segments. A segment i to j wastes max times length − sum. dp[s][j] = least waste for the first j times in s segments.',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 9), k: R.int(0, 2) }),
    s(I, T) {
      const a = I.nums, n = a.length, waste = (i, j) => { let m = 0, s = 0; for (let x = i; x <= j; x++) { m = Math.max(m, a[x]); s += a[x]; } return m * (j - i + 1) - s; };
      T.at({ nums: A(a) }); T.n('Waste with no resizes?', waste(0, n - 1), 'max times n − sum.');
      let dp = Array(n + 1).fill(Infinity); dp[0] = 0; for (let s = 1; s <= I.k + 1; s++) { const nx = Array(n + 1).fill(Infinity); for (let j = 1; j <= n; j++) for (let i = 0; i < j; i++) nx[j] = Math.min(nx[j], dp[i] + waste(i, j - 1)); dp = nx; if (s > 1) { T.at({ nums: A(a), segments: s }); T.n(`Least waste with ${s - 1} resizes?`, dp[n], 'Best previous split + waste of the last segment.'); } }
      return dp[n];
    }
  });

  D('find-the-longest-valid-obstacle-course-at-each-position', {
    t: 'Longest Obstacle Course at Each Position: non-decreasing LIS',
    r: 'tails[L] = smallest last height of a course of length L + 1. For each obstacle, find the first tail strictly greater (upper bound), replace it; the answer is that position + 1.',
    g: R => ({ obstacles: R.ints(R.int(5, 7), 1, 5) }),
    s(I, T) { const t = []; return I.obstacles.map((x, i) => { let lo = 0, hi = t.length; while (lo < hi) { const m = (lo + hi) >> 1; if (t[m] <= x) lo = m + 1; else hi = m; } T.at({ obstacles: A(I.obstacles, { hl: [i] }), tails: A(t) }); T.n(`Longest course ending at obstacle ${i} (height ${x})?`, lo + 1, 'First tail greater than x, plus one.'); t[lo] = x; return lo + 1; }); }
  });
})();
