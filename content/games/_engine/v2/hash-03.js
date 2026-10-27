/* v2 games: hash (03). Guides scored in the 3483–4041 pass. */
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

  D('count-covered-buildings', {
    t: 'Count Covered Buildings',
    r: 'For each x keep the min and max y, and for each y keep the min and max x. A building is covered when it is strictly inside both ranges: someone is left and right of it in its row, and above and below it in its column.',
    g: R => { const n = R.int(3, 5), all = []; for (let x = 1; x <= n; x++) for (let y = 1; y <= n; y++) all.push([x, y]); return { n, buildings: R.shuffle(all).slice(0, R.int(4, Math.min(10, n * n))) }; },
    s(I, T) { const bx = new Map(), by = new Map(); I.buildings.forEach(([x, y]) => { const a = bx.get(x) || [y, y]; bx.set(x, [Math.min(a[0], y), Math.max(a[1], y)]); const b = by.get(y) || [x, x]; by.set(y, [Math.min(b[0], x), Math.max(b[1], x)]); }); const g = Array.from({ length: I.n }, () => Array(I.n).fill('·')); I.buildings.forEach(([x, y]) => g[x - 1][y - 1] = '■'); let c = 0; I.buildings.forEach(([x, y]) => { const a = bx.get(x), b = by.get(y), ok = a[0] < y && y < a[1] && b[0] < x && x < b[1]; if (ok) c++; if (T.room()) { T.at({ city: G(g, { hl: [[x - 1, y - 1]] }), ['y range at x=' + x]: a.join('..'), ['x range at y=' + y]: b.join('..') }); T.yn(`Is building [${x},${y}] covered?`, ok, ok ? 'Strictly inside both ranges.' : 'It is an end of its row range or its column range.'); } }); return c; }
  });

  D('maximize-ysum-by-picking-a-triplet-of-distinct-xvalues', {
    t: 'Maximize Y‑Sum by Picking a Triplet of Distinct X‑Values',
    r: 'Only the best y for each x value can matter. Keep max y per x in a hash map, then add the three largest maxima (−1 if fewer than three distinct x).',
    g: R => { const n = R.int(3, 7); return { x: R.ints(n, 1, 4), y: R.ints(n, 1, 9) }; },
    s(I, T) { const best = new Map(); I.x.forEach((x, i) => { const y = I.y[i]; const old = best.get(x); if (old === undefined || y > old) best.set(x, y); if (i < 6) { T.at({ x: A(I.x, { i }), y: A(I.y, { i }), bestY: K([...best].map(([k, v]) => ['x=' + k, v])) }); T.n(`Best y stored for x = ${x} after index ${i}?`, best.get(x), 'Keep the larger y.'); } }); if (best.size < 3) return -1; return sum([...best.values()].sort((a, b) => b - a).slice(0, 3)); }
  });

  D('count-odd-letters-from-number', {
    t: 'Count Odd Letters from Number',
    r: 'Spell each digit as a word and join them. Count each letter, then count the distinct letters whose total is odd.',
    g: R => ({ n: R.int(1, 9999) }),
    s(I, T) { const W = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'], s = String(I.n).split('').map(d => W[+d]).join(''), c = {}; for (const ch of s) c[ch] = (c[ch] || 0) + 1; const keys = Object.keys(c).sort(); keys.slice(0, 3).forEach(k => { T.at({ s: A(s.split(''), { hl: s.split('').map((x, i) => x === k ? i : -1).filter(i => i >= 0) }) }); T.n(`How many times does "${k}" appear?`, c[k], 'Count it in the spelled string.'); }); const odd = keys.filter(k => c[k] % 2).length; T.at({ counts: K(c) }); T.n('Distinct letters with an odd count?', odd, 'Check each count\'s parity.'); return odd; }
  });

  D('count-special-triplets', {
    t: 'Count Special Triplets',
    r: 'Fix the middle j. The triplets through j are (count of 2 times nums[j] to its left) times (count of 2 times nums[j] to its right). Keep two hash maps and move j left to right.',
    g: R => ({ nums: Array.from({ length: R.int(3, 8) }, () => R.pick([0, 1, 2, 2, 4, 4, 8, 3, 6])) }),
    s(I, T) { const a = I.nums, L = new Map(), Rm = new Map(); a.forEach(x => Rm.set(x, (Rm.get(x) || 0) + 1)); let tot = 0; a.forEach((x, j) => { Rm.set(x, Rm.get(x) - 1); const t = x * 2, c = (L.get(t) || 0) * (Rm.get(t) || 0); tot = (tot + c) % MOD; if (j < 6) { T.at({ nums: A(a, { j }), left: K([...L].map(([k, v]) => [k, v])), right: K([...Rm].filter(e => e[1]).map(([k, v]) => [k, v])) }); T.n(`Triplets with middle index ${j}?`, c, `left[${t}] times right[${t}].`); } L.set(x, (L.get(x) || 0) + 1); }); return tot; }
  });

  D('check-if-any-element-has-prime-frequency', {
    t: 'Check if Any Element Has Prime Frequency',
    r: 'Count every value in a hash map, then test each count for primality (2, 3, 5, …). One prime count is enough.',
    g: R => ({ nums: R.ints(R.int(2, 9), 1, 4) }),
    s(I, T) { const c = new Map(); I.nums.forEach(x => c.set(x, (c.get(x) || 0) + 1)); let ok = false; for (const [v, f] of [...c].sort((a, b) => a[0] - b[0])) { T.at({ nums: A(I.nums, { hl: I.nums.map((x, i) => x === v ? i : -1).filter(i => i >= 0) }) }); T.n(`Frequency of ${v}?`, f, 'Count its occurrences.'); T.yn(`Is ${f} prime?`, isPrime(f), f < 2 ? '1 is not prime.' : isPrime(f) ? 'Only 1 and itself divide it.' : `${f} is composite.`); if (isPrime(f)) { ok = true; break; } } return ok; }
  });

  D('threshold-majority-queries', {
    t: 'Threshold Majority Queries',
    r: 'For each query count values in nums[l to r] (Mo\'s algorithm or square-root splitting keeps counts incrementally). Return the most frequent value, smallest on ties, if its count reaches the threshold; otherwise −1.',
    g: R => { const n = R.int(3, 7); return { nums: R.ints(n, 1, 3), queries: Array.from({ length: R.int(2, 3) }, () => { const l = R.int(0, n - 1), r = R.int(l, n - 1); return [l, r, R.int(1, r - l + 1)]; }) }; },
    s(I, T) { return I.queries.map(([l, r, th]) => { const c = new Map(); for (let i = l; i <= r; i++) c.set(I.nums[i], (c.get(I.nums[i]) || 0) + 1); let bv = -1, bc = 0; for (const [v, f] of c) if (f > bc || (f === bc && v < bv)) { bv = v; bc = f; } const ans = bc >= th ? bv : -1; T.at({ nums: A(I.nums, { win: [l, r] }), counts: K([...c].sort((a, b) => a[0] - b[0])), threshold: th }); T.n(`Answer for [${l}, ${r}] with threshold ${th}?`, ans, bc >= th ? 'Most frequent (smallest on ties) meets the threshold.' : `Top count ${bc} < ${th}.`); return ans; }); }
  });

  D('partition-array-into-k-distinct-groups', {
    t: 'Partition Array into K Distinct Groups',
    r: 'The array must split into g = n divided by k groups (n divisible by k), and a value can appear at most once per group, so every frequency must be at most g. Dealing values round-robin then always works.',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 4), k: R.int(1, 4) }),
    s(I, T) { const res = (() => { const n = I.nums.length; T.at({ nums: A(I.nums), k: I.k }); T.n('Distinct values?', new Set(I.nums).size, 'Each group needs k different values.'); T.yn('Is n divisible by k?', n % I.k === 0, `${n} divided by ${I.k} leaves ${n % I.k}.`); if (n % I.k) return false; const c = new Map(); I.nums.forEach(x => c.set(x, (c.get(x) || 0) + 1)); const mx = Math.max(...c.values()), g = n / I.k; T.at({ counts: K([...c].sort((a, b) => a[0] - b[0])), groups: g }); T.n('Highest frequency of any value?', mx, 'Count each value.'); return mx <= g; })(); T.yn('Can it be partitioned?', res, 'No value appears more often than there are groups.'); return res; }
  });

  D('filter-characters-by-frequency', {
    t: 'Filter Characters by Frequency',
    r: 'Count every character first, then rebuild the string keeping only characters whose total count is below k, in their original order.',
    g: R => ({ s: R.str(R.int(3, 10), 'abcd'), k: R.int(1, 4) }),
    s(I, T) { const c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; Object.keys(c).sort().forEach(ch => { T.at({ s: A(I.s.split('')), counts: K(c), k: I.k }); T.yn(`Keep every "${ch}"?`, c[ch] < I.k, `It appears ${c[ch]} times; keep only if fewer than ${I.k}.`); }); return I.s.split('').filter(ch => c[ch] < I.k).join(''); }
  });

  D('find-the-least-frequent-digit', {
    t: 'Find the Least Frequent Digit',
    r: 'Count the digits of n in a 10-slot table, then scan digits 0 to 9 that actually appear and keep the one with the smallest count (smaller digit on ties).',
    g: R => ({ n: R.int(10, 9999999) }),
    s(I, T) { const c = Array(10).fill(0); String(I.n).split('').forEach(d => c[+d]++); const present = range(0, 10).filter(d => c[d]); present.slice(0, 3).forEach(d => { T.at({ n: String(I.n) }); T.n(`How many times does digit ${d} appear?`, c[d], 'Count it.'); }); let best = present[0]; present.forEach(d => { if (c[d] < c[best]) best = d; }); T.at({ counts: K(present.map(d => [d, c[d]])) }); T.c('Least frequent digit?', present, best, 'Smallest count; smaller digit on ties.'); return best; }
  });

  D('two-letter-card-game', {
    t: 'Two Letter Card Game',
    r: 'Cards with x split into "x?" (left group), "?x" (right group) and "xx". Within a group two cards pair if their other letters differ; "xx" acts as one more letter in either group. A group of t cards with largest letter count m makes the smaller of half of t (rounded down) and t minus m pairs; try every split of the "xx" cards.',
    g: R => ({ cards: Array.from({ length: R.int(2, 7) }, () => R.pick('abc') + R.pick('abc')), x: R.pick('ab') }),
    s(I, T) { const res = (() => { const x = I.x, L = {}, Rr = {}; let xx = 0; I.cards.forEach(c => { if (c === x + x) xx++; else if (c[0] === x) L[c[1]] = (L[c[1]] || 0) + 1; else if (c[1] === x) Rr[c[0]] = (Rr[c[0]] || 0) + 1; }); const pairs = (g, e) => { const v = Object.values(g); if (e) v.push(e); const t = sum(v), m = v.length ? Math.max(...v) : 0; return Math.min(Math.floor(t / 2), t - m); }; T.at({ cards: A(I.cards), x }); T.n(`How many cards are "${x}${x}"?`, xx, 'They pair with any single-x card.'); T.n(`Pairs inside the "${x}?" group alone?`, pairs(L, 0), 'The smaller of half of t, rounded down, and t minus the largest letter count.'); let best = 0; for (let j = 0; j <= xx; j++) best = Math.max(best, pairs(L, j) + pairs(Rr, xx - j)); return best; })(); T.n('Most pairs?', res, 'Best split of the double cards between the two groups.'); return res; }
  });

  D('restore-finishing-order', {
    t: 'Restore Finishing Order',
    r: 'Put the friends in a hash set, then walk the finishing order and keep each ID that is in the set.',
    g: R => { const n = R.int(3, 8), order = R.perm(n, 1); return { order, friends: R.shuffle(range(1, n + 1)).slice(0, R.int(1, Math.min(4, n))).sort((a, b) => a - b) }; },
    s(I, T) { const f = new Set(I.friends), out = []; I.order.forEach((id, i) => { if (i < 7) { T.at({ order: A(I.order, { i }), friends: A(I.friends), result: A(out.slice()) }); T.yn(`Keep ID ${id}?`, f.has(id), f.has(id) ? 'A friend: append in finishing order.' : 'Not a friend.'); } if (f.has(id)) out.push(id); }); return out; }
  });

  D('smallest-absent-positive-greater-than-average', {
    t: 'Smallest Absent Positive Greater Than Average',
    r: 'Compute the average, start at the first positive integer strictly above it (at least 1), and step up until you find a value not in the set of nums.',
    g: R => ({ nums: R.ints(R.int(2, 6), -5, 8) }),
    s(I, T) { const res = (() => { const avg = sum(I.nums) / I.nums.length, set = new Set(I.nums); let x = Math.max(1, Math.floor(avg) + 1); T.at({ nums: A(I.nums), sum: sum(I.nums), n: I.nums.length }); T.n('First candidate (smallest positive integer above the average)?', x, `Average = ${Math.round(avg * 100) / 100}.`); while (set.has(x)) { T.at({ nums: A(I.nums, { hl: I.nums.map((v, i) => v === x ? i : -1).filter(i => i >= 0) }), candidate: x }); T.yn(`Is ${x} absent?`, false, `${x} is in nums, try ${x + 1}.`); x++; } return x; })(); T.n('Answer?', res, 'The first candidate missing from nums.'); return res; }
  });

  D('minimum-index-sum-of-common-elements', {
    t: 'Minimum Index Sum of Common Elements',
    r: 'Store the first index of every value in nums2. Then for each i in nums1, if the value is there, i + that first index is a candidate; keep the minimum.',
    g: R => { const n = R.int(2, 6); return { nums1: R.ints(n, 1, 5), nums2: R.ints(n, 1, 5) }; },
    s(I, T) { const first = new Map(); I.nums2.forEach((v, j) => { if (!first.has(v)) first.set(v, j); }); let best = -1; I.nums1.forEach((v, i) => { const c = first.has(v) ? i + first.get(v) : null; if (c !== null && (best < 0 || c < best)) best = c; if (i < 5) { T.at({ nums1: A(I.nums1, { i }), nums2: A(I.nums2), firstIndex: K([...first].sort((a, b) => a[0] - b[0])) }); T.n(`Best index sum so far after i = ${i}? (−1 if none)`, best, c === null ? `${v} is not in nums2.` : `Candidate ${i} + ${first.get(v)} = ${c}.`); } }); return best; }
  });

  D('majority-frequency-characters', {
    t: 'Majority Frequency Characters',
    r: 'Count each letter, then group letters by their count. The majority group has the most letters; on a tie the larger frequency wins.',
    cmp: (o, e) => typeof o === 'string' && o.split('').sort().join('') === e.split('').sort().join(''),
    g: R => ({ s: R.str(R.int(2, 9), 'abcde') }),
    s(I, T) { const c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const g = {}; Object.entries(c).forEach(([ch, f]) => (g[f] = g[f] || []).push(ch)); let bf = 0; Object.keys(g).map(Number).forEach(f => { if (!bf || g[f].length > g[bf].length || (g[f].length === g[bf].length && f > bf)) bf = f; }); T.at({ s: A(I.s.split('')), counts: K(Object.entries(c).sort()) }); Object.keys(g).map(Number).slice(0, 3).forEach(f => T.n(`How many letters appear exactly ${f} times?`, g[f].length, 'Size of that frequency group.')); T.c('Which frequency wins?', Object.keys(g).map(Number), bf, 'Largest group; break ties by the larger frequency.'); return g[bf].sort().join(''); }
  });

  D('sum-of-elements-with-frequency-divisible-by-k', {
    t: 'Sum of Elements With Frequency Divisible by K',
    r: 'Count every value. A value whose count is divisible by k adds value times count; the others add nothing.',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 4), k: R.int(1, 3) }),
    s(I, T) { const c = new Map(); I.nums.forEach(x => c.set(x, (c.get(x) || 0) + 1)); let s = 0; [...c].sort((a, b) => a[0] - b[0]).forEach(([v, f]) => { const add = f % I.k === 0 ? v * f : 0; s += add; T.at({ nums: A(I.nums, { hl: I.nums.map((x, i) => x === v ? i : -1).filter(i => i >= 0) }), counts: K([...c].sort((a, b) => a[0] - b[0])), k: I.k }); T.n(`What does value ${v} add?`, add, add ? `${f} is divisible by ${I.k}: add ${v} times ${f}.` : `${f} is not divisible by ${I.k}.`); }); return s; }
  });

  D('longest-balanced-substring-i', {
    t: 'Longest Balanced Substring I',
    r: 'n at most 1000, so fix each start and extend the end, updating letter counts, the number of distinct letters and the maximum count. The substring is balanced when maxCount times distinct = length.',
    g: R => ({ s: R.str(R.int(1, 7), 'abc') }),
    s(I, T) { let best = 0; for (let i = 0; i < I.s.length; i++) { const c = {}; let mx = 0, d = 0, b = 0; for (let j = i; j < I.s.length; j++) { const ch = I.s[j]; if (!c[ch]) d++; c[ch] = (c[ch] || 0) + 1; mx = Math.max(mx, c[ch]); if (mx * d === j - i + 1) b = j - i + 1; } best = Math.max(best, b); if (i < 5) { T.at({ s: A(I.s.split(''), { i }), best }); T.n(`Longest balanced substring starting at ${i}?`, b, 'Balanced when maxCount times distinct equals the length.'); } } return best; }
  });

  D('longest-balanced-substring-ii', {
    t: 'Longest Balanced Substring II',
    r: 'Three cases. One letter: longest run. Two letters x, y: inside stretches without the third letter, the first and last index with equal prefix difference (x − y) bound a balanced piece. All three: hash the pair (a − b, b − c) of prefix counts and keep its first index.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, bal = (i, j) => { const c = {}; for (let k = i; k <= j; k++) c[s[k]] = (c[s[k]] || 0) + 1; const v = Object.values(c); return v.every(x => x === v[0]); }; let one = 0, two = 0, three = 0; for (let i = 0; i < n; i++) for (let j = i; j < n; j++) if (bal(i, j)) { const d = new Set(s.slice(i, j + 1)).size, L = j - i + 1; if (d === 1) one = Math.max(one, L); else if (d === 2) two = Math.max(two, L); else three = Math.max(three, L); } T.at({ s: A(s.split('')) }); T.n('Longest balanced substring with one distinct letter?', one, 'The longest run of equal letters.'); T.n('With exactly two distinct letters? (0 if none)', two, 'Equal prefix differences inside stretches without the third letter.'); T.n('With all three letters? (0 if none)', three, 'Equal (a−b, b−c) prefix pairs.'); return Math.max(one, two, three); }
  });

  D('smallest-missing-multiple-of-k', {
    t: 'Smallest Missing Multiple of K',
    r: 'Put nums in a set and test k, 2k, 3k, … until one is absent.',
    g: R => { const k = R.int(1, 4); return { nums: R.shuffle([...R.ints(R.int(1, 4), 1, 12), ...range(1, R.int(1, 4)).map(i => i * k)]), k }; },
    s(I, T) { const set = new Set(I.nums); let m = I.k; while (set.has(m)) { T.at({ nums: A(I.nums, { hl: I.nums.map((v, i) => v === m ? i : -1).filter(i => i >= 0) }), candidate: m }); T.yn(`Is ${m} missing?`, false, 'It is in nums: try the next multiple.'); m += I.k; } T.at({ nums: A(I.nums), candidate: m }); T.yn(`Is ${m} missing?`, true, 'Not in the set: this is the answer.'); return m; }
  });

  D('count-distinct-subarrays-divisible-by-k-in-sorted-array', {
    t: 'Count Distinct Subarrays Divisible by K in Sorted Array',
    r: 'Count all good subarrays with prefix sums mod k in a hash map. Because the array is sorted, equal value sequences can only come from runs of one repeated value; subtract the duplicates there (a run of length L holding value v repeats each length-j block L − j times).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 4).sort((a, b) => a - b), k: R.int(1, 5) }),
    s(I, T) { const a = I.nums, n = a.length, seen = new Set(); let tot = 0; for (let i = 0; i < n; i++) { let s = 0, add = 0; for (let j = i; j < n; j++) { s += a[j]; const key = a.slice(i, j + 1).join(','); if (s % I.k === 0 && !seen.has(key)) { seen.add(key); add++; } } tot += add; if (i < 5) { T.at({ nums: A(a, { i }), k: I.k, found: tot - add }); T.n(`New distinct good subarrays starting at index ${i}?`, add, 'Sum divisible by k and a value sequence not seen before.'); } } return tot; }
  });

  D('find-missing-elements', {
    t: 'Find Missing Elements',
    r: 'The range runs from min to max. Put nums in a set and list every value in that range that is not in the set.',
    g: R => { const lo = R.int(1, 5), hi = lo + R.int(1, 6), all = range(lo, hi + 1), keep = all.filter((v, i) => v === lo || v === hi || R.chance(0.5)); return { nums: R.shuffle(keep) }; },
    s(I, T) { const lo = Math.min(...I.nums), hi = Math.max(...I.nums), set = new Set(I.nums), out = []; T.at({ nums: A(I.nums) }); T.n('Smallest value of the range?', lo, 'The minimum is still present.'); T.n('Largest value of the range?', hi, 'The maximum is still present.'); range(lo, hi + 1).forEach(v => { if (!set.has(v)) out.push(v); }); T.n('How many values are missing?', out.length, `${hi - lo + 1} values in range, ${I.nums.length} present.`); return out; }
  });

  D('minimum-distance-between-three-equal-elements-i', {
    t: 'Minimum Distance Between Three Equal Elements I',
    r: 'For indices i < j < k the distance is 2(k − i). Group the positions of each value; the best triple for a value is three consecutive positions, so check every window of 3.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3) }),
    s(I, T) { const pos = new Map(); I.nums.forEach((v, i) => { if (!pos.has(v)) pos.set(v, []); pos.get(v).push(i); }); let best = -1; [...pos].sort((a, b) => a[0] - b[0]).forEach(([v, p]) => { let b = -1; for (let i = 0; i + 2 < p.length; i++) { const d = 2 * (p[i + 2] - p[i]); if (b < 0 || d < b) b = d; } if (b >= 0 && (best < 0 || b < best)) best = b; T.at({ nums: A(I.nums, { hl: p }), positions: A(p) }); T.n(`Smallest distance for value ${v}? (−1 if fewer than 3)`, b, 'Distance is 2 times (last − first) over three consecutive positions.'); }); return best; }
  });

  D('minimum-distance-between-three-equal-elements-ii', {
    t: 'Minimum Distance Between Three Equal Elements II',
    r: 'Same formula, done in one pass: keep the last two indices of each value in a hash map. When a value appears again at k, its triple costs 2 times (k − the older stored index).',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3) }),
    s(I, T) { const last = new Map(); let best = -1, asks = 0; I.nums.forEach((v, k) => { const p = last.get(v) || []; if (p.length === 2) { const d = 2 * (k - p[0]); if (best < 0 || d < best) best = d; if (asks++ < 5) { T.at({ nums: A(I.nums, { i: k, hl: p }), lastTwo: K([...last].map(([x, q]) => [x, q.join(',')])) }); T.n(`Triple distance ending at index ${k}?`, d, `2 times (${k} − ${p[0]}).`); } } last.set(v, [...p, k].slice(-2)); }); T.at({ nums: A(I.nums) }); T.n('Minimum distance overall? (−1 if none)', best, 'Smallest triple seen.'); return best; }
  });

  D('minimum-absolute-distance-between-mirror-pairs', {
    t: 'Minimum Absolute Distance Between Mirror Pairs',
    r: 'Sweep j left to right. Before moving on, store reverse(nums[j]) to j in a hash map (latest index wins). At each j, if nums[j] is a key, the pair distance is j minus that stored index.',
    g: R => { const n = R.int(2, 6), a = []; for (let i = 0; i < n; i++) a.push(a.length && R.chance(0.4) ? Number(String(R.pick(a)).split('').reverse().join('')) : R.int(10, 99)); return { nums: a }; },
    s(I, T) { const rv = x => Number(String(x).split('').reverse().join('')), m = new Map(); let best = -1; I.nums.forEach((x, j) => { const d = m.has(x) ? j - m.get(x) : -1; if (d >= 0 && (best < 0 || d < best)) best = d; if (j && j < 7) { T.at({ nums: A(I.nums, { i: j }), reversedSeen: K([...m]) }); T.n(`Closest mirror partner distance for index ${j}? (−1 if none)`, d, d >= 0 ? `reverse(nums[${m.get(x)}]) = ${x}.` : `${x} is not a stored reversal.`); } m.set(rv(x), j); }); return best; }
  });

  D('maximum-number-of-equal-length-runs', {
    t: 'Maximum Number of Equal Length Runs',
    r: 'Split s into maximal runs and count how many runs have each length in a hash map. The answer is the largest count.',
    g: R => ({ s: R.str(R.int(1, 10), 'aab') }),
    s(I, T) { const c = new Map(); let i = 0, asks = 0; while (i < I.s.length) { let j = i; while (j < I.s.length && I.s[j] === I.s[i]) j++; c.set(j - i, (c.get(j - i) || 0) + 1); if (asks++ < 5) { T.at({ s: A(I.s.split(''), { win: [i, j - 1] }), lengths: K([...c].sort((a, b) => a[0] - b[0])) }); T.n(`Length of the run starting at ${i}?`, j - i, 'Extend while the letter repeats.'); } i = j; } return Math.max(...c.values()); }
  });

  D('minimum-number-of-operations-to-have-distinct-elements', {
    t: 'Minimum Number of Operations to Have Distinct Elements',
    r: 'Scan from the right with a set. The first value seen twice, at index i, must be removed, so the prefix 0 to i has to go: (i + 1) divided by 3 (rounded up) operations. No repeat means 0.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 6) }),
    s(I, T) { const seen = new Set(); for (let i = I.nums.length - 1; i >= 0; i--) { const dup = seen.has(I.nums[i]); T.at({ nums: A(I.nums, { i }), seen: A([...seen]) }); T.yn(`Is ${I.nums[i]} at index ${i} already in the suffix?`, dup, dup ? `Indices 0..${i} must be removed.` : 'Add it and move left.'); if (dup) { T.n('Operations needed?', Math.ceil((i + 1) / 3), `${i + 1} divided by 3, rounded up.`); return Math.ceil((i + 1) / 3); } seen.add(I.nums[i]); } return 0; }
  });

  D('minimum-deletion-cost-to-make-all-characters-equal', {
    t: 'Minimum Deletion Cost to Make All Characters Equal',
    r: 'Keeping letter c means deleting everything else: cost total − (sum of costs of c). Sum costs per letter in a hash map and keep the letter with the largest kept sum.',
    g: R => { const n = R.int(1, 7); return { s: R.str(n, 'abc'), cost: R.ints(n, 1, 9) }; },
    s(I, T) { const m = {}; I.s.split('').forEach((ch, i) => m[ch] = (m[ch] || 0) + I.cost[i]); const tot = sum(I.cost); let best = Infinity; Object.keys(m).sort().forEach(ch => { const d = tot - m[ch]; best = Math.min(best, d); T.at({ s: A(I.s.split(''), { hl: I.s.split('').map((x, i) => x === ch ? i : -1).filter(i => i >= 0) }), cost: A(I.cost), total: tot }); T.n(`Cost to keep only "${ch}"?`, d, `Total ${tot} minus the ${m[ch]} spent on "${ch}".`); }); return best; }
  });

  D('count-residue-prefixes', {
    t: 'Count Residue Prefixes',
    r: 'Grow the prefix one letter at a time, tracking distinct letters in a set. A prefix of length L counts when the number of distinct letters equals L mod 3.',
    g: R => ({ s: R.str(R.int(1, 8), 'abcd') }),
    s(I, T) { const set = new Set(); let c = 0; I.s.split('').forEach((ch, i) => { set.add(ch); const ok = set.size === (i + 1) % 3; if (ok) c++; if (i < 7) { T.at({ s: A(I.s.split(''), { win: [0, i] }), distinct: set.size }); T.yn(`Is the prefix of length ${i + 1} a residue?`, ok, `${set.size} distinct vs ${i + 1} mod 3 = ${(i + 1) % 3}.`); } }); return c; }
  });

  D('count-caesar-cipher-pairs', {
    t: 'Count Caesar Cipher Pairs',
    r: 'Two words are similar when one is a cyclic shift of the other, so normalize each word by shifting it until its first letter is "a". Count words per normal form; every earlier word with the same form makes a pair.',
    g: R => { const m = R.int(1, 3), base = R.str(m, 'abc'), ws = []; for (let i = 0; i < R.int(2, 5); i++) ws.push(R.chance(0.6) ? base.split('').map(c => String.fromCharCode(97 + (c.charCodeAt(0) - 97 + R.int(0, 25)) % 26)).join('') : R.str(m, 'abz')); return { words: ws }; },
    s(I, T) { const c = new Map(); let tot = 0; const norm = w => w.split('').map(ch => String.fromCharCode(97 + (ch.charCodeAt(0) - w.charCodeAt(0) + 26) % 26)).join(''); I.words.forEach((w, i) => { const k = norm(w), add = c.get(k) || 0; tot += add; c.set(k, add + 1); if (i < 6) { T.at({ words: A(I.words, { i }), forms: K([...c]) }); T.n(`Earlier words similar to "${w}" (normal form "${k}")?`, add, 'Same normal form means a cyclic shift apart.'); } }); return tot; }
  });

  D('minimum-operations-to-reach-target-array', {
    t: 'Minimum Operations to Reach Target Array',
    r: 'One operation on value x fixes every position currently holding x at once, and fixed positions never need touching again. So the answer is the number of distinct values nums[i] at positions where nums[i] not equal to target[i].',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 4), target: R.ints(n, 1, 4) }; },
    s(I, T) { const set = new Set(); I.nums.forEach((x, i) => { const bad = x !== I.target[i]; if (bad) set.add(x); if (i < 6) { T.at({ nums: A(I.nums, { i }), target: A(I.target, { i }), valuesToFix: A([...set]) }); T.yn(`Does index ${i} need fixing?`, bad, bad ? `Value ${x} needs one operation.` : 'Already matches.'); } }); return set.size; }
  });
})();
