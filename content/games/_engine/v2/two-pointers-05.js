/* v2 games: two-pointers (5). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  D('max-capacity-problem', {
    t: 'Max Capacity (Container With Most Water)',
    r: 'Start with L at the left end and R at the right end. Area = min(h[L], h[R]) × (R − L). Move the shorter side inward: the shorter wall caps every container that keeps it, so no pair using it can do better. Track the best area.',
    exs: [{ in: { height: [1, 8, 6, 2, 5, 4, 8, 3, 7] }, out: 49 }],
    g: R => ({ height: R.ints(R.int(5, 8), 1, 9) }),
    s(I, T) { const h = I.height; let L = 0, Rr = h.length - 1, best = 0; while (L < Rr) { const ar = Math.min(h[L], h[Rr]) * (Rr - L); T.at({ height: A(h, { L, R: Rr, bars: true }), best }); T.n(`Area with L = ${L}, R = ${Rr}?`, ar, `min(${h[L]}, ${h[Rr]}) × ${Rr - L}.`); best = Math.max(best, ar); const mv = h[L] < h[Rr] ? 'move L' : 'move R'; if (Rr - L > 1) T.c('Which pointer moves?', ['move L', 'move R'], mv, h[L] === h[Rr] ? 'Equal heights: either works; this solution moves R.' : 'Move the shorter wall.'); if (mv === 'move L') L++; else Rr--; } return best; }
  });

  D('labu-topic-9f5ff4d1cb1f', {
    t: 'Two Pointers: Opposite Ends',
    r: 'On a sorted array, put L at the left end and R at the right end. If a[L] + a[R] is too big, R moves left; if too small, L moves right; if equal, done. Each move throws out one value that cannot be in any answer.',
    exs: [{ in: { nums: [1, 2, 4, 7], target: 6 }, out: [1, 2] }, { in: { nums: [1, 2], target: 9 }, out: [-1, -1] }],
    g: R => { const a = R.distinct(R.int(5, 8), 1, 20).sort((x, y) => x - y), i = R.int(0, a.length - 2), j = R.int(i + 1, a.length - 1); return { nums: a, target: R.chance(0.85) ? a[i] + a[j] : R.int(3, 40) }; },
    s(I, T) { const a = I.nums, t = I.target; let L = 0, Rr = a.length - 1, n = 0; T.at({ nums: A(a), target: t }); T.n('Starting index of R?', Rr, 'The last index, n − 1.'); while (L < Rr) { const s = a[L] + a[Rr]; T.at({ nums: A(a, { L, R: Rr }), target: t }); if (n < 6) T.n('Current sum?', s, `${a[L]} + ${a[Rr]}.`); const mv = s === t ? 'found' : s > t ? 'R moves left' : 'L moves right'; T.c('What next?', ['found', 'R moves left', 'L moves right'], mv, s === t ? 'The sum matches.' : s > t ? 'Too big: drop the largest.' : 'Too small: drop the smallest.'); n++; if (s === t) return [L, Rr]; if (s > t) Rr--; else L++; } return [-1, -1]; }
  });
})();
