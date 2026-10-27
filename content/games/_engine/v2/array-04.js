/* v2 games: array (04). Guides scored in the 4042–4095 pass. */
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

  D('longest-resilient-subarray-i', {
    t: 'Longest Resilient Subarray I',
    r: 'Deleting nums[i] leaves S − nums[i], so every element must be congruent to S mod k. That forces one shared remainder r, and then S ≡ cnt · r, so the test is (cnt − 1) · r ≡ 0 (mod k). With n ≤ 2500, check the subarrays ending at each index.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 12), k: R.int(2, 5) }),
    s(I, T) { const a = I.nums, k = I.k, n = a.length, res = (l, r) => { let S = 0; for (let i = l; i <= r; i++) S += a[i]; for (let i = l; i <= r; i++) if ((S - a[i]) % k) return false; return true; }; let best = 0; for (let r = 0; r < n; r++) { let L = 0; for (let l = 0; l <= r; l++) if (res(l, r)) { L = r - l + 1; break; } if (r < 6) { T.at({ nums: A(a, { r }), mods: A(a.slice(0, r).map(x => x % k)), k, best }); T.n(`nums[${r}] mod ${k}?`, a[r] % k, 'Reduce each value mod k.'); T.n(`Longest resilient subarray ending at index ${r}?`, L, 'All remainders equal, and (length − 1) · r divisible by k.'); } best = Math.max(best, L); } T.at({ nums: A(a), best }); T.n('Longest resilient subarray?', best, 'The best over every right end.'); return best; }
  });

  D('longest-resilient-subarray-ii', {
    t: 'Longest Resilient Subarray II',
    r: 'A resilient subarray needs one shared remainder r = nums[i] mod k, and (cnt − 1) · r ≡ 0 (mod k). Walk once: extend the run while the remainder repeats, restart it otherwise, and update the answer whenever (cnt − 1) · r mod k is 0.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 12), k: R.int(2, 5) }),
    s(I, T) { const k = I.k; let cnt = 0, prev = -1, best = 0; I.nums.forEach((x, i) => { const r = x % k; cnt = r === prev ? cnt + 1 : 1; prev = r; const ok = ((cnt - 1) * r) % k === 0; if (i < 6) { T.at({ nums: A(I.nums, { i }), k, best }); T.n(`Run length of remainder ${r} ending at index ${i}?`, cnt, cnt > 1 ? 'Same remainder as before: extend.' : 'A new remainder: restart at 1.'); T.yn(`Is (${cnt} − 1) · ${r} divisible by ${k}?`, ok, ok ? 'Then this run is resilient.' : 'Not resilient at this length.'); } if (ok) best = Math.max(best, cnt); }); T.at({ nums: A(I.nums), best }); T.n('Longest resilient subarray?', best, 'The largest run length that passed.'); return best; }
  });

  D('difference-between-peaks-and-valleys', {
    t: 'Difference Between Peaks and Valleys',
    r: 'Scan the inside indices. A peak is bigger than both neighbours and adds its value; a valley is smaller than both and subtracts its value; anything else is skipped.',
    g: R => ({ nums: R.ints(R.int(3, 8), -5, 5) }),
    s(I, T) { const a = I.nums; let tot = 0; for (let i = 1; i + 1 < a.length; i++) { const pk = a[i] > a[i - 1] && a[i] > a[i + 1], vl = a[i] < a[i - 1] && a[i] < a[i + 1], k = pk ? 'peak' : vl ? 'valley' : 'neither'; if (i < 8) { T.at({ nums: A(a, { i }), total: tot }); T.c(`Is index ${i} (${a[i]}) a peak, a valley, or neither?`, ['peak', 'valley', 'neither'], k, pk ? `${a[i]} beats both ${a[i - 1]} and ${a[i + 1]}.` : vl ? `${a[i]} is below both ${a[i - 1]} and ${a[i + 1]}.` : 'It is not strictly above or strictly below both neighbours.'); } tot += pk ? a[i] : vl ? -a[i] : 0; } T.at({ nums: A(a), total: tot }); T.n('Peak sum minus valley sum?', tot, 'Add the peaks and subtract the valleys.'); return tot; }
  });
})();
