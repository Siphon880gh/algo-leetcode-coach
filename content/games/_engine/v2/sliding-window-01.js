/* v2 games: sliding window (01). */
(function () {
  'use strict';
  const { D, A, K, Q } = LCGame.H;
  const floats = (o, e) => Array.isArray(o) && o.length === e.length && o.every((v, i) => Math.abs(v - e[i]) < 1e-5);
  const longestK = (I, T, k) => { const s = I.s, c = {}; let l = 0, best = 0, asks = 0; for (let r = 0; r < s.length; r++) { c[s[r]] = (c[s[r]] || 0) + 1; while (Object.keys(c).length > k) { if (!--c[s[l]]) delete c[s[l]]; l++; } best = Math.max(best, r - l + 1); if (asks++ < 8) { T.at({ s: A([...s], { win: [l, r] }), counts: K(c) }); T.n('Best length so far?', best, `Shrink until at most ${k} distinct.`); } } if (!s.length) { T.at({ s: '""' }); T.n('Length?', 0, 'Empty.'); } return best; };
  const atMost = (a, k, key) => { if (k < 0) return 0; const c = new Map(); let l = 0, tot = 0, d = 0; for (let r = 0; r < a.length; r++) { const x = key(a[r]); c.set(x, (c.get(x) || 0) + 1); if (c.get(x) === 1) d++; while (d > k) { const y = key(a[l]); c.set(y, c.get(y) - 1); if (!c.get(y)) d--; l++; } tot += r - l + 1; } return tot; };
  const atMostSum = (a, g) => { if (g < 0) return 0; let l = 0, s = 0, t = 0; for (let r = 0; r < a.length; r++) { s += a[r]; while (s > g) s -= a[l++]; t += r - l + 1; } return t; };

  D('substring-with-concatenation-of-all-words', {
    t: 'Substring with Concatenation of All Words',
    r: 'All words have length w. For each offset 0 to w−1, slide a window over word-sized chunks keeping chunk counts; shrink when a word is over-used, and record the start when the window holds exactly all words.',
    g: R => { const w = R.int(1, 2), words = Array.from({ length: R.int(1, 3) }, () => R.str(w, 'ab')); let s = R.str(R.int(0, 4), 'ab') + R.shuffle(words).join('') + R.str(R.int(0, 4), 'ab'); return { s, words }; },
    cmp: 'set',
    s(I, T) { const w = I.words[0].length, n = I.words.length, need = {}; I.words.forEach(x => need[x] = (need[x] || 0) + 1); const out = []; let asks = 0; for (let i = 0; i + w * n <= I.s.length; i++) { const seen = {}; let ok = true; for (let j = 0; j < n; j++) { const x = I.s.substr(i + j * w, w); seen[x] = (seen[x] || 0) + 1; if (!need[x] || seen[x] > need[x]) { ok = false; break; } } if (asks++ < 7) { T.at({ s: A([...I.s], { win: [i, i + w * n - 1] }), words: A(I.words) }); T.yn(`Is the window at ${i} a concatenation of all words?`, ok, 'Chunk counts must match exactly.'); } if (ok) out.push(i); } return out; }
  });

  D('longest-substring-with-at-most-two-distinct-characters', {
    t: 'Longest Substring with At Most Two Distinct Characters',
    r: 'Grow the window to the right, counting characters; while more than 2 distinct are inside, shrink from the left. Track the longest window.',
    g: R => ({ s: R.str(R.int(1, 10), 'abc') }),
    s(I, T) { return longestK(I, T, 2); }
  });

  D('repeated-dna-sequences', {
    t: 'Repeated DNA Sequences',
    r: 'Slide a length-10 window (rolling hash or 2-bit encoding); record windows seen once in a set and output those seen a second time.',
    g: R => { const unit = R.str(R.int(2, 5), 'ACGT'); return { s: (unit.repeat(R.int(2, 6)) + R.str(R.int(0, 6), 'ACGT')).slice(0, 30) }; },
    cmp: 'set',
    s(I, T) { const seen = new Set(), out = new Set(); let asks = 0; for (let i = 0; i + 10 <= I.s.length; i++) { const w = I.s.slice(i, i + 10), dup = seen.has(w); if (dup) out.add(w); seen.add(w); if (asks++ < 6 || (dup && asks < 10)) { T.at({ window: w, index: i }); T.yn('Seen this 10-letter window before?', dup, 'Set lookup.'); } } if (!asks) { T.at({ s: I.s }); T.n('Windows of length 10?', 0, 'String shorter than 10.'); } return [...out]; }
  });

  D('contains-duplicate-ii', {
    t: 'Contains Duplicate II',
    r: 'Keep a set of the last k values (a window). For each new value, a hit means a duplicate within distance k; then add it and evict the value that falls out.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 5), k: R.int(0, 3) }),
    s(I, T) { const w = new Set(); for (const [i, x] of I.nums.entries()) { const hit = w.has(x); if (i < 8) { T.at({ nums: A(I.nums, { win: [Math.max(0, i - I.k), i] }), window: A([...w]) }); T.yn(`Is ${x} already in the window?`, hit, `Window holds the last ${I.k} values.`); } if (hit) return true; w.add(x); if (w.size > I.k) w.delete(I.nums[i - I.k]); } return false; }
  });

  D('contains-duplicate-iii', {
    t: 'Contains Duplicate III',
    r: 'Bucket values by width valueDiff + 1 over a window of the last indexDiff elements: same bucket means a hit; neighbor buckets need an explicit difference check.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 12), indexDiff: R.int(1, 3), valueDiff: R.int(0, 3) }),
    s(I, T) { const a = I.nums; for (let j = 0; j < a.length; j++) { let hit = false; for (let i = Math.max(0, j - I.indexDiff); i < j; i++) if (Math.abs(a[i] - a[j]) <= I.valueDiff) hit = true; if (j < 8) { T.at({ nums: A(a, { win: [Math.max(0, j - I.indexDiff), j] }), valueDiff: I.valueDiff }); T.yn(`Is some value in the window within ${I.valueDiff} of ${a[j]}?`, hit, 'Buckets of width valueDiff + 1.'); } if (hit) return true; } return false; }
  });

  D('sliding-window-maximum', {
    t: 'Sliding Window Maximum',
    r: 'Keep a deque of indices with decreasing values. Pop smaller values from the back before pushing, pop the front when it leaves the window; the front is the window max.',
    g: R => { const a = R.ints(R.int(1, 9), -5, 9); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { const a = I.nums, dq = [], out = []; for (let i = 0; i < a.length; i++) { while (dq.length && a[dq[dq.length - 1]] <= a[i]) dq.pop(); dq.push(i); if (dq[0] <= i - I.k) dq.shift(); if (i >= I.k - 1) { out.push(a[dq[0]]); if (out.length <= 6) { T.at({ nums: A(a, { win: [i - I.k + 1, i] }), deque: Q(dq.map(j => a[j])) }); T.n('Window maximum?', a[dq[0]], 'Front of the decreasing deque.'); } } } return out; }
  });

  D('longest-substring-with-at-most-k-distinct-characters', {
    t: 'Longest Substring with At Most K Distinct Characters',
    r: 'Expand right while counting characters; while more than k distinct are inside, shrink from the left. The longest valid window is the answer.',
    g: R => ({ s: R.str(R.int(0, 10), 'abcd'), k: R.int(0, 3) }),
    s(I, T) { return longestK(I, T, I.k); }
  });

  D('longest-substring-with-at-least-k-repeating-characters', {
    t: 'Longest Substring with At Least K Repeating Characters',
    r: 'For each target number of unique letters u = 1 to 26, slide a window that keeps at most u unique letters and track how many reach count k. Windows with unique == u == "at least k" are valid.',
    g: R => ({ s: R.str(R.int(1, 10), 'abc'), k: R.int(1, 3) }),
    s(I, T) { const s = I.s; let best = 0; const U = new Set(s).size; for (let u = 1; u <= U; u++) { const c = {}; let l = 0, uniq = 0, ok = 0; for (let r = 0; r < s.length; r++) { c[s[r]] = (c[s[r]] || 0) + 1; if (c[s[r]] === 1) uniq++; if (c[s[r]] === I.k) ok++; while (uniq > u) { if (c[s[l]] === I.k) ok--; c[s[l]]--; if (!c[s[l]]) uniq--; l++; } if (uniq === u && ok === u) best = Math.max(best, r - l + 1); } T.at({ s: A([...s]), uniqueTarget: u, k: I.k }); T.n(`Best length so far (after trying ${u} unique)?`, best, 'Windows where every letter appears at least k times.'); } return best; }
  });

  D('sliding-window-median', {
    t: 'Sliding Window Median',
    r: 'Maintain two balanced heaps (or a sorted window): insert the new value, remove the outgoing one, and read the median — the middle, or the average of the two middles for even k.',
    g: R => { const a = R.ints(R.int(1, 8), -5, 9); return { nums: a, k: R.int(1, a.length) }; },
    cmp: floats,
    s(I, T) { const out = []; for (let i = 0; i + I.k <= I.nums.length; i++) { const w = I.nums.slice(i, i + I.k).sort((x, y) => x - y), m = I.k % 2 ? w[I.k >> 1] : (w[I.k / 2 - 1] + w[I.k / 2]) / 2; out.push(m); if (i < 6) { T.at({ nums: A(I.nums, { win: [i, i + I.k - 1] }), sorted: A(w) }); T.n('Window median?', m, 'Middle (or mean of two middles).'); } } return out; }
  });

  D('smallest-range-covering-elements-from-k-lists', {
    t: 'Smallest Range Covering Elements from K Lists',
    r: 'Put the first element of each list in a min-heap and track the current max. The range [heap min, max] covers all lists; pop the min, push its successor, update; stop when a list runs out.',
    g: R => ({ nums: Array.from({ length: R.int(1, 3) }, () => R.sorted(R.int(1, 4), 0, 20)) }),
    s(I, T) { const L = I.nums, idx = L.map(() => 0); let best = null, asks = 0; for (;;) { const vals = L.map((l, i) => l[idx[i]]), lo = Math.min(...vals), hi = Math.max(...vals); if (!best || hi - lo < best[1] - best[0] || (hi - lo === best[1] - best[0] && lo < best[0])) best = [lo, hi]; if (asks++ < 7) { T.at({ current: A(vals), best: best.join(' to ') }); T.n('Current range width (max − min)?', hi - lo, 'All lists are covered.'); } const k = vals.indexOf(lo); if (++idx[k] >= L[k].length) break; } return best; }
  });

  D('longest-continuous-increasing-subsequence', {
    t: 'Longest Continuous Increasing Subsequence',
    r: 'Scan once: extend the current run while nums[i] > nums[i − 1], otherwise restart it at length 1. Track the longest run.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 9) }),
    s(I, T) { let cur = 1, best = 1; for (let i = 1; i < I.nums.length; i++) { cur = I.nums[i] > I.nums[i - 1] ? cur + 1 : 1; best = Math.max(best, cur); if (i < 9) { T.at({ nums: A(I.nums, { win: [i - cur + 1, i] }) }); T.n('Current run length?', cur, 'Reset when not strictly increasing.'); } } return best; }
  });

  D('k-empty-slots', {
    t: 'K Empty Slots',
    r: 'Let days[x] be the day bulb x turns on. Slide a window [l, l + k + 1]: it works if every bulb strictly inside turns on later than both ends; the answer is the earliest max(days[l], days[r]).',
    g: R => { const n = R.int(2, 8); return { bulbs: R.shuffle([...Array(n).keys()].map(x => x + 1)), k: R.int(0, 2) }; },
    s(I, T) { const n = I.bulbs.length, day = Array(n + 1); I.bulbs.forEach((b, i) => day[b] = i + 1); let best = Infinity, asks = 0; for (let l = 1; l + I.k + 1 <= n; l++) { const r = l + I.k + 1; let ok = true; for (let x = l + 1; x < r; x++) if (day[x] < Math.max(day[l], day[r])) ok = false; if (asks++ < 6) { T.at({ days: A(day.slice(1), { win: [l - 1, r - 1] }) }); T.yn('Do both ends turn on before everything inside?', ok, 'Then they bracket k dark bulbs.'); } if (ok) best = Math.min(best, Math.max(day[l], day[r])); } return best === Infinity ? -1 : best; }
  });

  D('subarray-product-less-than-k', {
    t: 'Subarray Product Less Than K',
    r: 'Grow the window to the right multiplying the product; while product at least k, divide out from the left. Each right end adds r − l + 1 subarrays.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6), k: R.int(0, 30) }),
    s(I, T) { if (I.k <= 1) { T.at({ k: I.k }); T.yn('Can any product of positive integers be < k?', false, 'k at most 1.'); return 0; } let l = 0, p = 1, c = 0; I.nums.forEach((x, r) => { p *= x; while (p >= I.k) p /= I.nums[l++]; c += r - l + 1; if (r < 8) { T.at({ nums: A(I.nums, { win: [l, r] }), product: p }); T.n('Total count so far?', c, 'Add r − l + 1.'); } }); return c; }
  });

  D('shortest-subarray-with-sum-at-least-k', {
    t: 'Shortest Subarray with Sum at Least K',
    r: 'Prefix sums P with a deque of increasing P values. For each j, pop from the front while P[j] − P[front] at least k (record length); pop from the back while P[back] at least P[j]; push j.',
    g: R => ({ nums: R.ints(R.int(1, 8), -3, 6), k: R.int(1, 10) }),
    s(I, T) { const P = [0]; I.nums.forEach(x => P.push(P[P.length - 1] + x)); const dq = []; let best = Infinity, asks = 0; for (let j = 0; j < P.length; j++) { while (dq.length && P[j] - P[dq[0]] >= I.k) best = Math.min(best, j - dq.shift()); while (dq.length && P[dq[dq.length - 1]] >= P[j]) dq.pop(); dq.push(j); if (j && asks++ < 7) { T.at({ prefix: A(P, { j }), deque: Q(dq.slice()) }); T.n('Shortest length so far (0 if none)?', best === Infinity ? 0 : best, 'Pop fronts that reach k.'); } } return best === Infinity ? -1 : best; }
  });

  D('binary-subarrays-with-sum', {
    t: 'Binary Subarrays With Sum',
    r: 'Count = atMost(goal) − atMost(goal − 1), where atMost(g) slides a window keeping the sum at most g and adds r − l + 1 per right end.',
    g: R => ({ nums: R.ints(R.int(1, 9), 0, 1), goal: R.int(0, 3) }),
    s(I, T) { const res = (() => { const a = atMostSum(I.nums, I.goal), b = atMostSum(I.nums, I.goal - 1); T.at({ nums: A(I.nums), goal: I.goal }); T.n(`Subarrays with sum at most ${I.goal}?`, a, 'Sliding window count.'); T.n(`Subarrays with sum at most ${I.goal - 1}?`, b, 'Same with goal minus 1.'); return a - b; })(); T.n(`Subarrays with sum exactly ${I.goal}?`, res, 'Subtract the two counts.'); return res; }
  });

  D('subarrays-with-k-different-integers', {
    t: 'Subarrays with K Different Integers',
    r: 'exactly(k) = atMost(k) − atMost(k − 1); atMost slides a window with at most k distinct values and adds r − l + 1 per right end.',
    g: R => { const a = R.ints(R.int(1, 8), 1, 3); return { nums: a, k: R.int(1, 3) }; },
    s(I, T) { const res = (() => { const id = x => x, a = atMost(I.nums, I.k, id), b = atMost(I.nums, I.k - 1, id); T.at({ nums: A(I.nums), k: I.k }); T.n(`Subarrays with at most ${I.k} distinct?`, a, 'Sliding window.'); T.n(`With at most ${I.k - 1}?`, b, 'Subtract these.'); return a - b; })(); T.n(`Subarrays with exactly ${I.k} distinct?`, res, 'Subtract the two counts.'); return res; }
  });

  D('minimum-number-of-k-consecutive-bit-flips', {
    t: 'Minimum Number of K Consecutive Bit Flips',
    r: 'Greedy left to right: the current bit\'s value is nums[i] XOR (number of active flips covering i) mod 2. If it is 0, start a flip at i (impossible if i + k > n). Track when flips expire.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 1), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, end = Array(n + 1).fill(0); let act = 0, c = 0, asks = 0; for (let i = 0; i < n; i++) { act -= end[i]; const bit = a[i] ^ (act & 1); if (asks++ < 8) { T.at({ nums: A(a, { i }), activeFlips: act }); T.yn('Must we start a flip here?', bit === 0, 'Effective bit is 0.'); } if (!bit) { if (i + I.k > n) return -1; c++; act++; end[i + I.k]++; } } return c; }
  });

  D('moving-stones-until-consecutive-ii', {
    t: 'Moving Stones Until Consecutive II',
    r: 'Sort. Max moves = max(s[n−1] − s[1], s[n−2] − s[0]) − n + 2 (fill gaps from one end). Min: slide a window of span < n; it needs n − (stones inside) moves, except the special case of n − 1 consecutive stones with one far away, which needs 2.',
    g: R => ({ stones: R.distinct(R.int(3, 6), 1, 15) }),
    s(I, T) { const s = I.stones.slice().sort((a, b) => a - b), n = s.length, hi = Math.max(s[n - 1] - s[1], s[n - 2] - s[0]) - n + 2; T.at({ stones: A(s) }); T.n('Empty slots between the first and last stone?', s[n - 1] - s[0] + 1 - n, 'Span minus the stones.'); T.n('Maximum moves?', hi, 'Fill all gaps except at one end.'); let lo = n, i = 0; for (let j = 0; j < n; j++) { while (s[j] - s[i] >= n) i++; const k = j - i + 1; if (k === n - 1 && s[j] - s[i] === n - 2) lo = Math.min(lo, 2); else lo = Math.min(lo, n - k); } T.n('Minimum moves?', lo, 'Best window with a span less than n.'); return [lo, hi]; }
  });

  D('grumpy-bookstore-owner', {
    t: 'Grumpy Bookstore Owner',
    r: 'Customers in non-grumpy minutes are always satisfied. Slide a window of length `minutes` maximizing the extra customers from grumpy minutes inside it; add that to the base.',
    g: R => { const n = R.int(1, 8); return { customers: R.ints(n, 0, 9), grumpy: R.ints(n, 0, 1), minutes: R.int(1, n) }; },
    s(I, T) { const c = I.customers, g = I.grumpy, base = c.reduce((s, x, i) => s + (g[i] ? 0 : x), 0); T.at({ customers: A(c), grumpy: A(g) }); T.n('Customers satisfied without the technique?', base, 'Non-grumpy minutes.'); let w = 0, best = 0; for (let i = 0; i < c.length; i++) { if (g[i]) w += c[i]; if (i >= I.minutes && g[i - I.minutes]) w -= c[i - I.minutes]; best = Math.max(best, w); if (i >= I.minutes - 1 && i < I.minutes + 4) { T.at({ customers: A(c, { win: [i - I.minutes + 1, i] }) }); T.n('Extra customers recovered in this window?', w, 'Grumpy minutes inside.'); } } return base + best; }
  });

  D('find-k-length-substrings-with-no-repeated-characters', {
    t: 'Find K-Length Substrings With No Repeated Characters',
    r: 'Slide a window, shrinking from the left when a duplicate enters or the length exceeds k; count right ends where the window length equals k.',
    g: R => ({ s: R.str(R.int(1, 10), 'abcd'), k: R.int(1, 4) }),
    s(I, T) { const s = I.s, c = {}; let l = 0, n = 0, asks = 0; for (let r = 0; r < s.length; r++) { c[s[r]] = (c[s[r]] || 0) + 1; while (c[s[r]] > 1 || r - l + 1 > I.k) c[s[l++]]--; if (r - l + 1 === I.k) n++; if (asks++ < 8) { T.at({ s: A([...s], { win: [l, r] }), k: I.k }); T.n('Count so far?', n, 'Window of k unique characters.'); } } return n; }
  });

  D('minimum-swaps-to-group-all-1s-together', {
    t: 'Minimum Swaps to Group All 1\'s Together',
    r: 'Let w = number of ones. Slide a window of length w; the best window contains the most ones, and swaps = w − maxOnesInWindow.',
    g: R => ({ data: R.ints(R.int(1, 10), 0, 1) }),
    s(I, T) { const d = I.data, w = d.filter(x => x).length; T.at({ data: A(d) }); T.n('Window length (number of ones)?', w, 'All ones must fit in it.'); if (!w) return 0; let cur = 0, best = 0; for (let i = 0; i < d.length; i++) { cur += d[i]; if (i >= w) cur -= d[i - w]; if (i >= w - 1) { best = Math.max(best, cur); if (i < w + 4) { T.at({ data: A(d, { win: [i - w + 1, i] }) }); T.n('Ones in this window?', cur, 'Slide by one.'); } } } return w - best; }
  });

  D('swap-for-longest-repeated-character-substring', {
    t: 'Swap For Longest Repeated Character Substring',
    r: 'Compress into runs. A run can grow by 1 if that letter exists elsewhere; two runs of the same letter separated by one other character can merge (+1 if a third copy exists). Cap by the letter\'s total count.',
    g: R => ({ text: R.str(R.int(1, 10), 'aab') }),
    s(I, T) { const t = I.text, cnt = {}; for (const ch of t) cnt[ch] = (cnt[ch] || 0) + 1; const runs = []; for (const ch of t) { if (runs.length && runs[runs.length - 1][0] === ch) runs[runs.length - 1][1]++; else runs.push([ch, 1]); } T.at({ runs: A(runs.map(([c, k]) => `${k} of ${c}`)) }); T.n('Different letters in the text?', Object.keys(cnt).length, 'A swap needs another copy of the same letter.'); T.n('How many runs?', runs.length, 'Group equal neighbors.'); let best = 0; runs.forEach(([c, k], i) => { best = Math.max(best, Math.min(k + 1, cnt[c])); if (i + 2 < runs.length && runs[i + 1][1] === 1 && runs[i + 2][0] === c) best = Math.max(best, Math.min(k + runs[i + 2][1] + 1, cnt[c])); }); T.n('Longest after one swap?', best, 'Extend a run or merge across a single gap.'); return best; }
  });

  D('diet-plan-performance', {
    t: 'Diet Plan Performance',
    r: 'Slide a window of k days keeping the sum; each window scores −1 if below lower, +1 if above upper, else 0.',
    g: R => { const c = R.ints(R.int(1, 8), 0, 6); return { calories: c, k: R.int(1, c.length), lower: R.int(2, 8), upper: R.int(8, 14) }; },
    s(I, T) { let s = 0, pts = 0, asks = 0; I.calories.forEach((x, i) => { s += x; if (i >= I.k) s -= I.calories[i - I.k]; if (i >= I.k - 1) { const d = s < I.lower ? -1 : s > I.upper ? 1 : 0; pts += d; if (asks++ < 6) { T.at({ calories: A(I.calories, { win: [i - I.k + 1, i] }), sum: s, lower: I.lower, upper: I.upper }); T.n('Points for this window?', d, 'Below lower −1, above upper +1.'); } } }); return pts; }
  });

  D('get-equal-substrings-within-budget', {
    t: 'Get Equal Substrings Within Budget',
    r: 'cost[i] = |s[i] − t[i]|. Find the longest window with total cost at most maxCost: extend right, shrink left while over budget.',
    g: R => { const n = R.int(1, 8); return { s: R.str(n, 'abcd'), t: R.str(n, 'abcd'), maxCost: R.int(0, 5) }; },
    s(I, T) { const c = [...I.s].map((x, i) => Math.abs(x.charCodeAt(0) - I.t.charCodeAt(i))); let l = 0, sum = 0, best = 0; c.forEach((x, r) => { sum += x; while (sum > I.maxCost) sum -= c[l++]; best = Math.max(best, r - l + 1); if (r < 8) { T.at({ cost: A(c, { win: [l, r] }), budget: I.maxCost }); T.n('Longest so far?', best, 'Shrink while over budget.'); } }); return best; }
  });

  D('replace-the-substring-for-balanced-string', {
    t: 'Replace the Substring for Balanced String',
    r: 'Each letter should appear n divided by 4 times. Find the shortest window such that the counts OUTSIDE it are all at most n divided by 4 — replacing the window then fixes everything.',
    g: R => ({ s: R.str(4 * R.int(1, 3), 'QWER') }),
    s(I, T) { const s = I.s, n = s.length, q = n / 4, c = { Q: 0, W: 0, E: 0, R: 0 }; for (const ch of s) c[ch]++; const ok = () => 'QWER'.split('').every(x => c[x] <= q); T.at({ counts: K(c), target: q }); T.yn('Already balanced?', ok(), 'Every letter at most n divided by 4.'); if (ok()) return 0; let l = 0, best = n, asks = 0; for (let r = 0; r < n; r++) { c[s[r]]--; while (l < n && ok()) { best = Math.min(best, r - l + 1); if (asks++ < 6) { T.at({ s: A([...s], { win: [l, r] }), outside: K({ ...c }) }); T.n('Shortest valid window so far?', best, 'Outside counts all at most n divided by 4.'); } c[s[l++]]++; } } return best; }
  });

  D('count-number-of-nice-subarrays', {
    t: 'Count Number of Nice Subarrays',
    r: 'Map each number to 1 if odd else 0; then it is "subarrays with sum exactly k" = atMost(k) − atMost(k − 1).',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 9), k: R.int(1, 3) }),
    s(I, T) { const res = (() => { const b = I.nums.map(x => x % 2), a = atMostSum(b, I.k), c = atMostSum(b, I.k - 1); T.at({ odd: A(b), k: I.k }); T.n(`Subarrays with at most ${I.k} odd numbers?`, a, 'Sliding window.'); T.n(`Subarrays with at most ${I.k - 1} odd numbers?`, c, 'Subtract these.'); return a - c; })(); T.n(`Subarrays with exactly ${I.k} odd numbers?`, res, 'Subtract the two counts.'); return res; }
  });

  D('maximum-number-of-occurrences-of-a-substring', {
    t: 'Maximum Number of Occurrences of a Substring',
    r: 'A longer valid substring\'s occurrences contain those of its minSize prefix, so only length minSize matters. Count each window of length minSize with at most maxLetters distinct letters.',
    g: R => { const a = R.int(1, 3); return { s: R.str(R.int(2, 10), 'aab'), maxLetters: R.int(1, 3), minSize: a, maxSize: a + R.int(0, 2) }; },
    s(I, T) { const c = new Map(); let asks = 0; for (let i = 0; i + I.minSize <= I.s.length; i++) { const w = I.s.substr(i, I.minSize), ok = new Set(w).size <= I.maxLetters; if (ok) c.set(w, (c.get(w) || 0) + 1); if (asks++ < 6) { T.at({ window: w, maxLetters: I.maxLetters }); T.yn('Valid substring?', ok, 'Distinct letters at most maxLetters.'); } } return Math.max(0, ...c.values()); }
  });

  D('number-of-sub-arrays-of-size-k-and-average-greater-than-or-equal-to-threshold', {
    t: 'Number of Sub-arrays of Size K and Average Greater than or Equal to Threshold',
    r: 'Compare window sums with k times threshold (no division). Slide the fixed-size window and count qualifying sums.',
    g: R => { const a = R.ints(R.int(1, 9), 1, 9); return { arr: a, k: R.int(1, a.length), threshold: R.int(2, 7) }; },
    s(I, T) { let s = 0, c = 0, asks = 0; I.arr.forEach((x, i) => { s += x; if (i >= I.k) s -= I.arr[i - I.k]; if (i >= I.k - 1) { const ok = s >= I.k * I.threshold; if (ok) c++; if (asks++ < 6) { T.at({ arr: A(I.arr, { win: [i - I.k + 1, i] }), need: I.k * I.threshold }); T.yn('Window sum at least k times threshold?', ok, `Sum ${s}.`); } } }); return c; }
  });

  D('number-of-substrings-containing-all-three-characters', {
    t: 'Number of Substrings Containing All Three Characters',
    r: 'For each right end, shrink the left while the window still has a, b and c; then every start before l works — add l.',
    g: R => ({ s: R.str(R.int(3, 10), 'abc') }),
    s(I, T) { const c = { a: 0, b: 0, c: 0 }; let l = 0, n = 0; [...I.s].forEach((ch, r) => { c[ch]++; while (c.a && c.b && c.c) c[I.s[l++]]--; n += l; if (r < 9) { T.at({ s: A([...I.s], { win: [l, r] }) }); T.n('Count so far?', n, 'Add l: starts 0 to l−1 all contain a, b and c.'); } }); return n; }
  });

  D('maximum-points-you-can-obtain-from-cards', {
    t: 'Maximum Points You Can Obtain from Cards',
    r: 'Taking k cards from the ends leaves a contiguous middle of n − k cards. Minimize that middle window\'s sum; answer = total − min window.',
    g: R => { const a = R.ints(R.int(1, 8), 1, 9); return { cardPoints: a, k: R.int(1, a.length) }; },
    s(I, T) { const res = (() => { const a = I.cardPoints, n = a.length, w = n - I.k, tot = a.reduce((x, y) => x + y, 0); T.at({ cards: A(a), k: I.k }); T.n('Length of the window left behind?', w, 'n minus k.'); if (!w) { T.n('Sum of all cards?', tot, 'You take every card.'); return tot; } let s = a.slice(0, w).reduce((x, y) => x + y, 0), mn = s; for (let i = w; i < n; i++) { s += a[i] - a[i - w]; mn = Math.min(mn, s); } T.n('Smallest middle-window sum?', mn, 'Slide it across.'); return tot - mn; })(); T.n('Maximum points?', res, 'Total minus the smallest middle window.'); return res; }
  });

  D('longest-continuous-subarray-with-absolute-diff-less-than-or-equal-to-limit', {
    t: 'Longest Continuous Subarray With Absolute Diff Less Than or Equal to Limit',
    r: 'Keep a decreasing deque (window max) and an increasing deque (window min). While max − min > limit, move l and drop deque fronts that leave.',
    g: R => ({ nums: R.ints(R.int(1, 9), 1, 9), limit: R.int(0, 5) }),
    s(I, T) { const a = I.nums, mx = [], mn = []; let l = 0, best = 0; for (let r = 0; r < a.length; r++) { while (mx.length && a[mx[mx.length - 1]] < a[r]) mx.pop(); mx.push(r); while (mn.length && a[mn[mn.length - 1]] > a[r]) mn.pop(); mn.push(r); while (a[mx[0]] - a[mn[0]] > I.limit) { l++; if (mx[0] < l) mx.shift(); if (mn[0] < l) mn.shift(); } best = Math.max(best, r - l + 1); if (r < 8) { T.at({ nums: A(a, { win: [l, r] }), max: a[mx[0]], min: a[mn[0]] }); T.n('Longest so far?', best, 'Shrink while max − min > limit.'); } } return best; }
  });

  D('check-if-a-string-contains-all-binary-codes-of-size-k', {
    t: 'Check If a String Contains All Binary Codes of Size K',
    r: 'Slide a length-k window (rolling bitmask), adding each code to a set. All codes present exactly when the set size reaches 2 to the power k.',
    g: R => ({ s: R.str(R.int(1, 12), '01'), k: R.int(1, 3) }),
    s(I, T) { const res = (() => { const S = new Set(); for (let i = 0; i + I.k <= I.s.length; i++) S.add(I.s.substr(i, I.k)); T.at({ s: I.s, k: I.k }); T.n('Distinct codes seen?', S.size, 'Set of windows.'); T.n('Codes needed?', 1 << I.k, '2 to the power k.'); return S.size === 1 << I.k; })(); T.yn('Are all codes present?', res, 'Seen must equal needed.'); return res; }
  });

  D('max-value-of-equation', {
    t: 'Max Value of Equation',
    r: 'For i < j, yi + yj + |xi − xj| = (yi − xi) + (yj + xj). Keep a deque of earlier points with decreasing yi − xi, dropping those with xj − xi > k; the front gives the best partner.',
    g: R => { const xs = R.distinct(R.int(2, 6), 0, 12).sort((a, b) => a - b); return { points: xs.map(x => [x, R.int(-5, 9)]), k: R.int(1, 5) }; },
    s(I, T) { const P = I.points; let dq = [], best = -Infinity, asks = 0; for (const [x, y] of P) { while (dq.length && x - dq[0][0] > I.k) dq.shift(); if (dq.length) { const v = dq[0][1] - dq[0][0] + y + x; best = Math.max(best, v); if (asks++ < 6) { T.at({ point: `${x},${y}`, partner: dq[0].join(',') }); T.n('Equation value with the best partner?', v, '(yi − xi) + (yj + xj).'); } } while (dq.length && dq[dq.length - 1][1] - dq[dq.length - 1][0] <= y - x) dq.pop(); dq.push([x, y]); } if (best === -Infinity) { T.at({ points: A(P.map(p => p.join(','))), k: I.k }); T.yn('Is there any valid pair?', false, 'Guaranteed in the real problem.'); return -1; } return best; }
  });

  D('maximum-number-of-visible-points', {
    t: 'Maximum Number of Visible Points',
    r: 'Points at your location are always visible. Convert the others to polar angles, sort, append each + 360°, and slide a window of width `angle` to find the most angles inside.',
    g: R => ({ points: Array.from({ length: R.int(1, 6) }, () => [R.int(0, 4), R.int(0, 4)]), angle: R.pick([0, 45, 90, 180]), location: [R.int(0, 4), R.int(0, 4)] }),
    s(I, T) { const res = (() => { let same = 0; const ang = []; for (const [x, y] of I.points) { if (x === I.location[0] && y === I.location[1]) same++; else ang.push(Math.atan2(y - I.location[1], x - I.location[0]) * 180 / Math.PI); } ang.sort((a, b) => a - b); const all = [...ang, ...ang.map(a => a + 360)]; let l = 0, best = 0; for (let r = 0; r < all.length; r++) { while (all[r] - all[l] > I.angle + 1e-9) l++; best = Math.max(best, r - l + 1); } best = Math.min(best, ang.length); T.at({ location: I.location.join(', '), angle: I.angle }); T.n('Points standing at your location?', same, 'Always visible.'); T.n('Most other points inside one view window?', best, 'Sliding window over sorted angles.'); return best + same; })(); T.n('Most visible points?', res, 'Best window plus the points at your location.'); return res; }
  });

  D('defuse-the-bomb', {
    t: 'Defuse the Bomb',
    r: 'Circular sliding window of size |k|: for k > 0 sum the next k values, for k < 0 the previous |k|, for k = 0 all zeros. Maintain the window sum as i moves.',
    g: R => { const n = R.int(1, 7); return { code: R.ints(n, 1, 9), k: R.int(-(n - 1), n - 1) }; },
    s(I, T) { const c = I.code, n = c.length; return c.map((_, i) => { let s = 0; if (I.k > 0) for (let j = 1; j <= I.k; j++) s += c[(i + j) % n]; else for (let j = 1; j <= -I.k; j++) s += c[(i - j + n) % n]; if (i < 5) { T.at({ code: A(c, { i }), k: I.k }); T.n(`Decrypted value at ${i}?`, s, I.k > 0 ? 'Next k values.' : I.k < 0 ? 'Previous |k| values.' : 'k = 0: 0.'); } return s; }); }
  });

  D('minimum-operations-to-reduce-x-to-zero', {
    t: 'Minimum Operations to Reduce X to Zero',
    r: 'Removing from both ends leaves a middle subarray with sum total − x. Find the longest such window (all values positive: sliding window); answer = n − its length, or −1.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 5), x: R.int(1, 15) }),
    s(I, T) { const res = (() => { const a = I.nums, tgt = a.reduce((s, v) => s + v, 0) - I.x; T.at({ nums: A(a), x: I.x }); T.n('Total of nums?', a.reduce((s, v) => s + v, 0), 'Add every value.'); T.n('Target sum for the kept middle?', tgt, 'Total minus x.'); if (tgt < 0) return -1; let l = 0, s = 0, best = -1; for (let r = 0; r < a.length; r++) { s += a[r]; while (s > tgt && l <= r) s -= a[l++]; if (s === tgt) best = Math.max(best, r - l + 1); } if (tgt === 0) best = Math.max(best, 0); T.n('Longest middle window with that sum? (−1 if none)', best, 'Sliding window on positives.'); return best < 0 ? -1 : a.length - best; })(); T.n('Fewest operations? (−1 if impossible)', res, 'n minus the longest middle window.'); return res; }
  });

  D('minimum-adjacent-swaps-for-k-consecutive-ones', {
    t: 'Minimum Adjacent Swaps for K Consecutive Ones',
    r: 'Take positions p of the ones and set q[i] = p[i] − i (gathering becomes "make q equal"). For each window of k consecutive q values, the cost is the sum of |q − median|; slide with prefix sums and take the minimum.',
    g: R => { const a = R.ints(R.int(2, 10), 0, 1); if (a.filter(x => x).length < 1) a[0] = 1; return { nums: a, k: R.int(1, a.filter(x => x).length) }; },
    s(I, T) { const p = []; I.nums.forEach((v, i) => v && p.push(i)); const q = p.map((x, i) => x - i); T.at({ positions: A(p), shifted: A(q) }); T.n('Number of ones?', p.length, 'Positions list.'); let best = Infinity; for (let i = 0; i + I.k <= q.length; i++) { const w = q.slice(i, i + I.k), m = w[I.k >> 1], c = w.reduce((s, v) => s + Math.abs(v - m), 0); best = Math.min(best, c); if (i < 4) { T.at({ window: A(w), median: m }); T.n('Cost of this window?', c, 'the sum of |q − median|.'); } } return best; }
  });

  D('frequency-of-the-most-frequent-element', {
    t: 'Frequency of the Most Frequent Element',
    r: 'Sort. A window can be raised to its max a[r] at cost a[r] times len − sum. Slide: while cost > k, shrink from the left. The longest window is the answer.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9), k: R.int(0, 8) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let l = 0, s = 0, best = 0; a.forEach((x, r) => { s += x; while (x * (r - l + 1) - s > I.k) s -= a[l++]; best = Math.max(best, r - l + 1); if (r < 8) { T.at({ sorted: A(a, { win: [l, r] }), k: I.k }); T.n('Best frequency so far?', best, 'Shrink while raising costs more than k.'); } }); return best; }
  });

  D('longest-substring-of-all-vowels-in-order', {
    t: 'Longest Substring Of All Vowels in Order',
    r: 'Scan once: a character smaller than the previous restarts the window; count distinct vowels in the current non-decreasing run; when it reaches 5, record the length.',
    g: R => ({ word: Array.from({ length: R.int(1, 3) }, () => [...R.str(R.int(1, 8), 'aeiou')].sort().join('')).join('') }),
    s(I, T) { const w = I.word; let l = 0, kinds = 1, best = 0, asks = 0; for (let r = 1; r < w.length; r++) { if (w[r] < w[r - 1]) { l = r; kinds = 1; } else if (w[r] > w[r - 1]) kinds++; if (kinds === 5) best = Math.max(best, r - l + 1); if (asks++ < 8) { T.at({ word: A([...w], { win: [l, r] }) }); T.n('Distinct vowels in the current run?', kinds, 'Restart when the order breaks.'); } } return best; }
  });

  D('distinct-numbers-in-each-subarray', {
    t: 'Distinct Numbers in Each Subarray',
    r: 'Slide a window of size k with a count map: add the incoming value, decrement the outgoing one (deleting at 0); the map size is each answer.',
    g: R => { const a = R.ints(R.int(1, 9), 1, 4); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { const c = new Map(), out = []; I.nums.forEach((x, i) => { c.set(x, (c.get(x) || 0) + 1); if (i >= I.k) { const y = I.nums[i - I.k]; c.set(y, c.get(y) - 1); if (!c.get(y)) c.delete(y); } if (i >= I.k - 1) { out.push(c.size); if (out.length <= 6) { T.at({ nums: A(I.nums, { win: [i - I.k + 1, i] }) }); T.n('Distinct values in the window?', c.size, 'Size of the count map.'); } } }); return out; }
  });

  D('substrings-of-size-three-with-distinct-characters', {
    t: 'Substrings of Size Three with Distinct Characters',
    r: 'Slide a window of length 3 and count windows whose three characters are pairwise different.',
    g: R => ({ s: R.str(R.int(1, 10), 'abc') }),
    s(I, T) { let c = 0; for (let i = 0; i + 3 <= I.s.length; i++) { const w = I.s.substr(i, 3), ok = new Set(w).size === 3; if (ok) c++; if (i < 7) { T.at({ s: A([...I.s], { win: [i, i + 2] }) }); T.yn(`Is "${w}" good?`, ok, 'All three different.'); } } if (I.s.length < 3) { T.at({ s: I.s }); T.n('Windows?', 0, 'Shorter than 3.'); } return c; }
  });

  D('minimum-number-of-flips-to-make-the-binary-string-alternating', {
    t: 'Minimum Number of Flips to Make the Binary String Alternating',
    r: 'Rotations (type-1) = windows of s + s. Slide a length-n window over the doubled string counting mismatches against "0101…" (the other pattern costs n − that). Minimum over windows.',
    g: R => ({ s: R.str(R.int(1, 8), '01') }),
    s(I, T) { const n = I.s.length, d = I.s + I.s; let mis = 0, best = Infinity; for (let i = 0; i < 2 * n; i++) { if (+d[i] !== i % 2) mis++; if (i >= n && +d[i - n] !== (i - n) % 2) mis--; if (i >= n - 1) { const c = Math.min(mis, n - mis); best = Math.min(best, c); if (i - n + 1 < 4) { T.at({ window: d.substr(i - n + 1, n), mismatches: mis }); T.n('Flips for this rotation?', c, 'min(mismatch, n − mismatch).'); } } } return best; }
  });

  D('minimum-difference-between-highest-and-lowest-of-k-scores', {
    t: 'Minimum Difference Between Highest and Lowest of K Scores',
    r: 'Sort; the best k scores are consecutive. Slide a window of k over the sorted array and minimize a[i + k − 1] − a[i].',
    g: R => { const a = R.ints(R.int(1, 8), 1, 30); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let best = Infinity; for (let i = 0; i + I.k <= a.length; i++) { const d = a[i + I.k - 1] - a[i]; best = Math.min(best, d); if (i < 6) { T.at({ sorted: A(a, { win: [i, i + I.k - 1] }) }); T.n('Best difference so far?', best, 'Last − first in the window.'); } } return best; }
  });

  D('count-vowel-substrings-of-a-string', {
    t: 'Count Vowel Substrings of a String',
    r: 'A vowel substring uses only vowels and contains all five. For each start, extend while characters are vowels, counting how many distinct vowels are present; count ends with all five.',
    g: R => ({ word: R.str(R.int(1, 10), 'aeioux') }),
    s(I, T) { const w = I.word, V = 'aeiou'; let c = 0, asks = 0; for (let i = 0; i < w.length; i++) { const S = new Set(); let here = 0; for (let j = i; j < w.length && V.includes(w[j]); j++) { S.add(w[j]); if (S.size === 5) here++; } c += here; if (V.includes(w[i]) && asks++ < 6) { T.at({ word: A([...w], { i }) }); T.n('Vowel substrings starting here?', here, 'Extend while vowels; count those with all five.'); } } return c; }
  });

  D('number-of-equal-count-substrings', {
    t: 'Number of Equal Count Substrings',
    r: 'If u distinct letters each appear exactly count times, the length is u times count. For u = 1 to 26 slide a window of that fixed length and check every present letter has exactly count.',
    g: R => ({ s: R.str(R.int(1, 10), 'abc'), count: R.int(1, 3) }),
    s(I, T) { let tot = 0; for (let u = 1; u <= 3; u++) { const L = u * I.count; let here = 0; for (let i = 0; i + L <= I.s.length; i++) { const c = {}; for (const ch of I.s.substr(i, L)) c[ch] = (c[ch] || 0) + 1; if (Object.values(c).every(v => v === I.count)) here++; } tot += here; T.at({ s: I.s, uniqueLetters: u, windowLength: L }); T.n('Equal-count windows of this length?', here, 'Every present letter appears exactly count times.'); } return tot; }
  });

  D('k-radius-subarray-averages', {
    t: 'K Radius Subarray Averages',
    r: 'Slide a window of size 2k + 1 keeping the sum. Centers with a full window get sum divided by (2k + 1), rounded down; others get −1.',
    g: R => ({ nums: R.ints(R.int(1, 9), 0, 9), k: R.int(0, 3) }),
    s(I, T) { const n = I.nums.length, w = 2 * I.k + 1, out = Array(n).fill(-1); let s = 0, asks = 0; for (let i = 0; i < n; i++) { s += I.nums[i]; if (i >= w) s -= I.nums[i - w]; if (i >= w - 1) { const c = i - I.k; out[c] = Math.floor(s / w); if (asks++ < 6) { T.at({ nums: A(I.nums, { win: [i - w + 1, i] }) }); T.n(`Average centered at ${c}?`, out[c], `${s} divided by ${w}, rounded down.`); } } } if (!asks) { T.at({ n, windowSize: w }); T.yn('Does any full window fit?', false, 'All −1.'); } return out; }
  });

  D('number-of-unique-flavors-after-sharing-k-candies', {
    t: 'Number of Unique Flavors After Sharing K Candies',
    r: 'Count all flavors. Slide the k-candy window given away: remove its candies from the counts and see how many flavors still have a positive count; maximize.',
    g: R => { const c = R.ints(R.int(1, 8), 1, 4); return { candies: c, k: R.int(0, c.length) }; },
    s(I, T) { const res = (() => { const c = new Map(); I.candies.forEach(x => c.set(x, (c.get(x) || 0) + 1)); T.at({ candies: A(I.candies) }); T.n('Distinct flavors before sharing?', c.size, 'Count each flavor once.'); const uniq = () => [...c.values()].filter(v => v > 0).length; for (let i = 0; i < I.k; i++) c.set(I.candies[i], c.get(I.candies[i]) - 1); let best = uniq(); T.at({ candies: A(I.candies, I.k ? { win: [0, I.k - 1] } : {}) }); T.n('Flavors kept when giving away the first window?', best, 'Remove the window from the counts.'); for (let i = I.k; i < I.candies.length; i++) { c.set(I.candies[i], c.get(I.candies[i]) - 1); c.set(I.candies[i - I.k], c.get(I.candies[i - I.k]) + 1); best = Math.max(best, uniq()); } return best; })(); T.n('Most flavors kept?', res, 'Best window to give away.'); return res; }
  });

  D('minimum-swaps-to-group-all-1s-together-ii', {
    t: 'Minimum Swaps to Group All 1\'s Together II',
    r: 'Circular array: slide a window of length (number of ones) around the circle (indices mod n). Swaps = ones − max ones inside any window.',
    g: R => ({ nums: R.ints(R.int(1, 9), 0, 1) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length, w = a.filter(x => x).length; T.at({ nums: A(a) }); T.n('Window length?', w, 'Number of ones.'); if (!w) { T.yn('Are there any ones?', false, 'Nothing to group.'); return 0; } let cur = 0; for (let i = 0; i < w; i++) cur += a[i]; let best = cur; for (let i = 1; i < n; i++) { cur += a[(i + w - 1) % n] - a[i - 1]; best = Math.max(best, cur); } T.n('Most ones in a circular window?', best, 'Slide with wrap-around.'); return w - best; })(); T.n('Fewest swaps?', res, 'Window length minus the most ones inside it.'); return res; }
  });

  D('find-substring-with-given-hash-value', {
    t: 'Find Substring With Given Hash Value',
    r: 'hash(s[i to i+k)) = the sum of val(s[i+j]) times power to the power j mod m. Roll from the right end leftward (multiply by power, add the new char, drop the outgoing one times power to the power k); keep the leftmost match.',
    g: R => { const s = R.str(R.int(2, 9), 'abcd'), k = R.int(1, Math.min(3, s.length)), p = R.int(2, 9), m = R.int(5, 30), i = R.int(0, s.length - k), h = [...s.substr(i, k)].reduce((acc, ch, j) => (acc + (ch.charCodeAt(0) - 96) * p ** j) % m, 0); return { s, power: p, modulo: m, k, hashValue: h }; },
    s(I, T) { const v = ch => BigInt(ch.charCodeAt(0) - 96), P = BigInt(I.power), M = BigInt(I.modulo); let asks = 0; for (let i = 0; i + I.k <= I.s.length; i++) { let h = 0n, pw = 1n; for (let j = 0; j < I.k; j++) { h = (h + v(I.s[i + j]) * pw) % M; pw = pw * P % M; } if (asks++ < 6) { T.at({ s: A([...I.s], { win: [i, i + I.k - 1] }), target: I.hashValue }); T.n('Hash of this window?', Number(h), 'the sum of val times power to the power j mod m.'); } if (Number(h) === I.hashValue) return I.s.substr(i, I.k); } return ''; }
  });

  D('minimum-consecutive-cards-to-pick-up', {
    t: 'Minimum Consecutive Cards to Pick Up',
    r: 'Remember the last index of each value. When a value repeats at j, the window [last, j] has a pair: length j − last + 1. Minimize; −1 if no repeats.',
    g: R => ({ cards: R.ints(R.int(1, 9), 1, 6) }),
    s(I, T) { const last = {}; let best = Infinity, asks = 0; I.cards.forEach((x, j) => { if (last[x] !== undefined) { best = Math.min(best, j - last[x] + 1); if (asks++ < 6) { T.at({ cards: A(I.cards, { win: [last[x], j] }) }); T.n('Shortest so far?', best, 'Distance to the previous equal card + 1.'); } } last[x] = j; }); if (!asks) { T.at({ cards: A(I.cards) }); T.yn('Any repeated card?', false, 'Return −1.'); } return best === Infinity ? -1 : best; }
  });
})();
