/* v2 games: design (03). */
(function () {
  'use strict';
  const { D, A, G, K, S, Q, Tr, TR, GR } = LCGame.H;
  const fmt = a => typeof a === 'string' ? JSON.stringify(a) : Array.isArray(a) ? JSON.stringify(a) : String(a);
  // Run a design problem: ops[0] constructs, the rest are method calls. Asks about returned values.
  const play = (I, T, make, o) => { o = o || {}; const obj = make(...(I.args[0] || [])), out = [null]; let asks = 0; const max = o.max || 7; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], args = I.args[i] || [], before = o.view ? o.view(obj) : {}; let r = obj[op](...args); if (r === undefined) r = null; out.push(r); if (asks >= max || r === null || (o.skip && o.skip(op))) continue; const label = `${op}(${args.map(fmt).join(', ')})`, why = o.why ? o.why(op, args, r, obj) : 'Follow the structure\'s invariant.'; if (typeof r === 'number' && Number.isFinite(r)) { T.at(Object.assign({ call: label }, before)); T.n(`What does ${label} return?`, r, why); asks++; } else if (typeof r === 'boolean') { T.at(Object.assign({ call: label }, before)); T.yn(`Does ${label} return true?`, r, why); asks++; } else if (typeof r === 'string') { const opts = [...new Set([r, ...(o.strOpts ? o.strOpts(obj, r) : []), r === '' ? 'null' : ''])].slice(0, 4); if (opts.length > 1) { T.at(Object.assign({ call: label }, before)); T.c(`What does ${label} return?`, opts.map(x => x === '' ? '""' : x), r === '' ? '""' : r, why); asks++; } } else if (Array.isArray(r)) { T.at(Object.assign({ call: label }, before)); T.n(`How many items does ${label} return?`, r.length, why); asks++; } } if (!asks) { T.at({ calls: I.ops.length - 1 }); T.n('How many method calls follow the constructor?', I.ops.length - 1, 'Count the operations.'); } return out; };
  // Build a random op sequence: step(R, st) returns [op, args] or null to stop.
  const seq = (R, ctor, ctorArgs, n, step, st) => { const ops = [ctor], args = [ctorArgs]; st = st || {}; for (let i = 0; i < n; i++) { const x = step(R, st); if (!x) break; ops.push(x[0]); args.push(x[1]); } return { ops, args }; };
  const rngOf = I => { let h = 2166136261; const s = JSON.stringify(I); for (let i = 0; i < s.length; i++) h = Math.imul(h ^ s.charCodeAt(i), 16777619) >>> 0; return () => { h = (h + 0x6D2B79F5) >>> 0; let t = h; t = Math.imul(t ^ (t >>> 15), t | 1); t ^= t + Math.imul(t ^ (t >>> 7), t | 61); return ((t ^ (t >>> 14)) >>> 0) / 4294967296; }; };
  const floatOps = (o, e) => Array.isArray(o) && o.length === e.length && o.every((v, i) => e[i] === null ? v === null : Math.abs(Number(v) - Number(e[i])) < 1e-5);
  const parentArr = (R, n) => [-1, ...Array.from({ length: n - 1 }, (_, i) => R.int(0, i))];
  const bstArr = R => { const root = Tr.from(R.tree(R.int(1, 8), 1, 9, 4)), nodes = [], ino = x => { if (!x) return; ino(x.left); nodes.push(x); ino(x.right); }; ino(root); const vals = R.distinct(nodes.length, 1, 30).sort((a, b) => a - b); nodes.forEach((x, i) => x.val = vals[i]); return Tr.arr(root); };

  D('snapshot-array', {
    t: 'Snapshot Array',
    r: 'Each index keeps a list of (snap id, value) changes. set records at the current snap id; snap returns the id and increments it; get(i, s) binary searches the last change with id ≤ s (0 if none).',
    g: R => { const n = R.int(1, 4); return seq(R, 'SnapshotArray', [n], R.int(3, 9), (R, st) => { st.s = st.s || 0; const c = R.pick(['set', 'set', 'snap', 'get']); if (c === 'set') return [c, [R.int(0, n - 1), R.int(1, 9)]]; if (c === 'snap') { st.s++; return [c, []]; } return st.s ? [c, [R.int(0, n - 1), R.int(0, st.s - 1)]] : ['snap', (st.s++, [])]; }); },
    s(I, T) { return play(I, T, n => { const h = Array.from({ length: n }, () => [[0, 0]]); let id = 0; return { h, get id() { return id; }, set(i, v) { const a = h[i]; if (a[a.length - 1][0] === id) a[a.length - 1][1] = v; else a.push([id, v]); }, snap() { return id++; }, get(i, s) { let r = 0; for (const [x, v] of h[i]) if (x <= s) r = v; return r; } }; }, { view: o => ({ snapId: o.id, history: A(o.h.map(a => a.map(([s, v]) => `${s}:${v}`).join(' '))) }), why: op => op === 'snap' ? 'Returns the current id, then increments.' : 'Last value set at or before that snapshot.' }); }
  });

  D('online-majority-element-in-subarray', {
    t: 'Online Majority Element In Subarray',
    r: 'Positions of each value are stored sorted. For a query, try candidates (random picks, or a segment tree of Boyer–Moore votes) and count occurrences in [l, r] by binary search; return one with count ≥ threshold, else −1.',
    g: R => { const arr = R.ints(R.int(1, 8), 1, 3); return seq(R, 'MajorityChecker', [arr], R.int(1, 5), R => { const l = R.int(0, arr.length - 1), r = R.int(l, arr.length - 1), len = r - l + 1; return ['query', [l, r, R.int(Math.floor(len / 2) + 1, len)]]; }); },
    s(I, T) { const a = I.args[0][0]; return play(I, T, () => ({ query(l, r, t) { const c = {}; for (let i = l; i <= r; i++) c[a[i]] = (c[a[i]] || 0) + 1; for (const k in c) if (c[k] >= t) return +k; return -1; } }), { view: () => ({ arr: A(a) }), why: (op, [l, r, t]) => `A value appearing ≥ ${t} times in [${l}, ${r}], else −1.` }); }
  });

  D('design-file-system', {
    t: 'Design File System',
    r: 'Map each full path to its value. createPath fails if the path exists or its parent ("" for top level) is missing; get returns the value or −1.',
    g: R => seq(R, 'FileSystem', [], R.int(2, 7), R => { const p = '/' + Array.from({ length: R.int(1, 3) }, () => R.pick('ab')).join('/'); return R.chance(0.6) ? ['createPath', [p, R.int(1, 9)]] : ['get', [p]]; }),
    s(I, T) { return play(I, T, () => { const m = new Map(); return { m, createPath(p, v) { const par = p.slice(0, p.lastIndexOf('/')); if (m.has(p) || (par && !m.has(par))) return false; m.set(p, v); return true; }, get(p) { return m.has(p) ? m.get(p) : -1; } }; }, { view: o => ({ paths: K(Object.fromEntries(o.m)) }), why: op => op === 'get' ? 'Value or −1.' : 'Needs a missing path with an existing parent.' }); }
  });

  D('dinner-plate-stacks', {
    t: 'Dinner Plate Stacks',
    r: 'Stacks of fixed capacity. push goes to the leftmost stack with room (a min-heap of such indices); pop takes from the rightmost non-empty stack; popAtStack(i) pops stack i (−1 if empty).',
    g: R => seq(R, 'DinnerPlates', [R.int(1, 3)], R.int(4, 12), R => R.pick([['push', [R.int(1, 9)]], ['push', [R.int(1, 9)]], ['push', [R.int(1, 9)]], ['pop', []], ['popAtStack', [R.int(0, 3)]]])),
    s(I, T) { return play(I, T, cap => { const st = []; return { st, push(v) { let i = st.findIndex(s => s.length < cap); if (i < 0) { st.push([]); i = st.length - 1; } st[i].push(v); }, pop() { for (let i = st.length - 1; i >= 0; i--) if (st[i].length) return st[i].pop(); return -1; }, popAtStack(i) { return st[i] && st[i].length ? st[i].pop() : -1; } }; }, { view: o => ({ stacks: A(o.st.map(s => s.join(',') || '∅')) }), why: op => op === 'pop' ? 'From the rightmost non-empty stack.' : 'Top of that stack, or −1.' }); }
  });

  D('design-skiplist', {
    t: 'Design Skiplist',
    r: 'Sorted linked levels: each added value gets a random height. Search descends from the top level moving right while the next value is smaller. Duplicates allowed; erase removes one copy and reports whether it existed.',
    g: R => seq(R, 'Skiplist', [], R.int(4, 10), R => [R.pick(['add', 'add', 'search', 'erase']), [R.int(0, 6)]]),
    s(I, T) { return play(I, T, () => { const a = []; return { a, add(x) { a.push(x); a.sort((p, q) => p - q); }, search(x) { return a.includes(x); }, erase(x) { const i = a.indexOf(x); if (i < 0) return false; a.splice(i, 1); return true; } }; }, { view: o => ({ level0: A(o.a.slice()) }), why: op => op === 'erase' ? 'True if a copy was removed.' : 'Is the value present?' }); }
  });

  D('design-a-leaderboard', {
    t: 'Design A Leaderboard',
    r: 'Map each player to a score. addScore adds (creating the player); top(K) sums the K largest scores; reset removes the player.',
    g: R => seq(R, 'Leaderboard', [], R.int(4, 10), (R, st) => { st.p = st.p || new Set(); if (st.p.size && R.chance(0.35)) return R.chance(0.5) ? ['top', [R.int(1, st.p.size)]] : (() => { const p = R.pick([...st.p]); st.p.delete(p); return ['reset', [p]]; })(); const p = R.int(1, 5); st.p.add(p); return ['addScore', [p, R.int(1, 60)]]; }),
    s(I, T) { const res = (() => { return play(I, T, () => { const m = new Map(); return { m, addScore(p, s) { m.set(p, (m.get(p) || 0) + s); }, top(k) { return [...m.values()].sort((a, b) => b - a).slice(0, k).reduce((s, x) => s + x, 0); }, reset(p) { m.delete(p); } }; }, { view: o => ({ scores: K(Object.fromEntries(o.m)) }), why: (op, [k]) => `Sum of the ${k} highest scores.` }); })(); T.n('addScore calls?', I.ops.filter(o => o === 'addScore').length, 'Each adds to one player.'); T.n('Distinct players ever added?', new Set(I.ops.map((o, i) => o === 'addScore' ? I.args[i][0] : null).filter(x => x !== null)).size, 'Count unique player ids.'); return res; }
  });

  D('find-elements-in-a-contaminated-binary-tree', {
    t: 'Find Elements in a Contaminated Binary Tree',
    r: 'Recover values top-down: root = 0, left child = 2x + 1, right child = 2x + 2, storing them in a set. find(t) is a set lookup.',
    g: R => { const t = Tr.arr(Tr.from(R.tree(R.int(1, 8), 1, 9, 4))).map(v => v === null ? null : -1); return seq(R, 'FindElements', [t], R.int(1, 5), R => ['find', [R.int(0, 14)]]); },
    s(I, T) { const root = Tr.from(I.args[0][0]), set = new Set(); const go = (n, v) => { if (!n) return; n.val = v; set.add(v); go(n.left, 2 * v + 1); go(n.right, 2 * v + 2); }; go(root, 0); T.at({ recovered: TR(root) }); return play(I, T, () => ({ find(t) { return set.has(t); } }), { why: (op, [t]) => `Is ${t} one of the recovered values?` }); }
  });

  D('iterator-for-combination', {
    t: 'Iterator for Combination',
    r: 'Generate combinations in lexicographic order with an index array: find the rightmost index that can still increase, bump it, and reset the ones after it to consecutive positions.',
    g: R => { const s = [...new Set(R.str(R.int(1, 5), 'abcdef'))].sort().join(''), k = R.int(1, s.length); let total = 1; for (let i = 0; i < k; i++) total = total * (s.length - i) / (i + 1); return seq(R, 'CombinationIterator', [s, k], R.int(1, 6), (R, st) => { st.n = st.n || 0; if (st.n < total && R.chance(0.7)) { st.n++; return ['next', []]; } return ['hasNext', []]; }); },
    s(I, T) { const [s, k] = I.args[0], all = []; const go = (i, cur) => { if (cur.length === k) return all.push(cur); for (let j = i; j < s.length; j++) go(j + 1, cur + s[j]); }; go(0, ''); return play(I, T, () => { let i = 0; return { get i() { return i; }, next() { return all[i++]; }, hasNext() { return i < all.length; } }; }, { view: o => ({ combos: A(all, { i: o.i }) }), strOpts: (o, r) => all.filter(x => x !== r).slice(0, 3), why: op => op === 'next' ? 'Next combination in lexicographic order.' : 'Any combinations left?' }); }
  });

  D('tweet-counts-per-frequency', {
    t: 'Tweet Counts Per Frequency',
    r: 'Store each tweet\'s times. For a query, the chunk size is 60, 3600 or 86400; there are ⌊(end − start) / size⌋ + 1 chunks, and each time t in [start, end] adds to chunk ⌊(t − start) / size⌋.',
    g: R => seq(R, 'TweetCounts', [], R.int(3, 8), R => R.chance(0.6) ? ['recordTweet', [R.pick(['t1', 't2']), R.int(0, 240)]] : (() => { const a = R.int(0, 200); return ['getTweetCountsPerFrequency', [R.pick(['minute', 'minute', 'hour']), R.pick(['t1', 't2']), a, a + R.int(0, 200)]]; })()),
    s(I, T) { return play(I, T, () => { const m = {}; return { m, recordTweet(n, t) { (m[n] = m[n] || []).push(t); }, getTweetCountsPerFrequency(f, n, a, b) { const sz = { minute: 60, hour: 3600, day: 86400 }[f], out = Array(Math.floor((b - a) / sz) + 1).fill(0); for (const t of m[n] || []) if (t >= a && t <= b) out[Math.floor((t - a) / sz)]++; return out; } }; }, { view: o => ({ tweets: K(Object.fromEntries(Object.entries(o.m).map(([k, v]) => [k, v.join(',')]))) }), why: (op, [f, n, a, b]) => `⌊(${b} − ${a}) / chunk⌋ + 1 chunks.` }); }
  });

  D('product-of-the-last-k-numbers', {
    t: 'Product of the Last K Numbers',
    r: 'Keep prefix products since the last zero. getProduct(k) = P[n] / P[n − k] if the last k numbers contain no zero (k < length of the list), else 0. Adding 0 resets the list.',
    g: R => seq(R, 'ProductOfNumbers', [], R.int(3, 10), (R, st) => { st.n = st.n || 0; if (!st.n || R.chance(0.6)) { st.n++; return ['add', [R.pick([0, 1, 2, 3, 4, 5])]]; } return ['getProduct', [R.int(1, st.n)]]; }),
    s(I, T) { return play(I, T, () => { let P = [1]; return { get P() { return P; }, add(x) { if (!x) P = [1]; else P.push(P[P.length - 1] * x); }, getProduct(k) { return k >= P.length ? 0 : P[P.length - 1] / P[P.length - 1 - k]; } }; }, { view: o => ({ prefix: A(o.P.slice()) }), why: (op, [k]) => `0 if a zero is within the last ${k}; else a ratio of prefix products.` }); }
  });

  D('apply-discount-every-n-orders', {
    t: 'Apply Discount Every n Orders',
    r: 'Map product → price and count customers. Each bill is Σ price × amount; every n-th customer pays bill × (100 − discount) / 100.',
    g: R => { const n = R.int(1, 3), d = R.pick([10, 20, 50]), ids = [1, 2, 3], pr = R.ints(3, 1, 9).map(x => x * 10); return seq(R, 'Cashier', [n, d, ids, pr], R.int(1, 6), R => { const p = R.distinct(R.int(1, 3), 1, 3); return ['getBill', [p, R.ints(p.length, 1, 4)]]; }); },
    cmp: floatOps,
    s(I, T) { return play(I, T, (n, d, ids, pr) => { const m = new Map(ids.map((x, i) => [x, pr[i]])); let c = 0; return { get c() { return c; }, getBill(p, a) { const b = p.reduce((s, x, i) => s + m.get(x) * a[i], 0); return ++c % n === 0 ? b * (100 - d) / 100 : b; } }; }, { view: o => ({ customer: o.c + 1, everyNth: I.args[0][0], discount: I.args[0][1] + '%' }), why: () => 'Σ price·amount, discounted on every n-th customer.' }); }
  });

  D('design-a-stack-with-increment-operation', {
    t: 'Design a Stack With Increment Operation',
    r: 'An array with a max size plus a lazy inc[] array: increment(k, v) adds v to inc[min(k, size) − 1]; pop returns top + inc[top] and passes inc[top] down to the element below.',
    g: R => seq(R, 'CustomStack', [R.int(1, 4)], R.int(4, 10), R => R.pick([['push', [R.int(1, 9)]], ['push', [R.int(1, 9)]], ['pop', []], ['increment', [R.int(1, 4), R.int(1, 100)]]])),
    s(I, T) { return play(I, T, m => { const s = []; return { s, push(x) { if (s.length < m) s.push(x); }, pop() { return s.length ? s.pop() : -1; }, increment(k, v) { for (let i = 0; i < Math.min(k, s.length); i++) s[i] += v; } }; }, { view: o => ({ stack: S(o.s.slice()) }), why: () => 'Top value (with increments), or −1.' }); }
  });

  D('design-underground-system', {
    t: 'Design Underground System',
    r: 'checkIn stores (station, time) per rider; checkOut adds the trip duration to a (start, end) route total and count. getAverageTime = total / count.',
    g: R => { const st = ['A', 'B', 'C']; return seq(R, 'UndergroundSystem', [], R.int(4, 12), (R, s) => { s.in = s.in || {}; s.t = (s.t || 0) + R.int(1, 5); s.r = s.r || []; const riders = Object.keys(s.in); if (riders.length && R.chance(0.5)) { const id = R.pick(riders), from = s.in[id]; delete s.in[id]; const to = R.pick(st.filter(x => x !== from)); s.r.push([from, to]); return ['checkOut', [+id, to, s.t]]; } if (s.r.length && R.chance(0.3)) return ['getAverageTime', R.pick(s.r).slice()]; const free = [1, 2, 3, 4, 5, 6, 7, 8, 9].filter(x => !s.in[x]); if (!free.length) return null; const id = R.pick(free); s.in[id] = R.pick(st); return ['checkIn', [id, s.in[id], s.t]]; }); },
    cmp: floatOps,
    s(I, T) { const res = (() => { return play(I, T, () => { const ins = {}, r = {}; return { r, checkIn(id, s, t) { ins[id] = [s, t]; }, checkOut(id, s, t) { const [a, t0] = ins[id], k = a + ' to ' + s; r[k] = r[k] || [0, 0]; r[k][0] += t - t0; r[k][1]++; }, getAverageTime(a, b) { const x = r[a + ' to ' + b]; return x[0] / x[1]; } }; }, { view: o => ({ routes: K(Object.fromEntries(Object.entries(o.r).map(([k, [s, c]]) => [k, `${s} over ${c} trips`]))) }), why: () => 'Total duration divided by the number of trips on that route.' }); })(); T.n('checkOut calls?', I.ops.filter(o => o === 'checkOut').length, 'Each finishes one trip.'); T.n('Distinct routes travelled?', Object.keys((() => { const ins = {}, r = {}; I.ops.forEach((o, i) => { const g = I.args[i]; if (o === 'checkIn') ins[g[0]] = g[1]; if (o === 'checkOut') r[ins[g[0]] + ' to ' + g[1]] = 1; }); return r; })()).length, 'One per start and end station pair.'); return res; }
  });

  D('first-unique-number', {
    t: 'First Unique Number',
    r: 'Count occurrences and keep a queue in arrival order. showFirstUnique pops from the front while the front has count > 1, then returns it (−1 if empty).',
    g: R => seq(R, 'FirstUnique', [R.ints(R.int(1, 5), 1, 5)], R.int(2, 8), R => R.chance(0.5) ? ['showFirstUnique', []] : ['add', [R.int(1, 6)]]),
    s(I, T) { return play(I, T, nums => { const c = new Map(), q = []; const add = x => { c.set(x, (c.get(x) || 0) + 1); q.push(x); }; nums.forEach(add); return { q, add, showFirstUnique() { while (q.length && c.get(q[0]) > 1) q.shift(); return q.length ? q[0] : -1; } }; }, { view: o => ({ queue: Q(o.q.slice()) }), why: () => 'Earliest value seen exactly once, else −1.' }); }
  });

  D('design-browser-history', {
    t: 'Design Browser History',
    r: 'An array of pages and a cursor. visit truncates everything after the cursor and appends. back/forward move the cursor by up to steps (clamped) and return that page.',
    g: R => seq(R, 'BrowserHistory', ['home.com'], R.int(3, 9), R => R.chance(0.45) ? ['visit', [R.pick(['a', 'b', 'c', 'd']) + '.com']] : [R.pick(['back', 'forward']), [R.int(1, 3)]]),
    s(I, T) { return play(I, T, h => { const p = [h]; let i = 0; return { p, get i() { return i; }, visit(u) { p.length = i + 1; p.push(u); i++; }, back(k) { i = Math.max(0, i - k); return p[i]; }, forward(k) { i = Math.min(p.length - 1, i + k); return p[i]; } }; }, { view: o => ({ history: A(o.p.slice(), { i: o.i }) }), strOpts: o => o.p, why: op => `Move the cursor ${op}, clamped to the ends.` }); }
  });

  D('subrectangle-queries', {
    t: 'Subrectangle Queries',
    r: 'Either write updates straight into the grid, or log them and answer getValue from the latest update covering the cell (falling back to the original value).',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return seq(R, 'SubrectangleQueries', [Array.from({ length: m }, () => R.ints(n, 1, 9))], R.int(2, 7), R => { if (R.chance(0.5)) return ['getValue', [R.int(0, m - 1), R.int(0, n - 1)]]; const r1 = R.int(0, m - 1), c1 = R.int(0, n - 1); return ['updateSubrectangle', [r1, c1, R.int(r1, m - 1), R.int(c1, n - 1), R.int(1, 20)]]; }); },
    s(I, T) { return play(I, T, g => { const a = g.map(r => r.slice()); return { a, updateSubrectangle(r1, c1, r2, c2, v) { for (let r = r1; r <= r2; r++) for (let c = c1; c <= c2; c++) a[r][c] = v; }, getValue(r, c) { return a[r][c]; } }; }, { view: o => ({ grid: G(o.a.map(r => r.slice())) }), why: () => 'Latest update covering the cell, else the original.' }); }
  });

  D('kth-ancestor-of-a-tree-node', {
    t: 'Kth Ancestor of a Tree Node',
    r: 'Binary lifting: up[j][v] is the 2^j-th ancestor. Answer getKthAncestor(v, k) by jumping along the set bits of k; −1 once we pass the root.',
    g: R => { const n = R.int(1, 10); return seq(R, 'TreeAncestor', [n, parentArr(R, n)], R.int(1, 5), R => ['getKthAncestor', [R.int(0, n - 1), R.int(1, 5)]]); },
    s(I, T) { const [n, p] = I.args[0]; return play(I, T, () => ({ getKthAncestor(v, k) { while (k-- && v >= 0) v = p[v]; return v; } }), { view: () => ({ tree: GR(n, p.map((x, i) => [x, i]).filter(e => e[0] >= 0), { dir: true }) }), why: (op, [v, k]) => `Climb ${k} parents from ${v} (−1 past the root).` }); }
  });

  D('design-a-file-sharing-system', {
    t: 'Design a File Sharing System',
    r: 'Give joining users the smallest free id (a min-heap of released ids, else the next counter). Map chunk → owners. request returns the sorted owners of a chunk; if any, the requester also gets it.',
    g: R => { const m = R.int(2, 5); return seq(R, 'FileSharing', [m], R.int(3, 9), (R, st) => { st.u = st.u || []; st.free = st.free || []; st.next = st.next || 1; const c = st.u.length ? R.pick(['join', 'leave', 'request', 'request']) : 'join'; if (c === 'join') { let id; if (st.free.length) { st.free.sort((a, b) => a - b); id = st.free.shift(); } else id = st.next++; st.u.push(id); return ['join', [R.distinct(R.int(0, 2), 1, m)]]; } if (c === 'leave') { const u = R.pick(st.u); st.u = st.u.filter(x => x !== u); st.free.push(u); return ['leave', [u]]; } return ['request', [R.pick(st.u), R.int(1, m)]]; }); },
    s(I, T) { return play(I, T, m => { const own = new Map(); let next = 1; const free = []; return { own, join(ch) { let id; if (free.length) { free.sort((a, b) => a - b); id = free.shift(); } else id = next++; own.set(id, new Set(ch)); return id; }, leave(u) { own.delete(u); free.push(u); }, request(u, c) { const r = [...own].filter(([, s]) => s.has(c)).map(x => x[0]).sort((a, b) => a - b); if (r.length && own.has(u)) own.get(u).add(c); return r; } }; }, { view: o => ({ users: K(Object.fromEntries([...o.own].map(([u, s]) => [u, [...s].sort((a, b) => a - b).join(',') || '∅']))) }), why: op => op === 'join' ? 'Smallest unused id.' : 'Owners of the chunk, sorted.' }); }
  });

  D('dot-product-of-two-sparse-vectors', {
    t: 'Dot Product of Two Sparse Vectors',
    r: 'Store only the non-zero (index, value) pairs. The dot product walks both pair lists with two pointers, multiplying when indices match.',
    g: R => { const n = R.int(1, 8), sp = () => Array.from({ length: n }, () => R.chance(0.5) ? 0 : R.int(1, 5)); return { nums1: sp(), nums2: sp() }; },
    s(I, T) { const p = I.nums1.map((v, i) => [i, v]).filter(x => x[1]), q = I.nums2.map((v, i) => [i, v]).filter(x => x[1]); T.at({ nums1: A(I.nums1), nums2: A(I.nums2) }); T.n('How many non-zero pairs does nums1 store?', p.length, 'Only non-zeros are kept.'); let s = 0, i = 0, j = 0, asks = 0; while (i < p.length && j < q.length) { if (p[i][0] === q[j][0]) { s += p[i][1] * q[j][1]; if (asks++ < 5) { T.at({ index: p[i][0], a: p[i][1], b: q[j][1] }); T.n('Running dot product?', s, 'Add a·b at a shared index.'); } i++; j++; } else if (p[i][0] < q[j][0]) i++; else j++; } return s; }
  });

  D('binary-search-tree-iterator-ii', {
    t: 'Binary Search Tree Iterator II',
    r: 'Record values from an in-order traversal as you go, with a pointer into that list. next moves right (expanding the traversal when needed); prev moves left. hasNext/hasPrev compare the pointer with the bounds.',
    g: R => { const t = bstArr(R), n = t.filter(v => v !== null).length; return seq(R, 'BSTIterator', [t], R.int(2, 10), (R, st) => { st.i = st.i === undefined ? -1 : st.i; const can = []; if (st.i + 1 < n) can.push('next', 'next'); if (st.i > 0) can.push('prev'); can.push('hasNext', 'hasPrev'); const c = R.pick(can); if (c === 'next') st.i++; if (c === 'prev') st.i--; return [c, [null]]; }); },
    s(I, T) { const root = Tr.from(I.args[0][0]), ino = []; const go = x => { if (!x) return; go(x.left); ino.push(x.val); go(x.right); }; go(root); return play(I, T, () => { let i = -1; return { get i() { return i; }, next() { return ino[++i]; }, prev() { return ino[--i]; }, hasNext() { return i + 1 < ino.length; }, hasPrev() { return i > 0; } }; }, { view: o => ({ inorder: A(ino, o.i >= 0 ? { i: o.i } : {}) }), why: op => ({ next: 'Next value in sorted order.', prev: 'Previous value in sorted order.' }[op] || 'Compare the pointer with the ends.') }); }
  });

  D('throne-inheritance', {
    t: 'Throne Inheritance',
    r: 'A family tree with children in birth order and a dead set. The inheritance order is the preorder traversal from the king, skipping dead people (their descendants still count).',
    g: R => { const names = ['king']; let k = 0; return seq(R, 'ThroneInheritance', ['king'], R.int(3, 9), R => { const c = R.pick(['birth', 'birth', 'birth', 'death', 'getInheritanceOrder']); if (c === 'birth') { const nm = 'p' + (++k); const par = R.pick(names); names.push(nm); return [c, [par, nm]]; } if (c === 'death') return [c, [R.pick(names)]]; return [c, [null]]; }); },
    s(I, T) { const res = (() => { return play(I, T, king => { const ch = { [king]: [] }, dead = new Set(); return { ch, dead, birth(p, c) { ch[p].push(c); ch[c] = []; }, death(x) { dead.add(x); }, getInheritanceOrder() { const out = []; const go = x => { if (!dead.has(x)) out.push(x); ch[x].forEach(go); }; go(king); return out; } }; }, { view: o => ({ family: K(Object.fromEntries(Object.entries(o.ch).map(([k, v]) => [o.dead.has(k) ? k + ' (dead)' : k, v.join(', ') || 'none']))) }), why: () => 'Preorder from the king, skipping the dead.' }); })(); T.n('birth calls?', I.ops.filter(o => o === 'birth').length, 'Each adds one person.'); T.n('death calls?', I.ops.filter(o => o === 'death').length, 'The dead stay in the tree but are skipped.'); return res; }
  });

  D('design-parking-system', {
    t: 'Design Parking System',
    r: 'Three counters for big, medium and small slots. addCar(type) succeeds if that counter is positive, decrementing it.',
    g: R => seq(R, 'ParkingSystem', [R.int(0, 2), R.int(0, 2), R.int(0, 2)], R.int(2, 7), R => ['addCar', [R.int(1, 3)]]),
    s(I, T) { return play(I, T, (b, m, s) => { const c = [0, b, m, s]; return { c, addCar(t) { if (!c[t]) return false; c[t]--; return true; } }; }, { view: o => ({ free: K({ big: o.c[1], medium: o.c[2], small: o.c[3] }) }), why: (op, [t]) => `Is a ${['', 'big', 'medium', 'small'][t]} slot free?` }); }
  });

  D('fancy-sequence', {
    t: 'Fancy Sequence',
    r: 'Keep a global affine transform x → a·x + b (mod 1e9+7). append stores (val − b)·a⁻¹ so the transform maps it back; addAll updates b; multAll updates a and b; getIndex applies the transform (−1 if out of range).',
    g: R => seq(R, 'Fancy', [], R.int(3, 10), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['append', 'addAll', 'multAll', 'getIndex']) : 'append'; if (c === 'append') { st.n++; return [c, [R.int(1, 9)]]; } if (c === 'getIndex') return [c, [R.int(0, st.n)]]; return [c, [R.int(1, 5)]]; }),
    s(I, T) { const M = 1000000007; return play(I, T, () => { const a = []; return { a, append(v) { a.push(v); }, addAll(x) { for (let i = 0; i < a.length; i++) a[i] = (a[i] + x) % M; }, multAll(x) { for (let i = 0; i < a.length; i++) a[i] = (a[i] * x) % M; }, getIndex(i) { return i < a.length ? a[i] : -1; } }; }, { view: o => ({ seq: A(o.a.slice()) }), why: () => 'The value after every later add/mult (or −1).' }); }
  });

  D('design-an-expression-tree-with-evaluate-function', {
    t: 'Design an Expression Tree With Evaluate Function',
    r: 'Build the tree from postfix with a stack: numbers become leaves; an operator pops right then left and pushes a node. evaluate recurses (division truncates toward zero).',
    g: R => { const go = d => { if (!d || R.chance(0.3)) return [String(R.int(1, 9))]; return [...go(d - 1), ...go(d - 1), R.pick('+-*/')]; }; let s; do { s = go(R.int(1, 3)); try { const st = []; for (const t of s) { if (/\d/.test(t)) st.push(+t); else { const b = st.pop(), a = st.pop(); if (t === '/' && b === 0) throw 0; st.push(t === '+' ? a + b : t === '-' ? a - b : t === '*' ? a * b : Math.trunc(a / b)); } } } catch (e) { s = null; } } while (!s); return { s }; },
    s(I, T) { const st = []; let asks = 0; for (const t of I.s) { if (/\d/.test(t)) { st.push(+t); continue; } const b = st.pop(), a = st.pop(), v = t === '+' ? a + b : t === '-' ? a - b : t === '*' ? a * b : Math.trunc(a / b); if (asks++ < 8) { T.at({ token: t, left: a, right: b, stack: S(st.slice()) }); T.n(`${a} ${t} ${b} = ?`, v, 'Pop right, then left; division truncates.'); } st.push(v); } if (!asks) { T.at({ tokens: A(I.s) }); T.n('Value of a single number?', st[0], 'A leaf evaluates to itself.'); } return st[0]; }
  });

  D('design-an-ordered-stream', {
    t: 'Design an Ordered Stream',
    r: 'Store values by id and keep a pointer at the first missing id. insert places the value, then returns every consecutive value starting at the pointer, advancing it.',
    g: R => { const n = R.int(1, 6), ids = R.shuffle([...Array(n).keys()].map(x => x + 1)); return { ops: ['OrderedStream', ...ids.map(() => 'insert')], args: [[n], ...ids.map(i => [i, R.str(3, 'abc')])] }; },
    s(I, T) { return play(I, T, n => { const a = Array(n + 1).fill(null); let p = 1; return { a, get p() { return p; }, insert(i, v) { a[i] = v; const out = []; while (p <= n && a[p] !== null) out.push(a[p++]); return out; } }; }, { view: o => ({ slots: A(o.a.slice(1).map(x => x || '·'), { ptr: o.p - 1 }) }), why: () => 'Consecutive values from the pointer.' }); }
  });

  D('design-front-middle-back-queue', {
    t: 'Design Front Middle Back Queue',
    r: 'Two balanced deques make every op O(1); viewed as one list, pushMiddle inserts at ⌊n/2⌋, popMiddle removes at ⌊(n − 1)/2⌋. Pops on an empty queue return −1.',
    g: R => seq(R, 'FrontMiddleBackQueue', [], R.int(4, 10), R => R.pick([['pushFront', [R.int(1, 9)]], ['pushMiddle', [R.int(1, 9)]], ['pushBack', [R.int(1, 9)]], ['popFront', []], ['popMiddle', []], ['popBack', []]])),
    s(I, T) { return play(I, T, () => { const q = []; return { q, pushFront(x) { q.unshift(x); }, pushMiddle(x) { q.splice(q.length >> 1, 0, x); }, pushBack(x) { q.push(x); }, popFront() { return q.length ? q.shift() : -1; }, popMiddle() { return q.length ? q.splice((q.length - 1) >> 1, 1)[0] : -1; }, popBack() { return q.length ? q.pop() : -1; } }; }, { view: o => ({ queue: A(o.q.slice()) }), why: op => op === 'popMiddle' ? 'Remove index ⌊(n − 1)/2⌋ (the front-middle).' : 'Value at that end, or −1.' }); }
  });

  D('checking-existence-of-edge-length-limited-paths-ii', {
    t: 'Checking Existence of Edge Length Limited Paths II',
    r: 'A path exists using only edges < limit iff p and q are joined in the minimum spanning forest restricted to those edges. (Offline: union edges below the limit; online: persistent union-find or MST + binary lifting of max edge.)',
    g: R => { const n = R.int(2, 6), e = R.edges(n, R.int(1, n + 2), { w: [1, 9] }); return seq(R, 'DistanceLimitedPathsExist', [n, e], R.int(1, 5), R => { const p = R.int(0, n - 1); let q = R.int(0, n - 1); if (q === p) q = (p + 1) % n; return ['query', [p, q, R.int(1, 10)]]; }); },
    s(I, T) { const [n, E] = I.args[0]; return play(I, T, () => ({ query(p, q, lim) { const par = [...Array(n).keys()], f = x => par[x] === x ? x : (par[x] = f(par[x])); for (const [a, b, w] of E) if (w < lim) par[f(a)] = f(b); return f(p) === f(q); } }), { view: () => ({ graph: GR(n, E.map(([a, b]) => [a, b]), { label: E.map(e => e[2]) }) }), why: (op, [p, q, l]) => `Connected using only edges lighter than ${l}?` }); }
  });

  D('design-most-recently-used-queue', {
    t: 'Design Most Recently Used Queue',
    r: 'fetch(k) removes the k-th element (1-indexed) and appends it to the end, returning it. A sqrt-decomposition or Fenwick tree over positions makes this fast; the list simulation shows the logic.',
    g: R => { const n = R.int(1, 8); return seq(R, 'MRUQueue', [n], R.int(1, 6), R => ['fetch', [R.int(1, n)]]); },
    s(I, T) { return play(I, T, n => { const q = [...Array(n).keys()].map(x => x + 1); return { q, fetch(k) { const v = q.splice(k - 1, 1)[0]; q.push(v); return v; } }; }, { view: o => ({ queue: A(o.q.slice()) }), why: (op, [k]) => `The ${k}-th element (it then moves to the end).` }); }
  });

  D('design-authentication-manager', {
    t: 'Design Authentication Manager',
    r: 'Map token → expiry (time + ttl). renew works only if the token exists and expiry > now. A token is unexpired at time t iff expiry > t.',
    g: R => { let t = 0; return seq(R, 'AuthenticationManager', [R.int(2, 6)], R.int(3, 9), R => { t += R.int(1, 3); const c = R.pick(['generate', 'generate', 'renew', 'countUnexpiredTokens']); return c === 'countUnexpiredTokens' ? [c, [t]] : [c, [R.pick(['a', 'b', 'c']), t]]; }); },
    s(I, T) { return play(I, T, ttl => { const m = new Map(); return { m, generate(id, t) { m.set(id, t + ttl); }, renew(id, t) { if (m.has(id) && m.get(id) > t) m.set(id, t + ttl); }, countUnexpiredTokens(t) { let c = 0; for (const e of m.values()) if (e > t) c++; return c; } }; }, { view: o => ({ expiry: K(Object.fromEntries(o.m)) }), why: (op, [t]) => `Tokens with expiry > ${t}.` }); }
  });

  D('implement-trie-ii-prefix-tree', {
    t: 'Implement Trie II (Prefix Tree)',
    r: 'Each trie node stores how many words pass through it and how many end there. insert/erase add/subtract 1 along the path; the two count queries read the final node\'s counters.',
    g: R => seq(R, 'Trie', [], R.int(3, 9), (R, st) => { st.w = st.w || []; const c = st.w.length ? R.pick(['insert', 'countWordsEqualTo', 'countWordsStartingWith', 'erase']) : 'insert'; if (c === 'insert') { const w = R.str(R.int(1, 3), 'ab'); st.w.push(w); return [c, [w]]; } if (c === 'erase') { const w = R.pick(st.w); st.w.splice(st.w.indexOf(w), 1); return [c, [w]]; } return [c, [R.str(R.int(1, 2), 'ab')]]; }),
    s(I, T) { return play(I, T, () => { const w = []; return { w, insert(x) { w.push(x); }, erase(x) { w.splice(w.indexOf(x), 1); }, countWordsEqualTo(x) { return w.filter(y => y === x).length; }, countWordsStartingWith(p) { return w.filter(y => y.startsWith(p)).length; } }; }, { view: o => ({ words: A(o.w.slice().sort()) }), why: op => op === 'countWordsEqualTo' ? 'End-count at the word\'s node.' : 'Pass-through count at the prefix node.' }); }
  });

  D('finding-mk-average', {
    t: 'Finding MK Average',
    r: 'Keep the last m elements in three sorted buckets: the k smallest, the middle, the k largest, plus the middle sum. With fewer than m elements the answer is −1; otherwise ⌊middle sum / (m − 2k)⌋.',
    g: R => { const k = R.int(1, 2), m = 2 * k + R.int(1, 3); return seq(R, 'MKAverage', [m, k], R.int(3, 12), R => R.chance(0.6) ? ['addElement', [R.int(1, 20)]] : ['calculateMKAverage', []]); },
    s(I, T) { return play(I, T, (m, k) => { const a = []; return { a, addElement(x) { a.push(x); }, calculateMKAverage() { if (a.length < m) return -1; const w = a.slice(-m).sort((x, y) => x - y).slice(k, m - k); return Math.floor(w.reduce((s, x) => s + x, 0) / w.length); } }; }, { view: o => ({ window: A(o.a.slice(-I.args[0][0])), m: I.args[0][0], k: I.args[0][1] }), why: () => 'Drop k smallest and k largest of the last m, floor the mean (−1 if too few).' }); }
  });

  D('seat-reservation-manager', {
    t: 'Seat Reservation Manager',
    r: 'A min-heap of unreserved seats (or a counter plus a heap of returned seats). reserve pops the smallest; unreserve pushes the seat back.',
    g: R => { const n = R.int(1, 6); return seq(R, 'SeatManager', [n], R.int(2, 9), (R, st) => { st.r = st.r || []; if (st.r.length && (st.r.length === n || R.chance(0.35))) { const s = R.pick(st.r); st.r = st.r.filter(x => x !== s); return ['unreserve', [s]]; } for (let i = 1; i <= n; i++) if (!st.r.includes(i)) { st.r.push(i); break; } return ['reserve', []]; }); },
    s(I, T) { return play(I, T, n => { const free = new Set([...Array(n).keys()].map(x => x + 1)); return { free, reserve() { const s = Math.min(...free); free.delete(s); return s; }, unreserve(s) { free.add(s); } }; }, { view: o => ({ free: A([...o.free].sort((a, b) => a - b)) }), why: () => 'Smallest free seat.' }); }
  });

  D('finding-pairs-with-a-certain-sum', {
    t: 'Finding Pairs With a Certain Sum',
    r: 'nums1 is small: keep a frequency map of nums2. add updates one nums2 value (adjusting the map); count(tot) sums freq2[tot − x] over x in nums1.',
    g: R => { const a = R.ints(R.int(1, 4), 1, 4), b = R.ints(R.int(1, 5), 1, 4); return seq(R, 'FindSumPairs', [a, b], R.int(2, 7), R => R.chance(0.5) ? ['add', [R.int(0, b.length - 1), R.int(1, 3)]] : ['count', [R.int(2, 9)]]); },
    s(I, T) { return play(I, T, (a, b0) => { const b = b0.slice(); return { b, add(i, v) { b[i] += v; }, count(t) { let c = 0; for (const x of a) for (const y of b) if (x + y === t) c++; return c; } }; }, { view: o => ({ nums1: A(I.args[0][0]), nums2: A(o.b.slice()) }), why: (op, [t]) => `Pairs (i, j) with nums1[i] + nums2[j] = ${t}.` }); }
  });

  D('design-movie-rental-system', {
    t: 'Design Movie Rental System',
    r: 'Per movie, an ordered set of unrented (price, shop); globally, an ordered set of rented (price, shop, movie). search returns the cheapest 5 shops; report the cheapest 5 rented entries; rent/drop move entries between sets.',
    g: R => { const n = R.int(1, 4), E = []; for (let s = 0; s < n; s++) for (let m = 1; m <= 3; m++) if (R.chance(0.6)) E.push([s, m, R.int(1, 6)]); if (!E.length) E.push([0, 1, 3]); return seq(R, 'MovieRentingSystem', [n, E], R.int(2, 8), (R, st) => { st.r = st.r || []; const un = E.filter(([s, m]) => !st.r.some(x => x[0] === s && x[1] === m)); const c = R.pick(['search', 'rent', 'drop', 'report']); if (c === 'rent' && un.length) { const [s, m] = R.pick(un); st.r.push([s, m]); return [c, [s, m]]; } if (c === 'drop' && st.r.length) { const x = R.pick(st.r); st.r = st.r.filter(y => y !== x); return [c, x.slice()]; } if (c === 'report') return [c, []]; return ['search', [R.int(1, 3)]]; }); },
    s(I, T) { return play(I, T, (n, E) => { const rented = new Set(), price = new Map(E.map(([s, m, p]) => [s + ',' + m, p])); return { rented, search(m) { return E.filter(([s, mm]) => mm === m && !rented.has(s + ',' + m)).sort((x, y) => x[2] - y[2] || x[0] - y[0]).slice(0, 5).map(x => x[0]); }, rent(s, m) { rented.add(s + ',' + m); }, drop(s, m) { rented.delete(s + ',' + m); }, report() { return [...rented].map(k => k.split(',').map(Number)).sort((x, y) => price.get(x.join()) - price.get(y.join()) || x[0] - y[0] || x[1] - y[1]).slice(0, 5); } }; }, { view: o => ({ copies: A(I.args[0][1].map(([s, m, p]) => `s${s} m${m} $${p}${o.rented.has(s + ',' + m) ? ' (out)' : ''}`)) }), why: op => op === 'search' ? 'Unrented copies: cheapest first, then lower shop; at most 5.' : 'Rented copies by price, shop, movie; at most 5.' }); }
  });

  D('operations-on-tree', {
    t: 'Operations on Tree',
    r: 'lock: only if unlocked. unlock: only by the same user. upgrade: node unlocked, no locked ancestor, at least one locked descendant — then unlock all descendants and lock the node.',
    g: R => { const n = R.int(2, 8); return seq(R, 'LockingTree', [[-1, ...Array.from({ length: n - 1 }, (_, i) => R.int(0, i))]], R.int(3, 10), R => [R.pick(['lock', 'lock', 'unlock', 'upgrade']), [R.int(0, n - 1), R.int(1, 3)]]); },
    s(I, T) { const p = I.args[0][0], n = p.length, ch = Array.from({ length: n }, () => []); p.forEach((x, i) => x >= 0 && ch[x].push(i)); return play(I, T, () => { const L = Array(n).fill(0); const desc = v => ch[v].flatMap(c => [c, ...desc(c)]); return { L, lock(v, u) { if (L[v]) return false; L[v] = u; return true; }, unlock(v, u) { if (L[v] !== u) return false; L[v] = 0; return true; }, upgrade(v, u) { if (L[v]) return false; for (let a = p[v]; a >= 0; a = p[a]) if (L[a]) return false; const d = desc(v).filter(x => L[x]); if (!d.length) return false; d.forEach(x => L[x] = 0); L[v] = u; return true; } }; }, { view: o => ({ tree: GR(n, p.map((x, i) => [x, i]).filter(e => e[0] >= 0), { dir: true }), lockedBy: A(o.L.map(x => x || '·')) }), why: op => ({ lock: 'Only if currently unlocked.', unlock: 'Only by the user who locked it.', upgrade: 'Unlocked, no locked ancestor, some locked descendant.' }[op]) }); }
  });
})();
