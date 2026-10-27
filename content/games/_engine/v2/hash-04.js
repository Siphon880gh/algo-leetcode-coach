/* v2 games: hash (04). Guides scored in the 3483–4041 pass. */
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

  D('delayed-count-of-equal-elements', {
    t: 'Delayed Count of Equal Elements',
    r: 'Sweep i from right to left with a count map that only holds indices j > i + k: before answering i, add nums[i + k + 1] (if it exists). Then ans[i] is the count of nums[i].',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 3), k: R.int(0, n - 1) }; },
    s(I, T) { const n = I.nums.length, c = new Map(), ans = Array(n).fill(0); for (let i = n - 1; i >= 0; i--) { const j = i + I.k + 1; if (j < n) c.set(I.nums[j], (c.get(I.nums[j]) || 0) + 1); ans[i] = c.get(I.nums[i]) || 0; if (n - i <= 6) { T.at({ nums: A(I.nums, { i, win: j < n ? [j, n - 1] : undefined }), counts: K([...c].sort((a, b) => a[0] - b[0])) }); T.n(`ans[${i}]?`, ans[i], `Copies of ${I.nums[i]} after index ${i + I.k}.`); } } return ans; }
  });

  D('number-of-prefix-connected-groups', {
    t: 'Number of Prefix-Connected Groups',
    r: 'Words of length at least k are grouped by their first k letters. Count each prefix in a hash map; every prefix with at least two words is one group.',
    g: R => ({ words: Array.from({ length: R.int(1, 6) }, () => R.str(R.int(1, 4), 'ab')), k: R.int(1, 3) }),
    s(I, T) { const c = new Map(); I.words.forEach((w, i) => { const ok = w.length >= I.k; if (ok) c.set(w.slice(0, I.k), (c.get(w.slice(0, I.k)) || 0) + 1); if (i < 6) { T.at({ words: A(I.words, { i }), prefixes: K([...c]) }); T.yn(`Can "${w}" join a group?`, ok, ok ? `Its prefix is "${w.slice(0, I.k)}".` : `Shorter than k = ${I.k}.`); } }); return [...c.values()].filter(x => x >= 2).length; }
  });

  D('toggle-light-bulbs', {
    t: 'Toggle Light Bulbs',
    r: 'Each press flips one bulb, so keep a set: add a bulb if absent, remove it if present. The bulbs left in the set, sorted, are on.',
    g: R => ({ bulbs: R.ints(R.int(1, 7), 1, 5) }),
    s(I, T) { const on = new Set(); I.bulbs.forEach((b, i) => { const was = on.has(b); if (was) on.delete(b); else on.add(b); if (i < 7) { T.at({ bulbs: A(I.bulbs, { i }), on: A([...on].sort((x, y) => x - y)) }); T.yn(`Is bulb ${b} on after press ${i}?`, !was, was ? 'It was on: switch it off.' : 'It was off: switch it on.'); } }); return [...on].sort((a, b) => a - b); }
  });

  D('first-element-with-unique-frequency', {
    t: 'First Element With Unique Frequency',
    r: 'Count each value, then count how many values share each frequency. Scan from the left and return the first value whose frequency is held by it alone.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 4) }),
    s(I, T) { const c = new Map(); I.nums.forEach(x => c.set(x, (c.get(x) || 0) + 1)); const ff = new Map(); for (const f of c.values()) ff.set(f, (ff.get(f) || 0) + 1); const seen = new Set(); for (let i = 0; i < I.nums.length; i++) { const x = I.nums[i]; if (seen.has(x)) continue; seen.add(x); const ok = ff.get(c.get(x)) === 1; T.at({ nums: A(I.nums, { i }), freq: K([...c].sort((a, b) => a[0] - b[0])), valuesPerFreq: K([...ff].sort((a, b) => a[0] - b[0])) }); T.yn(`Is the frequency of ${x} (${c.get(x)}) unique?`, ok, ok ? 'No other value appears that many times.' : 'Another value shares it.'); if (ok) return x; } return -1; }
  });

  D('smallest-pair-with-different-frequencies', {
    t: 'Smallest Pair With Different Frequencies',
    r: 'Count frequencies and sort the distinct values. Try x from smallest up; for each x, the first larger y with a different frequency gives the answer.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 5) }),
    s(I, T) { const c = new Map(); I.nums.forEach(x => c.set(x, (c.get(x) || 0) + 1)); const v = [...c.keys()].sort((a, b) => a - b); T.at({ nums: A(I.nums), freq: K(v.map(x => [x, c.get(x)])) }); T.n('How many distinct values are there?', v.length, 'Need at least two for a pair.'); for (let i = 0; i < v.length; i++) { const y = v.slice(i + 1).find(z => c.get(z) !== c.get(v[i])); T.at({ values: A(v, { i }), freq: K(v.map(x => [x, c.get(x)])) }); T.yn(`Does x = ${v[i]} have a partner?`, y !== undefined, y !== undefined ? `Smallest y is ${y}.` : 'Every larger value has the same frequency.'); if (y !== undefined) return [v[i], y]; } return [-1, -1]; }
  });

  D('first-unique-even-element', {
    t: 'First Unique Even Element',
    r: 'Count every value, then scan from the left and return the first even value whose count is exactly 1.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 8) }),
    s(I, T) { const c = new Map(); I.nums.forEach(x => c.set(x, (c.get(x) || 0) + 1)); for (let i = 0; i < I.nums.length; i++) { const x = I.nums[i], ok = x % 2 === 0 && c.get(x) === 1; T.at({ nums: A(I.nums, { i }), counts: K([...c].sort((a, b) => a[0] - b[0])) }); T.yn(`Is ${x} the answer?`, ok, x % 2 ? 'Odd.' : ok ? 'Even and appears once.' : `Even but appears ${c.get(x)} times.`); if (ok) return x; } return -1; }
  });

  D('mirror-frequency-distance', {
    t: 'Mirror Frequency Distance',
    r: 'Count every character. Pair each letter with its mirror (a and z, b and y, …) and each digit with its mirror (0 and 9, …). For each pair where at least one side appears, add |freq(c) − freq(mirror)| once.',
    g: R => ({ s: R.str(R.int(1, 8), 'abyz09m') }),
    s(I, T) { const c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const mir = ch => /[a-z]/.test(ch) ? String.fromCharCode(219 - ch.charCodeAt(0)) : String(9 - Number(ch)); const seen = new Set(); let tot = 0; Object.keys(c).sort().forEach(ch => { const m = mir(ch), key = [ch, m].sort().join(''); if (seen.has(key)) return; seen.add(key); const d = Math.abs((c[ch] || 0) - (c[m] || 0)); tot += d; T.at({ s: A(I.s.split('')), counts: K(Object.entries(c).sort()) }); T.n(`|freq("${ch}") − freq("${m}")|?`, d, `Mirror of "${ch}" is "${m}".`); }); return tot; }
  });

  D('minimize-array-sum-using-divisible-replacements', {
    t: 'Minimize Array Sum Using Divisible Replacements',
    r: 'Any element can be replaced by any value in the array that divides it, and the smallest such divisor is best. Put values in a set and, for each element, find its smallest divisor present (sieve over multiples of each present value).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 12) }),
    s(I, T) { const set = new Set(I.nums); let tot = 0; I.nums.forEach((x, i) => { let d = x; for (let v = 1; v <= x; v++) if (set.has(v) && x % v === 0) { d = v; break; } tot += d; if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.n(`Smallest value ${x} can become?`, d, 'Its smallest divisor that appears in the array.'); } }); return tot; }
  });

  D('minimum-operations-to-make-array-modulo-alternating-i', {
    t: 'Minimum Operations to Make Array Modulo Alternating I',
    r: 'For each target residue x, the cost for one element is the shorter way to reach a value ≡ x (mod k): up by d or down by k − d, staying non-negative. Total the costs over the even and odd indices for every x, then pick x not equal to y using the best and second-best options.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 12), k: R.int(2, 4) }),
    s(I, T) { const k = I.k, c = (v, x) => { const d = ((x - v) % k + k) % k; return v - (k - d) >= 0 ? Math.min(d, k - d) : d; }, E = range(0, k).map(x => sum(I.nums.filter((_, i) => i % 2 === 0).map(v => c(v, x)))), O = range(0, k).map(x => sum(I.nums.filter((_, i) => i % 2).map(v => c(v, x)))); T.at({ nums: A(I.nums), k }); T.n('Cheapest cost for the even indices alone (any x)?', Math.min(...E), 'Try every residue.'); T.n('Cheapest cost for the odd indices alone (any y)?', Math.min(...O), 'Try every residue.'); let best = Infinity; for (let x = 0; x < k; x++) for (let y = 0; y < k; y++) if (x !== y) best = Math.min(best, E[x] + O[y]); T.at({ even: A(E), odd: A(O) }); T.n('Best total with x not equal to y?', best, 'If both favour the same residue, move one of them to its second-best.'); return best; }
  });

  D('minimum-operations-to-make-array-modulo-alternating-ii', {
    t: 'Minimum Operations to Make Array Modulo Alternating II',
    r: 'k is now up to 10 to the power 5, so you cannot price every residue element by element. Sort the residues of each parity class; the cost as a function of x is piecewise linear, so sweep x over 0 to k−1 with prefix sums (handling wraparound) to get every total, then combine the best and second-best x not equal to y.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 15), k: R.int(2, 5) }),
    s(I, T) { const k = I.k, c = (v, x) => { const d = ((x - v) % k + k) % k; return v - (k - d) >= 0 ? Math.min(d, k - d) : d; }, ev = I.nums.filter((_, i) => i % 2 === 0), od = I.nums.filter((_, i) => i % 2), E = range(0, k).map(x => sum(ev.map(v => c(v, x)))), O = range(0, k).map(x => sum(od.map(v => c(v, x)))); T.at({ evenResidues: A(ev.map(v => v % k).sort((a, b) => a - b)), k }); T.n('Cost to send all even-index values to residue 0?', E[0], 'Sum the shorter way around for each.'); const bx = E.indexOf(Math.min(...E)); T.n('Which residue is cheapest for the even indices?', bx, 'Sweep every residue.'); let best = Infinity; for (let x = 0; x < k; x++) for (let y = 0; y < k; y++) if (x !== y) best = Math.min(best, E[x] + O[y]); T.at({ even: A(E), odd: A(O) }); T.n('Best total with x not equal to y?', best, 'Best pair, using a second-best if the two choices collide.'); return best; }
  });

  D('maximum-number-of-items-from-sale-i', {
    t: 'Maximum Number of Items From Sale I',
    r: 'Buying at least one copy of item i earns one free copy of each other item whose factor it divides, once. So the first copy of i is worth 1 + bonus_i and extra copies are worth 1. Run a knapsack over the budget where each item is a group: skip it, or take c at least 1 copies for value c + bonus_i.',
    g: R => ({ items: Array.from({ length: R.int(1, 4) }, () => [R.int(1, 6), R.int(1, 5)]), budget: R.int(1, 12) }),
    s(I, T) { const it = I.items, bonus = it.map((a, i) => it.filter((b, j) => j !== i && b[0] % a[0] === 0).length); T.at({ items: A(it.map(x => `f${x[0]}:$${x[1]}`)), budget: I.budget }); bonus.slice(0, 3).forEach((b, i) => T.n(`Free copies earned by buying item ${i}?`, b, 'Count other items whose factor is a multiple of its factor.')); let dp = Array(I.budget + 1).fill(0); it.forEach(([, p], i) => { const nd = dp.slice(); for (let B = 0; B <= I.budget; B++) for (let c = 1; c * p <= B; c++) nd[B] = Math.max(nd[B], dp[B - c * p] + c + bonus[i]); dp = nd; }); return dp[I.budget]; }
  });

  D('maximum-number-of-items-from-sale-ii', {
    t: 'Maximum Number of Items From Sale II',
    r: 'Now each purchased copy of i earns at most one free copy, and each pair (i, j) pays out once, so the first cnt_i copies of i are worth 2 and later ones are worth 1. Sort the worth-2 copies by price and take the cheapest; any leftover budget buys copies of the cheapest item.',
    g: R => ({ items: Array.from({ length: R.int(1, 4) }, () => [R.int(1, 4), R.int(1, 6)]), budget: R.int(1, 15) }),
    s(I, T) { const it = I.items, cnt = it.map((a, i) => it.filter((b, j) => j !== i && b[0] % a[0] === 0).length); T.at({ items: A(it.map(x => `f${x[0]}:$${x[1]}`)), budget: I.budget }); cnt.slice(0, 3).forEach((b, i) => T.n(`How many copies of item ${i} are worth 2?`, b, 'One per other item whose factor is a multiple.')); let dp = Array(I.budget + 1).fill(0); it.forEach(([, p], i) => { const nd = dp.slice(); for (let B = 0; B <= I.budget; B++) for (let c = 1; c * p <= B; c++) nd[B] = Math.max(nd[B], dp[B - c * p] + c + Math.min(c, cnt[i])); dp = nd; }); return dp[I.budget]; }
  });

  D('frequency-balance-subarray', {
    t: 'Frequency Balance Subarray',
    r: 'Fix the left end and grow the right end, keeping value counts and a count-of-counts map. The window is balanced when it has one distinct value, or exactly two frequencies f and 2f. Track the longest.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, ok = (l, r) => { const c = new Map(); for (let i = l; i <= r; i++) c.set(a[i], (c.get(a[i]) || 0) + 1); const f = [...new Set(c.values())].sort((x, y) => x - y); return c.size === 1 || (f.length === 2 && f[1] === 2 * f[0]); }; let best = 0; for (let l = 0; l < n; l++) { let b = 0; for (let r = l; r < n; r++) if (ok(l, r)) b = r - l + 1; best = Math.max(best, b); if (l < 4) { T.at({ nums: A(a, { i: l }) }); T.n(`Longest balanced subarray starting at ${l}?`, b, 'Grow right; balanced means one value, or frequencies exactly f and 2f.'); } } return best; }
  });

  D('valid-subarrays-with-matching-sum-digits-i', {
    t: 'Valid Subarrays With Matching Sum Digits I',
    r: 'n at most 1500, so try every subarray: extend the right end with a running sum and check that its first and last digits both equal x.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 120), x: R.int(1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, x = String(I.x); let c = 0; for (let l = 0; l < n; l++) { let s = 0, here = 0; for (let r = l; r < n; r++) { s += a[r]; const d = String(s); if (d[0] === x && d[d.length - 1] === x) here++; } c += here; if (l < 4) { T.at({ nums: A(a, { i: l }), x: I.x }); T.n(`Valid subarrays starting at ${l}?`, here, 'Running sum; check first and last digit.'); } } return c; }
  });

  D('valid-subarrays-with-matching-sum-digits-ii', {
    t: 'Valid Subarrays With Matching Sum Digits II',
    r: 'For a fixed right end, the valid prefix sums P[l] satisfy P[r] − P[l] ≡ x (mod 10) and P[r] − P[l] lies in a band [x times 10 to the power d, (x+1) times 10 to the power d) for some digit count d. Prefix sums only increase, so for each d binary search (or two-pointer) the band, and count matching residues mod 10 inside it with per-residue position lists.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 120), x: R.int(1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(v => P.push(P[P.length - 1] + v)); let c = 0; for (let r = 1; r <= n; r++) { let here = 0; for (let l = 0; l < r; l++) { const d = String(P[r] - P[l]); if (+d[0] === I.x && +d[d.length - 1] === I.x) here++; } c += here; if (r <= 4) { T.at({ prefix: A(P, { i: r }), x: I.x }); T.n(`Valid subarrays ending at index ${r - 1}?`, here, 'Earlier prefix sums whose difference starts and ends with x.'); } } return c; }
  });

  D('widest-possible-fence', {
    t: 'Widest Possible Fence',
    r: 'Try every candidate height H: each plank on its own, and each sum of two planks. For H, the width is the count of planks equal to H plus the most disjoint pairs summing to H, which a value-count map gives as the sum of min(c[v], c[H − v]) over v < H − v plus half of c[H divided by 2], rounded down.',
    g: R => ({ planks: R.ints(R.int(1, 7), 1, 5) }),
    s(I, T) { const c = new Map(); I.planks.forEach(x => c.set(x, (c.get(x) || 0) + 1)); const w = H => { let s = c.get(H) || 0; c.forEach((k, v) => { const u = H - v; if (v < u && c.has(u)) s += Math.min(k, c.get(u)); if (v === u) s += k >> 1; }); return s; }; const cand = new Set(I.planks); I.planks.forEach((x, i) => I.planks.forEach((y, j) => { if (i < j) cand.add(x + y); })); let best = 0, bh = 0; [...cand].sort((x, y) => x - y).forEach(H => { const v = w(H); if (v > best) { best = v; bh = H; } }); T.at({ planks: A(I.planks), counts: K([...c.entries()].sort((x, y) => x[0] - y[0])) }); const mx = Math.max(...I.planks); T.n(`Fence width at height ${mx} (the tallest plank)?`, w(mx), 'Singles of that height plus pairs summing to it.'); T.n('How many candidate heights are there?', cand.size, 'Single heights and pair sums.'); T.n('Widest fence over all heights?', w(bh), 'Best width over every candidate.'); return best; }
  });

  D('valid-k-unique-subarrays-i', {
    t: 'Valid K-Unique Subarrays I',
    r: 'All frequencies are even exactly when the prefix XOR of random 64-bit labels matches at both ends (P[r+1] = P[l]). The distinct count of a range comes from an offline Fenwick sweep that keeps only each value\'s last occurrence. Valid means both checks pass.',
    g: R => { const n = R.int(2, 6); return { nums: R.ints(n, 1, 3), k: R.int(1, 2), queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, n - 2); return [l, R.int(l + 1, n - 1)]; }) }; },
    s(I, T) { return I.queries.map(([l, r], qi) => { const sub = I.nums.slice(l, r + 1), c = new Map(); sub.forEach(x => c.set(x, (c.get(x) || 0) + 1)); const even = [...c.values()].every(v => v % 2 === 0), ok = even && c.size === I.k; if (qi < 3) { T.at({ nums: A(I.nums, { win: [l, r] }), k: I.k }); T.n(`Distinct values in [${l}, ${r}]?`, c.size, 'Count each value once.'); T.yn(`Is every frequency in [${l}, ${r}] even?`, even, 'Prefix-XOR hashes match at both ends.'); } return ok; }); }
  });
})();
