/* v2 games: grids & matrices (02). */
(function () {
  'use strict';
  const { D, A, G, K, Q } = LCGame.H;
  const mat = (R, m, n, lo, hi) => Array.from({ length: m }, () => R.ints(n, lo, hi));
  const N4 = [[0, 1], [1, 0], [0, -1], [-1, 0]], N8 = [[-1, -1], [-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0], [1, 1]];
  const bfsAsk = (T, d, size, what) => { if (d < 6) { T.at({ level: d, frontier: size }); T.n(`${what} in BFS level ${d}?`, size, 'Expand level by level.'); } };

  D('shift-2d-grid', {
    t: 'Shift 2D Grid',
    r: 'Flatten row-major: element at index i moves to (i + k) mod (m·n). Map back to (row, col).',
    g: R => ({ grid: mat(R, R.int(1, 3), R.int(1, 4), 1, 9), k: R.int(0, 12) }),
    s(I, T) { const m = I.grid.length, n = I.grid[0].length, N = m * n, f = I.grid.flat(), out = Array(N); f.forEach((v, i) => out[(i + I.k) % N] = v); T.at({ grid: G(I.grid), k: I.k }); T.n('Where does flat index 0 land?', I.k % N, '(0 + k) mod m·n.'); T.n('New top-left value?', out[0], 'The element from index (−k) mod m·n.'); return Array.from({ length: m }, (_, i) => out.slice(i * n, i * n + n)); }
  });

  D('count-servers-that-communicate', {
    t: 'Count Servers that Communicate',
    r: 'Count servers per row and per column. A server communicates iff its row count > 1 or its column count > 1.',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 0, 1) }),
    s(I, T) { const g = I.grid, rc = g.map(r => r.reduce((a, b) => a + b, 0)), cc = g[0].map((_, j) => g.reduce((a, r) => a + r[j], 0)); let c = 0, asks = 0; g.forEach((r, i) => r.forEach((v, j) => { if (!v) return; const ok = rc[i] > 1 || cc[j] > 1; if (ok) c++; if (asks++ < 6) { T.at({ grid: G(g, { hl: [[i, j]] }), rowCount: rc[i], colCount: cc[j] }); T.yn('Does this server communicate?', ok, 'Another server in its row or column.'); } })); if (!asks) { T.at({ grid: G(g) }); T.n('Servers?', 0, 'None.'); } return c; }
  });

  D('find-winner-on-a-tic-tac-toe-game', {
    t: 'Find Winner on a Tic Tac Toe Game',
    r: 'Track per player the counts in each row, column and both diagonals (+1 per move). A count reaching 3 wins. Otherwise "Draw" after 9 moves, else "Pending".',
    g: R => { const cells = R.shuffle([...Array(9).keys()]).slice(0, R.int(1, 9)), mv = [], b = Array(9).fill(''); const L = [[0, 1, 2], [3, 4, 5], [6, 7, 8], [0, 3, 6], [1, 4, 7], [2, 5, 8], [0, 4, 8], [2, 4, 6]]; for (const [k, c] of cells.entries()) { b[c] = k % 2 ? 'O' : 'X'; mv.push([Math.floor(c / 3), c % 3]); if (L.some(l => l.every(i => b[i] && b[i] === b[l[0]]))) break; } return { moves: mv }; },
    s(I, T) { const c = [Array(8).fill(0), Array(8).fill(0)]; for (const [k, [r, q]] of I.moves.entries()) { const p = k % 2, a = c[p]; a[r]++; a[3 + q]++; if (r === q) a[6]++; if (r + q === 2) a[7]++; const win = a.some(x => x === 3); if (k >= 4 || win) { T.at({ player: p ? 'B' : 'A', move: `${r},${q}`, counts: A(a.slice()) }); T.yn('Does this move win?', win, 'Some line count reached 3.'); } if (win) return p ? 'B' : 'A'; } return I.moves.length === 9 ? 'Draw' : 'Pending'; }
  });

  D('minimum-number-of-flips-to-convert-binary-matrix-to-zero-matrix', {
    t: 'Minimum Number of Flips to Convert Binary Matrix to Zero Matrix',
    r: 'At most 9 cells → encode the matrix as a bitmask. BFS over masks; a move flips a cell and its 4 neighbors (XOR with a precomputed mask). First time mask 0 is reached → answer; never → −1.',
    g: R => ({ mat: mat(R, R.int(1, 3), R.int(1, 3), 0, 1) }),
    s(I, T) { const m = I.mat.length, n = I.mat[0].length, mv = []; let start = 0; I.mat.forEach((r, i) => r.forEach((v, j) => { if (v) start |= 1 << (i * n + j); })); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { let x = 1 << (i * n + j); for (const [di, dj] of N4) { const a = i + di, b = j + dj; if (a >= 0 && b >= 0 && a < m && b < n) x |= 1 << (a * n + b); } mv.push(x); } T.at({ mat: G(I.mat) }); T.n('Start mask value?', start, 'Bit i·n + j for each 1.'); const seen = new Set([start]); let q = [start], d = 0; while (q.length) { bfsAsk(T, d, q.length, 'States'); const nq = []; for (const s of q) { if (!s) return d; for (const x of mv) if (!seen.has(s ^ x)) { seen.add(s ^ x); nq.push(s ^ x); } } q = nq; d++; } return -1; }
  });

  D('shortest-path-in-a-grid-with-obstacles-elimination', {
    t: 'Shortest Path in a Grid with Obstacles Elimination',
    r: 'BFS over states (row, col, eliminations left). Stepping onto an obstacle uses one elimination. Remember the best remaining k per cell to prune. First arrival at the corner is the shortest.',
    g: R => { const g = mat(R, R.int(1, 4), R.int(1, 4), 0, 1); g[0][0] = 0; g[g.length - 1][g[0].length - 1] = 0; return { grid: g, k: R.int(0, 2) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, best = g.map(r => r.map(() => -1)); let q = [[0, 0, I.k]], d = 0; best[0][0] = I.k; while (q.length) { bfsAsk(T, d, q.length, 'States'); const nq = []; for (const [r, c, k] of q) { if (r === m - 1 && c === n - 1) return d; for (const [dr, dc] of N4) { const a = r + dr, b = c + dc; if (a < 0 || b < 0 || a >= m || b >= n) continue; const nk = k - g[a][b]; if (nk < 0 || nk <= best[a][b]) continue; best[a][b] = nk; nq.push([a, b, nk]); } } q = nq; d++; } return -1; }
  });

  D('maximum-candies-you-can-get-from-boxes', {
    t: 'Maximum Candies You Can Get from Boxes',
    r: 'Simulate with a queue of boxes you can open (have it AND it is open or you hold its key). Opening collects candies, keys (which may unlock held boxes) and contained boxes.',
    g: R => { const n = R.int(1, 6), ids = [...Array(n).keys()], contained = ids.map(() => []), keys = ids.map(() => []); ids.slice(1).forEach(b => { if (R.chance(0.7)) contained[R.int(0, n - 1)].push(b); }); ids.forEach(b => { if (R.chance(0.3)) keys[b].push(R.int(0, n - 1)); }); return { status: ids.map(() => R.int(0, 1)), candies: R.ints(n, 1, 9), keys: keys.map(k => [...new Set(k)]), containedBoxes: contained, initialBoxes: ids.filter(b => !contained.some(c => c.includes(b)) && R.chance(0.7)) }; },
    s(I, T) { const have = new Set(I.initialBoxes), key = new Set(), done = new Set(); let tot = 0, prog = true, asks = 0; while (prog) { prog = false; for (const b of [...have]) { if (done.has(b) || !(I.status[b] || key.has(b))) continue; done.add(b); prog = true; tot += I.candies[b]; I.keys[b].forEach(k => key.add(k)); I.containedBoxes[b].forEach(x => have.add(x)); if (asks++ < 6) { T.at({ opened: b, have: A([...have]), keys: A([...key]) }); T.n('Candies collected so far?', tot, 'Open any held box that is open or keyed.'); } } } if (!asks) { T.at({ initial: A(I.initialBoxes), status: A(I.status) }); T.n('Candies?', 0, 'No box can be opened.'); } return tot; }
  });

  D('jump-game-iii', {
    t: 'Jump Game III',
    r: 'BFS/DFS from start: from i you can go to i + arr[i] or i − arr[i] (in bounds). Reach any index with value 0 → true.',
    g: R => { const a = R.ints(R.int(1, 8), 0, 4); return { arr: a, start: R.int(0, a.length - 1) }; },
    s(I, T) { const a = I.arr, seen = new Set([I.start]), st = [I.start]; let asks = 0; while (st.length) { const i = st.pop(); if (asks++ < 7) { T.at({ arr: A(a, { i }) }); T.yn('Is this a zero?', a[i] === 0, 'Goal reached if so.'); } if (!a[i]) return true; for (const j of [i + a[i], i - a[i]]) if (j >= 0 && j < a.length && !seen.has(j)) { seen.add(j); st.push(j); } } return false; }
  });

  D('get-watched-videos-by-your-friends', {
    t: 'Get Watched Videos by Your Friends',
    r: 'BFS from id to find people at exactly distance `level`. Count the videos they watched and sort by frequency, then alphabetically.',
    g: R => { const n = R.int(2, 6), fr = Array.from({ length: n }, () => new Set()); for (let i = 1; i < n; i++) { const j = R.int(0, i - 1); fr[i].add(j); fr[j].add(i); } return { watchedVideos: Array.from({ length: n }, () => [...new Set(Array.from({ length: R.int(0, 2) }, () => R.pick(['A', 'B', 'C', 'D'])))]), friends: fr.map(s => [...s]), id: R.int(0, n - 1), level: R.int(1, 2) }; },
    s(I, T) { let q = [I.id]; const seen = new Set(q); for (let d = 0; d < I.level; d++) { const nq = []; for (const x of q) for (const y of I.friends[x]) if (!seen.has(y)) { seen.add(y); nq.push(y); } q = nq; } T.at({ friends: K(Object.fromEntries(I.friends.map((f, i) => [i, f.join(',')]))), id: I.id }); T.n(`People at exactly level ${I.level}?`, q.length, 'BFS layers.'); const c = {}; q.forEach(p => I.watchedVideos[p].forEach(v => c[v] = (c[v] || 0) + 1)); return Object.keys(c).sort((a, b) => c[a] - c[b] || (a < b ? -1 : 1)); }
  });

  D('matrix-block-sum', {
    t: 'Matrix Block Sum',
    r: 'Build a 2D prefix sum P. Each answer is the sum over the clipped (2k+1)×(2k+1) block: P[r2][c2] − P[r1][c2] − P[r2][c1] + P[r1][c1].',
    g: R => ({ mat: mat(R, R.int(1, 4), R.int(1, 4), 1, 9), k: R.int(0, 2) }),
    s(I, T) { const g = I.mat, m = g.length, n = g[0].length, P = Array.from({ length: m + 1 }, () => Array(n + 1).fill(0)); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) P[i + 1][j + 1] = g[i][j] + P[i][j + 1] + P[i + 1][j] - P[i][j]; T.at({ mat: G(g) }); T.n('Total sum (P[m][n])?', P[m][n], 'Prefix of everything.'); let asks = 0; return g.map((r, i) => r.map((_, j) => { const r1 = Math.max(0, i - I.k), c1 = Math.max(0, j - I.k), r2 = Math.min(m, i + I.k + 1), c2 = Math.min(n, j + I.k + 1), v = P[r2][c2] - P[r1][c2] - P[r2][c1] + P[r1][c1]; if (asks++ < 4) { T.at({ mat: G(g, { hl: [[i, j]] }), k: I.k }); T.n('Block sum here?', v, 'Inclusion–exclusion on the prefix sums.'); } return v; })); }
  });

  D('sort-the-matrix-diagonally', {
    t: 'Sort the Matrix Diagonally',
    r: 'Cells on one diagonal share i − j. Collect each diagonal, sort it, and write it back top-left to bottom-right.',
    g: R => ({ mat: mat(R, R.int(1, 4), R.int(1, 4), 1, 9) }),
    s(I, T) { const g = I.mat.map(r => r.slice()), m = g.length, n = g[0].length, D0 = {}; g.forEach((r, i) => r.forEach((v, j) => (D0[i - j] = D0[i - j] || []).push(v))); Object.values(D0).forEach(a => a.sort((x, y) => x - y)); T.at({ mat: G(I.mat) }); T.n('How many diagonals?', m + n - 1, 'One per value of i − j.'); T.n('New value at (0, 0)?', D0[0][0], 'Smallest on the main diagonal.'); const idx = {}; return g.map((r, i) => r.map((_, j) => { const k = i - j; idx[k] = (idx[k] || 0); return D0[k][idx[k]++]; })); }
  });

  D('jump-game-iv', {
    t: 'Jump Game IV',
    r: 'BFS over indices: neighbors are i − 1, i + 1 and every index with the same value. Clear each value\'s index list after first use so it is scanned once.',
    g: R => ({ arr: R.ints(R.int(1, 9), 1, 4) }),
    s(I, T) { const a = I.arr, n = a.length, grp = {}; a.forEach((v, i) => (grp[v] = grp[v] || []).push(i)); const seen = new Set([0]); let q = [0], d = 0; while (q.length) { bfsAsk(T, d, q.length, 'Indices'); const nq = []; for (const i of q) { if (i === n - 1) return d; for (const j of [i - 1, i + 1, ...(grp[a[i]] || [])]) if (j >= 0 && j < n && !seen.has(j)) { seen.add(j); nq.push(j); } grp[a[i]] = []; } q = nq; d++; } return -1; }
  });

  D('lucky-numbers-in-a-matrix', {
    t: 'Lucky Numbers in a Matrix',
    r: 'A lucky number is the minimum of its row and the maximum of its column. Compute row minima and column maxima; values in both sets are lucky (all values are distinct).',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), v = R.distinct(m * n, 1, 30); return { matrix: Array.from({ length: m }, (_, i) => v.slice(i * n, i * n + n)) }; },
    cmp: 'set',
    s(I, T) { const g = I.matrix, rm = g.map(r => Math.min(...r)), cm = g[0].map((_, j) => Math.max(...g.map(r => r[j]))); T.at({ matrix: G(g), rowMin: A(rm), colMax: A(cm) }); const out = rm.filter(x => cm.includes(x)); T.n('How many lucky numbers?', out.length, 'In both lists.'); return out; }
  });

  D('check-if-there-is-a-valid-path-in-a-grid', {
    t: 'Check if There is a Valid Path in a Grid',
    r: 'Each street type opens two directions. DFS from (0, 0): move to a neighbor only if the current cell opens toward it AND the neighbor opens back. Reaching the bottom-right → true.',
    g: R => ({ grid: mat(R, R.int(1, 3), R.int(1, 4), 1, 6) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, L = [0, -1], Rr = [0, 1], U = [-1, 0], Dn = [1, 0], O = { 1: [L, Rr], 2: [U, Dn], 3: [L, Dn], 4: [Rr, Dn], 5: [L, U], 6: [Rr, U] }; const seen = new Set(['0,0']), st = [[0, 0]]; let asks = 0; while (st.length) { const [r, c] = st.pop(); if (r === m - 1 && c === n - 1) { T.at({ grid: G(g, { hl: [[r, c]] }) }); T.yn('Reached the target?', true, 'Bottom-right corner.'); return true; } for (const [dr, dc] of O[g[r][c]]) { const a = r + dr, b = c + dc; if (a < 0 || b < 0 || a >= m || b >= n || seen.has(a + ',' + b)) continue; const ok = O[g[a][b]].some(([x, y]) => x === -dr && y === -dc); if (asks++ < 6) { T.at({ grid: G(g, { hl: [[r, c], [a, b]] }) }); T.yn(`Does street ${g[a][b]} connect back to street ${g[r][c]}?`, ok, 'The neighbor must open toward us.'); } if (ok) { seen.add(a + ',' + b); st.push([a, b]); } } } return false; }
  });

  D('diagonal-traverse-ii', {
    t: 'Diagonal Traverse II',
    r: 'Group values by i + j, visiting rows bottom-up within a group (or iterate rows top-down and prepend). Output groups in increasing i + j.',
    g: R => ({ nums: Array.from({ length: R.int(1, 4) }, () => R.ints(R.int(1, 4), 1, 9)) }),
    s(I, T) { const B = []; I.nums.forEach((r, i) => r.forEach((v, j) => (B[i + j] = B[i + j] || []).unshift(v))); B.forEach((b, d) => { if (b && d < 5) { T.at({ diagonal: d }); T.n(`First value on diagonal ${d}?`, b[0], 'The lowest row comes first.'); } }); return B.flat().filter(x => x !== undefined); }
  });

  D('minimum-swaps-to-arrange-a-binary-grid', {
    t: 'Minimum Swaps to Arrange a Binary Grid',
    r: 'Row i needs ≥ n − 1 − i trailing zeros. Greedily, for each i find the first row at or below it with enough zeros and bubble it up with adjacent swaps; none found → −1.',
    g: R => { const n = R.int(1, 4); return { grid: mat(R, n, n, 0, 1).map(r => r.map(x => R.chance(0.6) ? 0 : x)) }; },
    s(I, T) { const n = I.grid.length, z = I.grid.map(r => { let c = 0; for (let j = n - 1; j >= 0 && !r[j]; j--) c++; return c; }); T.at({ grid: G(I.grid), trailingZeros: A(z.slice()) }); let sw = 0; for (let i = 0; i < n; i++) { let j = i; while (j < n && z[j] < n - 1 - i) j++; if (i < 5) { T.at({ trailingZeros: A(z.slice(), { i }), need: n - 1 - i }); T.n(`First row at/after ${i} with enough zeros (−1 if none)?`, j < n ? j : -1, 'Greedy: the nearest one.'); } if (j === n) return -1; while (j > i) { [z[j], z[j - 1]] = [z[j - 1], z[j]]; j--; sw++; } } return sw; }
  });

  D('matrix-diagonal-sum', {
    t: 'Matrix Diagonal Sum',
    r: 'Add mat[i][i] and mat[i][n − 1 − i] for every i; for odd n the center was counted twice, so subtract it once.',
    g: R => { const n = R.int(1, 5); return { mat: mat(R, n, n, 1, 9) }; },
    s(I, T) { const n = I.mat.length; let s = 0; for (let i = 0; i < n; i++) s += I.mat[i][i] + I.mat[i][n - 1 - i]; T.at({ mat: G(I.mat) }); T.n('Sum of both diagonals counting the center twice?', s, 'Primary + secondary.'); if (n % 2) s -= I.mat[n >> 1][n >> 1]; return s; }
  });

  D('special-positions-in-a-binary-matrix', {
    t: 'Special Positions in a Binary Matrix',
    r: 'Count ones per row and column. A 1 at (i, j) is special iff rowCount[i] == 1 and colCount[j] == 1.',
    g: R => ({ mat: mat(R, R.int(1, 4), R.int(1, 4), 0, 1) }),
    s(I, T) { const g = I.mat, rc = g.map(r => r.reduce((a, b) => a + b, 0)), cc = g[0].map((_, j) => g.reduce((a, r) => a + r[j], 0)); let c = 0, asks = 0; g.forEach((r, i) => r.forEach((v, j) => { if (!v) return; const ok = rc[i] === 1 && cc[j] === 1; if (ok) c++; if (asks++ < 6) { T.at({ mat: G(g, { hl: [[i, j]] }), row: rc[i], col: cc[j] }); T.yn('Special?', ok, 'Only 1 in its row and column.'); } })); if (!asks) { T.at({ mat: G(g) }); T.n('Special positions?', 0, 'No ones.'); } return c; }
  });

  D('find-valid-matrix-given-row-and-column-sums', {
    t: 'Find Valid Matrix Given Row and Column Sums',
    r: 'Greedy: set cell (i, j) to min(rowSum[i], colSum[j]) and subtract it from both. Two pointers move on whichever sum hits 0 first.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3), g = mat(R, m, n, 0, 6); return { rowSum: g.map(r => r.reduce((a, b) => a + b, 0)), colSum: g[0].map((_, j) => g.reduce((a, r) => a + r[j], 0)) }; },
    cmp: (o, e, I) => Array.isArray(o) && o.length === I.rowSum.length && o.every((r, i) => r.length === I.colSum.length && r.every(x => x >= 0) && r.reduce((a, b) => a + b, 0) === I.rowSum[i]) && I.colSum.every((c, j) => o.reduce((a, r) => a + r[j], 0) === c),
    s(I, T) { const r = I.rowSum.slice(), c = I.colSum.slice(), g = r.map(() => Array(c.length).fill(0)); let i = 0, j = 0, asks = 0; while (i < r.length && j < c.length) { const v = Math.min(r[i], c[j]); g[i][j] = v; r[i] -= v; c[j] -= v; if (asks++ < 6) { T.at({ rowLeft: A(r.slice(), { i }), colLeft: A(c.slice(), { j }) }); T.n(`Value placed at (${i}, ${j})?`, v, 'min(row sum left, column sum left).'); } if (!r[i]) i++; else j++; } return g; }
  });

  D('lexicographically-smallest-string-after-applying-operations', {
    t: 'Lexicographically Smallest String After Applying Operations',
    r: 'There are few reachable strings (≤ 10 add-states × n rotations). BFS/DFS over states using both operations — add a to every odd index (mod 10) and rotate right by b — and keep the smallest.',
    g: R => { const n = 2 * R.int(1, 3); return { s: R.ints(n, 0, 9).join(''), a: R.int(1, 9), b: R.int(1, n - 1) }; },
    s(I, T) { const add = s => [...s].map((c, i) => i % 2 ? String((+c + I.a) % 10) : c).join(''), rot = s => s.slice(-I.b) + s.slice(0, -I.b); const seen = new Set([I.s]), q = [I.s]; let best = I.s; for (let k = 0; k < q.length; k++) { const s = q[k]; if (s < best) best = s; for (const t of [add(s), rot(s)]) if (!seen.has(t)) { seen.add(t); q.push(t); } } T.at({ s: I.s, a: I.a, b: I.b }); T.c('Result of one "add" operation?', [...new Set([add(I.s), rot(I.s), I.s])], add(I.s), 'Odd indices + a (mod 10).'); T.n('Reachable strings?', seen.size, 'Explore both operations.'); return best; }
  });

  D('richest-customer-wealth', {
    t: 'Richest Customer Wealth',
    r: 'Sum each row (one customer\'s accounts) and take the maximum.',
    g: R => ({ accounts: mat(R, R.int(1, 4), R.int(1, 4), 1, 9) }),
    s(I, T) { let best = 0; I.accounts.forEach((r, i) => { const s = r.reduce((a, b) => a + b, 0); best = Math.max(best, s); if (i < 6) { T.at({ customer: i, accounts: A(r) }); T.n('Richest so far?', best, 'Row sum vs best.'); } }); return best; }
  });

  D('where-will-the-ball-fall', {
    t: 'Where Will the Ball Fall',
    r: 'Simulate each ball row by row: a 1 sends it right, −1 left. It gets stuck if it would leave the box or the neighbor board points the opposite way (a V shape).',
    g: R => ({ grid: Array.from({ length: R.int(1, 4) }, () => Array.from({ length: 4 }, () => R.pick([1, -1]))) }),
    s(I, T) { const g = I.grid, n = g[0].length; return g[0].map((_, b) => { let c = b; for (let r = 0; r < g.length; r++) { const d = g[r][c], nc = c + d; if (nc < 0 || nc >= n || g[r][nc] !== d) { c = -1; break; } c = nc; } if (b < 5) { T.at({ grid: G(g), ball: b }); T.n(`Exit column of ball ${b} (−1 if stuck)?`, c, 'Follow the boards; a V traps it.'); } return c; }); }
  });

  D('largest-submatrix-with-rearrangements', {
    t: 'Largest Submatrix With Rearrangements',
    r: 'For each row compute column heights of consecutive 1s ending there. Sort heights descending; with k columns of height ≥ h[k], area h[k]·(k + 1). Take the max over rows.',
    g: R => ({ matrix: mat(R, R.int(1, 4), R.int(1, 4), 0, 1) }),
    s(I, T) { const n = I.matrix[0].length, h = Array(n).fill(0); let best = 0; I.matrix.forEach((r, i) => { r.forEach((v, j) => h[j] = v ? h[j] + 1 : 0); const s = h.slice().sort((a, b) => b - a); s.forEach((x, k) => best = Math.max(best, x * (k + 1))); if (i < 5) { T.at({ heights: A(h.slice()), sorted: A(s) }); T.n('Best area so far?', best, 'max over k of sorted[k] × (k + 1).'); } }); return best; }
  });

  D('shortest-path-to-get-food', {
    t: 'Shortest Path to Get Food',
    r: 'Multi-step BFS from "*" through open cells "O" (and food "#"); "X" blocks. The first level at which a "#" is reached is the answer; none → −1.',
    g: R => { const m = R.int(2, 4), n = R.int(2, 5), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.pick(['O', 'O', 'X', '#']))); g[R.int(0, m - 1)][R.int(0, n - 1)] = '*'; return { grid: g }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; let s; g.forEach((r, i) => r.forEach((v, j) => { if (v === '*') s = [i, j]; })); const seen = new Set([s.join()]); let q = [s], d = 0; while (q.length) { bfsAsk(T, d, q.length, 'Cells'); const nq = []; for (const [r, c] of q) { if (g[r][c] === '#') return d; for (const [dr, dc] of N4) { const a = r + dr, b = c + dc; if (a < 0 || b < 0 || a >= m || b >= n || g[a][b] === 'X' || seen.has(a + ',' + b)) continue; seen.add(a + ',' + b); nq.push([a, b]); } } q = nq; d++; } return -1; }
  });

  D('find-kth-largest-xor-coordinate-value', {
    t: 'Find Kth Largest XOR Coordinate Value',
    r: 'Build the 2D prefix XOR: P[i][j] = P[i−1][j] ^ P[i][j−1] ^ P[i−1][j−1] ^ matrix[i][j]. Collect all values and take the k-th largest (sort or quickselect).',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3); return { matrix: mat(R, m, n, 0, 7), k: R.int(1, m * n) }; },
    s(I, T) { const g = I.matrix, m = g.length, n = g[0].length, P = Array.from({ length: m + 1 }, () => Array(n + 1).fill(0)), vals = []; let asks = 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { P[i + 1][j + 1] = P[i][j + 1] ^ P[i + 1][j] ^ P[i][j] ^ g[i][j]; vals.push(P[i + 1][j + 1]); if (asks++ < 5) { T.at({ matrix: G(g, { hl: [[i, j]] }) }); T.n('XOR value of this coordinate?', P[i + 1][j + 1], 'Prefix XOR recurrence.'); } } vals.sort((a, b) => b - a); return vals[I.k - 1]; }
  });

  D('map-of-highest-peak', {
    t: 'Map of Highest Peak',
    r: 'Multi-source BFS from all water cells (height 0). Each land cell gets its BFS distance — neighbors then differ by at most 1 and heights are maximal.',
    g: R => { const g = mat(R, R.int(1, 4), R.int(1, 4), 0, 1); if (!g.flat().some(x => x)) g[0][0] = 1; return { isWater: g }; },
    s(I, T) { const w = I.isWater, m = w.length, n = w[0].length, h = w.map(r => r.map(x => x ? 0 : -1)); let q = []; w.forEach((r, i) => r.forEach((v, j) => v && q.push([i, j]))); let d = 0; while (q.length) { bfsAsk(T, d, q.length, 'Cells'); const nq = []; for (const [r, c] of q) for (const [dr, dc] of N4) { const a = r + dr, b = c + dc; if (a < 0 || b < 0 || a >= m || b >= n || h[a][b] >= 0) continue; h[a][b] = d + 1; nq.push([a, b]); } q = nq; d++; } return h; }
  });

  D('get-biggest-three-rhombus-sums-in-a-grid', {
    t: 'Get Biggest Three Rhombus Sums in a Grid',
    r: 'Enumerate every rhombus by its top cell and size k (k = 0 is a single cell), summing its border (diagonal prefix sums speed this up). Keep the three largest distinct sums.',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 1, 9) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, S = new Set(); for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) for (let k = 0; r + 2 * k < m && c - k >= 0 && c + k < n; k++) { if (!k) { S.add(g[r][c]); continue; } let s = 0; for (let t = 0; t < k; t++) s += g[r + t][c + t] + g[r + k + t][c + k - t] + g[r + 2 * k - t][c - t] + g[r + k - t][c - k + t]; S.add(s); } const top = [...S].sort((a, b) => b - a).slice(0, 3); T.at({ grid: G(g) }); T.n('Distinct rhombus sums found?', S.size, 'Single cells count as size-0 rhombi.'); T.n('Largest?', top[0], 'Max of the set.'); return top; }
  });

  D('determine-whether-matrix-can-be-obtained-by-rotation', {
    t: 'Determine Whether Matrix Can Be Obtained By Rotation',
    r: 'Try 0, 90, 180 and 270 degree rotations of mat and compare each with target.',
    g: R => { const n = R.int(1, 3), a = mat(R, n, n, 0, 1); let t = a.map(r => r.slice()); for (let k = R.int(0, 3); k--;) t = t[0].map((_, j) => t.map(r => r[j]).reverse()); if (R.chance(0.3)) t[0][0] ^= 1; return { mat: a, target: t }; },
    s(I, T) { let m = I.mat; for (let k = 0; k < 4; k++) { const eq = JSON.stringify(m) === JSON.stringify(I.target); T.at({ rotated: G(m), target: G(I.target) }); T.yn(`Equal after ${k * 90}°?`, eq, 'Compare cell by cell.'); if (eq) return true; m = m[0].map((_, j) => m.map(r => r[j]).reverse()); } return false; }
  });

  D('largest-magic-square', {
    t: 'Largest Magic Square',
    r: 'Try sizes k from min(m, n) down to 2; for each k×k window check all row, column and both diagonal sums are equal (row/column prefix sums make each check O(k)). Size 1 always works.',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 1, 3) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; for (let k = Math.min(m, n); k >= 2; k--) { let found = false; for (let r = 0; r + k <= m && !found; r++) for (let c = 0; c + k <= n && !found; c++) { const t = g[r].slice(c, c + k).reduce((a, b) => a + b, 0); let ok = true; for (let i = 0; i < k && ok; i++) { if (g[r + i].slice(c, c + k).reduce((a, b) => a + b, 0) !== t) ok = false; let cs = 0; for (let j = 0; j < k; j++) cs += g[r + j][c + i]; if (cs !== t) ok = false; } let d1 = 0, d2 = 0; for (let i = 0; i < k; i++) { d1 += g[r + i][c + i]; d2 += g[r + i][c + k - 1 - i]; } if (d1 !== t || d2 !== t) ok = false; found = ok; } T.at({ grid: G(g), size: k }); T.yn(`Is there a magic square of size ${k}?`, found, 'All lines equal in some window.'); if (found) return k; } return 1; }
  });

  D('cyclically-rotating-a-grid', {
    t: 'Cyclically Rotating a Grid',
    r: 'Peel each layer into a list (clockwise from its top-left), rotate the list left by k mod length (a counter-clockwise rotation), and write it back.',
    g: R => ({ grid: mat(R, 2 * R.int(1, 2), 2 * R.int(1, 2), 1, 9), k: R.int(1, 8) }),
    s(I, T) { const g = I.grid.map(r => r.slice()), m = g.length, n = g[0].length; for (let L = 0; L < Math.min(m, n) / 2; L++) { const pos = []; for (let j = L; j < n - L; j++) pos.push([L, j]); for (let i = L + 1; i < m - L; i++) pos.push([i, n - 1 - L]); for (let j = n - 2 - L; j >= L; j--) pos.push([m - 1 - L, j]); for (let i = m - 2 - L; i > L; i--) pos.push([i, L]); const v = pos.map(([i, j]) => g[i][j]), s = I.k % v.length; pos.forEach(([i, j], t) => g[i][j] = v[(t + s) % v.length]); T.at({ layer: L, values: A(v) }); T.n(`Cells in layer ${L}?`, v.length, 'Perimeter of the layer.'); } return g; }
  });

  D('check-if-move-is-legal', {
    t: 'Check if Move is Legal',
    r: 'From the move cell, look in each of 8 directions: there must be at least one opposite-color cell in a row, ending at a cell of your color (a line of length ≥ 3). Any such direction → legal.',
    g: R => { const b = Array.from({ length: 8 }, () => Array.from({ length: 8 }, () => R.pick(['.', 'B', 'W']))); const r = R.int(0, 7), c = R.int(0, 7); b[r][c] = '.'; return { board: b, rMove: r, cMove: c, color: R.pick(['B', 'W']) }; },
    s(I, T) { const b = I.board, me = I.color, op = me === 'B' ? 'W' : 'B'; for (const [dr, dc] of N8) { let r = I.rMove + dr, c = I.cMove + dc, k = 0; while (r >= 0 && c >= 0 && r < 8 && c < 8 && b[r][c] === op) { r += dr; c += dc; k++; } const ok = k > 0 && r >= 0 && c >= 0 && r < 8 && c < 8 && b[r][c] === me; if (k) { T.at({ board: G(b, { hl: [[I.rMove, I.cMove]] }), direction: `${dr},${dc}`, opposite: k }); T.yn('Does this direction end on your color?', ok, 'Opposite cells, then yours.'); } if (ok) return true; } return false; }
  });

  D('maximum-matrix-sum', {
    t: 'Maximum Matrix Sum',
    r: 'Flipping adjacent pairs can move a minus sign anywhere, so negatives cancel in pairs. Sum of |values|; if the count of negatives is odd, subtract 2 × the smallest |value|.',
    g: R => { const n = R.int(2, 4); return { matrix: mat(R, n, n, -5, 5) }; },
    s(I, T) { const f = I.matrix.flat(), neg = f.filter(x => x < 0).length, abs = f.reduce((s, x) => s + Math.abs(x), 0), mn = Math.min(...f.map(Math.abs)); T.at({ matrix: G(I.matrix) }); T.n('Number of negatives?', neg, 'Pairs cancel out.'); T.n('Sum of absolute values?', abs, 'Best case.'); return neg % 2 ? abs - 2 * mn : abs; }
  });

  D('find-all-groups-of-farmland', {
    t: 'Find All Groups of Farmland',
    r: 'Farmland groups are rectangles. At a 1 whose top and left are not farmland (a top-left corner), extend down and right to find the bottom-right corner.',
    g: R => { const m = R.int(1, 5), n = R.int(1, 5), g = Array.from({ length: m }, () => Array(n).fill(0)); for (let k = 0; k < 3; k++) { const r = R.int(0, m - 1), c = R.int(0, n - 1), h = R.int(1, 2), w = R.int(1, 2); let ok = true; for (let i = r - 1; i <= r + h; i++) for (let j = c - 1; j <= c + w; j++) if (i >= 0 && j >= 0 && i < m && j < n && g[i][j]) ok = false; if (ok && r + h <= m && c + w <= n) for (let i = r; i < r + h; i++) for (let j = c; j < c + w; j++) g[i][j] = 1; } return { land: g }; },
    cmp: 'set',
    s(I, T) { const g = I.land, out = []; g.forEach((r, i) => r.forEach((v, j) => { if (!v || (i && g[i - 1][j]) || (j && r[j - 1])) return; let a = i, b = j; while (a + 1 < g.length && g[a + 1][j]) a++; while (b + 1 < r.length && r[b + 1]) b++; out.push([i, j, a, b]); T.at({ land: G(g, { hl: [[i, j]] }) }); T.c('Bottom-right corner of this group?', [...new Set([`${a},${b}`, `${i},${b}`, `${a},${j}`])], `${a},${b}`, 'Extend down and right.'); })); if (!out.length) { T.at({ land: G(g) }); T.n('Groups?', 0, 'No farmland.'); } return out; }
  });

  D('smallest-greater-multiple-made-of-two-digits', {
    t: 'Smallest Greater Multiple Made of Two Digits',
    r: 'Generate numbers made only of digit1/digit2 in increasing order (by length, then value — BFS over digits) and return the first that exceeds k and is divisible by k, staying within 2^31 − 1; else −1.',
    g: R => ({ k: R.int(1, 30), digit1: R.int(0, 9), digit2: R.int(0, 9) }),
    s(I, T) { const ds = [...new Set([I.digit1, I.digit2])].sort((a, b) => a - b); let q = ds.filter(d => d > 0), asks = 0; while (q.length) { for (const x of q) if (x > I.k && x % I.k === 0) { T.at({ k: I.k, digits: A(ds) }); T.n('Answer?', x, 'First valid number in increasing order.'); return x; } const nq = []; for (const x of q) for (const d of ds) { const y = x * 10 + d; if (y <= 2147483647) nq.push(y); } if (asks++ < 3) { T.at({ k: I.k, digits: A(ds), length: String(q[0]).length }); T.n(`Candidates of length ${String(q[0]).length}?`, q.length, 'All combos of the two digits.'); } q = nq; } T.at({ k: I.k, digits: A(ds) }); T.yn('Found any valid multiple?', false, 'Return −1.'); return -1; }
  });

  D('grid-game', {
    t: 'Grid Game',
    r: 'If robot 1 turns down at column i, robot 2 can only take either the top row after i or the bottom row before i. Robot 1 minimizes max(topSuffix, bottomPrefix) over i.',
    g: R => { const n = R.int(1, 6); return { grid: [R.ints(n, 1, 9), R.ints(n, 1, 9)] }; },
    s(I, T) { const [a, b] = I.grid; let top = a.reduce((x, y) => x + y, 0), bot = 0, best = Infinity; for (let i = 0; i < a.length; i++) { top -= a[i]; const v = Math.max(top, bot); best = Math.min(best, v); if (i < 6) { T.at({ grid: G(I.grid), turnAt: i, topAfter: top, bottomBefore: bot }); T.n('Robot 2\'s best if robot 1 turns here?', v, 'max(top suffix, bottom prefix).'); } bot += b[i]; } return best; }
  });

  D('check-if-word-can-be-placed-in-crossword', {
    t: 'Check if Word Can Be Placed In Crossword',
    r: 'Split every row and column (and their reverses) into slots between "#" cells. A slot fits if its length equals the word\'s and each cell is blank or the matching letter.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { board: Array.from({ length: m }, () => Array.from({ length: n }, () => R.pick(['#', ' ', ' ', 'a', 'b']))), word: R.str(R.int(1, 3), 'ab') }; },
    s(I, T) { const b = I.board, lines = [...b.map(r => r.join('')), ...b[0].map((_, j) => b.map(r => r[j]).join(''))]; let asks = 0; for (const L of lines) for (const sl of L.split('#')) for (const s of [sl, [...sl].reverse().join('')]) { if (s.length !== I.word.length) continue; const ok = [...s].every((c, i) => c === ' ' || c === I.word[i]); if (asks++ < 6) { T.at({ slot: JSON.stringify(s), word: I.word }); T.yn('Does the word fit this slot?', ok, 'Blank or matching letters.'); } if (ok) return true; } if (!asks) { T.at({ word: I.word }); T.yn('Any slot of the right length?', false, 'None.'); } return false; }
  });

  D('convert-1d-array-into-2d-array', {
    t: 'Convert 1D Array Into 2D Array',
    r: 'Possible only if m·n equals the length. Then element i goes to row ⌊i / n⌋, column i mod n.',
    g: R => ({ original: R.ints(R.int(1, 8), 1, 9), m: R.int(1, 4), n: R.int(1, 4) }),
    s(I, T) { T.at({ length: I.original.length, m: I.m, n: I.n }); T.yn('Is m·n equal to the length?', I.m * I.n === I.original.length, 'Otherwise return [].'); if (I.m * I.n !== I.original.length) return []; return Array.from({ length: I.m }, (_, i) => I.original.slice(i * I.n, i * I.n + I.n)); }
  });

  D('number-of-spaces-cleaning-robot-cleaned', {
    t: 'Number of Spaces Cleaning Robot Cleaned',
    r: 'Simulate: move straight; when blocked (edge or object), turn 90° clockwise. Stop when a (cell, direction) state repeats. Count distinct cells visited.',
    g: R => { const g = mat(R, R.int(1, 4), R.int(1, 4), 0, 1).map(r => r.map(x => x && R.chance(0.6) ? 1 : 0)); g[0][0] = 0; return { room: g }; },
    s(I, T) { const g = I.room, m = g.length, n = g[0].length; let r = 0, c = 0, d = 0, asks = 0; const cells = new Set(), st = new Set(); while (!st.has(`${r},${c},${d}`)) { st.add(`${r},${c},${d}`); cells.add(r + ',' + c); const a = r + N4[d][0], b = c + N4[d][1]; const blocked = a < 0 || b < 0 || a >= m || b >= n || g[a][b] === 1; if (asks++ < 6) { T.at({ room: G(g, { hl: [[r, c]] }), facing: ['right', 'down', 'left', 'up'][d] }); T.yn('Is the way ahead blocked?', blocked, 'Then turn clockwise.'); } if (blocked) d = (d + 1) % 4; else { r = a; c = b; } } return cells.size; }
  });

  D('decode-the-slanted-ciphertext', {
    t: 'Decode the Slanted Ciphertext',
    r: 'cols = length / rows. The text was written down diagonals, so read each diagonal starting at (0, c) moving (+1, +1), for c = 0, 1, …; finally strip trailing spaces.',
    g: R => { const rows = R.int(1, 3), txt = R.str(R.int(1, 7), 'abc d'), cols = Math.ceil(txt.length / rows) + rows; const g = Array.from({ length: rows }, () => Array(cols).fill(' ')); [...txt].forEach((ch, i) => { const r = i % rows, c = Math.floor(i / rows) + r; if (c < cols) g[r][c] = ch; }); return { encodedText: g.map(r => r.join('')).join(''), rows }; },
    s(I, T) { const n = I.encodedText.length, cols = n / I.rows; T.at({ length: n, rows: I.rows }); T.n('Columns?', cols, 'length / rows.'); let out = ''; for (let c = 0; c < cols; c++) for (let r = 0, j = c; r < I.rows && j < cols; r++, j++) out += I.encodedText[r * cols + j]; return out.replace(/\s+$/, ''); }
  });

  D('minimum-cost-homecoming-of-a-robot-in-a-grid', {
    t: 'Minimum Cost Homecoming of a Robot in a Grid',
    r: 'Any shortest path enters each row between start and home exactly once (and likewise columns), and detours only add cost. So sum rowCosts of rows strictly after start up to home, plus the same for columns.',
    g: R => { const m = R.int(1, 5), n = R.int(1, 5); return { startPos: [R.int(0, m - 1), R.int(0, n - 1)], homePos: [R.int(0, m - 1), R.int(0, n - 1)], rowCosts: R.ints(m, 0, 9), colCosts: R.ints(n, 0, 9) }; },
    s(I, T) { const sum = (a, s, e) => { let t = 0; if (s < e) for (let i = s + 1; i <= e; i++) t += a[i]; else for (let i = s - 1; i >= e; i--) t += a[i]; return t; }; const r = sum(I.rowCosts, I.startPos[0], I.homePos[0]), c = sum(I.colCosts, I.startPos[1], I.homePos[1]); T.at({ start: I.startPos.join(','), home: I.homePos.join(','), rowCosts: A(I.rowCosts) }); T.n('Row cost total?', r, 'Rows entered, excluding the start row.'); T.at({ colCosts: A(I.colCosts) }); T.n('Column cost total?', c, 'Columns entered, excluding the start column.'); return r + c; }
  });

  D('number-of-laser-beams-in-a-bank', {
    t: 'Number of Laser Beams in a Bank',
    r: 'Skip empty rows. Beams connect each pair of consecutive non-empty rows: add prev × cur device counts.',
    g: R => ({ bank: Array.from({ length: R.int(1, 5) }, () => R.str(R.int(3, 3), '0001')) }),
    s(I, T) { let prev = 0, tot = 0, asks = 0; I.bank.forEach((row, i) => { const c = [...row].filter(x => x === '1').length; if (!c) return; tot += prev * c; if (asks++ < 6) { T.at({ row: i, devices: c, previous: prev }); T.n('Beams so far?', tot, 'prev × cur.'); } prev = c; }); if (!asks) { T.at({ bank: A(I.bank) }); T.n('Beams?', 0, 'No devices.'); } return tot; }
  });
})();
