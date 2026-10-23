/* v2 games: hashing & counting (02). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const cnt = a => { const m = new Map(); for (const x of a) m.set(x, (m.get(x) || 0) + 1); return m; };
  const obj = m => Object.fromEntries([...m].map(([k, v]) => [String(k), v]));
  const goodPairs = {
    r: 'Count nums2 values. For each nums1 value x, if x is divisible by k, enumerate the divisors d of x / k and add count[d] (pairs need nums1[i] % (nums2[j]·k) == 0).',
    g: R => { const k = R.int(1, 3); return { nums1: R.ints(R.int(1, 5), 1, 12), nums2: R.ints(R.int(1, 5), 1, 6), k }; },
    s(I, T) { const c = cnt(I.nums2); let t = 0; I.nums1.forEach((x, i) => { let add = 0; if (x % I.k === 0) { const y = x / I.k; for (let d = 1; d <= y; d++) if (y % d === 0) add += c.get(d) || 0; } t += add; if (i < 5) { T.at({ nums1: A(I.nums1, { i }), nums2Counts: K(obj(c)), k: I.k }); T.n(`Good pairs with nums1 = ${x}?`, add, `Divisors of ${x} / k that appear in nums2.`); } }); return t; }
  };
  const day = {
    r: 'Count hours mod 24. Each hour h pairs with earlier hours whose remainder is (24 − h mod 24) mod 24.',
    g: R => ({ hours: Array.from({ length: R.int(1, 8) }, () => R.pick([12, 24, 30, 6, 18, 48, 36, 1, 23])) }),
    s(I, T) { const c = Array(24).fill(0); let t = 0; I.hours.forEach((h, i) => { const r = h % 24, need = (24 - r) % 24; t += c[need]; c[r]++; if (i < 8) { T.at({ hours: A(I.hours, { i }) }); T.n('Complete-day pairs so far?', t, `Earlier hours with remainder ${need}.`); } }); return t; }
  };
  const almostEqual = swaps => ({
    r: `Pad both numbers to the same length. Generate every value reachable from x with at most ${swaps} digit swap${swaps > 1 ? 's' : ''} (a small set) and count how many earlier numbers are in it, using a hash map of counts.`,
    g: R => ({ nums: Array.from({ length: R.int(2, 6) }, () => { const base = R.pick([12, 21, 102, 120, 201, 3, 30, 300, 1023, 2310]); return R.chance(0.7) ? base : R.int(1, 400); }) }),
    s(I, T) { const reach = (s, k) => { let fr = new Set([s]); const all = new Set([s]); for (let r = 0; r < k; r++) { const nf = new Set(); for (const x of fr) for (let i = 0; i < x.length; i++) for (let j = i + 1; j < x.length; j++) { const a = [...x];[a[i], a[j]] = [a[j], a[i]]; const y = a.join(''); if (!all.has(y)) { all.add(y); nf.add(y); } } fr = nf; } return all; }; const L = Math.max(...I.nums.map(x => String(x).length)), P = I.nums.map(x => String(x).padStart(L, '0')); let t = 0; for (let j = 0; j < P.length; j++) { const S = reach(P[j], swaps); let add = 0; for (let i = 0; i < j; i++) if (S.has(P[i])) add++; t += add; if (j < 6) { T.at({ nums: A(P, { j }) }); T.n('Earlier numbers almost equal to this one?', add, `Within ${swaps} swap${swaps > 1 ? 's' : ''}.`); } } return t; }
  });

  D('check-if-an-array-is-consecutive', {
    t: 'Check if an Array Is Consecutive',
    r: 'Consecutive iff all values are distinct (hash set size n) and max − min = n − 1.',
    g: R => { const s = R.int(0, 5), n = R.int(1, 6), a = Array.from({ length: n }, (_, i) => s + i); if (R.chance(0.4)) a[R.int(0, n - 1)] = R.int(0, 10); return { nums: R.shuffle(a) }; },
    s(I, T) { const S = new Set(I.nums), mn = Math.min(...I.nums), mx = Math.max(...I.nums); T.at({ nums: A(I.nums) }); T.n('Distinct values?', S.size, 'Must equal n.'); T.n('max − min?', mx - mn, 'Must equal n − 1.'); return S.size === I.nums.length && mx - mn === I.nums.length - 1; }
  });

  D('intersection-of-multiple-arrays', {
    t: 'Intersection of Multiple Arrays',
    r: 'Each array has distinct values, so count occurrences across arrays; values with count = number of arrays, sorted ascending.',
    g: R => ({ nums: Array.from({ length: R.int(1, 3) }, () => R.distinct(R.int(1, 5), 1, 7)) }),
    s(I, T) { const c = cnt(I.nums.flat()); T.at({ counts: K(obj(c)), arrays: I.nums.length }); const out = [...c].filter(([, k]) => k === I.nums.length).map(([v]) => v).sort((a, b) => a - b); T.n('How many values are in every array?', out.length, 'Count equals the number of arrays.'); return out; }
  });

  D('maximum-number-of-pairs-in-array', {
    t: 'Maximum Number of Pairs in Array',
    r: 'Count values: each value contributes ⌊c/2⌋ pairs and c mod 2 leftovers.',
    g: R => ({ nums: R.ints(R.int(1, 9), 0, 4) }),
    s(I, T) { const c = cnt(I.nums); let p = 0; for (const [v, k] of c) { p += k >> 1; T.at({ counts: K(obj(c)), v }); T.n('Pairs so far?', p, `⌊${k}/2⌋ from ${v}.`); } return [p, I.nums.length - 2 * p]; }
  });

  D('best-poker-hand', {
    t: 'Best Poker Hand',
    r: 'All suits equal → "Flush". Otherwise take the max rank count: ≥ 3 → "Three of a Kind", 2 → "Pair", else "High Card".',
    g: R => ({ ranks: R.ints(5, 1, 6), suits: R.chance(0.3) ? Array(5).fill('a') : Array.from({ length: 5 }, () => R.pick(['a', 'b', 'c', 'd'])) }),
    s(I, T) { const fl = new Set(I.suits).size === 1; T.at({ suits: A(I.suits) }); T.yn('Flush?', fl, 'All five suits equal.'); if (fl) return 'Flush'; const m = Math.max(...cnt(I.ranks).values()); T.at({ ranks: A(I.ranks) }); T.n('Most cards sharing a rank?', m, 'Max count.'); return m >= 3 ? 'Three of a Kind' : m === 2 ? 'Pair' : 'High Card'; }
  });

  D('merge-similar-items', {
    t: 'Merge Similar Items',
    r: 'Add weights into a map keyed by value from both lists; output [value, total] sorted by value.',
    g: R => ({ items1: R.distinct(R.int(1, 4), 1, 8).map(v => [v, R.int(1, 9)]), items2: R.distinct(R.int(1, 4), 1, 8).map(v => [v, R.int(1, 9)]) }),
    s(I, T) { const m = new Map(); [...I.items1, ...I.items2].forEach(([v, w]) => m.set(v, (m.get(v) || 0) + w)); T.at({ weights: K(obj(m)) }); T.n('Distinct values?', m.size, 'Keys after merging.'); return [...m].sort((a, b) => a[0] - b[0]); }
  });

  D('find-subarrays-with-equal-sum', {
    t: 'Find Subarrays With Equal Sum',
    r: 'Insert each adjacent-pair sum into a set; a repeat means two different length-2 subarrays share a sum.',
    g: R => ({ nums: R.ints(R.int(2, 7), 0, 6) }),
    s(I, T) { const S = new Set(); for (let i = 0; i + 1 < I.nums.length; i++) { const s = I.nums[i] + I.nums[i + 1], hit = S.has(s); T.at({ nums: A(I.nums, { win: [i, i + 1] }), seen: A([...S]) }); T.yn(`Seen sum ${s} before?`, hit, 'Set lookup.'); if (hit) return true; S.add(s); } return false; }
  });

  D('most-frequent-even-element', {
    t: 'Most Frequent Even Element',
    r: 'Count even values; return the one with the highest count, smallest on ties, or −1.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 6) }),
    s(I, T) { const c = cnt(I.nums.filter(x => x % 2 === 0)); T.at({ evenCounts: K(obj(c)) }); T.n('How many distinct even values?', c.size, 'Only evens count.'); if (!c.size) return -1; return [...c].sort((a, b) => b[1] - a[1] || a[0] - b[0])[0][0]; }
  });

  D('destroy-sequential-targets', {
    t: 'Destroy Sequential Targets',
    r: 'Seeding nums[i] destroys every target with the same remainder mod space (and ≥ it). Count remainders; among values in the largest class, return the minimum.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 12), space: R.int(1, 4) }),
    s(I, T) { const c = cnt(I.nums.map(x => x % I.space)), mx = Math.max(...c.values()); T.at({ remainderCounts: K(obj(c)), space: I.space }); T.n('Largest remainder class size?', mx, 'Targets destroyed.'); return Math.min(...I.nums.filter(x => c.get(x % I.space) === mx)); }
  });

  D('number-of-unequal-triplets-in-array', {
    t: 'Number of Unequal Triplets in Array',
    r: 'Group by value. Walking the groups with counts left (before) and right (after), a group of size c contributes left · c · right.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 4) }),
    s(I, T) { const c = cnt(I.nums); let left = 0, t = 0; const n = I.nums.length; for (const [v, k] of [...c].sort((a, b) => a[0] - b[0])) { const right = n - left - k, add = left * k * right; t += add; T.at({ counts: K(obj(c)), v }); T.n(`Triplets with ${v} in the middle group?`, add, 'left · c · right.'); left += k; } return t; }
  });

  D('form-smallest-number-from-two-digit-arrays', {
    t: 'Form Smallest Number From Two Digit Arrays',
    r: 'If the arrays share a digit, the smallest shared digit is the answer. Otherwise combine the two minimum digits, smaller first.',
    g: R => ({ nums1: R.distinct(R.int(1, 4), 1, 9), nums2: R.distinct(R.int(1, 4), 1, 9) }),
    s(I, T) { const S = new Set(I.nums1), common = I.nums2.filter(x => S.has(x)); T.at({ nums1: A(I.nums1), nums2: A(I.nums2) }); T.n('How many shared digits?', common.length, 'Set intersection.'); if (common.length) return Math.min(...common); const a = Math.min(...I.nums1), b = Math.min(...I.nums2); return Math.min(a, b) * 10 + Math.max(a, b); }
  });

  D('convert-an-array-into-a-2d-array-with-conditions', {
    t: 'Convert an Array Into a 2D Array With Conditions',
    r: 'Track how many times each value has appeared; the k-th occurrence goes into row k. The number of rows is the max frequency.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 4) }),
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && o.every(r => r.length && new Set(r).size === r.length) && JSON.stringify(o.flat().sort((a, b) => a - b)) === JSON.stringify(I.nums.slice().sort((a, b) => a - b)),
    s(I, T) { const seen = new Map(), rows = []; I.nums.forEach((x, i) => { const k = seen.get(x) || 0; seen.set(x, k + 1); (rows[k] = rows[k] || []).push(x); if (i < 7) { T.at({ nums: A(I.nums, { i }) }); T.n(`Row for this ${x}?`, k, 'Its occurrence number so far.'); } }); return rows; }
  });

  D('find-the-distinct-difference-array', {
    t: 'Find the Distinct Difference Array',
    r: 'Precompute suffix distinct counts from the right with a set; then sweep from the left with another set: diff[i] = prefixDistinct − suffixDistinct(i + 1).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 4) }),
    s(I, T) { const n = I.nums.length, suf = Array(n + 1).fill(0), S = new Set(); for (let i = n - 1; i >= 0; i--) { S.add(I.nums[i]); suf[i] = S.size; } const P = new Set(); return I.nums.map((x, i) => { P.add(x); const v = P.size - suf[i + 1]; if (i < 6) { T.at({ nums: A(I.nums, { i }), prefixDistinct: P.size, suffixDistinct: suf[i + 1] }); T.n('Distinct difference?', v, 'prefix − suffix.'); } return v; }); }
  });

  D('sum-of-matrix-after-queries', {
    t: 'Sum of Matrix After Queries',
    r: 'Process queries in reverse: the last write to a row or column wins. A row query on an unseen row adds val × (columns not yet fixed); symmetric for columns.',
    g: R => { const n = R.int(1, 4); return { n, queries: Array.from({ length: R.int(1, 5) }, () => [R.int(0, 1), R.int(0, n - 1), R.int(0, 6)]) }; },
    s(I, T) { const rs = new Set(), cs = new Set(); let t = 0; for (let q = I.queries.length - 1; q >= 0; q--) { const [ty, i, v] = I.queries[q], mine = ty ? cs : rs, other = ty ? rs : cs; let add = 0; if (!mine.has(i)) { add = v * (I.n - other.size); mine.add(i); } t += add; T.at({ query: `${ty ? 'col' : 'row'} ${i} = ${v}`, fixedRows: A([...rs]), fixedCols: A([...cs]) }); T.n('Added by this query (processed in reverse)?', add, 'Only cells not overwritten later.'); } return t; }
  });

  D('sum-of-imbalance-numbers-of-all-subarrays', {
    t: 'Sum of Imbalance Numbers of All Subarrays',
    r: 'Fix the left end and extend right with a set: adding x changes imbalance by +1, then −1 if x − 1 is present and −1 if x + 1 is present (no change if x was already present).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 7) }),
    s(I, T) { let t = 0; I.nums.forEach((_, i) => { const S = new Set(); let imb = 0, here = 0; for (let j = i; j < I.nums.length; j++) { const x = I.nums[j]; if (!S.has(x)) { if (S.size) { imb += 1; if (S.has(x - 1)) imb--; if (S.has(x + 1)) imb--; } S.add(x); } here += imb; } t += here; if (i < 5) { T.at({ nums: A(I.nums, { i }) }); T.n('Total imbalance of subarrays starting here?', here, 'Update with the x ± 1 neighbors.'); } }); return t; }
  });

  D('number-of-black-blocks', {
    t: 'Number of Black Blocks',
    r: 'Each black cell touches up to four 2×2 blocks (top-left corners (r−1..r, c−1..c)). Count blacks per block in a hash map; blocks never touched have 0.',
    g: R => { const m = R.int(2, 4), n = R.int(2, 4), S = new Set(); for (let i = 0; i < R.int(0, 4); i++) S.add(R.int(0, m - 1) + ',' + R.int(0, n - 1)); return { m, n, coordinates: [...S].map(s => s.split(',').map(Number)) }; },
    s(I, T) { const c = new Map(); I.coordinates.forEach(([r, col], k) => { for (const a of [r - 1, r]) for (const b of [col - 1, col]) if (a >= 0 && b >= 0 && a < I.m - 1 && b < I.n - 1) c.set(a + ',' + b, (c.get(a + ',' + b) || 0) + 1); if (k < 4) { T.at({ cell: `${r},${col}`, blocks: K(obj(c)) }); T.n('Blocks touched so far?', c.size, 'Top-left corners within bounds.'); } }); const out = [0, 0, 0, 0, 0]; for (const v of c.values()) out[v]++; out[0] = (I.m - 1) * (I.n - 1) - c.size; return out; }
  });

  D('minimum-index-of-a-valid-split', {
    t: 'Minimum Index of a Valid Split',
    r: 'Find the dominant value x and its total count. Sweep the split i, keeping the left count of x: valid if 2·left > i + 1 and 2·(total − left) > n − i − 1.',
    g: R => { const n = R.int(1, 8), x = R.int(1, 3), a = Array.from({ length: n }, () => R.chance(0.65) ? x : R.int(1, 5)); const c = a.filter(v => v === x).length; if (2 * c <= n) a.fill(x, 0, Math.floor(n / 2) + 1); return { nums: R.shuffle(a) }; },
    s(I, T) { const n = I.nums.length, c = cnt(I.nums); let x = null; for (const [v, k] of c) if (2 * k > n) x = v; T.at({ counts: K(obj(c)) }); T.n('Dominant element?', x, 'Count > n/2.'); const tot = c.get(x); let left = 0; for (let i = 0; i < n - 1; i++) { if (I.nums[i] === x) left++; if (2 * left > i + 1 && 2 * (tot - left) > n - i - 1) return i; } return -1; }
  });

  D('check-if-array-is-good', {
    t: 'Check if Array is Good',
    r: 'With n = max, the array must have length n + 1, contain 1..n−1 exactly once, and n exactly twice. Compare counts.',
    g: R => { const n = R.int(1, 5), a = [...Array(n).keys()].map(x => x + 1); a.push(n); if (R.chance(0.4)) a[R.int(0, a.length - 1)] = R.int(1, n + 1); return { nums: R.shuffle(a) }; },
    s(I, T) { const n = Math.max(...I.nums), c = cnt(I.nums); T.at({ nums: A(I.nums) }); T.n('Required length (max + 1)?', n + 1, 'base[n] has n + 1 elements.'); if (I.nums.length !== n + 1) return false; for (let v = 1; v < n; v++) if (c.get(v) !== 1) return false; return c.get(n) === 2; }
  });

  D('minimum-seconds-to-equalize-a-circular-array', {
    t: 'Minimum Seconds to Equalize a Circular Array',
    r: 'Each value spreads one step per second in both directions. For each value, the largest circular gap d between consecutive occurrences needs ⌊d / 2⌋ seconds; take the minimum over values.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3) }),
    s(I, T) { const n = I.nums.length, pos = new Map(); I.nums.forEach((v, i) => (pos.get(v) || pos.set(v, []).get(v)).push(i)); let best = Infinity; for (const [v, p] of pos) { let g = p[0] + n - p[p.length - 1]; for (let i = 1; i < p.length; i++) g = Math.max(g, p[i] - p[i - 1]); const s = Math.floor(g / 2); best = Math.min(best, s); T.at({ nums: A(I.nums), value: v, positions: A(p) }); T.n(`Seconds if everything becomes ${v}?`, s, '⌊largest gap / 2⌋.'); } return best; }
  });

  D('max-pair-sum-in-an-array', {
    t: 'Max Pair Sum in an Array',
    r: 'Bucket numbers by their largest digit, remembering the best single number per bucket; a new number pairs with that best. Track the max pair sum, or −1.',
    g: R => ({ nums: R.ints(R.int(2, 7), 10, 99) }),
    s(I, T) { const best = {}; let ans = -1; I.nums.forEach((x, i) => { const d = Math.max(...String(x).split('').map(Number)); if (best[d] !== undefined) ans = Math.max(ans, best[d] + x); best[d] = Math.max(best[d] ?? -Infinity, x); if (i < 6) { T.at({ nums: A(I.nums, { i }), bestByDigit: K({ ...best }) }); T.n('Best pair sum so far (−1 if none)?', ans, `Largest digit ${d}.`); } }); return ans; }
  });

  D('maximum-linear-stock-score', {
    t: 'Maximum Linear Stock Score',
    r: 'Linear selection means prices[i] − i is constant. Group by prices[i] − i and sum prices in each group; return the largest group sum.',
    g: R => ({ prices: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const m = new Map(); I.prices.forEach((p, i) => { const k = p - i; m.set(k, (m.get(k) || 0) + p); if (i < 7) { T.at({ prices: A(I.prices, { i }), key: k }); T.n('Group sum for this key so far?', m.get(k), 'Key = price − index.'); } }); return Math.max(...m.values()); }
  });

  D('subarrays-distinct-element-sum-of-squares-i', {
    t: 'Subarrays Distinct Element Sum of Squares I',
    r: 'For each start, extend right with a set; add (distinct count)² for every subarray.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 4) }),
    s(I, T) { let t = 0; I.nums.forEach((_, i) => { const S = new Set(); let here = 0; for (let j = i; j < I.nums.length; j++) { S.add(I.nums[j]); here += S.size * S.size; } t += here; if (i < 5) { T.at({ nums: A(I.nums, { i }) }); T.n('Sum of squares for subarrays starting here?', here, 'Distinct count squared.'); } }); return t; }
  });

  D('find-common-elements-between-two-arrays', {
    t: 'Find Common Elements Between Two Arrays',
    r: 'Make sets of both arrays; count indices of nums1 whose value is in set2 and indices of nums2 whose value is in set1.',
    g: R => ({ nums1: R.ints(R.int(1, 6), 1, 6), nums2: R.ints(R.int(1, 6), 1, 6) }),
    s(I, T) { const s1 = new Set(I.nums1), s2 = new Set(I.nums2), a = I.nums1.filter(x => s2.has(x)).length, b = I.nums2.filter(x => s1.has(x)).length; T.at({ nums1: A(I.nums1), set2: A([...s2]) }); T.n('Indices of nums1 found in nums2?', a, 'Set lookups.'); return [a, b]; }
  });

  D('number-of-divisible-triplet-sums', {
    t: 'Number of Divisible Triplet Sums',
    r: 'Fix k (the last index) and keep a map of remainders of all pairs (i, j) with j < k; add count[(−nums[k]) mod d]. Then add pairs (i, k) to the map.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 9), d: R.int(2, 6) }),
    s(I, T) { const m = new Map(); let t = 0; for (let k = 0; k < I.nums.length; k++) { const need = ((-I.nums[k]) % I.d + I.d) % I.d, add = m.get(need) || 0; t += add; if (k >= 2 && k < 8) { T.at({ nums: A(I.nums, { i: k }), pairRemainders: K(obj(m)) }); T.n('Triplets ending here?', add, `Pairs with remainder ${need}.`); } for (let i = 0; i < k; i++) { const r = (I.nums[i] + I.nums[k]) % I.d; m.set(r, (m.get(r) || 0) + 1); } } return t; }
  });

  D('maximum-square-area-by-removing-fences-from-a-field', {
    t: 'Maximum Square Area by Removing Fences From a Field',
    r: 'Add the borders (1 and m, 1 and n). Put every pairwise difference of horizontal fences in a set; the largest vertical-pair difference also in that set is the side. Area mod 1e9+7, or −1.',
    g: R => { const m = R.int(3, 9), n = R.int(3, 9); return { m, n, hFences: R.distinct(R.int(1, 3), 2, m - 1), vFences: R.distinct(R.int(1, 3), 2, n - 1) }; },
    s(I, T) { const h = [1, I.m, ...I.hFences], v = [1, I.n, ...I.vFences], S = new Set(); for (const a of h) for (const b of h) if (a < b) S.add(b - a); T.at({ hFences: A(h.slice().sort((a, b) => a - b)) }); T.n('How many distinct horizontal gaps?', S.size, 'All pairs.'); let best = -1; for (const a of v) for (const b of v) if (a < b && S.has(b - a)) best = Math.max(best, b - a); return best < 0 ? -1 : Number(BigInt(best) * BigInt(best) % 1000000007n); }
  });

  D('smallest-missing-integer-greater-than-sequential-prefix-sum', {
    t: 'Smallest Missing Integer Greater Than Sequential Prefix Sum',
    r: 'Sum the longest prefix where each element is the previous + 1. Then, using a set of nums, count up from that sum to the first missing value.',
    g: R => { const s = R.int(1, 5), k = R.int(1, 4), a = Array.from({ length: k }, (_, i) => s + i); return { nums: [...a, ...R.ints(R.int(0, 4), 1, 20)] }; },
    s(I, T) { let s = I.nums[0], i = 1; while (i < I.nums.length && I.nums[i] === I.nums[i - 1] + 1) s += I.nums[i++]; T.at({ nums: A(I.nums, { win: [0, i - 1] }) }); T.n('Sum of the sequential prefix?', s, 'Stop when the run breaks.'); const S = new Set(I.nums); while (S.has(s)) s++; return s; }
  });

  D('count-elements-with-maximum-frequency', {
    t: 'Count Elements With Maximum Frequency',
    r: 'Count values, find the max frequency, and add up the frequencies equal to it.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 5) }),
    s(I, T) { const c = cnt(I.nums), mx = Math.max(...c.values()); T.at({ counts: K(obj(c)) }); T.n('Maximum frequency?', mx, 'Highest count.'); return [...c.values()].filter(v => v === mx).reduce((a, b) => a + b, 0); }
  });

  D('find-the-maximum-number-of-elements-in-subset', {
    t: 'Find the Maximum Number of Elements in Subset',
    r: 'Pattern x, x², x⁴, …, x^k, …, x², x. For x = 1 take the largest odd count of ones. For x > 1, while count[x] ≥ 2 add 2 and square x; finish with +1 if the top exists, else −1.',
    g: R => ({ nums: Array.from({ length: R.int(1, 8) }, () => R.pick([1, 2, 4, 16, 3, 9, 5])) }),
    s(I, T) { const c = cnt(I.nums); const ones = c.get(1) || 0; let best = ones % 2 ? ones : Math.max(ones - 1, 0); T.at({ counts: K(obj(c)) }); T.n('Best length using only 1s?', best, 'Largest odd count.'); for (const x0 of c.keys()) { if (x0 === 1) continue; let x = x0, len = 0; while ((c.get(x) || 0) >= 2) { len += 2; x = x * x; } len += c.get(x) ? 1 : -1; best = Math.max(best, len); } return best; }
  });

  D('apply-operations-to-make-string-empty', {
    t: 'Apply Operations to Make String Empty',
    r: 'Each round removes one copy of every letter, so the last round removes exactly the letters with maximum frequency. They remain in the order of their last occurrences.',
    g: R => ({ s: R.str(R.int(1, 10), 'abc') }),
    s(I, T) { const c = cnt(I.s), mx = Math.max(...c.values()); T.at({ counts: K(obj(c)) }); T.n('Rounds needed (max frequency)?', mx, 'One copy per round.'); const seen = new Map(), out = []; [...I.s].forEach((ch, i) => { seen.set(ch, (seen.get(ch) || 0) + 1); if (seen.get(ch) === mx) out.push([i, ch]); }); return out.map(x => x[1]).join(''); }
  });

  D('split-the-array', {
    t: 'Split the Array',
    r: 'Each half must have distinct elements, so no value may appear more than twice.',
    g: R => ({ nums: R.ints(2 * R.int(1, 4), 1, 5) }),
    s(I, T) { const c = cnt(I.nums), mx = Math.max(...c.values()); T.at({ counts: K(obj(c)) }); T.n('Highest count?', mx, 'Must be ≤ 2.'); return mx <= 2; }
  });

  D('find-occurrences-of-an-element-in-an-array', {
    t: 'Find Occurrences of an Element in an Array',
    r: 'Record the indices where nums[i] = x. Query q returns the (q)-th index (1-based) or −1.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3), queries: R.ints(R.int(1, 4), 1, 5), x: R.int(1, 3) }),
    s(I, T) { const pos = []; I.nums.forEach((v, i) => v === I.x && pos.push(i)); T.at({ nums: A(I.nums), x: I.x }); T.n('How many occurrences?', pos.length, 'Index list length.'); return I.queries.map(q => q <= pos.length ? pos[q - 1] : -1); }
  });

  D('find-the-number-of-good-pairs-i', { t: 'Find the Number of Good Pairs I', ...goodPairs });
  D('find-the-number-of-good-pairs-ii', { t: 'Find the Number of Good Pairs II', ...goodPairs });
  D('count-pairs-that-form-a-complete-day-i', { t: 'Count Pairs That Form a Complete Day I', ...day });
  D('count-pairs-that-form-a-complete-day-ii', { t: 'Count Pairs That Form a Complete Day II', ...day });

  D('find-the-number-of-winning-players', {
    t: 'Find the Number of Winning Players',
    r: 'Count balls per (player, color). Player i wins if some color has more than i balls.',
    g: R => { const n = R.int(1, 4); return { n, pick: Array.from({ length: R.int(1, 8) }, () => [R.int(0, n - 1), R.int(0, 2)]) }; },
    s(I, T) { const c = {}; I.pick.forEach(([p, col]) => { const k = p + ':' + col; c[k] = (c[k] || 0) + 1; }); let w = 0; for (let p = 0; p < I.n; p++) { const best = Math.max(0, ...Object.entries(c).filter(([k]) => +k.split(':')[0] === p).map(([, v]) => v)); const ok = best > p; if (ok) w++; T.at({ player: p, counts: K(c) }); T.yn(`Does player ${p} win?`, ok, `Needs more than ${p} of one color.`); } return w; }
  });

  D('count-almost-equal-pairs-i', { t: 'Count Almost Equal Pairs I', ...almostEqual(1) });
  D('count-almost-equal-pairs-ii', { t: 'Count Almost Equal Pairs II', ...almostEqual(2) });

  D('identify-the-largest-outlier-in-an-array', {
    t: 'Identify the Largest Outlier in an Array',
    r: 'If x is the outlier, the rest sums to 2·s where s is the special-sum element: (total − x) must be even and (total − x)/2 must exist at another index (check counts). Take the largest valid x.',
    g: R => { const sp = R.ints(R.int(1, 4), -3, 5), s = sp.reduce((a, b) => a + b, 0); return { nums: R.shuffle([...sp, s, R.int(-5, 12)]) }; },
    s(I, T) { const c = cnt(I.nums), tot = I.nums.reduce((a, b) => a + b, 0); let best = -Infinity; for (const x of [...new Set(I.nums)].sort((a, b) => b - a)) { const r = tot - x, s = r / 2; const ok = r % 2 === 0 && c.has(s) && (s !== x || c.get(x) >= 2); if (ok) best = Math.max(best, x); T.at({ nums: A(I.nums), candidate: x }); T.yn(`Can ${x} be the outlier?`, ok, '(total − x)/2 must be another element.'); if (ok) break; } return best; }
  });

  D('minimum-operations-to-make-array-values-equal-to-k', {
    t: 'Minimum Operations to Make Array Values Equal to K',
    r: 'If any value is below k it is impossible. Otherwise each distinct value above k needs one operation (peel them from the top down).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 8), k: R.int(1, 5) }),
    s(I, T) { const mn = Math.min(...I.nums); T.at({ nums: A(I.nums), k: I.k }); T.yn('Is any value below k?', mn < I.k, 'Then −1.'); if (mn < I.k) return -1; return new Set(I.nums.filter(x => x > I.k)).size; }
  });

  D('minimum-number-of-operations-to-make-elements-in-array-distinct', {
    t: 'Minimum Number of Operations to Make Elements in Array Distinct',
    r: 'Scan from the right with a set; the first repeat found at index j means everything up to j must be removed: ⌊j / 3⌋ + 1 operations (0 if none).',
    g: R => ({ nums: R.ints(R.int(1, 10), 1, 6) }),
    s(I, T) { const S = new Set(); for (let j = I.nums.length - 1; j >= 0; j--) { const hit = S.has(I.nums[j]); if (I.nums.length - j <= 7) { T.at({ nums: A(I.nums, { i: j }), suffix: A([...S]) }); T.yn(`Is ${I.nums[j]} already in the suffix?`, hit, 'First repeat from the right.'); } if (hit) return Math.floor(j / 3) + 1; S.add(I.nums[j]); } return 0; }
  });

  D('minimum-unlocked-indices-to-sort-nums', {
    t: 'Minimum Unlocked Indices to Sort Nums',
    r: 'Values are 1..3 and only neighbors differing by 1 can swap, so a 3 before a 1 is hopeless (−1). Otherwise every index in [first 2, last 1) and [first 3, last 2) must be unlocked; count the locked ones there.',
    g: R => { const n = R.int(2, 7); return { nums: R.ints(n, 1, 3), locked: R.ints(n, 0, 1) }; },
    s(I, T) { const a = I.nums, n = a.length, f = v => a.indexOf(v), l = v => a.lastIndexOf(v); for (let i = 0; i < n; i++) if (a[i] === 3 && a.slice(i).includes(1)) { T.at({ nums: A(a, { i }) }); T.yn('Is there a 3 before a 1?', true, 'They can never cross.'); return -1; } T.at({ nums: A(a) }); T.yn('Is there a 3 before a 1?', false, 'Sorting is possible.'); const need = new Set(); if (f(2) >= 0 && l(1) >= 0) for (let i = f(2); i < l(1); i++) need.add(i); if (f(3) >= 0 && l(2) >= 0) for (let i = f(3); i < l(2); i++) need.add(i); const c = [...need].filter(i => I.locked[i]).length; T.at({ nums: A(a), locked: A(I.locked) }); T.n('Locked indices that must be unlocked?', c, 'Inside the crossing ranges.'); return c; }
  });

  D('assign-elements-to-groups-with-constraints', {
    t: 'Assign Elements to Groups with Constraints',
    r: 'Record each element value\'s smallest index. Sieve: for each value v (first occurrence), mark multiples of v up to max(groups) with index if unset or larger. Each group reads its mark (or −1).',
    g: R => ({ groups: R.ints(R.int(1, 6), 1, 12), elements: R.ints(R.int(1, 4), 1, 6) }),
    s(I, T) { return I.groups.map((g, i) => { let j = -1; for (let k = 0; k < I.elements.length; k++) if (g % I.elements[k] === 0) { j = k; break; } if (i < 5) { T.at({ group: g, elements: A(I.elements, j >= 0 ? { j } : {}) }); T.n(`Element index for group ${g} (−1 if none)?`, j, 'Smallest index whose value divides it.'); } return j; }); }
  });

  D('maximum-students-on-a-single-bench', {
    t: 'Maximum Students on a Single Bench',
    r: 'Map each bench to a set of student ids; return the largest set size (0 if empty).',
    g: R => ({ students: Array.from({ length: R.int(0, 7) }, () => [R.int(1, 4), R.int(1, 3)]) }),
    s(I, T) { const m = new Map(); I.students.forEach(([s, b]) => (m.get(b) || m.set(b, new Set()).get(b)).add(s)); let best = 0; for (const [b, S] of m) { best = Math.max(best, S.size); T.at({ bench: b, students: A([...S]) }); T.n('Distinct students on this bench?', S.size, 'Set size.'); } if (!m.size) { T.at({ students: '[]' }); T.n('Max?', 0, 'No students.'); } return best; }
  });

  D('transform-array-by-parity', {
    t: 'Transform Array by Parity',
    r: 'Replace evens with 0 and odds with 1, then sort: that is (#evens) zeros followed by (#odds) ones.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const e = I.nums.filter(x => x % 2 === 0).length; T.at({ nums: A(I.nums) }); T.n('How many zeros at the front?', e, 'Number of even values.'); return [...Array(e).fill(0), ...Array(I.nums.length - e).fill(1)]; }
  });

  D('find-the-largest-almost-missing-integer', {
    t: 'Find the Largest Almost Missing Integer',
    r: 'Count, for each value, how many size-k windows contain it (hash set per window). Values in exactly one window qualify; return the largest or −1. (Shortcut: only the ends matter unless k is 1 or n.)',
    g: R => { const a = R.ints(R.int(1, 7), 0, 9); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { const c = new Map(); for (let i = 0; i + I.k <= I.nums.length; i++) { const S = new Set(I.nums.slice(i, i + I.k)); S.forEach(v => c.set(v, (c.get(v) || 0) + 1)); } T.at({ windowsContaining: K(obj(c)) }); const ok = [...c].filter(([, k]) => k === 1).map(([v]) => v); T.n('How many values appear in exactly one window?', ok.length, 'Almost missing.'); return ok.length ? Math.max(...ok) : -1; }
  });
})();
