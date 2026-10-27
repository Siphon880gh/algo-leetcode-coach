/* Sliding Window games: grow the right edge, shrink the left edge only when the rule says so. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;

  function counts(list) { var m = {}; list.forEach(function (x) { m[x] = (m[x] || 0) + 1; }); return m; }
  function countStr(m) { var k = Object.keys(m).filter(function (x) { return m[x] > 0; }).sort(); return k.length ? k.map(function (x) { return x + ':' + m[x]; }).join(' ') : '—'; }

  /*
   * Variable window. cfg.type 'max': shrink while invalid, longest valid wins.
   * cfg.type 'min': shrink while valid (the window meets the goal), shortest valid wins.
   */
  function variable(slug, cfg) {
    LC.register(slug, {
      title: cfg.title, rule: cfg.rule, minSteps: 8,
      make: function (rng, round) {
        var g = cfg.gen(rng, round), a = g.a;
        var t = new LC.Trace();
        t.setup = g.setup;
        var l = 0, best = cfg.type === 'max' ? 0 : Infinity, bestWin = null;
        var acts = [['E', 'Expand R right'], ['S', 'Shrink L right']];
        function win(r) { return a.slice(l, r + 1); }
        function view(r) {
          var w = win(r);
          return V(P.arr(a, { win: [l, r], ptr: l === r ? { 'L,R': l } : { L: l, R: r } }),
            P.vars(cfg.vars(w, g).concat([[cfg.bestLabel || 'best', best === Infinity ? '—' : best]])));
        }
        for (var r = 0; r < a.length; r++) {
          var last = r === a.length - 1;
          if (cfg.type === 'max') {
            while (!cfg.valid(win(r), g)) {
              t.act(view(r), 'R added ' + LC.fmt(a[r]) + '. Next move?', acts, 'S', 'The window breaks the rule: ' + cfg.whyBad(win(r), g) + ' Expanding cannot fix that.', 'Drop ' + LC.fmt(a[l]) + ' from the left.');
              l++;
            }
            var m = cfg.measure(win(r), g);
            if (m > best) { best = m; bestWin = [l, r]; }
            t.act(view(r), (last ? 'Window is valid at the last index. ' : 'Window is valid (' + cfg.measureName + ' ' + m + '). ') + 'Next move?', acts, 'E',
              'The window is valid. Shrinking a valid window only makes it shorter, so keep growing.', last ? 'R runs off the end. Done scanning.' : 'Valid. Record it and keep growing.');
          } else {
            if (!cfg.valid(win(r), g)) {
              t.act(view(r), 'Goal not met yet. Next move?', acts, 'E', 'The window does not meet the goal yet (' + cfg.whyBad(win(r), g) + '). Shrinking only takes more away.', last ? 'R runs off the end. Done scanning.' : 'Grow to the right.');
              continue;
            }
            while (cfg.valid(win(r), g)) {
              var mm = cfg.measure(win(r), g);
              if (mm < best) { best = mm; bestWin = [l, r]; }
              t.act(view(r), 'The window meets the goal (length ' + mm + '). Next move?', acts, 'S', 'It already meets the goal. Try to make it shorter before growing.', 'Record ' + mm + ' and squeeze from the left.');
              l++;
            }
            t.act(view(r), 'The window no longer meets the goal. Next move?', acts, 'E', 'It no longer meets the goal; only growing can fix that.', last ? 'R runs off the end. Done scanning.' : 'Grow again.');
          }
        }
        var answer = cfg.answer ? cfg.answer(best, g) : (best === Infinity ? 0 : best);
        var fv = V(P.arr(a, { win: bestWin || undefined }), P.vars([[cfg.bestLabel || 'best', best === Infinity ? '—' : best]]));
        t.num(fv, cfg.finalAsk, answer, { wrong: cfg.finalWhy || 'Use the best value you recorded.', note: 'Answer ' + answer + '.' });
        t.done(fv, cfg.done(answer, g));
        return t;
      }
    });
  }

  variable('longest-substring-without-repeating-characters', {
    title: 'Longest Substring Without Repeating: shrink past the repeat',
    rule: 'Grow R one char at a time. When the new char is already in the window, shrink L until it is not. Longest valid window wins.',
    type: 'max', measureName: 'length',
    gen: function (rng, round) { var s = []; for (var i = 0; i < 9 + round; i++) s.push(rng.pick(['a', 'b', 'c', 'd', round > 0 ? 'e' : 'a'])); return { a: s, setup: 's = "' + s.join('') + '"' }; },
    valid: function (w) { var m = counts(w); return Object.keys(m).every(function (k) { return m[k] <= 1; }); },
    whyBad: function (w) { var m = counts(w); var d = Object.keys(m).filter(function (k) { return m[k] > 1; }); return '"' + d.join('", "') + '" appears twice.'; },
    measure: function (w) { return w.length; },
    vars: function (w) { return [['window', '"' + w.join('') + '"']]; },
    finalAsk: 'Length of the longest substring without repeats?',
    done: function (ans) { return 'Longest = ' + ans + '. Each char enters and leaves once: O(n).'; }
  });

  variable('max-consecutive-ones-iii', {
    title: 'Max Consecutive Ones III: at most k zeros inside',
    rule: 'The window may hold at most k zeros (they are the flips). Grow R; shrink L only when the zero count goes over k.',
    type: 'max', measureName: 'length',
    gen: function (rng, round) { var k = rng.int(1, 2), a = []; for (var i = 0; i < 10 + round; i++) a.push(rng.chance(0.35) ? 0 : 1); return { a: a, k: k, setup: 'nums = ' + LC.fmt(a) + '   k = ' + k }; },
    valid: function (w, g) { return w.filter(function (x) { return x === 0; }).length <= g.k; },
    whyBad: function (w, g) { return w.filter(function (x) { return x === 0; }).length + ' zeros > k = ' + g.k + '.'; },
    measure: function (w) { return w.length; },
    vars: function (w, g) { return [['zeros', w.filter(function (x) { return x === 0; }).length + ' / ' + g.k]]; },
    finalAsk: 'Longest run of 1s after at most k flips?',
    done: function (ans) { return 'Max length = ' + ans + '.'; }
  });

  variable('longest-repeating-character-replacement', {
    title: 'Longest Repeating Character Replacement: len − maxFreq at most k',
    rule: 'A window is fixable when (length − count of its most common letter) at most k. Grow R; shrink L when more than k replacements would be needed.',
    type: 'max', measureName: 'length',
    gen: function (rng, round) { var k = rng.int(1, 2), s = []; for (var i = 0; i < 10 + round; i++) s.push(rng.pick(round === 2 ? ['A', 'B', 'C'] : ['A', 'B'])); return { a: s, k: k, setup: 's = "' + s.join('') + '"   k = ' + k }; },
    valid: function (w, g) { var m = counts(w), mx = 0; for (var c in m) mx = Math.max(mx, m[c]); return w.length - mx <= g.k; },
    whyBad: function (w, g) { var m = counts(w), mx = 0; for (var c in m) mx = Math.max(mx, m[c]); return w.length + ' − ' + mx + ' = ' + (w.length - mx) + ' replacements > k = ' + g.k + '.'; },
    measure: function (w) { return w.length; },
    vars: function (w, g) { var m = counts(w), mx = 0; for (var c in m) mx = Math.max(mx, m[c]); return [['counts', countStr(m)], ['len − maxFreq', (w.length - mx) + ' (k = ' + g.k + ')']]; },
    finalAsk: 'Longest window you can make all one letter?',
    done: function (ans) { return 'Longest = ' + ans + '.'; }
  });

  variable('fruit-into-baskets', {
    title: 'Fruit Into Baskets: at most two kinds',
    rule: 'Two baskets means the window may hold at most 2 distinct fruit types. When a third type enters, shrink L until one type is gone.',
    type: 'max', measureName: 'fruits',
    gen: function (rng, round) { var a = [], cur = rng.int(1, 4); for (var i = 0; i < 10 + round; i++) { if (rng.chance(0.45)) cur = rng.int(1, 4); a.push(cur); } return { a: a, setup: 'fruits = ' + LC.fmt(a) }; },
    valid: function (w) { return Object.keys(counts(w)).length <= 2; },
    whyBad: function (w) { return Object.keys(counts(w)).length + ' fruit types do not fit in 2 baskets.'; },
    measure: function (w) { return w.length; },
    vars: function (w) { return [['baskets', countStr(counts(w))]]; },
    finalAsk: 'Most fruits you can pick?',
    done: function (ans) { return 'You can pick ' + ans + ' fruits.'; }
  });

  variable('longest-subarray-of-1s-after-deleting-one-element', {
    title: 'Longest Subarray of 1s After Deleting One: one zero allowed',
    rule: 'Allow at most one zero in the window (that is the deleted element). The answer is window length − 1, because you must delete one element.',
    type: 'max', measureName: 'ones after delete', bestLabel: 'best (len − 1)',
    gen: function (rng, round) { var a = []; for (var i = 0; i < 10 + round; i++) a.push(rng.chance(0.3) ? 0 : 1); return { a: a, setup: 'nums = ' + LC.fmt(a) }; },
    valid: function (w) { return w.filter(function (x) { return x === 0; }).length <= 1; },
    whyBad: function (w) { return w.filter(function (x) { return x === 0; }).length + ' zeros, but you can delete only one.'; },
    measure: function (w) { return w.length - 1; },
    vars: function (w) { return [['zeros', w.filter(function (x) { return x === 0; }).length + ' / 1'], ['len', w.length]]; },
    finalAsk: 'Longest run of 1s after deleting exactly one element?',
    done: function (ans) { return 'Answer ' + ans + '. The −1 accounts for the forced deletion.'; }
  });

  variable('maximize-the-confusion-of-an-exam', {
    title: 'Maximize the Confusion: flip at most k answers',
    rule: 'Run the at-most-k window twice: once flipping F into T and once flipping T into F. This round runs one pass; shrink when the flips needed exceed k.',
    type: 'max', measureName: 'length',
    gen: function (rng, round) {
      var k = rng.int(1, 2), s = [];
      for (var i = 0; i < 10 + round; i++) s.push(rng.pick(['T', 'F']));
      var flip = round % 2 === 0 ? 'F' : 'T';
      var other = maxPass(s, k, flip === 'F' ? 'T' : 'F');
      return { a: s, k: k, flip: flip, other: other, setup: 'answerKey = "' + s.join('') + '"   k = ' + k + '   this pass: flip ' + flip + ' to ' + (flip === 'F' ? 'T' : 'F') };
    },
    valid: function (w, g) { return w.filter(function (x) { return x === g.flip; }).length <= g.k; },
    whyBad: function (w, g) { return w.filter(function (x) { return x === g.flip; }).length + ' ' + g.flip + "'s to flip > k = " + g.k + '.'; },
    measure: function (w) { return w.length; },
    vars: function (w, g) { return [['flips', w.filter(function (x) { return x === g.flip; }).length + ' / ' + g.k]]; },
    finalAsk: 'Longest run in this pass?',
    done: function (ans, g) { return 'This pass: ' + ans + '. The other pass gives ' + g.other + ', so the answer is ' + Math.max(ans, g.other) + '.'; }
  });
  function maxPass(s, k, flip) { var l = 0, c = 0, best = 0; for (var r = 0; r < s.length; r++) { if (s[r] === flip) c++; while (c > k) { if (s[l] === flip) c--; l++; } best = Math.max(best, r - l + 1); } return best; }

  variable('maximum-erasure-value', {
    title: 'Maximum Erasure Value: unique window, biggest sum',
    rule: 'Keep every value in the window unique. A repeat forces L past its earlier copy. Track the sum, not the length.',
    type: 'max', measureName: 'sum',
    gen: function (rng, round) { var a = rng.ints(9 + round, 1, 6); return { a: a, setup: 'nums = ' + LC.fmt(a) }; },
    valid: function (w) { var m = counts(w); return Object.keys(m).every(function (k) { return m[k] <= 1; }); },
    whyBad: function (w) { var m = counts(w); return Object.keys(m).filter(function (k) { return m[k] > 1; }).join(', ') + ' appears twice.'; },
    measure: function (w) { return w.reduce(function (x, y) { return x + y; }, 0); },
    vars: function (w) { return [['sum', w.reduce(function (x, y) { return x + y; }, 0)]]; },
    finalAsk: 'Maximum score (sum of a unique window)?',
    done: function (ans) { return 'Max erasure value = ' + ans + '.'; }
  });

  variable('minimum-size-subarray-sum', {
    title: 'Minimum Size Subarray Sum: grow to reach, shrink to tighten',
    rule: 'Grow R until sum at least target. Then shrink L as long as the sum still reaches the target, recording each length. Shortest wins.',
    type: 'min',
    gen: function (rng, round) { var a = rng.ints(9 + round, 1, 6); var target = rng.int(7, 13); return { a: a, target: target, setup: 'nums = ' + LC.fmt(a) + '   target = ' + target }; },
    valid: function (w, g) { return w.reduce(function (x, y) { return x + y; }, 0) >= g.target; },
    whyBad: function (w, g) { return 'sum ' + w.reduce(function (x, y) { return x + y; }, 0) + ' < ' + g.target; },
    measure: function (w) { return w.length; },
    vars: function (w, g) { return [['sum', w.reduce(function (x, y) { return x + y; }, 0)], ['target', g.target]]; },
    finalAsk: 'Minimal length (0 if impossible)?',
    done: function (ans) { return 'Shortest length = ' + ans + '. O(n): each index enters and leaves once.'; }
  });

  variable('minimum-window-substring', {
    title: 'Minimum Window Substring: cover, then tighten',
    rule: 'Grow R until the window covers every letter of t (with counts). Then shrink L while it still covers, recording the shortest cover.',
    type: 'min',
    gen: function (rng, round) {
      var tt = round === 0 ? ['A', 'B'] : round === 1 ? ['A', 'B', 'C'] : ['A', 'A', 'B'];
      var s; do { s = []; for (var i = 0; i < 10 + round; i++) s.push(rng.pick(['A', 'B', 'C', 'X', 'Y'])); } while (!covers(s, tt));
      return { a: s, t: tt, setup: 's = "' + s.join('') + '"   t = "' + tt.join('') + '"' };
    },
    valid: function (w, g) { return covers(w, g.t); },
    whyBad: function (w, g) { var m = counts(w), need = counts(g.t), miss = []; for (var c in need) if ((m[c] || 0) < need[c]) miss.push(c); return 'missing ' + miss.join(', '); },
    measure: function (w) { return w.length; },
    vars: function (w, g) { return [['window', '"' + w.join('') + '"'], ['need', '"' + g.t.join('') + '"']]; },
    finalAsk: 'Length of the minimum window?',
    done: function (ans) { return 'Minimum window length ' + ans + '.'; }
  });
  function covers(w, tt) { var m = counts(w), need = counts(tt); for (var c in need) if ((m[c] || 0) < need[c]) return false; return true; }

  /* ---------- fixed-size windows ---------- */

  LC.register('maximum-average-subarray-i', {
    title: 'Maximum Average Subarray I: add one, drop one',
    rule: 'The window size is fixed at k. Each slide adds the entering value and subtracts the leaving value. Never re-sum the whole window.',
    make: function (rng, round) {
      var n = 8 + round, k = rng.int(3, 4), a = rng.ints(n, -3, 9);
      var t = new LC.Trace();
      t.setup = 'nums = ' + LC.fmt(a) + '   k = ' + k;
      var sum = 0; for (var i = 0; i < k; i++) sum += a[i];
      var best = sum;
      t.num(V(P.arr(a, { win: [0, k - 1], ptr: { L: 0, R: k - 1 } })), 'Sum of the first window?', sum, { wrong: 'Add the first ' + k + ' values.', note: 'Starting sum ' + sum + '.' });
      for (var r = k; r < n; r++) {
        var l = r - k + 1, ns = sum + a[r] - a[r - k];
        t.num(V(P.arr(a, { win: [l, r], ptr: { L: l, R: r }, cls: (function () { var c = {}; c[r - k] = 'dim'; c[r] = 'hit'; return c; })() }), P.vars([['old sum', sum], ['in', a[r]], ['out', a[r - k]], ['best', best]])),
          'Slide by one. New sum?', ns, { wrong: 'new = old + in − out = ' + sum + ' + ' + a[r] + ' − ' + a[r - k] + '.', note: 'O(1) update: ' + ns + '.' });
        sum = ns; best = Math.max(best, sum);
      }
      t.num(V(P.arr(a), P.vars([['k', k]])), 'Largest window sum you saw?', best, { wrong: 'Track the max of the sums you computed.', note: 'Best sum ' + best + '.' });
      t.done(V(P.arr(a), P.vars([['max sum', best], ['max average', (best / k).toFixed(5)]])), 'Max average = ' + best + ' / ' + k + ' = ' + (best / k).toFixed(5) + '.');
      return t;
    }
  });

  function isV(c) { return 'aeiou'.indexOf(c) !== -1; }
  LC.register('maximum-number-of-vowels-in-a-substring-of-given-length', {
    title: 'Max Vowels in a Substring: +1 in, −1 out',
    rule: 'The window is fixed at k. On each slide, add 1 if the entering char is a vowel and subtract 1 if the leaving char is a vowel.',
    make: function (rng, round) {
      var n = 10 + round, k = rng.int(3, 4), s = [];
      for (var i = 0; i < n; i++) s.push(rng.chance(0.4) ? rng.pick(['a', 'e', 'i', 'o', 'u']) : rng.pick(['b', 'c', 'd', 'k', 'l', 'm', 'r', 't']));
      var t = new LC.Trace();
      t.setup = 's = "' + s.join('') + '"   k = ' + k;
      var cnt = 0; for (i = 0; i < k; i++) if (isV(s[i])) cnt++;
      var best = cnt;
      t.num(V(P.arr(s, { win: [0, k - 1], ptr: { L: 0, R: k - 1 } })), 'Vowels in the first window?', cnt, { wrong: 'Count a, e, i, o, u in the first ' + k + ' chars.', note: cnt + ' vowels.' });
      for (var r = k; r < n; r++) {
        var nc = cnt + (isV(s[r]) ? 1 : 0) - (isV(s[r - k]) ? 1 : 0);
        var c = {}; c[r - k] = 'dim'; c[r] = 'hit';
        t.num(V(P.arr(s, { win: [r - k + 1, r], ptr: { L: r - k + 1, R: r }, cls: c }), P.vars([['old count', cnt], ['in', s[r]], ['out', s[r - k]], ['best', best]])),
          'Slide by one. Vowel count now?', nc, { wrong: (isV(s[r]) ? '+1 for "' + s[r] + '"' : '+0 for "' + s[r] + '"') + ', ' + (isV(s[r - k]) ? '−1 for "' + s[r - k] + '"' : '−0 for "' + s[r - k] + '"') + '.', note: nc + ' vowels.' });
        cnt = nc; best = Math.max(best, cnt);
      }
      t.done(V(P.arr(s), P.vars([['max vowels', best]])), 'Max vowels = ' + best + '. O(n).');
      return t;
    }
  });

  function anagramGame(slug, title, rule, findAll) {
    LC.register(slug, {
      title: title, rule: rule,
      make: function (rng, round) {
        var m = 2 + (round > 0 ? 1 : 0), letters = ['a', 'b', 'c'], p = [], s = [], i;
        for (i = 0; i < m; i++) p.push(rng.pick(letters));
        for (i = 0; i < 9 + round; i++) s.push(rng.pick(letters.concat(['d'])));
        if (rng.chance(0.75)) { var at = rng.int(0, s.length - m); var perm = rng.shuffle(p); for (i = 0; i < m; i++) s[at + i] = perm[i]; }
        var t = new LC.Trace();
        t.setup = (findAll ? 's = "' + s.join('') + '"   p = "' : 's2 = "' + s.join('') + '"   s1 = "') + p.join('') + '"';
        var need = counts(p), found = [], res = false;
        var acts = findAll ? [['Y', 'Counts match: record start'], ['N', 'Slide on']] : [['Y', 'Counts match: return true'], ['N', 'Slide on']];
        for (var st = 0; st + m <= s.length; st++) {
          var w = s.slice(st, st + m), wc = counts(w);
          var match = countStr(wc) === countStr(need);
          var c = {}; for (i = 0; i < m; i++) c[st + i] = 'hit';
          var v = V(P.arr(s, { win: [st, st + m - 1], ptr: { L: st, R: st + m - 1 } }), P.vars([['window counts', countStr(wc)], ['need', countStr(need)], findAll ? ['starts', found.length ? found.join(',') : '—'] : ['size', m]]));
          t.act(v, 'Window "' + w.join('') + '". Anagram of "' + p.join('') + '"?', acts, match ? 'Y' : 'N',
            match ? 'Same letter counts, so it is a permutation.' : 'Counts differ (' + countStr(wc) + ' vs ' + countStr(need) + ').',
            match ? (findAll ? 'Record ' + st + '.' : 'Found a permutation.') : 'Slide: one letter in, one out.');
          if (match) { found.push(st); if (!findAll) { res = true; break; } }
        }
        t.done(V(P.arr(s)), findAll ? 'Start indexes: [' + found.join(',') + '].' : (res ? 'True: s2 contains a permutation of s1.' : 'False: no window matched.'));
        return t;
      }
    });
  }
  anagramGame('permutation-in-string', 'Permutation in String: compare counts in a fixed window',
    'A permutation has the same letter counts. Slide a window of len(s1) over s2 and compare counts; one letter enters and one leaves per slide.', false);
  anagramGame('find-all-anagrams-in-a-string', 'Find All Anagrams: record every matching window',
    'Slide a window of len(p). Whenever its letter counts equal p\'s counts, that start index is an anagram. Keep sliding; there can be many.', true);
})();
