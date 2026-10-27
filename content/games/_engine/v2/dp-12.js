/* v2 games: dynamic programming (12). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7, BM = 1000000007n;
  const pw = (b, e) => { let r = 1n, x = BigInt(b) % BM, k = BigInt(e); while (k > 0n) { if (k & 1n) r = r * x % BM; x = x * x % BM; k >>= 1n; } return r; };

  D('maximize-the-profit-as-the-salesman', {
    t: 'Maximize the Profit as the Salesman: offers ending at each house',
    r: 'dp[i] = best gold using houses 0..i−1. dp[i + 1] = max(dp[i], dp[start] + gold for every offer ending at house i).',
    g: R => { const n = R.int(4, 6); return { n, offers: Array.from({ length: R.int(3, 5) }, () => { const s = R.int(0, n - 1); return [s, R.int(s, n - 1), R.int(1, 9)]; }) }; },
    s(I, T) { const dp = [0]; for (let i = 0; i < I.n; i++) { let v = dp[i]; for (const [s, e, g] of I.offers) if (e === i) v = Math.max(v, dp[s] + g); T.at({ offers: A(I.offers.map(o => `${o[0]}-${o[1]}:${o[2]}`), { hl: I.offers.map((o, k) => o[1] === i ? k : -1).filter(k => k >= 0) }), dp: A(dp.concat('?')) }); T.n(`dp[${i + 1}] (houses 0..${i})?`, v, 'Skip house i, or take an offer ending here.'); dp.push(v); } return dp[I.n]; }
  });

  D('maximize-value-of-function-in-a-ball-passing-game', {
    t: 'Ball Passing Game: sum the ids along k passes',
    r: 'f(x) = x + receiver[x] + receiver²[x] + … (k passes). Binary lifting stores the 2^j-th receiver and the sum along the way; here, simulate each start.',
    g: R => { const n = R.int(3, 5); return { receiver: Array.from({ length: n }, () => R.int(0, n - 1)), k: R.int(2, 4) }; },
    s(I, T) { let best = 0; I.receiver.forEach((_, x) => { let s = x, c = x; for (let j = 0; j < I.k; j++) { c = I.receiver[c]; s += c; } T.at({ receiver: A(I.receiver, { hl: [x] }), k: I.k }); T.n(`f(${x})?`, s, 'Add every id the ball visits.'); best = Math.max(best, s); }); return best; }
  });

  D('string-transformation', {
    t: 'String Transformation: rotations as a two-state walk',
    r: 'Each operation rotates s by a nonzero shift. Track a = ways to be at shift 0, b = ways to be at one particular nonzero shift: a\' = (n − 1)·b, b\' = a + (n − 2)·b. Answer = [t == s]·a + (nonzero shifts giving t)·b.',
    g: R => { const s = R.str(R.int(3, 5), 'ab'), p = R.int(0, s.length - 1); return { s, t: s.slice(p) + s.slice(0, p), k: R.int(1, 4) }; },
    s(I, T) { const s = I.s, t = I.t, n = s.length; let m = 0; for (let p = 1; p < n; p++) if (s.slice(p) + s.slice(0, p) === t) m++; T.at({ s, t }); T.n('Nonzero shifts that turn s into t?', m, 'Rotate s by each p and compare (KMP on s+s in the full solution).'); let a = 1n, b = 0n; for (let i = 1; i <= I.k; i++) { const na = (BigInt(n - 1) * b) % BM, nb = (a + BigInt(n - 2) * b) % BM; a = na; b = nb; T.at({ step: i, n }); T.n(`After ${i} operation(s): ways to be at a given nonzero shift?`, Number(b), `a + (n − 2)·b.`); } return Number(((s === t ? a : 0n) + BigInt(m) * b) % BM); }
  });

  D('the-wording-game', {
    t: 'The Wording Game: minimax over the last word',
    r: 'A move must be a word greater than the last one whose first letter is the same or the next letter. A player with no move loses. Alice opens with her smallest word; search who can force a win.',
    g: R => { const w = () => R.pick('abcd'.split('')) + R.str(2, 'ab'); const a = [...new Set(Array.from({ length: R.int(2, 3) }, w))].sort(), b = [...new Set(Array.from({ length: R.int(2, 3) }, w))].filter(x => !a.includes(x)).sort(); return { a, b: b.length ? b : ['zz'] }; },
    s(I, T) {
      const L = [I.a, I.b], ok = (w, x) => x > w && (x[0] === w[0] || x.charCodeAt(0) === w.charCodeAt(0) + 1), memo = new Map();
      const win = (w, p) => { const k = w + p; if (memo.has(k)) return memo.get(k); const r = L[p].some(x => ok(w, x) && !win(x, 1 - p)); memo.set(k, r); return r; };
      let w = I.a[0], p = 1; T.at({ alice: A(I.a), bob: A(I.b), last: w }); T.yn(`Alice opens "${w}". Can Bob force a win from here?`, win(w, 1), 'Search every reply.');
      while (true) { const moves = L[p].filter(x => ok(w, x)); if (!moves.length) break; const good = moves.filter(x => !win(x, 1 - p)); const x = (good[0] || moves[0]); T.at({ alice: A(I.a), bob: A(I.b), last: w }); T.n(`${p ? 'Bob' : 'Alice'} has how many legal moves after "${w}"?`, moves.length, 'Greater word, same or next first letter.'); w = x; p = 1 - p; }
      return !win(I.a[0], 1);
    }
  });

  D('minimizing-array-after-replacing-pairs-with-their-product', {
    t: 'Minimizing Array After Replacing Pairs: merge while the product fits',
    r: 'Greedy left to right: multiply the next number into the current block if the product stays ≤ k; otherwise start a new block. A 0 anywhere makes the answer 1.',
    g: R => ({ nums: R.ints(R.int(4, 7), 1, 6), k: R.int(4, 20) }),
    s(I, T) { if (I.nums.includes(0)) return 1; let cur = I.nums[0], cnt = 1; for (let i = 1; i < I.nums.length; i++) { const x = I.nums[i], ok = cur * x <= I.k; T.at({ nums: A(I.nums, { hl: [i] }), block: cur, k: I.k }); T.yn(`Merge ${x} into the block (${cur})?`, ok, ok ? `${cur}·${x} ≤ ${I.k}.` : `${cur}·${x} > ${I.k}: new block.`); if (ok) cur *= x; else { cur = x; cnt++; } } return cnt; }
  });

  D('apply-operations-to-make-two-strings-equal', {
    t: 'Apply Operations to Make Two Strings Equal: pair up the mismatches',
    r: 'List mismatch positions p. An odd count is impossible. Fix pairs either with any-two flips (cost x per pair, x/2 per mismatch) or neighbor-chain flips (cost p[i] − p[i−1]). dp[i] = min(dp[i−1] + x/2, dp[i−2] + p[i] − p[i−1]).',
    g: R => { const n = R.int(4, 7); return { s1: R.str(n, '01'), s2: R.str(n, '01'), x: R.int(1, 4) }; },
    s(I, T) { const p = [...I.s1].map((c, i) => c !== I.s2[i] ? i : -1).filter(i => i >= 0); T.at({ s1: A([...I.s1], { hl: p }), s2: A([...I.s2], { hl: p }) }); T.n('How many mismatched positions?', p.length, 'Compare position by position.'); if (p.length % 2) return -1; const dp = [0]; for (let i = 1; i <= p.length; i++) { let v = dp[i - 1] + I.x / 2; if (i >= 2) v = Math.min(v, dp[i - 2] + p[i - 1] - p[i - 2]); T.at({ mismatches: A(p, { hl: [i - 1] }), dp: A(dp.concat('?')), x: I.x }); T.n(`dp[${i}]?`, v, `min(dp[${i - 1}] + ${I.x}/2, chain to the previous mismatch).`); dp.push(v); } return dp[p.length]; }
  });

  D('longest-unequal-adjacent-groups-subsequence-i', {
    t: 'Longest Unequal Adjacent Groups I: take a word whenever the group flips',
    r: 'Greedy: always take the first word, then every word whose group differs from the last taken one.',
    g: R => { const n = R.int(4, 6); return { words: R.distinct(n, 0, 25).map(i => 'abcdefghijklmnopqrstuvwxyz'[i]), groups: Array.from({ length: n }, () => R.int(0, 1)) }; },
    s(I, T) { const out = [I.words[0]]; let g = I.groups[0]; for (let i = 1; i < I.words.length; i++) { const ok = I.groups[i] !== g; T.at({ words: A(I.words, { hl: [i] }), groups: A(I.groups, { hl: [i] }), taken: A(out) }); T.yn(`Take "${I.words[i]}"?`, ok, ok ? 'Its group differs from the last taken.' : 'Same group as the last taken.'); if (ok) { out.push(I.words[i]); g = I.groups[i]; } } return out; }
  });

  D('longest-unequal-adjacent-groups-subsequence-ii', {
    t: 'Longest Unequal Adjacent Groups II: LIS with Hamming distance 1',
    r: 'dp[i] = longest valid chain ending at word i, extending j < i when groups differ, lengths match and the Hamming distance is exactly 1. Rebuild from the best end with parent links.',
    cmp: (out, exp, I) => Array.isArray(out) && out.length === exp.length && out.every((w, i) => { if (!i) return true; const a = I.words.indexOf(out[i - 1]), b = I.words.indexOf(w); if (a >= b || I.groups[a] === I.groups[b] || out[i - 1].length !== w.length) return false; let d = 0; for (let k = 0; k < w.length; k++) if (w[k] !== out[i - 1][k]) d++; return d === 1; }),
    g: R => { const n = R.int(4, 5); const words = []; while (words.length < n) { const w = R.str(2, 'abc'); if (!words.includes(w)) words.push(w); } return { words, groups: Array.from({ length: n }, () => R.int(1, 3)) }; },
    s(I, T) { const W = I.words, gr = I.groups, n = W.length, dp = Array(n).fill(1), par = Array(n).fill(-1), h = (a, b) => a.length === b.length && [...a].filter((c, k) => c !== b[k]).length === 1; for (let i = 0; i < n; i++) { for (let j = 0; j < i; j++) if (gr[i] !== gr[j] && h(W[i], W[j]) && dp[j] + 1 > dp[i]) { dp[i] = dp[j] + 1; par[i] = j; } T.at({ words: A(W, { hl: [i] }), groups: A(gr), dp: A(dp.slice(0, i).concat('?')) }); T.n(`dp[${i}] ("${W[i]}")?`, dp[i], 'Best earlier word with a different group and Hamming distance 1, plus one.'); } let b = dp.indexOf(Math.max(...dp)); const out = []; while (b >= 0) { out.unshift(W[b]); b = par[b]; } return out; }
  });

  D('count-of-sub-multisets-with-bounded-sum', {
    t: 'Count of Sub-Multisets With Bounded Sum: bounded knapsack by value',
    r: 'Group equal values. For value v with count c: new[s] = Σ dp[s − t·v] for t = 0..c (a sliding-window sum in the fast version). Zeros multiply everything by (zeros + 1). Sum dp over l..r.',
    g: R => ({ nums: R.ints(R.int(3, 6), 0, 4), l: R.int(1, 3), r: R.int(3, 7) }),
    s(I, T) { const cnt = {}; I.nums.forEach(x => cnt[x] = (cnt[x] || 0) + 1); const S = I.nums.reduce((a, b) => a + b, 0); let dp = Array(S + 1).fill(0); dp[0] = 1; for (const v of Object.keys(cnt).map(Number).filter(v => v > 0).sort((a, b) => a - b)) { const nx = Array(S + 1).fill(0); for (let s = 0; s <= S; s++) for (let t = 0; t <= cnt[v] && t * v <= s; t++) nx[s] = (nx[s] + dp[s - t * v]) % MOD; dp = nx; T.at({ value: `${v} × ${cnt[v]}`, range: `${I.l}..${I.r}` }); T.n(`After value ${v}: sub-multisets with sum in [${I.l}, ${I.r}] (ignoring zeros)?`, dp.slice(I.l, I.r + 1).reduce((a, b) => (a + b) % MOD, 0), 'Take 0..count copies.'); } const z = (cnt[0] || 0) + 1; return dp.slice(I.l, I.r + 1).reduce((a, b) => (a + b) % MOD, 0) * z % MOD; }
  });

  D('minimum-changes-to-make-k-semi-palindromes', {
    t: 'Minimum Changes for k Semi-Palindromes: cost per substring, then split',
    r: 'A substring is semi-palindrome if for some divisor d of its length (d < length) each residue class mod d reads as a palindrome. cost = min over d of mismatched pairs. dp[p][i] = best split of s[0..i) into p parts.',
    g: R => ({ s: R.str(R.int(4, 6), 'abc'), k: R.int(1, 2) }),
    s(I, T) {
      const s = I.s, n = s.length, cost = (i, j) => { const L = j - i + 1; let best = Infinity; for (let d = 1; d < L; d++) if (L % d === 0) { let c = 0; for (let r = 0; r < d; r++) { const idx = []; for (let x = i + r; x <= j; x += d) idx.push(x); for (let a = 0, b = idx.length - 1; a < b; a++, b--) if (s[idx[a]] !== s[idx[b]]) c++; } best = Math.min(best, c); } return best; };
      T.at({ s: A([...s]) }); T.n('Changes to make the whole string a semi-palindrome?', cost(0, n - 1), 'Best divisor d.'); T.n(`Divisors to try for length ${n}?`, [...Array(n).keys()].filter(d => d >= 1 && n % d === 0).length, 'Each d below the length that divides it.');
      let dp = Array(n + 1).fill(Infinity); dp[0] = 0; for (let p = 1; p <= I.k; p++) { const nx = Array(n + 1).fill(Infinity); for (let i = 2 * p; i <= n; i++) for (let j = 2 * (p - 1); j <= i - 2; j++) if (dp[j] < Infinity) nx[i] = Math.min(nx[i], dp[j] + cost(j, i - 1)); dp = nx; if (p > 1) { T.at({ s: A([...s]), parts: p }); T.n(`Least changes with ${p} parts?`, dp[n], 'Best previous split, plus the cost of the last part.'); } }
      if (I.k === 1) { T.at({ s: A([...s]), parts: 1 }); T.n('Least changes with 1 part?', dp[n], 'The whole string as one part.'); }
      return dp[n];
    }
  });

  D('number-of-ways-to-reach-destination-in-the-grid', {
    t: 'Ways to Reach Destination in the Grid: four relation states',
    r: 'A move changes the row or the column to a different value. Only the relation to dest matters: both equal (a), row equal (b), column equal (c), neither (d). Count ways in each state step by step.',
    g: R => { const n = R.int(2, 4), m = R.int(2, 4); return { n, m, k: R.int(1, 3), source: [R.int(1, n), R.int(1, m)], dest: [R.int(1, n), R.int(1, m)] }; },
    s(I, T) { const { n, m } = I; let s = [0, 0, 0, 0]; const re = I.source[0] === I.dest[0], ce = I.source[1] === I.dest[1]; s[re && ce ? 0 : re ? 1 : ce ? 2 : 3] = 1; for (let i = 1; i <= I.k; i++) { const [a, b, c, d] = s, na = (b + c) % MOD, nb = (a * (m - 1) + b * (m - 2) + d) % MOD, nc = (a * (n - 1) + c * (n - 2) + d) % MOD, nd = (b * (n - 1) + c * (m - 1) + d * (n - 2 + m - 2)) % MOD; s = [na, nb, nc, nd]; T.at({ step: i, grid: `${n}×${m}` }); T.n(`After ${i} move(s): ways to be exactly at dest?`, na, 'From "row equal" fix the column, or from "column equal" fix the row.'); } return s[0]; }
  });

  D('length-of-the-longest-subsequence-that-sums-to-target', {
    t: 'Longest Subsequence That Sums to Target: knapsack on length',
    r: 'dp[s] = longest subsequence with sum s (−∞ if impossible). For each x, s descending: dp[s] = max(dp[s], dp[s − x] + 1).',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 5), target: R.int(4, 10) }),
    s(I, T) { const dp = Array(I.target + 1).fill(-Infinity); dp[0] = 0; I.nums.forEach((x, i) => { for (let s = I.target; s >= x; s--) dp[s] = Math.max(dp[s], dp[s - x] + 1); T.at({ nums: A(I.nums, { hl: [i] }), target: I.target }); T.n(`After ${x}: longest subsequence summing to ${I.target} (−1 if none)?`, dp[I.target] === -Infinity ? -1 : dp[I.target], 'Knapsack, maximizing count.'); }); return dp[I.target] === -Infinity ? -1 : dp[I.target]; }
  });

  D('minimum-increment-operations-to-make-array-beautiful', {
    t: 'Minimum Increment Operations: every window of 3 needs a big one',
    r: 'dp[i] = least cost with nums[i] raised to ≥ k and every window up to i covered = max(0, k − nums[i]) + min(dp[i−1], dp[i−2], dp[i−3]). Answer: min of the last three.',
    g: R => ({ nums: R.ints(R.int(4, 6), 0, 5), k: R.int(3, 6) }),
    s(I, T) { const a = I.nums, dp = []; a.forEach((x, i) => { const v = Math.max(0, I.k - x) + (i < 3 ? 0 : Math.min(dp[i - 1], dp[i - 2], dp[i - 3])); T.at({ nums: A(a, { hl: [i] }), dp: A(dp.concat('?')), k: I.k }); T.n(`dp[${i}]?`, v, `Raise to ${I.k} costs ${Math.max(0, I.k - x)}, plus the best of the previous three.`); dp.push(v); }); return Math.min(...dp.slice(-3)); }
  });

  D('number-of-strings-which-can-be-rearranged-to-contain-substring', {
    t: 'Strings Rearrangeable to Contain "leet": inclusion–exclusion',
    r: 'Good strings have ≥ 1 l, ≥ 2 e, ≥ 1 t. Count the complement by inclusion–exclusion over "no l", "no t", "at most one e": bad = 3·25ⁿ + n·25ⁿ⁻¹ − 3·24ⁿ − 2n·24ⁿ⁻¹ + 23ⁿ + n·23ⁿ⁻¹. Answer 26ⁿ − bad.',
    g: R => ({ n: R.int(4, 6) }),
    s(I, T) { const res = (() => { const n = I.n; T.at({ n }); T.n(`Strings of length ${n} with no "l" (mod 1e9+7)?`, Number(pw(25, n)), '25 to the power n.'); T.n(`Strings with exactly one "e" (mod 1e9+7)?`, Number(BigInt(n) * pw(25, n - 1) % BM), 'n times 25 to the power (n minus 1).'); const N = BigInt(n), bad = (3n * pw(25, n) + N * pw(25, n - 1) - 3n * pw(24, n) - 2n * N * pw(24, n - 1) + pw(23, n) + N * pw(23, n - 1)) % BM; return Number(((pw(26, n) - bad) % BM + BM) % BM); })(); T.n('Good strings (mod 1e9+7)?', res, 'All strings minus the bad ones.'); return res; }
  });

  D('minimum-number-of-coins-for-fruits', {
    t: 'Minimum Coins for Fruits: buying fruit i makes the next i free',
    r: 'From the right: dp[i] = prices[i] + min dp[j] for j in i+1..2i+1 (1-indexed), where anything past the end costs 0. Answer dp[1].',
    g: R => ({ prices: R.ints(R.int(3, 6), 1, 9) }),
    s(I, T) { const p = I.prices, n = p.length, dp = Array(n + 2).fill(0); for (let i = n; i >= 1; i--) { let m = Infinity; for (let j = i + 1; j <= 2 * i + 1; j++) m = Math.min(m, j > n ? 0 : dp[j]); dp[i] = p[i - 1] + m; T.at({ prices: A(p, { hl: [i - 1] }), dp: A(dp.slice(1, n + 1).map((v, k) => k + 1 > i ? v : k + 1 === i ? '?' : '')) }); T.n(`dp[${i}] (buy fruit ${i})?`, dp[i], `${p[i - 1]} + cheapest next purchase within ${i + 1}..${2 * i + 1}.`); } return dp[1]; }
  });

  D('minimum-number-of-coins-for-fruits-ii', {
    t: 'Minimum Coins for Fruits II: the same DP with a monotonic deque',
    r: 'dp[i] = prices[i] + min dp[j] over j in i+1..2i+1 (0 past the end). The window slides left as i decreases, so a monotonic deque gives each minimum in O(1).',
    g: R => ({ prices: R.ints(R.int(4, 7), 1, 9) }),
    s(I, T) { const p = I.prices, n = p.length, dp = Array(n + 2).fill(0); for (let i = n; i >= 1; i--) { let m = Infinity; for (let j = i + 1; j <= 2 * i + 1; j++) m = Math.min(m, j > n ? 0 : dp[j]); dp[i] = p[i - 1] + m; T.at({ prices: A(p, { hl: [i - 1] }), window: `${i + 1}..${Math.min(n + 1, 2 * i + 1)}` }); T.n(`Window minimum for fruit ${i}?`, m, 'Smallest dp in the window (0 if it reaches past the end).'); } return dp[1]; }
  });

  D('find-maximum-non-decreasing-array-length', {
    t: 'Find Maximum Non-Decreasing Array Length: merge into sums',
    r: 'dp[i] = most pieces for the prefix of length i, last[i] = the smallest possible last piece sum. Choose the largest j with last[j] ≤ P[i] − P[j]: dp[i] = dp[j] + 1, last[i] = P[i] − P[j].',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 6) }),
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); const dp = [0], last = [0]; for (let i = 1; i <= n; i++) { let j = i - 1; while (j > 0 && last[j] > P[i] - P[j]) j--; dp.push(dp[j] + 1); last.push(P[i] - P[j]); T.at({ nums: A(a, { win: [j, i - 1] }), dp: A(dp.slice(0, i).concat('?')), last: A(last.slice(0, i)) }); T.n(`dp[${i}]?`, dp[i], `Largest j with last[j] ≤ the sum of nums[${j}..${i - 1}].`); } return dp[n]; }
  });

  D('remove-adjacent-almost-equal-characters', {
    t: 'Remove Adjacent Almost-Equal Characters: change every other one',
    r: 'Scan left to right. When word[i] and word[i−1] are equal or adjacent letters, change word[i] (count 1) and skip to i + 2, since the change can avoid both neighbors.',
    g: R => ({ word: R.str(R.int(5, 8), 'abcde') }),
    s(I, T) { const w = I.word; let c = 0; for (let i = 1; i < w.length; i++) { const bad = Math.abs(w.charCodeAt(i) - w.charCodeAt(i - 1)) <= 1; T.at({ word: A([...w], { hl: [i - 1, i] }), changes: c }); T.yn(`Are "${w[i - 1]}" and "${w[i]}" almost equal?`, bad, bad ? 'Change the right one and skip past it.' : 'Fine as is.'); if (bad) { c++; i++; } } return c; }
  });

  D('most-expensive-item-that-can-not-be-bought', {
    t: 'Most Expensive Item That Can Not Be Bought: the Frobenius number',
    r: 'With coins p and q (coprime), every amount above p·q − p − q can be paid. A reachability DP over amounts confirms which ones cannot.',
    g: R => { const P = [2, 3, 5, 7]; const a = R.int(0, 2), b = R.int(a + 1, 3); return { primeOne: P[a], primeTwo: P[b] }; },
    s(I, T) { const p = I.primeOne, q = I.primeTwo, L = p * q, ok = Array(L + 1).fill(false); ok[0] = true; for (let v = 1; v <= L; v++) ok[v] = (v >= p && ok[v - p]) || (v >= q && ok[v - q]); const cand = [...Array(L).keys()].slice(1).filter(v => !ok[v]); for (const v of [1, p + q - 1, L - p - q, L - p - q + 1].filter(v => v > 0 && v <= L)) { T.at({ coins: `${p}, ${q}` }); T.yn(`Can you pay exactly ${v}?`, ok[v], `Reachable if ${v} − ${p} or ${v} − ${q} is.`); } return Math.max(...cand); }
  });

  D('minimum-number-of-operations-to-make-x-and-y-equal', {
    t: 'Make x and y Equal: walk to a multiple, then divide',
    r: 'f(x) = x ≤ y ? y − x : min(x − y, for d in {5, 11}: (x mod d) + 1 + f(⌊x/d⌋), (d − x mod d) + 1 + f(⌊x/d⌋ + 1)).',
    g: R => ({ x: R.int(10, 80), y: R.int(1, 6) }),
    s(I, T) {
      const memo = new Map(), f = x => { if (x <= I.y) return I.y - x; if (memo.has(x)) return memo.get(x); let b = x - I.y; for (const d of [5, 11]) { b = Math.min(b, x % d + 1 + f(Math.floor(x / d)), d - x % d + 1 + f(Math.floor(x / d) + 1)); } memo.set(x, b); return b; };
      T.at({ x: I.x, y: I.y }); T.yn('Is x already at most y?', I.x <= I.y, 'Then only increments help.');
      let x = I.x; while (x > I.y) { const opts = [['walk', `walk to y (${x - I.y})`]], ok = []; if (x - I.y === f(x)) ok.push('walk'); for (const d of [5, 11]) { const dn = x % d + 1 + f(Math.floor(x / d)), up = d - x % d + 1 + f(Math.floor(x / d) + 1); opts.push(['d' + d, `down to a multiple of ${d}, divide`], ['u' + d, `up to a multiple of ${d}, divide`]); if (dn === f(x)) ok.push('d' + d); if (up === f(x)) ok.push('u' + d); }
        T.at({ x, y: I.y }); T.k(`x = ${x}: best plan?`, opts, ok, `Optimal total from here: ${f(x)}.`); const c = ok[0]; if (c === 'walk') break; const d = +c.slice(1); x = c[0] === 'd' ? Math.floor(x / d) : Math.floor(x / d) + 1; }
      T.at({ x: I.x, y: I.y }); T.n('Fewest operations?', f(I.x), 'The best plan from the start.');
      return f(I.x);
    }
  });

  D('count-the-number-of-powerful-integers', {
    t: 'Count Powerful Integers: free prefix digits ≤ limit, fixed suffix',
    r: 'x = prefix · 10^|s| + s with every digit ≤ limit. count(N) walks N\'s prefix digits: smaller digits (≤ limit) leave (limit + 1)^(rest) choices; a digit above limit caps everything. Answer = count(finish) − count(start − 1).',
    g: R => ({ start: R.int(1, 30), finish: R.int(100, 900), limit: R.int(2, 6), s: String(R.int(1, 2)) }),
    s(I, T) {
      const cnt = N => { const t = String(N), L = I.s.length; if (t.length < L) return 0; if (t.length === L) return +t >= +I.s ? 1 : 0; const pre = t.slice(0, t.length - L), suf = t.slice(t.length - L); let r = 0; for (let i = 0; i < pre.length; i++) { const d = +pre[i]; if (d > I.limit) return r + (I.limit + 1) ** (pre.length - i); r += d * (I.limit + 1) ** (pre.length - i - 1); } return r + (suf >= I.s ? 1 : 0); };
      const a = cnt(I.finish), b = cnt(I.start - 1); T.at({ s: I.s, limit: I.limit }); T.n(`Powerful integers up to ${I.finish}?`, a, 'Prefix digits at most limit, then check the suffix.'); T.n(`Powerful integers up to ${I.start - 1}?`, b, 'Same count on the lower bound.'); T.n('Powerful integers in range?', a - b, 'Subtract the two counts.'); return a - b;
    }
  });

  D('maximize-the-number-of-partitions-after-operations', {
    t: 'Maximize Partitions After One Change: greedy partitions, try every change',
    r: 'Partitioning is greedy: take the longest prefix with at most k distinct letters, repeat. Changing one letter can split more. Here: count greedily, then try every single-letter change.',
    g: R => ({ s: R.str(R.int(4, 6), 'abc'), k: R.int(1, 2) }),
    s(I, T) { const part = s => { let c = 0, set = new Set(); for (const ch of s) { set.add(ch); if (set.size > I.k) { c++; set = new Set([ch]); } } return c + 1; }; const base = part(I.s); T.at({ s: A([...I.s]), k: I.k }); T.n('Distinct letters in s?', new Set(I.s).size, 'Compare with k.'); T.n('Partitions with no change?', base, 'Greedy longest prefix with at most k distinct letters.'); let best = base; for (let i = 0; i < I.s.length; i++) for (const c of 'abcdefghijklmnopqrstuvwxyz') best = Math.max(best, part(I.s.slice(0, i) + c + I.s.slice(i + 1))); T.n('Most partitions after changing at most one letter?', best, 'Try every position and letter.'); return best; }
  });

  D('maximum-number-that-sum-of-the-prices-is-less-than-or-equal-to-k', {
    t: 'Maximum Number With Price Sum ≤ k: add prices until you overflow',
    r: 'price(num) = set bits at 1-indexed positions x, 2x, 3x, … The fast way binary searches num with a bit-count formula; here, accumulate prices number by number.',
    g: R => ({ k: R.int(3, 12), x: R.int(1, 2) }),
    s(I, T) { const price = v => { let c = 0; for (let p = I.x; (1 << (p - 1)) <= v; p += I.x) if (v >> (p - 1) & 1) c++; return c; }; let s = 0, n = 0; while (true) { const p = price(n + 1); T.at({ num: n + 1, binary: (n + 1).toString(2), total: s, k: I.k }); T.n(`price(${n + 1})?`, p, `Set bits at positions ${I.x}, ${2 * I.x}, …`); if (s + p > I.k) return n; s += p; n++; } }
  });

  D('maximum-number-of-removal-queries-that-can-be-processed-i', {
    t: 'Maximum Removal Queries I: which ends have been removed?',
    r: 'dp[i][j] = most queries processed when nums[i..j] remain (removing only from the ends). Coming from [i−1, j] removes nums[i−1] (counts if it is ≥ the next query); from [i, j+1] removes nums[j+1]. Finish with one last element.',
    g: R => ({ nums: R.ints(R.int(3, 4), 1, 6), queries: R.ints(R.int(3, 4), 1, 6) }),
    s(I, T) { const a = I.nums, q = I.queries, n = a.length, Q = q.length, dp = mk(n, n, 0), inc = (c, v) => c + (c < Q && v >= q[c] ? 1 : 0); for (let len = n - 1; len >= 1; len--) for (let i = 0; i + len <= n; i++) { const j = i + len - 1; let v = 0; if (i > 0) v = Math.max(v, inc(dp[i - 1][j], a[i - 1])); if (j < n - 1) v = Math.max(v, inc(dp[i][j + 1], a[j + 1])); dp[i][j] = v; if (len <= 2) { T.at({ nums: A(a, { win: [i, j] }), queries: A(q) }); T.n(`dp[${i}][${j}]?`, v, 'Best of removing the element just outside on the left or right.'); } } let best = 0; for (let i = 0; i < n; i++) best = Math.max(best, inc(dp[i][i], a[i])); return best; }
  });

  D('count-numbers-with-unique-digits-ii', {
    t: 'Count Numbers With Unique Digits II: check each number',
    r: 'A number counts if no digit repeats. (A digit DP works for huge ranges; here the range is small.)',
    g: R => { const a = R.int(1, 120); return { a, b: a + R.int(5, 20) }; },
    s(I, T) { let c = 0; for (let x = I.a; x <= I.b; x++) { const s = String(x), ok = new Set(s).size === s.length; T.at({ x, count: c }); T.yn(`Does ${x} have unique digits?`, ok, ok ? 'No digit repeats.' : 'A digit repeats.'); if (ok) c++; } return c; }
  });

  D('maximum-number-of-operations-with-the-same-score-ii', {
    t: 'Same-Score Operations II: three possible target scores',
    r: 'The first move fixes the score: first two, last two, or first + last. For each target, f(l, r) = most operations on nums[l..r] removing a pair with that sum (memoized interval DP).',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 4) }),
    s(I, T) { const a = I.nums, n = a.length, run = t => { const memo = new Map(), f = (l, r) => { if (r - l < 1) return 0; const k = l * 100 + r; if (memo.has(k)) return memo.get(k); let b = 0; if (a[l] + a[l + 1] === t) b = Math.max(b, 1 + f(l + 2, r)); if (a[r] + a[r - 1] === t) b = Math.max(b, 1 + f(l, r - 2)); if (a[l] + a[r] === t) b = Math.max(b, 1 + f(l + 1, r - 1)); memo.set(k, b); return b; }; return f(0, n - 1); }; let best = 0; for (const [nm, t] of [['first two', a[0] + a[1]], ['last two', a[n - 1] + a[n - 2]], ['first + last', a[0] + a[n - 1]]]) { const v = run(t); T.at({ nums: A(a), target: t }); T.n(`Operations with score ${t} (${nm})?`, v, 'Interval DP removing pairs with that sum.'); best = Math.max(best, v); } return best; }
  });

  D('maximize-consecutive-elements-in-an-array-after-modification', {
    t: 'Maximize Consecutive Elements: each value may grow by 1',
    r: 'Sort. dp[v] = longest consecutive run ending at value v. For x: dp[x+1] = dp[x] + 1 (use it as x+1), then dp[x] = dp[x−1] + 1 (use it as x). Order matters: update x+1 first.',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 8) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), dp = new Map(); let best = 0; a.forEach((x, i) => { dp.set(x + 1, (dp.get(x) || 0) + 1); dp.set(x, (dp.get(x - 1) || 0) + 1); T.at({ sorted: A(a, { hl: [i] }), dp: K([...dp].sort((p, q) => p[0] - q[0]).map(([k, v]) => ['ends ' + k, v])) }); T.n(`After ${x}: longest run ending at ${x + 1}?`, dp.get(x + 1), `Bump ${x} to ${x + 1}, extending the run ending at ${x}.`); best = Math.max(best, dp.get(x), dp.get(x + 1)); }); return best; }
  });

  D('maximum-strength-of-k-disjoint-subarrays', {
    t: 'Maximum Strength of k Disjoint Subarrays: alternating weights',
    r: 'The i-th chosen subarray sum is multiplied by (−1)^(i+1)·(k − i + 1). dp over (index, subarrays used, inside a subarray?): extend the current one, start the next, or skip.',
    g: R => ({ nums: R.ints(R.int(4, 6), -4, 6), k: R.pick([1, 3]) }),
    s(I, T) { const k = I.k, w = j => (j % 2 ? 1 : -1) * (k - j + 1); let out = Array(k + 1).fill(-Infinity), inn = Array(k + 1).fill(-Infinity); out[0] = 0; I.nums.forEach((x, i) => { const no = out.slice(), ni = Array(k + 1).fill(-Infinity); for (let j = 1; j <= k; j++) ni[j] = Math.max(inn[j], out[j - 1], inn[j - 1]) + w(j) * x; for (let j = 1; j <= k; j++) no[j] = Math.max(no[j], ni[j]); out = no; inn = ni; T.at({ nums: A(I.nums, { hl: [i] }), k }); if (out[Math.min(k, i + 1)] > -Infinity) T.n(`After index ${i}: best strength using ${Math.min(k, i + 1)} subarray(s)?`, out[Math.min(k, i + 1)], 'Extend, start the next subarray, or skip.'); }); return out[k]; }
  });

  D('find-the-sum-of-the-power-of-all-subsequences', {
    t: 'Sum of the Power of All Subsequences: each element in, out, or doubled',
    r: 'For every subsequence S summing to k, it is counted in 2^(n − |S|) supersets. DP: each element either joins S (dp[s − x]) or not, and when not in S it may or may not be in the superset (×2): dp[s] = 2·dp[s] + dp[s − x].',
    g: R => ({ nums: R.ints(R.int(2, 4), 1, 4), k: R.int(2, 6) }),
    s(I, T) { let dp = Array(I.k + 1).fill(0); dp[0] = 1; I.nums.forEach((x, i) => { const nx = dp.map((v, s) => (2 * v + (s >= x ? dp[s - x] : 0)) % MOD); dp = nx; T.at({ nums: A(I.nums, { hl: [i] }), k: I.k, dp: A(dp) }); T.n(`After ${x}: dp[${I.k}]?`, dp[I.k], `2·old dp[${I.k}] + old dp[${I.k} − ${x}].`); }); return dp[I.k]; }
  });

  D('find-the-sum-of-subsequence-powers', {
    t: 'Sum of Subsequence Powers: min adjacent gap after sorting',
    r: 'The power of a size-k subsequence is its minimum adjacent difference once sorted. The full solution counts subsequences by (last element, size, current min gap); here, score each one.',
    g: R => ({ nums: R.ints(R.int(3, 5), 0, 9), k: R.int(2, 3) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length; let tot = 0, asked = 0; for (let m = 0; m < 1 << n; m++) { const idx = [...Array(n).keys()].filter(i => m >> i & 1); if (idx.length !== I.k) continue; let g = Infinity; for (let t = 1; t < idx.length; t++) g = Math.min(g, a[idx[t]] - a[idx[t - 1]]); if (asked++ < 6) { T.at({ sorted: A(a, { hl: idx }) }); T.n(`Power of {${idx.map(i => a[i]).join(', ')}}?`, g, 'Smallest gap between neighbors.'); } tot = (tot + g) % MOD; } return tot; }
  });

  D('minimum-sum-of-values-by-dividing-array', {
    t: 'Minimum Sum of Values by Dividing Array: AND each piece down to its target',
    r: 'f(i, j, cur) = least sum splitting nums[i..] into pieces j.., with cur = AND of the open piece. Extend the piece, or close it here if cur == andValues[j] (adding nums[i] as its value).',
    g: R => { const nums = R.ints(R.int(3, 5), 1, 7), cut = Math.max(1, nums.length - 2); return { nums, andValues: [nums.slice(0, cut).reduce((x, y) => x & y), ...nums.slice(cut)] }; },
    s(I, T) {
      const av = I.andValues;
      const a = I.nums, n = a.length, m = av.length, memo = new Map(), f = (i, j, cur) => { if (i === n) return j === m ? 0 : Infinity; if (j === m) return Infinity; const c = cur & a[i], k = i + ',' + j + ',' + c; if (memo.has(k)) return memo.get(k); let b = f(i + 1, j, c); if (c === av[j]) b = Math.min(b, a[i] + f(i + 1, j + 1, -1)); memo.set(k, b); return b; };
      const res = f(0, 0, -1); T.at({ nums: A(a), andValues: A(av) }); if (res === Infinity) { T.yn('Can nums be divided to match andValues?', false, '−1.'); return -1; }
      let i = 0, cur = -1; for (let j = 0; j < m; j++) { const ends = []; let c = cur; for (let e = i; e < n; e++) { c &= a[e]; if (c === av[j] && a[e] + f(e + 1, j + 1, -1) === f(i, j, cur)) ends.push(String(e)); } T.at({ nums: A(a, { win: [i, n - 1] }), target: av[j] }); T.k(`Piece ${j} (AND must be ${av[j]}) ends at which index (optimal)?`, [...Array(n - i).keys()].map(d => [String(i + d), `index ${i + d} (value ${a[i + d]})`]), ends, `Optimal remaining sum is ${f(i, j, cur)}.`); i = +ends[0] + 1; cur = -1; }
      return res;
    }
  });

  D('minimum-number-of-operations-to-satisfy-conditions', {
    t: 'Minimum Operations to Satisfy Conditions: one value per column',
    r: 'Each column becomes a single value and neighbors differ. cost[c][v] = m − (count of v in column c). dp over columns: dp[c][v] = cost + min dp[c−1][u] for u ≠ v.',
    g: R => ({ grid: R.grid(R.int(2, 3), R.int(2, 4), 0, 2) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; let dp = Array(10).fill(0); for (let c = 0; c < n; c++) { const cost = [...Array(10).keys()].map(v => m - g.filter(r => r[c] === v).length), nx = cost.map((x, v) => x + (c ? Math.min(...dp.filter((_, u) => u !== v)) : 0)); dp = nx; T.at({ grid: G(g, { hl: g.map((_, r) => [r, c]) }) }); T.n(`Through column ${c}: fewest changes?`, Math.min(...dp), 'Best value for this column given a different value before it.'); } return Math.min(...dp); }
  });

  D('find-all-possible-stable-binary-arrays-i', {
    t: 'Stable Binary Arrays I: no run longer than limit',
    r: 'dp[z][o][last] = arrays with z zeros and o ones ending in last. Appending last again extends its run; subtract the arrays where the run would exceed limit: dp[z][o][0] = dp[z−1][o][0] + dp[z−1][o][1] − dp[z−limit−1][o][1].',
    g: R => ({ zero: R.int(1, 3), one: R.int(1, 3), limit: R.int(1, 2) }),
    s(I, T) { const Z = I.zero, O = I.one, L = I.limit, d0 = mk(Z + 1, O + 1, 0), d1 = mk(Z + 1, O + 1, 0); for (let z = 1; z <= Math.min(Z, L); z++) d0[z][0] = 1; for (let o = 1; o <= Math.min(O, L); o++) d1[0][o] = 1; for (let z = 1; z <= Z; z++) for (let o = 1; o <= O; o++) { d0[z][o] = (d0[z - 1][o] + d1[z - 1][o] - (z - L - 1 >= 0 ? d1[z - L - 1][o] : 0) + MOD) % MOD; d1[z][o] = (d0[z][o - 1] + d1[z][o - 1] - (o - L - 1 >= 0 ? d0[z][o - L - 1] : 0) + MOD) % MOD; T.at({ zeros: z, ones: o, limit: L }); T.n(`Stable arrays with ${z} zeros and ${o} ones?`, (d0[z][o] + d1[z][o]) % MOD, 'Ending in 0 plus ending in 1.'); } return (d0[Z][O] + d1[Z][O]) % MOD; }
  });

  D('find-all-possible-stable-binary-arrays-ii', {
    t: 'Stable Binary Arrays II: the same DP, bigger limits',
    r: 'dp[z][o][last] with the run-length correction term: dp[z][o][0] = dp[z−1][o][0] + dp[z−1][o][1] − dp[z−limit−1][o][1] (and symmetrically for 1). O(zero · one).',
    g: R => ({ zero: R.int(2, 3), one: R.int(2, 3), limit: R.int(1, 2) }),
    s(I, T) { const Z = I.zero, O = I.one, L = I.limit, d0 = mk(Z + 1, O + 1, 0), d1 = mk(Z + 1, O + 1, 0); for (let z = 1; z <= Math.min(Z, L); z++) d0[z][0] = 1; for (let o = 1; o <= Math.min(O, L); o++) d1[0][o] = 1; for (let z = 1; z <= Z; z++) for (let o = 1; o <= O; o++) { d0[z][o] = (d0[z - 1][o] + d1[z - 1][o] - (z - L - 1 >= 0 ? d1[z - L - 1][o] : 0) + MOD) % MOD; d1[z][o] = (d0[z][o - 1] + d1[z][o - 1] - (o - L - 1 >= 0 ? d0[z][o - L - 1] : 0) + MOD) % MOD; T.at({ zeros: z, ones: o, limit: L }); T.n(`Arrays with ${z} zeros, ${o} ones, ending in 0?`, d0[z][o], 'Add both endings with one fewer zero, minus over-long zero runs.'); } return (d0[Z][O] + d1[Z][O]) % MOD; }
  });
})();
