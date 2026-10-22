/* Binary tree games: click nodes in the order the traversal visits them, or steer a BST walk. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;
  var MAX = 15;

  function has(tr, i) { return i < tr.length && tr[i] !== null && tr[i] !== undefined; }
  function randTree(rng, minN, maxN) {
    var tr;
    do {
      tr = []; for (var i = 0; i < MAX; i++) tr.push(null);
      tr[0] = 0; var count = 1;
      for (i = 0; i < 7; i++) {
        if (!has(tr, i)) continue;
        var depth = Math.floor(Math.log2(i + 1)), p = depth === 0 ? 0.95 : depth === 1 ? 0.8 : 0.55;
        if (rng.chance(p)) { tr[2 * i + 1] = 0; count++; }
        if (rng.chance(p)) { tr[2 * i + 2] = 0; count++; }
      }
    } while (count < minN || count > maxN);
    var vals = rng.distinct(count, 1, 30), k = 0;
    for (i = 0; i < MAX; i++) if (has(tr, i)) tr[i] = vals[k++];
    return tr;
  }
  function randBST(rng, minN, maxN) {
    for (var tries = 0; tries < 200; tries++) {
      var n = rng.int(minN, maxN), vals = rng.distinct(n, 1, 40), tr = [], ok = true;
      for (var i = 0; i < MAX; i++) tr.push(null);
      vals.forEach(function (v) { if (!ok) return; var j = 0; while (j < MAX && has(tr, j)) j = v < tr[j] ? 2 * j + 1 : 2 * j + 2; if (j >= MAX) ok = false; else tr[j] = v; });
      if (ok) return tr;
    }
    return [8, 4, 12, 2, 6, 10, 14, null, null, null, null, null, null, null, null];
  }
  function order(tr, kind) {
    var out = [];
    (function go(i) {
      if (!has(tr, i)) return;
      if (kind === 'pre') out.push(i);
      go(2 * i + 1);
      if (kind === 'in') out.push(i);
      go(2 * i + 2);
      if (kind === 'post') out.push(i);
    })(0);
    return out;
  }
  function levels(tr) { var out = []; for (var i = 0; i < MAX; i++) if (has(tr, i)) { var d = Math.floor(Math.log2(i + 1)); (out[d] = out[d] || []).push(i); } return out.filter(function (x) { return x; }); }
  function T(tr, cls, tag, label) { return { t: 'tree', v: tr, cls: cls || {}, tag: tag || {}, pick: 't', label: label || 'tree', wide: true }; }

  var WHY = {
    'in': 'Inorder is left subtree → node → right subtree. Finish everything on the left first.',
    pre: 'Preorder is node → left subtree → right subtree. Visit a node before its children.',
    post: 'Postorder is left subtree → right subtree → node. A node comes after both its subtrees.'
  };
  function traversal(slug, kind, title, rule) {
    LC.register(slug, {
      title: title, rule: rule,
      make: function (rng, round) {
        var tr = randTree(rng, 6 + round, 9 + round), seq = order(tr, kind);
        var t = new LC.Trace();
        t.setup = 'Click the nodes in ' + (kind === 'in' ? 'inorder' : kind === 'pre' ? 'preorder' : 'postorder') + '.';
        var cls = {}, tag = {}, out = [];
        seq.forEach(function (node, k) {
          var wm = {}; for (var i = 0; i < MAX; i++) if (has(tr, i) && i !== node) wm['t:' + i] = cls[i] ? 'Already visited.' : WHY[kind];
          t.pick(V(T(tr, cls, tag), P.arr(out, { label: 'output' })), 'Visit #' + (k + 1) + ': which node?', 't:' + node, { wrongMap: wm, hint: 'Click a node.', note: tr[node] + '.' });
          cls[node] = 'done'; tag[node] = String(k + 1); out.push(tr[node]);
        });
        t.done(V(T(tr, cls, tag), P.arr(out, { label: 'output' })), 'Output ' + LC.fmt(out) + '. O(n) time, O(h) stack.');
        return t;
      }
    });
  }
  traversal('binary-tree-inorder-traversal', 'in', 'Binary Tree Inorder Traversal: left, node, right', 'Go as far left as you can, visit the node, then do the same in its right subtree. With a stack: push lefts, pop and visit, then move right.');
  traversal('binary-tree-preorder-traversal', 'pre', 'Binary Tree Preorder Traversal: node, left, right', 'Visit the node first, then its whole left subtree, then its right subtree. With a stack: pop, visit, push right then left.');
  traversal('binary-tree-postorder-traversal', 'post', 'Binary Tree Postorder Traversal: left, right, node', 'A node is visited only after both of its subtrees are finished, so leaves come first and the root comes last.');

  LC.register('binary-tree-level-order-traversal', {
    title: 'Binary Tree Level Order: a queue, one level at a time',
    rule: 'BFS: dequeue nodes left to right within a level, enqueueing their children. Snapshot the queue size first so you know where each level ends.',
    make: function (rng, round) {
      var tr = randTree(rng, 6 + round, 9 + round), lv = levels(tr);
      var t = new LC.Trace();
      t.setup = 'Click nodes in BFS order: level by level, left to right.';
      var cls = {}, tag = {}, out = [], k = 0;
      lv.forEach(function (level, d) {
        var row = [];
        level.forEach(function (node) {
          var wm = {}; for (var i = 0; i < MAX; i++) if (has(tr, i) && i !== node) { var di = Math.floor(Math.log2(i + 1)); wm['t:' + i] = cls[i] ? 'Already visited.' : di > d ? 'That is a deeper level; finish level ' + d + ' first.' : 'Within a level, BFS goes left to right.'; }
          t.pick(V(T(tr, cls, tag), P.vars([['levels', out.length ? out.map(LC.fmt).join(' ') : '—'], ['current', LC.fmt(row)]])), 'Level ' + d + ': next node?', 't:' + node, { wrongMap: wm, note: tr[node] + '.' });
          cls[node] = 'done'; tag[node] = String(++k); row.push(tr[node]);
        });
        out.push(row);
      });
      t.done(V(T(tr, cls, tag), P.vars([['levels', out.map(LC.fmt).join(' ')]])), 'Levels ' + out.map(LC.fmt).join(' ') + '.');
      return t;
    }
  });

  LC.register('binary-tree-zigzag-level-order-traversal', {
    title: 'Zigzag Level Order: flip direction every level',
    rule: 'Do a normal BFS level by level, but read level 0 left→right, level 1 right→left, level 2 left→right, and so on.',
    make: function (rng, round) {
      var tr = randTree(rng, 6 + round, 9 + round), lv = levels(tr);
      var t = new LC.Trace();
      t.setup = 'Click nodes in zigzag order.';
      var cls = {}, tag = {}, out = [], k = 0;
      lv.forEach(function (level, d) {
        var seq = d % 2 ? level.slice().reverse() : level, row = [];
        seq.forEach(function (node) {
          var wm = {}; for (var i = 0; i < MAX; i++) if (has(tr, i) && i !== node) { var di = Math.floor(Math.log2(i + 1)); wm['t:' + i] = cls[i] ? 'Already visited.' : di !== d ? 'Finish level ' + d + ' first.' : 'Level ' + d + ' reads ' + (d % 2 ? 'right → left' : 'left → right') + '.'; }
          t.pick(V(T(tr, cls, tag), P.vars([['levels', out.length ? out.map(LC.fmt).join(' ') : '—'], ['direction', d % 2 ? '←' : '→']])), 'Level ' + d + ' (' + (d % 2 ? 'right → left' : 'left → right') + '): next node?', 't:' + node, { wrongMap: wm, note: tr[node] + '.' });
          cls[node] = 'done'; tag[node] = String(++k); row.push(tr[node]);
        });
        out.push(row);
      });
      t.done(V(T(tr, cls, tag)), 'Zigzag ' + out.map(LC.fmt).join(' ') + '.');
      return t;
    }
  });

  LC.register('binary-tree-level-order-traversal-ii', {
    title: 'Level Order Bottom Up: BFS, then reverse the levels',
    rule: 'Run a normal BFS that groups nodes by level, then reverse the list of levels (or insert each level at the front). Nodes inside a level stay left to right.',
    minSteps: 3,
    make: function (rng, round) {
      var tr = randTree(rng, 6 + round, 9 + round), lv = levels(tr);
      var t = new LC.Trace();
      t.setup = 'Collect each level with BFS, then decide the output order.';
      var cls = {}, out = [];
      lv.forEach(function (level, d) {
        var ans = level.map(function (x) { return 't:' + x; }), aset = {}; ans.forEach(function (x) { aset[x] = 1; });
        var wm = {}; for (var i = 0; i < MAX; i++) if (has(tr, i) && !aset['t:' + i]) wm['t:' + i] = cls[i] ? 'Already collected.' : 'BFS finishes level ' + d + ' before going deeper.';
        t.pick(V(T(tr, cls)), 'Collect level ' + d + ': click all its nodes.', ans, { all: true, wrongMap: wm, note: 'Level ' + d + ' = ' + LC.fmt(level.map(function (x) { return tr[x]; })) + '.' });
        level.forEach(function (x) { cls[x] = 'done'; });
        out.push(level.map(function (x) { return tr[x]; }));
      });
      t.act(V(T(tr, cls), P.vars([['BFS levels', out.map(LC.fmt).join(' ')]])), 'BFS is done. What do you return?', [['as', 'The levels as collected'], ['rev', 'The levels reversed']], 'rev', 'Bottom-up means the deepest level comes first.', 'Reversed.');
      t.done(V(T(tr, cls), P.vars([['answer', out.slice().reverse().map(LC.fmt).join(' ')]])), 'Answer ' + out.slice().reverse().map(LC.fmt).join(' ') + '.');
      return t;
    }
  });

  LC.register('binary-tree-right-side-view', {
    title: 'Binary Tree Right Side View: last node of each level',
    rule: 'Do BFS level by level. The node you see from the right is the LAST node of each level, even if it is a left child.',
    rounds: 4, minSteps: 3,
    make: function (rng, round) {
      var tr = randTree(rng, 6 + Math.min(round, 2), 9 + Math.min(round, 2)), lv = levels(tr);
      var t = new LC.Trace();
      t.setup = 'Click the node visible from the right on each level.';
      var cls = {}, out = [];
      lv.forEach(function (level, d) {
        var node = level[level.length - 1];
        var wm = {}; for (var i = 0; i < MAX; i++) if (has(tr, i) && i !== node) { var di = Math.floor(Math.log2(i + 1)); wm['t:' + i] = di !== d ? 'That node is on level ' + di + '; this is level ' + d + '.' : 'Another node on this level is further right, so it hides this one.'; }
        t.pick(V(T(tr, cls), P.arr(out, { label: 'right view' })), 'Level ' + d + ': which node do you see from the right?', 't:' + node, { wrongMap: wm, note: tr[node] + '.' });
        cls[node] = 'ok'; out.push(tr[node]);
      });
      t.done(V(T(tr, cls), P.arr(out, { label: 'right view' })), 'Right side view ' + LC.fmt(out) + '.');
      return t;
    }
  });

  LC.register('kth-smallest-element-in-a-bst', {
    title: 'Kth Smallest Element in a BST: inorder is sorted',
    rule: 'An inorder traversal of a BST visits values in increasing order. Count visits; the k-th node visited is the answer, and you can stop there.',
    make: function (rng, round) {
      var tr = randBST(rng, 6 + round, 9 + round), seq = order(tr, 'in'), k = rng.int(2, Math.min(seq.length, 5));
      var t = new LC.Trace();
      t.setup = 'k = ' + k + '   Click nodes in inorder until you reach the k-th.';
      var cls = {}, tag = {};
      for (var j = 0; j < k; j++) {
        var node = seq[j], wm = {};
        for (var i = 0; i < MAX; i++) if (has(tr, i) && i !== node) wm['t:' + i] = cls[i] ? 'Already counted.' : 'Inorder goes left first; that node is not the next smallest.';
        t.pick(V(T(tr, cls, tag), P.vars([['count', j], ['k', k]])), 'Visit #' + (j + 1) + '?', 't:' + node, { wrongMap: wm, note: tr[node] + (j + 1 === k ? ' is the k-th visit.' : '.') });
        cls[node] = 'done'; tag[node] = String(j + 1);
      }
      t.num(V(T(tr, cls, tag), P.vars([['count', k]])), 'k-th smallest value?', tr[seq[k - 1]], { wrong: 'It is the node you visited k-th.', note: 'Stop early: O(h + k).' });
      t.done(V(T(tr, cls, tag)), 'Answer ' + tr[seq[k - 1]] + '.');
      return t;
    }
  });

  var WALK = [['L', 'Go left'], ['R', 'Go right'], ['F', 'Found it'], ['N', 'Hit null']];
  LC.register('search-in-a-binary-search-tree', {
    title: 'Search in a BST: one comparison per level',
    rule: 'At each node: equal → found. Target smaller → only the left subtree can hold it. Bigger → only the right. Reaching null means it is not in the tree.',
    rounds: 5, minSteps: 3,
    make: function (rng, round) {
      var tr = randBST(rng, 7, 10), vals = tr.filter(function (x) { return x !== null; });
      var target = rng.chance(0.7) ? rng.pick(vals) : rng.int(1, 40);
      var t = new LC.Trace();
      t.setup = 'val = ' + target;
      var i = 0, cls = {};
      while (true) {
        var c = LC.clone(cls); if (has(tr, i)) c[i] = 'hit';
        if (!has(tr, i)) { t.act(V(T(tr, c), P.vars([['val', target]])), 'The next child is null.', WALK, 'N', 'There is no node here.', 'Not found: return null.'); break; }
        var key = tr[i] === target ? 'F' : target < tr[i] ? 'L' : 'R';
        t.act(V(T(tr, c), P.vars([['val', target]])), 'At ' + tr[i] + '.', WALK, key, { F: tr[i] + ' ≠ ' + target + '.', L: target + ' > ' + tr[i] + ', so the left subtree (all smaller) cannot hold it.', R: target + ' < ' + tr[i] + ', so the right subtree (all bigger) cannot hold it.', N: 'You are on a real node.' }, key === 'F' ? 'Found.' : 'Discard the other subtree.');
        if (key === 'F') { cls[i] = 'ok'; break; }
        cls[i] = 'done'; i = key === 'L' ? 2 * i + 1 : 2 * i + 2;
        if (i >= MAX) { t.act(V(T(tr, cls), P.vars([['val', target]])), 'The next child is null.', WALK, 'N', 'There is no node here.', 'Not found.'); break; }
      }
      t.done(V(T(tr, cls)), 'O(h) search.');
      return t;
    }
  });

  LC.register('insert-into-a-binary-search-tree', {
    title: 'Insert into a BST: fall into the empty spot',
    rule: 'Walk like a search (smaller → left, bigger → right). The first null child you reach is exactly where the new value belongs.',
    rounds: 5, minSteps: 3,
    make: function (rng, round) {
      var tr, val, path;
      do {
        tr = randBST(rng, 5, 8);
        var vals = tr.filter(function (x) { return x !== null; });
        do { val = rng.int(1, 40); } while (vals.indexOf(val) !== -1);
        path = 0; while (path < MAX && has(tr, path)) path = val < tr[path] ? 2 * path + 1 : 2 * path + 2;
      } while (path >= MAX);
      var t = new LC.Trace();
      t.setup = 'insert val = ' + val;
      var acts = [['L', 'Go left'], ['R', 'Go right'], ['IL', 'Insert as left child'], ['IR', 'Insert as right child']];
      var i = 0, cls = {};
      while (true) {
        var goLeft = val < tr[i], child = goLeft ? 2 * i + 1 : 2 * i + 2, empty = !has(tr, child);
        var key = goLeft ? (empty ? 'IL' : 'L') : (empty ? 'IR' : 'R');
        var c = LC.clone(cls); c[i] = 'hit';
        t.act(V(T(tr, c), P.vars([['val', val]])), 'At ' + tr[i] + '. ' + (goLeft ? 'Left' : 'Right') + ' child is ' + (empty ? 'empty' : tr[child]) + '.', acts, key,
          { L: goLeft ? 'The left child is empty; insert there.' : val + ' > ' + tr[i] + '.', R: !goLeft ? 'The right child is empty; insert there.' : val + ' < ' + tr[i] + '.', IL: goLeft ? 'The left spot is taken; keep walking.' : val + ' > ' + tr[i] + ', so it belongs on the right.', IR: !goLeft ? 'The right spot is taken; keep walking.' : val + ' < ' + tr[i] + ', so it belongs on the left.' },
          empty ? 'Insert ' + val + ' here.' : 'Keep walking.');
        cls[i] = 'done';
        if (empty) { tr[child] = val; cls[child] = 'ok'; break; }
        i = child;
      }
      t.done(V(T(tr, cls)), 'Inserted as a leaf in O(h).');
      return t;
    }
  });

  LC.register('lowest-common-ancestor-of-a-binary-search-tree', {
    title: 'LCA of a BST: the split point',
    rule: 'From the root: if p and q are both smaller, go left; both bigger, go right. Otherwise they split here (or one of them is this node): this node is the LCA.',
    rounds: 5, minSteps: 2,
    make: function (rng, round) {
      var tr = randBST(rng, 7, 11), nodes = []; for (var x = 0; x < MAX; x++) if (has(tr, x)) nodes.push(x);
      var pair = rng.shuffle(nodes).slice(0, 2), p = tr[pair[0]], q = tr[pair[1]];
      var t = new LC.Trace();
      t.setup = 'p = ' + p + '   q = ' + q;
      var acts = [['L', 'Both smaller: go left'], ['R', 'Both bigger: go right'], ['S', 'Split here: LCA']];
      var i = 0, cls = {}; cls[pair[0]] = 'blue'; cls[pair[1]] = 'blue';
      while (true) {
        var v = tr[i], key = p < v && q < v ? 'L' : p > v && q > v ? 'R' : 'S';
        var c = LC.clone(cls); c[i] = 'hit';
        t.act(V(T(tr, c), P.vars([['p', p], ['q', q]])), 'At ' + v + '.', acts, key, { L: 'Not both smaller than ' + v + '.', R: 'Not both bigger than ' + v + '.', S: key === 'L' ? 'Both are smaller, so the LCA is deeper on the left.' : 'Both are bigger, so the LCA is deeper on the right.' }, key === 'S' ? 'LCA = ' + v + '.' : 'Go deeper.');
        if (key === 'S') { cls[i] = 'ok'; break; }
        i = key === 'L' ? 2 * i + 1 : 2 * i + 2;
      }
      t.done(V(T(tr, cls)), 'LCA = ' + tr[i] + '. O(h).');
      return t;
    }
  });

  LC.register('validate-binary-search-tree', {
    title: 'Validate BST: every node inherits bounds',
    rule: 'Pass down (low, high). Going left lowers high to the parent\'s value; going right raises low. A node is valid only if low < val < high, not just compared to its parent.',
    make: function (rng, round) {
      var tr = randBST(rng, 6 + round, 9 + round);
      var broken = rng.chance(0.6);
      if (broken) {
        var deep = []; for (var x = 3; x < MAX; x++) if (has(tr, x)) deep.push(x);
        if (deep.length) {
          var d = rng.pick(deep), parent = Math.floor((d - 1) / 2), grand = Math.floor((parent - 1) / 2);
          var isLeft = d === 2 * parent + 1, parentIsLeft = parent === 2 * grand + 1;
          var all = tr.filter(function (y) { return y !== null; }), nv;
          if (isLeft && !parentIsLeft) nv = tr[grand] - rng.int(1, 3); else if (!isLeft && parentIsLeft) nv = tr[grand] + rng.int(1, 3); else nv = isLeft ? tr[parent] - 1 : tr[parent] + 1;
          if (all.indexOf(nv) === -1 && nv > 0) tr[d] = nv; else broken = false;
        } else broken = false;
      }
      var t = new LC.Trace();
      t.setup = 'Check each node against its inherited (low, high) bounds, in preorder.';
      var cls = {}, tag = {}, bad = false, acts = [['ok', 'Inside the bounds'], ['bad', 'Out of bounds → false']];
      var stack = [[0, -Infinity, Infinity]];
      while (stack.length && !bad) {
        var top = stack.pop(), i = top[0], lo = top[1], hi = top[2];
        if (!has(tr, i)) continue;
        var inside = lo < tr[i] && tr[i] < hi, c = LC.clone(cls); c[i] = 'hit';
        var tg = LC.clone(tag); tg[i] = '(' + LC.fmt(lo) + ', ' + LC.fmt(hi) + ')';
        t.act(V(T(tr, c, tg)), 'Node ' + tr[i] + ' with bounds (' + LC.fmt(lo) + ', ' + LC.fmt(hi) + ').', acts, inside ? 'ok' : 'bad', inside ? LC.fmt(lo) + ' < ' + tr[i] + ' < ' + LC.fmt(hi) + '.' : tr[i] + ' is outside (' + LC.fmt(lo) + ', ' + LC.fmt(hi) + '), even if it looks fine next to its parent.', inside ? 'Children inherit: left (' + LC.fmt(lo) + ', ' + tr[i] + '), right (' + tr[i] + ', ' + LC.fmt(hi) + ').' : 'Invalid BST.');
        cls[i] = inside ? 'ok' : 'bad';
        if (!inside) { bad = true; break; }
        if (2 * i + 2 < MAX) stack.push([2 * i + 2, tr[i], hi]);
        if (2 * i + 1 < MAX) stack.push([2 * i + 1, lo, tr[i]]);
      }
      t.done(V(T(tr, cls)), bad ? 'False: not a valid BST.' : 'True: every node fits its bounds.');
      return t;
    }
  });
})();
