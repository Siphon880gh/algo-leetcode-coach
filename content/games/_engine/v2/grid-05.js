/* v2 games: grid (05). Guides scored in the 4042–4095 pass. */
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

  D('cyclically-shift-rows-and-columns', {
    t: 'Cyclically Shift Rows and Columns',
    r: 'Shift the rows first: after a left shift by k, the new row[j] is the old row[(j + k) % n]. Then shift each column up: the new column[i] is the old column[(i + k) % n].',
    g: R => { const n = R.int(2, 4); return { n, grid: R.grid(n, n, 1, 9), rowShift: R.ints(n, 0, n - 1), colShift: R.ints(n, 0, n - 1) }; },
    s(I, T) { const n = I.n; let g = I.grid.map((row, i) => row.map((_, j) => row[(j + I.rowShift[i]) % n])); for (let i = 0; i < Math.min(n, 3); i++) { T.at({ grid: G(I.grid.map(r => r.slice())), rowShift: A(I.rowShift, { i }) }); T.n(`After shifting row ${i} left by ${I.rowShift[i]}, what is its first value?`, g[i][0], `It is the old row[${i}][${I.rowShift[i] % n}].`); } const h = g.map(r => r.slice()); g = g.map((row, i) => row.map((_, j) => h[(i + I.colShift[j]) % n][j])); for (let j = 0; j < Math.min(n, 3); j++) { T.at({ rowsShifted: G(h.map(r => r.slice())), colShift: A(I.colShift, { j }) }); T.n(`After shifting column ${j} up by ${I.colShift[j]}, what is its top value?`, g[0][j], `It is the row-shifted grid's [${I.colShift[j] % n}][${j}].`); } return g; }
  });

  D('last-visited-cell-in-a-directional-grid', {
    t: 'Last Visited Cell in a Directional Grid',
    r: 'Follow the arrows from (0, 0), marking each visited cell. Stop when the next move would leave the grid or land on a visited cell; the current cell is the answer.',
    g: R => ({ grid: R.cgrid(R.int(1, 4), R.int(2, 4), 'LRUD') }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, M = { L: [0, -1], R: [0, 1], U: [-1, 0], D: [1, 0] }, seen = new Set(['0,0']); let r = 0, c = 0, steps = 0; for (;;) { const [dr, dc] = M[g[r][c]], nr = r + dr, nc = c + dc, out = nr < 0 || nc < 0 || nr >= m || nc >= n, vis = !out && seen.has(nr + ',' + nc), opts = [`move to (${nr}, ${nc})`, 'stop: it leaves the grid', 'stop: already visited'], ok = out ? opts[1] : vis ? opts[2] : opts[0]; if (steps < 10) { T.at({ grid: G(g.map(x => x.slice()), { hl: [[r, c]], ok: [...seen].filter(k => k !== r + ',' + c).map(k => k.split(',').map(Number)) }), at: `(${r}, ${c})` }); T.c(`At (${r}, ${c}) the arrow says ${g[r][c]}. What happens?`, opts, ok, out ? 'That move would leave the grid.' : vis ? `(${nr}, ${nc}) is already visited.` : `(${nr}, ${nc}) is new, so move there.`); } steps++; if (out || vis) break; seen.add(nr + ',' + nc); r = nr; c = nc; } return [r, c]; }
  });
})();
