/* v2 games: dynamic programming (9). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const pc = m => { let c = 0; while (m) { c += m & 1; m >>= 1; } return c; };

  D('number-of-ways-to-separate-numbers', {
    t: 'Number of Ways to Separate Numbers: the last number decides',
    r: 'dp[i][j] = ways where the last number is num[i to j]. It may not start with 0. It extends any split whose previous number num[k to i−1] is at most num[i to j] (compare length, then digits).',
    g: R => ({ num: R.str(R.int(3, 5), '0123') }),
    s(I, T) {
      const s = I.num, n = s.length, le = (a, b) => a.length < b.length || (a.length === b.length && a <= b), dp = mk(n, n, 0);
      for (let i = 0; i < n; i++) for (let j = i; j < n; j++) { if (s[i] === '0') continue; if (i === 0) { dp[i][j] = 1; continue; } const cur = s.slice(i, j + 1); for (let k = 0; k < i; k++) if (dp[k][i - 1] && le(s.slice(k, i), cur)) dp[i][j] = (dp[i][j] + dp[k][i - 1]) % MOD; }
      for (let i = 0; i < n; i++) { T.at({ num: A([...s], { win: [i, n - 1] }) }); T.n(`Ways where the last number is "${s.slice(i)}"?`, dp[i][n - 1], s[i] === '0' ? 'It has a leading zero.' : 'Sum the splits whose previous number is not larger.'); }
      return dp.reduce((t, r) => (t + r[n - 1]) % MOD, 0);
    }
  });

  D('minimize-the-difference-between-target-and-chosen-elements', {
    t: 'Minimize the Difference to Target: reachable sums row by row',
    r: 'Keep the set of sums reachable by picking one value per row so far. (Sums far above target can be trimmed to the smallest one.) The answer is the closest sum to target.',
    g: R => ({ mat: R.grid(R.int(2, 3), 3, 1, 6), target: R.int(4, 15) }),
    s(I, T) { let S = new Set([0]); I.mat.forEach((row, r) => { S = new Set([...S].flatMap(s => row.map(v => s + v))); T.at({ mat: G(I.mat, { hl: row.map((_, c) => [r, c]) }), target: I.target }); T.n(`After row ${r}: how many distinct sums are reachable?`, S.size, 'Every previous sum plus every value in the row.'); }); const d = Math.min(...[...S].map(s => Math.abs(s - I.target))); T.n('Smallest |sum − target|?', d, 'Closest reachable sum.'); return d; }
  });

  D('minimum-number-of-work-sessions-to-finish-the-tasks', {
    t: 'Minimum Work Sessions: bitmask of finished tasks',
    r: 'dp[mask] = (sessions, time used in the last session), smallest first. Adding a task fits in the current session if time + task at most sessionTime; otherwise it opens a new one.',
    g: R => ({ tasks: R.ints(R.int(3, 5), 1, 5), sessionTime: R.int(5, 8) }),
    s(I, T) {
      const t = I.tasks, n = t.length, S = I.sessionTime, dp = Array(1 << n).fill(null); dp[0] = [1, 0];
      for (let m = 0; m < 1 << n; m++) if (dp[m]) for (let i = 0; i < n; i++) if (!(m >> i & 1)) { const [s, u] = dp[m], c = u + t[i] <= S ? [s, u + t[i]] : [s + 1, t[i]], nm = m | 1 << i; if (!dp[nm] || c[0] < dp[nm][0] || (c[0] === dp[nm][0] && c[1] < dp[nm][1])) dp[nm] = c; }
      const tot = t.reduce((a, b) => a + b, 0); T.at({ tasks: A(t), session: S }); T.n('Total hours of work?', tot, 'Sum of the tasks.'); T.n('Lower bound on sessions?', Math.ceil(tot / S), `ceil(${tot} divided by ${S}).`); T.n('Fewest sessions?', dp[(1 << n) - 1][0], 'Bitmask DP over finished tasks.');
      return dp[(1 << n) - 1][0];
    }
  });

  D('number-of-unique-good-subsequences', {
    t: 'Number of Unique Good Subsequences: count by last digit',
    r: 'end0 and end1 = distinct good subsequences (starting with 1) ending in 0 or 1. A "1": end1 = end0 + end1 + 1. A "0": end0 = end0 + end1. Add 1 at the end if any 0 exists ("0" itself).',
    g: R => ({ binary: R.str(R.int(4, 6), '01') }),
    s(I, T) { let e0 = 0, e1 = 0, z = 0; [...I.binary].forEach((c, i) => { if (c === '1') e1 = (e0 + e1 + 1) % MOD; else { e0 = (e0 + e1) % MOD; z = 1; } T.at({ binary: A([...I.binary], { hl: [i] }) }); T.n(`After index ${i}: ${c === '1' ? 'end1' : 'end0'}?`, c === '1' ? e1 : e0, c === '1' ? 'Append 1 to everything, plus "1" alone.' : 'Append 0 to everything starting with 1.'); }); return (e0 + e1 + z) % MOD; }
  });

  D('the-number-of-good-subsets', {
    t: 'The Number of Good Subsets: square-free values as prime masks',
    r: 'Only square-free values 2 to 30 can be used; each is a mask of primes. dp over prime masks counts subsets with disjoint masks (multiplied by the value\'s count). Finally multiply by 2 to the power (count of 1s).',
    g: R => ({ nums: R.ints(R.int(4, 6), 1, 10) }),
    s(I, T) {
      const P = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29], mask = x => { let m = 0; for (let i = 0; i < 10; i++) if (x % P[i] === 0) { if (x % (P[i] * P[i]) === 0) return -1; m |= 1 << i; } return m; };
      const cnt = {}; I.nums.forEach(x => cnt[x] = (cnt[x] || 0) + 1); let dp = new Map([[0, 1]]);
      for (const x of Object.keys(cnt).map(Number).sort((a, b) => a - b)) { if (x === 1) continue; const m = mask(x); T.at({ nums: A(I.nums), value: x }); T.yn(`Is ${x} square-free (usable)?`, m >= 0, m >= 0 ? 'No prime divides it twice.' : 'Some prime squared divides it.'); if (m < 0) continue; const nx = new Map(dp); for (const [k, v] of dp) if (!(k & m)) nx.set(k | m, ((nx.get(k | m) || 0) + v * cnt[x]) % MOD); dp = nx; }
      let tot = 0; for (const [k, v] of dp) if (k) tot = (tot + v) % MOD; let p = 1; for (let i = 0; i < (cnt[1] || 0); i++) p = p * 2 % MOD; return tot * p % MOD;
    }
  });

  D('first-day-where-you-have-been-in-all-the-rooms', {
    t: 'First Day in All the Rooms: bounce back, then come again',
    r: 'dp[i] = first day you reach room i. Reaching i+1 means visiting i twice: dp[i+1] = dp[i] + 1 (bounce to nextVisit[i]) + (dp[i] − dp[nextVisit[i]]) (walk back to i) + 1.',
    g: R => ({ nextVisit: Array.from({ length: R.int(3, 5) }, (_, i) => R.int(0, i)) }),
    s(I, T) { const nv = I.nextVisit, dp = [0]; for (let i = 0; i < nv.length - 1; i++) { const v = ((2 * dp[i] - dp[nv[i]] + 2) % MOD + MOD) % MOD; T.at({ nextVisit: A(nv, { hl: [i] }), dp: A(dp.concat('?')) }); T.n(`First day in room ${i + 1}?`, v, `2 times ${dp[i]} − dp[${nv[i]}] + 2.`); dp.push(v); } return dp[nv.length - 1]; }
  });

  D('maximum-earnings-from-taxi', {
    t: 'Maximum Earnings From Taxi: best earnings at each point',
    r: 'dp[p] = best earnings by the time you reach point p = max(dp[p−1], dp[start] + end − start + tip for rides ending at p).',
    g: R => { const n = R.int(6, 9); return { n, rides: Array.from({ length: R.int(3, 4) }, () => { const s = R.int(1, n - 1); return [s, R.int(s + 1, n), R.int(1, 4)]; }) }; },
    s(I, T) { const dp = Array(I.n + 1).fill(0); for (let p = 2; p <= I.n; p++) { dp[p] = dp[p - 1]; const ends = I.rides.filter(r => r[1] === p); for (const [s, e, t] of ends) dp[p] = Math.max(dp[p], dp[s] + e - s + t); if (ends.length) { T.at({ rides: A(I.rides.map(r => r.join(' to ')), { hl: I.rides.map((r, i) => r[1] === p ? i : -1).filter(i => i >= 0) }), dp: A(dp.slice(0, p).concat('?')) }); T.n(`dp[${p}]?`, dp[p], 'Skip, or finish a ride here: dp[start] + length + tip.'); } } return dp[I.n]; }
  });

  D('the-score-of-students-solving-math-expression', {
    t: 'Score of Students: right answer, or right digits in the wrong order',
    r: 'Correct value ( times before +) earns 5. Any value from evaluating the operators in some other order (interval DP of possible results, capped at 1000) earns 2. Anything else 0.',
    g: R => { const d = () => R.int(1, 4), s = `${d()}${R.pick(['+', '*'])}${d()}${R.pick(['+', '*'])}${d()}`, right = s.split('+').reduce((t, p) => t + p.split('*').reduce((q, x) => q * +x, 1), 0), alt = s.match(/\d/g).map(Number); return { s, answers: R.shuffle([right, alt[0] + alt[1] + alt[2], alt[0] * alt[1] * alt[2], (alt[0] + alt[1]) * alt[2], right + R.int(1, 5)]) }; },
    s(I, T) {
      const s = I.s, nums = s.split(/[+*]/).map(Number), ops = s.replace(/\d/g, '').split(''), n = nums.length, P = mk(n, n, null);
      for (let i = 0; i < n; i++) P[i][i] = new Set([nums[i]]); for (let len = 2; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1, S = new Set(); for (let k = i; k < j; k++) for (const a of P[i][k]) for (const b of P[k + 1][j]) { const v = ops[k] === '+' ? a + b : a * b; if (v <= 1000) S.add(v); } P[i][j] = S; }
      const right = s.split('+').reduce((t, part) => t + part.split('*').reduce((p, x) => p * +x, 1), 0);
      const answers = I.answers;
      T.at({ s }); T.n('The correct value?', right, 'Multiply before adding.'); T.n('How many distinct values can some evaluation order produce?', P[0][n - 1].size, 'Interval DP over operator splits.');
      let sc = 0; answers.forEach(a => { const p = a === right ? 5 : P[0][n - 1].has(a) ? 2 : 0; T.at({ s, answer: a }); T.n(`Points for answer ${a}?`, p, '5 if correct, 2 if a wrong order gives it, else 0.'); sc += p; });
      return sc;
    }
  });

  D('partition-array-into-two-arrays-to-minimize-sum-difference', {
    t: 'Partition Into Two Arrays: pick n numbers closest to half',
    r: 'Choose exactly n numbers for one side; the difference is |total − 2 times chosen|. Meet in the middle: for each count c from the left half, pair with n − c from the right half (sorted, binary search).',
    g: R => ({ nums: R.ints(2 * R.int(1, 3), -6, 9) }),
    s(I, T) {
      const a = I.nums, n = a.length / 2, tot = a.reduce((x, y) => x + y, 0); let best = Infinity;
      for (let m = 0; m < 1 << a.length; m++) if (pc(m) === n) { let s = 0; for (let i = 0; i < a.length; i++) if (m >> i & 1) s += a[i]; best = Math.min(best, Math.abs(tot - 2 * s)); }
      T.at({ nums: A(a), n }); T.n('Size of each half?', n, 'Half the array.'); T.n('Total sum?', tot, 'Add everything.'); T.n('Smallest absolute difference?', best, 'Best subset of size n: total minus twice its sum, made positive.'); return best;
    }
  });

  D('maximum-alternating-subarray-sum', {
    t: 'Maximum Alternating Subarray Sum: plus-ending and minus-ending',
    r: 'plus = best alternating sum of a subarray ending here with nums[i] added = max(nums[i], minus + nums[i]); minus = best ending here with nums[i] subtracted = plus_prev − nums[i].',
    g: R => ({ nums: R.ints(R.int(4, 6), -5, 6) }),
    s(I, T) { let p = -Infinity, m = -Infinity, best = -Infinity; I.nums.forEach((x, i) => { const np = Math.max(x, m + x), nm = p - x; T.at({ nums: A(I.nums, { hl: [i] }), plus: p === -Infinity ? '−∞' : p, minus: m === -Infinity ? '−∞' : m }); T.n(`Best sum ending at ${i} with ${x} added?`, np, 'Start here, or extend a minus-ending subarray.'); p = np; m = nm; best = Math.max(best, p, m); }); return best; }
  });

  D('minimum-cost-to-separate-sentence-into-rows', {
    t: 'Minimum Cost to Separate Sentence: the last row is free',
    r: 'dp[i] = least cost to lay out words i.. . If they all fit in one row, dp[i] = 0. Otherwise try every first row i to j that fits: (k − row length)² + dp[j + 1].',
    g: R => ({ sentence: Array.from({ length: R.int(3, 5) }, () => R.str(R.int(1, 4), 'abc')).join(' '), k: R.int(5, 8) }),
    s(I, T) { const w = I.sentence.split(' '), n = w.length, dp = Array(n + 1).fill(0); for (let i = n - 1; i >= 0; i--) { let len = -1, best = Infinity; for (let j = i; j < n; j++) { len += w[j].length + 1; if (len > I.k) break; best = Math.min(best, j === n - 1 ? 0 : (I.k - len) ** 2 + dp[j + 1]); } dp[i] = best; T.at({ words: A(w, { win: [i, n - 1] }), k: I.k }); T.n(`dp[${i}]?`, best, 'Free if the rest fits on one row; else the best first row plus the rest.'); } return dp[0]; }
  });

  D('two-best-non-overlapping-events', {
    t: 'Two Best Non-Overlapping Events: best earlier event by end time',
    r: 'Sort by end time and keep a prefix max of values. For each event, add the best value among events ending strictly before its start.',
    g: R => ({ events: Array.from({ length: R.int(3, 5) }, () => { const s = R.int(1, 8); return [s, s + R.int(0, 3), R.int(1, 9)]; }) }),
    s(I, T) { const E = I.events.slice().sort((a, b) => a[1] - b[1]); let best = 0; E.forEach(([s, e, v], i) => { let pm = 0; E.forEach(o => { if (o[1] < s) pm = Math.max(pm, o[2]); }); T.at({ events: A(E.map(x => `${x[0]}-${x[1]}:${x[2]}`), { hl: [i] }), best }); T.n(`Best total using event ${s}-${e} (value ${v})?`, v + pm, `${v} + best earlier value ${pm}.`); best = Math.max(best, v + pm); }); return best; }
  });

  D('check-if-an-original-string-exists-given-two-encoded-strings', {
    t: 'Check If an Original String Exists: lengths from digit runs',
    r: 'A digit run like "123" can mean 123, 12+3, 1+23 or 1+2+3 letters. Walk both strings with a balance of pending wildcards (memo on positions and balance): letters must match when both sides are at real letters.',
    g: R => R.pick([{ s1: 'ab2', s2: 'a3' }, { s1: 'a1b', s2: '2b' }, { s1: '12', s2: 'a2b' }, { s1: 'ab', s2: '3' }, { s1: 'a12', s2: '4a' }, { s1: 'xy1', s2: '1y1' }, { s1: '1a', s2: 'b1' }]),
    s(I, T) {
      const lens = s => { let out = new Set([0]); const runs = s.match(/\d+|[a-z]/g); for (const r of runs) { if (/\d/.test(r)) { const opts = new Set(); const sp = (i, acc) => { if (i === r.length) { opts.add(acc); return; } for (let j = i + 1; j <= r.length; j++) sp(j, acc + +r.slice(i, j)); }; sp(0, 0); out = new Set([...out].flatMap(o => [...opts].map(x => o + x))); } else out = new Set([...out].map(o => o + 1)); } return out; };
      const L1 = lens(I.s1), L2 = lens(I.s2); T.at({ s1: I.s1, s2: I.s2 }); T.n('Smallest possible original length for s1?', Math.min(...L1), 'Split every digit run into single digits.'); T.n('Largest possible original length for s2?', Math.max(...L2), 'Read every digit run as one number.');
      const memo = new Map(), a = I.s1, b = I.s2, f = (i, j, d) => { const k = i + ',' + j + ',' + d; if (memo.has(k)) return memo.get(k); let r = false;
        if (i === a.length && j === b.length) r = d === 0;
        else { if (i < a.length && /\d/.test(a[i])) { let v = 0; for (let x = i; x < a.length && /\d/.test(a[x]) && !r; x++) { v = v * 10 + +a[x]; r = f(x + 1, j, d - v); } }
          else if (j < b.length && /\d/.test(b[j])) { let v = 0; for (let x = j; x < b.length && /\d/.test(b[x]) && !r; x++) { v = v * 10 + +b[x]; r = f(i, x + 1, d + v); } }
          else if (d < 0) r = j < b.length && f(i, j + 1, d + 1);
          else if (d > 0) r = i < a.length && f(i + 1, j, d - 1);
          else r = i < a.length && j < b.length && a[i] === b[j] && f(i + 1, j + 1, 0); }
        memo.set(k, r); return r; };
      const res = f(0, 0, 0); T.yn('Can both encode the same original string?', res, 'Match letters, and let digit runs absorb letters on the other side.'); return res;
    }
  });

  D('count-fertile-pyramids-in-a-land', {
    t: 'Count Fertile Pyramids: height from the three cells below',
    r: 'h[r][c] = tallest pyramid with apex (r, c) = 1 + min(h of the three cells below) for fertile cells. Pyramids there: h − 1 (height at least 2). Do the same upside-down for inverse pyramids.',
    g: R => ({ grid: R.grid(3, R.int(3, 5), 0, 1).map(r => r.map(x => R.chance(0.7) ? 1 : x)) }),
    s(I, T) {
      const g = I.grid, m = g.length, n = g[0].length, run = (rows, nm) => { const h = mk(m, n, 0); let tot = 0; for (const r of rows) for (let c = 0; c < n; c++) { if (!g[r][c]) continue; const nr = nm === 'pyramid' ? r + 1 : r - 1; h[r][c] = nr < 0 || nr >= m || c === 0 || c === n - 1 ? 1 : 1 + Math.min(h[nr][c - 1], h[nr][c], h[nr][c + 1]); tot += h[r][c] - 1; } T.at({ grid: G(g), kind: nm }); T.n(`Total ${nm}s?`, tot, 'Add height minus 1 over every apex.'); return tot; };
      const a = run([...Array(m).keys()].reverse(), 'pyramid'), b = run([...Array(m).keys()], 'inverse pyramid'); T.at({ grid: G(g) }); T.n('Total of both kinds?', a + b, 'Pyramids plus inverse pyramids.');
      return a + b;
    }
  });

  D('find-good-days-to-rob-the-bank', {
    t: 'Find Good Days to Rob the Bank: non-increasing before, non-decreasing after',
    r: 'before[i] = days of non-increasing guards ending at i; after[i] = non-decreasing days starting at i. Day i is good if both at least time.',
    g: R => ({ security: R.ints(R.int(6, 8), 0, 4), time: R.int(1, 2) }),
    s(I, T) { const s = I.security, n = s.length, b = Array(n).fill(0), a = Array(n).fill(0); for (let i = 1; i < n; i++) if (s[i] <= s[i - 1]) b[i] = b[i - 1] + 1; for (let i = n - 2; i >= 0; i--) if (s[i] <= s[i + 1]) a[i] = a[i + 1] + 1; const out = []; for (let i = I.time; i < n - I.time; i++) { T.at({ security: A(s, { hl: [i] }), before: A(b), after: A(a), time: I.time }); T.yn(`Is day ${i} good?`, b[i] >= I.time && a[i] >= I.time, `before ${b[i]}, after ${a[i]} vs time ${I.time}.`); if (b[i] >= I.time && a[i] >= I.time) out.push(i); } return out; }
  });

  D('number-of-smooth-descent-periods-of-a-stock', {
    t: 'Number of Smooth Descent Periods: run length ending here',
    r: 'If prices drop by exactly 1 from yesterday, run = run + 1; else run = 1. Each day adds run periods ending that day.',
    g: R => ({ prices: R.ints(R.int(5, 7), 1, 6) }),
    s(I, T) { let run = 0, tot = 0; I.prices.forEach((p, i) => { run = i && I.prices[i - 1] - p === 1 ? run + 1 : 1; T.at({ prices: A(I.prices, { hl: [i] }), total: tot }); T.n(`Periods ending on day ${i}?`, run, run > 1 ? 'Dropped by exactly 1: extend the run.' : 'Run restarts.'); tot += run; }); return tot; }
  });

  D('solving-questions-with-brainpower', {
    t: 'Solving Questions With Brainpower: solve and skip ahead, or move on',
    r: 'dp[i] = best from question i on = max(dp[i+1], points[i] + dp[i + brainpower[i] + 1]).',
    g: R => ({ questions: Array.from({ length: R.int(4, 6) }, () => [R.int(1, 9), R.int(1, 3)]) }),
    s(I, T) { const q = I.questions, n = q.length, dp = Array(n + 1).fill(0), g = i => i >= n ? 0 : dp[i]; for (let i = n - 1; i >= 0; i--) { dp[i] = Math.max(g(i + 1), q[i][0] + g(i + q[i][1] + 1)); T.at({ questions: A(q.map(x => `${x[0]}pt or skip ${x[1]}`), { hl: [i] }), dp: A(dp.map((v, j) => j > i ? v : j === i ? '?' : '')) }); T.n(`dp[${i}]?`, dp[i], `max(skip ${g(i + 1)}, solve ${q[i][0]} + ${g(i + q[i][1] + 1)}).`); } return dp[0]; }
  });

  D('choose-numbers-from-two-arrays-in-range', {
    t: 'Choose Numbers From Two Arrays: difference counts ending here',
    r: 'For each i, cnt[d] = number of (range ending at i, choices) with sum(chosen nums1) − sum(chosen nums2) = d. Start fresh at i (±value) or extend every previous d. Balanced ones have d = 0.',
    g: R => { const n = R.int(2, 4); return { nums1: R.ints(n, 0, 3), nums2: R.ints(n, 0, 3) }; },
    s(I, T) { let cnt = new Map(), tot = 0; I.nums1.forEach((a, i) => { const b = I.nums2[i], nx = new Map(), add = (k, v) => nx.set(k, ((nx.get(k) || 0) + v) % MOD); add(a, 1); add(-b, 1); for (const [d, v] of cnt) { add(d + a, v); add(d - b, v); } cnt = nx; T.at({ nums1: A(I.nums1, { hl: [i] }), nums2: A(I.nums2, { hl: [i] }), total: tot }); T.n(`Balanced choices for ranges ending at ${i}?`, cnt.get(0) || 0, 'Count the difference-0 entries.'); tot = (tot + (cnt.get(0) || 0)) % MOD; }); return tot; }
  });

  D('minimum-number-of-lines-to-cover-points', {
    t: 'Minimum Number of Lines to Cover Points: bitmask over covered points',
    r: 'Each pair of points defines a line covering every collinear point (a mask). dp[mask] = fewest lines to cover mask: take the lowest uncovered point and either draw a line through it and another point, or give it its own line.',
    g: R => ({ points: R.distinct(R.int(3, 5), 0, 15).map(v => [v % 4, Math.floor(v / 4)]) }),
    s(I, T) {
      const P = I.points, n = P.length, col = (a, b, c) => (P[b][0] - P[a][0]) * (P[c][1] - P[a][1]) === (P[b][1] - P[a][1]) * (P[c][0] - P[a][0]), lines = [];
      for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) { let m = 0; for (let k = 0; k < n; k++) if (col(i, j, k)) m |= 1 << k; lines.push(m); }
      T.at({ points: A(P.map(p => `(${p})`)) }); T.n('Point pairs to check?', n * (n - 1) / 2, 'Each pair defines a line.'); if (n >= 2) T.n(`Points on the line through points 0 and 1?`, pc(lines[0]), 'Count every collinear point.');
      const full = (1 << n) - 1, dp = Array(1 << n).fill(Infinity); dp[0] = 0; for (let m = 0; m < full; m++) if (dp[m] < Infinity) { let low = 0; while (m >> low & 1) low++; dp[m | 1 << low] = Math.min(dp[m | 1 << low], dp[m] + 1); for (const l of lines) if (l >> low & 1) dp[m | l] = Math.min(dp[m | l], dp[m] + 1); }
      T.n('Fewest lines?', dp[full], 'Bitmask DP, always covering the lowest uncovered point next.'); return dp[full];
    }
  });

  D('minimum-difference-in-sums-after-removal-of-elements', {
    t: 'Minimum Difference After Removal: smallest n on the left, largest n on the right',
    r: 'For each split k (k from n to 2n): left[k] = sum of the n smallest in nums[0 to k) (max-heap), right[k] = sum of the n largest in nums[k..) (min-heap). Answer = min left[k] − right[k].',
    g: R => ({ nums: R.ints(3 * R.int(1, 2), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length / 3; let best = Infinity; for (let k = n; k <= 2 * n; k++) { const L = a.slice(0, k).sort((x, y) => x - y).slice(0, n).reduce((s, x) => s + x, 0), Rt = a.slice(k).sort((x, y) => y - x).slice(0, n).reduce((s, x) => s + x, 0); T.at({ nums: A(a, { win: [0, k - 1] }), split: k }); T.n(`Split at ${k}: left − right?`, L - Rt, `Smallest ${n} on the left (${L}) minus largest ${n} on the right (${Rt}).`); best = Math.min(best, L - Rt); } return best; }
  });

  D('minimum-time-to-remove-all-cars-containing-illegal-goods', {
    t: 'Minimum Time to Remove Illegal Cars: left part, then the rest from the right',
    r: 'left[i] = best cost to clean cars 0 to i = min(left[i−1] + (s[i] == "1" ? 2 : 0), i + 1). Total = min over i of left[i] + (n − 1 − i), and also n − 0 from the right alone.',
    g: R => ({ s: R.str(R.int(5, 7), '001') }),
    s(I, T) { const s = I.s, n = s.length; let L = 0, best = n; for (let i = 0; i < n; i++) { L = Math.min(L + (s[i] === '1' ? 2 : 0), i + 1); T.at({ s: A([...s], { hl: [i] }), best }); T.n(`left[${i}]?`, L, s[i] === '1' ? 'Remove it from the middle (2) or pop everything up to here (i + 1).' : 'A clean car costs nothing in the middle.'); best = Math.min(best, L + n - 1 - i); } return best; }
  });

  D('maximum-and-sum-of-array', {
    t: 'Maximum AND Sum of Array: two places per slot',
    r: 'Each slot holds up to 2 numbers. f(i, state) = best AND sum placing nums[i..] given how full each slot is (base-3 state). Try every slot with room: (nums[i] & slot) + f(i + 1, state + 1 in that slot).',
    g: R => { const s = R.int(1, 3); return { nums: R.ints(R.int(1, 2 * s), 1, 7), numSlots: s }; },
    s(I, T) {
      const a = I.nums, S = I.numSlots, memo = new Map(), f = (i, st) => { if (i === a.length) return 0; const k = i + '|' + st.join(''); if (memo.has(k)) return memo.get(k); let b = -1; for (let s = 0; s < S; s++) if (st[s] < 2) { st[s]++; b = Math.max(b, (a[i] & (s + 1)) + f(i + 1, st)); st[s]--; } memo.set(k, b); return b; };
      const st = Array(S).fill(0); for (let i = 0; i < a.length; i++) { const opts = [], ok = []; for (let s = 0; s < S; s++) if (st[s] < 2) { opts.push([String(s + 1), `slot ${s + 1} (${a[i]}&${s + 1}=${a[i] & (s + 1)})`]); st[s]++; if ((a[i] & (s + 1)) + f(i + 1, st) === f(i, (st[s]--, st))) ok.push(String(s + 1)); else; } 
        T.at({ nums: A(a, { hl: [i] }), slots: A(st, { labels: st.map((_, s) => 'slot ' + (s + 1)) }) }); T.k(`Place ${a[i]} in which slot (optimal)?`, opts, ok, `The best remaining total is ${f(i, st)}.`); st[+ok[0] - 1]++; }
      st.fill(0); return f(0, st);
    }
  });

  D('number-of-ways-to-build-sturdy-brick-wall', {
    t: 'Number of Ways to Build a Sturdy Brick Wall: row patterns with no shared seams',
    r: 'List every way to fill one row of the given width (its inner seam positions as a mask). Adjacent rows must share no seam. dp over rows counts walls ending in each pattern.',
    g: R => ({ height: R.int(1, 3), width: R.int(3, 5), bricks: R.distinct(R.int(1, 3), 1, 3) }),
    s(I, T) {
      const pats = [], gen = (w, m) => { if (w === I.width) { pats.push(m); return; } for (const b of I.bricks) if (w + b <= I.width) gen(w + b, w + b < I.width ? m | 1 << (w + b) : m); }; gen(0, 0);
      T.at({ width: I.width, bricks: A(I.bricks) }); T.n('How many ways to fill a single row?', pats.length, 'Enumerate brick sequences summing to the width.');
      let dp = pats.map(() => 1); for (let h = 2; h <= I.height; h++) { dp = pats.map(p => pats.reduce((s, q, j) => (p & q) ? s : (s + dp[j]) % MOD, 0)); T.at({ rows: h }); T.n(`Sturdy walls of height ${h}?`, dp.reduce((a, b) => (a + b) % MOD, 0), 'Sum over seam-disjoint previous rows.'); }
      return dp.reduce((a, b) => (a + b) % MOD, 0);
    }
  });

  D('minimum-time-to-finish-the-race', {
    t: 'Minimum Time to Finish the Race: best stint, then split laps',
    r: 'best[k] = fastest k laps on one tire without changing (stop growing once a lap costs more than changeTime + f). dp[i] = min over k of dp[i − k] + changeTime + best[k]; subtract one changeTime at the end.',
    g: R => ({ tires: Array.from({ length: R.int(1, 2) }, () => [R.int(1, 3), R.int(2, 3)]), changeTime: R.int(2, 6), numLaps: R.int(3, 5) }),
    s(I, T) {
      const N = I.numLaps, best = Array(N + 1).fill(Infinity); for (const [f, r] of I.tires) { let lap = f, tot = 0; for (let k = 1; k <= N; k++) { tot += lap; if (lap > I.changeTime + f) break; best[k] = Math.min(best[k], tot); lap *= r; } }
      for (let k = 1; k <= Math.min(N, 3); k++) { T.at({ tires: A(I.tires.map(t => `f${t[0]} r${t[1]}`)), change: I.changeTime }); T.n(`Fastest ${k} laps on one tire (inf if never worth it)?`, best[k], 'Sum f times r to the power (x−1) for the laps.'); }
      const dp = [0]; for (let i = 1; i <= N; i++) { let v = Infinity; for (let k = 1; k <= i; k++) if (best[k] < Infinity) v = Math.min(v, dp[i - k] + I.changeTime + best[k]); dp.push(v); } T.n('Total minimum time?', dp[N] - I.changeTime, 'Best split into stints, minus the change before the first stint.'); return dp[N] - I.changeTime;
    }
  });

  D('number-of-ways-to-build-house-of-cards', {
    t: 'Number of Ways to Build House of Cards: distinct row sizes',
    r: 'A row with k triangles uses 3k − 1 cards, and each row must have fewer triangles than the one below. So count ways to write n as a sum of distinct values 3k − 1 (0-1 knapsack over k).',
    g: R => ({ n: R.int(5, 30) }),
    s(I, T) { const dp = Array(I.n + 1).fill(0); dp[0] = 1; for (let k = 1; 3 * k - 1 <= I.n; k++) { const c = 3 * k - 1; for (let s = I.n; s >= c; s--) dp[s] += dp[s - c]; T.at({ 'row cost': c, n: I.n }); T.n(`Using rows of up to ${k} triangles: ways to use exactly ${I.n} cards?`, dp[I.n], `Add row size ${c} (0-1 knapsack).`); } return dp[I.n]; }
  });

  D('minimum-white-tiles-after-covering-with-carpets', {
    t: 'Minimum White Tiles After Carpets: cover here or not',
    r: 'dp[c][i] = fewest white tiles visible among the first i tiles using c carpets = min(dp[c][i−1] + white(i−1), dp[c−1][i − carpetLen]).',
    g: R => ({ floor: R.str(R.int(5, 8), '011'), numCarpets: R.int(1, 2), carpetLen: R.int(1, 3) }),
    s(I, T) { const f = I.floor, n = f.length, L = I.carpetLen; let prev = Array(n + 1).fill(0); for (let i = 1; i <= n; i++) prev[i] = prev[i - 1] + (f[i - 1] === '1' ? 1 : 0); T.at({ floor: A([...f]) }); T.n('White tiles with no carpets?', prev[n], 'Count the 1s.'); for (let c = 1; c <= I.numCarpets; c++) { const cur = [0]; for (let i = 1; i <= n; i++) cur.push(Math.min(cur[i - 1] + (f[i - 1] === '1' ? 1 : 0), prev[Math.max(0, i - L)])); prev = cur; T.at({ floor: A([...f]), carpets: c, length: L }); T.n(`Fewest white tiles with ${c} carpets?`, prev[n], 'Leave the tile, or end a carpet here.'); } return prev[n]; }
  });

  D('maximum-value-of-k-coins-from-piles', {
    t: 'Maximum Value of k Coins: grouped knapsack over piles',
    r: 'dp[j] = best value taking j coins from the piles so far. For a pile, taking its top t coins (prefix sum) costs t: dp[j] = max over t of old dp[j − t] + prefix[t].',
    g: R => { const piles = Array.from({ length: R.int(2, 3) }, () => R.ints(R.int(1, 3), 1, 9)); return { piles, k: Math.min(R.int(2, 4), piles.flat().length) }; },
    s(I, T) { let dp = Array(I.k + 1).fill(-Infinity); dp[0] = 0; I.piles.forEach((p, i) => { const pre = [0]; p.forEach(x => pre.push(pre[pre.length - 1] + x)); const nx = dp.slice(); for (let j = 1; j <= I.k; j++) for (let t = 1; t <= Math.min(j, p.length); t++) if (dp[j - t] > -Infinity) nx[j] = Math.max(nx[j], dp[j - t] + pre[t]); dp = nx; T.at({ piles: A(I.piles.map(x => x.join(',')), { hl: [i] }), k: I.k }); if (dp[I.k] > -Infinity) T.n(`After pile ${i}: best value with exactly ${I.k} coins?`, dp[I.k], 'Try every prefix of this pile.'); else T.yn(`After pile ${i}: are there ${I.k} coins available yet?`, false, 'Not enough coins in these piles.'); }); return dp[I.k]; }
  });

  D('number-of-ways-to-select-buildings', {
    t: 'Number of Ways to Select Buildings: count 010 and 101',
    r: 'Track c0, c1 (buildings seen), c01, c10 (alternating pairs). A "0": c10 += c1, total += c01, c0++. A "1": c01 += c0, total += c10, c1++.',
    g: R => ({ s: R.str(R.int(5, 7), '01') }),
    s(I, T) { let c0 = 0, c1 = 0, c01 = 0, c10 = 0, tot = 0; [...I.s].forEach((ch, i) => { const add = ch === '0' ? c01 : c10; T.at({ s: A([...I.s], { hl: [i] }), counts: K([['0', c0], ['1', c1], ['01', c01], ['10', c10]]), total: tot }); T.n(`"${ch}" at ${i}: how many valid triples end here?`, add, ch === '0' ? 'Every "01" pair before it.' : 'Every "10" pair before it.'); tot += add; if (ch === '0') { c10 += c1; c0++; } else { c01 += c0; c1++; } }); return tot; }
  });

  D('total-appeal-of-a-string', {
    t: 'Total Appeal of a String: count each letter\'s first occurrence',
    r: 'Credit a letter to a substring only at its first occurrence there. s[i] is first in substrings starting after the previous same letter: (i − last[c]) times (n − i).',
    g: R => ({ s: R.str(R.int(4, 6), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, last = {}; let tot = 0; for (let i = 0; i < n; i++) { const p = last[s[i]] ?? -1, c = (i - p) * (n - i); T.at({ s: A([...s], { hl: [i] }), total: tot }); T.n(`Contribution of s[${i}] = "${s[i]}"?`, c, `(${i} − ${p}) times (${n} − ${i}).`); tot += c; last[s[i]] = i; } return tot; }
  });

  D('make-array-non-decreasing-or-non-increasing', {
    t: 'Make Array Non-Decreasing or Non-Increasing: DP over target values',
    r: 'An optimal array uses only original values. dp[v] = least cost with the current element set to v (sorted values); for non-decreasing, dp[v] = |a[i] − v| + min dp[u] over u at most v (a running prefix min). Do it again reversed for non-increasing; take the smaller.',
    g: R => ({ nums: R.ints(R.int(4, 5), 0, 6) }),
    s(I, T) {
      const vals = [...new Set(I.nums)].sort((a, b) => a - b), run = (arr, nm) => { let dp = vals.map(() => 0); for (const x of arr) { let m = Infinity; dp = vals.map((v, k) => { m = Math.min(m, dp[k]); return m + Math.abs(x - v); }); } const r = Math.min(...dp); T.at({ nums: A(arr), values: A(vals), mode: nm }); T.n(`Least cost to make it ${nm}?`, r, 'Running prefix minimum over target values.'); return r; };
      const r = Math.min(run(I.nums, 'non-decreasing'), run(I.nums.slice().reverse(), 'non-increasing')); T.at({ nums: A(I.nums) }); T.n('Least cost overall?', r, 'The cheaper of the two directions.');
      return r;
    }
  });

  D('count-number-of-texts', {
    t: 'Count Number of Texts: the last letter used 1 to 3 (or 4) presses',
    r: 'dp[i] = messages for the first i presses. The last letter used k equal presses (k at most 3, or at most 4 for keys 7 and 9): dp[i] = the sum of dp[i − k].',
    g: R => ({ pressedKeys: R.str(R.int(4, 7), '2279') }),
    s(I, T) { const s = I.pressedKeys, dp = [1]; for (let i = 1; i <= s.length; i++) { const mx = s[i - 1] === '7' || s[i - 1] === '9' ? 4 : 3; let v = 0; for (let k = 1; k <= mx && i - k >= 0; k++) { if (s[i - k] !== s[i - 1]) break; v = (v + dp[i - k]) % MOD; } T.at({ keys: A([...s], { hl: [i - 1] }), dp: A(dp.concat('?')) }); T.n(`dp[${i}]?`, v, `Sum dp[i − k] over runs of up to ${mx} equal presses.`); dp.push(v); } return dp[s.length]; }
  });

  D('check-if-there-is-a-valid-parentheses-string-path', {
    t: 'Valid Parentheses String Path: sets of open counts',
    r: 'For each cell keep every possible open-minus-close balance along a right or down path (never negative). The last cell must allow balance 0. Odd path length fails immediately.',
    g: R => ({ grid: Array.from({ length: R.int(2, 3) }, (_, __, w = 0) => Array.from({ length: 3 }, () => R.pick(['(', ')']))).map((r, i) => i === 0 ? ['(', ...r.slice(1)] : r) }),
    s(I, T) {
      const g = I.grid, m = g.length, n = g[0].length; T.at({ grid: G(g) }); T.yn(`Is the path length (${m + n - 1}) even?`, (m + n - 1) % 2 === 0, 'Valid strings have even length.'); if ((m + n - 1) % 2) return false;
      const S = mk(m, n, null); for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) { const d = g[r][c] === '(' ? 1 : -1, src = r === 0 && c === 0 ? [0] : [...(r ? S[r - 1][c] : []), ...(c ? S[r][c - 1] : [])]; S[r][c] = new Set(src.map(b => b + d).filter(b => b >= 0)); }
      for (let c = 0; c < n; c++) { T.at({ grid: G(g, { hl: [[m - 1, c]] }) }); T.n(`Largest reachable balance at (${m - 1},${c}) (−1 if none)?`, S[m - 1][c].size ? Math.max(...S[m - 1][c]) : -1, 'Union of the sets above and to the left, shifted by this bracket.'); }
      return S[m - 1][n - 1].has(0);
    }
  });
})();
