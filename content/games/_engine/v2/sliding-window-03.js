/* v2 games: sliding-window (03). Guides scored in the 3483–4041 pass. */
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

  D('count-partitions-with-max-min-difference-at-most-k', {
    t: 'Count Partitions With Max-Min Difference at Most K',
    r: 'dp[i] = ways to cut the first i elements. The last segment can start anywhere from L(i) to i−1, where L(i) is the leftmost start whose max − min at most k (two monotonic deques find it). So dp[i] = dp[L] + … + dp[i−1], a prefix-sum range.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 9), k: R.int(0, 4) }),
    s(I, T) { const a = I.nums, n = a.length, dp = [1]; for (let i = 1; i <= n; i++) { let L = i - 1, mx = a[i - 1], mn = a[i - 1]; while (L > 0 && Math.max(mx, a[L - 1]) - Math.min(mn, a[L - 1]) <= I.k) { L--; mx = Math.max(mx, a[L]); mn = Math.min(mn, a[L]); } let s = 0; for (let j = L; j < i; j++) s = (s + dp[j]) % MOD; dp.push(s); if (i <= 6) { T.at({ nums: A(a, { win: [L, i - 1] }), k: I.k, dp: A(dp.slice()) }); T.n(`Leftmost start of a valid last segment ending at index ${i - 1}?`, L, 'Grow left while max − min stays at most k.'); T.n(`dp[${i}]?`, s, `Sum of dp[${L}..${i - 1}].`); } } return dp[n]; }
  });

  D('count-prime-gap-balanced-subarrays', {
    t: 'Count Prime-Gap Balanced Subarrays',
    r: 'For each right end r, a subarray [l, r] counts when it has at least two primes and max prime − min prime at most k. Shrinking l only removes primes, so a sliding window (with monotonic deques of primes) gives the valid range of l.',
    g: R => ({ nums: Array.from({ length: R.int(3, 7) }, () => R.pick([1, 2, 3, 4, 5, 6, 7, 11, 13])), k: R.int(0, 6) }),
    s(I, T) { const a = I.nums; let tot = 0; for (let r = 0; r < a.length; r++) { let c = 0; for (let l = 0; l <= r; l++) { const p = a.slice(l, r + 1).filter(isPrime); if (p.length >= 2 && Math.max(...p) - Math.min(...p) <= I.k) c++; } tot += c; if (r < 6) { T.at({ nums: A(a, { i: r, ok: range(0, a.length).filter(i => isPrime(a[i])) }), k: I.k }); T.n(`Balanced subarrays ending at index ${r}?`, c, 'Need at least 2 primes and a prime spread at most k.'); } } return tot; }
  });

  D('minimum-removals-to-balance-array', {
    t: 'Minimum Removals to Balance Array',
    r: 'Sort, then keep a window [l, r] with a[r] at most k times a[l]. For each r move l right while the condition fails; the largest window is what you keep, so the answer is n − best window.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 12), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let l = 0, best = 0; for (let r = 0; r < a.length; r++) { while (a[r] > I.k * a[l]) l++; best = Math.max(best, r - l + 1); if (r < 6) { T.at({ sorted: A(a, { win: [l, r] }), k: I.k }); T.n(`Left end of the window for r = ${r}?`, l, `Smallest l with ${a[r]} at most ${I.k} times a[l].`); } } return a.length - best; }
  });

  D('longest-semi-repeating-subarray', {
    t: 'Longest Semi-Repeating Subarray',
    r: 'Sliding window with counts. Track how many distinct values appear at least twice in the window; when that exceeds k, move the left edge (a count dropping from 2 to 1 lowers it).',
    g: R => ({ nums: R.ints(R.int(3, 9), 1, 4), k: R.int(0, 2) }),
    s(I, T) { const c = new Map(); let l = 0, rep = 0, best = 0; I.nums.forEach((x, r) => { c.set(x, (c.get(x) || 0) + 1); if (c.get(x) === 2) rep++; while (rep > I.k) { const y = I.nums[l++]; c.set(y, c.get(y) - 1); if (c.get(y) === 1) rep--; } best = Math.max(best, r - l + 1); if (r < 7) { T.at({ nums: A(I.nums, { win: [l, r] }), repeating: rep, k: I.k }); T.n(`Window start for r = ${r}?`, l, 'Shrink until at most k values repeat.'); } }); return best; }
  });

  D('best-time-to-buy-and-sell-stock-using-strategy', {
    t: 'Best Time to Buy and Sell Stock using Strategy',
    r: 'Base profit = the sum of strategy[i] times prices[i]. Changing window [i, i+k) removes its old contribution and adds the prices of its second half. Slide the window with prefix sums and add the best non-negative gain.',
    g: R => { const n = R.int(2, 7); return { prices: R.ints(n, 1, 9), strategy: Array.from({ length: n }, () => R.pick([-1, 0, 1])), k: 2 * R.int(1, Math.floor(n / 2)) }; },
    s(I, T) { const p = I.prices, s = I.strategy, k = I.k, base = sum(p.map((x, i) => x * s[i])); T.at({ prices: A(p), strategy: A(s) }); T.n('Profit with no modification?', base, 'the sum of strategy times price.'); let best = 0; for (let i = 0; i + k <= p.length; i++) { let old = 0, nw = 0; for (let j = i; j < i + k; j++) { old += s[j] * p[j]; if (j >= i + k / 2) nw += p[j]; } const g = nw - old; best = Math.max(best, g); if (i < 4) { T.at({ prices: A(p, { win: [i, i + k - 1] }), strategy: A(s, { win: [i, i + k - 1] }) }); T.n(`Gain from modifying the window at ${i}?`, g, 'Second-half prices minus the window\'s old contribution.'); } } return base + best; }
  });

  D('sum-of-weighted-modes-in-subarrays', {
    t: 'Sum of Weighted Modes in Subarrays',
    r: 'Slide a window of size k with a count map (plus an ordered set of (count, value) to find the mode). The mode is the most frequent value, smallest on ties; its weight is value times count.',
    g: R => { const n = R.int(2, 7); return { nums: R.ints(n, 1, 4), k: R.int(1, n) }; },
    s(I, T) { let tot = 0; for (let s = 0; s + I.k <= I.nums.length; s++) { const c = new Map(); for (let i = s; i < s + I.k; i++) c.set(I.nums[i], (c.get(I.nums[i]) || 0) + 1); let mv = 0, mc = 0; for (const [v, f] of c) if (f > mc || (f === mc && v < mv)) { mv = v; mc = f; } tot += mv * mc; if (s < 5) { T.at({ nums: A(I.nums, { win: [s, s + I.k - 1] }), counts: K([...c].sort((a, b) => a[0] - b[0])) }); T.n(`Weight of the window at ${s}?`, mv * mc, `Mode ${mv} appears ${mc} times.`); } } return tot; }
  });

  D('minimum-discards-to-balance-inventory', {
    t: 'Minimum Discards to Balance Inventory',
    r: 'Greedy simulation: keep a count of kept items per type in the last w days. On day i, first forget the kept arrival from day i − w; then keep the new item unless its type already has m kept in the window.',
    g: R => ({ arrivals: R.ints(R.int(3, 9), 1, 3), w: R.int(1, 4), m: R.int(1, 2) }),
    s(I, T) { const kept = [], c = new Map(); let d = 0; I.arrivals.forEach((x, i) => { if (i - I.w >= 0 && kept[i - I.w]) { const y = I.arrivals[i - I.w]; c.set(y, c.get(y) - 1); } const keep = (c.get(x) || 0) < I.m; T.at({ arrivals: A(I.arrivals, { i, win: [Math.max(0, i - I.w + 1), i], dim: kept.map((k, j) => k ? -1 : j).filter(j => j >= 0) }), [`type ${x} kept in window`]: c.get(x) || 0, m: I.m }); T.yn(`Keep day ${i + 1}'s item (type ${x})?`, keep, keep ? 'Still under the limit m.' : 'Its type already has m kept in this window.'); kept.push(keep); if (keep) c.set(x, (c.get(x) || 0) + 1); else d++; }); return d; }
  });

  D('minimum-subarray-length-with-distinct-sum-at-least-k', {
    t: 'Minimum Subarray Length With Distinct Sum at Least K',
    r: 'Sliding window with a count map and the sum of distinct values (a value adds to the sum when its count goes 0 to 1). After adding nums[r], shrink from the left while the distinct sum stays at least k, recording the length.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 5), k: R.int(1, 12) }),
    s(I, T) { const c = new Map(); let l = 0, ds = 0, best = -1; I.nums.forEach((x, r) => { c.set(x, (c.get(x) || 0) + 1); if (c.get(x) === 1) ds += x; while (ds >= I.k) { if (best < 0 || r - l + 1 < best) best = r - l + 1; const y = I.nums[l++]; c.set(y, c.get(y) - 1); if (!c.get(y)) ds -= y; } if (r < 7) { T.at({ nums: A(I.nums, { win: [l, r] }), distinctSum: ds, k: I.k }); T.n(`Shortest good length found after index ${r}? (−1 if none)`, best, 'Shrink from the left while the distinct sum stays at least k.'); } }); return best; }
  });

  D('count-subarrays-with-cost-less-than-or-equal-to-k', {
    t: 'Count Subarrays With Cost Less Than or Equal to K',
    r: 'For a fixed right end, shrinking from the left never raises the cost, so use two pointers. Monotonic deques give the window max and min; move l right while (max − min) times length > k, then add r − l + 1.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6), k: R.int(0, 8) }),
    s(I, T) { const a = I.nums; let l = 0, tot = 0; for (let r = 0; r < a.length; r++) { const cost = (x, y) => (Math.max(...a.slice(x, y + 1)) - Math.min(...a.slice(x, y + 1))) * (y - x + 1); while (cost(l, r) > I.k) l++; tot += r - l + 1; if (r < 6) { T.at({ nums: A(a, { win: [l, r] }), k: I.k }); T.n(`Good subarrays ending at index ${r}?`, r - l + 1, `Smallest valid left end is ${l}.`); } } return tot; }
  });

  D('maximum-subarray-xor-with-bounded-range', {
    t: 'Maximum Subarray XOR With Bounded Range',
    r: 'Two pointers with max or min deques keep the longest window ending at r with max − min at most k. Any subarray ending at r inside it is allowed; with prefix XORs P, the best is max P[r+1] ⊕ P[j] over j in [l, r], found in a binary trie that supports deletions.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 7), k: R.int(0, 3) }),
    s(I, T) { const a = I.nums, P = [0]; a.forEach(x => P.push(P[P.length - 1] ^ x)); let l = 0, best = 0; for (let r = 0; r < a.length; r++) { while (Math.max(...a.slice(l, r + 1)) - Math.min(...a.slice(l, r + 1)) > I.k) l++; let b = 0; for (let j = l; j <= r; j++) b = Math.max(b, P[r + 1] ^ P[j]); best = Math.max(best, b); if (r < 5) { T.at({ nums: A(a, { win: [l, r] }), prefixXor: A(P), k: I.k }); T.n(`Best XOR of a valid subarray ending at ${r}?`, b, `Max of P[${r + 1}] ⊕ P[j] for j in [${l}, ${r}].`); } } return best; }
  });

  D('maximum-requests-without-violating-the-limit', {
    t: 'Maximum Requests Without Violating the Limit',
    r: 'Users are independent. Sort each user\'s times and keep greedily: a request is kept unless the kept requests in [time − window, time] already number k. Dropping the later one never hurts.',
    g: R => ({ requests: Array.from({ length: R.int(1, 7) }, () => [R.int(1, 2), R.int(1, 8)]), k: R.int(1, 2), window: R.int(1, 4) }),
    s(I, T) { const by = new Map(); I.requests.forEach(([u, t]) => { if (!by.has(u)) by.set(u, []); by.get(u).push(t); }); let tot = 0, asks = 0; [...by].sort((a, b) => a[0] - b[0]).forEach(([u, ts]) => { ts.sort((a, b) => a - b); const kept = []; ts.forEach(t => { const inWin = kept.filter(x => x >= t - I.window).length, keep = inWin < I.k; if (asks++ < 6) { T.at({ user: u, times: A(ts), kept: A(kept.slice()), window: I.window, k: I.k }); T.yn(`Keep user ${u}'s request at time ${t}?`, keep, `${inWin} kept requests in [${t - I.window}, ${t}].`); } if (keep) kept.push(t); }); tot += kept.length; }); return tot; }
  });

  D('count-subarrays-with-k-distinct-integers', {
    t: 'Count Subarrays With K Distinct Integers',
    r: 'For each right end, the valid left ends form a range: exactly k distinct values is a window between "at most k" and "at most k−1" boundaries, and "every value at least m times" needs the left end at or before a bound tracked from occurrence positions. Small arrays can be checked start by start.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 3), k: R.int(1, 2), m: R.int(1, 2) }),
    s(I, T) { let tot = 0; for (let i = 0; i < I.nums.length; i++) { const c = new Map(); let cnt = 0; for (let j = i; j < I.nums.length; j++) { c.set(I.nums[j], (c.get(I.nums[j]) || 0) + 1); if (c.size === I.k && [...c.values()].every(x => x >= I.m)) cnt++; } tot += cnt; if (i < 5) { T.at({ nums: A(I.nums, { i }), k: I.k, m: I.m }); T.n(`Valid subarrays starting at ${i}?`, cnt, `Exactly ${I.k} distinct values, each at least ${I.m} times.`); } } return tot; }
  });

  D('longest-subarray-with-at-most-k-distinct-prime-factors', {
    t: 'Longest Subarray With at Most K Distinct Prime Factors',
    r: 'Factor each number with a smallest-prime-factor sieve. Slide a window, keeping a count per prime; when the number of primes with a non-zero count exceeds k, shrink from the left.',
    g: R => ({ nums: R.ints(R.int(1, 7), 2, 30), k: R.int(1, 3) }),
    s(I, T) { const pf = x => { const s = []; for (let p = 2; p * p <= x; p++) if (x % p === 0) { s.push(p); while (x % p === 0) x /= p; } if (x > 1) s.push(x); return s; }, c = new Map(); let l = 0, best = 0, distinct = 0; I.nums.forEach((x, r) => { pf(x).forEach(p => { c.set(p, (c.get(p) || 0) + 1); if (c.get(p) === 1) distinct++; }); while (distinct > I.k) { pf(I.nums[l]).forEach(p => { c.set(p, c.get(p) - 1); if (!c.get(p)) distinct--; }); l++; } best = Math.max(best, r - l + 1); if (r < 6) { T.at({ nums: A(I.nums, { i: l, j: r }), primes: K([...c].filter(e => e[1]).sort((a, b) => a[0] - b[0])), k: I.k }); T.n(`Left end of the window after adding ${x}?`, l, 'Shrink until at most k distinct primes remain.'); } }); return best; }
  });
})();
