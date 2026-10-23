/* Shared fixture player for gap mini-games. Each page sets window.GAP = {title, rule, fixtures}. */
(function () {
  'use strict';
  function el(t, c, h) { var e = document.createElement(t); if (c) e.className = c; if (h !== undefined) e.innerHTML = h; return e; }
  function fmt(x) {
    if (x === null || x === undefined) return 'null';
    if (typeof x === 'boolean') return x ? 'true' : 'false';
    if (typeof x === 'object') return JSON.stringify(x);
    return String(x);
  }
  function mount(root, G) {
    var lives = 3, score = 0, fi = 0, si = 0, fixtures = G.fixtures.slice();
    for (var i = fixtures.length - 1; i > 0; i--) { var j = Math.floor(Math.random() * (i + 1)); var t = fixtures[i]; fixtures[i] = fixtures[j]; fixtures[j] = t; }
    var round = fixtures[0];
    root.innerHTML = '';
    var head = el('header', 'gap-head');
    head.appendChild(el('h1', '', G.title));
    head.appendChild(el('p', 'gap-rule', G.rule));
    var status = el('div', 'gap-status', 'Lives <b id="lives">3</b> · Score <b id="score">0</b> · Round <b id="round">1</b>/' + Math.min(3, fixtures.length));
    head.appendChild(status);
    root.appendChild(head);
    var board = el('div', 'gap-board'); root.appendChild(board);
    var ask = el('div', 'gap-ask'); root.appendChild(ask);
    var feedback = el('div', 'gap-feedback'); root.appendChild(feedback);
    var roundsDone = 0, maxRounds = Math.min(3, fixtures.length);

    function showBoard(step) {
      board.innerHTML = '';
      var pre = el('pre', 'gap-input');
      pre.textContent = step.board || round.board || fmt(round.input);
      board.appendChild(pre);
    }
    function setStatus() {
      root.querySelector('#lives').textContent = lives;
      root.querySelector('#score').textContent = score;
      root.querySelector('#round').textContent = roundsDone + 1;
    }
    function endRound(ok) {
      roundsDone++;
      if (lives <= 0 || roundsDone >= maxRounds) {
        ask.innerHTML = '';
        feedback.className = 'gap-feedback done';
        feedback.textContent = lives <= 0 ? 'Out of lives. Refresh to try again.' : 'Nice work — ' + score + ' points. Refresh for new rounds.';
        return;
      }
      round = fixtures[roundsDone]; si = 0; feedback.textContent = ''; feedback.className = 'gap-feedback';
      nextStep();
    }
    function nextStep() {
      setStatus();
      var steps = round.steps;
      if (si >= steps.length) { score += 10; endRound(true); return; }
      var step = steps[si];
      showBoard(step);
      ask.innerHTML = '';
      ask.appendChild(el('p', 'gap-q', step.ask));
      if (step.choices) {
        var row = el('div', 'gap-choices');
        step.choices.forEach(function (c) {
          var b = el('button', 'gap-btn', fmt(c.v));
          b.onclick = function () { check(c.v, step); };
          row.appendChild(b);
        });
        ask.appendChild(row);
      } else {
        var input = el('input', 'gap-num'); input.type = 'text'; input.placeholder = 'answer';
        var go = el('button', 'gap-btn', 'Check');
        go.onclick = function () {
          var raw = input.value.trim();
          var val = raw;
          if (/^-?\d+$/.test(raw)) val = parseInt(raw, 10);
          else if (raw === 'true') val = true;
          else if (raw === 'false') val = false;
          else { try { val = JSON.parse(raw); } catch (e) {} }
          check(val, step);
        };
        input.addEventListener('keydown', function (e) { if (e.key === 'Enter') go.onclick(); });
        ask.appendChild(input); ask.appendChild(go);
      }
    }
    function same(a, b) { return JSON.stringify(a) === JSON.stringify(b); }
    function check(val, step) {
      if (same(val, step.answer)) {
        feedback.className = 'gap-feedback ok'; feedback.textContent = 'Correct. ' + (step.why || '');
        score += 2; si++; setTimeout(nextStep, 450);
      } else {
        lives--; setStatus();
        feedback.className = 'gap-feedback bad';
        feedback.textContent = 'Not quite. ' + (step.why || ('Expected ' + fmt(step.answer)));
        if (lives <= 0) endRound(false);
      }
    }
    nextStep();
  }
  window.GapPlayer = { mount: mount };
})();
