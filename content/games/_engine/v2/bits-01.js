/* v2 games: bit manipulation (01). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const pc = x => { let c = 0; x = x >>> 0; while (x) { c += x & 1; x >>>= 1; } return c; };
  const bin = (x, w) => (x >>> 0).toString(2).padStart(w || 1, '0');
  const isGrayCycle = (o, n, start) => Array.isArray(o) && o.length === 1 << n && new Set(o).size === o.length && o.every(v => Number.isInteger(v) && v >= 0 && v < 1 << n) && o[0] === start && o.every((v, i) => pc(v ^ o[(i + 1) % o.length]) === 1 || o.length === 1);
  const isPrime = n => { if (n < 2) return false; for (let d = 2; d * d <= n; d++) if (n % d === 0) return false; return true; };

  D('divide-two-integers', {
    t: 'Divide Two Integers',
    r: 'Work with absolute values. From the highest shift down, if divisor << s fits in the remainder, subtract it and add 1 << s to the quotient. Apply the sign, truncate, and clamp to 32-bit.',
    g: R => ({ dividend: R.int(-100, 100), divisor: R.pick([-7, -3, -2, -1, 1, 2, 3, 5, 7]) }),
    s(I, T) { let a = Math.abs(I.dividend), b = Math.abs(I.divisor), q = 0, asks = 0; for (let s = 31; s >= 0; s--) if (b * 2 ** s <= a) { a -= b * 2 ** s; q += 2 ** s; if (asks++ < 5) { T.at({ remainder: a + b * 2 ** s, chunk: `${b} << ${s}` }); T.n('Remainder after subtracting this chunk?', a, `Quotient gains 2^${s}.`); } } if (!asks) { T.at({ dividend: I.dividend, divisor: I.divisor }); T.n('Quotient magnitude?', 0, 'Divisor larger than dividend.'); } const r = (I.dividend < 0) !== (I.divisor < 0) ? -q : q; return Math.max(-(2 ** 31), Math.min(2 ** 31 - 1, r)); }
  });

  D('pow-x-n', {
    t: 'Pow(x, n)',
    r: 'Fast exponentiation: walk the bits of |n|; square the base each step and multiply it into the result when the bit is 1. For negative n, return 1 / result.',
    g: R => ({ x: R.pick([2, 3, 0.5, 1.5, -2, 2.1]), n: R.int(-6, 10) }),
    cmp: 'float',
    s(I, T) { let e = Math.abs(I.n), b = I.x, r = 1, step = 0; while (e) { if (e & 1) r *= b; if (step++ < 5) { T.at({ exponentBits: bin(e), base: +b.toFixed(6) }); T.yn('Is the low bit set (multiply the base in)?', !!(e & 1), 'Binary exponentiation.'); } b *= b; e >>= 1; } if (!step) { T.at({ n: I.n }); T.n('x⁰?', 1, 'Anything to the 0 is 1.'); } return I.n < 0 ? 1 / r : r; }
  });

  D('gray-code', {
    t: 'Gray Code',
    r: 'The i-th Gray code is i ^ (i >> 1); consecutive values differ in exactly one bit, including the wrap-around.',
    g: R => ({ n: R.int(1, 4) }),
    cmp: (o, e, I) => isGrayCycle(o, I.n, 0),
    s(I, T) { return Array.from({ length: 1 << I.n }, (_, i) => { const g = i ^ (i >> 1); if (i < 6) { T.at({ i, binary: bin(i, I.n) }); T.n(`Gray code #${i}?`, g, 'i ^ (i >> 1).'); } return g; }); }
  });

  D('single-number', {
    t: 'Single Number',
    r: 'XOR everything: pairs cancel (x ^ x = 0), leaving the single number.',
    g: R => { const v = R.distinct(R.int(1, 4), 1, 9), s = v.pop(); return { nums: R.shuffle([...v, ...v, s]) }; },
    s(I, T) { let x = 0; I.nums.forEach((v, i) => { x ^= v; if (i < 7) { T.at({ nums: A(I.nums, { i }) }); T.n('Running XOR?', x, 'Pairs cancel.'); } }); return x; }
  });

  D('single-number-ii', {
    t: 'Single Number II',
    r: 'Count set bits per position mod 3; bits whose count is not a multiple of 3 belong to the single number (handle the sign bit for negatives).',
    g: R => { const v = R.distinct(R.int(1, 3), -5, 9), s = v.pop(); return { nums: R.shuffle([...v, ...v, ...v, s]) }; },
    s(I, T) { let r = 0; for (let b = 0; b < 32; b++) { let c = 0; for (const x of I.nums) c += (x >> b) & 1; if (c % 3) r |= 1 << b; if (b < 4) { T.at({ nums: A(I.nums.map(x => bin(x & 15, 4))), bit: b }); T.n(`Set bits at position ${b}, mod 3?`, c % 3, 'The single number\'s bit.'); } } return r | 0; }
  });

  D('reverse-bits', {
    t: 'Reverse Bits',
    r: 'Shift the result left and pull in n\'s lowest bit, 32 times (as unsigned).',
    g: R => ({ n: R.int(0, 2 ** 31 - 1) }),
    s(I, T) { let n = I.n >>> 0, r = 0; for (let i = 0; i < 32; i++) { const b = n & 1; r = ((r << 1) | b) >>> 0; n >>>= 1; if (i < 4) { T.at({ n: bin(n, 32 - i - 1), result: bin(r, i + 1) }); T.n('Bit just moved over?', b, 'Lowest bit of n.'); } } return r; }
  });

  D('number-of-1-bits', {
    t: 'Number of 1 Bits',
    r: 'Repeatedly clear the lowest set bit (n &= n − 1) and count the steps.',
    g: R => ({ n: R.int(1, 2 ** 31 - 1) }),
    s(I, T) { let n = I.n, c = 0; while (n) { n &= n - 1; c++; if (c <= 5) { T.at({ n: bin(n) }); T.n('Bits counted so far?', c, 'n & (n − 1) clears one.'); } } return c; }
  });

  D('bitwise-and-of-numbers-range', {
    t: 'Bitwise AND of Numbers Range',
    r: 'The AND is the common binary prefix of left and right. Shift both right until equal, then shift back.',
    g: R => { const l = R.int(0, 60); return { left: l, right: R.int(l, l + R.pick([0, 3, 10, 40])) }; },
    s(I, T) { let l = I.left, r = I.right, s = 0; while (l !== r) { l >>= 1; r >>= 1; s++; T.at({ left: bin(l), right: bin(r) }); T.yn('Equal now?', l === r, 'Common prefix found.'); } return l << s; }
  });

  D('power-of-two', {
    t: 'Power of Two',
    r: 'n is a power of two iff n > 0 and n & (n − 1) == 0 (exactly one set bit).',
    g: R => ({ n: R.chance(0.5) ? 2 ** R.int(0, 20) : R.int(-8, 1000) }),
    s(I, T) { T.at({ n: I.n, binary: I.n > 0 ? bin(I.n) : '—' }); T.yn('Is n positive?', I.n > 0, 'Required.'); if (I.n <= 0) return false; T.n('n & (n − 1)?', I.n & (I.n - 1), 'Zero iff one set bit.'); return (I.n & (I.n - 1)) === 0; }
  });

  D('single-number-iii', {
    t: 'Single Number III',
    r: 'XOR all to get a ^ b. Its lowest set bit splits the numbers into two groups; XOR each group to get a and b.',
    g: R => { const v = R.distinct(R.int(2, 5), 1, 15), a = v.pop(), b = v.pop(); return { nums: R.shuffle([...v, ...v, a, b]) }; },
    cmp: 'set',
    s(I, T) { const x = I.nums.reduce((p, q) => p ^ q, 0), low = x & -x; T.at({ nums: A(I.nums) }); T.n('XOR of everything (a ^ b)?', x, 'Pairs cancel.'); T.n('Lowest set bit used to split?', low, 'x & −x.'); let a = 0, b = 0; I.nums.forEach(v => v & low ? a ^= v : b ^= v); return [a, b]; }
  });

  D('palindrome-permutation', {
    t: 'Palindrome Permutation',
    r: 'Toggle a bit per character; a permutation can be a palindrome iff at most one bit remains set.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc') }),
    s(I, T) { let m = 0; [...I.s].forEach((c, i) => { m ^= 1 << (c.charCodeAt(0) - 97); if (i < 7) { T.at({ s: A([...I.s], { i }), mask: bin(m, 3) }); T.n('Odd-count letters so far?', pc(m), 'Set bits in the mask.'); } }); return pc(m) <= 1; }
  });

  D('missing-number', {
    t: 'Missing Number',
    r: 'XOR all indices 0..n with all values; everything pairs up except the missing number.',
    g: R => { const n = R.int(1, 7), m = R.int(0, n); return { nums: R.shuffle([...Array(n + 1).keys()].filter(x => x !== m)) }; },
    s(I, T) { let x = I.nums.length; I.nums.forEach((v, i) => { x ^= i ^ v; if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.n('Running XOR (starting from n)?', x, 'XOR in i and nums[i].'); } }); return x; }
  });

  D('maximum-product-of-word-lengths', {
    t: 'Maximum Product of Word Lengths',
    r: 'Encode each word as a 26-bit letter mask. Two words share no letters iff mask1 & mask2 == 0; maximize len1 · len2 over such pairs.',
    g: R => ({ words: Array.from({ length: R.int(2, 6) }, () => R.str(R.int(1, 5), 'abcdef')) }),
    s(I, T) { const m = I.words.map(w => [...w].reduce((s, c) => s | 1 << (c.charCodeAt(0) - 97), 0)); let best = 0, asks = 0; for (let i = 0; i < m.length; i++) for (let j = i + 1; j < m.length; j++) { const ok = !(m[i] & m[j]); if (ok) best = Math.max(best, I.words[i].length * I.words[j].length); if (asks++ < 6) { T.at({ pair: `${I.words[i]} / ${I.words[j]}`, masks: A([bin(m[i], 6), bin(m[j], 6)]) }); T.yn('No shared letters?', ok, 'mask AND is 0.'); } } return best; }
  });

  D('power-of-four', {
    t: 'Power of Four',
    r: 'A power of four is a power of two whose single set bit is at an even position: n > 0, n & (n − 1) == 0, and n & 0x55555555 ≠ 0.',
    g: R => ({ n: R.chance(0.5) ? 2 ** R.int(0, 20) : R.int(-4, 300) }),
    s(I, T) { const p2 = I.n > 0 && (I.n & (I.n - 1)) === 0; T.at({ n: I.n, binary: I.n > 0 ? bin(I.n) : '—' }); T.yn('Power of two?', p2, 'One set bit.'); if (!p2) return false; T.yn('Is that bit at an even position?', (I.n & 0x55555555) !== 0, 'Mask 0x55555555.'); return (I.n & 0x55555555) !== 0; }
  });

  D('sum-of-two-integers', {
    t: 'Sum of Two Integers',
    r: 'Without +: the partial sum is a ^ b and the carry is (a & b) << 1. Repeat until the carry is 0 (32-bit arithmetic).',
    g: R => ({ a: R.int(-20, 30), b: R.int(-20, 30) }),
    s(I, T) { let a = I.a, b = I.b, k = 0; while (b) { const c = (a & b) << 1; a = a ^ b; b = c; if (k++ < 5) { T.at({ sum: a, carry: b }); T.n('Carry now?', b, '(a & b) << 1.'); } } return a; }
  });

  D('find-the-difference', {
    t: 'Find the Difference',
    r: 'XOR all character codes of s and t; everything cancels except the added letter.',
    g: R => { const s = R.str(R.int(0, 6), 'abcd'), add = R.pick(['a', 'b', 'c', 'e']), p = R.int(0, s.length); return { s, t: [...R.shuffle([...s.slice(0, p) + add + s.slice(p)])].join('') }; },
    s(I, T) { let x = 0; [...I.s, ...I.t].forEach(c => x ^= c.charCodeAt(0)); T.at({ s: I.s, t: I.t }); T.n('XOR of all character codes?', x, 'Pairs cancel.'); return String.fromCharCode(x); }
  });

  D('utf-8-validation', {
    t: 'UTF-8 Validation',
    r: 'Read the leading 1-bits of each byte: 0 → 1-byte char; 110/1110/11110 → expect 1/2/3 continuation bytes starting with 10; anything else is invalid.',
    g: R => { const out = []; for (let i = 0; i < R.int(1, 3); i++) { const k = R.int(1, 4); out.push(k === 1 ? R.int(0, 127) : k === 2 ? R.int(192, 223) : k === 3 ? R.int(224, 239) : R.int(240, 247)); for (let j = 1; j < k; j++) out.push(R.chance(0.9) ? R.int(128, 191) : R.int(0, 255)); } return { data: out }; },
    s(I, T) { let need = 0; for (const [i, b] of I.data.entries()) { const x = b & 255; if (need) { const ok = x >> 6 === 2; if (i < 8) { T.at({ data: A(I.data.map(v => bin(v & 255, 8)), { i }), expecting: need }); T.yn('Valid continuation byte (10xxxxxx)?', ok, 'Top two bits 10.'); } if (!ok) return false; need--; } else { const lead = x >> 7 === 0 ? 0 : x >> 5 === 6 ? 1 : x >> 4 === 14 ? 2 : x >> 3 === 30 ? 3 : -1; if (i < 8) { T.at({ data: A(I.data.map(v => bin(v & 255, 8)), { i }) }); T.n('Continuation bytes this lead byte needs (−1 if invalid)?', lead, 'Count the leading 1s.'); } if (lead < 0) return false; need = lead; } } return need === 0; }
  });

  D('convert-a-number-to-hexadecimal', {
    t: 'Convert a Number to Hexadecimal',
    r: 'Treat the number as unsigned 32-bit (two\'s complement). Take 4 bits at a time from the bottom (n & 15), map to 0-9a-f, shift right by 4, until zero.',
    g: R => ({ num: R.chance(0.2) ? R.int(-300, -1) : R.int(0, 5000) }),
    s(I, T) { let n = I.num >>> 0; if (!n) { T.at({ num: 0 }); T.n('Digit?', 0, 'Zero is "0".'); return '0'; } let out = '', k = 0; while (n) { const d = n & 15; out = '0123456789abcdef'[d] + out; n >>>= 4; if (k++ < 4) { T.at({ remaining: bin(n), built: out }); T.n('Value of the 4-bit chunk just taken?', d, 'n & 15.'); } } return out; }
  });

  D('hamming-distance', {
    t: 'Hamming Distance',
    r: 'XOR the numbers; the distance is the number of set bits in x ^ y.',
    g: R => ({ x: R.int(0, 63), y: R.int(0, 63) }),
    s(I, T) { const z = I.x ^ I.y; T.at({ x: bin(I.x, 6), y: bin(I.y, 6) }); T.n('x ^ y?', z, 'Differing bits are set.'); return pc(z); }
  });

  D('number-complement', {
    t: 'Number Complement',
    r: 'Build a mask of all 1s as wide as num (highest bit and below) and XOR: num ^ mask.',
    g: R => ({ num: R.int(1, 200) }),
    s(I, T) { let m = 1; while (m <= I.num) m <<= 1; m -= 1; T.at({ num: bin(I.num) }); T.n('Mask of 1s covering num?', m, 'Same width as num.'); return I.num ^ m; }
  });

  D('total-hamming-distance', {
    t: 'Total Hamming Distance',
    r: 'For each bit, if k numbers have it set, it contributes k · (n − k) to the total.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 15) }),
    s(I, T) { let t = 0; for (let b = 0; b < 4; b++) { const k = I.nums.filter(x => x >> b & 1).length, add = k * (I.nums.length - k); t += add; T.at({ nums: A(I.nums.map(x => bin(x, 4))), bit: b }); T.n(`Contribution of bit ${b}?`, add, 'ones × zeros.'); } return t; }
  });

  D('set-mismatch', {
    t: 'Set Mismatch',
    r: 'Mark seen values by negating nums[|x| − 1]; a value whose slot is already negative is the duplicate; the slot left positive marks the missing number.',
    g: R => { const n = R.int(2, 7), a = [...Array(n).keys()].map(x => x + 1), i = R.int(0, n - 1); let j = R.int(0, n - 1); if (j === i) j = (i + 1) % n; a[i] = a[j]; return { nums: R.shuffle(a) }; },
    s(I, T) { const a = I.nums.slice(); let dup = -1; a.forEach((_, i) => { const x = Math.abs(a[i]); if (a[x - 1] < 0) dup = x; else a[x - 1] *= -1; }); T.at({ marked: A(a) }); T.n('Duplicate value?', dup, 'Found a slot already negative.'); const miss = a.findIndex(v => v > 0) + 1; return [dup, miss]; }
  });

  D('binary-number-with-alternating-bits', {
    t: 'Binary Number with Alternating Bits',
    r: 'x = n ^ (n >> 1) is all 1s iff the bits alternate; check x & (x + 1) == 0.',
    g: R => ({ n: R.chance(0.4) ? R.pick([1, 2, 5, 10, 21, 42, 85]) : R.int(1, 100) }),
    s(I, T) { const x = I.n ^ (I.n >> 1); T.at({ n: bin(I.n) }); T.n('n ^ (n >> 1)?', x, 'All ones if alternating.'); return (x & (x + 1)) === 0; }
  });

  D('ip-to-cidr', {
    t: 'IP to CIDR',
    r: 'Convert the IP to a 32-bit number x. Repeatedly take the largest block 2^k that is aligned at x (x & −x) and does not exceed the remaining count; emit x/(32 − k), advance x and reduce n.',
    g: R => ({ ip: `10.0.${R.int(0, 3)}.${R.int(0, 255)}`, n: R.int(1, 40) }),
    s(I, T) { let x = I.ip.split('.').reduce((s, p) => s * 256 + +p, 0), n = I.n; const out = []; while (n > 0) { let step = 1; while (step < 2 ** 32 && x % (step * 2) === 0) step *= 2; while (step > n) step /= 2; const k = Math.log2(step); const ipStr = [24, 16, 8, 0].map(s => Math.floor(x / 2 ** s) % 256).join('.'); if (out.length < 5) { T.at({ ip: ipStr, remaining: n }); T.n('Block size taken here?', step, 'Largest aligned power of two ≤ remaining.'); } out.push(`${ipStr}/${32 - k}`); x += step; n -= step; } return out; }
  });

  D('prime-number-of-set-bits-in-binary-representation', {
    t: 'Prime Number of Set Bits in Binary Representation',
    r: 'For each number in [left, right], count set bits and check if that count is prime (counts are ≤ 20, so a small prime set works).',
    g: R => { const l = R.int(1, 40); return { left: l, right: l + R.int(0, 8) }; },
    s(I, T) { let c = 0; for (let x = I.left; x <= I.right; x++) { const ok = isPrime(pc(x)); if (ok) c++; if (x - I.left < 6) { T.at({ x, binary: bin(x) }); T.yn(`Is the set-bit count (${pc(x)}) prime?`, ok, 'Primes ≤ 20.'); } } return c; }
  });

  D('k-th-symbol-in-grammar', {
    t: 'K-th Symbol in Grammar',
    r: 'Each row is the previous row followed by its complement. The k-th symbol equals the parity of the number of set bits in k − 1.',
    g: R => { const n = R.int(1, 8); return { n, k: R.int(1, 2 ** (n - 1)) }; },
    s(I, T) { T.at({ n: I.n, k: I.k, 'k − 1 in binary': bin(I.k - 1) }); T.n('Set bits in k − 1?', pc(I.k - 1), 'Each set bit is one flip.'); return pc(I.k - 1) & 1; }
  });

  D('binary-gap', {
    t: 'Binary Gap',
    r: 'Scan bits from the low end remembering the position of the last 1; for each new 1, the gap is the distance to it.',
    g: R => ({ n: R.int(1, 300) }),
    s(I, T) { let last = -1, best = 0; for (let b = 0; b < 31; b++) if (I.n >> b & 1) { if (last >= 0) { best = Math.max(best, b - last); T.at({ n: bin(I.n), bit: b, previous: last }); T.n('Distance to the previous 1?', b - last, 'Positions apart.'); } last = b; } return best; }
  });

  D('prison-cells-after-n-days', {
    t: 'Prison Cells After N Days',
    r: 'Encode the 8 cells as a bitmask. States repeat (period divides 14 after day 1), so memoize states to find the cycle and skip ahead with n mod cycle length.',
    g: R => ({ cells: R.ints(8, 0, 1), n: R.int(1, 40) }),
    s(I, T) { const next = c => c.map((_, i) => i > 0 && i < 7 && c[i - 1] === c[i + 1] ? 1 : 0); let c = I.cells.slice(); const seen = new Map(); let n = I.n, day = 0; while (n > 0) { const key = c.join(''); if (seen.has(key)) { const cyc = seen.get(key) - n; n %= cyc; T.at({ state: key }); T.n('Cycle length detected?', cyc, 'Days between repeats.'); if (!n) break; } seen.set(key, n); c = next(c); n--; if (day++ < 3) { T.at({ cells: A(c) }); T.n('Occupied cells after this day?', c.filter(Boolean).length, 'Cell is 1 iff both neighbors match.'); } } return c; }
  });

  D('triples-with-bitwise-and-equal-to-zero', {
    t: 'Triples with Bitwise AND Equal to Zero',
    r: 'Count every pair AND (i, j) in a map (n² entries). Then for each k and each pair value v with v & nums[k] == 0, add its count.',
    g: R => ({ nums: R.ints(R.int(1, 4), 0, 7) }),
    s(I, T) { const m = new Map(); for (const a of I.nums) for (const b of I.nums) m.set(a & b, (m.get(a & b) || 0) + 1); T.at({ pairAnds: K(Object.fromEntries(m)) }); T.n('Distinct pair-AND values?', m.size, 'Map keys.'); let t = 0; I.nums.forEach((c, i) => { let add = 0; for (const [v, k] of m) if (!(v & c)) add += k; t += add; if (i < 4) { T.at({ third: c }); T.n('Triples with this third element?', add, 'Pair ANDs disjoint from it.'); } }); return t; }
  });

  D('complement-of-base-10-integer', {
    t: 'Complement of Base 10 Integer',
    r: 'Mask of all 1s as wide as n (at least one bit, so 0 → 1), then n ^ mask.',
    g: R => ({ n: R.int(0, 200) }),
    s(I, T) { let m = 1; while (m <= I.n) m <<= 1; m = Math.max(1, m - 1); T.at({ n: bin(I.n) }); T.n('Mask?', m, 'All ones, same width.'); return I.n ^ m; }
  });

  D('binary-string-with-substrings-representing-1-to-n', {
    t: 'Binary String With Substrings Representing 1 To N',
    r: 'Check every x from n down to 1: its binary must be a substring of s. (Only small n can pass, since s has limited distinct substrings.)',
    g: R => ({ s: R.str(R.int(1, 10), '01'), n: R.int(1, 8) }),
    s(I, T) { for (let x = I.n; x >= 1; x--) { const ok = I.s.includes(bin(x)); if (I.n - x < 6) { T.at({ s: I.s, x, binary: bin(x) }); T.yn('Is it a substring?', ok, 'String search.'); } if (!ok) return false; } return true; }
  });

  D('binary-prefix-divisible-by-5', {
    t: 'Binary Prefix Divisible By 5',
    r: 'Keep the prefix value mod 5: v = (2v + bit) mod 5. Report v == 0 at each step.',
    g: R => ({ nums: R.ints(R.int(1, 9), 0, 1) }),
    s(I, T) { let v = 0; return I.nums.map((b, i) => { v = (2 * v + b) % 5; if (i < 8) { T.at({ nums: A(I.nums, { i }) }); T.n('Prefix value mod 5?', v, '(2v + bit) mod 5.'); } return v === 0; }); }
  });

  D('number-of-valid-words-for-each-puzzle', {
    t: 'Number of Valid Words for Each Puzzle',
    r: 'Count word letter-masks. For each puzzle, enumerate all submasks of its letter mask that include the first letter and sum their counts.',
    g: R => ({ words: Array.from({ length: R.int(1, 6) }, () => R.str(R.int(1, 4), 'abcdeg')), puzzles: Array.from({ length: R.int(1, 3) }, () => R.shuffle([...'abcdefg']).join('')) }),
    s(I, T) { const mask = w => [...w].reduce((s, c) => s | 1 << (c.charCodeAt(0) - 97), 0), c = new Map(); I.words.forEach(w => c.set(mask(w), (c.get(mask(w)) || 0) + 1)); return I.puzzles.map((p, i) => { const first = 1 << (p.charCodeAt(0) - 97), pm = mask(p); let t = 0; for (let s = pm; ; s = (s - 1) & pm) { if (s & first) t += c.get(s) || 0; if (!s) break; } if (i < 3) { T.at({ puzzle: p, words: A(I.words) }); T.n('Valid words for this puzzle?', t, 'Submasks containing the first letter.'); } return t; }); }
  });

  D('circular-permutation-in-binary-representation', {
    t: 'Circular Permutation in Binary Representation',
    r: 'Gray code g(i) = i ^ (i >> 1) is a one-bit-change cycle starting at 0; XOR every element with start to make it start at start.',
    g: R => { const n = R.int(1, 4); return { n, start: R.int(0, (1 << n) - 1) }; },
    cmp: (o, e, I) => isGrayCycle(o, I.n, I.start),
    s(I, T) { return Array.from({ length: 1 << I.n }, (_, i) => { const v = (i ^ (i >> 1)) ^ I.start; if (i < 5) { T.at({ i, gray: i ^ (i >> 1), start: I.start }); T.n(`Element #${i}?`, v, 'gray(i) ^ start.'); } return v; }); }
  });

  D('encode-number', {
    t: 'Encode Number',
    r: 'The encoding of num is the binary of num + 1 without its leading 1.',
    g: R => ({ num: R.int(0, 60) }),
    s(I, T) { T.at({ num: I.num }); T.n('num + 1?', I.num + 1, 'Its binary minus the top bit.'); return bin(I.num + 1).slice(1); }
  });

  D('minimum-flips-to-make-a-or-b-equal-to-c', {
    t: 'Minimum Flips to Make a OR b Equal to c',
    r: 'Per bit: if c\'s bit is 1 and both a, b are 0 → 1 flip. If c\'s bit is 0 → flip each of a, b that is 1.',
    g: R => ({ a: R.int(0, 15), b: R.int(0, 15), c: R.int(0, 15) }),
    s(I, T) { let t = 0; for (let k = 0; k < 4; k++) { const x = I.a >> k & 1, y = I.b >> k & 1, z = I.c >> k & 1, f = z ? (x | y ? 0 : 1) : x + y; t += f; T.at({ a: bin(I.a, 4), b: bin(I.b, 4), c: bin(I.c, 4), bit: k }); T.n(`Flips for bit ${k}?`, f, 'c=1 needs one 1; c=0 needs both 0.'); } return t; }
  });

  D('number-of-steps-to-reduce-a-number-to-zero', {
    t: 'Number of Steps to Reduce a Number to Zero',
    r: 'Each 1 bit costs a subtract and each bit position (except the top) costs a halving: steps = popcount + bitLength − 1 (0 for zero).',
    g: R => ({ num: R.int(0, 200) }),
    s(I, T) { let n = I.num, s = 0; while (n) { n = n & 1 ? n - 1 : n >> 1; s++; if (s <= 6) { T.at({ num: bin(n) }); T.n('Steps so far?', s, 'Odd → −1, even → ÷2.'); } } return s; }
  });

  D('sort-integers-by-the-number-of-1-bits', {
    t: 'Sort Integers by The Number of 1 Bits',
    r: 'Sort by (popcount, value).',
    g: R => ({ arr: R.ints(R.int(1, 8), 0, 20) }),
    s(I, T) { I.arr.slice(0, 5).forEach(x => { T.at({ x, binary: bin(x) }); T.n(`Set bits in ${x}?`, pc(x), 'Primary sort key.'); }); return I.arr.slice().sort((a, b) => pc(a) - pc(b) || a - b); }
  });

  D('number-of-steps-to-reduce-a-number-in-binary-representation-to-one', {
    t: 'Number of Steps to Reduce a Number in Binary Representation to One',
    r: 'Scan from the lowest bit up to (not including) the top with a carry: if bit + carry is 1, it is odd → add 1 then halve (2 steps, carry = 1); otherwise 1 step. Add the final carry.',
    g: R => ({ s: '1' + R.str(R.int(0, 8), '01') }),
    s(I, T) { let carry = 0, steps = 0; for (let i = I.s.length - 1; i > 0; i--) { const b = +I.s[i] + carry; if (b === 1) { steps += 2; carry = 1; } else steps += 1; if (I.s.length - i <= 6) { T.at({ s: A([...I.s], { i }), carry }); T.n('Steps so far?', steps, 'Odd costs 2 (add, halve); even costs 1.'); } } return steps + carry; }
  });

  D('xor-operation-in-an-array', {
    t: 'XOR Operation in an Array',
    r: 'XOR start + 2i for i = 0..n−1.',
    g: R => ({ n: R.int(1, 8), start: R.int(0, 10) }),
    s(I, T) { let x = 0; for (let i = 0; i < I.n; i++) { x ^= I.start + 2 * i; if (i < 6) { T.at({ element: I.start + 2 * i }); T.n('Running XOR?', x, 'XOR in start + 2i.'); } } return x; }
  });

  D('find-a-value-of-a-mysterious-function-closest-to-target', {
    t: 'Find a Value of a Mysterious Function Closest to Target',
    r: 'func is the AND of arr[l..r]. For each r, the set of ANDs of subarrays ending at r has at most ~20 values: AND each previous value with arr[r] and add arr[r]. Track the closest to target.',
    g: R => ({ arr: R.ints(R.int(1, 7), 1, 15), target: R.int(0, 15) }),
    s(I, T) { let S = new Set(), best = Infinity; I.arr.forEach((x, r) => { S = new Set([...S].map(v => v & x).concat([x])); for (const v of S) best = Math.min(best, Math.abs(v - I.target)); if (r < 6) { T.at({ arr: A(I.arr, { i: r }), ands: A([...S].sort((a, b) => a - b)) }); T.n('Closest distance so far?', best, 'Check every AND ending here.'); } }); return best; }
  });

  D('minimum-one-bit-operations-to-make-integers-zero', {
    t: 'Minimum One Bit Operations to Make Integers Zero',
    r: 'The answer is the inverse Gray code of n: XOR of n, n >> 1, n >> 2, … (equivalently f(2^k) = 2^(k+1) − 1 with alternating signs over set bits).',
    g: R => ({ n: R.int(0, 64) }),
    s(I, T) { let r = 0, n = I.n, k = 0; while (n) { r ^= n; n >>= 1; if (k++ < 5) { T.at({ shifted: bin(n), result: bin(r) }); T.n('Accumulated XOR?', r, 'XOR in the next shift.'); } } if (!k) { T.at({ n: 0 }); T.n('Operations?', 0, 'Already zero.'); } return r; }
  });

  D('concatenation-of-consecutive-binary-numbers', {
    t: 'Concatenation of Consecutive Binary Numbers',
    r: 'For i = 1..n: when i is a power of two the bit length grows; value = (value << len | i) mod 1e9+7.',
    g: R => ({ n: R.int(1, 20) }),
    s(I, T) { let v = 0n, len = 0; for (let i = 1; i <= I.n; i++) { if ((i & (i - 1)) === 0) len++; v = ((v << BigInt(len)) | BigInt(i)) % 1000000007n; if (i <= 5) { T.at({ i, binary: bin(i) }); T.n('Bit length used for this number?', len, 'Grows at powers of two.'); } } return Number(v); }
  });

  D('count-the-number-of-consistent-strings', {
    t: 'Count the Number of Consistent Strings',
    r: 'Make a bitmask of allowed letters; a word is consistent iff its mask has no bits outside it (wordMask & ~allowed == 0).',
    g: R => ({ allowed: R.distinct(R.int(1, 3), 0, 4).map(i => 'abcde'[i]).join(''), words: Array.from({ length: R.int(1, 6) }, () => R.str(R.int(1, 4), 'abcde')) }),
    s(I, T) { const m = [...I.allowed].reduce((s, c) => s | 1 << (c.charCodeAt(0) - 97), 0); let c = 0; I.words.forEach((w, i) => { const wm = [...w].reduce((s, ch) => s | 1 << (ch.charCodeAt(0) - 97), 0), ok = !(wm & ~m); if (ok) c++; if (i < 6) { T.at({ allowed: bin(m, 5), word: w, wordMask: bin(wm, 5) }); T.yn('Consistent?', ok, 'No letters outside allowed.'); } }); return c; }
  });
})();
