/* v2 games: design (05). Guides scored in the 3483–4041 pass. */
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

  D('design-spreadsheet', {
    t: 'Design Spreadsheet',
    r: 'Store only the cells that were set, in a hash map keyed by names like "A1". getValue splits "=X+Y" at the plus: a side that starts with a digit is a number, anything else is a cell lookup that defaults to 0.',
    g: R => { const cells = ['A1', 'A2', 'B1', 'B2', 'C3']; return seq(R, 'Spreadsheet', [3], R.int(4, 8), R => { const c = R.pick(['setCell', 'setCell', 'resetCell', 'getValue', 'getValue']); if (c === 'setCell') return [c, [R.pick(cells), R.int(1, 20)]]; if (c === 'resetCell') return [c, [R.pick(cells)]]; const t = () => R.chance(0.65) ? R.pick(cells) : String(R.int(0, 9)); return [c, ['=' + t() + '+' + t()]]; }); },
    s(I, T) { return play(I, T, () => { const m = {}; const v = x => /^\d/.test(x) ? +x : (m[x] || 0); return { m, setCell(c, x) { m[c] = x; }, resetCell(c) { delete m[c]; }, getValue(f) { const [a, b] = f.slice(1).split('+'); return v(a) + v(b); } }; }, { view: o => ({ cells: K(Object.assign({}, o.m)) }), why: () => 'Numbers count as themselves; a cell reads the map, and a never-set or reset cell is 0.' }); }
  });

  D('implement-router', {
    t: 'Implement Router',
    r: 'Keep packets in a FIFO queue plus a set of (source, destination, timestamp) keys. A duplicate add returns false; a full router drops its oldest packet first. forwardPacket pops the oldest. getCount counts queued packets for one destination with timestamp in [start, end].',
    g: R => { let t = 90; const pk = []; return seq(R, 'Router', [R.int(2, 3)], R.int(5, 9), R => { const c = R.pick(['addPacket', 'addPacket', 'addPacket', 'forwardPacket', 'getCount']); if (c === 'addPacket') { if (pk.length && R.chance(0.25)) return [c, R.pick(pk).slice()]; t += R.int(0, 5); const p = [R.int(1, 3), R.int(4, 5), t]; pk.push(p); return [c, p]; } if (c === 'forwardPacket') return [c, []]; const a = R.int(88, t), b = a + R.int(0, 8); return [c, [R.int(4, 5), a, b]]; }); },
    s(I, T) { return play(I, T, lim => { const q = [], keys = new Set(); return { q, addPacket(s, d, t) { const k = s + ',' + d + ',' + t; if (keys.has(k)) return false; if (q.length === lim) { const o = q.shift(); keys.delete(o.join(',')); } q.push([s, d, t]); keys.add(k); return true; }, forwardPacket() { if (!q.length) return []; const o = q.shift(); keys.delete(o.join(',')); return o; }, getCount(d, a, b) { return q.filter(p => p[1] === d && p[2] >= a && p[2] <= b).length; } }; }, { view: o => ({ queue: Q(o.q.map(p => p.join('/')), 'queue (src, dst, time)') }), arrOpts: (o, r) => [o.q[o.q.length - 1] || [], o.q[0] || [], []].filter(x => JSON.stringify(x) !== JSON.stringify(r)).slice(0, 2), why: op => ({ addPacket: 'False only for an exact duplicate still in the router; a full router evicts the oldest first.', forwardPacket: 'FIFO: the oldest queued packet leaves.', getCount: 'Only packets still queued, matching destination, timestamp inside the range.' }[op]) }); }
  });

  D('design-exam-scores-tracker', {
    t: 'Design Exam Scores Tracker',
    r: 'Times arrive in increasing order, so append (time, running total) pairs. totalScore(a, b) is prefix(at most b) − prefix(< a), each found by binary search on the times.',
    g: R => { const ops = ['ExamTracker'], args = [[]]; let t = 0; for (let i = 0; i < R.int(3, 7); i++) { if (!t || R.chance(0.5)) { t += R.int(1, 4); ops.push('record'); args.push([t, R.int(1, 9)]); } else { const a = R.int(1, t), b = R.int(a, t); ops.push('totalScore'); args.push([a, b]); } } if (ops[ops.length - 1] !== 'totalScore') { ops.push('totalScore'); args.push([1, t]); } return { ops, args }; },
    s(I, T) { return play(I, T, () => { const ts = [], pre = [0]; const ub = x => { let lo = 0, hi = ts.length; while (lo < hi) { const m = lo + hi >> 1; if (ts[m] <= x) lo = m + 1; else hi = m; } return lo; }; return { ts, pre, record(t, s) { ts.push(t); pre.push(pre[pre.length - 1] + s); }, totalScore(a, b) { return pre[ub(b)] - pre[ub(a - 1)]; } }; }, { view: o => ({ times: A(o.ts.slice()), prefix: A(o.pre.slice()) }), why: () => 'Binary-search both ends of the time range and subtract prefix sums.' }); }
  });

  D('design-auction-system', {
    t: 'Design Auction System',
    r: 'Keep a map from (user, item) to amount, and per item a max-heap of (amount, userId). Updates push a new entry; stale heap tops (not matching the current map) are popped lazily when asked for the highest bidder.',
    g: R => { const ops = ['AuctionSystem'], args = [[]], bids = new Map(); for (let i = 0; i < R.int(4, 8); i++) { const keys = [...bids.keys()], c = R.int(0, 9); if (c < 4 || !keys.length) { const u = R.int(1, 3), it = R.int(1, 2), a = R.int(1, 9); ops.push('addBid'); args.push([u, it, a]); bids.set(u + ',' + it, a); } else if (c < 6) { const k = R.pick(keys), [u, it] = k.split(',').map(Number), a = R.int(1, 9); ops.push('updateBid'); args.push([u, it, a]); bids.set(k, a); } else if (c < 7) { const k = R.pick(keys), [u, it] = k.split(',').map(Number); ops.push('removeBid'); args.push([u, it]); bids.delete(k); } else { ops.push('getHighestBidder'); args.push([R.int(1, 2)]); } } ops.push('getHighestBidder'); args.push([1]); return { ops, args }; },
    s(I, T) { return play(I, T, () => { const m = new Map(); const best = it => { let bu = -1, ba = -1; for (const [k, a] of m) { const [u, i] = k.split(',').map(Number); if (i === it && (a > ba || (a === ba && u > bu))) { ba = a; bu = u; } } return bu; }; return { m, addBid(u, i, a) { m.set(u + ',' + i, a); }, updateBid(u, i, a) { m.set(u + ',' + i, a); }, removeBid(u, i) { m.delete(u + ',' + i); }, getHighestBidder: best }; }, { view: o => ({ bids: K([...o.m].map(([k, a]) => ['user,item ' + k, a])) }), why: () => 'Highest amount wins; ties go to the larger userId; no bids means −1.' }); }
  });

  D('design-order-management-system', {
    t: 'Design Order Management System',
    r: 'Store orderId to (type, price) and an index from (type, price) to a set of orderIds. Modify moves the id between index sets, cancel removes it, and a lookup returns the set for that key.',
    cmp: (o, e) => Array.isArray(o) && o.length === e.length && o.every((x, i) => JSON.stringify(Array.isArray(x) ? x.slice().sort((a, b) => a - b) : x) === JSON.stringify(Array.isArray(e[i]) ? e[i].slice().sort((a, b) => a - b) : e[i])),
    g: R => { const ops = ['OrderManagementSystem'], args = [[]], live = new Map(); let id = 1; for (let i = 0; i < R.int(4, 8); i++) { const ids = [...live.keys()], c = R.int(0, 9); if (c < 4 || !ids.length) { const t = R.pick(['buy', 'sell']), p = R.int(1, 3); ops.push('addOrder'); args.push([id, t, p]); live.set(id++, [t, p]); } else if (c < 6) { const k = R.pick(ids), p = R.int(1, 3); ops.push('modifyOrder'); args.push([k, p]); live.get(k)[1] = p; } else if (c < 7) { const k = R.pick(ids); ops.push('cancelOrder'); args.push([k]); live.delete(k); } else { ops.push('getOrdersAtPrice'); args.push([R.pick(['buy', 'sell']), R.int(1, 3)]); } } ops.push('getOrdersAtPrice'); args.push(['buy', 1]); return { ops, args }; },
    s(I, T) { return play(I, T, () => { const o = new Map(); return { o, addOrder(id, t, p) { o.set(id, [t, p]); }, modifyOrder(id, p) { o.get(id)[1] = p; }, cancelOrder(id) { o.delete(id); }, getOrdersAtPrice(t, p) { return [...o].filter(([, v]) => v[0] === t && v[1] === p).map(([k]) => k).sort((a, b) => b - a); } }; }, { view: x => ({ orders: K([...x.o].map(([k, v]) => [k, v.join(' @ ')])) }), why: () => 'Only active orders with exactly that type and price.' }); }
  });

  D('design-ride-sharing-system', {
    t: 'Design Ride Sharing System',
    r: 'Two FIFO queues, one for riders and one for drivers, plus a set of cancelled riders. A match pops the earliest driver and the earliest rider that is not cancelled (skip cancelled riders lazily).',
    g: R => { const ops = ['RideSharingSystem'], args = [[]]; let rid = 1, did = 1; const waiting = []; for (let i = 0; i < R.int(4, 8); i++) { const c = R.int(0, 9); if (c < 3) { ops.push('addRider'); args.push([rid]); waiting.push(rid++); } else if (c < 6) { ops.push('addDriver'); args.push([did++]); } else if (c < 7 && waiting.length) { ops.push('cancelRider'); args.push([R.pick(waiting)]); } else { ops.push('matchDriverWithRider'); args.push([]); } } ops.push('matchDriverWithRider'); args.push([]); return { ops, args }; },
    s(I, T) { return play(I, T, () => { const r = [], d = [], gone = new Set(); return { r, d, addRider(x) { r.push(x); }, addDriver(x) { d.push(x); }, cancelRider(x) { gone.add(x); const i = r.indexOf(x); if (i >= 0) r.splice(i, 1); }, matchDriverWithRider() { if (!r.length || !d.length) return [-1, -1]; return [d.shift(), r.shift()]; } }; }, { view: o => ({ riders: Q(o.r.slice(), 'riders'), drivers: Q(o.d.slice(), 'drivers') }), arrOpts: (o, res) => [[-1, -1], [o.r[0] || -1, o.d[0] || -1], [(o.d[1] || -1), (o.r[0] || -1)]].filter(x => JSON.stringify(x) !== JSON.stringify(res)).slice(0, 2), why: () => 'Earliest driver with earliest waiting rider; [-1, -1] if either queue is empty.' }); }
  });

  D('design-event-manager', {
    t: 'Design Event Manager',
    r: 'Keep eventId to current priority and a max-heap of (priority, −eventId). updatePriority pushes a fresh entry; pollHighest pops entries until it finds one that is still active with its current priority (lazy deletion).',
    g: R => { const ids = R.distinct(R.int(1, 4), 1, 9), ev = ids.map(i => [i, R.int(1, 5)]), ops = ['EventManager'], args = [[ev]], live = new Set(ids); for (let i = 0; i < R.int(3, 6); i++) { if (live.size && R.chance(0.35)) { const k = R.pick([...live]); ops.push('updatePriority'); args.push([k, R.int(1, 5)]); } else { ops.push('pollHighest'); args.push([]); } } ops.push('pollHighest'); args.push([]); return { ops, args }; },
    s(I, T) { return play(I, T, ev => { const m = new Map(ev.map(([i, p]) => [i, p])); return { m, updatePriority(i, p) { if (m.has(i)) m.set(i, p); }, pollHighest() { let bi = -1, bp = -1; for (const [i, p] of m) if (p > bp || (p === bp && i < bi)) { bi = i; bp = p; } if (bi >= 0) m.delete(bi); return bi; } }; }, { view: o => ({ active: K([...o.m].sort((a, b) => a[0] - b[0])) }), why: () => 'Highest priority wins; ties go to the smaller eventId; −1 when empty.' }); }
  });
})();
