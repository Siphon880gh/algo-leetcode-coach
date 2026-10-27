/* v2 games: tree (06). Guides scored in the 3483–4041 pass. */
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

  D('longest-special-path-ii', {
    t: 'Longest Special Path II',
    r: 'Walk down from each node keeping a count of the values on the path. Extend to a child only if its value is new, or it is the first value allowed to repeat. Track the longest length, breaking ties by fewer nodes.',
    g: R => { const n = R.int(3, 7), edges = []; for (let i = 1; i < n; i++) edges.push([R.int(0, i - 1), i, R.int(1, 5)]); return { edges, nums: R.ints(n, 0, 3) }; },
    s(I, T) { const n = I.nums.length, adj = Array.from({ length: n }, () => []); I.edges.forEach(([u, v, w]) => { adj[u].push([v, w]); adj[v].push([u, w]); }); const ch = Array.from({ length: n }, () => []), seen = [true], q = [0]; while (q.length) { const u = q.shift(); for (const [v, w] of adj[u]) if (!seen[v]) { seen[v] = true; ch[u].push([v, w]); q.push(v); } } let best = 0, bn = 1; const tag = {}; I.nums.forEach((v, i) => tag[i] = 'v=' + v); const g = GR(n, I.edges, { tag }); for (let s = 0; s < n; s++) { let lb = 0; const cnt = new Map([[I.nums[s], 1]]); const dfs = (u, len, nodes, dup) => { if (len > lb) lb = len; if (len > best || (len === best && nodes < bn)) { best = len; bn = nodes; } for (const [v, w] of ch[u]) { const c = cnt.get(I.nums[v]) || 0; if (c >= 2 || (c === 1 && dup)) continue; cnt.set(I.nums[v], c + 1); dfs(v, len + w, nodes + 1, dup || c === 1); cnt.set(I.nums[v], c); } }; dfs(s, 0, 1, false); if (s < 6) { T.v(Object.assign({}, g, { cls: { [s]: 'hit' } })); T.n(`Longest special path going down from node ${s}?`, lb, 'Stop before a second repeated value or a value appearing a third time.'); } } T.v(g); T.n('Fewest nodes among the longest special paths?', bn, `Longest length is ${best}; count nodes on the shortest such path.`); return [best, bn]; }
  });

  D('shortest-path-in-a-weighted-tree', {
    t: 'Shortest Path in a Weighted Tree',
    r: 'In a tree the only path from the root to x is the tree path, so dist(x) is a sum of edge weights. Changing an edge (u, v) shifts the distance of every node in the child\'s subtree by w\' − w (Euler tour + Fenwick tree in the full solution).',
    g: R => { const n = R.int(3, 6), edges = []; for (let i = 2; i <= n; i++) edges.push([R.int(1, i - 1), i, R.int(1, 9)]); const queries = []; for (let i = 0; i < R.int(3, 6); i++) { if (R.chance(0.4)) { const e = R.pick(edges); queries.push([1, e[0], e[1], R.int(1, 9)]); } else queries.push([2, R.int(1, n)]); } queries.push([2, R.int(2, n)]); return { n, edges, queries }; },
    s(I, T) { const w = new Map(), key = (a, b) => Math.min(a, b) + '-' + Math.max(a, b); I.edges.forEach(([u, v, x]) => w.set(key(u, v), x)); const adj = Array.from({ length: I.n + 1 }, () => []); I.edges.forEach(([u, v]) => { adj[u].push(v); adj[v].push(u); }); const par = Array(I.n + 1).fill(0), order = [1], seen = new Set([1]); for (let i = 0; i < order.length; i++) for (const v of adj[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; order.push(v); } const dist = x => { let d = 0; while (x !== 1) { d += w.get(key(x, par[x])); x = par[x]; } return d; }; const sub = c => { const out = [c]; for (let i = 0; i < out.length; i++) for (const v of adj[out[i]]) if (par[v] === out[i]) out.push(v); return out.length; }; const ids = range(1, I.n + 1), out = []; const view = () => { const ecls = {}; return GR(ids, I.edges.map(e => [e[0], e[1]]), { tag: Object.fromEntries(I.edges.map(([u, v]) => { const c = par[u] === v ? u : v; return [c, 'w↑' + w.get(key(u, v))]; })) }); }; I.queries.forEach(q => { if (q[0] === 1) { const [, u, v, nw] = q, c = par[u] === v ? u : v, old = w.get(key(u, v)); T.v(view(), K([['update', `(${u},${v}) → ${nw}`]])); T.n(`Edge (${u},${v}) goes from ${old} to ${nw}. How many nodes have their distance shifted?`, sub(c), `Every node in the subtree under ${c} shifts by ${nw - old}.`); w.set(key(u, v), nw); } else { const d = dist(q[1]); T.v(view(), K([['query', 'dist(' + q[1] + ')']])); T.n(`Distance from 1 to ${q[1]}?`, d, 'Sum the current weights on the tree path up to the root.'); out.push(d); } }); return out; }
  });

  D('subtree-inversion-sum', {
    t: 'Subtree Inversion Sum',
    r: 'Tree DP with state (node, edges since the last inverted ancestor capped at k, current sign). A node may be inverted only when that distance is ≥ k; inverting flips the sign for its whole subtree and resets the distance.',
    g: R => { const n = R.int(3, 7), edges = []; for (let i = 1; i < n; i++) edges.push([R.int(0, i - 1), i]); return { edges, nums: R.ints(n, -8, 8), k: R.int(1, 3) }; },
    s(I, T) { const n = I.nums.length, adj = Array.from({ length: n }, () => []); I.edges.forEach(([u, v]) => { adj[u].push(v); adj[v].push(u); }); const ch = Array.from({ length: n }, () => []), seen = [true], q = [0]; while (q.length) { const u = q.shift(); for (const v of adj[u]) if (!seen[v]) { seen[v] = true; ch[u].push(v); q.push(v); } } const memo = new Map(); const f = (u, d, s) => { const key = u + ',' + d + ',' + s; if (memo.has(key)) return memo.get(key); let a = s * I.nums[u]; ch[u].forEach(c => a += f(c, Math.min(d + 1, I.k), s)); if (d >= I.k) { let b = -s * I.nums[u]; ch[u].forEach(c => b += f(c, 1, -s)); a = Math.max(a, b); } memo.set(key, a); return a; }; const order = []; const post = u => { ch[u].forEach(post); order.push(u); }; post(0); const tag = {}; I.nums.forEach((v, i) => tag[i] = String(v)); order.slice(0, 5).forEach(u => { T.v(GR(n, I.edges, { tag, cls: { [u]: 'hit' } }), K([['k', I.k]])); T.n(`Best sum of node ${u}'s subtree if no ancestor is inverted?`, f(u, I.k, 1), ch[u].length ? 'Max of: keep u (children free as their distance allows) or invert u (children restart at distance 1, sign flipped).' : 'A leaf: max(value, −value).'); }); return f(0, I.k, 1); }
  });

  D('minimum-weighted-subgraph-with-the-required-paths-ii', {
    t: 'Minimum Weighted Subgraph With the Required Paths II',
    r: 'In a tree, the smallest subtree joining three nodes has weight (d(a,b) + d(b,c) + d(a,c)) / 2: every edge of it is counted exactly twice by the three pairwise paths. Pairwise distances come from LCA and root depths.',
    g: R => { const n = R.int(3, 7), edges = []; for (let i = 1; i < n; i++) edges.push([R.int(0, i - 1), i, R.int(1, 9)]); return { edges, queries: Array.from({ length: R.int(1, 2) }, () => R.distinct(3, 0, n - 1)) }; },
    s(I, T) { const n = I.edges.length + 1, adj = Array.from({ length: n }, () => []); I.edges.forEach(([u, v, w]) => { adj[u].push([v, w]); adj[v].push([u, w]); }); const dist = (a, b) => { const d = Array(n).fill(-1); d[a] = 0; const q = [a]; while (q.length) { const u = q.shift(); for (const [v, w] of adj[u]) if (d[v] < 0) { d[v] = d[u] + w; q.push(v); } } return d[b]; }; const g = GR(n, I.edges.map(e => [e[0], e[1]]), { tag: Object.fromEntries(I.edges.map(e => [e[1], 'w' + e[2]])) }); return I.queries.map(([a, b, c]) => { const x = dist(a, b), y = dist(b, c), z = dist(a, c); T.v(Object.assign({}, g, { cls: { [a]: 'hit', [b]: 'hit', [c]: 'ok' } }), K([['d(' + a + ',' + b + ')', x], ['d(' + b + ',' + c + ')', y]])); T.n(`d(${a}, ${c})?`, z, 'Sum of edge weights on the tree path (w labels sit on the child end of each edge).'); T.n(`Weight of the smallest subtree joining ${a}, ${b}, ${c}?`, (x + y + z) / 2, 'Half the sum of the three pairwise distances.'); return (x + y + z) / 2; }); }
  });

  D('number-of-ways-to-assign-edge-weights-i', {
    t: 'Number of Ways to Assign Edge Weights I',
    r: 'Only the path from node 1 to a deepest node matters. With L edges, flipping the last edge between 1 and 2 changes the parity, so exactly half of the 2^L assignments are odd: 2^(L−1).',
    g: R => { const n = R.int(2, 8), edges = []; for (let i = 2; i <= n; i++) edges.push([R.int(1, i - 1), i]); return { edges }; },
    s(I, T) { const n = I.edges.length + 1, { order, par } = kids(n, I.edges, 1, 1), d = Array(n + 1).fill(0); order.slice(1).forEach(v => d[v] = d[par[v]] + 1); const D2 = Math.max(...d); T.v(GR(range(1, n + 1), I.edges, { tag: Object.fromEntries(order.map(v => [v, 'd' + d[v]])) })); T.n('Edges on the path from 1 to a deepest node?', D2, 'Maximum depth (BFS from node 1).'); T.n('Ways to make that path\'s cost odd?', Math.pow(2, D2 - 1) % MOD, 'Half of 2^L assignments.'); let r = 1; for (let i = 1; i < D2; i++) r = r * 2 % MOD; return r; }
  });

  D('number-of-ways-to-assign-edge-weights-ii', {
    t: 'Number of Ways to Assign Edge Weights II',
    r: 'For a query (u, v), find the path length L = depth[u] + depth[v] − 2·depth[lca]. If L = 0 there is no odd way; otherwise exactly 2^(L−1) assignments are odd.',
    g: R => { const n = R.int(2, 7), edges = []; for (let i = 2; i <= n; i++) edges.push([R.int(1, i - 1), i]); return { edges, queries: Array.from({ length: R.int(2, 3) }, () => [R.int(1, n), R.int(1, n)]) }; },
    s(I, T) { const n = I.edges.length + 1, { order, par } = kids(n, I.edges, 1, 1), d = Array(n + 1).fill(0); order.slice(1).forEach(v => d[v] = d[par[v]] + 1); const lca = (a, b) => { while (d[a] > d[b]) a = par[a]; while (d[b] > d[a]) b = par[b]; while (a !== b) { a = par[a]; b = par[b]; } return a; }; return I.queries.map(([u, v]) => { const L = d[u] + d[v] - 2 * d[lca(u, v)]; T.v(GR(range(1, n + 1), I.edges, { cls: { [u]: 'hit', [v]: 'hit' }, tag: Object.fromEntries(order.map(x => [x, 'd' + d[x]])) })); T.n(`Path length between ${u} and ${v}?`, L, `LCA is ${lca(u, v)}.`); let r = 1; for (let i = 1; i < L; i++) r = r * 2 % MOD; const ans = L ? r : 0; T.n('Odd-cost assignments?', ans, L ? '2^(L−1).' : 'An empty path costs 0, which is even.'); return ans; }); }
  });

  D('maximum-profit-from-trading-stocks-with-discounts', {
    t: 'Maximum Profit from Trading Stocks with Discounts',
    r: 'Tree knapsack. For each employee and "did my boss buy?" keep best[b] = max profit spending ≤ b in that subtree. Not buying: merge children with boss-bought = false. Buying (full price, or half if the boss bought): merge children with boss-bought = true.',
    g: R => { const n = R.int(2, 5), hierarchy = []; for (let i = 2; i <= n; i++) hierarchy.push([R.int(1, i - 1), i]); const present = R.ints(n, 1, 8); return { n, present, future: present.map(p => p + R.int(-2, 6)).map(x => Math.max(1, x)), hierarchy, budget: R.int(2, 14) }; },
    s(I, T) { const B = I.budget, ch = Array.from({ length: I.n + 1 }, () => []); I.hierarchy.forEach(([u, v]) => ch[u].push(v)); const merge = (a, b) => { const o = Array(B + 1).fill(0); for (let x = 0; x <= B; x++) for (let y = 0; x + y <= B; y++) o[x + y] = Math.max(o[x + y], a[x] + b[y]); for (let x = 1; x <= B; x++) o[x] = Math.max(o[x], o[x - 1]); return o; }; const memo = {}; const f = (u, pb) => { const key = u + ',' + pb; if (memo[key]) return memo[key]; let no = Array(B + 1).fill(0); ch[u].forEach(c => no = merge(no, f(c, false))); let kid = Array(B + 1).fill(0); ch[u].forEach(c => kid = merge(kid, f(c, true))); const cost = pb ? Math.floor(I.present[u - 1] / 2) : I.present[u - 1], gain = I.future[u - 1] - cost, res = no.slice(); for (let b = cost; b <= B; b++) res[b] = Math.max(res[b], kid[b - cost] + gain); for (let b = 1; b <= B; b++) res[b] = Math.max(res[b], res[b - 1]); memo[key] = res; return res; }; const post = []; const walk = u => { ch[u].forEach(walk); post.push(u); }; walk(1); const g = GR(range(1, I.n + 1), I.hierarchy, { dir: true, tag: Object.fromEntries(range(1, I.n + 1).map(v => [v, I.present[v - 1] + '→' + I.future[v - 1]])) }); post.forEach(u => { if (u === 1) return; T.v(Object.assign({}, g, { cls: { [u]: 'hit' } }), K([['budget', B]])); T.n(`Best profit in employee ${u}'s team if their boss bought (budget ${B})?`, f(u, true)[B], `Employee ${u} may buy at ${Math.floor(I.present[u - 1] / 2)}.`); }); T.v(g, K([['budget', B]])); T.n('Maximum total profit?', f(1, false)[B], 'The CEO has no boss, so pays full price.'); return f(1, false)[B]; }
  });

  D('maximum-good-subtree-score', {
    t: 'Maximum Good Subtree Score',
    r: 'A value can join only if its own digits are distinct; it then "uses" a 10-bit digit mask. For each subtree, knapsack over masks: best[mask] = max sum of chosen values whose digit masks are disjoint. maxScore[u] is the max over masks; the answer is their sum.',
    g: R => { const n = R.int(2, 6); return { vals: Array.from({ length: n }, () => R.pick([1, 2, 3, 5, 7, 12, 34, 40, 51, 66, 98])), par: [-1, ...range(1, n).map(i => R.int(0, i - 1))] }; },
    s(I, T) { const n = I.vals.length, ch = Array.from({ length: n }, () => []); I.par.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); const mk = v => { let m = 0; for (const c of String(v)) { const b = 1 << +c; if (m & b) return -1; m |= b; } return m; }; const sub = u => { const out = [u]; for (let i = 0; i < out.length; i++) out.push(...ch[out[i]]); return out; }; let tot = 0; for (let u = 0; u < n; u++) { let dp = new Map([[0, 0]]); for (const v of sub(u)) { const m = mk(I.vals[v]); if (m < 0) continue; const nx = new Map(dp); for (const [k, s] of dp) if (!(k & m)) { const k2 = k | m; nx.set(k2, Math.max(nx.get(k2) || 0, s + I.vals[v])); } dp = nx; } const best = Math.max(...dp.values()); tot += best; if (u < 5) { T.v(GR(n, I.par.map((p, i) => [p, i]).filter(e => e[0] >= 0), { dir: true, cls: Object.fromEntries(sub(u).map(x => [x, x === u ? 'hit' : 'ok'])), tag: Object.fromEntries(I.vals.map((v, i) => [i, String(v)])) })); T.n(`maxScore[${u}]?`, best, 'Pick values from this subtree with no digit used twice overall.'); } } return tot % MOD; }
  });

  D('find-weighted-median-node-in-tree', {
    t: 'Find Weighted Median Node in Tree',
    r: 'Walk the path from u to v adding edge weights. The median is the first node where the distance from u reaches at least half the total path weight (binary lifting finds it in O(log n)).',
    g: R => { const n = R.int(2, 7), edges = []; for (let i = 1; i < n; i++) edges.push([R.int(0, i - 1), i, R.int(1, 9)]); return { n, edges, queries: Array.from({ length: R.int(1, 3) }, () => [R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const { adj } = kids(I.n, I.edges, 0); const path = (u, v) => { const prev = Array(I.n).fill(-2), pw = Array(I.n).fill(0); prev[u] = -1; const q = [u]; while (q.length) { const x = q.shift(); for (const [y, w] of adj[x]) if (prev[y] === -2) { prev[y] = x; pw[y] = w; q.push(y); } } const out = []; for (let x = v; x !== -1; x = prev[x]) out.unshift([x, pw[x]]); return out; }; return I.queries.map(([u, v]) => { const p = path(u, v), tot = sum(p.slice(1).map(x => x[1])); let d = 0, ans = p[0][0]; for (let i = 0; i < p.length; i++) { if (i) d += p[i][1]; if (2 * d >= tot) { ans = p[i][0]; break; } } T.v(GR(I.n, I.edges.map(e => [e[0], e[1]]), { cls: Object.fromEntries(p.map(x => [x[0], 'ok'])), tag: Object.fromEntries(I.edges.map(e => [e[1], 'w' + e[2]])) }), K([['query', u + ' → ' + v]])); T.n(`Total weight of the path ${u} → ${v}?`, tot, 'Add the edge weights along the unique tree path.'); T.n('Weighted median node?', ans, `First node whose distance from ${u} is ≥ ${tot / 2}.`); return ans; }); }
  });

  D('kth-smallest-path-xor-sum', {
    t: 'Kth Smallest Path XOR Sum',
    r: 'px[u] = px[parent] XOR vals[u] from the root down. For a query (u, k), collect the distinct px values in u\'s subtree (small-to-large merging of sorted sets) and take the k-th smallest, or −1.',
    g: R => { const n = R.int(2, 6); return { par: [-1, ...range(1, n).map(i => R.int(0, i - 1))], vals: R.ints(n, 0, 7), queries: Array.from({ length: R.int(2, 3) }, () => [R.int(0, n - 1), R.int(1, 3)]) }; },
    s(I, T) { const n = I.vals.length, px = Array(n).fill(0), ch = Array.from({ length: n }, () => []); I.par.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); const order = [0]; for (let i = 0; i < order.length; i++) order.push(...ch[order[i]]); order.forEach(u => px[u] = (u ? px[I.par[u]] : 0) ^ I.vals[u]); const g = () => GR(n, I.par.map((p, i) => [p, i]).filter(e => e[0] >= 0), { dir: true, tag: Object.fromEntries(I.vals.map((v, i) => [i, 'v' + v])) }); order.slice(1, 4).forEach(u => { T.v(Object.assign(g(), { cls: { [u]: 'hit' } }), K([['px[parent]', px[I.par[u]]]])); T.n(`Path XOR from the root to node ${u}?`, px[u], `px[${I.par[u]}] XOR vals[${u}].`); }); return I.queries.map(([u, k]) => { const sub = [u]; for (let i = 0; i < sub.length; i++) sub.push(...ch[sub[i]]); const s = [...new Set(sub.map(x => px[x]))].sort((a, b) => a - b), ans = k <= s.length ? s[k - 1] : -1; T.v(Object.assign(g(), { cls: Object.fromEntries(sub.map(x => [x, 'ok'])) }), K([['distinct px', s.join(',')], ['k', k]])); T.n(`${k}-th smallest distinct path XOR in node ${u}'s subtree? (−1 if none)`, ans, 'Sort the distinct values of the subtree.'); return ans; }); }
  });

  D('minimum-increments-to-equalize-leaf-paths', {
    t: 'Minimum Increments to Equalize Leaf Paths',
    r: 'Compute best[u] = cost[u] + max best[child] bottom-up. At every node, each child whose best is below the largest child best must be raised once (raise that child itself), so count those children.',
    g: R => { const n = R.int(2, 7), edges = []; for (let i = 1; i < n; i++) edges.push([R.int(0, i - 1), i]); return { n, edges, cost: R.ints(n, 1, 6) }; },
    s(I, T) { const { ch, order } = kids(I.n, I.edges, 0), best = Array(I.n).fill(0); let tot = 0; order.slice().reverse().forEach(u => { const b = ch[u].map(c => best[c]), mx = b.length ? Math.max(...b) : 0; best[u] = I.cost[u] + mx; if (ch[u].length > 1) { const c = b.filter(x => x < mx).length; tot += c; T.v(GR(I.n, I.edges, { cls: { [u]: 'hit' }, tag: Object.fromEntries(range(0, I.n).map(x => [x, 'c' + I.cost[x] + (order.indexOf(x) > order.indexOf(u) ? ' b' + best[x] : '')])) })); T.n(`Children of node ${u} that need an increment?`, c, `Child path sums ${b.join(', ')}; every one below ${mx} is raised once.`); } }); return tot; }
  });

  D('sum-of-perfect-square-ancestors', {
    t: 'Sum of Perfect Square Ancestors',
    r: 'a × b is a square exactly when a and b have the same square-free kernel (remove every squared prime factor). DFS from the root keeping a count of kernels on the current path; node i adds the count of its own kernel among its ancestors.',
    g: R => { const n = R.int(2, 7); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), nums: R.ints(n, 1, 18) }; },
    s(I, T) { const ker = x => { let r = 1; for (let p = 2; p * p <= x; p++) { let c = 0; while (x % p === 0) { x /= p; c++; } if (c % 2) r *= p; } return r * x; }, { ch } = kids(I.n, I.edges, 0), k = I.nums.map(ker), cnt = new Map(); let tot = 0, asks = 0; const go = u => { const t = u ? (cnt.get(k[u]) || 0) : 0; tot += t; if (u && asks < 5) { asks++; T.v(GR(range(0, I.n), I.edges, { tag: Object.fromEntries(range(0, I.n).map(v => [v, I.nums[v] + '→' + k[v]])), cls: { [u]: 'hit' } })); T.n(`t for node ${u} (value ${I.nums[u]}, kernel ${k[u]})?`, t, 'Ancestors with the same square-free kernel.'); } cnt.set(k[u], (cnt.get(k[u]) || 0) + 1); ch[u].forEach(go); cnt.set(k[u], cnt.get(k[u]) - 1); }; go(0); return tot; }
  });

  D('maximum-subgraph-score-in-a-tree', {
    t: 'Maximum Subgraph Score in a Tree',
    r: 'Rerooting DP. down[u] = (good ? 1 : −1) + Σ max(0, down[child]). Then going down, a child v gets ans[v] = down[v] + max(0, ans[u] − max(0, down[v])).',
    g: R => { const n = R.int(2, 7); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), good: R.ints(n, 0, 1) }; },
    s(I, T) { const { ch, order } = kids(I.n, I.edges, 0), dn = Array(I.n).fill(0), ans = Array(I.n).fill(0); order.slice().reverse().forEach(u => dn[u] = (I.good[u] ? 1 : -1) + sum(ch[u].map(v => Math.max(0, dn[v])))); ans[0] = dn[0]; order.forEach(u => ch[u].forEach(v => ans[v] = dn[v] + Math.max(0, ans[u] - Math.max(0, dn[v])))); const tags = Object.fromEntries(range(0, I.n).map(v => [v, I.good[v] ? 'good' : 'bad'])); order.slice().reverse().slice(0, 3).forEach(u => { T.v(GR(range(0, I.n), I.edges, { tag: tags, cls: { [u]: 'hit' } })); T.n(`down[${u}] (best subtree score rooted at ${u})?`, dn[u], 'Own ±1 plus every child subtree that helps.'); }); order.slice(1, 3).forEach(v => { T.v(GR(range(0, I.n), I.edges, { tag: tags, cls: { [v]: 'hit' } })); T.n(`Best connected score containing node ${v}?`, ans[v], 'Add the parent side if it is positive after removing v\'s own share.'); }); return ans; }
  });

  D('total-sum-of-interaction-cost-in-tree-groups', {
    t: 'Total Sum of Interaction Cost in Tree Groups',
    r: 'An edge is used by every same-group pair split by it. With subtree counts per group (only 20 labels), the edge parent–v adds Σ_g cnt_g(v) × (total_g − cnt_g(v)).',
    g: R => { const n = R.int(2, 7); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), group: R.ints(n, 1, 3) }; },
    s(I, T) { const { ch, order, par } = kids(I.n, I.edges, 0), G2 = [...new Set(I.group)], tot = Object.fromEntries(G2.map(g => [g, I.group.filter(x => x === g).length])), cnt = range(0, I.n).map(u => Object.fromEntries(G2.map(g => [g, I.group[u] === g ? 1 : 0]))); order.slice().reverse().forEach(u => { if (par[u] >= 0) G2.forEach(g => cnt[par[u]][g] += cnt[u][g]); }); let ans = 0, asks = 0; order.slice(1).forEach(v => { const c = sum(G2.map(g => cnt[v][g] * (tot[g] - cnt[v][g]))); ans += c; if (asks++ < 4) { T.v(GR(range(0, I.n), I.edges, { tag: Object.fromEntries(range(0, I.n).map(u => [u, 'g' + I.group[u]])), cls: { [v]: 'hit', [par[v]]: 'hit' } })); T.n(`Same-group pairs crossing edge ${par[v]}–${v}?`, c, 'Per group: inside the subtree × outside it.'); } }); return ans; }
  });

  D('find-diameter-endpoints-of-a-tree', {
    t: 'Find Diameter Endpoints of a Tree',
    r: 'BFS from any node to a farthest node a, then BFS from a to a farthest node b; D = dist(a, b). A node is an endpoint of some diameter exactly when its distance to a or to b equals D.',
    g: R => { const n = R.int(2, 8); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]) }; },
    s(I, T) { const { adj } = kids(I.n, I.edges, 0), bfs = s => { const d = Array(I.n).fill(-1); d[s] = 0; const q = [s]; while (q.length) { const u = q.shift(); adj[u].forEach(([v]) => { if (d[v] < 0) { d[v] = d[u] + 1; q.push(v); } }); } return d; }; const d0 = bfs(0), a = d0.indexOf(Math.max(...d0)), da = bfs(a), D2 = Math.max(...da), b = da.indexOf(D2), db = bfs(b); T.v(GR(range(0, I.n), I.edges, { cls: { 0: 'hit' } })); T.n('Farthest node from 0 (smallest label on ties)?', a, 'First BFS.'); T.v(GR(range(0, I.n), I.edges, { cls: { [a]: 'hit' } })); T.n('Diameter length?', D2, `BFS again from ${a}.`); const out = range(0, I.n).map(v => da[v] === D2 || db[v] === D2 ? '1' : '0').join(''); T.n('How many special nodes?', out.split('').filter(c => c === '1').length, `Nodes at distance D from ${a} or from ${b}.`); return out; }
  });

  D('minimum-edge-toggles-on-a-tree', {
    t: 'Minimum Edge Toggles on a Tree',
    r: 'Mark nodes whose color must change. Each toggle flips two nodes, so the number of marks must be even. Toggling an edge twice is pointless, and the edge above node v must be used exactly when v\'s subtree has an odd number of marks — one post-order pass decides every edge.',
    g: R => { const n = R.int(2, 7); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), start: R.str(n, '01'), target: R.str(n, '01') }; },
    s(I, T) { const { ch, order, par } = kids(I.n, I.edges, 0), d = range(0, I.n).map(i => I.start[i] !== I.target[i] ? 1 : 0), odd = d.slice(), idx = new Map(I.edges.map(([a, b], i) => [Math.min(a, b) + ',' + Math.max(a, b), i])); T.v(GR(range(0, I.n), I.edges, { cls: Object.fromEntries(range(0, I.n).filter(i => d[i]).map(i => [i, 'hit'])) })); T.yn('Is the number of nodes that must change even?', sum(d) % 2 === 0, 'Every toggle flips exactly two nodes.'); if (sum(d) % 2) return [-1]; const used = []; let asks = 0; order.slice(1).reverse().forEach(v => { const p = par[v], use = odd[v] % 2 === 1; if (use) { used.push(idx.get(Math.min(p, v) + ',' + Math.max(p, v))); odd[p] ^= 1; } if (asks++ < 4) { T.v(GR(range(0, I.n), I.edges, { cls: { [v]: 'hit', [p]: 'hit' } }), K([['odd marks in subtree of ' + v, use ? 'yes' : 'no']])); T.yn(`Toggle edge ${p}–${v}?`, use, use ? 'Odd marks below: the parity must cross this edge.' : 'Even marks below: leave it.'); } }); return used.sort((a, b) => a - b); }
  });

  D('pythagorean-distance-nodes-in-a-tree', {
    t: 'Pythagorean Distance Nodes in a Tree',
    r: 'Three BFS runs give every node\'s distance to x, y and z. Sort each node\'s three distances (a ≤ b ≤ c) and count the nodes with a² + b² = c².',
    g: R => { const n = R.int(4, 8), p = R.perm(n, 0); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), x: p[0], y: p[1], z: p[2] }; },
    s(I, T) { const { adj } = kids(I.n, I.edges, 0), bfs = s => { const d = Array(I.n).fill(-1); d[s] = 0; const q = [s]; while (q.length) { const u = q.shift(); adj[u].forEach(([v]) => { if (d[v] < 0) { d[v] = d[u] + 1; q.push(v); } }); } return d; }; const dx = bfs(I.x), dy = bfs(I.y), dz = bfs(I.z); let c = 0; range(0, I.n).forEach(u => { const [a, b, cc] = [dx[u], dy[u], dz[u]].sort((p, q) => p - q), ok = a * a + b * b === cc * cc; if (ok) c++; if (u < 5) { T.v(GR(range(0, I.n), I.edges, { cls: { [I.x]: 'hit', [I.y]: 'hit', [I.z]: 'hit' }, tag: { [u]: `${dx[u]},${dy[u]},${dz[u]}` } })); T.yn(`Is node ${u} special (distances ${dx[u]}, ${dy[u]}, ${dz[u]})?`, ok, `${a}² + ${b}² ${ok ? '=' : '≠'} ${cc}².`); } }); return c; }
  });

  D('median-of-a-binary-search-tree-level', {
    t: 'Median of a Binary Search Tree Level',
    r: 'BFS to the requested level and collect its values (an in-order walk of a BST would already give them sorted). If the level is empty return −1; otherwise sort and take index ⌊len/2⌋, the upper median.',
    g: R => ({ root: R.bst(R.int(1, 7), 1, 20), level: R.int(0, 2) }),
    s(I, T) { const root = Tr.from(I.root); let lv = root ? [root] : []; for (let d = 0; d < I.level && lv.length; d++) lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); T.at({ tree: TR(root), level: I.level }); T.n('How many levels does the tree have?', Tr.depth(root), 'Levels 0 to depth − 1.'); T.at({ tree: TR(root, { hit: lv }), level: I.level }); T.yn(`Does level ${I.level} have any nodes?`, lv.length > 0, lv.length ? 'BFS reaches it.' : 'The tree is not that deep: −1.'); if (!lv.length) return -1; T.n(`How many nodes are on level ${I.level}?`, lv.length, 'BFS level by level from the root.'); const v = lv.map(n => n.val).sort((a, b) => a - b), m = v[v.length >> 1]; T.c('Upper median of that level?', v, m, 'Sorted values, index ⌊len/2⌋.'); return m; }
  });

  D('palindromic-path-queries-in-a-tree', {
    t: 'Palindromic Path Queries in a Tree',
    r: 'A string can be rearranged into a palindrome when at most one letter has an odd count. Give each node a 26-bit parity mask of the path from the root (Euler tour + Fenwick tree of XORs handles updates); the path u–v has mask(u) ⊕ mask(v) ⊕ bit(lca).',
    g: R => { const n = R.int(2, 6), q = []; for (let i = 0; i < R.int(2, 4); i++) q.push(R.chance(0.35) ? `update ${R.int(0, n - 1)} ${R.pick(['a', 'b', 'c'])}` : `query ${R.int(0, n - 1)} ${R.int(0, n - 1)}`); q.push(`query 0 ${n - 1}`); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), s: R.str(n, 'abc'), queries: q }; },
    s(I, T) { const { par, order } = kids(I.n, I.edges, 0), dep = Array(I.n).fill(0); order.slice(1).forEach(v => dep[v] = dep[par[v]] + 1); const s = I.s.split(''), out = []; I.queries.forEach(q => { const [op, a, b] = q.split(' '); if (op === 'update') { s[+a] = b; return; } let u = +a, v = +b; const path = []; const left = [], right = []; while (dep[u] > dep[v]) { left.push(u); u = par[u]; } while (dep[v] > dep[u]) { right.push(v); v = par[v]; } while (u !== v) { left.push(u); right.push(v); u = par[u]; v = par[v]; } path.push(...left, u, ...right.reverse()); let m = 0; path.forEach(x => m ^= 1 << (s[x].charCodeAt(0) - 97)); const odd = popc(m), ok = odd <= 1; T.v(GR(range(0, I.n), I.edges, { cls: Object.fromEntries(path.map(x => [x, 'hit'])), tag: Object.fromEntries(range(0, I.n).map(x => [x, s[x]])) })); T.n(`Letters with an odd count on the path ${a}–${b}?`, odd, `Path reads "${path.map(x => s[x]).join('')}".`); out.push(ok); }); return out; }
  });

  D('maximum-distinct-path-sum-in-a-binary-tree', {
    t: 'Maximum Distinct Path Sum in a Binary Tree',
    r: 'With at most 1000 nodes, try every start: DFS over the tree as an undirected graph (children and parent), carrying the set of values on the path and refusing to step onto a repeated value. Track the best sum seen.',
    g: R => ({ root: R.ints(R.int(1, 6), -3, 5) }),
    s(I, T) { const root = Tr.from(I.root), nodes = Tr.nodes(root), par = new Map(); nodes.forEach(n => { if (n.left) par.set(n.left, n); if (n.right) par.set(n.right, n); }); let best = -Infinity; nodes.forEach((s, k) => { let b = -Infinity; const go = (u, from, vals, sm) => { b = Math.max(b, sm); [u.left, u.right, par.get(u)].forEach(v => { if (v && v !== from && !vals.has(v.val)) { vals.add(v.val); go(v, u, vals, sm + v.val); vals.delete(v.val); } }); }; go(s, null, new Set([s.val]), s.val); best = Math.max(best, b); if (k < 4) { T.at({ tree: TR(root, { hit: [s] }) }); T.n(`Best valid path sum starting at this node (${s.val})?`, b, 'Walk outward without repeating a value.'); } }); return best; }
  });

  D('zigzag-level-sum-of-binary-tree', {
    t: 'Zigzag Level Sum of Binary Tree',
    r: 'BFS level by level. On odd levels walk left to right and add values until a node has no left child; on even levels walk right to left until a node has no right child. Record each level\'s sum.',
    g: R => { const n = R.int(1, 7), arr = [R.int(1, 9)]; for (let i = 1; i < n; i++) arr.push(R.chance(0.75) ? R.int(1, 9) : null); return { root: arr }; },
    s(I, T) { const root = Tr.from(I.root); let lv = [root], d = 1; const out = []; while (lv.length) { const order = d % 2 ? lv : lv.slice().reverse(); let s = 0; const used = []; for (const nd of order) { if (d % 2 ? !nd.left : !nd.right) break; s += nd.val; used.push(nd); } out.push(s); T.at({ tree: TR(root, { hit: used, ok: lv.filter(x => !used.includes(x)) }) }); T.n(`Sum for level ${d}?`, s, d % 2 ? 'Left to right, stop at a node without a left child.' : 'Right to left, stop at a node without a right child.'); lv = lv.flatMap(x => [x.left, x.right].filter(Boolean)); d++; } return out; }
  });

  D('count-non-adjacent-subsets-in-a-rooted-tree', {
    t: 'Count Non-Adjacent Subsets in a Rooted Tree',
    r: 'Tree DP keyed by residue: in[v][r] counts subsets of v\'s subtree that take v and sum to r mod k, out[v][r] those that skip v. Children merge by convolving residues: take v → children must be out; skip v → children may be either. Answer out[0][0] + in[0][0] − 1 (drop the empty set).',
    g: R => { const n = R.int(1, 6); return { parent: range(0, n).map(i => i ? R.int(0, i - 1) : -1), nums: R.ints(n, 1, 6), k: R.int(1, 4) }; },
    s(I, T) { const n = I.parent.length, k = I.k, ch = range(0, n).map(() => []); I.parent.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); const tin = [], tout = [], mul = (a, b) => { const c = Array(k).fill(0); for (let x = 0; x < k; x++) for (let y = 0; y < k; y++) c[(x + y) % k] = (c[(x + y) % k] + a[x] * b[y]) % MOD; return c; }; for (let v = n - 1; v >= 0; v--) { let a = Array(k).fill(0), b = Array(k).fill(0); a[I.nums[v] % k] = 1; b[0] = 1; ch[v].forEach(c => { a = mul(a, tout[c]); b = mul(b, tout[c].map((x, r) => (x + tin[c][r]) % MOD)); }); tin[v] = a; tout[v] = b; } const E = I.parent.map((p, i) => [p, i]).filter(e => e[0] >= 0); range(0, Math.min(n, 3)).forEach(t => { const v = n - 1 - t; T.v(GR(n, E, { cls: { [v]: 'hit' }, tag: Object.fromEntries(I.nums.map((x, i) => [i, x])) }), K([['k', k]])); T.n(`Subsets of node ${v}'s subtree that include ${v} with sum ≡ 0 (mod ${k})?`, tin[v][0], 'Its value plus children taken from their "skip" tables.'); }); return (tin[0][0] + tout[0][0] - 1 + MOD) % MOD; }
  });

  D('subtree-inversion-sum-ii', {
    t: 'Subtree Inversion Sum II',
    r: 'Now any two inverted nodes, not just ancestor pairs, must be at least k apart. Root the tree and run a DP that, for each node, tracks the parity of inversions above it and the depth of the nearest inverted node inside its subtree, so siblings\' choices can be checked against each other.',
    g: R => { const n = R.int(2, 6); return { edges: range(1, n).map(i => [R.int(0, i - 1), i]), nums: R.ints(n, -8, 6), k: R.int(1, 3) }; },
    s(I, T) { const n = I.nums.length, { par } = kids(n, I.edges, 0), adj = range(0, n).map(() => []); I.edges.forEach(([u, v]) => { adj[u].push(v); adj[v].push(u); }); const dist = range(0, n).map(s => { const d = Array(n).fill(-1); d[s] = 0; const q = [s]; while (q.length) { const u = q.shift(); adj[u].forEach(v => { if (d[v] < 0) { d[v] = d[u] + 1; q.push(v); } }); } return d; }); const val = m => { let s = 0; for (let v = 0; v < n; v++) { let sg = 1; for (let u = v; u >= 0; u = par[u]) if (m >> u & 1) sg = -sg; s += sg * I.nums[v]; } return s; }; let best = -Infinity, one = -Infinity; for (let m = 0; m < 1 << n; m++) { const S = range(0, n).filter(i => m >> i & 1); if (S.some((a, i) => S.slice(i + 1).some(b => dist[a][b] < I.k))) continue; const v = val(m); best = Math.max(best, v); if (S.length === 1) one = Math.max(one, v); } T.v(GR(n, I.edges, { tag: Object.fromEntries(I.nums.map((x, i) => [i, x])) }), K([['k', I.k]])); T.n('Tree sum with no inversions?', sum(I.nums), 'Start here.'); T.n('Best sum using exactly one inversion?', one, 'Flip the subtree with the most negative total.'); T.n('Best sum overall?', best, 'Add more inversions only if they are at least k apart.'); return best; }
  });

  D('finish-time-of-tasks-i', {
    t: 'Finish Time of Tasks I',
    r: 'Post-order DFS. A leaf finishes at its base time. An internal task with child finish times earliest..latest finishes at latest + (latest − earliest) + baseTime.',
    g: R => { const n = R.int(1, 6); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), baseTime: R.ints(n, 1, 9) }; },
    s(I, T) { const ch = range(0, I.n).map(() => []); I.edges.forEach(([u, v]) => ch[u].push(v)); const f = []; for (let v = I.n - 1; v >= 0; v--) { if (!ch[v].length) f[v] = I.baseTime[v]; else { const xs = ch[v].map(c => f[c]), hi = Math.max(...xs), lo = Math.min(...xs); f[v] = hi + (hi - lo) + I.baseTime[v]; } if (I.n - 1 - v < 5) { T.v(GR(I.n, I.edges, { dir: true, cls: { [v]: 'hit' }, tag: Object.fromEntries(I.baseTime.map((b, i) => [i, 'b' + b])) })); T.n(`Finish time of task ${v}?`, f[v], ch[v].length ? 'latest + (latest − earliest) + base.' : 'A leaf: just its base time.'); } } return f[0]; }
  });

  D('finish-time-of-tasks-ii', {
    t: 'Finish Time of Tasks II',
    r: 'Compute every subtree\'s finish time for root 0, then reroot: moving the root to a child needs the parent\'s finish time without that child, so keep each node\'s best two minima and maxima over its neighbours\' contributions.',
    g: R => { const n = R.int(1, 6); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), baseTime: R.ints(n, 1, 9) }; },
    s(I, T) { const adj = range(0, I.n).map(() => []); I.edges.forEach(([u, v]) => { adj[u].push(v); adj[v].push(u); }); const fin = (v, p) => { const xs = adj[v].filter(c => c !== p).map(c => fin(c, v)); if (!xs.length) return I.baseTime[v]; const hi = Math.max(...xs), lo = Math.min(...xs); return 2 * hi - lo + I.baseTime[v]; }; const all = range(0, I.n).map(r => fin(r, -1)); range(0, Math.min(3, I.n)).forEach(r => { T.v(GR(I.n, I.edges, { cls: { [r]: 'hit' }, tag: Object.fromEntries(I.baseTime.map((b, i) => [i, 'b' + b])) })); T.n(`Finish time with task ${r} as the root?`, all[r], 'Same rule; neighbours become children.'); }); return Math.min(...all); }
  });

  D('distinct-gate-paths-to-lca', {
    t: 'Distinct Gate Paths to LCA',
    r: 'Climbing from u to its parent is a 2×2 transition on (card colour): red stays red through red gates, flips through white gates, and likewise for blue. A person\'s ways are the product of these matrices from their start up to (not including) the LCA. Binary lifting stores the matrix products for 2^j jumps; multiply Alice\'s and Bob\'s totals and XOR over queries.',
    g: R => { const n = R.int(2, 5); return { n, parent: range(0, n).map(i => i ? R.int(0, i - 1) : -1), gates: Array.from({ length: n }, () => [R.int(0, 2), R.int(0, 2), R.int(0, 2)]), queries: Array.from({ length: R.int(1, 3) }, () => [R.int(0, n - 1), R.int(0, 1), R.int(0, n - 1), R.int(0, 1)]) }; },
    s(I, T) { const P = I.parent, dep = P.map(() => 0); for (let i = 1; i < I.n; i++) dep[i] = dep[P[i]] + 1; const lca = (a, b) => { while (a !== b) { if (dep[a] < dep[b]) b = P[b]; else a = P[a]; } return a; }, ways = (u, c, top) => { let v = [c === 0 ? 1 : 0, c === 1 ? 1 : 0]; while (u !== top) { const [rd, bl, wh] = I.gates[u]; v = [(v[0] * bl + v[1] * wh) % MOD, (v[1] * rd + v[0] * wh) % MOD]; u = P[u]; } return (v[0] + v[1]) % MOD; }; const E = P.map((p, i) => [p, i]).filter(e => e[0] >= 0); let x = 0; I.queries.forEach(([a, ac, b, bc], qi) => { const l = lca(a, b), wa = ways(a, ac, l), wb = ways(b, bc, l); if (qi < 2) { T.v(GR(I.n, E, { cls: { [a]: 'hit', [b]: 'hit' }, tag: Object.fromEntries(I.gates.map((g, i) => [i, `R${g[0]}B${g[1]}W${g[2]}`])) })); T.n(`LCA of ${a} and ${b}?`, l, 'Lift the deeper node, then both together.'); T.n(`Alice's ways from ${a} (${ac ? 'red' : 'blue'})?`, wa, 'Multiply the per-node gate choices, tracking card colour.'); } x ^= wa * wb % MOD; }); return x; }
  });

  D('count-dominant-nodes-in-a-binary-tree', {
    t: 'Count Dominant Nodes in a Binary Tree',
    r: 'Post-order DFS returns each subtree\'s maximum. A node is dominant when its value is at least the maxima of both child subtrees.',
    g: R => ({ root: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const a = I.root, n = a.length, mx = Array(n); let c = 0; for (let i = n - 1; i >= 0; i--) { mx[i] = Math.max(a[i], 2 * i + 1 < n ? mx[2 * i + 1] : -Infinity, 2 * i + 2 < n ? mx[2 * i + 2] : -Infinity); const dom = mx[i] === a[i]; if (dom) c++; if (n - 1 - i < 5) { T.v(GR(n, range(1, n).map(j => [(j - 1) >> 1, j]), { dir: true, cls: { [i]: 'hit' }, tag: Object.fromEntries(a.map((v, j) => [j, v])) })); T.yn(`Is node ${i} (value ${a[i]}) dominant?`, dom, `Subtree max is ${mx[i]}.`); } } return c; }
  });

  D('weighted-sum-of-a-tree', {
    t: 'Weighted Sum of a Tree',
    r: 'BFS from the root to get each node\'s depth (root = 1) and the height h (the deepest level). Then add nums[i] · (h − depth + 1).',
    g: R => { const n = R.int(1, 6); return { parent: range(0, n).map(i => i ? R.int(0, i - 1) : -1), nums: R.ints(n, 1, 9) }; },
    s(I, T) { const n = I.parent.length, dep = [1]; for (let i = 1; i < n; i++) dep[i] = dep[I.parent[i]] + 1; const h = Math.max(...dep), E = I.parent.map((p, i) => [p, i]).filter(e => e[0] >= 0); T.v(GR(n, E, { dir: true, tag: Object.fromEntries(I.nums.map((x, i) => [i, x])) })); T.n('Height of the tree?', h, 'Deepest level, counting the root as 1.'); range(0, Math.min(n, 4)).forEach(i => { T.v(GR(n, E, { dir: true, cls: { [i]: 'hit' }, tag: Object.fromEntries(I.nums.map((x, j) => [j, x])) })); T.n(`Weight of node ${i}?`, I.nums[i] * (h - dep[i] + 1), `Depth ${dep[i]}: multiplier h − d + 1.`); }); return sum(I.nums.map((x, i) => x * (h - dep[i] + 1))); }
  });

  D('total-sum-of-interaction-cost-in-tree-groups-ii', {
    t: 'Total Sum of Interaction Cost in Tree Groups II',
    r: 'An edge splitting the tree into a side with c_g nodes of group g (out of tot_g) is crossed by c_g·(tot_g − c_g) same-group pairs. With many groups, merge per-group counts small-to-large up the DFS, or build a virtual tree per group.',
    g: R => { const n = R.int(1, 6); return { n, edges: range(1, n).map(i => [R.int(0, i - 1), i]), group: R.ints(n, 1, 3) }; },
    s(I, T) { const n = I.n, adj = range(0, n).map(() => []); I.edges.forEach(([u, v]) => { adj[u].push(v); adj[v].push(u); }); const dist = s => { const d = Array(n).fill(-1); d[s] = 0; const q = [s]; while (q.length) { const u = q.shift(); adj[u].forEach(v => { if (d[v] < 0) { d[v] = d[u] + 1; q.push(v); } }); } return d; }, D2 = range(0, n).map(dist), gs = [...new Set(I.group)].sort((a, b) => a - b); let tot = 0; gs.forEach((g, gi) => { const ids = range(0, n).filter(i => I.group[i] === g); let s = 0; ids.forEach((a, i) => ids.slice(i + 1).forEach(b => s += D2[a][b])); tot += s; if (gi < 3) { T.v(GR(n, I.edges, { cls: Object.fromEntries(ids.map(i => [i, 'hit'])), tag: Object.fromEntries(I.group.map((x, i) => [i, 'g' + x])) })); T.n(`Total distance over pairs in group ${g}?`, s, 'Each edge adds c·(tot − c) for this group.'); } }); return tot; }
  });
})();
