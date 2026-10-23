/* v2 games: math (03). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const leap = y => (y % 4 === 0 && y % 100 !== 0) || y % 400 === 0;
  const MD = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
  const daysFrom1971 = (y, m, d) => { let t = 0; for (let k = 1971; k < y; k++) t += leap(k) ? 366 : 365; for (let k = 1; k < m; k++) t += MD[k - 1] + (k === 2 && leap(y) ? 1 : 0); return t + d - 1; };
  const isPrime = n => { if (n < 2) return false; for (let d = 2; d * d <= n; d++) if (n % d === 0) return false; return true; };
  const negaAdd = (I, T) => { const a = I.arr1, b = I.arr2, out = []; let i = a.length - 1, j = b.length - 1, c = 0; while (i >= 0 || j >= 0 || c) { const s = (i >= 0 ? a[i] : 0) + (j >= 0 ? b[j] : 0) + c, bit = s & 1; T.at({ arr1: A(a, { hl: i >= 0 ? [i] : [] }), arr2: A(b, { hl: j >= 0 ? [j] : [] }), carry: c }); T.n('Bit written here?', bit, `sum ${s}, keep the low bit.`); out.push(bit); c = -(s >> 1); i--; j--; } while (out.length > 1 && out[out.length - 1] === 0) out.pop(); return out.reverse(); };

  D('convert-to-base-2', {
    t: 'Convert to Base −2: low bit, then divide by −2',
    r: 'Take the low bit b = n & 1, write it, and continue with n = −(n − b) / 2. Stop at 0 ("0" if n started at 0).',
    g: R => ({ n: R.int(0, 60) }),
    s(I, T) { let n = I.n, out = ''; if (!n) return '0'; while (n) { const b = n & 1; T.at({ n, bits: out || '—' }); T.n('Next bit (from the right)?', b, 'n & 1.'); out = b + out; n = -(n - b) / 2; } return out; }
  });

  D('valid-boomerang', {
    t: 'Valid Boomerang: non-zero cross product',
    r: 'Three points form a boomerang when they are not collinear (which also rules out duplicates): (p2 − p1) × (p3 − p1) ≠ 0.',
    g: R => ({ points: Array.from({ length: 3 }, () => [R.int(0, 4), R.int(0, 4)]) }),
    s(I, T) { const [a, b, c] = I.points, cr = (b[0] - a[0]) * (c[1] - a[1]) - (b[1] - a[1]) * (c[0] - a[0]); T.at({ points: A(I.points.map(p => `(${p})`)) }); T.n('Cross product (p2 − p1) × (p3 − p1)?', cr, 'Zero means collinear (or repeated).'); return cr !== 0; }
  });

  D('robot-bounded-in-circle', {
    t: 'Robot Bounded in Circle: one pass decides',
    r: 'Run the instructions once. The robot is bounded if it is back at the origin, or it is not facing north (then 2 or 4 repetitions bring it home).',
    g: R => ({ instructions: R.str(R.int(1, 6), 'GGLR') }),
    s(I, T) { const d = [[0, 1], [1, 0], [0, -1], [-1, 0]], N = ['north', 'east', 'south', 'west']; let x = 0, y = 0, k = 0; for (const c of I.instructions) { if (c === 'G') { x += d[k][0]; y += d[k][1]; } else k = (k + (c === 'R' ? 1 : 3)) % 4; } T.at({ instructions: I.instructions }); T.n('x after one pass?', x, 'Simulate.'); T.n('y after one pass?', y, 'Simulate.'); T.c('Facing after one pass?', N, N[k], 'L turns left, R turns right.'); return (x === 0 && y === 0) || k !== 0; }
  });

  D('confusing-number', {
    t: 'Confusing Number: rotate each digit',
    r: 'Every digit must be rotatable (0→0, 1→1, 6→9, 8→8, 9→6). Build the rotated number by reading digits from the right. It is confusing when that differs from n.',
    g: R => ({ n: R.pick([R.int(0, 999), +R.str(R.int(1, 4), '01689').replace(/^0+(?=.)/, '')]) }),
    s(I, T) { const M = { 0: 0, 1: 1, 6: 9, 8: 8, 9: 6 }, s = String(I.n); const ok = [...s].every(c => c in M); T.at({ n: I.n }); T.yn('Are all digits rotatable?', ok, 'Only 0, 1, 6, 8, 9 rotate into digits.'); if (!ok) return false; let r = 0; for (let i = s.length - 1; i >= 0; i--) r = r * 10 + M[s[i]]; T.n('Rotated number?', r, 'Rotate each digit, reading from the right.'); return r !== I.n; }
  });

  D('greatest-common-divisor-of-strings', {
    t: 'GCD of Strings: concatenation test, then gcd of lengths',
    r: 'A common divisor exists only if str1 + str2 == str2 + str1. Then the answer is the prefix of length gcd(len1, len2).',
    g: R => { const b = R.str(R.int(1, 3), 'AB'); return R.chance(0.7) ? { str1: b.repeat(R.int(1, 4)), str2: b.repeat(R.int(1, 3)) } : { str1: R.str(R.int(2, 6), 'AB'), str2: R.str(R.int(1, 4), 'AB') }; },
    s(I, T) { const ok = I.str1 + I.str2 === I.str2 + I.str1; T.at({ str1: I.str1, str2: I.str2 }); T.yn('Is str1 + str2 equal to str2 + str1?', ok, 'Both must be built from one repeated block.'); if (!ok) return ''; const g = gcd(I.str1.length, I.str2.length); T.n('gcd of the lengths?', g, `gcd(${I.str1.length}, ${I.str2.length}).`); return I.str1.slice(0, g); }
  });

  D('adding-two-negabinary-numbers', {
    t: 'Adding Negabinary Numbers: carry is −(sum >> 1)',
    r: 'From the right, sum = bit1 + bit2 + carry; write sum & 1, and the next carry is −(sum >> 1) because each place is −2 times the previous. Strip leading zeros.',
    g: R => ({ arr1: [1, ...R.ints(R.int(0, 4), 0, 1)], arr2: R.chance(0.15) ? [0] : [1, ...R.ints(R.int(0, 3), 0, 1)] }),
    s: negaAdd
  });

  D('sum-of-digits-in-the-minimum-number', {
    t: 'Sum of Digits in the Minimum Number',
    r: 'Find the minimum, add its digits, and return 1 if the sum is even, otherwise 0.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 100) }),
    s(I, T) { const m = Math.min(...I.nums), s = [...String(m)].reduce((a, c) => a + +c, 0); T.at({ nums: A(I.nums) }); T.n('Minimum?', m, 'Smallest value.'); T.n('Its digit sum?', s, 'Add the digits.'); return s % 2 ? 0 : 1; }
  });

  D('statistics-from-a-large-sample', {
    t: 'Statistics From a Large Sample: work on the counts',
    r: 'min/max: first and last value with a non-zero count. mean: Σ k·count[k] / total. mode: largest count. median: walk the cumulative counts to positions ⌊(total−1)/2⌋ and ⌊total/2⌋ and average them.',
    g: R => { const c = Array(256).fill(0); for (let i = 0; i < R.int(2, 4); i++) c[R.int(0, 8)] += R.int(1, 4); const m = c.indexOf(Math.max(...c)); c[m] += 5; return { count: c }; },
    s(I, T) { const c = I.count, nz = c.map((v, k) => [k, v]).filter(x => x[1]); const tot = nz.reduce((a, x) => a + x[1], 0), sum = nz.reduce((a, x) => a + x[0] * x[1], 0), mn = nz[0][0], mx = nz[nz.length - 1][0]; let mode = nz[0]; nz.forEach(x => { if (x[1] > mode[1]) mode = x; }); const at = p => { let acc = 0; for (const [k, v] of nz) { acc += v; if (acc > p) return k; } }; const med = (at(Math.floor((tot - 1) / 2)) + at(Math.floor(tot / 2))) / 2; T.at({ counts: K(nz) }); T.n('Total number of samples?', tot, 'Add the counts.'); T.n('Mean?', sum / tot, 'Σ value·count / total.'); T.n('Median?', med, 'Average the two middle positions.'); T.n('Mode?', mode[0], 'The value with the largest count.'); return [mn, mx, sum / tot, med, mode[0]]; }
  });

  D('distribute-candies-to-people', {
    t: 'Distribute Candies to People: give 1, 2, 3, … around the circle',
    r: 'Turn t gives min(t + 1, candies left) to person t mod n. (Closed form: count full rounds with the triangular numbers.)',
    g: R => ({ candies: R.int(1, 40), num_people: R.int(1, 5) }),
    s(I, T) { const out = Array(I.num_people).fill(0); let left = I.candies; for (let t = 0; left > 0; t++) { const g = Math.min(t + 1, left); T.at({ people: A(out, { hl: [t % I.num_people] }), left }); T.n(`Candies given to person ${t % I.num_people} on turn ${t + 1}?`, g, `Turn ${t + 1} gives ${t + 1}, or what is left.`); out[t % I.num_people] += g; left -= g; } return out; }
  });

  D('number-of-days-in-a-month', {
    t: 'Number of Days in a Month: the leap-year rule',
    r: 'February has 29 days in leap years (divisible by 4, but not by 100 unless also by 400) and 28 otherwise. April, June, September and November have 30; the rest 31.',
    g: R => ({ year: R.pick([R.int(1583, 2100), 1900, 2000, 2024]), month: R.int(1, 12) }),
    s(I, T) { T.at({ year: I.year, month: I.month }); if (I.month === 2) { T.yn(`Is ${I.year} a leap year?`, leap(I.year), 'Divisible by 4, and not by 100 unless by 400.'); return leap(I.year) ? 29 : 28; } T.yn('Is this a 30-day month?', [4, 6, 9, 11].includes(I.month), 'April, June, September, November.'); return MD[I.month - 1]; }
  });

  D('maximum-of-absolute-value-expression', {
    t: 'Maximum of Absolute Value Expression: four sign patterns',
    r: 'Each |·| becomes ± inside a maximum. For each sign pair (p, q), compute v = p·arr1[i] + q·arr2[i] + i; the answer is the largest (max v − min v).',
    g: R => { const n = R.int(2, 5); return { arr1: R.ints(n, -5, 9), arr2: R.ints(n, -5, 9) }; },
    s(I, T) { let best = 0; for (const [p, q] of [[1, 1], [1, -1], [-1, 1], [-1, -1]]) { const v = I.arr1.map((x, i) => p * x + q * I.arr2[i] + i), d = Math.max(...v) - Math.min(...v); T.at({ arr1: A(I.arr1), arr2: A(I.arr2), values: A(v) }); T.n(`Signs (${p > 0 ? '+' : '−'}, ${q > 0 ? '+' : '−'}): max − min?`, d, 'Spread of p·a + q·b + i.'); best = Math.max(best, d); } return best; }
  });

  D('armstrong-number', {
    t: 'Armstrong Number: k-th powers of the digits',
    r: 'With k digits, sum each digit raised to the k-th power and compare with n.',
    g: R => ({ n: R.pick([153, 370, 371, 407, 9474, R.int(1, 9999)]) }),
    s(I, T) { const s = String(I.n), k = s.length, t = [...s].reduce((a, c) => a + (+c) ** k, 0); T.at({ n: I.n, k }); T.n(`Sum of the digits to the power ${k}?`, t, 'Add each digit^k.'); return t === I.n; }
  });

  D('day-of-the-year', {
    t: 'Day of the Year: add up earlier months',
    r: 'Add the lengths of the months before this one (February gets 29 in leap years) and then the day.',
    g: R => { const y = R.pick([1900, 2000, 2016, R.int(1900, 2019)]), m = R.int(1, 12); return { date: `${y}-${String(m).padStart(2, '0')}-${String(R.int(1, MD[m - 1])).padStart(2, '0')}` }; },
    s(I, T) { const [y, m, d] = I.date.split('-').map(Number); if (m > 2) { T.at({ date: I.date }); T.yn(`Is ${y} a leap year?`, leap(y), 'Divisible by 4, and not by 100 unless by 400.'); } let t = 0; for (let k = 1; k < m; k++) t += MD[k - 1] + (k === 2 && leap(y) ? 1 : 0); T.at({ date: I.date }); T.n('Days in the months before this one?', t, 'Sum the earlier month lengths.'); return t + d; }
  });

  D('prime-arrangements', {
    t: 'Prime Arrangements: p! · (n − p)!',
    r: 'Count the primes p ≤ n. Primes can be permuted among the p prime positions and the rest among the others: p! · (n − p)! mod 10^9 + 7.',
    g: R => ({ n: R.int(1, 30) }),
    s(I, T) { let p = 0; for (let i = 2; i <= I.n; i++) if (isPrime(i)) p++; T.at({ n: I.n }); T.n(`Primes up to ${I.n}?`, p, 'Count them.'); const M = 1000000007n; let r = 1n; for (let i = 2n; i <= BigInt(p); i++) r = r * i % M; for (let i = 2n; i <= BigInt(I.n - p); i++) r = r * i % M; return Number(r); }
  });

  D('count-substrings-with-only-one-distinct-letter', {
    t: 'Count Single-Letter Substrings: L·(L+1)/2 per run',
    r: 'Split s into runs of the same letter. A run of length L contains L·(L + 1)/2 such substrings.',
    g: R => ({ s: R.str(R.int(3, 8), 'aab') }),
    s(I, T) { const runs = I.s.match(/(.)\1*/g); let t = 0; for (const r of runs) { const v = r.length * (r.length + 1) / 2; T.at({ runs: A(runs), total: t }); T.n(`Substrings inside the run "${r}"?`, v, `${r.length}·${r.length + 1}/2.`); t += v; } return t; }
  });

  D('day-of-the-week', {
    t: 'Day of the Week: count days from a known date',
    r: '1971-01-01 was a Friday. Count the days from then to the date (full years, then months, then days) and step that many weekdays forward mod 7.',
    g: R => { const y = R.int(1971, 2100), m = R.int(1, 12); return { day: R.int(1, MD[m - 1]), month: m, year: y }; },
    s(I, T) { const W = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], t = daysFrom1971(I.year, I.month, I.day); T.at({ date: `${I.year}-${I.month}-${I.day}`, anchor: '1971-01-01 = Friday' }); T.n('Days since 1971-01-01, mod 7?', t % 7, 'Count the days, then take mod 7.'); return W[(5 + t) % 7]; }
  });

  D('check-if-it-is-a-straight-line', {
    t: 'Check If It Is a Straight Line: cross products against the first two',
    r: 'Use the first two points as the direction. Every other point p must give (p1 − p0) × (p − p0) = 0 (no division, so vertical lines work).',
    g: R => { const a = R.int(-2, 2), b = R.int(-2, 2), x0 = R.int(-2, 2), y0 = R.int(-2, 2); const pts = Array.from({ length: R.int(2, 5) }, (_, i) => [x0 + i * (a || 1), y0 + i * b]); if (R.chance(0.4)) pts[pts.length - 1][1] += 1; return { coordinates: pts }; },
    s(I, T) { const p = I.coordinates, [a, b] = p; for (let i = 2; i < p.length; i++) { const cr = (b[0] - a[0]) * (p[i][1] - a[1]) - (b[1] - a[1]) * (p[i][0] - a[0]); T.at({ points: A(p.map(q => `(${q})`), { hl: [0, 1, i] }) }); T.n(`Cross product for (${p[i]})?`, cr, 'Zero means it is on the line.'); if (cr) return false; } return true; }
  });

  D('check-if-it-is-a-good-array', {
    t: 'Check If It Is a Good Array: gcd 1 (Bézout)',
    r: 'Integer combinations of the numbers produce exactly the multiples of their gcd (Bézout). The array is good when the gcd of all of it is 1.',
    g: R => ({ nums: R.chance(0.5) ? R.ints(R.int(2, 4), 1, 30) : R.ints(R.int(2, 4), 1, 10).map(x => 6 * x) }),
    s(I, T) { let g = 0; for (let i = 0; i < I.nums.length; i++) { g = gcd(g, I.nums[i]); T.at({ nums: A(I.nums, { hl: [i] }) }); T.n('Running gcd?', g, `gcd with ${I.nums[i]}.`); if (g === 1) break; } return g === 1; }
  });

  D('cells-with-odd-values-in-a-matrix', {
    t: 'Cells With Odd Values: count odd rows and odd columns',
    r: 'A cell is odd when exactly one of its row and column was incremented an odd number of times. With ro odd rows and co odd columns: ro·(n − co) + (m − ro)·co.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { m, n, indices: Array.from({ length: R.int(1, 4) }, () => [R.int(0, m - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const r = Array(I.m).fill(0), c = Array(I.n).fill(0); I.indices.forEach(([a, b]) => { r[a] ^= 1; c[b] ^= 1; }); const ro = r.reduce((s, v) => s + v, 0), co = c.reduce((s, v) => s + v, 0); T.at({ rowParity: A(r), colParity: A(c) }); T.n('Rows incremented an odd number of times?', ro, 'Toggle a parity bit per operation.'); T.n('Odd columns?', co, 'Same for columns.'); return ro * (I.n - co) + (I.m - ro) * co; }
  });

  D('minimum-time-visiting-all-points', {
    t: 'Minimum Time Visiting All Points: Chebyshev distance',
    r: 'Diagonal moves cover x and y at once, so each leg takes max(|dx|, |dy|) seconds.',
    g: R => ({ points: Array.from({ length: R.int(2, 5) }, () => [R.int(-5, 5), R.int(-5, 5)]) }),
    s(I, T) { let t = 0; for (let i = 1; i < I.points.length; i++) { const [a, b] = [I.points[i - 1], I.points[i]], d = Math.max(Math.abs(a[0] - b[0]), Math.abs(a[1] - b[1])); T.at({ points: A(I.points.map(p => `(${p})`), { hl: [i - 1, i] }), time: t }); T.n(`Seconds from (${a}) to (${b})?`, d, 'max(|dx|, |dy|).'); t += d; } return t; }
  });

  D('hexspeak', {
    t: 'Hexspeak: hex digits must all be letters, 0 or 1',
    r: 'Convert to uppercase hex, map 0 → O and 1 → I. If any digit 2–9 remains, return "ERROR".',
    g: R => ({ num: String(R.chance(0.5) ? parseInt(R.str(R.int(1, 4), '01ABCDEF'), 16) || 10 : R.int(1, 5000)) }),
    s(I, T) { const h = Number(I.num).toString(16).toUpperCase(); T.at({ num: I.num }); T.n('How many hex digits does it have?', h.length, `Hex: ${h}`); for (const ch of h) { const bad = /[2-9]/.test(ch); T.at({ hex: h, digit: ch }); T.yn(`Is "${ch}" invalid in Hexspeak?`, bad, bad ? 'Digits 2–9 have no letter form.' : 'Letters, 0 (O) and 1 (I) are fine.'); if (bad) return 'ERROR'; } return h.replace(/0/g, 'O').replace(/1/g, 'I'); }
  });

  D('number-of-burgers-with-no-waste-of-ingredients', {
    t: 'Burgers With No Waste: solve two linear equations',
    r: '4J + 2S = tomato, J + S = cheese ⇒ J = (tomato − 2·cheese) / 2, S = cheese − J. Valid only if both are non-negative integers.',
    g: R => { const j = R.int(0, 6), s = R.int(0, 6); return R.chance(0.7) ? { tomatoSlices: 4 * j + 2 * s, cheeseSlices: j + s } : { tomatoSlices: R.int(0, 30), cheeseSlices: R.int(0, 10) }; },
    s(I, T) { const d = I.tomatoSlices - 2 * I.cheeseSlices; T.at({ tomato: I.tomatoSlices, cheese: I.cheeseSlices }); T.n('tomato − 2·cheese?', d, 'Twice the jumbo count.'); if (d < 0 || d % 2) return []; const j = d / 2, s = I.cheeseSlices - j; T.n('Jumbo burgers?', j, 'Half of that.'); return s < 0 ? [] : [j, s]; }
  });

  D('subtract-the-product-and-sum-of-digits-of-an-integer', {
    t: 'Subtract the Product and Sum of Digits',
    r: 'Peel digits with % 10, multiply them into the product and add them into the sum; return product − sum.',
    g: R => ({ n: R.int(1, 99999) }),
    s(I, T) { const d = [...String(I.n)].map(Number), p = d.reduce((a, b) => a * b, 1), s = d.reduce((a, b) => a + b, 0); T.at({ digits: A(d) }); T.n('Product of digits?', p, 'Multiply them.'); T.n('Sum of digits?', s, 'Add them.'); return p - s; }
  });

  D('find-numbers-with-even-number-of-digits', {
    t: 'Find Numbers With an Even Number of Digits',
    r: 'Count the digits of each number (divide by 10 or use its string length) and count those with an even length.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 100000) }),
    s(I, T) { let c = 0; for (const x of I.nums) { const e = String(x).length % 2 === 0; T.at({ nums: A(I.nums), count: c }); T.yn(`Does ${x} have an even number of digits?`, e, `${String(x).length} digit(s).`); if (e) c++; } return c; }
  });

  D('find-n-unique-integers-sum-up-to-zero', {
    t: 'N Unique Integers Summing to Zero: pairs ±i',
    r: 'Add pairs i and −i for i = 1 … ⌊n/2⌋, and a 0 when n is odd.',
    g: R => ({ n: R.int(1, 8) }),
    cmp: (out, exp, I) => out.length === I.n && new Set(out).size === I.n && out.reduce((a, b) => a + b, 0) === 0,
    s(I, T) { T.at({ n: I.n }); T.yn('Does the answer need a 0?', I.n % 2 === 1, 'Odd n: pairs cover n − 1 slots.'); T.n('How many ± pairs?', Math.floor(I.n / 2), '⌊n / 2⌋.'); const out = []; for (let i = 1; i <= I.n / 2; i++) out.push(i, -i); if (I.n % 2) out.push(0); return out; }
  });

  D('convert-integer-to-the-sum-of-two-no-zero-integers', {
    t: 'Sum of Two No-Zero Integers: try a = 1, 2, …',
    r: 'Try a from 1 upward; take the first a where neither a nor n − a contains a 0.',
    g: R => ({ n: R.pick([R.int(2, 200), 101, 1010, 11]) }),
    cmp: (out, exp, I) => out.length === 2 && out[0] + out[1] === I.n && out.every(v => v > 0 && !String(v).includes('0')),
    s(I, T) { for (let a = 1; a < I.n; a++) { const ok = !String(a).includes('0') && !String(I.n - a).includes('0'); T.at({ n: I.n, a, b: I.n - a }); T.yn(`Do ${a} and ${I.n - a} both avoid 0?`, ok, 'Check both digit strings.'); if (ok) return [a, I.n - a]; } return []; }
  });

  D('angle-between-hands-of-a-clock', {
    t: 'Angle Between Clock Hands: 6° per minute, 0.5° drift per minute',
    r: 'Minute hand: 6·m. Hour hand: 30·(h mod 12) + 0.5·m. Take the difference d and return min(d, 360 − d).',
    g: R => ({ hour: R.int(1, 12), minutes: R.int(0, 59) }), cmp: 'float',
    s(I, T) { const m = 6 * I.minutes, h = 30 * (I.hour % 12) + 0.5 * I.minutes, d = Math.abs(m - h); T.at({ time: `${I.hour}:${String(I.minutes).padStart(2, '0')}` }); T.n('Minute hand angle?', m, '6° per minute.'); T.n('Hour hand angle?', h, '30° per hour + 0.5° per minute.'); return Math.min(d, 360 - d); }
  });

  D('number-of-days-between-two-dates', {
    t: 'Days Between Two Dates: count from a fixed day',
    r: 'Convert each date to days since 1971-01-01 (years, then months with the leap rule, then days) and return the absolute difference.',
    g: R => { const d = () => { const y = R.int(1971, 2100), m = R.int(1, 12); return `${y}-${String(m).padStart(2, '0')}-${String(R.int(1, MD[m - 1])).padStart(2, '0')}`; }; return { date1: d(), date2: d() }; },
    s(I, T) { const f = s => { const [y, m, d] = s.split('-').map(Number); return daysFrom1971(y, m, d); }, a = f(I.date1), b = f(I.date2); T.at({ date1: I.date1, date2: I.date2 }); T.n(`Days from 1971-01-01 to ${I.date1}?`, a, 'Full years, then months, then days.'); T.n(`Days from 1971-01-01 to ${I.date2}?`, b, 'Same count.'); return Math.abs(a - b); }
  });

  D('closest-divisors', {
    t: 'Closest Divisors: search down from the square root',
    r: 'For x = num + 1 and x = num + 2, the closest factor pair has its smaller factor the largest divisor ≤ √x. Compare the two pairs.',
    g: R => ({ num: R.int(1, 300) }), cmp: 'set',
    s(I, T) { const best = x => { for (let d = Math.floor(Math.sqrt(x)); d >= 1; d--) if (x % d === 0) return [d, x / d]; }; const a = best(I.num + 1), b = best(I.num + 2); T.at({ num: I.num }); T.n(`Largest divisor of ${I.num + 1} that is ≤ its square root?`, a[0], 'Walk down from ⌊√x⌋.'); T.n(`Largest divisor of ${I.num + 2} that is ≤ its square root?`, b[0], 'Walk down from ⌊√x⌋.'); return a[1] - a[0] <= b[1] - b[0] ? a : b; }
  });

  D('four-divisors', {
    t: 'Four Divisors: enumerate divisor pairs to √n',
    r: 'For each number, collect divisors in pairs (d, n/d) up to √n, stopping once there are more than 4. If exactly 4, add their sum.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 50) }),
    s(I, T) { let t = 0; for (const x of I.nums) { const ds = new Set(); for (let d = 1; d * d <= x && ds.size <= 4; d++) if (x % d === 0) { ds.add(d); ds.add(x / d); } const ok = ds.size === 4; T.at({ nums: A(I.nums), total: t }); T.yn(`Does ${x} have exactly four divisors?`, ok, `Divisors: ${[...ds].sort((a, b) => a - b).join(', ')}${ds.size > 4 ? ', …' : ''}.`); if (ok) t += [...ds].reduce((a, b) => a + b, 0); } return t; }
  });

  D('count-largest-group', {
    t: 'Count Largest Group: bucket by digit sum',
    r: 'Bucket 1…n by digit sum, find the largest bucket size, and count how many buckets have that size.',
    g: R => ({ n: R.int(1, 60) }),
    s(I, T) { const c = {}; for (let i = 1; i <= I.n; i++) { const s = [...String(i)].reduce((a, d) => a + +d, 0); c[s] = (c[s] || 0) + 1; } const mx = Math.max(...Object.values(c)); T.at({ groups: K(c) }); T.n('Largest group size?', mx, 'Biggest bucket.'); return Object.values(c).filter(v => v === mx).length; }
  });

  D('perform-string-shifts', {
    t: 'Perform String Shifts: net shift once',
    r: 'Add right shifts and subtract left shifts, take it mod n, and rotate once: the last k characters move to the front.',
    g: R => ({ s: R.str(R.int(2, 6), 'abcdefg'), shift: Array.from({ length: R.int(1, 4) }, () => [R.int(0, 1), R.int(0, 5)]) }),
    s(I, T) { const n = I.s.length, net = I.shift.reduce((a, [d, k]) => a + (d ? k : -k), 0), k = ((net % n) + n) % n; T.at({ s: I.s, shifts: A(I.shift.map(x => `${x[0] ? 'R' : 'L'}${x[1]}`)) }); T.n('Net right shift mod n?', k, 'Right adds, left subtracts.'); return I.s.slice(n - k) + I.s.slice(0, n - k); }
  });

  D('simplified-fractions', {
    t: 'Simplified Fractions: numerators coprime to the denominator',
    r: 'For each denominator d from 2 to n, include every numerator 1 ≤ k < d with gcd(k, d) = 1.',
    g: R => ({ n: R.int(1, 7) }), cmp: 'set',
    s(I, T) { const out = []; for (let d = 2; d <= I.n; d++) { let c = 0; for (let k = 1; k < d; k++) if (gcd(k, d) === 1) { out.push(`${k}/${d}`); c++; } T.at({ n: I.n, denominator: d }); T.n(`How many simplified fractions with denominator ${d}?`, c, 'Numerators coprime to d (Euler φ).'); } return out; }
  });

  D('the-kth-factor-of-n', {
    t: 'The k-th Factor of n: count divisors in order',
    r: 'Walk i = 1 … n and count the divisors; return the k-th one. (Faster: walk to √n and then the paired divisors in reverse.)',
    g: R => { const n = R.int(1, 60); return { n, k: R.int(1, 6) }; },
    s(I, T) { let c = 0; for (let i = 1; i <= I.n; i++) if (I.n % i === 0) { c++; T.at({ n: I.n, k: I.k, i }); T.n(`${i} divides ${I.n}. Which factor number is it?`, c, 'Count the divisors so far.'); if (c === I.k) return i; } return -1; }
  });

  D('check-if-array-pairs-are-divisible-by-k', {
    t: 'Array Pairs Divisible by k: match remainders',
    r: 'Count remainders ((x mod k) + k) mod k. Remainder r must pair with k − r, so their counts must match; remainder 0 (and k/2) must have even counts.',
    g: R => { const k = R.int(2, 6), n = 2 * R.int(1, 3), a = []; for (let i = 0; i < n / 2; i++) { const x = R.int(-9, 9); a.push(x, R.chance(0.8) ? R.int(-2, 2) * k - x : R.int(-9, 9)); } return { arr: R.shuffle(a), k }; },
    s(I, T) { const k = I.k, c = Array(k).fill(0); I.arr.forEach(x => c[((x % k) + k) % k]++); for (let r = 0; r <= k / 2; r++) { const ok = r === 0 || 2 * r === k ? c[r] % 2 === 0 : c[r] === c[k - r]; T.at({ remainders: A(c, { hl: [r, (k - r) % k] }) }); T.yn(r === 0 || 2 * r === k ? `Is the count of remainder ${r} even?` : `Do remainders ${r} and ${k - r} have equal counts?`, ok, 'Each must find a partner.'); if (!ok) return false; } return true; }
  });

  D('can-make-arithmetic-progression-from-sequence', {
    t: 'Can Make Arithmetic Progression: sort and check the step',
    r: 'Sort; the common difference must be a[1] − a[0], and every neighbor gap must match it.',
    g: R => { const a = R.int(-5, 5), d = R.int(-3, 3), n = R.int(2, 5), arr = Array.from({ length: n }, (_, i) => a + i * d); if (R.chance(0.4)) arr[R.int(0, n - 1)] += 1; return { arr: R.shuffle(arr) }; },
    s(I, T) { const a = I.arr.slice().sort((x, y) => x - y), d = a[1] - a[0]; T.at({ sorted: A(a) }); T.n('Common difference?', d, 'a[1] − a[0] after sorting.'); for (let i = 2; i < a.length; i++) if (a[i] - a[i - 1] !== d) { T.at({ sorted: A(a, { hl: [i - 1, i] }) }); T.n(`Gap at index ${i}?`, a[i] - a[i - 1], 'It differs from the common difference.'); return false; } return true; }
  });
})();
