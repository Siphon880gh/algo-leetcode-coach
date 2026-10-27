/* v2 games: greedy (05). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const sorted = a => a.slice().sort((x, y) => x - y);
  const cnt = a => { const m = new Map(); for (const x of a) m.set(x, (m.get(x) || 0) + 1); return m; };
  const pc = m => { let c = 0; while (m) { c += m & 1; m >>>= 1; } return c; };
  const gcd = (a, b) => b ? gcd(b, a % b) : a;
  const M = 1000000007n;
  const pw = (b, e) => { let r = 1n; b %= M; e = BigInt(e); while (e > 0n) { if (e & 1n) r = r * b % M; b = b * b % M; e >>= 1n; } return r; };
  const binom = (n, k) => { let r = 1n; for (let i = 0; i < k; i++) r = r * BigInt(n - i) / BigInt(i + 1); return r % M; };
  const ds = x => [...String(x)].reduce((a, c) => a + +c, 0);

  D('find-minimum-time-to-finish-all-jobs-ii', {
    t: 'Minimum Time to Finish All Jobs II: sort both sides',
    r: 'Sort jobs and workers; pair the i-th smallest job with the i-th smallest worker. The answer is the max of ⌈job / worker⌉.',
    g: R => { const n = R.int(1, 5); return { jobs: R.ints(n, 1, 12), workers: R.ints(n, 1, 6) }; },
    s(I, T) { const j = sorted(I.jobs), w = sorted(I.workers); let best = 0; j.forEach((x, i) => { const d = Math.ceil(x / w[i]); T.at({ jobs: A(j, { hl: [i] }), workers: A(w, { hl: [i] }) }); T.n(`Days for pair ${i}?`, d, `⌈${x} / ${w[i]}⌉.`); best = Math.max(best, d); }); return best; }
  });

  D('minimum-adjacent-swaps-to-make-a-valid-array', {
    t: 'Minimum Adjacent Swaps for a Valid Array',
    r: 'Move the leftmost smallest to the front (i swaps) and the rightmost largest to the back (n − 1 − j swaps). If the smallest started right of the largest, one swap is shared.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { const a = I.nums, n = a.length, mn = Math.min(...a), mx = Math.max(...a), i = a.indexOf(mn), j = a.lastIndexOf(mx); T.at({ nums: A(a, { hl: [i, j] }) }); T.n('Index of the leftmost smallest?', i, 'Fewest swaps to the front.'); T.n('Index of the rightmost largest?', j, 'Fewest swaps to the back.'); const ans = i + (n - 1 - j) - (i > j ? 1 : 0); T.n('Total swaps needed?', ans, 'Swaps to the front plus swaps to the back, minus one if the two moves share a swap.'); return ans; }
  });

  D('shortest-impossible-sequence-of-rolls', {
    t: 'Shortest Impossible Sequence of Rolls: count complete sets',
    r: 'Scan, collecting distinct faces; whenever all k faces have appeared, one more length is covered and the set resets. Answer = completed sets + 1.',
    g: R => { const k = R.int(1, 3); return { rolls: R.ints(R.int(1, 10), 1, k), k }; },
    s(I, T) { let seen = new Set(), sets = 0; I.rolls.forEach((r, i) => { seen.add(r); const done = seen.size === I.k; T.at({ rolls: A(I.rolls, { hl: [i] }), seen: A([...seen]), sets }); T.yn(`Does roll ${i} complete a set of all ${I.k} faces?`, done, 'All faces collected since the last reset.'); if (done) { sets++; seen = new Set(); } }); return sets + 1; }
  });

  D('minimum-replacements-to-sort-the-array', {
    t: 'Minimum Replacements to Sort: split from the right',
    r: 'Go right to left with the current bound. If x > bound, split it into p = ⌈x / bound⌉ parts (p − 1 operations); the new bound is ⌊x / p⌋.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 15) }),
    s(I, T) { const a = I.nums; let b = a[a.length - 1], ops = 0; for (let i = a.length - 2; i >= 0; i--) { const x = a[i], p = Math.ceil(x / b); T.at({ nums: A(a, { hl: [i] }), bound: b }); T.n(`Parts to split ${x} into?`, p, `⌈${x} / ${b}⌉.`); ops += p - 1; b = Math.floor(x / p); } return ops; }
  });

  D('minimum-hours-of-training-to-win-a-competition', {
    t: 'Minimum Hours of Training: energy total, experience on the way',
    r: 'Energy only drops: you need Σ energy + 1. Experience grows: walk through opponents and train whenever your experience is not strictly larger.',
    g: R => { const n = R.int(1, 4); return { initialEnergy: R.int(1, 10), initialExperience: R.int(1, 6), energy: R.ints(n, 1, 5), experience: R.ints(n, 1, 8) }; },
    s(I, T) { const e = Math.max(0, I.energy.reduce((a, b) => a + b, 0) + 1 - I.initialEnergy); T.at({ energy: A(I.energy), start: I.initialEnergy }); T.n('Hours of energy training?', e, 'Σ energy + 1 − initial.'); let x = I.initialExperience, h = 0; I.experience.forEach((v, i) => { const need = x <= v ? v - x + 1 : 0; T.at({ experience: A(I.experience, { hl: [i] }), yours: x }); T.n(`Experience training before opponent ${i}?`, need, 'Must be strictly greater.'); h += need; x += need + v; }); return e + h; }
  });

  D('largest-palindromic-number', {
    t: 'Largest Palindromic Number: biggest pairs outside',
    r: 'Use digit pairs from 9 down to 0 for the left half (no zeros if the half would start with 0), then the largest leftover digit in the middle.',
    g: R => ({ num: R.str(R.int(1, 9), '0012349') }),
    s(I, T) { const c = Array(10).fill(0); for (const d of I.num) c[+d]++; let half = ''; for (let d = 9; d >= 0; d--) half += String(d).repeat(c[d] >> 1); if (half[0] === '0') half = ''; let mid = ''; for (let d = 9; d >= 0; d--) if (c[d] % 2) { mid = String(d); break; } T.at({ counts: A(c) }); T.n('Length of the left half?', half.length, 'Pairs, but no leading zeros.'); const r = half + mid + [...half].reverse().join(''); T.n('Middle digit (−1 if there is none)?', mid === '' ? -1 : +mid, 'The largest digit with an odd count.'); T.n('Length of the answer?', (r || '0').length, 'Left half, middle digit, then the mirrored half.'); return r || '0'; }
  });

  D('optimal-partition-of-string', {
    t: 'Optimal Partition of String: cut on a repeat',
    r: 'Grow the current substring; when the next letter is already in it, start a new substring.',
    g: R => ({ s: R.str(R.int(1, 10), 'abc') }),
    s(I, T) { let seen = new Set(), p = 1; [...I.s].forEach((c, i) => { const cut = seen.has(c); T.at({ s: A([...I.s], { hl: [i] }), current: [...seen].join('') }); T.yn(`Start a new part at ${i}?`, cut, `"${c}" already used.`); if (cut) { p++; seen = new Set(); } seen.add(c); }); return p; }
  });

  D('minimum-money-required-before-transactions', {
    t: 'Minimum Money Before Transactions: worst-case order',
    r: 'The adversary does every losing transaction first. Total loss L = Σ max(0, cost − cashback). Then add the largest of cashback (losing) or cost (non-losing) for the transaction done last.',
    g: R => ({ transactions: Array.from({ length: R.int(1, 4) }, () => [R.int(0, 8), R.int(0, 8)]) }),
    s(I, T) { let L = 0, ex = 0; I.transactions.forEach(([c, b], i) => { L += Math.max(0, c - b); ex = Math.max(ex, Math.min(c, b)); T.at({ tx: A(I.transactions.map(x => `[${x}]`), { hl: [i] }), loss: L }); T.n('Total loss so far?', L, 'Σ max(0, cost − cashback).'); }); return L + ex; }
  });

  D('minimize-xor', {
    t: 'Minimize XOR: copy the high bits, fill the low ones',
    r: 'x needs popcount(num2) bits. Cancel num1\'s highest set bits first; if bits remain, set the lowest unset bits.',
    g: R => ({ num1: R.int(1, 63), num2: R.int(1, 63) }),
    s(I, T) { let c = pc(I.num2), x = 0; T.at({ num1: I.num1.toString(2), num2: I.num2.toString(2) }); T.n('Bits x must have?', c, 'popcount(num2).'); for (let b = 30; b >= 0 && c; b--) if (I.num1 >> b & 1) { x |= 1 << b; c--; } T.n('Value of x after matching num1\'s highest set bits?', x, 'Each set bit of num1, from the top, cancels while bits remain.'); T.n('Bits still to place?', c, 'They go into the lowest unset positions.'); for (let b = 0; b <= 30 && c; b++) if (!(x >> b & 1)) { x |= 1 << b; c--; } return x; }
  });

  D('minimum-number-of-operations-to-make-arrays-similar', {
    t: 'Make Arrays Similar: match by parity',
    r: 'Each operation moves 2 up and 2 down without changing parity. Sort odds and evens separately in both arrays, pair them, and the answer is Σ|a − b| / 4.',
    g: R => { const n = R.int(1, 5), a = R.ints(n, 1, 10).map(x => x * 2 - R.int(0, 1)), t = a.slice(); for (let r = 0; r < 3; r++) { const i = R.int(0, n - 1), j = R.int(0, n - 1); if (i !== j && t[j] > 2) { t[i] += 2; t[j] -= 2; } } return { nums: a, target: R.shuffle(t) }; },
    s(I, T) { const sp = (a, p) => sorted(a.filter(x => x % 2 === p)); let d = 0; for (const p of [0, 1]) { const a = sp(I.nums, p), b = sp(I.target, p); a.forEach((x, i) => d += Math.abs(x - b[i])); T.at({ nums: A(a), target: A(b) }); T.n(`Total |difference| so far after the ${p ? 'odd' : 'even'} values?`, d, 'Pair sorted values of the same parity.'); } T.n('Operations needed?', d / 4, 'Each operation fixes 4 units of total difference.'); return d / 4; }
  });

  D('minimum-addition-to-make-integer-beautiful', {
    t: 'Minimum Addition to Make Integer Beautiful: round up',
    r: 'While the digit sum is too large, round n up to the next multiple of 10, then 100, … — zeroing low digits is the cheapest way to cut the sum.',
    g: R => ({ n: R.int(1, 9999), target: R.int(1, 12) }),
    s(I, T) { let cur = I.n, base = 1; while (ds(cur) > I.target) { base *= 10; cur = Math.ceil(cur / base) * base; T.at({ n: I.n, current: cur, digitSum: ds(cur) }); T.n(`n rounded up to a multiple of ${base}?`, cur, 'Zero out the low digits.'); } return cur - I.n; }
  });

  D('minimum-total-cost-to-make-arrays-unequal', {
    t: 'Minimum Total Cost to Make Arrays Unequal',
    r: 'Every index with nums1[i] = nums2[i] must be swapped: add i. If one value is a majority of these, borrow the smallest extra indices whose two values both differ from it.',
    g: R => { const n = R.int(1, 6); return { nums1: R.ints(n, 1, 3), nums2: R.ints(n, 1, 3) }; },
    s(I, T) { const a = I.nums1, b = I.nums2, n = a.length, f = new Map(); let cost = 0, c = 0, mode = 0, mc = 0; for (let i = 0; i < n; i++) if (a[i] === b[i]) { cost += i; c++; f.set(a[i], (f.get(a[i]) || 0) + 1); if (f.get(a[i]) > mc) { mc = f.get(a[i]); mode = a[i]; } } T.at({ nums1: A(a), nums2: A(b) }); T.n('Sum of indices that must move?', cost, 'Indices where the values are equal.'); T.n('How many indices must move?', c, 'Positions where the two values are equal.'); T.yn('Does one value fill more than half of those indices?', mc * 2 > c, 'If so, extra indices must be borrowed.'); for (let i = 0; i < n && mc * 2 > c; i++) if (a[i] !== b[i] && a[i] !== mode && b[i] !== mode) { cost += i; c++; } return mc * 2 > c ? -1 : cost; }
  });

  D('minimum-operations-to-make-array-equal-ii', {
    t: 'Make Array Equal II: moves of k',
    r: 'Each difference must be a multiple of k and the differences must sum to 0. The answer is Σ positive differences / k. (k = 0: equal or −1.)',
    g: R => { const n = R.int(2, 5); return { nums1: R.ints(n, 0, 9), nums2: R.ints(n, 0, 9), k: R.int(0, 3) }; },
    s(I, T) { const d = I.nums1.map((x, i) => x - I.nums2[i]); if (I.k === 0) return d.every(x => x === 0) ? 0 : -1; T.at({ diff: A(d), k: I.k }); T.yn('Is every difference a multiple of k?', d.every(x => x % I.k === 0), 'Each move changes a value by exactly k.'); T.n('Sum of all the differences?', d.reduce((a, b) => a + b, 0), 'A move adds k on one side and takes k on the other, so this must be 0.'); const ok = d.every(x => x % I.k === 0) && d.reduce((a, b) => a + b, 0) === 0; T.yn('Is it possible?', ok, 'Multiples of k that sum to 0.'); return ok ? d.filter(x => x > 0).reduce((a, b) => a + b, 0) / I.k : -1; }
  });

  D('maximum-price-to-fill-a-bag', {
    t: 'Maximum Price to Fill a Bag: fractional knapsack',
    r: 'Items can be split. Take them by price per weight, descending, until the bag is exactly full; if total weight is too small, −1.',
    g: R => ({ items: Array.from({ length: R.int(1, 4) }, () => [R.int(1, 20), R.int(1, 6)]), capacity: R.int(1, 10) }),
    cmp: 'float',
    s(I, T) { const it = I.items.slice().sort((a, b) => b[0] / b[1] - a[0] / a[1]); let c = I.capacity, p = 0; for (const [pr, w] of it) { if (!c) break; const take = Math.min(w, c); T.at({ items: A(it.map(x => `${x[0]}/${x[1]}`)), space: c }); T.n(`Weight taken from item [${pr},${w}]?`, take, 'All of it, or what fits.'); p += pr * take / w; c -= take; } return c > 0 ? -1 : p; }
  });

  D('maximum-number-of-integers-to-choose-from-a-range-i', {
    t: 'Choose Integers From a Range I: small numbers first',
    r: 'Go through 1 … n, skip banned numbers, and add each while the sum stays within maxSum.',
    g: R => ({ banned: R.ints(R.int(1, 4), 1, 10), n: R.int(1, 10), maxSum: R.int(1, 20) }),
    s(I, T) { const b = new Set(I.banned); let s = 0, c = 0; for (let x = 1; x <= I.n; x++) { if (b.has(x)) continue; if (s + x > I.maxSum) break; s += x; c++; T.at({ banned: A([...b]), sum: s }); T.n('Count chosen so far?', c, `Took ${x}.`); } return c; }
  });

  D('rearranging-fruits', {
    t: 'Rearranging Fruits: swap cheap, or bounce through the minimum',
    r: 'Each cost must appear an even number of times overall. List the surplus fruits to move, sort them, and for the cheaper half pay min(x, 2 · global min) each.',
    g: R => { const n = R.int(1, 5), v = R.ints(n, 1, 5), all = R.shuffle([...v, ...v]); return { basket1: all.slice(0, n), basket2: all.slice(n) }; },
    s(I, T) { const c = new Map(); I.basket1.forEach(x => c.set(x, (c.get(x) || 0) + 1)); I.basket2.forEach(x => c.set(x, (c.get(x) || 0) - 1)); const mv = []; T.at({ basket1: A(I.basket1), basket2: A(I.basket2) }); T.yn('Does every cost appear an even number of times overall?', [...c.values()].every(d => d % 2 === 0), 'Otherwise the baskets can never match.'); for (const [v, d] of c) { if (d % 2) return -1; for (let i = 0; i < Math.abs(d) / 2; i++) mv.push(v); } const s = sorted(mv), mn = Math.min(...I.basket1, ...I.basket2); T.at({ toMove: A(s), globalMin: mn }); T.n('How many swaps are needed?', s.length / 2, 'Half of the fruits to move.'); let t = 0; for (let i = 0; i < s.length / 2; i++) t += Math.min(s[i], 2 * mn); T.n('Total cost?', t, 'Each of the cheaper half costs the smaller of its own price and twice the global minimum.'); return t; }
  });

  D('maximum-difference-by-remapping-a-digit', {
    t: 'Maximum Difference by Remapping a Digit',
    r: 'For the max, remap the first non-9 digit to 9 everywhere. For the min, remap the first digit to 0 everywhere.',
    g: R => ({ num: R.int(1, 99999) }),
    s(I, T) { const s = String(I.num), d = [...s].find(c => c !== '9'); const hi = d ? +s.split(d).join('9') : I.num, lo = +s.split(s[0]).join('0'); T.at({ num: s }); T.n('Maximum value?', hi, 'Turn the first non-9 digit into 9.'); T.n('Minimum value?', lo, 'Turn the first digit into 0.'); T.n('Difference?', hi - lo, 'Maximum minus minimum.'); return hi - lo; }
  });

  D('minimum-score-by-changing-two-elements', {
    t: 'Minimum Score by Changing Two Elements',
    r: 'Changing two elements can make the low score 0, so minimize the range: drop two from the ends — both smallest, both largest, or one of each.',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 20) }),
    s(I, T) { const a = sorted(I.nums), n = a.length; T.at({ sorted: A(a) }); T.n('Range if the two largest change?', a[n - 3] - a[0], 'a[n−3] − a[0].'); T.n('Range if the two smallest change?', a[n - 1] - a[2], 'a[n−1] − a[2].'); T.n('Range if one smallest and one largest change?', a[n - 2] - a[1], 'a[n−2] − a[1].'); return Math.min(a[n - 1] - a[2], a[n - 3] - a[0], a[n - 2] - a[1]); }
  });

  D('split-with-minimum-sum', {
    t: 'Split With Minimum Sum: deal digits alternately',
    r: 'Sort the digits and deal them alternately to the two numbers; small digits go to high places.',
    g: R => ({ num: R.int(10, 999999) }),
    s(I, T) { const d = sorted([...String(I.num)].map(Number)); let a = 0, b = 0; d.forEach((x, i) => { if (i % 2) b = b * 10 + x; else a = a * 10 + x; }); T.at({ digits: A(d) }); T.n('First number?', a, 'Even positions of the sorted digits.'); T.n('Second number?', b, 'Odd positions of the sorted digits.'); T.n('Minimum sum?', a + b, 'Add the two numbers.'); return a + b; }
  });

  D('distribute-money-to-maximum-children', {
    t: 'Distribute Money to Maximum Children: 8s with care',
    r: 'Give everyone 1 first; then give 7 more to as many as possible. Fix-ups: if all got 8 and money is left, one fewer; if all but one got 8 and the last would get exactly 4, one fewer.',
    g: R => ({ money: R.int(1, 60), children: R.int(2, 7) }),
    s(I, T) { if (I.money < I.children) return -1; let m = I.money - I.children, c = Math.min(Math.floor(m / 7), I.children); m -= 7 * c; T.at({ money: I.money, children: I.children }); T.n('Money left after every child gets 1?', I.money - I.children, 'Each child must get at least 1.'); T.n('Children who can get 7 more (before fix-ups)?', c, 'Money minus children, divided by 7 and rounded down, capped.'); if (c === I.children && m > 0) c--; else if (c === I.children - 1 && m === 3) c--; T.n('Children with exactly 8 after the fix-ups?', c, 'Check the two edge cases: money left over with everyone at 8, or a last child stuck at 4.'); return c; }
  });

  D('smallest-missing-non-negative-integer-after-operations', {
    t: 'Smallest Missing Integer After ±value: count residues',
    r: 'Each number can become any value with the same residue mod value. Walk i = 0, 1, …, using one number of residue i mod value each time; stop when none is left.',
    g: R => ({ nums: R.ints(R.int(1, 7), -10, 10), value: R.int(1, 4) }),
    s(I, T) { const v = I.value, c = Array(v).fill(0); I.nums.forEach(x => c[((x % v) + v) % v]++); T.at({ residues: A(c) }); T.n('How many numbers have residue 0?', c[0], 'They can become 0, value, twice value, and so on.'); let i = 0; while (c[i % v] > 0) { c[i % v]--; i++; } T.n('Which residue ran out first?', i % v, 'The residue of the missing value.'); T.n('Smallest missing value?', i, 'The first i whose residue runs out.'); return i; }
  });

  D('k-items-with-the-maximum-sum', {
    t: 'k Items With the Maximum Sum: ones, then zeros, then −1s',
    r: 'Take ones first, then zeros, then −1s if you must.',
    g: R => { const a = R.int(0, 5), b = R.int(0, 5), c = R.int(0, 5); return { numOnes: a, numZeros: b, numNegOnes: c, k: R.int(0, a + b + c) }; },
    s(I, T) { const ones = Math.min(I.k, I.numOnes), neg = Math.max(0, I.k - I.numOnes - I.numZeros); T.at({ ones: I.numOnes, zeros: I.numZeros, negOnes: I.numNegOnes, k: I.k }); T.n('Ones taken?', ones, 'Take every 1 you can, up to k.'); T.n('Zeros taken?', Math.min(Math.max(0, I.k - I.numOnes), I.numZeros), 'Zeros fill the next picks at no cost.'); T.n('−1s you are forced to take?', neg, 'Only after ones and zeros run out.'); return ones - neg; }
  });

  D('make-k-subarray-sums-equal', {
    t: 'Make k-Subarray Sums Equal: median of each cycle',
    r: 'Equal sums force arr[i] = arr[i + k] (circularly), so indices split into gcd(n, k) cycles. Move each cycle to its median.',
    g: R => { const n = R.int(1, 6); return { arr: R.ints(n, 1, 9), k: R.int(1, n) }; },
    s(I, T) { const n = I.arr.length, g = gcd(n, I.k); T.at({ arr: A(I.arr), k: I.k }); T.n('Number of cycles (gcd(n, k))?', g, 'Positions i, i + k, … wrap into gcd(n, k) groups.'); let t = 0; for (let s = 0; s < g; s++) { const c = []; for (let i = s; i < n; i += g) c.push(I.arr[i]); const m = sorted(c)[c.length >> 1]; T.at({ cycle: A(c), k: I.k }); T.n(`Median of cycle ${s}?`, m, 'Moving every value to the median costs the least.'); t += c.reduce((a, x) => a + Math.abs(x - m), 0); } T.n('Total cost?', t, 'Sum of the distances to each cycle\'s median.'); return t; }
  });

  D('maximum-sum-with-exactly-k-elements', {
    t: 'Maximum Sum With Exactly k Elements',
    r: 'Always take the maximum, which grows by one each time: m + (m + 1) + … + (m + k − 1).',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 9), k: R.int(1, 5) }),
    s(I, T) { const m = Math.max(...I.nums); T.at({ nums: A(I.nums), k: I.k }); T.n('Largest value in nums?', m, 'Always take the maximum.'); T.n('Value taken on the last operation?', m + I.k - 1, 'It grows by 1 each time.'); T.n('Total sum?', m * I.k + I.k * (I.k - 1) / 2, 'm + (m + 1) + … for k terms.'); return m * I.k + I.k * (I.k - 1) / 2; }
  });

  D('lexicographically-smallest-beautiful-string', {
    t: 'Smallest Beautiful String: bump from the right',
    r: 'A string with no palindromes of length 2 or 3 is beautiful. From the right, find the last position you can raise to a letter < k that differs from the two letters before it; then fill the rest with the smallest valid letters.',
    g: R => { const k = R.int(4, 5), n = R.int(1, 5), s = []; for (let i = 0; i < n; i++) { let c; do c = R.int(0, k - 1); while (c === s[i - 1] || c === s[i - 2]); s.push(c); } return { s: s.map(c => String.fromCharCode(97 + c)).join(''), k }; },
    s(I, T) { const s = [...I.s].map(c => c.charCodeAt(0) - 97), n = s.length; const ok = (i, c) => c !== s[i - 1] && c !== s[i - 2]; for (let i = n - 1; i >= 0; i--) { let c = s[i] + 1; while (c < I.k && !ok(i, c)) c++; T.at({ s: A([...I.s], { hl: [i] }) }); T.yn(`Can position ${i} be raised?`, c < I.k, 'Needs a letter < k unlike the two before it.'); if (c < I.k) { const L = Array.from({ length: I.k }, (_, x) => String.fromCharCode(97 + x)); T.c(`Which letter goes at position ${i}?`, L, L[c], 'The smallest letter above the old one that differs from the two before it.'); T.n('How many positions after it get refilled?', n - 1 - i, 'Everything to its right is rebuilt with the smallest valid letters.'); s[i] = c; for (let j = i + 1; j < n; j++) { let d = 0; while (!ok(j, d)) d++; s[j] = d; } return s.map(x => String.fromCharCode(97 + x)).join(''); } } return ''; }
  });

  D('buy-two-chocolates', {
    t: 'Buy Two Chocolates: the two cheapest',
    r: 'Buy the two cheapest; if they cost more than your money, keep your money.',
    g: R => ({ prices: R.ints(R.int(2, 6), 1, 9), money: R.int(1, 12) }),
    s(I, T) { const a = sorted(I.prices), s = a[0] + a[1]; T.at({ prices: A(I.prices), money: I.money }); T.n('Cost of the two cheapest?', s, `${a[0]} + ${a[1]}.`); T.yn('Can you afford both?', s <= I.money, `Compare ${s} with ${I.money}.`); T.n('Money left over?', s <= I.money ? I.money - s : I.money, 'If you cannot afford them, you keep all your money.'); return s <= I.money ? I.money - s : I.money; }
  });

  D('lexicographically-smallest-string-after-substring-operation', {
    t: 'Smallest String After Substring Operation',
    r: 'Decrement the first run of non-a letters. If the string is all a\'s, the operation must still happen: turn the last letter into z.',
    g: R => ({ s: R.str(R.int(1, 7), 'aabc') }),
    s(I, T) { const s = [...I.s]; let i = s.findIndex(c => c !== 'a'); T.at({ s: A(s) }); T.n('Start of the run to decrement (−1 if all a)?', i, 'First non-a letter.'); let e = i; while (e >= 0 && e < s.length && s[e] !== 'a') e++; T.yn('Is the string all a?', i < 0, 'Then the last letter must wrap to z.'); T.n('How many letters change?', i < 0 ? 1 : e - i, 'The whole run up to the next a, or just the last letter.'); if (i < 0) { s[s.length - 1] = 'z'; return s.join(''); } while (i < s.length && s[i] !== 'a') { s[i] = String.fromCharCode(s[i].charCodeAt(0) - 1); i++; } return s.join(''); }
  });

  D('construct-the-longest-new-string', {
    t: 'Construct the Longest New String: alternate AA and BB',
    r: 'Alternate AA and BB: 2·min(x, y) of them, plus one more if x ≠ y. All AB strings fit too. Length = 2 · (that count + z).',
    g: R => ({ x: R.int(1, 6), y: R.int(1, 6), z: R.int(1, 6) }),
    s(I, T) { const c = 2 * Math.min(I.x, I.y) + (I.x !== I.y ? 1 : 0); T.at({ x: I.x, y: I.y, z: I.z }); T.yn('Are x and y different?', I.x !== I.y, 'Then one extra piece fits at an end.'); T.n('How many AA and BB pieces can alternate?', c, 'Twice the smaller count, plus one extra if they differ.'); T.n('Length of the new string?', 2 * (c + I.z), 'Every piece has length 2, and all AB pieces fit.'); return 2 * (c + I.z); }
  });

  D('largest-element-in-an-array-after-merge-operations', {
    t: 'Largest Element After Merge Operations: merge from the right',
    r: 'From the right, keep a running value; if the next element is ≤ it, absorb it, otherwise restart from that element.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const a = I.nums; let cur = a[a.length - 1], best = cur; for (let i = a.length - 2; i >= 0; i--) { cur = a[i] <= cur ? cur + a[i] : a[i]; T.at({ nums: A(a, { hl: [i] }) }); T.n(`Running value after index ${i}?`, cur, 'Absorb if not bigger.'); best = Math.max(best, cur); } return best; }
  });

  D('maximum-number-of-groups-with-increasing-length', {
    t: 'Groups With Increasing Length: accumulate sorted limits',
    r: 'Sort limits. Group count k is reachable once the accumulated usage is at least 1 + 2 + … + k; scanning sorted limits, bump k whenever total ≥ (k + 1)(k + 2) / 2.',
    g: R => ({ usageLimits: R.ints(R.int(1, 6), 1, 6) }),
    s(I, T) { let tot = 0, k = 0; sorted(I.usageLimits).forEach((x, i) => { tot += x; if (tot >= (k + 1) * (k + 2) / 2) k++; T.at({ sorted: A(sorted(I.usageLimits), { hl: [i] }), total: tot }); T.n('Groups so far?', k, `Need ${(k + 1) * (k + 2) / 2} total for the next.`); }); return k; }
  });

  D('shortest-string-that-contains-three-strings', {
    t: 'Shortest String Containing Three Strings: try all orders',
    r: 'Merge two strings by the largest overlap (or keep one if it contains the other). Try all 6 orders and keep the shortest, then smallest.',
    g: R => ({ a: R.str(R.int(1, 3), 'ab'), b: R.str(R.int(1, 3), 'ab'), c: R.str(R.int(1, 3), 'ab') }),
    s(I, T) { const mg = (x, y) => { if (x.includes(y)) return x; for (let o = Math.min(x.length, y.length); o >= 0; o--) if (x.endsWith(y.slice(0, o))) return x + y.slice(o); }; const p = [[0, 1, 2], [0, 2, 1], [1, 0, 2], [1, 2, 0], [2, 0, 1], [2, 1, 0]], s = [I.a, I.b, I.c]; let best = null; for (const o of p) { const r = mg(mg(s[o[0]], s[o[1]]), s[o[2]]); if (!best || r.length < best.length || (r.length === best.length && r < best)) best = r; } T.at({ a: I.a, b: I.b, c: I.c }); T.n('Length of a merged with b?', mg(I.a, I.b).length, 'Use the longest suffix of a that is a prefix of b, or just a if it already contains b.'); T.n('Length of a, b and c joined with no overlap?', I.a.length + I.b.length + I.c.length, 'The upper bound before any merging.'); T.n('Length of the shortest result?', best.length, 'Best of the 6 merge orders.'); return best; }
  });

  D('check-if-it-is-possible-to-split-array', {
    t: 'Check If Array Can Be Split: one strong adjacent pair',
    r: 'With n ≤ 2 it is always possible. Otherwise you need some adjacent pair with sum ≥ m: peel elements off around it.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 6), m: R.int(1, 10) }),
    s(I, T) { if (I.nums.length <= 2) return true; let ok = false; T.at({ nums: A(I.nums), m: I.m }); T.n('How many adjacent pairs could be checked?', I.nums.length - 1, 'One pair per neighbouring index.'); for (let i = 0; i + 1 < I.nums.length; i++) { const v = I.nums[i] + I.nums[i + 1] >= I.m; T.at({ nums: A(I.nums, { hl: [i, i + 1] }), m: I.m }); T.yn(`Is pair ${i},${i + 1} strong enough?`, v, 'The sum must be at least m.'); if (v) { ok = true; break; } } T.yn('Can the array be split?', ok, 'One strong pair is enough to peel everything else away.'); return ok; }
  });

  D('determine-the-minimum-sum-of-a-k-avoiding-array', {
    t: 'Minimum Sum of a k-Avoiding Array',
    r: 'Take 1, 2, … but skip x whenever k − x was already taken (i.e. x > k/2 and x < k); after that, continue from k upward.',
    g: R => ({ n: R.int(1, 8), k: R.int(1, 10) }),
    s(I, T) { const taken = new Set(); let x = 1, s = 0; while (taken.size < I.n) { if (!taken.has(I.k - x)) { taken.add(x); s += x; } x++; } T.at({ n: I.n, k: I.k }); T.n('Largest number used?', Math.max(...taken), 'Skip partners of earlier picks.'); T.n('How many numbers were skipped?', x - 1 - I.n, 'Each skipped number would add up to k with an earlier pick.'); T.n('Minimum sum?', s, 'Add the numbers you kept.'); return s; }
  });

  D('find-the-minimum-possible-sum-of-a-beautiful-array', {
    t: 'Minimum Sum of a Beautiful Array: 1 … t/2, then from target',
    r: 'Use m = min(n, ⌊target/2⌋) numbers 1 … m, then the remaining n − m numbers target, target + 1, …; answer mod 1e9+7.',
    g: R => ({ n: R.int(1, 10), target: R.int(1, 12) }),
    s(I, T) { const m = Math.min(I.n, Math.floor(I.target / 2)), r = I.n - m; T.at({ n: I.n, target: I.target }); T.n('Numbers taken from 1 upward?', m, 'The smaller of n and half of target, rounded down.'); const s = BigInt(m) * BigInt(m + 1) / 2n + BigInt(r) * BigInt(I.target) + BigInt(r) * BigInt(r - 1) / 2n; T.n('Numbers taken from target upward?', r, 'The remaining n − m numbers.'); T.n('Minimum sum (mod 1e9+7)?', Number(s % M), 'Sum of both runs.'); return Number(s % M); }
  });

  D('minimum-operations-to-form-subsequence-with-target-sum', {
    t: 'Form Subsequence With Target Sum: bit by bit',
    r: 'Count powers. For each bit of target from low to high: use an available piece; if none, split the nearest larger power (j − i operations). Leftovers pair up and carry to the next bit.',
    g: R => ({ nums: Array.from({ length: R.int(1, 5) }, () => 2 ** R.int(0, 5)), target: R.int(1, 40) }),
    s(I, T) { const tot = I.nums.reduce((a, b) => a + b, 0); T.at({ nums: A(I.nums), target: I.target }); T.yn('Is the total at least target?', tot >= I.target, 'Splitting never changes the total.'); if (tot < I.target) return -1; T.n('How many bits are set in target?', pc(I.target), 'Each set bit needs one piece of that size.'); const c = Array(32).fill(0); I.nums.forEach(x => c[Math.log2(x)]++); let ops = 0; for (let i = 0; i < 31; i++) { if (I.target >> i & 1) { if (c[i] > 0) c[i]--; else { let j = i + 1; while (!c[j]) j++; ops += j - i; c[j]--; for (let t = i; t < j; t++) c[t]++; T.at({ counts: A(c.slice(0, 8)), bit: i }); T.n(`Operations so far after covering bit ${i}?`, ops, `Split 2^${j} down to 2^${i}.`); } } c[i + 1] += c[i] >> 1; } T.n('Total operations?', ops, 'Add up all the splits.'); return ops; }
  });

  D('count-k-subsequences-of-a-string-with-maximum-beauty', {
    t: 'k-Subsequences With Maximum Beauty: the most frequent letters',
    r: 'Pick the k most frequent distinct letters. Letters above the cutoff frequency v are forced; among the t letters with frequency v choose r: C(t, r) · v^r times the product of the forced frequencies.',
    g: R => ({ s: R.str(R.int(1, 10), 'aabbccd'), k: R.int(1, 4) }),
    s(I, T) { const f = [...cnt([...I.s]).values()].sort((a, b) => b - a); if (I.k > f.length) return 0; const v = f[I.k - 1]; T.at({ freqs: A(f), k: I.k }); T.n('Cutoff frequency?', v, 'Frequency of the k-th most frequent letter.'); let r = 1n; let take = 0; for (const x of f) if (x > v) { r = r * BigInt(x) % M; take++; } const t = f.filter(x => x === v).length, need = I.k - take; T.n('Letters forced in, with frequency above the cutoff?', take, 'They must be chosen.'); T.n('Letters tied at the cutoff frequency?', t, 'The remaining picks come from these.'); return Number(r * binom(t, need) % M * pw(BigInt(v), need) % M); }
  });

  D('minimum-operations-to-make-a-special-number', {
    t: 'Make a Special Number: end in 00, 25, 50 or 75',
    r: 'For each ending, find the last digit then the matching digit before it from the right; deletions = everything after and between. Or reduce to "0" (keep one 0) / delete everything.',
    g: R => ({ num: String(R.int(1, 999999)) }),
    s(I, T) { const s = I.num, n = s.length; let best = n - (s.includes('0') ? 1 : 0); T.at({ num: A([...s]) }); T.n('Deletions if you keep only a single 0, or delete everything?', best, 'Keep one 0 if there is one.'); for (const e of ['00', '25', '50', '75']) { const j = s.lastIndexOf(e[1]); if (j < 1) continue; const i = s.lastIndexOf(e[0], j - 1); if (i < 0) continue; const ops = n - i - 2; T.at({ num: A([...s], { hl: [i, j] }) }); T.n(`Deletions to end with ${e}?`, ops, 'Digits after and between the pair.'); best = Math.min(best, ops); } T.n('Fewest deletions overall?', best, 'The best of all the endings.'); return best; }
  });

  D('smallest-number-with-given-digit-product', {
    t: 'Smallest Number With Given Digit Product: divide by 9 … 2',
    r: 'Divide out 9, 8, …, 2 greedily (bigger digits mean fewer digits). If something > 1 remains, −1. Sort the digits ascending.',
    g: R => ({ n: R.int(1, 400) }),
    s(I, T) { let n = BigInt(I.n); if (n === 1n) return '1'; const d = []; for (let x = 9n; x >= 2n; x--) while (n % x === 0n) { n /= x; d.push(Number(x)); } T.at({ n: String(I.n), digits: A(d) }); T.n('How many 9s divide out?', d.filter(x => x === 9).length, 'Bigger digits first means fewer digits.'); T.yn('Fully factored into digits?', n === 1n, 'Any prime > 7 is impossible.'); T.n('How many digits were divided out in total?', d.length, 'Every factor from 9 down to 2.'); return n !== 1n ? '-1' : d.sort((a, b) => a - b).join(''); }
  });

  D('maximum-odd-binary-number', {
    t: 'Maximum Odd Binary Number: one 1 at the end',
    r: 'Put one 1 last to make it odd; all other 1s go to the front, zeros in between.',
    g: R => ({ s: '1' + R.str(R.int(0, 6), '01') }),
    s(I, T) { const o = [...I.s].filter(c => c === '1').length; T.at({ s: I.s }); T.n('How many ones are there?', o, 'Count them in s.'); T.n('Ones at the front?', o - 1, 'One is kept for the end.'); T.n('Zeros in the middle?', I.s.length - o, 'Every zero sits between the front ones and the last 1.'); return '1'.repeat(o - 1) + '0'.repeat(I.s.length - o) + '1'; }
  });

  D('minimum-number-of-operations-to-make-array-empty', {
    t: 'Make Array Empty: groups of three',
    r: 'For each value count c: c = 1 is impossible; otherwise ⌈c / 3⌉ operations.',
    g: R => ({ nums: R.ints(R.int(2, 10), 1, 4) }),
    s(I, T) { let r = 0; for (const [v, c] of cnt(I.nums)) { T.at({ nums: A(I.nums), value: v, count: c }); T.n(`Operations for value ${v} (−1 if impossible)?`, c === 1 ? -1 : Math.ceil(c / 3), '⌈c / 3⌉, but 1 is impossible.'); if (c === 1) return -1; r += Math.ceil(c / 3); } return r; }
  });
})();
