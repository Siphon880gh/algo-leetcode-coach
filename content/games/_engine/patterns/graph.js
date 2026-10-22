/* Graph games: topological waves, visited-set flood, BFS layers. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;

  function circle(n, names) { var out = []; for (var i = 0; i < n; i++) { var a = -Math.PI / 2 + 2 * Math.PI * i / n; out.push({ id: names ? names[i] : String(i), x: 50 + 45 * Math.cos(a), y: 50 + 45 * Math.sin(a) }); } return out; }
  function G(n, e, dir, cls, tag, label) { return { t: 'graph', n: n, e: e, dir: dir, cls: cls || {}, tag: tag || {}, pick: 'n', label: label || 'graph' }; }

  function randDag(rng, n, extra) {
    var perm = rng.shuffle(Array.from({ length: n }, function (_, i) { return i; })), e = [], seen = {};
    for (var k = 0; k < n + extra; k++) {
      var a = rng.int(0, n - 2), b = rng.int(a + 1, n - 1), u = perm[a], v = perm[b];
      if (!seen[u + '>' + v]) { seen[u + '>' + v] = 1; e.push([u, v]); }
    }
    return e;
  }

  function kahn(slug, title, rule, wantOrder) {
    LC.register(slug, {
      title: title, rule: rule, minSteps: 3,
      make: function (rng, round) {
        var n = 5 + (round > 0 ? 1 : 0), e = randDag(rng, n, 1 + round), cyc = rng.chance(0.35);
        if (cyc && e.length) { var back = rng.pick(e); if (!e.some(function (x) { return x[0] === back[1] && x[1] === back[0]; })) e.push([back[1], back[0]]); }
        var nodes = circle(n);
        var t = new LC.Trace();
        t.setup = 'numCourses = ' + n + '   arrows: a → b means take a before b   prerequisites = ' + JSON.stringify(e.map(function (x) { return [x[1], x[0]]; }));
        var indeg = {}, done = {}, out = [];
        for (var i = 0; i < n; i++) indeg[i] = 0;
        e.forEach(function (x) { indeg[x[1]]++; });
        function view() {
          var cls = {}, tag = {}, ecls = {};
          for (var i = 0; i < n; i++) { if (done[i]) cls[i] = 'done'; else tag[i] = 'in ' + indeg[i]; }
          e.forEach(function (x) { if (done[x[0]]) ecls[x[0] + '>' + x[1]] = 'dim'; });
          var g = G(nodes, e, true, cls, tag, 'courses (in = remaining prerequisites)'); g.ecls = ecls;
          return V(g, P.arr(out, { label: 'order taken' }));
        }
        while (true) {
          var wave = []; for (i = 0; i < n; i++) if (!done[i] && indeg[i] === 0) wave.push(i);
          if (!wave.length) break;
          var aset = {}; wave.forEach(function (x) { aset['n:' + x] = 1; });
          var wm = {}; for (i = 0; i < n; i++) if (!aset['n:' + i]) wm['n:' + i] = done[i] ? 'Already taken.' : 'Course ' + i + ' still has ' + indeg[i] + ' unmet prerequisite(s).';
          t.pick(view(), 'Click every course you can take now (in-degree 0).', wave.map(function (x) { return 'n:' + x; }), { all: true, wrongMap: wm, note: 'Take them and remove their outgoing arrows.' });
          wave.forEach(function (x) { done[x] = 1; out.push(x); e.forEach(function (y) { if (y[0] === x) indeg[y[1]]--; }); });
        }
        var left = n - out.length;
        t.act(view(), 'No course has in-degree 0 any more.', [['ok', wantOrder ? 'Return the order' : 'Return true'], ['cyc', wantOrder ? 'Return [] (cycle)' : 'Return false (cycle)']], left ? 'cyc' : 'ok',
          left ? left + ' course(s) are stuck waiting on each other: a cycle.' : 'Every course was taken.', left ? 'Cycle detected.' : 'All courses scheduled.');
        t.done(view(), left ? 'Impossible: a cycle blocks ' + left + ' course(s).' : (wantOrder ? 'Order ' + LC.fmt(out) + '.' : 'True: all courses can be finished.') + ' O(V + E).');
        return t;
      }
    });
  }
  kahn('course-schedule', 'Course Schedule: take what has no prerequisites left', 'Kahn\'s algorithm: repeatedly take every course whose in-degree is 0 and remove its outgoing edges. If some courses never reach in-degree 0, they are in a cycle.', false);
  kahn('course-schedule-ii', 'Course Schedule II: the removal order is the schedule', 'Same as Course Schedule: take in-degree-0 courses and remove their edges. The order you take them is a valid schedule; a leftover means return [].', true);

  LC.register('keys-and-rooms', {
    title: 'Keys and Rooms: visit every room your keys open',
    rule: 'DFS from room 0 with a visited set. Every key in a visited room opens another room. Rooms you never reach are locked forever.',
    minSteps: 2,
    make: function (rng, round) {
      var n = 6 + (round > 0 ? 1 : 0), keys = [];
      for (var i = 0; i < n; i++) { var ks = []; for (var j = 0; j < rng.int(0, 2); j++) { var k = rng.int(0, n - 1); if (k !== i && ks.indexOf(k) === -1) ks.push(k); } keys.push(ks); }
      if (!keys[0].length) keys[0].push(rng.int(1, n - 1));
      var e = []; keys.forEach(function (ks, a) { ks.forEach(function (b) { e.push([a, b]); }); });
      var t = new LC.Trace();
      t.setup = 'rooms = ' + JSON.stringify(keys) + '   (room i holds the keys listed at i)';
      var seen = { 0: 1 }, st = [0];
      while (st.length) { var x = st.pop(); keys[x].forEach(function (y) { if (!seen[y]) { seen[y] = 1; st.push(y); } }); }
      var reach = Object.keys(seen).map(Number).filter(function (x) { return x !== 0; });
      var links = {}; keys.forEach(function (ks, a) { links['n:' + a] = ks.map(function (b) { return 'n:' + b; }); });
      var nodes = circle(n), cls = { 0: 'ok' };
      if (reach.length) {
        var aset = {}; reach.forEach(function (r) { aset['n:' + r] = 1; });
        var wm = {}; for (i = 1; i < n; i++) if (!aset['n:' + i]) wm['n:' + i] = 'No room you can reach holds the key to room ' + i + '.';
        wm['n:0'] = 'Room 0 is already open.';
        t.pick(V(G(nodes, e, true, cls, {}, 'rooms (arrow a → b: room a has key b)')), 'Room 0 is open. Click every room you can unlock.', reach.map(function (r) { return 'n:' + r; }), { all: true, links: links, seeds: ['n:0'], wrongMap: wm, wrongChain: 'You do not hold that key yet. Open rooms one key at a time.', note: 'Visited set complete.' });
      }
      reach.forEach(function (r) { cls[r] = 'ok'; });
      var all = reach.length + 1 === n;
      t.act(V(G(nodes, e, true, cls)), 'Nothing new opens.', [['T', 'Every room visited → true'], ['F', 'Some room locked → false']], all ? 'T' : 'F', all ? 'You visited all ' + n + ' rooms.' : (n - reach.length - 1) + ' room(s) were never reached.', all ? 'True.' : 'False.');
      t.done(V(G(nodes, e, true, cls)), all ? 'All rooms open.' : 'Some rooms stay locked.');
      return t;
    }
  });

  LC.register('find-if-path-exists-in-graph', {
    title: 'Find if Path Exists: BFS layers from the source',
    rule: 'BFS from source with a visited set. Each layer is every unvisited neighbor of the last layer. Stop as soon as destination appears; if the layers run out, there is no path.',
    minSteps: 2,
    make: function (rng, round) {
      var n = 7 + (round > 0 ? 1 : 0), e = [], seen = {};
      for (var k = 0; k < n; k++) { var a = rng.int(0, n - 1), b = rng.int(0, n - 1); var key = Math.min(a, b) + '-' + Math.max(a, b); if (a !== b && !seen[key]) { seen[key] = 1; e.push([a, b]); } }
      var src = rng.int(0, n - 1), dst; do { dst = rng.int(0, n - 1); } while (dst === src);
      var adj = {}; for (var i = 0; i < n; i++) adj[i] = [];
      e.forEach(function (x) { adj[x[0]].push(x[1]); adj[x[1]].push(x[0]); });
      var t = new LC.Trace();
      t.setup = 'n = ' + n + '   edges = ' + JSON.stringify(e) + '   source = ' + src + '   destination = ' + dst;
      var nodes = circle(n), visited = {}, layer = [src], cls = {}, tag = {}, found = false, d = 0;
      visited[src] = 1; cls[src] = 'hit'; tag[src] = 'S'; tag[dst] = (tag[dst] || '') + 'D';
      while (true) {
        var next = []; layer.forEach(function (x) { adj[x].forEach(function (y) { if (!visited[y] && next.indexOf(y) === -1) next.push(y); }); });
        if (!next.length) break;
        var aset = {}; next.forEach(function (x) { aset['n:' + x] = 1; });
        var wm = {}; for (i = 0; i < n; i++) if (!aset['n:' + i]) wm['n:' + i] = visited[i] ? 'Already visited.' : 'Not adjacent to the last layer.';
        t.pick(V(G(nodes, e, false, LC.clone(cls), tag, 'graph (S = source, D = destination)')), 'Layer ' + (d + 1) + ': click every unvisited neighbor of the last layer.', next.map(function (x) { return 'n:' + x; }), { all: true, wrongMap: wm, note: 'Layer ' + (d + 1) + ' visited.' });
        next.forEach(function (x) { visited[x] = 1; cls[x] = 'blue'; });
        d++;
        if (visited[dst]) { found = true; break; }
        layer = next;
      }
      cls[dst] = found ? 'ok' : 'bad';
      t.act(V(G(nodes, e, false, cls, tag)), found ? 'Destination is in this layer.' : 'No new nodes to visit.', [['T', 'Return true'], ['F', 'Return false']], found ? 'T' : 'F', found ? 'The destination was reached.' : 'The BFS ran out before reaching the destination.', found ? 'Path exists.' : 'No path.');
      t.done(V(G(nodes, e, false, cls, tag)), (found ? 'True' : 'False') + '. O(V + E).');
      return t;
    }
  });
})();
