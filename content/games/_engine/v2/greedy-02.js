/* v2 games: greedy (02). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const sorted = a => a.slice().sort((x, y) => x - y);
  const sameMultiset = (a, b) => JSON.stringify(sorted(a)) === JSON.stringify(sorted(b));
  const consecutiveGroups = (arr, k, T) => { if (arr.length % k) return false; const c = {}; arr.forEach(x => c[x] = (c[x] || 0) + 1); for (const x of Object.keys(c).map(Number).sort((a, b) => a - b)) { const n = c[x]; if (!n) continue; for (let j = 0; j < k; j++) { const ok = (c[x + j] || 0) >= n; T.at({ counts: K(c), start: x }); T.yn(`Are there at least ${n} copies of ${x + j}?`, ok, `${n} groups start at ${x}.`); if (!ok) return false; c[x + j] -= n; } } return true; };

  D('maximize-sum-of-array-after-k-negations', {
    t: 'Maximize Sum After K Negations: flip the most negative first',
    r: 'Sort. Flip negatives from the smallest while k lasts. If k is still odd afterwards, flip the element with the smallest absolute value once.',
    g: R => ({ nums: R.ints(R.int(1, 6), -6, 6), k: R.int(1, 5) }),
    s(I, T) { const a = sorted(I.nums); let k = I.k; for (let i = 0; i < a.length && k && a[i] < 0; i++, k--) { T.at({ nums: A(a, { hl: [i] }), k }); T.n(`Value at index ${i} after flipping?`, -a[i], 'Flip the most negative remaining.'); a[i] = -a[i]; } const s = a.reduce((x, y) => x + y, 0), m = Math.min(...a.map(Math.abs)); T.at({ nums: A(a), k }); T.yn('Is an odd number of flips left over?', k % 2 === 1, 'Then the smallest |value| must be flipped once.'); return k % 2 ? s - 2 * m : s; }
  });

  D('minimum-domino-rotations-for-equal-row', {
    t: 'Minimum Domino Rotations: the target must be on domino 0',
    r: 'Only tops[0] or bottoms[0] can fill a whole row. For each candidate x, every domino must show x on some side; count rotations to bring it on top and to the bottom; take the minimum.',
    g: R => { const n = R.int(2, 6), x = R.int(1, 3); const t = [], b = []; for (let i = 0; i < n; i++) { if (R.chance(0.85)) { const o = R.int(1, 6); R.chance(0.5) ? (t.push(x), b.push(o)) : (t.push(o), b.push(x)); } else { t.push(R.int(1, 6)); b.push(R.int(1, 6)); } } return { tops: t, bottoms: b }; },
    s(I, T) { let best = Infinity; for (const x of [...new Set([I.tops[0], I.bottoms[0]])]) { let rt = 0, rb = 0, ok = true; I.tops.forEach((t, i) => { const b = I.bottoms[i]; if (t !== x && b !== x) ok = false; else if (t !== x) rt++; else if (b !== x) rb++; }); T.at({ tops: A(I.tops), bottoms: A(I.bottoms), target: x }); T.yn(`Does every domino have a ${x}?`, ok, 'Otherwise this target is impossible.'); if (ok) { T.n(`Fewest rotations to make a row of ${x}s?`, Math.min(rt, rb), `top needs ${rt}, bottom needs ${rb}.`); best = Math.min(best, rt, rb); } } return best === Infinity ? -1 : best; }
  });

  D('two-city-scheduling', {
    t: 'Two City Scheduling: sort by the A − B difference',
    r: 'Sort people by aCost − bCost. The first half (who save most by going to A) go to A, the rest to B.',
    g: R => ({ costs: Array.from({ length: 2 * R.int(1, 3) }, () => [R.int(1, 50), R.int(1, 50)]) }),
    s(I, T) { const c = I.costs.slice().sort((x, y) => (x[0] - x[1]) - (y[0] - y[1])), n = c.length / 2; let t = 0; c.forEach((p, i) => { T.at({ sorted: A(c.map(q => `[${q}] Δ${q[0] - q[1]}`), { hl: [i] }), total: t }); T.c(`Person [${p}] flies to?`, ['A', 'B'], i < n ? 'A' : 'B', 'First half by aCost − bCost go to A.'); t += i < n ? p[0] : p[1]; }); return t; }
  });

  D('previous-permutation-with-one-swap', {
    t: 'Previous Permutation With One Swap',
    r: 'From the right, find the first i with arr[i] > arr[i+1]. Swap it with the largest value smaller than arr[i] to its right (the leftmost copy of that value). No such i: return arr.',
    g: R => ({ arr: R.ints(R.int(2, 6), 1, 5) }),
    s(I, T) { const res = (() => { const a = I.arr.slice(); let i = a.length - 2; while (i >= 0 && a[i] <= a[i + 1]) i--; T.at({ arr: A(a) }); T.n('Index to decrease (−1 if none)?', i, 'Rightmost i with arr[i] > arr[i + 1].'); if (i < 0) return a; let j = -1; for (let k = i + 1; k < a.length; k++) if (a[k] < a[i] && (j < 0 || a[k] > a[j])) j = k; T.at({ arr: A(a, { hl: [i] }) }); T.n('Swap with which index?', j, 'Largest smaller value to the right, leftmost copy.'); [a[i], a[j]] = [a[j], a[i]]; return a; })(); T.yn('Did the array change?', res.join() !== I.arr.join(), 'Only when some value is bigger than the next one.'); return res; }
  });

  D('distant-barcodes', {
    t: 'Distant Barcodes: most frequent into even slots first',
    r: 'Sort values by frequency (most first) and write them into positions 0, 2, 4, …, then 1, 3, 5, …. The most frequent value never touches itself.',
    g: R => { const a = R.ints(R.int(2, 7), 1, 3); const c = {}; a.forEach(x => c[x] = (c[x] || 0) + 1); return Math.max(...Object.values(c)) <= Math.ceil(a.length / 2) ? { barcodes: a } : { barcodes: [1, 1, 2, 2, 3] }; },
    cmp: (out, exp, I) => sameMultiset(out, I.barcodes) && out.every((v, i) => !i || v !== out[i - 1]),
    s(I, T) { const c = {}; I.barcodes.forEach(x => c[x] = (c[x] || 0) + 1); const order = Object.keys(c).map(Number).sort((a, b) => c[b] - c[a] || a - b), n = I.barcodes.length, out = Array(n); T.at({ counts: K(c) }); T.n('Most frequent value?', order[0], 'It goes into the even slots first.'); T.n('How many copies of it?', c[order[0]], 'At most half the length, rounded up.'); T.n('Even slots available?', Math.ceil(n / 2), 'Slots 0, 2, 4 and so on.'); let p = 0; for (const v of order) for (let k = 0; k < c[v]; k++) { if (p >= n) p = 1; out[p] = v; p += 2; } return out; }
  });

  D('campus-bikes', {
    t: 'Campus Bikes: assign the globally closest pairs first',
    r: 'Sort all (distance, worker, bike) triples. Walk them in order and assign whenever both the worker and the bike are free.',
    g: R => { const s = new Set(), pts = []; while (pts.length < 5) { const p = [R.int(0, 4), R.int(0, 4)]; if (!s.has(p.join())) { s.add(p.join()); pts.push(p); } } const n = R.int(1, 2); return { workers: pts.slice(0, n), bikes: pts.slice(n, n + R.int(n, 3)) }; },
    s(I, T) { const tr = []; I.workers.forEach((w, i) => I.bikes.forEach((b, j) => tr.push([Math.abs(w[0] - b[0]) + Math.abs(w[1] - b[1]), i, j]))); tr.sort((a, b) => a[0] - b[0] || a[1] - b[1] || a[2] - b[2]); const res = Array(I.workers.length).fill(-1), used = new Set(); T.at({ workers: A(I.workers.map(p => `(${p})`)), bikes: A(I.bikes.map(p => `(${p})`)) }); T.n('Worker and bike pairs to sort?', tr.length, 'Every worker with every bike.'); for (const [d, i, j] of tr) { if (res[i] >= 0 || used.has(j)) continue; T.at({ workers: A(I.workers.map(p => `(${p})`), { hl: [i] }), bikes: A(I.bikes.map(p => `(${p})`), { dim: [...used] }) }); T.n(`Worker ${i} gets which bike?`, j, `Closest free pair (distance ${d}).`); res[i] = j; used.add(j); } T.n('Bikes left unused?', I.bikes.length - I.workers.length, 'Each worker takes exactly one.'); return res; }
  });

  D('minimize-rounding-error-to-meet-target', {
    t: 'Minimize Rounding Error: ceil the largest fractions',
    r: 'Floor everything; need = target − the sum of floors ceilings are required (must be between 0 and the number of non-integers). Ceil the ones with the largest fractional parts. Error = the sum of fractions of floored + the sum of (1 − fraction) of ceiled.',
    g: R => { const p = Array.from({ length: R.int(1, 4) }, () => R.int(0, 9) * 1000 + R.int(0, 999)); const fl = p.reduce((a, x) => a + Math.floor(x / 1000), 0); return { prices: p.map(x => (x / 1000).toFixed(3)), target: fl + R.int(-1, p.length) }; },
    s(I, T) { const res = (() => { const th = I.prices.map(s => Math.round(parseFloat(s) * 1000)), fl = th.reduce((a, x) => a + Math.floor(x / 1000), 0), fr = th.map(x => x % 1000).filter(f => f > 0).sort((a, b) => b - a), need = I.target - fl; T.at({ prices: A(I.prices), target: I.target }); T.n('How many prices must be rounded up?', need, `The target minus the sum of the floors (${fl}).`); T.n('Prices with a fractional part?', fr.length, 'Only these can be rounded up.'); if (need < 0 || need > fr.length) return '-1'; let err = 0; fr.forEach((f, i) => err += i < need ? 1000 - f : f); return (err / 1000).toFixed(3); })(); T.yn('Can the target be met?', res !== '-1', 'The needed count must fit between 0 and that number.'); return res; }
  });

  D('largest-values-from-labels', {
    t: 'Largest Values From Labels: biggest first, label caps',
    r: 'Sort items by value descending. Take an item if fewer than numWanted are taken and its label is used fewer than useLimit times.',
    g: R => { const n = R.int(2, 6); return { values: R.ints(n, 1, 9), labels: R.ints(n, 1, 3), numWanted: R.int(1, n), useLimit: R.int(1, 2) }; },
    s(I, T) { const it = I.values.map((v, i) => [v, I.labels[i]]).sort((a, b) => b[0] - a[0]), u = {}; let t = 0, c = 0; for (const [v, l] of it) { if (c === I.numWanted) break; const ok = (u[l] || 0) < I.useLimit; T.at({ items: A(it.map(x => `${x[0]}/L${x[1]}`)), used: K(u), taken: c }); T.yn(`Take value ${v} (label ${l})?`, ok, ok ? 'Label still under its limit.' : `Label ${l} already used ${I.useLimit} times.`); if (ok) { t += v; c++; u[l] = (u[l] || 0) + 1; } } return t; }
  });

  D('divide-array-into-increasing-sequences', {
    t: 'Divide Into Increasing Sequences: the most frequent value decides',
    r: 'Equal values must go to different sequences, so there are at least maxFreq sequences, each of length at least k. Possible exactly when maxFreq times k at most n.',
    g: R => ({ nums: sorted(R.ints(R.int(2, 8), 1, 5)), k: R.int(1, 4) }),
    s(I, T) { const res = (() => { const c = {}; I.nums.forEach(x => c[x] = (c[x] || 0) + 1); const m = Math.max(...Object.values(c)); T.at({ nums: A(I.nums), k: I.k }); T.n('Highest frequency of a value?', m, 'That many sequences are needed.'); T.n('Values needed: that frequency times k?', m * I.k, 'Each sequence needs k values.'); return m * I.k <= I.nums.length; })(); T.yn('Can the array be divided?', res, 'Only if there are enough values.'); return res; }
  });

  D('decrease-elements-to-make-array-zigzag', {
    t: 'Decrease Elements to Make Zigzag: lower one parity',
    r: 'Either the even indices are the valleys or the odd ones. For the chosen parity, lower each such element to min(neighbors) − 1 if needed. Take the cheaper option.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 9) }),
    s(I, T) { const res = (() => { const a = I.nums, cost = p => { let c = 0; for (let i = p; i < a.length; i += 2) { const m = Math.min(i ? a[i - 1] : Infinity, i + 1 < a.length ? a[i + 1] : Infinity); if (a[i] >= m) c += a[i] - m + 1; } return c; }; const e = cost(0), o = cost(1); T.at({ nums: A(a) }); T.n('Moves if even indices become valleys?', e, 'Lower each one to 1 below its smaller neighbour.'); T.n('Moves if odd indices become valleys?', o, 'Same for odd positions.'); return Math.min(e, o); })(); T.n('Fewest moves?', res, 'The cheaper of the two.'); return res; }
  });

  D('maximum-number-of-ones', {
    t: 'Maximum Number of Ones: count each pattern cell',
    r: 'Any side times side window sees each offset (i, j) exactly once, so the matrix is determined by which offsets hold ones. Offset (i, j) repeats ((width − i) divided by side, rounded up) times ((height − j) divided by side, rounded up) times; pick the maxOnes largest counts.',
    g: R => { const s = R.int(1, 3); return { width: R.int(s, 5), height: R.int(s, 5), sideLength: s, maxOnes: R.int(0, s * s) }; },
    s(I, T) { const res = (() => { const s = I.sideLength, c = []; for (let i = 0; i < s; i++) for (let j = 0; j < s; j++) c.push(Math.ceil((I.width - i) / s) * Math.ceil((I.height - j) / s)); c.sort((a, b) => b - a); T.at({ width: I.width, height: I.height, side: s, counts: A(c) }); T.n('Offsets inside one square?', s * s, 'Side length squared.'); T.n('Largest repeat count of an offset?', c[0], 'Offset (0, 0) repeats the most.'); return c.slice(0, I.maxOnes).reduce((a, b) => a + b, 0); })(); T.n('Maximum ones?', res, 'Put ones on the offsets that repeat most.'); return res; }
  });

  D('how-many-apples-can-you-put-into-the-basket', {
    t: 'Apples Into the Basket: lightest first',
    r: 'Sort by weight and add apples while the total stays at most 5000.',
    g: R => ({ weight: R.ints(R.int(2, 8), 100, 1000) }),
    s(I, T) { const w = sorted(I.weight); let t = 0, c = 0; for (const x of w) { if (t + x > 5000) break; t += x; c++; T.at({ sorted: A(w, { hl: [c - 1] }) }); T.n('Total weight so far?', t, 'Lightest apples first.'); } return c; }
  });

  D('minimum-cost-to-move-chips-to-the-same-position', {
    t: 'Move Chips: only parity costs',
    r: 'Moves by 2 are free, so all even chips gather for free and all odd chips gather for free. Moving one group by 1 costs its size: answer = min(#odd, #even).',
    g: R => ({ position: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const res = (() => { const o = I.position.filter(x => x % 2).length; T.at({ position: A(I.position) }); T.n('Chips at odd positions?', o, 'Count them.'); T.n('Chips at even positions?', I.position.length - o, 'The rest.'); return Math.min(o, I.position.length - o); })(); T.n('Minimum cost?', res, 'Move the smaller group by one step each.'); return res; }
  });

  D('split-a-string-in-balanced-strings', {
    t: 'Split Into Balanced Strings: cut whenever the balance hits 0',
    r: 'Count R as +1 and L as −1. Every time the running balance returns to 0, cut: that piece is balanced and as short as possible.',
    g: R => { let s = ''; for (let i = 0; i < R.int(1, 4); i++) { const k = R.int(1, 2); const p = 'R'.repeat(k) + 'L'.repeat(k); s += R.chance(0.5) ? p : [...p].reverse().join(''); } return { s }; },
    s(I, T) { let b = 0, c = 0; [...I.s].forEach((ch, i) => { b += ch === 'R' ? 1 : -1; T.at({ s: A([...I.s], { hl: [i] }), pieces: c }); T.n('Balance after this character?', b, 'R = +1, L = −1.'); if (!b) c++; }); return c; }
  });

  D('minimum-swaps-to-make-strings-equal', {
    t: 'Minimum Swaps to Make Strings Equal: pair up mismatches',
    r: 'Count mismatches of type (x, y) and (y, x). Two of the same type fix with 1 swap; one of each needs 2. If the total is odd, it is impossible.',
    g: R => { const n = R.int(1, 6); return { s1: R.str(n, 'xy'), s2: R.str(n, 'xy') }; },
    s(I, T) { const res = (() => { let xy = 0, yx = 0; [...I.s1].forEach((c, i) => { if (c === 'x' && I.s2[i] === 'y') xy++; if (c === 'y' && I.s2[i] === 'x') yx++; }); T.at({ s1: I.s1, s2: I.s2 }); T.n('Positions with x over y?', xy, 'Count them.'); T.n('Positions with y over x?', yx, 'Count them.'); if ((xy + yx) % 2) return -1; return Math.floor(xy / 2) + Math.floor(yx / 2) + 2 * (xy % 2); })(); T.n('Fewest swaps (−1 if impossible)?', res, 'Two of a kind take one swap, one of each takes two.'); return res; }
  });

  D('group-the-people-given-the-group-size-they-belong-to', {
    t: 'Group the People: fill buckets by size',
    r: 'Put each person into the open bucket for their group size; when a bucket reaches that size, it becomes a finished group.',
    g: R => { const out = []; let id = 0; const sizes = []; for (let i = 0; i < R.int(1, 4); i++) { const s = R.int(1, 3); for (let j = 0; j < s; j++) sizes.push(s); } return { groupSizes: R.shuffle(sizes) }; },
    cmp: (out, exp, I) => { const seen = new Set(); for (const g of out) for (const p of g) { if (seen.has(p) || I.groupSizes[p] !== g.length) return false; seen.add(p); } return seen.size === I.groupSizes.length; },
    s(I, T) { const open = {}, out = []; I.groupSizes.forEach((s, p) => { (open[s] = open[s] || []).push(p); T.at({ sizes: A(I.groupSizes, { hl: [p] }), open: K(Object.entries(open).map(([k, v]) => [k, `[${v}]`])) }); T.yn(`Does adding person ${p} complete a group of ${s}?`, open[s].length === s, 'Close the bucket when it is full.'); if (open[s].length === s) { out.push(open[s]); open[s] = []; } }); return out; }
  });

  D('divide-array-in-sets-of-k-consecutive-numbers', { t: 'Sets of K Consecutive Numbers: start at the smallest', r: 'Count values. The smallest remaining value must start a run x, x+1, …, x+k−1; remove that many copies of each. Any shortage means false.', g: R => { const k = R.int(1, 3), a = []; for (let i = 0; i < R.int(1, 3); i++) { const s = R.int(1, 6); for (let j = 0; j < k; j++) a.push(s + j); } if (R.chance(0.3)) a.push(R.int(1, 9)); return { nums: R.shuffle(a), k }; }, s: (I, T) => consecutiveGroups(I.nums, I.k, T) });

  D('maximum-69-number', {
    t: 'Maximum 69 Number: flip the first 6',
    r: 'Changing the leftmost 6 to a 9 adds the most. If there is no 6, keep the number.',
    g: R => ({ num: +R.str(R.int(1, 4), '69') }),
    s(I, T) { const res = (() => { const s = String(I.num), i = s.indexOf('6'); T.at({ num: I.num }); T.n('How many 6 digits?', [...s].filter(c => c === '6').length, 'Only one may be changed.'); T.n('Index of the digit to flip (−1 if none)?', i, 'The leftmost 6.'); return i < 0 ? I.num : +(s.slice(0, i) + '9' + s.slice(i + 1)); })(); T.n('Largest number?', res, 'Flip the leftmost 6.'); return res; }
  });

  D('break-a-palindrome', {
    t: 'Break a Palindrome: first non-a in the first half',
    r: 'Length 1 cannot be broken (""). Otherwise change the first non-\'a\' in the first half to \'a\'; if the first half is all \'a\', change the last character to \'b\'.',
    g: R => { const h = R.str(R.int(0, 3), 'aab'); const m = R.chance(0.5) ? R.pick(['a', 'b', 'c']) : ''; const s = h + m + [...h].reverse().join(''); return { palindrome: s || 'a' }; },
    s(I, T) { const res = (() => { const p = I.palindrome, n = p.length; T.at({ palindrome: A([...p]) }); T.yn('Is the palindrome only one letter long?', n === 1, 'Then it cannot be broken.'); if (n === 1) return ''; let i = 0; while (i < Math.floor(n / 2) && p[i] === 'a') i++; T.at({ palindrome: A([...p]) }); T.n('Index of the first non-a in the first half (half length if none)?', i, 'Only the first half is safe to change to a.'); return i < Math.floor(n / 2) ? p.slice(0, i) + 'a' + p.slice(i + 1) : p.slice(0, -1) + 'b'; })(); T.n('Index that changed (−1 if impossible)?', res === '' ? -1 : [...res].findIndex((c, k) => c !== I.palindrome[k]), 'The first non-a, or the last letter.'); return res; }
  });

  D('reverse-subarray-to-maximize-array-value', {
    t: 'Reverse Subarray to Maximize Value: two kinds of gain',
    r: 'Base = the sum of |a[i] − a[i+1]|. Reversing a prefix or suffix changes one edge: try every edge. Reversing a middle part gains 2 times (max of min(pair) − min of max(pair)) over adjacent pairs.',
    g: R => ({ nums: R.ints(R.int(2, 6), -5, 9) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length; let base = 0, g1 = 0, mx = -Infinity, mn = Infinity; for (let i = 0; i + 1 < n; i++) { const d = Math.abs(a[i] - a[i + 1]); base += d; g1 = Math.max(g1, Math.abs(a[0] - a[i + 1]) - d, Math.abs(a[n - 1] - a[i]) - d); mx = Math.max(mx, Math.min(a[i], a[i + 1])); mn = Math.min(mn, Math.max(a[i], a[i + 1])); } const g2 = 2 * (mx - mn); T.at({ nums: A(a) }); T.n('Base value?', base, 'Add the gaps between neighbours.'); T.n('Best gain from reversing a prefix or suffix?', g1, 'Swap one end into a different edge.'); return base + Math.max(g1, g2, 0); })(); T.n('Largest value after one reversal?', res, 'Base plus the best gain.'); return res; }
  });

  D('reduce-array-size-to-the-half', {
    t: 'Reduce Array Size to the Half: remove the most frequent first',
    r: 'Sort the frequencies descending and remove values until at least half of the elements are gone.',
    g: R => ({ arr: R.ints(2 * R.int(1, 5), 1, 5) }),
    s(I, T) { const res = (() => { const c = {}; I.arr.forEach(x => c[x] = (c[x] || 0) + 1); const f = Object.values(c).sort((a, b) => b - a); let rem = 0, k = 0; while (rem * 2 < I.arr.length) { rem += f[k++]; T.at({ freqs: A(f, { hl: [k - 1] }) }); T.n(`Elements removed after taking ${k} values?`, rem, 'Largest frequencies first.'); } return k; })(); T.n('Smallest set size?', res, 'How many values were taken.'); return res; }
  });

  D('largest-multiple-of-three', {
    t: 'Largest Multiple of Three: drop the fewest smallest digits',
    r: 'Sort digits descending. If the digit sum mod 3 = r not equal to 0, remove one smallest digit with that remainder, or else two smallest with remainder 3 − r. Leading zeros collapse to "0".',
    g: R => ({ digits: R.ints(R.int(1, 6), 0, 9) }),
    s(I, T) { const res = (() => { const d = I.digits.slice().sort((a, b) => b - a), s = d.reduce((a, b) => a + b, 0), r = s % 3; T.at({ digits: A(d) }); T.n('Digit sum?', s, 'Add all digits.'); T.n('Remainder of the digit sum divided by 3?', r, 'Remove the fewest small digits to fix it.'); const rm = (m, k) => { for (let c = 0; c < k; c++) { let i = -1; for (let j = d.length - 1; j >= 0; j--) if (d[j] % 3 === m) { i = j; break; } if (i < 0) return false; d.splice(i, 1); } return true; }; if (r) { const save = d.slice(); if (!rm(r, 1)) { d.splice(0, d.length, ...save); if (!rm(3 - r, 2)) return ''; } } if (!d.length) return ''; return d[0] === 0 ? '0' : d.join(''); })(); T.n('Digits in the answer?', res.length, 'Zero when nothing works.'); return res; }
  });

  D('cinema-seat-allocation', {
    t: 'Cinema Seat Allocation: three possible blocks per row',
    r: 'A family needs seats 2 to 5, 4 to 7 or 6 to 9. A row with no reservations fits 2. For reserved rows: 2 if both 2 to 5 and 6 to 9 are free, else 1 if any of the three blocks is free, else 0.',
    g: R => { const n = R.int(1, 4); return { n, reservedSeats: Array.from({ length: R.int(1, 5) }, () => [R.int(1, n), R.int(1, 10)]) }; },
    s(I, T) { const rows = {}; I.reservedSeats.forEach(([r, s]) => (rows[r] = rows[r] || new Set()).add(s)); let t = 2 * (I.n - Object.keys(rows).length); for (const [r, set] of Object.entries(rows)) { const free = (a, b) => { for (let s = a; s <= b; s++) if (set.has(s)) return false; return true; }; const v = free(2, 5) && free(6, 9) ? 2 : free(2, 5) || free(4, 7) || free(6, 9) ? 1 : 0; T.at({ row: r, reserved: A([...set].sort((a, b) => a - b)) }); T.n(`Families that fit in row ${r}?`, v, 'Check blocks 2 to 5, 4 to 7, 6 to 9.'); t += v; } return t; }
  });

  D('construct-k-palindrome-strings', {
    t: 'Construct K Palindromes: odd counts bound it',
    r: 'Each palindrome holds at most one odd-count letter in its middle. Possible exactly when (#letters with odd count) at most k at most length.',
    g: R => { const s = R.str(R.int(1, 8), 'aabbc'); return { s, k: R.int(1, s.length + 1) }; },
    s(I, T) { const res = (() => { const c = {}; for (const x of I.s) c[x] = (c[x] || 0) + 1; const odd = Object.values(c).filter(v => v % 2).length; T.at({ counts: K(c), k: I.k }); T.n('Letters with an odd count?', odd, 'Each needs its own palindrome middle.'); T.yn('Is k at most the length of s?', I.k <= I.s.length, 'Each palindrome needs a letter.'); return odd <= I.k && I.k <= I.s.length; })(); T.yn('Can s make k palindromes?', res, 'Both checks must pass.'); return res; }
  });

  D('reducing-dishes', {
    t: 'Reducing Dishes: add dishes while the suffix sum is positive',
    r: 'Sort descending. Adding the next dish shifts every chosen dish one slot later, adding (running sum + dish). Keep adding while that running sum stays positive.',
    g: R => ({ satisfaction: R.ints(R.int(1, 6), -9, 6) }),
    s(I, T) { const a = sorted(I.satisfaction).reverse(); let run = 0, tot = 0; for (const x of a) { if (run + x <= 0) { T.at({ sorted: A(a), running: run }); T.yn(`Add dish ${x}?`, false, `Running sum would become ${run + x} at most 0.`); break; } run += x; tot += run; T.at({ sorted: A(a), running: run, total: tot }); T.n(`Total after adding dish ${x}?`, tot, 'Previous total + new running sum.'); } return tot; }
  });

  D('minimum-subsequence-in-non-increasing-order', {
    t: 'Minimum Subsequence in Non-Increasing Order: take the largest',
    r: 'Sort descending and take elements until the taken sum exceeds the rest.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12) }),
    s(I, T) { const a = sorted(I.nums).reverse(), tot = a.reduce((x, y) => x + y, 0), out = []; let s = 0; T.at({ sorted: A(a) }); T.n('Total sum?', tot, 'The taken part must beat the rest.'); for (const x of a) { s += x; out.push(x); T.at({ taken: A(out), rest: tot - s }); T.n('Taken sum?', s, 'Stop once it beats the rest.'); if (s > tot - s) break; } return out; }
  });

  D('find-the-minimum-number-of-fibonacci-numbers-whose-sum-is-k', {
    t: 'Minimum Fibonacci Numbers Summing to k: largest first',
    r: 'Repeatedly subtract the largest Fibonacci number at most k. (Zeckendorf: this is optimal.)',
    g: R => ({ k: R.int(1, 200) }),
    s(I, T) { const f = [1, 1]; while (f[f.length - 1] < I.k) f.push(f[f.length - 1] + f[f.length - 2]); let k = I.k, c = 0; while (k) { let x = 0; for (const v of f) if (v <= k) x = v; T.at({ k }); T.n(`Largest Fibonacci number at most ${k}?`, x, 'Take it.'); k -= x; c++; } return c; }
  });

  D('max-difference-you-can-get-from-changing-an-integer', {
    t: 'Max Difference From Changing an Integer: make it big, make it small',
    r: 'Max: replace the first non-9 digit (everywhere) with 9. Min: if the first digit is not 1, replace it with 1; otherwise replace the first later digit that is not 0 or 1 with 0.',
    g: R => ({ num: R.int(1, 99999) }),
    s(I, T) { const res = (() => { const s = String(I.num), rep = (x, y) => s.split(x).join(y); const a = [...s].find(c => c !== '9'), hi = a ? +rep(a, '9') : I.num; let lo; if (s[0] !== '1') lo = +rep(s[0], '1'); else { const b = [...s.slice(1)].find(c => c !== '0' && c !== '1'); lo = b ? +rep(b, '0') : I.num; } T.at({ num: I.num }); T.n('Largest value?', hi, 'Turn the first digit that is not 9 into 9.'); T.n('Smallest value?', lo, 'Turn the first digit into 1, or a later digit into 0.'); return hi - lo; })(); T.n('Max difference?', res, 'Largest minus smallest.'); return res; }
  });

  D('check-if-a-string-can-break-another-string', {
    t: 'Can One String Break Another: compare sorted strings',
    r: 'Sort both. One breaks the other exactly when one sorted string is at least the other at every position.',
    g: R => { const n = R.int(1, 5); return { s1: R.str(n, 'abcxyz'), s2: R.str(n, 'abcxyz') }; },
    s(I, T) { const res = (() => { const a = [...I.s1].sort(), b = [...I.s2].sort(); const ge = a.every((c, i) => c >= b[i]), le = a.every((c, i) => c <= b[i]); T.at({ s1: a.join(''), s2: b.join('') }); T.yn('Does sorted s1 dominate sorted s2 at every position?', ge, 'Compare position by position.'); T.yn('Does sorted s2 dominate sorted s1?', le, 'And the other way.'); return ge || le; })(); T.yn('Can one string break the other?', res, 'Either direction is enough.'); return res; }
  });

  D('maximum-area-of-a-piece-of-cake-after-horizontal-and-vertical-cuts', {
    t: 'Maximum Cake Piece: widest gap in each direction',
    r: 'Sort each cut list and add the edges. The biggest piece is (largest horizontal gap) times (largest vertical gap), mod 10 to the power 9 + 7.',
    g: R => { const h = R.int(2, 10), w = R.int(2, 10); return { h, w, horizontalCuts: R.distinct(R.int(1, Math.min(3, h - 1)), 1, h - 1), verticalCuts: R.distinct(R.int(1, Math.min(3, w - 1)), 1, w - 1) }; },
    s(I, T) { const res = (() => { const gap = (L, c) => { const s = [0, ...sorted(c), L]; return Math.max(...s.slice(1).map((v, i) => v - s[i])); }; const a = gap(I.h, I.horizontalCuts), b = gap(I.w, I.verticalCuts); T.at({ h: I.h, cuts: A(sorted(I.horizontalCuts)) }); T.n('Largest horizontal gap?', a, 'Including the edges.'); T.at({ w: I.w, cuts: A(sorted(I.verticalCuts)) }); T.n('Largest vertical gap?', b, 'Including the edges.'); return a * b % (1e9 + 7); })(); T.n('Largest piece area, mod 1000000007?', res, 'The two largest gaps multiplied.'); return res; }
  });

  D('least-number-of-unique-integers-after-k-removals', {
    t: 'Least Unique Integers After k Removals: drop the rarest',
    r: 'Sort frequencies ascending and remove whole values while k covers them; the rest remain.',
    g: R => { const a = R.ints(R.int(1, 8), 1, 5); return { arr: a, k: R.int(0, a.length) }; },
    s(I, T) { const c = {}; I.arr.forEach(x => c[x] = (c[x] || 0) + 1); const f = Object.values(c).sort((a, b) => a - b); let k = I.k, left = f.length; for (const v of f) { if (v > k) break; k -= v; left--; T.at({ freqs: A(f), k }); T.n('Unique values left?', left, `Removed a value with ${v} copies.`); } return left; }
  });

  D('minimum-possible-integer-after-at-most-k-adjacent-swaps-on-digits', {
    t: 'Minimum Integer After k Adjacent Swaps: pull the smallest reachable digit',
    r: 'For each position, find the smallest digit within the next k positions (first occurrence) and bubble it forward, spending its distance from k. A Fenwick tree tracks shifted positions in O(n log n).',
    g: R => ({ num: R.str(R.int(2, 6), '0123456789').replace(/^0+(?=.)/, '9'), k: R.int(1, 6) }),
    s(I, T) { const d = [...I.num]; let k = I.k; for (let i = 0; i < d.length && k > 0; i++) { let j = i; for (let t = i + 1; t < d.length && t - i <= k; t++) if (d[t] < d[j]) j = t; T.at({ num: A(d, { hl: [i], win: [i, Math.min(d.length - 1, i + k)] }), k }); T.n(`Digit placed at position ${i}?`, +d[j], 'Smallest digit within reach (first copy).'); const c = d.splice(j, 1)[0]; d.splice(i, 0, c); k -= j - i; } return d.join(''); }
  });

  D('minimum-difference-between-largest-and-smallest-value-in-three-moves', {
    t: 'Min Difference After Three Moves: drop 3 from the ends',
    r: 'With n at most 4 the answer is 0. Otherwise sort and try removing i from the bottom and 3 − i from the top: min over a[n−4+i] − a[i].',
    g: R => ({ nums: R.ints(R.int(1, 8), -5, 20) }),
    s(I, T) { const a = sorted(I.nums), n = a.length; if (n <= 4) return 0; let best = Infinity; for (let i = 0; i <= 3; i++) { const v = a[n - 4 + i] - a[i]; T.at({ sorted: A(a, { win: [i, n - 4 + i] }) }); T.n(`Range after removing ${i} small and ${3 - i} large?`, v, `a[${n - 4 + i}] − a[${i}].`); best = Math.min(best, v); } return best; }
  });

  D('minimum-number-of-increments-on-subarrays-to-form-a-target-array', {
    t: 'Increments on Subarrays: count the rises',
    r: 'An operation that covers target[i] can extend from i − 1, so only rises cost: answer = target[0] + the sum of max(0, target[i] − target[i − 1]).',
    g: R => ({ target: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { let t = 0; I.target.forEach((x, i) => { const add = Math.max(0, x - (i ? I.target[i - 1] : 0)); T.at({ target: A(I.target, { hl: [i] }), ops: t }); T.n(`New operations starting at index ${i}?`, add, 'Only a rise needs new operations.'); t += add; }); return t; }
  });
})();
