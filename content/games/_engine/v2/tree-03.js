/* v2 games: trees (03). */
(function () {
  'use strict';
  const { D, A, G, K, X, Tr, TR, GR } = LCGame.H;
  const N = (v, l, r) => ({ val: v, left: l || null, right: r || null });
  const inorder = (r, out = []) => { if (r) { inorder(r.left, out); out.push(r); inorder(r.right, out); } return out; };
  const preorder = (r, out = []) => { if (r) { out.push(r); preorder(r.left, out); preorder(r.right, out); } return out; };
  const postorder = (r, out = []) => { if (r) { postorder(r.left, out); postorder(r.right, out); out.push(r); } return out; };
  const leaf = n => !n.left && !n.right;
  const uniq = (R, n, maxD) => { const r = Tr.from(R.tree(n, 1, 9, maxD || 4)); const v = R.shuffle(Tr.nodes(r).map((_, i) => i + 1)); Tr.nodes(r).forEach((x, i) => x.val = v[i]); return r; };
  const maxTree = a => { const go = (l, r) => { if (l > r) return null; let m = l; for (let i = l; i <= r; i++) if (a[i] > a[m]) m = i; return N(a[m], go(l, m - 1), go(m + 1, r)); }; return go(0, a.length - 1); };
  const M = 1000000007n;

  const deepestLca = (I, T) => { const root = Tr.from(I.root); const go = n => { if (!n) return [0, null]; const [a, x] = go(n.left), [b, y] = go(n.right); if (n.left || n.right) { T.at({ tree: TR(root, { hit: n }) }); T.c(`Which side holds the deepest nodes under ${n.val}?`, ['left', 'right', 'both'], a > b ? 'left' : b > a ? 'right' : 'both', `Depths ${a} vs ${b}.`); } if (a > b) return [a + 1, x]; if (b > a) return [b + 1, y]; return [a + 1, n]; }; return Tr.arr(go(root)[1]); };
  D('smallest-subtree-with-all-the-deepest-nodes', {
    t: 'Smallest Subtree With All the Deepest Nodes',
    r: 'Each node returns (depth of its deepest node, answer). If both sides are equally deep, this node is the answer; otherwise pass up the deeper side\'s answer.',
    g: R => ({ root: Tr.arr(uniq(R, R.int(1, 9))) }),
    s: deepestLca
  });
  D('lowest-common-ancestor-of-deepest-leaves', {
    t: 'LCA of Deepest Leaves: compare subtree depths',
    r: 'Each node returns (depth, LCA of its deepest leaves). Equal depths on both sides make this node the LCA; otherwise take the deeper side\'s result.',
    g: R => ({ root: Tr.arr(uniq(R, R.int(1, 9))) }),
    s: deepestLca
  });

  D('leaf-similar-trees', {
    t: 'Leaf-Similar Trees: compare leaf sequences',
    r: 'Collect the leaves of each tree from left to right (DFS) and compare the two sequences.',
    g: R => { const a = R.tree(R.int(1, 7), 1, 4); return { root1: a, root2: R.chance(0.4) ? a : R.tree(R.int(1, 7), 1, 4) }; },
    s(I, T) { const lv = a => Tr.nodes(Tr.from(a)).length && preorder(Tr.from(a)).filter(leaf).map(n => n.val); const a = lv(I.root1), b = lv(I.root2); T.at({ root1: TR(Tr.from(I.root1)), leaves1: A(a) }); T.n('How many leaves does tree 1 have?', a.length, 'Nodes without children.'); T.at({ root2: TR(Tr.from(I.root2)), leaves2: A(b) }); T.n('How many leaves does tree 2 have?', b.length, 'Nodes without children.'); return a.join() === b.join(); }
  });

  D('construct-binary-tree-from-preorder-and-postorder-traversal', {
    t: 'Build Tree From Preorder and Postorder: next preorder is the left root',
    r: 'Root = preorder[0]. The next preorder value is the left child\'s root; its position in postorder tells the left subtree size.',
    g: R => { const r = uniq(R, R.int(1, 7)); return { preorder: preorder(r).map(n => n.val), postorder: postorder(r).map(n => n.val) }; },
    cmp: (out, exp, I) => { const r = Tr.from(out); return JSON.stringify(preorder(r).map(n => n.val)) === JSON.stringify(I.preorder) && JSON.stringify(postorder(r).map(n => n.val)) === JSON.stringify(I.postorder); },
    s(I, T) { const pos = new Map(I.postorder.map((v, i) => [v, i])); const go = (a, b, n) => { if (!n) return null; const root = N(I.preorder[a]); if (n === 1) return root; const L = pos.get(I.preorder[a + 1]) - b + 1; T.at({ preorder: A(I.preorder, { win: [a, a + n - 1], hl: [a + 1] }), postorder: A(I.postorder, { win: [b, b + n - 1] }) }); T.n(`Left subtree size under ${root.val}?`, L, `Position of ${I.preorder[a + 1]} in postorder decides it.`); root.left = go(a + 1, b, L); root.right = go(a + 1 + L, b + L, n - 1 - L); return root; }; return Tr.arr(go(0, 0, I.preorder.length)); }
  });

  D('all-possible-full-binary-trees', {
    t: 'All Possible Full Binary Trees: split the odd count',
    r: 'A full tree with n nodes has a root plus left (i nodes) and right (n − 1 − i nodes), both odd. Combine all smaller results (memoized).',
    g: R => ({ n: R.int(1, 7) }),
    cmp: 'set',
    s(I, T) { const memo = new Map(), cnt = [0, 1]; const go = n => { if (memo.has(n)) return memo.get(n); const out = []; if (n === 1) out.push(N(0)); else if (n % 2) for (let i = 1; i < n; i += 2) for (const l of go(i)) for (const r of go(n - 1 - i)) out.push(N(0, l, r)); memo.set(n, out); return out; }; for (let k = 3; k <= I.n; k += 2) { const c = go(k).length; T.at({ counts: A([1, ...[3, 5, 7].filter(x => x < k).map(x => go(x).length)]) }); T.n(`Number of full trees with ${k} nodes?`, c, 'Σ over odd splits of left × right.'); } return go(I.n).map(Tr.arr); }
  });

  D('increasing-order-search-tree', {
    t: 'Increasing Order Search Tree: relink in inorder',
    r: 'Inorder traversal; each visited node becomes the right child of the previous one and loses its left child.',
    g: R => ({ root: R.bst(R.int(1, 7), 0, 20) }),
    s(I, T) { const io = inorder(Tr.from(I.root)); io.forEach((n, i) => { if (i) { T.at({ order: A(io.map(x => x.val), { hl: [i] }) }); T.n(`Parent of ${n.val} in the new chain?`, io[i - 1].val, 'The previous inorder node.'); } }); const d = N(0); let t = d; for (const n of io) { n.left = null; t.right = n; t = n; } t.right = null; return Tr.arr(d.right); }
  });

  D('range-sum-of-bst', {
    t: 'Range Sum of BST: prune with the BST order',
    r: 'If node < low, only the right subtree can help; if node > high, only the left; otherwise add it and visit both.',
    g: R => ({ root: R.bst(R.int(1, 7), 1, 20), low: R.int(1, 10), high: R.int(10, 20) }),
    s(I, T) { const root = Tr.from(I.root); let s = 0; const go = n => { if (!n) return; const w = n.val < I.low ? 'go right only' : n.val > I.high ? 'go left only' : 'add and visit both'; T.at({ tree: TR(root, { hit: n }), sum: s }); T.c(`At ${n.val}?`, ['go right only', 'go left only', 'add and visit both'], w, `Range [${I.low}, ${I.high}].`); if (n.val < I.low) go(n.right); else if (n.val > I.high) go(n.left); else { s += n.val; go(n.left); go(n.right); } }; go(root); return s; }
  });

  D('flip-equivalent-binary-trees', {
    t: 'Flip Equivalent Trees: match children either way',
    r: 'Roots must match; then the children must match either straight (left–left, right–right) or flipped (left–right, right–left).',
    g: R => { const a = uniq(R, R.int(0, 7)); const flip = n => { if (!n) return null; const l = flip(n.left), r = flip(n.right); return R.chance(0.5) ? N(n.val, r, l) : N(n.val, l, r); }; let b = flip(a); if (b && R.chance(0.3)) { const x = R.pick(Tr.nodes(b)); x.val = 50; } return { root1: Tr.arr(a), root2: Tr.arr(b) }; },
    s(I, T) { const a = Tr.from(I.root1), b = Tr.from(I.root2); const v = x => x ? x.val : null; const go = (x, y) => { if (!x || !y) return x === y; if (x.val !== y.val) return false; const straight = v(x.left) === v(y.left) && v(x.right) === v(y.right); T.at({ root1: TR(a, { hit: x }), root2: TR(b, { hit: y }) }); T.c(`At ${x.val}, how do the children line up?`, ['straight', 'flipped'], straight ? 'straight' : 'flipped', 'Compare child values.'); return straight ? go(x.left, y.left) && go(x.right, y.right) : go(x.left, y.right) && go(x.right, y.left); }; return go(a, b); }
  });

  D('check-completeness-of-a-binary-tree', {
    t: 'Completeness of a Binary Tree: no node after a gap',
    r: 'BFS including nulls. Once a null has been seen, any later real node means the tree is not complete.',
    g: R => R.chance(0.5) ? { root: Array.from({ length: R.int(1, 10) }, (_, i) => i + 1) } : { root: R.tree(R.int(1, 8)) },
    s(I, T) { const root = Tr.from(I.root), q = [root]; let gap = false; while (q.length) { const n = q.shift(); if (!n) { gap = true; continue; } T.at({ tree: TR(root, { hit: n }) }); T.yn(`Has a gap appeared before ${n.val}?`, gap, 'A null earlier in BFS order.'); if (gap) return false; q.push(n.left, n.right); } return true; }
  });

  D('univalued-binary-tree', {
    t: 'Univalued Binary Tree',
    r: 'Every node must equal the root value.',
    g: R => ({ root: R.tree(R.int(1, 7), 1, R.chance(0.5) ? 1 : 2) }),
    s(I, T) { const root = Tr.from(I.root); for (const n of Tr.nodes(root)) { T.at({ tree: TR(root, { hit: n }) }); T.yn(`Does ${n.val} match the root?`, n.val === root.val, `Root is ${root.val}.`); if (n.val !== root.val) return false; } return true; }
  });

  D('binary-tree-cameras', {
    t: 'Binary Tree Cameras: cover from the leaves up',
    r: 'Post-order states: 0 = not covered, 1 = has a camera, 2 = covered. If a child is uncovered, put a camera here; else if a child has a camera, this is covered; else report uncovered. Fix the root at the end.',
    g: R => ({ root: R.tree(R.int(1, 9), 0, 0) }),
    s(I, T) { const root = Tr.from(I.root); let cams = 0; const go = n => { if (!n) return 2; const a = go(n.left), b = go(n.right); const st = a === 0 || b === 0 ? 1 : a === 1 || b === 1 ? 2 : 0; T.at({ tree: TR(root, { hit: n }), cameras: cams }); T.c('State of this node?', ['camera', 'covered', 'uncovered'], ['uncovered', 'camera', 'covered'][st], 'Camera if a child is uncovered; covered if a child has a camera.'); if (st === 1) cams++; return st; }; if (go(root) === 0) cams++; return cams; }
  });

  D('flip-binary-tree-to-match-preorder-traversal', {
    t: 'Flip Tree to Match Voyage: flip when the left child mismatches',
    r: 'Preorder DFS with a pointer into voyage. If the node mismatches, fail. If the left child exists and is not the next voyage value, flip this node (visit right first).',
    g: R => { const r = uniq(R, R.int(1, 7)); const v = []; const go = n => { if (!n) return; v.push(n.val); if (R.chance(0.4)) { go(n.right); go(n.left); } else { go(n.left); go(n.right); } }; go(r); return { root: Tr.arr(r), voyage: R.chance(0.2) ? R.shuffle(v) : v }; },
    cmp: 'set',
    s(I, T) { const root = Tr.from(I.root), out = []; let i = 0, ok = true; const go = n => { if (!n || !ok) return; if (n.val !== I.voyage[i++]) { ok = false; return; } const flip = !!(n.left && n.left.val !== I.voyage[i]); if (n.left || n.right) { T.at({ tree: TR(root, { hit: n }), voyage: A(I.voyage, { hl: [i] }) }); T.yn(`Flip ${n.val}?`, flip, 'Left child is not the next voyage value.'); } if (flip) { out.push(n.val); go(n.right); go(n.left); } else { go(n.left); go(n.right); } }; go(root); return ok ? out : [-1]; }
  });

  D('distribute-coins-in-binary-tree', {
    t: 'Distribute Coins: excess flows across each edge',
    r: 'Post-order: excess(n) = coins − 1 + excess(left) + excess(right). Each edge carries |excess(child)| moves.',
    g: R => { const r = Tr.from(R.tree(R.int(1, 7), 0, 0)), ns = Tr.nodes(r); for (let i = 0; i < ns.length; i++) R.pick(ns).val++; return { root: Tr.arr(r) }; },
    s(I, T) { const root = Tr.from(I.root); let m = 0; const go = n => { if (!n) return 0; const a = go(n.left), b = go(n.right); m += Math.abs(a) + Math.abs(b); const e = n.val - 1 + a + b; T.at({ tree: TR(root, { hit: n }), moves: m }); T.n(`Excess passed up from this node (${n.val} coins)?`, e, 'coins − 1 + children\'s excess.'); return e; }; go(root); return m; }
  });

  D('vertical-order-traversal-of-a-binary-tree', {
    t: 'Vertical Order Traversal: sort by column, row, value',
    r: 'Record (col, row, val) for every node; sort by column, then row, then value; group by column.',
    g: R => ({ root: R.tree(R.int(1, 8), 1, 5) }),
    s(I, T) { const root = Tr.from(I.root), pts = []; const go = (n, r, c) => { if (!n) return; pts.push([c, r, n.val]); T.at({ tree: TR(root, { hit: n }) }); T.n(`Column of this ${n.val}?`, c, 'Left −1, right +1.'); go(n.left, r + 1, c - 1); go(n.right, r + 1, c + 1); }; go(root, 0, 0); pts.sort((a, b) => a[0] - b[0] || a[1] - b[1] || a[2] - b[2]); const out = []; let last = null; for (const [c, , v] of pts) { if (c !== last) { out.push([]); last = c; } out[out.length - 1].push(v); } return out; }
  });

  D('smallest-string-starting-from-leaf', {
    t: 'Smallest String Starting From Leaf: compare at the leaves',
    r: 'DFS building the path; at each leaf, the candidate is the path reversed. Keep the lexicographically smallest.',
    g: R => ({ root: R.tree(R.int(1, 7), 0, 3) }),
    s(I, T) { const root = Tr.from(I.root); let best = null; const go = (n, p) => { if (!n) return; p = String.fromCharCode(97 + n.val) + p; if (leaf(n)) { const better = best === null || p < best; T.at({ tree: TR(root, { hit: n }), best: best || '—' }); T.yn(`Is "${p}" smaller than the best so far?`, better, 'Lexicographic comparison.'); if (better) best = p; } go(n.left, p); go(n.right, p); }; go(root, ''); return best; }
  });

  D('cousins-in-binary-tree', {
    t: 'Cousins in Binary Tree: same depth, different parents',
    r: 'Find each node\'s depth and parent; cousins need equal depths and different parents.',
    g: R => { const r = uniq(R, R.int(2, 8)); const v = Tr.nodes(r).map(n => n.val), x = R.pick(v); let y; do y = R.pick(v); while (y === x); return { root: Tr.arr(r), x, y }; },
    s(I, T) { const root = Tr.from(I.root), info = new Map(); const go = (n, p, d) => { if (!n) return; info.set(n.val, [p, d]); go(n.left, n.val, d + 1); go(n.right, n.val, d + 1); }; go(root, null, 0); const [px, dx] = info.get(I.x), [py, dy] = info.get(I.y); T.at({ tree: TR(root, { hit: [Tr.find(root, I.x), Tr.find(root, I.y)] }) }); T.n(`Depth of ${I.x}?`, dx, 'Edges from the root.'); T.n(`Depth of ${I.y}?`, dy, 'Edges from the root.'); return dx === dy && px !== py; }
  });

  D('maximum-binary-tree-ii', {
    t: 'Maximum Binary Tree II: append val down the right spine',
    r: 'val is appended at the end of the array, so it goes on the right spine: walk right while nodes are larger; the first smaller subtree becomes val\'s left child.',
    g: R => { let a, val; do { a = R.distinct(R.int(2, 7), 1, 30); val = a.pop(); } while (Tr.depth(maxTree([...a, val])) > 5); return { root: Tr.arr(maxTree(a)), val }; },
    s(I, T) { const root = Tr.from(I.root); if (I.val > root.val) { T.at({ tree: TR(root, { hit: root }) }); T.yn(`Does ${I.val} become the new root?`, true, 'It beats the current root.'); return Tr.arr(N(I.val, root)); } let p = root; while (p.right && p.right.val > I.val) p = p.right; T.at({ tree: TR(root, { hit: p }) }); T.n('Under which node does val attach (as right child)?', p.val, 'Last right-spine node larger than val.'); p.right = N(I.val, p.right); return Tr.arr(root); }
  });

  D('construct-binary-search-tree-from-preorder-traversal', {
    t: 'BST From Preorder: build with an upper bound',
    r: 'Recursively take the next value as the root if it is below the current bound; build the left subtree with bound = root, then the right with the parent\'s bound.',
    g: R => ({ preorder: preorder(Tr.from(R.bst(R.int(1, 7), 1, 20))).map(n => n.val) }),
    s(I, T) { let i = 0; const go = b => { if (i >= I.preorder.length || I.preorder[i] > b) return null; const n = N(I.preorder[i++]); T.at({ preorder: A(I.preorder, { hl: [i - 1] }), bound: b === Infinity ? '∞' : b }); T.n(`Bound for ${n.val}'s left subtree?`, n.val, 'The node itself.'); n.left = go(n.val); n.right = go(b); return n; }; return Tr.arr(go(Infinity)); }
  });

  D('sum-of-root-to-leaf-binary-numbers', {
    t: 'Sum of Root-to-Leaf Binary Numbers: shift and add',
    r: 'Carry cur = cur × 2 + bit down the tree; add cur at each leaf.',
    g: R => ({ root: R.tree(R.int(1, 7), 0, 1) }),
    s(I, T) { const root = Tr.from(I.root); let s = 0; const go = (n, c) => { if (!n) return; c = c * 2 + n.val; if (leaf(n)) { T.at({ tree: TR(root, { hit: n }), total: s }); T.n('Number at this leaf?', c, 'Binary value of the path.'); s += c; } go(n.left, c); go(n.right, c); }; go(root, 0); return s; }
  });

  D('maximum-difference-between-node-and-ancestor', {
    t: 'Max Difference Between Node and Ancestor: carry min and max',
    r: 'Pass down the min and max values on the path; at each node the best difference is max(|val − min|, |val − max|).',
    g: R => ({ root: R.tree(R.int(2, 8), 0, 15) }),
    s(I, T) { const root = Tr.from(I.root); let best = 0; const go = (n, lo, hi) => { if (!n) return; best = Math.max(best, Math.abs(n.val - lo), Math.abs(n.val - hi)); if (n !== root) { T.at({ tree: TR(root, { hit: n }), min: lo, max: hi }); T.n('Best difference so far?', best, 'Compare with the path min and max.'); } go(n.left, Math.min(lo, n.val), Math.max(hi, n.val)); go(n.right, Math.min(lo, n.val), Math.max(hi, n.val)); }; go(root, root.val, root.val); return best; }
  });

  D('recover-a-tree-from-preorder-traversal', {
    t: 'Recover Tree From Preorder: dashes give depth',
    r: 'Read (depth, value) pairs. Pop the stack until its size equals the depth; attach the node as the top\'s left child if empty, else right; push it.',
    g: R => { const r = Tr.from(R.tree(R.int(1, 7))); const fix = n => { if (!n) return; if (n.right && !n.left) { n.left = n.right; n.right = null; } fix(n.left); fix(n.right); }; fix(r); let s = ''; const go = (n, d) => { if (!n) return; s += '-'.repeat(d) + n.val; go(n.left, d + 1); go(n.right, d + 1); }; go(r, 0); return { traversal: s }; },
    s(I, T) { const st = [], toks = [...I.traversal.matchAll(/(-*)(\d+)/g)]; let root = null; for (const [, d, v] of toks) { const n = N(+v); while (st.length > d.length) st.pop(); if (!st.length) root = n; else { const p = st[st.length - 1]; if (!p.left) p.left = n; else p.right = n; T.at({ stack: A(st.map(x => x.val)), node: n.val }); T.n(`Parent of ${n.val}?`, p.val, `Depth ${d.length}: stack top after popping.`); } st.push(n); } return Tr.arr(root); }
  });

  D('binary-search-tree-to-greater-sum-tree', {
    t: 'BST to Greater Sum Tree: reverse inorder',
    r: 'Visit right, node, left with a running sum; each node becomes the running sum including itself.',
    g: R => ({ root: R.bst(R.int(1, 7), 0, 15) }),
    s(I, T) { const root = Tr.from(I.root); let s = 0; const go = n => { if (!n) return; go(n.right); s += n.val; T.at({ tree: TR(root, { hit: n }), running: s }); T.n(`New value for ${n.val}?`, s, 'Itself plus all larger keys.'); n.val = s; go(n.left); }; go(root); return Tr.arr(root); }
  });

  D('insufficient-nodes-in-root-to-leaf-paths', {
    t: 'Insufficient Nodes: prune bottom-up',
    r: 'At a leaf, keep it if the path sum ≥ limit. At an internal node, prune the children first; if both are gone, this node is insufficient too.',
    g: R => ({ root: R.tree(R.int(1, 8), -4, 6), limit: R.int(-2, 10) }),
    s(I, T) { const root = Tr.from(I.root); const go = (n, s) => { s += n.val; if (leaf(n)) { T.at({ tree: TR(root, { hit: n }), pathSum: s }); T.yn(`Keep leaf ${n.val}?`, s >= I.limit, `${s} vs limit ${I.limit}.`); return s >= I.limit ? n : null; } if (n.left) n.left = go(n.left, s); if (n.right) n.right = go(n.right, s); return n.left || n.right ? n : null; }; return Tr.arr(go(root, 0)); }
  });

  D('path-in-zigzag-labelled-binary-tree', {
    t: 'Path in Zigzag Labelled Tree: mirror, then halve',
    r: 'In a normal heap the parent is label / 2. Zigzag rows mirror labels within the row: parent = (2^level + 2^(level+1) − 1 − label) / 2.',
    g: R => ({ label: R.int(1, 100) }),
    s(I, T) { let l = I.label, lv = Math.floor(Math.log2(l)); const out = []; while (l >= 1) { out.push(l); if (l === 1) break; const p = Math.floor((2 ** lv + 2 ** (lv + 1) - 1 - l) / 2); T.at({ path: A(out.slice().reverse()), level: lv }); T.n(`Parent of ${l}?`, p, 'Mirror within the row, then halve.'); l = p; lv--; } return out.reverse(); }
  });

  D('delete-nodes-and-return-forest', {
    t: 'Delete Nodes and Return Forest: roots appear below deleted nodes',
    r: 'Post-order: a kept node becomes a forest root if its parent was deleted (or it is the root). A deleted node detaches and makes its children candidates.',
    g: R => { const r = uniq(R, R.int(1, 8)); return { root: Tr.arr(r), to_delete: R.distinct(R.int(1, 3), 1, Tr.size(r)) }; },
    cmp: 'set',
    s(I, T) { const root = Tr.from(I.root), del = new Set(I.to_delete), out = []; const go = (n, isRoot) => { if (!n) return null; const d = del.has(n.val); if (isRoot && !d) { T.at({ tree: TR(root, { hit: n }) }); T.yn(`Is ${n.val} the root of a new tree?`, true, 'Its parent was deleted (or it is the top).'); out.push(n); } n.left = go(n.left, d); n.right = go(n.right, d); return d ? null : n; }; go(root, true); return out.map(Tr.arr); }
  });

  D('maximum-average-subtree', {
    t: 'Maximum Average Subtree: (sum, count) bottom-up',
    r: 'Each node returns its subtree sum and size; its average is sum / size. Track the best.',
    g: R => ({ root: R.tree(R.int(1, 7), 0, 9) }),
    cmp: 'float',
    s(I, T) { const root = Tr.from(I.root); let best = -Infinity; const go = n => { if (!n) return [0, 0]; const a = go(n.left), b = go(n.right), s = n.val + a[0] + b[0], c = 1 + a[1] + b[1]; T.at({ tree: TR(root, { hit: n }) }); T.n(`Subtree sum at ${n.val}?`, s, `${c} node(s).`); best = Math.max(best, s / c); return [s, c]; }; go(root); return best; }
  });

  D('binary-tree-coloring-game', {
    t: 'Binary Tree Coloring Game: take the biggest region',
    r: 'Player 2 should color a neighbor of x: left child, right child or parent. Each choice claims that region; win if one region holds more than n / 2 nodes.',
    g: R => { let r; do r = uniq(R, R.int(1, 9)); while (Tr.size(r) % 2 === 0); return { root: Tr.arr(r), n: Tr.size(r), x: R.int(1, Tr.size(r)) }; },
    s(I, T) { const root = Tr.from(I.root), x = Tr.find(root, I.x), sz = Tr.size; const l = sz(x.left), r = sz(x.right), p = I.n - 1 - l - r; T.at({ tree: TR(root, { hit: x }) }); T.n('Nodes in x\'s left subtree?', l, 'Region if you take the left child.'); T.n('Nodes in x\'s right subtree?', r, 'Region if you take the right child.'); T.n('Nodes on the parent side?', p, 'n − 1 − left − right.'); return Math.max(l, r, p) > I.n / 2; }
  });

  D('maximum-level-sum-of-a-binary-tree', {
    t: 'Maximum Level Sum: smallest level with the largest sum',
    r: 'BFS summing each level; keep the first level with the strictly largest sum.',
    g: R => ({ root: R.tree(R.int(1, 9), -5, 9) }),
    s(I, T) { const root = Tr.from(I.root); let lv = [root], d = 1, best = -Infinity, bd = 1; while (lv.length) { const s = lv.reduce((a, n) => a + n.val, 0); T.at({ tree: TR(root, { hit: lv }), best: best === -Infinity ? '—' : best }); T.n(`Sum of level ${d}?`, s, 'Add the level.'); if (s > best) { best = s; bd = d; } lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); d++; } return bd; }
  });

  D('two-sum-bsts', {
    t: 'Two Sum BSTs: set of one tree, lookups from the other',
    r: 'Put tree 1 values in a set, then for each value v in tree 2 check whether target − v is in the set.',
    g: R => ({ root1: R.bst(R.int(1, 6), -5, 10), root2: R.bst(R.int(1, 6), -5, 10), target: R.int(-5, 15) }),
    s(I, T) { const s = new Set(Tr.nodes(Tr.from(I.root1)).map(n => n.val)), r2 = Tr.from(I.root2); for (const n of Tr.nodes(r2)) { const hit = s.has(I.target - n.val); T.at({ set1: s, root2: TR(r2, { hit: n }) }); T.yn(`Is ${I.target - n.val} in tree 1?`, hit, `${n.val} + ${I.target - n.val} = ${I.target}.`); if (hit) return true; } return false; }
  });

  D('smallest-common-region', {
    t: 'Smallest Common Region: LCA with parent links',
    r: 'Map each region to its parent. Collect all ancestors of region1, then walk up from region2 until you hit one of them.',
    g: R => { const names = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I']; const n = R.int(3, 9), par = {}; for (let i = 1; i < n; i++) par[names[i]] = names[R.int(0, i - 1)]; const kids = {}; Object.entries(par).forEach(([c, p]) => (kids[p] = kids[p] || [p]).push(c)); const regions = Object.values(kids); const r1 = names[R.int(1, n - 1)]; let r2; do r2 = names[R.int(1, n - 1)]; while (r2 === r1); return { regions, region1: r1, region2: r2 }; },
    s(I, T) { const par = new Map(); I.regions.forEach(l => l.slice(1).forEach(c => par.set(c, l[0]))); const anc = new Set(); for (let x = I.region1; x !== undefined; x = par.get(x)) anc.add(x); T.at({ ancestors1: A([...anc]) }); T.n(`How many regions contain ${I.region1} (including itself)?`, anc.size, 'Walk up parent links.'); let y = I.region2; while (!anc.has(y)) y = par.get(y); return y; }
  });

  D('delete-tree-nodes', {
    t: 'Delete Tree Nodes: zero-sum subtrees vanish',
    r: 'Post-order: compute each subtree\'s sum and remaining count. If the sum is 0, the whole subtree is removed (count 0).',
    g: R => { const n = R.int(1, 7); return { nodes: n, parent: Array.from({ length: n }, (_, i) => i ? R.int(0, i - 1) : -1), value: R.ints(n, -2, 2) }; },
    s(I, T) { const ch = Array.from({ length: I.nodes }, () => []); I.parent.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); const go = u => { let s = I.value[u], c = 1; for (const v of ch[u]) { const [a, b] = go(v); s += a; c += b; } T.at({ value: A(I.value, { hl: [u] }) }); T.n(`Subtree sum at node ${u}?`, s, 'Zero means the subtree is deleted.'); return [s, s === 0 ? 0 : c]; }; return go(0)[1]; }
  });

  D('deepest-leaves-sum', {
    t: 'Deepest Leaves Sum: sum of the last BFS level',
    r: 'BFS level by level; the sum of the final level is the answer.',
    g: R => ({ root: R.tree(R.int(1, 9)) }),
    s(I, T) { const root = Tr.from(I.root); let lv = [root], s = 0; while (lv.length) { s = lv.reduce((a, n) => a + n.val, 0); T.at({ tree: TR(root, { hit: lv }) }); T.n('Sum of this level?', s, 'The last one wins.'); lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); } return s; }
  });

  D('all-elements-in-two-binary-search-trees', {
    t: 'All Elements in Two BSTs: merge two sorted lists',
    r: 'Inorder each tree into a sorted list, then merge the lists with two pointers.',
    g: R => ({ root1: R.bst(R.int(0, 5), 0, 12), root2: R.bst(R.int(0, 5), 0, 12) }),
    s(I, T) { const a = inorder(Tr.from(I.root1)).map(n => n.val), b = inorder(Tr.from(I.root2)).map(n => n.val), out = []; let i = 0, j = 0; while (i < a.length || j < b.length) { const fromA = j >= b.length || (i < a.length && a[i] <= b[j]); T.at({ list1: A(a, { hl: i < a.length ? [i] : [] }), list2: A(b, { hl: j < b.length ? [j] : [] }), out: A(out) }); T.n('Next value taken?', fromA ? a[i] : b[j], 'The smaller head.'); out.push(fromA ? a[i++] : b[j++]); } return out; }
  });

  D('sum-of-nodes-with-even-valued-grandparent', {
    t: 'Even-Valued Grandparent: pass parent and grandparent down',
    r: 'DFS carrying the parent and grandparent values; add a node when its grandparent is even.',
    g: R => ({ root: R.tree(R.int(1, 9), 1, 9) }),
    s(I, T) { const root = Tr.from(I.root); let s = 0; const go = (n, p, g) => { if (!n) return; if (g !== null) { T.at({ tree: TR(root, { hit: n }), sum: s }); T.yn(`Is the grandparent of this ${n.val} (${g}) even?`, g % 2 === 0, 'Even grandparent → add.'); if (g % 2 === 0) s += n.val; } go(n.left, n.val, p); go(n.right, n.val, p); }; go(root, null, null); return s; }
  });

  D('delete-leaves-with-a-given-value', {
    t: 'Delete Leaves With a Given Value: post-order cascade',
    r: 'Process children first; after pruning them, delete the node if it has become a leaf with the target value.',
    g: R => ({ root: R.tree(R.int(1, 8), 1, 3), target: R.int(1, 3) }),
    s(I, T) { const root = Tr.from(I.root); const go = n => { if (!n) return null; n.left = go(n.left); n.right = go(n.right); const rm = leaf(n) && n.val === I.target; T.at({ tree: TR(root, { hit: n }), target: I.target }); T.yn(`Delete this ${n.val}?`, rm, 'A leaf (now) with the target value.'); return rm ? null : n; }; return Tr.arr(go(root)); }
  });

  D('maximum-product-of-splitted-binary-tree', {
    t: 'Maximum Product of Splitted Tree: s × (total − s)',
    r: 'Compute the total, then every subtree sum s; cutting above that subtree gives s × (total − s). Take the max, then mod 1e9+7.',
    g: R => ({ root: R.tree(R.int(2, 8), 1, 9) }),
    s(I, T) { const root = Tr.from(I.root), sums = []; const go = n => { if (!n) return 0; const s = n.val + go(n.left) + go(n.right); sums.push([n, s]); return s; }; const tot = go(root); let best = 0n; for (const [n, s] of sums) { if (n === root) continue; const p = BigInt(s) * BigInt(tot - s); if (p > best) best = p; T.at({ tree: TR(root, { hit: n }), total: tot }); T.n(`Product if you cut above ${n.val}?`, Number(p), `${s} × ${tot - s}.`); } return Number(best % M); }
  });

  D('linked-list-in-binary-tree', {
    t: 'Linked List in Binary Tree: try every start',
    r: 'For each tree node, check whether the list matches a downward path starting there (each step goes to the left or right child).',
    g: R => { const t = R.tree(R.int(1, 8), 1, 3); const r = Tr.from(t); let head; if (R.chance(0.6)) { let n = R.pick(Tr.nodes(r)); head = []; while (n && head.length < 3) { head.push(n.val); n = R.chance(0.5) ? n.left || n.right : n.right || n.left; } } else head = R.ints(R.int(1, 3), 1, 3); return { head, root: t }; },
    s(I, T) { const root = Tr.from(I.root), h = I.head; const m = (n, i) => i === h.length || (!!n && n.val === h[i] && (m(n.left, i + 1) || m(n.right, i + 1))); for (const n of Tr.nodes(root)) if (n.val === h[0]) { const ok = m(n, 0); T.at({ tree: TR(root, { hit: n }), list: A(h) }); T.yn(`Does the list match starting at this ${n.val}?`, ok, 'Follow children downward.'); if (ok) return true; } return false; }
  });

  D('longest-zigzag-path-in-a-binary-tree', {
    t: 'Longest ZigZag Path: lengths by last direction',
    r: 'Pass two counters down: the zigzag length if we arrived by going left, and by going right. Going left continues the "arrived right" path (+1) and resets the other to 0.',
    g: R => ({ root: R.tree(R.int(1, 9), 1, 1, 5) }),
    s(I, T) { const root = Tr.from(I.root); let best = 0; const go = (n, l, r) => { if (!n) return; best = Math.max(best, l, r); if (n !== root) { T.at({ tree: TR(root, { hit: n }) }); T.n('Longest zigzag ending here?', Math.max(l, r), 'Previous opposite-direction length + 1.'); } go(n.left, r + 1, 0); go(n.right, 0, l + 1); }; go(root, 0, 0); return best; }
  });

  D('maximum-sum-bst-in-binary-tree', {
    t: 'Maximum Sum BST: (isBST, min, max, sum) bottom-up',
    r: 'Post-order: a node is a BST if both children are and left max < val < right min; its sum is val + both sums. Track the best (at least 0 for the empty tree).',
    g: R => ({ root: R.tree(R.int(1, 8), -3, 9) }),
    s(I, T) { const root = Tr.from(I.root); let best = 0; const go = n => { if (!n) return [true, Infinity, -Infinity, 0]; const a = go(n.left), b = go(n.right); const ok = a[0] && b[0] && a[2] < n.val && n.val < b[1]; T.at({ tree: TR(root, { hit: n }), best }); T.yn(`Is the subtree at ${n.val} a BST?`, ok, 'Children BSTs and bounds hold.'); if (!ok) return [false, 0, 0, 0]; const s = n.val + a[3] + b[3]; best = Math.max(best, s); return [true, Math.min(a[1], n.val), Math.max(b[2], n.val), s]; }; go(root); return best; }
  });

  D('time-needed-to-inform-all-employees', {
    t: 'Time Needed to Inform All Employees: longest chain of delays',
    r: 'From the head, time(u) = informTime[u] + max over subordinates of time(v). Leaves take 0.',
    g: R => { const n = R.int(1, 7), head = R.int(0, n - 1), o = R.perm(n).filter(x => x !== head); const order = [head, ...o], manager = Array(n).fill(-1); order.forEach((u, i) => { if (i) manager[u] = order[R.int(0, i - 1)]; }); const sub = new Set(manager); return { n, headID: head, manager, informTime: Array.from({ length: n }, (_, i) => sub.has(i) ? R.int(1, 5) : 0) }; },
    s(I, T) { const ch = Array.from({ length: I.n }, () => []); I.manager.forEach((m, i) => { if (m >= 0) ch[m].push(i); }); const go = u => { if (!ch[u].length) return 0; const t = I.informTime[u] + Math.max(...ch[u].map(go)); T.at({ graph: GR(I.n, I.manager.map((m, i) => [m, i]).filter(e => e[0] >= 0), { dir: true, cls: { [u]: 'hit' } }) }); T.n(`Time for everyone under ${u} to be informed?`, t, 'Own delay + slowest subordinate.'); return t; }; return go(I.headID); }
  });
})();
