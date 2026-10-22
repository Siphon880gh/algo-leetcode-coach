/* Linked List games: move and rewire pointers in the right order. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;

  function L(v, o) { var p = { t: 'list', v: v.slice() }; for (var k in o) p[k] = o[k]; return p; }
  function seq(n) { var a = []; for (var i = 0; i < n; i++) a.push(i + 1 < n ? i + 1 : -1); return a; }

  LC.register('reverse-linked-list', {
    title: 'Reverse Linked List: save, flip, advance',
    rule: 'For each node: save next = curr.next, point curr.next back at prev, then move prev = curr and curr = next. Flipping before saving loses the rest of the list.',
    make: function (rng, round) {
      var v = rng.distinct(5 + (round > 1 ? 1 : 0), 1, 9), n = v.length, nx = seq(n);
      var t = new LC.Trace();
      t.setup = 'head = ' + v.join(' → ') + ' → ∅';
      var prev = -1, curr = 0, next = null;
      var ops = [['save', 'next = curr.next'], ['flip', 'curr.next = prev'], ['adv', 'prev = curr, curr = next']];
      function view() { var ptr = { prev: prev, curr: curr }; if (next !== null) ptr.next = next; return V(L(v, { nx: nx, ptr: ptr, nullLeft: true, label: 'nodes (arrows show next)' })); }
      while (curr !== -1) {
        t.act(view(), 'curr = ' + v[curr] + '. First operation?', ops, 'save', { flip: 'If you flip first, curr.next no longer points to the rest of the list and you lose it.', adv: 'next has not been saved yet, and curr has not been flipped.' }, 'Saved next = ' + (nx[curr] === -1 ? '∅' : v[nx[curr]]) + '.');
        next = nx[curr];
        t.act(view(), 'next is saved. Now?', ops, 'flip', { save: 'next is already saved.', adv: 'Moving on now would leave curr pointing forward, so it would never be reversed.' }, v[curr] + '.next → ' + (prev === -1 ? '∅' : v[prev]) + '.');
        nx[curr] = prev;
        t.act(view(), v[curr] + ' now points back. Now?', ops, 'adv', { save: 'next is already saved.', flip: 'curr is already flipped.' }, 'Advance.');
        prev = curr; curr = next; next = null;
      }
      t.done(view(), 'New head ' + v[prev] + '. O(n) time, O(1) space.');
      return t;
    }
  });

  LC.register('merge-two-sorted-lists', {
    title: 'Merge Two Sorted Lists: attach the smaller head',
    rule: 'Use a dummy node and a tail. Attach the smaller of the two heads to the tail and advance that list. When one list runs out, attach the rest of the other.',
    make: function (rng, round) {
      var a = rng.sorted(3 + (round > 0 ? 1 : 0), 1, 12), b = rng.sorted(3 + (round > 1 ? 1 : 0), 1, 12);
      var t = new LC.Trace();
      t.setup = 'list1 = ' + a.join(' → ') + '   list2 = ' + b.join(' → ');
      var i = 0, j = 0, out = [], acts = [['A', 'Attach list1 head'], ['B', 'Attach list2 head'], ['RA', 'Attach the rest of list1'], ['RB', 'Attach the rest of list2']];
      function view() { return V(L(a, { ptr: i < a.length ? { l1: i } : {}, cls: (function () { var c = {}; for (var k = 0; k < i; k++) c[k] = 'done'; return c; })(), label: 'list1' }), L(b, { ptr: j < b.length ? { l2: j } : {}, cls: (function () { var c = {}; for (var k = 0; k < j; k++) c[k] = 'done'; return c; })(), label: 'list2' }), L(['d'].concat(out), { ptr: { tail: out.length }, label: 'merged (d = dummy)' })); }
      while (i < a.length && j < b.length) {
        var key = a[i] < b[j] ? 'A' : a[i] > b[j] ? 'B' : ['A', 'B'];
        t.act(view(), a[i] + ' vs ' + b[j] + '.', acts, key, { A: a[i] + ' > ' + b[j] + '.', B: b[j] + ' > ' + a[i] + '.', RA: 'Both lists still have nodes.', RB: 'Both lists still have nodes.' }, 'Attach the smaller.');
        if (a[i] <= b[j]) out.push(a[i++]); else out.push(b[j++]);
      }
      var restA = i < a.length;
      t.act(view(), (restA ? 'list2' : 'list1') + ' is empty.', acts, restA ? 'RA' : 'RB', { A: 'One list is empty; attach the whole remainder in one link.', B: 'One list is empty; attach the whole remainder in one link.', RA: 'list1 is the empty one.', RB: 'list2 is the empty one.' }, 'One pointer link finishes the merge.');
      out = out.concat(restA ? a.slice(i) : b.slice(j));
      i = a.length; j = b.length;
      t.done(V(L(out, { label: 'merged' })), 'Merged: ' + out.join(' → ') + '. O(m + n).');
      return t;
    }
  });

  function cycleList(rng, round, forceCycle) {
    var n = 6 + round, v = rng.distinct(n, 1, 20), nx = seq(n);
    var cyc = forceCycle || rng.chance(0.65), entry = cyc ? rng.int(0, n - 2) : -1;
    if (cyc) nx[n - 1] = entry;
    return { v: v, nx: nx, entry: entry, cyc: cyc };
  }

  LC.register('linked-list-cycle', {
    title: 'Linked List Cycle: the fast runner laps the slow one',
    rule: 'slow moves 1 node, fast moves 2. If fast reaches the end (∅), there is no cycle. If they ever land on the same node, there is a cycle.',
    make: function (rng, round) {
      var g = cycleList(rng, round), v = g.v, nx = g.nx;
      var t = new LC.Trace();
      t.setup = 'list: ' + v.join(' → ') + (g.cyc ? ' → back to ' + v[g.entry] : ' → ∅') + '   (the game knows; your pointers do not)';
      var slow = 0, fast = 0, acts = [['move', 'slow += 1, fast += 2'], ['met', 'They met → cycle'], ['end', 'fast hit ∅ → no cycle']];
      var first = true;
      while (true) {
        var view = V(L(v, { nx: nx, ptr: { slow: slow, fast: fast }, showIdx: true, label: 'list' }));
        if (fast === -1 || nx[fast] === -1) { t.act(view, 'fast cannot take two more steps.', acts, 'end', { move: 'fast has reached the end of the list.', met: 'They have not met; fast reached the end.' }, 'A list with an end has no cycle.'); break; }
        if (!first && slow === fast) { t.act(view, 'slow and fast are on the same node.', acts, 'met', { move: 'They are on the same node already.', end: 'fast has not reached ∅.' }, 'Floyd\'s cycle detection: O(n), O(1).'); break; }
        t.act(view, 'Where are we?', acts, 'move', { met: first ? 'Both start at the head; that does not count.' : 'They are on different nodes.', end: 'fast can still move two steps.' }, 'Step.');
        first = false;
        slow = nx[slow]; fast = nx[nx[fast]];
      }
      t.done(V(L(v, { nx: nx, showIdx: true })), g.cyc ? 'Cycle detected.' : 'No cycle.');
      return t;
    }
  });

  LC.register('linked-list-cycle-ii', {
    title: 'Linked List Cycle II: restart one pointer at the head',
    rule: 'First find a meeting point with slow (1 step) and fast (2 steps). Then put one pointer back at the head and move both 1 step at a time; they meet at the cycle entry.',
    make: function (rng, round) {
      var g = cycleList(rng, round, true), v = g.v, nx = g.nx;
      var t = new LC.Trace();
      t.setup = 'list: ' + v.join(' → ') + ' → back into the list somewhere';
      var slow = 0, fast = 0, first = true, acts = [['move', 'slow += 1, fast += 2'], ['met', 'They met: switch phase']];
      while (true) {
        var view = V(L(v, { nx: nx, ptr: { slow: slow, fast: fast }, showIdx: true, label: 'phase 1: find a meeting point' }));
        if (!first && slow === fast) { t.act(view, 'Same node?', acts, 'met', 'slow and fast are on the same node.', 'Met at ' + v[slow] + '.'); break; }
        t.act(view, 'Phase 1.', acts, 'move', first ? 'Both start at the head; that does not count.' : 'They are on different nodes.', 'Step.');
        first = false; slow = nx[slow]; fast = nx[nx[fast]];
      }
      var p = 0, acts2 = [['move', 'Move head-pointer and slow by 1'], ['entry', 'They met: this is the entry'], ['fast2', 'Move slow by 2']];
      while (true) {
        var view2 = V(L(v, { nx: nx, ptr: { 'from head': p, slow: slow }, showIdx: true, label: 'phase 2: walk in lockstep' }));
        if (p === slow) { t.act(view2, 'Same node?', acts2, 'entry', { move: 'They already meet here.', fast2: 'Phase 2 uses single steps only.' }, 'Entry = ' + v[p] + '.'); break; }
        t.act(view2, 'Phase 2.', acts2, 'move', { entry: 'They are on different nodes.', fast2: 'In phase 2 both pointers move one step; the head distance equals the meeting distance to the entry.' }, 'Step.');
        p = nx[p]; slow = nx[slow];
      }
      t.done(V(L(v, { nx: nx, showIdx: true, cls: (function () { var c = {}; c[g.entry] = 'ok'; return c; })() })), 'Cycle begins at ' + v[g.entry] + '.');
      return t;
    }
  });

  LC.register('middle-of-the-linked-list', {
    title: 'Middle of the Linked List: fast is twice as far',
    rule: 'Move slow one step and fast two. When fast is at the last node or past it, slow is at the middle (the second middle for even lengths).',
    make: function (rng, round) {
      var n = 5 + rng.int(0, 1) + round, v = rng.distinct(n, 1, 20);
      var t = new LC.Trace();
      t.setup = 'head = ' + v.join(' → ');
      var slow = 0, fast = 0, acts = [['move', 'slow += 1, fast += 2'], ['stop', 'Stop: slow is the middle']];
      while (true) {
        var done = fast === -1 || fast >= n - 1;
        var ptr = { slow: slow }; if (fast === -1 || fast >= n) ptr.fast = -1; else ptr.fast = fast;
        t.act(V(L(v, { ptr: ptr, label: 'list' })), fast >= n ? 'fast fell off the end.' : 'fast is at ' + v[fast] + '.', acts, done ? 'stop' : 'move', done ? 'fast cannot take two more steps.' : 'fast can still take two steps.', done ? 'Middle = ' + v[slow] + '.' : 'Step.');
        if (done) break;
        slow += 1; fast += 2; if (fast >= n) fast = n;
      }
      t.done(V(L(v, { cls: (function () { var c = {}; c[slow] = 'ok'; return c; })() })), 'Middle node ' + v[slow] + '. One pass.');
      return t;
    }
  });

  LC.register('remove-nth-node-from-end-of-list', {
    title: 'Remove Nth Node From End: give fast a head start',
    rule: 'From a dummy node, move fast n + 1 steps first. Then move both until fast falls off the end: slow now sits right before the node to delete.',
    make: function (rng, round) {
      var size = 5 + round, v = ['d'].concat(rng.distinct(size, 1, 20)), k = rng.int(1, size);
      var t = new LC.Trace();
      t.setup = 'head = ' + v.slice(1).join(' → ') + '   n = ' + k + '   (d = dummy)';
      var fast = 0, slow = 0, gap = 0, acts = [['fast', 'Move fast only'], ['both', 'Move both'], ['cut', 'slow.next = slow.next.next']];
      function view() { return V(L(v, { ptr: { slow: slow, fast: fast >= v.length ? -1 : fast }, label: 'list' }), P.vars([['gap', gap], ['n + 1', k + 1]])); }
      while (gap < k + 1) { t.act(view(), 'gap = ' + gap + '.', acts, 'fast', { both: 'fast needs a lead of n + 1 = ' + (k + 1) + ' first.', cut: 'slow is not in position yet.' }, 'fast moves.'); fast++; gap++; }
      while (fast < v.length) { t.act(view(), 'Lead built. fast is at ' + v[fast] + '.', acts, 'both', { fast: 'The lead is already n + 1; keep it fixed by moving both.', cut: 'fast has not fallen off the end yet.' }, 'Both move.'); fast++; slow++; }
      t.act(view(), 'fast is ∅.', acts, 'cut', { fast: 'fast is done.', both: 'fast is already past the end.' }, 'Removed ' + v[slow + 1] + '.');
      var out = v.slice(1, slow + 1).concat(v.slice(slow + 2));
      t.done(V(L(out, { label: 'result' })), 'Removed the ' + k + 'th node from the end in one pass.');
      return t;
    }
  });

  LC.register('reverse-linked-list-ii', {
    title: 'Reverse Linked List II: pull nodes to the front',
    rule: 'Walk pre to the node before position left. Then right − left times, take the node after curr and move it right after pre. The sublist reverses in place.',
    make: function (rng, round) {
      var n = 6 + round, order = ['d'].concat(rng.distinct(n, 1, 20)), left = rng.int(1, n - 2), right = rng.int(left + 1, n);
      var t = new LC.Trace();
      t.setup = 'head = ' + order.slice(1).join(' → ') + '   left = ' + left + '   right = ' + right + '   (positions are 1-based; d = dummy)';
      var pre = 0, acts = [['walk', 'Advance pre'], ['pull', 'Move curr.next to just after pre'], ['done', 'Done']];
      function cls() { var o = {}; for (var i = left; i <= right; i++) o[i] = 'warn'; return o; }
      while (pre < left - 1) { t.act(V(L(order, { ptr: { pre: pre }, cls: cls(), label: 'list' })), 'pre is at position ' + pre + '.', acts, 'walk', { pull: 'pre must sit right before position ' + left + ' first.', done: 'Nothing has been reversed yet.' }, 'pre moves.'); pre++; }
      var curr = pre + 1;
      for (var m = 0; m < right - left; m++) {
        t.act(V(L(order, { ptr: { pre: pre, curr: curr }, cls: cls(), label: 'list' })), 'Pull ' + (m + 1) + ' of ' + (right - left) + '.', acts, 'pull', { walk: 'pre is already in place.', done: (right - left - m) + ' more node(s) still need to move.' }, 'Moved ' + order[curr + 1] + ' to the front.');
        var node = order.splice(curr + 1, 1)[0]; order.splice(pre + 1, 0, node); curr++;
      }
      t.act(V(L(order, { ptr: { pre: pre }, cls: cls(), label: 'list' })), 'All pulls done?', acts, 'done', { walk: 'pre stays put.', pull: 'You already moved right − left = ' + (right - left) + ' nodes.' }, 'Sublist reversed.');
      t.done(V(L(order.slice(1), { label: 'result' })), 'Result ' + order.slice(1).join(' → ') + '. One pass.');
      return t;
    }
  });

  LC.register('swap-nodes-in-pairs', {
    title: 'Swap Nodes in Pairs: swap, then jump two',
    rule: 'With prev before the pair: prev.next = second, first.next = second.next, second.next = first. Then prev jumps to first (now second in the pair). Stop when fewer than two nodes remain.',
    make: function (rng, round) {
      var n = 5 + round, order = ['d'].concat(rng.distinct(n, 1, 20));
      var t = new LC.Trace();
      t.setup = 'head = ' + order.slice(1).join(' → ') + '   (d = dummy)';
      var prev = 0, acts = [['swap', 'Swap the pair after prev'], ['jump', 'prev jumps two'], ['done', 'Done']];
      var swapped = false;
      while (true) {
        var left = order.length - 1 - prev;
        var view = V(L(order, { ptr: { prev: prev }, cls: (function () { var c = {}; if (left >= 2) { c[prev + 1] = 'hit'; c[prev + 2] = 'hit'; } return c; })(), label: 'list' }));
        if (swapped) { t.act(view, 'Pair swapped.', acts, 'jump', { swap: 'This pair is already swapped; swapping again undoes it.', done: 'prev has not moved past this pair.' }, 'prev → ' + order[prev + 2] + '.'); prev += 2; swapped = false; continue; }
        if (left < 2) { t.act(view, left + ' node(s) after prev.', acts, 'done', { swap: 'A pair needs two nodes.', jump: 'There is no pair left to jump over.' }, 'Finished.'); break; }
        t.act(view, 'Two nodes after prev.', acts, 'swap', { jump: 'Swap this pair before moving on.', done: 'Two nodes remain.' }, 'Swapped ' + order[prev + 1] + ' and ' + order[prev + 2] + '.');
        var tmp = order[prev + 1]; order[prev + 1] = order[prev + 2]; order[prev + 2] = tmp; swapped = true;
      }
      t.done(V(L(order.slice(1), { label: 'result' })), 'Result ' + order.slice(1).join(' → ') + '.');
      return t;
    }
  });

  LC.register('remove-duplicates-from-sorted-list', {
    title: 'Remove Duplicates from Sorted List: skip equal neighbors',
    rule: 'If curr.next has the same value, unlink it (curr.next = curr.next.next) and stay put. Otherwise advance curr.',
    make: function (rng, round) {
      var v = [], x = rng.int(1, 3); for (var i = 0; i < 7 + round; i++) { v.push(x); if (rng.chance(0.5)) x += rng.int(1, 2); }
      var t = new LC.Trace();
      t.setup = 'head = ' + v.join(' → ');
      var curr = 0, acts = [['skip', 'Unlink curr.next'], ['adv', 'Advance curr']];
      while (curr < v.length - 1) {
        var same = v[curr] === v[curr + 1];
        t.act(V(L(v, { ptr: { curr: curr }, cls: (function () { var c = {}; c[curr + 1] = same ? 'bad' : 'warn'; return c; })(), label: 'list' })), v[curr] + ' then ' + v[curr + 1] + '.', acts, same ? 'skip' : 'adv',
          same ? 'Equal values: the next node is a duplicate.' : 'Different values: nothing to remove here.', same ? 'Unlinked; check the new next.' : 'Advance.');
        if (same) v.splice(curr + 1, 1); else curr++;
      }
      t.done(V(L(v, { label: 'result' })), 'Result ' + v.join(' → ') + '.');
      return t;
    }
  });

  LC.register('remove-linked-list-elements', {
    title: 'Remove Linked List Elements: a dummy head makes it uniform',
    rule: 'Start curr at a dummy node before head. If curr.next.val == val, unlink it and stay; otherwise advance. The dummy means removing the real head is no special case.',
    make: function (rng, round) {
      var val = rng.int(1, 4), v = ['d'].concat(rng.ints(7 + round, 1, 5)); v[1] = rng.chance(0.6) ? val : v[1];
      var t = new LC.Trace();
      t.setup = 'head = ' + v.slice(1).join(' → ') + '   val = ' + val + '   (d = dummy)';
      var curr = 0, acts = [['rm', 'Unlink curr.next'], ['adv', 'Advance curr']];
      while (curr < v.length - 1) {
        var hit = v[curr + 1] === val;
        t.act(V(L(v, { ptr: { curr: curr }, cls: (function () { var c = {}; c[curr + 1] = hit ? 'bad' : 'warn'; return c; })(), label: 'list' }), P.vars([['val', val]])), 'curr.next = ' + v[curr + 1] + '.', acts, hit ? 'rm' : 'adv',
          hit ? v[curr + 1] + ' equals val.' : v[curr + 1] + ' is not val.', hit ? 'Unlinked; stay and check the new next.' : 'Advance.');
        if (hit) v.splice(curr + 1, 1); else curr++;
      }
      t.done(V(L(v.slice(1), { label: 'result' })), 'Result ' + (v.length > 1 ? v.slice(1).join(' → ') : '∅') + '.');
      return t;
    }
  });

  LC.register('odd-even-linked-list', {
    title: 'Odd Even Linked List: by position, not by value',
    rule: 'Nodes at odd POSITIONS (1st, 3rd, …) form one chain and even positions the other. Weave both chains in one pass, then attach the even chain after the odd tail.',
    make: function (rng, round) {
      var v = rng.ints(6 + round, 1, 9);
      var t = new LC.Trace();
      t.setup = 'head = ' + v.join(' → ');
      var odd = [], even = [], acts = [['odd', 'Odd chain'], ['even', 'Even chain']];
      for (var i = 0; i < v.length; i++) {
        var pos = i + 1, key = pos % 2 ? 'odd' : 'even';
        t.act(V(L(v, { ptr: { node: i }, cls: (function () { var c = {}; c[i] = 'hit'; return c; })(), label: 'input (position 1 is the head)' }), L(odd.length ? odd : ['∅'], { label: 'odd chain' }), L(even.length ? even : ['∅'], { label: 'even chain' })), 'Node at position ' + pos + ' (value ' + v[i] + ').', acts, key,
          'Odd/even here means POSITION ' + pos + ', not the value ' + v[i] + '.', 'Position ' + pos + ' → ' + key + '.');
        if (key === 'odd') odd.push(v[i]); else even.push(v[i]);
      }
      t.act(V(L(odd, { label: 'odd chain' }), L(even, { label: 'even chain' })), 'Both chains built. Finish?', [['oe', 'odd tail.next = even head'], ['eo', 'even tail.next = odd head']], 'oe', 'The result starts with the odd chain (it holds the original head).', 'Joined.');
      t.done(V(L(odd.concat(even), { label: 'result' })), 'Result ' + odd.concat(even).join(' → ') + '. O(n), O(1).');
      return t;
    }
  });
})();
