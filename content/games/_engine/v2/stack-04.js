/* v2 games: stack (04). Guides scored in the 4042–4095 pass. */
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

  D('count-robot-groups', {
    t: 'Count Robot Groups',
    r: 'A group always moves like its rightmost robot, so scan from the right: each robot only cares about the group ahead, whose leader can only jump forward. A robot that never closes the gap to at most distance leads a group of its own.',
    g: R => { const n = R.int(3, 6); return { position: R.distinct(n, 1, 20).sort((x, y) => x - y), speed: R.ints(n, 1, 5), distance: R.int(1, 3) }; },
    s(I, T) { const p = I.position, v = I.speed, d = I.distance, n = p.length, join = Array(n).fill(null); let L = range(0, n), now = [0, 1]; const less = (x, y) => x[0] * y[1] < y[0] * x[1]; for (let guard = 0; guard <= n; guard++) { const close = (a, b) => (p[b] - p[a]) * now[1] + (v[b] - v[a]) * now[0] <= d * now[1], merged = new Set(); for (let i = 0; i + 1 < L.length; i++) if (close(L[i], L[i + 1])) { merged.add(L[i]); join[L[i]] = now.slice(); } L = L.filter(x => !merged.has(x)); let nx = null; for (let i = 0; i + 1 < L.length; i++) { const a = L[i], b = L[i + 1]; if (v[a] > v[b]) { const t = [p[b] - p[a] - d, v[a] - v[b]]; if (!nx || less(t, nx)) nx = t; } } if (!nx) break; now = nx; } const fr = f => { const g = (x, y) => y ? g(y, x % y) : x, k = g(Math.abs(f[0]), f[1]) || 1; return f[1] / k === 1 ? String(f[0] / k) : `${f[0] / k}/${f[1] / k}`; }; for (let i = n - 1; i >= 0 && n - 1 - i < 6; i--) { T.at({ position: A(p, { i }), speed: A(v, { i }), distance: d }); const j = join[i]; T.yn(`Does robot ${i} ever join the group ahead of it?`, j !== null, i === n - 1 ? 'Nothing is ahead of the rightmost robot.' : j !== null ? `It closes the gap to ${d} at t = ${fr(j)}.` : 'It never gets within distance of the group ahead, which moves like its leader.'); if (j !== null) T.n(`At what time does robot ${i} join?`, j[0] / j[1], 'The gap shrinks by (its speed − the leader\'s speed) per second until it is at most distance.'); } T.at({ position: A(p), speed: A(v), distance: d }); T.n('How many groups remain?', L.length, 'Robots that never join anyone ahead each lead a group.'); return L.length; }
  });
})();
