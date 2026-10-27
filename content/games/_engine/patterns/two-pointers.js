/* Two Pointers games. Each register() drills one guide's decision rule. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;

  LC.register('two-sum-ii-input-array-is-sorted', {
    title: 'Two Sum II: squeeze the sorted array',
    rule: 'Sum too big: move R left. Sum too small: move L right. Sorted order makes the other move useless.',
    make: function (rng, round) {
      var n = 7 + round, a, i, j, target;
      do {
        a = rng.sorted(n, -5, 20);
        i = rng.int(0, n - 2); j = rng.int(i + 1, n - 1); target = a[i] + a[j];
        var cnt = 0;
        for (var x = 0; x < n; x++) for (var y = x + 1; y < n; y++) if (a[x] + a[y] === target) cnt++;
      } while (cnt !== 1);
      var t = new LC.Trace();
      t.setup = 'numbers = ' + LC.fmt(a) + '   target = ' + target + '   (sorted, exactly one answer)';
      var l = 0, r = n - 1;
      var acts = [['L', 'Move L right'], ['R', 'Move R left'], ['F', 'Found it']];
      while (l < r) {
        var sum = a[l] + a[r];
        var view = V(P.arr(a, { ptr: { L: l, R: r }, cls: (function () { var c = {}; c[l] = 'hit'; c[r] = 'hit'; return c; })() }),
          P.vars([['sum', a[l] + ' + ' + a[r] + ' = ' + sum], ['target', target]]));
        if (sum === target) { t.act(view, 'sum equals target. What now?', acts, 'F', 'The sum already equals the target.', 'Return [' + (l + 1) + ', ' + (r + 1) + '] (1-indexed).'); break; }
        if (sum > target) t.act(view, 'sum ' + sum + ' > ' + target + '. Which pointer moves?', acts, 'R',
          { L: 'Moving L right picks a bigger number, so the sum only grows.', F: 'The sum is not the target.' }, 'Every pair with R = ' + a[r] + ' is too big now, so drop it.');
        else t.act(view, 'sum ' + sum + ' < ' + target + '. Which pointer moves?', acts, 'L',
          { R: 'Moving R left picks a smaller number, so the sum only shrinks.', F: 'The sum is not the target.' }, 'Every pair with L = ' + a[l] + ' is too small now, so drop it.');
        if (sum > target) r--; else l++;
      }
      var c = {}; c[l] = 'ok'; c[r] = 'ok';
      t.done(V(P.arr(a, { ptr: { L: l, R: r }, cls: c })), 'Found ' + a[l] + ' + ' + a[r] + ' = ' + target + ' in O(n) with O(1) space.');
      return t;
    }
  });

  LC.register('container-with-most-water', {
    title: 'Container With Most Water: move the shorter wall',
    rule: 'Area = min(h[L], h[R]) times width. Always move the shorter wall: the width shrinks either way, and only a taller short wall can help.',
    make: function (rng, round) {
      var n = 7 + round, h = rng.ints(n, 1, 9);
      var t = new LC.Trace();
      t.setup = 'height = ' + LC.fmt(h);
      var l = 0, r = n - 1, best = 0, first = true;
      var acts = [['L', 'Move L right'], ['R', 'Move R left']];
      while (l < r) {
        var area = Math.min(h[l], h[r]) * (r - l);
        var c = {}; c[l] = 'hit'; c[r] = 'hit';
        var view = V(P.arr(h, { bars: true, ptr: { L: l, R: r }, cls: c }),
          P.vars([['width', r - l], ['min height', Math.min(h[l], h[r])], ['best', best]]));
        if (first) { t.num(view, 'Area of this container?', area, { wrong: 'Area = min(' + h[l] + ', ' + h[r] + ') times ' + (r - l) + '.', note: 'Area ' + area + '.' }); first = false; }
        best = Math.max(best, area);
        view.panels[1].v[2][1] = best;
        view.panels[1].v.push(['area', area]);
        if (h[l] === h[r]) t.act(view, 'Walls are equal (' + h[l] + '). Which pointer moves?', acts, ['L', 'R'], '', 'Equal walls: either move is safe; neither wall can do better with a narrower partner.');
        else if (h[l] < h[r]) t.act(view, 'Area ' + area + '. Which wall moves?', acts, 'L', 'R is the taller wall. Moving it keeps min at most h[L] = ' + h[l] + ' while the width shrinks, so the area cannot grow.', 'L = ' + h[l] + ' is the bottleneck. It has had its best partner already.');
        else t.act(view, 'Area ' + area + '. Which wall moves?', acts, 'R', 'L is the taller wall. Moving it keeps min at most h[R] = ' + h[r] + ' while the width shrinks, so the area cannot grow.', 'R = ' + h[r] + ' is the bottleneck. It has had its best partner already.');
        if (h[l] < h[r]) l++; else r--;
      }
      t.done(V(P.arr(h, { bars: true }), P.vars([['max area', best]])), 'Max area = ' + best + '. One pass, O(n).');
      return t;
    }
  });

  function isAlnum(ch) { return /[a-z0-9]/i.test(ch); }

  LC.register('valid-palindrome', {
    title: 'Valid Palindrome: skip, compare, move in',
    rule: 'Skip anything that is not a letter or digit on each side, compare the rest in lowercase, and fail on the first mismatch.',
    make: function (rng, round) {
      var letters = 'abcdefgh', half = [], k = 3 + round, i;
      for (i = 0; i < k; i++) half.push(rng.pick(letters));
      var core = half.concat(rng.chance(0.5) ? [rng.pick(letters)] : []).concat(half.slice().reverse());
      var bad = rng.chance(0.4);
      if (bad) { var pos = rng.int(0, core.length - 1); var mirror = core.length - 1 - pos; if (pos !== mirror) core[pos] = letters.charAt((letters.indexOf(core[mirror]) + 1) % letters.length); else bad = false; }
      var s = [];
      core.forEach(function (ch) {
        if (rng.chance(0.3)) s.push(rng.pick([' ', ',', ':', '!', '.']));
        s.push(rng.chance(0.4) ? ch.toUpperCase() : ch);
      });
      if (rng.chance(0.5)) s.push(rng.pick(['!', '.', ' ']));
      var t = new LC.Trace();
      t.setup = 's = "' + s.join('') + '"';
      var acts = [['sl', 'Skip L'], ['sr', 'Skip R'], ['m', 'Match: move both in'], ['x', 'Mismatch: false']];
      var l = 0, r = s.length - 1, result = true;
      while (l < r) {
        var c = {}; c[l] = 'hit'; c[r] = 'hit';
        var view = V(P.arr(s.map(function (ch) { return ch === ' ' ? '␣' : ch; }), { ptr: { L: l, R: r }, cls: c }));
        var aL = isAlnum(s[l]), aR = isAlnum(s[r]);
        if (!aL || !aR) {
          var ok = []; if (!aL) ok.push('sl'); if (!aR) ok.push('sr');
          t.act(view, 'Compare s[L] and s[R]?', acts, ok, { sl: '"' + s[l] + '" is a letter or digit; it counts.', sr: '"' + s[r] + '" is a letter or digit; it counts.', m: 'Punctuation and spaces are ignored, so skip them first.', x: 'Punctuation and spaces are ignored, so skip them first.' }, 'Not a letter or digit, so skip it.');
          if (!aL) l++; else r--;
          continue;
        }
        if (s[l].toLowerCase() === s[r].toLowerCase()) {
          t.act(view, '"' + s[l] + '" vs "' + s[r] + '"?', acts, 'm', { sl: 'Both are letters or digits.', sr: 'Both are letters or digits.', x: 'Compare in lowercase: ' + s[l].toLowerCase() + ' == ' + s[r].toLowerCase() + '.' }, 'Same letter ignoring case.');
          l++; r--;
        } else {
          t.act(view, '"' + s[l] + '" vs "' + s[r] + '"?', acts, 'x', { sl: 'Both are letters or digits.', sr: 'Both are letters or digits.', m: s[l].toLowerCase() + ' is not ' + s[r].toLowerCase() + '.' }, 'One mismatch is enough to say it is not a palindrome.');
          result = false; break;
        }
      }
      t.done(V(P.arr(s.map(function (ch) { return ch === ' ' ? '␣' : ch; }), { ptr: { L: l, R: r } })), result ? 'The pointers met: it is a palindrome.' : 'Not a palindrome.');
      return t;
    }
  });

  LC.register('squares-of-a-sorted-array', {
    title: 'Squares of a Sorted Array: biggest square is at an end',
    rule: 'The largest square is at one of the two ends. Compare |L| and |R|, write the bigger square at the back of the output, and move that pointer.',
    make: function (rng, round) {
      var n = 6 + round, a = rng.sorted(n, -9, 9);
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a);
      var out = a.map(function () { return null; });
      var l = 0, r = n - 1, w = n - 1;
      var acts = [['L', 'Take L²'], ['R', 'Take R²']];
      while (l <= r) {
        var c = {}; c[l] = 'hit'; c[r] = 'hit';
        var view = V(P.arr(a, { ptr: { L: l, R: r }, cls: c, label: 'nums' }), P.arr(out, { ptr: { w: w }, label: 'result (filled from the back)' }));
        var sl = a[l] * a[l], sr = a[r] * a[r];
        if (l === r) t.act(view, 'Last value left. Which square goes to result[' + w + ']?', acts, ['L', 'R'], '', 'Only one left.');
        else if (sl === sr) t.act(view, '|' + a[l] + '| and |' + a[r] + '| tie. Which square goes to result[' + w + ']?', acts, ['L', 'R'], '', 'Tie: either works.');
        else t.act(view, 'Which square goes to result[' + w + ']?', acts, sl > sr ? 'L' : 'R',
          sl > sr ? a[l] + '² = ' + sl + ' beats ' + a[r] + '² = ' + sr + '.' : a[r] + '² = ' + sr + ' beats ' + a[l] + '² = ' + sl + '.',
          'The biggest remaining square goes last.');
        if (sl > sr) { out[w] = sl; l++; } else { out[w] = sr; r--; }
        w--;
      }
      t.done(V(P.arr(out, { label: 'result' })), 'Sorted squares in one pass: ' + LC.fmt(out) + '.');
      return t;
    }
  });

  LC.register('trapping-rain-water', {
    title: 'Trapping Rain Water: settle the lower side',
    rule: 'Process the side with the lower bar. Its water level is its own running max, because the other side already has something at least as tall.',
    make: function (rng, round) {
      var n = 8 + round, h = rng.ints(n, 0, 5);
      h[rng.int(1, n - 2)] = 5;
      var t = new LC.Trace();
      t.setup = 'height = ' + LC.fmt(h);
      var water = h.map(function () { return 0; });
      var l = 0, r = n - 1, lmax = 0, rmax = 0, total = 0;
      var acts = [['L', 'Process L'], ['R', 'Process R']];
      function view() {
        var c = {}; c[l] = 'hit'; c[r] = 'hit';
        return V(P.arr(h, { bars: true, water: water, ptr: { L: l, R: r }, cls: c }), P.vars([['leftMax', lmax], ['rightMax', rmax], ['water', total]]));
      }
      while (l < r) {
        var useL = h[l] < h[r];
        if (h[l] === h[r]) t.act(view(), 'Bars tie at ' + h[l] + '. Which side do you process?', acts, ['L', 'R'], '', 'Tie: either side is bounded by the other.');
        else t.act(view(), 'Which side is safe to settle?', acts, useL ? 'L' : 'R',
          useL ? 'h[R] = ' + h[r] + ' is taller, so the left side is the bottleneck. Settle L.' : 'h[L] = ' + h[l] + ' is taller, so the right side is the bottleneck. Settle R.',
          useL ? 'The right wall ' + h[r] + ' guarantees the left side is limited by leftMax.' : 'The left wall ' + h[l] + ' guarantees the right side is limited by rightMax.');
        if (useL) {
          var m1 = Math.max(lmax, h[l]);
          t.num(view(), 'Water above bar ' + l + ' (height ' + h[l] + ')?', m1 - h[l], { wrong: 'Water = max(leftMax, h) − h = ' + m1 + ' − ' + h[l] + '.', note: m1 - h[l] === 0 ? 'No water; this bar raises leftMax to ' + m1 + '.' : (m1 - h[l]) + ' units trapped.' });
          lmax = m1; water[l] = m1 - h[l]; total += water[l]; l++;
        } else {
          var m2 = Math.max(rmax, h[r]);
          t.num(view(), 'Water above bar ' + r + ' (height ' + h[r] + ')?', m2 - h[r], { wrong: 'Water = max(rightMax, h) − h = ' + m2 + ' − ' + h[r] + '.', note: m2 - h[r] === 0 ? 'No water; this bar raises rightMax to ' + m2 + '.' : (m2 - h[r]) + ' units trapped.' });
          rmax = m2; water[r] = m2 - h[r]; total += water[r]; r--;
        }
      }
      t.done(V(P.arr(h, { bars: true, water: water }), P.vars([['total water', total]])), 'Trapped ' + total + ' units with O(1) extra space.');
      return t;
    }
  });

  LC.register('3sum', {
    title: '3Sum: fix one, squeeze two, skip repeats',
    rule: 'Sort. Fix i, squeeze L and R toward a sum of 0, and skip any value you have already used in the same role so triplets stay unique.',
    make: function (rng, round) {
      var n = 7, a;
      do { a = rng.sorted(n, -4, 4); } while (!has3(a));
      function has3(x) { for (var i = 0; i < x.length; i++) for (var j = i + 1; j < x.length; j++) for (var k = j + 1; k < x.length; k++) if (x[i] + x[j] + x[k] === 0) return true; return false; }
      var t = new LC.Trace();
      t.setup = 'nums (sorted) = ' + LC.fmt(a);
      var found = [];
      var outer = [['run', 'Squeeze with this i'], ['skip', 'Skip i (same value as i−1)'], ['stop', 'Stop: nums[i] > 0']];
      var inner = [['L', 'Move L right'], ['R', 'Move R left'], ['rec', 'Record, move both']];
      for (var i = 0; i < n - 2; i++) {
        var vo = V(P.arr(a, { ptr: { i: i }, cls: (function () { var c = {}; c[i] = 'warn'; return c; })() }), P.vars([['found', found.length ? found.map(LC.fmt).join(' ') : 'none']]));
        if (a[i] > 0) { t.act(vo, 'nums[i] = ' + a[i] + '. What do you do with this i?', outer, 'stop', 'Everything to the right is at least ' + a[i] + ' > 0, so no triplet can sum to 0.', 'Three positives can never sum to 0.'); break; }
        if (i > 0 && a[i] === a[i - 1]) { t.act(vo, 'nums[i] = ' + a[i] + ' again. What do you do with this i?', outer, 'skip', 'i−1 had the same value and already found every triplet starting with ' + a[i] + '.', 'Duplicate first value: skip it.'); continue; }
        t.act(vo, 'nums[i] = ' + a[i] + '. What do you do with this i?', outer, 'run', a[i] > 0 ? '' : (i > 0 && a[i] === a[i - 1] ? '' : 'This is a new value, so search for pairs summing to ' + (-a[i]) + '.'), 'Look for L + R = ' + (-a[i]) + '.');
        var l = i + 1, r = n - 1;
        while (l < r) {
          var sum = a[i] + a[l] + a[r];
          var c = {}; c[i] = 'warn'; c[l] = 'hit'; c[r] = 'hit';
          var v = V(P.arr(a, { ptr: { i: i, L: l, R: r }, cls: c }), P.vars([['sum', a[i] + ' + ' + a[l] + ' + ' + a[r] + ' = ' + sum], ['found', found.length ? found.map(LC.fmt).join(' ') : 'none']]));
          if (sum === 0) {
            t.act(v, 'sum = 0. What now?', inner, 'rec', 'The sum is exactly 0; record it.', 'Record [' + a[i] + ',' + a[l] + ',' + a[r] + '], then skip repeats of L and R.');
            found.push([a[i], a[l], a[r]]);
            var lv = a[l], rv = a[r];
            while (l < r && a[l] === lv) l++;
            while (l < r && a[r] === rv) r--;
          } else if (sum < 0) { t.act(v, 'sum = ' + sum + '. Which pointer?', inner, 'L', { R: 'Moving R left makes the sum smaller still.', rec: 'The sum is not 0.' }, 'Too small: L moves right.'); l++; }
          else { t.act(v, 'sum = ' + sum + '. Which pointer?', inner, 'R', { L: 'Moving L right makes the sum larger still.', rec: 'The sum is not 0.' }, 'Too big: R moves left.'); r--; }
        }
      }
      t.done(V(P.arr(a), P.vars([['triplets', found.map(LC.fmt).join(' ')]])), 'Unique triplets: ' + found.map(LC.fmt).join(' ') + '. O(n²).');
      return t;
    }
  });

  LC.register('3sum-closest', {
    title: '3Sum Closest: squeeze toward the target',
    rule: 'Fix i and squeeze L or R like 3Sum. Too small: L moves right; too big: R moves left. Keep the closest sum seen. An exact hit ends the search.',
    make: function (rng, round) {
      var n = 6, a = rng.sorted(n, -6, 9), target = rng.int(-4, 12);
      var t = new LC.Trace();
      t.setup = 'nums (sorted) = ' + LC.fmt(a) + '   target = ' + target;
      var best = null;
      var acts = [['L', 'Move L right'], ['R', 'Move R left'], ['X', 'Exact: return it']];
      outer:
      for (var i = 0; i < n - 2; i++) {
        var l = i + 1, r = n - 1;
        while (l < r) {
          var sum = a[i] + a[l] + a[r];
          var c = {}; c[i] = 'warn'; c[l] = 'hit'; c[r] = 'hit';
          if (best === null || Math.abs(sum - target) < Math.abs(best - target)) best = sum;
          var v = V(P.arr(a, { ptr: { i: i, L: l, R: r }, cls: c }), P.vars([['sum', sum], ['target', target], ['closest', best]]));
          if (sum === target) { t.act(v, 'sum = target. What now?', acts, 'X', 'You cannot get closer than 0 away.', 'Distance 0: done.'); break outer; }
          if (sum < target) { t.act(v, 'sum ' + sum + ' < target ' + target + '. Which pointer?', acts, 'L', { R: 'R left only lowers the sum further from the target.', X: 'Not exact.' }, 'Raise the sum: L moves right.'); l++; }
          else { t.act(v, 'sum ' + sum + ' > target ' + target + '. Which pointer?', acts, 'R', { L: 'L right only raises the sum further from the target.', X: 'Not exact.' }, 'Lower the sum: R moves left.'); r--; }
        }
      }
      var lastV = V(P.arr(a), P.vars([['target', target]]));
      t.num(lastV, 'Which sum was closest to ' + target + '?', best, { wrong: 'Look back at the closest value you tracked.', note: 'Closest sum = ' + best + '.' });
      t.done(V(P.arr(a), P.vars([['closest', best]])), 'Closest sum ' + best + ' (distance ' + Math.abs(best - target) + ').');
      return t;
    }
  });

  LC.register('boats-to-save-people', {
    title: 'Boats to Save People: the heaviest always boards',
    rule: 'Sort. The heaviest person boards now; add the lightest only if both fit under the limit. Each boat holds at most two.',
    make: function (rng, round) {
      var n = 6 + round, limit = rng.int(6, 10), w = rng.sorted(n, 1, limit);
      var t = new LC.Trace();
      t.setup = 'people (sorted) = ' + LC.fmt(w) + '   limit = ' + limit;
      var l = 0, r = n - 1, boats = 0, cls = {};
      var acts = [['A', 'Heaviest goes alone'], ['P', 'Pair lightest + heaviest']];
      while (l <= r) {
        var c = LC.clone(cls); c[l] = 'hit'; c[r] = 'hit';
        var v = V(P.arr(w, { ptr: l === r ? { 'L=R': l } : { L: l, R: r }, cls: c }), P.vars([['limit', limit], ['boats', boats]]));
        if (l === r) { t.act(v, 'One person left. Boat?', acts, 'A', 'There is nobody to pair with.', 'Last boat.'); cls[l] = 'done'; boats++; break; }
        var fits = w[l] + w[r] <= limit;
        t.act(v, w[l] + ' + ' + w[r] + ' = ' + (w[l] + w[r]) + ' vs limit ' + limit + '?', acts, fits ? 'P' : 'A',
          fits ? 'They fit together, so the lightest can ride along at no cost.' : 'Too heavy together. If the lightest cannot pair with the heaviest, nobody can.',
          fits ? 'Pair them.' : 'Heaviest rides alone.');
        cls[r] = 'done'; r--;
        if (fits) { cls[l] = 'done'; l++; }
        boats++;
      }
      t.done(V(P.arr(w, { cls: cls }), P.vars([['boats', boats]])), boats + ' boats. Greedy pairing with two pointers, O(n log n).');
      return t;
    }
  });

  LC.register('max-number-of-k-sum-pairs', {
    title: 'Max Number of K-Sum Pairs: sort and squeeze',
    rule: 'Sort, then squeeze: sum == k, so count the pair and move both; too small: L right; too big: R left.',
    make: function (rng, round) {
      var n = 8 + round, k = rng.int(5, 9), a = rng.sorted(n, 1, k - 1);
      var t = new LC.Trace();
      t.setup = 'nums (sorted) = ' + LC.fmt(a) + '   k = ' + k;
      var l = 0, r = n - 1, ops = 0, cls = {};
      var acts = [['L', 'Move L right'], ['R', 'Move R left'], ['C', 'Count pair, move both']];
      while (l < r) {
        var sum = a[l] + a[r], c = LC.clone(cls); c[l] = 'hit'; c[r] = 'hit';
        var v = V(P.arr(a, { ptr: { L: l, R: r }, cls: c }), P.vars([['sum', sum], ['k', k], ['ops', ops]]));
        if (sum === k) { t.act(v, 'sum = k. What now?', acts, 'C', 'This pair sums to k; take it.', 'Remove both.'); cls[l] = 'ok'; cls[r] = 'ok'; l++; r--; ops++; }
        else if (sum < k) { t.act(v, 'sum ' + sum + ' < ' + k + '?', acts, 'L', { R: 'R left shrinks the sum further.', C: 'Not equal to k.' }, 'Too small.'); cls[l] = 'dim'; l++; }
        else { t.act(v, 'sum ' + sum + ' > ' + k + '?', acts, 'R', { L: 'L right grows the sum further.', C: 'Not equal to k.' }, 'Too big.'); cls[r] = 'dim'; r--; }
      }
      t.done(V(P.arr(a, { cls: cls }), P.vars([['operations', ops]])), ops + ' operations.');
      return t;
    }
  });

  function isPal(s, i, j) { while (i < j) { if (s[i] !== s[j]) return false; i++; j--; } return true; }

  LC.register('valid-palindrome-ii', {
    title: 'Valid Palindrome II: one deletion, two branches',
    rule: 'Move inward while the ends match. On the first mismatch you may delete s[L] or s[R]; check both, because there is no second chance.',
    make: function (rng, round) {
      var letters = 'abcde', half = [], k = 3 + round, i;
      for (i = 0; i < k; i++) half.push(rng.pick(letters));
      var s = half.concat(rng.chance(0.5) ? [rng.pick(letters)] : []).concat(half.slice().reverse());
      var mode = rng.int(0, 9);
      if (mode < 7) s.splice(rng.int(0, s.length), 0, rng.pick(letters));
      else if (mode < 9) { s.splice(rng.int(0, s.length), 0, rng.pick(letters)); s.splice(rng.int(0, s.length), 0, rng.pick(letters)); }
      var t = new LC.Trace();
      t.setup = 's = "' + s.join('') + '"';
      var l = 0, r = s.length - 1, result = true, end = null;
      var acts = [['m', 'Match: move both in'], ['dl', 'Delete s[L]'], ['dr', 'Delete s[R]'], ['x', 'Return false']];
      while (l < r) {
        var c = {}; c[l] = 'hit'; c[r] = 'hit';
        var v = V(P.arr(s, { ptr: { L: l, R: r }, cls: c }));
        if (s[l] === s[r]) { t.act(v, '"' + s[l] + '" vs "' + s[r] + '"?', acts, 'm', 'They match, so no deletion is needed yet.', 'Match.'); l++; r--; continue; }
        var okL = isPal(s, l + 1, r), okR = isPal(s, l, r - 1), ok = [];
        if (okL) ok.push('dl'); if (okR) ok.push('dr'); if (!ok.length) ok.push('x');
        var whyL = 'Without s[L], "' + s.slice(l + 1, r + 1).join('') + '" is not a palindrome.';
        var whyR = 'Without s[R], "' + s.slice(l, r).join('') + '" is not a palindrome.';
        t.act(v, 'Mismatch "' + s[l] + '" vs "' + s[r] + '". Your one deletion?', acts, ok,
          { m: 'They do not match.', dl: whyL, dr: whyR, x: okL ? 'Deleting s[L] leaves a palindrome.' : 'Deleting s[R] leaves a palindrome.' },
          ok[0] === 'x' ? 'Neither deletion works, so it is false.' : 'The rest of the window is a palindrome.');
        result = okL || okR; end = c;
        break;
      }
      t.done(V(P.arr(s, { cls: end || {} })), result ? 'True: at most one deletion makes it a palindrome.' : 'False: one deletion is not enough.');
      return t;
    }
  });

  function writePtr(slug, title, rule, gen, keep, keepWhy, skipWhy, finishMsg) {
    LC.register(slug, {
      title: title, rule: rule,
      make: function (rng, round) {
        var g = gen(rng, round), a = g.a.slice();
        var t = new LC.Trace();
        t.setup = g.setup;
        var k = g.k0, acts = [['W', g.writeLabel], ['S', 'Skip']];
        for (var i = g.i0; i < a.length; i++) {
          var c = {}; for (var x = 0; x < k; x++) c[x] = 'ok'; c[i] = 'hit';
          var v = V(P.arr(a, { ptr: i === k ? { 'i,k': i } : { i: i, k: k }, cls: c }), P.vars([['k (kept)', k]].concat(g.vars || [])));
          var isKeep = keep(a, i, k, g);
          t.act(v, 'nums[i] = ' + a[i] + '. Keep or skip?', acts, isKeep ? 'W' : 'S', isKeep ? keepWhy(a, i, k, g) : skipWhy(a, i, k, g), isKeep ? 'Write it at k, then k++.' : 'Skip it; k stays.');
          if (isKeep) { if (g.swap) { var tmp = a[k]; a[k] = a[i]; a[i] = tmp; } else a[k] = a[i]; k++; }
        }
        var fc = {}; for (var y = 0; y < k; y++) fc[y] = 'ok';
        t.done(V(P.arr(a, { cls: fc, ptr: { k: k } })), finishMsg(k, a));
        return t;
      }
    });
  }

  writePtr('remove-duplicates-from-sorted-array', 'Remove Duplicates: read fast, write slow',
    'Keep a write pointer k. A value is written only when it differs from the last kept value nums[k−1].',
    function (rng, round) {
      var n = 8 + round, a = [], v = rng.int(0, 2);
      for (var i = 0; i < n; i++) { a.push(v); if (rng.chance(0.55)) v += rng.int(1, 2); }
      return { a: a, k0: 1, i0: 1, writeLabel: 'Write at k', setup: 'nums (sorted) = ' + LC.fmt(a) };
    },
    function (a, i, k) { return a[i] !== a[k - 1]; },
    function (a, i, k) { return a[i] + ' is new (the last kept value is ' + a[k - 1] + '), so keep it.'; },
    function (a, i, k) { return a[i] + ' equals the last kept value nums[k−1], so it is a duplicate.'; },
    function (k) { return k + ' unique values in nums[0..' + (k - 1) + '], in place.'; });

  writePtr('remove-element', 'Remove Element: copy the keepers forward',
    'Walk with i. Every value that is not val gets copied to the write pointer k; values equal to val are skipped.',
    function (rng, round) {
      var n = 8 + round, val = rng.int(1, 4), a = rng.ints(n, 1, 5);
      a[rng.int(0, n - 1)] = val;
      return { a: a, k0: 0, i0: 0, val: val, writeLabel: 'Write at k', setup: 'nums = ' + LC.fmt(a) + '   val = ' + val, vars: [['val', val]] };
    },
    function (a, i, k, g) { return a[i] !== g.val; },
    function (a, i, k, g) { return a[i] + ' is not ' + g.val + ', so it stays.'; },
    function (a, i, k, g) { return a[i] + ' is val; it gets removed.'; },
    function (k) { return k + ' values remain. Order of the keepers is preserved.'; });

  writePtr('move-zeroes', 'Move Zeroes: swap non-zeros forward',
    'k marks where the next non-zero belongs. Swap every non-zero into k and advance k; zeros drift to the back by themselves.',
    function (rng, round) {
      var n = 8 + round, a = [];
      for (var i = 0; i < n; i++) a.push(rng.chance(0.4) ? 0 : rng.int(1, 9));
      if (a.indexOf(0) === -1) a[rng.int(0, n - 1)] = 0;
      return { a: a, k0: 0, i0: 0, swap: true, writeLabel: 'Swap into k', setup: 'nums = ' + LC.fmt(a) };
    },
    function (a, i) { return a[i] !== 0; },
    function (a, i) { return a[i] + ' is non-zero, so it moves to the front block.'; },
    function () { return 'A zero never moves forward; leave it for a later swap.'; },
    function (k, a) { return 'Done: ' + LC.fmt(a) + '. ' + k + ' non-zeros kept in order.'; });

  LC.register('sort-colors', {
    title: 'Sort Colors: Dutch national flag',
    rule: '0: swap with low, low++ and mid++. 1: mid++. 2: swap with high and high--, but do NOT move mid: the value that came from high is unchecked.',
    make: function (rng, round) {
      var n = 8 + round, a = rng.ints(n, 0, 2);
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a);
      var low = 0, mid = 0, high = n - 1;
      var acts = [['0', 'Swap low, low++ mid++'], ['1', 'mid++'], ['2', 'Swap high, high--'], ['2b', 'Swap high, high-- mid++']];
      while (mid <= high) {
        var c = {};
        for (var x = 0; x < low; x++) c[x] = 'blue';
        for (var y = high + 1; y < n; y++) c[y] = 'bad';
        c[mid] = 'hit';
        var p = {}; p.low = low; p.mid = mid; p.high = high;
        if (low === mid) { delete p.low; delete p.mid; p['low,mid'] = low; }
        if (mid === high) { delete p.mid; delete p.high; p[p['low,mid'] !== undefined ? 'low,mid,high' : 'mid,high'] = mid; if (p['low,mid'] !== undefined) delete p['low,mid']; }
        var v = V(P.arr(a, { ptr: p, cls: c }));
        var key = String(a[mid]);
        t.act(v, 'nums[mid] = ' + a[mid] + '. Move?', acts, key, {
          '0': a[mid] === 0 ? '' : 'Only 0s go to the low region.',
          '1': a[mid] === 1 ? '' : 'Only a 1 can stay put in the middle.',
          '2': a[mid] === 2 ? '' : 'Only 2s go to the high region.',
          '2b': a[mid] === 2 ? 'The value swapped in from high has not been checked yet, so mid must stay.' : 'That move is for 2s, and it still forgets to check the swapped-in value.'
        }, key === '0' ? '0 joins the left block.' : key === '1' ? '1 stays in the middle.' : '2 goes to the right block; recheck mid.');
        if (a[mid] === 0) { var t0 = a[low]; a[low] = a[mid]; a[mid] = t0; low++; mid++; }
        else if (a[mid] === 1) mid++;
        else { var t2 = a[high]; a[high] = a[mid]; a[mid] = t2; high--; }
      }
      t.done(V(P.arr(a)), 'Sorted in one pass: ' + LC.fmt(a) + '.');
      return t;
    }
  });
})();
