/* v2 games: grids & matrices (01). */
(function () {
  'use strict';
  const { D, A, G, K, Q } = LCGame.H;
  const mat = (R, m, n, lo, hi) => Array.from({ length: m }, () => R.ints(n, lo, hi));
  const N8 = [[-1, -1], [-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0], [1, 1]];
  const gcd = (a, b) => b ? gcd(b, a % b) : a;

  D('valid-sudoku', {
    t: 'Valid Sudoku',
    r: 'One pass over the filled cells with three sets of seen digits: per row, per column, and per 3×3 box (index ⌊r/3⌋·3 + ⌊c/3⌋). A repeat anywhere → invalid.',
    g: R => { const base = Array.from({ length: 9 }, (_, r) => Array.from({ length: 9 }, (_, c) => String(((r * 3 + Math.floor(r / 3) + c) % 9) + 1))); const b = base.map(row => row.map(v => R.chance(0.3) ? v : '.')); if (R.chance(0.5)) { const r = R.int(0, 8), c = R.int(0, 8); b[r][c] = String(R.int(1, 9)); } return { board: b }; },
    s(I, T) { const seen = new Set(); let asks = 0; for (let r = 0; r < 9; r++) for (let c = 0; c < 9; c++) { const v = I.board[r][c]; if (v === '.') continue; const keys = [`r${r}${v}`, `c${c}${v}`, `b${Math.floor(r / 3) * 3 + Math.floor(c / 3)}${v}`], dup = keys.some(k => seen.has(k)); if (dup || (asks < 5 && R0(r, c))) { asks++; T.at({ board: G(I.board, { hl: [[r, c]] }) }); T.yn(`Has ${v} already appeared in this row, column or box?`, dup, 'Check all three sets.'); } if (dup) return false; keys.forEach(k => seen.add(k)); } if (!asks) { T.at({ board: G(I.board) }); T.yn('Any repeat?', false, 'Valid.'); } return true; }
  });
  function R0(r, c) { return (r * 9 + c) % 13 === 0; }

  D('rotate-image', {
    t: 'Rotate Image',
    r: 'Rotate 90° clockwise in place: transpose (swap across the main diagonal), then reverse each row.',
    g: R => { const n = R.int(1, 4); return { matrix: mat(R, n, n, 1, 9) }; },
    s(I, T) { const res = (() => { const n = I.matrix.length, m = I.matrix.map(r => r.slice()); for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) [m[i][j], m[j][i]] = [m[j][i], m[i][j]]; T.at({ matrix: G(I.matrix) }); T.n('After transposing, what is at row 0, column 1?', n > 1 ? m[0][1] : m[0][0], 'Transpose swaps (i, j) and (j, i).'); m.forEach(r => r.reverse()); T.at({ transposed: G(I.matrix.map((_, i) => I.matrix.map(r => r[i]))) }); T.n('Top-left value of the rotated matrix?', m[0][0], 'Reverse each row.'); return m; })(); const n = res.length; T.n('Bottom-right value of the rotated matrix?', res[n - 1][n - 1], 'It was the top-right of the original.'); return res; }
  });

  D('spiral-matrix', {
    t: 'Spiral Matrix',
    r: 'Keep four bounds (top, bottom, left, right). Walk right along top, down along right, left along bottom, up along left, shrinking each bound after its side; stop when they cross.',
    g: R => ({ matrix: mat(R, R.int(1, 4), R.int(1, 4), 1, 9) }),
    s(I, T) { const m = I.matrix, out = []; let t = 0, b = m.length - 1, l = 0, r = m[0].length - 1, asks = 0; const ask = (side) => { if (asks++ < 5) { T.at({ matrix: G(m), out: A(out.slice()) }); T.n(`Elements collected after the ${side} side?`, out.length, 'Walk the side, then shrink the bound.'); } }; while (t <= b && l <= r) { for (let j = l; j <= r; j++) out.push(m[t][j]); t++; ask('top'); for (let i = t; i <= b; i++) out.push(m[i][r]); r--; ask('right'); if (t <= b) { for (let j = r; j >= l; j--) out.push(m[b][j]); b--; ask('bottom'); } if (l <= r) { for (let i = b; i >= t; i--) out.push(m[i][l]); l++; ask('left'); } } return out; }
  });

  D('spiral-matrix-ii', {
    t: 'Spiral Matrix II',
    r: 'Fill 1..n² along the spiral using shrinking bounds (top row → right column → bottom row → left column).',
    g: R => ({ n: R.int(1, 5) }),
    s(I, T) { const res = (() => { const n = I.n, m = Array.from({ length: n }, () => Array(n).fill(0)); let t = 0, b = n - 1, l = 0, r = n - 1, k = 1; while (k <= n * n) { for (let j = l; j <= r; j++) m[t][j] = k++; t++; for (let i = t; i <= b; i++) m[i][r] = k++; r--; for (let j = r; j >= l; j--) m[b][j] = k++; b--; for (let i = b; i >= t; i--) m[i][l] = k++; l++; } T.at({ n }); T.n('Value at the bottom-left corner?', m[n - 1][0], 'After top row, right column and bottom row.'); T.n('Value at the center (or just inside the top-left)?', m[n >> 1][(n - 1) >> 1], 'Follow the spiral.'); return m; })(); T.n('Value at row 0, last column?', res[0][res.length - 1], 'The top row fills first, so it is n.'); return res; }
  });

  D('set-matrix-zeroes', {
    t: 'Set Matrix Zeroes',
    r: 'Record which rows and columns contain a zero (O(1) space: use the first row/column as markers plus two flags), then zero every cell whose row or column is marked.',
    g: R => ({ matrix: mat(R, R.int(1, 4), R.int(1, 4), 0, 4) }),
    s(I, T) { const res = (() => { const m = I.matrix, rs = new Set(), cs = new Set(); m.forEach((r, i) => r.forEach((v, j) => { if (!v) { rs.add(i); cs.add(j); } })); T.at({ matrix: G(m) }); T.n('Rows marked for zeroing?', rs.size, 'Rows containing a 0.'); T.n('Columns marked?', cs.size, 'Columns containing a 0.'); return m.map((r, i) => r.map((v, j) => rs.has(i) || cs.has(j) ? 0 : v)); })(); T.n('Zeros in the result?', res.flat().filter(v => v === 0).length, 'Every cell in a marked row or column.'); return res; }
  });

  D('game-of-life', {
    t: 'Game of Life',
    r: 'Count live neighbors for each cell using the old state (in place: encode transitions as 2 = live→dead, 3 = dead→live). Live with 2–3 neighbors survives; dead with exactly 3 is born.',
    g: R => ({ board: mat(R, R.int(1, 4), R.int(1, 4), 0, 1) }),
    s(I, T) { const b = I.board, m = b.length, n = b[0].length; let asks = 0; const out = b.map((r, i) => r.map((v, j) => { let c = 0; for (const [di, dj] of N8) { const x = i + di, y = j + dj; if (x >= 0 && y >= 0 && x < m && y < n) c += b[x][y]; } const nv = (v && (c === 2 || c === 3)) || (!v && c === 3) ? 1 : 0; if (asks++ < 6) { T.at({ board: G(b, { hl: [[i, j]] }), liveNeighbors: c }); T.yn('Alive in the next generation?', !!nv, v ? 'Survives with 2 or 3.' : 'Born with exactly 3.'); } return nv; })); return out; }
  });

  D('best-meeting-point', {
    t: 'Best Meeting Point',
    r: 'Manhattan distance splits into rows and columns. The best row is the median of the people\'s rows and the best column the median of their columns; sum the distances.',
    g: R => { const g = mat(R, R.int(1, 4), R.int(1, 5), 0, 1); if (!g.flat().filter(x => x).length) g[0][0] = 1; if (g.flat().filter(x => x).length < 2) g[g.length - 1][g[0].length - 1] = 1; return { grid: g }; },
    s(I, T) { const res = (() => { const rows = [], cols = []; I.grid.forEach((r, i) => r.forEach((v, j) => { if (v) { rows.push(i); cols.push(j); } })); cols.sort((a, b) => a - b); const mr = rows[rows.length >> 1], mc = cols[cols.length >> 1]; T.at({ grid: G(I.grid), rows: A(rows), cols: A(cols) }); T.n('Median row?', mr, 'Middle of the sorted rows.'); T.n('Median column?', mc, 'Middle of the sorted columns.'); return rows.reduce((s, r) => s + Math.abs(r - mr), 0) + cols.reduce((s, c) => s + Math.abs(c - mc), 0); })(); T.n('Minimum total distance?', res, 'Row distances to the median row plus column distances to the median column.'); return res; }
  });

  D('sparse-matrix-multiplication', {
    t: 'Sparse Matrix Multiplication',
    r: 'For each non-zero mat1[i][k], add mat1[i][k] · mat2[k][j] into res[i][j] for every non-zero mat2[k][j] — zeros are skipped entirely.',
    g: R => { const m = R.int(1, 3), k = R.int(1, 3), n = R.int(1, 3), sp = () => R.chance(0.5) ? 0 : R.int(-3, 4); return { mat1: Array.from({ length: m }, () => Array.from({ length: k }, sp)), mat2: Array.from({ length: k }, () => Array.from({ length: n }, sp)) }; },
    s(I, T) { const res = (() => { const a = I.mat1, b = I.mat2, res = a.map(() => Array(b[0].length).fill(0)); let nz = 0; a.forEach((r, i) => r.forEach((v, k) => { if (!v) return; nz++; b[k].forEach((w, j) => { if (w) res[i][j] += v * w; }); })); T.at({ mat1: G(a), mat2: G(b) }); T.n('Non-zero entries of mat1 that get processed?', nz, 'Zeros are skipped.'); T.n('res[0][0]?', res[0][0], 'Sum of mat1[0][k] times mat2[k][0].'); return res; })(); T.n('Non-zero entries in the result?', res.flat().filter(v => v !== 0).length, 'Count them in the product.'); return res; }
  });

  D('nested-list-weight-sum', {
    t: 'Nested List Weight Sum',
    r: 'DFS with depth (top level = 1): each integer contributes value × depth.',
    g: R => { const gen = d => Array.from({ length: R.int(1, 3) }, () => d < 3 && R.chance(0.35) ? gen(d + 1) : R.int(0, 6)); return { nestedList: gen(1) }; },
    s(I, T) { let s = 0, asks = 0; const go = (L, d) => { for (const x of L) { if (Array.isArray(x)) go(x, d + 1); else { s += x * d; if (asks++ < 8) { T.at({ value: x, depth: d }); T.n('Running weighted sum?', s, 'value × depth.'); } } } }; go(I.nestedList, 1); if (!asks) { T.at({ list: JSON.stringify(I.nestedList) }); T.n('Sum?', 0, 'No integers.'); } return s; }
  });

  D('nested-list-weight-sum-ii', {
    t: 'Nested List Weight Sum II',
    r: 'Weights are inverted: weight = maxDepth − depth + 1. Find maxDepth first (or accumulate level sums top-down and add the running total at each level).',
    g: R => { const gen = d => Array.from({ length: R.int(1, 3) }, () => d < 3 && R.chance(0.35) ? gen(d + 1) : R.int(0, 6)); return { nestedList: gen(1) }; },
    s(I, T) { const md = (L, d) => L.reduce((m, x) => Math.max(m, Array.isArray(x) ? md(x, d + 1) : d), d), M = md(I.nestedList, 1); T.at({ list: JSON.stringify(I.nestedList) }); T.n('Maximum depth?', M, 'Deepest integer\'s level.'); let s = 0, asks = 0; const go = (L, d) => { for (const x of L) { if (Array.isArray(x)) go(x, d + 1); else { s += x * (M - d + 1); if (asks++ < 6) { T.at({ value: x, weight: M - d + 1 }); T.n('Running sum?', s, 'value × (maxDepth − depth + 1).'); } } } }; go(I.nestedList, 1); return s; }
  });

  D('water-and-jug-problem', {
    t: 'Water and Jug Problem',
    r: 'By Bézout, the reachable amounts are exactly the multiples of gcd(x, y) up to x + y. So: target ≤ x + y and target % gcd(x, y) == 0.',
    g: R => ({ x: R.int(1, 9), y: R.int(1, 9), target: R.int(0, 18) }),
    s(I, T) { const res = (() => { const g = gcd(I.x, I.y); T.at({ x: I.x, y: I.y, target: I.target }); T.n('gcd(x, y)?', g, 'Every reachable total is a multiple of it.'); T.yn('Is target at most x + y?', I.target <= I.x + I.y, 'The jugs cannot hold more.'); return I.target <= I.x + I.y && I.target % g === 0; })(); T.yn('Can you measure exactly target?', res, 'It must fit and be a multiple of the gcd.'); return res; }
  });

  D('battleships-in-a-board', {
    t: 'Battleships in a Board',
    r: 'Count only the "head" of each ship: an X whose top and left neighbors are not X. One pass, O(1) extra space.',
    g: R => { const m = R.int(1, 5), n = R.int(1, 5), b = Array.from({ length: m }, () => Array(n).fill('.')); for (let k = 0; k < 4; k++) { const r = R.int(0, m - 1), c = R.int(0, n - 1), h = R.chance(0.5), L = R.int(1, 3), cells = []; for (let t = 0; t < L; t++) { const x = h ? r : r + t, y = h ? c + t : c; if (x >= m || y >= n) break; cells.push([x, y]); } const ok = cells.every(([x, y]) => [[0, 0], [1, 0], [-1, 0], [0, 1], [0, -1]].every(([dx, dy]) => { const a = x + dx, q = y + dy; return a < 0 || q < 0 || a >= m || q >= n || b[a][q] === '.'; })); if (ok) cells.forEach(([x, y]) => b[x][y] = 'X'); } return { board: b }; },
    s(I, T) { const b = I.board; let c = 0, asks = 0; b.forEach((r, i) => r.forEach((v, j) => { if (v !== 'X') return; const head = (!i || b[i - 1][j] !== 'X') && (!j || b[i][j - 1] !== 'X'); if (head) c++; if (asks++ < 7) { T.at({ board: G(b, { hl: [[i, j]] }) }); T.yn('Is this X the head of a ship?', head, 'No X above or to the left.'); } })); if (!asks) { T.at({ board: G(b) }); T.n('Ships?', 0, 'Empty board.'); } return c; }
  });

  D('valid-word-square', {
    t: 'Valid Word Square',
    r: 'Row k must equal column k: for every i, j, words[i][j] must exist and equal words[j][i] (watch for ragged lengths).',
    g: R => { const n = R.int(1, 4), m = Array.from({ length: n }, () => Array(n).fill('')); for (let i = 0; i < n; i++) for (let j = i; j < n; j++) m[i][j] = m[j][i] = R.pick('abc'); let w = m.map(r => r.join('')); if (R.chance(0.4)) { const i = R.int(0, n - 1); w[i] = R.chance(0.5) ? w[i].slice(0, -1) || 'a' : w[i].slice(0, -1) + 'z'; } return { words: w }; },
    s(I, T) { const w = I.words; for (let i = 0; i < w.length; i++) { for (let j = 0; j < w[i].length; j++) { const ok = j < w.length && i < w[j].length && w[i][j] === w[j][i]; if (!ok || i === j) { T.at({ words: G(w.map(x => [...x])), at: `(${i}, ${j})` }); T.yn(`Does words[${i}][${j}] equal words[${j}][${i}]?`, ok, 'Row k must read like column k.'); } if (!ok) return false; } } return true; }
  });

  D('minimum-genetic-mutation', {
    t: 'Minimum Genetic Mutation',
    r: 'BFS from the start gene: neighbors are bank genes differing in exactly one position. The BFS level at which endGene is reached is the answer; unreachable → −1.',
    g: R => { const g = () => R.str(8, 'AC'); const s = g(), bank = [...new Set(Array.from({ length: R.int(0, 6) }, () => { const a = [...s]; for (let k = R.int(1, 3); k--;) a[R.int(0, 7)] = R.pick('ACGT'); return a.join(''); }))]; return { startGene: s, endGene: bank.length && R.chance(0.8) ? R.pick(bank) : g(), bank }; },
    s(I, T) { const res = (() => { const B = new Set(I.bank), d1 = (a, b) => [...a].filter((c, i) => c !== b[i]).length === 1; if (!B.has(I.endGene)) { T.at({ end: I.endGene, bank: A(I.bank) }); T.yn('Is the end gene in the bank?', false, 'Otherwise unreachable.'); T.n('Genes in the bank?', I.bank.length, 'None of them help.'); return -1; } let q = [I.startGene], seen = new Set(q), d = 0; T.at({ start: I.startGene, end: I.endGene }); T.n('Letters that differ between start and end?', [...I.startGene].filter((c, i) => c !== I.endGene[i]).length, 'At least that many mutations.'); while (q.length) { if (d < 6) { T.at({ level: d, frontier: Q(q.slice()) }); T.n('Genes in the current BFS level?', q.length, 'Expand one level at a time.'); } const nx = []; for (const x of q) { if (x === I.endGene) return d; for (const y of I.bank) if (!seen.has(y) && d1(x, y)) { seen.add(y); nx.push(y); } } q = nx; d++; } return -1; })(); T.n('Fewest mutations? (−1 if impossible)', res, 'BFS level where the end gene appears.'); return res; }
  });

  D('island-perimeter', {
    t: 'Island Perimeter',
    r: 'Each land cell adds 4 edges; each pair of adjacent land cells hides 2. Perimeter = 4·land − 2·(right neighbors + down neighbors).',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), g = Array.from({ length: m }, () => Array(n).fill(0)); let r = R.int(0, m - 1), c = R.int(0, n - 1); for (let k = 0; k < R.int(1, 8); k++) { g[r][c] = 1; const [dr, dc] = R.pick([[0, 1], [1, 0], [0, -1], [-1, 0]]); if (r + dr >= 0 && c + dc >= 0 && r + dr < m && c + dc < n) { r += dr; c += dc; } } return { grid: g }; },
    s(I, T) { const res = (() => { let land = 0, adj = 0; I.grid.forEach((r, i) => r.forEach((v, j) => { if (!v) return; land++; if (r[j + 1]) adj++; if (I.grid[i + 1] && I.grid[i + 1][j]) adj++; })); T.at({ grid: G(I.grid) }); T.n('Land cells?', land, 'Each contributes 4 edges.'); T.n('Adjacent land pairs?', adj, 'Each hides 2 edges.'); return 4 * land - 2 * adj; })(); T.n('Perimeter?', res, '4 times land minus 2 times adjacent pairs.'); return res; }
  });

  D('diagonal-traverse', {
    t: 'Diagonal Traverse',
    r: 'Cells on anti-diagonal d satisfy i + j = d. Visit d = 0, 1, …; even d goes up-right (i decreasing), odd d goes down-left.',
    g: R => ({ mat: mat(R, R.int(1, 4), R.int(1, 4), 1, 9) }),
    s(I, T) { const m = I.mat.length, n = I.mat[0].length, out = []; for (let d = 0; d < m + n - 1; d++) { const cells = []; for (let i = 0; i < m; i++) { const j = d - i; if (j >= 0 && j < n) cells.push(I.mat[i][j]); } if (d % 2 === 0) cells.reverse(); if (d < 5) { T.at({ mat: G(I.mat), diagonal: d }); T.n(`First value read on diagonal ${d}?`, cells[0], d % 2 ? 'Odd: going down-left.' : 'Even: going up-right.'); } out.push(...cells); } return out; }
  });

  D('minesweeper', {
    t: 'Minesweeper',
    r: 'Clicking a mine turns it to X. Clicking an empty square counts adjacent mines: a count > 0 shows the digit; 0 shows B and recursively reveals all 8 neighbors (DFS/BFS).',
    g: R => { const m = R.int(1, 4), n = R.int(1, 5), b = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.2) ? 'M' : 'E')); return { board: b, click: [R.int(0, m - 1), R.int(0, n - 1)] }; },
    s(I, T) { const b = I.board.map(r => r.slice()), m = b.length, n = b[0].length, [cr, cc] = I.click; T.at({ board: G(I.board, { hl: [[cr, cc]] }) }); T.yn('Did the click hit a mine?', b[cr][cc] === 'M', 'Mine → X, game over.'); if (b[cr][cc] === 'M') { b[cr][cc] = 'X'; return b; } const st = [[cr, cc]]; let asks = 0; while (st.length) { const [i, j] = st.pop(); if (b[i][j] !== 'E') continue; let c = 0; for (const [di, dj] of N8) { const x = i + di, y = j + dj; if (x >= 0 && y >= 0 && x < m && y < n && (b[x][y] === 'M' || b[x][y] === 'X')) c++; } if (asks++ < 5) { T.at({ board: G(b.map(r => r.slice()), { hl: [[i, j]] }) }); T.n('Adjacent mines here?', c, '0 → reveal neighbors.'); } if (c) { b[i][j] = String(c); continue; } b[i][j] = 'B'; for (const [di, dj] of N8) { const x = i + di, y = j + dj; if (x >= 0 && y >= 0 && x < m && y < n && b[x][y] === 'E') st.push([x, y]); } } return b; }
  });

  D('lonely-pixel-i', {
    t: 'Lonely Pixel I',
    r: 'Count black pixels per row and per column. A B at (r, c) is lonely iff rowCount[r] == 1 and colCount[c] == 1.',
    g: R => { const n = R.int(1, 4); return { picture: Array.from({ length: R.int(1, 4) }, () => Array.from({ length: n }, () => R.chance(0.3) ? 'B' : 'W')) }; },
    s(I, T) { const p = I.picture, rc = p.map(r => r.filter(x => x === 'B').length), cc = p[0].map((_, j) => p.filter(r => r[j] === 'B').length); T.at({ picture: G(p), rowB: A(rc), colB: A(cc) }); let c = 0, asks = 0; p.forEach((r, i) => r.forEach((v, j) => { if (v !== 'B') return; const ok = rc[i] === 1 && cc[j] === 1; if (ok) c++; if (asks++ < 6) { T.at({ picture: G(p, { hl: [[i, j]] }), rowB: rc[i], colB: cc[j] }); T.yn('Lonely?', ok, 'Only B in its row and column.'); } })); if (!asks) T.n('Black pixels?', 0, 'None.'); return c; }
  });

  D('lonely-pixel-ii', {
    t: 'Lonely Pixel II',
    r: 'A B at (r, c) counts iff row r and column c each have exactly target B\'s, and every row with a B in column c is identical to row r. Group rows by their string to check the second rule quickly.',
    g: R => { const n = R.int(1, 4), rowPat = () => Array.from({ length: n }, () => R.chance(0.5) ? 'B' : 'W'), pats = [rowPat(), rowPat()]; return { picture: Array.from({ length: R.int(1, 4) }, () => R.pick(pats).slice()), target: R.int(1, 3) }; },
    s(I, T) { const p = I.picture, t = I.target, rc = p.map(r => r.filter(x => x === 'B').length), cc = p[0].map((_, j) => p.filter(r => r[j] === 'B').length); let c = 0, asks = 0; p.forEach((r, i) => r.forEach((v, j) => { if (v !== 'B') return; const ok = rc[i] === t && cc[j] === t && p.every(q => q[j] !== 'B' || q.join('') === r.join('')); if (ok) c++; if (asks++ < 6) { T.at({ picture: G(p, { hl: [[i, j]] }), rowB: rc[i], colB: cc[j], target: t }); T.yn('Does this pixel count?', ok, 'Counts match target and rows sharing the column are identical.'); } })); if (!asks) { T.at({ picture: G(p) }); T.n('Pixels?', 0, 'No black pixels.'); } return c; }
  });

  D('array-nesting', {
    t: 'Array Nesting',
    r: 'nums is a permutation, so it splits into disjoint cycles. Follow each unvisited start, marking visited, and return the longest cycle length.',
    g: R => ({ nums: R.shuffle([...Array(R.int(1, 8)).keys()]) }),
    s(I, T) { const a = I.nums, seen = Array(a.length).fill(false); let best = 0, asks = 0; for (let s = 0; s < a.length; s++) { if (seen[s]) continue; let k = s, len = 0; while (!seen[k]) { seen[k] = true; k = a[k]; len++; } best = Math.max(best, len); if (asks++ < 6) { T.at({ nums: A(a, { i: s }) }); T.n(`Length of the cycle through ${s}?`, len, 'Follow nums[k] until it repeats.'); } } return best; }
  });

  D('reshape-the-matrix', {
    t: 'Reshape the Matrix',
    r: 'If m·n ≠ r·c return the original. Otherwise element number k (row-major) goes to (⌊k / c⌋, k mod c).',
    g: R => { const m = R.int(1, 3), n = R.int(1, 4); return { mat: mat(R, m, n, 1, 9), r: R.int(1, 4), c: R.int(1, 6) }; },
    s(I, T) { const res = (() => { const m = I.mat.length, n = I.mat[0].length; T.at({ size: `${m} by ${n}`, target: `${I.r} by ${I.c}` }); T.yn('Is the reshape possible?', m * n === I.r * I.c, 'Element counts must match.'); if (m * n !== I.r * I.c) { T.n('Elements in the matrix?', m * n, 'Does not equal r times c.'); return I.mat; } const f = I.mat.flat(), k = Math.min(f.length - 1, I.c); T.n(`Row of element number ${k}?`, Math.floor(k / I.c), 'k divided by c, rounded down.'); return Array.from({ length: I.r }, (_, i) => f.slice(i * I.c, i * I.c + I.c)); })(); T.n('Rows in the result?', res.length, 'r if it works, otherwise the original row count.'); return res; }
  });

  D('image-smoother', {
    t: 'Image Smoother',
    r: 'Each output cell is the floor of the average of the cell and its existing neighbors (the 3×3 window clipped to the image).',
    g: R => ({ img: mat(R, R.int(1, 4), R.int(1, 4), 0, 9) }),
    s(I, T) { const g = I.img, m = g.length, n = g[0].length; let asks = 0; return g.map((r, i) => r.map((_, j) => { let s = 0, c = 0; for (let x = i - 1; x <= i + 1; x++) for (let y = j - 1; y <= j + 1; y++) if (x >= 0 && y >= 0 && x < m && y < n) { s += g[x][y]; c++; } const v = Math.floor(s / c); if (asks++ < 5) { T.at({ img: G(g, { hl: [[i, j]] }) }); T.n('Smoothed value?', v, `⌊${s} / ${c}⌋.`); } return v; })); }
  });

  D('toeplitz-matrix', {
    t: 'Toeplitz Matrix',
    r: 'Every cell (except in the first row/column) must equal its up-left neighbor.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), d = R.ints(m + n, 1, 4), g = Array.from({ length: m }, (_, i) => Array.from({ length: n }, (_, j) => d[j - i + m])); if (R.chance(0.4)) g[R.int(0, m - 1)][R.int(0, n - 1)] = R.int(1, 5); return { matrix: g }; },
    s(I, T) { const g = I.matrix; let asks = 0; for (let i = 1; i < g.length; i++) for (let j = 1; j < g[0].length; j++) { const ok = g[i][j] === g[i - 1][j - 1]; if (!ok || asks < 4) { asks++; T.at({ matrix: G(g, { hl: [[i, j], [i - 1, j - 1]] }) }); T.yn('Equal to the up-left neighbor?', ok, 'Diagonals must be constant.'); } if (!ok) return false; } if (!asks) { T.at({ matrix: G(g) }); T.yn('Any cell to check?', false, 'Single row or column: Toeplitz.'); } return true; }
  });

  D('transform-to-chessboard', {
    t: 'Transform to Chessboard',
    r: 'Valid only if every 2×2 rectangle XORs to 0 (rows are all one pattern or its inverse) and row/col ones are n/2 (±1 for odd n). Then count misplaced rows/columns against the 0101… pattern; use the parity-allowed choice (odd n) or the smaller (even n); swaps = misplaced / 2.',
    g: R => { const n = R.int(2, 4), r = R.shuffle([...Array(n).keys()].map(i => i % 2)), c = R.shuffle([...Array(n).keys()].map(i => i % 2)); const b = r.map(x => c.map(y => x ^ y)); if (R.chance(0.3)) b[R.int(0, n - 1)][R.int(0, n - 1)] ^= 1; return { board: b }; },
    s(I, T) { const b = I.board, n = b.length; for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (b[0][0] ^ b[i][0] ^ b[0][j] ^ b[i][j]) { T.at({ board: G(b, { hl: [[0, 0], [i, 0], [0, j], [i, j]] }) }); T.yn('Do these four corners XOR to 0?', false, 'Every rectangle must.'); return -1; } T.at({ board: G(b) }); T.yn('Do all rectangles XOR to 0?', true, 'Rows are one pattern or its inverse.'); const rs = b[0].reduce((a, x) => a + x, 0), cs = b.reduce((a, r) => a + r[0], 0); if (rs < n >> 1 || rs > (n + 1) >> 1 || cs < n >> 1 || cs > (n + 1) >> 1) return -1; let rw = 0, cl = 0; for (let i = 0; i < n; i++) { if (b[i][0] === i % 2) rw++; if (b[0][i] === i % 2) cl++; } if (n % 2) { if (cl % 2) cl = n - cl; if (rw % 2) rw = n - rw; } else { cl = Math.min(cl, n - cl); rw = Math.min(rw, n - rw); } T.n('Row swaps needed?', rw / 2, 'Misplaced rows / 2.'); T.n('Column swaps needed?', cl / 2, 'Misplaced columns / 2.'); return (rw + cl) / 2; }
  });

  D('valid-tic-tac-toe-state', {
    t: 'Valid Tic-Tac-Toe State',
    r: 'Let x, o be the counts. Need o ≤ x ≤ o + 1. If X has a line, x must be o + 1; if O has a line, x must equal o (both winning is impossible under these).',
    g: R => ({ board: Array.from({ length: 3 }, () => R.str(3, 'XO  ')) }),
    s(I, T) { const s = I.board.join(''), x = [...s].filter(c => c === 'X').length, o = [...s].filter(c => c === 'O').length, L = [[0, 1, 2], [3, 4, 5], [6, 7, 8], [0, 3, 6], [1, 4, 7], [2, 5, 8], [0, 4, 8], [2, 4, 6]], win = p => L.some(l => l.every(i => s[i] === p)); T.at({ board: G(I.board.map(r => [...r])) }); T.n('X count − O count?', x - o, 'Must be 0 or 1.'); if (x < o || x > o + 1) return false; const wx = win('X'), wo = win('O'); T.yn('Does X have a line?', wx, 'Then X moved last: x = o + 1.'); T.yn('Does O have a line?', wo, 'Then O moved last: x = o.'); if (wx && x !== o + 1) return false; if (wo && x !== o) return false; return true; }
  });

  D('max-increase-to-keep-city-skyline', {
    t: 'Max Increase to Keep City Skyline',
    r: 'Record each row max and column max. Cell (i, j) can grow to min(rowMax[i], colMax[j]); sum the increases.',
    g: R => { const n = R.int(1, 4); return { grid: mat(R, n, n, 0, 9) }; },
    s(I, T) { const g = I.grid, rm = g.map(r => Math.max(...r)), cm = g[0].map((_, j) => Math.max(...g.map(r => r[j]))); T.at({ grid: G(g), rowMax: A(rm), colMax: A(cm) }); let s = 0, asks = 0; g.forEach((r, i) => r.forEach((v, j) => { const d = Math.min(rm[i], cm[j]) - v; s += d; if (asks++ < 5) { T.at({ grid: G(g, { hl: [[i, j]] }), rowMax: rm[i], colMax: cm[j] }); T.n('Allowed increase here?', d, 'min(rowMax, colMax) − height.'); } })); return s; }
  });

  D('image-overlap', {
    t: 'Image Overlap',
    r: 'Pair every 1 in img1 with every 1 in img2 and count the translation vector (dx, dy) they imply. The most frequent vector gives the best overlap.',
    g: R => { const n = R.int(1, 4); return { img1: mat(R, n, n, 0, 1), img2: mat(R, n, n, 0, 1) }; },
    s(I, T) { const a = [], b = [], c = new Map(); I.img1.forEach((r, i) => r.forEach((v, j) => v && a.push([i, j]))); I.img2.forEach((r, i) => r.forEach((v, j) => v && b.push([i, j]))); for (const [i, j] of a) for (const [x, y] of b) { const k = (x - i) + ',' + (y - j); c.set(k, (c.get(k) || 0) + 1); } T.at({ img1: G(I.img1), img2: G(I.img2) }); T.n('Ones in img1?', a.length, 'Collect their positions.'); T.n('Pairs of ones considered?', a.length * b.length, 'Ones in img1 times ones in img2.'); const best = Math.max(0, ...c.values()); T.n('Best overlap?', best, 'Most common translation.'); return best; }
  });

  D('magic-squares-in-grid', {
    t: 'Magic Squares In Grid',
    r: 'Check every 3×3 window: the center must be 5, the nine values must be distinct 1..9, and all rows, columns and both diagonals must sum to 15.',
    g: R => { const m = R.int(3, 4), n = R.int(3, 5), g = mat(R, m, n, 1, 9); if (R.chance(0.6)) { const M = R.pick([[[4, 3, 8], [9, 5, 1], [2, 7, 6]], [[2, 7, 6], [9, 5, 1], [4, 3, 8]], [[8, 1, 6], [3, 5, 7], [4, 9, 2]]]), r = R.int(0, m - 3), c = R.int(0, n - 3); for (let i = 0; i < 3; i++) for (let j = 0; j < 3; j++) g[r + i][c + j] = M[i][j]; } return { grid: g }; },
    s(I, T) { const g = I.grid; let c = 0, asks = 0; for (let r = 0; r + 3 <= g.length; r++) for (let q = 0; q + 3 <= g[0].length; q++) { const v = [0, 1, 2].map(i => g[r + i].slice(q, q + 3)), f = v.flat(), ok = new Set(f).size === 9 && f.every(x => x >= 1 && x <= 9) && v.every(row => row[0] + row[1] + row[2] === 15) && [0, 1, 2].every(j => v[0][j] + v[1][j] + v[2][j] === 15) && v[0][0] + v[1][1] + v[2][2] === 15 && v[0][2] + v[1][1] + v[2][0] === 15; if (ok) c++; if (asks++ < 6) { T.at({ window: G(v) }); T.yn('Is this window a magic square?', ok, 'Distinct 1–9, all lines sum to 15.'); } } return c; }
  });

  D('score-after-flipping-matrix', {
    t: 'Score After Flipping Matrix',
    r: 'First flip every row whose leading bit is 0 (the top bit dominates). Then, per column, flip it if it has more 0s than 1s. Sum the rows as binary numbers.',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 0, 1) }),
    s(I, T) { const g = I.grid.map(r => r[0] ? r.slice() : r.map(x => 1 - x)), m = g.length, n = g[0].length; T.at({ grid: G(I.grid) }); T.n('Rows that get flipped?', I.grid.filter(r => !r[0]).length, 'Make every leading bit 1.'); let s = 0; for (let j = 0; j < n; j++) { const ones = g.filter(r => r[j]).length, best = Math.max(ones, m - ones); if (j && j < 5) { T.at({ grid: G(g), column: j }); T.n(`Ones in column ${j} after the best choice?`, best, 'Flip if zeros outnumber ones.'); } s += best * (1 << (n - 1 - j)); } return s; }
  });

  D('transpose-matrix', {
    t: 'Transpose Matrix',
    r: 'Build an n × m result where result[j][i] = matrix[i][j].',
    g: R => ({ matrix: mat(R, R.int(1, 4), R.int(1, 4), 1, 9) }),
    s(I, T) { const res = (() => { const m = I.matrix, t = m[0].map((_, j) => m.map(r => r[j])); T.at({ matrix: G(m) }); T.n('Rows in the transpose?', t.length, 'Columns become rows.'); T.n('result[0][last]?', t[0][t[0].length - 1], 'matrix[last][0].'); return t; })(); T.n('Columns in the transpose?', res[0].length, 'Rows become columns.'); return res; }
  });

  D('projection-area-of-3d-shapes', {
    t: 'Projection Area of 3D Shapes',
    r: 'Top view: number of non-zero cells. Front view: sum of row maxima. Side view: sum of column maxima.',
    g: R => { const n = R.int(1, 4); return { grid: mat(R, n, n, 0, 4) }; },
    s(I, T) { const g = I.grid, top = g.flat().filter(x => x).length, f = g.reduce((s, r) => s + Math.max(...r), 0), sd = g[0].reduce((s, _, j) => s + Math.max(...g.map(r => r[j])), 0); T.at({ grid: G(g) }); T.n('Top projection?', top, 'Non-zero cells.'); T.n('Front projection (sum of row maxima)?', f, 'Tallest in each row.'); T.n('Side projection (sum of column maxima)?', sd, 'Tallest in each column.'); return top + f + sd; }
  });

  D('spiral-matrix-iii', {
    t: 'Spiral Matrix III',
    r: 'Walk a spiral from the start with step lengths 1, 1, 2, 2, 3, 3, … turning right each time; record only positions inside the grid until all cells are seen.',
    g: R => { const r = R.int(1, 3), c = R.int(1, 4); return { rows: r, cols: c, rStart: R.int(0, r - 1), cStart: R.int(0, c - 1) }; },
    s(I, T) { const out = [[I.rStart, I.cStart]], D4 = [[0, 1], [1, 0], [0, -1], [-1, 0]]; let r = I.rStart, c = I.cStart, d = 0, len = 1, asks = 0; while (out.length < I.rows * I.cols) { for (let t = 0; t < 2; t++) { for (let k = 0; k < len; k++) { r += D4[d][0]; c += D4[d][1]; if (r >= 0 && c >= 0 && r < I.rows && c < I.cols) out.push([r, c]); } d = (d + 1) % 4; } if (asks++ < 4) { T.at({ step: len, visited: out.length }); T.n('Cells recorded so far?', out.length, 'Only in-grid positions count.'); } len++; } return out.slice(0, I.rows * I.cols); }
  });

  D('surface-area-of-3d-shapes', {
    t: 'Surface Area of 3D Shapes',
    r: 'A tower of v cubes has 4v + 2 faces (v > 0). Subtract 2·min(v, neighbor) for each adjacent pair of towers (right and down neighbors).',
    g: R => { const n = R.int(1, 3); return { grid: mat(R, n, n, 0, 4) }; },
    s(I, T) { const g = I.grid; let s = 0, asks = 0; g.forEach((r, i) => r.forEach((v, j) => { if (!v) return; s += 4 * v + 2; if (j + 1 < r.length) s -= 2 * Math.min(v, r[j + 1]); if (i + 1 < g.length) s -= 2 * Math.min(v, g[i + 1][j]); if (asks++ < 6) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.n('Running surface area?', s, '4v + 2, minus hidden faces with right/down neighbors.'); } })); if (!asks) { T.at({ grid: G(g) }); T.n('Area?', 0, 'No cubes.'); } return s; }
  });

  D('available-captures-for-rook', {
    t: 'Available Captures for Rook',
    r: 'From the rook, walk each of the 4 directions until the edge or a piece: a pawn "p" counts as a capture, a bishop "B" blocks.',
    g: R => { const b = Array.from({ length: 8 }, () => Array.from({ length: 8 }, () => R.pick(['.', '.', '.', '.', 'p', 'B']))); b[R.int(0, 7)][R.int(0, 7)] = 'R'; return { board: b }; },
    s(I, T) { let r, c; I.board.forEach((row, i) => row.forEach((v, j) => { if (v === 'R') { r = i; c = j; } })); let n = 0; for (const [dr, dc, nm] of [[-1, 0, 'up'], [1, 0, 'down'], [0, -1, 'left'], [0, 1, 'right']]) { let i = r + dr, j = c + dc, hit = 'nothing'; while (i >= 0 && j >= 0 && i < 8 && j < 8) { if (I.board[i][j] === 'p') { hit = 'pawn'; break; } if (I.board[i][j] === 'B') { hit = 'bishop'; break; } i += dr; j += dc; } if (hit === 'pawn') n++; T.at({ board: G(I.board, { hl: [[r, c]] }) }); T.c(`Looking ${nm}, the rook first meets…`, ['pawn', 'bishop', 'nothing'], hit, 'Stop at the first piece.'); } return n; }
  });

  D('grid-illumination', {
    t: 'Grid Illumination',
    r: 'Count lamps per row, column, diagonal (r − c) and anti-diagonal (r + c), keeping a set of lamp positions (duplicates once). A query is lit if any of its four counts > 0; then turn off lamps in its 3×3 neighborhood.',
    g: R => { const n = R.int(2, 6); return { n, lamps: Array.from({ length: R.int(1, 4) }, () => [R.int(0, n - 1), R.int(0, n - 1)]), queries: Array.from({ length: R.int(1, 4) }, () => [R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const L = new Set(), cnt = new Map(), inc = (k, d) => cnt.set(k, (cnt.get(k) || 0) + d), keys = (r, c) => ['r' + r, 'c' + c, 'd' + (r - c), 'a' + (r + c)]; for (const [r, c] of I.lamps) { const k = r + ',' + c; if (L.has(k)) continue; L.add(k); keys(r, c).forEach(x => inc(x, 1)); } return I.queries.map(([r, c], qi) => { const lit = keys(r, c).some(k => cnt.get(k) > 0); if (qi < 6) { T.at({ lamps: A([...L]), query: `${r},${c}` }); T.yn('Is the query cell lit?', lit, 'Any lamp sharing a row, column or diagonal.'); } for (let x = r - 1; x <= r + 1; x++) for (let y = c - 1; y <= c + 1; y++) { const k = x + ',' + y; if (L.delete(k)) keys(x, y).forEach(q => inc(q, -1)); } return lit ? 1 : 0; }); }
  });

  D('matrix-cells-in-distance-order', {
    t: 'Matrix Cells in Distance Order',
    r: 'Bucket cells by Manhattan distance to the center (distances are at most rows + cols) and output buckets in increasing order — or BFS outward from the center.',
    g: R => { const r = R.int(1, 4), c = R.int(1, 4); return { rows: r, cols: c, rCenter: R.int(0, r - 1), cCenter: R.int(0, c - 1) }; },
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== e.length || new Set(o.map(p => p.join())).size !== o.length) return false; const d = p => Math.abs(p[0] - I.rCenter) + Math.abs(p[1] - I.cCenter); return o.every((p, i) => p[0] >= 0 && p[1] >= 0 && p[0] < I.rows && p[1] < I.cols && (!i || d(o[i - 1]) <= d(p))); },
    s(I, T) { const B = []; for (let r = 0; r < I.rows; r++) for (let c = 0; c < I.cols; c++) { const d = Math.abs(r - I.rCenter) + Math.abs(c - I.cCenter); (B[d] = B[d] || []).push([r, c]); } B.forEach((b, d) => { if (d && d < 5 && b) { T.at({ center: `${I.rCenter},${I.cCenter}`, distance: d }); T.n(`Cells at distance ${d}?`, b.length, 'Manhattan distance bucket.'); } }); if (B.length < 2) { T.at({ rows: I.rows, cols: I.cols }); T.n('Cells?', 1, 'Only the center.'); } return B.flat().filter(Boolean); }
  });

  D('flip-columns-for-maximum-number-of-equal-rows', {
    t: 'Flip Columns For Maximum Number of Equal Rows',
    r: 'Two rows can both become uniform with the same column flips iff they are equal or complements. Normalize each row (flip it if it starts with 1) and count the most common pattern.',
    g: R => { const n = R.int(1, 4), base = [R.ints(n, 0, 1), R.ints(n, 0, 1)]; return { matrix: Array.from({ length: R.int(1, 5) }, () => { const b = R.pick(base); return R.chance(0.5) ? b.map(x => 1 - x) : b.slice(); }) }; },
    s(I, T) { const c = new Map(); I.matrix.forEach((r, i) => { const k = r.map(x => x ^ r[0]).join(''); c.set(k, (c.get(k) || 0) + 1); if (i < 6) { T.at({ row: A(r) }); T.c('Normalized pattern?', [...new Set([k, r.join(''), r.map(x => 1 - x).join('')])], k, 'XOR with the first bit.'); } }); return Math.max(...c.values()); }
  });

  D('number-of-submatrices-that-sum-to-target', {
    t: 'Number of Submatrices That Sum to Target',
    r: 'Fix a pair of rows (top, bottom); column sums between them form a 1D array. Count subarrays with sum target using prefix sums + a hash map. O(m²·n).',
    g: R => ({ matrix: mat(R, R.int(1, 3), R.int(1, 4), -1, 2), target: R.int(-1, 2) }),
    s(I, T) { const m = I.matrix, R0 = m.length, C = m[0].length; let c = 0, asks = 0; for (let t = 0; t < R0; t++) { const col = Array(C).fill(0); for (let b = t; b < R0; b++) { for (let j = 0; j < C; j++) col[j] += m[b][j]; const seen = new Map([[0, 1]]); let p = 0, here = 0; for (const x of col) { p += x; here += seen.get(p - I.target) || 0; seen.set(p, (seen.get(p) || 0) + 1); } c += here; if (asks++ < 6) { T.at({ rows: `${t}..${b}`, columnSums: A(col.slice()), target: I.target }); T.n('Subarrays of this strip summing to target?', here, 'Prefix sums + hash map.'); } } } return c; }
  });

  D('queens-that-can-attack-the-king', {
    t: 'Queens That Can Attack the King',
    r: 'From the king, walk each of the 8 directions; the first queen met in a direction attacks (others behind it are blocked).',
    g: R => { const all = []; for (let r = 0; r < 8; r++) for (let c = 0; c < 8; c++) all.push([r, c]); const p = R.shuffle(all); return { queens: p.slice(1, 1 + R.int(1, 10)), king: p[0] }; },
    cmp: 'set',
    s(I, T) { const Qs = new Set(I.queens.map(q => q.join())), out = []; let asks = 0; for (const [dr, dc] of N8) { let r = I.king[0] + dr, c = I.king[1] + dc; while (r >= 0 && c >= 0 && r < 8 && c < 8) { if (Qs.has(r + ',' + c)) { out.push([r, c]); break; } r += dr; c += dc; } } T.at({ king: I.king.join(', '), queens: A(I.queens.map(q => q.join(', '))) }); T.n('Queens in the same row as the king?', I.queens.filter(q => q[0] === I.king[0]).length, 'Only the nearest one on each side can attack.'); T.n('Queens on any line with the king (row, column or diagonal)?', I.queens.filter(([r, c]) => r === I.king[0] || c === I.king[1] || Math.abs(r - I.king[0]) === Math.abs(c - I.king[1])).length, 'Others can never attack.'); T.n('How many queens attack the king?', out.length, 'First queen in each of 8 directions.'); if (out.length && asks++ < 1) { T.n('Row of the first attacking queen found, scanning up-left first?', out[0][0], 'Scan directions in order.'); } return out; }
  });

  D('reconstruct-a-2-row-binary-matrix', {
    t: 'Reconstruct a 2-Row Binary Matrix',
    r: 'Columns with sum 2 put 1 in both rows; sum 0 in neither. Assign each sum-1 column to the upper row while it still needs ones, else the lower. Invalid if totals do not work out.',
    g: R => { const cs = R.ints(R.int(1, 6), 0, 2), tot = cs.reduce((a, b) => a + b, 0), twos = cs.filter(x => x === 2).length, u = R.int(twos, tot - twos); return R.chance(0.8) ? { upper: u, lower: tot - u, colsum: cs } : { upper: u + 1, lower: tot - u, colsum: cs }; },
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && !o.length; if (!Array.isArray(o) || o.length !== 2) return false; const [a, b] = o; return a.reduce((s, x) => s + x, 0) === I.upper && b.reduce((s, x) => s + x, 0) === I.lower && I.colsum.every((c, j) => a[j] + b[j] === c && a[j] >= 0 && b[j] >= 0 && a[j] <= 1 && b[j] <= 1); },
    s(I, T) { const res = (() => { let u = I.upper, l = I.lower; const a = [], b = []; for (const c of I.colsum) { if (c === 2) { a.push(1); b.push(1); u--; l--; } else { a.push(0); b.push(0); } } T.at({ colsum: A(I.colsum), upper: I.upper, lower: I.lower }); T.n('Columns with sum 2?', I.colsum.filter(c => c === 2).length, 'Both rows get a 1 there.'); T.n('Upper ones still needed after the sum-2 columns?', u, 'Each 2 uses one from both rows.'); if (u < 0 || l < 0) return []; I.colsum.forEach((c, j) => { if (c !== 1) return; if (u > 0) { a[j] = 1; u--; } else { b[j] = 1; l--; } }); if (u || l) return []; return [a, b]; })(); T.yn('Is a valid matrix possible?', res.length > 0, 'Nothing may be left over in either row.'); return res; }
  });
})();
