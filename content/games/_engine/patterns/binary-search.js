/* Binary Search games: look at mid, throw away the half that cannot hold the answer. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;
  var before = Object.keys(LC.problems);
  var CLOSED = [['F', 'Found: return mid'], ['L', 'Go left: hi = mid − 1'], ['R', 'Go right: lo = mid + 1']];
  var HALF = [['L', 'Keep left: hi = mid'], ['R', 'Go right: lo = mid + 1']];
  var HALF2 = [['L', 'Go left: hi = mid − 1'], ['R', 'Go right: lo = mid + 1']];

  function arrView(a, lo, hi, mid, extra, o) {
    var c = {};
    for (var i = 0; i < a.length; i++) if (i < lo || i > hi) c[i] = 'dim';
    if (mid !== null && mid !== undefined) c[mid] = 'hit';
    if (o && o.cls) for (var k in o.cls) c[k] = o.cls[k];
    var ptr = {};
    function add(name, at) { if (at === null || at === undefined || at < 0) return; var existing = Object.keys(ptr).filter(function (x) { return ptr[x] === at; })[0]; if (existing) { ptr[existing + ',' + name] = at; delete ptr[existing]; } else ptr[name] = at; }
    add('lo', lo); add('mid', mid); add('hi', hi);
    var panels = [P.arr(a, { ptr: ptr, cls: c, label: o && o.label, labels: o && o.labels })];
    if (extra) panels.push(P.vars(extra));
    return V.apply(null, panels);
  }
  function rangeView(lo, hi, mid, full, extra) {
    return V({ t: 'ival', v: [[lo, hi]], lo: full[0], hi: full[1], mark: mid, names: ['range'], label: 'search space' }, P.vars([['lo', lo], ['mid', mid], ['hi', hi]].concat(extra || [])));
  }

  LC.register('binary-search', {
    title: 'Binary Search: halve the range every probe',
    rule: 'Compare nums[mid] with the target. Equal: done. Smaller: the target can only be right of mid. Larger: only left.',
    make: function (rng, round) {
      var n = 10 + round * 2, a = rng.distinct(n, -10, 40).sort(function (x, y) { return x - y; });
      var target = rng.chance(0.75) ? rng.pick(a) : rng.int(-10, 40);
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a) + '   target = ' + target;
      var lo = 0, hi = n - 1, res = -1;
      while (lo <= hi) {
        var mid = (lo + hi) >> 1, v = arrView(a, lo, hi, mid, [['target', target], ['nums[mid]', a[mid]]]);
        if (a[mid] === target) { t.act(v, 'nums[mid] = ' + a[mid] + '.', CLOSED, 'F', 'nums[mid] is the target.', 'Found at ' + mid + '.'); res = mid; break; }
        if (a[mid] < target) { t.act(v, 'nums[mid] = ' + a[mid] + ' < ' + target + '.', CLOSED, 'R', { F: 'Not equal.', L: 'Everything left of mid is even smaller.' }, 'Discard the left half.'); lo = mid + 1; }
        else { t.act(v, 'nums[mid] = ' + a[mid] + ' > ' + target + '.', CLOSED, 'L', { F: 'Not equal.', R: 'Everything right of mid is even bigger.' }, 'Discard the right half.'); hi = mid - 1; }
      }
      t.done(arrView(a, lo, hi, res >= 0 ? res : null), res >= 0 ? 'Index ' + res + ' in O(log n).' : 'lo passed hi: not present, return −1.');
      return t;
    }
  });

  LC.register('search-insert-position', {
    title: 'Search Insert Position: lo lands on the spot',
    rule: 'Run a normal binary search. If the target is missing, lo ends at the first index whose value is bigger, which is exactly where it belongs.',
    make: function (rng, round) {
      var n = 9 + round * 2, a = rng.distinct(n, 1, 40).sort(function (x, y) { return x - y; });
      var target = rng.chance(0.35) ? rng.pick(a) : rng.int(0, 42);
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a) + '   target = ' + target;
      var lo = 0, hi = n - 1, res = null;
      while (lo <= hi) {
        var mid = (lo + hi) >> 1, v = arrView(a, lo, hi, mid, [['target', target]]);
        if (a[mid] === target) { t.act(v, 'nums[mid] = ' + a[mid] + '.', CLOSED, 'F', 'It is the target.', 'Found at ' + mid + '.'); res = mid; break; }
        if (a[mid] < target) { t.act(v, 'nums[mid] = ' + a[mid] + ' < ' + target + '.', CLOSED, 'R', { F: 'Not equal.', L: 'The target is bigger than everything left of mid.' }, 'lo = ' + (mid + 1) + '.'); lo = mid + 1; }
        else { t.act(v, 'nums[mid] = ' + a[mid] + ' > ' + target + '.', CLOSED, 'L', { F: 'Not equal.', R: 'The target is smaller than everything right of mid.' }, 'hi = ' + (mid - 1) + '.'); hi = mid - 1; }
      }
      if (res === null) {
        t.num(arrView(a, lo, hi, null, [['lo', lo], ['hi', hi]]), 'lo > hi. Insert position?', lo, { wrong: 'When the search ends, lo is the first index with a bigger value.', note: 'Insert at ' + lo + '.' });
        res = lo;
      }
      t.done(arrView(a, 0, n - 1, res < n ? res : null), 'Answer ' + res + '.');
      return t;
    }
  });

  LC.register('first-bad-version', {
    title: 'First Bad Version: a bad mid could be the first',
    rule: 'If mid is bad, the first bad version is mid or earlier, so keep mid (hi = mid). If mid is good, it is after mid (lo = mid + 1). Stop when lo == hi.',
    make: function (rng, round) {
      var n = 12 + round * 4, bad = rng.int(2, n);
      var vers = []; for (var i = 1; i <= n; i++) vers.push(i);
      var t = new LC.Trace();
      t.setup = 'n = ' + n + '   (isBadVersion is hidden until you call it)';
      var lo = 1, hi = n, seen = {};
      while (lo < hi) {
        var mid = (lo + hi) >> 1, isBad = mid >= bad; seen[mid - 1] = isBad ? 'bad' : 'ok';
        var v = arrView(vers, lo - 1, hi - 1, mid - 1, [['isBadVersion(' + mid + ')', isBad]], { cls: seen });
        if (isBad) t.act(v, 'Version ' + mid + ' is bad.', HALF, 'L', 'mid itself might be the first bad one; lo = mid + 1 would skip it.', 'hi = ' + mid + '.');
        else t.act(v, 'Version ' + mid + ' is good.', HALF, 'R', 'Good versions come before the first bad one, so everything at most mid is good.', 'lo = ' + (mid + 1) + '.');
        if (isBad) hi = mid; else lo = mid + 1;
      }
      t.num(arrView(vers, lo - 1, hi - 1, null, [['lo', lo], ['hi', hi]], { cls: seen }), 'lo == hi. First bad version?', lo, { wrong: 'lo and hi have met on the answer.', note: 'Version ' + lo + '.' });
      t.done(arrView(vers, lo - 1, lo - 1, lo - 1, null, { cls: seen }), 'First bad = ' + lo + ' using O(log n) API calls.');
      return t;
    }
  });

  LC.register('guess-number-higher-or-lower', {
    title: 'Guess Number Higher or Lower: always guess the middle',
    rule: 'Guess mid. "Higher" means the pick is above mid (lo = mid + 1); "lower" means below (hi = mid − 1). Each guess halves the range.',
    make: function (rng, round) {
      var n = [50, 100, 200][round] || 100, pick = rng.int(1, n);
      var t = new LC.Trace();
      t.setup = 'n = ' + n + '   (the pick is hidden)';
      var lo = 1, hi = n;
      while (lo <= hi) {
        var mid = Math.floor((lo + hi) / 2), g = pick === mid ? 0 : pick < mid ? -1 : 1;
        var say = g === 0 ? '0 (correct)' : g === 1 ? '1 (higher)' : '−1 (lower)';
        var v = rangeView(lo, hi, mid, [1, n], [['guess(mid)', say]]);
        if (g === 0) { t.act(v, 'guess(' + mid + ') says ' + say + '.', CLOSED, 'F', 'guess returned 0.', 'Got it.'); break; }
        if (g === 1) { t.act(v, 'guess(' + mid + ') says ' + say + '.', CLOSED, 'R', { F: 'Not correct yet.', L: 'Higher means the pick is ABOVE mid.' }, 'lo = ' + (mid + 1) + '.'); lo = mid + 1; }
        else { t.act(v, 'guess(' + mid + ') says ' + say + '.', CLOSED, 'L', { F: 'Not correct yet.', R: 'Lower means the pick is BELOW mid.' }, 'hi = ' + (mid - 1) + '.'); hi = mid - 1; }
      }
      t.done(rangeView(pick, pick, pick, [1, n]), 'The pick was ' + pick + '. At most log₂ of ' + n + ', rounded up, guesses.');
      return t;
    }
  });

  function answerSpace(slug, title, rule, gen, ok, describe, finalAsk) {
    LC.register(slug, {
      title: title, rule: rule,
      make: function (rng, round) {
        var g = gen(rng, round);
        var t = new LC.Trace();
        t.setup = g.setup;
        var lo = g.lo, hi = g.hi, ans = g.lo - 1;
        while (lo <= hi) {
          var mid = Math.floor((lo + hi) / 2), r = ok(mid, g);
          var v = rangeView(lo, hi, mid, [g.lo, g.hi], [[describe(mid, g), r === 0 ? '= target' : r < 0 ? 'fits' : 'too big']]);
          if (r === 0 && g.exact) { t.act(v, describe(mid, g) + ': exact.', CLOSED, 'F', 'It is exact.', 'Found.'); ans = mid; break; }
          if (r <= 0) { t.act(v, describe(mid, g) + (r === 0 ? ' (exactly).' : ' fits.'), g.exact ? CLOSED : HALF2, 'R', { F: 'Not exact.', L: 'mid fits, so the answer is mid or bigger. Record mid and look right.' }, g.exact ? 'Too small: lo = ' + (mid + 1) + '.' : 'ans = ' + mid + ', lo = ' + (mid + 1) + '.'); ans = mid; lo = mid + 1; }
          else { t.act(v, describe(mid, g) + ' is too big.', g.exact ? CLOSED : HALF2, 'L', { F: 'Not exact.', R: 'mid is already too big; bigger values are worse.' }, 'hi = ' + (mid - 1) + '.'); hi = mid - 1; }
        }
        var final = g.exact ? (ok(ans, g) === 0) : ans;
        if (!g.exact) t.num(rangeView(lo, hi, null, [g.lo, g.hi]), finalAsk, ans, { wrong: 'The answer is the last mid that fit (now hi).', note: 'Answer ' + ans + '.' });
        t.done(rangeView(g.exact ? lo : ans, g.exact ? hi : ans, null, [g.lo, g.hi]), g.exact ? (final ? 'True: it is a perfect square.' : 'False: lo passed hi with no exact square.') : 'Answer ' + ans + '.');
        return t;
      }
    });
  }

  answerSpace('sqrt-x', 'Sqrt(x): binary search on the answer',
    'Search k in [0, x]. If k times k is at most x, k is a candidate and the answer is k or bigger; otherwise it is smaller. The last k that fit wins.',
    function (rng, round) { var x = rng.int([10, 40, 120][round] || 50, [40, 120, 400][round] || 200); return { lo: 0, hi: x, x: x, setup: 'x = ' + x }; },
    function (k, g) { return k * k <= g.x ? -1 : 1; }, function (k) { return k + '² = ' + k * k; }, 'Integer square root?');

  answerSpace('valid-perfect-square', 'Valid Perfect Square: hunt for an exact square',
    'Search k in [1, num]. k² == num: true. k² < num: look right. k² > num: look left. If lo passes hi, it is not a perfect square.',
    function (rng, round) { var num = rng.chance(0.6) ? Math.pow(rng.int(3, 15 + round * 5), 2) : rng.int(10, 300); return { lo: 1, hi: num, x: num, exact: true, setup: 'num = ' + num }; },
    function (k, g) { return k * k === g.x ? 0 : k * k < g.x ? -1 : 1; }, function (k) { return k + '² = ' + k * k; });

  answerSpace('arranging-coins', 'Arranging Coins: largest complete staircase',
    'Search k rows. k complete rows need k(k+1) divided by 2 coins. If that fits in n, k is possible and the answer is k or more.',
    function (rng, round) { var n = rng.int(8, [30, 80, 200][round] || 100); return { lo: 0, hi: n, x: n, setup: 'n = ' + n + ' coins' }; },
    function (k, g) { return k * (k + 1) / 2 <= g.x ? -1 : 1; }, function (k) { return k + ' rows need ' + (k * (k + 1) / 2); }, 'Complete rows?');

  LC.register('find-first-and-last-position-of-element-in-sorted-array', {
    title: 'First and Last Position: keep searching after a hit',
    rule: 'Two searches. For the first position, a hit records mid and keeps going LEFT. For the last position, a hit records mid and keeps going RIGHT.',
    make: function (rng, round) {
      var n = 10 + round * 2, a = rng.sorted(n, 1, 9), target = rng.chance(0.85) ? rng.pick(a) : 10;
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a) + '   target = ' + target;
      var res = [];
      ['first', 'last'].forEach(function (phase) {
        var lo = 0, hi = n - 1, found = -1;
        while (lo <= hi) {
          var mid = (lo + hi) >> 1, v = arrView(a, lo, hi, mid, [['searching', phase + ' ' + target], ['recorded', found]]);
          if (a[mid] === target) {
            if (phase === 'first') t.act(v, 'Hit at ' + mid + ' while looking for the FIRST position.', HALF2, 'L', 'An earlier copy may exist to the left. Record mid and keep looking left.', 'Record ' + mid + ', hi = mid − 1.');
            else t.act(v, 'Hit at ' + mid + ' while looking for the LAST position.', HALF2, 'R', 'A later copy may exist to the right. Record mid and keep looking right.', 'Record ' + mid + ', lo = mid + 1.');
            found = mid;
            if (phase === 'first') hi = mid - 1; else lo = mid + 1;
          } else if (a[mid] < target) { t.act(v, 'nums[mid] = ' + a[mid] + ' < ' + target + '.', HALF2, 'R', 'Too small: the target is to the right.', 'lo = mid + 1.'); lo = mid + 1; }
          else { t.act(v, 'nums[mid] = ' + a[mid] + ' > ' + target + '.', HALF2, 'L', 'Too big: the target is to the left.', 'hi = mid − 1.'); hi = mid - 1; }
        }
        res.push(found);
      });
      var c = {}; if (res[0] >= 0) for (var i = res[0]; i <= res[1]; i++) c[i] = 'ok';
      t.done(V(P.arr(a, { cls: c })), 'Answer [' + res.join(', ') + '] in two O(log n) searches.');
      return t;
    }
  });

  function rotated(rng, n) { var a = rng.distinct(n, 1, 40).sort(function (x, y) { return x - y; }); var k = rng.int(1, n - 1); return a.slice(k).concat(a.slice(0, k)); }

  LC.register('find-minimum-in-rotated-sorted-array', {
    title: 'Find Minimum in Rotated Sorted Array: compare mid to hi',
    rule: 'If nums[mid] > nums[hi], the drop (and the minimum) is right of mid: lo = mid + 1. Otherwise the minimum is mid or left of it: hi = mid.',
    make: function (rng, round) {
      var n = 9 + round * 2, a = rotated(rng, n);
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a);
      var lo = 0, hi = n - 1;
      while (lo < hi) {
        var mid = (lo + hi) >> 1, v = arrView(a, lo, hi, mid, [['nums[mid]', a[mid]], ['nums[hi]', a[hi]]]);
        if (a[mid] > a[hi]) t.act(v, a[mid] + ' vs ' + a[hi] + '.', HALF, 'R', 'nums[mid] > nums[hi] means the values drop somewhere after mid.', 'The minimum is right of mid.');
        else t.act(v, a[mid] + ' vs ' + a[hi] + '.', HALF, 'L', 'mid to hi is sorted, so the minimum is mid or left of it. Do not skip mid.', 'hi = mid.');
        if (a[mid] > a[hi]) lo = mid + 1; else hi = mid;
      }
      t.done(arrView(a, lo, lo, lo), 'Minimum ' + a[lo] + ' at index ' + lo + '.');
      return t;
    }
  });

  LC.register('search-in-rotated-sorted-array', {
    title: 'Search in Rotated Sorted Array: find the sorted half first',
    rule: 'One half of [lo, hi] is always sorted. Find it (nums[lo] at most nums[mid] means the left half). If the target lies inside that sorted range, go there; otherwise go to the other half.',
    make: function (rng, round) {
      var n = 9 + round * 2, a = rotated(rng, n), target = rng.chance(0.8) ? rng.pick(a) : 41;
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a) + '   target = ' + target;
      var lo = 0, hi = n - 1, res = -1, sortActs = [['LS', 'Left half is sorted'], ['RS', 'Right half is sorted']];
      while (lo <= hi) {
        var mid = (lo + hi) >> 1, v = arrView(a, lo, hi, mid, [['target', target]]);
        if (a[mid] === target) { t.act(v, 'nums[mid] = ' + a[mid] + '.', CLOSED, 'F', 'It is the target.', 'Found.'); res = mid; break; }
        var leftSorted = a[lo] <= a[mid];
        t.act(v, 'Which half of [' + lo + ', ' + hi + '] is sorted?', sortActs, leftSorted ? 'LS' : 'RS', leftSorted ? 'nums[lo] = ' + a[lo] + ' at most nums[mid] = ' + a[mid] + ', so lo to mid has no drop.' : 'nums[lo] = ' + a[lo] + ' > nums[mid] = ' + a[mid] + ', so the drop is in the left half; mid to hi is sorted.', leftSorted ? 'Left half [' + a[lo] + '..' + a[mid] + '] is sorted.' : 'Right half [' + a[mid] + '..' + a[hi] + '] is sorted.');
        var goLeft = leftSorted ? (a[lo] <= target && target < a[mid]) : !(a[mid] < target && target <= a[hi]);
        t.act(v, leftSorted ? 'Is ' + target + ' inside [' + a[lo] + ', ' + a[mid] + ')?' : 'Is ' + target + ' inside (' + a[mid] + ', ' + a[hi] + ']?', CLOSED, goLeft ? 'L' : 'R',
          { F: 'nums[mid] is not the target.', L: 'The target is not in the left part.', R: 'The target is not in the right part.' }, goLeft ? 'Go left.' : 'Go right.');
        if (goLeft) hi = mid - 1; else lo = mid + 1;
      }
      t.done(arrView(a, 0, n - 1, res >= 0 ? res : null), res >= 0 ? 'Found at ' + res + ' in O(log n).' : 'Not found: −1.');
      return t;
    }
  });

  function peak(slug, title, rule, gen) {
    LC.register(slug, {
      title: title, rule: rule,
      make: function (rng, round) {
        var a = gen(rng, round), n = a.length;
        var t = new LC.Trace();
        t.setup = 'arr = ' + LC.fmt(a);
        var lo = 0, hi = n - 1;
        while (lo < hi) {
          var mid = (lo + hi) >> 1, up = a[mid] < a[mid + 1];
          var c = {}; c[mid + 1] = 'warn';
          var v = arrView(a, lo, hi, mid, [['a[mid]', a[mid]], ['a[mid+1]', a[mid + 1]]], { cls: c });
          t.act(v, a[mid] + ' vs its right neighbor ' + a[mid + 1] + '.', HALF, up ? 'R' : 'L', up ? 'The slope goes up to the right, so a peak must exist on the right.' : 'The slope goes down to the right, so mid or something left of it is a peak.', up ? 'Climb right.' : 'Keep mid; peak is here or left.');
          if (up) lo = mid + 1; else hi = mid;
        }
        t.done(arrView(a, lo, lo, lo), 'Peak at index ' + lo + ' (value ' + a[lo] + ').');
        return t;
      }
    });
  }
  peak('find-peak-element', 'Find Peak Element: walk uphill',
    'Compare nums[mid] with nums[mid + 1]. If the right neighbor is bigger, a peak exists on the right. Otherwise mid or the left side has one.',
    function (rng, round) { var a = rng.ints(9 + round * 2, 1, 20); for (var i = 1; i < a.length; i++) if (a[i] === a[i - 1]) a[i] += 1; return a; });
  peak('peak-index-in-a-mountain-array', 'Peak Index in a Mountain Array: up-slope or down-slope?',
    'A mountain rises, then falls. If arr[mid] < arr[mid + 1] you are on the up-slope (go right); otherwise you are at the peak or on the down-slope (keep left).',
    function (rng, round) { var n = 9 + round * 2, p = rng.int(1, n - 2), a = [], v = rng.int(0, 3); for (var i = 0; i < n; i++) { a.push(v); v += (i < p ? 1 : -1) * rng.int(1, 4); } return a; });

  function capacity(slug, title, rule, gen, cost, unit, describeCost) {
    LC.register(slug, {
      title: title, rule: rule,
      make: function (rng, round) {
        var g = gen(rng, round);
        var t = new LC.Trace();
        t.setup = g.setup;
        var lo = g.lo, hi = g.hi, first = true;
        while (lo < hi) {
          var mid = Math.floor((lo + hi) / 2), c = cost(mid, g), okay = c <= g.limit;
          var v = V(P.arr(g.a, { label: g.label }), { t: 'ival', v: [[lo, hi]], lo: g.lo, hi: g.hi, mark: mid, names: [unit], label: 'search space for ' + unit }, P.vars([['lo', lo], ['mid', mid], ['hi', hi], [describeCost, c], ['limit', g.limit]]));
          if (first) { first = false; var v0 = LC.clone(v); v0.panels[2].v[3][1] = '?'; t.num(v0, 'At ' + unit + ' = ' + mid + ', how many ' + describeCost + '?', c, { wrong: g.hint(mid), note: c + ' ' + describeCost + '.' }); }
          t.act(v, unit + ' ' + mid + ' needs ' + c + ' ' + describeCost + ' (limit ' + g.limit + ').', HALF, okay ? 'L' : 'R',
            okay ? 'It fits, so mid could be the answer. Keep it and try smaller.' : 'It does not fit; anything smaller fits even less.',
            okay ? 'Feasible: hi = mid.' : 'Too slow: lo = mid + 1.');
          if (okay) hi = mid; else lo = mid + 1;
        }
        t.num(V(P.arr(g.a, { label: g.label }), P.vars([['lo', lo], ['hi', hi]])), 'lo == hi. Minimum ' + unit + '?', lo, { wrong: 'lo and hi met on the smallest feasible value.', note: 'Answer ' + lo + '.' });
        t.done(V(P.arr(g.a, { label: g.label }), P.vars([[unit, lo], [describeCost, cost(lo, g)]])), 'Minimum ' + unit + ' = ' + lo + '.');
        return t;
      }
    });
  }
  capacity('koko-eating-bananas', 'Koko Eating Bananas: binary search on speed',
    'Search the speed k in [1, max pile]. Hours at speed k = the sum of ceil(pile divided by k). If that is at most h, k works and smaller might too; otherwise go faster.',
    function (rng, round) { var a = rng.ints(4 + round, 3, 30), h = a.length + rng.int(1, 4); var mx = Math.max.apply(null, a); return { a: a, limit: h, lo: 1, hi: mx, label: 'piles', setup: 'piles = ' + LC.fmt(a) + '   h = ' + h, hint: function (k) { return 'the sum of ceil(pile / ' + k + ') = ' + a.map(function (p) { return Math.ceil(p / k); }).join(' + ') + '.'; } }; },
    function (k, g) { return g.a.reduce(function (s, p) { return s + Math.ceil(p / k); }, 0); }, 'speed', 'hours');
  capacity('capacity-to-ship-packages-within-d-days', 'Capacity to Ship Packages: binary search on capacity',
    'Search capacity in [max weight, total weight]. Load greedily in order; count the days. If the day count is at most D, the capacity works and smaller might too.',
    function (rng, round) {
      var a = rng.ints(6 + round, 1, 9), d = rng.int(2, 4), sum = a.reduce(function (x, y) { return x + y; }, 0);
      return { a: a, limit: d, lo: Math.max.apply(null, a), hi: sum, label: 'weights', setup: 'weights = ' + LC.fmt(a) + '   days = ' + d, hint: function (cap) { return 'Load in order and start a new day when the next package would pass ' + cap + '.'; } };
    },
    function (cap, g) { var days = 1, load = 0; g.a.forEach(function (w) { if (load + w > cap) { days++; load = 0; } load += w; }); return days; }, 'capacity', 'days');

  LC.register('find-smallest-letter-greater-than-target', {
    title: 'Smallest Letter Greater Than Target: strictly greater, then wrap',
    rule: 'Find the first letter strictly greater than the target: letters[mid] at most target, so go right; otherwise keep mid. If lo runs off the end, wrap to letters[0].',
    make: function (rng, round) {
      var pool = 'abcdefghijklmnopqrstuvwxyz'.split(''), n = 7 + round * 2;
      var a = rng.shuffle(pool).slice(0, n).sort();
      var target = rng.chance(0.25) ? a[n - 1] : rng.pick(pool);
      var t = new LC.Trace();
      t.setup = 'letters = ' + JSON.stringify(a) + '   target = "' + target + '"';
      var lo = 0, hi = n;
      var disp = a.concat(['end']);
      while (lo < hi) {
        var mid = (lo + hi) >> 1, v = arrView(disp, lo, hi, mid, [['target', target]]);
        if (a[mid] <= target) t.act(v, '"' + a[mid] + '" vs "' + target + '".', HALF, 'R', '"' + a[mid] + '" is not strictly greater, so the answer is after it.', 'lo = mid + 1.');
        else t.act(v, '"' + a[mid] + '" vs "' + target + '".', HALF, 'L', '"' + a[mid] + '" is greater and might be the first one; keep it.', 'hi = mid.');
        if (a[mid] <= target) lo = mid + 1; else hi = mid;
      }
      var wrap = lo === n;
      t.act(arrView(disp, lo, lo, null, [['lo', lo]]), wrap ? 'lo ran past the last letter.' : 'lo == hi at "' + a[lo] + '".', [['here', 'Answer letters[lo]'], ['wrap', 'Wrap: letters[0]']], wrap ? 'wrap' : 'here', wrap ? 'No letter is greater, so the list wraps around.' : 'letters[lo] is the first one greater than the target.', wrap ? '"' + a[0] + '".' : '"' + a[lo] + '".');
      t.done(arrView(a, 0, n - 1, wrap ? 0 : lo), 'Answer "' + (wrap ? a[0] : a[lo]) + '".');
      return t;
    }
  });

  LC.register('single-element-in-a-sorted-array', {
    title: 'Single Element in a Sorted Array: pairs break after the single',
    rule: 'Look at an even mid. If nums[mid] == nums[mid + 1], the pairs are still aligned and the single is to the right. Otherwise it is mid or to the left.',
    make: function (rng, round) {
      var pairs = 4 + round, vals = rng.distinct(pairs + 1, 1, 30).sort(function (x, y) { return x - y; }), single = rng.int(0, pairs);
      var a = []; vals.forEach(function (v, i) { a.push(v); if (i !== single) a.push(v); });
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a);
      var lo = 0, hi = a.length - 1, acts = [['L', 'Keep left: hi = mid'], ['R', 'Go right: lo = mid + 2']];
      while (lo < hi) {
        var mid = (lo + hi) >> 1; if (mid % 2 === 1) mid--;
        var same = a[mid] === a[mid + 1];
        var c = {}; c[mid + 1] = 'warn';
        t.act(arrView(a, lo, hi, mid, [['mid (even)', mid], ['nums[mid]', a[mid]], ['nums[mid+1]', a[mid + 1]]], { cls: c }), 'Even mid ' + mid + ': ' + a[mid] + ' vs ' + a[mid + 1] + '.', acts, same ? 'R' : 'L',
          same ? 'The pair starts at an even index, so everything up to mid + 1 is paired normally.' : 'The pairing is broken at or before mid, so the single is mid or to the left.',
          same ? 'Single is right of the pair.' : 'Single is here or left.');
        if (same) lo = mid + 2; else hi = mid;
      }
      t.done(arrView(a, lo, lo, lo), 'Single element ' + a[lo] + ' in O(log n).');
      return t;
    }
  });

  LC.register('search-a-2d-matrix', {
    title: 'Search a 2D Matrix: one sorted list in disguise',
    rule: 'Treat the m times n matrix as one sorted array of length m times n. Index i lives at row i divided by n, column i % n. Then run a normal binary search.',
    make: function (rng, round) {
      var m = 3 + (round > 1 ? 1 : 0), n = 4, vals = rng.distinct(m * n, 1, 60).sort(function (x, y) { return x - y; });
      var grid = []; for (var r = 0; r < m; r++) grid.push(vals.slice(r * n, r * n + n));
      var target = rng.chance(0.7) ? rng.pick(vals) : rng.int(1, 60);
      var t = new LC.Trace();
      t.setup = 'matrix ' + m + ' by ' + n + '   target = ' + target;
      var lo = 0, hi = m * n - 1, res = false, first = true;
      function gv(lo, hi, mid) { var cls = {}; for (var i = 0; i < m * n; i++) { var key = Math.floor(i / n) + ',' + (i % n); if (i < lo || i > hi) cls[key] = 'dim'; } if (mid !== null) cls[Math.floor(mid / n) + ',' + (mid % n)] = 'hit'; return cls; }
      while (lo <= hi) {
        var mid = (lo + hi) >> 1, row = Math.floor(mid / n), col = mid % n, val = grid[row][col];
        var v = V(P.grid(grid, { cls: gv(lo, hi, mid), rh: grid.map(function (_, i) { return 'r' + i; }), ch: grid[0].map(function (_, i) { return 'c' + i; }) }), P.vars([['lo', lo], ['mid', mid], ['hi', hi], ['target', target]]));
        if (first) {
          first = false;
          var v0 = LC.clone(v); v0.panels[0].cls[row + ',' + col] = undefined;
          t.num(v0, 'mid = ' + mid + '. Which row is it in?', row, { wrong: 'row = mid divided by n = ' + mid + ' / ' + n + ' (integer division).', note: 'Row ' + row + ', column ' + mid + ' % ' + n + ' = ' + col + '.' });
        }
        if (val === target) { t.act(v, 'matrix[' + row + '][' + col + '] = ' + val + '.', CLOSED, 'F', 'It is the target.', 'Found.'); res = true; break; }
        if (val < target) { t.act(v, 'matrix[' + row + '][' + col + '] = ' + val + ' < ' + target + '.', CLOSED, 'R', { F: 'Not equal.', L: 'All earlier cells are smaller still.' }, 'lo = mid + 1.'); lo = mid + 1; }
        else { t.act(v, 'matrix[' + row + '][' + col + '] = ' + val + ' > ' + target + '.', CLOSED, 'L', { F: 'Not equal.', R: 'All later cells are bigger still.' }, 'hi = mid − 1.'); hi = mid - 1; }
      }
      t.done(V(P.grid(grid, {})), res ? 'Found in O(log(m times n)).' : 'Not in the matrix.');
      return t;
    }
  });

  /* A search is only about log n moves, so these games play five quick rounds. */
  Object.keys(LC.problems).forEach(function (slug) {
    if (before.indexOf(slug) !== -1) return;
    var def = LC.problems[slug], make = def.make;
    def.rounds = 5;
    def.minSteps = 3;
    def.make = function (rng, round) { return make(rng, Math.min(round, 2)); };
  });
})();
