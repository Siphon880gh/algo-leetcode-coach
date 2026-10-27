/* v2 games: dp (19). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  // 0-1 knapsack: one array dp[c], capacity scanned from high to low.
  const knap01 = (ws, vs, W) => { const dp = Array(W + 1).fill(0); ws.forEach((w, i) => { for (let c = W; c >= w; c--) dp[c] = Math.max(dp[c], dp[c - w] + vs[i]); }); return dp; };
  const knapItems = R => { const n = R.int(3, 4); return { weights: R.ints(n, 1, 4), values: R.ints(n, 1, 9), capacity: R.int(3, 6) }; };
  const KX = { weights: [1, 3, 4], values: [15, 20, 30], capacity: 4 };

  D('0-1-knapsack-problem', {
    t: '0-1 Knapsack',
    r: 'dp[c] is the best value that fits in capacity c. For each item (weight w, value v), scan c from the capacity down to w: dp[c] = max(dp[c], dp[c − w] + v). Scanning downward keeps dp[c − w] free of this item, so each item is used at most once.',
    exs: [{ in: KX, out: 35 }],
    g: knapItems,
    s(I, T) { const W = I.capacity, dp = Array(W + 1).fill(0); I.weights.forEach((w, i) => { const v = I.values[i], before = dp.slice(); for (let c = W; c >= w; c--) dp[c] = Math.max(dp[c], dp[c - w] + v); const take = w <= W && before[W - w] + v > before[W]; T.at({ dp: A(before, { label: 'dp before this item' }), item: `weight ${w}, value ${v}` }); T.c(`Item ${i} (weight ${w}, value ${v}) at full capacity ${W}: take it or skip it?`, ['take', 'skip'], take ? 'take' : 'skip', w > W ? 'It is heavier than the bag.' : take ? `dp[${W - w}] + ${v} = ${before[W - w] + v} beats ${before[W]}.` : `dp[${W - w}] + ${v} = ${before[W - w] + v} does not beat ${before[W]}.`); T.at({ dp: A(dp, { hl: W, label: 'dp after this item' }) }); T.n(`dp[${W}] after item ${i}?`, dp[W], 'Take the better of skipping (old dp) and taking (dp[c − w] + v).'); }); return dp[W]; }
  });

  D('dynamic-programming-problem-solving-approach', {
    t: 'DP Problem-Solving Approach (Climbing Stairs)',
    r: 'Climb n stairs taking 1 or 2 steps at a time. State: f(i) = ways to reach stair i. Transition: f(i) = f(i − 1) + f(i − 2). Base: f(0) = f(1) = 1. Fill bottom-up and keep only the last two values.',
    exs: [{ in: { n: 4 }, out: 5 }, { in: { n: 2 }, out: 2 }],
    g: R => ({ n: R.int(3, 9) }),
    s(I, T) { const n = I.n; T.at({ n }); T.c('What should the state f(i) mean?', ['ways to reach stair i', 'steps taken so far', 'stairs left to climb'], 'ways to reach stair i', 'The state must answer the question for a smaller stair count.'); T.c('Which transition is right?', ['f(i) = f(i − 1) + f(i − 2)', 'f(i) = f(i − 1) × 2', 'f(i) = f(i − 2) + 1'], 'f(i) = f(i − 1) + f(i − 2)', 'The last move is either a 1-step from i − 1 or a 2-step from i − 2.'); let a = 1, b = 1; for (let i = 2; i <= n; i++) { T.at({ 'f(i − 2)': a, 'f(i − 1)': b, i }); const c = a + b; T.n(`f(${i})?`, c, `f(${i - 1}) + f(${i - 2}) = ${b} + ${a}.`); a = b; b = c; } return b; }
  });

  D('edit-distance-problem', {
    t: 'Edit Distance',
    r: 'dp[i][j] = fewest inserts, deletes or replaces to turn the first i letters of word1 into the first j letters of word2. If the letters match, dp[i][j] = dp[i − 1][j − 1]; otherwise 1 + min(delete dp[i − 1][j], insert dp[i][j − 1], replace dp[i − 1][j − 1]). Row 0 and column 0 count pure inserts or deletes.',
    exs: [{ in: { word1: 'cat', word2: 'cut' }, out: 1 }, { in: { word1: 'horse', word2: 'ros' }, out: 3 }],
    g: R => ({ word1: R.str(R.int(3, 4), 'abc'), word2: R.str(R.int(2, 4), 'abc') }),
    s(I, T) { const a = I.word1, b = I.word2, n = a.length, m = b.length, dp = Array.from({ length: n + 1 }, (_, i) => Array.from({ length: m + 1 }, (_, j) => i === 0 ? j : j === 0 ? i : null)); for (let i = 1; i <= n; i++) { for (let j = 1; j <= m; j++) dp[i][j] = a[i - 1] === b[j - 1] ? dp[i - 1][j - 1] : 1 + Math.min(dp[i - 1][j], dp[i][j - 1], dp[i - 1][j - 1]); const show_ = dp.map((r, k) => k < i ? r : k === i ? r.map((x, j) => j === m ? null : x) : r.map(() => null)); T.v(G(show_, { hl: [[i, m]], label: 'dp (rows = prefixes of word1)' }), K({ prefix1: a.slice(0, i), word2: b })); T.n(`Edits to turn "${a.slice(0, i)}" into "${b}"?`, dp[i][m], a[i - 1] === b[m - 1] ? 'The last letters match: copy the diagonal.' : '1 + the smallest of up, left and diagonal.'); } return dp[n][m]; }
  });

  D('introduction-to-dynamic-programming', {
    t: 'Introduction to Dynamic Programming (Fibonacci)',
    r: 'Naive recursion for F(n) calls F(n − 1) and F(n − 2), so the same values are recomputed many times. Bottom-up DP fills F(0), F(1), F(2), ... once each: F(i) = F(i − 1) + F(i − 2) with F(0) = 0, F(1) = 1.',
    exs: [{ in: { n: 5 }, out: 5 }, { in: { n: 2 }, out: 1 }],
    g: R => ({ n: R.int(4, 9) }),
    s(I, T) { const n = I.n, calls = k => k < 2 ? 1 : 1 + calls(k - 1) + calls(k - 2), hits = (k, t) => k === t ? 1 : k < 2 || k < t ? 0 : hits(k - 1, t) + hits(k - 2, t); T.at({ n }); T.n(`How many calls does naive recursion make in total to compute F(${n})?`, calls(n), 'calls(k) = 1 + calls(k − 1) + calls(k − 2), with 1 call for k < 2.'); T.n(`How many times does naive recursion compute F(2) for F(${n})?`, hits(n, 2), 'Count the F(2) leaves of the call tree. That is the repeated work DP removes.'); const f = [0, 1]; for (let i = 2; i <= n; i++) { f[i] = f[i - 1] + f[i - 2]; T.at({ F: A(f.slice(0, i), { label: 'F so far' }) }); T.n(`F(${i})?`, f[i], `F(${i - 1}) + F(${i - 2}).`); } return f[n]; }
  });

  D('labu-01-1', {
    t: '0-1 Knapsack: 2D Table',
    r: 'dp[i][c] = best value using only the first i items with capacity c. Skip item i: dp[i − 1][c]. Take it (if w ≤ c): dp[i − 1][c − w] + v. Keep the larger. Row 0 is all zeros.',
    exs: [{ in: KX, out: 35 }],
    g: knapItems,
    s(I, T) { const W = I.capacity, n = I.weights.length, dp = [Array(W + 1).fill(0)]; for (let i = 1; i <= n; i++) { const w = I.weights[i - 1], v = I.values[i - 1], row = []; for (let c = 0; c <= W; c++) row[c] = Math.max(dp[i - 1][c], c >= w ? dp[i - 1][c - w] + v : -1); dp.push(row); const cs = [...new Set([Math.min(W, w), W])]; for (const c of cs) { T.v(G(dp.slice(0, i).concat([row.map((x, k) => k < c ? x : null)]), { hl: [[i, c]], label: 'dp[i][c]' }), K({ item: `${i}: weight ${w}, value ${v}`, c })); T.n(`dp[${i}][${c}]?`, row[c], c >= w ? `max(skip ${dp[i - 1][c]}, take dp[${i - 1}][${c - w}] + ${v} = ${dp[i - 1][c - w] + v}).` : 'Too heavy: copy the row above.'); } } return dp[n][W]; }
  });

  D('labu-01-2', {
    t: '0-1 Knapsack: 1D Array',
    r: 'Squash the 2D table into one array dp[c]. For each item, scan c from the capacity down to w: dp[c] = max(dp[c], dp[c − w] + v). Going downward means dp[c − w] still holds the previous row, so no item is taken twice.',
    exs: [{ in: KX, out: 35 }],
    g: knapItems,
    s(I, T) { const W = I.capacity, dp = Array(W + 1).fill(0); I.weights.forEach((w, i) => { const v = I.values[i]; if (i === 0) T.at({ dp: A(dp), item: `weight ${w}, value ${v}` }), T.c('Which way should c run for a 0-1 item?', ['from capacity down to w', 'from w up to capacity'], 'from capacity down to w', 'Scanning upward would let dp[c − w] already include this item, so it could be taken twice.'); for (let c = W; c >= w; c--) { const old = dp[c]; dp[c] = Math.max(dp[c], dp[c - w] + v); if (i < 2 && T.room()) { T.at({ dp: A(dp.map((x, k) => k === c ? old : x), { hl: c }), item: `weight ${w}, value ${v}`, c }); T.n(`dp[${c}] after item ${i}?`, dp[c], `max(${old}, dp[${c - w}] + ${v} = ${dp[c - w] + v}).`); } } }); T.at({ dp: A(dp, { hl: W }) }); T.n(`Final dp[${W}]?`, dp[W], 'The last cell is the answer.'); return dp[W]; }
  });

  // Unbounded (complete) knapsack: capacity scanned from low to high.
  const knapForward = (I, T, detail) => { const W = I.capacity, dp = Array(W + 1).fill(0); I.weights.forEach((w, i) => { const v = I.values[i]; for (let c = w; c <= W; c++) { const old = dp[c]; dp[c] = Math.max(dp[c], dp[c - w] + v); if (detail(i, c) && T.room()) { T.at({ dp: A(dp.map((x, k) => k === c ? old : x), { hl: c }), item: `weight ${w}, value ${v} (unlimited copies)`, c }); T.n(`dp[${c}] after item ${i} at capacity ${c}?`, dp[c], `max(${old}, dp[${c - w}] + ${v} = ${dp[c - w] + v}). dp[${c - w}] may already hold copies of this item.`); } } }); return dp; };
  const knapUnb = R => { const n = R.int(2, 3); return { weights: R.ints(n, 1, 3), values: R.ints(n, 1, 9), capacity: R.int(4, 7) }; };

  D('labu-topic-0082589b24d1', {
    t: 'Complete Knapsack: 1D Array',
    r: 'Each item may be taken any number of times. Scan c from w up to the capacity: dp[c] = max(dp[c], dp[c − w] + v). Going upward lets dp[c − w] already contain copies of the same item.',
    exs: [{ in: { weights: [2], values: [3], capacity: 4 }, out: 6 }, { in: KX, out: 60 }],
    g: knapUnb,
    s(I, T) { T.at({ weights: I.weights, values: I.values }); T.c('Which way should c run when copies are unlimited?', ['from w up to capacity', 'from capacity down to w'], 'from w up to capacity', 'Downward is the 0-1 rule. Upward reuses the item.'); const dp = knapForward(I, T, i => i === 0); T.at({ dp: A(dp, { hl: I.capacity }) }); T.n(`Final dp[${I.capacity}]?`, dp[I.capacity], 'The last cell is the answer.'); return dp[I.capacity]; }
  });

  D('labu-topic-0ec03f406f23', {
    t: 'Stock Trading as a State Machine',
    r: 'Hold at most one share; trade as often as you like. After each price p: cash = max(cash, hold + p) (sell or rest) and hold = max(hold, cash_before − p) (buy or rest). Start cash = 0, hold = −infinity. The answer is the final cash.',
    exs: [{ in: { prices: [1, 2, 4] }, out: 3 }, { in: { prices: [7, 1, 5, 3, 6, 4] }, out: 7 }],
    g: R => ({ prices: R.ints(R.int(3, 6), 1, 9) }),
    s(I, T) { let cash = 0, hold = -Infinity; I.prices.forEach((p, d) => { const c0 = cash, h0 = hold; cash = Math.max(c0, h0 + p); hold = Math.max(h0, c0 - p); T.at({ prices: A(I.prices, { hl: d }), cash: c0, hold: h0 === -Infinity ? '−infinity' : h0 }); if (d < 6) { T.n(`cash after price ${p}?`, cash, `max(rest ${c0}, sell ${h0 === -Infinity ? '−infinity' : h0 + p}).`); T.n(`hold after price ${p}?`, hold, `max(rest ${h0 === -Infinity ? '−infinity' : h0}, buy ${c0} − ${p} = ${c0 - p}).`); } }); return cash; }
  });

  D('labu-topic-232208e5d426', {
    t: 'Complete Knapsack: 2D Table',
    r: 'dp[i][c] with unlimited copies of each item. Skip: dp[i − 1][c]. Take: dp[i][c − w] + v, the same row, because that cell may already hold copies of item i. Keep the larger.',
    exs: [{ in: KX, out: 60 }],
    g: knapUnb,
    s(I, T) { const W = I.capacity, n = I.weights.length, dp = [Array(W + 1).fill(0)]; for (let i = 1; i <= n; i++) { const w = I.weights[i - 1], v = I.values[i - 1], row = []; for (let c = 0; c <= W; c++) row[c] = Math.max(dp[i - 1][c], c >= w ? row[c - w] + v : -1); dp.push(row); if (i === 1) { T.v(G(dp.slice(0, 1), { label: 'dp[0]' }), K({ item: `1: weight ${w}, value ${v}` })); T.c('For the take branch, which cell do you add v to?', [`dp[i][c − w] (same row)`, `dp[i − 1][c − w] (row above)`], `dp[i][c − w] (same row)`, 'The row above forbids a second copy. That is the 0-1 rule.'); } for (const c of [...new Set([Math.min(W, 2 * w), W])]) { T.v(G(dp.slice(0, i).concat([row.map((x, k) => k < c ? x : null)]), { hl: [[i, c]], label: 'dp[i][c]' }), K({ item: `${i}: weight ${w}, value ${v}`, c })); T.n(`dp[${i}][${c}]?`, row[c], c >= w ? `max(skip ${dp[i - 1][c]}, take dp[${i}][${c - w}] + ${v} = ${row[c - w] + v}).` : 'Too heavy: copy the row above.'); } } return dp[n][W]; }
  });

  D('labu-topic-801055041d9b', {
    t: 'Delete-Only Edit Distance',
    r: 'Only deletes are allowed, from either string, until the two strings are equal. dp[i][j] for prefixes: equal last letters copy dp[i − 1][j − 1]; otherwise 1 + min(dp[i − 1][j], dp[i][j − 1]). Row 0 and column 0 delete everything. The answer is also len(a) + len(b) − 2 × LCS.',
    exs: [{ in: { a: 'ab', b: 'a' }, out: 1 }, { in: { a: 'sea', b: 'eat' }, out: 2 }],
    g: R => ({ a: R.str(R.int(2, 4), 'abc'), b: R.str(R.int(2, 4), 'abc') }),
    s(I, T) { const a = I.a, b = I.b, n = a.length, m = b.length, dp = Array.from({ length: n + 1 }, (_, i) => Array.from({ length: m + 1 }, (_, j) => i === 0 ? j : j === 0 ? i : null)); for (let i = 1; i <= n; i++) { for (let j = 1; j <= m; j++) dp[i][j] = a[i - 1] === b[j - 1] ? dp[i - 1][j - 1] : 1 + Math.min(dp[i - 1][j], dp[i][j - 1]); T.v(G(dp.map((r, k) => k < i ? r : k === i ? r.map((x, j) => j === m ? null : x) : r.map(() => null)), { hl: [[i, m]], label: 'dp' }), K({ 'a prefix': a.slice(0, i), b })); T.n(`Deletes to make "${a.slice(0, i)}" and "${b}" equal?`, dp[i][m], a[i - 1] === b[m - 1] ? 'Last letters match: copy the diagonal.' : '1 + the smaller of up and left.'); } const lcs = (n + m - dp[n][m]) / 2; T.at({ a, b, deletes: dp[n][m] }); T.n('So how long is the longest common subsequence?', lcs, `(len(a) + len(b) − deletes) / 2 = (${n} + ${m} − ${dp[n][m]}) / 2.`); return dp[n][m]; }
  });

  D('labu-topic-9d65885b98aa', {
    t: 'Knapsack Flavors: 0-1, Complete, Multiple',
    r: 'One item (weight w, value v) and a bag of capacity C. The copy rule decides the answer: 0-1 allows one copy, complete allows any number, multiple allows at most k. In each case the best is v × (copies that are allowed and fit).',
    exs: [{ in: { weight: 2, value: 3, capacity: 4, k: 1 }, out: [3, 6, 3] }],
    g: R => ({ weight: R.int(1, 3), value: R.int(1, 9), capacity: R.int(3, 10), k: R.int(1, 3) }),
    s(I, T) { const fit = Math.floor(I.capacity / I.weight), a = Math.min(1, fit) * I.value, b = fit * I.value, c = Math.min(I.k, fit) * I.value; T.at({ weight: I.weight, value: I.value, capacity: I.capacity, k: I.k }); T.n('Best value under the 0-1 rule (at most one copy)?', a, fit ? 'One copy fits.' : 'Not even one copy fits.'); T.n('Best value under the complete rule (unlimited copies)?', b, `floor(${I.capacity} / ${I.weight}) = ${fit} copies fit.`); T.n(`Best value under the multiple rule (at most k = ${I.k} copies)?`, c, `min(k, ${fit}) copies.`); T.c('In the 1D dp loop, which rule scans capacity upward?', ['complete', '0-1', 'multiple'], 'complete', 'Upward reuse is exactly what unlimited copies need.'); return [a, b, c]; }
  });

  D('labu-topic-a4d6a0f7318d', {
    t: 'Multiple (Bounded) Knapsack',
    r: 'Item i may be taken up to k_i times. For each item, for each capacity c from high to low, try every count t from 0 to k_i with t × w ≤ c: dp[c] = max(dp[c], dp[c − t × w] + t × v). Downward order keeps dp[c − t × w] free of this item.',
    exs: [{ in: { weights: [2], values: [5], counts: [2], capacity: 5 }, out: 10 }],
    g: R => { const n = R.int(1, 3); return { weights: R.ints(n, 1, 3), values: R.ints(n, 1, 9), counts: R.ints(n, 1, 3), capacity: R.int(3, 7) }; },
    s(I, T) { const W = I.capacity, dp = Array(W + 1).fill(0); I.weights.forEach((w, i) => { const v = I.values[i], k = I.counts[i], before = dp.slice(); let bestT = 0; for (let c = W; c >= 0; c--) for (let t = 1; t <= k && t * w <= c; t++) { const x = before[c - t * w] + t * v; if (x > dp[c]) { dp[c] = x; if (c === W) bestT = t; } } T.at({ dp: A(before, { label: 'dp before this item' }), item: `weight ${w}, value ${v}, up to ${k} copies` }); T.n(`How many copies of item ${i} does the best answer at capacity ${W} use now?`, bestT, `Try t = 0 to ${k}: dp[${W} − t × ${w}] + t × ${v}.`); T.n(`dp[${W}] after item ${i}?`, dp[W], 'Keep the best count.'); }); T.at({ dp: A(dp, { hl: W }) }); T.n('Final answer?', dp[W], 'The last cell.'); return dp[W]; }
  });

  D('labu-topic-a90e5e950d84', {
    t: 'DP Basics: Fibonacci by Hand',
    r: 'Four pieces of every DP: the state f(i), the recurrence f(i) = f(i − 1) + f(i − 2), the base cases f(0) = 0 and f(1) = 1, and the fill order from small i to large i.',
    exs: [{ in: { n: 5 }, out: 5 }, { in: { n: 1 }, out: 1 }],
    g: R => ({ n: R.int(3, 9) }),
    s(I, T) { const n = I.n; T.at({ n }); T.c('Base cases?', ['f(0) = 0, f(1) = 1', 'f(0) = 1, f(1) = 1', 'only f(1) = 1'], 'f(0) = 0, f(1) = 1', 'The standard Fibonacci starts 0, 1.'); T.c('Fill order for a bottom-up table?', ['small i to large i', 'large i to small i'], 'small i to large i', 'f(i) needs f(i − 1) and f(i − 2) first.'); const f = [0, 1]; for (let i = 2; i <= n; i++) { f[i] = f[i - 1] + f[i - 2]; T.at({ f: A(f.slice(0, i), { label: 'f so far' }) }); T.n(`f(${i})?`, f[i], `${f[i - 2]} + ${f[i - 1]}.`); } return f[n]; }
  });

  D('labu-topic-fb032618ee4a', {
    t: 'House Robber: Best So Far',
    r: 'You cannot rob two neighbors. best[i] = max(best[i − 1] (skip house i), best[i − 2] + money[i] (rob it)). best[0] = money[0].',
    exs: [{ in: { nums: [2, 7, 9, 3, 1] }, out: 12 }, { in: { nums: [1, 2, 3, 1] }, out: 4 }],
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 9) }),
    s(I, T) { const a = I.nums, best = []; a.forEach((x, i) => { const skip = i ? best[i - 1] : 0, take = (i > 1 ? best[i - 2] : 0) + x; best[i] = Math.max(skip, take); T.at({ nums: A(a, { hl: i }), best: A(best.slice(0, i), { label: 'best so far' }) }); if (i > 0) T.c(`At house ${i} (money ${x}): rob or skip?`, ['rob', 'skip'], take > skip ? 'rob' : 'skip', `Rob gives ${take}, skip gives ${skip}.`); T.n(`best[${i}]?`, best[i], `max(skip ${skip}, rob ${take}).`); }); return best[a.length - 1]; }
  });

  D('unbounded-knapsack-problem', {
    t: 'Unbounded Knapsack',
    r: 'Unlimited copies of each item. One array dp[c]; for each item scan c from w up to the capacity: dp[c] = max(dp[c], dp[c − w] + v). The forward scan is what allows repeats.',
    exs: [{ in: KX, out: 60 }],
    g: knapUnb,
    s(I, T) { const dp = knapForward(I, T, (i, c) => i === 0 || c === I.capacity); T.at({ dp: A(dp, { hl: I.capacity }) }); T.n(`Final dp[${I.capacity}]?`, dp[I.capacity], 'The last cell is the answer.'); return dp[I.capacity]; }
  });
})();
