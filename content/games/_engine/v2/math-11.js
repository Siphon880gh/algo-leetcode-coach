/* v2 games: math (11). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  D('maximum-product-cutting-problem', {
    t: 'Maximum Product Cutting',
    r: 'Split n (at least 2) into at least two positive parts with the largest product. Use as many 3s as you can. If 1 is left over, trade one 3 + 1 for 2 + 2. If 2 is left over, keep it. (n = 2 gives 1 × 1, n = 3 gives 2 × 1.)',
    exs: [{ in: { n: 10 }, out: 36 }, { in: { n: 2 }, out: 1 }],
    g: R => ({ n: R.int(5, 20) }),
    s(I, T) { const n = I.n, r = n % 3, threes = r === 1 ? (n - 4) / 3 : (n - r) / 3, twos = r === 1 ? 2 : r === 2 ? 1 : 0, prod = n < 4 ? n - 1 : 3 ** threes * 2 ** twos; const dp = [0, 1]; for (let i = 2; i <= n; i++) { dp[i] = 0; for (let j = 1; j < i; j++) dp[i] = Math.max(dp[i], j * (i - j), j * dp[i - j]); } T.at({ n }); T.n(`${n} mod 3?`, r, 'The remainder decides the fix.'); T.n('How many 3s in the best split?', threes, r === 1 ? 'Remainder 1: one 3 + 1 becomes 2 + 2.' : 'Take every 3.'); T.n('How many 2s?', twos, r === 1 ? 'Two, from the 2 + 2 trade.' : r === 2 ? 'One leftover 2.' : 'None.'); T.n('Best product?', prod, `3 to the power ${threes} × 2 to the power ${twos}.`); T.at({ dp: A(dp.slice(0, Math.min(n + 1, 12)), { label: 'dp check' }) }); return n < 4 ? n - 1 : dp[n]; }
  });

  D('time-complexity', {
    t: 'Time Complexity: Count the Work',
    r: 'Count how many times the innermost line runs as a function of n, then keep only the fastest-growing term and drop constants. Three nested loops of n run n³ times: O(n³). A loop j < i inside i < n runs n(n − 1) / 2 times: O(n²). Halving i until it reaches 1 runs about log₂ n times: O(log n).',
    exs: [{ in: { n: 4 }, out: [64, 6, 3] }, { in: { n: 8 }, out: [512, 28, 4] }],
    g: R => ({ n: R.int(3, 16) }),
    s(I, T) { const n = I.n; let h = 0; for (let i = n; i >= 1; i = Math.floor(i / 2)) h++; const C = ['O(1)', 'O(log n)', 'O(n)', 'O(n²)', 'O(n³)']; T.at({ n, 'snippet 1': 'for i < n: for j < n: for k < n: work' }); T.n('How many times does work run in snippet 1?', n ** 3, `${n} × ${n} × ${n}.`); T.at({ n, 'snippet 2': 'for i < n: for j < i: work' }); T.n('How many times does work run in snippet 2?', n * (n - 1) / 2, `0 + 1 + ... + ${n - 1}.`); T.c('Big-O class of snippet 2?', C, 'O(n²)', 'n(n − 1) / 2 keeps n² once constants are dropped.'); T.at({ n, 'snippet 3': 'i = n; while i ≥ 1: work; i = floor(i / 2)' }); T.n('How many times does work run in snippet 3?', h, 'Count the halvings down to 1, including 1.'); T.c('Big-O class of snippet 3?', C, 'O(log n)', 'Halving each time.'); return [n ** 3, n * (n - 1) / 2, h]; }
  });
})();
