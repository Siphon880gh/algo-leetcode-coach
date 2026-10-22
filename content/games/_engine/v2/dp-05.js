/* v2 games: dynamic programming (5). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const isSub = (t, s) => { let i = 0; for (const c of s) if (c === t[i]) i++; return i === t.length; };

  D('bitwise-ors-of-subarrays', {
    t: 'Bitwise ORs of Subarrays: keep the ORs ending here',
    r: 'cur = set of ORs of subarrays ending at i = {x} ∪ {y | x for y in previous cur}. It stays small because ORs only gain bits. Union every cur into the answer set.',
    g: R => ({ arr: R.ints(R.int(4, 6), 0, 7) }),
    s(I, T) { let cur = new Set(); const all = new Set(); I.arr.forEach((x, i) => { cur = new Set([x, ...[...cur].map(y => y | x)]); T.at({ arr: A(I.arr, { hl: [i] }), seen: A([...all].sort((a, b) => a - b)) }); T.n(`How many distinct ORs end at index ${i}?`, cur.size, `{${[...cur].sort((a, b) => a - b).join(', ')}}.`); cur.forEach(v => all.add(v)); }); return all.size; }
  });

  D('numbers-at-most-n-given-digit-set', {
    t: 'Numbers At Most N Given Digit Set: shorter numbers, then digit by digit',
    r: 'Every number with fewer digits than n works: D^L for each shorter length L. For n\'s own length, walk its digits: digits smaller than n[i] give D^(rest) each; if n[i] itself is in the set, continue, else stop. Reaching the end adds 1 (n itself).',
    g: R => ({ digits: R.distinct(R.int(2, 4), 1, 9).sort((a, b) => a - b).map(String), n: R.int(10, 999) }),
    s(I, T) {
      const ds = I.digits, s = String(I.n), L = s.length, D_ = ds.length; let res = 0;
      for (let l = 1; l < L; l++) { T.at({ digits: A(ds), n: s, total: res }); T.n(`How many ${l}-digit numbers can you write?`, D_ ** l, `${D_}^${l}.`); res += D_ ** l; }
      for (let i = 0; i < L; i++) { const less = ds.filter(d => d < s[i]).length, add = less * D_ ** (L - i - 1); T.at({ digits: A(ds), n: A([...s], { hl: [i] }), total: res }); T.n(`Position ${i} (n has ${s[i]}): how many numbers branch off here with a smaller digit?`, add, `${less} smaller digits × ${D_}^${L - i - 1}.`); res += add; if (!ds.includes(s[i])) return res; }
      return res + 1;
    }
  });

  D('valid-permutations-for-di-sequence', {
    t: 'Valid Permutations for DI Sequence: rank of the last number',
    r: 'dp[i][j] = ways to arrange the first i+1 numbers so the last one is the j-th smallest. After "I": sum dp[i−1][k] for k < j. After "D": sum dp[i−1][k] for k ≥ j.',
    g: R => ({ s: R.str(R.int(2, 4), 'DI') }),
    s(I, T) { let dp = [1]; [...I.s].forEach((c, i) => { const nx = []; for (let j = 0; j <= i + 1; j++) { let v = 0; if (c === 'I') for (let k = 0; k < j; k++) v += dp[k]; else for (let k = j; k <= i; k++) v += dp[k]; nx.push(v % MOD); } T.at({ s: A([...I.s], { hl: [i] }), prev: A(dp) }); T.n(`After "${c}" (step ${i + 1}): how many ways end with the largest so far (j = ${i + 1})?`, nx[i + 1], c === 'I' ? 'Sum of every previous entry.' : '"D" means the last cannot be the largest: 0.'); T.n(`…and with the smallest so far (j = 0)?`, nx[0], c === 'D' ? 'Sum of every previous entry.' : '"I" means the last cannot be the smallest: 0.'); dp = nx; }); return dp.reduce((a, b) => (a + b) % MOD, 0); }
  });

  D('sum-of-subarray-minimums', {
    t: 'Sum of Subarray Minimums: how many subarrays does each value rule?',
    r: 'arr[i] is the minimum of (i − left) · (right − i) subarrays, where left = previous index with a smaller value and right = next index with a smaller-or-equal value. Add arr[i] times that count.',
    g: R => ({ arr: R.ints(R.int(4, 6), 1, 9) }),
    s(I, T) { const a = I.arr, n = a.length; let tot = 0; for (let i = 0; i < n; i++) { let l = i - 1, r = i + 1; while (l >= 0 && a[l] >= a[i]) l--; while (r < n && a[r] > a[i]) r++; const c = (i - l) * (r - i); T.at({ arr: A(a, { hl: [i], win: [l + 1, r - 1] }), total: tot }); T.n(`In how many subarrays is arr[${i}] = ${a[i]} the minimum?`, c, `(${i} − ${l}) · (${r} − ${i}).`); tot = (tot + c * a[i]) % MOD; } return tot; }
  });

  D('number-of-music-playlists', {
    t: 'Number of Music Playlists: new song or replay',
    r: 'dp[i][j] = playlists of length i using exactly j distinct songs. New song: dp[i−1][j−1] · (n − j + 1). Replay: dp[i−1][j] · max(j − k, 0).',
    g: R => { const n = R.int(2, 3); return { n, goal: n + R.int(0, 2), k: R.int(0, n - 1) }; },
    s(I, T) { const { n, goal, k } = I, dp = mk(goal + 1, n + 1, 0); dp[0][0] = 1; for (let i = 1; i <= goal; i++) for (let j = 1; j <= n; j++) { dp[i][j] = (dp[i - 1][j - 1] * (n - j + 1) + dp[i - 1][j] * Math.max(j - k, 0)) % MOD; if (j <= i) { T.at({ dp: G(dp, { rh: dp.map((_, x) => 'len ' + x), ch: dp[0].map((_, x) => x + ' songs'), hl: [[i, j]] }) }); T.n(`dp[${i}][${j}]?`, dp[i][j], `${dp[i - 1][j - 1]}·${n - j + 1} + ${dp[i - 1][j]}·${Math.max(j - k, 0)}.`); } } return dp[goal][n]; }
  });

  D('flip-string-to-monotone-increasing', {
    t: 'Flip String to Monotone Increasing: flip this 0 or all earlier 1s',
    r: 'Scan left to right with ones = 1s seen. On "1": ones++. On "0": flips = min(flips + 1, ones) (flip this 0 to 1, or flip every earlier 1 to 0).',
    g: R => ({ s: R.str(R.int(6, 8), '01') }),
    s(I, T) { let ones = 0, f = 0; [...I.s].forEach((c, i) => { if (c === '1') ones++; else { const v = Math.min(f + 1, ones); T.at({ s: A([...I.s], { hl: [i] }), ones, flips: f }); T.n(`"0" at ${i}: new flips?`, v, `min(${f} + 1, ${ones}).`); f = v; } }); return f; }
  });

  D('distinct-subsequences-ii', {
    t: 'Distinct Subsequences II: end with each letter',
    r: 'end[c] = distinct subsequences ending in letter c. Reading c: end[c] = (sum of all end values) + 1, which replaces the old end[c] so repeats are not double-counted.',
    g: R => ({ s: R.str(R.int(4, 6), 'abc') }),
    s(I, T) { const e = {}; [...I.s].forEach((c, i) => { const v = (Object.values(e).reduce((a, b) => a + b, 0) + 1) % MOD; T.at({ s: A([...I.s], { hl: [i] }), end: K(e) }); T.n(`New end["${c}"]?`, v, 'Sum of all end values + 1 (the letter alone).'); e[c] = v; }); return Object.values(e).reduce((a, b) => (a + b) % MOD, 0); }
  });

  D('find-the-shortest-superstring', {
    t: 'Shortest Superstring: maximize the overlaps',
    r: 'overlap[i][j] = longest suffix of word i that is a prefix of word j. Bitmask DP over (used words, last word) picks the order with the most total overlap.',
    cmp: (out, exp, I) => typeof out === 'string' && out.length === exp.length && I.words.every(w => out.includes(w)),
    g: R => ({ words: R.distinct(R.int(3, 4), 0, 50).map(() => R.str(R.int(2, 4), 'ab')).filter((w, i, a) => a.indexOf(w) === i && !a.some((v, j) => j !== i && v.includes(w))) }),
    s(I, T) {
      let W = I.words; W = W.filter((w, i) => !W.some((v, j) => j !== i && v.includes(w))); const n = W.length;
      const ov = (a, b) => { for (let l = Math.min(a.length, b.length); l > 0; l--) if (a.endsWith(b.slice(0, l))) return l; return 0; };
      const O = W.map(a => W.map(b => ov(a, b)));
      for (let i = 0; i < n && i < 2; i++) for (let j = 0; j < n; j++) if (i !== j) { T.at({ words: A(W, { hl: [i, j] }) }); T.n(`overlap("${W[i]}" → "${W[j]}")?`, O[i][j], 'Longest suffix of the first that starts the second.'); }
      const F = 1 << n, dp = mk(F, n, -1), par = mk(F, n, -1); for (let i = 0; i < n; i++) dp[1 << i][i] = 0;
      for (let m = 1; m < F; m++) for (let i = 0; i < n; i++) if (dp[m][i] >= 0) for (let j = 0; j < n; j++) if (!(m >> j & 1)) { const v = dp[m][i] + O[i][j]; if (v > dp[m | 1 << j][j]) { dp[m | 1 << j][j] = v; par[m | 1 << j][j] = i; } }
      let last = 0; for (let i = 1; i < n; i++) if (dp[F - 1][i] > dp[F - 1][last]) last = i;
      const tot = W.reduce((s, w) => s + w.length, 0); T.at({ words: A(W) }); T.n('Length of the shortest superstring?', tot - dp[F - 1][last], `Total length ${tot} minus the best overlap sum ${dp[F - 1][last]}.`);
      const ord = []; let m = F - 1, i = last; while (i >= 0) { ord.unshift(i); const p = par[m][i]; m ^= 1 << i; i = p; }
      let res = W[ord[0]]; for (let k = 1; k < ord.length; k++) res += W[ord[k]].slice(O[ord[k - 1]][ord[k]]); return res;
    }
  });

  D('tallest-billboard', {
    t: 'Tallest Billboard: track the height difference',
    r: 'dp[d] = tallest shorter side with difference d. Each rod goes on the taller side, the shorter side, or nowhere. Answer: dp[0].',
    g: R => ({ rods: R.ints(R.int(3, 5), 1, 6) }),
    s(I, T) { let dp = new Map([[0, 0]]); I.rods.forEach((r, i) => { const nx = new Map(dp); const up = (d, v) => { if ((nx.get(d) ?? -1) < v) nx.set(d, v); }; for (const [d, s] of dp) { up(d + r, s); up(Math.abs(d - r), s + Math.min(d, r)); } dp = nx; T.at({ rods: A(I.rods, { hl: [i] }), dp: K([...dp].sort((a, b) => a[0] - b[0]).map(([d, s]) => ['diff ' + d, s])) }); T.n(`After rod ${r}: tallest equal pair so far (dp[0])?`, dp.get(0), 'Read the entry for difference 0.'); }); return dp.get(0); }
  });

  D('delete-columns-to-make-sorted-iii', {
    t: 'Delete Columns to Make Sorted III: LIS over columns',
    r: 'Keep a set of columns where every row is non-decreasing. dp[j] = longest kept chain ending at column j, built from columns i < j where every row has s[i] ≤ s[j]. Delete m − max dp.',
    g: R => ({ strs: Array.from({ length: R.int(1, 2) }, (_, __, L = 5) => R.str(5, 'abcd')) }),
    s(I, T) { const S = I.strs, m = S[0].length, dp = []; for (let j = 0; j < m; j++) { let b = 1; for (let i = 0; i < j; i++) if (S.every(s => s[i] <= s[j])) b = Math.max(b, dp[i] + 1); T.at({ strs: G(S.map(s => [...s]), { hl: S.map((_, r) => [r, j]) }), dp: A(dp.concat('?')) }); T.n(`dp[${j}]?`, b, 'Longest chain from earlier columns that every row allows.'); dp.push(b); } return m - Math.max(...dp); }
  });

  D('least-operators-to-express-number', {
    t: 'Least Operators to Express Number: base-x digits, add up or borrow',
    r: 'Write target in base x. For each digit c at power k: either add c copies of x^k (pos) or subtract (x − c) after borrowing one more (neg). x^0 costs 2 ops (x/x), x^k costs k. Answer: min(pos, k + neg) − 1.',
    g: R => ({ x: R.int(2, 5), target: R.int(5, 60) }),
    s(I, T) {
      let t = I.target, pos = 0, neg = 0, k = 0;
      while (t > 0) { const c = t % I.x; t = Math.floor(t / I.x);
        T.at({ x: I.x, rest: t * I.x + c, k, pos, neg }); T.n(`Next base-${I.x} digit (power ${k})?`, c, `${t * I.x + c} mod ${I.x}.`);
        if (k === 0) { pos = c * 2; neg = (I.x - c) * 2; } else { const p = Math.min(c * k + pos, (c + 1) * k + neg), q = Math.min((I.x - c) * k + pos, (I.x - c - 1) * k + neg); pos = p; neg = q; } k++; }
      return Math.min(pos, k + neg) - 1;
    }
  });

  D('odd-even-jump', {
    t: 'Odd Even Jump: precompute next jumps, then go backwards',
    r: 'Odd jump from i: the smallest value ≥ arr[i] to the right (smallest index on ties). Even jump: the largest value ≤ arr[i]. odd[i] = even[next], even[i] = odd[next], last index good. Count starts with odd[i] true.',
    g: R => ({ arr: R.ints(R.int(5, 6), 1, 6) }),
    s(I, T) {
      const a = I.arr, n = a.length, nx = (i, odd) => { let b = -1; for (let j = i + 1; j < n; j++) if (odd ? a[j] >= a[i] && (b < 0 || a[j] < a[b]) : a[j] <= a[i] && (b < 0 || a[j] > a[b])) b = j; return b; };
      const odd = Array(n).fill(false), even = Array(n).fill(false); odd[n - 1] = even[n - 1] = true;
      for (let i = n - 2; i >= 0; i--) { const o = nx(i, true), e = nx(i, false); T.at({ arr: A(a, { hl: [i] }), odd: A(odd.map((v, j) => j > i ? v : '?')), even: A(even.map((v, j) => j > i ? v : '?')) }); T.n(`Odd jump from ${i} lands where (−1 if none)?`, o, 'Smallest value ≥ arr[i] to the right, leftmost on ties.'); odd[i] = o >= 0 && even[o]; even[i] = e >= 0 && odd[e]; T.yn(`Is start ${i} good (odd[${i}])?`, odd[i], o < 0 ? 'No odd jump.' : `It depends on even[${o}].`); }
      return odd.filter(Boolean).length;
    }
  });

  D('longest-turbulent-subarray', {
    t: 'Longest Turbulent Subarray: flip-flopping signs',
    r: 'inc = length ending here with a rise, dec = with a fall. Rise: inc = dec + 1, dec = 1. Fall: dec = inc + 1, inc = 1. Equal: both 1.',
    g: R => ({ arr: R.ints(R.int(6, 8), 1, 6) }),
    s(I, T) { const a = I.arr; let inc = 1, dec = 1, best = 1; for (let i = 1; i < a.length; i++) { if (a[i] > a[i - 1]) { inc = dec + 1; dec = 1; } else if (a[i] < a[i - 1]) { dec = inc + 1; inc = 1; } else inc = dec = 1; T.at({ arr: A(a, { hl: [i - 1, i] }), best }); T.n(`Longest turbulent run ending at ${i}?`, Math.max(inc, dec), a[i] === a[i - 1] ? 'Equal neighbors reset it to 1.' : 'Extend the run with the opposite last sign.'); best = Math.max(best, inc, dec); } return best; }
  });

  D('minimum-cost-for-tickets', {
    t: 'Minimum Cost for Tickets: which pass covers today?',
    r: 'dp[d] = cheapest cost through day d. Non-travel days copy dp[d−1]. Travel days: min(dp[d−1] + 1-day, dp[d−7] + 7-day, dp[d−30] + 30-day), with negatives counting as 0.',
    g: R => ({ days: R.distinct(R.int(4, 6), 1, 20).sort((a, b) => a - b), costs: [R.int(1, 3), R.int(4, 8), R.int(9, 16)] }),
    s(I, T) { const last = I.days[I.days.length - 1], dp = Array(last + 1).fill(0), set = new Set(I.days), c = I.costs, g = d => d < 0 ? 0 : dp[d]; for (let d = 1; d <= last; d++) { if (!set.has(d)) { dp[d] = dp[d - 1]; continue; } dp[d] = Math.min(g(d - 1) + c[0], g(d - 7) + c[1], g(d - 30) + c[2]); T.at({ days: A(I.days, { hl: [I.days.indexOf(d)] }), costs: K([['1-day', c[0]], ['7-day', c[1]], ['30-day', c[2]]]), 'dp[d−1]': g(d - 1), 'dp[d−7]': g(d - 7) }); T.n(`dp[${d}]?`, dp[d], `min(${g(d - 1)}+${c[0]}, ${g(d - 7)}+${c[1]}, ${g(d - 30)}+${c[2]}).`); } return dp[last]; }
  });

  D('minimum-cost-to-merge-stones', {
    t: 'Minimum Cost to Merge Stones: interval DP in steps of k−1',
    r: 'Possible only if (n − 1) % (k − 1) == 0. dp[i][j] = cheapest way to reduce stones[i..j] as far as possible: min over mid (stepping by k−1) of dp[i][mid] + dp[mid+1][j]; when (j − i) % (k − 1) == 0 it can become one pile: add sum(i..j).',
    g: R => ({ stones: R.ints(R.int(3, 5), 1, 6), k: R.int(2, 3) }),
    s(I, T) {
      const s = I.stones, n = s.length, k = I.k, ok = (n - 1) % (k - 1) === 0; T.at({ stones: A(s), k }); T.yn(`Can ${n} piles be merged into one with k = ${k}?`, ok, `(${n} − 1) % (${k} − 1) must be 0.`); if (!ok) return -1;
      const P = [0]; s.forEach(x => P.push(P[P.length - 1] + x)); const dp = mk(n, n, 0);
      for (let len = k; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1; let b = Infinity; for (let m = i; m < j; m += k - 1) b = Math.min(b, dp[i][m] + dp[m + 1][j]); if ((j - i) % (k - 1) === 0) b += P[j + 1] - P[i]; dp[i][j] = b; T.at({ stones: A(s, { win: [i, j] }), k }); T.n(`dp[${i}][${j}]?`, b, (j - i) % (k - 1) === 0 ? 'Best split, plus the range sum for the final merge.' : 'Best split; this range cannot finish as one pile.'); }
      return dp[0][n - 1];
    }
  });

  D('numbers-with-repeated-digits', {
    t: 'Numbers With Repeated Digits: count the all-distinct ones instead',
    r: 'Answer = n − (numbers ≤ n with all digits distinct). Shorter lengths L: 9 · 9 · 8 · … (L factors). Same length: walk n\'s digits, counting smaller unused choices times permutations of the rest; stop if a digit repeats.',
    g: R => ({ n: R.int(20, 999) }),
    s(I, T) {
      const s = String(I.n), L = s.length, P = (m, r) => { let v = 1; for (let i = 0; i < r; i++) v *= m - i; return v; }; let cnt = 0;
      for (let l = 1; l < L; l++) { const v = 9 * P(9, l - 1); T.at({ n: s, distinct: cnt }); T.n(`How many ${l}-digit numbers have all distinct digits?`, v, `9 · P(9, ${l - 1}).`); cnt += v; }
      const used = new Set(); let full = true;
      for (let i = 0; i < L; i++) { const d = +s[i]; let c = 0; for (let x = i ? 0 : 1; x < d; x++) if (!used.has(x)) c++; const v = c * P(9 - i, L - i - 1); T.at({ n: A([...s], { hl: [i] }), used: A([...used]), distinct: cnt }); T.n(`Position ${i}: distinct numbers branching off with a smaller digit?`, v, `${c} unused smaller digits × P(${9 - i}, ${L - i - 1}).`); cnt += v; if (used.has(d)) { full = false; break; } used.add(d); }
      if (full) cnt++; return I.n - cnt;
    }
  });

  D('best-sightseeing-pair', {
    t: 'Best Sightseeing Pair: carry the best values[i] + i',
    r: 'score = (values[i] + i) + (values[j] − j). Sweep j, keeping the best values[i] + i seen so far.',
    g: R => ({ values: R.ints(R.int(5, 7), 1, 9) }),
    s(I, T) { const v = I.values; let bl = v[0], best = -Infinity; for (let j = 1; j < v.length; j++) { const sc = bl + v[j] - j; T.at({ values: A(v, { hl: [j] }), 'best values[i]+i': bl }); T.n(`Best score with j = ${j}?`, sc, `${bl} + ${v[j]} − ${j}.`); best = Math.max(best, sc); bl = Math.max(bl, v[j] + j); } return best; }
  });

  D('video-stitching', {
    t: 'Video Stitching: jump-game greedy over clips',
    r: 'Covered up to end. Among clips starting at or before end, take the one reaching farthest. If nothing extends past end, return −1.',
    g: R => ({ clips: Array.from({ length: R.int(4, 6) }, () => { const a = R.int(0, 8); return [a, a + R.int(1, 5)]; }).concat([[0, R.int(1, 3)]]), time: R.int(6, 10) }),
    s(I, T) {
      let end = 0, cnt = 0; while (end < I.time) { let far = end; for (const [a, b] of I.clips) if (a <= end) far = Math.max(far, b);
        T.at({ clips: A(I.clips.map(c => c.join('-'))), covered: end, time: I.time, used: cnt }); if (far === end) { T.yn(`Covered up to ${end}. Can any clip extend it?`, false, 'Every clip starting by then ends by then: −1.'); return -1; }
        T.n(`Covered up to ${end}. Farthest reach with one more clip?`, far, 'Max end over clips starting at or before the covered point.'); end = far; cnt++; }
      return cnt;
    }
  });

  D('longest-arithmetic-subsequence', {
    t: 'Longest Arithmetic Subsequence: one map per index',
    r: 'dp[i][d] = length of the longest arithmetic subsequence ending at i with difference d = dp[j][d] + 1 for j < i (2 if new).',
    g: R => ({ nums: R.ints(R.int(5, 6), 0, 9) }),
    s(I, T) { const a = I.nums, dp = []; let best = 2; a.forEach((x, i) => { const m = new Map(); for (let j = 0; j < i; j++) { const d = x - a[j]; m.set(d, Math.max(m.get(d) || 0, (dp[j].get(d) || 1) + 1)); } dp.push(m); if (i) { const b = Math.max(...m.values()); T.at({ nums: A(a, { hl: [i] }), best }); T.n(`Longest arithmetic subsequence ending at index ${i}?`, b, 'Best dp[j][x − nums[j]] + 1.'); best = Math.max(best, b); } }); return best; }
  });

  D('maximum-sum-of-two-non-overlapping-subarrays', {
    t: 'Max Sum of Two Non-Overlapping Subarrays: best one before, then the other',
    r: 'Try both orders. Sweep the right window\'s position; keep the best left window that ends before it. The answer is the best total over both orders.',
    g: R => ({ nums: R.ints(R.int(6, 7), 0, 9), firstLen: R.int(1, 2), secondLen: R.int(1, 2) }),
    s(I, T) {
      const a = I.nums, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); const sum = (i, l) => P[i + l] - P[i];
      const run = (L, M, nm) => { let bl = 0, best = 0; for (let j = L; j + M <= a.length; j++) { bl = Math.max(bl, sum(j - L, L)); best = Math.max(best, bl + sum(j, M)); } T.at({ nums: A(a), order: nm }); T.n(`Best total with the length-${L} window first, then length ${M}?`, best, 'Sweep the right window, carrying the best left window.'); return best; };
      return Math.max(run(I.firstLen, I.secondLen, 'first, then second'), run(I.secondLen, I.firstLen, 'second, then first'));
    }
  });

  D('uncrossed-lines', {
    t: 'Uncrossed Lines: it is LCS',
    r: 'dp[i][j] = most lines between the first i and first j numbers. Equal: diagonal + 1; else the max of up and left.',
    g: R => ({ nums1: R.ints(R.int(3, 4), 1, 4), nums2: R.ints(R.int(3, 4), 1, 4) }),
    s(I, T) { const a = I.nums1, b = I.nums2, dp = mk(a.length + 1, b.length + 1, 0); for (let i = 1; i <= a.length; i++) for (let j = 1; j <= b.length; j++) { const v = a[i - 1] === b[j - 1] ? dp[i - 1][j - 1] + 1 : Math.max(dp[i - 1][j], dp[i][j - 1]); T.at({ dp: G(dp, { rh: ['', ...a], ch: ['', ...b], hl: [[i, j]] }) }); T.n(`dp[${i}][${j}]?`, v, a[i - 1] === b[j - 1] ? 'Equal: diagonal + 1.' : 'Max of up and left.'); dp[i][j] = v; } return dp[a.length][b.length]; }
  });

  D('minimum-score-triangulation-of-polygon', {
    t: 'Minimum Score Triangulation: pick the third vertex of edge (i, j)',
    r: 'dp[i][j] = cheapest triangulation of vertices i..j. Edge (i, j) belongs to one triangle (i, m, j): dp[i][m] + dp[m][j] + v[i]·v[m]·v[j].',
    g: R => ({ values: R.ints(R.int(4, 5), 1, 5) }),
    s(I, T) { const v = I.values, n = v.length, dp = mk(n, n, 0); for (let len = 3; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1; let b = Infinity; for (let m = i + 1; m < j; m++) b = Math.min(b, dp[i][m] + dp[m][j] + v[i] * v[m] * v[j]); T.at({ values: A(v, { win: [i, j] }) }); T.n(`dp[${i}][${j}]?`, b, 'Min over the third vertex m.'); dp[i][j] = b; } return dp[0][n - 1]; }
  });

  D('partition-array-for-maximum-sum', {
    t: 'Partition Array for Maximum Sum: try every last-block length',
    r: 'dp[i] = best sum for the first i numbers = max over len ≤ k of dp[i − len] + len · max(last len numbers).',
    g: R => ({ arr: R.ints(R.int(5, 7), 1, 9), k: R.int(2, 3) }),
    s(I, T) { const a = I.arr, dp = [0]; for (let i = 1; i <= a.length; i++) { let b = 0, m = 0; for (let l = 1; l <= I.k && l <= i; l++) { m = Math.max(m, a[i - l]); b = Math.max(b, dp[i - l] + l * m); } T.at({ arr: A(a, { hl: [i - 1] }), dp: A(dp.concat('?')) }); T.n(`dp[${i}]?`, b, `Best of dp[i − len] + len·max, len ≤ ${I.k}.`); dp.push(b); } return dp[a.length]; }
  });

  D('longest-string-chain', {
    t: 'Longest String Chain: drop one letter to find the predecessor',
    r: 'Sort by length. dp[w] = 1 + max dp[w with one letter removed] over removals that are words.',
    g: R => { const base = R.str(1, 'abc'); const ws = [base]; let w = base; for (let i = 0; i < 3; i++) { const p = R.int(0, w.length); w = w.slice(0, p) + R.pick(['a', 'b', 'c', 'd']) + w.slice(p); ws.push(w); } ws.push(R.str(2, 'abcd'), R.str(3, 'abcd')); return { words: R.shuffle([...new Set(ws)]) }; },
    s(I, T) { const ws = I.words.slice().sort((a, b) => a.length - b.length), dp = new Map(); let best = 0; for (const w of ws) { let b = 1; for (let i = 0; i < w.length; i++) { const p = w.slice(0, i) + w.slice(i + 1); if (dp.has(p)) b = Math.max(b, dp.get(p) + 1); } T.at({ word: w, dp: K([...dp]) }); T.n(`dp["${w}"]?`, b, 'Best predecessor (one letter removed) + 1.'); dp.set(w, Math.max(dp.get(w) || 0, b)); best = Math.max(best, b); } return best; }
  });

  D('last-stone-weight-ii', {
    t: 'Last Stone Weight II: split into two piles as evenly as possible',
    r: 'The result is |pile A − pile B|. Find the reachable subset sum closest to (but not above) total / 2: answer = total − 2·best.',
    g: R => ({ stones: R.ints(R.int(4, 6), 1, 9) }),
    s(I, T) { const S = I.stones.reduce((a, b) => a + b, 0), half = Math.floor(S / 2); let can = new Set([0]); I.stones.forEach((x, i) => { can = new Set([...can, ...[...can].map(v => v + x).filter(v => v <= half)]); T.at({ stones: A(I.stones, { hl: [i] }), half }); T.n(`After stone ${x}: largest reachable sum ≤ ${half}?`, Math.max(...can), 'Add the stone to every reachable sum.'); }); return S - 2 * Math.max(...can); }
  });

  D('longest-repeating-substring', {
    t: 'Longest Repeating Substring: common suffixes of two prefixes',
    r: 'dp[i][j] (i < j) = length of the common run ending at s[i−1] and s[j−1]. Equal letters extend the diagonal. The answer is the largest dp.',
    g: R => ({ s: R.str(R.int(5, 7), 'ab') }),
    s(I, T) { const s = I.s, n = s.length, dp = mk(n + 1, n + 1, 0); let best = 0; for (let j = 2; j <= n; j++) { let b = 0; for (let i = 1; i < j; i++) { if (s[i - 1] === s[j - 1]) dp[i][j] = dp[i - 1][j - 1] + 1; b = Math.max(b, dp[i][j]); } T.at({ s: A([...s], { hl: [j - 1] }), best }); T.n(`Longest substring ending at index ${j - 1} that also occurs earlier?`, b, 'Max over earlier ends of the diagonal run.'); best = Math.max(best, b); } return best; }
  });

  D('campus-bikes-ii', {
    t: 'Campus Bikes II: bitmask over taken bikes',
    r: 'f(i, mask) = cheapest way to give workers i.. bikes not in mask. Try each free bike for worker i: Manhattan distance + f(i + 1, mask | bike).',
    g: R => { const n = R.int(2, 3), pt = () => [R.int(0, 4), R.int(0, 4)]; return { workers: Array.from({ length: n }, pt), bikes: Array.from({ length: n + R.int(0, 1) }, pt) }; },
    s(I, T) {
      const W = I.workers, B = I.bikes, d = (a, b) => Math.abs(a[0] - b[0]) + Math.abs(a[1] - b[1]), memo = new Map();
      const f = (i, m) => { if (i === W.length) return 0; const k = i * 1024 + m; if (memo.has(k)) return memo.get(k); let b = Infinity; B.forEach((bk, j) => { if (!(m >> j & 1)) b = Math.min(b, d(W[i], bk) + f(i + 1, m | 1 << j)); }); memo.set(k, b); return b; };
      let m = 0; for (let i = 0; i < W.length; i++) { const opts = B.map((b, j) => [String(j), `bike ${j} (${b}) d=${d(W[i], b)}`]).filter((_, j) => !(m >> j & 1)), ok = B.map((b, j) => !(m >> j & 1) && d(W[i], b) + f(i + 1, m | 1 << j) === f(i, m) ? String(j) : null).filter(x => x !== null);
        T.at({ worker: `#${i} at (${W[i]})`, bikes: A(B.map(b => b.join(','))), taken: A(B.map((_, j) => j).filter(j => m >> j & 1)) }); T.k(`Worker ${i}: which bike (optimal overall)?`, opts, ok, `The optimal remaining total is ${f(i, m)}.`); m |= 1 << +ok[0]; }
      return f(0, 0);
    }
  });

  D('digit-count-in-range', {
    t: 'Digit Count in Range: count by position, then subtract',
    r: 'count(n) = occurrences of d in 1..n, summed per position p: high · p plus a partial block from the current digit. Answer = count(high) − count(low − 1).',
    g: R => { const lo = R.int(1, 60); return { d: R.int(0, 9), low: lo, high: lo + R.int(5, 120) }; },
    s(I, T) {
      const d = I.d, cnt = (n, nm) => { let c = 0; for (let p = 1; p <= n; p *= 10) { const hi = Math.floor(n / (p * 10)), cur = Math.floor(n / p) % 10, lo = n % p; let v; if (d) v = hi * p + (cur > d ? p : cur === d ? lo + 1 : 0); else { if (hi === 0) continue; v = (hi - 1) * p + (cur > 0 ? p : lo + 1); } T.at({ n, d, place: p }); T.n(`Times ${d} appears in the ${p}s place across 1..${n}?`, v, d ? `${hi}·${p} full blocks plus the partial block.` : `Zero cannot lead: (${hi} − 1)·${p} plus the partial block.`); c += v; } return c; };
      return cnt(I.high) - cnt(I.low - 1);
    }
  });

  D('shortest-common-supersequence', {
    t: 'Shortest Common Supersequence: LCS, then weave',
    r: 'Build the LCS table. Walk back from the end: equal letters are written once; otherwise write the letter from the side whose LCS stays larger. Length = m + n − LCS.',
    cmp: (out, exp, I) => typeof out === 'string' && out.length === exp.length && isSub(I.str1, out) && isSub(I.str2, out),
    g: R => ({ str1: R.str(R.int(3, 4), 'abc'), str2: R.str(R.int(3, 4), 'abc') }),
    s(I, T) {
      const a = I.str1, b = I.str2, m = a.length, n = b.length, dp = mk(m + 1, n + 1, 0);
      for (let i = 1; i <= m; i++) for (let j = 1; j <= n; j++) dp[i][j] = a[i - 1] === b[j - 1] ? dp[i - 1][j - 1] + 1 : Math.max(dp[i - 1][j], dp[i][j - 1]);
      T.at({ dp: G(dp, { rh: ['', ...a], ch: ['', ...b] }) }); T.n('LCS length?', dp[m][n], 'Bottom-right cell.'); T.n('Length of the shortest common supersequence?', m + n - dp[m][n], `${m} + ${n} − ${dp[m][n]}.`);
      let i = m, j = n, out = ''; while (i && j) { if (a[i - 1] === b[j - 1]) { out = a[--i] + out; j--; } else if (dp[i - 1][j] >= dp[i][j - 1]) out = a[--i] + out; else out = b[--j] + out; } return a.slice(0, i) + b.slice(0, j) + out;
    }
  });

  D('filling-bookcase-shelves', {
    t: 'Filling Bookcase Shelves: which books share the last shelf?',
    r: 'dp[i] = least height for the first i books. The last shelf holds books j..i−1 while their thickness fits: dp[j] + max height among them.',
    g: R => ({ books: Array.from({ length: R.int(4, 6) }, () => [R.int(1, 3), R.int(1, 5)]), shelfWidth: R.int(3, 5) }),
    s(I, T) { const b = I.books, dp = [0]; for (let i = 1; i <= b.length; i++) { let w = 0, h = 0, best = Infinity; for (let j = i - 1; j >= 0; j--) { w += b[j][0]; if (w > I.shelfWidth) break; h = Math.max(h, b[j][1]); best = Math.min(best, dp[j] + h); } T.at({ books: A(b.map(x => x.join('×')), { hl: [i - 1] }), dp: A(dp.concat('?')), width: I.shelfWidth }); T.n(`dp[${i}]?`, best, 'Try every last shelf that fits.'); dp.push(best); } return dp[b.length]; }
  });

  D('smallest-sufficient-team', {
    t: 'Smallest Sufficient Team: DP over skill masks',
    r: 'team[mask] = smallest team covering exactly the skills in mask. For each person, extend every known mask with their skills when it makes a smaller team.',
    cmp: (out, exp, I) => Array.isArray(out) && out.length === exp.length && I.req_skills.every(s => out.some(p => I.people[p].includes(s))),
    g: R => { const sk = ['java', 'node', 'react', 'sql', 'aws'].slice(0, R.int(3, 4)); const ppl = Array.from({ length: R.int(3, 4) }, () => sk.filter(() => R.chance(0.45))); ppl.push([R.pick(sk), ...sk.filter(() => R.chance(0.3))].filter((x, i, a) => a.indexOf(x) === i)); sk.forEach(s => { if (!ppl.some(p => p.includes(s))) ppl[R.int(0, ppl.length - 1)].push(s); }); return { req_skills: sk, people: ppl }; },
    s(I, T) {
      const idx = new Map(I.req_skills.map((s, i) => [s, i])), full = (1 << I.req_skills.length) - 1, dp = new Map([[0, []]]);
      I.people.forEach((p, i) => { const pm = p.reduce((m, s) => m | 1 << idx.get(s), 0); for (const [m, t] of [...dp]) { const nm = m | pm; if (!dp.has(nm) || dp.get(nm).length > t.length + 1) dp.set(nm, [...t, i]); }
        T.at({ person: `#${i}: ${p.join(', ') || '(none)'}`, skills: A(I.req_skills) }); T.n(`After person ${i}: smallest team covering every skill (inf if none yet)?`, dp.has(full) ? dp.get(full).length : Infinity, 'Look up the full mask.'); });
      return dp.get(full);
    }
  });

  D('minimum-cost-tree-from-leaf-values', {
    t: 'Minimum Cost Tree From Leaf Values: remove the smallest leaf first',
    r: 'Greedy: the smallest leaf should be combined with its smaller neighbor, costing leaf · min(left, right). Remove it and repeat until one leaf remains.',
    g: R => ({ arr: R.ints(R.int(3, 5), 1, 9) }),
    s(I, T) { const a = I.arr.slice(); let tot = 0; while (a.length > 1) { let i = a.indexOf(Math.min(...a)); const nb = Math.min(i > 0 ? a[i - 1] : Infinity, i + 1 < a.length ? a[i + 1] : Infinity); T.at({ leaves: A(a, { hl: [i] }), cost: tot }); T.n(`Remove the smallest leaf ${a[i]}: cost of this node?`, a[i] * nb, `${a[i]} · min neighbor ${nb}.`); tot += a[i] * nb; a.splice(i, 1); } return tot; }
  });
})();
