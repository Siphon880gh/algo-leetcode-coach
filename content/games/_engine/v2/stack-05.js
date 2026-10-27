/* v2 games: stack (5). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  const opList = (R, need) => { const ops = []; let size = 0, popped = 0; for (let i = 0; i < 12 && (popped < need || i < 7); i++) { if (size && (R.chance(0.45) || size > 3)) { ops.push('pop'); size--; popped++; } else { ops.push('push ' + R.int(1, 9)); size++; } } return ops; };

  D('stack', {
    t: 'Stack: Last In, First Out',
    r: 'push puts a value on top; pop removes and returns the top. The newest value always leaves first.',
    exs: [{ in: { ops: ['push 3', 'push 1', 'push 4', 'pop'] }, out: [4] }],
    g: R => ({ ops: opList(R, 3) }),
    s(I, T) { const st = [], out = []; I.ops.forEach(op => { const [o, x] = op.split(' '); if (o === 'push') { st.push(+x); return; } T.v(S(st, 'stack (top last)'), K({ op })); const v = st.pop(); T.n(`${op} returns?`, v, 'The top value, pushed most recently.'); out.push(v); }); T.v(S(st, 'stack (top last)')); T.n('How many values are left on the stack?', st.length, 'Pushes minus pops.'); return out; }
  });

  D('labu-topic-40d78dc49f3d', {
    t: 'Stack or Queue?',
    r: 'Push the same values into a stack and a queue. The stack gives them back newest first (LIFO); the queue gives them back oldest first (FIFO). Pick the stack when the newest pending item must go next, the queue when the oldest must.',
    exs: [{ in: { nums: [1, 2, 3] }, out: [[3, 2, 1], [1, 2, 3]] }],
    g: R => ({ nums: R.distinct(R.int(3, 6), 1, 20) }),
    s(I, T) { const a = I.nums, st = a.slice().reverse(); T.v(S(a, 'stack'), Q(a, 'queue')); T.n('First value popped from the stack?', st[0], 'The last value pushed.'); T.n('First value dequeued from the queue?', a[0], 'The first value pushed.'); T.n('Second value popped from the stack?', st[1], 'Newest remaining.'); T.c('Which structure does BFS level order need?', ['queue', 'stack'], 'queue', 'BFS processes the oldest discovered node first.'); T.c('Undo history (reverse the latest action first) needs?', ['stack', 'queue'], 'stack', 'The newest action is undone first.'); return [st, a.slice()]; }
  });
})();
