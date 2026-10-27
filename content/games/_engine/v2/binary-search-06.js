/* v2 games: binary-search (06). Guides scored in the 3483–4041 pass. */
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

  D('minimum-threshold-for-inversion-pairs-count', {
    t: 'Minimum Threshold for Inversion Pairs Count',
    r: 'More threshold never means fewer pairs, so binary search x: count pairs i < j with 0 < nums[i] − nums[j] ≤ x. Enough pairs → try smaller x; too few → go higher.',
    g: R => ({ nums: R.ints(R.int(4, 7), 1, 9), k: R.int(1, 6) }),
    s(I, T) { const a = I.nums, cnt = x => { let c = 0; for (let i = 0; i < a.length; i++) for (let j = i + 1; j < a.length; j++) if (a[i] > a[j] && a[i] - a[j] <= x) c++; return c; }; let lo = 1, hi = Math.max(...a) - Math.min(...a); if (cnt(hi) < I.k) { T.at({ nums: A(a), k: I.k }); T.n('Inversion pairs with no threshold limit?', cnt(hi), 'Every pair with nums[i] > nums[j].'); return -1; } while (lo < hi) { const m = (lo + hi) >> 1, c = cnt(m); T.at({ nums: A(a), k: I.k, lo, hi, mid: m }); T.n(`Pairs with difference ≤ ${m}?`, c, 'Count i < j with 0 < nums[i] − nums[j] ≤ mid.'); T.c('Next range?', ['go left (hi = mid)', 'go right (lo = mid + 1)'], c >= I.k ? 'go left (hi = mid)' : 'go right (lo = mid + 1)', c >= I.k ? 'mid already gives k pairs, so the answer is ≤ mid.' : 'Too few pairs: the threshold must grow.'); if (c >= I.k) hi = m; else lo = m + 1; } return lo; }
  });

  D('minimum-stability-factor-of-array', {
    t: 'Minimum Stability Factor of Array',
    r: 'Binary search the answer L. To keep every stable run ≤ L, scan left to right: when the last L + 1 elements (since the last change) share a gcd ≥ 2, change the current element and restart after it. L works if the changes fit in maxC.',
    g: R => ({ nums: Array.from({ length: R.int(2, 7) }, () => R.pick([1, 2, 3, 4, 5, 6, 8, 9, 10])), maxC: R.int(0, 2) }),
    s(I, T) { const a = I.nums; const need = L => { let c = 0, s = 0; for (let i = 0; i < a.length; i++) { if (i - L < s) continue; let g = 0; for (let j = i - L; j <= i; j++) g = gcd(g, a[j]); if (g >= 2) { c++; s = i + 1; } } return c; }; let lo = 0, hi = a.length; while (lo < hi) { const m = (lo + hi) >> 1, c = need(m); T.at({ nums: A(a), maxC: I.maxC, lo, hi, mid: m }); T.n(`Changes needed so no stable subarray is longer than ${m}?`, c, 'Greedy: change the right end of each window of length mid + 1 with gcd ≥ 2.'); if (c <= I.maxC) hi = m; else lo = m + 1; } return lo; }
  });

  D('network-recovery-pathways', {
    t: 'Network Recovery Pathways',
    r: 'Binary search the score s: keep only edges with cost ≥ s and online endpoints, then find the cheapest 0 → n−1 path in the DAG. s works if that cost ≤ k; the largest working s is the answer.',
    g: R => { const n = R.int(3, 5), edges = []; for (let u = 0; u < n; u++) for (let v = u + 1; v < n; v++) if (R.chance(0.5) || v === u + 1) edges.push([u, v, R.int(1, 8)]); return { edges, online: range(0, n).map(i => i === 0 || i === n - 1 || R.chance(0.75)), k: R.int(4, 16) }; },
    s(I, T) { const n = I.online.length; const cheap = s => { const d = Array(n).fill(Infinity); d[0] = 0; const E = I.edges.filter(e => e[2] >= s && I.online[e[0]] && I.online[e[1]]).sort((a, b) => a[0] - b[0]); for (let u = 0; u < n; u++) if (d[u] < Infinity) for (const [a, b, c] of E) if (a === u) d[b] = Math.min(d[b], d[u] + c); return d[n - 1]; }; const cand = [...new Set(I.edges.map(e => e[2]))].sort((a, b) => a - b); let lo = 0, hi = cand.length - 1, ans = -1; while (lo <= hi) { const m = (lo + hi) >> 1, s = cand[m], c = cheap(s); T.v(GR(n, I.edges.filter(e => e[2] >= s).map(e => [e[0], e[1]]), { dir: true, cls: Object.fromEntries(I.online.map((o, i) => [i, o ? '' : 'dim'])) }), K([['min edge cost', s], ['k', I.k]])); T.n(`Cheapest valid path using only edges with cost ≥ ${s}? (−1 if none)`, c === Infinity ? -1 : c, 'Relax in topological order; offline nodes are removed.'); if (c <= I.k) { ans = s; lo = m + 1; } else hi = m - 1; } return ans; }
  });

  D('minimum-time-to-activate-string', {
    t: 'Minimum Time to Activate String',
    r: 'More stars only add valid substrings, so binary search the time t. At t, valid = all n(n+1)/2 substrings minus those inside star-free gaps (a gap of length L has L(L+1)/2).',
    g: R => { const n = R.int(2, 6); return { s: R.str(n, 'abc'), order: R.perm(n), k: R.int(1, n * (n + 1) / 2 + 1) }; },
    s(I, T) { const n = I.s.length, tot = n * (n + 1) / 2; const val = t => { const st = new Set(I.order.slice(0, t + 1)); let v = tot, g = 0; for (let i = 0; i <= n; i++) { if (i < n && !st.has(i)) g++; else { v -= g * (g + 1) / 2; g = 0; } } return v; }; if (tot < I.k) { T.at({ n, k: I.k }); T.n('Valid substrings when every character is a star?', tot, 'n(n + 1) / 2.'); return -1; } let lo = 0, hi = n - 1; while (lo < hi) { const m = (lo + hi) >> 1, v = val(m); const marked = I.s.split('').map((c, i) => I.order.slice(0, m + 1).includes(i) ? '*' : c); T.at({ s: A(marked), k: I.k, lo, hi, mid: m }); T.n(`Valid substrings at time ${m}?`, v, 'Total minus substrings inside star-free gaps.'); if (v >= I.k) hi = m; else lo = m + 1; } return lo; }
  });

  D('minimum-time-to-complete-all-deliveries', {
    t: 'Minimum Time to Complete All Deliveries',
    r: 'Binary search the total time T. Drone i has T − ⌊T/r_i⌋ usable hours; hours that are multiples of both r values are useless for everyone. T works if each drone has enough of its own hours and together they have T − ⌊T/lcm⌋ ≥ d1 + d2.',
    g: R => ({ d: [R.int(1, 6), R.int(1, 6)], r: [R.int(2, 4), R.int(2, 4)] }),
    s(I, T) { const [d1, d2] = I.d, [r1, r2] = I.r, L = r1 / gcd(r1, r2) * r2, ok = t => t - Math.floor(t / r1) >= d1 && t - Math.floor(t / r2) >= d2 && t - Math.floor(t / L) >= d1 + d2; let lo = 1, hi = 4 * (d1 + d2) + 4; while (lo < hi) { const m = lo + hi >> 1; T.at({ d: A(I.d), r: A(I.r), range: `[${lo}, ${hi}]`, mid: m }); T.yn(`Can everything be done within ${m} hours?`, ok(m), `Drone 1 has ${m - Math.floor(m / r1)} h, drone 2 has ${m - Math.floor(m / r2)} h, together ${m - Math.floor(m / L)} h.`); if (ok(m)) hi = m; else lo = m + 1; } return lo; }
  });

  D('total-score-of-dungeon-runs', {
    t: 'Total Score of Dungeon Runs',
    r: 'With prefix damage D, starting at j earns room i (i ≥ j) when hp − (D[i] − D[j−1]) ≥ req[i], i.e. D[j−1] ≥ D[i] − hp + req[i]. D is increasing, so binary search the first such j and count i − j + 1 starts for room i.',
    g: R => { const n = R.int(1, 6); return { hp: R.int(1, 15), damage: R.ints(n, 1, 5), requirement: R.ints(n, 1, 6) }; },
    s(I, T) { const n = I.damage.length, D = [0]; I.damage.forEach(d => D.push(D[D.length - 1] + d)); let tot = 0; for (let i = 1; i <= n; i++) { const need = D[i] - I.hp + I.requirement[i - 1]; let c = 0; for (let j = 1; j <= i; j++) if (D[j - 1] >= need) c++; tot += c; if (i <= 6) { T.at({ damage: A(I.damage, { i: i - 1 }), prefix: A(D), need: `D[j−1] ≥ ${need}` }); T.n(`How many starting rooms earn a point in room ${i}?`, c, 'Starts late enough that the damage taken leaves ≥ requirement.'); } } return tot; }
  });

  D('maximum-capacity-within-budget', {
    t: 'Maximum Capacity Within Budget',
    r: 'Sort machines by cost and build a prefix maximum of capacity. For each machine i, binary search the cheaper machines (before i) whose cost keeps the total strictly below budget and add the best prefix capacity there. A single machine alone is also allowed.',
    g: R => { const n = R.int(1, 6); return { costs: R.ints(n, 1, 8), capacity: R.ints(n, 1, 9), budget: R.int(2, 12) }; },
    s(I, T) { const ix = range(0, I.costs.length).sort((a, b) => I.costs[a] - I.costs[b]), c = ix.map(i => I.costs[i]), cap = ix.map(i => I.capacity[i]), pm = []; cap.forEach((x, i) => pm.push(Math.max(x, i ? pm[i - 1] : 0))); let best = 0; c.forEach((ci, i) => { if (ci >= I.budget) return; let lo = 0, hi = i; while (lo < hi) { const m = lo + hi >> 1; if (c[m] < I.budget - ci) lo = m + 1; else hi = m; } const v = cap[i] + (lo ? pm[lo - 1] : 0); best = Math.max(best, v); if (i < 5) { T.at({ costs: A(c, { i, win: lo ? [0, lo - 1] : undefined }), capacity: A(cap), prefixMax: A(pm) }); T.n(`Best total capacity using machine with cost ${ci} as the pricier one?`, v, lo ? `Add the best of the ${lo} cheaper machine(s) that fit.` : 'No partner fits: it goes alone.'); } }); return best; }
  });

  D('minimum-k-to-reduce-array-within-limit', {
    t: 'Minimum K to Reduce Array Within Limit',
    r: 'nonPositive(k) = Σ ⌈x / k⌉ shrinks as k grows while k² grows, so the condition is monotone. Binary search the smallest k with Σ ⌈x / k⌉ ≤ k².',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 40) }),
    s(I, T) { const ok = k => sum(I.nums.map(x => Math.ceil(x / k))) <= k * k; let lo = 1, hi = Math.max(...I.nums); while (lo < hi) { const m = lo + hi >> 1; T.at({ nums: A(I.nums), range: `[${lo}, ${hi}]`, k: m }); T.yn(`Does k = ${m} work?`, ok(m), `Operations Σ⌈x/${m}⌉ = ${sum(I.nums.map(x => Math.ceil(x / m)))}, limit ${m * m}.`); if (ok(m)) hi = m; else lo = m + 1; } if (T.asks < 2) { T.at({ nums: A(I.nums), k: lo }); T.n(`Operations needed with k = ${lo}?`, sum(I.nums.map(x => Math.ceil(x / lo))), 'Σ ⌈x / k⌉.'); T.yn(`Is that within ${lo}²?`, true, 'The smallest k that works.'); } return lo; }
  });

  D('k-th-smallest-remaining-even-integer-in-subarray-queries', {
    t: 'K-th Smallest Remaining Even Integer in Subarray Queries',
    r: 'Binary search the answer 2t: the evens ≤ 2t are t, minus the even values of nums[l..r] that are ≤ 2t (a prefix count of evens plus binary search, since nums is increasing). Find the smallest t whose remaining count is ≥ k.',
    g: R => { const n = R.int(1, 5), nums = R.distinct(n, 1, 14).sort((a, b) => a - b); return { nums, queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1), R.int(1, 4)]; }) }; },
    s(I, T) { return I.queries.map(([l, r, k]) => { const ev = I.nums.slice(l, r + 1).filter(x => x % 2 === 0), left = t => t - ev.filter(x => x <= 2 * t).length; let lo = 1, hi = k + ev.length; while (lo < hi) { const m = lo + hi >> 1; if (left(m) >= k) hi = m; else lo = m + 1; } T.at({ nums: A(I.nums, { win: [l, r] }), k }); T.n(`Even numbers removed by nums[${l}..${r}]?`, ev.length, 'Only even values matter.'); T.n(`The ${k}-th remaining even integer?`, 2 * lo, 'Smallest 2t with at least k evens left up to it.'); return 2 * lo; }); }
  });

  D('maximize-fixed-points-after-deletions', {
    t: 'Maximize Fixed Points After Deletions',
    r: 'nums[i] can become a fixed point only if nums[i] ≤ i, after deleting d = i − nums[i] earlier elements. Two kept fixed points need increasing values and non-decreasing d. Sort candidates by (d, value) and find the longest strictly increasing run of values with patience sorting.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 4) }),
    s(I, T) { const c = I.nums.map((v, i) => [i - v, v]).filter(([d]) => d >= 0).sort((x, y) => x[0] - y[0] || x[1] - y[1]); T.at({ nums: A(I.nums) }); T.n('How many elements could ever be fixed points (value ≤ index)?', c.length, 'Deleting only moves elements left.'); const tl = []; c.forEach(([d, v], t) => { let lo = 0, hi = tl.length; while (lo < hi) { const m = lo + hi >> 1; if (tl[m] < v) lo = m + 1; else hi = m; } tl[lo] = v; if (t < 4) { T.at({ candidates: A(c.map(p => `d${p[0]}:v${p[1]}`), { i: t }), tails: A(tl.slice()) }); T.n('Longest chain so far?', tl.length, 'Patience sorting on values, strictly increasing.'); } }); return tl.length; }
  });

  D('smallest-unique-subarray', {
    t: 'Smallest Unique Subarray',
    r: 'If some length-L subarray occurs only once, extending it gives a unique length-(L+1) subarray, so the property is monotone in L. Binary search L; for each candidate, count rolling hashes of every length-L window and check whether any count is 1.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, ok = L => { const c = new Map(); for (let i = 0; i + L <= n; i++) { const k = a.slice(i, i + L).join(','); c.set(k, (c.get(k) || 0) + 1); } return [...c.values()].some(v => v === 1); }; let lo = 1, hi = n; while (lo < hi) { const m = lo + hi >> 1, r = ok(m); T.at({ nums: A(a), length: m, range: `[${lo}, ${hi}]` }); T.yn(`Is there a subarray of length ${m} that appears exactly once?`, r, 'Count every window of that length.'); if (r) hi = m; else lo = m + 1; } T.at({ nums: A(a), length: lo }); T.n('Smallest such length?', lo, 'Where the binary search lands; the whole array is always unique.'); return lo; }
  });
})();
