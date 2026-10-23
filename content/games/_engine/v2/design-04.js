/* v2 games: design (04). */
(function () {
  'use strict';
  const { D, A, G, K, S, Q, Tr, TR, GR } = LCGame.H;
  const fmt = a => typeof a === 'string' ? JSON.stringify(a) : Array.isArray(a) ? JSON.stringify(a) : String(a);
  // Run a design problem: ops[0] constructs, the rest are method calls. Asks about returned values.
  const play = (I, T, make, o) => { o = o || {}; const obj = make(...(I.args[0] || [])), out = [null]; let asks = 0; const max = o.max || 7; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], args = I.args[i] || [], before = o.view ? o.view(obj) : {}; let r = obj[op](...args); if (r === undefined) r = null; out.push(r); if (asks >= max || r === null || (o.skip && o.skip(op))) continue; const label = `${op}(${args.map(fmt).join(', ')})`, why = o.why ? o.why(op, args, r, obj) : 'Follow the structure\'s invariant.'; if (typeof r === 'number' && Number.isFinite(r)) { T.at(Object.assign({ call: label }, before)); T.n(`What does ${label} return?`, r, why); asks++; } else if (typeof r === 'boolean') { T.at(Object.assign({ call: label }, before)); T.yn(`Does ${label} return true?`, r, why); asks++; } else if (typeof r === 'string') { const opts = [...new Set([r, ...(o.strOpts ? o.strOpts(obj, r) : []), r === '' ? 'null' : ''])].slice(0, 4); if (opts.length > 1) { T.at(Object.assign({ call: label }, before)); T.c(`What does ${label} return?`, opts.map(x => x === '' ? '""' : x), r === '' ? '""' : r, why); asks++; } } else if (Array.isArray(r)) { T.at(Object.assign({ call: label }, before)); T.n(`How many items does ${label} return?`, r.length, why); asks++; } } if (!asks) { T.at({ calls: I.ops.length - 1 }); T.n('How many method calls follow the constructor?', I.ops.length - 1, 'Count the operations.'); } return out; };
  // Build a random op sequence: step(R, st) returns [op, args] or null to stop.
  const seq = (R, ctor, ctorArgs, n, step, st) => { const ops = [ctor], args = [ctorArgs]; st = st || {}; for (let i = 0; i < n; i++) { const x = step(R, st); if (!x) break; ops.push(x[0]); args.push(x[1]); } return { ops, args }; };
  const rngOf = I => { let h = 2166136261; const s = JSON.stringify(I); for (let i = 0; i < s.length; i++) h = Math.imul(h ^ s.charCodeAt(i), 16777619) >>> 0; return () => { h = (h + 0x6D2B79F5) >>> 0; let t = h; t = Math.imul(t ^ (t >>> 15), t | 1); t ^= t + Math.imul(t ^ (t >>> 7), t | 61); return ((t ^ (t >>> 14)) >>> 0) / 4294967296; }; };
  const DIRS = ['East', 'North', 'West', 'South'];

  D('detect-squares', {
    t: 'Detect Squares',
    r: 'Count points with multiplicity. For count(q), treat each stored point p with |dx| = |dy| ≠ 0 as the opposite corner; it contributes cnt[p] · cnt[(q.x, p.y)] · cnt[(p.x, q.y)].',
    g: R => seq(R, 'DetectSquares', [], R.int(4, 12), R => [R.chance(0.65) ? 'add' : 'count', [[R.int(0, 3), R.int(0, 3)]]]),
    s(I, T) { return play(I, T, () => { const c = new Map(), k = (x, y) => x + ',' + y; return { c, add([x, y]) { c.set(k(x, y), (c.get(k(x, y)) || 0) + 1); }, count([x, y]) { let s = 0; for (const [key, n] of c) { const [px, py] = key.split(',').map(Number); if (Math.abs(px - x) !== Math.abs(py - y) || px === x) continue; s += n * (c.get(k(x, py)) || 0) * (c.get(k(px, y)) || 0); } return s; } }; }, { view: o => ({ points: K(Object.fromEntries(o.c)) }), why: () => 'Sum over diagonal corners of the product of the three corner counts.' }); }
  });

  D('stock-price-fluctuation', {
    t: 'Stock Price Fluctuation',
    r: 'Map timestamp → price (updates overwrite) and track the latest timestamp. maximum/minimum come from a heap with lazy deletion of stale (price, time) entries, or a sorted multiset of prices.',
    g: R => seq(R, 'StockPrice', [], R.int(3, 10), (R, st) => { st.n = st.n || 0; if (!st.n || R.chance(0.55)) { st.n++; return ['update', [R.int(1, 5), R.int(1, 20)]]; } return [R.pick(['current', 'maximum', 'minimum']), []]; }),
    s(I, T) { return play(I, T, () => { const m = new Map(); return { m, update(t, p) { m.set(t, p); }, current() { return m.get(Math.max(...m.keys())); }, maximum() { return Math.max(...m.values()); }, minimum() { return Math.min(...m.values()); } }; }, { view: o => ({ prices: K(Object.fromEntries([...o.m].sort((a, b) => a[0] - b[0]))) }), why: op => ({ current: 'Price at the latest timestamp.', maximum: 'Largest current price.', minimum: 'Smallest current price.' }[op]) }); }
  });

  D('simple-bank-system', {
    t: 'Simple Bank System',
    r: 'Accounts are 1-indexed. Every operation first validates account numbers (1..n) and, for withdraw/transfer, that the balance covers the amount; only then does it change balances.',
    g: R => { const b = R.ints(R.int(1, 4), 0, 50); return seq(R, 'Bank', [b], R.int(2, 7), R => { const a = () => R.int(1, b.length + 1); const c = R.pick(['transfer', 'deposit', 'withdraw']); return c === 'transfer' ? [c, [a(), a(), R.int(1, 40)]] : [c, [a(), R.int(1, 40)]]; }); },
    s(I, T) { return play(I, T, b0 => { const b = b0.slice(), ok = i => i >= 1 && i <= b.length; return { b, transfer(x, y, m) { if (!ok(x) || !ok(y) || b[x - 1] < m) return false; b[x - 1] -= m; b[y - 1] += m; return true; }, deposit(x, m) { if (!ok(x)) return false; b[x - 1] += m; return true; }, withdraw(x, m) { if (!ok(x) || b[x - 1] < m) return false; b[x - 1] -= m; return true; } }; }, { view: o => ({ balances: A(o.b.slice()) }), why: () => 'Valid account(s) and enough money?' }); }
  });

  D('walking-robot-simulation-ii', {
    t: 'Walking Robot Simulation II',
    r: 'The robot only ever walks the border loop of length 2(w + h) − 4, so reduce num modulo it. Watch the corner case: after a full loop it stands at (0, 0) facing South, not East.',
    g: R => { const w = R.int(2, 4), h = R.int(2, 4); return seq(R, 'Robot', [w, h], R.int(2, 7), R => R.chance(0.5) ? ['step', [R.int(1, 12)]] : [R.pick(['getPos', 'getDir']), []]); },
    s(I, T) { const [w, h] = I.args[0], P = 2 * (w + h) - 4, V = [[1, 0], [0, 1], [-1, 0], [0, -1]]; return play(I, T, () => { let x = 0, y = 0, d = 0; return { get x() { return x; }, get y() { return y; }, get d() { return d; }, step(num) { let k = num % P || P; while (k--) { for (;;) { const nx = x + V[d][0], ny = y + V[d][1]; if (nx >= 0 && ny >= 0 && nx < w && ny < h) { x = nx; y = ny; break; } d = (d + 1) % 4; } } }, getPos() { return [x, y]; }, getDir() { return DIRS[d]; } }; }, { view: o => ({ grid: G(Array.from({ length: h }, (_, r) => Array.from({ length: w }, (_, c) => c === o.x && h - 1 - r === o.y ? '🤖' : '·'))), facing: DIRS[o.d] }), strOpts: () => DIRS, why: op => op === 'getDir' ? 'Turn counterclockwise whenever the next cell is outside.' : 'Position after walking the border.' }); }
  });

  D('range-frequency-queries', {
    t: 'Range Frequency Queries',
    r: 'For each value keep its sorted list of indices. query(l, r, v) = (first index > r) − (first index ≥ l) in that list, via two binary searches.',
    g: R => { const a = R.ints(R.int(1, 10), 1, 4); return seq(R, 'RangeFreqQuery', [a], R.int(1, 5), R => { const l = R.int(0, a.length - 1); return ['query', [l, R.int(l, a.length - 1), R.int(1, 4)]]; }); },
    s(I, T) { const a = I.args[0][0]; return play(I, T, () => ({ query(l, r, v) { let c = 0; for (let i = l; i <= r; i++) if (a[i] === v) c++; return c; } }), { view: () => ({ arr: A(a), positions: K(Object.fromEntries([...new Set(a)].sort((x, y) => x - y).map(v => [v, a.map((x, i) => x === v ? i : -1).filter(i => i >= 0).join(',')]))) }), why: (op, [l, r, v]) => `Indices of ${v} within [${l}, ${r}].` }); }
  });

  D('sequentially-ordinal-rank-tracker', {
    t: 'Sequentially Ordinal Rank Tracker',
    r: 'Rank locations by score desc, then name asc. get() returns the i-th best, where i is the number of get calls so far. Two heaps (top-i and the rest) keep the boundary in O(log n).',
    g: R => seq(R, 'SORTracker', [], R.int(3, 10), (R, st) => { st.a = st.a || 0; st.g = st.g || 0; if (st.g < st.a && R.chance(0.45)) { st.g++; return ['get', []]; } st.a++; return ['add', [R.pick(['alps', 'bay', 'cove', 'dune', 'elm', 'fjord']) + R.int(1, 3), R.int(1, 4)]]; }),
    s(I, T) { return play(I, T, () => { const L = []; let i = 0; return { L, get i() { return i; }, add(n, s) { L.push([n, s]); L.sort((a, b) => b[1] - a[1] || (a[0] < b[0] ? -1 : 1)); }, get() { return L[i++][0]; } }; }, { view: o => ({ ranked: A(o.L.map(([n, s]) => `${n}(${s})`), { next: o.i }) }), strOpts: o => o.L.map(x => x[0]), why: () => 'The i-th best: higher score, then smaller name.' }); }
  });

  D('design-bitset', {
    t: 'Design Bitset',
    r: 'Store the bits, a count of ones and a "flipped" flag. flip just toggles the flag and sets count = size − count; fix/unfix read bits through the flag.',
    g: R => { const n = R.int(1, 6); return seq(R, 'Bitset', [n], R.int(3, 10), R => { const c = R.pick(['fix', 'fix', 'unfix', 'flip', 'all', 'one', 'count', 'toString']); return c === 'fix' || c === 'unfix' ? [c, [R.int(0, n - 1)]] : [c, []]; }); },
    s(I, T) { return play(I, T, n => { const b = Array(n).fill(0); return { b, fix(i) { b[i] = 1; }, unfix(i) { b[i] = 0; }, flip() { for (let i = 0; i < n; i++) b[i] ^= 1; }, all() { return b.every(x => x); }, one() { return b.some(x => x); }, count() { return b.filter(x => x).length; }, toString() { return b.join(''); } }; }, { view: o => ({ bits: A(o.b.slice()) }), strOpts: (o, r) => [r.split('').map(c => c === '1' ? '0' : '1').join(''), r.split('').reverse().join('')], why: op => ({ all: 'Every bit 1?', one: 'Any bit 1?', count: 'Number of ones.', toString: 'Bits in index order.' }[op]) }); }
  });

  D('encrypt-and-decrypt-strings', {
    t: 'Encrypt and Decrypt Strings',
    r: 'Encrypt maps each character to its two-letter value ("" if a character has no key). For decrypt, pre-encrypt every dictionary word and count how many encryptions equal the input.',
    g: R => { const keys = ['a', 'b', 'c'], vals = keys.map(() => R.pick(['xy', 'zz', 'xy', 'qq'])), dict = Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 3), 'abc')); return seq(R, 'Encrypter', [keys, vals, dict], R.int(1, 4), R => R.chance(0.5) ? ['encrypt', [R.str(R.int(1, 3), 'abcd')]] : ['decrypt', [Array.from({ length: R.int(1, 3) }, () => R.pick(['xy', 'zz', 'qq'])).join('')]]); },
    s(I, T) { const [k, v, d] = I.args[0], m = new Map(k.map((c, i) => [c, v[i]])); const enc = w => [...w].every(c => m.has(c)) ? [...w].map(c => m.get(c)).join('') : ''; return play(I, T, () => ({ encrypt: enc, decrypt(w) { return d.filter(x => enc(x) === w).length; } }), { view: () => ({ map: K(Object.fromEntries(m)), dictionary: A(d) }), strOpts: (o, r) => [r.slice(2), r + 'xy'], why: op => op === 'encrypt' ? 'Concatenate each character\'s value ("" if any is unmapped).' : 'Dictionary words whose encryption matches.' }); }
  });

  D('design-an-atm-machine', {
    t: 'Design an ATM Machine',
    r: 'Banknotes 20, 50, 100, 200, 500. withdraw goes greedily from the largest note, taking min(count, ⌊remaining / note⌋). If something remains the request fails ([-1]) and nothing is taken.',
    g: R => seq(R, 'ATM', [], R.int(2, 7), (R, st) => { st.d = st.d || 0; if (!st.d || R.chance(0.5)) { st.d = 1; return ['deposit', [R.ints(5, 0, 2)]]; } return ['withdraw', [R.pick([20, 40, 60, 70, 100, 120, 150, 250, 300, 550, 600, 1000])]]; }),
    s(I, T) { const N = [20, 50, 100, 200, 500]; return play(I, T, () => { const c = [0, 0, 0, 0, 0]; return { c, deposit(a) { a.forEach((x, i) => c[i] += x); }, withdraw(amt) { const t = [0, 0, 0, 0, 0]; for (let i = 4; i >= 0; i--) { t[i] = Math.min(c[i], Math.floor(amt / N[i])); amt -= t[i] * N[i]; } if (amt) return [-1]; t.forEach((x, i) => c[i] -= x); return t; } }; }, { view: o => ({ notes: K(Object.fromEntries(N.map((n, i) => ['$' + n, o.c[i]]))) }), why: () => 'Greedy from the largest note; [-1] (length 1) if it cannot finish, otherwise 5 counts.' }); }
  });

  D('design-video-sharing-platform', {
    t: 'Design Video Sharing Platform',
    r: 'upload takes the smallest free id (a min-heap of removed ids, else a counter). watch returns video[start..min(end, len − 1)] and counts a view; operations on a missing id return "-1" / [-1] / −1 or do nothing.',
    g: R => seq(R, 'VideoSharingPlatform', [], R.int(3, 10), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['upload', 'remove', 'watch', 'like', 'dislike', 'getLikesAndDislikes', 'getViews']) : 'upload'; if (c === 'upload') { st.n++; return [c, [R.str(R.int(1, 5), '0123456789')]]; } const id = R.int(0, st.n); if (c === 'watch') { const s = R.int(0, 3); return [c, [id, s, s + R.int(0, 4)]]; } return [c, [id]]; }),
    s(I, T) { return play(I, T, () => { const v = new Map(), free = []; let next = 0; return { v, upload(s) { let id; if (free.length) { free.sort((a, b) => a - b); id = free.shift(); } else id = next++; v.set(id, { s, l: 0, d: 0, w: 0 }); return id; }, remove(id) { if (v.delete(id)) free.push(id); }, watch(id, a, b) { const x = v.get(id); if (!x) return '-1'; x.w++; return x.s.slice(a, Math.min(b, x.s.length - 1) + 1); }, like(id) { const x = v.get(id); if (x) x.l++; }, dislike(id) { const x = v.get(id); if (x) x.d++; }, getLikesAndDislikes(id) { const x = v.get(id); return x ? [x.l, x.d] : [-1]; }, getViews(id) { const x = v.get(id); return x ? x.w : -1; } }; }, { view: o => ({ videos: K(Object.fromEntries([...o.v].map(([id, x]) => [id, `"${x.s}" 👍${x.l} 👎${x.d} 👁${x.w}`]))) }), strOpts: (o, r) => ['-1', r.slice(1), r + '0'], why: op => ({ upload: 'Smallest unused id.', watch: 'Substring start..min(end, len−1), or "-1".', getViews: 'Views, or −1 if missing.', getLikesAndDislikes: '[likes, dislikes] or [-1].' }[op]) }); }
  });

  D('count-integers-in-intervals', {
    t: 'Count Integers in Intervals',
    r: 'Keep disjoint intervals in a sorted map plus the total covered count. add(l, r) merges every overlapping interval into one, subtracting their sizes and adding the merged size.',
    g: R => seq(R, 'CountIntervals', [], R.int(2, 8), R => { if (R.chance(0.35)) return ['count', []]; const l = R.int(1, 15); return ['add', [l, l + R.int(0, 5)]]; }),
    s(I, T) { return play(I, T, () => { let iv = []; return { get iv() { return iv; }, add(l, r) { const out = []; for (const [a, b] of iv) { if (b < l - 1 || a > r + 1) out.push([a, b]); else { l = Math.min(l, a); r = Math.max(r, b); } } out.push([l, r]); iv = out.sort((x, y) => x[0] - y[0]); }, count() { return iv.reduce((s, [a, b]) => s + b - a + 1, 0); } }; }, { view: o => ({ intervals: A(o.iv.map(([a, b]) => `[${a},${b}]`)) }), why: () => 'Total integers covered by the merged intervals.' }); }
  });

  D('booking-concert-tickets-in-groups', {
    t: 'Booking Concert Tickets in Groups',
    r: 'Seats in each row fill left to right, so track used[r]. gather finds the first row ≤ maxRow with m − used ≥ k (segment tree of max free). scatter succeeds if total free in rows 0..maxRow ≥ k, then fills from the lowest rows.',
    g: R => { const n = R.int(1, 4), m = R.int(2, 5); return seq(R, 'BookMyShow', [n, m], R.int(2, 8), R => [R.pick(['gather', 'scatter']), [R.int(1, m + 1), R.int(0, n - 1)]]); },
    s(I, T) { return play(I, T, (n, m) => { const u = Array(n).fill(0); return { u, gather(k, mr) { for (let r = 0; r <= mr; r++) if (m - u[r] >= k) { const c = u[r]; u[r] += k; return [r, c]; } return []; }, scatter(k, mr) { let f = 0; for (let r = 0; r <= mr; r++) f += m - u[r]; if (f < k) return false; for (let r = 0; r <= mr && k; r++) { const t = Math.min(k, m - u[r]); u[r] += t; k -= t; } return true; } }; }, { view: o => ({ seatsUsed: A(o.u.slice()), perRow: I.args[0][1] }), why: op => op === 'gather' ? 'First row with k free consecutive seats → [row, seat], else [].' : 'Enough free seats in rows 0..maxRow?' }); }
  });

  D('design-a-text-editor', {
    t: 'Design a Text Editor',
    r: 'Two stacks: text left of the cursor and text right of it (reversed). addText pushes left; deleteText pops left; moving the cursor shifts characters between stacks. Cursor moves return the last min(10, len) characters on the left.',
    g: R => seq(R, 'TextEditor', [], R.int(3, 9), R => R.pick([['addText', [R.str(R.int(1, 6), 'abcde')]], ['deleteText', [R.int(1, 4)]], ['cursorLeft', [R.int(1, 6)]], ['cursorRight', [R.int(1, 6)]]])),
    s(I, T) { return play(I, T, () => { let L = '', Rt = ''; return { get L() { return L; }, get Rt() { return Rt; }, addText(s) { L += s; }, deleteText(k) { const d = Math.min(k, L.length); L = L.slice(0, L.length - d); return d; }, cursorLeft(k) { const d = Math.min(k, L.length); Rt = L.slice(L.length - d) + Rt; L = L.slice(0, L.length - d); return L.slice(-10); }, cursorRight(k) { const d = Math.min(k, Rt.length); L += Rt.slice(0, d); Rt = Rt.slice(d); return L.slice(-10); } }; }, { view: o => ({ text: (o.L + '|' + o.Rt) }), strOpts: (o, r) => [o.L.slice(-9), (o.L + o.Rt).slice(-10)], why: op => op === 'deleteText' ? 'Characters actually deleted (≤ left length).' : 'Last ≤ 10 characters left of the cursor.' }); }
  });

  D('smallest-number-in-infinite-set', {
    t: 'Smallest Number in Infinite Set',
    r: 'Everything from a pointer `next` upward is present, plus a min-heap (set) of added-back numbers below `next`. popSmallest takes the heap minimum if any, else next++.',
    g: R => seq(R, 'SmallestInfiniteSet', [], R.int(3, 10), R => R.chance(0.6) ? ['popSmallest', []] : ['addBack', [R.int(1, 6)]]),
    s(I, T) { return play(I, T, () => { let nx = 1; const h = new Set(); return { get nx() { return nx; }, h, popSmallest() { if (h.size) { const m = Math.min(...h); h.delete(m); return m; } return nx++; }, addBack(x) { if (x < nx) h.add(x); } }; }, { view: o => ({ addedBack: A([...o.h].sort((a, b) => a - b)), next: o.nx }), why: () => 'Smallest added-back value, else the pointer.' }); }
  });

  D('design-a-number-container-system', {
    t: 'Design a Number Container System',
    r: 'Map index → number and number → sorted set of indices (or a heap with lazy deletion). change moves the index between sets; find returns the smallest index for the number or −1.',
    g: R => seq(R, 'NumberContainers', [], R.int(3, 10), R => R.chance(0.6) ? ['change', [R.int(1, 6), R.int(1, 3)]] : ['find', [R.int(1, 3)]]),
    s(I, T) { return play(I, T, () => { const m = new Map(); return { m, change(i, x) { m.set(i, x); }, find(x) { let b = -1; for (const [i, v] of m) if (v === x && (b < 0 || i < b)) b = i; return b; } }; }, { view: o => ({ containers: K(Object.fromEntries([...o.m].sort((a, b) => a[0] - b[0]))) }), why: (op, [x]) => `Smallest index holding ${x}, else −1.` }); }
  });

  D('design-a-food-rating-system', {
    t: 'Design a Food Rating System',
    r: 'Per cuisine, an ordered set (or lazy heap) of (−rating, name). changeRating updates the food\'s rating; highestRated reads the top: highest rating, then smallest name.',
    g: R => { const foods = ['apple', 'bun', 'curry', 'dal', 'egg', 'fig'].slice(0, R.int(2, 6)), cu = foods.map(() => R.pick(['x', 'y'])), rt = foods.map(() => R.int(1, 5)); return seq(R, 'FoodRatings', [foods, cu, rt], R.int(2, 8), R => R.chance(0.5) ? ['changeRating', [R.pick(foods), R.int(1, 5)]] : ['highestRated', [R.pick(cu)]]); },
    s(I, T) { const [f, c, r0] = I.args[0]; return play(I, T, () => { const r = r0.slice(); return { r, changeRating(x, v) { r[f.indexOf(x)] = v; }, highestRated(cu) { let b = -1; f.forEach((x, i) => { if (c[i] === cu && (b < 0 || r[i] > r[b] || (r[i] === r[b] && x < f[b]))) b = i; }); return f[b]; } }; }, { view: o => ({ foods: A(f.map((x, i) => `${x}/${c[i]}:${o.r[i]}`)) }), strOpts: () => f, why: (op, [cu]) => `Best rating in cuisine ${cu}; smaller name on ties.` }); }
  });

  D('design-sql', {
    t: 'Design SQL',
    r: 'Per table: column count, an auto-increment row id, and a map id → row. ins fails on a missing table or wrong column count; sel returns the cell or "<null>"; exp lists remaining rows as "id,cells…".',
    g: R => { const names = ['t1', 't2'], cols = [R.int(1, 3), R.int(1, 3)]; return seq(R, 'SQL', [names, cols], R.int(2, 8), (R, st) => { st.n = st.n || [0, 0]; const t = R.int(0, 2), name = t === 2 ? 'zz' : names[t], c = R.pick(['ins', 'ins', 'sel', 'rmv', 'exp']); if (c === 'ins') { const k = t < 2 && R.chance(0.8) ? cols[t] : R.int(1, 3); if (t < 2 && k === cols[t]) st.n[t]++; return [c, [name, Array.from({ length: k }, () => R.str(2, 'abc'))]]; } if (c === 'sel') return [c, [name, R.int(1, 3), R.int(1, 3)]]; if (c === 'rmv') return [c, [name, R.int(1, 3)]]; return [c, [name]]; }); },
    s(I, T) { return play(I, T, (names, cols) => { const tb = {}; names.forEach((n, i) => tb[n] = { c: cols[i], id: 0, rows: new Map() }); return { tb, ins(n, row) { const t = tb[n]; if (!t || row.length !== t.c) return false; t.rows.set(++t.id, row); return true; }, rmv(n, id) { const t = tb[n]; if (t) t.rows.delete(id); }, sel(n, id, c) { const t = tb[n], row = t && t.rows.get(id); return row && c >= 1 && c <= t.c ? row[c - 1] : '<null>'; }, exp(n) { const t = tb[n]; return t ? [...t.rows].map(([id, r]) => [id, ...r].join(',')) : []; } }; }, { view: o => ({ tables: K(Object.fromEntries(Object.entries(o.tb).map(([n, t]) => [n, `${t.c} cols: ` + ([...t.rows].map(([id, r]) => id + ':' + r.join('/')).join(' ') || '∅')]))) }), strOpts: (o, r) => ['<null>', r + 'a'], why: op => ({ ins: 'Table exists and the column count matches?', sel: 'The cell, or "<null>".', exp: 'Remaining rows of the table.' }[op]) }); }
  });

  D('longest-uploaded-prefix', {
    t: 'Longest Uploaded Prefix',
    r: 'Mark uploaded videos and keep a pointer p = longest prefix. After each upload, advance p while video p + 1 is uploaded — amortized O(1).',
    g: R => { const n = R.int(1, 8), ids = R.shuffle([...Array(n).keys()].map(x => x + 1)), ops = ['LUPrefix'], args = [[n]]; ids.forEach(i => { ops.push('upload'); args.push([i]); if (R.chance(0.6)) { ops.push('longest'); args.push([]); } }); return { ops, args }; },
    s(I, T) { return play(I, T, n => { const up = Array(n + 2).fill(false); let p = 0; return { up, get p() { return p; }, upload(v) { up[v] = true; while (up[p + 1]) p++; }, longest() { return p; } }; }, { view: o => ({ uploaded: A(o.up.slice(1, -1).map(x => x ? '✓' : '·')) }), why: () => 'Largest i with videos 1..i all uploaded.' }); }
  });

  D('design-memory-allocator', {
    t: 'Design Memory Allocator',
    r: 'Simulate the memory array. allocate scans for the leftmost run of `size` free units, fills it with mID and returns its start (−1 if none). freeMemory clears every unit with that mID and returns how many.',
    g: R => { const n = R.int(3, 10); return seq(R, 'Allocator', [n], R.int(2, 9), R => R.chance(0.65) ? ['allocate', [R.int(1, 4), R.int(1, 3)]] : ['freeMemory', [R.int(1, 3)]]); },
    s(I, T) { return play(I, T, n => { const m = Array(n).fill(0); return { m, allocate(s, id) { let run = 0; for (let i = 0; i < n; i++) { run = m[i] ? 0 : run + 1; if (run === s) { for (let j = i - s + 1; j <= i; j++) m[j] = id; return i - s + 1; } } return -1; }, freeMemory(id) { let c = 0; for (let i = 0; i < n; i++) if (m[i] === id) { m[i] = 0; c++; } return c; } }; }, { view: o => ({ memory: A(o.m.map(x => x || '·')) }), why: op => op === 'allocate' ? 'Start of the leftmost free run long enough, else −1.' : 'Units freed.' }); }
  });

  D('find-consecutive-integers-from-a-data-stream', {
    t: 'Find Consecutive Integers from a Data Stream',
    r: 'Count how many of the most recent numbers in a row equal value (reset to 0 on a mismatch). consec returns whether that streak is ≥ k.',
    g: R => { const v = R.int(1, 3); return seq(R, 'DataStream', [v, R.int(1, 4)], R.int(2, 10), R => ['consec', [R.chance(0.7) ? v : R.int(1, 3)]]); },
    s(I, T) { return play(I, T, (v, k) => { let c = 0; return { get c() { return c; }, consec(x) { c = x === v ? c + 1 : 0; return c >= k; } }; }, { view: o => ({ value: I.args[0][0], k: I.args[0][1], streak: o.c }), why: () => 'Streak of `value` at the end ≥ k?' }); }
  });

  D('design-a-todo-list', {
    t: 'Design a Todo List',
    r: 'Task ids increase globally from 1. Per user keep tasks (description, due date, tags, done). getAllTasks / getTasksForTag list that user\'s unfinished tasks sorted by due date; completeTask only affects the user\'s own task.',
    g: R => seq(R, 'TodoList', [], R.int(3, 10), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['addTask', 'addTask', 'getAllTasks', 'getTasksForTag', 'completeTask']) : 'addTask'; const u = R.int(1, 2); if (c === 'addTask') { st.n++; return [c, [u, 'T' + st.n, R.int(1, 100), R.distinct(R.int(0, 2), 0, 1).map(x => 'P' + x)]]; } if (c === 'getAllTasks') return [c, [u]]; if (c === 'getTasksForTag') return [c, [u, 'P' + R.int(0, 1)]]; return [c, [u, R.int(1, st.n)]]; }),
    s(I, T) { return play(I, T, () => { const ts = []; return { ts, addTask(u, d, due, tags) { ts.push({ u, d, due, tags, done: false }); return ts.length; }, getAllTasks(u) { return ts.filter(t => t.u === u && !t.done).sort((a, b) => a.due - b.due).map(t => t.d); }, getTasksForTag(u, g) { return ts.filter(t => t.u === u && !t.done && t.tags.includes(g)).sort((a, b) => a.due - b.due).map(t => t.d); }, completeTask(u, id) { const t = ts[id - 1]; if (t && t.u === u) t.done = true; } }; }, { view: o => ({ tasks: A(o.ts.map((t, i) => `#${i + 1} u${t.u} ${t.d} due${t.due}${t.tags.length ? ' ' + t.tags.join('/') : ''}${t.done ? ' ✓' : ''}`)) }), why: () => 'That user\'s unfinished tasks (tag-filtered), by due date.' }); }
  });

  D('design-graph-with-shortest-path-calculator', {
    t: 'Design Graph With Shortest Path Calculator',
    r: 'Keep a directed weighted adjacency list. addEdge appends; shortestPath runs Dijkstra from node1 and returns the distance to node2 (−1 if unreachable).',
    g: R => { const n = R.int(2, 5), E = R.edges(n, R.int(1, n + 2), { dir: true, w: [1, 9] }); return seq(R, 'Graph', [n, E], R.int(1, 6), R => { if (R.chance(0.3)) { const a = R.int(0, n - 1); let b = R.int(0, n - 1); if (a === b) b = (a + 1) % n; return ['addEdge', [[a, b, R.int(1, 9)]]]; } return ['shortestPath', [R.int(0, n - 1), R.int(0, n - 1)]]; }); },
    s(I, T) { const [n] = I.args[0]; return play(I, T, (n, E0) => { const E = E0.map(e => e.slice()); return { E, addEdge(e) { E.push(e.slice()); }, shortestPath(a, b) { const d = Array(n).fill(Infinity), done = Array(n).fill(false); d[a] = 0; for (;;) { let u = -1; for (let i = 0; i < n; i++) if (!done[i] && d[i] < Infinity && (u < 0 || d[i] < d[u])) u = i; if (u < 0) break; done[u] = true; for (const [x, y, w] of E) if (x === u && d[u] + w < d[y]) d[y] = d[u] + w; } return d[b] === Infinity ? -1 : d[b]; } }; }, { view: o => ({ graph: GR(n, o.E.map(([a, b]) => [a, b]), { dir: true, label: o.E.map(e => e[2]) }) }), why: (op, [a, b]) => `Dijkstra distance ${a} → ${b}, or −1.` }); }
  });

  D('frequency-tracker', {
    t: 'Frequency Tracker',
    r: 'Two maps: count[x] and freqOfFreq[c] (how many numbers occur exactly c times). add/deleteOne move x between frequency buckets; hasFrequency(f) checks freqOfFreq[f] > 0.',
    g: R => seq(R, 'FrequencyTracker', [], R.int(3, 10), R => [R.pick(['add', 'add', 'deleteOne', 'hasFrequency']), [R.int(1, 3)]]),
    s(I, T) { return play(I, T, () => { const c = new Map(); return { c, add(x) { c.set(x, (c.get(x) || 0) + 1); }, deleteOne(x) { if (c.get(x)) c.set(x, c.get(x) - 1); }, hasFrequency(f) { return [...c.values()].includes(f); } }; }, { view: o => ({ counts: K(Object.fromEntries([...o.c].filter(e => e[1]))) }), why: (op, [f]) => `Does some number occur exactly ${f} times?` }); }
  });

  D('design-neighbor-sum-service', {
    t: 'Design Neighbor Sum Service',
    r: 'Values are distinct, so precompute value → (row, col). adjacentSum adds the up/down/left/right neighbors; diagonalSum adds the four diagonal neighbors (skipping out-of-grid cells).',
    g: R => { const n = R.int(3, 4), v = R.shuffle([...Array(n * n).keys()]); const g = Array.from({ length: n }, (_, r) => v.slice(r * n, r * n + n)); return seq(R, 'NeighborSum', [g], R.int(1, 5), R => [R.pick(['adjacentSum', 'diagonalSum']), [R.int(0, n * n - 1)]]); },
    s(I, T) { const g = I.args[0][0], n = g.length, pos = {}; g.forEach((r, i) => r.forEach((x, j) => pos[x] = [i, j])); const sum = (x, D) => { const [r, c] = pos[x]; let s = 0; for (const [dr, dc] of D) { const a = r + dr, b = c + dc; if (a >= 0 && b >= 0 && a < n && b < n) s += g[a][b]; } return s; }; return play(I, T, () => ({ adjacentSum: x => sum(x, [[1, 0], [-1, 0], [0, 1], [0, -1]]), diagonalSum: x => sum(x, [[1, 1], [1, -1], [-1, 1], [-1, -1]]) }), { view: () => ({ grid: G(g.map(r => r.slice())) }), why: op => op === 'adjacentSum' ? 'Sum of up/down/left/right neighbors.' : 'Sum of the four diagonal neighbors.' }); }
  });

  D('design-an-array-statistics-tracker', {
    t: 'Design an Array Statistics Tracker',
    r: 'A queue for insertion order, a running sum for the mean, two heaps (or a sorted list) for the median — the larger middle on even sizes — and frequency buckets for the mode (smallest value on ties).',
    g: R => seq(R, 'StatisticsTracker', [], R.int(3, 12), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['addNumber', 'addNumber', 'removeFirstAddedNumber', 'getMean', 'getMedian', 'getMode']) : 'addNumber'; if (c === 'addNumber') { st.n++; return [c, [R.int(1, 9)]]; } if (c === 'removeFirstAddedNumber') st.n--; return [c, []]; }),
    s(I, T) { return play(I, T, () => { const q = []; return { q, addNumber(x) { q.push(x); }, removeFirstAddedNumber() { q.shift(); }, getMean() { return Math.floor(q.reduce((s, x) => s + x, 0) / q.length); }, getMedian() { const s = q.slice().sort((a, b) => a - b); return s[s.length >> 1]; }, getMode() { const c = {}; q.forEach(x => c[x] = (c[x] || 0) + 1); let b = null; for (const k of Object.keys(c).map(Number).sort((a, b) => a - b)) if (b === null || c[k] > c[b]) b = k; return b; } }; }, { view: o => ({ queue: Q(o.q.slice()) }), why: op => ({ getMean: 'Floor of the average.', getMedian: 'Sorted middle (the larger middle on even sizes).', getMode: 'Most frequent; smallest on ties.' }[op]) }); }
  });

  D('design-a-3d-binary-matrix-with-efficient-layer-tracking', {
    t: 'Design a 3D Binary Matrix with Efficient Layer Tracking',
    r: 'Count ones per x-layer and keep a set of cells. largestMatrix returns the layer with the most ones, preferring the larger x on ties (a heap keyed by (count, x) with lazy updates).',
    g: R => { const n = R.int(1, 3); return seq(R, 'Matrix3D', [n], R.int(2, 9), R => R.chance(0.3) ? ['largestMatrix', []] : [R.pick(['setCell', 'setCell', 'unsetCell']), [R.int(0, n - 1), R.int(0, n - 1), R.int(0, n - 1)]]); },
    s(I, T) { return play(I, T, n => { const on = new Set(), c = Array(n).fill(0); return { c, setCell(x, y, z) { const k = [x, y, z].join(); if (!on.has(k)) { on.add(k); c[x]++; } }, unsetCell(x, y, z) { const k = [x, y, z].join(); if (on.delete(k)) c[x]--; }, largestMatrix() { let b = n - 1; for (let x = n - 1; x >= 0; x--) if (c[x] > c[b]) b = x; return b; } }; }, { view: o => ({ onesPerLayer: A(o.c.slice()) }), why: () => 'Layer with the most ones; larger x on ties.' }); }
  });

  D('design-task-manager', {
    t: 'Design Task Manager',
    r: 'Map taskId → (userId, priority) and a max-heap of (priority, taskId) with lazy deletion. execTop pops the highest priority (larger taskId on ties), removes it and returns its user (−1 if no tasks).',
    g: R => { const init = R.distinct(R.int(1, 3), 1, 9).map(t => [R.int(1, 3), t, R.int(1, 9)]); return seq(R, 'TaskManager', [init], R.int(2, 8), (R, st) => { st.m = st.m || new Map(init.map(x => [x[1], x[2]])); const c = R.pick(['add', 'edit', 'rmv', 'execTop', 'execTop']), live = [...st.m.keys()]; if (c === 'add') { let t = R.int(10, 30); while (st.m.has(t)) t++; const p = R.int(1, 9); st.m.set(t, p); return [c, [R.int(1, 3), t, p]]; } if ((c === 'edit' || c === 'rmv') && live.length) { const t = R.pick(live); if (c === 'rmv') { st.m.delete(t); return [c, [t]]; } const p = R.int(1, 9); st.m.set(t, p); return [c, [t, p]]; } let b = null; for (const [t, p] of st.m) if (b === null || p > st.m.get(b) || (p === st.m.get(b) && t > b)) b = t; if (b !== null) st.m.delete(b); return ['execTop', []]; }); },
    s(I, T) { return play(I, T, init => { const m = new Map(init.map(([u, t, p]) => [t, [u, p]])); return { m, add(u, t, p) { m.set(t, [u, p]); }, edit(t, p) { m.get(t)[1] = p; }, rmv(t) { m.delete(t); }, execTop() { let b = null; for (const [t, [, p]] of m) if (b === null || p > m.get(b)[1] || (p === m.get(b)[1] && t > b)) b = t; if (b === null) return -1; const u = m.get(b)[0]; m.delete(b); return u; } }; }, { view: o => ({ tasks: A([...o.m].map(([t, [u, p]]) => `t${t} u${u} p${p}`)) }), why: () => 'User of the highest-priority task (larger id on ties), or −1.' }); }
  });
})();
