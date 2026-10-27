/* v2 games: graph (7). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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

  const isPalN = x => isPal(String(x));
  const primesTo = n => { const s = Array(n + 1).fill(true), out = []; for (let i = 2; i <= n; i++) if (s[i]) { out.push(i); for (let j = i * i; j <= n; j += i) s[j] = false; } return out; };


  const adjOf = (n, edges, dir) => { const g = Array.from({ length: n }, () => []); edges.forEach(([u, v]) => { g[u].push(v); if (!dir) g[v].push(u); }); g.forEach(l => l.sort((x, y) => x - y)); return g; };

  D('basic-operations-on-graphs', {
    t: 'Graph Operations on Adjacency Lists',
    r: 'Store a directed graph as adjacency lists: adj[u] lists every v with an edge u to v. Adding an edge appends to one list. Checking an edge scans adj[u], O(degree). Removing a vertex deletes its own list and scrubs it from every other list.',
    exs: [{ in: { n: 3, edges: [[0, 1], [1, 2]], query: [0, 2], remove: 1 }, out: 0 }],
    g: R => { const n = R.int(4, 6); return { n, edges: R.edges(n, R.int(n, n + 3), { dir: true }), query: [R.int(0, n - 1), R.int(0, n - 1)], remove: R.int(0, n - 1) }; },
    s(I, T) { const g = adjOf(I.n, I.edges, true), [u, v] = I.query, x = I.remove; const view = () => K(g.map((l, i) => [String(i), l.join(', ') || '(none)'])); T.v(GR(I.n, I.edges, { dir: true }), view()); T.n(`How many entries are in adj[${u}]?`, g[u].length, 'Its out-degree.'); T.yn(`Is there an edge ${u} to ${v}?`, g[u].includes(v), `Scan adj[${u}].`); const left = I.edges.filter(e => e[0] !== x && e[1] !== x).length; T.v(GR(I.n, I.edges, { dir: true, cls: { [x]: 'bad' } }), view()); T.n(`Remove vertex ${x}: how many entries must be scrubbed from other vertices\' lists?`, I.edges.filter(e => e[1] === x && e[0] !== x).length, `Count edges pointing into ${x}.`); T.n(`How many edges remain after removing ${x}?`, left, 'Drop every edge that touches it.'); return left; }
  });

  D('graph-traversal', {
    t: 'Graph Traversal: BFS and DFS',
    r: 'From the start vertex, visit neighbors in increasing order. BFS uses a queue and finishes each level before the next. DFS goes as deep as it can along the first unvisited neighbor before backing up. Mark vertices visited so cycles do not loop forever.',
    exs: [{ in: { n: 4, edges: [[0, 1], [0, 2], [1, 3]], start: 0 }, out: [[0, 1, 2, 3], [0, 1, 3, 2]] }],
    g: R => { const n = R.int(5, 7); return { n, edges: R.edges(n, R.int(n - 1, n + 2), { conn: true }), start: 0 }; },
    s(I, T) { const g = adjOf(I.n, I.edges), s = I.start, bfs = [s], seen = new Set([s]); for (let i = 0; i < bfs.length; i++) for (const v of g[bfs[i]]) if (!seen.has(v)) { seen.add(v); bfs.push(v); } const dfs = [], vis = new Set(); (function go(u) { vis.add(u); dfs.push(u); g[u].forEach(v => { if (!vis.has(v)) go(v); }); })(s); T.v(GR(I.n, I.edges), K(g.map((l, i) => [String(i), l.join(', ')]))); [2, 3].forEach(k => { T.n(`BFS from ${s}: which vertex is visited ${k === 2 ? '2nd' : '3rd'}?`, bfs[k - 1], `BFS order: ${bfs.join(', ')}.`); T.n(`DFS from ${s}: which vertex is visited ${k === 2 ? '2nd' : '3rd'}?`, dfs[k - 1], `DFS order: ${dfs.join(', ')}.`); }); T.n('Last vertex visited by BFS?', bfs[bfs.length - 1], 'The far end of the last level.'); return [bfs, dfs]; }
  });

  D('graph', {
    t: 'Graph Storage: List vs Matrix',
    r: 'An undirected graph as an adjacency list stores each edge twice (once per end), using O(V + E) space. As an adjacency matrix it uses a V × V grid where M[u][v] = 1 if the edge exists: O(1) edge checks, O(V²) space.',
    exs: [{ in: { n: 4, edges: [[0, 1], [0, 2], [1, 3], [2, 3]] }, out: [[1, 2], [0, 3], [0, 3], [1, 2]] }],
    g: R => { const n = R.int(4, 6); return { n, edges: R.edges(n, R.int(n - 1, n + 2)) }; },
    s(I, T) { const g = adjOf(I.n, I.edges), M = Array.from({ length: I.n }, (_, i) => Array.from({ length: I.n }, (_, j) => g[i].includes(j) ? 1 : 0)), big = g.reduce((m, l, i) => l.length > g[m].length ? i : m, 0), [p, q] = [0, I.n - 1]; T.v(GR(I.n, I.edges)); T.n(`Degree of vertex ${big}?`, g[big].length, 'Count its edges.'); T.n('Total entries across all adjacency lists?', 2 * I.edges.length, 'Each undirected edge is stored at both ends.'); T.v(GR(I.n, I.edges), G(M, { hl: [[p, q]], label: 'matrix' })); T.n(`M[${p}][${q}]?`, M[p][q], M[p][q] ? 'The edge exists.' : 'No such edge.'); T.n('How many cells does the matrix have?', I.n * I.n, 'V × V.'); return g; }
  });
})();
