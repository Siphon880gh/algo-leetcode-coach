/* v2 games: heaps & priority queues (02). */
(function () {
  'use strict';
  const { D, A, G, K, Q } = LCGame.H;
  const PQ = cmp => { const a = []; return { push(x) { let i = a.length; a.push(x); while (i > 0 && cmp(a[i - 1], x) > 0) { a[i] = a[i - 1]; i--; } a[i] = x; }, pop() { return a.shift(); }, peek() { return a[0]; }, get size() { return a.length; }, items() { return a.slice(); } }; };
  const sum = a => a.reduce((x, y) => x + y, 0);
  const gcd = (a, b) => b ? gcd(b, a % b) : a;
  const MOD = 1000000007n;
  const powMod = (b, e) => { let r = 1n; b %= MOD; while (e > 0n) { if (e & 1n) r = r * b % MOD; b = b * b % MOD; e >>= 1n; } return r; };
  const colMaxSum = (g, T) => { const rows = g.map(r => r.slice().sort((a, b) => b - a)); let s = 0; for (let j = 0; j < rows[0].length; j++) { const m = Math.max(...rows.map(r => r[j])); s += m; if (j < 5) { T.at({ sortedRows: G(rows, { hl: rows.map((_, i) => [i, j]) }) }); T.n(`Score added in round ${j + 1}?`, m, 'Largest among the removed values.'); } } return s; };
  const multiply = (I, T) => { const a = I.nums.slice(); for (let t = 0; t < I.k; t++) { let mi = 0; a.forEach((v, i) => { if (v < a[mi]) mi = i; }); if (t < 5) { T.at({ nums: A(a.slice(), { i: mi }) }); T.n('Index of the minimum (first on ties)?', mi, 'Min-heap by (value, index).'); } a[mi] *= I.multiplier; } return a; };

  D('minimum-operations-to-halve-array-sum', {
    t: 'Minimum Operations to Halve Array Sum',
    r: 'Always halve the current largest number (max-heap); count operations until the total reduction reaches half the original sum.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 20) }),
    s(I, T) { const h = PQ((a, b) => b - a); I.nums.forEach(x => h.push(x)); const target = sum(I.nums) / 2; let red = 0, ops = 0; while (red < target) { const x = h.pop(); red += x / 2; h.push(x / 2); ops++; if (ops <= 5) { T.at({ heap: A(h.items().map(v => +v.toFixed(2))), target }); T.n('Total reduced so far?', +red.toFixed(4), `Halve the largest, ${x}.`); } } return ops; }
  });

  D('largest-number-after-digit-swaps-by-parity', {
    t: 'Largest Number After Digit Swaps by Parity',
    r: 'Odd digits can only trade with odd digits, even with even. Sort each parity group descending and refill the positions of that parity from left to right.',
    g: R => ({ num: R.int(1, 999999) }),
    s(I, T) { const d = [...String(I.num)].map(Number), odd = d.filter(x => x % 2).sort((a, b) => b - a), even = d.filter(x => x % 2 === 0).sort((a, b) => b - a); const out = d.map(x => x % 2 ? odd.shift() : even.shift()); out.slice(0, 5).forEach((v, i) => { T.at({ digits: A(d, { i }) }); T.n(`Digit placed at position ${i}?`, v, 'Largest unused digit of the same parity.'); }); return +out.join(''); }
  });

  D('maximum-product-after-k-increments', {
    t: 'Maximum Product After K Increments',
    r: 'Each increment should go to the current smallest number (min-heap). Multiply everything at the end, mod 1e9+7.',
    g: R => ({ nums: R.ints(R.int(1, 4), 0, 6), k: R.int(1, 6) }),
    s(I, T) { const h = PQ((a, b) => a - b); I.nums.forEach(x => h.push(x)); for (let i = 0; i < I.k; i++) { const x = h.pop(); h.push(x + 1); if (i < 5) { T.at({ heap: A(h.items()) }); T.n('Which value was incremented?', x, 'The smallest.'); } } return Number(h.items().reduce((p, v) => p * BigInt(v) % MOD, 1n)); }
  });

  D('minimum-amount-of-time-to-fill-cups', {
    t: 'Minimum Amount of Time to Fill Cups',
    r: 'Fill the two largest counts together each second. The answer is max(largest, ⌈total/2⌉).',
    g: R => ({ amount: R.ints(3, 0, 8) }),
    s(I, T) { const res = (() => { const m = Math.max(...I.amount), s = sum(I.amount); T.at({ amount: A(I.amount) }); T.n('Largest single count?', m, 'Only one of that type per second.'); T.n('Half the total, rounded up?', Math.ceil(s / 2), 'At most two cups per second.'); return Math.max(m, Math.ceil(s / 2)); })(); T.n('Fewest seconds?', res, 'The larger of the two limits.'); return res; }
  });

  D('max-sum-of-a-pair-with-equal-sum-of-digits', {
    t: 'Max Sum of a Pair With Equal Sum of Digits',
    r: 'Group numbers by digit sum, keeping only the best value seen per group; each new number pairs with that best value.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 60) }),
    s(I, T) { const best = {}; let ans = -1; I.nums.forEach((x, i) => { const d = [...String(x)].reduce((a, c) => a + +c, 0); if (i < 6) { T.at({ nums: A(I.nums, { i }), bestByDigitSum: K({ ...best }) }); T.n(`Digit sum of ${x}?`, d, 'Add its digits.'); } if (best[d] !== undefined) ans = Math.max(ans, best[d] + x); best[d] = Math.max(best[d] || 0, x); }); return ans; }
  });

  D('query-kth-smallest-trimmed-number', {
    t: 'Query Kth Smallest Trimmed Number',
    r: 'For each query [k, trim], keep only the last `trim` digits of every string, sort by (trimmed value, index), and return the index of the k-th.',
    g: R => { const L = R.int(1, 3), nums = Array.from({ length: R.int(1, 5) }, () => R.str(L, '0123456789')); return { nums, queries: Array.from({ length: R.int(1, 3) }, () => [R.int(1, nums.length), R.int(1, L)]) }; },
    s(I, T) { return I.queries.map(([k, t], qi) => { const tr = I.nums.map(s => s.slice(-t)), ord = tr.map((_, i) => i).sort((a, b) => (tr[a] < tr[b] ? -1 : tr[a] > tr[b] ? 1 : a - b)); if (qi < 4) { T.at({ trimmed: A(tr), k }); T.n('Index of the k-th smallest?', ord[k - 1], 'Ties by original index.'); } return ord[k - 1]; }); }
  });

  D('minimum-deletions-to-make-array-divisible', {
    t: 'Minimum Deletions to Make Array Divisible',
    r: 'An element divides every numsDivide value iff it divides their gcd. Sort nums; the answer is the index of the first element dividing the gcd (−1 if none).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 8), numsDivide: (m => R.ints(R.int(1, 4), 1, 4).map(x => x * m))(R.int(1, 6)) }),
    s(I, T) { const res = (() => { const g = I.numsDivide.reduce(gcd), s = I.nums.slice().sort((a, b) => a - b); T.at({ numsDivide: A(I.numsDivide) }); T.n('gcd of numsDivide?', g, 'The new minimum must divide it.'); T.n('Smallest value in nums?', s[0], 'Sort nums and try values in order.'); const i = s.findIndex(x => g % x === 0); return i; })(); T.n('Fewest deletions? (−1 if impossible)', res, 'Index of the first value that divides the gcd.'); return res; }
  });

  D('make-array-zero-by-subtracting-equal-amounts', {
    t: 'Make Array Zero by Subtracting Equal Amounts',
    r: 'Each operation removes the current smallest positive value entirely (and lowers the rest). So the answer is the number of distinct positive values.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 6) }),
    s(I, T) { const res = (() => { const d = new Set(I.nums.filter(x => x > 0)); T.at({ nums: A(I.nums) }); T.n('Zeros at the start?', I.nums.filter(x => x === 0).length, 'They need no work.'); T.n('Smallest positive value (0 if none)?', d.size ? Math.min(...d) : 0, 'Subtract it everywhere.'); return d.size; })(); T.n('Operations needed?', res, 'One per distinct positive value.'); return res; }
  });

  D('find-the-k-sum-of-an-array', {
    t: 'Find the K-Sum of an Array',
    r: 'The largest sum is the sum of positives. Every other sum subtracts a subset of |nums|. Sort |nums| and generate subtraction amounts in order with a min-heap: from (s, i) push (s + b[i+1], i+1) and (s − b[i] + b[i+1], i+1).',
    g: R => { const a = R.ints(R.int(1, 5), -6, 6); return { nums: a, k: R.int(1, Math.min(8, 2 ** a.length)) }; },
    s(I, T) { const top = sum(I.nums.filter(x => x > 0)), b = I.nums.map(Math.abs).sort((x, y) => x - y); T.at({ nums: A(I.nums) }); T.n('Largest subsequence sum?', top, 'Sum of positives.'); if (I.k === 1) return top; const h = PQ((x, y) => x[0] - y[0]); h.push([b[0], 0]); let s = 0; for (let t = 1; t < I.k; t++) { const [v, i] = h.pop(); s = v; if (t <= 4) { T.at({ sortedAbs: A(b, { i }) }); T.n(`Subtraction for sum #${t + 1}?`, v, 'Pop the smallest amount.'); } if (i + 1 < b.length) { h.push([v + b[i + 1], i + 1]); h.push([v - b[i] + b[i + 1], i + 1]); } } return top - s; }
  });

  D('meeting-rooms-iii', {
    t: 'Meeting Rooms III',
    r: 'Process meetings by start. Free rooms in a min-heap by index; busy rooms by (end, index). Release rooms ending ≤ start; if none free, delay the meeting into the earliest-ending room. Return the room used most (smallest index on ties).',
    g: R => { const n = R.int(1, 3), s = R.distinct(R.int(1, 6), 0, 12); return { n, meetings: s.map(x => [x, x + R.int(1, 5)]) }; },
    s(I, T) { const ms = I.meetings.slice().sort((a, b) => a[0] - b[0]), end = Array(I.n).fill(0), c = Array(I.n).fill(0); ms.forEach(([s, e], k) => { let r = end.findIndex(t => t <= s), st = s; if (r < 0) { r = 0; end.forEach((t, i) => { if (t < end[r]) r = i; }); st = end[r]; } end[r] = st + e - s; c[r]++; if (k < 6) { T.at({ meeting: `[${s}, ${e})`, roomFreeAt: A(end.slice(), { i: r }) }); T.n('Room used?', r, 'Lowest free room, else the earliest to free up.'); } }); return c.indexOf(Math.max(...c)); }
  });

  D('most-popular-video-creator', {
    t: 'Most Popular Video Creator',
    r: 'Sum views per creator and track each creator\'s best video (most views, then lexicographically smallest id). Return every creator with the maximum total.',
    g: R => { const n = R.int(1, 6); return { creators: Array.from({ length: n }, () => R.pick(['al', 'bo', 'cy'])), ids: Array.from({ length: n }, () => R.pick(['a', 'b', 'c', 'd'])), views: R.ints(n, 0, 6) }; },
    cmp: (o, e) => Array.isArray(o) && JSON.stringify(o.map(x => JSON.stringify(x)).sort()) === JSON.stringify(e.map(x => JSON.stringify(x)).sort()),
    s(I, T) { const res = (() => { const tot = {}, best = {}; I.creators.forEach((c, i) => { tot[c] = (tot[c] || 0) + I.views[i]; const b = best[c]; if (b === undefined || I.views[i] > I.views[b] || (I.views[i] === I.views[b] && I.ids[i] < I.ids[b])) best[c] = i; }); const m = Math.max(...Object.values(tot)); T.at({ totals: K(tot) }); T.n('How many creators?', Object.keys(tot).length, 'Group views by creator.'); T.n('Highest popularity?', m, 'Sum of views per creator.'); return Object.keys(tot).filter(c => tot[c] === m).map(c => [c, I.ids[best[c]]]); })(); T.n('Creators tied for the top?', res.length, 'Everyone with the highest popularity.'); return res; }
  });

  D('delete-greatest-value-in-each-row', {
    t: 'Delete Greatest Value in Each Row',
    r: 'Sort every row; in round j each row removes its j-th largest, and the answer adds the maximum of those. So sum column maxima of the sorted rows.',
    g: R => ({ grid: R.grid(R.int(1, 3), R.int(1, 4), 1, 9) }),
    s(I, T) { return colMaxSum(I.grid, T); }
  });

  D('reward-top-k-students', {
    t: 'Reward Top K Students',
    r: 'Score each report: +3 per positive word, −1 per negative word. Sort students by score descending, then id ascending; take k.',
    g: R => { const n = R.int(1, 4), w = ['good', 'bad', 'ok', 'fine', 'poor']; return { positive_feedback: ['good', 'fine'], negative_feedback: ['bad', 'poor'], report: Array.from({ length: n }, () => Array.from({ length: R.int(1, 4) }, () => R.pick(w)).join(' ')), student_id: R.distinct(n, 1, 20), k: R.int(1, n) }; },
    s(I, T) { const P = new Set(I.positive_feedback), N = new Set(I.negative_feedback), sc = I.report.map(r => r.split(' ').reduce((s, w) => s + (P.has(w) ? 3 : N.has(w) ? -1 : 0), 0)); sc.slice(0, 4).forEach((v, i) => { T.at({ report: I.report[i] }); T.n(`Score of student ${I.student_id[i]}?`, v, '+3 positive, −1 negative.'); }); return I.student_id.map((id, i) => [id, sc[i]]).sort((a, b) => b[1] - a[1] || a[0] - b[0]).slice(0, I.k).map(x => x[0]); }
  });

  D('maximal-score-after-applying-k-operations', {
    t: 'Maximal Score After Applying K Operations',
    r: 'k times: take the largest value from a max-heap, add it to the score, push back ⌈x/3⌉.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 30), k: R.int(1, 5) }),
    s(I, T) { const h = PQ((a, b) => b - a); I.nums.forEach(x => h.push(x)); let s = 0; for (let i = 0; i < I.k; i++) { const x = h.pop(); s += x; h.push(Math.ceil(x / 3)); T.at({ heap: A(h.items()) }); T.n('Score so far?', s, `Took ${x}, pushed back ⌈${x}/3⌉.`); } return s; }
  });

  D('time-to-cross-a-bridge', {
    t: 'Time to Cross a Bridge',
    r: 'Simulate with four heaps: waiting on each side (least efficient first: larger left+right, then larger index) and working on each side (by finish time). Right-side waiters cross first; left-side waiters cross only while boxes remain unassigned. When idle, jump to the next finish time.',
    g: R => { const k = R.int(1, 3); return { n: R.int(1, 3), k, time: Array.from({ length: k }, () => R.ints(4, 1, 5)) }; },
    s(I, T) { const tm = I.time, worse = (a, b) => (tm[b][0] + tm[b][2]) - (tm[a][0] + tm[a][2]) || b - a; const wL = PQ(worse), wR = PQ(worse), kL = PQ((a, b) => a[0] - b[0]), kR = PQ((a, b) => a[0] - b[0]); for (let i = 0; i < I.k; i++) wL.push(i); let n = I.n, cur = 0, asks = 0; for (;;) { while (kL.size && kL.peek()[0] <= cur) wL.push(kL.pop()[1]); while (kR.size && kR.peek()[0] <= cur) wR.push(kR.pop()[1]); if (wR.size) { const i = wR.pop(); cur += tm[i][2]; if (asks++ < 5) { T.at({ time: cur - tm[i][2], waitingRight: A(wR.items()) }); T.n('Which worker crosses right → left?', i, 'Right side has priority; least efficient first.'); } if (!n && !wR.size && !kR.size) return cur; kL.push([cur + tm[i][3], i]); } else if (n && wL.size) { const i = wL.pop(); cur += tm[i][0]; n--; if (asks++ < 5) { T.at({ time: cur - tm[i][0], boxesLeft: n + 1 }); T.n('Which worker crosses left → right?', i, 'Least efficient waiting worker.'); } kR.push([cur + tm[i][1], i]); } else { let nx = Infinity; if (kR.size) nx = kR.peek()[0]; if (n && kL.size) nx = Math.min(nx, kL.peek()[0]); cur = nx; } } }
  });

  D('maximum-subsequence-score', {
    t: 'Maximum Subsequence Score',
    r: 'Sort pairs by nums2 descending: the current nums2 is the minimum. Keep a min-heap of the k largest nums1 values; score = sum × current nums2.',
    g: R => { const n = R.int(1, 5); return { nums1: R.ints(n, 0, 9), nums2: R.ints(n, 0, 9), k: R.int(1, n) }; },
    s(I, T) { const p = I.nums1.map((v, i) => [v, I.nums2[i]]).sort((a, b) => b[1] - a[1]), h = PQ((a, b) => a - b); let s = 0, best = 0; p.forEach(([v, m], i) => { h.push(v); s += v; if (h.size > I.k) s -= h.pop(); if (h.size === I.k) { best = Math.max(best, s * m); if (i < 5) { T.at({ min2: m, picked1: A(h.items()) }); T.n('Score with this as the minimum?', s * m, 'sum(nums1) × min(nums2).'); } } }); return best; }
  });

  D('put-marbles-in-bags', {
    t: 'Put Marbles in Bags',
    r: 'Each cut between i and i+1 adds w[i] + w[i+1] to the score. Choose k − 1 cuts: max score uses the largest pair sums, min the smallest; return the difference.',
    g: R => { const w = R.ints(R.int(1, 6), 1, 9); return { weights: w, k: R.int(1, w.length) }; },
    s(I, T) { const res = (() => { const p = []; for (let i = 0; i + 1 < I.weights.length; i++) p.push(I.weights[i] + I.weights[i + 1]); p.sort((a, b) => a - b); T.at({ pairSums: A(p) }); const c = I.k - 1; T.n('How many cuts?', c, 'k bags need k minus 1 cuts.'); T.n('Sum of the largest cut pair sums?', sum(p.slice(p.length - c)), 'Best cuts for the maximum score.'); return sum(p.slice(p.length - c)) - sum(p.slice(0, c)); })(); T.n('Maximum score minus minimum score?', res, 'Largest cut sums minus smallest cut sums.'); return res; }
  });

  D('take-gifts-from-the-richest-pile', {
    t: 'Take Gifts From the Richest Pile',
    r: 'k times: pop the largest pile and push back ⌊√x⌋. Sum the piles at the end.',
    g: R => ({ gifts: R.ints(R.int(1, 5), 1, 100), k: R.int(1, 4) }),
    s(I, T) { const h = PQ((a, b) => b - a); I.gifts.forEach(x => h.push(x)); for (let i = 0; i < I.k; i++) { const x = h.pop(); h.push(Math.floor(Math.sqrt(x))); T.at({ piles: A(h.items()) }); T.n('Pile left after taking from the richest?', Math.floor(Math.sqrt(x)), `⌊√${x}⌋.`); } return sum(h.items()); }
  });

  D('find-score-of-an-array-after-marking-all-elements', {
    t: 'Find Score of an Array After Marking All Elements',
    r: 'Process (value, index) in increasing order; if the index is unmarked, add the value and mark it and its two neighbors.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { const ord = I.nums.map((v, i) => [v, i]).sort((a, b) => a[0] - b[0] || a[1] - b[1]), mk = I.nums.map(() => false); let s = 0, k = 0; for (const [v, i] of ord) { if (mk[i]) continue; s += v; mk[i] = mk[i - 1] = mk[i + 1] = true; if (k++ < 5) { T.at({ nums: A(I.nums, { i }) }); T.n('Score so far?', s, 'Smallest unmarked, then mark neighbors.'); } } return s; }
  });

  D('make-the-prefix-sum-non-negative', {
    t: 'Make the Prefix Sum Non-negative',
    r: 'Scan with a running prefix and a min-heap of negatives seen. Whenever the prefix drops below 0, move the most negative element to the end (pop it, add it back) and count one move.',
    g: R => { for (;;) { const a = R.ints(R.int(1, 7), -6, 6); if (sum(a) >= 0) return { nums: a }; } },
    s(I, T) { const res = (() => { const h = PQ((a, b) => a - b); let p = 0, c = 0; T.at({ nums: A(I.nums) }); T.n('Negative values?', I.nums.filter(x => x < 0).length, 'Only these can be moved.'); I.nums.forEach((x, i) => { if (x < 0) h.push(x); p += x; if (p < 0) { const y = h.pop(); p -= y; c++; T.at({ nums: A(I.nums, { i }) }); T.n('Value moved to the end?', y, 'The most negative so far.'); } }); return c; })(); T.n('Fewest moves?', res, 'One per time the prefix sum dipped below 0.'); return res; }
  });

  D('mice-and-cheese', {
    t: 'Mice and Cheese',
    r: 'Start with mouse 2 eating everything. Switching cheese i to mouse 1 gains reward1[i] − reward2[i]; take the k largest gains.',
    g: R => { const n = R.int(1, 6); return { reward1: R.ints(n, 1, 9), reward2: R.ints(n, 1, 9), k: R.int(0, n) }; },
    s(I, T) { const res = (() => { const base = sum(I.reward2), d = I.reward1.map((v, i) => v - I.reward2[i]).sort((a, b) => b - a); T.at({ reward2: A(I.reward2) }); T.n('Points if mouse 2 eats everything?', base, 'Sum of reward2.'); T.at({ gains: A(d) }); T.n(`Extra points from the top ${I.k} gains?`, sum(d.slice(0, I.k)), 'Give mouse 1 the cheeses with the biggest gain.'); return base + sum(d.slice(0, I.k)); })(); T.n('Maximum points?', res, 'Base plus the chosen gains.'); return res; }
  });

  D('sum-in-a-matrix', {
    t: 'Sum in a Matrix',
    r: 'Sort every row; each round removes one value per row and adds the maximum of them, so sum the column maxima of the sorted rows.',
    g: R => ({ nums: R.grid(R.int(1, 4), R.int(1, 3), 0, 9) }),
    s(I, T) { return colMaxSum(I.nums, T); }
  });

  D('maximum-elegance-of-a-k-length-subsequence', {
    t: 'Maximum Elegance of a K-Length Subsequence',
    r: 'Take the k most profitable items. Then scan the rest in profit order: an item with an unseen category may replace the smallest duplicate-category item, trading profit for distinct² gain. Track the best elegance.',
    g: R => { const n = R.int(1, 6); return { items: Array.from({ length: n }, () => [R.int(1, 9), R.int(1, 3)]), k: R.int(1, n) }; },
    s(I, T) { const res = (() => { const it = I.items.slice().sort((a, b) => b[0] - a[0]), seen = new Set(), dup = []; let tot = 0; for (let i = 0; i < I.k; i++) { tot += it[i][0]; if (seen.has(it[i][1])) dup.push(it[i][0]); else seen.add(it[i][1]); } let best = tot + seen.size ** 2; T.at({ topK: A(it.slice(0, I.k).map(x => `${x[0]} in category ${x[1]}`)) }); T.n('Distinct categories among them?', seen.size, 'Repeats can be swapped out later.'); T.n('Elegance of the k most profitable?', best, 'Total profit plus the distinct count squared.'); for (let i = I.k; i < it.length; i++) if (!seen.has(it[i][1]) && dup.length) { tot += it[i][0] - dup.pop(); seen.add(it[i][1]); best = Math.max(best, tot + seen.size ** 2); } return best; })(); T.n('Maximum elegance?', res, 'Best after swapping repeats for new categories.'); return res; }
  });

  D('maximum-spending-after-buying-items', {
    t: 'Maximum Spending After Buying Items',
    r: 'Every shop\'s cheapest item is at its right end; a min-heap over those yields all items in increasing price. Buy the d-th cheapest on day d.',
    g: R => { const n = R.int(1, 3); return { values: Array.from({ length: R.int(1, 3) }, () => R.sorted(n, 1, 9).reverse()) }; },
    s(I, T) { const all = I.values.flat().sort((a, b) => a - b); all.slice(0, 5).forEach((v, i) => { T.at({ day: i + 1 }); T.n(`Price bought on day ${i + 1}?`, v, 'Cheapest remaining (heap of shop ends).'); }); return all.reduce((s, v, i) => s + v * (i + 1), 0); }
  });

  D('minimum-number-game', {
    t: 'Minimum Number Game',
    r: 'Each round Alice removes the minimum, then Bob removes the next minimum; Bob appends first. So sort and swap each adjacent pair.',
    g: R => ({ nums: R.ints(2 * R.int(1, 3), 1, 9) }),
    s(I, T) { const s = I.nums.slice().sort((a, b) => a - b), out = []; for (let i = 0; i < s.length; i += 2) { out.push(s[i + 1], s[i]); T.at({ sorted: A(s, { i }) }); T.n('Number Bob appends this round?', s[i + 1], 'Bob takes the second smallest and appends first.'); } return out; }
  });

  D('minimum-operations-to-exceed-threshold-value-ii', {
    t: 'Minimum Operations to Exceed Threshold Value II',
    r: 'While the smallest is below k: pop the two smallest x ≤ y and push 2x + y (min-heap). Count operations.',
    g: R => { for (;;) { const a = R.ints(R.int(2, 6), 1, 12), k = R.int(1, 25), h = a.slice().sort((x, y) => x - y); while (h.length >= 2 && h[0] < k) { const x = h.shift(), y = h.shift(); h.push(2 * x + y); h.sort((p, q) => p - q); } if (h[0] >= k) return { nums: a, k }; } },
    s(I, T) { const h = PQ((a, b) => a - b); I.nums.forEach(x => h.push(x)); let c = 0; while (h.peek() < I.k) { const x = h.pop(), y = h.pop(); h.push(2 * x + y); c++; if (c <= 5) { T.at({ heap: A(h.items()), k: I.k }); T.n('New value pushed?', 2 * x + y, `min(${x}, ${y})·2 + max.`); } } return c; }
  });

  D('mark-elements-on-array-by-performing-queries', {
    t: 'Mark Elements on Array by Performing Queries',
    r: 'Keep the unmarked sum. For each query mark its index (if unmarked), then pop k unmarked elements from a min-heap of (value, index), skipping marked ones. Record the unmarked sum.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 1, 5), queries: Array.from({ length: R.int(1, n) }, () => [R.int(0, n - 1), R.int(0, 2)]) }; },
    s(I, T) { const ord = I.nums.map((v, i) => [v, i]).sort((a, b) => a[0] - b[0] || a[1] - b[1]), mk = I.nums.map(() => false); let s = sum(I.nums), p = 0; return I.queries.map(([idx, k], qi) => { if (!mk[idx]) { mk[idx] = true; s -= I.nums[idx]; } while (k > 0 && p < ord.length) { const [v, i] = ord[p++]; if (mk[i]) continue; mk[i] = true; s -= v; k--; } if (qi < 4) { T.at({ nums: A(I.nums), marked: A(mk.map(x => x ? 'x' : '·')) }); T.n('Unmarked sum after this query?', s, 'Mark the index, then the k smallest.'); } return s; }); }
  });

  D('replace-question-marks-in-string-to-minimize-its-value', {
    t: 'Replace Question Marks in String to Minimize Its Value',
    r: 'Each \'?\' takes the letter with the lowest current count (smallest letter on ties) from a min-heap. Then sort the chosen letters and place them into the \'?\' positions left to right.',
    g: R => ({ s: R.str(R.int(1, 7), 'ab??') }),
    s(I, T) { const c = Array(26).fill(0); for (const ch of I.s) if (ch !== '?') c[ch.charCodeAt(0) - 97]++; const pick = []; for (const ch of I.s) if (ch === '?') { let b = 0; for (let i = 1; i < 26; i++) if (c[i] < c[b]) b = i; c[b]++; pick.push(String.fromCharCode(97 + b)); if (pick.length <= 4) { T.at({ s: I.s, chosen: A(pick.slice()) }); T.c('Letter chosen for this "?"?', [...new Set(['a', 'b', 'c', pick[pick.length - 1]])], pick[pick.length - 1], 'Least used, then smallest.'); } } pick.sort(); let j = 0; return [...I.s].map(ch => ch === '?' ? pick[j++] : ch).join(''); }
  });

  D('most-frequent-ids', {
    t: 'Most Frequent IDs',
    r: 'Maintain counts per id plus a max-heap of (count, id) entries; after each update pop stale entries until the top matches the live count.',
    g: R => { const n = R.int(1, 6), c = {}, nums = [], freq = []; for (let i = 0; i < n; i++) { const id = R.int(1, 3), cur = c[id] || 0, f = cur && R.chance(0.4) ? -R.int(1, cur) : R.int(1, 3); c[id] = cur + f; nums.push(id); freq.push(f); } return { nums, freq }; },
    s(I, T) { const c = {}; return I.nums.map((id, i) => { c[id] = (c[id] || 0) + I.freq[i]; const m = Math.max(0, ...Object.values(c)); if (i < 5) { T.at({ counts: K({ ...c }) }); T.n('Highest frequency now?', m, 'Live top of the heap.'); } return m; }); }
  });

  D('final-array-state-after-k-multiplication-operations-i', {
    t: 'Final Array State After K Multiplication Operations I',
    r: 'k times: pop the minimum (first index on ties) from a min-heap of (value, index), multiply it, and push it back.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 9), k: R.int(1, 5), multiplier: R.int(1, 3) }),
    s(I, T) { return multiply(I, T); }
  });

  D('final-array-state-after-k-multiplication-operations-ii', {
    t: 'Final Array State After K Multiplication Operations II',
    r: 'Simulate with a heap only until the minimum times the multiplier exceeds the maximum. After that the operations cycle: with q = ⌊k/n⌋ and r = k mod n, every element gets q multiplications and the r smallest (by value, index) get one more — use fast power mod 1e9+7.',
    g: R => ({ nums: R.ints(R.int(1, 4), 1, 9), k: R.int(1, 12), multiplier: R.int(1, 3) }),
    s(I, T) { const n = I.nums.length, m = I.multiplier; if (m === 1) { T.at({ multiplier: 1 }); T.yn('Does anything change?', false, 'Multiplying by 1.'); T.n('Value at index 0 at the end?', I.nums[0], 'Unchanged.'); T.n('Operations that change a value?', 0, 'None of them do.'); return I.nums.slice(); } const a = I.nums.slice(); let k = I.k, steps = 0; for (; k > 0; k--) { let mi = 0; a.forEach((v, i) => { if (v < a[mi]) mi = i; }); if (a[mi] * m > Math.max(...a)) break; a[mi] *= m; steps++; } T.at({ nums: A(a.slice()), opsLeft: k }); T.n('Operations done before the cycle starts?', steps, 'Until the min times the multiplier passes the max.'); T.n('Full rounds over every element after that?', Math.floor(k / n), 'Each round multiplies every value once.'); T.n('Extra operations after the full rounds?', k % n, 'They go to the smallest values.'); const ord = a.map((v, i) => [v, i]).sort((x, y) => x[0] - y[0] || x[1] - y[1]), q = Math.floor(k / n), r = k % n, out = []; ord.forEach(([v, i], p) => { out[i] = Number(BigInt(v) % MOD * powMod(BigInt(m), BigInt(q + (p < r ? 1 : 0))) % MOD); }); return out; }
  });

  D('k-th-nearest-obstacle-queries', {
    t: 'K-th Nearest Obstacle Queries',
    r: 'Keep a max-heap of the k smallest distances |x| + |y|. After each insertion, if the heap holds k values its top is the answer; otherwise −1.',
    g: R => ({ queries: Array.from({ length: R.int(1, 6) }, () => [R.int(-5, 5), R.int(-5, 5)]).filter((q, i, a) => a.findIndex(p => p[0] === q[0] && p[1] === q[1]) === i), k: R.int(1, 3) }),
    s(I, T) { const h = PQ((a, b) => b - a); return I.queries.map(([x, y], i) => { const d = Math.abs(x) + Math.abs(y); h.push(d); if (h.size > I.k) h.pop(); const v = h.size === I.k ? h.peek() : -1; if (i < 5) { T.at({ obstacle: `(${x}, ${y})`, kNearest: A(h.items()) }); T.n('k-th nearest distance (−1 if fewer than k)?', v, 'Top of the size-k max-heap.'); } return v; }); }
  });

  D('zero-array-transformation-iii', {
    t: 'Zero Array Transformation III',
    r: 'Scan indices left to right. Push the right ends of queries starting here into a max-heap. While the applied decrements at i are below nums[i], use the available query reaching furthest right (fail if none reaches i). Answer = unused queries.',
    g: R => { const n = R.int(1, 4); return { nums: R.ints(n, 0, 2), queries: Array.from({ length: R.int(1, 5) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1)]; }) }; },
    s(I, T) { const n = I.nums.length, qs = I.queries.slice().sort((a, b) => a[0] - b[0]), h = PQ((a, b) => b - a), diff = Array(n + 1).fill(0); let j = 0, cur = 0, used = 0; for (let i = 0; i < n; i++) { cur += diff[i]; while (j < qs.length && qs[j][0] <= i) h.push(qs[j++][1]); while (cur < I.nums[i]) { if (!h.size || h.peek() < i) { T.at({ nums: A(I.nums, { i }) }); T.yn('Is there a query left that covers this index?', false, 'Then it is impossible.'); return -1; } const r = h.pop(); cur++; diff[r + 1]--; used++; } T.at({ nums: A(I.nums, { i }), decrementsHere: cur }); T.n('Queries used so far?', used, 'Pick the one reaching furthest right.'); } return I.queries.length - used; }
  });

  D('maximum-sum-with-at-most-k-elements', {
    t: 'Maximum Sum With at Most K Elements',
    r: 'From row i only its limits[i] largest values are usable. Pool those candidates and take the k largest.',
    g: R => { const n = R.int(1, 3), m = R.int(1, 3), limits = R.ints(n, 0, m); return { grid: R.grid(n, m, 0, 9), limits, k: R.int(0, sum(limits)) }; },
    s(I, T) { const res = (() => { const pool = I.grid.flatMap((r, i) => r.slice().sort((a, b) => b - a).slice(0, I.limits[i])).sort((a, b) => b - a); T.at({ candidates: A(pool) }); T.n('How many candidates?', pool.length, 'Each row gives up to its limit.'); T.n('Largest candidate? (0 if none)', pool.length ? pool[0] : 0, 'Take the biggest first.'); return sum(pool.slice(0, I.k)); })(); T.n('Maximum sum?', res, 'The k largest candidates.'); return res; }
  });

  D('maximize-profit-from-task-assignment', {
    t: 'Maximize Profit from Task Assignment',
    r: 'Group tasks by required skill. Each worker of skill s takes the most profitable remaining task of skill s (max-heap per skill). The extra worker then takes the single most profitable leftover task.',
    g: R => ({ workers: R.ints(R.int(1, 5), 1, 4), tasks: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 4), R.int(1, 9) * 10]) }),
    s(I, T) { const res = (() => { const by = {}; I.tasks.forEach(([s, p]) => (by[s] = by[s] || []).push(p)); Object.values(by).forEach(a => a.sort((x, y) => y - x)); const wc = {}; I.workers.forEach(w => wc[w] = (wc[w] || 0) + 1); let tot = 0; const left = []; Object.entries(by).forEach(([s, a]) => { const c = wc[s] || 0; tot += sum(a.slice(0, c)); left.push(...a.slice(c)); }); T.at({ tasksBySkill: K(Object.fromEntries(Object.entries(by).map(([s, a]) => [s, a.join(', ')]))), workers: A(I.workers) }); T.n('Profit from skill-matched workers?', tot, 'Each takes the best task of its skill.'); T.n('Tasks left for the extra worker?', left.length, 'The extra worker takes the best of them.'); return tot + (left.length ? Math.max(...left) : 0); })(); T.n('Maximum profit?', res, 'Matched profit plus the best leftover task.'); return res; }
  });

  D('choose-k-elements-with-maximum-sum', {
    t: 'Choose K Elements with Maximum Sum',
    r: 'Sort indices by nums1. Sweep groups of equal nums1: answer each from the current top-k sum (min-heap of nums2 of strictly smaller nums1), then add the group to the heap.',
    g: R => { const n = R.int(1, 6); return { nums1: R.ints(n, 1, 6), nums2: R.ints(n, 1, 9), k: R.int(1, n) }; },
    s(I, T) { return I.nums1.map((v, i) => { const c = I.nums2.filter((_, j) => I.nums1[j] < v).sort((a, b) => b - a).slice(0, I.k), s = sum(c); if (i < 5) { T.at({ nums1: A(I.nums1, { i }), eligible: A(c) }); T.n('Sum of the k largest eligible nums2?', s, 'Only indices with smaller nums1.'); } return s; }); }
  });
})();
