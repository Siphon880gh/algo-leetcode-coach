/* v2 games: linked lists (01). */
(function () {
  'use strict';
  const { D, A, K, S, LL, Ls } = LCGame.H;
  const len = h => { let n = 0; for (; h; h = h.next) n++; return n; };
  const rev = h => { let p = null; while (h) { const n = h.next; h.next = p; p = h; h = n; } return p; };

  D('add-two-numbers', {
    t: 'Add Two Numbers',
    r: 'Walk both lists together (least significant digit first), adding digits plus the carry; write sum % 10 and carry ⌊sum / 10⌋. Append a final carry node if needed.',
    g: R => ({ l1: [...R.ints(R.int(1, 4), 0, 9).slice(0, -1), R.int(1, 9)], l2: [...R.ints(R.int(1, 4), 0, 9).slice(0, -1), R.int(1, 9)] }),
    s(I, T) { let a = Ls.from(I.l1), b = Ls.from(I.l2), c = 0; const out = []; while (a || b || c) { const s = (a ? a.val : 0) + (b ? b.val : 0) + c; out.push(s % 10); if (out.length <= 5) { T.at({ l1: LL(Ls.from(I.l1), { a }), l2: LL(Ls.from(I.l2), { b }), carry: c }); T.n('Digit written?', s % 10, 'sum % 10.'); } c = Math.floor(s / 10); a = a && a.next; b = b && b.next; } return out; }
  });

  D('merge-k-sorted-lists', {
    t: 'Merge k Sorted Lists',
    r: 'Keep a min-heap of the current head of each list; repeatedly pop the smallest, append it, and push its successor.',
    g: R => ({ lists: Array.from({ length: R.int(0, 4) }, () => R.sorted(R.int(0, 3), 1, 9)) }),
    s(I, T) { const heads = I.lists.map(l => Ls.from(l)), out = []; for (;;) { let bi = -1; heads.forEach((h, i) => { if (h && (bi < 0 || h.val < heads[bi].val)) bi = i; }); if (bi < 0) break; if (out.length < 6) { T.at({ heads: A(heads.map(h => h ? h.val : '∅')), merged: A(out.slice()) }); T.n('Which list gives the next node (index)?', bi, 'Smallest head (first on ties).'); } out.push(heads[bi].val); heads[bi] = heads[bi].next; } if (!out.length) { T.at({ lists: A(I.lists.map(l => l.length)) }); T.n('Total nodes?', 0, 'All lists are empty.'); } return out; }
  });

  D('reverse-nodes-in-k-group', {
    t: 'Reverse Nodes in k-Group',
    r: 'With a dummy node, repeatedly check that k nodes remain; if so reverse that block in place and reconnect it to the previous tail. A short final block stays as is.',
    g: R => ({ head: R.ints(R.int(1, 8), 1, 9), k: R.int(1, 4) }),
    s(I, T) { const a = I.head.slice(), n = a.length; for (let i = 0; i + I.k <= n; i += I.k) { const blk = a.slice(i, i + I.k).reverse(); a.splice(i, I.k, ...blk); T.at({ list: LL(Ls.from(a)) }); T.n('First value of the reversed block?', blk[0], 'It was the block\'s last node.'); } T.at({ length: n, k: I.k }); T.n('Nodes left unreversed at the end?', n % I.k, 'Fewer than k remain.'); return a; }
  });

  D('rotate-list', {
    t: 'Rotate List',
    r: 'Find the length n and the tail; make the list circular, then break it after node n − (k mod n) − 1. The next node is the new head.',
    g: R => ({ head: R.ints(R.int(0, 6), 0, 9), k: R.int(0, 12) }),
    s(I, T) { const n = I.head.length; if (!n) { T.at({ head: A([]) }); T.n('Length?', 0, 'Nothing to rotate.'); return []; } const r = I.k % n; T.at({ list: LL(Ls.from(I.head)), k: I.k }); T.n('Effective rotation (k mod n)?', r, 'Full turns change nothing.'); return [...I.head.slice(n - r), ...I.head.slice(0, n - r)]; }
  });

  D('remove-duplicates-from-sorted-list-ii', {
    t: 'Remove Duplicates from Sorted List II',
    r: 'Use a dummy and a "prev" pointer. If the current value repeats, skip the entire run and link prev past it; otherwise advance prev.',
    g: R => ({ head: R.sorted(R.int(0, 8), 1, 5) }),
    s(I, T) { const a = I.head, out = []; for (let i = 0; i < a.length;) { let j = i; while (j < a.length && a[j] === a[i]) j++; const dup = j - i > 1; if (!dup) out.push(a[i]); T.at({ list: A(a, { i, j: j - 1 }) }); T.yn(`Does ${a[i]} repeat?`, dup, 'Then drop the whole run.'); i = j; } return out; }
  });

  D('partition-list', {
    t: 'Partition List',
    r: 'Build two lists — nodes < x and nodes ≥ x — preserving order, then link the first list\'s tail to the second\'s head.',
    g: R => ({ head: R.ints(R.int(0, 7), 0, 9), x: R.int(0, 9) }),
    s(I, T) { const lo = [], hi = []; I.head.forEach((v, i) => { (v < I.x ? lo : hi).push(v); if (i < 6) { T.at({ list: A(I.head, { i }), less: A(lo.slice()), rest: A(hi.slice()) }); T.c(`Where does ${v} go?`, ['less', 'rest'], v < I.x ? 'less' : 'rest', `Compare with x = ${I.x}.`); } }); return [...lo, ...hi]; }
  });

  D('copy-list-with-random-pointer', {
    t: 'Copy List with Random Pointer',
    r: 'Map each original node to a new node (hash map or interleaving). Then set copy.next = map[orig.next] and copy.random = map[orig.random].',
    g: R => { const n = R.int(0, 5); return { head: Array.from({ length: n }, () => [R.int(1, 20), R.chance(0.3) ? null : R.int(0, n - 1)]) }; },
    s(I, T) { const nodes = I.head.map(([v]) => ({ val: v, next: null, random: null })); nodes.forEach((n, i) => { n.next = nodes[i + 1] || null; n.random = I.head[i][1] === null ? null : nodes[I.head[i][1]]; }); const map = new Map(); nodes.forEach(n => map.set(n, { val: n.val, next: null, random: null })); nodes.forEach((n, i) => { const c = map.get(n); c.next = n.next ? map.get(n.next) : null; c.random = n.random ? map.get(n.random) : null; if (i < 5) { T.at({ list: A(I.head.map(x => `${x[0]}→${x[1] === null ? '∅' : x[1]}`), { i }) }); T.c('Copy\'s random points to the copy of node…', [...new Set(['null', ...I.head.map((_, j) => String(j))])], I.head[i][1] === null ? 'null' : String(I.head[i][1]), 'Look it up in the map.'); } }); const copies = nodes.map(n => map.get(n)); return copies.map(c => [c.val, c.random ? copies.indexOf(c.random) : null]); }
  });

  D('reorder-list', {
    t: 'Reorder List',
    r: 'Find the middle with slow/fast pointers, reverse the second half, then weave the two halves together.',
    g: R => ({ head: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const n = I.head.length, first = I.head.slice(0, Math.ceil(n / 2)), second = I.head.slice(Math.ceil(n / 2)).reverse(); T.at({ list: LL(Ls.from(I.head)) }); T.n('Length of the reversed second half?', second.length, 'Nodes after the middle.'); const out = []; first.forEach((v, i) => { out.push(v); if (i < second.length) out.push(second[i]); }); return out; }
  });

  D('insertion-sort-list', {
    t: 'Insertion Sort List',
    r: 'Grow a sorted list after a dummy node: for each node, walk from the dummy to the last node smaller than it and splice it in.',
    g: R => ({ head: R.ints(R.int(1, 6), -5, 9) }),
    s(I, T) { const out = []; I.head.forEach((v, i) => { let p = 0; while (p < out.length && out[p] < v) p++; out.splice(p, 0, v); if (i < 6) { T.at({ sorted: A(out.slice(), { i: p }) }); T.n(`Insert position of ${v}?`, p, 'After every smaller value.'); } }); return out; }
  });

  D('sort-list', {
    t: 'Sort List',
    r: 'Merge sort: split at the middle with slow/fast pointers, sort both halves recursively, and merge them.',
    g: R => ({ head: R.ints(R.int(0, 7), -5, 9) }),
    s(I, T) { let k = 0; const ms = a => { if (a.length < 2) return a; const m = a.length >> 1, l = ms(a.slice(0, m)), r = ms(a.slice(m)), out = []; let i = 0, j = 0; while (i < l.length || j < r.length) out.push(j >= r.length || (i < l.length && l[i] <= r[j]) ? l[i++] : r[j++]); if (k++ < 4) { T.at({ left: A(l), right: A(r) }); T.n('First value of the merged list?', out[0], 'Smaller of the two heads.'); } return out; }; return ms(I.head); }
  });

  D('intersection-of-two-linked-lists', {
    t: 'Intersection of Two Linked Lists',
    r: 'Two pointers: walk A then B, and B then A. They meet at the intersection node after at most lenA + lenB steps (or both reach null).',
    g: R => { const common = R.ints(R.int(0, 3), 1, 9), a = R.ints(R.int(0, 3), 1, 9), b = R.ints(R.int(0, 3), 1, 9); return { intersectVal: common.length ? common[0] : 0, listA: [...a, ...common], listB: [...b, ...common], skipA: common.length ? a.length : a.length + common.length, skipB: common.length ? b.length : b.length + common.length }; },
    s(I, T) { const shared = I.intersectVal ? Ls.from(I.listA.slice(I.skipA)) : null; const mk = (arr, skip) => { const pre = Ls.from(arr.slice(0, skip)); if (!pre) return shared; let t = pre; while (t.next) t = t.next; t.next = shared; return pre; }; const a = mk(I.listA, I.skipA), b = mk(I.listB, I.skipB); let p = a, q = b, steps = 0; while (p !== q) { p = p ? p.next : b; q = q ? q.next : a; steps++; } T.at({ lenA: I.listA.length, lenB: I.listB.length }); T.n('Steps until the pointers meet?', steps, 'At most lenA + lenB.'); return p ? `Intersected at '${p.val}'` : 'No intersection'; }
  });

  D('palindrome-linked-list', {
    t: 'Palindrome Linked List',
    r: 'Find the middle, reverse the second half, and compare it node by node with the first half.',
    g: R => { const h = R.ints(R.int(1, 4), 1, 3); return { head: R.chance(0.5) ? [...h, ...h.slice(0, R.int(0, 1) ? -1 : undefined).reverse()] : R.ints(R.int(1, 6), 1, 3) }; },
    s(I, T) { const n = I.head.length, back = I.head.slice(Math.ceil(n / 2)).reverse(); for (let i = 0; i < back.length; i++) { const ok = I.head[i] === back[i]; T.at({ front: A(I.head.slice(0, Math.ceil(n / 2)), { i }), reversedBack: A(back, { i }) }); T.yn('Do these match?', ok, 'Compare halves.'); if (!ok) return false; } return true; }
  });

  D('delete-node-in-a-linked-list', {
    t: 'Delete Node in a Linked List',
    r: 'You only have the node itself: copy the next node\'s value into it and unlink the next node.',
    g: R => { const h = R.distinct(R.int(2, 6), 1, 20); return { head: h, node: R.pick(h.slice(0, -1)) }; },
    s(I, T) { const i = I.head.indexOf(I.node); T.at({ list: A(I.head, { i }) }); T.n('Value copied into the node?', I.head[i + 1], 'Its successor\'s value.'); return I.head.filter((_, j) => j !== i); }
  });

  D('plus-one-linked-list', {
    t: 'Plus One Linked List',
    r: 'Find the rightmost digit that is not 9; increment it and set every digit after it to 0. If all are 9, prepend a 1.',
    g: R => ({ head: R.chance(0.3) ? Array(R.int(1, 4)).fill(9) : [R.int(1, 9), ...R.ints(R.int(0, 4), 0, 9)] }),
    s(I, T) { const a = I.head.slice(); let i = a.length - 1; while (i >= 0 && a[i] === 9) i--; T.at({ digits: A(a, { i: Math.max(i, 0) }) }); T.n('Index of the rightmost non-9 digit (−1 if none)?', i, 'It absorbs the carry.'); if (i < 0) return [1, ...a.map(() => 0)]; a[i]++; for (let j = i + 1; j < a.length; j++) a[j] = 0; return a; }
  });

  D('flatten-a-multilevel-doubly-linked-list', {
    t: 'Flatten a Multilevel Doubly Linked List',
    r: 'DFS: when a node has a child, flatten the child list, splice it between the node and its next, and clear the child pointer. Continue from the spliced tail.',
    g: R => { const levels = [R.ints(R.int(1, 4), 1, 9)], ser = [...levels[0]]; let prev = levels[0], v = 10; for (let d = 0; d < R.int(0, 2); d++) { const off = R.int(0, prev.length - 1), lvl = Array.from({ length: R.int(1, 3) }, () => v++); ser.push(...Array(off + 1).fill(null), ...lvl); prev = lvl; } return { head: ser }; },
    s(I, T) { const tok = I.head, levels = []; let i = 0; const read = () => { const l = []; while (i < tok.length && tok[i] !== null) l.push({ val: tok[i++], child: null }); return l; }; levels.push(read()); while (i < tok.length) { let c = 0; while (i < tok.length && tok[i] === null) { c++; i++; } const prev = levels[levels.length - 1], lvl = read(); prev[c - 1].child = lvl; levels.push(lvl); } const out = []; let k = 0; const walk = l => l.forEach(n => { out.push(n.val); if (n.child) { if (k++ < 3) { T.at({ at: n.val, child: A(n.child.map(x => x.val)) }); T.n('Child-list length spliced in after this node?', n.child.length, 'Flatten it before continuing.'); } walk(n.child); } }); walk(levels[0]); if (!k) { T.at({ list: A(out) }); T.n('Nodes with children?', 0, 'Already flat.'); } return out; }
  });

  D('add-two-numbers-ii', {
    t: 'Add Two Numbers II',
    r: 'Digits are most-significant first, so push both lists onto stacks; pop and add with a carry, prepending each result digit.',
    g: R => ({ l1: [R.int(1, 9), ...R.ints(R.int(0, 3), 0, 9)], l2: [R.int(1, 9), ...R.ints(R.int(0, 3), 0, 9)] }),
    s(I, T) { const a = I.l1.slice(), b = I.l2.slice(), out = []; let c = 0; while (a.length || b.length || c) { const s = (a.pop() || 0) + (b.pop() || 0) + c; out.unshift(s % 10); if (out.length <= 4) { T.at({ stack1: S(a.slice()), stack2: S(b.slice()), carry: c }); T.n('Digit prepended?', s % 10, 'sum % 10.'); } c = Math.floor(s / 10); } return out; }
  });

  D('insert-into-a-sorted-circular-linked-list', {
    t: 'Insert into a Sorted Circular Linked List',
    r: 'Walk the circle looking for prev ≤ x ≤ next, or the wrap point (prev > next) where x is a new max or min. If a full loop finds neither (all equal), insert anywhere.',
    g: R => { const s = R.sorted(R.int(0, 5), 1, 6), k = R.int(0, Math.max(0, s.length - 1)); return { head: [...s.slice(k), ...s.slice(0, k)], insertVal: R.int(0, 7) }; },
    cmp: (o, e, I) => { const h = I.head; if (!Array.isArray(o) || o.length !== h.length + 1) return false; if (!h.length) return o[0] === I.insertVal; if (o[0] !== h[0] && !(o[0] === I.insertVal && o.slice(1).join() === h.join())) return false; let ok = false; for (let i = 0; i < o.length; i++) if (o[i] === I.insertVal && [...o.slice(0, i), ...o.slice(i + 1)].join() === h.join()) ok = true; if (!ok) return false; let drops = 0; for (let i = 0; i < o.length; i++) if (o[i] > o[(i + 1) % o.length]) drops++; return drops <= 1; },
    s(I, T) { const h = I.head, n = h.length, x = I.insertVal; if (!n) { T.at({ head: A([]) }); T.yn('Is the list empty?', true, 'Make a one-node circle.'); return [x]; } for (let i = 0; i < n; i++) { const p = h[i], q = h[(i + 1) % n], fits = (p <= x && x <= q) || (p > q && (x >= p || x <= q)); if (i < 5) { T.at({ circle: A(h, { i, j: (i + 1) % n }) }); T.yn(`Insert between ${p} and ${q}?`, fits, 'In order, or at the wrap for a new max/min.'); } if (fits) return [...h.slice(0, i + 1), x, ...h.slice(i + 1)]; } return [...h, x]; }
  });

  D('split-linked-list-in-parts', {
    t: 'Split Linked List in Parts',
    r: 'With length n, every part gets ⌊n/k⌋ nodes and the first n mod k parts get one extra. Cut the list accordingly.',
    g: R => ({ head: Array.from({ length: R.int(0, 9) }, (_, i) => i + 1), k: R.int(1, 5) }),
    s(I, T) { const n = I.head.length, q = Math.floor(n / I.k), r = n % I.k; T.at({ n, k: I.k }); T.n('Base size of each part?', q, '⌊n / k⌋.'); T.n('Parts with one extra node?', r, 'n mod k.'); const out = []; let p = 0; for (let i = 0; i < I.k; i++) { const s = q + (i < r ? 1 : 0); out.push(I.head.slice(p, p + s)); p += s; } return out; }
  });

  D('linked-list-components', {
    t: 'Linked List Components',
    r: 'Put nums in a set. Walk the list and count nodes in the set whose next node is not in the set — each ends a component.',
    g: R => { const h = R.perm(R.int(1, 8)); return { head: h, nums: R.shuffle(h.slice()).slice(0, R.int(1, h.length)) }; },
    s(I, T) { const S2 = new Set(I.nums); let c = 0; I.head.forEach((v, i) => { const end = S2.has(v) && !S2.has(I.head[i + 1]); if (end) c++; if (i < 7) { T.at({ list: A(I.head, { i }), nums: A(I.nums) }); T.yn('Does a component end here?', end, 'In the set, next one is not.'); } }); return c; }
  });

  D('remove-zero-sum-consecutive-nodes-from-linked-list', {
    t: 'Remove Zero Sum Consecutive Nodes from Linked List',
    r: 'Prefix sums with a dummy node: map each prefix sum to the last node where it occurs. A second pass links every node to the node after the last occurrence of its prefix sum, skipping zero-sum runs.',
    g: R => ({ head: R.ints(R.int(1, 7), -3, 3).map(x => x || 1) }),
    cmp: (o, e, I) => { if (!Array.isArray(o)) return false; for (let i = 0; i < o.length; i++) { let s = 0; for (let j = i; j < o.length; j++) if ((s += o[j]) === 0) return false; } const a = I.head, zero = (x, y) => a.slice(x, y).reduce((p, q) => p + q, 0) === 0; const go = (i, j) => { if (j === o.length) return zero(i, a.length); for (let k = i; k < a.length; k++) if (a[k] === o[j] && zero(i, k) && go(k + 1, j + 1)) return true; return false; }; return go(0, 0); },
    s(I, T) { const a = I.head, pre = [0]; a.forEach(x => pre.push(pre[pre.length - 1] + x)); const last = new Map(); pre.forEach((s, i) => last.set(s, i)); const out = []; let k = 0; for (let i = 0; i < pre.length;) { const j = last.get(pre[i]); if (j > i && k++ < 4) { T.at({ prefix: A(pre, { i, j }) }); T.n('Nodes skipped (a zero-sum run)?', j - i, 'Same prefix sum appears later.'); } i = j; if (i < a.length) out.push(a[i]); i++; } return out; }
  });

  D('print-immutable-linked-list-in-reverse', {
    t: 'Print Immutable Linked List in Reverse',
    r: 'Recurse to the end (or push nodes on a stack) and print on the way back.',
    g: R => ({ head: R.ints(R.int(1, 6), -5, 9) }),
    s(I, T) { const st = []; I.head.forEach(v => st.push(v)); const out = []; while (st.length) { const v = st.pop(); out.push(v); if (out.length <= 4) { T.at({ stack: S(st.slice()) }); T.n('Printed value?', v, 'Top of the stack.'); } } return out; }
  });

  D('convert-binary-number-in-a-linked-list-to-integer', {
    t: 'Convert Binary Number in a Linked List to Integer',
    r: 'Walk the list: value = value × 2 + bit.',
    g: R => ({ head: [R.int(0, 1), ...R.ints(R.int(0, 5), 0, 1)] }),
    s(I, T) { let v = 0; I.head.forEach((b, i) => { v = v * 2 + b; if (i < 7) { T.at({ list: A(I.head, { i }) }); T.n('Value so far?', v, 'Shift left, add the bit.'); } }); return v; }
  });
})();
