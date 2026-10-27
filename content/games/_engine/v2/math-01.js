/* v2 games: math (01). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const toRoman = n => { const v = [1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1], s = ['M', 'CM', 'D', 'CD', 'C', 'XC', 'L', 'XL', 'X', 'IX', 'V', 'IV', 'I']; let r = ''; v.forEach((x, i) => { while (n >= x) { r += s[i]; n -= x; } }); return r; };
  const addStr = (I, T, base) => { const a = I.a ?? I.num1, b = I.b ?? I.num2; let i = a.length - 1, j = b.length - 1, c = 0, out = ''; while (i >= 0 || j >= 0 || c) { const s = (i >= 0 ? +a[i] : 0) + (j >= 0 ? +b[j] : 0) + c; T.at({ a: A([...a], { hl: i >= 0 ? [i] : [] }), b: A([...b], { hl: j >= 0 ? [j] : [] }), carry: c, result: out || '—' }); T.n(`Digit written at this column?`, s % base, `(${i >= 0 ? a[i] : 0} + ${j >= 0 ? b[j] : 0} + carry ${c}) mod ${base}.`); out = (s % base) + out; c = Math.floor(s / base); i--; j--; } return out; };

  D('reverse-integer', {
    t: 'Reverse Integer: pop digits, check before pushing',
    r: 'Pop the last digit (x % 10, truncated toward zero) and push it onto rev. Before rev·10 + d, check it stays within [−2^31, 2^31 − 1]; if not, return 0.',
    g: R => ({ x: R.chance(0.2) ? R.pick([1534236469, -2147483412, 1463847412]) : R.int(-99999, 99999) }),
    s(I, T) { let x = I.x, rev = 0; const MX = 2 ** 31 - 1, MN = -(2 ** 31); while (x !== 0) { const d = x % 10; x = Math.trunc(x / 10); const nx = rev * 10 + d, of = nx > MX || nx < MN; T.at({ remaining: x, rev, popped: d }); T.yn(`Would pushing ${d} overflow?`, of, of ? 'rev·10 + d leaves the 32-bit range.' : 'Still in range.'); if (of) return 0; rev = nx; T.n('rev now?', rev, 'rev·10 + d.'); } return rev; }
  });

  D('palindrome-number', {
    t: 'Palindrome Number: reverse half the digits',
    r: 'Negatives and numbers ending in 0 (except 0) are not palindromes. Move digits from x onto rev until rev ≥ x; then compare x with rev (or rev / 10 for odd length).',
    g: R => ({ x: R.pick([R.int(-500, 99999), +String(R.int(1, 999)).concat([...String(R.int(1, 999))].reverse().join('')), 12321, 10]) }),
    s(I, T) { let x = I.x; const bad = x < 0 || (x % 10 === 0 && x !== 0); T.at({ x }); T.yn('Rejected immediately (negative or trailing 0)?', bad, 'Neither can read the same backward.'); if (bad) return false; let rev = 0; while (x > rev) { rev = rev * 10 + x % 10; x = Math.floor(x / 10); T.at({ x, rev }); T.n('rev now?', rev, 'Move the last digit of x onto rev.'); } return x === rev || x === Math.floor(rev / 10); }
  });

  D('roman-to-integer', {
    t: 'Roman to Integer: subtract when a smaller symbol comes first',
    r: 'Scan left to right. If a symbol is smaller than the one after it (IV, IX, XL, …), subtract it; otherwise add it.',
    g: R => ({ s: toRoman(R.int(1, 3999)) }),
    s(I, T) { const V = { I: 1, V: 5, X: 10, L: 50, C: 100, D: 500, M: 1000 }, s = I.s; let t = 0; for (let i = 0; i < s.length; i++) { const sub = i + 1 < s.length && V[s[i]] < V[s[i + 1]]; T.at({ s: A([...s], { hl: [i] }), total: t }); T.yn(`Subtract ${s[i]} (${V[s[i]]})?`, sub, sub ? `It is smaller than the next symbol ${s[i + 1]}.` : 'Not smaller than the next symbol, so add it.'); t += sub ? -V[s[i]] : V[s[i]]; } return t; }
  });

  D('multiply-strings', {
    t: 'Multiply Strings: digit products into position i + j + 1',
    r: 'res has len1 + len2 slots. num1[i]·num2[j] adds into res[i + j + 1]; carry the tens into res[i + j]. Strip leading zeros.',
    g: R => ({ num1: String(R.int(0, 999)), num2: String(R.int(1, 99)) }),
    s(I, T) { const a = I.num1, b = I.num2, res = Array(a.length + b.length).fill(0); for (let i = a.length - 1; i >= 0; i--) { for (let j = b.length - 1; j >= 0; j--) { const s = +a[i] * +b[j] + res[i + j + 1]; res[i + j + 1] = s % 10; res[i + j] += Math.floor(s / 10); } T.at({ num1: A([...a], { hl: [i] }), num2: b, res: A(res) }); T.n(`Value of ${b} × ${a[i]}?`, +b * +a[i], 'This row is added in shifted by its position.'); } const s = res.join('').replace(/^0+(?=.)/, ''); return s; }
  });

  D('permutation-sequence', {
    t: 'Permutation Sequence: factorial number system',
    r: 'With k − 1 (0-based), the first digit is the ⌊k/(n−1)!⌋-th remaining number; continue with k mod (n−1)! and fewer numbers.',
    g: R => { const n = R.int(3, 5); let f = 1; for (let i = 2; i <= n; i++) f *= i; return { n, k: R.int(1, f) }; },
    s(I, T) { const nums = Array.from({ length: I.n }, (_, i) => i + 1), fact = [1]; for (let i = 1; i <= I.n; i++) fact[i] = fact[i - 1] * i; let k = I.k - 1, out = ''; for (let i = I.n; i >= 1; i--) { const idx = Math.floor(k / fact[i - 1]); T.at({ left: A(nums, { hl: [idx] }), k0: k, block: fact[i - 1] }); T.n('Which number goes next?', nums[idx], `Index ⌊${k} / ${fact[i - 1]}⌋ = ${idx} among the remaining numbers.`); out += nums[idx]; nums.splice(idx, 1); k %= fact[i - 1]; } return out; }
  });

  D('plus-one', {
    t: 'Plus One: carry from the right',
    r: 'From the last digit: if it is < 9, add 1 and stop. Otherwise set it to 0 and carry. If every digit was 9, prepend a 1.',
    g: R => ({ digits: R.chance(0.3) ? Array(R.int(1, 3)).fill(9) : [R.int(1, 9), ...R.ints(R.int(0, 3), 0, 9), ...Array(R.int(0, 2)).fill(9)] }),
    s(I, T) { const d = I.digits.slice(); for (let i = d.length - 1; i >= 0; i--) { T.at({ digits: A(d, { hl: [i] }) }); T.yn(`Does ${d[i]} + 1 carry?`, d[i] === 9, d[i] === 9 ? '9 + 1 = 10: write 0, carry 1.' : 'No carry: done.'); if (d[i] < 9) { d[i]++; return d; } d[i] = 0; } return [1, ...d]; }
  });

  D('add-binary', { t: 'Add Binary: column by column with a carry', r: 'From the right, add both bits and the carry; write sum mod 2 and carry ⌊sum / 2⌋. Keep going while a carry remains.', g: R => ({ a: '1' + R.str(R.int(0, 4), '01'), b: R.chance(0.2) ? '0' : '1' + R.str(R.int(0, 4), '01') }), s: (I, T) => addStr(I, T, 2) });
  D('add-strings', { t: 'Add Strings: grade-school addition', r: 'From the right, add both digits and the carry; write sum mod 10 and carry ⌊sum / 10⌋. Continue while either string or a carry remains.', g: R => ({ num1: String(R.int(0, 9999)), num2: String(R.int(0, 999)) }), s: (I, T) => addStr(I, T, 10) });

  D('max-points-on-a-line', {
    t: 'Max Points on a Line: slopes from each anchor',
    r: 'For each anchor point, reduce (dx, dy) to lowest terms with a fixed sign and count equal slopes. The best line through the anchor is 1 + the largest count.',
    g: R => { const s = new Set(); while (s.size < R.int(3, 5)) s.add(R.int(0, 3) + ',' + R.int(0, 3)); return { points: [...s].map(p => p.split(',').map(Number)) }; },
    s(I, T) { const p = I.points; let best = 1; p.forEach((a, i) => { const m = {}; let b = 0; for (let j = i + 1; j < p.length; j++) { let dx = p[j][0] - a[0], dy = p[j][1] - a[1]; const g = gcd(dx, dy); dx /= g; dy /= g; if (dx < 0 || (dx === 0 && dy < 0)) { dx = -dx; dy = -dy; } const k = dx + '/' + dy; m[k] = (m[k] || 0) + 1; b = Math.max(b, m[k]); } if (i < p.length - 1) { T.at({ points: A(p.map(q => `(${q})`), { hl: [i] }), slopes: K(m) }); T.n(`Most points on one line through (${a}) using later points?`, b + 1, 'Anchor + the biggest slope group.'); } best = Math.max(best, b + 1); }); return best; }
  });

  D('fraction-to-recurring-decimal', {
    t: 'Fraction to Recurring Decimal: remember where each remainder appeared',
    r: 'Write the sign and integer part. Then long division: remainder × 10 gives the next digit. If a remainder repeats, wrap the digits since its first appearance in parentheses.',
    g: R => ({ numerator: R.int(-20, 30), denominator: R.pick([2, 3, 4, 6, 7, 11, 12, -3, 333, 5]) }),
    s(I, T) { const n = I.numerator, d = I.denominator; if (n === 0) return '0'; let out = (n < 0) !== (d < 0) ? '-' : ''; const N = Math.abs(n), Dd = Math.abs(d); out += Math.floor(N / Dd); let r = N % Dd; T.at({ fraction: `${n}/${d}` }); T.n('Integer part (absolute value)?', Math.floor(N / Dd), `⌊${N} / ${Dd}⌋.`); if (!r) return out; out += '.'; const seen = new Map(); let frac = ''; while (r && !seen.has(r)) { seen.set(r, frac.length); r *= 10; const dig = Math.floor(r / Dd); T.at({ fraction: `${n}/${d}`, digits: frac || '—', remainder: r / 10 }); T.n('Next decimal digit?', dig, `⌊${r} / ${Dd}⌋.`); frac += dig; r %= Dd; } if (r) { T.at({ digits: frac, remainder: r }); T.n('The repeating part starts at which decimal position (0-based)?', seen.get(r), `Remainder ${r} first appeared there.`); frac = frac.slice(0, seen.get(r)) + '(' + frac.slice(seen.get(r)) + ')'; } return out + frac; }
  });

  D('excel-sheet-column-title', {
    t: 'Excel Column Title: base 26 without a zero',
    r: 'Repeat: subtract 1, take (n mod 26) as the letter (0 = A), divide by 26. The letters come out right to left.',
    g: R => ({ columnNumber: R.pick([R.int(1, 26), R.int(27, 702), R.int(703, 20000)]) }),
    s(I, T) { let n = I.columnNumber, out = ''; while (n > 0) { n--; const L = String.fromCharCode(65 + n % 26); T.at({ n: n + 1, title: out || '—' }); T.c('Which letter comes out next (right to left)?', [...new Set([L, String.fromCharCode(65 + (n + 1) % 26), String.fromCharCode(65 + (n + 25) % 26), 'Z'])], L, `(n − 1) mod 26 = ${n % 26}.`); out = L + out; n = Math.floor(n / 26); } return out; }
  });

  D('excel-sheet-column-number', {
    t: 'Excel Column Number: read base 26',
    r: 'result = result × 26 + (letter − A + 1) for each letter, left to right.',
    g: R => ({ columnTitle: R.str(R.int(1, 3), 'ABCXYZ') }),
    s(I, T) { let r = 0; [...I.columnTitle].forEach((c, i) => { r = r * 26 + c.charCodeAt(0) - 64; T.at({ title: A([...I.columnTitle], { hl: [i] }) }); T.n('Result so far?', r, `Previous × 26 + ${c.charCodeAt(0) - 64}.`); }); return r; }
  });

  D('factorial-trailing-zeroes', {
    t: 'Factorial Trailing Zeroes: count the fives',
    r: 'Each zero needs a 2·5, and 5s are rarer. Count multiples of 5, plus multiples of 25 (an extra 5), 125, …',
    g: R => ({ n: R.int(0, 700) }),
    s(I, T) { let t = 0; for (let p = 5; p <= I.n; p *= 5) { T.at({ n: I.n, zeros: t, power: p }); T.n(`Multiples of ${p} up to ${I.n}?`, Math.floor(I.n / p), `⌊${I.n} / ${p}⌋.`); t += Math.floor(I.n / p); } return t; }
  });

  D('happy-number', {
    t: 'Happy Number: square-digit sums until 1 or a repeat',
    r: 'Replace n by the sum of squares of its digits. Stop at 1 (happy) or when a value repeats (a cycle; not happy). Floyd\'s two pointers avoid the set.',
    g: R => ({ n: R.pick([R.int(1, 100), 7, 19, 2, 4]) }),
    s(I, T) { const seen = new Set(); let n = I.n; while (n !== 1 && !seen.has(n)) { seen.add(n); const nx = [...String(n)].reduce((a, c) => a + c * c, 0); T.at({ n, seen: A([...seen]) }); T.n(`Sum of squared digits of ${n}?`, nx, 'Square each digit and add.'); n = nx; } return n === 1; }
  });

  D('count-primes', {
    t: 'Count Primes: Sieve of Eratosthenes',
    r: 'Mark multiples of each prime p starting from p², while p² < n. Count the unmarked numbers from 2 to n − 1.',
    g: R => ({ n: R.int(0, 40) }),
    s(I, T) { const n = I.n, comp = Array(Math.max(n, 2)).fill(false); for (let p = 2; p * p < n; p++) if (!comp[p]) { T.at({ n, p, marked: A([...Array(n).keys()].filter(i => i >= 2 && comp[i])) }); T.n(`First multiple of ${p} to cross out?`, p * p, 'Smaller multiples were crossed out by smaller primes.'); for (let m = p * p; m < n; m += p) comp[m] = true; } let c = 0; for (let i = 2; i < n; i++) if (!comp[i]) c++; return c; }
  });

  D('strobogrammatic-number-iii', {
    t: 'Strobogrammatic Number III: build by length, count in range',
    r: 'Build strobogrammatic numbers from the middle out with pairs 0-0, 1-1, 6-9, 8-8, 9-6 (middle: 0, 1, 8; no leading 0 unless the number is 0). Count those between low and high.',
    g: R => { const a = R.int(0, 200), b = a + R.int(0, 1200); return { low: String(a), high: String(b) }; },
    s(I, T) {
      const P = [['0', '0'], ['1', '1'], ['6', '9'], ['8', '8'], ['9', '6']], build = (m, n) => { if (m === 0) return ['']; if (m === 1) return ['0', '1', '8']; const out = []; for (const s of build(m - 2, n)) for (const [a, b] of P) if (!(m === n && a === '0')) out.push(a + s + b); return out; };
      const cmp = (x, y) => x.length !== y.length ? x.length - y.length : x < y ? -1 : x > y ? 1 : 0; let tot = 0;
      for (let L = I.low.length; L <= I.high.length; L++) { const all = build(L, L), c = all.filter(s => cmp(s, I.low) >= 0 && cmp(s, I.high) <= 0).length; T.at({ low: I.low, high: I.high, length: L }); T.n(`Strobogrammatic numbers of length ${L} in range?`, c, `Build all of length ${L} (${all.length}) and keep those in [low, high].`); tot += c; }
      T.at({ low: I.low, high: I.high }); T.n('Total in range?', tot, 'Add the counts for every length.');
      return tot;
    }
  });

  D('add-digits', {
    t: 'Add Digits: digital root',
    r: 'Repeatedly sum the digits until one digit remains. Shortcut: 0 → 0, otherwise 1 + (num − 1) mod 9.',
    g: R => ({ num: R.int(0, 99999) }),
    s(I, T) { let n = I.num; while (n >= 10) { const s = [...String(n)].reduce((a, c) => a + +c, 0); T.at({ num: n }); T.n(`Digit sum of ${n}?`, s, 'Add the digits.'); n = s; } return n; }
  });

  D('ugly-number', {
    t: 'Ugly Number: divide out 2, 3 and 5',
    r: 'Non-positive numbers are not ugly. Divide n by 2, 3 and 5 as long as possible; it is ugly exactly when 1 remains.',
    g: R => ({ n: R.pick([R.int(-5, 0), 2 ** R.int(0, 4) * 3 ** R.int(0, 2) * 5 ** R.int(0, 2) * R.pick([1, 1, 7, 11])]) }),
    s(I, T) { let n = I.n; if (n <= 0) return false; for (const p of [2, 3, 5]) { while (n % p === 0) n /= p; T.at({ n: I.n, left: n }); T.n(`What remains after dividing out every ${p}?`, n, `Keep dividing by ${p}.`); } return n === 1; }
  });

  D('integer-to-english-words', {
    t: 'Integer to English Words: groups of three digits',
    r: 'Split into groups of three (Billion, Million, Thousand, units). Each group: hundreds, then a word for 1–19 or a tens word plus a ones word. Join non-empty groups with their scale.',
    g: R => ({ num: R.pick([0, R.int(1, 99), R.int(100, 99999), R.int(1e6, 2e9)]) }),
    s(I, T) {
      const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'], tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'], sc = ['', 'Thousand', 'Million', 'Billion'];
      if (I.num === 0) return 'Zero'; const three = n => { const w = []; if (n >= 100) { w.push(ones[Math.floor(n / 100)], 'Hundred'); n %= 100; } if (n >= 20) { w.push(tens[Math.floor(n / 10)]); n %= 10; } if (n) w.push(ones[n]); return w; };
      let n = I.num, k = 0; const parts = []; while (n > 0) { const g = n % 1000; T.at({ num: I.num, scale: sc[k] || 'units' }); T.n(`Value of the ${sc[k] || 'units'} group?`, g, 'Take the next three digits from the right.'); if (g) parts.unshift([...three(g), sc[k]].filter(Boolean).join(' ')); n = Math.floor(n / 1000); k++; } return parts.join(' ');
    }
  });

  D('power-of-three', {
    t: 'Power of Three: divide while divisible',
    r: 'n must be positive. Divide by 3 while it divides evenly; it is a power of three when 1 remains. (Alternatively 3^19 % n === 0.)',
    g: R => ({ n: R.pick([3 ** R.int(0, 8), R.int(-3, 100), 45, 0]) }),
    s(I, T) { const res = (() => { let n = I.n; if (n <= 0) { T.at({ n }); T.yn('Is n positive?', false, 'Powers of three are positive.'); T.n('Times divided by 3?', 0, 'Nothing to divide.'); T.yn('Is n a power of three?', false, 'Not positive.'); return false; } let k = 0; while (n % 3 === 0) { n /= 3; k++; } T.at({ n: I.n }); T.n('What remains after dividing out every 3?', n, 'Keep dividing by 3.'); T.n('Times divided by 3?', k, 'Count each division.'); return n === 1; })(); if (I.n > 0) T.yn('Is n a power of three?', res, 'Only 1 should remain.'); return res; }
  });

  D('line-reflection', {
    t: 'Line Reflection: the mirror is at (minX + maxX) / 2',
    r: 'The only candidate line is x = (minX + maxX) / 2. Use S = minX + maxX: every point (x, y) needs its mirror (S − x, y) in the set.',
    g: R => { const c = R.int(-2, 2), pts = []; for (let i = 0; i < R.int(1, 3); i++) { const dx = R.int(0, 3), y = R.int(-2, 2); pts.push([c + dx, y], [c - dx, y]); } if (R.chance(0.4)) pts.push([R.int(-4, 4), R.int(-2, 2)]); return { points: pts }; },
    s(I, T) { const xs = I.points.map(p => p[0]), S = Math.min(...xs) + Math.max(...xs), set = new Set(I.points.map(p => p.join())); T.at({ points: A(I.points.map(p => `(${p})`)) }); T.n('minX + maxX?', S, 'The mirror line is at half of this.'); for (const [x, y] of I.points) { const ok = set.has([S - x, y].join()); T.at({ points: A(I.points.map(p => `(${p})`)), S }); T.yn(`Does (${x},${y}) have its mirror (${S - x},${y})?`, ok, 'Look it up in the set.'); if (!ok) return false; } return true; }
  });

  D('super-pow', {
    t: 'Super Pow: a^(10·b + d) = (a^b)^10 · a^d',
    r: 'Process the digits of b left to right: res = res^10 · a^d (mod 1337), using fast power for each step.',
    g: R => ({ a: R.int(1, 50), b: [R.int(1, 9), ...R.ints(R.int(0, 2), 0, 9)] }),
    s(I, T) { const M = 1337, pw = (x, e) => { let r = 1; x %= M; while (e) { if (e & 1) r = r * x % M; x = x * x % M; e >>= 1; } return r; }; let res = 1; I.b.forEach((d, i) => { res = pw(res, 10) * pw(I.a, d) % M; T.at({ a: I.a, b: A(I.b, { hl: [i] }) }); T.n(`res after digit ${d} (mod 1337)?`, res, 'res^10 · a^d mod 1337.'); }); return res; }
  });

  D('elimination-game', {
    t: 'Elimination Game: track only the head',
    r: 'Keep head, step and remaining count. The head moves (head += step) on every left-to-right pass, and on right-to-left passes only when the count is odd. Then step doubles and the count halves.',
    g: R => ({ n: R.int(1, 40) }),
    s(I, T) { let head = 1, step = 1, rem = I.n, left = true; while (rem > 1) { const mv = left || rem % 2 === 1; T.at({ head, step, remaining: rem, direction: left ? 'left → right' : 'right → left' }); T.yn('Does the head move this pass?', mv, left ? 'Left-to-right always removes the head.' : rem % 2 ? 'Odd count: right-to-left also removes the head.' : 'Even count: the head survives right-to-left.'); if (mv) head += step; rem = Math.floor(rem / 2); step *= 2; left = !left; } return head; }
  });

  D('perfect-rectangle', {
    t: 'Perfect Rectangle: area plus corner parity',
    r: 'The areas must add up to the bounding box area, and after toggling all four corners of every rectangle in a set, exactly the four bounding corners must remain.',
    g: R => R.pick([{ rectangles: [[1, 1, 3, 3], [3, 1, 4, 2], [3, 2, 4, 4], [1, 3, 2, 4], [2, 3, 3, 4]] }, { rectangles: [[0, 0, 2, 1], [0, 1, 1, 2], [1, 1, 2, 2]] }, { rectangles: [[0, 0, 2, 1], [0, 1, 1, 2], [1, 0, 2, 2]] }, { rectangles: [[0, 0, 1, 1], [1, 0, 2, 1], [0, 1, 1, 2]] }, { rectangles: [[0, 0, R.int(1, 3), 1], [0, 1, 1, 2]] }]),
    s(I, T) { const r = I.rectangles; let area = 0; const set = new Set(), tg = k => set.has(k) ? set.delete(k) : set.add(k); for (const [a, b, c, d] of r) { area += (c - a) * (d - b); [[a, b], [a, d], [c, b], [c, d]].forEach(p => tg(p.join())); } const x1 = Math.min(...r.map(q => q[0])), y1 = Math.min(...r.map(q => q[1])), x2 = Math.max(...r.map(q => q[2])), y2 = Math.max(...r.map(q => q[3])); T.at({ rectangles: A(r.map(q => `[${q}]`)) }); T.n('Sum of the rectangle areas?', area, 'Add (a − x)(b − y) for each.'); T.n('Bounding box area?', (x2 - x1) * (y2 - y1), 'From the min and max coordinates.'); T.n('Corners left after toggling every rectangle corner?', set.size, 'Interior corners cancel in pairs (or fours).'); return area === (x2 - x1) * (y2 - y1) && set.size === 4 && [[x1, y1], [x1, y2], [x2, y1], [x2, y2]].every(p => set.has(p.join())); }
  });

  D('fizz-buzz', {
    t: 'Fizz Buzz: check 15 first',
    r: 'For each i: divisible by 15 → "FizzBuzz", by 3 → "Fizz", by 5 → "Buzz", otherwise the number.',
    g: R => ({ n: R.int(1, 16) }),
    s(I, T) { const out = []; for (let i = 1; i <= I.n; i++) { const w = i % 15 === 0 ? 'FizzBuzz' : i % 3 === 0 ? 'Fizz' : i % 5 === 0 ? 'Buzz' : String(i); if (i % 3 === 0 || i % 5 === 0 || i === I.n) { T.at({ i }); T.c(`What is written for ${i}?`, ['FizzBuzz', 'Fizz', 'Buzz', 'the number'], i % 15 === 0 ? 'FizzBuzz' : i % 3 === 0 ? 'Fizz' : i % 5 === 0 ? 'Buzz' : 'the number', 'Check 15, then 3, then 5.'); } out.push(w); } return out; }
  });

  D('reconstruct-original-digits-from-english', {
    t: 'Reconstruct Digits From English: unique letters first',
    r: 'Some letters appear in just one digit word: z (zero), w (two), u (four), x (six), g (eight). Then o (one), h (three), f (five), s (seven), i (nine) after subtracting what is known.',
    g: R => { const W = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine']; const d = R.ints(R.int(2, 5), 0, 9); return { s: R.shuffle([...d.map(x => W[x]).join('')]).join('') }; },
    s(I, T) { const c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const g = k => c[k] || 0, n = Array(10).fill(0); n[0] = g('z'); n[2] = g('w'); n[4] = g('u'); n[6] = g('x'); n[8] = g('g'); n[1] = g('o') - n[0] - n[2] - n[4]; n[3] = g('h') - n[8]; n[5] = g('f') - n[4]; n[7] = g('s') - n[6]; n[9] = g('i') - n[5] - n[6] - n[8]; const why = { 0: 'z', 2: 'w', 4: 'u', 6: 'x', 8: 'g', 1: 'o − zero − two − four', 3: 'h − eight', 5: 'f − four', 7: 's − six', 9: 'i − five − six − eight' }; for (const d of [0, 2, 4, 6, 8, 1, 3, 5, 7, 9]) { T.at({ letters: K(c), found: A(n) }); T.n(`How many ${['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'][d]}s?`, n[d], `Count of ${why[d]}.`); } return n.map((k, d) => String(d).repeat(k)).join(''); }
  });

  D('number-of-boomerangs', {
    t: 'Number of Boomerangs: count equal distances from each center',
    r: 'For each center i, count points by squared distance. A group of size c gives c·(c − 1) ordered pairs (j, k).',
    g: R => { const s = new Set(); while (s.size < R.int(3, 5)) s.add(R.int(0, 3) + ',' + R.int(0, 3)); return { points: [...s].map(p => p.split(',').map(Number)) }; },
    s(I, T) { let tot = 0; I.points.forEach((a, i) => { const m = {}; I.points.forEach((b, j) => { if (i !== j) { const d = (a[0] - b[0]) ** 2 + (a[1] - b[1]) ** 2; m[d] = (m[d] || 0) + 1; } }); const c = Object.values(m).reduce((s, v) => s + v * (v - 1), 0); T.at({ points: A(I.points.map(p => `(${p})`), { hl: [i] }), dist2: K(m) }); T.n(`Boomerangs centered at (${a})?`, c, 'Σ c·(c − 1) over distance groups.'); tot += c; }); return tot; }
  });

  D('minimum-moves-to-equal-array-elements', {
    t: 'Minimum Moves to Equal Elements: raise n − 1 = lower one',
    r: 'Incrementing all but one is the same as decrementing one. So every element must come down to the minimum: answer = Σ nums − n · min.',
    g: R => ({ nums: R.ints(R.int(2, 5), -3, 9) }),
    s(I, T) { const res = (() => { const m = Math.min(...I.nums); T.at({ nums: A(I.nums) }); T.n('Sum of nums?', I.nums.reduce((a, b) => a + b, 0), 'Add everything.'); T.n('Minimum value?', m, 'Everyone comes down to it.'); return I.nums.reduce((a, x) => a + x - m, 0); })(); T.n('Minimum moves?', res, 'Sum minus n times the minimum.'); return res; }
  });

  D('minimum-moves-to-equal-array-elements-ii', {
    t: 'Minimum Moves II: meet at the median',
    r: 'The sum of absolute differences is minimized at a median. Sort, take the middle element, and add |x − median|.',
    g: R => ({ nums: R.ints(R.int(2, 6), -5, 12) }),
    s(I, T) { const res = (() => { const a = I.nums.slice().sort((x, y) => x - y), med = a[a.length >> 1]; T.at({ sorted: A(a, { hl: [a.length >> 1] }) }); T.n('Median value?', med, 'The middle element after sorting.'); T.n('Distance from the smallest value to the median?', med - a[0], 'One part of the total.'); return a.reduce((s, x) => s + Math.abs(x - med), 0); })(); T.n('Minimum moves?', res, 'Sum of distances to the median.'); return res; }
  });

  D('convex-polygon', {
    t: 'Convex Polygon: all turns the same way',
    r: 'For each vertex, compute the cross product of consecutive edges. The polygon is convex when all non-zero cross products have the same sign.',
    g: R => R.pick([{ points: [[0, 0], [0, 5], [5, 5], [5, 0]] }, { points: [[0, 0], [0, 10], [10, 10], [10, 0], [5, 5]] }, { points: [[0, 0], [2, 0], [3, 2], [1, 3], [-1, 2]] }, { points: [[0, 0], [4, 0], [2, 1], [4, 4], [0, 4]] }, { points: [[0, 0], [R.int(2, 4), 0], [R.int(2, 4), R.int(2, 4)]] }]),
    s(I, T) { const p = I.points, n = p.length; let pre = 0; for (let i = 0; i < n; i++) { const a = p[i], b = p[(i + 1) % n], c = p[(i + 2) % n], cr = (b[0] - a[0]) * (c[1] - b[1]) - (b[1] - a[1]) * (c[0] - b[0]); T.at({ points: A(p.map(q => `(${q})`), { hl: [i, (i + 1) % n, (i + 2) % n] }) }); T.n(`Cross product of the turn at (${b})?`, cr, '(b − a) × (c − b).'); if (cr) { if (pre && Math.sign(cr) !== pre) return false; pre = Math.sign(cr); } } return true; }
  });

  D('construct-the-rectangle', {
    t: 'Construct the Rectangle: largest W ≤ √area',
    r: 'Start W at ⌊√area⌋ and step down until W divides area. Then L = area / W.',
    g: R => ({ area: R.int(1, 200) }),
    s(I, T) { const res = (() => { let w = Math.floor(Math.sqrt(I.area)); T.at({ area: I.area }); T.n('Starting W? (square root of area, rounded down)', w, 'W is at most L, so W is at most the square root.'); while (I.area % w) w--; T.n('Width W?', w, 'Largest divisor not above the square root.'); return [I.area / w, w]; })(); T.n('Length L?', res[0], 'Area divided by W.'); return res; }
  });

  D('base-7', {
    t: 'Base 7: repeated division',
    r: 'Handle the sign separately. Repeatedly take n mod 7 as the next digit (right to left) and divide by 7.',
    g: R => ({ num: R.int(-400, 400) }),
    s(I, T) { let n = Math.abs(I.num), out = ''; if (!n) return '0'; while (n) { T.at({ n, digits: out || '—' }); T.n(`${n} mod 7?`, n % 7, 'Next digit from the right.'); out = (n % 7) + out; n = Math.floor(n / 7); } return (I.num < 0 ? '-' : '') + out; }
  });

  D('perfect-number', {
    t: 'Perfect Number: divisors in pairs up to √n',
    r: 'Sum 1 and every divisor pair (d, n/d) for 2 ≤ d ≤ √n (count a square root once). Perfect if the sum equals n (and n > 1).',
    g: R => ({ num: R.pick([6, 28, 496, R.int(1, 60)]) }),
    s(I, T) { const n = I.num; if (n <= 1) return false; let s = 1; for (let d = 2; d * d <= n; d++) if (n % d === 0) { s += d + (d * d === n ? 0 : n / d); T.at({ num: n, d, sum: s }); T.n(`Sum after adding the pair for ${d}?`, s, `Add ${d}${d * d === n ? '' : ' and ' + n / d}.`); } T.at({ num: n }); T.n('Sum of proper divisors?', s, '1 plus all pairs.'); return s === n; }
  });

  D('complex-number-multiplication', {
    t: 'Complex Number Multiplication: (a + bi)(c + di)',
    r: 'Parse a, b, c, d. The product is (ac − bd) + (ad + bc)i, written as "real+imaginaryi".',
    g: R => ({ num1: `${R.int(-9, 9)}+${R.int(-9, 9)}i`, num2: `${R.int(-9, 9)}+${R.int(-9, 9)}i` }),
    s(I, T) { const p = s => s.slice(0, -1).split('+').map(Number), [a, b] = p(I.num1), [c, d] = p(I.num2); T.at({ num1: I.num1, num2: I.num2 }); T.n('Real part of num1?', a, 'Before the plus sign.'); T.n('Real part?', a * c - b * d, 'a times c, minus b times d.'); T.n('Imaginary part?', a * d + b * c, 'a times d, plus b times c.'); return `${a * c - b * d}+${a * d + b * c}i`; }
  });
})();
