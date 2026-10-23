/* v2 games: graphs (03). */
(function () {
  'use strict';
  const { D, A, G, K, GR } = LCGame.H;
  const DIRS = [[0, 1], [1, 0], [0, -1], [-1, 0]];
  const inG = (g, r, c) => r >= 0 && c >= 0 && r < g.length && c < g[0].length;
  const adjU = (n, edges, base) => { const g = Array.from({ length: n + (base || 0) }, () => []); edges.forEach(([a, b]) => { g[a].push(b); g[b].push(a); }); return g; };
  const adjW = (n, edges, base, dir) => { const g = Array.from({ length: n + (base || 0) }, () => []); edges.forEach(([a, b, w]) => { g[a].push([b, w]); if (!dir) g[b].push([a, w]); }); return g; };
  const dijkstra = (g, s) => { const d = Array(g.length).fill(Infinity), done = Array(g.length).fill(false); d[s] = 0; for (;;) { let u = -1; for (let v = 0; v < g.length; v++) if (!done[v] && d[v] < Infinity && (u < 0 || d[v] < d[u])) u = v; if (u < 0) return d; done[u] = true; for (const [v, w] of g[u]) if (d[u] + w < d[v]) d[v] = d[u] + w; } };
  const ids = (n, b) => [...Array(n).keys()].map(x => x + (b || 0));
  const fdist = (edges, s) => { const d = Array(edges.length).fill(-1); let t = 0; while (s >= 0 && d[s] < 0) { d[s] = t++; s = edges[s]; } return d; };
  const treeEdges = (R, n) => Array.from({ length: n - 1 }, (_, i) => [R.int(0, i), i + 1]);

  D('nearest-exit-from-entrance-in-maze', {
    t: 'Nearest Exit From Entrance in Maze',
    r: 'BFS from the entrance over empty cells. The first border cell reached (other than the entrance) is the nearest exit.',
    g: R => { const m = R.int(1, 4), n = R.int(2, 5), mz = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.3) ? '+' : '.')), r = R.int(0, m - 1), c = R.int(0, n - 1); mz[r][c] = '.'; return { maze: mz, entrance: [r, c] }; },
    s(I, T) { const g = I.maze, [sr, sc] = I.entrance, d = g.map(r => r.map(() => -1)); d[sr][sc] = 0; const q = [[sr, sc]]; for (let i = 0; i < q.length; i++) { const [r, c] = q[i]; if (i && (r === 0 || c === 0 || r === g.length - 1 || c === g[0].length - 1)) return d[r][c]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && g[x][y] === '.' && d[x][y] < 0) { d[x][y] = d[r][c] + 1; q.push([x, y]); if (q.length < 6) { T.at({ maze: G(g, { hl: [[x, y]] }) }); T.yn(`Is (${x}, ${y}) an exit?`, x === 0 || y === 0 || x === g.length - 1 || y === g[0].length - 1, 'On the border and not the entrance.'); } } } } if (q.length < 2) { T.at({ maze: G(g, { hl: [I.entrance] }) }); T.yn('Can we move anywhere?', false, 'Boxed in: −1.'); } return -1; }
  });

  D('minimum-cost-to-reach-destination-in-time', {
    t: 'Minimum Cost to Reach Destination in Time',
    r: 'dp[t][v] = cheapest fees to stand at v at exactly time t. Relax every road for every time ≤ maxTime; answer = min over t of dp[t][n − 1].',
    g: R => { const n = R.int(2, 5); return { maxTime: R.int(1, 12), edges: R.edges(n, R.int(n - 1, n + 2), { conn: true, w: [1, 5] }), passingFees: R.ints(n, 1, 9) }; },
    s(I, T) { const n = I.passingFees.length, M = I.maxTime, dp = Array.from({ length: M + 1 }, () => Array(n).fill(Infinity)); dp[0][0] = I.passingFees[0]; for (let t = 0; t <= M; t++) for (let v = 0; v < n; v++) if (dp[t][v] < Infinity) for (const [a, b, w] of I.edges) { const u = a === v ? b : b === v ? a : -1; if (u >= 0 && t + w <= M) dp[t + w][u] = Math.min(dp[t + w][u], dp[t][v] + I.passingFees[u]); } let best = Infinity, asks = 0; for (let t = 0; t <= M; t++) { if (dp[t][n - 1] < Infinity && asks++ < 4) { T.at({ graph: GR(n, I.edges.map(e => [e[0], e[1]]), { cls: { [n - 1]: 'hit' } }), fees: A(I.passingFees) }); T.n(`Cheapest fees arriving at ${n - 1} at exactly time ${t}?`, dp[t][n - 1], 'Time-layered DP.'); } best = Math.min(best, dp[t][n - 1]); } if (!asks) { T.at({ maxTime: M }); T.yn('Can the destination be reached in time?', false, '−1.'); } return best === Infinity ? -1 : best; }
  });

  D('number-of-ways-to-arrive-at-destination', {
    t: 'Number of Ways to Arrive at Destination',
    r: 'Dijkstra from 0 while counting: a strictly shorter distance resets ways[v] = ways[u]; an equal distance adds ways[u]. Mod 1e9 + 7.',
    g: R => { const n = R.int(2, 6); return { n, roads: R.edges(n, R.int(n - 1, n + 3), { conn: true, w: [1, 3] }) }; },
    s(I, T) { const n = I.n, g = adjW(n, I.roads), d = Array(n).fill(Infinity), w = Array(n).fill(0), done = Array(n).fill(false); d[0] = 0; w[0] = 1; for (;;) { let u = -1; for (let v = 0; v < n; v++) if (!done[v] && d[v] < Infinity && (u < 0 || d[v] < d[u])) u = v; if (u < 0) break; done[u] = true; for (const [v, c] of g[u]) { if (d[u] + c < d[v]) { d[v] = d[u] + c; w[v] = w[u]; } else if (d[u] + c === d[v]) w[v] = (w[v] + w[u]) % 1000000007; } if (u < 5) { T.at({ graph: GR(n, I.roads.map(e => [e[0], e[1]]), { cls: { [u]: 'hit' } }), dist: A(d.map(x => x === Infinity ? '∞' : x)), ways: A(w) }); T.n(`Shortest ways to reach ${u}?`, w[u], 'Final once settled.'); } } return w[n - 1]; }
  });

  D('the-time-when-the-network-becomes-idle', {
    t: 'When the Network Becomes Idle',
    r: 'BFS from the master gives d. Server i gets its reply after r = 2d seconds; it last resends at ⌊(r − 1)/patience⌋·patience, and that copy\'s reply arrives r later. Idle = max over servers + 1.',
    g: R => { const n = R.int(2, 6); return { edges: R.edges(n, R.int(n - 1, n + 1), { conn: true }), patience: [0, ...R.ints(n - 1, 1, 5)] }; },
    s(I, T) { const n = I.patience.length, g = adjU(n, I.edges), d = Array(n).fill(-1); d[0] = 0; const q = [0]; for (let i = 0; i < q.length; i++) for (const v of g[q[i]]) if (d[v] < 0) { d[v] = d[q[i]] + 1; q.push(v); } let best = 0; for (let i = 1; i < n; i++) { const r = 2 * d[i], last = Math.floor((r - 1) / I.patience[i]) * I.patience[i], t = last + r + 1; if (i < 5) { T.at({ graph: GR(n, I.edges, { cls: { [i]: 'hit' } }), patience: A(I.patience) }); T.n(`Second when server ${i} goes quiet?`, t, `Round trip ${r}, last resend at ${last}.`); } best = Math.max(best, t); } return best; }
  });

  D('second-minimum-time-to-reach-destination', {
    t: 'Second Minimum Time to Reach Destination',
    r: 'Time grows with edge count, so BFS for the smallest and the second-smallest (strictly larger) number of edges to n, visiting each node at most twice. Then simulate the signals for that many edges.',
    g: R => { const n = R.int(2, 5); return { n, edges: R.edges(n, R.int(n - 1, n + 1), { conn: true }).map(([a, b]) => [a + 1, b + 1]), time: R.int(1, 5), change: R.int(1, 6) }; },
    s(I, T) { const g = adjU(I.n, I.edges, 1), d1 = Array(I.n + 1).fill(-1), d2 = Array(I.n + 1).fill(-1), q = [[1, 0]]; d1[1] = 0; for (let i = 0; i < q.length; i++) { const [u, d] = q[i]; for (const v of g[u]) { const nd = d + 1; if (d1[v] < 0) { d1[v] = nd; q.push([v, nd]); } else if (d2[v] < 0 && nd > d1[v]) { d2[v] = nd; q.push([v, nd]); } } } T.at({ graph: GR(ids(I.n, 1), I.edges) }); T.n(`Fewest edges from 1 to ${I.n}?`, d1[I.n], 'BFS.'); T.n('Second-fewest (strictly more) edges?', d2[I.n], 'Each node can be reached twice.'); let t = 0; for (let k = 0; k < d2[I.n]; k++) { if (Math.floor(t / I.change) % 2) t = (Math.floor(t / I.change) + 1) * I.change; t += I.time; } return t; }
  });

  D('parallel-courses-iii', {
    t: 'Parallel Courses III',
    r: 'Topological order; finish[v] = time[v] + max finish over its prerequisites. The answer is the largest finish time.',
    g: R => { const n = R.int(1, 6), p = R.perm(n), rel = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.3)) rel.push([p[i] + 1, p[j] + 1]); return { n, relations: rel, time: R.ints(n, 1, 6) }; },
    s(I, T) { const n = I.n, out = Array.from({ length: n + 1 }, () => []), indeg = Array(n + 1).fill(0), start = Array(n + 1).fill(0); I.relations.forEach(([a, b]) => { out[a].push(b); indeg[b]++; }); const q = ids(n, 1).filter(v => !indeg[v]); let best = 0; for (let i = 0; i < q.length; i++) { const u = q[i], f = start[u] + I.time[u - 1]; if (i < 5) { T.at({ graph: GR(ids(n, 1), I.relations, { dir: true, cls: { [u]: 'hit' } }), time: A(I.time) }); T.n(`Finish time of course ${u}?`, f, 'Latest prerequisite finish + its own time.'); } best = Math.max(best, f); for (const v of out[u]) { start[v] = Math.max(start[v], f); if (!--indeg[v]) q.push(v); } } return best; }
  });

  D('minimum-operations-to-convert-number', {
    t: 'Minimum Operations to Convert Number',
    r: 'BFS from start over x + num, x − num, x XOR num. Reaching goal (even out of range) ends; only values in [0, 1000] can be expanded further.',
    g: R => ({ nums: R.distinct(R.int(1, 3), -6, 12), start: R.int(0, 20), goal: R.int(-10, 30) }),
    s(I, T) { if (I.start === I.goal) return 0; const seen = new Set([I.start]); let lv = [I.start], d = 0; while (lv.length) { d++; const nx = []; for (const x of lv) for (const v of I.nums) for (const y of [x + v, x - v, x ^ v]) { if (y === I.goal) { T.at({ from: x, nums: A(I.nums) }); T.n('Operations used?', d, 'BFS level.'); return d; } if (y >= 0 && y <= 1000 && !seen.has(y)) { seen.add(y); nx.push(y); } } if (d < 4) { T.at({ level: A(lv.slice(0, 12)), nums: A(I.nums) }); T.n(`New in-range values after ${d} operation(s)?`, nx.length, 'Unseen, within [0, 1000].'); } lv = nx; } return -1; }
  });

  D('maximum-path-quality-of-a-graph', {
    t: 'Maximum Path Quality of a Graph',
    r: 'Edge times are large relative to maxTime, so paths are short: backtrack from 0, counting a node\'s value the first time it is visited; record quality whenever back at 0.',
    g: R => { const n = R.int(1, 5); return { values: R.ints(n, 0, 20), edges: R.edges(n, R.int(0, n + 1), { w: [10, 20] }), maxTime: R.int(10, 50) }; },
    s(I, T) { const g = adjW(I.values.length, I.edges), cnt = Array(I.values.length).fill(0); let best = 0, asks = 0; const go = (u, t, q) => { if (u === 0) best = Math.max(best, q); for (const [v, w] of g[u]) if (t + w <= I.maxTime) { const add = cnt[v] ? 0 : I.values[v]; if (asks++ < 5) { T.at({ graph: GR(I.values.length, I.edges.map(e => [e[0], e[1]]), { cls: { [u]: 'hit', [v]: 'ok' } }), time: t + w }); T.n(`Quality after stepping to ${v}?`, q + add, 'Values count once.'); } cnt[v]++; go(v, t + w, q + add); cnt[v]--; } }; cnt[0] = 1; go(0, 0, I.values[0]); if (!asks) { T.at({ values: A(I.values) }); T.n('Best quality staying at 0?', I.values[0], 'No move fits the time.'); } return best; }
  });

  D('paths-in-maze-that-lead-to-same-room', {
    t: 'Confusion Score: Count Triangles',
    r: 'A cycle of length 3 is a triangle. For each corridor (a, b) with a < b, count common neighbors c > b.',
    g: R => { const n = R.int(2, 6); return { n, corridors: R.edges(n, R.int(1, n + 4)).map(([a, b]) => [a + 1, b + 1]) }; },
    s(I, T) { const adj = Array.from({ length: I.n + 1 }, () => new Set()); I.corridors.forEach(([a, b]) => { adj[a].add(b); adj[b].add(a); }); let c = 0, asks = 0; for (let a = 1; a <= I.n; a++) for (const b of adj[a]) if (b > a) { const k = [...adj[a]].filter(x => x > b && adj[b].has(x)).length; if (asks++ < 5) { T.at({ graph: GR(ids(I.n, 1), I.corridors, { cls: { [a]: 'hit', [b]: 'hit' } }) }); T.n(`Triangles closing corridor ${a}–${b} with a third room > ${b}?`, k, 'Common neighbors.'); } c += k; } return c; }
  });

  D('minimum-cost-to-reach-city-with-discounts', {
    t: 'Min Cost to Reach City With Discounts',
    r: 'Dijkstra on states (city, discounts used). Each highway costs toll, or ⌊toll/2⌋ if a discount remains.',
    g: R => { const n = R.int(2, 5); return { n, highways: R.edges(n, R.int(1, n + 2), { w: [0, 20] }), discounts: R.int(0, 2) }; },
    s(I, T) { const n = I.n, K2 = I.discounts + 1, g = adjW(n, I.highways), d = Array(n * K2).fill(Infinity), done = Array(n * K2).fill(false); d[0] = 0; let asks = 0; for (;;) { let u = -1; for (let s = 0; s < n * K2; s++) if (!done[s] && d[s] < Infinity && (u < 0 || d[s] < d[u])) u = s; if (u < 0) break; done[u] = true; const v0 = Math.floor(u / K2), k = u % K2; if (v0 === n - 1) { T.at({ cost: d[u], used: k }); T.n('Cheapest cost to the last city?', d[u], 'First time it is settled.'); return d[u]; } for (const [v, w] of g[v0]) { if (d[u] + w < d[v * K2 + k]) d[v * K2 + k] = d[u] + w; if (k + 1 < K2 && d[u] + Math.floor(w / 2) < d[v * K2 + k + 1]) d[v * K2 + k + 1] = d[u] + Math.floor(w / 2); } if (asks++ < 4) { T.at({ graph: GR(n, I.highways.map(e => [e[0], e[1]]), { cls: { [v0]: 'hit' } }), state: `city ${v0}, used ${k}` }); T.n(`Cost settled for city ${v0} with ${k} discount(s) used?`, d[u], 'Smallest tentative state.'); } } return -1; }
  });

  D('valid-arrangement-of-pairs', {
    t: 'Valid Arrangement of Pairs (Euler path)',
    r: 'Pairs are directed edges. Start at a node with out-degree − in-degree = 1 (or anywhere), run Hierholzer, and read the edges of the reversed post-order.',
    g: R => { let x = R.int(0, 6); const p = []; for (let i = 0; i < R.int(1, 6); i++) { const y = R.int(0, 6); p.push([x, y]); x = y; } return { pairs: R.shuffle(p) }; },
    cmp: (o, e, I) => Array.isArray(o) && o.length === I.pairs.length && o.every((p, i) => !i || o[i - 1][1] === p[0]) && JSON.stringify(o.map(p => p.join(',')).sort()) === JSON.stringify(I.pairs.map(p => p.join(',')).sort()),
    s(I, T) { const out = {}, bal = {}; I.pairs.forEach(([a, b]) => { (out[a] = out[a] || []).push(b); bal[a] = (bal[a] || 0) + 1; bal[b] = (bal[b] || 0) - 1; }); const st0 = Object.keys(bal).find(k => bal[k] === 1); const start = st0 !== undefined ? +st0 : I.pairs[0][0]; T.at({ balance: K(bal) }); T.n('Start node (out − in = 1, else any)?', start, 'An Euler path starts there.'); const path = [], st = [start]; while (st.length) { const u = st[st.length - 1]; if (out[u] && out[u].length) st.push(out[u].pop()); else path.push(st.pop()); } path.reverse(); return path.slice(1).map((v, i) => [path[i], v]); }
  });

  D('detonate-the-maximum-bombs', {
    t: 'Detonate the Maximum Bombs',
    r: 'Directed edge i → j if bomb j lies within bomb i\'s radius (compare squared distances). DFS from every bomb and take the largest reachable count.',
    g: R => ({ bombs: Array.from({ length: R.int(1, 6) }, () => [R.int(0, 8), R.int(0, 8), R.int(1, 4)]) }),
    s(I, T) { const b = I.bombs, n = b.length, out = b.map(([x, y, r]) => b.map(([x2, y2], j) => (x - x2) ** 2 + (y - y2) ** 2 <= r * r ? j : -1).filter(j => j >= 0)); let best = 0; for (let s = 0; s < n; s++) { const seen = new Set([s]), st = [s]; while (st.length) for (const v of out[st.pop()]) if (!seen.has(v)) { seen.add(v); st.push(v); } if (s < 5) { T.at({ bombs: A(b.map(x => x.join('/'))), from: s }); T.n(`Bombs detonated starting from bomb ${s}?`, seen.size, 'Chain reaction (directed reachability).'); } best = Math.max(best, seen.size); } return best; }
  });

  D('find-all-possible-recipes-from-given-supplies', {
    t: 'Find All Possible Recipes',
    r: 'Kahn\'s algorithm: each recipe waits on its missing ingredients. Start from supplies; when an item becomes available, decrement recipes that need it; a recipe at 0 becomes available.',
    g: R => { const sup = ['a', 'b', 'c', 'd'], rec = ['r1', 'r2', 'r3'].slice(0, R.int(1, 3)); const all = sup.concat(rec); return { recipes: rec, ingredients: rec.map(r => [...new Set(Array.from({ length: R.int(1, 3) }, () => R.pick(all.filter(x => x !== r))))]), supplies: sup.filter(() => R.chance(0.7)) }; },
    cmp: 'set',
    s(I, T) { const need = new Map(), users = {}; I.recipes.forEach((r, i) => { need.set(r, I.ingredients[i].length); I.ingredients[i].forEach(x => (users[x] = users[x] || []).push(r)); }); const q = I.supplies.slice(), out = []; for (let i = 0; i < q.length; i++) for (const r of users[q[i]] || []) { need.set(r, need.get(r) - 1); if (!need.get(r)) { out.push(r); q.push(r); T.at({ available: A(q.slice(0, i + 1)), made: A(out) }); T.yn(`Can "${r}" be made now?`, true, 'Its last missing ingredient arrived.'); } } if (!out.length) { T.at({ supplies: A(I.supplies) }); T.n('Recipes possible?', 0, 'Some ingredient is always missing.'); } return out; }
  });

  D('minimum-operations-to-remove-adjacent-ones-in-matrix', {
    t: 'Remove Adjacent Ones (bipartite vertex cover)',
    r: 'Cells colored by (r + c) parity form a bipartite graph of adjacent 1s. Removing the fewest 1s = minimum vertex cover = maximum matching (König). Use augmenting paths.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { grid: Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.55) ? 1 : 0)) }; },
    s(I, T) { const g = I.grid, n = g[0].length, match = new Map(); const tryC = (r, c, seen) => { for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc, k = x * n + y; if (!inG(g, x, y) || !g[x][y] || seen.has(k)) continue; seen.add(k); if (!match.has(k) || tryC(...match.get(k), seen)) { match.set(k, [r, c]); return true; } } return false; }; let c = 0, asks = 0; g.forEach((row, r) => row.forEach((v, cc) => { if (v && (r + cc) % 2 === 0) { const ok = tryC(r, cc, new Set()); if (asks++ < 5) { T.at({ grid: G(g, { hl: [[r, cc]] }) }); T.yn(`Can (${r}, ${cc}) be matched to a neighboring 1?`, ok, 'Augmenting path search.'); } if (ok) c++; } })); if (!asks) { T.at({ grid: G(g) }); T.n('Even-parity ones?', 0, 'Nothing to match.'); } return c; }
  });

  D('maximum-employees-to-be-invited-to-a-meeting', {
    t: 'Maximum Employees Invited to a Meeting',
    r: 'favorite is a functional graph. Either seat one big cycle (length ≥ 3), or seat every mutual pair (2-cycle) with the longest chain hanging off each side — these can all sit together. Answer = max of the two.',
    g: R => { const n = R.int(2, 7); return { favorite: Array.from({ length: n }, (_, i) => { let f = R.int(0, n - 1); if (f === i) f = (i + 1) % n; return f; }) }; },
    s(I, T) { const f = I.favorite, n = f.length, indeg = Array(n).fill(0), depth = Array(n).fill(1); f.forEach(v => indeg[v]++); const q = [...Array(n).keys()].filter(v => !indeg[v]); for (let i = 0; i < q.length; i++) { const u = q[i], v = f[u]; depth[v] = Math.max(depth[v], depth[u] + 1); if (!--indeg[v]) q.push(v); } let big = 0, pairs = 0; const seen = Array(n).fill(false); for (let i = 0; i < n; i++) if (indeg[i] && !seen[i]) { let len = 0, j = i; while (!seen[j]) { seen[j] = true; j = f[j]; len++; } if (len === 2) { const s = depth[i] + depth[f[i]]; T.at({ graph: GR(n, f.map((v, k) => [k, v]), { dir: true, cls: { [i]: 'hit', [f[i]]: 'hit' } }) }); T.n(`Seats for mutual pair ${i}–${f[i]} with their chains?`, s, 'Longest chain into each side.'); pairs += s; } else { T.at({ graph: GR(n, f.map((v, k) => [k, v]), { dir: true, cls: { [i]: 'hit' } }) }); T.n('Length of this cycle?', len, 'Follow favorites until back.'); big = Math.max(big, len); } } return Math.max(big, pairs); }
  });

  D('k-highest-ranked-items-within-a-price-range', {
    t: 'K Highest Ranked Items Within a Price Range',
    r: 'BFS from start for distances. Keep cells with price in range, sort by (distance, price, row, col), and return the first k.',
    g: R => { const m = R.int(1, 4), n = R.int(2, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.pick([0, 1, 1, 2, 3, 4, 5]))), r = R.int(0, m - 1), c = R.int(0, n - 1); if (!g[r][c]) g[r][c] = 1; const lo = R.int(1, 4); return { grid: g, pricing: [lo, R.int(lo, 5)], start: [r, c], k: R.int(1, 3) }; },
    s(I, T) { const g = I.grid, d = g.map(r => r.map(() => -1)), q = [I.start]; d[I.start[0]][I.start[1]] = 0; for (let i = 0; i < q.length; i++) { const [r, c] = q[i]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && g[x][y] && d[x][y] < 0) { d[x][y] = d[r][c] + 1; q.push([x, y]); } } } const [lo, hi] = I.pricing, items = q.filter(([r, c]) => g[r][c] >= lo && g[r][c] <= hi); T.at({ grid: G(g, { hl: [I.start] }), dist: G(d) }); T.n(`Reachable items priced in [${lo}, ${hi}]?`, items.length, 'Filter BFS cells.'); items.sort((a, b) => d[a[0]][a[1]] - d[b[0]][b[1]] || g[a[0]][a[1]] - g[b[0]][b[1]] || a[0] - b[0] || a[1] - b[1]); return items.slice(0, I.k); }
  });

  D('remove-all-ones-with-row-and-column-flips-ii', {
    t: 'Remove All Ones With Row and Column Flips II',
    r: 'The grid has ≤ 15 cells, so it fits in a bitmask. BFS (or memoized search) over masks: an operation on a 1 at (i, j) clears row i and column j.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 4); return { grid: Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.5) ? 1 : 0)) }; },
    s(I, T) { const m = I.grid.length, n = I.grid[0].length; let s0 = 0; I.grid.forEach((row, r) => row.forEach((v, c) => { if (v) s0 |= 1 << (r * n + c); })); const seen = new Set([s0]); let lv = [s0], d = 0; while (lv.length) { if (lv.includes(0)) return d; const nx = []; for (const s of lv) for (let i = 0; i < m * n; i++) if (s >> i & 1) { const r = Math.floor(i / n), c = i % n; let t = s; for (let k = 0; k < n; k++) t &= ~(1 << (r * n + k)); for (let k = 0; k < m; k++) t &= ~(1 << (k * n + c)); if (!seen.has(t)) { seen.add(t); nx.push(t); } } if (d < 3) { T.at({ grid: G(I.grid), states: lv.length }); T.n(`New grid states after ${d + 1} operation(s)?`, nx.length, 'One state per distinct result.'); } lv = nx; d++; } return d; }
  });

  D('all-ancestors-of-a-node-in-a-directed-acyclic-graph', {
    t: 'All Ancestors of a Node in a DAG',
    r: 'DFS from each node along outgoing edges; every node reached gets this node as an ancestor. Iterating sources in increasing order keeps each list sorted.',
    g: R => { const n = R.int(1, 6), e = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.3)) e.push([i, j]); const p = R.perm(n); return { n, edgeList: e.map(([a, b]) => [p[a], p[b]]) }; },
    s(I, T) { const out = Array.from({ length: I.n }, () => []), anc = Array.from({ length: I.n }, () => []); I.edgeList.forEach(([a, b]) => out[a].push(b)); for (let s = 0; s < I.n; s++) { const seen = new Set([s]), st = [s]; while (st.length) for (const v of out[st.pop()]) if (!seen.has(v)) { seen.add(v); st.push(v); anc[v].push(s); } if (s < 5) { T.at({ graph: GR(I.n, I.edgeList, { dir: true, cls: { [s]: 'hit' } }) }); T.n(`Descendants of ${s}?`, seen.size - 1, 'Each gets ancestor ' + s + '.'); } } return anc; }
  });

  D('minimum-weighted-subgraph-with-the-required-paths', {
    t: 'Minimum Weighted Subgraph With Required Paths',
    r: 'The two paths merge at some node v and share v → dest. Run Dijkstra from src1, from src2, and from dest on reversed edges; answer = min over v of d1[v] + d2[v] + d3[v].',
    g: R => { const n = R.int(3, 6), e = R.edges(n, R.int(2, n + 4), { dir: true, w: [1, 6] }), [a, b, c] = R.shuffle([...Array(n).keys()]); return { n, edges: e, src1: a, src2: b, dest: c }; },
    s(I, T) { const g = adjW(I.n, I.edges, 0, true), rg = adjW(I.n, I.edges.map(([a, b, w]) => [b, a, w]), 0, true), d1 = dijkstra(g, I.src1), d2 = dijkstra(g, I.src2), d3 = dijkstra(rg, I.dest); let best = Infinity; for (let v = 0; v < I.n; v++) { const s = d1[v] + d2[v] + d3[v]; if (v < 4) { T.at({ graph: GR(I.n, I.edges.map(e => [e[0], e[1]]), { dir: true, cls: { [v]: 'hit', [I.dest]: 'ok' } }) }); T.n(`Total weight if paths meet at ${v}? (−1 if impossible)`, s === Infinity ? -1 : s, 'd1 + d2 + d(v → dest).'); } best = Math.min(best, s); } return best === Infinity ? -1 : best; }
  });

  D('maximum-score-of-a-node-sequence', {
    t: 'Maximum Score of a Node Sequence',
    r: 'Fix the middle edge (b, c). Extend with a neighbor a of b and d of c, all four distinct. Only each node\'s top-3 neighbors by score can matter.',
    g: R => { const n = R.int(4, 7); return { scores: R.ints(n, 1, 20), edges: R.edges(n, R.int(2, n + 4)) }; },
    s(I, T) { const n = I.scores.length, adj = adjU(n, I.edges).map(l => l.sort((a, b) => I.scores[b] - I.scores[a]).slice(0, 3)); let best = -1, asks = 0; for (const [b, c] of I.edges) { let here = -1; for (const a of adj[b]) for (const d of adj[c]) if (a !== c && d !== b && a !== d) here = Math.max(here, I.scores[a] + I.scores[b] + I.scores[c] + I.scores[d]); if (asks++ < 4) { T.at({ graph: GR(n, I.edges, { cls: { [b]: 'hit', [c]: 'hit' } }), scores: A(I.scores) }); T.n(`Best score with middle edge ${b}–${c}? (−1 if none)`, here, 'Top-3 neighbors on each side.'); } best = Math.max(best, here); } if (!asks) T.n('Edges?', 0, 'No sequence: −1.'); return best; }
  });

  D('longest-path-with-different-adjacent-characters', {
    t: 'Longest Path With Different Adjacent Characters',
    r: 'DFS: each node returns its longest downward chain whose characters alternate with its parent. At a node, the best path joins its two longest children chains whose characters differ from it.',
    g: R => { const n = R.int(1, 8); return { parent: [-1, ...Array.from({ length: n - 1 }, (_, i) => R.int(0, i))], s: R.str(n, 'abc') }; },
    s(I, T) { const n = I.parent.length, ch = Array.from({ length: n }, () => []); I.parent.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); let best = 1; const go = u => { let a = 0, b = 0; for (const v of ch[u]) { const d = go(v); if (I.s[v] === I.s[u]) continue; if (d > a) { b = a; a = d; } else if (d > b) b = d; } best = Math.max(best, a + b + 1); if (ch[u].length) { T.at({ graph: GR(n, I.parent.map((p, i) => [p, i]).filter(e => e[0] >= 0), { cls: { [u]: 'hit' }, tag: Object.fromEntries([...I.s].map((c, i) => [i, c])) }) }); T.n(`Longest valid chain going down from ${u}?`, a + 1, 'Best child chain with a different letter + 1.'); } return a + 1; }; go(0); return best; }
  });

  D('maximum-cost-of-trip-with-k-highways', {
    t: 'Maximum Cost of Trip With K Highways',
    r: 'Bitmask DP: dp[mask][v] = max cost of a path visiting exactly mask and ending at v. Extend by unvisited neighbors; answer = max over masks with k + 1 cities.',
    g: R => { const n = R.int(2, 5); return { n, highways: R.edges(n, R.int(1, n + 2), { w: [1, 9] }), k: R.int(1, 4) }; },
    s(I, T) { const n = I.n, g = adjW(n, I.highways); T.at({ graph: GR(n, I.highways.map(e => [e[0], e[1]])), k: I.k }); T.yn(`Is k + 1 = ${I.k + 1} more than the number of cities?`, I.k + 1 > n, 'Then no trip exists.'); if (I.k + 1 > n) return -1; const dp = Array.from({ length: 1 << n }, () => Array(n).fill(-1)); for (let v = 0; v < n; v++) dp[1 << v][v] = 0; let best = -1; for (let m = 1; m < 1 << n; m++) for (let v = 0; v < n; v++) { if (dp[m][v] < 0) continue; let c = 0; for (let x = m; x; x >>= 1) c += x & 1; if (c === I.k + 1) { best = Math.max(best, dp[m][v]); continue; } for (const [u, w] of g[v]) if (!(m >> u & 1)) dp[m | 1 << u][u] = Math.max(dp[m | 1 << u][u], dp[m][v] + w); } return best; }
  });

  D('escape-the-spreading-fire', {
    t: 'Escape the Spreading Fire',
    r: 'BFS from all fires gives when each cell burns. Binary search the waiting time w: BFS from (0, 0) starting at time w, entering a cell only before it burns (the safehouse may burn as you arrive). If any wait works, return 10⁹.',
    g: R => { const m = R.int(2, 4), n = R.int(2, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.pick([0, 0, 0, 1, 2]))); g[0][0] = 0; g[m - 1][n - 1] = 0; return { grid: g }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, fire = g.map(r => r.map(() => Infinity)), q = []; g.forEach((row, r) => row.forEach((v, c) => { if (v === 1) { fire[r][c] = 0; q.push([r, c]); } })); for (let i = 0; i < q.length; i++) { const [r, c] = q[i]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && g[x][y] !== 2 && fire[x][y] === Infinity) { fire[x][y] = fire[r][c] + 1; q.push([x, y]); } } } const ok = w => { if (fire[0][0] <= w) return false; const d = g.map(r => r.map(() => -1)), qq = [[0, 0]]; d[0][0] = w; for (let i = 0; i < qq.length; i++) { const [r, c] = qq[i]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc, t = d[r][c] + 1; if (!inG(g, x, y) || g[x][y] !== 0 || d[x][y] >= 0) continue; if (x === m - 1 && y === n - 1) { if (t <= fire[x][y]) return true; continue; } if (t < fire[x][y]) { d[x][y] = t; qq.push([x, y]); } } } return false; }; T.at({ grid: G(g), burns: G(fire.map(r => r.map(v => v === Infinity ? '∞' : v))) }); T.yn('Can you escape without waiting?', ok(0), 'BFS that stays ahead of the fire.'); if (!ok(0)) return -1; if (ok(m * n)) { T.yn(`Can you still escape after waiting ${m * n} minutes?`, true, 'Fire never cuts you off: 10⁹.'); return 1000000000; } let lo = 0, hi = m * n, asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi + 1) / 2), v = ok(mid); if (asks++ < 4) { T.at({ lo, hi, wait: mid }); T.yn(`Can you wait ${mid} minutes and still escape?`, v, v ? 'lo = mid.' : 'hi = mid − 1.'); } if (v) lo = mid; else hi = mid - 1; } return lo; }
  });

  D('maximum-total-importance-of-roads', {
    t: 'Maximum Total Importance of Roads',
    r: 'Each city\'s value counts once per road touching it. Give the largest values to the highest-degree cities: sort degrees and multiply by 1..n.',
    g: R => { const n = R.int(2, 6); return { n, roads: R.edges(n, R.int(1, n + 2)) }; },
    s(I, T) { const deg = Array(I.n).fill(0); I.roads.forEach(([a, b]) => { deg[a]++; deg[b]++; }); const s = deg.slice().sort((a, b) => a - b); T.at({ graph: GR(I.n, I.roads), degree: A(deg) }); T.n(`Value given to the busiest city?`, I.n, 'Largest value to largest degree.'); return s.reduce((t, d, i) => t + d * (i + 1), 0); }
  });

  D('minimum-obstacle-removal-to-reach-corner', {
    t: 'Minimum Obstacle Removal (0-1 BFS)',
    r: 'Moving into an obstacle costs 1, into an empty cell costs 0. 0-1 BFS with a deque gives the fewest removals to the bottom-right.',
    g: R => { const m = R.int(1, 4), n = R.int(2, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.4) ? 1 : 0)); g[0][0] = 0; g[m - 1][n - 1] = 0; return { grid: g }; },
    s(I, T) { const g = I.grid, d = g.map(r => r.map(() => Infinity)); d[0][0] = 0; const dq = [[0, 0]]; let asks = 0; while (dq.length) { const [r, c] = dq.shift(); for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (!inG(g, x, y)) continue; const nd = d[r][c] + g[x][y]; if (nd < d[x][y]) { d[x][y] = nd; if (g[x][y]) dq.push([x, y]); else dq.unshift([x, y]); if (asks++ < 5) { T.at({ grid: G(g, { hl: [[x, y]] }) }); T.n(`Removals needed to reach (${x}, ${y})?`, nd, g[x][y] ? 'Obstacle: +1.' : 'Empty: +0.'); } } } } return d[g.length - 1][g[0].length - 1]; }
  });

  D('jump-game-viii', {
    t: 'Jump Game VIII',
    r: 'Valid jumps from i go to its next greater-or-equal element and its next smaller element (all in between are on the other side). Monotonic stacks find them; then dp[j] = min dp[i] + costs[j].',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 0, 6), costs: R.ints(n, 0, 9) }; },
    s(I, T) { const a = I.nums, n = a.length, dp = Array(n).fill(Infinity); dp[0] = 0; for (let i = 0; i < n; i++) { const js = []; for (let j = i + 1; j < n; j++) { const mid = a.slice(i + 1, j); if ((a[i] <= a[j] && mid.every(x => x < a[i])) || (a[i] > a[j] && mid.every(x => x >= a[i]))) js.push(j); } js.forEach(j => dp[j] = Math.min(dp[j], dp[i] + I.costs[j])); if (i < 4 && i < n - 1) { T.at({ nums: A(a, { hl: [i] }), dp: A(dp.map(x => x === Infinity ? '∞' : x)) }); T.n(`How many valid jumps start at index ${i}?`, js.length, 'Stack-style next greater-or-equal / next smaller targets.'); } } if (n === 1) T.n('Cost to stand at the end?', 0, 'Already there.'); return dp[n - 1]; }
  });

  D('number-of-increasing-paths-in-a-grid', {
    t: 'Number of Increasing Paths in a Grid',
    r: 'paths[cell] = 1 + Σ paths[neighbor] over strictly larger neighbors. Memoized DFS (or process cells by decreasing value); sum all cells mod 1e9 + 7.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 4); return { grid: Array.from({ length: m }, () => R.ints(n, 1, 6)) }; },
    s(I, T) { const g = I.grid, memo = g.map(r => r.map(() => 0)), MOD = 1000000007; let asks = 0; const go = (r, c) => { if (memo[r][c]) return memo[r][c]; let s = 1; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && g[x][y] > g[r][c]) s = (s + go(x, y)) % MOD; } memo[r][c] = s; if (asks++ < 5) { T.at({ grid: G(g, { hl: [[r, c]] }), paths: G(memo) }); T.n(`Increasing paths starting at (${r}, ${c})?`, s, '1 + paths of larger neighbors.'); } return s; }; let tot = 0; g.forEach((row, r) => row.forEach((_, c) => tot = (tot + go(r, c)) % MOD)); return tot; }
  });

  D('find-closest-node-to-given-two-nodes', {
    t: 'Find Closest Node to Given Two Nodes',
    r: 'Each node has at most one out-edge, so walk from node1 and node2 recording distances. Pick the node reachable from both minimizing the larger distance (smallest index on ties).',
    g: R => { const n = R.int(2, 7); return { edges: Array.from({ length: n }, (_, i) => { const v = R.int(-1, n - 1); return v === i ? -1 : v; }), node1: R.int(0, n - 1), node2: R.int(0, n - 1) }; },
    s(I, T) { const a = fdist(I.edges, I.node1), b = fdist(I.edges, I.node2); T.at({ from1: A(a), from2: A(b) }); let best = -1, bv = Infinity; for (let i = 0; i < I.edges.length; i++) if (a[i] >= 0 && b[i] >= 0 && Math.max(a[i], b[i]) < bv) { bv = Math.max(a[i], b[i]); best = i; } T.n('Smallest max-distance? (−1 if no common node)', best < 0 ? -1 : bv, 'Over nodes reachable from both.'); return best; }
  });

  D('longest-cycle-in-a-graph', {
    t: 'Longest Cycle in a Functional Graph',
    r: 'Walk from each unvisited node, stamping visit times for this walk. If the walk hits a node stamped in the same walk, the cycle length is the time difference.',
    g: R => { const n = R.int(2, 7); return { edges: Array.from({ length: n }, (_, i) => { const v = R.int(-1, n - 1); return v === i ? -1 : v; }) }; },
    s(I, T) { const n = I.edges.length, time = Array(n).fill(0), walk = Array(n).fill(-1); let t = 1, best = -1; for (let s = 0; s < n; s++) { if (time[s]) continue; let u = s; while (u >= 0 && !time[u]) { time[u] = t++; walk[u] = s; u = I.edges[u]; } if (u >= 0 && walk[u] === s) { const len = t - time[u]; T.at({ graph: GR(n, I.edges.map((v, i) => [i, v]).filter(e => e[1] >= 0), { dir: true, cls: { [u]: 'hit' } }) }); T.n('Length of the cycle found?', len, 'Current time − first stamp of the repeated node.'); best = Math.max(best, len); } } if (best < 0) { T.at({ graph: GR(n, I.edges.map((v, i) => [i, v]).filter(e => e[1] >= 0), { dir: true }) }); T.yn('Any cycle?', false, '−1.'); } return best; }
  });

  D('node-with-highest-edge-score', {
    t: 'Node With Highest Edge Score',
    r: 'Edge score of v = sum of indices pointing to v. Accumulate, then take the maximum (smallest index on ties).',
    g: R => { const n = R.int(2, 8); return { edges: Array.from({ length: n }, (_, i) => { let v = R.int(0, n - 1); if (v === i) v = (i + 1) % n; return v; }) }; },
    s(I, T) { const sc = Array(I.edges.length).fill(0); I.edges.forEach((v, i) => sc[v] += i); T.at({ edges: A(I.edges), score: A(sc) }); T.n('Highest edge score?', Math.max(...sc), 'Sum of incoming indices.'); return sc.indexOf(Math.max(...sc)); }
  });

  D('build-a-matrix-with-conditions', {
    t: 'Build a Matrix With Conditions',
    r: 'Topologically sort 1..k by the row conditions and separately by the column conditions. Place number x at (rowOrder index, colOrder index). A cycle in either means [].',
    g: R => { const k = R.int(2, 4), c = () => Array.from({ length: R.int(1, 3) }, () => { const a = R.int(1, k); let b = R.int(1, k); if (b === a) b = a % k + 1; return [a, b]; }); return { k, rowConditions: c(), colConditions: c() }; },
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && !o.length; if (!Array.isArray(o) || o.length !== I.k) return false; const pos = {}; o.forEach((row, r) => row.forEach((v, c) => { if (v) pos[v] = [r, c]; })); if (Object.keys(pos).length !== I.k) return false; return I.rowConditions.every(([a, b]) => pos[a][0] < pos[b][0]) && I.colConditions.every(([a, b]) => pos[a][1] < pos[b][1]); },
    s(I, T) { const topo = (conds, label) => { const out = Array.from({ length: I.k + 1 }, () => []), indeg = Array(I.k + 1).fill(0); conds.forEach(([a, b]) => { out[a].push(b); indeg[b]++; }); const q = ids(I.k, 1).filter(v => !indeg[v]); for (let i = 0; i < q.length; i++) for (const v of out[q[i]]) if (!--indeg[v]) q.push(v); T.at({ graph: GR(ids(I.k, 1), conds, { dir: true }) }); T.yn(`Can the ${label} conditions all be met (no cycle)?`, q.length === I.k, 'Topological sort.'); return q.length === I.k ? q : null; }; const ro = topo(I.rowConditions, 'row'); if (!ro) return []; const co = topo(I.colConditions, 'column'); if (!co) return []; const m = Array.from({ length: I.k }, () => Array(I.k).fill(0)); for (let x = 1; x <= I.k; x++) m[ro.indexOf(x)][co.indexOf(x)] = x; return m; }
  });

  D('most-profitable-path-in-a-tree', {
    t: 'Most Profitable Path in a Tree',
    r: 'First find Bob\'s path to 0 and the time he reaches each node on it. Then DFS Alice from 0: at time t she gets the full amount if she arrives before Bob, half if together, nothing after. Best leaf total.',
    g: R => { const n = R.int(2, 7); return { edges: treeEdges(R, n), bob: R.int(1, n - 1), amount: Array.from({ length: n }, () => R.int(-5, 5) * 2) }; },
    s(I, T) { const n = I.amount.length, g = adjU(n, I.edges), par = Array(n).fill(-1), order = [0], seen = new Set([0]); for (let i = 0; i < order.length; i++) for (const v of g[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; order.push(v); } const bt = Array(n).fill(Infinity); for (let u = I.bob, t = 0; u >= 0; u = par[u], t++) bt[u] = t; T.at({ graph: GR(n, I.edges, { cls: Object.fromEntries(bt.map((t, i) => [i, t < Infinity ? 'hit' : '']).filter(e => e[1])) }), bobTime: A(bt.map(x => x === Infinity ? '−' : x)) }); T.n('Seconds for Bob to reach node 0?', bt[0], 'Depth of Bob\'s node.'); let best = -Infinity; const go = (u, p, t, s) => { const gain = t < bt[u] ? I.amount[u] : t === bt[u] ? I.amount[u] / 2 : 0; s += gain; const kids = g[u].filter(v => v !== p); if (!kids.length) { best = Math.max(best, s); return; } kids.forEach(v => go(v, u, t + 1, s)); }; go(0, -1, 0, 0); return best; }
  });

  D('minimum-cost-to-buy-apples', {
    t: 'Minimum Cost to Buy Apples',
    r: 'Going and returning use the same shortest path, so the trip to city j costs dist(i, j)·(k + 1) + appleCost[j]. Run Dijkstra (or one multi-source Dijkstra seeded with appleCost).',
    g: R => { const n = R.int(2, 5); return { n, roads: R.edges(n, R.int(1, n + 2), { w: [1, 9] }).map(([a, b, w]) => [a + 1, b + 1, w]), appleCost: R.ints(n, 1, 40), k: R.int(1, 3) }; },
    s(I, T) { const g = adjW(I.n, I.roads, 1); return ids(I.n, 1).map(i => { const d = dijkstra(g, i); let best = Infinity; for (let j = 1; j <= I.n; j++) if (d[j] < Infinity) best = Math.min(best, d[j] * (I.k + 1) + I.appleCost[j - 1]); if (i <= 4) { T.at({ graph: GR(ids(I.n, 1), I.roads.map(e => [e[0], e[1]]), { cls: { [i]: 'hit' } }), appleCost: A(I.appleCost) }); T.n(`Cheapest apple trip from city ${i}?`, best, `dist·${I.k + 1} + apple price.`); } return best; }); }
  });

  D('minimum-fuel-cost-to-report-to-the-capital', {
    t: 'Minimum Fuel Cost to Report to the Capital',
    r: 'DFS from 0: the people in a subtree of size s must cross the edge to its parent, needing ⌈s / seats⌉ cars, i.e. that many liters.',
    g: R => { const n = R.int(1, 8); return { roads: treeEdges(R, n), seats: R.int(1, 4) }; },
    s(I, T) { const n = I.roads.length + 1, g = adjU(n, I.roads); let fuel = 0, asks = 0; const go = (u, p) => { let s = 1; for (const v of g[u]) if (v !== p) s += go(v, u); if (u) { const c = Math.ceil(s / I.seats); fuel += c; if (asks++ < 5) { T.at({ graph: GR(n, I.roads, { cls: { [u]: 'hit' } }) }); T.n(`Cars crossing the road above city ${u}?`, c, `${s} people, ${I.seats} seats each.`); } } return s; }; go(0, -1); if (!asks) T.n('Fuel needed?', 0, 'Only the capital.'); return fuel; }
  });

  D('maximum-star-sum-of-a-graph', {
    t: 'Maximum Star Sum of a Graph',
    r: 'A star is a center plus up to k neighbors. For each center add its largest positive neighbor values (at most k).',
    g: R => { const n = R.int(1, 6); return { vals: R.ints(n, -9, 9), edges: R.edges(n, R.int(0, n + 1)), k: R.int(0, 3) }; },
    s(I, T) { const g = adjU(I.vals.length, I.edges); let best = -Infinity; I.vals.forEach((v, c) => { const add = g[c].map(x => I.vals[x]).filter(x => x > 0).sort((a, b) => b - a).slice(0, I.k).reduce((a, b) => a + b, 0); if (c < 5) { T.at({ graph: GR(I.vals.length, I.edges, { cls: { [c]: 'hit' } }), vals: A(I.vals) }); T.n(`Best star sum centered at ${c}?`, v + add, `Center + top ${I.k} positive neighbors.`); } best = Math.max(best, v + add); }); return best; }
  });

  D('add-edges-to-make-degrees-of-all-nodes-even', {
    t: 'Add ≤ 2 Edges to Make All Degrees Even',
    r: 'Only odd-degree nodes matter. 0 odd: yes. 2 odd (a, b): connect them if not adjacent, or both to some c adjacent to neither. 4 odd: some pairing must be two non-edges. Otherwise no.',
    g: R => { const n = R.int(3, 6); return { n, edges: R.edges(n, R.int(1, n + 3)).map(([a, b]) => [a + 1, b + 1]) }; },
    s(I, T) { const adj = Array.from({ length: I.n + 1 }, () => new Set()); I.edges.forEach(([a, b]) => { adj[a].add(b); adj[b].add(a); }); const odd = ids(I.n, 1).filter(v => adj[v].size % 2); T.at({ graph: GR(ids(I.n, 1), I.edges, { cls: Object.fromEntries(odd.map(v => [v, 'hit'])) }) }); T.n('Nodes with odd degree?', odd.length, 'Each needs one new edge end.'); const free = (a, b) => !adj[a].has(b); if (!odd.length) return true; if (odd.length === 2) { const [a, b] = odd; return free(a, b) || ids(I.n, 1).some(c => c !== a && c !== b && free(a, c) && free(b, c)); } if (odd.length === 4) { const [a, b, c, d] = odd; return (free(a, b) && free(c, d)) || (free(a, c) && free(b, d)) || (free(a, d) && free(b, c)); } return false; }
  });

  D('disconnect-path-in-a-binary-matrix-by-at-most-one-flip', {
    t: 'Disconnect Path With At Most One Flip',
    r: 'Find one path from (0, 0) to the corner (right/down moves) and erase its inner cells, then search again. If no second path exists, all paths share a cell, so one flip disconnects.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.75) ? 1 : 0)); g[0][0] = 1; g[m - 1][n - 1] = 1; return { grid: g }; },
    s(I, T) { const g = I.grid.map(r => r.slice()), m = g.length, n = g[0].length; const dfs = (r, c) => { if (r === m - 1 && c === n - 1) return true; if (r >= m || c >= n || !g[r][c]) return false; if (r || c) g[r][c] = 0; return dfs(r + 1, c) || dfs(r, c + 1); }; const a = dfs(0, 0); T.at({ grid: G(I.grid) }); T.yn('Is there a path at all?', a, 'If not, it is already disconnected.'); if (!a) return true; const b = dfs(0, 0); T.at({ grid: G(g) }); T.yn('After erasing the first path, is there a second disjoint path?', b, b ? 'Two disjoint paths: one flip cannot cut both.' : 'Every path shares a cell.'); return !b; }
  });

  D('minimum-time-to-visit-a-cell-in-a-grid', {
    t: 'Minimum Time to Visit a Cell in a Grid',
    r: 'If both first moves are blocked, −1. Otherwise you can stall by stepping back and forth, so Dijkstra: arriving early at a cell waits until its time, adjusted by 1 to keep the parity of the step count.',
    g: R => { const m = R.int(2, 3), n = R.int(2, 4), g = Array.from({ length: m }, () => R.ints(n, 0, 8)); g[0][0] = 0; return { grid: g }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; T.at({ grid: G(g, { hl: [[0, 1], [1, 0]] }) }); const stuck = g[0][1] > 1 && g[1][0] > 1; T.yn('Are both first moves blocked (time > 1)?', stuck, 'Then you can never move: −1.'); if (stuck) return -1; const d = g.map(r => r.map(() => Infinity)), done = new Set(); d[0][0] = 0; let asks = 0; for (;;) { let u = null; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (!done.has(r * n + c) && d[r][c] < Infinity && (!u || d[r][c] < d[u[0]][u[1]])) u = [r, c]; if (!u) break; const [r, c] = u; done.add(r * n + c); if (r === m - 1 && c === n - 1) return d[r][c]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (!inG(g, x, y)) continue; let t = d[r][c] + 1; if (t < g[x][y]) t = g[x][y] + ((g[x][y] - t) % 2); if (t < d[x][y]) { d[x][y] = t; if (asks++ < 4) { T.at({ grid: G(g, { hl: [[r, c], [x, y]] }) }); T.n(`Earliest arrival at (${x}, ${y}) from (${r}, ${c})?`, t, 'Wait (back and forth) if early; keep parity.'); } } } } return -1; }
  });

  D('collect-coins-in-a-tree', {
    t: 'Collect Coins in a Tree',
    r: 'Trim leaves without coins repeatedly. Then trim two more layers of leaves (coins within distance 2 are collected from inside). Every remaining edge is walked twice.',
    g: R => { const n = R.int(1, 9); return { coins: R.ints(n, 0, 1), edges: treeEdges(R, n) }; },
    s(I, T) { const n = I.coins.length, adj = adjU(n, I.edges).map(l => new Set(l)), alive = Array(n).fill(true); let edges = n - 1; let q = [...Array(n).keys()].filter(v => adj[v].size === 1 && !I.coins[v]); while (q.length) { const u = q.pop(); if (!alive[u] || adj[u].size !== 1) continue; alive[u] = false; edges--; const [v] = adj[u]; adj[v].delete(u); adj[u].clear(); if (adj[v].size === 1 && !I.coins[v]) q.push(v); } T.at({ graph: GR(n, I.edges, { cls: Object.fromEntries(alive.map((a, i) => [i, a ? 'hit' : '']).filter(e => e[1])) }) }); T.n('Edges left after trimming coinless leaves?', Math.max(0, edges), 'Repeat until every leaf has a coin.'); for (let round = 0; round < 2; round++) { const leaves = [...Array(n).keys()].filter(v => alive[v] && adj[v].size === 1); for (const u of leaves) { if (adj[u].size !== 1) continue; alive[u] = false; edges--; const [v] = adj[u]; adj[v].delete(u); adj[u].clear(); } T.n(`Edges left after trimming leaf layer ${round + 1}?`, Math.max(0, edges), 'Those leaves are collected from their neighbor.'); } return Math.max(0, edges) * 2; }
  });

  D('shortest-cycle-in-a-graph', {
    t: 'Shortest Cycle in a Graph',
    r: 'BFS from every vertex. When an edge reaches an already-visited vertex that is not the parent, a cycle of length d[u] + d[v] + 1 exists. The smallest over all starts is the answer.',
    g: R => { const n = R.int(2, 7); return { n, edges: R.edges(n, R.int(1, n + 2)) }; },
    s(I, T) { const g = adjU(I.n, I.edges); let best = Infinity; for (let s = 0; s < I.n; s++) { const d = Array(I.n).fill(-1), par = Array(I.n).fill(-1), q = [s]; d[s] = 0; let here = Infinity; for (let i = 0; i < q.length; i++) { const u = q[i]; for (const v of g[u]) { if (d[v] < 0) { d[v] = d[u] + 1; par[v] = u; q.push(v); } else if (par[u] !== v) here = Math.min(here, d[u] + d[v] + 1); } } if (s < 4) { T.at({ graph: GR(I.n, I.edges, { cls: { [s]: 'hit' } }) }); T.n(`Shortest cycle seen by BFS from ${s}? (−1 if none)`, here === Infinity ? -1 : here, 'Non-tree edge closes a cycle.'); } best = Math.min(best, here); } return best === Infinity ? -1 : best; }
  });
})();
