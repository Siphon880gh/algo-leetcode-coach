/* Union-Find games: follow parents to the root, union only different roots. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;

  function circle(n) { var out = []; for (var i = 0; i < n; i++) { var a = -Math.PI / 2 + 2 * Math.PI * i / n; out.push({ id: String(i), x: 50 + 45 * Math.cos(a), y: 50 + 45 * Math.sin(a) }); } return out; }
  function find(par, x) { while (par[x] !== x) x = par[x]; return x; }
  function view(par, nodes, done, cur, extraVars) {
    var ecls = {}; done.forEach(function (e) { ecls[e[0] + '>' + e[1]] = 'ok'; });
    var cls = {}; if (cur) { cls[cur[0]] = 'hit'; cls[cur[1]] = 'hit'; ecls[cur[0] + '>' + cur[1]] = 'hit'; }
    var es = done.slice(); if (cur) es.push(cur);
    var panels = [{ t: 'graph', n: nodes, e: es, cls: cls, ecls: ecls, label: 'edges processed so far' }, P.arr(par, { label: 'parent[] (follow it up to a root, where parent[x] = x)', idx: true })];
    if (extraVars && Object.keys(extraVars).length) panels.push(P.vars(Object.keys(extraVars).map(function (k) { return [k, extraVars[k]]; })));
    return V.apply(null, panels);
  }
  function randEdges(rng, n, m) { var e = [], seen = {}; while (e.length < m) { var a = rng.int(0, n - 1), b = rng.int(0, n - 1); var k = Math.min(a, b) + '-' + Math.max(a, b); if (a !== b && !seen[k]) { seen[k] = 1; e.push([Math.min(a, b), Math.max(a, b)]); } } return e; }
  var ACTS = [['union', 'Different roots: union'], ['skip', 'Same root: skip']];

  function counting(slug, title, rule, label, setupFn) {
    LC.register(slug, {
      title: title, rule: rule,
      make: function (rng, round) {
        var n = 6 + (round > 0 ? 1 : 0), e = randEdges(rng, n, rng.int(4, 5 + round));
        var t = new LC.Trace();
        t.setup = setupFn(n, e);
        var par = Array.from({ length: n }, function (_, i) { return i; }), nodes = circle(n), done = [], comps = n;
        e.forEach(function (x, i) {
          var ra = find(par, x[0]), rb = find(par, x[1]), key = ra === rb ? 'skip' : 'union';
          if (i < 2) t.num(view(par, nodes, done, x, { components: comps }), 'Edge ' + x[0] + '-' + x[1] + ': find(' + x[1] + ') = ?', rb, { wrong: 'Follow parent[] from ' + x[1] + ' until parent[x] = x.', note: 'Root of ' + x[1] + ' is ' + rb + '.' });
          t.act(view(par, nodes, done, x, { components: comps }), 'Edge ' + x[0] + '-' + x[1] + '.', ACTS, key,
            key === 'union' ? 'find(' + x[0] + ') = ' + ra + ' and find(' + x[1] + ') = ' + rb + ': different groups, so merge them.' : 'Both have root ' + ra + ': already in the same group.',
            key === 'union' ? 'parent[' + rb + '] = ' + ra + '. ' + label + ' −1.' : 'No change.');
          if (key === 'union') { par[rb] = ra; comps--; }
          done.push(x);
        });
        var roots = 0; par.forEach(function (p, i) { if (p === i) roots++; });
        t.num(view(par, nodes, done, null, {}), label + '?', comps, { wrong: 'Start at n = ' + n + ' and subtract one per successful union (or count roots).', note: comps + ' (' + roots + ' roots).' });
        t.done(view(par, nodes, done, null, { components: comps }), label + ' = ' + comps + '. Near O(E α(n)) with path compression.');
        return t;
      }
    });
  }
  counting('number-of-provinces', 'Number of Provinces: count the roots', 'Each city starts as its own province. For every connection, find both roots; different roots means two provinces merge (count − 1). Same root: nothing changes.', 'Provinces',
    function (n, e) { return n + ' cities   connections (isConnected[i][j] = 1): ' + e.map(function (x) { return x[0] + '-' + x[1]; }).join(', '); });
  counting('number-of-connected-components-in-an-undirected-graph', 'Connected Components: every union removes one', 'Start with n components. For each edge, find both roots; if they differ, union them and subtract one. Same root means the edge adds nothing.', 'Components',
    function (n, e) { return 'n = ' + n + '   edges = ' + JSON.stringify(e); });

  LC.register('redundant-connection', {
    title: 'Redundant Connection: the edge whose ends already share a root',
    rule: 'Add edges in order with Union-Find. The first edge whose two endpoints already have the same root closes a cycle: that edge is redundant.',
    make: function (rng, round) {
      var n = 5 + (round > 0 ? 1 : 0) + (round > 1 ? 1 : 0);
      var order = rng.shuffle(Array.from({ length: n }, function (_, i) { return i; })), tree = [];
      for (var i = 1; i < n; i++) { var p = order[rng.int(0, i - 1)], c = order[i]; tree.push([Math.min(p, c), Math.max(p, c)]); }
      var extra; do { var a = rng.int(0, n - 1), b = rng.int(0, n - 1); extra = [Math.min(a, b), Math.max(a, b)]; } while (a === b || tree.some(function (x) { return x[0] === extra[0] && x[1] === extra[1]; }));
      var e = rng.shuffle(tree.concat([extra]));
      // labels 1..n as on LeetCode
      var t = new LC.Trace();
      t.setup = 'edges = ' + JSON.stringify(e.map(function (x) { return [x[0] + 1, x[1] + 1]; })) + '   (nodes shown 0-based)';
      var par = Array.from({ length: n }, function (_, i) { return i; }), nodes = circle(n), done = [], ans = null;
      for (i = 0; i < e.length; i++) {
        var x = e[i], ra = find(par, x[0]), rb = find(par, x[1]), same = ra === rb;
        t.act(view(par, nodes, done, x), 'Edge ' + x[0] + '-' + x[1] + '.', [['union', 'Different roots: union'], ['red', 'Same root: redundant!']], same ? 'red' : 'union',
          same ? 'find(' + x[0] + ') = find(' + x[1] + ') = ' + ra + ': they are already connected, so this edge makes a cycle.' : 'Roots ' + ra + ' and ' + rb + ' differ: this edge joins two trees.',
          same ? 'Found it.' : 'parent[' + rb + '] = ' + ra + '.');
        if (same) { ans = x; break; }
        par[rb] = ra; done.push(x);
      }
      t.done(view(par, nodes, done, ans), 'Redundant edge: [' + (ans[0] + 1) + ', ' + (ans[1] + 1) + '] (1-based). O(n α(n)).');
      return t;
    }
  });
})();
