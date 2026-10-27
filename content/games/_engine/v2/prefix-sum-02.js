/* v2 games: prefix sums & difference arrays (02). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const pre = a => { const p = [0]; for (const x of a) p.push(p[p.length - 1] + x); return p; };
  const MOD = 1000000007;
  const distSum = {
    r: 'Group indices by value. In a sorted group with prefix sums, the k-th index p gets p·k − (sum before) + (sum after) − p·(m − 1 − k).',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3) }),
    s(I, T) { const g = {}; I.nums.forEach((v, i) => (g[v] = g[v] || []).push(i)); const out = Array(I.nums.length); let asks = 0; for (const idx of Object.values(g)) { const P = pre(idx), m = idx.length; idx.forEach((p, k) => { out[p] = p * k - P[k] + (P[m] - P[k + 1]) - p * (m - 1 - k); if (asks++ < 6) { T.at({ nums: A(I.nums, { i: p }), sameValueAt: A(idx) }); T.n('Sum of distances for this index?', out[p], 'Prefix sums inside the group.'); } }); } return out; }
  };
  const beautiful = {
    r: 'A substring is beautiful when vowels = consonants and vowels × consonants is divisible by k. Use a running balance (vowel +1, consonant −1) to find equal-count spans and check (len/2)² mod k for each.',
    g: R => ({ s: R.str(R.int(1, 10), 'abeiy'), k: R.int(1, 5) }),
    s(I, T) { const s = I.s, V = 'aeiou'; let c = 0, asks = 0; for (let i = 0; i < s.length; i++) { let v = 0, here = 0; for (let j = i; j < s.length; j++) { if (V.includes(s[j])) v++; const cc = j - i + 1 - v; if (v === cc && (v * cc) % I.k === 0) here++; } c += here; if (asks++ < 6) { T.at({ s: A([...s], { i }), k: I.k }); T.n('Beautiful substrings starting here?', here, 'Equal counts, and vowels times consonants divisible by k.'); } } return c; }
  };

  D('count-the-hidden-sequences', {
    t: 'Count the Hidden Sequences',
    r: 'The hidden sequence is a start value plus prefix sums of differences. With the prefix range span = max − min, the start can take (upper − lower) − span + 1 values (or 0).',
    g: R => ({ differences: R.ints(R.int(1, 6), -4, 4), lower: R.int(-3, 3), upper: R.int(3, 12) }),
    s(I, T) { let p = 0, mn = 0, mx = 0; I.differences.forEach((d, i) => { p += d; mn = Math.min(mn, p); mx = Math.max(mx, p); if (i < 6) { T.at({ differences: A(I.differences, { i }), prefix: p }); T.n('Spread (max − min of prefixes) so far?', mx - mn, 'The sequence\'s range width.'); } }); return Math.max(0, I.upper - I.lower - (mx - mn) + 1); }
  });

  D('all-divisions-with-the-highest-score-of-a-binary-array', {
    t: 'All Divisions With the Highest Score of a Binary Array',
    r: 'Score at division i = zeros in nums[0..i) + ones in nums[i..). Start with all ones on the right and move the cut, updating both counts; collect every i reaching the max.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 1) }),
    s(I, T) { let z = 0, o = I.nums.filter(x => x).length, best = -1, out = []; for (let i = 0; i <= I.nums.length; i++) { if (i) { if (I.nums[i - 1]) o--; else z++; } const sc = z + o; if (sc > best) { best = sc; out = [i]; } else if (sc === best) out.push(i); if (i < 7) { T.at({ nums: A(I.nums, { i }) }); T.n(`Score of division ${i}?`, sc, 'Left zeros + right ones.'); } } return out; }
  });

  D('removing-minimum-number-of-magic-beans', {
    t: 'Removing Minimum Number of Magic Beans',
    r: 'Sort. If every bag from i on keeps b[i] beans, we keep b[i]·(n − i). Removed = total − max kept.',
    g: R => ({ beans: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const b = I.beans.slice().sort((x, y) => x - y), n = b.length, tot = b.reduce((x, y) => x + y, 0); let best = 0; b.forEach((x, i) => { best = Math.max(best, x * (n - i)); if (i < 6) { T.at({ sorted: A(b, { i }) }); T.n('Beans kept if this is the level?', x * (n - i), 'b[i] × bags from i on.'); } }); return tot - best; }
  });

  D('maximize-number-of-subsequences-in-a-string', {
    t: 'Maximize Number of Subsequences in a String',
    r: 'Count existing pattern subsequences by scanning (each pattern[1] pairs with earlier pattern[0]s). Inserting pattern[0] at the front adds count(pattern[1]); inserting pattern[1] at the end adds count(pattern[0]). Take the larger.',
    g: R => ({ text: R.str(R.int(1, 9), 'abc'), pattern: R.str(2, 'ab') }),
    s(I, T) { const [p0, p1] = I.pattern; let c0 = 0, c1 = 0, t = 0; [...I.text].forEach((ch, i) => { if (ch === p1) { t += c0; c1++; } if (ch === p0) c0++; if (i < 7) { T.at({ text: A([...I.text], { i }), pattern: I.pattern }); T.n('Pattern subsequences so far?', t, `Each ${p1} pairs with earlier ${p0}s.`); } }); return t + Math.max(c0, c1); }
  });

  D('maximum-sum-score-of-array', {
    t: 'Maximum Sum Score of Array',
    r: 'Score at i = max(prefix sum through i, suffix sum from i). One pass with prefix and total gives both.',
    g: R => ({ nums: R.ints(R.int(1, 7), -5, 6) }),
    s(I, T) { const P = pre(I.nums), n = I.nums.length; let best = -Infinity; for (let i = 0; i < n; i++) { const sc = Math.max(P[i + 1], P[n] - P[i]); best = Math.max(best, sc); if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.n('Sum score at this index?', sc, 'max(prefix, suffix).'); } } return best; }
  });

  D('count-positions-on-street-with-required-brightness', {
    t: 'Count Positions on Street With Required Brightness',
    r: 'Each lamp brightens [p − r, p + r] clipped to the street: +1 / −1 on a difference array. Prefix-sum it and count positions where brightness ≥ requirement.',
    g: R => { const n = R.int(1, 7); return { n, lights: Array.from({ length: R.int(1, 4) }, () => [R.int(0, n - 1), R.int(0, 2)]), requirement: R.ints(n, 0, 3) }; },
    s(I, T) { const d = Array(I.n + 1).fill(0); I.lights.forEach(([p, r]) => { d[Math.max(0, p - r)]++; d[Math.min(I.n - 1, p + r) + 1]--; }); let s = 0, c = 0; for (let i = 0; i < I.n; i++) { s += d[i]; if (s >= I.requirement[i]) c++; if (i < 7) { T.at({ position: i, requirement: A(I.requirement, { i }) }); T.n('Brightness here?', s, 'Running sum of the difference array.'); } } return c; }
  });

  D('minimum-average-difference', {
    t: 'Minimum Average Difference',
    r: 'With prefix sums, at i compare ⌊prefix / (i + 1)⌋ with ⌊rest / (n − i − 1)⌋ (0 if empty). Return the first index with the smallest absolute difference.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 9) }),
    s(I, T) { const n = I.nums.length, P = pre(I.nums); let best = Infinity, bi = 0; for (let i = 0; i < n; i++) { const l = Math.floor(P[i + 1] / (i + 1)), r = i === n - 1 ? 0 : Math.floor((P[n] - P[i + 1]) / (n - i - 1)), d = Math.abs(l - r); if (d < best) { best = d; bi = i; } if (i < 6) { T.at({ nums: A(I.nums, { i }), leftAvg: l, rightAvg: r }); T.n('Average difference here?', d, '|left avg − right avg|.'); } } return bi; }
  });

  D('number-of-ways-to-split-array', {
    t: 'Number of Ways to Split Array',
    r: 'For each cut after i (0 ≤ i < n − 1), the split is valid if prefix ≥ total − prefix. Count them.',
    g: R => ({ nums: R.ints(R.int(2, 8), -5, 9) }),
    s(I, T) { const tot = I.nums.reduce((a, b) => a + b, 0); let p = 0, c = 0; for (let i = 0; i < I.nums.length - 1; i++) { p += I.nums[i]; const ok = p >= tot - p; if (ok) c++; if (i < 7) { T.at({ nums: A(I.nums, { win: [0, i] }), left: p, right: tot - p }); T.yn('Valid split?', ok, 'left ≥ right.'); } } return c; }
  });

  D('shifting-letters-ii', {
    t: 'Shifting Letters II',
    r: 'Difference array: a forward shift on [l, r] adds +1 at l and −1 at r + 1 (backward uses −1/+1). The prefix sum is each letter\'s net shift mod 26.',
    g: R => { const s = R.str(R.int(1, 6), 'abyz'); return { s, shifts: Array.from({ length: R.int(1, 4) }, () => { const l = R.int(0, s.length - 1); return [l, R.int(l, s.length - 1), R.int(0, 1)]; }) }; },
    s(I, T) { const n = I.s.length, d = Array(n + 1).fill(0); I.shifts.forEach(([l, r, dir]) => { const v = dir ? 1 : -1; d[l] += v; d[r + 1] -= v; }); let s = 0; return [...I.s].map((c, i) => { s += d[i]; if (i < 6) { T.at({ s: A([...I.s], { i }), diff: A(d.slice(0, n)) }); T.n(`Net shift of letter ${i}?`, s, 'Prefix sum of the difference array.'); } return String.fromCharCode(97 + (((c.charCodeAt(0) - 97 + s) % 26) + 26) % 26); }).join(''); }
  });

  D('minimum-amount-of-time-to-collect-garbage', {
    t: 'Minimum Amount of Time to Collect Garbage',
    r: 'Picking up each unit takes 1 minute: total characters. Each truck also travels to the last house holding its type: add the travel prefix sum up to that house.',
    g: R => { const n = R.int(1, 5); return { garbage: Array.from({ length: n }, () => R.str(R.int(0, 3), 'GPM')), travel: R.ints(n - 1, 1, 5) }; },
    s(I, T) { const P = pre(I.travel); let t = I.garbage.reduce((s, g) => s + g.length, 0); T.at({ garbage: A(I.garbage) }); T.n('Minutes spent picking up?', t, 'Total units.'); for (const ty of 'GPM') { let last = 0; I.garbage.forEach((g, i) => { if (g.includes(ty)) last = i; }); T.at({ garbage: A(I.garbage, { i: last }), truck: ty }); T.n(`Travel time for the ${ty} truck?`, P[last], 'Prefix of travel up to its last house.'); t += P[last]; } return t; }
  });

  D('range-product-queries-of-powers', {
    t: 'Range Product Queries of Powers',
    r: 'powers = the set bits of n in increasing order. A query multiplies powers[l..r] (mod 1e9+7) — or add exponents with a prefix sum and compute one power of 2.',
    g: R => { const n = R.int(1, 255), k = n.toString(2).split('').filter(b => b === '1').length; return { n, queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, k - 1); return [l, R.int(l, k - 1)]; }) }; },
    s(I, T) { const e = []; for (let b = 0; b < 31; b++) if (I.n >> b & 1) e.push(b); const P = pre(e); T.at({ n: I.n }); T.n('How many powers?', e.length, 'Set bits of n.'); return I.queries.map(([l, r], i) => { const x = P[r + 1] - P[l]; if (i < 4) { T.at({ exponents: A(e, { win: [l, r] }) }); T.n('Sum of exponents in range?', x, 'Product = 2^sum.'); } let v = 1n; for (let j = 0; j < x; j++) v = v * 2n % 1000000007n; return Number(v); }); }
  });

  D('minimum-penalty-for-a-shop', {
    t: 'Minimum Penalty for a Shop',
    r: 'Closing at hour j costs (N before j) + (Y from j on). Start with penalty = #Y (close at 0) and update as j moves: Y → −1, N → +1. Return the earliest minimum.',
    g: R => ({ customers: R.str(R.int(1, 8), 'YN') }),
    s(I, T) { let p = [...I.customers].filter(c => c === 'Y').length, best = p, bj = 0; [...I.customers].forEach((c, i) => { p += c === 'Y' ? -1 : 1; if (p < best) { best = p; bj = i + 1; } if (i < 7) { T.at({ customers: A([...I.customers], { i }) }); T.n(`Penalty if closing at hour ${i + 1}?`, p, 'Y before the close helps; N hurts.'); } }); return bj; }
  });

  D('find-the-pivot-integer', {
    t: 'Find the Pivot Integer',
    r: 'sum(1..x) = sum(x..n) ⇔ x² = n(n + 1)/2. Return x if that is a perfect square, else −1.',
    g: R => ({ n: R.int(1, 60) }),
    s(I, T) { const res = (() => { const t = I.n * (I.n + 1) / 2, x = Math.round(Math.sqrt(t)); T.at({ n: I.n }); T.n('Sum of 1 to n?', t, 'n times n plus 1, halved.'); T.yn('Is it a perfect square?', x * x === t, 'Some x squared must equal the total.'); return x * x === t ? x : -1; })(); T.n('Pivot? (−1 if none)', res, 'The square root of the total.'); return res; }
  });

  D('count-subarrays-with-median-k', {
    t: 'Count Subarrays With Median K',
    r: 'Map values > k to +1 and < k to −1. A subarray containing k has median k iff its sum is 0 or 1. Count balance values to the left of k\'s index, then match each right balance.',
    g: R => { const n = R.int(1, 7); return { nums: R.perm(n).map(x => x + 1), k: R.int(1, n) }; },
    s(I, T) { const res = (() => { const p = I.nums.indexOf(I.k), c = {}; let b = 0; c[0] = 1; for (let i = p - 1; i >= 0; i--) { b += I.nums[i] > I.k ? 1 : -1; c[b] = (c[b] || 0) + 1; } T.at({ nums: A(I.nums, { i: p }), leftBalances: K({ ...c }) }); T.n('Index of k?', p, 'Every subarray must include it.'); T.n('How many left extensions (including empty)?', p + 1, 'One per start.'); let t = 0; b = 0; for (let j = p; j < I.nums.length; j++) { if (j > p) b += I.nums[j] > I.k ? 1 : -1; t += (c[-b] || 0) + (c[1 - b] || 0); } return t; })(); T.n('Subarrays with median k?', res, 'Match left and right balances.'); return res; }
  });

  D('number-of-substrings-with-fixed-ratio', {
    t: 'Number of Substrings With Fixed Ratio',
    r: 'zeros:ones = num1:num2 ⇔ zeros·num2 − ones·num1 = 0. Count prefix values of that key; equal keys bound a valid substring.',
    g: R => ({ s: R.str(R.int(1, 10), '01'), num1: R.int(1, 3), num2: R.int(1, 3) }),
    s(I, T) { const c = { 0: 1 }; let z = 0, o = 0, t = 0; [...I.s].forEach((ch, i) => { if (ch === '0') z++; else o++; const key = z * I.num2 - o * I.num1; t += c[key] || 0; c[key] = (c[key] || 0) + 1; if (i < 8) { T.at({ s: A([...I.s], { i }), key }); T.n('Ratio substrings so far?', t, 'Earlier prefixes with the same key.'); } }); return t; }
  });

  D('bitwise-or-of-all-subsequence-sums', {
    t: 'Bitwise OR of All Subsequence Sums',
    r: 'Every bit achievable by some subsequence sum is already set in some element or some prefix sum (carries propagate through prefixes). OR all elements and all prefix sums.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 9) }),
    s(I, T) { let p = 0, ans = 0; I.nums.forEach((x, i) => { ans |= x; p += x; ans |= p; if (i < 6) { T.at({ nums: A(I.nums, { i }), prefix: p }); T.n('OR accumulated so far?', ans, 'OR in the element and the prefix sum.'); } }); return ans; }
  });

  D('count-vowel-strings-in-ranges', {
    t: 'Count Vowel Strings in Ranges',
    r: 'Mark words that start and end with a vowel; prefix-count them so each query is P[r + 1] − P[l].',
    g: R => { const w = Array.from({ length: R.int(1, 6) }, () => R.str(R.int(1, 3), 'aeb')); return { words: w, queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, w.length - 1); return [l, R.int(l, w.length - 1)]; }) }; },
    s(I, T) { const res = (() => { const V = 'aeiou', f = I.words.map(w => V.includes(w[0]) && V.includes(w[w.length - 1]) ? 1 : 0), P = pre(f); T.at({ words: A(I.words), good: A(f) }); T.yn(`Is "${I.words[0]}" good?`, f[0] === 1, 'Starts and ends with a vowel.'); T.n('How many good words in total?', P[f.length], 'Starts and ends with a vowel.'); return I.queries.map(([l, r]) => P[r + 1] - P[l]); })(); T.n('Answer to the first query?', res[0], 'Prefix sum at r plus 1, minus prefix sum at l.'); return res; }
  });

  D('left-and-right-sum-differences', {
    t: 'Left and Right Sum Differences',
    r: 'leftSum[i] = prefix before i; rightSum[i] = total − leftSum − nums[i]. Answer |leftSum − rightSum|.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const tot = I.nums.reduce((a, b) => a + b, 0); let l = 0; return I.nums.map((x, i) => { const r = tot - l - x, v = Math.abs(l - r); if (i < 6) { T.at({ nums: A(I.nums, { i }), left: l, right: r }); T.n('|left − right|?', v, 'Prefix vs suffix.'); } l += x; return v; }); }
  });

  D('rearrange-array-to-maximize-prefix-score', {
    t: 'Rearrange Array to Maximize Prefix Score',
    r: 'Sort descending so prefix sums stay positive as long as possible; count positive prefixes.',
    g: R => ({ nums: R.ints(R.int(1, 8), -4, 4) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => y - x); let p = 0, c = 0; for (const [i, x] of a.entries()) { p += x; if (i < 7) { T.at({ sorted: A(a, { i }), prefix: p }); T.yn('Is this prefix positive?', p > 0, 'Count until it drops to ≤ 0.'); } if (p > 0) c++; else break; } return c; }
  });

  D('count-the-number-of-beautiful-subarrays', {
    t: 'Count the Number of Beautiful Subarrays',
    r: 'A subarray can be zeroed iff every bit appears an even number of times, i.e. its XOR is 0. Count equal prefix XORs.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 7) }),
    s(I, T) { const c = { 0: 1 }; let x = 0, t = 0; I.nums.forEach((v, i) => { x ^= v; t += c[x] || 0; c[x] = (c[x] || 0) + 1; if (i < 8) { T.at({ nums: A(I.nums, { i }), prefixXor: x }); T.n('Beautiful subarrays so far?', t, 'Earlier equal prefix XORs.'); } }); return t; }
  });

  D('sum-of-distances', { t: 'Sum of Distances', ...distSum });

  D('find-the-score-of-all-prefixes-of-an-array', {
    t: 'Find the Score of All Prefixes of an Array',
    r: 'conver[i] = nums[i] + max(nums[0..i]); the answer is the running sum of conver.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12) }),
    s(I, T) { let mx = 0, s = 0; return I.nums.map((x, i) => { mx = Math.max(mx, x); s += x + mx; if (i < 6) { T.at({ nums: A(I.nums, { i }), max: mx }); T.n('Score of this prefix?', s, 'Previous + nums[i] + max.'); } return s; }); }
  });

  D('maximum-or', {
    t: 'Maximum OR',
    r: 'Spend all k doublings on one element. With prefix OR and suffix OR, try each i: pre[i] | (nums[i] << k) | suf[i + 1].',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 15), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums.map(BigInt), n = a.length, pre = [0n], suf = Array(n + 1).fill(0n); a.forEach(x => pre.push(pre[pre.length - 1] | x)); for (let i = n - 1; i >= 0; i--) suf[i] = suf[i + 1] | a[i]; let best = 0n; a.forEach((x, i) => { const v = pre[i] | x << BigInt(I.k) | suf[i + 1]; if (v > best) best = v; if (i < 6) { T.at({ nums: A(I.nums, { i }), k: I.k }); T.n('OR if we double this one k times?', Number(v), 'prefix | (x << k) | suffix.'); } }); return Number(best); }
  });

  D('movement-of-robots', {
    t: 'Movement of Robots',
    r: 'Collisions just swap identities, so each robot ends at nums[i] ± d. Sort final positions; the sum of pairwise distances is Σ (pos[i]·i − prefix[i]) mod 1e9+7.',
    g: R => { const n = R.int(2, 6); return { nums: R.distinct(n, -6, 6), s: R.str(n, 'LR'), d: R.int(1, 5) }; },
    s(I, T) { const res = (() => { const p = I.nums.map((x, i) => x + (I.s[i] === 'R' ? I.d : -I.d)).sort((a, b) => a - b); T.at({ final: A(p) }); T.n('Leftmost final position?', p[0], 'Collisions do not matter.'); T.n('Rightmost final position?', p[p.length - 1], 'Robots pass through each other.'); let t = 0, pref = 0; p.forEach((x, i) => { t += x * i - pref; pref += x; }); return t % MOD; })(); T.n('Sum of distances (mod 1e9+7)?', res, 'Each position times its index, minus the prefix before it.'); return res; }
  });

  D('apply-operations-to-make-all-array-elements-equal-to-zero', {
    t: 'Apply Operations to Make All Array Elements Equal to Zero',
    r: 'Greedy left to right with a difference array of active decrements: the current value after decrements must be removed by starting that many operations here (fails if it is negative or the window runs past the end).',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 3), k: R.int(1, 3) }),
    s(I, T) { const n = I.nums.length, d = Array(n + 1).fill(0); let act = 0; for (let i = 0; i < n; i++) { act += d[i]; const cur = I.nums[i] - act; if (i < 7) { T.at({ nums: A(I.nums, { i }), activeDecrement: act }); T.n('Value left at this index?', cur, 'Start this many operations here.'); } if (cur < 0 || (cur > 0 && i + I.k > n)) return false; act += cur; d[i + I.k] -= cur; } return true; }
  });

  D('count-of-interesting-subarrays', {
    t: 'Count of Interesting Subarrays',
    r: 'Let p = running count of nums[i] % modulo == k, taken mod modulo. A subarray is interesting when (p_j − p_i) mod modulo == k: look up (p − k) mod modulo in a counter.',
    g: R => { const m = R.int(1, 4); return { nums: R.ints(R.int(1, 8), 0, 6), modulo: m, k: R.int(0, m - 1) }; },
    s(I, T) { const c = { 0: 1 }; let p = 0, t = 0; I.nums.forEach((x, i) => { if (x % I.modulo === I.k) p = (p + 1) % I.modulo; const w = ((p - I.k) % I.modulo + I.modulo) % I.modulo; t += c[w] || 0; c[p] = (c[p] || 0) + 1; if (i < 8) { T.at({ nums: A(I.nums, { i }), prefixCount: p }); T.n('Interesting subarrays so far?', t, 'Look up (p − k) mod modulo.'); } }); return t; }
  });

  D('points-that-intersect-with-cars', {
    t: 'Points That Intersect With Cars',
    r: 'Difference array over 1..100: +1 at start, −1 after end. Count points with positive running coverage.',
    g: R => ({ nums: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(1, 9); return [a, R.int(a, 12)]; }) }),
    s(I, T) { const d = Array(103).fill(0); I.nums.forEach(([a, b]) => { d[a]++; d[b + 1]--; }); let s = 0, c = 0, asks = 0; for (let x = 1; x <= 100; x++) { s += d[x]; if (s > 0) c++; if (d[x] && asks++ < 6) { T.at({ point: x, cars: A(I.nums.map(r => r.join('–'))) }); T.n('Cars covering this point?', s, 'Running sum.'); } } return c; }
  });

  D('minimum-sum-of-mountain-triplets-ii', {
    t: 'Minimum Sum of Mountain Triplets II',
    r: 'Precompute prefix minimums and suffix minimums. For each middle j with left min < nums[j] > right min, the sum is leftMin + nums[j] + rightMin; take the smallest, or −1.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, sm = Array(n); sm[n - 1] = a[n - 1]; for (let i = n - 2; i >= 0; i--) sm[i] = Math.min(a[i], sm[i + 1]); let lm = a[0], best = Infinity; for (let j = 1; j < n - 1; j++) { const ok = lm < a[j] && sm[j + 1] < a[j]; if (ok) best = Math.min(best, lm + a[j] + sm[j + 1]); if (j < 7) { T.at({ nums: A(a, { j }), leftMin: lm, rightMin: sm[j + 1] }); T.yn('Can this be the peak?', ok, 'Both minimums are smaller.'); } lm = Math.min(lm, a[j]); } return best === Infinity ? -1 : best; }
  });

  D('count-beautiful-substrings-i', { t: 'Count Beautiful Substrings I', ...beautiful });
  D('count-beautiful-substrings-ii', { t: 'Count Beautiful Substrings II', ...beautiful });

  D('number-of-divisible-substrings', {
    t: 'Number of Divisible Substrings',
    r: 'Map letters to keypad digits (ab→1, cde→2, …, xyz→9). A substring is divisible when its digit sum is divisible by its length. For each length L, count windows where prefix sums differ by a multiple of L (or just check every substring with prefix sums).',
    g: R => ({ word: R.str(R.int(1, 8), 'adgjmptw') }),
    s(I, T) { const groups = ['ab', 'cde', 'fgh', 'ijk', 'lmn', 'opq', 'rst', 'uvw', 'xyz'], val = ch => groups.findIndex(g => g.includes(ch)) + 1, v = [...I.word].map(val), P = pre(v); let c = 0; for (let i = 0; i < v.length; i++) { let here = 0; for (let j = i; j < v.length; j++) if ((P[j + 1] - P[i]) % (j - i + 1) === 0) here++; c += here; if (i < 5) { T.at({ word: A([...I.word], { i }), digits: A(v) }); T.n('Divisible substrings starting here?', here, 'Sum divisible by length.'); } } return c; }
  });

  D('number-of-same-end-substrings', {
    t: 'Number of Same-End Substrings',
    r: 'Prefix counts per letter. In s[l..r], a letter with c occurrences forms c(c + 1)/2 same-end substrings; sum over letters.',
    g: R => { const s = R.str(R.int(1, 8), 'abc'); return { s, queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, s.length - 1); return [l, R.int(l, s.length - 1)]; }) }; },
    s(I, T) { return I.queries.map(([l, r], i) => { const c = {}; for (const ch of I.s.slice(l, r + 1)) c[ch] = (c[ch] || 0) + 1; const v = Object.values(c).reduce((s, x) => s + x * (x + 1) / 2, 0); if (i < 4) { T.at({ s: A([...I.s], { win: [l, r] }), counts: K(c) }); T.n('Same-end substrings in range?', v, 'Σ c(c + 1)/2.'); } return v; }); }
  });

  D('find-polygon-with-the-largest-perimeter', {
    t: 'Find Polygon With the Largest Perimeter',
    r: 'Sort. Scan with a prefix sum; whenever the sum of the smaller sides exceeds the current side (with ≥ 3 sides), the prefix through it is a valid polygon — keep the last one.',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 12) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let p = 0, best = -1; a.forEach((x, i) => { const ok = i >= 2 && p > x; if (ok) best = p + x; if (i >= 2) { T.at({ sorted: A(a, { i }), smallerSum: p }); T.yn('Can this be the longest side?', ok, 'Smaller sides must sum to more.'); } p += x; }); return best; }
  });

  D('palindrome-rearrangement-queries', {
    t: 'Palindrome Rearrangement Queries',
    r: 'Pair each i in the first half with its mirror. Fixed–fixed pairs must already match; a free position must take its fixed partner\'s letter from its pool; free–free pairs take any matching letters. Feasible iff all forced letters exist and the leftover pools are equal.',
    g: R => { const h = R.int(1, 4), half = R.str(h, 'ab'); let s = half + [...half].reverse().join(''); s = [...s].map((c, i) => i >= h && R.chance(0.2) ? R.pick(['a', 'b']) : c).join(''); return { s, queries: Array.from({ length: R.int(1, 3) }, () => { const a = R.int(0, h - 1), c = R.int(h, 2 * h - 1); return [a, R.int(a, h - 1), c, R.int(c, 2 * h - 1)]; }) }; },
    s(I, T) { const s = I.s, n = s.length; return I.queries.map(([a, b, c, d], qi) => { const L = {}, Rr = {}; for (let i = a; i <= b; i++) L[s[i]] = (L[s[i]] || 0) + 1; for (let i = c; i <= d; i++) Rr[s[i]] = (Rr[s[i]] || 0) + 1; let ok = true, mism = 0; for (let i = 0; i < n / 2; i++) { const j = n - 1 - i, fi = i >= a && i <= b, fj = j >= c && j <= d; if (!fi && !fj) { if (s[i] !== s[j]) { ok = false; mism++; } } else if (fi && !fj) L[s[j]] = (L[s[j]] || 0) - 1; else if (!fi && fj) Rr[s[i]] = (Rr[s[i]] || 0) - 1; } const keys = new Set([...Object.keys(L), ...Object.keys(Rr)]); for (const k of keys) { if ((L[k] || 0) < 0 || (Rr[k] || 0) < 0 || (L[k] || 0) !== (Rr[k] || 0)) ok = false; } if (qi < 4) { T.at({ s: A([...s], { win: [a, b] }), right: `[${c}, ${d}]` }); T.n('Fixed mirror pairs that disagree?', mism, 'Positions outside both ranges.'); } return ok; }); }
  });

  D('maximum-good-subarray-sum', {
    t: 'Maximum Good Subarray Sum',
    r: 'For each value v keep the minimum prefix sum just before an occurrence of v. At index j, check v ± k in that map: sum = prefix[j + 1] − minPrefix. Return the best, or 0.',
    g: R => ({ nums: R.ints(R.int(2, 8), -3, 6), k: R.int(1, 3) }),
    s(I, T) { const mp = new Map(); let p = 0, best = -Infinity; I.nums.forEach((x, j) => { if (!mp.has(x) || mp.get(x) > p) mp.set(x, p); p += x; for (const y of [x - I.k, x + I.k]) if (mp.has(y)) best = Math.max(best, p - mp.get(y)); if (j < 7) { T.at({ nums: A(I.nums, { j }), prefix: p }); T.n('Best good sum so far (0 if none)?', best === -Infinity ? 0 : best, 'Smallest prefix before a start of x ± k.'); } }); return best === -Infinity ? 0 : best; }
  });

  D('ant-on-the-boundary', {
    t: 'Ant on the Boundary',
    r: 'The ant\'s position is the prefix sum; count how many times it equals 0 after a move.',
    g: R => ({ nums: R.ints(R.int(1, 8), -3, 3).map(x => x || 1) }),
    s(I, T) { let p = 0, c = 0; I.nums.forEach((x, i) => { p += x; if (!p) c++; if (i < 8) { T.at({ nums: A(I.nums, { i }) }); T.n('Position after this move?', p, 'Prefix sum.'); } }); return c; }
  });

  D('minimum-levels-to-gain-more-points', {
    t: 'Minimum Levels to Gain More Points',
    r: 'Score +1 for possible levels, −1 otherwise. Alice plays a prefix (≥ 1), Bob the rest (≥ 1). Return the first prefix length where Alice\'s score > total − Alice\'s.',
    g: R => ({ possible: R.ints(R.int(2, 8), 0, 1) }),
    s(I, T) { const v = I.possible.map(x => x ? 1 : -1), tot = v.reduce((a, b) => a + b, 0); let p = 0; for (let i = 0; i < v.length - 1; i++) { p += v[i]; T.at({ possible: A(I.possible, { win: [0, i] }), alice: p, bob: tot - p }); T.yn('Does Alice win with this many levels?', p > tot - p, 'Strictly more points.'); if (p > tot - p) return i + 1; } return -1; }
  });

  D('find-the-n-th-value-after-k-seconds', {
    t: 'Find the N-th Value After K Seconds',
    r: 'Each second replaces the array by its prefix sums. Simulate k rounds mod 1e9+7 (the answer equals C(n − 1 + k, k)).',
    g: R => ({ n: R.int(1, 6), k: R.int(1, 6) }),
    s(I, T) { let a = Array(I.n).fill(1); for (let t = 1; t <= I.k; t++) { for (let i = 1; i < I.n; i++) a[i] = (a[i] + a[i - 1]) % MOD; if (t <= 4) { T.at({ second: t, array: A(a.slice()) }); T.n('Last value now?', a[I.n - 1], 'Prefix sum of the previous array.'); } } return a[I.n - 1]; }
  });

  D('minimum-array-changes-to-make-differences-equal', {
    t: 'Minimum Array Changes to Make Differences Equal',
    r: 'For a pair (a, b) with d = |a − b|, target X costs 0 if X = d, 1 if X ≤ max(max(a,b), k − min(a,b)), else 2. Add these ranges on a difference array over X ∈ [0, k] and take the minimum.',
    g: R => { const k = R.int(1, 6); return { nums: R.ints(2 * R.int(1, 3), 0, k), k }; },
    s(I, T) { const a = I.nums, n = a.length; let best = Infinity; for (let X = 0; X <= I.k; X++) { let c = 0; for (let i = 0; i < n / 2; i++) { const x = a[i], y = a[n - 1 - i], d = Math.abs(x - y), m = Math.max(Math.max(x, y), I.k - Math.min(x, y)); c += d === X ? 0 : X <= m ? 1 : 2; } best = Math.min(best, c); if (X < 5) { T.at({ nums: A(a), X, k: I.k }); T.n(`Changes needed for difference ${X}?`, c, '0, 1 or 2 per pair.'); } } return best; }
  });

  D('maximum-total-area-occupied-by-pistons', {
    t: 'Maximum Total Area Occupied by Pistons',
    r: 'Total area changes linearly between "events" when a piston hits 0 or height and flips direction. Track the slope (#up − #down) with a difference array of event times over one period 2·height and take the maximum area.',
    g: R => { const h = R.int(1, 6), n = R.int(1, 4), pos = R.ints(n, 0, h); return { height: h, positions: pos, directions: pos.map(p => p === 0 ? 'U' : p === h ? 'D' : R.pick(['U', 'D'])).join('') }; },
    s(I, T) { let p = I.positions.slice(), d = [...I.directions].map(c => c === 'U' ? 1 : -1), best = p.reduce((a, b) => a + b, 0); for (let t = 1; t <= 2 * I.height; t++) { p = p.map((x, i) => { if (x === I.height && d[i] > 0) d[i] = -1; if (x === 0 && d[i] < 0) d[i] = 1; return x + d[i]; }); const area = p.reduce((a, b) => a + b, 0); best = Math.max(best, area); if (t <= 5) { T.at({ second: t, positions: A(p.slice()) }); T.n('Total area now?', area, 'Sum of piston heights.'); } } return best; }
  });

  D('make-array-elements-equal-to-zero', {
    t: 'Make Array Elements Equal to Zero',
    r: 'Starting at a zero, the ball bounces between the sides, consuming them alternately. It clears everything iff left sum = right sum (both directions work) or they differ by 1 (only toward the bigger side).',
    g: R => { const a = R.ints(R.int(1, 7), 0, 3); a[R.int(0, a.length - 1)] = 0; return { nums: a }; },
    s(I, T) { const tot = I.nums.reduce((a, b) => a + b, 0); let l = 0, c = 0; I.nums.forEach((x, i) => { if (!x) { const r = tot - l, w = l === r ? 2 : Math.abs(l - r) === 1 ? 1 : 0; c += w; T.at({ nums: A(I.nums, { i }), left: l, right: r }); T.n('Valid directions from this zero?', w, 'Equal → 2, differ by 1 → 1.'); } l += x; }); return c; }
  });

  D('zero-array-transformation-i', {
    t: 'Zero Array Transformation I',
    r: 'Each query can decrement every index in its range by 1. With a difference array of coverage counts, the array can be zeroed iff coverage[i] ≥ nums[i] everywhere.',
    g: R => { const a = R.ints(R.int(1, 6), 0, 2); return { nums: a, queries: Array.from({ length: R.int(1, 4) }, () => { const l = R.int(0, a.length - 1); return [l, R.int(l, a.length - 1)]; }) }; },
    s(I, T) { const d = Array(I.nums.length + 1).fill(0); I.queries.forEach(([l, r]) => { d[l]++; d[r + 1]--; }); let s = 0; for (let i = 0; i < I.nums.length; i++) { s += d[i]; T.at({ nums: A(I.nums, { i }), coverage: s }); T.yn('Enough coverage here?', s >= I.nums[i], 'coverage ≥ nums[i].'); if (s < I.nums[i]) return false; } return true; }
  });

  D('shift-distance-between-two-strings', {
    t: 'Shift Distance Between Two Strings',
    r: 'For each position, compare the cost of stepping forward (sum of nextCost along the way) with stepping backward (sum of previousCost). Circular prefix sums over the alphabet make each O(1); add the cheaper.',
    g: R => { const n = R.int(1, 4); return { s: R.str(n, 'abcxyz'), t: R.str(n, 'abcxyz'), nextCost: R.ints(26, 0, 5), previousCost: R.ints(26, 0, 5) }; },
    s(I, T) { let tot = 0; [...I.s].forEach((c, i) => { let x = c.charCodeAt(0) - 97, f = 0, b = 0; const y = I.t.charCodeAt(i) - 97; for (let j = x; j !== y; j = (j + 1) % 26) f += I.nextCost[j]; for (let j = x; j !== y; j = (j + 25) % 26) b += I.previousCost[j]; tot += Math.min(f, b); if (i < 4) { T.at({ from: c, to: I.t[i], forward: f, backward: b }); T.n('Cheaper cost for this letter?', Math.min(f, b), 'min(forward, backward).'); } }); return tot; }
  });

  D('maximum-subarray-sum-with-length-divisible-by-k', {
    t: 'Maximum Subarray Sum With Length Divisible by K',
    r: 'A subarray (i, j] has length divisible by k iff i ≡ j (mod k). Keep the minimum prefix sum for each index class mod k; at j, best = prefix[j] − minPrefix[j mod k].',
    g: R => { const a = R.ints(R.int(1, 8), -5, 6); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { const mn = Array(I.k).fill(Infinity); mn[0] = 0; let p = 0, best = -Infinity; I.nums.forEach((x, i) => { p += x; const c = (i + 1) % I.k; if (mn[c] < Infinity) best = Math.max(best, p - mn[c]); mn[c] = Math.min(mn[c], p); if (i < 7) { T.at({ nums: A(I.nums, { i }), minPrefix: A(mn.map(v => v === Infinity ? '∞' : v)) }); T.n('Best sum so far (0 if none)?', best === -Infinity ? 0 : best, 'prefix − min prefix of the same class.'); } }); return best; }
  });

  D('sum-of-variable-length-subarrays', {
    t: 'Sum of Variable Length Subarrays',
    r: 'For each i, sum nums[max(0, i − nums[i]) .. i] with prefix sums and add them up.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 5) }),
    s(I, T) { const P = pre(I.nums); let t = 0; I.nums.forEach((x, i) => { const s = Math.max(0, i - x), v = P[i + 1] - P[s]; t += v; if (i < 6) { T.at({ nums: A(I.nums, { win: [s, i] }) }); T.n('Sum of this subarray?', v, 'P[i + 1] − P[start].'); } }); return t; }
  });

  D('count-partitions-with-even-sum-difference', {
    t: 'Count Partitions with Even Sum Difference',
    r: 'left − right = 2·left − total, which is even iff total is even. So the answer is n − 1 when the total is even, else 0 — or just check each cut with a prefix sum.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 9) }),
    s(I, T) { const tot = I.nums.reduce((a, b) => a + b, 0); let l = 0, c = 0; for (let i = 0; i < I.nums.length - 1; i++) { l += I.nums[i]; const ok = (l - (tot - l)) % 2 === 0; if (ok) c++; if (i < 5) { T.at({ nums: A(I.nums, { win: [0, i] }), left: l, right: tot - l }); T.yn('Is the difference even?', ok, 'Depends only on the total.'); } } return c; }
  });
})();
