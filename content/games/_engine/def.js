/*
 * Compact game definitions on top of engine.js (loaded after it).
 *
 *   LCGame.def('maximum-subarray', {
 *     t: 'Title: the insight',            // game title
 *     r: 'Rule the player drills.',        // shown above the board
 *     g: function (R, round) { return { nums: R.ints(8, -5, 5) }; },   // random input, LeetCode parameter names
 *     s: function (I, T) { ...; return answer; }                        // the real solution, asking questions via T
 *   });
 *
 * s() runs on a random input during play, and on the statement's examples in the
 * oracle test, so its return value must be the LeetCode answer. Trees and linked
 * lists arrive in LeetCode's array form; build them with Tr.from / Ls.from.
 *
 * T (a tracker) records steps:
 *   T.at({nums: A(arr, {i: 2}), sum: 5})  set the board (objects become panels automatically)
 *   T.n(ask, number, why)                  type a number
 *   T.c(ask, options, correct, why)        choose one option (correct is the option value)
 *   T.yn(ask, bool, why)                   yes or no
 *   T.k(ask, [[key, label]...], key, why)  act (as Trace.act)
 *   T.p(ask, answers, opts)                click the board (as Trace.pick)
 *   T.say(text)                            a note shown with the next question
 * A round asks at most `cap` questions (default 14); the algorithm still runs to the end.
 */
