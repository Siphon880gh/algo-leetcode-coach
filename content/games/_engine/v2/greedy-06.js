/* v2 games: greedy (06). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const sorted = a => a.slice().sort((x, y) => x - y);
  const cnt = a => { const m = new Map(); for (const x of a) m.set(x, (m.get(x) || 0) + 1); return m; };
  const M = 1000000007n;

  D('split-array-into-maximum-number-of-subarrays', {
    t: 'Split Into Maximum Subarrays: cut when the AND hits 0',
    r: 'The minimum total score is the AND of everything. If it is > 0, only one piece works. Otherwise cut greedily whenever the running AND becomes 0.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 7) }),
    s(I, T) { let all = I.nums.reduce((a, b) => a & b); T.at({ nums: A(I.nums) }); T.n('AND of the whole array?', all, 'The minimum possible total.'); if (all) return 1; let cur = -1, c = 0; I.nums.forEach((x, i) => { cur &= x; if (cur === 0) { c++; cur = -1; } }); return c; }
  });

  D('minimum-processing-time', {
    t: 'Minimum Processing Time: longest tasks to earliest processors',
    r: 'Sort processors ascending and tasks descending. Processor i gets tasks 4i … 4i+3; its finish time is processorTime[i] + tasks[4i].',
    g: R => { const n = R.int(1, 3); return { processorTime: R.ints(n, 0, 10), tasks: R.ints(4 * n, 1, 9) }; },
    s(I, T) { const p = sorted(I.processorTime), t = sorted(I.tasks).reverse(); let best = 0; p.forEach((x, i) => { T.at({ processors: A(p, { hl: [i] }), tasks: A(t, { win: [4 * i, 4 * i + 3] }) }); T.n(`Finish time of processor ${i}?`, x + t[4 * i], 'Start + its longest task.'); best = Math.max(best, x + t[4 * i]); }); return best; }
  });

  D('apply-operations-on-array-to-maximize-sum-of-squares', {
    t: 'Maximize Sum of Squares: concentrate the bits',
    r: 'AND/OR operations only move bits between numbers; each bit count is preserved. Build k numbers greedily, each taking one of every remaining bit.',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, 1, 15), k: R.int(1, n) }; },
    s(I, T) { const c = Array(31).fill(0); I.nums.forEach(x => { for (let b = 0; b < 31; b++) if (x >> b & 1) c[b]++; }); T.at({ bitCounts: A(c.slice(0, 5)) }); let s = 0n; for (let r = 0; r < I.k; r++) { let v = 0; for (let b = 0; b < 31; b++) if (c[b]) { c[b]--; v += 2 ** b; } if (r < 4) T.n(`Value of built number ${r + 1}?`, v, 'One of each remaining bit.'); s = (s + BigInt(v) * BigInt(v)) % M; } return Number(s); }
  });

  D('minimum-number-of-groups-to-create-a-valid-assignment', {
    t: 'Minimum Groups for a Valid Assignment: try group sizes',
    r: 'Try group size s from the smallest count downward. Count c splits into ⌈c/(s+1)⌉ groups if that many groups of size s fit (⌈c/(s+1)⌉ · s ≤ c). The first workable s gives the answer.',
    g: R => ({ balls: R.ints(R.int(1, 10), 1, 3) }),
    s(I, T) { const f = [...cnt(I.balls).values()]; for (let s = Math.min(...f); s >= 1; s--) { const ok = f.every(c => Math.ceil(c / (s + 1)) * s <= c); T.at({ counts: A(f), size: s }); T.yn(`Does group size ${s} (or ${s + 1}) work?`, ok, 'Every count must split into sizes s and s + 1.'); if (ok) return f.reduce((a, c) => a + Math.ceil(c / (s + 1)), 0); } }
  });

  D('minimum-equal-sum-of-two-arrays-after-replacing-zeros', {
    t: 'Minimum Equal Sum After Replacing Zeros',
    r: 'Each zero becomes at least 1, so each side\'s minimum is sum + zeros. The answer is the larger minimum, unless the smaller side has no zeros to grow.',
    g: R => ({ nums1: R.ints(R.int(1, 5), 0, 4), nums2: R.ints(R.int(1, 5), 0, 4) }),
    s(I, T) { const f = a => [a.reduce((x, y) => x + y, 0), a.filter(x => !x).length]; const [s1, z1] = f(I.nums1), [s2, z2] = f(I.nums2); T.at({ nums1: A(I.nums1), nums2: A(I.nums2) }); T.n('Minimum possible sum of nums1?', s1 + z1, 'Zeros become 1.'); T.n('Minimum possible sum of nums2?', s2 + z2, 'Zeros become 1.'); if ((s1 + z1 < s2 + z2 && !z1) || (s2 + z2 < s1 + z1 && !z2)) return -1; return Math.max(s1 + z1, s2 + z2); }
  });

  D('maximum-xor-product', {
    t: 'Maximum XOR Product: balance the two numbers',
    r: 'For each of the low n bits from high to low: if a and b agree, make both 1. If they differ, give the 1 to the currently smaller number to keep them balanced.',
    g: R => ({ a: R.int(0, 31), b: R.int(0, 31), n: R.int(0, 5) }),
    s(I, T) { let a = BigInt(I.a), b = BigInt(I.b); for (let i = I.n - 1; i >= 0; i--) { const m = 1n << BigInt(i), x = (a & m) > 0n, y = (b & m) > 0n; if (x === y) { a |= m; b |= m; } else if (a > b) { a &= ~m; b |= m; } else { a |= m; b &= ~m; } T.at({ a: a.toString(2), b: b.toString(2), bit: i }); T.n(`a after bit ${i}?`, Number(a), x === y ? 'Agreeing bits: set both.' : 'Give the 1 to the smaller number.'); } return Number(a % M * (b % M) % M); }
  });

  D('minimum-number-of-coins-to-be-added', {
    t: 'Minimum Coins to Add: patch the gap at reach',
    r: 'Sort coins. While you can make all of [0, reach): use the next coin if it is ≤ reach, otherwise add a coin of value reach (doubling the range).',
    g: R => ({ coins: R.ints(R.int(1, 5), 1, 15), target: R.int(1, 20) }),
    s(I, T) { const c = sorted(I.coins); let reach = 1, i = 0, add = 0; while (reach <= I.target) { const use = i < c.length && c[i] <= reach; T.at({ coins: A(c, { hl: i < c.length ? [i] : [] }), reach }); T.yn(`Use the next existing coin to extend past ${reach - 1}?`, use, use ? `${c[i]} ≤ ${reach}.` : `Add a coin worth ${reach}.`); if (use) reach += c[i++]; else { reach += reach; add++; } } return add; }
  });

  D('divide-array-into-arrays-with-max-difference', {
    t: 'Divide Array Into Triples With Max Difference',
    r: 'Sort and cut into consecutive triples; if any triple spans more than k, it is impossible.',
    g: R => ({ nums: R.ints(3 * R.int(1, 3), 1, 9), k: R.int(1, 4) }),
    s(I, T) { const a = sorted(I.nums), out = []; for (let i = 0; i < a.length; i += 3) { const ok = a[i + 2] - a[i] <= I.k; T.at({ sorted: A(a, { win: [i, i + 2] }), k: I.k }); T.yn(`Is triple [${a.slice(i, i + 3)}] valid?`, ok, 'Span ≤ k.'); if (!ok) return []; out.push(a.slice(i, i + 3)); } return out; }
  });

  D('maximum-size-of-a-set-after-removals', {
    t: 'Maximum Set Size After Removals: unique first, then shared',
    r: 'Each array keeps n/2. Take values unique to nums1 (up to n/2) and unique to nums2 (up to n/2), then fill with shared values; cap at n.',
    g: R => { const n = 2 * R.int(1, 3); return { nums1: R.ints(n, 1, 5), nums2: R.ints(n, 1, 5) }; },
    s(I, T) { const a = new Set(I.nums1), b = new Set(I.nums2), n = I.nums1.length, com = [...a].filter(x => b.has(x)).length; const u1 = Math.min(n / 2, a.size - com), u2 = Math.min(n / 2, b.size - com); T.at({ set1: A([...a]), set2: A([...b]) }); T.n('Values in both sets?', com, 'Shared distinct values.'); T.n('Unique nums1 values kept?', u1, 'At most n/2.'); return Math.min(n, u1 + u2 + com); }
  });

  D('minimize-length-of-array-using-operations', {
    t: 'Minimize Length Using Modulo Operations: the smallest value rules',
    r: 'Let m be the minimum. If some x has x mod m ≠ 0, a smaller value appears and everything collapses to 1. Otherwise the copies of m pair up: ⌈count(m) / 2⌉.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 10) }),
    s(I, T) { const m = Math.min(...I.nums), c = I.nums.filter(x => x === m).length, rem = I.nums.some(x => x % m); T.at({ nums: A(I.nums), min: m }); T.yn('Does some value leave a non-zero remainder mod the minimum?', rem, 'That creates a new, unique minimum.'); return rem ? 1 : Math.ceil(c / 2); }
  });

  D('minimum-number-of-pushes-to-type-word-i', {
    t: 'Minimum Pushes to Type Word I: 8 keys per layer',
    r: 'All letters are distinct. The first 8 letters cost 1 push, the next 8 cost 2, then 3, then 4.',
    g: R => ({ word: R.distinct(R.int(1, 20), 0, 25).map(x => String.fromCharCode(97 + x)).join('') }),
    s(I, T) { const n = I.word.length; let t = 0; for (let i = 0; i < n; i++) t += Math.floor(i / 8) + 1; T.at({ word: I.word }); T.n('Letters that need 2 or more pushes?', Math.max(0, n - 8), 'Only 8 one-push slots.'); return t; }
  });

  D('minimum-number-of-pushes-to-type-word-ii', {
    t: 'Minimum Pushes to Type Word II: frequent letters first',
    r: 'Sort letter counts descending; the i-th letter costs ⌊i / 8⌋ + 1 pushes per use.',
    g: R => ({ word: R.str(R.int(1, 25), 'abcdefghijk') }),
    s(I, T) { const f = [...cnt([...I.word]).values()].sort((a, b) => b - a); let t = 0; f.forEach((c, i) => t += c * (Math.floor(i / 8) + 1)); T.at({ counts: A(f) }); T.n('Pushes for the most frequent letter?', f[0], 'It gets a one-push slot.'); return t; }
  });

  D('minimize-or-of-remaining-elements-using-operations', {
    t: 'Minimize OR With k Merges: decide bits from the top',
    r: 'Try to clear bits from high to low. With mask = bits we want zero, count merges needed so every segment AND has no mask bits (merge until the running AND & mask = 0). If more than k, the bit must stay in the answer.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 0, 15), k: R.int(0, n - 1) }; },
    s(I, T) { let res = 0, mask = 0; for (let b = 29; b >= 0; b--) { mask |= 1 << b; let cur = -1, ops = 0; for (const x of I.nums) { cur &= x; if (cur & mask) ops++; else cur = -1; } const keep = ops > I.k; if (b < 4) { T.at({ nums: A(I.nums), k: I.k, bit: b }); T.yn(`Must bit ${b} stay in the answer?`, keep, `Clearing it needs ${ops} merges.`); } if (keep) { res |= 1 << b; mask ^= 1 << b; } } return res; }
  });

  D('maximum-palindromes-after-operations', {
    t: 'Maximum Palindromes After Operations: shortest words first',
    r: 'Letters can move freely; only pairs matter (odd middles are always available). Count total pairs, then satisfy words in order of length, each needing ⌊len / 2⌋ pairs.',
    g: R => ({ words: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 4), 'abc')) }),
    s(I, T) { const c = cnt([...I.words.join('')]); let p = 0; for (const v of c.values()) p += v >> 1; T.at({ words: A(I.words) }); T.n('Total letter pairs?', p, 'Σ ⌊count / 2⌋.'); let r = 0; for (const L of sorted(I.words.map(w => w.length))) { if (L >> 1 > p) break; p -= L >> 1; r++; } return r; }
  });

  D('apple-redistribution-into-boxes', {
    t: 'Apple Redistribution Into Boxes: biggest boxes first',
    r: 'Total the apples, then use boxes from largest capacity down until they hold everything.',
    g: R => { const ap = R.ints(R.int(1, 4), 1, 6), s = ap.reduce((a, b) => a + b, 0), cap = R.ints(R.int(1, 5), 1, 8); while (cap.reduce((a, b) => a + b, 0) < s) cap.push(R.int(1, 8)); return { apple: ap, capacity: cap }; },
    s(I, T) { let need = I.apple.reduce((a, b) => a + b, 0), b = 0; const c = sorted(I.capacity).reverse(); T.at({ apple: A(I.apple), capacity: A(c) }); T.n('Total apples?', need, 'Sum of the packs.'); while (need > 0) need -= c[b++]; return b; }
  });

  D('maximize-happiness-of-selected-children', {
    t: 'Maximize Happiness: happiest first, minus the wait',
    r: 'Sort descending; the i-th pick (0-based) has lost i points: add max(0, h − i) for the first k.',
    g: R => { const n = R.int(1, 6); return { happiness: R.ints(n, 1, 8), k: R.int(1, n) }; },
    s(I, T) { const h = sorted(I.happiness).reverse(); let s = 0; for (let i = 0; i < I.k; i++) { const v = Math.max(0, h[i] - i); T.at({ sorted: A(h, { hl: [i] }), total: s }); T.n(`Happiness gained on pick ${i + 1}?`, v, `${h[i]} − ${i}, at least 0.`); s += v; } return s; }
  });

  D('minimum-deletions-to-make-string-k-special', {
    t: 'Make String k-Special: choose the lowest kept frequency',
    r: 'Try each frequency f as the minimum kept: letters below f are deleted entirely; letters above f + k are cut to f + k. Take the cheapest.',
    g: R => ({ word: R.str(R.int(1, 12), 'aaabbc'), k: R.int(0, 2) }),
    s(I, T) { const f = [...cnt([...I.word]).values()]; let best = Infinity; for (const b of [...new Set(f)].sort((x, y) => x - y)) { const d = f.reduce((a, x) => a + (x < b ? x : Math.max(0, x - b - I.k)), 0); T.at({ freqs: A(f), base: b, k: I.k }); T.n(`Deletions if the minimum kept frequency is ${b}?`, d, 'Drop smaller letters, trim larger ones.'); best = Math.min(best, d); } return best; }
  });

  D('make-string-anti-palindrome', {
    t: 'Make String Anti-Palindrome: sort, then fix the middle',
    r: 'Sort. Only the letter c straddling the middle can clash with its mirror. Swap each clashing c in the right half with the next larger letter after the run of c; if you run out, return "-1".',
    g: R => ({ s: R.str(2 * R.int(1, 4), 'aabc') }),
    s(I, T) { const s = [...I.s].sort(), n = s.length, m = n / 2; T.at({ sorted: A(s.slice()) }); T.yn('Do the two middle letters clash?', s[m - 1] === s[m], 'Only the middle run can cause a clash.'); if (s[m - 1] === s[m]) { const c = s[m]; let j = m; while (j < n && s[j] === c) j++; for (let k = m; k < n && s[k] === c && s[n - 1 - k] === c; k++) { if (j >= n) return '-1'; [s[k], s[j]] = [s[j], s[k]]; j++; } } for (let i = 0; i < n; i++) if (s[i] === s[n - 1 - i]) return '-1'; return s.join(''); }
  });

  D('apply-operations-to-make-sum-of-array-greater-than-or-equal-to-k', {
    t: 'Sum ≥ k With Increments and Duplicates',
    r: 'Increment the single 1 up to value a (a − 1 ops), then duplicate it ⌈k / a⌉ − 1 times. Try every a and take the minimum.',
    g: R => ({ k: R.int(1, 60) }),
    s(I, T) { let best = Infinity, ba = 1; for (let a = 1; a <= I.k; a++) { const o = a - 1 + Math.ceil(I.k / a) - 1; if (o < best) { best = o; ba = a; } } T.at({ k: I.k }); const a = Math.max(1, Math.round(Math.sqrt(I.k))); T.n(`Operations if you grow the value to ${a}?`, a - 1 + Math.ceil(I.k / a) - 1, `${a - 1} increments + ${Math.ceil(I.k / a) - 1} duplicates.`); return best; }
  });

  D('lexicographically-smallest-string-after-operations-with-constraint', {
    t: 'Smallest String With Distance Budget k',
    r: 'Left to right: each letter costs min(d, 26 − d) to become "a". If affordable, make it "a"; otherwise lower it by the remaining budget and stop.',
    g: R => ({ s: R.str(R.int(1, 6), 'abmxyz'), k: R.int(0, 20) }),
    s(I, T) { const s = [...I.s]; let k = I.k; for (let i = 0; i < s.length && k > 0; i++) { const d = s[i].charCodeAt(0) - 97, c = Math.min(d, 26 - d); T.at({ s: A(s, { hl: [i] }), budget: k }); T.n(`Cost to turn "${s[i]}" into "a"?`, c, 'Shorter way around.'); if (c <= k) { s[i] = 'a'; k -= c; } else { s[i] = String.fromCharCode(s[i].charCodeAt(0) - k); k = 0; } } return s.join(''); }
  });

  D('minimum-operations-to-make-median-of-array-equal-to-k', {
    t: 'Make the Median Equal to k',
    r: 'Sort. Move the median to k; values left of it above k must come down to k; values right of it below k must go up to k.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12), k: R.int(1, 12) }),
    s(I, T) { const a = sorted(I.nums), m = a.length >> 1; T.at({ sorted: A(a, { hl: [m] }), k: I.k }); T.n('Cost to move the median itself?', Math.abs(a[m] - I.k), `|${a[m]} − ${I.k}|.`); let ops = Math.abs(a[m] - I.k); for (let i = 0; i < m; i++) ops += Math.max(0, a[i] - I.k); for (let i = m + 1; i < a.length; i++) ops += Math.max(0, I.k - a[i]); return ops; }
  });

  D('minimum-rectangles-to-cover-points', {
    t: 'Minimum Rectangles to Cover Points: only x matters',
    r: 'Rectangles can be as tall as needed. Sort x; start a rectangle at the first uncovered x and cover through x + w.',
    g: R => ({ points: Array.from({ length: R.int(1, 6) }, () => [R.int(0, 10), R.int(0, 5)]), w: R.int(0, 3) }),
    s(I, T) { const xs = sorted(I.points.map(p => p[0])); let end = -Infinity, c = 0; xs.forEach((x, i) => { const nw = x > end; T.at({ xs: A(xs, { hl: [i] }), coveredTo: c ? end : '—' }); T.yn(`Does x = ${x} need a new rectangle?`, nw, 'Beyond the current one.'); if (nw) { c++; end = x + I.w; } }); return c; }
  });

  D('maximum-number-of-potholes-that-can-be-fixed', {
    t: 'Maximum Potholes Fixed: long runs are cheapest per pothole',
    r: 'Fixing L consecutive potholes costs L + 1. Sort pothole runs by length descending; fix whole runs while affordable, then fix budget − 1 from the next run.',
    g: R => ({ road: R.str(R.int(1, 12), 'x.x'), budget: R.int(1, 10) }),
    s(I, T) { const runs = (I.road.match(/x+/g) || []).map(r => r.length).sort((a, b) => b - a); let b = I.budget, f = 0; for (const L of runs) { if (b < 2) break; const take = Math.min(L, b - 1); T.at({ runs: A(runs), budget: b }); T.n(`Potholes fixed from the run of ${L}?`, take, 'Each repair costs length + 1.'); f += take; b -= take + 1; } return f; }
  });

  D('maximum-number-that-makes-result-of-bitwise-and-zero', {
    t: 'Maximum x With AND of [x, n] Zero',
    r: 'The range must cross below the highest bit of n: x = 2^(highest bit) − 1.',
    g: R => ({ n: R.int(1, 200) }),
    s(I, T) { let p = 1; while (p * 2 <= I.n) p *= 2; T.at({ n: I.n, binary: I.n.toString(2) }); T.n('Highest power of 2 ≤ n?', p, 'Its bit must be cleared by some number in the range.'); return p - 1; }
  });

  D('minimum-cost-to-equalize-array', {
    t: 'Minimum Cost to Equalize Array: try each target',
    r: 'For each target t from max to 2·max: total increments S, largest single gap g. If 2·cost1 ≤ cost2 use singles only. Otherwise pair as much as possible: if g ≤ S − g pair ⌊S/2⌋, else pair S − g and do the rest singly.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 8), cost1: R.int(1, 6), cost2: R.int(1, 6) }),
    s(I, T) { const mx = Math.max(...I.nums), mn = Math.min(...I.nums), n = I.nums.length; let best = Infinity; for (let t = mx; t <= 2 * mx + 1; t++) { const S = n * t - I.nums.reduce((a, b) => a + b, 0), g = t - mn; let c; if (2 * I.cost1 <= I.cost2) c = S * I.cost1; else if (g * 2 <= S) c = Math.floor(S / 2) * I.cost2 + (S % 2) * I.cost1; else c = (S - g) * I.cost2 + (2 * g - S) * I.cost1; if (t === mx) { T.at({ nums: A(I.nums), target: t }); T.n('Total increments needed to reach the max?', S, 'Σ (max − x).'); } best = Math.min(best, c); } return best % 1000000007; }
  });

  D('minimum-moves-to-get-a-peaceful-board', {
    t: 'Peaceful Board: rows and columns are independent',
    r: 'Each row and each column needs exactly one rook. Sort the x coordinates and send the i-th to row i; do the same for y.',
    g: R => { const n = R.int(1, 5), cells = new Set(), r = []; while (r.length < n) { const x = R.int(0, n - 1), y = R.int(0, n - 1); if (!cells.has(x * 9 + y)) { cells.add(x * 9 + y); r.push([x, y]); } } return { rooks: r }; },
    s(I, T) { const xs = sorted(I.rooks.map(r => r[0])), ys = sorted(I.rooks.map(r => r[1])); const mx = xs.reduce((a, x, i) => a + Math.abs(x - i), 0); T.at({ xs: A(xs), ys: A(ys) }); T.n('Row moves?', mx, 'Σ |sorted x − i|.'); return mx + ys.reduce((a, y, i) => a + Math.abs(y - i), 0); }
  });

  D('maximum-points-after-enemy-battles', {
    t: 'Maximum Points After Enemy Battles: farm the weakest',
    r: 'If you cannot beat the weakest enemy, 0. Otherwise absorb every other enemy\'s energy and keep beating the weakest: ⌊(energy + Σ − min) / min⌋.',
    g: R => ({ enemyEnergies: R.ints(R.int(1, 5), 1, 6), currentEnergy: R.int(0, 10) }),
    s(I, T) { const m = Math.min(...I.enemyEnergies), s = I.enemyEnergies.reduce((a, b) => a + b, 0); T.at({ enemies: A(I.enemyEnergies), energy: I.currentEnergy }); T.yn('Can you beat the weakest enemy right away?', I.currentEnergy >= m, `${I.currentEnergy} vs ${m}.`); return I.currentEnergy < m ? 0 : Math.floor((I.currentEnergy + s - m) / m); }
  });

  D('lexicographically-smallest-string-after-a-swap', {
    t: 'Smallest String After One Same-Parity Swap',
    r: 'Swap at the first adjacent pair with the same parity where the left digit is larger.',
    g: R => ({ s: R.str(R.int(2, 7), '0123456789') }),
    s(I, T) { const s = [...I.s]; for (let i = 0; i + 1 < s.length; i++) { const ok = s[i] % 2 === s[i + 1] % 2 && s[i] > s[i + 1]; T.at({ s: A(s, { hl: [i, i + 1] }) }); T.yn(`Swap positions ${i} and ${i + 1}?`, ok, 'Same parity and out of order.'); if (ok) { [s[i], s[i + 1]] = [s[i + 1], s[i]]; break; } } return s.join(''); }
  });

  D('minimum-cost-for-cutting-cake-ii', {
    t: 'Cutting Cake II: expensive cuts first',
    r: 'A cut is repeated once per piece across it. Make the most expensive cuts while there are few pieces: merge both lists descending; a horizontal cut costs h × (vertical pieces), and vice versa.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { m, n, horizontalCut: R.ints(m - 1, 1, 9), verticalCut: R.ints(n - 1, 1, 9) }; },
    s(I, T) { const h = sorted(I.horizontalCut).reverse(), v = sorted(I.verticalCut).reverse(); let i = 0, j = 0, hp = 1, vp = 1, t = 0; while (i < h.length || j < v.length) { const useH = j >= v.length || (i < h.length && h[i] >= v[j]); const c = useH ? h[i] * vp : v[j] * hp; T.at({ horizontal: A(h, { dim: [...Array(i).keys()] }), vertical: A(v, { dim: [...Array(j).keys()] }), total: t }); T.n(`Cost of the next cut (${useH ? 'horizontal ' + h[i] : 'vertical ' + v[j]})?`, c, 'Cost × pieces it crosses.'); t += c; if (useH) { i++; hp++; } else { j++; vp++; } } return t; }
  });

  D('find-the-winning-player-in-coin-game', {
    t: 'Winning Player in Coin Game: count the turns',
    r: 'Each turn uses one 75 and four 10s. The number of turns is min(x, ⌊y / 4⌋); Alice wins if it is odd.',
    g: R => ({ x: R.int(1, 10), y: R.int(1, 30) }),
    s(I, T) { const t = Math.min(I.x, Math.floor(I.y / 4)); T.at({ x: I.x, y: I.y }); T.n('Total turns played?', t, 'min(x, ⌊y/4⌋).'); return t % 2 ? 'Alice' : 'Bob'; }
  });

  D('vowels-game-in-a-string', {
    t: 'Vowels Game in a String: any vowel wins',
    r: 'With an odd number of vowels Alice takes everything; with an even non-zero count she leaves exactly one and Bob is stuck. With no vowels she cannot move.',
    g: R => ({ s: R.str(R.int(1, 8), 'bcdaeo') }),
    s(I, T) { const v = [...I.s].filter(c => 'aeiou'.includes(c)).length; T.at({ s: I.s }); T.n('Number of vowels?', v, 'Alice wins iff it is non-zero.'); return v > 0; }
  });

  D('maximum-number-of-operations-to-move-ones-to-the-end', {
    t: 'Move Ones to the End: count ones before each gap',
    r: 'Every time a block of 1s is followed by a 0, each 1 seen so far will make one move across that gap: add the running count of ones.',
    g: R => ({ s: R.str(R.int(1, 10), '01') }),
    s(I, T) { let ones = 0, ans = 0; [...I.s].forEach((c, i) => { if (c === '1') ones++; else if (i && I.s[i - 1] === '1') { ans += ones; T.at({ s: A([...I.s], { hl: [i] }), ones }); T.n('Operations so far?', ans, 'Each 1 so far crosses this gap.'); } }); return ans; }
  });

  D('minimum-amount-of-damage-dealt-to-bob', {
    t: 'Minimum Damage to Bob: exchange argument',
    r: 'Enemy i needs t_i = ⌈health / power⌉ seconds. Kill i before j when damage_i · t_j > damage_j · t_i. Each enemy deals damage × (its finish time).',
    g: R => { const n = R.int(1, 4); return { power: R.int(1, 4), damage: R.ints(n, 1, 6), health: R.ints(n, 1, 9) }; },
    s(I, T) { const t = I.health.map(h => Math.ceil(h / I.power)), o = t.map((_, i) => i).sort((a, b) => I.damage[b] * t[a] - I.damage[a] * t[b]); let time = 0, tot = 0; for (const i of o) { time += t[i]; T.at({ order: A(o), time }); T.n(`Damage dealt by enemy ${i}?`, I.damage[i] * time, 'Damage × its death time.'); tot += I.damage[i] * time; } return tot; }
  });

  D('reach-end-of-array-with-max-score', {
    t: 'Reach End With Max Score: jump to bigger values',
    r: 'Each step of distance pays the value you jumped from. Stay on the best value seen so far: the answer is Σ over i < n − 1 of the running maximum.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { let m = 0, s = 0; for (let i = 0; i + 1 < I.nums.length; i++) { m = Math.max(m, I.nums[i]); s += m; T.at({ nums: A(I.nums, { hl: [i] }), best: m }); T.n(`Score after step ${i}→${i + 1}?`, s, 'Add the running max.'); } return s; }
  });

  D('maximize-the-total-height-of-unique-towers', {
    t: 'Maximize Total Height of Unique Towers',
    r: 'Sort descending; each tower gets min(its max, previous height − 1). If a height drops to 0, it is impossible.',
    g: R => ({ maximumHeight: R.ints(R.int(1, 6), 1, 8) }),
    s(I, T) { const a = sorted(I.maximumHeight).reverse(); let prev = Infinity, s = 0; for (let i = 0; i < a.length; i++) { const h = Math.min(a[i], prev - 1); T.at({ sorted: A(a, { hl: [i] }) }); T.n(`Height of tower ${i} (0 if impossible)?`, Math.max(h, 0), 'min(max, previous − 1).'); if (h <= 0) return -1; s += h; prev = h; } return s; }
  });

  D('minimum-division-operations-to-make-array-non-decreasing', {
    t: 'Division Operations to Be Non-Decreasing',
    r: 'Dividing by the greatest proper divisor leaves the smallest prime factor. From the right, if nums[i] > nums[i + 1], replace it with its smallest prime factor; if still too big, −1.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 30) }),
    s(I, T) { const a = I.nums.slice(), spf = x => { for (let p = 2; p * p <= x; p++) if (x % p === 0) return p; return x; }; let ops = 0; for (let i = a.length - 2; i >= 0; i--) if (a[i] > a[i + 1]) { const p = spf(a[i]); T.at({ nums: A(a, { hl: [i, i + 1] }) }); T.n(`${a[i]} becomes?`, p, 'Its smallest prime factor.'); if (p > a[i + 1]) return -1; a[i] = p; ops++; } return ops; }
  });

  D('maximum-number-of-distinct-elements-after-operations', {
    t: 'Maximum Distinct Elements After ±k',
    r: 'Sort. Give each element the smallest value ≥ previous + 1 within [x − k, x + k]; if none, it duplicates something.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6), k: R.int(0, 2) }),
    s(I, T) { let prev = -Infinity, c = 0; for (const x of sorted(I.nums)) { const v = Math.max(prev + 1, x - I.k), ok = v <= x + I.k; T.at({ sorted: A(sorted(I.nums)), prev: prev === -Infinity ? '—' : prev }); T.yn(`Can ${x} get a new distinct value?`, ok, `Smallest free is ${v}, limit ${x + I.k}.`); if (ok) { c++; prev = v; } } return c; }
  });

  D('minimum-cost-to-make-arrays-identical', {
    t: 'Minimum Cost to Make Arrays Identical: rearrange or not',
    r: 'Without rearranging: Σ |arr − brr|. With one rearrange (cost k), sort both and pair: k + Σ |sorted differences|. Take the smaller.',
    g: R => { const n = R.int(1, 5); return { arr: R.ints(n, -9, 9), brr: R.ints(n, -9, 9), k: R.int(0, 10) }; },
    s(I, T) { const a = I.arr.reduce((s, x, i) => s + Math.abs(x - I.brr[i]), 0), sa = sorted(I.arr), sb = sorted(I.brr), b = I.k + sa.reduce((s, x, i) => s + Math.abs(x - sb[i]), 0); T.at({ arr: A(I.arr), brr: A(I.brr), k: I.k }); T.n('Cost without rearranging?', a, 'Σ |differences|.'); T.n('Cost with one rearrangement?', b, 'k + sorted pairing.'); return Math.min(a, b); }
  });

  D('reschedule-meetings-for-maximum-free-time-ii', {
    t: 'Reschedule Meetings II: move one meeting anywhere',
    r: 'Gaps g0 … gn surround the meetings. Removing meeting i merges gaps i and i+1 (+ its length if it fits into some other gap not touching it; otherwise just the two gaps).',
    g: R => { const n = R.int(2, 4), st = [], en = []; let t = R.int(0, 2); for (let i = 0; i < n; i++) { st.push(t); t += R.int(1, 3); en.push(t); t += R.int(0, 3); } return { eventTime: t + R.int(0, 2), startTime: st, endTime: en }; },
    s(I, T) { const n = I.startTime.length, g = [I.startTime[0]]; for (let i = 1; i < n; i++) g.push(I.startTime[i] - I.endTime[i - 1]); g.push(I.eventTime - I.endTime[n - 1]); const pre = [], suf = Array(n + 2).fill(0); g.forEach((x, i) => pre.push(Math.max(x, i ? pre[i - 1] : 0))); for (let i = n; i >= 0; i--) suf[i] = Math.max(g[i], suf[i + 1]); let best = 0; for (let i = 0; i < n; i++) { const L = I.endTime[i] - I.startTime[i], fits = (i > 0 && pre[i - 1] >= L) || suf[i + 2] >= L; const v = g[i] + g[i + 1] + (fits ? L : 0); T.at({ gaps: A(g, { hl: [i, i + 1] }), length: L }); T.yn(`Can meeting ${i} move into another gap?`, fits, 'Some non-adjacent gap ≥ its length.'); best = Math.max(best, v); } return best; }
  });

  D('eat-pizzas', {
    t: 'Eat Pizzas: biggest on odd days, then second-biggest',
    r: 'Sort. Odd days (⌈days/2⌉ of them) each gain one of the largest pizzas. Even days gain the second largest of their four: take every other pizza going down from the rest.',
    g: R => ({ pizzas: R.ints(4 * R.int(1, 3), 1, 9) }),
    s(I, T) { const a = sorted(I.pizzas), n = a.length, d = n / 4, odd = Math.ceil(d / 2); let s = 0; for (let i = 0; i < odd; i++) s += a[n - 1 - i]; T.at({ sorted: A(a) }); T.n('Weight gained on odd days?', s, `The ${odd} largest pizzas.`); let idx = n - odd - 2; for (let e = 0; e < d - odd; e++) { s += a[idx]; idx -= 2; } return s; }
  });

  D('lexicographically-smallest-generated-string', {
    t: 'Smallest Generated String: place T windows, then fix F windows',
    r: 'Write str2 at every T window (conflict → ""). Fill free cells with "a". For each F window still equal to str2, change its rightmost free cell to "b"; with no free cell, return "".',
    g: R => ({ str1: R.str(R.int(1, 5), 'TFF'), str2: R.str(R.int(1, 3), 'ab') }),
    s(I, T) { const n = I.str1.length, m = I.str2.length, w = Array(n + m - 1).fill(null), fixed = Array(n + m - 1).fill(false); for (let i = 0; i < n; i++) if (I.str1[i] === 'T') for (let j = 0; j < m; j++) { if (w[i + j] !== null && w[i + j] !== I.str2[j]) return ''; w[i + j] = I.str2[j]; fixed[i + j] = true; } for (let i = 0; i < w.length; i++) if (w[i] === null) w[i] = 'a'; T.at({ word: A(w.slice()) }); T.n('Cells locked by T windows?', fixed.filter(Boolean).length, 'Union of all T windows.'); for (let i = 0; i < n; i++) if (I.str1[i] === 'F' && w.slice(i, i + m).join('') === I.str2) { let j = i + m - 1; while (j >= i && fixed[j]) j--; if (j < i) return ''; w[j] = 'b'; fixed[j] = true; } return w.join(''); }
  });
})();
