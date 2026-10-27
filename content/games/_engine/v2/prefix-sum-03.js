/* v2 games: prefix-sum (03). Guides scored in the 3483–4041 pass. */
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

  D('minimum-time-to-visit-all-houses', {
    t: 'Minimum Time to Visit All Houses',
    r: 'For each leg pick the shorter of the two directions: clockwise uses forward[i] from house i, counter-clockwise uses backward[i] from house i. Prefix sums over each array give any arc in O(1).',
    g: R => { const n = R.int(3, 6), queries = []; let c = 0; for (let i = 0; i < R.int(2, 5); i++) { let x; do x = R.int(0, n - 1); while (x === c); queries.push(x); c = x; } return { forward: R.ints(n, 1, 6), backward: R.ints(n, 1, 6), queries }; },
    s(I, T) { const n = I.forward.length; let cur = 0, tot = 0; I.queries.forEach(q => { let cw = 0, ccw = 0; for (let i = cur; i !== q; i = (i + 1) % n) cw += I.forward[i]; for (let i = cur; i !== q; i = (i - 1 + n) % n) ccw += I.backward[i]; const d = Math.min(cw, ccw); T.at({ forward: A(I.forward, { i: cur }), backward: A(I.backward, { i: cur }), leg: `${cur} → ${q}` }); T.n(`Shortest time from house ${cur} to house ${q}?`, d, `Clockwise ${cw}, counter-clockwise ${ccw}.`); tot += d; cur = q; }); return tot; }
  });

  D('equal-sum-grid-partition-i', {
    t: 'Equal Sum Grid Partition I',
    r: 'The total must be even. Sweep the row sums (then the column sums) with a running prefix; a cut works exactly when the prefix equals half the total.',
    g: R => ({ grid: R.grid(R.int(1, 4), R.int(1, 4), 1, 6).filter((r, i, g) => g.length * r.length >= 2 || true) }),
    s(I, T) { const g = I.grid, tot = sum(g.map(sum)), rs = g.map(sum), cs = g[0].map((_, j) => sum(g.map(r => r[j]))); T.at({ grid: G(g), rowSums: A(rs), colSums: A(cs) }); T.n('Total sum?', tot, 'Add every cell.'); if (tot % 2) return false; let p = 0; for (let i = 0; i + 1 < rs.length; i++) { p += rs[i]; T.at({ grid: G(g), rowSums: A(rs, { win: [0, i] }), half: tot / 2 }); T.n(`Sum above the cut after row ${i}?`, p, 'Running prefix of row sums.'); if (p === tot / 2) return true; } p = 0; for (let j = 0; j + 1 < cs.length; j++) { p += cs[j]; T.at({ grid: G(g), colSums: A(cs, { win: [0, j] }), half: tot / 2 }); T.n(`Sum left of the cut after column ${j}?`, p, 'Running prefix of column sums.'); if (p === tot / 2) return true; } return false; }
  });

  D('equal-sum-grid-partition-ii', {
    t: 'Equal Sum Grid Partition II',
    r: 'Try every horizontal and vertical cut. If the halves differ by d, the larger side may drop one cell of value d, as long as what is left stays connected. In a section at least 2 wide and 2 tall any cell works; in a single row or column only its two ends do.',
    g: R => { const m = R.int(1, 3), n = R.int(m === 1 ? 2 : 1, 3); return { grid: R.grid(m, n, 1, 5) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; const can = (cells, d) => cells.some(([r, c]) => { if (g[r][c] !== d) return false; const rest = cells.filter(x => x[0] !== r || x[1] !== c); if (!rest.length) return false; const key = x => x[0] + ',' + x[1], set = new Set(rest.map(key)), seen = new Set([key(rest[0])]), st = [rest[0]]; while (st.length) { const [a, b] = st.pop(); [[1, 0], [-1, 0], [0, 1], [0, -1]].forEach(([x, y]) => { const k = (a + x) + ',' + (b + y); if (set.has(k) && !seen.has(k)) { seen.add(k); st.push([a + x, b + y]); } }); } return seen.size === rest.length; }); const cuts = []; for (let i = 1; i < m; i++) cuts.push(['row', i]); for (let j = 1; j < n; j++) cuts.push(['col', j]); for (const [t, x] of cuts) { const A1 = [], B1 = []; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) ((t === 'row' ? r < x : c < x) ? A1 : B1).push([r, c]); const sa = sum(A1.map(([r, c]) => g[r][c])), sb = sum(B1.map(([r, c]) => g[r][c])), d = Math.abs(sa - sb), big = sa > sb ? A1 : B1; const ok = d === 0 || can(big, d); T.at({ grid: G(g, { hl: A1 }), cut: `${t} ${x}`, sums: `${sa} vs ${sb}` }); T.yn(`Does the ${t === 'row' ? 'horizontal' : 'vertical'} cut before ${t} ${x} work?`, ok, d === 0 ? 'Equal sums already.' : `Need a removable cell of value ${d} on the larger side.`); if (ok) return true; } return false; }
  });

  D('maximum-number-of-subsequences-after-one-inserting', {
    t: 'Maximum Number of Subsequences After One Inserting',
    r: 'Three candidates: an L at the front adds every "CT"; a T at the end adds every "LC"; a C at position i adds (L before i) × (T after i), best i. Add the best gain to the current "LCT" count.',
    g: R => ({ s: R.str(R.int(2, 8), 'LCTX') }),
    s(I, T) { const s = I.s; let l = 0, lc = 0, lct = 0; for (const c of s) { if (c === 'L') l++; else if (c === 'C') lc += l; else if (c === 'T') lct += lc; } let ct = 0, t = 0; for (let i = s.length - 1; i >= 0; i--) { if (s[i] === 'T') t++; else if (s[i] === 'C') ct += t; } let bestC = 0, L = 0, Tr2 = s.split('').filter(c => c === 'T').length; for (let i = 0; i <= s.length; i++) { bestC = Math.max(bestC, L * Tr2); if (i < s.length) { if (s[i] === 'L') L++; if (s[i] === 'T') Tr2--; } } T.at({ s: A(s.split('')) }); T.n('"LCT" subsequences now?', lct, 'Count L, then LC, then LCT in one pass.'); T.n('Gain from inserting L at the front (number of "CT")?', ct, 'Every CT pair gains this L.'); T.n('Gain from inserting T at the end (number of "LC")?', lc, 'Every LC pair gains this T.'); T.n('Best gain from inserting one C?', bestC, 'max over positions of (L before) × (T after).'); return lct + Math.max(ct, lc, bestC); }
  });

  D('minimum-sum-after-divisible-sum-deletions', {
    t: 'Minimum Sum After Divisible Sum Deletions',
    r: 'dp[i] = smallest remaining sum of the first i elements. Either keep nums[i−1] (dp[i−1] + nums[i−1]) or delete a block ending here: any earlier prefix j with the same prefix sum mod k, so dp[i] = min(…, best[pre mod k]).',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 6), k: R.int(2, 5) }),
    s(I, T) { const best = new Map([[0, 0]]); let pre = 0, dp = 0; I.nums.forEach((x, i) => { pre = (pre + x) % I.k; const keep = dp + x, del = best.has(pre) ? best.get(pre) : Infinity; dp = Math.min(keep, del); best.set(pre, Math.min(best.has(pre) ? best.get(pre) : Infinity, dp)); T.at({ nums: A(I.nums, { i }), 'prefix mod k': pre, bestByMod: K([...best].sort((a, b) => a[0] - b[0]).map(([m, v]) => ['mod ' + m, v])) }); T.n(`dp[${i + 1}]?`, dp, del < keep ? 'Delete back to an earlier prefix with the same remainder.' : 'Keeping the element is cheaper.'); }); return dp; }
  });

  D('xor-after-range-multiplication-queries-ii', {
    t: 'XOR After Range Multiplication Queries II',
    r: 'Square-root split: a query with a big step k touches few indices, so apply it directly. Small-k queries go into a per-k multiplicative difference array (multiply at l, multiply by v⁻¹ just past the last touched index), swept with stride k at the end.',
    g: R => { const n = R.int(3, 7); return { nums: R.ints(n, 1, 5), queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1), R.int(1, 3), R.int(2, 3)]; }) }; },
    s(I, T) { const a = I.nums.slice(); I.queries.forEach(([l, r, k, v]) => { const cnt = Math.floor((r - l) / k) + 1, last = l + (cnt - 1) * k; T.at({ nums: A(a.slice(), { win: [l, r] }), query: `l=${l} r=${r} k=${k} v=${v}` }); T.n('How many indices does this query touch?', cnt, '⌊(r − l) / k⌋ + 1.'); T.n('Last index it touches?', last, 'l + (count − 1) × k: the difference array cancels just after it.'); for (let i = l; i <= r; i += k) a[i] = a[i] * v % MOD; }); return a.reduce((p, q) => p ^ q, 0); }
  });

  D('distinct-points-reachable-after-substring-removal', {
    t: 'Distinct Points Reachable After Substring Removal',
    r: 'The final point is the full walk\'s end minus the displacement of the removed window. Take prefix positions P; each window i..i+k−1 removes P[i+k] − P[i]. Count distinct results in a set.',
    g: R => { const n = R.int(1, 7); return { s: R.str(n, 'UDLR'), k: R.int(1, n) }; },
    s(I, T) { const P = [[0, 0]], mv = { U: [0, 1], D: [0, -1], L: [-1, 0], R: [1, 0] }; for (const ch of I.s) { const [x, y] = P[P.length - 1]; P.push([x + mv[ch][0], y + mv[ch][1]]); } const n = I.s.length, E = P[n], seen = new Set(); for (let i = 0; i + I.k <= n; i++) { const pt = [E[0] - (P[i + I.k][0] - P[i][0]), E[1] - (P[i + I.k][1] - P[i][1])], key = pt.join(','), nw = !seen.has(key); seen.add(key); if (i < 5) { T.at({ s: A(I.s.split(''), { win: [i, i + I.k - 1] }), end: `(${E})`, points: A([...seen].map(p => `(${p})`)) }); T.yn(`Removing s[${i}..${i + I.k - 1}] ends at (${pt}). Is that a new point?`, nw, nw ? 'Add it to the set.' : 'Already counted.'); } } return seen.size; }
  });

  D('split-array-with-minimum-difference', {
    t: 'Split Array With Minimum Difference',
    r: 'Precompute where the strictly increasing prefix stops and where the strictly decreasing suffix starts. Every split point i where both nums[0..i] is increasing and nums[i+1..] is decreasing is valid; compare |prefix − suffix| with prefix sums.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, tot = sum(a); let best = -1, pre = 0; for (let i = 0; i < n - 1; i++) { pre += a[i]; const inc = a.slice(0, i + 1).every((v, j) => !j || v > a[j - 1]), dec = a.slice(i + 1).every((v, j, s) => !j || v < s[j - 1]), ok = inc && dec; T.at({ nums: A(a, { win: [0, i] }), left: pre, right: tot - pre }); T.yn(`Is the split after index ${i} valid?`, ok, ok ? 'Left strictly increasing and right strictly decreasing.' : !inc ? 'Left part is not strictly increasing.' : 'Right part is not strictly decreasing.'); if (ok) { const d = Math.abs(2 * pre - tot); if (best < 0 || d < best) best = d; } } return best; }
  });

  D('equal-score-substrings', {
    t: 'Equal Score Substrings',
    r: 'Compute the total score, then sweep a prefix score. A split after i works exactly when the prefix score is half the total.',
    g: R => ({ s: R.str(R.int(2, 6), 'abcde') }),
    s(I, T) { const sc = ch => ch.charCodeAt(0) - 96, tot = sum(I.s.split('').map(sc)); let p = 0, ok = false; T.at({ s: A(I.s.split('')) }); T.n('Total score?', tot, 'a = 1, b = 2, …'); for (let i = 0; i < I.s.length - 1; i++) { p += sc(I.s[i]); T.at({ s: A(I.s.split(''), { win: [0, i] }), total: tot }); T.n(`Left score for a split after index ${i}?`, p, `Right score is ${tot - p}.`); if (2 * p === tot) { ok = true; break; } } return ok; }
  });

  D('longest-balanced-subarray-i', {
    t: 'Longest Balanced Subarray I',
    r: 'n ≤ 1500: fix the start, extend the end, and track distinct evens and distinct odds with two sets. Balanced when the two counts match.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { let best = 0; for (let i = 0; i < I.nums.length; i++) { const e = new Set(), o = new Set(); let b = 0; for (let j = i; j < I.nums.length; j++) { (I.nums[j] % 2 ? o : e).add(I.nums[j]); if (e.size === o.size) b = j - i + 1; } best = Math.max(best, b); if (i < 5) { T.at({ nums: A(I.nums, { i }), best }); T.n(`Longest balanced subarray starting at ${i}? (0 if none)`, b, 'Distinct evens must equal distinct odds.'); } } return best; }
  });

  D('longest-balanced-subarray-ii', {
    t: 'Longest Balanced Subarray II',
    r: 'Sweep the right end. Give each value +1 (odd) or −1 (even) counted only at its latest occurrence; then balance of [l..r] is a suffix sum. A segment tree over l with range add (when a value moves) and "leftmost l with sum 0" finds the longest balanced subarray ending at r.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { const a = I.nums; let best = 0; for (let r = 0; r < a.length; r++) { let b = 0; for (let l = r; l >= 0; l--) { const e = new Set(), o = new Set(); for (let j = l; j <= r; j++) (a[j] % 2 ? o : e).add(a[j]); if (e.size === o.size) b = r - l + 1; } best = Math.max(best, b); if (r < 6) { T.at({ nums: A(a, { i: r }), best }); T.n(`Longest balanced subarray ending at ${r}? (0 if none)`, b, 'Leftmost l where distinct odds − distinct evens is 0.'); } } return best; }
  });

  D('stable-subarrays-with-equal-boundary-and-interior-sum', {
    t: 'Stable Subarrays With Equal Boundary and Interior Sum',
    r: 'With prefix sums P, [l..r] is stable when cap[l] = cap[r] and P[r] − P[l+1] = cap[r]. Sweep r, and before handling r add the pair (cap[r−2], P[r−1]) to a hash map; then count entries equal to (cap[r], P[r] − cap[r]).',
    g: R => ({ capacity: R.ints(R.int(3, 8), 0, 4) }),
    s(I, T) { const c = I.capacity, P = [0]; c.forEach(x => P.push(P[P.length - 1] + x)); const m = new Map(); let tot = 0; for (let r = 2; r < c.length; r++) { const k1 = c[r - 2] + ',' + P[r - 1]; m.set(k1, (m.get(k1) || 0) + 1); const add = m.get(c[r] + ',' + (P[r] - c[r])) || 0; tot += add; if (r < 8) { T.at({ capacity: A(c, { i: r }), prefix: A(P) }); T.n(`Stable subarrays ending at index ${r}?`, add, 'Left ends with the same value whose interior sum matches.'); } } return tot; }
  });

  D('count-subarrays-with-majority-element-i', {
    t: 'Count Subarrays With Majority Element I',
    r: 'n ≤ 1000: fix the start and extend, keeping a balance of +1 for target and −1 for anything else. target is the majority exactly when the balance is positive.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 3), target: R.int(1, 3) }),
    s(I, T) { let tot = 0; for (let i = 0; i < I.nums.length; i++) { let b = 0, c = 0; for (let j = i; j < I.nums.length; j++) { b += I.nums[j] === I.target ? 1 : -1; if (b > 0) c++; } tot += c; if (i < 5) { T.at({ nums: A(I.nums, { i }), target: I.target }); T.n(`Subarrays starting at ${i} where ${I.target} is the majority?`, c, 'Count ends where the +1/−1 balance is positive.'); } } return tot; }
  });

  D('count-subarrays-with-majority-element-ii', {
    t: 'Count Subarrays With Majority Element II',
    r: 'Map target to +1 and everything else to −1, and take prefix sums P. Subarray (i, j] works when P[j] > P[i]. Sweep j and count earlier prefixes below P[j] with a Fenwick tree (or, since P moves by ±1, a running count).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 3), target: R.int(1, 3) }),
    s(I, T) { const P = [0]; I.nums.forEach(x => P.push(P[P.length - 1] + (x === I.target ? 1 : -1))); let tot = 0; for (let j = 1; j < P.length; j++) { const c = P.slice(0, j).filter(p => p < P[j]).length; tot += c; if (j <= 6) { T.at({ nums: A(I.nums, { i: j - 1 }), prefix: A(P, { i: j }) }); T.n(`Good subarrays ending at index ${j - 1}?`, c, `Earlier prefixes smaller than ${P[j]}.`); } } return tot; }
  });

  D('count-stable-subarrays', {
    t: 'Count Stable Subarrays',
    r: 'Stable means non-decreasing. Let start[j] be where the non-decreasing run through j begins. Inside [l, r], index j ends max(start[j], l)…j, i.e. j − max(start[j], l) + 1 subarrays. Prefix sums of j − start[j] + 1 plus a binary search for where runs begin after l answer each query fast.',
    g: R => { const n = R.int(2, 7); return { nums: R.ints(n, 1, 5), queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1)]; }) }; },
    s(I, T) { const a = I.nums, st = []; a.forEach((x, j) => st.push(j && a[j - 1] <= x ? st[j - 1] : j)); return I.queries.map(([l, r]) => { let c = 0; for (let j = l; j <= r; j++) c += j - Math.max(st[j], l) + 1; T.at({ nums: A(a, { win: [l, r] }), runStart: A(st) }); T.n(`Stable subarrays inside [${l}, ${r}]?`, c, 'Each j contributes j − max(runStart[j], l) + 1.'); return c; }); }
  });

  D('find-maximum-balanced-xor-subarray-length', {
    t: 'Find Maximum Balanced XOR Subarray Length',
    r: 'Track the prefix XOR and the prefix (evens − odds). A subarray works when both prefix values repeat, so store the first index of each pair in a hash map and measure the distance when it shows up again.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 5) }),
    s(I, T) { const first = new Map([['0,0', -1]]); let x = 0, d = 0, best = 0; I.nums.forEach((v, i) => { x ^= v; d += v % 2 ? -1 : 1; const key = x + ',' + d; let len = 0; if (first.has(key)) len = i - first.get(key); else first.set(key, i); best = Math.max(best, len); if (i < 6) { T.at({ nums: A(I.nums, { i }), prefixXor: x, evenMinusOdd: d, firstSeen: K([...first].slice(0, 6)) }); T.n(`Longest balanced subarray ending at ${i}? (0 if none)`, len, len ? `Pair (${key}) first seen at ${first.get(key)}.` : 'Pair not seen before: record it.'); } }); return best; }
  });

  D('concatenate-non-zero-digits-and-multiply-by-sum-ii', {
    t: 'Concatenate Non-Zero Digits and Multiply by Sum II',
    r: 'Prefix arrays over s: X[i] = concatenation of non-zero digits (mod p), C[i] = how many there are, S[i] = digit sum. For [l, r]: x = X[r+1] − X[l]·10^(C[r+1] − C[l]) and sum = S[r+1] − S[l].',
    g: R => { const s = R.str(R.int(1, 7), '0012345'); return { s, queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, s.length - 1); return [l, R.int(l, s.length - 1)]; }) }; },
    s(I, T) { return I.queries.map(([l, r]) => { const sub = I.s.slice(l, r + 1), nz = sub.split('').filter(c => c !== '0'), x = nz.length ? BigInt(nz.join('')) : 0n, sm = sum(nz.map(Number)); T.at({ s: A(I.s.split(''), { win: [l, r] }) }); T.n(`Digit sum of s[${l}..${r}]?`, sm, 'S[r+1] − S[l].'); T.n(`x for s[${l}..${r}] (mod 1e9+7)?`, Number(x % BigInt(MOD)), 'Concatenate the non-zero digits.'); return Number(x * BigInt(sm) % BigInt(MOD)); }); }
  });

  D('maximum-score-of-a-split', {
    t: 'Maximum Score of a Split',
    r: 'Precompute suffix minimums from the right, then sweep i with a running prefix sum: score(i) = prefix(i) − sufMin[i+1]. Keep the best.',
    g: R => ({ nums: R.ints(R.int(2, 7), -6, 9) }),
    s(I, T) { const a = I.nums, n = a.length, sm = Array(n + 1).fill(Infinity); for (let i = n - 1; i >= 0; i--) sm[i] = Math.min(a[i], sm[i + 1]); let p = 0, best = -Infinity; for (let i = 0; i < n - 1; i++) { p += a[i]; const sc = p - sm[i + 1]; best = Math.max(best, sc); if (i < 6) { T.at({ nums: A(a, { win: [0, i] }), suffixMin: A(sm.slice(0, n)) }); T.n(`score(${i})?`, sc, `prefix ${p} − suffix min ${sm[i + 1]}.`); } } return best; }
  });

  D('number-of-centered-subarrays', {
    t: 'Number of Centered Subarrays',
    r: 'n ≤ 500: fix the start, extend the end with a running sum and a set of the values inside. The subarray is centered when the set contains the sum.',
    g: R => ({ nums: R.ints(R.int(1, 6), -3, 3) }),
    s(I, T) { let tot = 0; for (let i = 0; i < I.nums.length; i++) { const set = new Set(); let s = 0, c = 0; for (let j = i; j < I.nums.length; j++) { s += I.nums[j]; set.add(I.nums[j]); if (set.has(s)) c++; } tot += c; if (i < 5) { T.at({ nums: A(I.nums, { i }) }); T.n(`Centered subarrays starting at ${i}?`, c, 'Ends where the running sum equals some element inside.'); } } return tot; }
  });

  D('find-the-smallest-balanced-index', {
    t: 'Find the Smallest Balanced Index',
    r: 'Prefix sums give the left side. Sweep from the right with a running product (stop growing it once it exceeds the total sum, since it can never match again). Record every balanced index; the smallest one wins.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 5) }),
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); const cap = P[n] + 1; let prod = 1, ans = -1; for (let i = n - 1; i >= 0; i--) { const ok = P[i] === prod; if (ok) ans = i; if (n - 1 - i < 6) { T.at({ nums: A(a, { i }), leftSum: P[i], rightProduct: prod > P[n] ? '> total' : prod }); T.yn(`Is index ${i} balanced?`, ok, `Left sum ${P[i]} vs right product ${prod > P[n] ? 'too big' : prod}.`); } prod = Math.min(cap, prod * a[i]); } return ans; }
  });

  D('longest-balanced-substring-after-one-swap', {
    t: 'Longest Balanced Substring After One Swap',
    r: 'A substring is fine if its ones and zeros already match, or differ by exactly 2 and the outside has a character of the missing kind to swap in. Track prefix balances in a hash map (first index of each balance) and also look up balance ± 2, checking the outside counts.',
    g: R => ({ s: R.str(R.int(1, 8), '01') }),
    s(I, T) { const s = I.s, n = s.length, ones = s.split('').filter(c => c === '1').length, zeros = n - ones; let best = 0; for (let i = 0; i < n; i++) { let b = 0, o = 0; for (let j = i; j < n; j++) { if (s[j] === '1') o++; const z = j - i + 1 - o, d = o - z; if (!d || (d === 2 && zeros - z > 0) || (d === -2 && ones - o > 0)) b = j - i + 1; } best = Math.max(best, b); if (i < 5) { T.at({ s: A(s.split(''), { i }), totalOnes: ones, totalZeros: zeros }); T.n(`Longest usable balanced substring starting at ${i}?`, b, 'Balanced, or off by 2 with the missing character available outside.'); } } return best; }
  });

  D('smallest-stable-index-i', {
    t: 'Smallest Stable Index I',
    r: 'Precompute suffix minimums, then sweep from the left with a running maximum. The first index where max − suffixMin ≤ k is the answer.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 9), k: R.int(0, 5) }),
    s(I, T) { const a = I.nums, n = a.length, sm = Array(n); for (let i = n - 1; i >= 0; i--) sm[i] = Math.min(a[i], i < n - 1 ? sm[i + 1] : Infinity); let mx = -Infinity; for (let i = 0; i < n; i++) { mx = Math.max(mx, a[i]); const ok = mx - sm[i] <= I.k; T.at({ nums: A(a, { i }), suffixMin: A(sm), k: I.k }); T.yn(`Is index ${i} stable?`, ok, `${mx} − ${sm[i]} = ${mx - sm[i]}.`); if (ok) return i; } return -1; }
  });

  D('smallest-stable-index-ii', {
    t: 'Smallest Stable Index II',
    r: 'Same rule with n up to 1e5: one right-to-left pass for suffix minimums, one left-to-right pass with a running maximum, stopping at the first index whose score is ≤ k. O(n).',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 9), k: R.int(0, 5) }),
    s(I, T) { const a = I.nums, n = a.length, sm = Array(n); for (let i = n - 1; i >= 0; i--) sm[i] = Math.min(a[i], i < n - 1 ? sm[i + 1] : Infinity); T.at({ nums: A(a), suffixMin: A(sm) }); T.n('Suffix minimum at index 0?', sm[0], 'The global minimum.'); let mx = -Infinity; for (let i = 0; i < n; i++) { mx = Math.max(mx, a[i]); const sc = mx - sm[i]; if (i < 5) { T.at({ nums: A(a, { i }), runningMax: mx, suffixMin: A(sm, { i }) }); T.n(`Instability score at index ${i}?`, sc, 'Prefix max minus suffix min.'); } if (sc <= I.k) return i; } return -1; }
  });

  D('minimum-cost-to-move-between-indices', {
    t: 'Minimum Cost to Move Between Indices',
    r: 'A long jump costs the same as walking neighbour by neighbour, so walk. Each step to a neighbour costs 1 if that neighbour is the closest one, else the gap. Prefix sums of the rightward and leftward step costs answer each query in O(1).',
    g: R => { const n = R.int(2, 6); return { nums: R.distinct(n, -9, 12).sort((a, b) => a - b), queries: Array.from({ length: R.int(1, 3) }, () => [R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const a = I.nums, n = a.length, cl = i => i === 0 ? 1 : i === n - 1 ? n - 2 : (a[i] - a[i - 1] <= a[i + 1] - a[i] ? i - 1 : i + 1), rt = [0], lt = [0]; for (let i = 0; i + 1 < n; i++) { rt.push(rt[i] + (cl(i) === i + 1 ? 1 : a[i + 1] - a[i])); lt.push(lt[i] + (cl(i + 1) === i ? 1 : a[i + 1] - a[i])); } T.at({ nums: A(a), rightCost: A(rt), leftCost: A(lt) }); T.n('Prefix cost to walk right from index 0 to the last index?', rt[n - 1], 'Each step is 1 to a closest neighbour, else the gap.'); return I.queries.map(([l, r]) => { const c = l <= r ? rt[r] - rt[l] : lt[l] - lt[r]; T.at({ nums: A(a, { i: l, j: r }), rightCost: A(rt), leftCost: A(lt) }); T.n(`Cost from ${l} to ${r}?`, c, l <= r ? 'Difference of rightward prefix costs.' : 'Difference of leftward prefix costs.'); return c; }); }
  });

  D('count-subarrays-with-even-odd-ratio-i', {
    t: 'Count Subarrays With Even Odd Ratio I',
    r: 'x/y ≤ a/b ⇔ b·x − a·y ≤ 0. Score evens as +b and odds as −a; a subarray is valid when its sum is ≤ 0 (that forces y > 0). So count pairs l < r with P[l] ≥ P[r], using a Fenwick tree over compressed prefix sums or merge sort.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 9), a: R.int(1, 3), b: R.int(1, 3) }),
    s(I, T) { const v = I.nums.map(x => x % 2 ? -I.a : I.b), P = [0]; v.forEach(x => P.push(P[P.length - 1] + x)); T.at({ nums: A(I.nums), score: A(v) }); T.n('Prefix sum of the whole array?', P[P.length - 1], 'Evens +b, odds −a.'); let c = 0; for (let r = 1; r < P.length; r++) { const here = P.slice(0, r).filter(p => p >= P[r]).length; c += here; if (r <= 4) { T.at({ prefix: A(P, { i: r }) }); T.n(`Valid subarrays ending at index ${r - 1}?`, here, `Earlier prefix sums ≥ ${P[r]}.`); } } return c; }
  });

  D('count-of-unfinished-tasks-after-each-shift', {
    t: 'Count of Unfinished Tasks After Each Shift',
    r: 'Keep a pointer into the prefix sums of task times: the total work done since the last restart. Each shift adds its time; binary search how many tasks are fully done. If all finish, the leftover is discarded and the pointer resets to 0.',
    g: R => ({ tasks: R.ints(R.int(1, 4), 1, 6), shifts: R.ints(R.int(1, 4), 1, 12) }),
    s(I, T) { const P = [0]; I.tasks.forEach(x => P.push(P[P.length - 1] + x)); const tot = P[P.length - 1], n = I.tasks.length; let done = 0; return I.shifts.map((s, j) => { done += s; let res; if (done >= tot) { done = 0; res = 0; } else res = n - P.filter(p => p <= done).length + 1; if (j < 5) { T.at({ prefix: A(P), workDone: done === 0 && res === 0 ? 'reset' : done, shift: s }); T.n(`Unfinished tasks after shift ${j}?`, res, res ? 'Binary search the prefix sums for completed tasks.' : 'Everything finished: restart from task 0.'); } return res; }); }
  });

  D('count-subarrays-with-even-odd-ratio-ii', {
    t: 'Count Subarrays With Even Odd Ratio II',
    r: 'Score evens +b and odds −a; a subarray is valid exactly when its score is ≤ 0. Now n is 10^5 and a, b up to 10^9, so count pairs l < r with P[l] ≥ P[r] using coordinate-compressed prefix sums in a Fenwick tree (or merge-sort counting).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 9), a: R.int(1, 3), b: R.int(1, 3) }),
    s(I, T) { const v = I.nums.map(x => x % 2 ? -I.a : I.b), P = [0]; v.forEach(x => P.push(P[P.length - 1] + x)); const sorted = [...new Set(P)].sort((x, y) => x - y); T.at({ prefix: A(P) }); T.n('How many distinct prefix values to compress?', sorted.length, 'Each gets a Fenwick slot.'); let c = 0; for (let r = 1; r < P.length; r++) { const here = P.slice(0, r).filter(p => p >= P[r]).length; c += here; if (r <= 3) { T.at({ prefix: A(P, { i: r }), rank: sorted.indexOf(P[r]) }); T.n(`Fenwick count of earlier prefixes ≥ ${P[r]}?`, here, 'Query the suffix of ranks at or above this value.'); } } return c; }
  });
})();
