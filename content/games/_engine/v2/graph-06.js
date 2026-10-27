/* v2 games: graph (06). Guides scored in the 4042–4095 pass. */
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

  const NEXTC = { R: 'B', B: 'W', W: 'R' };
  const adjOf = (n, e) => { const a = Array.from({ length: n }, () => []); e.forEach(([u, v]) => { a[u].push(v); a[v].push(u); }); return a; };
  // '' when r is a valid root, else the reason it fails.
  const rootWhy = (edges, colors, r) => { const n = colors.length, adj = adjOf(n, edges), dep = Array(n).fill(-1), q = [r]; dep[r] = 0; for (let i = 0; i < q.length; i++) { const u = q[i], ch = adj[u].filter(v => dep[v] < 0); if (ch.length > 2) return `Node ${u} would have ${ch.length} children.`; for (const v of ch) { dep[v] = dep[u] + 1; if (colors[v] !== NEXTC[colors[u]]) return `Node ${v} is ${colors[v]}, but a child of a ${colors[u]} node must be ${NEXTC[colors[u]]}.`; q.push(v); } } return ''; };

  D('minimum-cost-path-with-at-most-k-turns', {
    t: 'Minimum Cost Path with At Most K Turns',
    r: 'Run Dijkstra on states (cell, last direction, turns used). A move in a new direction uses a turn, and states past k turns are dropped. The answer is the cheapest state at the target.',
    g: R => { const m = R.int(2, 4), n = R.int(2, 4); return { grid: R.grid(m, n, 0, 9), k: R.int(0, Math.min(m, n) - 1) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, K = I.k, DR = [[0, 1], [1, 0], [0, -1], [-1, 0]], dist = new Map(), key = (r, c, d, t) => r + ',' + c + ',' + d + ',' + t, best = Array.from({ length: m }, () => Array(n).fill(Infinity)), pq = [[g[0][0], 0, 0, 4, 0]]; dist.set(key(0, 0, 4, 0), g[0][0]); while (pq.length) { let bi = 0; for (let i = 1; i < pq.length; i++) if (pq[i][0] < pq[bi][0]) bi = i; const [c0, r, c, d, t] = pq.splice(bi, 1)[0]; if (c0 > dist.get(key(r, c, d, t))) continue; best[r][c] = Math.min(best[r][c], c0); for (let nd = 0; nd < 4; nd++) { const nr = r + DR[nd][0], nc = c + DR[nd][1]; if (nr < 0 || nc < 0 || nr >= m || nc >= n) continue; const nt = t + (d !== 4 && nd !== d ? 1 : 0); if (nt > K) continue; const nk = key(nr, nc, nd, nt), nv = c0 + g[nr][nc]; if (!dist.has(nk) || nv < dist.get(nk)) { dist.set(nk, nv); pq.push([nv, nr, nc, nd, nt]); } } } const val = (r, c) => best[r][c] === Infinity ? -1 : best[r][c], cells = [[0, n - 1], [m - 1, 0]]; if (m > 2 || n > 2) cells.push([1, 1]); cells.forEach(([r, c]) => { const v = val(r, c); T.at({ grid: G(g.map(x => x.slice()), { hl: [[0, 0], [r, c]] }), k: K }); T.n(`Cheapest cost to reach (${r}, ${c}) with at most ${K} turns (type -1 if impossible)?`, v, v < 0 ? 'Every route needs more turns than allowed.' : 'Dijkstra over (cell, direction, turns); a cell is paid each time you enter it.'); }); const ans = val(m - 1, n - 1); T.at({ grid: G(g.map(x => x.slice()), { hl: [[0, 0], [m - 1, n - 1]] }), k: K }); T.n('Cheapest cost to reach the bottom-right corner (type -1 if impossible)?', ans, ans < 0 ? 'No route fits within k turns.' : 'The cheapest target state over every direction and turn count.'); return ans; }
  });

  D('find-root-of-a-colored-tree', {
    t: 'Find Root of a Colored Tree',
    r: 'Orient the tree away from a candidate root. Each child must take the next colour in the cycle R → B → W → R, and no node may have more than two children. Only a node with no neighbour of the colour before its own can be the root.',
    cmp: (o, e, I) => e === -1 ? o === -1 : (o !== -1 && rootWhy(I.edges, I.colors, o) === ''),
    g: R => { let n = R.int(3, 7), e = null; for (let guard = 0; guard < 60; guard++) { e = R.edges(n, n - 1, { conn: true }); if (adjOf(n, e).every(x => x.length <= 3)) break; e = null; } if (!e) e = range(1, n).map(i => [i - 1, i]); const col = 'RBW'; let c; if (R.chance(0.65)) { const r = R.int(0, n - 1), adj = adjOf(n, e), dep = Array(n).fill(-1), q = [r]; dep[r] = 0; for (let i = 0; i < q.length; i++) for (const v of adj[q[i]]) if (dep[v] < 0) { dep[v] = dep[q[i]] + 1; q.push(v); } const s = R.int(0, 2); c = dep.map(x => col[(x + s) % 3]).join(''); if (R.chance(0.3)) { const i = R.int(0, n - 1); c = c.slice(0, i) + col[R.int(0, 2)] + c.slice(i + 1); } } else c = Array.from({ length: n }, () => col[R.int(0, 2)]).join(''); return { edges: e, colors: c }; },
    s(I, T) { const n = I.colors.length, tag = {}; for (let i = 0; i < n; i++) tag[String(i)] = I.colors[i]; let ans = -1; for (let u = 0; u < n; u++) { const why = rootWhy(I.edges, I.colors, u); if (!why && ans < 0) ans = u; if (u < 8) { T.v(GR(n, I.edges, { cls: { [String(u)]: 'hit' }, tag })); T.yn(`Can node ${u} (${I.colors[u]}) be the root?`, !why, why || 'Every child takes the next colour and nobody has three children.'); } } T.v(GR(n, I.edges, { tag })); T.yn('Is there any valid root?', ans >= 0, ans >= 0 ? `Node ${ans} works.` : 'Every candidate breaks the colour cycle or the two-children rule.'); return ans; }
  });
})();
