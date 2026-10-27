/* v2 games: math (04). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const M = 1000000007n, MOD = 1e9 + 7;
  const pw = (b, e) => { let r = 1n; b = BigInt(b) % M; e = BigInt(e); while (e > 0n) { if (e & 1n) r = r * b % M; b = b * b % M; e >>= 1n; } return r; };
  const fact = n => { let r = 1n; for (let i = 2n; i <= BigInt(n); i++) r = r * i % M; return r; };
  const binom = (n, k) => k < 0 || k > n ? 0n : fact(n) * pw(fact(k), M - 2n) % M * pw(fact(n - k), M - 2n) % M;
  const rev = x => +[...String(x)].reverse().join('');
  const runsOf = (s, T, pred, label) => { let t = 0; const runs = s.match(/(.)\1*/g).filter(pred); T.at({ s }); T.n('How many runs to count?', runs.length, 'Split into blocks of the same character.'); for (const r of runs) { const v = r.length * (r.length + 1) / 2; T.at({ s, total: t }); T.n(`Substrings inside the run "${r}"?`, v, `${r.length} times ${r.length + 1}, halved.`); t = (t + v) % MOD; } T.at({ s }); T.n('Total substrings (mod 1e9+7)?', t, 'Add the counts of every run.'); return t; };

  D('number-of-good-pairs', {
    t: 'Number of Good Pairs: each value pairs with its earlier copies',
    r: 'Scan left to right with a count per value: nums[j] forms a good pair with every earlier equal value, so add count[nums[j]] and then increment it.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 3) }),
    s(I, T) { const c = {}; let t = 0; I.nums.forEach((x, j) => { T.at({ nums: A(I.nums, { hl: [j] }), seen: K(c), pairs: t }); T.n(`New good pairs ending at index ${j}?`, c[x] || 0, `Earlier copies of ${x}.`); t += c[x] || 0; c[x] = (c[x] || 0) + 1; }); return t; }
  });

  D('number-of-substrings-with-only-1s', { t: 'Substrings With Only 1s: count each run of ones', r: 'Split into runs. A run of L ones contains L times (L + 1), halved, all-ones substrings; sum them mod 10 to the power 9 + 7.', g: R => ({ s: R.str(R.int(3, 9), '011') }), s: (I, T) => runsOf(I.s, T, r => r[0] === '1') });
  D('count-number-of-homogenous-substrings', { t: 'Count Homogenous Substrings: L times (L+1) divided by 2 per run', r: 'Split into runs of the same letter. A run of length L contains L times (L + 1) divided by 2 homogenous substrings; sum them mod 10 to the power 9 + 7.', g: R => ({ s: R.str(R.int(3, 9), 'aab') }), s: (I, T) => runsOf(I.s, T, () => true) });

  D('water-bottles', {
    t: 'Water Bottles: drink, then exchange the empties',
    r: 'Drink all full bottles, then trade empty divided by numExchange (rounded down) empties for full ones, keeping the remainder. Repeat until you cannot trade.',
    g: R => ({ numBottles: R.int(1, 30), numExchange: R.int(2, 5) }),
    s(I, T) { let full = I.numBottles, empty = 0, drunk = 0; while (full) { drunk += full; empty += full; full = Math.floor(empty / I.numExchange); empty %= I.numExchange; T.at({ drunk, empty, exchange: I.numExchange }); T.n('New full bottles from the exchange?', full, 'empties divided by numExchange, rounded down.'); } return drunk; }
  });

  D('count-odd-numbers-in-an-interval-range', {
    t: 'Count Odd Numbers in a Range: odds up to x',
    r: 'There are half of (x + 1) (rounded down) odd numbers in [0, x]. Answer = odds(high) − odds(low − 1) = (half of (high + 1), rounded down) − (half of low, rounded down).',
    g: R => { const l = R.int(0, 30); return { low: l, high: l + R.int(0, 20) }; },
    s(I, T) { const res = (() => { const a = Math.floor((I.high + 1) / 2), b = Math.floor(I.low / 2); T.at({ low: I.low, high: I.high }); T.n(`Odd numbers in [0, ${I.high}]?`, a, 'high plus 1, halved and rounded down.'); T.n(`Odd numbers in [0, ${I.low - 1}]?`, b, 'low halved, rounded down.'); return a - b; })(); T.n(`Odd numbers from ${I.low} to ${I.high}?`, res, 'Subtract the two counts.'); return res; }
  });

  D('guess-the-majority-in-a-hidden-array', {
    t: 'Guess the Majority in a Hidden Array: compare everyone to index 0',
    r: 'query(a,b,c,d) is 4 (all equal), 2 (3 to 1) or 0 (2 to 2). Fix three indices and swap one in or out: equal answers mean the swapped elements match. Classify every index as same-as-0 or not, then return an index of the bigger group (−1 on a tie).',
    g: R => ({ nums: R.ints(R.int(5, 8), 0, 1) }),
    cmp: (out, exp, I) => { const ones = I.nums.filter(x => x).length, z = I.nums.length - ones; return ones === z ? out === -1 : out >= 0 && I.nums[out] === (ones > z ? 1 : 0); },
    s(I, T) {
      const a = I.nums, n = a.length, q = (...ix) => { const s = ix.reduce((t, i) => t + a[i], 0); return s === 0 || s === 4 ? 4 : s === 1 || s === 3 ? 2 : 0; };
      const same = [true]; const base = q(0, 1, 2, 3); T.at({ hidden: A(a.map(() => '?')) }); T.n('query(0, 1, 2, 3)?', base, '4 = all equal, 2 = three-one, 0 = two-two.');
      for (let i = 4; i < n; i++) same[i] = q(1, 2, 3, i) === base; // swap 0 for i
      const q1234 = q(1, 2, 3, 4); for (let k = 1; k <= 3; k++) { const others = [1, 2, 3].filter(x => x !== k); same[k] = q(0, ...others, 4) === q1234; }
      for (let i = 1; i < Math.min(n, 6); i++) { T.at({ hidden: A(a.map((v, j) => j === 0 || j === i ? v : '?')) }); T.yn(`Is nums[${i}] equal to nums[0]?`, same[i], 'Swapping one index in or out kept the query the same exactly when they match.'); }
      const S = same.filter(Boolean).length, O = n - S; if (S === O) return -1; return S > O ? 0 : same.findIndex(v => !v);
    }
  });

  D('most-visited-sector-in-a-circular-track', {
    t: 'Most Visited Sector: only start and end matter',
    r: 'Full laps add equally to every sector. The extra visits are from rounds[0] to rounds[last]: [start to end] if start at most end, else [1 to end] plus [start to n].',
    g: R => { const n = R.int(2, 6), r = [R.int(1, n)]; for (let i = 0; i < R.int(1, 4); i++) { let x; do x = R.int(1, n); while (x === r[r.length - 1]); r.push(x); } return { n, rounds: r }; },
    s(I, T) { const res = (() => { const s = I.rounds[0], e = I.rounds[I.rounds.length - 1]; T.at({ n: I.n, start: s, end: e }); T.yn('Does the extra stretch wrap past sector n?', s > e, 'Start after end means it wraps.'); const out = []; if (s <= e) for (let i = s; i <= e; i++) out.push(i); else { for (let i = 1; i <= e; i++) out.push(i); for (let i = s; i <= I.n; i++) out.push(i); } return out; })(); T.n('How many sectors are most visited?', res.length, 'Every sector from the start to the end of the final lap.'); T.n('Smallest of them?', res[0], 'Return them in increasing order.'); return res; }
  });

  D('number-of-ways-to-reorder-array-to-get-same-bst', {
    t: 'Reorder Array for the Same BST: interleave the subtrees',
    r: 'The root stays first. Left items (smaller) and right items (larger) keep their own relative order but can interleave: ways = C(L + R, L) times ways(left) times ways(right). Subtract 1 for the original order.',
    g: R => ({ nums: R.shuffle(Array.from({ length: R.int(2, 6) }, (_, i) => i + 1)) }),
    s(I, T) { const res = (() => { const f = a => { if (a.length <= 2) return 1n; const L = a.filter(x => x < a[0]), Rr = a.filter(x => x > a[0]), c = binom(L.length + Rr.length, L.length); T.at({ subtree: A(a, { hl: [0] }), left: A(L), right: A(Rr) }); T.n(`Interleavings of ${L.length} left and ${Rr.length} right items?`, Number(c), `C(${L.length + Rr.length}, ${L.length}).`); return c * f(L) % M * f(Rr) % M; }; return Number((f(I.nums) - 1n + M) % M); })(); T.n('Other orderings that give the same BST (mod 1e9+7)?', res, 'Multiply all interleavings, then subtract the original order.'); return res; }
  });

  D('number-of-ways-to-split-a-string', {
    t: 'Number of Ways to Split a String: zero gaps around the cuts',
    r: 'Total ones must split into thirds t. With no ones, any 2 of the n − 1 cut points: C(n−1, 2). Otherwise the first cut can go anywhere in the zero gap after the t-th one, the second after the 2t-th one: multiply the gap sizes + 1.',
    g: R => ({ s: R.str(R.int(3, 9), '001') }),
    s(I, T) { const s = I.s, n = s.length, pos = []; [...s].forEach((c, i) => c === '1' && pos.push(i)); T.at({ s: A([...s]) }); T.n('Total ones?', pos.length, 'Count them.'); if (!pos.length) return (n - 1) * (n - 2) / 2 % MOD; if (pos.length % 3) return 0; const t = pos.length / 3, g1 = pos[t] - pos[t - 1], g2 = pos[2 * t] - pos[2 * t - 1]; T.n('Choices for the first cut?', g1, `Between one #${t} and one #${t + 1}.`); T.n('Choices for the second cut?', g2, `Between one #${2 * t} and one #${2 * t + 1}.`); return g1 * g2 % MOD; }
  });

  D('coordinate-with-maximum-network-quality', {
    t: 'Coordinate With Maximum Network Quality: try every grid point',
    r: 'Coordinates are small, so try every integer point in the towers\' bounding box. Quality = the sum of q divided by (1 + d), rounded down over towers within radius. Keep the best, smallest coordinate on ties.',
    g: R => ({ towers: Array.from({ length: R.int(1, 3) }, () => [R.int(0, 4), R.int(0, 4), R.int(1, 12)]), radius: R.int(1, 3) }),
    s(I, T) { const tw = I.towers; let best = [-1, 0, 0]; const xs = tw.map(t => t[0]), ys = tw.map(t => t[1]); for (let x = Math.min(...xs); x <= Math.max(...xs); x++) for (let y = Math.min(...ys); y <= Math.max(...ys); y++) { let q = 0; for (const [a, b, c] of tw) { const d = Math.hypot(a - x, b - y); if (d <= I.radius) q += Math.floor(c / (1 + d)); } if (q > best[0]) best = [q, x, y]; } for (const [a, b] of tw.slice(0, 3)) { let q = 0; for (const [p, r, c] of tw) { const d = Math.hypot(p - a, r - b); if (d <= I.radius) q += Math.floor(c / (1 + d)); } T.at({ towers: A(tw.map(t => `(${t[0]},${t[1]}) q${t[2]}`)), radius: I.radius }); T.n(`Quality at (${a},${b})?`, q, 'the sum of q divided by (1 + d), rounded down for towers within the radius.'); } T.n('Best quality anywhere?', best[0], 'Scan every grid point.'); return [best[1], best[2]]; }
  });

  D('kth-smallest-instructions', {
    t: 'k-th Smallest Instructions: count strings that start with H',
    r: 'With h H\'s and v V\'s left, C(h − 1 + v, v) strings start with H. If k at most that, write H; otherwise write V and subtract that count from k.',
    g: R => { const r = R.int(1, 3), c = R.int(1, 3); let t = 1; for (let i = 1; i <= r; i++) t = t * (r + c - i + 1) / i; return { destination: [r, c], k: R.int(1, Math.round(t)) }; },
    s(I, T) { let v = I.destination[0], h = I.destination[1], k = I.k, out = ''; const C = (n, r) => { let x = 1; for (let i = 1; i <= r; i++) x = x * (n - i + 1) / i; return Math.round(x); }; while (h && v) { const c = C(h - 1 + v, v); T.at({ H: h, V: v, k, built: out || '—' }); T.n('Strings starting with H from here?', c, `C(${h - 1 + v}, ${v}).`); if (k <= c) { out += 'H'; h--; } else { out += 'V'; v--; k -= c; } } return out + 'H'.repeat(h) + 'V'.repeat(v); }
  });

  D('calculate-money-in-leetcode-bank', {
    t: 'Calculate Money in Leetcode Bank: weeks plus leftover days',
    r: 'Week w (0-based) deposits 28 + 7w. The leftover d days of the next week deposit (w + 1) + … + (w + d).',
    g: R => ({ n: R.int(1, 40) }),
    s(I, T) { const res = (() => { const w = Math.floor(I.n / 7), d = I.n % 7; let full = 0; for (let i = 0; i < w; i++) full += 28 + 7 * i; T.at({ n: I.n, weeks: w, extraDays: d }); T.n('Money from the full weeks?', full, 'Week w adds 28 plus 7 times w.'); let ext = 0; for (let i = 1; i <= d; i++) ext += w + i; T.n('Money from the leftover days?', ext, `Days start at ${w + 1}.`); return full + ext; })(); T.n('Total money?', res, 'Full weeks plus leftover days.'); return res; }
  });

  D('tuple-with-same-product', {
    t: 'Tuple With Same Product: count equal-product pairs',
    r: 'Count every pair product. Two different pairs with the same product make 8 ordered tuples, so add 8 times C(c, 2) for each product seen c times.',
    g: R => ({ nums: R.distinct(R.int(3, 6), 1, 12) }),
    s(I, T) { const res = (() => { const c = {}; const a = I.nums; for (let i = 0; i < a.length; i++) for (let j = i + 1; j < a.length; j++) c[a[i] * a[j]] = (c[a[i] * a[j]] || 0) + 1; T.at({ nums: A(a) }); T.n('Pairs in total?', a.length * (a.length - 1) / 2, 'Every pair gives one product.'); let t = 0; for (const [p, v] of Object.entries(c)) if (v > 1) { T.at({ products: K(Object.entries(c).filter(x => x[1] > 1)) }); T.n(`Tuples from product ${p} (${v} pairs)?`, 8 * v * (v - 1) / 2, '8 times the number of ways to choose 2 of those pairs.'); t += 8 * v * (v - 1) / 2; } T.at({ nums: A(a) }); T.n('Pairs with a repeated product?', Object.values(c).filter(v => v > 1).reduce((s, v) => s + v, 0), 'Count every pair whose product appears more than once.'); return t; })(); T.n('Total tuples?', res, 'Add the tuples from every repeated product.'); return res; }
  });

  D('count-ways-to-make-array-with-product', {
    t: 'Ways to Make an Array With a Product: stars and bars per prime',
    r: 'Factor k. Each prime power p to the power e is spread over n slots in C(n + e − 1, e) ways, independently. Multiply over the primes (mod 10 to the power 9 + 7).',
    g: R => ({ queries: Array.from({ length: R.int(1, 3) }, () => [R.int(1, 6), R.int(1, 60)]) }),
    s(I, T) { return I.queries.map(([n, k]) => { let r = 1n, x = k; for (let p = 2; p * p <= x || x > 1; p++) { if (p * p > x) p = x; let e = 0; while (x % p === 0) { x /= p; e++; } if (!e) continue; const w = binom(n + e - 1, e); T.at({ n, k, prime: `${p} to the power ${e}` }); T.n(`Ways to spread ${p} to the power ${e} over ${n} slots?`, Number(w), `C(${n + e - 1}, ${e}).`); r = r * w % M; } return Number(r); }); }
  });

  D('maximum-number-of-balls-in-a-box', {
    t: 'Maximum Number of Balls in a Box: bucket by digit sum',
    r: 'Each ball goes to the box numbered by its digit sum. Count per box and return the largest count.',
    g: R => { const l = R.int(1, 40); return { lowLimit: l, highLimit: l + R.int(0, 30) }; },
    s(I, T) { const res = (() => { const c = {}; for (let i = I.lowLimit; i <= I.highLimit; i++) { const s = [...String(i)].reduce((a, d) => a + +d, 0); c[s] = (c[s] || 0) + 1; } const best = Object.entries(c).sort((a, b) => b[1] - a[1] || a[0] - b[0])[0]; T.at({ boxes: K(c) }); T.n(`Box for ball ${I.lowLimit}?`, [...String(I.lowLimit)].reduce((a, d) => a + +d, 0), 'Its digit sum.'); T.n('Which box gets the most balls (smallest on ties)?', +best[0], 'The digit sum with the biggest count.'); return best[1]; })(); T.n('Balls in that box?', res, 'The largest count.'); return res; }
  });

  D('find-nearest-point-that-has-the-same-x-or-y-coordinate', {
    t: 'Nearest Point With the Same x or y',
    r: 'A point is valid if it shares x or y with you. Among valid points take the smallest Manhattan distance, smallest index on ties; −1 if none.',
    g: R => ({ x: R.int(1, 4), y: R.int(1, 4), points: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 4), R.int(1, 4)]) }),
    s(I, T) { let best = -1, bd = Infinity; I.points.forEach(([a, b], i) => { const ok = a === I.x || b === I.y; T.at({ you: `(${I.x},${I.y})`, points: A(I.points.map(p => `(${p})`), { hl: [i] }), best }); T.yn(`Is (${a},${b}) valid?`, ok, 'Same x or same y.'); if (ok) { const d = Math.abs(a - I.x) + Math.abs(b - I.y); if (d < bd) { bd = d; best = i; } } }); return best; }
  });

  D('check-if-number-is-a-sum-of-powers-of-three', {
    t: 'Sum of Distinct Powers of Three: base-3 digits 0 or 1',
    r: 'Write n in base 3. Distinct powers are possible exactly when no digit is 2.',
    g: R => ({ n: R.int(1, 120) }),
    s(I, T) { let n = I.n; while (n) { T.at({ n }); T.n(`${n} mod 3?`, n % 3, 'Next base-3 digit.'); if (n % 3 === 2) return false; n = Math.floor(n / 3); } return true; }
  });

  D('minimum-number-of-operations-to-reinitialize-a-permutation', {
    t: 'Reinitialize a Permutation: follow index 1',
    r: 'The operation moves the value at i to 2i mod (n − 1) (with n − 1 fixed). The permutation returns when index 1 returns, so count steps until it does.',
    g: R => ({ n: 2 * R.int(1, 8) }),
    s(I, T) { if (I.n === 2) return 1; let p = 1, c = 0; do { p = 2 * p % (I.n - 1); c++; T.at({ n: I.n, step: c }); T.n('Where is the value 1 now?', p, '2 times i mod (n − 1).'); } while (p !== 1); return c; }
  });

  D('maximize-number-of-nice-divisors', {
    t: 'Maximize Nice Divisors: split into threes',
    r: 'Nice divisors = product of the prime exponents, so split primeFactors into parts with the largest product: as many 3s as possible, using 2 times 2 instead of 3 times 1.',
    g: R => ({ primeFactors: R.int(1, 30) }),
    s(I, T) { const res = (() => { const n = I.primeFactors; if (n <= 3) { T.at({ primeFactors: n }); T.yn('Is primeFactors 3 or fewer?', true, 'Then one prime repeated n times is best.'); T.n('How many different primes?', 1, 'Keep every factor on one prime.'); return n; } const r = n % 3, threes = r === 1 ? (n - 4) / 3 : Math.floor(n / 3); T.at({ primeFactors: n }); T.n('Remainder when divided by 3?', r, 'It decides whether to use 2s.'); T.n('How many parts of size 3?', threes, r === 1 ? 'Remainder 1: use two 2s instead of a 3 and a 1.' : r === 2 ? 'Remainder 2: one extra 2.' : 'All threes.'); return Number(pw(3, threes) * BigInt(r === 1 ? 4 : r === 2 ? 2 : 1) % M); })(); T.n('Most nice divisors (mod 1e9+7)?', res, 'Multiply the part sizes.'); return res; }
  });

  D('determine-color-of-a-chessboard-square', {
    t: 'Chessboard Square Color: parity of file + rank',
    r: 'a1 is black. A square is white when (file index + rank) is odd.',
    g: R => ({ coordinates: 'abcdefgh'[R.int(0, 7)] + R.int(1, 8) }),
    s(I, T) { const res = (() => { const s = I.coordinates.charCodeAt(0) - 96 + +I.coordinates[1]; T.at({ square: I.coordinates }); T.n('File number, with a as 1?', I.coordinates.charCodeAt(0) - 96, 'Position of the letter.'); T.n('File number plus rank?', s, 'Add them.'); return s % 2 === 1; })(); T.yn('Is the square white?', res, 'White when the sum is odd.'); return res; }
  });

  D('count-nice-pairs-in-an-array', {
    t: 'Count Nice Pairs: group by x − rev(x)',
    r: 'nums[i] + rev(nums[j]) = nums[j] + rev(nums[i]) exactly when nums[i] − rev(nums[i]) = nums[j] − rev(nums[j]). Count equal keys left to right.',
    g: R => ({ nums: R.ints(R.int(2, 6), 0, 99) }),
    s(I, T) { const c = {}; let t = 0; I.nums.forEach((x, i) => { const k = x - rev(x); T.at({ nums: A(I.nums, { hl: [i] }), keys: K(c) }); T.n(`Key ${x} − rev(${x})?`, k, `rev(${x}) = ${rev(x)}.`); t = (t + (c[k] || 0)) % MOD; c[k] = (c[k] || 0) + 1; }); return t; }
  });

  D('number-of-different-subsequences-gcds', {
    t: 'Different Subsequence GCDs: test every candidate g',
    r: 'For each g up to max, take the gcd of all present multiples of g. g is achievable exactly when that gcd equals g.',
    g: R => ({ nums: R.ints(R.int(2, 5), 1, 20) }),
    s(I, T) { const S = new Set(I.nums), mx = Math.max(...I.nums); let c = 0; for (let g = 1; g <= mx; g++) { let x = 0; for (let m = g; m <= mx; m += g) if (S.has(m)) x = gcd(x, m); if (x === 0) continue; const ok = x === g; T.at({ nums: A([...S].sort((a, b) => a - b)), g }); T.yn(`Is ${g} the gcd of some subsequence?`, ok, `gcd of present multiples of ${g} is ${x}.`); if (ok) c++; } return c; }
  });

  D('sign-of-the-product-of-an-array', {
    t: 'Sign of the Product: count negatives, watch for zero',
    r: 'Any zero makes the product 0. Otherwise the sign is −1 for an odd number of negatives, 1 for even.',
    g: R => ({ nums: R.ints(R.int(1, 6), -5, 5) }),
    s(I, T) { const res = (() => { T.at({ nums: A(I.nums) }); const z = I.nums.includes(0); T.yn('Is there a zero?', z, 'A zero makes the product 0.'); if (z) { T.n('How many zeros?', I.nums.filter(x => x === 0).length, 'Any one of them is enough.'); return 0; } const neg = I.nums.filter(x => x < 0).length; T.n('How many negatives?', neg, 'Their parity decides the sign.'); return neg % 2 ? -1 : 1; })(); T.n('Sign of the product?', res, '1, minus 1 or 0.'); return res; }
  });

  D('find-the-winner-of-the-circular-game', {
    t: 'Find the Winner of the Circular Game: Josephus recurrence',
    r: 'With i players the winner\'s 0-based seat is f(i) = (f(i − 1) + k) mod i, starting from f(1) = 0. Answer f(n) + 1.',
    g: R => { const n = R.int(1, 8); return { n, k: R.int(1, n) }; },
    s(I, T) { let f = 0; for (let i = 2; i <= I.n; i++) { f = (f + I.k) % i; T.at({ k: I.k, players: i }); T.n(`Winner seat (0-based) with ${i} players?`, f, '(previous + k) mod i.'); } return f + 1; }
  });

  D('queries-on-number-of-points-inside-a-circle', {
    t: 'Points Inside a Circle: squared distance test',
    r: 'For each query circle, count the points with (x − cx)² + (y − cy)² at most r² (boundary counts).',
    g: R => ({ points: Array.from({ length: R.int(2, 5) }, () => [R.int(0, 5), R.int(0, 5)]), queries: Array.from({ length: R.int(1, 3) }, () => [R.int(0, 5), R.int(0, 5), R.int(1, 3)]) }),
    s(I, T) { return I.queries.map(([x, y, r]) => { const c = I.points.filter(([a, b]) => (a - x) ** 2 + (b - y) ** 2 <= r * r).length; T.at({ points: A(I.points.map(p => `(${p})`)), circle: `center (${x},${y}), r ${r}` }); T.n('Points inside or on this circle?', c, 'Compare squared distance with r².'); return c; }); }
  });

  D('minimum-number-of-operations-to-make-string-sorted', {
    t: 'Operations to Make a String Sorted: rank among permutations',
    r: 'Each operation steps to the previous permutation, so the answer is the rank of s among the distinct permutations of its letters: the sum over i of (letters smaller than s[i] after i) times (arrangements of the rest).',
    g: R => ({ s: R.str(R.int(2, 5), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, cnt = Array(26).fill(0); let tot = 0n; for (let i = n - 1; i >= 0; i--) { cnt[s.charCodeAt(i) - 97]++; let smaller = 0; for (let c = 0; c < s.charCodeAt(i) - 97; c++) smaller += cnt[c]; let ways = fact(n - i - 1); for (const v of cnt) ways = ways * pw(fact(v), M - 2n) % M; const contrib = BigInt(smaller) * ways % M; T.at({ s: A([...s], { hl: [i] }) }); T.n(`Letters after index ${i} smaller than "${s[i]}"?`, smaller, 'Each could start a smaller permutation here.'); tot = (tot + contrib) % M; } return Number(tot); }
  });

  D('sum-of-digits-in-base-k', {
    t: 'Sum of Digits in Base k',
    r: 'Repeatedly take n mod k (a base-k digit), add it, and divide n by k.',
    g: R => ({ n: R.int(1, 100), k: R.int(2, 10) }),
    s(I, T) { let n = I.n, s = 0; while (n) { T.at({ n, k: I.k, sum: s }); T.n(`${n} mod ${I.k}?`, n % I.k, 'Next base-k digit.'); s += n % I.k; n = Math.floor(n / I.k); } return s; }
  });

  D('incremental-memory-leak', {
    t: 'Incremental Memory Leak: take i bits from the fuller stick',
    r: 'At second i, take i bits from the stick with more free memory (stick 1 on ties). Stop when neither has i bits; return [i, memory1, memory2].',
    g: R => ({ memory1: R.int(0, 15), memory2: R.int(0, 15) }),
    s(I, T) { let a = I.memory1, b = I.memory2; for (let i = 1; ; i++) { if (Math.max(a, b) < i) return [i, a, b]; T.at({ second: i, memory1: a, memory2: b }); T.c(`Second ${i}: which stick loses ${i} bits?`, ['stick 1', 'stick 2'], a >= b ? 'stick 1' : 'stick 2', 'The one with more free memory (stick 1 on ties).'); if (a >= b) a -= i; else b -= i; } }
  });

  D('check-if-word-equals-summation-of-two-words', {
    t: 'Word Equals Summation of Two Words: letters as digits',
    r: 'Map a to 0 … j to 9, read each word as a number, and check first + second = target.',
    g: R => { const f = R.str(R.int(1, 3), 'abcdefghij'), s = R.str(R.int(1, 3), 'abcdefghij'); const v = w => +[...w].map(c => c.charCodeAt(0) - 97).join(''); const t = R.chance(0.6) ? [...String(v(f) + v(s))].map(d => String.fromCharCode(97 + +d)).join('') : R.str(R.int(1, 3), 'abcdefghij'); return { firstWord: f, secondWord: s, targetWord: t }; },
    s(I, T) { const v = w => +[...w].map(c => c.charCodeAt(0) - 97).join(''); T.at({ first: I.firstWord, second: I.secondWord, target: I.targetWord }); T.n('Value of firstWord?', v(I.firstWord), 'Letters as digits.'); T.n('Value of secondWord?', v(I.secondWord), 'Letters as digits.'); T.n('Value of targetWord?', v(I.targetWord), 'Letters as digits.'); return v(I.firstWord) + v(I.secondWord) === v(I.targetWord); }
  });

  D('the-number-of-full-rounds-you-have-played', {
    t: 'Number of Full Rounds Played: round inward to 15 minutes',
    r: 'Convert to minutes; if logout < login, add 1440. Round login up and logout down to multiples of 15; full rounds = max(0, (out − in) divided by 15).',
    g: R => { const t = () => `${String(R.int(0, 23)).padStart(2, '0')}:${String(R.int(0, 59)).padStart(2, '0')}`; let a = t(), b = t(); while (a === b) b = t(); return { loginTime: a, logoutTime: b }; },
    s(I, T) { const res = (() => { const m = s => +s.slice(0, 2) * 60 + +s.slice(3); let a = m(I.loginTime), b = m(I.logoutTime); if (b < a) b += 1440; const s = Math.ceil(a / 15) * 15, e = Math.floor(b / 15) * 15; T.at({ login: I.loginTime, logout: I.logoutTime }); T.n('First full round starts at minute?', s, 'Round login up to 15.'); T.n('Last full round ends at minute (after midnight adds 1440)?', e, 'Round logout down to 15.'); return Math.max(0, (e - s) / 15); })(); T.n('Full rounds played?', res, 'Gap divided by 15, or 0.'); return res; }
  });

  D('count-good-numbers', {
    t: 'Count Good Numbers: 5 choices at even positions, 4 at odd',
    r: 'Even indices ((half of n, rounded up) of them) take 0, 2, 4, 6, 8; odd indices ((half of n, rounded down)) take 2, 3, 5, 7. Answer 5 to the power (half of n, rounded up) times 4 to the power half of n, rounded down with fast power.',
    g: R => ({ n: R.int(1, 30) }),
    s(I, T) { const res = (() => { const e = Math.ceil(I.n / 2), o = Math.floor(I.n / 2); T.at({ n: I.n }); T.n('How many even positions?', e, 'Half of n, rounded up.'); T.n('How many odd positions?', o, 'Half of n, rounded down.'); return Number(pw(5, e) * pw(4, o) % M); })(); T.n('Good digit strings (mod 1e9+7)?', res, '5 choices at each even position, 4 at each odd one.'); return res; }
  });

  D('count-square-sum-triples', {
    t: 'Count Square Sum Triples: check every (a, b)',
    r: 'For each a, b at most n, c = √(a² + b²) must be an integer at most n. Ordered pairs count separately.',
    g: R => ({ n: R.int(1, 20) }),
    s(I, T) { let t = 0; for (let c = 1; c <= I.n; c++) { let k = 0; for (let a = 1; a < c; a++) { const b = Math.round(Math.sqrt(c * c - a * a)); if (b >= 1 && a * a + b * b === c * c) k++; } if (k) { T.at({ n: I.n, c }); T.n(`Ordered (a, b) with a² + b² = ${c}²?`, k, 'Try every a below c.'); } t += k; } return t; }
  });

  D('three-divisors', {
    t: 'Three Divisors: squares of primes',
    r: 'Exactly three divisors means n = p² for a prime p (divisors 1, p, p²). Equivalently count divisors up to √n.',
    g: R => ({ n: R.pick([4, 9, 25, 49, R.int(1, 100)]) }),
    s(I, T) { const res = (() => { let c = 0; for (let d = 1; d * d <= I.n; d++) if (I.n % d === 0) c += d * d === I.n ? 1 : 2; T.at({ n: I.n }); T.yn('Is n a perfect square?', Number.isInteger(Math.sqrt(I.n)), 'Only squares have an odd number of divisors.'); T.n('Number of divisors?', c, 'Divisors pair up as d and n divided by d; a square root counts once.'); return c === 3; })(); T.yn('Exactly three divisors?', res, 'Only squares of primes.'); return res; }
  });

  D('find-greatest-common-divisor-of-array', {
    t: 'GCD of the Min and Max: Euclid',
    r: 'Take the smallest and largest values and run Euclid: gcd(a, b) = gcd(b, a mod b).',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 60) }),
    s(I, T) { let a = Math.max(...I.nums), b = Math.min(...I.nums); while (b) { T.at({ a, b }); T.n(`${a} mod ${b}?`, a % b, 'Euclid step.'); [a, b] = [b, a % b]; } return a; }
  });

  D('find-unique-binary-string', {
    t: 'Find Unique Binary String: Cantor\'s diagonal',
    r: 'Flip the i-th bit of the i-th string. The result differs from every string in at least one position.',
    g: R => { const n = R.int(1, 4), s = new Set(); while (s.size < n) s.add(R.str(n, '01')); return { nums: [...s] }; },
    cmp: (out, exp, I) => typeof out === 'string' && out.length === I.nums.length && /^[01]+$/.test(out) && !I.nums.includes(out),
    s(I, T) { let out = ''; I.nums.forEach((s, i) => { const b = s[i] === '0' ? '1' : '0'; T.at({ nums: A(I.nums, { hl: [i] }), built: out || '—' }); T.n(`Bit ${i} of the answer?`, +b, `Flip bit ${i} of "${s}".`); out += b; }); return out; }
  });

  D('number-of-pairs-of-interchangeable-rectangles', {
    t: 'Interchangeable Rectangles: group by reduced ratio',
    r: 'Reduce each width or height by their gcd and use it as a key. Each rectangle pairs with every earlier one of the same key.',
    g: R => ({ rectangles: Array.from({ length: R.int(2, 6) }, () => { const k = R.int(1, 4); return R.pick([[1, 2], [2, 3], [1, 1], [3, 4]]).map(x => x * k); }) }),
    s(I, T) { const c = {}; let t = 0; I.rectangles.forEach(([w, h], i) => { const g = gcd(w, h), k = `${w / g}/${h / g}`; T.at({ rectangles: A(I.rectangles.map(r => `${r[0]} by ${r[1]}`), { hl: [i] }), ratios: K(c) }); T.n(`Earlier rectangles with ratio ${k}?`, c[k] || 0, 'Each forms a pair.'); t += c[k] || 0; c[k] = (c[k] || 0) + 1; }); return t; }
  });
})();
