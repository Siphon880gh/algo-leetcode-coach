/* Stack games: each token is a push, a pop, or a verdict. */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, V = LC.view;
  var PAIR = { ')': '(', ']': '[', '}': '{' };

  function tokView(tokens, i, stack, extra, opts) {
    var c = {}; for (var x = 0; x < i; x++) c[x] = 'done'; if (i < tokens.length) c[i] = 'hit';
    var panels = [P.arr(tokens, { ptr: i < tokens.length ? { i: i } : {}, cls: c, idx: opts && opts.idx === false ? false : true, label: (opts && opts.label) || 'input' }), P.stack(stack, (opts && opts.stackLabel) || 'stack (top ↑)')];
    if (extra) panels.push(P.vars(extra));
    return V.apply(null, panels);
  }

  LC.register('valid-parentheses', {
    title: 'Valid Parentheses: the closer must match the top',
    rule: 'Push every opener. A closer must match the opener on top of the stack, or the string is invalid. At the end the stack must be empty.',
    minSteps: 6,
    make: function (rng, round) {
      var s = [], depth = [], n = 8 + round * 2, i;
      for (i = 0; i < n; i++) {
        if (depth.length && (rng.chance(0.5) || depth.length > 3)) s.push({ '(': ')', '[': ']', '{': '}' }[depth.pop()]);
        else { var o = rng.pick(['(', '[', '{']); depth.push(o); s.push(o); }
      }
      while (depth.length) s.push({ '(': ')', '[': ']', '{': '}' }[depth.pop()]);
      var mode = rng.int(0, 9);
      if (mode < 3) { var p = rng.int(0, s.length - 1); if (PAIR[s[p]]) s[p] = rng.pick([')', ']', '}']); }
      else if (mode < 5) s.splice(rng.int(0, s.length), 0, rng.pick(['(', '[', '{']));
      var t = new LC.Trace();
      t.setup = 's = "' + s.join('') + '"';
      var st = [], acts = [['push', 'Push'], ['pop', 'Pop (matches top)'], ['bad', 'Invalid → false']];
      for (i = 0; i < s.length; i++) {
        var ch = s[i], v = tokView(s, i, st);
        if (!PAIR[ch]) { t.act(v, '"' + ch + '" arrives.', acts, 'push', { pop: 'Openers never pop; they wait for their closer.', bad: 'An opener cannot make the string invalid yet.' }, 'Opener waits on the stack.'); st.push(ch); continue; }
        if (st.length && st[st.length - 1] === PAIR[ch]) { t.act(v, '"' + ch + '" arrives; top is "' + st[st.length - 1] + '".', acts, 'pop', { push: 'Closers never get pushed.', bad: '"' + ch + '" matches the top "' + st[st.length - 1] + '".' }, 'Matched pair removed.'); st.pop(); continue; }
        t.act(v, '"' + ch + '" arrives; top is ' + (st.length ? '"' + st[st.length - 1] + '"' : 'empty') + '.', acts, 'bad', { push: 'Closers never get pushed.', pop: st.length ? '"' + ch + '" does not close "' + st[st.length - 1] + '".' : 'Nothing to pop: no opener is waiting.' }, 'Mismatch: invalid.');
        t.done(tokView(s, i, st), 'Invalid at index ' + i + '.');
        return t;
      }
      var endActs = [['T', 'Return true'], ['F', 'Return false']];
      t.act(tokView(s, s.length, st), 'Input finished. Verdict?', endActs, st.length ? 'F' : 'T', st.length ? st.length + ' opener(s) never closed.' : 'Every opener was matched; the stack is empty.', st.length ? 'Leftover openers mean false.' : 'Empty stack means valid.');
      t.done(tokView(s, s.length, st), st.length ? 'Invalid: unclosed openers.' : 'Valid. O(n) time, O(n) stack.');
      return t;
    }
  });

  LC.register('minimum-add-to-make-parentheses-valid', {
    title: 'Minimum Add to Make Parentheses Valid: count what never matches',
    rule: 'Each "(" waits on the stack. A ")" with nothing waiting needs an inserted "(" right now. Every "(" left at the end needs an inserted ")".',
    make: function (rng, round) {
      var s = []; for (var i = 0; i < 9 + round; i++) s.push(rng.chance(0.5) ? '(' : ')');
      var t = new LC.Trace();
      t.setup = 's = "' + s.join('') + '"';
      var st = [], add = 0, acts = [['push', 'Push "("'], ['pop', 'Pop (match)'], ['add', 'Unmatched: inserts++']];
      for (i = 0; i < s.length; i++) {
        var v = tokView(s, i, st, [['inserts', add]]);
        if (s[i] === '(') { t.act(v, '"(" arrives.', acts, 'push', 'An opener just waits for a closer.', 'Waiting.'); st.push('('); }
        else if (st.length) { t.act(v, '")" arrives with a "(" waiting.', acts, 'pop', 'A "(" is waiting; match it.', 'Matched.'); st.pop(); }
        else { t.act(v, '")" arrives and nothing is waiting.', acts, 'add', 'The stack is empty, so this ")" needs an inserted "(".', 'One insert for this closer.'); add++; }
      }
      t.num(tokView(s, s.length, st, [['inserts so far', add]]), 'Total inserts needed?', add + st.length, { wrong: 'inserts so far (' + add + ') + leftover "(" (' + st.length + ').', note: add + ' + ' + st.length + ' = ' + (add + st.length) + '.' });
      t.done(tokView(s, s.length, st), 'Minimum adds = ' + (add + st.length) + '.');
      return t;
    }
  });

  function adjacentGame(slug, title, rule, letters, cancels, describe) {
    LC.register(slug, {
      title: title, rule: rule,
      make: function (rng, round) {
        var s = []; for (var i = 0; i < 9 + round; i++) s.push(rng.pick(letters));
        for (var j = 0; j < 3; j++) { var p = rng.int(0, s.length - 2); var c = s[p]; s[p + 1] = cancels === 'same' ? c : (c === c.toUpperCase() ? c.toLowerCase() : c.toUpperCase()); }
        var t = new LC.Trace();
        t.setup = 's = "' + s.join('') + '"';
        var st = [], acts = [['push', 'Push'], ['pop', 'Pop: they cancel']];
        for (i = 0; i < s.length; i++) {
          var top = st.length ? st[st.length - 1] : null;
          var cancel = top !== null && (cancels === 'same' ? top === s[i] : top !== s[i] && top.toLowerCase() === s[i].toLowerCase());
          var v = tokView(s, i, st);
          t.act(v, '"' + s[i] + '" arrives; top is ' + (top === null ? 'empty' : '"' + top + '"') + '.', acts, cancel ? 'pop' : 'push',
            cancel ? describe(top, s[i]) + ' They cancel.' : (top === null ? 'Nothing to cancel with.' : '"' + top + '" and "' + s[i] + '" do not cancel.'),
            cancel ? 'Both gone. The char below may now meet the next one.' : 'Pushed.');
          if (cancel) st.pop(); else st.push(s[i]);
        }
        t.done(tokView(s, s.length, st), 'Result "' + st.join('') + '". The stack makes chain reactions free.');
        return t;
      }
    });
  }
  adjacentGame('remove-all-adjacent-duplicates-in-string', 'Remove Adjacent Duplicates: equal to the top cancels',
    'Compare each char to the top of the stack. Equal → pop (both vanish). Otherwise push. Chain reactions happen for free.',
    ['a', 'b', 'c'], 'same', function (a, b) { return '"' + b + '" equals the top "' + a + '".'; });
  adjacentGame('make-the-string-great', 'Make The String Great: same letter, opposite case cancels',
    'Compare each char to the top. Same letter in the opposite case (a/A) → pop both. Otherwise push.',
    ['a', 'A', 'b', 'B', 'c'], 'case', function (a, b) { return '"' + a + '" and "' + b + '" are the same letter in opposite case.'; });

  LC.register('backspace-string-compare', {
    title: 'Backspace String Compare: # pops',
    rule: 'Type each string into a stack: a letter pushes, "#" pops the last letter (and does nothing on an empty stack). Compare the two stacks.',
    make: function (rng, round) {
      function mk() { var x = []; for (var i = 0; i < 5 + round; i++) x.push(rng.chance(0.35) ? '#' : rng.pick(['a', 'b', 'c'])); return x; }
      var s = mk(), u = rng.chance(0.5) ? s.slice() : mk();
      if (u.join('') === s.join('') && rng.chance(0.5)) { u = s.slice(); u.splice(rng.int(0, u.length), 0, 'x', '#'); }
      var t = new LC.Trace();
      t.setup = 's = "' + s.join('') + '"   t = "' + u.join('') + '"';
      var acts = [['push', 'Type (push)'], ['pop', 'Backspace (pop)'], ['noop', 'Backspace on empty: nothing']];
      var results = [];
      [[s, 's'], [u, 't']].forEach(function (pair) {
        var str = pair[0], st = [];
        for (var i = 0; i < str.length; i++) {
          var v = tokView(str, i, st, null, { label: pair[1], stackLabel: pair[1] + ' typed' });
          if (str[i] !== '#') t.act(v, '"' + str[i] + '" in ' + pair[1] + '.', acts, 'push', 'Letters are typed.', 'Typed.');
          else if (st.length) t.act(v, '"#" in ' + pair[1] + '.', acts, 'pop', 'Backspace deletes the last typed letter.', 'Deleted "' + st[st.length - 1] + '".');
          else t.act(v, '"#" in ' + pair[1] + ' with nothing typed.', acts, 'noop', 'There is nothing to delete.', 'Backspace on empty text does nothing.');
          if (str[i] !== '#') st.push(str[i]); else st.pop();
        }
        results.push(st.join(''));
      });
      var eq = results[0] === results[1];
      t.act(V(P.vars([['s types', '"' + results[0] + '"'], ['t types', '"' + results[1] + '"']])), 'Same final text?', [['T', 'Equal → true'], ['F', 'Different → false']], eq ? 'T' : 'F', eq ? 'Both type "' + results[0] + '".' : '"' + results[0] + '" ≠ "' + results[1] + '".', eq ? 'True.' : 'False.');
      t.done(V(P.vars([['s', '"' + results[0] + '"'], ['t', '"' + results[1] + '"']])), eq ? 'True.' : 'False.');
      return t;
    }
  });

  function rpnTokens(rng, ops) {
    function build(d) {
      if (d === 0 || rng.chance(0.25)) return [String(rng.int(1, 9))];
      var op = rng.pick(ops);
      var L = build(d - 1), R = build(d - 1);
      return L.concat(R, [op]);
    }
    var tk; do { tk = build(3); } while (tk.length < 7 || tk.length > 11);
    return tk;
  }
  function rpnSafe(tk) {
    var st = [];
    for (var i = 0; i < tk.length; i++) {
      if (/^\d+$/.test(tk[i])) { st.push(Number(tk[i])); continue; }
      var b = st.pop(), a = st.pop();
      if (tk[i] === '/' && b === 0) return false;
      var r = applyOp(a, b, tk[i]);
      if (Math.abs(r) > 99) return false;
      st.push(r);
    }
    return st.length === 1;
  }
  function applyOp(a, b, op) { if (op === '+') return a + b; if (op === '-') return a - b; if (op === '*') return a * b; return Math.trunc(a / b); }

  LC.register('evaluate-reverse-polish-notation', {
    title: 'Evaluate RPN: operators pop two',
    rule: 'Numbers push. An operator pops b (top) then a, and pushes a op b. The second value popped is the LEFT operand. Division truncates toward zero.',
    make: function (rng, round) {
      var tk;
      do { tk = rpnTokens(rng, round === 0 ? ['+', '-', '*'] : ['+', '-', '*', '/']); } while (!rpnSafe(tk));
      var t = new LC.Trace();
      t.setup = 'tokens = ' + JSON.stringify(tk);
      var st = [];
      for (var i = 0; i < tk.length; i++) {
        var v = tokView(tk, i, st);
        if (/^\d+$/.test(tk[i])) {
          t.act(v, '"' + tk[i] + '" arrives.', [['push', 'Push number'], ['op', 'Pop two and apply']], 'push', 'It is a number; numbers wait on the stack.', 'Pushed.');
          st.push(Number(tk[i]));
        } else {
          var b = st[st.length - 1], a = st[st.length - 2];
          var res = applyOp(a, b, tk[i]);
          t.num(v, '"' + tk[i] + '": pop b = ' + b + ', then a = ' + a + '. Push what?', res, { wrong: 'Compute a ' + tk[i] + ' b = ' + a + ' ' + tk[i] + ' ' + b + (tk[i] === '/' ? ' (truncate toward zero)' : '') + '. Order matters.', note: a + ' ' + tk[i] + ' ' + b + ' = ' + res + '.' });
          st.pop(); st.pop(); st.push(res);
        }
      }
      t.done(tokView(tk, tk.length, st), 'Result ' + st[0] + '.');
      return t;
    }
  });

  LC.register('baseball-game', {
    title: 'Baseball Game: the stack is the score sheet',
    rule: 'An integer pushes a score. "+" pushes the sum of the top two, "D" pushes double the top, "C" pops the last score. The answer is the sum of the stack.',
    make: function (rng, round) {
      var ops = [], depth = 0;
      for (var i = 0; i < 8 + round; i++) {
        var choices = ['n', 'n'];
        if (depth >= 1) choices.push('D', 'C');
        if (depth >= 2) choices.push('+', '+');
        var c = rng.pick(choices);
        if (c === 'n') { ops.push(String(rng.int(-5, 9))); depth++; }
        else { ops.push(c); depth += c === 'C' ? -1 : 1; }
      }
      var t = new LC.Trace();
      t.setup = 'operations = ' + JSON.stringify(ops);
      var st = [], acts = [['push', 'Push this score'], ['sum', 'Push top two summed'], ['dbl', 'Push top doubled'], ['pop', 'Pop last score']];
      for (i = 0; i < ops.length; i++) {
        var o = ops[i], v = tokView(ops, i, st);
        if (o === '+') { t.num(v, '"+": what gets pushed?', st[st.length - 1] + st[st.length - 2], { wrong: 'Sum the top two: ' + st[st.length - 2] + ' + ' + st[st.length - 1] + '.', note: 'Pushed the sum.' }); st.push(st[st.length - 1] + st[st.length - 2]); }
        else if (o === 'D') { t.num(v, '"D": what gets pushed?', 2 * st[st.length - 1], { wrong: 'Double the top: 2 × ' + st[st.length - 1] + '.', note: 'Pushed the double.' }); st.push(2 * st[st.length - 1]); }
        else if (o === 'C') { t.act(v, '"C" arrives.', acts, 'pop', 'C cancels the previous score.', 'Removed ' + st[st.length - 1] + '.'); st.pop(); }
        else { t.act(v, '"' + o + '" arrives.', acts, 'push', 'A plain integer is a new score.', 'Recorded.'); st.push(Number(o)); }
      }
      var sum = st.reduce(function (x, y) { return x + y; }, 0);
      t.num(tokView(ops, ops.length, st), 'Total score?', sum, { wrong: 'Add up everything left on the stack.', note: 'Total ' + sum + '.' });
      t.done(tokView(ops, ops.length, st), 'Final score ' + sum + '.');
      return t;
    }
  });

  LC.register('minimum-remove-to-make-valid-parentheses', {
    title: 'Minimum Remove to Make Valid: stack the indexes',
    rule: 'Push the index of every "(". A ")" pops a waiting "(", or is removed if none is waiting. Any "(" still on the stack at the end is removed too.',
    make: function (rng, round) {
      var s = []; for (var i = 0; i < 9 + round; i++) s.push(rng.pick(['(', ')', 'a', 'b', '(', ')']));
      var t = new LC.Trace();
      t.setup = 's = "' + s.join('') + '"';
      var st = [], removed = {}, acts = [['push', 'Push index'], ['pop', 'Pop (match)'], ['rm', 'Remove this ")"'], ['keep', 'Letter: keep']];
      for (i = 0; i < s.length; i++) {
        var c = {}; for (var k in removed) c[k] = 'bad'; c[i] = 'hit';
        var v = V(P.arr(s, { ptr: { i: i }, cls: c }), P.stack(st, 'stack of "(" indexes'));
        if (s[i] === '(') { t.act(v, '"(" at ' + i + '.', acts, 'push', 'Remember where this opener is.', 'Pushed index ' + i + '.'); st.push(i); }
        else if (s[i] === ')') {
          if (st.length) { t.act(v, '")" at ' + i + ' with "(" at ' + st[st.length - 1] + ' waiting.', acts, 'pop', 'A "(" is waiting to be matched.', 'Matched with ' + st[st.length - 1] + '.'); st.pop(); }
          else { t.act(v, '")" at ' + i + ', nothing waiting.', acts, 'rm', 'No "(" is waiting, so this ")" can never be matched.', 'Marked for removal.'); removed[i] = 1; }
        } else t.act(v, '"' + s[i] + '" at ' + i + '.', acts, 'keep', 'Letters are always kept.', 'Kept.');
      }
      st.forEach(function (x) { removed[x] = 1; });
      var fc = {}; for (var kk in removed) fc[kk] = 'bad';
      var total = Object.keys(removed).length;
      t.num(V(P.arr(s, { cls: fc }), P.stack(st, 'leftover "(" indexes')), 'How many characters are removed in total?', total, { wrong: 'Unmatched ")" plus leftover "(".', note: total + ' removed.' });
      t.done(V(P.arr(s.filter(function (_, j) { return !removed[j]; }), { label: 'result' })), 'Result "' + s.filter(function (_, j) { return !removed[j]; }).join('') + '".');
      return t;
    }
  });

  LC.register('simplify-path', {
    title: 'Simplify Path: ".." pops, names push',
    rule: 'Split on "/". A name pushes, ".." pops (if anything is there), and "." or empty parts do nothing. Join the stack with "/".',
    make: function (rng, round) {
      var parts = [];
      for (var i = 0; i < 7 + round; i++) parts.push(rng.pick(['a', 'b', 'c', 'home', 'usr', '..', '..', '.', '']));
      var path = '/' + parts.join('/') + (rng.chance(0.3) ? '/' : '');
      var tk = path.split('/').slice(1);
      var t = new LC.Trace();
      t.setup = 'path = "' + path + '"';
      var st = [], acts = [['push', 'Push name'], ['pop', 'Pop (go up)'], ['skip', 'Ignore']];
      for (i = 0; i < tk.length; i++) {
        var p = tk[i], v = tokView(tk.map(function (x) { return x === '' ? '∅' : x; }), i, st, null, { label: 'parts', stackLabel: 'directories' });
        if (p === '' || p === '.') t.act(v, 'Part "' + p + '".', acts, 'skip', p === '' ? 'Empty parts come from "//"; they mean nothing.' : '"." means the current directory.', 'Ignored.');
        else if (p === '..') {
          if (st.length) t.act(v, 'Part "..".', acts, 'pop', '".." goes up one directory.', 'Left "' + st[st.length - 1] + '".');
          else t.act(v, 'Part ".." at the root.', acts, 'skip', 'You cannot go above the root, so ".." does nothing here.', 'Root stays root.');
          st.pop();
        } else { t.act(v, 'Part "' + p + '".', acts, 'push', 'A real name enters a directory.', 'Entered "' + p + '".'); st.push(p); }
      }
      t.done(V(P.stack(st, 'directories')), 'Canonical path "/' + st.join('/') + '".');
      return t;
    }
  });

  LC.register('asteroid-collision', {
    title: 'Asteroid Collision: only → meets ←',
    rule: 'A collision happens only when the top of the stack moves right (+) and the new asteroid moves left (−). The smaller one explodes; equal sizes both explode.',
    make: function (rng, round) {
      var a = []; for (var i = 0; i < 7 + round; i++) { var v = rng.int(1, 9); a.push(rng.chance(0.5) ? v : -v); }
      var t = new LC.Trace();
      t.setup = 'asteroids = ' + LC.fmt(a);
      var st = [], acts = [['push', 'No collision: push'], ['top', 'Top explodes'], ['new', 'New one explodes'], ['both', 'Both explode']];
      for (i = 0; i < a.length; i++) {
        var cur = a[i], alive = true;
        while (alive) {
          var top = st.length ? st[st.length - 1] : null;
          var v2 = tokView(a, i, st, null, { label: 'asteroids', stackLabel: 'surviving' });
          if (top === null || !(top > 0 && cur < 0)) {
            t.act(v2, cur + ' arrives; top is ' + (top === null ? 'empty' : top) + '.', acts, 'push', top === null ? 'Nothing to hit.' : (top < 0 ? 'The top moves left, away from it.' : 'Both move right; they never meet.'), 'Survives.');
            st.push(cur); break;
          }
          var key = Math.abs(top) < Math.abs(cur) ? 'top' : Math.abs(top) > Math.abs(cur) ? 'new' : 'both';
          t.act(v2, cur + ' meets ' + top + '.', acts, key, { push: top + ' moves right and ' + cur + ' moves left: they collide.', top: '|' + top + '| is not smaller than |' + cur + '|.', 'new': '|' + cur + '| is not smaller than |' + top + '|.', both: 'They are not the same size.' }, key === 'top' ? top + ' explodes; ' + cur + ' keeps flying.' : key === 'new' ? cur + ' explodes.' : 'Both explode.');
          if (key === 'top') st.pop();
          else if (key === 'new') alive = false;
          else { st.pop(); alive = false; }
        }
      }
      t.done(V(P.stack(st, 'surviving')), 'Survivors ' + LC.fmt(st) + '.');
      return t;
    }
  });

  LC.register('longest-valid-parentheses', {
    title: 'Longest Valid Parentheses: keep a base index',
    rule: 'Start the stack with base −1. "(" pushes its index. ")" pops; if the stack is now empty, push i as the new base, else the valid run is i − top.',
    make: function (rng, round) {
      var s = []; for (var i = 0; i < 9 + round; i++) s.push(rng.chance(0.55) ? '(' : ')');
      var t = new LC.Trace();
      t.setup = 's = "' + s.join('') + '"';
      var st = [-1], best = 0, acts = [['push', 'Push i'], ['measure', 'Pop, then length = i − top'], ['base', 'Pop, stack empty → i is the new base']];
      for (i = 0; i < s.length; i++) {
        var v = V(P.arr(s, { ptr: { i: i }, cls: (function () { var c = {}; c[i] = 'hit'; return c; })() }), P.stack(st, 'index stack'), P.vars([['best', best]]));
        if (s[i] === '(') { t.act(v, '"(" at ' + i + '.', acts, 'push', 'Openers push their index.', 'Pushed ' + i + '.'); st.push(i); continue; }
        st.pop();
        if (!st.length) { t.act(v, '")" at ' + i + '.', acts, 'base', 'After popping, nothing is left below, so this ")" is unmatched and becomes the base.', i + ' is the new base.'); st.push(i); }
        else { var len = i - st[st.length - 1]; best = Math.max(best, len); t.act(v, '")" at ' + i + '.', acts, 'measure', 'After popping, index ' + st[st.length - 1] + ' is still below, so you have a valid run.', 'Valid run ' + i + ' − ' + st[st.length - 1] + ' = ' + len + '.'); }
      }
      t.num(V(P.arr(s), P.vars([['best', best]])), 'Longest valid length?', best, { wrong: 'Use the best run you measured.', note: 'Longest ' + best + '.' });
      t.done(V(P.arr(s), P.vars([['answer', best]])), 'Longest valid parentheses = ' + best + '.');
      return t;
    }
  });
})();
