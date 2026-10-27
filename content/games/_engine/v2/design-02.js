/* v2 games: design (02). */
(function () {
  'use strict';
  const { D, A, G, K, S, Q, Tr, TR } = LCGame.H;
  const fmt = a => typeof a === 'string' ? JSON.stringify(a) : Array.isArray(a) ? JSON.stringify(a) : String(a);
  // Run a design problem: ops[0] constructs, the rest are method calls. Asks about returned values.
  const play = (I, T, make, o) => { o = o || {}; const obj = make(...(I.args[0] || [])), out = [null]; let asks = 0; const max = o.max || 7; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], args = I.args[i] || [], before = o.view ? o.view(obj) : {}; let r = obj[op](...args); if (r === undefined) r = null; out.push(r); if (asks >= max || r === null || (o.skip && o.skip(op))) continue; const label = `${op}(${args.map(fmt).join(', ')})`, why = o.why ? o.why(op, args, r, obj) : 'Follow the structure\'s invariant.'; if (typeof r === 'number' && Number.isFinite(r)) { T.at(Object.assign({ call: label }, before)); T.n(`What does ${label} return?`, r, why); asks++; } else if (typeof r === 'boolean') { T.at(Object.assign({ call: label }, before)); T.yn(`Does ${label} return true?`, r, why); asks++; } else if (typeof r === 'string') { const opts = [...new Set([r, ...(o.strOpts ? o.strOpts(obj, r) : []), r === '' ? 'null' : ''])].slice(0, 4); if (opts.length > 1) { T.at(Object.assign({ call: label }, before)); T.c(`What does ${label} return?`, opts.map(x => x === '' ? '""' : x), r === '' ? '""' : r, why); asks++; } } else if (Array.isArray(r)) { T.at(Object.assign({ call: label }, before)); T.n(`How many items does ${label} return?`, r.length, why); asks++; } } if (!asks) { T.at({ calls: I.ops.length - 1 }); T.n('How many method calls follow the constructor?', I.ops.length - 1, 'Count the operations.'); } return out; };
  // Build a random op sequence: step(R, st) returns [op, args] or null to stop.
  const seq = (R, ctor, ctorArgs, n, step, st) => { const ops = [ctor], args = [ctorArgs]; st = st || {}; for (let i = 0; i < n; i++) { const x = step(R, st); if (!x) break; ops.push(x[0]); args.push(x[1]); } return { ops, args }; };
  const rngOf = I => { let h = 2166136261; const s = JSON.stringify(I); for (let i = 0; i < s.length; i++) h = Math.imul(h ^ s.charCodeAt(i), 16777619) >>> 0; return () => { h = (h + 0x6D2B79F5) >>> 0; let t = h; t = Math.imul(t ^ (t >>> 15), t | 1); t ^= t + Math.imul(t ^ (t >>> 7), t | 61); return ((t ^ (t >>> 14)) >>> 0) / 4294967296; }; };
  const bstGen = R => { const root = Tr.from(R.tree(R.int(1, 8), 1, 9, 4)), nodes = [], ino = x => { if (!x) return; ino(x.left); nodes.push(x); ino(x.right); }; ino(root); const vals = R.distinct(nodes.length, 1, 30).sort((a, b) => a - b); nodes.forEach((x, i) => x.val = vals[i]); return root; };
  const multisetCmp = (o, e) => Array.isArray(o) && o.length === e.length && o.every((v, i) => Array.isArray(e[i]) ? Array.isArray(v) && JSON.stringify(v.slice().sort()) === JSON.stringify(e[i].slice().sort()) : JSON.stringify(v) === JSON.stringify(e[i]));
  const calGen = R => seq(R, 'MyCalendar', [], R.int(3, 8), R => { const s = R.int(0, 20); return ['book', [s, s + R.int(1, 8)]]; });

  D('serialize-and-deserialize-bst', {
    t: 'Serialize and Deserialize BST',
    r: 'A BST is fixed by its preorder alone, so write only the values (no null markers). To rebuild, read values recursively with (low, high) bounds: a value outside the bounds belongs to an ancestor\'s other side.',
    g: R => ({ root: R.chance(0.1) ? [] : Tr.arr(bstGen(R)) }),
    s(I, T) { const res = (() => { const root = Tr.from(I.root), pre = []; const go = n => { if (!n) return; pre.push(n.val); go(n.left); go(n.right); }; go(root); T.at({ tree: root ? TR(root) : 'empty', preorder: A(pre) }); T.n('How many tokens are written?', pre.length, 'One per node; no null markers are needed.'); T.yn('Is the tree empty?', !root, 'Then the string is empty.'); if (pre.length > 1) { const lefts = pre.slice(1).filter(v => v < pre[0]).length; T.n('How many values belong to the root\'s left subtree?', lefts, `Values below ${pre[0]}.`); } return Tr.arr(root); })(); T.n('Nodes after decoding?', res.filter(v => v !== null).length, 'Same as the tokens.'); return res; }
  });

  D('lfu-cache', {
    t: 'LFU Cache',
    r: 'Track each key\'s use count and recency. On overflow evict the key with the smallest count, breaking ties by least recently used. O(1) versions keep a list of keys per count plus the current minimum count.',
    g: R => seq(R, 'LFUCache', [R.int(1, 3)], R.int(4, 10), R => R.chance(0.5) ? ['put', [R.int(1, 4), R.int(1, 9)]] : ['get', [R.int(1, 4)]]),
    s(I, T) { return play(I, T, cap => { const m = new Map(); let t = 0; return { m, get(k) { if (!m.has(k)) return -1; const e = m.get(k); e.f++; e.t = t++; return e.v; }, put(k, v) { if (!cap) return; if (m.has(k)) { const e = m.get(k); e.v = v; e.f++; e.t = t++; return; } if (m.size >= cap) { let b = null; for (const [kk, e] of m) if (!b || e.f < m.get(b).f || (e.f === m.get(b).f && e.t < m.get(b).t)) b = kk; m.delete(b); } m.set(k, { v, f: 1, t: t++ }); } }; }, { view: o => ({ cache: A([...o.m].map(([k, e]) => `${k}:${e.v} (×${e.f})`)) }), why: () => 'Missing → −1; hits raise the use count.' }); }
  });

  D('generate-random-point-in-a-circle', {
    t: 'Generate Random Point in a Circle',
    r: 'Pick an angle uniformly and a radius r = R·√u (u uniform in [0, 1]). The square root spreads points evenly by area; a plain uniform radius would crowd the center.',
    g: R => seq(R, 'Solution', [R.int(1, 5), R.int(-3, 3), R.int(-3, 3)], R.int(1, 4), () => ['randPoint', []]),
    cmp: (o, e, I) => { const [r, x, y] = I.args[0]; return Array.isArray(o) && o.length === e.length && o.slice(1).every(p => Array.isArray(p) && (p[0] - x) ** 2 + (p[1] - y) ** 2 <= r * r + 1e-9); },
    s(I, T) { const [rad, x, y] = I.args[0], rnd = rngOf(I); T.at({ radius: rad, center: `${x}, ${y}` }); T.n('Points requested?', I.ops.filter(o => o === 'randPoint').length, 'One per randPoint call.'); T.n('Area of the circle, rounded down?', Math.floor(Math.PI * rad * rad), 'Pi times r squared.'); T.c('Which radius sampling is uniform by area?', ['R times the square root of u', 'R times u', 'R times u squared'], 'R times the square root of u', 'Area grows with r squared, so take the square root.'); return play(I, T, () => ({ randPoint() { const a = rnd() * 2 * Math.PI, r = rad * Math.sqrt(rnd()); return [x + r * Math.cos(a), y + r * Math.sin(a)]; } }), { skip: () => true, max: 0 }); }
  });

  D('random-point-in-non-overlapping-rectangles', {
    t: 'Random Point in Non-overlapping Rectangles',
    r: 'Weight each rectangle by its number of integer points, (x2 − x1 + 1)(y2 − y1 + 1). Pick a random point index, binary search the prefix sums for its rectangle, and map the offset to coordinates.',
    g: R => { const rects = []; let x = 0; for (let i = 0; i < R.int(1, 3); i++) { const w = R.int(0, 2), h = R.int(0, 2), y = R.int(-2, 2); rects.push([x, y, x + w, y + h]); x += w + 2; } return seq(R, 'Solution', [rects], R.int(1, 4), () => ['pick', []]); },
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && o.slice(1).every(p => Array.isArray(p) && I.args[0][0].some(([a, b, c, d]) => p[0] >= a && p[0] <= c && p[1] >= b && p[1] <= d && Number.isInteger(p[0]) && Number.isInteger(p[1]))),
    s(I, T) { const rects = I.args[0][0], cnt = rects.map(([a, b, c, d]) => (c - a + 1) * (d - b + 1)), P = []; cnt.reduce((s, c) => (P.push(s + c), s + c), 0); const rnd = rngOf(I); T.at({ rects: A(rects.map(r => r.join(', '))), points: A(cnt) }); T.n('Integer points in the first rectangle?', cnt[0], '(x2 minus x1 plus 1) times (y2 minus y1 plus 1).'); T.n('Integer points in total?', P[P.length - 1], 'Pick by prefix sums of the counts.'); T.n('Picks requested?', I.ops.filter(o => o === 'pick').length, 'One per pick call.'); return play(I, T, () => ({ pick() { let k = Math.floor(rnd() * P[P.length - 1]), i = 0; while (k >= P[i]) i++; k -= i ? P[i - 1] : 0; const [a, b, c] = rects[i], w = c - a + 1; return [a + k % w, b + Math.floor(k / w)]; } }), { skip: () => true, max: 0 }); }
  });

  D('random-flip-matrix', {
    t: 'Random Flip Matrix',
    r: 'Treat cells as indices 0..m·n − 1. Pick a random index among the first `remaining`, return the cell it maps to (a hash map remembers swaps), then map it to the last free index and shrink. reset clears the map.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3), ops = ['Solution'], args = [[m, n]]; let left = m * n; for (let i = 0; i < R.int(2, 6); i++) { if (left && R.chance(0.75)) { ops.push('flip'); left--; } else { ops.push('reset'); left = m * n; } args.push([]); } return { ops, args }; },
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== e.length) return false; const [m, n] = I.args[0]; let seen = new Set(); for (let i = 1; i < I.ops.length; i++) { if (I.ops[i] === 'reset') { seen = new Set(); continue; } const p = o[i]; if (!Array.isArray(p) || p[0] < 0 || p[1] < 0 || p[0] >= m || p[1] >= n || seen.has(p.join())) return false; seen.add(p.join()); } return true; },
    s(I, T) { const [m, n] = I.args[0], rnd = rngOf(I); T.at({ rows: m, cols: n }); T.n('Cells available before any flip?', m * n, 'm times n.'); T.n('Flips requested?', I.ops.filter(o => o === 'flip').length, 'Each one removes a cell.'); T.n('Resets?', I.ops.filter(o => o === 'reset').length, 'Each one restores every cell.'); return play(I, T, () => { let left = m * n, map = new Map(); return { flip() { const k = Math.floor(rnd() * left--), v = map.has(k) ? map.get(k) : k; map.set(k, map.has(left) ? map.get(left) : left); return [Math.floor(v / n), v % n]; }, reset() { left = m * n; map = new Map(); } }; }, { skip: () => true, max: 0 }); }
  });

  D('random-pick-with-weight', {
    t: 'Random Pick With Weight',
    r: 'Prefix sums of weights split [0, total) into slots. Draw a random number in that range and binary search the first prefix sum above it.',
    g: R => seq(R, 'Solution', [R.ints(R.int(1, 4), 1, 5)], R.int(1, 4), () => ['pickIndex', []]),
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && o.slice(1).every(v => Number.isInteger(v) && v >= 0 && v < I.args[0][0].length),
    s(I, T) { const w = I.args[0][0], P = []; w.reduce((s, x) => (P.push(s + x), s + x), 0); const rnd = rngOf(I); T.at({ w: A(w), prefix: A(P) }); T.n('Total weight (range of the random draw)?', P[P.length - 1], 'Sum of weights.'); if (w.length > 1) T.n('A draw of 0 (in [0, total)) lands on which index?', 0, 'First prefix sum greater than the draw.'); return play(I, T, () => ({ pickIndex() { const x = rnd() * P[P.length - 1]; let lo = 0, hi = P.length - 1; while (lo < hi) { const md = (lo + hi) >> 1; if (P[md] > x) hi = md; else lo = md + 1; } return lo; } }), { skip: () => true, max: 0 }); }
  });

  D('encode-and-decode-tinyurl', {
    t: 'Encode and Decode TinyURL',
    r: 'Keep two maps: long → code and code → long. Encode assigns the next id (base-62 text) to new URLs; decode looks the code up.',
    g: R => ({ url: 'https://leetcode.com/problems/' + R.str(R.int(3, 8), 'abcxyz') }),
    s(I, T) { const res = (() => { const al = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', b62 = n => { let s = ''; do { s = al[n % 62] + s; n = Math.floor(n / 62); } while (n); return s; }; const code = b62(1); T.at({ url: I.url }); T.c('Code given to the first URL (id 1 in base 62)?', ['1', '0', 'a'], code, 'The counter starts at 1.'); T.yn('Does decoding look the code up in a map?', true, 'It maps each code to its long URL.'); return I.url; })(); T.n('Length of the decoded URL?', res.length, 'Exactly the original.'); return res; }
  });

  D('design-in-memory-file-system', {
    t: 'Design In-Memory File System',
    r: 'A trie of path parts; each node is a directory (children map) or a file (content). ls on a file returns its name; on a directory, its sorted children. mkdir and addContentToFile create missing parts.',
    g: R => { const paths = ['/a', '/a/b', '/c'], files = ['/a/f', '/a/b/g', '/h']; const g = seq(R, 'FileSystem', [], R.int(3, 8), (R, st) => { st.f = st.f || []; const c = R.pick(['ls', 'mkdir', 'addContentToFile', 'readContentFromFile']); if (c === 'mkdir') return [c, [R.pick(paths)]]; if (c === 'addContentToFile') { const f = R.pick(files); st.f.push(f); return [c, [f, R.str(R.int(1, 3), 'xy')]]; } if (c === 'readContentFromFile') return st.f.length ? [c, [R.pick(st.f)]] : ['ls', ['/']]; return [c, [R.pick(['/', ...paths, ...st.f])]]; }); return g; },
    s(I, T) { return play(I, T, () => { const root = { d: {} }; const walk = (p, mk) => { let n = root; for (const x of p.split('/').filter(Boolean)) { if (!n.d[x]) { if (!mk) return null; n.d[x] = { d: {} }; } n = n.d[x]; } return n; }; return { root, ls(p) { const n = walk(p, false); if (!n) return []; if (n.f !== undefined) return [p.split('/').pop()]; return Object.keys(n.d).sort(); }, mkdir(p) { walk(p, true); }, addContentToFile(p, c) { const n = walk(p, true); n.f = (n.f || '') + c; }, readContentFromFile(p) { return walk(p, false).f; } }; }, { view: o => { const out = []; const go = (n, p) => { for (const k of Object.keys(n.d).sort()) { const c = n.d[k]; out.push(p + '/' + k + (c.f !== undefined ? ` = "${c.f}"` : '/')); go(c, p + '/' + k); } }; go(o.root, ''); return { tree: A(out.length ? out : ['(empty)']) }; }, strOpts: (o, r) => [r + r.slice(-1), r.slice(1)], why: op => op === 'ls' ? 'File → its own name; directory → sorted children.' : 'Accumulated content of the file.' }); }
  });

  D('range-addition-ii', {
    t: 'Range Addition II',
    r: 'Every op increments the top-left a × b block, so the cells hit by all ops form the block min(a) × min(b). Those cells hold the maximum.',
    g: R => { const m = R.int(1, 5), n = R.int(1, 5); return { m, n, ops: Array.from({ length: R.int(0, 4) }, () => [R.int(1, m), R.int(1, n)]) }; },
    s(I, T) { let a = I.m, b = I.n; I.ops.forEach(([x, y], i) => { a = Math.min(a, x); b = Math.min(b, y); if (i < 4) { T.at({ op: `${x}×${y}`, overlap: `${a}×${b}` }); T.n('Rows of the overlap so far?', a, 'min of the a values.'); } }); if (!I.ops.length) { T.at({ m: I.m, n: I.n }); T.n('Cells with the max (no ops)?', I.m * I.n, 'Everything is 0.'); } return a * b; }
  });

  D('design-compressed-string-iterator', {
    t: 'Design Compressed String Iterator',
    r: 'Parse the string into (letter, count) runs. next() returns the current letter and decrements its count (moving to the next run at 0); a space when exhausted. hasNext() checks for remaining letters.',
    g: R => { const s = Array.from({ length: R.int(1, 3) }, () => R.pick('abcL') + R.int(1, 3)).join(''); return seq(R, 'StringIterator', [s], R.int(2, 8), R => [R.pick(['next', 'next', 'hasNext']), []]); },
    s(I, T) { const runs = [...I.args[0][0].matchAll(/([^\d])(\d+)/g)].map(m => [m[1], +m[2]]); return play(I, T, () => { let i = 0; return { runs, get i() { return i; }, next() { while (i < runs.length && !runs[i][1]) i++; if (i >= runs.length) return ' '; runs[i][1]--; return runs[i][0]; }, hasNext() { while (i < runs.length && !runs[i][1]) i++; return i < runs.length; } }; }, { view: o => ({ runs: A(o.runs.map(([c, k]) => c + k), { i: o.i }) }), strOpts: () => [' ', ...runs.map(r => r[0])], why: op => op === 'next' ? 'Current run\'s letter (space if done).' : 'Any letters left?' }); }
  });

  D('design-circular-queue', {
    t: 'Design Circular Queue',
    r: 'A fixed array with a head index and a size. enQueue writes at (head + size) mod k; deQueue advances head. Front is a[head], Rear is a[(head + size − 1) mod k].',
    g: R => seq(R, 'MyCircularQueue', [R.int(1, 3)], R.int(4, 10), R => R.pick([['enQueue', [R.int(1, 9)]], ['enQueue', [R.int(1, 9)]], ['deQueue', []], ['Front', []], ['Rear', []], ['isEmpty', []], ['isFull', []]])),
    s(I, T) { return play(I, T, k => { const a = Array(k).fill('·'); let h = 0, n = 0; return { a, get h() { return h; }, enQueue(x) { if (n === k) return false; a[(h + n++) % k] = x; return true; }, deQueue() { if (!n) return false; a[h] = '·'; h = (h + 1) % k; n--; return true; }, Front() { return n ? a[h] : -1; }, Rear() { return n ? a[(h + n - 1) % k] : -1; }, isEmpty() { return !n; }, isFull() { return n === k; } }; }, { view: o => ({ buffer: A(o.a.slice(), { head: o.h }) }), why: op => ({ enQueue: 'False when full.', deQueue: 'False when empty.', Front: 'a[head] or −1.', Rear: 'Last written slot or −1.' }[op] || 'Compare size with 0 or k.') }); }
  });

  D('design-excel-sum-formula', {
    t: 'Design Excel Sum Formula',
    r: 'Each cell holds a number or a formula: a multiset of referenced cells. get evaluates recursively (sum of referenced cells\' values), so formulas update automatically. set replaces a formula with a constant.',
    g: R => { const H = R.int(2, 3), W = 'B', cells = []; for (let r = 1; r <= H; r++) for (const c of 'AB') cells.push(c + r); return seq(R, 'Excel', [H, W], R.int(3, 7), (R, st) => { st.f = st.f || new Set(); const c = R.pick(['set', 'set', 'get', 'sum']), r = R.int(1, H), col = R.pick('AB'), me = col + r; if (c === 'set') { st.f.delete(me); return [c, [r, col, R.int(0, 9)]]; } if (c === 'get') return [c, [r, col]]; const refs = Array.from({ length: R.int(1, 2) }, () => R.pick(cells.filter(x => x !== me && !st.f.has(x)))).filter(Boolean); if (!refs.length) return ['get', [r, col]]; st.f.add(me); return [c, [r, col, refs]]; }); },
    s(I, T) { return play(I, T, (H, W) => { const cell = {}; const val = k => { const c = cell[k]; if (!c) return 0; if (typeof c === 'number') return c; let s = 0; for (const [ref, m] of c) s += val(ref) * m; return s; }; return { cell, set(r, c, v) { cell[c + r] = v; }, get(r, c) { return val(c + r); }, sum(r, c, strs) { const f = new Map(); for (const s of strs) { const [a, b] = s.split(':'), b2 = b || a; for (let col = a.charCodeAt(0); col <= b2.charCodeAt(0); col++) for (let row = +a.slice(1); row <= +b2.slice(1); row++) { const k = String.fromCharCode(col) + row; f.set(k, (f.get(k) || 0) + 1); } } cell[c + r] = f; return val(c + r); } }; }, { view: o => ({ cells: K(Object.fromEntries(Object.entries(o.cell).map(([k, v]) => [k, typeof v === 'number' ? v : '=' + [...v].map(([x, m]) => m > 1 ? `${m}×${x}` : x).join('+')]))) }), why: () => 'Constants, or the sum of referenced cells (recursively).' }); }
  });

  D('design-log-storage-system', {
    t: 'Design Log Storage System',
    r: 'Timestamps are fixed-width "Y:M:D:H:m:s" strings. For a granularity, compare only the prefix up to that unit: a log matches if start-prefix ≤ its prefix ≤ end-prefix.',
    g: R => { const ts = () => ['2016', '2017'][R.int(0, 1)] + ':0' + R.int(1, 2) + ':0' + R.int(1, 2) + ':' + String(R.int(0, 23)).padStart(2, '0') + ':00:00'; let id = 1; return seq(R, 'LogSystem', [], R.int(3, 7), R => R.chance(0.6) ? ['put', [id++, ts()]] : (() => { const a = ts(), b = ts(); return ['retrieve', [a < b ? a : b, a < b ? b : a, R.pick(['Year', 'Month', 'Day', 'Hour'])]]; })()); },
    cmp: multisetCmp,
    s(I, T) { const L = { Year: 4, Month: 7, Day: 10, Hour: 13, Minute: 16, Second: 19 }; return play(I, T, () => { const logs = []; return { logs, put(id, t) { logs.push([id, t]); }, retrieve(a, b, g) { const k = L[g]; return logs.filter(([, t]) => t.slice(0, k) >= a.slice(0, k) && t.slice(0, k) <= b.slice(0, k)).map(x => x[0]); } }; }, { view: o => ({ logs: A(o.logs.map(([i, t]) => `${i}@${t}`)) }), why: (op, [a, b, g]) => `Compare the first ${L[g]} characters.` }); }
  });

  D('design-circular-deque', {
    t: 'Design Circular Deque',
    r: 'A fixed array with head index and size. insertFront moves head back one (mod k); insertLast writes at head + size. getFront/getRear read the ends; −1 when empty.',
    g: R => seq(R, 'MyCircularDeque', [R.int(1, 3)], R.int(4, 10), R => R.pick([['insertFront', [R.int(1, 9)]], ['insertLast', [R.int(1, 9)]], ['deleteFront', []], ['deleteLast', []], ['getFront', []], ['getRear', []], ['isEmpty', []], ['isFull', []]])),
    s(I, T) { return play(I, T, k => { const d = []; return { d, insertFront(x) { if (d.length === k) return false; d.unshift(x); return true; }, insertLast(x) { if (d.length === k) return false; d.push(x); return true; }, deleteFront() { if (!d.length) return false; d.shift(); return true; }, deleteLast() { if (!d.length) return false; d.pop(); return true; }, getFront() { return d.length ? d[0] : -1; }, getRear() { return d.length ? d[d.length - 1] : -1; }, isEmpty() { return !d.length; }, isFull() { return d.length === k; } }; }, { view: o => ({ deque: A(o.d.slice()) }), why: op => /insert/.test(op) ? 'False when full.' : /delete/.test(op) ? 'False when empty.' : 'Read the end (−1 if empty) or compare size.' }); }
  });

  D('design-search-autocomplete-system', {
    t: 'Design Search Autocomplete System',
    r: 'Keep sentence counts (a trie in the real thing). Each typed character extends the prefix; return the top 3 sentences with that prefix by count, then alphabetically. "#" saves the sentence and resets.',
    g: R => { const base = ['ab', 'abc', 'b a', 'aab'], times = base.map(() => R.int(1, 4)), g = seq(R, 'AutocompleteSystem', [base, times], R.int(2, 7), R => ['input', [R.pick(['a', 'a', 'b', 'c', ' ', '#'])]]); return g; },
    s(I, T) { return play(I, T, (sent, times) => { const c = new Map(sent.map((s, i) => [s, times[i]])); let cur = ''; return { c, get cur() { return cur; }, input(ch) { if (ch === '#') { c.set(cur, (c.get(cur) || 0) + 1); cur = ''; return []; } cur += ch; return [...c.keys()].filter(s => s.startsWith(cur)).sort((a, b) => c.get(b) - c.get(a) || (a < b ? -1 : 1)).slice(0, 3); } }; }, { view: o => ({ typed: JSON.stringify(o.cur), counts: K(Object.fromEntries(o.c)) }), why: () => 'Top 3 by count, then ASCII order.' }); }
  });

  D('implement-magic-dictionary', {
    t: 'Implement Magic Dictionary',
    r: 'search(word) is true if some dictionary word has the same length and differs in exactly one position. (Bucketing by "wildcard" patterns like "h*llo" makes this fast.)',
    g: R => { const dict = [...new Set(Array.from({ length: R.int(1, 4) }, () => R.str(R.int(2, 3), 'ab')))]; const g = seq(R, 'MagicDictionary', [], R.int(1, 4), R => ['search', [R.str(R.int(2, 3), 'abc')]]); g.ops.splice(1, 0, 'buildDict'); g.args.splice(1, 0, [dict]); return g; },
    s(I, T) { return play(I, T, () => { let d = []; return { buildDict(x) { d = x; }, get d() { return d; }, search(w) { return d.some(x => x.length === w.length && [...x].filter((ch, i) => ch !== w[i]).length === 1); } }; }, { view: o => ({ dict: A(o.d) }), why: () => 'Exactly one differing position with a same-length word.' }); }
  });

  D('map-sum-pairs', {
    t: 'Map Sum Pairs',
    r: 'Store key → value. A trie node keeps the sum of values of keys below it; inserting adds the delta (new − old value) along the path. sum(prefix) reads the node\'s total.',
    g: R => seq(R, 'MapSum', [], R.int(3, 8), R => R.chance(0.55) ? ['insert', [R.str(R.int(1, 3), 'ab'), R.int(1, 9)]] : ['sum', [R.str(R.int(1, 2), 'ab')]]),
    s(I, T) { return play(I, T, () => { const m = new Map(); return { m, insert(k, v) { m.set(k, v); }, sum(p) { let s = 0; for (const [k, v] of m) if (k.startsWith(p)) s += v; return s; } }; }, { view: o => ({ map: K(Object.fromEntries(o.m)) }), why: (op, [p]) => `Sum of values of keys starting with "${p}" (re-inserts overwrite).` }); }
  });

  D('design-hashset', {
    t: 'Design HashSet',
    r: 'An array of buckets indexed by key mod size; each bucket is a small list. add appends if absent, remove deletes, contains scans the key\'s bucket.',
    g: R => seq(R, 'MyHashSet', [], R.int(4, 9), R => [R.pick(['add', 'add', 'remove', 'contains']), [R.int(0, 12)]]),
    s(I, T) { return play(I, T, () => { const b = Array.from({ length: 5 }, () => []); return { b, add(k) { if (!b[k % 5].includes(k)) b[k % 5].push(k); }, remove(k) { b[k % 5] = b[k % 5].filter(x => x !== k); }, contains(k) { return b[k % 5].includes(k); } }; }, { view: o => ({ buckets: A(o.b.map(x => x.join(',') || '∅')) }), why: (op, [k]) => `Look in bucket ${k % 5}.` }); }
  });

  D('design-hashmap', {
    t: 'Design HashMap',
    r: 'Buckets indexed by key mod size holding [key, value] pairs. put updates or appends; get scans the bucket (−1 if absent); remove deletes the pair.',
    g: R => seq(R, 'MyHashMap', [], R.int(4, 9), R => R.pick([['put', [R.int(0, 12), R.int(0, 9)]], ['put', [R.int(0, 12), R.int(0, 9)]], ['get', [R.int(0, 12)]], ['remove', [R.int(0, 12)]]])),
    s(I, T) { return play(I, T, () => { const b = Array.from({ length: 5 }, () => []); return { b, put(k, v) { const p = b[k % 5].find(x => x[0] === k); if (p) p[1] = v; else b[k % 5].push([k, v]); }, get(k) { const p = b[k % 5].find(x => x[0] === k); return p ? p[1] : -1; }, remove(k) { b[k % 5] = b[k % 5].filter(x => x[0] !== k); } }; }, { view: o => ({ buckets: A(o.b.map(x => x.map(p => p.join(':')).join(',') || '∅')) }), why: (op, [k]) => `Bucket ${k % 5}; −1 if missing.` }); }
  });

  D('design-linked-list', {
    t: 'Design Linked List',
    r: 'Use a dummy head and a size counter. Walk index steps from the dummy to reach the node before a position. Out-of-range indices: get returns −1, insert/delete do nothing (index = size inserts at the tail).',
    g: R => seq(R, 'MyLinkedList', [], R.int(4, 10), R => R.pick([['addAtHead', [R.int(1, 9)]], ['addAtTail', [R.int(1, 9)]], ['addAtIndex', [R.int(0, 3), R.int(1, 9)]], ['get', [R.int(0, 3)]], ['deleteAtIndex', [R.int(0, 3)]]])),
    s(I, T) { T.at({ calls: I.ops.length - 1 }); T.n('Operations after the constructor?', I.ops.length - 1, 'Count the calls.'); return play(I, T, () => { const a = []; return { a, get(i) { return i < a.length ? a[i] : -1; }, addAtHead(v) { a.unshift(v); }, addAtTail(v) { a.push(v); }, addAtIndex(i, v) { if (i <= a.length) a.splice(i, 0, v); }, deleteAtIndex(i) { if (i < a.length) a.splice(i, 1); } }; }, { view: o => ({ list: A(o.a.slice()) }), why: (op, [i]) => `Node at index ${i}, or −1 past the end.` }); }
  });

  D('random-pick-with-blacklist', {
    t: 'Random Pick With Blacklist',
    r: 'Let k = n − |blacklist|. Pick uniformly in [0, k). Blacklisted numbers below k are remapped to the allowed numbers ≥ k, so every pick is one lookup.',
    g: R => { const n = R.int(2, 8), bl = R.distinct(R.int(0, n - 2), 0, n - 1); return seq(R, 'Solution', [n, bl], R.int(1, 5), () => ['pick', []]); },
    cmp: (o, e, I) => { const [n, bl] = I.args[0]; return Array.isArray(o) && o.length === e.length && o.slice(1).every(v => Number.isInteger(v) && v >= 0 && v < n && !bl.includes(v)); },
    s(I, T) { const [n, bl] = I.args[0], k = n - bl.length, B = new Set(bl), map = new Map(); let w = k; for (const b of bl) if (b < k) { while (B.has(w)) w++; map.set(b, w++); } const rnd = rngOf(I); T.at({ n, blacklist: A(bl) }); T.n('Size of the pick range k?', k, 'n − blacklist size.'); T.n('Blacklisted numbers that need a remap (< k)?', map.size, 'Those inside [0, k).'); return play(I, T, () => ({ pick() { const x = Math.floor(rnd() * k); return map.has(x) ? map.get(x) : x; } }), { skip: () => true, max: 0 }); }
  });

  D('range-module', {
    t: 'Range Module',
    r: 'Keep sorted disjoint half-open intervals. addRange merges overlaps/touching ones; removeRange cuts intervals around [l, r); queryRange checks one interval covers [l, r) entirely.',
    g: R => seq(R, 'RangeModule', [], R.int(3, 8), R => { const l = R.int(1, 15), r = l + R.int(1, 6); return [R.pick(['addRange', 'addRange', 'removeRange', 'queryRange', 'queryRange']), [l, r]]; }),
    s(I, T) { return play(I, T, () => { let iv = []; return { get iv() { return iv; }, addRange(l, r) { const out = []; for (const [a, b] of iv) { if (b < l || a > r) out.push([a, b]); else { l = Math.min(l, a); r = Math.max(r, b); } } out.push([l, r]); iv = out.sort((x, y) => x[0] - y[0]); }, removeRange(l, r) { const out = []; for (const [a, b] of iv) { if (b <= l || a >= r) { out.push([a, b]); continue; } if (a < l) out.push([a, l]); if (b > r) out.push([r, b]); } iv = out; }, queryRange(l, r) { return iv.some(([a, b]) => a <= l && r <= b); } }; }, { view: o => ({ intervals: A(o.iv.map(([a, b]) => `[${a},${b})`)) }), why: (op, [l, r]) => `Is [${l},${r}) inside a single tracked interval?` }); }
  });

  D('max-stack', {
    t: 'Max Stack',
    r: 'Keep the stack plus an ordered structure of (value, push id). top/pop use the stack; peekMax reads the largest (latest on ties); popMax removes that entry from both (lazy deletion works too).',
    g: R => seq(R, 'MaxStack', [], R.int(4, 10), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['push', 'pop', 'top', 'peekMax', 'popMax']) : 'push'; if (c === 'push') { st.n++; return [c, [R.int(1, 6)]]; } if (c === 'pop' || c === 'popMax') st.n--; return [c, []]; }),
    s(I, T) { return play(I, T, () => { const s = []; const mi = () => { let b = -1; s.forEach((x, i) => { if (b < 0 || x >= s[b]) b = i; }); return b; }; return { s, push(x) { s.push(x); }, pop() { return s.pop(); }, top() { return s[s.length - 1]; }, peekMax() { return s[mi()]; }, popMax() { return s.splice(mi(), 1)[0]; } }; }, { view: o => ({ stack: S(o.s.slice()) }), why: op => /Max/.test(op) ? 'Largest value; the topmost one on ties.' : 'Top of the stack.' }); }
  });

  D('my-calendar-i', {
    t: 'My Calendar I',
    r: 'Keep booked intervals (sorted). A new [s, e) conflicts with [a, b) iff s < b and a < e. Book only if it conflicts with none.',
    g: calGen,
    s(I, T) { return play(I, T, () => { const b = []; return { b, book(s, e) { if (b.some(([x, y]) => s < y && x < e)) return false; b.push([s, e]); return true; } }; }, { view: o => ({ booked: A(o.b.slice().sort((x, y) => x[0] - y[0]).map(([x, y]) => `[${x},${y})`)) }), why: () => 'Overlap test: s < b and a < e.' }); }
  });

  D('my-calendar-ii', {
    t: 'My Calendar II',
    r: 'Keep all bookings and the overlaps between them. A new event fails if it intersects any existing overlap (triple booking); otherwise add its intersections with bookings to the overlap list.',
    g: R => { const g = calGen(R); g.ops[0] = 'MyCalendarTwo'; return g; },
    s(I, T) { return play(I, T, () => { const b = [], ov = []; return { b, ov, book(s, e) { if (ov.some(([x, y]) => s < y && x < e)) return false; for (const [x, y] of b) if (s < y && x < e) ov.push([Math.max(s, x), Math.min(e, y)]); b.push([s, e]); return true; } }; }, { view: o => ({ booked: A(o.b.map(([x, y]) => `[${x},${y})`)), doubleBooked: A(o.ov.map(([x, y]) => `[${x},${y})`)) }), why: () => 'Fails only if it hits a double-booked stretch.' }); }
  });

  D('my-calendar-iii', {
    t: 'My Calendar III',
    r: 'Sweep line: +1 at each start, −1 at each end (a sorted map). After each booking, the running maximum of the prefix sums is the largest k-booking.',
    g: R => { const g = calGen(R); g.ops[0] = 'MyCalendarThree'; return g; },
    s(I, T) { return play(I, T, () => { const d = new Map(); return { d, book(s, e) { d.set(s, (d.get(s) || 0) + 1); d.set(e, (d.get(e) || 0) - 1); let c = 0, best = 0; for (const k of [...d.keys()].sort((a, b) => a - b)) { c += d.get(k); best = Math.max(best, c); } return best; } }; }, { view: o => ({ deltas: K(Object.fromEntries([...o.d].sort((a, b) => a[0] - b[0]))) }), why: () => 'Max running sum of the sweep deltas.' }); }
  });

  D('prefix-and-suffix-search', {
    t: 'Prefix and Suffix Search',
    r: 'For every word and each of its suffixes, insert "suffix#word" into a trie whose nodes keep the largest index. Query f(p, s) walks "s#p" and reads that index (−1 if missing).',
    g: R => { const words = Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 3), 'ab')); return seq(R, 'WordFilter', [words], R.int(1, 4), R => ['f', [R.str(R.int(0, 2), 'ab'), R.str(R.int(0, 2), 'ab')]]); },
    s(I, T) { const words = I.args[0][0]; return play(I, T, () => ({ f(p, s) { for (let i = words.length - 1; i >= 0; i--) if (words[i].startsWith(p) && words[i].endsWith(s)) return i; return -1; } }), { view: () => ({ words: A(words) }), why: (op, [p, s]) => `Largest index starting with "${p}" and ending with "${s}".` }); }
  });

  D('exam-room', {
    t: 'Exam Room',
    r: 'Keep occupied seats sorted. seat() compares the gap before the first student (to seat 0), each middle gap (its midpoint), and the gap after the last (seat n − 1), picking the largest distance and the lowest index on ties.',
    g: R => { const n = R.int(1, 10); return seq(R, 'ExamRoom', [n], R.int(2, 8), (R, st) => { st.s = st.s || []; if (st.s.length && (st.s.length === n || R.chance(0.3))) { const p = R.pick(st.s); st.s = st.s.filter(x => x !== p); return ['leave', [p]]; } st.s.push(-1); st.s = st.s.filter(x => x >= 0); return ['seat', []]; }); },
    s(I, T) { return play(I, T, n => { const s = []; return { s, seat() { let best = 0, d = s.length ? s[0] : Infinity; for (let i = 0; i + 1 < s.length; i++) { const m = Math.floor((s[i] + s[i + 1]) / 2); if (m - s[i] > d) { d = m - s[i]; best = m; } } if (s.length && n - 1 - s[s.length - 1] > d) best = n - 1; s.push(best); s.sort((a, b) => a - b); return best; }, leave(p) { s.splice(s.indexOf(p), 1); } }; }, { view: o => ({ seats: A([...Array(I.args[0][0]).keys()].map(i => o.s.includes(i) ? '●' : '·')) }), why: () => 'Farthest from neighbors; lowest seat on ties.' }); }
  });

  D('maximum-frequency-stack', {
    t: 'Maximum Frequency Stack',
    r: 'freq[x] counts pushes of x; group[f] is a stack of values that reached frequency f. pop takes from the highest group (most recent among the most frequent) and lowers its frequency.',
    g: R => seq(R, 'FreqStack', [], R.int(4, 10), (R, st) => { st.n = st.n || 0; if (!st.n || R.chance(0.6)) { st.n++; return ['push', [R.int(1, 4)]]; } st.n--; return ['pop', []]; }),
    s(I, T) { return play(I, T, () => { const f = new Map(), g = []; return { g, push(x) { const c = (f.get(x) || 0) + 1; f.set(x, c); (g[c] = g[c] || []).push(x); }, pop() { const top = g[g.length - 1], x = top.pop(); if (!top.length) g.pop(); f.set(x, f.get(x) - 1); return x; } }; }, { view: o => ({ groups: A(o.g.slice(1).map((s, i) => `f${i + 1}: ${s.join(',')}`)) }), why: () => 'Top of the highest-frequency group.' }); }
  });

  D('rle-iterator', {
    t: 'RLE Iterator',
    r: 'Walk the (count, value) pairs with a pointer. next(n) consumes n items: skip whole pairs whose remaining count is too small; return the value where the n-th item lands, or −1 if exhausted.',
    g: R => { const enc = Array.from({ length: R.int(1, 3) }, () => [R.int(0, 3), R.int(1, 9)]).flat(); return seq(R, 'RLEIterator', [enc], R.int(1, 5), R => ['next', [R.int(1, 3)]]); },
    s(I, T) { const e = I.args[0][0].slice(); return play(I, T, () => { let i = 0; return { get i() { return i; }, next(n) { while (i < e.length && e[i] < n) { n -= e[i]; i += 2; } if (i >= e.length) return -1; e[i] -= n; return e[i + 1]; } }; }, { view: o => ({ encoding: A(e.slice(), { i: o.i }) }), why: () => 'Skip exhausted pairs; −1 if we run out.' }); }
  });

  D('online-election', {
    t: 'Online Election',
    r: 'Precompute the leader after every vote (ties go to the most recent voter\'s candidate). q(t) binary searches the last vote time ≤ t and returns that leader.',
    g: R => { const n = R.int(1, 6), times = R.distinct(n, 0, 30).sort((a, b) => a - b); return seq(R, 'TopVotedCandidate', [R.ints(n, 0, 2), times], R.int(1, 4), R => ['q', [R.int(times[0], 35)]]); },
    s(I, T) { const [p, t] = I.args[0], lead = [], c = {}; let L = -1; p.forEach(x => { c[x] = (c[x] || 0) + 1; if (L < 0 || c[x] >= c[L]) L = x; lead.push(L); }); return play(I, T, () => ({ q(x) { let lo = 0, hi = t.length - 1; while (lo < hi) { const m = (lo + hi + 1) >> 1; if (t[m] <= x) lo = m; else hi = m - 1; } return lead[lo]; } }), { view: () => ({ times: A(t), leader: A(lead) }), why: (op, [x]) => `Leader after the last vote at or before ${x}.` }); }
  });

  D('complete-binary-tree-inserter', {
    t: 'Complete Binary Tree Inserter',
    r: 'Level-order the tree and keep a queue of nodes missing a child. insert attaches to the front node (left first, then right — then dequeue it) and enqueues the new node.',
    g: R => { const n = R.int(1, 6), arr = R.ints(n, 1, 9); return seq(R, 'CBTInserter', [arr], R.int(1, 4), (R, st) => { st.k = (st.k || n) + 1; if (st.k > 20) return ['get_root', []]; return R.chance(0.8) ? ['insert', [R.int(1, 9)]] : ['get_root', []]; }); },
    s(I, T) { const root = Tr.from(I.args[0][0]); return play(I, T, () => { const q = []; const lv = [root]; for (let i = 0; i < lv.length; i++) { const x = lv[i]; if (x.left) lv.push(x.left); if (x.right) lv.push(x.right); if (!x.left || !x.right) q.push(x); } return { q, insert(v) { const p = q[0], nd = { val: v, left: null, right: null }; if (!p.left) p.left = nd; else { p.right = nd; q.shift(); } q.push(nd); return p.val; }, get_root() { return Tr.arr(root); } }; }, { view: o => ({ tree: TR(root, { hit: o.q[0] }) }), why: op => op === 'insert' ? 'Value of the first node missing a child.' : 'Level order of the whole tree.' }); }
  });

  D('number-of-recent-calls', {
    t: 'Number of Recent Calls',
    r: 'Queue the ping times (strictly increasing). On ping(t), drop times < t − 3000 from the front; the queue size is the answer.',
    g: R => { let t = 1; return seq(R, 'RecentCounter', [], R.int(2, 7), R => { t += R.pick([1, 100, 1500, 3000, 3001]); return ['ping', [t]]; }); },
    s(I, T) { return play(I, T, () => { const q = []; return { q, ping(t) { q.push(t); while (q[0] < t - 3000) q.shift(); return q.length; } }; }, { view: o => ({ queue: Q(o.q.slice()) }), why: (op, [t]) => `Pings in [${t - 3000}, ${t}].` }); }
  });

  D('time-based-key-value-store', {
    t: 'Time Based Key-Value Store',
    r: 'Per key, keep (timestamp, value) pairs in increasing time. get(key, t) binary searches the last timestamp ≤ t; "" if none.',
    g: R => { let ts = 1; return seq(R, 'TimeMap', [], R.int(3, 8), R => R.chance(0.5) ? ['set', [R.pick(['k', 'q']), R.pick(['a', 'b', 'c']), ts += R.int(1, 3)]] : ['get', [R.pick(['k', 'q']), R.int(0, ts + 2)]]); },
    s(I, T) { return play(I, T, () => { const m = {}; return { m, set(k, v, t) { (m[k] = m[k] || []).push([t, v]); }, get(k, t) { const a = m[k] || []; let r = ''; for (const [x, v] of a) if (x <= t) r = v; return r; } }; }, { view: o => ({ store: K(Object.fromEntries(Object.entries(o.m).map(([k, a]) => [k, a.map(([t, v]) => `${t}:${v}`).join(' ')]))) }), strOpts: () => ['a', 'b', 'c'], why: (op, [k, t]) => `Latest value of "${k}" at time ≤ ${t}, else "".` }); }
  });

  D('stream-of-characters', {
    t: 'Stream of Characters',
    r: 'Insert every word reversed into a trie. Keep the stream; on each letter walk the trie from the newest letter backwards; reaching a word end means some suffix is a word.',
    g: R => { const words = [...new Set(Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 3), 'ab')))]; return seq(R, 'StreamChecker', [words], R.int(3, 8), R => ['query', [R.pick('abc')]]); },
    s(I, T) { const words = I.args[0][0]; return play(I, T, () => { let s = ''; return { get s() { return s; }, query(c) { s += c; return words.some(w => s.endsWith(w)); } }; }, { view: o => ({ words: A(words), stream: o.s || '(empty)' }), why: () => 'Does the stream end with some word?' }); }
  });
})();
