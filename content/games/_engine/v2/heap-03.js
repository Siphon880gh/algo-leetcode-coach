/* v2 games: heap (3). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  // Max-heap helpers on a plain array.
  const siftDown = (a, i, n, onSwap) => { let sw = 0; for (;;) { const l = 2 * i + 1, r = l + 1; let m = i; if (l < n && a[l] > a[m]) m = l; if (r < n && a[r] > a[m]) m = r; if (m === i) return { i, sw }; [a[i], a[m]] = [a[m], a[i]]; sw++; if (onSwap) onSwap(i, m); i = m; } };
  const siftUp = (a, i) => { let sw = 0; while (i > 0) { const p = (i - 1) >> 1; if (a[p] >= a[i]) break; [a[p], a[i]] = [a[i], a[p]]; i = p; sw++; } return { i, sw }; };
  const heapify = a => { for (let i = (a.length - 2) >> 1; i >= 0; i--) siftDown(a, i, a.length); return a; };
  const heapView = (a, hl) => TR(Tr.from(a), null, { label: 'heap' });

  D('heap-construction-operation', {
    t: 'Build a Heap Bottom-Up',
    r: 'Floyd heapify for a max-heap: start at the last parent, index (n − 2) / 2 rounded down, and sift each node down to index 0. Sift down swaps a node with its larger child until it is at least as large as both children. Total work is O(n).',
    exs: [{ in: { nums: [2, 3, 9, 5, 6] }, out: [9, 6, 2, 5, 3] }],
    g: R => ({ nums: R.distinct(R.int(5, 8), 1, 20) }),
    s(I, T) { const a = I.nums.slice(), n = a.length, last = (n - 2) >> 1; T.at({ nums: A(a) }); T.n('Index of the last parent, where sift down starts?', last, `(n − 2) / 2 rounded down = (${n} − 2) / 2.`); for (let i = last; i >= 0; i--) { const before = a.slice(), r = siftDown(a, i, n); T.v(A(before, { hl: i, label: 'array' }), heapView(before)); T.n(`Sift down index ${i} (value ${before[i]}): how many swaps?`, r.sw, 'Swap with the larger child while that child is bigger.'); if (i <= 1) T.n(`Value at index ${i} afterwards?`, a[i], 'The largest of the node and its subtree tops rises here.'); } return a; }
  });

  D('heap-sort', {
    t: 'Heap Sort',
    r: 'Heapify the array into a max-heap. Then repeat: swap the root (the maximum) with the last slot of the heap, shrink the heap by one, and sift the new root down. The sorted part grows from the right.',
    exs: [{ in: { nums: [3, 1, 4, 2] }, out: [1, 2, 3, 4] }],
    g: R => ({ nums: R.distinct(R.int(4, 7), 1, 20) }),
    s(I, T) { const a = heapify(I.nums.slice()), n = a.length; T.v(A(a, { label: 'after heapify' }), heapView(a)); T.n('Root of the heap after heapify?', a[0], 'The root of a max-heap is the maximum.'); for (let end = n - 1; end > 0; end--) { const mx = a[0]; [a[0], a[end]] = [a[end], a[0]]; siftDown(a, 0, end); T.v(A(a, { ok: range(end, n), label: 'array' }), heapView(a.slice(0, end))); if (end > 1) T.n(`After moving ${mx} to index ${end} and sifting, what is the new root?`, a[0], 'The next largest value rises to the root.'); } return a; }
  });

  D('heap', {
    t: 'Heap Basics: Peek and Push',
    r: 'A max-heap stored in an array: the parent of index i is (i − 1) / 2 rounded down, its children are 2i + 1 and 2i + 2, and every parent is at least as large as its children. Peek reads index 0. Push appends at the end and sifts up, swapping with the parent while it is bigger.',
    exs: [{ in: { heap: [9, 5, 6, 2, 3], push: 7 }, out: [9, 5, 7, 2, 3, 6] }],
    g: R => ({ heap: heapify(R.distinct(R.int(4, 7), 1, 20)), push: R.int(1, 25) }),
    s(I, T) { const a = I.heap.slice(), n = a.length; T.v(A(a, { label: 'heap array' }), heapView(a)); T.n('Peek: the maximum value?', a[0], 'The root at index 0.'); T.n(`Parent index of index ${n - 1}?`, (n - 2) >> 1, `(${n - 1} − 1) / 2 rounded down.`); a.push(I.push); const r = siftUp(a, n); T.v(A(a.map((x, k) => k === n ? I.push : x), { hl: n, label: 'after append' }), heapView(a)); T.n(`Push ${I.push}: how many swaps does sift up make?`, r.sw, 'Swap with the parent while the new value is bigger.'); T.n(`At which index does ${I.push} settle?`, r.i, 'Where its parent is at least as large, or at the root.'); return a; }
  });

  D('labu-topic-92b6a2489d29', {
    t: 'Priority Queue on a Binary Heap',
    r: 'A max priority queue as a binary heap: peek reads the root; push appends and sifts up; pop takes the root, moves the last value to the root and sifts it down. Each push or pop is O(log n).',
    exs: [{ in: { heap: [9, 5, 6, 2, 3], push: 10 }, out: [9, 5, 6, 2, 3] }],
    g: R => ({ heap: heapify(R.distinct(R.int(4, 7), 1, 20)), push: R.int(1, 25) }),
    s(I, T) { const a = I.heap.slice(); T.v(A(a, { label: 'heap array' }), heapView(a)); T.n('peek()?', a[0], 'The root.'); a.push(I.push); const r = siftUp(a, a.length - 1); T.v(A(a, { label: 'after push' }), heapView(a)); T.n(`push(${I.push}): how many sift-up swaps?`, r.sw, 'Swap upward while bigger than the parent.'); const top = a[0]; T.n('pop() returns?', top, 'pop returns the root.'); a[0] = a[a.length - 1]; a.pop(); siftDown(a, 0, a.length); T.v(A(a, { label: 'after pop' }), heapView(a)); T.n('New root after pop?', a[0], 'The larger child keeps rising until order holds.'); return a; }
  });

  D('top-k-problem', {
    t: 'Top K with a Min-Heap',
    r: 'Keep a min-heap of size k. Push the first k values. For each later value x, if x is bigger than the heap top (the smallest of the kept values), pop the top and push x. At the end the heap holds the k largest values.',
    exs: [{ in: { nums: [5, 1, 9, 3, 7, 8], k: 3 }, out: [9, 8, 7] }],
    g: R => ({ nums: R.distinct(R.int(5, 8), 1, 20), k: R.int(2, 3) }),
    s(I, T) { const k = I.k, h = I.nums.slice(0, k); h.sort((x, y) => x - y); T.at({ nums: A(I.nums, { ok: range(0, k) }), heap: A(h, { label: 'min-heap (sorted view)' }) }); T.n('Heap top after the first k values?', h[0], 'The smallest of the first k.'); for (let i = k; i < I.nums.length; i++) { const x = I.nums[i], top = h[0]; T.at({ nums: A(I.nums, { hl: i }), heap: A(h.slice(), { label: 'min-heap (sorted view)' }) }); T.yn(`x = ${x}: replace the top ${top}?`, x > top, x > top ? `${x} > ${top}, so ${top} cannot be in the top k.` : `${x} ≤ ${top}, so it is not among the k largest so far.`); if (x > top) { h[0] = x; h.sort((a, b) => a - b); } T.n('Heap top now?', h[0], 'The smallest kept value.'); } return h.slice().sort((a, b) => b - a); }
  });
})();
