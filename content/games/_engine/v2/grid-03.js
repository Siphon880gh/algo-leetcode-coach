/* v2 games: grids & matrices (03). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const mat = (R, m, n, lo, hi) => Array.from({ length: m }, () => R.ints(n, lo, hi));
  const N8 = [[-1, -1], [-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0], [1, 1]];
  const isPrime = x => { if (x < 2) return false; for (let d = 2; d * d <= x; d++) if (x % d === 0) return false; return true; };
  const box = (g, r1, r2, c1, c2) => { let a = Infinity, b = -1, c = Infinity, d = -1; for (let i = r1; i <= r2; i++) for (let j = c1; j <= c2; j++) if (g[i][j]) { a = Math.min(a, i); b = Math.max(b, i); c = Math.min(c, j); d = Math.max(d, j); } return b < 0 ? 0 : (b - a + 1) * (d - c + 1); };

  D('remove-all-ones-with-row-and-column-flips', {
    t: 'Remove All Ones With Row and Column Flips',
    r: 'Flip columns so the first row becomes all zeros; then every other row must be uniform — i.e. each row must equal the first row or its complement.',
    g: R => { const n = R.int(1, 4), b = R.ints(n, 0, 1); return { grid: Array.from({ length: R.int(1, 4) }, () => R.chance(0.15) ? R.ints(n, 0, 1) : R.chance(0.5) ? b.slice() : b.map(x => 1 - x)) }; },
    s(I, T) { const f = I.grid[0]; for (const [i, r] of I.grid.entries()) { const ok = r.every((x, j) => x === f[j]) || r.every((x, j) => x !== f[j]); if (i) { T.at({ first: A(f), row: A(r) }); T.yn(`Is row ${i} equal to the first row or its complement?`, ok, 'Otherwise it can never be cleared.'); } if (!ok) return false; } if (I.grid.length === 1) { T.at({ grid: G(I.grid) }); T.yn('Can a single row always be cleared?', true, 'Flip the columns with ones.'); } return true; }
  });

  D('stamping-the-grid', {
    t: 'Stamping the Grid',
    r: '2D prefix sums of occupied cells tell, for each top-left, whether an h×w stamp fits on empty cells. Mark those positions in a 2D difference array, prefix-sum it to get coverage, and check every empty cell is covered.',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 0, 1).map(r => r.map(x => x && R.chance(0.5) ? 1 : 0)), stampHeight: R.int(1, 3), stampWidth: R.int(1, 3) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, h = I.stampHeight, w = I.stampWidth, P = Array.from({ length: m + 1 }, () => Array(n + 1).fill(0)); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) P[i + 1][j + 1] = g[i][j] + P[i][j + 1] + P[i + 1][j] - P[i][j]; const Df = Array.from({ length: m + 1 }, () => Array(n + 1).fill(0)); let fits = 0; for (let i = 0; i + h <= m; i++) for (let j = 0; j + w <= n; j++) if (P[i + h][j + w] - P[i][j + w] - P[i + h][j] + P[i][j] === 0) { fits++; Df[i][j]++; Df[i + h][j]--; Df[i][j + w]--; Df[i + h][j + w]++; } T.at({ grid: G(g), stamp: `${h}×${w}` }); T.n('Positions where a stamp fits?', fits, 'Occupied count in the window must be 0.'); const C = Array.from({ length: m + 1 }, () => Array(n + 1).fill(0)); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { C[i + 1][j + 1] = Df[i][j] + C[i][j + 1] + C[i + 1][j] - C[i][j]; if (!g[i][j] && !C[i + 1][j + 1]) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.yn('Is this empty cell covered by some stamp?', false, 'Coverage from the difference array.'); return false; } } return true; }
  });

  D('check-if-every-row-and-column-contains-all-numbers', {
    t: 'Check if Every Row and Column Contains All Numbers',
    r: 'For each row and each column, put values in a set; valid iff every set has size n (values are already in 1..n).',
    g: R => { const n = R.int(1, 4), p = R.shuffle([...Array(n).keys()].map(x => x + 1)), g = Array.from({ length: n }, (_, i) => p.map((_, j) => p[(i + j) % n])); if (R.chance(0.4)) g[R.int(0, n - 1)][R.int(0, n - 1)] = R.int(1, n); return { matrix: g }; },
    s(I, T) { const g = I.matrix, n = g.length; for (let i = 0; i < n; i++) { const r = new Set(g[i]).size, c = new Set(g.map(x => x[i])).size; T.at({ matrix: G(g), index: i }); T.yn(`Are row ${i} and column ${i} both complete?`, r === n && c === n, 'Set sizes must be n.'); if (r !== n || c !== n) return false; } return true; }
  });

  D('maximum-trailing-zeros-in-a-cornered-path', {
    t: 'Maximum Trailing Zeros in a Cornered Path',
    r: 'Trailing zeros of a product = min(total 2s, total 5s). Prefix sums of 2- and 5-counts along rows and columns let each corner cell combine one horizontal arm (left or right) with one vertical arm (up or down) in O(1).',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 1, 25) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, f = (x, p) => { let c = 0; while (x % p === 0) { x /= p; c++; } return c; }; const two = g.map(r => r.map(x => f(x, 2))), fiv = g.map(r => r.map(x => f(x, 5))); T.at({ grid: G(g) }); T.n('Factors of 2 in the top-left value?', two[0][0], 'Count divisions by 2.'); let best = 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { const arm = (di, dj) => { let a = 0, b = 0, x = i + di, y = j + dj; while (x >= 0 && y >= 0 && x < m && y < n) { a += two[x][y]; b += fiv[x][y]; x += di; y += dj; } return [a, b]; }; for (const h of [arm(0, -1), arm(0, 1)]) for (const v of [arm(-1, 0), arm(1, 0)]) best = Math.max(best, Math.min(two[i][j] + h[0] + v[0], fiv[i][j] + h[1] + v[1])); } T.n('Maximum trailing zeros?', best, 'min(2s, 5s) over all cornered paths.'); return best; }
  });

  D('count-unguarded-cells-in-the-grid', {
    t: 'Count Unguarded Cells in the Grid',
    r: 'Mark guards and walls. From each guard, sweep the 4 directions marking cells guarded until a wall or guard blocks. Count cells that are none of these.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), cells = R.shuffle([...Array(m * n).keys()]), g = R.int(1, Math.min(3, m * n)), w = R.int(0, Math.min(3, m * n - g)); return { m, n, guards: cells.slice(0, g).map(x => [Math.floor(x / n), x % n]), walls: cells.slice(g, g + w).map(x => [Math.floor(x / n), x % n]) }; },
    s(I, T) { const s = Array.from({ length: I.m }, () => Array(I.n).fill('.')); I.guards.forEach(([r, c]) => s[r][c] = 'G'); I.walls.forEach(([r, c]) => s[r][c] = 'W'); for (const [r, c] of I.guards) for (const [dr, dc] of [[0, 1], [1, 0], [0, -1], [-1, 0]]) { let a = r + dr, b = c + dc; while (a >= 0 && b >= 0 && a < I.m && b < I.n && s[a][b] !== 'G' && s[a][b] !== 'W') { s[a][b] = '*'; a += dr; b += dc; } } const c = s.flat().filter(x => x === '.').length; T.at({ grid: G(s) }); T.n('Cells guarded (marked *)?', s.flat().filter(x => x === '*').length, 'Sweep until blocked.'); T.n('Unguarded cells?', c, 'Neither guard, wall nor seen.'); return c; }
  });

  D('check-if-matrix-is-x-matrix', {
    t: 'Check if Matrix Is X-Matrix',
    r: 'Cells on either diagonal (i == j or i + j == n − 1) must be non-zero; every other cell must be zero.',
    g: R => { const n = R.int(1, 4); return { grid: Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => (i === j || i + j === n - 1) ? (R.chance(0.9) ? R.int(1, 9) : 0) : (R.chance(0.9) ? 0 : R.int(1, 9)))) }; },
    s(I, T) { const g = I.grid, n = g.length; for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) { const d = i === j || i + j === n - 1, ok = d ? g[i][j] !== 0 : g[i][j] === 0; if (!ok) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.yn('Does this cell follow the rule?', false, d ? 'Diagonal cells must be non-zero.' : 'Off-diagonal cells must be zero.'); return false; } } T.at({ grid: G(g) }); T.yn('All cells follow the rule?', true, 'X-matrix.'); return true; }
  });

  D('equal-row-and-column-pairs', {
    t: 'Equal Row and Column Pairs',
    r: 'Count each row as a key (e.g. its joined string) in a hash map; for each column, add the count of the identical row key.',
    g: R => { const n = R.int(1, 4), g = mat(R, n, n, 1, 2); return { grid: g }; },
    s(I, T) { const g = I.grid, c = new Map(); g.forEach(r => { const k = r.join(); c.set(k, (c.get(k) || 0) + 1); }); let t = 0; g[0].forEach((_, j) => { const k = g.map(r => r[j]).join(), add = c.get(k) || 0; t += add; T.at({ grid: G(g), column: A(g.map(r => r[j])) }); T.n(`Rows equal to column ${j}?`, add, 'Look the column up in the row map.'); }); return t; }
  });

  D('largest-local-values-in-a-matrix', {
    t: 'Largest Local Values in a Matrix',
    r: 'The output is (n − 2) × (n − 2); entry (i, j) is the max of the 3×3 window whose top-left is (i, j).',
    g: R => { const n = R.int(3, 5); return { grid: mat(R, n, n, 1, 9) }; },
    s(I, T) { const g = I.grid, n = g.length; let asks = 0; return Array.from({ length: n - 2 }, (_, i) => Array.from({ length: n - 2 }, (_, j) => { let m = 0; for (let a = i; a < i + 3; a++) for (let b = j; b < j + 3; b++) m = Math.max(m, g[a][b]); if (asks++ < 5) { T.at({ grid: G(g, { hl: [[i, j], [i + 2, j + 2]] }) }); T.n('Max of this 3×3 window?', m, 'Scan the window.'); } return m; })); }
  });

  D('maximum-sum-of-an-hourglass', {
    t: 'Maximum Sum of an Hourglass',
    r: 'For each 3×3 window, the hourglass is the top row, the center and the bottom row (7 cells). Take the maximum sum.',
    g: R => ({ grid: mat(R, R.int(3, 4), R.int(3, 5), 0, 9) }),
    s(I, T) { const g = I.grid; let best = 0, asks = 0; for (let i = 0; i + 2 < g.length; i++) for (let j = 0; j + 2 < g[0].length; j++) { const s = g[i][j] + g[i][j + 1] + g[i][j + 2] + g[i + 1][j + 1] + g[i + 2][j] + g[i + 2][j + 1] + g[i + 2][j + 2]; best = Math.max(best, s); if (asks++ < 6) { T.at({ grid: G(g, { hl: [[i, j], [i + 1, j + 1], [i + 2, j + 2]] }) }); T.n('Hourglass sum here?', s, 'Top row + center + bottom row.'); } } return best; }
  });

  D('difference-between-ones-and-zeros-in-row-and-column', {
    t: 'Difference Between Ones and Zeros in Row and Column',
    r: 'Precompute ones per row and column. diff[i][j] = 2·onesRow[i] + 2·onesCol[j] − m − n (since zeros = size − ones).',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 0, 1) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, r = g.map(x => x.reduce((a, b) => a + b, 0)), c = g[0].map((_, j) => g.reduce((a, x) => a + x[j], 0)); T.at({ grid: G(g), onesRow: A(r), onesCol: A(c) }); T.n('diff[0][0]?', 2 * r[0] + 2 * c[0] - m - n, '2·onesRow + 2·onesCol − m − n.'); return g.map((_, i) => g[0].map((_, j) => 2 * r[i] + 2 * c[j] - m - n)); }
  });

  D('increment-submatrices-by-one', {
    t: 'Increment Submatrices by One',
    r: 'Per query add +1 at (r1, c1), −1 at (r1, c2 + 1), −1 at (r2 + 1, c1), +1 at (r2 + 1, c2 + 1) in a difference matrix; a final 2D prefix sum gives every cell.',
    g: R => { const n = R.int(1, 4); return { n, queries: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(0, n - 1), b = R.int(0, n - 1); return [a, b, R.int(a, n - 1), R.int(b, n - 1)]; }) }; },
    s(I, T) { const n = I.n, d = Array.from({ length: n + 1 }, () => Array(n + 1).fill(0)); I.queries.forEach(([a, b, c, e]) => { d[a][b]++; d[a][e + 1]--; d[c + 1][b]--; d[c + 1][e + 1]++; }); const g = Array.from({ length: n }, () => Array(n).fill(0)); for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) g[i][j] = d[i][j] + (i ? g[i - 1][j] : 0) + (j ? g[i][j - 1] : 0) - (i && j ? g[i - 1][j - 1] : 0); T.at({ queries: A(I.queries.map(q => q.join(','))) }); T.n('Value at (0, 0)?', g[0][0], 'Queries covering the top-left.'); T.n(`Value at (${n - 1}, ${n - 1})?`, g[n - 1][n - 1], 'Queries covering the bottom-right.'); return g; }
  });

  D('sort-the-students-by-their-kth-score', {
    t: 'Sort the Students by Their Kth Score',
    r: 'Sort the rows by column k in descending order (scores are distinct).',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), v = R.distinct(m * n, 1, 40); return { score: Array.from({ length: m }, (_, i) => v.slice(i * n, i * n + n)), k: R.int(0, n - 1) }; },
    s(I, T) { const out = I.score.slice().sort((a, b) => b[I.k] - a[I.k]); T.at({ score: G(I.score), k: I.k }); T.n('Column-k score of the top student?', out[0][I.k], 'Largest in column k.'); return out; }
  });

  D('check-knight-tour-configuration', {
    t: 'Check Knight Tour Configuration',
    r: 'Record the position of each step number. The tour must start at (0, 0) and every consecutive pair of positions must differ by a knight move (|dr|, |dc|) ∈ {(1, 2), (2, 1)}.',
    g: R => { const n = R.int(3, 5), g = Array.from({ length: n }, () => Array(n).fill(-1)); const order = []; const go = (r, c, k) => { g[r][c] = k; order.push([r, c]); if (k === n * n - 1) return true; const mv = R.shuffle([[1, 2], [2, 1], [-1, 2], [-2, 1], [1, -2], [2, -1], [-1, -2], [-2, -1]]); for (const [a, b] of mv) { const x = r + a, y = c + b; if (x >= 0 && y >= 0 && x < n && y < n && g[x][y] < 0 && go(x, y, k + 1)) return true; } g[r][c] = -1; order.pop(); return false; }; let ok = n === 5 && go(0, 0, 0); if (!ok) { const v = R.shuffle([...Array(n * n).keys()]); return { grid: Array.from({ length: n }, (_, i) => v.slice(i * n, i * n + n)) }; } if (R.chance(0.3)) { const a = R.int(1, n * n - 1), b = R.int(1, n * n - 1); const [p, q] = [order[a], order[b]]; [g[p[0]][p[1]], g[q[0]][q[1]]] = [g[q[0]][q[1]], g[p[0]][p[1]]]; } return { grid: g }; },
    s(I, T) { const n = I.grid.length, pos = []; I.grid.forEach((r, i) => r.forEach((v, j) => pos[v] = [i, j])); T.at({ grid: G(I.grid) }); T.yn('Does the tour start at (0, 0)?', I.grid[0][0] === 0, 'Step 0 must be the top-left.'); if (I.grid[0][0] !== 0) return false; for (let k = 1; k < n * n; k++) { const dr = Math.abs(pos[k][0] - pos[k - 1][0]), dc = Math.abs(pos[k][1] - pos[k - 1][1]), ok = dr * dc === 2; if (!ok || k < 4) { T.at({ grid: G(I.grid, { hl: [pos[k - 1], pos[k]] }) }); T.yn(`Is step ${k - 1} → ${k} a knight move?`, ok, '(1, 2) or (2, 1).'); } if (!ok) return false; } return true; }
  });

  D('prime-in-diagonal', {
    t: 'Prime In Diagonal',
    r: 'Look at nums[i][i] and nums[i][n − 1 − i] for every i; return the largest prime among them (0 if none). Trial division up to √x.',
    g: R => { const n = R.int(1, 4); return { nums: mat(R, n, n, 1, 30) }; },
    s(I, T) { const n = I.nums.length; let best = 0, asks = 0; for (let i = 0; i < n; i++) for (const v of [I.nums[i][i], I.nums[i][n - 1 - i]]) { const p = isPrime(v); if (p) best = Math.max(best, v); if (asks++ < 6) { T.at({ nums: G(I.nums), value: v }); T.yn(`Is ${v} prime?`, p, 'Trial division up to √x.'); } } return best; }
  });

  D('find-the-width-of-columns-of-a-grid', {
    t: 'Find the Width of Columns of a Grid',
    r: 'For each column, width = max string length of its numbers (a minus sign counts as a character).',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), -150, 999) }),
    s(I, T) { return I.grid[0].map((_, j) => { const w = Math.max(...I.grid.map(r => String(r[j]).length)); if (j < 5) { T.at({ column: A(I.grid.map(r => r[j])) }); T.n(`Width of column ${j}?`, w, 'Longest string; "-" counts.'); } return w; }); }
  });

  D('row-with-maximum-ones', {
    t: 'Row With Maximum Ones',
    r: 'Count ones per row; keep the first row with the strictly larger count. Return [row, count].',
    g: R => ({ mat: mat(R, R.int(1, 5), R.int(1, 4), 0, 1) }),
    s(I, T) { let bi = 0, bc = -1; I.mat.forEach((r, i) => { const c = r.reduce((a, b) => a + b, 0); if (c > bc) { bc = c; bi = i; } if (i < 6) { T.at({ row: A(r), best: `${bi}:${bc}` }); T.n('Best row index so far?', bi, 'Ties keep the earlier row.'); } }); return [bi, bc]; }
  });

  D('first-completely-painted-row-or-column', {
    t: 'First Completely Painted Row or Column',
    r: 'Map each value to its (row, col). Paint in arr order, counting painted cells per row and column; the first index where a row count reaches n or a column count reaches m is the answer.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 4), v = R.shuffle([...Array(m * n).keys()].map(x => x + 1)); return { arr: R.shuffle(v), mat: Array.from({ length: m }, (_, i) => v.slice(i * n, i * n + n)) }; },
    s(I, T) { const m = I.mat.length, n = I.mat[0].length, pos = {}; I.mat.forEach((r, i) => r.forEach((v, j) => pos[v] = [i, j])); const rc = Array(m).fill(0), cc = Array(n).fill(0); for (const [k, v] of I.arr.entries()) { const [i, j] = pos[v]; rc[i]++; cc[j]++; const done = rc[i] === n || cc[j] === m; if (k < 8 || done) { T.at({ mat: G(I.mat, { hl: [[i, j]] }), rowPainted: A(rc.slice()), colPainted: A(cc.slice()) }); T.yn(`After painting ${v}, is a row or column complete?`, done, 'Row count n or column count m.'); } if (done) return k; } return -1; }
  });

  D('difference-of-number-of-distinct-values-on-diagonals', {
    t: 'Difference of Number of Distinct Values on Diagonals',
    r: 'For each cell, count distinct values strictly up-left on its diagonal and strictly down-right; the answer is the absolute difference.',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 1, 3) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; let asks = 0; return g.map((r, i) => r.map((_, j) => { const a = new Set(), b = new Set(); for (let k = 1; i - k >= 0 && j - k >= 0; k++) a.add(g[i - k][j - k]); for (let k = 1; i + k < m && j + k < n; k++) b.add(g[i + k][j + k]); const v = Math.abs(a.size - b.size); if (asks++ < 5) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.n('|distinct up-left − distinct down-right|?', v, 'Strictly before and after on the diagonal.'); } return v; })); }
  });

  D('find-a-good-subset-of-the-matrix', {
    t: 'Find a Good Subset of the Matrix',
    r: 'If some row is all zeros, it alone is good. Otherwise a good subset exists iff two rows have disjoint ones (bitwise AND = 0); with n ≤ 5 there are only 32 row masks to compare.',
    g: R => ({ grid: mat(R, R.int(1, 5), R.int(1, 4), 0, 1) }),
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && !o.length; if (!Array.isArray(o) || !o.length || o.some((x, i) => i && x <= o[i - 1])) return false; const h = Math.floor(o.length / 2); return I.grid[0].every((_, j) => o.reduce((s, r) => s + I.grid[r][j], 0) <= h); },
    s(I, T) { const mk = I.grid.map(r => r.reduce((a, b, j) => a | (b << j), 0)), first = {}; for (const [i, x] of mk.entries()) { T.at({ grid: G(I.grid, { hl: [[i, 0]] }), mask: x }); if (x === 0) { T.yn('Is this row all zeros?', true, 'A single zero row is good.'); return [i]; } for (const y in first) if ((x & +y) === 0) { T.yn('Is there an earlier row with disjoint ones?', true, 'AND of masks is 0.'); return [first[y], i]; } if (first[x] === undefined) first[x] = i; } return []; }
  });

  D('construct-product-matrix', {
    t: 'Construct Product Matrix',
    r: 'Flatten the grid. p[i] = (product of everything before i) × (product of everything after i) mod 12345, using prefix and suffix products — no division (12345 is not prime).',
    g: R => ({ grid: mat(R, R.int(1, 3), R.int(1, 3), 1, 20) }),
    s(I, T) { const f = I.grid.flat(), N = f.length, M = 12345, pre = Array(N).fill(1), out = Array(N); for (let i = 1; i < N; i++) pre[i] = pre[i - 1] * (f[i - 1] % M) % M; let suf = 1; for (let i = N - 1; i >= 0; i--) { out[i] = pre[i] * suf % M; suf = suf * (f[i] % M) % M; } T.at({ flat: A(f), prefix: A(pre) }); T.n('Prefix product before the last element (mod 12345)?', pre[N - 1], 'Running product.'); T.n('Answer for the first cell?', out[0], 'Product of all others mod 12345.'); const n = I.grid[0].length; return I.grid.map((_, i) => out.slice(i * n, i * n + n)); }
  });

  D('find-champion-i', {
    t: 'Find Champion I',
    r: 'grid[i][j] = 1 means i beats j. The champion is the team whose row has 1 everywhere except the diagonal (equivalently, the row with n − 1 ones).',
    g: R => { const n = R.int(2, 5), p = R.shuffle([...Array(n).keys()]), rank = []; p.forEach((t, i) => rank[t] = i); return { grid: Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => i !== j && rank[i] < rank[j] ? 1 : 0)) }; },
    s(I, T) { for (const [i, r] of I.grid.entries()) { const w = r.reduce((a, b) => a + b, 0); T.at({ grid: G(I.grid, { hl: [[i, 0]] }) }); T.n(`Wins of team ${i}?`, w, 'Ones in its row.'); if (w === I.grid.length - 1) return i; } return -1; }
  });

  D('matrix-similarity-after-cyclic-shifts', {
    t: 'Matrix Similarity After Cyclic Shifts',
    r: 'A row returns to itself after shifting k (left or right) iff row[j] == row[(j + k) mod n] for all j. Check every row.',
    g: R => { const n = R.int(1, 4), per = R.int(1, n); return { mat: Array.from({ length: R.int(1, 3) }, () => { const b = R.ints(per, 1, 3); return R.chance(0.8) ? Array.from({ length: n }, (_, j) => b[j % per]) : R.ints(n, 1, 3); }), k: R.int(1, 8) }; },
    s(I, T) { const n = I.mat[0].length; for (const [i, r] of I.mat.entries()) { const ok = r.every((x, j) => x === r[(j + I.k) % n]); T.at({ row: A(r), k: I.k }); T.yn(`Is row ${i} unchanged by a shift of ${I.k}?`, ok, 'Compare j with (j + k) mod n.'); if (!ok) return false; } return true; }
  });

  D('find-missing-and-repeated-values', {
    t: 'Find Missing and Repeated Values',
    r: 'Count every value 1..n² in the grid: the one seen twice is repeated, the one never seen is missing (or use sum and sum-of-squares formulas).',
    g: R => { const n = R.int(2, 3), v = R.shuffle([...Array(n * n).keys()].map(x => x + 1)), miss = R.int(0, n * n - 1); let rep = R.int(0, n * n - 1); if (rep === miss) rep = (rep + 1) % (n * n); v[miss] = v[rep]; return { grid: Array.from({ length: n }, (_, i) => v.slice(i * n, i * n + n)) }; },
    s(I, T) { const n = I.grid.length, c = Array(n * n + 1).fill(0); I.grid.flat().forEach(x => c[x]++); const a = c.indexOf(2), b = c.indexOf(0, 1); T.at({ grid: G(I.grid) }); T.n('Repeated value?', a, 'Counted twice.'); T.n('Missing value?', b, 'Never seen.'); return [a, b]; }
  });

  D('find-the-grid-of-region-average', {
    t: 'Find the Grid of Region Average',
    r: 'Check each 3×3 window: it is a region if all adjacent pairs inside differ by ≤ threshold. Each cell\'s answer is ⌊mean of ⌊region averages⌋ of regions containing it⌋, or its own value if none.',
    g: R => ({ image: mat(R, R.int(3, 4), R.int(3, 4), 1, 9), threshold: R.int(1, 6) }),
    s(I, T) { const g = I.image, m = g.length, n = g[0].length, sum = g.map(r => r.map(() => 0)), cnt = g.map(r => r.map(() => 0)); let asks = 0; for (let i = 0; i + 3 <= m; i++) for (let j = 0; j + 3 <= n; j++) { let ok = true; for (let a = i; a < i + 3; a++) for (let b = j; b < j + 3; b++) { if (a + 1 < i + 3 && Math.abs(g[a][b] - g[a + 1][b]) > I.threshold) ok = false; if (b + 1 < j + 3 && Math.abs(g[a][b] - g[a][b + 1]) > I.threshold) ok = false; } if (asks++ < 6) { T.at({ image: G(g, { hl: [[i, j], [i + 2, j + 2]] }), threshold: I.threshold }); T.yn('Is this window a region?', ok, 'All neighbor differences ≤ threshold.'); } if (!ok) continue; let s = 0; for (let a = i; a < i + 3; a++) for (let b = j; b < j + 3; b++) s += g[a][b]; const avg = Math.floor(s / 9); for (let a = i; a < i + 3; a++) for (let b = j; b < j + 3; b++) { sum[a][b] += avg; cnt[a][b]++; } } return g.map((r, i) => r.map((v, j) => cnt[i][j] ? Math.floor(sum[i][j] / cnt[i][j]) : v)); }
  });

  D('modify-the-matrix', {
    t: 'Modify the Matrix',
    r: 'Compute each column\'s maximum, then replace every −1 with its column maximum.',
    g: R => { const g = mat(R, R.int(2, 4), R.int(1, 4), 0, 9); g.forEach(r => { if (R.chance(0.4)) r[R.int(0, r.length - 1)] = -1; }); g[0].forEach((_, j) => { if (g.every(r => r[j] < 0)) g[0][j] = 5; }); return { matrix: g }; },
    s(I, T) { const cm = I.matrix[0].map((_, j) => Math.max(...I.matrix.map(r => r[j]))); T.at({ matrix: G(I.matrix), colMax: A(cm) }); T.n('Max of column 0?', cm[0], 'Replaces any −1 in it.'); return I.matrix.map(r => r.map((v, j) => v === -1 ? cm[j] : v)); }
  });

  D('most-frequent-prime', {
    t: 'Most Frequent Prime',
    r: 'From every cell walk each of 8 directions, appending digits; every number > 10 formed along the way that is prime gets counted. Return the most frequent prime (larger on ties), or −1.',
    g: R => ({ mat: mat(R, R.int(1, 3), R.int(1, 3), 1, 9) }),
    s(I, T) { const g = I.mat, m = g.length, n = g[0].length, c = new Map(); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) for (const [di, dj] of N8) { let v = g[i][j], a = i + di, b = j + dj; while (a >= 0 && b >= 0 && a < m && b < n) { v = v * 10 + g[a][b]; if (isPrime(v)) c.set(v, (c.get(v) || 0) + 1); a += di; b += dj; } } T.at({ mat: G(g) }); T.n('Distinct primes > 10 found?', c.size, 'Walk all 8 directions from every cell.'); let best = -1; for (const [p, k] of c) if (best < 0 || k > c.get(best) || (k === c.get(best) && p > best)) best = p; return best; }
  });

  D('count-submatrices-with-top-left-element-and-sum-less-than-k', {
    t: 'Count Submatrices with Top-Left Element and Sum Less Than k',
    r: 'Submatrices containing (0, 0) are exactly 2D prefixes. Build the prefix sum P[i][j] and count cells with P ≤ k.',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 4), 0, 6), k: R.int(1, 30) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, P = g.map(r => r.slice()); let c = 0, asks = 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { P[i][j] += (i ? P[i - 1][j] : 0) + (j ? P[i][j - 1] : 0) - (i && j ? P[i - 1][j - 1] : 0); if (P[i][j] <= I.k) c++; if (asks++ < 6) { T.at({ grid: G(g, { hl: [[i, j]] }), k: I.k }); T.n('Prefix sum up to here?', P[i][j], 'Inclusion–exclusion.'); } } return c; }
  });

  D('minimum-operations-to-write-the-letter-y-on-a-grid', {
    t: 'Minimum Operations to Write the Letter Y on a Grid',
    r: 'Count values (0, 1, 2) on the Y cells (both upper diagonals to the center, then straight down) and off the Y. Try every pair (a, b), a ≠ b: cost = Y cells not a + others not b.',
    g: R => { const n = 2 * R.int(1, 3) + 1; return { grid: mat(R, n, n, 0, 2) }; },
    s(I, T) { const g = I.grid, n = g.length, c = n >> 1, y = [0, 0, 0], o = [0, 0, 0]; g.forEach((r, i) => r.forEach((v, j) => { const inY = (i <= c && (i === j || i + j === n - 1)) || (i >= c && j === c); (inY ? y : o)[v]++; })); T.at({ grid: G(g), yCounts: A(y), otherCounts: A(o) }); T.n('Cells in the Y?', y[0] + y[1] + y[2], 'Two half-diagonals plus the stem.'); let best = Infinity; for (let a = 0; a < 3; a++) for (let b = 0; b < 3; b++) if (a !== b) best = Math.min(best, (y[0] + y[1] + y[2] - y[a]) + (o[0] + o[1] + o[2] - o[b])); return best; }
  });

  D('match-alphanumerical-pattern-in-matrix-i', {
    t: 'Match Alphanumerical Pattern in Matrix I',
    r: 'Try every top-left in row-major order. Digit cells of the pattern must match exactly; letters must map consistently to digits, with different letters mapping to different digits (two maps).',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3), b = mat(R, m, n, 1, 3), pm = R.int(1, m), pn = R.int(1, n); return { board: b, pattern: Array.from({ length: pm }, () => Array.from({ length: pn }, () => R.chance(0.3) ? String(R.int(1, 3)) : R.pick('ab')).join('')) }; },
    s(I, T) { const b = I.board, p = I.pattern, pm = p.length, pn = p[0].length; let asks = 0; for (let r = 0; r + pm <= b.length; r++) for (let c = 0; c + pn <= b[0].length; c++) { const L = {}, Dg = {}; let ok = true; for (let i = 0; i < pm && ok; i++) for (let j = 0; j < pn && ok; j++) { const ch = p[i][j], v = b[r + i][c + j]; if (/\d/.test(ch)) { if (+ch !== v) ok = false; } else { if (L[ch] === undefined && Dg[v] === undefined) { L[ch] = v; Dg[v] = ch; } else if (L[ch] !== v || Dg[v] !== ch) ok = false; } } if (asks++ < 6) { T.at({ board: G(b, { hl: [[r, c]] }), pattern: A(p) }); T.yn('Does the pattern match with this top-left?', ok, 'Digits exact; letters a consistent one-to-one map.'); } if (ok) return [r, c]; } return [-1, -1]; }
  });

  D('make-a-square-with-the-same-color', {
    t: 'Make a Square with the Same Color',
    r: 'Check the four 2×2 squares of the 3×3 grid; if any has at least 3 cells of one color, changing at most one cell makes it uniform.',
    g: R => ({ grid: Array.from({ length: 3 }, () => Array.from({ length: 3 }, () => R.pick(['B', 'W']))) }),
    s(I, T) { const g = I.grid; for (let i = 0; i < 2; i++) for (let j = 0; j < 2; j++) { const b = [g[i][j], g[i][j + 1], g[i + 1][j], g[i + 1][j + 1]].filter(x => x === 'B').length, ok = b !== 2; T.at({ grid: G(g, { hl: [[i, j], [i + 1, j + 1]] }) }); T.yn('At least 3 of one color here?', ok, 'B count ≠ 2.'); if (ok) return true; } return false; }
  });

  D('maximum-hamming-distances', {
    t: 'Maximum Hamming Distances',
    r: 'max Hamming(x, y) = m − min Hamming(~x, y). Multi-source BFS over all 2^m masks starting from the numbers present gives each mask\'s distance to the nearest number; answer = m − dist[~x].',
    g: R => { const m = R.int(1, 5); return { nums: R.ints(R.int(2, 6), 0, (1 << m) - 1), m }; },
    s(I, T) { const M = 1 << I.m, d = Array(M).fill(-1); let q = []; for (const x of I.nums) if (d[x] < 0) { d[x] = 0; q.push(x); } while (q.length) { const nq = []; for (const x of q) for (let b = 0; b < I.m; b++) { const y = x ^ (1 << b); if (d[y] < 0) { d[y] = d[x] + 1; nq.push(y); } } q = nq; } return I.nums.map((x, i) => { const v = I.m - d[(M - 1) ^ x]; if (i < 5) { T.at({ x, complement: (M - 1) ^ x, m: I.m }); T.n(`Max Hamming distance for ${x}?`, v, 'm − distance from the complement to the nearest number.'); } return v; }); }
  });

  D('check-if-grid-satisfies-conditions', {
    t: 'Check if Grid Satisfies Conditions',
    r: 'Each cell must equal the cell below it and differ from the cell to its right.',
    g: R => { const n = R.int(1, 4), top = R.ints(n, 0, 3), g = Array.from({ length: R.int(1, 3) }, () => top.slice()); if (R.chance(0.3)) g[R.int(0, g.length - 1)][R.int(0, n - 1)] = R.int(0, 3); return { grid: g }; },
    s(I, T) { const g = I.grid; for (let i = 0; i < g.length; i++) for (let j = 0; j < g[0].length; j++) { const below = i + 1 < g.length ? g[i + 1][j] === g[i][j] : true, right = j + 1 < g[0].length ? g[i][j + 1] !== g[i][j] : true; if (!below || !right) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.yn('Does this cell satisfy both conditions?', false, below ? 'Equals its right neighbor.' : 'Differs from the cell below.'); return false; } } T.at({ grid: G(g) }); T.yn('All conditions hold?', true, 'Columns constant, neighbors differ.'); return true; }
  });

  D('find-the-minimum-area-to-cover-all-ones-i', {
    t: 'Find the Minimum Area to Cover All Ones I',
    r: 'Track the min and max row and column containing a 1; the area is (maxR − minR + 1) × (maxC − minC + 1).',
    g: R => { const g = mat(R, R.int(1, 4), R.int(1, 4), 0, 1); if (!g.flat().some(x => x)) g[0][0] = 1; return { grid: g }; },
    s(I, T) { const r = [], c = []; I.grid.forEach((row, i) => row.forEach((v, j) => { if (v) { r.push(i); c.push(j); } })); T.at({ grid: G(I.grid) }); T.n('Height of the bounding box?', Math.max(...r) - Math.min(...r) + 1, 'maxR − minR + 1.'); T.n('Width?', Math.max(...c) - Math.min(...c) + 1, 'maxC − minC + 1.'); return (Math.max(...r) - Math.min(...r) + 1) * (Math.max(...c) - Math.min(...c) + 1); }
  });

  D('find-the-minimum-area-to-cover-all-ones-ii', {
    t: 'Find the Minimum Area to Cover All Ones II',
    r: 'Three non-overlapping rectangles can always be separated by straight cuts: try the 6 layouts (three horizontal strips, three vertical strips, and a full cut with one side split the other way). Each part costs the bounding box of its ones.',
    g: R => { const g = mat(R, R.int(1, 4), R.int(1, 4), 0, 1); let ones = g.flat().filter(x => x).length; for (let i = 0; i < g.length && ones < 3; i++) for (let j = 0; j < g[0].length && ones < 3; j++) if (!g[i][j]) { g[i][j] = 1; ones++; } if (ones < 3) return { grid: [[1, 1, 1]] }; return { grid: g }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; let best = Infinity; for (let a = 0; a < m; a++) for (let b = a + 1; b < m; b++) best = Math.min(best, box(g, 0, a, 0, n - 1) + box(g, a + 1, b, 0, n - 1) + box(g, b + 1, m - 1, 0, n - 1)); for (let a = 0; a < n; a++) for (let b = a + 1; b < n; b++) best = Math.min(best, box(g, 0, m - 1, 0, a) + box(g, 0, m - 1, a + 1, b) + box(g, 0, m - 1, b + 1, n - 1)); for (let r = 0; r + 1 < m; r++) for (let c = 0; c + 1 < n; c++) { best = Math.min(best, box(g, 0, r, 0, n - 1) + box(g, r + 1, m - 1, 0, c) + box(g, r + 1, m - 1, c + 1, n - 1), box(g, r + 1, m - 1, 0, n - 1) + box(g, 0, r, 0, c) + box(g, 0, r, c + 1, n - 1), box(g, 0, m - 1, 0, c) + box(g, 0, r, c + 1, n - 1) + box(g, r + 1, m - 1, c + 1, n - 1), box(g, 0, m - 1, c + 1, n - 1) + box(g, 0, r, 0, c) + box(g, r + 1, m - 1, 0, c)); } T.at({ grid: G(g) }); T.n('Bounding box area of all ones (one rectangle)?', box(g, 0, m - 1, 0, n - 1), 'Upper bound.'); T.n('Best total with three rectangles?', best, 'Minimum over the 6 cut layouts.'); return best; }
  });

  D('count-submatrices-with-equal-frequency-of-x-and-y', {
    t: 'Count Submatrices With Equal Frequency of X and Y',
    r: 'Submatrices containing (0, 0) are prefixes. Keep 2D prefix counts of X − Y and of X; count cells where the difference is 0 and at least one X exists.',
    g: R => { const n = R.int(1, 4); return { grid: Array.from({ length: R.int(1, 4) }, () => Array.from({ length: n }, () => R.pick(['X', 'Y', '.']))) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, d = g.map(r => r.map(() => 0)), x = g.map(r => r.map(() => 0)); let c = 0, asks = 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { const v = g[i][j] === 'X' ? 1 : g[i][j] === 'Y' ? -1 : 0, f = (M, a, b) => a >= 0 && b >= 0 ? M[a][b] : 0; d[i][j] = v + f(d, i - 1, j) + f(d, i, j - 1) - f(d, i - 1, j - 1); x[i][j] = (v === 1) + f(x, i - 1, j) + f(x, i, j - 1) - f(x, i - 1, j - 1); const ok = d[i][j] === 0 && x[i][j] > 0; if (ok) c++; if (asks++ < 6) { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.yn('Does the prefix ending here qualify?', ok, 'Equal X and Y, at least one X.'); } } return c; }
  });

  D('minimum-operations-to-make-columns-strictly-increasing', {
    t: 'Minimum Operations to Make Columns Strictly Increasing',
    r: 'Each column independently: walk down; if a cell is not above the previous value, raise it to prev + 1 and add the difference.',
    g: R => ({ grid: mat(R, R.int(1, 4), R.int(1, 3), 0, 6) }),
    s(I, T) { let ops = 0; I.grid[0].forEach((_, j) => { let p = I.grid[0][j]; for (let i = 1; i < I.grid.length; i++) { const v = Math.max(I.grid[i][j], p + 1); ops += v - I.grid[i][j]; p = v; } if (j < 4) { T.at({ column: A(I.grid.map(r => r[j])) }); T.n(`Total operations after column ${j}?`, ops, 'Raise each cell to prev + 1 when needed.'); } }); return ops; }
  });

  D('zigzag-grid-traversal-with-skip', {
    t: 'Zigzag Grid Traversal With Skip',
    r: 'Traverse rows left-to-right, then right-to-left alternately, as one continuous sequence; keep every other cell (positions 0, 2, 4, … of that sequence).',
    g: R => ({ grid: mat(R, R.int(2, 4), R.int(2, 4), 1, 9) }),
    s(I, T) { const seq = I.grid.flatMap((r, i) => i % 2 ? r.slice().reverse() : r); T.at({ grid: G(I.grid) }); T.n('Length of the zigzag sequence?', seq.length, 'All cells.'); T.n('Third kept value?', seq[4] !== undefined ? seq[4] : seq[0], 'Index 4 of the sequence.'); return seq.filter((_, i) => i % 2 === 0); }
  });

  D('sort-matrix-by-diagonals', {
    t: 'Sort Matrix by Diagonals',
    r: 'Diagonals in the bottom-left triangle (i − j ≥ 0, including the main one) are sorted in non-increasing order; diagonals in the top-right (i − j < 0) in non-decreasing order.',
    g: R => { const n = R.int(1, 4); return { grid: mat(R, n, n, 1, 9) }; },
    s(I, T) { const g = I.grid.map(r => r.slice()), n = g.length; for (let d = -(n - 1); d <= n - 1; d++) { const cells = []; for (let i = 0; i < n; i++) { const j = i - d; if (j >= 0 && j < n) cells.push([i, j]); } const v = cells.map(([i, j]) => g[i][j]).sort((a, b) => d >= 0 ? b - a : a - b); cells.forEach(([i, j], k) => g[i][j] = v[k]); if (Math.abs(d) <= 1) { T.at({ grid: G(I.grid), diagonal: d }); T.n(`First value of diagonal i − j = ${d} after sorting?`, v[0], d >= 0 ? 'Bottom-left side: descending.' : 'Top-right side: ascending.'); } } return g; }
  });
})();
