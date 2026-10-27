/* v2 games: intervals (02). Guides scored in the 4042–4095 pass. */
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

  D('number-of-intersecting-interval-pairs-i', {
    t: 'Number of Intersecting Interval Pairs I',
    r: 'Two closed intervals intersect exactly when max(start) ≤ min(end), shared endpoints included. With n ≤ 100, check every pair.',
    g: R => ({ intervals: Array.from({ length: R.int(3, 5) }, () => { const s = R.int(0, 8); return [s, s + R.int(0, 4)]; }) }),
    s(I, T) { const v = I.intervals, n = v.length; let c = 0, asked = 0; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) { const lo = Math.max(v[i][0], v[j][0]), hi = Math.min(v[i][1], v[j][1]), ok = lo <= hi; if (asked < 8) { T.at({ intervals: IV(v, { hl: [i, j] }), pairs: c }); T.yn(`Do [${v[i].join(', ')}] and [${v[j].join(', ')}] intersect?`, ok, `max start ${lo} ${ok ? '≤' : '>'} min end ${hi}.`); asked++; } if (ok) c++; } T.at({ intervals: IV(v), pairs: c }); T.n('How many intersecting pairs?', c, 'Count the pairs that intersect.'); return c; }
  });

  D('number-of-intersecting-interval-pairs-ii', {
    t: 'Number of Intersecting Interval Pairs II',
    r: 'Sort by start. Each interval intersects every earlier one whose end is at least its start. Keep the earlier ends in a min-heap, pop the ends below the current start, and add the heap size.',
    g: R => ({ intervals: Array.from({ length: R.int(3, 6) }, () => { const s = R.int(0, 9); return [s, s + R.int(0, 4)]; }) }),
    s(I, T) { const v = I.intervals.slice().sort((a, b) => a[0] - b[0] || a[1] - b[1]); let heap = [], c = 0; v.forEach(([s, e], i) => { if (i < 7) { T.at({ sorted: IV(v, { hl: i }), heap: A(heap.slice()), pairs: c }); T.n(`After popping ends below ${s}, how many earlier intervals remain?`, heap.filter(x => x >= s).length, 'Earlier starts are ≤ s, so they intersect exactly when their end ≥ s.'); } heap = heap.filter(x => x >= s); c += heap.length; heap.push(e); heap.sort((a, b) => a - b); }); T.at({ sorted: IV(v), pairs: c }); T.n('How many intersecting pairs?', c, 'Add the heap sizes.'); return c; }
  });
})();
