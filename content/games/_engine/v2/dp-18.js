/* v2 games: dp (18). Guides scored in the 4042–4095 pass. */
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

  D('minimum-days-to-score-exactly-n-points', {
    t: 'Minimum Days to Score Exactly N Points',
    r: 'A streak of j days scores j(j + 1) divided by 2 and is followed by one skip, so it costs j + 1 days. Knapsack: f[x] = min over j of f[x − j(j + 1) divided by 2] + j + 1, with f[0] = −1 so the last streak needs no skip.',
    g: R => ({ n: R.int(3, 20) }),
    s(I, T) { const n = I.n, f = Array(n + 1).fill(Infinity), via = Array(n + 1).fill(0); f[0] = -1; for (let x = 1; x <= n; x++) for (let j = 1; j * (j + 1) / 2 <= x; j++) { const v = f[x - j * (j + 1) / 2] + j + 1; if (v < f[x]) { f[x] = v; via[x] = j; } } [...new Set([1, 2, 3, Math.min(n, 6), n])].filter(x => x <= n).forEach(x => { const j = via[x]; T.at({ f: A(f.slice(0, x)), x }); T.n(`f[${x}]: fewest days to score exactly ${x}?`, f[x], `The best last streak has length ${j}: f[${x - j * (j + 1) / 2}] + ${j + 1}.`); }); return f[n]; }
  });

  D('count-evenly-good-integers', {
    t: 'Count Evenly Good Integers',
    r: 'Answer f(r) − f(l − 1), where f(x) counts evenly good numbers in [1, x]. A digit DP walks the digits of x with state (still tight, number started, parity of even digits so far). Remember that 0 is an even digit.',
    g: R => { const l = R.int(1, 120); return { l, r: l + R.int(0, 40) }; },
    s(I, T) { const ev = x => String(x).split('').filter(d => +d % 2 === 0).length, f = x => { if (x <= 0) return 0; const D = String(x).split('').map(Number), memo = new Map(); const go = (i, tight, st, par) => { if (i === D.length) return st && par === 0 ? 1 : 0; const key = i + ',' + st + ',' + par; if (!tight && memo.has(key)) return memo.get(key); let r = 0; const hi = tight ? D[i] : 9; for (let d = 0; d <= hi; d++) { const ns = st || d > 0; r += go(i + 1, tight && d === hi, ns, ns ? par ^ (d % 2 === 0 ? 1 : 0) : par); } if (!tight) memo.set(key, r); return r; }; return go(0, true, false, 0); }; [I.l, I.r].filter((x, i, a) => a.indexOf(x) === i).forEach(x => { const e = ev(x); T.at({ l: I.l, r: I.r, x }); T.n(`How many even digits does ${x} have?`, e, 'Count the digits 0, 2, 4, 6, 8.'); T.yn(`So is ${x} evenly good?`, e % 2 === 0, e % 2 === 0 ? 'An even count (0 counts too).' : 'An odd count of even digits.'); }); const fr = f(I.r), fl = f(I.l - 1); T.at({ l: I.l, r: I.r }); T.n(`f(${I.r}): evenly good numbers in [1, ${I.r}]?`, fr, 'The digit DP over the digits of r.'); T.n(`f(${I.l - 1}): evenly good numbers in [1, ${I.l - 1}]?`, fl, 'The same DP for l − 1.'); T.n(`Evenly good numbers in [${I.l}, ${I.r}]?`, fr - fl, 'f(r) − f(l − 1).'); return fr - fl; }
  });

  D('maximize-meeting-earnings-with-idle-gaps', {
    t: 'Maximize Meeting Earnings with Idle Gaps',
    r: 'Idle pay telescopes: chaining meeting A then B earns start_B − end_A. Sort by end. For meeting i, val = revenue (start fresh) or revenue + start + the best (val − end) among meetings ending by its start. The answer is the largest val.',
    g: R => ({ meetings: Array.from({ length: R.int(2, 5) }, () => { const s = R.int(0, 10); return [s, s + R.int(1, 4), R.int(1, 6)]; }) }),
    s(I, T) { const ms = I.meetings.slice().sort((a, b) => a[1] - b[1]), pre = [-Infinity]; let ans = -Infinity; ms.forEach(([s, e, v], i) => { let j = 0; while (j < i && ms[j][1] <= s) j++; const chain = j > 0 ? v + s + pre[j] : -Infinity, val = Math.max(v, chain); T.at({ meetings: IV(ms.map(m => [m[0], m[1]]), { hl: i }), revenue: v, best: ans === -Infinity ? 'none' : ans }); T.n(`How many earlier meetings (sorted by end) end by time ${s}?`, j, 'Binary-search the end times.'); T.n(`Best total ending with meeting [${s}, ${e}) of revenue ${v}?`, val, chain > v ? `Chain after the best earlier meeting: ${v} + ${s} + max(val − end).` : 'Starting fresh is at least as good.'); pre.push(Math.max(pre[i], val - e)); ans = Math.max(ans, val); }); T.at({ meetings: IV(ms.map(m => [m[0], m[1]])), best: ans }); T.n('Maximum total earnings?', ans, 'The largest val.'); return ans; }
  });

  D('best-time-to-buy-and-sell-stock-with-cooldown-ii', {
    t: 'Best Time to Buy and Sell Stock with Cooldown II',
    r: 'The fee depends on the holding length, so choose the buy day explicitly. F[j] = the best profit with every trade closed by day j = max(F[j − 1], max over i < j of F[i − cooldown − 1] + prices[j] − prices[i] − costs[j − i]), where F of a negative day is 0.',
    g: R => { const n = R.int(3, 6); return { prices: R.ints(n, 1, 9), cooldown: R.int(0, 2), costs: R.ints(n, 0, 3) }; },
    s(I, T) { const p = I.prices, n = p.length, cd = I.cooldown, c = I.costs, F = Array(n).fill(0), get = x => x < 0 ? 0 : F[x]; for (let j = 1; j < n; j++) { let best = F[j - 1], bi = -1; for (let i = 0; i < j; i++) { const v = get(i - cd - 1) + p[j] - p[i] - c[j - i]; if (v > best) { best = v; bi = i; } } F[j] = best; if (j <= 6) { T.at({ prices: A(p, { j }), F: A(F.slice(0, j)), cooldown: cd, costs: A(c) }); T.n(`F[${j}]: best profit with every trade closed by day ${j}?`, best, bi < 0 ? `Selling on day ${j} does not beat F[${j - 1}].` : `Buy on day ${bi} and sell on day ${j}: ${bi - cd - 1 < 0 ? '0' : 'F[' + (bi - cd - 1) + ']'} + ${p[j]} − ${p[bi]} − costs[${j - bi}].`); } } T.at({ prices: A(p), F: A(F) }); T.n('Maximum total profit?', F[n - 1], 'F[n − 1].'); return F[n - 1]; }
  });

  D('maximum-alternating-subarray-sum-with-one-deletion', {
    t: 'Maximum Alternating Subarray Sum with One Deletion',
    r: 'Four states end at each index. e0 and o0 add or subtract nums[i] with nothing deleted. e1 and o1 have one deletion used, always the element just before i. e0 = nums[i] + max(0, o0 before); o0 = −nums[i] + e0 before; e1 = nums[i] + max(o1 before, o0 two back); o1 = −nums[i] + max(e1 before, e0 two back).',
    g: R => ({ nums: R.ints(R.int(2, 6), -6, 6) }),
    s(I, T) { const a = I.nums, n = a.length, NI = -Infinity, e0 = [], o0 = [], e1 = [], o1 = []; let ans = NI; for (let i = 0; i < n; i++) { e0[i] = a[i] + Math.max(0, i > 0 ? o0[i - 1] : NI); o0[i] = i > 0 ? -a[i] + e0[i - 1] : NI; e1[i] = i > 0 ? a[i] + Math.max(o1[i - 1], i >= 2 ? o0[i - 2] : NI) : NI; o1[i] = i > 0 ? -a[i] + Math.max(e1[i - 1], i >= 2 ? e0[i - 2] : NI) : NI; if (i < 4) { T.at({ nums: A(a, { i }), best: ans === NI ? 'none' : ans }); T.n(`e0[${i}]: best sum ending here with nums[${i}] added and nothing deleted?`, e0[i], 'nums[i] + max(0, o0[i − 1]): start fresh or extend.'); if (o0[i] > NI) T.n(`o0[${i}]: nums[${i}] subtracted, nothing deleted?`, o0[i], '−nums[i] + e0[i − 1].'); if (e1[i] > NI) T.n(`e1[${i}]: nums[${i}] added, one deletion used?`, e1[i], 'nums[i] + max(o1[i − 1], o0[i − 2]).'); } ans = Math.max(ans, e0[i], o0[i], e1[i], o1[i]); } T.at({ nums: A(a), best: ans }); T.n('Maximum alternating sum?', ans, 'The largest value of any state.'); return ans; }
  });

  D('prime-subset-selection-ii', {
    t: 'Prime Subset Selection II',
    r: '0-1 knapsack over the primes: suf[i][t] = the fewest primes from index i onward summing to exactly t. Take the largest reachable T at most s, then rebuild left to right, always taking the smallest prime that still finishes T with one fewer prime.',
    g: R => ({ n: R.int(5, 25), s: R.int(1, 40) }),
    s(I, T) { const ps = primesTo(I.n), m = ps.length, S = I.s, INF = 1e9, suf = Array.from({ length: m + 1 }, () => Array(S + 1).fill(INF)); suf[m][0] = 0; for (let i = m - 1; i >= 0; i--) for (let t = 0; t <= S; t++) { suf[i][t] = suf[i + 1][t]; if (t >= ps[i] && suf[i + 1][t - ps[i]] + 1 < suf[i][t]) suf[i][t] = suf[i + 1][t - ps[i]] + 1; } let Tt = 0; for (let t = S; t >= 0; t--) if (suf[0][t] < INF) { Tt = t; break; } T.at({ primes: A(ps), s: S }); T.n(`Largest sum at most ${S} that some set of primes reaches?`, Tt, 'Scan t down from s until suf[0][t] is finite.'); if (Tt === 0) return []; let c = suf[0][Tt], t = Tt, k = 0; T.n(`Fewest primes that sum to ${Tt}?`, c, 'suf[0][T].'); const out = []; while (c > 0) { let pick = -1; for (let q = k; q < m; q++) if (t >= ps[q] && suf[q + 1][t - ps[q]] === c - 1) { pick = q; break; } T.at({ primes: A(ps, { from: k }), picked: A(out.slice()), remaining: t }); T.c(`Next prime to take (remaining ${t}, ${c} left to pick)?`, ps.slice(k).filter(p => p <= t).slice(0, 4).concat([ps[pick]]), ps[pick], 'Take the smallest prime that still lets the rest finish with one fewer prime.'); out.push(ps[pick]); t -= ps[pick]; c--; k = pick + 1; } return out; }
  });
})();
