/* v2 games: prefix-sum (04). Guides scored in the 4042–4095 pass. */
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

  const modk = (v, k) => ((v % k) + k) % k;

  D('count-subarrays-with-distant-sums', {
    t: 'Count Subarrays with Distant Sums',
    r: 'A subarray sum is P[j + 1] − P[i]. Walking the right end, count earlier prefixes with P[i] at most P[j + 1] − goal − k or P[i] at least P[j + 1] − goal + k; a sorted list answers both with binary search. With k = 0 every subarray counts.',
    g: R => ({ nums: R.ints(R.int(2, 6), -4, 4), goal: R.int(-3, 3), k: R.int(0, 4) }),
    s(I, T) { const P = [0]; I.nums.forEach(x => P.push(P[P.length - 1] + x)); let tot = 0; for (let j = 0; j < I.nums.length; j++) { const cur = P[j + 1]; let c = 0; for (let i = 0; i <= j; i++) if (Math.abs(cur - P[i] - I.goal) >= I.k) c++; if (j < 5) { T.at({ nums: A(I.nums, { j }), prefixes: A(P.slice(0, j + 1)), goal: I.goal, k: I.k }); T.n(`Prefix sum P[${j + 1}]?`, cur, 'Add nums[j] to the previous prefix.'); T.n(`Distant subarrays ending at index ${j}?`, c, `Count earlier prefixes P[i] with abs(${cur} − P[i] − ${I.goal}) at least ${I.k}.`); } tot += c; } T.at({ nums: A(I.nums), total: tot }); T.n('Total distant subarrays?', tot, 'Add the counts for every right end.'); return tot; }
  });

  D('maximum-pulse-value-after-one-subarray-rotation', {
    t: 'Maximum Pulse Value After One Subarray Rotation',
    r: 'Left-rotating nums[l to r] sends nums[l] to position r and shifts nums[l + 1 to r] left by one, which flips all their signs. With signed prefix sums each (l, r) gain is O(1), so scan r and keep the best l. The answer is base + max(0, best gain).',
    g: R => ({ nums: R.ints(R.int(2, 6), -5, 5) }),
    s(I, T) { const a = I.nums, n = a.length, pulse = x => x.reduce((s, v, i) => s + (i % 2 ? -v : v), 0), base = pulse(a); T.at({ nums: A(a) }); T.n('Pulse with no rotation?', base, 'Add the even indices and subtract the odd ones.'); let best = 0; for (let r = 1; r < n; r++) { let g = -Infinity, bl = 0; for (let l = 0; l < r; l++) { const b = a.slice(), x = b.splice(l, 1)[0]; b.splice(r, 0, x); const v = pulse(b) - base; if (v > g) { g = v; bl = l; } } if (r <= 5) { T.at({ nums: A(a, { r }), base, bestGain: best }); T.n(`Best gain with the rotation ending at r = ${r}?`, g, `The best l is ${bl}: nums[l] lands at r and the rest flip sign.`); } best = Math.max(best, g); } T.at({ nums: A(a), base, bestGain: best }); T.n('Maximum pulse value?', base + best, 'base + max(0, best gain), because the rotation is optional.'); return base + best; }
  });

  D('longest-subarray-divisible-by-k-with-at-most-one-negation-i', {
    t: 'Longest Subarray Divisible by K with At Most One Negation I',
    r: 'Negating x changes the sum by −2x. Fix the left end and grow the right end, keeping the sum and the set of 2x mod k for every x inside. The window is valid when its sum mod k is 0 or is in that set.',
    g: R => ({ nums: R.ints(R.int(2, 6), -6, 6), k: R.int(2, 6) }),
    s(I, T) { const a = I.nums, k = I.k, n = a.length; let best = 0; for (let l = 0; l < n; l++) { let S = 0, L = 0; const twos = new Set(); for (let r = l; r < n; r++) { S += a[r]; twos.add(modk(2 * a[r], k)); const m = modk(S, k); if (m === 0 || twos.has(m)) L = r - l + 1; } if (l < 6) { T.at({ nums: A(a, { l }), k, best }); T.n(`Longest valid subarray starting at index ${l} (0 if none)?`, L, 'Valid when sum mod k is 0, or equals 2x mod k for some x inside.'); } best = Math.max(best, L); } T.at({ nums: A(a), k, best }); T.n('Longest valid subarray?', best, 'Best over every left end.'); return best; }
  });

  D('longest-subarray-divisible-by-k-with-at-most-one-negation-ii', {
    t: 'Longest Subarray Divisible by K with At Most One Negation II',
    r: 'With prefix remainders p, the subarray (l, r] is valid when p[r] ≡ p[l], or p[r] ≡ p[l] + 2x for an element x inside it. Only the earliest left end per remainder matters, and a shifted remainder unlocks once an element at or after that left end shows up.',
    g: R => ({ nums: R.ints(R.int(2, 6), -6, 6), k: R.int(2, 6) }),
    s(I, T) { const a = I.nums, k = I.k, n = a.length, p = [0]; a.forEach(x => p.push(modk(p[p.length - 1] + x, k))); let best = 0; for (let r = 1; r <= n; r++) { let L = 0; for (let l = 0; l < r && !L; l++) { const S = p[r] - p[l]; let ok = modk(S, k) === 0; for (let t = l; t < r && !ok; t++) if (modk(S - 2 * a[t], k) === 0) ok = true; if (ok) L = r - l; } if (r <= 6) { T.at({ nums: A(a, { r: r - 1 }), p: A(p.slice(0, r)), k, best }); T.n(`p[${r}] = prefix sum mod ${k}?`, p[r], 'Add nums[r − 1] to the previous remainder, mod k.'); T.n(`Longest valid subarray ending at index ${r - 1} (0 if none)?`, L, 'The earliest l with p[r] ≡ p[l], or p[r] ≡ p[l] + 2x for some x inside.'); } best = Math.max(best, L); } T.at({ nums: A(a), p: A(p), best }); T.n('Longest valid subarray?', best, 'Best over every right end.'); return best; }
  });

  D('minimum-rotations-to-dial-a-number-ii', {
    t: 'Minimum Rotations to Dial a Number II',
    r: 'Reversing s[k..] keeps every step inside the suffix (distance is symmetric) and only changes the seam: from s[k − 1] (or 0 when k = 0) you now jump to s[n − 1]. With prefix sums of step costs, each k costs O(1).',
    g: R => { const n = R.int(2, 6); return { n, s: R.str(n, '0123456789') }; },
    s(I, T) { const d = (x, y) => { const t = Math.abs(x - y); return Math.min(t, 10 - t); }, v = I.s.split('').map(Number), n = v.length, cost = arr => { let p = 0, c = 0; arr.forEach(x => { c += d(p, x); p = x; }); return c; }, base = cost(v); T.at({ s: A(v) }); T.n('Rotations with no reversal?', base, 'Sum the circular distances between consecutive digits, starting from 0.'); let best = base; for (let k = 0; k < n; k++) { const w = v.slice(0, k).concat(v.slice(k).reverse()), c = cost(w); if (k < 5) { T.at({ s: A(v, { k, win: [k, n - 1] }), best }); T.n(`Rotations after reversing s[${k}..${n - 1}]?`, c, `Only the seam changes: from ${k ? v[k - 1] : 0} you go to ${v[n - 1]} instead of ${v[k]}.`); } best = Math.min(best, c); } T.at({ s: A(v), best }); T.n('Minimum total rotations?', best, 'The cheapest of no reversal and every k.'); return best; }
  });

  D('count-frequency-staircase-subarrays-ii', {
    t: 'Count Frequency Staircase Subarrays II',
    r: 'A staircase with k distinct values has length exactly 1 + 2 + … + k = k(k + 1) divided by 2. So from each left end only a few lengths can work. Check just those windows; the fast version checks them with hashed prefix sums.',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, stair = (l, r) => { const cnt = new Map(), order = []; for (let i = l; i <= r; i++) { if (!cnt.has(a[i])) { cnt.set(a[i], 0); order.push(a[i]); } cnt.set(a[i], cnt.get(a[i]) + 1); } return order.every((v, k) => cnt.get(v) === k + 1) ? order.length : 0; }; let tot = 0, asked = 0; T.at({ nums: A(a) }); T.n('A staircase with 3 distinct values has what length?', 6, '1 + 2 + 3 = 6.'); for (let l = 0; l < n; l++) for (let k = 1; l + k * (k + 1) / 2 - 1 < n; k++) { const r = l + k * (k + 1) / 2 - 1, ok = stair(l, r) === k; if (asked < 9) { T.at({ nums: A(a, { l, r, win: [l, r] }), k }); T.yn(`Is nums[${l}..${r}] (length ${r - l + 1}) a staircase with ${k} distinct values?`, ok, ok ? 'The counts are 1, 2, …, k in first-appearance order.' : 'The counts in first-appearance order are not 1, 2, …, k.'); asked++; } if (ok) tot++; } T.at({ nums: A(a), total: tot }); T.n('Total staircase subarrays?', tot, 'Only lengths k(k + 1) divided by 2 can work; add the windows that pass.'); return tot; }
  });
})();
