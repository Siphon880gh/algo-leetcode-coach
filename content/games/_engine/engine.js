/*
 * Shared mini-game engine for content/games/{slug}-game/ pages.
 *
 * A game is a problem definition registered by a pattern file
 * (content/games/_engine/patterns/*.js):
 *
 *   LCGame.register('container-with-most-water', {
 *     title: 'Container With Most Water: move the shorter wall',
 *     rule: 'One-line insight the player is drilling.',
 *     how: 'Optional one-line instructions.',
 *     rounds: 3,
 *     make: function (rng, round) { var t = new LCGame.Trace(); ...; return t; }
 *   });
 *
 * make() runs the real algorithm on a random input and records every decision
 * as a step: a board snapshot (panels), a question, and the correct move.
 * The player replays the algorithm one move at a time; a wrong move costs a
 * life and explains why. No build step, no dependencies.
 */
(function () {
  'use strict';

  var LC = window.LCGame = window.LCGame || {};
  LC.problems = LC.problems || {};
  LC.register = function (slug, def) { LC.problems[slug] = def; };

  /* ---------- random ---------- */
  LC.rng = function (seed) {
    var s = (seed >>> 0) || 0x9e3779b9;
    function next() {
      s ^= s << 13; s >>>= 0;
      s ^= s >>> 17;
      s ^= s << 5; s >>>= 0;
      return s / 4294967296;
    }
    var r = {
      next: next,
      int: function (a, b) { return a + Math.floor(next() * (b - a + 1)); },
      pick: function (arr) { return arr[Math.floor(next() * arr.length)]; },
      chance: function (p) { return next() < p; },
      shuffle: function (arr) {
        var a = arr.slice();
        for (var i = a.length - 1; i > 0; i--) {
          var j = Math.floor(next() * (i + 1));
          var t = a[i]; a[i] = a[j]; a[j] = t;
        }
        return a;
      },
      ints: function (n, a, b) { var out = []; for (var i = 0; i < n; i++) out.push(r.int(a, b)); return out; },
      sorted: function (n, a, b) { return r.ints(n, a, b).sort(function (x, y) { return x - y; }); },
      distinct: function (n, a, b) {
        var pool = []; for (var v = a; v <= b; v++) pool.push(v);
        return r.shuffle(pool).slice(0, n);
      }
    };
    return r;
  };

  /** Run def.make, retrying a few seeds until the round has at least def.minSteps moves (default 4). */
  LC.build = function (def, seed, round) {
    var min = def.minSteps || 4, best = null;
    for (var k = 0; k < 30; k++) {
      var t = def.make(LC.rng((seed + k * 2654435761) >>> 0), round);
      if (!best || t.steps.length > best.steps.length) best = t;
      if (t.steps.length >= min && (!def.maxSteps || t.steps.length <= def.maxSteps)) return t;
    }
    return best;
  };

  function clone(x) { return x === undefined ? undefined : JSON.parse(JSON.stringify(x)); }
  LC.clone = clone;

  /* ---------- trace builder ---------- */
  function Trace() { this.steps = []; this.final = null; this.setup = ''; }
  LC.Trace = Trace;

  /** choices: [{label, ok, why}] — ok choices advance; why explains (wrong) or notes (right). */
  Trace.prototype.choose = function (view, ask, choices, note) {
    this.steps.push({ kind: 'choose', view: clone(view), ask: ask, choices: clone(choices), note: note || '' });
    return this;
  };

  /**
   * actions: [[key, label], ...]; correct: key or [keys];
   * why: string, {key: string}, used for wrong keys; note: shown after the right move.
   */
  Trace.prototype.act = function (view, ask, actions, correct, why, note) {
    var ok = [].concat(correct);
    var choices = actions.map(function (a) {
      var isOk = ok.indexOf(a[0]) !== -1;
      var w = '';
      if (!isOk) {
        if (typeof why === 'string') w = why;
        else if (why && why[a[0]]) w = why[a[0]];
        else if (why && why._) w = why._;
      }
      return { label: a[1], ok: isOk, why: w };
    });
    return this.choose(view, ask, choices, note);
  };

  /**
   * Click an element on the board. answers: id or [ids] like 'a:3', 'g:1,2', 't:4', 'n:B'.
   * opts.all: every answer must be clicked (any order). opts.links {id: [ids]} + opts.seeds:
   * a click is only valid when a seed or an already-clicked id links to it (flood / BFS spread).
   */
  Trace.prototype.pick = function (view, ask, answers, opts) {
    opts = opts || {};
    this.steps.push({
      kind: 'pick', view: clone(view), ask: ask, answers: [].concat(answers).map(String),
      wrong: opts.wrong || 'Not that one.', wrongMap: opts.wrongMap || null,
      note: opts.note || '', hint: opts.hint || 'Click the board.',
      extra: clone(opts.extra || null),
      all: !!opts.all, links: clone(opts.links || null), seeds: (opts.seeds || []).map(String),
      wrongChain: opts.wrongChain || 'That cell is not reachable yet. Spread only from cells you already reached.'
    });
    return this;
  };

  /** Type a number. */
  Trace.prototype.num = function (view, ask, answer, opts) {
    opts = opts || {};
    this.steps.push({ kind: 'num', view: clone(view), ask: ask, answer: Number(answer), wrong: opts.wrong || 'Not quite.', note: opts.note || '' });
    return this;
  };

  Trace.prototype.done = function (view, msg) {
    this.final = { view: clone(view), msg: msg || 'Done.' };
    return this;
  };

  /* ---------- rendering helpers ---------- */
  function h(tag, cls, text) {
    var el = document.createElement(tag);
    if (cls) el.className = cls;
    if (text !== undefined && text !== null) el.textContent = String(text);
    return el;
  }
  var SVGNS = 'http://www.w3.org/2000/svg';
  function s(tag, attrs, text) {
    var el = document.createElementNS(SVGNS, tag);
    if (attrs) for (var k in attrs) if (Object.prototype.hasOwnProperty.call(attrs, k)) el.setAttribute(k, attrs[k]);
    if (text !== undefined && text !== null) el.textContent = String(text);
    return el;
  }
  function fmt(v) {
    if (v === null || v === undefined) return '';
    if (v === Infinity) return '∞';
    if (v === -Infinity) return '−∞';
    if (Array.isArray(v)) return '[' + v.map(fmt).join(',') + ']';
    if (typeof v === 'boolean') return v ? 'T' : 'F';
    return String(v);
  }
  LC.fmt = fmt;
  function clsOf(map, key) { return map && map[key] ? ' is-' + map[key].split(' ').join(' is-') : ''; }
  function markPick(el, prefix, key, picking) {
    if (!prefix) return;
    el.setAttribute('data-pick', prefix + ':' + key);
    if (picking) el.classList.add('pickable');
  }

  var R = {};

  R.arr = function (p, picking) {
    var wrap = h('div', p.bars ? 'lc-bars' : 'lc-arr');
    var ptrAt = {};
    if (p.ptr) Object.keys(p.ptr).forEach(function (name) {
      var i = p.ptr[name];
      if (i === null || i === undefined) return;
      (ptrAt[i] = ptrAt[i] || []).push(name);
    });
    var max = 1;
    if (p.bars) p.v.forEach(function (x, i) { max = Math.max(max, Number(x) + (p.water ? Number(p.water[i] || 0) : 0)); });
    var unit = p.bars ? Math.min(14, 110 / max) : 0;
    p.v.forEach(function (val, i) {
      var inWin = p.win && i >= p.win[0] && i <= p.win[1];
      var col, cell;
      if (p.bars) {
        col = h('div', 'lc-bar-wrap');
        cell = h('div', 'lc-bar' + clsOf(p.cls, i));
        cell.style.height = Math.max(2, Number(val) * unit) + 'px';
        if (p.water && p.water[i]) {
          var wt = h('div', 'lc-bar__water');
          wt.style.height = (Number(p.water[i]) * unit) + 'px';
          cell.appendChild(wt);
        }
        col.appendChild(cell);
        col.appendChild(h('div', 'lc-bar-val', fmt(val)));
      } else {
        col = h('div', 'lc-col');
        cell = h('div', 'lc-cell' + (inWin ? ' lc-in-win' : '') + clsOf(p.cls, i), fmt(val));
        col.appendChild(cell);
      }
      markPick(cell, p.pick, i, picking);
      if (p.idx !== false) col.appendChild(h('div', 'lc-idx', p.labels ? p.labels[i] : i));
      col.appendChild(h('div', 'lc-ptr', ptrAt[i] ? ptrAt[i].join(',') : ''));
      wrap.appendChild(col);
    });
    if (p.ptr) Object.keys(ptrAt).forEach(function (i) {
      if (Number(i) >= p.v.length) {
        var col = h('div', 'lc-col');
        col.appendChild(h('div', 'lc-cell is-dim', '·'));
        if (p.idx !== false) col.appendChild(h('div', 'lc-idx', i));
        col.appendChild(h('div', 'lc-ptr', ptrAt[i].join(',')));
        wrap.appendChild(col);
      }
    });
    return wrap;
  };

  R.stack = function (p, picking) {
    var wrap = h('div', 'lc-stack');
    if (!p.v.length) wrap.appendChild(h('div', 'lc-empty', 'empty'));
    p.v.forEach(function (val, i) {
      var c = h('div', 'lc-cell' + (i === p.v.length - 1 ? ' is-top' : '') + clsOf(p.cls, i), fmt(val));
      markPick(c, p.pick, i, picking);
      wrap.appendChild(c);
    });
    return wrap;
  };

  R.queue = function (p, picking) {
    var wrap = h('div', 'lc-queue');
    if (!p.v.length) wrap.appendChild(h('div', 'lc-empty', 'empty'));
    p.v.forEach(function (val, i) {
      var c = h('div', 'lc-cell' + clsOf(p.cls, i), fmt(val));
      markPick(c, p.pick, i, picking);
      wrap.appendChild(c);
    });
    return wrap;
  };

  R.vars = function (p) {
    var dl = h('dl', 'lc-vars');
    p.v.forEach(function (kv) {
      dl.appendChild(h('dt', '', kv[0]));
      dl.appendChild(h('dd', '', fmt(kv[1])));
    });
    return dl;
  };

  R.text = function (p) { return h('div', 'lc-setup', p.v); };

  R.grid = function (p, picking) {
    var table = h('table', 'lc-grid');
    if (p.ch) {
      var hr = h('tr');
      if (p.rh) hr.appendChild(h('th'));
      p.ch.forEach(function (c) { hr.appendChild(h('th', '', c)); });
      table.appendChild(hr);
    }
    p.v.forEach(function (row, r) {
      var tr = h('tr');
      if (p.rh) tr.appendChild(h('th', '', p.rh[r]));
      row.forEach(function (val, c) {
        var td = h('td');
        var key = r + ',' + c;
        var extra = '';
        if (p.cc && p.cc[r] && p.cc[r][c]) extra += ' is-' + p.cc[r][c];
        var cell = h('div', 'lc-cell' + extra + clsOf(p.cls, key), p.hide ? '' : fmt(val));
        markPick(cell, p.pick, key, picking);
        td.appendChild(cell);
        tr.appendChild(td);
      });
      table.appendChild(tr);
    });
    return table;
  };

  R.tree = function (p, picking) {
    var vals = p.v;
    var depth = 0;
    for (var i = 0; i < vals.length; i++) if (vals[i] !== null && vals[i] !== undefined) depth = Math.floor(Math.log2(i + 1));
    var W = 560, rowH = 58, H = (depth + 1) * rowH + 10;
    var svg = s('svg', { 'class': 'lc-svg', viewBox: '0 0 ' + W + ' ' + H, width: W, height: H });
    function pos(i) {
      var d = Math.floor(Math.log2(i + 1));
      var k = i - (Math.pow(2, d) - 1);
      return { x: (k + 0.5) * W / Math.pow(2, d), y: 24 + d * rowH };
    }
    vals.forEach(function (v, i) {
      if (v === null || v === undefined || i === 0) return;
      var parent = Math.floor((i - 1) / 2);
      if (vals[parent] === null || vals[parent] === undefined) return;
      var a = pos(parent), b = pos(i);
      svg.appendChild(s('line', { 'class': 'lc-edge' + clsOf(p.ecls, i), x1: a.x, y1: a.y, x2: b.x, y2: b.y }));
    });
    vals.forEach(function (v, i) {
      if (v === null || v === undefined) return;
      var c = pos(i);
      var g = s('g', { 'class': 'lc-node' + clsOf(p.cls, i) });
      g.appendChild(s('circle', { cx: c.x, cy: c.y, r: 17 }));
      g.appendChild(s('text', { x: c.x, y: c.y + 4, 'text-anchor': 'middle' }, fmt(v)));
      if (p.tag && p.tag[i]) g.appendChild(s('text', { 'class': 'lc-tag', x: c.x + 20, y: c.y - 12 }, p.tag[i]));
      markPick(g, p.pick, i, picking);
      svg.appendChild(g);
    });
    return svg;
  };

  R.graph = function (p, picking) {
    var W = p.w || 420, H = p.h || 240;
    var svg = s('svg', { 'class': 'lc-svg', viewBox: '0 0 ' + W + ' ' + H, width: W, height: H });
    var byId = {};
    p.n.forEach(function (n) { byId[n.id] = { x: 24 + n.x / 100 * (W - 48), y: 24 + n.y / 100 * (H - 48) }; });
    if (p.dir) {
      var defs = s('defs');
      var m = s('marker', { id: 'lc-arrow', viewBox: '0 0 10 10', refX: 9, refY: 5, markerWidth: 7, markerHeight: 7, orient: 'auto-start-reverse' });
      m.appendChild(s('path', { d: 'M0,0 L10,5 L0,10 z', fill: '#5a6570' }));
      defs.appendChild(m);
      svg.appendChild(defs);
    }
    (p.e || []).forEach(function (e) {
      var a = byId[e[0]], b = byId[e[1]];
      if (!a || !b) return;
      var dx = b.x - a.x, dy = b.y - a.y, len = Math.sqrt(dx * dx + dy * dy) || 1;
      var r = 18;
      var attrs = {
        'class': 'lc-edge' + clsOf(p.ecls, e[0] + '>' + e[1]),
        x1: a.x + dx / len * r, y1: a.y + dy / len * r, x2: b.x - dx / len * r, y2: b.y - dy / len * r
      };
      if (p.dir) attrs['marker-end'] = 'url(#lc-arrow)';
      svg.appendChild(s('line', attrs));
    });
    p.n.forEach(function (n) {
      var c = byId[n.id];
      var g = s('g', { 'class': 'lc-gnode' + clsOf(p.cls, n.id) });
      g.appendChild(s('circle', { cx: c.x, cy: c.y, r: 17 }));
      g.appendChild(s('text', { x: c.x, y: c.y + 4, 'text-anchor': 'middle' }, n.l !== undefined ? n.l : n.id));
      if (p.tag && p.tag[n.id] !== undefined && p.tag[n.id] !== '') g.appendChild(s('text', { 'class': 'lc-tag', x: c.x + 19, y: c.y - 13 }, p.tag[n.id]));
      markPick(g, p.pick, n.id, picking);
      svg.appendChild(g);
    });
    return svg;
  };

  R.ival = function (p, picking) {
    var lo = p.lo, hi = p.hi;
    if (lo === undefined || hi === undefined) {
      lo = Infinity; hi = -Infinity;
      p.v.forEach(function (iv) { lo = Math.min(lo, iv[0]); hi = Math.max(hi, iv[1]); });
      if (!p.v.length) { lo = 0; hi = 10; }
    }
    if (hi === lo) hi = lo + 1;
    var W = 460, rowH = 22, padL = 70, padR = 12;
    var H = p.v.length * rowH + 30;
    var svg = s('svg', { 'class': 'lc-svg', viewBox: '0 0 ' + W + ' ' + H, width: W, height: H });
    function X(v) { return padL + (v - lo) / (hi - lo) * (W - padL - padR); }
    p.v.forEach(function (iv, i) {
      var y = 4 + i * rowH;
      var g = s('g', { 'class': 'lc-ival' + clsOf(p.cls, i) });
      var w = Math.max(3, X(iv[1]) - X(iv[0]));
      g.appendChild(s('rect', { x: X(iv[0]), y: y, width: w, height: rowH - 7, rx: 2 }));
      g.appendChild(s('text', { x: 4, y: y + 12, 'class': 'lc-axis-t' }, (p.names ? p.names[i] + ' ' : '') + '[' + iv[0] + ',' + iv[1] + ']'));
      markPick(g, p.pick, i, picking);
      svg.appendChild(g);
    });
    var ay = p.v.length * rowH + 8;
    svg.appendChild(s('line', { 'class': 'lc-axis', x1: X(lo), y1: ay, x2: X(hi), y2: ay }));
    var step = Math.max(1, Math.ceil((hi - lo) / 10));
    for (var t = lo; t <= hi; t += step) {
      svg.appendChild(s('line', { 'class': 'lc-axis', x1: X(t), y1: ay, x2: X(t), y2: ay + 4 }));
      svg.appendChild(s('text', { 'class': 'lc-axis-t', x: X(t), y: ay + 15, 'text-anchor': 'middle' }, t));
    }
    if (p.mark !== undefined && p.mark !== null) {
      svg.appendChild(s('line', { x1: X(p.mark), y1: 0, x2: X(p.mark), y2: ay, stroke: '#9a3412', 'stroke-dasharray': '4 3', 'stroke-width': 1.5 }));
    }
    return svg;
  };

  R.list = function (p, picking) {
    var wrap = h('div', 'lc-list');
    var ptrAt = {};
    if (p.ptr) Object.keys(p.ptr).forEach(function (name) {
      var i = p.ptr[name];
      if (i === null || i === undefined) return;
      var key = i < 0 ? 'null' : i;
      (ptrAt[key] = ptrAt[key] || []).push(name);
    });
    var nx = p.nx || p.v.map(function (_, i) { return i + 1 < p.v.length ? i + 1 : -1; });
    if (ptrAt['null'] && p.nullLeft) {
      var n0 = h('div', 'lc-lnode');
      n0.appendChild(h('div', 'lc-cell is-dim', '∅'));
      n0.appendChild(h('div', 'lc-ptr', ptrAt['null'].join(',')));
      wrap.appendChild(n0);
      wrap.appendChild(h('div', 'lc-link', ''));
    }
    p.v.forEach(function (val, i) {
      var node = h('div', 'lc-lnode');
      var cell = h('div', 'lc-cell' + clsOf(p.cls, i), fmt(val));
      markPick(cell, p.pick, i, picking);
      node.appendChild(cell);
      var nxt = nx[i];
      var label = nxt === -1 || nxt === null || nxt === undefined ? '→ ∅' : '→ ' + fmt(p.v[nxt]) + (p.showIdx ? ' (#' + nxt + ')' : '');
      node.appendChild(h('div', 'lc-lnext', label));
      node.appendChild(h('div', 'lc-ptr', ptrAt[i] ? ptrAt[i].join(',') : ''));
      wrap.appendChild(node);
      if (i < p.v.length - 1) {
        var f = nx[i] === i + 1, b = nx[i + 1] === i;
        wrap.appendChild(h('div', 'lc-link' + (f || b ? ' is-hit' : ''), f && b ? '⇄' : f ? '→' : b ? '←' : '·'));
      }
    });
    if (ptrAt['null'] && !p.nullLeft) {
      wrap.appendChild(h('div', 'lc-link', ''));
      var n1 = h('div', 'lc-lnode');
      n1.appendChild(h('div', 'lc-cell is-dim', '∅'));
      n1.appendChild(h('div', 'lc-lnext', ''));
      n1.appendChild(h('div', 'lc-ptr', ptrAt['null'].join(',')));
      wrap.appendChild(n1);
    }
    return wrap;
  };

  function renderView(view, picking) {
    var board = h('div', 'lc-board');
    (view && view.panels ? view.panels : []).forEach(function (p) {
      if (!p) return;
      var fn = R[p.t];
      if (!fn) return;
      var panel = h('div', 'lc-panel' + (p.wide ? ' lc-panel--wide' : ''));
      if (p.label) panel.appendChild(h('p', 'lc-plabel', p.label));
      panel.appendChild(fn(p, picking));
      board.appendChild(panel);
    });
    return board;
  }

  /* ---------- game controller ---------- */
  LC.mount = function (root, slug) {
    var def = LC.problems[slug];
    root.innerHTML = '';
    if (!def) { root.appendChild(h('p', 'lc-msg bad', 'Game definition not found: ' + slug)); return; }

    var ROUNDS = def.rounds || 3;
    var LIVES = def.lives || 3;
    var st = { round: 0, seed: 0, trace: null, step: 0, lives: LIVES, failed: false, first: 0, moves: 0, streak: 0, best: 0, msg: '', msgCls: '', over: false };

    var head = h('div', 'lc-head');
    head.appendChild(h('h1', '', def.title));
    var rule = h('p', 'lc-rule');
    rule.appendChild(h('strong', '', 'Rule: '));
    rule.appendChild(document.createTextNode(def.rule));
    if (def.how) { rule.appendChild(document.createElement('br')); rule.appendChild(document.createTextNode(def.how)); }
    head.appendChild(rule);
    root.appendChild(head);

    var stats = h('div', 'lc-stats');
    var setup = h('div', 'lc-setup');
    var boardWrap = h('div');
    var ask = h('p', 'lc-ask');
    var controls = h('div');
    var msg = h('p', 'lc-msg');
    msg.setAttribute('aria-live', 'polite');
    var foot = h('div', 'lc-foot');
    [stats, setup, boardWrap, ask, controls, msg, foot].forEach(function (el) { root.appendChild(el); });

    function setMsg(text, cls) { st.msg = text; st.msgCls = cls || ''; msg.textContent = text; msg.className = 'lc-msg' + (cls ? ' ' + cls : ''); }

    function renderStats() {
      stats.innerHTML = '';
      var r = h('span'); r.appendChild(document.createTextNode('round ')); r.appendChild(h('strong', '', Math.min(st.round + 1, ROUNDS) + ' / ' + ROUNDS)); stats.appendChild(r);
      var total = st.trace ? st.trace.steps.length : 0;
      var m = h('span'); m.appendChild(document.createTextNode('move ')); m.appendChild(h('strong', '', Math.min(st.step + 1, total) + ' / ' + total)); stats.appendChild(m);
      var lives = h('span', 'lc-lives');
      for (var i = 0; i < LIVES; i++) lives.appendChild(h('span', i < st.lives ? '' : 'lost', '♥'));
      stats.appendChild(lives);
      var acc = h('span'); acc.appendChild(document.createTextNode('first-try ')); acc.appendChild(h('strong', '', st.first + ' / ' + st.moves)); stats.appendChild(acc);
      var sk = h('span'); sk.appendChild(document.createTextNode('streak ')); sk.appendChild(h('strong', '', st.streak)); stats.appendChild(sk);
    }

    function newRound(sameInput) {
      if (!sameInput) st.seed = (Math.random() * 4294967295) >>> 0;
      st.trace = LC.build(def, st.seed, st.round);
      st.step = 0; st.lives = LIVES; st.failed = false; st.over = false;
      setMsg(st.round === 0 && !sameInput ? 'Make the algorithm\'s next move.' : sameInput ? 'Same input. Try again.' : 'New input. Same rule.');
      render();
    }

    function footButtons(list) {
      foot.innerHTML = '';
      list.forEach(function (b) {
        var btn = h('button', 'lc-btn' + (b.primary ? ' lc-btn--primary' : ''), b.label);
        btn.type = 'button';
        btn.addEventListener('click', b.fn);
        foot.appendChild(btn);
      });
    }

    function correct(note) {
      st.moves += 1;
      if (!st.failed) { st.first += 1; st.streak += 1; st.best = Math.max(st.best, st.streak); }
      st.failed = false;
      st.step += 1;
      setMsg(note ? '✓ ' + note : '✓ Correct.', 'ok');
      render();
    }

    function wrong(why) {
      st.failed = true;
      st.streak = 0;
      st.lives -= 1;
      boardWrap.classList.remove('lc-shake'); void boardWrap.offsetWidth; boardWrap.classList.add('lc-shake');
      if (st.lives <= 0) {
        st.over = true;
        setMsg('✗ ' + (why || 'Wrong move.') + ' Out of lives. Rule: ' + def.rule, 'bad');
        render();
        return;
      }
      setMsg('✗ ' + (why || 'Wrong move.'), 'bad');
      renderStats();
    }

    function render() {
      renderStats();
      var t = st.trace;
      setup.textContent = t.setup || '';
      setup.hidden = !t.setup;
      controls.innerHTML = '';
      boardWrap.innerHTML = '';

      if (st.step >= t.steps.length) {
        var fin = t.final || { view: t.steps.length ? t.steps[t.steps.length - 1].view : null, msg: 'Done.' };
        boardWrap.appendChild(renderView(fin.view, false));
        ask.textContent = '';
        var last = st.round + 1 >= ROUNDS;
        setMsg(fin.msg + (last ? '  All ' + ROUNDS + ' rounds cleared: ' + st.first + ' / ' + st.moves + ' moves right on the first try, best streak ' + st.best + '.' : ''), 'win');
        footButtons(last ? [
          { label: 'Play again', primary: true, fn: function () { st.round = 0; st.first = 0; st.moves = 0; st.streak = 0; st.best = 0; newRound(false); } }
        ] : [
          { label: 'Next round', primary: true, fn: function () { st.round += 1; newRound(false); } },
          { label: 'Replay this input', fn: function () { newRound(true); } }
        ]);
        return;
      }

      var step = t.steps[st.step];
      var picking = step.kind === 'pick' && !st.over;
      var board = renderView(step.view, picking);
      boardWrap.appendChild(board);
      ask.textContent = step.ask;

      if (st.over) {
        footButtons([
          { label: 'Retry this input', primary: true, fn: function () { newRound(true); } },
          { label: 'New input', fn: function () { newRound(false); } }
        ]);
        return;
      }
      footButtons([
        { label: 'Restart round', fn: function () { newRound(true); } },
        { label: 'New input', fn: function () { newRound(false); } }
      ]);

      if (step.kind === 'choose') {
        var box = h('div', 'lc-choices');
        step.choices.forEach(function (c, i) {
          var b = h('button', 'lc-btn');
          b.type = 'button';
          if (step.choices.length > 1 && i < 9) b.appendChild(h('kbd', '', i + 1));
          b.appendChild(document.createTextNode(c.label));
          b.addEventListener('click', function () {
            if (c.ok) correct(c.why || step.note);
            else { b.disabled = true; wrong(c.why); }
          });
          box.appendChild(b);
        });
        controls.appendChild(box);
      } else if (step.kind === 'num') {
        var row = h('div', 'lc-num');
        var input = h('input');
        input.type = 'text';
        input.inputMode = 'numeric';
        input.setAttribute('aria-label', 'Your answer');
        input.autocomplete = 'off';
        var go = h('button', 'lc-btn lc-btn--primary', 'Check');
        go.type = 'button';
        function check() {
          var raw = input.value.trim().replace('−', '-');
          if (raw === '') return;
          var fr = raw.match(/^(-?\d+)\s*\/\s*(\d+)$/);
          var v = /^(inf|∞|infinity)$/i.test(raw) ? Infinity : fr ? Number(fr[1]) / Number(fr[2]) : Number(raw);
          var frac = isFinite(step.answer) && !Number.isInteger(step.answer);
          if (v === step.answer || (isNaN(step.answer) && isNaN(v)) || (frac && Math.abs(v - step.answer) <= 0.005 + 1e-9)) correct(step.note);
          else { wrong(step.wrong); input.select(); }
        }
        go.addEventListener('click', check);
        input.addEventListener('keydown', function (e) { if (e.key === 'Enter') check(); });
        row.appendChild(input);
        row.appendChild(go);
        controls.appendChild(row);
        setTimeout(function () { try { input.focus({ preventScroll: true }); } catch (e) { /* ignore */ } }, 0);
      } else if (step.kind === 'pick') {
        controls.appendChild(h('p', 'lc-pickhint', step.hint));
        if (step.extra) {
          var ebox = h('div', 'lc-choices');
          step.extra.forEach(function (c) {
            var b = h('button', 'lc-btn', c.label);
            b.type = 'button';
            b.addEventListener('click', function () {
              if (c.ok) correct(c.why || step.note);
              else { b.disabled = true; wrong(c.why); }
            });
            ebox.appendChild(b);
          });
          controls.appendChild(ebox);
        }
        var picked = {}, pickedCount = 0;
        var progress = h('p', 'lc-pickhint');
        if (step.all) { progress.textContent = '0 / ' + step.answers.length + ' found'; controls.appendChild(progress); }
        function reachable(id) {
          if (!step.links) return true;
          var from = step.seeds.concat(Object.keys(picked));
          for (var i = 0; i < from.length; i++) if (step.links[from[i]] && step.links[from[i]].indexOf(id) !== -1) return true;
          return false;
        }
        board.addEventListener('click', function (e) {
          if (st.over) return;
          var el = e.target;
          while (el && el !== board && !(el.getAttribute && el.getAttribute('data-pick'))) el = el.parentNode;
          if (!el || el === board || !el.getAttribute) return;
          var id = el.getAttribute('data-pick');
          if (!step.all) {
            if (step.answers.indexOf(id) !== -1) correct(step.note);
            else wrong(step.wrongMap && step.wrongMap[id] ? step.wrongMap[id] : step.wrong);
            return;
          }
          if (picked[id]) return;
          if (step.answers.indexOf(id) === -1) { wrong(step.wrongMap && step.wrongMap[id] ? step.wrongMap[id] : step.wrong); return; }
          if (!reachable(id)) { wrong(step.wrongChain); return; }
          picked[id] = 1; pickedCount += 1;
          el.classList.add('is-ok');
          el.classList.remove('pickable');
          progress.textContent = pickedCount + ' / ' + step.answers.length + ' found';
          if (pickedCount === step.answers.length) correct(step.note);
        });
      }
    }

    document.addEventListener('keydown', function (e) {
      if (e.target && e.target.tagName === 'INPUT') return;
      var n = parseInt(e.key, 10);
      if (!n) return;
      var btns = controls.querySelectorAll('.lc-choices .lc-btn');
      if (btns[n - 1] && !btns[n - 1].disabled) btns[n - 1].click();
    });

    newRound(false);
  };

  /* ---------- shared helpers for pattern files ---------- */
  LC.P = {
    arr: function (v, o) { var p = { t: 'arr', v: v.slice() }; for (var k in o) p[k] = o[k]; return p; },
    stack: function (v, label, o) { var p = { t: 'stack', v: v.slice(), label: label || 'stack' }; for (var k in o) p[k] = o[k]; return p; },
    queue: function (v, label, o) { var p = { t: 'queue', v: v.slice(), label: label || 'queue' }; for (var k in o) p[k] = o[k]; return p; },
    vars: function (pairs, label) { return { t: 'vars', v: pairs, label: label || '' }; },
    grid: function (v, o) { var p = { t: 'grid', v: v.map(function (r) { return r.slice(); }) }; for (var k in o) p[k] = o[k]; return p; },
    text: function (v, label) { return { t: 'text', v: v, label: label || '' }; }
  };
  LC.view = function () { return { panels: Array.prototype.slice.call(arguments) }; };
})();
