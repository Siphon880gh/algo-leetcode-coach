/* v2 games: math (02). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const pal = s => { s = String(s); return s === [...s].reverse().join(''); };
  const isPrime = n => { if (n < 2) return false; for (let d = 2; d * d <= n; d++) if (n % d === 0) return false; return true; };
  const ptSet = (R, k, M) => { const s = new Set(); while (s.size < k) s.add(R.int(0, M) + ',' + R.int(0, M)); return [...s].map(p => p.split(',').map(Number)); };
  const MOD = 1e9 + 7;

  D('minimum-time-difference', {
    t: 'Minimum Time Difference: sort the minutes, check the wrap',
    r: 'Convert each "HH:MM" to minutes and sort. The answer is the smallest gap between neighbors, or the wrap-around gap first + 1440 − last.',
    g: R => ({ timePoints: Array.from({ length: R.int(2, 5) }, () => `${String(R.int(0, 23)).padStart(2, '0')}:${String(R.int(0, 59)).padStart(2, '0')}`) }),
    s(I, T) { const m = I.timePoints.map(t => +t.slice(0, 2) * 60 + +t.slice(3)).sort((a, b) => a - b); let best = 1440 + m[0] - m[m.length - 1]; for (let i = 1; i < m.length; i++) { T.at({ minutes: A(m, { hl: [i - 1, i] }), best }); T.n(`Gap between ${m[i - 1]} and ${m[i]}?`, m[i] - m[i - 1], 'Neighbors after sorting.'); best = Math.min(best, m[i] - m[i - 1]); } T.at({ minutes: A(m, { hl: [0, m.length - 1] }) }); T.n('Wrap-around gap (first + 1440 − last)?', 1440 + m[0] - m[m.length - 1], 'Across midnight.'); return best; }
  });

  D('optimal-division', {
    t: 'Optimal Division: divide by as little as possible',
    r: 'a / b / c / … is largest when everything after a is divided as much as possible: a / (b / c / … / z) divides a only by b and multiplies by the rest. With 1 or 2 numbers no parentheses are needed.',
    g: R => ({ nums: R.ints(R.int(1, 5), 2, 20) }),
    s(I, T) { const a = I.nums; T.at({ nums: A(a) }); T.c('Best shape?', ['a', 'a/b', 'a/(b/c/…)'], a.length === 1 ? 'a' : a.length === 2 ? 'a/b' : 'a/(b/c/…)', 'Divide a by b only, and multiply back everything after b.'); return a.length === 1 ? String(a[0]) : a.length === 2 ? a.join('/') : `${a[0]}/(${a.slice(1).join('/')})`; }
  });

  D('find-the-closest-palindrome', {
    t: 'Find the Closest Palindrome: mirror the prefix ±1',
    r: 'Candidates: mirror the first half using prefix − 1, prefix and prefix + 1, plus 99…9 (one digit shorter) and 10…01 (one digit longer). Skip n itself; take the closest, smaller on ties.',
    g: R => ({ n: String(R.pick([R.int(1, 9), R.int(10, 999), R.int(1000, 99999), 99, 100, 1001])) }),
    s(I, T) {
      const s = I.n, L = s.length, n = BigInt(s), h = s.slice(0, Math.ceil(L / 2)), mir = p => { const t = String(p); return BigInt(t + [...t.slice(0, L % 2 ? t.length - 1 : t.length)].reverse().join('')); };
      const c = new Set([10n ** BigInt(L - 1) - 1n, 10n ** BigInt(L) + 1n]); for (const d of [-1n, 0n, 1n]) { const p = BigInt(h) + d; if (p >= 0n) c.add(mir(p)); }
      T.at({ n: s, prefix: h }); T.n('Mirror of the prefix itself?', Number(mir(BigInt(h))), 'Copy the first half onto the second, reversed.');
      let best = null; for (const v of [...c].sort((a, b) => (a < b ? -1 : 1))) { if (v === n || v < 0n) continue; const d = v > n ? v - n : n - v; if (best === null || d < best[1]) best = [v, d]; }
      T.n('Distance from n to the closest palindrome?', Number(best[1]), 'Smallest distance among the candidates.'); return String(best[0]);
    }
  });

  D('erect-the-fence', {
    t: 'Erect the Fence: monotone chain that keeps collinear points',
    r: 'Sort points by x, then y. Build the lower hull and then the upper hull, popping the last point only when the turn is clockwise (cross < 0), so points on edges stay. Merge without duplicates.',
    g: R => ({ trees: ptSet(R, R.int(3, 6), 4) }), cmp: 'set',
    s(I, T) { const p = I.trees.slice().sort((a, b) => a[0] - b[0] || a[1] - b[1]), cr = (o, a, b) => (a[0] - o[0]) * (b[1] - o[1]) - (a[1] - o[1]) * (b[0] - o[0]), h = []; const run = pts => { const st = []; for (const q of pts) { while (st.length >= 2 && cr(st[st.length - 2], st[st.length - 1], q) < 0) { T.at({ hull: A(st.map(x => `(${x})`)), next: `(${q})` }); T.yn(`Pop (${st[st.length - 1]}) before adding (${q})?`, true, 'Clockwise turn: it is inside.'); st.pop(); } st.push(q); } return st; }; const lo = run(p), up = run(p.slice().reverse()); const set = new Map(); [...lo, ...up].forEach(q => set.set(q.join(), q)); T.at({ trees: A(p.map(x => `(${x})`)) }); T.n('How many trees are on the fence?', set.size, 'Union of the lower and upper hulls.'); return [...set.values()]; }
  });

  D('fraction-addition-and-subtraction', {
    t: 'Fraction Addition and Subtraction: running fraction, reduced',
    r: 'Parse each ±a/b. Keep a running fraction n/d: n = n·b + a·d, d = d·b, then divide both by their gcd. An integer result is written over 1.',
    g: R => ({ expression: Array.from({ length: R.int(2, 4) }, (_, i) => (R.chance(0.5) ? '-' : i ? '+' : '') + R.int(1, 5) + '/' + R.int(1, 6)).join('') }),
    s(I, T) { let n = 0, d = 1; for (const m of I.expression.matchAll(/[+-]?\d+\/\d+/g)) { const [a, b] = m[0].split('/').map(Number); n = n * b + a * d; d *= b; const g = gcd(n, d) || 1; n /= g; d /= g; T.at({ expression: I.expression, added: m[0], denominator: d }); T.n(`Numerator after adding ${m[0]} (reduced, over ${d})?`, n, 'Cross-multiply, then reduce by the gcd.'); } return `${n}/${d}`; }
  });

  D('valid-square', {
    t: 'Valid Square: six distances, two values',
    r: 'Compute all 6 squared distances and sort. A square has 4 equal positive sides and 2 equal diagonals, each diagonal² = 2 · side².',
    g: R => { if (R.chance(0.5)) { const x = R.int(-3, 3), y = R.int(-3, 3), a = R.int(0, 3), b = R.int(1, 3); return { p1: [x, y], p2: [x + a, y + b], p3: [x + a - b, y + b + a], p4: [x - b, y + a] }; } return { p1: [R.int(0, 3), R.int(0, 3)], p2: [R.int(0, 3), R.int(0, 3)], p3: [R.int(0, 3), R.int(0, 3)], p4: [R.int(0, 3), R.int(0, 3)] }; },
    s(I, T) { const p = [I.p1, I.p2, I.p3, I.p4], d = []; for (let i = 0; i < 4; i++) for (let j = i + 1; j < 4; j++) d.push((p[i][0] - p[j][0]) ** 2 + (p[i][1] - p[j][1]) ** 2); d.sort((a, b) => a - b); T.at({ points: A(p.map(q => `(${q})`)) }); T.n('Smallest squared distance?', d[0], 'Should be the side² (and positive).'); T.n('Largest squared distance?', d[5], 'Should be the diagonal² = 2 · side².'); return d[0] > 0 && d[0] === d[3] && d[4] === d[5] && d[4] === 2 * d[0]; }
  });

  D('maximum-product-of-three-numbers', {
    t: 'Maximum Product of Three: top three or two most negative',
    r: 'After sorting, the best is either the three largest, or the two smallest (most negative) times the largest.',
    g: R => ({ nums: R.ints(R.int(3, 6), -9, 9) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length, p1 = a[n - 1] * a[n - 2] * a[n - 3], p2 = a[0] * a[1] * a[n - 1]; T.at({ sorted: A(a) }); T.n('Product of the three largest?', p1, 'Last three after sorting.'); T.n('Two smallest × largest?', p2, 'Two negatives make a positive.'); return Math.max(p1, p2); }
  });

  D('solve-the-equation', {
    t: 'Solve the Equation: collect x terms and constants',
    r: 'Parse both sides into (x coefficient, constant). Move x to the left and numbers to the right: a·x = b. a = 0: infinite if b = 0, else none; otherwise x = b / a.',
    g: R => { const side = () => Array.from({ length: R.int(1, 3) }, (_, i) => { const c = R.int(0, 4), t = R.chance(0.5) ? (c === 1 ? '' : c) + 'x' : String(c); return (i ? R.pick(['+', '-']) : R.chance(0.3) ? '-' : '') + t; }).join(''); return { equation: side() + '=' + side() }; },
    s(I, T) { const parse = s => { let x = 0, c = 0; for (const m of s.matchAll(/[+-]?\d*x|[+-]?\d+/g)) { const t = m[0]; if (t.endsWith('x')) { const k = t.slice(0, -1); x += k === '' || k === '+' ? 1 : k === '-' ? -1 : +k; } else c += +t; } return [x, c]; }; const [l, r] = I.equation.split('='), [a1, c1] = parse(l), [a2, c2] = parse(r), a = a1 - a2, b = c2 - c1; T.at({ equation: I.equation }); T.n('x coefficient after moving x to the left?', a, 'Left x terms − right x terms.'); T.n('Constant after moving numbers to the right?', b, 'Right numbers − left numbers.'); if (a === 0) return b === 0 ? 'Infinite solutions' : 'No solution'; return 'x=' + b / a; }
  });

  D('remove-9', {
    t: 'Remove 9: the answer is n in base 9',
    r: 'Numbers without the digit 9 are exactly the base-9 numerals read in base 10, so the n-th one is n written in base 9.',
    g: R => ({ n: R.int(1, 800) }),
    s(I, T) { let n = I.n, out = ''; while (n) { T.at({ n, digits: out || '—' }); T.n(`${n} mod 9?`, n % 9, 'Next base-9 digit from the right.'); out = (n % 9) + out; n = Math.floor(n / 9); } return +out; }
  });

  D('beautiful-arrangement-ii', {
    t: 'Beautiful Arrangement II: zigzag for k distinct gaps',
    r: 'Alternate 1, k+1, 2, k, 3, … across the first k+1 numbers: the gaps are k, k−1, …, 1. Then append k+2 … n in order (gap 1 again).',
    g: R => { const n = R.int(2, 8); return { n, k: R.int(1, n - 1) }; },
    cmp: (out, exp, I) => out.length === I.n && new Set(out).size === I.n && out.every(v => v >= 1 && v <= I.n) && new Set(out.slice(1).map((v, i) => Math.abs(v - out[i]))).size === I.k,
    s(I, T) { const out = []; let lo = 1, hi = I.k + 1; for (let i = 0; i <= I.k; i++) { const v = i % 2 ? hi-- : lo++; T.at({ n: I.n, k: I.k, built: A(out) }); T.n(`Value at position ${i}?`, v, i % 2 ? 'Take from the high end.' : 'Take from the low end.'); out.push(v); } for (let v = I.k + 2; v <= I.n; v++) out.push(v); return out; }
  });

  D('self-dividing-numbers', {
    t: 'Self Dividing Numbers: test every digit',
    r: 'For each number in range, every digit must be non-zero and divide the number.',
    g: R => { const l = R.int(1, 60); return { left: l, right: l + R.int(0, 15) }; },
    s(I, T) { const out = []; for (let x = I.left; x <= I.right; x++) { const ok = [...String(x)].every(d => d !== '0' && x % +d === 0); T.at({ x, found: A(out) }); T.yn(`Is ${x} self-dividing?`, ok, 'No zero digit, and every digit divides it.'); if (ok) out.push(x); } return out; }
  });

  D('reach-a-number', {
    t: 'Reach a Number: overshoot by an even amount',
    r: 'Use |target|. Keep taking steps 1, 2, 3, … until the sum reaches the target and (sum − target) is even; flipping one step of size (sum − target)/2 then lands exactly.',
    g: R => ({ target: R.pick([-1, 1]) * R.int(1, 30) }),
    s(I, T) { const t = Math.abs(I.target); let k = 0, s = 0; while (s < t || (s - t) % 2) { k++; s += k; T.at({ target: t, step: k }); T.n(`Sum after step ${k}?`, s, 'Add the step size.'); } return k; }
  });

  D('basic-calculator-iv', {
    t: 'Basic Calculator IV: polynomials as term maps',
    r: 'Substitute known variables. Parse with precedence (parentheses, then *, then + −), where each value is a polynomial: a map from a sorted variable list to its coefficient. Output by degree (high first), then lexicographic; skip zero terms.',
    g: R => { const atom = () => R.chance(0.5) ? R.pick(['a', 'b', 'e', 'x']) : String(R.int(0, 9)), part = d => d && R.chance(0.5) ? '(' + part(d - 1) + ' ' + R.pick(['+', '-']) + ' ' + part(d - 1) + ')' : atom(); const e = Array.from({ length: R.int(2, 3) }, () => part(1)).map((t, i) => (i ? R.pick([' + ', ' - ', ' * ']) : '') + t).join(''); const vars = R.chance(0.6) ? ['e'] : []; return { expression: e, evalvars: vars, evalints: vars.map(() => R.int(1, 5)) }; },
    s(I, T) {
      const env = {}; I.evalvars.forEach((v, i) => env[v] = I.evalints[i]);
      const tok = I.expression.replace(/\(/g, ' ( ').replace(/\)/g, ' ) ').split(/\s+/).filter(Boolean); let p = 0;
      const add = (a, b, sg) => { const r = new Map(a); for (const [k, v] of b) r.set(k, (r.get(k) || 0) + sg * v); return r; }, mul = (a, b) => { const r = new Map(); for (const [k1, v1] of a) for (const [k2, v2] of b) { const k = [...(k1 ? k1.split('*') : []), ...(k2 ? k2.split('*') : [])].sort().join('*'); r.set(k, (r.get(k) || 0) + v1 * v2); } return r; };
      const factor = () => { const t = tok[p++]; if (t === '(') { const v = expr(); p++; return v; } if (/^\d+$/.test(t)) return new Map([['', +t]]); return t in env ? new Map([['', env[t]]]) : new Map([[t, 1]]); };
      const term = () => { let v = factor(); while (tok[p] === '*') { p++; v = mul(v, factor()); } return v; };
      const expr = () => { let v = term(); while (tok[p] === '+' || tok[p] === '-') { const o = tok[p++]; v = add(v, term(), o === '+' ? 1 : -1); } return v; };
      const res = [...expr()].filter(([, v]) => v !== 0), deg = k => k ? k.split('*').length : 0;
      res.sort((x, y) => { if (deg(y[0]) !== deg(x[0])) return deg(y[0]) - deg(x[0]); const a = x[0].split('*'), b = y[0].split('*'); for (let i = 0; i < a.length; i++) if (a[i] !== b[i]) return a[i] < b[i] ? -1 : 1; return 0; });
      T.at({ expression: I.expression, known: K(env) }); T.n('Constant term of the simplified result?', (res.find(r => r[0] === '') || [, 0])[1], 'Collect everything with no variables.'); T.n('How many non-zero terms?', res.length, 'Merge equal variable lists; drop zeros.');
      return res.map(([k, v]) => k ? `${v}*${k}` : String(v));
    }
  });

  D('global-and-local-inversions', {
    t: 'Global and Local Inversions: nothing may move more than one place',
    r: 'Every local inversion is global. They are equal exactly when no element sits more than one position away from its value: |nums[i] − i| ≤ 1 for all i.',
    g: R => { const n = R.int(3, 6), a = [...Array(n).keys()]; if (R.chance(0.5)) { for (let i = 0; i + 1 < n; i++) if (R.chance(0.4)) { [a[i], a[i + 1]] = [a[i + 1], a[i]]; i++; } return { nums: a }; } return { nums: R.shuffle(a) }; },
    s(I, T) { for (let i = 0; i < I.nums.length; i++) { const bad = Math.abs(I.nums[i] - i) > 1; T.at({ nums: A(I.nums, { hl: [i] }) }); T.yn(`Is ${I.nums[i]} more than one place from index ${i}?`, bad, bad ? 'That creates a non-local global inversion.' : 'Within one place.'); if (bad) return false; } return true; }
  });

  D('reaching-points', {
    t: 'Reaching Points: walk backwards with modulo',
    r: 'From (tx, ty) the previous point is unique: subtract the smaller from the larger. Subtract many times at once with modulo, stopping when you reach the start row or column.',
    g: R => { let x = R.int(1, 3), y = R.int(1, 3); const s = [x, y]; for (let i = 0; i < R.int(1, 4); i++) R.chance(0.5) ? x += y : y += x; if (R.chance(0.3)) x += 1; return { sx: s[0], sy: s[1], tx: x, ty: y }; },
    s(I, T) { let { sx, sy, tx, ty } = I; while (tx >= sx && ty >= sy) { if (tx === ty) break; T.at({ start: `(${sx},${sy})`, now: `(${tx},${ty})` }); if (tx > ty) { if (ty > sy) { T.n(`x after stepping back (${tx} mod ${ty})?`, tx % ty, 'Undo many (x + y, y) steps at once.'); tx %= ty; } else return (tx - sx) % ty === 0; } else { if (tx > sx) { T.n(`y after stepping back (${ty} mod ${tx})?`, ty % tx, 'Undo many (x, x + y) steps at once.'); ty %= tx; } else return (ty - sy) % tx === 0; } } return tx === sx && ty === sy; }
  });

  D('escape-the-ghosts', {
    t: 'Escape the Ghosts: compare Manhattan distances',
    r: 'A ghost that can reach the target no later than you can just wait there. You escape only if your distance |x| + |y| is strictly smaller than every ghost\'s distance to the target.',
    g: R => ({ ghosts: Array.from({ length: R.int(1, 3) }, () => [R.int(-4, 4), R.int(-4, 4)]), target: [R.int(-4, 4), R.int(-4, 4)] }),
    s(I, T) { const [x, y] = I.target, me = Math.abs(x) + Math.abs(y); T.at({ target: `(${x},${y})` }); T.n('Your distance to the target?', me, '|x| + |y|.'); for (const g of I.ghosts) { const d = Math.abs(g[0] - x) + Math.abs(g[1] - y); T.at({ target: `(${x},${y})`, ghost: `(${g})`, you: me }); T.n(`Ghost at (${g}): distance to the target?`, d, 'Manhattan distance.'); if (d <= me) return false; } return true; }
  });

  D('similar-rgb-color', {
    t: 'Similar RGB Color: round each channel to a multiple of 17',
    r: 'Shorthand channels are 0x00, 0x11, …, 0xff (multiples of 17). Each channel independently goes to the nearest multiple: round(v / 17) · 17.',
    g: R => ({ color: '#' + Array.from({ length: 6 }, () => '0123456789abcdef'[R.int(0, 15)]).join('') }),
    s(I, T) { let out = '#'; for (let i = 1; i < 7; i += 2) { const v = parseInt(I.color.slice(i, i + 2), 16), r = Math.round(v / 17) * 17; T.at({ color: I.color, channel: I.color.slice(i, i + 2) + ` = ${v}` }); T.n(`Nearest shorthand value for ${v}?`, r, `round(${v} / 17) · 17.`); out += r.toString(16).padStart(2, '0'); } return out; }
  });

  D('largest-triangle-area', {
    t: 'Largest Triangle Area: shoelace over every triple',
    r: 'Try every triple; area = |x1(y2 − y3) + x2(y3 − y1) + x3(y1 − y2)| / 2. Keep the maximum.',
    g: R => ({ points: ptSet(R, R.int(3, 5), 3) }), cmp: 'float',
    s(I, T) { const p = I.points, n = p.length; let best = 0; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) for (let k = j + 1; k < n; k++) { const [a, b, c] = [p[i], p[j], p[k]], ar = Math.abs(a[0] * (b[1] - c[1]) + b[0] * (c[1] - a[1]) + c[0] * (a[1] - b[1])) / 2; T.at({ triangle: `(${a}) (${b}) (${c})`, best }); T.n('Area of this triangle?', ar, 'Shoelace formula, halved.'); best = Math.max(best, ar); } return best; }
  });

  D('friends-of-appropriate-ages', {
    t: 'Friends of Appropriate Ages: count by age',
    r: 'Count people per age. x sends to y unless age[y] ≤ 0.5·age[x] + 7, age[y] > age[x], or (age[y] > 100 and age[x] < 100). Pairs of ages a, b give cnt[a] · (cnt[b] − [a = b]) requests.',
    g: R => ({ ages: R.ints(R.int(2, 6), 14, 30) }),
    s(I, T) { const c = {}; I.ages.forEach(a => c[a] = (c[a] || 0) + 1); const ok = (x, y) => !(y <= 0.5 * x + 7 || y > x || (y > 100 && x < 100)); let tot = 0; for (const a of Object.keys(c).map(Number).sort((x, y) => x - y)) { let s = 0; for (const b of Object.keys(c).map(Number)) if (ok(a, b)) s += c[a] * (c[b] - (a === b ? 1 : 0)); T.at({ counts: K(c), total: tot }); T.n(`Requests sent by everyone aged ${a}?`, s, `Targets need age > ${0.5 * a + 7} and ≤ ${a}.`); tot += s; } return tot; }
  });

  D('consecutive-numbers-sum', {
    t: 'Consecutive Numbers Sum: try each length k',
    r: 'k consecutive numbers from x sum to k·x + k(k − 1)/2. For each k with k(k − 1)/2 < n, it works when (n − k(k − 1)/2) is divisible by k.',
    g: R => ({ n: R.int(1, 60) }),
    s(I, T) { let c = 0; for (let k = 1; k * (k - 1) / 2 < I.n; k++) { const r = I.n - k * (k - 1) / 2, ok = r % k === 0; T.at({ n: I.n, k, ways: c }); T.yn(`Can ${I.n} be ${k} consecutive numbers?`, ok, `${I.n} − ${k * (k - 1) / 2} = ${r}${ok ? ` = ${k}·${r / k}` : ` is not divisible by ${k}`}.`); if (ok) c++; } return c; }
  });

  D('rectangle-overlap', {
    t: 'Rectangle Overlap: positive overlap on both axes',
    r: 'Overlap width = min(right edges) − max(left edges), height likewise. They overlap only if both are positive (touching edges do not count).',
    g: R => { const r = () => { const x = R.int(-3, 3), y = R.int(-3, 3); return [x, y, x + R.int(1, 4), y + R.int(1, 4)]; }; return { rec1: r(), rec2: r() }; },
    s(I, T) { const [a, b] = [I.rec1, I.rec2], w = Math.min(a[2], b[2]) - Math.max(a[0], b[0]), h = Math.min(a[3], b[3]) - Math.max(a[1], b[1]); T.at({ rec1: `[${a}]`, rec2: `[${b}]` }); T.n('Overlap along x (may be ≤ 0)?', w, 'min(x2) − max(x1).'); T.n('Overlap along y (may be ≤ 0)?', h, 'min(y2) − max(y1).'); return w > 0 && h > 0; }
  });

  D('prime-palindrome', {
    t: 'Prime Palindrome: palindromes first, then primality',
    r: 'Walk upward checking palindromes before primality (cheaper). Even-length palindromes are divisible by 11, so above 11 only odd lengths matter: generate them from their first half.',
    g: R => ({ n: R.int(1, 200) }),
    s(I, T) { for (let m = Math.max(I.n, 2); ; m++) { if (!pal(m)) continue; const p = isPrime(m); T.at({ n: I.n, candidate: m }); T.yn(`${m} is a palindrome. Is it prime?`, p, p ? 'No divisor up to √m.' : 'It has a divisor.'); if (p) return m; } }
  });

  D('reordered-power-of-2', {
    t: 'Reordered Power of 2: compare digit counts',
    r: 'Reordering keeps the multiset of digits. Sort n\'s digits and compare with the sorted digits of every power of two with the same length.',
    g: R => ({ n: R.pick([R.int(1, 9999), 2 ** R.int(0, 13), +[...String(2 ** R.int(4, 13))].reverse().join('')]) }),
    s(I, T) { const sig = x => [...String(x)].sort().join(''), s = sig(I.n); for (let p = 1; p <= 1e9; p *= 2) { if (String(p).length !== String(I.n).length) continue; const ok = sig(p) === s; T.at({ n: I.n, sorted: s, power: p }); T.yn(`Does ${p} use the same digits?`, ok, `sorted ${sig(p)} vs ${s}.`); if (ok) return true; } return false; }
  });

  D('fair-candy-swap', {
    t: 'Fair Candy Swap: b = a + (sumB − sumA) / 2',
    r: 'Swapping a for b changes Alice\'s total by b − a; it must be half the difference. Put Bob\'s boxes in a set and look for a + delta.',
    g: R => { const a = R.ints(R.int(1, 3), 1, 6), b = R.ints(R.int(1, 3), 1, 6), x = R.pick(a), y = R.pick(b); const sa = a.reduce((s, v) => s + v, 0), sb = b.reduce((s, v) => s + v, 0); const fix = (sb - sa) - 2 * (y - x); if (fix % 2 === 0 && fix !== 0 && b.length) { b.push(Math.abs(fix) + 1); } return { aliceSizes: a, bobSizes: b }; },
    cmp: (out, exp, I) => { if (!Array.isArray(out) || out.length !== 2) return false; const sa = I.aliceSizes.reduce((s, v) => s + v, 0), sb = I.bobSizes.reduce((s, v) => s + v, 0); return I.aliceSizes.includes(out[0]) && I.bobSizes.includes(out[1]) && sa - out[0] + out[1] === sb - out[1] + out[0]; },
    s(I, T) { const sa = I.aliceSizes.reduce((s, v) => s + v, 0), sb = I.bobSizes.reduce((s, v) => s + v, 0), d = (sb - sa) / 2, B = new Set(I.bobSizes); T.at({ alice: A(I.aliceSizes), bob: A(I.bobSizes) }); T.n('delta = (sumB − sumA) / 2?', d, `(${sb} − ${sa}) / 2.`); for (const a of I.aliceSizes) if (B.has(a + d)) return [a, a + d]; return []; }
  });

  D('sum-of-subsequence-widths', {
    t: 'Sum of Subsequence Widths: count max and min roles',
    r: 'Sort. a[i] is the maximum of 2^i subsequences and the minimum of 2^(n−1−i). Its contribution is a[i] · (2^i − 2^(n−1−i)).',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 9) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length; let tot = 0; a.forEach((x, i) => { const c = x * (2 ** i - 2 ** (n - 1 - i)); T.at({ sorted: A(a, { hl: [i] }), total: tot }); T.n(`Contribution of index ${i}?`, c, `${x} · (2^${i} − 2^${n - 1 - i}).`); tot += c; }); return ((tot % MOD) + MOD) % MOD; }
  });

  D('orderly-queue', {
    t: 'Orderly Queue: rotations for k = 1, sorting otherwise',
    r: 'With k = 1 you can only rotate, so take the smallest rotation. With k ≥ 2 you can swap any adjacent pair, so any order is reachable: return the sorted string.',
    g: R => ({ s: R.str(R.int(3, 6), 'abc'), k: R.int(1, 3) }),
    s(I, T) { const s = I.s; T.at({ s, k: I.k }); T.yn('Can every ordering be reached?', I.k > 1, I.k > 1 ? 'Two front choices let you swap neighbors.' : 'Only rotations are possible.'); if (I.k > 1) return [...s].sort().join(''); let best = s, bi = 0; for (let i = 1; i < s.length; i++) { const r = s.slice(i) + s.slice(0, i); if (r < best) { best = r; bi = i; } } T.n('Start index of the smallest rotation?', bi, 'Compare every rotation.'); return best; }
  });

  D('super-palindromes', {
    t: 'Super Palindromes: square the palindromes',
    r: 'A super-palindrome is p² with p a palindrome. Enumerate palindromes p up to √right (built from halves) and count those whose square is a palindrome inside [left, right].',
    g: R => { const l = R.int(1, 500); return { left: String(l), right: String(l + R.int(0, 20000)) }; },
    s(I, T) { const L = BigInt(I.left), Rr = BigInt(I.right); let c = 0; for (let p = 1n; p * p <= Rr; p++) { if (!pal(p)) continue; const q = p * p; if (q < L) continue; const ok = pal(q); T.at({ left: I.left, right: I.right, p: String(p) }); T.yn(`Is ${q} (= ${p}²) a palindrome?`, ok, 'Read it backward.'); if (ok) c++; } return c; }
  });

  D('smallest-range-i', {
    t: 'Smallest Range I: shrink the gap by 2k',
    r: 'Raise the minimum by k and lower the maximum by k. The score is max(0, max − min − 2k).',
    g: R => ({ nums: R.ints(R.int(1, 5), 0, 20), k: R.int(0, 6) }),
    s(I, T) { const d = Math.max(...I.nums) - Math.min(...I.nums); T.at({ nums: A(I.nums), k: I.k }); T.n('max − min?', d, 'The original range.'); return Math.max(0, d - 2 * I.k); }
  });

  D('x-of-a-kind-in-a-deck-of-cards', {
    t: 'X of a Kind in a Deck: gcd of the counts',
    r: 'A group size X must divide every value\'s count. Such an X ≥ 2 exists exactly when the gcd of all counts is at least 2.',
    g: R => ({ deck: R.shuffle(Array.from({ length: R.int(1, 3) }, () => Array(R.pick([1, 2, 2, 3, 4, 6])).fill(R.int(0, 9))).flat()) }),
    s(I, T) { const c = {}; I.deck.forEach(x => c[x] = (c[x] || 0) + 1); const g = Object.values(c).reduce(gcd, 0); T.at({ counts: K(c) }); T.n('gcd of the counts?', g, 'The largest group size that fits every value.'); return g >= 2; }
  });

  D('beautiful-array', {
    t: 'Beautiful Array: odds then evens, recursively',
    r: 'If A is beautiful, so are 2·A − 1 (odd) and 2·A (even), and odd + even can never be twice anything between them. Build f(n) = odds from f(⌈n/2⌉) followed by evens from f(⌊n/2⌋).',
    g: R => ({ n: R.int(1, 10) }),
    cmp: (out, exp, I) => { const n = I.n; if (out.length !== n || new Set(out).size !== n || out.some(v => v < 1 || v > n)) return false; for (let i = 0; i < n; i++) for (let k = i + 1; k < n; k++) for (let j = k + 1; j < n; j++) if (2 * out[k] === out[i] + out[j]) return false; return true; },
    s(I, T) { const f = n => { if (n === 1) return [1]; T.at({ n }); T.n(`For n = ${n}: how many odd numbers go first?`, Math.ceil(n / 2), 'All odd values 1, 3, … ≤ n.'); return [...f(Math.ceil(n / 2)).map(x => 2 * x - 1), ...f(Math.floor(n / 2)).map(x => 2 * x)]; }; return f(I.n); }
  });

  D('minimum-area-rectangle', {
    t: 'Minimum Area Rectangle: pick a diagonal, look up the other corners',
    r: 'Put the points in a set. For every pair that differs in both x and y, treat it as a diagonal: if (x1, y2) and (x2, y1) exist, it is a rectangle. Keep the smallest area.',
    g: R => ({ points: ptSet(R, R.int(4, 7), 3) }),
    s(I, T) { const p = I.points, S = new Set(p.map(q => q.join())); let best = Infinity; for (let i = 0; i < p.length; i++) for (let j = i + 1; j < p.length; j++) { const [a, b] = [p[i], p[j]]; if (a[0] === b[0] || a[1] === b[1]) continue; if (S.has([a[0], b[1]].join()) && S.has([b[0], a[1]].join())) { const ar = Math.abs(a[0] - b[0]) * Math.abs(a[1] - b[1]); T.at({ points: A(p.map(q => `(${q})`), { hl: [i, j] }), best: best === Infinity ? '—' : best }); T.n(`Diagonal (${a})–(${b}) closes a rectangle. Area?`, ar, '|dx| · |dy|.'); best = Math.min(best, ar); } } return best === Infinity ? 0 : best; }
  });

  D('minimum-area-rectangle-ii', {
    t: 'Minimum Area Rectangle II: right angle plus the fourth corner',
    r: 'For each corner p and two others q, r with (q − p)·(r − p) = 0, the fourth corner is q + r − p. If it exists, the area is |pq| · |pr|. (Faster: group diagonals by midpoint and length.)',
    g: R => R.pick([{ points: [[1, 2], [2, 1], [1, 0], [0, 1]] }, { points: [[0, 1], [2, 1], [1, 1], [1, 0], [2, 0]] }, { points: [[0, 0], [2, 1], [1, 3], [-1, 2], [3, 3], [5, 5]] }, { points: ptSet(R, 5, 3) }]), cmp: 'float',
    s(I, T) { const p = I.points, S = new Set(p.map(q => q.join())), seen = new Set(); let best = Infinity; for (const a of p) for (const b of p) for (const c of p) { if (a === b || a === c || b === c) continue; if ((b[0] - a[0]) * (c[0] - a[0]) + (b[1] - a[1]) * (c[1] - a[1]) !== 0) continue; const d = [b[0] + c[0] - a[0], b[1] + c[1] - a[1]]; if (!S.has(d.join())) continue; const key = [a, b, c, d].map(q => q.join()).sort().join('|'); const ar = Math.hypot(b[0] - a[0], b[1] - a[1]) * Math.hypot(c[0] - a[0], c[1] - a[1]); if (!seen.has(key)) { seen.add(key); T.at({ corners: A([a, b, c, d].map(q => `(${q})`)) }); T.n('Area of this rectangle?', ar, '|pq| · |pr|.'); } best = Math.min(best, ar); } return best === Infinity ? 0 : best; }
  });

  D('powerful-integers', {
    t: 'Powerful Integers: two small power loops',
    r: 'Loop over powers of x and of y (stop a loop at once if its base is 1) and collect every sum ≤ bound in a set.',
    g: R => ({ x: R.int(1, 4), y: R.int(1, 4), bound: R.int(0, 40) }), cmp: 'set',
    s(I, T) { const out = new Set(); for (let a = 1; a <= I.bound; a *= I.x) { for (let b = 1; a + b <= I.bound; b *= I.y) { out.add(a + b); if (I.y === 1) break; } if (I.x === 1) break; } T.at({ x: I.x, y: I.y, bound: I.bound }); T.n('How many distinct powerful integers?', out.size, 'Collect x^i + y^j ≤ bound in a set.'); return [...out]; }
  });

  D('equal-rational-numbers', {
    t: 'Equal Rational Numbers: compare exact fractions',
    r: 'Value = I + N/10^n + R/(10^n·(10^r − 1)) for integer part I, non-repeating N (n digits) and repeating R (r digits). Compare the two fractions exactly (note 0.(9) = 1).',
    g: R => R.pick([{ s: '0.(52)', t: '0.5(25)' }, { s: '0.1666(6)', t: '0.166(66)' }, { s: '0.9(9)', t: '1.' }, { s: `${R.int(0, 2)}.${R.int(0, 9)}(${R.int(0, 9)})`, t: `${R.int(0, 2)}.${R.int(0, 9)}${R.int(0, 9)}(${R.int(0, 9)})` }, { s: '1.(0)', t: '1' }]),
    s(I, T) {
      const parse = s => { const m = s.match(/^(\d+)(?:\.(\d*)(?:\((\d+)\))?)?$/), ip = BigInt(m[1]), N = m[2] || '', Rp = m[3] || ''; const tn = 10n ** BigInt(N.length); let num = ip * tn + BigInt(N || '0'), den = tn; if (Rp) { const rr = 10n ** BigInt(Rp.length) - 1n; num = num * rr + BigInt(Rp); den = den * rr; } return [num, den, N + (Rp ? Rp.repeat(8) : '')]; };
      const a = parse(I.s), b = parse(I.t); for (const [lab, v] of [['s', a], ['t', b]]) { T.at({ s: I.s, t: I.t }); T.n(`First 6 decimal digits of ${lab} (as a number)?`, +(v[2] + '000000').slice(0, 6), 'Write the repeating part out.'); }
      return a[0] * b[1] === b[0] * a[1];
    }
  });

  D('add-to-array-form-of-integer', {
    t: 'Add to Array-Form: fold k into the digits',
    r: 'From the last digit, set cur = digit + k; write cur mod 10 and continue with k = ⌊cur / 10⌋. Keep going while digits or k remain.',
    g: R => ({ num: [R.int(1, 9), ...R.ints(R.int(0, 3), 0, 9)], k: R.int(1, 999) }),
    s(I, T) { const out = []; let k = I.k; for (let i = I.num.length - 1; i >= 0 || k > 0; i--) { const cur = (i >= 0 ? I.num[i] : 0) + k; T.at({ num: A(I.num, { hl: i >= 0 ? [i] : [] }), k, result: A(out.slice().reverse()) }); T.n('Digit written here?', cur % 10, `(${i >= 0 ? I.num[i] : 0} + ${k}) mod 10.`); out.push(cur % 10); k = Math.floor(cur / 10); } return out.reverse(); }
  });

  D('smallest-integer-divisible-by-k', {
    t: 'Smallest Repunit Divisible by K: track the remainder',
    r: 'If k is divisible by 2 or 5, no number of 1s works. Otherwise update r = (r · 10 + 1) mod k; within k steps r hits 0 (pigeonhole). The step count is the length.',
    g: R => ({ k: R.int(1, 50) }),
    s(I, T) { const k = I.k; T.at({ k }); T.yn('Impossible because k is divisible by 2 or 5?', k % 2 === 0 || k % 5 === 0, 'A number of only 1s ends in 1.'); if (k % 2 === 0 || k % 5 === 0) return -1; let r = 0; for (let len = 1; len <= k; len++) { r = (r * 10 + 1) % k; T.at({ k, length: len }); T.n(`Remainder of the ${len}-digit repunit?`, r, '(previous · 10 + 1) mod k.'); if (!r) return len; } return -1; }
  });
})();
