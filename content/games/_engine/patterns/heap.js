/* Heap top-K games: a size-k heap whose top is the boundary. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;
  var ACTS = [['push', 'Push (heap not full)'], ['replace', 'Push, then pop the top'], ['skip', 'Skip it']];

  function heapView(heap, label, extra) { var h = heap.slice().sort(function (a, b) { return a - b; }); return P.arr(h, { label: label, cls: h.length ? { 0: 'warn' } : {} }); }

  function kthStep(t, view, heap, k, x) {
    var key = heap.length < k ? 'push' : x > Math.min.apply(null, heap) ? 'replace' : 'skip';
    var top = heap.length ? Math.min.apply(null, heap) : null;
    t.act(view, x + ' arrives. Heap size ' + heap.length + ' / ' + k + (top !== null ? ', top ' + top : '') + '.', ACTS, key,
      { push: 'The heap already holds k = ' + k + ' values.', replace: heap.length < k ? 'The heap is not full yet; just push.' : x + ' at most top ' + top + ', so it cannot be among the k largest.', skip: heap.length < k ? 'The heap is not full yet; every value gets in.' : x + ' > top ' + top + ', so it beats the current k-th largest.' },
      key === 'replace' ? 'Evict ' + top + '.' : key === 'push' ? 'Pushed.' : 'Ignored.');
    if (key === 'push') heap.push(x);
    else if (key === 'replace') { heap.splice(heap.indexOf(top), 1); heap.push(x); }
  }

  LC.register('kth-largest-element-in-an-array', {
    title: 'Kth Largest Element: a min-heap of size k',
    rule: 'Keep the k largest values seen so far in a MIN-heap. A new value enters only if it beats the top (the smallest of them). At the end, the top is the k-th largest.',
    make: function (rng, round) {
      var a = rng.ints(8 + round, 1, 30), k = rng.int(2, 3 + (round > 0 ? 1 : 0));
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a) + '   k = ' + k;
      var heap = [];
      a.forEach(function (x, i) { var c = {}; c[i] = 'hit'; kthStep(t, V(P.arr(a, { cls: c, ptr: { i: i } }), heapView(heap, 'min-heap (top first)')), heap, k, x); });
      var top = Math.min.apply(null, heap);
      t.num(V(heapView(heap, 'min-heap (top first)')), 'k-th largest?', top, { wrong: 'It is the top of the size-k min-heap.', note: top + '.' });
      t.done(V(heapView(heap, 'min-heap')), 'k-th largest = ' + top + '. O(n log k).');
      return t;
    }
  });

  LC.register('kth-largest-element-in-a-stream', {
    title: 'Kth Largest Element in a Stream: report the heap top',
    rule: 'Hold the k largest values in a min-heap. Each add() pushes the value (popping the top when the heap would exceed k), then returns the top.',
    make: function (rng, round) {
      var k = rng.int(2, 3), init = rng.ints(k + rng.int(0, 1), 1, 20), adds = rng.ints(4 + round, 1, 25);
      var t = new LC.Trace();
      t.setup = 'k = ' + k + '   nums = ' + LC.fmt(init) + '   then add: ' + adds.join(', ');
      var heap = init.slice().sort(function (a, b) { return b - a; }).slice(0, k);
      adds.forEach(function (x, i) {
        var c = {}; c[i] = 'hit';
        kthStep(t, V(P.arr(adds, { cls: c, label: 'stream' }), heapView(heap, 'min-heap (top first)')), heap, k, x);
        var top = Math.min.apply(null, heap);
        t.num(V(P.arr(adds, { cls: c, label: 'stream' }), heapView(heap, 'min-heap (top first)')), 'add(' + x + ') returns?', top, { wrong: 'Return the top of the heap: the smallest of the k largest.', note: top + '.' });
      });
      t.done(V(heapView(heap, 'min-heap')), 'Each add is O(log k).');
      return t;
    }
  });

  LC.register('k-closest-points-to-origin', {
    title: 'K Closest Points: a max-heap evicts the farthest',
    rule: 'Compare squared distances x² + y². Keep k points in a MAX-heap by distance; a new point replaces the top (the farthest kept) only if it is closer.',
    make: function (rng, round) {
      var n = 6 + round, k = rng.int(2, 3), pts = [];
      while (pts.length < n) { var p = [rng.int(-3, 3), rng.int(-3, 3)]; if ((p[0] || p[1]) && !pts.some(function (q) { return q[0] === p[0] && q[1] === p[1]; })) pts.push(p); }
      var d = pts.map(function (p) { return p[0] * p[0] + p[1] * p[1]; });
      var t = new LC.Trace();
      t.setup = 'k = ' + k + '   points = ' + pts.map(function (p) { return '(' + p[0] + ',' + p[1] + ')'; }).join(' ');
      var heap = [], acts = [['push', 'Push (heap not full)'], ['replace', 'Replace the farthest'], ['skip', 'Skip it']];
      function view(i) {
        var cls = { O: 'dim' }; heap.forEach(function (j) { cls['p' + j] = 'blue'; }); if (i !== null) cls['p' + i] = 'hit';
        return V({ t: 'graph', label: 'plane (+ = origin, blue = in heap)', w: 340, h: 340, n: [{ id: 'O', x: 50, y: 50, l: '+' }].concat(pts.map(function (p, j) { return { id: 'p' + j, x: 50 + p[0] * 15, y: 50 - p[1] * 15, l: String(j) }; })), e: [], cls: cls },
          P.arr(heap.slice().sort(function (a, b) { return d[b] - d[a]; }).map(function (j) { return '#' + j + ':' + d[j]; }), { label: 'max-heap by dist² (top first)' }));
      }
      for (var i = 0; i < n; i++) {
        if (i === 0) t.num(view(i), 'Point #0 is (' + pts[0][0] + ', ' + pts[0][1] + '). Squared distance?', d[0], { wrong: 'x² + y² = ' + pts[0][0] * pts[0][0] + ' + ' + pts[0][1] * pts[0][1] + '.', note: d[0] + '. No square root needed to compare.' });
        var far = heap.length ? heap.reduce(function (a, b) { return d[a] >= d[b] ? a : b; }) : null;
        var key = heap.length < k ? 'push' : d[i] < d[far] ? 'replace' : 'skip';
        t.act(view(i), 'Point #' + i + ' (' + pts[i][0] + ', ' + pts[i][1] + '), dist² ' + d[i] + '.', acts, key,
          { push: 'The heap already holds k points.', replace: heap.length < k ? 'Not full yet; just push.' : d[i] + ' at least farthest kept ' + d[far] + '.', skip: heap.length < k ? 'Not full yet; every point gets in.' : d[i] + ' < farthest kept ' + d[far] + ', so it is closer.' },
          key === 'replace' ? 'Evict #' + far + '.' : key === 'push' ? 'Pushed.' : 'Skipped.');
        if (key === 'push') heap.push(i); else if (key === 'replace') { heap.splice(heap.indexOf(far), 1); heap.push(i); }
      }
      t.done(view(null), 'Closest ' + k + ': ' + heap.map(function (j) { return '(' + pts[j][0] + ',' + pts[j][1] + ')'; }).join(' ') + '. O(n log k).');
      return t;
    }
  });
})();
