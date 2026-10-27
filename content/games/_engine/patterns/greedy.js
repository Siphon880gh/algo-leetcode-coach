/* Greedy games: one local rule, applied left to right, never revisited. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view, fmt = LC.fmt;

  LC.register('jump-game', {
    title: 'Jump Game: track the farthest reachable index',
    rule: 'Walk left to right keeping farthest = max(farthest, i + nums[i]). If you ever stand at an i beyond farthest, you are stuck. Once farthest reaches the last index, you can win.',
    make: function (rng, round) {
      var n = 7 + round, a = rng.ints(n, 0, 3);
      if (rng.chance(0.5)) a[rng.int(1, n - 3)] = 0;
      var t = new LC.Trace(), far = 0, ans = null;
      t.setup = 'nums = ' + fmt(a);
      function view(i) { var c = {}; for (var k = 0; k <= Math.min(far, n - 1); k++) c[k] = 'ok'; if (i < n) c[i] = 'hit'; return V(P.arr(a, { cls: c, ptr: i < n ? { i: i } : {} }), P.vars([['farthest', far], ['last index', n - 1]])); }
      for (var i = 0; i < n; i++) {
        if (i > far) {
          t.act(view(i), 'i = ' + i + ', farthest = ' + far + '.', [['upd', 'Update farthest'], ['stuck', 'i > farthest: return false']], 'stuck', 'You cannot even stand on index ' + i + ': no earlier jump reaches it.', 'Stuck.');
          ans = false; break;
        }
        var nf = Math.max(far, i + a[i]);
        t.num(view(i), 'i = ' + i + ' is reachable. New farthest = max(' + far + ', ' + i + ' + ' + a[i] + ') = ?', nf, { wrong: 'max(farthest, i + nums[i]).', note: 'farthest = ' + nf + '.' });
        far = nf;
        if (far >= n - 1) {
          t.act(view(i), 'farthest = ' + far + ' at least last index ' + (n - 1) + '.', [['win', 'Return true'], ['go', 'Keep walking']], 'win', 'The last index is already within reach; nothing later can change that.', 'Reachable.');
          ans = true; break;
        }
      }
      t.done(view(n), (ans ? 'True' : 'False') + '. One pass, O(n).');
      return t;
    }
  });

  LC.register('jump-game-ii', {
    title: 'Jump Game II: jump when you reach the end of the current range',
    rule: 'Think BFS by ranges. Scan i, growing farthest = max(farthest, i + nums[i]). When i reaches the end of the current range, you must jump: jumps + 1, and the new range ends at farthest.',
    make: function (rng, round) {
      var n = 7 + round, a;
      do { a = rng.ints(n, 1, 3); var f = 0; for (var k = 0; k < n && k <= f; k++) f = Math.max(f, k + a[k]); } while (f < n - 1);
      var t = new LC.Trace(), far = 0, end = 0, jumps = 0;
      t.setup = 'nums = ' + fmt(a);
      function view(i) { var c = {}; for (var k = 0; k <= Math.min(end, n - 1); k++) c[k] = 'blue'; if (i < n) c[i] = 'hit'; return V(P.arr(a, { cls: c, ptr: i < n ? { i: i } : {} }), P.vars([['jumps', jumps], ['range end', end], ['farthest', far]])); }
      for (var i = 0; i < n - 1; i++) {
        var nf = Math.max(far, i + a[i]);
        var key = i === end ? 'jump' : 'scan';
        far = nf;
        t.act(view(i), 'i = ' + i + ': farthest becomes ' + far + '. Range ends at ' + end + '.', [['scan', 'Keep scanning'], ['jump', 'Jump: jumps + 1, range end = farthest']], key,
          key === 'jump' ? 'i is at the end of the current range: one more jump is required to go further.' : 'i is still inside the current range; jumping now would waste the best option further in the range.',
          key === 'jump' ? 'jumps = ' + (jumps + 1) + ', range end = ' + far + '.' : 'Scan on.');
        if (key === 'jump') { jumps++; end = far; if (end >= n - 1) break; }
      }
      t.num(view(n), 'Minimum jumps?', jumps, { wrong: 'Count the times you hit the range end.', note: jumps + '.' });
      t.done(view(n), jumps + ' jumps. O(n).');
      return t;
    }
  });

  LC.register('gas-station', {
    title: 'Gas Station: a negative tank moves the start past here',
    rule: 'Add gas[i] − cost[i] to the tank. If the tank drops below 0, no station from the current start up to i can work: restart at i + 1 with an empty tank. If total gas at least total cost, the last start is the answer.',
    make: function (rng, round) {
      var n = 5 + round, g = rng.ints(n, 1, 6), c = rng.ints(n, 1, 6);
      var t = new LC.Trace(), tank = 0, start = 0, total = 0;
      t.setup = 'gas = ' + fmt(g) + '   cost = ' + fmt(c);
      var diff = g.map(function (x, i) { return x - c[i]; });
      function view(i) { var cl = {}; if (i < n) cl[i] = 'hit'; for (var k = 0; k < start && k < n; k++) cl[k] = 'dim'; return V(P.arr(g, { label: 'gas', cls: cl }), P.arr(c, { label: 'cost', cls: cl }), P.arr(diff, { label: 'gas − cost', cls: cl }), P.vars([['start', start], ['tank', tank], ['total', total]])); }
      for (var i = 0; i < n; i++) {
        var nt = tank + diff[i];
        total += diff[i];
        var key = nt < 0 ? 'reset' : 'go';
        tank = nt;
        t.act(view(i), 'Station ' + i + ': tank = ' + tank + '.', [['go', 'Keep going'], ['reset', 'Tank < 0: start = ' + (i + 1) + ', tank = 0']], key,
          key === 'reset' ? 'The tank is negative: you cannot leave station ' + i + ' from any start since ' + start + '.' : 'The tank is still at least 0.', key === 'reset' ? 'Restart after ' + i + '.' : 'Fine.');
        if (key === 'reset') { start = i + 1; tank = 0; }
      }
      var ans = total >= 0 ? start : -1;
      t.num(view(n), 'total = ' + total + '. Answer (start index, or -1)?', ans, { wrong: total >= 0 ? 'Total at least 0, so the last start works.' : 'Total < 0: not enough gas overall.', note: String(ans) + '.' });
      t.done(view(n), 'Answer ' + ans + '. One pass, O(n).');
      return t;
    }
  });

  LC.register('assign-cookies', {
    title: 'Assign Cookies: smallest cookie that satisfies the least greedy child',
    rule: 'Sort greed g and cookies s. Point at the least greedy child and the smallest cookie. If the cookie is big enough, give it (both move on). Otherwise that cookie is useless to everyone left: discard it.',
    make: function (rng, round) {
      var g = rng.sorted(3 + round, 1, 6), s = rng.sorted(4 + round, 1, 7);
      var t = new LC.Trace(), i = 0, j = 0, cnt = 0;
      t.setup = 'g (sorted) = ' + fmt(g) + '   s (sorted) = ' + fmt(s);
      function view() { var gc = {}, sc = {}; for (var k = 0; k < i; k++) gc[k] = 'ok'; for (k = 0; k < j; k++) sc[k] = 'dim'; return V(P.arr(g, { label: 'children greed', cls: gc, ptr: i < g.length ? { i: i } : {} }), P.arr(s, { label: 'cookies', cls: sc, ptr: j < s.length ? { j: j } : {} }), P.vars([['content', cnt]])); }
      while (i < g.length && j < s.length) {
        var key = s[j] >= g[i] ? 'give' : 'skip';
        t.act(view(), 'Child needs ' + g[i] + ', cookie is ' + s[j] + '.', [['give', 'Give it (i++, j++)'], ['skip', 'Too small: next cookie (j++)']], key,
          key === 'give' ? s[j] + ' is at least ' + g[i] + ': it satisfies this child, and it is the smallest cookie that could.' : s[j] + ' < ' + g[i] + ': this child, and every greedier one, rejects it.', key === 'give' ? 'Content +1.' : 'Discard ' + s[j] + '.');
        if (key === 'give') { cnt++; i++; } j++;
      }
      t.num(view(), 'Content children?', cnt, { wrong: 'Count the gives.', note: cnt + '.' });
      t.done(view(), cnt + ' content. O(n log n) for sorting.');
      return t;
    }
  });

  LC.register('partition-labels', {
    title: 'Partition Labels: stretch to the last occurrence',
    rule: 'Precompute each letter\'s last index. Walk the string with end = max(end, last[ch]). When i == end, nothing inside the part appears later: cut here.',
    make: function (rng, round) {
      var n = 9 + round * 2, al = 'abcdef'.slice(0, 4 + round).split(''), s = [];
      for (var k = 0; k < n; k++) s.push(rng.pick(al));
      var last = {}; s.forEach(function (ch, i) { last[ch] = i; });
      var t = new LC.Trace(), end = 0, startP = 0, parts = [];
      t.setup = 's = "' + s.join('') + '"   last: ' + Object.keys(last).sort().map(function (ch) { return ch + ' at ' + last[ch]; }).join(', ');
      function view(i) { var c = {}; for (var k = startP; k <= end && k < n; k++) c[k] = 'blue'; if (i < n) c[i] = 'hit'; return V(P.arr(s, { cls: c, ptr: i < n ? { i: i } : {} }), P.vars([['end', end], ['parts', fmt(parts)]])); }
      for (var i = 0; i < n; i++) {
        var ne = Math.max(end, last[s[i]]);
        var key = i === ne ? 'cut' : last[s[i]] > end ? 'ext' : 'keep';
        var L = last[s[i]], why = {
          cut: 'end is ' + ne + '; i = ' + i + ' has not reached it yet.',
          ext: key === 'cut' ? 'After the update, i == end: cut here.' : '"' + s[i] + '" last appears at ' + L + ' at most end ' + end + ': no stretch needed.',
          keep: key === 'cut' ? 'i == end: every letter so far ends here. Cut.' : 'last["' + s[i] + '"] = ' + L + ' > end ' + end + ': stretch end.'
        };
        t.act(view(i), 'i = ' + i + ' ("' + s[i] + '"), end = ' + end + '.', [['keep', 'Keep going'], ['ext', 'Stretch end to last["' + s[i] + '"]'], ['cut', 'i == end: cut']], key, why,
          key === 'cut' ? 'Part of size ' + (i - startP + 1) + '.' : key === 'ext' ? 'end = ' + ne + '.' : 'Inside the part.');
        end = ne;
        if (key === 'cut') { parts.push(i - startP + 1); startP = i + 1; end = i + 1; }
      }
      end = n - 1;
      t.done(view(n), 'Sizes ' + fmt(parts) + '. O(n).');
      return t;
    }
  });

  LC.register('can-place-flowers', {
    title: 'Can Place Flowers: plant when both neighbors are empty',
    rule: 'Walk the bed. Plant at i whenever plot i, its left and its right are all empty (edges count as empty). Planting early never hurts.',
    make: function (rng, round) {
      var m = 8 + round, bed = [];
      for (var k = 0; k < m; k++) bed.push(k > 0 && bed[k - 1] === 1 ? 0 : (rng.chance(0.3) ? 1 : 0));
      var orig = bed.slice(), cap = 0, b2 = bed.slice();
      for (k = 0; k < m; k++) if (!b2[k] && (k === 0 || !b2[k - 1]) && (k === m - 1 || !b2[k + 1])) { b2[k] = 1; cap++; }
      var want = Math.max(1, cap + rng.pick([-1, 0, 0, 1]));
      var t = new LC.Trace(), planted = 0, cls = {};
      t.setup = 'flowerbed = ' + fmt(orig) + '   n = ' + want;
      function view(i) { var c = LC.clone(cls); if (i < m) c[i] = 'hit'; return V(P.arr(bed, { cls: c, ptr: i < m ? { i: i } : {} }), P.vars([['planted', planted], ['need n', want]])); }
      for (var i = 0; i < m && planted < want; i++) {
        var ok = !bed[i] && (i === 0 || !bed[i - 1]) && (i === m - 1 || !bed[i + 1]);
        var why = bed[i] ? 'Plot ' + i + ' already has a flower.' : (i > 0 && bed[i - 1]) ? 'The left neighbor has a flower.' : (i < m - 1 && bed[i + 1]) ? 'The right neighbor has a flower.' : '';
        t.act(view(i), 'Plot ' + i + '.', [['plant', 'Plant'], ['skip', 'Skip']], ok ? 'plant' : 'skip', ok ? 'Left, here and right are all empty: plant now (it never blocks a better spot).' : why, ok ? 'Planted.' : 'Skip.');
        if (ok) { bed[i] = 1; cls[i] = 'ok'; planted++; }
      }
      var res = planted >= want;
      t.act(view(m), 'Planted ' + planted + ', needed ' + want + '.', [['T', 'Return true'], ['F', 'Return false']], res ? 'T' : 'F', res ? 'You planted enough.' : 'Even greedy planting falls short.', res ? 'True.' : 'False.');
      t.done(view(m), (res ? 'True' : 'False') + '. O(n).');
      return t;
    }
  });
})();
