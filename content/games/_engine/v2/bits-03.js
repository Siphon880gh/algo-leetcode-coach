/* v2 games: bits (03). Guides scored in the 3483–4041 pass. */
(function () {
  'use strict';
  const { D, A, G, K, S, Q, X, Tr, TR, GR, LL, Ls, IV, show } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const lcm = (a, b) => a / gcd(a, b) * b;
  const MOD = 1000000007;
  const range = (a, b) => Array.from({ length: Math.max(0, b - a) }, (_, i) => a + i);
  const fmt = a => typeof a === 'string' ? JSON.stringify(a) : Array.isArray(a) ? JSON.stringify(a) : String(a);
  const digits = x => String(Math.abs(x)).split('').map(Number);
  const isPal = s => s === s.split('').reverse().join('');
  const popc = x => { let c = 0; while (x) { c += x & 1; x >>>= 1; } return c; };
  const isPrime = x => { if (x < 2) return false; for (let d = 2; d * d <= x; d++) if (x % d === 0) return false; return true; };
  // Design problems: ops[0] constructs, the rest are method calls; asks about returned values.
  // o.view(obj) -> board, o.why(op, args, r, obj) -> feedback, o.strOpts / o.arrOpts(obj, r) -> distractors, o.skip(op) -> don't ask.
  const play = (I, T, make, o) => { o = o || {}; const obj = make(...(I.args[0] || [])), out = [null]; let asks = 0; const max = o.max || 7; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], args = I.args[i] || [], before = o.view ? o.view(obj) : {}; let r = obj[op](...args); if (r === undefined) r = null; out.push(r); if (asks >= max || r === null || (o.skip && o.skip(op))) continue; const label = `${op}(${args.map(fmt).join(', ')})`, why = o.why ? o.why(op, args, r, obj) : 'Follow the structure\'s invariant.'; T.at(Object.assign({ call: label }, before)); if (typeof r === 'number' && Number.isFinite(r)) { T.n(`What does ${label} return?`, r, why); asks++; } else if (typeof r === 'boolean') { T.yn(`Does ${label} return true?`, r, why); asks++; } else if (typeof r === 'string') { const opts = [...new Set([r, ...(o.strOpts ? o.strOpts(obj, r) : []), r === '' ? 'null' : ''])].slice(0, 4); if (opts.length > 1) { T.c(`What does ${label} return?`, opts.map(x => x === '' ? '""' : x), r === '' ? '""' : r, why); asks++; } } else if (Array.isArray(r)) { const opts = o.arrOpts ? o.arrOpts(obj, r, op) : null; if (opts) { T.c(`What does ${label} return?`, [r, ...opts].map(show), show(r), why); } else T.n(`How many items does ${label} return?`, r.length, why); asks++; } } if (!asks) { T.at({ calls: I.ops.length - 1 }); T.n('How many method calls follow the constructor?', I.ops.length - 1, 'Count the operations.'); } return out; };
  const seq = (R, ctor, ctorArgs, n, step, st) => { const ops = [ctor], args = [ctorArgs]; st = st || {}; for (let i = 0; i < n; i++) { const x = step(R, st); if (!x) break; ops.push(x[0]); args.push(x[1]); } return { ops, args }; };
  // Children lists of a tree given as undirected edges ([u, v] or [u, v, w]); ids 0..n-1 (or 1..n with base 1).
  const kids = (n, edges, root, base) => { base = base || 0; const adj = Array.from({ length: n + base }, () => []); edges.forEach(e => { adj[e[0]].push([e[1], e[2]]); adj[e[1]].push([e[0], e[2]]); }); const ch = Array.from({ length: n + base }, () => []), par = Array(n + base).fill(-1), order = [root], seen = new Set([root]); for (let i = 0; i < order.length; i++) for (const [v, w] of adj[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; ch[order[i]].push(v); order.push(v); } return { ch, par, order, adj }; };

  D('minimum-operations-to-make-array-elements-zero', {
    t: 'Minimum Operations to Make Array Elements Zero',
    r: 'Number x needs floor(log4 x) + 1 divisions by 4 to reach 0, and each operation does two divisions at once. For a range [l, r], add up the steps and take ceil(total / 2).',
    g: R => ({ queries: Array.from({ length: R.int(1, 2) }, () => { const l = R.int(1, 40); return [l, l + R.int(1, 5)]; }) }),
    s(I, T) { let ans = 0; const st = x => { let c = 0; while (x) { x = Math.floor(x / 4); c++; } return c; }; I.queries.forEach(([l, r]) => { let tot = 0; for (let x = l; x <= r; x++) { const s = st(x); tot += s; if (x - l < 3) { T.at({ query: `[${l}, ${r}]`, x }); T.n(`Divisions by 4 to bring ${x} to 0?`, s, `${x} lies in [4^${s - 1}, 4^${s}).`); } } T.at({ query: `[${l}, ${r}]`, totalSteps: tot }); T.n(`Operations for [${l}, ${r}]?`, Math.ceil(tot / 2), 'Each operation performs two divisions.'); ans += Math.ceil(tot / 2); }); return ans; }
  });

  D('once-twice', {
    t: 'Once Twice',
    r: 'Count each bit over all numbers mod 3: the triples cancel, so a leftover 1 marks a bit of the "once" number and a leftover 2 a bit of the "twice" number (a 0 is ambiguous; split the numbers by a bit where they differ to resolve it).',
    g: R => { const v = R.distinct(R.int(2, 4), 0, 15), arr = []; v.forEach((x, i) => { const c = i === 0 ? 1 : i === 1 ? 2 : 3; for (let j = 0; j < c; j++) arr.push(x); }); return { nums: R.shuffle(arr) }; },
    s(I, T) { const c = new Map(); I.nums.forEach(x => c.set(x, (c.get(x) || 0) + 1)); let once, twice; c.forEach((v, k) => { if (v === 1) once = k; if (v === 2) twice = k; }); for (let b = 0; b < 4; b++) { const cnt = I.nums.filter(x => x >> b & 1).length % 3; T.at({ nums: A(I.nums, { hl: I.nums.map((x, i) => x >> b & 1 ? i : -1).filter(i => i >= 0) }), bit: b }); T.n(`Numbers with bit ${b} set, mod 3?`, cnt, cnt === 1 ? 'Leftover 1: only the once-number has this bit.' : cnt === 2 ? 'Leftover 2: only the twice-number has it.' : 'Either both or neither have it.'); } return [once, twice]; }
  });

  D('number-of-integers-with-popcount-depth-equal-to-k-i', {
    t: 'Number of Integers With Popcount-Depth Equal to K I',
    r: 'After one popcount every number is at most ~50, so depth(x) = 1 + depth(popcount(x)) (depth(1) = 0). The full solution counts, with a binary digit DP, how many x ≤ n have each popcount; here you trace depths directly.',
    g: R => ({ n: R.int(4, 40), k: R.int(0, 3) }),
    s(I, T) { const dep = x => x === 1 ? 0 : 1 + dep(popc(x)); let c = 0; for (let x = 1; x <= I.n; x++) { const d = dep(x); if (d === I.k) c++; if (x >= 3 && T.room() && x % 3 === 0) { T.at({ x, binary: x.toString(2), popcount: popc(x) }); T.n(`Popcount-depth of ${x}?`, d, `${x} → ${popc(x)} → … → 1.`); } } T.at({ n: I.n, k: I.k }); T.n(`How many x in [1, ${I.n}] have depth ${I.k}?`, c, 'Count matches.'); return c; }
  });

  D('partition-array-for-maximum-xor-and-and', {
    t: 'Partition Array for Maximum XOR and AND',
    r: 'Enumerate the AND group B. For the rest with total XOR t, XOR(A) + XOR(C) = x + (t ^ x), maximized by a linear XOR basis over the bits not set in t. Here: try each B and the best split of the rest.',
    g: R => ({ nums: R.ints(R.int(2, 5), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length; let best = 0; const split = rest => { let b = 0; const m = rest.length; for (let s = 0; s < 1 << m; s++) { let x = 0, y = 0; rest.forEach((v, i) => { if (s >> i & 1) x ^= v; else y ^= v; }); b = Math.max(b, x + y); } return b; }; let asked = 0; for (let B = 0; B < 1 << n; B++) { const inB = a.filter((_, i) => B >> i & 1), rest = a.filter((_, i) => !(B >> i & 1)), and = inB.length ? inB.reduce((x, y) => x & y) : 0, v = and + split(rest); best = Math.max(best, v); if (asked < 4 && inB.length && inB.length <= 2) { asked++; T.at({ nums: A(a, { hl: range(0, n).filter(i => B >> i & 1) }), 'AND(B)': and }); T.n(`Best total with B = {${inB.join(',')}}?`, v, 'AND(B) plus the best XOR(A) + XOR(C) split of the rest.'); } } T.at({ nums: A(a) }); T.n('Maximum over all partitions?', best, 'Best over every choice of B.'); return best; }
  });

  D('maximum-k-to-sort-a-permutation', {
    t: 'Maximum K to Sort a Permutation',
    r: 'Only misplaced elements (nums[i] ≠ i) need to move, and every swap partner pair must AND to k, so k must be a sub-mask of all of them. The AND of all misplaced values is the largest k that works (0 if already sorted).',
    g: R => ({ nums: R.perm(R.int(3, 8)) }),
    s(I, T) { let k = -1; I.nums.forEach((v, i) => { const mis = v !== i; T.at({ nums: A(I.nums, { i }), runningAnd: k < 0 ? '–' : k }); T.yn(`Is nums[${i}] = ${v} misplaced?`, mis, mis ? 'It must be swapped, so k ⊆ its bits.' : 'Already at its index.'); if (mis) k = k < 0 ? v : k & v; }); return k < 0 ? 0 : k; }
  });

  D('maximum-product-of-two-integers-with-no-common-bits', {
    t: 'Maximum Product of Two Integers With No Common Bits',
    r: 'SOS DP: best[mask] = largest value whose bits fit inside mask (spread each value up through its supermasks). For each x the best partner is best[~x & FULL]; take the largest product.',
    g: R => ({ nums: R.distinct(R.int(2, 6), 1, 15) }),
    s(I, T) { const B = Math.max(...I.nums).toString(2).length, F = (1 << B) - 1, best = Array(1 << B).fill(0); I.nums.forEach(x => best[x] = Math.max(best[x], x)); for (let b = 0; b < B; b++) for (let m = 0; m <= F; m++) if (m >> b & 1) best[m] = Math.max(best[m], best[m ^ 1 << b]); let ans = 0; I.nums.forEach((x, i) => { const p = best[F & ~x]; ans = Math.max(ans, x * p); if (i < 5) { T.at({ nums: A(I.nums, { i }), [x + ' in binary']: x.toString(2).padStart(B, '0') }); T.n(`Largest value sharing no bits with ${x}? (0 if none)`, p, `Best submask of ${(F & ~x).toString(2).padStart(B, '0')}.`); } }); return ans; }
  });

  D('count-binary-palindromic-numbers', {
    t: 'Count Binary Palindromic Numbers',
    r: 'A binary palindrome with L bits is fixed by its first ⌈L/2⌉ bits, whose top bit is 1: 2^(⌈L/2⌉ − 1) of them. Add all shorter lengths, then count the palindromes of n\'s own length that are ≤ n (plus 0).',
    g: R => ({ n: R.int(0, 120) }),
    s(I, T) { const n = I.n; if (!n) return 1; const L = n.toString(2).length; for (let len = 1; len < L && len <= 4; len++) { T.at({ n, bits: n.toString(2) }); T.n(`Binary palindromes with exactly ${len} bit${len > 1 ? 's' : ''}?`, Math.pow(2, Math.ceil(len / 2) - 1), 'Free choice of the inner half, leading bit fixed to 1.'); } let c = 1; for (let x = 1; x <= n; x++) { const b = x.toString(2); if (b === b.split('').reverse().join('')) c++; } const same = range(1 << (L - 1), n + 1).filter(x => { const b = x.toString(2); return b === b.split('').reverse().join(''); }).length; T.at({ n, bits: n.toString(2) }); T.n(`Palindromes with ${L} bits that are ≤ ${n}?`, same, 'Mirror candidate halves and compare with n.'); return c; }
  });

  D('maximum-xor-of-subsequences', {
    t: 'Maximum XOR of Subsequences',
    r: 'X and Y are both XORs of subsets, so X ⊕ Y is too — any value in the XOR span. Build a linear basis (reduce each number by basis vectors, highest bit first) and greedily XOR basis vectors into the answer when they raise it.',
    g: R => ({ nums: R.ints(R.int(2, 6), 0, 15) }),
    s(I, T) { const basis = Array(31).fill(0); I.nums.forEach((x0, i) => { let x = x0; for (let b = 30; b >= 0 && x; b--) { if (!(x >> b & 1)) continue; if (!basis[b]) { basis[b] = x; x = 0; break; } x ^= basis[b]; } let y = x0; for (let b = 30; b >= 0; b--) if ((y >> b & 1) && basis[b] && basis[b] !== x0) y ^= basis[b]; if (i < 5) { T.at({ nums: A(I.nums, { i }), basis: A(basis.filter(Boolean)) }); T.n(`Basis size after inserting ${x0}?`, basis.filter(Boolean).length, 'A number reduced to 0 adds nothing new.'); } }); let ans = 0; for (let b = 30; b >= 0; b--) if ((ans ^ basis[b]) > ans) ans ^= basis[b]; T.at({ basis: A(basis.filter(Boolean)) }); T.n('Maximum value in the span?', ans, 'Greedy from the top bit: take a vector if it increases the answer.'); return ans; }
  });

  D('bitwise-or-of-even-numbers-in-an-array', {
    t: 'Bitwise OR of Even Numbers in an Array',
    r: 'Scan the array; OR every even value into an accumulator that starts at 0. Odd values are skipped.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 20) }),
    s(I, T) { let o = 0; I.nums.forEach((x, i) => { if (x % 2 === 0) o |= x; if (i < 6) { T.at({ nums: A(I.nums, { i }), [`${x} in binary`]: x.toString(2) }); T.n(`OR so far after index ${i}?`, o, x % 2 ? `${x} is odd: skip.` : `OR in ${x}.`); } }); return o; }
  });

  D('number-of-effective-subsequences', {
    t: 'Number of Effective Subsequences',
    r: 'Removing S lowers the OR exactly when S contains every holder of some bit of the total OR. Count with inclusion–exclusion over bit sets B: (−1)^(|B|+1) · 2^(n − |holders of any bit in B|).',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 7) }),
    s(I, T) { const n = I.nums.length, tot = I.nums.reduce((a, b) => a | b, 0), bits = range(0, 21).filter(b => tot >> b & 1); bits.slice(0, 4).forEach(b => { const h = I.nums.filter(x => x >> b & 1).length; T.at({ nums: A(I.nums, { hl: I.nums.map((x, i) => x >> b & 1 ? i : -1).filter(i => i >= 0) }), bit: b }); T.n(`Subsequences that remove every holder of bit ${b}?`, Math.pow(2, n - h), `${h} holder(s) must go; the other ${n - h} are free.`); }); let ans = 0; for (let m = 1; m < 1 << bits.length; m++) { const B = bits.filter((_, i) => m >> i & 1), hs = I.nums.filter(x => B.some(b => x >> b & 1)).length; ans += (B.length % 2 ? 1 : -1) * Math.pow(2, n - hs); } return ans % MOD; }
  });

  D('minimum-operations-to-make-binary-palindrome', {
    t: 'Minimum Operations to Make Binary Palindrome',
    r: 'List every binary palindrome up to a bit past the maximum (there are only a few hundred), sorted. For each value, binary search the nearest palindromes on each side and take the smaller distance.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 60) }),
    s(I, T) { const pal = range(1, 8200).filter(x => { const b = x.toString(2); return b === b.split('').reverse().join(''); }); return I.nums.map((x, i) => { let lo = 0, hi = pal.length - 1; while (lo < hi) { const m = lo + hi >> 1; if (pal[m] >= x) hi = m; else lo = m + 1; } const up = pal[lo], dn = lo && pal[lo] !== x ? pal[lo - 1] : up, d = Math.min(up - x, x - dn); if (i < 5) { T.at({ x, binary: x.toString(2), nearest: A([dn, up]) }); T.n(`Operations for ${x}?`, d, `Nearest palindromes ${dn} and ${up}.`); } return d; }); }
  });

  D('maximum-bitwise-and-after-increment-operations', {
    t: 'Maximum Bitwise AND After Increment Operations',
    r: 'Build the answer bit by bit from the top. For a candidate mask, each number\'s cost is the gap to the smallest v ≥ x containing all mask bits. Keep the bit if the m cheapest costs fit within k.',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, 1, 9), k: R.int(1, 12), m: R.int(1, n) }; },
    s(I, T) { const up = (x, mask) => { let v = x; while ((v & mask) !== mask) v++; return v - x; }; let ans = 0; for (let b = 5; b >= 0; b--) { const c = ans | 1 << b, costs = I.nums.map(x => up(x, c)).sort((p, q) => p - q), need = sum(costs.slice(0, I.m)), ok = need <= I.k; if (b <= 4) { T.at({ nums: A(I.nums), candidate: c.toString(2), k: I.k, m: I.m }); T.yn(`Can we keep bit ${b} (mask ${c.toString(2)})?`, ok, `The ${I.m} cheapest raises cost ${need}.`); } if (ok) ans = c; } return ans; }
  });

  D('find-nth-smallest-integer-with-k-one-bits', {
    t: 'Find Nth Smallest Integer With K One Bits',
    r: 'Decide bits from the top. Leaving bit b at 0 allows C(b, k) numbers using only lower bits. If n is larger than that, bit b must be 1: subtract C(b, k) from n and need one fewer 1.',
    g: R => ({ n: R.int(1, 12), k: R.int(1, 3) }),
    s(I, T) { const C = (a, b) => { if (b < 0 || b > a) return 0; let r = 1; for (let i = 0; i < b; i++) r = r * (a - i) / (i + 1); return Math.round(r); }; let n = I.n, k = I.k, ans = 0, top = 0; while (C(top + 1, k) < n) top++; let asks = 0; for (let b = top; b >= 0 && k > 0; b--) { const c = C(b, k), set = n > c; if (asks++ < 5) { T.at({ n, k, bit: b, built: ans.toString(2) }); T.yn(`Set bit ${b}?`, set, `C(${b}, ${k}) = ${c} numbers fit below it; n = ${n}.`); } if (set) { ans |= 1 << b; n -= c; k--; } } return ans; }
  });

  D('longest-strictly-increasing-subsequence-with-non-zero-bitwise-and', {
    t: 'Longest Strictly Increasing Subsequence With Non-Zero Bitwise AND',
    r: 'A non-zero AND means some bit is shared by every chosen number. For each bit, run a strict LIS (patience sorting) over the numbers that have that bit, and take the best.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 7) }),
    s(I, T) { const lis = a => { const t = []; a.forEach(x => { let lo = 0, hi = t.length; while (lo < hi) { const m = lo + hi >> 1; if (t[m] < x) lo = m + 1; else hi = m; } t[lo] = x; }); return t.length; }; let best = 0; for (let b = 0; b < 30; b++) { const f = I.nums.filter(x => x >> b & 1); if (!f.length) continue; const L = lis(f); best = Math.max(best, L); if (b < 3) { T.at({ nums: A(I.nums, { hl: I.nums.map((x, i) => x >> b & 1 ? i : -1).filter(i => i >= 0) }), bit: b }); T.n(`Longest strictly increasing subsequence among numbers with bit ${b}?`, L, 'Patience sorting on that filtered list.'); } } if (!T.asks) { T.at({ nums: A(I.nums) }); T.yn('Does any number have a set bit?', false, 'All zeros: the answer is 0.'); T.n('Answer?', 0, 'No valid subsequence.'); } return best; }
  });

  D('minimum-bitwise-or-from-grid', {
    t: 'Minimum Bitwise OR From Grid',
    r: 'Decide bits from the highest. Tentatively forbid bit b (on top of bits already forbidden); if every row still has a value using only allowed bits, keep it forbidden, otherwise bit b must be in the answer.',
    g: R => ({ grid: Array.from({ length: R.int(1, 3) }, () => R.ints(R.int(1, 3), 1, 15)) }),
    s(I, T) { let allowed = (1 << 17) - 1; for (let b = 16; b >= 0; b--) { const tryM = allowed & ~(1 << b), ok = I.grid.every(row => row.some(x => (x & ~tryM) === 0)); if (b <= 3) { T.at({ grid: G(I.grid), allowed: (allowed & 15).toString(2).padStart(4, '0') }); T.yn(`Can bit ${b} be left out of the OR?`, ok, ok ? 'Every row still has a value avoiding it.' : 'Some row has no value without it.'); } if (ok) allowed = tryM; } return allowed; }
  });
})();
