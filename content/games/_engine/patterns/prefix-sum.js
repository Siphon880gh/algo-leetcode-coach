/* Prefix-sum games: running totals plus a hash map of earlier totals. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view, fmt = LC.fmt;
  function mapPanel(m, label) { var keys = Object.keys(m).map(Number).sort(function (a, b) { return a - b; }); return P.vars(keys.length ? keys.map(function (k) { return [String(k), m[k]]; }) : [['(empty)', '']], label); }

  LC.register('subarray-sum-equals-k', {
    title: 'Subarray Sum Equals K: look up prefix − k',
    rule: 'Keep a running prefix sum and a map count[prefix] (count[0] = 1 at the start). At each index, every earlier prefix equal to prefix − k starts a subarray that sums to k: add count[prefix − k], then record this prefix.',
    make: function (rng, round) {
      var n = 6 + round, a = rng.ints(n, -2, 3), k = rng.int(1, 4);
      var t = new LC.Trace(), cnt = { 0: 1 }, pre = 0, total = 0;
      t.setup = 'nums = ' + fmt(a) + '   k = ' + k;
      function view(i) { var c = {}; if (i < n) c[i] = 'hit'; return V(P.arr(a, { cls: c, ptr: i < n ? { i: i } : {} }), P.vars([['prefix', pre], ['prefix − k', pre - k], ['answer', total]]), mapPanel(cnt, 'count[prefix seen]')); }
      for (var i = 0; i < n; i++) {
        pre += a[i];
        var add = cnt[pre - k] || 0;
        t.num(view(i), 'prefix = ' + pre + '. How many subarrays ending at i = ' + i + ' sum to ' + k + '?', add, { wrong: 'Look up count[prefix − k] = count[' + (pre - k) + '].', note: '+' + add + '.' });
        total += add; cnt[pre] = (cnt[pre] || 0) + 1;
      }
      t.num(view(n), 'Total subarrays summing to ' + k + '?', total, { wrong: 'Sum of everything you added.', note: total + '.' });
      t.done(view(n), total + ' subarrays. O(n) with the map.');
      return t;
    }
  });

  LC.register('find-pivot-index', {
    title: 'Find Pivot Index: left sum vs. total − left − nums[i]',
    rule: 'Compute total once. Walk with leftSum. At i, the right side is total − leftSum − nums[i]. If the two match, i is the pivot; otherwise add nums[i] to leftSum and move on.',
    make: function (rng, round) {
      var n = 6 + round, a = rng.ints(n, -1, 6);
      if (rng.chance(0.65)) { var p = rng.int(1, n - 2), l = 0, r = 0, j; for (j = 0; j < p; j++) l += a[j]; for (j = p + 1; j < n; j++) r += a[j]; var d = l - r; a[n - 1] += d; if (a[n - 1] < -5 || a[n - 1] > 12) a[n - 1] -= d; }
      var total = a.reduce(function (x, y) { return x + y; }, 0), left = 0, ans = -1;
      var t = new LC.Trace();
      t.setup = 'nums = ' + fmt(a);
      t.num(V(P.arr(a)), 'First, total = ?', total, { wrong: 'Add every element.', note: 'total = ' + total + '.' });
      function view(i) { var c = {}; for (var k = 0; k < i && k < n; k++) c[k] = 'blue'; if (i < n) c[i] = 'hit'; return V(P.arr(a, { cls: c, ptr: i < n ? { i: i } : {} }), P.vars([['total', total], ['leftSum', left], ['rightSum', i < n ? total - left - a[i] : '-']])); }
      for (var i = 0; i < n; i++) {
        var right = total - left - a[i], hit = left === right;
        t.act(view(i), 'i = ' + i + ': left ' + left + ', right ' + right + '.', [['piv', 'Pivot! return ' + i], ['next', 'Not equal: leftSum += ' + a[i]]], hit ? 'piv' : 'next',
          hit ? 'left == right (' + left + '): this is the leftmost pivot.' : left + ' ≠ ' + right + '.', hit ? 'Pivot ' + i + '.' : 'leftSum = ' + (left + a[i]) + '.');
        if (hit) { ans = i; break; }
        left += a[i];
      }
      if (ans === -1) t.act(view(n), 'You walked past the end.', [['m1', 'Return -1'], ['last', 'Return n − 1']], 'm1', 'No index balanced the two sides.', 'No pivot.');
      t.done(view(ans === -1 ? n : ans), 'Pivot index ' + ans + '. O(n), O(1) space.');
      return t;
    }
  });

  LC.register('contiguous-array', {
    title: 'Contiguous Array: equal balances bracket a balanced run',
    rule: 'Count 1 as +1 and 0 as −1. Store the FIRST index where each balance appears (balance 0 at index −1). Seeing a balance again means the stretch in between has equal 0s and 1s: length i − first[balance].',
    make: function (rng, round) {
      var n = 7 + round, a = []; for (var k = 0; k < n; k++) a.push(rng.int(0, 1));
      var t = new LC.Trace(), first = { 0: -1 }, bal = 0, best = 0;
      t.setup = 'nums = ' + fmt(a);
      function view(i) { var c = {}; if (i < n) c[i] = 'hit'; return V(P.arr(a, { cls: c, ptr: i < n ? { i: i } : {} }), P.vars([['balance', bal], ['best', best]]), mapPanel(first, 'first index of each balance')); }
      for (var i = 0; i < n; i++) {
        bal += a[i] ? 1 : -1;
        var seen = first[bal] !== undefined;
        t.act(view(i), 'i = ' + i + ' (' + a[i] + '): balance = ' + bal + '.', [['len', 'Seen before: length = i − first'], ['rec', 'New balance: record first[' + bal + '] = ' + i]], seen ? 'len' : 'rec',
          seen ? 'Balance ' + bal + ' first appeared at ' + first[bal] + '. Keep that first index (it gives the longest run) and measure.' : 'Balance ' + bal + ' has not appeared yet.', seen ? 'Run length ' + (i - first[bal]) + '.' : 'Recorded.');
        if (seen) {
          var len = i - first[bal];
          if (len > best && rng.chance(0.6)) t.num(view(i), 'Length of this balanced run?', len, { wrong: 'i − first[balance] = ' + i + ' − ' + first[bal] + '.', note: len + '.' });
          best = Math.max(best, len);
        } else first[bal] = i;
      }
      t.num(view(n), 'Longest balanced subarray?', best, { wrong: 'The largest length you measured.', note: best + '.' });
      t.done(view(n), 'Longest = ' + best + '. O(n).');
      return t;
    }
  });
})();
