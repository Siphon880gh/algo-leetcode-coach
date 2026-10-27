/* v2 games: union-find (03). Guides scored in the 3483–4041 pass. */
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

  D('properties-graph', {
    t: 'Properties Graph',
    r: 'Turn each row into a set of distinct values. Join rows i and j when their sets share at least k values, then count the union-find components.',
    g: R => { const n = R.int(2, 5), m = R.int(1, 3); return { properties: Array.from({ length: n }, () => R.ints(m, 1, 5)), k: R.int(1, m) }; },
    s(I, T) { const P = I.properties.map(r => new Set(r)), n = P.length, p = range(0, n), f = x => p[x] === x ? x : (p[x] = f(p[x])); let comp = n; const e = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) { const c = [...P[i]].filter(v => P[j].has(v)).length; if (T.room()) { T.at({ a: A([...P[i]], { label: `set ${i}` }), b: A([...P[j]], { label: `set ${j}` }), k: I.k }); T.n(`Distinct values shared by rows ${i} and ${j}?`, c, 'Duplicates inside one row count once.'); } if (c >= I.k) { e.push([i, j]); const a = f(i), b = f(j); if (a !== b) { p[a] = b; comp--; } } } T.v(GR(n, e)); T.n('Connected components?', comp, 'Rows linked through edges form one component.'); return comp; }
  });

  D('path-existence-queries-in-a-graph-i', {
    t: 'Path Existence Queries in a Graph I',
    r: 'nums is sorted, so a path can always step between neighbors. A new component starts exactly where nums[i] − nums[i−1] > maxDiff. Two nodes are connected iff they have the same component id.',
    g: R => { const n = R.int(3, 8); return { n, nums: R.sorted(n, 0, 15), maxDiff: R.int(0, 3), queries: Array.from({ length: R.int(2, 4) }, () => [R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const id = [0]; for (let i = 1; i < I.n; i++) { id.push(id[i - 1] + (I.nums[i] - I.nums[i - 1] > I.maxDiff ? 1 : 0)); if (i < 6) { T.at({ nums: A(I.nums, { i }), comp: A(id.slice()), maxDiff: I.maxDiff }); T.n(`Component id of node ${i}?`, id[i], I.nums[i] - I.nums[i - 1] > I.maxDiff ? 'Gap too big: start a new component.' : 'Close enough to the previous node: same component.'); } } return I.queries.map(([u, v]) => { const ok = id[u] === id[v]; T.at({ comp: A(id, { hl: [u, v] }) }); T.yn(`Is there a path between ${u} and ${v}?`, ok, 'Compare component ids.'); return ok; }); }
  });

  D('maximize-spanning-tree-stability-with-upgrades', {
    t: 'Maximize Spanning Tree Stability with Upgrades',
    r: 'Binary search the stability X. Join every must edge (a cycle or a must edge below X kills it), then free optional edges with s ≥ X, then optional edges with 2s ≥ X while upgrades last. X works if everything ends up connected.',
    g: R => { const n = R.int(2, 5), edges = [], seen = new Set(); for (let i = 1; i < n; i++) { const p = R.int(0, i - 1); seen.add(p + ',' + i); edges.push([p, i, R.int(1, 8), R.chance(0.25) ? 1 : 0]); } for (let t = 0; t < R.int(0, 3); t++) { const a = R.int(0, n - 1), b = R.int(0, n - 1); if (a !== b && !seen.has(Math.min(a, b) + ',' + Math.max(a, b))) { seen.add(Math.min(a, b) + ',' + Math.max(a, b)); edges.push([a, b, R.int(1, 8), 0]); } } return { n, edges, k: R.int(0, 2) }; },
    s(I, T) { const n = I.n, E = I.edges; const ok = X => { const p = range(0, n), f = x => p[x] === x ? x : (p[x] = f(p[x])); let c = n, up = I.k; for (const [u, v, s, m] of E) if (m) { if (s < X || f(u) === f(v)) return false; p[f(u)] = f(v); c--; } for (const [u, v, s, m] of E) if (!m && s >= X && f(u) !== f(v)) { p[f(u)] = f(v); c--; } for (const [u, v, s, m] of E) if (!m && s < X && 2 * s >= X && up > 0 && f(u) !== f(v)) { p[f(u)] = f(v); c--; up--; } return c === 1; }; const cand = [...new Set(E.flatMap(e => e[3] ? [e[2]] : [e[2], 2 * e[2]]))].sort((a, b) => b - a); const g = GR(n, E, { tag: {} }); let ans = -1; for (const X of cand) { const r = ok(X); if (T.room()) { T.v(g, K(E.map(e => [`${e[0]}-${e[1]}`, e[2] + (e[3] ? ' (must)' : '')])), K([['try X', X], ['upgrades', I.k]])); T.yn(`Can every edge in a spanning tree have strength ≥ ${X}?`, r, r ? 'Musts, free edges and upgraded edges connect all nodes.' : 'Some node stays cut off, a must edge is too weak, or the musts form a cycle.'); } if (r) { ans = X; break; } } return ans; }
  });

  D('power-grid-maintenance', {
    t: 'Power Grid Maintenance',
    r: 'Label components once with union-find (going offline never changes them). Keep a min-heap of online ids per component. A check on an online station answers itself; otherwise pop offline ids off its component\'s heap and answer the top, or −1.',
    g: R => { const c = R.int(3, 6), connections = []; for (let i = 2; i <= c; i++) if (R.chance(0.6)) connections.push([R.int(1, i - 1), i]); return { c, connections, queries: Array.from({ length: R.int(4, 7) }, () => [R.pick([1, 1, 2]), R.int(1, c)]) }; },
    s(I, T) { const p = range(0, I.c + 1), f = x => p[x] === x ? x : (p[x] = f(p[x])); I.connections.forEach(([u, v]) => p[f(u)] = f(v)); const off = new Set(), out = []; const g = () => GR(range(1, I.c + 1), I.connections, { cls: Object.fromEntries([...off].map(x => [x, 'dim'])) }); I.queries.forEach(([t, x]) => { if (t === 2) { off.add(x); return; } let r; if (!off.has(x)) r = x; else { const on = range(1, I.c + 1).filter(y => f(y) === f(x) && !off.has(y)); r = on.length ? on[0] : -1; } T.v(g(), K([['offline', [...off].join(',') || '–']])); T.n(`Check at station ${x} is resolved by?`, r, off.has(x) ? 'Smallest online id in the same grid (−1 if none).' : 'Station x is online, so it handles it.'); out.push(r); }); return out; }
  });

  D('minimum-time-for-k-connected-components', {
    t: 'Minimum Time for K Connected Components',
    r: 'Removing edges with time ≤ t only helps, so the component count grows with t. Check candidate times (0 and every edge time, sorted): rebuild with the surviving edges and stop at the first t with at least k components.',
    g: R => { const n = R.int(2, 6), edges = []; for (let i = 1; i < n; i++) edges.push([R.int(0, i - 1), i, R.int(1, 9)]); return { n, edges, k: R.int(1, n) }; },
    s(I, T) { const comps = t => { const p = range(0, I.n), f = x => p[x] === x ? x : (p[x] = f(p[x])); let c = I.n; I.edges.forEach(([u, v, w]) => { if (w > t && f(u) !== f(v)) { p[f(u)] = f(v); c--; } }); return c; }; const cand = [0, ...[...new Set(I.edges.map(e => e[2]))].sort((a, b) => a - b)]; for (const t of cand) { const c = comps(t); T.v(GR(I.n, I.edges.filter(e => e[2] > t), {}), K([['t', t], ['k', I.k]])); T.n(`Components after removing edges with time ≤ ${t}?`, c, 'Count union-find roots over the edges that survive.'); if (c >= I.k) return t; } return cand[cand.length - 1]; }
  });

  D('minimize-maximum-component-cost', {
    t: 'Minimize Maximum Component Cost',
    r: 'Kruskal: add edges from lightest to heaviest, merging components. Stop as soon as the count is ≤ k; the last weight that merged is the answer (0 if n ≤ k already).',
    g: R => { const n = R.int(2, 6), edges = []; for (let i = 1; i < n; i++) edges.push([R.int(0, i - 1), i, R.int(1, 9)]); if (n > 2 && R.chance(0.5)) edges.push([0, n - 1, R.int(1, 9)]); return { n, edges, k: R.int(1, n) }; },
    s(I, T) { const p = range(0, I.n), f = x => p[x] === x ? x : (p[x] = f(p[x])); let c = I.n, last = 0; const E = I.edges.slice().sort((a, b) => a[2] - b[2]); T.at({ components: c, k: I.k }); T.yn('Already at most k components with no edges?', c <= I.k, 'Then the answer is 0.'); for (const [u, v, w] of E) { if (c <= I.k) break; const join = f(u) !== f(v); T.v(GR(I.n, I.edges.map(e => [e[0], e[1]]), { cls: { [u]: 'hit', [v]: 'hit' } }), K([['edge', `${u}-${v} w${w}`], ['components', c]])); T.yn(`Does edge ${u}-${v} (w ${w}) merge two components?`, join, join ? 'Different roots: merge.' : 'Same root: skip it.'); if (join) { p[f(u)] = f(v); c--; last = w; } } return last; }
  });

  D('maximize-alternating-sum-using-swaps', {
    t: 'Maximize Alternating Sum Using Swaps',
    r: 'Indices linked by swaps form components (union-find), and values move freely inside a component. In each component with e even positions, put its e largest values on even indices and the rest on odd ones.',
    g: R => { const n = R.int(2, 6), sw = []; for (let i = 0; i < R.int(0, 4); i++) { const p = R.int(0, n - 2), q = R.int(p + 1, n - 1); sw.push([p, q]); } return { nums: R.ints(n, 1, 9), swaps: sw }; },
    s(I, T) { const n = I.nums.length, p = range(0, n), f = x => p[x] === x ? x : (p[x] = f(p[x])); I.swaps.forEach(([a, b]) => p[f(a)] = f(b)); const comps = new Map(); range(0, n).forEach(i => { const r = f(i); if (!comps.has(r)) comps.set(r, []); comps.get(r).push(i); }); let tot = 0; [...comps.values()].forEach((ix, c) => { const vals = ix.map(i => I.nums[i]).sort((a, b) => b - a), e = ix.filter(i => i % 2 === 0).length, part = sum(vals.slice(0, e)) - sum(vals.slice(e)); tot += part; if (c < 4) { T.at({ nums: A(I.nums, { hl: ix }), component: A(ix) }); T.n(`Best contribution of component {${ix.join(',')}}?`, part, `${e} even slot(s) take the largest values.`); } }); return tot; }
  });

  D('maximum-points-activated-with-one-addition', {
    t: 'Maximum Points Activated With One Addition',
    r: 'Union each point\'s x-line with its y-line in a DSU over coordinates; each component is one activation group. A new point (x from one group, y from another) links two groups, so the answer is the two largest group sizes plus 1 (one group plus 1 if there is only one).',
    g: R => { const pts = new Set(); while (pts.size < R.int(1, 6)) pts.add(R.int(1, 4) + ',' + R.int(1, 4)); return { points: [...pts].map(p => p.split(',').map(Number)) }; },
    s(I, T) { const p = {}, f = x => p[x] === undefined ? (p[x] = x) : p[x] === x ? x : (p[x] = f(p[x])); I.points.forEach(([x, y]) => { p[f('x' + x)] = f('y' + y); }); const size = new Map(); I.points.forEach(([x]) => { const r = f('x' + x); size.set(r, (size.get(r) || 0) + 1); }); const s = [...size.values()].sort((a, b) => b - a); T.at({ points: A(I.points.map(q => `(${q})`)) }); T.n('How many separate activation groups are there?', s.length, 'Points sharing an x or y line are linked.'); T.n('Size of the largest group?', s[0], 'Count points per DSU root.'); if (s.length > 1) T.n('Size of the second largest group?', s[1], 'The new point can bridge it to the largest.'); return s[0] + (s[1] || 0) + 1; }
  });

  D('incremental-even-weighted-cycle-queries', {
    t: 'Incremental Even-Weighted Cycle Queries',
    r: 'Keep a DSU that also stores each node\'s parity (XOR of weights) to its root. An edge between two components is always safe: union them with the right parity. An edge inside a component closes a cycle, which is even exactly when parity(u) ⊕ parity(v) = w.',
    g: R => { const n = R.int(3, 5), e = []; for (let i = 0; i < R.int(2, 6); i++) { const u = R.int(0, n - 2), v = R.int(u + 1, n - 1); if (!e.some(x => x[0] === u && x[1] === v)) e.push([u, v, R.int(0, 1)]); } return { n, edges: e }; },
    s(I, T) { const p = range(0, I.n), par = Array(I.n).fill(0); const f = x => { if (p[x] === x) return x; const r = f(p[x]); par[x] ^= par[p[x]]; p[x] = r; return r; }; let c = 0; I.edges.forEach(([u, v, w], i) => { const ru = f(u), rv = f(v); let ok; if (ru !== rv) { p[ru] = rv; par[ru] = par[u] ^ par[v] ^ w; ok = true; } else ok = (par[u] ^ par[v]) === w; if (ok) c++; if (i < 6) { T.v(GR(range(0, I.n), I.edges.slice(0, i + 1).map(([a, b, x]) => [a, b, x])), K([['edge', `${u}–${v} (w=${w})`]])); T.yn(`Is edge ${u}–${v} added?`, ok, ru !== rv ? 'It joins two components: no new cycle.' : ok ? 'The cycle it closes has even weight.' : 'It would close an odd-weight cycle.'); } }); return c; }
  });
})();
