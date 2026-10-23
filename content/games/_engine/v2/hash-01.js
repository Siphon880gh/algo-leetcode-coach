/* v2 games: hashing & counting (01). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const cnt = a => { const m = new Map(); for (const x of a) m.set(x, (m.get(x) || 0) + 1); return m; };
  const obj = m => Object.fromEntries([...m].map(([k, v]) => [String(k), v]));

  D('first-missing-positive', {
    t: 'First Missing Positive',
    r: 'Cyclic placement: swap each value v in 1..n into slot v − 1 until it is there (or a duplicate). Then the first index i with nums[i] ≠ i + 1 gives i + 1; otherwise n + 1.',
    g: R => ({ nums: R.ints(R.int(1, 7), -2, 8) }),
    s(I, T) { const a = I.nums.slice(), n = a.length; for (let i = 0; i < n; i++) while (a[i] > 0 && a[i] <= n && a[a[i] - 1] !== a[i]) { const j = a[i] - 1; [a[i], a[j]] = [a[j], a[i]]; } T.at({ placed: A(a) }); T.n('How many slots i hold i + 1?', a.filter((v, i) => v === i + 1).length, 'After cyclic placement.'); for (let i = 0; i < n; i++) if (a[i] !== i + 1) { T.at({ placed: A(a, { i }) }); T.n('First missing positive?', i + 1, 'First slot without its value.'); return i + 1; } T.at({ placed: A(a) }); T.n('First missing positive?', n + 1, 'All 1..n present.'); return n + 1; }
  });

  D('longest-consecutive-sequence', {
    t: 'Longest Consecutive Sequence',
    r: 'Put all numbers in a set. Only start counting at x when x − 1 is absent; walk x + 1, x + 2, … while present. Each number is visited O(1) times.',
    g: R => ({ nums: R.ints(R.int(0, 9), 0, 12) }),
    s(I, T) { const S = new Set(I.nums); let best = 0, asks = 0; for (const x of S) { const start = !S.has(x - 1); if (asks++ < 7) { T.at({ set: A([...S].sort((a, b) => a - b)), x }); T.yn(`Does a run start at ${x}?`, start, `${x - 1} is ${start ? 'absent' : 'present'}.`); } if (start) { let y = x; while (S.has(y + 1)) y++; best = Math.max(best, y - x + 1); } } if (!S.size) { T.at({ nums: '[]' }); T.n('Longest run?', 0, 'Empty.'); } return best; }
  });

  D('contains-duplicate', {
    t: 'Contains Duplicate',
    r: 'Insert each number into a hash set; if it is already there, a duplicate exists.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const S = new Set(); for (const [i, x] of I.nums.entries()) { const hit = S.has(x); T.at({ nums: A(I.nums, { i }), seen: A([...S]) }); T.yn(`Seen ${x} before?`, hit, 'Set lookup.'); if (hit) return true; S.add(x); } return false; }
  });

  D('intersection-of-two-arrays', {
    t: 'Intersection of Two Arrays',
    r: 'Put nums1 in a set; scan nums2 and collect values found in the set (removing them so each is reported once).',
    g: R => ({ nums1: R.ints(R.int(1, 6), 1, 6), nums2: R.ints(R.int(1, 6), 1, 6) }),
    cmp: 'set',
    s(I, T) { const S = new Set(I.nums1), out = []; I.nums2.forEach((x, i) => { const hit = S.has(x); if (i < 6) { T.at({ nums2: A(I.nums2, { i }), set: A([...S]) }); T.yn(`Report ${x}?`, hit, 'In the set (and not yet reported).'); } if (hit) { out.push(x); S.delete(x); } }); return out; }
  });

  D('find-all-duplicates-in-an-array', {
    t: 'Find All Duplicates in an Array',
    r: 'Values are 1..n, so use the sign of nums[|x| − 1] as a seen flag: if it is already negative, x is a duplicate; otherwise negate it.',
    g: R => { const n = R.int(1, 8); const a = Array.from({ length: n }, () => R.int(1, n)); const c = cnt(a); for (const [v, k] of c) if (k > 2) { let extra = k - 2; for (let i = 0; i < n && extra; i++) if (a[i] === v) { a[i] = -1; extra--; } } const missing = [...Array(n).keys()].map(x => x + 1).filter(x => !a.includes(x)); return { nums: a.map(x => x === -1 ? missing.pop() : x) }; },
    cmp: 'set',
    s(I, T) { const a = I.nums.slice(), out = []; a.forEach((_, i) => { const x = Math.abs(a[i]), dup = a[x - 1] < 0; if (dup) out.push(x); else a[x - 1] *= -1; if (i < 7) { T.at({ nums: A(a.slice(), { i }) }); T.yn(`Is ${x} a duplicate?`, dup, `nums[${x - 1}] was already negative.`); } }); return out; }
  });

  D('find-all-numbers-disappeared-in-an-array', {
    t: 'Find All Numbers Disappeared in an Array',
    r: 'Mark presence by negating nums[|x| − 1]. Indices that stay positive give the missing numbers i + 1.',
    g: R => { const n = R.int(1, 8); return { nums: Array.from({ length: n }, () => R.int(1, n)) }; },
    cmp: 'set',
    s(I, T) { const a = I.nums.slice(); a.forEach((_, i) => { const x = Math.abs(a[i]); a[x - 1] = -Math.abs(a[x - 1]); }); T.at({ marked: A(a) }); const out = a.map((v, i) => v > 0 ? i + 1 : 0).filter(Boolean); T.n('How many numbers are missing?', out.length, 'Positive slots after marking.'); return out; }
  });

  D('4sum-ii', {
    t: '4Sum II',
    r: 'Meet in the middle: count all sums a + b from nums1 × nums2 in a map, then for each c + d add count[−(c + d)].',
    g: R => { const n = R.int(1, 3); return { nums1: R.ints(n, -2, 2), nums2: R.ints(n, -2, 2), nums3: R.ints(n, -2, 2), nums4: R.ints(n, -2, 2) }; },
    s(I, T) { const m = new Map(); for (const a of I.nums1) for (const b of I.nums2) m.set(a + b, (m.get(a + b) || 0) + 1); T.at({ pairSums: K(obj(m)) }); T.n('Distinct sums from nums1 + nums2?', m.size, 'Keys in the map.'); let t = 0, asks = 0; for (const c of I.nums3) for (const d of I.nums4) { const add = m.get(-(c + d)) || 0; t += add; if (asks++ < 5) { T.at({ c, d, need: -(c + d) }); T.n('Tuples completed by this pair?', add, 'Count of the needed sum.'); } } return t; }
  });

  D('longest-harmonious-subsequence', {
    t: 'Longest Harmonious Subsequence',
    r: 'Count values. For each x with x + 1 present, a harmonious subsequence takes all x\'s and all (x + 1)\'s: length count[x] + count[x + 1].',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 5) }),
    s(I, T) { const c = cnt(I.nums); let best = 0; for (const [x, k] of [...c].sort((a, b) => a[0] - b[0])) { const v = c.has(x + 1) ? k + c.get(x + 1) : 0; best = Math.max(best, v); T.at({ counts: K(obj(c)), x }); T.n(`Length using ${x} and ${x + 1} (0 if impossible)?`, v, 'Sum of both counts.'); } return best; }
  });

  D('degree-of-an-array', {
    t: 'Degree of an Array',
    r: 'Track count, first index and last index of each value. Among values with the max count, the answer is the smallest last − first + 1.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 4) }),
    s(I, T) { const c = new Map(), f = new Map(), l = new Map(); I.nums.forEach((x, i) => { c.set(x, (c.get(x) || 0) + 1); if (!f.has(x)) f.set(x, i); l.set(x, i); }); const deg = Math.max(...c.values()); T.at({ counts: K(obj(c)) }); T.n('Degree of the array?', deg, 'Max frequency.'); let best = Infinity; for (const [x, k] of c) if (k === deg) best = Math.min(best, l.get(x) - f.get(x) + 1); return best; }
  });

  D('find-anagram-mappings', {
    t: 'Find Anagram Mappings',
    r: 'Map each value of nums2 to an index (a list for duplicates); for each nums1 value, pop one of its indices.',
    g: R => { const a = R.ints(R.int(1, 6), 1, 9); return { nums1: a, nums2: R.shuffle(a.slice()) }; },
    cmp: (o, e, I) => Array.isArray(o) && o.length === I.nums1.length && new Set(o).size === o.length && o.every((j, i) => I.nums2[j] === I.nums1[i]),
    s(I, T) { const m = new Map(); I.nums2.forEach((v, j) => (m.get(v) || m.set(v, []).get(v)).push(j)); return I.nums1.map((v, i) => { const j = m.get(v).shift(); if (i < 6) { T.at({ nums1: A(I.nums1, { i }), nums2: A(I.nums2, { j }) }); T.n(`Index in nums2 for ${v}?`, j, 'Pop one stored index.'); } return j; }); }
  });

  D('card-flipping-game', {
    t: 'Card Flipping Game',
    r: 'A number on both sides of one card can never be hidden. Collect those in a set; the answer is the smallest number on any side not in the set (0 if none).',
    g: R => { const n = R.int(1, 5); return { fronts: R.ints(n, 1, 6), backs: R.ints(n, 1, 6) }; },
    s(I, T) { const bad = new Set(I.fronts.filter((f, i) => f === I.backs[i])); T.at({ fronts: A(I.fronts), backs: A(I.backs) }); T.n('How many numbers are blocked (same on both sides)?', bad.size, 'They always face up.'); const c = [...I.fronts, ...I.backs].filter(x => !bad.has(x)); return c.length ? Math.min(...c) : 0; }
  });

  D('n-repeated-element-in-size-2n-array', {
    t: 'N-Repeated Element in Size 2N Array',
    r: 'Only one value repeats, so the first value seen twice (hash set) is the answer.',
    g: R => { const n = R.int(2, 5), others = R.distinct(n, 1, 20), x = others.pop(); return { nums: R.shuffle([...others, ...Array(n).fill(x)]) }; },
    s(I, T) { const S = new Set(); for (const [i, x] of I.nums.entries()) { const hit = S.has(x); T.at({ nums: A(I.nums, { i }) }); T.yn(`Seen ${x} before?`, hit, 'The repeated one.'); if (hit) return x; S.add(x); } }
  });

  D('pairs-of-songs-with-total-durations-divisible-by-60', {
    t: 'Pairs of Songs With Total Durations Divisible by 60',
    r: 'Count remainders mod 60. Each song with remainder r pairs with earlier songs of remainder (60 − r) mod 60.',
    g: R => ({ time: Array.from({ length: R.int(1, 8) }, () => R.pick([20, 30, 40, 60, 90, 100, 150, 120])) }),
    s(I, T) { const c = Array(60).fill(0); let t = 0; I.time.forEach((x, i) => { const r = x % 60, need = (60 - r) % 60; t += c[need]; c[r]++; if (i < 8) { T.at({ time: A(I.time, { i }), remainder: r }); T.n('Pairs so far?', t, `Earlier songs with remainder ${need}.`); } }); return t; }
  });

  D('relative-sort-array', {
    t: 'Relative Sort Array',
    r: 'Count arr1 values. Emit arr2 values in order (each count times), then the remaining values in ascending order.',
    g: R => { const b = R.distinct(R.int(1, 4), 1, 9); return { arr1: [...R.shuffle([...b, ...b.filter(() => R.chance(0.5))]), ...R.ints(R.int(0, 3), 10, 15)], arr2: b }; },
    s(I, T) { const c = cnt(I.arr1), out = []; I.arr2.forEach(v => { T.at({ arr2: A(I.arr2), v, counts: K(obj(c)) }); T.n(`How many ${v}'s to emit?`, c.get(v) || 0, 'Its count in arr1.'); for (let k = 0; k < (c.get(v) || 0); k++) out.push(v); c.delete(v); }); return [...out, ...[...c].sort((a, b) => a[0] - b[0]).flatMap(([v, k]) => Array(k).fill(v))]; }
  });

  D('number-of-equivalent-domino-pairs', {
    t: 'Number of Equivalent Domino Pairs',
    r: 'Normalize each domino to (min, max) and count; each new domino pairs with all earlier equal ones.',
    g: R => ({ dominoes: Array.from({ length: R.int(1, 7) }, () => [R.int(1, 3), R.int(1, 3)]) }),
    s(I, T) { const c = {}; let t = 0; I.dominoes.forEach(([a, b], i) => { const k = Math.min(a, b) + ',' + Math.max(a, b); t += c[k] || 0; c[k] = (c[k] || 0) + 1; if (i < 7) { T.at({ domino: `${a}|${b}`, key: k, counts: K({ ...c }) }); T.n('Pairs so far?', t, 'Earlier dominoes with the same key.'); } }); return t; }
  });

  D('largest-unique-number', {
    t: 'Largest Unique Number',
    r: 'Count values; the answer is the largest value with count 1, or −1.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const c = cnt(I.nums); T.at({ counts: K(obj(c)) }); const u = [...c].filter(([, k]) => k === 1).map(([v]) => v); T.n('How many values appear exactly once?', u.length, 'Count 1.'); return u.length ? Math.max(...u) : -1; }
  });

  D('analyze-user-website-visit-pattern', {
    t: 'Analyze User Website Visit Pattern',
    r: 'Sort visits by time and group per user. For each user, collect the SET of 3-website patterns (ordered triples of their visits). Count users per pattern; return the most common, breaking ties lexicographically.',
    g: R => { const sites = ['a', 'b', 'c']; const users = ['u', 'v', 'w'].slice(0, R.int(1, 3)); const rows = []; users.forEach(u => { for (let k = 0; k < R.int(3, 4); k++) rows.push([u, R.pick(sites)]); }); const order = R.shuffle(rows.map((_, i) => i)); return { username: rows.map(r => r[0]), timestamp: order.map(x => x + 1), website: rows.map(r => r[1]) }; },
    s(I, T) { const idx = I.username.map((_, i) => i).sort((a, b) => I.timestamp[a] - I.timestamp[b]), per = {}; idx.forEach(i => (per[I.username[i]] = per[I.username[i]] || []).push(I.website[i])); const score = new Map(); for (const [u, w] of Object.entries(per)) { const S = new Set(); for (let a = 0; a < w.length; a++) for (let b = a + 1; b < w.length; b++) for (let c = b + 1; c < w.length; c++) S.add(JSON.stringify([w[a], w[b], w[c]])); S.forEach(p => score.set(p, (score.get(p) || 0) + 1)); T.at({ user: u, visits: A(w) }); T.n('Distinct patterns for this user?', S.size, 'Ordered triples, counted once per user.'); } let best = null; for (const [p, s] of score) { if (!best || s > score.get(best) || (s === score.get(best) && JSON.parse(p).join('\u0000') < JSON.parse(best).join('\u0000'))) best = p; } return JSON.parse(best); }
  });

  D('unique-number-of-occurrences', {
    t: 'Unique Number of Occurrences',
    r: 'Count each value, then check the counts are all distinct (put them in a set).',
    g: R => ({ arr: R.ints(R.int(1, 9), 1, 4) }),
    s(I, T) { const c = cnt(I.arr); T.at({ counts: K(obj(c)) }); T.n('How many distinct counts?', new Set(c.values()).size, 'Set of frequencies.'); return new Set(c.values()).size === c.size; }
  });

  D('maximum-equal-frequency', {
    t: 'Maximum Equal Frequency',
    r: 'Track count[x] and freqOfCount[c] as the prefix grows. A prefix works if all counts are 1, or one value has count 1 and the rest share a count, or one value has max count = others + 1, or only one value exists.',
    g: R => ({ nums: R.ints(R.int(2, 10), 1, 3) }),
    s(I, T) { const c = new Map(), f = new Map(); let best = 0; I.nums.forEach((x, i) => { const o = c.get(x) || 0; if (o) f.set(o, f.get(o) - 1); c.set(x, o + 1); f.set(o + 1, (f.get(o + 1) || 0) + 1); const len = i + 1, mx = Math.max(...c.values()); const ok = mx === 1 || f.get(mx) * mx === i || (f.get(mx - 1) || 0) * (mx - 1) + mx === len || c.size === 1; if (ok) best = len; if (i < 8) { T.at({ prefix: A(I.nums.slice(0, len)), counts: K(obj(c)) }); T.yn('Can removing one element equalize this prefix?', ok, 'Check the four frequency patterns.'); } }); return best; }
  });

  D('rank-transform-of-an-array', {
    t: 'Rank Transform of an Array',
    r: 'Sort the distinct values and map each to its 1-based position; replace every element by its rank.',
    g: R => ({ arr: R.ints(R.int(0, 8), -5, 9) }),
    s(I, T) { const u = [...new Set(I.arr)].sort((a, b) => a - b), r = new Map(u.map((v, i) => [v, i + 1])); I.arr.slice(0, 5).forEach((v, i) => { T.at({ distinctSorted: A(u), v }); T.n(`Rank of ${v}?`, r.get(v), 'Position among distinct values.'); }); if (!I.arr.length) { T.at({ arr: '[]' }); T.n('Ranks?', 0, 'Empty.'); } return I.arr.map(v => r.get(v)); }
  });

  D('check-if-n-and-its-double-exist', {
    t: 'Check If N and Its Double Exist',
    r: 'Scan with a set: for x, if 2x or x/2 (when even) was already seen, return true; otherwise add x.',
    g: R => ({ arr: R.ints(R.int(2, 7), -6, 10) }),
    s(I, T) { const S = new Set(); for (const [i, x] of I.arr.entries()) { const hit = S.has(2 * x) || (x % 2 === 0 && S.has(x / 2)); T.at({ arr: A(I.arr, { i }), seen: A([...S]) }); T.yn(`Does ${x} pair with something seen?`, hit, 'Look for 2x or x/2.'); if (hit) return true; S.add(x); } return false; }
  });

  D('rank-teams-by-votes', {
    t: 'Rank Teams by Votes',
    r: 'Count, for each team, how many votes place it at each position. Sort teams by those count vectors (descending, position 0 first), then alphabetically.',
    g: R => { const teams = R.shuffle(['A', 'B', 'C', 'D']).slice(0, R.int(1, 4)); return { votes: Array.from({ length: R.int(1, 4) }, () => R.shuffle(teams.slice()).join('')) }; },
    s(I, T) { const m = I.votes[0].length, c = {}; for (const t of I.votes[0]) c[t] = Array(m).fill(0); I.votes.forEach(v => [...v].forEach((t, p) => c[t][p]++)); const teams = Object.keys(c); T.at({ votes: A(I.votes) }); T.n(`First-place votes for ${teams[0]}?`, c[teams[0]][0], 'Count position 0.'); return teams.sort((a, b) => { for (let p = 0; p < m; p++) if (c[a][p] !== c[b][p]) return c[b][p] - c[a][p]; return a < b ? -1 : 1; }).join(''); }
  });

  D('find-lucky-integer-in-an-array', {
    t: 'Find Lucky Integer in an Array',
    r: 'Count values; a lucky integer has count equal to itself. Return the largest, or −1.',
    g: R => ({ arr: R.ints(R.int(1, 9), 1, 4) }),
    s(I, T) { const c = cnt(I.arr); let best = -1; for (const [v, k] of [...c].sort((a, b) => a[0] - b[0])) { T.at({ counts: K(obj(c)), v }); T.yn(`Is ${v} lucky?`, v === k, `Count ${k}.`); if (v === k) best = Math.max(best, v); } return best; }
  });

  D('count-number-of-teams', {
    t: 'Count Number of Teams',
    r: 'For each middle soldier j, count smaller/larger ratings on the left and right. Teams through j = leftLess·rightMore + leftMore·rightLess.',
    g: R => ({ rating: R.distinct(R.int(3, 8), 1, 20) }),
    s(I, T) { const a = I.rating; let t = 0; for (let j = 1; j < a.length - 1; j++) { let ll = 0, lm = 0, rl = 0, rm = 0; for (let i = 0; i < j; i++) a[i] < a[j] ? ll++ : lm++; for (let k = j + 1; k < a.length; k++) a[k] < a[j] ? rl++ : rm++; const here = ll * rm + lm * rl; t += here; if (j < 6) { T.at({ rating: A(a, { j }), counts: K({ leftLess: ll, leftMore: lm, rightLess: rl, rightMore: rm }) }); T.n('Teams with this soldier in the middle?', here, 'll·rm + lm·rl.'); } } return t; }
  });

  D('display-table-of-food-orders-in-a-restaurant', {
    t: 'Display Table of Food Orders in a Restaurant',
    r: 'Build a map table → food → count and a set of foods. Header = "Table" + foods sorted; rows sorted numerically by table, each with counts as strings.',
    g: R => ({ orders: Array.from({ length: R.int(1, 6) }, () => [R.pick(['Ann', 'Bo', 'Cy']), String(R.int(1, 12)), R.pick(['Soda', 'Taco', 'Pie'])]) }),
    s(I, T) { const foods = [...new Set(I.orders.map(o => o[2]))].sort(), tbl = {}; I.orders.forEach(([, t, f]) => { tbl[t] = tbl[t] || {}; tbl[t][f] = (tbl[t][f] || 0) + 1; }); T.at({ orders: A(I.orders.map(o => `${o[1]}:${o[2]}`)) }); T.n('How many food columns?', foods.length, 'Distinct foods.'); T.n('How many table rows?', Object.keys(tbl).length, 'Distinct tables.'); return [['Table', ...foods], ...Object.keys(tbl).sort((a, b) => a - b).map(t => [t, ...foods.map(f => String(tbl[t][f] || 0))])]; }
  });

  D('counting-elements', {
    t: 'Counting Elements',
    r: 'Put all values in a set; count elements x (with duplicates) for which x + 1 is in the set.',
    g: R => ({ arr: R.ints(R.int(1, 8), 0, 5) }),
    s(I, T) { const S = new Set(I.arr); let c = 0; I.arr.forEach((x, i) => { const ok = S.has(x + 1); if (ok) c++; if (i < 7) { T.at({ arr: A(I.arr, { i }) }); T.yn(`Is ${x + 1} present?`, ok, 'Set lookup.'); } }); return c; }
  });

  D('make-two-arrays-equal-by-reversing-subarrays', {
    t: 'Make Two Arrays Equal by Reversing Subarrays',
    r: 'Reversals of length 2 are swaps, so any permutation is reachable: just compare value counts.',
    g: R => { const a = R.ints(R.int(1, 6), 1, 5); return { target: a, arr: R.chance(0.6) ? R.shuffle(a.slice()) : R.ints(a.length, 1, 5) }; },
    s(I, T) { const c = cnt(I.target); for (const x of I.arr) c.set(x, (c.get(x) || 0) - 1); const ok = [...c.values()].every(v => v === 0); T.at({ target: A(I.target), arr: A(I.arr) }); T.yn('Same multiset of values?', ok, 'Then swaps can arrange it.'); return ok; }
  });

  D('arithmetic-subarrays', {
    t: 'Arithmetic Subarrays',
    r: 'For each query take min and max: d = (max − min)/(len − 1) must be an integer, and every min + k·d must appear exactly once (hash set), unless d = 0 (all equal).',
    g: R => { const a = R.ints(R.int(2, 7), 1, 9), m = R.int(1, 3), l = [], r = []; for (let q = 0; q < m; q++) { const x = R.int(0, a.length - 2); l.push(x); r.push(R.int(x + 1, a.length - 1)); } return { nums: a, l, r }; },
    s(I, T) { return I.l.map((lo, q) => { const w = I.nums.slice(lo, I.r[q] + 1).sort((a, b) => a - b); let ok = true; for (let i = 2; i < w.length; i++) if (w[i] - w[i - 1] !== w[1] - w[0]) ok = false; if (q < 4) { T.at({ nums: A(I.nums, { win: [lo, I.r[q]] }), sorted: A(w) }); T.yn('Can it be rearranged into an arithmetic sequence?', ok, 'Equal gaps when sorted.'); } return ok; }); }
  });

  D('sort-array-by-increasing-frequency', {
    t: 'Sort Array by Increasing Frequency',
    r: 'Count values; sort by frequency ascending, and for equal frequency by value descending.',
    g: R => ({ nums: R.ints(R.int(1, 8), -3, 4) }),
    s(I, T) { const c = cnt(I.nums); T.at({ counts: K(obj(c)) }); T.n('Smallest frequency?', Math.min(...c.values()), 'Those values come first.'); return I.nums.slice().sort((a, b) => c.get(a) - c.get(b) || b - a); }
  });

  D('check-array-formation-through-concatenation', {
    t: 'Check Array Formation Through Concatenation',
    r: 'Map each piece\'s first value to the piece. Walk arr: look up the piece starting with arr[i], verify it matches element by element, and jump past it.',
    g: R => { const v = R.shuffle([...Array(8).keys()].map(x => x + 1)).slice(0, R.int(1, 6)), pieces = []; let i = 0; while (i < v.length) { const k = R.int(1, 2); pieces.push(v.slice(i, i + k)); i += k; } const arr = R.chance(0.7) ? R.shuffle(pieces.slice()).flat() : R.shuffle(v.slice()); return { arr, pieces: R.shuffle(pieces) }; },
    s(I, T) { const m = new Map(I.pieces.map(p => [p[0], p])); let i = 0; while (i < I.arr.length) { const p = m.get(I.arr[i]); const ok = !!p && p.every((x, k) => I.arr[i + k] === x); T.at({ arr: A(I.arr, { i }), piece: p ? A(p) : 'none' }); T.yn('Does a piece match here?', ok, 'Look up by first value, then compare.'); if (!ok) return false; i += p.length; } return true; }
  });

  D('count-good-meals', {
    t: 'Count Good Meals',
    r: 'For each dish x, check all 22 powers of two p: add count[p − x] of earlier dishes. Then record x. Answer mod 1e9+7.',
    g: R => ({ deliciousness: R.ints(R.int(1, 8), 0, 9) }),
    s(I, T) { const c = new Map(); let t = 0; I.deliciousness.forEach((x, i) => { let add = 0; for (let p = 1; p <= 1 << 21; p <<= 1) add += c.get(p - x) || 0; t += add; c.set(x, (c.get(x) || 0) + 1); if (i < 7) { T.at({ dishes: A(I.deliciousness, { i }) }); T.n('Good meals pairing this dish with earlier ones?', add, 'Partners p − x for each power of two.'); } }); return t % 1000000007; }
  });

  D('number-of-rectangles-that-can-form-the-largest-square', {
    t: 'Number Of Rectangles That Can Form The Largest Square',
    r: 'Each rectangle gives a square of side min(l, w). Track the largest side and how many reach it.',
    g: R => ({ rectangles: Array.from({ length: R.int(1, 6) }, () => [R.int(1, 6), R.int(1, 6)]) }),
    s(I, T) { let mx = 0, c = 0; I.rectangles.forEach(([l, w], i) => { const s = Math.min(l, w); if (s > mx) { mx = s; c = 1; } else if (s === mx) c++; if (i < 6) { T.at({ rect: `${l}×${w}`, best: mx }); T.n('Square side from this rectangle?', s, 'min(l, w).'); } }); return c; }
  });

  D('restore-the-array-from-adjacent-pairs', {
    t: 'Restore the Array From Adjacent Pairs',
    r: 'Build an adjacency map. An end of the array has only one neighbor; start there and repeatedly step to the neighbor that is not the previous element.',
    g: R => { const a = R.distinct(R.int(2, 7), -9, 9); return { adjacentPairs: R.shuffle(a.slice(1).map((x, i) => R.chance(0.5) ? [a[i], x] : [x, a[i]])) }; },
    cmp: (o, e) => JSON.stringify(o) === JSON.stringify(e) || JSON.stringify(o) === JSON.stringify(e.slice().reverse()),
    s(I, T) { const adj = new Map(); I.adjacentPairs.forEach(([a, b]) => { (adj.get(a) || adj.set(a, []).get(a)).push(b); (adj.get(b) || adj.set(b, []).get(b)).push(a); }); const start = [...adj].find(([, v]) => v.length === 1)[0], out = [start]; T.at({ adjacency: K(Object.fromEntries([...adj].map(([k, v]) => [k, v.join(',')]))) }); T.n('An end of the array (a value with one neighbor)?', start, 'Exactly two values have degree 1; we take the first found.'); while (out.length < adj.size) { const cur = out[out.length - 1], prev = out[out.length - 2]; out.push(adj.get(cur).find(x => x !== prev)); } return out; }
  });

  D('sum-of-unique-elements', {
    t: 'Sum of Unique Elements',
    r: 'Count values and add the ones with count 1.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6) }),
    s(I, T) { const c = cnt(I.nums); T.at({ counts: K(obj(c)) }); const u = [...c].filter(([, k]) => k === 1); T.n('How many unique values?', u.length, 'Count exactly 1.'); return u.reduce((s, [v]) => s + v, 0); }
  });

  D('finding-the-users-active-minutes', {
    t: 'Finding the Users Active Minutes',
    r: 'Map each user to a set of minutes. A user\'s UAM is its set size; answer[j − 1] counts users with UAM = j.',
    g: R => ({ logs: Array.from({ length: R.int(1, 7) }, () => [R.int(0, 2), R.int(1, 4)]), k: 4 }),
    s(I, T) { const m = new Map(); I.logs.forEach(([u, t]) => (m.get(u) || m.set(u, new Set()).get(u)).add(t)); const out = Array(I.k).fill(0); for (const [u, S] of m) { out[S.size - 1]++; T.at({ user: u, minutes: A([...S]) }); T.n('UAM of this user?', S.size, 'Distinct minutes.'); } return out; }
  });

  D('longest-common-subsequence-between-sorted-arrays', {
    t: 'Longest Common Subsequence Between Sorted Arrays',
    r: 'Each array is strictly increasing, so a value is common iff it appears in all arrays. Count occurrences across arrays; output values with count = number of arrays, in order.',
    g: R => ({ arrays: Array.from({ length: R.int(2, 3) }, () => R.distinct(R.int(1, 6), 1, 9).sort((a, b) => a - b)) }),
    s(I, T) { const c = cnt(I.arrays.flat()); T.at({ counts: K(obj(c)), arrays: I.arrays.length }); const out = [...c].filter(([, k]) => k === I.arrays.length).map(([v]) => v).sort((a, b) => a - b); T.n('How many values are in every array?', out.length, 'Count equals the number of arrays.'); return out; }
  });

  D('count-special-quadruplets', {
    t: 'Count Special Quadruplets',
    r: 'a + b + c = d with a < b < c < d. Iterate c from the right keeping counts of d − c for indices beyond c, then for each pair a < b < c add count[a + b].',
    g: R => ({ nums: R.ints(R.int(4, 8), 1, 9) }),
    s(I, T) { const a = I.nums, n = a.length; let t = 0; for (let c = n - 2; c >= 2; c--) { let here = 0; for (let x = 0; x < c; x++) for (let y = x + 1; y < c; y++) for (let d = c + 1; d < n; d++) if (a[x] + a[y] + a[c] === a[d]) here++; t += here; T.at({ nums: A(a, { i: c }) }); T.n('Quadruplets with c at this index?', here, 'Match d − c against a + b.'); } return t; }
  });

  D('count-number-of-pairs-with-absolute-difference-k', {
    t: 'Count Number of Pairs With Absolute Difference K',
    r: 'Scan with a counter: each x pairs with earlier x − k and x + k.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 5), k: R.int(1, 3) }),
    s(I, T) { const c = new Map(); let t = 0; I.nums.forEach((x, i) => { const add = (c.get(x - I.k) || 0) + (c.get(x + I.k) || 0); t += add; c.set(x, (c.get(x) || 0) + 1); if (i < 7) { T.at({ nums: A(I.nums, { i }) }); T.n('Pairs so far?', t, `Earlier ${x - I.k} and ${x + I.k}.`); } }); return t; }
  });

  D('find-target-indices-after-sorting-array', {
    t: 'Find Target Indices After Sorting Array',
    r: 'No sort needed: let less = #values < target and eq = #values = target. The indices are less, less + 1, …, less + eq − 1.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 5), target: R.int(1, 5) }),
    s(I, T) { const less = I.nums.filter(x => x < I.target).length, eq = I.nums.filter(x => x === I.target).length; T.at({ nums: A(I.nums), target: I.target }); T.n('Values smaller than target?', less, 'First index of target after sorting.'); T.n('Copies of target?', eq, 'Length of the index run.'); return Array.from({ length: eq }, (_, i) => less + i); }
  });

  D('finding-3-digit-even-numbers', {
    t: 'Finding 3-Digit Even Numbers',
    r: 'Count available digits. For each even number 100..998, check its digits fit within the counts; collect in increasing order.',
    g: R => ({ digits: R.ints(R.int(3, 6), 0, 5) }),
    s(I, T) { const c = Array(10).fill(0); I.digits.forEach(d => c[d]++); const out = []; for (let x = 100; x < 1000; x += 2) { const need = Array(10).fill(0); String(x).split('').forEach(d => need[+d]++); if (need.every((k, d) => k <= c[d])) out.push(x); } T.at({ digitCounts: A(c) }); T.n('How many valid numbers?', out.length, 'Even, no leading zero, digits available.'); return out; }
  });

  D('count-elements-with-strictly-smaller-and-greater-elements', {
    t: 'Count Elements With Strictly Smaller and Greater Elements',
    r: 'Only the minimum and maximum values fail. Count elements strictly between min and max.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6) }),
    s(I, T) { const mn = Math.min(...I.nums), mx = Math.max(...I.nums); T.at({ nums: A(I.nums), min: mn, max: mx }); T.n('How many equal the min or max?', I.nums.filter(x => x === mn || x === mx).length, 'These fail.'); return I.nums.filter(x => x > mn && x < mx).length; }
  });

  D('find-all-lonely-numbers-in-the-array', {
    t: 'Find All Lonely Numbers in the Array',
    r: 'Count values. x is lonely if count[x] = 1 and neither x − 1 nor x + 1 appears.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 12) }),
    cmp: 'set',
    s(I, T) { const c = cnt(I.nums), out = []; for (const [x, k] of [...c].sort((a, b) => a[0] - b[0]).slice(0, 7)) { const ok = k === 1 && !c.has(x - 1) && !c.has(x + 1); T.at({ counts: K(obj(c)), x }); T.yn(`Is ${x} lonely?`, ok, 'Once, with no neighbors.'); } for (const [x, k] of c) if (k === 1 && !c.has(x - 1) && !c.has(x + 1)) out.push(x); return out; }
  });

  D('most-frequent-number-following-key-in-an-array', {
    t: 'Most Frequent Number Following Key In an Array',
    r: 'Count nums[i + 1] whenever nums[i] = key; return the target with the highest count (unique by guarantee).',
    g: R => { for (;;) { const key = R.int(1, 3), a = R.ints(R.int(2, 9), 1, 4); a[R.int(0, a.length - 2)] = key; const c = {}; for (let i = 0; i + 1 < a.length; i++) if (a[i] === key) c[a[i + 1]] = (c[a[i + 1]] || 0) + 1; const v = Object.values(c), m = Math.max(...v); if (v.filter(x => x === m).length === 1) return { nums: a, key }; } },
    s(I, T) { const c = new Map(); for (let i = 0; i + 1 < I.nums.length; i++) if (I.nums[i] === I.key) c.set(I.nums[i + 1], (c.get(I.nums[i + 1]) || 0) + 1); T.at({ nums: A(I.nums), key: I.key, followers: K(obj(c)) }); const best = Math.max(...c.values()); T.n('Highest follower count?', best, 'Count numbers right after key.'); return [...c].find(([, k]) => k === best)[0]; }
  });

  D('find-the-difference-of-two-arrays', {
    t: 'Find the Difference of Two Arrays',
    r: 'Build sets of both arrays; answer[0] = distinct values only in nums1, answer[1] = only in nums2.',
    g: R => ({ nums1: R.ints(R.int(1, 6), 1, 6), nums2: R.ints(R.int(1, 6), 1, 6) }),
    cmp: (o, e) => Array.isArray(o) && o.length === 2 && o.every((x, i) => JSON.stringify(x.slice().sort((a, b) => a - b)) === JSON.stringify(e[i].slice().sort((a, b) => a - b))),
    s(I, T) { const A1 = new Set(I.nums1), B = new Set(I.nums2), x = [...A1].filter(v => !B.has(v)), y = [...B].filter(v => !A1.has(v)); T.at({ set1: A([...A1]), set2: A([...B]) }); T.n('Values only in nums1?', x.length, 'Set difference.'); T.n('Values only in nums2?', y.length, 'Set difference.'); return [x, y]; }
  });

  D('find-players-with-zero-or-one-losses', {
    t: 'Find Players With Zero or One Losses',
    r: 'Count losses per player (and note everyone who played). Players with 0 losses and with exactly 1 loss, each list sorted.',
    g: R => ({ matches: (() => { const m = [], seen = new Set(); for (let i = 0; i < R.int(1, 6); i++) { const w = R.int(1, 6); let l = R.int(1, 6); if (l === w) l = (w % 6) + 1; const k = w + ',' + l; if (!seen.has(k)) { seen.add(k); m.push([w, l]); } } return m; })() }),
    s(I, T) { const loss = new Map(); I.matches.forEach(([w, l]) => { if (!loss.has(w)) loss.set(w, 0); loss.set(l, (loss.get(l) || 0) + 1); }); T.at({ losses: K(obj(loss)) }); const z = [...loss].filter(([, k]) => k === 0).map(([p]) => p).sort((a, b) => a - b), o = [...loss].filter(([, k]) => k === 1).map(([p]) => p).sort((a, b) => a - b); T.n('Players who never lost?', z.length, 'Loss count 0.'); return [z, o]; }
  });
})();
