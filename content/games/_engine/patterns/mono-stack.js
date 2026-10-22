/* Monotonic Stack games: pop everything the newcomer settles, then push the newcomer. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;
  var ACTS = [['pop', 'Pop top (newcomer settles it)'], ['push', 'Push newcomer']];

  /*
   * Generic next-greater / next-smaller loop.
   * cfg.settles(topVal, curVal) → true when cur resolves top (pop).
   */
  function mono(slug, cfg) {
    LC.register(slug, {
      title: cfg.title, rule: cfg.rule, minSteps: 8,
      make: function (rng, round) {
        var g = cfg.gen(rng, round), a = g.a, n = a.length;
        var t = new LC.Trace();
        t.setup = g.setup;
        var ans = a.map(function () { return cfg.empty; }), st = [];
        var passes = cfg.circular ? 2 * n : n;
        function view(i) {
          var c = {}; c[i % n] = 'hit'; st.forEach(function (x) { c[x] = c[x] || 'warn'; });
          var main = cfg.list ? { t: 'list', v: a, ptr: { cur: i % n }, cls: c, label: 'list' } : P.arr(a, { ptr: { i: i % n }, cls: c, label: cfg.inputLabel || 'input' });
          return V(main, P.stack(st.map(function (x) { return a[x] + ' @' + x; }), 'stack (value @ index)'), P.arr(ans, { label: cfg.ansLabel }));
        }
        for (var i = 0; i < passes; i++) {
          var idx = i % n, cur = a[idx];
          while (st.length && cfg.settles(a[st[st.length - 1]], cur)) {
            var top = st[st.length - 1];
            var res = cfg.resolve(top, idx, a);
            t.act(view(i), cur + ' arrives' + (cfg.circular && i >= n ? ' (second lap)' : '') + '; top is ' + a[top] + '.', ACTS, 'pop',
              cfg.whyPop(a[top], cur), 'answer[' + top + '] = ' + res + '.');
            ans[top] = res; st.pop();
          }
          if (cfg.circular && i >= n) {
            if (st.length) t.act(view(i), cur + ' arrives (second lap); top is ' + a[st[st.length - 1]] + '.', [['pop', 'Pop top'], ['skip', 'Do not push on the second lap']], 'skip', cfg.whyPush(a[st[st.length - 1]], cur), 'Second lap only answers old indexes.');
            continue;
          }
          t.act(view(i), cur + ' arrives; top is ' + (st.length ? a[st[st.length - 1]] : 'empty') + '.', ACTS, 'push',
            st.length ? cfg.whyPush(a[st[st.length - 1]], cur) : 'The stack is empty; nothing to settle.', 'Index ' + idx + ' waits for its answer.');
          st.push(idx);
        }
        t.done(V(P.arr(ans, { label: cfg.ansLabel })), cfg.done(ans, g));
        return t;
      }
    });
  }

  mono('daily-temperatures', {
    title: 'Daily Temperatures: a warmer day pops the stack',
    rule: 'Keep a stack of days still waiting for a warmer day (temperatures decrease toward the top). A warmer day pops each colder day and answers it with the distance.',
    gen: function (rng, round) { var a = rng.ints(8 + round, 60, 80); return { a: a, setup: 'temperatures = ' + LC.fmt(a) }; },
    empty: 0, ansLabel: 'answer (days to wait)', inputLabel: 'temperatures',
    settles: function (top, cur) { return cur > top; },
    resolve: function (top, i) { return i - top; },
    whyPop: function (top, cur) { return cur + ' is warmer than ' + top + ', so that day finally has its answer.'; },
    whyPush: function (top, cur) { return cur + ' is not warmer than ' + top + ', so it cannot answer it. It waits too.'; },
    done: function (ans) { return 'answer = ' + LC.fmt(ans) + '. Each day is pushed and popped once: O(n).'; }
  });

  mono('next-greater-element-ii', {
    title: 'Next Greater Element II: walk the circle twice',
    rule: 'Same decreasing stack as Next Greater Element, but loop over the array twice. The second lap only answers indexes still waiting; it never pushes.',
    circular: true,
    gen: function (rng, round) { var a = rng.ints(6 + round, 1, 9); return { a: a, setup: 'nums (circular) = ' + LC.fmt(a) }; },
    empty: -1, ansLabel: 'next greater',
    settles: function (top, cur) { return cur > top; },
    resolve: function (top, i, a) { return a[i]; },
    whyPop: function (top, cur) { return cur + ' > ' + top + ', so it is the next greater value.'; },
    whyPush: function (top, cur) { return cur + ' is not greater than ' + top + '.'; },
    done: function (ans) { return 'answer = ' + LC.fmt(ans) + '. Still −1 means no greater value anywhere in the circle.'; }
  });

  mono('final-prices-with-a-special-discount-in-a-shop', {
    title: 'Final Prices With a Discount: first later price ≤ yours',
    rule: 'Each item waits on the stack for the first later price that is less than or equal to it. That price pops it and becomes its discount.',
    gen: function (rng, round) { var a = rng.ints(7 + round, 1, 9); return { a: a, setup: 'prices = ' + LC.fmt(a) }; },
    empty: null, ansLabel: 'final price',
    settles: function (top, cur) { return cur <= top; },
    resolve: function (top, i, a) { return a[top] - a[i]; },
    whyPop: function (top, cur) { return cur + ' ≤ ' + top + ', so it is the discount.'; },
    whyPush: function (top, cur) { return cur + ' > ' + top + ', so it cannot discount it.'; },
    done: function (ans, g) { var out = ans.map(function (x, i) { return x === null ? g.a[i] : x; }); return 'final = ' + LC.fmt(out) + ' (items never popped pay full price).'; }
  });

  mono('next-greater-node-in-linked-list', {
    title: 'Next Greater Node in Linked List: same stack, list input',
    rule: 'Walk the list and keep a stack of node indexes still waiting. A bigger value pops every smaller waiting node and is its answer.',
    list: true,
    gen: function (rng, round) { var a = rng.ints(7 + round, 1, 9); return { a: a, setup: 'head = ' + a.join(' → ') }; },
    empty: 0, ansLabel: 'answer',
    settles: function (top, cur) { return cur > top; },
    resolve: function (top, i, a) { return a[i]; },
    whyPop: function (top, cur) { return cur + ' > ' + top + ', so it is the next greater node.'; },
    whyPush: function (top, cur) { return cur + ' is not greater than ' + top + '.'; },
    done: function (ans) { return 'answer = ' + LC.fmt(ans) + '. 0 means no greater node after it.'; }
  });

  LC.register('next-greater-element-i', {
    title: 'Next Greater Element I: build the map over nums2',
    rule: 'Run a decreasing stack over nums2 to map every value to its next greater value. Then answer each nums1 value with a lookup.',
    minSteps: 8,
    make: function (rng, round) {
      var n = 7 + round, b = rng.distinct(n, 1, 12), a = rng.shuffle(b).slice(0, 3 + (round > 0 ? 1 : 0));
      var t = new LC.Trace();
      t.setup = 'nums1 = ' + LC.fmt(a) + '   nums2 = ' + LC.fmt(b);
      var st = [], map = {};
      function mapStr() { var k = Object.keys(map); return k.length ? k.map(function (x) { return x + '→' + map[x]; }).join(' ') : '—'; }
      for (var i = 0; i < n; i++) {
        while (st.length && b[i] > st[st.length - 1]) {
          var c = {}; c[i] = 'hit';
          t.act(V(P.arr(b, { ptr: { i: i }, cls: c, label: 'nums2' }), P.stack(st, 'stack'), P.vars([['map', mapStr()]])), b[i] + ' arrives; top is ' + st[st.length - 1] + '.', ACTS, 'pop', b[i] + ' > ' + st[st.length - 1] + ', so it is the next greater value.', 'map[' + st[st.length - 1] + '] = ' + b[i] + '.');
          map[st.pop()] = b[i];
        }
        var c2 = {}; c2[i] = 'hit';
        t.act(V(P.arr(b, { ptr: { i: i }, cls: c2, label: 'nums2' }), P.stack(st, 'stack'), P.vars([['map', mapStr()]])), b[i] + ' arrives; top is ' + (st.length ? st[st.length - 1] : 'empty') + '.', ACTS, 'push', st.length ? b[i] + ' is smaller than ' + st[st.length - 1] + '.' : 'Nothing to settle.', 'Waits.');
        st.push(b[i]);
      }
      a.forEach(function (x, j) {
        var c = {}; c[j] = 'hit';
        t.num(V(P.arr(a, { label: 'nums1', cls: c }), P.vars([['map', mapStr()]])), 'Next greater of ' + x + '?', map[x] !== undefined ? map[x] : -1, { wrong: map[x] !== undefined ? 'Look it up in the map.' : x + ' is not in the map, so it has none (−1).', note: 'Lookup in O(1).' });
      });
      t.done(V(P.arr(a.map(function (x) { return map[x] !== undefined ? map[x] : -1; }), { label: 'answer' })), 'Answer via one stack pass plus lookups: O(n + m).');
      return t;
    }
  });

  LC.register('online-stock-span', {
    title: 'Online Stock Span: absorb the spans you pop',
    rule: 'Keep (price, span) pairs with decreasing prices. A new price pops every pair with price ≤ it and adds their spans to its own (starting at 1).',
    minSteps: 8,
    make: function (rng, round) {
      var a = rng.ints(8 + round, 50, 90);
      var t = new LC.Trace();
      t.setup = 'prices (one per day) = ' + LC.fmt(a);
      var st = [], spans = [];
      function view(i, span) { var c = {}; c[i] = 'hit'; return V(P.arr(a, { ptr: { today: i }, cls: c, label: 'prices' }), P.stack(st.map(function (p) { return p[0] + ' (span ' + p[1] + ')'; }), 'stack (price, span)'), P.vars([['span so far', span]])); }
      for (var i = 0; i < a.length; i++) {
        var span = 1;
        while (st.length && st[st.length - 1][0] <= a[i]) {
          t.act(view(i, span), 'Price ' + a[i] + '; top is ' + st[st.length - 1][0] + '.', ACTS, 'pop', st[st.length - 1][0] + ' ≤ ' + a[i] + ', so those days count toward today\'s span.', 'span += ' + st[st.length - 1][1] + '.');
          span += st.pop()[1];
        }
        t.num(view(i, span), 'Nothing left to absorb. Span for ' + a[i] + '?', span, { wrong: 'Start at 1 and add the spans you popped.', note: 'Span ' + span + '. Push (' + a[i] + ', ' + span + ').' });
        st.push([a[i], span]); spans.push(span);
      }
      t.done(V(P.arr(spans, { label: 'spans' })), 'Spans ' + LC.fmt(spans) + '. Amortized O(1) per price.');
      return t;
    }
  });

  LC.register('largest-rectangle-in-histogram', {
    title: 'Largest Rectangle in Histogram: a shorter bar settles taller ones',
    rule: 'Keep bar indexes with increasing heights. A shorter bar pops each taller bar; that bar\'s rectangle spans from the new top + 1 to i − 1.',
    minSteps: 8,
    make: function (rng, round) {
      var hgt = rng.ints(6 + round, 1, 6), h = hgt.concat([0]);
      var t = new LC.Trace();
      t.setup = 'heights = ' + LC.fmt(hgt) + '   (a 0 sentinel is appended)';
      var st = [], best = 0, acts = [['pop', 'Pop and measure'], ['push', 'Push i']];
      function view(i) { var c = {}; c[i] = 'hit'; st.forEach(function (x) { c[x] = c[x] || 'warn'; }); return V(P.arr(h, { bars: true, ptr: { i: i }, cls: c, labels: h.map(function (_, j) { return j === hgt.length ? 'sentinel' : j; }) }), P.stack(st, 'index stack'), P.vars([['best', best]])); }
      for (var i = 0; i < h.length; i++) {
        while (st.length && h[i] < h[st[st.length - 1]]) {
          var top = st[st.length - 1];
          t.act(view(i), 'Bar ' + h[i] + ' arrives; top bar is ' + h[top] + '.', acts, 'pop', h[i] + ' < ' + h[top] + ': bar ' + top + ' cannot extend past i, so settle it now.', 'Measure bar ' + top + '.');
          st.pop();
          var left = st.length ? st[st.length - 1] : -1, width = i - left - 1, area = h[top] * width;
          t.num(view(i), 'Rectangle with height ' + h[top] + ': width runs from ' + (left + 1) + ' to ' + (i - 1) + '. Area?', area, { wrong: 'Area = height × (i − newTop − 1) = ' + h[top] + ' × ' + width + '.', note: 'Area ' + area + '.' });
          best = Math.max(best, area);
        }
        if (i < h.length - 1) {
          t.act(view(i), 'Bar ' + h[i] + ' arrives; top is ' + (st.length ? h[st[st.length - 1]] : 'empty') + '.', acts, 'push', st.length ? h[i] + ' ≥ ' + h[st[st.length - 1]] + ', so nothing is settled yet.' : 'Nothing to settle.', 'Push.');
          st.push(i);
        }
      }
      t.done(V(P.arr(hgt, { bars: true }), P.vars([['largest', best]])), 'Largest rectangle = ' + best + '. O(n).');
      return t;
    }
  });

  LC.register('remove-k-digits', {
    title: 'Remove K Digits: drop a bigger digit before a smaller one',
    rule: 'Keep the digits increasing. While you still have removals (k > 0) and the top digit is bigger than the incoming digit, pop it. Leftover k trims the end.',
    minSteps: 8,
    make: function (rng, round) {
      var d = []; for (var i = 0; i < 7 + round; i++) d.push(rng.int(i === 0 ? 1 : 0, 9));
      var k = rng.int(2, 3), k0 = k;
      var t = new LC.Trace();
      t.setup = 'num = "' + d.join('') + '"   k = ' + k;
      var st = [];
      function view(i) { var c = {}; c[i] = 'hit'; return V(P.arr(d, { ptr: { i: i }, cls: c, label: 'num' }), P.stack(st, 'kept digits'), P.vars([['k left', k]])); }
      for (i = 0; i < d.length; i++) {
        while (k > 0 && st.length && st[st.length - 1] > d[i]) {
          t.act(view(i), d[i] + ' arrives; top is ' + st[st.length - 1] + ', k = ' + k + '.', ACTS, 'pop', st[st.length - 1] + ' > ' + d[i] + ': removing it puts a smaller digit in a higher place.', 'Removed ' + st[st.length - 1] + '.');
          st.pop(); k--;
        }
        t.act(view(i), d[i] + ' arrives; top is ' + (st.length ? st[st.length - 1] : 'empty') + ', k = ' + k + '.', ACTS, 'push', k === 0 ? 'No removals left.' : st.length ? st[st.length - 1] + ' ≤ ' + d[i] + ', so removing it would not help.' : 'Nothing to compare.', 'Kept.');
        st.push(d[i]);
      }
      var kept = st.slice(0, st.length - k);
      var str = kept.join('').replace(/^0+/, '') || '0';
      t.done(V(P.stack(kept, 'result digits')), (k ? 'Trim ' + k + ' from the end. ' : '') + 'Smallest number after removing ' + k0 + ' digits: "' + str + '".');
      return t;
    }
  });
})();
