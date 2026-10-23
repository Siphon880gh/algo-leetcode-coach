/* v2 games: trees (02). */
(function () {
  'use strict';
  const { D, A, G, K, X, Tr, TR, GR } = LCGame.H;
  const N = (v, l, r) => ({ val: v, left: l || null, right: r || null });
  const inorder = (r, out = []) => { if (r) { inorder(r.left, out); out.push(r); inorder(r.right, out); } return out; };
  const naryFrom = a => { if (!a || !a.length) return null; const root = { val: a[0], children: [] }, q = [root]; let i = 2; while (i < a.length && q.length) { const n = q.shift(); while (i < a.length && a[i] !== null) { const c = { val: a[i], children: [] }; n.children.push(c); q.push(c); i++; } i++; } return root; };
  const naryGen = R => { const n = R.int(1, 7), vals = R.distinct(n, 1, 20), nodes = [{ val: vals[0], children: [] }]; for (let i = 1; i < n; i++) { const c = { val: vals[i], children: [] }; R.pick(nodes).children.push(c); nodes.push(c); } const out = [nodes[0].val, null], q = [nodes[0]]; while (q.length) { const x = q.shift(); x.children.forEach(c => { out.push(c.val); q.push(c); }); out.push(null); } while (out.length && out[out.length - 1] === null) out.pop(); return out; };
  const firstArr = I => { for (const k in I) if (I[k] && I[k].__raw) I[k] = JSON.parse(I[k].__raw.match(/\[[^\]]*\]/)[0]); return I; };
  // quad trees: [isLeaf, val] level-order with 4 children per node
  const qFrom = a => { if (!a || !a.length) return null; const mk = x => ({ leaf: x[0], val: x[1], ch: null }); const root = mk(a[0]), q = [root]; let i = 1; while (q.length && i < a.length) { const n = q.shift(); const kids = []; for (let k = 0; k < 4; k++, i++) { const x = i < a.length ? a[i] : null; if (x) { const c = mk(x); kids.push(c); q.push(c); } } if (kids.length) n.ch = kids; } return root; };
  const qArr = root => { const out = [], q = [root]; while (q.length) { const x = q.shift(); if (!x) { out.push(null); continue; } out.push([x.leaf, x.val]); if (x.leaf) q.push(null, null, null, null); else q.push(...x.ch); } while (out.length && out[out.length - 1] === null) out.pop(); return out; };
  const qBuild = g => { const go = (r, c, n) => { let same = true; for (let i = r; i < r + n; i++) for (let j = c; j < c + n; j++) if (g[i][j] !== g[r][c]) same = false; if (same) return { leaf: 1, val: g[r][c], ch: null }; const h = n / 2; return { leaf: 0, val: 1, ch: [go(r, c, h), go(r, c + h, h), go(r + h, c, h), go(r + h, c + h, h)] }; }; return go(0, 0, g.length); };

  D('encode-n-ary-tree-to-binary-tree', {
    t: 'Encode N-ary Tree as Binary Tree: first child, next sibling',
    r: 'A node\'s first child becomes its left child; each child\'s next sibling becomes that child\'s right child. Decoding reverses it.',
    g: R => ({ root: naryGen(R) }),
    exIn: firstArr,
    s(I, T) { const root = naryFrom(I.root); if (!root) return []; const enc = n => { const b = N(n.val); let prev = null; n.children.forEach((c, i) => { const e = enc(c); if (!i) b.left = e; else prev.right = e; prev = e; }); return b; }; const b = enc(root); for (const x of Tr.nodes(b).slice(0, 8)) if (x.left || x.right) { T.at({ binary: Tr.depth(b) <= 5 ? TR(b, { hit: x }) : X(JSON.stringify(Tr.arr(b))) }); T.n(`Left child (first N-ary child) of ${x.val} (0 if none)?`, x.left ? x.left.val : 0, 'First child goes left.'); } const out = [root.val, null], q = [root]; while (q.length) { const x = q.shift(); x.children.forEach(c => { out.push(c.val); q.push(c); }); out.push(null); } while (out.length && out[out.length - 1] === null) out.pop(); return out; }
  });

  D('path-sum-iii', {
    t: 'Path Sum III: prefix sums on the root path',
    r: 'Carry the running sum down; the number of paths ending here equals how many earlier prefix sums equal running − target. Add then remove the prefix on the way back.',
    g: R => ({ root: R.tree(R.int(1, 8), -3, 5), targetSum: R.int(-2, 8) }),
    s(I, T) { const root = Tr.from(I.root), seen = new Map([[0, 1]]); let c = 0; const go = (n, s) => { if (!n) return; s += n.val; const k = seen.get(s - I.targetSum) || 0; T.at({ tree: TR(root, { hit: n }), running: s, prefixes: seen }); T.n(`Paths ending at ${n.val}?`, k, `Prefixes equal to ${s} − ${I.targetSum}.`); c += k; seen.set(s, (seen.get(s) || 0) + 1); go(n.left, s); go(n.right, s); seen.set(s, seen.get(s) - 1); }; go(root, 0); return c; }
  });

  D('delete-node-in-a-bst', {
    t: 'Delete Node in a BST: successor replaces it',
    r: 'Find the key. With fewer than two children, splice in the child. With two, copy the inorder successor (min of the right subtree) and delete it from the right subtree.',
    g: R => { const a = R.bst(R.int(1, 7), 1, 20); return { root: a, key: R.chance(0.8) ? R.pick(a.filter(x => x !== null)) : 0 }; },
    s(I, T) { const root = Tr.from(I.root); const del = (n, k) => { if (!n) return null; if (k < n.val) { n.left = del(n.left, k); return n; } if (k > n.val) { n.right = del(n.right, k); return n; } const kids = (n.left ? 1 : 0) + (n.right ? 1 : 0); T.at({ tree: TR(root, { hit: n }) }); T.n(`Children of the node to delete?`, kids, 'Decides splice vs successor.'); if (!n.left) return n.right; if (!n.right) return n.left; let s = n.right; while (s.left) s = s.left; T.n('Successor value?', s.val, 'Leftmost node of the right subtree.'); n.val = s.val; n.right = del(n.right, s.val); return n; }; const out = del(root, I.key); T.at({ tree: TR(out) }); T.n('Nodes left in the tree?', Tr.size(out), 'One fewer if the key existed.'); return Tr.arr(out); }
  });

  D('find-mode-in-binary-search-tree', {
    t: 'Find Mode in BST: count runs in inorder',
    r: 'Inorder visits equal values consecutively. Track the current run length and the best; reset the mode list when a run beats it.',
    g: R => { const v = R.ints(R.int(1, 7), 1, 4).sort((a, b) => a - b); const go = (l, r) => { if (l > r) return null; const m = (l + r) >> 1; return N(v[m], go(l, m - 1), go(m + 1, r)); }; return { root: Tr.arr(go(0, v.length - 1)) }; },
    cmp: 'set',
    s(I, T) { const io = inorder(Tr.from(I.root)).map(n => n.val); let run = 0, best = 0, prev = null, modes = []; io.forEach((v, i) => { run = v === prev ? run + 1 : 1; prev = v; if (run > best) { best = run; modes = [v]; } else if (run === best) modes.push(v); T.at({ inorder: A(io, { hl: [i] }), modes: A(modes) }); T.n('Current run length?', run, 'Same value as before extends it.'); }); return modes; }
  });

  D('most-frequent-subtree-sum', {
    t: 'Most Frequent Subtree Sum: post-order sums',
    r: 'Compute each subtree sum bottom-up and count them; return all sums with the highest count.',
    g: R => ({ root: R.tree(R.int(1, 7), -3, 4) }),
    cmp: 'set',
    s(I, T) { const root = Tr.from(I.root), c = new Map(); const go = n => { if (!n) return 0; const s = n.val + go(n.left) + go(n.right); T.at({ tree: TR(root, { hit: n }), counts: c }); T.n(`Subtree sum at ${n.val}?`, s, 'val + left sum + right sum.'); c.set(s, (c.get(s) || 0) + 1); return s; }; go(root); const m = Math.max(...c.values()); return [...c].filter(e => e[1] === m).map(e => e[0]); }
  });

  D('inorder-successor-in-bst-ii', {
    t: 'Inorder Successor II: with parent pointers',
    r: 'If the node has a right subtree, the successor is its leftmost node. Otherwise climb parents until you come up from a left child.',
    g: R => { const a = R.bst(R.int(1, 7), 1, 20); return { tree: a, node: R.pick(a.filter(x => x !== null)) }; },
    s(I, T) { const root = Tr.from(I.tree), par = new Map(); Tr.nodes(root).forEach(n => { if (n.left) par.set(n.left, n); if (n.right) par.set(n.right, n); }); let x = Tr.find(root, I.node); T.at({ tree: TR(root, { hit: x }) }); T.yn('Does the node have a right subtree?', !!x.right, 'Then go right, then all the way left.'); if (x.right) { x = x.right; while (x.left) x = x.left; return x.val; } while (par.get(x) && par.get(x).right === x) x = par.get(x); const p = par.get(x); return p ? p.val : null; }
  });

  D('find-bottom-left-tree-value', {
    t: 'Find Bottom Left Tree Value: last level, first node',
    r: 'BFS level by level; the first node of the last level is the answer.',
    g: R => ({ root: R.tree(R.int(1, 9)) }),
    s(I, T) { const root = Tr.from(I.root); let lv = [root], ans = root.val, d = 1; while (lv.length) { ans = lv[0].val; T.at({ tree: TR(root, { hit: lv }) }); T.n(`Leftmost value on level ${d}?`, ans, 'First node in BFS order.'); lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); d++; } return ans; }
  });

  D('find-largest-value-in-each-tree-row', {
    t: 'Largest Value in Each Tree Row: BFS max per level',
    r: 'Process the tree level by level and record the maximum of each level.',
    g: R => ({ root: R.tree(R.int(0, 9)) }),
    s(I, T) { const root = Tr.from(I.root), out = []; let lv = root ? [root] : []; while (lv.length) { const m = Math.max(...lv.map(n => n.val)); T.at({ tree: TR(root, { hit: lv }) }); T.n(`Largest value on row ${out.length}?`, m, 'Max of the level.'); out.push(m); lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); } return out; }
  });

  D('minimum-absolute-difference-in-bst', {
    t: 'Minimum Absolute Difference in BST: neighbors in inorder',
    r: 'Inorder is sorted, so the minimum difference is between consecutive inorder values.',
    g: R => ({ root: R.bst(R.int(2, 7), 0, 30) }),
    s(I, T) { const v = inorder(Tr.from(I.root)).map(n => n.val); let best = Infinity; for (let i = 1; i < v.length; i++) { best = Math.min(best, v[i] - v[i - 1]); T.at({ inorder: A(v, { hl: [i - 1, i] }) }); T.n('Best difference so far?', best, `Compare ${v[i]} − ${v[i - 1]}.`); } return best; }
  });

  D('construct-binary-tree-from-string', {
    t: 'Construct Binary Tree From String: number, then (left)(right)',
    r: 'Parse a (possibly negative) number, then if "(" follows, parse the left subtree up to its ")", then optionally the right one.',
    g: R => { const t = Tr.from(R.tree(R.int(1, 6), -3, 9)); const ser = n => n ? String(n.val) + (n.left || n.right ? '(' + ser(n.left) + ')' : '') + (n.right ? '(' + ser(n.right) + ')' : '') : ''; const fix = n => { if (!n) return; if (n.right && !n.left) { n.left = n.right; n.right = null; } fix(n.left); fix(n.right); }; fix(t); return { s: ser(t) }; },
    s(I, T) { const s = I.s; let i = 0; const parse = () => { let j = i; while (j < s.length && /[-\d]/.test(s[j])) j++; const n = N(+s.slice(i, j)); i = j; T.at({ s: A([...s], { hl: [j - 1] }) }); T.n('Value just read?', n.val, 'Digits (and sign) before the next parenthesis.'); if (s[i] === '(') { i++; n.left = parse(); i++; } if (s[i] === '(') { i++; n.right = parse(); i++; } return n; }; return s ? Tr.arr(parse()) : []; }
  });

  D('convert-bst-to-greater-tree', {
    t: 'Convert BST to Greater Tree: reverse inorder running sum',
    r: 'Visit nodes in reverse inorder (right, node, left) keeping a running sum; each node becomes the running sum including itself.',
    g: R => ({ root: R.bst(R.int(0, 7), 0, 15) }),
    s(I, T) { const root = Tr.from(I.root); let s = 0; const go = n => { if (!n) return; go(n.right); s += n.val; T.at({ tree: TR(root, { hit: n }), running: s }); T.n(`New value for ${n.val}?`, s, 'Itself plus everything larger.'); n.val = s; go(n.left); }; go(root); return Tr.arr(root); }
  });

  D('diameter-of-binary-tree', {
    t: 'Diameter of Binary Tree: left height + right height',
    r: 'At each node the longest path through it is height(left) + height(right) edges; return 1 + max height upward.',
    g: R => ({ root: R.tree(R.int(1, 9)) }),
    s(I, T) { const root = Tr.from(I.root); let best = 0; const h = n => { if (!n) return 0; const a = h(n.left), b = h(n.right); best = Math.max(best, a + b); if (n.left || n.right) { T.at({ tree: TR(root, { hit: n }), best }); T.n(`Longest path through ${n.val} (edges)?`, a + b, 'left height + right height.'); } return 1 + Math.max(a, b); }; h(root); return best; }
  });

  D('boundary-of-binary-tree', {
    t: 'Boundary of Binary Tree: left edge, leaves, right edge reversed',
    r: 'Root, then the left boundary (excluding leaves), then all leaves left to right, then the right boundary (excluding leaves) in reverse.',
    g: R => ({ root: R.tree(R.int(1, 9)) }),
    s(I, T) { const root = Tr.from(I.root), leaf = n => !n.left && !n.right; const out = [root.val]; if (leaf(root)) return out; const L = []; let x = root.left; while (x) { if (!leaf(x)) L.push(x.val); x = x.left || x.right; } T.at({ tree: TR(root) }); T.n('How many left-boundary nodes (excluding leaves)?', L.length, 'Follow left, else right.'); const lv = []; const go = n => { if (!n) return; if (leaf(n) && n !== root) lv.push(n.val); go(n.left); go(n.right); }; go(root); T.n('How many leaves?', lv.length, 'Left to right.'); const Rb = []; x = root.right; while (x) { if (!leaf(x)) Rb.push(x.val); x = x.right || x.left; } return [...out, ...L, ...lv, ...Rb.reverse()]; }
  });

  D('binary-tree-longest-consecutive-sequence-ii', {
    t: 'Longest Consecutive Path II: increasing + decreasing arms',
    r: 'Each node returns (inc, dec): the longest path going down where values increase / decrease by 1. Through a node: inc + dec − 1.',
    g: R => ({ root: R.tree(R.int(1, 8), 1, 4) }),
    s(I, T) { const root = Tr.from(I.root); let best = 0; const go = n => { if (!n) return [0, 0]; let inc = 1, dec = 1; for (const c of [n.left, n.right]) { if (!c) continue; const [a, b] = go(c); if (c.val === n.val + 1) inc = Math.max(inc, a + 1); if (c.val === n.val - 1) dec = Math.max(dec, b + 1); } best = Math.max(best, inc + dec - 1); T.at({ tree: TR(root, { hit: n }), best }); T.n(`Longest consecutive path through ${n.val}?`, inc + dec - 1, 'inc arm + dec arm − 1.'); return [inc, dec]; }; go(root); return best; }
  });

  D('logical-or-of-two-binary-grids-represented-as-quad-trees', {
    t: 'Logical OR of Quad Trees: leaves short-circuit',
    r: 'If one tree is a leaf of 1, the result is that leaf; a leaf of 0 returns the other tree. Otherwise OR the four children and collapse if they are four equal leaves.',
    g: R => { const n = 2 ** R.int(0, 2), mk = () => Array.from({ length: n }, () => Array.from({ length: n }, () => R.chance(0.6) ? 1 : 0)); return { quadTree1: qArr(qBuild(mk())), quadTree2: qArr(qBuild(mk())) }; },
    s(I, T) { const a = qFrom(I.quadTree1), b = qFrom(I.quadTree2); let depth = 0; const or = (x, y) => { if (x.leaf || y.leaf) { const res = x.leaf ? (x.val ? x : y) : (y.val ? y : x); T.at({ t1: x.leaf ? `leaf ${x.val}` : 'split', t2: y.leaf ? `leaf ${y.val}` : 'split' }); T.c('Result for this region?', ['tree 1', 'tree 2'], res === x ? 'tree 1' : 'tree 2', 'A 1-leaf wins; a 0-leaf yields the other.'); return res; } const ch = [0, 1, 2, 3].map(i => or(x.ch[i], y.ch[i])); if (ch.every(c => c.leaf && c.val === ch[0].val)) return { leaf: 1, val: ch[0].val, ch: null }; return { leaf: 0, val: 0, ch }; }; return qArr(or(a, b)); }
  });

  D('maximum-depth-of-n-ary-tree', {
    t: 'Maximum Depth of N-ary Tree',
    r: 'depth = 1 + the maximum depth among the children (0 for an empty tree).',
    g: R => ({ root: naryGen(R) }),
    s(I, T) { const root = naryFrom(I.root); const go = n => { const d = 1 + Math.max(0, ...n.children.map(go)); if (n.children.length) { T.at({ node: n.val, children: A(n.children.map(c => c.val)) }); T.n(`Depth of the subtree at ${n.val}?`, d, '1 + deepest child.'); } return d; }; return root ? go(root) : 0; }
  });

  D('binary-tree-tilt', {
    t: 'Binary Tree Tilt: |left sum − right sum| everywhere',
    r: 'Post-order: compute subtree sums; each node\'s tilt is |left sum − right sum|. Add all tilts.',
    g: R => ({ root: R.tree(R.int(0, 7), 0, 9) }),
    s(I, T) { const root = Tr.from(I.root); let t = 0; const go = n => { if (!n) return 0; const a = go(n.left), b = go(n.right); T.at({ tree: TR(root, { hit: n }), total: t }); T.n(`Tilt of ${n.val}?`, Math.abs(a - b), `|${a} − ${b}|.`); t += Math.abs(a - b); return n.val + a + b; }; go(root); return t; }
  });

  D('subtree-of-another-tree', {
    t: 'Subtree of Another Tree: try every node as a match',
    r: 'For every node of root whose value equals subRoot\'s root, check whether the two trees are identical.',
    g: R => { const a = R.tree(R.int(1, 8), 1, 3), r = Tr.from(a); const s = R.chance(0.6) ? Tr.arr(R.pick(Tr.nodes(r))) : R.tree(R.int(1, 3), 1, 3); return { root: a, subRoot: s }; },
    s(I, T) { const root = Tr.from(I.root), sub = Tr.from(I.subRoot); const same = (x, y) => (!x && !y) || (x && y && x.val === y.val && same(x.left, y.left) && same(x.right, y.right)); for (const n of Tr.nodes(root)) if (n.val === sub.val) { const ok = !!same(n, sub); T.at({ root: TR(root, { hit: n }), subRoot: TR(sub) }); T.yn(`Is the subtree at this ${n.val} identical to subRoot?`, ok, 'Structure and values must match.'); if (ok) return true; } return false; }
  });

  D('kill-process', {
    t: 'Kill Process: BFS over the children map',
    r: 'Build parent → children lists, then BFS from the killed process; everything reached dies.',
    g: R => { const n = R.int(1, 7), pid = R.distinct(n, 1, 20), ppid = pid.map((_, i) => i ? pid[R.int(0, i - 1)] : 0); const o = R.shuffle(pid.map((_, i) => i)); return { pid: o.map(i => pid[i]), ppid: o.map(i => ppid[i]), kill: R.pick(pid) }; },
    cmp: 'set',
    s(I, T) { const ch = new Map(); I.ppid.forEach((p, i) => { if (!ch.has(p)) ch.set(p, []); ch.get(p).push(I.pid[i]); }); const out = [], q = [I.kill]; while (q.length) { const x = q.shift(); out.push(x); const c = ch.get(x) || []; T.at({ children: ch, killed: A(out) }); T.n(`How many direct children does ${x} have?`, c.length, 'They are killed next.'); q.push(...c); } return out; }
  });

  D('n-ary-tree-preorder-traversal', {
    t: 'N-ary Preorder: node, then children left to right',
    r: 'Use a stack: pop a node, record it, push its children in reverse so the first child is processed next.',
    g: R => ({ root: naryGen(R) }),
    s(I, T) { const root = naryFrom(I.root); if (!root) return []; const out = [], st = [root]; while (st.length) { const n = st.pop(); out.push(n.val); for (let i = n.children.length - 1; i >= 0; i--) st.push(n.children[i]); T.at({ out: A(out), stack: A(st.map(x => x.val)) }); if (st.length) T.n('Next value to visit?', st[st.length - 1].val, 'Top of the stack.'); } return out; }
  });

  D('n-ary-tree-postorder-traversal', {
    t: 'N-ary Postorder: children first, then the node',
    r: 'Visit all children left to right recursively, then record the node.',
    g: R => ({ root: naryGen(R) }),
    s(I, T) { const root = naryFrom(I.root), out = []; const go = n => { n.children.forEach(go); out.push(n.val); if (n.children.length) { T.at({ out: A(out) }); T.n(`Position (0-based) of ${n.val} in the output?`, out.length - 1, 'After all its descendants.'); } }; if (root) go(root); return out; }
  });

  D('construct-string-from-binary-tree', {
    t: 'Construct String From Binary Tree: keep () only when needed',
    r: 'val(left)(right): omit both if the node is a leaf; omit only (right) if there is no right child; keep an empty () for a missing left when a right exists.',
    g: R => ({ root: R.tree(R.int(1, 7)) }),
    s(I, T) { const root = Tr.from(I.root); const go = n => { if (!n) return ''; let s = String(n.val); if (n.left || n.right) { T.at({ tree: TR(root, { hit: n }) }); T.yn(`Does ${n.val} need "()" for an empty left child?`, !n.left, 'Only when a right child exists and the left is missing.'); s += '(' + go(n.left) + ')'; } if (n.right) s += '(' + go(n.right) + ')'; return s; }; return go(root); }
  });

  D('merge-two-binary-trees', {
    t: 'Merge Two Binary Trees: add overlapping nodes',
    r: 'If both nodes exist, sum the values and merge children; if one is missing, use the other subtree as is.',
    g: R => ({ root1: R.tree(R.int(0, 6)), root2: R.tree(R.int(0, 6)) }),
    s(I, T) { const a = Tr.from(I.root1), b = Tr.from(I.root2); const go = (x, y) => { if (!x) return y; if (!y) return x; T.at({ root1: TR(a, { hit: x }), root2: TR(b, { hit: y }) }); T.n('Merged value?', x.val + y.val, 'Both exist: add.'); return N(x.val + y.val, go(x.left, y.left), go(x.right, y.right)); }; return Tr.arr(go(a, b)); }
  });

  D('add-one-row-to-tree', {
    t: 'Add One Row to Tree: rewire at depth − 1',
    r: 'For each node at depth − 1, insert new nodes: the new left takes the old left as its left; the new right takes the old right as its right. Depth 1 makes a new root.',
    g: R => ({ root: R.tree(R.int(1, 6), 1, 9, 4), val: R.int(1, 9), depth: R.int(1, 3) }),
    s(I, T) { let root = Tr.from(I.root); if (I.depth === 1) { T.at({ tree: TR(root) }); T.n('Number of nodes at depth 0 to rewire?', 0, 'Depth 1: just make a new root.'); return Tr.arr(N(I.val, root)); } let lv = [root]; for (let d = 1; d < I.depth - 1; d++) lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); T.at({ tree: TR(root, { hit: lv }) }); T.n(`Nodes at depth ${I.depth - 1}?`, lv.length, 'Each gets two new children.'); lv.forEach(n => { n.left = N(I.val, n.left); n.right = N(I.val, null, n.right); }); return Tr.arr(root); }
  });

  D('average-of-levels-in-binary-tree', {
    t: 'Average of Levels: BFS sums',
    r: 'BFS level by level; average = level sum / level size.',
    g: R => ({ root: R.tree(R.int(1, 8)) }),
    s(I, T) { const root = Tr.from(I.root), out = []; let lv = [root]; while (lv.length) { const s = lv.reduce((a, n) => a + n.val, 0); T.at({ tree: TR(root, { hit: lv }) }); T.n(`Sum of level ${out.length}?`, s, `${lv.length} node(s).`); out.push(s / lv.length); lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); } return out; }
  });

  D('find-duplicate-subtrees', {
    t: 'Find Duplicate Subtrees: serialize each subtree',
    r: 'Post-order serialize every subtree ("val,left,right"); count serializations and report a root the second time a string appears.',
    g: R => ({ root: R.tree(R.int(1, 9), 1, 3) }),
    cmp: 'set',
    s(I, T) { const root = Tr.from(I.root), c = new Map(), out = []; const go = n => { if (!n) return '#'; const k = n.val + ',' + go(n.left) + ',' + go(n.right); const v = (c.get(k) || 0) + 1; c.set(k, v); T.at({ tree: TR(root, { hit: n }) }); T.n(`How many times has this subtree shape at ${n.val} appeared (including now)?`, v, 'Count of its serialization.'); if (v === 2) out.push(Tr.arr(n)); return k; }; go(root); return out; }
  });

  D('two-sum-iv-input-is-a-bst', {
    t: 'Two Sum IV: a set while traversing',
    r: 'Traverse the tree; for each value, check if k − value was already seen.',
    g: R => ({ root: R.bst(R.int(1, 7), 1, 15), k: R.int(2, 28) }),
    s(I, T) { const seen = new Set(), root = Tr.from(I.root); for (const n of Tr.nodes(root)) { const hit = seen.has(I.k - n.val); T.at({ tree: TR(root, { hit: n }), seen }); T.yn(`Has ${I.k - n.val} been seen?`, hit, `${n.val} + ${I.k - n.val} = ${I.k}.`); if (hit) return true; seen.add(n.val); } return false; }
  });

  D('maximum-binary-tree', {
    t: 'Maximum Binary Tree: the max splits the array',
    r: 'The maximum of the range is the root; the part to its left builds the left subtree, the part to its right the right subtree.',
    g: R => ({ nums: R.distinct(R.int(1, 6), 0, 20) }),
    s(I, T) { const go = (l, r) => { if (l > r) return null; let m = l; for (let i = l; i <= r; i++) if (I.nums[i] > I.nums[m]) m = i; T.at({ nums: A(I.nums, { win: [l, r] }) }); T.n(`Root of range ${l}…${r}?`, I.nums[m], 'The maximum.'); return N(I.nums[m], go(l, m - 1), go(m + 1, r)); }; return Tr.arr(go(0, I.nums.length - 1)); }
  });

  D('print-binary-tree', {
    t: 'Print Binary Tree: halve the offset each row',
    r: 'With height h (edges), the grid is (h+1) × (2^(h+1) − 1). The root sits in the middle column; a child at row r+1 sits at column c ∓ 2^(h−r−1).',
    g: R => ({ root: R.tree(R.int(1, 6), 1, 9, 3) }),
    s(I, T) { const root = Tr.from(I.root), h = Tr.depth(root) - 1, w = 2 ** (h + 1) - 1, g = Array.from({ length: h + 1 }, () => Array(w).fill('')); const go = (n, r, c) => { if (!n) return; g[r][c] = String(n.val); T.at({ tree: TR(root, { hit: n }) }); T.n(`Column of ${n.val}?`, c, r ? 'Parent column ∓ offset.' : 'Middle column.'); go(n.left, r + 1, c - 2 ** (h - r - 1)); go(n.right, r + 1, c + 2 ** (h - r - 1)); }; go(root, 0, (w - 1) / 2); return g; }
  });

  D('maximum-width-of-binary-tree', {
    t: 'Maximum Width of Binary Tree: heap indices per level',
    r: 'Number nodes like a heap (left 2i, right 2i+1), re-based per level. Width = last index − first index + 1.',
    g: R => ({ root: R.tree(R.int(1, 9)) }),
    s(I, T) { const root = Tr.from(I.root); let lv = [[root, 0]], best = 0; while (lv.length) { const w = lv[lv.length - 1][1] - lv[0][1] + 1; T.at({ tree: TR(root, { hit: lv.map(x => x[0]) }) }); T.n('Width of this level?', w, 'last index − first index + 1.'); best = Math.max(best, w); const b = lv[0][1]; lv = lv.flatMap(([n, i]) => [[n.left, 2 * (i - b)], [n.right, 2 * (i - b) + 1]].filter(x => x[0])); } return best; }
  });

  D('equal-tree-partition', {
    t: 'Equal Tree Partition: look for a subtree with half the total',
    r: 'Collect the sums of all subtrees except the whole tree. Cutting an edge works if the total is even and some subtree sums to total / 2.',
    g: R => ({ root: R.tree(R.int(1, 7), -2, 6) }),
    s(I, T) { const root = Tr.from(I.root), sums = []; const all = n => { if (!n) return 0; const s = n.val + all(n.left) + all(n.right); sums.push(s); return s; }; const tot = all(root); sums.pop(); T.at({ tree: TR(root), sums: A(sums) }); T.n('Total sum?', tot, 'Sum of all nodes.'); return tot % 2 === 0 && sums.includes(tot / 2); }
  });

  D('path-sum-iv', {
    t: 'Path Sum IV: decode depth and position',
    r: 'Each number DPV gives depth D, position P, value V. Children of (D, P) are (D+1, 2P−1) and (D+1, 2P). Sum root-to-leaf paths over the decoded tree.',
    g: R => { const r = Tr.from(R.tree(R.int(1, 7), 0, 9, 4)); const out = []; const go = (n, i) => { if (!n) return; const d = Math.floor(Math.log2(i + 1)) + 1, p = i - (2 ** (d - 1) - 1) + 1; out.push(d * 100 + p * 10 + n.val); go(n.left, 2 * i + 1); go(n.right, 2 * i + 2); }; go(r, 0); return { nums: out.sort((a, b) => a - b) }; },
    s(I, T) { const m = new Map(I.nums.map(x => [Math.floor(x / 10), x % 10])); let tot = 0; const go = (d, p, s) => { const k = d * 10 + p; if (!m.has(k)) return; s += m.get(k); const l = (d + 1) * 10 + 2 * p - 1, r = l + 1; if (!m.has(l) && !m.has(r)) { T.at({ nums: A(I.nums) }); T.n(`Path sum ending at depth ${d}, position ${p}?`, s, 'A leaf: add the path.'); tot += s; return; } go(d + 1, 2 * p - 1, s); go(d + 1, 2 * p, s); }; go(1, 1, 0); return tot; }
  });

  D('trim-a-binary-search-tree', {
    t: 'Trim a BST: skip out-of-range nodes',
    r: 'If a node is below low, the answer is the trimmed right subtree; above high, the trimmed left subtree; otherwise trim both children.',
    g: R => ({ root: R.bst(R.int(1, 7), 0, 15), low: R.int(0, 7), high: R.int(7, 15) }),
    s(I, T) { const root = Tr.from(I.root); const go = n => { if (!n) return null; const w = n.val < I.low ? 'below' : n.val > I.high ? 'above' : 'keep'; T.at({ tree: TR(root, { hit: n }), low: I.low, high: I.high }); T.c(`What happens to ${n.val}?`, ['below', 'above', 'keep'], w, 'Compare with [low, high].'); if (w === 'below') return go(n.right); if (w === 'above') return go(n.left); n.left = go(n.left); n.right = go(n.right); return n; }; return Tr.arr(go(root)); }
  });

  D('second-minimum-node-in-a-binary-tree', {
    t: 'Second Minimum Node: the root is the minimum',
    r: 'The root holds the minimum. Search for the smallest value greater than it; prune subtrees whose root already exceeds it (they cannot hold anything smaller).',
    g: R => { const mk = (v, d) => { if (d >= 3 || R.chance(0.35)) return N(v); const a = R.chance(0.5) ? v : v + R.int(0, 4), b = R.chance(0.5) ? v : v + R.int(0, 4); const L = mk(R.chance(0.5) ? v : a, d + 1); const Rr = mk(L.val === v ? b : v, d + 1); return N(v, L, Rr); }; return { root: Tr.arr(mk(R.int(1, 3), 1)) }; },
    s(I, T) { const root = Tr.from(I.root), m = root.val; let best = Infinity; for (const n of Tr.nodes(root)) if (n.val > m && n.val < best) { best = n.val; T.at({ tree: TR(root, { hit: n }) }); T.n('Second minimum candidate so far?', best, `Smallest value above ${m}.`); } return best === Infinity ? -1 : best; }
  });

  D('longest-univalue-path', {
    t: 'Longest Univalue Path: arms of equal values',
    r: 'Each node returns its longest downward arm of equal values. Through a node: left arm + right arm (only arms whose child equals the node).',
    g: R => ({ root: R.tree(R.int(0, 9), 1, 2) }),
    s(I, T) { const root = Tr.from(I.root); let best = 0; const go = n => { if (!n) return 0; const a = go(n.left), b = go(n.right); const L = n.left && n.left.val === n.val ? a + 1 : 0, Rr = n.right && n.right.val === n.val ? b + 1 : 0; best = Math.max(best, L + Rr); T.at({ tree: TR(root, { hit: n }), best }); T.n(`Univalue path through this ${n.val} (edges)?`, L + Rr, 'Matching left arm + right arm.'); return Math.max(L, Rr); }; go(root); return best; }
  });

  D('split-bst', {
    t: 'Split BST: recurse down one side',
    r: 'If root ≤ target, root belongs to the small tree: split root.right, attach its small part as root.right. Otherwise symmetric on the left.',
    g: R => { const a = R.bst(R.int(1, 7), 1, 15); return { root: a, target: R.int(0, 16) }; },
    s(I, T) { const root = Tr.from(I.root); const go = n => { if (!n) return [null, null]; const le = n.val <= I.target; T.at({ tree: TR(root, { hit: n }), target: I.target }); T.yn(`Does ${n.val} go to the small tree?`, le, '≤ target.'); if (le) { const [a, b] = go(n.right); n.right = a; return [n, b]; } const [a, b] = go(n.left); n.left = b; return [a, n]; }; const [a, b] = go(root); return [Tr.arr(a), Tr.arr(b)]; }
  });

  D('minimum-distance-between-bst-nodes', {
    t: 'Minimum Distance Between BST Nodes: consecutive inorder',
    r: 'Inorder traversal is sorted; the answer is the smallest gap between consecutive values.',
    g: R => ({ root: R.bst(R.int(2, 7), 0, 30) }),
    s(I, T) { const v = inorder(Tr.from(I.root)).map(n => n.val); let best = Infinity; for (let i = 1; i < v.length; i++) { T.at({ inorder: A(v, { hl: [i - 1, i] }) }); T.n(`Gap between ${v[i - 1]} and ${v[i]}?`, v[i] - v[i - 1], 'Consecutive inorder values.'); best = Math.min(best, v[i] - v[i - 1]); } return best; }
  });

  D('binary-tree-pruning', {
    t: 'Binary Tree Pruning: drop subtrees without a 1',
    r: 'Post-order: prune children first; remove a node if it is 0 and both children are gone.',
    g: R => ({ root: R.tree(R.int(1, 9), 0, 1) }),
    s(I, T) { const root = Tr.from(I.root); const go = n => { if (!n) return null; n.left = go(n.left); n.right = go(n.right); const rm = n.val === 0 && !n.left && !n.right; T.at({ tree: TR(root, { hit: n }) }); T.yn('Prune this node?', rm, 'A 0 with no remaining children.'); return rm ? null : n; }; return Tr.arr(go(root)); }
  });

  D('sum-of-distances-in-tree', {
    t: 'Sum of Distances in Tree: reroot with subtree sizes',
    r: 'First DFS: subtree sizes and the answer for root 0. Rerooting to child c: ans[c] = ans[parent] − size[c] + (n − size[c]).',
    g: R => { const n = R.int(1, 7); return { n, edges: Array.from({ length: n - 1 }, (_, i) => [R.int(0, i), i + 1]) }; },
    s(I, T) { const n = I.n, adj = Array.from({ length: n }, () => []); I.edges.forEach(([a, b]) => { adj[a].push(b); adj[b].push(a); }); const size = Array(n).fill(1), ans = Array(n).fill(0); let d0 = 0; const dfs = (u, p, d) => { d0 += d; for (const v of adj[u]) if (v !== p) { dfs(v, u, d + 1); size[u] += size[v]; } }; dfs(0, -1, 0); ans[0] = d0; T.at({ graph: GR(n, I.edges), size: A(size) }); T.n('Sum of distances from node 0?', d0, 'Sum of depths.'); const re = (u, p) => { for (const v of adj[u]) if (v !== p) { ans[v] = ans[u] - size[v] + (n - size[v]); T.at({ graph: GR(n, I.edges, { cls: { [v]: 'hit' } }), ans: A(ans) }); T.n(`Answer for node ${v}?`, ans[v], `ans[${u}] − ${size[v]} + ${n - size[v]}.`); re(v, u); } }; re(0, -1); return ans; }
  });

  D('all-nodes-distance-k-in-binary-tree', {
    t: 'All Nodes Distance K: treat the tree as a graph',
    r: 'Record parent pointers, then BFS from the target through left, right and parent; collect the nodes at distance k.',
    g: R => { const a = R.tree(R.int(1, 9), 0, 9), r = Tr.from(a); const v = R.shuffle(Tr.nodes(r).map((_, i) => i)); Tr.nodes(r).forEach((x, i) => x.val = v[i]); return { root: Tr.arr(r), target: R.pick(v), k: R.int(0, 3) }; },
    cmp: 'set',
    s(I, T) { const root = Tr.from(I.root), par = new Map(); Tr.nodes(root).forEach(n => { if (n.left) par.set(n.left, n); if (n.right) par.set(n.right, n); }); let lv = [Tr.find(root, I.target)]; const seen = new Set(lv); for (let d = 0; d < I.k && lv.length; d++) { lv = lv.flatMap(n => [n.left, n.right, par.get(n)].filter(x => x && !seen.has(x))); lv.forEach(x => seen.add(x)); T.at({ tree: TR(root, { hit: lv }) }); T.n(`Nodes at distance ${d + 1}?`, lv.length, 'Neighbors (children and parent) not yet seen.'); } return lv.map(n => n.val); }
  });
})();
