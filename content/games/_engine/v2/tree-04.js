/* v2 games: trees (04). */
(function () {
  'use strict';
  const { D, A, G, K, X, Tr, TR, GR } = LCGame.H;
  const N = (v, l, r) => ({ val: v, left: l || null, right: r || null });
  const inorder = (r, out = []) => { if (r) { inorder(r.left, out); out.push(r); inorder(r.right, out); } return out; };
  const leaf = n => !n.left && !n.right;
  const uniq = (R, n, maxD) => { const r = Tr.from(R.tree(n, 1, 9, maxD || 4)); const v = R.shuffle(Tr.nodes(r).map((_, i) => i + 1)); Tr.nodes(r).forEach((x, i) => x.val = v[i]); return r; };
  const naryFrom = a => { if (!a || !a.length) return null; const root = { val: a[0], children: [] }, q = [root]; let i = 2; while (i < a.length && q.length) { const n = q.shift(); while (i < a.length && a[i] !== null) { const c = { val: a[i], children: [] }; n.children.push(c); q.push(c); i++; } i++; } return root; };
  const naryArr = root => { if (!root) return []; const out = [root.val, null], q = [root]; while (q.length) { const x = q.shift(); x.children.forEach(c => { out.push(c.val); q.push(c); }); out.push(null); } while (out.length && out[out.length - 1] === null) out.pop(); return out; };
  const naryGen = R => { const n = R.int(2, 7), vals = R.distinct(n, 1, 20), nodes = [{ val: vals[0], children: [] }]; for (let i = 1; i < n; i++) { const c = { val: vals[i], children: [] }; R.pick(nodes).children.push(c); nodes.push(c); } return naryArr(nodes[0]); };
  const naryNodes = r => { const out = [], st = r ? [r] : []; while (st.length) { const n = st.shift(); out.push(n); st.push(...n.children); } return out; };
  const treeEdges = (R, n, base) => Array.from({ length: n - 1 }, (_, i) => [R.int(0, i) + base, i + 1 + base]);
  const adjOf = (n, edges, base) => { const g = Array.from({ length: n + base }, () => []); edges.forEach(([a, b]) => { g[a].push(b); g[b].push(a); }); return g; };
  const rawTree = I => { for (const k in I) if (I[k] && I[k].__raw) I[k] = I[k].__raw.replace(/^\[|\]$/g, '').split(',').map(x => x.trim()).filter(x => x !== '').map(x => x === 'null' ? null : x); return I; };
  const M = 1000000007n;
  const gcd = (a, b) => b ? gcd(b, a % b) : a;

  D('frog-position-after-t-seconds', {
    t: 'Frog Position After t Seconds: split probability, stop at leaves',
    r: 'DFS from vertex 1 multiplying by 1 divided by (unvisited children). At the target: if exactly t seconds passed, or the frog is stuck (no unvisited children) before t, return the probability; otherwise 0.',
    g: R => { const n = R.int(1, 7); return { n, edges: treeEdges(R, n, 1), t: R.int(1, 4), target: R.int(1, n) }; },
    cmp: 'float',
    s(I, T) { const g = adjOf(I.n, I.edges, 1); const go = (u, p, time, prob) => { const kids = g[u].filter(v => v !== p); if (u === I.target) { const ok = time === I.t || (time < I.t && !kids.length); T.at({ graph: GR(I.n, I.edges, { base: 1, cls: { [u]: 'hit' } }), time, prob: Math.round(prob * 1e4) / 1e4 }); T.yn('Is the frog still on the target at time t?', ok, 'Exactly t, or stuck at a leaf earlier.'); return ok ? prob : 0; } if (time === I.t || !kids.length) return 0; T.at({ graph: GR(I.n, I.edges, { base: 1, cls: { [u]: 'hit' } }) }); T.n(`Unvisited neighbors of ${u}?`, kids.length, 'The probability splits evenly among them.'); for (const v of kids) { const r = go(v, u, time + 1, prob / kids.length); if (r) return r; } return 0; }; return go(1, 0, 0, 1); }
  });

  D('find-a-corresponding-node-of-a-binary-tree-in-a-clone-of-that-tree', {
    t: 'Corresponding Node in a Clone: walk both trees in lockstep',
    r: 'Traverse the original and the clone together; when the original node is the target, return the clone\'s node at the same step.',
    g: R => { const r = uniq(R, R.int(1, 7)); return { tree: Tr.arr(r), target: R.pick(Tr.nodes(r)).val }; },
    s(I, T) { const o = Tr.from(I.tree), c = Tr.from(I.tree); const a = Tr.nodes(o), b = Tr.nodes(c); for (let i = 0; i < a.length; i++) { T.at({ original: TR(o, { hit: a[i] }), cloned: TR(c, { hit: b[i] }) }); T.yn(`Is this the target (${I.target})?`, a[i].val === I.target, 'Compare with the original node.'); if (a[i].val === I.target) return b[i].val; } }
  });

  D('balance-a-binary-search-tree', {
    t: 'Balance a BST: inorder, then rebuild from the middle',
    r: 'Collect values in sorted order with an inorder traversal, then build a balanced BST by taking the middle as the root recursively.',
    g: R => { const v = R.distinct(R.int(1, 7), 1, 20).sort((a, b) => a - b); let r = null; for (const x of R.chance(0.5) ? v : R.shuffle(v)) { if (!r) { r = N(x); continue; } let c = r; while (true) { const d = x < c.val ? 'left' : 'right'; if (!c[d]) { c[d] = N(x); break; } c = c[d]; } } if (Tr.depth(r) > 5) { r = null; for (const x of v.slice(0, 5)) r = r ? (function ins(n) { if (!n) return N(x); if (x < n.val) n.left = ins(n.left); else n.right = ins(n.right); return n; })(r) : N(x); } return { root: Tr.arr(r) }; },
    cmp: (out, exp, I) => { const r = Tr.from(out), io = inorder(r).map(n => n.val), want = inorder(Tr.from(I.root)).map(n => n.val); const bal = n => { if (!n) return 0; const a = bal(n.left), b = bal(n.right); return a < 0 || b < 0 || Math.abs(a - b) > 1 ? -1 : 1 + Math.max(a, b); }; return io.join() === want.join() && bal(r) >= 0; },
    s(I, T) { const v = inorder(Tr.from(I.root)).map(n => n.val); const go = (l, r) => { if (l > r) return null; const m = (l + r) >> 1; T.at({ sorted: A(v, { win: [l, r], hl: [m] }) }); T.n(`Root value for ${l}…${r}?`, v[m], 'The middle element.'); return N(v[m], go(l, m - 1), go(m + 1, r)); }; return Tr.arr(go(0, v.length - 1)); }
  });

  D('check-if-a-string-is-a-valid-sequence-from-root-to-leaves-path-in-a-binary-tree', {
    t: 'Valid Root-to-Leaf Sequence: match level by level',
    r: 'DFS matching arr[i] at depth i; succeed only at a leaf when i is the last index.',
    g: R => { const t = R.tree(R.int(1, 8), 0, 2), r = Tr.from(t); let arr = []; if (R.chance(0.6)) { let n = r; while (n) { arr.push(n.val); n = R.chance(0.5) ? n.left || n.right : n.right || n.left; } } else arr = R.ints(R.int(1, 4), 0, 2); return { root: t, arr }; },
    s(I, T) { const res = (() => { const root = Tr.from(I.root); const go = (n, i) => { if (!n || i >= I.arr.length || n.val !== I.arr[i]) return false; if (leaf(n)) { T.at({ tree: TR(root, { hit: n }), arr: A(I.arr, { hl: [i] }) }); T.yn(`At leaf ${n.val}, is the whole array used?`, i === I.arr.length - 1, 'Must end exactly at a leaf.'); return i === I.arr.length - 1; } return go(n.left, i + 1) || go(n.right, i + 1); }; T.at({ tree: TR(root), arr: A(I.arr) }); T.yn('Does the root match arr[0]?', !!root && root.val === I.arr[0], 'Otherwise no path can work.'); return go(root, 0); })(); T.yn('Is arr a valid root-to-leaf path?', res, 'Some path must match it exactly.'); return res; }
  });

  D('minimum-time-to-collect-all-apples-in-a-tree', {
    t: 'Collect All Apples: walk an edge only if its subtree has apples',
    r: 'DFS: a child contributes its own cost + 2 (there and back) if it has an apple or its subtree needed any walking.',
    g: R => { const n = R.int(1, 8); return { n, edges: treeEdges(R, n, 0), hasApple: Array.from({ length: n }, () => R.chance(0.35)) }; },
    s(I, T) { const g = adjOf(I.n, I.edges, 0); const go = (u, p) => { let t = 0; for (const v of g[u]) if (v !== p) { const c = go(v, u); if (c > 0 || I.hasApple[v]) t += c + 2; } T.at({ graph: GR(I.n, I.edges, { cls: Object.fromEntries(I.hasApple.map((h, i) => [i, h ? 'ok' : '']).filter(e => e[1]).concat([[u, 'hit']])) }) }); T.n(`Seconds needed inside the subtree of ${u}?`, t, 'Children that need a visit cost their time + 2.'); return t; }; return go(0, -1); }
  });

  D('count-good-nodes-in-binary-tree', {
    t: 'Count Good Nodes: carry the path maximum',
    r: 'A node is good if its value is at least the maximum seen on the path from the root.',
    g: R => ({ root: R.tree(R.int(1, 9), 1, 6) }),
    s(I, T) { const root = Tr.from(I.root); let c = 0; const go = (n, mx) => { if (!n) return; const good = n.val >= mx; T.at({ tree: TR(root, { hit: n }), pathMax: mx === -Infinity ? '—' : mx }); T.yn(`Is this ${n.val} good?`, good, 'Not smaller than the path max.'); if (good) c++; go(n.left, Math.max(mx, n.val)); go(n.right, Math.max(mx, n.val)); }; go(root, -Infinity); return c; }
  });

  D('pseudo-palindromic-paths-in-a-binary-tree', {
    t: 'Pseudo-Palindromic Paths: parity bitmask',
    r: 'Toggle bit val on the way down. At a leaf the path can form a palindrome exactly when at most one bit is set (mask & (mask − 1) = 0).',
    g: R => ({ root: R.tree(R.int(1, 9), 1, 3) }),
    s(I, T) { const root = Tr.from(I.root); let c = 0; const go = (n, m) => { if (!n) return; m ^= 1 << n.val; if (leaf(n)) { const ok = (m & (m - 1)) === 0; T.at({ tree: TR(root, { hit: n }), mask: m.toString(2) }); T.yn('Pseudo-palindromic path?', ok, 'At most one odd count.'); if (ok) c++; } go(n.left, m); go(n.right, m); }; go(root, 0); return c; }
  });

  D('find-all-the-lonely-nodes', {
    t: 'Find All the Lonely Nodes: only children',
    r: 'For each node with exactly one child, that child is lonely.',
    g: R => ({ root: R.tree(R.int(1, 9)) }),
    cmp: 'set',
    s(I, T) { const root = Tr.from(I.root), out = []; for (const n of Tr.nodes(root)) if (!n.left !== !n.right) { const c = n.left || n.right; T.at({ tree: TR(root, { hit: n, ok: c }) }); T.n(`Lonely child of ${n.val}?`, c.val, 'The only child.'); out.push(c.val); } return out; }
  });

  D('clone-binary-tree-with-random-pointer', {
    t: 'Clone Tree With Random Pointers: map old to new',
    r: 'First pass: copy every node into a map. Second pass: set left, right and random from the map.',
    g: R => { const t = R.tree(R.int(1, 6)); const idx = t.map((v, i) => v === null ? -1 : i).filter(i => i >= 0); return { root: t.map(v => v === null ? null : [v, R.chance(0.6) ? R.pick(idx) : null]) }; },
    s(I, T) { const a = I.root; a.forEach((x, i) => { if (x && x[1] !== null && x[1] !== undefined) { T.at({ nodes: A(a.map(y => y ? y[0] : null), { hl: [i] }) }); T.n(`Index the copy of node ${i} points to randomly?`, x[1], 'Map lookup of the original random target.'); } }); return a.map(x => x ? [x[0], x[1] === undefined ? null : x[1]] : null); }
  });

  D('clone-n-ary-tree', {
    t: 'Clone N-ary Tree: copy node, then children',
    r: 'Recursively create a new node with the same value and clone each child into its list.',
    g: R => ({ root: naryGen(R) }),
    s(I, T) { const root = naryFrom(I.root); const cl = n => { const c = { val: n.val, children: n.children.map(cl) }; if (n.children.length) { T.at({ node: n.val, children: A(n.children.map(x => x.val)) }); T.n(`Children copied for ${n.val}?`, n.children.length, 'Every child is cloned.'); } return c; }; return root ? naryArr(cl(root)) : []; }
  });

  D('find-root-of-n-ary-tree', {
    t: 'Find Root of N-ary Tree: sum trick',
    r: 'Every node except the root appears exactly once as a child. Root value = the sum of all values − the sum of child values.',
    g: R => ({ tree: naryGen(R) }),
    s(I, T) { const root = naryFrom(I.tree), ns = naryNodes(root); const all = ns.reduce((a, n) => a + n.val, 0), ch = ns.reduce((a, n) => a + n.children.reduce((b, c) => b + c.val, 0), 0); T.at({ nodes: A(ns.map(n => n.val)) }); T.n('Sum of all node values?', all, 'Every node once.'); T.n('Sum of all child values?', ch, 'Every node except the root, once.'); T.n('Root value?', all - ch, 'The difference of the two sums.'); return naryArr(root); }
  });

  D('move-sub-tree-of-n-ary-tree', {
    t: 'Move Subtree of N-ary Tree: three cases',
    r: 'If p is already q\'s child, do nothing. If q lies inside p\'s subtree, first detach q from its parent and put q where p was. Then detach p and append it as q\'s last child.',
    g: R => { const a = naryGen(R), ns = naryNodes(naryFrom(a)); const p = R.pick(ns).val; let q; do q = R.pick(ns).val; while (q === p); return { root: a, p, q }; },
    s(I, T) { let root = naryFrom(I.root); const ns = naryNodes(root), par = new Map(); ns.forEach(n => n.children.forEach(c => par.set(c, n))); const P = ns.find(n => n.val === I.p), Q = ns.find(n => n.val === I.q); T.at({ p: I.p, q: I.q, tree: X(JSON.stringify(I.root)) }); T.n('Children of q before the move?', Q.children.length, 'p will be added as the last child.'); T.yn('Is p the root?', !par.get(P), 'Then q may have to become the new root.'); if (par.get(P) === Q) { T.at({ p: I.p, q: I.q }); T.c('Which case is this?', ['already a child', 'q inside p', 'otherwise'], 'already a child', 'p\'s parent is q.'); return I.root; } let x = Q, inside = false; while (x) { if (x === P) inside = true; x = par.get(x); } T.at({ p: I.p, q: I.q, tree: X(JSON.stringify(I.root)) }); T.c('Which case is this?', ['already a child', 'q inside p', 'otherwise'], inside ? 'q inside p' : 'otherwise', 'Is q a descendant of p?'); if (inside) { const qp = par.get(Q); qp.children.splice(qp.children.indexOf(Q), 1); const pp = par.get(P); if (pp) pp.children[pp.children.indexOf(P)] = Q; else root = Q; } else { const pp = par.get(P); pp.children.splice(pp.children.indexOf(P), 1); } Q.children.push(P); return naryArr(root); }
  });

  D('number-of-nodes-in-the-sub-tree-with-the-same-label', {
    t: 'Same Label in Subtree: merge 26 counters',
    r: 'DFS returns a count per letter for the subtree; a node\'s answer is the count of its own label in its subtree (including itself).',
    g: R => { const n = R.int(1, 7); return { n, edges: treeEdges(R, n, 0), labels: R.str(n, 'ab') }; },
    s(I, T) { const g = adjOf(I.n, I.edges, 0), ans = Array(I.n).fill(0); const go = (u, p) => { const c = {}; for (const v of g[u]) if (v !== p) { const d = go(v, u); for (const k in d) c[k] = (c[k] || 0) + d[k]; } c[I.labels[u]] = (c[I.labels[u]] || 0) + 1; ans[u] = c[I.labels[u]]; T.at({ graph: GR(I.n, I.edges, { cls: { [u]: 'hit' }, tag: Object.fromEntries([...I.labels].map((l, i) => [i, l])) }) }); T.n(`Nodes labelled "${I.labels[u]}" in the subtree of ${u}?`, ans[u], 'Including itself.'); return c; }; go(0, -1); return ans; }
  });

  D('diameter-of-n-ary-tree', {
    t: 'Diameter of N-ary Tree: two tallest children',
    r: 'For each node, the longest path through it uses its two tallest child heights; return 1 + the tallest upward.',
    g: R => ({ root: naryGen(R) }),
    s(I, T) { const root = naryFrom(I.root); let best = 0; const go = n => { const h = n.children.map(go).sort((a, b) => b - a); const through = (h[0] || 0) + (h[1] || 0); best = Math.max(best, through); if (n.children.length) { T.at({ node: n.val, heights: A(h) }); T.n(`Longest path through ${n.val} (edges)?`, through, 'Sum of the two tallest child heights.'); } return 1 + (h[0] || 0); }; go(root); return best; }
  });

  D('number-of-good-leaf-nodes-pairs', {
    t: 'Good Leaf Pairs: distance lists from each subtree',
    r: 'Each node returns the distances to the leaves below it. At a node, count pairs (one from the left list, one from the right) with sum at most distance; pass distances + 1 upward.',
    g: R => ({ root: R.tree(R.int(1, 9)), distance: R.int(1, 5) }),
    s(I, T) { const res = (() => { const root = Tr.from(I.root); let c = 0; const go = n => { if (!n) return []; if (leaf(n)) return [1]; const a = go(n.left), b = go(n.right); let k = 0; for (const x of a) for (const y of b) if (x + y <= I.distance) k++; if (n.left && n.right) { T.at({ tree: TR(root, { hit: n }), left: A(a), right: A(b) }); T.n(`Good pairs meeting at ${n.val}?`, k, `Left plus right distance is at most ${I.distance}.`); } c += k; return [...a, ...b].map(x => x + 1).filter(x => x < I.distance); }; go(root); return c; })(); T.n('Good leaf pairs in total?', res, 'Add the pairs found at every node.'); return res; }
  });

  D('build-binary-expression-tree-from-infix-expression', {
    t: 'Expression Tree From Infix: two stacks',
    r: 'Shunting-yard: push operands as leaves; on an operator, first combine while the stack top has precedence at least it; "(" waits for ")"; combine = pop op and two nodes into a new node.',
    g: R => { const n = R.int(2, 4); let s = String(R.int(1, 9)); for (let i = 1; i < n; i++) s += R.pick(['+', '-', '*', '/']) + R.int(1, 9); return { s }; },
    s(I, T) { const ops = [], nodes = [], pr = { '+': 1, '-': 1, '*': 2, '/': 2, '(': 0 }; const comb = () => { const op = ops.pop(), r = nodes.pop(), l = nodes.pop(); nodes.push(N(op, l, r)); T.at({ ops: A(ops.slice()), nodes: A(nodes.map(x => x.val)) }); T.c('Operator just combined?', ['+', '-', '*', '/'], op, 'Top of the operator stack.'); }; for (const ch of I.s) { if (/\d/.test(ch)) nodes.push(N(ch)); else if (ch === '(') ops.push(ch); else if (ch === ')') { while (ops[ops.length - 1] !== '(') comb(); ops.pop(); } else { while (ops.length && pr[ops[ops.length - 1]] >= pr[ch]) comb(); ops.push(ch); } } while (ops.length) comb(); return Tr.arr(nodes[0]); }
  });

  D('find-nearest-right-node-in-binary-tree', {
    t: 'Nearest Right Node: next in the same BFS level',
    r: 'BFS level by level; when you meet u, the next node in the same level is the answer (null if u is last).',
    g: R => { const r = uniq(R, R.int(1, 8)); return { root: Tr.arr(r), u: R.pick(Tr.nodes(r)).val }; },
    s(I, T) { const root = Tr.from(I.root); let lv = [root]; while (lv.length) { const i = lv.findIndex(n => n.val === I.u); if (i >= 0) { T.at({ tree: TR(root, { hit: lv[i] }) }); T.n(`How many nodes are on the level of ${I.u}?`, lv.length, 'One BFS level.'); T.n(`How many nodes are to the right of ${I.u} on its level?`, lv.length - 1 - i, 'Same BFS level.'); T.yn('Is there a nearest right node?', i + 1 < lv.length, 'Otherwise the answer is null.'); return i + 1 < lv.length ? lv[i + 1].val : null; } lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); } return null; }
  });

  D('even-odd-tree', {
    t: 'Even-Odd Tree: parity and order per level',
    r: 'Even levels: odd values, strictly increasing. Odd levels: even values, strictly decreasing. Check level by level.',
    g: R => ({ root: R.tree(R.int(1, 8), 1, 12) }),
    s(I, T) { const res = (() => { const root = Tr.from(I.root); let lv = [root], d = 0; const ht = n => n ? 1 + Math.max(ht(n.left), ht(n.right)) : 0; T.at({ tree: TR(root) }); T.n('How many levels does the tree have?', ht(root), 'Each one is checked in turn.'); while (lv.length) { const v = lv.map(n => n.val); const ok = v.every((x, i) => (d % 2 ? x % 2 === 0 : x % 2 === 1) && (!i || (d % 2 ? x < v[i - 1] : x > v[i - 1]))); T.at({ tree: TR(root, { hit: lv }), level: A(v) }); T.yn(`Is level ${d} valid?`, ok, d % 2 ? 'Even values, strictly decreasing.' : 'Odd values, strictly increasing.'); if (!ok) return false; lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); d++; } return true; })(); T.yn('Is it an Even-Odd tree?', res, 'Every level must pass.'); return res; }
  });

  D('check-if-two-expression-trees-are-equivalent', {
    t: 'Equivalent Expression Trees (+ only): count the variables',
    r: 'With only "+", the value depends only on how many times each variable appears. Count leaves per letter in both trees and compare.',
    g: R => { const mk = d => d >= 3 || R.chance(0.4) ? N(R.pick(['a', 'b', 'c'])) : N('+', mk(d + 1), mk(d + 1)); return { root1: Tr.arr(mk(1)), root2: Tr.arr(mk(1)) }; },
    exIn: rawTree,
    s(I, T) { const cnt = a => { const c = {}; Tr.nodes(Tr.from(a)).filter(leaf).forEach(n => c[n.val] = (c[n.val] || 0) + 1); return c; }; const a = cnt(I.root1), b = cnt(I.root2); for (const k of ['a', 'b', 'c', 'x'].filter(k => a[k] || b[k])) { T.at({ tree1: K(a), tree2: K(b) }); T.yn(`Does "${k}" appear equally often in both?`, (a[k] || 0) === (b[k] || 0), `${a[k] || 0} vs ${b[k] || 0}.`); } const keys = new Set([...Object.keys(a), ...Object.keys(b)]); return [...keys].every(k => a[k] === b[k]); }
  });

  D('count-subtrees-with-max-distance-between-cities', {
    t: 'Subtrees by Max Distance: enumerate city subsets',
    r: 'For every subset of cities (bitmask), check it is connected (edges inside = size − 1) and compute its diameter; count subsets per diameter 1 … n − 1.',
    g: R => { const n = R.int(2, 6); return { n, edges: treeEdges(R, n, 1) }; },
    s(I, T) { const n = I.n, d = Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => i === j ? 0 : 99)); I.edges.forEach(([a, b]) => { d[a - 1][b - 1] = d[b - 1][a - 1] = 1; }); for (let k = 0; k < n; k++) for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) d[i][j] = Math.min(d[i][j], d[i][k] + d[k][j]); const out = Array(n - 1).fill(0); for (let m = 1; m < 1 << n; m++) { const s = [...Array(n).keys()].filter(i => m >> i & 1); if (s.length < 2) continue; const e = I.edges.filter(([a, b]) => m >> (a - 1) & 1 && m >> (b - 1) & 1).length; if (e !== s.length - 1) continue; let dia = 0; for (const i of s) for (const j of s) dia = Math.max(dia, d[i][j]); out[dia - 1]++; } T.at({ graph: GR(n, I.edges, { base: 1 }) }); T.n('Connected subtrees with diameter 1 (single edges)?', out[0], 'Every edge is one.'); if (n > 2) T.n('Connected subtrees with diameter 2?', out[1], 'Paths of length 2 and stars.'); T.n('Connected subtrees with 2 or more cities, in total?', out.reduce((a, b) => a + b, 0), 'Add every diameter count.'); return out; }
  });

  D('lowest-common-ancestor-of-a-binary-tree-ii', {
    t: 'LCA II: both nodes must actually exist',
    r: 'Do a full post-order (no early return) counting how many of p, q were found. Return the LCA only if both were found.',
    g: R => { const r = uniq(R, R.int(1, 8)); const v = Tr.nodes(r).map(n => n.val); const p = R.pick(v); let q; do q = R.chance(0.7) ? R.pick(v) : R.int(1, 12); while (q === p); return { root: Tr.arr(r), p, q }; },
    s(I, T) { const res = (() => { const root = Tr.from(I.root); let found = 0, ans = null; const go = n => { if (!n) return null; const l = go(n.left), r = go(n.right); if (n.val === I.p || n.val === I.q) { found++; return n; } if (l && r) ans = n; return l && r ? n : l || r; }; const top = go(root); T.at({ tree: TR(root) }); T.yn('Is p in the tree?', !!Tr.find(root, I.p), 'Both p and q must exist.'); T.n('How many of p and q exist in the tree?', found, 'Count them during the full traversal.'); if (found < 2) return null; return (ans || top).val; })(); T.n('LCA value (−1 if missing)?', res === null ? -1 : res, 'Only when both nodes exist.'); return res; }
  });

  D('lowest-common-ancestor-of-a-binary-tree-iii', {
    t: 'LCA III: two pointers with parent links',
    r: 'Move a and b up via parents; when one reaches null, restart it at the other start. They meet at the LCA (like intersecting linked lists).',
    g: R => { const r = uniq(R, R.int(2, 8)); const v = Tr.nodes(r).map(n => n.val), p = R.pick(v); let q; do q = R.pick(v); while (q === p); return { root: Tr.arr(r), p, q }; },
    s(I, T) { const root = Tr.from(I.root), par = new Map(); Tr.nodes(root).forEach(n => { if (n.left) par.set(n.left, n); if (n.right) par.set(n.right, n); }); const P = Tr.find(root, I.p), Q = Tr.find(root, I.q); let dp = 0; for (let x = P; x !== root; x = par.get(x)) dp++; T.at({ tree: TR(root, { hit: [P, Q] }) }); T.n('Depth of p?', dp, 'Parent links up to the root.'); let a = P, b = Q, steps = 0; while (a !== b) { a = a === root ? Q : par.get(a); b = b === root ? P : par.get(b); steps++; } T.at({ tree: TR(root, { hit: [P, Q] }) }); T.n('Steps until the pointers meet?', steps, 'Each pointer walks its own path then the other\'s.'); T.n('LCA value?', a.val, 'Where the climbs meet.'); return a.val; }
  });

  D('correct-a-binary-tree', {
    t: 'Correct a Binary Tree: BFS right to left',
    r: 'BFS each level from right to left, remembering visited nodes. A node whose right child was already seen (on this level) is the defective one: remove it from its parent.',
    g: R => { for (;;) { const r = uniq(R, R.int(3, 9)); const lv = []; let cur = [r]; while (cur.length) { lv.push(cur); cur = cur.flatMap(n => [n.left, n.right].filter(Boolean)); } const opts = []; lv.forEach(l => l.forEach((n, i) => { if (!n.right && i + 1 < l.length && n !== r) opts.push([n, R.pick(l.slice(i + 1))]); })); if (opts.length) { const [f, t] = R.pick(opts); return { root: Tr.arr(r), fromNode: f.val, toNode: t.val }; } } },
    s(I, T) { const root = Tr.from(I.root), par = new Map(); Tr.nodes(root).forEach(n => { if (n.left) par.set(n.left, n); if (n.right) par.set(n.right, n); }); Tr.find(root, I.fromNode).right = Tr.find(root, I.toNode); let lv = [root]; while (lv.length) { const seen = new Set(); for (let i = lv.length - 1; i >= 0; i--) { const n = lv[i]; if (n.right && seen.has(n.right)) { T.at({ level: A(lv.map(x => x.val), { hl: [i] }) }); T.n('How many nodes are on this level?', lv.length, 'Scan from right to left.'); T.n('Value of the defective node?', n.val, 'Its right child is already on this level.'); T.n('Value of its wrong right child?', n.right.val, 'A node we already saw on this level.'); const p = par.get(n); if (p.left === n) p.left = null; else p.right = null; return Tr.arr(root); } seen.add(n); } const nx = []; for (const n of lv) { if (n.left) nx.push(n.left); if (n.right && !lv.includes(n.right)) nx.push(n.right); } lv = nx; } return Tr.arr(root); }
  });

  D('change-the-root-of-a-binary-tree', {
    t: 'Change the Root: flip pointers along the leaf-to-root path',
    r: 'Walk from the leaf up. At each node cur (not the old root): its left child (if any) moves to the right, and its old parent becomes its left child (detaching cur from that parent).',
    g: R => { const r = uniq(R, R.int(2, 7), 3); return { root: Tr.arr(r), leaf: R.pick(Tr.nodes(r).filter(leaf)).val }; },
    s(I, T) { const root = Tr.from(I.root), par = new Map(); Tr.nodes(root).forEach(n => { if (n.left) par.set(n.left, n); if (n.right) par.set(n.right, n); }); const L = Tr.find(root, I.leaf); let dl = 0; for (let x = L; x !== root; x = par.get(x)) dl++; T.at({ tree: TR(root, { hit: L }) }); T.n('Depth of the new root?', dl, 'One rewiring step per edge on the path.'); let cur = L; while (cur !== root) { const p = par.get(cur); if (cur.left) cur.right = cur.left; cur.left = p; if (p.left === cur) p.left = null; else p.right = null; T.at({ step: cur.val }); T.n(`New left child of ${cur.val}?`, p.val, 'Its old parent.'); cur = p; } return Tr.arr(L); }
  });

  D('lowest-common-ancestor-of-a-binary-tree-iv', {
    t: 'LCA IV: a set of target nodes',
    r: 'Same as the classic LCA, but "is a target" means membership in the set. A node returns itself if it is a target; if both sides return something, it is the LCA.',
    g: R => { const r = uniq(R, R.int(1, 8)); return { root: Tr.arr(r), nodes: R.distinct(R.int(1, Math.min(3, Tr.size(r))), 1, Tr.size(r)) }; },
    s(I, T) { const root = Tr.from(I.root), s = new Set(I.nodes); const go = n => { if (!n) return null; if (s.has(n.val)) return n; const l = go(n.left), r = go(n.right); if (l && r) { T.at({ tree: TR(root, { hit: n, ok: [l, r] }) }); T.yn(`Do both sides of ${n.val} contain targets?`, true, 'This node is a candidate LCA.'); return n; } return l || r; }; T.at({ tree: TR(root), nodes: A(I.nodes) }); T.n('How many target nodes?', I.nodes.length, 'Stop at any target.'); const a = go(root); T.at({ tree: TR(root, { hit: a }) }); T.n('LCA value?', a.val, 'Returned from the root call.'); T.yn('Is the LCA itself one of the targets?', s.has(a.val), 'A target can be its own ancestor.'); return a.val; }
  });

  D('find-distance-in-a-binary-tree', {
    t: 'Find Distance in a Binary Tree: depth(p) + depth(q) − 2 times depth(LCA)',
    r: 'Find the LCA, then add the distances from it down to p and to q.',
    g: R => { const r = uniq(R, R.int(1, 8)); const v = Tr.nodes(r).map(n => n.val); return { root: Tr.arr(r), p: R.pick(v), q: R.pick(v) }; },
    s(I, T) { const res = (() => { const root = Tr.from(I.root), dep = new Map(), par = new Map(); const go = (n, d, p) => { if (!n) return; dep.set(n, d); par.set(n, p); go(n.left, d + 1, n); go(n.right, d + 1, n); }; go(root, 0, null); const P = Tr.find(root, I.p), Q = Tr.find(root, I.q); const anc = new Set(); for (let x = P; x; x = par.get(x)) anc.add(x); let l = Q; while (!anc.has(l)) l = par.get(l); T.at({ tree: TR(root, { hit: [P, Q], ok: l }) }); T.n('Depth of p?', dep.get(P), 'Edges from the root.'); T.n('LCA value?', l.val, 'First common ancestor.'); return dep.get(P) + dep.get(Q) - 2 * dep.get(l); })(); T.n('Distance between p and q?', res, 'Depth of p plus depth of q, minus twice the depth of the LCA.'); return res; }
  });

  D('tree-of-coprimes', {
    t: 'Tree of Coprimes: last ancestor per value',
    r: 'DFS keeping, for each value 1 … 50, the deepest ancestor with that value. For a node, check all coprime values and take the deepest such ancestor.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 8), edges: treeEdges(R, n, 0) }; },
    s(I, T) { const n = I.nums.length, g = adjOf(n, I.edges, 0), ans = Array(n).fill(-1), last = {}; const go = (u, p, d) => { let best = -1, bd = -1; for (const v in last) if (last[v].length && gcd(+v, I.nums[u]) === 1) { const [node, dd] = last[v][last[v].length - 1]; if (dd > bd) { bd = dd; best = node; } } ans[u] = best; T.at({ graph: GR(n, I.edges, { cls: { [u]: 'hit' }, tag: Object.fromEntries(I.nums.map((x, i) => [i, String(x)])) }) }); T.n(`Closest coprime ancestor of node ${u} (−1 if none)?`, best, 'Deepest ancestor whose value is coprime.'); (last[I.nums[u]] = last[I.nums[u]] || []).push([u, d]); for (const v of g[u]) if (v !== p) go(v, u, d + 1); last[I.nums[u]].pop(); }; go(0, -1, 0); return ans; }
  });

  D('depth-of-bst-given-insertion-order', {
    t: 'Depth of BST From Insertion Order: neighbors decide',
    r: 'A new value hangs under its in-order predecessor or successor (whichever is deeper), so depth = 1 + max(depth(pred), depth(succ)).',
    g: R => ({ order: R.perm(R.int(1, 8), 1) }),
    s(I, T) { const dep = new Map(); let best = 0; for (const x of I.order) { let lo = null, hi = null; for (const k of dep.keys()) { if (k < x && (lo === null || k > lo)) lo = k; if (k > x && (hi === null || k < hi)) hi = k; } const d = 1 + Math.max(lo === null ? 0 : dep.get(lo), hi === null ? 0 : dep.get(hi)); dep.set(x, d); best = Math.max(best, d); T.at({ order: A(I.order, { hl: [I.order.indexOf(x)] }), depths: K([...dep].sort((a, b) => a[0] - b[0]).map(([k, v]) => [String(k), String(v)])) }); T.n(`Depth of ${x}?`, d, '1 + deeper of predecessor and successor.'); } return best; }
  });

  D('count-ways-to-build-rooms-in-an-ant-colony', {
    t: 'Ways to Build Rooms: n! divided by the product of subtree sizes',
    r: 'The build orders are the topological orders of the tree: n! divided by the product of all subtree sizes (mod 1e9+7).',
    g: R => { const n = R.int(2, 7); return { prevRoom: Array.from({ length: n }, (_, i) => i ? R.int(0, i - 1) : -1) }; },
    s(I, T) { const res = (() => { const n = I.prevRoom.length, size = Array(n).fill(1); for (let i = n - 1; i > 0; i--) size[I.prevRoom[i]] += size[i]; T.at({ prevRoom: A(I.prevRoom), size: A(size) }); T.n('Size of the largest subtree below room 0?', Math.max(...size.slice(1)), 'Add sizes from the leaves up.'); T.n('Product of all subtree sizes?', size.reduce((a, b) => a * b, 1), 'Multiply the subtree sizes together.'); let f = 1n; for (let i = 2; i <= n; i++) f = f * BigInt(i); return Number(f / BigInt(size.reduce((a, b) => a * b, 1)) % M); })(); T.n('Build orders, mod 1000000007?', res, 'n! divided by the product of subtree sizes.'); return res; }
  });

  D('merge-bsts-to-create-single-bst', {
    t: 'Merge BSTs: the unique non-leaf root',
    r: 'The final root is the only tree whose root value is not a leaf of another tree. Repeatedly replace leaves with the tree rooted at the same value, then check the result is a valid BST using all trees.',
    g: R => { if (R.chance(0.5)) { const v = R.distinct(R.int(2, 6), 1, 12); return { trees: v.map(x => [x]) }; } const r = Tr.from(R.bst(R.int(2, 7), 1, 15)); const out = []; Tr.nodes(r).forEach(n => { if (n.left || n.right) out.push(Tr.arr(N(n.val, n.left ? N(n.left.val) : null, n.right ? N(n.right.val) : null))); }); return { trees: R.shuffle(out.length ? out : [[r.val]]) }; },
    s(I, T) { const res = (() => { const trees = I.trees.map(Tr.from), byRoot = new Map(trees.map(t => [t.val, t])), leaves = new Set(); trees.forEach(t => [t.left, t.right].forEach(c => c && leaves.add(c.val))); const cands = trees.filter(t => !leaves.has(t.val)); T.at({ roots: A(trees.map(t => t.val)), leaves: A([...leaves]) }); T.n('Distinct leaf values across all trees?', leaves.size, 'Each one may be replaced by a tree.'); T.n('How many root candidates?', cands.length, 'Roots that are not a leaf elsewhere.'); if (cands.length !== 1) return []; const root = cands[0]; byRoot.delete(root.val); const st = [root]; while (st.length) { const n = st.pop(); for (const d of ['left', 'right']) { const c = n[d]; if (c && byRoot.has(c.val) && !c.left && !c.right) { n[d] = byRoot.get(c.val); byRoot.delete(c.val); } if (n[d]) st.push(n[d]); } } if (byRoot.size) return []; const io = inorder(root).map(n => n.val); return io.every((v, i) => !i || v > io[i - 1]) ? Tr.arr(root) : []; })(); T.yn('Can the trees be merged into one valid BST?', res.length > 0, 'Every tree is used and the inorder is increasing.'); return res; }
  });

  D('count-nodes-equal-to-sum-of-descendants', {
    t: 'Nodes Equal to Sum of Descendants',
    r: 'Post-order: descendants sum = left subtree sum + right subtree sum; compare with the node value.',
    g: R => ({ root: R.tree(R.int(1, 8), 0, 6) }),
    s(I, T) { const root = Tr.from(I.root); let c = 0; const go = n => { if (!n) return 0; const s = go(n.left) + go(n.right); T.at({ tree: TR(root, { hit: n }), count: c }); T.n(`Sum of ${n.val}'s descendants?`, s, 'Left sum + right sum.'); if (s === n.val) c++; return s + n.val; }; go(root); return c; }
  });

  D('smallest-missing-genetic-value-in-each-subtree', {
    t: 'Smallest Missing Genetic Value: only ancestors of the 1',
    r: 'Subtrees without value 1 answer 1. Only the path from the node holding 1 up to the root matters: walk up, adding each new subtree\'s values to a set and advancing the missing pointer.',
    g: R => { const n = R.int(2, 7); return { parents: Array.from({ length: n }, (_, i) => i ? R.int(0, i - 1) : -1), nums: R.distinct(n, 1, n + 2) }; },
    s(I, T) { const n = I.nums.length, ch = Array.from({ length: n }, () => []); I.parents.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); const ans = Array(n).fill(1); let u = I.nums.indexOf(1); const seen = new Set(); let miss = 1, prev = -1; while (u >= 0) { const st = [u]; while (st.length) { const y = st.pop(); seen.add(I.nums[y]); for (const c of ch[y]) if (c !== prev) st.push(c); } while (seen.has(miss)) miss++; ans[u] = miss; T.at({ parents: A(I.parents, { hl: [u] }), values: A([...seen].sort((a, b) => a - b)) }); T.n(`Smallest missing value in the subtree of ${u}?`, miss, 'Advance past values present.'); prev = u; u = I.parents[u]; } return ans; }
  });

  D('subtree-removal-game-with-fibonacci-tree', {
    t: 'Fibonacci Tree Removal Game: n mod 6',
    r: 'The Sprague-Grundy values of Fibonacci trees give a simple pattern: Alice loses exactly when n mod 6 = 1.',
    g: R => ({ n: R.int(1, 30) }),
    s(I, T) { const res = (() => { T.at({ n: I.n }); T.yn('Is n equal to 1?', I.n === 1, 'Then Alice must take the root and loses.'); T.n('Remainder of n divided by 6?', I.n % 6, 'Alice loses only when it is 1.'); return I.n % 6 !== 1; })(); T.yn('Does Alice win?', res, 'Unless the remainder is 1.'); return res; }
  });

  D('count-nodes-with-the-highest-score', {
    t: 'Nodes With the Highest Score: product of the pieces',
    r: 'Removing a node leaves its child subtrees and the rest (n − size). Score = product of non-empty pieces; count nodes achieving the maximum.',
    g: R => { const n = R.int(2, 8), par = [-1], kids = [0]; for (let i = 1; i < n; i++) { let p; do p = R.int(0, i - 1); while (kids[p] >= 2); par.push(p); kids[p]++; kids.push(0); } return { parents: par }; },
    s(I, T) { const n = I.parents.length, ch = Array.from({ length: n }, () => []); I.parents.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); const size = Array(n).fill(1); const go = u => { for (const c of ch[u]) size[u] += go(c); return size[u]; }; go(0); let best = -1n, cnt = 0; for (let u = 0; u < n; u++) { let s = 1n; ch[u].forEach(c => s *= BigInt(size[c])); if (n - size[u] > 0) s *= BigInt(n - size[u]); T.at({ parents: A(I.parents, { hl: [u] }), size: A(size) }); T.n(`Score of node ${u}?`, Number(s), 'Product of the remaining pieces.'); if (s > best) { best = s; cnt = 1; } else if (s === best) cnt++; } return cnt; }
  });

  D('step-by-step-directions-from-a-binary-tree-node-to-another', {
    t: 'Step-by-Step Directions: strip the common prefix',
    r: 'Find root to start and root to dest paths as L or R strings; drop their common prefix. The answer is "U" for each remaining step of the start path, then the rest of the dest path.',
    g: R => { const r = uniq(R, R.int(2, 8)); const v = Tr.nodes(r).map(n => n.val), a = R.pick(v); let b; do b = R.pick(v); while (b === a); return { root: Tr.arr(r), startValue: a, destValue: b }; },
    s(I, T) { const root = Tr.from(I.root); const path = (n, t, p) => { if (!n) return null; if (n.val === t) return p; return path(n.left, t, p + 'L') ?? path(n.right, t, p + 'R'); }; const a = path(root, I.startValue, ''), b = path(root, I.destValue, ''); let i = 0; while (i < a.length && i < b.length && a[i] === b[i]) i++; T.at({ tree: TR(root, { hit: [Tr.find(root, I.startValue), Tr.find(root, I.destValue)] }), toStart: a || '(root)', toDest: b || '(root)' }); T.n('Length of the common prefix?', i, 'Shared steps from the root.'); T.n('Steps up to the common ancestor?', a.length - i, 'Each becomes a U.'); T.n('Steps down to the destination?', b.length - i, 'The rest of the path to dest.'); return 'U'.repeat(a.length - i) + b.slice(i); }
  });

  D('create-binary-tree-from-descriptions', {
    t: 'Create Binary Tree From Descriptions: the root is never a child',
    r: 'Create nodes on demand and link each child to the left or right of its parent. The root is the one value that never appears as a child.',
    g: R => { const r = uniq(R, R.int(2, 7)); const d = []; Tr.nodes(r).forEach(n => { if (n.left) d.push([n.val, n.left.val, 1]); if (n.right) d.push([n.val, n.right.val, 0]); }); return { descriptions: R.shuffle(d) }; },
    s(I, T) { const m = new Map(), kids = new Set(); const get = v => { if (!m.has(v)) m.set(v, N(v)); return m.get(v); }; for (const [p, c, l] of I.descriptions) { get(p)[l ? 'left' : 'right'] = get(c); kids.add(c); } const root = [...m.keys()].find(v => !kids.has(v)); T.at({ descriptions: A(I.descriptions.map(x => `[${x}]`)) }); T.n('Nodes in the tree?', m.size, 'Every value that appears.'); T.n('Left-child links?', I.descriptions.filter(x => x[2] === 1).length, 'Descriptions with isLeft equal to 1.'); T.n('Root value?', root, 'The only parent that is never a child.'); return Tr.arr(m.get(root)); }
  });

  D('root-equals-sum-of-children', {
    t: 'Root Equals Sum of Children',
    r: 'Compare root.val with left.val + right.val.',
    g: R => { const a = R.int(-5, 9), b = R.int(-5, 9); return { root: [R.chance(0.5) ? a + b : R.int(-9, 18), a, b] }; },
    s(I, T) { const res = (() => { const [r, a, b] = I.root; T.at({ tree: TR(Tr.from(I.root)) }); T.n('Sum of the children?', a + b, `${a} + ${b}.`); T.n('Root minus that sum?', r - (a + b), 'Zero means they are equal.'); return r === a + b; })(); T.yn('Does the root equal the sum of its children?', res, 'Compare them.'); return res; }
  });

  D('count-nodes-equal-to-average-of-subtree', {
    t: 'Nodes Equal to Average of Subtree: (sum, count) upward',
    r: 'Post-order returns subtree sum and size; a node counts if sum divided by size, rounded down equals its value.',
    g: R => ({ root: R.tree(R.int(1, 8), 0, 6) }),
    s(I, T) { const root = Tr.from(I.root); let c = 0; const go = n => { if (!n) return [0, 0]; const a = go(n.left), b = go(n.right), s = n.val + a[0] + b[0], k = 1 + a[1] + b[1]; T.at({ tree: TR(root, { hit: n }), count: c }); T.n(`Floor average of the subtree at ${n.val}?`, Math.floor(s / k), `${s} divided by ${k}.`); if (Math.floor(s / k) === n.val) c++; return [s, k]; }; go(root); return c; }
  });

  D('closest-node-to-path-in-tree', {
    t: 'Closest Node to Path: mark the path, BFS from the node',
    r: 'For each query, find the start to end path (BFS parents), then BFS from node until you reach a path vertex.',
    g: R => { const n = R.int(2, 7); return { n, edges: treeEdges(R, n, 0), query: Array.from({ length: R.int(1, 3) }, () => [R.int(0, n - 1), R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const g = adjOf(I.n, I.edges, 0); const bfs = s => { const par = Array(I.n).fill(-2), d = Array(I.n).fill(-1), q = [s]; par[s] = -1; d[s] = 0; while (q.length) { const u = q.shift(); for (const v of g[u]) if (d[v] < 0) { d[v] = d[u] + 1; par[v] = u; q.push(v); } } return [par, d]; }; return I.query.map(([a, b, x]) => { const [par] = bfs(a), path = new Set(); for (let u = b; u !== -1; u = par[u]) path.add(u); const [, dx] = bfs(x); let best = -1; for (const u of path) if (best < 0 || dx[u] < dx[best]) best = u; T.at({ graph: GR(I.n, I.edges, { cls: Object.fromEntries([...path].map(u => [u, 'ok']).concat([[x, 'hit']])) }) }); T.n(`Closest path node to ${x} (path ${a} to ${b})?`, best, 'First path vertex reached by BFS.'); return best; }); }
  });

  D('minimum-flips-in-binary-tree-to-get-result', {
    t: 'Minimum Flips for a Boolean Tree Result: (cost false, cost true)',
    r: 'Each node returns the cheapest flips to make it false and to make it true. Leaves: 0 or 1. OR, AND, XOR and NOT combine the children\'s pairs.',
    g: R => { const mk = d => { if (d >= 3 || R.chance(0.3)) return N(R.int(0, 1)); const op = R.int(2, 5); if (op === 5) return R.chance(0.5) ? N(5, mk(d + 1)) : N(5, null, mk(d + 1)); return N(op, mk(d + 1), mk(d + 1)); }; return { root: Tr.arr(mk(1)), result: R.chance(0.5) }; },
    s(I, T) { const root = Tr.from(I.root), nm = { 2: 'OR', 3: 'AND', 4: 'XOR', 5: 'NOT' }; const go = n => { if (n.val < 2) return [n.val === 0 ? 0 : 1, n.val === 1 ? 0 : 1]; let res; if (n.val === 5) { const [f, t] = go(n.left || n.right); res = [t, f]; } else { const [fl, tl] = go(n.left), [fr, tr] = go(n.right); if (n.val === 2) res = [fl + fr, Math.min(tl + tr, tl + fr, fl + tr)]; else if (n.val === 3) res = [Math.min(fl + fr, fl + tr, tl + fr), tl + tr]; else res = [Math.min(fl + fr, tl + tr), Math.min(tl + fr, fl + tr)]; } T.at({ tree: TR(root, { hit: n }) }); T.n(`Flips to make this ${nm[n.val]} node true?`, res[1], 'Combine the children\'s (false, true) costs.'); return res; }; return go(root)[I.result ? 1 : 0]; }
  });
})();
