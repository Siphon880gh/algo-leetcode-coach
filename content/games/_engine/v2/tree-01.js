/* v2 games: trees (01). */
(function () {
  'use strict';
  const { D, A, G, K, X, Tr, TR, Ls } = LCGame.H;
  const N = (v, l, r) => ({ val: v, left: l || null, right: r || null });
  const inorder = (r, out = []) => { if (r) { inorder(r.left, out); out.push(r); inorder(r.right, out); } return out; };
  const preorder = (r, out = []) => { if (r) { out.push(r); preorder(r.left, out); preorder(r.right, out); } return out; };
  const naryFrom = a => { if (!a || !a.length) return null; const root = { val: a[0], children: [] }, q = [root]; let i = 2; while (i < a.length && q.length) { const n = q.shift(); while (i < a.length && a[i] !== null) { const c = { val: a[i], children: [] }; n.children.push(c); q.push(c); i++; } i++; } return root; };
  const naryGen = R => { const n = R.int(1, 7), vals = R.distinct(n, 1, 20), nodes = [{ val: vals[0], children: [] }]; for (let i = 1; i < n; i++) { const p = R.pick(nodes); const c = { val: vals[i], children: [] }; p.children.push(c); nodes.push(c); } const out = [nodes[0].val, null], q = [nodes[0]]; while (q.length) { const x = q.shift(); x.children.forEach(c => { out.push(c.val); q.push(c); }); out.push(null); } while (out.length && out[out.length - 1] === null) out.pop(); return out; };

  D('unique-binary-search-trees-ii', {
    t: 'Unique BSTs II: every root, every left × right',
    r: 'For a range lo … hi, each value r can be the root; combine every left tree from lo … r−1 with every right tree from r+1 … hi.',
    g: R => ({ n: R.int(1, 4) }),
    cmp: 'set',
    s(I, T) { const cat = [1, 1, 2, 5, 14]; const gen = (lo, hi) => { if (lo > hi) return [null]; const out = []; for (let r = lo; r <= hi; r++) for (const L of gen(lo, r - 1)) for (const Rt of gen(r + 1, hi)) out.push(N(r, L, Rt)); return out; }; for (let r = 1; r <= I.n; r++) { T.at({ values: A(Array.from({ length: I.n }, (_, i) => i + 1), { hl: [r - 1] }) }); T.n(`How many trees have root ${r}?`, cat[r - 1] * cat[I.n - r], `left shapes (${r - 1} nodes) × right shapes (${I.n - r} nodes).`); } return gen(1, I.n).map(Tr.arr); }
  });

  D('unique-binary-search-trees', {
    t: 'Unique BSTs: Catalan numbers',
    r: 'G(0) = G(1) = 1 and G(n) = Σ over root r of G(r − 1) · G(n − r).',
    g: R => ({ n: R.int(1, 8) }),
    s(I, T) { const g = [1, 1]; for (let n = 2; n <= I.n; n++) { g[n] = 0; for (let r = 1; r <= n; r++) g[n] += g[r - 1] * g[n - r]; T.at({ G: A(g) }); T.n(`G(${n})?`, g[n], 'Σ G(left) · G(right) over roots.'); } return g[I.n]; }
  });

  D('recover-binary-search-tree', {
    t: 'Recover BST: find the two inversions in inorder',
    r: 'Inorder of a BST is sorted. The first swapped node is the larger value at the first drop; the second is the smaller value at the last drop. Swap their values.',
    g: R => { const a = R.bst(R.int(2, 7), 1, 20), root = Tr.from(a), ns = Tr.nodes(root), i = R.int(0, ns.length - 1); let j; do j = R.int(0, ns.length - 1); while (j === i); [ns[i].val, ns[j].val] = [ns[j].val, ns[i].val]; return { root: Tr.arr(root) }; },
    s(I, T) { const root = Tr.from(I.root), io = inorder(root); let x = null, y = null; for (let i = 1; i < io.length; i++) if (io[i].val < io[i - 1].val) { if (!x) x = io[i - 1]; y = io[i]; } T.at({ tree: TR(root), inorder: A(io.map(n => n.val)) }); T.n('Drops in the inorder sequence?', io.filter((n, i) => i && n.val < io[i - 1].val).length, 'One if the swapped nodes are neighbours, otherwise two.'); T.n('First misplaced value?', x.val, 'The larger value at the first drop.'); T.n('Second misplaced value?', y.val, 'The smaller value at the last drop.'); [x.val, y.val] = [y.val, x.val]; return Tr.arr(root); }
  });

  D('same-tree', {
    t: 'Same Tree: compare node by node',
    r: 'Two trees are the same if both nodes are null, or both exist with equal values and their left and right subtrees are the same.',
    g: R => { const p = R.tree(R.int(1, 6)); let q = p.slice(); if (R.chance(0.5)) { const ns = Tr.nodes(Tr.from(q)); const r = Tr.from(q); const t = R.pick(Tr.nodes(r)); if (R.chance(0.5)) t.val += 1; else if (!t.left) t.left = N(R.int(1, 9)); else t.left = null; q = Tr.arr(r); } return { p, q }; },
    s(I, T) { const a = Tr.from(I.p), b = Tr.from(I.q); const go = (x, y) => { const ok = (!x && !y) || (x && y && x.val === y.val); if (x || y) { T.at({ p: TR(a, { hit: x }), q: TR(b, { hit: y }) }); T.yn(`Do these positions match (${x ? x.val : 'null'} vs ${y ? y.val : 'null'})?`, !!ok, 'Both null, or both present with equal values.'); } if (!ok) return false; if (!x) return true; return go(x.left, y.left) && go(x.right, y.right); }; return go(a, b); }
  });

  D('symmetric-tree', {
    t: 'Symmetric Tree: compare mirrored pairs',
    r: 'Compare left.left with right.right and left.right with right.left recursively; values must match.',
    g: R => { if (R.chance(0.5)) { const h = Tr.from(R.tree(R.int(1, 4), 1, 5, 3)); const mir = n => n ? N(n.val, mir(n.right), mir(n.left)) : null; const c = h ? JSON.parse(JSON.stringify(h)) : null; return { root: Tr.arr(N(R.int(1, 5), h, mir(c))) }; } return { root: R.tree(R.int(1, 7), 1, 3) }; },
    s(I, T) { const root = Tr.from(I.root); const go = (x, y) => { if (!x && !y) return true; const ok = !!(x && y && x.val === y.val); T.at({ tree: TR(root, { hit: [x, y].filter(Boolean) }) }); T.yn(`Is the mirrored pair (${x ? x.val : 'null'}, ${y ? y.val : 'null'}) equal?`, ok, 'Both present with the same value.'); return ok && go(x.left, y.right) && go(x.right, y.left); }; return go(root.left, root.right); }
  });

  D('maximum-depth-of-binary-tree', {
    t: 'Maximum Depth: 1 + deeper child',
    r: 'depth(node) = 1 + max(depth(left), depth(right)); depth(null) = 0.',
    g: R => ({ root: R.tree(R.int(1, 9), 1, 9, 5) }),
    s(I, T) { const root = Tr.from(I.root), tag = new Map(); const go = n => { if (!n) return 0; const d = 1 + Math.max(go(n.left), go(n.right)); if (n.left || n.right) { T.at({ tree: TR(root, { hit: n }, { tag }) }); T.n(`Depth of the subtree at ${n.val}?`, d, '1 + max(child depths).'); } tag.set(n, d); return d; }; return go(root); }
  });

  D('construct-binary-tree-from-preorder-and-inorder-traversal', {
    t: 'Build Tree From Preorder and Inorder',
    r: 'The next preorder value is the root of the current inorder range; values left of it in inorder form the left subtree, values right of it the right subtree.',
    g: R => { const r = Tr.from(R.tree(R.int(1, 7))); Tr.nodes(r).forEach((n, i) => n.val = i + 1); const v = R.shuffle(Tr.nodes(r).map(n => n.val)); Tr.nodes(r).forEach((n, i) => n.val = v[i]); return { preorder: preorder(r).map(n => n.val), inorder: inorder(r).map(n => n.val) }; },
    s(I, T) { let p = 0; const pos = new Map(I.inorder.map((v, i) => [v, i])); const go = (l, r) => { if (l > r) return null; const v = I.preorder[p++], m = pos.get(v); T.at({ preorder: A(I.preorder, { hl: [p - 1] }), inorder: A(I.inorder, { win: [l, r], hl: [m] }) }); T.n(`Size of the left subtree of ${v}?`, m - l, 'Inorder values left of the root.'); return N(v, go(l, m - 1), go(m + 1, r)); }; return Tr.arr(go(0, I.inorder.length - 1)); }
  });

  D('construct-binary-tree-from-inorder-and-postorder-traversal', {
    t: 'Build Tree From Inorder and Postorder',
    r: 'Read postorder from the back: each value is the root of the current inorder range. Build the right subtree first, then the left.',
    g: R => { const r = Tr.from(R.tree(R.int(1, 7))); const v = R.shuffle(Tr.nodes(r).map((_, i) => i + 1)); Tr.nodes(r).forEach((n, i) => n.val = v[i]); const post = []; const po = n => { if (n) { po(n.left); po(n.right); post.push(n.val); } }; po(r); return { inorder: inorder(r).map(n => n.val), postorder: post }; },
    s(I, T) { let p = I.postorder.length - 1; const pos = new Map(I.inorder.map((v, i) => [v, i])); const go = (l, r) => { if (l > r) return null; const v = I.postorder[p--], m = pos.get(v); T.at({ postorder: A(I.postorder, { hl: [p + 1] }), inorder: A(I.inorder, { win: [l, r], hl: [m] }) }); T.n(`Size of the right subtree of ${v}?`, r - m, 'Inorder values right of the root.'); const right = go(m + 1, r); return N(v, go(l, m - 1), right); }; return Tr.arr(go(0, I.inorder.length - 1)); }
  });

  D('convert-sorted-array-to-binary-search-tree', {
    t: 'Sorted Array to BST: middle as root',
    r: 'Pick the middle of the range as the root (here the upper middle), then build each half recursively. The tree stays height-balanced.',
    g: R => ({ nums: R.distinct(R.int(1, 8), -9, 9).sort((a, b) => a - b) }),
    s(I, T) { const go = (l, r) => { if (l > r) return null; const m = Math.ceil((l + r) / 2); T.at({ nums: A(I.nums, { win: [l, r] }) }); T.n(`Index of the root for range ${l}…${r}?`, m, 'Upper middle.'); return N(I.nums[m], go(l, m - 1), go(m + 1, r)); }; return Tr.arr(go(0, I.nums.length - 1)); }
  });

  D('convert-sorted-list-to-binary-search-tree', {
    t: 'Sorted List to BST: middle node as root',
    r: 'Collect the list values (or use slow/fast pointers); the middle element is the root, and each half becomes a subtree.',
    g: R => ({ head: R.distinct(R.int(0, 7), -9, 9).sort((a, b) => a - b) }),
    s(I, T) { const v = I.head; const go = (l, r) => { if (l > r) return null; const m = Math.ceil((l + r) / 2); T.at({ list: A(v, { win: [l, r] }) }); T.n(`Root value for positions ${l}…${r}?`, v[m], 'The middle node.'); return N(v[m], go(l, m - 1), go(m + 1, r)); }; return Tr.arr(go(0, v.length - 1)); }
  });

  D('balanced-binary-tree', {
    t: 'Balanced Binary Tree: heights bottom-up',
    r: 'Compute heights bottom-up; a node is balanced if both children are balanced and their heights differ by at most 1.',
    g: R => ({ root: R.tree(R.int(0, 8), 1, 9, 5) }),
    s(I, T) { const root = Tr.from(I.root); let ok = true; const h = n => { if (!n) return 0; const a = h(n.left), b = h(n.right); if (n.left || n.right) { T.at({ tree: TR(root, { hit: n }) }); T.n(`|left height − right height| at ${n.val}?`, Math.abs(a - b), `${a} vs ${b}.`); } if (Math.abs(a - b) > 1) ok = false; return 1 + Math.max(a, b); }; h(root); return ok; }
  });

  D('minimum-depth-of-binary-tree', {
    t: 'Minimum Depth: BFS to the first leaf',
    r: 'Go level by level; the first leaf you meet gives the minimum depth. (A node with one child is not a leaf.)',
    g: R => ({ root: R.tree(R.int(0, 9), 1, 9, 5) }),
    s(I, T) { const root = Tr.from(I.root); if (!root) return 0; let q = [root], d = 1; while (q.length) { const leaf = q.find(n => !n.left && !n.right); T.at({ tree: TR(root, { hit: q }), depth: d }); T.yn(`Is there a leaf at depth ${d}?`, !!leaf, 'Both children missing.'); if (leaf) return d; q = q.flatMap(n => [n.left, n.right].filter(Boolean)); d++; } }
  });

  D('path-sum', {
    t: 'Path Sum: subtract on the way down',
    r: 'Carry the remaining target down; at a leaf, check whether it is exactly the leaf value.',
    g: R => { const t = R.tree(R.int(1, 7), 1, 9); const root = Tr.from(t); const leaves = Tr.nodes(root).filter(n => !n.left && !n.right); let s = 0; if (R.chance(0.6)) { const paths = []; const go = (n, acc) => { if (!n) return; acc += n.val; if (!n.left && !n.right) paths.push(acc); go(n.left, acc); go(n.right, acc); }; go(root, 0); s = R.pick(paths); } else s = R.int(1, 30); return { root: t, targetSum: s }; },
    s(I, T) { const res = (() => { const root = Tr.from(I.root); const go = (n, rem) => { if (!n) return false; rem -= n.val; if (!n.left && !n.right) { T.at({ tree: TR(root, { hit: n }), remaining: rem }); T.yn(`Does the path ending at leaf ${n.val} hit the target?`, rem === 0, 'Remaining must be exactly 0.'); return rem === 0; } return go(n.left, rem) || go(n.right, rem); }; return go(root, I.targetSum); })(); T.yn('Does any root-to-leaf path hit the target?', res, 'Some leaf left exactly 0.'); return res; }
  });

  D('path-sum-ii', {
    t: 'Path Sum II: collect every matching path',
    r: 'DFS with the current path and remaining sum; at each leaf with remaining 0, record a copy of the path; pop on the way back.',
    g: R => { const t = R.tree(R.int(1, 7), 1, 5); const root = Tr.from(t), paths = []; const go = (n, acc) => { if (!n) return; acc += n.val; if (!n.left && !n.right) paths.push(acc); go(n.left, acc); go(n.right, acc); }; go(root, 0); return { root: t, targetSum: R.chance(0.7) ? R.pick(paths) : R.int(1, 20) }; },
    s(I, T) { const root = Tr.from(I.root), out = [], path = []; const go = (n, rem) => { if (!n) return; path.push(n.val); rem -= n.val; if (!n.left && !n.right) { T.at({ tree: TR(root, { hit: n }), path: A(path) }); T.yn(`Record path [${path}]?`, rem === 0, 'Its sum must equal the target.'); if (rem === 0) out.push(path.slice()); } go(n.left, rem); go(n.right, rem); path.pop(); }; go(root, I.targetSum); return out; }
  });

  D('flatten-binary-tree-to-linked-list', {
    t: 'Flatten Tree to Linked List: preorder chain',
    r: 'The list is the preorder. For each node with a left child: find the rightmost node of the left subtree, hang the right subtree there, move left to right.',
    g: R => ({ root: R.tree(R.int(0, 6)) }),
    s(I, T) { const res = (() => { const root = Tr.from(I.root), shown = Tr.from(I.root), mp = new Map(); { const a = preorder(root), b = preorder(shown); a.forEach((n, i) => mp.set(n, b[i])); } let cur = root; while (cur) { if (cur.left) { let p = cur.left; while (p.right) p = p.right; T.at({ original: TR(shown, { hit: mp.get(cur), ok: mp.get(p) }) }); T.n(`Rightmost node of ${cur.val}'s left subtree?`, p.val, 'The right subtree attaches there.'); p.right = cur.right; cur.right = cur.left; cur.left = null; } cur = cur.right; } return Tr.arr(root); })(); T.n('Nodes in the flattened list?', res.filter(v => v !== null).length, 'Same nodes, all on the right.'); return res; }
  });

  D('populating-next-right-pointers-in-each-node', {
    t: 'Next Right Pointers (Perfect Tree): use the level above',
    r: 'Walk each level with next pointers: left.next = right, and right.next = node.next.left.',
    g: R => { const d = R.int(1, 3), a = Array.from({ length: 2 ** d - 1 }, () => R.int(1, 9)); return { root: a }; },
    s(I, T) { const res = (() => { const root = Tr.from(I.root); if (!root) return []; const out = []; let level = [root]; while (level.length) { level.forEach((n, i) => n.next = level[i + 1] || null); const k = level[0]; if (level.length > 1) { T.at({ tree: TR(root, { hit: level }) }); T.n(`Value that ${k.val}.next points to?`, k.next.val, 'Its neighbor on the level.'); } level.forEach(n => out.push(n.val)); out.push('#'); level = level.flatMap(n => [n.left, n.right].filter(Boolean)); } return out; })(); T.n('Levels?', res.filter(v => v === '#').length, 'One # per level.'); return res; }
  });

  D('populating-next-right-pointers-in-each-node-ii', {
    t: 'Next Right Pointers II: link the next level with a dummy',
    r: 'Walk the current level with next pointers, appending each child to a dummy-headed list for the level below.',
    g: R => ({ root: R.tree(R.int(0, 8)) }),
    s(I, T) { const root = Tr.from(I.root); if (!root) return []; const out = []; let level = [root]; while (level.length) { level.forEach((n, i) => n.next = level[i + 1] || null); for (const n of level.slice(0, -1)) { T.at({ tree: TR(root, { hit: n }) }); T.n(`Value that ${n.val}.next points to?`, n.next.val, 'Next node on the same level.'); } level.forEach(n => out.push(n.val)); out.push('#'); level = level.flatMap(n => [n.left, n.right].filter(Boolean)); } return out; }
  });

  D('binary-tree-maximum-path-sum', {
    t: 'Binary Tree Maximum Path Sum: gain upward, best through',
    r: 'gain(n) = n.val + max(0, gain(left), gain(right)). The best path through n is n.val + max(0, gainL) + max(0, gainR).',
    g: R => ({ root: R.tree(R.int(1, 7), -9, 9) }),
    s(I, T) { const root = Tr.from(I.root); let best = -Infinity; const go = n => { if (!n) return 0; const a = Math.max(0, go(n.left)), b = Math.max(0, go(n.right)); best = Math.max(best, n.val + a + b); T.at({ tree: TR(root, { hit: n }), best }); T.n(`Gain passed up from ${n.val}?`, n.val + Math.max(a, b), 'Value + better non-negative child gain.'); return n.val + Math.max(a, b); }; go(root); return best; }
  });

  D('sum-root-to-leaf-numbers', {
    t: 'Sum Root-to-Leaf Numbers: carry ×10 + digit',
    r: 'Pass the number so far down: cur = cur × 10 + val. Add it at each leaf.',
    g: R => ({ root: R.tree(R.int(1, 7), 0, 9) }),
    s(I, T) { const root = Tr.from(I.root); let s = 0; const go = (n, c) => { if (!n) return; c = c * 10 + n.val; if (!n.left && !n.right) { T.at({ tree: TR(root, { hit: n }), total: s }); T.n(`Number formed at leaf ${n.val}?`, c, 'Digits along the path.'); s += c; } go(n.left, c); go(n.right, c); }; go(root, 0); return s; }
  });

  D('binary-tree-upside-down', {
    t: 'Binary Tree Upside Down: rotate along the left spine',
    r: 'Walk down the left spine. Each left child becomes the parent: its new left is the old right sibling, its new right is the old parent.',
    g: R => { let r = null; const k = R.int(0, 4); let v = 1; for (let i = 0; i < k; i++) r = N(v++, r, i && R.chance(0.6) ? N(v++) : null); if (r && !r.left && r.right) r.right = null; const fix = n => { if (!n) return; if (n.right && !n.left) n.right = null; fix(n.left); }; fix(r); return { root: Tr.arr(r) }; },
    s(I, T) { let cur = Tr.from(I.root), parent = null, sib = null; if (!cur) return []; const orig = cur; while (cur) { const nx = cur.left, ns = cur.right; T.at({ tree: TR(orig, { hit: cur }) }); if (parent) T.n(`New right child of ${cur.val}?`, parent.val, 'The old parent.'); cur.left = sib; cur.right = parent; parent = cur; sib = ns; cur = nx; } return Tr.arr(parent); }
  });

  D('count-complete-tree-nodes', {
    t: 'Count Complete Tree Nodes: compare edge heights',
    r: 'If the leftmost and rightmost depths match, the subtree is perfect: 2^h − 1 nodes. Otherwise recurse into both children.',
    g: R => ({ root: Array.from({ length: R.int(0, 12) }, (_, i) => i + 1) }),
    s(I, T) { const root = Tr.from(I.root); const go = n => { if (!n) return 0; let l = 0, r = 0, x = n; while (x) { l++; x = x.left; } x = n; while (x) { r++; x = x.right; } T.at({ tree: TR(root, { hit: n }) }); T.yn(`Is the subtree at ${n.val} perfect?`, l === r, `Left depth ${l}, right depth ${r}.`); return l === r ? 2 ** l - 1 : 1 + go(n.left) + go(n.right); }; return go(root); }
  });

  D('invert-binary-tree', {
    t: 'Invert Binary Tree: swap children everywhere',
    r: 'At every node, swap the left and right children (pre- or post-order).',
    g: R => ({ root: R.tree(R.int(0, 7)) }),
    s(I, T) { const root = Tr.from(I.root); for (const n of Tr.nodes(root)) { [n.left, n.right] = [n.right, n.left]; if (n.left || n.right) { T.at({ tree: TR(root, { hit: n }) }); T.n(`New left child of ${n.val} (0 if none)?`, n.left ? n.left.val : 0, 'The old right child.'); } } return Tr.arr(root); }
  });

  D('lowest-common-ancestor-of-a-binary-tree', {
    t: 'Lowest Common Ancestor: where the two searches meet',
    r: 'Return the node if it is p or q. Otherwise search both sides; if both sides return something, this node is the LCA; else pass up the non-null side.',
    g: R => { const n = R.int(2, 8), a = R.tree(n, 1, 9); const r = Tr.from(a); const vals = R.shuffle(Tr.nodes(r).map((_, i) => i + 1)); Tr.nodes(r).forEach((x, i) => x.val = vals[i]); const v = Tr.nodes(r).map(x => x.val); const p = R.pick(v); let q; do q = R.pick(v); while (q === p); return { root: Tr.arr(r), p, q }; },
    s(I, T) { const res = (() => { const root = Tr.from(I.root); let ans = null; const go = n => { if (!n) return null; if (n.val === I.p || n.val === I.q) return n; const l = go(n.left), r = go(n.right); if (l && r) { T.at({ tree: TR(root, { hit: n, ok: [l, r] }) }); T.yn(`Do both sides of ${n.val} return a target?`, true, 'p and q are split here.'); return n; } return l || r; }; ans = go(root); T.at({ tree: TR(root, { hit: ans }) }); T.n('LCA value?', ans.val, 'Where the searches meet, or the target that is an ancestor of the other.'); return ans.val; })(); T.yn('Is the LCA one of p and q?', res === I.p || res === I.q, 'True when one is an ancestor of the other.'); return res; }
  });

  D('count-univalue-subtrees', {
    t: 'Count Univalue Subtrees: bottom-up check',
    r: 'A subtree is univalue if both children are univalue and every existing child has the same value as the node.',
    g: R => ({ root: R.tree(R.int(0, 8), 1, 2) }),
    s(I, T) { const root = Tr.from(I.root); let c = 0; const go = n => { if (!n) return true; const a = go(n.left), b = go(n.right); const u = a && b && (!n.left || n.left.val === n.val) && (!n.right || n.right.val === n.val); T.at({ tree: TR(root, { hit: n }), count: c }); T.yn(`Is the subtree at this ${n.val} univalue?`, u, 'Children univalue and equal to it.'); if (u) c++; return u; }; go(root); return c; }
  });

  D('verify-preorder-sequence-in-binary-search-tree', {
    t: 'Verify BST Preorder: stack and lower bound',
    r: 'Keep a decreasing stack. A larger value pops smaller ones — the last popped becomes the lower bound. Any value below the bound is invalid.',
    g: R => R.chance(0.5) ? { preorder: preorder(Tr.from(R.bst(R.int(1, 7), 1, 20))).map(n => n.val) } : { preorder: R.distinct(R.int(1, 7), 1, 20) },
    s(I, T) { const st = []; let low = -Infinity; for (const [i, v] of I.preorder.entries()) { if (v < low) { T.at({ preorder: A(I.preorder, { hl: [i] }), low }); T.yn(`Is ${v} valid?`, false, `It is below the bound ${low}.`); return false; } while (st.length && st[st.length - 1] < v) low = st.pop(); st.push(v); T.at({ preorder: A(I.preorder, { hl: [i] }), stack: A(st) }); T.n('Lower bound now (−1 if none)?', low === -Infinity ? -1 : low, 'Last value popped.'); } return true; }
  });

  D('binary-tree-paths', {
    t: 'Binary Tree Paths: DFS with the path string',
    r: 'Extend the path with "->val" going down; at a leaf, record it.',
    g: R => ({ root: R.tree(R.int(1, 7)) }),
    cmp: 'set',
    s(I, T) { const root = Tr.from(I.root), out = []; const go = (n, p) => { if (!n) return; p = p ? p + '->' + n.val : String(n.val); if (!n.left && !n.right) { T.at({ tree: TR(root, { hit: n }) }); T.n(`How many nodes on the path to leaf ${n.val}?`, p.split('->').length, 'Root to leaf.'); out.push(p); } go(n.left, p); go(n.right, p); }; go(root, ''); return out; }
  });

  D('closest-binary-search-tree-value', {
    t: 'Closest BST Value: walk toward the target',
    r: 'From the root, update the best value (ties: smaller), then go left if target < node, else right.',
    g: R => ({ root: R.bst(R.int(1, 7), 1, 20), target: Math.round(R.int(0, 2100) / 100 * 1e6) / 1e6 }),
    s(I, T) { let n = Tr.from(I.root), best = n.val; const root = n; while (n) { const d = Math.abs(n.val - I.target), bd = Math.abs(best - I.target); if (d < bd || (d === bd && n.val < best)) best = n.val; T.at({ tree: TR(root, { hit: n }), target: I.target }); T.n('Closest value so far?', best, 'Smaller value on ties.'); n = I.target < n.val ? n.left : n.right; } return best; }
  });

  D('closest-binary-search-tree-value-ii', {
    t: 'Closest BST Values II: sliding window over inorder',
    r: 'Inorder gives sorted values. Keep a window of k values; when a new value is closer than the window\'s oldest, slide the window.',
    g: R => { const a = R.bst(R.int(1, 7), 1, 20); return { root: a, target: Math.round(R.int(0, 2100) / 100 * 1e6) / 1e6, k: R.int(1, Tr.size(Tr.from(a))) }; },
    cmp: 'set',
    s(I, T) { const res = (() => { const v = inorder(Tr.from(I.root)).map(n => n.val), w = []; for (const x of v) { if (w.length < I.k) w.push(x); else if (Math.abs(x - I.target) < Math.abs(w[0] - I.target)) { w.shift(); w.push(x); T.at({ inorder: A(v), window: A(w), target: I.target }); T.n('Oldest value in the window now?', w[0], 'Slid past a farther value.'); } else break; } return w; })(); T.n('Values returned?', res.length, 'Exactly k.'); return res; }
  });

  D('inorder-successor-in-bst', {
    t: 'Inorder Successor in BST: last left turn',
    r: 'From the root: if node > p, it is a candidate and go left; otherwise go right. The last candidate is the successor.',
    g: R => { const a = R.bst(R.int(1, 7), 1, 20); return { root: a, p: R.pick(a.filter(x => x !== null)) }; },
    s(I, T) { const root = Tr.from(I.root); let n = root, s = null; while (n) { const c = n.val > I.p; T.at({ tree: TR(root, { hit: n }), p: I.p }); T.yn(`Is ${n.val} a successor candidate?`, c, 'Greater than p.'); if (c) { s = n.val; n = n.left; } else n = n.right; } return s; }
  });

  D('binary-tree-longest-consecutive-sequence', {
    t: 'Longest Consecutive Path: extend when child = parent + 1',
    r: 'DFS with the current run length: if child.val = parent.val + 1 extend the run, otherwise restart at 1.',
    g: R => ({ root: R.tree(R.int(1, 8), 1, 5) }),
    s(I, T) { const root = Tr.from(I.root); let best = 0; const go = (n, p, len) => { if (!n) return; len = p && n.val === p.val + 1 ? len + 1 : 1; best = Math.max(best, len); if (p) { T.at({ tree: TR(root, { hit: n }) }); T.n(`Run length at ${n.val}?`, len, 'Extends only by +1 steps.'); } go(n.left, n, len); go(n.right, n, len); }; go(root, null, 0); return best; }
  });

  D('binary-tree-vertical-order-traversal', {
    t: 'Vertical Order Traversal: BFS with columns',
    r: 'BFS with a column index (left −1, right +1); append each node to its column list in BFS order; output columns from left to right.',
    g: R => ({ root: R.tree(R.int(0, 8)) }),
    s(I, T) { const root = Tr.from(I.root); if (!root) return []; const cols = new Map(), q = [[root, 0]]; while (q.length) { const [n, c] = q.shift(); if (!cols.has(c)) cols.set(c, []); cols.get(c).push(n.val); T.at({ tree: TR(root, { hit: n }) }); T.n(`Column of node ${n.val}?`, c, 'Left −1, right +1.'); if (n.left) q.push([n.left, c - 1]); if (n.right) q.push([n.right, c + 1]); } return [...cols.keys()].sort((a, b) => a - b).map(k => cols.get(k)); }
  });

  D('verify-preorder-serialization-of-a-binary-tree', {
    t: 'Verify Preorder Serialization: count open slots',
    r: 'Start with 1 slot. Each token fills a slot (fail if none); a number opens 2 more. Valid iff exactly 0 slots remain at the end.',
    g: R => { const t = R.chance(0.6) ? Tr.from(R.tree(R.int(1, 5))) : null; const out = []; const go = n => { if (!n) { out.push('#'); return; } out.push(n.val); go(n.left); go(n.right); }; go(t); if (R.chance(0.4)) out.splice(R.int(0, out.length - 1), 1); return { preorder: out.join(',') }; },
    s(I, T) { let slots = 1; const tok = I.preorder.split(','); for (const [i, t] of tok.entries()) { if (slots === 0) { T.at({ tokens: A(tok, { hl: [i] }) }); T.yn('Is there a slot for this token?', false, 'No open slots left.'); return false; } slots += t === '#' ? -1 : 1; T.at({ tokens: A(tok, { hl: [i] }) }); T.n(`Open slots after "${t}"?`, slots, t === '#' ? 'A null fills one.' : 'A node fills one and opens two.'); } return slots === 0; }
  });

  D('largest-bst-subtree', {
    t: 'Largest BST Subtree: return (min, max, size) upward',
    r: 'Post-order: a node roots a BST if both children do and left max < val < right min; its size is 1 + both sizes.',
    g: R => ({ root: R.tree(R.int(0, 8), 1, 12) }),
    s(I, T) { const root = Tr.from(I.root); let best = 0; const go = n => { if (!n) return [Infinity, -Infinity, 0]; const L = go(n.left), Rr = go(n.right); const ok = L[2] >= 0 && Rr[2] >= 0 && L[1] < n.val && n.val < Rr[0]; T.at({ tree: TR(root, { hit: n }), best }); T.yn(`Is the subtree at ${n.val} a BST?`, ok, 'Both children BSTs, left max < val < right min.'); if (!ok) return [0, 0, -1]; const sz = 1 + L[2] + Rr[2]; best = Math.max(best, sz); return [Math.min(L[0], n.val), Math.max(Rr[1], n.val), sz]; }; go(root); return best; }
  });

  D('house-robber-iii', {
    t: 'House Robber III: rob or skip each node',
    r: 'Each node returns (rob, skip): rob = val + skip(left) + skip(right); skip = max of each child\'s pair, summed.',
    g: R => ({ root: R.tree(R.int(1, 8), 0, 9) }),
    s(I, T) { const root = Tr.from(I.root); const go = n => { if (!n) return [0, 0]; const a = go(n.left), b = go(n.right); const rob = n.val + a[1] + b[1], skip = Math.max(...a) + Math.max(...b); T.at({ tree: TR(root, { hit: n }) }); T.n(`Best at ${n.val} if you rob it?`, rob, 'val + skip(children).'); return [rob, skip]; }; return Math.max(...go(root)); }
  });

  D('find-leaves-of-binary-tree', {
    t: 'Find Leaves: group by height from the bottom',
    r: 'height(leaf) = 0 and height(n) = 1 + max(child heights). Nodes with the same height are removed in the same round.',
    g: R => ({ root: R.tree(R.int(1, 8)) }),
    s(I, T) { const root = Tr.from(I.root), out = []; const go = n => { if (!n) return -1; const h = 1 + Math.max(go(n.left), go(n.right)); T.at({ tree: TR(root, { hit: n }) }); T.n(`Removal round (height) of ${n.val}?`, h, '1 + max child height; leaves are 0.'); (out[h] = out[h] || []).push(n.val); return h; }; go(root); return out; }
  });

  D('sum-of-left-leaves', {
    t: 'Sum of Left Leaves',
    r: 'Add a node\'s value only if it is a leaf and the left child of its parent.',
    g: R => ({ root: R.tree(R.int(1, 8)) }),
    s(I, T) { const res = (() => { const root = Tr.from(I.root); let s = 0; for (const n of Tr.nodes(root)) if (n.left && !n.left.left && !n.left.right) { T.at({ tree: TR(root, { hit: n.left }), sum: s }); T.n('Sum after adding this left leaf?', s + n.left.val, `Add ${n.left.val}.`); s += n.left.val; } return s; })(); T.n('Sum of left leaves?', res, 'Add every left leaf.'); return res; }
  });

  D('convert-binary-search-tree-to-sorted-doubly-linked-list', {
    t: 'BST to Sorted Doubly Linked List: inorder linking',
    r: 'Inorder traversal visits values in order; link prev ↔ cur as you go, then close the circle head ↔ tail.',
    g: R => ({ root: R.bst(R.int(0, 7), 1, 20) }),
    exIn: I => I.root && I.root.__raw ? { root: JSON.parse(I.root.__raw.match(/\[[^\]]*\]/)[0]) } : I,
    s(I, T) { const root = Tr.from(I.root); const io = inorder(root); io.forEach((n, i) => { if (i) { T.at({ tree: TR(root, { hit: n }), list: A(io.slice(0, i + 1).map(x => x.val)) }); T.n(`Predecessor linked to ${n.val}?`, io[i - 1].val, 'The previous inorder node.'); } }); return io.map(n => n.val); }
  });

  D('construct-quad-tree', {
    t: 'Construct Quad Tree: leaf if uniform, else split in four',
    r: 'If the region is all 0s or all 1s, make a leaf. Otherwise split into top-left, top-right, bottom-left, bottom-right and recurse.',
    g: R => { const k = R.int(0, 2), n = 2 ** k; return { grid: Array.from({ length: n }, () => Array.from({ length: n }, () => R.chance(0.7) ? 1 : 0)) }; },
    s(I, T) { const g = I.grid; const go = (r, c, n) => { let same = true; for (let i = r; i < r + n; i++) for (let j = c; j < c + n; j++) if (g[i][j] !== g[r][c]) same = false; if (n > 1 || r + c === 0) { const hl = []; for (let i = r; i < r + n; i++) for (let j = c; j < c + n; j++) hl.push([i, j]); T.at({ grid: G(g, { hl }) }); T.yn(`Is the ${n}×${n} region at (${r},${c}) a leaf?`, same, 'All cells equal.'); } if (same) return { leaf: 1, val: g[r][c] }; const h = n / 2; return { leaf: 0, val: 1, ch: [go(r, c, h), go(r, c + h, h), go(r + h, c, h), go(r + h, c + h, h)] }; }; const root = go(0, 0, g.length), out = [], q = [root]; while (q.length) { const x = q.shift(); if (!x) { out.push(null); continue; } out.push([x.leaf, x.val]); if (x.leaf) q.push(null, null, null, null); else q.push(...x.ch); } while (out.length && out[out.length - 1] === null) out.pop(); return out; }
  });

  D('serialize-and-deserialize-n-ary-tree', {
    t: 'Serialize N-ary Tree: children groups in level order',
    r: 'Level order with a null after each node\'s group of children. Deserializing: read the root, then for each node in queue order read children until a null.',
    g: R => ({ root: naryGen(R) }),
    s(I, T) { const root = naryFrom(I.root); if (!root) return []; const out = [root.val, null], q = [root]; while (q.length) { const n = q.shift(); if (n.children.length || q.length) { T.at({ node: n.val, serialized: A(out.slice(-12)) }); T.n(`How many children does ${n.val} have?`, n.children.length, 'Read until the next null.'); } n.children.forEach(c => { out.push(c.val); q.push(c); }); out.push(null); } while (out.length && out[out.length - 1] === null) out.pop(); return out; }
  });

  D('n-ary-tree-level-order-traversal', {
    t: 'N-ary Level Order: BFS level by level',
    r: 'Process the queue one level at a time; the next level is all children of the current level, in order.',
    g: R => ({ root: naryGen(R) }),
    s(I, T) { const root = naryFrom(I.root); if (!root) return []; const out = []; let lv = [root]; while (lv.length) { out.push(lv.map(n => n.val)); const nx = lv.flatMap(n => n.children); T.at({ levels: A(out.map(l => `[${l}]`)) }); if (nx.length) T.n(`How many nodes on level ${out.length}?`, nx.length, 'All children of the current level.'); lv = nx; } return out; }
  });
})();
