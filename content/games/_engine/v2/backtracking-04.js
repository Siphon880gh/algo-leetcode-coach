/* v2 games: backtracking (4). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
(function () {
  'use strict';
  const { D, A, G, K, S, Q, X, Tr, TR, GR, LL, Ls, IV, show } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const lcm = (a, b) => a / gcd(a, b) * b;
  const MOD = 1000000007;
  const range = (a, b) => Array.from({ length: Math.max(0, b - a) }, (_, i) => a + i);
  const fmt = a => typeof a === 'string' ? JSON.stringify(a) : Array.isArray(a) ? JSON.stringify(a) : String(a);
  const digits = x => String(Math.abs(x)).split('').map(Number);
  const isPal = s => s === s.split('').reverse().join('');
  const popc = x => { let c = 0; while (x) { c += x & 1; x >>>= 1; } return c; };
  const isPrime = x => { if (x < 2) return false; for (let d = 2; d * d <= x; d++) if (x % d === 0) return false; return true; };
  // Design problems: ops[0] constructs, the rest are method calls; asks about returned values.
  // o.view(obj) -> board, o.why(op, args, r, obj) -> feedback, o.strOpts / o.arrOpts(obj, r) -> distractors, o.skip(op) -> don't ask.
  const play = (I, T, make, o) => { o = o || {}; const obj = make(...(I.args[0] || [])), out = [null]; let asks = 0; const max = o.max || 7; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], args = I.args[i] || [], before = o.view ? o.view(obj) : {}; let r = obj[op](...args); if (r === undefined) r = null; out.push(r); if (asks >= max || r === null || (o.skip && o.skip(op))) continue; const label = `${op}(${args.map(fmt).join(', ')})`, why = o.why ? o.why(op, args, r, obj) : 'Follow the structure\'s invariant.'; T.at(Object.assign({ call: label }, before)); if (typeof r === 'number' && Number.isFinite(r)) { T.n(`What does ${label} return?`, r, why); asks++; } else if (typeof r === 'boolean') { T.yn(`Does ${label} return true?`, r, why); asks++; } else if (typeof r === 'string') { const opts = [...new Set([r, ...(o.strOpts ? o.strOpts(obj, r) : []), r === '' ? 'null' : ''])].slice(0, 4); if (opts.length > 1) { T.c(`What does ${label} return?`, opts.map(x => x === '' ? '""' : x), r === '' ? '""' : r, why); asks++; } } else if (Array.isArray(r)) { const opts = o.arrOpts ? o.arrOpts(obj, r, op) : null; if (opts) { T.c(`What does ${label} return?`, [r, ...opts].map(show), show(r), why); } else T.n(`How many items does ${label} return?`, r.length, why); asks++; } } if (!asks) { T.at({ calls: I.ops.length - 1 }); T.n('How many method calls follow the constructor?', I.ops.length - 1, 'Count the operations.'); } return out; };
  const seq = (R, ctor, ctorArgs, n, step, st) => { const ops = [ctor], args = [ctorArgs]; st = st || {}; for (let i = 0; i < n; i++) { const x = step(R, st); if (!x) break; ops.push(x[0]); args.push(x[1]); } return { ops, args }; };
  // Children lists of a tree given as undirected edges ([u, v] or [u, v, w]); ids 0..n-1 (or 1..n with base 1).
  const kids = (n, edges, root, base) => { base = base || 0; const adj = Array.from({ length: n + base }, () => []); edges.forEach(e => { adj[e[0]].push([e[1], e[2]]); adj[e[1]].push([e[0], e[2]]); }); const ch = Array.from({ length: n + base }, () => []), par = Array(n + base).fill(-1), order = [root], seen = new Set([root]); for (let i = 0; i < order.length; i++) for (const [v, w] of adj[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; ch[order[i]].push(v); order.push(v); } return { ch, par, order, adj }; };

  const isPalN = x => isPal(String(x));
  const primesTo = n => { const s = Array(n + 1).fill(true), out = []; for (let i = 2; i <= n; i++) if (s[i]) { out.push(i); for (let j = i * i; j <= n; j += i) s[j] = false; } return out; };


  // Subsets by take/skip on each element in order (take branch first).
  const subsetsTS = a => { const out = [], path = []; (function go(i) { if (i === a.length) { out.push(path.slice()); return; } path.push(a[i]); go(i + 1); path.pop(); go(i + 1); })(0); return out; };
  const subOpts = (good, all) => [good, ...all.filter(x => show(x) !== show(good)).slice(0, 3)].map(show);

  D('backtracking-algorithm', {
    t: 'Backtracking: Subsets by Take or Skip',
    r: 'Walk the numbers in order. For each one, first take it (push onto the path) and recurse, then undo (pop) and recurse again skipping it. When every number has been decided, record a copy of the path.',
    exs: [{ in: { nums: [1, 2] }, out: [[1, 2], [1], [2], []] }],
    cmp: 'sets',
    g: R => ({ nums: R.distinct(R.int(2, 4), 1, 9) }),
    s(I, T) { const a = I.nums, out = subsetsTS(a); T.at({ nums: A(a) }); T.n('How many subsets get recorded?', out.length, `Each of the ${a.length} numbers is taken or skipped: 2 to the power ${a.length}.`); [0, 1, out.length - 1].forEach(k => { T.at({ nums: A(a), recorded: out.slice(0, k).map(show).join('  ') || '(none yet)' }); T.c(`Which subset is recorded ${k === 0 ? 'first' : k === 1 ? 'second' : 'last'}?`, subOpts(out[k], out), show(out[k]), 'Take comes before skip at every level.'); }); return out; }
  });

  D('labu-topic-a8fa010ca5e4', {
    t: 'Backtracking Basics: Choose, Recurse, Undo',
    r: 'At each number choose to take it (push), recurse, then undo the choice (pop) before trying skip. Undo keeps the path exactly as it was before the choice, so the other branch starts clean.',
    exs: [{ in: { nums: [1, 2] }, out: [[], [2], [1], [1, 2]] }],
    cmp: 'sets',
    g: R => ({ nums: R.distinct(R.int(2, 4), 1, 9) }),
    s(I, T) { const a = I.nums, out = subsetsTS(a), n = a.length; T.at({ nums: A(a), path: A([a[0]]) }); T.n(`Taking ${a[0]} first: how many subsets get recorded inside that branch?`, 2 ** (n - 1), `The other ${n - 1} numbers are still free: 2 to the power ${n - 1}.`); T.c(`After finishing the take-${a[0]} branch and undoing, what is the path?`, ['[]', show([a[0]]), show(a.slice(0, 2))], '[]', 'Undo pops exactly what was pushed.'); T.c('Which subset is recorded right after the full path ' + show(a) + '?', subOpts(out[1], out), show(out[1]), 'Undo the last number and take its skip branch.'); return out; }
  });

  D('labu-topic-f70c65c45e6c', {
    t: 'Backtracking with Duplicates',
    r: 'Sort first so equal values sit together. At each depth loop i from start; if i > start and nums[i] equals nums[i − 1], skip it: the same value at the same depth would build the same subsets again. Record the path at every node.',
    exs: [{ in: { nums: [1, 1, 2] }, out: [[], [1], [1, 1], [1, 1, 2], [1, 2], [2]] }],
    cmp: 'sets',
    g: R => { const a = R.ints(R.int(3, 5), 1, 3); if (new Set(a).size === a.length) a[1] = a[0]; return { nums: a }; },
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), out = [], path = []; T.at({ nums: A(I.nums) }); T.c('What must happen before the skip rule works?', ['sort the numbers', 'remove duplicates', 'reverse the numbers'], 'sort the numbers', 'Equal values must be neighbors.'); (function go(st) { out.push(path.slice()); for (let i = st; i < a.length; i++) { if (i > st && a[i] === a[i - 1]) { T.at({ sorted: A(a, { hl: i, win: [st, a.length - 1] }), path: A(path) }); T.yn(`Depth ${path.length}, i = ${i} (value ${a[i]}): skip it?`, true, 'Same value as i − 1 at this depth: skip.'); continue; } path.push(a[i]); go(i + 1); path.pop(); } })(0); T.at({ sorted: A(a) }); T.n('How many distinct subsets are recorded?', out.length, 'One per node of the pruned tree.'); return out; }
  });

  D('n-queens-problem', {
    t: 'N-Queens Backtracking',
    r: 'Place one queen per row, top to bottom. A cell is safe if no earlier queen shares its column, its row − col diagonal or its row + col diagonal. Try columns left to right; if a row has no safe column, back up and move the previous queen.',
    exs: [{ in: { n: 4, first: 1 }, out: 1 }, { in: { n: 4, first: 0 }, out: 0 }],
    g: R => { const n = R.int(4, 6); return { n, first: R.int(0, n - 1) }; },
    s(I, T) { const n = I.n, cols = [I.first]; let count = 0; const safe = (r, c) => cols.every((q, rr) => q !== c && rr - q !== r - c && rr + q !== r + c); const board = () => Array.from({ length: n }, (_, r) => Array.from({ length: n }, (_, c) => cols[r] === c ? 'Q' : '.')); (function go(r) { if (r === n) { count++; return; } const ok = range(0, n).filter(c => safe(r, c)); T.v(G(board(), { label: 'board' }), K({ row: r })); T.n(`Row ${r}: how many columns are safe?`, ok.length, 'Check column and both diagonals against every queen above.'); for (const c of ok) { cols.push(c); go(r + 1); cols.pop(); } })(1); T.v(G(Array.from({ length: n }, (_, r) => Array.from({ length: n }, (_, c) => r === 0 && c === I.first ? 'Q' : '.')))); T.n(`How many full solutions start with the row 0 queen in column ${I.first}?`, count, 'Count the leaves that reach the last row.'); return count; }
  });

  D('permutations-problem', {
    t: 'Permutations with a used[] Array',
    r: 'At each depth try every number not yet used, in order: mark it used, push it, recurse, then pop it and clear the mark. A full path is one permutation; there are n! of them.',
    exs: [{ in: { nums: [1, 2, 3] }, out: [[1, 2, 3], [1, 3, 2], [2, 1, 3], [2, 3, 1], [3, 1, 2], [3, 2, 1]] }],
    g: R => ({ nums: R.distinct(R.int(3, 4), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, out = [], used = Array(n).fill(false), path = []; (function go() { if (path.length === n) { out.push(path.slice()); return; } for (let i = 0; i < n; i++) if (!used[i]) { used[i] = true; path.push(a[i]); go(); path.pop(); used[i] = false; } })(); T.at({ nums: A(a) }); T.n('How many permutations?', out.length, `${n}! = ${out.length}.`); T.n(`How many permutations start with ${a[0]}?`, out.length / n, `(${n} − 1)! for the remaining numbers.`); T.c('Which permutation is recorded second?', subOpts(out[1], out), show(out[1]), 'Undo the last two picks and take the next unused number at depth ' + (n - 2) + '.'); T.c(`Which permutation is recorded at position ${n + 1}?`, subOpts(out[n], out), show(out[n]), 'Count leaves in order.'); return out; }
  });

  D('subset-sum-problem', {
    t: 'Subset Sum: Reachable Sums',
    r: 'Keep the set of sums some subset can reach, starting with {0}. For each number x, every reachable sum s also makes s + x reachable. The target is possible if it appears in the set at the end.',
    exs: [{ in: { nums: [3, 1, 5], target: 6 }, out: true }, { in: { nums: [2, 4], target: 5 }, out: false }],
    g: R => ({ nums: R.ints(R.int(3, 5), 1, 7), target: R.int(4, 15) }),
    s(I, T) { let S = new Set([0]); I.nums.forEach((x, i) => { T.at({ nums: A(I.nums, { hl: i }), reachable: A([...S].sort((p, q) => p - q), { label: 'reachable sums' }) }); const nx = new Set(S); S.forEach(s => nx.add(s + x)); T.n(`After adding ${x}, how many distinct sums are reachable?`, nx.size, 'Old sums plus each old sum + ' + x + ', without repeats.'); S = nx; }); const ok = S.has(I.target); T.at({ reachable: A([...S].sort((p, q) => p - q)) }); T.yn(`Is ${I.target} reachable?`, ok, ok ? 'It is in the set.' : 'It is not in the set.'); return ok; }
  });

  D('labu-topic-767ecfc84dfe', {
    t: 'Backtracking Theory: The Decision Tree',
    r: 'Fill a path of length k from the numbers 1 to m without reuse. Depth d has m − d choices, so the tree has m × (m − 1) × ... × (m − k + 1) leaves. Pruning a used number never drops a valid answer, because no extension of a repeated path can succeed.',
    exs: [{ in: { m: 2, k: 2 }, out: 2 }, { in: { m: 4, k: 2 }, out: 12 }],
    g: R => { const m = R.int(3, 5); return { m, k: R.int(2, m) }; },
    s(I, T) { const { m, k } = I; let leaves = 1, nodes = 1; T.at({ m, k }); for (let d = 0; d < k; d++) { if (d < 3) T.n(`How many choices at depth ${d}?`, m - d, `${d} numbers are already used.`); leaves *= m - d; nodes += leaves; } T.n('How many leaves (complete paths)?', leaves, 'Multiply the choices at each depth.'); T.yn('Is a path like [1, 1, ...] ever completed?', false, 'Reuse is pruned the moment it appears, and no extension could fix it.'); return leaves; }
  });
})();
