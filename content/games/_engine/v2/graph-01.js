/* v2 games: graphs (01). */
(function () {
  'use strict';
  const { D, A, G, K, Q, GR, Tr, TR } = LCGame.H;
  const DIRS = [[0, 1], [1, 0], [0, -1], [-1, 0]];
  const inG = (g, r, c) => r >= 0 && c >= 0 && r < g.length && c < g[0].length;
  const oneOff = (a, b) => { let d = 0; for (let i = 0; i < a.length; i++) if (a[i] !== b[i]) d++; return d === 1; };
  const roll = (mz, r, c, dr, dc) => { let d = 0; while (inG(mz, r + dr, c + dc) && mz[r + dr][c + dc] === 0) { r += dr; c += dc; d++; } return [r, c, d]; };
  const mazeGen = R => { const m = R.int(3, 5), n = R.int(3, 5), mz = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.25) ? 1 : 0)); const free = []; mz.forEach((row, r) => row.forEach((v, c) => { if (!v) free.push([r, c]); })); while (free.length < 2) { mz[0][0] = 0; mz[m - 1][n - 1] = 0; free.splice(0, free.length, [0, 0], [m - 1, n - 1]); } const [a, b] = R.shuffle(free); return { maze: mz, start: a, destination: b }; };
  const mazeDist = (mz, st, T) => { const m = mz.length, n = mz[0].length, d = Array.from({ length: m }, () => Array(n).fill(Infinity)); d[st[0]][st[1]] = 0; const done = new Set(); let asks = 0; for (;;) { let best = null; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (d[r][c] < Infinity && !done.has(r * n + c) && (!best || d[r][c] < d[best[0]][best[1]])) best = [r, c]; if (!best) break; const [r, c] = best; done.add(r * n + c); for (const [dr, dc] of DIRS) { const [x, y, k] = roll(mz, r, c, dr, dc); if (k && d[r][c] + k < d[x][y]) { d[x][y] = d[r][c] + k; if (T && asks < 5) { T.at({ maze: G(mz, { hl: [[r, c], [x, y]] }) }); T.n(`Distance to stop at (${x}, ${y}) via (${r}, ${c})?`, d[x][y], `${d[r][c]} + ${k} cells rolled.`); asks++; } } } } return d; };
  const wordGen = R => { const L = R.int(2, 3), w = () => R.str(L, 'abc'); const list = [...new Set(Array.from({ length: R.int(2, 7) }, w))]; return { beginWord: w(), endWord: R.chance(0.8) ? R.pick(list) : w(), wordList: list }; };
  const ladderBfs = (I, T) => { const words = [...new Set(I.wordList)], dist = new Map([[I.beginWord, 1]]); let lv = [I.beginWord], asks = 0; while (lv.length && !dist.has(I.endWord)) { const nx = []; for (const u of lv) for (const v of words) if (!dist.has(v) && oneOff(u, v)) { dist.set(v, dist.get(u) + 1); nx.push(v); } if (asks < 5) { T.at({ level: A(lv), words: A(words) }); T.n('How many new words are one letter away from this level?', nx.length, 'Unvisited dictionary words differing in one position.'); asks++; } lv = nx; } if (!asks) { T.at({ begin: I.beginWord, end: I.endWord }); T.yn('Is the end word reachable?', dist.has(I.endWord), 'BFS.'); } return dist; };
  const islands = (g, T) => { const m = g.length, n = g[0].length, seen = new Set(), out = []; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (g[r][c] === 1 && !seen.has(r * n + c)) { const cells = [], st = [[r, c]]; seen.add(r * n + c); while (st.length) { const [x, y] = st.pop(); cells.push([x, y]); for (const [dx, dy] of DIRS) { const a = x + dx, b = y + dy; if (inG(g, a, b) && g[a][b] === 1 && !seen.has(a * n + b)) { seen.add(a * n + b); st.push([a, b]); } } } out.push(cells); } return out; };
  const norm = cells => { const mr = Math.min(...cells.map(p => p[0])), mc = Math.min(...cells.map(p => p[1])); return cells.map(([r, c]) => [r - mr, c - mc]).sort((a, b) => a[0] - b[0] || a[1] - b[1]).map(p => p.join(':')).join(' '); };
  const binGrid = R => { const m = R.int(2, 5), n = R.int(2, 5); return Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.45) ? 1 : 0)); };
  const treeInfo = I => { const root = Tr.from(I.root), adj = new Map(); Tr.nodes(root).forEach(n => { adj.set(n.val, adj.get(n.val) || []); for (const ch of [n.left, n.right]) if (ch) { adj.get(n.val).push(ch.val); adj.set(ch.val, (adj.get(ch.val) || []).concat(n.val)); } }); const leaf = new Set(Tr.nodes(root).filter(n => !n.left && !n.right).map(n => n.val)), dist = new Map([[I.k, 0]]), q = [I.k]; for (let i = 0; i < q.length; i++) for (const v of adj.get(q[i])) if (!dist.has(v)) { dist.set(v, dist.get(q[i]) + 1); q.push(v); } return { root, leaf, dist, q }; };

  D('word-ladder-ii', {
    t: 'Word Ladder II',
    r: 'BFS from the begin word layer by layer, recording every parent on a shortest route. Stop at the layer that reaches the end word, then backtrack from it through the parents to list all shortest ladders.',
    g: wordGen, cmp: 'set',
    s(I, T) { const res = (() => { T.at({ begin: I.beginWord, end: I.endWord, words: A([...new Set(I.wordList)]) }); T.yn('Is the end word in the word list?', I.wordList.includes(I.endWord), 'Otherwise no ladder can finish.'); const words = [...new Set(I.wordList)], dist = ladderBfs(I, T); if (!dist.has(I.endWord) || !words.includes(I.endWord)) return []; const out = [], go = (w, path) => { if (w === I.beginWord) { out.push([w, ...path]); return; } for (const p of dist.keys()) if (dist.get(p) === dist.get(w) - 1 && oneOff(p, w)) go(p, [w, ...path]); }; go(I.endWord, []); return out; })(); T.n('How many shortest sequences?', res.length, 'Walk back level by level from the end word.'); return res; }
  });

  D('word-ladder', {
    t: 'Word Ladder (BFS)',
    r: 'Words are nodes; one-letter changes are edges. BFS from the begin word; the layer where the end word appears is the ladder length (counting words). 0 if never reached.',
    g: wordGen,
    s(I, T) { const res = (() => { T.at({ begin: I.beginWord, end: I.endWord, words: A([...new Set(I.wordList)]) }); T.yn('Is the end word in the word list?', I.wordList.includes(I.endWord), 'Otherwise no ladder can finish.'); const dist = ladderBfs(I, T); return I.wordList.includes(I.endWord) && dist.has(I.endWord) ? dist.get(I.endWord) : 0; })(); T.n('Words in the shortest sequence? (0 if none)', res, 'BFS level of the end word.'); return res; }
  });

  D('clone-graph', {
    t: 'Clone Graph',
    r: 'BFS/DFS with a map original → copy. Create a node\'s copy the first time you see it, then wire each copy\'s neighbor list to the copies of its neighbors.',
    g: R => { const n = R.int(1, 5), e = R.edges(n, R.int(n - 1, n + 1), { conn: true }), adj = Array.from({ length: n }, () => []); e.forEach(([a, b]) => { adj[a].push(b + 1); adj[b].push(a + 1); }); return { adjList: adj.map(l => l.sort((a, b) => a - b)) }; },
    s(I, T) { const n = I.adjList.length; if (!n) { T.at({ adjList: A([]) }); T.n('Nodes to copy?', 0, 'Empty graph.'); return []; } const copy = new Map([[1, []]]), q = [1]; for (let i = 0; i < q.length; i++) { const u = q[i]; for (const v of I.adjList[u - 1]) { if (!copy.has(v)) { copy.set(v, []); q.push(v); } copy.get(u).push(v); } if (i < 6) { T.at({ graph: GR(n, I.adjList.flatMap((l, a) => l.filter(b => b > a + 1).map(b => [a + 1, b])), { cls: { [u]: 'hit' } }), copied: A([...copy.keys()]) }); T.n('Copies created so far?', copy.size, 'Every newly seen neighbor gets a copy.'); } } return Array.from({ length: n }, (_, i) => copy.get(i + 1) || []); }
  });

  D('alien-dictionary', {
    t: 'Alien Dictionary',
    r: 'Compare each adjacent pair of words: the first differing letters give an edge a → b. A longer word before its own prefix is invalid. Topologically sort the letters (Kahn); a cycle means "".',
    g: R => { const ord = R.shuffle(['a', 'b', 'c', 'd']), rank = c => ord.indexOf(c); const ws = Array.from({ length: R.int(2, 5) }, () => R.str(R.int(1, 3), 'abcd')); if (R.chance(0.8)) ws.sort((x, y) => { for (let i = 0; i < Math.min(x.length, y.length); i++) if (x[i] !== y[i]) return rank(x[i]) - rank(y[i]); return x.length - y.length; }); return { words: ws }; },
    cmp: (o, e, I) => { if (e === '') return o === ''; if (typeof o !== 'string') return false; const letters = new Set(I.words.join('')); if (o.length !== letters.size || new Set(o).size !== o.length || [...o].some(c => !letters.has(c))) return false; for (let i = 0; i + 1 < I.words.length; i++) { const a = I.words[i], b = I.words[i + 1]; for (let j = 0; j < Math.min(a.length, b.length); j++) if (a[j] !== b[j]) { if (o.indexOf(a[j]) > o.indexOf(b[j])) return false; break; } } return true; },
    s(I, T) { const letters = [...new Set(I.words.join(''))], out = {}, indeg = {}; letters.forEach(c => { out[c] = new Set(); indeg[c] = 0; }); for (let i = 0; i + 1 < I.words.length; i++) { const a = I.words[i], b = I.words[i + 1]; let j = 0; while (j < Math.min(a.length, b.length) && a[j] === b[j]) j++; if (j === Math.min(a.length, b.length)) { if (a.length > b.length) { T.at({ a, b }); T.yn(`Is "${a}" before its prefix "${b}" a contradiction?`, true, 'A prefix must come first.'); return ''; } continue; } if (!out[a[j]].has(b[j])) { out[a[j]].add(b[j]); indeg[b[j]]++; } if (i < 5) { T.at({ a, b, edges: K(Object.fromEntries(letters.map(c => [c, [...out[c]].join(',')]))) }); T.c(`Which rule does "${a}" vs "${b}" give?`, [`${a[j]} before ${b[j]}`, `${b[j]} before ${a[j]}`], `${a[j]} before ${b[j]}`, 'First differing letter.'); } } const q = letters.filter(c => !indeg[c]); let res = ''; while (q.length) { const c = q.shift(); res += c; for (const d of out[c]) if (!--indeg[d]) q.push(d); } T.at({ order: res }); T.yn('Did every letter get placed (no cycle)?', res.length === letters.length, 'Kahn\'s algorithm.'); return res.length === letters.length ? res : ''; }
  });

  D('find-the-celebrity', {
    t: 'Find the Celebrity',
    r: 'Keep a candidate: if the candidate knows i, i becomes the candidate (the old one is not a celebrity). Then verify the candidate knows nobody and everyone knows them.',
    g: R => { const n = R.int(2, 5), g = Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => i === j ? 1 : R.chance(0.4) ? 1 : 0)); if (R.chance(0.6)) { const c = R.int(0, n - 1); for (let i = 0; i < n; i++) if (i !== c) { g[i][c] = 1; g[c][i] = 0; } } return { graph: g }; },
    s(I, T) { const g = I.graph, n = g.length; let c = 0; for (let i = 1; i < n; i++) { const k = g[c][i] === 1; T.at({ knows: G(g, { hl: [[c, i]] }) }); T.yn(`Does ${c} know ${i}?`, k, k ? `${c} is out; candidate = ${i}.` : `${i} is out.`); if (k) c = i; } const ok = [...Array(n).keys()].every(i => i === c || (g[i][c] === 1 && g[c][i] === 0)); T.at({ candidate: c }); T.yn(`Is ${c} really the celebrity?`, ok, 'Everyone knows them and they know nobody.'); return ok ? c : -1; }
  });

  D('walls-and-gates', {
    t: 'Walls and Gates',
    r: 'Multi-source BFS from every gate at once: the first time BFS reaches a room is its distance to the nearest gate.',
    g: R => { const INF = 2147483647, m = R.int(1, 4), n = R.int(1, 4); return { rooms: Array.from({ length: m }, () => Array.from({ length: n }, () => R.pick([INF, INF, -1, 0]))) }; },
    s(I, T) { const g = I.rooms.map(r => r.slice()), INF = 2147483647, q = []; g.forEach((row, r) => row.forEach((v, c) => { if (v === 0) q.push([r, c]); })); T.at({ rooms: G(g, { hl: q }) }); T.n('How many gates start the BFS?', q.length, 'All gates at distance 0.'); for (let i = 0, asks = 0; i < q.length; i++) { const [r, c] = q[i]; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && g[x][y] === INF) { g[x][y] = g[r][c] + 1; q.push([x, y]); if (asks < 5) { T.at({ rooms: G(g.map(row => row.map(v => v === INF ? '∞' : v)), { hl: [[x, y]] }) }); T.n(`Distance for room (${x}, ${y})?`, g[x][y], 'Parent distance + 1.'); asks++; } } } } return g; }
  });

  D('minimum-height-trees', {
    t: 'Minimum Height Trees',
    r: 'Peel leaves layer by layer (like Kahn on a tree). The last one or two nodes remaining are the centers, which give the minimum height.',
    g: R => { const n = R.int(1, 8); return { n, edges: Array.from({ length: n - 1 }, (_, i) => [R.int(0, i), i + 1]) }; },
    cmp: 'set',
    s(I, T) { const res = (() => { const n = I.n; if (n <= 2) { T.at({ n }); T.n('How many centers?', n, 'With 2 or fewer nodes every node is a center.'); T.n('Edges?', I.edges.length, 'A tree has n minus 1 edges.'); return [...Array(n).keys()]; } const deg = Array(n).fill(0), adj = Array.from({ length: n }, () => []); I.edges.forEach(([a, b]) => { adj[a].push(b); adj[b].push(a); deg[a]++; deg[b]++; }); T.at({ graph: GR(n, I.edges) }); T.n('Highest degree?', Math.max(...deg), 'Busy nodes tend to be near the middle.'); let leaves = [...Array(n).keys()].filter(i => deg[i] === 1), left = n; while (left > 2) { T.at({ graph: GR(n, I.edges, { cls: Object.fromEntries(leaves.map(x => [x, 'hit'])) }) }); T.n('Leaves peeled this round?', leaves.length, 'Degree-1 nodes.'); left -= leaves.length; const nx = []; for (const l of leaves) for (const v of adj[l]) if (--deg[v] === 1) nx.push(v); leaves = nx; } return leaves; })(); T.n('How many centers?', res.length, 'The one or two nodes left after peeling.'); return res; }
  });

  D('shortest-distance-from-all-buildings', {
    t: 'Shortest Distance From All Buildings',
    r: 'BFS from each building over empty land, adding distances into a total grid and counting how many buildings reach each cell. The best cell is reached by all buildings with the smallest total.',
    g: R => { const m = R.int(1, 4), n = R.int(2, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.pick([0, 0, 0, 1, 2]))); if (!g.flat().includes(1)) g[0][0] = 1; return { grid: g }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, tot = g.map(r => r.map(() => 0)), reach = g.map(r => r.map(() => 0)); let b = 0, asks = 0; g.forEach((row, r) => row.forEach((v, c) => { if (v !== 1) return; b++; const d = g.map(rr => rr.map(() => -1)), q = [[r, c]]; d[r][c] = 0; for (let i = 0; i < q.length; i++) { const [x, y] = q[i]; for (const [dx, dy] of DIRS) { const a = x + dx, bb = y + dy; if (inG(g, a, bb) && g[a][bb] === 0 && d[a][bb] < 0) { d[a][bb] = d[x][y] + 1; tot[a][bb] += d[a][bb]; reach[a][bb]++; q.push([a, bb]); } } } if (asks < 4) { T.at({ grid: G(g, { hl: [[r, c]] }), total: G(tot) }); T.n(`Empty cells this building (${r}, ${c}) reaches?`, q.length - 1, 'BFS over 0 cells.'); asks++; } })); let best = Infinity; g.forEach((row, r) => row.forEach((v, c) => { if (v === 0 && reach[r][c] === b) best = Math.min(best, tot[r][c]); })); return best === Infinity ? -1 : best; }
  });

  D('reconstruct-itinerary', {
    t: 'Reconstruct Itinerary (Hierholzer)',
    r: 'Sort each airport\'s destinations. DFS from JFK always taking the smallest unused ticket; append an airport after its tickets run out, then reverse. This gives the lexically smallest Eulerian path.',
    g: R => { const ap = ['JFK', 'ATL', 'SFO', 'MUC'], t = []; let cur = 'JFK'; for (let i = 0; i < R.int(1, 6); i++) { const nx = R.pick(ap.filter(a => a !== cur)); t.push([cur, nx]); cur = nx; } return { tickets: R.shuffle(t) }; },
    s(I, T) { const adj = {}; I.tickets.forEach(([a, b]) => (adj[a] = adj[a] || []).push(b)); for (const k in adj) adj[k].sort(); const out = [], st = ['JFK']; let asks = 0; while (st.length) { const u = st[st.length - 1]; if (adj[u] && adj[u].length) { const v = adj[u].shift(); if (asks < 6) { T.at({ at: u, left: K(Object.fromEntries(Object.entries(adj).map(([k, v]) => [k, v.join(',')]))) }); T.c(`From ${u}, which ticket is used?`, [...new Set([v, ...I.tickets.flat()])].slice(0, 4), v, 'Smallest remaining destination.'); asks++; } st.push(v); } else out.push(st.pop()); } if (!asks) T.n('Tickets?', 0, 'None.'); return out.reverse(); }
  });

  D('sequence-reconstruction', {
    t: 'Sequence Reconstruction',
    r: 'Build edges from consecutive elements of each sequence and run Kahn\'s algorithm. nums is the unique shortest supersequence iff the queue never holds more than one node and the order equals nums.',
    g: R => { const n = R.int(1, 5), nums = R.perm(n).map(x => x + 1); return { nums, sequences: Array.from({ length: R.int(1, 3) }, () => nums.filter(() => R.chance(0.6))).filter(s => s.length).concat([[nums[0]]]) }; },
    s(I, T) { const n = I.nums.length, out = Array.from({ length: n + 1 }, () => new Set()), indeg = Array(n + 1).fill(0); for (const s of I.sequences) for (let i = 0; i + 1 < s.length; i++) if (!out[s[i]].has(s[i + 1])) { out[s[i]].add(s[i + 1]); indeg[s[i + 1]]++; } let q = []; for (let v = 1; v <= n; v++) if (!indeg[v]) q.push(v); const order = []; while (q.length) { T.at({ queue: Q(q), order: A(order) }); T.yn('Is the next element forced (queue size 1)?', q.length === 1, 'Two choices mean another order works too.'); if (q.length > 1) return false; const u = q.shift(); order.push(u); for (const v of out[u]) if (!--indeg[v]) q.push(v); } return order.length === n && order.every((x, i) => x === I.nums[i]); }
  });

  D('the-maze', {
    t: 'The Maze (rolling ball)',
    r: 'Nodes are the stopping cells. From each, roll in four directions until a wall; BFS over stopping cells and check whether the destination is one.',
    g: mazeGen,
    s(I, T) { const d = mazeDist(I.maze, I.start, T); const [r, c] = I.destination; T.at({ maze: G(I.maze, { hl: [I.start, I.destination] }) }); T.yn('Can the ball stop at the destination?', d[r][c] < Infinity, 'It must stop there, not just pass.'); return d[r][c] < Infinity; }
  });

  D('the-maze-iii', {
    t: 'The Maze III (lexicographic Dijkstra)',
    r: 'Dijkstra on (distance, path string). Rolling stops at walls but also drops into the hole when passing it. Ties on distance go to the lexicographically smallest instruction string.',
    g: R => { const x = mazeGen(R); return { maze: x.maze, ball: x.start, hole: x.destination }; },
    s(I, T) { const mz = I.maze, m = mz.length, n = mz[0].length, H = I.hole, best = new Map(), key = (r, c) => r * n + c, dirs = [['d', 1, 0], ['l', 0, -1], ['r', 0, 1], ['u', -1, 0]]; best.set(key(...I.ball), [0, '']); const done = new Set(); let asks = 0; for (;;) { let u = null; for (const [k, v] of best) if (!done.has(k) && (!u || v[0] < u[1][0] || (v[0] === u[1][0] && v[1] < u[1][1]))) u = [k, v]; if (!u) break; const [k, [dist, path]] = u; done.add(k); const r = Math.floor(k / n), c = k % n; if (r === H[0] && c === H[1]) return path; for (const [ch, dr, dc] of dirs) { let x = r, y = c, s = 0; while (inG(mz, x + dr, y + dc) && mz[x + dr][y + dc] === 0) { x += dr; y += dc; s++; if (x === H[0] && y === H[1]) break; } if (!s) continue; const cand = [dist + s, path + ch], o = best.get(key(x, y)); if (!o || cand[0] < o[0] || (cand[0] === o[0] && cand[1] < o[1])) { best.set(key(x, y), cand); if (asks < 5) { T.at({ maze: G(mz, { hl: [[r, c], [x, y]], ok: [H] }) }); T.n(`Distance to (${x}, ${y}) rolling "${ch}"?`, cand[0], `${dist} + ${s}.`); asks++; } } } } if (!asks) { T.at({ maze: G(mz) }); T.yn('Can the ball move at all?', false, 'Walled in.'); } return 'impossible'; }
  });

  D('the-maze-ii', {
    t: 'The Maze II (Dijkstra)',
    r: 'Edges go from a stopping cell to the next stopping cell in each direction, weighted by cells rolled. Dijkstra gives the shortest distance to the destination (−1 if it can\'t stop there).',
    g: mazeGen,
    s(I, T) { const d = mazeDist(I.maze, I.start, T), [r, c] = I.destination; T.at({ maze: G(I.maze, { hl: [I.start, I.destination] }) }); T.yn('Is the destination a reachable stop?', d[r][c] < Infinity, 'Dijkstra finished.'); return d[r][c] < Infinity ? d[r][c] : -1; }
  });

  D('maximum-vacation-days', {
    t: 'Maximum Vacation Days',
    r: 'dp[c] = best total ending week w in city c = days[c][w] + max dp over cities that can fly to c (or stay). Start in city 0; week 0 may begin anywhere reachable from it.',
    g: R => { const n = R.int(1, 3), k = R.int(1, 3); return { flights: Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => i === j ? 0 : R.int(0, 1))), days: Array.from({ length: n }, () => R.ints(k, 0, 7)) }; },
    s(I, T) { const n = I.flights.length, k = I.days[0].length; let dp = Array(n).fill(-Infinity); dp[0] = 0; for (let w = 0; w < k; w++) { const nx = Array(n).fill(-Infinity); for (let c = 0; c < n; c++) for (let p = 0; p < n; p++) if (dp[p] > -Infinity && (p === c || I.flights[p][c])) nx[c] = Math.max(nx[c], dp[p] + I.days[c][w]); dp = nx; T.at({ days: G(I.days, { hl: [...Array(n).keys()].map(c => [c, w]) }), dp: A(dp.map(v => v === -Infinity ? '−' : v)) }); T.n(`Best total after week ${w}?`, Math.max(...dp), 'Max over reachable cities.'); } return Math.max(...dp); }
  });

  D('cut-off-trees-for-golf-event', {
    t: 'Cut Off Trees for Golf Event',
    r: 'Trees must be cut in increasing height. Sort them, then BFS from the current spot to each next tree and add the steps; −1 if any tree is unreachable.',
    g: R => { const m = R.int(1, 4), n = R.int(2, 4), hs = R.shuffle([...Array(m * n).keys()].map(x => x + 2)); return { forest: Array.from({ length: m }, (_, r) => Array.from({ length: n }, (_, c) => r + c === 0 ? R.pick([1, hs[0]]) : R.pick([0, 1, hs[r * n + c]]))) }; },
    s(I, T) { const f = I.forest, trees = []; f.forEach((row, r) => row.forEach((v, c) => { if (v > 1) trees.push([v, r, c]); })); trees.sort((a, b) => a[0] - b[0]); const bfs = (sr, sc, tr, tc) => { const d = f.map(r => r.map(() => -1)), q = [[sr, sc]]; d[sr][sc] = 0; for (let i = 0; i < q.length; i++) { const [x, y] = q[i]; if (x === tr && y === tc) return d[x][y]; for (const [dx, dy] of DIRS) { const a = x + dx, b = y + dy; if (inG(f, a, b) && f[a][b] && d[a][b] < 0) { d[a][b] = d[x][y] + 1; q.push([a, b]); } } } return -1; }; let r = 0, c = 0, tot = 0, i = 0; for (const [h, tr, tc] of trees) { const s = bfs(r, c, tr, tc); if (i++ < 5) { T.at({ forest: G(f, { hl: [[r, c], [tr, tc]] }) }); T.n(`Steps from (${r}, ${c}) to the tree of height ${h}? (−1 if blocked)`, s, 'BFS through non-zero cells.'); } if (s < 0) return -1; tot += s; r = tr; c = tc; } if (!trees.length) T.n('Trees to cut?', 0, 'None.'); return tot; }
  });

  D('employee-importance', {
    t: 'Employee Importance',
    r: 'Index employees by id, then DFS from the given id summing importance over all direct and indirect subordinates.',
    g: R => { const n = R.int(1, 6), ids = R.distinct(n, 1, 20), emp = ids.map(id => [id, R.int(-5, 9), []]); for (let i = 1; i < n; i++) emp[R.int(0, i - 1)][2].push(ids[i]); return { employees: emp, id: R.pick(ids) }; },
    s(I, T) { const by = new Map(I.employees.map(e => [e[0], e])); const go = id => { const [, imp, subs] = by.get(id), t = imp + subs.reduce((s, x) => s + go(x), 0); T.at({ employee: id, importance: imp, subs: A(subs) }); T.n(`Total importance under ${id} (including them)?`, t, 'Own value + subordinates\' totals.'); return t; }; return go(I.id); }
  });

  D('number-of-distinct-islands', {
    t: 'Number of Distinct Islands',
    r: 'Flood-fill each island and record its cells relative to its top-left; islands with the same normalized shape (translation only) count once.',
    g: R => ({ grid: binGrid(R) }),
    s(I, T) { const isl = islands(I.grid), seen = new Set(); isl.forEach((cells, i) => { const k = norm(cells), nw = !seen.has(k); if (i < 5) { T.at({ grid: G(I.grid, { hl: cells }), shapes: A([...seen]) }); T.yn('Is this a new shape?', nw, 'Compare the translated cell set.'); } seen.add(k); }); if (!isl.length) { T.at({ grid: G(I.grid) }); T.n('Islands?', 0, 'No land.'); } return seen.size; }
  });

  D('number-of-distinct-islands-ii', {
    t: 'Distinct Islands II (rotations & reflections)',
    r: 'For each island, generate its 8 rotations/reflections, normalize each, and keep the smallest as the canonical key. Count distinct keys.',
    g: R => ({ grid: binGrid(R) }),
    s(I, T) { const isl = islands(I.grid), seen = new Set(); const canon = cells => { const t = [[1, 1, 0], [1, -1, 0], [-1, 1, 0], [-1, -1, 0], [1, 1, 1], [1, -1, 1], [-1, 1, 1], [-1, -1, 1]]; return t.map(([a, b, sw]) => norm(cells.map(([r, c]) => sw ? [c * a, r * b] : [r * a, c * b]))).sort()[0]; }; isl.forEach((cells, i) => { const k = canon(cells), nw = !seen.has(k); if (i < 5) { T.at({ grid: G(I.grid, { hl: cells }) }); T.yn('Is this shape new (up to rotation/reflection)?', nw, 'Compare canonical keys.'); } seen.add(k); }); if (!isl.length) { T.at({ grid: G(I.grid) }); T.n('Islands?', 0, 'No land.'); } return seen.size; }
  });

  D('closest-leaf-in-a-binary-tree', {
    t: 'Closest Leaf in a Binary Tree',
    r: 'Turn the tree into an undirected graph (add parent links), then BFS from the target; the first leaf dequeued is the closest.',
    g: R => { const r = Tr.from(R.tree(R.int(1, 9), 1, 9, 4)), v = R.shuffle(Tr.nodes(r).map((_, i) => i + 1)); Tr.nodes(r).forEach((x, i) => x.val = v[i]); return { root: Tr.arr(r), k: R.pick(v) }; },
    cmp: (o, e, I) => { const t = treeInfo(I); return t.leaf.has(o) && t.dist.get(o) === t.dist.get(e); },
    s(I, T) { const res = (() => { const t = treeInfo(I), best = t.q.find(v => t.leaf.has(v)), d = t.dist.get(best); T.at({ tree: TR(t.root, { hit: Tr.find(t.root, I.k) }) }); T.yn(`Is ${I.k} itself a leaf?`, t.leaf.has(I.k), 'Then the distance is 0.'); T.n(`Edges from ${I.k} to the nearest leaf?`, d, 'BFS through children and parent.'); return best; })(); const t = treeInfo(I), d = t.dist.get(res); T.n('How many leaves are at that distance?', [...t.leaf].filter(v => t.dist.get(v) === d).length, 'Any of them is a correct answer.'); return res; }
  });

  D('network-delay-time', {
    t: 'Network Delay Time (Dijkstra)',
    r: 'Dijkstra from k over directed weighted edges. The answer is the largest shortest distance; −1 if some node is unreachable.',
    g: R => { const n = R.int(1, 5); return { times: R.edges(n, R.int(0, n * 2), { dir: true, w: [0, 9] }).map(([a, b, w]) => [a + 1, b + 1, w]), n, k: R.int(1, n) }; },
    s(I, T) { const n = I.n, d = Array(n + 1).fill(Infinity), done = Array(n + 1).fill(false); d[I.k] = 0; for (let it = 0; it < n; it++) { let u = -1; for (let v = 1; v <= n; v++) if (!done[v] && d[v] < Infinity && (u < 0 || d[v] < d[u])) u = v; if (u < 0) break; done[u] = true; T.at({ graph: GR([...Array(n).keys()].map(x => x + 1), I.times.map(e => [e[0], e[1]]), { dir: true, cls: { [u]: 'hit' } }), dist: A(d.slice(1).map(x => x === Infinity ? '∞' : x)) }); T.n(`Final distance of the next settled node ${u}?`, d[u], 'Smallest tentative distance.'); for (const [a, b, w] of I.times) if (a === u && d[u] + w < d[b]) d[b] = d[u] + w; } const mx = Math.max(...d.slice(1)); return mx === Infinity ? -1 : mx; }
  });

  D('contain-virus', {
    t: 'Contain Virus',
    r: 'Each night: find infected regions, count the uninfected cells each threatens and the walls needed. Wall off the most threatening region (add its walls), then every other region spreads. Repeat until nothing spreads.',
    g: R => { const m = R.int(2, 4), n = R.int(2, 5); return { isInfected: Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.25) ? 1 : 0)) }; },
    s(I, T) { const res = (() => { const g = I.isInfected.map(r => r.slice()), m = g.length, n = g[0].length; let walls = 0, asks = 0; for (;;) { const seen = new Set(), regs = []; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (g[r][c] === 1 && !seen.has(r * n + c)) { const cells = [], thr = new Set(); let w = 0; const st = [[r, c]]; seen.add(r * n + c); while (st.length) { const [x, y] = st.pop(); cells.push([x, y]); for (const [dx, dy] of DIRS) { const a = x + dx, b = y + dy; if (!inG(g, a, b)) continue; if (g[a][b] === 0) { thr.add(a * n + b); w++; } else if (g[a][b] === 1 && !seen.has(a * n + b)) { seen.add(a * n + b); st.push([a, b]); } } } regs.push({ cells, thr, w }); } if (!regs.length) break; regs.sort((a, b) => b.thr.size - a.thr.size); if (!regs[0].thr.size) break; if (asks < 5) { T.at({ grid: G(g, { hl: regs[0].cells }) }); T.n('Walls needed for the most threatening region?', regs[0].w, 'One per edge between an infected cell and a clean cell.'); asks++; } walls += regs[0].w; regs[0].cells.forEach(([x, y]) => g[x][y] = 2); regs.slice(1).forEach(rg => rg.thr.forEach(k => g[Math.floor(k / n)][k % n] = 1)); } if (!asks) { T.at({ grid: G(g) }); T.yn('Is any clean cell threatened?', false, 'No walls needed.'); } return walls; })(); T.n('Total walls used?', res, 'Add the walls from every day.'); return res; }
  });

  D('open-the-lock', {
    t: 'Open the Lock (BFS)',
    r: 'States are the 10,000 codes; each move turns one wheel ±1 (wrapping). BFS from "0000" avoiding deadends; the level where target appears is the answer.',
    g: R => { const t = R.str(4, '0012'); return { deadends: [...new Set(Array.from({ length: R.int(1, 5) }, () => R.str(4, '0123')))].filter(x => x !== t), target: t }; },
    s(I, T) { const dead = new Set(I.deadends); T.at({ deadends: A(I.deadends), target: I.target }); T.yn('Is "0000" itself a deadend?', dead.has('0000'), 'Then we cannot even start.'); if (dead.has('0000')) return -1; const dist = new Map([['0000', 0]]), q = ['0000']; let lvl = 0, asks = 0; for (let i = 0; i < q.length; i++) { const u = q[i]; if (u === I.target) return dist.get(u); if (dist.get(u) > lvl) { lvl = dist.get(u); if (asks < 3) { T.at({ level: lvl, frontier: q.length - i }); T.n(`Codes first reached in ${lvl} moves?`, q.filter(x => dist.get(x) === lvl).length, 'Unvisited, non-dead neighbors.'); asks++; } } for (let p = 0; p < 4; p++) for (const d of [1, 9]) { const v = u.slice(0, p) + (+u[p] + d) % 10 + u.slice(p + 1); if (!dist.has(v) && !dead.has(v)) { dist.set(v, dist.get(u) + 1); q.push(v); } } } return -1; }
  });

  D('cracking-the-safe', {
    t: 'Cracking the Safe (de Bruijn)',
    r: 'Nodes are (n − 1)-digit strings; each digit appended is an edge, i.e. one password. An Eulerian circuit (Hierholzer DFS) uses every edge once, giving a shortest string of length kⁿ + n − 1.',
    g: R => ({ n: R.int(1, 3), k: R.int(1, 3) }),
    cmp: (o, e, I) => { if (typeof o !== 'string' || o.length !== Math.pow(I.k, I.n) + I.n - 1) return false; const s = new Set(); for (let i = 0; i + I.n <= o.length; i++) s.add(o.slice(i, i + I.n)); return s.size === Math.pow(I.k, I.n) && [...o].every(c => +c < I.k); },
    s(I, T) { const res = (() => { const { n, k } = I, seen = new Set(), out = []; const dfs = u => { for (let d = 0; d < k; d++) { const e = u + d; if (!seen.has(e)) { seen.add(e); dfs(e.slice(1)); out.push(d); } } }; const start = '0'.repeat(n - 1); dfs(start); T.at({ n, k }); T.n('How many passwords must the string contain?', Math.pow(k, n), 'k to the power n.'); T.n('Shortest possible length?', Math.pow(k, n) + n - 1, 'Each new digit after the first n − 1 completes a new password.'); return start + out.reverse().join(''); })(); T.n('Passwords that start with 0?', Math.pow(I.k, I.n - 1), 'Fix the first digit; the rest are free.'); return res; }
  });

  D('sliding-puzzle', {
    t: 'Sliding Puzzle (BFS over boards)',
    r: 'Each 2×3 board is a state; moves swap 0 with a neighbor. BFS from the start until "123450"; −1 if unreachable (half of the permutations are).',
    g: R => { const b = R.perm(6); return { board: [b.slice(0, 3), b.slice(3)] }; },
    s(I, T) { const goal = '123450', nb = [[1, 3], [0, 2, 4], [1, 5], [0, 4], [1, 3, 5], [2, 4]], s0 = I.board.flat().join(''), dist = new Map([[s0, 0]]), q = [s0]; let asks = 0; for (let i = 0; i < q.length; i++) { const u = q[i]; if (u === goal) { T.at({ board: G([[...u.slice(0, 3)], [...u.slice(3)]]) }); T.n('Moves to solve?', dist.get(u), 'BFS level.'); return dist.get(u); } const z = u.indexOf('0'); if (i < 2 && asks < 2) { T.at({ board: G([[...u.slice(0, 3)], [...u.slice(3)]], { hl: [[Math.floor(z / 3), z % 3]] }) }); T.n('How many moves are possible from this board?', nb[z].length, 'Neighbors of the blank.'); asks++; } for (const j of nb[z]) { const a = [...u]; [a[z], a[j]] = [a[j], a[z]]; const v = a.join(''); if (!dist.has(v)) { dist.set(v, dist.get(u) + 1); q.push(v); } } } T.at({ explored: q.length }); T.n('Boards reachable from the start?', q.length, 'Only half of the 720 arrangements.'); return -1; }
  });

  D('cheapest-flights-within-k-stops', {
    t: 'Cheapest Flights Within K Stops',
    r: 'Bellman–Ford limited to k + 1 rounds: each round relaxes every flight using a copy of the previous round\'s prices, so a path uses at most one more edge per round.',
    g: R => { const n = R.int(2, 5), f = R.edges(n, R.int(1, n * 2), { dir: true, w: [1, 9] }); return { n, flights: f, src: 0, dst: R.int(1, n - 1), k: R.int(0, 2) }; },
    s(I, T) { let d = Array(I.n).fill(Infinity); d[I.src] = 0; for (let r = 0; r <= I.k; r++) { const nd = d.slice(); for (const [a, b, w] of I.flights) if (d[a] + w < nd[b]) nd[b] = d[a] + w; d = nd; T.at({ graph: GR(I.n, I.flights.map(e => [e[0], e[1]]), { dir: true, cls: { [I.dst]: 'hit' } }), price: A(d.map(x => x === Infinity ? '∞' : x)) }); T.n(`Cheapest to ${I.dst} using ≤ ${r + 1} flights? (−1 if none)`, d[I.dst] === Infinity ? -1 : d[I.dst], 'Relax from the previous round only.'); } return d[I.dst] === Infinity ? -1 : d[I.dst]; }
  });

  D('all-paths-from-source-to-target', {
    t: 'All Paths From Source to Target',
    r: 'DFS from 0 in the DAG, extending a path; record it when reaching n − 1, then backtrack.',
    g: R => { const n = R.int(2, 5); return { graph: Array.from({ length: n }, (_, i) => [...Array(n).keys()].filter(j => j > i && R.chance(0.5))) }; },
    cmp: 'set',
    s(I, T) { const res = (() => { const n = I.graph.length, out = [], cnt = Array(n).fill(-1); const ways = u => { if (u === n - 1) return 1; if (cnt[u] >= 0) return cnt[u]; return cnt[u] = I.graph[u].reduce((s, v) => s + ways(v), 0); }; const edges = I.graph.flatMap((l, a) => l.map(b => [a, b])); T.at({ graph: GR(n, edges, { dir: true }) }); T.n('Edges out of node 0?', I.graph[0].length, 'Each one starts a branch of the DFS.'); T.n(`How many paths from 0 to ${n - 1}?`, ways(0), 'Sum over neighbors.'); const go = (u, p) => { if (u === n - 1) { out.push(p); return; } for (const v of I.graph[u]) go(v, [...p, v]); }; go(0, [0]); return out; })(); T.n('Nodes on the longest path? (0 if none)', res.length ? Math.max(...res.map(p => p.length)) : 0, 'Count both ends.'); return res; }
  });

  D('find-eventual-safe-states', {
    t: 'Find Eventual Safe States',
    r: 'Reverse the edges and run Kahn from terminal nodes (out-degree 0). A node becomes safe when all of its outgoing edges lead to safe nodes. Return safe nodes sorted.',
    g: R => { const n = R.int(1, 6); return { graph: Array.from({ length: n }, () => [...Array(n).keys()].filter(() => R.chance(0.25))) }; },
    s(I, T) { const res = (() => { const n = I.graph.length, out = I.graph.map(l => l.length), rev = Array.from({ length: n }, () => []); I.graph.forEach((l, u) => l.forEach(v => rev[v].push(u))); const q = [...Array(n).keys()].filter(u => !out[u]), safe = Array(n).fill(false); T.at({ graph: GR(n, I.graph.flatMap((l, a) => l.map(b => [a, b])), { dir: true }) }); T.n('Terminal nodes?', q.length, 'No outgoing edges.'); for (let i = 0; i < q.length; i++) { const v = q[i]; safe[v] = true; for (const u of rev[v]) if (!--out[u]) q.push(u); } return [...Array(n).keys()].filter(u => safe[u]); })(); T.n('How many safe nodes?', res.length, 'Peel terminal nodes backwards.'); T.yn('Is node 0 safe?', res.includes(0), 'All its paths must end at terminal nodes.'); return res; }
  });

  D('bus-routes', {
    t: 'Bus Routes (BFS over buses)',
    r: 'Map each stop to the buses through it. BFS where one step = boarding a new bus: all its stops become reachable. Count buses taken until the target stop.',
    g: R => ({ routes: Array.from({ length: R.int(1, 4) }, () => R.distinct(R.int(1, 4), 0, 8)), source: R.int(0, 8), target: R.int(0, 8) }),
    s(I, T) { const res = (() => { if (I.source === I.target) { T.at({ source: I.source }); T.yn('Is the source already the target?', true, 'No bus needed.'); T.n('Buses needed?', 0, 'Already there.'); T.n('Routes?', I.routes.length, 'None of them are used.'); return 0; } const by = {}; I.routes.forEach((r, b) => r.forEach(s => (by[s] = by[s] || []).push(b))); T.at({ routes: A(I.routes.map(r => r.join(', '))), source: I.source }); T.n(`Buses that stop at ${I.source}?`, (by[I.source] || []).length, 'Board any of them first.'); const usedBus = new Set(), seenStop = new Set([I.source]); let lv = [I.source], d = 0; while (lv.length) { d++; const nx = []; for (const s of lv) for (const b of by[s] || []) if (!usedBus.has(b)) { usedBus.add(b); for (const t of I.routes[b]) if (!seenStop.has(t)) { seenStop.add(t); nx.push(t); } } T.at({ routes: A(I.routes.map(r => r.join(', '))), reached: A([...seenStop]) }); T.yn(`Is stop ${I.target} reached after ${d} bus(es)?`, seenStop.has(I.target), 'New stops from newly boarded buses.'); if (seenStop.has(I.target)) return d; lv = nx; } return -1; })(); if (I.source !== I.target) T.n('Fewest buses? (−1 if impossible)', res, 'BFS level where the target appears.'); return res; }
  });

  D('race-car', {
    t: 'Race Car (BFS over position and speed)',
    r: 'State = (position, speed). A: pos += speed, speed *= 2. R: speed = −1 or 1. BFS over states (bounded positions) to the shortest instruction count.',
    g: R => ({ target: R.int(1, 30) }),
    s(I, T) { const t = I.target, key = (p, v) => p + ',' + v, seen = new Set([key(0, 1)]); let lv = [[0, 1]], d = 0, asks = 0; for (;;) { const nx = []; for (const [p, v] of lv) { if (p === t) return d; for (const [np, nv] of [[p + v, v * 2], [p, v > 0 ? -1 : 1]]) { if (Math.abs(np) > 2 * t + 2 || seen.has(key(np, nv))) continue; seen.add(key(np, nv)); nx.push([np, nv]); } } if (asks < 3) { T.at({ step: d, states: lv.length }); T.n(`Where is the car after ${d + 1} A's in a row?`, Math.pow(2, d + 1) - 1, '1 + 2 + 4 + …'); asks++; } lv = nx; d++; } }
  });

  D('shortest-path-visiting-all-nodes', {
    t: 'Shortest Path Visiting All Nodes',
    r: 'BFS over (node, visited-mask) starting from every node at once. The first state whose mask covers everything gives the answer.',
    g: R => { const n = R.int(1, 5), e = R.edges(n, R.int(n - 1, n + 1), { conn: true }), g = Array.from({ length: n }, () => []); e.forEach(([a, b]) => { g[a].push(b); g[b].push(a); }); return { graph: g }; },
    s(I, T) { const n = I.graph.length, full = (1 << n) - 1, seen = new Set(); let lv = [...Array(n).keys()].map(u => [u, 1 << u]); lv.forEach(([u, m]) => seen.add(u + ',' + m)); let d = 0; for (;;) { if (lv.some(([, m]) => m === full)) return d; const nx = []; for (const [u, m] of lv) for (const v of I.graph[u]) { const nm = m | 1 << v; if (!seen.has(v + ',' + nm)) { seen.add(v + ',' + nm); nx.push([v, nm]); } } if (d < 4) { T.at({ graph: GR(n, I.graph.flatMap((l, a) => l.filter(b => b > a).map(b => [a, b]))), states: lv.length }); T.n(`New (node, mask) states at distance ${d + 1}?`, nx.length, 'Unseen pairs only.'); } lv = nx; d++; } }
  });

  D('loud-and-rich', {
    t: 'Loud and Rich',
    r: 'Edge richer → poorer. For each person, DFS (memoized) over people richer than them: answer[x] is the quietest among x and everyone reachable upward.',
    g: R => { const n = R.int(1, 6), p = R.perm(n), rich = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.35)) rich.push([p[i], p[j]]); return { richer: rich, quiet: R.perm(n) }; },
    s(I, T) { const n = I.quiet.length, up = Array.from({ length: n }, () => []); I.richer.forEach(([a, b]) => up[b].push(a)); const ans = Array(n).fill(-1); const go = x => { if (ans[x] >= 0) return ans[x]; let b = x; for (const y of up[x]) { const c = go(y); if (I.quiet[c] < I.quiet[b]) b = c; } ans[x] = b; return b; }; for (let x = 0; x < n; x++) { go(x); if (x < 5) { T.at({ graph: GR(n, I.richer, { dir: true, cls: { [x]: 'hit' } }), quiet: A(I.quiet) }); T.n(`Quietest person at least as rich as ${x}?`, ans[x], 'Best of x and answers of richer neighbors.'); } } return ans; }
  });

  D('k-similar-strings', {
    t: 'K-Similar Strings (BFS on swaps)',
    r: 'BFS from s1. At each state fix the first mismatched position i by swapping in a j > i with s[j] = s2[i] (and s[j] ≠ s2[j]). The level when reaching s2 is k.',
    g: R => { const a = R.str(R.int(1, 6), 'abcd'); return { s1: a, s2: R.shuffle([...a]).join('') }; },
    s(I, T) { const res = (() => { const t = I.s2, seen = new Set([I.s1]); let lv = [I.s1], d = 0; T.at({ s1: I.s1, s2: t }); T.n('Positions that differ?', [...t].filter((c, i) => c !== I.s1[i]).length, 'Each swap fixes one or two of them.'); for (;;) { if (lv.includes(t)) return d; const nx = []; for (const s of lv) { let i = 0; while (s[i] === t[i]) i++; for (let j = i + 1; j < s.length; j++) if (s[j] === t[i] && s[j] !== t[j]) { const a = [...s];[a[i], a[j]] = [a[j], a[i]]; const v = a.join(''); if (!seen.has(v)) { seen.add(v); nx.push(v); } } } if (d < 4) { T.at({ level: A(lv), target: t }); T.n(`Strings at distance ${d + 1}?`, nx.length, 'Useful swaps only.'); } lv = nx; d++; } })(); T.n('Fewest swaps?', res, 'BFS level where s2 appears.'); return res; }
  });

  D('shortest-path-to-get-all-keys', {
    t: 'Shortest Path to Get All Keys',
    r: 'BFS over (row, col, keys-bitmask). Locks pass only with their key; picking a key updates the mask. Stop when the mask has every key.',
    g: R => { const m = R.int(2, 3), n = R.int(3, 4), cells = R.shuffle([...Array(m * n).keys()]), g = Array.from({ length: m }, () => Array(n).fill('.')); const put = (i, ch) => { g[Math.floor(cells[i] / n)][cells[i] % n] = ch; }; put(0, '@'); const k = R.int(1, 2); for (let i = 0; i < k; i++) { put(1 + i, 'ab'[i]); if (R.chance(0.7)) put(3 + i, 'AB'[i]); } for (let i = 5; i < cells.length; i++) if (R.chance(0.2)) put(i, '#'); return { grid: g.map(r => r.join('')) }; },
    s(I, T) { const res = (() => { const g = I.grid, m = g.length, n = g[0].length; let sr = 0, sc = 0, K2 = 0; g.forEach((row, r) => [...row].forEach((ch, c) => { if (ch === '@') { sr = r; sc = c; } if (/[a-f]/.test(ch)) K2 |= 1 << (ch.charCodeAt(0) - 97); })); T.at({ grid: G(g.map(r => [...r]), { hl: [[sr, sc]] }) }); T.n('How many keys must be collected?', K2.toString(2).split('1').length - 1, 'Count lowercase letters.'); T.n('How many locks?', g.join('').split('').filter(ch => /[A-F]/.test(ch)).length, 'Count uppercase letters.'); const seen = new Set([sr + ',' + sc + ',0']); let lv = [[sr, sc, 0]], d = 0; while (lv.length) { const nx = []; for (const [r, c, k] of lv) { if (k === K2) return d; for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (x < 0 || y < 0 || x >= m || y >= n) continue; const ch = g[x][y]; if (ch === '#' || (/[A-F]/.test(ch) && !(k >> (ch.charCodeAt(0) - 65) & 1))) continue; const nk = /[a-f]/.test(ch) ? k | 1 << (ch.charCodeAt(0) - 97) : k, key = x + ',' + y + ',' + nk; if (!seen.has(key)) { seen.add(key); nx.push([x, y, nk]); } } } lv = nx; d++; } return -1; })(); T.n('Fewest moves? (−1 if impossible)', res, 'BFS over position and key set.'); return res; }
  });

  D('reachable-nodes-in-subdivided-graph', {
    t: 'Reachable Nodes in Subdivided Graph',
    r: 'Dijkstra on the original graph with edge weight cnt + 1. Count original nodes with dist ≤ maxMoves; on each edge, reach min(cnt, leftover from u + leftover from v) new nodes.',
    g: R => { const n = R.int(1, 5); return { edges: R.edges(n, R.int(0, n + 1), { w: [0, 5] }).map(([a, b, w]) => [Math.min(a, b), Math.max(a, b), w]), maxMoves: R.int(0, 10), n }; },
    s(I, T) { const n = I.n, d = Array(n).fill(Infinity), done = Array(n).fill(false); d[0] = 0; for (let it = 0; it < n; it++) { let u = -1; for (let v = 0; v < n; v++) if (!done[v] && d[v] < Infinity && (u < 0 || d[v] < d[u])) u = v; if (u < 0) break; done[u] = true; for (const [a, b, c] of I.edges) { const v = a === u ? b : b === u ? a : -1; if (v >= 0 && d[u] + c + 1 < d[v]) d[v] = d[u] + c + 1; } } let tot = d.filter(x => x <= I.maxMoves).length; T.at({ graph: GR(n, I.edges.map(e => [e[0], e[1]])), dist: A(d.map(x => x === Infinity ? '∞' : x)) }); T.n('Original nodes reachable?', tot, `dist ≤ ${I.maxMoves}.`); I.edges.forEach(([a, b, c], i) => { const x = Math.min(c, Math.max(0, I.maxMoves - d[a]) + Math.max(0, I.maxMoves - d[b])); if (i < 4) { T.at({ edge: `${a}–${b}`, cnt: c }); T.n(`New nodes reached on edge ${a}–${b}?`, x, 'Leftover moves from both ends, capped at cnt.'); } tot += x; }); return tot; }
  });

  D('snakes-and-ladders', {
    t: 'Snakes and Ladders (BFS)',
    r: 'Label squares boustrophedon from the bottom-left. BFS from square 1: each roll moves 1–6 squares, then follows a snake or ladder if one starts there. Count rolls to reach n².',
    g: R => { const n = R.int(2, 4), N = n * n, b = Array.from({ length: n }, () => Array(n).fill(-1)), cell = s => { const r = Math.floor((s - 1) / n), c = (s - 1) % n; return [n - 1 - r, r % 2 ? n - 1 - c : c]; }; for (let i = 0; i < R.int(0, 3); i++) { const s = R.int(2, N - 1), [r, c] = cell(s); b[r][c] = R.int(1, N); } return { board: b }; },
    s(I, T) { const n = I.board.length, N = n * n, val = s => { const r = Math.floor((s - 1) / n), c = (s - 1) % n; return I.board[n - 1 - r][r % 2 ? n - 1 - c : c]; }; const dist = Array(N + 1).fill(-1); dist[1] = 0; const q = [1]; for (let i = 0; i < q.length; i++) { const u = q[i]; if (u === N) return dist[u]; const nx = []; for (let k = 1; k <= 6 && u + k <= N; k++) { const v = val(u + k) > 0 ? val(u + k) : u + k; if (dist[v] < 0) { dist[v] = dist[u] + 1; q.push(v); nx.push(v); } } if (i < 4) { T.at({ board: G(I.board), square: u }); T.n(`New squares reachable from ${u} in one roll?`, nx.length, 'Follow snakes/ladders at the landing square.'); } } return -1; }
  });

  D('cat-and-mouse', {
    t: 'Cat and Mouse (retrograde analysis)',
    r: 'States (mouse, cat, whose turn). Known results: mouse at 0 wins, cat on mouse wins. Work backward: a parent is a win if one move reaches its win; it is a loss when all moves reach losses (degree counting). Unresolved states are draws.',
    g: R => { const n = R.int(3, 6); for (;;) { const e = R.edges(n, R.int(n - 1, n + 2), { conn: true }), g = Array.from({ length: n }, () => []); e.forEach(([a, b]) => { g[a].push(b); g[b].push(a); }); if (g[2].some(v => v !== 0)) return { graph: g }; } },
    s(I, T) { const g = I.graph, n = g.length, col = [...Array(n)].map(() => [...Array(n)].map(() => [0, 0])), deg = [...Array(n)].map((_, m) => [...Array(n)].map((_, c) => [g[m].length, g[c].filter(v => v !== 0).length])), q = []; for (let c = 1; c < n; c++) for (const t of [0, 1]) { col[0][c][t] = 1; q.push([0, c, t, 1]); col[c][c][t] = 2; q.push([c, c, t, 2]); } for (let i = 0; i < q.length; i++) { const [m, c, t, res] = q[i], pt = 1 - t, parents = pt === 0 ? g[m].map(pm => [pm, c]) : g[c].filter(pc => pc !== 0).map(pc => [m, pc]); for (const [pm, pc] of parents) { if (col[pm][pc][pt]) continue; if ((pt === 0 && res === 1) || (pt === 1 && res === 2)) { col[pm][pc][pt] = res; q.push([pm, pc, pt, res]); } else if (!--deg[pm][pc][pt]) { col[pm][pc][pt] = res; q.push([pm, pc, pt, res]); } } } const ans = col[1][2][0]; T.at({ graph: GR(n, g.flatMap((l, a) => l.filter(b => b > a).map(b => [a, b])), { cls: { 0: 'ok', 1: 'hit', 2: 'bad' } }) }); T.n('Neighbours of node 1, where the mouse starts?', g[1].length, 'Its first choices.'); T.yn('Can the mouse move straight to the hole from node 1?', g[1].includes(0), 'Then it wins immediately.'); T.c('Result with perfect play?', ['mouse wins (1)', 'cat wins (2)', 'draw (0)'], ['draw (0)', 'mouse wins (1)', 'cat wins (2)'][ans], 'Retrograde analysis from terminal states.'); return ans; }
  });

  D('shortest-bridge', {
    t: 'Shortest Bridge',
    r: 'Flood-fill the first island and put all its cells in a queue, then BFS outward through water; the first time BFS touches the other island, the level is the number of flips.',
    g: R => { for (;;) { const n = R.int(2, 5), g = Array.from({ length: n }, () => Array.from({ length: n }, () => R.chance(0.3) ? 1 : 0)); if (islands(g).length === 2) return { grid: g }; } },
    s(I, T) { const g = I.grid, [a] = islands(g), seen = new Set(a.map(([r, c]) => r + ',' + c)); let lv = a, d = 0; T.at({ grid: G(g, { hl: a }) }); T.n('Cells in the first island?', a.length, 'Flood fill.'); for (;;) { const nx = []; for (const [r, c] of lv) for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc, k = x + ',' + y; if (!inG(g, x, y) || seen.has(k)) continue; if (g[x][y] === 1) return d; seen.add(k); nx.push([x, y]); } d++; if (d < 4) { T.at({ grid: G(g, { hl: nx }) }); T.n(`Water cells at distance ${d}?`, nx.length, 'BFS layer.'); } lv = nx; } }
  });

  D('knight-dialer', {
    t: 'Knight Dialer',
    r: 'dp[d] = numbers of the current length ending at digit d. Each step, dp\'[d] = Σ dp[from] over digits a knight jump away. Sum after n − 1 steps, mod 1e9 + 7.',
    g: R => ({ n: R.int(1, 8) }),
    s(I, T) { const MOD = 1000000007, J = [[4, 6], [6, 8], [7, 9], [4, 8], [0, 3, 9], [], [0, 1, 7], [2, 6], [1, 3], [2, 4]]; let dp = Array(10).fill(1); T.at({ jumps: K(Object.fromEntries(J.map((l, d) => [d, l.join(',')]))) }); T.n('How many digits can a knight reach from 4?', 3, '0, 3 and 9.'); for (let s = 1; s < I.n; s++) { const nx = Array(10).fill(0); for (let d = 0; d < 10; d++) for (const f of J[d]) nx[d] = (nx[d] + dp[f]) % MOD; dp = nx; if (s < 4) { T.at({ dp: A(dp) }); T.n(`Numbers of length ${s + 1} ending in 0?`, dp[0], 'Sum over 4 and 6.'); } } return dp.reduce((a, b) => (a + b) % MOD, 0); }
  });

  D('find-the-town-judge', {
    t: 'Find the Town Judge',
    r: 'Score each person: +1 per trust received, −1 per trust given. The judge is the person with score n − 1.',
    g: R => { const n = R.int(1, 5), t = []; for (let a = 1; a <= n; a++) for (let b = 1; b <= n; b++) if (a !== b && R.chance(0.3)) t.push([a, b]); if (R.chance(0.5) && n > 1) { const j = R.int(1, n); return { n, trust: t.filter(([a]) => a !== j).concat([...Array(n).keys()].map(x => x + 1).filter(x => x !== j && !t.some(([a, b]) => a === x && b === j)).map(x => [x, j])) }; } return { n, trust: t }; },
    s(I, T) { const res = (() => { const sc = Array(I.n + 1).fill(0); I.trust.forEach(([a, b]) => { sc[a]--; sc[b]++; }); T.at({ score: A(sc.slice(1)) }); T.n('Score the judge needs?', I.n - 1, 'Trusted by everyone else, trusts nobody.'); T.n('Highest score?', Math.max(...sc.slice(1)), 'Times trusted, minus times trusting.'); for (let p = 1; p <= I.n; p++) if (sc[p] === I.n - 1) return p; return -1; })(); T.n('Town judge? (−1 if none)', res, 'The person with that exact score.'); return res; }
  });

  D('coloring-a-border', {
    t: 'Coloring a Border',
    r: 'DFS the connected component of (row, col). A component cell is on the border if it touches the grid edge or a cell outside the component. Recolor only those.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { grid: Array.from({ length: m }, () => R.ints(n, 1, 2)), row: R.int(0, m - 1), col: R.int(0, n - 1), color: R.int(1, 3) }; },
    s(I, T) { const g = I.grid, c0 = g[I.row][I.col], comp = new Set([I.row + ',' + I.col]), st = [[I.row, I.col]]; while (st.length) { const [r, c] = st.pop(); for (const [dr, dc] of DIRS) { const x = r + dr, y = c + dc; if (inG(g, x, y) && g[x][y] === c0 && !comp.has(x + ',' + y)) { comp.add(x + ',' + y); st.push([x, y]); } } } const out = g.map(r => r.slice()), border = []; for (const k of comp) { const [r, c] = k.split(',').map(Number); if (DIRS.some(([dr, dc]) => !inG(g, r + dr, c + dc) || !comp.has((r + dr) + ',' + (c + dc)))) { border.push([r, c]); out[r][c] = I.color; } } T.at({ grid: G(g, { hl: [...comp].map(k => k.split(',').map(Number)) }) }); T.n('Cells in the component?', comp.size, 'Same color, 4-connected.'); T.n('How many are border cells?', border.length, 'Touch the edge or a different cell.'); T.n('Interior cells that keep their color?', comp.size - border.length, 'Surrounded by the component on all four sides.'); return out; }
  });
})();
