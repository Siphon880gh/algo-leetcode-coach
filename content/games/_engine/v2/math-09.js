/* v2 games: math (09). Guides scored in the 3483–4041 pass. */
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

  D('count-digit-appearances', {
    t: 'Count Digit Appearances',
    r: 'For each number, peel digits off with % 10 and integer division by 10, counting those equal to digit. Add up over the array.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 999), digit: R.int(0, 9) }),
    s(I, T) { let tot = 0; I.nums.forEach((x, i) => { const c = String(x).split('').filter(d => +d === I.digit).length; tot += c; if (i < 5) { T.at({ nums: A(I.nums, { i }), digits: A(String(x).split('')), digit: I.digit }); T.n(`Times ${I.digit} appears in ${x}?`, c, 'Check each digit.'); } }); return tot; }
  });

  D('minimum-operations-to-transform-array-into-alternating-prime', {
    t: 'Minimum Operations to Transform Array Into Alternating Prime',
    r: 'Only increments are allowed, so each index independently climbs to the nearest valid value: the next prime at even indices, the next non-prime at odd indices. Precompute primes with a sieve (and a "next prime" table).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 20) }),
    s(I, T) { let tot = 0; I.nums.forEach((x, i) => { let y = x; while (i % 2 === 0 ? !isPrime(y) : isPrime(y)) y++; tot += y - x; if (i < 6) { T.at({ nums: A(I.nums, { i }) }); T.n(`Operations for index ${i} (${x})?`, y - x, i % 2 === 0 ? `Next prime at least ${x} is ${y}.` : `Next non-prime at least ${x} is ${y}.`); } }); return tot; }
  });

  D('sum-of-primes-between-number-and-its-reverse', {
    t: 'Sum of Primes Between Number and Its Reverse',
    r: 'Reverse the digits, take the range [min, max], and add up every prime in it (a sieve up to 1000 is plenty).',
    g: R => ({ n: R.int(1, 99) }),
    s(I, T) { const r = Number(String(I.n).split('').reverse().join('')), lo = Math.min(I.n, r), hi = Math.max(I.n, r); T.at({ n: I.n }); T.n('Reverse of n?', r, 'Reverse the digits (leading zeros drop).'); const ps = range(lo, hi + 1).filter(isPrime); T.at({ range: `[${lo}, ${hi}]` }); T.n('How many primes lie in the range?', ps.length, 'Check each with the sieve.'); if (ps.length) T.n('Largest prime in the range?', ps[ps.length - 1], 'Scan down from the top.'); return sum(ps); }
  });

  D('count-k-th-roots-in-a-range', {
    t: 'Count K-th Roots in a Range',
    r: 'Perfect k-th powers in [l, r] are x to the power k for x from l to the power (1 divided by k), rounded up to r to the power (1 divided by k), rounded down (0 counts as 0 to the power k). Find each integer root with binary search (or a float guess plus correction) and subtract.',
    g: R => ({ l: R.int(0, 30), r: R.int(30, 200), k: R.int(1, 4) }),
    s(I, T) { const root = (y, k) => { if (y < 0) return -1; let lo = 0, hi = y + 1; while (lo < hi) { const m = lo + hi + 1 >> 1; if (Math.pow(m, k) <= y) lo = m; else hi = m - 1; } return lo; }; const a = root(I.r, I.k), b = I.l > 0 ? root(I.l - 1, I.k) : -1; T.at({ l: I.l, r: I.r, k: I.k }); T.n(`Largest x with x to the power ${I.k} at most ${I.r}?`, a, 'Integer k-th root of r.'); T.n(`Largest x with x to the power ${I.k} at most ${I.l - 1}? (−1 if l is 0)`, b, 'Integer k-th root of l − 1.'); T.n('Count of perfect k-th powers in [l, r]?', a - b, 'Roots from b + 1 through a.'); return a - b; }
  });

  D('maximum-score-with-co-prime-element', {
    t: 'Maximum Score With Co-Prime Element',
    r: 'Pick the special index i and its final value v. Every other element that shares a factor with v must be changed (to 1, which is coprime with everything), costing 1 each; changing nums[i] itself costs 1 too. For each candidate v, count the elements sharing a prime with it using counts over multiples of each prime.',
    g: R => ({ nums: R.ints(R.int(1, 4), 1, 10), maxVal: R.int(1, 8) }),
    s(I, T) { const a = I.nums, n = a.length, bad = (i, v) => a.filter((x, j) => j !== i && gcd(x, v) > 1).length; let keep = -Infinity, chg = -Infinity; for (let i = 0; i < n; i++) { keep = Math.max(keep, a[i] - bad(i, a[i])); for (let v = 1; v <= I.maxVal; v++) if (v !== a[i]) chg = Math.max(chg, v - 1 - bad(i, v)); } T.at({ nums: A(a), maxVal: I.maxVal }); T.n('Best score keeping the chosen element unchanged?', keep, 'Its value minus the others you must change.'); T.n('Best score after changing the chosen element (−∞ means not possible)?', chg === -Infinity ? 0 : chg, 'Value minus 1 for the change, minus conflicts.'); T.yn('Is changing the chosen element better?', chg > keep, 'Compare the two.'); return Math.max(keep, chg); }
  });

  D('sum-of-compatible-numbers-in-range-i', {
    t: 'Sum of Compatible Numbers in Range I',
    r: 'Only x in [max(1, n − k), n + k] can qualify. Check each for n & x == 0 and add up the ones that pass.',
    g: R => ({ n: R.int(1, 20), k: R.int(1, 6) }),
    s(I, T) { let s = 0, c = 0; for (let x = Math.max(1, I.n - I.k); x <= I.n + I.k; x++) { const ok = (I.n & x) === 0; if (ok) s += x; if (c++ < 5) { T.at({ n: I.n, x, n_bin: I.n.toString(2), x_bin: x.toString(2) }); T.yn(`Is x = ${x} compatible?`, ok, `n & x = ${I.n & x}.`); } } return s; }
  });

  D('count-good-integers-in-a-range', {
    t: 'Count Good Integers in a Range',
    r: 'Count good numbers at most N with a digit DP over (position, previous digit, tight, started), allowing the next digit only if it is within k of the previous one. The answer is f(r) − f(l − 1).',
    g: R => { const l = R.int(10, 60); return { l, r: l + R.int(0, 40), k: R.int(0, 3) }; },
    s(I, T) { const good = x => { const d = String(x); for (let i = 1; i < d.length; i++) if (Math.abs(d[i] - d[i - 1]) > I.k) return false; return true; }, f = N => range(1, N + 1).filter(good).length; T.at({ l: I.l, r: I.r, k: I.k }); T.n(`Good numbers in [1, ${I.r}]?`, f(I.r), 'Digit DP up to r.'); T.n(`Good numbers in [1, ${I.l - 1}]?`, f(I.l - 1), 'Digit DP up to l − 1.'); T.yn(`Is ${I.l} itself good?`, good(I.l), 'Check adjacent digit gaps.'); return f(I.r) - f(I.l - 1); }
  });

  D('divisible-game', {
    t: 'Divisible Game',
    r: 'For a fixed k each element is worth +x if k divides it, else −x, and Alice wants the best subarray: Kadane. Only divisors of the elements (plus the smallest k dividing nothing) can matter, so run Kadane per candidate and keep the best difference with the smallest k; return diff times k mod 1e9+7.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 12) }),
    s(I, T) { const a = I.nums, mx = Math.max(...a), kad = k => { let b = -Infinity, c = -Infinity; a.forEach(x => { const v = x % k ? -x : x; c = Math.max(v, c + v); b = Math.max(b, c); }); return b; }; let bd = -Infinity, bk = 2; for (let k = 2; k <= mx + 1; k++) { const d = kad(k); if (d > bd) { bd = d; bk = k; } } [2, 3].forEach(k => { T.at({ nums: A(a), signs: A(a.map(x => x % k ? -x : x)), k }); T.n(`Best score difference with k = ${k}?`, kad(k), 'Kadane over ±x.'); }); T.n('Which k gives the best difference (smallest on ties)?', bk, 'Compare all candidate k.'); return ((bd * bk) % MOD + MOD) % MOD; }
  });

  D('minimum-moves-to-balance-circular-array-ii', {
    t: 'Minimum Moves to Balance Circular Array II',
    r: 'If the total is negative it is impossible. Otherwise choose a net flow x_i across each edge (i to i+1) so every final balance b_i − x_i + x_{i−1} is at least 0 and the sum of |x_i| is smallest. That is a min-cost flow on the cycle; with n at most 1000 you can push units from donors to the nearest debts along the cheaper side.',
    g: R => { const n = R.int(2, 4); return { balance: R.ints(n, -2, 2) }; },
    s(I, T) { const b = I.balance, n = b.length, tot = sum(b); T.at({ balance: A(b) }); T.n('Total balance?', tot, 'Moves never change the total.'); T.yn('Is it possible?', tot >= 0, tot >= 0 ? 'Enough units exist.' : 'Some debt can never be covered.'); if (tot < 0) return -1; const B = sum(b.map(Math.abs)); let best = Infinity; const x = Array(n).fill(0), go = i => { if (i === n) { for (let k = 0; k < n; k++) if (b[k] - x[k] + x[(k - 1 + n) % n] < 0) return; best = Math.min(best, sum(x.map(Math.abs))); return; } for (let v = -B; v <= B; v++) { x[i] = v; go(i + 1); } }; go(0); T.n('Debt that must be covered (sum of negatives)?', -sum(b.filter(v => v < 0)), 'Each unit of debt needs at least one move.'); return best; }
  });

  D('minimum-operations-to-make-array-equal-iii', {
    t: 'Minimum Operations to Make Array Equal III',
    r: 'Pick the final value v. An element already equal costs 0; one that divides v or is divisible by v (v > 1) costs 1; anything else costs 2 (go through a common multiple). Count, for candidate v, how many elements are in a divisor or multiple relation using divisor enumeration over the values, and take the cheapest v.',
    g: R => ({ nums: R.ints(R.int(1, 4), 1, 12) }),
    s(I, T) { const a = I.nums, L = a.reduce((x, y) => x / gcd(x, y) * y, 1), cost = v => sum(a.map(x => x === v ? 0 : v === 1 ? Infinity : (v % x === 0 || x % v === 0) ? 1 : 2)); let best = Infinity, bv = 1; for (let v = 1; v <= L * 2; v++) { const c = cost(v); if (c < best) { best = c; bv = v; } } const mx = Math.max(...a); T.at({ nums: A(a) }); T.n(`Cost to make everything equal to ${mx} (the largest)?`, cost(mx), 'Equal: 0, divisor or multiple: 1, otherwise 2.'); T.n(`Cost to make everything equal to the LCM ${L}?`, cost(L), 'Every element divides it.'); T.n('Best cost over all targets?', best, 'Try the candidates.'); return best; }
  });

  D('maximize-pair-strength-using-gcd', {
    t: 'Maximize Pair Strength Using GCD',
    r: 'The strength is (a times b) divided by gcd² = (a divided by g) times (b divided by g). With n at most 2000 just try every pair, computing the gcd each time.',
    g: R => ({ nums: R.ints(R.int(2, 5), 1, 12) }),
    s(I, T) { const a = I.nums; let best = 0, asks = 0; for (let i = 0; i < a.length; i++) for (let j = i + 1; j < a.length; j++) { const g = gcd(a[i], a[j]), v = (a[i] / g) * (a[j] / g); best = Math.max(best, v); if (asks++ < 4) { T.at({ nums: A(a, { i, j }) }); T.n(`Strength of the pair (${a[i]}, ${a[j]})?`, v, `gcd ${g}: (${a[i]} divided by ${g}) times (${a[j]} divided by ${g}).`); } } return best; }
  });

  D('k-th-digit-in-infinite-string', {
    t: 'K-th Digit in Infinite String',
    r: 'Numbers with the same digit count d fill whole blocks of 10 (except 1 to 9), contributing d times count digits. Skip whole digit-length groups, then whole blocks, to find the block holding k; reverse the order inside odd blocks; then pick the digit inside the number.',
    g: R => ({ k: R.int(1, 400) }),
    s(I, T) { let s = ''; for (let b = 0; s.length < I.k; b++) { const xs = range(10 * b, 10 * b + 10).filter(x => x > 0); (b % 2 ? xs.reverse() : xs).forEach(x => s += x); } let len = 0, b = 0, num = 0; for (;; b++) { const xs = range(10 * b, 10 * b + 10).filter(x => x > 0), L = xs.reduce((a, x) => a + String(x).length, 0); if (len + L >= I.k) { const ord = b % 2 ? xs.reverse() : xs; let p = len; for (const x of ord) { if (p + String(x).length >= I.k) { num = x; break; } p += String(x).length; } break; } len += L; } T.at({ k: I.k }); T.n('Which block b holds the k-th digit?', b, 'Skip whole blocks of 10 numbers.'); T.yn('Is that block written in decreasing order?', b % 2 === 1, 'Odd blocks are reversed.'); T.n('Which number contains the digit?', num, 'Walk the block in its written order.'); return +s[I.k - 1]; }
  });

  D('maximum-valid-split-positions-i', {
    t: 'Maximum Valid Split Positions I',
    r: 'Both sides of a valid split must equal the gcd G of the whole (remaining) array. For each choice of removed element (or none), build prefix and suffix gcds and count splits where both equal G. n at most 1000 makes this O(n²).',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 12) }),
    s(I, T) { const score = a => { const m = a.length; if (m < 2) return 0; const P = [a[0]], S = Array(m); for (let i = 1; i < m; i++) P[i] = gcd(P[i - 1], a[i]); S[m - 1] = a[m - 1]; for (let i = m - 2; i >= 0; i--) S[i] = gcd(S[i + 1], a[i]); let c = 0; for (let i = 0; i < m - 1; i++) if (P[i] === S[i + 1]) c++; return c; }; let best = score(I.nums); T.at({ nums: A(I.nums) }); T.n('Score without removing anything?', best, 'Count splits where prefix gcd equals suffix gcd.'); I.nums.forEach((_, r) => { const v = score(I.nums.filter((_, i) => i !== r)); if (r < 3) { T.at({ nums: A(I.nums, { i: r }) }); T.n(`Score after removing index ${r}?`, v, 'Recompute prefix and suffix gcds.'); } best = Math.max(best, v); }); return best; }
  });

  D('maximum-valid-split-positions-ii', {
    t: 'Maximum Valid Split Positions II',
    r: 'n is 10 to the power 5, so recomputing per removal is too slow. A split is valid when both sides have gcd G (the remaining array\'s gcd). Prefix gcds take only O(log) distinct values, so for each removed index, combine precomputed prefix gcds before it, suffix gcds after it, and counts of positions where they equal the new G, all from prefix or suffix arrays and gcd-run boundaries.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 12) }),
    s(I, T) { const score = a => { const m = a.length; if (m < 2) return 0; const P = [a[0]], S = Array(m); for (let i = 1; i < m; i++) P[i] = gcd(P[i - 1], a[i]); S[m - 1] = a[m - 1]; for (let i = m - 2; i >= 0; i--) S[i] = gcd(S[i + 1], a[i]); let c = 0; for (let i = 0; i < m - 1; i++) if (P[i] === S[i + 1]) c++; return c; }; const a = I.nums, n = a.length, P = [a[0]]; for (let i = 1; i < n; i++) P[i] = gcd(P[i - 1], a[i]); T.at({ nums: A(a), prefixGcd: A(P) }); T.n('How many distinct prefix gcd values?', new Set(P).size, 'Each change at least halves it, so there are few.'); const wo0 = score(a.slice(1)); T.n('Score after removing index 0?', wo0, 'The new gcd may grow.'); let best = score(a); a.forEach((_, r) => best = Math.max(best, score(a.filter((_, i) => i !== r)))); T.n('Best score overall?', best, 'Best of no removal and every single removal.'); return best; }
  });

  D('sum-of-decoded-numbers', {
    t: 'Sum of Decoded Numbers',
    r: 'Split each code: width = last digit, the rest gives x (first width digits) and y (remaining digits). Add x to the power y mod 1e9+7 using fast exponentiation.',
    g: R => ({ nums: Array.from({ length: R.int(1, 3) }, () => { const w = R.int(1, 2), x = R.int(1, w === 1 ? 9 : 99), y = R.int(1, 30); return Number(String(x).padStart(w, '1') + y + w); }) }),
    s(I, T) { const M = BigInt(MOD), pw = (b, e) => { let r = 1n; b %= M; while (e > 0n) { if (e & 1n) r = r * b % M; b = b * b % M; e >>= 1n; } return r; }; let tot = 0n; I.nums.forEach((v, i) => { const w = v % 10, d = String(Math.floor(v / 10)), x = BigInt(d.slice(0, w)), y = BigInt(d.slice(w)); if (i < 3) { T.at({ code: v, width: w, digits: d }); T.n(`x for ${v}?`, Number(x), `The first ${w} digit${w > 1 ? 's' : ''}.`); T.n(`y for ${v}?`, Number(y), 'The remaining digits.'); } tot = (tot + pw(x, y)) % M; }); return Number(tot); }
  });
})();
