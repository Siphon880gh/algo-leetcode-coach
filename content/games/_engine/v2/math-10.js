/* v2 games: math (10). Guides scored in the 4042–4095 pass. */
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

  D('minimum-operations-to-make-every-element-palindromic', {
    t: 'Minimum Operations to Make Every Element Palindromic',
    r: 'A move changes x by 2, so x keeps its parity. Find the nearest positive palindrome with the same parity below and above x (a sorted list and binary search in the fast version). Half the distance is the moves, and the elements are independent.',
    g: R => ({ nums: R.ints(R.int(1, 4), 1, 150) }),
    s(I, T) { let tot = 0; I.nums.forEach((x, i) => { let down = null, up = null; for (let y = x; y >= 1; y -= 2) if (isPalN(y)) { down = y; break; } for (let y = x; ; y += 2) if (isPalN(y)) { up = y; break; } const tgt = down !== null && x - down <= up - x ? down : up, moves = Math.abs(tgt - x) / 2; let wrong = null; for (let dd = 1; dd < 400 && wrong === null; dd += 2) { if (x - dd >= 1 && isPalN(x - dd)) wrong = x - dd; else if (isPalN(x + dd)) wrong = x + dd; } if (i < 5) { T.at({ nums: A(I.nums, { i }), total: tot }); const tie = down !== null && up !== down && x - down === up - x; if (!tie && tgt !== x) T.c(`Which palindrome should ${x} become?`, [down, up, wrong].filter(v => v !== null), tgt, v => v === wrong ? `${v} has the other parity, so steps of 2 never reach it.` : `${tgt} is closer and has the same parity.`); T.n(`Moves for ${x}?`, moves, `abs(${tgt} − ${x}) / 2.`); } tot += moves; }); T.at({ nums: A(I.nums), total: tot }); T.n('Total moves?', tot, 'Add the moves of every element.'); return tot; }
  });

  D('count-good-strings', {
    t: 'Count Good Strings',
    r: 'Every split must cut between two runs, so a string is good exactly when every run has odd length. Ordered sums of odd parts follow c(n) = c(n − 1) + c(n − 2): the last part is 1, or a last part of at least 3 shrinks by 2. That is Fibonacci, so the answer is 2 · F(n), with fast doubling for n up to 10^15.',
    g: R => ({ n: R.int(3, 12) }),
    s(I, T) { const n = I.n, M = 1000000007n, go = m => { if (m === 0n) return [0n, 1n]; const [a, b] = go(m / 2n), c = (a * ((2n * b - a + M) % M)) % M, d = (a * a + b * b) % M; return m % 2n === 0n ? [c, d] : [d, (c + d) % M]; }, ans = Number(2n * go(BigInt(n))[0] % M); if (n <= 60) { const c = [0, 1, 1]; for (let x = 3; x <= n; x++) c.push(c[x - 1] + c[x - 2]); T.at({ n, rule: 'every run has odd length' }); T.yn('Is "aabbb" good?', false, 'The run "aa" has even length, so no split works.'); for (let x = 3; x <= Math.min(n, 8); x++) { T.at({ c: A(c.slice(1, x)), x }); T.n(`c(${x}): ordered ways to write ${x} as a sum of odd parts?`, c[x], `c(${x - 1}) + c(${x - 2}).`); } T.at({ c: A(c.slice(1, n + 1)), n }); T.n(`Good strings of length ${n}?`, ans, '2 · c(n): two choices for the first letter.'); } return ans; }
  });
})();
