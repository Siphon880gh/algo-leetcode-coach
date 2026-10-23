/* v2 games: union-find (02). */
(function () {
  'use strict';
  const { D, A, G, K, GR } = LCGame.H;
  const DSU = n => { const p = Array.from({ length: n }, (_, i) => i), sz = Array(n).fill(1); const f = x => { while (p[x] !== x) { p[x] = p[p[x]]; x = p[x]; } return x; }; return { f, p, sz, u(a, b) { a = f(a); b = f(b); if (a === b) return false; if (sz[a] < sz[b]) [a, b] = [b, a]; p[b] = a; sz[a] += sz[b]; return true; }, comps() { let c = 0; for (let i = 0; i < n; i++) if (f(i) === i) c++; return c; } }; };
  const D4 = [[1, 0], [-1, 0], [0, 1], [0, -1]];
  const pc = x => { let c = 0; while (x) { c += x & 1; x >>= 1; } return c; };
  const sum = a => a.reduce((x, y) => x + y, 0);
  const pairs = (n, k, R) => Array.from({ length: k }, () => { const a = R.int(0, n - 1); let b = R.int(0, n - 2); if (b >= a) b++; return [a, b]; });

  D('groups-of-strings', {
    t: 'Groups of Strings',
    r: 'Encode each word as a 26-bit mask. Two words connect if their masks are equal, differ by one bit (add/delete), or differ by two bits with equal size (replace). Union connected words; report [groups, largest group].',
    g: R => ({ words: Array.from({ length: R.int(1, 6) }, () => [...new Set(R.str(R.int(1, 3), 'abcd'))].join('')) }),
    s(I, T) { const m = I.words.map(w => [...w].reduce((x, c) => x | 1 << (c.charCodeAt(0) - 97), 0)), d = DSU(m.length); let k = 0; for (let i = 0; i < m.length; i++) for (let j = i + 1; j < m.length; j++) { const x = pc(m[i] ^ m[j]), ok = x <= 1 || (x === 2 && pc(m[i]) === pc(m[j])); if (ok) d.u(i, j); if (k++ < 5) { T.at({ a: I.words[i], b: I.words[j] }); T.yn('Connected?', ok, 'One add, delete, or replace apart.'); } } const g = {}; for (let i = 0; i < m.length; i++) g[d.f(i)] = (g[d.f(i)] || 0) + 1; return [Object.keys(g).length, Math.max(...Object.values(g))]; }
  });

  D('amount-of-new-area-painted-each-day', {
    t: 'Amount of New Area Painted Each Day',
    r: 'Keep a "next unpainted" pointer per unit (union-find style jump). Each day walk from start to end via the pointers, counting and linking every unpainted unit you paint.',
    g: R => ({ paint: Array.from({ length: R.int(1, 5) }, () => { const a = R.int(0, 8); return [a, a + R.int(1, 4)]; }) }),
    s(I, T) { const nx = {}, f = x => { const path = []; while (nx[x] !== undefined) { path.push(x); x = nx[x]; } path.forEach(p => nx[p] = x); return x; }; return I.paint.map(([a, b], i) => { let c = 0; for (let x = f(a); x < b; x = f(x)) { nx[x] = x + 1; c++; } if (i < 5) { T.at({ day: i, range: `[${a}, ${b})` }); T.n('New area painted today?', c, 'Skip already-painted units via pointers.'); } return c; }); }
  });

  D('distance-to-a-cycle-in-undirected-graph', {
    t: 'Distance to a Cycle in Undirected Graph',
    r: 'Peel leaves repeatedly (degree 1); the nodes that survive form the cycle. Then BFS outward from all cycle nodes at once to get each node\'s distance.',
    g: R => { const c = R.int(3, 4), n = c + R.int(0, 3), e = []; for (let i = 0; i < c; i++) e.push([i, (i + 1) % c]); for (let i = c; i < n; i++) e.push([R.int(0, i - 1), i]); const p = R.perm(n); return { n, edges: R.shuffle(e.map(([a, b]) => [p[a], p[b]])) }; },
    s(I, T) { const adj = Array.from({ length: I.n }, () => []); I.edges.forEach(([a, b]) => { adj[a].push(b); adj[b].push(a); }); const deg = adj.map(x => x.length), gone = Array(I.n).fill(false), q = []; deg.forEach((d, i) => d === 1 && q.push(i)); while (q.length) { const u = q.shift(); gone[u] = true; for (const v of adj[u]) if (!gone[v] && --deg[v] === 1) q.push(v); } const cyc = []; gone.forEach((g, i) => !g && cyc.push(i)); T.at({ graph: GR(I.n, I.edges) }); T.n('Nodes on the cycle?', cyc.length, 'What survives leaf peeling.'); const dist = Array(I.n).fill(-1), b = cyc.slice(); cyc.forEach(i => dist[i] = 0); while (b.length) { const u = b.shift(); for (const v of adj[u]) if (dist[v] < 0) { dist[v] = dist[u] + 1; b.push(v); } } return dist; }
  });

  D('check-for-contradictions-in-equations', {
    t: 'Check for Contradictions in Equations',
    r: 'Weighted union-find storing each variable\'s ratio to its root. When both sides already share a root, compare ratio(a) / ratio(b) with the given value (tolerance 1e-5); a mismatch is a contradiction.',
    g: R => { const vs = ['a', 'b', 'c', 'd'], hid = { a: R.int(1, 4), b: R.int(1, 4), c: R.int(1, 4), d: R.int(1, 4) }, eq = [], val = []; for (let i = 0; i < R.int(1, 4); i++) { const x = R.pick(vs), y = R.pick(vs.filter(v => v !== x)); eq.push([x, y]); val.push(R.chance(0.8) ? hid[x] / hid[y] : hid[x] / hid[y] + 1); } return { equations: eq, values: val }; },
    s(I, T) { const p = {}, w = {}, f = x => { if (p[x] === undefined) { p[x] = x; w[x] = 1; } if (p[x] === x) return x; const r = f(p[x]); w[x] *= w[p[x]]; p[x] = r; return r; }; for (const [i, [a, b]] of I.equations.entries()) { const ra = f(a), rb = f(b); if (ra !== rb) { p[ra] = rb; w[ra] = I.values[i] * w[b] / w[a]; T.at({ equation: `${a} / ${b} = ${+I.values[i].toFixed(4)}` }); T.yn('Already related?', false, 'Merge with the right weight.'); continue; } const bad = Math.abs(w[a] / w[b] - I.values[i]) > 1e-5; T.at({ equation: `${a} / ${b} = ${+I.values[i].toFixed(4)}`, known: +(w[a] / w[b]).toFixed(4) }); T.yn('Contradiction?', bad, 'Known ratio vs given value.'); if (bad) return true; } return false; }
  });

  D('count-unreachable-pairs-of-nodes-in-an-undirected-graph', {
    t: 'Count Unreachable Pairs of Nodes in an Undirected Graph',
    r: 'Union all edges to get component sizes. Each node pairs with every node outside its component: Σ s·(n − s) / 2.',
    g: R => { const n = R.int(1, 7); return { n, edges: R.edges(n, R.int(0, 6)) }; },
    s(I, T) { const d = DSU(I.n); I.edges.forEach(([a, b]) => d.u(a, b)); const sizes = []; for (let i = 0; i < I.n; i++) if (d.f(i) === i) sizes.push(d.sz[i]); T.at({ graph: GR(I.n, I.edges) }); T.n('Number of components?', sizes.length, 'Union every edge.'); return sum(sizes.map(s => s * (I.n - s))) / 2; }
  });

  D('subarray-with-elements-greater-than-varying-threshold', {
    t: 'Subarray With Elements Greater Than Varying Threshold',
    r: 'Add elements from largest to smallest, merging with already-added neighbors. When value v joins a segment of length k, every element in it is ≥ v; if v > threshold / k, k is a valid answer.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 9), threshold: R.int(1, 20) }),
    cmp: (o, e, I) => { if (e === -1) return o === -1; if (!Number.isInteger(o) || o < 1 || o > I.nums.length) return false; for (let i = 0; i + o <= I.nums.length; i++) if (I.nums.slice(i, i + o).every(x => x > I.threshold / o)) return true; return false; },
    s(I, T) { const n = I.nums.length, d = DSU(n), on = Array(n).fill(false), ord = I.nums.map((v, i) => i).sort((a, b) => I.nums[b] - I.nums[a]); let k2 = 0; for (const i of ord) { on[i] = true; if (i > 0 && on[i - 1]) d.u(i, i - 1); if (i + 1 < n && on[i + 1]) d.u(i, i + 1); const k = d.sz[d.f(i)], ok = I.nums[i] > I.threshold / k; if (k2++ < 5 || ok) { T.at({ nums: A(I.nums, { i }), segmentLength: k }); T.yn('Does min > threshold / length here?', ok, `${I.nums[i]} vs ${I.threshold}/${k}.`); } if (ok) return k; } return -1; }
  });

  D('reachable-nodes-with-restrictions', {
    t: 'Reachable Nodes With Restrictions',
    r: 'Union every edge whose endpoints are both unrestricted; the answer is the size of node 0\'s component.',
    g: R => { const n = R.int(2, 7); return { n, edges: R.edges(n, n - 1, { conn: true }), restricted: R.distinct(R.int(1, Math.min(3, n - 1)), 1, n - 1) }; },
    s(I, T) { const bad = new Set(I.restricted), d = DSU(I.n); I.edges.forEach(([a, b]) => { const ok = !bad.has(a) && !bad.has(b); if (ok) d.u(a, b); }); T.at({ tree: GR(I.n, I.edges, { cls: Object.fromEntries(I.restricted.map(x => [String(x), 'bad'])) }) }); T.n('Size of node 0\'s component?', d.sz[d.f(0)], 'Skip edges touching restricted nodes.'); return d.sz[d.f(0)]; }
  });

  D('minimize-maximum-value-in-a-grid', {
    t: 'Minimize Maximum Value in a Grid',
    r: 'Process cells by increasing value; each gets 1 + max(largest value assigned so far in its row, in its column). This preserves every row/column order with the smallest possible maximum.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3), v = R.distinct(m * n, 1, 20); return { grid: Array.from({ length: m }, (_, i) => v.slice(i * n, i * n + n)) }; },
    cmp: (o, e, I) => { const g = I.grid; if (!Array.isArray(o) || o.length !== g.length) return false; const mx = a => Math.max(...a.flat()); if (mx(o) !== mx(e)) return false; for (let i = 0; i < g.length; i++) for (let j = 0; j < g[0].length; j++) { if (!(o[i][j] >= 1)) return false; for (let k = 0; k < g[0].length; k++) if (g[i][j] < g[i][k] && !(o[i][j] < o[i][k])) return false; for (let k = 0; k < g.length; k++) if (g[i][j] < g[k][j] && !(o[i][j] < o[k][j])) return false; } return true; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, rm = Array(m).fill(0), cm = Array(n).fill(0), out = g.map(r => r.map(() => 0)), cells = []; g.forEach((r, i) => r.forEach((v, j) => cells.push([v, i, j]))); cells.sort((a, b) => a[0] - b[0]).forEach(([v, i, j], k) => { const x = Math.max(rm[i], cm[j]) + 1; out[i][j] = rm[i] = cm[j] = x; if (k < 5) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.n(`New value for ${v}?`, x, '1 + max so far in its row and column.'); } }); return out; }
  });

  D('maximum-segment-sum-after-removals', {
    t: 'Maximum Segment Sum After Removals',
    r: 'Reverse the removals: add elements back one by one, merging with neighbors\' segments and tracking segment sums; the answer before each re-addition is the running maximum.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 1, 9), removeQueries: R.perm(n) }; },
    s(I, T) { const n = I.nums.length, d = DSU(n), s = Array(n).fill(0), on = Array(n).fill(false), out = Array(n).fill(0); let best = 0; for (let k = n - 1; k > 0; k--) { const i = I.removeQueries[k]; on[i] = true; s[i] = I.nums[i]; for (const j of [i - 1, i + 1]) if (j >= 0 && j < n && on[j]) { const a = d.f(i), b = d.f(j); d.u(a, b); s[d.f(i)] = s[a] + s[b]; } best = Math.max(best, s[d.f(i)]); out[k - 1] = best; if (n - k <= 5) { T.at({ restored: A(I.nums.map((v, x) => on[x] ? v : '·'), { i }) }); T.n('Largest segment sum now?', best, 'Merge with neighboring segments.'); } } return out; }
  });

  D('number-of-good-paths', {
    t: 'Number of Good Paths',
    r: 'Process nodes by value. Union each node with neighbors of value ≤ its own. Within each new component, nodes of the current value can pair up: add c·(c+1)/2 for each root with c such nodes.',
    g: R => { const n = R.int(1, 7); return { vals: R.ints(n, 1, 3), edges: R.edges(n, n - 1, { conn: true }) }; },
    s(I, T) { const n = I.vals.length, adj = Array.from({ length: n }, () => []), d = DSU(n); I.edges.forEach(([a, b]) => { adj[a].push(b); adj[b].push(a); }); let tot = 0; [...new Set(I.vals)].sort((a, b) => a - b).forEach(v => { const nodes = I.vals.map((x, i) => i).filter(i => I.vals[i] === v); nodes.forEach(u => adj[u].forEach(w => { if (I.vals[w] <= v) d.u(u, w); })); const c = {}; nodes.forEach(u => c[d.f(u)] = (c[d.f(u)] || 0) + 1); const add = sum(Object.values(c).map(x => x * (x + 1) / 2)); tot += add; T.at({ value: v, tree: GR(n, I.edges) }); T.n(`Good paths whose top value is ${v}?`, add, 'c·(c+1)/2 per component.'); }); return tot; }
  });

  D('minimum-score-of-a-path-between-two-cities', {
    t: 'Minimum Score of a Path between Two Cities',
    r: 'Paths may revisit roads, so any road in city 1\'s component can be used. Union all roads; the answer is the smallest distance among roads in that component.',
    g: R => { const n = R.int(2, 5); return { n, roads: R.edges(n, R.int(n - 1, n + 2), { conn: true, base: 1, w: [1, 9] }) }; },
    s(I, T) { const d = DSU(I.n + 1); I.roads.forEach(([a, b]) => d.u(a, b)); let best = Infinity; I.roads.forEach(([a, b, w], i) => { const inC = d.f(a) === d.f(1); if (inC) best = Math.min(best, w); if (i < 5) { T.at({ road: `${a}–${b} (${w})` }); T.yn('In city 1\'s component?', inC, 'Then usable.'); } }); return best; }
  });

  D('divide-nodes-into-the-maximum-number-of-groups', {
    t: 'Divide Nodes Into the Maximum Number of Groups',
    r: 'Impossible unless every component is bipartite. For each component, BFS from every node and take the largest number of layers; the answer is the sum over components.',
    g: R => { const n = R.int(1, 6); return { n, edges: R.edges(n, R.int(0, 6), { base: 1 }) }; },
    s(I, T) { const adj = Array.from({ length: I.n + 1 }, () => []), d = DSU(I.n + 1); I.edges.forEach(([a, b]) => { adj[a].push(b); adj[b].push(a); d.u(a, b); }); const best = {}; for (let s = 1; s <= I.n; s++) { const dist = Array(I.n + 1).fill(-1), q = [s]; dist[s] = 0; let mx = 1; while (q.length) { const u = q.shift(); for (const v of adj[u]) { if (dist[v] < 0) { dist[v] = dist[u] + 1; mx = Math.max(mx, dist[v] + 1); q.push(v); } else if (Math.abs(dist[v] - dist[u]) !== 1) { T.at({ graph: GR(I.n, I.edges, { base: 1 }) }); T.yn('Is the graph bipartite?', false, 'An odd cycle breaks the layering.'); return -1; } } } const r = d.f(s); best[r] = Math.max(best[r] || 0, mx); if (s <= 4) { T.at({ start: s }); T.n('Layers in a BFS from here?', mx, 'Each layer is a group.'); } } return sum(Object.values(best)); }
  });

  D('maximum-number-of-points-from-grid-queries', {
    t: 'Maximum Number of Points From Grid Queries',
    r: 'Sort queries. Expand from (0,0) with a min-heap by cell value: for each query, pop every reachable cell with value < q, counting it. The count after expansion answers the query.',
    g: R => ({ grid: R.grid(R.int(1, 3), R.int(1, 3), 1, 9), queries: R.ints(R.int(1, 4), 1, 10) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, seen = new Set(['0,0']), h = [[g[0][0], 0, 0]], out = []; let cnt = 0; I.queries.map((q, i) => i).sort((a, b) => I.queries[a] - I.queries[b]).forEach((qi, k) => { const q = I.queries[qi]; while (h.length && h[0][0] < q) { const [, i, j] = h.shift(); cnt++; for (const [a, b] of D4) { const x = i + a, y = j + b; if (x >= 0 && y >= 0 && x < m && y < n && !seen.has(x + ',' + y)) { seen.add(x + ',' + y); h.push([g[x][y], x, y]); h.sort((p, r) => p[0] - r[0]); } } } out[qi] = cnt; if (k < 4) { T.at({ grid: G(g), query: q }); T.n('Points for this query?', cnt, 'Cells reachable through values < q.'); } }); return out; }
  });

  D('find-the-string-with-lcp', {
    t: 'Find the String with LCP',
    r: 'Greedy: give position i a new letter if unassigned, and copy it to every j with lcp[i][j] > 0 (those must be equal). Then rebuild the LCP matrix from the string (from the bottom-right) and verify it matches.',
    g: R => { const w = R.str(R.int(1, 4), 'ab'), n = w.length, l = Array.from({ length: n + 1 }, () => Array(n + 1).fill(0)); for (let i = n - 1; i >= 0; i--) for (let j = n - 1; j >= 0; j--) l[i][j] = w[i] === w[j] ? l[i + 1][j + 1] + 1 : 0; const lcp = l.slice(0, n).map(r => r.slice(0, n)); if (R.chance(0.3)) { const i = R.int(0, n - 1), j = R.int(0, n - 1); lcp[i][j] = R.int(0, n); } return { lcp }; },
    s(I, T) { const L = I.lcp, n = L.length, w = Array(n).fill(null); let c = 0; for (let i = 0; i < n; i++) { if (w[i]) continue; if (c === 26) return ''; const ch = String.fromCharCode(97 + c++); for (let j = i; j < n; j++) if (L[i][j] > 0) w[j] = w[j] || ch; T.at({ lcp: G(L, { hl: [[i, i]] }), word: A(w.map(x => x || '?')) }); T.n('Distinct letters used so far?', c, 'New letter for an unassigned position.'); } if (w.some(x => !x)) return ''; const l = Array.from({ length: n + 1 }, () => Array(n + 1).fill(0)); for (let i = n - 1; i >= 0; i--) for (let j = n - 1; j >= 0; j--) l[i][j] = w[i] === w[j] ? l[i + 1][j + 1] + 1 : 0; const ok = L.every((r, i) => r.every((v, j) => v === l[i][j])); T.at({ word: w.join('') }); T.yn('Does the rebuilt LCP match?', ok, 'Otherwise no string works.'); return ok ? w.join('') : ''; }
  });

  D('minimum-reverse-operations', {
    t: 'Minimum Reverse Operations',
    r: 'BFS over positions of the 1. From i, reversing [L, L+k−1] moves it to 2L + k − 1 − i for valid L; those targets share parity, so keep unvisited positions in two ordered sets (or union-find "next" pointers) and remove them as they are reached.',
    g: R => { const n = R.int(1, 7), p = R.int(0, n - 1); return { n, p, banned: R.distinct(R.int(0, Math.min(2, n - 1)), 0, n - 1).filter(x => x !== p), k: R.int(1, n) }; },
    s(I, T) { const { n, p, k } = I, ban = new Set(I.banned), dist = Array(n).fill(-1); dist[p] = 0; const q = [p]; while (q.length) { const i = q.shift(); const nb = []; for (let L = Math.max(0, i - k + 1); L <= Math.min(i, n - k); L++) { const j = 2 * L + k - 1 - i; if (!ban.has(j) && dist[j] < 0) { dist[j] = dist[i] + 1; q.push(j); nb.push(j); } } if (dist[i] < 3) { T.at({ arr: A(Array.from({ length: n }, (_, x) => x === i ? 1 : ban.has(x) ? '✕' : 0), { i }) }); T.n('New positions reached from here?', nb.length, 'Each window containing i reflects it.'); } } return dist; }
  });

  D('minimum-number-of-visited-cells-in-a-grid', {
    t: 'Minimum Number of Visited Cells in a Grid',
    r: 'BFS from (0,0): from (i,j) you may jump right up to grid[i][j] columns or down up to grid[i][j] rows. Per-row and per-column "next unvisited" pointers (union-find) skip visited cells so each is enqueued once.',
    g: R => ({ grid: R.grid(R.int(1, 3), R.int(1, 4), 0, 3) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, dist = g.map(r => r.map(() => -1)); dist[0][0] = 1; const q = [[0, 0]]; let k = 0; while (q.length) { const [i, j] = q.shift(); if (i === m - 1 && j === n - 1) return dist[i][j]; const v = g[i][j]; for (let y = j + 1; y <= Math.min(n - 1, j + v); y++) if (dist[i][y] < 0) { dist[i][y] = dist[i][j] + 1; q.push([i, y]); } for (let x = i + 1; x <= Math.min(m - 1, i + v); x++) if (dist[x][j] < 0) { dist[x][j] = dist[i][j] + 1; q.push([x, j]); } if (k++ < 4) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.n('Cells visited to reach here (counting both ends)?', dist[i][j], 'BFS layer.'); } } return -1; }
  });

  D('maximum-number-of-fish-in-a-grid', {
    t: 'Maximum Number of Fish in a Grid',
    r: 'Union adjacent water cells (value > 0) and keep the fish sum per component; the answer is the largest sum.',
    g: R => ({ grid: R.grid(R.int(1, 4), R.int(1, 4), 0, 0).map(r => r.map(() => R.chance(0.55) ? R.int(1, 5) : 0)) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, d = DSU(m * n); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) if (g[i][j]) { if (i + 1 < m && g[i + 1][j]) d.u(i * n + j, (i + 1) * n + j); if (j + 1 < n && g[i][j + 1]) d.u(i * n + j, i * n + j + 1); } const s = {}; g.forEach((r, i) => r.forEach((v, j) => { if (v) s[d.f(i * n + j)] = (s[d.f(i * n + j)] || 0) + v; })); T.at({ grid: G(g) }); T.n('Number of water regions?', Object.keys(s).length, 'Union adjacent water cells.'); return Math.max(0, ...Object.values(s)); }
  });

  D('count-the-number-of-complete-components', {
    t: 'Count the Number of Complete Components',
    r: 'Union edges, then count vertices and edges per component. A component with s vertices is complete iff it has s·(s−1)/2 edges.',
    g: R => { const n = R.int(1, 6); return { n, edges: R.edges(n, R.int(0, 7)) }; },
    s(I, T) { const d = DSU(I.n); I.edges.forEach(([a, b]) => d.u(a, b)); const ec = {}; I.edges.forEach(([a]) => ec[d.f(a)] = (ec[d.f(a)] || 0) + 1); let c = 0, k = 0; for (let i = 0; i < I.n; i++) if (d.f(i) === i) { const s = d.sz[i], ok = (ec[i] || 0) === s * (s - 1) / 2; if (ok) c++; if (k++ < 4) { T.at({ graph: GR(I.n, I.edges), component: `size ${s}, ${ec[i] || 0} edges` }); T.yn('Complete?', ok, 's·(s−1)/2 edges.'); } } return c; }
  });

  D('greatest-common-divisor-traversal', {
    t: 'Greatest Common Divisor Traversal',
    r: 'Union each index with hub nodes for its prime factors. Every pair is traversable iff all indices end in one component (a single element is trivially fine; a 1 among several is isolated).',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 20) }),
    s(I, T) { const n = I.nums.length; if (n === 1) { T.at({ nums: A(I.nums) }); T.yn('Any pair to check?', false, 'One index.'); return true; } const hub = {}, d = DSU(n + 30); let next = n; I.nums.forEach((x, i) => { let v = x; for (let p = 2; p * p <= v; p++) if (v % p === 0) { hub[p] = hub[p] ?? next++; d.u(i, hub[p]); while (v % p === 0) v /= p; } if (v > 1) { hub[v] = hub[v] ?? next++; d.u(i, hub[v]); } }); const roots = new Set(I.nums.map((_, i) => d.f(i))); T.at({ nums: A(I.nums) }); T.n('Components among indices?', roots.size, 'Joined through shared primes.'); return roots.size === 1; }
  });

  D('number-of-unique-categories', {
    t: 'Number of Unique Categories',
    r: 'Use haveSameCategory(a, b) to union elements of the same category (compare each element with earlier group representatives). The number of groups is the answer.',
    g: R => { const c = R.ints(R.int(1, 6), 1, 4); return { n: c.length, categoryHandler: c }; },
    exIn: I => ({ n: I.categoryHandler.length, categoryHandler: I.categoryHandler }),
    s(I, T) { const c = I.categoryHandler, reps = []; c.forEach((v, i) => { const hit = reps.find(r => c[r] === v); if (hit === undefined) reps.push(i); if (i < 5) { T.at({ element: i, representatives: A(reps.slice()) }); T.yn('Does it match an existing group?', hit !== undefined, 'Ask haveSameCategory with each representative.'); } }); return reps.length; }
  });

  D('find-the-safest-path-in-a-grid', {
    t: 'Find the Safest Path in a Grid',
    r: 'Multi-source BFS from all thieves gives each cell\'s safeness. Then add cells from safest to least safe, unioning neighbors; when (0,0) and (n−1,n−1) connect, the current safeness is the answer.',
    g: R => { const n = R.int(1, 4), g = R.grid(n, n, 0, 0).map(r => r.map(() => R.chance(0.2) ? 1 : 0)); g[R.int(0, n - 1)][R.int(0, n - 1)] = 1; return { grid: g }; },
    s(I, T) { const g = I.grid, n = g.length, ds = g.map(r => r.map(() => -1)), q = []; g.forEach((r, i) => r.forEach((v, j) => { if (v) { ds[i][j] = 0; q.push([i, j]); } })); while (q.length) { const [i, j] = q.shift(); for (const [a, b] of D4) { const x = i + a, y = j + b; if (x >= 0 && y >= 0 && x < n && y < n && ds[x][y] < 0) { ds[x][y] = ds[i][j] + 1; q.push([x, y]); } } } T.at({ safeness: G(ds) }); T.n('Safeness of the start cell?', ds[0][0], 'Distance to the nearest thief.'); const cells = []; ds.forEach((r, i) => r.forEach((v, j) => cells.push([v, i, j]))); cells.sort((a, b) => b[0] - a[0]); const d = DSU(n * n), on = new Set(); for (const [v, i, j] of cells) { on.add(i * n + j); for (const [a, b] of D4) { const x = i + a, y = j + b; if (x >= 0 && y >= 0 && x < n && y < n && on.has(x * n + y)) d.u(i * n + j, x * n + y); } if (on.has(0) && on.has(n * n - 1) && d.f(0) === d.f(n * n - 1)) return v; } }
  });

  D('sum-of-remoteness-of-all-cells', {
    t: 'Sum of Remoteness of All Cells',
    r: 'Union adjacent open cells. A component with c cells and value sum s contributes c · (total − s): each of its cells is remote from everything outside it.',
    g: R => { const n = R.int(1, 4); return { grid: R.grid(n, n, 0, 0).map(r => r.map(() => R.chance(0.4) ? -1 : R.int(1, 6))) }; },
    s(I, T) { const g = I.grid, n = g.length, d = DSU(n * n); for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (g[i][j] > 0) { if (i + 1 < n && g[i + 1][j] > 0) d.u(i * n + j, (i + 1) * n + j); if (j + 1 < n && g[i][j + 1] > 0) d.u(i * n + j, i * n + j + 1); } const s = {}, c = {}; let tot = 0; g.forEach((r, i) => r.forEach((v, j) => { if (v > 0) { const k = d.f(i * n + j); s[k] = (s[k] || 0) + v; c[k] = (c[k] || 0) + 1; tot += v; } })); T.at({ grid: G(g) }); T.n('Total of all open cells?', tot, 'Sum of positive values.'); return sum(Object.keys(s).map(k => c[k] * (tot - s[k]))); }
  });

  D('make-lexicographically-smallest-array-by-swapping-elements', {
    t: 'Make Lexicographically Smallest Array by Swapping Elements',
    r: 'Sort values; consecutive sorted values within `limit` belong to one swappable group. For each group, place its sorted values into its sorted original indices.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 20), limit: R.int(1, 4) }),
    s(I, T) { const ord = I.nums.map((v, i) => [v, i]).sort((a, b) => a[0] - b[0]), out = []; let k = 0; for (let s = 0; s < ord.length;) { let e = s + 1; while (e < ord.length && ord[e][0] - ord[e - 1][0] <= I.limit) e++; const grp = ord.slice(s, e), idx = grp.map(x => x[1]).sort((a, b) => a - b); idx.forEach((ix, t) => out[ix] = grp[t][0]); if (k++ < 4) { T.at({ sorted: A(ord.map(x => x[0]), { i: s, j: e - 1 }) }); T.n('Values in this swappable group?', e - s, 'Chain while gaps ≤ limit.'); } s = e; } return out; }
  });

  D('minimum-cost-walk-in-weighted-graph', {
    t: 'Minimum Cost Walk in Weighted Graph',
    r: 'A walk may reuse edges, and AND only shrinks, so the best walk uses every edge of the component. Union edges and AND their weights per component; queries in different components get −1.',
    g: R => { const n = R.int(2, 5); return { n, edges: Array.from({ length: R.int(1, 5) }, () => { const [a, b] = pairs(n, 1, R)[0]; return [a, b, R.int(0, 15)]; }), query: pairs(n, R.int(1, 3), R) }; },
    s(I, T) { const d = DSU(I.n); I.edges.forEach(([a, b]) => d.u(a, b)); const and = {}; I.edges.forEach(([a, , w]) => { const r = d.f(a); and[r] = (and[r] ?? -1) & w; }); return I.query.map(([s, t], i) => { const ok = d.f(s) === d.f(t), v = ok ? and[d.f(s)] : -1; if (i < 4) { T.at({ query: `${s} → ${t}` }); T.yn('Same component?', ok, 'Otherwise −1.'); } return v; }); }
  });

  D('check-if-the-rectangle-corner-is-reachable', {
    t: 'Check if the Rectangle Corner Is Reachable',
    r: 'Fail if a circle covers either corner. Otherwise union circles that overlap inside the rectangle; the path is blocked iff some group touches the left/top edges and also the right/bottom edges.',
    g: R => { const X = R.int(2, 6), Y = R.int(2, 6); return { xCorner: X, yCorner: Y, circles: Array.from({ length: R.int(1, 4) }, () => [R.int(1, X), R.int(1, Y), R.int(1, 2)]) }; },
    s(I, T) { const X = I.xCorner, Y = I.yCorner, C = I.circles, n = C.length, inC = (x, y, r, a, b) => (x - a) ** 2 + (y - b) ** 2 <= r * r; const lt = ([x, y, r]) => (Math.abs(x) <= r && y >= 0 && y <= Y) || (Math.abs(y - Y) <= r && x >= 0 && x <= X), rb = ([x, y, r]) => (Math.abs(x - X) <= r && y >= 0 && y <= Y) || (Math.abs(y) <= r && x >= 0 && x <= X); for (const [x, y, r] of C) if (inC(x, y, r, 0, 0) || inC(x, y, r, X, Y)) { T.at({ circle: `(${x}, ${y}) r=${r}` }); T.yn('Does it cover a corner?', true, 'Then no path exists.'); return false; } const d = DSU(n + 2); C.forEach((c, i) => { if (lt(c)) d.u(i, n); if (rb(c)) d.u(i, n + 1); }); for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) { const [x1, y1, r1] = C[i], [x2, y2, r2] = C[j]; if ((x1 - x2) ** 2 + (y1 - y2) ** 2 <= (r1 + r2) ** 2 && x1 * r2 + x2 * r1 < (r1 + r2) * X && y1 * r2 + y2 * r1 < (r1 + r2) * Y) d.u(i, j); } const blocked = d.f(n) === d.f(n + 1); T.at({ circles: A(C.map(c => c.join(','))) }); T.yn('Does a chain of circles wall off the corner?', blocked, 'Left/top edge joined to right/bottom edge.'); return !blocked; }
  });

  D('count-connected-components-in-lcm-graph', {
    t: 'Count Connected Components in LCM Graph',
    r: 'Two numbers connect if lcm ≤ threshold, i.e. they share a common multiple ≤ threshold. Union each num ≤ threshold with all its multiples up to threshold (value space); numbers above threshold stay alone.',
    g: R => ({ nums: R.distinct(R.int(1, 6), 1, 15), threshold: R.int(1, 15) }),
    s(I, T) { const t = I.threshold, d = DSU(t + 1); I.nums.forEach(x => { if (x <= t) for (let m = 2 * x; m <= t; m += x) d.u(x, m); }); const roots = new Set(); let alone = 0; I.nums.forEach((x, i) => { if (x > t) alone++; else roots.add(d.f(x)); if (i < 5) { T.at({ num: x, threshold: t }); T.yn('Can it connect to anything?', x <= t, 'Only if it is ≤ threshold.'); } }); return roots.size + alone; }
  });
})();
