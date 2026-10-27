/* v2 games: array (03). Guides scored in the 3483–4041 pass. */
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

  D('number-of-student-replacements', {
    t: 'Number of Student Replacements',
    r: 'Keep the current selection\'s rank. Each arriving student replaces it only with a strictly better (smaller) rank; ties do not count.',
    g: R => ({ ranks: R.ints(R.int(3, 9), 1, 9) }),
    s(I, T) { let cur = I.ranks[0], c = 0; I.ranks.slice(1).forEach((r, i) => { const rep = r < cur; T.at({ ranks: A(I.ranks, { i: i + 1 }), selected: cur, replacements: c }); T.yn(`Does student ${i + 1} (rank ${r}) replace the selection?`, rep, rep ? `${r} < ${cur}.` : `${r} is not strictly better than ${cur}.`); if (rep) { cur = r; c++; } }); return c; }
  });

  D('trionic-array-i', {
    t: 'Trionic Array I',
    r: 'Walk once: climb while strictly increasing (that peak is p), descend while strictly decreasing (valley q), climb again. Trionic means 0 < p < q < n − 1 and the last climb reaches the end.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length; let i = 0; while (i + 1 < n && a[i] < a[i + 1]) i++; const p = i; T.at({ nums: A(a, { p }) }); T.n('Index where the first climb stops (p)?', p, 'Advance while the next value is strictly larger.'); while (i + 1 < n && a[i] > a[i + 1]) i++; const q = i; T.at({ nums: A(a, { p, q }) }); T.n('Index where the descent stops (q)?', q, 'Advance while the next value is strictly smaller.'); while (i + 1 < n && a[i] < a[i + 1]) i++; T.at({ nums: A(a, { p, q, end: i }) }); T.yn('Is the array trionic?', p > 0 && q > p && q < n - 1 && i === n - 1, 'Need 0 < p < q < n − 1 and the final climb to reach the last index.'); return p > 0 && q > p && q < n - 1 && i === n - 1; }
  });

  D('jump-game-ix', {
    t: 'Jump Game IX',
    r: 'From i you can always reach the max of nums[0..i] (jump back to it). If that prefix max is bigger than the min of nums[i+1..], you can cross to the right and do as well as i+1. So sweep from the right: ans[i] = ans[i+1] if prefMax[i] > sufMin[i+1], else prefMax[i].',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, pm = [], sm = Array(n + 1).fill(Infinity); a.forEach((x, i) => pm.push(Math.max(x, i ? pm[i - 1] : -Infinity))); for (let i = n - 1; i >= 0; i--) sm[i] = Math.min(a[i], sm[i + 1]); const ans = Array(n); ans[n - 1] = pm[n - 1]; for (let i = n - 2; i >= 0; i--) { const cross = pm[i] > sm[i + 1]; ans[i] = cross ? ans[i + 1] : pm[i]; if (n - 2 - i < 6) { T.at({ nums: A(a, { i }), prefMax: A(pm), sufMin: A(sm.slice(0, n)), ans: A(ans.map(v => v === undefined ? '·' : v)) }); T.n(`ans[${i}]?`, ans[i], cross ? `prefMax ${pm[i]} > sufMin ${sm[i + 1]}: cross right and inherit ans[${i + 1}].` : `Cannot cross right; best is the prefix max ${pm[i]}.`); } } return ans; }
  });

  D('earliest-time-to-finish-one-task', {
    t: 'Earliest Time to Finish One Task',
    r: 'A task ends at start + duration. Scan and keep the smallest end time.',
    g: R => ({ tasks: Array.from({ length: R.int(2, 5) }, () => [R.int(1, 9), R.int(1, 9)]) }),
    s(I, T) { let best = Infinity; I.tasks.forEach(([s, t], i) => { T.at({ task: `start ${s}, takes ${t}`, bestSoFar: best === Infinity ? '–' : best }); T.n(`Earliest finish after task ${i}?`, Math.min(best, s + t), `This task ends at ${s + t}.`); best = Math.min(best, s + t); }); return best; }
  });

  D('maximum-distance-between-unequal-words-in-array-i', {
    t: 'Maximum Distance Between Unequal Words in Array I',
    r: 'An optimal pair always uses one end. Scan from the right for the last word different from words[0], and from the left for the first word different from words[n−1]; take the larger span.',
    g: R => ({ words: Array.from({ length: R.int(1, 7) }, () => R.pick(['a', 'b', 'c'])) }),
    s(I, T) { const w = I.words, n = w.length; let j = n - 1; while (j > 0 && w[j] === w[0]) j--; let i = 0; while (i < n - 1 && w[i] === w[n - 1]) i++; const a = w[j] !== w[0] ? j + 1 : 0, b = w[i] !== w[n - 1] ? n - i : 0; T.at({ words: A(w, { i: 0, j }) }); T.n('Best span starting at index 0? (0 if none)', a, `Last word different from "${w[0]}".`); T.at({ words: A(w, { i, j: n - 1 }) }); T.n('Best span ending at the last index? (0 if none)', b, `First word different from "${w[n - 1]}".`); return Math.max(a, b); }
  });

  D('maximum-distance-between-unequal-words-in-array-ii', {
    t: 'Maximum Distance Between Unequal Words in Array II',
    r: 'With n up to 1e5 a pair scan is too slow. If the ends differ, the whole array works. Otherwise one end must be in the pair: find the farthest word different from words[0] from each side and take the better span. O(n).',
    g: R => ({ words: Array.from({ length: R.int(1, 8) }, () => R.pick(['x', 'y', 'z'])) }),
    s(I, T) { const w = I.words, n = w.length; T.at({ words: A(w, { i: 0, j: n - 1 }) }); T.yn('Do the two end words differ?', w[0] !== w[n - 1], w[0] !== w[n - 1] ? 'Then the full length n is the answer.' : 'Fix one end and search inward.'); if (w[0] !== w[n - 1]) return n; let j = n - 1; while (j > 0 && w[j] === w[0]) j--; let i = 0; while (i < n - 1 && w[i] === w[n - 1]) i++; const a = w[j] !== w[0] ? j + 1 : 0, b = w[i] !== w[n - 1] ? n - i : 0; T.at({ words: A(w, { i, j }) }); T.n('Longest span using index 0? (0 if none)', a, 'Farthest word from the left end that differs.'); T.n('Longest span using the last index? (0 if none)', b, 'Farthest word from the right end that differs.'); return Math.max(a, b); }
  });

  D('longest-fibonacci-subarray', {
    t: 'Longest Fibonacci Subarray',
    r: 'Walk once with a run length: if nums[i] = nums[i−1] + nums[i−2], the run grows by 1; otherwise it restarts at 2 (any two elements are Fibonacci). Track the longest run.',
    g: R => { const n = R.int(3, 8), a = R.ints(2, 1, 3); while (a.length < n) a.push(R.chance(0.6) ? a[a.length - 1] + a[a.length - 2] : R.int(1, 5)); return { nums: a }; },
    s(I, T) { const a = I.nums; let run = 2, best = 2; for (let i = 2; i < a.length; i++) { const ok = a[i] === a[i - 1] + a[i - 2]; run = ok ? run + 1 : 2; best = Math.max(best, run); if (i < 8) { T.at({ nums: A(a, { i, win: [i - run + 1, i] }), best }); T.n(`Fibonacci run length ending at index ${i}?`, run, ok ? `${a[i - 2]} + ${a[i - 1]} = ${a[i]}: extend.` : 'Breaks the rule: restart at 2.'); } } return best; }
  });

  D('best-reachable-tower', {
    t: 'Best Reachable Tower',
    r: 'Scan the towers. Skip those farther than radius (Manhattan distance). Keep the best by highest quality, then by smallest (x, y).',
    g: R => ({ towers: Array.from({ length: R.int(1, 5) }, () => [R.int(0, 5), R.int(0, 5), R.int(0, 9)]), center: [R.int(0, 5), R.int(0, 5)], radius: R.int(0, 5) }),
    s(I, T) { let best = null; I.towers.forEach(([x, y, q], i) => { const d = Math.abs(x - I.center[0]) + Math.abs(y - I.center[1]), ok = d <= I.radius; if (ok && (!best || q > best[2] || (q === best[2] && (x < best[0] || (x === best[0] && y < best[1]))))) best = [x, y, q]; if (i < 6) { T.at({ tower: `(${x}, ${y}) quality ${q}`, center: `(${I.center})`, radius: I.radius, best: best ? `(${best[0]}, ${best[1]})` : '–' }); T.yn(`Is tower ${i} reachable?`, ok, `Manhattan distance ${d}.`); } }); return best ? [best[0], best[1]] : [-1, -1]; }
  });

  D('minimum-prefix-removal-to-make-array-strictly-increasing', {
    t: 'Minimum Prefix Removal to Make Array Strictly Increasing',
    r: 'Walk from the right while each element is smaller than the one after it: that is the longest strictly increasing suffix. Remove everything before it.',
    g: R => ({ nums: R.ints(R.int(1, 7), -3, 6) }),
    s(I, T) { const a = I.nums; let i = a.length - 1; while (i > 0) { const ok = a[i - 1] < a[i]; T.at({ nums: A(a, { i: i - 1, win: [i, a.length - 1] }) }); T.yn(`Does nums[${i - 1}] = ${a[i - 1]} extend the increasing suffix?`, ok, ok ? `${a[i - 1]} < ${a[i]}.` : `${a[i - 1]} ≥ ${a[i]}: the suffix starts at ${i}.`); if (!ok) break; i--; } if (a.length === 1) { T.at({ nums: A(a) }); T.n('Prefix to remove?', 0, 'One element is increasing.'); } return i; }
  });

  D('rotate-non-negative-elements', {
    t: 'Rotate Non-Negative Elements',
    r: 'Pull out the non-negative values in order, rotate that list left by k mod its length, then write it back into the non-negative positions in order, leaving negatives in place.',
    g: R => ({ nums: R.ints(R.int(1, 7), -5, 9), k: R.int(0, 8) }),
    s(I, T) { const v = I.nums.filter(x => x >= 0), m = v.length; T.at({ nums: A(I.nums, { hl: I.nums.map((x, i) => x >= 0 ? i : -1).filter(i => i >= 0) }) }); T.n('How many non-negative values rotate?', m, 'Negatives stay put.'); if (!m) return I.nums.slice(); const s = I.k % m, rot = [...v.slice(s), ...v.slice(0, s)]; T.n('Effective shift (k mod count)?', s, `${I.k} mod ${m}.`); let p = 0; const out = I.nums.map(x => x < 0 ? x : rot[p++]); T.at({ rotated: A(rot) }); T.n('First non-negative value after the rotation?', rot[0], 'Left rotation brings index s to the front.'); return out; }
  });

  D('count-dominant-indices', {
    t: 'Count Dominant Indices',
    r: 'Sweep from the right with a running suffix sum and count. Index i is dominant when nums[i] × count > suffix sum (compare without dividing).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const a = I.nums; let s = 0, c = 0, d = 0; for (let i = a.length - 1; i >= 0; i--) { if (c) { const ok = a[i] * c > s; if (ok) d++; if (a.length - 1 - i <= 6) { T.at({ nums: A(a, { i, win: [i + 1, a.length - 1] }), suffixSum: s, count: c }); T.yn(`Is index ${i} dominant?`, ok, `${a[i]} vs average ${s}/${c}.`); } } s += a[i]; c++; } if (a.length === 1) { T.at({ nums: A(a) }); T.yn('Can the last element be dominant?', false, 'Nothing lies to its right.'); T.n('Answer?', 0, 'No dominant index.'); } return d; }
  });

  D('find-the-score-difference-in-a-game', {
    t: 'Find the Score Difference in a Game',
    r: 'Simulate with an "active player" flag: flip it for an odd score, flip it again on every 6th game (index 5, 11, …), then credit the active player.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 6) }),
    s(I, T) { let act = 0; const sc = [0, 0]; I.nums.forEach((x, i) => { if (x % 2) act ^= 1; if (i % 6 === 5) act ^= 1; sc[act] += x; if (i < 7) { T.at({ nums: A(I.nums, { i }), scores: K([['player 1', sc[0] - (act ? 0 : x)], ['player 2', sc[1] - (act ? x : 0)]]) }); T.c(`Who plays game ${i}?`, ['player 1', 'player 2'], act ? 'player 2' : 'player 1', `${x % 2 ? 'Odd score swaps.' : 'Even score keeps.'}${i % 6 === 5 ? ' Every 6th game swaps too.' : ''}`); } }); return sc[0] - sc[1]; }
  });

  D('minimum-capacity-box', {
    t: 'Minimum Capacity Box',
    r: 'Scan the boxes once. Keep the index of the smallest capacity that is still ≥ itemSize; only replace it on a strictly smaller capacity, so ties keep the earlier index.',
    g: R => ({ capacity: R.ints(R.int(1, 6), 1, 9), itemSize: R.int(1, 9) }),
    s(I, T) { let best = -1; I.capacity.forEach((c, i) => { const fits = c >= I.itemSize; if (fits && (best < 0 || c < I.capacity[best])) best = i; if (i < 6) { T.at({ capacity: A(I.capacity, { i }), itemSize: I.itemSize }); T.n(`Best box index after checking box ${i}? (−1 if none)`, best, fits ? 'It fits; keep it if strictly smaller.' : 'Too small.'); } }); return best; }
  });

  D('reverse-k-subarrays', {
    t: 'Reverse K Subarrays',
    r: 'Each block has length n / k. Reverse every block in place with two pointers.',
    g: R => { const k = R.int(1, 3), L = R.int(1, 3); return { nums: R.ints(k * L, 1, 9), k }; },
    s(I, T) { const a = I.nums.slice(), L = a.length / I.k; T.at({ nums: A(a) }); T.n('Length of each block?', L, `${a.length} / ${I.k}.`); for (let b = 0; b < I.k; b++) { let i = b * L, j = i + L - 1; while (i < j) { [a[i], a[j]] = [a[j], a[i]]; i++; j--; } if (b < 4) { T.at({ nums: A(a.slice(), { win: [b * L, b * L + L - 1] }) }); T.n(`First value of block ${b} after reversing?`, a[b * L], 'It was the last value of that block.'); } } return a; }
  });

  D('longest-arithmetic-sequence-after-changing-at-most-one-element', {
    t: 'Longest Arithmetic Sequence After Changing at Most One Element',
    r: 'Without a change, track arithmetic runs. Changing nums[i] can join the run ending at i−1 with the run starting at i+1 when (nums[i+1] − nums[i−1]) is twice the common difference, or extend one side by one element. Left and right run arrays make each i O(1).',
    g: R => ({ nums: R.ints(R.int(4, 7), 1, 9) }),
    s(I, T) { const best = a => { let b = Math.min(2, a.length); for (let i = 0; i + 1 < a.length; i++) { let L = 2; for (let j = i + 2; j < a.length && a[j] - a[j - 1] === a[i + 1] - a[i]; j++) L++; b = Math.max(b, L); } return b; }; const a = I.nums; let ans = best(a); T.at({ nums: A(a) }); T.n('Longest arithmetic subarray with no change?', ans, 'Track runs of equal differences.'); for (let i = 0; i < a.length; i++) { const cands = new Set(); if (i > 1) cands.add(2 * a[i - 1] - a[i - 2]); if (i + 2 < a.length) cands.add(2 * a[i + 1] - a[i + 2]); if (i > 0 && i + 1 < a.length && (a[i + 1] - a[i - 1]) % 2 === 0) cands.add((a[i - 1] + a[i + 1]) / 2); let b = 0; cands.forEach(v => { const c = a.slice(); c[i] = v; b = Math.max(b, best(c)); }); ans = Math.max(ans, b); if (i < 4) { T.at({ nums: A(a, { i }) }); T.n(`Longest arithmetic subarray if only nums[${i}] may change?`, Math.max(b, best(a)), 'Try the values that continue a neighbouring run or bridge both sides.'); } } return ans; }
  });

  D('valid-subarrays-with-exactly-one-peak', {
    t: 'Valid Subarrays With Exactly One Peak',
    r: 'List the peaks. For a peak at i, the left end ranges over (previous peak, i] and at most k left of i; the right end over [i, next peak) and at most k right of i. Multiply the two choices and add up over peaks.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, pk = range(1, n - 1).filter(i => a[i] > a[i - 1] && a[i] > a[i + 1]); T.at({ nums: A(a, { hl: pk }) }); T.n('How many peaks are there?', pk.length, 'Strictly above both neighbours.'); let tot = 0; pk.forEach((i, t) => { const L = Math.max(t ? pk[t - 1] + 1 : 0, i - I.k), Rr = Math.min(t + 1 < pk.length ? pk[t + 1] - 1 : n - 1, i + I.k), c = (i - L + 1) * (Rr - i + 1); tot += c; if (t < 4) { T.at({ nums: A(a, { i, win: [L, Rr] }), k: I.k }); T.n(`Valid subarrays around the peak at ${i}?`, c, `Left ends ${L}..${i}, right ends ${i}..${Rr}.`); } }); return tot; }
  });

  D('minimum-absolute-difference-between-two-values', {
    t: 'Minimum Absolute Difference Between Two Values',
    r: 'Sweep once remembering the latest index of a 1 and of a 2. At each 1 or 2, compare with the latest index of the other kind.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 2) }),
    s(I, T) { let l1 = -1, l2 = -1, best = -1, asks = 0; I.nums.forEach((x, i) => { if (x === 1) { l1 = i; if (l2 >= 0 && (best < 0 || i - l2 < best)) best = i - l2; } if (x === 2) { l2 = i; if (l1 >= 0 && (best < 0 || i - l1 < best)) best = i - l1; } if (x && asks++ < 6) { T.at({ nums: A(I.nums, { i }), last1: l1, last2: l2 }); T.n(`Best distance after index ${i}? (−1 if none)`, best, 'Compare with the latest index of the other value.'); } }); return best; }
  });

  D('compare-sums-of-bitonic-parts', {
    t: 'Compare Sums of Bitonic Parts',
    r: 'Find the peak (the first index where the next element is smaller), sum 0..peak and peak..n−1 (the peak counts in both), and compare.',
    g: R => { const up = R.int(1, 3), dn = R.int(1, 3), s = R.distinct(up + dn + 1, 1, 15).sort((a, b) => a - b), pk = s.pop(), L = s.slice(0, up).sort((a, b) => a - b), Rr = s.slice(up).sort((a, b) => b - a); return { nums: [...L, pk, ...Rr] }; },
    s(I, T) { const a = I.nums; let p = 0; while (p + 1 < a.length && a[p + 1] > a[p]) p++; T.at({ nums: A(a) }); T.n('Index of the peak?', p, 'Where increasing turns into decreasing.'); const up = sum(a.slice(0, p + 1)), dn = sum(a.slice(p)); T.at({ nums: A(a, { i: p }) }); T.n('Sum of the ascending part?', up, '0..peak inclusive.'); T.n('Sum of the descending part?', dn, 'peak..end inclusive.'); return up > dn ? 0 : dn > up ? 1 : -1; }
  });

  D('valid-elements-in-an-array', {
    t: 'Valid Elements in an Array',
    r: 'Precompute the maximum to the right of each index. Sweep from the left with the running maximum: keep nums[i] if it beats everything on its left or everything on its right.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { const a = I.nums, n = a.length, rm = Array(n).fill(-Infinity); for (let i = n - 2; i >= 0; i--) rm[i] = Math.max(rm[i + 1], a[i + 1]); let lm = -Infinity; const out = []; a.forEach((x, i) => { const ok = x > lm || x > rm[i]; if (ok) out.push(x); if (i < 7) { T.at({ nums: A(a, { i }), leftMax: lm === -Infinity ? '–' : lm, rightMax: rm[i] === -Infinity ? '–' : rm[i] }); T.yn(`Is nums[${i}] = ${x} valid?`, ok, ok ? 'It beats one whole side.' : 'Neither side is fully smaller.'); } lm = Math.max(lm, x); }); return out; }
  });

  D('count-indices-with-opposite-parity', {
    t: 'Count Indices With Opposite Parity',
    r: 'Sweep from the right keeping how many evens and odds have been seen. Each index\'s score is the count of the other parity.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const n = I.nums.length, ans = Array(n); let e = 0, o = 0; for (let i = n - 1; i >= 0; i--) { ans[i] = I.nums[i] % 2 ? e : o; if (n - 1 - i < 6) { T.at({ nums: A(I.nums, { i }), evensRight: e, oddsRight: o }); T.n(`answer[${i}]?`, ans[i], `${I.nums[i]} is ${I.nums[i] % 2 ? 'odd: count evens' : 'even: count odds'} to the right.`); } if (I.nums[i] % 2) o++; else e++; } return ans; }
  });

  D('minimum-operations-to-sort-a-permutation', {
    t: 'Minimum Operations to Sort a Permutation',
    r: 'Reversing and rotating keep the cyclic order (up to direction), so the array is sortable only if it is a rotation of 0..n−1 or of its reverse. Then compare the few candidates: rotate left r times, or reverse and rotate, in either order, and take the cheapest.',
    g: R => { const n = R.int(1, 5), b = range(0, n); const c = R.chance(0.7) ? (() => { const r = R.int(0, n - 1); let x = b.slice(r).concat(b.slice(0, r)); if (R.chance(0.5)) x.reverse(); return x; })() : R.perm(n); return { nums: c }; },
    s(I, T) { const n = I.nums.length, key = a => a.join(','), goal = key(range(0, n)), seen = new Map([[key(I.nums), 0]]), q = [I.nums]; while (q.length) { const a = q.shift(), d = seen.get(key(a)); [a.slice().reverse(), a.slice(1).concat(a.slice(0, 1))].forEach(b => { if (!seen.has(key(b))) { seen.set(key(b), d + 1); q.push(b); } }); } const rotSorted = range(0, n).some(r => key(I.nums.slice(r).concat(I.nums.slice(0, r))) === goal), rev = I.nums.slice().reverse(), rotRev = range(0, n).some(r => key(rev.slice(r).concat(rev.slice(0, r))) === goal); T.at({ nums: A(I.nums) }); T.yn('Is nums a rotation of the sorted array?', rotSorted, 'Then rotating alone can sort it.'); T.yn('Is the reversed array a rotation of the sorted array?', rotRev, 'Then one reversal plus rotations works.'); const ans = seen.has(goal) ? seen.get(goal) : -1; T.n('Fewest operations (−1 if impossible)?', ans, 'Compare the rotate-only and reverse-plus-rotate options.'); return ans; }
  });

  D('maximum-valid-pair-sum', {
    t: 'Maximum Valid Pair Sum',
    r: 'Sweep j from k upward while keeping the best nums[i] with i ≤ j − k. Each j pairs with that running maximum.',
    g: R => { const n = R.int(2, 7); return { nums: R.ints(n, 1, 9), k: R.int(1, n - 1) }; },
    s(I, T) { let mx = -Infinity, best = -Infinity; for (let j = I.k; j < I.nums.length; j++) { mx = Math.max(mx, I.nums[j - I.k]); best = Math.max(best, mx + I.nums[j]); if (j - I.k < 5) { T.at({ nums: A(I.nums, { i: j - I.k, j }), bestLeft: mx }); T.n(`Best pair ending at j = ${j}?`, mx + I.nums[j], `Running max of nums[0..${j - I.k}] plus nums[${j}].`); } } return best; }
  });

  D('sum-of-integers-with-maximum-digit-range', {
    t: 'Sum of Integers With Maximum Digit Range',
    r: 'Compute each number\'s digit range (largest digit minus smallest), keep the overall maximum, and add up the numbers that reach it, resetting the sum when a new maximum appears.',
    g: R => ({ nums: R.ints(R.int(1, 5), 10, 999) }),
    s(I, T) { let mx = -1, s = 0; I.nums.forEach((x, i) => { const d = String(x).split('').map(Number), r = Math.max(...d) - Math.min(...d); if (i < 5) { T.at({ nums: A(I.nums, { i }), maxRange: mx, sum: s }); T.n(`Digit range of ${x}?`, r, 'Largest digit minus smallest.'); } if (r > mx) { mx = r; s = x; } else if (r === mx) s += x; }); return s; }
  });

  D('minimum-total-cost-to-process-all-elements', {
    t: 'Minimum Total Cost to Process All Elements',
    r: 'Only top up when you must, and by as little as possible: when resources fall short of nums[i], do c = ⌈(nums[i] − res) / k⌉ operations. Their costs are the next c integers, so add an arithmetic series (mod 1e9+7).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 12), k: R.int(1, 6) }),
    s(I, T) { let res = I.k, ops = 0, cost = 0n; I.nums.forEach((x, i) => { let c = 0; if (res < x) { c = Math.ceil((x - res) / I.k); const a = BigInt(ops + 1), b = BigInt(ops + c); cost += (a + b) * BigInt(c) / 2n; ops += c; res += c * I.k; } if (i < 6) { T.at({ nums: A(I.nums, { i }), resources: res - c * I.k, opsSoFar: ops - c }); T.n(`Operations needed before processing ${x}?`, c, c ? `Short by ${x - (res - c * I.k)}; each op adds ${I.k}.` : 'Enough already.'); } res -= x; }); return Number(cost % BigInt(MOD)); }
  });

  D('find-all-numbers-disappeared-in-an-array-ii', {
    t: 'Find All Numbers Disappeared in an Array II',
    r: 'Mark the values present in a boolean array, then walk lower..upper and open a range at each missing value, extending it while values stay missing.',
    g: R => { const lo = R.int(1, 5); return { nums: R.ints(R.int(1, 5), 1, 12), lower: lo, upper: lo + R.int(0, 7) }; },
    s(I, T) { const has = new Set(I.nums), out = []; for (let v = I.lower; v <= I.upper; v++) { if (has.has(v)) continue; const last = out[out.length - 1]; if (last && last[1] === v - 1) last[1] = v; else out.push([v, v]); } T.at({ nums: A(I.nums), range: `[${I.lower}, ${I.upper}]` }); T.n('How many values in the range are missing?', range(I.lower, I.upper + 1).filter(v => !has.has(v)).length, 'Check each against the set.'); T.n('How many missing ranges?', out.length, 'Consecutive missing values join one range.'); if (out.length) T.n('Start of the first missing range?', out[0][0], 'The first value not present.'); return out; }
  });

  D('count-integers-appearing-in-a-single-block', {
    t: 'Count Integers Appearing in a Single Block',
    r: 'Record each value\'s first index, last index and count. A value forms one block exactly when count = last − first + 1.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 3) }),
    s(I, T) { const f = new Map(), l = new Map(), c = new Map(); I.nums.forEach((x, i) => { if (!f.has(x)) f.set(x, i); l.set(x, i); c.set(x, (c.get(x) || 0) + 1); }); let s = 0; [...f.keys()].sort((a, b) => a - b).forEach((x, i) => { const ok = c.get(x) === l.get(x) - f.get(x) + 1; if (ok) s++; if (i < 4) { T.at({ nums: A(I.nums, { i: f.get(x), j: l.get(x) }) }); T.yn(`Is ${x} special?`, ok, `Count ${c.get(x)} vs span ${l.get(x) - f.get(x) + 1}.`); } }); return s; }
  });
})();
