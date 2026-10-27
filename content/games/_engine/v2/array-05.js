/* v2 games: array (5). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  D('array', {
    t: 'Array: Read vs Insert',
    r: 'Element i lives at base + i times size, so reading any index is O(1). Inserting at index k shifts every element from k to the end one slot right, which is O(n).',
    exs: [{ in: { nums: [72, 88, 91, 65, 80], index: 2, insertAt: 2, value: 99 }, out: [72, 88, 99, 91, 65, 80] }],
    g: R => { const n = R.int(4, 7); return { nums: R.ints(n, 10, 99), index: R.int(0, n - 1), insertAt: R.int(0, n - 1), value: R.int(10, 99) }; },
    s(I, T) { const a = I.nums, n = a.length, k = I.insertAt; T.at({ nums: A(a, { hl: I.index }) }); T.n(`Read index ${I.index}: which value?`, a[I.index], 'Jump straight to base + index times size.'); T.at({ nums: A(a, { hl: range(k, n) }) }); T.n(`Insert ${I.value} at index ${k}: how many elements shift right?`, n - k, `Indexes ${k} to ${n - 1}.`); const b = a.slice(0, k).concat([I.value], a.slice(k)); T.at({ nums: A(b, { hl: k }) }); T.n(`After the insert, which value sits at index ${k + 1}?`, b[k + 1], 'The old value at the insert spot moved one slot right.'); T.n('New length?', b.length, 'One more than before.'); return b; }
  });

  D('exercises', {
    t: 'Array vs Linked List Drill',
    r: 'An array reads any index in O(1) but inserting at the head shifts every element. A linked list inserts at the head by rewiring one pointer (the new node points at the old head) but reaching index i means walking i steps.',
    exs: [{ in: { nums: [10, 20, 30], value: 5 }, out: [5, 10, 20, 30] }],
    g: R => ({ nums: R.ints(R.int(3, 6), 10, 99), value: R.int(1, 9) }),
    s(I, T) { const a = I.nums, n = a.length; T.at({ array: A(a, { hl: n - 1 }) }); T.n(`Array: read index ${n - 1}. How many elements do you touch?`, 1, 'Index math jumps straight there.'); T.v(LL(Ls.from(a), { head: Ls.from(a) }, { label: 'linked list' })); T.n(`Linked list: how many next-pointer hops to reach index ${n - 1} from the head?`, n - 1, 'Walk one node per hop.'); T.at({ array: A(a, { hl: range(0, n) }) }); T.n(`Array: insert ${I.value} at the head. How many elements shift?`, n, 'Every element moves one slot right.'); T.n(`Linked list: insert ${I.value} at the head. How many existing elements shift?`, 0, 'Nothing moves: the new node points at the old head and becomes the head.'); return [I.value].concat(a); }
  });

  D('list', {
    t: 'Dynamic List: Growth by Doubling',
    r: 'A dynamic array keeps a capacity. Appending when size equals capacity allocates double the capacity, copies every element over, then writes the new one. Doubling makes n appends cost O(n) in total, so O(1) each on average.',
    exs: [{ in: { values: [10, 20, 30], capacity: 1 }, out: 4 }],
    g: R => ({ values: R.ints(R.int(4, 9), 1, 99), capacity: R.int(1, 2) }),
    s(I, T) { let cap = I.capacity, size = 0, copies = 0; I.values.forEach((v, i) => { const grow = size === cap; if (grow) { copies += size; cap *= 2; } size++; if (i < 6) { T.at({ list: A(I.values.slice(0, size)), capacity: grow ? cap / 2 : cap }); T.n(`Append ${v}: capacity afterwards?`, cap, grow ? `Full, so double to ${cap} and copy ${size - 1} elements.` : 'Room left: just write it.'); } }); T.at({ list: A(I.values), capacity: cap }); T.n('Total elements copied by all the resizes?', copies, 'Add the size at each doubling.'); return cap; }
  });

  D('vector', {
    t: 'Vector: When Does an Append Resize?',
    r: 'A vector (C++ vector, Java ArrayList) holds size values in a buffer of some capacity. An append with size < capacity just writes. An append with size = capacity allocates a buffer of twice the capacity, copies all values, then writes.',
    exs: [{ in: { start: [10, 20], capacity: 2, values: [30] }, out: 4 }],
    g: R => { const s = R.ints(R.int(1, 3), 1, 99); return { start: s, capacity: s.length + R.int(0, 1), values: R.ints(R.int(3, 6), 1, 99) }; },
    s(I, T) { let cap = I.capacity, size = I.start.length, copies = 0; const cur = I.start.slice(); I.values.forEach(v => { const grow = size === cap; T.at({ vector: A(cur.concat(Array(cap - size).fill('_'))), size, capacity: cap }); T.yn(`Append ${v}: does it trigger a resize?`, grow, grow ? `size = capacity = ${cap}.` : `size ${size} < capacity ${cap}.`); if (grow) { copies += size; cap *= 2; } cur.push(v); size++; }); T.at({ vector: A(cur.concat(Array(cap - size).fill('_'))), capacity: cap }); T.n('Final capacity?', cap, 'Doubles at each full append.'); T.n('Total values copied during resizes?', copies, 'Each resize copies the current size.'); return cap; }
  });

  D('labu-topic-5c4cadf47ae4', {
    t: 'Array Fundamentals: Prefix Sums',
    r: 'pre[i] = pre[i − 1] + a[i], with pre[0] = a[0]. Then the sum of a[l to r] is pre[r] − pre[l − 1] (or just pre[r] when l = 0), in O(1) per query after an O(n) build.',
    exs: [{ in: { nums: [4, 5, 6], l: 1, r: 2 }, out: [4, 9, 15] }],
    g: R => { const n = R.int(4, 7), l = R.int(1, n - 2); return { nums: R.ints(n, 1, 9), l, r: R.int(l, n - 1) }; },
    s(I, T) { const a = I.nums, p = []; a.forEach((x, i) => { p[i] = (i ? p[i - 1] : 0) + x; if (i > 0 && i < 6) { T.at({ nums: A(a, { hl: i }), pre: A(p.slice(0, i)) }); T.n(`pre[${i}]?`, p[i], `pre[${i - 1}] + a[${i}] = ${p[i - 1]} + ${x}.`); } }); const s = p[I.r] - (I.l ? p[I.l - 1] : 0); T.at({ nums: A(a, { win: [I.l, I.r] }), pre: A(p) }); T.n(`Sum of a[${I.l}..${I.r}] using prefixes?`, s, `pre[${I.r}] − pre[${I.l - 1}] = ${p[I.r]} − ${p[I.l - 1]}.`); return p; }
  });
})();
