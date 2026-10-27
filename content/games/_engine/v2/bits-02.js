/* v2 games: bit manipulation (02). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const pc = x => { let c = 0; x = x >>> 0; while (x) { c += x & 1; x >>>= 1; } return c; };
  const bin = (x, w) => (x >>> 0).toString(2).padStart(w || 1, '0');
  const mask = w => [...w].reduce((s, c) => s | 1 << (c.charCodeAt(0) - 97), 0);
  const orK = {
    r: 'Brute force is fine here: for each start, extend right OR-ing values; stop at the first end where OR ≥ k and record the length. (The II version slides a window with per-bit counts.)',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 15), k: R.int(0, 15) }),
    s(I, T) { let best = Infinity; I.nums.forEach((_, i) => { let o = 0, here = 0; for (let j = i; j < I.nums.length; j++) { o |= I.nums[j]; if (o >= I.k) { here = j - i + 1; break; } } if (here) best = Math.min(best, here); if (i < 5) { T.at({ nums: A(I.nums, { i }), k: I.k }); T.n('Shortest special subarray starting here (0 if none)?', here, 'Extend until OR ≥ k.'); } }); return best === Infinity ? -1 : best; }
  };
  const evenTrip = {
    r: 'popcount(a ^ b ^ c) is even iff the parities of popcount(a), popcount(b), popcount(c) sum to even. Count even/odd-parity values in each array and combine: e·e·e + e·o·o + o·e·o + o·o·e.',
    g: R => ({ a: R.ints(R.int(1, 4), 0, 9), b: R.ints(R.int(1, 4), 0, 9), c: R.ints(R.int(1, 4), 0, 9) }),
    s(I, T) { const ev = arr => arr.filter(x => pc(x) % 2 === 0).length, [ea, eb, ec] = [ev(I.a), ev(I.b), ev(I.c)], [oa, ob, oc] = [I.a.length - ea, I.b.length - eb, I.c.length - ec]; T.at({ a: A(I.a.map(x => bin(x))) }); T.n('Values in a with an even number of set bits?', ea, 'Parity of popcount.'); T.at({ b: A(I.b.map(x => bin(x))) }); T.n('Values in b with an even number of set bits?', eb, 'Parity of popcount.'); const r = ea * eb * ec + ea * ob * oc + oa * eb * oc + oa * ob * ec; T.n('Triplets with an even XOR popcount?', r, 'Choose an even number of odd-parity values.'); return r; }
  };
  const minBitwise = {
    r: 'We need ans | (ans + 1) = num. Adding 1 flips the trailing ones of ans; so num must be odd (2 → −1), and the best ans clears the highest bit of num\'s trailing block of ones.',
    g: R => ({ nums: Array.from({ length: R.int(1, 6) }, () => R.pick([2, 3, 5, 7, 11, 13, 15, 23, 31, 37])) }),
    s(I, T) { return I.nums.map((x, i) => { if (x % 2 === 0) { if (i < 5) { T.at({ num: bin(x) }); T.yn('Is num odd?', false, 'Even numbers here are 2, which has no answer, so −1.'); } return -1; } let t = 0; while (x >> t & 1) t++; const v = x - (1 << (t - 1)); if (i < 5) { T.at({ num: bin(x), trailingOnes: t }); T.n('Minimal ans?', v, 'Clear the top bit of the trailing ones.'); } return v; }); }
  };

  D('decode-xored-array', {
    t: 'Decode XORed Array',
    r: 'arr[i + 1] = arr[i] ^ encoded[i], starting from first.',
    g: R => ({ encoded: R.ints(R.int(1, 6), 0, 9), first: R.int(0, 9) }),
    s(I, T) { const out = [I.first]; I.encoded.forEach((e, i) => { out.push(out[i] ^ e); if (i < 6) { T.at({ arr: A(out.slice(0, -1)), encoded: e }); T.n('Next element?', out[i + 1], 'previous ^ encoded[i].'); } }); return out; }
  });

  D('decode-xored-permutation', {
    t: 'Decode XORed Permutation',
    r: 'XOR of 1..n is known. XOR of encoded at odd indices equals perm[1] ^ … ^ perm[n−1], so perm[0] = total ^ that. Then decode forward.',
    g: R => { const n = 2 * R.int(1, 3) + 1, p = R.shuffle([...Array(n).keys()].map(x => x + 1)); return { encoded: p.slice(1).map((x, i) => x ^ p[i]) }; },
    s(I, T) { const n = I.encoded.length + 1; let tot = 0; for (let i = 1; i <= n; i++) tot ^= i; let odd = 0; for (let i = 1; i < I.encoded.length; i += 2) odd ^= I.encoded[i]; T.at({ encoded: A(I.encoded), n }); T.n('XOR of 1 to n?', tot, 'All values of the permutation.'); T.n('First element?', tot ^ odd, 'The total, XORed with the encoded values at odd indices.'); const out = [tot ^ odd]; I.encoded.forEach((e, i) => out.push(out[i] ^ e)); T.n('Last element?', out[n - 1], 'Keep XORing with encoded.'); return out; }
  });

  D('find-xor-sum-of-all-pairs-bitwise-and', {
    t: 'Find XOR Sum of All Pairs Bitwise AND',
    r: 'AND distributes over XOR: XOR of all (a & b) = (XOR of arr1) & (XOR of arr2).',
    g: R => ({ arr1: R.ints(R.int(1, 4), 0, 15), arr2: R.ints(R.int(1, 4), 0, 15) }),
    s(I, T) { const res = (() => { const x = I.arr1.reduce((a, b) => a ^ b, 0), y = I.arr2.reduce((a, b) => a ^ b, 0); T.at({ arr1: A(I.arr1) }); T.n('XOR of arr1?', x, 'XOR all of them together.'); T.at({ arr2: A(I.arr2) }); T.n('XOR of arr2?', y, 'XOR all of them together.'); return x & y; })(); T.n('XOR sum of all pairwise ANDs?', res, 'The first XOR AND the second XOR.'); return res; }
  });

  D('two-out-of-three', {
    t: 'Two Out of Three',
    r: 'Give each value a 3-bit mask of which arrays contain it; keep values whose mask has at least two bits.',
    g: R => ({ nums1: R.ints(R.int(1, 4), 1, 5), nums2: R.ints(R.int(1, 4), 1, 5), nums3: R.ints(R.int(1, 4), 1, 5) }),
    cmp: 'set',
    s(I, T) { const m = {}; [I.nums1, I.nums2, I.nums3].forEach((arr, k) => arr.forEach(v => m[v] = (m[v] || 0) | 1 << k)); T.at({ masks: K(Object.fromEntries(Object.entries(m).map(([v, x]) => [v, bin(x, 3)]))) }); const out = Object.keys(m).filter(v => pc(m[v]) >= 2).map(Number); T.n('Distinct values across the arrays?', Object.keys(m).length, 'One mask each.'); T.n('Values in all three arrays?', Object.values(m).filter(x => x === 7).length, 'Mask 111.'); T.n('How many values qualify?', out.length, 'A mask with at least 2 bits set.'); return out; }
  });

  D('rings-and-rods', {
    t: 'Rings and Rods',
    r: 'Each rod gets a 3-bit color mask (R, G, B). Count rods whose mask is 0b111.',
    g: R => ({ rings: Array.from({ length: R.int(1, 8) }, () => R.pick(['R', 'G', 'B']) + R.int(0, 3)).join('') }),
    s(I, T) { const m = Array(10).fill(0); for (let i = 0; i < I.rings.length; i += 2) m[+I.rings[i + 1]] |= { R: 1, G: 2, B: 4 }[I.rings[i]]; T.at({ masks: A(m.slice(0, 4).map(x => bin(x, 3))) }); const c = m.filter(x => x === 7).length; T.n('Rings in total?', I.rings.length / 2, 'Two characters per ring.'); T.n('Rods with at least one ring?', m.filter(x => x).length, 'Mask is not 0.'); T.n('Rods with all three colors?', c, 'Mask 111 means red, green and blue.'); return c; }
  });

  D('count-words-obtained-after-adding-a-letter', {
    t: 'Count Words Obtained After Adding a Letter',
    r: 'Store start-word letter masks in a set. A target works if removing one of its letters gives a mask in the set (append a new letter, then rearrange).',
    g: R => ({ startWords: Array.from({ length: R.int(1, 4) }, () => R.distinct(R.int(1, 3), 0, 5).map(i => 'abcdef'[i]).join('')), targetWords: Array.from({ length: R.int(1, 4) }, () => R.distinct(R.int(2, 4), 0, 5).map(i => 'abcdef'[i]).join('')) }),
    s(I, T) { const S = new Set(I.startWords.map(mask)); let c = 0; I.targetWords.forEach((w, i) => { const m = mask(w), ok = [...w].some(ch => S.has(m ^ 1 << (ch.charCodeAt(0) - 97))); if (ok) c++; if (i < 5) { T.at({ target: w, startMasks: A([...S].map(x => bin(x, 6))) }); T.yn('Can it be obtained?', ok, 'Drop one letter → a start mask.'); } }); return c; }
  });

  D('divide-array-into-equal-pairs', {
    t: 'Divide Array Into Equal Pairs',
    r: 'Toggle each value in a set (add if absent, remove if present); pairs are possible iff the set ends empty.',
    g: R => ({ nums: R.ints(2 * R.int(1, 4), 1, 4) }),
    s(I, T) { const S = new Set(); I.nums.forEach((x, i) => { S.has(x) ? S.delete(x) : S.add(x); if (i < 8) { T.at({ nums: A(I.nums, { i }), unpaired: A([...S]) }); T.n('Unpaired values right now?', S.size, 'Toggle.'); } }); return S.size === 0; }
  });

  D('minimum-bit-flips-to-convert-number', {
    t: 'Minimum Bit Flips to Convert Number',
    r: 'The bits that differ are the set bits of start ^ goal; count them.',
    g: R => ({ start: R.int(0, 63), goal: R.int(0, 63) }),
    s(I, T) { const res = (() => { const x = I.start ^ I.goal; T.at({ start: bin(I.start, 6), goal: bin(I.goal, 6) }); T.yn('Are start and goal equal?', I.start === I.goal, 'Then no flips are needed.'); T.n('start XOR goal?', x, 'Its set bits are the differing bits.'); return pc(x); })(); T.n('Bit flips needed?', res, 'Count the set bits.'); return res; }
  });

  D('largest-combination-with-bitwise-and-greater-than-zero', {
    t: 'Largest Combination With Bitwise AND Greater Than Zero',
    r: 'A combination has AND > 0 iff all members share some bit. For each bit, count candidates with it set; the max count is the answer.',
    g: R => ({ candidates: R.ints(R.int(1, 7), 1, 31) }),
    s(I, T) { let best = 0; for (let b = 0; b < 5; b++) { const c = I.candidates.filter(x => x >> b & 1).length; best = Math.max(best, c); T.at({ candidates: A(I.candidates.map(x => bin(x, 5))), bit: b }); T.n(`Candidates with bit ${b}?`, c, 'They can all be combined.'); } return best; }
  });

  D('naming-a-company', {
    t: 'Naming a Company',
    r: 'Group suffixes by first letter. For letters a ≠ b with k common suffixes, valid names = 2 · (|A| − k) · (|B| − k).',
    g: R => ({ ideas: [...new Set(Array.from({ length: R.int(2, 6) }, () => R.pick(['c', 'd', 't']) + R.pick(['offee', 'onuts', 'ime', 'ea'])))] }),
    s(I, T) { const g = {}; I.ideas.forEach(w => (g[w[0]] = g[w[0]] || new Set()).add(w.slice(1))); const L = Object.keys(g).sort(); let t = 0; for (let i = 0; i < L.length; i++) for (let j = i + 1; j < L.length; j++) { const k = [...g[L[i]]].filter(s => g[L[j]].has(s)).length, add = 2 * (g[L[i]].size - k) * (g[L[j]].size - k); t += add; T.at({ letters: `${L[i]} & ${L[j]}`, common: k }); T.n('Names from this letter pair?', add, '2 · (|A| − k) · (|B| − k).'); } if (L.length < 2) { T.at({ groups: L.length }); T.n('Names?', 0, 'Need two different first letters.'); } return t; }
  });

  D('maximum-xor-after-operations', {
    t: 'Maximum XOR After Operations',
    r: 'The operation can only clear bits of an element, so any bit present in some element can be kept in exactly one: the answer is the OR of all elements.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 15) }),
    s(I, T) { let o = 0; I.nums.forEach((x, i) => { o |= x; if (i < 6) { T.at({ nums: A(I.nums.map(v => bin(v, 4)), { i }) }); T.n('OR so far?', o, 'Every available bit.'); } }); return o; }
  });

  D('first-letter-to-appear-twice', {
    t: 'First Letter to Appear Twice',
    r: 'Keep a 26-bit seen mask; the first letter whose bit is already set is the answer.',
    g: R => { const s = R.str(R.int(1, 6), 'abcde'); return { s: s + R.pick([...s]) + R.str(R.int(0, 3), 'abcde') }; },
    s(I, T) { let m = 0; for (const [i, c] of [...I.s].entries()) { const b = 1 << (c.charCodeAt(0) - 97), hit = !!(m & b); T.at({ s: A([...I.s], { i }), seen: bin(m, 5) }); T.yn(`Seen "${c}" before?`, hit, 'Bit already set.'); if (hit) return c; m |= b; } }
  });

  D('find-the-original-array-of-prefix-xor', {
    t: 'Find The Original Array of Prefix Xor',
    r: 'arr[0] = pref[0]; arr[i] = pref[i] ^ pref[i − 1].',
    g: R => ({ pref: R.ints(R.int(1, 7), 0, 15) }),
    s(I, T) { return I.pref.map((p, i) => { const v = i ? p ^ I.pref[i - 1] : p; if (i < 6) { T.at({ pref: A(I.pref, { i }) }); T.n(`arr[${i}]?`, v, 'pref[i] ^ pref[i − 1].'); } return v; }); }
  });

  D('count-pairs-of-similar-strings', {
    t: 'Count Pairs Of Similar Strings',
    r: 'Two words are similar iff their letter-set masks are equal. Count masks; each new word pairs with all earlier equal masks.',
    g: R => ({ words: Array.from({ length: R.int(1, 6) }, () => R.str(R.int(1, 4), 'abc')) }),
    s(I, T) { const c = new Map(); let t = 0; I.words.forEach((w, i) => { const m = mask(w); t += c.get(m) || 0; c.set(m, (c.get(m) || 0) + 1); if (i < 6) { T.at({ word: w, mask: bin(m, 3) }); T.n('Similar pairs so far?', t, 'Earlier words with the same mask.'); } }); return t; }
  });

  D('find-xor-beauty-of-array', {
    t: 'Find Xor-Beauty of Array',
    r: 'Over all (i, j, k), symmetric terms cancel in pairs and the XOR of ((a | b) & c) collapses to the XOR of all elements.',
    g: R => ({ nums: R.ints(R.int(1, 4), 0, 15) }),
    s(I, T) { let x = 0; I.nums.forEach((v, i) => { x ^= v; T.at({ nums: A(I.nums, { i }) }); T.n('Running XOR?', x, 'The beauty equals the XOR of all.'); }); return x; }
  });

  D('apply-bitwise-operations-to-make-strings-equal', {
    t: 'Apply Bitwise Operations to Make Strings Equal',
    r: 'Any string with at least one 1 can reach any other string with at least one 1, and all-zero strings are stuck. So the answer is (s has a 1) == (target has a 1).',
    g: R => { const n = R.int(1, 6); return { s: R.str(n, R.chance(0.2) ? '0' : '01'), target: R.str(n, R.chance(0.2) ? '0' : '01') }; },
    s(I, T) { const res = (() => { const a = I.s.includes('1'), b = I.target.includes('1'); T.at({ s: I.s }); T.yn('Does s contain a 1?', a, 'Needed to create or move ones.'); T.at({ target: I.target }); T.yn('Does target contain a 1?', b, 'Must match.'); return a === b; })(); T.yn('Can s become target?', res, 'Both have a 1, or neither does.'); return res; }
  });

  D('substring-xor-queries', {
    t: 'Substring XOR Queries',
    r: 'We need the substring whose value equals first ^ second. Values fit in 30 bits, so precompute, for every start and length ≤ 30, the value → shortest (then leftmost) [l, r] in a map.',
    g: R => { const s = R.str(R.int(1, 8), '01'); return { s, queries: Array.from({ length: R.int(1, 3) }, () => [R.int(0, 9), R.int(0, 9)]) }; },
    s(I, T) { const m = new Map(); for (let L = 1; L <= Math.min(30, I.s.length); L++) for (let l = 0; l + L <= I.s.length; l++) { const v = parseInt(I.s.substr(l, L), 2); if (!m.has(v)) m.set(v, [l, l + L - 1]); } return I.queries.map(([a, b], i) => { const v = a ^ b, r = m.get(v) || [-1, -1]; if (i < 3) { T.at({ s: A([...I.s], r[0] >= 0 ? { win: r } : {}), query: `${a} ^ ${b}` }); T.n('Value to find?', v, 'first ^ second.'); } return r; }); }
  });

  D('number-of-even-and-odd-bits', {
    t: 'Number of Even and Odd Bits',
    r: 'Count set bits at even positions (n & 0x555…) and at odd positions (n & 0xAAA…).',
    g: R => ({ n: R.int(1, 1000) }),
    s(I, T) { const e = pc(I.n & 0x55555555), o = pc(I.n & 0xaaaaaaaa); T.at({ n: bin(I.n) }); T.n('Set bits at even positions?', e, 'Mask 0101…'); T.n('Set bits at odd positions?', o, 'Mask 1010…'); T.n('Set bits in total?', pc(I.n), 'The two counts added.'); return [e, o]; }
  });

  D('find-the-prefix-common-array-of-two-arrays', {
    t: 'Find the Prefix Common Array of Two Arrays',
    r: 'Keep bitmasks of values seen in A and in B; the answer at i is popcount(maskA & maskB).',
    g: R => { const n = R.int(1, 7); return { A: R.shuffle([...Array(n).keys()].map(x => x + 1)), B: R.shuffle([...Array(n).keys()].map(x => x + 1)) }; },
    s(I, T) { let a = 0, b = 0; return I.A.map((x, i) => { a |= 1 << x; b |= 1 << I.B[i]; const v = pc(a & b); if (i < 6) { T.at({ A: A(I.A, { i }), B: A(I.B, { i }) }); T.n('Common values so far?', v, 'popcount(maskA & maskB).'); } return v; }); }
  });

  D('neighboring-bitwise-xor', {
    t: 'Neighboring Bitwise XOR',
    r: 'Every original bit appears twice in the XOR of all derived values (circularly), so a valid original exists iff XOR(derived) = 0.',
    g: R => ({ derived: R.ints(R.int(1, 8), 0, 1) }),
    s(I, T) { const res = (() => { const x = I.derived.reduce((a, b) => a ^ b, 0); T.at({ derived: A(I.derived) }); T.n('How many 1s in derived?', I.derived.filter(Boolean).length, 'Their parity decides it.'); T.n('XOR of all derived values?', x, 'Must be 0.'); return x === 0; })(); T.yn('Does a valid original array exist?', res, 'Only when the XOR is 0.'); return res; }
  });

  D('find-the-k-th-lucky-number', {
    t: 'Find the K-th Lucky Number',
    r: 'Lucky numbers of length L are L-bit binary strings with 0→4 and 1→7. The k-th one is the binary of k + 1 without its leading 1, mapped.',
    g: R => ({ k: R.int(1, 40) }),
    s(I, T) { const res = (() => { const b = bin(I.k + 1).slice(1); T.at({ k: I.k, 'k + 1 in binary': bin(I.k + 1) }); T.n('Number of digits?', b.length, 'Bits after the leading 1.'); T.n('Lucky numbers with fewer digits?', 2 ** b.length - 2, '2 + 4 + 8 + … for the shorter lengths.'); return [...b].map(c => c === '0' ? '4' : '7').join(''); })(); T.n('How many 7s in the answer?', [...res].filter(c => c === '7').length, 'Each 1 bit becomes a 7.'); return res; }
  });

  D('count-pairs-of-points-with-distance-k', {
    t: 'Count Pairs of Points With Distance K',
    r: 'distance = (x1 ^ x2) + (y1 ^ y2) = k. For each point and each split a + (k − a), look up the partner (x ^ a, y ^ (k − a)) among earlier points in a hash map.',
    g: R => ({ coordinates: Array.from({ length: R.int(2, 6) }, () => [R.int(0, 5), R.int(0, 5)]), k: R.int(0, 5) }),
    s(I, T) { const m = new Map(); let t = 0; I.coordinates.forEach(([x, y], i) => { let add = 0; for (let a = 0; a <= I.k; a++) add += m.get((x ^ a) + ',' + (y ^ (I.k - a))) || 0; t += add; m.set(x + ',' + y, (m.get(x + ',' + y) || 0) + 1); if (i < 6) { T.at({ point: `${x},${y}`, k: I.k }); T.n('Earlier partners at distance k?', add, 'Try every split of k.'); } }); return t; }
  });

  D('sum-of-values-at-indices-with-k-set-bits', {
    t: 'Sum of Values at Indices With K Set Bits',
    r: 'Add nums[i] for indices i with exactly k set bits.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 9), k: R.int(0, 3) }),
    s(I, T) { let s = 0; I.nums.forEach((x, i) => { const ok = pc(i) === I.k; if (ok) s += x; if (i < 7) { T.at({ index: i, binary: bin(i), k: I.k }); T.yn('Does this index have k set bits?', ok, `It has ${pc(i)}.`); } }); return s; }
  });

  D('minimum-operations-to-collect-elements', {
    t: 'Minimum Operations to Collect Elements',
    r: 'Pop from the end, setting bits for values ≤ k; stop when the mask covers 1..k.',
    g: R => { const k = R.int(1, 4), a = R.shuffle([...[...Array(k).keys()].map(x => x + 1), ...R.ints(R.int(0, 4), 1, 6)]); return { nums: a, k }; },
    s(I, T) { let m = 0, ops = 0; const full = (1 << I.k) - 1; for (let i = I.nums.length - 1; i >= 0; i--) { ops++; if (I.nums[i] <= I.k) m |= 1 << (I.nums[i] - 1); T.at({ nums: A(I.nums, { i }), collected: bin(m, I.k) }); T.yn('Collected all of 1..k?', m === full, 'Mask full.'); if (m === full) return ops; } return ops; }
  });

  D('find-the-k-or-of-an-array', {
    t: 'Find the K-or of an Array',
    r: 'Bit b is set in the answer if at least k numbers have bit b set.',
    g: R => { const a = R.ints(R.int(1, 6), 0, 15); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { let r = 0; for (let b = 0; b < 4; b++) { const c = I.nums.filter(x => x >> b & 1).length; if (c >= I.k) r |= 1 << b; T.at({ nums: A(I.nums.map(x => bin(x, 4))), bit: b, k: I.k }); T.n(`Numbers with bit ${b}?`, c, 'Set it if ≥ k.'); } return r; }
  });

  D('maximum-strong-pair-xor-i', {
    t: 'Maximum Strong Pair XOR I',
    r: 'A pair (x, y) is strong if |x − y| ≤ min(x, y). Check every pair (the II version uses a sorted window with a binary trie) and maximize x ^ y.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 12) }),
    s(I, T) { const res = (() => { let best = 0, asks = 0; T.at({ nums: A(I.nums) }); T.n('Largest value?', Math.max(...I.nums), 'A strong pair needs the gap to be at most the smaller value.'); for (const x of I.nums) for (const y of I.nums) if (Math.abs(x - y) <= Math.min(x, y)) { if ((x ^ y) > best) { best = x ^ y; if (asks++ < 5) { T.at({ pair: `${x}, ${y}` }); T.n('XOR of this strong pair?', x ^ y, 'New best.'); } } } if (!asks) { T.at({ nums: A(I.nums) }); T.n('Best XOR?', 0, 'Only x with itself.'); } return best; })(); T.n('Maximum strong pair XOR?', res, 'The best found.'); return res; }
  });

  D('check-if-bitwise-or-has-trailing-zeros', {
    t: 'Check if Bitwise OR Has Trailing Zeros',
    r: 'An OR has a trailing zero iff every chosen number is even. So we need at least two even numbers.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 12) }),
    s(I, T) { const res = (() => { const e = I.nums.filter(x => x % 2 === 0).length; T.at({ nums: A(I.nums) }); T.n('How many odd numbers?', I.nums.length - e, 'Any odd number sets the last bit.'); T.n('How many even numbers?', e, 'Need at least two.'); return e >= 2; })(); T.yn('Can two or more numbers OR to a trailing zero?', res, 'Pick two even numbers.'); return res; }
  });

  D('minimum-number-of-operations-to-make-array-xor-equal-to-k', {
    t: 'Minimum Number of Operations to Make Array XOR Equal to K',
    r: 'Each flip toggles one bit of the total XOR, so the answer is popcount(XOR(nums) ^ k).',
    g: R => ({ nums: R.ints(R.int(1, 5), 0, 15), k: R.int(0, 15) }),
    s(I, T) { const res = (() => { const x = I.nums.reduce((a, b) => a ^ b, 0); T.at({ nums: A(I.nums), k: I.k }); T.n('XOR of the array?', x, 'XOR all of them together.'); T.n('That XOR, XOR k?', x ^ I.k, 'Its set bits must be flipped.'); return pc(x ^ I.k); })(); T.n('Fewest operations?', res, 'Count the set bits.'); return res; }
  });

  D('find-if-array-can-be-sorted', {
    t: 'Find if Array Can Be Sorted',
    r: 'Adjacent swaps are allowed only between equal popcounts, so maximal runs with the same popcount can be sorted internally but never cross. Check each run\'s min ≥ the previous run\'s max.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 16) }),
    s(I, T) { let prevMax = -Infinity, i = 0; while (i < I.nums.length) { let j = i, mn = Infinity, mx = -Infinity; while (j < I.nums.length && pc(I.nums[j]) === pc(I.nums[i])) { mn = Math.min(mn, I.nums[j]); mx = Math.max(mx, I.nums[j]); j++; } const ok = mn >= prevMax; T.at({ nums: A(I.nums, { win: [i, j - 1] }), setBits: pc(I.nums[i]), previousMax: prevMax === -Infinity ? '—' : prevMax }); T.yn('Does this run fit after the previous one?', ok, 'min ≥ previous max.'); if (!ok) return false; prevMax = mx; i = j; } return true; }
  });

  D('guess-the-number-using-bitwise-questions-i', {
    t: 'Guess the Number Using Bitwise Questions I',
    r: 'commonSetBits(2^i) is 1 exactly when bit i of n is set. Ask once per bit and assemble n.',
    g: R => ({ n: R.int(1, 63) }),
    s(I, T) { let r = 0; for (let b = 0; b < 6; b++) { const ans = pc(I.n & (1 << b)); T.at({ ask: `commonSetBits(${1 << b})`, built: bin(r, 6) }); T.n('API answer?', ans, `1 iff bit ${b} of n is set.`); if (ans) r |= 1 << b; } for (let b = 6; b < 30; b++) if (I.n >> b & 1) r |= 1 << b; return r; }
  });

  D('guess-the-number-using-bitwise-questions-ii', {
    t: 'Guess the Number Using Bitwise Questions II',
    r: 'commonBits(num) counts equal bit positions, then n ^= num. Ask 2^i twice: the second call restores n. If the first answer is larger than the second, bit i of the original n was 1.',
    g: R => ({ n: R.int(0, 63) }),
    s(I, T) { let n = I.n, r = 0; const W = 30, ask = num => { const c = W - pc(n ^ num); n ^= num; return c; }; for (let b = 0; b < 6; b++) { const a1 = ask(1 << b), a2 = ask(1 << b); T.at({ ask: `commonBits(${1 << b}) twice`, answers: `${a1}, ${a2}` }); T.yn(`Was bit ${b} set?`, a1 > a2, 'First answer larger ⇒ the bit was 1.'); if (a1 > a2) r |= 1 << b; } for (let b = 6; b < 30; b++) if (I.n >> b & 1) r |= 1 << b; return r; }
  });

  D('shortest-subarray-with-or-at-least-k-i', { t: 'Shortest Subarray With OR at Least K I', ...orK });

  D('minimum-array-end', {
    t: 'Minimum Array End',
    r: 'Every element must contain x\'s bits. The n-th smallest such number is x with the bits of n − 1 written into x\'s zero positions, from low to high.',
    g: R => ({ n: R.int(1, 10), x: R.int(1, 20) }),
    s(I, T) { let r = BigInt(I.x), m = BigInt(I.n - 1), b = 0n, k = 0; while (m) { if (!((r >> b) & 1n)) { if (k++ < 5) { T.at({ result: r.toString(2), position: Number(b) }); T.n('Bit of n − 1 written here?', Number(m & 1n), 'Fill x\'s zero bits in order.'); } r |= (m & 1n) << b; m >>= 1n; } b++; } if (!k) { T.at({ n: I.n, x: I.x }); T.n('Answer when n = 1?', I.x, 'Just x.'); } return Number(r); }
  });

  D('find-the-xor-of-numbers-which-appear-twice', {
    t: 'Find the XOR of Numbers Which Appear Twice',
    r: 'Use a seen bitmask (values ≤ 50); when a value is seen again, XOR it into the answer.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6) }),
    s(I, T) { let seen = 0n, x = 0; I.nums.forEach((v, i) => { const b = 1n << BigInt(v); if (seen & b) x ^= v; else seen |= b; if (i < 7) { T.at({ nums: A(I.nums, { i }) }); T.n('Answer so far?', x, 'XOR values on their second appearance.'); } }); return x; }
  });

  D('bitwise-or-of-adjacent-elements', {
    t: 'Bitwise OR of Adjacent Elements',
    r: 'answer[i] = nums[i] | nums[i + 1].',
    g: R => ({ nums: R.ints(R.int(2, 7), 0, 15) }),
    s(I, T) { return I.nums.slice(1).map((y, i) => { const v = I.nums[i] | y; if (i < 5) { T.at({ pair: `${bin(I.nums[i], 4)} | ${bin(y, 4)}` }); T.n('OR?', v, 'Adjacent pair.'); } return v; }); }
  });

  D('count-triplets-with-even-xor-set-bits-i', { t: 'Count Triplets with Even XOR Set Bits I', ...evenTrip });
  D('count-triplets-with-even-xor-set-bits-ii', { t: 'Count Triplets with Even XOR Set Bits II', ...evenTrip });

  D('number-of-bit-changes-to-make-two-integers-equal', {
    t: 'Number of Bit Changes to Make Two Integers Equal',
    r: 'We can only turn 1s of n into 0s, so k must be a submask of n ((n & k) == k). Then the answer is popcount(n ^ k); otherwise −1.',
    g: R => ({ n: R.int(0, 31), k: R.int(0, 31) }),
    s(I, T) { const res = (() => { const ok = (I.n & I.k) === I.k; T.at({ n: bin(I.n, 5), k: bin(I.k, 5) }); T.yn('Is k a submask of n?', ok, 'n AND k must equal k.'); T.n('n XOR k?', I.n ^ I.k, 'Bits that differ.'); return ok ? pc(I.n ^ I.k) : -1; })(); T.n('Changes needed (−1 if impossible)?', res, 'Turn off each differing bit of n.'); return res; }
  });

  D('find-the-k-th-character-in-string-game-i', {
    t: 'Find the K-th Character in String Game I',
    r: 'Each doubling appends a shifted copy, so position k − 1 has been shifted once per set bit of k − 1: the answer is \'a\' + popcount(k − 1) (mod 26).',
    g: R => ({ k: R.int(1, 500) }),
    s(I, T) { const res = (() => { T.at({ k: I.k, 'k − 1 in binary': bin(I.k - 1) }); let L = 1; while (L < I.k) L *= 2; T.n('Shortest word length that reaches k?', L, 'The word doubles each round.'); T.n('Set bits in k − 1?', pc(I.k - 1), 'One shift per set bit.'); return String.fromCharCode(97 + pc(I.k - 1) % 26); })(); T.c('Which character?', [...new Set([res, 'a', 'b', 'c'])], res, 'a shifted once per set bit.'); return res; }
  });

  D('find-the-k-th-character-in-string-game-ii', {
    t: 'Find the K-th Character in String Game II',
    r: 'Bit i of k − 1 says position k lies in the second half at doubling i; that half was shifted iff operations[i] = 1. Sum operations[i] over set bits of k − 1, mod 26.',
    g: R => { const ops = R.ints(R.int(1, 6), 0, 1); return { k: R.int(1, 2 ** ops.length), operations: ops }; },
    s(I, T) { let s = 0; const m = I.k - 1; I.operations.forEach((op, i) => { if (m >> i & 1) { s += op; T.at({ 'k − 1': bin(m), bit: i, op }); T.n('Total shift so far?', s, 'Add operations[i] for set bits.'); } }); if (!m) { T.at({ k: 1 }); T.n('Shift?', 0, 'The very first character.'); } return String.fromCharCode(97 + s % 26); }
  });

  D('maximum-possible-number-by-binary-concatenation', {
    t: 'Maximum Possible Number by Binary Concatenation',
    r: 'Try all 6 orders of the three numbers, concatenate their binary strings, and take the largest value (equivalently sort by a + b > b + a).',
    g: R => ({ nums: R.ints(3, 1, 20) }),
    s(I, T) { const b = I.nums.map(x => bin(x)), orders = [[0, 1, 2], [0, 2, 1], [1, 0, 2], [1, 2, 0], [2, 0, 1], [2, 1, 0]]; let best = 0; orders.forEach((o, i) => { const v = parseInt(o.map(j => b[j]).join(''), 2); best = Math.max(best, v); if (i < 4) { T.at({ order: A(o.map(j => b[j])) }); T.n('Value of this concatenation?', v, 'Read as binary.'); } }); return best; }
  });

  D('construct-the-minimum-bitwise-array-i', { t: 'Construct the Minimum Bitwise Array I', ...minBitwise });
  D('construct-the-minimum-bitwise-array-ii', { t: 'Construct the Minimum Bitwise Array II', ...minBitwise });

  D('smallest-number-with-all-set-bits', {
    t: 'Smallest Number With All Set Bits',
    r: 'The answer is the smallest 2^k − 1 ≥ n: one less than the next power of two above n\'s top bit.',
    g: R => ({ n: R.int(1, 1000) }),
    s(I, T) { const res = (() => { let x = 1; while (x < I.n) x = x * 2 + 1; T.at({ n: bin(I.n) }); T.yn('Is n already all ones?', x === I.n, 'Then n itself is the answer.'); T.n('Number of bits in n?', bin(I.n).length, 'All of them set.'); return x; })(); T.n('Smallest such number?', res, 'That many ones.'); return res; }
  });
})();
