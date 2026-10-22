/* Backtracking games: walk the decision tree in DFS order, choose, recurse, un-choose. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view, fmt = LC.fmt;
  function gid(r, c) { return 'g:' + r + ',' + c; }
  function recorded(res) { return P.text(res.length ? res.map(function (x) { return typeof x === 'string' ? x : fmt(x); }).join('   ') : '(none yet)', 'recorded (' + res.length + ')'); }

  LC.register('permutations', {
    title: 'Permutations: pick, recurse, un-pick',
    rule: 'At each position try every unused number, left to right. Add it, recurse, then remove it (un-pick) and try the next. A full path is one permutation.',
    rounds: 2, minSteps: 10,
    make: function (rng) {
      var n = 3, a = rng.shuffle([1, 2, 3, 4, 5, 6, 7, 8, 9]).slice(0, n);
      var t = new LC.Trace(), path = [], used = [], res = [], pending = '';
      t.setup = 'nums = ' + fmt(a);
      function view() { var c = {}; used.forEach(function (u, i) { if (u) c[i] = 'dim'; }); return V(P.arr(a, { label: 'nums (dim = used)', cls: c }), P.arr(path, { label: 'path', idx: false }), recorded(res)); }
      var acts = a.map(function (x, j) { return [String(j), 'Add ' + x]; });
      (function dfs() {
        if (path.length === n) { res.push(path.slice()); pending = 'Recorded ' + fmt(path) + '. '; return; }
        for (var i = 0; i < n; i++) {
          if (used[i]) continue;
          var why = {};
          for (var j = 0; j < n; j++) {
            if (j === i) continue;
            why[j] = used[j] ? a[j] + ' is already in the path.' : j < i ? a[j] + ' was already tried at this position; that branch is finished.' : 'Try unused numbers left to right: ' + a[i] + ' comes first.';
          }
          t.act(view(), pending + 'Path ' + fmt(path) + '. Add which number?', acts, String(i), why, 'Add ' + a[i] + '.');
          pending = '';
          used[i] = true; path.push(a[i]);
          dfs();
          path.pop(); used[i] = false; pending += 'Un-pick ' + a[i] + '. ';
        }
      })();
      t.done(view(), 'All ' + res.length + ' permutations found. O(n · n!).');
      return t;
    }
  });

  LC.register('subsets', {
    title: 'Subsets: include it, or not',
    rule: 'Decide each element in order: first explore the branch that includes it, then come back and explore the branch that excludes it. Every leaf is one subset.',
    rounds: 2, minSteps: 10,
    make: function (rng) {
      var n = 3, a = rng.shuffle([1, 2, 3, 4, 5, 6, 7, 8, 9]).slice(0, n).sort(function (x, y) { return x - y; });
      var t = new LC.Trace(), path = [], res = [], pending = '';
      t.setup = 'nums = ' + fmt(a);
      function view(i) { var c = {}; if (i < n) c[i] = 'hit'; for (var k = 0; k < i && k < n; k++) c[k] = 'dim'; return V(P.arr(a, { label: 'nums (highlight = deciding now)', cls: c }), P.arr(path, { label: 'current subset', idx: false }), recorded(res)); }
      (function dfs(i) {
        if (i === n) { res.push(path.slice()); pending = 'Recorded ' + fmt(path) + '. '; return; }
        var acts = [['in', 'Include ' + a[i]], ['out', 'Exclude ' + a[i]]];
        t.act(view(i), pending + 'Deciding ' + a[i] + ' (first visit).', acts, 'in', 'Explore the include branch first; you come back here to exclude it.', 'Include ' + a[i] + '.');
        pending = '';
        path.push(a[i]); dfs(i + 1); path.pop(); pending += 'Remove ' + a[i] + '. ';
        t.act(view(i), pending + 'Back at ' + a[i] + ': its include branch is done.', acts, 'out', 'The include branch of ' + a[i] + ' is finished; now explore without it.', 'Exclude ' + a[i] + '.');
        pending = '';
        dfs(i + 1);
      })(0);
      t.num(view(n), 'How many subsets did you record?', res.length, { wrong: 'Each element doubles the count: 2^n.', note: '2^' + n + ' = ' + res.length + '.' });
      t.done(view(n), 'All 2^' + n + ' subsets. O(n · 2^n).');
      return t;
    }
  });

  LC.register('combination-sum', {
    title: 'Combination Sum: reuse from the same index, prune on overshoot',
    rule: 'Candidates are sorted. From index start, try each candidate in order; recurse with the SAME index (reuse allowed). Never go back to earlier indexes (no duplicate combos). Once a candidate overshoots, every later one does too: stop.',
    rounds: 3, minSteps: 6, maxSteps: 22,
    make: function (rng, round) {
      var c = rng.shuffle([2, 3, 4, 5, 6, 7]).slice(0, 3).sort(function (x, y) { return x - y; }), target = rng.int(6, 8 + round);
      var t = new LC.Trace(), path = [], res = [], pending = '';
      t.setup = 'candidates = ' + fmt(c) + '   target = ' + target;
      var acts = c.map(function (x, j) { return [String(j), 'Add ' + x]; }).concat([['stop', 'Stop: the rest overshoot']]);
      function view(start, sum) { var cl = {}; for (var k = 0; k < start; k++) cl[k] = 'dim'; return V(P.arr(c, { label: 'candidates (dim = before start)', cls: cl }), P.arr(path, { label: 'path', idx: false }), P.vars([['sum', sum], ['target', target], ['start', start]]), recorded(res)); }
      (function dfs(start, sum) {
        if (sum === target) { res.push(path.slice()); pending = 'Recorded ' + fmt(path) + '. '; return; }
        for (var j = start; j < c.length; j++) {
          var over = sum + c[j] > target, why = {};
          for (var k = 0; k < c.length; k++) {
            if (!over && k === j) continue;
            why[k] = k < start ? 'Going back to ' + c[k] + ' would repeat a combination; only indexes ≥ ' + start + '.' : over && k >= j ? sum + ' + ' + c[k] + ' > ' + target + '.' : k < j ? c[k] + ' was already explored here.' : 'Try in order: ' + c[j] + ' first.';
          }
          if (!over) why.stop = sum + ' + ' + c[j] + ' = ' + (sum + c[j]) + ' ≤ ' + target + ': ' + c[j] + ' still fits.';
          var ask = pending + 'Path ' + fmt(path) + ', sum ' + sum + '. Next?';
          pending = '';
          if (over) { t.act(view(start, sum), ask, acts, 'stop', why, 'Prune: ' + c[j] + ' and everything after it are too big.'); pending = 'Back up. '; return; }
          t.act(view(start, sum), ask, acts, String(j), why, 'Add ' + c[j] + ' (start stays ' + j + ').');
          path.push(c[j]); dfs(j, sum + c[j]); path.pop(); pending += 'Remove ' + c[j] + '. ';
        }
        pending += 'All candidates tried. ';
      })(0, 0);
      t.done(view(0, 0), res.length + ' combination(s): ' + (res.map(fmt).join(' ') || 'none') + '.');
      return t;
    }
  });

  LC.register('generate-parentheses', {
    title: 'Generate Parentheses: open while you can, close while it matches',
    rule: 'Add "(" while open < n. Add ")" only while close < open. Try "(" first, recurse, remove it, then try ")". A string of length 2n is valid.',
    rounds: 3, minSteps: 6,
    make: function (rng, round) {
      var n = round === 0 ? 2 : 3;
      var t = new LC.Trace(), res = [], pending = '';
      t.setup = 'n = ' + n;
      var acts = [['o', 'Add ('], ['c', 'Add )']];
      function view(s, open, close) { return V(P.arr(s.split(''), { label: 'current string', idx: false }), P.vars([['open', open + ' / ' + n], ['close', close]]), recorded(res)); }
      (function dfs(s, open, close) {
        if (s.length === 2 * n) { res.push(s); pending = 'Recorded ' + s + '. '; return; }
        var triedOpen = false;
        if (open < n) {
          t.act(view(s, open, close), pending + 'String "' + s + '". Next?', acts, 'o', close < open ? 'Try "(" first; ")" is the branch you take after backtracking.' : 'close < open is required: a ")" here would be unmatched.', 'Add (.');
          pending = ''; dfs(s + '(', open + 1, close); pending += 'Remove (. '; triedOpen = true;
        }
        if (close < open) {
          t.act(view(s, open, close), pending + 'String "' + s + '". Next?', acts, 'c', triedOpen ? 'The "(" branch here is finished; now try ")".' : 'open = n already: no more "(".', 'Add ).');
          pending = ''; dfs(s + ')', open, close + 1); pending += 'Remove ). ';
        }
      })('', 0, 0);
      t.done(view('', 0, 0), res.length + ' valid strings: ' + res.join(' ') + '. (Catalan number.)');
      return t;
    }
  });

  LC.register('n-queens', {
    title: 'N-Queens: one queen per row, backtrack when a row is blocked',
    rule: 'Fill rows top to bottom. In each row, place the queen in the leftmost safe column (after the last one you tried). A column or diagonal already attacked is unsafe. If no column is safe, backtrack: lift the previous queen and try further right.',
    rounds: 2, minSteps: 4,
    make: function (rng, round) {
      var n = round === 0 ? 4 : 5;
      var t = new LC.Trace(), q = [], r = 0, start = 0;
      t.setup = 'n = ' + n + '   find the first solution';
      function attacker(rr, cc) { for (var k = 0; k < q.length; k++) if (q[k] === cc || Math.abs(q[k] - cc) === Math.abs(k - rr)) return k; return -1; }
      function view(row) {
        var g = [], cls = {};
        for (var i = 0; i < n; i++) { var line = []; for (var j = 0; j < n; j++) { line.push(q[i] === j ? '♛' : ''); if (i === row && q[i] !== j) cls[i + ',' + j] = 'blue'; if (q[i] === j) cls[i + ',' + j] = 'ok'; } g.push(line); }
        return V(P.grid(g, { cls: cls, pick: 'g', label: 'board (blue = row to fill)' }), P.vars([['row', row], ['try columns from', start]]));
      }
      while (r < n) {
        var c = -1;
        for (var j = start; j < n; j++) if (attacker(r, j) === -1) { c = j; break; }
        var wm = {};
        for (var i = 0; i < n; i++) for (j = 0; j < n; j++) {
          if (i !== r) { wm[gid(i, j)] = 'One queen per row: you are filling row ' + r + '.'; continue; }
          var a = attacker(r, j);
          if (j === c) continue;
          wm[gid(i, j)] = j < start ? 'Column ' + j + ' was already tried in this row; it led to a dead end.' : a !== -1 ? 'Attacked by the queen in row ' + a + ' (column ' + q[a] + ').' : 'Scan left to right: column ' + c + ' is safe and comes first.';
        }
        if (c !== -1) {
          t.pick(view(r), 'Row ' + r + ': click the leftmost safe column' + (start ? ' from column ' + start : '') + '.', [gid(r, c)], { wrongMap: wm, extra: [{ label: 'No safe column → backtrack', ok: false, why: 'Column ' + c + ' in row ' + r + ' is safe.' }], note: 'Queen at (' + r + ', ' + c + ').' });
          q.push(c); r++; start = 0;
        } else {
          t.pick(view(r), 'Row ' + r + ': click the leftmost safe column' + (start ? ' from column ' + start : '') + '.', [], { wrongMap: wm, extra: [{ label: 'No safe column → backtrack', ok: true, why: 'Row ' + r + ' is blocked. Lift the queen in row ' + (r - 1) + ' and try further right.' }] });
          r--; start = q.pop() + 1;
        }
      }
      t.done(view(-1), 'Solution: columns ' + fmt(q) + '. Keep going (backtrack again) to list every solution.');
      return t;
    }
  });

  LC.register('word-search', {
    title: 'Word Search: DFS, mark visited, unmark on the way back',
    rule: 'Scan cells row by row for the first letter. From a match, step to an adjacent (up/down/left/right) unvisited cell holding the next letter. If none matches, unmark and backtrack to keep scanning.',
    rounds: 3, minSteps: 3,
    make: function (rng, round) {
      var R = 3, C = 4 + (round > 1 ? 1 : 0), L = 3 + (round > 0 ? 1 : 0);
      var word = rng.shuffle('ABCDEGHKMNOPRST'.split('')).slice(0, L);
      var path, tries = 0;
      do {
        path = [[rng.int(0, R - 1), rng.int(0, C - 1)]];
        while (path.length < L) {
          var last = path[path.length - 1], nb = [[1, 0], [-1, 0], [0, 1], [0, -1]].map(function (d) { return [last[0] + d[0], last[1] + d[1]]; }).filter(function (p) { return p[0] >= 0 && p[0] < R && p[1] >= 0 && p[1] < C && !path.some(function (x) { return x[0] === p[0] && x[1] === p[1]; }); });
          if (!nb.length) break; path.push(rng.pick(nb));
        }
      } while (path.length < L && ++tries < 50);
      var filler = 'FIJLQUVWXYZ'.split(''), g = [];
      for (var i = 0; i < R; i++) { g.push([]); for (var j = 0; j < C; j++) g[i].push(rng.pick(filler)); }
      path.forEach(function (p, k) { g[p[0]][p[1]] = word[k]; });
      function onPath(r, c) { return path.some(function (x) { return x[0] === r && x[1] === c; }); }
      function adj(a, b) { return Math.abs(a[0] - b[0]) + Math.abs(a[1] - b[1]) === 1; }
      var decoy = null;
      if (rng.chance(0.75)) {
        var spots = [];
        for (i = 0; i < R; i++) for (j = 0; j < C; j++) if (!onPath(i, j) && (i * C + j) < (path[0][0] * C + path[0][1]) && !adj([i, j], path[1])) spots.push([i, j]);
        if (spots.length) { decoy = rng.pick(spots); g[decoy[0]][decoy[1]] = word[0]; }
      }
      var t = new LC.Trace(), vis = {};
      t.setup = 'word = "' + word.join('') + '"';
      function view(cur) { var cls = {}; Object.keys(vis).forEach(function (k) { cls[k] = 'ok'; }); if (cur) cls[cur[0] + ',' + cur[1]] = 'hit'; return V(P.grid(g, { cls: cls, pick: 'g', label: 'board (green = visited path)' }), P.text(word.map(function (ch, k) { return k < Object.keys(vis).length ? ch.toLowerCase() : ch; }).join(' '), 'word (lowercase = matched)')); }
      function scanMap(first, from) {
        var wm = {};
        for (var i = 0; i < R; i++) for (var j = 0; j < C; j++) {
          if (i === first[0] && j === first[1]) continue;
          wm[gid(i, j)] = g[i][j] !== word[0] ? '"' + g[i][j] + '" is not "' + word[0] + '".' : (i * C + j) < from ? 'Already tried that start; it was a dead end.' : 'Scan row by row: an earlier cell matches "' + word[0] + '".';
        }
        return wm;
      }
      function stepMap(cur, nextCell, k) {
        var wm = {};
        for (var i = 0; i < R; i++) for (var j = 0; j < C; j++) {
          if (nextCell && i === nextCell[0] && j === nextCell[1]) continue;
          wm[gid(i, j)] = vis[i + ',' + j] ? 'Already on the path: visited cells cannot be reused.' : !adj(cur, [i, j]) ? 'Must be adjacent (up, down, left, right) to the current cell.' : '"' + g[i][j] + '" is not "' + word[k] + '".';
        }
        return wm;
      }
      var scanFrom = 0;
      if (decoy) {
        t.pick(view(null), 'Scan row by row: click the first cell holding "' + word[0] + '".', [gid(decoy[0], decoy[1])], { wrongMap: scanMap(decoy, 0), note: 'Start here and mark it visited.' });
        vis[decoy[0] + ',' + decoy[1]] = 1;
        t.pick(view(decoy), 'Click the adjacent unvisited cell holding "' + word[1] + '".', [], { wrongMap: stepMap(decoy, null, 1), extra: [{ label: 'No neighbor matches → unmark, backtrack', ok: true, why: 'Dead end. Unmark this cell so other paths may use it, and keep scanning.' }] });
        delete vis[decoy[0] + ',' + decoy[1]];
        scanFrom = decoy[0] * C + decoy[1] + 1;
      }
      t.pick(view(null), (decoy ? 'Keep scanning after the dead end: click the next cell holding "' : 'Scan row by row: click the first cell holding "') + word[0] + '".', [gid(path[0][0], path[0][1])], { wrongMap: scanMap(path[0], scanFrom), note: 'Mark it visited.' });
      vis[path[0][0] + ',' + path[0][1]] = 1;
      for (var k = 1; k < L; k++) {
        t.pick(view(path[k - 1]), 'Click the adjacent unvisited cell holding "' + word[k] + '".', [gid(path[k][0], path[k][1])], { wrongMap: stepMap(path[k - 1], path[k], k), extra: [{ label: 'No neighbor matches → unmark, backtrack', ok: false, why: 'A neighbor does hold "' + word[k] + '".' }], note: 'Matched "' + word[k] + '".' });
        vis[path[k][0] + ',' + path[k][1]] = 1;
      }
      t.done(view(null), 'Found "' + word.join('') + '". O(R·C·4^L).');
      return t;
    }
  });
})();
