/* v2 games: trees (05). */
(function () {
  'use strict';
  const { D, A, G, K, X, Tr, TR, GR } = LCGame.H;
  const N = (v, l, r) => ({ val: v, left: l || null, right: r || null });
  const inorder = (r, out = []) => { if (r) { inorder(r.left, out); out.push(r); inorder(r.right, out); } return out; };
  const leaf = n => !n.left && !n.right;
  const uniq = (R, n, maxD) => { const r = Tr.from(R.tree(n, 1, 9, maxD || 4)); const v = R.shuffle(Tr.nodes(r).map((_, i) => i + 1)); Tr.nodes(r).forEach((x, i) => x.val = v[i]); return r; };
  const treeEdges = (R, n, base) => Array.from({ length: n - 1 }, (_, i) => [R.int(0, i) + base, i + 1 + base]);
  const adjOf = (n, edges, base) => { const g = Array.from({ length: n + (base || 0) }, () => []); edges.forEach(([a, b]) => { g[a].push(b); g[b].push(a); }); return g; };
  const nOf = edges => edges.length + 1;
  const parOf = (n, g, root) => { const par = Array(n).fill(-1), order = [root], seen = Array(n).fill(false); seen[root] = true; for (let i = 0; i < order.length; i++) for (const v of g[order[i]]) if (!seen[v]) { seen[v] = true; par[v] = order[i]; order.push(v); } return [par, order]; };
  const bfsDist = (g, s) => { const d = Array(g.length).fill(-1), q = [s]; d[s] = 0; while (q.length) { const u = q.shift(); for (const v of g[u]) if (d[v] < 0) { d[v] = d[u] + 1; q.push(v); } } return d; };
  const isPrime = x => { if (x < 2) return false; for (let p = 2; p * p <= x; p++) if (x % p === 0) return false; return true; };

  D('minimum-score-after-removals-on-a-tree', {
    t: 'Minimum Score After Two Removals: subtree XORs',
    r: 'Root the tree; compute every subtree XOR. Removing edges above u and v gives components whose XORs depend on whether one subtree contains the other. Try every pair.',
    g: R => { const n = R.int(3, 7); return { nums: R.ints(n, 1, 15), edges: treeEdges(R, n, 0) }; },
    s(I, T) { const res = (() => { const n = I.nums.length, g = adjOf(n, I.edges), [par, order] = parOf(n, g, 0), x = I.nums.slice(); for (let i = n - 1; i > 0; i--) x[par[order[i]]] ^= x[order[i]]; const anc = (a, b) => { for (let y = b; y >= 0; y = par[y]) if (y === a) return true; return false; }; T.at({ graph: GR(n, I.edges), subtreeXor: A(x) }); T.n('XOR of the whole tree?', x[0], 'Root subtree XOR.'); T.n('Edges to choose from?', n - 1, 'Pick two to remove.'); let best = Infinity; for (let a = 1; a < n; a++) for (let b = a + 1; b < n; b++) { let p, q, r; if (anc(a, b)) { p = x[b]; q = x[a] ^ x[b]; r = x[0] ^ x[a]; } else if (anc(b, a)) { p = x[a]; q = x[b] ^ x[a]; r = x[0] ^ x[b]; } else { p = x[a]; q = x[b]; r = x[0] ^ x[a] ^ x[b]; } best = Math.min(best, Math.max(p, q, r) - Math.min(p, q, r)); } return best; })(); T.n('Minimum score?', res, 'Best over every pair of removed edges.'); return res; }
  });

  D('evaluate-boolean-binary-tree', {
    t: 'Evaluate Boolean Binary Tree',
    r: 'Leaves are 0-1. Node 2 is OR and node 3 is AND of its two children.',
    g: R => { const mk = d => d >= 3 || R.chance(0.35) ? N(R.int(0, 1)) : N(R.int(2, 3), mk(d + 1), mk(d + 1)); return { root: Tr.arr(mk(1)) }; },
    s(I, T) { const root = Tr.from(I.root); const go = n => { if (leaf(n)) return n.val === 1; const a = go(n.left), b = go(n.right), v = n.val === 2 ? a || b : a && b; T.at({ tree: TR(root, { hit: n }) }); T.yn(`Value of this ${n.val === 2 ? 'OR' : 'AND'} node?`, v, `${a} ${n.val === 2 ? 'OR' : 'AND'} ${b}.`); return v; }; return go(root); }
  });

  D('choose-edges-to-maximize-score-in-a-tree', {
    t: 'Choose Non-Adjacent Edges: matching DP on a tree',
    r: 'For each node: free(u) = the sum of best(children) (no edge to a child used); best(u) = max(free(u), free(u) − best(c) + free(c) + w(c)) over children c.',
    g: R => { const n = R.int(1, 7); return { edges: Array.from({ length: n }, (_, i) => i ? [R.int(0, i - 1), R.int(-3, 9)] : [-1, -1]) }; },
    s(I, T) { const n = I.edges.length, ch = Array.from({ length: n }, () => []); I.edges.forEach(([p], i) => { if (i) ch[p].push(i); }); const go = u => { let free = 0; const sub = ch[u].map(c => { const r = go(c); free += r[1]; return [c, r]; }); let best = free; for (const [c, [fc, bc]] of sub) best = Math.max(best, free - bc + fc + I.edges[c][1]); if (ch[u].length) { T.at({ parent: A(I.edges.map(e => e[0]), { hl: [u] }), weight: A(I.edges.map(e => e[1])) }); T.n(`Best score in the subtree of ${u}?`, best, 'Free sum, or swap in one child edge.'); } return [free, best]; }; return go(0)[1]; }
  });

  D('amount-of-time-for-binary-tree-to-be-infected', {
    t: 'Time for Infection to Spread: farthest node from start',
    r: 'Treat the tree as an undirected graph (add parent links) and BFS from start; the answer is the largest distance.',
    g: R => { const r = uniq(R, R.int(1, 9)); return { root: Tr.arr(r), start: R.pick(Tr.nodes(r)).val }; },
    s(I, T) { const root = Tr.from(I.root), par = new Map(); Tr.nodes(root).forEach(n => { if (n.left) par.set(n.left, n); if (n.right) par.set(n.right, n); }); let lv = [Tr.find(root, I.start)], t = 0; const seen = new Set(lv); for (;;) { const nx = lv.flatMap(n => [n.left, n.right, par.get(n)].filter(x => x && !seen.has(x))); if (!nx.length) return t; nx.forEach(x => seen.add(x)); t++; T.at({ tree: TR(root, { hit: nx, ok: [...seen].filter(x => !nx.includes(x)) }) }); T.n(`Nodes newly infected at minute ${t}?`, nx.length, 'Neighbors of the infected frontier.'); lv = nx; } }
  });

  D('reverse-odd-levels-of-binary-tree', {
    t: 'Reverse Odd Levels: swap mirrored values',
    r: 'Walk the tree in mirrored pairs (left.left with right.right, left.right with right.left); at odd levels, swap the pair\'s values.',
    g: R => ({ root: Array.from({ length: 2 ** R.int(1, 4) - 1 }, () => R.int(0, 30)) }),
    s(I, T) { const res = (() => { const root = Tr.from(I.root); let lv = [root], d = 0; while (lv.length) { if (d % 2) { const v = lv.map(n => n.val).reverse(); lv.forEach((n, i) => n.val = v[i]); T.at({ tree: TR(root, { hit: lv }) }); T.n(`First value on level ${d} after reversing?`, v[0], 'It was the last one.'); } lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); d++; } return Tr.arr(root); })(); const L = Math.round(Math.log2(res.length + 1)); T.n('Levels reversed?', Math.floor(L / 2), 'Levels 1, 3, 5 and so on.'); return res; }
  });

  D('create-components-with-same-value', {
    t: 'Components With the Same Value: try each component count',
    r: 'If there are c components each summing to total divided by c, then a DFS that cuts whenever a subtree sum reaches the target must succeed. Try c from n down; answer = c − 1 edges.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 3), edges: treeEdges(R, n, 0) }; },
    s(I, T) { const n = I.nums.length, g = adjOf(n, I.edges), tot = I.nums.reduce((a, b) => a + b, 0); for (let c = n; c >= 1; c--) { if (tot % c) continue; const t = tot / c; let ok = true; const go = (u, p) => { let s = I.nums[u]; for (const v of g[u]) if (v !== p) s += go(v, u); if (s > t) ok = false; return s === t ? 0 : s; }; const rest = go(0, -1); ok = ok && rest === 0; T.at({ graph: GR(n, I.edges, { tag: Object.fromEntries(I.nums.map((x, i) => [i, String(x)])) }), target: t }); T.yn(`Can the tree split into ${c} parts of sum ${t}?`, ok, 'Cut whenever a subtree reaches the target.'); if (ok) return c - 1; } return 0; }
  });

  D('number-of-nodes-with-value-one', {
    t: 'Nodes With Value One: flip parity from ancestors',
    r: 'Each query flips a whole subtree. A node ends at 1 exactly when the number of flips on itself and its ancestors (v, v divided by 2, …) is odd. Count flips per label, then push parity down.',
    g: R => { const n = R.int(1, 10); return { n, queries: R.ints(R.int(1, 5), 1, n) }; },
    s(I, T) { const f = Array(I.n + 1).fill(0); I.queries.forEach(q => f[q] ^= 1); const val = Array(I.n + 1).fill(0); let c = 0; for (let v = 1; v <= I.n; v++) { val[v] = f[v] ^ (v > 1 ? val[v >> 1] : 0); if (v <= 7) { T.at({ flips: A(f.slice(1)), values: A(val.slice(1, v + 1)) }); T.n(`Final value of node ${v}?`, val[v], 'Own flip parity XOR its parent\'s value.'); } c += val[v]; } return c; }
  });

  D('height-of-binary-tree-after-subtree-removal-queries', {
    t: 'Height After Subtree Removal: best other node on the same level',
    r: 'For each node record depth + height below it. Removing q leaves the best such value among other nodes at q\'s depth, or depth − 1 if q was alone.',
    g: R => { const r = uniq(R, R.int(2, 9)); return { root: Tr.arr(r), queries: R.distinct(R.int(1, 3), 2, Tr.size(r)) }; },
    s(I, T) { const root = Tr.from(I.root), dep = new Map(), ht = new Map(), lv = new Map(); const h = (n, d) => { if (!n) return -1; dep.set(n, d); const x = 1 + Math.max(h(n.left, d + 1), h(n.right, d + 1)); ht.set(n, x); (lv.get(d) || lv.set(d, []).get(d)).push(n); return x; }; h(root, 0); return I.queries.map(q => { const node = Tr.find(root, q), d = dep.get(node); let best = d - 1; for (const m of lv.get(d)) if (m !== node) best = Math.max(best, d + ht.get(m)); T.at({ tree: TR(root, { hit: node, dim: lv.get(d).filter(m => m !== node) }) }); T.n(`Height after removing ${q}?`, best, 'Best depth + height among the other nodes on its level.'); return best; }); }
  });

  D('minimum-number-of-operations-to-sort-a-binary-tree-by-level', {
    t: 'Sort Each Level: swaps = size − cycles',
    r: 'For each level, map every value to its sorted position; the minimum number of swaps is the level size minus the number of permutation cycles.',
    g: R => ({ root: Tr.arr(uniq(R, R.int(1, 9))) }),
    s(I, T) { const root = Tr.from(I.root); let lv = [root], tot = 0; while (lv.length) { const v = lv.map(n => n.val), s = v.slice().sort((a, b) => a - b), pos = new Map(s.map((x, i) => [x, i])), seen = Array(v.length).fill(false); let cyc = 0; for (let i = 0; i < v.length; i++) if (!seen[i]) { cyc++; let j = i; while (!seen[j]) { seen[j] = true; j = pos.get(v[j]); } } if (v.length > 1) { T.at({ level: A(v), sorted: A(s) }); T.n('Swaps needed for this level?', v.length - cyc, `${v.length} values − ${cyc} cycles.`); } tot += v.length - cyc; lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); } return tot; }
  });

  D('closest-nodes-queries-in-a-binary-search-tree', {
    t: 'Closest Nodes Queries: binary search the inorder list',
    r: 'Inorder gives a sorted list. For each query, the floor is the largest value at most q and the ceiling the smallest value at least q (−1 if missing).',
    g: R => ({ root: R.bst(R.int(2, 7), 1, 20), queries: R.ints(R.int(1, 3), 0, 22) }),
    s(I, T) { const v = inorder(Tr.from(I.root)).map(n => n.val); return I.queries.map(q => { let lo = -1, hi = -1; for (const x of v) { if (x <= q) lo = x; if (x >= q && hi < 0) hi = x; } T.at({ sorted: A(v), query: q }); T.n(`Largest value at most ${q} (−1 if none)?`, lo, 'Floor in the sorted list.'); T.n(`Smallest value at least ${q} (−1 if none)?`, hi, 'Ceiling in the sorted list.'); return [lo, hi]; }); }
  });

  D('cycle-length-queries-in-a-tree', {
    t: 'Cycle Length Queries: climb the larger label',
    r: 'In a heap-numbered tree the parent of v is half of v, rounded down. Repeatedly move the larger of a, b up until they meet; the cycle length is the steps + 1 (the new edge).',
    g: R => { const n = R.int(2, 4), m = 2 ** n - 1; return { n, queries: Array.from({ length: R.int(1, 3) }, () => { const a = R.int(1, m); let b; do b = R.int(1, m); while (b === a); return [a, b]; }) }; },
    s(I, T) { return I.queries.map(([a, b]) => { T.at({ a, b }); let s = 0; while (a !== b) { if (a > b) a >>= 1; else b >>= 1; s++; } T.at({ meet: a }); T.n('Steps until they meet?', s, 'Move the larger label to its parent.'); return s + 1; }); }
  });

  D('difference-between-maximum-and-minimum-price-sum', {
    t: 'Max − Min Price Sum: best path from each root',
    r: 'From a root, the minimum price path is the root alone; the maximum is the heaviest root-to-node path. Cost = max path sum − root price. Try every root (rerooting makes this O(n)).',
    g: R => { const n = R.int(1, 6); return { n, edges: treeEdges(R, n, 0), price: R.ints(n, 1, 9) }; },
    s(I, T) { const g = adjOf(I.n, I.edges); let best = 0; for (let r = 0; r < I.n; r++) { const go = (u, p) => I.price[u] + Math.max(0, ...g[u].filter(v => v !== p).map(v => go(v, u))); const c = go(r, -1) - I.price[r]; T.at({ graph: GR(I.n, I.edges, { cls: { [r]: 'hit' }, tag: Object.fromEntries(I.price.map((x, i) => [i, String(x)])) }) }); T.n(`Cost when rooted at ${r}?`, c, 'Heaviest path from the root minus the root price.'); best = Math.max(best, c); } return best; }
  });

  D('count-number-of-possible-root-nodes', {
    t: 'Count Possible Roots: reroot the correct-guess count',
    r: 'Count correct guesses (parent, child) with root 0. Moving the root from u to child v: guess (u, v) stops being correct, guess (v, u) becomes correct.',
    g: R => { const n = R.int(2, 7), e = treeEdges(R, n, 0); return { edges: e, guesses: R.shuffle(e).slice(0, R.int(1, n - 1)).map(x => R.chance(0.5) ? x : [x[1], x[0]]), k: R.int(0, n - 1) }; },
    s(I, T) { const n = nOf(I.edges), g = adjOf(n, I.edges), gs = new Set(I.guesses.map(x => x[0] + ',' + x[1])); const [par, order] = parOf(n, g, 0); let c0 = 0; for (let v = 1; v < n; v++) if (gs.has(par[v] + ',' + v)) c0++; const cnt = Array(n).fill(0); cnt[0] = c0; for (const u of order) for (const v of g[u]) if (par[v] === u) cnt[v] = cnt[u] - (gs.has(u + ',' + v) ? 1 : 0) + (gs.has(v + ',' + u) ? 1 : 0); T.at({ graph: GR(n, I.edges), guesses: A(I.guesses.map(x => `${x[0]} to ${x[1]}`)) }); T.n('Correct guesses with root 0?', c0, 'Guesses matching (parent, child).'); for (const v of order.slice(1, 5)) { T.at({ graph: GR(n, I.edges, { cls: { [v]: 'hit' } }) }); T.n(`Correct guesses with root ${v}?`, cnt[v], 'Adjust only the edge to its parent.'); } return cnt.filter(x => x >= I.k).length; }
  });

  D('kth-largest-sum-in-a-binary-tree', {
    t: 'Kth Largest Level Sum',
    r: 'BFS level sums, sort descending, return the kth (−1 if there are fewer levels).',
    g: R => ({ root: R.tree(R.int(2, 9)), k: R.int(1, 4) }),
    s(I, T) { const root = Tr.from(I.root), s = []; let lv = [root]; while (lv.length) { const x = lv.reduce((a, n) => a + n.val, 0); T.at({ tree: TR(root, { hit: lv }) }); T.n(`Sum of level ${s.length + 1}?`, x, 'Add the level.'); s.push(x); lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); } s.sort((a, b) => b - a); return I.k <= s.length ? s[I.k - 1] : -1; }
  });

  D('cousins-in-binary-tree-ii', {
    t: 'Cousins in Binary Tree II: level sum minus siblings',
    r: 'For each level, a node\'s cousin sum = level sum − (its own value + its sibling\'s value).',
    g: R => ({ root: R.tree(R.int(1, 9)) }),
    s(I, T) { const root = Tr.from(I.root); root.val = 0; let lv = [root]; while (lv.length) { const nx = lv.flatMap(n => [n.left, n.right].filter(Boolean)), s = nx.reduce((a, n) => a + n.val, 0); for (const p of lv) { const sib = (p.left ? p.left.val : 0) + (p.right ? p.right.val : 0); for (const c of [p.left, p.right]) if (c) { c.nv = s - sib; } if (p.left || p.right) { T.at({ level: A(nx.map(n => n.val)), parent: p === root ? 'root' : '—' }); T.n('Cousin sum for these siblings?', s - sib, `Level sum ${s} − siblings ${sib}.`); } } nx.forEach(n => { n.val = n.nv; delete n.nv; }); lv = nx; } return Tr.arr(root); }
  });

  D('make-costs-of-paths-equal-in-a-binary-tree', {
    t: 'Make Path Costs Equal: fix siblings bottom-up',
    r: 'From the bottom, two sibling paths must be equal: add |left − right| increments, then pass the larger path cost up to the parent.',
    g: R => { const n = 2 ** R.int(2, 3) - 1; return { n, cost: R.ints(n, 1, 9) }; },
    s(I, T) { const n = I.n, c = I.cost.slice(); let ans = 0; for (let i = n >> 1; i >= 1; i--) { const l = c[2 * i - 1], r = c[2 * i]; T.at({ cost: A(c, { hl: [2 * i - 1, 2 * i] }) }); T.n(`Increments to equalize the children of node ${i}?`, Math.abs(l - r), `|${l} − ${r}|.`); ans += Math.abs(l - r); c[i - 1] += Math.max(l, r); } return ans; }
  });

  D('extract-kth-character-from-the-rope-tree', {
    t: 'Kth Character of a Rope Tree: skip by lengths',
    r: 'At an internal node, compare k with the left part\'s length (len of an internal child, or the string length of a leaf); go left or subtract and go right.',
    g: R => { const mk = d => { if (d >= 3 || R.chance(0.35)) return N(R.str(R.int(1, 4), 'abcd')); const l = mk(d + 1), r = R.chance(0.8) ? mk(d + 1) : null; const L = x => x ? (typeof x.val === 'string' ? x.val.length : x.val) : 0; return N(L(l) + L(r), l, r); }; const r = mk(1); const L = typeof r.val === 'string' ? r.val.length : r.val; return { root: Tr.arr(r), k: R.int(1, L) }; },
    s(I, T) { const res = (() => { const root = Tr.from(I.root), len = x => !x ? 0 : typeof x.val === 'string' ? x.val.length : x.val; let n = root, k = I.k; T.at({ tree: TR(root), k }); T.n('Total length of the string?', len(root), 'The root stores it.'); while (typeof n.val !== 'string') { const L = len(n.left); T.at({ tree: TR(root, { hit: n }), k }); T.c('Which side holds the character?', ['left', 'right'], k <= L ? 'left' : 'right', `Left part has ${L} characters.`); if (k <= L) n = n.left; else { k -= L; n = n.right; } } return n.val[k - 1]; })(); const ch = [...new Set(I.root.filter(v => typeof v === 'string').join(''))]; T.c('The kth character?', [...new Set([res, ...ch, 'a', 'b'])], res, 'Read it from the leaf you reached.'); return res; }
  });

  D('is-array-a-preorder-of-some-binary-tree', {
    t: 'Is Array a Preorder: stack of the current path',
    r: 'Keep the root-to-current path on a stack. For each next node, pop until the top is its parent; if the stack empties first, it is not a preorder.',
    g: R => { const r = uniq(R, R.int(1, 7)); const out = []; const go = (n, p) => { if (!n) return; out.push([n.val, p]); go(n.left, n.val); go(n.right, n.val); }; go(r, -1); if (R.chance(0.4) && out.length > 2) { const i = R.int(1, out.length - 1), j = R.int(1, out.length - 1); [out[i], out[j]] = [out[j], out[i]]; } return { nodes: out }; },
    s(I, T) { const st = [I.nodes[0][0]]; for (let i = 1; i < I.nodes.length; i++) { const [v, p] = I.nodes[i]; while (st.length && st[st.length - 1] !== p) st.pop(); T.at({ nodes: A(I.nodes.map(x => `${x[0]}, parent ${x[1]}`), { hl: [i] }), stack: A(st) }); T.yn(`Is parent ${p} on the current path?`, st.length > 0, 'Pop until the top is the parent.'); if (!st.length) return false; st.push(v); } return true; }
  });

  D('height-of-special-binary-tree', {
    t: 'Height of Special Binary Tree: ignore the leaf ring',
    r: 'Leaves are linked in a cycle through their left or right pointers. Treat a child as real only if it does not point back to the node (child.right not equal to node); then compute the height.',
    g: R => ({ root: R.tree(R.int(2, 9)) }),
    s(I, T) { const root = Tr.from(I.root); const h = n => { if (leaf(n)) return 0; const x = 1 + Math.max(n.left ? h(n.left) : 0, n.right ? h(n.right) : 0); T.at({ tree: TR(root, { hit: n }) }); T.n(`Height below ${n.val}?`, x, '1 + taller real child.'); return x; }; return h(root); }
  });

  D('count-paths-that-can-form-a-palindrome-in-a-tree', {
    t: 'Paths That Can Form a Palindrome: XOR masks from the root',
    r: 'mask(u) = XOR of letter bits on the root to u path. Path u to v has parity mask(u) ^ mask(v): it works if that has at most one bit. Count with a map of masks seen so far.',
    g: R => { const n = R.int(1, 7); return { parent: Array.from({ length: n }, (_, i) => i ? R.int(0, i - 1) : -1), s: R.str(n, 'ab') }; },
    s(I, T) { const n = I.parent.length, m = Array(n).fill(0); for (let i = 1; i < n; i++) m[i] = m[I.parent[i]] ^ (1 << (I.s.charCodeAt(i) - 97)); const seen = new Map(); let c = 0; for (let u = 0; u < n; u++) { let k = seen.get(m[u]) || 0; for (let b = 0; b < 26; b++) k += seen.get(m[u] ^ (1 << b)) || 0; T.at({ masks: A(m.map(x => x.toString(2)), { hl: [u] }) }); T.n(`Palindrome partners for node ${u} among earlier nodes?`, k, 'Equal mask or one bit different.'); c += k; seen.set(m[u], (seen.get(m[u]) || 0) + 1); } return c; }
  });

  D('count-nodes-that-are-great-enough', {
    t: 'Nodes That Are Great Enough: k smallest per subtree',
    r: 'Each node keeps the k smallest values of its subtree (merge children, add itself). It is great enough if the subtree has at least k nodes and its value exceeds the k-th smallest.',
    g: R => ({ root: R.tree(R.int(1, 8), 1, 9), k: R.int(1, 3) }),
    s(I, T) { const root = Tr.from(I.root); let c = 0; const go = n => { if (!n) return []; const s = [...go(n.left), ...go(n.right)].sort((a, b) => a - b).slice(0, I.k); const ok = s.length >= I.k && n.val > s[I.k - 1]; T.at({ tree: TR(root, { hit: n }), smallest: A(s) }); T.yn(`Is ${n.val} great enough?`, ok, `Needs at least ${I.k} smaller values below it.`); if (ok) c++; return [...s, n.val].sort((a, b) => a - b).slice(0, I.k); }; go(root); return c; }
  });

  D('count-valid-paths-in-a-tree', {
    t: 'Count Valid Paths: exactly one prime label',
    r: 'Group non-prime nodes into connected components. For each prime p, combine sizes of neighboring non-prime components: paths ending at p plus pairs across different components. (Here checked over all pairs.)',
    g: R => { const n = R.int(1, 8); return { n, edges: treeEdges(R, n, 1) }; },
    s(I, T) { const g = adjOf(I.n, I.edges, 1); let c = 0; for (let a = 1; a <= I.n; a++) { const par = Array(I.n + 1).fill(0), q = [a]; par[a] = -1; while (q.length) { const u = q.shift(); for (const v of g[u]) if (!par[v]) { par[v] = u; q.push(v); } } let here = 0; for (let b = a + 1; b <= I.n; b++) { let p = 0; for (let x = b; x !== -1; x = par[x]) if (isPrime(x)) p++; if (p === 1) here++; } if (I.n <= 6 || a <= 4) { T.at({ graph: GR(I.n, I.edges, { base: 1, cls: Object.fromEntries([...Array(I.n).keys()].map(i => i + 1).filter(isPrime).map(x => [x, 'ok']).concat([[a, 'hit']])) }) }); T.n(`Valid paths from ${a} to larger labels?`, here, 'Exactly one prime on the path.'); } c += here; } return c; }
  });

  D('maximum-number-of-k-divisible-components', {
    t: 'Maximum k-Divisible Components: cut divisible subtrees',
    r: 'DFS: whenever a subtree sum is divisible by k, cut it off (one more component) and report 0 upward.',
    g: R => { const n = R.int(1, 7), v = R.ints(n, 0, 6), k = R.int(1, 4), tot = v.reduce((a, b) => a + b, 0); v[0] += (k - tot % k) % k; return { n, edges: treeEdges(R, n, 0), values: v, k }; },
    s(I, T) { const g = adjOf(I.n, I.edges); let c = 0; const go = (u, p) => { let s = I.values[u]; for (const v of g[u]) if (v !== p) s += go(v, u); T.at({ graph: GR(I.n, I.edges, { cls: { [u]: 'hit' }, tag: Object.fromEntries(I.values.map((x, i) => [i, String(x)])) }), components: c }); T.yn(`Is the subtree sum at ${u} (${s}) divisible by ${I.k}?`, s % I.k === 0, 'Then cut it off.'); if (s % I.k === 0) { c++; return 0; } return s; }; go(0, -1); return c; }
  });

  D('maximum-points-after-collecting-coins-from-all-nodes', {
    t: 'Collect Coins: subtract k or halve the subtree',
    r: 'dp(u, j) where j = halvings applied by ancestors (coins become coins >> j). Option 1: (coins >> j) − k + the sum of dp(c, j). Option 2: (coins >> (j+1)) + the sum of dp(c, j+1). After ~14 halvings everything is 0.',
    g: R => { const n = R.int(2, 6); return { edges: treeEdges(R, n, 0), coins: R.ints(n, 0, 20), k: R.int(0, 6) }; },
    s(I, T) { const n = I.coins.length, g = adjOf(n, I.edges), memo = new Map(); const go = (u, p, j) => { if (j > 14) return 0; const key = u * 20 + j; if (memo.has(key)) return memo.get(key); let a = (I.coins[u] >> j) - I.k, b = I.coins[u] >> (j + 1); for (const v of g[u]) if (v !== p) { a += go(v, u, j); b += go(v, u, j + 1); } const r = Math.max(a, b); memo.set(key, r); if (j === 0) { T.at({ graph: GR(n, I.edges, { cls: { [u]: 'hit' }, tag: Object.fromEntries(I.coins.map((x, i) => [i, String(x)])) }) }); T.n(`Best points in the subtree of ${u} with no halvings yet?`, r, 'max(subtract k, halve).'); } return r; }; return go(0, -1, 0); }
  });

  D('maximum-score-after-applying-operations-on-a-tree', {
    t: 'Maximum Score Keeping the Tree Healthy',
    r: 'Take everything except what must stay. keep(u) = values[u] for a leaf, else min(values[u], the sum of keep(children)). Answer = total − keep(root).',
    g: R => { const n = R.int(2, 7); return { edges: treeEdges(R, n, 0), values: R.ints(n, 1, 9) }; },
    s(I, T) { const n = I.values.length, g = adjOf(n, I.edges), tot = I.values.reduce((a, b) => a + b, 0); const go = (u, p) => { const ch = g[u].filter(v => v !== p); if (!ch.length) return I.values[u]; const s = ch.reduce((a, v) => a + go(v, u), 0), k = Math.min(I.values[u], s); T.at({ graph: GR(n, I.edges, { cls: { [u]: 'hit' }, tag: Object.fromEntries(I.values.map((x, i) => [i, String(x)])) }) }); T.n(`Minimum value that must stay in the subtree of ${u}?`, k, 'Keep this node, or keep enough below.'); return k; }; return tot - go(0, -1); }
  });

  D('find-number-of-coins-to-place-in-tree-nodes', {
    t: 'Coins to Place: best product of three in the subtree',
    r: 'For each subtree with at least 3 nodes, the best product of three costs uses the 3 largest or the 2 smallest times the largest; negative: 0. Smaller subtrees get 1.',
    g: R => { const n = R.int(2, 7); return { edges: treeEdges(R, n, 0), cost: Array.from({ length: n }, () => R.int(-6, 9) || 1) }; },
    s(I, T) { const res = (() => { const n = I.cost.length, g = adjOf(n, I.edges), ans = Array(n).fill(1); const go = (u, p) => { let all = [I.cost[u]]; for (const v of g[u]) if (v !== p) all = all.concat(go(v, u)); all.sort((a, b) => a - b); if (all.length >= 3) { const m = all.length, best = Math.max(all[m - 1] * all[m - 2] * all[m - 3], all[0] * all[1] * all[m - 1]); ans[u] = Math.max(0, best); T.at({ graph: GR(n, I.edges, { cls: { [u]: 'hit' } }), values: A(all) }); T.n(`Coins at node ${u}?`, ans[u], 'The larger of the top 3 product and the two smallest times the largest, or 0.'); } return all.length > 5 ? [...all.slice(0, 2), ...all.slice(-3)] : all; }; go(0, -1); return ans; })(); T.n('Nodes with exactly 1 coin?', res.filter(x => x === 1).length, 'Subtrees with fewer than 3 nodes.'); return res; }
  });

  D('maximum-subtree-of-the-same-color', {
    t: 'Maximum Same-Color Subtree',
    r: 'Post-order: a subtree is single-colored if every child subtree is and has the same color as the node; track its size.',
    g: R => { const n = R.int(1, 7); return { edges: treeEdges(R, n, 0), colors: R.ints(n, 1, 2) }; },
    s(I, T) { const n = I.colors.length, g = adjOf(n, I.edges); let best = 1; const go = (u, p) => { let ok = true, sz = 1; for (const v of g[u]) if (v !== p) { const [o, s] = go(v, u); sz += s; if (!o || I.colors[v] !== I.colors[u]) ok = false; } T.at({ graph: GR(n, I.edges, { cls: { [u]: 'hit' }, tag: Object.fromEntries(I.colors.map((x, i) => [i, String(x)])) }) }); T.yn(`Is the subtree of ${u} one color?`, ok, 'All children one color and equal to it.'); if (ok) best = Math.max(best, sz); return [ok, sz]; }; go(0, -1); return best; }
  });

  D('count-pairs-of-connectable-servers-in-a-weighted-tree-network', {
    t: 'Connectable Server Pairs: branch counts per center',
    r: 'For each center c, count servers in each neighbor branch whose distance from c is divisible by signalSpeed. Pairs across different branches: the sum over branches of count times (total so far).',
    g: R => { const n = R.int(2, 7); return { edges: treeEdges(R, n, 0).map(e => [...e, R.int(1, 4)]), signalSpeed: R.int(1, 3) }; },
    s(I, T) { const n = nOf(I.edges), g = Array.from({ length: n }, () => []); I.edges.forEach(([a, b, w]) => { g[a].push([b, w]); g[b].push([a, w]); }); const ans = Array(n).fill(0); for (let c = 0; c < n; c++) { let acc = 0, pairs = 0; for (const [v, w] of g[c]) { let k = 0; const st = [[v, c, w]]; while (st.length) { const [u, p, d] = st.pop(); if (d % I.signalSpeed === 0) k++; for (const [x, ww] of g[u]) if (x !== p) st.push([x, u, d + ww]); } pairs += k * acc; acc += k; } ans[c] = pairs; T.at({ graph: GR(n, I.edges.map(e => e.slice(0, 2)), { cls: { [c]: 'hit' } }) }); T.n(`Connectable pairs through server ${c}?`, pairs, 'Pairs from different branches.'); } return ans; }
  });

  D('find-the-maximum-sum-of-node-values', {
    t: 'Maximum Sum of Node Values: XOR any even count',
    r: 'Operations along tree paths let you XOR any even number of nodes with k. Take max(x, x ^ k) for each; if an odd number benefit, give up the smallest |gain|.',
    g: R => { const n = R.int(2, 6); return { nums: R.ints(n, 0, 15), k: R.int(1, 15), edges: treeEdges(R, n, 0) }; },
    s(I, T) { let s = 0, cnt = 0, mn = Infinity; I.nums.forEach((x, i) => { const y = x ^ I.k; s += Math.max(x, y); if (y > x) cnt++; mn = Math.min(mn, Math.abs(y - x)); T.at({ nums: A(I.nums, { hl: [i] }), k: I.k }); T.yn(`Does XOR-ing ${x} with k help?`, y > x, `${x} ^ ${I.k} = ${y}.`); }); return cnt % 2 ? s - mn : s; }
  });

  D('find-the-level-of-tree-with-minimum-sum', {
    t: 'Level With Minimum Sum',
    r: 'BFS level sums; return the first (smallest) level index with the minimum sum, 1-indexed.',
    g: R => ({ root: R.tree(R.int(1, 9), 1, 9) }),
    s(I, T) { const root = Tr.from(I.root); let lv = [root], d = 1, best = Infinity, bd = 1; while (lv.length) { const s = lv.reduce((a, n) => a + n.val, 0); T.at({ tree: TR(root, { hit: lv }) }); T.n(`Sum of level ${d}?`, s, 'Add the level.'); if (s < best) { best = s; bd = d; } lv = lv.flatMap(n => [n.left, n.right].filter(Boolean)); d++; } return bd; }
  });

  D('count-the-number-of-good-nodes', {
    t: 'Count Good Nodes: equal child subtree sizes',
    r: 'Compute subtree sizes; a node is good if all its children\'s subtrees have the same size (leaves are good).',
    g: R => { const n = R.int(2, 8); return { edges: treeEdges(R, n, 0) }; },
    s(I, T) { const n = nOf(I.edges), g = adjOf(n, I.edges); let c = 0; const go = (u, p) => { const s = g[u].filter(v => v !== p).map(v => go(v, u)); const ok = s.every(x => x === s[0]); if (s.length) { T.at({ graph: GR(n, I.edges, { cls: { [u]: 'hit' } }), childSizes: A(s) }); T.yn(`Is node ${u} good?`, ok, 'All child subtrees the same size.'); } if (ok) c++; return 1 + s.reduce((a, b) => a + b, 0); }; go(0, -1); return c; }
  });

  D('find-the-last-marked-nodes-in-tree', {
    t: 'Last Marked Nodes: a diameter endpoint',
    r: 'Marking spreads like BFS, so the last node is the farthest one. The farthest node from any vertex is an endpoint of a diameter: find both endpoints a, b and pick the farther for each i.',
    g: R => { const n = R.int(2, 8); return { edges: treeEdges(R, n, 0) }; },
    cmp: (out, exp, I) => { const n = nOf(I.edges), g = adjOf(n, I.edges); return out.length === n && out.every((x, i) => { const d = bfsDist(g, i); return d[x] === Math.max(...d); }); },
    s(I, T) { const res = (() => { const n = nOf(I.edges), g = adjOf(n, I.edges), d0 = bfsDist(g, 0), a = d0.indexOf(Math.max(...d0)), da = bfsDist(g, a), b = da.indexOf(Math.max(...da)), db = bfsDist(g, b); T.at({ graph: GR(n, I.edges, { cls: { [a]: 'ok', [b]: 'ok' } }) }); T.n('Distance from node 0 to its farthest node?', Math.max(...d0), 'BFS from 0.'); T.n('Diameter length (edges)?', da[b], 'Farthest pair.'); return [...Array(n).keys()].map(i => da[i] > db[i] ? a : b); })(); T.n('Nodes in the tree?', nOf(I.edges), 'Each one gets an answer.'); return res; }
  });

  D('k-th-largest-perfect-subtree-size-in-binary-tree', {
    t: 'Kth Largest Perfect Subtree Size',
    r: 'Post-order: a node is perfect if both children are perfect with equal heights; size = 2 to the power h − 1. Sort all perfect sizes descending.',
    g: R => ({ root: R.tree(R.int(1, 9)), k: R.int(1, 4) }),
    s(I, T) { const root = Tr.from(I.root), s = []; const go = n => { if (!n) return 0; const a = go(n.left), b = go(n.right); const h = a >= 0 && a === b ? a + 1 : -1; T.at({ tree: TR(root, { hit: n }) }); T.yn(`Is the subtree at ${n.val} perfect?`, h > 0, 'Both children perfect with equal height.'); if (h > 0) s.push(2 ** h - 1); return h; }; go(root); s.sort((x, y) => y - x); return I.k <= s.length ? s[I.k - 1] : -1; }
  });

  D('check-if-dfs-strings-are-palindromes', {
    t: 'DFS Strings Palindromes: post-order strings',
    r: 'dfsStr(u) = children\'s strings in increasing child order, then s[u]. Check each subtree\'s string for being a palindrome (hashing makes it fast).',
    g: R => { const n = R.int(1, 7); return { parent: Array.from({ length: n }, (_, i) => i ? R.int(0, i - 1) : -1), s: R.str(n, 'ab') }; },
    s(I, T) { const n = I.parent.length, ch = Array.from({ length: n }, () => []); I.parent.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); const ans = Array(n); const go = u => { const str = ch[u].map(go).join('') + I.s[u]; ans[u] = str === [...str].reverse().join(''); T.at({ parent: A(I.parent, { hl: [u] }), dfsStr: str }); T.yn(`Is dfsStr(${u}) a palindrome?`, ans[u], `"${str}".`); return str; }; go(0); return ans; }
  });

  D('find-subtree-sizes-after-changes', {
    t: 'Subtree Sizes After Changes: nearest same-letter ancestor',
    r: 'DFS keeping, per letter, a stack of ancestors. Node x\'s new parent is the top of its letter\'s stack (if any). Then compute subtree sizes in the new tree.',
    g: R => { const n = R.int(1, 7); return { parent: Array.from({ length: n }, (_, i) => i ? R.int(0, i - 1) : -1), s: R.str(n, 'ab') }; },
    s(I, T) { const n = I.parent.length, ch = Array.from({ length: n }, () => []); I.parent.forEach((p, i) => { if (p >= 0) ch[p].push(i); }); const np = I.parent.slice(), last = {}; const go = u => { const st = last[I.s[u]] = last[I.s[u]] || []; if (u && st.length) np[u] = st[st.length - 1]; if (u) { T.at({ parent: A(I.parent, { hl: [u] }), s: I.s }); T.n(`New parent of node ${u}?`, np[u], 'Nearest ancestor with the same letter, else unchanged.'); } st.push(u); ch[u].forEach(go); st.pop(); }; go(0); const sz = Array(n).fill(1), nch = Array.from({ length: n }, () => []); np.forEach((p, i) => { if (p >= 0) nch[p].push(i); }); const size = u => { for (const v of nch[u]) sz[u] += size(v); return sz[u]; }; size(0); return sz; }
  });

  D('maximize-sum-of-weights-after-edge-removals', {
    t: 'Maximize Weights With Degree at most k: gains DP',
    r: 'For each node: base = the sum of keep-free values of children; gains = (child-with-edge value + w − child free value). Take the best positive gains: up to k − 1 if the parent edge is kept, up to k if not.',
    g: R => { const n = R.int(2, 7); return { edges: treeEdges(R, n, 0).map(e => [...e, R.int(1, 9)]), k: R.int(1, 3) }; },
    s(I, T) { const n = nOf(I.edges), g = Array.from({ length: n }, () => []); I.edges.forEach(([a, b, w]) => { g[a].push([b, w]); g[b].push([a, w]); }); const go = (u, p) => { let base = 0; const gains = []; for (const [v, w] of g[u]) if (v !== p) { const [withP, free] = go(v, u); base += free; gains.push(withP + w - free); } gains.sort((a, b) => b - a); const take = m => gains.slice(0, m).filter(x => x > 0).reduce((a, b) => a + b, 0); const r = [base + take(I.k - 1), base + take(I.k)]; if (gains.length) { T.at({ graph: GR(n, I.edges.map(e => e.slice(0, 2)), { cls: { [u]: 'hit' } }), gains: A(gains) }); T.n(`Best weight in the subtree of ${u} (parent edge removed)?`, r[1], `Base + best ${I.k} positive gains.`); } return r; }; return go(0, -1)[1]; }
  });

  D('maximize-the-number-of-target-nodes-after-connecting-trees-i', {
    t: 'Target Nodes After Connecting Trees I',
    r: 'For node i of tree 1: nodes within distance k in tree 1, plus the best count within distance k − 1 from any node of tree 2 (the new edge costs 1).',
    g: R => { const n = R.int(2, 5), m = R.int(2, 5); return { edges1: treeEdges(R, n, 0), edges2: treeEdges(R, m, 0), k: R.int(0, 3) }; },
    s(I, T) { const res = (() => { const g1 = adjOf(nOf(I.edges1), I.edges1), g2 = adjOf(nOf(I.edges2), I.edges2); const within = (g, s, k) => k < 0 ? 0 : bfsDist(g, s).filter(d => d >= 0 && d <= k).length; let best2 = 0; for (let j = 0; j < g2.length; j++) best2 = Math.max(best2, within(g2, j, I.k - 1)); T.at({ tree2: GR(g2.length, I.edges2) }); T.n(`Nodes within ${I.k} of node 0 in tree 1?`, within(g1, 0, I.k), 'BFS in tree 1.'); T.n(`Best count within ${I.k - 1} in tree 2?`, best2, 'Over all attachment points.'); return g1.map((_, i) => within(g1, i, I.k) + best2); })(); T.n('Answer for node 0?', res[0], 'Its own count plus the best from tree 2.'); return res; }
  });

  D('maximize-the-number-of-target-nodes-after-connecting-trees-ii', {
    t: 'Target Nodes After Connecting Trees II: parity colors',
    r: 'Targets are at even distance, so 2-color each tree. Node i gets the size of its own color class in tree 1, plus the larger color class of tree 2 (the new edge flips parity).',
    g: R => { const n = R.int(2, 6), m = R.int(2, 6); return { edges1: treeEdges(R, n, 0), edges2: treeEdges(R, m, 0) }; },
    s(I, T) { const res = (() => { const col = e => { const g = adjOf(nOf(e), e), d = bfsDist(g, 0); return d.map(x => x % 2); }; const c1 = col(I.edges1), c2 = col(I.edges2); const z1 = c1.filter(x => !x).length, z2 = c2.filter(x => !x).length, best2 = Math.max(z2, c2.length - z2); T.at({ tree1: GR(c1.length, I.edges1, { tag: Object.fromEntries(c1.map((c, i) => [i, c ? 'B' : 'W'])) }) }); T.n('Size of the even-depth color class in tree 1?', z1, 'Count depth-parity 0.'); T.n('Larger color class in tree 2?', best2, 'The larger of the even and odd classes.'); return c1.map(c => (c ? c1.length - z1 : z1) + best2); })(); T.n('Answer for node 0?', res[0], 'Its colour class plus the best class of tree 2.'); return res; }
  });

  D('longest-special-path', {
    t: 'Longest Special Path: sliding window on the DFS path',
    r: 'DFS keeping the root path; the window start moves past the last occurrence of the current value. Path length = prefix distance difference; track the max length and the min node count.',
    g: R => { const n = R.int(2, 7); return { edges: treeEdges(R, n, 0).map(e => [...e, R.int(1, 6)]), nums: R.ints(n, 1, 3) }; },
    s(I, T) { const n = I.nums.length, g = Array.from({ length: n }, () => []); I.edges.forEach(([a, b, w]) => { g[a].push([b, w]); g[b].push([a, w]); }); let best = [0, 1]; const path = [], dist = [], last = new Map(); const go = (u, p, d, start) => { const prev = last.get(I.nums[u]); if (prev !== undefined && prev >= start) start = prev + 1; path.push(u); dist.push(d); last.set(I.nums[u], path.length - 1); const len = d - dist[start], cnt = path.length - start; if (len > best[0] || (len === best[0] && cnt < best[1])) best = [len, cnt]; T.at({ path: A(path.map(x => I.nums[x]), { win: [start, path.length - 1] }) }); T.n(`Special path length ending at node ${u}?`, len, 'Distance from the window start.'); for (const [v, w] of g[u]) if (v !== p) go(v, u, d + w, start); path.pop(); dist.pop(); if (prev === undefined) last.delete(I.nums[u]); else last.set(I.nums[u], prev); }; go(0, -1, 0, 0); return best; }
  });
})();
