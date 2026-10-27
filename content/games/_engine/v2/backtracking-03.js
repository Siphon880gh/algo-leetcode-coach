/* v2 games: backtracking (03). Guides scored in the 3483–4041 pass. */
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

  D('sequential-grid-path-cover', {
    t: 'Sequential Grid Path Cover',
    r: 'Backtrack from every start cell: step to unvisited neighbors, but a numbered cell may be entered only when it is the next number due. Succeed when all cells are visited and every number was seen in order.',
    g: R => { const m = R.int(1, 3), n = R.int(2, 3), k = R.int(1, Math.min(4, m * n)), cells = R.shuffle(range(0, m * n)).slice(0, k), grid = Array.from({ length: m }, () => Array(n).fill(0)); cells.forEach((c, i) => grid[Math.floor(c / n)][c % n] = i + 1); return { grid, k }; },
    cmp: (out, exp, I) => { if (!exp.length) return Array.isArray(out) && !out.length; const g = I.grid, m = g.length, n = g[0].length; if (!Array.isArray(out) || out.length !== m * n) return false; const seen = new Set(); let need = 1; for (let i = 0; i < out.length; i++) { const [x, y] = out[i]; if (seen.has(x + ',' + y)) return false; seen.add(x + ',' + y); if (i && Math.abs(x - out[i - 1][0]) + Math.abs(y - out[i - 1][1]) !== 1) return false; if (g[x][y]) { if (g[x][y] !== need) return false; need++; } } return need === I.k + 1; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, path = [], vis = Array.from({ length: m }, () => Array(n).fill(false)); const go = (x, y, need) => { if (g[x][y] && g[x][y] !== need) return false; if (g[x][y]) need++; vis[x][y] = true; path.push([x, y]); if (path.length === m * n) return true; for (const [a, b] of [[1, 0], [-1, 0], [0, 1], [0, -1]]) { const p = x + a, q = y + b; if (p >= 0 && q >= 0 && p < m && q < n && !vis[p][q] && go(p, q, need)) return true; } vis[x][y] = false; path.pop(); return false; }; let found = false; for (let x = 0; x < m && !found; x++) for (let y = 0; y < n && !found; y++) { const ok = go(x, y, 1); if (T.room()) { T.at({ grid: G(g, { hl: [[x, y]] }) }); T.yn(`Does a full path exist starting at (${x},${y})?`, ok, g[x][y] > 1 ? `Cell holds ${g[x][y]}, but 1 must come first.` : ok ? 'Backtracking finds one.' : 'Every branch dead-ends or breaks the number order.'); } found = ok; } return found ? path : []; }
  });

  D('partition-array-into-two-equal-product-subsets', {
    t: 'Partition Array into Two Equal Product Subsets',
    r: 'Both products equal target only if the product of everything is target². Then try subsets (bitmask): any subset whose product is exactly target has a complement that also gives target.',
    g: R => { const t = R.pick([6, 8, 12, 24, 30, 36]), base = R.chance(0.6) ? [1, t] : []; const pool = range(2, 13).filter(x => t % x === 0); const a = [...new Set([...base, ...R.shuffle(pool).slice(0, R.int(2, 3))])]; return { nums: R.shuffle(a.length >= 3 ? a : [...a, 5, 7].slice(0, 3)), target: t }; },
    s(I, T) { const a = I.nums.map(BigInt), t = BigInt(I.target), all = a.reduce((x, y) => x * y, 1n); T.at({ nums: A(I.nums), target: I.target }); T.yn('Is the product of all numbers equal to target²?', all === t * t, `Product ${all}, target² ${t * t}.`); if (all !== t * t) return false; const n = a.length; let found = -1; for (let m = 1; m < (1 << n) - 1 && found < 0; m++) { let p = 1n; for (let i = 0; i < n; i++) if (m >> i & 1) p *= a[i]; if (p === t) found = m; } a.forEach((x, i) => { if (i < 4) { T.at({ nums: A(I.nums, { i }), target: I.target }); T.yn(`Does ${x} divide target?`, t % x === 0n, t % x === 0n ? 'It can sit in a subset with product target.' : 'Then neither side could have product target.'); } }); if (found > 0) { const side = I.nums.filter((_, i) => found >> i & 1); T.at({ nums: A(I.nums, { hl: range(0, n).filter(i => found >> i & 1) }) }); T.n('Product of the highlighted subset?', Number(side.reduce((x, y) => x * y, 1)), 'It equals target, so the complement does too.'); } return found > 0; }
  });

  D('next-special-palindrome-number', {
    t: 'Next Special Palindrome Number',
    r: 'Digit k must appear exactly k times, and a palindrome allows at most one digit with an odd count — so at most one odd digit in the set. For each length, pick digit sets with that total, build half-strings by backtracking, and keep the smallest palindrome above n.',
    g: R => ({ n: R.int(0, 5000) }),
    s(I, T) { const n = I.n, start = Math.max(1, String(n).length); for (let L = start; L <= 16; L++) { const sets = []; for (let m = 1; m < 512; m++) { const ds = range(1, 10).filter(d => m >> (d - 1) & 1); if (sum(ds) === L && ds.filter(d => d % 2).length <= 1) sets.push(ds); } let best = null; for (const ds of sets) { const half = []; let mid = ''; ds.forEach(d => { for (let i = 0; i < Math.floor(d / 2); i++) half.push(d); if (d % 2) mid = String(d); }); const perms = new Set(); const go = (pre, rest) => { if (!rest.length) { perms.add(pre); return; } const used = new Set(); rest.forEach((x, i) => { if (used.has(x)) return; used.add(x); go(pre + x, rest.filter((_, j) => j !== i)); }); }; go('', half); for (const h of perms) { const v = +(h + mid + h.split('').reverse().join('')); if (v > n && (best === null || v < best)) best = v; } } T.at({ n, length: L }); T.n(`How many digit sets can form a special palindrome of length ${L}?`, sets.length, 'Digits d with total the sum of d = L and at most one odd digit.'); if (best !== null) { T.n(`Smallest special number with ${L} digits greater than ${n}?`, best, 'Try half-orderings smallest first.'); return best; } } return -1; }
  });

  D('balanced-k-factor-decomposition', {
    t: 'Balanced K-Factor Decomposition',
    r: 'Backtrack over the divisors in non-decreasing order: choose the next factor d, at least the previous one, with d dividing what is left, and the last factor takes the remainder. Keep the split with the smallest max minus min.',
    cmp: (o, e, I) => Array.isArray(o) && o.length === I.k && o.reduce((a, b) => a * b, 1) === I.n && Math.max(...o) - Math.min(...o) === Math.max(...e) - Math.min(...e),
    g: R => ({ n: R.pick([12, 16, 18, 24, 30, 36, 44, 48, 60, 72, 100]), k: R.int(2, 3) }),
    s(I, T) { const res = (() => { let best = null; const go = (left, k, min, cur) => { if (k === 1) { if (left >= min) { const c = [...cur, left], d = c[c.length - 1] - c[0]; if (!best || d < best.d) best = { c, d }; } return; } for (let d = min; d * d <= left; d++) if (left % d === 0) go(left / d, k - 1, d, [...cur, d]); }; go(I.n, I.k, 1, []); const divs = range(1, I.n + 1).filter(d => I.n % d === 0); T.at({ n: I.n, k: I.k, divisors: A(divs) }); T.n('How many divisors does n have?', divs.length, 'Every factor must be one of them.'); T.n('Smallest possible max minus min?', best.d, 'Try factors in non-decreasing order; the last one takes what is left.'); T.c('Smallest factor in that best split?', divs.slice(0, 6), best.c[0], 'Balanced splits keep factors near the k-th root of n.'); return best.c; })(); T.n('Largest factor in that split?', Math.max(...res), 'The last factor takes what is left.'); return res; }
  });

  D('word-squares-ii', {
    t: 'Word Squares II',
    r: 'Try every ordered choice of 4 distinct words (top, left, right, bottom) and keep those whose corners match: top[0] = left[0], top[3] = right[0], bottom[0] = left[3], bottom[3] = right[3]. Pruning on each corner as soon as a word is placed keeps it fast; sort the results.',
    g: R => ({ words: R.shuffle(['able', 'area', 'echo', 'also', 'east', 'tree', 'oath', 'heat', 'aero', 'oboe']).slice(0, R.int(4, 6)) }),
    s(I, T) { const w = I.words, out = []; const per = {}; for (const t of w) for (const l of w) { if (l === t || t[0] !== l[0]) continue; for (const r of w) { if (r === t || r === l || t[3] !== r[0]) continue; for (const b of w) { if (b === t || b === l || b === r || b[0] !== l[3] || b[3] !== r[3]) continue; out.push([t, l, r, b]); per[t] = (per[t] || 0) + 1; } } } out.sort((x, y) => x.join() < y.join() ? -1 : 1); w.slice().sort().slice(0, 4).forEach(t => { T.at({ words: A(w), top: t }); T.n(`Word squares with "${t}" on top?`, per[t] || 0, 'Match the four corners, all words distinct.'); }); return out; }
  });

  D('valid-binary-strings-with-cost-limit', {
    t: 'Valid Binary Strings With Cost Limit',
    r: 'Build the string left to right. A "1" is allowed only if the previous character is "0" and adding index i keeps the cost at most k; prune as soon as the cost would go over.',
    g: R => { const n = R.int(1, 5); return { n, k: R.int(0, n * (n - 1) / 2) }; },
    cmp: (a, b) => JSON.stringify(a.slice().sort()) === JSON.stringify(b.slice().sort()),
    s(I, T) { const out = []; let asks = 0; const go = (s, cost) => { if (s.length === I.n) { out.push(s); return; } const i = s.length, can = s[i - 1] !== '1' && cost + i <= I.k; if (asks < 4 && i > 0) { asks++; T.at({ prefix: s, cost, k: I.k }); T.yn(`Can index ${i} be "1"?`, can, s[i - 1] === '1' ? 'Previous is 1.' : `Cost would be ${cost + i}.`); } go(s + '0', cost); if (can) go(s + '1', cost + i); }; go('', 0); T.at({ n: I.n, k: I.k }); T.n('How many valid strings?', out.length, 'Leaves of the pruned search.'); return out; }
  });
})();