(function () {
  'use strict';
  var LC = window.LCGame, P = LC.P, fmt = LC.fmt, clone = LC.clone;
  var H = LC.H = {};

  /* ---------- panels ---------- */
  function lab(p, l) { if (l !== undefined && p.label === undefined) p.label = l; return p; }
  H.A = function (v, o) { // array; o: {i, j, ...pointer names} or {ptr, cls, win, label, bars, hl}
    o = o || {}; var p = { t: 'arr', v: (v || []).slice() }, ptr = {};
    Object.keys(o).forEach(function (k) {
      if (['cls', 'win', 'label', 'bars', 'labels', 'idx', 'pick', 'water', 'hl', 'ok', 'dim', 'bad'].indexOf(k) >= 0) return;
      if (typeof o[k] === 'number') ptr[k] = o[k];
    });
    if (Object.keys(ptr).length) p.ptr = ptr;
    var cls = o.cls ? clone(o.cls) : {};
    ['hl', 'ok', 'dim', 'bad'].forEach(function (c) {
      var x = o[c]; if (x === undefined || x === null) return;
      [].concat(x).forEach(function (i) { cls[i] = c === 'hl' ? 'hit' : c; });
    });
    p.cls = cls;
    ['win', 'label', 'bars', 'labels', 'idx', 'pick', 'water'].forEach(function (k) { if (o[k] !== undefined) p[k] = o[k]; });
    return p;
  };
  H.G = function (v, o) { o = o || {}; var p = P.grid(v, {}); ['cls', 'cc', 'rh', 'ch', 'hide', 'pick', 'label'].forEach(function (k) { if (o[k] !== undefined) p[k] = o[k]; }); if (o.hl) { p.cls = p.cls || {}; [].concat(o.hl).forEach(function (rc) { p.cls[rc[0] + ',' + rc[1]] = 'hit'; }); } if (o.ok) { p.cls = p.cls || {}; o.ok.forEach(function (rc) { p.cls[rc[0] + ',' + rc[1]] = 'ok'; }); } return p; };
  H.K = function (o, l) { var pairs = Array.isArray(o) ? o : Object.keys(o).map(function (k) { return [k, show(o[k])]; }); return { t: 'vars', v: pairs.length ? pairs : [['(empty)', '']], label: l || '' }; };
  H.S = function (v, l, o) { return P.stack((v || []).map(show), l || 'stack', o); };
  H.Q = function (v, l, o) { var p = { t: 'queue', v: (v || []).map(show), label: l || 'queue' }; for (var k in o) p[k] = o[k]; return p; };
  H.X = function (v, l) { return P.text(String(v), l || ''); };
  H.IV = function (v, o) { o = o || {}; var p = { t: 'ival', v: clone(v) }; for (var k in o) p[k] = o[k]; if (o.hl !== undefined) { p.cls = p.cls || {}; [].concat(o.hl).forEach(function (i) { p.cls[i] = 'hit'; }); } return p; };
  function show(x) {
    if (x instanceof Map) return '{' + Array.from(x.entries()).map(function (e) { return fmt(e[0]) + ':' + show(e[1]); }).join(', ') + '}';
    if (x instanceof Set) return '{' + Array.from(x).map(fmt).join(', ') + '}';
    if (Array.isArray(x)) return '[' + x.map(show).join(',') + ']';
    if (x && typeof x === 'object') return '{' + Object.keys(x).map(function (k) { return k + ':' + show(x[k]); }).join(', ') + '}';
    if (typeof x === 'boolean') return x ? 'true' : 'false';
    return fmt(x);
  }
  H.show = show;

  /* ---------- trees (LeetCode level-order arrays) ---------- */
  var Tr = H.Tr = {
    from: function (a) {
      if (!a || !a.length || a[0] === null) return null;
      var root = { val: a[0], left: null, right: null }, q = [root], i = 1;
      while (q.length && i < a.length) {
        var n = q.shift();
        if (i < a.length && a[i] !== null) { n.left = { val: a[i], left: null, right: null }; q.push(n.left); } i++;
        if (i < a.length && a[i] !== null) { n.right = { val: a[i], left: null, right: null }; q.push(n.right); } i++;
      }
      return root;
    },
    arr: function (root) {
      var out = [], q = [root];
      while (q.length) { var n = q.shift(); if (n) { out.push(n.val); q.push(n.left, n.right); } else out.push(null); }
      while (out.length && out[out.length - 1] === null) out.pop();
      return out;
    },
    find: function (root, v) { var st = [root]; while (st.length) { var n = st.pop(); if (!n) continue; if (n.val === v) return n; st.push(n.left, n.right); } return null; },
    size: function (r) { return r ? 1 + Tr.size(r.left) + Tr.size(r.right) : 0; },
    depth: function (r) { return r ? 1 + Math.max(Tr.depth(r.left), Tr.depth(r.right)) : 0; },
    nodes: function (r) { var out = [], q = [r]; while (q.length) { var n = q.shift(); if (n) { out.push(n); q.push(n.left, n.right); } } return out; }
  };
  // Tree panel. marks: {hit: node|[nodes], ok: [...], dim: [...], bad: [...]} ; tag: Map(node -> text)
  H.TR = function (root, marks, o) {
    o = o || {};
    var v = [], cls = {}, tag = {}, idx = new Map();
    (function walk(n, i) { if (!n || i > 62) return; v[i] = n.val; idx.set(n, i); walk(n.left, 2 * i + 1); walk(n.right, 2 * i + 2); })(root, 0);
    for (var k = 0; k < v.length; k++) if (v[k] === undefined) v[k] = null;
    if (marks) Object.keys(marks).forEach(function (c) { [].concat(marks[c] || []).forEach(function (n) { if (n && idx.has(n)) cls[idx.get(n)] = c; }); });
    if (o.tag) o.tag.forEach(function (t, n) { if (idx.has(n)) tag[idx.get(n)] = t; });
    var p = { t: 'tree', v: v, cls: cls, tag: tag, label: o.label || 'tree' };
    if (o.pick) { p.pick = 't'; p._idx = idx; }
    return p;
  };
  H.tid = function (panel, node) { return 't:' + panel._idx.get(node); };

  /* ---------- linked lists ---------- */
  var Ls = H.Ls = {
    from: function (a, pos) { var head = null, tail = null, nodes = []; (a || []).forEach(function (x) { var n = { val: x, next: null }; nodes.push(n); if (tail) tail.next = n; else head = n; tail = n; }); if (pos !== undefined && pos >= 0 && nodes[pos]) tail.next = nodes[pos]; return head; },
    arr: function (h) { var out = [], seen = new Set(); while (h && !seen.has(h)) { seen.add(h); out.push(h.val); h = h.next; } return out; }
  };
  // List panel from a head (follows next, stops at a repeat). ptr: {name: node|null}
  H.LL = function (head, ptr, o) {
    o = o || {};
    var nodes = [], seen = new Map(), h = head;
    while (h && !seen.has(h) && nodes.length < 20) { seen.set(h, nodes.length); nodes.push(h); h = h.next; }
    (o.extra || []).forEach(function (n) { if (n && !seen.has(n)) { seen.set(n, nodes.length); nodes.push(n); } });
    var p = { t: 'list', v: nodes.map(function (n) { return n.val; }), nx: nodes.map(function (n) { return n.next && seen.has(n.next) ? seen.get(n.next) : -1; }), ptr: {}, cls: {}, label: o.label || 'list', showIdx: !!o.showIdx };
    Object.keys(ptr || {}).forEach(function (k) { var n = ptr[k]; p.ptr[k] = n === null ? -1 : seen.has(n) ? seen.get(n) : undefined; });
    if (o.hl) [].concat(o.hl).forEach(function (n) { if (seen.has(n)) p.cls[seen.get(n)] = 'hit'; });
    if (o.ok) [].concat(o.ok).forEach(function (n) { if (seen.has(n)) p.cls[seen.get(n)] = 'ok'; });
    if (Object.keys(p.ptr).some(function (k) { return p.ptr[k] === -1; })) p.nullLeft = !!o.nullLeft;
    return p;
  };

  /* ---------- graphs ---------- */
  // GR(n or ids[], edges [[a,b]...], {dir, cls:{id:c}, tag:{id:t}, ecls:{'a>b':c}, label, w, h})
  H.GR = function (n, edges, o) {
    o = o || {};
    var ids = Array.isArray(n) ? n.map(String) : Array.from({ length: n }, function (_, i) { return String(i + (o.base || 0)); });
    var N = ids.length;
    var nodes = ids.map(function (id, i) { var a = -Math.PI / 2 + 2 * Math.PI * i / N; return { id: id, x: 50 + 45 * Math.cos(a), y: 50 + 45 * Math.sin(a) }; });
    var p = { t: 'graph', n: nodes, e: (edges || []).map(function (e) { return [String(e[0]), String(e[1])]; }), dir: !!o.dir, cls: o.cls || {}, tag: o.tag || {}, ecls: o.ecls || {}, label: o.label || 'graph' };
    if (o.w) p.w = o.w; if (o.h) p.h = o.h;
    if (o.pick) p.pick = 'n';
    return p;
  };

  /* ---------- auto panels from a state object ---------- */
  function auto(obj) {
    var panels = [], scal = [];
    Object.keys(obj).forEach(function (k) {
      var v = obj[k];
      if (v && v.t && typeof v.t === 'string' && (v.v !== undefined || v.n !== undefined)) { panels.push(lab(v, k)); return; }
      if (v instanceof Map || v instanceof Set) { panels.push(v instanceof Set ? H.A(Array.from(v), { label: k + ' (set)' }) : H.K(Array.from(v.entries()).map(function (e) { return [fmt(e[0]), show(e[1])]; }), k)); return; }
      if (Array.isArray(v)) {
        if (v.length && Array.isArray(v[0]) && v.length <= 12 && v[0].length <= 14 && v.every(function (r) { return Array.isArray(r) && r.every(function (x) { return x === null || typeof x !== 'object'; }); })) panels.push(H.G(v, { label: k }));
        else if (v.every(function (x) { return x === null || typeof x !== 'object'; }) && v.length <= 24) panels.push(H.A(v, { label: k }));
        else scal.push([k, show(v)]);
        return;
      }
      if (v && typeof v === 'object') { panels.push(H.K(v, k)); return; }
      scal.push([k, v === undefined ? '' : v]);
    });
    if (scal.length) panels.push({ t: 'vars', v: scal.map(function (kv) { return [kv[0], typeof kv[1] === 'string' ? kv[1] : show(kv[1])]; }), label: '' });
    return panels;
  }
  H.auto = auto;

  /* ---------- tracker ---------- */
  function Tk(cap) { this.t = new LC.Trace(); this.panels = []; this.pending = ''; this.asks = 0; this.cap = cap || 14; }
  Tk.prototype.view = function () { return LC.view.apply(null, this.panels.length ? this.panels : [P.text(this.t.setup || ' ', '')]); };
  Tk.prototype.at = function (obj) { this.panels = auto(obj); return this; };
  Tk.prototype.v = function () { this.panels = Array.prototype.slice.call(arguments).filter(Boolean); return this; };
  Tk.prototype.say = function (s) { if (this.asks < this.cap) this.pending += s + ' '; return this; };
  Tk.prototype.room = function () { return this.asks < this.cap; };
  Tk.prototype._go = function () { if (this.asks >= this.cap) return false; this.asks++; return true; };
  Tk.prototype._ask = function (a) { var s = this.pending + a; this.pending = ''; return s; };
  Tk.prototype.n = function (ask, ans, why, note) {
    if (typeof ans !== 'number' || isNaN(ans) || !this._go()) return this;
    var frac = isFinite(ans) && !Number.isInteger(ans), shown = frac ? String(Math.round(ans * 10000) / 10000) : fmt(ans);
    this.t.num(this.view(), this._ask(ask) + (frac ? ' (2 decimals or a fraction like 3/8)' : ''), ans, { wrong: why || 'Recompute this step from the board.', note: note || ('= ' + shown + '.') });
    return this;
  };
  function same(a, b) { return JSON.stringify(a) === JSON.stringify(b); }
  Tk.prototype.c = function (ask, opts, correct, why, note) {
    var seen = {}, list = [];
    opts.forEach(function (o) { var k = JSON.stringify(o); if (!seen[k]) { seen[k] = 1; list.push(o); } });
    if (!list.some(function (o) { return same(o, correct); })) list.push(correct);
    if (list.length < 2 || !this._go()) return this;
    var ch = list.map(function (o) {
      var ok = same(o, correct), w = '';
      if (!ok) w = typeof why === 'function' ? why(o) : (why && typeof why === 'object' && !Array.isArray(why)) ? (why[String(o)] || why._ || '') : (why || '');
      if (!ok && !w) w = 'Not this one. The algorithm takes "' + show(correct) + '" here.';
      return { label: typeof o === 'string' ? o : show(o), ok: ok, why: w };
    });
    this.t.choose(this.view(), this._ask(ask), ch, note || ('Yes: ' + (typeof correct === 'string' ? correct : show(correct)) + '.'));
    return this;
  };
  Tk.prototype.yn = function (ask, yes, why, note) { return this.c(ask, ['Yes', 'No'], yes ? 'Yes' : 'No', why, note); };
  Tk.prototype.k = function (ask, acts, key, why, note) { if (!this._go()) return this; this.t.act(this.view(), this._ask(ask), acts, key, why || 'Not the move the algorithm makes here.', note); return this; };
  Tk.prototype.p = function (ask, ans, o) { if (!this._go()) return this; this.t.pick(this.view(), this._ask(ask), ans, o); return this; };
  H.Tk = Tk;

  /* ---------- random helpers ---------- */
  function R(rng) {
    var r = Object.create(rng);
    r.str = function (n, al) { al = al || 'abc'; var s = ''; for (var i = 0; i < n; i++) s += al[rng.int(0, al.length - 1)]; return s; };
    r.grid = function (m, n, a, b) { var g = []; for (var i = 0; i < m; i++) g.push(rng.ints(n, a, b)); return g; };
    r.cgrid = function (m, n, chars) { var g = []; for (var i = 0; i < m; i++) { var row = []; for (var j = 0; j < n; j++) row.push(chars[rng.int(0, chars.length - 1)]); g.push(row); } return g; };
    r.perm = function (n, base) { return rng.shuffle(Array.from({ length: n }, function (_, i) { return i + (base || 0); })); };
    r.bst = function (n, lo, hi) { // level-order array of a BST with n distinct values
      var vals = rng.distinct(n, lo || 1, hi || 20), root = null;
      vals.forEach(function (v) { if (!root) { root = { val: v, left: null, right: null }; return; } var c = root; while (true) { var d = v < c.val ? 'left' : 'right'; if (!c[d]) { c[d] = { val: v, left: null, right: null }; break; } c = c[d]; } });
      return Tr.depth(root) > 4 ? r.bst(n, lo, hi) : Tr.arr(root);
    };
    r.tree = function (n, lo, hi, maxDepth) { // random binary tree, level-order array
      maxDepth = maxDepth || 4;
      var root = { val: rng.int(lo === undefined ? 1 : lo, hi === undefined ? 9 : hi), left: null, right: null }, nodes = [{ n: root, d: 1 }], count = 1, guard = 0;
      while (count < n && guard++ < 500) {
        var x = rng.pick(nodes); if (x.d >= maxDepth) continue;
        var side = rng.chance(0.5) ? 'left' : 'right'; if (x.n[side]) continue;
        x.n[side] = { val: rng.int(lo === undefined ? 1 : lo, hi === undefined ? 9 : hi), left: null, right: null }; nodes.push({ n: x.n[side], d: x.d + 1 }); count++;
      }
      return Tr.arr(root);
    };
    r.edges = function (n, m, o) { // undirected (or o.dir) simple edges among 0..n-1; o.conn makes it connected; o.w adds weights
      o = o || {}; var e = [], seen = {};
      function add(a, b) { var k = o.dir ? a + '>' + b : Math.min(a, b) + '-' + Math.max(a, b); if (a === b || seen[k]) return false; seen[k] = 1; var x = [a, b]; if (o.w) x.push(rng.int(o.w[0], o.w[1])); e.push(x); return true; }
      if (o.conn) { var p = r.perm(n); for (var i = 1; i < n; i++) add(p[rng.int(0, i - 1)], p[i]); }
      var guard = 0; while (e.length < m && guard++ < 400) add(rng.int(0, n - 1), rng.int(0, n - 1));
      return e.map(function (x) { return o.base ? [x[0] + o.base, x[1] + o.base].concat(x.slice(2)) : x; });
    };
    return r;
  }
  H.R = R;

  /* ---------- definition ---------- */
  function fmtVal(v) { return typeof v === 'string' ? JSON.stringify(v) : JSON.stringify(v); }
  function setupOf(I) {
    if (I.ops && I.args) return I.ops.map(function (o, i) { return o + '(' + (I.args[i] || []).map(fmtVal).join(', ') + ')'; }).join('  ');
    return Object.keys(I).filter(function (k) { return k[0] !== '_'; }).map(function (k) { return k + ' = ' + fmtVal(I[k]); }).join('   ');
  }
  H.setupOf = setupOf;
  LC.def = function (slug, spec) {
    LC.register(slug, {
      title: spec.t, rule: spec.r, how: spec.how, rounds: spec.rounds || 3, minSteps: spec.min || 3, maxSteps: spec.max, spec: spec,
      make: function (rng, round) {
        var I = spec.g(R(rng), round), T = new Tk(spec.cap);
        T.t.setup = spec.setup ? spec.setup(I) : setupOf(I);
        var out = spec.s(clone(I), T);
        T.t.done(T.view(), T.pending + 'Answer: ' + (spec.out ? spec.out(out) : typeof out === 'string' ? JSON.stringify(out) : show(out)) + (spec.end ? ' ' + spec.end : ''));
        return T.t;
      }
    });
  };
  H.D = LC.def;
})();
