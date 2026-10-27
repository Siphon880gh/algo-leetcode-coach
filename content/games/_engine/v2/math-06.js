/* v2 games: math (06). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const M = 1000000007n;
  const pw = (b, e) => { let r = 1n; b = BigInt(b) % M; e = BigInt(e); while (e > 0n) { if (e & 1n) r = r * b % M; b = b * b % M; e >>= 1n; } return r; };
  const fact = n => { let r = 1n; for (let i = 2n; i <= BigInt(n); i++) r = r * i % M; return r; };
  const isPrime = n => { if (n < 2) return false; for (let d = 2; d * d <= n; d++) if (n % d === 0) return false; return true; };
  const dsum = x => [...String(x)].reduce((a, c) => a + +c, 0);
  const places = (I, T) => { const p = I.points.slice().sort((a, b) => a[0] - b[0] || b[1] - a[1]); let t = 0; for (let i = 0; i < p.length; i++) { let my = -Infinity, c = 0; for (let j = i + 1; j < p.length; j++) if (p[j][1] <= p[i][1] && p[j][1] > my) { c++; my = p[j][1]; } T.at({ sorted: A(p.map(q => `(${q})`), { hl: [i] }) }); T.n(`Valid partners for Alice at (${p[i]})?`, c, 'Scan right; a point counts if it is not above Alice and higher than every partner so far.'); t += c; } return t; };
  const candies = (I, T) => { const C2 = x => x < 0 ? 0 : (x + 2) * (x + 1) / 2, L = I.limit, n = I.n; const terms = [C2(n), C2(n - L - 1), C2(n - 2 * (L + 1)), C2(n - 3 * (L + 1))]; T.at({ n, limit: L }); T.n('Ways with no limit (C(n + 2, 2))?', terms[0], 'Stars and bars over 3 children.'); T.n('Ways where one fixed child gets more than the limit?', terms[1], 'Give that child limit + 1 first.'); T.n('Ways where two fixed children both get more than the limit?', terms[2], 'Give each of them limit + 1 first.'); const r = terms[0] - 3 * terms[1] + 3 * terms[2] - terms[3]; T.n('Valid ways?', r, 'All ways, minus 3 times one child over, plus 3 times two over, minus all three over.'); return r; };

  D('check-if-point-is-reachable', {
    t: 'Check If Point Is Reachable: gcd must be a power of two',
    r: 'Subtraction moves keep the gcd; doubling multiplies it by 2. From (1, 1) you can reach exactly the points whose gcd is a power of two.',
    g: R => ({ targetX: R.int(1, 60), targetY: R.int(1, 60) }),
    s(I, T) { const res = (() => { const g = gcd(I.targetX, I.targetY); T.at({ target: `(${I.targetX},${I.targetY})` }); T.n('Greatest common divisor of targetX and targetY?', g, 'Use the Euclidean algorithm.'); let o = g; while (o % 2 === 0) o /= 2; T.n('That gcd with every factor of 2 removed?', o, 'Doubling moves can only add factors of 2.'); return (g & (g - 1)) === 0; })(); T.yn('Is the point reachable?', res, 'Only when the gcd is a power of 2.'); return res; }
  });

  D('alternating-digit-sum', {
    t: 'Alternating Digit Sum: +, −, +, … from the left',
    r: 'The most significant digit is positive and signs alternate. Walk the digit string adding or subtracting.',
    g: R => ({ n: R.int(1, 99999) }),
    s(I, T) { let s = 0; [...String(I.n)].forEach((d, i) => { s += i % 2 ? -d : +d; T.at({ digits: A([...String(I.n)], { hl: [i] }) }); T.n('Running sum?', s, i % 2 ? `Subtract ${d}.` : `Add ${d}.`); }); return s; }
  });

  D('count-collisions-of-monkeys-on-a-polygon', {
    t: 'Monkey Collisions: all but the two safe patterns',
    r: 'Each monkey picks one of 2 directions: 2^n ways. The only collision-free ways are all clockwise and all counter-clockwise, so the answer is 2^n − 2 (mod 10^9 + 7, fast power).',
    g: R => ({ n: R.int(3, 40) }),
    s(I, T) { const res = (() => { T.at({ n: I.n }); T.n('Total movement patterns, mod 1000000007?', Number(pw(2, I.n)), 'Each monkey picks one of two directions.'); T.n('How many movement patterns avoid every collision?', 2, 'All clockwise or all counter-clockwise.'); return Number((pw(2, I.n) - 2n + M) % M); })(); T.n('Patterns with a collision, mod 1000000007?', res, 'All patterns minus the 2 safe ones.'); return res; }
  });

  D('find-the-divisibility-array-of-a-string', {
    t: 'Divisibility Array: running remainder',
    r: 'Keep r = (r·10 + digit) mod m for each prefix; div[i] = 1 exactly when r = 0.',
    g: R => ({ word: R.str(R.int(2, 7), '0123456789'), m: R.int(1, 12) }),
    s(I, T) { let r = 0; return [...I.word].map((d, i) => { r = (r * 10 + +d) % I.m; T.at({ word: A([...I.word], { hl: [i] }), m: I.m }); T.n(`Remainder of the prefix ending at ${i}?`, r, '(previous·10 + digit) mod m.'); return r ? 0 : 1; }); }
  });

  D('count-total-number-of-colored-cells', {
    t: 'Count Colored Cells: each minute adds a diamond ring',
    r: 'Minute k (k ≥ 2) adds 4·(k − 1) cells. Total = 1 + 4·(1 + 2 + … + (n − 1)) = 1 + 2n(n − 1).',
    g: R => ({ n: R.int(1, 12) }),
    s(I, T) { let t = 1; for (let k = 2; k <= I.n; k++) { T.at({ minute: k, total: t }); T.n(`Cells added at minute ${k}?`, 4 * (k - 1), '4·(k − 1).'); t += 4 * (k - 1); } return t; }
  });

  D('pass-the-pillow', {
    t: 'Pass the Pillow: one round trip is 2(n − 1) seconds',
    r: 'Reduce time mod 2(n − 1). In the first n − 1 seconds the pillow walks right (person t + 1); after that it walks back (person n − (t − (n − 1))).',
    g: R => ({ n: R.int(2, 8), time: R.int(1, 30) }),
    s(I, T) { const res = (() => { const c = 2 * (I.n - 1), t = I.time % c; T.at({ n: I.n, time: I.time }); T.n(`Time left after removing full round trips of ${c}?`, t, 'A round trip brings the pillow back to person 1.'); T.yn('Is the pillow still moving forward?', t < I.n, 'It turns back after reaching person n.'); return t < I.n ? t + 1 : I.n - (t - (I.n - 1)); })(); T.n('Who holds the pillow?', res, 'Count forward, then back.'); return res; }
  });

  D('split-the-array-to-make-coprime-products', {
    t: 'Split for Coprime Products: last occurrence of each prime',
    r: 'Record the last index where each prime appears. Scan left to right keeping the furthest last-occurrence of any prime seen; the first i where that equals i is the answer.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 20) }),
    s(I, T) { const a = I.nums, last = {}, fac = x => { const s = []; for (let p = 2; p * p <= x; p++) if (x % p === 0) { s.push(p); while (x % p === 0) x /= p; } if (x > 1) s.push(x); return s; }; a.forEach((x, i) => fac(x).forEach(p => last[p] = i)); let far = 0; for (let i = 0; i < a.length - 1; i++) { fac(a[i]).forEach(p => far = Math.max(far, last[p])); T.at({ nums: A(a, { hl: [i] }), lastSeen: K(last) }); T.n(`Furthest last occurrence of a prime seen up to index ${i}?`, far, 'Max over the primes of the prefix.'); if (far === i) return i; } return -1; }
  });

  D('beautiful-pairs', {
    t: 'Beautiful Pairs: closest pair in Manhattan distance',
    r: 'Duplicated points give distance 0 at once (earliest indices). Otherwise find the minimum Manhattan distance (divide and conquer, or a sweep), breaking ties by the smallest index pair.',
    g: R => { const n = R.int(2, 5); return { nums1: R.ints(n, 0, n), nums2: R.ints(n, 0, n) }; },
    s(I, T) { const a = I.nums1, b = I.nums2, n = a.length; let best = [Infinity, 0, 0]; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) { const d = Math.abs(a[i] - a[j]) + Math.abs(b[i] - b[j]); if (d < best[0]) best = [d, i, j]; } T.at({ points: A(a.map((x, i) => `(${x},${b[i]})`)) }); T.n('How many pairs are there to compare?', n * (n - 1) / 2, 'Every i less than j.'); T.n('Smallest Manhattan distance?', best[0], 'Over all pairs.'); T.n('First index of the best pair?', best[1], 'The smallest pair of indices on ties.'); return [best[1], best[2]]; }
  });

  D('calculate-delayed-arrival-time', {
    t: 'Delayed Arrival Time: add mod 24',
    r: 'The new time is (arrivalTime + delayedTime) mod 24.',
    g: R => ({ arrivalTime: R.int(1, 23), delayedTime: R.int(1, 24) }),
    s(I, T) { const res = (() => { T.at({ arrival: I.arrivalTime, delay: I.delayedTime }); T.n('Sum before wrapping?', I.arrivalTime + I.delayedTime, 'Add them.'); T.yn('Does it pass midnight?', I.arrivalTime + I.delayedTime >= 24, 'Then wrap around.'); return (I.arrivalTime + I.delayedTime) % 24; })(); T.n('Arrival time on the 24-hour clock?', res, 'The sum, minus 24 if needed.'); return res; }
  });

  D('sum-multiples', {
    t: 'Sum Multiples of 3, 5 or 7: inclusion–exclusion',
    r: 'S(k) = k·m(m + 1)/2 with m = ⌊n/k⌋. Answer: S(3) + S(5) + S(7) − S(15) − S(21) − S(35) + S(105).',
    g: R => ({ n: R.int(1, 120) }),
    s(I, T) { const S = k => { const m = Math.floor(I.n / k); return k * m * (m + 1) / 2; }; for (const k of [3, 5, 7]) { T.at({ n: I.n }); T.n(`Sum of multiples of ${k} up to ${I.n}?`, S(k), `${k}·m(m + 1)/2 with m = ⌊n/${k}⌋.`); } return S(3) + S(5) + S(7) - S(15) - S(21) - S(35) + S(105); }
  });

  D('minimum-number-of-operations-to-make-all-array-elements-equal-to-1', {
    t: 'Make All Elements 1: find the shortest gcd-1 window',
    r: 'If there are ones already, each other element takes one step: n − ones. Otherwise find the shortest subarray with gcd 1 (length L): L − 1 steps make one 1, then n − 1 more spread it. No such subarray → −1.',
    g: R => ({ nums: R.chance(0.3) ? R.ints(R.int(2, 5), 1, 3).map(x => 2 * x) : R.ints(R.int(2, 5), 1, 9) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length, ones = a.filter(x => x === 1).length; T.at({ nums: A(a) }); T.n('How many 1s already?', ones, 'Each other element can copy a neighboring 1 in one step.'); if (ones) return n - ones; let L = Infinity; for (let i = 0; i < n; i++) { let g = 0; for (let j = i; j < n; j++) { g = gcd(g, a[j]); if (g === 1) { L = Math.min(L, j - i + 1); break; } } } T.n('Shortest subarray length with gcd 1 (0 if none)?', L === Infinity ? 0 : L, 'Extend from each start until the gcd hits 1.'); return L === Infinity ? -1 : L - 1 + n - 1; })(); T.n('Fewest operations (−1 if impossible)?', res, 'Make one 1, then spread it to the others.'); return res; }
  });

  D('check-if-the-number-is-fascinating', {
    t: 'Check If the Number Is Fascinating',
    r: 'Concatenate n, 2n and 3n. It is fascinating when the 9 digits are exactly 1 … 9 once each (no 0).',
    g: R => ({ n: R.pick([192, 219, 273, 327, R.int(100, 999)]) }),
    s(I, T) { const res = (() => { const s = `${I.n}${2 * I.n}${3 * I.n}`; T.at({ n: I.n }); T.n('Length of the concatenation?', s.length, `${I.n}, then ${2 * I.n}, then ${3 * I.n}.`); T.yn('Does it contain a 0?', s.includes('0'), 'A fascinating number has no zeros.'); return s.length === 9 && [...s].sort().join('') === '123456789'; })(); T.yn('Is n fascinating?', res, 'Each digit 1 to 9 exactly once.'); return res; }
  });

  D('total-distance-traveled', {
    t: 'Total Distance Traveled: refill after every 5 liters',
    r: 'Each time 5 liters are burned from the main tank and the additional tank has fuel, 1 liter moves over. Distance = 10 km per liter burned.',
    g: R => ({ mainTank: R.int(1, 30), additionalTank: R.int(1, 10) }),
    s(I, T) { let m = I.mainTank, a = I.additionalTank, d = 0; while (m >= 5) { m -= 5; d += 50; const x = a > 0 ? 1 : 0; a -= x; m += x; T.at({ main: m, additional: a, distance: d }); T.yn('Did 1 liter transfer after these 5 liters?', !!x, x ? 'The additional tank had fuel.' : 'It is empty.'); } return d + m * 10; }
  });

  D('number-of-beautiful-pairs', {
    t: 'Number of Beautiful Pairs: first digit vs last digit',
    r: 'For each j, count earlier i whose first digit is coprime with nums[j]\'s last digit. Keeping a count per first digit makes it O(10 n).',
    g: R => ({ nums: R.ints(R.int(2, 5), 1, 99).map(x => x % 10 ? x : x + 1) }),
    s(I, T) { const c = Array(10).fill(0); let t = 0; I.nums.forEach((x, j) => { const l = x % 10; let k = 0; for (let d = 1; d <= 9; d++) if (gcd(d, l) === 1) k += c[d]; T.at({ nums: A(I.nums, { hl: [j] }), firstDigits: A(c) }); T.n(`Beautiful pairs ending at index ${j}?`, k, `Earlier first digits coprime with ${l}.`); t += k; c[+String(x)[0]]++; }); return t; }
  });

  D('prime-pairs-with-target-sum', {
    t: 'Prime Pairs With Target Sum: sieve and pair up',
    r: 'Sieve primes up to n. For x from 2 to n/2, keep [x, n − x] when both are prime.',
    g: R => ({ n: R.int(1, 40) }),
    s(I, T) { const out = []; for (let x = 2; 2 * x <= I.n; x++) if (isPrime(x)) { const ok = isPrime(I.n - x); T.at({ n: I.n, x }); T.yn(`${x} is prime. Is ${I.n - x} prime too?`, ok, 'Check the partner.'); if (ok) out.push([x, I.n - x]); } return out; }
  });

  D('find-the-maximum-achievable-number', {
    t: 'Maximum Achievable Number: each step closes the gap by 2',
    r: 'Each operation can decrease x and increase num, closing the gap by 2. With t operations, x can start at most num + 2t.',
    g: R => ({ num: R.int(1, 50), t: R.int(1, 50) }),
    s(I, T) { const res = (() => { T.at({ num: I.num, t: I.t }); T.n('Gap closed per operation?', 2, 'x moves down and num moves up.'); T.n('Total gap that can be closed?', 2 * I.t, 'Two per operation.'); return I.num + 2 * I.t; })(); T.n('Largest achievable x?', res, 'num plus the total gap.'); return res; }
  });

  D('sum-of-squares-of-special-elements', {
    t: 'Sum of Squares of Special Elements: indices that divide n',
    r: 'For 1-indexed i dividing n, add nums[i]².',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const n = I.nums.length; let t = 0; for (let i = 1; i <= n; i++) { if (n % i) continue; T.at({ nums: A(I.nums, { hl: [i - 1] }), total: t }); T.n(`Index ${i} is special. nums[${i}]²?`, I.nums[i - 1] ** 2, `${i} divides ${n}.`); t += I.nums[i - 1] ** 2; } return t; }
  });

  D('account-balance-after-rounded-purchase', {
    t: 'Account Balance After a Rounded Purchase',
    r: 'Round the price to the nearest multiple of 10, with 5 rounding up: ⌊(p + 5) / 10⌋ · 10. Subtract from 100.',
    g: R => ({ purchaseAmount: R.int(0, 100) }),
    s(I, T) { const res = (() => { const r = Math.floor((I.purchaseAmount + 5) / 10) * 10; T.at({ price: I.purchaseAmount }); T.n('Last digit of the price?', I.purchaseAmount % 10, 'It decides whether to round up or down.'); T.n('Rounded price?', r, 'Nearest multiple of 10, with 5 rounding up.'); return 100 - r; })(); T.n('Balance left?', res, 'Start from 100.'); return res; }
  });

  D('count-symmetric-integers', {
    t: 'Count Symmetric Integers: equal half digit sums',
    r: 'Only even-length numbers qualify. Compare the digit sum of the first half with the second half for each number in range.',
    g: R => { const l = R.pick([R.int(1, 50), R.int(1000, 1300)]); return { low: l, high: l + R.int(0, 60) }; },
    s(I, T) { let c = 0; for (let x = I.low; x <= I.high; x++) { const s = String(x); if (s.length % 2) continue; const h = s.length / 2; if (dsum(s.slice(0, h)) === dsum(s.slice(h))) { c++; T.at({ range: `[${I.low}, ${I.high}]`, found: c }); T.n(`${x} is symmetric. Half digit sum?`, dsum(s.slice(0, h)), 'Sum of the first half.'); } } return c; }
  });

  D('determine-if-a-cell-is-reachable-at-a-given-time', {
    t: 'Reachable at a Given Time: Chebyshev distance',
    r: 'With diagonal moves the minimum time is max(|dx|, |dy|), and extra seconds can be wasted. The one trap: start = target with t = 1 (you must move away and cannot return in 1).',
    g: R => ({ sx: R.int(1, 6), sy: R.int(1, 6), fx: R.int(1, 6), fy: R.int(1, 6), t: R.int(0, 6) }),
    s(I, T) { const res = (() => { const d = Math.max(Math.abs(I.sx - I.fx), Math.abs(I.sy - I.fy)); T.at({ start: `(${I.sx},${I.sy})`, target: `(${I.fx},${I.fy})`, t: I.t }); T.n('Minimum time?', d, 'The larger of the row gap and the column gap.'); T.yn('Is the start the same cell as the target?', d === 0, 'Then exactly 1 second is the one bad time.'); return d === 0 ? I.t !== 1 : I.t >= d; })(); T.yn('Reachable at exactly time t?', res, 'Extra seconds can be spent walking around.'); return res; }
  });

  D('maximum-element-sum-of-a-complete-subset-of-indices', {
    t: 'Complete Subset of Indices: k times perfect squares',
    r: 'i·j is a square when i and j share the same square-free part. For every k, the indices k·1², k·2², k·3², … ≤ n form a group; take the best group sum.',
    g: R => ({ nums: R.ints(R.int(1, 10), 1, 15) }),
    s(I, T) { const n = I.nums.length; let best = 0; for (let k = 1; k <= n; k++) { let s = 0; for (let j = 1; k * j * j <= n; j++) s += I.nums[k * j * j - 1]; if (k <= 4) { T.at({ nums: A(I.nums), k }); T.n(`Sum over indices ${k}·j² (1-indexed)?`, s, `Indices ${[1, 2, 3, 4].filter(j => k * j * j <= n).map(j => k * j * j).join(', ')}.`); } best = Math.max(best, s); } return best; }
  });

  D('divisible-and-non-divisible-sums-difference', {
    t: 'Divisible and Non-Divisible Sums Difference',
    r: 'num2 = m·q(q + 1)/2 with q = ⌊n/m⌋; num1 = n(n + 1)/2 − num2. Return num1 − num2.',
    g: R => ({ n: R.int(1, 40), m: R.int(1, 10) }),
    s(I, T) { const res = (() => { const q = Math.floor(I.n / I.m), d = I.m * q * (q + 1) / 2, all = I.n * (I.n + 1) / 2; T.at({ n: I.n, m: I.m }); T.n('How many multiples of m are there up to n?', q, 'n divided by m, rounded down.'); T.n('Sum of multiples of m (num2)?', d, 'm times the sum 1 + 2 + … + q.'); return all - 2 * d; })(); T.n('num1 minus num2?', res, 'The total sum minus twice num2.'); return res; }
  });

  D('distribute-candies-among-children-i', { t: 'Distribute Candies Among Children I: inclusion–exclusion', r: 'Without limits there are C(n + 2, 2) ways. Subtract ways where some child gets more than limit (give them limit + 1 first), add back pairs, subtract all three.', g: R => ({ n: R.int(1, 12), limit: R.int(1, 6) }), s: candies });
  D('distribute-candies-among-children-ii', { t: 'Distribute Candies Among Children II: inclusion–exclusion in O(1)', r: 'C(n + 2, 2) − 3·C(n − L + 1, 2) + 3·C(n − 2L, 2) − C(n − 3L − 1, 2), where a term is 0 when its top is too small (L = limit).', g: R => ({ n: R.int(1, 30), limit: R.int(1, 12) }), s: candies });

  D('count-the-number-of-infection-sequences', {
    t: 'Count Infection Sequences: interleave the gaps',
    r: 'Healthy people form gaps between sick ones. Gaps interleave freely: (total healthy)! / Π gap!. Each interior gap of size g can also be filled from either end: × 2^(g − 1).',
    g: R => { const n = R.int(2, 8), k = R.int(1, n - 1); return { n, sick: R.distinct(k, 0, n - 1).sort((a, b) => a - b) }; },
    s(I, T) { const res = (() => { const s = I.sick, gaps = [s[0]]; for (let i = 1; i < s.length; i++) gaps.push(s[i] - s[i - 1] - 1); gaps.push(I.n - 1 - s[s.length - 1]); const tot = I.n - s.length; let r = fact(tot); T.at({ line: A(Array.from({ length: I.n }, (_, i) => s.includes(i) ? 'X' : '·')), gaps: A(gaps) }); T.n('How many healthy people?', tot, 'n − sick.'); gaps.forEach((g, i) => { r = r * pw(fact(g), M - 2n) % M; if (i > 0 && i < gaps.length - 1 && g > 0) { T.n(`Ways to fill the interior gap of size ${g} on its own?`, 2 ** (g - 1), 'Each step but the last can come from either end.'); r = r * pw(2, g - 1) % M; } }); return Number(r); })(); T.n('Infection sequences, mod 1000000007?', res, 'Interleave the gaps, then multiply by the interior choices.'); return res; }
  });

  D('double-modular-exponentiation', {
    t: 'Double Modular Exponentiation: ((a^b mod 10)^c) mod m',
    r: 'Compute a^b mod 10 with fast power, then raise that to c mod m. Keep the indices that equal target.',
    g: R => ({ variables: Array.from({ length: R.int(1, 3) }, () => [R.int(1, 40), R.int(1, 9), R.int(1, 9), R.int(1, 20)]), target: R.int(0, 5) }),
    s(I, T) { const pm = (b, e, m) => { let r = 1 % m; b %= m; while (e) { if (e & 1) r = r * b % m; b = b * b % m; e >>= 1; } return r; }; const out = []; I.variables.forEach(([a, b, c, m], i) => { const x = pm(a, b, 10), v = pm(x, c, m); T.at({ row: `[${a}, ${b}, ${c}, ${m}]`, target: I.target }); T.n(`${a}^${b} mod 10?`, x, 'Last digit of a^b.'); T.n(`(${x}^${c}) mod ${m}?`, v, 'Second fast power.'); if (v === I.target) out.push(i); }); return out; }
  });

  D('count-the-number-of-good-partitions', {
    t: 'Count Good Partitions: merge by last occurrence',
    r: 'Equal values must stay in one piece, so each value forces [first, last] together. Merging these gives k blocks that cannot be split; any of the k − 1 borders can be cut: 2^(k − 1).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 4) }),
    s(I, T) { const res = (() => { const last = {}; I.nums.forEach((x, i) => last[x] = i); let k = 0, end = -1; I.nums.forEach((x, i) => { end = Math.max(end, last[x]); if (end === i) k++; }); T.at({ nums: A(I.nums), last: K(last) }); T.n('Number of unsplittable blocks?', k, 'Close a block when i reaches the furthest last occurrence.'); T.n('Places where a cut is allowed?', k - 1, 'Between neighbouring blocks.'); return Number(pw(2, k - 1)); })(); T.n('Good partitions, mod 1000000007?', res, 'Each allowed cut is taken or not.'); return res; }
  });

  D('minimum-moves-to-capture-the-queen', {
    t: 'Capture the Queen: one move unless blocked, else two',
    r: 'The rook captures in 1 if it shares a row or column with the queen and the bishop is not between them. The bishop captures in 1 if on the same diagonal and the rook is not between. Otherwise 2 moves always suffice.',
    g: R => { const s = new Set(), p = []; while (p.length < 3) { const x = R.int(1, 8), y = R.int(1, 8); if (!s.has(x + ',' + y)) { s.add(x + ',' + y); p.push(x, y); } } return { a: p[0], b: p[1], c: p[2], d: p[3], e: p[4], f: p[5] }; },
    s(I, T) { const res = (() => { const { a, b, c, d, e, f } = I, btw = (x, y, z) => Math.min(x, z) < y && y < Math.max(x, z); const rook = (a === e && !(c === a && btw(b, d, f))) || (b === f && !(d === b && btw(a, c, e))); const bish = Math.abs(c - e) === Math.abs(d - f) && !(Math.abs(c - a) === Math.abs(d - b) && Math.abs(a - e) === Math.abs(b - f) && btw(c, a, e) && btw(d, b, f)); T.at({ rook: `(${a},${b})`, bishop: `(${c},${d})`, queen: `(${e},${f})` }); T.yn('Can the rook capture in one move?', rook, 'Same row or column, bishop not in between.'); T.yn('Can the bishop capture in one move?', bish, 'Same diagonal, rook not in between.'); return rook || bish ? 1 : 2; })(); T.n('Fewest moves?', res, 'One if either piece can capture now, otherwise two.'); return res; }
  });

  D('alice-and-bob-playing-flower-game', {
    t: 'Flower Game: Alice wins when x + y is odd',
    r: 'Alice takes the last flower exactly when the total x + y is odd. Count pairs with one odd and one even: odd(n)·even(m) + even(n)·odd(m).',
    g: R => ({ n: R.int(1, 20), m: R.int(1, 20) }),
    s(I, T) { const res = (() => { const on = Math.ceil(I.n / 2), en = Math.floor(I.n / 2), om = Math.ceil(I.m / 2), em = Math.floor(I.m / 2); T.at({ n: I.n, m: I.m }); T.n('Odd x choices?', on, 'Half of n, rounded up.'); T.n('Odd y choices?', om, 'Half of m, rounded up.'); return on * em + en * om; })(); T.n('Winning pairs?', res, 'x + y must be odd: odd x with even y, or even x with odd y.'); return res; }
  });

  D('type-of-triangle', {
    t: 'Type of Triangle: check the triangle inequality first',
    r: 'Sort the sides; if a + b ≤ c it is "none". Otherwise count distinct lengths: 1 → equilateral, 2 → isosceles, 3 → scalene.',
    g: R => ({ nums: R.ints(3, 1, 6) }),
    s(I, T) { const res = (() => { const [a, b, c] = I.nums.slice().sort((x, y) => x - y), ok = a + b > c; T.at({ sides: A([a, b, c]) }); T.n('Largest side?', c, 'It must be shorter than the other two together.'); T.yn('Do they form a triangle?', ok, `${a} plus ${b} is ${ok ? 'more than' : 'at most'} ${c}.`); if (!ok) return 'none'; const d = new Set(I.nums).size; T.n('Distinct side lengths?', d, 'Count them.'); return ['', 'equilateral', 'isosceles', 'scalene'][d]; })(); T.c('Type of triangle?', ['none', 'equilateral', 'isosceles', 'scalene'], res, 'Decided by the number of distinct sides.'); return res; }
  });

  D('find-the-number-of-ways-to-place-people-i', { t: 'Ways to Place People I: sort and sweep', r: 'Sort by x ascending, then y descending. For Alice at i, scan later points: a point is a valid Bob if it is not above Alice and higher than every Bob counted so far (otherwise someone sits in the fence).', g: R => { const s = new Set(); while (s.size < R.int(2, 5)) s.add(R.int(0, 4) + ',' + R.int(0, 4)); return { points: [...s].map(p => p.split(',').map(Number)) }; }, s: places });
  D('find-the-number-of-ways-to-place-people-ii', { t: 'Ways to Place People II: the same sweep for big coordinates', r: 'Coordinates are large but n ≤ 1000: sort by x ascending, y descending, and for each Alice scan right keeping the highest valid Bob so far; a new Bob must be below Alice and above that.', g: R => { const s = new Set(); while (s.size < R.int(2, 5)) s.add(R.int(-3, 3) + ',' + R.int(-3, 3)); return { points: [...s].map(p => p.split(',').map(Number)) }; }, s: places });

  D('find-the-largest-area-of-square-inside-two-rectangles', {
    t: 'Largest Square Inside Two Rectangles: pairwise intersections',
    r: 'For each pair of rectangles, the intersection is [max left, min right] × [max bottom, min top]. A square fits with side min(width, height) if positive. Return the largest side².',
    g: R => { const n = R.int(2, 3), bl = [], tr = []; for (let i = 0; i < n; i++) { const x = R.int(1, 5), y = R.int(1, 5); bl.push([x, y]); tr.push([x + R.int(1, 4), y + R.int(1, 4)]); } return { bottomLeft: bl, topRight: tr }; },
    s(I, T) { const b = I.bottomLeft, t = I.topRight; let best = 0; for (let i = 0; i < b.length; i++) for (let j = i + 1; j < b.length; j++) { const w = Math.min(t[i][0], t[j][0]) - Math.max(b[i][0], b[j][0]), h = Math.min(t[i][1], t[j][1]) - Math.max(b[i][1], b[j][1]), s = Math.max(0, Math.min(w, h)); T.at({ rects: A(b.map((p, k) => `[${p}]–[${t[k]}]`), { hl: [i, j] }) }); T.n(`Largest square side in rectangles ${i} and ${j}?`, s, 'min(overlap width, overlap height), or 0.'); best = Math.max(best, s); } return best * best; }
  });

  D('find-the-sum-of-encrypted-integers', {
    t: 'Sum of Encrypted Integers: repeat the largest digit',
    r: 'encrypt(x) writes x\'s largest digit in every position. Sum the encrypted values.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 999) }),
    s(I, T) { let t = 0; I.nums.forEach((x, i) => { const s = String(x), e = +String(Math.max(...[...s].map(Number))).repeat(s.length); T.at({ nums: A(I.nums, { hl: [i] }), total: t }); T.n(`encrypt(${x})?`, e, 'Largest digit in every place.'); t += e; }); return t; }
  });

  D('count-substrings-starting-and-ending-with-given-character', {
    t: 'Substrings Starting and Ending With c: k(k + 1)/2',
    r: 'With k occurrences of c, choose a start and an end occurrence (the same one allowed): k·(k + 1)/2.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc'), c: R.pick(['a', 'b']) }),
    s(I, T) { const res = (() => { const k = [...I.s].filter(x => x === I.c).length; T.at({ s: I.s, c: I.c }); T.n(`How many "${I.c}"s?`, k, 'Count them.'); T.n('Substrings that start and end at different positions?', k * (k - 1) / 2, 'Choose 2 of the positions.'); return k * (k + 1) / 2; })(); T.n('Total substrings?', res, 'Add the k single-letter substrings.'); return res; }
  });

  D('harshad-number', {
    t: 'Harshad Number: divisible by its digit sum',
    r: 'Compute the digit sum; return it if it divides x, otherwise −1.',
    g: R => ({ x: R.int(1, 100) }),
    s(I, T) { const res = (() => { const s = dsum(I.x); T.at({ x: I.x }); T.n('Digit sum?', s, 'Add the digits.'); T.yn('Does the digit sum divide x?', I.x % s === 0, 'That makes x a Harshad number.'); return I.x % s === 0 ? s : -1; })(); T.n('Answer (−1 if not Harshad)?', res, 'The digit sum, or −1.'); return res; }
  });
})();
