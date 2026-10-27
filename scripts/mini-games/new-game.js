// Write content/games/{slug}-game/{meta.php,index.html} for a v2 definition D('{slug}', ...).
// The slug must be an Algo Guide slug (content/guides/{slug}/); the LeetCode number comes from
// the guide's meta.php and links the game to its guide and session. Guides without a LeetCode
// number (Extras) get a game filed under Data Structures or Algorithms by its module family;
// run .agents/skills/link-mini-games/scripts/link.php afterwards so the guide and session gain related_game.
// usage: node scripts/mini-games/new-game.js <slug> [more slugs...] [--force] [--dry-run]
const fs = require('fs'), path = require('path'), vm = require('vm');
const ROOT = path.resolve(__dirname, '..', '..'), eng = path.join(ROOT, 'content/games/_engine');
const args = process.argv.slice(2), slugs = args.filter(a => !a.startsWith('--')), force = args.includes('--force'), dry = args.includes('--dry-run');
if (!slugs.length) { console.log('usage: node scripts/mini-games/new-game.js <slug> [--force] [--dry-run]'); process.exit(2); }

const ctx = { console, Math, JSON, Map, Set, Array, Object, Number, String, Boolean, Infinity, NaN, parseInt, parseFloat, isNaN, Symbol, BigInt, Date, RegExp, Error };
ctx.window = ctx; vm.createContext(ctx);
vm.runInContext(fs.readFileSync(path.join(eng, 'engine.js'), 'utf8'), ctx);
vm.runInContext(fs.readFileSync(path.join(eng, 'def.js'), 'utf8'), ctx);
const fileOf = {};
for (const f of fs.readdirSync(path.join(eng, 'v2')).sort()) {
  if (!f.endsWith('.js')) continue;
  const before = new Set(Object.keys(ctx.LCGame.problems));
  vm.runInContext(fs.readFileSync(path.join(eng, 'v2', f), 'utf8'), ctx, { filename: f });
  for (const k of Object.keys(ctx.LCGame.problems)) if (!before.has(k)) fileOf[k] = f;
}
const diffFile = path.join(ROOT, 'context-leetcode-urls/data-difficulty.json');
const diff = fs.existsSync(diffFile) ? JSON.parse(fs.readFileSync(diffFile, 'utf8')) : {};
// Module family (file name without -NN.js) -> subcategory label on the Mini Games page.
const LABEL = { dp: 'Dynamic Programming', math: 'Math', greedy: 'Greedy', tree: 'Trees', strings: 'Strings', 'binary-search': 'Binary Search', graph: 'Graphs', design: 'Design', 'two-pointers': 'Two Pointers', grid: 'Graphs', 'sliding-window': 'Sliding Window', 'prefix-sum': 'Prefix Sum', hash: 'Hash Table', bits: 'Bit Manipulation', backtracking: 'Backtracking', heap: 'Heap', 'union-find': 'Union Find', sim: 'Simulation', array: 'Arrays', stack: 'Stack', 'linked-list': 'Linked List', trie: 'Trie', 'range-tree': 'Segment Tree', 'mono-stack': 'Monotonic Stack', sorting: 'Sorting', intervals: 'Intervals', queue: 'Queue', recursion: 'Recursion' };
// Families that teach a structure (rather than a technique) go under Data Structures for Extras.
const STRUCT = new Set(['array', 'linked-list', 'stack', 'queue', 'hash', 'heap', 'tree', 'graph', 'trie']);
const q = s => "'" + String(s).replace(/\\/g, '\\\\').replace(/'/g, "\\'") + "'";
const esc = s => String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
let fail = 0;
for (const slug of slugs) {
  const def = ctx.LCGame.problems[slug], guideMeta = path.join(ROOT, 'content/guides', slug, 'meta.php');
  if (!def || !def.spec) { console.log('SKIP ' + slug + ': no D(\'' + slug + '\') in content/games/_engine/v2/'); fail++; continue; }
  if (!fs.existsSync(guideMeta)) { console.log('SKIP ' + slug + ': no guide at content/guides/' + slug + '/'); fail++; continue; }
  const lcm = fs.readFileSync(guideMeta, 'utf8').match(/'leetcode'\s*=>\s*'?(\d+)/);
  const dir = path.join(ROOT, 'content/games', slug + '-game');
  if (fs.existsSync(dir) && !force && !dry) { console.log('SKIP ' + slug + ': ' + slug + '-game exists (use --force to rewrite)'); fail++; continue; }
  const f = fileOf[slug], fam = f.replace(/-\d+\.js$/, ''), label = LABEL[fam] || 'Algorithms', n = lcm ? +lcm[1] : 0, d = n ? diff[n] || '' : '';
  const cat = n ? 'LeetCode' : STRUCT.has(fam) ? 'Data Structures' : 'Algorithms';
  const hasSession = fs.existsSync(path.join(ROOT, 'content/coaching', slug, 'meta.php'));
  const lines = ['<?php', 'declare(strict_types=1);', '', 'return [', '    \'title\' => ' + q(def.title) + ','];
  if (n) lines.push('    \'leetcode\' => ' + n + ',');
  if (d) lines.push('    \'difficulty\' => ' + q(d) + ',');
  lines.push('    \'summary\' => ' + q(def.rule) + ',', '    \'category\' => ' + q(cat) + ',', '    \'subcategory\' => ' + q(label) + ',', '    \'topic\' => ' + q(cat + ' · ' + label) + ',',
    '    \'tags\' => [' + (n ? [fam, 'mini-game', 'leetcode'] : [fam, 'mini-game']).map(q).join(', ') + '],', '    \'entry\' => \'index.html\',', '    \'related_guide\' => ' + q(slug) + ',');
  if (hasSession) lines.push('    \'related_session\' => ' + q(slug) + ',');
  lines.push('];', '');
  const html = `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>${esc(def.title)}</title>
  <link rel="stylesheet" href="../_engine/engine.css">
</head>
<body>
  <main id="game"></main>
  <script src="../_engine/engine.js"></script>
  <script src="../_engine/def.js"></script>
  <script src="../_engine/v2/${f}"></script>
  <script>LCGame.mount(document.getElementById('game'), '${slug}');</script>
</body>
</html>
`;
  if (dry) { process.stdout.write('== ' + slug + '-game/meta.php\n' + lines.join('\n') + '== ' + slug + '-game/index.html\n' + html); continue; }
  fs.mkdirSync(dir, { recursive: true });
  fs.writeFileSync(path.join(dir, 'meta.php'), lines.join('\n'));
  fs.writeFileSync(path.join(dir, 'index.html'), html);
  console.log('wrote content/games/' + slug + '-game/');
}
if (fail) process.exitCode = 1;
