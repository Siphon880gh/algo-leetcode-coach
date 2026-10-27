/* v2 games: graphs (04). */
(function () {
  'use strict';
  const { D, A, G, K, GR } = LCGame.H;
  const DIRS = [[0, 1], [1, 0], [0, -1], [-1, 0]];
  const inG = (g, r, c) => r >= 0 && c >= 0 && r < g.length && c < g[0].length;
  const adjU = (n, edges) => { const g = Array.from({ length: n }, () => []); edges.forEach(([a, b]) => { g[a].push(b); g[b].push(a); }); return g; };
  const adjW = (n, edges, dir) => { const g = Array.from({ length: n }, () => []); edges.forEach(([a, b, w]) => { g[a].push([b, w]); if (!dir) g[b].push([a, w]); }); return g; };
  const dijkstra = (g, s) => { const d = Array(g.length).fill(Infinity), done = Array(g.length).fill(false); d[s] = 0; for (;;) { let u = -1; for (let v = 0; v < g.length; v++) if (!done[v] && d[v] < Infinity && (u < 0 || d[v] < d[u])) u = v; if (u < 0) return d; done[u] = true; for (const [v, w] of g[u]) if (d[u] + w < d[v]) d[v] = d[u] + w; } };
  const gridDij = (g, stepCost, T, label) => { const m = g.length, n = g[0].length, d = g.map(r => r.map(() => Infinity)), done = new Set(); d[0][0] = 0; let asks = 0; for (;;) { let u = null; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (!done.has(r * n + c) && d[r][c] < Infinity && (!u || d[r][c] < d[u[0]][u[1]])) u = [r, c]; if (!u) break; const [r, c] = u; done.add(r * n + c); if (r === m - 1 && c === n - 1) break; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (!inG(g, x, y)) continue; const t = Math.max(d[r][c], g[x][y]) + stepCost(r, c); if (t < d[x][y]) { d[x][y] = t; if (asks++ < 5) { T.at({ moveTime: G(g, { hl: [[r, c], [x, y]] }) }); T.n(`Earliest arrival at (${x}, ${y}) from (${r}, ${c})?`, t, label(r, c)); } } } } return d[m - 1][n - 1]; };
  const treeEdges = (R, n) => Array.from({ length: n - 1 }, (_, i) => [R.int(0, i), i + 1]);
  const diam = edges => { const n = edges.length + 1, g = adjU(n, edges), far = s => { const d = Array(n).fill(-1); d[s] = 0; const q = [s]; for (let i = 0; i < q.length; i++) for (const v of g[q[i]]) if (d[v] < 0) { d[v] = d[q[i]] + 1; q.push(v); } const x = q[q.length - 1]; return [x, d[x]]; }; return far(far(0)[0])[1]; };
  const houses = (I, T) => { const n = I.n, d = Array.from({ length: n + 1 }, () => Array(n + 1).fill(0)), res = Array(n).fill(0); for (let i = 1; i <= n; i++) for (let j = 1; j <= n; j++) { d[i][j] = Math.min(Math.abs(i - j), Math.abs(i - I.x) + 1 + Math.abs(I.y - j), Math.abs(i - I.y) + 1 + Math.abs(I.x - j)); if (i !== j) res[d[i][j] - 1]++; } T.at({ n, shortcut: `${I.x} and ${I.y}` }); T.n(`Distance from house 1 to house ${n}?`, d[1][n], `The shorter of walking straight and using the street between ${I.x} and ${I.y}.`); T.n('Pairs of houses at distance 1?', res[0], 'Ordered pairs, so each street counts twice.'); T.n('Ordered pairs counted in total?', n * (n - 1), 'Every house with every other house.'); return res; };
  const addRoad = (I, T) => { const out = Array.from({ length: I.n }, (_, i) => i + 1 < I.n ? [i + 1] : []); return I.queries.map(([u, v], qi) => { out[u].push(v); const d = Array(I.n).fill(-1); d[0] = 0; const q = [0]; for (let i = 0; i < q.length; i++) for (const w of out[q[i]]) if (d[w] < 0) { d[w] = d[q[i]] + 1; q.push(w); } if (qi < 4) { T.at({ added: `${u} to ${v}`, dist: A(d) }); T.n(`Shortest distance to city ${I.n - 1} now?`, d[I.n - 1], 'BFS on the road graph.'); } return d[I.n - 1]; }); };
  const isPrime = x => { if (x < 2) return false; for (let i = 2; i * i <= x; i++) if (x % i === 0) return false; return true; };

  D('minimize-the-total-price-of-the-trips', {
    t: 'Minimize the Total Price of the Trips',
    r: 'Count how many trips pass each node (paths in a tree are unique). Then a house-robber tree DP: halve a node (children must stay full) or keep it full (children free to choose).',
    g: R => { const n = R.int(1, 7); return { n, edges: treeEdges(R, n), price: Array.from({ length: n }, () => 2 * R.int(1, 5)), trips: Array.from({ length: R.int(1, 3) }, () => [R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const res = (() => { const n = I.n, g = adjU(n, I.edges), par = Array(n).fill(-1), dep = Array(n).fill(0), order = [0], seen = new Set([0]); for (let i = 0; i < order.length; i++) for (const v of g[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; dep[v] = dep[order[i]] + 1; order.push(v); } const cnt = Array(n).fill(0); for (let [a, b] of I.trips) { while (a !== b) { if (dep[a] >= dep[b]) { cnt[a]++; a = par[a]; } else { cnt[b]++; b = par[b]; } } cnt[a]++; } T.at({ graph: GR(n, I.edges), uses: A(cnt) }); T.n('Trips passing node 0?', cnt[0], 'Walk each trip path.'); const full = Array(n).fill(0), half = Array(n).fill(0); for (const u of order.slice().reverse()) { full[u] = cnt[u] * I.price[u]; half[u] = cnt[u] * I.price[u] / 2; for (const v of g[u]) if (v !== par[u]) { full[u] += Math.min(full[v], half[v]); half[u] += full[v]; } } T.n('Best total if node 0 is halved?', half[0], 'Its children stay full.'); return Math.min(full[0], half[0]); })(); T.n('Minimum total price?', res, 'The better of halving node 0 or not.'); return res; }
  });

  D('minimum-cost-of-a-path-with-special-roads', {
    t: 'Minimum Cost Path With Special Roads',
    r: 'Only the start, the target and the special-road endpoints matter. Dijkstra over those points: walking costs Manhattan distance, and a special road from its start costs its own price.',
    g: R => { const sx = R.int(1, 3), sy = R.int(1, 3), tx = sx + R.int(1, 6), ty = sy + R.int(1, 6), p = () => [R.int(sx, tx), R.int(sy, ty)]; return { start: [sx, sy], target: [tx, ty], specialRoads: Array.from({ length: R.int(1, 4) }, () => [...p(), ...p(), R.int(1, 6)]) }; },
    s(I, T) { const res = (() => { const pts = [I.start, I.target, ...I.specialRoads.map(r => [r[2], r[3]])], md = (a, b) => Math.abs(a[0] - b[0]) + Math.abs(a[1] - b[1]), n = pts.length, d = Array(n).fill(Infinity), done = Array(n).fill(false); d[0] = 0; let asks = 0; T.at({ start: I.start.join(','), target: I.target.join(',') }); T.n('Walking cost straight to the target?', md(I.start, I.target), 'Manhattan distance.'); for (;;) { let u = -1; for (let v = 0; v < n; v++) if (!done[v] && d[v] < Infinity && (u < 0 || d[v] < d[u])) u = v; if (u < 0 || u === 1) break; done[u] = true; for (let v = 0; v < n; v++) d[v] = Math.min(d[v], d[u] + md(pts[u], pts[v])); I.specialRoads.forEach((r, i) => { const c = d[u] + md(pts[u], [r[0], r[1]]) + r[4]; if (c < d[i + 2]) { d[i + 2] = c; if (asks++ < 4) { T.at({ at: pts[u].join(','), road: r.join(',') }); T.n(`Cost to reach (${r[2]}, ${r[3]}) via this special road?`, c, 'Walk to its start, plus its cost.'); } } }); } if (!asks) T.yn('Does any special road beat walking?', false, 'None of them improved a cost.'); return d[1]; })(); T.n('Minimum cost to the target?', res, 'Best mix of walking and special roads.'); return res; }
  });

  D('modify-graph-edge-weights', {
    t: 'Modify Graph Edge Weights',
    r: 'Treat every −1 edge as huge. If the shortest path is already < target: impossible. Then switch −1 edges to weight 1 one at a time; when the distance first drops to ≤ target, raise that edge by the gap so it is exactly target.',
    g: R => { const n = R.int(2, 5), e = R.edges(n, R.int(n - 1, n + 2), { conn: true }).map(([a, b]) => [a, b, R.chance(0.5) ? -1 : R.int(1, 5)]); return { n, edges: e, source: 0, destination: n - 1, target: R.int(1, 10) }; },
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && !o.length; if (!Array.isArray(o) || o.length !== I.edges.length) return false; const key = x => Math.min(x[0], x[1]) + ',' + Math.max(x[0], x[1]), orig = new Map(I.edges.map(x => [key(x), x[2]])); for (const x of o) { const w = orig.get(key(x)); if (w === undefined || (w > 0 && x[2] !== w) || x[2] < 1 || x[2] > 2e9) return false; } return dijkstra(adjW(I.n, o), I.source)[I.destination] === I.target; },
    s(I, T) { const BIG = 2000000000, ed = I.edges.map(e => e.slice()), dist = () => dijkstra(adjW(I.n, ed.map(([a, b, w]) => [a, b, w < 0 ? BIG : w])), I.source)[I.destination]; const d0 = dist(); T.at({ graph: GR(I.n, I.edges.map(e => [e[0], e[1]])), target: I.target }); T.n('Shortest distance with all −1 edges set huge (−1 if ≥ 2·10⁹)?', d0 >= BIG ? -1 : d0, 'Fixed edges only.'); if (d0 < I.target) return []; if (d0 === I.target) return ed.map(([a, b, w]) => [a, b, w < 0 ? BIG : w]); for (let i = 0, asks = 0; i < ed.length; i++) { if (ed[i][2] >= 0) continue; ed[i][2] = 1; const d = dist(); if (asks++ < 4) { T.at({ graph: GR(I.n, ed.map(e => [e[0], e[1]]), { ecls: { [ed[i][0] + '-' + ed[i][1]]: 'hit' } }) }); T.yn(`With edge ${ed[i][0]}–${ed[i][1]} set to 1, is the distance ≤ ${I.target}?`, d <= I.target, `Distance ${d}.`); } if (d <= I.target) { ed[i][2] += I.target - d; return ed.map(([a, b, w]) => [a, b, w < 0 ? BIG : w]); } } return []; }
  });

  D('find-shortest-path-with-k-hops', {
    t: 'Shortest Path With K Hops',
    r: 'Dijkstra on states (node, hops used). Each edge can be paid normally or hopped for free if hops remain.',
    g: R => { const n = R.int(2, 5), [s, d] = R.shuffle([...Array(n).keys()]); return { n, edges: R.edges(n, R.int(n - 1, n + 2), { conn: true, w: [1, 9] }), s, d, k: R.int(0, n - 1) }; },
    s(I, T) { const K2 = I.k + 1, g = adjW(I.n, I.edges), N = I.n * K2, dist = Array(N).fill(Infinity), done = Array(N).fill(false); dist[I.s * K2] = 0; let asks = 0; for (;;) { let u = -1; for (let x = 0; x < N; x++) if (!done[x] && dist[x] < Infinity && (u < 0 || dist[x] < dist[u])) u = x; if (u < 0) return -1; done[u] = true; const v0 = Math.floor(u / K2), h = u % K2; if (v0 === I.d) { T.at({ cost: dist[u], hops: h }); T.n('Shortest cost to d?', dist[u], 'First settled state at d.'); return dist[u]; } for (const [v, w] of g[v0]) { if (dist[u] + w < dist[v * K2 + h]) dist[v * K2 + h] = dist[u] + w; if (h + 1 < K2 && dist[u] < dist[v * K2 + h + 1]) dist[v * K2 + h + 1] = dist[u]; } if (asks++ < 4) { T.at({ graph: GR(I.n, I.edges.map(e => [e[0], e[1]]), { cls: { [v0]: 'hit', [I.d]: 'ok' } }), state: `node ${v0}, hops ${h}` }); T.n(`Settled cost at node ${v0} with ${h} hop(s) used?`, dist[u], 'Smallest tentative state.'); } } }
  });

  D('find-the-closest-marked-node', {
    t: 'Find the Closest Marked Node',
    r: 'Dijkstra from s on the directed graph, then take the smallest distance among marked nodes (−1 if none reachable).',
    g: R => { const n = R.int(2, 6); return { n, edges: R.edges(n, R.int(1, n * 2), { dir: true, w: [1, 9] }), s: 0, marked: R.distinct(R.int(1, n - 1), 1, n - 1) }; },
    s(I, T) { const d = dijkstra(adjW(I.n, I.edges, true), I.s); T.at({ graph: GR(I.n, I.edges.map(e => [e[0], e[1]]), { dir: true, cls: Object.fromEntries(I.marked.map(m => [m, 'ok']).concat([[I.s, 'hit']])) }), dist: A(d.map(x => x === Infinity ? '∞' : x)) }); const best = Math.min(...I.marked.map(m => d[m])); I.marked.slice(0, 3).forEach(m => T.n(`Distance to marked node ${m}? (−1 if unreachable)`, d[m] === Infinity ? -1 : d[m], 'Dijkstra.')); return best === Infinity ? -1 : best; }
  });

  D('minimum-time-takes-to-reach-destination-without-drowning', {
    t: 'Reach Destination Without Drowning',
    r: 'BFS from all flooded cells gives the second each empty cell floods. Then BFS yourself: you may enter a cell at time t only if it floods strictly later (the destination never floods).',
    g: R => { const m = R.int(2, 4), n = R.int(2, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.pick(['.', '.', '.', 'X', '*']))), c = R.shuffle([...Array(m * n).keys()]); g[Math.floor(c[0] / n)][c[0] % n] = 'S'; g[Math.floor(c[1] / n)][c[1] % n] = 'D'; return { land: g }; },
    s(I, T) { const res = (() => { const g = I.land, fl = g.map(r => r.map(() => Infinity)), q = []; let S; g.forEach((row, r) => row.forEach((v, c) => { if (v === '*') { fl[r][c] = 0; q.push([r, c]); } if (v === 'S') S = [r, c]; })); for (let i = 0; i < q.length; i++) { const [r, c] = q[i]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && (g[x][y] === '.' || g[x][y] === 'S') && fl[x][y] === Infinity) { fl[x][y] = fl[r][c] + 1; q.push([x, y]); } } } T.n('Flooded cells at the start?', g.flat().filter(v => v === '*').length, 'The water spreads from these.'); T.at({ land: G(g), floods: G(fl.map(r => r.map(v => v === Infinity ? '∞' : v))) }); T.n('Second when your start cell floods? (−1 if never)', fl[S[0]][S[1]] === Infinity ? -1 : fl[S[0]][S[1]], 'Multi-source BFS from the water.'); const d = g.map(r => r.map(() => -1)), p = [S]; d[S[0]][S[1]] = 0; for (let i = 0; i < p.length; i++) { const [r, c] = p[i]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (!inG(g, x, y) || d[x][y] >= 0 || g[x][y] === 'X' || g[x][y] === '*') continue; const t = d[r][c] + 1; if (g[x][y] === 'D') return t; if (t < fl[x][y]) { d[x][y] = t; p.push([x, y]); } } } return -1; })(); T.n('Fewest seconds (−1 if impossible)?', res, 'Stay ahead of the water.'); return res; }
  });

  D('minimum-edge-weight-equilibrium-queries-in-a-tree', {
    t: 'Edge Weight Equilibrium Queries',
    r: 'Make every edge on the path a–b equal to its most common weight: answer = path length − max frequency. Weights ≤ 26, so prefix counts from the root per weight plus LCA give each count fast.',
    g: R => { const n = R.int(2, 7); return { n, edges: treeEdges(R, n).map(([a, b]) => [a, b, R.int(1, 3)]), queries: Array.from({ length: R.int(1, 3) }, () => [R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const g = adjW(I.n, I.edges), par = Array(I.n).fill(-1), pw = Array(I.n).fill(0), dep = Array(I.n).fill(0), order = [0], seen = new Set([0]); for (let i = 0; i < order.length; i++) for (const [v, w] of g[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; pw[v] = w; dep[v] = dep[order[i]] + 1; order.push(v); } return I.queries.map(([a, b]) => { const c = {}; let len = 0; while (a !== b) { if (dep[a] < dep[b]) [a, b] = [b, a]; c[pw[a]] = (c[pw[a]] || 0) + 1; len++; a = par[a]; } const mx = Math.max(0, ...Object.values(c)); T.at({ graph: GR(I.n, I.edges.map(e => [e[0], e[1]])), weightCounts: K(c) }); T.n('Edges on the path?', len, 'Up to the LCA from both sides.'); return len - mx; }); }
  });

  D('minimum-edge-reversals-so-every-node-is-reachable', {
    t: 'Minimum Edge Reversals From Every Node',
    r: 'Root at 0: count edges pointing toward the root (they must flip). Rerooting from parent p to child c changes only edge p–c: +1 if it pointed p → c, −1 otherwise.',
    g: R => { const n = R.int(2, 7); return { n, edges: treeEdges(R, n).map(([a, b]) => R.chance(0.5) ? [a, b] : [b, a]) }; },
    s(I, T) { const g = Array.from({ length: I.n }, () => []); I.edges.forEach(([a, b]) => { g[a].push([b, 0]); g[b].push([a, 1]); }); const order = [0], par = Array(I.n).fill(-1), cost = Array(I.n).fill(0); let base = 0; const seen = new Set([0]); for (let i = 0; i < order.length; i++) for (const [v, rev] of g[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; cost[v] = rev; base += rev; order.push(v); } T.at({ graph: GR(I.n, I.edges, { dir: true, cls: { 0: 'hit' } }) }); T.n('Reversals needed from node 0?', base, 'Edges pointing toward 0.'); const ans = Array(I.n).fill(0); ans[0] = base; for (const v of order.slice(1)) { ans[v] = ans[par[v]] + (cost[v] ? -1 : 1); if (v < 5) { T.at({ graph: GR(I.n, I.edges, { dir: true, cls: { [v]: 'hit' } }), ans: A(ans) }); T.n(`Reversals from node ${v}?`, ans[v], cost[v] ? 'Edge pointed toward the parent: one fewer.' : 'Edge pointed away from the parent: one more.'); } } return ans; }
  });

  D('count-visited-nodes-in-a-directed-graph', {
    t: 'Count Visited Nodes in a Functional Graph',
    r: 'Nodes on a cycle visit exactly the cycle. Other nodes visit themselves plus everything their successor visits: answer[u] = 1 + answer[edges[u]].',
    g: R => { const n = R.int(2, 7); return { edges: Array.from({ length: n }, (_, i) => { let v = R.int(0, n - 1); if (v === i) v = (i + 1) % n; return v; }) }; },
    s(I, T) { const e = I.edges, n = e.length, ans = Array(n).fill(0); for (let s = 0; s < n; s++) { if (ans[s]) continue; const path = [], pos = new Map(); let u = s; while (!ans[u] && !pos.has(u)) { pos.set(u, path.length); path.push(u); u = e[u]; } if (!ans[u]) { const cyc = path.slice(pos.get(u)); cyc.forEach(x => ans[x] = cyc.length); T.at({ graph: GR(n, e.map((v, i) => [i, v]), { dir: true, cls: Object.fromEntries(cyc.map(x => [x, 'hit'])) }) }); T.n('Length of this cycle?', cyc.length, 'Every node on it visits exactly these.'); path.length = pos.get(u); } for (let i = path.length - 1; i >= 0; i--) ans[path[i]] = 1 + ans[e[path[i]]]; } T.at({ answer: A(ans) }); T.n('Answer for node 0?', ans[0], 'Steps to its cycle plus the cycle length.'); T.n('Largest answer?', Math.max(...ans), 'The longest tail into a cycle.'); return ans; }
  });

  D('find-champion-ii', {
    t: 'Find Champion II',
    r: 'The champion is the unique team with no incoming edge (nobody beats it). If zero or several teams have in-degree 0, return −1.',
    g: R => { const n = R.int(1, 6), p = R.perm(n), e = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.35)) e.push([p[i], p[j]]); return { n, edges: e }; },
    s(I, T) { const res = (() => { const has = Array(I.n).fill(false); I.edges.forEach(([, b]) => has[b] = true); const z = [...Array(I.n).keys()].filter(v => !has[v]); T.at({ graph: GR(I.n, I.edges, { dir: true }) }); T.n('Teams beaten at least once?', I.n - z.length, 'They have an incoming edge.'); T.n('Teams with in-degree 0?', z.length, 'Unbeaten teams.'); return z.length === 1 ? z[0] : -1; })(); T.n('Champion (−1 if none)?', res, 'Only when exactly one team is unbeaten.'); return res; }
  });

  D('number-of-possible-sets-of-closing-branches', {
    t: 'Possible Sets of Closing Branches',
    r: 'n ≤ 10, so try every subset of kept branches. Run Floyd–Warshall using only roads between kept branches and check every pair is within maxDistance.',
    g: R => { const n = R.int(1, 4), e = n > 1 ? R.edges(n, R.int(n - 1, n + 2), { conn: true, w: [1, 9] }) : []; return { n, maxDistance: R.int(1, 12), roads: e }; },
    s(I, T) { const n = I.n; let c = 0, asks = 0; for (let m = 0; m < 1 << n; m++) { const d = Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => i === j ? 0 : Infinity)); for (const [a, b, w] of I.roads) if (m >> a & 1 && m >> b & 1) { d[a][b] = Math.min(d[a][b], w); d[b][a] = Math.min(d[b][a], w); } for (let k = 0; k < n; k++) if (m >> k & 1) for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) d[i][j] = Math.min(d[i][j], d[i][k] + d[k][j]); let ok = true; for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (m >> i & 1 && m >> j & 1 && d[i][j] > I.maxDistance) ok = false; if (asks++ < 5 && m) { T.at({ graph: GR(n, I.roads.map(e => [e[0], e[1]]), { cls: Object.fromEntries([...Array(n).keys()].filter(i => m >> i & 1).map(i => [i, 'hit'])) }), maxDistance: I.maxDistance }); T.yn('Are all kept branches within maxDistance of each other?', ok, 'Floyd on the kept subgraph.'); } if (ok) c++; } return c; }
  });

  D('minimum-cost-to-convert-string-i', {
    t: 'Minimum Cost to Convert String I',
    r: 'Letters are 26 nodes; each (original → changed, cost) is a directed edge. Floyd–Warshall gives the cheapest conversion for every pair; sum them per position (−1 if any is impossible).',
    g: R => { const n = R.int(1, 5), m = R.int(1, 6); return { source: R.str(n, 'abc'), target: R.str(n, 'abc'), original: Array.from({ length: m }, () => R.pick('abc')), changed: Array.from({ length: m }, () => R.pick('abc')), cost: R.ints(m, 1, 9) }; },
    s(I, T) { const res = (() => { const L = 'abcdefghijklmnopqrstuvwxyz', d = Array.from({ length: 26 }, (_, i) => Array.from({ length: 26 }, (_, j) => i === j ? 0 : Infinity)); I.original.forEach((o, i) => { const a = L.indexOf(o), b = L.indexOf(I.changed[i]); d[a][b] = Math.min(d[a][b], I.cost[i]); }); for (let k = 0; k < 26; k++) for (let i = 0; i < 26; i++) for (let j = 0; j < 26; j++) d[i][j] = Math.min(d[i][j], d[i][k] + d[k][j]); let tot = 0; for (let i = 0; i < I.source.length; i++) { const c = d[L.indexOf(I.source[i])][L.indexOf(I.target[i])]; if (i < 5) { T.at({ rules: A(I.original.map((o, j) => `${o} to ${I.changed[j]}, cost ${I.cost[j]}`)) }); T.n(`Cheapest way to turn ${I.source[i]} into ${I.target[i]}? (−1 if impossible)`, c === Infinity ? -1 : c, 'Floyd-Warshall over letters.'); } if (c === Infinity) return -1; tot += c; } return tot; })(); T.n('Minimum total cost (−1 if impossible)?', res, 'Add the cheapest conversion at every position.'); return res; }
  });

  D('count-the-number-of-houses-at-a-certain-distance-i', {
    t: 'Houses at a Certain Distance I',
    r: 'For every ordered pair, distance = min(|i − j|, path through the extra street x–y in either direction). Count pairs per distance.',
    g: R => ({ n: R.int(2, 8), x: R.int(1, 8), y: R.int(1, 8) }),
    exIn: I => I,
    s(I, T) { const J = Object.assign({}, I, { x: Math.min(I.x, I.n), y: Math.min(I.y, I.n) }); return houses(J, T); }
  });

  D('count-the-number-of-houses-at-a-certain-distance-ii', {
    t: 'Houses at a Certain Distance II',
    r: 'With n up to 10⁵ the pairs are counted by difference arrays over the line and the cycle formed by the extra street; the game checks the same counts pair by pair on small n.',
    g: R => ({ n: R.int(2, 9), x: R.int(1, 9), y: R.int(1, 9) }),
    s(I, T) { const J = Object.assign({}, I, { x: Math.min(I.x, I.n), y: Math.min(I.y, I.n) }); return houses(J, T); }
  });

  D('minimum-time-to-visit-disappearing-nodes', {
    t: 'Minimum Time to Visit Disappearing Nodes',
    r: 'Dijkstra from 0, but only accept an arrival at v if it is strictly before disappear[v]. Unreached nodes get −1.',
    g: R => { const n = R.int(1, 5); return { n, edges: n > 1 ? R.edges(n, R.int(0, n + 1), { w: [1, 5] }) : [], disappear: R.ints(n, 1, 10) }; },
    s(I, T) { const g = adjW(I.n, I.edges), d = Array(I.n).fill(Infinity), done = Array(I.n).fill(false); d[0] = 0; let asks = 0; for (;;) { let u = -1; for (let v = 0; v < I.n; v++) if (!done[v] && d[v] < Infinity && (u < 0 || d[v] < d[u])) u = v; if (u < 0) break; done[u] = true; for (const [v, w] of g[u]) { const t = d[u] + w, ok = t < I.disappear[v]; if (t < d[v] && asks++ < 5) { T.at({ graph: GR(I.n, I.edges.map(e => [e[0], e[1]]), { cls: { [u]: 'hit', [v]: 'ok' } }), disappear: A(I.disappear) }); T.yn(`Arriving at ${v} at time ${t}: still there?`, ok, `Must be < ${I.disappear[v]}.`); } if (ok && t < d[v]) d[v] = t; } } if (!asks) { T.at({ disappear: A(I.disappear) }); T.n('Time to be at node 0?', 0, 'Start.'); } T.n('Nodes that cannot be reached in time?', d.filter(x => x === Infinity).length, 'Their answer is −1.'); return d.map(x => x === Infinity ? -1 : x); }
  });

  D('find-edges-in-shortest-paths', {
    t: 'Find Edges in Shortest Paths',
    r: 'Dijkstra from 0 and from n − 1. Edge (a, b, w) lies on some shortest path iff d0[a] + w + dN[b] = d0[n − 1] (or with a and b swapped).',
    g: R => { const n = R.int(2, 6); return { n, edges: R.edges(n, R.int(1, n + 3), { w: [1, 5] }) }; },
    s(I, T) { const g = adjW(I.n, I.edges), d0 = dijkstra(g, 0), dn = dijkstra(g, I.n - 1), best = d0[I.n - 1]; T.at({ graph: GR(I.n, I.edges.map(e => [e[0], e[1]])), from0: A(d0.map(x => x === Infinity ? '∞' : x)), fromLast: A(dn.map(x => x === Infinity ? '∞' : x)) }); T.n(`Shortest distance 0 → ${I.n - 1}? (−1 if unreachable)`, best === Infinity ? -1 : best, 'Dijkstra.'); return I.edges.map(([a, b, w], i) => { const on = best < Infinity && (d0[a] + w + dn[b] === best || d0[b] + w + dn[a] === best); if (i < 4) { T.at({ edge: `${a}–${b} (${w})` }); T.yn(`Is edge ${a}–${b} on a shortest path?`, on, 'd0 + w + dN = best, either direction.'); } return on; }); }
  });

  D('find-minimum-diameter-after-merging-two-trees', {
    t: 'Minimum Diameter After Merging Two Trees',
    r: 'Connect the two tree centers. The new diameter is max(d1, d2, ⌈d1/2⌉ + ⌈d2/2⌉ + 1).',
    g: R => ({ edges1: treeEdges(R, R.int(1, 7)), edges2: treeEdges(R, R.int(1, 7)) }),
    s(I, T) { const res = (() => { const a = diam(I.edges1), b = diam(I.edges2); T.at({ tree1: GR(I.edges1.length + 1, I.edges1), tree2: GR(I.edges2.length + 1, I.edges2) }); T.n('Diameter of tree 1?', a, 'Two BFS passes.'); T.n('Diameter of tree 2?', b, 'Two BFS passes.'); return Math.max(a, b, Math.ceil(a / 2) + Math.ceil(b / 2) + 1); })(); T.n('Minimum diameter after merging?', res, 'Join the two centres, or keep the larger diameter.'); return res; }
  });

  D('time-taken-to-mark-all-nodes', {
    t: 'Time Taken to Mark All Nodes',
    r: 'Entering an odd node costs 1, an even node 2. For root i the answer is the heaviest path from i. Rerooting keeps the top two downward values per node so every root is O(1) after two DFS passes.',
    g: R => ({ edges: treeEdges(R, R.int(2, 8)) }),
    s(I, T) { const n = I.edges.length + 1, g = adjU(n, I.edges), w = v => v % 2 ? 1 : 2; return [...Array(n).keys()].map(r => { const go = (u, p) => { let b = 0; for (const v of g[u]) if (v !== p) b = Math.max(b, w(v) + go(v, u)); return b; }; const t = go(r, -1); if (r < 4) { T.at({ graph: GR(n, I.edges, { cls: { [r]: 'hit' } }) }); T.n(`Time to mark everything starting from ${r}?`, t, 'Heaviest path: odd nodes +1, even nodes +2.'); } return t; }); }
  });

  D('shortest-distance-after-road-addition-queries-i', {
    t: 'Shortest Distance After Road Additions I',
    r: 'After each new road, BFS from city 0 on the directed roads and record the distance to city n − 1.',
    g: R => { const n = R.int(3, 7); return { n, queries: Array.from({ length: R.int(1, 4) }, () => { const u = R.int(0, n - 3); return [u, R.int(u + 2, n - 1)]; }) }; },
    s(I, T) { return addRoad(I, T); }
  });

  D('shortest-distance-after-road-addition-queries-ii', {
    t: 'Shortest Distance After Road Additions II',
    r: 'Shortcuts never cross, so keep the set of cities still on the main chain. A road u → v removes the cities strictly between (if u is still on it); the answer is the chain length − 1.',
    g: R => { const n = R.int(3, 8), q = [], used = []; for (let t = 0; t < R.int(1, 4); t++) { const u = R.int(0, n - 3), v = R.int(u + 2, n - 1); if (used.every(([a, b]) => v <= a || u >= b || (a <= u && v <= b) || (u <= a && b <= v))) { q.push([u, v]); used.push([u, v]); } } if (!q.length) q.push([0, n - 1]); return { n, queries: q }; },
    s(I, T) { return addRoad(I, T); }
  });

  D('find-a-safe-walk-through-a-grid', {
    t: 'Find a Safe Walk Through a Grid',
    r: 'Unsafe cells (1) cost one health. 0-1 BFS for the least damage path from (0, 0) (counting the start cell) to the corner; safe iff health − damage ≥ 1.',
    g: R => { const m = R.int(1, 4), n = R.int(2, 4); return { grid: Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.35) ? 1 : 0)), health: R.int(1, 4) }; },
    s(I, T) { const g = I.grid, d = g.map(r => r.map(() => Infinity)); d[0][0] = g[0][0]; const dq = [[0, 0]]; let asks = 0; while (dq.length) { const [r, c] = dq.shift(); for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (!inG(g, x, y)) continue; const nd = d[r][c] + g[x][y]; if (nd < d[x][y]) { d[x][y] = nd; if (g[x][y]) dq.push([x, y]); else dq.unshift([x, y]); if (asks++ < 4) { T.at({ grid: G(g, { hl: [[x, y]] }) }); T.n(`Least damage to reach (${x}, ${y})?`, nd, g[x][y] ? 'Unsafe: +1.' : 'Safe: +0.'); } } } } const dmg = d[g.length - 1][g[0].length - 1]; T.n('Least damage to the corner?', dmg, '0-1 BFS.'); return I.health - dmg >= 1; }
  });

  D('remove-methods-from-project', {
    t: 'Remove Methods From Project',
    r: 'Mark everything reachable from k as suspicious. If any non-suspicious method invokes a suspicious one, nothing can be removed; otherwise return the non-suspicious methods.',
    g: R => { const n = R.int(2, 6); return { n, k: R.int(0, n - 1), invocations: R.edges(n, R.int(0, n + 1), { dir: true }) }; },
    cmp: 'set',
    s(I, T) { const res = (() => { const out = Array.from({ length: I.n }, () => []); I.invocations.forEach(([a, b]) => out[a].push(b)); const sus = new Set([I.k]), st = [I.k]; while (st.length) for (const v of out[st.pop()]) if (!sus.has(v)) { sus.add(v); st.push(v); } T.at({ graph: GR(I.n, I.invocations, { dir: true, cls: Object.fromEntries([...sus].map(v => [v, 'hit'])) }) }); T.n('Suspicious methods?', sus.size, `Reachable from ${I.k}.`); const leak = I.invocations.some(([a, b]) => !sus.has(a) && sus.has(b)); T.yn('Does a safe method invoke a suspicious one?', leak, leak ? 'Then keep everything.' : 'Safe to remove the group.'); return leak ? [...Array(I.n).keys()] : [...Array(I.n).keys()].filter(v => !sus.has(v)); })(); T.n('Methods left?', res.length, 'All of them if a safe method calls a suspicious one.'); return res; }
  });

  D('construct-2d-grid-matching-graph-layout', {
    t: 'Construct 2D Grid Matching Graph Layout',
    r: 'A degree-1 node means a single row: walk the path. Otherwise start at a corner (degree 2); the nearest other corner ends the first row along a unique shortest path. Each next row is the unique unused neighbor of each cell above.',
    g: R => { const r = R.int(1, 3), c = R.int(2, 4), p = R.perm(r * c), e = []; for (let i = 0; i < r; i++) for (let j = 0; j < c; j++) { if (j + 1 < c) e.push([p[i * c + j], p[i * c + j + 1]]); if (i + 1 < r) e.push([p[i * c + j], p[(i + 1) * c + j]]); } return { n: r * c, edges: R.shuffle(e.map(x => x.sort((a, b) => a - b))) }; },
    cmp: (o, e, I) => { if (!Array.isArray(o) || !o.length) return false; const w = o[0].length; if (!o.every(r => Array.isArray(r) && r.length === w) || o.length * w !== I.n) return false; const pos = {}; o.forEach((row, r) => row.forEach((v, c) => pos[v] = [r, c])); if (Object.keys(pos).length !== I.n) return false; const es = new Set(I.edges.map(([a, b]) => Math.min(a, b) + ',' + Math.max(a, b))); let cnt = 0; for (let r = 0; r < o.length; r++) for (let c = 0; c < w; c++) { if (c + 1 < w) { cnt++; if (!es.has(Math.min(o[r][c], o[r][c + 1]) + ',' + Math.max(o[r][c], o[r][c + 1]))) return false; } if (r + 1 < o.length) { cnt++; if (!es.has(Math.min(o[r][c], o[r + 1][c]) + ',' + Math.max(o[r][c], o[r + 1][c]))) return false; } } return cnt === es.size; },
    s(I, T) { const res = (() => { const g = adjU(I.n, I.edges), deg = g.map(l => l.length), one = deg.indexOf(1); T.at({ graph: GR(I.n, I.edges), degree: A(deg) }); T.yn('Is there a node of degree 1 (single row)?', one >= 0, 'Only row ends have one neighbor.'); if (one >= 0) { const row = [one], seen = new Set([one]); for (;;) { const nx = g[row[row.length - 1]].find(v => !seen.has(v)); if (nx === undefined) break; seen.add(nx); row.push(nx); } return [row]; } const c0 = deg.indexOf(2), d = Array(I.n).fill(-1), par = Array(I.n).fill(-1); d[c0] = 0; const q = [c0]; for (let i = 0; i < q.length; i++) for (const v of g[q[i]]) if (d[v] < 0) { d[v] = d[q[i]] + 1; par[v] = q[i]; q.push(v); } let c1 = -1; for (let v = 0; v < I.n; v++) if (v !== c0 && deg[v] === 2 && (c1 < 0 || d[v] < d[c1])) c1 = v; T.n('Length of the first row?', d[c1] + 1, 'Distance to the nearest other corner, plus 1.'); const row = []; for (let v = c1; v >= 0; v = par[v]) row.unshift(v); const out = [row], used = new Set(row); while (used.size < I.n) { const nx = out[out.length - 1].map(v => g[v].find(u => !used.has(u))); nx.forEach(v => used.add(v)); out.push(nx); } return out; })(); T.n('Rows in the grid?', res.length, 'n divided by the row length.'); return res; }
  });

  D('find-minimum-time-to-reach-last-room-i', {
    t: 'Minimum Time to Reach the Last Room I',
    r: 'Dijkstra on the grid: you may start moving into a room at max(now, moveTime) and arrive 1 second later.',
    g: R => { const m = R.int(2, 3), n = R.int(2, 4), g = Array.from({ length: m }, () => R.ints(n, 0, 8)); g[0][0] = 0; return { moveTime: g }; },
    s(I, T) { return gridDij(I.moveTime, () => 1, T, () => 'Wait until it opens, then +1.'); }
  });

  D('find-minimum-time-to-reach-last-room-ii', {
    t: 'Minimum Time to Reach the Last Room II',
    r: 'Moves alternate 1 and 2 seconds. On a grid that parity is fixed by the cell: leaving (r, c) costs 1 if r + c is even, else 2. Dijkstra with that cost.',
    g: R => { const m = R.int(2, 3), n = R.int(2, 4), g = Array.from({ length: m }, () => R.ints(n, 0, 8)); g[0][0] = 0; return { moveTime: g }; },
    s(I, T) { return gridDij(I.moveTime, (r, c) => (r + c) % 2 + 1, T, (r, c) => `Wait until it opens, then +${(r + c) % 2 + 1}.`); }
  });

  D('digit-operations-to-make-two-integers-equal', {
    t: 'Digit Operations to Make Two Integers Equal',
    r: 'Numbers with the same digit count are nodes; ±1 on one digit is an edge. Never step on a prime. Dijkstra where entering x costs x (the start costs n); −1 if n or m is prime or unreachable.',
    g: R => { const d = R.int(1, 2), lo = d === 1 ? 1 : 10, hi = d === 1 ? 9 : 99; return { n: R.int(lo, hi), m: R.int(lo, hi) }; },
    s(I, T) { T.at({ n: I.n, m: I.m }); T.yn('Is n or m prime?', isPrime(I.n) || isPrime(I.m), 'Then it is impossible.'); if (isPrime(I.n) || isPrime(I.m)) return -1; const L = String(I.n).length, lo = Math.pow(10, L - 1), hi = Math.pow(10, L) - 1, d = new Map([[I.n, I.n]]), done = new Set(); let asks = 0; for (;;) { let u = -1; for (const [k, v] of d) if (!done.has(k) && (u < 0 || v < d.get(u))) u = k; if (u < 0) return -1; done.add(u); if (u === I.m) return d.get(u); const s = String(u).padStart(L, '0'); for (let i = 0; i < L; i++) for (const dd of [-1, 1]) { const nd = +s[i] + dd; if (nd < 0 || nd > 9) continue; const v = +(s.slice(0, i) + nd + s.slice(i + 1)); if (v < lo || v > hi || isPrime(v)) continue; const c = d.get(u) + v; if (!d.has(v) || c < d.get(v)) { d.set(v, c); if (asks++ < 4) { T.at({ from: u, to: v }); T.n(`Cost to reach ${v} via ${u}?`, c, `${d.get(u)} + ${v}.`); } } } } }
  });

  D('minimum-runes-to-add-to-cast-spell', {
    t: 'Minimum Runes to Add',
    r: 'Everything reachable from a crystal is fine. Among the rest, find strongly connected components; each component with no incoming rune from another component needs exactly one new rune.',
    g: R => { const n = R.int(2, 7), e = R.edges(n, R.int(1, n + 2), { dir: true }); return { n, crystals: R.distinct(R.int(1, 2), 0, n - 1), flowFrom: e.map(x => x[0]), flowTo: e.map(x => x[1]) }; },
    s(I, T) { const n = I.n, out = Array.from({ length: n }, () => []), rin = Array.from({ length: n }, () => []); I.flowFrom.forEach((a, i) => { out[a].push(I.flowTo[i]); rin[I.flowTo[i]].push(a); }); const ok = new Set(I.crystals), st = [...I.crystals]; while (st.length) for (const v of out[st.pop()]) if (!ok.has(v)) { ok.add(v); st.push(v); } T.at({ graph: GR(n, I.flowFrom.map((a, i) => [a, I.flowTo[i]]), { dir: true, cls: Object.fromEntries([...ok].map(v => [v, 'ok'])) }) }); T.n('Points already powered?', ok.size, 'Reachable from a crystal.'); const rest = [...Array(n).keys()].filter(v => !ok.has(v)), order = [], seen = new Set(); const dfs1 = u => { seen.add(u); for (const v of out[u]) if (!ok.has(v) && !seen.has(v)) dfs1(v); order.push(u); }; rest.forEach(u => { if (!seen.has(u)) dfs1(u); }); T.n('Points not powered yet?', rest.length, 'Group them into strongly connected parts.'); const comp = new Map(); let c = 0; const dfs2 = (u, id) => { comp.set(u, id); for (const v of rin[u]) if (!ok.has(v) && !comp.has(v)) dfs2(v, id); }; for (const u of order.reverse()) if (!comp.has(u)) dfs2(u, c++); const hasIn = Array(c).fill(false); I.flowFrom.forEach((a, i) => { const b = I.flowTo[i]; if (comp.has(a) && comp.has(b) && comp.get(a) !== comp.get(b)) hasIn[comp.get(b)] = true; }); const k = hasIn.filter(x => !x).length; T.n('Unpowered components with no incoming rune?', k, 'Each needs one rune.'); return k; }
  });

  D('minimum-time-to-break-locks-ii', {
    t: 'Minimum Time to Break Locks II',
    r: 'Breaking lock i as the j-th lock takes ⌈strength[i] / j⌉ minutes: an assignment problem (min-cost matching / flow). For small n, bitmask DP over which locks are broken works too.',
    g: R => ({ strength: R.ints(R.int(1, 5), 1, 12) }),
    s(I, T) { const n = I.strength.length, dp = Array(1 << n).fill(Infinity); dp[0] = 0; let asks = 0; for (let m = 0; m < 1 << n; m++) { if (dp[m] === Infinity) continue; let x = 1; for (let t = m; t; t >>= 1) x += t & 1; for (let i = 0; i < n; i++) if (!(m >> i & 1)) { const c = dp[m] + Math.ceil(I.strength[i] / x); if (c < dp[m | 1 << i]) dp[m | 1 << i] = c; if (asks++ < 4) { T.at({ strength: A(I.strength, { hl: [i] }), factor: x }); T.n(`Minutes to break lock ${i} with factor ${x}?`, Math.ceil(I.strength[i] / x), `⌈${I.strength[i]} / ${x}⌉.`); } } } return dp[(1 << n) - 1]; }
  });

  D('maximize-amount-after-two-days-of-conversions', {
    t: 'Maximize Amount After Two Days of Conversions',
    r: 'Day 1: DFS from the initial currency multiplying rates (reverse edges use 1/rate) to get the best amount of every currency. Day 2: the same DFS gives each currency\'s rate back to the initial one. Answer = max product.',
    g: R => { const cur = ['A', 'B', 'C', 'D'], mk = () => { const p = []; const sh = R.shuffle(cur.slice()); for (let i = 1; i < R.int(2, 4); i++) p.push([sh[R.int(0, i - 1)], sh[i]]); return p; }; const p1 = mk(), p2 = mk(); return { initialCurrency: 'A', pairs1: p1, rates1: p1.map(() => R.int(1, 5)), pairs2: p2, rates2: p2.map(() => R.int(1, 5)) }; },
    cmp: 'float',
    s(I, T) { const res = (() => { const walk = (pairs, rates) => { const g = {}; pairs.forEach(([a, b], i) => { (g[a] = g[a] || []).push([b, rates[i]]); (g[b] = g[b] || []).push([a, 1 / rates[i]]); }); const amt = { [I.initialCurrency]: 1 }, st = [I.initialCurrency]; while (st.length) { const u = st.pop(); for (const [v, r] of g[u] || []) if (!(v in amt)) { amt[v] = amt[u] * r; st.push(v); } } return amt; }; const a1 = walk(I.pairs1, I.rates1), a2 = walk(I.pairs2, I.rates2); T.at({ day1: K(Object.fromEntries(Object.entries(a1).map(([k, v]) => [k, Math.round(v * 1000) / 1000]))) }); T.n('Currencies reachable on day 1 (including the start)?', Object.keys(a1).length, 'DFS over both directions.'); T.n('Currencies reachable on day 2 (including the start)?', Object.keys(a2).length, 'The same DFS on the day 2 pairs.'); let best = 1; for (const c in a1) if (c in a2) best = Math.max(best, a1[c] / a2[c]); return best; })(); T.yn('Is converting better than keeping the starting amount?', res > 1, 'Best over currencies reachable on both days.'); return res; }
  });

  D('minimize-the-maximum-edge-weight-of-graph', {
    t: 'Minimize the Maximum Edge Weight',
    r: 'Reverse the edges: node 0 must reach everyone. A BFS tree uses at most one outgoing edge per node, so the threshold never binds. Binary search the max weight W (or use a Dijkstra on bottleneck weights).',
    g: R => { const n = R.int(2, 5); return { n, edges: R.edges(n, R.int(1, n * 2), { dir: true, w: [1, 9] }), threshold: R.int(1, n - 1) }; },
    s(I, T) { const ok = W => { const g = Array.from({ length: I.n }, () => []); I.edges.forEach(([a, b, w]) => { if (w <= W) g[b].push(a); }); const seen = new Set([0]), st = [0]; while (st.length) for (const v of g[st.pop()]) if (!seen.has(v)) { seen.add(v); st.push(v); } return seen.size === I.n; }; const ws = [...new Set(I.edges.map(e => e[2]))].sort((a, b) => a - b); T.at({ graph: GR(I.n, I.edges.map(e => [e[0], e[1]]), { dir: true }) }); const all = ok(Infinity); T.yn('With every edge allowed, can all nodes reach 0?', all, 'Otherwise −1.'); if (!all) return -1; let lo = 0, hi = ws.length - 1, asks = 0; while (lo < hi) { const mid = (lo + hi) >> 1, v = ok(ws[mid]); if (asks++ < 4) { T.at({ maxWeight: ws[mid] }); T.yn(`Using only weights ≤ ${ws[mid]}, can every node reach 0?`, v, v ? 'hi = mid.' : 'lo = mid + 1.'); } if (v) hi = mid; else lo = mid + 1; } return ws[lo]; }
  });

  D('frequencies-of-shortest-supersequences', {
    t: 'Frequencies of Shortest Supersequences',
    r: 'In a shortest supersequence each letter appears once or twice; a doubled letter can sit at both ends and satisfies all its pairs. Choose the doubled set D: the single letters\' pair constraints must be acyclic. Keep every minimum-size feasible D.',
    g: R => ({ words: [...new Set(Array.from({ length: R.int(1, 5) }, () => R.str(2, 'abcd')))] }),
    cmp: 'set',
    s(I, T) { const res = (() => { const L = [...new Set(I.words.join(''))].sort(), k = L.length, idx = c => L.indexOf(c), must = I.words.filter(w => w[0] === w[1]).reduce((m, w) => m | 1 << idx(w[0]), 0); const ok = D2 => { if ((D2 & must) !== must) return false; const out = Array.from({ length: k }, () => []), indeg = Array(k).fill(0); I.words.forEach(([a, b]) => { const x = idx(a), y = idx(b); if (x !== y && !(D2 >> x & 1) && !(D2 >> y & 1)) { out[x].push(y); indeg[y]++; } }); const q = [...Array(k).keys()].filter(v => !(D2 >> v & 1) && !indeg[v]); let c = 0; for (let i = 0; i < q.length; i++) { c++; for (const v of out[q[i]]) if (!--indeg[v]) q.push(v); } return c === k - [...Array(k).keys()].filter(v => D2 >> v & 1).length; }; let best = Infinity; const res = []; for (let D2 = 0; D2 < 1 << k; D2++) { if (!ok(D2)) continue; const sz = [...Array(k).keys()].filter(v => D2 >> v & 1).length; if (sz < best) { best = sz; res.length = 0; } if (sz === best) res.push(D2); } T.at({ words: A(I.words), letters: A(L) }); T.yn('Can the supersequence use every letter just once?', ok(0), 'Needs acyclic pair constraints and no "xx" word.'); T.n('Letters that must be doubled (minimum)?', best, 'Smallest feasible doubled set.'); return res.map(D2 => { const f = Array(26).fill(0); L.forEach((c, i) => f[c.charCodeAt(0) - 97] = D2 >> i & 1 ? 2 : 1); return f; }); })(); T.n('How many different frequency arrays?', res.length, 'One per smallest doubled set that works.'); return res; }
  });

  D('apply-substitutions', {
    t: 'Apply Substitutions',
    r: 'Resolve each key recursively (DFS with memo): replace every %X% inside its value by the resolved value of X. Then resolve the text the same way.',
    g: R => { const keys = ['A', 'B', 'C', 'D'].slice(0, R.int(1, 4)), rep = keys.map((k, i) => [k, R.str(R.int(1, 3), 'xyz') + (i && R.chance(0.6) ? `%${keys[R.int(0, i - 1)]}%` : '')]); return { replacements: R.shuffle(rep), text: keys.filter(() => R.chance(0.7)).map(k => `%${k}%`).join('_') || `%${keys[0]}%` }; },
    s(I, T) { const map = new Map(I.replacements), memo = new Map(); let asks = 0; const res = k => { if (memo.has(k)) return memo.get(k); const v = map.get(k).replace(/%([A-Z])%/g, (_, x) => res(x)); memo.set(k, v); if (asks++ < 4) { T.at({ key: k, raw: map.get(k) }); T.n(`Length of fully resolved ${k}?`, v.length, 'Replace nested placeholders first.'); } return v; }; const out = I.text.replace(/%([A-Z])%/g, (_, x) => res(x)); if (!asks) T.n('Placeholders?', 0, 'Nothing to resolve.'); return out; }
  });
})();
