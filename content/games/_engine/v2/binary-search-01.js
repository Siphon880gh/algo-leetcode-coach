/* v2 games: binary search (01). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const sorted = (R, n, lo, hi) => R.ints(n, lo, hi).sort((a, b) => a - b);
  // Binary search on an integer answer in [lo, hi] for the first value where ok() holds; asks about the first few probes.
  const firstTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search left (hi = mid).' : 'Not feasible: search right (lo = mid + 1).'); asks++; } if (v) hi = mid; else lo = mid + 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };
  const lastTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi + 1) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search right (lo = mid).' : 'Not feasible: search left (hi = mid − 1).'); asks++; } if (v) lo = mid; else hi = mid - 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };
  const gcd = (a, b) => b ? gcd(b, a % b) : a;

  D('median-of-two-sorted-arrays', {
    t: 'Median of Two Sorted Arrays: partition search',
    r: 'Binary search a cut i in the shorter array (j = half − i in the other) until left maxes ≤ right mins. The median comes from the values around the cut.',
    cmp: 'float',
    g: R => { const a = sorted(R, R.int(0, 4), -5, 9); return { nums1: a, nums2: sorted(R, R.int(a.length ? 0 : 1, 4), -5, 9) }; },
    s(I, T) { const res = (() => { let [a, b] = I.nums1.length <= I.nums2.length ? [I.nums1, I.nums2] : [I.nums2, I.nums1]; const m = a.length, n = b.length, half = Math.floor((m + n + 1) / 2); let lo = 0, hi = m; T.at({ short: A(a), long: A(b) }); T.n('Size of the left half?', half, 'Total plus 1, halved, rounded down.'); for (;;) { const i = Math.floor((lo + hi) / 2), j = half - i; const L1 = i ? a[i - 1] : -Infinity, R1 = i < m ? a[i] : Infinity, L2 = j ? b[j - 1] : -Infinity, R2 = j < n ? b[j] : Infinity; T.at({ short: A(a, { hl: [i - 1, i] }), long: A(b, { hl: [j - 1, j] }), cut: i }); const dir = L1 > R2 ? 'left' : L2 > R1 ? 'right' : 'done'; T.c('Move the cut?', ['left', 'right', 'done'], dir, 'Every left value must be at most every right value.'); if (dir === 'left') hi = i - 1; else if (dir === 'right') lo = i + 1; else { const ml = Math.max(L1, L2); return (m + n) % 2 ? ml : (ml + Math.min(R1, R2)) / 2; } } })(); T.yn('Is the total length odd?', (I.nums1.length + I.nums2.length) % 2 === 1, 'Then the median is the left max alone.'); return res; }
  });

  D('search-in-rotated-sorted-array-ii', {
    t: 'Search Rotated Sorted Array II: duplicates',
    r: 'If nums[lo] = nums[mid] = nums[hi], shrink both ends. Otherwise one half is sorted; keep the half that can contain the target.',
    g: R => { const a = sorted(R, R.int(1, 8), 0, 5), k = R.int(0, a.length - 1); return { nums: [...a.slice(k), ...a.slice(0, k)], target: R.int(0, 6) }; },
    s(I, T) { const a = I.nums; let lo = 0, hi = a.length - 1; while (lo <= hi) { const mid = (lo + hi) >> 1; T.at({ nums: A(a, { win: [lo, hi], hl: [mid] }), target: I.target }); if (a[mid] === I.target) { T.yn(`Is nums[${mid}] the target?`, true, 'Found.'); return true; } if (a[lo] === a[mid] && a[mid] === a[hi]) { T.c('What now?', ['shrink both ends', 'go left', 'go right'], 'shrink both ends', 'Duplicates hide which half is sorted.'); lo++; hi--; continue; } const leftSorted = a[lo] <= a[mid], goLeft = leftSorted ? a[lo] <= I.target && I.target < a[mid] : !(a[mid] < I.target && I.target <= a[hi]); T.c('Which half can hold the target?', ['shrink both ends', 'go left', 'go right'], goLeft ? 'go left' : 'go right', leftSorted ? 'Left half is sorted.' : 'Right half is sorted.'); if (goLeft) hi = mid - 1; else lo = mid + 1; } return false; }
  });

  D('find-minimum-in-rotated-sorted-array-ii', {
    t: 'Minimum in Rotated Sorted Array II',
    r: 'Compare nums[mid] with nums[hi]: smaller → min is at mid or left (hi = mid); larger → right of mid (lo = mid + 1); equal → hi−− safely.',
    g: R => { const a = sorted(R, R.int(1, 8), 0, 4), k = R.int(0, a.length - 1); return { nums: [...a.slice(k), ...a.slice(0, k)] }; },
    s(I, T) { const a = I.nums; let lo = 0, hi = a.length - 1; if (lo === hi) { T.at({ nums: A(a) }); T.n('Minimum of a single element?', a[0], 'Only one value.'); } while (lo < hi) { const mid = (lo + hi) >> 1, op = a[mid] < a[hi] ? 'hi = mid' : a[mid] > a[hi] ? 'lo = mid + 1' : 'hi − 1'; T.at({ nums: A(a, { win: [lo, hi], hl: [mid] }) }); T.c(`nums[mid] = ${a[mid]} vs nums[hi] = ${a[hi]}: which move?`, ['hi = mid', 'lo = mid + 1', 'hi − 1'], op, 'Equal values only let us drop hi.'); if (op === 'hi = mid') hi = mid; else if (op === 'lo = mid + 1') lo = mid + 1; else hi--; } return a[lo]; }
  });

  D('search-a-2d-matrix-ii', {
    t: 'Search a 2D Matrix II: staircase from the top-right',
    r: 'Start at the top-right. If the value is too big, move left; if too small, move down.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), g = []; for (let i = 0; i < m; i++) { g.push([]); for (let j = 0; j < n; j++) g[i].push(Math.max(i ? g[i - 1][j] : 0, j ? g[i][j - 1] : 0) + R.int(1, 3)); } return { matrix: g, target: R.int(1, 14) }; },
    s(I, T) { const g = I.matrix; let r = 0, c = g[0].length - 1; while (r < g.length && c >= 0) { const v = g[r][c]; if (v === I.target) { T.at({ matrix: G(g, { hl: [[r, c]] }) }); T.c(`${v} vs target ${I.target}?`, ['found', 'left', 'down'], 'found', 'Equal.'); return true; } T.at({ matrix: G(g, { hl: [[r, c]] }), target: I.target }); T.c(`${v} vs target ${I.target}: move?`, ['found', 'left', 'down'], v > I.target ? 'left' : 'down', v > I.target ? 'Everything below is bigger.' : 'Everything left is smaller.'); if (v > I.target) c--; else r++; } return false; }
  });

  D('h-index-ii', {
    t: 'H-Index II: first index with citations ≥ n − i',
    r: 'Binary search the first i with citations[i] ≥ n − i; the h-index is n − i.',
    g: R => ({ citations: sorted(R, R.int(1, 8), 0, 9) }),
    s(I, T) { const c = I.citations, n = c.length; const i = firstTrue(0, n, i => i === n || c[i] >= n - i, T, mid => ({ citations: A(c, { hl: [mid] }) }), mid => `Is citations[${mid}] ≥ ${n - mid}?`); return n - i; }
  });

  D('find-the-duplicate-number', {
    t: 'Find the Duplicate: Floyd cycle on i → nums[i]',
    r: 'Treat i → nums[i] as a linked list. Tortoise and hare meet inside the cycle; restart one at 0 and step both by 1 until they meet at the cycle entrance = duplicate.',
    g: R => { const n = R.int(1, 7), a = R.shuffle([...Array(n).keys()].map(x => x + 1)); a.push(R.int(1, n)); if (R.chance(0.3) && n > 2) a[a.indexOf(a.find(x => x !== a[n]))] = a[n]; return { nums: R.shuffle(a) }; },
    s(I, T) { const res = (() => { const a = I.nums; let s = a[0], f = a[a[0]]; T.at({ nums: A(a) }); T.n('Where does the slow pointer go first?', a[0], 'It reads nums[0].'); while (s !== f) { s = a[s]; f = a[a[f]]; } T.at({ nums: A(a), meet: s }); T.n('Where do tortoise and hare meet?', s, 'Slow 1 step, fast 2 steps.'); s = 0; while (s !== f) { s = a[s]; f = a[f]; } return s; })(); T.n('Duplicate number?', res, 'Where the two pointers meet the second time.'); return res; }
  });

  D('smallest-rectangle-enclosing-black-pixels', {
    t: 'Smallest Rectangle Enclosing Black Pixels',
    r: 'Project black pixels onto rows and columns; because they are connected, binary search the first/last column and row containing a 1 on each side of (x, y).',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), g = Array.from({ length: m }, () => Array(n).fill('0')); let x = R.int(0, m - 1), y = R.int(0, n - 1); const sx = x, sy = y; g[x][y] = '1'; for (let k = 0; k < R.int(0, 6); k++) { const [dx, dy] = R.pick([[0, 1], [1, 0], [0, -1], [-1, 0]]); const nx = x + dx, ny = y + dy; if (nx >= 0 && ny >= 0 && nx < m && ny < n) { x = nx; y = ny; g[x][y] = '1'; } } return { image: g, x: sx, y: sy }; },
    s(I, T) { const g = I.image, m = g.length, n = g[0].length; const col = j => g.some(r => r[j] === '1'), row = i => g[i].includes('1'); const left = firstTrue(0, I.y, col, T, null, j => `Does column ${j} have a black pixel?`); const right = lastTrue(I.y, n - 1, col, T, null, j => `Does column ${j} have a black pixel?`); let top = 0; while (!row(top)) top++; let bot = m - 1; while (!row(bot)) bot--; T.at({ image: G(g) }); T.n('Rectangle width?', right - left + 1, `Columns ${left}..${right}.`); return (right - left + 1) * (bot - top + 1); }
  });

  D('max-sum-of-rectangle-no-larger-than-k', {
    t: 'Max Rectangle Sum ≤ k',
    r: 'Fix a pair of rows, collapse columns into sums, then for each prefix p find the smallest earlier prefix ≥ p − k (sorted set + binary search).',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3); return { matrix: Array.from({ length: m }, () => R.ints(n, -3, 4)), k: R.int(-1, 6) }; },
    s(I, T) { const res = (() => { const g = I.matrix, m = g.length, n = g[0].length; let best = -Infinity; for (let r1 = 0; r1 < m; r1++) { const col = Array(n).fill(0); for (let r2 = r1; r2 < m; r2++) { for (let j = 0; j < n; j++) col[j] += g[r2][j]; const pre = [0]; let p = 0, here = -Infinity; for (const v of col) { p += v; for (const q of pre) if (p - q <= I.k) here = Math.max(here, p - q); pre.push(p); } if (r1 === r2 && r1 < 2) { T.at({ matrix: G(g), colSums: A(col) }); T.n(`Best sum at most k using only row ${r1}? (use −999 if none)`, here === -Infinity ? -999 : here, 'Prefix p minus the smallest earlier prefix that is at least p minus k.'); } best = Math.max(best, here); } } return best; })(); T.n('Best rectangle sum at most k?', res, 'Best over every pair of rows.'); return res; }
  });

  D('kth-smallest-element-in-a-sorted-matrix', {
    t: 'Kth Smallest in a Sorted Matrix: search values',
    r: 'Binary search on value x: count entries ≤ x with the staircase walk. The first x with count ≥ k is the answer.',
    g: R => { const n = R.int(1, 4), g = []; for (let i = 0; i < n; i++) { g.push([]); for (let j = 0; j < n; j++) g[i].push(Math.max(i ? g[i - 1][j] : 0, j ? g[i][j - 1] : 0) + R.int(0, 3)); } return { matrix: g, k: R.int(1, n * n) }; },
    s(I, T) { const g = I.matrix, n = g.length, count = x => g.reduce((s, r) => s + r.filter(v => v <= x).length, 0); return firstTrue(g[0][0], g[n - 1][n - 1], x => count(x) >= I.k, T, x => ({ matrix: G(g), countLE: count(x) }), x => `Are at least ${I.k} entries ≤ ${x}?`); }
  });

  D('nth-digit', {
    t: 'Nth Digit: skip blocks of equal-length numbers',
    r: 'There are 9 one-digit numbers, 90 two-digit, 900 three-digit… Subtract whole blocks, then locate the number and the digit inside it.',
    g: R => ({ n: R.int(1, 3000) }),
    s(I, T) { const res = (() => { let n = I.n, len = 1, cnt = 9, start = 1; while (n > len * cnt) { n -= len * cnt; len++; cnt *= 10; start *= 10; } T.at({ n: I.n }); T.n('How many digits does the target number have?', len, 'Skip whole blocks.'); const num = start + Math.floor((n - 1) / len); T.n('Which number contains it?', num, `start plus (n minus 1) divided by ${len}, rounded down.`); return +String(num)[(n - 1) % len]; })(); T.n('The digit?', res, 'Pick the position inside that number.'); return res; }
  });

  D('split-array-largest-sum', {
    t: 'Split Array Largest Sum: search the cap',
    r: 'Binary search the largest allowed sum S in [max, total]. Greedily cut whenever the running sum would exceed S; S works if it needs ≤ k pieces.',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 0, 9), k: R.int(1, Math.min(n, 4)) }; },
    s(I, T) { const parts = S => { let c = 1, s = 0; for (const v of I.nums) { if (s + v > S) { c++; s = 0; } s += v; } return c; }; return firstTrue(Math.max(...I.nums), I.nums.reduce((a, b) => a + b, 0), S => parts(S) <= I.k, T, S => ({ nums: A(I.nums), pieces: parts(S) }), S => `Can we split into ≤ ${I.k} parts with max sum ${S}?`); }
  });

  D('find-right-interval', {
    t: 'Find Right Interval: search sorted starts',
    r: 'Sort starts with their indices. For each interval, binary search the first start ≥ its end.',
    g: R => { const n = R.int(1, 5), st = R.distinct(n, 0, 12); return { intervals: st.map(s => [s, s + R.int(0, 5)]) }; },
    s(I, T) { const st = I.intervals.map((iv, i) => [iv[0], i]).sort((a, b) => a[0] - b[0]); return I.intervals.map(([, e]) => { let lo = 0, hi = st.length; while (lo < hi) { const m = (lo + hi) >> 1; if (st[m][0] >= e) hi = m; else lo = m + 1; } const r = lo < st.length ? st[lo][1] : -1; T.at({ starts: A(st.map(x => x[0])), end: e }); T.n(`Right interval index for end ${e} (−1 if none)?`, r, 'Smallest start ≥ end.'); return r; }); }
  });

  D('heaters', {
    t: 'Heaters: nearest heater per house',
    r: 'Sort heaters. For each house, binary search the nearest heater on each side; the radius must cover the worst house.',
    g: R => ({ houses: R.ints(R.int(1, 5), 1, 15), heaters: R.ints(R.int(1, 3), 1, 15) }),
    s(I, T) { const h = I.heaters.slice().sort((a, b) => a - b); let best = 0; for (const x of I.houses) { let lo = 0, hi = h.length; while (lo < hi) { const m = (lo + hi) >> 1; if (h[m] >= x) hi = m; else lo = m + 1; } const d = Math.min(lo < h.length ? h[lo] - x : Infinity, lo ? x - h[lo - 1] : Infinity); T.at({ heaters: A(h), house: x }); T.n(`Distance from house ${x} to the nearest heater?`, d, 'Check both neighbors of the insertion point.'); best = Math.max(best, d); } return best; }
  });

  D('smallest-good-base', {
    t: 'Smallest Good Base: try digit counts',
    r: 'With m + 1 ones, n = 1 + k + … + k^m, so k ≈ n^(1/m). Try m from largest to smallest; check k = ⌊n^(1/m)⌋ exactly with BigInt. m = 1 gives k = n − 1.',
    g: R => { const k = R.int(2, 9), m = R.int(1, 4); let n = 0n; for (let i = 0; i <= m; i++) n = n * BigInt(k) + 1n; return { n: String(R.chance(0.3) ? n + BigInt(R.int(1, 5)) : n) }; },
    s(I, T) { const n = BigInt(I.n); T.at({ n: I.n }); T.n('Most ones possible?', Math.floor(Math.log2(I.n)) + 1, 'Base 2 gives the longest string of ones.'); for (let m = Math.floor(Math.log2(Number(n))); m >= 2; m--) { const k = BigInt(Math.floor(Math.pow(Number(n), 1 / m))); if (k < 2n) continue; for (const kk of [k, k + 1n]) { let s = 0n; for (let i = 0; i <= m; i++) s = s * kk + 1n; if (s === n) { T.at({ n: I.n, ones: m + 1 }); T.n('Smallest good base?', Number(kk), `${m + 1} ones in base ${kk}.`); T.n('How many ones?', m + 1, 'Longer strings are tried first.'); return String(kk); } } } T.at({ n: I.n }); T.yn('Did any base with at least 3 ones work?', false, 'Fall back to n minus 1, written as 11.'); T.n('Smallest good base?', I.n - 1, 'n minus 1.'); return String(n - 1n); }
  });

  D('sum-of-square-numbers', {
    t: 'Sum of Square Numbers: two pointers',
    r: 'a = 0, b = ⌊√c⌋. If a² + b² is too small, a++; too big, b−−; equal → true.',
    g: R => ({ c: R.int(0, 60) }),
    s(I, T) { let a = 0, b = Math.floor(Math.sqrt(I.c)); while (a <= b) { const s = a * a + b * b; T.at({ a, b, sum: s, c: I.c }); T.c(`${a}² + ${b}² = ${s}: next?`, ['found', 'a++', 'b−−'], s === I.c ? 'found' : s < I.c ? 'a++' : 'b−−', 'Move the side that fixes the sum.'); if (s === I.c) return true; if (s < I.c) a++; else b--; } return false; }
  });

  D('maximum-average-subarray-ii', {
    t: 'Maximum Average Subarray II: search the average',
    r: 'Binary search avg m: subtract m from every value; a subarray of length ≥ k with average ≥ m exists iff some prefix[j] − min(prefix[i], i ≤ j − k) ≥ 0.',
    cmp: 'float',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, -5, 9), k: R.int(1, n) }; },
    s(I, T) { const a = I.nums, n = a.length; const ok = m => { let p = 0, pk = 0, mn = 0; for (let i = 0; i < I.k; i++) p += a[i] - m; if (p >= 0) return true; for (let i = I.k; i < n; i++) { p += a[i] - m; pk += a[i - I.k] - m; mn = Math.min(mn, pk); if (p - mn >= 0) return true; } return false; }; let best = -Infinity; for (let i = 0; i < n; i++) { let s = 0; for (let j = i; j < n; j++) { s += a[j]; if (j - i + 1 >= I.k) best = Math.max(best, s / (j - i + 1)); } } const lo = Math.min(...a), hi = Math.max(...a); for (const m of [Math.floor((lo + hi) / 2), lo, hi]) { T.at({ nums: A(a), k: I.k, guess: m }); T.yn(`Is some average ≥ ${m} achievable?`, ok(m), 'Subtract the guess, look for a non-negative window.'); } return best; }
  });

  D('find-k-closest-elements', {
    t: 'Find K Closest Elements: search the window start',
    r: 'Binary search the start s in [0, n − k]: if x − arr[s] > arr[s + k] − x, the window should move right.',
    g: R => { const a = sorted(R, R.int(1, 8), 0, 12); return { arr: a, k: R.int(1, a.length), x: R.int(-2, 14) }; },
    s(I, T) { const res = (() => { const a = I.arr; let lo = 0, hi = a.length - I.k; while (lo < hi) { const m = (lo + hi) >> 1, right = I.x - a[m] > a[m + I.k] - I.x; T.at({ arr: A(a, { win: [m, m + I.k - 1], hl: [m + I.k] }), x: I.x }); T.yn(`Should the window move right of start ${m}?`, right, `x minus ${a[m]}, compared with ${a[m + I.k]} minus x.`); if (right) lo = m + 1; else hi = m; } if (a.length === I.k) { T.at({ arr: A(a) }); T.n('Window start when k = n?', 0, 'Take everything.'); } return a.slice(lo, lo + I.k); })(); T.n('First value of the window?', res[0], 'The final start.'); return res; }
  });

  D('kth-smallest-number-in-multiplication-table', {
    t: 'Kth Smallest in a Multiplication Table',
    r: 'Binary search x: count = Σ_i min(⌊x / i⌋, n). The first x with count ≥ k is the answer.',
    g: R => { const m = R.int(1, 5), n = R.int(1, 5); return { m, n, k: R.int(1, m * n) }; },
    s(I, T) { const count = x => { let c = 0; for (let i = 1; i <= I.m; i++) c += Math.min(Math.floor(x / i), I.n); return c; }; return firstTrue(1, I.m * I.n, x => count(x) >= I.k, T, x => ({ countLE: count(x) }), x => `Are at least ${I.k} entries ≤ ${x}?`); }
  });

  D('search-in-a-sorted-array-of-unknown-size', {
    t: 'Search Sorted Array of Unknown Size',
    r: 'Double hi until secret[hi] ≥ target (out of range reads as +∞), then binary search [hi/2, hi].',
    g: R => { const a = R.distinct(R.int(1, 8), -5, 15).sort((x, y) => x - y); return { secret: a, target: R.chance(0.6) ? R.pick(a) : R.int(-5, 15) }; },
    s(I, T) { const res = (() => { const get = i => i < I.secret.length ? I.secret[i] : Infinity; let hi = 1; while (get(hi) < I.target) hi *= 2; T.at({ secret: A(I.secret), target: I.target }); T.n('Upper bound after doubling?', hi, 'Double until reader(hi) is at least target.'); T.n('Lower bound for the binary search?', Math.floor(hi / 2), 'The previous doubling point.'); let lo = Math.floor(hi / 2); while (lo <= hi) { const m = (lo + hi) >> 1, v = get(m); if (v === I.target) return m; if (v < I.target) lo = m + 1; else hi = m - 1; } return -1; })(); T.n('Index of target? (−1 if missing)', res, 'Binary search between the bounds.'); return res; }
  });

  D('find-k-th-smallest-pair-distance', {
    t: 'Kth Smallest Pair Distance',
    r: 'Sort. Binary search distance d; count pairs with distance ≤ d using a sliding left pointer. First d with count ≥ k.',
    g: R => { const n = R.int(2, 6); return { nums: R.ints(n, 0, 9), k: R.int(1, n * (n - 1) / 2) }; },
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), count = d => { let c = 0, l = 0; for (let r = 0; r < a.length; r++) { while (a[r] - a[l] > d) l++; c += r - l; } return c; }; return firstTrue(0, a[a.length - 1] - a[0], d => count(d) >= I.k, T, d => ({ sorted: A(a), pairsLE: count(d) }), d => `At least ${I.k} pairs with distance ≤ ${d}?`); }
  });

  D('minimize-max-distance-to-gas-station', {
    t: 'Minimize Max Distance to Gas Station',
    r: 'Binary search the distance D (real numbers). A gap g needs ⌈g / D⌉ − 1 new stations; D works if the total ≤ k.',
    cmp: 'float',
    g: R => ({ stations: R.distinct(R.int(2, 6), 0, 30).sort((a, b) => a - b), k: R.int(1, 5) }),
    s(I, T) { const gaps = I.stations.slice(1).map((x, i) => x - I.stations[i]), need = D => gaps.reduce((s, g) => s + Math.ceil(g / D - 1e-12) - 1, 0); let lo = 0, hi = Math.max(...gaps), asks = 0; while (hi - lo > 1e-7) { const m = (lo + hi) / 2, ok = need(m) <= I.k; if (asks < 3 && Number.isInteger(m * 2)) { T.at({ gaps: A(gaps), D: m, needed: need(m) }); T.yn(`Can max distance ${m} be reached with ${I.k} stations?`, ok, 'Sum ⌈gap/D⌉ − 1.'); asks++; } if (ok) hi = m; else lo = m; } if (!asks) { T.at({ gaps: A(gaps) }); T.n('Largest gap?', Math.max(...gaps), 'Starting upper bound.'); } return hi; }
  });

  D('k-th-smallest-prime-fraction', {
    t: 'Kth Smallest Prime Fraction',
    r: 'Binary search a real x; count fractions arr[i]/arr[j] ≤ x with two pointers, tracking the largest such fraction. Stop when the count is exactly k.',
    g: R => { const p = [1, 2, 3, 5, 7, 11, 13].slice(0, R.int(2, 7)); return { arr: p, k: R.int(1, p.length * (p.length - 1) / 2) }; },
    s(I, T) { const res = (() => { const a = I.arr, n = a.length, fr = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) fr.push([a[i], a[j]]); fr.sort((x, y) => x[0] * y[1] - y[0] * x[1]); const x = 0.5, c = fr.filter(f => f[0] / f[1] <= x).length; T.at({ arr: A(a), k: I.k, x }); T.n(`How many fractions are at most ${x}?`, c, 'Two pointers count them.'); T.yn(`Is the answer at most ${x}?`, c >= I.k, 'Compare the count with k.'); return fr[I.k - 1]; })(); T.n('Numerator of the answer?', res[0], 'The kth smallest fraction.'); return res; }
  });

  D('number-of-matching-subsequences', {
    t: 'Matching Subsequences: next-position search',
    r: 'Store sorted positions for each letter of s. For each word, binary search the next position > current for each letter.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc'), words: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 3), 'abc')) }),
    s(I, T) { const pos = {}; [...I.s].forEach((c, i) => (pos[c] = pos[c] || []).push(i)); return I.words.filter(w => { let cur = -1; for (const c of w) { const p = pos[c] || []; let lo = 0, hi = p.length; while (lo < hi) { const m = (lo + hi) >> 1; if (p[m] > cur) hi = m; else lo = m + 1; } if (lo === p.length) { cur = Infinity; break; } cur = p[lo]; } const ok = cur !== Infinity; T.at({ s: A([...I.s]), word: w }); T.yn(`Is "${w}" a subsequence?`, ok, 'Each letter found after the previous one.'); return ok; }).length; }
  });

  D('preimage-size-of-factorial-zeroes-function', {
    t: 'Preimage Size of Factorial Zeroes',
    r: 'f(x) = Σ ⌊x / 5^i⌋ is non-decreasing and jumps past some values. Binary search the smallest x with f(x) ≥ k; the answer is 5 if f(x) = k, else 0.',
    g: R => ({ k: R.int(0, 40) }),
    s(I, T) { const f = x => { let c = 0; while (x) { x = Math.floor(x / 5); c += x; } return c; }; const x = firstTrue(0, 5 * I.k + 5, x => f(x) >= I.k, T, x => ({ zeros: f(x) }), x => `Does ${x}! have at least ${I.k} trailing zeros?`); return f(x) === I.k ? 5 : 0; }
  });

  D('nth-magical-number', {
    t: 'Nth Magical Number: inclusion-exclusion count',
    r: 'Count multiples of a or b up to x: ⌊x/a⌋ + ⌊x/b⌋ − ⌊x/lcm⌋. Binary search the first x with count ≥ n; return it mod 1e9+7.',
    g: R => ({ n: R.int(1, 30), a: R.int(2, 9), b: R.int(2, 9) }),
    s(I, T) { const l = I.a / gcd(I.a, I.b) * I.b, c = x => Math.floor(x / I.a) + Math.floor(x / I.b) - Math.floor(x / l); const x = firstTrue(1, I.n * Math.min(I.a, I.b), x => c(x) >= I.n, T, x => ({ count: c(x) }), x => `Are there at least ${I.n} magical numbers ≤ ${x}?`); return x % 1000000007; }
  });

  D('longest-duplicate-substring', {
    t: 'Longest Duplicate Substring: search the length',
    r: 'If a duplicate of length L exists, one of length L − 1 does too. Binary search L; check with a set of substrings (Rabin–Karp in practice).',
    cmp: (o, e, I) => typeof o === 'string' && o.length === e.length && (!o || I.s.indexOf(o) !== I.s.lastIndexOf(o)),
    g: R => ({ s: R.str(R.int(2, 9), 'ab') }),
    s(I, T) { const dup = L => { const seen = new Set(); for (let i = 0; i + L <= I.s.length; i++) { const t = I.s.substr(i, L); if (seen.has(t)) return t; seen.add(t); } return null; }; const L = lastTrue(0, I.s.length - 1, L => L === 0 || !!dup(L), T, null, L => `Is there a repeated substring of length ${L}?`); return L ? dup(L) : ''; }
  });

  D('missing-element-in-sorted-array', {
    t: 'Kth Missing Element in a Sorted Array',
    r: 'missing(i) = nums[i] − nums[0] − i. Binary search the last i with missing(i) < k; the answer is nums[i] + k − missing(i).',
    g: R => ({ nums: R.distinct(R.int(1, 6), 1, 15).sort((a, b) => a - b), k: R.int(1, 8) }),
    s(I, T) { const a = I.nums, miss = i => a[i] - a[0] - i; const i = lastTrue(0, a.length - 1, i => miss(i) < I.k, T, i => ({ nums: A(a, { hl: [i] }), missing: miss(i) }), i => `Are fewer than ${I.k} numbers missing before index ${i}?`); return a[i] + I.k - miss(i); }
  });

  D('fixed-point', {
    t: 'Fixed Point: first arr[i] ≥ i',
    r: 'arr[i] − i is non-decreasing for distinct sorted integers. Binary search the first i with arr[i] ≥ i; check equality.',
    g: R => ({ arr: R.distinct(R.int(1, 7), -5, 9).sort((a, b) => a - b) }),
    s(I, T) { const a = I.arr, i = firstTrue(0, a.length, i => i === a.length || a[i] >= i, T, i => ({ arr: A(a, { hl: [i] }) }), i => `Is arr[${i}] ≥ ${i}?`); return i < a.length && a[i] === i ? i : -1; }
  });

  D('find-in-mountain-array', {
    t: 'Find in Mountain Array: peak, then two searches',
    r: 'Binary search the peak (compare arr[m] with arr[m + 1]). Search the increasing left side first; if not found, the decreasing right side.',
    g: R => { const up = R.distinct(R.int(2, 4), 0, 9).sort((a, b) => a - b), pk = up[up.length - 1] + 1, dn = R.distinct(R.int(1, 3), 0, pk - 1).sort((a, b) => b - a); const a = [...up, pk, ...dn]; return { mountainArr: a, target: R.chance(0.7) ? R.pick(a) : R.int(0, 12) }; },
    s(I, T) { const a = I.mountainArr; const peak = firstTrue(0, a.length - 1, m => m === a.length - 1 || a[m] > a[m + 1], T, m => ({ arr: A(a, { hl: [m, m + 1] }) }), m => `Is arr[${m}] > arr[${m + 1}] (past the peak)?`); let lo = 0, hi = peak; while (lo <= hi) { const m = (lo + hi) >> 1; if (a[m] === I.target) return m; if (a[m] < I.target) lo = m + 1; else hi = m - 1; } lo = peak; hi = a.length - 1; while (lo <= hi) { const m = (lo + hi) >> 1; if (a[m] === I.target) return m; if (a[m] > I.target) lo = m + 1; else hi = m - 1; } return -1; }
  });

  D('check-if-a-number-is-majority-element-in-a-sorted-array', {
    t: 'Majority Element in a Sorted Array',
    r: 'Binary search the first index of target; it is a majority iff nums[first + ⌊n/2⌋] is still target.',
    g: R => ({ nums: sorted(R, R.int(1, 8), 1, 4), target: R.int(1, 4) }),
    s(I, T) { const a = I.nums, n = a.length, f = firstTrue(0, n, i => i === n || a[i] >= I.target, T, i => ({ nums: A(a, { hl: [i] }) }), i => `Is nums[${i}] ≥ ${I.target}?`); return f < n && a[f] === I.target && f + Math.floor(n / 2) < n && a[f + Math.floor(n / 2)] === I.target; }
  });

  D('compare-strings-by-frequency-of-the-smallest-character', {
    t: 'Compare Strings by Smallest-Character Frequency',
    r: 'Compute f for every word and sort. For each query, binary search how many word f-values exceed f(query).',
    g: R => ({ queries: Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 4), 'abc')), words: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 4), 'abc')) }),
    s(I, T) { const f = s => { const m = [...s].sort()[0]; return [...s].filter(c => c === m).length; }; const w = I.words.map(f).sort((a, b) => a - b); return I.queries.map(q => { const fq = f(q), c = w.filter(x => x > fq).length; T.at({ wordF: A(w), query: q }); T.n(`f("${q}")?`, fq, 'Count of its smallest letter.'); return c; }); }
  });

  D('find-smallest-common-element-in-all-rows', {
    t: 'Smallest Common Element in All Rows',
    r: 'For each value of the first row (ascending), binary search it in every other row; the first one found everywhere is the answer.',
    g: R => { const m = R.int(1, 4), c = R.int(1, 9); return { mat: Array.from({ length: m }, () => [...new Set([...R.ints(R.int(1, 4), 1, 9), ...(R.chance(0.7) ? [c] : [])])].sort((a, b) => a - b)) }; },
    s(I, T) { const has = (r, v) => { let lo = 0, hi = r.length - 1; while (lo <= hi) { const m = (lo + hi) >> 1; if (r[m] === v) return true; if (r[m] < v) lo = m + 1; else hi = m - 1; } return false; }; for (const v of I.mat[0]) { const ok = I.mat.every(r => has(r, v)); T.at({ mat: A(I.mat.map(r => r.join(' '))), value: v }); T.yn(`Is ${v} in every row?`, ok, 'Binary search each row.'); if (ok) return v; } return -1; }
  });

  D('ugly-number-iii', {
    t: 'Ugly Number III: inclusion-exclusion count',
    r: 'Count numbers ≤ x divisible by a, b or c with inclusion-exclusion over the lcms; binary search the first x with count ≥ n.',
    g: R => ({ n: R.int(1, 20), a: R.int(2, 7), b: R.int(2, 7), c: R.int(2, 7) }),
    s(I, T) { const l = (x, y) => x / gcd(x, y) * y, ab = l(I.a, I.b), bc = l(I.b, I.c), ac = l(I.a, I.c), abc = l(ab, I.c); const cnt = x => Math.floor(x / I.a) + Math.floor(x / I.b) + Math.floor(x / I.c) - Math.floor(x / ab) - Math.floor(x / bc) - Math.floor(x / ac) + Math.floor(x / abc); return firstTrue(1, I.n * Math.min(I.a, I.b, I.c), x => cnt(x) >= I.n, T, x => ({ count: cnt(x) }), x => `At least ${I.n} ugly numbers ≤ ${x}?`); }
  });

  D('missing-number-in-arithmetic-progression', {
    t: 'Missing Number in an Arithmetic Progression',
    r: 'The step is (last − first) / n. Binary search the first index where arr[i] ≠ first + i·step; the missing value is first + i·step.',
    g: R => { const a0 = R.int(0, 9), d = R.pick([-3, -2, -1, 1, 2, 3]), n = R.int(3, 7), full = Array.from({ length: n + 1 }, (_, i) => a0 + i * d); full.splice(R.int(1, n - 1), 1); return { arr: full }; },
    s(I, T) { const a = I.arr, n = a.length, d = (a[n - 1] - a[0]) / n; T.at({ arr: A(a) }); T.n('Step of the progression?', d, `(last − first) / ${n}.`); const i = firstTrue(0, n - 1, i => a[i] !== a[0] + i * d, T, i => ({ arr: A(a, { hl: [i] }) }), i => `Is arr[${i}] already off the progression?`); return a[0] + i * d; }
  });

  D('divide-chocolate', {
    t: 'Divide Chocolate: maximize your minimum piece',
    r: 'Binary search the sweetness s you get. Greedily cut whenever a piece reaches s; s works if that makes at least k + 1 pieces.',
    g: R => { const n = R.int(1, 8); return { sweetness: R.ints(n, 1, 9), k: R.int(0, n - 1) }; },
    s(I, T) { const pieces = s => { let c = 0, cur = 0; for (const v of I.sweetness) { cur += v; if (cur >= s) { c++; cur = 0; } } return c; }; return lastTrue(1, Math.floor(I.sweetness.reduce((a, b) => a + b, 0) / (I.k + 1)), s => pieces(s) >= I.k + 1, T, s => ({ sweetness: A(I.sweetness), pieces: pieces(s) }), s => `Can every one of ${I.k + 1} pieces have sweetness ≥ ${s}?`); }
  });

  D('find-the-smallest-divisor-given-a-threshold', {
    t: 'Smallest Divisor Given a Threshold',
    r: 'Σ ⌈nums[i] / d⌉ decreases as d grows. Binary search the first d with sum ≤ threshold.',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, 1, 20), threshold: R.int(n, n + 10) }; },
    s(I, T) { const s = d => I.nums.reduce((a, v) => a + Math.ceil(v / d), 0); return firstTrue(1, Math.max(...I.nums), d => s(d) <= I.threshold, T, d => ({ nums: A(I.nums), sum: s(d) }), d => `Is Σ⌈x/${d}⌉ ≤ ${I.threshold}?`); }
  });

  D('maximum-side-length-of-a-square-with-sum-less-than-or-equal-to-threshold', {
    t: 'Largest Square With Sum ≤ Threshold',
    r: 'Build 2D prefix sums. Binary search side L: L works if some L×L square has sum ≤ threshold.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { mat: Array.from({ length: m }, () => R.ints(n, 0, 4)), threshold: R.int(0, 12) }; },
    s(I, T) { const res = (() => { const g = I.mat, m = g.length, n = g[0].length, P = Array.from({ length: m + 1 }, () => Array(n + 1).fill(0)); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) P[i + 1][j + 1] = g[i][j] + P[i][j + 1] + P[i + 1][j] - P[i][j]; const ok = L => { for (let i = L; i <= m; i++) for (let j = L; j <= n; j++) if (P[i][j] - P[i - L][j] - P[i][j - L] + P[i - L][j - L] <= I.threshold) return true; return false; }; return lastTrue(0, Math.min(m, n), L => L === 0 || ok(L), T, () => ({ mat: G(g) }), L => `Is there a ${L} by ${L} square with sum at most ${I.threshold}?`); })(); T.n('Largest side length?', res, 'The last size that worked.'); return res; }
  });

  D('sum-of-mutated-array-closest-to-target', {
    t: 'Mutated Array Sum Closest to Target',
    r: 'sum(v) = Σ min(a, v) grows with v. Binary search the first v with sum(v) ≥ target, then compare v and v − 1 (ties → smaller).',
    g: R => ({ arr: R.ints(R.int(1, 5), 1, 12), target: R.int(1, 40) }),
    s(I, T) { const s = v => I.arr.reduce((a, x) => a + Math.min(x, v), 0), mx = Math.max(...I.arr); const v = firstTrue(0, mx, v => s(v) >= I.target, T, v => ({ arr: A(I.arr), sum: s(v) }), v => `Is the capped sum at ${v} ≥ ${I.target}?`); return v > 0 && Math.abs(s(v - 1) - I.target) <= Math.abs(s(v) - I.target) ? v - 1 : v; }
  });

  D('the-k-weakest-rows-in-a-matrix', {
    t: 'The K Weakest Rows',
    r: 'Binary search each row for its first 0 (the soldier count). Sort rows by (count, index) and take k.',
    g: R => { const m = R.int(2, 5), n = R.int(2, 5); return { mat: Array.from({ length: m }, () => { const s = R.int(0, n); return Array.from({ length: n }, (_, j) => j < s ? 1 : 0); }), k: R.int(1, m) }; },
    s(I, T) { const c = I.mat.map(r => { let lo = 0, hi = r.length; while (lo < hi) { const m = (lo + hi) >> 1; if (r[m] === 0) hi = m; else lo = m + 1; } return lo; }); I.mat.slice(0, 3).forEach((r, i) => { T.at({ mat: G(I.mat, { hl: [[i, 0]] }) }); T.n(`Soldiers in row ${i}?`, c[i], 'Index of the first 0.'); }); return c.map((v, i) => i).sort((a, b) => c[a] - c[b] || a - b).slice(0, I.k); }
  });

  D('find-the-distance-value-between-two-arrays', {
    t: 'Distance Value Between Two Arrays',
    r: 'Sort arr2. For each x in arr1, binary search the nearest arr2 values; count x if all are farther than d.',
    g: R => ({ arr1: R.ints(R.int(1, 4), -5, 10), arr2: R.ints(R.int(1, 5), -5, 10), d: R.int(0, 3) }),
    s(I, T) { const b = I.arr2.slice().sort((x, y) => x - y); return I.arr1.filter(x => { let lo = 0, hi = b.length; while (lo < hi) { const m = (lo + hi) >> 1; if (b[m] >= x - I.d) hi = m; else lo = m + 1; } const ok = !(lo < b.length && b[lo] <= x + I.d); T.at({ arr2: A(b, { hl: [lo] }), x, d: I.d }); T.yn(`Is every arr2 value farther than ${I.d} from ${x}?`, ok, 'Check the first value ≥ x − d.'); return ok; }).length; }
  });
})();
