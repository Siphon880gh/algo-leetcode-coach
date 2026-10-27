/* v2 games: range-tree (03). Guides scored in the 3483–4041 pass. */
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

  D('find-x-value-of-array-ii', {
    t: 'Find X Value of Array II',
    r: 'After the update, keep nums[start..] and count the non-empty prefixes of it whose product ≡ x (mod k). A segment tree stores, per node, the product mod k and a count for each remainder of its prefixes; here you walk the prefix products yourself.',
    g: R => { const n = R.int(3, 6), k = R.int(2, 5); return { nums: R.ints(n, 1, 9), k, queries: Array.from({ length: R.int(1, 3) }, () => [R.int(0, n - 1), R.int(1, 9), R.int(0, n - 1), R.int(0, k - 1)]) }; },
    s(I, T) { const a = I.nums.slice(), k = I.k; return I.queries.map(([idx, v, st, x]) => { a[idx] = v; let p = 1, c = 0; const pre = []; for (let j = st; j < a.length; j++) { p = p * a[j] % k; pre.push(p); if (p === x) c++; } const j0 = Math.min(1, pre.length - 1); T.at({ nums: A(a.slice(), { win: [st, a.length - 1], i: idx }), k, x }); T.n(`Product of nums[${st}..${st + j0}] mod ${k}?`, pre[j0], 'Multiply step by step, reducing mod k.'); T.at({ nums: A(a.slice(), { win: [st, a.length - 1] }), prefixMod: A(pre), x }); T.n(`How many prefixes of nums[${st}..] have product ≡ ${x}?`, c, 'Count entries of prefixMod equal to x.'); return c; }); }
  });

  D('range-xor-queries-with-subarray-reversals', {
    t: 'Range XOR Queries with Subarray Reversals',
    r: 'XOR over a range ignores order, so a reversal only moves values around. An implicit treap keeps each subtree\'s XOR and a lazy "reversed" flag; here you track the array as it changes.',
    g: R => { const n = R.int(3, 6); return { nums: R.ints(n, 0, 9), queries: Array.from({ length: R.int(3, 5) }, () => { const t = R.pick([1, 2, 2, 3]); if (t === 1) return [1, R.int(0, n - 1), R.int(0, 9)]; const l = R.int(0, n - 2); return [t, l, R.int(l + 1, n - 1)]; }) }; },
    s(I, T) { const a = I.nums.slice(), out = []; I.queries.forEach(([t, x, y]) => { if (t === 1) a[x] = y; else if (t === 2) { let v = 0; for (let i = x; i <= y; i++) v ^= a[i]; T.at({ nums: A(a.slice(), { win: [x, y] }) }); T.n(`XOR of nums[${x}..${y}]?`, v, 'XOR every value in the window; order does not matter.'); out.push(v); } else { const seg = a.slice(x, y + 1).reverse(); a.splice(x, seg.length, ...seg); T.at({ nums: A(a.slice(), { win: [x, y] }) }); T.n(`After reversing [${x}..${y}], what is nums[${x}]?`, a[x], `The old nums[${y}] moves to index ${x}.`); } }); return out; }
  });

  D('maximize-count-of-distinct-primes-after-split', {
    t: 'Maximize Count of Distinct Primes After Split',
    r: 'A prime counts twice only if the split falls between its first and last occurrence. So the answer is (distinct primes) + max over k of (primes whose [first, last) range covers the split) — a segment tree with range add keeps that max under updates.',
    g: R => ({ nums: Array.from({ length: R.int(3, 6) }, () => R.pick([1, 2, 3, 4, 5, 7, 9])), queries: [] }),
    exIn: I => I,
    s(I, T) { const a = I.nums.slice(); if (!I.queries.length) I.queries = [[0, a[a.length - 1]], [a.length - 1, a[0]]]; return I.queries.map(([idx, val]) => { a[idx] = val; const n = a.length; let best = 0, bk = 1; for (let k = 1; k < n; k++) { const L = new Set(a.slice(0, k).filter(isPrime)), Rr = new Set(a.slice(k).filter(isPrime)), v = L.size + Rr.size; if (v > best) { best = v; bk = k; } } const dist = new Set(a.filter(isPrime)).size; T.at({ nums: A(a.slice(), { i: idx }) }); T.n('Distinct primes in the whole array?', dist, 'Each prime value once.'); T.at({ nums: A(a.slice(), { win: [0, bk - 1] }) }); T.n('Best prefix + suffix distinct-prime total?', best, `Split before index ${bk}: primes on both sides count twice.`); return best; }); }
  });

  D('number-of-integers-with-popcount-depth-equal-to-k-ii', {
    t: 'Number of Integers With Popcount-Depth Equal to K II',
    r: 'Depth is at most 5, so keep one Fenwick tree per depth over the positions. An update moves index i from its old depth\'s tree to the new one; a query [l, r, k] is a range count in tree k.',
    g: R => { const n = R.int(2, 6); return { nums: R.ints(n, 1, 40), queries: Array.from({ length: R.int(3, 5) }, () => { if (R.chance(0.35)) return [2, R.int(0, n - 1), R.int(1, 40)]; const l = R.int(0, n - 1); return [1, l, R.int(l, n - 1), R.int(0, 3)]; }) }; },
    s(I, T) { const dep = x => x === 1 ? 0 : 1 + dep(popc(x)), a = I.nums.slice(), out = []; T.at({ nums: A(a), depth: A(a.map(dep)) }); T.n(`Popcount-depth of nums[0] = ${a[0]}?`, dep(a[0]), 'Apply popcount until reaching 1, counting steps.'); I.queries.forEach(q => { if (q[0] === 2) { a[q[1]] = q[2]; T.at({ nums: A(a.slice(), { i: q[1] }), depth: A(a.map(dep)) }); T.n(`New depth at index ${q[1]} (value ${q[2]})?`, dep(q[2]), `${q[2]} → ${popc(q[2])} → … → 1.`); } else { const [, l, r, k] = q, c = a.slice(l, r + 1).filter(x => dep(x) === k).length; T.at({ nums: A(a.slice(), { win: [l, r] }), depth: A(a.map(dep), { win: [l, r] }) }); T.n(`How many in [${l}, ${r}] have depth ${k}?`, c, 'Range count in the depth-k tree.'); out.push(c); } }); return out; }
  });

  D('minimum-operations-to-equalize-subarrays', {
    t: 'Minimum Operations to Equalize Subarrays',
    r: 'Moves change a value by ±k, so every value in the range must share the same remainder mod k (check with a prefix count of remainder changes). Then the cost is Σ|x − median| / k; a merge-sort or persistent segment tree finds the median and the sums on each side.',
    g: R => { const n = R.int(1, 6), k = R.int(1, 3), r = R.int(0, k - 1); return { nums: Array.from({ length: n }, () => R.chance(0.8) ? r + k * R.int(0, 4) : R.int(1, 9)), k, queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1)]; }) }; },
    s(I, T) { return I.queries.map(([l, r]) => { const seg = I.nums.slice(l, r + 1), ok = seg.every(x => (x - seg[0]) % I.k === 0); T.at({ nums: A(I.nums, { win: [l, r] }), k: I.k }); T.yn(`Do all values in [${l}, ${r}] share a remainder mod ${I.k}?`, ok, ok ? 'Equalizing is possible.' : 'Some value can never meet the others: −1.'); if (!ok) return -1; const s = seg.slice().sort((a, b) => a - b), med = s[(s.length - 1) >> 1], ops = sum(s.map(x => Math.abs(x - med))) / I.k; T.n('Operations needed?', ops, `Move everyone to the median ${med}, ${I.k} per operation.`); return ops; }); }
  });

  D('minimum-inversion-count-in-subarrays-of-fixed-length', {
    t: 'Minimum Inversion Count in Subarrays of Fixed Length',
    r: 'Slide a window of size k with a Fenwick tree over compressed values. Dropping the left element removes the inversions it starts (smaller elements in the window); adding the right element adds the larger elements already inside.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 6), k: R.int(1, n) }; },
    s(I, T) { const a = I.nums, inv = (l, r) => { let c = 0; for (let i = l; i <= r; i++) for (let j = i + 1; j <= r; j++) if (a[i] > a[j]) c++; return c; }; let cur = inv(0, I.k - 1), best = cur; T.at({ nums: A(a, { win: [0, I.k - 1] }) }); T.n('Inversions in the first window?', cur, 'Count pairs i < j with nums[i] > nums[j].'); for (let s = 1; s + I.k <= a.length; s++) { const out = a[s - 1], inn = a[s + I.k - 1], w = a.slice(s, s + I.k - 1); cur = cur - w.filter(x => x < out).length + w.filter(x => x > inn).length; best = Math.min(best, cur); if (s < 5) { T.at({ nums: A(a, { win: [s, s + I.k - 1] }), best }); T.n(`Inversions in the window starting at ${s}?`, cur, `Remove ${out}'s smaller partners, add ${inn}'s larger partners.`); } } return best; }
  });

  D('minimum-deletions-to-make-alternating-substring', {
    t: 'Minimum Deletions to Make Alternating Substring',
    r: 'Each pair of equal neighbours inside [l, r] forces exactly one deletion. Store bad[i] = (s[i] = s[i+1]) in a Fenwick tree; a flip at j updates bad[j−1] and bad[j]; a query sums bad over l..r−1.',
    g: R => { const n = R.int(2, 6), q = []; for (let i = 0; i < R.int(2, 4); i++) { if (R.chance(0.4)) q.push([1, R.int(0, n - 1)]); else { const l = R.int(0, n - 1); q.push([2, l, R.int(l, n - 1)]); } } q.push([2, 0, n - 1]); return { s: R.str(n, 'AB'), queries: q }; },
    s(I, T) { const s = I.s.split(''), out = []; I.queries.forEach(q => { if (q[0] === 1) { s[q[1]] = s[q[1]] === 'A' ? 'B' : 'A'; return; } const [, l, r] = q; let c = 0; for (let i = l; i < r; i++) if (s[i] === s[i + 1]) c++; T.at({ s: A(s.slice(), { win: [l, r] }) }); T.n(`Deletions for s[${l}..${r}]?`, c, 'Count equal adjacent pairs inside the range.'); out.push(c); }); return out; }
  });

  D('good-subsequence-queries', {
    t: 'Good Subsequence Queries',
    r: 'Only multiples of p can be used. If some but not all elements are multiples and their gcd is p, the answer is yes. If all n are multiples, a proper subset with gcd p exists iff dropping one element leaves gcd p (prefix/suffix gcds; a segment tree keeps them under updates).',
    g: R => { const n = R.int(2, 4), p = R.int(2, 3); return { nums: Array.from({ length: n }, () => p * R.int(1, 4) + (R.chance(0.25) ? 1 : 0)), p, queries: Array.from({ length: R.int(1, 3) }, () => [R.int(0, n - 1), p * R.int(1, 4) + (R.chance(0.2) ? 1 : 0)]) }; },
    s(I, T) { const a = I.nums.slice(), p = I.p, n = a.length; let c = 0; I.queries.forEach(([i, v], q) => { a[i] = v; const mult = a.filter(x => x % p === 0); let ok; if (!mult.length) ok = false; else if (mult.length < n) ok = mult.reduce(gcd) === p; else ok = range(0, n).some(j => a.filter((_, t) => t !== j).reduce(gcd) === p); if (ok) c++; T.at({ nums: A(a.slice(), { i }), p }); T.yn(`After query ${q}, is there a good subsequence?`, ok, !mult.length ? `No multiple of ${p}.` : mult.length < n ? `gcd of the multiples is ${mult.reduce(gcd)}.` : 'All are multiples: try leaving one out.'); }); return c; }
  });

  D('count-smaller-elements-with-opposite-parity', {
    t: 'Count Smaller Elements With Opposite Parity',
    r: 'Sweep from the right with two Fenwick trees over compressed values, one for evens and one for odds. For index i, query the tree of the opposite parity for values smaller than nums[i], then insert nums[i] into its own tree.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, ans = Array(n).fill(0), ev = [], od = []; for (let i = n - 1; i >= 0; i--) { const other = a[i] % 2 ? ev : od; ans[i] = other.filter(x => x < a[i]).length; if (n - 1 - i < 6) { T.at({ nums: A(a, { i }), evensRight: A(ev.slice().sort((x, y) => x - y)), oddsRight: A(od.slice().sort((x, y) => x - y)) }); T.n(`answer[${i}]?`, ans[i], `Smaller ${a[i] % 2 ? 'even' : 'odd'} values to the right.`); } (a[i] % 2 ? od : ev).push(a[i]); } return ans; }
  });

  D('power-update-after-k-th-largest-insertion-ii', {
    t: 'Power Update After K-th Largest Insertion II',
    r: 'Insert each value into an order-statistics structure (a Fenwick tree over compressed values, or a segment tree) and walk it for the k-th largest x. Then p = p^x mod 1e9+7 by fast exponentiation.',
    g: R => ({ nums: R.ints(R.int(1, 3), 1, 6), p: R.int(2, 5), queries: Array.from({ length: R.int(1, 3) }, (_, i) => [R.int(1, 6), R.int(1, i + 2)]) }),
    s(I, T) { const a = I.nums.slice(); let p = BigInt(I.p); const M = BigInt(MOD), pw = (b, e) => { let r = 1n; b %= M; while (e > 0n) { if (e & 1n) r = r * b % M; b = b * b % M; e >>= 1n; } return r; }; return I.queries.map(([v, k0], i) => { a.push(v); const k = k0, s = a.slice().sort((x, y) => y - x), x = s[k - 1]; T.at({ sorted: A(s, { i: k - 1 }), k }); T.n(`The ${k}-th largest element after inserting ${v}?`, x, 'Order-statistics lookup.'); p = pw(p, BigInt(x)); return Number(p); }); }
  });

  D('power-update-after-k-th-largest-insertion-i', {
    t: 'Power Update After K-th Largest Insertion I',
    r: 'Consecutive k values differ by less than 10, so keep the elements in a sorted structure (or a two-heap split around the k-th largest) and shift the boundary a few steps per query. Then p = p^x mod 1e9+7 by fast exponentiation.',
    g: R => ({ nums: R.ints(R.int(1, 3), 1, 6), p: R.int(2, 5), queries: Array.from({ length: R.int(1, 3) }, (_, i) => [R.int(1, 6), R.int(1, i + 2)]) }),
    s(I, T) { const a = I.nums.slice(); let p = BigInt(I.p); const M = BigInt(MOD), pw = (b, e) => { let r = 1n; b %= M; while (e > 0n) { if (e & 1n) r = r * b % M; b = b * b % M; e >>= 1n; } return r; }; return I.queries.map(([v, k]) => { a.push(v); const s = a.slice().sort((x, y) => y - x), x = s[k - 1]; T.at({ sorted: A(s, { i: k - 1 }), k, p: String(p) }); T.n(`The ${k}-th largest element after inserting ${v}?`, x, 'Move the k boundary a few steps in the sorted structure.'); p = pw(p, BigInt(x)); return Number(p); }); }
  });

  D('number-of-pairs-after-increment', {
    t: 'Number of Pairs After Increment',
    r: 'nums1 has at most 5 values, so a type-2 query just sums, over each a in nums1, how many nums2 entries equal tot − a. Split nums2 into √n blocks, each with a value-count map and a lazy add; range updates rebuild partial blocks and bump the lazy on whole ones.',
    g: R => ({ nums1: R.ints(R.int(1, 3), 1, 4), nums2: R.ints(R.int(1, 5), 1, 4), queries: Array.from({ length: R.int(2, 4) }, (_, i) => i % 2 ? (() => { const x = R.int(0, 2); return [1, x, x + R.int(0, 2), R.int(1, 2)]; })() : [2, R.int(2, 8)]) }),
    s(I, T) { const b = I.nums2.slice(), out = []; I.queries.forEach(q => { if (q[0] === 1) { for (let i = q[1]; i <= Math.min(q[2], b.length - 1); i++) b[i] += q[3]; T.at({ nums2: A(b, { i: q[1], j: Math.min(q[2], b.length - 1) }) }); T.n(`Sum of nums2 after adding ${q[3]} to [${q[1]}, ${q[2]}]?`, sum(b), 'Apply the range add.'); } else { let c = 0; I.nums1.forEach(a => b.forEach(v => { if (a + v === q[1]) c++; })); T.at({ nums1: A(I.nums1), nums2: A(b), tot: q[1] }); T.n(`Pairs summing to ${q[1]}?`, c, 'For each a in nums1, count nums2 values equal to tot − a.'); out.push(c); } }); return out; }
  });

  D('peaks-in-array-ii', {
    t: 'Peaks in Array II',
    r: 'A subarray is a peak subarray if it holds some peak strictly inside. Count the complement instead: subarrays of length ≥ 3 with no inner peak. A segment tree node stores its length, the positions of its first and last peaks and the gaps between them; merging fixes up the peaks at the boundary, and point updates touch only three positions.',
    g: R => ({ nums: R.ints(R.int(3, 6), 0, 5), queries: Array.from({ length: R.int(2, 4) }, (_, i) => i % 2 ? [2, R.int(0, 2), R.int(0, 5)] : (() => { const l = R.int(0, 1); return [1, l, l + R.int(2, 3)]; })()) }),
    s(I, T) { const a = I.nums.slice(), out = []; I.queries.forEach(q => { if (q[0] === 2) { if (q[1] < a.length) a[q[1]] = q[2]; T.at({ nums: A(a, { i: q[1] }) }); T.n(`How many peaks after setting nums[${q[1]}] = ${q[2]}?`, range(1, a.length - 1).filter(k => a[k] > a[k - 1] && a[k] > a[k + 1]).length, 'Only positions next to the update can change.'); return; } const r = Math.min(q[2], a.length - 1); let c = 0; for (let i = q[1]; i <= r; i++) for (let j = i + 2; j <= r; j++) { for (let k = i + 1; k < j; k++) if (a[k] > a[k - 1] && a[k] > a[k + 1]) { c++; break; } } T.at({ nums: A(a, { win: [q[1], r] }) }); T.n(`Peak subarrays inside [${q[1]}, ${q[2]}]?`, c, 'Subarrays containing a peak strictly inside them.'); out.push(c); }); return out; }
  });
})();
