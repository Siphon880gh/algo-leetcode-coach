/* v2 games: math (08). Guides scored in the 3483–4041 pass. */
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

  D('count-numbers-with-non-decreasing-digits', {
    t: 'Count Numbers with Non-Decreasing Digits',
    r: 'Write each number in base b and check that every digit is at least the one before it. The full solution is a digit DP over (position, last digit, tight); here you check the base-b digits of each number.',
    g: R => { const b = R.int(2, 6), l = R.int(1, 40); return { l: String(l), r: String(l + R.int(3, 8)), b }; },
    s(I, T) { let c = 0; for (let x = +I.l; x <= +I.r; x++) { const d = x.toString(I.b).split('').map(Number), ok = d.every((v, i) => !i || v >= d[i - 1]); if (ok) c++; if (T.room()) { T.at({ x, ['base ' + I.b]: A(d) }); T.yn(`Are the base-${I.b} digits of ${x} non-decreasing?`, ok, ok ? 'Each digit at least the previous.' : 'Some digit drops below the one before it.'); } } return c % MOD; }
  });

  D('smallest-index-with-digit-sum-equal-to-index', {
    t: 'Smallest Index With Digit Sum Equal to Index',
    r: 'Scan left to right, computing each number\'s digit sum with % 10 and integer division by 10. Return the first index i whose digit sum equals i, or −1.',
    g: R => ({ nums: Array.from({ length: R.int(3, 7) }, (_, i) => R.chance(0.3) ? (i < 10 ? i : 9) + (R.chance(0.5) ? 0 : 9) : R.int(0, 120)) }),
    s(I, T) { for (let i = 0; i < I.nums.length; i++) { const d = sum(digits(I.nums[i])); T.at({ nums: A(I.nums, { i }) }); T.n(`Digit sum of nums[${i}] = ${I.nums[i]}?`, d, 'Add the decimal digits.'); if (d === i) return i; } return -1; }
  });

  D('sum-of-largest-prime-substrings', {
    t: 'Sum of Largest Prime Substrings',
    r: 'Turn every substring into a number (leading zeros drop away), keep the primes in a set so repeats count once, then add the three largest.',
    g: R => ({ s: R.str(R.int(2, 5), '1123579') }),
    s(I, T) { const s = I.s, P = new Set(); let asked = 0; for (let i = 0; i < s.length; i++) for (let j = i + 1; j <= s.length; j++) { const v = parseInt(s.slice(i, j), 10), p = isPrime(v); if (p) P.add(v); if (asked < 6 && v > 1 && (j - i) <= 3) { asked++; T.at({ s: A(s.split(''), { win: [i, j - 1] }), primes: A([...P].sort((a, b) => b - a)) }); T.yn(`Is ${v} prime?`, p, p ? 'No divisor up to its square root.' : `Divisible by ${range(2, v).find(d => v % d === 0)}.`); } } const top = [...P].sort((a, b) => b - a).slice(0, 3); T.at({ primes: A([...P].sort((a, b) => b - a)) }); T.n('Sum of the three largest distinct primes?', sum(top), 'Fewer than three: add them all.'); return sum(top); }
  });

  D('find-minimum-log-transportation-cost', {
    t: 'Find Minimum Log Transportation Cost',
    r: 'Three trucks, two logs: at most one log is longer than k. Cut it into k and x minus k (the most unbalanced cut costs least): cost k times (x minus k). If no log is too long, the cost is 0.',
    g: R => { const k = R.int(2, 9); return { n: R.int(1, 2 * k), m: R.int(1, 2 * k), k }; },
    s(I, T) { const res = (() => { const { n, m, k } = I; T.at({ n, m, k }); T.n('Longest log?', Math.max(n, m), 'Compare it with k.'); const big = n > k ? n : m > k ? m : 0; T.c('Which log needs a cut?', ['n', 'm', 'neither'], n > k ? 'n' : m > k ? 'm' : 'neither', 'A log longer than k does not fit a truck.'); if (!big) return 0; T.at({ log: big, k }); T.n(`Cheapest cut cost for the log of length ${big}?`, k * (big - k), 'The piece lengths multiplied; smallest when one piece is exactly k.'); return k * (big - k); })(); T.n('Minimum cost?', res, '0 if both logs fit.'); return res; }
  });

  D('maximize-subarray-gcd-score', {
    t: 'Maximize Subarray GCD Score',
    r: 'Doubling helps a subarray\'s gcd only if every element with the fewest factors of 2 gets doubled. So for each subarray: score = length times gcd times (2 if that count at most k, else 1).',
    g: R => ({ nums: Array.from({ length: R.int(2, 5) }, () => R.pick([1, 2, 3, 4, 6, 8, 12])), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, v2 = x => { let c = 0; while (x % 2 === 0) { x /= 2; c++; } return c; }; let best = 0, asked = 0; for (let i = 0; i < n; i++) { let g = 0; for (let j = i; j < n; j++) { g = gcd(g, a[j]); const w = a.slice(i, j + 1), mn = Math.min(...w.map(v2)), c = w.filter(x => v2(x) === mn).length, sc = (j - i + 1) * g * (c <= I.k ? 2 : 1); best = Math.max(best, sc); if (asked < 5 && j > i) { asked++; T.at({ nums: A(a, { win: [i, j] }), gcd: g, k: I.k }); T.n(`Best score of nums[${i}..${j}]?`, sc, c <= I.k ? `${c} elements hold the fewest 2s; doubling them doubles the gcd.` : `${c} elements hold the fewest 2s, more than k.`); } } } T.at({ nums: A(a), k: I.k }); T.n('Maximum score?', best, 'Best over every subarray (single elements count: one doubling gives 2 times value).'); return best; }
  });

  D('find-maximum-area-of-a-triangle', {
    t: 'Find Maximum Area of a Triangle',
    r: 'An axis-parallel side lies on one x (or one y). For each x, the longest vertical side is maxY − minY there, and the third point should be as far as possible in x: max(x − minX, maxX − x). Twice the area is side times distance; repeat for horizontal sides.',
    g: R => { const pts = new Set(); while (pts.size < R.int(3, 7)) pts.add(R.int(1, 5) + ',' + R.int(1, 5)); return { coords: [...pts].map(s => s.split(',').map(Number)) }; },
    s(I, T) { const P = I.coords; let best = 0; for (const ax of [0, 1]) { const o = 1 - ax, by = new Map(); P.forEach(p => { const k = p[ax]; const v = by.get(k) || [Infinity, -Infinity]; by.set(k, [Math.min(v[0], p[o]), Math.max(v[1], p[o])]); }); const lo = Math.min(...P.map(p => p[ax])), hi = Math.max(...P.map(p => p[ax])); for (const [k, [a, b]] of [...by].sort((x, y) => x[0] - y[0])) { const v = (b - a) * Math.max(k - lo, hi - k); best = Math.max(best, v); if (b > a && T.room()) { T.at({ points: A(P.map(p => `(${p[0]},${p[1]})`)), line: (ax ? 'y = ' : 'x = ') + k, side: b - a, farthest: Math.max(k - lo, hi - k) }); T.n(`Twice the best area using a side on ${ax ? 'y' : 'x'} = ${k}?`, v, 'Side length times farthest distance from that line.'); } } } return best || -1; }
  });

  D('hexadecimal-and-hexatrigesimal-conversion', {
    t: 'Hexadecimal and Hexatrigesimal Conversion',
    r: 'Convert by repeated division: the remainders mod 16 (for n²) and mod 36 (for n³) are the digits from right to left, using A to F and A to Z past 9. Concatenate the two strings.',
    g: R => ({ n: R.int(2, 60) }),
    s(I, T) { const a = I.n * I.n, b = a * I.n, h = a.toString(16).toUpperCase(), t = b.toString(36).toUpperCase(); T.at({ n: I.n, 'n²': a }); T.c(`n² = ${a} in base 16?`, [h, a.toString(36).toUpperCase(), String(a), a.toString(8)], h, 'Divide by 16 repeatedly; read remainders bottom-up.'); T.at({ n: I.n, 'n³': b }); T.n(`Last base-36 digit value of ${b} (that is, ${b} mod 36)?`, b % 36, 'The rightmost digit is the remainder.'); T.c(`n³ = ${b} in base 36?`, [t, b.toString(16).toUpperCase(), String(b)], t, 'Divide by 36 repeatedly.'); return h + t; }
  });

  D('minimum-moves-to-reach-target-in-grid', {
    t: 'Minimum Moves to Reach Target in Grid',
    r: 'Work backwards from the target. If x > y, the last move grew x: from x divided by 2 when x at least 2y (x must be even), else from x − y. Symmetric when y > x. When x = y, the previous point was (0, y) or (x, 0).',
    g: R => { const sx = R.int(0, 3), sy = R.int(sx ? 0 : 1, 3); let x = sx, y = sy; const k = R.int(1, 4); for (let i = 0; i < k; i++) { const m = Math.max(x, y); if (R.chance(0.5)) x += m; else y += m; } if (R.chance(0.2)) x++; return { sx, sy, tx: x, ty: y }; },
    s(I, T) { const { sx, sy } = I, memo = new Map(); const rev = (X, Y) => { if (X < sx || Y < sy) return Infinity; if (X === sx && Y === sy) return 0; const k = X + ',' + Y; if (memo.has(k)) return memo.get(k); let r = Infinity; if (X === Y) { if (X) r = 1 + Math.min(rev(0, Y), rev(X, 0)); } else if (X > Y) { if (X >= 2 * Y) { if (X % 2 === 0) r = 1 + rev(X / 2, Y); } else r = 1 + rev(X - Y, Y); } else { if (Y >= 2 * X) { if (Y % 2 === 0) r = 1 + rev(X, Y / 2); } else r = 1 + rev(X, Y - X); } memo.set(k, r); return r; }; const ans = rev(I.tx, I.ty); let X = I.tx, Y = I.ty; for (let s = 0; s < 5 && !(X === sx && Y === sy); s++) { let opts, c; if (X === Y) { if (!X) break; opts = [`(0,${Y})`, `(${X},0)`, `(${X / 2},${Y})`]; c = rev(0, Y) <= rev(X, 0) ? [0, Y] : [X, 0]; } else if (X > Y) { const a = X >= 2 * Y ? (X % 2 ? null : [X / 2, Y]) : [X - Y, Y]; if (!a) break; opts = [`(${a[0]},${a[1]})`, `(${X - Y},${Y})`, `(${Math.floor(X / 2)},${Y})`, `(${X},${Y - 1})`]; c = a; } else { const a = Y >= 2 * X ? (Y % 2 ? null : [X, Y / 2]) : [X, Y - X]; if (!a) break; opts = [`(${a[0]},${a[1]})`, `(${X},${Y - X})`, `(${X},${Math.floor(Y / 2)})`, `(${X - 1},${Y})`]; c = a; } if (rev(c[0], c[1]) === Infinity && ans !== Infinity) break; T.at({ start: `(${sx},${sy})`, at: `(${X},${Y})` }); T.c(`Which point came right before (${X},${Y})?`, [...new Set(opts)], `(${c[0]},${c[1]})`, X === Y ? 'Equal coordinates: one of them was 0 before.' : 'If the grown side was the max it doubled; otherwise it gained the other side.'); X = c[0]; Y = c[1]; } T.at({ start: `(${sx},${sy})`, target: `(${I.tx},${I.ty})` }); T.n('Minimum moves? (−1 if unreachable)', ans === Infinity ? -1 : ans, 'Count backward steps until the start (or a dead end).'); return ans === Infinity ? -1 : ans; }
  });

  D('split-array-by-prime-indices', {
    t: 'Split Array by Prime Indices',
    r: 'Mark prime indices with a sieve (0 and 1 are not prime). Values at prime indices add to A, the rest to B; return |sum(A) − sum(B)|.',
    g: R => ({ nums: R.ints(R.int(2, 8), -5, 9) }),
    s(I, T) { let a = 0, b = 0; I.nums.forEach((x, i) => { const p = isPrime(i); if (i < 7) { T.at({ nums: A(I.nums, { i }), sumA: a, sumB: b }); T.yn(`Is index ${i} prime?`, p, p ? `nums[${i}] goes to A.` : `nums[${i}] goes to B.`); } if (p) a += x; else b += x; }); return Math.abs(a - b); }
  });

  D('check-divisibility-by-digit-sum-and-product', {
    t: 'Check Divisibility by Digit Sum and Product',
    r: 'Peel digits with % 10 to get the digit sum and the digit product, then check n % (sum + product) == 0.',
    g: R => ({ n: R.int(10, 9999) }),
    s(I, T) { const d = digits(I.n), s = sum(d), p = d.reduce((x, y) => x * y, 1); T.at({ n: I.n, digits: A(d) }); T.n('Digit sum?', s, 'Add the digits.'); T.n('Digit product?', p, 'Multiply the digits (any 0 makes it 0).'); T.yn(`Is ${I.n} divisible by ${s + p}?`, I.n % (s + p) === 0, `${I.n} mod ${s + p} = ${I.n % (s + p)}.`); return I.n % (s + p) === 0; }
  });

  D('count-number-of-trapezoids-i', {
    t: 'Count Number of Trapezoids I',
    r: 'A horizontal trapezoid takes one horizontal segment from one y level and one from another. Level y with c points gives C(c, 2) segments; sum the products over every pair of levels with a running total.',
    g: R => { const pts = new Set(); while (pts.size < R.int(4, 8)) pts.add(R.int(0, 4) + ',' + R.int(0, 2)); return { points: [...pts].map(s => s.split(',').map(Number)) }; },
    s(I, T) { const by = new Map(); I.points.forEach(([x, y]) => by.set(y, (by.get(y) || 0) + 1)); let run = 0, tot = 0; [...by].sort((a, b) => a[0] - b[0]).forEach(([y, c]) => { const s = c * (c - 1) / 2; T.at({ points: A(I.points.map(p => `(${p[0]},${p[1]})`)), level: 'y = ' + y, pointsHere: c, segmentsBelow: run }); T.n(`Horizontal segments on y = ${y}?`, s, `C(${c}, 2).`); tot = (tot + s * run) % MOD; run += s; T.n('Trapezoids counted so far?', tot, 'Each new segment pairs with every segment on lower levels.'); }); return tot; }
  });

  D('count-number-of-trapezoids-ii', {
    t: 'Count Number of Trapezoids II',
    r: 'Group all segments by slope. Two segments with the same slope but on different lines give a trapezoid. A parallelogram is counted twice (two parallel pairs), so subtract pairs of segments that share a midpoint and are not collinear.',
    g: R => { const pts = new Set(); while (pts.size < R.int(4, 6)) pts.add(R.int(0, 3) + ',' + R.int(0, 3)); return { points: [...pts].map(s => s.split(',').map(Number)) }; },
    s(I, T) { const P = I.points, n = P.length, cr = (o, a, b) => (a[0] - o[0]) * (b[1] - o[1]) - (a[1] - o[1]) * (b[0] - o[0]); const trap = q => { for (let i = 0; i < 4; i++) for (let j = i + 1; j < 4; j++) for (let k = j + 1; k < 4; k++) if (!cr(q[i], q[j], q[k])) return false; const inTri = (p, a, b, c) => { const d1 = Math.sign(cr(a, b, p)), d2 = Math.sign(cr(b, c, p)), d3 = Math.sign(cr(c, a, p)); return d1 === d2 && d2 === d3; }; for (let i = 0; i < 4; i++) { const o = q.filter((_, j) => j !== i); if (inTri(q[i], ...o)) return false; } const cx = sum(q.map(p => p[0])) / 4, cy = sum(q.map(p => p[1])) / 4, s = q.slice().sort((a, b) => Math.atan2(a[1] - cy, a[0] - cx) - Math.atan2(b[1] - cy, b[0] - cx)); const par = (a, b, c, d) => (b[0] - a[0]) * (d[1] - c[1]) === (b[1] - a[1]) * (d[0] - c[0]); return par(s[0], s[1], s[3], s[2]) || par(s[1], s[2], s[0], s[3]); }; let c = 0; const lab = p => `(${p[0]},${p[1]})`; for (let a = 0; a < n; a++) for (let b = a + 1; b < n; b++) for (let d = b + 1; d < n; d++) for (let e = d + 1; e < n; e++) { const q = [P[a], P[b], P[d], P[e]], ok = trap(q); if (ok) c++; if (T.room() && T.asks < 5) { T.at({ points: A(P.map(lab), { hl: [a, b, d, e] }) }); T.yn(`Do ${q.map(lab).join(' ')} form a trapezoid?`, ok, ok ? 'Convex, with a pair of parallel opposite sides.' : 'Three are collinear, one lies inside, or no opposite sides are parallel.'); } } T.at({ points: A(P.map(lab)) }); T.n('Total trapezoids?', c, 'Same-slope segment pairs on different lines, minus parallelograms counted twice.'); return c; }
  });

  D('sum-of-beautiful-subsequences', {
    t: 'Sum of Beautiful Subsequences',
    r: 'f(g) = number of strictly increasing subsequences using only multiples of g (a Fenwick tree counts them). The count with gcd exactly g is f(g) minus the exact counts of 2g, 3g, …; go from large g down and add g times exact(g).',
    g: R => ({ nums: R.ints(R.int(2, 5), 1, 8) }),
    s(I, T) { const mx = Math.max(...I.nums), inc = arr => { const dp = arr.map(() => 1); for (let i = 0; i < arr.length; i++) for (let j = 0; j < i; j++) if (arr[j] < arr[i]) dp[i] += dp[j]; return sum(dp); }; const ex = Array(mx + 1).fill(0); let tot = 0; for (let g = mx; g >= 1; g--) { const f = inc(I.nums.filter(x => x % g === 0)); let e = f; for (let m = 2 * g; m <= mx; m += g) e -= ex[m]; ex[g] = e; tot = (tot + g * e) % MOD; if (g <= 3 && f) { T.at({ nums: A(I.nums, { hl: I.nums.map((x, i) => x % g === 0 ? i : -1).filter(i => i >= 0) }), g }); T.n(`Increasing subsequences made only of multiples of ${g}?`, f, 'dp[i] = 1 + the sum of dp[j] for j < i with a smaller value.'); T.n(`How many have gcd exactly ${g}?`, e, `Subtract the exact counts for ${2 * g}, ${3 * g}, ….`); } } return tot; }
  });

  D('compute-decimal-representation', {
    t: 'Compute Decimal Representation',
    r: 'Each non-zero digit d at place 10 to the power p becomes the component d times 10 to the power p. Read the digits from the most significant end and skip zeros.',
    g: R => ({ n: R.int(1, 99999) }),
    s(I, T) { const s = String(I.n), out = []; s.split('').forEach((ch, i) => { const v = Number(ch) * Math.pow(10, s.length - 1 - i); T.at({ digits: A(s.split(''), { i }), parts: A(out.slice()) }); T.n(`Component from digit ${i} (0 to skip)?`, v, ch === '0' ? 'Zero digit: no component.' : `${ch} times 10 to the power ${s.length - 1 - i}.`); if (v) out.push(v); }); return out; }
  });

  D('count-no-zero-pairs-that-sum-to-n', {
    t: 'Count No-Zero Pairs That Sum to N',
    r: 'Digit DP over n from the lowest digit: pick digits for a and b with the carry, letting each number "end" (all higher digits empty) at some point; neither may have a 0 digit before it ends. Small n can be checked pair by pair.',
    g: R => ({ n: R.int(2, 60) }),
    s(I, T) { const nz = x => x > 0 && !String(x).includes('0'); let c = 0; for (let a = 1; a < I.n; a++) if (nz(a) && nz(I.n - a)) c++; const tries = [1, 10, Math.floor(I.n / 2), I.n - 1].filter((a, i, s) => a >= 1 && a < I.n && s.indexOf(a) === i); tries.forEach(a => { T.at({ n: I.n, a, b: I.n - a }); T.yn(`Is (${a}, ${I.n - a}) a no-zero pair?`, nz(a) && nz(I.n - a), 'Both numbers must avoid the digit 0.'); }); return c; }
  });

  D('count-ways-to-choose-coprime-integers-from-rows', {
    t: 'Count Ways to Choose Coprime Integers From Rows',
    r: 'f(d) = product over rows of how many entries are divisible by d — the ways whose gcd is a multiple of d. Go from the largest d down: exact(d) = f(d) − exact(2d) − exact(3d) − …; the answer is exact(1).',
    g: R => ({ mat: Array.from({ length: R.int(1, 3) }, () => R.ints(R.int(1, 3), 1, 8)) }),
    s(I, T) { const mx = Math.max(...[].concat(...I.mat)), ex = Array(mx + 1).fill(0); for (let d = mx; d >= 1; d--) { let f = 1; I.mat.forEach(row => f = f * row.filter(x => x % d === 0).length % MOD); let e = f; for (let m = 2 * d; m <= mx; m += d) e = (e - ex[m] + MOD) % MOD; ex[d] = e; if (d <= 3) { T.at({ mat: G(I.mat), d }); T.n(`Choices where every pick is divisible by ${d}?`, f, 'Multiply the per-row counts.'); if (d > 1) T.n(`Choices with gcd exactly ${d}?`, e, 'Subtract the exact counts of the multiples of d.'); } } return ex[1]; }
  });

  D('count-distinct-integers-after-removing-zeros', {
    t: 'Count Distinct Integers After Removing Zeros',
    r: 'Removing zeros gives a zero-free number no bigger than x, and every zero-free y at most n appears (from x = y). So count zero-free numbers in [1, n]: 9 to the power L for each shorter length L, plus a digit DP for n\'s own length.',
    g: R => ({ n: R.int(1, 400) }),
    s(I, T) { const s = String(I.n); for (let L = 1; L < s.length; L++) { T.at({ n: I.n }); T.n(`Zero-free numbers with exactly ${L} digit${L > 1 ? 's' : ''}?`, Math.pow(9, L), '9 choices (1 to 9) per digit.'); } let same = 0; for (let x = Math.pow(10, s.length - 1); x <= I.n; x++) if (!String(x).includes('0')) same++; T.at({ n: I.n }); T.n(`Zero-free numbers with ${s.length} digits that are at most ${I.n}?`, same, 'Digit DP along n, never using 0.'); let tot = same; for (let L = 1; L < s.length; L++) tot += Math.pow(9, L); return tot; }
  });

  D('concatenate-non-zero-digits-and-multiply-by-sum-i', {
    t: 'Concatenate Non-Zero Digits and Multiply by Sum I',
    r: 'Walk the digits, appending each non-zero one to x (x = 10x + d) and adding it to the digit sum. Return x times sum.',
    g: R => ({ n: R.pick([R.int(0, 9999), R.int(100, 100000) * 10, R.int(1, 9) * 1000 + R.int(0, 9)]) }),
    s(I, T) { let x = 0, s = 0; String(I.n).split('').forEach((ch, i) => { const d = +ch; if (d) { x = x * 10 + d; s += d; } if (i < 6) { T.at({ digits: A(String(I.n).split(''), { i }), x, sum: s }); T.n(`x after digit ${i}?`, x, d ? `Append ${d}.` : 'Zero: skip.'); } }); return x * s; }
  });

  D('complete-prime-number', {
    t: 'Complete Prime Number',
    r: 'Check every prefix (first k digits) and every suffix (last k digits) with a primality test; one composite or 1 makes the answer false.',
    g: R => ({ num: R.pick([R.int(1, 99), R.pick([23, 37, 53, 73, 373, 317, 797, 3797, 233, 29])]) }),
    s(I, T) { const s = String(I.num), parts = []; for (let k = 1; k <= s.length; k++) { parts.push(['prefix', +s.slice(0, k)]); if (k < s.length) parts.push(['suffix', +s.slice(s.length - k)]); } let ok = true; for (const [kind, v] of parts) { const p = isPrime(v); T.at({ num: A(s.split('')), checking: `${kind} ${v}` }); T.yn(`Is the ${kind} ${v} prime?`, p, p ? 'Keep checking.' : 'Not prime: the answer is false.'); if (!p) { ok = false; break; } } return ok; }
  });

  D('largest-prime-from-consecutive-prime-sum', {
    t: 'Largest Prime From Consecutive Prime Sum',
    r: 'Sieve the primes up to n, then add them one by one starting from 2 while the running sum stays at most n. Each running sum that is itself prime is a candidate; keep the last one.',
    g: R => ({ n: R.int(1, 120) }),
    s(I, T) { let s = 0, best = 0, asks = 0; for (let p = 2; p <= I.n; p++) { if (!isPrime(p)) continue; if (s + p > I.n) break; s += p; const ok = isPrime(s); if (ok) best = s; if (asks++ < 6) { T.at({ n: I.n, added: p, runningSum: s, best: best === s ? best : best }); T.yn(`Running sum ${s} (after adding ${p}) — is it prime?`, ok, ok ? 'New best candidate.' : 'Composite: keep adding.'); } } if (!asks) { T.at({ n: I.n }); T.yn('Is any prime at most n?', false, 'n < 2: no primes.'); T.n('Answer?', 0, 'Nothing qualifies.'); } return best; }
  });

  D('last-remaining-integer-after-alternating-deletion-operations', {
    t: 'Last Remaining Integer After Alternating Deletion Operations',
    r: 'Track only the head, the gap between survivors and the count. A left-to-right pass always removes the head; a right-to-left pass removes it only when the count is even. Each pass halves the count and doubles the gap, so n up to 1e15 takes about 50 passes.',
    g: R => ({ n: R.int(1, 40) }),
    s(I, T) { let a = range(1, I.n + 1), op = 1, pass = 0; while (a.length > 1) { if (op === 1) a = a.filter((_, i) => i % 2 === 0); else { const L = a.length; a = a.filter((_, i) => (L - 1 - i) % 2 === 0); } pass++; if (pass <= 4) { T.at({ remaining: A(a.slice(0, 10)), pass, from: op === 1 ? 'left' : 'right' }); T.n(`First remaining number after pass ${pass}?`, a[0], op === 1 ? 'From the left: keep positions 1, 3, 5, …' : 'From the right: keep every other number counting from the end.'); } op = 3 - op; } if (!pass) { T.at({ n: I.n }); T.yn('Is only one number there already?', true, 'n = 1.'); } return a[0]; }
  });

  D('smallest-all-ones-multiple', {
    t: 'Smallest All Ones Multiple',
    r: 'Never build the huge number: track only its remainder, r = (10r + 1) mod k, for lengths 1, 2, 3, …. Hitting 0 gives the length; there are only k remainders, so after k steps without 0 the answer is −1.',
    g: R => ({ k: R.int(2, 40) }),
    s(I, T) { let r = 0; for (let L = 1; L <= I.k; L++) { r = (r * 10 + 1) % I.k; if (L <= 5) { T.at({ k: I.k, length: L }); T.n(`Remainder of ${'1'.repeat(L)} mod ${I.k}?`, r, '(10 times previous + 1) mod k.'); } if (!r) return L; } T.at({ k: I.k }); T.yn('Did any length up to k reach remainder 0?', false, 'Remainders must repeat within k steps: impossible.'); return -1; }
  });

  D('sum-of-increasing-product-blocks', {
    t: 'Sum of Increasing Product Blocks',
    r: 'Keep a counter of the next integer. Block i multiplies the next i integers (mod 1e9+7) and advances the counter by i; add each block to the total.',
    g: R => ({ n: R.int(1, 7) }),
    s(I, T) { let c = 1, tot = 0; for (let i = 1; i <= I.n; i++) { let p = 1; const used = []; for (let j = 0; j < i; j++) { p = p * c % MOD; used.push(c++); } tot = (tot + p) % MOD; if (i <= 5) { T.at({ block: i, numbers: A(used) }); T.n(`Value of block ${i} (mod 1e9+7)?`, p, `Product of ${used.join(' times ')}.`); } } return tot; }
  });

  D('number-of-ways-to-paint-sheets', {
    t: 'Number of Ways to Paint Sheets',
    r: 'An ordered pair of colors (i first, j second) with first segment length x needs 1 at most x at most n−1, x at most limit[i] and n − x at most limit[j]: that is max(0, min(limit[i], n−1) − max(1, n − limit[j]) + 1) ways. Sort the capped limits and use prefix sums to add all pairs fast.',
    g: R => ({ n: R.int(2, 6), limit: R.ints(R.int(2, 4), 1, 6) }),
    s(I, T) { const n = I.n, L = I.limit, m = L.length, w = (i, j) => Math.max(0, Math.min(L[i], n - 1) - Math.max(1, n - L[j]) + 1); let tot = 0, asks = 0; for (let i = 0; i < m; i++) for (let j = 0; j < m; j++) if (i !== j) { const c = w(i, j); tot += c; if (asks++ < 5) { T.at({ n, limit: A(L, { i, j }) }); T.n(`Ways with color ${i} first and color ${j} second?`, c, `First length x with max(1, n − ${L[j]}) at most x at most min(${L[i]}, n − 1).`); } } return tot % MOD; }
  });

  D('check-digitorial-permutation', {
    t: 'Check Digitorial Permutation',
    r: 'The sum of digit factorials is the same for every permutation. Compute it once and check whether its digits are a rearrangement of n\'s digits (the sum never has a leading zero).',
    g: R => ({ n: R.pick([145, 154, 541, 10, 1, 2, 40585, 58045, R.int(1, 999)]) }),
    s(I, T) { const f = [1, 1, 2, 6, 24, 120, 720, 5040, 40320, 362880], d = String(I.n).split(''), s = sum(d.map(x => f[+x])); T.at({ digits: A(d), factorials: A(d.map(x => f[+x])) }); T.n('How many digits?', d.length, 'Each contributes its factorial.'); T.n('Sum of the digit factorials?', s, 'The same for every permutation.'); const ok = String(s).split('').sort().join('') === d.slice().sort().join(''); T.yn(`Are the digits of ${s} a permutation of ${I.n}'s digits?`, ok, ok ? 'That permutation is digitorial.' : 'No arrangement can equal the sum.'); return ok; }
  });

  D('sum-of-gcd-of-formed-pairs', {
    t: 'Sum of GCD of Formed Pairs',
    r: 'Build prefixGcd with a running maximum, sort it, then pair the smallest and largest with two pointers moving inward, adding gcd of each pair.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12) }),
    s(I, T) { let mx = 0; const pg = I.nums.map(x => { mx = Math.max(mx, x); return gcd(x, mx); }); T.at({ nums: A(I.nums), prefixGcd: A(pg) }); T.n('prefixGcd value at the last index?', pg[pg.length - 1], 'gcd(nums[i], running max).'); const s = pg.slice().sort((a, b) => a - b); let i = 0, j = s.length - 1, tot = 0; while (i < j) { const g = gcd(s[i], s[j]); tot += g; if (i < 3) { T.at({ sorted: A(s, { i, j }) }); T.n(`gcd of the pair (${s[i]}, ${s[j]})?`, g, 'Smallest with largest.'); } i++; j--; } return tot; }
  });

  D('count-commas-in-range-ii', {
    t: 'Count Commas in Range II',
    r: 'A number gets one comma for each power of 1000 (1000, 1000000, and so on) that it reaches. So for each power p up to n, add n minus p plus 1.',
    g: R => ({ n: R.pick([R.int(1, 5000), R.int(900000, 1200000), R.int(1, 999)]) }),
    s(I, T) { const res = (() => { let tot = 0; for (let p = 1000, t = 1; p <= Math.max(I.n, 1000); p *= 1000, t++) { const c = Math.max(0, I.n - p + 1); tot += c; T.at({ n: I.n, threshold: p }); T.n(`Numbers up to n with at least ${t} commas?`, c, `Those at least ${p}.`); if (p > I.n) break; } return tot; })(); T.n('Total commas?', res, 'Add the counts for each comma level.'); return res; }
  });

  D('construct-uniform-parity-array-ii', {
    t: 'Construct Uniform Parity Array II',
    r: 'Subtraction must give a positive result. All-even works only if there is no odd number (the smallest odd can never be fixed). All-odd works if every even number is larger than the smallest odd (subtract that odd). Check both.',
    g: R => ({ nums1: R.distinct(R.int(1, 5), 1, 12) }),
    s(I, T) { const od = I.nums1.filter(x => x % 2), ev = I.nums1.filter(x => x % 2 === 0); T.at({ nums1: A(I.nums1) }); T.yn('Are all numbers already even?', !od.length, od.length ? 'Some odd number exists.' : 'Done: all even.'); if (!od.length) return true; const m = Math.min(...od); T.n('Smallest odd number?', m, 'Every even number would subtract it.'); let ok = true; ev.slice(0, 4).forEach(x => { T.yn(`Can ${x} become odd?`, x > m, x > m ? `${x} − ${m} is odd and positive.` : `${x} is smaller than every odd number.`); if (x <= m) ok = false; }); return ev.every(x => x > m); }
  });

  D('integers-with-multiple-sum-of-two-cubes', {
    t: 'Integers With Multiple Sum of Two Cubes',
    r: 'Enumerate pairs a at most b with a³ + b³ at most n (only about 1000 values of b) and count each sum in a hash map. Sums seen at least twice are good; sort them.',
    g: R => ({ n: R.pick([1729, 4104, 578, 5000, 20683, 13832, 40000]) }),
    s(I, T) { const c = new Map(); for (let a = 1; 2 * a * a * a <= I.n; a++) for (let b = a; a * a * a + b * b * b <= I.n; b++) { const v = a * a * a + b * b * b; c.set(v, (c.get(v) || 0) + 1); } const good = [...c].filter(([, x]) => x >= 2).map(([v]) => v).sort((a, b) => a - b); T.at({ n: I.n }); T.n('Largest b worth trying (b³ at most n)?', Math.floor(Math.cbrt(I.n + 0.5)), 'Any bigger cube already exceeds n.'); T.n('How many good integers are there?', good.length, 'Sums reached by two different pairs.'); if (good.length) T.c('Smallest good integer?', [good[0], 1729, 4104, 13832].filter((x, i, s) => s.indexOf(x) === i), good[0], 'The first sum counted twice.'); return good; }
  });
})();
