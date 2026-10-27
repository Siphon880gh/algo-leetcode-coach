/* v2 games: hash (05). Guides scored in the 4042–4095 pass. */
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

  const isPalN = x => isPal(String(x));
  const primesTo = n => { const s = Array(n + 1).fill(true), out = []; for (let i = 2; i <= n; i++) if (s[i]) { out.push(i); for (let j = i * i; j <= n; j += i) s[j] = false; } return out; };

  D('valid-k-unique-subarrays-ii', {
    t: 'Valid K-Unique Subarrays II',
    r: 'Each query needs two checks: every count in nums[l to r] is even (random codes with prefix XOR cancel exactly then), and exactly k values are distinct (indices whose previous copy is before l). The answer decides how the next query is built, so answer them in order.',
    g: R => { const n = R.int(4, 7), l0 = R.int(0, n - 2); return { nums: R.ints(n, 1, 3), k: R.int(1, 2), l0, r0: R.int(l0 + 1, n - 1), q: R.int(2, 4) }; },
    s(I, T) { const a = I.nums, n = a.length; let l = I.l0, r = I.r0; const out = []; for (let i = 0; i < I.q; i++) { const cnt = new Map(); for (let x = l; x <= r; x++) cnt.set(a[x], (cnt.get(a[x]) || 0) + 1); const d = cnt.size, even = [...cnt.values()].every(c => c % 2 === 0), ok = d === I.k && even; if (i < 4) { T.at({ nums: A(a, { l, r, win: [l, r] }), k: I.k, query: i }); T.n(`How many distinct values are in nums[${l}..${r}]?`, d, 'Count each value once: an index counts when its previous copy is before l.'); T.yn('Does every value appear an even number of times?', even, even ? 'The prefix XOR codes cancel: H[r + 1] = H[l].' : 'Some value has an odd count, so its code does not cancel.'); T.yn(`So is query ${i} valid?`, ok, ok ? `Exactly ${I.k} distinct and all even.` : d !== I.k ? `It needs exactly ${I.k} distinct values, not ${d}.` : 'Every count must be even.'); } out.push(ok); const g = ok ? l + r : r - l; let nl = (l ^ g) % n, nr = (r ^ g) % n; if (nl > nr) [nl, nr] = [nr, nl]; l = nl; r = nr; } return out; }
  });

  D('count-values-with-equally-spaced-occurrences-i', {
    t: 'Count Values with Equally Spaced Occurrences I',
    r: 'Group the indices of each value in a hash map. A value is special when it has exactly three indices i1 < i2 < i3 and i2 − i1 = i3 − i2.',
    g: R => ({ nums: R.ints(R.int(3, 9), 1, 4) }),
    s(I, T) { const pos = new Map(); I.nums.forEach((x, i) => { if (!pos.has(x)) pos.set(x, []); pos.get(x).push(i); }); let c = 0; [...pos.keys()].sort((a, b) => a - b).forEach(x => { const p = pos.get(x), ok = p.length === 3 && p[1] - p[0] === p[2] - p[1]; T.at({ nums: A(I.nums, { hl: p }), value: x, special: c }); T.n(`How many times does ${x} appear?`, p.length, 'Count the highlighted indices.'); if (p.length === 3) T.yn(`Are the copies of ${x} at ${p.join(', ')} equally spaced?`, ok, ok ? `Both gaps are ${p[1] - p[0]}.` : `The gaps ${p[1] - p[0]} and ${p[2] - p[1]} differ.`); if (ok) c++; }); T.at({ nums: A(I.nums), special: c }); T.n('How many special values?', c, 'Count the values with three equally spaced copies.'); return c; }
  });

  D('count-values-with-equally-spaced-occurrences-ii', {
    t: 'Count Values with Equally Spaced Occurrences II',
    r: 'Group the indices of each value. A value is special when it has at least three indices and every gap between consecutive indices equals the first gap.',
    g: R => ({ nums: R.ints(R.int(3, 10), 1, 3) }),
    s(I, T) { const pos = new Map(); I.nums.forEach((x, i) => { if (!pos.has(x)) pos.set(x, []); pos.get(x).push(i); }); let c = 0; [...pos.keys()].sort((a, b) => a - b).forEach(x => { const p = pos.get(x), gap = p.length > 1 ? p[1] - p[0] : 0, ok = p.length >= 3 && p.every((v, i) => !i || v - p[i - 1] === gap); T.at({ nums: A(I.nums, { hl: p }), value: x, special: c }); T.n(`How many times does ${x} appear?`, p.length, 'Count the highlighted indices.'); if (p.length >= 3) { T.n(`Gap between the first two copies of ${x}?`, gap, `${p[1]} − ${p[0]}.`); T.yn('Does every later gap match it?', ok, ok ? 'All gaps are equal.' : `Gaps are ${p.slice(1).map((v, i) => v - p[i]).join(', ')}.`); } if (ok) c++; }); T.at({ nums: A(I.nums), special: c }); T.n('How many special values?', c, 'Count the values with at least three equally spaced copies.'); return c; }
  });

  D('rearrange-array-by-removing-distinct-values', {
    t: 'Rearrange Array by Removing Distinct Values',
    r: 'Count every value. Round t takes one copy of each value whose count is at least t, in ascending order, so the answer is the rounds glued together.',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 4) }),
    s(I, T) { const cnt = new Map(); I.nums.forEach(x => cnt.set(x, (cnt.get(x) || 0) + 1)); const keys = [...cnt.keys()].sort((a, b) => a - b), mx = Math.max(...cnt.values()), ans = []; T.at({ nums: A(I.nums), counts: cnt }); T.n('How many rounds will there be?', mx, 'The most frequent value lasts the longest.'); for (let t = 1; t <= mx; t++) { const row = keys.filter(k => cnt.get(k) >= t); T.at({ counts: cnt, round: t, ans: A(ans.slice()) }); T.n(`How many values does round ${t} append?`, row.length, `The values with count at least ${t}.`); T.n(`Smallest value appended in round ${t}?`, row[0], 'Each round appends in ascending order.'); ans.push(...row); } return ans; }
  });

  D('maximum-equal-adjacent-pairs-after-at-most-one-replacement', {
    t: 'Maximum Equal Adjacent Pairs After At Most One Replacement',
    r: 'Neighbours that are already equal stay equal. Replacing x with y only fixes neighbours holding exactly x and y, so count unequal pairs under the unordered key (min, max) and add the biggest bucket.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 3) }),
    s(I, T) { const a = I.nums, cnt = new Map(); let eq = 0; for (let i = 0; i + 1 < a.length; i++) { const x = a[i], y = a[i + 1]; T.at({ nums: A(a, { i, j: i + 1 }), equal: eq, buckets: cnt }); if (x === y) { T.yn(`Is the pair (${x}, ${y}) already equal?`, true, 'Same value on both sides.'); eq++; } else { const key = `{${Math.min(x, y)},${Math.max(x, y)}}`, v = (cnt.get(key) || 0) + 1; T.n(`Count in bucket ${key} after this pair?`, v, 'Unordered key: (x, y) and (y, x) are the same fix.'); cnt.set(key, v); } } const best = cnt.size ? Math.max(...cnt.values()) : 0; T.at({ nums: A(a), equal: eq, buckets: cnt }); T.n('Maximum equal pairs after one replacement?', eq + best, `Equal pairs (${eq}) plus the biggest bucket (${best}).`); return eq + best; }
  });

  D('maximum-product-pair-with-target-sum', {
    t: 'Maximum Product Pair with Target Sum',
    r: 'For each nums[j] the partner must be target − nums[j]. A hash map of value to index finds it at once; the larger value goes first, and you keep the pair with the biggest product.',
    cmp: (o, e, I) => { if (e[0] === -1) return JSON.stringify(o) === '[-1,-1]'; const a = I.nums; if (!Array.isArray(o) || o.length !== 2) return false; const [i, j] = o; return i !== j && a[i] + a[j] === I.target && a[i] > a[j] && a[i] * a[j] === a[e[0]] * a[e[1]]; },
    g: R => ({ nums: R.ints(R.int(2, 6), -6, 6), target: R.int(-4, 6) }),
    s(I, T) { const a = I.nums, seen = new Map(); let best = null, bp = [-1, -1]; a.forEach((x, j) => { const need = I.target - x, has = seen.has(need); if (j < 6) { T.at({ nums: A(a, { j }), seen, target: I.target }); T.n(`Partner value needed for nums[${j}] = ${x}?`, need, 'target − nums[j].'); T.yn(`Is ${need} already in the map?`, has, has ? `Seen at index ${seen.get(need)}.` : 'Not seen yet.'); } if (has && need !== x) { const i = seen.get(need), pr = need * x; if (best === null || pr > best) { best = pr; bp = need > x ? [i, j] : [j, i]; } } if (!seen.has(x)) seen.set(x, j); }); T.at({ nums: A(a), best: best === null ? 'none' : best }); T.yn('Is there any valid pair?', best !== null, best !== null ? 'Two different values sum to the target.' : 'No two different values sum to the target.'); if (best !== null) T.n('Largest product among valid pairs?', best, 'Keep the best product while scanning.'); return bp; }
  });

  D('count-frequency-staircase-subarrays-i', {
    t: 'Count Frequency Staircase Subarrays I',
    r: 'Fix the left end and grow the right end with a count map plus the order of first appearance. The window counts when the k-th new value has count exactly k for every k.',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 3) }),
    s(I, T) { const a = I.nums, n = a.length; let tot = 0; for (let l = 0; l < n; l++) { const cnt = new Map(), order = []; let c = 0; for (let r = l; r < n; r++) { if (!cnt.has(a[r])) { cnt.set(a[r], 0); order.push(a[r]); } cnt.set(a[r], cnt.get(a[r]) + 1); const ok = order.every((v, k) => cnt.get(v) === k + 1); if (l === 0 && r < 3) { T.at({ nums: A(a, { l, r, win: [l, r] }), counts: new Map(cnt) }); T.yn(`Is nums[${l}..${r}] a staircase?`, ok, ok ? 'Counts follow 1, 2, 3, … in first-appearance order.' : `Counts in first-appearance order are ${order.map(v => cnt.get(v)).join(', ')}.`); } if (ok) c++; } if (l < 5) { T.at({ nums: A(a, { l }), total: tot }); T.n(`How many staircase subarrays start at index ${l}?`, c, 'Grow r and check the counts follow 1, 2, 3, … in first-appearance order.'); } tot += c; } T.at({ nums: A(a), total: tot }); T.n('Total staircase subarrays?', tot, 'Add the counts for every left end.'); return tot; }
  });
})();
