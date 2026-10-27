/* v2 games: sliding window (02). */
(function () {
  'use strict';
  const { D, A, K, Q } = LCGame.H;
  const subs = s => { const o = []; for (let i = 0; i < s.length; i++) for (let j = i + 1; j <= s.length; j++) o.push([i, j - 1, s.slice(i, j)]); return o; };
  const cnt = x => { const c = {}; for (const v of x) c[v] = (c[v] || 0) + 1; return c; };
  const powerK = {
    r: 'For each window of size k, the power is its last element if every neighbor pair rises by exactly 1, else −1. Track the length of the current "consecutive ascending" run instead of rechecking.',
    g: R => { const a = R.int(1, 4), n = R.int(1, 8); return { nums: Array.from({ length: n }, (_, i) => R.chance(0.7) ? a + i : R.int(1, 9)), k: R.int(1, n) }; },
    s(I, T) { const a = I.nums, out = []; let run = 0; a.forEach((x, i) => { run = i && x === a[i - 1] + 1 ? run + 1 : 1; if (i >= I.k - 1) { const v = run >= I.k ? x : -1; out.push(v); if (out.length <= 6) { T.at({ nums: A(a, { win: [i - I.k + 1, i] }), run }); T.n('Power of this window?', v, 'Last element if the run covers the window, else −1.'); } } }); return out; }
  };
  const rearrange = {
    r: 'A substring works if it contains word2\'s letter counts. For each right end, shrink the left while the window still covers word2; every start before l then works — add l.',
    g: R => ({ word1: R.str(R.int(1, 10), 'abc'), word2: R.str(R.int(1, 3), 'abc') }),
    s(I, T) { const need = cnt(I.word2), have = {}, ok = () => Object.keys(need).every(c => (have[c] || 0) >= need[c]); let l = 0, tot = 0; [...I.word1].forEach((ch, r) => { have[ch] = (have[ch] || 0) + 1; while (ok()) have[I.word1[l++]]--; tot += l; if (r < 8) { T.at({ word1: A([...I.word1], { win: [l, r] }), need: K(need) }); T.n('Valid substrings so far?', tot, 'Add l for each right end.'); } }); return tot; }
  };
  const vowelK = {
    r: 'exactly(k) = atLeast(k) − atLeast(k + 1): count substrings that contain all five vowels and at least k consonants, sliding a window that shrinks while the condition still holds.',
    g: R => ({ word: R.str(R.int(5, 12), 'aeioub'), k: R.int(0, 2) }),
    s(I, T) { const w = I.word, V = 'aeiou'; const atLeast = k => { const c = {}; let cons = 0, l = 0, t = 0; for (let r = 0; r < w.length; r++) { if (V.includes(w[r])) c[w[r]] = (c[w[r]] || 0) + 1; else cons++; while (Object.keys(c).length === 5 && cons >= k) { const x = w[l++]; if (V.includes(x)) { if (!--c[x]) delete c[x]; } else cons--; } t += l; } return t; }; const a = atLeast(I.k), b = atLeast(I.k + 1); T.at({ word: A([...w]), k: I.k }); T.n(`Substrings with all vowels and at least ${I.k} consonants?`, a, 'Sliding window count.'); T.n(`Substrings with all vowels and at least ${I.k + 1} consonants?`, b, 'Subtract these.'); T.n(`Substrings with all vowels and exactly ${I.k} consonants?`, a - b, 'The difference of the two counts.'); return a - b; }
  };
  const xsum = {
    r: 'For each window of size k, count frequencies, keep the x most frequent values (ties go to the larger value), and sum value times frequency of the kept ones.',
    g: R => { const a = R.ints(R.int(1, 8), 1, 5); return { nums: a, k: R.int(1, a.length), x: R.int(1, 3) }; },
    s(I, T) { const out = []; for (let i = 0; i + I.k <= I.nums.length; i++) { const c = cnt(I.nums.slice(i, i + I.k)), top = Object.entries(c).map(([v, f]) => [+v, f]).sort((p, q) => q[1] - p[1] || q[0] - p[0]).slice(0, I.x), s = top.reduce((t, [v, f]) => t + v * f, 0); out.push(s); if (i < 5) { T.at({ nums: A(I.nums, { win: [i, i + I.k - 1] }), freq: K(c), x: I.x }); T.n('x-sum of this window?', s, 'Top-x frequent values (ties: larger value).'); } } return out; }
  };
  const kfreq = {
    r: 'For each right end, while the newest character reaches k occurrences, every extension to the right also works: add n − r, then drop s[l] and move l.',
    g: R => ({ s: R.str(R.int(1, 10), 'abc'), k: R.int(1, 3) }),
    s(I, T) { const s = I.s, n = s.length, c = {}; let l = 0, t = 0; for (let r = 0; r < n; r++) { c[s[r]] = (c[s[r]] || 0) + 1; while (c[s[r]] >= I.k) { t += n - r; c[s[l++]]--; } if (r < 8) { T.at({ s: A([...s], { win: [l, r] }), k: I.k }); T.n('Count so far?', t, 'Each valid start adds n − r substrings.'); } } return t; }
  };
  const pattern = {
    exIn: I => { if (!I.stream || !I.stream.__raw) return I; const shown = (I.stream.__raw.match(/[01]/g) || []).map(Number); return { stream: [...shown, ...shown, ...shown], pattern: I.pattern }; },
    r: 'Read the stream one bit at a time, keeping the last m bits (a window with a rolling hash, or KMP state). The first time the window equals the pattern, return its start index.',
    g: R => { const p = R.ints(R.int(1, 4), 0, 1), pre = R.ints(R.int(0, 8), 0, 1); return { stream: [...pre, ...p, ...R.ints(3, 0, 1)], pattern: p }; },
    s(I, T) { const m = I.pattern.length; for (let i = 0; i + m <= I.stream.length; i++) { const hit = I.pattern.every((b, j) => I.stream[i + j] === b); if (i < 8) { T.at({ stream: A(I.stream.slice(0, i + m + 2), { win: [i, i + m - 1] }), pattern: A(I.pattern) }); T.yn('Does the window match the pattern?', hit, 'Compare the last m bits.'); } if (hit) return i; } return -1; }
  };

  D('find-the-k-beauty-of-a-number', {
    t: 'Find the K-Beauty of a Number',
    r: 'Slide a window of k digits over the decimal string; count windows whose value is non-zero and divides num.',
    g: R => ({ num: R.int(1, 99999), k: R.int(1, 3) }),
    s(I, T) { const s = String(I.num); let c = 0; for (let i = 0; i + I.k <= s.length; i++) { const v = +s.substr(i, I.k), ok = v !== 0 && I.num % v === 0; if (ok) c++; if (i < 6) { T.at({ num: A([...s], { win: [i, i + I.k - 1] }) }); T.yn(`Does ${v} divide ${I.num}?`, ok, 'Zero never counts.'); } } if (s.length < I.k) { T.at({ num: s, k: I.k }); T.n('Windows?', 0, 'Too short.'); } return c; }
  });

  D('minimum-recolors-to-get-k-consecutive-black-blocks', {
    t: 'Minimum Recolors to Get K Consecutive Black Blocks',
    r: 'Slide a window of length k counting white blocks; the fewest whites in any window is the number of recolors.',
    g: R => { const b = R.str(R.int(1, 10), 'WB'); return { blocks: b, k: R.int(1, b.length) }; },
    s(I, T) { let w = 0, best = Infinity; [...I.blocks].forEach((c, i) => { if (c === 'W') w++; if (i >= I.k && I.blocks[i - I.k] === 'W') w--; if (i >= I.k - 1) { best = Math.min(best, w); if (i < I.k + 5) { T.at({ blocks: A([...I.blocks], { win: [i - I.k + 1, i] }) }); T.n('Whites in this window?', w, 'Each needs one recolor.'); } } }); return best; }
  });

  D('longest-nice-subarray', {
    t: 'Longest Nice Subarray',
    r: 'Pairwise AND = 0 means no bit is shared. Keep the OR of the window; while the new number overlaps it, XOR out nums[l] and move l. Track the longest window.',
    g: R => ({ nums: Array.from({ length: R.int(1, 8) }, () => 1 << R.int(0, 4) | (R.chance(0.3) ? 1 << R.int(0, 4) : 0)) }),
    s(I, T) { let l = 0, m = 0, best = 0; I.nums.forEach((x, r) => { while (m & x) m ^= I.nums[l++]; m |= x; best = Math.max(best, r - l + 1); if (r < 8) { T.at({ nums: A(I.nums.map(v => v.toString(2)), { win: [l, r] }), mask: m.toString(2) }); T.n('Longest nice window so far?', best, 'Shrink while bits overlap.'); } }); return best; }
  });

  D('count-subarrays-with-fixed-bounds', {
    t: 'Count Subarrays With Fixed Bounds',
    r: 'Track the last index of minK, of maxK, and of any out-of-range value (bad). Each right end adds max(0, min(lastMin, lastMax) − bad).',
    g: R => { const a = R.ints(R.int(1, 9), 1, 5), lo = R.int(1, 3); return { nums: a, minK: lo, maxK: R.int(lo, 5) }; },
    s(I, T) { let mn = -1, mx = -1, bad = -1, t = 0; I.nums.forEach((x, i) => { if (x < I.minK || x > I.maxK) bad = i; if (x === I.minK) mn = i; if (x === I.maxK) mx = i; const add = Math.max(0, Math.min(mn, mx) - bad); t += add; if (i < 8) { T.at({ nums: A(I.nums, { i }), vars: K({ lastMin: mn, lastMax: mx, bad }) }); T.n('Subarrays ending here?', add, 'min(lastMin, lastMax) − bad.'); } }); return t; }
  });

  D('maximum-sum-of-distinct-subarrays-with-length-k', {
    t: 'Maximum Sum of Distinct Subarrays With Length K',
    r: 'Slide a window of length k with a count map and running sum; a window counts only when the map has k keys (all distinct). Return the best sum, or 0.',
    g: R => { const a = R.ints(R.int(1, 8), 1, 6); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { let best = 0, asks = 0; for (let i = 0; i + I.k <= I.nums.length; i++) { const w = I.nums.slice(i, i + I.k), ok = new Set(w).size === I.k; if (ok) best = Math.max(best, w.reduce((a, b) => a + b, 0)); if (asks++ < 6) { T.at({ nums: A(I.nums, { win: [i, i + I.k - 1] }) }); T.yn('All distinct?', ok, 'Count-map size equals k.'); } } return best; }
  });

  D('take-k-of-each-character-from-left-and-right', {
    t: 'Take K of Each Character From Left and Right',
    r: 'Invert it: keep the longest middle window such that what remains outside still has at least k of a, b and c. Answer = n − that window (−1 if the whole string lacks k of some letter).',
    g: R => ({ s: R.str(R.int(1, 10), 'abc'), k: R.int(0, 2) }),
    s(I, T) { const res = (() => { const s = I.s, c = { a: 0, b: 0, c: 0 }; for (const ch of s) c[ch]++; const ok = () => c.a >= I.k && c.b >= I.k && c.c >= I.k; T.at({ counts: K({ ...c }), k: I.k }); T.n(`Count of 'a' in the string?`, c.a, 'Count every letter first.'); T.yn('Does the whole string have k of each?', ok(), 'Otherwise −1.'); if (!ok()) return -1; let l = 0, best = 0; for (let r = 0; r < s.length; r++) { c[s[r]]--; while (!ok()) c[s[l++]]++; best = Math.max(best, r - l + 1); } T.n('Longest middle you can leave untouched?', best, 'Outside counts stay at least k.'); return s.length - best; })(); T.n('Fewest minutes? (−1 if impossible)', res, 'Length minus the longest middle.'); return res; }
  });

  D('maximum-frequency-score-of-a-subarray', {
    t: 'Maximum Frequency Score of a Subarray',
    r: 'Score = the sum over distinct v of v to the power freq(v) mod 1e9+7. Slide a window of size k; update the score when a count changes (remove v to the power old, add v to the power new) and keep the maximum.',
    g: R => { const a = R.ints(R.int(1, 8), 1, 5); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { const M = 1000000007n, pw = (b, e) => { let r = 1n; for (let i = 0; i < e; i++) r = r * BigInt(b) % M; return r; }; let best = 0; for (let i = 0; i + I.k <= I.nums.length; i++) { const c = cnt(I.nums.slice(i, i + I.k)); let s = 0n; for (const [v, f] of Object.entries(c)) s = (s + pw(+v, f)) % M; best = Math.max(best, Number(s)); if (i < 5) { T.at({ nums: A(I.nums, { win: [i, i + I.k - 1] }), freq: K(c) }); T.n('Frequency score of this window?', Number(s), 'the sum of v to the power freq.'); } } return best; }
  });

  D('count-the-number-of-good-subarrays', {
    t: 'Count the Number of Good Subarrays',
    r: 'Adding x to a window creates count[x] new equal pairs. For each right end, shrink the left while the window still has at least k pairs; every start before l works, so add l.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 3), k: R.int(1, 5) }),
    s(I, T) { const c = {}; let l = 0, p = 0, t = 0; I.nums.forEach((x, r) => { p += c[x] || 0; c[x] = (c[x] || 0) + 1; while (p >= I.k) { const y = I.nums[l++]; c[y]--; p -= c[y]; } t += l; if (r < 8) { T.at({ nums: A(I.nums, { win: [l, r] }), pairs: p }); T.n('Good subarrays so far?', t, 'Add l.'); } }); return t; }
  });

  D('sliding-subarray-beauty', {
    t: 'Sliding Subarray Beauty',
    r: 'Values are in [−50, 50], so keep a count array for the window. The beauty is the x-th smallest negative (scan counts −50..−1), or 0 if fewer than x negatives.',
    g: R => { const a = R.ints(R.int(1, 8), -5, 5), k = R.int(1, a.length); return { nums: a, k, x: R.int(1, k) }; },
    s(I, T) { const out = []; for (let i = 0; i + I.k <= I.nums.length; i++) { const neg = I.nums.slice(i, i + I.k).filter(v => v < 0).sort((a, b) => a - b), v = neg.length >= I.x ? neg[I.x - 1] : 0; out.push(v); if (i < 6) { T.at({ nums: A(I.nums, { win: [i, i + I.k - 1] }), negatives: A(neg) }); T.n('Beauty?', v, `${I.x}-th smallest negative, else 0.`); } } return out; }
  });

  D('find-the-longest-semi-repetitive-substring', {
    t: 'Find the Longest Semi-Repetitive Substring',
    r: 'Allow at most one adjacent equal pair in the window. Count pairs as r advances; while there are two, move l past the first pair.',
    g: R => ({ s: R.str(R.int(1, 10), '123') }),
    s(I, T) { const s = I.s; let l = 0, pairs = 0, best = 1; for (let r = 1; r < s.length; r++) { if (s[r] === s[r - 1]) pairs++; while (pairs > 1) { if (s[l] === s[l + 1]) pairs--; l++; } best = Math.max(best, r - l + 1); if (r < 9) { T.at({ s: A([...s], { win: [l, r] }), pairs }); T.n('Longest so far?', best, 'At most one adjacent equal pair.'); } } return best; }
  });

  D('count-substrings-without-repeating-character', {
    t: 'Count Substrings Without Repeating Character',
    r: 'For each right end, shrink the left until the window has no repeated character; all r − l + 1 substrings ending at r are special.',
    g: R => ({ s: R.str(R.int(1, 10), 'abcd') }),
    s(I, T) { const c = {}; let l = 0, t = 0; [...I.s].forEach((ch, r) => { c[ch] = (c[ch] || 0) + 1; while (c[ch] > 1) c[I.s[l++]]--; t += r - l + 1; if (r < 8) { T.at({ s: A([...I.s], { win: [l, r] }) }); T.n('Count so far?', t, 'Add r − l + 1.'); } }); return t; }
  });

  D('count-zero-request-servers', {
    t: 'Count Zero Request Servers',
    r: 'Sort logs by time and queries by time. Slide a window [q − x, q] over the logs keeping per-server counts and the number of active servers; the answer is n − active.',
    g: R => { const n = R.int(1, 4); return { n, logs: Array.from({ length: R.int(1, 6) }, () => [R.int(1, n), R.int(1, 10)]), x: R.int(1, 4), queries: Array.from({ length: R.int(1, 4) }, () => R.int(5, 12)) }; },
    s(I, T) { return I.queries.map((q, i) => { const act = new Set(I.logs.filter(([, t]) => t >= q - I.x && t <= q).map(([s]) => s)); if (i < 5) { T.at({ logs: A(I.logs.map(l => l.join('@'))), window: `[${q - I.x}, ${q}]` }); T.n('Servers with a request in the window?', act.size, 'Distinct servers among window logs.'); } return I.n - act.size; }); }
  });

  D('longest-even-odd-subarray-with-threshold', {
    t: 'Longest Even Odd Subarray With Threshold',
    r: 'Scan once: a run must start at an even value at most threshold, then alternate parity with every value at most threshold. Restart when broken.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 9), threshold: R.int(1, 9) }),
    s(I, T) { let run = 0, best = 0; I.nums.forEach((x, i) => { if (x > I.threshold) run = 0; else if (run && x % 2 !== I.nums[i - 1] % 2) run++; else run = x % 2 === 0 ? 1 : 0; best = Math.max(best, run); if (i < 9) { T.at({ nums: A(I.nums, run ? { win: [i - run + 1, i] } : { i }), threshold: I.threshold }); T.n('Current run length?', run, 'Even start, alternating, at most threshold.'); } }); return best; }
  });

  D('continuous-subarrays', {
    t: 'Continuous Subarrays',
    r: 'A subarray is continuous when max − min at most 2. Keep monotonic deques for window max and min; shrink while the spread exceeds 2; add r − l + 1.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 7) }),
    s(I, T) { let l = 0, t = 0; I.nums.forEach((x, r) => { let w = I.nums.slice(l, r + 1); while (Math.max(...w) - Math.min(...w) > 2) w = I.nums.slice(++l, r + 1); t += r - l + 1; if (r < 8) { T.at({ nums: A(I.nums, { win: [l, r] }) }); T.n('Continuous subarrays so far?', t, 'Add r − l + 1.'); } }); return t; }
  });

  D('length-of-the-longest-valid-substring', {
    t: 'Length of the Longest Valid Substring',
    r: 'Put forbidden words in a set. For each r, check substrings ending at r of length at most 10 (from short to long, not crossing l); if one is forbidden starting at j, move l to j + 1.',
    g: R => ({ word: R.str(R.int(1, 10), 'abc'), forbidden: Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 3), 'abc')) }),
    s(I, T) { const F = new Set(I.forbidden), w = I.word; let l = 0, best = 0; for (let r = 0; r < w.length; r++) { for (let j = r; j >= Math.max(l, r - 9); j--) if (F.has(w.slice(j, r + 1))) { l = j + 1; break; } best = Math.max(best, r - l + 1); if (r < 8) { T.at({ word: A([...w], { win: [l, r] }), forbidden: A(I.forbidden) }); T.n('Longest valid so far?', best, 'Jump l past any forbidden ending at r.'); } } return best; }
  });

  D('count-complete-subarrays-in-an-array', {
    t: 'Count Complete Subarrays in an Array',
    r: 'Let D = distinct values in the whole array. For each right end, shrink the left while the window still has D distinct; add l.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 4) }),
    s(I, T) { const D0 = new Set(I.nums).size, c = new Map(); let l = 0, t = 0; T.at({ nums: A(I.nums) }); T.n('Distinct values in the whole array?', D0, 'The target.'); I.nums.forEach((x, r) => { c.set(x, (c.get(x) || 0) + 1); while (c.size === D0) { const y = I.nums[l++]; c.set(y, c.get(y) - 1); if (!c.get(y)) c.delete(y); } t += l; if (r < 6) { T.at({ nums: A(I.nums, { win: [l, r] }) }); T.n('Complete subarrays so far?', t, 'Add l.'); } }); return t; }
  });

  D('maximum-sum-of-almost-unique-subarray', {
    t: 'Maximum Sum of Almost Unique Subarray',
    r: 'Slide a window of length k with counts and a running sum; windows with at least m distinct values are candidates. Return the best sum or 0.',
    g: R => { const a = R.ints(R.int(1, 8), 1, 9), k = R.int(1, a.length); return { nums: a, m: R.int(1, k), k }; },
    s(I, T) { let best = 0; for (let i = 0; i + I.k <= I.nums.length; i++) { const w = I.nums.slice(i, i + I.k), ok = new Set(w).size >= I.m; if (ok) best = Math.max(best, w.reduce((a, b) => a + b, 0)); if (i < 6) { T.at({ nums: A(I.nums, { win: [i, i + I.k - 1] }), m: I.m }); T.yn('At least m distinct?', ok, `${new Set(w).size} distinct.`); } } return best; }
  });

  D('minimum-size-subarray-in-infinite-array', {
    t: 'Minimum Size Subarray in Infinite Array',
    r: 'Take q = (target divided by total, rounded down) full copies (q times n elements), then find the shortest window with sum target mod total in nums + nums (sliding window on positives). −1 if none.',
    g: R => { const a = R.ints(R.int(1, 5), 1, 5); return { nums: a, target: R.int(1, 25) }; },
    s(I, T) { const res = (() => { const a = I.nums, n = a.length, tot = a.reduce((x, y) => x + y, 0), q = Math.floor(I.target / tot), rem = I.target % tot; T.at({ nums: A(a), target: I.target }); T.n('Full copies used?', q, 'target divided by total, rounded down.'); T.n('Remainder to cover?', rem, 'The remainder of target divided by total.'); if (!rem) return q * n; const d = [...a, ...a]; let l = 0, s = 0, best = Infinity; for (let r = 0; r < d.length; r++) { s += d[r]; while (s > rem) s -= d[l++]; if (s === rem) best = Math.min(best, r - l + 1); } return best === Infinity ? -1 : q * n + best; })(); T.n('Shortest length? (−1 if none)', res, 'Full copies times n, plus the best window.'); return res; }
  });

  D('shortest-and-lexicographically-smallest-beautiful-string', {
    t: 'Shortest and Lexicographically Smallest Beautiful String',
    r: 'Slide a window holding exactly k ones, shrinking the left past zeros; each tight window is a candidate. Keep the shortest, breaking ties lexicographically.',
    g: R => ({ s: R.str(R.int(1, 10), '01'), k: R.int(1, 3) }),
    s(I, T) { let best = ''; const ones = []; [...I.s].forEach((c, i) => c === '1' && ones.push(i)); for (let i = 0; i + I.k <= ones.length; i++) { const w = I.s.slice(ones[i], ones[i + I.k - 1] + 1); if (!best || w.length < best.length || (w.length === best.length && w < best)) best = w; if (i < 6) { T.at({ s: A([...I.s], { win: [ones[i], ones[i + I.k - 1]] }) }); T.n('Length of this tight window?', w.length, 'From the first to the k-th one.'); } } if (!best) { T.at({ s: I.s, k: I.k }); T.n('How many ones are there?', ones.length, 'Fewer than k: "".'); } return best; }
  });

  D('count-complete-substrings', {
    t: 'Count Complete Substrings',
    r: 'Split where adjacent letters differ by more than 2. In each part, for u = 1 to 26 distinct letters, slide a window of length u times k and count windows where every present letter appears exactly k times.',
    g: R => ({ word: R.str(R.int(1, 10), 'abd'), k: R.int(1, 2) }),
    s(I, T) { const res = (() => { const w = I.word; let tot = 0; const parts = []; let st = 0; for (let i = 1; i <= w.length; i++) if (i === w.length || Math.abs(w.charCodeAt(i) - w.charCodeAt(i - 1)) > 2) { parts.push(w.slice(st, i)); st = i; } T.at({ word: w }); T.n('How many segments after splitting?', parts.length, 'Break where neighbors differ by more than 2.'); T.n('Longest segment?', Math.max(...parts.map(p => p.length)), 'Windows must fit inside one segment.'); for (const p of parts) for (let u = 1; u <= 3; u++) { const L = u * I.k; for (let i = 0; i + L <= p.length; i++) if (Object.values(cnt(p.substr(i, L))).every(v => v === I.k)) tot++; } return tot; })(); T.n('Complete substrings?', res, 'Windows of k, 2k and so on with every count equal to k.'); return res; }
  });

  D('length-of-longest-subarray-with-at-most-k-frequency', {
    t: 'Length of Longest Subarray With at Most K Frequency',
    r: 'Grow the window; while the newest value appears more than k times, shrink from the left. Track the longest window.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 3), k: R.int(1, 3) }),
    s(I, T) { const c = {}; let l = 0, best = 0; I.nums.forEach((x, r) => { c[x] = (c[x] || 0) + 1; while (c[x] > I.k) c[I.nums[l++]]--; best = Math.max(best, r - l + 1); if (r < 8) { T.at({ nums: A(I.nums, { win: [l, r] }) }); T.n('Longest so far?', best, 'Shrink while the new value is over k.'); } }); return best; }
  });

  D('count-subarrays-where-max-element-appears-at-least-k-times', {
    t: 'Count Subarrays Where Max Element Appears at Least K Times',
    r: 'Let M be the global max. For each right end, shrink the left while the window has at least k copies of M; add l (all those starts work).',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 4), k: R.int(1, 3) }),
    s(I, T) { const M = Math.max(...I.nums); let l = 0, c = 0, t = 0; I.nums.forEach((x, r) => { if (x === M) c++; while (c >= I.k) if (I.nums[l++] === M) c--; t += l; if (r < 8) { T.at({ nums: A(I.nums, { win: [l, r] }), max: M, copies: c }); T.n('Count so far?', t, 'Add l.'); } }); return t; }
  });

  D('divide-an-array-into-subarrays-with-minimum-cost-ii', {
    t: 'Divide an Array Into Subarrays With Minimum Cost II',
    r: 'Cost = nums[0] + the starts of the other k − 1 subarrays, all within a span of dist. Slide a window of dist + 1 over indices 1 to n−1 keeping the k − 1 smallest (two multisets); minimize their sum.',
    g: R => { const n = R.int(3, 8), k = R.int(3, n); return { nums: R.ints(n, 1, 9), k, dist: R.int(k - 2, n - 2) }; },
    s(I, T) { const a = I.nums, n = a.length, m = I.k - 1; let best = Infinity, asks = 0; for (let s = 1; s + m - 1 <= n - 1; s++) { const w = a.slice(s, Math.min(n, s + I.dist + 1)).sort((x, y) => x - y); if (w.length < m) continue; const v = w.slice(0, m).reduce((x, y) => x + y, 0); best = Math.min(best, v); if (asks++ < 5) { T.at({ nums: A(a, { win: [s, Math.min(n - 1, s + I.dist)] }), need: m }); T.n(`Sum of the ${m} smallest in this window?`, v, 'Starts of the other subarrays.'); } } return a[0] + best; }
  });

  D('find-pattern-in-infinite-stream-i', { t: 'Find Pattern in Infinite Stream I', ...pattern });
  D('find-pattern-in-infinite-stream-ii', { t: 'Find Pattern in Infinite Stream II', ...pattern });

  D('minimum-moves-to-pick-k-ones', {
    t: 'Minimum Moves to Pick K Ones',
    r: 'Ones at Alice\'s index cost 0, at a neighbor 1, a created one costs 2 (change + swap). Ones further away cost their distance. If changes cover the rest after the best 3-cell neighborhood, use them; otherwise take k − maxChanges real ones by a median-centered window and add 2 per change.',
    g: R => { const n = R.int(2, 7), a = R.ints(n, 0, 1), mc = R.int(0, 3), ones = a.filter(x => x).length; return { nums: a, k: R.int(1, Math.max(1, Math.min(4, ones + mc))), maxChanges: ones ? mc : Math.max(1, mc) }; },
    s(I, T) { const a = I.nums, n = a.length, k = I.k; let c = 0, bestNear = Infinity; for (let i = 0; i < n; i++) { let take = Math.min(a[i], k), cost = 0; for (const j of [i - 1, i + 1]) if (take < k && j >= 0 && j < n && a[j]) { take++; cost++; } c = Math.max(c, take); if (k - take <= I.maxChanges) bestNear = Math.min(bestNear, cost + 2 * (k - take)); } T.at({ nums: A(a), k, maxChanges: I.maxChanges }); T.n('Ones in nums?', a.filter(Boolean).length, 'Real ones to pick up.'); T.n('Most ones Alice can grab from her cell and its two neighbors (capped at k)?', c, 'Cost 0 for the center, 1 for each neighbor.'); if (bestNear < Infinity) { T.n('Cheapest total using neighbors plus changes?', bestNear, 'Each change costs 2: create next to Alice, then swap.'); return bestNear; } const need = k - I.maxChanges, p = []; a.forEach((v, i) => v && p.push(i)); let best = Infinity; for (let i = 0; i + need <= p.length; i++) { const w = p.slice(i, i + need), m = w[need >> 1]; best = Math.min(best, w.reduce((s, v) => s + Math.abs(v - m), 0)); } T.n('Cheapest cost to gather the real ones?', best, 'Window of positions around the median.'); return best + 2 * I.maxChanges; }
  });

  D('maximum-length-substring-with-two-occurrences', {
    t: 'Maximum Length Substring With Two Occurrences',
    r: 'Grow the window; while the newest character occurs more than twice, shrink from the left. Track the longest window.',
    g: R => ({ s: R.str(R.int(2, 10), 'abc') }),
    s(I, T) { const c = {}; let l = 0, best = 0; [...I.s].forEach((ch, r) => { c[ch] = (c[ch] || 0) + 1; while (c[ch] > 2) c[I.s[l++]]--; best = Math.max(best, r - l + 1); if (r < 8) { T.at({ s: A([...I.s], { win: [l, r] }) }); T.n('Longest so far?', best, 'Each char at most twice.'); } }); return best; }
  });

  D('shortest-subarray-with-or-at-least-k-ii', {
    t: 'Shortest Subarray With OR at Least K II',
    r: 'Keep per-bit counts for the window so OR can be "un-done". For each right end, while the window OR at least k, record its length and drop nums[l].',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 15), k: R.int(0, 15) }),
    s(I, T) { const bits = Array(5).fill(0), or = () => bits.reduce((s, c, b) => s | (c ? 1 << b : 0), 0); let l = 0, best = Infinity; I.nums.forEach((x, r) => { for (let b = 0; b < 5; b++) if (x >> b & 1) bits[b]++; while (l <= r && or() >= I.k) { best = Math.min(best, r - l + 1); for (let b = 0; b < 5; b++) if (I.nums[l] >> b & 1) bits[b]--; l++; } if (r < 8) { T.at({ nums: A(I.nums, { win: [l, r] }), k: I.k }); T.n('Shortest length so far (0 if none)?', best === Infinity ? 0 : best, 'Shrink while OR at least k.'); } }); return best === Infinity ? -1 : best; }
  });

  D('minimum-operations-to-make-binary-array-elements-equal-to-one-i', {
    t: 'Minimum Operations to Make Binary Array Elements Equal to One I',
    r: 'Greedy left to right: whenever nums[i] is 0, flip i, i+1, i+2 (impossible if fewer than 3 remain). Count the flips.',
    g: R => ({ nums: R.ints(R.int(3, 9), 0, 1) }),
    s(I, T) { const a = I.nums.slice(); let c = 0; for (let i = 0; i < a.length; i++) { if (i < 9) { T.at({ nums: A(a, { i }) }); T.yn('Flip starting here?', a[i] === 0, 'Only this window can still fix index i.'); } if (!a[i]) { if (i + 3 > a.length) return -1; for (let j = i; j < i + 3; j++) a[j] ^= 1; c++; } } return c; }
  });

  D('alternating-groups-i', {
    t: 'Alternating Groups I',
    r: 'Circular: tile i is the middle of a group when it differs from both neighbors (indices mod n). Count such i.',
    g: R => ({ colors: R.ints(R.int(3, 9), 0, 1) }),
    s(I, T) { const c = I.colors, n = c.length; let t = 0; for (let i = 0; i < n; i++) { const ok = c[i] !== c[(i - 1 + n) % n] && c[i] !== c[(i + 1) % n]; if (ok) t++; if (i < 8) { T.at({ colors: A(c, { i }) }); T.yn('Is this the middle of an alternating group?', ok, 'Differs from both circular neighbors.'); } } return t; }
  });

  D('alternating-groups-ii', {
    t: 'Alternating Groups II',
    r: 'Walk i = 0 to n + k − 2 over the circle tracking the current alternating run length; whenever the run is at least k and i at least k − 1, one group ends here.',
    g: R => { const c = R.ints(R.int(3, 9), 0, 1); return { colors: c, k: R.int(3, c.length) }; },
    s(I, T) { const c = I.colors, n = c.length; let run = 1, t = 0; for (let i = 1; i < n + I.k - 1; i++) { run = c[i % n] !== c[(i - 1) % n] ? run + 1 : 1; if (run >= I.k) t++; if (i < 9) { T.at({ colors: A(c, { i: i % n }), run }); T.n('Groups counted so far?', t, `Run at least ${I.k} ends a group.`); } } return t; }
  });

  D('find-the-power-of-k-size-subarrays-i', { t: 'Find the Power of K-Size Subarrays I', ...powerK });
  D('find-the-power-of-k-size-subarrays-ii', { t: 'Find the Power of K-Size Subarrays II', ...powerK });

  D('count-substrings-that-satisfy-k-constraint-i', {
    t: 'Count Substrings That Satisfy K-Constraint I',
    r: 'A substring is fine if it has at most k zeros or at most k ones. For each right end, shrink the left while both counts exceed k; add r − l + 1.',
    g: R => ({ s: R.str(R.int(1, 10), '01'), k: R.int(1, 3) }),
    s(I, T) { const c = [0, 0]; let l = 0, t = 0; [...I.s].forEach((ch, r) => { c[+ch]++; while (c[0] > I.k && c[1] > I.k) c[+I.s[l++]]--; t += r - l + 1; if (r < 8) { T.at({ s: A([...I.s], { win: [l, r] }), zeros: c[0], ones: c[1] }); T.n('Count so far?', t, 'Add r − l + 1.'); } }); return t; }
  });

  D('count-substrings-that-can-be-rearranged-to-contain-a-string-i', { t: 'Count Substrings That Can Be Rearranged to Contain a String I', ...rearrange });
  D('count-substrings-that-can-be-rearranged-to-contain-a-string-ii', { t: 'Count Substrings That Can Be Rearranged to Contain a String II', ...rearrange });
  D('count-of-substrings-containing-every-vowel-and-k-consonants-i', { t: 'Count of Substrings Containing Every Vowel and K Consonants I', ...vowelK });
  D('count-of-substrings-containing-every-vowel-and-k-consonants-ii', { t: 'Count of Substrings Containing Every Vowel and K Consonants II', ...vowelK });
  D('find-x-sum-of-all-k-long-subarrays-i', { t: 'Find X-Sum of All K-Long Subarrays I', ...xsum });
  D('find-x-sum-of-all-k-long-subarrays-ii', { t: 'Find X-Sum of All K-Long Subarrays II', ...xsum });
  D('count-substrings-with-k-frequency-characters-i', { t: 'Count Substrings With K-Frequency Characters I', ...kfreq });
  D('count-substrings-with-k-frequency-characters-ii', { t: 'Count Substrings With K-Frequency Characters II', ...kfreq });

  D('minimum-positive-sum-subarray', {
    t: 'Minimum Positive Sum Subarray',
    r: 'For each window length L in [l, r], slide a window of that size keeping the sum; track the smallest positive sum. −1 if none.',
    g: R => { const a = R.ints(R.int(1, 7), -4, 5), l = R.int(1, a.length); return { nums: a, l, r: R.int(l, a.length) }; },
    s(I, T) { let best = Infinity; for (let L = I.l; L <= I.r; L++) { let here = Infinity; for (let i = 0; i + L <= I.nums.length; i++) { const s = I.nums.slice(i, i + L).reduce((a, b) => a + b, 0); if (s > 0) here = Math.min(here, s); } best = Math.min(best, here); T.at({ nums: A(I.nums), length: L }); T.n(`Smallest positive sum among length-${L} windows (0 if none)?`, here === Infinity ? 0 : here, 'Slide a fixed window.'); } return best === Infinity ? -1 : best; }
  });

  D('maximum-subarray-with-equal-products', {
    t: 'Maximum Subarray With Equal Products',
    r: 'A subarray is product-equivalent when prod = lcm times gcd. Extend each start rightwards maintaining prod, gcd and lcm (stop when prod clearly exceeds the bound) and keep the longest.',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 10) }),
    s(I, T) { const gcd = (a, b) => b ? gcd(b, a % b) : a; let best = 0; I.nums.forEach((_, i) => { let p = 1, g = 0, l = 1, here = 0; for (let j = i; j < I.nums.length; j++) { const x = I.nums[j]; p *= x; g = gcd(g, x); l = l / gcd(l, x) * x; if (p === g * l) here = j - i + 1; } best = Math.max(best, here); if (i < 6) { T.at({ nums: A(I.nums, here ? { win: [i, i + here - 1] } : { i }) }); T.n('Longest product-equivalent subarray starting here?', here, 'prod == lcm times gcd.'); } }); return best; }
  });

  D('minimum-operations-to-make-subarray-elements-equal', {
    t: 'Minimum Operations to Make Subarray Elements Equal',
    r: 'Making a window equal costs the sum of |x − median|. Slide a window of size k maintaining the median (two heaps or a sorted window) and the sums on each side; minimize.',
    g: R => { const a = R.ints(R.int(2, 8), -5, 9); return { nums: a, k: R.int(2, a.length) }; },
    s(I, T) { let best = Infinity; for (let i = 0; i + I.k <= I.nums.length; i++) { const w = I.nums.slice(i, i + I.k).sort((a, b) => a - b), m = w[I.k >> 1], c = w.reduce((s, v) => s + Math.abs(v - m), 0); best = Math.min(best, c); if (i < 5) { T.at({ nums: A(I.nums, { win: [i, i + I.k - 1] }), median: m }); T.n('Cost for this window?', c, 'the sum of |x − median|.'); } } return best; }
  });

  D('reschedule-meetings-for-maximum-free-time-i', {
    t: 'Reschedule Meetings for Maximum Free Time I',
    r: 'List the n + 1 free gaps (before, between, after meetings). Moving k meetings merges k + 1 consecutive gaps, so take the max sum of a window of k + 1 gaps.',
    g: R => { const n = R.int(1, 5), pts = R.distinct(2 * n, 0, 20).sort((a, b) => a - b); return { eventTime: R.int(pts[2 * n - 1], 22), k: R.int(1, n), startTime: pts.filter((_, i) => i % 2 === 0), endTime: pts.filter((_, i) => i % 2) }; },
    s(I, T) { const s = I.startTime, e = I.endTime, n = s.length, g = [s[0]]; for (let i = 1; i < n; i++) g.push(s[i] - e[i - 1]); g.push(I.eventTime - e[n - 1]); T.at({ gaps: A(g) }); T.n('How many gaps?', g.length, 'One more than the meetings.'); T.n('Total of all gaps?', g.reduce((a, b) => a + b, 0), 'Free time between meetings.'); const w = Math.min(I.k + 1, g.length); let best = 0; for (let i = 0; i + w <= g.length; i++) best = Math.max(best, g.slice(i, i + w).reduce((a, b) => a + b, 0)); T.n(`Best sum of ${w} consecutive gaps?`, best, 'Merge them by shifting k meetings.'); return best; }
  });

  D('maximum-difference-between-even-and-odd-frequency-ii', {
    t: 'Maximum Difference Between Even and Odd Frequency II',
    r: 'For each ordered pair (a, b) of digits, use prefix counts and parity states: for a right end, the best left start (at least k back, with b appearing inside) has the opposite parity of a and the same parity of b; minimize (cntA − cntB) at such starts.',
    g: R => { const s = R.str(R.int(3, 9), '0123'); return { s, k: R.int(1, s.length) }; },
    s(I, T) { const s = I.s; let best = -Infinity; for (const a of '01234') for (const b of '01234') { if (a === b) continue; let here = -Infinity; for (let i = 0; i < s.length; i++) for (let j = i + I.k - 1; j < s.length; j++) { const c = cnt(s.slice(i, j + 1)), fa = c[a] || 0, fb = c[b] || 0; if (fa % 2 === 1 && fb > 0 && fb % 2 === 0) here = Math.max(here, fa - fb); } if (here > -Infinity && (s.includes(a) && s.includes(b))) { T.at({ s: A([...s]), a, b, k: I.k }); T.n(`Best freq[${a}] − freq[${b}] (odd − even) for this pair?`, here, 'Over substrings of length at least k.'); } best = Math.max(best, here); } return best === -Infinity ? -1 : best; }
  });
})();
