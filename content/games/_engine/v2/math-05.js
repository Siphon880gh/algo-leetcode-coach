/* v2 games: math (05). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const M = 1000000007n, MOD = 1e9 + 7;
  const pw = (b, e) => { let r = 1n; b = BigInt(b) % M; e = BigInt(e); while (e > 0n) { if (e & 1n) r = r * b % M; b = b * b % M; e >>= 1n; } return r; };
  const fact = n => { let r = 1n; for (let i = 2n; i <= BigInt(n); i++) r = r * i % M; return r; };
  const binom = (n, k) => k < 0 || k > n ? 0n : fact(n) * pw(fact(k), M - 2n) % M * pw(fact(n - k), M - 2n) % M;
  const rev = x => +[...String(x)].reverse().join('');
  const isPrime = n => { if (n < 2) return false; for (let d = 2; d * d <= n; d++) if (n % d === 0) return false; return true; };
  const MD = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

  D('find-missing-observations', {
    t: 'Find Missing Observations: spread the missing total',
    r: 'Missing total = mean·(n + m) − Σ rolls. It must lie in [n, 6n]. Give every missing roll ⌊total/n⌋ and add 1 to the first (total mod n) of them.',
    g: R => { const rolls = R.ints(R.int(1, 4), 1, 6), n = R.int(1, 4); return { rolls, mean: R.int(1, 6), n }; },
    cmp: (out, exp, I) => { if (!exp.length) return Array.isArray(out) && !out.length; return out.length === I.n && out.every(v => v >= 1 && v <= 6) && out.reduce((a, b) => a + b, 0) + I.rolls.reduce((a, b) => a + b, 0) === I.mean * (I.n + I.rolls.length); },
    s(I, T) { const tot = I.mean * (I.n + I.rolls.length) - I.rolls.reduce((a, b) => a + b, 0); T.at({ rolls: A(I.rolls), mean: I.mean, missing: I.n }); T.n('Total of the missing rolls?', tot, 'mean·(n + m) − Σ rolls.'); T.yn(`Is it between ${I.n} and ${6 * I.n}?`, tot >= I.n && tot <= 6 * I.n, 'Each die shows 1 to 6.'); if (tot < I.n || tot > 6 * I.n) return []; const b = Math.floor(tot / I.n); return Array.from({ length: I.n }, (_, i) => b + (i < tot % I.n ? 1 : 0)); }
  });

  D('minimum-operations-to-make-a-uni-value-grid', {
    t: 'Uni-Value Grid: same remainder, then the median',
    r: 'Every value must share the same remainder mod x, or it is impossible. Then flatten, sort, and move everything to the median: Σ |v − median| / x.',
    g: R => { const x = R.int(1, 3), r = R.int(0, x - 1), m = R.int(1, 3), n = R.int(1, 3); return { grid: Array.from({ length: m }, () => Array.from({ length: n }, () => r + x * R.int(0, 5) + (R.chance(0.1) ? 1 : 0))), x }; },
    s(I, T) { const v = I.grid.flat().sort((a, b) => a - b), r = v[0] % I.x; const ok = v.every(a => a % I.x === r); T.at({ values: A(v), x: I.x }); T.yn(`Do all values have the same remainder mod ${I.x}?`, ok, 'Steps of x never change the remainder.'); if (!ok) return -1; const med = v[v.length >> 1]; T.n('Median?', med, 'Middle of the sorted values.'); return v.reduce((s, a) => s + Math.abs(a - med) / I.x, 0); }
  });

  D('vowels-of-all-substrings', {
    t: 'Vowels of All Substrings: count substrings through each vowel',
    r: 'A vowel at index i lies in (i + 1)·(n − i) substrings (choices of start × choices of end). Sum over the vowels.',
    g: R => ({ word: R.str(R.int(2, 7), 'abeiu') }),
    s(I, T) { const n = I.word.length; let t = 0; [...I.word].forEach((c, i) => { if (!'aeiou'.includes(c)) return; T.at({ word: A([...I.word], { hl: [i] }), total: t }); T.n(`Substrings containing index ${i}?`, (i + 1) * (n - i), `${i + 1} starts × ${n - i} ends.`); t += (i + 1) * (n - i); }); return t; }
  });

  D('substrings-that-begin-and-end-with-the-same-letter', {
    t: 'Substrings Beginning and Ending With the Same Letter',
    r: 'Scan left to right: the letter at i closes one substring with every earlier copy, plus itself. Add count[c] + 1, then increment count[c].',
    g: R => ({ s: R.str(R.int(2, 7), 'abc') }),
    s(I, T) { const c = {}; let t = 0; [...I.s].forEach((ch, i) => { T.at({ s: A([...I.s], { hl: [i] }), counts: K(c) }); T.n(`Substrings ending at index ${i} that start with "${ch}"?`, (c[ch] || 0) + 1, 'Earlier copies, plus the single letter.'); c[ch] = (c[ch] || 0) + 1; t += c[ch]; }); return t; }
  });

  D('elements-in-array-after-removing-and-replacing-elements', {
    t: 'Elements After Removing and Replacing: period 2n',
    r: 'The process repeats every 2n minutes. With t = time mod 2n: if t < n, the first t elements are gone (index i shows nums[i + t] if i < n − t); otherwise t − n elements are back (index i shows nums[i] if i < t − n). Else −1.',
    g: R => { const nums = R.ints(R.int(1, 4), 0, 9); return { nums, queries: Array.from({ length: R.int(1, 4) }, () => [R.int(0, 12), R.int(0, nums.length - 1)]) }; },
    s(I, T) { const n = I.nums.length; return I.queries.map(([time, i]) => { const t = time % (2 * n), v = t < n ? (i < n - t ? I.nums[i + t] : -1) : (i < t - n ? I.nums[i] : -1); T.at({ nums: A(I.nums), time, index: i }); T.n(`time mod ${2 * n}?`, t, 'The cycle length is 2n.'); return v; }); }
  });

  D('number-of-ways-to-divide-a-long-corridor', {
    t: 'Divide a Long Corridor: divider choices between seat pairs',
    r: 'Seats must split into pairs, so the count must be even and positive. Between the 2nd seat of one pair and the 1st seat of the next there are (plants + 1) places for the divider; multiply them.',
    g: R => ({ corridor: R.str(R.int(3, 9), 'SSP') }),
    s(I, T) { const pos = []; [...I.corridor].forEach((c, i) => c === 'S' && pos.push(i)); T.at({ corridor: A([...I.corridor]) }); T.n('How many seats?', pos.length, 'Must be even and at least 2.'); if (!pos.length || pos.length % 2) return 0; let r = 1; for (let k = 2; k < pos.length; k += 2) { const g = pos[k] - pos[k - 1]; T.at({ corridor: A([...I.corridor], { hl: [pos[k - 1], pos[k]] }) }); T.n(`Divider positions between seat ${k} and seat ${k + 1}?`, g, 'Plants between them + 1.'); r = r * g % MOD; } return r; }
  });

  D('minimum-cost-to-set-cooking-time', {
    t: 'Minimum Cost to Set Cooking Time: two ways to write the time',
    r: 'targetSeconds is m·60 + s with s < 60, or (m − 1)·60 + (s + 60) when s + 60 ≤ 99. Each valid (m ≤ 99) pair is pushed as digits without leading zeros: moving the finger costs moveCost, each push costs pushCost.',
    g: R => ({ startAt: R.int(0, 9), moveCost: R.int(1, 4), pushCost: R.int(1, 4), targetSeconds: R.int(1, 6039) }),
    s(I, T) { const cost = (m, s) => { const d = (String(m).padStart(2, '0') + String(s).padStart(2, '0')).replace(/^0+/, ''); let cur = I.startAt, c = 0; for (const ch of d) { if (+ch !== cur) { c += I.moveCost; cur = +ch; } c += I.pushCost; } return c; }; const m = Math.floor(I.targetSeconds / 60), s = I.targetSeconds % 60; let best = Infinity; if (m <= 99) { const c = cost(m, s); T.at({ target: I.targetSeconds, start: I.startAt, move: I.moveCost, push: I.pushCost }); T.n(`Cost to enter ${m} min ${s} s?`, c, 'Strip leading zeros; pay moves and pushes.'); best = c; } if (m >= 1 && s + 60 <= 99) { const c = cost(m - 1, s + 60); T.at({ target: I.targetSeconds }); T.n(`Cost to enter ${m - 1} min ${s + 60} s?`, c, 'The alternative with 60+ seconds.'); best = Math.min(best, c); } return best; }
  });

  D('smallest-value-of-the-rearranged-number', {
    t: 'Smallest Rearranged Number: sort, but no leading zero',
    r: 'Negative: sort digits descending (most negative). Positive: sort ascending, then swap the first non-zero digit to the front.',
    g: R => ({ num: R.pick([-1, 1]) * R.int(0, 99999) }),
    s(I, T) { const neg = I.num < 0, d = [...String(Math.abs(I.num))].sort(); if (neg) { d.reverse(); T.at({ num: I.num }); T.n('Leading digit after sorting descending?', +d[0], 'The largest digit first makes the most negative value.'); return -+d.join(''); } const i = d.findIndex(c => c !== '0'); if (i > 0) [d[0], d[i]] = [d[i], d[0]]; T.at({ num: I.num }); T.n('Leading digit?', +d[0], 'The smallest non-zero digit.'); return +d.join(''); }
  });

  D('count-operations-to-obtain-zero', {
    t: 'Count Operations to Obtain Zero: subtract in bulk',
    r: 'This is Euclid with subtraction. Each phase does ⌊a / b⌋ subtractions at once, then continue with (b, a mod b) until one is 0.',
    g: R => ({ num1: R.int(0, 40), num2: R.int(0, 40) }),
    s(I, T) { let a = Math.max(I.num1, I.num2), b = Math.min(I.num1, I.num2), c = 0; while (b) { T.at({ larger: a, smaller: b, ops: c }); T.n(`Subtractions of ${b} from ${a} in this phase?`, Math.floor(a / b), `⌊${a} / ${b}⌋.`); c += Math.floor(a / b); [a, b] = [b, a % b]; } return c; }
  });

  D('count-integers-with-even-digit-sum', {
    t: 'Count Integers With Even Digit Sum',
    r: 'num ≤ 1000, so check every x from 1 to num: add its digits and count the even sums. (Shortcut: about half of them, adjusted by num\'s own digit sum.)',
    g: R => ({ num: R.int(1, 40) }),
    s(I, T) { let c = 0; for (let x = Math.max(1, I.num - 5); x <= I.num; x++) { const e = [...String(x)].reduce((a, d) => a + +d, 0) % 2 === 0; T.at({ x }); T.yn(`Is the digit sum of ${x} even?`, e, 'Add its digits.'); } for (let x = 1; x <= I.num; x++) if ([...String(x)].reduce((a, d) => a + +d, 0) % 2 === 0) c++; return c; }
  });

  D('count-array-pairs-divisible-by-k', {
    t: 'Count Array Pairs Divisible by K: gcd buckets',
    r: 'Only gcd(x, k) matters. Count numbers per gcd value g; two buckets g1, g2 pair up when g1·g2 is divisible by k (same bucket: C(c, 2)).',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 12), k: R.int(1, 8) }),
    s(I, T) { const c = {}; I.nums.forEach(x => { const g = gcd(x, I.k); c[g] = (c[g] || 0) + 1; }); const ks = Object.keys(c).map(Number); let t = 0; T.at({ nums: A(I.nums), k: I.k }); T.n('How many different gcd(x, k) values?', ks.length, 'Bucket by gcd.'); for (let i = 0; i < ks.length; i++) for (let j = i; j < ks.length; j++) if (ks[i] * ks[j] % I.k === 0) { const v = i === j ? c[ks[i]] * (c[ks[i]] - 1) / 2 : c[ks[i]] * c[ks[j]]; T.at({ buckets: K(c), k: I.k }); T.n(`Pairs from buckets ${ks[i]} and ${ks[j]}?`, v, i === j ? 'C(count, 2).' : 'count × count.'); t += v; } return t; }
  });

  D('number-of-single-divisor-triplets', {
    t: 'Single Divisor Triplets: work on values',
    r: 'Values are ≤ 100, so loop over value triples with multiplicities. A triple counts when exactly one of the three divides the sum; ordered index triples multiply the counts (permutations included).',
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 7) }),
    s(I, T) { const a = I.nums, n = a.length; let t = 0; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) for (let k = j + 1; k < n; k++) { const s = a[i] + a[j] + a[k], d = [a[i], a[j], a[k]].filter(x => s % x === 0).length; T.at({ nums: A(a, { hl: [i, j, k] }), sum: s }); T.n(`How many of ${a[i]}, ${a[j]}, ${a[k]} divide ${s}?`, d, 'Exactly one makes it a single divisor triplet.'); if (d === 1) t += 6; } return t; }
  });

  D('find-palindrome-with-fixed-length', {
    t: 'Palindrome With Fixed Length: the q-th first half',
    r: 'A palindrome of length L is fixed by its first h = ⌈L/2⌉ digits, which run from 10^(h−1). The q-th is half = 10^(h−1) + q − 1 (−1 if it has more than h digits), mirrored.',
    g: R => ({ queries: R.ints(R.int(1, 4), 1, 95), intLength: R.int(1, 5) }),
    s(I, T) { const L = I.intLength, h = Math.ceil(L / 2), st = 10 ** (h - 1); return I.queries.map(q => { const half = st + q - 1; T.at({ length: L, query: q }); T.n('First half of the answer (before checking it fits)?', half, `10^${h - 1} + ${q} − 1.`); if (half >= 10 ** h) return -1; const s = String(half); return +(s + [...s.slice(0, L - h)].reverse().join('')); }); }
  });

  D('find-triangular-sum-of-an-array', {
    t: 'Find Triangular Sum: add neighbors mod 10',
    r: 'Replace the array by (a[i] + a[i+1]) mod 10 until one value is left. (Closed form: Σ C(n−1, i)·a[i] mod 10.)',
    g: R => ({ nums: R.ints(R.int(1, 5), 0, 9) }),
    s(I, T) { let a = I.nums.slice(); while (a.length > 1) { const b = a.slice(1).map((v, i) => (a[i] + v) % 10); T.at({ row: A(a) }); T.n('First value of the next row?', b[0], `(${a[0]} + ${a[1]}) mod 10.`); a = b; } return a[0]; }
  });

  D('number-of-ways-to-buy-pens-and-pencils', {
    t: 'Ways to Buy Pens and Pencils: loop over pens',
    r: 'For each number of pens i, the leftover money buys 0 … ⌊(total − i·cost1) / cost2⌋ pencils. Add those counts.',
    g: R => ({ total: R.int(1, 30), cost1: R.int(1, 10), cost2: R.int(1, 10) }),
    s(I, T) { let t = 0; for (let i = 0; i * I.cost1 <= I.total; i++) { const w = Math.floor((I.total - i * I.cost1) / I.cost2) + 1; T.at({ total: I.total, pens: i, pencilCost: I.cost2 }); T.n(`Ways with ${i} pen(s)?`, w, 'Pencil counts 0 … ⌊rest / cost2⌋.'); t += w; } return t; }
  });

  D('count-lattice-points-inside-a-circle', {
    t: 'Count Lattice Points Inside Circles: union of point sets',
    r: 'For each circle, scan its bounding square and add every (x, y) with dx² + dy² ≤ r² to one set. The answer is the set size.',
    g: R => ({ circles: Array.from({ length: R.int(1, 3) }, () => { const r = R.int(1, 2); return [R.int(r, 5), R.int(r, 5), r]; }) }),
    s(I, T) { const S = new Set(); for (const [x, y, r] of I.circles) { let c = 0; for (let a = x - r; a <= x + r; a++) for (let b = y - r; b <= y + r; b++) if ((a - x) ** 2 + (b - y) ** 2 <= r * r) { c++; S.add(a + ',' + b); } T.at({ circle: `(${x},${y}) r ${r}`, union: S.size }); T.n(`Lattice points in this circle alone?`, c, 'Check every point in its bounding square.'); } return S.size; }
  });

  D('minimum-lines-to-represent-a-line-chart', {
    t: 'Minimum Lines for a Line Chart: count slope changes',
    r: 'Sort by day. A new line starts whenever the slope changes; compare slopes exactly with cross-multiplication (dy1·dx2 vs dy2·dx1), no floating point.',
    g: R => { const n = R.int(1, 6), days = R.distinct(n, 1, 10).sort((a, b) => a - b); let p = R.int(1, 5); const out = days.map(d => [d, p += R.int(-2, 2)]); return { stockPrices: R.shuffle(out) }; },
    s(I, T) { const p = I.stockPrices.slice().sort((a, b) => a[0] - b[0]); if (p.length < 2) return 0; let lines = 1; for (let i = 2; i < p.length; i++) { const same = BigInt(p[i - 1][1] - p[i - 2][1]) * BigInt(p[i][0] - p[i - 1][0]) === BigInt(p[i][1] - p[i - 1][1]) * BigInt(p[i - 1][0] - p[i - 2][0]); T.at({ points: A(p.map(q => `(${q})`), { hl: [i - 2, i - 1, i] }), lines }); T.yn(`Does the line bend at (${p[i - 1]})?`, !same, 'Compare the two slopes by cross-multiplying.'); if (!same) lines++; } return lines; }
  });

  D('number-of-zero-filled-subarrays', {
    t: 'Number of Zero-Filled Subarrays: count as you extend',
    r: 'Track the length of the current run of zeros; each zero ends run-length new zero-filled subarrays.',
    g: R => ({ nums: R.ints(R.int(3, 9), 0, 2).map(x => x === 2 ? 0 : x) }),
    s(I, T) { let run = 0, t = 0; I.nums.forEach((x, i) => { run = x === 0 ? run + 1 : 0; if (x === 0) { T.at({ nums: A(I.nums, { hl: [i] }), total: t }); T.n(`Zero-filled subarrays ending at index ${i}?`, run, 'The current run length.'); } t += run; }); return t; }
  });

  D('count-number-of-bad-pairs', {
    t: 'Count Bad Pairs: total minus good',
    r: 'A good pair has nums[i] − i = nums[j] − j. Count good pairs with a hash map of that key; bad = C(n, 2) − good.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 6) }),
    s(I, T) { const c = {}; let good = 0; I.nums.forEach((x, i) => { const k = x - i; T.at({ nums: A(I.nums, { hl: [i] }), keys: K(c) }); T.n(`Good pairs ending at index ${i} (key ${k})?`, c[k] || 0, 'Earlier indices with the same nums[i] − i.'); good += c[k] || 0; c[k] = (c[k] || 0) + 1; }); const n = I.nums.length; return n * (n - 1) / 2 - good; }
  });

  D('count-days-spent-together', {
    t: 'Count Days Spent Together: overlap of day-of-year ranges',
    r: 'Convert each "MM-DD" to a day of the (non-leap) year. Overlap = max(0, min(leaves) − max(arrivals) + 1).',
    g: R => { const d = () => { const m = R.int(1, 12); return `${String(m).padStart(2, '0')}-${String(R.int(1, MD[m - 1])).padStart(2, '0')}`; }; const s = [d(), d()].sort(), t = [d(), d()].sort(); return { arriveAlice: s[0], leaveAlice: s[1], arriveBob: t[0], leaveBob: t[1] }; },
    s(I, T) { const f = s => { const [m, d] = s.split('-').map(Number); return MD.slice(0, m - 1).reduce((a, b) => a + b, 0) + d; }; const st = Math.max(f(I.arriveAlice), f(I.arriveBob)), en = Math.min(f(I.leaveAlice), f(I.leaveBob)); T.at({ alice: `${I.arriveAlice} → ${I.leaveAlice}`, bob: `${I.arriveBob} → ${I.leaveBob}` }); T.n('Later arrival as day of year?', st, 'Sum earlier months + day.'); T.n('Earlier departure as day of year?', en, 'Sum earlier months + day.'); return Math.max(0, en - st + 1); }
  });

  D('closest-fair-integer', {
    t: 'Closest Fair Integer: odd lengths jump ahead',
    r: 'A fair number has an even digit count. If n has an odd number of digits L, jump to the smallest fair number with L + 1 digits: 1 then zeros then ones (10…0011…1). Otherwise scan upward.',
    g: R => ({ n: R.pick([R.int(1, 9), R.int(10, 99), R.int(100, 999), R.int(1000, 1300)]) }),
    s(I, T) { const fair = x => { const s = String(x); if (s.length % 2) return false; const e = [...s].filter(c => +c % 2 === 0).length; return 2 * e === s.length; }; const L = String(I.n).length; T.at({ n: I.n }); T.yn('Does n have an odd number of digits?', L % 2 === 1, 'Then no fair number of that length exists.'); if (L % 2) { const h = (L + 1) / 2; return +('1' + '0'.repeat(h) + '1'.repeat(h - 1)); } let x = I.n; while (!fair(x)) x++; T.n('How many numbers were skipped?', x - I.n, 'Scan upward to the first fair number.'); return x; }
  });

  D('number-of-common-factors', {
    t: 'Number of Common Factors: divisors of the gcd',
    r: 'Common factors are exactly the divisors of gcd(a, b). Count them up to √g in pairs.',
    g: R => ({ a: R.int(1, 60), b: R.int(1, 60) }),
    s(I, T) { const g = gcd(I.a, I.b); T.at({ a: I.a, b: I.b }); T.n('gcd(a, b)?', g, 'Euclid.'); let c = 0; for (let d = 1; d * d <= g; d++) if (g % d === 0) c += d * d === g ? 1 : 2; return c; }
  });

  D('count-number-of-distinct-integers-after-reverse-operations', {
    t: 'Distinct Integers After Reversing: one set',
    r: 'Put every number and its digit reversal into one set; the answer is its size.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 40) }),
    s(I, T) { const S = new Set(); I.nums.forEach((x, i) => { S.add(x); S.add(rev(x)); T.at({ nums: A(I.nums, { hl: [i] }) }); T.n(`Distinct values after adding ${x} and ${rev(x)}?`, S.size, 'Set size.'); }); return S.size; }
  });

  D('sum-of-number-and-its-reverse', {
    t: 'Sum of a Number and Its Reverse: try every k ≤ num',
    r: 'num ≤ 10^5, so try every k from 0 to num and check k + rev(k) = num.',
    g: R => ({ num: R.pick([R.int(0, 200), 443, 63, 181]) }),
    s(I, T) { let f = -1; for (let k = 0; k <= I.num; k++) if (k + rev(k) === I.num) { f = k; break; } T.at({ num: I.num }); T.n('Smallest k with k + rev(k) = num (−1 if none)?', f, 'Try each k.'); return f >= 0; }
  });

  D('number-of-subarrays-with-gcd-equal-to-k', {
    t: 'Subarrays With GCD Equal to K: extend from each start',
    r: 'From each start, extend right while updating the gcd; count when it equals k and stop once it is not a multiple of k.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 4).map(x => x * R.pick([1, 3])), k: R.pick([1, 3]) }),
    s(I, T) { let t = 0; const a = I.nums; for (let i = 0; i < a.length; i++) { let g = 0, c = 0; for (let j = i; j < a.length; j++) { g = gcd(g, a[j]); if (g % I.k) break; if (g === I.k) c++; } T.at({ nums: A(a, { hl: [i] }), k: I.k }); T.n(`Subarrays starting at ${i} with gcd ${I.k}?`, c, 'Extend while the gcd stays a multiple of k.'); t += c; } return t; }
  });

  D('number-of-distinct-binary-strings-after-applying-operations', {
    t: 'Distinct Strings After Flips: 2^(n − k + 1)',
    r: 'Each of the n − k + 1 windows is flipped or not, and different choices give different strings. Answer 2^(n − k + 1) mod 10^9 + 7.',
    g: R => { const s = R.str(R.int(1, 8), '01'); return { s, k: R.int(1, s.length) }; },
    s(I, T) { const e = I.s.length - I.k + 1; T.at({ s: I.s, k: I.k }); T.n('How many windows of size k?', e, 'n − k + 1.'); return Number(pw(2, e)); }
  });

  D('average-value-of-even-numbers-that-are-divisible-by-three', {
    t: 'Average of Even Numbers Divisible by Three: multiples of 6',
    r: 'Even and divisible by 3 means divisible by 6. Average those (rounded down), or 0 if none.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 30) }),
    s(I, T) { const v = I.nums.filter(x => x % 6 === 0); T.at({ nums: A(I.nums, { hl: I.nums.map((x, i) => x % 6 ? -1 : i).filter(i => i >= 0) }) }); T.n('How many multiples of 6?', v.length, 'Even and divisible by 3.'); return v.length ? Math.floor(v.reduce((a, b) => a + b, 0) / v.length) : 0; }
  });

  D('number-of-subarrays-with-lcm-equal-to-k', {
    t: 'Subarrays With LCM Equal to K: extend from each start',
    r: 'From each start, extend right updating the lcm; count when it equals k and stop when it no longer divides k.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 6), k: R.pick([6, 2, 3, 12]) }),
    s(I, T) { const a = I.nums; let t = 0; for (let i = 0; i < a.length; i++) { let l = 1, c = 0; for (let j = i; j < a.length; j++) { l = l / gcd(l, a[j]) * a[j]; if (I.k % l) break; if (l === I.k) c++; } T.at({ nums: A(a, { hl: [i] }), k: I.k }); T.n(`Subarrays starting at ${i} with lcm ${I.k}?`, c, 'Extend while the lcm still divides k.'); t += c; } return t; }
  });

  D('smallest-value-after-replacing-with-sum-of-prime-factors', {
    t: 'Replace With Sum of Prime Factors: until it stops changing',
    r: 'Replace n by the sum of its prime factors (with multiplicity). Primes map to themselves, so stop when the value stays the same.',
    g: R => ({ n: R.int(2, 200) }),
    s(I, T) { let n = I.n; for (;;) { let x = n, s = 0; for (let p = 2; p * p <= x; p++) while (x % p === 0) { s += p; x /= p; } if (x > 1) s += x; T.at({ n }); T.n(`Sum of prime factors of ${n}?`, s, 'Factor with multiplicity and add.'); if (s === n) return n; n = s; } }
  });

  D('count-anagrams', {
    t: 'Count Anagrams: multiply each word\'s arrangements',
    r: 'Words are permuted independently. A word of length L with letter counts c has L! / Π c! arrangements; multiply over words (mod 10^9 + 7, inverses for the division).',
    g: R => ({ s: Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 4), 'aabt')).join(' ') }),
    s(I, T) { let r = 1n; for (const w of I.s.split(' ')) { const c = {}; for (const ch of w) c[ch] = (c[ch] || 0) + 1; let v = fact(w.length); for (const k of Object.values(c)) v = v * pw(fact(k), M - 2n) % M; T.at({ s: I.s, word: w }); T.n(`Arrangements of "${w}"?`, Number(v), `${w.length}! / Π(letter counts)!.`); r = r * v % M; } return Number(r); }
  });

  D('count-the-digits-that-divide-a-number', {
    t: 'Count the Digits That Divide a Number',
    r: 'Check each digit d of num (none are 0) and count those with num mod d = 0.',
    g: R => ({ num: +R.str(R.int(1, 4), '123456789') }),
    s(I, T) { let c = 0; for (const d of String(I.num)) { const ok = I.num % +d === 0; T.at({ num: I.num, digit: d }); T.yn(`Does ${d} divide ${I.num}?`, ok, `${I.num} mod ${d} = ${I.num % +d}.`); if (ok) c++; } return c; }
  });

  D('distinct-prime-factors-of-product-of-array', {
    t: 'Distinct Prime Factors of a Product: union of factorizations',
    r: 'The product\'s primes are the union of each element\'s primes. Factor each number and add its primes to a set.',
    g: R => ({ nums: R.ints(R.int(1, 5), 2, 40) }),
    s(I, T) { const S = new Set(); I.nums.forEach((x, i) => { let y = x; for (let p = 2; p * p <= y; p++) while (y % p === 0) { S.add(p); y /= p; } if (y > 1) S.add(y); T.at({ nums: A(I.nums, { hl: [i] }), primes: A([...S].sort((a, b) => a - b)) }); T.n(`Distinct primes after factoring ${x}?`, S.size, 'Add its prime factors to the set.'); }); return S.size; }
  });

  D('closest-prime-numbers-in-range', {
    t: 'Closest Primes in a Range: sieve, then neighbors',
    r: 'Sieve up to right, list the primes in [left, right] and check consecutive pairs for the smallest gap (first pair on ties).',
    g: R => { const l = R.int(1, 40); return { left: l, right: l + R.int(0, 30) }; },
    s(I, T) { const p = []; for (let x = I.left; x <= I.right; x++) if (isPrime(x)) p.push(x); T.at({ left: I.left, right: I.right }); T.n('How many primes in range?', p.length, 'From the sieve.'); let best = [-1, -1]; for (let i = 1; i < p.length; i++) if (best[0] < 0 || p[i] - p[i - 1] < best[1] - best[0]) best = [p[i - 1], p[i]]; return best; }
  });

  D('categorize-box-according-to-criteria', {
    t: 'Categorize Box According to Criteria',
    r: 'Bulky: any dimension ≥ 10^4 or volume ≥ 10^9. Heavy: mass ≥ 100. Return "Both", "Bulky", "Heavy" or "Neither".',
    g: R => ({ length: R.pick([R.int(1, 2000), 10000, R.int(500, 1500)]), width: R.int(1, 2000), height: R.int(1, 2000), mass: R.int(1, 200) }),
    s(I, T) { const v = I.length * I.width * I.height, bulky = [I.length, I.width, I.height].some(x => x >= 1e4) || v >= 1e9, heavy = I.mass >= 100; T.at({ dims: `${I.length} × ${I.width} × ${I.height}`, mass: I.mass }); T.yn('Is it bulky?', bulky, `A dimension ≥ 10^4 or volume ${v} ≥ 10^9.`); T.yn('Is it heavy?', heavy, 'mass ≥ 100.'); return bulky && heavy ? 'Both' : bulky ? 'Bulky' : heavy ? 'Heavy' : 'Neither'; }
  });

  D('difference-between-element-sum-and-digit-sum-of-an-array', {
    t: 'Element Sum vs Digit Sum',
    r: 'Add the elements, add all their digits, and return the absolute difference.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 200) }),
    s(I, T) { const e = I.nums.reduce((a, b) => a + b, 0), d = I.nums.reduce((a, x) => a + [...String(x)].reduce((s, c) => s + +c, 0), 0); T.at({ nums: A(I.nums) }); T.n('Element sum?', e, 'Add the numbers.'); T.n('Digit sum?', d, 'Add every digit.'); return Math.abs(e - d); }
  });

  D('count-the-number-of-good-subsequences', {
    t: 'Count Good Subsequences: fix the common frequency',
    r: 'For each frequency f, every letter either is absent or appears exactly f times: Π (1 + C(cnt_c, f)) − 1 (the −1 drops the empty choice). Sum over f.',
    g: R => ({ s: R.str(R.int(2, 6), 'aabce') }),
    s(I, T) { const c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const mx = Math.max(...Object.values(c)); let t = 0n; for (let f = 1; f <= mx; f++) { let p = 1n; for (const v of Object.values(c)) p = p * (1n + binom(v, f)) % M; p = (p - 1n + M) % M; T.at({ counts: K(c), f }); T.n(`Good subsequences where each letter appears ${f} time(s)?`, Number(p), 'Π (1 + C(count, f)) − 1.'); t = (t + p) % M; } return Number(t); }
  });
})();
