/* v2 games: union-find (01). */
(function () {
  'use strict';
  const { D, A, G, K, GR } = LCGame.H;
  const DSU = n => { const p = Array.from({ length: n }, (_, i) => i), sz = Array(n).fill(1); const f = x => { while (p[x] !== x) { p[x] = p[p[x]]; x = p[x]; } return x; }; return { f, p, sz, u(a, b) { a = f(a); b = f(b); if (a === b) return false; if (sz[a] < sz[b]) [a, b] = [b, a]; p[b] = a; sz[a] += sz[b]; return true; }, comps() { let c = 0; for (let i = 0; i < n; i++) if (f(i) === i) c++; return c; } }; };
  const MapDSU = () => { const p = new Map(); const f = x => { if (!p.has(x)) p.set(x, x); while (p.get(x) !== x) { p.set(x, p.get(p.get(x))); x = p.get(x); } return x; }; return { f, p, u(a, b) { a = f(a); b = f(b); if (a === b) return false; p.set(a, b); return true; } }; };
  const gcd = (a, b) => b ? gcd(b, a % b) : a;
  const D4 = [[1, 0], [-1, 0], [0, 1], [0, -1]];
  const kruskal = (n, edges, skip, force) => { const d = DSU(n); let w = 0, c = 0; if (force !== undefined) { const [a, b, x] = edges[force]; d.u(a, b); w += x; c++; } edges.map((e, i) => [e, i]).sort((a, b) => a[0][2] - b[0][2]).forEach(([[a, b, x], i]) => { if (i === skip || i === force) return; if (d.u(a, b)) { w += x; c++; } }); return c === n - 1 ? w : Infinity; };

  D('graph-valid-tree', {
    t: 'Graph Valid Tree',
    r: 'A tree on n nodes has exactly n − 1 edges and no cycle. Union the endpoints of each edge; if they are already connected, there is a cycle.',
    g: R => { const n = R.int(1, 6); return { n, edges: R.edges(n, R.chance(0.5) ? n - 1 : R.int(0, n), { conn: R.chance(0.6) }) }; },
    s(I, T) { T.at({ graph: GR(I.n, I.edges) }); T.yn('Exactly n − 1 edges?', I.edges.length === I.n - 1, 'Necessary for a tree.'); if (I.edges.length !== I.n - 1) return false; const d = DSU(I.n); for (const [a, b] of I.edges) { const ok = d.u(a, b); T.at({ edge: `${a} to ${b}` }); T.yn('Does this edge join two different components?', ok, 'Otherwise it closes a cycle.'); if (!ok) return false; } return true; }
  });

  D('number-of-islands-ii', {
    t: 'Number of Islands II',
    r: 'Add land cells one at a time. Each new cell is +1 island; every union with a different neighboring island merges two into one (−1).',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3); return { m, n, positions: Array.from({ length: R.int(1, 6) }, () => [R.int(0, m - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const d = DSU(I.m * I.n), land = new Set(); let c = 0; return I.positions.map(([r, col], k) => { const id = r * I.n + col; if (!land.has(id)) { land.add(id); c++; for (const [a, b] of D4) { const x = r + a, y = col + b; if (x >= 0 && y >= 0 && x < I.m && y < I.n && land.has(x * I.n + y) && d.u(id, x * I.n + y)) c--; } } if (k < 6) { T.at({ map: G(Array.from({ length: I.m }, (_, i) => Array.from({ length: I.n }, (_, j) => land.has(i * I.n + j) ? 1 : 0)), { hl: [[r, col]] }) }); T.n('Islands now?', c, '+1 for the cell, −1 per merge.'); } return c; }); }
  });

  D('evaluate-division', {
    t: 'Evaluate Division',
    r: 'Weighted union-find: store each variable\'s ratio to its root. a divided by b is known only if they share a root, and equals ratio(a) divided by ratio(b).',
    g: R => { const vs = ['a', 'b', 'c', 'd', 'e'], eq = [], val = []; for (let i = 0; i < R.int(1, 3); i++) { const x = R.pick(vs), y = R.pick(vs.filter(v => v !== x)); eq.push([x, y]); val.push(R.int(1, 6)); } const known = new Set(eq.flat()); const consistent = (() => { const w = {}; const p = {}; const f = x => { if (p[x] === undefined) { p[x] = x; w[x] = 1; } if (p[x] === x) return x; const r = f(p[x]); w[x] *= w[p[x]]; p[x] = r; return r; }; return eq.every(([x, y], i) => { const a = f(x), b = f(y); if (a === b) return Math.abs(w[x] / w[y] - val[i]) < 1e-9; p[a] = b; w[a] = val[i] * w[y] / w[x]; return true; }); })(); if (!consistent) return { equations: [eq[0]], values: [val[0]], queries: [[eq[0][1], eq[0][0]], ['a', 'z']] }; return { equations: eq, values: val, queries: Array.from({ length: R.int(1, 4) }, () => [R.pick([...known, 'z']), R.pick([...known])]) }; },
    cmp: (o, e) => Array.isArray(o) && o.length === e.length && o.every((v, i) => Math.abs(v - e[i]) <= 1e-5 * Math.max(1, Math.abs(e[i]))),
    s(I, T) { const p = {}, w = {}; const f = x => { if (p[x] === x) return x; const r = f(p[x]); w[x] *= w[p[x]]; p[x] = r; return r; }; I.equations.forEach(([a, b], i) => { [a, b].forEach(x => { if (p[x] === undefined) { p[x] = x; w[x] = 1; } }); const ra = f(a), rb = f(b); if (ra !== rb) { p[ra] = rb; w[ra] = I.values[i] * w[b] / w[a]; } }); return I.queries.map(([a, b], i) => { const ok = p[a] !== undefined && p[b] !== undefined && f(a) === f(b), v = ok ? w[a] / w[b] : -1; if (i < 4) { T.at({ query: `${a} divided by ${b}` }); T.yn('Are both variables known and in the same group?', ok, 'Otherwise the answer is −1.'); } return v; }); }
  });

  D('redundant-connection-ii', {
    t: 'Redundant Connection II',
    r: 'If some node has two parents, the answer is one of those two edges (cand1 earlier, cand2 later). Union all edges except cand2: a cycle means cand1 (or the cycle edge if no node has two parents); no cycle means cand2.',
    g: R => { const n = R.int(3, 6), perm = R.perm(n).map(x => x + 1), e = []; for (let i = 1; i < n; i++) e.push([perm[R.int(0, i - 1)], perm[i]]); for (;;) { const u = R.int(1, n), v = R.int(1, n); if (u !== v && !e.some(x => x[0] === u && x[1] === v)) { e.push([u, v]); break; } } return { edges: R.shuffle(e) }; },
    s(I, T) { const res = (() => { const n = I.edges.length, par = {}; let c1 = null, c2 = null; for (const [u, v] of I.edges) { if (par[v] !== undefined) { c1 = [par[v], v]; c2 = [u, v]; } else par[v] = u; } T.at({ graph: GR(n, I.edges, { base: 1, dir: true }) }); T.yn('Does some node have two parents?', !!c2, 'Check in-degrees.'); if (c2) T.n('Which node has two parents?', c2[1], 'It appears twice as a child.'); else T.n('Edges in the graph?', n, 'A tree on n nodes has n minus 1, so one is extra.'); const d = DSU(n + 1); for (const [u, v] of I.edges) { if (c2 && u === c2[0] && v === c2[1]) continue; if (!d.u(u, v)) { T.at({ edge: `${u} to ${v}` }); T.yn('Does this edge close a cycle?', true, 'Already connected.'); return c1 || [u, v]; } } return c2; })(); T.n('Child node of the edge to remove?', res[1], 'The edge that breaks the tree.'); return res; }
  });

  D('accounts-merge', {
    t: 'Accounts Merge',
    r: 'Union every email in an account with the account\'s first email. Group emails by root, sort them, and prepend the owner\'s name.',
    g: R => ({ accounts: Array.from({ length: R.int(1, 4) }, () => { const nm = R.pick(['Ann', 'Bo']); return [nm, ...new Set(Array.from({ length: R.int(1, 3) }, () => nm.toLowerCase() + R.int(1, 4) + '@m.co'))]; }) }),
    cmp: (o, e) => Array.isArray(o) && JSON.stringify(o.map(x => JSON.stringify(x)).sort()) === JSON.stringify(e.map(x => JSON.stringify(x)).sort()),
    s(I, T) { const d = MapDSU(), owner = {}; I.accounts.forEach(([nm, ...em], i) => { em.forEach(x => { owner[x] = nm; d.u(x, em[0]); }); if (i < 4) { T.at({ account: A([nm, ...em]) }); T.n('Emails joined to the first email here?', em.length - 1, 'Union each with em[0].'); } }); const g = {}; Object.keys(owner).forEach(x => (g[d.f(x)] = g[d.f(x)] || []).push(x)); return Object.values(g).map(l => [owner[l[0]], ...l.sort()]); }
  });

  D('sentence-similarity-ii', {
    t: 'Sentence Similarity II',
    r: 'Similarity is transitive: union each similar pair. Sentences match if they have the same length and each word pair is equal or in the same group.',
    g: R => { const w = ['great', 'good', 'fine', 'ok', 'bad']; return { sentence1: Array.from({ length: R.int(1, 3) }, () => R.pick(w)), sentence2: Array.from({ length: R.int(1, 3) }, () => R.pick(w)), similarPairs: Array.from({ length: R.int(0, 3) }, () => R.shuffle(w).slice(0, 2)) }; },
    s(I, T) { const res = (() => { T.at({ s1: A(I.sentence1), s2: A(I.sentence2) }); T.n('Words in sentence 1?', I.sentence1.length, 'Compare word by word.'); T.yn('Same length?', I.sentence1.length === I.sentence2.length, 'Required.'); if (I.sentence1.length !== I.sentence2.length) return false; const d = MapDSU(); I.similarPairs.forEach(([a, b]) => d.u(a, b)); return I.sentence1.every((a, i) => { const ok = a === I.sentence2[i] || d.f(a) === d.f(I.sentence2[i]); T.at({ pair: `${a} and ${I.sentence2[i]}` }); T.yn('Similar?', ok, 'Equal or same group.'); return ok; }); })(); T.yn('Are the sentences similar?', res, 'Every word pair must be similar.'); return res; }
  });

  D('couples-holding-hands', {
    t: 'Couples Holding Hands',
    r: 'Union the couple ids (person >> 1) sitting on each sofa (seats 2i, 2i+1). A group of k couples tangled together needs k − 1 swaps, so the answer is n − (number of groups).',
    g: R => ({ row: R.perm(2 * R.int(1, 4)) }),
    s(I, T) { const n = I.row.length / 2, d = DSU(n); for (let i = 0; i < I.row.length; i += 2) { const a = I.row[i] >> 1, b = I.row[i + 1] >> 1; d.u(a, b); if (i < 8) { T.at({ row: A(I.row, { i, j: i + 1 }) }); T.yn('Is this sofa already a couple?', a === b, 'Same id >> 1.'); } } T.n('Groups of tangled couples?', d.comps(), 'Each group of k needs k − 1 swaps.'); return n - d.comps(); }
  });

  D('swim-in-rising-water', {
    t: 'Swim in Rising Water',
    r: 'Add cells in increasing elevation, unioning with already-added neighbors; the first time (0,0) and (n−1,n−1) connect, that elevation is the answer.',
    g: R => { const n = R.int(1, 3), v = R.perm(n * n); return { grid: Array.from({ length: n }, (_, i) => v.slice(i * n, i * n + n)) }; },
    s(I, T) { const g = I.grid, n = g.length, d = DSU(n * n), pos = []; g.forEach((r, i) => r.forEach((v, j) => pos[v] = [i, j])); const on = new Set(); for (let t = 0; t < n * n; t++) { const [i, j] = pos[t]; on.add(i * n + j); for (const [a, b] of D4) { const x = i + a, y = j + b; if (x >= 0 && y >= 0 && x < n && y < n && on.has(x * n + y)) d.u(i * n + j, x * n + y); } const done = on.has(0) && on.has(n * n - 1) && d.f(0) === d.f(n * n - 1); if (t < 6 || done) { T.at({ grid: G(g, { hl: [[i, j]] }), time: t }); T.yn('Are the corners connected now?', done, 'Union the newly flooded cell.'); } if (done) return t; } }
  });

  D('is-graph-bipartite', {
    t: 'Is Graph Bipartite?',
    r: 'Each node must be in a different set than all its neighbors: union all neighbors of u together, and fail if u ends up in their group (equivalently, 2-color with BFS).',
    g: R => { const n = R.int(1, 6), e = R.edges(n, R.int(0, 6)), adj = Array.from({ length: n }, () => []); e.forEach(([a, b]) => { adj[a].push(b); adj[b].push(a); }); return { graph: adj }; },
    s(I, T) { const n = I.graph.length, d = DSU(n); for (let u = 0; u < n; u++) { const nb = I.graph[u]; for (const v of nb) d.u(nb[0], v); const bad = nb.some(v => d.f(v) === d.f(u)); if (u < 5) { T.at({ node: u, neighbors: A(nb) }); T.yn('Is the node grouped with a neighbor?', bad, 'Neighbors are unioned together.'); } if (bad) return false; } return true; }
  });

  D('bricks-falling-when-hit', {
    t: 'Bricks Falling When Hit',
    r: 'Work in reverse: remove all hit bricks, union the remaining ones (with a virtual roof node for row 0), then add hits back from last to first; the growth of the roof component minus the re-added brick is how many fell.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3); return { grid: R.grid(m, n, 0, 1).map(r => r.map(() => R.chance(0.75) ? 1 : 0)), hits: Array.from({ length: R.int(1, 3) }, () => [R.int(0, m - 1), R.int(0, n - 1)]).filter((h, i, a) => a.findIndex(x => x[0] === h[0] && x[1] === h[1]) === i) }; },
    s(I, T) { const res = (() => { const g = I.grid.map(r => r.slice()), m = g.length, n = g[0].length; const stable = () => { const s = new Set(), q = []; for (let j = 0; j < n; j++) if (g[0][j]) { s.add(j); q.push([0, j]); } while (q.length) { const [i, j] = q.shift(); for (const [a, b] of D4) { const x = i + a, y = j + b; if (x >= 0 && y >= 0 && x < m && y < n && g[x][y] && !s.has(x * n + y)) { s.add(x * n + y); q.push([x, y]); } } } return s; }; return I.hits.map(([r, c], k) => { if (!g[r][c]) { if (k < 4) { T.at({ grid: G(g.map(x => x.slice()), { hl: [[r, c]] }) }); T.n('Bricks that fall?', 0, 'Nothing to hit here.'); } return 0; } g[r][c] = 0; const s = stable(); let fell = 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) if (g[i][j] && !s.has(i * n + j)) { g[i][j] = 0; fell++; } if (k < 4) { T.at({ grid: G(g.map(x => x.slice()), { hl: [[r, c]] }) }); T.n('Bricks that fall?', fell, 'Bricks no longer connected to the top.'); } return fell; }); })(); T.n('Total bricks fallen?', res.reduce((a, b) => a + b, 0), 'Add the count from every hit.'); return res; }
  });

  D('making-a-large-island', {
    t: 'Making A Large Island',
    r: 'Union land cells into islands with sizes. For each water cell, add 1 plus the sizes of the distinct islands around it; keep the best (or n² if no water).',
    g: R => { const n = R.int(1, 4); return { grid: R.grid(n, n, 0, 1) }; },
    s(I, T) { const g = I.grid, n = g.length, d = DSU(n * n); for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (g[i][j]) { if (i + 1 < n && g[i + 1][j]) d.u(i * n + j, (i + 1) * n + j); if (j + 1 < n && g[i][j + 1]) d.u(i * n + j, i * n + j + 1); } let best = 0, k = 0; for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (g[i][j]) best = Math.max(best, d.sz[d.f(i * n + j)]); for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (!g[i][j]) { const roots = new Set(); for (const [a, b] of D4) { const x = i + a, y = j + b; if (x >= 0 && y >= 0 && x < n && y < n && g[x][y]) roots.add(d.f(x * n + y)); } const v = 1 + [...roots].reduce((s, r) => s + d.sz[r], 0); best = Math.max(best, v); if (k++ < 4) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.n('Island size if this cell becomes land?', v, '1 + distinct neighbor islands.'); } } return best; }
  });

  D('similar-string-groups', {
    t: 'Similar String Groups',
    r: 'Two anagrams are similar if they differ in exactly 0 or 2 positions. Union every similar pair; count groups.',
    g: R => { const base = R.shuffle([...'abcd'.slice(0, R.int(2, 4))]); return { strs: [...new Set(Array.from({ length: R.int(1, 5) }, () => { const a = base.slice(); for (let t = 0; t < R.int(0, 2); t++) { const i = R.int(0, a.length - 1), j = R.int(0, a.length - 1); [a[i], a[j]] = [a[j], a[i]]; } return a.join(''); }))] }; },
    s(I, T) { const s = I.strs, d = DSU(s.length); let k = 0; for (let i = 0; i < s.length; i++) for (let j = i + 1; j < s.length; j++) { let diff = 0; for (let x = 0; x < s[i].length; x++) if (s[i][x] !== s[j][x]) diff++; const sim = diff === 0 || diff === 2; if (sim) d.u(i, j); if (k++ < 5) { T.at({ a: s[i], b: s[j] }); T.yn('Similar?', sim, 'Differ in 0 or 2 positions.'); } } return d.comps(); }
  });

  D('possible-bipartition', {
    t: 'Possible Bipartition',
    r: 'Everyone a person dislikes must go to the other group, so union all of a person\'s dislikes together; fail if a person lands in the same group as someone they dislike.',
    g: R => { const n = R.int(1, 6); return { n, dislikes: R.edges(n, R.int(0, 6), { base: 1 }).map(e => e[0] < e[1] ? e : [e[1], e[0]]) }; },
    s(I, T) { const adj = Array.from({ length: I.n }, () => []); I.dislikes.forEach(([a, b]) => { adj[a - 1].push(b - 1); adj[b - 1].push(a - 1); }); T.at({ graph: GR(I.n, I.dislikes, { base: 1 }) }); T.n('Dislike pairs?', I.dislikes.length, 'Each one is an edge.'); T.n('People with no dislikes?', adj.filter(x => !x.length).length, 'They fit in either group.'); const d = DSU(I.n); for (let u = 0; u < I.n; u++) { for (const v of adj[u]) { d.u(adj[u][0], v); if (d.f(u) === d.f(v)) { T.at({ person: u + 1, dislikes: A(adj[u].map(x => x + 1)) }); T.yn('Forced into the same group as a disliked person?', true, 'Impossible.'); return false; } } } T.at({ graph: GR(I.n, I.dislikes, { base: 1 }) }); T.yn('Can we split everyone?', true, 'No conflict found.'); return true; }
  });

  D('minimize-malware-spread', {
    t: 'Minimize Malware Spread',
    r: 'Find connected components. Removing an initial node only helps if it is the only infected node in its component — then it saves the whole component. Pick the largest such saving (smallest index on ties); otherwise the smallest initial node.',
    g: R => { const n = R.int(2, 6), e = R.edges(n, R.int(0, 5)), g = Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => +(i === j))); e.forEach(([a, b]) => g[a][b] = g[b][a] = 1); return { graph: g, initial: R.distinct(R.int(1, n), 0, n - 1) }; },
    s(I, T) { const n = I.graph.length, d = DSU(n); for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (I.graph[i][j]) d.u(i, j); const inf = {}; I.initial.forEach(x => inf[d.f(x)] = (inf[d.f(x)] || 0) + 1); let best = -1, save = -1; I.initial.slice().sort((a, b) => a - b).forEach(x => { const r = d.f(x), s = inf[r] === 1 ? d.sz[r] : 0; T.at({ node: x, componentSize: d.sz[r], infectedInIt: inf[r] }); T.n('Nodes saved by removing it?', s, 'Only if it is the sole infected node.'); if (s > save) { save = s; best = x; } }); return best; }
  });

  D('minimize-malware-spread-ii', {
    t: 'Minimize Malware Spread II',
    r: 'Removing a node deletes it from the graph. Union the clean nodes; for each clean component, note which initial nodes touch it. A component touched by exactly one initial node is saved by removing that node; pick the node saving most (smallest index on ties).',
    g: R => { const n = R.int(2, 6), e = R.edges(n, R.int(1, 6)), g = Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => +(i === j))); e.forEach(([a, b]) => g[a][b] = g[b][a] = 1); return { graph: g, initial: R.distinct(R.int(1, n - 1), 0, n - 1) }; },
    s(I, T) { const n = I.graph.length, ini = new Set(I.initial); const spread = rm => { const seen = new Set(), q = I.initial.filter(x => x !== rm); q.forEach(x => seen.add(x)); while (q.length) { const u = q.shift(); for (let v = 0; v < n; v++) if (I.graph[u][v] && v !== rm && !seen.has(v)) { seen.add(v); q.push(v); } } return seen.size; }; let best = -1, bv = Infinity; [...ini].sort((a, b) => a - b).forEach(x => { const v = spread(x); T.at({ removed: x }); T.n('Infected count after removing it?', v, 'Spread without this node.'); if (v < bv) { bv = v; best = x; } }); return best; }
  });

  D('most-stones-removed-with-same-row-or-column', {
    t: 'Most Stones Removed with Same Row or Column',
    r: 'Stones sharing a row or column form components; each component can be reduced to one stone. Union row x with column y (as separate keys) per stone; answer = stones − components.',
    g: R => { const s = new Set(); for (let i = 0; i < R.int(1, 7); i++) s.add(R.int(0, 3) + ',' + R.int(0, 3)); return { stones: [...s].map(x => x.split(',').map(Number)) }; },
    s(I, T) { const res = (() => { const d = MapDSU(); I.stones.forEach(([x, y]) => d.u('r' + x, 'c' + y)); const roots = new Set(I.stones.map(([x]) => d.f('r' + x))); T.at({ stones: A(I.stones.map(s => `(${s})`)) }); T.n('Distinct rows used?', new Set(I.stones.map(s => s[0])).size, 'Each row is a node.'); T.n('Components?', roots.size, 'Union row with column.'); return I.stones.length - roots.size; })(); T.n('Most stones removed?', res, 'Stones minus components.'); return res; }
  });

  D('largest-component-size-by-common-factor', {
    t: 'Largest Component Size by Common Factor',
    r: 'Union each number with each of its prime factors (factor nodes act as hubs). The largest component counts only array numbers.',
    g: R => ({ nums: R.distinct(R.int(1, 6), 1, 40) }),
    s(I, T) { const d = MapDSU(); I.nums.forEach((x, i) => { let v = x; const ps = []; for (let p = 2; p * p <= v; p++) if (v % p === 0) { ps.push(p); while (v % p === 0) v /= p; } if (v > 1) ps.push(v); ps.forEach(p => d.u('n' + x, 'p' + p)); d.f('n' + x); if (i < 5) { T.at({ num: x }); T.n('How many distinct prime factors?', ps.length, 'It joins each of their hubs.'); } }); const c = {}; I.nums.forEach(x => { const r = d.f('n' + x); c[r] = (c[r] || 0) + 1; }); return Math.max(...Object.values(c)); }
  });

  D('regions-cut-by-slashes', {
    t: 'Regions Cut By Slashes',
    r: 'Split each cell into 4 triangles (top, right, bottom, left). " " unions all four, "/" unions top-left and bottom-right, "\\" unions top-right and bottom-left; always union with neighboring cells\' facing triangles. Count components.',
    g: R => { const n = R.int(1, 3); return { grid: Array.from({ length: n }, () => R.str(n, ' /\\')) }; },
    s(I, T) { const res = (() => { const n = I.grid.length, d = DSU(4 * n * n), id = (i, j, k) => 4 * (i * n + j) + k; for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) { const c = I.grid[i][j]; if (c === ' ') { d.u(id(i, j, 0), id(i, j, 1)); d.u(id(i, j, 1), id(i, j, 2)); d.u(id(i, j, 2), id(i, j, 3)); } else if (c === '/') { d.u(id(i, j, 0), id(i, j, 3)); d.u(id(i, j, 1), id(i, j, 2)); } else { d.u(id(i, j, 0), id(i, j, 1)); d.u(id(i, j, 2), id(i, j, 3)); } if (i + 1 < n) d.u(id(i, j, 2), id(i + 1, j, 0)); if (j + 1 < n) d.u(id(i, j, 1), id(i, j + 1, 3)); } T.at({ grid: G(I.grid.map(r => [...r].map(c => c === ' ' ? '·' : c))) }); T.n('Triangles in total?', 4 * n * n, '4 per cell.'); T.n('Slashes in the grid?', I.grid.join('').replace(/ /g, '').length, 'Each one splits a cell in two.'); return d.comps(); })(); T.n('Regions?', res, 'Connected groups of triangles.'); return res; }
  });

  D('satisfiability-of-equality-equations', {
    t: 'Satisfiability of Equality Equations',
    r: 'First union both sides of every "==" equation. Then every "!=" equation must have its sides in different groups.',
    g: R => ({ equations: Array.from({ length: R.int(1, 5) }, () => R.pick(['a', 'b', 'c']) + R.pick(['==', '!=']) + R.pick(['a', 'b', 'c'])) }),
    s(I, T) { const res = (() => { const d = DSU(26), c = s => s.charCodeAt(0) - 97; I.equations.filter(e => e[1] === '=').forEach(e => d.u(c(e[0]), c(e[3]))); for (const e of I.equations.filter(e => e[1] === '!')) { const bad = d.f(c(e[0])) === d.f(c(e[3])); T.at({ equation: e }); T.yn('Are both sides forced equal?', bad, 'Then this "!=" is violated.'); if (bad) return false; } return true; })(); T.yn('Can all equations hold?', res, 'No not-equal pair shares a group.'); return res; }
  });

  D('lexicographically-smallest-equivalent-string', {
    t: 'Lexicographically Smallest Equivalent String',
    r: 'Union s1[i] with s2[i], always keeping the smaller letter as the root. Map each letter of baseStr to its root.',
    g: R => { const n = R.int(1, 5); return { s1: R.str(n, 'abcde'), s2: R.str(n, 'abcde'), baseStr: R.str(R.int(1, 5), 'abcdef') }; },
    s(I, T) { const p = Array.from({ length: 26 }, (_, i) => i), f = x => p[x] === x ? x : (p[x] = f(p[x])); for (let i = 0; i < I.s1.length; i++) { const a = f(I.s1.charCodeAt(i) - 97), b = f(I.s2.charCodeAt(i) - 97); if (a !== b) p[Math.max(a, b)] = Math.min(a, b); } return [...I.baseStr].map((ch, i) => { const r = String.fromCharCode(97 + f(ch.charCodeAt(0) - 97)); if (i < 5) { T.at({ base: A([...I.baseStr], { i }) }); T.c(`Smallest equivalent of "${ch}"?`, [...new Set([ch, r, 'a'])], r, 'Root of its group.'); } return r; }).join(''); }
  });

  D('the-earliest-moment-when-everyone-become-friends', {
    t: 'The Earliest Moment When Everyone Become Friends',
    r: 'Sort logs by time and union friends; the moment the number of components reaches 1 is the answer (−1 if never).',
    g: R => { const n = R.int(2, 5), t = R.distinct(R.int(1, 7), 0, 20); return { logs: R.shuffle(t.map(x => { const a = R.int(0, n - 1); let b = R.int(0, n - 2); if (b >= a) b++; return [x, a, b]; })), n }; },
    s(I, T) { const d = DSU(I.n); let c = I.n; for (const [t, a, b] of I.logs.slice().sort((x, y) => x[0] - y[0])) { if (d.u(a, b)) c--; T.at({ time: t, pair: `${a} to ${b}` }); T.n('Friend groups now?', c, 'Merged if they were apart.'); if (c === 1) return t; } return -1; }
  });

  D('path-with-maximum-minimum-value', {
    t: 'Path With Maximum Minimum Value',
    r: 'Add cells from highest to lowest value, unioning with added neighbors; when start and end connect, the current value is the answer.',
    g: R => ({ grid: R.grid(R.int(1, 3), R.int(1, 3), 0, 9) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, d = DSU(m * n), on = new Set(), cells = []; g.forEach((r, i) => r.forEach((v, j) => cells.push([v, i, j]))); cells.sort((a, b) => b[0] - a[0]); let k = 0; for (const [v, i, j] of cells) { on.add(i * n + j); for (const [a, b] of D4) { const x = i + a, y = j + b; if (x >= 0 && y >= 0 && x < m && y < n && on.has(x * n + y)) d.u(i * n + j, x * n + y); } const ok = on.has(0) && on.has(m * n - 1) && d.f(0) === d.f(m * n - 1); if (k++ < 5 || ok) { T.at({ grid: G(g, { hl: [[i, j]] }), value: v }); T.yn('Start and end connected?', ok, 'Using only cells at least value.'); } if (ok) return v; } }
  });

  D('connecting-cities-with-minimum-cost', {
    t: 'Connecting Cities With Minimum Cost',
    r: 'Kruskal: sort connections by cost and take each one that joins two different components; if fewer than n − 1 edges get used, return −1.',
    g: R => { const n = R.int(1, 5); return { n, connections: R.edges(n, R.int(1, 6), { base: 1, w: [0, 9], conn: R.chance(0.7) }) }; },
    s(I, T) { const d = DSU(I.n + 1); let w = 0, c = 0; I.connections.slice().sort((a, b) => a[2] - b[2]).forEach(([a, b, x]) => { const ok = d.u(a, b); if (ok) { w += x; c++; } T.at({ edge: `${a} to ${b} ($${x})`, total: w }); T.yn('Take this edge?', ok, 'Only if it joins two components.'); }); return c === I.n - 1 ? w : -1; }
  });

  D('optimize-water-distribution-in-a-village', {
    t: 'Optimize Water Distribution in a Village',
    r: 'Add a virtual node 0 with an edge of cost wells[i] to every house i. The answer is the MST weight of this graph (Kruskal).',
    g: R => { const n = R.int(2, 4); return { n, wells: R.ints(n, 0, 6), pipes: R.edges(n, R.int(1, 4), { base: 1, w: [0, 6] }) }; },
    s(I, T) { const e = [...I.wells.map((w, i) => [0, i + 1, w]), ...I.pipes].sort((a, b) => a[2] - b[2]), d = DSU(I.n + 1); let tot = 0, k = 0; e.forEach(([a, b, w]) => { const ok = d.u(a, b); if (ok) tot += w; if (k++ < 6) { T.at({ edge: a === 0 ? `well @ ${b} ($${w})` : `pipe ${a} to ${b} ($${w})` }); T.yn('Take it?', ok, 'Kruskal on the graph with a virtual node.'); } }); return tot; }
  });

  D('smallest-string-with-swaps', {
    t: 'Smallest String With Swaps',
    r: 'Indices connected by swap pairs form groups that can be permuted freely. For each group, sort its letters and write them into its sorted indices.',
    g: R => { const n = R.int(1, 6); return { s: R.str(n, 'abcd'), pairs: Array.from({ length: R.int(0, 3) }, () => [R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const n = I.s.length, d = DSU(n); I.pairs.forEach(([a, b]) => d.u(a, b)); const g = {}; for (let i = 0; i < n; i++) (g[d.f(i)] = g[d.f(i)] || []).push(i); const out = []; Object.values(g).forEach(ix => { const ch = ix.map(i => I.s[i]).sort(); ix.forEach((i, k) => out[i] = ch[k]); }); T.at({ s: I.s }); T.n('How many swap groups?', Object.keys(g).length, 'Connected index sets.'); for (let i = 0; i < Math.min(n, 4); i++) { T.at({ s: A([...I.s], { i }) }); T.c(`Letter at index ${i}?`, [...new Set([out[i], I.s[i], 'a'])], out[i], 'Smallest available in its group, in order.'); } return out.join(''); }
  });

  D('synonymous-sentences', {
    t: 'Synonymous Sentences',
    r: 'Union synonyms into groups. For each word in the text, branch over every word in its group (sorted); collect all sentences and sort them.',
    g: R => ({ synonyms: Array.from({ length: R.int(0, 3) }, () => R.shuffle(['joy', 'glad', 'happy', 'sad', 'blue']).slice(0, 2)), text: Array.from({ length: R.int(1, 4) }, () => R.pick(['I', 'am', 'happy', 'sad', 'today'])).join(' ') }),
    s(I, T) { const d = MapDSU(); I.synonyms.forEach(([a, b]) => d.u(a, b)); const words = new Set(I.synonyms.flat()), opts = I.text.split(' ').map(w => words.has(w) ? [...words].filter(x => d.f(x) === d.f(w)).sort() : [w]); opts.forEach((o, i) => { if (i < 4) { T.at({ word: I.text.split(' ')[i] }); T.n('Choices for this word?', o.length, 'Size of its synonym group.'); } }); let out = ['']; opts.forEach((o, i) => { out = out.flatMap(p => o.map(w => i ? p + ' ' + w : w)); }); return out.sort(); }
  });

  D('number-of-operations-to-make-network-connected', {
    t: 'Number of Operations to Make Network Connected',
    r: 'You need at least n − 1 cables. If you have them, every redundant cable can link two components, so the answer is (components − 1).',
    g: R => { const n = R.int(1, 6); return { n, connections: R.edges(n, R.int(1, 7)) }; },
    s(I, T) { const res = (() => { T.at({ graph: GR(I.n, I.connections) }); T.n('Cables?', I.connections.length, 'Each one is an edge.'); T.yn('At least n minus 1 cables?', I.connections.length >= I.n - 1, 'Otherwise impossible.'); if (I.connections.length < I.n - 1) return -1; const d = DSU(I.n); I.connections.forEach(([a, b]) => d.u(a, b)); T.n('Components?', d.comps(), 'Union every cable.'); return d.comps() - 1; })(); T.n('Fewest operations? (−1 if impossible)', res, 'Components minus 1.'); return res; }
  });

  D('find-critical-and-pseudo-critical-edges-in-minimum-spanning-tree', {
    t: 'Find Critical and Pseudo-Critical Edges in Minimum Spanning Tree',
    r: 'Compute the MST weight W. An edge is critical if the MST without it is heavier (or impossible). Otherwise it is pseudo-critical if forcing it into the MST still gives W.',
    g: R => { const n = R.int(2, 5); return { n, edges: R.edges(n, R.int(n - 1, n + 2), { conn: true, w: [1, 4] }).map(([a, b, w]) => a < b ? [a, b, w] : [b, a, w]) }; },
    cmp: (o, e) => Array.isArray(o) && o.length === 2 && JSON.stringify(o.map(x => x.slice().sort((a, b) => a - b))) === JSON.stringify(e.map(x => x.slice().sort((a, b) => a - b))),
    s(I, T) { const W = kruskal(I.n, I.edges), cr = [], ps = []; T.at({ graph: GR(I.n, I.edges) }); T.n('MST weight?', W, 'Kruskal.'); I.edges.forEach((e, i) => { const wo = kruskal(I.n, I.edges, i); if (wo > W) cr.push(i); else if (kruskal(I.n, I.edges, -1, i) === W) ps.push(i); if (i < 4) { T.at({ edge: `${e[0]} to ${e[1]} (${e[2]})` }); T.c('Kind of edge?', ['critical', 'pseudo-critical', 'neither'], cr.includes(i) ? 'critical' : ps.includes(i) ? 'pseudo-critical' : 'neither', 'Remove it, then force it.'); } }); return [cr, ps]; }
  });

  D('detect-cycles-in-2d-grid', {
    t: 'Detect Cycles in 2D Grid',
    r: 'Union each cell with its same-letter right and down neighbors. If two cells are already in the same group when you union them, a cycle exists.',
    g: R => ({ grid: R.grid(R.int(1, 4), R.int(1, 4), 0, 0).map(r => r.map(() => R.pick(['a', 'a', 'b']))) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, d = DSU(m * n); let k = 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) for (const [x, y] of [[i, j + 1], [i + 1, j]]) { if (x >= m || y >= n || g[x][y] !== g[i][j]) continue; const ok = d.u(i * n + j, x * n + y); if (k++ < 5 || !ok) { T.at({ grid: G(g, { hl: [[i, j], [x, y]] }) }); T.yn('Already in the same group?', !ok, 'Then this edge closes a cycle.'); } if (!ok) return true; } return false; }
  });

  D('find-latest-group-of-size-m', {
    t: 'Find Latest Group of Size M',
    r: 'Set bits in order, merging with neighbor runs (union-find or run-length ends). Track how many runs have length exactly m; the last step where that count is positive is the answer.',
    g: R => { const n = R.int(1, 7); return { arr: R.perm(n).map(x => x + 1), m: R.int(1, n) }; },
    s(I, T) { const n = I.arr.length, len = Array(n + 2).fill(0); let cntM = 0, ans = -1; I.arr.forEach((x, step) => { const l = len[x - 1], r = len[x + 1], L = l + r + 1; if (l === I.m) cntM--; if (r === I.m) cntM--; if (L === I.m) cntM++; len[x - l] = len[x + r] = L; if (cntM > 0) ans = step + 1; if (step < 6) { T.at({ setBit: x, runLength: L }); T.n('Runs of length exactly m now?', cntM, 'Merging changes the counts.'); } }); return ans; }
  });

  D('remove-max-number-of-edges-to-keep-graph-fully-traversable', {
    t: 'Remove Max Number of Edges to Keep Graph Fully Traversable',
    r: 'Use type-3 (shared) edges first in both Alice\'s and Bob\'s union-finds, then type 1 for Alice and type 2 for Bob. Count edges actually used; if either is not connected, −1; else total − used.',
    g: R => { const n = R.int(1, 4), e = []; const seen = new Set(); for (let i = 0; i < R.int(1, 7); i++) { const t = R.int(1, 3), u = R.int(1, n), v = R.int(1, n); if (u >= v || seen.has(`${t},${u},${v}`)) continue; seen.add(`${t},${u},${v}`); e.push([t, u, v]); } return { n, edges: e }; },
    s(I, T) { const res = (() => { const a = DSU(I.n + 1), b = DSU(I.n + 1); let used = 0, k = 0; for (const t of [3, 1, 2]) I.edges.filter(e => e[0] === t).forEach(([, u, v]) => { const ok = t === 3 ? (a.u(u, v) | b.u(u, v)) > 0 : t === 1 ? a.u(u, v) : b.u(u, v); if (ok) used++; if (k++ < 6) { T.at({ edge: `type ${t}: ${u} and ${v}`, used }); T.yn('Is this edge needed?', !!ok, 'It joins two components for someone.'); } }); const ca = new Set(Array.from({ length: I.n }, (_, i) => a.f(i + 1))).size, cb = new Set(Array.from({ length: I.n }, (_, i) => b.f(i + 1))).size; return ca === 1 && cb === 1 ? I.edges.length - used : -1; })(); T.n('Edges removed? (−1 if impossible)', res, 'All edges minus the needed ones.'); return res; }
  });

  D('graph-connectivity-with-threshold', {
    t: 'Graph Connectivity With Threshold',
    r: 'For each divisor z > threshold, union all its multiples (z, 2z, 3z, …). Two cities are connected exactly when they share a root.',
    g: R => { const n = R.int(2, 12); return { n, threshold: R.int(0, 4), queries: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(1, n); let b = R.int(1, n - 1); if (b >= a) b++; return [a, b]; }) }; },
    s(I, T) { const d = DSU(I.n + 1); for (let z = I.threshold + 1; z <= I.n; z++) for (let m = 2 * z; m <= I.n; m += z) d.u(z, m); return I.queries.map(([a, b], i) => { const ok = d.f(a) === d.f(b); if (i < 4) { T.at({ query: `${a} and ${b}`, gcd: gcd(a, b), threshold: I.threshold }); T.yn('Connected?', ok, 'Via a chain of shared divisors > threshold.'); } return ok; }); }
  });

  D('path-with-minimum-effort', {
    t: 'Path With Minimum Effort',
    r: 'Sort all neighbor edges by |height difference| and union them in order (Kruskal-style); the first edge that connects start and end gives the minimum effort.',
    g: R => ({ heights: R.grid(R.int(1, 3), R.int(1, 3), 1, 9) }),
    s(I, T) { const g = I.heights, m = g.length, n = g[0].length; if (m * n === 1) { T.at({ heights: G(g) }); T.n('Effort?', 0, 'Already there.'); return 0; } const e = []; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { if (i + 1 < m) e.push([Math.abs(g[i][j] - g[i + 1][j]), i * n + j, (i + 1) * n + j]); if (j + 1 < n) e.push([Math.abs(g[i][j] - g[i][j + 1]), i * n + j, i * n + j + 1]); } e.sort((a, b) => a[0] - b[0]); const d = DSU(m * n); let k = 0; for (const [w, a, b] of e) { d.u(a, b); const ok = d.f(0) === d.f(m * n - 1); if (k++ < 5 || ok) { T.at({ heights: G(g, { hl: [[Math.floor(a / n), a % n], [Math.floor(b / n), b % n]] }), diff: w }); T.yn('Start and end connected now?', ok, 'Edges added by increasing difference.'); } if (ok) return w; } }
  });

  D('rank-transform-of-a-matrix', {
    t: 'Rank Transform of a Matrix',
    r: 'Process values in increasing order. Equal values sharing a row or column must share a rank, so union them. Each group\'s rank = 1 + max of the current row or column maxima over its cells; then update those maxima.',
    g: R => ({ matrix: R.grid(R.int(1, 3), R.int(1, 3), 1, 5) }),
    s(I, T) { const M = I.matrix, m = M.length, n = M[0].length, rowMax = Array(m).fill(0), colMax = Array(n).fill(0), out = M.map(r => r.map(() => 0)), byV = {}; M.forEach((r, i) => r.forEach((v, j) => (byV[v] = byV[v] || []).push([i, j]))); let k = 0; Object.keys(byV).map(Number).sort((a, b) => a - b).forEach(v => { const cells = byV[v], d = MapDSU(); cells.forEach(([i, j]) => d.u('r' + i, 'c' + j)); const grp = {}; cells.forEach(c => (grp[d.f('r' + c[0])] = grp[d.f('r' + c[0])] || []).push(c)); Object.values(grp).forEach(cs => { const rk = 1 + Math.max(...cs.map(([i, j]) => Math.max(rowMax[i], colMax[j]))); cs.forEach(([i, j]) => { out[i][j] = rk; }); cs.forEach(([i, j]) => { rowMax[i] = Math.max(rowMax[i], rk); colMax[j] = Math.max(colMax[j], rk); }); if (k++ < 5) { T.at({ matrix: G(M, { hl: cs }) }); T.n(`Rank of this group of ${v}s?`, rk, '1 + max rank already in their rows or cols.'); } }); }); return out; }
  });

  D('checking-existence-of-edge-length-limited-paths', {
    t: 'Checking Existence of Edge Length Limited Paths',
    r: 'Offline: sort queries by limit and edges by length. For each query, union all edges shorter than its limit, then check whether p and q share a root.',
    g: R => { const n = R.int(2, 5); return { n, edgeList: Array.from({ length: R.int(1, 5) }, () => { const a = R.int(0, n - 1); let b = R.int(0, n - 2); if (b >= a) b++; return [a, b, R.int(1, 9)]; }), queries: Array.from({ length: R.int(1, 3) }, () => { const a = R.int(0, n - 1); let b = R.int(0, n - 2); if (b >= a) b++; return [a, b, R.int(1, 10)]; }) }; },
    s(I, T) { const e = I.edgeList.slice().sort((a, b) => a[2] - b[2]), ord = I.queries.map((q, i) => i).sort((a, b) => I.queries[a][2] - I.queries[b][2]), d = DSU(I.n), out = []; let p = 0; ord.forEach((qi, k) => { const [a, b, lim] = I.queries[qi]; while (p < e.length && e[p][2] < lim) { d.u(e[p][0], e[p][1]); p++; } out[qi] = d.f(a) === d.f(b); if (k < 4) { T.at({ query: `${a} to ${b}, limit ${lim}` }); T.n('Edges added so far?', p, 'All with length < limit.'); } }); return out; }
  });

  D('minimize-hamming-distance-after-swap-operations', {
    t: 'Minimize Hamming Distance After Swap Operations',
    r: 'Indices linked by allowed swaps form groups whose source values can be rearranged freely. In each group, match as many target values as possible via a multiset; unmatched ones count toward the distance.',
    g: R => { const n = R.int(1, 6); return { source: R.ints(n, 1, 4), target: R.ints(n, 1, 4), allowedSwaps: Array.from({ length: R.int(0, 3) }, () => { const a = R.int(0, n - 1); return [a, R.int(0, n - 1)]; }).filter(([a, b]) => a !== b) }; },
    s(I, T) { const n = I.source.length, d = DSU(n); I.allowedSwaps.forEach(([a, b]) => d.u(a, b)); const pool = {}; for (let i = 0; i < n; i++) { const r = d.f(i); pool[r] = pool[r] || {}; pool[r][I.source[i]] = (pool[r][I.source[i]] || 0) + 1; } let dist = 0; for (let i = 0; i < n; i++) { const pl = pool[d.f(i)], ok = (pl[I.target[i]] || 0) > 0; if (ok) pl[I.target[i]]--; else dist++; if (i < 5) { T.at({ target: A(I.target, { i }), groupPool: K({ ...pl }) }); T.yn('Can this target value be matched?', ok, 'If its group still has one.'); } } return dist; }
  });

  D('last-day-where-you-can-still-cross', {
    t: 'Last Day Where You Can Still Cross',
    r: 'Reverse time: start fully flooded and turn cells back into land from the last day backward, unioning land neighbors plus virtual top and bottom nodes. The first moment top and bottom connect gives the last crossable day.',
    g: R => { const row = R.int(2, 3), col = R.int(2, 3), cells = R.perm(row * col).map(x => [Math.floor(x / col) + 1, x % col + 1]); return { row, col, cells }; },
    s(I, T) { const { row, col, cells } = I, N = row * col, d = DSU(N + 2), land = new Set(); for (let day = N - 1; day >= 0; day--) { const [r, c] = cells[day], id = (r - 1) * col + (c - 1); land.add(id); if (r === 1) d.u(id, N); if (r === row) d.u(id, N + 1); for (const [a, b] of D4) { const x = r - 1 + a, y = c - 1 + b; if (x >= 0 && y >= 0 && x < row && y < col && land.has(x * col + y)) d.u(id, x * col + y); } const ok = d.f(N) === d.f(N + 1); T.at({ restored: `(${r}, ${c})`, day }); T.yn('Can you cross with this land restored?', ok, 'Top joined to bottom.'); if (ok) return day; } return 0; }
  });

  D('gcd-sort-of-an-array', {
    t: 'GCD Sort of an Array',
    r: 'Union each number with its prime factors; numbers in the same group can be permuted. The array is sortable exactly when each nums[i] is in the same group as sorted[i].',
    g: R => ({ nums: R.ints(R.int(1, 6), 2, 20) }),
    s(I, T) { const d = MapDSU(); I.nums.forEach(x => { let v = x; for (let p = 2; p * p <= v; p++) if (v % p === 0) { d.u('n' + x, 'p' + p); while (v % p === 0) v /= p; } if (v > 1) d.u('n' + x, 'p' + v); }); const s = I.nums.slice().sort((a, b) => a - b); for (let i = 0; i < s.length; i++) { const ok = s[i] === I.nums[i] || d.f('n' + s[i]) === d.f('n' + I.nums[i]); T.at({ nums: A(I.nums, { i }), sorted: A(s, { i }) }); T.yn('Can these two values trade places?', ok, 'Same factor group.'); if (!ok) return false; } return true; }
  });

  D('process-restricted-friend-requests', {
    t: 'Process Restricted Friend Requests',
    r: 'For each request, find the roots of u and v. Accept it unless some restriction (x, y) has {root(x), root(y)} = {root(u), root(v)}; on acceptance, union them.',
    g: R => { const n = R.int(2, 5), pr = () => { const a = R.int(0, n - 1); let b = R.int(0, n - 2); if (b >= a) b++; return [a, b]; }; return { n, restrictions: Array.from({ length: R.int(0, 2) }, pr), requests: Array.from({ length: R.int(1, 5) }, pr) }; },
    s(I, T) { const d = DSU(I.n); return I.requests.map(([u, v], i) => { const a = d.f(u), b = d.f(v), ok = a === b || !I.restrictions.some(([x, y]) => { const p = d.f(x), q = d.f(y); return (p === a && q === b) || (p === b && q === a); }); if (ok) d.u(u, v); if (i < 5) { T.at({ request: `${u}, ${v}`, restrictions: A(I.restrictions.map(r => r.join('✕'))) }); T.yn('Accept?', ok, 'Merging must not join a restricted pair.'); } return ok; }); }
  });

  D('find-all-people-with-secret', {
    t: 'Find All People With Secret',
    r: 'Process meetings grouped by time. Union the participants within the group; afterwards reset everyone in the group who is not connected to person 0, so the secret does not leak across time.',
    g: R => { const n = R.int(2, 6), pr = () => { const a = R.int(0, n - 1); let b = R.int(0, n - 2); if (b >= a) b++; return [a, b]; }; return { n, meetings: Array.from({ length: R.int(1, 5) }, () => [...pr(), R.int(1, 4)]), firstPerson: R.int(1, n - 1) }; },
    cmp: 'set',
    s(I, T) { const d = DSU(I.n); d.u(0, I.firstPerson); const by = {}; I.meetings.forEach(([x, y, t]) => (by[t] = by[t] || []).push([x, y])); Object.keys(by).map(Number).sort((a, b) => a - b).forEach(t => { const ms = by[t]; ms.forEach(([x, y]) => d.u(x, y)); ms.flat().forEach(p => { if (d.f(p) !== d.f(0)) { d.p[p] = p; d.sz[p] = 1; } }); T.at({ time: t, meetings: A(ms.map(m => `${m[0]} and ${m[1]} at ${m[2]}`)) }); T.n('People who know the secret now?', Array.from({ length: I.n }, (_, i) => i).filter(i => d.f(i) === d.f(0)).length, 'Only groups touching person 0 keep it.'); }); return Array.from({ length: I.n }, (_, i) => i).filter(i => d.f(i) === d.f(0)); }
  });
})();
