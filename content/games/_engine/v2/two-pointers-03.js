/* v2 games: two pointers (03). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const pal = (s, i, j) => { while (i < j) if (s[i++] !== s[j--]) return false; return true; };
  const nextPerm = a => { a = a.slice(); let i = a.length - 2; while (i >= 0 && a[i] >= a[i + 1]) i--; if (i < 0) return null; let j = a.length - 1; while (a[j] <= a[i]) j--; [a[i], a[j]] = [a[j], a[i]]; let l = i + 1, r = a.length - 1; while (l < r) { [a[l], a[r]] = [a[r], a[l]]; l++; r--; } return a; };
  const lastSub = s => { let i = 0, j = 1, k = 0; while (j + k < s.length) { if (s[i + k] === s[j + k]) { k++; continue; } if (s[i + k] > s[j + k]) j = j + k + 1; else { i = Math.max(i + k + 1, j); j = i + 1; } k = 0; } return i; };
  const pairIdx = (o, I) => { if (!Array.isArray(o) || o.length !== 2) return false; const [i, j] = o; if (i === -1 && j === -1) { for (let a = 0; a < I.nums.length; a++) for (let b = 0; b < I.nums.length; b++) if (Math.abs(a - b) >= I.indexDifference && Math.abs(I.nums[a] - I.nums[b]) >= I.valueDifference) return false; return true; } return i >= 0 && j >= 0 && i < I.nums.length && j < I.nums.length && Math.abs(i - j) >= I.indexDifference && Math.abs(I.nums[i] - I.nums[j]) >= I.valueDifference; };
  const idxDiff = (I, T) => { const a = I.nums; let mn = 0, mx = 0, asks = 0; for (let j = I.indexDifference; j < a.length; j++) { const i = j - I.indexDifference; if (a[i] < a[mn]) mn = i; if (a[i] > a[mx]) mx = i; if (asks++ < 6) { T.at({ nums: A(a, { mn, mx, j }), valueDiff: I.valueDifference }); T.n('Largest |nums[j] − partner| available?', Math.max(Math.abs(a[j] - a[mn]), Math.abs(a[j] - a[mx])), 'Partner is the min or max seen at index ≤ j − indexDifference.'); } if (a[j] - a[mn] >= I.valueDifference) return [mn, j]; if (a[mx] - a[j] >= I.valueDifference) return [mx, j]; } return [-1, -1]; };
  const box = (I, T) => { const w = I.word, n = w.length, L = n - I.numFriends + 1; if (I.numFriends === 1) { T.at({ word: w }); T.yn('With one friend, is the whole word the only split?', true, 'Return the word.'); return w; } const i = lastSub(w); T.at({ word: A([...w], { i }) }); T.n('Start of the lexicographically largest suffix?', i, 'Two-candidate comparison.'); T.n('Max allowed piece length?', L, 'n − numFriends + 1 (others need ≥ 1 char each).'); return w.slice(i, i + L); };
  const F = [null, (x, y) => x + y, (x, y) => x * y, (x, y) => x * x + y, (x, y) => x + y * y, (x, y) => x * x + y * y, (x, y) => (x + y) ** 2, (x, y) => x ** 3 + y ** 3, (x, y) => x * x * y, (x, y) => x * y * y];

  D('find-positive-integer-solution-for-a-given-equation', {
    t: 'Find Positive Integer Solution for a Given Equation',
    r: 'f increases in both x and y. Start at x = 1, y = z (top-left of a monotone grid): f < z → x++; f > z → y−−; equal → record and move both.',
    g: R => ({ function_id: R.int(1, 9), z: R.int(1, 30) }),
    cmp: 'set',
    s(I, T) { const f = F[I.function_id], out = []; let x = 1, y = I.z, asks = 0; while (x <= I.z && y >= 1) { const v = f(x, y); if (asks++ < 8 && (v === I.z || asks < 5)) { T.at({ x, y, 'f(x,y)': v, z: I.z }); T.c('Next move?', ['record', 'x++', 'y−−'], v === I.z ? 'record' : v < I.z ? 'x++' : 'y−−', 'Monotone in both arguments.'); } if (v === I.z) { out.push([x, y]); x++; y--; } else if (v < I.z) x++; else y--; } return out; }
  });

  D('maximum-score-of-a-good-subarray', {
    t: 'Maximum Score of a Good Subarray',
    r: 'Start with [k, k] and expand greedily toward the larger neighbor, tracking the running minimum. Score = min × length; keep the best.',
    g: R => { const a = R.ints(R.int(1, 8), 1, 9); return { nums: a, k: R.int(0, a.length - 1) }; },
    s(I, T) { const a = I.nums; let l = I.k, r = I.k, mn = a[I.k], best = mn, asks = 0; while (l > 0 || r < a.length - 1) { if (r === a.length - 1 || (l > 0 && a[l - 1] > a[r + 1])) l--; else r++; mn = Math.min(mn, a[l], a[r]); best = Math.max(best, mn * (r - l + 1)); if (asks++ < 7) { T.at({ nums: A(a, { win: [l, r] }), min: mn }); T.n('Best score so far?', best, 'min × length; expand toward the larger side.'); } } if (!asks) { T.at({ nums: A(a) }); T.n('Score?', best, 'Single element.'); } return best; }
  });

  D('sentence-similarity-iii', {
    t: 'Sentence Similarity III',
    r: 'Split into words. Match a common prefix from the left and a common suffix from the right (not overlapping in the shorter sentence). Similar iff together they cover all words of the shorter one.',
    g: R => { const w = Array.from({ length: R.int(1, 5) }, () => R.pick(['A', 'b', 'c', 'dd'])), s = w.slice(); const i = R.int(0, s.length); s.splice(i, R.int(0, 2)); if (R.chance(0.3)) s.push('x'); return { sentence1: w.join(' '), sentence2: (s.length ? s : ['b']).join(' ') }; },
    s(I, T) { let a = I.sentence1.split(' '), b = I.sentence2.split(' '); if (a.length < b.length) [a, b] = [b, a]; let i = 0; while (i < b.length && a[i] === b[i]) i++; let j = 0; while (j < b.length - i && a[a.length - 1 - j] === b[b.length - 1 - j]) j++; T.at({ longer: A(a), shorter: A(b) }); T.n('Common prefix words?', i, 'Match from the left.'); T.n('Common suffix words (not reusing prefix words)?', j, 'Match from the right.'); return i + j >= b.length; }
  });

  D('faulty-sensor', {
    t: 'Faulty Sensor',
    r: 'Find the first index i where the readings differ. Sensor 1 could be faulty if s1[i..n−2] equals s2[i+1..n−1] (it dropped s2[i]); likewise for sensor 2. Exactly one possibility → that sensor; otherwise −1.',
    g: R => { const n = R.int(1, 6), t = R.ints(n + 1, 1, 3), d = R.int(0, n - 1), drop = t.filter((_, i) => i !== d).slice(0, n - 1).concat(R.int(1, 9)), good = t.slice(0, n); return R.chance(0.5) ? { sensor1: drop, sensor2: good } : { sensor1: good, sensor2: drop }; },
    s(I, T) { const a = I.sensor1, b = I.sensor2, n = a.length; let i = 0; while (i < n && a[i] === b[i]) i++; T.at({ s1: A(a, { i: Math.min(i, n - 1) }), s2: A(b, { i: Math.min(i, n - 1) }) }); T.n('First differing index (n if none)?', i, 'Scan together.'); if (i >= n - 1) return -1; let f1 = true, f2 = true; for (let k = i; k < n - 1; k++) { if (a[k] !== b[k + 1]) f1 = false; if (b[k] !== a[k + 1]) f2 = false; } T.yn('Could sensor 1 have dropped a value?', f1, 's1[i..] shifted equals s2[i+1..].'); T.yn('Could sensor 2 have dropped a value?', f2, 'Symmetric check.'); return f1 === f2 ? -1 : f1 ? 1 : 2; }
  });

  D('next-palindrome-using-same-digits', {
    t: 'Next Palindrome Using Same Digits',
    r: 'A palindrome is fixed by its first half. Take the next permutation of the first half (none → ""), then mirror it around the middle digit.',
    g: R => { const h = R.ints(R.int(1, 4), 1, 4).join(''), mid = R.chance(0.5) ? String(R.int(1, 9)) : ''; return { num: h + mid + [...h].reverse().join('') }; },
    s(I, T) { const n = I.num.length, h = [...I.num.slice(0, n >> 1)].map(Number), np = nextPerm(h); T.at({ half: A(h) }); T.yn('Does the first half have a next permutation?', !!np, 'Otherwise return "".'); if (!np) return ''; const s = np.join(''), r = s + (n % 2 ? I.num[n >> 1] : '') + [...s].reverse().join(''); T.at({ newHalf: A(np) }); T.c('Result?', [...new Set([r, I.num, s + [...s].reverse().join('')])], r, 'Mirror the new half.'); return r; }
  });

  D('minimum-adjacent-swaps-to-reach-the-kth-smallest-number', {
    t: 'Minimum Adjacent Swaps to Reach the Kth Smallest Number',
    r: 'Apply next permutation k times to get the target. Then, left to right, find each target digit in the current string and bubble it into place with adjacent swaps, counting them.',
    g: R => { let num; do { num = R.ints(R.int(2, 6), 1, 4).join(''); } while (!nextPerm([...num])); return { num, k: 1 + R.int(0, 2) * 0 }; },
    s(I, T) { let t = [...I.num]; for (let i = 0; i < I.k; i++) t = nextPerm(t) || t; const c = [...I.num]; let sw = 0, asks = 0; T.at({ num: I.num, target: t.join('') }); T.c(`Target after ${I.k} next permutation(s)?`, [...new Set([t.join(''), I.num, [...I.num].reverse().join('')])], t.join(''), 'Apply next permutation k times.'); for (let i = 0; i < c.length; i++) { let j = i; while (c[j] !== t[i]) j++; sw += j - i; if (j > i && asks++ < 6) { T.at({ current: A(c.slice(), { i, j }) }); T.n('Swaps so far?', sw, 'Bubble the digit left by j − i.'); } while (j > i) { [c[j], c[j - 1]] = [c[j - 1], c[j]]; j--; } } return sw; }
  });

  D('rotating-the-box', {
    t: 'Rotating the Box',
    r: 'For each row, let stones fall to the right: a write pointer starts at the end and resets to just left of each obstacle "*". Then rotate clockwise: row i becomes column m − 1 − i.',
    g: R => ({ boxGrid: Array.from({ length: R.int(1, 3) }, () => [...R.str(R.int(1, 5), '#..*')]) }),
    s(I, T) { const g = I.boxGrid.map(r => r.slice()), m = g.length, n = g[0].length; g.forEach((row, i) => { let w = n - 1; for (let j = n - 1; j >= 0; j--) { if (row[j] === '*') w = j - 1; else if (row[j] === '#') { row[j] = '.'; row[w--] = '#'; } } if (i < 4) { T.at({ before: A(I.boxGrid[i]), after: A(row.slice()) }); T.n('Stones resting at the far right end?', (() => { let c = 0; for (let j = n - 1; j >= 0 && row[j] === '#'; j--) c++; return c; })(), 'Fall right until an obstacle.'); } }); return Array.from({ length: n }, (_, j) => Array.from({ length: m }, (_, i) => g[m - 1 - i][j])); }
  });

  D('product-of-two-run-length-encoded-arrays', {
    t: 'Product of Two Run-Length Encoded Arrays',
    r: 'Two pointers over the runs: take len = min(remaining1, remaining2), emit (v1 × v2, len), merging with the previous run if the product repeats; advance whichever run is used up.',
    g: R => { const tot = R.int(1, 8), runs = () => { const o = []; let left = tot; while (left) { const k = R.int(1, left); o.push([R.int(1, 3), k]); left -= k; } return o; }; return { encoded1: runs(), encoded2: runs() }; },
    s(I, T) { const a = I.encoded1.map(x => x.slice()), b = I.encoded2.map(x => x.slice()), out = []; let i = 0, j = 0, asks = 0; while (i < a.length) { const k = Math.min(a[i][1], b[j][1]), v = a[i][0] * b[j][0]; if (asks++ < 7) { T.at({ run1: a[i].join('×'), run2: b[j].join('×') }); T.n('Length of the next product run?', k, 'Min of the remaining lengths.'); } if (out.length && out[out.length - 1][0] === v) out[out.length - 1][1] += k; else out.push([v, k]); a[i][1] -= k; b[j][1] -= k; if (!a[i][1]) i++; if (!b[j][1]) j++; } return out; }
  });

  D('minimize-maximum-pair-sum-in-array', {
    t: 'Minimize Maximum Pair Sum in Array',
    r: 'Sort and pair the smallest with the largest, moving inward. The answer is the largest of those pair sums.',
    g: R => ({ nums: R.ints(2 * R.int(1, 4), 1, 9) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let best = 0; for (let l = 0, r = a.length - 1; l < r; l++, r--) { best = Math.max(best, a[l] + a[r]); if (l < 6) { T.at({ sorted: A(a, { l, r }) }); T.n('Max pair sum so far?', best, 'Smallest with largest.'); } } return best; }
  });

  D('check-if-string-is-a-prefix-of-array', {
    t: 'Check If String Is a Prefix of Array',
    r: 'Concatenate words in order while the total length is below |s|, checking each piece matches the next part of s. Prefix iff the lengths hit |s| exactly with all pieces matching.',
    g: R => { const w = Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 3), 'ab')), k = R.int(1, w.length); return { s: R.chance(0.7) ? w.slice(0, k).join('') : R.str(R.int(1, 5), 'ab'), words: w }; },
    s(I, T) { let p = 0; for (const w of I.words) { if (p >= I.s.length) break; const ok = I.s.startsWith(w, p); T.at({ s: A([...I.s], { p }), word: w }); T.yn('Does the word match at the pointer?', ok, 'Compare the next characters.'); if (!ok) return false; p += w.length; } return p === I.s.length; }
  });

  D('maximum-number-of-people-that-can-be-caught-in-tag', {
    t: 'Maximum Number of People That Can Be Caught in Tag',
    r: 'Two pointers: i over "it" players, j over non-it players. Skip j while it is too far left (j < i − dist); if j ≤ i + dist, catch it and advance both; otherwise move i.',
    g: R => ({ team: R.ints(R.int(1, 9), 0, 1), dist: R.int(1, 3) }),
    s(I, T) { const t = I.team, n = t.length; let j = 0, c = 0, asks = 0; for (let i = 0; i < n; i++) { if (t[i] !== 1) continue; while (j < n && (t[j] !== 0 || j < i - I.dist)) j++; const ok = j < n && j <= i + I.dist; if (asks++ < 7) { T.at({ team: A(t, { i, j: Math.min(j, n - 1) }), dist: I.dist }); T.yn(`Can "it" at ${i} catch someone?`, ok, 'Leftmost free non-it within dist.'); } if (ok) { c++; j++; } } return c; }
  });

  D('reverse-prefix-of-word', {
    t: 'Reverse Prefix of Word',
    r: 'Find the first occurrence of ch; reverse word[0..i] with two pointers. No occurrence → unchanged.',
    g: R => ({ word: R.str(R.int(1, 8), 'abcd'), ch: R.pick('abcde') }),
    s(I, T) { const i = I.word.indexOf(I.ch); T.at({ word: A([...I.word]), ch: I.ch }); T.n('Index of the first ch (−1 if none)?', i, 'Scan from the left.'); return i < 0 ? I.word : [...I.word.slice(0, i + 1)].reverse().join('') + I.word.slice(i + 1); }
  });

  D('watering-plants-ii', {
    t: 'Watering Plants II',
    r: 'Alice from the left, Bob from the right, each refilling (counted) when the can is short. At the shared middle plant, whoever has more water (Alice on ties) waters it, refilling if needed.',
    g: R => { const p = R.ints(R.int(1, 7), 1, 5), mx = Math.max(...p); return { plants: p, capacityA: R.int(mx, mx + 4), capacityB: R.int(mx, mx + 4) }; },
    s(I, T) { const p = I.plants; let i = 0, j = p.length - 1, a = I.capacityA, b = I.capacityB, r = 0, asks = 0; while (i < j) { if (a < p[i]) { a = I.capacityA; r++; } a -= p[i++]; if (b < p[j]) { b = I.capacityB; r++; } b -= p[j--]; if (asks++ < 5) { T.at({ plants: A(p, { i: i - 1, j: j + 1 }), alice: a, bob: b }); T.n('Refills so far?', r, 'Refill only when short.'); } } if (i === j) { const w = Math.max(a, b); if (w < p[i]) r++; T.at({ plants: A(p, { i }), alice: a, bob: b }); T.yn('Does the middle plant need a refill?', w < p[i], 'The fuller can waters it.'); } return r; }
  });

  D('find-first-palindromic-string-in-the-array', {
    t: 'Find First Palindromic String in the Array',
    r: 'Check words in order with a two-pointer palindrome test; return the first that passes, or "".',
    g: R => ({ words: Array.from({ length: R.int(1, 5) }, () => R.chance(0.3) ? (h => h + [...h].reverse().join('').slice(1))(R.str(R.int(1, 3), 'abc')) : R.str(R.int(1, 3), 'abc')) }),
    s(I, T) { for (const [k, w] of I.words.entries()) { const p = pal(w, 0, w.length - 1); if (k < 6) { T.at({ words: A(I.words, { i: k }) }); T.yn(`Is "${w}" a palindrome?`, p, 'Compare ends inward.'); } if (p) return w; } return ''; }
  });

  D('adding-spaces-to-a-string', {
    t: 'Adding Spaces to a String',
    r: 'Two pointers: walk s with i and the sorted spaces with j; when i equals spaces[j], emit a space first and advance j.',
    g: R => { const s = R.str(R.int(2, 9), 'abcXY'); return { s, spaces: R.distinct(R.int(1, Math.min(3, s.length - 1)), 1, s.length - 1).sort((a, b) => a - b) }; },
    s(I, T) { let out = '', j = 0; for (let i = 0; i < I.s.length; i++) { if (j < I.spaces.length && I.spaces[j] === i) { out += ' '; j++; T.at({ s: A([...I.s], { i }), out: JSON.stringify(out) }); T.n('Spaces inserted so far?', j, 'Space goes before s[i].'); } out += I.s[i]; } return out; }
  });

  D('rearrange-array-elements-by-sign', {
    t: 'Rearrange Array Elements by Sign',
    r: 'Two write pointers: positives go to even indices (0, 2, …), negatives to odd indices, each preserving order.',
    g: R => { const n = R.int(1, 4); return { nums: R.shuffle([...R.ints(n, 1, 9), ...R.ints(n, -9, -1)]) }; },
    s(I, T) { const out = []; let p = 0, q = 1; I.nums.forEach((x, i) => { const at = x > 0 ? p : q; if (i < 8) { T.at({ nums: A(I.nums, { i }) }); T.n(`Index where ${x} goes?`, at, x > 0 ? 'Next even slot.' : 'Next odd slot.'); } out[at] = x; if (x > 0) p += 2; else q += 2; }); return out; }
  });

  D('partition-array-according-to-given-pivot', {
    t: 'Partition Array According to Given Pivot',
    r: 'Stable three-way partition: collect values < pivot, then equal, then greater (two pointers filling from both ends work too).',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 9), pivot: R.int(2, 8) }),
    s(I, T) { const lo = I.nums.filter(x => x < I.pivot), eq = I.nums.filter(x => x === I.pivot); T.at({ nums: A(I.nums), pivot: I.pivot }); T.n('How many values are less than the pivot?', lo.length, 'They go first, in order.'); T.n('Index where the pivot block starts?', lo.length, 'Right after the smaller values.'); return [...lo, ...eq, ...I.nums.filter(x => x > I.pivot)]; }
  });

  D('find-all-k-distant-indices-in-an-array', {
    t: 'Find All K-Distant Indices in an Array',
    r: 'For each key position j, mark [j − k, j + k]; keep a pointer to the first unmarked index so each index is added once, in order.',
    g: R => { const a = R.ints(R.int(1, 9), 1, 4); return { nums: a, key: a[R.int(0, a.length - 1)], k: R.int(1, 3) }; },
    s(I, T) { const out = []; let next = 0; I.nums.forEach((x, j) => { if (x !== I.key) return; const s = Math.max(next, j - I.k), e = Math.min(I.nums.length - 1, j + I.k); for (let i = s; i <= e; i++) out.push(i); next = e + 1; T.at({ nums: A(I.nums, { j }), k: I.k }); T.n('Indices collected so far?', out.length, 'Add the new part of [j − k, j + k].'); }); return out; }
  });

  D('valid-palindrome-iv', {
    t: 'Valid Palindrome IV',
    r: 'Each mismatched pair (s[i], s[n − 1 − i]) needs one operation. With at most 2 operations allowed, answer whether mismatches ≤ 2.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc') }),
    s(I, T) { let c = 0; for (let l = 0, r = I.s.length - 1; l < r; l++, r--) { if (I.s[l] !== I.s[r]) c++; if (l < 6) { T.at({ s: A([...I.s], { l, r }) }); T.n('Mismatched pairs so far?', c, 'Each costs one change.'); } } if (I.s.length < 2) { T.at({ s: I.s }); T.n('Mismatches?', 0, 'Single character.'); } return c <= 2; }
  });

  D('move-pieces-to-obtain-a-string', {
    t: 'Move Pieces to Obtain a String',
    r: 'L only moves left and R only right, never crossing. Compare non-blank pieces in order: same letters, L at start index ≥ target index, R at start index ≤ target index.',
    g: R => { const s = R.str(R.int(1, 7), 'LR__'); let t = R.shuffle([...s]).join(''); if (R.chance(0.5)) { const a = [...s]; for (let k = 0; k < 4; k++) { const i = R.int(0, a.length - 2); if (a[i] === '_' && a[i + 1] === 'L') [a[i], a[i + 1]] = ['L', '_']; else if (a[i] === 'R' && a[i + 1] === '_') [a[i], a[i + 1]] = ['_', 'R']; } t = a.join(''); } return { start: s, target: t }; },
    s(I, T) { const p = [...I.start].map((c, i) => [c, i]).filter(x => x[0] !== '_'), q = [...I.target].map((c, i) => [c, i]).filter(x => x[0] !== '_'); const same = p.map(x => x[0]).join('') === q.map(x => x[0]).join(''); T.at({ start: I.start, target: I.target }); T.yn('Same piece order?', same, 'Pieces never pass each other.'); if (!same) return false; for (let k = 0; k < p.length; k++) { const ok = p[k][0] === 'L' ? p[k][1] >= q[k][1] : p[k][1] <= q[k][1]; if (k < 6) { T.at({ piece: p[k][0], from: p[k][1], to: q[k][1] }); T.yn('Legal move?', ok, 'L left, R right.'); } if (!ok) return false; } return true; }
  });

  D('number-of-arithmetic-triplets', {
    t: 'Number of Arithmetic Triplets',
    r: 'nums is strictly increasing. For each x, it starts a triplet iff x + diff and x + 2·diff are both present (set lookup or advancing pointers).',
    g: R => ({ nums: R.distinct(R.int(3, 8), 0, 15).sort((a, b) => a - b), diff: R.int(1, 4) }),
    s(I, T) { const S = new Set(I.nums); let c = 0; I.nums.forEach((x, i) => { const ok = S.has(x + I.diff) && S.has(x + 2 * I.diff); if (ok) c++; if (i < 8) { T.at({ nums: A(I.nums, { i }), diff: I.diff }); T.yn(`Do ${x + I.diff} and ${x + 2 * I.diff} both exist?`, ok, 'Then x starts a triplet.'); } }); return c; }
  });

  D('strictly-palindromic-number', {
    t: 'Strictly Palindromic Number',
    r: 'In base n − 2, n is written "12" for every n ≥ 5 (and n = 4 is "100" in base 2), which is never a palindrome. So the answer is always false.',
    g: R => ({ n: R.int(4, 38) }),
    s(I, T) { const b = I.n - 2, s = I.n.toString(b); T.at({ n: I.n, base: b }); T.c(`n written in base ${b}?`, [...new Set([s, '11', '21'])], s, 'n = 1·(n−2) + 2.'); T.yn('Is that a palindrome?', s === [...s].reverse().join(''), 'So n can never be strictly palindromic.'); return false; }
  });

  D('divide-intervals-into-minimum-number-of-groups', {
    t: 'Divide Intervals Into Minimum Number of Groups',
    r: 'The answer is the maximum number of intervals overlapping at a point (ends inclusive). Sort starts and ends; two pointers: a start ≤ the current smallest end opens a new group, otherwise reuse (advance the end pointer).',
    g: R => ({ intervals: Array.from({ length: R.int(1, 6) }, () => { const a = R.int(1, 10); return [a, a + R.int(0, 5)]; }) }),
    s(I, T) { const S = I.intervals.map(x => x[0]).sort((a, b) => a - b), E = I.intervals.map(x => x[1]).sort((a, b) => a - b); let j = 0, g = 0; S.forEach((s, i) => { const nw = s <= E[j]; if (nw) g++; else j++; if (i < 8) { T.at({ starts: A(S, { i }), ends: A(E, { j }) }); T.yn(`Does start ${s} need a new group?`, nw, 'It overlaps the earliest-ending group.'); } }); return g; }
  });

  D('maximum-matching-of-players-with-trainers', {
    t: 'Maximum Matching of Players With Trainers',
    r: 'Sort both. Two pointers: if the trainer can train the player, match and advance both; otherwise try the next (stronger) trainer.',
    g: R => ({ players: R.ints(R.int(1, 5), 1, 9), trainers: R.ints(R.int(1, 5), 1, 9) }),
    s(I, T) { const p = I.players.slice().sort((a, b) => a - b), t = I.trainers.slice().sort((a, b) => a - b); let i = 0, c = 0; for (let j = 0; j < t.length && i < p.length; j++) { const ok = p[i] <= t[j]; if (j < 8) { T.at({ players: A(p, { i }), trainers: A(t, { j }) }); T.yn('Match them?', ok, 'Trainer capacity ≥ player ability.'); } if (ok) { i++; c++; } } return c; }
  });

  D('merge-operations-to-turn-array-into-a-palindrome', {
    t: 'Merge Operations to Turn Array Into a Palindrome',
    r: 'Two pointers with running sums at each end. Equal → move both inward; the smaller side merges with its neighbor (one operation).',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 5) }),
    s(I, T) { const a = I.nums; let l = 0, r = a.length - 1, L = a[l], Rr = a[r], ops = 0, asks = 0; while (l < r) { let act; if (L === Rr) { act = 'move both'; l++; r--; L = a[l]; Rr = a[r]; } else if (L < Rr) { act = 'merge left'; l++; L += a[l]; ops++; } else { act = 'merge right'; r--; Rr += a[r]; ops++; } if (asks++ < 8) { T.at({ nums: A(a, { l, r }), left: L, right: Rr }); T.c('Last action?', ['move both', 'merge left', 'merge right'], act, 'Merge the smaller side.'); } } if (!asks) { T.at({ nums: A(a) }); T.n('Operations?', 0, 'Single element.'); } return ops; }
  });

  D('largest-positive-integer-that-exists-with-its-negative', {
    t: 'Largest Positive Integer That Exists With Its Negative',
    r: 'Sort; l at the most negative, r at the largest. If −a[l] equals a[r] → answer; if −a[l] is bigger move l, else move r.',
    g: R => ({ nums: R.distinct(R.int(1, 8), -6, 6).filter(x => x) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let l = 0, r = a.length - 1, asks = 0; while (l < r && a[l] < 0 && a[r] > 0) { const s = -a[l]; if (asks++ < 6) { T.at({ sorted: A(a, { l, r }) }); T.c('Next?', ['found', 'move l', 'move r'], s === a[r] ? 'found' : s > a[r] ? 'move l' : 'move r', 'Compare magnitudes.'); } if (s === a[r]) return s; if (s > a[r]) l++; else r--; } return -1; }
  });

  D('apply-operations-to-an-array', {
    t: 'Apply Operations to an Array',
    r: 'Sequentially: if nums[i] == nums[i + 1], double nums[i] and zero nums[i + 1]. Then move non-zeros forward with a write pointer and pad zeros.',
    g: R => ({ nums: R.ints(R.int(2, 8), 0, 3) }),
    s(I, T) { const a = I.nums.slice(); for (let i = 0; i + 1 < a.length; i++) if (a[i] === a[i + 1]) { a[i] *= 2; a[i + 1] = 0; if (i < 8) { T.at({ nums: A(a.slice(), { i }) }); T.n(`nums[${i}] after the operation?`, a[i], 'Doubled; the next becomes 0.'); } } const nz = a.filter(x => x); T.at({ nums: A(a) }); T.n('Non-zero values after shifting?', nz.length, 'Zeros go to the end.'); return [...nz, ...Array(a.length - nz.length).fill(0)]; }
  });

  D('total-cost-to-hire-k-workers', {
    t: 'Total Cost to Hire K Workers',
    r: 'Two min-heaps: the first `candidates` workers and the last `candidates` (not overlapping). Each session hire the cheaper top (smaller index on ties) and refill that heap from its side\'s pointer.',
    g: R => { const c = R.ints(R.int(1, 8), 1, 9); return { costs: c, k: R.int(1, c.length), candidates: R.int(1, 3) }; },
    s(I, T) { const c = I.costs; let l = 0, r = c.length - 1; const L = [], Rh = []; const fill = () => { while (L.length < I.candidates && l <= r) L.push([c[l], l++]); while (Rh.length < I.candidates && l <= r) Rh.push([c[r], r--]); }; fill(); let tot = 0; for (let s = 0; s < I.k; s++) { L.sort((a, b) => a[0] - b[0] || a[1] - b[1]); Rh.sort((a, b) => a[0] - b[0] || a[1] - b[1]); const useL = Rh.length === 0 || (L.length && (L[0][0] < Rh[0][0] || (L[0][0] === Rh[0][0] && L[0][1] < Rh[0][1]))); const [v] = useL ? L.shift() : Rh.shift(); tot += v; if (s < 7) { T.at({ costs: A(c), front: A(L.map(x => x[0])), back: A(Rh.map(x => x[0])) }); T.n('Cost of the worker hired?', v, 'Cheapest of both heaps; lower index on ties.'); } fill(); } return tot; }
  });

  D('number-of-distinct-averages', {
    t: 'Number of Distinct Averages',
    r: 'Sort; repeatedly pair the min and max (two pointers from the ends) and put min + max into a set (same sum ⇔ same average). Answer = set size.',
    g: R => ({ nums: R.ints(2 * R.int(1, 4), 0, 9) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), S = new Set(); for (let l = 0, r = a.length - 1; l < r; l++, r--) { S.add(a[l] + a[r]); if (l < 6) { T.at({ sorted: A(a, { l, r }) }); T.n('Distinct sums so far?', S.size, 'Track min + max.'); } } return S.size; }
  });

  D('append-characters-to-string-to-make-subsequence', {
    t: 'Append Characters to String to Make Subsequence',
    r: 'Greedily match t as a subsequence of s with two pointers. The unmatched suffix of t must be appended: |t| − matched.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc'), t: R.str(R.int(1, 5), 'abc') }),
    s(I, T) { let j = 0, asks = 0; for (let i = 0; i < I.s.length && j < I.t.length; i++) { const m = I.s[i] === I.t[j]; if (asks++ < 8) { T.at({ s: A([...I.s], { i }), t: A([...I.t], { j }) }); T.yn('Match?', m, 'Advance j on a match.'); } if (m) j++; } T.at({ matched: j }); T.n('Characters to append?', I.t.length - j, '|t| − matched.'); return I.t.length - j; }
  });

  D('divide-players-into-teams-of-equal-skill', {
    t: 'Divide Players Into Teams of Equal Skill',
    r: 'Sort and pair the weakest with the strongest. Every pair must have the same sum (else −1); add up the products.',
    g: R => { const n = R.int(1, 4), t = R.int(4, 10), a = []; for (let i = 0; i < n; i++) { const x = R.int(1, t - 1); a.push(x, t - x); } if (R.chance(0.3)) a[0]++; return { skill: R.shuffle(a) }; },
    s(I, T) { const a = I.skill.slice().sort((x, y) => x - y), tgt = a[0] + a[a.length - 1]; let ch = 0; for (let l = 0, r = a.length - 1; l < r; l++, r--) { const ok = a[l] + a[r] === tgt; if (l < 6) { T.at({ sorted: A(a, { l, r }), target: tgt }); T.yn('Does this pair hit the target sum?', ok, 'All teams must be equal.'); } if (!ok) return -1; ch += a[l] * a[r]; } return ch; }
  });

  D('maximum-enemy-forts-that-can-be-captured', {
    t: 'Maximum Enemy Forts That Can Be Captured',
    r: 'Track the last non-zero position. When reaching a non-zero x with forts[last] = −x (one is 1, the other −1), the zeros between them count; keep the max.',
    g: R => ({ forts: R.ints(R.int(1, 10), -1, 1) }),
    s(I, T) { const f = I.forts; let last = -1, best = 0, asks = 0; f.forEach((x, i) => { if (!x) return; if (last >= 0 && f[last] === -x) { best = Math.max(best, i - last - 1); if (asks++ < 6) { T.at({ forts: A(f, { win: [last, i] }) }); T.n('Best capture so far?', best, 'Zeros between a 1 and a −1.'); } } last = i; }); if (!asks) { T.at({ forts: A(f) }); T.n('Capture?', 0, 'No 1/−1 pair.'); } return best; }
  });

  D('find-the-array-concatenation-value', {
    t: 'Find the Array Concatenation Value',
    r: 'Two pointers from the ends: add the number formed by concatenating nums[l] and nums[r]; a lone middle element is added as is.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 40) }),
    s(I, T) { const a = I.nums; let l = 0, r = a.length - 1, s = 0; while (l <= r) { const v = l === r ? a[l] : +('' + a[l] + a[r]); s += v; T.at({ nums: A(a, { l, r }) }); T.n('Value added this step?', v, l === r ? 'Middle alone.' : 'Concatenate the ends.'); l++; r--; } return s; }
  });

  D('merge-two-2d-arrays-by-summing-values', {
    t: 'Merge Two 2D Arrays by Summing Values',
    r: 'Both arrays are sorted by id: two pointers; equal ids merge with summed values, otherwise emit the smaller id first.',
    g: R => ({ nums1: R.distinct(R.int(1, 4), 1, 6).sort((a, b) => a - b).map(i => [i, R.int(1, 9)]), nums2: R.distinct(R.int(1, 4), 1, 6).sort((a, b) => a - b).map(i => [i, R.int(1, 9)]) }),
    s(I, T) { const a = I.nums1, b = I.nums2, out = []; let i = 0, j = 0, asks = 0; while (i < a.length || j < b.length) { let v; if (j >= b.length || (i < a.length && a[i][0] < b[j][0])) v = a[i++].slice(); else if (i >= a.length || b[j][0] < a[i][0]) v = b[j++].slice(); else { v = [a[i][0], a[i][1] + b[j][1]]; i++; j++; } if (asks++ < 7) { T.at({ out: A(out.map(x => x.join(':'))) }); T.n(`Value for id ${v[0]}?`, v[1], 'Sum when both have it.'); } out.push(v); } return out; }
  });

  D('maximize-greatness-of-an-array', {
    t: 'Maximize Greatness of an Array',
    r: 'Sort. Pointer i over the "beaten" values; scan each value x: if x > sorted[i], it beats it — advance i. The count is i.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 6) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let i = 0; a.forEach((x, j) => { const b = x > a[i]; if (j < 8) { T.at({ sorted: A(a, { i, j }) }); T.yn(`Can ${x} beat ${a[i]}?`, b, 'Strictly greater.'); } if (b) i++; }); return i; }
  });

  D('lexicographically-smallest-palindrome', {
    t: 'Lexicographically Smallest Palindrome',
    r: 'Two pointers from the ends; when the characters differ, set both to the smaller one (one operation each, and the result is smallest).',
    g: R => ({ s: R.str(R.int(1, 8), 'abcde') }),
    s(I, T) { const a = [...I.s]; for (let l = 0, r = a.length - 1; l < r; l++, r--) { const m = a[l] < a[r] ? a[l] : a[r]; if (l < 6) { T.at({ s: A(a.slice(), { l, r }) }); T.c('Character for both ends?', [...new Set([m, a[l], a[r]])], m, 'The smaller one.'); } a[l] = a[r] = m; } if (a.length < 2) { T.at({ s: A(a) }); T.n('Changes?', 0, 'Single character.'); } return a.join(''); }
  });

  D('make-string-a-subsequence-using-cyclic-increments', {
    t: 'Make String a Subsequence Using Cyclic Increments',
    r: 'Greedy two pointers: str1[i] matches str2[j] if equal or one cyclic increment away (z → a). Advance j on a match; success iff j reaches the end.',
    g: R => ({ str1: R.str(R.int(1, 7), 'abyz'), str2: R.str(R.int(1, 4), 'abz') }),
    s(I, T) { const nx = c => c === 'z' ? 'a' : String.fromCharCode(c.charCodeAt(0) + 1); let j = 0, asks = 0; for (let i = 0; i < I.str1.length && j < I.str2.length; i++) { const c = I.str1[i], m = c === I.str2[j] || nx(c) === I.str2[j]; if (asks++ < 8) { T.at({ str1: A([...I.str1], { i }), str2: A([...I.str2], { j }) }); T.yn('Can str1[i] serve as str2[j]?', m, 'Equal or one step ahead (z→a).'); } if (m) j++; } return j === I.str2.length; }
  });

  D('find-indices-with-index-and-value-difference-i', {
    t: 'Find Indices With Index and Value Difference I',
    r: 'Scan j from indexDifference; keep the indices of the min and max among nums[0..j − indexDifference]. If nums[j] is far enough from either, return that pair.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 9), indexDifference: R.int(0, 3), valueDifference: R.int(0, 6) }),
    cmp: (o, e, I) => pairIdx(o, I),
    s: idxDiff
  });

  D('find-indices-with-index-and-value-difference-ii', {
    t: 'Find Indices With Index and Value Difference II',
    r: 'O(n): scan j from indexDifference, maintaining the min and max index among nums[0..j − indexDifference]. Check nums[j] against both extremes.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 9), indexDifference: R.int(0, 3), valueDifference: R.int(0, 6) }),
    cmp: (o, e, I) => pairIdx(o, I),
    s: idxDiff
  });

  D('separate-black-and-white-balls', {
    t: 'Separate Black and White Balls',
    r: 'Each 0 (white) must pass every 1 (black) to its left. Count the 1s seen so far and add that count at every 0.',
    g: R => ({ s: R.str(R.int(1, 10), '01') }),
    s(I, T) { let ones = 0, st = 0, asks = 0; [...I.s].forEach((c, i) => { if (c === '1') ones++; else { st += ones; if (asks++ < 7) { T.at({ s: A([...I.s], { i }) }); T.n('Steps so far?', st, 'This white ball passes every black ball before it.'); } } }); if (!asks) { T.at({ s: I.s }); T.n('Steps?', 0, 'No white ball needs to move.'); } return st; }
  });

  D('find-the-integer-added-to-array-ii', {
    t: 'Find the Integer Added to Array II',
    r: 'Sort both. One of nums1\'s three smallest survives as the partner of nums2[0], so x ∈ {nums2[0] − nums1[i] : i ≤ 2}. For each candidate (smallest first) check with two pointers that nums2 is nums1 + x after skipping at most two elements.',
    g: R => { const n = R.int(3, 7), a = R.ints(n, 0, 9), x = R.int(-3, 3), b = R.shuffle(R.shuffle(a).slice(2).map(v => v + x)); return { nums1: a, nums2: b }; },
    s(I, T) { const a = I.nums1.slice().sort((x, y) => x - y), b = I.nums2.slice().sort((x, y) => x - y), cand = [...new Set([0, 1, 2].map(i => b[0] - a[i]))].sort((x, y) => x - y); for (const x of cand) { let j = 0, skip = 0; for (const v of a) { if (j < b.length && v + x === b[j]) j++; else skip++; } const ok = j === b.length && skip <= 2; T.at({ nums1: A(a), nums2: A(b), x }); T.yn(`Does x = ${x} work?`, ok, 'Match with at most 2 skips.'); if (ok) return x; } return cand[0]; }
  });

  D('minimum-average-of-smallest-and-largest-elements', {
    t: 'Minimum Average of Smallest and Largest Elements',
    r: 'Sort; pair the ends inward, computing (min + max) / 2 each round, and return the smallest average.',
    g: R => ({ nums: R.ints(2 * R.int(1, 4), 1, 15) }),
    cmp: 'float',
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let best = Infinity; for (let l = 0, r = a.length - 1; l < r; l++, r--) { best = Math.min(best, (a[l] + a[r]) / 2); if (l < 6) { T.at({ sorted: A(a, { l, r }) }); T.n('Smallest average so far?', best, '(min + max) / 2.'); } } return best; }
  });

  D('minimum-number-of-flips-to-make-binary-grid-palindromic-i', {
    t: 'Minimum Number of Flips to Make Binary Grid Palindromic I',
    r: 'Making all rows palindromic costs one flip per mismatched mirrored pair in each row; same for columns. Answer = min of the two totals.',
    g: R => { const n = R.int(1, 4); return { grid: Array.from({ length: R.int(1, 4) }, () => R.ints(n, 0, 1)) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; let rw = 0, cl = 0; for (const r of g) for (let l = 0, q = n - 1; l < q; l++, q--) if (r[l] !== r[q]) rw++; for (let j = 0; j < n; j++) for (let l = 0, q = m - 1; l < q; l++, q--) if (g[l][j] !== g[q][j]) cl++; T.at({ grid: G(g) }); T.n('Flips to make every row a palindrome?', rw, 'Mismatched pairs per row.'); T.n('Flips to make every column a palindrome?', cl, 'Mismatched pairs per column.'); return Math.min(rw, cl); }
  });

  D('minimum-number-of-flips-to-make-binary-grid-palindromic-ii', {
    t: 'Minimum Number of Flips to Make Binary Grid Palindromic II',
    r: 'Each group of 4 mirrored cells must be equal: cost min(ones, 4 − ones). The middle row/column (odd sizes) has mirrored pairs: d mismatched pairs, and o ones in matching pairs. If o % 4 == 0 pay d; else pay d if d > 0 (one mismatch becomes 11) or 2. The center cell must be 0.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { grid: Array.from({ length: m }, () => R.ints(n, 0, 1)) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; let c = 0; for (let i = 0; i < m >> 1; i++) for (let j = 0; j < n >> 1; j++) { const o = g[i][j] + g[i][n - 1 - j] + g[m - 1 - i][j] + g[m - 1 - i][n - 1 - j]; c += Math.min(o, 4 - o); } T.at({ grid: G(g) }); T.n('Flips for the 4-cell mirror groups?', c, 'min(ones, 4 − ones) each.'); let d = 0, o = 0; const pair = (x, y) => { if (x !== y) d++; else if (x) o += 2; }; if (m % 2) { const r = m >> 1; for (let j = 0; j < n >> 1; j++) pair(g[r][j], g[r][n - 1 - j]); } if (n % 2) { const q = n >> 1; for (let i = 0; i < m >> 1; i++) pair(g[i][q], g[m - 1 - i][q]); } if (m % 2 && n % 2) c += g[m >> 1][n >> 1]; if (m % 2 || n % 2) { T.at({ mismatchedPairs: d, onesInMatchedPairs: o }); T.n('Mismatched pairs on the middle line(s)?', d, 'Each costs one flip.'); } c += (o % 4 === 0 || d > 0) ? d : 2; return c; }
  });

  D('maximum-number-of-matching-indices-after-right-shifts', {
    t: 'Maximum Number of Matching Indices After Right Shifts',
    r: 'Try every right shift k of nums1 and count indices i where nums1[(i − k) mod n] == nums2[i]; keep the maximum (O(n²)).',
    g: R => { const n = R.int(1, 6); return { nums1: R.ints(n, 1, 3), nums2: R.ints(n, 1, 3) }; },
    s(I, T) { const a = I.nums1, b = I.nums2, n = a.length; let best = 0; for (let k = 0; k < n; k++) { let c = 0; for (let i = 0; i < n; i++) if (a[(i - k + n) % n] === b[i]) c++; best = Math.max(best, c); if (k < 6) { T.at({ shifted: A(b.map((_, i) => a[(i - k + n) % n])), nums2: A(b) }); T.n(`Matches after ${k} shift(s)?`, c, 'Compare index by index.'); } } return best; }
  });

  D('find-the-lexicographically-largest-string-from-the-box-i', {
    t: 'Find the Lexicographically Largest String From the Box I',
    r: 'Any piece can be at most n − numFriends + 1 long. The best piece starts at the start of the largest suffix, truncated to that length (numFriends = 1 → the whole word).',
    g: R => { const w = R.str(R.int(1, 8), 'abcd'); return { word: w, numFriends: R.int(1, w.length) }; },
    s: box
  });

  D('find-the-lexicographically-largest-string-from-the-box-ii', {
    t: 'Find the Lexicographically Largest String From the Box II',
    r: 'Find the largest suffix in O(n) with the two-candidate method (i, j, offset k), then cut it to length n − numFriends + 1 (whole word if numFriends = 1).',
    g: R => { const w = R.str(R.int(1, 9), 'abc'); return { word: w, numFriends: R.int(1, w.length) }; },
    s: box
  });

  D('longest-common-prefix-after-at-most-one-removal', {
    t: 'Longest Common Prefix After at Most One Removal',
    r: 'Two pointers over s and t. On the first mismatch, skip that character of s (the one removal); on a second mismatch stop. The answer is how far t was matched.',
    g: R => { const t = R.str(R.int(1, 6), 'abc'); let s = t; if (R.chance(0.7)) { const i = R.int(0, s.length); s = s.slice(0, i) + R.pick('abc') + s.slice(i); } else s = R.str(R.int(1, 6), 'abc'); return { s, t }; },
    s(I, T) { let i = 0, j = 0, used = false, asks = 0; while (i < I.s.length && j < I.t.length) { const m = I.s[i] === I.t[j]; if (asks++ < 8) { T.at({ s: A([...I.s], { i }), t: A([...I.t], { j }), removed: used ? 'yes' : 'no' }); T.c('Action?', ['match', 'remove s[i]', 'stop'], m ? 'match' : used ? 'stop' : 'remove s[i]', 'One removal allowed.'); } if (m) { i++; j++; } else if (!used) { used = true; i++; } else break; } return j; }
  });
})();
