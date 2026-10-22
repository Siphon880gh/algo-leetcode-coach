/* Running-best games (Kadane family): one pass, a tiny state, one decision per element. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;
  var EXT = [['ext', 'Extend: cur + x'], ['new', 'Restart at x']];

  function kadaneSteps(t, a, label, sign, names) {
    var cur = a[0], best = a[0], n = a.length, start = 0, bs = 0, be = 0;
    for (var i = 1; i < n; i++) {
      var x = a[i], ext = cur + x, key;
      var better = sign > 0 ? ext > x : ext < x;
      if (ext === x) key = ['ext', 'new']; else key = better ? 'ext' : 'new';
      var c = {}; for (var k = start; k < i; k++) c[k] = 'blue'; c[i] = 'hit';
      t.act(V(P.arr(a, { cls: c, ptr: { i: i }, label: label }), P.vars([[names[0], cur], [names[1], best]])), 'x = ' + x + '. ' + names[0] + ' = ' + cur + '.', EXT, key,
        sign > 0 ? { ext: 'cur ' + cur + ' ≤ 0 drags x down: ' + cur + ' + ' + x + ' = ' + ext + ' < ' + x + '.', 'new': 'cur ' + cur + ' > 0 helps: ' + ext + ' > ' + x + '.' }
          : { ext: 'cur ' + cur + ' ≥ 0 pushes the sum up: ' + ext + ' > ' + x + '.', 'new': 'cur ' + cur + ' < 0 makes it smaller: ' + ext + ' < ' + x + '.' },
        (better || ext === x ? 'cur = ' + ext : 'cur = ' + x) + '.');
      if (better || ext === x) cur = ext; else { cur = x; start = i; }
      if (sign > 0 ? cur > best : cur < best) { best = cur; bs = start; be = i; }
    }
    return { best: best, range: [bs, be] };
  }

  LC.register('maximum-subarray', {
    title: 'Maximum Subarray: extend or restart',
    rule: 'Carry cur = best sum ending at i. At each x, extend (cur + x) or restart (x), whichever is bigger. A negative running sum is never worth keeping.',
    make: function (rng, round) {
      var a = rng.ints(8 + round, -6, 8);
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a) + '   cur = best = nums[0]';
      var r = kadaneSteps(t, a, 'nums', 1, ['cur', 'best']);
      t.num(V(P.arr(a)), 'Largest subarray sum?', r.best, { wrong: 'The best value you tracked.', note: r.best + '.' });
      t.done(V(P.arr(a, { win: r.range })), 'Max subarray sum ' + r.best + '. O(n), O(1).');
      return t;
    }
  });

  LC.register('best-time-to-buy-and-sell-stock', {
    title: 'Best Time to Buy and Sell Stock: lowest price so far',
    rule: 'Walk the days once. Keep the lowest price seen so far. Each day, either it is a new low (a better buy) or you check today\'s profit = price − low.',
    make: function (rng, round) {
      var p = rng.ints(8 + round, 1, 12);
      var t = new LC.Trace();
      t.setup = 'prices = ' + LC.fmt(p);
      var low = p[0], best = 0, lowAt = 0;
      var acts = [['low', 'New low: buy here instead'], ['sell', 'Check profit: price − low']];
      for (var i = 1; i < p.length; i++) {
        var c = {}; c[lowAt] = 'blue'; c[i] = 'hit';
        var v = V(P.arr(p, { bars: true, cls: c, ptr: { low: lowAt, today: i } }), P.vars([['low', low], ['best profit', best]]));
        if (p[i] < low) { t.act(v, 'Price ' + p[i] + '. Low so far ' + low + '.', acts, 'low', 'Selling below your buy price loses money; ' + p[i] + ' is a better buy point.', 'low = ' + p[i] + '.'); low = p[i]; lowAt = i; }
        else if (p[i] === low) { t.act(v, 'Price ' + p[i] + ' equals the low.', acts, ['low', 'sell'], '', 'Same price; profit 0 either way.'); }
        else { t.num(v, 'Price ' + p[i] + '. Profit if you sell today?', p[i] - low, { wrong: 'price − low = ' + p[i] + ' − ' + low + '.', note: 'Profit ' + (p[i] - low) + (p[i] - low > best ? ': new best.' : '.') }); best = Math.max(best, p[i] - low); }
      }
      t.done(V(P.arr(p, { bars: true }), P.vars([['max profit', best]])), 'Max profit ' + best + '. One pass.');
      return t;
    }
  });

  LC.register('best-time-to-buy-and-sell-stock-ii', {
    title: 'Best Time to Buy and Sell Stock II: take every upslope',
    rule: 'With unlimited transactions, the best profit is the sum of every positive day-to-day difference. Take each rise; skip each fall.',
    make: function (rng, round) {
      var p = rng.ints(8 + round, 1, 12);
      var t = new LC.Trace();
      t.setup = 'prices = ' + LC.fmt(p);
      var total = 0, acts = [['take', 'Take the gain'], ['skip', 'Skip (no gain)']];
      for (var i = 1; i < p.length; i++) {
        var d = p[i] - p[i - 1], c = {}; c[i - 1] = 'warn'; c[i] = 'hit';
        t.act(V(P.arr(p, { bars: true, cls: c }), P.vars([['diff', d], ['total', total]])), 'Day ' + (i - 1) + ' → ' + i + ': ' + p[i - 1] + ' → ' + p[i] + '.', acts, d > 0 ? 'take' : 'skip', d > 0 ? 'Prices rose by ' + d + '; buying yesterday and selling today earns it.' : 'Prices did not rise; holding through it only loses.', d > 0 ? '+' + d + '.' : 'No trade.');
        if (d > 0) total += d;
      }
      t.num(V(P.arr(p, { bars: true })), 'Total profit?', total, { wrong: 'Add up the gains you took.', note: total + '.' });
      t.done(V(P.arr(p, { bars: true }), P.vars([['max profit', total]])), 'Max profit ' + total + '.');
      return t;
    }
  });

  LC.register('maximum-sum-circular-subarray', {
    title: 'Maximum Sum Circular Subarray: best inside or total − worst',
    rule: 'A wrapping subarray is the total minus a middle subarray. Run Kadane for the max, Kadane for the min, then answer max(maxSum, total − minSum), unless every number is negative.',
    make: function (rng, round) {
      var a = rng.ints(6 + round, -6, 7);
      var total = a.reduce(function (x, y) { return x + y; }, 0);
      var t = new LC.Trace();
      t.setup = 'nums (circular) = ' + LC.fmt(a) + '   total = ' + total;
      var mx = kadaneSteps(t, a, 'pass 1: max subarray', 1, ['curMax', 'maxSum']);
      var mn = kadaneSteps(t, a, 'pass 2: min subarray', -1, ['curMin', 'minSum']);
      var allNeg = mx.best < 0, ans = allNeg ? mx.best : Math.max(mx.best, total - mn.best);
      t.act(V(P.vars([['maxSum', mx.best], ['minSum', mn.best], ['total', total], ['total − minSum', total - mn.best]])), 'Combine the passes.', [['max', 'Return maxSum'], ['wrap', 'Return total − minSum']], allNeg || mx.best >= total - mn.best ? 'max' : 'wrap',
        allNeg ? 'All numbers are negative: total − minSum would be the empty subarray (0), which is not allowed.' : mx.best >= total - mn.best ? 'maxSum ' + mx.best + ' is at least the wrapping sum ' + (total - mn.best) + '.' : 'The wrapping sum ' + (total - mn.best) + ' beats ' + mx.best + '.',
        'Answer ' + ans + '.');
      t.done(V(P.arr(a)), 'Circular max ' + ans + '.');
      return t;
    }
  });

  LC.register('maximum-product-subarray', {
    title: 'Maximum Product Subarray: a negative swaps max and min',
    rule: 'Track the largest and smallest product ending here. A negative x turns the smallest into the largest, so swap them first. Then hi = max(x, hi·x), lo = min(x, lo·x).',
    make: function (rng, round) {
      var a = []; for (var i = 0; i < 7 + round; i++) a.push(rng.pick([-3, -2, -1, 0, 1, 2, 3, 4, -2, 2]));
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a) + '   hi = lo = best = nums[0]';
      var hi = a[0], lo = a[0], best = a[0];
      var acts = [['swap', 'Swap hi and lo first'], ['keep', 'No swap']];
      for (i = 1; i < a.length; i++) {
        var x = a[i], c = {}; c[i] = 'hit';
        t.act(V(P.arr(a, { cls: c, ptr: { i: i } }), P.vars([['hi', hi], ['lo', lo], ['best', best]])), 'x = ' + x + '.', acts, x < 0 ? 'swap' : 'keep', x < 0 ? 'Multiplying by a negative flips the order: the smallest product becomes the largest.' : 'x is not negative, so the order stays.', x < 0 ? 'Swapped.' : 'Kept.');
        if (x < 0) { var tmp = hi; hi = lo; lo = tmp; }
        hi = Math.max(x, hi * x); lo = Math.min(x, lo * x); best = Math.max(best, hi);
      }
      t.num(V(P.arr(a), P.vars([['best', best]])), 'Largest product?', best, { wrong: 'The best hi you saw.', note: best + '.' });
      t.done(V(P.arr(a), P.vars([['best', best]])), 'Max product ' + best + '.');
      return t;
    }
  });
})();
