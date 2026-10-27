/* v2 games: math (07). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const isPrime = n => { if (n < 2) return false; for (let d = 2; d * d <= n; d++) if (n % d === 0) return false; return true; };
  const dsum = x => [...String(x)].reduce((a, c) => a + +c, 0);
  const middleMode = (I, T) => { const a = I.nums, n = a.length; let tot = 0; for (let m = 2; m < n - 2; m++) { let c = 0; for (let i = 0; i < m; i++) for (let j = i + 1; j < m; j++) for (let k = m + 1; k < n; k++) for (let l = k + 1; l < n; l++) { const s = [a[i], a[j], a[m], a[k], a[l]], f = {}; s.forEach(x => f[x] = (f[x] || 0) + 1); const fm = f[a[m]]; if (Object.entries(f).every(([v, q]) => +v === a[m] || q < fm)) c++; } T.at({ nums: A(a, { hl: [m] }) }); T.n(`Subsequences with index ${m} in the middle and a unique middle mode?`, c, 'Choose 2 on the left and 2 on the right; the middle value must be strictly most frequent.'); tot += c; } return tot % (1e9 + 7); };
  const reduceDigits = (I, T) => { let s = [...I.s].map(Number); while (s.length > 2) { s = s.slice(1).map((v, i) => (s[i] + v) % 10); T.at({ digits: A(s) }); T.n(`First digit of the length-${s.length} row?`, s[0], 'Neighbor sums mod 10.'); } return s[0] === s[1]; };

  D('water-bottles-ii', {
    t: 'Water Bottles II: the exchange rate rises each time',
    r: 'Drink everything; then while you have at least numExchange empties, trade them for one full bottle (drink it: +1 drunk, +1 empty) and numExchange grows by 1.',
    g: R => ({ numBottles: R.int(1, 30), numExchange: R.int(1, 6) }),
    s(I, T) { let drunk = I.numBottles, empty = I.numBottles, ex = I.numExchange; while (empty >= ex) { empty -= ex; ex++; drunk++; empty++; T.at({ drunk, empty, rate: ex }); T.n('Bottles drunk so far?', drunk, 'One more from the exchange.'); } return drunk; }
  });

  D('count-alternating-subarrays', {
    t: 'Count Alternating Subarrays: running alternating length',
    r: 'len = len + 1 if nums[i] differs from nums[i − 1], else 1. Each index ends len alternating subarrays.',
    g: R => ({ nums: R.ints(R.int(2, 8), 0, 1) }),
    s(I, T) { let len = 0, t = 0; I.nums.forEach((x, i) => { len = i && x !== I.nums[i - 1] ? len + 1 : 1; T.at({ nums: A(I.nums, { hl: [i] }), total: t }); T.n(`Alternating subarrays ending at ${i}?`, len, 'Current alternating run length.'); t += len; }); return t; }
  });

  D('maximum-prime-difference', {
    t: 'Maximum Prime Difference: first and last prime',
    r: 'The farthest pair is the first prime index and the last prime index.',
    g: R => { const a = R.ints(R.int(2, 7), 1, 20); if (!a.some(isPrime)) a[R.int(0, a.length - 1)] = 7; return { nums: a }; },
    s(I, T) { const res = (() => { const f = I.nums.findIndex(isPrime), l = I.nums.length - 1 - [...I.nums].reverse().findIndex(isPrime); T.at({ nums: A(I.nums) }); T.n('Index of the first prime?', f, 'Scan from the left.'); T.n('Index of the last prime?', l, 'Scan from the right.'); return l - f; })(); T.n('Maximum distance?', res, 'Last prime index minus first prime index.'); return res; }
  });

  D('right-triangles', {
    t: 'Right Triangles: row and column counts',
    r: 'Count 1s per row and per column. A 1 at (r, c) is the right-angle corner of (row[r] − 1) times (col[c] − 1) triangles.',
    g: R => ({ grid: R.grid(R.int(2, 3), R.int(2, 4), 0, 1) }),
    s(I, T) { const g = I.grid, rw = g.map(r => r.reduce((a, b) => a + b, 0)), cl = g[0].map((_, j) => g.reduce((a, r) => a + r[j], 0)); let t = 0; g.forEach((r, i) => r.forEach((v, j) => { if (!v) return; const k = (rw[i] - 1) * (cl[j] - 1); T.at({ grid: G(g, { hl: [[i, j]] }), rows: A(rw), cols: A(cl) }); T.n(`Triangles with the corner at (${i},${j})?`, k, `(${rw[i]} − 1) times (${cl[j]} − 1).`); t += k; })); return t; }
  });

  D('sum-of-digit-differences-of-all-pairs', {
    t: 'Sum of Digit Differences: count per position',
    r: 'For each digit position, count each digit. Differing pairs there = C(n, 2) − the sum of C(count, 2). Add over positions.',
    g: R => { const L = R.int(1, 3); return { nums: Array.from({ length: R.int(2, 5) }, () => +('1' + R.str(L - 1, '0123'))) }; },
    s(I, T) { const s = I.nums.map(String), n = s.length, L = s[0].length; let t = 0; for (let p = 0; p < L; p++) { const c = {}; s.forEach(x => c[x[p]] = (c[x[p]] || 0) + 1); const d = n * (n - 1) / 2 - Object.values(c).reduce((a, v) => a + v * (v - 1) / 2, 0); T.at({ nums: A(s), position: p, digits: K(c) }); T.n(`Pairs that differ at position ${p}?`, d, 'All pairs minus same-digit pairs.'); t += d; } return t; }
  });

  D('find-the-child-who-has-the-ball-after-k-seconds', {
    t: 'Child With the Ball After k Seconds: bounce period 2(n − 1)',
    r: 'Reduce k mod 2(n − 1). If it is < n the ball is at child k; otherwise it is coming back: child 2(n − 1) − k.',
    g: R => ({ n: R.int(2, 8), k: R.int(1, 30) }),
    s(I, T) { const res = (() => { const c = 2 * (I.n - 1), t = I.k % c; T.at({ n: I.n, k: I.k }); T.n('Seconds for a full round trip?', c, 'Out and back: 2 times (n minus 1).'); T.n(`Remainder of k divided by ${c}?`, t, 'Remove full round trips.'); return t < I.n ? t : c - t; })(); T.n('Child with the ball?', res, 'Going right, or coming back.'); return res; }
  });

  D('find-minimum-operations-to-make-all-elements-divisible-by-three', {
    t: 'Make Elements Divisible by Three: one step each',
    r: 'A number with remainder 1 or 2 is one step from a multiple of 3. Count the non-multiples.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 20) }),
    s(I, T) { let c = 0; I.nums.forEach((x, i) => { T.at({ nums: A(I.nums, { hl: [i] }), ops: c }); T.n(`Operations for ${x}?`, x % 3 ? 1 : 0, x % 3 ? 'Remainder 1 or 2: one step.' : 'Already a multiple.'); if (x % 3) c++; }); return c; }
  });

  D('maximum-height-of-a-triangle', {
    t: 'Maximum Height of a Triangle: try both starting colors',
    r: 'Rows alternate colors and row i needs i balls. Try starting with red and with blue; keep building while the needed color has enough. Take the taller.',
    g: R => ({ red: R.int(1, 20), blue: R.int(1, 20) }),
    s(I, T) { const res = (() => { const h = (a, b) => { const c = [a, b]; let i = 1; while (c[(i - 1) % 2] >= i) { c[(i - 1) % 2] -= i; i++; } return i - 1; }; const r = h(I.red, I.blue), b = h(I.blue, I.red); T.at({ red: I.red, blue: I.blue }); T.n('Height starting with red?', r, 'Odd rows red, even rows blue.'); T.n('Height starting with blue?', b, 'Odd rows blue, even rows red.'); return Math.max(r, b); })(); T.n('Maximum height?', res, 'The better starting colour.'); return res; }
  });

  D('find-if-digit-game-can-be-won', {
    t: 'Digit Game: compare the two sums',
    r: 'Alice takes all single-digit or all double-digit numbers. She wins with one choice exactly when the two sums differ.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 99) }),
    s(I, T) { const res = (() => { const s1 = I.nums.filter(x => x < 10).reduce((a, b) => a + b, 0), s2 = I.nums.filter(x => x >= 10).reduce((a, b) => a + b, 0); T.at({ nums: A(I.nums) }); T.n('Sum of single-digit numbers?', s1, 'Below 10.'); T.n('Sum of double-digit numbers?', s2, '10 and up.'); return s1 !== s2; })(); T.yn('Can Alice win?', res, 'She wins if the sums differ.'); return res; }
  });

  D('find-the-count-of-numbers-which-are-not-special', {
    t: 'Numbers That Are Not Special: squares of primes',
    r: 'Exactly two proper divisors (1 and p) means x = p² for a prime p. Count primes p with l at most p² at most r and subtract from the range size.',
    g: R => { const l = R.int(1, 60); return { l, r: l + R.int(0, 120) }; },
    s(I, T) { let c = 0; for (let p = 2; p * p <= I.r; p++) if (isPrime(p) && p * p >= I.l) { c++; T.at({ l: I.l, r: I.r, special: c }); T.n(`${p} is prime. Which special number does it give?`, p * p, 'p² has proper divisors 1 and p only.'); } return I.r - I.l + 1 - c; }
  });

  D('find-the-key-of-the-numbers', {
    t: 'Find the Key: digit-wise minimum',
    r: 'Pad all three to 4 digits; each key digit is the minimum of the three digits in that position. Return it as a number (leading zeros drop).',
    g: R => ({ num1: R.int(1, 9999), num2: R.int(1, 9999), num3: R.int(1, 9999) }),
    s(I, T) { const s = [I.num1, I.num2, I.num3].map(x => String(x).padStart(4, '0')); let k = ''; for (let i = 0; i < 4; i++) { const d = Math.min(...s.map(x => +x[i])); T.at({ padded: A(s), key: k || '—' }); T.n(`Key digit ${i}?`, d, 'Minimum of the three.'); k += d; } return +k; }
  });

  D('check-if-two-chessboard-squares-have-the-same-color', {
    t: 'Same Chessboard Color: compare parities',
    r: 'A square\'s color is the parity of (file + rank). Two squares match when the parities match.',
    g: R => ({ coordinate1: 'abcdefgh'[R.int(0, 7)] + R.int(1, 8), coordinate2: 'abcdefgh'[R.int(0, 7)] + R.int(1, 8) }),
    s(I, T) { const res = (() => { const p = c => (c.charCodeAt(0) - 96 + +c[1]) % 2; T.at({ a: I.coordinate1, b: I.coordinate2 }); T.n(`Parity of file plus rank for ${I.coordinate1}?`, p(I.coordinate1), 'Count a as 1.'); T.n(`Parity for ${I.coordinate2}?`, p(I.coordinate2), 'Count a as 1.'); return p(I.coordinate1) === p(I.coordinate2); })(); T.yn('Same color?', res, 'Equal parity means the same color.'); return res; }
  });

  D('convert-date-to-binary', {
    t: 'Convert Date to Binary: each part on its own',
    r: 'Split "yyyy-mm-dd", convert each part to binary without leading zeros, and join with dashes.',
    g: R => ({ date: `${R.int(1900, 2100)}-${String(R.int(1, 12)).padStart(2, '0')}-${String(R.int(1, 28)).padStart(2, '0')}` }),
    s(I, T) { const res = (() => { const p = I.date.split('-').map(Number); T.at({ date: I.date }); T.n('How many binary digits does the month have?', p[1].toString(2).length, `Month ${p[1]}.`); T.n('How many binary digits does the day have?', p[2].toString(2).length, `Day ${p[2]}.`); return p.map(x => x.toString(2)).join('-'); })(); T.n('Binary digits in the year?', (+I.date.slice(0, 4)).toString(2).length, 'Write the year in binary.'); return res; }
  });

  D('the-two-sneaky-numbers-of-digitville', {
    t: 'Two Sneaky Numbers: count and report repeats',
    r: 'Count occurrences (or mark seen); the two values that appear twice are the answer.',
    g: R => { const n = R.int(2, 7), a = [...Array(n).keys()], d = R.distinct(2, 0, n - 1); return { nums: R.shuffle([...a, ...d]) }; }, cmp: 'set',
    s(I, T) { const seen = new Set(), out = []; I.nums.forEach((x, i) => { const dup = seen.has(x); T.at({ nums: A(I.nums, { hl: [i] }), seen: A([...seen]) }); T.yn(`Is ${x} a repeat?`, dup, dup ? 'Already seen.' : 'First time.'); if (dup) out.push(x); seen.add(x); }); return out; }
  });

  D('minimum-element-after-replacement-with-digit-sum', {
    t: 'Minimum After Replacing With Digit Sums',
    r: 'Replace each number by its digit sum and take the minimum.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 9999) }),
    s(I, T) { let m = Infinity; I.nums.forEach((x, i) => { T.at({ nums: A(I.nums, { hl: [i] }), min: m === Infinity ? '—' : m }); T.n(`Digit sum of ${x}?`, dsum(x), 'Add the digits.'); m = Math.min(m, dsum(x)); }); return m; }
  });

  D('find-the-maximum-factor-score-of-array', {
    t: 'Maximum Factor Score: try removing each element',
    r: 'Score = gcd times lcm of the remaining array (0 if empty). Try removing nothing and removing each index (prefix or suffix gcd and lcm make it O(n)).',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 12) }),
    s(I, T) { const sc = a => { if (!a.length) return 0; let g = 0, l = 1; a.forEach(x => { g = gcd(g, x); l = l / gcd(l, x) * x; }); return g * l; }; let best = sc(I.nums); T.at({ nums: A(I.nums) }); T.n('Score with nothing removed?', best, 'gcd times lcm.'); I.nums.forEach((_, i) => { const v = sc(I.nums.filter((__, j) => j !== i)); T.at({ nums: A(I.nums, { dim: [i] }) }); T.n(`Score without index ${i}?`, v, 'gcd times lcm of the rest.'); best = Math.max(best, v); }); return best; }
  });

  D('smallest-divisible-digit-product-i', {
    t: 'Smallest Divisible Digit Product I: scan upward',
    r: 'Within 10 numbers some contains a 0 (product 0, divisible by anything), so just scan from n.',
    g: R => ({ n: R.int(1, 100), t: R.int(1, 10) }),
    s(I, T) { for (let x = I.n; ; x++) { const p = [...String(x)].reduce((a, c) => a * +c, 1); T.at({ x, t: I.t }); T.n(`Digit product of ${x}?`, p, 'Multiply the digits.'); if (p % I.t === 0) return x; } }
  });

  D('stone-removal-game', {
    t: 'Stone Removal Game: 10, 9, 8, … until someone cannot',
    r: 'Alice removes 10, Bob 9, Alice 8, …. The player who cannot take the required amount loses.',
    g: R => ({ n: R.int(1, 50) }),
    s(I, T) { let n = I.n, k = 10, alice = true; while (n >= k) { n -= k; k--; alice = !alice; T.at({ left: n, next: k }); T.c('Whose turn is it now?', ['Alice', 'Bob'], alice ? 'Alice' : 'Bob', 'Turns alternate.'); } return !alice; }
  });

  D('maximum-area-rectangle-with-point-constraints-i', {
    t: 'Maximum Area Rectangle With Point Constraints I: brute force',
    r: 'n at most 10: try every pair as opposite corners with both other corners present, reject rectangles with any other point inside or on the border, keep the largest area (−1 if none).',
    g: R => { const s = new Set(); while (s.size < R.int(4, 7)) s.add(R.int(0, 3) + ',' + R.int(0, 3)); return { points: [...s].map(p => p.split(',').map(Number)) }; },
    s(I, T) { const res = (() => { const p = I.points, S = new Set(p.map(q => q.join())); let best = -1; T.at({ points: A(p.map(q => `(${q})`)) }); T.n('Distinct x values?', new Set(p.map(q => q[0])).size, 'A rectangle needs two of them.'); for (let i = 0; i < p.length; i++) for (let j = 0; j < p.length; j++) { const [a, b] = [p[i], p[j]]; if (!(a[0] < b[0] && a[1] < b[1])) continue; if (!S.has([a[0], b[1]].join()) || !S.has([b[0], a[1]].join())) continue; const inside = p.filter(q => q[0] >= a[0] && q[0] <= b[0] && q[1] >= a[1] && q[1] <= b[1]).length; T.at({ points: A(p.map(q => `(${q})`), { hl: [i, j] }) }); T.yn(`Rectangle from (${a}) to (${b}): any other point inside or on it?`, inside > 4, inside > 4 ? 'It is blocked.' : 'Only its four corners.'); if (inside === 4) best = Math.max(best, (b[0] - a[0]) * (b[1] - a[1])); } return best; })(); T.n('Largest area? (−1 if none)', res, 'Best empty rectangle.'); return res; }
  });

  D('subsequences-with-a-unique-middle-mode-i', { t: 'Unique Middle Mode I: fix the middle element', r: 'Fix the middle index; choose 2 from the left and 2 from the right. Count choices where the middle value is the strict mode, by counting how many copies of it (and of other values) land on each side.', g: R => ({ nums: R.ints(R.int(5, 7), 1, 3) }), s: middleMode });
  D('subsequences-with-a-unique-middle-mode-ii', { t: 'Unique Middle Mode II: complement counting per middle', r: 'For each middle index, count all C(left, 2) times C(right, 2) choices and subtract the ones where the middle value is not a unique mode, using prefix or suffix counts of every value (sums of squares keep it fast).', g: R => ({ nums: R.ints(R.int(5, 7), 1, 3) }), s: middleMode });

  D('count-special-subsequences', {
    t: 'Count Special Subsequences: equal ratios with gaps',
    r: 'nums[p] times nums[r] = nums[q] times nums[s] exactly when nums[p] divided by nums[q] = nums[s] divided by nums[r]. For each r, add ratios nums[p] divided by nums[q] with q = r − 2 into a map, then look up nums[s] divided by nums[r] for s at least r + 2 (gaps of at least 2 everywhere).',
    g: R => ({ nums: R.ints(R.int(7, 8), 1, 4) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length; let t = 0; T.at({ nums: A(a) }); T.n('Pairs of q and r to try?', Array.from({ length: n }, (_, q) => q >= 2 ? Math.max(0, n - q - 2) : 0).reduce((x, y) => x + y, 0), 'r must be at least 2 after q.'); for (let q = 2; q < n; q++) for (let r = q + 2; r < n; r++) { let c = 0; for (let p = 0; p + 1 < q; p++) for (let s = r + 2; s < n; s++) if (a[p] * a[r] === a[q] * a[s]) c++; if (c) { T.at({ nums: A(a, { hl: [q, r] }) }); T.n(`Special subsequences with q = ${q}, r = ${r}?`, c, 'Pairs with p at least 2 before q and s at least 2 after r, where nums[p] times nums[r] equals nums[q] times nums[s].'); } t += c; } return t; })(); T.n('Total special subsequences?', res, 'Add the counts for every q and r.'); return res; }
  });

  D('count-mentions-per-user', {
    t: 'Count Mentions per User: process events in time order',
    r: 'Sort events by timestamp, with OFFLINE before MESSAGE at the same time. OFFLINE marks a user offline until t + 60. "ALL" mentions everyone, "HERE" only online users, and idX tokens mention that user (repeats count).',
    g: R => { const n = R.int(1, 3), ev = []; for (let i = 0; i < R.int(1, 4); i++) { const t = String(R.int(1, 100)); if (R.chance(0.3)) ev.push(['OFFLINE', t, String(R.int(0, n - 1))]); else ev.push(['MESSAGE', t, R.pick(['ALL', 'HERE', Array.from({ length: R.int(1, 2) }, () => 'id' + R.int(0, n - 1)).join(' ')])]); } return { numberOfUsers: n, events: ev }; },
    s(I, T) { const res = (() => { const n = I.numberOfUsers, cnt = Array(n).fill(0), back = Array(n).fill(0); const ev = I.events.map((e, i) => [e, i]).sort((x, y) => +x[0][1] - +y[0][1] || (x[0][0] === 'OFFLINE' ? 0 : 1) - (y[0][0] === 'OFFLINE' ? 0 : 1) || x[1] - y[1]).map(x => x[0]); for (const [type, ts, arg] of ev) { const t = +ts; if (type === 'OFFLINE') { back[+arg] = t + 60; continue; } const before = cnt.slice(); if (arg === 'ALL') cnt.forEach((_, i) => cnt[i]++); else if (arg === 'HERE') cnt.forEach((_, i) => { if (back[i] <= t) cnt[i]++; }); else arg.split(' ').forEach(id => cnt[+id.slice(2)]++); T.at({ event: `${type} at ${t}: ${arg}`, online: A(back.map(b => b <= t ? 'on' : 'off')) }); T.n('How many mentions does this message add?', cnt.reduce((a, b) => a + b, 0) - before.reduce((a, b) => a + b, 0), arg === 'HERE' ? 'Online users only.' : arg === 'ALL' ? 'Every user.' : 'One per id token.'); } return cnt; })(); T.n('Mentions of user 0?', res[0], 'Add up every message that included user 0.'); return res; }
  });

  D('maximum-manhattan-distance-after-k-changes', {
    t: 'Maximum Manhattan Distance After k Changes: each change adds 2',
    r: 'After each prefix, distance = |N − S| + |E − W|. Each change of a "wrong-way" move adds 2, but the distance cannot exceed the prefix length: min(dist + 2k, i + 1). Take the best prefix.',
    g: R => ({ s: R.str(R.int(2, 8), 'NSEW'), k: R.int(0, 3) }),
    s(I, T) { let n = 0, e = 0, best = 0; [...I.s].forEach((c, i) => { if (c === 'N') n++; else if (c === 'S') n--; else if (c === 'E') e++; else e--; const v = Math.min(Math.abs(n) + Math.abs(e) + 2 * I.k, i + 1); T.at({ s: A([...I.s], { hl: [i] }), k: I.k }); T.n(`Best distance after prefix ${i}?`, v, `min(|NS| + |EW| + 2k, ${i + 1}).`); best = Math.max(best, v); }); return best; }
  });

  D('check-if-digits-are-equal-in-string-after-operations-i', { t: 'Digits Equal After Operations I: simulate the rows', r: 'Replace the digits by neighbor sums mod 10 until two remain, then compare them.', g: R => ({ s: R.str(R.int(3, 7), '0123456789') }), s: reduceDigits });
  D('check-if-digits-are-equal-in-string-after-operations-ii', { t: 'Digits Equal After Operations II: binomial weights mod 10', r: 'The final two digits are the sum of C(n−2, i) times s[i] and the sum of C(n−2, i) times s[i+1] mod 10. C mod 10 comes from Lucas\' theorem mod 2 and mod 5 combined. Here: watch the rows shrink.', g: R => ({ s: R.str(R.int(3, 7), '0123456789') }), s: reduceDigits });

  D('find-the-number-of-copy-arrays', {
    t: 'Number of Copy Arrays: intersect shifted ranges',
    r: 'copy[i] = copy[0] + (original[i] − original[0]), so each bound limits copy[0] to [u_i − d_i, v_i − d_i]. Intersect all of them; the answer is the size (or 0).',
    g: R => { const n = R.int(2, 4), o = R.ints(n, 1, 6); return { original: o, bounds: o.map(x => { const l = x + R.int(-2, 1); return [Math.max(1, l), Math.max(1, l) + R.int(0, 4)]; }) }; },
    s(I, T) { let lo = -Infinity, hi = Infinity; I.original.forEach((x, i) => { const d = x - I.original[0]; lo = Math.max(lo, I.bounds[i][0] - d); hi = Math.min(hi, I.bounds[i][1] - d); T.at({ original: A(I.original, { hl: [i] }), bounds: A(I.bounds.map(b => `[${b}]`)) }); T.n(`Lowest allowed copy[0] after index ${i}?`, lo, `u − (original[i] − original[0]) = ${I.bounds[i][0]} − ${d}.`); }); return Math.max(0, hi - lo + 1); }
  });
})();
