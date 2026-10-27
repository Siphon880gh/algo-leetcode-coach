/* v2 games: binary-search (7). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  const sortedArr = R => R.ints(R.int(5, 9), 1, 9).sort((x, y) => x - y);
  // First index in [0, n] where ok(i) is true; asks about each probe.
  const firstTrue = (a, ok, T, desc) => { let lo = 0, hi = a.length; while (lo < hi) { const mid = (lo + hi) >> 1, y = ok(a[mid]); T.at({ nums: A(a, { lo, mid, hi: hi < a.length ? hi : undefined, win: [lo, hi - 1] }) }); T.yn(`mid = ${mid} (value ${a[mid]}): is ${desc(a[mid])} true?`, y, y ? 'True: the boundary is here or to the left, so hi = mid.' : 'False: the boundary is to the right, so lo = mid + 1.'); if (y) hi = mid; else lo = mid + 1; } return lo; };

  D('binary-search-boundaries', {
    t: 'Binary Search Boundaries',
    r: 'With a monotonic test (false ... false, true ... true), binary search finds the first true index: if the test holds at mid set hi = mid, else lo = mid + 1, until lo = hi. Leftmost index of x: first index with a[i] ≥ x. Rightmost index of x: (first index with a[i] > x) − 1.',
    exs: [{ in: { nums: [1, 2, 2, 2, 5], target: 2 }, out: [1, 3] }, { in: { nums: [1, 3], target: 2 }, out: [-1, -1] }],
    g: R => { const a = sortedArr(R); return { nums: a, target: R.chance(0.8) ? a[R.int(0, a.length - 1)] : R.int(1, 9) }; },
    s(I, T) { const a = I.nums, x = I.target, L = firstTrue(a, v => v >= x, T, v => `${v} ≥ ${x}`); T.at({ nums: A(a, { hl: L < a.length ? L : undefined }) }); T.n(`First index with a[i] ≥ ${x}?`, L, 'Where lo and hi met.'); const U = firstTrue(a, v => v > x, T, v => `${v} > ${x}`); T.n(`First index with a[i] > ${x}?`, U, 'Where lo and hi met.'); return L < a.length && a[L] === x ? [L, U - 1] : [-1, -1]; }
  });

  D('binary-search-insertion-point', {
    t: 'Binary Search Insertion Point',
    r: 'The insertion point of x in a sorted array is the first index i with a[i] ≥ x (lower bound); it is n when every value is smaller. Search lo = 0, hi = n: if a[mid] ≥ x set hi = mid, else lo = mid + 1.',
    exs: [{ in: { nums: [1, 3, 5, 7], target: 4 }, out: 2 }, { in: { nums: [1, 3, 5, 7], target: 9 }, out: 4 }],
    g: R => ({ nums: R.distinct(R.int(5, 9), 1, 30).sort((x, y) => x - y), target: R.int(0, 31) }),
    s(I, T) { const a = I.nums, x = I.target, i = firstTrue(a, v => v >= x, T, v => `${v} ≥ ${x}`); T.at({ nums: A(a) }); T.n(`Insertion point for ${x}?`, i, 'lo once the range is empty.'); const b = a.slice(0, i).concat([x], a.slice(i)); T.at({ nums: A(b, { hl: i }) }); T.n(`After inserting, how many values sit to the right of ${x}?`, a.length - i, 'Those all shift one slot.'); return i; }
  });

  D('divide-and-conquer-search-strategy', {
    t: 'Divide and Conquer Search',
    r: 'Binary search on a sorted array keeps a live range [lo, hi]. Look at mid = (lo + hi) / 2 rounded down: equal means found; if the target is larger drop the left half (lo = mid + 1), else drop the right half (hi = mid − 1). Empty range means not found (−1).',
    exs: [{ in: { nums: [1, 3, 5, 7, 9], target: 7 }, out: 3 }, { in: { nums: [1, 3, 5, 7, 9], target: 4 }, out: -1 }],
    g: R => { const a = R.distinct(R.int(5, 10), 1, 30).sort((x, y) => x - y); return { nums: a, target: R.chance(0.75) ? a[R.int(0, a.length - 1)] : R.int(1, 30) }; },
    s(I, T) { const a = I.nums, x = I.target; let lo = 0, hi = a.length - 1, steps = 0; T.at({ nums: A(a) }); T.n('Starting hi index?', hi, 'The last index, n − 1.'); while (lo <= hi) { const mid = (lo + hi) >> 1; steps++; T.at({ nums: A(a, { lo, hi, win: [lo, hi] }), target: x }); T.n('mid index?', mid, `(${lo} + ${hi}) / 2 rounded down.`); const mv = a[mid] === x ? 'found' : x > a[mid] ? 'drop the left half' : 'drop the right half'; T.c(`a[mid] = ${a[mid]}, target ${x}: what next?`, ['found', 'drop the left half', 'drop the right half'], mv, `${x} vs ${a[mid]}.`); if (mv === 'found') return mid; if (x > a[mid]) lo = mid + 1; else hi = mid - 1; } return -1; }
  });
})();
