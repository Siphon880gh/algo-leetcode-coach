/* v2 games: binary search (04). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const firstTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search left (hi = mid).' : 'Not feasible: search right (lo = mid + 1).'); asks++; } if (v) hi = mid; else lo = mid + 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };
  const lastTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi + 1) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search right (lo = mid).' : 'Not feasible: search left (hi = mid − 1).'); asks++; } if (v) lo = mid; else hi = mid - 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };
  const lowerBound = (a, x) => { let lo = 0, hi = a.length; while (lo < hi) { const m = (lo + hi) >> 1; if (a[m] < x) lo = m + 1; else hi = m; } return lo; };
  const upperBound = (a, x) => { let lo = 0, hi = a.length; while (lo < hi) { const m = (lo + hi) >> 1; if (a[m] <= x) lo = m + 1; else hi = m; } return lo; };
  const asc = a => a.slice().sort((x, y) => x - y);
  const gcd = (a, b) => b ? gcd(b, a % b) : a;
  const special = (I, T) => { const s = I.s, runs = {}; let i = 0; while (i < s.length) { let j = i; while (j < s.length && s[j] === s[i]) j++; (runs[s[i]] = runs[s[i]] || []).push(j - i); i = j; } const occ = (c, L) => (runs[c] || []).reduce((t, r) => t + Math.max(0, r - L + 1), 0); const ok = L => Object.keys(runs).some(c => occ(c, L) >= 3); T.at({ s: A([...s]) }); T.yn('Does some single letter occur at least 3 times?', ok(1), 'Length 1 must work for any answer.'); if (!ok(1)) return -1; return lastTrue(1, s.length, ok, T, L => ({ runs: K(Object.fromEntries(Object.entries(runs).map(([c, r]) => [c, r.join(',')]))) }), L => `Is there a special substring of length ${L} occurring 3+ times?`); };
  const beautiful = (I, T) => { const find = p => { const r = []; for (let i = I.s.indexOf(p); i >= 0; i = I.s.indexOf(p, i + 1)) r.push(i); return r; }; const A1 = find(I.a), B1 = find(I.b); T.at({ s: I.s, aAt: A(A1), bAt: A(B1) }); T.n(`How many occurrences of "${I.a}"?`, A1.length, 'Pattern matching (KMP/Z).'); return A1.filter(i => { const k = lowerBound(B1, i - I.k); return k < B1.length && B1[k] <= i + I.k; }); };
  const incremovable = (I, T) => { const a = I.nums, n = a.length; let l = 0; while (l + 1 < n && a[l] < a[l + 1]) l++; if (l === n - 1) { T.at({ nums: A(a) }); T.yn('Is the array already strictly increasing?', true, 'Every subarray works: n(n + 1)/2.'); return n * (n + 1) / 2; } let r = n - 1; while (r > 0 && a[r - 1] < a[r]) r--; T.at({ nums: A(a, { win: [0, l] }) }); T.n('Last index of the strictly increasing prefix?', l, 'Extend while increasing.'); let c = 0; for (let i = -1; i <= l; i++) { const k = upperBound(a.slice(r), i < 0 ? -Infinity : a[i]) + r; c += n - Math.max(k, i + 2) + 1; } return c; };
  const freqOps = (I, T) => { const a = asc(I.nums), cand = new Set(); a.forEach(x => { cand.add(x); cand.add(x - I.k); cand.add(x + I.k); }); let best = 0; for (const t of cand) { const eq = upperBound(a, t) - lowerBound(a, t), near = upperBound(a, t + I.k) - lowerBound(a, t - I.k); best = Math.max(best, eq + Math.min(I.numOperations, near - eq)); } const t0 = a[0], eq0 = upperBound(a, t0) - lowerBound(a, t0), near0 = upperBound(a, t0 + I.k) - lowerBound(a, t0 - I.k); T.at({ sorted: A(a), k: I.k, ops: I.numOperations }); T.n(`Values within ±${I.k} of ${t0}?`, near0, 'Binary search both ends.'); T.n(`Best frequency of ${t0}?`, eq0 + Math.min(I.numOperations, near0 - eq0), 'Equal ones + min(ops, others in range).'); return best; };
  const identical = (I, T) => { const s = I.s, n = s.length; const ops = L => { if (L === 1) { let x = 0; for (let i = 0; i < n; i++) if (+s[i] !== i % 2) x++; return Math.min(x, n - x); } let t = 0, i = 0; while (i < n) { let j = i; while (j < n && s[j] === s[i]) j++; t += Math.floor((j - i) / (L + 1)); i = j; } return t; }; return firstTrue(1, n, L => ops(L) <= I.numOps, T, L => ({ s: A([...s]), flips: ops(L) }), L => `Can every block be ≤ ${L} with ≤ ${I.numOps} flips?`); };

  D('minimum-absolute-difference-between-elements-with-constraint', {
    t: 'Min Difference With Index Gap ≥ x',
    r: 'Scan j from x upward, inserting nums[j − x] into a sorted list; binary search the closest value to nums[j].',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 15), x: R.int(0, n - 1) }; },
    s(I, T) { const s = []; let best = Infinity; for (let j = I.x; j < I.nums.length; j++) { const v = I.nums[j - I.x]; s.splice(lowerBound(s, v), 0, v); const k = lowerBound(s, I.nums[j]); let d = Infinity; if (k < s.length) d = s[k] - I.nums[j]; if (k) d = Math.min(d, I.nums[j] - s[k - 1]); if (j - I.x < 5) { T.at({ allowed: A(s), value: I.nums[j] }); T.n(`Closest difference for index ${j}?`, d, 'Neighbors of the insertion point.'); } best = Math.min(best, d); } return best; }
  });

  D('minimum-relative-loss-after-buying-chocolates', {
    t: 'Minimum Relative Loss Buying Chocolates',
    r: 'A chocolate with price p costs Bob p − 0 if p ≤ k, else k − (p − k) = 2k − p. Bob takes the m smallest losses; sorting plus binary search on the split finds them fast.',
    g: R => { const n = R.int(1, 6); return { prices: R.ints(n, 1, 20), queries: Array.from({ length: R.int(1, 3) }, () => [R.int(1, 20), R.int(1, n)]) }; },
    s(I, T) { return I.queries.map(([k, m]) => { const l = I.prices.map(p => p <= k ? p : 2 * k - p).sort((a, b) => a - b), v = l.slice(0, m).reduce((a, b) => a + b, 0); T.at({ prices: A(I.prices), k, m }); T.n(`Bob's loss for a chocolate costing ${I.prices[0]}?`, I.prices[0] <= k ? I.prices[0] : 2 * k - I.prices[0], 'p if p ≤ k, else 2k − p.'); return v; }); }
  });

  D('count-pairs-whose-sum-is-less-than-target', {
    t: 'Count Pairs With Sum Less Than Target',
    r: 'Sort, then two pointers: if a[l] + a[r] < target, all r − l pairs with this l work; move l. Else move r.',
    g: R => ({ nums: R.ints(R.int(1, 7), -5, 9), target: R.int(-3, 12) }),
    s(I, T) { const a = asc(I.nums); let l = 0, r = a.length - 1, c = 0; while (l < r) { const ok = a[l] + a[r] < I.target; T.at({ sorted: A(a, { hl: [l, r] }), target: I.target }); T.yn(`Is ${a[l]} + ${a[r]} < ${I.target}?`, ok, ok ? `Count ${r - l} pairs, l++.` : 'r−−.'); if (ok) { c += r - l; l++; } else r--; } if (a.length < 2) T.n('Pairs?', 0, 'Need two.'); return c; }
  });

  D('find-the-longest-equal-subarray', {
    t: 'Longest Equal Subarray After k Deletions',
    r: 'For each value, take its positions. A window of positions [i..j] needs (pos[j] − pos[i] + 1) − (j − i + 1) deletions; slide while ≤ k.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3), k: R.int(0, 3) }),
    s(I, T) { const pos = {}; I.nums.forEach((v, i) => (pos[v] = pos[v] || []).push(i)); let best = 0; for (const v of Object.keys(pos).sort()) { const p = pos[v]; let l = 0, here = 0; for (let r = 0; r < p.length; r++) { while (p[r] - p[l] + 1 - (r - l + 1) > I.k) l++; here = Math.max(here, r - l + 1); } T.at({ value: +v, positions: A(p) }); T.n(`Best run of ${v} after ≤ ${I.k} deletions?`, here, 'Gaps inside the window must be deleted.'); best = Math.max(best, here); } return best; }
  });

  D('maximum-coins-heroes-can-collect', {
    t: 'Maximum Coins Heroes Can Collect',
    r: 'Sort monsters by power with prefix sums of coins. Each hero collects all monsters with power ≤ hero: binary search.',
    g: R => { const m = R.int(1, 5); return { heroes: R.ints(R.int(1, 3), 1, 9), monsters: R.ints(m, 1, 9), coins: R.ints(m, 1, 9) }; },
    s(I, T) { const o = I.monsters.map((x, i) => i).sort((a, b) => I.monsters[a] - I.monsters[b]), ms = o.map(i => I.monsters[i]), P = [0]; o.forEach(i => P.push(P[P.length - 1] + I.coins[i])); return I.heroes.map(h => { const k = upperBound(ms, h); T.at({ monsters: A(ms, { win: [0, k - 1] }), hero: h }); T.n(`Monsters hero ${h} can defeat?`, k, 'Powers ≤ hero.'); return P[k]; }); }
  });

  D('minimum-array-length-after-pair-removals', {
    t: 'Minimum Length After Pair Removals',
    r: 'Any two different values can be removed together. If the most frequent value appears f > n/2 times, 2f − n remain; otherwise n mod 2.',
    g: R => ({ nums: asc(R.ints(R.int(1, 8), 1, 4)) }),
    s(I, T) { const n = I.nums.length, c = {}; I.nums.forEach(x => c[x] = (c[x] || 0) + 1); const f = Math.max(...Object.values(c)); T.at({ nums: A(I.nums), counts: K(c) }); T.n('Highest frequency?', f, 'Find it with binary searches on the sorted array.'); return f > n / 2 ? 2 * f - n : n % 2; }
  });

  D('maximum-number-of-alloys', {
    t: 'Maximum Number of Alloys',
    r: 'For each machine, binary search the alloy count a: buying Σ max(0, a·comp[j] − stock[j])·cost[j] must fit the budget. Take the best machine.',
    g: R => { const n = R.int(1, 3), k = R.int(1, 2); return { n, k, budget: R.int(0, 30), composition: Array.from({ length: k }, () => R.ints(n, 1, 3)), stock: R.ints(n, 0, 5), cost: R.ints(n, 1, 3) }; },
    s(I, T) { let best = 0; I.composition.forEach((comp, m) => { const price = a => comp.reduce((s, c, j) => s + Math.max(0, a * c - I.stock[j]) * I.cost[j], 0); const a = lastTrue(0, I.budget + Math.max(...I.stock), a => price(a) <= I.budget, T, a => ({ machine: m, cost: price(a) }), a => `Can machine ${m} make ${a} alloys within ${I.budget}?`); best = Math.max(best, a); }); return best; }
  });

  D('number-of-equal-numbers-blocks', {
    t: 'Number of Equal-Number Blocks',
    r: 'Equal values are adjacent, so from the start of a block binary search (or gallop) to the last index with the same value; jump past it and count.',
    g: R => ({ nums: Array.from({ length: R.int(1, 5) }, (_, i) => Array(R.int(1, 4)).fill(i + 1)).flat() }),
    s(I, T) { const a = I.nums; let i = 0, c = 0; while (i < a.length) { let lo = i, hi = a.length - 1; while (lo < hi) { const m = Math.floor((lo + hi + 1) / 2); if (a[m] === a[i]) lo = m; else hi = m - 1; } T.at({ nums: A(a, { win: [i, lo] }) }); T.n(`Last index of the block starting at ${i}?`, lo, 'Binary search for the same value.'); c++; i = lo + 1; } return c; }
  });

  D('maximum-gcd-sum-of-a-subarray', {
    t: 'Maximum GCD-Sum of a Subarray',
    r: 'For a fixed right end there are only O(log V) distinct gcds of subarrays ending there; keep the leftmost start for each and score sum × gcd when the length ≥ k.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 1, 12), k: R.int(1, n) }; },
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); let best = 0, list = []; for (let r = 0; r < n; r++) { const nx = []; for (const [g, l] of [...list, [a[r], r]]) { const ng = gcd(g, a[r]); if (nx.length && nx[nx.length - 1][0] === ng) continue; nx.push([ng, l]); } list = nx; for (const [g, l] of list) if (r - l + 1 >= I.k) best = Math.max(best, (P[r + 1] - P[l]) * g); if (r < 5) { T.at({ nums: A(a, { hl: [r] }), gcds: A(list.map(x => x[0])) }); T.n(`Distinct gcds of subarrays ending at ${r}?`, list.length, 'Merge equal gcds, keep the leftmost start.'); } } return best; }
  });

  D('minimum-cost-to-make-array-equalindromic', {
    t: 'Minimum Cost to Make Array Equalindromic',
    r: 'Σ |nums − y| is minimized at the median, so try the nearest palindromes below and above the median and take the cheaper.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 150) }),
    s(I, T) { const a = asc(I.nums), m = a[Math.floor(a.length / 2)], pal = x => { const s = String(x); return s === [...s].reverse().join(''); }; let lo = m, hi = m; while (!pal(lo)) lo--; while (!pal(hi)) hi++; T.at({ sorted: A(a), median: m }); T.n('Nearest palindrome ≤ the median?', lo, 'Step down until it reads the same both ways.'); const c = y => a.reduce((s, x) => s + Math.abs(x - y), 0); return Math.min(c(lo), c(hi)); }
  });

  D('apply-operations-to-maximize-frequency-score', {
    t: 'Maximize Frequency Score With k Changes',
    r: 'Sort. A window can be made equal to its median for cost = (median·left − leftSum) + (rightSum − median·right). Slide the window with prefix sums while cost ≤ k.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12), k: R.int(0, 8) }),
    s(I, T) { const a = asc(I.nums), P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); const cost = (l, r) => { const m = (l + r) >> 1; return a[m] * (m - l) - (P[m] - P[l]) + (P[r + 1] - P[m + 1]) - a[m] * (r - m); }; let l = 0, best = 0; for (let r = 0; r < a.length; r++) { while (cost(l, r) > I.k) l++; if (r < 6) { T.at({ sorted: A(a, { win: [l, r] }), k: I.k }); T.n(`Longest valid window ending at ${r}?`, r - l + 1, 'Cost to move all to the median ≤ k.'); } best = Math.max(best, r - l + 1); } return best; }
  });

  D('count-the-number-of-incremovable-subarrays-i', {
    t: 'Incremovable Subarrays I',
    r: 'Keep a strictly increasing prefix ending at i and a strictly increasing suffix starting at j > i + 1 with nums[j] > nums[i]; count the removable middles (binary search j).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { return incremovable(I, T); }
  });

  D('count-the-number-of-incremovable-subarrays-ii', {
    t: 'Incremovable Subarrays II',
    r: 'For each end i of the kept increasing prefix (or none), binary search the first suffix start j with nums[j] > nums[i]; every removal ending at j − 1 or later works.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { return incremovable(I, T); }
  });

  D('find-longest-special-substring-that-occurs-thrice-i', {
    t: 'Longest Special Substring Occurring Thrice I',
    r: 'Special substrings are runs of one letter. A run of length r contains r − L + 1 copies of length L. Binary search L for the largest one with ≥ 3 copies of some letter.',
    g: R => ({ s: R.str(R.int(3, 10), 'aab') }),
    s(I, T) { return special(I, T); }
  });

  D('find-longest-special-substring-that-occurs-thrice-ii', {
    t: 'Longest Special Substring Occurring Thrice II',
    r: 'Same idea for long strings: group run lengths per letter, then binary search L (copies are monotone in L).',
    g: R => ({ s: R.str(R.int(3, 12), 'aab') }),
    s(I, T) { return special(I, T); }
  });

  D('find-beautiful-indices-in-the-given-array-i', {
    t: 'Beautiful Indices I',
    r: 'Find all occurrences of a and of b. Index i (an occurrence of a) is beautiful if some occurrence j of b has |i − j| ≤ k: binary search the sorted b list.',
    g: R => ({ s: R.str(R.int(2, 10), 'ab'), a: R.str(R.int(1, 2), 'ab'), b: R.str(R.int(1, 2), 'ab'), k: R.int(1, 4) }),
    s(I, T) { return beautiful(I, T); }
  });

  D('find-beautiful-indices-in-the-given-array-ii', {
    t: 'Beautiful Indices II',
    r: 'With long strings, find occurrences with KMP or Z, then binary search (or two-pointer) the b positions for each a position.',
    g: R => ({ s: R.str(R.int(2, 12), 'ab'), a: R.str(R.int(1, 2), 'ab'), b: R.str(R.int(1, 2), 'ab'), k: R.int(1, 4) }),
    s(I, T) { return beautiful(I, T); }
  });

  D('earliest-second-to-mark-indices-i', {
    t: 'Earliest Second to Mark Indices I',
    r: 'Binary search second t. Each index must be marked at its last appearance within 1..t; before that, enough free seconds must have been spent decrementing it.',
    g: R => { const n = R.int(1, 3); return { nums: R.ints(n, 0, 2), changeIndices: Array.from({ length: R.int(1, 8) }, () => R.int(1, n)) }; },
    s(I, T) { const n = I.nums.length, m = I.changeIndices.length; const ok = t => { const last = Array(n + 1).fill(-1); for (let s = 0; s < t; s++) last[I.changeIndices[s]] = s; if (last.slice(1).some(x => x < 0)) return false; let free = 0; for (let s = 0; s < t; s++) { const i = I.changeIndices[s]; if (last[i] === s) { if (free < I.nums[i - 1]) return false; free -= I.nums[i - 1]; } else free++; } return true; }; T.at({ nums: A(I.nums), changes: A(I.changeIndices) }); T.yn('Can all indices be marked by the last second?', ok(m), 'If not, the answer is −1.'); if (!ok(m)) return -1; return firstTrue(1, m, ok, T, null, t => `Can everything be marked by second ${t}?`); }
  });

  D('earliest-second-to-mark-indices-ii', {
    t: 'Earliest Second to Mark Indices II',
    r: 'Binary search t. Walk seconds backward: at an index\'s first appearance, zeroing it costs that second plus one later free second for marking; a min-heap keeps the best zeroings when free seconds run out. The rest must be decremented and marked with leftover seconds.',
    g: R => { const n = R.int(1, 3); return { nums: R.ints(n, 0, 3), changeIndices: Array.from({ length: R.int(1, 8) }, () => R.int(1, n)) }; },
    s(I, T) { const n = I.nums.length, m = I.changeIndices.length, sum = I.nums.reduce((a, b) => a + b, 0); const ok = t => { if (t < n) return false; const first = Array(n + 1).fill(-1); for (let s = t - 1; s >= 0; s--) first[I.changeIndices[s]] = s; let cnt = 0; const heap = []; for (let s = t - 1; s >= 0; s--) { const i = I.changeIndices[s], v = I.nums[i - 1]; if (v <= 1 || first[i] !== s) { cnt++; continue; } if (cnt === 0) { if (!heap.length || v <= heap[0]) { cnt++; continue; } heap.shift(); cnt += 2; } heap.splice(lowerBound(heap, v), 0, v); cnt--; } const zeroed = heap.reduce((a, b) => a + b, 0); return cnt >= sum - zeroed + n - heap.length; }; T.at({ nums: A(I.nums), changes: A(I.changeIndices) }); T.yn('Can all indices be marked by the last second?', ok(m), 'If not, the answer is −1.'); if (!ok(m)) return -1; return firstTrue(1, m, ok, T, null, t => `Can everything be marked by second ${t}?`); }
  });

  D('kth-smallest-amount-with-single-denomination-combination', {
    t: 'Kth Smallest Single-Coin Amount',
    r: 'Amounts are multiples of some coin. Count multiples ≤ x with inclusion–exclusion over subsets (lcm of each subset). Binary search the first x with count ≥ k.',
    g: R => ({ coins: R.distinct(R.int(1, 3), 2, 9), k: R.int(1, 15) }),
    s(I, T) { const c = I.coins, subs = []; for (let m = 1; m < 1 << c.length; m++) { let l = 1, b = 0; for (let i = 0; i < c.length; i++) if (m >> i & 1) { l = l / gcd(l, c[i]) * c[i]; b++; } subs.push([l, b % 2 ? 1 : -1]); } const cnt = x => subs.reduce((s, [l, sg]) => s + sg * Math.floor(x / l), 0); return firstTrue(1, Math.min(...c) * I.k, x => cnt(x) >= I.k, T, x => ({ count: cnt(x) }), x => `Are at least ${I.k} amounts ≤ ${x}?`); }
  });

  D('find-the-median-of-the-uniqueness-array', {
    t: 'Median of the Uniqueness Array',
    r: 'Binary search d: count subarrays with ≤ d distinct values via a sliding window. The median is the first d whose count reaches the middle position.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 4) }),
    s(I, T) { const a = I.nums, n = a.length, total = n * (n + 1) / 2, need = Math.ceil(total / 2); const atMost = d => { const c = new Map(); let l = 0, res = 0; for (let r = 0; r < n; r++) { c.set(a[r], (c.get(a[r]) || 0) + 1); while (c.size > d) { c.set(a[l], c.get(a[l]) - 1); if (!c.get(a[l])) c.delete(a[l]); l++; } res += r - l + 1; } return res; }; return firstTrue(1, n, d => atMost(d) >= need, T, d => ({ nums: A(a), countLE: atMost(d) }), d => `Do at least ${need} subarrays have ≤ ${d} distinct values?`); }
  });

  D('maximum-points-inside-the-square', {
    t: 'Maximum Points Inside the Square',
    r: 'A point is inside half-side h iff max(|x|, |y|) ≤ h. For each tag, the second-closest point sets a limit: h must be smaller. Count points strictly below the tightest limit.',
    g: R => { const n = R.int(1, 6); const pts = Array.from({ length: n }, () => [R.int(-5, 5), R.int(-5, 5)]).filter((p, i, arr) => arr.findIndex(q => q[0] === p[0] && q[1] === p[1]) === i); return { points: pts, s: R.str(pts.length, 'abc') }; },
    s(I, T) { const s = I.s; const d = I.points.map(([x, y]) => Math.max(Math.abs(x), Math.abs(y))), byTag = {}; d.forEach((v, i) => (byTag[s[i]] = byTag[s[i]] || []).push(v)); let lim = Infinity; for (const t in byTag) { const v = asc(byTag[t]); if (v.length > 1) lim = Math.min(lim, v[1]); } T.at({ dist: A(d), tags: A([...s]) }); T.n('Tightest limit (second-closest distance of any tag; 99 if none)?', lim === Infinity ? 99 : lim, 'The square must stay strictly smaller.'); return d.filter(v => v < lim).length; }
  });

  D('find-products-of-elements-of-big-array', {
    t: 'Products of the Big Array',
    r: 'big_nums concatenates the set bits (as powers of two) of 1, 2, 3, … . Every element is a power of two, so a product is 2^(sum of exponents): count exponents in a prefix with binary search over how many numbers fit, then use fast power.',
    g: R => ({ queries: Array.from({ length: R.int(1, 3) }, () => { const f = R.int(0, 12); return [f, f + R.int(0, 5), R.int(1, 20)]; }) }),
    s(I, T) { const big = []; for (let x = 1; big.length <= 40; x++) for (let b = 0; b < 20; b++) if (x >> b & 1) big.push(b); return I.queries.map(([f, t, m]) => { let e = 0; for (let i = f; i <= t; i++) e += big[i]; T.at({ exponents: A(big.slice(0, 16)), range: `${f}..${t}` }); T.n('Sum of exponents in the range?', e, 'Each element is 2^exponent.'); let r = 1 % m, b = 2 % m; while (e) { if (e & 1) r = r * b % m; b = b * b % m; e >>= 1; } return r; }); }
  });

  D('special-array-ii', {
    t: 'Special Array II: bad-pair prefix counts',
    r: 'Mark positions i where nums[i] and nums[i − 1] have the same parity; a query [l, r] is special iff no mark lies in (l, r] (prefix sums).',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 9), queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1)]; }) }; },
    s(I, T) { const P = [0]; for (let i = 1; i < I.nums.length; i++) P.push(P[i - 1] + ((I.nums[i] + I.nums[i - 1]) % 2 === 0 ? 1 : 0)); return I.queries.map(([l, r]) => { const bad = P[r] - P[l]; T.at({ nums: A(I.nums, { win: [l, r] }), badPrefix: A(P) }); T.n(`Same-parity neighbors inside [${l}, ${r}]?`, bad, 'P[r] − P[l].'); return bad === 0; }); }
  });

  D('maximum-number-of-upgradable-servers', {
    t: 'Maximum Upgradable Servers',
    r: 'Upgrade x servers and sell the rest: need x·upgrade ≤ money + (count − x)·sell. So x = min(count, ⌊(money + count·sell) / (upgrade + sell)⌋) (or binary search x).',
    g: R => { const n = R.int(1, 3); return { count: R.ints(n, 1, 6), upgrade: R.ints(n, 1, 6), sell: R.ints(n, 1, 6), money: R.ints(n, 1, 9) }; },
    s(I, T) { return I.count.map((c, i) => { const x = Math.min(c, Math.floor((I.money[i] + c * I.sell[i]) / (I.upgrade[i] + I.sell[i]))); T.at({ count: c, upgrade: I.upgrade[i], sell: I.sell[i], money: I.money[i] }); T.n(`Servers upgradable in center ${i}?`, x, 'Upgrade cost ≤ money + sales of the rest.'); return x; }); }
  });

  D('minimum-number-of-increasing-subsequence-to-be-removed', {
    t: 'Fewest Increasing Subsequences to Remove All',
    r: 'By Dilworth, the answer is the length of the longest non-increasing subsequence. Compute it with patience sorting (binary search on negated values).',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const t = []; I.nums.forEach((x, i) => { const k = upperBound(t, -x); t[k] = -x; if (i < 6) { T.at({ nums: A(I.nums, { hl: [i] }), piles: A(t.map(v => -v)) }); T.n(`Pile count after ${x}?`, t.length, 'Place on the first pile whose top is smaller than it.'); } }); return t.length; }
  });

  D('count-substrings-that-satisfy-k-constraint-ii', {
    t: 'Substrings Satisfying the k-Constraint II',
    r: 'For each start i, a sliding window gives the farthest valid end right[i]. For a query, starts whose right end stays inside contribute their full count via prefix sums; the rest form an arithmetic series (binary search the boundary).',
    g: R => { const s = R.str(R.int(1, 8), '01'), n = s.length; return { s, k: R.int(1, 3), queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1)]; }) }; },
    s(I, T) { const s = I.s, n = s.length, right = Array(n); let r = 0, z = 0, o = 0; for (let i = 0; i < n; i++) { while (r < n && (z + (s[r] === '0') <= I.k || o + (s[r] === '1') <= I.k)) { if (s[r] === '0') z++; else o++; r++; } right[i] = r - 1; if (s[i] === '0') z--; else o--; } T.at({ s: A([...s]), farthest: A(right) }); T.n('Farthest valid end from index 0?', right[0], 'Sliding window.'); return I.queries.map(([l, q]) => { let c = 0; for (let i = l; i <= q; i++) c += Math.min(right[i], q) - i + 1; return c; }); }
  });

  D('maximize-score-of-numbers-in-ranges', {
    t: 'Maximize Score of Numbers in Ranges',
    r: 'Sort starts. Binary search gap g: greedily pick the smallest allowed number in each interval at least g after the previous pick.',
    g: R => ({ start: R.ints(R.int(2, 5), 0, 12), d: R.int(0, 4) }),
    s(I, T) { const s = asc(I.start), ok = g => { let prev = -Infinity; for (const x of s) { const v = Math.max(x, prev + g); if (v > x + I.d) return false; prev = v; } return true; }; return lastTrue(0, s[s.length - 1] + I.d - s[0], ok, T, () => ({ starts: A(s), d: I.d }), g => `Can every pick be ≥ ${g} apart?`); }
  });

  D('length-of-the-longest-increasing-path', {
    t: 'Longest Increasing Path Through Point k',
    r: 'Keep points strictly below-left of k and strictly above-right. In each group, sort by x ascending (y descending on ties) and take the LIS of y with binary search. Answer = both + 1.',
    g: R => { const n = R.int(1, 7), pts = []; while (pts.length < n) { const p = [R.int(0, 8), R.int(0, 8)]; if (!pts.some(q => q[0] === p[0] && q[1] === p[1])) pts.push(p); } return { coordinates: pts, k: R.int(0, n - 1) }; },
    s(I, T) { const [kx, ky] = I.coordinates[I.k], lis = pts => { pts.sort((a, b) => a[0] - b[0] || b[1] - a[1]); const t = []; for (const [, y] of pts) t[lowerBound(t, y)] = y; return t.length; }; const lo = I.coordinates.filter(([x, y]) => x < kx && y < ky), hi = I.coordinates.filter(([x, y]) => x > kx && y > ky); T.at({ point: `${kx},${ky}`, below: A(lo.map(p => p.join(','))), above: A(hi.map(p => p.join(','))) }); const a = lis(lo); T.n('Longest increasing chain ending below-left of k?', a, 'LIS on y after sorting by x.'); return a + 1 + lis(hi); }
  });

  D('minimum-number-of-seconds-to-make-mountain-height-zero', {
    t: 'Seconds to Make the Mountain Height Zero',
    r: 'Binary search time t. Worker w can remove x units where w·x(x + 1)/2 ≤ t. t works if the workers together remove ≥ the height.',
    g: R => ({ mountainHeight: R.int(1, 12), workerTimes: R.ints(R.int(1, 4), 1, 4) }),
    s(I, T) { const units = t => I.workerTimes.reduce((s, w) => s + Math.floor((Math.sqrt(1 + 8 * t / w) - 1) / 2 + 1e-9), 0); const h = I.mountainHeight; return firstTrue(1, Math.min(...I.workerTimes) * h * (h + 1) / 2, t => units(t) >= h, T, t => ({ removed: units(t) }), t => `In ${t} seconds, can the workers remove ${h} units?`); }
  });

  D('sorted-gcd-pair-queries', {
    t: 'Sorted GCD Pair Queries',
    r: 'Count pairs with gcd exactly g by counting multiples of g (C(cnt, 2)) and subtracting exact counts of multiples of g, from the largest g down. Prefix sums over g, then binary search each query index.',
    g: R => { const n = R.int(2, 5); return { nums: R.ints(n, 1, 12), queries: R.ints(R.int(1, 3), 0, n * (n - 1) / 2 - 1) }; },
    s(I, T) { const mx = Math.max(...I.nums), cm = Array(mx + 1).fill(0), ex = Array(mx + 1).fill(0); I.nums.forEach(x => cm[x]++); for (let g = mx; g >= 1; g--) { let c = 0; for (let m = g; m <= mx; m += g) c += cm[m]; ex[g] = c * (c - 1) / 2; for (let m = 2 * g; m <= mx; m += g) ex[g] -= ex[m]; } const P = []; let s = 0; for (let g = 1; g <= mx; g++) P.push(s += ex[g]); T.at({ nums: A(I.nums), exactPairs: A(ex.slice(1)) }); T.n('Pairs with gcd exactly 1?', ex[1], 'Multiples-of-1 pairs minus pairs with bigger gcds.'); return I.queries.map(q => upperBound(P, q) + 1); }
  });

  D('minimize-connected-groups-by-inserting-interval', {
    t: 'Minimize Connected Groups by Inserting an Interval',
    r: 'Merge intervals into groups. A new interval of length ≤ k can bridge from group i to every group j whose start − end_i ≤ k: binary search the farthest j. Groups saved = j − i.',
    g: R => ({ intervals: Array.from({ length: R.int(1, 5) }, () => { const s = R.int(1, 20); return [s, s + R.int(0, 3)]; }), k: R.int(1, 5) }),
    s(I, T) { const iv = I.intervals.slice().sort((a, b) => a[0] - b[0]), g = []; for (const [s, e] of iv) { if (g.length && s <= g[g.length - 1][1]) g[g.length - 1][1] = Math.max(g[g.length - 1][1], e); else g.push([s, e]); } T.at({ groups: A(g.map(x => x.join('-'))) }); T.n('Groups before inserting?', g.length, 'Merge touching intervals.'); const st = g.map(x => x[0]); let save = 0; g.forEach(([, e], i) => { save = Math.max(save, upperBound(st, e + I.k) - 1 - i); }); return g.length - save; }
  });

  D('maximum-sized-array', {
    t: 'Maximum-Sized Array: sum of i·(j OR k)',
    r: 'The sum factors as (0 + 1 + … + n − 1) · Σ_{j,k} (j OR k). Binary search the largest n whose sum ≤ s; per bit, (j OR k) has the bit unless both lack it.',
    g: R => ({ s: R.int(0, 2000) }),
    s(I, T) { const f = n => { let or = 0; for (let b = 0; (1 << b) < n; b++) { let z = 0; for (let x = 0; x < n; x++) if (!(x >> b & 1)) z++; or += (n * n - z * z) * (1 << b); } return n * (n - 1) / 2 * or; }; return lastTrue(1, 40, n => f(n) <= I.s, T, n => ({ sum: f(n) }), n => `Is the total for n = ${n} at most ${I.s}?`); }
  });

  D('maximum-frequency-of-an-element-after-performing-operations-i', {
    t: 'Max Frequency After Operations I',
    r: 'Try targets t = each value and value ± k. Frequency = (copies of t) + min(numOperations, values within ±k of t that are not t). Count with binary searches on the sorted array.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12), k: R.int(0, 3), numOperations: R.int(0, 4) }),
    s(I, T) { return freqOps(I, T); }
  });

  D('maximum-frequency-of-an-element-after-performing-operations-ii', {
    t: 'Max Frequency After Operations II',
    r: 'Values are large, so only candidate targets matter: every value and value ± k. Count copies and values within ±k with binary search.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 30), k: R.int(0, 6), numOperations: R.int(0, 5) }),
    s(I, T) { return freqOps(I, T); }
  });

  D('adjacent-increasing-subarrays-detection-ii', {
    t: 'Adjacent Increasing Subarrays II',
    r: 'Track lengths of strictly increasing runs. Two adjacent subarrays of length k fit inside one run (k = ⌊run/2⌋) or across consecutive runs (k = min(prev, cur)).',
    g: R => ({ nums: R.ints(R.int(2, 10), 1, 9) }),
    s(I, T) { const a = I.nums; let prev = 0, cur = 1, best = 0; for (let i = 1; i <= a.length; i++) { if (i < a.length && a[i] > a[i - 1]) { cur++; continue; } best = Math.max(best, Math.floor(cur / 2), Math.min(prev, cur)); T.at({ nums: A(a, { win: [i - cur, i - 1] }) }); T.n('Length of this increasing run?', cur, 'Ends where the next value does not increase.'); prev = cur; cur = 1; } return best; }
  });

  D('zero-array-transformation-ii', {
    t: 'Zero Array Transformation II',
    r: 'Binary search k: apply the first k queries as a difference array; k works if every position gets total decrement ≥ nums[i]. −1 if even all queries fail.',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, 0, 4), queries: Array.from({ length: R.int(1, 5) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1), R.int(1, 3)]; }) }; },
    s(I, T) { const n = I.nums.length, ok = k => { const d = Array(n + 1).fill(0); for (let q = 0; q < k; q++) { const [l, r, v] = I.queries[q]; d[l] += v; d[r + 1] -= v; } let c = 0; for (let i = 0; i < n; i++) { c += d[i]; if (c < I.nums[i]) return false; } return true; }; const m = I.queries.length; T.at({ nums: A(I.nums) }); T.yn('Do all queries together zero the array?', ok(m), 'Otherwise −1.'); if (!ok(m)) return -1; return firstTrue(0, m, ok, T, null, k => `Do the first ${k} queries suffice?`); }
  });

  D('minimize-the-maximum-adjacent-element-difference', {
    t: 'Minimize the Max Adjacent Difference With Two Fill Values',
    r: 'Binary search the answer d. Known neighbors of −1 runs define intervals each fill value must hit; pick x = smallest right end − … and check every run can use x or y (a run between a and b may need both). This game checks small cases exhaustively.',
    g: R => ({ nums: Array.from({ length: R.int(2, 6) }, () => R.chance(0.4) ? -1 : R.int(1, 9)) }),
    s(I, T) { const a = I.nums, known = a.filter(x => x > 0); let base = 0; for (let i = 1; i < a.length; i++) if (a[i] > 0 && a[i - 1] > 0) base = Math.max(base, Math.abs(a[i] - a[i - 1])); T.at({ nums: A(a) }); T.n('Largest gap between adjacent known values?', base, 'Fill values cannot change these.'); if (!known.length) return 0; const hi = Math.max(...known); let best = Infinity; for (let x = 1; x <= hi; x++) for (let y = x; y <= hi; y++) { let dp = [0, 0]; for (let i = 0; i < a.length; i++) { const opts = a[i] > 0 ? [a[i], a[i]] : [x, y]; if (i === 0) { dp = [0, 0]; continue; } const prev = a[i - 1] > 0 ? [a[i - 1], a[i - 1]] : [x, y]; dp = opts.map(v => Math.min(Math.max(dp[0], Math.abs(v - prev[0])), Math.max(dp[1], Math.abs(v - prev[1])))); } best = Math.min(best, Math.min(...dp)); } return best; }
  });

  D('smallest-substring-with-identical-characters-i', {
    t: 'Smallest Max Run With Flips I',
    r: 'Binary search the max run L. For L = 1, compare against the two alternating patterns. Otherwise a run of length r needs ⌊r / (L + 1)⌋ flips.',
    g: R => ({ s: R.str(R.int(1, 10), '001'), numOps: R.int(0, 3) }),
    s(I, T) { return identical(I, T); }
  });

  D('smallest-substring-with-identical-characters-ii', {
    t: 'Smallest Max Run With Flips II',
    r: 'Same check for long strings: binary search L, count ⌊run / (L + 1)⌋ per run, and handle L = 1 with the alternating patterns.',
    g: R => ({ s: R.str(R.int(1, 12), '001'), numOps: R.int(0, 4) }),
    s(I, T) { return identical(I, T); }
  });

  D('maximum-coins-from-k-consecutive-bags', {
    t: 'Maximum Coins From k Consecutive Bags',
    r: 'An optimal window starts at some segment\'s left end or ends at some segment\'s right end. Sort segments; for each candidate, add full segments by prefix sums and the partial one at the edge (binary search).',
    g: R => { const segs = []; let x = 1; for (let i = 0; i < R.int(1, 4); i++) { x += R.int(0, 3); const l = x; x += R.int(0, 3); segs.push([l, x, R.int(1, 5)]); x++; } return { coins: R.shuffle(segs), k: R.int(1, 8) }; },
    s(I, T) { const sg = I.coins.slice().sort((a, b) => a[0] - b[0]); const cover = (L, Rr) => sg.reduce((s, [l, r, c]) => s + Math.max(0, Math.min(r, Rr) - Math.max(l, L) + 1) * c, 0); let best = 0; sg.forEach(([l, r], i) => { const a = cover(l, l + I.k - 1), b = cover(r - I.k + 1, r); if (i < 3) { T.at({ segments: A(sg.map(x => x.join('/'))), k: I.k }); T.n(`Coins in the window starting at ${l}?`, a, 'Full segments plus the partial edge.'); } best = Math.max(best, a, b); }); return best; }
  });
})();
