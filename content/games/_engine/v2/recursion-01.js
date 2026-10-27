/* v2 games: recursion (1). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  D('divide-and-conquer-algorithms', {
    t: 'Divide and Conquer: Merge Sort Shape',
    r: 'Divide the array into halves (the left half gets the first floor(n / 2) items) until pieces have size 1, conquer each half recursively, then combine with a merge. The pieces are independent, so no work is repeated.',
    exs: [{ in: { nums: [3, 1, 4, 2] }, out: [1, 2, 3, 4] }],
    g: R => ({ nums: R.distinct(R.int(4, 8), 1, 20) }),
    s(I, T) { const a = I.nums, n = a.length, m = n >> 1, depth = k => k < 2 ? 0 : 1 + Math.max(depth(k >> 1), depth(k - (k >> 1))); T.at({ nums: A(a, { win: [0, m - 1] }) }); T.n('How many base cases (pieces of size 1) does the recursion reach?', n, 'Every element ends up alone.'); T.n('How many merge (combine) calls run in total?', n - 1, 'Each merge joins two pieces into one: n pieces need n − 1 merges.'); T.n('How many levels of splitting?', depth(n), 'Halve until size 1.'); const L = a.slice(0, m).sort((x, y) => x - y), Rr = a.slice(m).sort((x, y) => x - y); T.v(A(L, { label: 'left half, sorted' }), A(Rr, { label: 'right half, sorted' })); T.n('First value of the final merge?', Math.min(L[0], Rr[0]), 'The smaller of the two fronts.'); return a.slice().sort((x, y) => x - y); }
  });

  D('hanota-problem', {
    t: 'Tower of Hanoi',
    r: 'To move n disks from A to C using B: move the top n − 1 disks from A to B (using C), move the largest disk from A to C, then move the n − 1 disks from B to C (using A). One disk moves straight across. The total is 2 to the power n, minus 1, moves.',
    exs: [{ in: { n: 2 }, out: 3 }, { in: { n: 3 }, out: 7 }],
    g: R => ({ n: R.int(2, 4) }),
    s(I, T) { const moves = [], P = { A: [], B: [], C: [] }; for (let d = I.n; d >= 1; d--) P.A.push(d); (function h(k, f, t, v) { if (!k) return; h(k - 1, f, v, t); moves.push([f, t]); h(k - 1, v, t, f); })(I.n, 'A', 'C', 'B'); const all = ['A to B', 'A to C', 'B to A', 'B to C', 'C to A', 'C to B']; T.at({ n: I.n }); T.n('How many moves in total?', moves.length, `2 to the power ${I.n}, minus 1.`); moves.forEach(([f, t], i) => { if (i < 5) { T.at({ A: A(P.A, { label: 'peg A (bottom first)' }), B: A(P.B, { label: 'peg B' }), C: A(P.C, { label: 'peg C' }) }); T.c(`Move ${i + 1}: which move?`, all, f + ' to ' + t, 'Follow the recursion: n − 1 disks out of the way, largest across, n − 1 disks back on top.'); } P[t].push(P[f].pop()); }); return moves.length; }
  });

  D('iteration-and-recursion', {
    t: 'Iteration vs Recursion: Sum 1 to n',
    r: 'Iterative: s = 0, then add i for i = 1 to n, using one frame. Recursive: sum(n) = n + sum(n − 1) with sum(1) = 1, which stacks n frames before any returns. Same answer, different space.',
    exs: [{ in: { n: 4 }, out: 10 }, { in: { n: 1 }, out: 1 }],
    g: R => ({ n: R.int(3, 9) }),
    s(I, T) { const n = I.n, k = Math.max(1, n - 2); T.at({ n }); T.n('Recursive version: how many frames are on the stack at the deepest point?', n, 'sum(n), sum(n − 1), ..., sum(1).'); T.n('Iterative version: how many frames?', 1, 'A loop runs in one frame.'); T.n(`Recursive: what does sum(${k}) return to its caller?`, k * (k + 1) / 2, `1 + 2 + ... + ${k}.`); T.n(`Iterative: what is s after the loop finishes i = ${n - 1}?`, (n - 1) * n / 2, `1 + ... + ${n - 1}.`); return n * (n + 1) / 2; }
  });

  D('labu-topic-9d96f0755bfa', {
    t: 'Cost of Recursion: Calls and Depth',
    r: 'Time follows how many calls do work; space follows the deepest chain of open calls. sum(n) = n + sum(n − 1) with sum(1) = 1 makes n calls with depth n. Naive fib(n) = fib(n − 1) + fib(n − 2) with fib(0) and fib(1) as base cases makes an exploding number of calls but still has depth only n.',
    exs: [{ in: { n: 5 }, out: [5, 15] }],
    g: R => ({ n: R.int(3, 8) }),
    s(I, T) { const n = I.n, calls = k => k < 2 ? 1 : 1 + calls(k - 1) + calls(k - 2); T.at({ n }); T.n(`How many calls does sum(${n}) make?`, n, 'One per value n down to 1.'); T.n(`How many calls does naive fib(${n}) make?`, calls(n), 'calls(k) = 1 + calls(k − 1) + calls(k − 2), with 1 for k < 2.'); T.n(`Maximum depth of open calls for fib(${n})?`, n, `fib(${n}), fib(${n - 1}), ..., fib(1).`); T.c('With memo on fib, the number of calls that do real work grows like?', ['n', 'n squared', '2 to the power n'], 'n', 'Each fib(k) is computed once.'); return [n, calls(n)]; }
  });
})();
