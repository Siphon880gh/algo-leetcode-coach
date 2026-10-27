/* v2 games: graphs (02). */
(function () {
  'use strict';
  const { D, A, G, K, Q, GR } = LCGame.H;
  const DIRS = [[0, 1], [1, 0], [0, -1], [-1, 0]];
  const inG = (g, r, c) => r >= 0 && c >= 0 && r < g.length && c < g[0].length;
  const adjU = (n, edges, base) => { const g = Array.from({ length: n + (base || 0) }, () => []); edges.forEach(([a, b]) => { g[a].push(b); g[b].push(a); }); return g; };
  const pop = m => { let c = 0; while (m) { c += m & 1; m >>= 1; } return c; };
  const islandCount = g => { const m = g.length, n = g[0].length, seen = new Set(); let k = 0; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (g[r][c] === 1 && !seen.has(r * n + c)) { k++; const st = [[r, c]]; seen.add(r * n + c); while (st.length) { const [x, y] = st.pop(); for (const [dx, dy] of DIRS) { const a = x + dx, b = y + dy; if (inG(g, a, b) && g[a][b] === 1 && !seen.has(a * n + b)) { seen.add(a * n + b); st.push([a, b]); } } } } return k; };
  const editCost = (I, path) => path.reduce((s, v, i) => s + (I.names[v] !== I.targetPath[i] ? 1 : 0), 0);

  D('escape-a-large-maze', {
    t: 'Escape a Large Maze',
    r: 'B blocked squares can enclose at most B(B − 1) divided by 2 cells. BFS from the source; if it visits more than that (or finds the target) it is not trapped. Do the same from the target.',
    g: R => { const bl = []; for (let i = 0; i < R.int(0, 7); i++) bl.push([R.int(0, 4), R.int(0, 4)]); const u = bl.filter((p, i) => bl.findIndex(q => q[0] === p[0] && q[1] === p[1]) === i); const free = () => { for (;;) { const p = [R.int(0, 4), R.int(0, 4)]; if (!u.some(q => q[0] === p[0] && q[1] === p[1])) return p; } }; const s = free(); let t = free(); while (t[0] === s[0] && t[1] === s[1]) t = free(); return { blocked: u, source: s, target: t }; },
    s(I, T) { const B = new Set(I.blocked.map(p => p.join(','))), L = I.blocked.length * (I.blocked.length - 1) / 2, N = 1e6; const free = (s, t) => { const seen = new Set([s.join(',')]), q = [s]; for (let i = 0; i < q.length; i++) { if (seen.size > L) return true; const [x, y] = q[i]; for (const [dx, dy] of DIRS) { const a = x + dx, b = y + dy, k = a + ',' + b; if (a < 0 || b < 0 || a >= N || b >= N || B.has(k) || seen.has(k)) continue; if (a === t[0] && b === t[1]) return true; seen.add(k); q.push([a, b]); } } return false; }; T.at({ blocked: A(I.blocked.map(p => p.join(','))) }); T.n('Max cells the blocks can enclose?', L, 'B(B − 1) divided by 2, a diagonal wall against a corner.'); const a = free(I.source, I.target); T.yn('Does the source escape (or reach the target)?', a, 'BFS until the area bound is exceeded.'); if (!a) return false; const b = free(I.target, I.source); T.yn('Does the target escape too?', b, 'Both ends must be free.'); return b; }
  });

  D('flower-planting-with-no-adjacent', {
    t: 'Flower Planting With No Adjacent',
    r: 'Each garden has at most 3 neighbors, so among 4 flower types one is always free. Go garden by garden and pick the smallest type no neighbor uses.',
    g: R => { const n = R.int(1, 6), deg = Array(n + 1).fill(0), p = []; for (let a = 1; a <= n; a++) for (let b = a + 1; b <= n; b++) if (R.chance(0.4) && deg[a] < 3 && deg[b] < 3) { p.push([a, b]); deg[a]++; deg[b]++; } return { n, paths: p }; },
    cmp: (o, e, I) => Array.isArray(o) && o.length === I.n && o.every(x => x >= 1 && x <= 4) && I.paths.every(([a, b]) => o[a - 1] !== o[b - 1]),
    s(I, T) { const g = adjU(I.n, I.paths, 1), col = Array(I.n + 1).fill(0); for (let u = 1; u <= I.n; u++) { const used = new Set(g[u].map(v => col[v])); let c = 1; while (used.has(c)) c++; col[u] = c; if (u <= 5) { T.at({ graph: GR([...Array(I.n).keys()].map(x => x + 1), I.paths, { cls: { [u]: 'hit' }, tag: Object.fromEntries(col.slice(1).map((v, i) => [i + 1, v || ''])) }) }); T.n(`Smallest free flower type for garden ${u}?`, c, 'Skip types used by planted neighbors.'); } } return col.slice(1); }
  });

  D('all-paths-from-source-lead-to-destination', {
    t: 'All Paths From Source Lead to Destination',
    r: 'DFS with three colors. Reaching a dead end other than destination fails; reaching a gray (on-stack) node means a cycle, so infinitely many paths: fail. The destination must have no outgoing edges.',
    g: R => { const n = R.int(2, 5); return { n, edges: R.edges(n, R.int(1, n + 1), { dir: true }), source: 0, destination: R.int(0, n - 1) }; },
    s(I, T) { const res = (() => { const out = Array.from({ length: I.n }, () => []); I.edges.forEach(([a, b]) => out[a].push(b)); const st = Array(I.n).fill(0); let asks = 0; T.at({ graph: GR(I.n, I.edges, { dir: true, cls: { [I.source]: 'hit' } }) }); T.n('Edges leaving the source?', out[I.source].length, 'Follow each one.'); const go = u => { if (st[u] === 1) return false; if (st[u] === 2) return true; if (!out[u].length) { const ok = u === I.destination; if (asks++ < 5) { T.at({ graph: GR(I.n, I.edges, { dir: true, cls: { [u]: 'hit', [I.destination]: 'ok' } }) }); T.yn(`Dead end at ${u}: is it the destination?`, ok, ok ? 'Fine.' : 'A path stops elsewhere.'); } return ok; } st[u] = 1; for (const v of out[u]) if (!go(v)) return false; st[u] = 2; return true; }; const r = go(I.source); if (!asks) { T.at({ graph: GR(I.n, I.edges, { dir: true }) }); T.yn('Did the search run into a cycle?', !r, 'A cycle means some path never ends.'); } return r; })(); T.yn('Do all paths from the source lead to the destination?', res, 'No cycles, and every dead end is the destination.'); return res; }
  });

  D('shortest-path-in-binary-matrix', {
    t: 'Shortest Path in Binary Matrix',
    r: 'BFS from (0, 0) over clear cells with 8-directional moves; path length counts cells. −1 if the start or end is blocked or unreachable.',
    g: R => { const n = R.int(1, 5); return { grid: Array.from({ length: n }, () => Array.from({ length: n }, () => R.chance(0.3) ? 1 : 0)) }; },
    s(I, T) { const g = I.grid, n = g.length; T.at({ grid: G(g, { hl: [[0, 0], [n - 1, n - 1]] }) }); T.yn('Are both corners clear?', !g[0][0] && !g[n - 1][n - 1], 'Otherwise −1.'); if (g[0][0] || g[n - 1][n - 1]) return -1; const d = g.map(r => r.map(() => 0)); d[0][0] = 1; const q = [[0, 0]]; for (let i = 0; i < q.length; i++) { const [r, c] = q[i]; if (r === n - 1 && c === n - 1) return d[r][c]; for (let dr = -1; dr <= 1; dr++) for (let dc = -1; dc <= 1; dc++) { const x = r + dr, y = c + dc; if (inG(g, x, y) && !g[x][y] && !d[x][y]) { d[x][y] = d[r][c] + 1; q.push([x, y]); if (q.length < 6) { T.at({ grid: G(d, { hl: [[x, y]] }) }); T.n(`Path length to (${x}, ${y})?`, d[x][y], 'Parent + 1.'); } } } } return -1; }
  });

  D('shortest-path-with-alternating-colors', {
    t: 'Shortest Path With Alternating Colors',
    r: 'BFS over (node, color of the last edge). From a red arrival you may only take blue edges and vice versa. The answer per node is the smaller of its two BFS distances.',
    g: R => { const n = R.int(2, 5), e = () => Array.from({ length: R.int(0, 4) }, () => [R.int(0, n - 1), R.int(0, n - 1)]); return { n, redEdges: e(), blueEdges: e() }; },
    s(I, T) { const n = I.n, adj = [Array.from({ length: n }, () => []), Array.from({ length: n }, () => [])]; I.redEdges.forEach(([a, b]) => adj[0][a].push(b)); I.blueEdges.forEach(([a, b]) => adj[1][a].push(b)); const d = [Array(n).fill(-1), Array(n).fill(-1)]; d[0][0] = d[1][0] = 0; const q = [[0, 0], [0, 1]]; for (let i = 0; i < q.length; i++) { const [u, c] = q[i]; for (const v of adj[1 - c][u]) if (d[1 - c][v] < 0) { d[1 - c][v] = d[c][u] + 1; q.push([v, 1 - c]); if (q.length < 8) { T.at({ red: A(I.redEdges.map(e => e.join('>'))), blue: A(I.blueEdges.map(e => e.join('>'))), node: v }); T.n(`Distance to ${v} arriving by ${1 - c ? 'blue' : 'red'}?`, d[1 - c][v], 'Must alternate from the previous edge color.'); } } } const ans = [...Array(n).keys()].map(v => { const a = d[0][v], b = d[1][v]; return a < 0 ? b : b < 0 ? a : Math.min(a, b); }); if (q.length <= 2) { T.at({ n }); T.n('Nodes reachable besides 0?', 0, 'No edges out of 0.'); } T.n('Nodes with no alternating path?', ans.filter(x => x < 0).length, 'Their answer is −1.'); return ans; }
  });

  D('parallel-courses', {
    t: 'Parallel Courses (Kahn by semesters)',
    r: 'Kahn\'s algorithm level by level: each semester takes every course with no remaining prerequisites. Semesters = number of levels; −1 if a cycle leaves courses untaken.',
    g: R => { const n = R.int(1, 6); return { n, relations: R.edges(n, R.int(0, n + 1), { dir: true }).map(([a, b]) => [a + 1, b + 1]) }; },
    s(I, T) { const res = (() => { const out = Array.from({ length: I.n + 1 }, () => []), indeg = Array(I.n + 1).fill(0); I.relations.forEach(([a, b]) => { out[a].push(b); indeg[b]++; }); let lv = [...Array(I.n).keys()].map(x => x + 1).filter(v => !indeg[v]), sem = 0, taken = 0; while (lv.length) { sem++; taken += lv.length; T.at({ graph: GR([...Array(I.n).keys()].map(x => x + 1), I.relations, { dir: true, cls: Object.fromEntries(lv.map(v => [v, 'hit'])) }) }); T.n(`Courses taken in semester ${sem}?`, lv.length, 'All with zero remaining prerequisites.'); const nx = []; for (const u of lv) for (const v of out[u]) if (!--indeg[v]) nx.push(v); lv = nx; } if (!sem) { T.at({ n: I.n }); T.n('Courses available in semester 1?', 0, 'Every course is on a cycle.'); } return taken === I.n ? sem : -1; })(); T.n('Fewest semesters (−1 if impossible)?', res, 'A cycle leaves some courses untaken.'); return res; }
  });

  D('string-transforms-into-another-string', {
    t: 'String Transforms Into Another String',
    r: 'Each letter of str1 must map to one letter of str2 (a function). If the strings are equal, yes. Otherwise cycles need a spare letter: possible only if str2 uses fewer than 26 distinct letters.',
    g: R => { const s = R.str(R.int(1, 7), 'abc'); return { str1: s, str2: R.chance(0.5) ? [...s].map(c => ({ a: R.pick('abcd'), b: 'c', c: 'a' })[c]).join('') : R.str(s.length, 'abcd') }; },
    s(I, T) { if (I.str1 === I.str2) { T.at({ str1: I.str1, str2: I.str2 }); T.yn('Are the strings already equal?', true, 'Zero conversions.'); return true; } const m = {}; for (let i = 0; i < I.str1.length; i++) { const a = I.str1[i], b = I.str2[i], ok = !(a in m) || m[a] === b; if (i < 6) { T.at({ map: K(m), pair: `${a} to ${b}` }); T.yn(`Is mapping ${a} to ${b} consistent with the mapping so far?`, ok, 'A letter cannot map to two letters.'); } if (!ok) return false; m[a] = b; } return new Set(I.str2).size < 26; }
  });

  D('as-far-from-land-as-possible', {
    t: 'As Far From Land as Possible',
    r: 'Multi-source BFS from all land cells. The last water cell reached has the largest Manhattan distance to land; −1 if there is no land or no water.',
    g: R => { const n = R.int(1, 5); return { grid: Array.from({ length: n }, () => Array.from({ length: n }, () => R.chance(0.25) ? 1 : 0)) }; },
    s(I, T) { const res = (() => { const g = I.grid, d = g.map(r => r.map(v => v ? 0 : -1)), q = []; g.forEach((row, r) => row.forEach((v, c) => { if (v) q.push([r, c]); })); T.at({ grid: G(g) }); T.n('Land cells (BFS sources)?', q.length, 'All start at distance 0.'); T.n('Water cells?', g.length * g.length - q.length, 'If there are none, or no land, the answer is −1.'); if (!q.length || q.length === g.length * g.length) return -1; let best = 0; for (let i = 0; i < q.length; i++) { const [r, c] = q[i]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && d[x][y] < 0) { d[x][y] = d[r][c] + 1; best = Math.max(best, d[x][y]); q.push([x, y]); } } } T.at({ dist: G(d) }); T.n('Largest distance found?', best, 'Last BFS layer.'); return best; })(); T.n('Largest distance (−1 if none)?', res, 'Distance of the water cell farthest from land.'); return res; }
  });

  D('critical-connections-in-a-network', {
    t: 'Critical Connections (Tarjan bridges)',
    r: 'DFS assigning discovery times; low[u] = earliest time reachable from u\'s subtree with one back edge. Edge u to v (v a child) is a bridge exactly when low[v] > disc[u].',
    g: R => { const n = R.int(2, 6); return { n, connections: R.edges(n, R.int(n - 1, n + 2), { conn: true }) }; },
    cmp: (o, e) => Array.isArray(o) && JSON.stringify(o.map(p => p.slice().sort((a, b) => a - b)).sort()) === JSON.stringify(e.map(p => p.slice().sort((a, b) => a - b)).sort()),
    s(I, T) { const g = adjU(I.n, I.connections), disc = Array(I.n).fill(-1), low = Array(I.n).fill(0), out = []; let t = 0, asks = 0; const dfs = (u, p) => { disc[u] = low[u] = t++; for (const v of g[u]) { if (v === p) continue; if (disc[v] < 0) { dfs(v, u); low[u] = Math.min(low[u], low[v]); const br = low[v] > disc[u]; if (asks++ < 6) { T.at({ graph: GR(I.n, I.connections, { cls: { [u]: 'hit', [v]: 'ok' } }), disc: A(disc), low: A(low) }); T.yn(`Is ${u} to ${v} a bridge?`, br, `low[${v}] = ${low[v]} vs disc[${u}] = ${disc[u]}.`); } if (br) out.push([u, v]); } else low[u] = Math.min(low[u], disc[v]); } }; dfs(0, -1); return out; }
  });

  D('minimum-knight-moves', {
    t: 'Minimum Knight Moves',
    r: 'By symmetry work with |x|, |y|. BFS from (0, 0) over knight moves (allowing a small margin past the axes) until reaching the target.',
    g: R => ({ x: R.int(-6, 6), y: R.int(-6, 6) }),
    s(I, T) { const res = (() => { const tx = Math.abs(I.x), ty = Math.abs(I.y), mv = [[1, 2], [2, 1], [-1, 2], [-2, 1], [1, -2], [2, -1], [-1, -2], [-2, -1]], seen = new Set(['0,0']); let lv = [[0, 0]], d = 0; T.at({ target: `${tx},${ty}` }); T.n('Squares a knight reaches in one move from (0,0)?', 8, 'All 8 L-shapes.'); T.n('Distance |x| + |y|?', tx + ty, 'Each move covers at most 3 of it.'); for (;;) { if (lv.some(([a, b]) => a === tx && b === ty)) return d; const nx = []; for (const [a, b] of lv) for (const [dx, dy] of mv) { const x = a + dx, y = b + dy, k = x + ',' + y; if (x < -2 || y < -2 || x > tx + 2 || y > ty + 2 || seen.has(k)) continue; seen.add(k); nx.push([x, y]); } lv = nx; d++; } })(); T.n('Fewest moves?', res, 'The BFS level where the target appears.'); return res; }
  });

  D('sort-items-by-groups-respecting-dependencies', {
    t: 'Sort Items by Groups Respecting Dependencies',
    r: 'Give ungrouped items their own new group. Topologically sort the groups (edges from cross-group dependencies), and topologically sort items within each group; any cycle means [].',
    g: R => { const n = R.int(2, 6), m = R.int(1, 2), group = Array.from({ length: n }, () => R.int(-1, m - 1)), bf = Array.from({ length: n }, () => []); for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (i !== j && R.chance(0.15)) bf[i].push(j); return { n, m, group, beforeItems: bf }; },
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && !o.length; if (!Array.isArray(o) || o.length !== I.n || new Set(o).size !== I.n) return false; const pos = []; o.forEach((x, i) => pos[x] = i); if (!I.beforeItems.every((l, i) => l.every(j => pos[j] < pos[i]))) return false; const g = {}; o.forEach((x, i) => { if (I.group[x] >= 0) (g[I.group[x]] = g[I.group[x]] || []).push(i); }); return Object.values(g).every(p => p[p.length - 1] - p[0] === p.length - 1); },
    s(I, T) { const res = (() => { const n = I.n, grp = I.group.slice(); let m = I.m; for (let i = 0; i < n; i++) if (grp[i] < 0) grp[i] = m++; const topo = (nodes, edges) => { const indeg = new Map(nodes.map(x => [x, 0])), out = new Map(nodes.map(x => [x, []])); edges.forEach(([a, b]) => { out.get(a).push(b); indeg.set(b, indeg.get(b) + 1); }); const q = nodes.filter(x => !indeg.get(x)), r = []; while (q.length) { const u = q.shift(); r.push(u); for (const v of out.get(u)) { indeg.set(v, indeg.get(v) - 1); if (!indeg.get(v)) q.push(v); } } return r.length === nodes.length ? r : null; }; const ge = [], ie = {}; I.beforeItems.forEach((l, i) => l.forEach(j => { if (grp[j] !== grp[i]) ge.push([grp[j], grp[i]]); else (ie[grp[i]] = ie[grp[i]] || []).push([j, i]); })); T.at({ groups: A(grp), crossEdges: A(ge.map(e => e.join('>'))) }); T.n('How many groups after giving loners their own?', m, 'Each −1 item gets a fresh group.'); const go = topo([...Array(m).keys()], ge); T.yn('Can the groups be ordered (no cycle)?', !!go, 'Topological sort of groups.'); if (!go) return []; const res = []; for (const gi of go) { const items = [...Array(n).keys()].filter(i => grp[i] === gi), o = topo(items, ie[gi] || []); if (!o) return []; res.push(...o); } return res; })(); T.n('Items in the answer (0 if impossible)?', res.length, 'All n items, or none.'); return res; }
  });

  D('minimum-moves-to-reach-target-with-rotations', {
    t: 'Snake Moves With Rotations',
    r: 'BFS over (row, col of tail, orientation). Moves: right, down, rotate clockwise (horizontal, both cells below free) or counter-clockwise (vertical, both cells to the right free).',
    g: R => { const n = R.int(2, 5), g = Array.from({ length: n }, () => Array.from({ length: n }, () => R.chance(0.2) ? 1 : 0)); g[0][0] = g[0][1] = 0; return { grid: g }; },
    s(I, T) { const g = I.grid, n = g.length, ok = (r, c) => r < n && c < n && !g[r][c], seen = new Set(['0,0,0']); let lv = [[0, 0, 0]], d = 0, asks = 0; while (lv.length) { const nx = []; for (const [r, c, v] of lv) { if (r === n - 1 && c === n - 2 && v === 0) return d; const cand = []; if (v === 0) { if (ok(r, c + 2)) cand.push([r, c + 1, 0]); if (ok(r + 1, c) && ok(r + 1, c + 1)) { cand.push([r + 1, c, 0]); cand.push([r, c, 1]); } } else { if (ok(r + 2, c)) cand.push([r + 1, c, 1]); if (ok(r, c + 1) && ok(r + 1, c + 1)) { cand.push([r, c + 1, 1]); cand.push([r, c, 0]); } } for (const s of cand) if (!seen.has(s.join(','))) { seen.add(s.join(',')); nx.push(s); } } if (asks++ < 4) { T.at({ grid: G(g, { hl: lv.flatMap(([r, c, v]) => [[r, c], v ? [r + 1, c] : [r, c + 1]]) }) }); T.n(`New snake positions after move ${d + 1}?`, nx.length, 'Right, down, or rotate.'); } lv = nx; d++; } return -1; }
  });

  D('stepping-numbers', {
    t: 'Stepping Numbers (BFS on digits)',
    r: 'BFS from digits 1 to 9 (plus 0 alone): from x append last digit ± 1. Keep numbers within [low, high]; stop extending past high. Sort the result.',
    g: R => { const a = R.int(0, 120); return { low: a, high: a + R.int(0, 120) }; },
    s(I, T) { const res = (() => { const out = []; if (I.low === 0) out.push(0); const q = [1, 2, 3, 4, 5, 6, 7, 8, 9]; for (let i = 0; i < q.length; i++) { const x = q[i]; if (x > I.high) continue; if (x >= I.low) out.push(x); const d = x % 10; for (const e of [d - 1, d + 1]) if (e >= 0 && e <= 9) q.push(x * 10 + e); } T.at({ low: I.low, high: I.high }); T.n('Two-digit stepping numbers starting with 1?', 2, '10 and 12.'); T.n('How many stepping numbers in range?', out.length, 'BFS result count.'); return out.sort((a, b) => a - b); })(); T.n('Smallest stepping number in range (−1 if none)?', res.length ? res[0] : -1, 'The result is sorted.'); return res; }
  });

  D('web-crawler', {
    t: 'Web Crawler (BFS on links)',
    r: 'BFS from startUrl; for each page, follow its links whose hostname equals the start\'s hostname and that were not seen yet. Return everything visited.',
    g: R => { const hosts = ['a.com', 'b.com'], urls = [...new Set(Array.from({ length: R.int(2, 6) }, () => `http://${R.pick(hosts)}/${R.str(1, 'xyz')}`))]; return { urls, edges: Array.from({ length: R.int(1, 6) }, () => [R.int(0, urls.length - 1), R.int(0, urls.length - 1)]).filter(e => e[0] !== e[1]), startUrl: urls[0] }; },
    cmp: 'set',
    exIn: I => { if (!I.urls || !I.urls.__raw) return I; const raw = I.urls.__raw, [u, rest] = raw.split(' edges = '), [e, st] = rest.split(' startUrl = '); return { urls: JSON.parse(u), edges: JSON.parse(e), startUrl: JSON.parse(st) }; },
    s(I, T) { const res = (() => { const host = u => u.split('/')[2], h = host(I.startUrl), links = {}; I.edges.forEach(([a, b]) => (links[I.urls[a]] = links[I.urls[a]] || []).push(I.urls[b])); const seen = new Set([I.startUrl]), q = [I.startUrl]; for (let i = 0; i < q.length; i++) { const u = q[i], nx = (links[u] || []).filter(v => host(v) === h && !seen.has(v)); if (i < 5) { T.at({ page: u, links: A(links[u] || []) }); T.n('New same-host links on this page?', nx.length, `Hostname must be ${h}.`); } nx.forEach(v => { seen.add(v); q.push(v); }); } return q; })(); T.n('Pages crawled?', res.length, 'Every same-host page reached.'); return res; }
  });

  D('tree-diameter', {
    t: 'Tree Diameter (two BFS passes)',
    r: 'BFS from any node to the farthest node A; BFS from A to the farthest node B. The distance A to B is the diameter.',
    g: R => { const n = R.int(1, 8); return { edges: Array.from({ length: n - 1 }, (_, i) => [R.int(0, i), i + 1]) }; },
    s(I, T) { const res = (() => { const n = I.edges.length + 1, g = adjU(n, I.edges), far = s => { const d = Array(n).fill(-1); d[s] = 0; const q = [s]; for (let i = 0; i < q.length; i++) for (const v of g[q[i]]) if (d[v] < 0) { d[v] = d[q[i]] + 1; q.push(v); } const x = q[q.length - 1]; return [x, d[x]]; }; const [a] = far(0), [b, dd] = far(a); T.at({ graph: GR(n, I.edges, { cls: { 0: 'hit' } }) }); T.n('Nodes in the tree?', n, 'One more than the edges.'); T.n('Farthest node from 0 (last in BFS order)?', a, 'One end of a diameter.'); T.at({ graph: GR(n, I.edges, { cls: { [a]: 'hit', [b]: 'ok' } }) }); return dd; })(); T.n('Diameter?', res, 'The farthest distance from that end.'); return res; }
  });

  D('minimum-moves-to-move-a-box-to-their-target-location', {
    t: 'Storekeeper: Minimum Box Pushes',
    r: 'BFS over (box, player) states counting pushes. From a state, find cells the player can walk to (not through the box); a push in direction d needs the player behind the box and a free cell in front.',
    g: R => { const m = R.int(3, 5), n = R.int(3, 5), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.2) ? '#' : '.')), cells = R.shuffle([...Array(m * n).keys()]); ['S', 'B', 'T'].forEach((ch, i) => g[Math.floor(cells[i] / n)][cells[i] % n] = ch); return { grid: g }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; let S, B, Tg; g.forEach((row, r) => row.forEach((ch, c) => { if (ch === 'S') S = [r, c]; if (ch === 'B') B = [r, c]; if (ch === 'T') Tg = [r, c]; })); const free = (r, c) => inG(g, r, c) && g[r][c] !== '#'; const reach = (p, b) => { const seen = new Set([p.join(',')]), q = [p]; for (let i = 0; i < q.length; i++) for (const [dr, dc] of DIRS) { const x = q[i][0] + dr, y = q[i][1] + dc, k = x + ',' + y; if (free(x, y) && !(x === b[0] && y === b[1]) && !seen.has(k)) { seen.add(k); q.push([x, y]); } } return seen; }; const seen = new Set([B + '|' + S]); let lv = [[B, S]], d = 0, asks = 0; while (lv.length) { const nx = []; for (const [b, p] of lv) { if (b[0] === Tg[0] && b[1] === Tg[1]) return d; const rc = reach(p, b); for (const [dr, dc] of DIRS) { const behind = [b[0] - dr, b[1] - dc], front = [b[0] + dr, b[1] + dc]; if (rc.has(behind.join(',')) && free(...front)) { const k = front + '|' + b; if (!seen.has(k)) { seen.add(k); nx.push([front, b]); } } } if (asks++ < 4) { T.at({ grid: G(g, { hl: [b, p] }) }); T.n('How many cells can the player walk to here?', rc.size, 'BFS that treats the box as a wall.'); } } lv = nx; d++; } return -1; }
  });

  D('find-the-city-with-the-smallest-number-of-neighbors-at-a-threshold-distance', {
    t: 'City With the Fewest Neighbors Within Threshold',
    r: 'All-pairs shortest paths (Floyd-Warshall). For each city count others within the threshold; pick the smallest count, breaking ties by the larger city number.',
    g: R => { const n = R.int(2, 5); return { n, edges: R.edges(n, R.int(1, n + 2), { w: [1, 6] }), distanceThreshold: R.int(1, 8) }; },
    s(I, T) { const n = I.n, d = Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => i === j ? 0 : Infinity)); I.edges.forEach(([a, b, w]) => { d[a][b] = Math.min(d[a][b], w); d[b][a] = Math.min(d[b][a], w); }); for (let k = 0; k < n; k++) for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) d[i][j] = Math.min(d[i][j], d[i][k] + d[k][j]); let best = -1, bc = Infinity; for (let i = 0; i < n; i++) { const c = d[i].filter((x, j) => j !== i && x <= I.distanceThreshold).length; if (i < 5) { T.at({ dist: G(d.map(r => r.map(x => x === Infinity ? '∞' : x)), { hl: [[i, i]] }) }); T.n(`Cities within ${I.distanceThreshold} of city ${i}?`, c, 'Row of the Floyd matrix.'); } if (c <= bc) { bc = c; best = i; } } return best; }
  });

  D('validate-binary-tree-nodes', {
    t: 'Validate Binary Tree Nodes',
    r: 'Every node except one root must have exactly one parent. Find the root (in-degree 0), then BFS from it: valid exactly when all n nodes are reached with no node seen twice.',
    g: R => { const n = R.int(1, 6), l = Array(n).fill(-1), r = Array(n).fill(-1); for (let i = 0; i < n; i++) { if (R.chance(0.4)) l[i] = R.int(0, n - 1); if (R.chance(0.4)) r[i] = R.int(0, n - 1); } if (R.chance(0.5)) { l.fill(-1); r.fill(-1); const p = R.perm(n); for (let i = 1; i < n; i++) { const par = p[R.int(0, i - 1)]; if (l[par] < 0) l[par] = p[i]; else if (r[par] < 0) r[par] = p[i]; else { l.fill(-1); r.fill(-1); break; } } } return { n, leftChild: l, rightChild: r }; },
    s(I, T) { const res = (() => { const n = I.n, indeg = Array(n).fill(0); [...I.leftChild, ...I.rightChild].forEach(c => { if (c >= 0) indeg[c]++; }); const roots = [...Array(n).keys()].filter(i => !indeg[i]); T.at({ indegree: A(indeg) }); T.n('How many nodes have no parent?', roots.length, 'Exactly one must.'); if (roots.length !== 1 || indeg.some(x => x > 1)) return false; const seen = new Set([roots[0]]), q = [roots[0]]; for (let i = 0; i < q.length; i++) for (const c of [I.leftChild[q[i]], I.rightChild[q[i]]]) if (c >= 0) { if (seen.has(c)) return false; seen.add(c); q.push(c); } T.n('Nodes reached from the root?', seen.size, 'BFS.'); return seen.size === n; })(); T.yn('Do the nodes form exactly one valid binary tree?', res, 'One root, no node with two parents, and every node reached.'); return res; }
  });

  D('minimum-cost-to-make-at-least-one-valid-path-in-a-grid', {
    t: 'Min Cost to Make a Valid Path (0-1 BFS)',
    r: 'Following a cell\'s sign costs 0; going any other way costs 1 (changing the sign). 0-1 BFS with a deque gives the cheapest cost to the bottom-right.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { grid: Array.from({ length: m }, () => R.ints(n, 1, 4)) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, mv = [null, [0, 1], [0, -1], [1, 0], [-1, 0]], d = g.map(r => r.map(() => Infinity)); d[0][0] = 0; const dq = [[0, 0]]; let asks = 0; while (dq.length) { const [r, c] = dq.shift(); for (let k = 1; k <= 4; k++) { const x = r + mv[k][0], y = c + mv[k][1]; if (!inG(g, x, y)) continue; const w = g[r][c] === k ? 0 : 1; if (d[r][c] + w < d[x][y]) { d[x][y] = d[r][c] + w; if (w) dq.push([x, y]); else dq.unshift([x, y]); if (asks++ < 5) { T.at({ signs: G(g.map(row => row.map(v => '→←↓↑'[v - 1])), { hl: [[r, c], [x, y]] }) }); T.n(`Cost to reach (${x}, ${y}) from (${r}, ${c})?`, d[x][y], w ? 'Against the sign: +1.' : 'Follows the sign: +0.'); } } } } if (!asks) { T.at({ grid: G(g) }); T.n('Cost for a 1 by 1 grid?', 0, 'Already there.'); } return d[m - 1][n - 1]; }
  });

  D('course-schedule-iv', {
    t: 'Course Schedule IV',
    r: 'Compute reachability: process courses in topological order, and each course\'s prerequisite set includes its direct prerequisites and their sets. Answer each query by lookup.',
    g: R => { const n = R.int(2, 5), p = R.perm(n), e = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.3)) e.push([p[i], p[j]]); return { numCourses: n, prerequisites: e, queries: Array.from({ length: R.int(1, 3) }, () => { const a = R.int(0, n - 1); let b = R.int(0, n - 1); if (b === a) b = (a + 1) % n; return [a, b]; }) }; },
    s(I, T) { const n = I.numCourses, reach = Array.from({ length: n }, () => Array(n).fill(false)); I.prerequisites.forEach(([a, b]) => reach[a][b] = true); for (let k = 0; k < n; k++) for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (reach[i][k] && reach[k][j]) reach[i][j] = true; return I.queries.map(([a, b]) => { T.at({ graph: GR(n, I.prerequisites, { dir: true, cls: { [a]: 'hit', [b]: 'ok' } }) }); T.yn(`Is ${a} a prerequisite of ${b}?`, reach[a][b], 'Path from a to b.'); return reach[a][b]; }); }
  });

  D('reorder-routes-to-make-all-paths-lead-to-the-city-zero', {
    t: 'Reorder Routes to Lead to City Zero',
    r: 'Treat roads as undirected but remember direction. DFS from 0: every road traversed in its original direction (away from 0) must be flipped.',
    g: R => { const n = R.int(2, 7); return { n, connections: Array.from({ length: n - 1 }, (_, i) => R.chance(0.5) ? [R.int(0, i), i + 1] : [i + 1, R.int(0, i)]) }; },
    s(I, T) { const g = Array.from({ length: I.n }, () => []); I.connections.forEach(([a, b]) => { g[a].push([b, 1]); g[b].push([a, 0]); }); let c = 0, asks = 0; const st = [0], seen = new Set([0]); while (st.length) { const u = st.pop(); for (const [v, away] of g[u]) if (!seen.has(v)) { seen.add(v); if (asks++ < 6) { T.at({ graph: GR(I.n, I.connections, { dir: true, cls: { [u]: 'hit', [v]: 'ok' } }) }); T.yn(`Must the road between ${u} and ${v} be flipped?`, !!away, away ? 'It points away from 0.' : 'Already points toward 0.'); } c += away; st.push(v); } } return c; }
  });

  D('parallel-courses-ii', {
    t: 'Parallel Courses II (bitmask DP)',
    r: 'dp[mask] = fewest semesters to finish the courses in mask. From mask, the available courses have all prerequisites in mask; take all if at most k, otherwise try every subset of exactly k.',
    g: R => { const n = R.int(1, 6), p = R.perm(n), rel = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.25)) rel.push([p[i] + 1, p[j] + 1]); return { n, relations: rel, k: R.int(1, 3) }; },
    s(I, T) { const n = I.n, pre = Array(n).fill(0); I.relations.forEach(([a, b]) => pre[b - 1] |= 1 << (a - 1)); const full = (1 << n) - 1, dp = Array(1 << n).fill(Infinity); dp[0] = 0; let asks = 0; for (let m = 0; m <= full; m++) { if (dp[m] === Infinity) continue; let av = 0; for (let i = 0; i < n; i++) if (!(m >> i & 1) && (pre[i] & m) === pre[i]) av |= 1 << i; if (!av) continue; if (asks++ < 4) { T.at({ taken: m.toString(2).padStart(n, '0'), semesters: dp[m] }); T.n('How many courses are available now?', pop(av), 'Not taken, all prerequisites done.'); } if (pop(av) <= I.k) dp[m | av] = Math.min(dp[m | av], dp[m] + 1); else for (let s = av; s; s = (s - 1) & av) if (pop(s) === I.k) dp[m | s] = Math.min(dp[m | s], dp[m] + 1); } return dp[full]; }
  });

  D('path-with-maximum-probability', {
    t: 'Path With Maximum Probability',
    r: 'Dijkstra with a max-heap: probabilities multiply along a path and never increase, so the best probability to settle next is the largest. 0 if the end is unreachable.',
    g: R => { const n = R.int(2, 5), e = R.edges(n, R.int(1, n + 1)); return { n, edges: e, succProb: e.map(() => R.pick([0.1, 0.2, 0.25, 0.5, 0.8, 1])), start: 0, end: R.int(1, n - 1) }; },
    cmp: 'float',
    s(I, T) { const n = I.n, p = Array(n).fill(0), done = Array(n).fill(false); p[I.start] = 1; for (let it = 0; it < n; it++) { let u = -1; for (let v = 0; v < n; v++) if (!done[v] && p[v] > 0 && (u < 0 || p[v] > p[u])) u = v; if (u < 0) break; done[u] = true; if (u === I.end) break; I.edges.forEach(([a, b], i) => { const v = a === u ? b : b === u ? a : -1; if (v >= 0 && p[u] * I.succProb[i] > p[v]) p[v] = p[u] * I.succProb[i]; }); if (it < 4) { T.at({ graph: GR(n, I.edges, { cls: { [u]: 'hit' } }), prob: A(p.map(x => Math.round(x * 1e4) / 1e4)) }); T.n(`Best probability now known for node ${I.end} ( times 100, rounded)?`, Math.round(p[I.end] * 100), 'Relaxed from settled nodes.'); } } return p[I.end]; }
  });

  D('the-most-similar-path-in-a-graph', {
    t: 'The Most Similar Path in a Graph',
    r: 'dp[i][v] = min edit cost of a path matching targetPath[0 to i] ending at city v = (name mismatch) + min dp[i − 1][u] over neighbors u. Reconstruct with parent pointers.',
    g: R => { const n = R.int(2, 5), nm = ['ATL', 'PEK', 'LAX']; return { n, roads: R.edges(n, R.int(n - 1, n + 1), { conn: true }), names: Array.from({ length: n }, () => R.pick(nm)), targetPath: Array.from({ length: R.int(1, 5) }, () => R.pick(nm)) }; },
    cmp: (o, e, I) => Array.isArray(o) && o.length === I.targetPath.length && o.every(v => v >= 0 && v < I.n) && o.every((v, i) => !i || I.roads.some(([a, b]) => (a === v && b === o[i - 1]) || (b === v && a === o[i - 1]))) && editCost(I, o) === editCost(I, e),
    s(I, T) { const n = I.n, L = I.targetPath.length, g = adjU(n, I.roads), dp = [I.names.map(x => x !== I.targetPath[0] ? 1 : 0)], par = [Array(n).fill(-1)]; for (let i = 1; i < L; i++) { const row = [], pr = []; for (let v = 0; v < n; v++) { let b = -1; for (const u of g[v]) if (b < 0 || dp[i - 1][u] < dp[i - 1][b]) b = u; row.push(dp[i - 1][b] + (I.names[v] !== I.targetPath[i] ? 1 : 0)); pr.push(b); } dp.push(row); par.push(pr); if (i < 4) { T.at({ names: A(I.names), target: I.targetPath[i], dp: A(row) }); T.n(`Min cost so far after step ${i}?`, Math.min(...row), 'Best neighbor + mismatch.'); } } let v = dp[L - 1].indexOf(Math.min(...dp[L - 1])); if (L === 1) { T.at({ names: A(I.names), target: I.targetPath[0] }); T.n('Minimum edit cost?', dp[0][v], 'Any city with the right name costs 0.'); } const path = [v]; for (let i = L - 1; i > 0; i--) { v = par[i][v]; path.unshift(v); } return path; }
  });

  D('minimum-number-of-vertices-to-reach-all-nodes', {
    t: 'Minimum Vertices to Reach All Nodes',
    r: 'In a DAG, a node with no incoming edge cannot be reached from anywhere else, so it must be chosen; and those sources reach everything. Answer = in-degree-0 nodes.',
    g: R => { const n = R.int(2, 7), p = R.perm(n), e = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.3)) e.push([p[i], p[j]]); return { n, edges: e }; },
    cmp: 'set',
    s(I, T) { const has = Array(I.n).fill(false); I.edges.forEach(([, b]) => has[b] = true); const r = [...Array(I.n).keys()].filter(v => !has[v]); T.at({ graph: GR(I.n, I.edges, { dir: true }) }); T.n('How many nodes have in-degree 0?', r.length, 'They must be picked.'); T.n('Nodes with at least one incoming edge?', I.n - r.length, 'Something else can reach them.'); T.yn('Is node 0 one of the picked nodes?', !has[0], 'Only if nothing points to it.'); return r; }
  });

  D('minimum-number-of-days-to-disconnect-island', {
    t: 'Minimum Days to Disconnect Island',
    r: 'The answer is at most 2 (cut off a corner cell). 0 if the grid is already not exactly one island; 1 if removing some single land cell disconnects it (articulation point, or try each); else 2.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { grid: Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.65) ? 1 : 0)) }; },
    s(I, T) { const g = I.grid.map(r => r.slice()), k = islandCount(g); T.at({ grid: G(g) }); T.n('Islands right now?', k, 'Flood fill.'); if (k !== 1) return 0; let asks = 0; for (let r = 0; r < g.length; r++) for (let c = 0; c < g[0].length; c++) if (g[r][c]) { g[r][c] = 0; const k2 = islandCount(g); g[r][c] = 1; if (asks++ < 4) { T.at({ grid: G(g, { hl: [[r, c]] }) }); T.yn(`Does removing (${r}, ${c}) disconnect it?`, k2 !== 1, 'Count islands without it.'); } if (k2 !== 1) return 1; } return 2; }
  });

  D('min-cost-to-connect-all-points', {
    t: 'Min Cost to Connect All Points (Prim)',
    r: 'Complete graph with Manhattan distances. Prim: keep the cheapest connection cost to the tree for each point; repeatedly add the cheapest outside point.',
    g: R => ({ points: Array.from({ length: R.int(1, 6) }, () => [R.int(-6, 6), R.int(-6, 6)]).filter((p, i, a) => a.findIndex(q => q[0] === p[0] && q[1] === p[1]) === i) }),
    s(I, T) { const p = I.points, n = p.length, d = Array(n).fill(Infinity), inT = Array(n).fill(false); d[0] = 0; let tot = 0; for (let it = 0; it < n; it++) { let u = -1; for (let v = 0; v < n; v++) if (!inT[v] && (u < 0 || d[v] < d[u])) u = v; inT[u] = true; tot += d[u]; T.at({ points: A(p.map(q => q.join(','))), cost: A(d.map(x => x === Infinity ? '∞' : x)) }); T.n(`Cost to attach point ${u}?`, d[u], 'Cheapest edge to the tree.'); for (let v = 0; v < n; v++) if (!inT[v]) d[v] = Math.min(d[v], Math.abs(p[u][0] - p[v][0]) + Math.abs(p[u][1] - p[v][1])); } return tot; }
  });

  D('strange-printer-ii', {
    t: 'Strange Printer II',
    r: 'Each color must be printed as its bounding rectangle. Any other color inside that rectangle must be printed later: an edge. The grid is printable exactly when these edges have no cycle.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), g = Array.from({ length: m }, () => Array(n).fill(1)); for (let c = 2; c <= R.int(2, 4); c++) { const r1 = R.int(0, m - 1), r2 = R.int(r1, m - 1), c1 = R.int(0, n - 1), c2 = R.int(c1, n - 1); for (let r = r1; r <= r2; r++) for (let k = c1; k <= c2; k++) g[r][k] = c; } if (R.chance(0.3)) g[R.int(0, m - 1)][R.int(0, n - 1)] = R.int(1, 4); return { targetGrid: g }; },
    s(I, T) { const g = I.targetGrid, box = {}; g.forEach((row, r) => row.forEach((v, c) => { const b = box[v] = box[v] || [r, r, c, c]; b[0] = Math.min(b[0], r); b[1] = Math.max(b[1], r); b[2] = Math.min(b[2], c); b[3] = Math.max(b[3], c); })); const out = {}; for (const v in box) { out[v] = new Set(); const [r1, r2, c1, c2] = box[v]; for (let r = r1; r <= r2; r++) for (let c = c1; c <= c2; c++) if (g[r][c] !== +v) out[v].add(String(g[r][c])); } const cols = Object.keys(box); cols.slice(0, 4).forEach(v => { T.at({ grid: G(g, { hl: [[box[v][0], box[v][2]], [box[v][1], box[v][3]]] }) }); T.n(`Other colors inside color ${v}'s rectangle?`, out[v].size, 'They must be printed after it.'); }); const st = {}; const cyc = v => { if (st[v] === 1) return true; if (st[v] === 2) return false; st[v] = 1; for (const w of out[v]) if (cyc(w)) return true; st[v] = 2; return false; }; return !cols.some(cyc); }
  });

  D('maximal-network-rank', {
    t: 'Maximal Network Rank',
    r: 'Rank of a pair = deg(a) + deg(b), minus 1 if they share a road. Try all pairs (or only the top degrees).',
    g: R => { const n = R.int(2, 6); return { n, roads: R.edges(n, R.int(0, n + 2)) }; },
    s(I, T) { const res = (() => { const deg = Array(I.n).fill(0), has = new Set(); I.roads.forEach(([a, b]) => { deg[a]++; deg[b]++; has.add(a + ',' + b); has.add(b + ',' + a); }); T.at({ graph: GR(I.n, I.roads), degree: A(deg) }); T.n('Highest degree?', Math.max(...deg), 'Count roads per city.'); T.n('Cities with that degree?', deg.filter(x => x === Math.max(...deg)).length, 'The best pair usually uses them.'); let best = 0; for (let a = 0; a < I.n; a++) for (let b = a + 1; b < I.n; b++) best = Math.max(best, deg[a] + deg[b] - (has.has(a + ',' + b) ? 1 : 0)); return best; })(); T.n('Maximal network rank?', res, 'Two degrees added, minus 1 if they share a road.'); return res; }
  });

  D('minimum-jumps-to-reach-home', {
    t: 'Minimum Jumps to Reach Home',
    r: 'BFS over (position, whether the last jump was backward). Forward a always; backward b only if the last jump was forward. Bound positions at max(x, forbidden) + a + b.',
    g: R => ({ forbidden: R.distinct(R.int(1, 4), 1, 15), a: R.int(1, 6), b: R.int(1, 6), x: R.int(0, 15) }),
    exIn: I => I,
    s(I, T) { const res = (() => { const F = new Set(I.forbidden); F.delete(I.x); const lim = Math.max(I.x, ...I.forbidden) + I.a + I.b, seen = new Set(['0,0']); let lv = [[0, 0]], d = 0; T.at({ a: I.a, b: I.b, x: I.x, forbidden: A(I.forbidden) }); T.n('Furthest position worth exploring?', lim, 'The largest of x and the forbidden spots, plus a plus b.'); T.yn('Is position a forbidden?', F.has(I.a), 'Then the first jump is blocked.'); while (lv.length) { if (lv.some(([p]) => p === I.x)) return d; const nx = []; for (const [p, back] of lv) { const f = p + I.a; if (f <= lim && !F.has(f) && !seen.has(f + ',0')) { seen.add(f + ',0'); nx.push([f, 0]); } const bk = p - I.b; if (!back && bk >= 0 && !F.has(bk) && !seen.has(bk + ',1')) { seen.add(bk + ',1'); nx.push([bk, 1]); } } lv = nx; d++; } return -1; })(); T.n('Fewest jumps (−1 if impossible)?', res, 'BFS level where x appears.'); return res; }
  });

  D('number-of-ways-to-reconstruct-a-tree', {
    t: 'Number of Ways to Reconstruct a Tree',
    r: 'The root must pair with everyone (degree n − 1). Each other node\'s parent is its neighbor with the smallest degree at least its own, and its neighbors must be a subset of the parent\'s. Equal degrees mean parent and child could swap: more than one way.',
    g: R => { const n = R.int(2, 5), par = [-1]; for (let i = 1; i < n; i++) par.push(R.int(0, i - 1)); const pairs = []; for (let i = 1; i < n; i++) for (let a = par[i]; a >= 0; a = par[a]) pairs.push([Math.min(a, i) + 1, Math.max(a, i) + 1]); const ex = R.chance(0.3) ? [[R.int(1, n), R.int(1, n)]].filter(([a, b]) => a < b) : []; return { pairs: [...new Map(pairs.concat(ex).map(p => [p.join(','), p])).values()] }; },
    s(I, T) { const adj = new Map(); I.pairs.forEach(([a, b]) => { if (!adj.has(a)) adj.set(a, new Set()); if (!adj.has(b)) adj.set(b, new Set()); adj.get(a).add(b); adj.get(b).add(a); }); const nodes = [...adj.keys()], n = nodes.length, deg = v => adj.get(v).size; const root = nodes.find(v => deg(v) === n - 1); T.at({ degrees: K(Object.fromEntries(nodes.map(v => [v, deg(v)]))) }); T.yn('Is there a node paired with everyone (a root)?', root !== undefined, 'The root is an ancestor of all.'); if (root === undefined) return 0; let res = 1, asks = 0; for (const x of nodes) { if (x === root) continue; let p = null; for (const y of adj.get(x)) if (deg(y) >= deg(x) && (p === null || deg(y) < deg(p))) p = y; if (asks++ < 4) { T.at({ node: x, parent: p === null ? '—' : p }); T.n(`Degree of ${x}'s parent?`, p === null ? -1 : deg(p), 'Smallest neighbor degree at least its own (−1 if none).'); } if (p === null) return 0; for (const y of adj.get(x)) if (y !== p && !adj.get(p).has(y)) return 0; if (deg(p) === deg(x)) res = 2; } return res; }
  });

  D('cat-and-mouse-ii', {
    t: 'Cat and Mouse II (retrograde analysis)',
    r: 'States (mouse cell, cat cell, turn). Terminal: cat on mouse or cat on food means the cat wins; mouse on food means the mouse wins. Propagate backward with move counts; anything unresolved (endless play) counts as a cat win.',
    g: R => { const m = R.int(1, 3), n = R.int(3, 5), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.15) ? '#' : '.')), cells = R.shuffle([...Array(m * n).keys()]); ['M', 'C', 'F'].forEach((ch, i) => g[Math.floor(cells[i] / n)][cells[i] % n] = ch); return { grid: g.map(r => r.join('')), catJump: R.int(1, 2), mouseJump: R.int(1, 3) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, N = m * n; let M, C, F; g.forEach((row, r) => [...row].forEach((ch, c) => { if (ch === 'M') M = r * n + c; if (ch === 'C') C = r * n + c; if (ch === 'F') F = r * n + c; })); const moves = (p, J) => { if (g[Math.floor(p / n)][p % n] === '#') return []; const r = Math.floor(p / n), c = p % n, out = [p]; for (const [dr, dc] of DIRS) for (let k = 1; k <= J; k++) { const x = r + dr * k, y = c + dc * k; if (x < 0 || y < 0 || x >= m || y >= n || g[x][y] === '#') break; out.push(x * n + y); } return out; }; const mm = [...Array(N).keys()].map(p => moves(p, I.mouseJump)), cm = [...Array(N).keys()].map(p => moves(p, I.catJump)); const res = new Int8Array(N * N * 2), deg = new Int16Array(N * N * 2), id = (a, b, t) => (a * N + b) * 2 + t, q = []; for (let a = 0; a < N; a++) for (let b = 0; b < N; b++) { deg[id(a, b, 0)] = mm[a].length; deg[id(a, b, 1)] = cm[b].length; if (!mm[a].length || !cm[b].length) continue; for (const t of [0, 1]) { let r = 0; if (a === b || b === F) r = 2; else if (a === F) r = 1; if (r) { res[id(a, b, t)] = r; q.push([a, b, t, r]); } } } for (let i = 0; i < q.length; i++) { const [a, b, t, r] = q[i], pt = 1 - t, par = pt === 0 ? mm[a].map(pa => [pa, b]) : cm[b].map(pb => [a, pb]); for (const [pa, pb] of par) { const k = id(pa, pb, pt); if (res[k]) continue; if ((pt === 0 && r === 1) || (pt === 1 && r === 2)) { res[k] = r; q.push([pa, pb, pt, r]); } else if (!--deg[k]) { res[k] = r; q.push([pa, pb, pt, r]); } } } const win = res[id(M, C, 0)] === 1; T.at({ grid: G(g.map(r => [...r])) }); T.n('Cells the mouse can jump to on its first move (including staying)?', mm[M].length, `Up to ${I.mouseJump} per direction, stopped by walls.`); T.n('Cells the cat can jump to on its first move (including staying)?', cm[C].length, `Up to ${I.catJump} per direction, stopped by walls.`); T.yn('Does the mouse win with perfect play?', win, 'Retrograde analysis; draws go to the cat.'); return win; }
  });

  D('minimum-degree-of-a-connected-trio-in-a-graph', {
    t: 'Minimum Degree of a Connected Trio',
    r: 'For every edge (u, v) and every w adjacent to both, the trio degree is deg(u) + deg(v) + deg(w) − 6. Take the minimum; −1 if no trio.',
    g: R => { const n = R.int(3, 6); return { n, edges: R.edges(n, R.int(2, n + 4)).map(([a, b]) => [a + 1, b + 1]) }; },
    s(I, T) { const n = I.n, adj = Array.from({ length: n + 1 }, () => new Set()); I.edges.forEach(([a, b]) => { adj[a].add(b); adj[b].add(a); }); let best = Infinity, asks = 0; for (let a = 1; a <= n; a++) for (const b of adj[a]) if (b > a) for (const c of adj[b]) if (c > b && adj[a].has(c)) { const d = adj[a].size + adj[b].size + adj[c].size - 6; if (asks++ < 4) { T.at({ graph: GR([...Array(n).keys()].map(x => x + 1), I.edges, { cls: { [a]: 'hit', [b]: 'hit', [c]: 'hit' } }) }); T.n(`Degree of trio ${a}, ${b}, ${c}?`, d, 'Sum of degrees − 6 (inner edges).'); } best = Math.min(best, d); } if (!asks) { T.at({ graph: GR([...Array(n).keys()].map(x => x + 1), I.edges) }); T.yn('Is there any triangle?', false, 'Then the answer is −1.'); } return best === Infinity ? -1 : best; }
  });

  D('shortest-path-in-a-hidden-grid', {
    t: 'Shortest Path in a Hidden Grid',
    r: 'Explore the hidden grid with DFS (moving and backtracking through the robot API) to map every reachable cell, then BFS on the map from the start to the target.',
    g: R => { const m = R.int(1, 4), n = R.int(2, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.3) ? 0 : 1)), c = R.shuffle([...Array(m * n).keys()]); g[Math.floor(c[0] / n)][c[0] % n] = -1; g[Math.floor(c[1] / n)][c[1] % n] = 2; return { grid: g }; },
    s(I, T) { const res = (() => { const g = I.grid; let s; g.forEach((row, r) => row.forEach((v, c) => { if (v === -1) s = [r, c]; })); const d = g.map(r => r.map(() => -1)); d[s[0]][s[1]] = 0; const q = [s]; T.at({ grid: G(g, { hl: [s] }) }); T.n('Open cells in total?', g.flat().filter(v => v !== 0).length, 'Explore them with DFS first.'); T.n('Open neighbors of the start?', DIRS.filter(([dr, dc]) => inG(g, s[0] + dr, s[1] + dc) && g[s[0] + dr][s[1] + dc] !== 0).length, 'canMove in each direction.'); for (let i = 0; i < q.length; i++) { const [r, c] = q[i]; if (g[r][c] === 2) return d[r][c]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && g[x][y] !== 0 && d[x][y] < 0) { d[x][y] = d[r][c] + 1; q.push([x, y]); } } } return -1; })(); T.n('Shortest distance (−1 if unreachable)?', res, 'BFS from the start.'); return res; }
  });

  D('count-pairs-of-nodes', {
    t: 'Count Pairs of Nodes',
    r: 'incident(a, b) = deg(a) + deg(b) − edges between a and b. Sort degrees and count pairs with deg sum > q by two pointers, then fix pairs that share edges and drop below.',
    g: R => { const n = R.int(2, 5); return { n, edges: Array.from({ length: R.int(1, 6) }, () => { const a = R.int(1, n); let b = R.int(1, n); if (a === b) b = a % n + 1; return [a, b]; }), queries: R.ints(R.int(1, 3), 0, 6) }; },
    s(I, T) { const n = I.n, deg = Array(n + 1).fill(0), sh = {}; I.edges.forEach(([a, b]) => { deg[a]++; deg[b]++; const k = Math.min(a, b) + ',' + Math.max(a, b); sh[k] = (sh[k] || 0) + 1; }); T.at({ degree: A(deg.slice(1)), shared: K(sh) }); return I.queries.map((q, qi) => { const sd = deg.slice(1).sort((a, b) => a - b); let l = 0, r = n - 1, c = 0; while (l < r) { if (sd[l] + sd[r] > q) { c += r - l; r--; } else l++; } const base = c; for (const k in sh) { const [a, b] = k.split(',').map(Number); if (deg[a] + deg[b] > q && deg[a] + deg[b] - sh[k] <= q) c--; } if (qi < 3) { T.at({ sortedDeg: A(sd), q }); T.n(`Pairs with degree sum > ${q}?`, base, 'Two pointers on sorted degrees.'); } return c; }); }
  });

  D('number-of-restricted-paths-from-first-to-last-node', {
    t: 'Number of Restricted Paths',
    r: 'Dijkstra from node n gives distanceToLastNode. A restricted path strictly decreases that distance, so count paths with DP over nodes in increasing distance order (mod 1e9 + 7).',
    g: R => { const n = R.int(2, 6); return { n, edges: R.edges(n, R.int(n - 1, n + 3), { conn: true, w: [1, 5] }).map(([a, b, w]) => [a + 1, b + 1, w]) }; },
    s(I, T) { const n = I.n, d = Array(n + 1).fill(Infinity), done = Array(n + 1).fill(false); d[n] = 0; for (let it = 0; it < n; it++) { let u = -1; for (let v = 1; v <= n; v++) if (!done[v] && d[v] < Infinity && (u < 0 || d[v] < d[u])) u = v; if (u < 0) break; done[u] = true; for (const [a, b, w] of I.edges) { const v = a === u ? b : b === u ? a : -1; if (v > 0 && d[u] + w < d[v]) d[v] = d[u] + w; } } T.at({ graph: GR([...Array(n).keys()].map(x => x + 1), I.edges.map(e => [e[0], e[1]])), distToLast: A(d.slice(1)) }); T.n('Distance from node 1 to node n?', d[1], 'Run Dijkstra from node n.'); const order = [...Array(n).keys()].map(x => x + 1).sort((a, b) => d[a] - d[b]), ways = Array(n + 1).fill(0); ways[n] = 1; for (const u of order) for (const [a, b] of I.edges) { const v = a === u ? b : b === u ? a : -1; if (v > 0 && d[v] < d[u]) ways[u] = (ways[u] + ways[v]) % 1000000007; } T.n('Neighbours of node 1 that are closer to n?', new Set(I.edges.map(([a, b]) => a === 1 ? b : b === 1 ? a : -1).filter(v => v > 0 && d[v] < d[1])).size, 'A restricted path must step to one of them.'); T.n('Restricted paths from node 1?', ways[1], 'Sum over neighbors closer to n.'); return ways[1]; }
  });

  D('find-center-of-star-graph', {
    t: 'Find Center of Star Graph',
    r: 'The center is in every edge, so it is the node shared by the first two edges.',
    g: R => { const n = R.int(3, 7), c = R.int(1, n); return { edges: R.shuffle([...Array(n).keys()].map(x => x + 1).filter(x => x !== c).map(x => R.chance(0.5) ? [c, x] : [x, c])) }; },
    s(I, T) { const res = (() => { const [a, b] = I.edges[0], c = I.edges[1].includes(a) ? a : b; T.at({ e0: I.edges[0].join(' to '), e1: I.edges[1].join(' to ') }); T.n('How many nodes?', I.edges.length + 1, 'One more than the edges.'); T.n('Which node is shared by the first two edges?', c, 'Only the center appears in both.'); return c; })(); T.n('Degree of the center?', I.edges.length, 'It touches every edge.'); return res; }
  });

  D('minimum-path-cost-in-a-hidden-grid', {
    t: 'Minimum Path Cost in a Hidden Grid',
    r: 'DFS through the robot API to map the reachable cells and their costs, then Dijkstra from the start: entering a cell costs its value.',
    g: R => { const m = R.int(1, 4), n = R.int(2, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.25) ? 0 : R.int(1, 5))); const c = R.shuffle([...Array(m * n).keys()]); const p = i => [Math.floor(c[i] / n), c[i] % n]; const [r1, c1] = p(0), [r2, c2] = p(1); if (!g[r1][c1]) g[r1][c1] = 1; if (!g[r2][c2]) g[r2][c2] = 1; return { grid: g, r1, c1, r2, c2 }; },
    s(I, T) { const g = I.grid, d = g.map(r => r.map(() => Infinity)), done = new Set(); d[I.r1][I.c1] = 0; let asks = 0; for (;;) { let u = null; g.forEach((row, r) => row.forEach((_, c) => { if (!done.has(r + ',' + c) && d[r][c] < Infinity && (!u || d[r][c] < d[u[0]][u[1]])) u = [r, c]; })); if (!u) break; const [r, c] = u; done.add(r + ',' + c); if (r === I.r2 && c === I.c2) return d[r][c]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && g[x][y] && d[r][c] + g[x][y] < d[x][y]) { d[x][y] = d[r][c] + g[x][y]; if (asks++ < 5) { T.at({ cost: G(g, { hl: [[r, c], [x, y]] }) }); T.n(`Cost to enter (${x}, ${y}) via (${r}, ${c})?`, d[x][y], `${d[r][c]} + ${g[x][y]}.`); } } } } if (!asks) { T.at({ cost: G(g) }); T.yn('Can the robot leave the start?', false, 'All neighbors blocked.'); } return -1; }
  });

  D('maximum-number-of-accepted-invitations', {
    t: 'Maximum Accepted Invitations (bipartite matching)',
    r: 'Kuhn\'s augmenting paths: for each boy, DFS over girls he can invite; take a free girl, or re-route her current partner to another girl.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { grid: Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.45) ? 1 : 0)) }; },
    s(I, T) { const g = I.grid, n = g[0].length, match = Array(n).fill(-1); const tryB = (b, seen) => { for (let j = 0; j < n; j++) if (g[b][j] && !seen[j]) { seen[j] = true; if (match[j] < 0 || tryB(match[j], seen)) { match[j] = b; return true; } } return false; }; let c = 0; g.forEach((_, b) => { const ok = tryB(b, Array(n).fill(false)); if (b < 5) { T.at({ grid: G(g, { hl: match.map((bb, j) => [bb, j]).filter(x => x[0] >= 0) }) }); T.yn(`Can boy ${b} be matched (possibly by re-routing)?`, ok, 'Augmenting path search.'); } if (ok) c++; }); return c; }
  });

  D('largest-color-value-in-a-directed-graph', {
    t: 'Largest Color Value in a Directed Graph',
    r: 'Kahn\'s topological order with dp[v][c] = max count of color c on a path ending at v. Push counts along edges; −1 if a cycle prevents finishing.',
    g: R => { const n = R.int(1, 6); return { colors: R.str(n, 'abc'), edges: R.edges(n, R.int(0, n + 1), { dir: true }) }; },
    s(I, T) { const n = I.colors.length, out = Array.from({ length: n }, () => []), indeg = Array(n).fill(0); I.edges.forEach(([a, b]) => { out[a].push(b); indeg[b]++; }); const dp = Array.from({ length: n }, () => ({})), q = [...Array(n).keys()].filter(v => !indeg[v]); let seen = 0, best = 0; while (q.length) { const u = q.shift(); seen++; dp[u][I.colors[u]] = (dp[u][I.colors[u]] || 0) + 1; const mx = Math.max(...Object.values(dp[u])); best = Math.max(best, mx); if (seen <= 5) { T.at({ graph: GR(n, I.edges, { dir: true, cls: { [u]: 'hit' }, tag: Object.fromEntries([...I.colors].map((c, i) => [i, c])) }) }); T.n(`Best single-color count on a path ending at ${u}?`, mx, 'Max over colors in dp[u].'); } for (const v of out[u]) { for (const c in dp[u]) dp[v][c] = Math.max(dp[v][c] || 0, dp[u][c]); if (!--indeg[v]) q.push(v); } } if (!seen) { T.at({ graph: GR(n, I.edges, { dir: true }) }); T.yn('Any node with in-degree 0?', false, 'Everything is on a cycle.'); } return seen === n ? best : -1; }
  });
})();
