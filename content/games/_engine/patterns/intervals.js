/* Interval games: sort, then sweep left to right with one comparison per interval. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;

  function randIntervals(rng, n, maxT, maxLen) {
    var out = []; for (var i = 0; i < n; i++) { var s = rng.int(0, maxT - 1); out.push([s, Math.min(maxT, s + rng.int(1, maxLen))]); } return out;
  }
  function ivals(v, cls, label, extra) { var p = { t: 'ival', v: v, cls: cls || {}, label: label || 'intervals' }; for (var k in extra) p[k] = extra[k]; return p; }
  function bySort(a) { return a.slice().sort(function (x, y) { return x[0] - y[0] || x[1] - y[1]; }); }
  function f(iv) { return '[' + iv[0] + ',' + iv[1] + ']'; }

  LC.register('merge-intervals', {
    title: 'Merge Intervals: overlap extends, a gap starts new',
    rule: 'Sort by start. Compare each interval with the last merged one: if it starts at or before that end, extend the end (max of both ends); otherwise start a new merged interval.',
    make: function (rng, round) {
      var a = bySort(randIntervals(rng, 6 + round, 18, 5));
      var t = new LC.Trace();
      t.setup = 'sorted intervals = ' + a.map(f).join(' ');
      var merged = [a[0].slice()], acts = [['ext', 'Overlaps: extend last'], ['new', 'Gap: start new']];
      for (var i = 1; i < a.length; i++) {
        var last = merged[merged.length - 1], ov = a[i][0] <= last[1], c = {}; c[i] = 'hit';
        t.act(V(ivals(a, c, 'sorted input', { lo: 0, hi: 18 }), ivals(merged, (function () { var o = {}; o[merged.length - 1] = 'warn'; return o; })(), 'merged', { lo: 0, hi: 18 })), f(a[i]) + ' vs last merged ' + f(last) + '.', acts, ov ? 'ext' : 'new',
          ov ? a[i][0] + ' ≤ ' + last[1] + ': they overlap (touching counts).' : a[i][0] + ' > ' + last[1] + ': there is a gap.', ov ? 'End = max(' + last[1] + ', ' + a[i][1] + ') = ' + Math.max(last[1], a[i][1]) + '.' : 'New block.');
        if (ov) last[1] = Math.max(last[1], a[i][1]); else merged.push(a[i].slice());
      }
      t.done(V(ivals(merged, {}, 'merged', { lo: 0, hi: 18 })), 'Merged: ' + merged.map(f).join(' ') + '. O(n log n).');
      return t;
    }
  });

  LC.register('insert-interval', {
    title: 'Insert Interval: before, overlap, after',
    rule: 'Intervals ending before the new one are copied. Intervals that overlap it are absorbed (stretch the new interval). Once one starts after it, place the new interval and copy the rest.',
    make: function (rng, round) {
      var a = [], s = rng.int(0, 2);
      for (var i = 0; i < 5 + round; i++) { var e = s + rng.int(1, 3); a.push([s, e]); s = e + rng.int(1, 3); }
      var lo = rng.int(1, s - 4), nw = [lo, lo + rng.int(2, 6)];
      var t = new LC.Trace();
      t.setup = 'intervals = ' + a.map(f).join(' ') + '   newInterval = ' + f(nw);
      var out = [], cur = nw.slice(), placed = false, hi = Math.max(s, nw[1]) + 1;
      var acts = [['before', 'Ends before: copy it'], ['merge', 'Overlaps: absorb it'], ['after', 'Starts after: place new, copy it']];
      for (i = 0; i < a.length; i++) {
        var iv = a[i], c = {}; c[i] = 'hit';
        var view = V(ivals(a, c, 'intervals', { lo: 0, hi: hi }), ivals([cur], { 0: 'warn' }, placed ? 'new (placed)' : 'new interval (growing)', { lo: 0, hi: hi }), ivals(out, {}, 'result', { lo: 0, hi: hi }));
        var key = placed || iv[0] > cur[1] ? 'after' : iv[1] < cur[0] ? 'before' : 'merge';
        if (placed) { t.act(view, f(iv) + ' after placing the new interval.', acts, 'after', 'Everything after the placed interval is copied as is.', 'Copied.'); out.push(iv.slice()); continue; }
        t.act(view, f(iv) + ' vs new ' + f(cur) + '.', acts, key, { before: iv[1] + ' ≥ ' + cur[0] + ', so it does not end before the new interval.', merge: key === 'before' ? 'It ends at ' + iv[1] + ' < ' + cur[0] + '; no overlap.' : 'It starts at ' + iv[0] + ' > ' + cur[1] + '; no overlap.', after: iv[0] + ' ≤ ' + cur[1] + ', so it does not start after the new interval.' },
          key === 'before' ? 'Copy.' : key === 'merge' ? 'New becomes ' + f([Math.min(cur[0], iv[0]), Math.max(cur[1], iv[1])]) + '.' : 'Place ' + f(cur) + ', then copy.');
        if (key === 'before') out.push(iv.slice());
        else if (key === 'merge') cur = [Math.min(cur[0], iv[0]), Math.max(cur[1], iv[1])];
        else { out.push(cur.slice()); out.push(iv.slice()); placed = true; }
      }
      if (!placed) out.push(cur.slice());
      t.done(V(ivals(out, {}, 'result', { lo: 0, hi: hi })), 'Result: ' + out.map(f).join(' ') + '. O(n).');
      return t;
    }
  });

  LC.register('meeting-rooms', {
    title: 'Meeting Rooms: sorted, any start before the last end clashes',
    rule: 'Sort by start time. A person can attend all meetings only if every meeting starts at or after the previous one ends.',
    make: function (rng, round) {
      var a = bySort(randIntervals(rng, 5 + round, 20, 4));
      var t = new LC.Trace();
      t.setup = 'meetings sorted by start = ' + a.map(f).join(' ');
      var acts = [['ok', 'No clash, keep going'], ['clash', 'Clash → false']], res = true;
      for (var i = 1; i < a.length; i++) {
        var c = {}; c[i - 1] = 'warn'; c[i] = 'hit';
        var clash = a[i][0] < a[i - 1][1];
        t.act(V(ivals(a, c, 'meetings', { lo: 0, hi: 24 })), f(a[i - 1]) + ' then ' + f(a[i]) + '.', acts, clash ? 'clash' : 'ok', clash ? a[i][0] + ' < ' + a[i - 1][1] + ': it starts before the previous one ends.' : a[i][0] + ' ≥ ' + a[i - 1][1] + ': back to back is fine.', clash ? 'Cannot attend both.' : 'Fine.');
        if (clash) { res = false; break; }
      }
      t.done(V(ivals(a, {}, 'meetings', { lo: 0, hi: 24 })), res ? 'True: no overlaps.' : 'False.');
      return t;
    }
  });

  LC.register('meeting-rooms-ii', {
    title: 'Meeting Rooms II: reuse the room that frees up first',
    rule: 'Sort by start. Keep a min-heap of end times (one per room). If the earliest end ≤ the new start, that room is free: reuse it. Otherwise open a new room.',
    make: function (rng, round) {
      var a = bySort(randIntervals(rng, 6 + round, 20, 7));
      var t = new LC.Trace();
      t.setup = 'meetings sorted by start = ' + a.map(f).join(' ');
      var heap = [], rooms = 0, acts = [['reuse', 'Reuse room (replace earliest end)'], ['open', 'Open a new room']];
      for (var i = 0; i < a.length; i++) {
        heap.sort(function (x, y) { return x - y; });
        var c = {}; c[i] = 'hit';
        var view = V(ivals(a, c, 'meetings', { lo: 0, hi: 27 }), P.arr(heap, { label: 'room end times (min-heap, smallest first)', cls: { 0: 'warn' } }), P.vars([['rooms', rooms]]));
        var free = heap.length && heap[0] <= a[i][0];
        t.act(view, f(a[i]) + ' starts at ' + a[i][0] + '. Earliest end: ' + (heap.length ? heap[0] : 'none') + '.', acts, free ? 'reuse' : 'open',
          free ? 'A room frees up at ' + heap[0] + ' ≤ ' + a[i][0] + '; reuse it.' : heap.length ? 'Even the earliest room is busy until ' + heap[0] + ' > ' + a[i][0] + '.' : 'There are no rooms yet.',
          free ? 'Reused.' : 'Rooms = ' + (rooms + 1) + '.');
        if (free) heap[0] = a[i][1]; else { heap.push(a[i][1]); rooms++; }
      }
      t.num(V(ivals(a, {}, 'meetings', { lo: 0, hi: 27 })), 'Minimum rooms needed?', heap.length, { wrong: 'The number of rooms you opened.', note: heap.length + ' rooms.' });
      t.done(V(ivals(a, {}, 'meetings', { lo: 0, hi: 27 })), heap.length + ' rooms. O(n log n).');
      return t;
    }
  });

  LC.register('non-overlapping-intervals', {
    title: 'Non-overlapping Intervals: keep the earliest end',
    rule: 'Sort by END time. Keep an interval whenever it starts at or after the last kept end; otherwise remove it. Ending early leaves the most room for the rest.',
    make: function (rng, round) {
      var a = randIntervals(rng, 6 + round, 16, 5).sort(function (x, y) { return x[1] - y[1] || x[0] - y[0]; });
      var t = new LC.Trace();
      t.setup = 'intervals sorted by end = ' + a.map(f).join(' ');
      var end = -Infinity, removed = 0, cls = {}, acts = [['keep', 'Keep it'], ['rm', 'Remove it']];
      for (var i = 0; i < a.length; i++) {
        var c = LC.clone(cls); c[i] = 'hit';
        var keep = a[i][0] >= end;
        t.act(V(ivals(a, c, 'by end time', { lo: 0, hi: 21, mark: end === -Infinity ? null : end }), P.vars([['last kept end', end], ['removed', removed]])), f(a[i]) + '.', acts, keep ? 'keep' : 'rm',
          keep ? 'It starts at ' + a[i][0] + ' ≥ last kept end ' + LC.fmt(end) + ', so it fits.' : 'It starts at ' + a[i][0] + ' < ' + end + ' and overlaps the kept interval. The kept one ends sooner, so remove this one.',
          keep ? 'Kept; last end = ' + a[i][1] + '.' : 'Removed.');
        if (keep) { end = a[i][1]; cls[i] = 'ok'; } else { removed++; cls[i] = 'dim'; }
      }
      t.num(V(ivals(a, cls, 'result', { lo: 0, hi: 21 })), 'Minimum removals?', removed, { wrong: 'Count the intervals you removed.', note: removed + '.' });
      t.done(V(ivals(a, cls, 'result', { lo: 0, hi: 21 })), removed + ' removed.');
      return t;
    }
  });

  LC.register('minimum-number-of-arrows-to-burst-balloons', {
    title: 'Minimum Arrows: shoot at the earliest end',
    rule: 'Sort balloons by end. Shoot an arrow at the first balloon\'s end; it pops every balloon that starts at or before that point. The next unpopped balloon needs a new arrow at its end.',
    make: function (rng, round) {
      var a = randIntervals(rng, 6 + round, 16, 5).sort(function (x, y) { return x[1] - y[1] || x[0] - y[0]; });
      var t = new LC.Trace();
      t.setup = 'balloons sorted by end = ' + a.map(f).join(' ');
      var arrow = null, arrows = 0, cls = {}, acts = [['pop', 'Already popped by the arrow'], ['new', 'Needs a new arrow at its end']];
      for (var i = 0; i < a.length; i++) {
        var c = LC.clone(cls); c[i] = 'hit';
        var popped = arrow !== null && a[i][0] <= arrow;
        t.act(V(ivals(a, c, 'balloons', { lo: 0, hi: 21, mark: arrow }), P.vars([['arrow at', arrow === null ? 'none' : arrow], ['arrows', arrows]])), 'Balloon ' + f(a[i]) + '.', acts, popped ? 'pop' : 'new',
          popped ? 'It starts at ' + a[i][0] + ' ≤ arrow ' + arrow + ' and ends after it, so the arrow passes through it.' : arrow === null ? 'No arrow has been shot yet.' : 'It starts at ' + a[i][0] + ' > ' + arrow + '; the arrow misses it.',
          popped ? 'Popped for free.' : 'Arrow at ' + a[i][1] + '.');
        if (popped) cls[i] = 'dim'; else { arrow = a[i][1]; arrows++; cls[i] = 'ok'; }
      }
      t.num(V(ivals(a, cls, 'balloons', { lo: 0, hi: 21 })), 'Minimum arrows?', arrows, { wrong: 'Count the arrows you shot.', note: arrows + '.' });
      t.done(V(ivals(a, cls, 'balloons', { lo: 0, hi: 21 })), arrows + ' arrows.');
      return t;
    }
  });

  LC.register('interval-list-intersections', {
    title: 'Interval List Intersections: advance whoever ends first',
    rule: 'Intersect the current intervals: [max(starts), min(ends)] if it is not empty. Then advance the list whose interval ends first; it cannot meet anything else.',
    make: function (rng, round) {
      function list() { var out = [], s = rng.int(0, 2); for (var i = 0; i < 3 + (round > 0 ? 1 : 0); i++) { var e = s + rng.int(1, 4); out.push([s, e]); s = e + rng.int(1, 3); } return out; }
      var A = list(), B = list(), hi = Math.max(A[A.length - 1][1], B[B.length - 1][1]) + 1;
      var t = new LC.Trace();
      t.setup = 'A = ' + A.map(f).join(' ') + '   B = ' + B.map(f).join(' ');
      var i = 0, j = 0, out = [], acts = [['A', 'Advance A'], ['B', 'Advance B']];
      while (i < A.length && j < B.length) {
        var lo = Math.max(A[i][0], B[j][0]), up = Math.min(A[i][1], B[j][1]);
        if (lo <= up) out.push([lo, up]);
        var ca = {}; ca[i] = 'hit'; var cb = {}; cb[j] = 'hit';
        var key = A[i][1] < B[j][1] ? 'A' : A[i][1] > B[j][1] ? 'B' : ['A', 'B'];
        t.act(V(ivals(A, ca, 'A', { lo: 0, hi: hi }), ivals(B, cb, 'B', { lo: 0, hi: hi }), ivals(out, {}, 'intersections', { lo: 0, hi: hi })), (lo <= up ? 'Intersection ' + f([lo, up]) + ' recorded. ' : 'No overlap. ') + 'Which list moves?', acts, key,
          { A: 'A ends at ' + A[i][1] + ', later than B (' + B[j][1] + '); it may still meet B\'s next interval.', B: 'B ends at ' + B[j][1] + ', later than A (' + A[i][1] + '); it may still meet A\'s next interval.' },
          'The one that ends first is finished.');
        if (A[i][1] < B[j][1]) i++; else j++;
      }
      t.done(V(ivals(out, {}, 'intersections', { lo: 0, hi: hi })), 'Intersections: ' + (out.length ? out.map(f).join(' ') : 'none') + '. O(m + n).');
      return t;
    }
  });
})();
