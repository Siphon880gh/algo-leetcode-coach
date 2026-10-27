/* v2 games: linked lists (02). */
(function () {
  'use strict';
  const { D, A, G, K, S, LL, Ls } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : a;

  D('delete-n-nodes-after-m-nodes-of-a-linked-list', {
    t: 'Delete N Nodes After M Nodes of a Linked List',
    r: 'Repeat: keep m nodes, then unlink the next n nodes, until the list ends.',
    g: R => ({ head: Array.from({ length: R.int(1, 12) }, (_, i) => i + 1), m: R.int(1, 3), n: R.int(1, 3) }),
    s(I, T) { const out = []; I.head.forEach((v, i) => { const keep = i % (I.m + I.n) < I.m; if (keep) out.push(v); if (i < 7) { T.at({ list: A(I.head, { i }) }); T.yn(`Keep ${v}?`, keep, `Cycle of ${I.m} kept, ${I.n} deleted.`); } }); return out; }
  });

  D('add-two-polynomials-represented-as-linked-lists', {
    t: 'Add Two Polynomials Represented as Linked Lists',
    r: 'Merge like sorted lists by power (descending): equal powers add coefficients (drop the term if it becomes 0); otherwise take the higher power.',
    g: R => { const mk = () => R.distinct(R.int(0, 3), 0, 4).sort((a, b) => b - a).map(p => [R.pick([-3, -1, 1, 2, 4]), p]); return { poly1: mk(), poly2: mk() }; },
    s(I, T) { const a = I.poly1, b = I.poly2, out = []; let i = 0, j = 0; while (i < a.length || j < b.length) { let term; if (j >= b.length || (i < a.length && a[i][1] > b[j][1])) term = a[i++]; else if (i >= a.length || b[j][1] > a[i][1]) term = b[j++]; else { term = [a[i][0] + b[j][0], a[i][1]]; i++; j++; } T.at({ power: term[1] }); T.n(`Coefficient for x to the power ${term[1]}?`, term[0], 'Add matching powers.'); if (term[0]) out.push(term); } return out; }
  });

  D('merge-in-between-linked-lists', {
    t: 'Merge In Between Linked Lists',
    r: 'Find node a − 1 and node b + 1 in list1. Link node a − 1 to list2\'s head and list2\'s tail to node b + 1.',
    g: R => { const n = R.int(3, 7), a = R.int(1, n - 2); return { list1: Array.from({ length: n }, (_, i) => i), a, b: R.int(a, n - 2), list2: Array.from({ length: R.int(1, 3) }, (_, i) => 100 + i) }; },
    s(I, T) { const res = (() => { T.at({ list1: A(I.list1, { i: I.a - 1, j: I.b + 1 }) }); T.n('Value of the node before the cut?', I.list1[I.a - 1], 'Node a minus 1.'); T.n('Value of the node after the cut?', I.list1[I.b + 1], 'Node b plus 1.'); return [...I.list1.slice(0, I.a), ...I.list2, ...I.list1.slice(I.b + 1)]; })(); T.n('Length of the result?', res.length, 'list1 minus the cut nodes, plus list2.'); return res; }
  });

  D('swapping-nodes-in-a-linked-list', {
    t: 'Swapping Nodes in a Linked List',
    r: 'Move a pointer k − 1 steps to the k-th node; then advance a second pointer from the head together with the first until it hits the end — it lands on the k-th from the end. Swap values.',
    g: R => { const h = R.ints(R.int(1, 8), 1, 9); return { head: h, k: R.int(1, h.length) }; },
    s(I, T) { const res = (() => { const a = I.head.slice(), n = a.length, i = I.k - 1, j = n - I.k; T.at({ list: A(a, { i, j }) }); T.n('Index of the k-th node from the start?', i, 'k minus 1.'); T.n('Index of the k-th node from the end?', j, 'n minus k.'); [a[i], a[j]] = [a[j], a[i]]; return a; })(); T.n('Value now at index k minus 1?', res[I.k - 1], 'It came from the other end.'); return res; }
  });

  D('remove-duplicates-from-an-unsorted-linked-list', {
    t: 'Remove Duplicates From an Unsorted Linked List',
    r: 'First pass counts values; second pass unlinks every node whose value appears more than once.',
    g: R => ({ head: R.ints(R.int(1, 8), 1, 5) }),
    s(I, T) { const c = {}; I.head.forEach(v => c[v] = (c[v] || 0) + 1); T.at({ counts: K(c) }); I.head.slice(0, 5).forEach((v, i) => { T.at({ list: A(I.head, { i }) }); T.yn(`Delete ${v}?`, c[v] > 1, 'Value appears more than once.'); }); return I.head.filter(v => c[v] === 1); }
  });

  D('sort-linked-list-already-sorted-using-absolute-values', {
    t: 'Sort Linked List Already Sorted Using Absolute Values',
    r: 'Negative values appear in decreasing order of actual value. Walk the list and move every negative node to the front; the result is sorted.',
    g: R => ({ head: R.ints(R.int(1, 7), 0, 9).sort((a, b) => a - b).map(x => R.chance(0.4) ? -x : x).sort((a, b) => Math.abs(a) - Math.abs(b)) }),
    s(I, T) { const out = []; I.head.forEach((v, i) => { if (v < 0) out.unshift(v); else out.push(v); if (i < 6) { T.at({ list: A(I.head, { i }), result: A(out.slice()) }); T.c(`Where does ${v} go?`, ['front', 'stays'], v < 0 ? 'front' : 'stays', 'Negatives move to the head.'); } }); return out; }
  });

  D('find-the-minimum-and-maximum-number-of-nodes-between-critical-points', {
    t: 'Find the Minimum and Maximum Number of Nodes Between Critical Points',
    r: 'Record indices of local maxima or minima. The min distance is the smallest gap between consecutive critical points; the max is last − first. Fewer than two: [−1, −1].',
    g: R => ({ head: R.ints(R.int(2, 9), 1, 5) }),
    s(I, T) { const a = I.head, cp = []; for (let i = 1; i + 1 < a.length; i++) { const c = (a[i] > a[i - 1] && a[i] > a[i + 1]) || (a[i] < a[i - 1] && a[i] < a[i + 1]); if (c) cp.push(i); if (i < 6) { T.at({ list: A(a, { i }) }); T.yn('Critical point?', c, 'Strict local max or min.'); } } if (cp.length < 2) return [-1, -1]; let mn = Infinity; for (let i = 1; i < cp.length; i++) mn = Math.min(mn, cp[i] - cp[i - 1]); return [mn, cp[cp.length - 1] - cp[0]]; }
  });

  D('reverse-nodes-in-even-length-groups', {
    t: 'Reverse Nodes in Even Length Groups',
    r: 'Groups have sizes 1, 2, 3, … (the last may be shorter). Reverse a group in place when its actual length is even.',
    g: R => ({ head: R.ints(R.int(1, 11), 0, 9) }),
    s(I, T) { const a = I.head.slice(); let i = 0; for (let g = 1; i < a.length; g++) { const L = Math.min(g, a.length - i); if (L % 2 === 0) a.splice(i, L, ...a.slice(i, i + L).reverse()); T.at({ list: A(a.slice(), { i, j: i + L - 1 }) }); T.yn(`Reverse group ${g} (length ${L})?`, L % 2 === 0, 'Only even actual lengths.'); i += L; } return a; }
  });

  D('delete-the-middle-node-of-a-linked-list', {
    t: 'Delete the Middle Node of a Linked List',
    r: 'Slow or fast pointers with fast starting two ahead: when fast reaches the end, slow is just before the middle (index (half of n, rounded down)); unlink slow.next.',
    g: R => ({ head: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const res = (() => { const m = Math.floor(I.head.length / 2); T.at({ list: LL(Ls.from(I.head)) }); T.n('Length of the list?', I.head.length, 'Or use slow and fast pointers.'); T.n('Index of the middle node?', m, 'n divided by 2, rounded down.'); return I.head.filter((_, i) => i !== m); })(); T.n('Length after deleting?', res.length, 'One fewer node.'); return res; }
  });

  D('maximum-twin-sum-of-a-linked-list', {
    t: 'Maximum Twin Sum of a Linked List',
    r: 'Reverse the second half (or use a stack); pair node i with node n − 1 − i and take the largest sum.',
    g: R => ({ head: R.ints(2 * R.int(1, 4), 1, 9) }),
    s(I, T) { const a = I.head, n = a.length; let b = 0; for (let i = 0; i < n / 2; i++) { const s = a[i] + a[n - 1 - i]; b = Math.max(b, s); T.at({ list: A(a, { i, j: n - 1 - i }) }); T.n('Twin sum?', s, 'Node i + node n−1−i.'); } return b; }
  });

  D('merge-nodes-in-between-zeros', {
    t: 'Merge Nodes in Between Zeros',
    r: 'Sum the values between consecutive zeros; each block becomes one node.',
    g: R => ({ head: [0, ...Array.from({ length: R.int(1, 4) }, () => [...R.ints(R.int(1, 3), 1, 9), 0]).flat()] }),
    s(I, T) { const out = []; let s = 0; I.head.slice(1).forEach((v, i) => { if (v) s += v; else { out.push(s); T.at({ list: A(I.head, { i: i + 1 }) }); T.n('Block sum?', s, 'Values since the previous zero.'); s = 0; } }); return out; }
  });

  D('steps-to-make-array-non-decreasing', {
    t: 'Steps to Make Array Non-decreasing',
    r: 'Monotonic stack of (value, steps until removed). For x, pop smaller-or-equal elements, keeping the max of their steps; if something larger remains, x dies one step after that max, else it never dies (0).',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const st = []; let ans = 0; I.nums.forEach((x, i) => { let c = 0; while (st.length && st[st.length - 1][0] <= x) c = Math.max(c, st.pop()[1]); c = st.length ? c + 1 : 0; st.push([x, c]); ans = Math.max(ans, c); if (i < 7) { T.at({ nums: A(I.nums, { i }), stack: S(st.map(p => p.join(':'))) }); T.n(`Step at which ${x} is removed (0 = never)?`, c, 'One after the slowest smaller element before it.'); } }); return ans; }
  });

  D('spiral-matrix-iv', {
    t: 'Spiral Matrix IV',
    r: 'Fill an m times n matrix of −1 in spiral order (right, down, left, up, turning at walls or filled cells) with the list values until the list ends.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { m, n, head: R.ints(R.int(1, m * n), 0, 9) }; },
    s(I, T) { const g = Array.from({ length: I.m }, () => Array(I.n).fill(-1)), dr = [[0, 1], [1, 0], [0, -1], [-1, 0]]; let r = 0, c = 0, d = 0; I.head.forEach((v, k) => { g[r][c] = v; if (k < 5) { T.at({ matrix: G(g.map(x => x.slice()), { hl: [[r, c]] }) }); T.n(`Row where ${v} is placed?`, r, 'Spiral order.'); } const nr = r + dr[d][0], nc = c + dr[d][1]; if (nr < 0 || nc < 0 || nr >= I.m || nc >= I.n || g[nr][nc] !== -1) d = (d + 1) % 4; r += dr[d][0]; c += dr[d][1]; }); return g; }
  });

  D('remove-nodes-from-linked-list', {
    t: 'Remove Nodes From Linked List',
    r: 'Monotonic stack (non-increasing): for each node pop every smaller value, then push it. The stack is the answer.',
    g: R => ({ head: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const st = []; I.head.forEach((v, i) => { let p = 0; while (st.length && st[st.length - 1] < v) { st.pop(); p++; } st.push(v); if (i < 7) { T.at({ list: A(I.head, { i }), stack: S(st.slice()) }); T.n('Nodes removed by this one?', p, 'Smaller values before it.'); } }); return st; }
  });

  D('split-a-circular-linked-list', {
    t: 'Split a Circular Linked List',
    r: 'Slow or fast pointers find the middle: the first half gets half of n (rounded up) nodes. Cut after it and close both halves into circles.',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 9) }),
    s(I, T) { const res = (() => { const h = Math.ceil(I.nums.length / 2); T.at({ circle: A(I.nums) }); T.n('Size of the first half?', h, 'n divided by 2, rounded up.'); return [I.nums.slice(0, h), I.nums.slice(h)]; })(); T.n('Size of the second half?', res[1].length, 'The rest of the nodes.'); T.n('First value of the second half? (−1 if empty)', res[1].length ? res[1][0] : -1, 'Right after the first half.'); return res; }
  });

  D('insert-greatest-common-divisors-in-linked-list', {
    t: 'Insert Greatest Common Divisors in Linked List',
    r: 'Between each pair of adjacent nodes insert a node holding gcd(a, b).',
    g: R => ({ head: R.ints(R.int(1, 5), 1, 20) }),
    s(I, T) { const out = [I.head[0]]; for (let i = 1; i < I.head.length; i++) { const g = gcd(I.head[i - 1], I.head[i]); out.push(g, I.head[i]); if (i < 5) { T.at({ list: A(I.head, { i: i - 1, j: i }) }); T.n('gcd inserted?', g, `gcd(${I.head[i - 1]}, ${I.head[i]}).`); } } return out; }
  });

  D('double-a-number-represented-as-a-linked-list', {
    t: 'Double a Number Represented as a Linked List',
    r: 'Each digit doubles, and it receives a carry of 1 exactly when the next digit is at least 5. Prepend a 1 if the first digit is at least 5.',
    g: R => ({ head: [R.int(1, 9), ...R.ints(R.int(0, 4), 0, 9)] }),
    s(I, T) { const a = I.head, out = a.map((d, i) => (2 * d + (a[i + 1] >= 5 ? 1 : 0)) % 10); out.slice(0, 5).forEach((v, i) => { T.at({ digits: A(a, { i }) }); T.n('New digit here?', v, '(2d + carry from the next digit) mod 10.'); }); return a[0] >= 5 ? [1, ...out] : out; }
  });

  D('winner-of-the-linked-list-game', {
    t: 'Winner of the Linked List Game',
    r: 'Walk pairs (even node, odd node): the larger value scores a point for its team. Compare totals.',
    g: R => ({ head: Array.from({ length: R.int(1, 4) }, () => [R.int(1, 10) * 2, R.int(0, 9) * 2 + 1]).flat() }),
    s(I, T) { let e = 0, o = 0; for (let i = 0; i < I.head.length; i += 2) { const ev = I.head[i] > I.head[i + 1]; if (ev) e++; else o++; T.at({ pair: `${I.head[i]} vs ${I.head[i + 1]}` }); T.c('Who scores?', ['Even', 'Odd'], ev ? 'Even' : 'Odd', 'Larger value wins the pair.'); } return e > o ? 'Even' : o > e ? 'Odd' : 'Tie'; }
  });

  D('linked-list-frequency', {
    t: 'Linked List Frequency',
    r: 'Count each value in a hash map, then build a list of the counts.',
    g: R => ({ head: R.ints(R.int(1, 8), 1, 4) }),
    cmp: (o, e) => Array.isArray(o) && JSON.stringify(o.slice().sort()) === JSON.stringify(e.slice().sort()),
    s(I, T) { const res = (() => { const c = new Map(); I.head.forEach(v => c.set(v, (c.get(v) || 0) + 1)); T.at({ list: A(I.head) }); T.n('Distinct values?', c.size, 'One output node each.'); return [...c.values()]; })(); T.n('Largest frequency?', Math.max(...res), 'The most common value.'); T.n('Sum of all frequencies?', res.reduce((a, b) => a + b, 0), 'The length of the list.'); return res; }
  });

  D('delete-nodes-from-linked-list-present-in-array', {
    t: 'Delete Nodes From Linked List Present in Array',
    r: 'Put nums in a set; walk with a dummy node and unlink every node whose value is in the set.',
    g: R => ({ nums: R.distinct(R.int(1, 3), 1, 5), head: R.ints(R.int(1, 8), 1, 6) }),
    s(I, T) { const S2 = new Set(I.nums); I.head.slice(0, 6).forEach((v, i) => { T.at({ list: A(I.head, { i }), nums: A(I.nums) }); T.yn(`Delete ${v}?`, S2.has(v), 'In the set.'); }); return I.head.filter(v => !S2.has(v)); }
  });

  D('convert-doubly-linked-list-to-array-i', {
    t: 'Convert Doubly Linked List to Array I',
    r: 'Follow next pointers from the head, appending each value.',
    g: R => ({ head: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { I.head.slice(0, 4).forEach((v, i) => { T.at({ list: LL(Ls.from(I.head)), step: i }); T.n(`Value at position ${i}?`, v, 'Follow next.'); }); return I.head.slice(); }
  });

  D('convert-doubly-linked-list-to-array-ii', {
    t: 'Convert Doubly Linked List to Array II',
    r: 'From the given node, follow prev pointers back to the head, then follow next pointers forward collecting values.',
    g: R => { const h = R.distinct(R.int(1, 6), 1, 20); return { head: h, node: R.pick(h) }; },
    s(I, T) { const res = (() => { const i = I.head.indexOf(I.node); T.at({ list: A(I.head, { i }) }); T.n('How many prev steps reach the head?', i, 'Its position.'); T.n('How many next steps reach the tail?', I.head.length - 1 - i, 'Nodes after it.'); return I.head.slice(); })(); T.n('Length of the array?', res.length, 'Every node once.'); return res; }
  });
})();
