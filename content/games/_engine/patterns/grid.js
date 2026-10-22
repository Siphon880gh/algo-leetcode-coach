/* Grid flood-fill / BFS games: click cells to spread exactly the way DFS or BFS would. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;
  var D4 = [[1, 0], [-1, 0], [0, 1], [0, -1]];

  function id(r, c) { return 'g:' + r + ',' + c; }
  function rand(rng, R, C, p) { var g = []; for (var r = 0; r < R; r++) { var row = []; for (var c = 0; c < C; c++) row.push(rng.chance(p) ? 1 : 0); g.push(row); } return g; }
  function inside(g, r, c) { return r >= 0 && c >= 0 && r < g.length && c < g[0].length; }
  function comps(g, isOn) {
    var seen = {}, out = [];
    for (var r = 0; r < g.length; r++) for (var c = 0; c < g[0].length; c++) {
      if (!isOn(g[r][c]) || seen[r + ',' + c]) continue;
      var q = [[r, c]], cells = []; seen[r + ',' + c] = 1;
      while (q.length) {
        var cur = q.shift(); cells.push(cur);
        D4.forEach(function (d) { var nr = cur[0] + d[0], nc = cur[1] + d[1]; if (inside(g, nr, nc) && isOn(g[nr][nc]) && !seen[nr + ',' + nc]) { seen[nr + ',' + nc] = 1; q.push([nr, nc]); } });
      }
      out.push(cells);
    }
    return out;
  }
  function links(g, ok) {
    var L = {};
    for (var r = 0; r < g.length; r++) for (var c = 0; c < g[0].length; c++) {
      L[id(r, c)] = [];
      D4.forEach(function (d) { var nr = r + d[0], nc = c + d[1]; if (inside(g, nr, nc) && ok(r, c, nr, nc)) L[id(r, c)].push(id(nr, nc)); });
    }
    return L;
  }
  function wrongMapFor(g, ansSet, describe) {
    var m = {};
    for (var r = 0; r < g.length; r++) for (var c = 0; c < g[0].length; c++) if (!ansSet[id(r, c)]) m[id(r, c)] = describe(r, c);
    return m;
  }
  function onBorder(g, r, c) { return r === 0 || c === 0 || r === g.length - 1 || c === g[0].length - 1; }

  function landView(g, cls, o) {
    o = o || {};
    var cc = g.map(function (row) { return row.map(function (v) { return v ? (o.landCls || 'land') : 'water'; }); });
    return V(P.grid(g, { cc: cc, cls: cls, pick: 'g', hide: !o.show, label: o.label || 'grid' }), o.vars ? P.vars(o.vars) : null);
  }

  function islands(slug, cfg) {
    LC.register(slug, {
      title: cfg.title, rule: cfg.rule, minSteps: 4,
      make: function (rng, round) {
        var R = 5 + (round > 1 ? 1 : 0), C = 6, g;
        do { g = rand(rng, R, C, 0.45); } while (comps(g, function (v) { return v === 1; }).length < 2);
        var t = new LC.Trace();
        t.setup = 'grid ' + R + '×' + C + ' (brown = land, blue = water)';
        var isl = comps(g, function (v) { return v === 1; }), sunk = {}, count = 0, best = 0;
        var L = links(g, function (r, c, nr, nc) { return g[r][c] === 1 && g[nr][nc] === 1; });
        isl.forEach(function (cells, k) {
          var start = cells[0], cls = LC.clone(sunk);
          var vars = [['islands', count]]; if (cfg.area) vars.push(['max area', best]);
          var wm = {};
          for (var r = 0; r < R; r++) for (var c = 0; c < C; c++) {
            var key = id(r, c);
            if (key === id(start[0], start[1])) continue;
            wm[key] = g[r][c] === 0 ? 'That is water.' : sunk[r + ',' + c] ? 'Already sunk: it belongs to an island you counted.' : 'The row-by-row scan reaches (' + start[0] + ',' + start[1] + ') before this cell.';
          }
          t.pick(landView(g, cls, { vars: vars }), 'Scan row by row. Click the cell where island #' + (k + 1) + ' starts.', id(start[0], start[1]), { wrongMap: wm, hint: 'Click the first unvisited land cell in scan order.', note: 'New island! Count it, then flood it.' });
          count++;
          cls[start[0] + ',' + start[1]] = 'hit';
          if (cells.length > 1) {
            var ans = cells.slice(1).map(function (x) { return id(x[0], x[1]); }), aset = {}; ans.forEach(function (x) { aset[x] = 1; });
            t.pick(landView(g, cls, { vars: [['islands', count]] }), 'Flood island #' + count + ': click every land cell connected up, down, left, or right.', ans, {
              all: true, links: L, seeds: [id(start[0], start[1])],
              wrongMap: wrongMapFor(g, aset, function (r, c) { return g[r][c] === 0 ? 'Water stops the flood.' : sunk[r + ',' + c] ? 'Already sunk.' : (r === start[0] && c === start[1]) ? 'That is where you started.' : 'Not connected to this island (diagonals do not count).'; }),
              wrongChain: 'Not touching the flooded part yet. DFS spreads one neighbor at a time (no diagonals).',
              hint: 'Spread from the highlighted cell.', note: 'Island sunk, so it will never be counted again.'
            });
          }
          cells.forEach(function (x) { sunk[x[0] + ',' + x[1]] = 'done'; });
          if (cfg.area) {
            t.num(landView(g, sunk, { vars: [['islands', count], ['max area', best]] }), 'Area of island #' + count + '?', cells.length, { wrong: 'Count the cells you flooded, including the start.', note: 'Area ' + cells.length + '.' });
            best = Math.max(best, cells.length);
          }
        });
        if (cfg.area) t.num(landView(g, sunk, { vars: [['islands', count]] }), 'Max area of an island?', best, { wrong: 'The largest area you recorded.', note: 'Max ' + best + '.' });
        else t.num(landView(g, sunk), 'Scan finished. How many islands?', count, { wrong: 'One per new start cell you clicked.', note: count + ' islands.' });
        t.done(landView(g, sunk), cfg.area ? 'Max area = ' + best + '. O(R·C).' : count + ' islands. Each cell is visited once: O(R·C).');
        return t;
      }
    });
  }
  islands('number-of-islands', { title: 'Number of Islands: count, then sink', rule: 'Scan the grid. Each land cell you have not visited starts a new island: count it, then flood (DFS/BFS) every 4-connected land cell so it is never counted again.' });
  islands('max-area-of-island', { title: 'Max Area of Island: flood and measure', rule: 'Each unvisited land cell starts an island. Flood it through 4-connected land, count the cells you flooded, and keep the max.', area: true });

  LC.register('flood-fill', {
    title: 'Flood Fill: spread only through the starting color',
    rule: 'From (sr, sc), repaint every 4-connected cell that has the ORIGINAL color. If the new color equals the original, nothing changes (and DFS would loop forever without a check).',
    rounds: 4, minSteps: 2,
    make: function (rng, round) {
      var R = 5, C = 6, g = []; for (var r = 0; r < R; r++) { var row = []; for (var c = 0; c < C; c++) row.push(rng.int(0, 2)); g.push(row); }
      var sr = rng.int(0, R - 1), sc = rng.int(0, C - 1), orig = g[sr][sc];
      var color = round === 2 ? orig : (orig + rng.int(1, 2)) % 3;
      var t = new LC.Trace();
      t.setup = 'image ' + R + '×' + C + '   sr = ' + sr + ', sc = ' + sc + '   color = ' + color;
      var cc = g.map(function (row) { return row.map(function (v) { return ['water', 'land', 'blue'][v]; }); });
      function view(cls) { return V(P.grid(g, { cc: cc, cls: cls, pick: 'g', label: 'image (values shown)' }), P.vars([['start color', orig], ['new color', color]])); }
      var s0 = {}; s0[sr + ',' + sc] = 'hit';
      var same = orig === color;
      t.act(view(s0), 'Start color ' + orig + ', new color ' + color + '. First check?', [['go', 'Different: start the flood'], ['stop', 'Same: return the image unchanged']], same ? 'stop' : 'go', same ? 'Repainting with the same color changes nothing, and a naive DFS would revisit cells forever.' : 'The colors differ, so there is work to do.', same ? 'Return early.' : 'Flood from (' + sr + ',' + sc + ').');
      if (!same) {
        var seen = {}, q = [[sr, sc]], cells = []; seen[sr + ',' + sc] = 1;
        while (q.length) { var cur = q.shift(); cells.push(cur); D4.forEach(function (d) { var nr = cur[0] + d[0], nc = cur[1] + d[1]; if (inside(g, nr, nc) && g[nr][nc] === orig && !seen[nr + ',' + nc]) { seen[nr + ',' + nc] = 1; q.push([nr, nc]); } }); }
        var ans = cells.slice(1).map(function (x) { return id(x[0], x[1]); });
        if (ans.length) {
          var aset = {}; ans.forEach(function (x) { aset[x] = 1; });
          t.pick(view(s0), 'Click every cell the fill reaches.', ans, {
            all: true, seeds: [id(sr, sc)], links: links(g, function (r, c, nr, nc) { return g[r][c] === orig && g[nr][nc] === orig; }),
            wrongMap: wrongMapFor(g, aset, function (r, c) { return r === sr && c === sc ? 'That is the start cell.' : g[r][c] !== orig ? 'Color ' + g[r][c] + ' is not the original color ' + orig + '; the fill stops there.' : 'Same color, but not 4-connected to the start through color ' + orig + '.'; }),
            hint: 'Spread from the highlighted cell through color ' + orig + '.', note: 'Every connected cell of color ' + orig + ' found.'
          });
        }
        t.num(view(s0), 'How many cells get repainted?', cells.length, { wrong: 'Count the start cell plus every cell you found.', note: cells.length + ' cells.' });
        cells.forEach(function (x) { g[x[0]][x[1]] = color; cc[x[0]][x[1]] = ['water', 'land', 'blue'][color]; });
      }
      t.done(view({}), same ? 'Unchanged image.' : 'Filled. O(R·C).');
      return t;
    }
  });

  LC.register('rotting-oranges', {
    title: 'Rotting Oranges: every rotten orange spreads at once',
    rule: 'Multi-source BFS. Put every rotten orange in the queue at minute 0. Each minute, every fresh orange next to a rotten one rots. If any fresh orange is never reached, the answer is −1.',
    minSteps: 2,
    make: function (rng, round) {
      var R = 4 + (round > 0 ? 1 : 0), C = 5 + (round > 1 ? 1 : 0), g = [];
      for (var r = 0; r < R; r++) { var row = []; for (var c = 0; c < C; c++) row.push(rng.chance(0.7) ? 1 : 0); g.push(row); }
      var nRot = rng.int(1, 2); for (var k = 0; k < nRot; k++) g[rng.int(0, R - 1)][rng.int(0, C - 1)] = 2;
      var t = new LC.Trace();
      t.setup = 'grid ' + R + '×' + C + '   0 empty, 1 fresh, 2 rotten';
      function view(minute) {
        var cc = g.map(function (row) { return row.map(function (v) { return v === 0 ? 'water' : v === 1 ? 'warn' : 'bad'; }); });
        return V(P.grid(g, { cc: cc, pick: 'g', label: 'oranges' }), P.vars([['minute', minute]]));
      }
      var minute = 0;
      while (true) {
        var next = [];
        for (r = 0; r < R; r++) for (c = 0; c < C; c++) if (g[r][c] === 1 && D4.some(function (d) { var nr = r + d[0], nc = c + d[1]; return inside(g, nr, nc) && g[nr][nc] === 2; })) next.push([r, c]);
        if (!next.length) break;
        var ans = next.map(function (x) { return id(x[0], x[1]); }), aset = {}; ans.forEach(function (x) { aset[x] = 1; });
        t.pick(view(minute), 'Minute ' + (minute + 1) + ': click every fresh orange that rots now.', ans, {
          all: true,
          wrongMap: wrongMapFor(g, aset, function (rr, cc2) { return g[rr][cc2] === 0 ? 'Empty cell.' : g[rr][cc2] === 2 ? 'Already rotten.' : 'No rotten neighbor yet; it rots in a later minute.'; }),
          hint: 'All rotten oranges spread together, one step per minute.', note: 'Minute ' + (minute + 1) + ' done.'
        });
        next.forEach(function (x) { g[x[0]][x[1]] = 2; });
        minute++;
      }
      var fresh = 0; g.forEach(function (row) { row.forEach(function (v) { if (v === 1) fresh++; }); });
      t.act(view(minute), 'Nothing new rots. Answer?', [['m', 'Return the minutes: ' + minute], ['neg', 'Return −1']], fresh ? 'neg' : 'm', fresh ? fresh + ' fresh orange(s) can never be reached.' : 'Every orange is rotten.', fresh ? 'Unreachable fresh orange → −1.' : minute + ' minutes.');
      t.done(view(minute), fresh ? 'Answer −1.' : 'Answer ' + minute + ' minutes. O(R·C).');
      return t;
    }
  });

  function borderFlood(slug, cfg) {
    LC.register(slug, {
      title: cfg.title, rule: cfg.rule, minSteps: 2,
      make: function (rng, round) {
        var R = 5 + (round > 1 ? 1 : 0), C = 6, g, on, border, inner;
        do {
          g = rand(rng, R, C, cfg.p || 0.55);
          on = function (r, c) { return g[r][c] === cfg.on; };
          var seen = {}, q = [];
          for (var r = 0; r < R; r++) for (var c = 0; c < C; c++) if (onBorder(g, r, c) && on(r, c)) { seen[r + ',' + c] = 1; q.push([r, c]); }
          border = [];
          while (q.length) { var cur = q.shift(); border.push(cur); D4.forEach(function (d) { var nr = cur[0] + d[0], nc = cur[1] + d[1]; if (inside(g, nr, nc) && on(nr, nc) && !seen[nr + ',' + nc]) { seen[nr + ',' + nc] = 1; q.push([nr, nc]); } }); }
          inner = []; for (r = 0; r < R; r++) for (c = 0; c < C; c++) if (on(r, c) && !seen[r + ',' + c]) inner.push([r, c]);
        } while (!inner.length || !border.length);
        var t = new LC.Trace();
        t.setup = cfg.setup(R, C);
        var cc = g.map(function (row) { return row.map(function (v) { return v === cfg.on ? 'land' : 'water'; }); });
        function view(cls, vars) { return V(P.grid(g, { cc: cc, cls: cls, pick: 'g', hide: !cfg.show, label: 'grid' }), vars ? P.vars(vars) : null); }
        var seeds = [];
        border.forEach(function (x) { if (onBorder(g, x[0], x[1])) seeds.push(id(x[0], x[1])); });
        var ans = border.map(function (x) { return id(x[0], x[1]); }), aset = {}; ans.forEach(function (x) { aset[x] = 1; });
        var L = links(g, function (r, c, nr, nc) { return on(r, c) && on(nr, nc); });
        L['__border'] = seeds.slice();
        t.pick(view({}), cfg.ask, ans, {
          all: true, links: L, seeds: ['__border'],
          wrongMap: wrongMapFor(g, aset, function (r, c) { return on(r, c) ? cfg.innerWhy : cfg.offWhy; }),
          wrongChain: 'Start from the border and spread inward through 4-connected cells.',
          hint: 'Start on the edge of the grid.', note: cfg.floodNote
        });
        var cls = {}; border.forEach(function (x) { cls[x[0] + ',' + x[1]] = 'blue'; });
        inner.forEach(function (x) { cls[x[0] + ',' + x[1]] = 'warn'; });
        var answer = cfg.answer(inner, g, on);
        t.num(view(cls, [['reached from border', border.length]]), cfg.finalAsk, answer, { wrong: cfg.finalWhy, note: 'Answer ' + answer + '.' });
        t.done(view(cls), cfg.done(answer));
        return t;
      }
    });
  }
  borderFlood('number-of-enclaves', {
    title: 'Number of Enclaves: flood from the border first',
    rule: 'Any land connected to the border can walk off the grid. Flood from every border land cell; the land you never reach is enclosed.',
    on: 1, setup: function (R, C) { return 'grid ' + R + '×' + C + ' (brown = land)'; },
    ask: 'Click every land cell that can reach the border.', innerWhy: 'That land is not connected to the border.', offWhy: 'Water.', floodNote: 'Border-connected land is marked.',
    answer: function (inner) { return inner.length; }, finalAsk: 'How many land cells are enclaves (orange)?', finalWhy: 'Count the land you never reached.',
    done: function (a) { return a + ' enclave cells.'; }
  });
  borderFlood('surrounded-regions', {
    title: 'Surrounded Regions: save the border-connected O\'s',
    rule: 'An O region is captured unless it touches the border. Flood from every border O and mark it safe; every other O flips to X.',
    on: 1, setup: function (R, C) { return 'board ' + R + '×' + C + ' (brown = "O", blue = "X")'; },
    ask: 'Click every O that is safe (connected to the border).', innerWhy: 'That O is surrounded by X; it is not connected to the border.', offWhy: 'That is an X.', floodNote: 'Safe O\'s marked.',
    answer: function (inner) { return inner.length; }, finalAsk: 'How many O\'s get flipped to X?', finalWhy: 'Count the O\'s you did not mark safe.',
    done: function (a) { return a + ' cells captured.'; }
  });
  borderFlood('number-of-closed-islands', {
    title: 'Number of Closed Islands: border islands do not count',
    rule: 'An island that touches the border is not closed. Flood those away first, then every island left is closed: count them.',
    on: 1, p: 0.5, setup: function (R, C) { return 'grid ' + R + '×' + C + ' (brown = land)'; },
    ask: 'Click every land cell of islands that touch the border.', innerWhy: 'That island never touches the border.', offWhy: 'Water.', floodNote: 'Open islands removed.',
    answer: function (inner, g) {
      var m = {}; inner.forEach(function (x) { m[x[0] + ',' + x[1]] = 1; });
      return comps(g.map(function (row, r) { return row.map(function (_, c) { return m[r + ',' + c] ? 1 : 0; }); }), function (v) { return v === 1; }).length;
    },
    finalAsk: 'How many closed islands remain (orange)?', finalWhy: 'Count the separate orange groups (4-connected).',
    done: function (a) { return a + ' closed islands.'; }
  });

  LC.register('01-matrix', {
    title: '01 Matrix: BFS outward from every zero',
    rule: 'Start a BFS from all 0 cells at once (distance 0). Each layer reaches the cells one step farther, so the first time you reach a cell is its distance.',
    minSteps: 2,
    make: function (rng, round) {
      var R = 4 + (round > 0 ? 1 : 0), C = 5, g = [];
      for (var r = 0; r < R; r++) { var row = []; for (var c = 0; c < C; c++) row.push(rng.chance(0.3) ? 0 : 1); g.push(row); }
      g[rng.int(0, R - 1)][rng.int(0, C - 1)] = 0;
      var t = new LC.Trace();
      t.setup = 'mat ' + R + '×' + C;
      var dist = g.map(function (row) { return row.map(function (v) { return v === 0 ? 0 : null; }); });
      function view(d) {
        var cc = dist.map(function (row) { return row.map(function (v) { return v === null ? 'land' : v === 0 ? 'water' : 'blue'; }); });
        return V(P.grid(dist.map(function (row) { return row.map(function (v) { return v === null ? '1' : v; }); }), { cc: cc, pick: 'g', label: 'distance so far (brown = not reached)' }), P.vars([['layer', d]]));
      }
      var d = 0;
      while (true) {
        var next = [];
        for (r = 0; r < R; r++) for (c = 0; c < C; c++) if (dist[r][c] === null && D4.some(function (x) { var nr = r + x[0], nc = c + x[1]; return inside(g, nr, nc) && dist[nr][nc] === d; })) next.push([r, c]);
        if (!next.length) break;
        var ans = next.map(function (x) { return id(x[0], x[1]); }), aset = {}; ans.forEach(function (x) { aset[x] = 1; });
        t.pick(view(d), 'Layer ' + (d + 1) + ': click every cell at distance ' + (d + 1) + '.', ans, {
          all: true,
          wrongMap: wrongMapFor(g, aset, function (rr, cc2) { return dist[rr][cc2] !== null ? 'Already has a distance; BFS never revisits.' : 'Not next to a distance-' + d + ' cell, so it is farther.'; }),
          hint: 'Cells touching the last layer.', note: 'Distance ' + (d + 1) + ' filled.'
        });
        next.forEach(function (x) { dist[x[0]][x[1]] = d + 1; });
        d++;
      }
      t.done(view(d), 'Every distance is the BFS layer that first reached it. O(R·C).');
      return t;
    }
  });

  LC.register('pacific-atlantic-water-flow', {
    title: 'Pacific Atlantic Water Flow: flood uphill from each ocean',
    rule: 'Instead of testing every cell, flood from the oceans: from the Pacific edge (top, left) and the Atlantic edge (bottom, right), move only to neighbors of equal or greater height. Cells reached by both drain to both.',
    minSteps: 2,
    make: function (rng, round) {
      var R = 4 + (round > 1 ? 1 : 0), C = 4 + (round > 0 ? 1 : 0), g = [];
      for (var r = 0; r < R; r++) { var row = []; for (var c = 0; c < C; c++) row.push(rng.int(1, 6)); g.push(row); }
      var t = new LC.Trace();
      t.setup = 'heights ' + R + '×' + C + '   Pacific: top and left edges   Atlantic: bottom and right edges';
      var L = links(g, function (r0, c0, nr, nc) { return g[nr][nc] >= g[r0][c0]; });
      function flood(isEdge) {
        var seen = {}, q = [], out = [];
        for (var r = 0; r < R; r++) for (var c = 0; c < C; c++) if (isEdge(r, c)) { seen[r + ',' + c] = 1; q.push([r, c]); }
        while (q.length) { var cur = q.shift(); out.push(cur); D4.forEach(function (d) { var nr = cur[0] + d[0], nc = cur[1] + d[1]; if (inside(g, nr, nc) && !seen[nr + ',' + nc] && g[nr][nc] >= g[cur[0]][cur[1]]) { seen[nr + ',' + nc] = 1; q.push([nr, nc]); } }); }
        return { cells: out, seen: seen };
      }
      var pac = flood(function (r, c) { return r === 0 || c === 0; }), atl = flood(function (r, c) { return r === R - 1 || c === C - 1; });
      function view(cls) { return V(P.grid(g, { cls: cls, pick: 'g', label: 'heights' })); }
      var cls = {};
      [[pac, 'Pacific', function (r, c) { return r === 0 || c === 0; }, 'blue'], [atl, 'Atlantic', function (r, c) { return r === R - 1 || c === C - 1; }, 'warn']].forEach(function (o) {
        var res = o[0], name = o[1], edge = o[2];
        var ans = res.cells.filter(function (x) { return !edge(x[0], x[1]); }).map(function (x) { return id(x[0], x[1]); });
        var seeds = res.cells.filter(function (x) { return edge(x[0], x[1]); }).map(function (x) { return id(x[0], x[1]); });
        var c2 = LC.clone(cls); seeds.forEach(function (s) { c2[s.slice(2)] = o[3]; });
        if (ans.length) {
          var aset = {}; ans.forEach(function (x) { aset[x] = 1; }); seeds.forEach(function (x) { aset[x] = 1; });
          t.pick(view(c2), name + ': its edge cells are reached. Click every inner cell the ' + name + ' flood reaches (uphill or level only).', ans, {
            all: true, links: L, seeds: seeds,
            wrongMap: wrongMapFor(g, aset, function () { return 'The ' + name + ' cannot reach it: every path to it goes downhill.'; }),
            wrongChain: 'Flood only from a reached neighbor that is lower or equal.', hint: 'Water flows down, so the reverse flood climbs.', note: name + ' region done.'
          });
        }
        res.cells.forEach(function (x) { var k = x[0] + ',' + x[1]; cls[k] = cls[k] && cls[k] !== o[3] ? 'ok' : o[3]; });
      });
      var both = pac.cells.filter(function (x) { return atl.seen[x[0] + ',' + x[1]]; }).length;
      t.num(view(cls), 'How many cells drain to both oceans (green)?', both, { wrong: 'Count the cells reached by both floods.', note: both + ' cells.' });
      t.done(view(cls), both + ' cells reach both oceans. Two floods: O(R·C).');
      return t;
    }
  });

  LC.register('count-sub-islands', {
    title: 'Count Sub Islands: every cell must be land in grid 1',
    rule: 'Flood each island of grid 2. It is a sub-island only if every one of its cells is also land in grid 1; one water cell in grid 1 disqualifies the whole island.',
    minSteps: 3,
    make: function (rng, round) {
      var R = 5, C = 5 + (round > 0 ? 1 : 0), g1 = rand(rng, R, C, 0.7), g2 = rand(rng, R, C, 0.45);
      var t = new LC.Trace();
      t.setup = 'grid1 and grid2 ' + R + '×' + C;
      var isl = comps(g2, function (v) { return v === 1; }), count = 0;
      function view(cls1, cls2) {
        return V(P.grid(g1, { cc: g1.map(function (row) { return row.map(function (v) { return v ? 'land' : 'water'; }); }), cls: cls1, hide: true, label: 'grid1' }),
          P.grid(g2, { cc: g2.map(function (row) { return row.map(function (v) { return v ? 'land' : 'water'; }); }), cls: cls2, hide: true, label: 'grid2' }),
          P.vars([['sub-islands', count]]));
      }
      var acts = [['Y', 'Sub-island'], ['N', 'Not a sub-island']];
      isl.forEach(function (cells, k) {
        var c1 = {}, c2 = {}, sub = true;
        cells.forEach(function (x) { var key = x[0] + ',' + x[1]; c2[key] = 'hit'; c1[key] = g1[x[0]][x[1]] ? 'ok' : 'bad'; if (!g1[x[0]][x[1]]) sub = false; });
        t.act(view(c1, c2), 'Island #' + (k + 1) + ' of grid2 (' + cells.length + ' cells) laid over grid1.', acts, sub ? 'Y' : 'N', sub ? 'Every one of its cells is land in grid1.' : 'At least one cell (red) is water in grid1.', sub ? 'Counts.' : 'Disqualified. Keep flooding the whole island anyway so it is not revisited.');
        if (sub) count++;
      });
      t.num(view({}, {}), 'How many sub-islands?', count, { wrong: 'Count the islands you marked as sub-islands.', note: count + '.' });
      t.done(view({}, {}), count + ' sub-islands.');
      return t;
    }
  });
})();
