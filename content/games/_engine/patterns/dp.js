/* DP table games: fill each cell from cells you already filled, using the recurrence. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;
  var f = LC.fmt;
  var INF_HINT = ' (type inf for ∞)';

  function table(dp, cur, o) {
    o = o || {};
    var cls = {};
    if (o.deps) o.deps.forEach(function (d) { cls[d[0] + ',' + d[1]] = 'warn'; });
    if (cur) cls[cur[0] + ',' + cur[1]] = 'hit';
    if (o.cls) for (var k in o.cls) cls[k] = o.cls[k];
    return P.grid(dp.map(function (row) { return row.map(function (v) { return v === null ? '' : v; }); }), { cls: cls, cc: o.cc, rh: o.rh, ch: o.ch, label: o.label || 'dp' });
  }
  function line(dp, cur, deps, o) {
    o = o || {};
    var cls = {};
    (deps || []).forEach(function (d) { if (d >= 0) cls[d] = 'warn'; });
    if (cur !== null && cur !== undefined) cls[cur] = 'hit';
    return P.arr(dp.map(function (v) { return v === null ? '' : v; }), { cls: cls, label: o.label || 'dp', labels: o.labels });
  }
  function filled(R, C, val) { var g = []; for (var r = 0; r < R; r++) { var row = []; for (var c = 0; c < C; c++) row.push(val); g.push(row); } return g; }
  function ix(n, from) { var a = []; for (var i = 0; i < n; i++) a.push(from + i); return a; }

  LC.register('unique-paths', {
    title: 'Unique Paths: paths from above + paths from the left',
    rule: 'You can only move right or down, so every path into a cell comes from the cell above or the cell to its left: paths[r][c] = paths[r−1][c] + paths[r][c−1]. The top row and left column are all 1.',
    make: function (rng, round) {
      var R = 3 + (round > 0 ? 1 : 0), C = 4 + (round > 1 ? 1 : 0), dp = filled(R, C, null);
      for (var r = 0; r < R; r++) dp[r][0] = 1; for (var c = 0; c < C; c++) dp[0][c] = 1;
      var t = new LC.Trace();
      t.setup = 'm = ' + R + ' rows, n = ' + C + ' columns (top row and left column pre-filled with 1)';
      for (r = 1; r < R; r++) for (c = 1; c < C; c++) {
        var v = dp[r - 1][c] + dp[r][c - 1];
        t.num(V(table(dp, [r, c], { deps: [[r - 1, c], [r, c - 1]] })), 'paths[' + r + '][' + c + '] = ?', v, { wrong: 'above (' + dp[r - 1][c] + ') + left (' + dp[r][c - 1] + ').', note: v + ' paths.' });
        dp[r][c] = v;
      }
      t.done(V(table(dp, [R - 1, C - 1])), dp[R - 1][C - 1] + ' unique paths. O(m·n).');
      return t;
    }
  });

  LC.register('unique-paths-ii', {
    title: 'Unique Paths II: obstacles are zero',
    rule: 'Same recurrence as Unique Paths (above + left), but an obstacle cell has 0 paths, and it blocks the rest of the first row or column behind it.',
    make: function (rng, round) {
      var R = 3 + (round > 0 ? 1 : 0), C = 4, ob;
      ob = filled(R, C, 0);
      for (var k = 0; k < 2 + round; k++) ob[rng.int(0, R - 1)][rng.int(0, C - 1)] = 1;
      ob[0][0] = 0; ob[R - 1][C - 1] = 0;
      var dp = filled(R, C, null); dp[0][0] = 1;
      var cc = ob.map(function (row) { return row.map(function (v) { return v ? 'dark' : ''; }); });
      var t = new LC.Trace();
      t.setup = 'grid ' + R + '×' + C + ' (dark cells are obstacles)';
      for (var r = 0; r < R; r++) for (var c = 0; c < C; c++) {
        if (r === 0 && c === 0) continue;
        var up = r > 0 ? dp[r - 1][c] : 0, left = c > 0 ? dp[r][c - 1] : 0, v = ob[r][c] ? 0 : up + left;
        var deps = []; if (r > 0) deps.push([r - 1, c]); if (c > 0) deps.push([r, c - 1]);
        t.num(V(table(dp, [r, c], { deps: deps, cc: cc })), (ob[r][c] ? 'Obstacle! ' : '') + 'paths[' + r + '][' + c + '] = ?', v, { wrong: ob[r][c] ? 'No path can stand on an obstacle.' : (r > 0 ? 'above ' + up : 'no cell above (0)') + ' + ' + (c > 0 ? 'left ' + left : 'no cell to the left (0)') + '.', note: ob[r][c] ? 'Obstacle → 0.' : v + '.' });
        dp[r][c] = v;
      }
      t.done(V(table(dp, [R - 1, C - 1], { cc: cc })), dp[R - 1][C - 1] + ' paths avoid the obstacles.');
      return t;
    }
  });

  LC.register('minimum-path-sum', {
    title: 'Minimum Path Sum: cheapest way in',
    rule: 'cost[r][c] = grid[r][c] + min(cost above, cost left). The first row and column have only one way in, so they are running sums.',
    make: function (rng, round) {
      var R = 3, C = 3 + (round > 0 ? 1 : 0), g = filled(R, C, 0).map(function (row) { return row.map(function () { return rng.int(1, 9); }); });
      var dp = filled(R, C, null); dp[0][0] = g[0][0];
      var t = new LC.Trace();
      t.setup = 'grid = ' + JSON.stringify(g);
      for (var r = 0; r < R; r++) for (var c = 0; c < C; c++) {
        if (r === 0 && c === 0) continue;
        var opts = []; if (r > 0) opts.push(dp[r - 1][c]); if (c > 0) opts.push(dp[r][c - 1]);
        var v = g[r][c] + Math.min.apply(null, opts);
        var deps = []; if (r > 0) deps.push([r - 1, c]); if (c > 0) deps.push([r, c - 1]);
        t.num(V(P.grid(g, { label: 'grid', cls: (function () { var o = {}; o[r + ',' + c] = 'hit'; return o; })() }), table(dp, [r, c], { deps: deps, label: 'cost' })), 'cost[' + r + '][' + c + '] = ?', v, { wrong: g[r][c] + ' + min(' + opts.join(', ') + ').', note: v + '.' });
        dp[r][c] = v;
      }
      t.done(V(P.grid(g, { label: 'grid' }), table(dp, [R - 1, C - 1], { label: 'cost' })), 'Minimum path sum ' + dp[R - 1][C - 1] + '.');
      return t;
    }
  });

  LC.register('climbing-stairs', {
    title: 'Climbing Stairs: the last step was 1 or 2',
    rule: 'To stand on step i your last move was a 1-step (from i−1) or a 2-step (from i−2): ways(i) = ways(i−1) + ways(i−2), with ways(1) = 1 and ways(2) = 2.',
    make: function (rng, round) {
      var n = 6 + round, dp = [null]; for (var i = 1; i <= n; i++) dp.push(null); dp[1] = 1; dp[2] = 2;
      var t = new LC.Trace();
      t.setup = 'n = ' + n;
      for (i = 3; i <= n; i++) {
        var v = dp[i - 1] + dp[i - 2];
        t.num(V(line(dp, i, [i - 1, i - 2], { label: 'ways' })), 'ways(' + i + ') = ?', v, { wrong: 'ways(' + (i - 1) + ') + ways(' + (i - 2) + ') = ' + dp[i - 1] + ' + ' + dp[i - 2] + '.', note: v + ' ways.' });
        dp[i] = v;
      }
      t.done(V(line(dp, n, [], { label: 'ways' })), 'ways(' + n + ') = ' + dp[n] + '. O(n), or O(1) space with two variables.');
      return t;
    }
  });

  LC.register('min-cost-climbing-stairs', {
    title: 'Min Cost Climbing Stairs: pay for the step you leave',
    rule: 'reach[i] is the cheapest cost to stand on step i. You came from i−1 (paying cost[i−1]) or from i−2 (paying cost[i−2]). reach[0] = reach[1] = 0; the top is step n.',
    make: function (rng, round) {
      var n = 6 + round, cost = rng.ints(n, 1, 9), dp = []; for (var i = 0; i <= n; i++) dp.push(null); dp[0] = 0; dp[1] = 0;
      var t = new LC.Trace();
      t.setup = 'cost = ' + f(cost) + '   (the top is index ' + n + ')';
      for (i = 2; i <= n; i++) {
        var a = dp[i - 1] + cost[i - 1], b = dp[i - 2] + cost[i - 2], v = Math.min(a, b);
        t.num(V(P.arr(cost, { label: 'cost', cls: (function () { var c = {}; c[i - 1] = 'warn'; c[i - 2] = 'warn'; return c; })() }), line(dp, i, [i - 1, i - 2], { label: 'reach', labels: ix(n + 1, 0).map(function (x) { return x === n ? 'top' : x; }) })), 'reach[' + (i === n ? 'top' : i) + '] = ?', v, { wrong: 'min(reach[' + (i - 1) + '] + cost[' + (i - 1) + '], reach[' + (i - 2) + '] + cost[' + (i - 2) + ']) = min(' + a + ', ' + b + ').', note: v + '.' });
        dp[i] = v;
      }
      t.done(V(line(dp, n, [], { label: 'reach' })), 'Minimum cost ' + dp[n] + '.');
      return t;
    }
  });

  function robRun(t, nums, offset, label) {
    var n = nums.length, dp = nums.map(function () { return null; });
    var acts = [['rob', 'Rob it'], ['skip', 'Skip it']];
    dp[0] = nums[0];
    for (var i = 1; i < n; i++) {
      var take = (i >= 2 ? dp[i - 2] : 0) + nums[i], skip = dp[i - 1], key = take > skip ? 'rob' : take < skip ? 'skip' : ['rob', 'skip'];
      var c = {}; c[i] = 'hit';
      var view = V(P.arr(nums, { label: label, cls: c, labels: nums.map(function (_, j) { return 'h' + (j + offset); }) }), line(dp, i, [i - 1, i - 2], { label: 'best through house' }), P.vars([['rob: dp[i−2] + ' + nums[i], take], ['skip: dp[i−1]', skip]]));
      t.act(view, 'House h' + (i + offset) + ' holds ' + nums[i] + '. Rob or skip?', acts, key,
        { rob: 'Robbing gives ' + take + ', but skipping keeps ' + skip + '.', skip: 'Skipping keeps ' + skip + ', but robbing gives ' + take + '.' },
        'dp = max(' + take + ', ' + skip + ') = ' + Math.max(take, skip) + '.');
      dp[i] = Math.max(take, skip);
    }
    return dp[n - 1];
  }

  LC.register('house-robber', {
    title: 'House Robber: rob it or skip it',
    rule: 'At each house: rob it (best two houses back + this loot) or skip it (best through the previous house). dp[i] = max(dp[i−2] + nums[i], dp[i−1]).',
    make: function (rng, round) {
      var nums = rng.ints(7 + round, 1, 9);
      var t = new LC.Trace();
      t.setup = 'nums = ' + f(nums) + '   (dp[0] = nums[0])';
      var best = robRun(t, nums, 0, 'houses');
      t.num(V(P.arr(nums, { label: 'houses' })), 'Most money you can rob?', best, { wrong: 'It is the last dp value.', note: best + '.' });
      t.done(V(P.arr(nums, { label: 'houses' }), P.vars([['answer', best]])), 'Max loot ' + best + '. O(n), O(1) space possible.');
      return t;
    }
  });

  LC.register('house-robber-ii', {
    title: 'House Robber II: break the circle twice',
    rule: 'The first and last houses touch, so never take both. Run House Robber on houses 0..n−2 and on houses 1..n−1, then take the better result.',
    make: function (rng, round) {
      var nums = rng.ints(5 + round, 1, 9), n = nums.length;
      var t = new LC.Trace();
      t.setup = 'nums (circle) = ' + f(nums);
      var a = robRun(t, nums.slice(0, n - 1), 0, 'run 1: without the last house');
      var b = robRun(t, nums.slice(1), 1, 'run 2: without the first house');
      t.num(V(P.vars([['run 1 (skip last)', a], ['run 2 (skip first)', b]])), 'Answer for the circle?', Math.max(a, b), { wrong: 'Take the better of the two runs.', note: 'max(' + a + ', ' + b + ').' });
      t.done(V(P.arr(nums, { label: 'houses' }), P.vars([['answer', Math.max(a, b)]])), 'Max loot ' + Math.max(a, b) + '.');
      return t;
    }
  });

  LC.register('triangle', {
    title: 'Triangle: fold the bottom row upward',
    rule: 'Work bottom-up. Each cell becomes its value plus the smaller of the two cells right below it. The top cell ends up as the minimum path sum.',
    make: function (rng, round) {
      var rows = 4 + (round > 1 ? 1 : 0), tri = [];
      for (var r = 0; r < rows; r++) tri.push(rng.ints(r + 1, 1, 9));
      var dp = tri.map(function (row, r) { return row.map(function (v) { return r === rows - 1 ? v : null; }); });
      var t = new LC.Trace();
      t.setup = 'triangle = ' + JSON.stringify(tri);
      function grid() { return dp.map(function (row) { var out = row.slice(); while (out.length < rows) out.push('·'); return out; }); }
      for (r = rows - 2; r >= 0; r--) for (var c = 0; c <= r; c++) {
        var v = tri[r][c] + Math.min(dp[r + 1][c], dp[r + 1][c + 1]);
        t.num(V(P.grid(tri.map(function (row) { var out = row.slice(); while (out.length < rows) out.push(''); return out; }), { label: 'triangle', cls: (function () { var o = {}; o[r + ',' + c] = 'hit'; return o; })() }), table(grid(), [r, c], { deps: [[r + 1, c], [r + 1, c + 1]], label: 'best from here down' })),
          'Row ' + r + ', col ' + c + ' (value ' + tri[r][c] + ') = ?', v, { wrong: tri[r][c] + ' + min(' + dp[r + 1][c] + ', ' + dp[r + 1][c + 1] + ').', note: v + '.' });
        dp[r][c] = v;
      }
      t.done(V(table(grid(), [0, 0], { label: 'best from here down' })), 'Minimum path sum ' + dp[0][0] + '. O(n) extra space.');
      return t;
    }
  });

  LC.register('minimum-falling-path-sum', {
    title: 'Minimum Falling Path Sum: best of three above',
    rule: 'Row by row, each cell = its value + the minimum of the cells up-left, up, and up-right (those that exist). The answer is the minimum of the last row.',
    make: function (rng, round) {
      var n = 3 + (round > 1 ? 1 : 0), g = filled(n, n, 0).map(function (row) { return row.map(function () { return rng.int(-5, 9); }); });
      var dp = g.map(function (row, r) { return row.map(function (v) { return r === 0 ? v : null; }); });
      var t = new LC.Trace();
      t.setup = 'matrix = ' + JSON.stringify(g) + '   (row 0 is copied as is)';
      for (var r = 1; r < n; r++) for (var c = 0; c < n; c++) {
        var deps = [], vals = [];
        [-1, 0, 1].forEach(function (d) { var cc = c + d; if (cc >= 0 && cc < n) { deps.push([r - 1, cc]); vals.push(dp[r - 1][cc]); } });
        var v = g[r][c] + Math.min.apply(null, vals);
        t.num(V(P.grid(g, { label: 'matrix', cls: (function () { var o = {}; o[r + ',' + c] = 'hit'; return o; })() }), table(dp, [r, c], { deps: deps })), 'dp[' + r + '][' + c + '] = ?', v, { wrong: g[r][c] + ' + min(' + vals.join(', ') + ').', note: v + '.' });
        dp[r][c] = v;
      }
      var ans = Math.min.apply(null, dp[n - 1]);
      t.num(V(table(dp, null)), 'Minimum falling path sum?', ans, { wrong: 'The smallest value in the last row.', note: ans + '.' });
      t.done(V(table(dp, null)), 'Answer ' + ans + '.');
      return t;
    }
  });

  LC.register('maximal-square', {
    title: 'Maximal Square: limited by the weakest neighbor',
    rule: 'For a "1" cell, side = 1 + min(top, left, top-left). A square can only grow as far as all three neighbors allow. A "0" cell is 0.',
    make: function (rng, round) {
      var R = 4, C = 4 + (round > 0 ? 1 : 0), m = filled(R, C, 0).map(function (row) { return row.map(function () { return rng.chance(0.72) ? 1 : 0; }); });
      var dp = m.map(function (row, r) { return row.map(function (v, c) { return r === 0 || c === 0 ? v : null; }); });
      var t = new LC.Trace();
      t.setup = 'matrix ' + R + '×' + C + '   (first row and column are copied)';
      var best = 0; dp.forEach(function (row) { row.forEach(function (v) { if (v) best = 1; }); });
      for (var r = 1; r < R; r++) for (var c = 1; c < C; c++) {
        var v = m[r][c] ? 1 + Math.min(dp[r - 1][c], dp[r][c - 1], dp[r - 1][c - 1]) : 0;
        if (m[r][c]) t.num(V(P.grid(m, { label: 'matrix', cls: (function () { var o = {}; o[r + ',' + c] = 'hit'; return o; })() }), table(dp, [r, c], { deps: [[r - 1, c], [r, c - 1], [r - 1, c - 1]], label: 'largest square ending here' })), 'side at (' + r + ',' + c + ') = ?', v, { wrong: '1 + min(' + dp[r - 1][c] + ', ' + dp[r][c - 1] + ', ' + dp[r - 1][c - 1] + ').', note: 'side ' + v + '.' });
        dp[r][c] = v; best = Math.max(best, v);
      }
      t.num(V(table(dp, null, { label: 'largest square ending here' })), 'Area of the largest square?', best * best, { wrong: 'Largest side is ' + best + '; area is side².', note: best + '² = ' + best * best + '.' });
      t.done(V(table(dp, null)), 'Max area ' + best * best + '.');
      return t;
    }
  });

  function words(rng, len, letters) { var s = ''; for (var i = 0; i < len; i++) s += rng.pick(letters); return s; }

  LC.register('longest-common-subsequence', {
    title: 'Longest Common Subsequence: diagonal on a match',
    rule: 'Compare text1[i−1] and text2[j−1]. Match → dp[i−1][j−1] + 1 (take both). Mismatch → max(dp[i−1][j], dp[i][j−1]) (drop one char from either string).',
    make: function (rng, round) {
      var a = words(rng, 4, 'abcd'), b = words(rng, 3 + (round > 0 ? 1 : 0), 'abcd');
      var R = a.length + 1, C = b.length + 1, dp = filled(R, C, null);
      for (var i = 0; i < R; i++) dp[i][0] = 0; for (var j = 0; j < C; j++) dp[0][j] = 0;
      var t = new LC.Trace();
      t.setup = 'text1 = "' + a + '" (rows)   text2 = "' + b + '" (columns)';
      var o = { rh: ['∅'].concat(a.split('')), ch: ['∅'].concat(b.split('')) };
      for (i = 1; i < R; i++) for (j = 1; j < C; j++) {
        var match = a[i - 1] === b[j - 1], v = match ? dp[i - 1][j - 1] + 1 : Math.max(dp[i - 1][j], dp[i][j - 1]);
        t.num(V(table(dp, [i, j], { deps: match ? [[i - 1, j - 1]] : [[i - 1, j], [i, j - 1]], rh: o.rh, ch: o.ch })), '"' + a[i - 1] + '" vs "' + b[j - 1] + '"' + (match ? ' match.' : ' differ.') + ' dp = ?', v,
          { wrong: match ? 'Match: diagonal + 1 = ' + dp[i - 1][j - 1] + ' + 1.' : 'Mismatch: max(up ' + dp[i - 1][j] + ', left ' + dp[i][j - 1] + ').', note: v + '.' });
        dp[i][j] = v;
      }
      t.done(V(table(dp, [R - 1, C - 1], o)), 'LCS length ' + dp[R - 1][C - 1] + '. O(m·n).');
      return t;
    }
  });

  LC.register('edit-distance', {
    title: 'Edit Distance: free on a match, else 1 + cheapest edit',
    rule: 'Match → copy the diagonal (no cost). Otherwise 1 + min(replace = diagonal, delete = up, insert = left). Row 0 and column 0 are just counts of inserts or deletes.',
    make: function (rng, round) {
      var a = words(rng, 3, 'abcr'), b = words(rng, 3 + (round > 0 ? 1 : 0), 'abcr');
      var R = a.length + 1, C = b.length + 1, dp = filled(R, C, null);
      for (var i = 0; i < R; i++) dp[i][0] = i; for (var j = 0; j < C; j++) dp[0][j] = j;
      var t = new LC.Trace();
      t.setup = 'word1 = "' + a + '" (rows)   word2 = "' + b + '" (columns)';
      var o = { rh: ['∅'].concat(a.split('')), ch: ['∅'].concat(b.split('')) };
      for (i = 1; i < R; i++) for (j = 1; j < C; j++) {
        var match = a[i - 1] === b[j - 1], v = match ? dp[i - 1][j - 1] : 1 + Math.min(dp[i - 1][j - 1], dp[i - 1][j], dp[i][j - 1]);
        t.num(V(table(dp, [i, j], { deps: match ? [[i - 1, j - 1]] : [[i - 1, j - 1], [i - 1, j], [i, j - 1]], rh: o.rh, ch: o.ch })), '"' + a[i - 1] + '" vs "' + b[j - 1] + '"' + (match ? ' match.' : ' differ.') + ' dp = ?', v,
          { wrong: match ? 'Match: copy the diagonal ' + dp[i - 1][j - 1] + '.' : '1 + min(replace ' + dp[i - 1][j - 1] + ', delete ' + dp[i - 1][j] + ', insert ' + dp[i][j - 1] + ').', note: v + '.' });
        dp[i][j] = v;
      }
      t.done(V(table(dp, [R - 1, C - 1], o)), 'Edit distance ' + dp[R - 1][C - 1] + '.');
      return t;
    }
  });

  LC.register('coin-change', {
    title: 'Coin Change: 1 + best smaller amount',
    rule: 'dp[a] = 1 + min over coins c ≤ a of dp[a − c]. dp[0] = 0. If no coin leads to a reachable amount, dp[a] = ∞ (answer −1).',
    make: function (rng, round) {
      var coins = rng.pick(round === 0 ? [[1, 2, 5], [1, 3, 4], [2, 3]] : [[2, 5], [3, 4], [1, 4, 5], [2, 3, 7]]), A = rng.int(6, 9 + round);
      var dp = [0]; for (var a = 1; a <= A; a++) dp.push(null);
      var t = new LC.Trace();
      t.setup = 'coins = ' + f(coins) + '   amount = ' + A;
      for (a = 1; a <= A; a++) {
        var opts = coins.filter(function (c) { return c <= a; }).map(function (c) { return dp[a - c] + 1; });
        var v = opts.length ? Math.min.apply(null, opts) : Infinity;
        var deps = coins.filter(function (c) { return c <= a; }).map(function (c) { return a - c; });
        t.num(V(line(dp, a, deps, { label: 'fewest coins for amount' })), 'dp[' + a + '] = ?' + INF_HINT, v, { wrong: deps.length ? '1 + min(' + deps.map(function (d) { return 'dp[' + d + ']=' + f(dp[d]); }).join(', ') + ').' : 'No coin fits, so ∞.', note: f(v) + '.' });
        dp[a] = v;
      }
      t.done(V(line(dp, A, [], { label: 'fewest coins' })), dp[A] === Infinity ? 'Unreachable: return −1.' : 'Fewest coins ' + dp[A] + '. O(amount · coins).');
      return t;
    }
  });

  LC.register('coin-change-ii', {
    title: 'Coin Change II: coins in the outer loop',
    rule: 'Process one coin at a time: for each amount a ≥ coin, ways[a] += ways[a − coin]. Coins outside the amount loop count combinations once (1+2 and 2+1 are the same).',
    make: function (rng, round) {
      var coins = rng.pick([[1, 2], [1, 2, 5], [2, 3], [1, 3]]), A = rng.int(4, 5 + round);
      var ways = [1]; for (var a = 1; a <= A; a++) ways.push(0);
      var t = new LC.Trace();
      t.setup = 'coins = ' + f(coins) + '   amount = ' + A + '   (ways[0] = 1)';
      coins.forEach(function (coin) {
        for (var x = coin; x <= A; x++) {
          var v = ways[x] + ways[x - coin];
          t.num(V(line(ways, x, [x - coin], { label: 'ways (after coins so far)' }), P.vars([['coin', coin]])), 'Coin ' + coin + ': ways[' + x + '] = ?', v, { wrong: 'ways[' + x + '] (' + ways[x] + ') + ways[' + (x - coin) + '] (' + ways[x - coin] + ').', note: v + '.' });
          ways[x] = v;
        }
      });
      t.done(V(line(ways, A, [], { label: 'ways' })), ways[A] + ' combinations.');
      return t;
    }
  });

  LC.register('longest-increasing-subsequence', {
    title: 'Longest Increasing Subsequence: extend the best smaller ending',
    rule: 'dp[i] = 1 + max dp[j] over earlier j with nums[j] < nums[i] (or 1 if none). The answer is the max dp value, not dp[n−1].',
    make: function (rng, round) {
      var nums = rng.ints(6 + round, 1, 12), dp = nums.map(function () { return null; }); dp[0] = 1;
      var t = new LC.Trace();
      t.setup = 'nums = ' + f(nums);
      for (var i = 1; i < nums.length; i++) {
        var best = 0, deps = [];
        for (var j = 0; j < i; j++) if (nums[j] < nums[i]) { deps.push(j); best = Math.max(best, dp[j]); }
        var v = best + 1, c = {}; c[i] = 'hit'; deps.forEach(function (d) { c[d] = 'warn'; });
        t.num(V(P.arr(nums, { label: 'nums', cls: c }), line(dp, i, deps, { label: 'LIS ending here' })), 'dp[' + i + '] (ending at ' + nums[i] + ') = ?', v, { wrong: deps.length ? '1 + max dp over smaller earlier values (orange) = 1 + ' + best + '.' : 'No smaller value before it, so it starts fresh at 1.', note: v + '.' });
        dp[i] = v;
      }
      var ans = Math.max.apply(null, dp);
      t.num(V(line(dp, null, [], { label: 'LIS ending here' })), 'Length of the LIS?', ans, { wrong: 'The max over all dp values.', note: ans + '.' });
      t.done(V(line(dp, null, [], { label: 'dp' })), 'LIS length ' + ans + '. O(n²); patience sorting gets O(n log n).');
      return t;
    }
  });

  LC.register('partition-equal-subset-sum', {
    title: 'Partition Equal Subset Sum: can we hit half?',
    rule: 'Target = sum / 2. can[s] says some subset sums to s. For each number, go DOWN from target to num: can[s] = can[s] or can[s − num]. Going down keeps each number used once.',
    minSteps: 6,
    make: function (rng, round) {
      var nums; do { nums = rng.ints(3 + (round > 0 ? 1 : 0), 1, 5); } while (nums.reduce(function (x, y) { return x + y; }, 0) % 2 || nums.reduce(function (x, y) { return x + y; }, 0) > 16);
      var target = nums.reduce(function (x, y) { return x + y; }, 0) / 2;
      var can = [true]; for (var s = 1; s <= target; s++) can.push(false);
      var t = new LC.Trace();
      t.setup = 'nums = ' + f(nums) + '   sum = ' + 2 * target + '   target = ' + target;
      var acts = [['T', 'true'], ['F', 'false']];
      nums.forEach(function (num) {
        for (var x = target; x >= num; x--) {
          var v = can[x] || can[x - num];
          t.act(V(line(can, x, [x - num], { label: 'can reach sum' }), P.vars([['num', num]])), 'With ' + num + ': can[' + x + '] = can[' + x + '] or can[' + (x - num) + ']?', acts, v ? 'T' : 'F', v ? (can[x] ? 'can[' + x + '] was already true.' : 'can[' + (x - num) + '] is true, so add ' + num + '.') : 'Both can[' + x + '] and can[' + (x - num) + '] are false.', String(v) + '.');
          can[x] = v;
        }
      });
      t.act(V(line(can, target, [], { label: 'can reach sum' })), 'Can the array be split into two equal halves?', [['T', 'Yes'], ['F', 'No']], can[target] ? 'T' : 'F', can[target] ? 'can[target] is true.' : 'can[target] is false.', can[target] ? 'Yes.' : 'No.');
      t.done(V(line(can, target, [], { label: 'can' })), can[target] ? 'Partition exists.' : 'No partition.');
      return t;
    }
  });

  LC.register('perfect-squares', {
    title: 'Perfect Squares: 1 + best remainder',
    rule: 'dp[n] = 1 + min over squares s ≤ n of dp[n − s]. It is Coin Change where the coins are 1, 4, 9, …',
    make: function (rng, round) {
      var N = rng.int(7, 10 + round * 2), dp = [0]; for (var i = 1; i <= N; i++) dp.push(null);
      var t = new LC.Trace();
      t.setup = 'n = ' + N + '   squares: 1, 4, 9';
      for (i = 1; i <= N; i++) {
        var deps = [], best = Infinity;
        for (var k = 1; k * k <= i; k++) { deps.push(i - k * k); best = Math.min(best, dp[i - k * k] + 1); }
        t.num(V(line(dp, i, deps, { label: 'fewest squares' })), 'dp[' + i + '] = ?', best, { wrong: '1 + min(' + deps.map(function (d) { return 'dp[' + d + ']=' + dp[d]; }).join(', ') + ').', note: best + '.' });
        dp[i] = best;
      }
      t.done(V(line(dp, N, [], { label: 'fewest squares' })), dp[N] + ' squares sum to ' + N + '.');
      return t;
    }
  });

  LC.register('decode-ways', {
    title: 'Decode Ways: one digit or two',
    rule: 'dp[i] counts decodings of the first i digits. A valid single digit (1–9) adds dp[i−1]. A valid pair (10–26) adds dp[i−2]. A "0" alone adds nothing.',
    make: function (rng, round) {
      var s; do { s = ''; for (var i = 0; i < 5 + round; i++) s += rng.pick(['1', '2', '2', '1', '6', '0', '3', '7']); } while (s[0] === '0' || /00/.test(s));
      var dp = [1, 1]; for (i = 2; i <= s.length; i++) dp.push(null);
      var t = new LC.Trace();
      t.setup = 's = "' + s + '"   dp[0] = 1, dp[1] = 1';
      for (i = 2; i <= s.length; i++) {
        var one = s[i - 1] !== '0', two = s[i - 2] !== '0' && Number(s.slice(i - 2, i)) <= 26;
        var v = (one ? dp[i - 1] : 0) + (two ? dp[i - 2] : 0), deps = []; if (one) deps.push(i - 1); if (two) deps.push(i - 2);
        var c = {}; c[i - 1] = 'hit'; if (two) c[i - 2] = 'warn';
        t.num(V(P.arr(s.split(''), { label: 's', cls: c }), line(dp, i, deps, { label: 'ways for prefix length' })), 'Prefix "' + s.slice(0, i) + '": dp[' + i + '] = ?', v,
          { wrong: (one ? '"' + s[i - 1] + '" alone adds dp[' + (i - 1) + '] = ' + dp[i - 1] : '"0" cannot stand alone') + '; ' + (two ? '"' + s.slice(i - 2, i) + '" adds dp[' + (i - 2) + '] = ' + dp[i - 2] : '"' + s.slice(i - 2, i) + '" is not 10–26') + '.', note: v + '.' });
        dp[i] = v;
      }
      t.done(V(line(dp, s.length, [], { label: 'ways' })), dp[s.length] + ' decodings.');
      return t;
    }
  });

  LC.register('word-break', {
    title: 'Word Break: a word ending here on a good start',
    rule: 'ok[0] = true. ok[i] is true when some dictionary word ends at i and ok[start of that word] is already true.',
    make: function (rng, round) {
      var dict = rng.pick([['cat', 'cats', 'and', 'sand', 'dog'], ['apple', 'pen'], ['leet', 'code'], ['a', 'ab', 'abc', 'cd'], ['go', 'goal', 'al', 'gal']]);
      var s = ''; while (s.length < 6) s += rng.pick(dict);
      if (rng.chance(0.3)) s = s.slice(0, s.length - 1) + 'x';
      s = s.slice(0, 10);
      var ok = [true]; for (var i = 1; i <= s.length; i++) ok.push(null);
      var t = new LC.Trace();
      t.setup = 's = "' + s + '"   wordDict = ' + JSON.stringify(dict);
      var acts = [['T', 'true'], ['F', 'false']];
      for (i = 1; i <= s.length; i++) {
        var hit = null;
        dict.forEach(function (w) { if (!hit && i >= w.length && s.slice(i - w.length, i) === w && ok[i - w.length]) hit = w; });
        var c = {}; c[i - 1] = 'hit';
        t.act(V(P.arr(s.split(''), { label: 's', cls: c }), line(ok, i, hit ? [i - hit.length] : [], { label: 'ok[prefix length]' })), 'ok[' + i + '] for "' + s.slice(0, i) + '"?', acts, hit ? 'T' : 'F',
          hit ? '"' + hit + '" ends here and ok[' + (i - hit.length) + '] is true.' : 'No word ends at ' + i + ' starting from a true ok[].', hit ? 'true via "' + hit + '".' : 'false.');
        ok[i] = !!hit;
      }
      t.done(V(line(ok, s.length, [], { label: 'ok' })), ok[s.length] ? 'The string can be segmented.' : 'It cannot be segmented.');
      return t;
    }
  });
})();
