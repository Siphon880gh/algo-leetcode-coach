/* v2 games: queue (1). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  // Random op lists like ['push 3', 'pop']; never pops an empty structure, and at least `need` pops.
  const opList = (R, pushes, pops, need) => { const ops = []; let size = 0, popped = 0; for (let i = 0; i < 12 && (popped < need || i < 7); i++) { if (size && (R.chance(0.45) || size > 3)) { ops.push(R.pick(pops)); size--; popped++; } else { ops.push(R.pick(pushes) + ' ' + R.int(1, 9)); size++; } } return ops; };

  D('queue', {
    t: 'Queue: First In, First Out',
    r: 'enqueue adds at the rear; dequeue removes and returns the front. The value that has waited longest leaves first.',
    exs: [{ in: { ops: ['enqueue 3', 'enqueue 1', 'enqueue 4', 'dequeue'] }, out: [3] }],
    g: R => ({ ops: opList(R, ['enqueue'], ['dequeue'], 3) }),
    s(I, T) { const q = [], out = []; I.ops.forEach((op, i) => { const [o, x] = op.split(' '); if (o === 'enqueue') { q.push(+x); return; } T.v(Q(q, 'queue (front on the left)'), K({ op })); const v = q.shift(); T.n(`${op} returns?`, v, 'The front value, the one enqueued earliest.'); out.push(v); if (q.length) T.n('Front of the queue now?', q[0], 'The next oldest value.'); }); return out; }
  });

  D('deque', {
    t: 'Deque: Both Ends',
    r: 'A double-ended queue adds and removes at both ends: push_front and pop_front work on the left end, push_back and pop_back on the right end. Each is O(1).',
    exs: [{ in: { ops: ['push_back 10', 'push_back 20', 'push_back 30', 'push_front 5', 'pop_front', 'pop_back'] }, out: [5, 30] }],
    g: R => ({ ops: opList(R, ['push_back', 'push_front'], ['pop_back', 'pop_front'], 3) }),
    s(I, T) { const d = [], out = []; I.ops.forEach(op => { const [o, x] = op.split(' '); T.v(A(d, { label: 'deque (front on the left)' }), K({ op })); if (o === 'push_back') d.push(+x); else if (o === 'push_front') d.unshift(+x); else { const v = o === 'pop_front' ? d.shift() : d.pop(); T.n(`${op} returns?`, v, o === 'pop_front' ? 'The leftmost value.' : 'The rightmost value.'); out.push(v); return; } if (op === I.ops[1]) T.n(`After ${op}, what is the front value?`, d[0], 'Read the left end.'); }); return out; }
  });
})();
