/* v2 games: design (01). */
(function () {
  'use strict';
  const { D, A, G, K, S, Q, Tr, TR } = LCGame.H;
  const fmt = a => typeof a === 'string' ? JSON.stringify(a) : Array.isArray(a) ? JSON.stringify(a) : String(a);
  // Run a design problem: ops[0] constructs, the rest are method calls. Asks about returned values.
  const play = (I, T, make, o) => { o = o || {}; const obj = make(...(I.args[0] || [])), out = [null]; let asks = 0; const max = o.max || 7; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], args = I.args[i] || [], before = o.view ? o.view(obj) : {}; let r = obj[op](...args); if (r === undefined) r = null; out.push(r); if (asks >= max || r === null || (o.skip && o.skip(op))) continue; const label = `${op}(${args.map(fmt).join(', ')})`, why = o.why ? o.why(op, args, r, obj) : 'Follow the structure\'s invariant.'; if (typeof r === 'number' && Number.isFinite(r)) { T.at(Object.assign({ call: label }, before)); T.n(`What does ${label} return?`, r, why); asks++; } else if (typeof r === 'boolean') { T.at(Object.assign({ call: label }, before)); T.yn(`Does ${label} return true?`, r, why); asks++; } else if (typeof r === 'string') { const opts = [...new Set([r, ...(o.strOpts ? o.strOpts(obj, r) : []), r === '' ? 'null' : ''])].slice(0, 4); if (opts.length > 1) { T.at(Object.assign({ call: label }, before)); T.c(`What does ${label} return?`, opts.map(x => x === '' ? '""' : x), r === '' ? '""' : r, why); asks++; } } else if (Array.isArray(r)) { T.at(Object.assign({ call: label }, before)); T.n(`How many items does ${label} return?`, r.length, why); asks++; } } if (!asks) { T.at({ calls: I.ops.length - 1 }); T.n('How many method calls follow the constructor?', I.ops.length - 1, 'Count the operations.'); } return out; };
  // Build a random op sequence: step(R, st) returns [op, args] or null to stop.
  const seq = (R, ctor, ctorArgs, n, step, st) => { const ops = [ctor], args = [ctorArgs]; st = st || {}; for (let i = 0; i < n; i++) { const x = step(R, st); if (!x) break; ops.push(x[0]); args.push(x[1]); } return { ops, args }; };
  const rngOf = I => { let h = 2166136261; const s = JSON.stringify(I); for (let i = 0; i < s.length; i++) h = Math.imul(h ^ s.charCodeAt(i), 16777619) >>> 0; return () => { h = (h + 0x6D2B79F5) >>> 0; let t = h; t = Math.imul(t ^ (t >>> 15), t | 1); t ^= t + Math.imul(t ^ (t >>> 7), t | 61); return ((t ^ (t >>> 14)) >>> 0) / 4294967296; }; };
  const sum = a => a.reduce((x, y) => x + y, 0);

  D('lru-cache', {
    t: 'LRU Cache',
    r: 'A hash map plus recency order (doubly linked list). get moves the key to most-recent; put inserts or updates as most-recent and evicts the least-recent key when over capacity.',
    g: R => seq(R, 'LRUCache', [R.int(1, 3)], R.int(4, 9), R => R.chance(0.5) ? ['put', [R.int(1, 4), R.int(1, 9)]] : ['get', [R.int(1, 4)]]),
    s(I, T) { return play(I, T, cap => { const m = new Map(); return { m, get(k) { if (!m.has(k)) return -1; const v = m.get(k); m.delete(k); m.set(k, v); return v; }, put(k, v) { m.delete(k); m.set(k, v); if (m.size > cap) m.delete(m.keys().next().value); } }; }, { view: o => ({ oldestFirst: A([...o.m].map(([k, v]) => `${k}:${v}`)) }), why: () => 'Missing keys give −1; a hit becomes most recent.' }); }
  });

  D('min-stack', {
    t: 'Min Stack',
    r: 'Store each value with the minimum of the stack at that height. getMin reads the top pair\'s minimum in O(1); pop removes both.',
    g: R => seq(R, 'MinStack', [], R.int(4, 10), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['push', 'pop', 'top', 'getMin', 'push']) : 'push'; if (c === 'push') { st.n++; return ['push', [R.int(-5, 9)]]; } if (c === 'pop') st.n--; return [c, []]; }),
    s(I, T) { return play(I, T, () => { const s = []; return { s, push(v) { s.push([v, s.length ? Math.min(v, s[s.length - 1][1]) : v]); }, pop() { s.pop(); }, top() { return s[s.length - 1][0]; }, getMin() { return s[s.length - 1][1]; } }; }, { view: o => ({ stack: S(o.s.map(p => `${p[0]} (min ${p[1]})`)) }), why: (op) => op === 'getMin' ? 'Min stored with the top entry.' : 'Last pushed value.' }); }
  });

  D('two-sum-iii-data-structure-design', {
    t: 'Two Sum III: Data Structure',
    r: 'Keep counts of added numbers. find(v) checks each distinct x: v − x must exist (and need two copies when v − x = x).',
    g: R => seq(R, 'TwoSum', [], R.int(4, 9), R => R.chance(0.55) ? ['add', [R.int(-3, 6)]] : ['find', [R.int(-4, 10)]]),
    s(I, T) { return play(I, T, () => { const c = new Map(); return { c, add(x) { c.set(x, (c.get(x) || 0) + 1); }, find(v) { for (const [x, k] of c) { const y = v - x; if (y === x ? k > 1 : c.has(y)) return true; } return false; } }; }, { view: o => ({ counts: K(Object.fromEntries(o.c)) }), why: () => 'Look up the complement of each stored number.' }); }
  });

  D('binary-search-tree-iterator', {
    t: 'BST Iterator',
    r: 'Keep a stack of the left spine. next() pops the top (the next in-order value) and pushes the left spine of its right child. hasNext() checks the stack is non-empty.',
    g: R => { const root = Tr.from(R.tree(R.int(1, 8), 1, 9, 4)), nodes = [], ino = x => { if (!x) return; ino(x.left); nodes.push(x); ino(x.right); }; ino(root); const vals = R.distinct(nodes.length, 1, 30).sort((a, b) => a - b); nodes.forEach((x, i) => x.val = vals[i]); const n = vals.length, ops = ['BSTIterator'], args = [[Tr.arr(root)]]; let left = n; for (let i = 0; i < R.int(2, 8); i++) { if (left && R.chance(0.6)) { ops.push('next'); left--; } else ops.push('hasNext'); args.push([]); } return { ops, args }; },
    s(I, T) { const root = Tr.from(I.args[0][0]); return play(I, T, () => { const st = [], pushL = n => { while (n) { st.push(n); n = n.left; } }; pushL(root); return { st, next() { const n = st.pop(); pushL(n.right); return n.val; }, hasNext() { return st.length > 0; } }; }, { view: o => ({ tree: TR(root, { hit: o.st }), stack: S(o.st.map(n => n.val)) }), why: op => op === 'next' ? 'Top of the stack is the smallest unvisited value.' : 'Non-empty stack means more values.' }); }
  });

  D('implement-trie-prefix-tree', {
    t: 'Implement Trie',
    r: 'Each node has children by letter and an end flag. insert walks or creates nodes; search needs the end flag at the last node; startsWith only needs the path.',
    g: R => seq(R, 'Trie', [], R.int(4, 9), R => [R.pick(['insert', 'insert', 'search', 'startsWith']), [R.str(R.int(1, 4), 'ab')]]),
    s(I, T) { return play(I, T, () => { const root = {}, words = []; const walk = w => { let n = root; for (const ch of w) { n = n[ch]; if (!n) return null; } return n; }; return { words, insert(w) { let n = root; for (const ch of w) n = n[ch] = n[ch] || {}; n.$ = true; words.push(w); }, search(w) { const n = walk(w); return !!(n && n.$); }, startsWith(p) { return !!walk(p); } }; }, { view: o => ({ inserted: A([...new Set(o.words)]) }), why: op => op === 'search' ? 'Path exists and ends at a word.' : 'Path exists.' }); }
  });

  D('design-add-and-search-words-data-structure', {
    t: 'Add and Search Words (with ".")',
    r: 'Store words in a trie. search walks the trie; a "." branches into every child (DFS). The word must end on an end-of-word node.',
    g: R => seq(R, 'WordDictionary', [], R.int(4, 9), R => R.chance(0.45) ? ['addWord', [R.str(R.int(1, 3), 'abc')]] : ['search', [R.str(R.int(1, 3), 'ab.')]]),
    s(I, T) { return play(I, T, () => { const root = {}, words = []; const dfs = (n, w, i) => { if (!n) return false; if (i === w.length) return !!n.$; if (w[i] === '.') return Object.keys(n).some(k => k !== '$' && dfs(n[k], w, i + 1)); return dfs(n[w[i]], w, i + 1); }; return { words, addWord(w) { let n = root; for (const ch of w) n = n[ch] = n[ch] || {}; n.$ = true; words.push(w); }, search(w) { return dfs(root, w, 0); } }; }, { view: o => ({ words: A([...new Set(o.words)]) }), why: () => '"." matches any letter; length must match.' }); }
  });

  D('implement-stack-using-queues', {
    t: 'Implement Stack Using Queues',
    r: 'On push, enqueue x and rotate the older elements behind it, so the queue front is always the stack top. pop or top read the front.',
    g: R => seq(R, 'MyStack', [], R.int(4, 9), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['push', 'pop', 'top', 'empty']) : R.pick(['push', 'empty']); if (c === 'push') { st.n++; return ['push', [R.int(1, 9)]]; } if (c === 'pop') st.n--; return [c, []]; }),
    s(I, T) { return play(I, T, () => { const q = []; return { q, push(x) { q.push(x); for (let i = 0; i < q.length - 1; i++) q.push(q.shift()); }, pop() { return q.shift(); }, top() { return q[0]; }, empty() { return !q.length; } }; }, { view: o => ({ queue: Q(o.q) }), why: op => op === 'empty' ? 'Is the queue empty?' : 'Front of the rotated queue = last pushed.' }); }
  });

  D('implement-queue-using-stacks', {
    t: 'Implement Queue Using Stacks',
    r: 'Push onto an in-stack. To pop or peek, if the out-stack is empty move everything over (reversing order); its top is the queue front. Amortized O(1).',
    g: R => seq(R, 'MyQueue', [], R.int(4, 9), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['push', 'pop', 'peek', 'empty']) : R.pick(['push', 'empty']); if (c === 'push') { st.n++; return ['push', [R.int(1, 9)]]; } if (c === 'pop') st.n--; return [c, []]; }),
    s(I, T) { return play(I, T, () => { const a = [], b = [], mv = () => { if (!b.length) while (a.length) b.push(a.pop()); }; return { a, b, push(x) { a.push(x); }, pop() { mv(); return b.pop(); }, peek() { mv(); return b[b.length - 1]; }, empty() { return !a.length && !b.length; } }; }, { view: o => ({ inStack: S(o.a.slice()), outStack: S(o.b.slice()) }), why: op => op === 'empty' ? 'Both stacks empty?' : 'Out-stack top (refill from in-stack when empty).' }); }
  });

  D('shortest-word-distance-ii', {
    t: 'Shortest Word Distance II',
    r: 'Precompute the sorted index list of every word. shortest(a, b) merges the two lists with two pointers, tracking the smallest gap.',
    g: R => { const w = Array.from({ length: R.int(2, 7) }, () => R.pick(['a', 'b', 'c', 'd'])); if (new Set(w).size < 2) w.push(w[0] === 'a' ? 'b' : 'a'); const u = [...new Set(w)]; return seq(R, 'WordDistance', [w], R.int(1, 4), R => { const [x, y] = R.shuffle(u.slice()); return ['shortest', [x, y]]; }); },
    s(I, T) { const pos = {}; I.args[0][0].forEach((w, i) => (pos[w] = pos[w] || []).push(i)); return play(I, T, () => ({ shortest(a, b) { const p = pos[a], q = pos[b]; let i = 0, j = 0, best = Infinity; while (i < p.length && j < q.length) { best = Math.min(best, Math.abs(p[i] - q[j])); if (p[i] < q[j]) i++; else j++; } return best; } }), { view: () => ({ words: A(I.args[0][0]), positions: K(Object.fromEntries(Object.entries(pos).map(([k, v]) => [k, v.join(',')]))) }), why: () => 'Two pointers over both index lists.' }); }
  });

  D('flatten-2d-vector', {
    t: 'Flatten 2D Vector',
    r: 'Keep (row, col) pointers. Before reading, skip empty rows by advancing row until col is inside a row. next() returns and advances col; hasNext() just skips empties and checks bounds.',
    g: R => { const v = Array.from({ length: R.int(1, 4) }, () => R.ints(R.int(0, 3), 1, 9)), n = v.flat().length, ops = ['Vector2D'], args = [[v]]; let left = n; for (let i = 0; i < R.int(2, 8); i++) { if (left && R.chance(0.65)) { ops.push('next'); left--; } else ops.push('hasNext'); args.push([]); } return { ops, args }; },
    s(I, T) { const v = I.args[0][0]; return play(I, T, () => { const o = { r: 0, c: 0, skip() { while (o.r < v.length && o.c >= v[o.r].length) { o.r++; o.c = 0; } }, next() { o.skip(); return v[o.r][o.c++]; }, hasNext() { o.skip(); return o.r < v.length; } }; return o; }, { view: o => ({ vec: A(v.map(r => r.join(',') || '∅'), { hl: [o.r] }), col: o.c }), why: op => op === 'next' ? 'Skip empty rows, read, advance.' : 'Any element left after skipping empties?' }); }
  });

  D('encode-and-decode-strings', {
    t: 'Encode and Decode Strings',
    r: 'Prefix each string with its length and a delimiter ("5#hello"). Decoding reads the number up to "#", then exactly that many characters — so any characters (even "#") are safe.',
    g: R => ({ dummy_input: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(0, 4), 'ab#1')) }),
    s(I, T) { const enc = I.dummy_input.map(s => s.length + '#' + s).join(''); T.at({ strs: A(I.dummy_input.map(s => JSON.stringify(s))) }); T.n('Length of the encoded string?', enc.length, 'Each piece adds len + "#" + chars.'); const out = []; let i = 0, asks = 0; while (i < enc.length) { const j = enc.indexOf('#', i), L = +enc.slice(i, j); if (asks++ < 3) { T.at({ encoded: enc, at: i }); T.n('Length read at this position?', L, 'Digits before "#".'); } out.push(enc.slice(j + 1, j + 1 + L)); i = j + 1 + L; } return out; }
  });

  D('zigzag-iterator', {
    t: 'Zigzag Iterator',
    r: 'Keep a queue of (list, index) for non-empty lists. next() takes the front, emits its element, and re-queues it if it has more. This cycles through any number of lists.',
    g: R => { const k = R.int(2, 3), o = {}; for (let i = 1; i <= k; i++) o['v' + i] = R.ints(R.int(0, 4), 1, 9); return o; },
    s(I, T) { const lists = Object.keys(I).filter(k => /^v\d+$/.test(k)).sort().map(k => I[k]), q = lists.map((l, i) => [i, 0]).filter(([i]) => lists[i].length), out = []; while (q.length) { const [i, j] = q.shift(); if (out.length < 5) { T.at({ lists: A(lists.map(l => l.join(',') || '∅'), { hl: [i] }), queue: Q(q.map(([a]) => 'v' + (a + 1))) }); T.n('Next value emitted?', lists[i][j], `Front list v${i + 1}, index ${j}.`); } out.push(lists[i][j]); if (j + 1 < lists[i].length) q.push([i, j + 1]); } if (!out.length) T.n('Values?', 0, 'All empty.'); return out; }
  });

  D('peeking-iterator', {
    t: 'Peeking Iterator',
    r: 'Cache the next element. peek() returns the cache; next() returns it and refills from the underlying iterator; hasNext() checks whether the cache is filled.',
    g: R => { const nums = R.ints(R.int(1, 5), 1, 9), ops = ['PeekingIterator'], args = [[nums]]; let left = nums.length; for (let i = 0; i < R.int(2, 8); i++) { const c = left ? R.pick(['next', 'peek', 'hasNext']) : 'hasNext'; if (c === 'next') left--; ops.push(c); args.push([]); } return { ops, args }; },
    s(I, T) { const nums = I.args[0][0]; return play(I, T, () => { let i = 0; return { get i() { return i; }, next() { return nums[i++]; }, peek() { return nums[i]; }, hasNext() { return i < nums.length; } }; }, { view: o => ({ nums: A(nums, { i: o.i }) }), why: op => op === 'peek' ? 'Cached value, pointer unchanged.' : op === 'next' ? 'Return cached value and advance.' : 'Is there a cached value?' }); }
  });

  D('unique-word-abbreviation', {
    t: 'Unique Word Abbreviation',
    r: 'Map each abbreviation (first + middle count + last) to the set of dictionary words with it. A word is unique if no dictionary word shares its abbreviation, or every one that does is the word itself.',
    g: R => { const w = () => R.str(R.int(2, 4), 'abd'); return seq(R, 'ValidWordAbbr', [Array.from({ length: R.int(1, 4) }, w)], R.int(2, 5), R => ['isUnique', [w()]]); },
    s(I, T) { const ab = w => w.length <= 2 ? w : w[0] + (w.length - 2) + w[w.length - 1], m = {}; I.args[0][0].forEach(w => (m[ab(w)] = m[ab(w)] || new Set()).add(w)); return play(I, T, () => ({ isUnique(w) { const s = m[ab(w)]; return !s || (s.size === 1 && s.has(w)); } }), { view: () => ({ abbrs: K(Object.fromEntries(Object.entries(m).map(([k, v]) => [k, [...v].join(',')]))) }), why: (op, [w]) => `Abbreviation of "${w}" is ${ab(w)}.` }); }
  });

  D('find-median-from-data-stream', {
    t: 'Find Median From Data Stream',
    r: 'Two heaps: a max-heap for the lower half and a min-heap for the upper half, balanced so the lower has the same size or one more. The median is its top, or the average of both tops.',
    g: R => seq(R, 'MedianFinder', [], R.int(3, 9), (R, st) => { st.n = st.n || 0; if (!st.n || R.chance(0.6)) { st.n++; return ['addNum', [R.int(-5, 9)]]; } return ['findMedian', []]; }),
    s(I, T) { return play(I, T, () => { const lo = [], hi = []; return { lo, hi, addNum(x) { lo.push(x); lo.sort((a, b) => a - b); hi.push(lo.pop()); hi.sort((a, b) => a - b); if (hi.length > lo.length) lo.push(hi.shift()); }, findMedian() { lo.sort((a, b) => a - b); return lo.length > hi.length ? lo[lo.length - 1] : (lo[lo.length - 1] + hi[0]) / 2; } }; }, { view: o => ({ lowerHalf: A(o.lo.slice().sort((a, b) => a - b)), upperHalf: A(o.hi.slice()) }), why: () => 'Top of the lower half, or the average of both tops.' }); }
  });

  D('serialize-and-deserialize-binary-tree', {
    t: 'Serialize and Deserialize Binary Tree',
    r: 'Serialize level by level (or preorder) writing "#" for null children. Deserialize reads tokens in the same order, attaching left then right children to each queued node.',
    g: R => ({ root: R.chance(0.1) ? [] : Tr.arr(Tr.from(R.tree(R.int(1, 9), -5, 9, 4))) }),
    s(I, T) { const res = (() => { const root = Tr.from(I.root), toks = []; const q = [root]; while (q.length) { const n = q.shift(); if (!n) { toks.push('#'); continue; } toks.push(String(n.val)); q.push(n.left, n.right); } T.at({ tree: root ? TR(root) : 'empty', serialized: toks.join(',') }); T.n('How many "#" tokens does level-order serialization write?', toks.filter(t => t === '#').length, 'Every missing child, including below leaves.'); T.n('How many tokens in total?', toks.length, 'Nodes plus null markers.'); return Tr.arr(root); })(); T.n('Nodes in the tree?', res.filter(v => v !== null).length, 'Tokens that are not #.'); return res; }
  });

  D('range-sum-query-immutable', {
    t: 'Range Sum Query: Immutable',
    r: 'Precompute prefix sums P (P[0] = 0). sumRange(l, r) = P[r + 1] − P[l] in O(1).',
    g: R => { const nums = R.ints(R.int(1, 7), -5, 9); return seq(R, 'NumArray', [nums], R.int(1, 4), R => { const l = R.int(0, nums.length - 1); return ['sumRange', [l, R.int(l, nums.length - 1)]]; }); },
    s(I, T) { const P = [0]; I.args[0][0].forEach(x => P.push(P[P.length - 1] + x)); return play(I, T, () => ({ sumRange: (l, r) => P[r + 1] - P[l] }), { view: () => ({ nums: A(I.args[0][0]), prefix: A(P) }), why: (op, [l, r]) => `P[${r + 1}] − P[${l}].` }); }
  });

  D('range-sum-query-2d-immutable', {
    t: 'Range Sum Query 2D: Immutable',
    r: 'P[i][j] = sum of the rectangle above-left of (i, j). A region sum is P[r2+1][c2+1] − P[r1][c2+1] − P[r2+1][c1] + P[r1][c1].',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), mat = Array.from({ length: m }, () => R.ints(n, -3, 9)); return seq(R, 'NumMatrix', [mat], R.int(1, 3), R => { const r1 = R.int(0, m - 1), c1 = R.int(0, n - 1); return ['sumRegion', [r1, c1, R.int(r1, m - 1), R.int(c1, n - 1)]]; }); },
    s(I, T) { const M = I.args[0][0], m = M.length, n = M[0].length, P = Array.from({ length: m + 1 }, () => Array(n + 1).fill(0)); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) P[i + 1][j + 1] = M[i][j] + P[i][j + 1] + P[i + 1][j] - P[i][j]; return play(I, T, () => ({ sumRegion: (a, b, c, d) => P[c + 1][d + 1] - P[a][d + 1] - P[c + 1][b] + P[a][b] }), { view: () => ({ matrix: G(M), prefix: G(P) }), why: () => 'Inclusion to exclusion on the 2D prefix table.' }); }
  });

  D('range-sum-query-mutable', {
    t: 'Range Sum Query: Mutable (Fenwick tree)',
    r: 'A Fenwick (binary indexed) tree stores partial sums: update adds the delta along i += i & −i; a prefix sum walks i −= i & −i. sumRange = prefix(r) − prefix(l − 1).',
    g: R => { const nums = R.ints(R.int(1, 6), -5, 9); return seq(R, 'NumArray', [nums], R.int(2, 6), R => { if (R.chance(0.4)) return ['update', [R.int(0, nums.length - 1), R.int(-5, 9)]]; const l = R.int(0, nums.length - 1); return ['sumRange', [l, R.int(l, nums.length - 1)]]; }); },
    s(I, T) { const a = I.args[0][0].slice(), n = a.length, bit = Array(n + 1).fill(0), add = (i, d) => { for (i++; i <= n; i += i & -i) bit[i] += d; }, pre = i => { let s = 0; for (i++; i > 0; i -= i & -i) s += bit[i]; return s; }; a.forEach((x, i) => add(i, x)); return play(I, T, () => ({ update(i, v) { add(i, v - a[i]); a[i] = v; }, sumRange: (l, r) => pre(r) - pre(l - 1) }), { view: () => ({ nums: A(a.slice()), fenwick: A(bit.slice(1)) }), why: (op, [l, r]) => `prefix(${r}) − prefix(${l - 1}).` }); }
  });

  D('range-sum-query-2d-mutable', {
    t: 'Range Sum Query 2D: Mutable',
    r: 'A 2D Fenwick tree: update adds the delta over i and j index chains; a region sum combines four prefix queries by inclusion-exclusion.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3), mat = Array.from({ length: m }, () => R.ints(n, -3, 9)); return seq(R, 'NumMatrix', [mat], R.int(2, 5), R => { if (R.chance(0.4)) return ['update', [R.int(0, m - 1), R.int(0, n - 1), R.int(-3, 9)]]; const r1 = R.int(0, m - 1), c1 = R.int(0, n - 1); return ['sumRegion', [r1, c1, R.int(r1, m - 1), R.int(c1, n - 1)]]; }); },
    s(I, T) { const M = I.args[0][0].map(r => r.slice()), m = M.length, n = M[0].length, bit = Array.from({ length: m + 1 }, () => Array(n + 1).fill(0)), add = (r, c, d) => { for (let i = r + 1; i <= m; i += i & -i) for (let j = c + 1; j <= n; j += j & -j) bit[i][j] += d; }, pre = (r, c) => { let s = 0; for (let i = r + 1; i > 0; i -= i & -i) for (let j = c + 1; j > 0; j -= j & -j) s += bit[i][j]; return s; }; M.forEach((row, r) => row.forEach((v, c) => add(r, c, v))); return play(I, T, () => ({ update(r, c, v) { add(r, c, v - M[r][c]); M[r][c] = v; }, sumRegion: (a, b, c, d) => pre(c, d) - pre(a - 1, d) - pre(c, b - 1) + pre(a - 1, b - 1) }), { view: () => ({ matrix: G(M.map(r => r.slice())) }), why: () => 'Four prefix queries, inclusion-exclusion.' }); }
  });

  D('flatten-nested-list-iterator', {
    t: 'Flatten Nested List Iterator',
    r: 'Keep a stack of list iterators. hasNext() unwraps: while the top item is a list, push an iterator over it; pop exhausted iterators. next() returns the integer found.',
    g: R => { const mk = d => Array.from({ length: R.int(0, 3) }, () => d < 2 && R.chance(0.35) ? mk(d + 1) : R.int(1, 9)); return { nestedList: mk(0) }; },
    s(I, T) { const out = [], st = [[I.nestedList, 0]]; let asks = 0; while (st.length) { const top = st[st.length - 1]; if (top[1] >= top[0].length) { st.pop(); continue; } const x = top[0][top[1]++]; if (Array.isArray(x)) { if (asks++ < 4) { T.at({ item: JSON.stringify(x), depth: st.length }); T.n('Stack depth after unwrapping this list?', st.length + 1, 'Push an iterator for the inner list.'); } st.push([x, 0]); } else out.push(x); } T.at({ nested: JSON.stringify(I.nestedList) }); T.n('How many integers are produced?', out.length, 'Count all leaves.'); return out; }
  });

  D('moving-average-from-data-stream', {
    t: 'Moving Average From Data Stream',
    r: 'Keep a queue of the last size values and their running sum: add the new value, drop the oldest when over size, return sum divided by count.',
    g: R => seq(R, 'MovingAverage', [R.int(1, 3)], R.int(2, 6), R => ['next', [R.int(-3, 9)]]),
    s(I, T) { return play(I, T, size => { const q = []; let s = 0; return { q, next(v) { q.push(v); s += v; if (q.length > size) s -= q.shift(); return s / q.length; } }; }, { view: o => ({ window: Q(o.q.slice()) }), why: () => 'Running sum divided by window length.' }); }
  });

  D('design-tic-tac-toe', {
    t: 'Design Tic-Tac-Toe',
    r: 'Keep a counter per row, column and both diagonals: +1 for player 1, −1 for player 2. A move wins when some counter on its lines reaches ±n.',
    g: R => { const n = R.int(2, 4), cells = R.shuffle([...Array(n * n).keys()]), ops = ['TicTacToe'], args = [[n]], rows = Array(n).fill(0), cols = Array(n).fill(0); let d = 0, a = 0; for (let i = 0; i < cells.length; i++) { const r = Math.floor(cells[i] / n), c = cells[i] % n, p = i % 2 + 1, v = p === 1 ? 1 : -1; ops.push('move'); args.push([r, c, p]); rows[r] += v; cols[c] += v; if (r === c) d += v; if (r + c === n - 1) a += v; if ([rows[r], cols[c], d, a].some(x => Math.abs(x) === n)) break; } return { ops, args }; },
    s(I, T) { return play(I, T, n => { const rows = Array(n).fill(0), cols = Array(n).fill(0), b = Array.from({ length: n }, () => Array(n).fill('.')); let d = 0, a = 0; return { b, move(r, c, p) { const v = p === 1 ? 1 : -1; b[r][c] = p === 1 ? 'X' : 'O'; rows[r] += v; cols[c] += v; if (r === c) d += v; if (r + c === n - 1) a += v; return [rows[r], cols[c], d, a].some(x => Math.abs(x) === n) ? p : 0; } }; }, { view: o => ({ board: G(o.b.map(r => r.slice())) }), why: () => 'Winner if a line counter hits ±n, else 0.', max: 6 }); }
  });

  D('data-stream-as-disjoint-intervals', {
    t: 'Data Stream as Disjoint Intervals',
    r: 'Keep sorted disjoint intervals. addNum(x) finds where x falls: ignore if covered, else merge with the interval ending at x − 1 and or or starting at x + 1, or insert [x, x].',
    g: R => seq(R, 'SummaryRanges', [], R.int(3, 9), (R, st) => R.chance(0.6) ? ['addNum', [R.int(0, 9)]] : ['getIntervals', []]),
    s(I, T) { return play(I, T, () => { const iv = []; return { iv, addNum(x) { if (iv.some(([a, b]) => a <= x && x <= b)) return; iv.push([x, x]); iv.sort((p, q) => p[0] - q[0]); const m = []; for (const p of iv) { if (m.length && p[0] <= m[m.length - 1][1] + 1) m[m.length - 1][1] = Math.max(m[m.length - 1][1], p[1]); else m.push(p.slice()); } iv.length = 0; iv.push(...m); }, getIntervals() { return iv.map(p => p.slice()); } }; }, { view: o => ({ intervals: A(o.iv.map(p => p.join(' to '))) }), why: () => 'Merge neighbors that touch.' }); }
  });

  D('design-snake-game', {
    t: 'Design Snake Game',
    r: 'Keep the body as a deque plus a set. Move the head; out of bounds ends the game. If the head lands on the current food, grow (score + 1); otherwise drop the tail first. Hitting the body ends the game.',
    g: R => { const w = R.int(2, 4), h = R.int(2, 4), food = Array.from({ length: R.int(1, 4) }, () => [R.int(0, h - 1), R.int(0, w - 1)]).filter(f => f[0] || f[1]); const g = seq(R, 'SnakeGame', [w, h, food], R.int(2, 8), R => ['move', [R.pick('UDLR')]]); const sim = []; let body = [[0, 0]], fi = 0; for (let i = 1; i < g.ops.length; i++) { const d = { U: [-1, 0], D: [1, 0], L: [0, -1], R: [0, 1] }[g.args[i][0]], hd = [body[0][0] + d[0], body[0][1] + d[1]]; sim.push(i); if (hd[0] < 0 || hd[1] < 0 || hd[0] >= h || hd[1] >= w) break; if (fi < food.length && food[fi][0] === hd[0] && food[fi][1] === hd[1]) fi++; else body.pop(); if (body.some(p => p[0] === hd[0] && p[1] === hd[1])) break; body.unshift(hd); } const k = sim.length ? sim[sim.length - 1] + 1 : g.ops.length; return { ops: g.ops.slice(0, k), args: g.args.slice(0, k) }; },
    s(I, T) { return play(I, T, (w, h, food) => { const body = [[0, 0]]; let fi = 0, score = 0; return { body, get fi() { return fi; }, move(dir) { const d = { U: [-1, 0], D: [1, 0], L: [0, -1], R: [0, 1] }[dir], hd = [body[0][0] + d[0], body[0][1] + d[1]]; if (hd[0] < 0 || hd[1] < 0 || hd[0] >= h || hd[1] >= w) return -1; if (fi < food.length && food[fi][0] === hd[0] && food[fi][1] === hd[1]) { fi++; score++; } else body.pop(); if (body.some(p => p[0] === hd[0] && p[1] === hd[1])) return -1; body.unshift(hd); return score; } }; }, { view: o => { const [w, h, food] = I.args[0], b = Array.from({ length: h }, () => Array(w).fill('.')); o.body.forEach(([r, c], i) => b[r][c] = i ? 's' : 'H'); if (o.fi < food.length) b[food[o.fi][0]][food[o.fi][1]] = 'F'; return { board: G(b) }; }, why: () => 'Score after the move, or −1 on a wall or body hit.' }); }
  });

  D('design-twitter', {
    t: 'Design Twitter',
    r: 'Store each user\'s tweets with a global timestamp and a followee set. getNewsFeed merges the user\'s and followees\' tweets (a heap of the latest from each) and returns the 10 most recent ids.',
    g: R => { let tid = 1; return seq(R, 'Twitter', [], R.int(4, 10), R => { const c = R.pick(['postTweet', 'postTweet', 'getNewsFeed', 'follow', 'unfollow']); if (c === 'postTweet') return [c, [R.int(1, 3), tid++]]; if (c === 'getNewsFeed') return [c, [R.int(1, 3)]]; const a = R.int(1, 3); let b = R.int(1, 3); if (b === a) b = a % 3 + 1; return [c, [a, b]]; }); },
    s(I, T) { return play(I, T, () => { const tw = [], fol = {}; return { tw, postTweet(u, t) { tw.push([u, t]); }, follow(a, b) { (fol[a] = fol[a] || new Set()).add(b); }, unfollow(a, b) { if (fol[a]) fol[a].delete(b); }, getNewsFeed(u) { const s = fol[u] || new Set(); return tw.filter(([x]) => x === u || s.has(x)).map(p => p[1]).reverse().slice(0, 10); } }; }, { view: o => ({ tweets: A(o.tw.map(([u, t]) => `u${u}:${t}`)) }), why: () => 'Most recent first from self and followees.' }); }
  });

  D('logger-rate-limiter', {
    t: 'Logger Rate Limiter',
    r: 'Map each message to the next timestamp it may print. Print (and set next = t + 10) only if t at least that value.',
    g: R => { let t = 1; return seq(R, 'Logger', [], R.int(3, 8), R => { t += R.int(0, 6); return ['shouldPrintMessage', [t, R.pick(['foo', 'bar'])]]; }); },
    s(I, T) { return play(I, T, () => { const nx = {}; return { nx, shouldPrintMessage(t, m) { if (t < (nx[m] || 0)) return false; nx[m] = t + 10; return true; } }; }, { view: o => ({ nextAllowed: K(Object.assign({}, o.nx)) }), why: (op, [t, m]) => `Allowed if ${t} at least next time for "${m}".` }); }
  });

  D('design-hit-counter', {
    t: 'Design Hit Counter',
    r: 'Keep hits in a queue (timestamps are non-decreasing). getHits(t) drops hits with time at most t − 300 from the front and returns the queue length.',
    g: R => { let t = 1; return seq(R, 'HitCounter', [], R.int(3, 9), R => { t += R.pick([0, 1, 50, 120, 299, 300]); return [R.chance(0.6) ? 'hit' : 'getHits', [t]]; }); },
    s(I, T) { return play(I, T, () => { const q = []; return { q, hit(t) { q.push(t); }, getHits(t) { while (q.length && q[0] <= t - 300) q.shift(); return q.length; } }; }, { view: o => ({ hits: Q(o.q.slice()) }), why: (op, [t]) => `Hits after ${t - 300}.` }); }
  });

  D('design-phone-directory', {
    t: 'Design Phone Directory',
    r: 'A queue of free numbers plus a set of used ones. get() pops a free number (−1 if none); check() tests the set; release() returns a used number to the queue.',
    g: R => seq(R, 'PhoneDirectory', [R.int(1, 3)], R.int(3, 8), R => R.pick([['get', []], ['get', []], ['check', [R.int(0, 2)]], ['release', [R.int(0, 2)]]])),
    s(I, T) { return play(I, T, mx => { const free = [...Array(mx).keys()], used = new Set(); return { free, get() { if (!free.length) return -1; const x = free.shift(); used.add(x); return x; }, check(x) { return x < mx && !used.has(x); }, release(x) { if (used.delete(x)) free.push(x); } }; }, { view: o => ({ freeQueue: Q(o.free.slice()) }), why: op => op === 'get' ? 'Front of the free queue (−1 if empty).' : 'Is it unassigned?' }); }
  });

  D('insert-delete-getrandom-o1', {
    t: 'Insert Delete GetRandom O(1)',
    r: 'An array of values plus a map value to index. Remove swaps the value with the last element and pops, fixing the moved index. getRandom picks a random array slot.',
    g: R => seq(R, 'RandomizedSet', [], R.int(4, 9), (R, st) => { st.s = st.s || new Set(); const c = st.s.size ? R.pick(['insert', 'remove', 'getRandom']) : R.pick(['insert', 'remove']); if (c === 'getRandom') return [c, []]; const x = R.int(1, 4); if (c === 'insert') st.s.add(x); else st.s.delete(x); return [c, [x]]; }),
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== e.length) return false; const s = new Set(); for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], x = I.args[i][0]; if (op === 'insert') { if (o[i] !== !s.has(x)) return false; s.add(x); } else if (op === 'remove') { if (o[i] !== s.has(x)) return false; s.delete(x); } else if (!s.has(o[i])) return false; } return true; },
    s(I, T) { const rnd = rngOf(I); return play(I, T, () => { const arr = [], pos = new Map(); return { arr, insert(x) { if (pos.has(x)) return false; pos.set(x, arr.length); arr.push(x); return true; }, remove(x) { if (!pos.has(x)) return false; const i = pos.get(x), last = arr.pop(); if (last !== x) { arr[i] = last; pos.set(last, i); } pos.delete(x); return true; }, getRandom() { return arr[Math.floor(rnd() * arr.length)]; } }; }, { view: o => ({ array: A(o.arr.slice()) }), skip: op => op === 'getRandom', why: op => op === 'insert' ? 'True only if it was absent.' : 'True only if it was present.' }); }
  });

  D('insert-delete-getrandom-o1-duplicates-allowed', {
    t: 'Insert Delete GetRandom O(1): Duplicates',
    r: 'Array of values plus a map from each value to its set of indices. Remove takes any index of x, moves the last element into it and fixes that element\'s index set. getRandom picks a random slot (so duplicates weigh more).',
    g: R => seq(R, 'RandomizedCollection', [], R.int(4, 9), (R, st) => { st.n = st.n || 0; const c = st.n ? R.pick(['insert', 'remove', 'getRandom']) : 'insert'; if (c === 'getRandom') return [c, []]; if (c === 'insert') st.n++; else st.n = Math.max(0, st.n - 1); return [c, [R.int(1, 3)]]; }),
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== e.length) return false; const c = new Map(); for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], x = I.args[i][0]; if (op === 'insert') { if (o[i] !== !c.get(x)) return false; c.set(x, (c.get(x) || 0) + 1); } else if (op === 'remove') { if (o[i] !== !!c.get(x)) return false; if (c.get(x)) c.set(x, c.get(x) - 1); } else if (!c.get(o[i])) return false; } return true; },
    s(I, T) { const rnd = rngOf(I); return play(I, T, () => { const arr = [], idx = new Map(); return { arr, insert(x) { const had = idx.has(x) && idx.get(x).size > 0; if (!idx.has(x)) idx.set(x, new Set()); idx.get(x).add(arr.length); arr.push(x); return !had; }, remove(x) { if (!idx.has(x) || !idx.get(x).size) return false; const i = idx.get(x).values().next().value; idx.get(x).delete(i); const last = arr.pop(), li = arr.length; if (i !== li) { arr[i] = last; idx.get(last).delete(li); idx.get(last).add(i); } return true; }, getRandom() { return arr[Math.floor(rnd() * arr.length)]; } }; }, { view: o => ({ array: A(o.arr.slice()) }), skip: op => op === 'getRandom', why: op => op === 'insert' ? 'True if x was not present before.' : 'True if some copy existed.' }); }
  });

  D('linked-list-random-node', {
    t: 'Linked List Random Node (reservoir sampling)',
    r: 'Walk the list once; keep the i-th node with probability 1 divided by i. Every node ends up chosen with probability 1 divided by n without knowing n in advance.',
    g: R => seq(R, 'Solution', [R.ints(R.int(1, 5), 1, 9)], R.int(2, 5), () => ['getRandom', []]),
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && o.slice(1).every(v => I.args[0][0].includes(v)),
    s(I, T) { const list = I.args[0][0], rnd = rngOf(I); T.at({ list: A(list) }); T.n('Chance, in percent, that the 2nd node replaces the pick when it is reached?', 50, 'One in i, so one in 2.'); T.n('getRandom calls?', I.ops.filter(o => o === 'getRandom').length, 'Each one walks the whole list.'); T.n('Chance, in percent and rounded, of picking the last node?', Math.round(100 / list.length), 'Every node ends up equally likely.'); return play(I, T, () => ({ getRandom() { let pick = list[0]; for (let i = 1; i < list.length; i++) if (rnd() < 1 / (i + 1)) pick = list[i]; return pick; } }), { skip: () => true, max: 0 }); }
  });

  D('shuffle-an-array', {
    t: 'Shuffle an Array (Fisher-Yates)',
    r: 'For i from the end down to 1, swap a[i] with a[random j at most i]. Each permutation is equally likely. reset returns the saved original.',
    g: R => seq(R, 'Solution', [R.distinct(R.int(1, 5), 1, 9)], R.int(2, 5), R => [R.pick(['shuffle', 'reset']), []]),
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && o.slice(1).every((v, i) => I.ops[i + 1] === 'reset' ? JSON.stringify(v) === JSON.stringify(I.args[0][0]) : Array.isArray(v) && JSON.stringify(v.slice().sort((a, b) => a - b)) === JSON.stringify(I.args[0][0].slice().sort((a, b) => a - b))),
    s(I, T) { const orig = I.args[0][0], rnd = rngOf(I); T.at({ nums: A(orig) }); T.n('How many swaps does Fisher-Yates make?', Math.max(0, orig.length - 1), 'One per index from n minus 1 down to 1.'); T.n('shuffle calls?', I.ops.filter(o => o === 'shuffle').length, 'Each makes a fresh permutation.'); T.n('reset calls?', I.ops.filter(o => o === 'reset').length, 'Each returns the original order.'); return play(I, T, () => ({ shuffle() { const a = orig.slice(); for (let i = a.length - 1; i > 0; i--) { const j = Math.floor(rnd() * (i + 1));[a[i], a[j]] = [a[j], a[i]]; } return a; }, reset() { return orig.slice(); } }), { skip: () => true, max: 0 }); }
  });

  D('random-pick-index', {
    t: 'Random Pick Index (reservoir sampling)',
    r: 'Scan nums; for the k-th occurrence of target, keep its index with probability 1 divided by k. Each matching index is returned uniformly.',
    g: R => { const nums = R.ints(R.int(1, 6), 1, 3); return seq(R, 'Solution', [nums], R.int(1, 4), R => ['pick', [R.pick(nums)]]); },
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && o.slice(1).every((v, i) => I.args[0][0][v] === I.args[i + 1][0]),
    s(I, T) { const nums = I.args[0][0], rnd = rngOf(I); const t0 = I.args[1] ? I.args[1][0] : nums[0]; T.at({ nums: A(nums) }); T.n(`How many indices hold ${t0}?`, nums.filter(x => x === t0).length, 'Each is picked with probability one over the count.'); T.n('pick calls?', I.ops.filter(o => o === 'pick').length, 'Reservoir sampling each time.'); T.n('Distinct values in nums?', new Set(nums).size, 'Targets always exist in nums.'); return play(I, T, () => ({ pick(t) { let k = 0, res = -1; nums.forEach((x, i) => { if (x === t && rnd() < 1 / ++k) res = i; }); return res; } }), { skip: () => true, max: 0 }); }
  });

  D('all-oone-data-structure', {
    t: 'All O`one Data Structure',
    r: 'Buckets of keys by count in a doubly linked list ordered by count. inc or dec move a key to the neighboring bucket (creating or removing buckets). Max key is in the last bucket, min key in the first.',
    g: R => seq(R, 'AllOne', [], R.int(4, 10), (R, st) => { st.c = st.c || {}; const ks = Object.keys(st.c).filter(k => st.c[k] > 0); const c = ks.length ? R.pick(['inc', 'inc', 'dec', 'getMaxKey', 'getMinKey']) : R.pick(['inc', 'getMaxKey']); if (c === 'inc') { const k = R.pick(['a', 'b', 'c']); st.c[k] = (st.c[k] || 0) + 1; return [c, [k]]; } if (c === 'dec') { const k = R.pick(ks); st.c[k]--; return [c, [k]]; } return [c, []]; }),
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== e.length) return false; const c = {}; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], k = I.args[i][0], vals = Object.values(c); if (op === 'inc') c[k] = (c[k] || 0) + 1; else if (op === 'dec') { c[k]--; if (!c[k]) delete c[k]; } else if (op === 'getMaxKey') { if (!vals.length ? o[i] !== '' : c[o[i]] !== Math.max(...vals)) return false; } else if (!vals.length ? o[i] !== '' : c[o[i]] !== Math.min(...vals)) return false; } return true; },
    s(I, T) { return play(I, T, () => { const c = new Map(); return { c, inc(k) { c.set(k, (c.get(k) || 0) + 1); }, dec(k) { c.set(k, c.get(k) - 1); if (!c.get(k)) c.delete(k); }, getMaxKey() { let b = ''; for (const [k, v] of c) if (!b || v > c.get(b)) b = k; return b; }, getMinKey() { let b = ''; for (const [k, v] of c) if (!b || v < c.get(b)) b = k; return b; } }; }, { view: o => ({ counts: K(Object.fromEntries(o.c)) }), strOpts: o => [...o.c.keys(), 'a', 'b'], why: op => op === 'getMaxKey' ? 'A key in the highest-count bucket ("" if none).' : 'A key in the lowest-count bucket ("" if none).' }); }
  });
})();
