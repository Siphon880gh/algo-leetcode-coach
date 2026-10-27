/* v2 games: two pointers (01). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const words = (R, n, al, lo, hi) => Array.from({ length: n }, () => R.str(R.int(lo || 1, hi || 4), al || 'abc'));
  const nextPerm = a => { a = a.slice(); let i = a.length - 2; while (i >= 0 && a[i] >= a[i + 1]) i--; if (i >= 0) { let j = a.length - 1; while (a[j] <= a[i]) j--; [a[i], a[j]] = [a[j], a[i]]; } let l = i + 1, r = a.length - 1; while (l < r) { [a[l], a[r]] = [a[r], a[l]]; l++; r--; } return [a, i]; };
  const isSub = (s, t) => { let i = 0; for (const c of t) if (i < s.length && s[i] === c) i++; return i === s.length; };

  D('4sum', {
    t: '4Sum',
    r: 'Sort. Fix the first two indices (skipping duplicates), then run two pointers on the rest: move left up when the sum is too small, right down when too big, and record + skip duplicates on a hit.',
    g: R => ({ nums: R.ints(R.int(4, 8), -3, 3), target: R.int(-3, 3) }),
    cmp: 'sets',
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length, out = []; let asks = 0; T.at({ sorted: A(a) }); T.n('Smallest value after sorting?', a[0], 'Sort first.'); for (let i = 0; i < n - 3; i++) { if (i && a[i] === a[i - 1]) continue; for (let j = i + 1; j < n - 2; j++) { if (j > i + 1 && a[j] === a[j - 1]) continue; let l = j + 1, r = n - 1; while (l < r) { const s = a[i] + a[j] + a[l] + a[r]; if (asks < 10 && (s === I.target || asks < 4)) { T.at({ sorted: A(a, { i, j, l, r }), target: I.target }); T.c(`Sum ${a[i]}+${a[j]}+${a[l]}+${a[r]} = ${s}. Next move?`, ['record', 'move l right', 'move r left'], s === I.target ? 'record' : s < I.target ? 'move l right' : 'move r left', 'Compare with the target.'); asks++; } if (s === I.target) { out.push([a[i], a[j], a[l], a[r]]); l++; r--; while (l < r && a[l] === a[l - 1]) l++; while (l < r && a[r] === a[r + 1]) r--; } else if (s < I.target) l++; else r--; } } } return out; }
  });

  D('find-the-index-of-the-first-occurrence-in-a-string', {
    t: 'Find the Index of the First Occurrence in a String',
    r: 'Slide the needle along the haystack and compare character by character (KMP avoids re-scanning); return the first start where all characters match, or −1.',
    g: R => { const h = R.str(R.int(2, 9), 'ab'), nd = R.chance(0.6) ? h.slice(R.int(0, h.length - 1)).slice(0, R.int(1, 3)) : R.str(R.int(1, 3), 'ab'); return { haystack: h, needle: nd || 'a' }; },
    s(I, T) { const h = I.haystack, nd = I.needle; for (let i = 0; i + nd.length <= h.length; i++) { const ok = h.startsWith(nd, i); if (i < 8) { T.at({ haystack: A([...h], { win: [i, i + nd.length - 1] }), needle: nd }); T.yn(`Does the needle match at index ${i}?`, ok, 'Compare the window.'); } if (ok) return i; } T.at({ haystack: A([...h]), needle: nd }); T.yn('Did any window match?', false, 'Return −1.'); return -1; }
  });

  D('next-permutation', {
    t: 'Next Permutation',
    r: 'From the right, find the first i with a[i] < a[i + 1] (the pivot). Swap it with the rightmost element larger than it, then reverse the suffix after i. No pivot → reverse everything.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 4) }),
    s(I, T) { const [res, i] = nextPerm(I.nums); T.at({ nums: A(I.nums) }); T.n('Pivot index (−1 if none)?', i, 'Rightmost i with nums[i] < nums[i+1].'); if (i >= 0) { let j = I.nums.length - 1; while (I.nums[j] <= I.nums[i]) j--; T.n('Index swapped with the pivot?', j, 'Rightmost value larger than the pivot.'); } T.at({ result: A(res) }); T.n('First element of the result?', res[0], 'Swap, then reverse the suffix.'); return res; }
  });

  D('length-of-last-word', {
    t: 'Length of Last Word',
    r: 'Scan from the end: skip trailing spaces, then count characters until the next space or the start.',
    g: R => ({ s: (R.chance(0.5) ? ' ' : '') + words(R, R.int(1, 4), 'ab', 1, 5).join(R.pick([' ', '  '])) + (R.chance(0.5) ? '  ' : '') }),
    s(I, T) { const s = I.s; let i = s.length - 1; while (s[i] === ' ') i--; T.at({ s: A([...s].map(c => c === ' ' ? '␣' : c), { i }) }); T.n('Index of the last non-space?', i, 'Skip trailing spaces.'); T.n('How many trailing spaces?', s.length - 1 - i, 'Characters after that index.'); let n = 0; while (i >= 0 && s[i] !== ' ') { i--; n++; } T.n('Length of the last word?', n, 'Count until a space.'); return n; }
  });

  D('reverse-words-in-a-string', {
    t: 'Reverse Words in a String',
    r: 'Split on runs of spaces (dropping empty pieces), reverse the word list and join with single spaces. In-place: reverse the whole string, then each word, then compact spaces.',
    g: R => ({ s: (R.chance(0.5) ? ' ' : '') + words(R, R.int(1, 4), 'abc', 1, 4).join(R.pick([' ', '  '])) + (R.chance(0.5) ? ' ' : '') }),
    s(I, T) { const res = (() => { const w = I.s.split(' ').filter(Boolean); T.at({ s: JSON.stringify(I.s) }); T.n('How many words?', w.length, 'Ignore extra spaces.'); const r = w.reverse().join(' '); T.c('Result?', [...new Set([r, w.slice().reverse().join(' '), r + ' '])].map(x => JSON.stringify(x)), JSON.stringify(r), 'Reverse word order, single spaces.'); return r; })(); T.n('Spaces in the result?', Math.max(0, res.split(' ').length - 1), 'Exactly one between each pair of words.'); return res; }
  });

  D('one-edit-distance', {
    t: 'One Edit Distance',
    r: 'If lengths differ by more than 1 → false. Walk both strings to the first mismatch; then the rests must match after skipping one char in the longer (insert/delete) or one in each (replace). No mismatch → true only if lengths differ by exactly 1.',
    g: R => { const s = R.str(R.int(0, 4), 'ab'); let t = s; const k = R.int(0, 3); if (k === 1) t = s.slice(0, 1) + R.pick('abc') + s.slice(1); else if (k === 2 && s) { const i = R.int(0, s.length - 1); t = s.slice(0, i) + s.slice(i + 1); } else if (k === 3) t = R.str(R.int(0, 4), 'ab'); return { s, t }; },
    s(I, T) { const { s, t } = I; T.at({ s, t }); T.n('Length difference?', Math.abs(s.length - t.length), 'More than 1 → false immediately.'); if (Math.abs(s.length - t.length) > 1) return false; let i = 0; while (i < s.length && i < t.length && s[i] === t[i]) i++; T.n('First mismatch index (or the shorter length)?', i, 'Walk while equal.'); let r; if (i === Math.min(s.length, t.length)) r = s.length !== t.length; else if (s.length === t.length) r = s.slice(i + 1) === t.slice(i + 1); else r = s.length > t.length ? s.slice(i + 1) === t.slice(i) : s.slice(i) === t.slice(i + 1); T.yn('Exactly one edit apart?', r, 'Compare the remainders.'); return r; }
  });

  D('compare-version-numbers', {
    t: 'Compare Version Numbers',
    r: 'Split on dots and compare revisions as integers left to right, treating missing revisions as 0. The first difference decides (−1 / 1); otherwise 0.',
    g: R => { const v = () => Array.from({ length: R.int(1, 3) }, () => (R.chance(0.3) ? '0' : '') + R.int(0, 3)).join('.'); return { version1: v(), version2: v() }; },
    s(I, T) { const res = (() => { const a = I.version1.split('.').map(Number), b = I.version2.split('.').map(Number); T.at({ v1: A(a), v2: A(b) }); T.n('Revisions to compare at most?', Math.max(a.length, b.length), 'The longer version decides.'); for (let i = 0; i < Math.max(a.length, b.length); i++) { const x = a[i] || 0, y = b[i] || 0; T.at({ v1: A(a, { i }), v2: A(b, { i }) }); T.c(`Revision ${i}: ${x} vs ${y}?`, ['equal', 'v1 bigger', 'v2 bigger'], x === y ? 'equal' : x > y ? 'v1 bigger' : 'v2 bigger', 'Leading zeros are ignored, and a missing revision counts as 0.'); if (x !== y) return x > y ? 1 : -1; } return 0; })(); T.n('Result? (1, −1 or 0)', res, 'The first unequal revision decides.'); return res; }
  });

  D('summary-ranges', {
    t: 'Summary Ranges',
    r: 'Walk the sorted array, extending a run while the next value is current + 1. Close the run as "a->b" (or "a" when a single number).',
    g: R => ({ nums: R.distinct(R.int(0, 8), -3, 12).sort((a, b) => a - b) }),
    s(I, T) { const a = I.nums, out = []; let i = 0; while (i < a.length) { let j = i; while (j + 1 < a.length && a[j + 1] === a[j] + 1) j++; T.at({ nums: A(a, { win: [i, j] }) }); T.n(`Run starting at ${a[i]} ends at which value?`, a[j], 'Extend while consecutive.'); out.push(i === j ? '' + a[i] : a[i] + '->' + a[j]); i = j + 1; } if (!a.length) { T.at({ nums: '[]' }); T.n('How many ranges?', 0, 'Empty input.'); } return out; }
  });

  D('shortest-word-distance', {
    t: 'Shortest Word Distance',
    r: 'One pass remembering the latest index of word1 and of word2. Whenever you see either, update its index and, if both are known, the best distance.',
    g: R => { const w = ['a', 'b', 'c', 'd'], d = Array.from({ length: R.int(2, 8) }, () => R.pick(w)); d[R.int(0, d.length - 1)] = 'x'; let i = R.int(0, d.length - 1); while (d[i] === 'x') i = (i + 1) % d.length; d[i] = 'y'; return { wordsDict: d, word1: 'x', word2: 'y' }; },
    s(I, T) { const res = (() => { let p = -1, q = -1, best = Infinity; T.at({ words: A(I.wordsDict) }); T.n(`Times "${I.word1}" appears?`, I.wordsDict.filter(w => w === I.word1).length, 'Each one is a candidate position.'); I.wordsDict.forEach((w, i) => { if (w === I.word1) p = i; if (w === I.word2) q = i; if ((w === I.word1 || w === I.word2) && p >= 0 && q >= 0) { best = Math.min(best, Math.abs(p - q)); T.at({ words: A(I.wordsDict, { i }), last1: p, last2: q }); T.n('Best distance so far?', best, 'Distance between the two last positions.'); } }); return best; })(); T.n('Shortest distance?', res, 'The best distance over the whole scan.'); return res; }
  });

  D('shortest-word-distance-iii', {
    t: 'Shortest Word Distance III',
    r: 'Same single pass, but when word1 == word2 compare each occurrence with the previous occurrence of the same word.',
    g: R => { const d = Array.from({ length: R.int(2, 8) }, () => R.pick(['a', 'b', 'x', 'y'])); d[0] = 'x'; d[d.length - 1] = R.pick(['x', 'y']); const same = R.chance(0.4); return { wordsDict: R.shuffle(d), word1: 'x', word2: same ? 'x' : (d.includes('y') ? 'y' : 'x') }; },
    s(I, T) { const { wordsDict: W, word1: a, word2: b } = I; let best = Infinity; if (a === b) { let prev = -1; W.forEach((w, i) => { if (w !== a) return; if (prev >= 0) { best = Math.min(best, i - prev); T.at({ words: A(W, { i, prev }) }); T.n('Best so far?', best, 'Gap to the previous occurrence.'); } prev = i; }); } else { let p = -1, q = -1; W.forEach((w, i) => { if (w === a) p = i; if (w === b) q = i; if ((w === a || w === b) && p >= 0 && q >= 0) { best = Math.min(best, Math.abs(p - q)); T.at({ words: A(W, { i }), last1: p, last2: q }); T.n('Best so far?', best, '|last1 − last2|.'); } }); } return best; }
  });

  D('strobogrammatic-number', {
    t: 'Strobogrammatic Number',
    r: 'Two pointers from both ends: each pair must be a rotation pair — 0↔0, 1↔1, 8↔8, 6↔9, 9↔6.',
    g: R => { const P = [['0', '0'], ['1', '1'], ['8', '8'], ['6', '9'], ['9', '6']], h = R.int(0, 2), L = [], Rr = []; for (let i = 0; i < h; i++) { const p = R.pick(P); L.push(p[0]); Rr.unshift(p[1]); } let s = L.join('') + (R.chance(0.5) ? R.pick(['0', '1', '8']) : '') + Rr.join(''); if (!s || R.chance(0.3)) s = String(R.int(1, 999)); return { num: s }; },
    s(I, T) { const res = (() => { const M = { 0: '0', 1: '1', 8: '8', 6: '9', 9: '6' }, s = I.num; let l = 0, r = s.length - 1; while (l <= r) { const ok = M[s[l]] === s[r]; T.at({ num: A([...s], { l, r }) }); T.yn(`Do ${s[l]} and ${s[r]} form a valid rotated pair?`, ok, 'Valid pairs: 0 and 0, 1 and 1, 8 and 8, 6 and 9, 9 and 6.'); if (!ok) return false; l++; r--; } return true; })(); T.yn('Is the number strobogrammatic?', res, 'Every pair must be valid.'); return res; }
  });

  D('3sum-smaller', {
    t: '3Sum Smaller',
    r: 'Sort. For each i, two pointers l, r on the rest: if a[i] + a[l] + a[r] < target, every r\' in (l, r] works — add r − l and move l; otherwise move r down.',
    g: R => ({ nums: R.ints(R.int(0, 7), -4, 4), target: R.int(-3, 4) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let c = 0, asks = 0; for (let i = 0; i < a.length - 2; i++) { let l = i + 1, r = a.length - 1; while (l < r) { const s = a[i] + a[l] + a[r]; if (s < I.target) { c += r - l; if (asks++ < 8) { T.at({ sorted: A(a, { i, l, r }), target: I.target }); T.n(`Sum ${s} < target. Count so far?`, c, 'Add r − l: all r\' between work.'); } l++; } else r--; } } if (!asks) { T.at({ sorted: A(a), target: I.target }); T.n('How many triplets?', c, 'None qualify.'); } return c; }
  });

  D('create-maximum-number', {
    t: 'Create Maximum Number',
    r: 'For each split i (digits from nums1) + (k − i from nums2): take the max subsequence of each length with a monotonic stack, merge greedily comparing remaining suffixes, and keep the best result.',
    g: R => { const a = R.ints(R.int(1, 4), 0, 9), b = R.ints(R.int(1, 4), 0, 9); return { nums1: a, nums2: b, k: R.int(1, a.length + b.length) }; },
    s(I, T) { const pick = (a, t) => { const st = []; let drop = a.length - t; for (const x of a) { while (drop && st.length && st[st.length - 1] < x) { st.pop(); drop--; } st.push(x); } return st.slice(0, t); }; const gt = (a, i, b, j) => { while (i < a.length && j < b.length && a[i] === b[j]) { i++; j++; } return j === b.length || (i < a.length && a[i] > b[j]); }; const merge = (a, b) => { const o = []; let i = 0, j = 0; while (i < a.length || j < b.length) o.push(gt(a, i, b, j) ? a[i++] : b[j++]); return o; }; let best = null, asks = 0; for (let i = Math.max(0, I.k - I.nums2.length); i <= Math.min(I.k, I.nums1.length); i++) { const x = pick(I.nums1, i), y = pick(I.nums2, I.k - i), m = merge(x, y); if (asks++ < 5) { T.at({ split: `${i} + ${I.k - i}`, part1: A(x), part2: A(y) }); T.n('First digit of the merged candidate?', m[0], 'Merge by comparing remaining suffixes.'); } if (!best || m.join(',') > best.join(',') && m.some((d, t) => d !== best[t]) && (() => { for (let t = 0; t < m.length; t++) if (m[t] !== best[t]) return m[t] > best[t]; return false; })()) best = m; } return best; }
  });

  D('reverse-vowels-of-a-string', {
    t: 'Reverse Vowels of a String',
    r: 'Two pointers from both ends: advance each until it sits on a vowel (either case), swap, and move both inward.',
    g: R => ({ s: R.str(R.int(1, 8), 'aeIOubcd') }),
    s(I, T) { const a = [...I.s], V = 'aeiouAEIOU'; let l = 0, r = a.length - 1, asks = 0; T.at({ s: A(a.slice()) }); T.n('How many vowels?', a.filter(c => V.includes(c)).length, 'Upper and lower case both count.'); while (l < r) { while (l < r && !V.includes(a[l])) l++; while (l < r && !V.includes(a[r])) r--; if (l < r) { if (asks++ < 6) { T.at({ s: A(a.slice(), { l, r }) }); T.n(`Index ${l} swaps with which index?`, r, 'Both pointers rest on vowels.'); } [a[l], a[r]] = [a[r], a[l]]; l++; r--; } } if (!asks) { T.at({ s: A(a) }); T.n('How many swaps happen?', 0, 'Fewer than two vowels.'); T.yn('Is the string unchanged?', true, 'Nothing was swapped.'); } return a.join(''); }
  });

  D('intersection-of-two-arrays-ii', {
    t: 'Intersection of Two Arrays II',
    r: 'Sort both and walk two pointers: equal → output and advance both; otherwise advance the smaller. (Or count one array in a hash map.)',
    g: R => ({ nums1: R.ints(R.int(1, 6), 1, 5), nums2: R.ints(R.int(1, 6), 1, 5) }),
    cmp: 'set',
    s(I, T) { const a = I.nums1.slice().sort((x, y) => x - y), b = I.nums2.slice().sort((x, y) => x - y), out = []; let i = 0, j = 0, asks = 0; while (i < a.length && j < b.length) { if (asks++ < 8) { T.at({ a: A(a, { i }), b: A(b, { j }), out: A(out.slice()) }); T.c(`${a[i]} vs ${b[j]}?`, ['take both', 'advance a', 'advance b'], a[i] === b[j] ? 'take both' : a[i] < b[j] ? 'advance a' : 'advance b', 'Advance the smaller side.'); } if (a[i] === b[j]) { out.push(a[i]); i++; j++; } else if (a[i] < b[j]) i++; else j++; } return out; }
  });

  D('sort-transformed-array', {
    t: 'Sort Transformed Array',
    r: 'f is a parabola, so the extremes of f are at the array ends. If a ≥ 0, fill the result from the back with the larger of f(left), f(right); if a < 0, fill from the front with the smaller.',
    g: R => ({ nums: R.sorted(R.int(1, 6), -4, 4), a: R.int(-2, 2), b: R.int(-3, 3), c: R.int(-3, 3) }),
    s(I, T) { const f = x => I.a * x * x + I.b * x + I.c, n = I.nums.length, out = Array(n); let l = 0, r = n - 1, k = I.a >= 0 ? n - 1 : 0, asks = 0; T.at({ a: I.a }); T.c('Fill the result from…', ['the back (largest first)', 'the front (smallest first)'], I.a >= 0 ? 'the back (largest first)' : 'the front (smallest first)', 'Opening up → ends are largest.'); while (l <= r) { const x = f(I.nums[l]), y = f(I.nums[r]); let v; if (I.a >= 0) { if (x >= y) { v = x; l++; } else { v = y; r--; } out[k--] = v; } else { if (x <= y) { v = x; l++; } else { v = y; r--; } out[k++] = v; } if (asks++ < 6) { T.at({ nums: A(I.nums, { l: Math.min(l, n - 1), r: Math.max(r, 0) }), out: A(out.map(z => z === undefined ? '·' : z)) }); T.n('Value just placed?', v, 'Compare f at both ends.'); } } return out; }
  });

  D('find-k-pairs-with-smallest-sums', {
    t: 'Find K Pairs with Smallest Sums',
    r: 'Min-heap seeded with (nums1[i] + nums2[0], i, 0). Pop the smallest k times; after popping (i, j) push (i, j + 1).',
    g: R => { const a = R.sorted(R.int(1, 4), 1, 9), b = R.sorted(R.int(1, 4), 1, 9); return { nums1: a, nums2: b, k: R.int(1, a.length * b.length) }; },
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && JSON.stringify(o.map(p => p[0] + p[1]).sort((x, y) => x - y)) === JSON.stringify(e.map(p => p[0] + p[1]).sort((x, y) => x - y)) && o.every(p => I.nums1.includes(p[0]) && I.nums2.includes(p[1])),
    s(I, T) { const a = I.nums1, b = I.nums2, h = a.map((x, i) => [x + b[0], i, 0]), out = []; while (out.length < I.k && h.length) { h.sort((x, y) => x[0] - y[0] || x[1] - y[1]); const [s, i, j] = h.shift(); if (out.length < 8) { T.at({ heapTop: `(${a[i]}, ${b[j]})`, taken: out.length }); T.n('Sum of the pair popped?', s, 'Smallest sum in the heap.'); } out.push([a[i], b[j]]); if (j + 1 < b.length) h.push([a[i] + b[j + 1], i, j + 1]); } return out; }
  });

  D('is-subsequence', {
    t: 'Is Subsequence',
    r: 'Pointer i into s, scan t: whenever t[j] equals s[i], advance i. s is a subsequence iff i reaches the end of s.',
    g: R => { const t = R.str(R.int(0, 8), 'abc'); return { s: R.chance(0.5) ? [...t].filter(() => R.chance(0.5)).join('') : R.str(R.int(0, 3), 'abc'), t }; },
    s(I, T) { let i = 0, asks = 0; for (let j = 0; j < I.t.length; j++) { const m = i < I.s.length && I.s[i] === I.t[j]; if (asks++ < 8) { T.at({ s: A([...I.s], { i }), t: A([...I.t], { j }) }); T.yn(`Does t[${j}] match s[${i}]?`, m, 'Advance i on a match.'); } if (m) i++; } T.at({ matched: i, need: I.s.length }); T.yn('Is s a subsequence?', i === I.s.length, 'All of s matched.'); return i === I.s.length; }
  });

  D('valid-word-abbreviation', {
    t: 'Valid Word Abbreviation',
    r: 'Walk the abbreviation: a letter must match word[i]; a number (no leading zero) skips that many characters. Valid iff both end together.',
    g: R => { const w = R.str(R.int(1, 8), 'ab'); let ab = '', i = 0; while (i < w.length) { if (R.chance(0.5)) { const k = R.int(1, w.length - i); ab += k; i += k; if (i < w.length) { ab += w[i]; i++; } } else { ab += w[i]; i++; } } if (R.chance(0.3)) ab = R.pick([ab + '1', ab.replace(/\d+/, m => '0' + m), 'a' + ab]); return { word: w, abbr: ab }; },
    s(I, T) { const w = I.word, a = I.abbr; let i = 0, j = 0, asks = 0; while (j < a.length) { if (/\d/.test(a[j])) { if (a[j] === '0') { T.at({ abbr: A([...a], { j }) }); T.yn('Is a leading zero allowed?', false, 'Numbers cannot start with 0.'); return false; } let k = 0; while (/\d/.test(a[j])) k = k * 10 + +a[j++]; i += k; if (asks++ < 6) { T.at({ word: A([...w], { i: Math.min(i, w.length) }), abbr: A([...a]) }); T.n(`After skipping ${k}, where is the word pointer?`, i, 'Jump ahead.'); } } else { const ok = i < w.length && w[i] === a[j]; if (asks++ < 6) { T.at({ word: A([...w], { i }), abbr: A([...a], { j }) }); T.yn('Do the letters match?', ok, 'Letter must equal word[i].'); } if (!ok) return false; i++; j++; } } return i === w.length; }
  });

  D('string-compression', {
    t: 'String Compression',
    r: 'Read pointer finds each group; write pointer writes the character and, if the group is longer than 1, the digits of its length. Return the write position.',
    g: R => ({ chars: [...Array.from({ length: R.int(1, 4) }, () => R.pick('abc').repeat(R.int(1, 12))).join('')] }),
    s(I, T) { const c = I.chars; let i = 0, w = 0, asks = 0; while (i < c.length) { let j = i; while (j < c.length && c[j] === c[i]) j++; const k = j - i; w += 1 + (k > 1 ? String(k).length : 0); if (asks++ < 6) { T.at({ chars: A(c, { win: [i, j - 1] }) }); T.n('Write position after this group?', w, 'Char + digits of the count (if > 1).'); } i = j; } return w; }
  });

  D('circular-array-loop', {
    t: 'Circular Array Loop',
    r: 'From each start, move with slow/fast pointers while the direction stays the same. A meeting point means a cycle — reject it if it is a self-loop (length 1). Mark explored paths dead.',
    g: R => ({ nums: Array.from({ length: R.int(1, 6) }, () => R.pick([-1, 1]) * R.int(1, 3)) }),
    s(I, T) { const a = I.nums, n = a.length, nx = i => (((i + a[i]) % n) + n) % n; let asks = 0; for (let s = 0; s < n; s++) { const seen = new Set(); let i = s, ok = true; while (!seen.has(i)) { seen.add(i); const j = nx(i); if (Math.sign(a[j]) !== Math.sign(a[s]) || j === i) { ok = false; break; } i = j; } let found = false; if (ok) { const c = i; let len = 0, k = c; do { k = nx(k); len++; } while (k !== c); found = len > 1; } if (asks++ < 6) { T.at({ nums: A(a, { i: s }) }); T.yn(`Does walking from ${s} reach a valid one-direction cycle?`, found, 'Same sign all the way, length > 1.'); } if (found) return true; } return false; }
  });

  D('magical-string', {
    t: 'Magical String',
    r: 'Generate the string with a read pointer: s[i] says how many copies of the next symbol (alternating 1/2) to append. Count 1s among the first n.',
    g: R => ({ n: R.int(1, 25) }),
    s(I, T) { const s = [1, 2, 2]; let i = 2; while (s.length < I.n) { const v = s[s.length - 1] === 1 ? 2 : 1; for (let k = 0; k < s[i]; k++) s.push(v); i++; } const f = s.slice(0, I.n), c = f.filter(x => x === 1).length; T.at({ s: A(f) }); T.n(`Value at index ${Math.min(I.n, 6) - 1}?`, f[Math.min(I.n, 6) - 1], 'Group sizes read from the string itself.'); T.n('How many 1s in the first n?', c, 'Count them.'); T.n('How many 2s in the first n?', I.n - c, 'The rest of the first n.'); return c; }
  });

  D('longest-uncommon-subsequence-ii', {
    t: 'Longest Uncommon Subsequence II',
    r: 'The answer, if any, is a whole string. Check strings longest-first: one that is not a subsequence of any other string wins; −1 if none.',
    g: R => ({ strs: words(R, R.int(2, 4), 'ab', 1, 3) }),
    s(I, T) { const res = (() => { const s = I.strs.map((x, i) => [x, i]).sort((a, b) => b[0].length - a[0].length); let asks = 0; T.at({ strs: A(I.strs) }); T.n('Length of the longest string?', s[0][0].length, 'Check longer strings first.'); for (const [x, i] of s) { const ok = I.strs.every((y, j) => j === i || !isSub(x, y)); if (asks++ < 6) { T.at({ strs: A(I.strs, { i }) }); T.yn(`Is "${x}" a subsequence of none of the others?`, ok, 'Then its length is the answer.'); } if (ok) return x.length; } return -1; })(); T.n('Answer? (−1 if none)', res, 'The first length that works.'); return res; }
  });

  D('longest-word-in-dictionary-through-deleting', {
    t: 'Longest Word in Dictionary through Deleting',
    r: 'For each dictionary word, two-pointer check whether it is a subsequence of s. Keep the longest, breaking ties by lexicographic order.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc'), dictionary: words(R, R.int(1, 4), 'abc', 1, 3) }),
    s(I, T) { let best = '', asks = 0; for (const w of I.dictionary) { const ok = isSub(w, I.s); if (asks++ < 6) { T.at({ s: I.s, word: w, best: best || '""' }); T.yn(`Is "${w}" a subsequence of s?`, ok, 'Two pointers.'); } if (ok && (w.length > best.length || (w.length === best.length && w < best))) best = w; } return best; }
  });

  D('k-diff-pairs-in-an-array', {
    t: 'K-diff Pairs in an Array',
    r: 'Sort and use two pointers (or a count map): for k = 0 count values appearing at least twice; otherwise count distinct x with x + k present.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6), k: R.int(0, 3) }),
    s(I, T) { const c = {}; I.nums.forEach(x => c[x] = (c[x] || 0) + 1); const ks = Object.keys(c).map(Number).sort((a, b) => a - b); let r = 0, asks = 0; for (const x of ks) { const ok = I.k ? c[x + I.k] > 0 : c[x] > 1; if (ok) r++; if (asks++ < 6) { T.at({ counts: K(c), x, k: I.k }); T.yn(I.k ? `Is ${x + I.k} present?` : `Does ${x} appear twice?`, !!ok, 'Each distinct x counts once.'); } } return r; }
  });

  D('reverse-string-ii', {
    t: 'Reverse String II',
    r: 'Step through the string in blocks of 2k; reverse the first k characters of each block (or all that remain if fewer than k).',
    g: R => ({ s: R.str(R.int(1, 10), 'abcdefg'), k: R.int(1, 4) }),
    s(I, T) { const a = [...I.s]; T.at({ s: A(a.slice()), k: I.k }); T.n('How many 2k blocks?', Math.ceil(a.length / (2 * I.k)), 'The last block may be short.'); for (let i = 0; i < a.length; i += 2 * I.k) { const j = Math.min(i + I.k, a.length) - 1; T.at({ s: A(a.slice(), { win: [i, j] }) }); T.n('Last index reversed in this block?', j, 'First k of every 2k.'); let l = i, r = j; while (l < r) { [a[l], a[r]] = [a[r], a[l]]; l++; r--; } } return a.join(''); }
  });

  D('next-greater-element-iii', {
    t: 'Next Greater Element III',
    r: 'Apply next permutation to the digits: find the pivot from the right, swap with the rightmost larger digit, reverse the suffix. No pivot or a result above 2^31 − 1 → −1.',
    g: R => ({ n: R.int(1, 99999) }),
    s(I, T) { const d = [...String(I.n)].map(Number), [res, i] = nextPerm(d); T.at({ digits: A(d) }); T.n('How many digits?', d.length, 'Only rearrange these.'); T.n('Pivot index (−1 if none)?', i, 'Rightmost digit smaller than its right neighbor.'); if (i < 0) { T.n('Answer?', -1, 'Digits already descend.'); return -1; } const v = +res.join(''); T.n('Next greater number?', v, 'Swap, reverse suffix.'); return v > 2147483647 ? -1 : v; }
  });

  D('reverse-words-in-a-string-iii', {
    t: 'Reverse Words in a String III',
    r: 'For each word (between spaces), reverse its characters in place with two pointers; spaces stay where they are.',
    g: R => ({ s: words(R, R.int(1, 4), 'abcde', 1, 5).join(' ') }),
    s(I, T) { const w = I.s.split(' '); w.slice(0, 5).forEach(x => { const r = [...x].reverse().join(''); T.at({ word: x }); T.c('Reversed word?', [...new Set([r, x, r.slice(1) + r[0]])], r, 'Swap from both ends.'); }); return w.map(x => [...x].reverse().join('')).join(' '); }
  });

  D('shortest-unsorted-continuous-subarray', {
    t: 'Shortest Unsorted Continuous Subarray',
    r: 'Left to right, track the running max: any element below it marks the right end. Right to left, track the running min: any element above it marks the left end. Length = r − l + 1 (0 if sorted).',
    g: R => { const a = R.sorted(R.int(1, 8), 1, 9); if (R.chance(0.7) && a.length > 1) { const i = R.int(0, a.length - 2), j = R.int(i + 1, a.length - 1); [a[i], a[j]] = [a[j], a[i]]; } return { nums: a }; },
    s(I, T) { const res = (() => { const a = I.nums, n = a.length; let mx = -Infinity, mn = Infinity, r = -1, l = 0; for (let i = 0; i < n; i++) { if (a[i] < mx) r = i; else mx = a[i]; } for (let i = n - 1; i >= 0; i--) { if (a[i] > mn) l = i; else mn = a[i]; } T.at({ nums: A(a) }); T.yn('Is the array already sorted?', r < 0, 'No value is below the running max.'); T.n('Right end? This is the last index below the running max, or −1 if none.', r, 'Scan left to right.'); if (r < 0) return 0; T.n('Left end? This is the last index above the running min, scanning right to left.', l, 'Scan right to left.'); return r - l + 1; })(); T.n('Length of the shortest subarray to sort?', res, 'Right end minus left end, plus 1, or 0.'); return res; }
  });

  D('valid-triangle-number', {
    t: 'Valid Triangle Number',
    r: 'Sort. Fix the largest side k; two pointers i = 0, j = k − 1: if a[i] + a[j] > a[k], all i\' in [i, j) work — add j − i and move j down; else move i up.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 8) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let c = 0, asks = 0; for (let k = a.length - 1; k >= 2; k--) { let i = 0, j = k - 1; while (i < j) { if (a[i] + a[j] > a[k]) { c += j - i; if (asks++ < 8) { T.at({ sorted: A(a, { i, j, k }) }); T.n(`${a[i]} + ${a[j]} > ${a[k]}. Count so far?`, c, 'Add j − i.'); } j--; } else i++; } } if (!asks) { T.at({ sorted: A(a) }); T.n('Triangles?', 0, 'No pair beats the largest side.'); } return c; }
  });

  D('count-binary-substrings', {
    t: 'Count Binary Substrings',
    r: 'Compress into run lengths. Each pair of adjacent runs contributes min(prev, cur) substrings.',
    g: R => ({ s: R.str(R.int(1, 12), '01') }),
    s(I, T) { const runs = []; for (const ch of I.s) { if (runs.length && runs[runs.length - 1][0] === ch) runs[runs.length - 1][1]++; else runs.push([ch, 1]); } const L = runs.map(x => x[1]); T.at({ s: I.s }); T.n('How many runs?', L.length, 'Group equal neighbors.'); let c = 0; for (let i = 1; i < L.length; i++) { c += Math.min(L[i - 1], L[i]); if (i < 8) { T.at({ runs: A(L, { i }) }); T.n('Total so far?', c, 'Add min of the adjacent runs.'); } } return c; }
  });

  D('candy-crush', {
    t: 'Candy Crush',
    r: 'Repeat: mark every cell in a horizontal or vertical line of ≥ 3 equal non-zero candies (mark first, crush together), set them to 0, then let each column fall with a write pointer from the bottom. Stop when nothing is marked.',
    g: R => ({ board: Array.from({ length: R.int(3, 5) }, () => R.ints(3, 1, 3)) }),
    s(I, T) { const res = (() => { const b = I.board.map(r => r.slice()), m = b.length, n = b[0].length; let round = 0; for (;;) { const mk = b.map(r => r.map(() => false)); let any = false; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { const v = b[i][j]; if (!v) continue; if (j + 2 < n && b[i][j + 1] === v && b[i][j + 2] === v) mk[i][j] = mk[i][j + 1] = mk[i][j + 2] = any = true; if (i + 2 < m && b[i + 1][j] === v && b[i + 2][j] === v) mk[i][j] = mk[i + 1][j] = mk[i + 2][j] = any = true; } const cnt = mk.flat().filter(Boolean).length; if (round < 4) { T.at({ board: G(b.map(r => r.slice())) }); T.n('How many cells get crushed this round?', cnt, 'Mark all lines of 3+ first.'); } round++; if (!any) break; for (let j = 0; j < n; j++) { let w = m - 1; for (let i = m - 1; i >= 0; i--) if (!mk[i][j] && b[i][j]) b[w--][j] = b[i][j]; while (w >= 0) b[w--][j] = 0; } } return b; })(); T.n('Empty cells at the end?', res.flat().filter(v => !v).length, 'Crushed cells fill from the top.'); return res; }
  });

  D('swap-adjacent-in-lr-string', {
    t: 'Swap Adjacent in LR String',
    r: '"XL"→"LX" moves L left; "RX"→"XR" moves R right; they never cross. So the strings without X must match, each L may only move left (start index ≥ end index) and each R only right.',
    g: R => { const s = R.str(R.int(1, 7), 'LRXX'); let t = s; if (R.chance(0.6)) { const a = [...s]; for (let k = 0; k < 4; k++) { const i = R.int(0, a.length - 2); if (a[i] === 'X' && a[i + 1] === 'L') [a[i], a[i + 1]] = ['L', 'X']; else if (a[i] === 'R' && a[i + 1] === 'X') [a[i], a[i + 1]] = ['X', 'R']; } t = a.join(''); } else t = R.shuffle([...s]).join(''); return { start: s, result: t }; },
    s(I, T) { const p = [...I.start].map((c, i) => [c, i]).filter(x => x[0] !== 'X'), q = [...I.result].map((c, i) => [c, i]).filter(x => x[0] !== 'X'); const same = p.map(x => x[0]).join('') === q.map(x => x[0]).join(''); T.at({ start: I.start, result: I.result }); T.yn('Same L/R sequence after removing X?', same, 'Pieces never pass each other.'); if (!same) return false; for (let k = 0; k < p.length; k++) { const ok = p[k][0] === 'L' ? p[k][1] >= q[k][1] : p[k][1] <= q[k][1]; if (k < 6) { T.at({ piece: p[k][0], from: p[k][1], to: q[k][1] }); T.yn('Can it move there?', ok, 'L only left, R only right.'); } if (!ok) return false; } return true; }
  });

  D('number-of-subarrays-with-bounded-maximum', {
    t: 'Number of Subarrays with Bounded Maximum',
    r: 'Track the last index with a value > right (a breaker) and the last index with a value in [left, right]. Each end i adds (lastGood − lastBreaker) when positive.',
    g: R => { const l = R.int(1, 4); return { nums: R.ints(R.int(1, 8), 0, 7), left: l, right: l + R.int(0, 3) }; },
    s(I, T) { let bad = -1, good = -1, c = 0; I.nums.forEach((x, i) => { if (x > I.right) bad = i; if (x >= I.left && x <= I.right) good = i; c += Math.max(0, good - bad); if (i < 9) { T.at({ nums: A(I.nums, { i }), lastBreaker: bad, lastInRange: good }); T.n('Total so far?', c, 'Add max(0, lastInRange − lastBreaker).'); } }); return c; }
  });

  D('expressive-words', {
    t: 'Expressive Words',
    r: 'Compare run-length encodings of s and each word: same characters in order, and each run either has equal length, or s\'s run is ≥ 3 and at least the word\'s run.',
    g: R => { const base = R.str(R.int(1, 4), 'abc'), s = [...base].map(c => c.repeat(R.int(1, 4))).join(''); return { s, words: [base, ...words(R, R.int(0, 3), 'abc', 1, 4)] }; },
    s(I, T) { const enc = w => { const r = []; for (const c of w) { if (r.length && r[r.length - 1][0] === c) r[r.length - 1][1]++; else r.push([c, 1]); } return r; }; const S = enc(I.s); let c = 0; I.words.forEach((w, k) => { const W = enc(w), ok = S.length === W.length && S.every(([ch, n], i) => ch === W[i][0] && (n === W[i][1] || (n >= 3 && n >= W[i][1]))); if (k < 6) { T.at({ s: A(S.map(([ch, n]) => ch + n)), word: A(W.map(([ch, n]) => ch + n)) }); T.yn(`Is "${w}" stretchy?`, ok, 'Runs equal, or s\'s run ≥ 3 and ≥ the word\'s.'); } if (ok) c++; }); return c; }
  });
})();
