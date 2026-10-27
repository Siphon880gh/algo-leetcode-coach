/* v2 games: sliding-window (04). Guides scored in the 4042–4095 pass. */
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

  D('count-good-cyclic-rotations', {
    t: 'Count Good Cyclic Rotations',
    r: 'Rotation p starts at index p, so its first half is a window of n/2 consecutive elements around the circle. Slide that window one step at a time (add the new element, drop the old one) and compare it with total − window.',
    g: R => ({ nums: R.ints(2 * R.int(1, 4), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, h = n / 2, tot = sum(a); let w = 0; for (let i = 0; i < h; i++) w += a[i]; let c = 0; for (let p = 0; p < n; p++) { if (p) w += a[(p + h - 1) % n] - a[p - 1]; const good = w > tot - w; if (p < 6) { T.at({ nums: A(a, { p }), total: tot, good: c }); T.n(`First-half sum for the rotation starting at ${p}?`, w, p ? `Add nums[${(p + h - 1) % n}] and drop nums[${p - 1}].` : 'Sum the first n/2 elements.'); T.yn('Is it strictly greater than the second half?', good, `Second half = total − first = ${tot - w}.`); } if (good) c++; } T.at({ nums: A(a), good: c }); T.n('How many good rotations?', c, 'Count the rotations whose first half wins.'); return c; }
  });

  D('longest-subarray-with-restricted-pair-sums', {
    t: 'Longest Subarray with Restricted Pair Sums',
    r: 'If a window has nums[i] + nums[j] = nums[k], every bigger window has it too, so slide: add nums[r], then move l right until no two elements sum to a third one.',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 8) }),
    s(I, T) { const a = I.nums, bad = (l, r) => { for (let k = l; k <= r; k++) for (let i = l; i <= r; i++) for (let j = i + 1; j <= r; j++) if (i !== k && j !== k && a[i] + a[j] === a[k]) return true; return false; }; let l = 0, best = 0; for (let r = 0; r < a.length; r++) { const was = l; while (bad(l, r)) l++; if (r < 7) { T.at({ nums: A(a, { l: was, r, win: [was, r] }), best }); T.n(`After adding nums[${r}] = ${a[r]}, where does l end up?`, l, l === was ? 'No pair sums to a third value, so l stays.' : `Some pair sums to a third value until l reaches ${l}.`); } best = Math.max(best, r - l + 1); } T.at({ nums: A(a), best }); T.n('Longest valid subarray length?', best, 'The largest r − l + 1 seen.'); return best; }
  });

  D('count-subarrays-with-loose-bounds', {
    t: 'Count Subarrays with Loose Bounds',
    r: 'Track the run of consecutive in-range elements ending at each index. An element outside [minK, maxK] resets the run to 0; otherwise the run grows by 1, and that many subarrays end here.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 9), minK: R.int(1, 4), maxK: R.int(4, 9) }),
    s(I, T) { let run = 0, tot = 0; I.nums.forEach((x, i) => { const ok = x >= I.minK && x <= I.maxK; if (i < 7) T.at({ nums: A(I.nums, { i }), minK: I.minK, maxK: I.maxK, total: tot }); run = ok ? run + 1 : 0; if (i < 7) T.n(`Run length ending at index ${i}?`, run, ok ? 'In range: the run grows by 1.' : `${x} is outside [${I.minK}, ${I.maxK}]: reset to 0.`); tot += run; }); T.at({ nums: A(I.nums), total: tot }); T.n('Total loose-bound subarrays?', tot, 'Sum of the run lengths.'); return tot; }
  });

  D('count-magical-substring-pairs-ii', {
    t: 'Count Magical Substring Pairs II',
    r: 'At the split after index j, L[j][d] is the longest substring ending at j with at most d distinct letters, and R[j + 1][d] the same starting at j + 1. Exactly-d counts are L[j][d] − L[j][d − 1], so the split adds the sum over d of (exact left) × (exact right).',
    g: R => ({ s: R.str(R.int(2, 6), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, distinct = (i, j) => new Set(s.slice(i, j + 1)).size; const Lf = (j, d) => { let len = 0; for (let i = j; i >= 0; i--) { if (distinct(i, j) <= d) len = j - i + 1; else break; } return len; }, Rf = (j, d) => { let len = 0; for (let k = j; k < n; k++) { if (distinct(j, k) <= d) len = k - j + 1; else break; } return len; }; let tot = 0, asked = 0; for (let j = 0; j + 1 < n; j++) { let c = 0; for (let d = 1; d <= 26; d++) c += (Lf(j, d) - Lf(j, d - 1)) * (Rf(j + 1, d) - Rf(j + 1, d - 1)); if (asked < 4) { T.at({ s: A(s.split(''), { j }), total: tot }); T.n(`L[${j}][1]: longest substring ending at ${j} with 1 distinct letter?`, Lf(j, 1), 'Extend left while the letter repeats.'); T.n(`R[${j + 1}][1]: longest substring starting at ${j + 1} with 1 distinct letter?`, Rf(j + 1, 1), 'Extend right while the letter repeats.'); T.n(`Magical pairs at the split after index ${j}?`, c, 'Sum over d of (exactly d on the left) × (exactly d on the right).'); asked++; } tot += c; } T.at({ s: A(s.split('')), total: tot }); T.n('Total magical triplets?', tot, 'Add every split.'); return tot; }
  });
})();
