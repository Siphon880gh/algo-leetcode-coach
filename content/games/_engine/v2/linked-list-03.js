/* v2 games: linked-list (3). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  D('02-07', {
    t: 'Intersection of Two Linked Lists',
    r: 'Walk pointer p from head A and q from head B one node at a time. When a pointer runs off the end, restart it at the other list\'s head. Both travel lenA + lenB nodes, so they meet at the first shared node, or both reach null together if nothing is shared. Compare nodes, not values.',
    exs: [{ in: { a: ['a1', 'a2'], b: ['b1', 'b2', 'b3'], common: ['c1', 'c2', 'c3'] }, out: 'c1' }, { in: { a: ['x'], b: ['y', 'z'], common: [] }, out: null }],
    g: R => { const L = (p, n) => range(1, n + 1).map(i => p + i); return { a: L('a', R.int(1, 4)), b: L('b', R.int(1, 4)), common: R.chance(0.8) ? L('c', R.int(1, 3)) : [] }; },
    s(I, T) { const mk = v => ({ val: v, next: null }), C = I.common.map(mk); C.forEach((x, i) => x.next = C[i + 1] || null); const chain = vs => { const ns = vs.map(mk); ns.forEach((x, i) => x.next = ns[i + 1] || C[0] || null); return ns[0] || C[0] || null; }; const hA = chain(I.a), hB = chain(I.b), la = I.a.length + C.length, lb = I.b.length + C.length; T.v(LL(hA, { A: hA }, { label: 'list A' }), LL(hB, { B: hB }, { label: 'list B' })); T.n('Length of list A?', la, 'Its own nodes plus the shared tail.'); T.n('Length of list B?', lb, 'Its own nodes plus the shared tail.'); let p = hA, q = hB, steps = 0; while (p !== q) { p = p ? p.next : hB; q = q ? q.next : hA; steps++; } T.n('How many moves until p and q are the same node (or both null)?', steps, 'Simulate: a pointer that runs off the end spends one move jumping to the other head. Equal remaining lengths make them line up.'); T.c('Where do they meet?', [...new Set([p ? p.val : 'null (no intersection)', 'null (no intersection)', ...I.common.slice(0, 2), I.a[I.a.length - 1]])], p ? p.val : 'null (no intersection)', 'Equal path lengths line them up at the first shared node.'); return p ? p.val : null; }
  });

  D('linked-list', {
    t: 'Linked List: Walk and Splice',
    r: 'Each node holds a value and a next pointer. Finding a value walks from the head, one node at a time: O(n). Inserting after a node you already hold rewires two pointers (new.next = node.next, then node.next = new): O(1).',
    exs: [{ in: { nums: [10, 20, 30], find: 30, insert: 15 }, out: [10, 15, 20, 30] }],
    g: R => { const a = R.distinct(R.int(3, 6), 10, 99); return { nums: a, find: a[R.int(1, a.length - 1)], insert: R.int(1, 9) }; },
    s(I, T) { const h = Ls.from(I.nums); T.v(LL(h, { head: h })); T.n(`How many nodes do you visit to find ${I.find}, counting the head?`, I.nums.indexOf(I.find) + 1, 'Walk from the head until the value matches.'); T.n(`Insert ${I.insert} after the head: how many pointers are rewired?`, 2, 'The new node\'s next, then head.next.'); const x = { val: I.insert, next: h.next }; h.next = x; T.v(LL(h, { head: h }, { hl: x })); T.n('Which value now follows the new node?', x.next ? x.next.val : -1, 'It points at the old second node.'); T.n('New length?', I.nums.length + 1, 'One node added.'); return Ls.arr(h); }
  });

  D('labu-topic-1ddddded2965', {
    t: 'Linked List Toolkit: Fast and Slow Pointers',
    r: 'Slow moves one node and fast moves two nodes per step. Stop when fast is null or fast.next is null; slow is then at the middle (the second middle for an even length). Before any rewire, save next first so the rest of the list is not lost.',
    exs: [{ in: { nums: [1, 2, 3, 4] }, out: 3 }, { in: { nums: [1, 2, 3, 4, 5] }, out: 3 }],
    g: R => ({ nums: R.distinct(R.int(4, 8), 1, 20) }),
    s(I, T) { const h = Ls.from(I.nums); let s = h, f = h, k = 0; while (f && f.next) { s = s.next; f = f.next.next; k++; T.v(LL(h, { slow: s, fast: f })); T.n(`After step ${k}, which value is slow on?`, s.val, 'Slow moves one node per step.'); } T.n('How many steps ran?', k, 'Stop when fast or fast.next is null.'); T.c('To reverse cur.next safely, what comes first?', ['save nxt = cur.next', 'set cur.next = prev'], 'save nxt = cur.next', 'Rewiring first loses the rest of the list.'); return s.val; }
  });
})();
