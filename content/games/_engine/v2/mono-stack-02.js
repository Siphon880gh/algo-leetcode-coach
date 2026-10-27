/* v2 games: monotonic stacks (02). */
(function () {
  'use strict';
  const { D, A, G, S } = LCGame.H;
  const MOD = 1000000007n;
  const span = (a, i, strictL, strictR, cmp) => { let l = i, r = i; while (l > 0 && (strictL ? cmp(a[l - 1], a[i]) : cmp(a[l - 1], a[i]) || a[l - 1] === a[i])) l--; while (r + 1 < a.length && (strictR ? cmp(a[r + 1], a[i]) : cmp(a[r + 1], a[i]) || a[r + 1] === a[i])) r++; return [l, r]; };
  const mountain = (I, T, key) => { const m = I[key], n = m.length; let best = 0; for (let p = 0; p < n; p++) { const h = Array(n); h[p] = m[p]; for (let i = p - 1; i >= 0; i--) h[i] = Math.min(m[i], h[i + 1]); for (let i = p + 1; i < n; i++) h[i] = Math.min(m[i], h[i - 1]); const s = h.reduce((x, y) => x + y, 0); best = Math.max(best, s); if (p < 5) { T.at({ maxHeights: A(m, { i: p }), towers: A(h) }); T.n('Total height with the peak here?', s, 'Clamp outward by running minimum.'); } } return best; };

  D('smallest-k-length-subsequence-with-occurrences-of-a-letter', {
    t: 'Smallest K-Length Subsequence With Occurrences of a Letter',
    r: 'Greedy stack: pop a larger top if enough characters remain to reach length k and, when the top is the special letter, enough of that letter remains to still meet the repetition. Push respecting the letter quota.',
    g: R => { const s = R.str(R.int(2, 8), 'abc'), letter = R.pick([...s]), cnt = [...s].filter(c => c === letter).length, rep = R.int(1, cnt); return { s, k: R.int(rep, s.length), letter, repetition: rep }; },
    s(I, T) { const { s, k, letter, repetition } = I, n = s.length; let best = null, shown = 0; const go = (i, cur) => { if (cur.length === k) { if ([...cur].filter(c => c === letter).length >= repetition && (best === null || cur < best)) best = cur; return; } if (n - i < k - cur.length) return; go(i + 1, cur + s[i]); go(i + 1, cur); }; go(0, ''); for (let i = 0; i < k && shown < 4; i++, shown++) { T.at({ s: A([...s]), built: best.slice(0, i) }); T.c(`Character ${i + 1} of the answer?`, [...new Set([...s, best[i]])].sort(), best[i], 'Smallest that still leaves a feasible finish.'); } return best; }
  });

  D('sum-of-subarray-ranges', {
    t: 'Sum of Subarray Ranges',
    r: 'the sum of max − the sum of min over all subarrays. Each element contributes value times (#subarrays where it is the max) — computed from previous or next greater via monotonic stacks — and likewise for min.',
    g: R => ({ nums: R.ints(R.int(1, 7), -3, 6) }),
    s(I, T) { const a = I.nums; let tot = 0; a.forEach((x, i) => { const [l1, r1] = span(a, i, false, true, (p, q) => p < q), [l2, r2] = span(a, i, false, true, (p, q) => p > q), cmax = (i - l1 + 1) * (r1 - i + 1), cmin = (i - l2 + 1) * (r2 - i + 1); tot += x * (cmax - cmin); if (i < 5) { T.at({ nums: A(a, { i }) }); T.n('Subarrays where this element is the (leftmost-tied) maximum?', cmax, 'Left span times right span.'); } }); return tot; }
  });

  D('sum-of-total-strength-of-wizards', {
    t: 'Sum of Total Strength of Wizards',
    r: 'For each wizard as the minimum (monotonic stacks for spans), sum the subarray sums over that span using prefix-of-prefix sums. Multiply by the min and add, mod 1e9+7.',
    g: R => ({ strength: R.ints(R.int(1, 6), 1, 6) }),
    s(I, T) { const a = I.strength; let tot = 0n; a.forEach((x, i) => { const [l, r] = span(a, i, false, true, (p, q) => p > q); let s = 0; for (let L = l; L <= i; L++) for (let Rr = i; Rr <= r; Rr++) for (let k = L; k <= Rr; k++) s += a[k]; tot += BigInt(x) * BigInt(s); if (i < 5) { T.at({ strength: A(a, { i, l, r }) }); T.n('Subarrays where this wizard is the (leftmost) minimum?', (i - l + 1) * (r - i + 1), 'Left span times right span.'); } }); return Number(tot % MOD); }
  });

  D('number-of-people-that-can-be-seen-in-a-grid', {
    t: 'Number of People That Can Be Seen in a Grid',
    r: 'Run the "visible people in a queue" monotonic stack along each row (looking right) and each column (looking down), handling equal heights by popping them too but not counting past them.',
    g: R => ({ heights: R.grid(R.int(1, 3), R.int(1, 4), 1, 4) }),
    s(I, T) { const H = I.heights, m = H.length, n = H[0].length, see = (seq, h) => { let c = 0, mx = 0; for (const x of seq) { if (mx < Math.min(h, x)) c++; mx = Math.max(mx, x); if (mx >= h) break; } return c; }; let k = 0; return H.map((row, r) => row.map((h, c) => { const v = see(row.slice(c + 1), h) + see(H.slice(r + 1).map(rr => rr[c]), h); if (k++ < 5) { T.at({ heights: G(H, { r, c }) }); T.n('People this person sees (right + down)?', v, 'Everyone between must be shorter than both.'); } return v; })); }
  });

  D('finding-the-number-of-visible-mountains', {
    t: 'Finding the Number of Visible Mountains',
    r: 'Mountain = interval [x − y, x + y]. Sort by left asc, right desc; a mountain is hidden if its right end does not exceed the max right so far. Exact duplicates hide each other.',
    g: R => ({ peaks: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 6), R.int(1, 4)]) }),
    s(I, T) { const P = I.peaks; let c = 0; P.forEach(([x, y], i) => { const hid = P.some(([a, b], j) => j !== i && a - b <= x - y && x + y <= a + b); if (!hid) c++; if (i < 5) { T.at({ mountain: `[${x - y}, ${x + y}]`, all: A(P.map(([a, b]) => `[${a - b},${a + b}]`)) }); T.yn('Visible?', !hid, 'Hidden if another interval contains it.'); } }); return c; }
  });

  D('apply-operations-to-maximize-score', {
    t: 'Apply Operations to Maximize Score',
    r: 'Prime score = number of distinct prime factors. With monotonic stacks, each element is the chosen one in (left span) times (right span) subarrays (ties go left). Take elements largest-first, using up to that many operations, with fast modular powers.',
    g: R => ({ nums: R.ints(R.int(1, 6), 2, 30), k: R.int(1, 8) }),
    s(I, T) { const res = (() => { const a = I.nums, ps = x => { let c = 0; for (let p = 2; p * p <= x; p++) if (x % p === 0) { c++; while (x % p === 0) x /= p; } return c + (x > 1 ? 1 : 0); }, s = a.map(ps), cnt = a.map((_, i) => { let l = i, r = i; while (l > 0 && s[l - 1] < s[i]) l--; while (r + 1 < a.length && s[r + 1] <= s[i]) r++; return (i - l + 1) * (r - i + 1); }); T.at({ nums: A(a), primeScore: A(s) }); T.n(`Subarrays where ${a[0]} (index 0) is chosen?`, cnt[0], 'Left span: strictly smaller prime scores. Right span: smaller or equal.'); const ord = a.map((_, i) => i).sort((x, y) => a[y] - a[x]); T.at({ nums: A(a, { i: ord[0] }), counts: A(cnt), k: I.k }); T.n(`Operations spent on the largest number, ${a[ord[0]]}?`, Math.min(I.k, cnt[ord[0]]), 'Up to its subarray count, capped by k.'); let k = I.k, sc = 1n; for (const i of ord) { if (!k) break; let t = Math.min(k, cnt[i]); k -= t; let b = BigInt(a[i]), e = BigInt(t); while (e) { if (e & 1n) sc = sc * b % MOD; b = b * b % MOD; e >>= 1n; } } return Number(sc); })(); T.n('Final score (remainder by 1e9+7)?', res, 'Multiply in each chosen number.'); return res; }
  });

  D('maximal-range-that-each-element-is-maximum-in-it', {
    t: 'Maximal Range That Each Element Is Maximum in It',
    r: 'Previous and next greater element via monotonic stacks; the range for i is next − prev − 1.',
    g: R => ({ nums: R.distinct(R.int(1, 7), 1, 12) }),
    s(I, T) { const a = I.nums; return a.map((x, i) => { const [l, r] = span(a, i, true, true, (p, q) => p < q), w = r - l + 1; if (i < 5) { T.at({ nums: A(a, { i, l, r }) }); T.n('Range length where it is the max?', w, 'Between previous and next greater.'); } return w; }); }
  });

  D('maximum-length-of-semi-decreasing-subarrays', {
    t: 'Maximum Length of Semi-Decreasing Subarrays',
    r: 'Need first > last. Keep a stack of strictly increasing prefix maxima as candidate left ends; scan j from the right and pop every left end bigger than nums[j], measuring j − i + 1.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const a = I.nums; let best = 0; a.forEach((x, i) => { let b = 0; for (let j = a.length - 1; j > i; j--) if (a[j] < x) { b = j - i + 1; break; } best = Math.max(best, b); if (i < 5) { T.at({ nums: A(a, { i }) }); T.n('Longest semi-decreasing subarray starting here (0 if none)?', b, 'Farthest later element smaller than it.'); } }); return best; }
  });

  D('beautiful-towers-i', {
    t: 'Beautiful Towers I',
    r: 'Try every peak; heights fall off as running minimums of the limits on both sides. (Part II computes those sums for all peaks with monotonic stacks.)',
    g: R => ({ heights: R.ints(R.int(1, 6), 1, 9) }),
    s: (I, T) => mountain(I, T, 'heights')
  });

  D('beautiful-towers-ii', {
    t: 'Beautiful Towers II',
    r: 'left[i] = best non-decreasing sum ending at i with height maxHeights[i]: pop larger limits from a stack and fill that stretch at maxHeights[i]. Same from the right; maximize left[i] + right[i] − maxHeights[i].',
    g: R => ({ maxHeights: R.ints(R.int(1, 6), 1, 9) }),
    s: (I, T) => mountain(I, T, 'maxHeights')
  });

  D('find-the-number-of-subarrays-where-boundary-elements-are-maximum', {
    t: 'Find the Number of Subarrays Where Boundary Elements Are Maximum',
    r: 'Decreasing stack of [value, count]: pop smaller values; if the top equals x, increment its count, else push [x, 1]. Add the count each time (x pairs with every equal value still visible, itself included).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 4) }),
    s(I, T) { const st = []; let c = 0; I.nums.forEach((x, i) => { while (st.length && st[st.length - 1][0] < x) st.pop(); if (st.length && st[st.length - 1][0] === x) st[st.length - 1][1]++; else st.push([x, 1]); const add = st[st.length - 1][1]; c += add; if (i < 6) { T.at({ nums: A(I.nums, { i }), stack: S(st.map(p => `${p[0]}, count ${p[1]}`)) }); T.n('Valid subarrays ending here?', add, 'Equal values not blocked by anything larger.'); } }); return c; }
  });

  D('maximum-array-hopping-score-ii', {
    t: 'Maximum Array Hopping Score II',
    r: 'From any index, it is best to hop to the largest value ahead. So each step scores (j − i) times suffix max: equivalently the sum over positions i at least 1 of the maximum of nums[i..]. A decreasing stack yields those maxima.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length, dp = Array(n).fill(-Infinity); dp[0] = 0; for (let j = 1; j < n; j++) for (let i = 0; i < j; i++) dp[j] = Math.max(dp[j], dp[i] + (j - i) * a[j]); for (let i = 1; i < Math.min(n, 6); i++) { T.at({ nums: A(a, { i }) }); T.n('Suffix max that this position pays at?', Math.max(...a.slice(i)), 'Every unit of distance is paid at the next hop target.'); } return dp[n - 1]; }
  });

  D('find-sorted-submatrices-with-maximum-element-at-most-k', {
    t: 'Find Sorted Submatrices With Maximum Element at Most K',
    r: 'For each cell, compute how far right the row stays at most k and non-increasing. Then for each column, count submatrices whose top-left is there using a monotonic stack over those widths going down rows (histogram counting).',
    g: R => ({ grid: R.grid(R.int(1, 3), R.int(1, 4), 1, 5), k: R.int(1, 5) }),
    s(I, T) { const res = (() => { const g = I.grid, m = g.length, n = g[0].length, w = g.map(row => row.map((_, c) => { let e = c; if (row[c] > I.k) return 0; while (e + 1 < n && row[e + 1] <= row[e]) e++; return e - c + 1; })); let tot = 0; for (let c = 0; c < n; c++) for (let r = 0; r < m; r++) { let mn = Infinity; for (let r2 = r; r2 < m; r2++) { mn = Math.min(mn, w[r2][c]); tot += mn; } } T.at({ grid: G(g), widths: G(w) }); T.n('Cells with a value above k?', g.flat().filter(x => x > I.k).length, 'Their width is 0.'); T.n('Valid width starting at the top-left cell?', w[0][0], 'Run of non-increasing values at most k.'); return tot; })(); T.n('Total valid submatrices?', res, 'Histogram counting down each column.'); return res; }
  });

  D('maximum-and-minimum-sums-of-at-most-size-k-subarrays', {
    t: 'Maximum and Minimum Sums of at Most Size K Subarrays',
    r: 'For each element, monotonic stacks give its span as max (and as min). Count subarrays inside the span that contain it and have length at most k (a closed-form count), and add value times count.',
    g: R => ({ nums: R.ints(R.int(1, 7), -3, 6), k: R.int(1, 4) }),
    s(I, T) { const a = I.nums; let tot = 0; for (let i = 0; i < a.length; i++) { let s = 0; for (let j = i; j < a.length && j - i < I.k; j++) { const w = a.slice(i, j + 1); s += Math.max(...w) + Math.min(...w); } tot += s; if (i < 5) { T.at({ nums: A(a, { i }) }); T.n('Sum of (max + min) over short subarrays starting here?', s, `Lengths 1..${I.k}.`); } } return tot; }
  });
})();
