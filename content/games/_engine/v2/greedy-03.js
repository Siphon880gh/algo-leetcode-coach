/* v2 games: greedy (03). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const sorted = a => a.slice().sort((x, y) => x - y);
  const pc = m => { let c = 0; while (m) { c += m & 1; m >>>= 1; } return c; };

  D('minimum-suffix-flips', {
    t: 'Minimum Suffix Flips: count the changes',
    r: 'Scan target with the current state starting at 0. Every position whose bit differs from the current state needs a suffix flip, which then becomes the new state.',
    g: R => ({ target: R.str(R.int(1, 8), '01') }),
    s(I, T) { let cur = '0', c = 0; [...I.target].forEach((b, i) => { T.at({ target: A([...I.target], { hl: [i] }), state: cur, flips: c }); T.yn(`Flip at index ${i}?`, b !== cur, 'Differs from the current state.'); if (b !== cur) { c++; cur = b; } }); return c; }
  });

  D('minimum-numbers-of-function-calls-to-make-target-array', {
    t: 'Function Calls to Make Target Array: popcounts plus doublings',
    r: 'Each 1 bit needs its own +1 call; doublings are shared by all numbers, so you need (highest bit position) of them. Answer = the sum of popcount + (max bit length − 1).',
    g: R => ({ nums: R.ints(R.int(1, 4), 0, 20) }),
    s(I, T) { const res = (() => { const ones = I.nums.reduce((a, x) => a + pc(x), 0), mx = Math.max(...I.nums); T.at({ nums: A(I.nums), binary: A(I.nums.map(x => x.toString(2))) }); T.n('Total 1 bits (increment calls)?', ones, 'Add up the 1 bits of every number.'); const dbl = mx ? mx.toString(2).length - 1 : 0; T.n('Doubling calls?', dbl, 'Bit length of the largest, minus 1.'); return ones + dbl; })(); T.n('Total function calls?', res, 'Increments plus shared doublings.'); return res; }
  });

  D('maximum-number-of-coins-you-can-get', {
    t: 'Maximum Coins You Can Get: second largest of each triple',
    r: 'Sort. Each round pair the two largest remaining piles with the smallest: Alice takes the largest, you take the second, Bob the smallest. You collect a[n−2], a[n−4], … (n divided by 3 times).',
    g: R => ({ piles: R.ints(3 * R.int(1, 3), 1, 12) }),
    s(I, T) { const a = sorted(I.piles), n = a.length; let t = 0; for (let r = 0; r < n / 3; r++) { const i = n - 2 - 2 * r; T.at({ sorted: A(a, { hl: [i] }), total: t }); T.n(`Your pile in round ${r + 1}?`, a[i], 'Second largest remaining.'); t += a[i]; } return t; }
  });

  D('put-boxes-into-the-warehouse-i', {
    t: 'Put Boxes Into the Warehouse I: prefix minimum heights',
    r: 'A room is only as tall as the lowest room before it: use prefix minimums. Fill rooms from the far end with the smallest boxes first.',
    g: R => ({ boxes: R.ints(R.int(1, 5), 1, 6), warehouse: R.ints(R.int(1, 5), 1, 6) }),
    s(I, T) { const h = []; I.warehouse.forEach((x, i) => h.push(Math.min(x, i ? h[i - 1] : Infinity))); const b = sorted(I.boxes); let j = 0; for (let i = h.length - 1; i >= 0 && j < b.length; i--) { const ok = b[j] <= h[i]; T.at({ effective: A(h, { hl: [i] }), boxes: A(b, { dim: [...Array(j).keys()] }) }); T.yn(`Does box ${b[j]} fit room ${i}?`, ok, `Effective height ${h[i]}.`); if (ok) j++; } return j; }
  });

  D('replace-all-s-to-avoid-consecutive-repeating-characters', {
    t: 'Replace All ?s: pick a letter unlike both neighbors',
    r: 'For each "?", choose from a, b, c the first letter different from the left (already fixed) and right neighbors.',
    g: R => ({ s: R.str(R.int(1, 7), 'ab??c') }),
    cmp: (out, exp, I) => out.length === I.s.length && [...out].every((c, i) => (I.s[i] === '?' ? /[a-z]/.test(c) : c === I.s[i]) && (!i || c !== out[i - 1])) ,
    s(I, T) { const s = [...I.s]; for (let i = 0; i < s.length; i++) if (s[i] === '?') { const c = ['a', 'b', 'c'].find(x => x !== s[i - 1] && x !== s[i + 1]); T.at({ s: A(s, { hl: [i] }) }); T.c(`Letter for the ? at ${i}?`, ['a', 'b', 'c'], c, 'First of a, b, c unlike both neighbors.'); s[i] = c; } return s.join(''); }
  });

  D('minimum-time-to-make-rope-colorful', {
    t: 'Minimum Time to Make Rope Colorful: keep the slowest of each run',
    r: 'In each run of equal colors, keep the balloon with the largest neededTime and remove the rest: cost = run sum − run max.',
    g: R => { const c = R.str(R.int(2, 7), 'aab'); return { colors: c, neededTime: R.ints(c.length, 1, 6) }; },
    s(I, T) { const res = (() => { let t = 0, i = 0; const c = I.colors; T.at({ colors: A([...c]) }); T.n('Blocks of the same colour next to each other?', [...c].filter((x, k) => !k || x !== c[k - 1]).length, 'Count where the colour changes, plus the first block.'); while (i < c.length) { let j = i, s = 0, m = 0; while (j < c.length && c[j] === c[i]) { s += I.neededTime[j]; m = Math.max(m, I.neededTime[j]); j++; } if (j - i > 1) { T.at({ colors: A([...c], { win: [i, j - 1] }), time: A(I.neededTime, { win: [i, j - 1] }) }); T.n(`Cost for the run of "${c[i]}" from ${i} to ${j - 1}?`, s - m, 'Sum minus the max (keep the slowest).'); } t += s - m; i = j; } return t; })(); T.n('Minimum total time?', res, 'Add the cost of every run.'); return res; }
  });

  D('put-boxes-into-the-warehouse-ii', {
    t: 'Put Boxes Into the Warehouse II: enter from either side',
    r: 'A room\'s usable height is the larger of the prefix minimum from the left and the suffix minimum from the right. Sort usable heights and boxes and match greedily (smallest box to smallest room that fits).',
    g: R => ({ boxes: R.ints(R.int(1, 5), 1, 6), warehouse: R.ints(R.int(1, 5), 1, 6) }),
    s(I, T) { const res = (() => { const w = I.warehouse, n = w.length, L = [], Rm = Array(n); w.forEach((x, i) => L.push(Math.min(x, i ? L[i - 1] : Infinity))); for (let i = n - 1; i >= 0; i--) Rm[i] = Math.min(w[i], i < n - 1 ? Rm[i + 1] : Infinity); const h = w.map((_, i) => Math.max(L[i], Rm[i])); T.at({ warehouse: A(w), usable: A(h) }); T.n('Tallest usable room height?', Math.max(...h), 'The larger of the left limit and the right limit for each room.'); const hs = sorted(h), b = sorted(I.boxes); let j = 0; for (const x of hs) if (j < b.length && b[j] <= x) j++; return j; })(); T.n('Smallest box?', Math.min(...I.boxes), 'Place small boxes first.'); T.n('Most boxes placed?', res, 'Match sorted boxes to sorted usable heights.'); return res; }
  });

  D('minimum-deletions-to-make-character-frequencies-unique', {
    t: 'Unique Frequencies: lower each count below the last one used',
    r: 'Sort counts descending. Each count must be below the previous kept count (or 0): delete the difference.',
    g: R => ({ s: R.str(R.int(1, 10), 'aaabbbcc') }),
    s(I, T) { const c = {}; for (const x of I.s) c[x] = (c[x] || 0) + 1; const f = Object.values(c).sort((a, b) => b - a); let prev = Infinity, del = 0; for (const v of f) { const keep = Math.max(0, Math.min(v, prev - 1)); T.at({ freqs: A(f), prevKept: prev === Infinity ? '—' : prev }); T.n(`Deletions for a letter with count ${v}?`, v - keep, 'It must drop below the previous kept count.'); del += v - keep; prev = keep; } return del; }
  });

  D('smallest-string-with-a-given-numeric-value', {
    t: 'Smallest String With a Numeric Value: z\'s at the end',
    r: 'Fill from the right: each position gets min(26, k − (positions left before it)), leaving at least 1 for each earlier position.',
    g: R => { const n = R.int(1, 5); return { n, k: R.int(n, 26 * n) }; },
    s(I, T) { const out = Array(I.n); let k = I.k; for (let i = I.n - 1; i >= 0; i--) { const v = Math.min(26, k - i); T.at({ built: out.map(c => c || '·').join(''), k }); T.n(`Value at position ${i}?`, v, `min(26, ${k} − ${i}).`); out[i] = String.fromCharCode(96 + v); k -= v; } return out.join(''); }
  });

  D('minimum-initial-energy-to-finish-tasks', {
    t: 'Minimum Initial Energy: biggest slack first',
    r: 'Do tasks in order of (minimum − actual) descending. Track energy needed: need = max(need + actual, minimum) going backwards, or simulate with a deficit counter.',
    g: R => ({ tasks: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(1, 6); return [a, a + R.int(0, 6)]; }) }),
    s(I, T) { const t = I.tasks.slice().sort((x, y) => (y[1] - y[0]) - (x[1] - x[0])); let need = 0, cur = 0; for (const [a, m] of t) { if (cur < m) { need += m - cur; cur = m; } cur -= a; T.at({ order: A(t.map(x => `[${x}]`)), energyLeft: cur }); T.n(`Initial energy needed so far (after [${a},${m}])?`, need, 'Top up when below the minimum.'); } return need; }
  });

  D('stone-game-vi', {
    t: 'Stone Game VI: take by combined value',
    r: 'Taking a stone gains your value and denies the opponent\'s, so both players take stones in order of aliceValue + bobValue, descending.',
    g: R => { const n = R.int(1, 5); return { aliceValues: R.ints(n, 1, 6), bobValues: R.ints(n, 1, 6) }; },
    s(I, T) { const o = I.aliceValues.map((a, i) => [a + I.bobValues[i], i]).sort((x, y) => y[0] - x[0]); let a = 0, b = 0; o.forEach(([s, i], k) => { T.at({ order: A(o.map(x => x[1])), alice: a, bob: b }); T.c(`Who takes stone ${i} (sum ${s})?`, ['Alice', 'Bob'], k % 2 ? 'Bob' : 'Alice', 'Turns alternate down the sorted order.'); if (k % 2) b += I.bobValues[i]; else a += I.aliceValues[i]; }); return Math.sign(a - b); }
  });

  D('partitioning-into-minimum-number-of-deci-binary-numbers', {
    t: 'Deci-Binary Partition: the largest digit',
    r: 'Each deci-binary number adds at most 1 to each digit, so you need as many as the largest digit — and that many suffice.',
    g: R => ({ n: String(R.int(1, 99999)) }),
    s(I, T) { const m = Math.max(...[...I.n].map(Number)); T.at({ n: I.n }); T.n('How many digits?', I.n.length, 'Each deci-binary number covers every position with 0 or 1.'); T.n(`How many times must position 0 get a 1?`, +I.n[0], 'Its digit value.'); T.n('Largest digit?', m, 'That many numbers are needed and enough.'); return m; }
  });

  D('maximum-binary-string-after-change', {
    t: 'Maximum Binary String After Change: one zero survives',
    r: 'Leading 1s stay. From the first 0, all zeros can be gathered and merged into a single 0, placed at (first zero index + zero count − 1); everything else becomes 1.',
    g: R => ({ binary: R.str(R.int(1, 8), '01') }),
    s(I, T) { const res = (() => { const b = I.binary, p = b.indexOf('0'); T.at({ binary: A([...b]) }); T.n('Index of the first 0 (−1 if none)?', p, 'Leading 1s never change.'); if (p < 0) { T.n('How many ones?', b.length, 'All ones already, nothing to change.'); return b; } const z = [...b].filter(c => c === '0').length; T.n('How many zeros?', z, 'They merge into one.'); const out = Array(b.length).fill('1'); out[p + z - 1] = '0'; return out.join(''); })(); T.n('Position of the single 0 in the result? (−1 if none)', res.indexOf('0'), 'First zero plus the zero count, minus 1.'); return res; }
  });

  D('largest-subarray-length-k', {
    t: 'Largest Subarray Length K: the best possible start',
    r: 'Values are distinct, so the largest subarray starts at the largest element among the first n − k + 1 positions.',
    g: R => { const n = R.int(1, 7); return { nums: R.distinct(n, 1, 20), k: R.int(1, n) }; },
    s(I, T) { const res = (() => { const m = I.nums.length - I.k + 1; let s = 0; for (let i = 1; i < m; i++) if (I.nums[i] > I.nums[s]) s = i; T.at({ nums: A(I.nums, { win: [0, m - 1] }), k: I.k }); T.n('How many valid start positions?', m, 'n minus k, plus 1.'); T.n('Start index?', s, 'Largest value among valid starts.'); return I.nums.slice(s, s + I.k); })(); T.n('First value of the answer?', res[0], 'The largest start value wins, since values are distinct.'); return res; }
  });

  D('maximum-units-on-a-truck', {
    t: 'Maximum Units on a Truck: densest boxes first',
    r: 'Sort box types by units per box, descending, and load as many as fit.',
    g: R => ({ boxTypes: Array.from({ length: R.int(1, 4) }, () => [R.int(1, 5), R.int(1, 9)]), truckSize: R.int(1, 10) }),
    s(I, T) { const b = I.boxTypes.slice().sort((x, y) => y[1] - x[1]); let left = I.truckSize, u = 0; for (const [n, per] of b) { if (!left) break; const take = Math.min(n, left); T.at({ types: A(b.map(x => `${x[0]} boxes of ${x[1]}`)), space: left, units: u }); T.n(`Boxes taken of the ${per}-unit type?`, take, 'As many as fit.'); u += take * per; left -= take; } return u; }
  });

  D('minimum-number-of-people-to-teach', {
    t: 'Minimum People to Teach: only fix the broken friendships',
    r: 'Find friendships with no common language. Collect the users in them; for each language, teach it to those users who do not know it. Take the cheapest language.',
    g: R => { const m = R.int(2, 4), n = R.int(2, 3); return { n, languages: Array.from({ length: m }, () => R.distinct(R.int(1, n), 1, n)), friendships: Array.from({ length: R.int(1, 3) }, () => { const u = R.int(1, m - 1); return [u, R.int(u + 1, m)]; }) }; },
    s(I, T) { const res = (() => { const L = I.languages.map(x => new Set(x)), bad = new Set(); I.friendships.forEach(([u, v]) => { if (![...L[u - 1]].some(l => L[v - 1].has(l))) { bad.add(u); bad.add(v); } }); T.at({ friendships: A(I.friendships.map(f => `${f[0]} and ${f[1]}`)) }); T.n('Users involved in friendships that cannot talk?', bad.size, 'Only these may need teaching.'); T.n('Friend pairs that cannot talk?', I.friendships.filter(([u, v]) => ![...L[u - 1]].some(l => L[v - 1].has(l))).length, 'No shared language.'); let best = Infinity; for (let l = 1; l <= I.n; l++) best = Math.min(best, [...bad].filter(u => !L[u - 1].has(l)).length); return best; })(); T.n('Fewest users to teach?', res, 'Pick the language most of them already know.'); return res; }
  });

  D('latest-time-by-replacing-hidden-digits', {
    t: 'Latest Time by Replacing Hidden Digits',
    r: 'Hour tens: 2 if the ones digit is ? or at most 3, else 1. Hour ones: 3 if the tens is 2, else 9. Minute tens: 5. Minute ones: 9.',
    g: R => { const h = R.int(0, 23), m = R.int(0, 59); return { time: [...(String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0'))].map((c, i) => i !== 2 && R.chance(0.5) ? '?' : c).join('') }; },
    s(I, T) { const t = [...I.time]; if (t[0] === '?') { t[0] = t[1] === '?' || t[1] <= '3' ? '2' : '1'; T.at({ time: t.join('') }); T.n('Hour tens digit?', +t[0], '2 unless the ones digit is above 3.'); } if (t[1] === '?') { t[1] = t[0] === '2' ? '3' : '9'; T.at({ time: t.join('') }); T.n('Hour ones digit?', +t[1], '3 after a 2, else 9.'); } if (t[3] === '?') t[3] = '5'; if (t[4] === '?') t[4] = '9'; T.at({ time: t.join('') }); T.n('Latest minutes value?', +(t[3] + t[4]), 'Fill ? with 5 and 9.'); return t.join(''); }
  });

  D('maximum-score-from-removing-stones', {
    t: 'Maximum Score From Removing Stones: the biggest pile caps it',
    r: 'If the largest pile at least the other two combined, the score is the sum of the other two. Otherwise every pair can be used: half of total, rounded down.',
    g: R => ({ a: R.int(1, 12), b: R.int(1, 12), c: R.int(1, 12) }),
    s(I, T) { const res = (() => { const p = sorted([I.a, I.b, I.c]); T.at({ piles: A(p) }); T.n('Total stones?', p[0] + p[1] + p[2], 'Each move removes two.'); T.yn('Is the largest pile at least the other two combined?', p[2] >= p[0] + p[1], `${p[2]} against ${p[0] + p[1]}.`); return p[2] >= p[0] + p[1] ? p[0] + p[1] : Math.floor((p[0] + p[1] + p[2]) / 2); })(); T.n('Maximum score?', res, 'The two small piles, or half the total.'); return res; }
  });

  D('equal-sum-arrays-with-minimum-number-of-operations', {
    t: 'Equal Sum Arrays: biggest single-change gains first',
    r: 'Let the smaller-sum array be A. Raising an element of A to 6 gains 6 − x; lowering an element of B to 1 gains x − 1. Use the largest gains until the gap closes (impossible if 6 times shorter < longer).',
    g: R => ({ nums1: R.ints(R.int(1, 5), 1, 6), nums2: R.ints(R.int(1, 5), 1, 6) }),
    s(I, T) { let a = I.nums1, b = I.nums2; if (6 * Math.min(a.length, b.length) < Math.max(a.length, b.length)) return -1; let sa = a.reduce((x, y) => x + y, 0), sb = b.reduce((x, y) => x + y, 0); if (sa > sb) { [a, b] = [b, a]; [sa, sb] = [sb, sa]; } let d = sb - sa; const g = [...a.map(x => 6 - x), ...b.map(x => x - 1)].sort((x, y) => y - x); let c = 0; T.at({ gap: d, gains: A(g) }); T.n('Gap to close?', d, 'Larger sum − smaller sum.'); while (d > 0) { d -= g[c++]; T.at({ gap: Math.max(d, 0), gains: A(g, { dim: [...Array(c).keys()] }) }); T.n('Operations so far?', c, 'Use the largest remaining gain.'); } return c; }
  });

  D('minimum-elements-to-add-to-form-a-given-sum', {
    t: 'Minimum Elements to Add: chunks of size limit',
    r: 'The gap is |goal − the sum of nums|; each added element covers at most limit of it: gap divided by limit, rounded up.',
    g: R => { const L = R.int(1, 6); return { nums: R.ints(R.int(1, 4), -L, L), limit: L, goal: R.int(-20, 20) }; },
    s(I, T) { const res = (() => { const gap = Math.abs(I.goal - I.nums.reduce((a, b) => a + b, 0)); T.at({ nums: A(I.nums), goal: I.goal, limit: I.limit }); T.n('Sum of nums?', I.nums.reduce((a, b) => a + b, 0), 'Add them up.'); T.n('Gap between goal and sum (absolute)?', gap, 'Distance to cover.'); return Math.ceil(gap / I.limit); })(); T.n('Fewest elements to add?', res, 'Gap divided by limit, rounded up.'); return res; }
  });

  D('count-pairs-of-equal-substrings-with-minimum-difference', {
    t: 'Equal Substrings With Minimum j − a: single letters suffice',
    r: 'The minimum of j − a is reached by single-letter matches: for each letter, use its first index in firstString and last index in secondString. Count letters achieving the minimum.',
    g: R => ({ firstString: R.str(R.int(1, 5), 'abcd'), secondString: R.str(R.int(1, 5), 'abcd') }),
    s(I, T) { const res = (() => { const f = {}, l = {}; [...I.firstString].forEach((c, i) => { if (f[c] === undefined) f[c] = i; }); [...I.secondString].forEach((c, i) => l[c] = i); let best = Infinity, cnt = 0; for (const c of Object.keys(f)) if (l[c] !== undefined) { const v = f[c] - l[c]; T.at({ first: I.firstString, second: I.secondString, letter: c }); T.n(`First index minus last index for "${c}"?`, v, `${f[c]} minus ${l[c]}.`); if (v < best) { best = v; cnt = 1; } else if (v === best) cnt++; } return cnt; })(); T.n('How many letters reach the smallest difference?', res, 'Count the ties at the minimum.'); return res; }
  });

  D('maximum-number-of-consecutive-values-you-can-make', {
    t: 'Maximum Consecutive Values: extend the reachable range',
    r: 'Sort. If you can make 0 … reach − 1 and the next coin at most reach, you can now make up to reach + coin − 1. Otherwise there is a gap at reach.',
    g: R => ({ coins: R.ints(R.int(1, 6), 1, 6) }),
    s(I, T) { let reach = 1; for (const c of sorted(I.coins)) { const ok = c <= reach; T.at({ coins: A(sorted(I.coins)), reach }); T.yn(`Can coin ${c} extend the range?`, ok, ok ? `${c} at most ${reach}.` : `Gap at ${reach}.`); if (!ok) break; reach += c; } return reach; }
  });

  D('minimum-operations-to-make-the-array-increasing', {
    t: 'Make the Array Increasing: raise to previous + 1',
    r: 'Walk left to right; each element must be at least previous + 1. Raise it and add the difference.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 8) }),
    s(I, T) { let prev = -Infinity, ops = 0; I.nums.forEach((x, i) => { const v = Math.max(x, prev + 1); T.at({ nums: A(I.nums, { hl: [i] }), prev: i ? prev : '—' }); T.n(`Operations at index ${i}?`, v - x, 'Raise to previous + 1 if needed.'); ops += v - x; prev = v; }); return ops; }
  });

  D('maximum-ice-cream-bars', {
    t: 'Maximum Ice Cream Bars: cheapest first',
    r: 'Sort costs (counting sort works since costs are small) and buy while coins last.',
    g: R => ({ costs: R.ints(R.int(1, 7), 1, 9), coins: R.int(1, 20) }),
    s(I, T) { let c = I.coins, n = 0; for (const x of sorted(I.costs)) { if (x > c) break; c -= x; n++; T.at({ sorted: A(sorted(I.costs), { hl: [n - 1] }) }); T.n('Coins left?', c, `Bought a bar for ${x}.`); } return n; }
  });

  D('maximum-building-height', {
    t: 'Maximum Building Height: tighten restrictions both ways',
    r: 'Add [1, 0], sort by id. Pass left to right: limit at most previous limit + distance; then right to left the same. Between neighbors with limits h1, h2 at distance d, the peak is half of (h1 + h2 + d), rounded down; past the last one, last + (n − id).',
    g: R => { const n = R.int(2, 12), k = R.int(0, Math.min(3, n - 1)); const ids = R.distinct(k, 2, n); return { n, restrictions: ids.map(i => [i, R.int(0, 4)]) }; },
    s(I, T) { const r = [[1, 0], ...I.restrictions.map(x => x.slice())].sort((a, b) => a[0] - b[0]); for (let i = 1; i < r.length; i++) r[i][1] = Math.min(r[i][1], r[i - 1][1] + r[i][0] - r[i - 1][0]); for (let i = r.length - 2; i >= 0; i--) r[i][1] = Math.min(r[i][1], r[i + 1][1] + r[i + 1][0] - r[i][0]); T.at({ limits: A(r.map(x => `#${x[0]} at most ${x[1]}`)) }); T.n('Tightest limit of the last restricted building?', r[r.length - 1][1], 'After both passes.'); let best = 0; for (let i = 1; i < r.length; i++) { const p = Math.floor((r[i - 1][1] + r[i][1] + r[i][0] - r[i - 1][0]) / 2); T.n(`Peak between #${r[i - 1][0]} and #${r[i][0]}?`, p, 'half of (h1 + h2 + d), rounded down.'); best = Math.max(best, p); } return Math.max(best, r[r.length - 1][1] + I.n - r[r.length - 1][0]); }
  });

  D('maximum-element-after-decreasing-and-rearranging', {
    t: 'Maximum Element After Decreasing: staircase from 1',
    r: 'Sort; set the first to 1, and each next to min(itself, previous + 1). The last value is the answer.',
    g: R => ({ arr: R.ints(R.int(1, 7), 1, 12) }),
    s(I, T) { const a = sorted(I.arr); a[0] = 1; for (let i = 1; i < a.length; i++) { a[i] = Math.min(a[i], a[i - 1] + 1); T.at({ arr: A(a, { hl: [i] }) }); T.n(`Value at index ${i}?`, a[i], 'min(itself, previous + 1).'); } return a[a.length - 1]; }
  });

  D('minimum-number-of-swaps-to-make-the-binary-string-alternating', {
    t: 'Swaps to Make Binary String Alternating: count mismatches',
    r: 'Counts of 0s and 1s may differ by at most 1. For each feasible pattern (starting with 0 or 1), mismatched positions divided by 2 is the swap count; take the smaller.',
    g: R => ({ s: R.str(R.int(1, 8), '01') }),
    s(I, T) { const res = (() => { const s = I.s, z = [...s].filter(c => c === '0').length, o = s.length - z; T.at({ s }); T.n('Zeros minus ones?', z - o, 'Must be −1, 0 or 1.'); T.n('How many zeros?', z, 'Count the 0 characters.'); if (Math.abs(z - o) > 1) return -1; const mis = st => [...s].filter((c, i) => c !== String((st + i) % 2)).length; let best = Infinity; if (z >= o) best = Math.min(best, mis(0) / 2); if (o >= z) best = Math.min(best, mis(1) / 2); return best; })(); T.n('Fewest swaps? (−1 if impossible)', res, 'Half the mismatches against the best pattern.'); return res; }
  });

  D('minimize-product-sum-of-two-arrays', {
    t: 'Minimize Product Sum: largest with smallest',
    r: 'Sort one array ascending and the other descending, then pair them (rearrangement inequality).',
    g: R => { const n = R.int(1, 5); return { nums1: R.ints(n, 1, 9), nums2: R.ints(n, 1, 9) }; },
    s(I, T) { const a = sorted(I.nums1), b = sorted(I.nums2).reverse(); let s = 0; a.forEach((x, i) => { T.at({ a: A(a, { hl: [i] }), b: A(b, { hl: [i] }), sum: s }); T.n(`Product at position ${i}?`, x * b[i], 'Smallest times largest remaining.'); s += x * b[i]; }); return s; }
  });

  D('maximum-value-after-insertion', {
    t: 'Maximum Value After Insertion: first place where x helps',
    r: 'Positive: insert x before the first digit smaller than x. Negative: insert before the first digit larger than x. Otherwise append.',
    g: R => ({ n: (R.chance(0.4) ? '-' : '') + R.str(R.int(1, 5), '123456789'), x: R.int(1, 9) }),
    s(I, T) { const res = (() => { const neg = I.n[0] === '-', s = neg ? I.n.slice(1) : I.n; let i = 0; while (i < s.length && (neg ? +s[i] <= I.x : +s[i] >= I.x)) i++; T.at({ n: I.n, x: I.x }); T.yn('Is n negative?', neg, 'If it is, x goes before the first digit larger than x.'); T.n('Insert x before which digit index (of the digits)?', i, neg ? 'First digit larger than x.' : 'First digit smaller than x.'); return (neg ? '-' : '') + s.slice(0, i) + I.x + s.slice(i); })(); T.n('Length of the result?', res.length, 'One more character than n.'); return res; }
  });

  D('merge-triplets-to-form-target-triplet', {
    t: 'Merge Triplets to Form Target: use only safe triplets',
    r: 'Ignore any triplet that exceeds the target in some coordinate. The remaining ones can all be merged; check that each target coordinate is matched by some of them.',
    g: R => ({ triplets: Array.from({ length: R.int(1, 4) }, () => R.ints(3, 1, 6)), target: R.ints(3, 2, 6) }),
    s(I, T) { const got = [false, false, false], t = I.target; for (const tr of I.triplets) { const safe = tr.every((v, i) => v <= t[i]); T.at({ triplet: `[${tr}]`, target: `[${t}]` }); T.yn('Safe to merge?', safe, 'No coordinate above the target.'); if (safe) tr.forEach((v, i) => { if (v === t[i]) got[i] = true; }); } return got.every(Boolean); }
  });

  D('largest-odd-number-in-string', {
    t: 'Largest Odd Number in String: cut after the last odd digit',
    r: 'The longest prefix ending in an odd digit is the largest odd substring. Find the last odd digit.',
    g: R => ({ num: String(R.int(1, 99999)) }),
    s(I, T) { const res = (() => { let i = I.num.length - 1; while (i >= 0 && +I.num[i] % 2 === 0) i--; T.at({ num: A([...I.num]) }); T.yn('Is the last digit odd?', +I.num[I.num.length - 1] % 2 === 1, 'Then the whole number is the answer.'); T.n('Index of the last odd digit (−1 if none)?', i, 'Scan from the right.'); return I.num.slice(0, i + 1); })(); T.n('Length of the answer?', res.length, 'Everything up to the last odd digit.'); return res; }
  });

  D('game-of-nim', {
    t: 'Game of Nim: XOR of the piles',
    r: 'The first player wins exactly when the XOR of all pile sizes is non-zero.',
    g: R => ({ piles: R.ints(R.int(1, 4), 1, 7) }),
    s(I, T) { let x = 0; I.piles.forEach((p, i) => { x ^= p; T.at({ piles: A(I.piles, { hl: [i] }) }); T.n('Running XOR?', x, `XOR in ${p}.`); }); return x !== 0; }
  });

  D('remove-one-element-to-make-the-array-strictly-increasing', {
    t: 'Remove One Element to Be Strictly Increasing',
    r: 'At the first drop nums[i] at most nums[i−1], try removing nums[i−1] or nums[i] and check the rest. More than one drop needing removal means false.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 9) }),
    s(I, T) { const res = (() => { const a = I.nums, inc = b => b.every((v, i) => !i || v > b[i - 1]); const i = a.findIndex((v, k) => k && v <= a[k - 1]); T.at({ nums: A(a) }); T.n('Index of the first drop (−1 if none)?', i, 'First place where a value is not bigger than the one before it.'); if (i < 0) { T.n('Drops in the array?', 0, 'Already strictly increasing.'); return true; } T.n('Drops in the array?', a.filter((v, k) => k && v <= a[k - 1]).length, 'More than one means it is impossible.'); return inc(a.filter((_, k) => k !== i - 1)) || inc(a.filter((_, k) => k !== i)); })(); T.yn('Can one removal fix it?', res, 'Try removing either side of the first drop.'); return res; }
  });

  D('eliminate-maximum-number-of-monsters', {
    t: 'Eliminate Maximum Monsters: sort by arrival time',
    r: 'Monster i arrives at dist divided by speed, rounded up. Sort arrivals; you shoot one per minute starting at minute 0, so the k-th shot (minute k) needs arrival > k.',
    g: R => { const n = R.int(1, 6); return { dist: R.ints(n, 1, 9), speed: R.ints(n, 1, 3) }; },
    s(I, T) { const t = sorted(I.dist.map((d, i) => Math.ceil(d / I.speed[i]))); for (let k = 0; k < t.length; k++) { T.at({ arrivals: A(t, { hl: [k] }), minute: k }); T.yn(`Can you shoot monster ${k} at minute ${k}?`, t[k] > k, `It arrives at ${t[k]}.`); if (t[k] <= k) return k; } return t.length; }
  });
})();
