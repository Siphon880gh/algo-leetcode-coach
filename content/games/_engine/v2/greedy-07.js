/* v2 games: greedy (07). Guides scored in the 3483–4041 pass. */
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

  D('maximum-sum-of-edge-values-in-a-graph', {
    t: 'Maximum Sum of Edge Values in a Graph',
    r: 'With degree ≤ 2 and connected, the graph is a path or a cycle (m = n). Place n first, then each smaller value at whichever end currently holds the larger number, so big values sit beside big values. A cycle also links the two ends.',
    g: R => { const n = R.int(2, 7), p = R.perm(n), cyc = n >= 3 && R.chance(0.5), edges = []; for (let i = 0; i + 1 < n; i++) edges.push([p[i], p[i + 1]]); if (cyc) edges.push([p[n - 1], p[0]]); return { n, edges: R.shuffle(edges) }; },
    s(I, T) { const n = I.n, cyc = I.edges.length === n; T.v(GR(n, I.edges)); T.yn('Is this graph a cycle?', cyc, 'Connected with max degree 2: a cycle exactly when m = n.'); const dq = [n]; for (let v = n - 1; v >= 1; v--) { const L = dq[0], Rr = dq[dq.length - 1]; if (dq.length > 1 && L !== Rr) { T.at({ line: A(dq.slice()), next: v }); T.c(`Where does ${v} go?`, [`next to ${L}`, `next to ${Rr}`], `next to ${Math.max(L, Rr)}`, 'Put the next largest value beside the larger end to maximize its product.'); } if (L >= Rr && dq.length > 1) dq.unshift(v); else if (dq.length === 1) dq.unshift(v); else dq.push(v); } let s = 0; for (let i = 0; i + 1 < n; i++) s += dq[i] * dq[i + 1]; if (cyc) s += dq[0] * dq[n - 1]; T.at({ line: A(dq), cycle: cyc ? 'yes' : 'no' }); T.n('Total score?', s, cyc ? 'Sum adjacent products, plus the closing edge.' : 'Sum adjacent products.'); return s; }
  });

  D('find-maximum-number-of-non-intersecting-substrings', {
    t: 'Find Maximum Number of Non-Intersecting Substrings',
    r: 'Greedy: end each substring as early as possible. Remember the first position of each letter since the last cut; when a letter repeats at least 3 positions later, take that substring, cut, and clear the memory.',
    g: R => ({ word: R.str(R.int(5, 12), 'abcd') }),
    s(I, T) { const res = (() => { const w = I.word, pos = {}; let c = 0, start = 0; T.at({ word: A(w.split('')) }); T.n('Length of the word?', w.length, 'Each substring needs at least 4 letters.'); for (let i = 0; i < w.length; i++) { const ch = w[i]; if (pos[ch] !== undefined && i - pos[ch] >= 3) { c++; T.at({ word: A(w.split(''), { win: [pos[ch], i] }), cutAt: start }); T.n('Substrings taken so far?', c, `"${ch}" at ${pos[ch]} and ${i} closes a substring of length at least 4, the earliest possible end.`); for (const k in pos) delete pos[k]; start = i + 1; } else if (pos[ch] === undefined) pos[ch] = i; } if (!c) { T.at({ word: A(w.split('')) }); T.n('Substrings taken?', 0, 'No letter repeats at distance 3 or more.'); } return c; })(); T.n('Most substrings?', res, 'Greedy: always close at the earliest end.'); return res; }
  });

  D('transform-array-to-all-equal-elements', {
    t: 'Transform Array to All Equal Elements',
    r: 'Try both targets (all 1 or all −1). Scan left to right: if nums[i] is wrong, flip i and i+1 (the only way left to fix i). It works if the last element ends right and the flips fit in k.',
    g: R => ({ nums: Array.from({ length: R.int(3, 7) }, () => R.pick([1, -1])), k: R.int(1, 5) }),
    s(I, T) { let ok = false; for (const t of [1, -1]) { const a = I.nums.slice(); let ops = 0; for (let i = 0; i + 1 < a.length; i++) { const f = a[i] !== t; if (T.room()) { T.at({ nums: A(a.slice(), { i }), target: t, flips: ops }); T.yn(`Flip at index ${i}?`, f, f ? `nums[${i}] ≠ ${t}; only the pair (${i}, ${i + 1}) can still fix it.` : 'Already the target.'); } if (f) { a[i] = -a[i]; a[i + 1] = -a[i + 1]; ops++; } } if (a[a.length - 1] === t && ops <= I.k) ok = true; } return ok; }
  });

  D('minimum-adjacent-swaps-to-alternate-parity', {
    t: 'Minimum Adjacent Swaps to Alternate Parity',
    r: 'Evens and odds may differ in count by at most one. For each allowed pattern (even first or odd first), the k-th even goes to the k-th even slot; the swaps needed are Σ |current index − target index| over the evens. Take the cheaper pattern.',
    g: R => ({ nums: R.distinct(R.int(2, 7), 1, 20) }),
    s(I, T) { const a = I.nums, ev = a.map((x, i) => x % 2 ? -1 : i).filter(i => i >= 0), E = ev.length, O = a.length - E; T.at({ nums: A(a, { hl: ev }) }); T.yn('Is an alternating arrangement possible?', Math.abs(E - O) <= 1, `${E} evens vs ${O} odds.`); if (Math.abs(E - O) > 1) return -1; let best = Infinity; for (const start of [0, 1]) { if ((start === 0 && E < O) || (start === 1 && E > O)) continue; const c = sum(ev.map((p, k) => Math.abs(p - (start + 2 * k)))); T.at({ nums: A(a, { hl: ev }), evenSlots: A(ev.map((_, k) => start + 2 * k)) }); T.n(`Swaps if evens take the ${start ? 'odd' : 'even'} indices?`, c, 'Σ |even position − its target slot|.'); best = Math.min(best, c); } return best; }
  });

  D('maximum-median-sum-of-subsequences-of-size-3', {
    t: 'Maximum Median Sum of Subsequences of Size 3',
    r: 'Sort descending. Each group sacrifices one tiny element from the bottom and pairs the next two from the top; the second of those is the median. So the medians are sorted[1], sorted[3], … for n/3 groups.',
    g: R => ({ nums: R.ints(3 * R.int(1, 3), 1, 12) }),
    s(I, T) { const s = I.nums.slice().sort((a, b) => b - a), g = s.length / 3; let tot = 0; for (let i = 0; i < g; i++) { const med = s[2 * i + 1]; T.at({ sorted: A(s, { win: [2 * i, 2 * i + 1], dim: range(s.length - i, s.length) }) }); T.n(`Median of group ${i + 1}?`, med, 'Top two remaining plus the smallest remaining; the median is the second of the top two.'); tot += med; } return tot; }
  });

  D('earliest-finish-time-for-land-and-water-rides-i', {
    t: 'Earliest Finish Time for Land and Water Rides I',
    r: 'Try both orders. For land first, the best is to finish a land ride as early as possible (min start + duration), then for each water ride finish at max(that time, its start) + duration. Do the same with water first and take the smaller.',
    g: R => { const n = R.int(1, 3), m = R.int(1, 3); return { landStartTime: R.ints(n, 1, 9), landDuration: R.ints(n, 1, 6), waterStartTime: R.ints(m, 1, 9), waterDuration: R.ints(m, 1, 6) }; },
    s(I, T) { const go = (s1, d1, s2, d2, nm) => { const f = Math.min(...s1.map((s, i) => s + d1[i])); T.at({ ['first: ' + nm]: A(s1.map((s, i) => `${s}+${d1[i]}`)) }); T.n(`Earliest finish of a ${nm} ride?`, f, 'min(start + duration).'); return Math.min(...s2.map((s, i) => Math.max(f, s) + d2[i])); }; const a = go(I.landStartTime, I.landDuration, I.waterStartTime, I.waterDuration, 'land'), b = go(I.waterStartTime, I.waterDuration, I.landStartTime, I.landDuration, 'water'); T.at({ landFirst: a, waterFirst: b }); T.n('Earliest time to finish both?', Math.min(a, b), 'The better of the two orders.'); return Math.min(a, b); }
  });

  D('earliest-finish-time-for-land-and-water-rides-ii', {
    t: 'Earliest Finish Time for Land and Water Rides II',
    r: 'Finishing the first ride earlier never hurts, so for each order only the earliest first-ride finish f matters. Then each second ride ends at max(f, start) + duration; take the minimum, and the better order. O(n + m).',
    g: R => { const n = R.int(2, 4), m = R.int(2, 4); return { landStartTime: R.ints(n, 1, 12), landDuration: R.ints(n, 1, 6), waterStartTime: R.ints(m, 1, 12), waterDuration: R.ints(m, 1, 6) }; },
    s(I, T) { const go = (s1, d1, s2, d2, nm, nm2) => { const f = Math.min(...s1.map((s, i) => s + d1[i])); T.at({ [nm + ' start+dur']: A(s1.map((s, i) => s + d1[i])) }); T.n(`Earliest ${nm} finish?`, f, 'Only the earliest first finish matters.'); const ends = s2.map((s, i) => Math.max(f, s) + d2[i]); T.at({ f, [nm2 + ' start']: A(s2), [nm2 + ' dur']: A(d2) }); T.n(`Best finish of a ${nm2} ride after that?`, Math.min(...ends), 'max(f, start) + duration, minimized.'); return Math.min(...ends); }; const a = go(I.landStartTime, I.landDuration, I.waterStartTime, I.waterDuration, 'land', 'water'), b = go(I.waterStartTime, I.waterDuration, I.landStartTime, I.landDuration, 'water', 'land'); return Math.min(a, b); }
  });

  D('maximum-balanced-shipments', {
    t: 'Maximum Balanced Shipments',
    r: 'Greedy: close a shipment as soon as possible. Track the max weight since the last cut; the first parcel lighter than that max ends a balanced shipment, so count it and start fresh.',
    g: R => ({ weight: R.ints(R.int(3, 9), 1, 9) }),
    s(I, T) { let mx = 0, c = 0; I.weight.forEach((w, i) => { const close = w < mx; if (i) { T.at({ weight: A(I.weight, { i }), maxSinceCut: mx || '–', shipments: c }); T.yn(`Close a shipment at index ${i}?`, close, close ? `${w} < ${mx}: balanced, and ending early leaves the most room.` : mx ? `${w} is not below ${mx}.` : 'Nothing open yet.'); } if (close) { c++; mx = 0; } else mx = Math.max(mx, w); }); return c; }
  });

  D('maximum-total-from-optimal-activation-order', {
    t: 'Maximum Total from Optimal Activation Order',
    r: 'Elements with limit L can only be activated while fewer than L are active, and they die once L are active, so at most L of them ever count. Group by limit and take the L largest values of each group.',
    g: R => { const n = R.int(2, 7); return { value: R.ints(n, 1, 9), limit: Array.from({ length: n }, () => R.int(1, Math.min(3, n))) }; },
    s(I, T) { const by = new Map(); I.limit.forEach((l, i) => { if (!by.has(l)) by.set(l, []); by.get(l).push(I.value[i]); }); let tot = 0; [...by].sort((a, b) => a[0] - b[0]).forEach(([l, vs]) => { const s = vs.slice().sort((a, b) => b - a), t = sum(s.slice(0, l)); T.at({ limit: l, group: A(s, { win: [0, Math.min(l, s.length) - 1] }) }); T.n(`Best total from the limit-${l} group?`, t, `Take its ${l} largest value${l > 1 ? 's' : ''}.`); tot += t; }); return tot; }
  });

  D('determine-if-a-simple-graph-exists', {
    t: 'Determine if a Simple Graph Exists',
    r: 'Havel–Hakimi: the degree sum must be even. Repeatedly take the largest degree d, remove it, and subtract 1 from the next d largest. If that is impossible or a degree goes negative, no simple graph exists.',
    g: R => ({ degrees: Array.from({ length: R.int(2, 6) }, (_, i, a) => R.int(0, 3)) }),
    s(I, T) { let d = I.degrees.slice().filter(x => x >= 0); const tot = sum(d); T.at({ degrees: A(d) }); T.yn('Is the degree sum even?', tot % 2 === 0, `Sum = ${tot}; each edge adds 2.`); if (tot % 2) return false; while (true) { d.sort((a, b) => b - a); while (d.length && d[d.length - 1] === 0) d.pop(); if (!d.length) return true; const x = d.shift(); if (x > d.length) { T.at({ degrees: A([x, ...d]) }); T.yn(`Can the vertex of degree ${x} find ${x} distinct neighbors?`, false, `Only ${d.length} other vertices still need edges.`); return false; } for (let i = 0; i < x; i++) d[i]--; T.at({ took: x, rest: A(d.slice()) }); if (d.some(v => v < 0)) return false; const nx = d.length ? Math.max(...d) : 0; T.n(`After connecting degree ${x} to the next ${x} largest, what is the largest remaining degree?`, nx, 'Subtract 1 from the next d largest, then re-sort.'); } }
  });

  D('minimum-operations-to-transform-string', {
    t: 'Minimum Operations to Transform String',
    r: 'Shifting letters merges them: once the smallest non-"a" letter has been pushed up to "z" and wrapped, every bigger letter has been swept along. So the answer is 26 − (smallest non-"a" letter − "a"), or 0 if all are "a".',
    g: R => ({ s: R.str(R.int(1, 6), 'abcxyz') }),
    s(I, T) { const res = (() => { const non = I.s.split('').filter(c => c !== 'a'); T.at({ s: A(I.s.split('')) }); T.n('Letters that are not "a"?', non.length, 'They all must reach a.'); if (!non.length) { T.yn('Is the string already all "a"?', true, 'Nothing to do.'); return 0; } const m = non.sort()[0]; T.c('Which letter decides the answer?', [...new Set(I.s.split('').filter(c => c !== 'a'))].sort(), m, 'The smallest non-a letter needs the most shifts, and all larger letters join it on the way.'); const ops = 26 - (m.charCodeAt(0) - 97); T.n(`Shifts to turn "${m}" into "a"?`, ops, '26 minus its distance from a.'); return ops; })(); T.n('Fewest operations?', res, 'Shifts for the smallest non-a letter.'); return res; }
  });

  D('generate-schedule', {
    t: 'Generate Schedule',
    r: 'Each ordered pair plays once (n(n−1) days) and nobody plays two days in a row, which is impossible for n ≤ 4. For larger n, build greedily: each day pick a remaining match between two teams that did not play yesterday, preferring teams with the most matches left; restart with a different tie-break if stuck.',
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && !o.length; const n = I.n; if (!Array.isArray(o) || o.length !== n * (n - 1)) return false; const seen = new Set(); for (let i = 0; i < o.length; i++) { const [a, b] = o[i]; if (a === b || seen.has(a + ',' + b)) return false; seen.add(a + ',' + b); if (i && (o[i - 1].includes(a) || o[i - 1].includes(b))) return false; } return true; },
    g: R => ({ n: R.int(2, 6) }),
    s(I, T) { const n = I.n; T.at({ n }); T.n('How many matches must be scheduled?', n * (n - 1), 'Every ordered pair (home, away) once.'); T.yn('Is a schedule possible?', n >= 5, n >= 5 ? 'Enough teams to rest every other day.' : 'With 4 or fewer teams, consecutive days force the same two pairs forever.'); if (n < 5) return []; for (let tries = 0; tries < 200; tries++) { const left = []; for (let a = 0; a < n; a++) for (let b = 0; b < n; b++) if (a !== b) left.push([a, b]); const cnt = Array(n).fill(2 * (n - 1)), out = []; let prev = [], ok = true, seed = tries; while (left.length) { const cand = left.filter(([a, b]) => !prev.includes(a) && !prev.includes(b)); if (!cand.length) { ok = false; break; } cand.sort((x, y) => (cnt[y[0]] + cnt[y[1]]) - (cnt[x[0]] + cnt[x[1]]) || ((x[0] * 7 + x[1] * 13 + seed) % 5) - ((y[0] * 7 + y[1] * 13 + seed) % 5)); const m = cand[0]; out.push(m); left.splice(left.indexOf(m), 1); cnt[m[0]]--; cnt[m[1]]--; prev = m; } if (ok) { out.slice(0, 3).forEach((m, d) => { if (!d) return; T.at({ yesterday: out[d - 1].join(' vs '), remaining: K(cnt.map((_, t) => [t, 'team'])) }); T.yn(`Can team ${out[d - 1][0]} play on day ${d}?`, false, 'It played yesterday.'); }); return out; } } return []; }
  });

  D('maximum-total-subarray-value-ii', {
    t: 'Maximum Total Subarray Value II',
    r: 'For a fixed l, max − min of nums[l..r] only shrinks as r shrinks. Push (l, n−1) for every l into a max-heap (range max/min from a sparse table); pop the best k times, each time pushing (l, r−1).',
    g: R => { const n = R.int(2, 5); return { nums: R.ints(n, 0, 9), k: R.int(1, n * (n + 1) / 2) }; },
    s(I, T) { const a = I.nums, n = a.length, val = (l, r) => Math.max(...a.slice(l, r + 1)) - Math.min(...a.slice(l, r + 1)); let h = range(0, n).map(l => [val(l, n - 1), l, n - 1]), tot = 0; for (let t = 0; t < I.k; t++) { h.sort((x, y) => y[0] - x[0] || x[1] - y[1]); const [v, l, r] = h.shift(); tot += v; if (r > l) h.push([val(l, r - 1), l, r - 1]); if (t < 4) { T.at({ nums: A(a, { win: [l, r] }), picked: t, total: tot - v }); T.n(`Value of pick #${t + 1}?`, v, `Heap top is nums[${l}..${r}].`); } } return tot; }
  });

  D('maximum-transactions-without-negative-balance', {
    t: 'Maximum Transactions Without Negative Balance',
    r: 'Take every transaction greedily, pushing negatives into a min-heap. If the balance drops below 0, undo the most negative taken payment (the heap top). Each undo costs one transaction but restores the most money.',
    g: R => ({ transactions: R.ints(R.int(2, 7), -6, 5) }),
    s(I, T) { let bal = 0, cnt = 0; const h = []; I.transactions.forEach((x, i) => { bal += x; cnt++; if (x < 0) h.push(x); let undo = null; if (bal < 0) { h.sort((a, b) => a - b); undo = h.shift(); bal -= undo; cnt--; } if (i < 7) { T.at({ transactions: A(I.transactions, { i }), balance: bal, heap: A(h.slice().sort((a, b) => a - b)) }); T.n(`Transactions kept after index ${i}?`, cnt, undo === null ? 'Balance stays non-negative.' : `Balance went negative: drop the worst payment ${undo}.`); } }); return cnt; }
  });

  D('maximize-sum-of-squares-of-digits', {
    t: 'Maximize Sum of Squares of Digits',
    r: 'Squares reward concentration: fill digits left to right with as many 9s as possible, then the remainder, then zeros. This also gives the largest number. If sum > 9·num, there is no answer.',
    g: R => ({ num: R.int(1, 4), sum: R.int(1, 30) }),
    s(I, T) { T.at({ num: I.num, sum: I.sum }); T.yn('Is any good integer possible?', I.sum <= 9 * I.num, `At most 9 × ${I.num} = ${9 * I.num}.`); if (I.sum > 9 * I.num) return ''; let left = I.sum, out = ''; for (let i = 0; i < I.num; i++) { const d = Math.min(9, left); left -= d; if (i < 4) { T.at({ built: out || '·', left: left + d }); T.n(`Digit at position ${i}?`, d, 'Take as much as possible (up to 9).'); } out += d; } return out; }
  });

  D('minimum-operations-to-transform-array', {
    t: 'Minimum Operations to Transform Array',
    r: 'Each nums1[i] walks to nums2[i] at cost |nums1[i] − nums2[i]|. One append copies some element at a moment of our choosing: free if the last target lies between nums1[i] and nums2[i], otherwise the distance to the nearer end. Add 1 for the append.',
    g: R => { const n = R.int(1, 4); return { nums1: R.ints(n, 1, 9), nums2: R.ints(n + 1, 1, 9) }; },
    s(I, T) { const n = I.nums1.length, x = I.nums2[n]; let base = 1, extra = Infinity; I.nums1.forEach((a, i) => { const b = I.nums2[i]; base += Math.abs(a - b); const e = (x >= Math.min(a, b) && x <= Math.max(a, b)) ? 0 : Math.min(Math.abs(a - x), Math.abs(b - x)); extra = Math.min(extra, e); T.at({ nums1: A(I.nums1, { i }), nums2: A(I.nums2, { i, j: n }) }); T.n(`Extra cost to make the appended ${x} from index ${i}?`, e, e ? 'Copy at the nearer end, then adjust the copy.' : `${x} lies on the path from ${a} to ${b}: copy for free.`); }); return base + extra; }
  });

  D('maximum-calories-burnt-from-jumps', {
    t: 'Maximum Calories Burnt From Jumps',
    r: 'Sort the heights and zig-zag with two pointers: jump to the tallest first, then the shortest, then the next tallest, and so on. Every jump then spans as wide a gap as possible.',
    g: R => ({ heights: R.ints(R.int(1, 6), 1, 9) }),
    s(I, T) { const h = I.heights.slice().sort((a, b) => a - b); let l = 0, r = h.length - 1, cur = 0, tot = 0, hi = true, step = 0; while (l <= r) { const nx = hi ? h[r--] : h[l++]; tot += (cur - nx) * (cur - nx); if (step++ < 5) { T.at({ sorted: A(h, { l, r }), at: cur, total: tot - (cur - nx) * (cur - nx) }); T.n(`Height of jump #${step}'s landing block?`, nx, hi ? 'Go to the tallest block left.' : 'Go to the shortest block left.'); } cur = nx; hi = !hi; } return tot; }
  });

  D('lexicographically-smallest-negated-permutation-that-sums-to-target', {
    t: 'Lexicographically Smallest Negated Permutation That Sums to Target',
    r: 'Start from 1..n all positive (sum S). Negating a set N lowers the sum by 2·sum(N), so we need sum(N) = (S − target)/2 = D (integer, 0 ≤ D ≤ S). Greedily negate from n downwards whenever i ≤ D left; output sorted ascending.',
    g: R => { const n = R.int(1, 6), S = n * (n + 1) / 2; return { n, target: R.int(-S - 1, S + 1) }; },
    s(I, T) { const n = I.n, S = n * (n + 1) / 2; T.at({ n, target: I.target, S }); const ok = (S - I.target) % 2 === 0 && I.target <= S && I.target >= -S; T.yn('Is the target reachable?', ok, ok ? 'Same parity as S and within ±S.' : 'Wrong parity or out of range.'); if (!ok) return []; let D = (S - I.target) / 2; T.n('Total magnitude that must be negated?', D, '(S − target) / 2.'); const neg = new Set(); for (let i = n; i >= 1; i--) if (D >= i) { neg.add(i); D -= i; } const out = range(1, n + 1).map(i => neg.has(i) ? -i : i).sort((a, b) => a - b); T.at({ negated: A([...neg]) }); T.n('First element of the answer?', out[0], 'The most negative value leads.'); return out; }
  });

  D('maximum-total-sum-with-threshold-constraints', {
    t: 'Maximum Total Sum With Threshold Constraints',
    r: 'Sort indices by threshold. At step s, push every item with threshold ≤ s into a max-heap; if the heap is empty the process stops, otherwise take its largest value. The number of steps does not depend on the choices, so taking the biggest is safe.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 1, 9), threshold: R.ints(n, 1, n) }; },
    s(I, T) { const ix = range(0, I.nums.length).sort((a, b) => I.threshold[a] - I.threshold[b]); let p = 0, tot = 0; const h = []; for (let s = 1; ; s++) { while (p < ix.length && I.threshold[ix[p]] <= s) h.push(I.nums[ix[p++]]); h.sort((a, b) => b - a); T.at({ nums: A(I.nums), threshold: A(I.threshold), step: s, heap: A(h.slice()) }); if (!h.length) { T.yn(`Can step ${s} pick anything?`, false, 'No unused index has a small enough threshold: stop.'); break; } const v = h.shift(); tot += v; T.n(`Value taken at step ${s}?`, v, 'Largest available value.'); } return tot; }
  });

  D('maximize-points-after-choosing-k-tasks', {
    t: 'Maximize Points After Choosing K Tasks',
    r: 'Start by giving each task its better technique. If fewer than k use technique 1, switch the tasks with the smallest loss technique2 − technique1 (sort by that gap) until k use technique 1.',
    g: R => { const n = R.int(1, 5); return { technique1: R.ints(n, 1, 9), technique2: R.ints(n, 1, 9), k: R.int(0, n) }; },
    s(I, T) { const a = I.technique1, b = I.technique2, n = a.length; let tot = 0, c1 = 0; range(0, n).forEach(i => { tot += Math.max(a[i], b[i]); if (a[i] >= b[i]) c1++; }); T.at({ technique1: A(a), technique2: A(b), k: I.k }); T.n('Total if every task takes its better technique?', tot, 'Sum of the maximums.'); T.n('How many of those use technique 1 (ties count as 1)?', c1, 'Tasks where technique1 ≥ technique2.'); const loss = range(0, n).filter(i => a[i] < b[i]).map(i => b[i] - a[i]).sort((x, y) => x - y), need = Math.max(0, I.k - c1); const lost = sum(loss.slice(0, need)); if (need) T.n(`Points lost switching ${need} more task(s) to technique 1?`, lost, 'Switch the smallest losses first.'); return tot - lost; }
  });

  D('minimum-moves-to-balance-circular-array', {
    t: 'Minimum Moves to Balance Circular Array',
    r: 'If the total is negative it is impossible. Otherwise fill the one negative person from the nearest people first: everyone at circular distance d can give, and each unit costs d moves. Go d = 1, 2, … until the deficit is covered.',
    g: R => { const n = R.int(1, 6), a = R.ints(n, 0, 5); if (R.chance(0.85)) a[R.int(0, n - 1)] = -R.int(1, 9); return { balance: a }; },
    s(I, T) { const res = (() => { const a = I.balance, n = a.length, p = a.findIndex(x => x < 0); if (p < 0) { T.at({ balance: A(a) }); T.yn('Is anyone negative?', false, 'Already balanced.'); T.n('Moves needed?', 0, 'Nothing to do.'); return 0; } T.at({ balance: A(a, { i: p }) }); T.yn('Can everyone end up non-negative?', sum(a) >= 0, sum(a) >= 0 ? 'Enough total balance.' : 'The total is negative.'); if (sum(a) < 0) return -1; let need = -a[p], mv = 0; for (let d = 1; need > 0; d++) { const ix = [...new Set([(p + d) % n, (p - d % n + n) % n])].filter(i => i !== p), avail = sum(ix.map(i => a[i])), take = Math.min(need, avail); need -= take; mv += take * d; if (d <= 4) { T.at({ balance: A(a, { i: p, hl: ix }), deficit: need + take }); T.n(`Units taken from distance ${d}?`, take, `Each costs ${d} moves.`); } } return mv; })(); T.n('Fewest moves? (−1 if impossible)', res, 'Take from the closest neighbours first.'); return res; }
  });

  D('maximum-sum-of-three-numbers-divisible-by-three', {
    t: 'Maximum Sum of Three Numbers Divisible by Three',
    r: 'Bucket the numbers by value mod 3 and keep the three largest of each. A valid triple uses remainders (0,0,0), (1,1,1), (2,2,2) or (0,1,2); try those four and keep the best.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 12) }),
    s(I, T) { const b = [[], [], []]; I.nums.forEach(x => b[x % 3].push(x)); b.forEach(x => x.sort((p, q) => q - p)); const pat = [[0, 0, 0], [1, 1, 1], [2, 2, 2], [0, 1, 2]]; let best = 0; pat.forEach(pt => { const used = [0, 0, 0]; let s = 0, ok = true; pt.forEach(r => { if (used[r] < b[r].length) s += b[r][used[r]++]; else ok = false; }); const v = ok ? s : 0; best = Math.max(best, v); T.at({ mod0: A(b[0]), mod1: A(b[1]), mod2: A(b[2]) }); T.n(`Best sum using remainders (${pt.join(',')})? (0 if impossible)`, v, 'Take the largest values from those buckets.'); }); return best; }
  });

  D('maximum-score-after-binary-swaps', {
    t: 'Maximum Score After Binary Swaps',
    r: 'A "1" can only slide left over zeros, so the 1 at index i can claim any free spot at or before i. Sweep left to right with a max-heap of values seen so far; each time s[i] = "1", claim the largest value in the heap.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 9), s: R.str(n, '01') }; },
    s(I, T) { const h = []; let sc = 0, asks = 0; I.s.split('').forEach((ch, i) => { h.push(I.nums[i]); if (ch === '1') { h.sort((a, b) => b - a); const v = h.shift(); sc += v; if (asks++ < 5) { T.at({ nums: A(I.nums, { i }), s: A(I.s.split(''), { i }), heap: A(h.slice()) }); T.n(`Value claimed by the "1" at index ${i}?`, v, 'Largest value at or before it that is still free.'); } } }); if (!asks) { T.at({ s: A(I.s.split('')) }); T.yn('Are there any 1s?', false, 'No 1s: the score is 0.'); T.n('Score?', 0, 'Nothing contributes.'); } return sc; }
  });

  D('minimum-swaps-to-avoid-forbidden-values', {
    t: 'Minimum Swaps to Avoid Forbidden Values',
    r: 'Impossible if some value v appears in nums more often than the positions that do not forbid v. Otherwise let m be the bad positions (nums[i] = forbidden[i]) and c the largest group of bad positions sharing a value: pair up different bad values (⌈m/2⌉ swaps) unless one value dominates, giving max(⌈m/2⌉, c).',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, 1, 3), forbidden: R.ints(n, 1, 3) }; },
    s(I, T) { const a = I.nums, f = I.forbidden, n = a.length, cnt = x => a.filter(y => y === x).length, ok = [...new Set(a)].every(v => cnt(v) <= n - f.filter(y => y === v).length); T.at({ nums: A(a), forbidden: A(f) }); T.yn('Is it possible at all?', ok, ok ? 'Every value has enough allowed spots.' : 'Some value has more copies than allowed spots.'); if (!ok) return -1; const bad = range(0, n).filter(i => a[i] === f[i]), g = {}; bad.forEach(i => g[a[i]] = (g[a[i]] || 0) + 1); const c = Math.max(0, ...Object.values(g)); T.at({ nums: A(a, { hl: bad }), forbidden: A(f, { hl: bad }) }); T.n('How many positions are bad?', bad.length, 'nums[i] equals forbidden[i].'); T.n('Largest group of bad positions with the same value?', c, 'These cannot be fixed by swapping among themselves.'); return Math.max(Math.ceil(bad.length / 2), c); }
  });

  D('minimum-cost-to-acquire-required-items', {
    t: 'Minimum Cost to Acquire Required Items',
    r: 'Let k be the number of combined items. The cost k·costBoth + c1·max(0, need1 − k) + c2·max(0, need2 − k) is piecewise linear in k, so the best k is 0, min(need1, need2) or max(need1, need2).',
    g: R => ({ cost1: R.int(1, 9), cost2: R.int(1, 9), costBoth: R.int(1, 15), need1: R.int(0, 6), need2: R.int(0, 6) }),
    s(I, T) { const f = k => k * I.costBoth + I.cost1 * Math.max(0, I.need1 - k) + I.cost2 * Math.max(0, I.need2 - k), ks = [...new Set([0, Math.min(I.need1, I.need2), Math.max(I.need1, I.need2)])]; ks.forEach(k => { T.at({ cost1: I.cost1, cost2: I.cost2, costBoth: I.costBoth, need1: I.need1, need2: I.need2, combined: k }); T.n(`Total cost with ${k} combined item(s)?`, f(k), 'Combined items first, then single items for what is left.'); }); if (ks.length < 2) T.yn('Is anything needed?', false, 'Both needs are 0.'); return Math.min(...ks.map(f)); }
  });

  D('find-maximum-value-in-a-constrained-sequence', {
    t: 'Find Maximum Value in a Constrained Sequence',
    r: 'Each position has a cap (its restriction, a[0] = 0). Sweep left to right: cap[i+1] = min(cap[i+1], cap[i] + diff[i]); then right to left: cap[i] = min(cap[i], cap[i+1] + diff[i]). The tightened caps are achievable; return the largest.',
    g: R => { const n = R.int(2, 7), ix = R.shuffle(range(1, n)).slice(0, R.int(1, n - 1)); return { n, restrictions: ix.map(i => [i, R.int(1, 5)]), diff: R.ints(n - 1, 1, 4) }; },
    s(I, T) { const n = I.n, cap = Array(n).fill(Infinity); cap[0] = 0; I.restrictions.forEach(([i, v]) => cap[i] = Math.min(cap[i], v)); for (let i = 0; i < n - 1; i++) cap[i + 1] = Math.min(cap[i + 1], cap[i] + I.diff[i]); const fw = cap.slice(); for (let i = n - 2; i >= 0; i--) cap[i] = Math.min(cap[i], cap[i + 1] + I.diff[i]); T.at({ diff: A(I.diff), afterForward: A(fw) }); T.n('Largest cap after the forward pass?', Math.max(...fw), 'Each cap limited by the previous one plus diff.'); range(1, n).filter(i => fw[i] !== cap[i]).slice(0, 2).forEach(i => { T.at({ diff: A(I.diff), caps: A(cap, { i }) }); T.n(`Cap at index ${i} after the backward pass?`, cap[i], 'Also limited by the next cap plus diff.'); }); T.at({ caps: A(cap) }); T.n('Largest value in the best sequence?', Math.max(...cap), 'Maximum of the final caps.'); return Math.max(...cap); }
  });

  D('minimum-cost-to-make-two-binary-strings-equal', {
    t: 'Minimum Cost to Make Two Binary Strings Equal',
    r: 'Only mismatches matter: type A (s=0, t=1) and type B (s=1, t=0). Pair an A with a B by one swap inside s (or two flips). Two leftovers of the same type need a cross swap plus a swap (or two flips). A last odd one gets flipped.',
    g: R => { const n = R.int(1, 7); return { s: R.str(n, '01'), t: R.str(n, '01'), flipCost: R.int(1, 6), swapCost: R.int(1, 6), crossCost: R.int(1, 6) }; },
    s(I, T) { let a = 0, b = 0; for (let i = 0; i < I.s.length; i++) { if (I.s[i] === '0' && I.t[i] === '1') a++; if (I.s[i] === '1' && I.t[i] === '0') b++; } const f = I.flipCost; T.at({ s: A(I.s.split('')), t: A(I.t.split('')) }); T.n('Mismatches with s = 0 and t = 1?', a, 'Type A.'); T.n('Mismatches with s = 1 and t = 0?', b, 'Type B.'); const pairs = Math.min(a, b), r = Math.abs(a - b), c1 = pairs * Math.min(I.swapCost, 2 * f); T.at({ A: a, B: b, flip: f, swap: I.swapCost, cross: I.crossCost }); T.n('Cost to fix the mixed A–B pairs?', c1, 'Each pair: one swap or two flips, whichever is cheaper.'); return c1 + Math.floor(r / 2) * Math.min(2 * f, I.crossCost + I.swapCost) + (r % 2) * f; }
  });
})();
