/* v2 games: bits (04). Guides scored in the 4042–4095 pass. */
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

  D('minimum-operations-to-make-xor-of-all-elements-zero', {
    t: 'Minimum Operations to Make XOR of All Elements Zero',
    r: 'Let X be the XOR of everything. The answer is the fewest elements whose XOR is X, since each move folds one of them away. Find it with BFS over XOR values, using each distinct value as an edge. If it needs every element, the answer is −1.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 15) }),
    s(I, T) { const a = I.nums, n = a.length; let X = 0; a.forEach(v => { X ^= v; }); T.at({ nums: A(a) }); T.n('XOR of the whole array (X)?', X, 'XOR every element together.'); if (X === 0) { T.n('Operations needed?', 0, 'It is already 0.'); return 0; } const vals = [...new Set(a)], dist = new Map([[0, 0]]), q = [0]; for (let h = 0; h < q.length; h++) { const u = q[h]; for (const v of vals) { const w = u ^ v; if (!dist.has(w)) { dist.set(w, dist.get(u) + 1); q.push(w); } } } const d = dist.get(X); for (let L = 1; L <= Math.min(d, 4); L++) { T.at({ nums: A(a), X, level: L }); T.yn(`Can at most ${L} elements XOR to ${X}?`, d <= L, d <= L ? `BFS reaches ${X} at level ${d}.` : `BFS has not reached ${X} by level ${L}.`); } const ans = d >= n ? -1 : d; T.at({ nums: A(a), X, fewest: d }); T.n('Minimum operations (type -1 if impossible)?', ans, d >= n ? 'Every element is needed, so the total can never become 0.' : `${d} elements fold into the rest.`); return ans; }
  });

  D('binary-digit-score', {
    t: 'Binary Digit Score',
    r: 'Count set bits by peeling the lowest bit (x & 1, then x >> 1). Then branch: if s1 at least s2 the score is s1 times s2, otherwise s2 divided by s1 with integer division.',
    g: R => ({ a: R.int(1, 100), b: R.int(1, 100) }),
    s(I, T) { const s1 = popc(I.a), s2 = popc(I.b); T.at({ a: X(I.a.toString(2), `a = ${I.a} in binary`), b: X(I.b.toString(2), `b = ${I.b} in binary`) }); T.n(`Set bits in a = ${I.a}?`, s1, 'Count the 1s.'); T.n(`Set bits in b = ${I.b}?`, s2, 'Count the 1s.'); const rule = s1 >= s2 ? 's1 times s2' : 's2 divided by s1'; T.c('Which rule applies?', ['s1 times s2', 's2 divided by s1'], rule, s1 >= s2 ? `${s1} at least ${s2}.` : `${s1} < ${s2}.`); const ans = s1 >= s2 ? s1 * s2 : Math.floor(s2 / s1); T.n('Score?', ans, s1 >= s2 ? `${s1} times ${s2}.` : `floor(${s2} divided by ${s1}).`); return ans; }
  });
})();
