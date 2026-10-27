/* v2 games: greedy (10). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  D('fractional-knapsack-problem', {
    t: 'Fractional Knapsack',
    r: 'Fractions are allowed, so sort items by value per unit of weight, best first. Take whole items while they fit, then take the fraction of the next item that fills the bag exactly.',
    exs: [{ in: { weights: [10, 20, 30], values: [60, 100, 120], capacity: 50 }, out: 240 }],
    g: R => { const n = R.int(3, 4), w = R.ints(n, 1, 6).map(x => x * 2); return { weights: w, values: w.map(x => x * R.int(1, 6)), capacity: R.int(4, Math.max(5, w.reduce((a, b) => a + b, 0) - 2)) }; },
    s(I, T) { const idx = range(0, I.weights.length).sort((x, y) => I.values[y] / I.weights[y] - I.values[x] / I.weights[x] || x - y); let left = I.capacity, tot = 0; T.at({ weights: I.weights, values: I.values, 'value per weight': A(I.weights.map((w, i) => Math.round(I.values[i] / w * 100) / 100)) }); T.n('Index of the item taken first?', idx[0], 'Highest value per unit of weight.'); for (const i of idx) { if (left <= 0) break; const w = I.weights[i], take = Math.min(w, left), gain = I.values[i] * take / w; T.at({ item: `index ${i}: weight ${w}, value ${I.values[i]}`, 'capacity left': left, total: tot }); T.n(`How much weight of item ${i} goes in?`, take, take === w ? 'It fits whole.' : 'Only a fraction fits: fill the remaining capacity.'); tot += gain; left -= take; } T.n('Total value?', tot, 'Add the value of every piece taken.'); return tot; }
  });

  D('greedy-algorithm', {
    t: 'Greedy Coin Change',
    r: 'Greedy rule: always take the largest coin that still fits. It is optimal for coin systems like 25, 10, 5, 1, but not for every system: with coins 4, 3, 1 and amount 6, greedy takes 4 + 1 + 1 while 3 + 3 uses fewer coins.',
    exs: [{ in: { coins: [25, 10, 5, 1], amount: 36 }, out: 3 }, { in: { coins: [4, 3, 1], amount: 6 }, out: 3 }],
    g: R => R.chance(0.5) ? { coins: [25, 10, 5, 1], amount: R.int(12, 99) } : { coins: R.pick([[4, 3, 1], [5, 4, 1], [6, 4, 1], [7, 5, 1]]), amount: R.int(6, 14) },
    s(I, T) { const cs = I.coins.slice().sort((a, b) => b - a); let left = I.amount, cnt = 0; while (left > 0) { const c = cs.find(x => x <= left); T.at({ coins: A(cs), remaining: left, 'coins so far': cnt }); T.c(`Remaining ${left}: which coin does greedy take?`, cs, c, 'The largest coin that is not above the remaining amount.'); left -= c; cnt++; } const best = Array(I.amount + 1).fill(Infinity); best[0] = 0; for (let v = 1; v <= I.amount; v++) for (const c of cs) if (c <= v) best[v] = Math.min(best[v], best[v - c] + 1); T.at({ amount: I.amount, 'greedy coins': cnt }); T.n('How many coins did greedy use?', cnt, 'Count the picks.'); T.yn('Is that the fewest possible?', cnt === best[I.amount], cnt === best[I.amount] ? 'A full search finds nothing better.' : `A better mix uses ${best[I.amount]} coins.`); return cnt; }
  });

  D('labu-topic-aafb2d54c833', {
    t: 'Greedy Interval Scheduling',
    r: 'To keep the most non-overlapping intervals, sort by end time and take an interval whenever its start is at or after the end of the last one taken. Ending early leaves the most room, which an exchange argument proves.',
    exs: [{ in: { intervals: [[1, 3], [2, 4], [3, 5]] }, out: 2 }],
    g: R => { const n = R.int(4, 7), iv = []; for (let i = 0; i < n; i++) { const s = R.int(0, 9); iv.push([s, s + R.int(1, 4)]); } return { intervals: iv }; },
    s(I, T) { const iv = I.intervals.slice().sort((a, b) => a[1] - b[1] || a[0] - b[0]); let end = -Infinity, cnt = 0; T.at({ sorted: IV(iv) }); T.n('After sorting by end, which end time comes first?', iv[0][1], 'The earliest end.'); iv.forEach((x, i) => { const ok = x[0] >= end; if (i > 0) { T.at({ sorted: IV(iv, { hl: i }), 'last end': end }); T.yn(`Take [${x[0]}, ${x[1]}]?`, ok, ok ? `Start ${x[0]} at least last end ${end}.` : `Start ${x[0]} < last end ${end}: overlap.`); } if (ok) { end = x[1]; cnt++; } }); T.n('How many intervals are kept?', cnt, 'Count the takes.'); return cnt; }
  });
})();
