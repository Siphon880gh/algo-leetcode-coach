/* v2 games: dynamic programming (14). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const pc = m => { let c = 0; while (m) { c += m & 1; m >>= 1; } return c; };
  const gcd = (a, b) => b ? gcd(b, a % b) : a;
  const Cb = (n, k) => { if (k < 0 || k > n) return 0; let r = 1; for (let i = 0; i < k; i++) r = r * (n - i) / (i + 1); return Math.round(r); };
  const transform = (I, T, step) => { let c = Array(26).fill(0); for (const ch of I.s) c[ch.charCodeAt(0) - 97]++; for (let t = 1; t <= I.t; t++) { c = step(c); T.at({ s: I.s, round: t, counts: K(c.map((v, i) => [String.fromCharCode(97 + i), v]).filter(x => x[1])) }); T.n(`Length after transformation ${t}?`, c.reduce((a, b) => (a + b) % MOD, 0), 'Move every letter count forward; expanding letters add counts to several letters.'); } return c.reduce((a, b) => (a + b) % MOD, 0); };

  D('sum-of-consecutive-subarrays', {
    t: 'Sum of Consecutive Subarrays: extend while the step stays ±1',
    r: 'From each start, extend while every step is +1 (or every step is −1) and add each subarray sum. Runs make it O(n): a subarray of length ≥ 2 belongs to exactly one maximal run.',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 5) }),
    s(I, T) { const a = I.nums, n = a.length; let tot = 0; for (let i = 0; i < n; i++) { let s = a[i], sub = a[i], d = 0; for (let j = i + 1; j < n; j++) { const st = a[j] - a[j - 1]; if (Math.abs(st) !== 1 || (d && st !== d)) break; d = st; s += a[j]; sub += s; } T.at({ nums: A(a, { hl: [i] }), total: tot }); T.n(`Sum of the values of consecutive subarrays starting at ${i}?`, sub % MOD, 'Add each prefix while the step stays the same ±1.'); tot = (tot + sub) % MOD; } return tot; }
  });

  D('find-the-maximum-sequence-value-of-array', {
    t: 'Maximum Sequence Value: OR sets on both sides of a split',
    r: 'For every split point, left[i] = set of ORs of k elements chosen from nums[0..i], right[i] = set of ORs of k chosen from nums[i..]. Answer = max over splits of a XOR b for a in left, b in right.',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 7), k: 1 }),
    s(I, T) { const a = I.nums, n = a.length, k = I.k, sets = arr => { let dp = [new Set([0])]; for (let j = 1; j <= k; j++) dp.push(new Set()); const out = []; arr.forEach(x => { for (let j = k; j >= 1; j--) for (const v of dp[j - 1]) dp[j].add(v | x); out.push(new Set(dp[k])); }); return out; }; const L = sets(a), Rr = sets(a.slice().reverse()).reverse(); let best = 0; for (let i = k - 1; i + k < n; i++) { let b = 0; for (const x of L[i]) for (const y of Rr[i + 1]) b = Math.max(b, x ^ y); T.at({ nums: A(a, { win: [0, i] }), k }); T.n(`Split after index ${i}: best XOR?`, b, 'Max over left OR values XOR right OR values.'); best = Math.max(best, b); } return best; }
  });

  D('maximum-multiplication-score', {
    t: 'Maximum Multiplication Score: four stages',
    r: 'dp[j] = best score having matched a[0..j] with increasing indices of b. For each b[i], update stages from 3 down to 0: dp[j] = max(dp[j], dp[j−1] + a[j]·b[i]).',
    g: R => ({ a: R.ints(4, -3, 4), b: R.ints(R.int(4, 6), -4, 5) }),
    s(I, T) { const dp = [-Infinity, -Infinity, -Infinity, -Infinity]; I.b.forEach((x, i) => { for (let j = 3; j >= 0; j--) dp[j] = Math.max(dp[j], (j ? dp[j - 1] : 0) + I.a[j] * x); T.at({ a: A(I.a), b: A(I.b, { hl: [i] }), dp: A(dp.map(v => v === -Infinity ? '−∞' : v)) }); if (dp[0] > -Infinity) T.n(`After b[${i}]: best score for the first stage (a[0]·b)?`, dp[0], 'Max of a[0]·b over values so far.'); }); return dp[3]; }
  });

  D('sum-of-consecutive-subsequences', {
    t: 'Sum of Consecutive Subsequences: count and sum by last value',
    r: 'For increasing chains: cntUp[x] += 1 + cntUp[x−1], sumUp[x] += x·(that count) + sumUp[x−1]. Same for decreasing with x+1. Singles appear in both, so subtract Σ nums once.',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 5) }),
    s(I, T) { const cu = {}, su = {}, cd = {}, sd = {}; let U = 0, Dn = 0; I.nums.forEach((x, i) => { const c1 = 1 + (cu[x - 1] || 0), s1 = x * c1 + (su[x - 1] || 0), c2 = 1 + (cd[x + 1] || 0), s2 = x * c2 + (sd[x + 1] || 0); cu[x] = (cu[x] || 0) + c1; su[x] = (su[x] || 0) + s1; cd[x] = (cd[x] || 0) + c2; sd[x] = (sd[x] || 0) + s2; T.at({ nums: A(I.nums, { hl: [i] }) }); T.n(`Sum of increasing consecutive subsequences ending at index ${i}?`, s1 % MOD, `${x}·${c1} + sum of those ending in ${x - 1}.`); U += s1; Dn += s2; }); return ((U + Dn - I.nums.reduce((a, b) => a + b, 0)) % MOD + MOD) % MOD; }
  });

  D('find-the-lexicographically-smallest-valid-sequence', {
    t: 'Lexicographically Smallest Valid Sequence: one change allowed',
    r: 'suf[i] = how many trailing letters of word2 can be matched (exactly) in word1[i..]. Scan word1: take index i if it matches the next letter, or if the one change is still free and the rest of word2 fits in suf[i+1].',
    g: R => ({ word1: R.str(R.int(5, 7), 'abc'), word2: R.str(R.int(2, 3), 'abc') }),
    s(I, T) { const a = I.word1, b = I.word2, n = a.length, m = b.length, suf = Array(n + 1).fill(0); for (let i = n - 1, j = m - 1; i >= 0; i--) { if (j >= 0 && a[i] === b[j]) j--; suf[i] = m - 1 - j; } const out = []; let j = 0, used = false; for (let i = 0; i < n && j < m; i++) { const eq = a[i] === b[j], take = eq || (!used && suf[i + 1] >= m - j - 1); T.at({ word1: A([...a], { hl: [i] }), word2: A([...b], { hl: [j] }), changeUsed: used ? 'yes' : 'no' }); T.yn(`Take word1[${i}] = "${a[i]}" for word2[${j}] = "${b[j]}"?`, take, eq ? 'Exact match.' : take ? 'Spend the one change; the rest still fits.' : used ? 'No change left.' : 'The rest would not fit after it.'); if (take) { if (!eq) used = true; out.push(i); j++; } } return j === m ? out : []; }
  });

  D('find-maximum-removals-from-source-string', {
    t: 'Find Maximum Removals: keep pattern alive, remove the rest',
    r: 'dp[j] = most removable target indices while matching pattern[0..j) in source so far. Each source char either is removed (+1 if it is a target index) or matches pattern[j].',
    g: R => { const source = R.str(R.int(5, 7), 'ab'); const pattern = [...source].filter(() => R.chance(0.4)).join('') || source[0]; return { source, pattern, targetIndices: R.distinct(R.int(2, 4), 0, source.length - 1).sort((a, b) => a - b) }; },
    s(I, T) { const t = new Set(I.targetIndices), m = I.pattern.length; let dp = Array(m + 1).fill(-Infinity); dp[0] = 0; [...I.source].forEach((c, i) => { const nx = dp.map(v => v + (t.has(i) ? 1 : 0)); for (let j = 0; j < m; j++) if (I.pattern[j] === c) nx[j + 1] = Math.max(nx[j + 1], dp[j]); dp = nx; T.at({ source: A([...I.source], { hl: [i] }), pattern: I.pattern, targets: A(I.targetIndices) }); if (dp[m] > -Infinity) T.n(`After index ${i}: most removals with the whole pattern matched?`, dp[m], 'Remove this char (if allowed) or use it for the pattern.'); }); return dp[m]; }
  });

  D('find-the-number-of-possible-ways-for-an-event', {
    t: 'Number of Ways for an Event: choose the non-empty stages',
    r: 'Sum over j (non-empty stages): C(x, j) · surj(n, j) · y^j, where surj(n, j) = ways to put n performers onto j labeled stages with none empty (= j!·S(n, j)).',
    g: R => ({ n: R.int(1, 4), x: R.int(1, 3), y: R.int(1, 3) }),
    s(I, T) { const res = (() => { const S = mk(I.n + 1, I.x + 1, 0); S[0][0] = 1; for (let i = 1; i <= I.n; i++) for (let j = 1; j <= I.x; j++) S[i][j] = j * (S[i - 1][j - 1] + S[i - 1][j]); let tot = 0; for (let j = 1; j <= Math.min(I.n, I.x); j++) { const v = Cb(I.x, j) * S[I.n][j] * I.y ** j; T.at({ n: I.n, stages: I.x, scores: I.y }); T.n(`Ways with exactly ${j} non-empty stages?`, v % MOD, `Choose ${j} of ${I.x} stages, times ${S[I.n][j]} ways to fill them, times ${I.y} to the power ${j}.`); tot = (tot + v) % MOD; } return tot; })(); T.n('Total ways (mod 1e9+7)?', res, 'Add every count of non-empty stages.'); return res; }
  });

  D('count-the-number-of-winning-sequences', {
    t: 'Count Winning Sequences: Bob\'s last move and the score gap',
    r: 'dp[last][diff] = Bob sequences so far ending in creature last with (Bob − Alice) = diff. Bob never repeats a creature in consecutive rounds. Count sequences with diff > 0 at the end.',
    g: R => ({ s: R.str(R.int(2, 4), 'FWE') }),
    s(I, T) { const C = 'FWE', beats = { F: 'E', W: 'F', E: 'W' }, pt = (b, a) => beats[b] === a ? 1 : beats[a] === b ? -1 : 0; let dp = new Map(); [...I.s].forEach((a, i) => { const nx = new Map(), add = (k, v) => nx.set(k, ((nx.get(k) || 0) + v) % MOD); if (!i) for (const b of C) add(b + '|' + pt(b, a), 1); else for (const [k, v] of dp) { const [l, d] = k.split('|'); for (const b of C) if (b !== l) add(b + '|' + (+d + pt(b, a)), v); } dp = nx; let win = 0; for (const [k, v] of dp) if (+k.split('|')[1] > 0) win = (win + v) % MOD; T.at({ alice: A([...I.s], { hl: [i] }) }); T.n(`After round ${i}: Bob sequences currently ahead?`, win, 'Sum states with a positive gap.'); }); let w = 0; for (const [k, v] of dp) if (+k.split('|')[1] > 0) w = (w + v) % MOD; return w; }
  });

  D('maximum-points-tourist-can-earn', {
    t: 'Maximum Points Tourist Can Earn: stay or travel each day',
    r: 'dp[c] = best points ending day i in city c = max(prev[c] + stayScore[i][c], max over p ≠ c of prev[p] + travelScore[p][c]). Start anywhere with 0.',
    g: R => { const n = R.int(2, 3), k = R.int(1, 3); return { n, k, stayScore: Array.from({ length: k }, () => R.ints(n, 1, 6)), travelScore: Array.from({ length: n }, (_, i) => R.ints(n, 1, 6).map((v, j) => i === j ? 0 : v)) }; },
    s(I, T) { let dp = Array(I.n).fill(0); for (let d = 0; d < I.k; d++) { dp = dp.map((v, c) => Math.max(v + I.stayScore[d][c], ...dp.map((p, q) => q !== c ? p + I.travelScore[q][c] : -Infinity))); T.at({ day: d, stay: A(I.stayScore[d]), travel: G(I.travelScore) }); T.n(`Best total after day ${d}?`, Math.max(...dp), 'Stay put or travel in from another city.'); } return Math.max(...dp); }
  });

  D('find-the-original-typed-string-ii', {
    t: 'Find the Original Typed String II: total minus too-short ones',
    r: 'Each run of length L could have been 1..L characters: total = Π L. Subtract originals shorter than k: dp over runs counting lengths < k (each run contributes 1..L).',
    g: R => ({ word: R.str(R.int(4, 7), 'aab'), k: R.int(2, 5) }),
    s(I, T) { const res = (() => { const runs = I.word.match(/(.)\1*/g).map(r => r.length); let tot = 1; runs.forEach(L => tot = tot * L % MOD); T.at({ runs: A(runs), k: I.k }); T.n('How many runs?', runs.length, 'Each run keeps at least one letter.'); T.n('Possible originals ignoring the length limit?', tot, 'Product of run lengths.'); if (runs.length >= I.k) return tot; let dp = Array(I.k).fill(0); dp[0] = 1; runs.forEach(L => { const nx = Array(I.k).fill(0); for (let s = 0; s < I.k; s++) if (dp[s]) for (let t = 1; t <= L && s + t < I.k; t++) nx[s + t] = (nx[s + t] + dp[s]) % MOD; dp = nx; }); const short = dp.reduce((a, b) => (a + b) % MOD, 0); T.n(`Originals shorter than ${I.k}?`, short, 'DP over runs with lengths below k.'); return ((tot - short) % MOD + MOD) % MOD; })(); T.n('Possible originals (mod 1e9+7)?', res, 'All choices minus the ones shorter than k.'); return res; }
  });

  D('total-characters-in-string-after-transformations-i', { t: 'Total Characters After Transformations I: shift the letter counts', r: 'Track counts per letter. Each round, every letter becomes the next one, and "z" becomes "ab" (adding to a and b). Sum the counts.', g: R => ({ s: R.str(R.int(3, 5), 'axyz'), t: R.int(1, 3) }), s: (I, T) => transform(I, T, c => { const n = Array(26).fill(0); for (let i = 0; i < 25; i++) n[i + 1] = c[i]; n[0] = (n[0] + c[25]) % MOD; n[1] = (n[1] + c[25]) % MOD; return n; }) });
  D('total-characters-in-string-after-transformations-ii', { t: 'Total Characters After Transformations II: a 26 × 26 transition', r: 'Letter i becomes the next nums[i] letters (wrapping). Counts evolve by a fixed 26 × 26 matrix, so huge t uses matrix power; here, step the counts.', g: R => ({ s: R.str(R.int(2, 4), 'abyz'), t: R.int(1, 3), nums: Array.from({ length: 26 }, () => R.int(1, 2)) }), s: (I, T) => transform(I, T, c => { const n = Array(26).fill(0); c.forEach((v, i) => { for (let d = 1; d <= I.nums[i]; d++) n[(i + d) % 26] = (n[(i + d) % 26] + v) % MOD; }); return n; }) });

  D('find-the-number-of-subsequences-with-equal-gcd', {
    t: 'Subsequences With Equal GCD: track both gcds',
    r: 'dp[g1][g2] = ways with seq1 gcd g1 and seq2 gcd g2 (0 = empty). Each number goes to seq1, seq2, or neither. Answer: Σ dp[g][g] for g ≥ 1.',
    g: R => ({ nums: R.ints(R.int(2, 4), 1, 6) }),
    s(I, T) { const M = Math.max(...I.nums); let dp = mk(M + 1, M + 1, 0); dp[0][0] = 1; I.nums.forEach((x, i) => { const nx = dp.map(r => r.slice()); for (let a = 0; a <= M; a++) for (let b = 0; b <= M; b++) if (dp[a][b]) { const ga = gcd(a, x), gb = gcd(b, x); nx[ga][b] = (nx[ga][b] + dp[a][b]) % MOD; nx[a][gb] = (nx[a][gb] + dp[a][b]) % MOD; } dp = nx; let eq = 0; for (let g = 1; g <= M; g++) eq = (eq + dp[g][g]) % MOD; T.at({ nums: A(I.nums, { hl: [i] }) }); T.n(`After ${x}: pairs with equal gcd so far?`, eq, 'Σ dp[g][g].'); }); let r = 0; for (let g = 1; g <= M; g++) r = (r + dp[g][g]) % MOD; return r; }
  });

  D('find-the-number-of-k-even-arrays', {
    t: 'Number of k-Even Arrays: both neighbors even',
    r: '(a·b) − a − b is even exactly when a and b are both even. dp[j][p] = arrays so far with j such pairs ending in parity p; there are ⌊m/2⌋ even and ⌈m/2⌉ odd choices.',
    g: R => ({ n: R.int(2, 4), m: R.int(2, 5), k: R.int(0, 2) }),
    s(I, T) { const E = Math.floor(I.m / 2), O = I.m - E; let dp = mk(I.k + 1, 2, 0); dp[0][0] = E; dp[0][1] = O; for (let i = 1; i < I.n; i++) { const nx = mk(I.k + 1, 2, 0); for (let j = 0; j <= I.k; j++) { nx[j][1] = (dp[j][0] + dp[j][1]) * O % MOD; nx[j][0] = ((j ? dp[j - 1][0] : 0) + dp[j][1]) * E % MOD; } dp = nx; T.at({ length: i + 1, evens: E, odds: O }); T.n(`Arrays of length ${i + 1} with exactly ${I.k} even-even pairs?`, (dp[I.k][0] + dp[I.k][1]) % MOD, 'An even after an even adds a pair.'); } return (dp[I.k][0] + dp[I.k][1]) % MOD; }
  });

  D('count-number-of-balanced-permutations', {
    t: 'Count Balanced Permutations: split digits between even and odd slots',
    r: 'The digit sum must be even. Choose how many of each digit go to the ⌈n/2⌉ even slots so they sum to half; each choice gives (even slots)!·(odd slots)! / Π(counts)! arrangements.',
    g: R => ({ num: R.str(R.int(3, 5), '0123') }),
    s(I, T) { const res = (() => { const s = I.num, S = [...s].reduce((a, c) => a + +c, 0); T.at({ num: s }); T.n('How many digits?', s.length, 'Half go to even positions.'); T.yn(`Is the digit sum ${S} even?`, S % 2 === 0, 'Both halves must sum to half of S.'); if (S % 2) return 0; const seen = new Set(), perm = (a, p) => { if (!a.length) { seen.add(p); return; } a.forEach((c, i) => perm(a.slice(0, i).concat(a.slice(i + 1)), p + c)); }; perm([...s], ''); let c = 0; for (const p of seen) { let e = 0, o = 0; [...p].forEach((d, i) => i % 2 ? o += +d : e += +d); if (e === o) c++; } T.n('Distinct permutations in total?', seen.size, 'n factorial divided by the factorial of each digit count.'); return c % MOD; })(); T.n('Balanced permutations?', res, 'Even-index sum equals odd-index sum.'); return res; }
  });

  D('sum-of-good-subsequences', {
    t: 'Sum of Good Subsequences: neighbors differ by exactly 1',
    r: 'cnt[v] / sum[v] = number / total sum of good subsequences ending in value v. For x: c = 1 + cnt[x−1] + cnt[x+1]; s = x·c + sum[x−1] + sum[x+1]. Add them into cnt[x], sum[x].',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 4) }),
    s(I, T) { const cnt = {}, sm = {}; let tot = 0; I.nums.forEach((x, i) => { const c = 1 + (cnt[x - 1] || 0) + (cnt[x + 1] || 0), s = x * c + (sm[x - 1] || 0) + (sm[x + 1] || 0); T.at({ nums: A(I.nums, { hl: [i] }), cnt: K(cnt), sum: K(sm) }); T.n(`Total of good subsequences ending at index ${i}?`, s % MOD, `${x}·${c} + sums ending in ${x - 1} and ${x + 1}.`); cnt[x] = (cnt[x] || 0) + c; sm[x] = ((sm[x] || 0) + s) % MOD; tot = (tot + s) % MOD; }); return tot; }
  });

  D('count-k-reducible-numbers-less-than-n', {
    t: 'Count k-Reducible Numbers: group by popcount',
    r: 'ops(c) = steps for a number with c set bits to reach 1 = 1 + ops(popcount(c)), ops(1) = 0. x > 1 works if 1 + ops(popcount(x)) ≤ k (x = 1 needs 0). Count x < n with each popcount by walking n\'s bits (combinations).',
    g: R => ({ s: '1' + R.str(R.int(2, 4), '01'), k: R.int(1, 2) }),
    s(I, T) {
      const s = I.s, L = s.length, ops = c => { let o = 0; while (c > 1) { c = pc(c); o++; } return o; }, cnt = Array(L + 1).fill(0); let ones = 0;
      for (let i = 0; i < L; i++) if (s[i] === '1') { const rest = L - i - 1; for (let j = 0; j <= rest; j++) cnt[ones + j] += Cb(rest, j); ones++; }
      let tot = 0; for (let c = 1; c <= L; c++) if (cnt[c]) { const ok = c === 1 || 1 + ops(c) <= I.k; T.at({ n: s, k: I.k, popcount: c }); T.n(`Numbers below n with ${c} set bit(s)?`, cnt[c], 'Walk n\'s bits: each 1 you lower frees the bits after it.'); if (ok) tot = (tot + cnt[c]) % MOD; }
      return tot;
    }
  });

  D('find-the-maximum-number-of-fruits-collected', {
    t: 'Maximum Fruits Collected: one diagonal, two triangles',
    r: 'The (0,0) child must walk the main diagonal (n − 1 moves). The other two stay in their own triangles above and below it; each is a separate path DP that ends next to the corner.',
    g: R => { const n = R.int(3, 4); return { fruits: Array.from({ length: n }, () => R.ints(n, 0, 6)) }; },
    s(I, T) {
      const f = I.fruits, n = f.length; let diag = 0; for (let i = 0; i < n; i++) diag += f[i][i]; T.at({ fruits: G(f, { hl: [...Array(n).keys()].map(i => [i, i]) }) }); T.n('Fruits on the main diagonal?', diag, 'The first child must take it.');
      const tri = get => { let dp = Array(n).fill(-Infinity); dp[n - 1] = get(0, n - 1); for (let r = 1; r < n - 1; r++) { const nx = Array(n).fill(-Infinity); for (let c = Math.max(r + 1, n - 1 - r); c < n; c++) { const b = Math.max(dp[c - 1] ?? -Infinity, dp[c], c + 1 < n ? dp[c + 1] : -Infinity); if (b > -Infinity) nx[c] = b + get(r, c); } dp = nx; } return dp[n - 1]; };
      const up = tri((r, c) => f[r][c]), lo = tri((r, c) => f[c][r]); T.n('Best for the top-right child (before the last room)?', up, 'Path DP inside the upper triangle.'); T.n('Best for the bottom-left child (before the last room)?', lo, 'Path DP inside the lower triangle.'); return diag + up + lo;
    }
  });

  D('minimum-array-sum', {
    t: 'Minimum Array Sum: halve, subtract, both, or neither',
    r: 'dp[a][b] = least sum so far using a halvings and b subtractions. For each number try the four combos (when both, pick the better order). Answer: min over a ≤ op1, b ≤ op2.',
    g: R => ({ nums: R.ints(R.int(3, 4), 0, 12), k: R.int(1, 4), op1: R.int(0, 2), op2: R.int(0, 2) }),
    s(I, T) { const { k, op1, op2 } = I; let dp = mk(op1 + 1, op2 + 1, Infinity); dp[0][0] = 0; I.nums.forEach((x, i) => { const nx = mk(op1 + 1, op2 + 1, Infinity), h = v => Math.ceil(v / 2); for (let a = 0; a <= op1; a++) for (let b = 0; b <= op2; b++) if (dp[a][b] < Infinity) { const up = (p, q, v) => { if (p <= op1 && q <= op2) nx[p][q] = Math.min(nx[p][q], dp[a][b] + v); }; up(a, b, x); up(a + 1, b, h(x)); if (x >= k) up(a, b + 1, x - k); let both = Infinity; if (x >= k) both = Math.min(both, h(x - k)); if (h(x) >= k) both = Math.min(both, h(x) - k); if (both < Infinity) up(a + 1, b + 1, both); } dp = nx; T.at({ nums: A(I.nums, { hl: [i] }), k, op1, op2 }); T.n(`Least sum of the first ${i + 1} numbers?`, Math.min(...dp.flat()), 'Try halve, subtract, both, or neither.'); }); return Math.min(...dp.flat()); }
  });

  D('count-beautiful-splits-in-an-array', {
    t: 'Count Beautiful Splits: prefix checks with an LCP table',
    r: 'Split at i < j. Beautiful if nums1 (length i) is a prefix of nums2 (needs j − i ≥ i and lcp(0, i) ≥ i), or nums2 is a prefix of nums3 (needs n − j ≥ j − i and lcp(i, j) ≥ j − i).',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 2) }),
    s(I, T) { const a = I.nums, n = a.length, lcp = (x, y) => { let l = 0; while (y + l < n && a[x + l] === a[y + l]) l++; return l; }; let c = 0; for (let i = 1; i < n - 1; i++) for (let j = i + 1; j < n; j++) { const ok = (j - i >= i && lcp(0, i) >= i) || (n - j >= j - i && lcp(i, j) >= j - i); T.at({ nums: A(a, { win: [i, j - 1] }) }); T.yn(`Split [${a.slice(0, i)}] [${a.slice(i, j)}] [${a.slice(j)}]: beautiful?`, ok, 'Check both prefix conditions.'); if (ok) c++; } return c; }
  });

  D('count-paths-with-the-given-xor-value', {
    t: 'Count Paths With the Given XOR: 16 states per cell',
    r: 'dp[r][c][x] = paths to (r, c) whose XOR is x (values < 16). Combine from above and from the left, XORing in grid[r][c].',
    g: R => ({ grid: R.grid(R.int(2, 3), R.int(2, 3), 0, 15), k: R.int(0, 15) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, dp = Array.from({ length: m }, () => Array.from({ length: n }, () => Array(16).fill(0))); for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) { if (!r && !c) { dp[0][0][g[0][0]] = 1; continue; } for (let x = 0; x < 16; x++) dp[r][c][x ^ g[r][c]] = ((r ? dp[r - 1][c][x] : 0) + (c ? dp[r][c - 1][x] : 0)) % MOD; T.at({ grid: G(g, { hl: [[r, c]] }), k: I.k }); T.n(`Paths to (${r},${c}) with XOR ${I.k}?`, dp[r][c][I.k], 'XOR this cell into the counts from above and left.'); } return dp[m - 1][n - 1][I.k]; }
  });

  D('longest-subsequence-with-decreasing-adjacent-difference', {
    t: 'Longest Subsequence With Non-Increasing Differences',
    r: 'dp[i][d] = longest valid subsequence ending at i whose last difference is d. Extending from j with difference d needs the previous last difference ≥ d: dp[i][d] = 1 + max(1, best dp[j][d′ ≥ d]) (a suffix max over d′).',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, dp = Array.from({ length: n }, () => new Map()); let best = 1; for (let i = 0; i < n; i++) { let bi = 1; for (let j = 0; j < i; j++) { const d = Math.abs(a[i] - a[j]); let p = 1; for (const [dd, v] of dp[j]) if (dd >= d) p = Math.max(p, v); const v = p + 1; dp[i].set(d, Math.max(dp[i].get(d) || 0, v)); bi = Math.max(bi, v); } T.at({ nums: A(a, { hl: [i] }), best }); T.n(`Longest valid subsequence ending at index ${i}?`, bi, 'Extend from j when j\'s last difference is at least |nums[i] − nums[j]|.'); best = Math.max(best, bi); } return best; }
  });

  D('maximum-score-of-non-overlapping-intervals', {
    t: 'Maximum Score of Non-Overlapping Intervals: up to 4, smallest indices',
    r: 'Sort by end; dp[c][i] = best (score, sorted index list) using c intervals among the first i, comparing score first and then index lists lexicographically. Taking an interval jumps to the last one ending before its start.',
    g: R => ({ intervals: Array.from({ length: R.int(3, 5) }, () => { const l = R.int(1, 8); return [l, l + R.int(0, 3), R.int(1, 6)]; }) }),
    s(I, T) { const res = (() => { const iv = I.intervals, n = iv.length; let best = null; const cmpArr = (x, y) => { for (let k = 0; k < Math.min(x.length, y.length); k++) if (x[k] !== y[k]) return x[k] - y[k]; return x.length - y.length; }; for (let m = 1; m < 1 << n; m++) { const ids = [...Array(n).keys()].filter(i => m >> i & 1); if (ids.length > 4) continue; const s2 = ids.slice().sort((x, y) => iv[x][0] - iv[y][0]); if (s2.some((v, k) => k && iv[s2[k - 1]][1] >= iv[v][0])) continue; const sc = ids.reduce((t, i) => t + iv[i][2], 0); if (!best || sc > best[0] || (sc === best[0] && cmpArr(ids, best[1]) < 0)) best = [sc, ids]; } T.at({ intervals: A(iv.map(x => `${x[0]} to ${x[1]}, weight ${x[2]}`)) }); T.n('Heaviest single interval?', Math.max(...iv.map(x => x[2])), 'One choice on its own.'); T.n('Maximum total weight (at most 4, no shared points)?', best[0], 'Weighted interval scheduling with a count limit.'); return best[1]; })(); T.n('How many intervals are chosen?', res.length, 'At most 4.'); return res; }
  });

  D('maximum-amount-of-money-robot-can-earn', {
    t: 'Maximum Amount the Robot Can Earn: neutralize up to 2 robbers',
    r: 'dp[r][c][u] = best profit at (r, c) having neutralized u robbers. A negative cell can be taken as is, or neutralized (u + 1 ≤ 2, adds 0).',
    g: R => ({ coins: R.grid(R.int(2, 3), R.int(2, 3), -5, 5) }),
    s(I, T) { const g = I.coins, m = g.length, n = g[0].length, dp = Array.from({ length: m }, () => Array.from({ length: n }, () => Array(3).fill(-Infinity))); for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) for (let u = 0; u < 3; u++) { const prev = (uu) => (!r && !c) ? (uu === 0 ? 0 : -Infinity) : Math.max(r ? dp[r - 1][c][uu] : -Infinity, c ? dp[r][c - 1][uu] : -Infinity); let v = prev(u) + g[r][c]; if (g[r][c] < 0 && u) v = Math.max(v, prev(u - 1)); dp[r][c][u] = v; } for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (r + c) { T.at({ coins: G(g, { hl: [[r, c]] }) }); T.n(`Best profit reaching (${r},${c}) with up to 2 neutralizations?`, Math.max(...dp[r][c]), 'Take the cell, or neutralize a robber if you have one left.'); } return Math.max(...dp[m - 1][n - 1]); }
  });

  D('maximum-and-minimum-sums-of-at-most-size-k-subsequences', {
    t: 'Max and Min Sums of Size ≤ k Subsequences: count roles per element',
    r: 'Sort. nums[i] is the maximum of Σ_{j<k} C(i, j) subsequences (pick up to k − 1 smaller ones before it) and the minimum of Σ_{j<k} C(n−1−i, j). Add value × (both counts).',
    g: R => ({ nums: R.ints(R.int(3, 4), 0, 6), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length; let tot = 0; a.forEach((x, i) => { let mx = 0, mn = 0; for (let j = 0; j < I.k; j++) { mx += Cb(i, j); mn += Cb(n - 1 - i, j); } T.at({ sorted: A(a, { hl: [i] }), k: I.k }); T.n(`In how many size-≤${I.k} subsequences is index ${i} the maximum?`, mx, `Σ C(${i}, j) for j < ${I.k}.`); tot = (tot + x * (mx + mn)) % MOD; }); return tot; }
  });

  D('paint-house-iv', {
    t: 'Paint House IV: paint mirrored pairs together',
    r: 'Process pairs (i, n−1−i) from the outside in. State: the colors of the previous pair. A pair (a, b) needs a ≠ b, a ≠ previous left color, b ≠ previous right color.',
    g: R => { const n = 2 * R.int(1, 3); return { n, cost: Array.from({ length: n }, () => R.ints(3, 1, 9)) }; },
    s(I, T) { const n = I.n, c = I.cost; let dp = mk(3, 3, 0); for (let i = 0; i < n / 2; i++) { const j = n - 1 - i, nx = mk(3, 3, Infinity); for (let a = 0; a < 3; a++) for (let b = 0; b < 3; b++) if (a !== b) { let best = Infinity; for (let p = 0; p < 3; p++) for (let q = 0; q < 3; q++) if (i === 0 || (p !== a && q !== b && p !== q)) best = Math.min(best, dp[p][q]); nx[a][b] = best + c[i][a] + c[j][b]; } dp = nx; T.at({ cost: G(c, { hl: [[i, 0], [i, 1], [i, 2], [j, 0], [j, 1], [j, 2]] }) }); T.n(`Cheapest cost after pair (${i}, ${j})?`, Math.min(...dp.flat()), 'Different colors in the pair, and different from the neighbors outside.'); } return Math.min(...dp.flat()); }
  });

  D('maximum-frequency-after-subarray-operation', {
    t: 'Maximum Frequency After Subarray Operation: Kadane per value',
    r: 'Base = count of k. Turning value v into k inside a subarray gains (#v − #k) there. For each v, Kadane on +1 for v, −1 for k. Answer = base + best gain.',
    g: R => ({ nums: R.ints(R.int(5, 7), 1, 4), k: R.int(1, 4) }),
    s(I, T) { const base = I.nums.filter(x => x === I.k).length; let best = 0; for (const v of [...new Set(I.nums)].filter(v => v !== I.k).sort((a, b) => a - b)) { let cur = 0, b = 0; for (const x of I.nums) { cur = Math.max(0, cur + (x === v ? 1 : x === I.k ? -1 : 0)); b = Math.max(b, cur); } T.at({ nums: A(I.nums, { cls: I.nums.map(x => x === v ? 'ok' : x === I.k ? 'bad' : '') }), k: I.k, base }); T.n(`Best gain from turning ${v}s into ${I.k}?`, b, 'Kadane: +1 for v, −1 for k.'); best = Math.max(best, b); } return base + best; }
  });

  D('minimum-cost-good-caption', {
    t: 'Minimum Cost Good Caption: runs of at least 3',
    r: 'dp from the right: each block of ≥ 3 equal letters costs Σ |caption[i] − letter|. Tie-break toward the lexicographically smallest result. Here: try every good caption over the nearby letters.',
    g: R => ({ caption: R.str(R.int(3, 6), 'bcd') }),
    s(I, T) {
      const s = I.caption, n = s.length; if (n < 3) { T.at({ caption: A([...s]) }); T.n('Caption length?', n, 'Every run needs 3 letters.'); T.yn('Is a good caption possible?', false, 'Too short.'); T.n('Length of the answer?', 0, 'Return the empty string.'); return ''; } const lo = Math.min(...[...s].map(c => c.charCodeAt(0))), hi = Math.max(...[...s].map(c => c.charCodeAt(0))); let best = null, bc = Infinity;
      const rec = (p, cur, cost) => { if (cost > bc) return; if (p === n) { if (cost < bc || (cost === bc && cur < best)) { bc = cost; best = cur; } return; } for (let ch = lo; ch <= hi; ch++) for (let L = 3; p + L <= n; L++) { if (cur && cur.charCodeAt(cur.length - 1) === ch) continue; let c = cost; for (let i = p; i < p + L; i++) c += Math.abs(s.charCodeAt(i) - ch); rec(p + L, cur + String.fromCharCode(ch).repeat(L), c); } };
      rec(0, '', 0); T.at({ caption: A([...s]) }); T.n('Minimum number of operations?', bc, 'Best split into runs of at least 3 letters.'); T.n('Runs in the best caption?', best.match(/(.)\1*/g).length, 'Each run is one letter repeated.'); T.yn('Was the caption already good?', bc === 0, 'Zero operations.'); return best;
    }
  });

  D('minimum-increments-for-target-multiples-in-an-array', {
    t: 'Minimum Increments for Target Multiples: bitmask over targets',
    r: 'For each subset of targets, its LCM is what one number must reach. cost(x, mask) = smallest increment to a multiple of lcm(mask). dp[mask] over numbers: each number covers some new subset or nothing.',
    g: R => ({ nums: R.ints(R.int(2, 3), 1, 9), target: R.ints(R.int(1, 2), 2, 6) }),
    s(I, T) { const t = I.target, m = t.length, full = (1 << m) - 1, lcm = (a, b) => a / gcd(a, b) * b, L = [1]; for (let s = 1; s <= full; s++) { let v = 1; for (let i = 0; i < m; i++) if (s >> i & 1) v = lcm(v, t[i]); L[s] = v; } let dp = Array(1 << m).fill(Infinity); dp[0] = 0; I.nums.forEach((x, i) => { const nx = dp.slice(); for (let mask = 0; mask <= full; mask++) if (dp[mask] < Infinity) for (let s = 1; s <= full; s++) { const c = (L[s] - x % L[s]) % L[s]; nx[mask | s] = Math.min(nx[mask | s], dp[mask] + c); } dp = nx; T.at({ nums: A(I.nums, { hl: [i] }), target: A(t) }); T.n(`After ${x}: least cost to cover every target (inf if not yet)?`, dp[full], 'Let this number cover some subset (via its LCM).'); }); return dp[full]; }
  });

  D('count-substrings-divisible-by-last-digit', {
    t: 'Count Substrings Divisible by Last Digit: remainders per divisor',
    r: 'For each divisor d in 1..9 keep cnt[d][r] = substrings ending at the previous index with value ≡ r (mod d). Extending by digit c maps r to (10r + c) mod d. If c ≠ 0, add cnt[c][0] (including the single digit).',
    g: R => ({ s: R.str(R.int(3, 5), '0123456') }),
    s(I, T) { let cnt = Array.from({ length: 10 }, (_, d) => Array(Math.max(d, 1)).fill(0)), tot = 0; [...I.s].forEach((ch, i) => { const c = +ch, nx = Array.from({ length: 10 }, (_, d) => Array(Math.max(d, 1)).fill(0)); for (let d = 1; d <= 9; d++) { for (let r = 0; r < d; r++) nx[d][(10 * r + c) % d] += cnt[d][r]; nx[d][c % d]++; } cnt = nx; const add = c ? cnt[c][0] : 0; T.at({ s: A([...I.s], { hl: [i] }), total: tot }); T.n(`Substrings ending at index ${i} divisible by ${c || '(0: none)'}?`, add, c ? `Substrings ending here with value ≡ 0 (mod ${c}).` : 'A last digit of 0 never counts.'); tot += add; }); return tot; }
  });

  D('select-k-disjoint-special-substrings', {
    t: 'Select k Disjoint Special Substrings: closed intervals, then greedy',
    r: 'From each letter\'s first occurrence, expand [first, last] until it contains every occurrence of every letter inside; if that never reaches back before the start, it is a candidate (unless it is the whole string). Pick disjoint candidates greedily by right end.',
    g: R => ({ s: R.str(R.int(5, 8), 'abcd'), k: R.int(1, 3) }),
    s(I, T) { const res = (() => { const s = I.s, n = s.length, f = {}, l = {}; [...s].forEach((c, i) => { if (f[c] === undefined) f[c] = i; l[c] = i; }); const cand = []; for (const c of Object.keys(f)) { const st = f[c]; let e = l[c], ok = true; for (let i = st; i <= e; i++) { if (f[s[i]] < st) { ok = false; break; } e = Math.max(e, l[s[i]]); } if (ok && !(st === 0 && e === n - 1)) cand.push([st, e]); } T.at({ s: A([...s]) }); T.n('How many special candidate intervals?', cand.length, 'Closed intervals starting at a first occurrence, not the whole string.'); cand.sort((a, b) => a[1] - b[1]); let end = -1, c = 0; for (const [a, b] of cand) if (a > end) { c++; end = b; } T.n('Most disjoint special substrings?', c, 'Greedy by right end.'); return c >= I.k; })(); T.yn(`Can you pick ${I.k}?`, res, 'Need at least k disjoint ones.'); return res; }
  });

  D('length-of-longest-v-shaped-diagonal-segment', {
    t: 'Longest V-Shaped Diagonal Segment: 1, then 2, 0, 2, 0 … with one turn',
    r: 'Start at a 1, move diagonally expecting 2, 0, 2, 0, …; at most once, turn 90° clockwise and keep the sequence. Memoize f(cell, direction, turned, expected).',
    g: R => ({ grid: R.grid(R.int(3, 4), R.int(3, 4), 0, 2) }),
    s(I, T) {
      const g = I.grid, n = g.length, m = g[0].length, D4 = [[1, 1], [1, -1], [-1, -1], [-1, 1]], memo = new Map();
      const f = (r, c, d, t, want) => { const x = r + D4[d][0], y = c + D4[d][1]; if (x < 0 || y < 0 || x >= n || y >= m || g[x][y] !== want) return 0; const k = [x, y, d, t, want].join(); if (memo.has(k)) return memo.get(k); let b = 1 + f(x, y, d, t, 2 - want); if (!t) b = Math.max(b, 1 + f(x, y, (d + 1) % 4, 1, 2 - want)); memo.set(k, b); return b; };
      let straight = 0, best = 0; for (let r = 0; r < n; r++) for (let c = 0; c < m; c++) if (g[r][c] === 1) for (let d = 0; d < 4; d++) { let len = 1, x = r, y = c, w = 2; while (true) { x += D4[d][0]; y += D4[d][1]; if (x < 0 || y < 0 || x >= n || y >= m || g[x][y] !== w) break; len++; w = 2 - w; } straight = Math.max(straight, len); best = Math.max(best, 1 + f(r, c, d, 0, 2)); }
      T.at({ grid: G(g) }); T.n('Cells with value 1?', g.flat().filter(v => v === 1).length, 'Every segment starts at a 1.'); T.n('Longest segment with no turn?', straight, 'Walk each diagonal from every 1.'); T.n('Longest with at most one clockwise turn?', best, 'Allow one 90° clockwise turn mid-way.'); return best;
    }
  });
  D('minimum-operations-to-make-character-frequencies-equal', {
    t: 'Make Character Frequencies Equal: try every target count',
    r: 'Try each target f. Walk letters a→z; each letter ends with 0 or f copies. Extra copies cost 1 each (delete, or change to the next letter, where they can fill a shortage); missing copies cost 1 each (insert). Keep the best per f.',
    g: R => ({ s: R.str(R.int(3, 6), 'abc') }),
    s(I, T) {
      const cnt = Array(26).fill(0); for (const ch of I.s) cnt[ch.charCodeAt(0) - 97]++; const mx = Math.max(...cnt); let best = Infinity;
      for (let f = 1; f <= mx; f++) {
        let dp = new Map([[0, 0]]);
        for (let i = 0; i < 26; i++) { const nx = new Map(), put = (e, v) => { if (!nx.has(e) || nx.get(e) > v) nx.set(e, v); }; for (const [e, v] of dp) for (let sh = 0; sh <= e; sh++) { const have = cnt[i] + sh; for (const g of [0, f]) { if (have >= g) put(have - g, v + have - g); else put(0, v + g - have); } } dp = nx; }
        const r = Math.min(...dp.values()); T.at({ counts: K(cnt.map((v, i) => [String.fromCharCode(97 + i), v]).filter(x => x[1])) }); T.n(`Fewest operations if every present letter appears ${f} time(s)?`, r, 'Extras cost 1 (delete or pass on to the next letter); shortages cost 1 (insert).'); best = Math.min(best, r);
      }
      return best;
    }
  });
})();
