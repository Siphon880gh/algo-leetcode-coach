/* v2 games: greedy (09). Guides scored in the 4042–4095 pass. */
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

  D('lexicographically-largest-power-array', {
    t: 'Lexicographically Largest Power Array',
    r: 'Go from bit 14 down to bit 0 with an ordered list of blocks. Blocks that have the bit in every number pass whole. At the first block missing it, count the numbers that have it, split that block into [with] then [without], and stop. That count is power for this bit.',
    g: R => ({ nums: R.ints(R.int(2, 5), 0, 15) }),
    s(I, T) { let blocks = [I.nums.slice()]; const pw = []; for (let b = 14; b >= 0; b--) { let tot = 0, stop = false; const nb = []; for (const bl of blocks) { if (stop) { nb.push(bl); continue; } const w = bl.filter(x => x >> b & 1), wo = bl.filter(x => !(x >> b & 1)); if (!wo.length) { tot += bl.length; nb.push(bl); } else { tot += w.length; if (w.length) nb.push(w); nb.push(wo); stop = true; } } if (b <= 3) { T.at({ nums: A(I.nums.map(x => x.toString(2).padStart(4, '0'))), blocks: X(blocks.map(x => '[' + x.join(', ') + ']').join('  '), 'blocks (in order)'), bit: b }); T.n(`power[${14 - b}]: the longest prefix where every number has bit ${b}?`, tot, 'Pass full blocks, then count the numbers with the bit in the first mixed block.'); } blocks = nb; pw.push(tot); } return pw; }
  });

  D('prime-subset-selection-i', {
    t: 'Prime Subset Selection I',
    r: 'To fit the most primes under s, take the smallest ones first. Walk the primes up to n in increasing order and stop at the first one that no longer fits; every later prime is bigger.',
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== e.length) return false; const ps = new Set(primesTo(I.n)); let t = 0; for (let i = 0; i < o.length; i++) { if (!ps.has(o[i]) || (i && o[i] <= o[i - 1])) return false; t += o[i]; } return t <= I.s; },
    g: R => ({ n: R.int(5, 30), s: R.int(1, 60) }),
    s(I, T) { const ps = primesTo(I.n), out = []; let left = I.s; T.at({ primes: A(ps), budget: left }); T.n(`How many primes are ≤ ${I.n}?`, ps.length, 'Sieve them.'); for (let i = 0; i < ps.length; i++) { const p = ps[i], fit = p <= left; T.at({ primes: A(ps, { i }), picked: A(out.slice()), budget: left }); T.yn(`Does ${p} fit in the remaining budget ${left}?`, fit, fit ? `${p} ≤ ${left}: take it.` : `${p} > ${left}: stop, every later prime is bigger.`); if (!fit) break; out.push(p); left -= p; } return out; }
  });

  D('minimum-deletions-to-make-array-sharp', {
    t: 'Minimum Deletions to Make Array Sharp',
    r: 'a XOR b is 0 exactly when a = b, so sharp means no two equal neighbours. Scan once: an element equal to the last kept one must go, and anything else is kept.',
    g: R => ({ nums: R.ints(R.int(3, 9), 1, 3) }),
    s(I, T) { const a = I.nums, kept = [a[0]]; let last = a[0], del = 0; for (let i = 1; i < a.length; i++) { const d = a[i] === last; if (i < 10) { T.at({ nums: A(a, { i }), kept: A(kept.slice()), deleted: del }); T.yn(`Delete nums[${i}] = ${a[i]}?`, d, d ? `It equals the last kept ${last}, so the XOR would be 0.` : `It differs from ${last}, so the XOR is non-zero: keep it.`); } if (d) del++; else { kept.push(a[i]); last = a[i]; } } T.at({ nums: A(a), kept: A(kept) }); T.n('Minimum deletions?', del, 'Count the deleted copies.'); return del; }
  });

  D('minimum-interval-selection-to-cover-target-intervals', {
    t: 'Minimum Interval Selection to Cover Target Intervals',
    r: 'Sort both lists by start and keep cur, how far the picks reach. For each target, while cur < its end: the first uncovered point is u = max(start, cur); among intervals starting at or before u, pick the one reaching farthest. If it does not cover u or move past cur, a gap remains.',
    g: R => { const mk = (c, w) => Array.from({ length: c }, () => { const s = R.int(1, 12); return [s, s + R.int(0, w)]; }); return { availableIntervals: mk(R.int(2, 5), 5), targetIntervals: mk(R.int(1, 3), 3) }; },
    s(I, T) { const av = I.availableIntervals.slice().sort((a, b) => a[0] - b[0] || a[1] - b[1]), tg = I.targetIntervals.slice().sort((a, b) => a[0] - b[0] || a[1] - b[1]); let cur = 0, i = 0, nxt = 0, cnt = 0; for (const [l, r] of tg) { while (cur < r) { const u = Math.max(l, cur); while (i < av.length && av[i][0] <= u) { nxt = Math.max(nxt, av[i][1]); i++; } const fail = nxt < u || nxt === cur; T.at({ available: IV(av), targets: IV(tg), reach: cur, firstUncovered: u, picked: cnt }); T.n(`Farthest end among intervals starting at or before ${u}?`, nxt, 'Of everything that can cover the first uncovered point, take the one reaching farthest.'); T.yn('Is there a gap nothing can cover?', fail, fail ? (nxt < u ? `No interval covers point ${u}.` : `No interval extends past ${cur}.`) : `Pick it and extend the reach to ${nxt}.`); if (fail) return -1; cur = nxt; cnt++; } } T.at({ available: IV(av), targets: IV(tg), reach: cur, picked: cnt }); T.n('Minimum intervals selected?', cnt, 'One pick per greedy extension.'); return cnt; }
  });

  D('maximum-subarray-sum-of-fixed-length-after-at-most-k-swaps', {
    t: 'Maximum Subarray Sum of Fixed Length After At Most K Swaps',
    r: 'Fix the window. Each useful swap trades one inside value for one outside value, so sort the inside ascending and the outside descending, then trade while outside[j] − inside[j] is positive, up to k trades. Try every window.',
    g: R => { const n = R.int(3, 7); return { nums: R.ints(n, -5, 9), length: R.int(1, n - 1), k: R.int(0, 3) }; },
    s(I, T) { const a = I.nums, n = a.length, L = I.length; let best = -Infinity; for (let i = 0; i + L <= n; i++) { const ins = a.slice(i, i + L).sort((x, y) => x - y), out = a.slice(0, i).concat(a.slice(i + L)).sort((x, y) => y - x); let s = sum(ins), sw = 0; const base = s; for (let j = 0; j < Math.min(I.k, ins.length, out.length); j++) { const g = out[j] - ins[j]; if (g <= 0) break; s += g; sw++; } if (i < 4) { T.at({ nums: A(a, { win: [i, i + L - 1] }), k: I.k, best: best === -Infinity ? 'none' : best }); T.n(`Window sum at start ${i} before swaps?`, base, 'Add the window.'); T.n(`Best window sum at start ${i} after up to ${I.k} swaps?`, s, sw ? `Trade the ${sw} smallest inside values for the largest outside ones while it helps.` : 'No trade gains anything here.'); } best = Math.max(best, s); } T.at({ nums: A(a), best }); T.n('Maximum sum?', best, 'The best over every window.'); return best; }
  });

  D('maximize-sum-after-at-most-k-digit-rearrangements', {
    t: 'Maximize Sum After At Most K Digit Rearrangements',
    r: 'The best rearrangement of a number sorts its digits in descending order. Compute each element\'s gain (best rearrangement − value), then spend the k operations on the k biggest gains.',
    g: R => { const n = R.int(2, 5); return { nums: R.ints(n, 1, 999), k: R.int(1, n) }; },
    s(I, T) { const big = x => +String(x).split('').sort((p, q) => q - p).join(''), gains = I.nums.map(x => big(x) - x); I.nums.forEach((x, i) => { if (i < 5) { T.at({ nums: A(I.nums, { i }), gains: A(gains.slice(0, i)) }); T.n(`Largest number from the digits of ${x}?`, big(x), 'Sort its digits in descending order.'); } }); const take = sum(gains.slice().sort((p, q) => q - p).slice(0, I.k)), tot = sum(I.nums); T.at({ nums: A(I.nums), gains: A(gains), k: I.k }); T.n(`Total gain from the ${I.k} biggest gains?`, take, 'Sort the gains and take the top k.'); T.n('Maximum possible sum?', tot + take, `The original sum ${tot} plus the gain.`); return tot + take; }
  });
})();
