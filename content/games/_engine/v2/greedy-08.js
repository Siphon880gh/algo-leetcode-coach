/* v2 games: greedy (08). Guides scored in the 3483–4041 pass. */
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

  D('maximum-bitwise-xor-after-rearrangement', {
    t: 'Maximum Bitwise XOR After Rearrangement',
    r: 'Count the 1s and 0s of t. Go left to right through s: to make this bit 1 we need the opposite bit from t; use it if any is left, otherwise take what remains (making a 0).',
    g: R => { const n = R.int(1, 7); return { s: R.str(n, '01'), t: R.str(n, '01') }; },
    s(I, T) { let ones = I.t.split('').filter(c => c === '1').length, zeros = I.t.length - ones, out = ''; I.s.split('').forEach((c, i) => { const want = c === '0' ? '1' : '0', have = want === '1' ? ones > 0 : zeros > 0, use = have ? want : c; if (use === '1') ones--; else zeros--; out += c === use ? '0' : '1'; if (i < 6) { T.at({ s: A(I.s.split(''), { i }), onesLeft: ones + (use === '1' ? 1 : 0), zerosLeft: zeros + (use === '0' ? 1 : 0), result: out.slice(0, -1) || '·' }); T.c(`Which bit of t goes at position ${i}?`, ['0', '1'], use, have ? `It differs from s[${i}] = ${c}, making a 1.` : 'None of the opposite bit left.'); } }); return out; }
  });

  D('minimum-operations-to-make-array-parity-alternating', {
    t: 'Minimum Operations to Make Array Parity Alternating',
    r: 'There are two parity patterns (start even or start odd). Each element with the wrong parity costs exactly 1 and can move to x − 1 or x + 1. Pick the patterns with the fewest changes, then choose each ±1 to make max − min as small as possible.',
    g: R => ({ nums: R.ints(R.int(1, 6), -4, 6) }),
    s(I, T) { const a = I.nums, n = a.length, md = x => ((x % 2) + 2) % 2; let bestOps = Infinity, bestRange = Infinity; [0, 1].forEach(p => { const bad = range(0, n).filter(i => md(a[i]) !== (p + i) % 2); T.at({ nums: A(a, { hl: bad }), pattern: p ? 'odd first' : 'even first' }); T.n(`Changes needed if index 0 is ${p ? 'odd' : 'even'}?`, bad.length, 'Count elements with the wrong parity.'); if (bad.length > bestOps) return; let rg = Infinity; for (let m = 0; m < 1 << bad.length; m++) { const b = a.slice(); bad.forEach((i, t) => b[i] += m >> t & 1 ? 1 : -1); rg = Math.min(rg, Math.max(...b) - Math.min(...b)); } if (bad.length < bestOps) { bestOps = bad.length; bestRange = rg; } else bestRange = Math.min(bestRange, rg); }); T.at({ nums: A(a), changes: bestOps }); T.n('Smallest max − min using that many changes?', bestRange, 'Choose +1 or −1 for each changed element to keep the spread tight.'); return [bestOps, bestRange]; }
  });

  D('minimum-cost-to-equalize-arrays-using-swaps', {
    t: 'Minimum Cost to Equalize Arrays Using Swaps',
    r: 'Inside an array, order is free, so only counts matter. Every value must appear an even number of times overall. nums1 must give away (c1 − c2) divided by 2 copies of each surplus value, and one paid cross swap moves one surplus copy out while bringing a needed one in: the answer is the total surplus.',
    g: R => { const n = R.int(2, 5); return { nums1: R.ints(n, 1, 3), nums2: R.ints(n, 1, 3) }; },
    s(I, T) { const c = new Map(); I.nums1.forEach(x => { if (!c.has(x)) c.set(x, [0, 0]); c.get(x)[0]++; }); I.nums2.forEach(x => { if (!c.has(x)) c.set(x, [0, 0]); c.get(x)[1]++; }); const ok = [...c.values()].every(([p, q]) => (p + q) % 2 === 0); T.at({ nums1: A(I.nums1), nums2: A(I.nums2), counts: K([...c].sort((a, b) => a[0] - b[0]).map(([v, [p, q]]) => [v, `${p} | ${q}`])) }); T.yn('Does every value appear an even number of times in total?', ok, ok ? 'Each array can get half.' : 'An odd total can never be split evenly: −1.'); if (!ok) return -1; let s = 0; [...c].sort((a, b) => a[0] - b[0]).forEach(([v, [p, q]]) => { const sur = Math.max(0, (p - q) / 2); s += sur; T.at({ value: v, inNums1: p, inNums2: q }); T.n(`Copies of ${v} nums1 must send over?`, sur, `It keeps half of ${p + q}.`); }); return s; }
  });

  D('minimum-operations-to-make-array-non-decreasing', {
    t: 'Minimum Operations to Make Array Non-Decreasing',
    r: 'Each drop nums[i−1] − nums[i] > 0 must be paid for: raising the suffix from i by exactly that amount fixes it and never breaks earlier pairs. The answer is the sum of all drops.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { let s = 0; for (let i = 1; i < I.nums.length; i++) { const d = Math.max(0, I.nums[i - 1] - I.nums[i]); s += d; if (i < 7) { T.at({ nums: A(I.nums, { i }), total: s - d }); T.n(`Cost paid at index ${i}?`, d, d ? 'A drop: raise everything from here.' : 'No drop.'); } } if (I.nums.length === 1) { T.at({ nums: A(I.nums) }); T.n('Cost?', 0, 'One element is sorted.'); } return s; }
  });

  D('lexicographically-maximum-mex-array', {
    t: 'Lexicographically Maximum MEX Array',
    r: 'The first value can be at most the MEX of everything left, so cut the shortest prefix that reaches it, which leaves the most behind for later. When the remaining MEX is 0, every cut gives 0 and a longer result wins, so cut one element at a time.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 3) }),
    s(I, T) { const a = I.nums, out = []; let i = 0; const mex = arr => { let m = 0; const s = new Set(arr); while (s.has(m)) m++; return m; }; while (i < a.length) { const target = mex(a.slice(i)); let j = i; if (target > 0) { const s = new Set(); let m = 0; while (m < target) { s.add(a[j]); while (s.has(m)) m++; j++; } } else j = i + 1; if (out.length < 4) { T.at({ nums: A(a, { win: [i, a.length - 1] }), result: A(out.slice()) }); T.n('MEX of everything that is left?', target, 'The most the next value can be.'); T.n('Length of the shortest prefix that reaches it?', j - i, target ? 'Stop as soon as every value below the target has appeared.' : 'MEX 0: take one element so more zeros follow.'); } out.push(target); i = j; } return out; }
  });

  D('maximum-total-value-of-covered-indices', {
    t: 'Maximum Total Value of Covered Indices',
    r: 'Each token covers either its own index or the one before it. Sweep left to right with a DP whose state says whether the current index is already covered by the token to its right moving left; at each token choose stay or move, and never count a cell twice.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 1, 9), s: R.str(n, '01') }; },
    s(I, T) { const tok = range(0, I.s.length).filter(i => I.s[i] === '1' && true), best = t => { let b = 0; const ts = tok.filter(i => i <= t); for (let m = 0; m < 1 << ts.length; m++) { const cov = new Set(ts.map((i, j) => (m >> j & 1) && i > 0 ? i - 1 : i)); b = Math.max(b, sum([...cov].map(i => I.nums[i]))); } return b; }; T.at({ nums: A(I.nums), tokens: A(I.s.split('')) }); T.n('How many tokens are there?', tok.length, 'Each covers one cell.'); tok.slice(0, 4).forEach(t => { T.at({ nums: A(I.nums, { i: t }), tokens: A(I.s.split(''), { i: t }) }); T.n(`Best total using only the tokens up to index ${t}?`, best(t), 'Stay or step left, whichever adds more without double-covering.'); }); return best(I.s.length - 1); }
  });

  D('maximize-sum-of-device-ratings', {
    t: 'Maximize Sum of Device Ratings',
    r: 'Adding a unit never raises a device\'s minimum, and removing helps only if you remove the minimum unit. So each device either keeps its rating, or donates its minimum unit (rating rises to its second-smallest) and the gift lowers the receiver to min(rating, gift). Choose which devices donate and where each gift lands to maximise the total.',
    g: R => ({ units: R.grid(R.int(1, 3), R.int(1, 3), 1, 6) }),
    s(I, T) { const U = I.units, m = U.length, opts = range(0, m).map(i => [null].concat(m > 1 ? U[i].flatMap((_, j) => range(0, m).filter(t => t !== i).map(t => [j, t])) : [])); let best = -Infinity; const go = (i, ch) => { if (i === m) { const dev = U.map(r => r.slice()); ch.forEach((c, d) => { if (c) dev[d].splice(c[0], 1); }); ch.forEach((c, d) => { if (c) dev[c[1]].push(U[d][c[0]]); }); best = Math.max(best, sum(dev.map(r => r.length ? Math.min(...r) : 0))); return; } opts[i].forEach(o => go(i + 1, ch.concat([o]))); }; go(0, []); const base = sum(U.map(r => Math.min(...r))); T.at({ units: G(U) }); T.n('Total rating with no operations?', base, 'Each device rates at its minimum.'); const s0 = U[0].slice().sort((x, y) => x - y); T.n('Device 0\'s rating after it gives away its smallest unit?', s0.length > 1 ? s0[1] : 0, 'Its second-smallest becomes the minimum (empty means 0).'); T.yn('Can adding a unit ever raise a device\'s rating?', false, 'The minimum can only stay or drop.'); return best; }
  });

  D('minimum-lights-to-illuminate-a-road', {
    t: 'Minimum Lights to Illuminate a Road',
    r: 'Mark what the existing bulbs light with a difference array. Then sweep: at the first dark position i, put a new bulb at i + 1 (covering i to i + 2) and jump to i + 3.',
    g: R => ({ lights: Array.from({ length: R.int(1, 9) }, () => R.chance(0.25) ? R.int(1, 2) : 0) }),
    s(I, T) { const L = I.lights, n = L.length, d = Array(n + 1).fill(0); L.forEach((v, i) => { if (v) { d[Math.max(0, i - v)]++; d[Math.min(n - 1, i + v) + 1]--; } }); const lit = []; let run = 0; for (let i = 0; i < n; i++) { run += d[i]; lit.push(run > 0 ? 1 : 0); } T.at({ lights: A(L), lit: A(lit) }); T.n('How many positions are dark before adding bulbs?', lit.filter(x => !x).length, 'Difference array over each bulb\'s range.'); let c = 0, i = 0, asks = 0; while (i < n) { if (lit[i]) { i++; continue; } c++; if (asks++ < 4) { T.at({ lit: A(lit, { i }) }); T.n('Where should the next bulb go?', Math.min(i + 1, n - 1), 'One past the first dark spot, to reach as far right as possible.'); } i += 3; } return c; }
  });

  D('maximum-total-value', {
    t: 'Maximum Total Value',
    r: 'Each index offers a decreasing sequence value, value − decay, …. Taking the m largest terms overall is optimal (stop at negatives). Binary search the cutoff value v such that at least m terms are at least v, add the arithmetic sums of the terms above it, and fill the rest with v.',
    g: R => { const n = R.int(1, 3); return { value: R.ints(n, 1, 9), decay: R.ints(n, 1, 4), m: R.int(1, 6) }; },
    s(I, T) { const n = I.value.length, t = Array(n).fill(0); let tot = 0; for (let p = 0; p < I.m; p++) { let bi = -1, bv = 0; for (let i = 0; i < n; i++) { const g = I.value[i] - I.decay[i] * t[i]; if (g > bv) { bv = g; bi = i; } } if (bi < 0) { T.at({ value: A(I.value), decay: A(I.decay), taken: A(t.slice()) }); T.yn('Is any positive gain left?', false, 'Stop: further picks only lose value.'); break; } if (p < 5) { T.at({ value: A(I.value), decay: A(I.decay), taken: A(t.slice()) }); T.n(`Gain of pick ${p + 1}?`, bv, 'The largest next term across all indices.'); } t[bi]++; tot += bv; } return tot % MOD; }
  });

  D('maximum-total-sum-of-k-selected-elements', {
    t: 'Maximum Total Sum of K Selected Elements',
    r: 'Pick the k largest elements and process them biggest first, so the biggest values meet the biggest multipliers. For each, add x times mul while mul > 1, otherwise just add x.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 1, 9), k: R.int(1, n), mul: R.int(1, 4) }; },
    s(I, T) { const s = I.nums.slice().sort((a, b) => b - a).slice(0, I.k); let m = I.mul, tot = 0; s.forEach((x, i) => { const g = x * Math.max(m, 1); if (i < 5) { T.at({ chosen: A(s, { i }), mul: m, total: tot }); T.n(`Gain from ${x} with mul = ${m}?`, g, m > 1 ? 'Multiply: mul beats 1.' : 'Just add it: mul is not more than 1.'); } tot += g; m--; }); return tot; }
  });

  D('minimum-operations-to-transform-binary-string', {
    t: 'Minimum Operations to Transform Binary String',
    r: 'Sweep left to right with a small DP: positions that must become 0 have to be cleared in adjacent "11" pairs, possibly after first setting a neighbour to 1 (and setting it back if it must end as 1). Track whether the previous position is still waiting to be paired.',
    g: R => { const n = R.int(1, 5); return { s1: R.str(n, '01'), s2: R.str(n, '01') }; },
    s(I, T) { const n = I.s1.length, seen = new Map([[I.s1, 0]]), q = [I.s1]; while (q.length) { const s = q.shift(), d = seen.get(s); const nx = []; for (let i = 0; i < n; i++) if (s[i] === '0') nx.push(s.slice(0, i) + '1' + s.slice(i + 1)); for (let i = 0; i + 1 < n; i++) if (s[i] === '1' && s[i + 1] === '1') nx.push(s.slice(0, i) + '00' + s.slice(i + 2)); nx.forEach(t => { if (!seen.has(t)) { seen.set(t, d + 1); q.push(t); } }); } const down = range(0, n).filter(i => I.s1[i] === '1' && I.s2[i] === '0').length, up = range(0, n).filter(i => I.s1[i] === '0' && I.s2[i] === '1').length, ans = seen.has(I.s2) ? seen.get(I.s2) : -1; T.at({ s1: A(I.s1.split('')), s2: A(I.s2.split('')) }); T.n('How many positions must go from 1 to 0?', down, 'Only pair-clears can do that.'); T.n('How many positions must go from 0 to 1?', up, 'One set each, at least.'); T.yn('Is the transformation possible?', ans >= 0, n === 1 ? 'A single cell can never be cleared.' : 'With a neighbour you can always set it, then clear the pair.'); return ans; }
  });

  D('largest-integer-with-given-digit-sum', {
    t: 'Largest Integer With Given Digit Sum',
    r: 'Use all n digits and put the largest digits first: each position takes min(9, what is left). If 9n < s it is impossible; leading zeros vanish only when s = 0.',
    g: R => ({ n: R.int(1, 4), s: R.int(0, 30) }),
    s(I, T) { T.at({ n: I.n, s: I.s }); T.yn('Is it possible?', I.s <= 9 * I.n, `At most 9 times ${I.n} = ${9 * I.n}.`); if (I.s > 9 * I.n) return -1; let left = I.s, d = ''; for (let i = 0; i < I.n; i++) { const x = Math.min(9, left); if (i < 4) { T.at({ built: d || '(empty)', left }); T.n(`Digit at position ${i}?`, x, 'As large as possible, front first.'); } d += x; left -= x; } return Number(d); }
  });

  D('minimum-initial-strength-to-defeat-all-monsters', {
    t: 'Minimum Initial Strength to Defeat All Monsters',
    r: 'Bonuses come from a difference array. Work backwards: need[i] = the strength you must have before monster i = max(monster − bonus, monster + need[i+1]) clamped at at least 0, since strength left after a fight is max(0, s − monster). Or binary search the start strength and simulate.',
    g: R => { const n = R.int(1, 5); return { monsters: R.ints(n, 1, 12), boosts: Array.from({ length: R.int(0, 2) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1), R.int(1, 8)]; }) }; },
    s(I, T) { const n = I.monsters.length, d = Array(n + 1).fill(0); I.boosts.forEach(([l, r, v]) => { d[l] += v; d[r + 1] -= v; }); const bonus = []; let run = 0; for (let i = 0; i < n; i++) { run += d[i]; bonus.push(run); } T.at({ monsters: A(I.monsters), bonus: A(bonus) }); T.n('Total bonus over all monsters?', sum(bonus), 'Difference array over the boost ranges.'); const sim = s => { for (let i = 0; i < n; i++) { if (s + bonus[i] < I.monsters[i]) return false; s = Math.max(0, s - I.monsters[i]); } return true; }; let lo = 0, hi = sum(I.monsters), asks = 0; while (lo < hi) { const m = lo + hi >> 1, ok = sim(m); if (asks++ < 3) { T.at({ monsters: A(I.monsters), bonus: A(bonus), try: m }); T.yn(`Does starting strength ${m} beat every monster?`, ok, 'Simulate left to right.'); } if (ok) hi = m; else lo = m + 1; } return lo; }
  });

  D('minimum-total-price-after-applying-discounts', {
    t: 'Minimum Total Price After Applying Discounts',
    r: 'A discount d saves p times d divided by 100, so pair the biggest discounts with the most expensive items: sort both descending and match them in order until one list runs out.',
    g: R => ({ prices: R.ints(R.int(1, 4), 1, 50), discounts: R.ints(R.int(1, 4), 1, 100) }),
    cmp: (a, b) => Math.abs(a - b) < 1e-5,
    s(I, T) { const p = I.prices.slice().sort((x, y) => y - x), d = I.discounts.slice().sort((x, y) => y - x); let tot = 0; p.forEach((x, i) => { const f = i < d.length ? x * (100 - d[i]) / 100 : x; if (i < 4) { T.at({ prices: A(p, { i }), discounts: A(d, i < d.length ? { i } : {}) }); T.n(`Final price of the item costing ${x}?`, f, i < d.length ? `Gets the ${i + 1}-th biggest discount, ${d[i]}%.` : 'No discount left.'); } tot += f; }); return tot; }
  });

  D('maximum-gap-between-stations', {
    t: 'Maximum Gap Between Stations',
    r: 'early[i] = the leftmost station worker i can take when everyone before is placed greedily from the left; late[i] = the rightmost when everyone after is placed greedily from the right. The biggest gap is max over i of late[i] − early[i − 1].',
    g: R => { const n = R.int(1, 3), st = R.str(R.int(n, 7), 'ab'); const idx = R.distinct(n, 0, st.length - 1).sort((a, b) => a - b); return { skill: idx.map(i => st[i]).join(''), station: st }; },
    s(I, T) { const s = I.skill, t = I.station, n = s.length, m = t.length, e = [], l = Array(n); for (let i = 0, j = 0; i < n; i++, j++) { while (t[j] !== s[i]) j++; e.push(j); } for (let i = n - 1, j = m - 1; i >= 0; i--, j--) { while (t[j] !== s[i]) j--; l[i] = j; } T.at({ skill: A(s.split('')), station: A(t.split('')), early: A(e) }); T.n('Earliest station for the last worker?', e[n - 1], 'Greedy match from the left.'); T.at({ skill: A(s.split('')), station: A(t.split('')), late: A(l) }); T.n('Latest station for the first worker?', l[0], 'Greedy match from the right.'); let best = 0; for (let i = 1; i < n; i++) best = Math.max(best, l[i] - e[i - 1]); T.n('Maximum gap?', best, n > 1 ? 'Best of late[i] − early[i − 1].' : 'One worker: gap 0.'); return best; }
  });
})();
