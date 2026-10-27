/* v2 games: tree (8). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  // Random binary tree whose values are distinct (shape from R.tree, values relabelled in level order).
  const dtree = (R, n, d) => { const a = R.tree(n, 1, 9, d || 4), vals = R.distinct(a.filter(x => x !== null).length, 1, 30); let k = 0; return a.map(x => x === null ? null : vals[k++]); };
  const pre = r => r ? [r.val, ...pre(r.left), ...pre(r.right)] : [];
  const ino = r => r ? [...ino(r.left), r.val, ...ino(r.right)] : [];
  const post = r => r ? [...post(r.left), ...post(r.right), r.val] : [];
  const levels = r => { const out = []; let q = r ? [r] : []; while (q.length) { out.push(q.map(x => x.val)); q = [].concat(...q.map(x => [x.left, x.right].filter(Boolean))); } return out; };
  const ordWrong = (good, all) => all.filter(x => show(x) !== show(good));

  D('array-representation-of-binary-trees', {
    t: 'Array Representation of Binary Trees',
    r: 'A complete tree stored level by level in an array: the node at index i has its left child at 2i + 1, its right child at 2i + 2, and its parent at (i − 1) divided by 2 rounded down. Indexes past the end mean no child.',
    exs: [{ in: { tree: [1, 2, 3, 4, 5] }, out: [-1, 0, 0, 1, 1] }],
    g: R => ({ tree: R.distinct(R.int(5, 10), 1, 30) }),
    s(I, T) { const a = I.tree, n = a.length, root = Tr.from(a); const i = 1, j = (n - 2) >> 1, k = n - 1; T.v(A(a, { hl: i, label: 'array' }), TR(root, { hit: Tr.find(root, a[i]) })); T.n(`Index of the left child of index ${i} (value ${a[i]})?`, 2 * i + 1 < n ? 2 * i + 1 : -1, `2 times ${i} + 1 = ${2 * i + 1}${2 * i + 1 < n ? '' : ', past the end, so answer −1'}.`); T.v(A(a, { hl: j, label: 'array' }), TR(root, { hit: Tr.find(root, a[j]) })); T.n(`Value of the right child of index ${j}? (−1 if none)`, 2 * j + 2 < n ? a[2 * j + 2] : -1, `Index 2 times ${j} + 2 = ${2 * j + 2}.`); T.v(A(a, { hl: k, label: 'array' }), TR(root, { hit: Tr.find(root, a[k]) })); T.n(`Index of the parent of index ${k}?`, (k - 1) >> 1, `(${k} − 1) divided by 2 rounded down.`); T.n(`Value of that parent?`, a[(k - 1) >> 1], 'Read the array at the parent index.'); return a.map((_, x) => x ? (x - 1) >> 1 : -1); }
  });

  // AVL insert that reports which rotation it made.
  const avlInsert = (root, v, log) => { const h = x => x ? x.h : 0, upd = x => { x.h = 1 + Math.max(h(x.left), h(x.right)); return x; }, bf = x => h(x.left) - h(x.right); const rr = y => { const x = y.left; y.left = x.right; x.right = y; upd(y); return upd(x); }, lr = x => { const y = x.right; x.right = y.left; y.left = x; upd(x); return upd(y); }; const ins = n => { if (!n) return { val: v, left: null, right: null, h: 1 }; if (v < n.val) n.left = ins(n.left); else n.right = ins(n.right); upd(n); const b = bf(n); if (b > 1 && v < n.left.val) { log.rot = 'LL: right rotate'; log.at = n.val; return rr(n); } if (b < -1 && v > n.right.val) { log.rot = 'RR: left rotate'; log.at = n.val; return lr(n); } if (b > 1) { log.rot = 'LR: left then right'; log.at = n.val; n.left = lr(n.left); return rr(n); } if (b < -1) { log.rot = 'RL: right then left'; log.at = n.val; n.right = rr(n.right); return lr(n); } return n; }; return ins(root); };
  const ROTS = ['none', 'LL: right rotate', 'RR: left rotate', 'LR: left then right', 'RL: right then left'];

  D('avl-tree', {
    t: 'AVL Tree Insertions',
    r: 'Insert as in a BST, then walk back up updating heights. Balance factor = height(left) − height(right). If it leaves the range −1 to 1, rotate: LL (new key in the left child\'s left side) right-rotates, RR left-rotates, LR rotates the child left then the node right, RL is the mirror.',
    exs: [{ in: { nums: [1, 2, 3] }, out: [2, 1, 3] }, { in: { nums: [3, 1, 2] }, out: [2, 1, 3] }],
    g: R => ({ nums: R.distinct(R.int(4, 6), 1, 20) }),
    s(I, T) { let root = null; I.nums.forEach((v, i) => { const log = {}; const before = root ? Tr.from(Tr.arr(root)) : null; root = avlInsert(root, v, log); if (i === 0) return; T.v(TR(before, null, { label: 'before insert' }), K({ insert: v })); T.c(`Insert ${v}: which rotation happens?`, ROTS, log.rot || 'none', log.rot ? `Node ${log.at} goes out of balance; the shape picks ${log.rot}.` : 'Every balance factor stays within −1 to 1.'); if (i >= 2) T.n(`Root value after inserting ${v}?`, root.val, log.rot ? 'Rotation can change the root.' : 'No rotation at the top.'); }); return Tr.arr(root); }
  });

  D('binary-search-tree', {
    t: 'Binary Search Tree: Search Path',
    r: 'In a BST every key in the left subtree is smaller than the node and every key in the right subtree is larger. To search, compare with the node: smaller goes left, larger goes right, equal is found, an empty child means missing.',
    exs: [{ in: { root: [4, 2, 6, 1, 3], target: 3 }, out: true }, { in: { root: [4, 2, 6, 1, 3], target: 5 }, out: false }],
    g: R => { const a = R.bst(R.int(5, 8), 1, 20), vals = a.filter(x => x !== null).slice(1); return { root: a, target: R.chance(0.75) ? vals[R.int(0, vals.length - 1)] : R.int(1, 20) }; },
    s(I, T) { const root = Tr.from(I.root), x = I.target; let c = root, seen = 0; while (c) { seen++; T.v(TR(root, { hit: c }), K({ target: x })); const mv = x === c.val ? 'found' : x < c.val ? 'go left' : 'go right'; T.c(`At ${c.val}: what next?`, ['go left', 'go right', 'found'], mv, `${x} vs ${c.val}.`); if (mv === 'found') break; c = mv === 'go left' ? c.left : c.right; } T.n('How many nodes did the search visit?', seen, 'One per comparison along the path.'); return !!c; }
  });

  D('binary-tree-traversal', {
    t: 'Binary Tree Traversals',
    r: 'Preorder visits root, left, right. Inorder visits left, root, right. Postorder visits left, right, root. Level order visits row by row, left to right.',
    exs: [{ in: { root: [1, 2, 3, 4] }, out: [[1, 2, 4, 3], [4, 2, 1, 3], [4, 2, 3, 1]] }],
    g: R => ({ root: dtree(R, R.int(4, 7)) }),
    s(I, T) { const root = Tr.from(I.root), P = pre(root), N = ino(root), O = post(root), L = [].concat(...levels(root)), n = P.length, k = Math.min(3, n), m = n - 1; T.at({ tree: TR(root) }); T.n(`The ${k === 3 ? '3rd' : k + 'th'} value in preorder?`, P[k - 1], `Preorder: ${P.join(', ')}.`); T.n('The first value in inorder?', N[0], 'Inorder starts at the leftmost node.'); T.n('The last value in postorder?', O[m], 'Postorder ends at the root.'); T.n('The 2nd value in level order?', L[1], `Level order: ${L.join(', ')}.`); return [P, N, O]; }
  });

  D('binary-tree', {
    t: 'Binary Tree Basics',
    r: 'Each node has at most a left and a right child. Size counts nodes. A leaf has no children. Height is the number of edges on the longest path from the root down to a leaf (a single node has height 0).',
    exs: [{ in: { root: [1, 2, 3, 4] }, out: [4, 2, 2] }],
    g: R => ({ root: dtree(R, R.int(4, 8)) }),
    s(I, T) { const root = Tr.from(I.root), nodes = Tr.nodes(root), leaves = nodes.filter(x => !x.left && !x.right), size = nodes.length, ht = Tr.depth(root) - 1, one = nodes.filter(x => !!x.left !== !!x.right).length; T.at({ tree: TR(root) }); T.n('How many nodes?', size, 'Count every node.'); T.n('How many leaves?', leaves.length, 'Nodes with no children.', null); T.v(TR(root, { ok: leaves })); T.n('Height in edges?', ht, 'Longest root-to-leaf path, counted in edges.'); T.n('How many nodes have exactly one child?', one, 'Left only or right only.'); return [size, ht, leaves.length]; }
  });

  D('building-a-binary-tree-problem', {
    t: 'Build a Tree from Preorder and Inorder',
    r: 'The first value of the preorder segment is the root. Find it in the inorder segment: everything left of it is the left subtree, everything right is the right subtree. The left subtree size tells you how to slice the preorder. Recurse on both sides.',
    exs: [{ in: { preorder: [3, 9, 20, 15, 7], inorder: [9, 3, 15, 20, 7] }, out: [3, 9, 20, null, null, 15, 7] }],
    g: R => { const r = Tr.from(dtree(R, R.int(4, 7))); return { preorder: pre(r), inorder: ino(r) }; },
    s(I, T) { const P = I.preorder, N = I.inorder; let asks = 0; const build = (pl, pr, il, ir) => { if (pl > pr) return null; const v = P[pl], k = N.indexOf(v), ls = k - il, node = { val: v, left: null, right: null }; if (pr > pl) { T.at({ preorder: A(P, { win: [pl, pr], hl: pl }), inorder: A(N, { win: [il, ir], hl: k }) }); T.n(`Segment preorder[${pl}..${pr}]: root is ${v}. How many nodes go in its left subtree?`, ls, `${v} sits at inorder index ${k}; ${k} − ${il} values are left of it.`); } node.left = build(pl + 1, pl + ls, il, k - 1); node.right = build(pl + ls + 1, pr, k + 1, ir); return node; }; const root = build(0, P.length - 1, 0, N.length - 1); T.at({ tree: TR(root) }); T.n('Height of the rebuilt tree in edges?', Tr.depth(root) - 1, 'Longest root-to-leaf path.'); return Tr.arr(root); }
  });

  D('labu-topic-a438281d8510', {
    t: 'Color-Marked Iterative Inorder',
    r: 'One stack of (node, color) pairs. Pop a pair. A white (new) node is expanded: push right as white, the node itself as gray, then left as white, so the left side pops first. A gray node is output. Moving the gray push changes the order to preorder or postorder.',
    exs: [{ in: { root: [1, 2, 3] }, out: [2, 1, 3] }, { in: { root: [1, null, 2, 3] }, out: [1, 3, 2] }],
    g: R => ({ root: dtree(R, R.int(3, 6)) }),
    s(I, T) { const root = Tr.from(I.root), st = root ? [[root, 'white']] : [], out = []; while (st.length) { const [nd, col] = st.pop(); if (col === 'white') { if (nd.right) st.push([nd.right, 'white']); st.push([nd, 'gray']); if (nd.left) st.push([nd.left, 'white']); } else { T.v(TR(root, { ok: Tr.nodes(root).filter(x => out.includes(x.val)) }), S(st.map(p => p[0].val + ' ' + p[1]).concat([nd.val + ' gray']), 'stack (top last)'), A(out, { label: 'output' })); T.n('Which value is output next?', nd.val, 'The popped pair is gray, so it is output now.'); out.push(nd.val); } } return out; }
  });

  D('labu-topic-a543d2b522f8', {
    t: 'Recursive Traversal: Where the Visit Goes',
    r: 'The same recursion skeleton visits left and right subtrees. Put the visit before both calls for preorder, between them for inorder, after both for postorder.',
    exs: [{ in: { root: [1, 2, 3] }, out: [[1, 2, 3], [2, 1, 3], [2, 3, 1]] }],
    g: R => ({ root: dtree(R, R.int(3, 6)) }),
    s(I, T) { const root = Tr.from(I.root), P = pre(root), N = ino(root), O = post(root), all = [P, N, O, P.slice().reverse(), O.slice().reverse()]; T.at({ tree: TR(root) }); T.c('Visit before both calls (preorder): what sequence?', [P, ...ordWrong(P, all)].slice(0, 4).map(show), show(P), 'Root first, then the whole left subtree, then the right.'); T.c('Visit between the calls (inorder): what sequence?', [N, ...ordWrong(N, all)].slice(0, 4).map(show), show(N), 'Left subtree, root, right subtree.'); T.c('Visit after both calls (postorder): what sequence?', [O, ...ordWrong(O, all)].slice(0, 4).map(show), show(O), 'Both subtrees first, root last.'); return [P, N, O]; }
  });

  D('labu-topic-fa5dd0ad591d', {
    t: 'Iterative Traversals: Queue and Stack',
    r: 'BFS uses a queue: take the front, push its children, so nodes come out level by level. Iterative preorder uses a stack: pop a node, output it, push its right child then its left child so the left pops first.',
    exs: [{ in: { root: [1, 2, 3] }, out: [[1], [2, 3]] }],
    g: R => ({ root: dtree(R, R.int(4, 7)) }),
    s(I, T) { const root = Tr.from(I.root), lv = levels(root); lv.forEach((row, d) => { if (d === 0) return; T.v(TR(root, { ok: [].concat(...lv.slice(0, d)).map(v => Tr.find(root, v)) }), Q(lv[d - 1], 'queue after level ' + (d - 1) + ' was taken')); T.n(`How many nodes are on level ${d}?`, row.length, 'Children of the previous level, in order.'); }); const st = [root], out = []; while (st.length) { const nd = st.pop(); out.push(nd.val); if (nd.right) st.push(nd.right); if (nd.left) st.push(nd.left); if (out.length === 2 || out.length === 3) { T.v(TR(root, { ok: out.map(v => Tr.find(root, v)) }), S(st.map(x => x.val), 'stack (top last)')); T.n(`Iterative preorder: which value pops next after ${out.join(', ')}?`, st.length ? st[st.length - 1].val : -1, 'The left child was pushed last, so it is on top.'); } } return lv; }
  });

  D('labu-topic-4f83fdf62752', {
    t: 'Tree Vocabulary: Depth, Height, Shapes',
    r: 'Depth of a node = edges from the root to it. Height of the tree = edges on the longest root-to-leaf path. Full: every node has 0 or 2 children. Complete: every level is full except maybe the last, which is filled from the left. Perfect: every level is full.',
    exs: [{ in: { root: [1, 2, 3, 4] }, out: [2, true, false, false] }],
    g: R => ({ root: R.chance(0.3) ? R.distinct(R.int(3, 7), 1, 30) : dtree(R, R.int(3, 7), 3) }),
    s(I, T) { const root = Tr.from(I.root), a = Tr.arr(root), nodes = Tr.nodes(root), ht = Tr.depth(root) - 1, complete = !a.includes(null), perfect = complete && nodes.length === 2 ** (ht + 1) - 1, full = nodes.every(x => !!x.left === !!x.right); const deep = nodes[nodes.length - 1], dep = levels(root).findIndex(r => r.includes(deep.val)); T.v(TR(root, { hit: deep })); T.n(`Depth of node ${deep.val}?`, dep, 'Edges from the root.'); T.n('Height of the tree?', ht, 'Edges on the longest root-to-leaf path.'); T.yn('Is the tree complete?', complete, complete ? 'Levels fill left to right with no gap.' : 'There is a gap before the last node in level order.'); T.yn('Is it perfect?', perfect, perfect ? 'Every level is full.' : 'Some level is not full.'); T.yn('Is it full (every node has 0 or 2 children)?', full, full ? 'No node has exactly one child.' : 'Some node has exactly one child.'); return [ht, complete, perfect, full]; }
  });
})();
