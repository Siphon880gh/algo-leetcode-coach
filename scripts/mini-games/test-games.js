// Oracle test for the v2 mini-games (content/games/_engine/v2/*.js). Node only, no dependencies.
// For every definition: build rounds from random seeds and check each step is answerable
// (a correct choice exists, wrong choices explain why, numbers are numbers, panels are valid),
// then run its solution s() on the problem statement's own examples and compare with the expected output.
// usage: node scripts/mini-games/test-games.js [file-prefix] [--slug=x] [--seeds=N] [--quiet]
//   e.g. node scripts/mini-games/test-games.js grid-02 --seeds=80 --quiet
const fs = require('fs'), path = require('path'), vm = require('vm');
const { ROOT, examples } = require('./examples.js');
const eng = path.join(ROOT, 'content/games/_engine');
const args = process.argv.slice(2), only = args.find(a => !a.startsWith('--')), slugOnly = (args.find(a => a.startsWith('--slug=')) || '').slice(7);
const SEEDS = +((args.find(a => a.startsWith('--seeds=')) || '--seeds=40').slice(8)), quiet = args.includes('--quiet');

const ctx = { console, Math, JSON, Map, Set, Array, Object, Number, String, Boolean, Infinity, NaN, parseInt, parseFloat, isNaN, Symbol, BigInt, Date, RegExp, Error };
ctx.window = ctx; vm.createContext(ctx);
vm.runInContext(fs.readFileSync(path.join(eng, 'engine.js'), 'utf8'), ctx, { filename: 'engine.js' });
vm.runInContext(fs.readFileSync(path.join(eng, 'def.js'), 'utf8'), ctx, { filename: 'def.js' });
const fileOf = {};
for (const f of fs.readdirSync(path.join(eng, 'v2')).sort()) {
  if (!f.endsWith('.js') || (only && !f.startsWith(only))) continue;
  const before = new Set(Object.keys(ctx.LCGame.problems));
  try { vm.runInContext(fs.readFileSync(path.join(eng, 'v2', f), 'utf8'), ctx, { filename: f }); } catch (e) { console.log('LOAD FAIL', f, e.message); process.exitCode = 1; }
  for (const k of Object.keys(ctx.LCGame.problems)) if (!before.has(k)) fileOf[k] = f;
}
// LeetCode number of a definition = 'leetcode' in its game folder's meta.php (falls back to the guide's).
function lcOf(slug) {
  for (const p of ['content/games/' + slug + '-game/meta.php', 'content/guides/' + slug + '/meta.php']) {
    const f = path.join(ROOT, p);
    if (fs.existsSync(f)) { const m = fs.readFileSync(f, 'utf8').match(/'leetcode'\s*=>\s*'?(\d+)/); if (m) return +m[1]; }
  }
  return null;
}
const LC = ctx.LCGame;
// cmp modes: 'float' (1e-5 tolerance), 'set' (order of the outer list ignored),
// 'sets' (order ignored at both levels), or a function (out, expected, input) => bool.
function canon(x, mode) {
  if (mode === 'sets' && Array.isArray(x)) return x.map(y => Array.isArray(y) ? JSON.stringify(canon(y, 'set')) : JSON.stringify(y)).sort();
  if (mode === 'set' && Array.isArray(x)) return x.map(y => JSON.stringify(y)).sort();
  return x;
}
function eq(out, exp, mode, I) {
  if (typeof mode === 'function') return !!mode(out, exp, I);
  if (mode === 'float' || (typeof exp === 'number' && !Number.isInteger(exp))) return typeof out === 'number' && Math.abs(out - exp) <= 1e-5 * Math.max(1, Math.abs(exp));
  if (Array.isArray(exp) && exp.some(v => typeof v === 'number' && !Number.isInteger(v))) return Array.isArray(out) && out.length === exp.length && out.every((v, i) => v === null ? exp[i] === null : Math.abs(v - exp[i]) <= 1e-5 * Math.max(1, Math.abs(exp[i])));
  return JSON.stringify(canon(out, mode)) === JSON.stringify(canon(exp, mode));
}
let bad = 0, count = 0, exOk = 0, exNone = 0; const lines = [];
for (const [slug, def] of Object.entries(LC.problems)) {
  if (!def.spec || (slugOnly && slug !== slugOnly)) continue;
  count++; let err = null, minS = 1e9, maxS = 0;
  const spec = def.spec, n = lcOf(slug);
  if (!def.title || !def.rule) err = 'missing title/rule';
  if (!n) err = 'no LeetCode number (missing game folder and guide?)';
  for (let seed = 1; seed <= SEEDS && !err; seed++) for (let r = 0; r < (def.rounds || 3) && !err; r++) {
    let t; try { t = LC.build(def, seed * 7919 + r, r); } catch (e) { err = 'seed ' + seed + ' r' + r + ': ' + e.stack.split('\n').slice(0, 3).join(' | '); break; }
    if (!t.steps.length) { err = 'no steps (seed ' + seed + ' r' + r + ')'; break; }
    minS = Math.min(minS, t.steps.length); maxS = Math.max(maxS, t.steps.length);
    t.steps.forEach(s => {
      if (err) return;
      if (s.kind === 'choose') { if (!s.choices.some(c => c.ok)) err = 'no ok choice: ' + s.ask; else if (s.choices.some(c => !c.ok && !c.why)) err = 'wrong without why: ' + s.ask; }
      else if (s.kind === 'num') { if (typeof s.answer !== 'number' || isNaN(s.answer)) err = 'bad num ' + s.answer; }
      else if (s.kind === 'pick') { if (!s.answers.length && !(s.extra || []).some(c => c.ok)) err = 'pick without answers: ' + s.ask; }
      if (!err && s.view.panels.some(p => p && p.t === 'vars' && !(Array.isArray(p.v) && p.v.every(kv => Array.isArray(kv) && kv.length === 2)))) err = 'bad vars';
      if (!err && s.view.panels.some(p => p && p.t === 'tree' && p.v.length > 31)) err = 'tree too deep to draw';
    });
  }
  let exInfo = '';
  if (!err && spec.ex !== false) {
    const exs = examples(n);
    if (!exs.length) { exNone++; exInfo = ' (no examples)'; }
    let passed = 0;
    for (const ex of exs) {
      if (ex.input.__raw || (ex.output && ex.output.__raw)) continue; // unparseable example text
      let I = JSON.parse(JSON.stringify(ex.input)); if (spec.exIn) I = spec.exIn(I);
      let out; try { out = spec.s(I, new LC.H.Tk(spec.cap)); } catch (e) { err = 'example threw: ' + e.message + ' on ' + ex.rawIn; break; }
      out = JSON.parse(JSON.stringify(out === undefined ? null : out));
      if (!eq(out, ex.output, spec.cmp, ex.input)) { err = 'example mismatch: ' + ex.rawIn + ' => got ' + JSON.stringify(out) + ' expected ' + ex.rawOut; break; }
      passed++;
    }
    if (!err) { if (passed) exOk++; exInfo = ' ex ' + passed + '/' + exs.length; }
  } else if (spec.ex === false) exInfo = ' ex skipped';
  if (err) { bad++; console.log('FAIL', slug, '[' + fileOf[slug] + ']', err); }
  else if (!quiet) lines.push(slug + ' ' + minS + '-' + maxS + exInfo);
}
if (!quiet) console.log(lines.join('\n'));
console.log('problems', count, 'bad', bad, 'examples-verified', exOk, 'no-examples', exNone);
if (bad) process.exitCode = 1;
