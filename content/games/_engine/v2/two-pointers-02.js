/* v2 games: two pointers (02). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const pal = (s, i, j) => { while (i < j) if (s[i++] !== s[j--]) return false; return true; };
  const perm = (o, e) => Array.isArray(o) && JSON.stringify(o.slice().sort((a, b) => a - b)) === JSON.stringify(e.slice().sort((a, b) => a - b));

  D('remove-duplicates-from-sorted-array-ii', {
    t: 'Remove Duplicates from Sorted Array II',
    r: 'Write pointer k: copy nums[i] when k < 2 or nums[i] differs from nums[k − 2] (so at most two copies survive). Return k.',
    g: R => ({ nums: R.sorted(R.int(1, 9), 0, 4) }),
    s(I, T) { const a = I.nums.slice(); let k = 0; a.forEach((x, i) => { const keep = k < 2 || x !== a[k - 2]; if (i < 10) { T.at({ nums: A(a.slice(), { i, k }) }); T.yn(`Keep nums[${i}] = ${x}?`, keep, 'Compare with nums[k − 2].'); } if (keep) a[k++] = x; }); return k; }
  });

  D('merge-sorted-array', {
    t: 'Merge Sorted Array',
    r: 'Fill nums1 from the back: compare the last unused elements of both arrays and write the larger at position p, moving that pointer left. Leftover nums2 elements are copied.',
    g: R => { const m = R.int(0, 4), n = R.int(0, 4) || (m ? 0 : 1); return { nums1: [...R.sorted(m, 0, 9), ...Array(n).fill(0)], m, nums2: R.sorted(n, 0, 9), n }; },
    s(I, T) { const a = I.nums1.slice(), b = I.nums2; let i = I.m - 1, j = I.n - 1, p = I.m + I.n - 1, asks = 0; while (j >= 0) { const takeA = i >= 0 && a[i] > b[j]; if (asks++ < 8) { T.at({ nums1: A(a.slice(), { i: Math.max(i, 0), p }), nums2: A(b, { j }) }); T.n(`Value written at index ${p}?`, takeA ? a[i] : b[j], 'Larger of the two tails.'); } a[p--] = takeA ? a[i--] : b[j--]; } return a; }
  });

  D('reverse-words-in-a-string-ii', {
    t: 'Reverse Words in a String II',
    r: 'In place: reverse the whole character array, then reverse each word back (boundaries at spaces).',
    g: R => ({ s: [...Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 3), 'abcd')).join(' ')] }),
    s(I, T) { const a = I.s.slice(); T.at({ s: A(I.s.slice()) }); T.n('How many words?', I.s.join('').split(' ').length, 'Spaces separate them.'); a.reverse(); T.at({ s: A(a.slice()) }); T.c('First character after reversing everything?', [...new Set([a[0], I.s[0], a[a.length - 1]])], a[0], 'Whole reverse first.'); let st = 0; for (let i = 0; i <= a.length; i++) if (i === a.length || a[i] === ' ') { let l = st, r = i - 1; while (l < r) { [a[l], a[r]] = [a[r], a[l]]; l++; r--; } st = i + 1; } T.at({ s: A(a.slice()) }); T.c('Final first word?', [...new Set([a.join('').split(' ')[0], I.s.join('').split(' ')[0]])], a.join('').split(' ')[0], 'Each word reversed back.'); return a; }
  });

  D('rotate-array', {
    t: 'Rotate Array',
    r: 'k %= n, then three reversals: reverse all, reverse the first k, reverse the rest.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9), k: R.int(0, 10) }),
    s(I, T) { const n = I.nums.length, k = I.k % n, a = I.nums.slice(), rev = (l, r) => { while (l < r) { [a[l], a[r]] = [a[r], a[l]]; l++; r--; } }; T.at({ nums: A(a.slice()), k: I.k }); T.n('Effective k (k mod n)?', k, 'Full rotations do nothing.'); rev(0, n - 1); T.at({ nums: A(a.slice()) }); T.n('First element after reversing all?', a[0], 'Step 1.'); rev(0, k - 1); rev(k, n - 1); T.at({ nums: A(a.slice()) }); T.n('First element of the result?', a[0], 'Reverse both parts.'); return a; }
  });

  D('reverse-string', {
    t: 'Reverse String',
    r: 'Swap s[l] and s[r] and move both pointers inward until they meet.',
    g: R => ({ s: [...R.str(R.int(1, 8), 'abcdeH')] }),
    s(I, T) { const res = (() => { const a = I.s.slice(); let l = 0, r = a.length - 1; while (l < r) { T.at({ s: A(a.slice(), { l, r }) }); T.c('Swap which pair?', [...new Set([`${a[l]} and ${a[r]}`, `${a[l]} and ${a[l + 1]}`])], `${a[l]} and ${a[r]}`, 'The outer pair.'); [a[l], a[r]] = [a[r], a[l]]; l++; r--; } if (a.length < 2) { T.at({ s: A(a) }); T.yn('Is there anything to swap?', false, 'A single character.'); } return a; })(); T.n('Swaps made?', Math.floor(I.s.length / 2), 'Half the length, rounded down.'); return res; }
  });

  D('shortest-distance-to-a-character', {
    t: 'Shortest Distance to a Character',
    r: 'Two passes: left to right with the last seen c, right to left with the next c; each answer is the smaller distance.',
    g: R => { const s = R.str(R.int(1, 10), 'abe'); return { s: s.includes('e') ? s : s + 'e', c: 'e' }; },
    s(I, T) { const n = I.s.length, d = Array(n).fill(Infinity); let p = -Infinity; for (let i = 0; i < n; i++) { if (I.s[i] === I.c) p = i; d[i] = i - p; } p = Infinity; for (let i = n - 1; i >= 0; i--) { if (I.s[i] === I.c) p = i; d[i] = Math.min(d[i], p - i); } [0, n >> 1, n - 1].forEach(i => { T.at({ s: A([...I.s], { i }) }); T.n(`Distance at index ${i}?`, d[i], 'Min of the two passes.'); }); return d; }
  });

  D('most-profit-assigning-work', {
    t: 'Most Profit Assigning Work',
    r: 'Sort jobs by difficulty and workers by ability. Sweep a pointer over jobs a worker can do, tracking the best profit so far; each worker earns that best.',
    g: R => { const n = R.int(1, 5); return { difficulty: R.ints(n, 1, 9), profit: R.ints(n, 1, 9), worker: R.ints(R.int(1, 5), 1, 9) }; },
    s(I, T) { const J = I.difficulty.map((d, i) => [d, I.profit[i]]).sort((a, b) => a[0] - b[0]), W = I.worker.slice().sort((a, b) => a - b); let j = 0, best = 0, tot = 0; for (const w of W) { while (j < J.length && J[j][0] <= w) best = Math.max(best, J[j++][1]); tot += best; T.at({ jobs: A(J.map(([d, p]) => `d${d}:$${p}`), { j: Math.min(j, J.length - 1) }), worker: w }); T.n('Profit for this worker?', best, 'Best profit among jobs ≤ ability.'); } return tot; }
  });

  D('positions-of-large-groups', {
    t: 'Positions of Large Groups',
    r: 'Walk groups with a start pointer i and scan j to the end of the run; record [i, j − 1] when the group has length ≥ 3.',
    g: R => ({ s: Array.from({ length: R.int(1, 5) }, () => R.pick('abc').repeat(R.int(1, 4))).join('') }),
    s(I, T) { const s = I.s, out = []; let i = 0; while (i < s.length) { let j = i; while (j < s.length && s[j] === s[i]) j++; T.at({ s: A([...s], { win: [i, j - 1] }) }); T.yn('Is this a large group (≥ 3)?', j - i >= 3, `Length ${j - i}.`); if (j - i >= 3) out.push([i, j - 1]); i = j; } return out; }
  });

  D('flipping-an-image', {
    t: 'Flipping an Image',
    r: 'For each row, two pointers from both ends swap and invert in one pass (the middle element is just inverted).',
    g: R => { const n = R.int(1, 4); return { image: Array.from({ length: n }, () => R.ints(n, 0, 1)) }; },
    s(I, T) { const out = I.image.map(r => r.slice().reverse().map(x => 1 - x)); out.forEach((r, i) => { if (i < 4) { T.at({ row: A(I.image[i]) }); T.n('First value after flip + invert?', r[0], 'Invert the last value.'); } }); return out; }
  });

  D('maximize-distance-to-closest-person', {
    t: 'Maximize Distance to Closest Person',
    r: 'Look at gaps of empty seats: a leading or trailing gap gives its full length; an inner gap of length g gives ⌈g / 2⌉. Take the maximum.',
    g: R => { const s = R.ints(R.int(2, 10), 0, 1); s[R.int(0, s.length - 1)] = 1; if (!s.includes(0)) s[0] = 0; return { seats: s }; },
    s(I, T) { const s = I.seats, n = s.length; let best = 0, prev = -1; for (let i = 0; i <= n; i++) { if (i < n && !s[i]) continue; const g = prev < 0 ? i : i === n ? n - 1 - prev : Math.floor((i - prev) / 2); if (prev >= 0 || i < n) { best = Math.max(best, g); T.at({ seats: A(s, { win: [prev + 1, i - 1] }) }); T.n('Distance this gap offers?', g, prev < 0 || i === n ? 'Edge gap: its full length.' : 'Inner gap: half.'); } prev = i; } return best; }
  });

  D('advantage-shuffle', {
    t: 'Advantage Shuffle',
    r: 'Sort nums1. Take nums2 values from largest down: if nums1\'s largest beats it, use it there; otherwise sacrifice nums1\'s smallest on it.',
    g: R => { const n = R.int(1, 6); return { nums1: R.ints(n, 1, 9), nums2: R.ints(n, 1, 9) }; },
    cmp: (o, e, I) => { const adv = a => a.filter((x, i) => x > I.nums2[i]).length; return perm(o, I.nums1) && adv(o) === adv(e); },
    s(I, T) { const a = I.nums1.slice().sort((x, y) => x - y), idx = I.nums2.map((x, i) => i).sort((x, y) => I.nums2[y] - I.nums2[x]), out = Array(a.length); let l = 0, r = a.length - 1; idx.forEach((i, k) => { const win = a[r] > I.nums2[i]; if (k < 8) { T.at({ sorted1: A(a, { l, r }), target: I.nums2[i] }); T.c(`Against ${I.nums2[i]}, use…`, ['largest', 'smallest'], win ? 'largest' : 'smallest', 'Win with the largest if possible, else sacrifice the smallest.'); } out[i] = win ? a[r--] : a[l++]; }); return out; }
  });

  D('sort-array-by-parity', {
    t: 'Sort Array By Parity',
    r: 'Two pointers: l from the left stops at an odd, r from the right stops at an even; swap them and continue.',
    g: R => ({ nums: R.ints(R.int(1, 8), 0, 9) }),
    cmp: (o, e, I) => perm(o, I.nums) && o.every((x, i) => i === 0 || !(o[i - 1] % 2 === 1 && x % 2 === 0)),
    s(I, T) { const res = (() => { const a = I.nums.slice(); T.at({ nums: A(a) }); T.n('How many odd values?', a.filter(x => x % 2).length, 'They all end up on the right.'); let l = 0, r = a.length - 1, asks = 0; while (l < r) { if (a[l] % 2 === 0) { l++; continue; } if (a[r] % 2) { r--; continue; } if (asks++ < 6) { T.at({ nums: A(a.slice(), { l, r }) }); T.c('Swap which values?', [`${a[l]} and ${a[r]}`, 'no swap'], `${a[l]} and ${a[r]}`, 'Odd on the left, even on the right.'); } [a[l], a[r]] = [a[r], a[l]]; } if (!asks) { T.at({ nums: A(a) }); T.n('Swaps needed?', 0, 'Already partitioned.'); } return a; })(); T.n('First odd index in the result (−1 if none)?', res.findIndex(x => x % 2), 'Right after all the even values.'); return res; }
  });

  D('reverse-only-letters', {
    t: 'Reverse Only Letters',
    r: 'Two pointers skip non-letters from each side and swap the letters they land on.',
    g: R => ({ s: R.str(R.int(1, 9), 'abC-d=E') }),
    s(I, T) { const res = (() => { const a = [...I.s], L = c => /[a-z]/i.test(c); let l = 0, r = a.length - 1, asks = 0; while (l < r) { if (!L(a[l])) { l++; continue; } if (!L(a[r])) { r--; continue; } if (asks++ < 6) { T.at({ s: A(a.slice(), { l, r }) }); T.c('Which letters swap?', [`${a[l]} and ${a[r]}`, 'skip this pair'], `${a[l]} and ${a[r]}`, 'Both pointers are on letters.'); } [a[l], a[r]] = [a[r], a[l]]; l++; r--; } if (!asks) { T.at({ s: A(a) }); T.n('Swaps?', 0, 'At most one letter.'); } return a.join(''); })(); T.n('Letters in s?', [...I.s].filter(c => /[a-z]/i.test(c)).length, 'Only these move.'); return res; }
  });

  D('sort-array-by-parity-ii', {
    t: 'Sort Array By Parity II',
    r: 'Pointer i walks even indices, j walks odd indices. When nums[i] is odd, advance j to an even value at an odd index and swap.',
    g: R => { const n = R.int(1, 4), e = Array.from({ length: n }, () => 2 * R.int(0, 4)), o = Array.from({ length: n }, () => 2 * R.int(0, 4) + 1); return { nums: R.shuffle([...e, ...o]) }; },
    cmp: (o, e, I) => perm(o, I.nums) && o.every((x, i) => x % 2 === i % 2),
    s(I, T) { const a = I.nums.slice(); let j = 1, asks = 0; T.at({ nums: A(a) }); T.n('Even indices holding an odd value?', a.filter((x, i) => i % 2 === 0 && x % 2).length, 'Each needs one swap.'); for (let i = 0; i < a.length; i += 2) { if (a[i] % 2) { while (a[j] % 2) j += 2; if (asks++ < 6) { T.at({ nums: A(a.slice(), { i, j }) }); T.n(`Index swapped with ${i}?`, j, 'Next odd index holding an even value.'); } [a[i], a[j]] = [a[j], a[i]]; } } if (!asks) { T.at({ nums: A(a) }); T.n('Swaps?', 0, 'Already placed.'); } return a; }
  });

  D('3sum-with-multiplicity', {
    t: '3Sum With Multiplicity',
    r: 'For each middle j, combine a count map of values left of j with each k > j: add left[target − a[j] − a[k]]. Take the result mod 1e9+7.',
    g: R => ({ arr: R.ints(R.int(3, 9), 0, 4), target: R.int(2, 9) }),
    s(I, T) { const a = I.arr, left = {}; let c = 0, asks = 0; for (let j = 0; j < a.length; j++) { for (let k = j + 1; k < a.length; k++) c += left[I.target - a[j] - a[k]] || 0; if (asks++ < 8 && j) { T.at({ arr: A(a, { j }), left: K(left) }); T.n(`Triples with middle index ${j} counted so far (total)?`, c, 'Σ left[target − a[j] − a[k]].'); } left[a[j]] = (left[a[j]] || 0) + 1; } return c % 1000000007; }
  });

  D('long-pressed-name', {
    t: 'Long Pressed Name',
    r: 'Walk typed with j and name with i: a match advances both; otherwise typed[j] must repeat typed[j − 1]. At the end all of name must be consumed.',
    g: R => { const n = R.str(R.int(1, 5), 'abc'); let t = [...n].map(c => c.repeat(R.int(1, 3))).join(''); if (R.chance(0.3)) t = R.str(R.int(1, 7), 'abc'); return { name: n, typed: t }; },
    s(I, T) { const n = I.name, t = I.typed; let i = 0, asks = 0; for (let j = 0; j < t.length; j++) { let act; if (i < n.length && n[i] === t[j]) { act = 'match'; i++; } else if (j && t[j] === t[j - 1]) act = 'long press'; else act = 'fail'; if (asks++ < 8) { T.at({ name: A([...n], { i: Math.min(i, n.length - 1) }), typed: A([...t], { j }) }); T.c(`typed[${j}] = ${t[j]} is a…`, ['match', 'long press', 'fail'], act, 'Prefer matching the name.'); } if (act === 'fail') return false; } return i === n.length; }
  });

  D('three-equal-parts', {
    t: 'Three Equal Parts',
    r: 'The ones must split into three equal counts. The third part fixes the pattern (from its first 1 to the end, trailing zeros included); match that pattern starting at the first 1 of parts one and two.',
    g: R => ({ arr: R.ints(R.int(3, 9), 0, 1) }),
    cmp: (o, e, I) => { if (e[0] === -1) return o[0] === -1 && o[1] === -1; const [i, j] = o, a = I.arr, v = s => s.join('').replace(/^0+/, ''); return i + 1 < j && j < a.length && v(a.slice(0, i + 1)) === v(a.slice(i + 1, j)) && v(a.slice(i + 1, j)) === v(a.slice(j)); },
    s(I, T) { const res = (() => { const a = I.arr, n = a.length, ones = a.filter(x => x).length; T.at({ arr: A(a) }); T.n('Number of ones?', ones, 'Must split evenly into 3.'); if (ones % 3) return [-1, -1]; if (!ones) return [0, n - 1]; const k = ones / 3, pos = []; a.forEach((x, i) => x && pos.push(i)); const p1 = pos[0], p2 = pos[k], p3 = pos[2 * k], L = n - p3; T.n('Length of the pattern (third part from its first 1)?', L, 'Trailing zeros belong to every part.'); for (let t = 0; t < L; t++) if (a[p1 + t] !== a[p3 + t] || a[p2 + t] !== a[p3 + t]) return [-1, -1]; if (p1 + L > p2 || p2 + L > p3) return [-1, -1]; return [p1 + L - 1, p2 + L]; })(); T.yn('Can the array be split into three equal parts?', res[0] !== -1, 'Same ones, same pattern, same trailing zeros.'); return res; }
  });

  D('valid-mountain-array', {
    t: 'Valid Mountain Array',
    r: 'Climb while strictly increasing, then descend while strictly decreasing. Valid iff the peak is not at either end and the walk reaches the end.',
    g: R => { const n = R.int(1, 7); if (R.chance(0.5)) { const p = R.int(0, n - 1), a = []; for (let i = 0; i < n; i++) a.push(10 - Math.abs(i - p) * R.int(1, 2)); return { arr: a }; } return { arr: R.ints(n, 0, 5) }; },
    s(I, T) { const res = (() => { const a = I.arr, n = a.length; let i = 0; while (i + 1 < n && a[i] < a[i + 1]) i++; T.at({ arr: A(a, { i }) }); T.n('Peak index after climbing?', i, 'Climb while strictly increasing.'); if (i === 0 || i === n - 1) return false; while (i + 1 < n && a[i] > a[i + 1]) i++; T.at({ arr: A(a, { i }) }); T.yn('Did the descent reach the end?', i === n - 1, 'Strictly decreasing to the end.'); return i === n - 1; })(); T.yn('Is it a valid mountain?', res, 'Strictly up, then strictly down, with both sides present.'); return res; }
  });

  D('di-string-match', {
    t: 'DI String Match',
    r: 'Keep lo = 0 and hi = n. For "I" output lo++ (everything later is bigger); for "D" output hi−−. Append the last remaining value.',
    g: R => ({ s: R.str(R.int(1, 8), 'ID') }),
    cmp: (o, e, I) => perm(o, e) && [...I.s].every((c, i) => c === 'I' ? o[i] < o[i + 1] : o[i] > o[i + 1]),
    s(I, T) { let lo = 0, hi = I.s.length; const out = []; [...I.s].forEach((c, i) => { const v = c === 'I' ? lo++ : hi--; if (i < 8) { T.at({ s: A([...I.s], { i }), out: A(out.slice()) }); T.n(`Value output for "${c}"?`, v, c === 'I' ? 'Smallest left.' : 'Largest left.'); } out.push(v); }); out.push(lo); return out; }
  });

  D('bag-of-tokens', {
    t: 'Bag of Tokens',
    r: 'Sort. Play the cheapest token face up while power allows (+1 score); otherwise, if it helps later, play the most expensive face down (+power, −1 score). Track the best score.',
    g: R => ({ tokens: R.ints(R.int(0, 6), 1, 9) .map(x => x * 10), power: R.int(0, 6) * 10 }),
    s(I, T) { const t = I.tokens.slice().sort((a, b) => a - b); let l = 0, r = t.length - 1, p = I.power, sc = 0, best = 0, asks = 0; while (l <= r) { let act; if (p >= t[l]) { act = 'face up'; p -= t[l++]; sc++; best = Math.max(best, sc); } else if (sc > 0 && l < r) { act = 'face down'; p += t[r--]; sc--; } else act = 'stop'; if (asks++ < 8) { T.at({ tokens: A(t, { l: Math.min(l, t.length - 1), r: Math.max(r, 0) }), power: p, score: sc }); T.c('Move just made?', ['face up', 'face down', 'stop'], act, 'Cheap up, expensive down.'); } if (act === 'stop') break; } if (!asks) { T.at({ tokens: '[]' }); T.n('Score?', 0, 'No tokens.'); } return best; }
  });

  D('maximum-width-ramp', {
    t: 'Maximum Width Ramp',
    r: 'Build a stack of indices with strictly decreasing values (candidate left ends). Scan j from the right; while nums[stack top] ≤ nums[j], pop and update width j − top.',
    g: R => ({ nums: R.ints(R.int(2, 9), 0, 9) }),
    s(I, T) { const a = I.nums, st = []; a.forEach((x, i) => { if (!st.length || a[st[st.length - 1]] > x) st.push(i); }); T.at({ nums: A(a) }); T.n('How many candidate left ends?', st.length, 'Prefix minima (strictly decreasing).'); let best = 0, asks = 0; for (let j = a.length - 1; j >= 0 && st.length; j--) while (st.length && a[st[st.length - 1]] <= a[j]) { const i = st.pop(); best = Math.max(best, j - i); if (asks++ < 6) { T.at({ nums: A(a, { i, j }) }); T.n('Best width so far?', best, 'j − i.'); } } return best; }
  });

  D('shortest-way-to-form-string', {
    t: 'Shortest Way to Form String',
    r: 'Greedy: each pass over source matches as many target characters as possible (as a subsequence). Count passes; a target character missing from source → −1.',
    g: R => ({ source: R.str(R.int(1, 4), 'abc'), target: R.str(R.int(1, 7), 'abcd') }),
    s(I, T) { const res = (() => { const S = I.source; T.at({ source: S, target: I.target }); T.n('Distinct letters in target?', new Set(I.target).size, 'Each must appear in source.'); if ([...I.target].some(c => !S.includes(c))) { T.at({ source: S, target: I.target }); T.yn('Does source contain every target letter?', false, 'Otherwise −1.'); return -1; } let i = 0, n = 0; while (i < I.target.length) { const st = i; for (const c of S) if (i < I.target.length && I.target[i] === c) i++; n++; if (n < 7) { T.at({ target: A([...I.target], { win: [st, i - 1] }) }); T.n(`Target characters covered after pass ${n}?`, i, 'Match greedily as a subsequence.'); } } return n; })(); T.n('Fewest subsequences (−1 if impossible)?', res, 'One per greedy pass.'); return res; }
  });

  D('duplicate-zeros', {
    t: 'Duplicate Zeros',
    r: 'First count how many zeros fit (each zero takes two slots) to find the last kept element; then copy backwards from there, writing zeros twice — careful with a zero that only half fits.',
    g: R => ({ arr: R.ints(R.int(1, 8), 0, 4).map(x => x < 2 ? 0 : x) }),
    s(I, T) { const a = I.arr, n = a.length, out = []; T.at({ arr: A(a) }); T.n('Zeros in the original?', a.filter(x => !x).length, 'Each one is written twice if it fits.'); for (const x of a) { if (out.length >= n) break; out.push(x); if (!x && out.length < n) out.push(0); } T.at({ arr: A(a) }); T.n('How many original elements survive?', a.findIndex((_, i) => { let c = 0; for (let k = 0; k <= i; k++) c += a[k] ? 1 : 2; return c >= n; }) + 1, 'Zeros take two slots.'); T.n('Last value of the result?', out[n - 1], 'Shifted right.'); return out; }
  });

  D('two-sum-less-than-k', {
    t: 'Two Sum Less Than K',
    r: 'Sort; l at the start, r at the end. If the sum < k, record it and move l right; otherwise move r left.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 20), k: R.int(1, 30) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y); let l = 0, r = a.length - 1, best = -1, asks = 0; while (l < r) { const s = a[l] + a[r]; if (asks++ < 8) { T.at({ sorted: A(a, { l, r }), k: I.k, best }); T.c(`Sum ${s}: next move?`, ['record + move l', 'move r'], s < I.k ? 'record + move l' : 'move r', 'Below k is a candidate.'); } if (s < I.k) { best = Math.max(best, s); l++; } else r--; } if (!asks) { T.at({ nums: A(a) }); T.n('Answer with a single number?', -1, 'No pair exists.'); } return best; }
  });

  D('longest-chunked-palindrome-decomposition', {
    t: 'Longest Chunked Palindrome Decomposition',
    r: 'Greedy from both ends: grow a prefix and a suffix together; as soon as they are equal, cut both off (+2 chunks). Whatever remains in the middle is one more chunk.',
    g: R => { const p = Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 2), 'ab')); return { text: p.join('') + (R.chance(0.5) ? R.str(R.int(1, 2), 'abc') : '') + p.slice().reverse().join('') }; },
    s(I, T) { const s = I.text; let l = 0, r = s.length, c = 0, asks = 0; while (l < r) { let k = 1, cut = false; while (l + k <= r - k) { if (s.slice(l, l + k) === s.slice(r - k, r)) { cut = true; break; } k++; } if (!cut) { c++; break; } if (asks++ < 6) { T.at({ text: A([...s], { l, r: r - 1 }) }); T.c('Matching chunk peeled from both ends?', [...new Set([s.slice(l, l + k), s.slice(l, l + k + 1), s.slice(r - k - 1, r)])], s.slice(l, l + k), 'Shortest equal prefix/suffix.'); } c += 2; l += k; r -= k; } return c; }
  });

  D('last-substring-in-lexicographical-order', {
    t: 'Last Substring in Lexicographical Order',
    r: 'The answer is a suffix. Two candidate starts i < j and an offset k: compare s[i + k] with s[j + k]; the loser jumps past the compared part. O(n) overall; the winner\'s suffix is the answer.',
    g: R => ({ s: R.str(R.int(1, 9), 'abc') }),
    s(I, T) { const s = I.s; let i = 0, j = 1, k = 0, asks = 0; while (j + k < s.length) { if (s[i + k] === s[j + k]) { k++; continue; } if (asks++ < 6) { T.at({ s: A([...s], { i, j }), k }); T.c(`Compare ${s[i + k]} and ${s[j + k]}: which start survives?`, ['i', 'j'], s[i + k] > s[j + k] ? 'i' : 'j', 'Larger character wins.'); } if (s[i + k] > s[j + k]) j = j + k + 1; else { i = Math.max(i + k + 1, j); j = i + 1; } k = 0; } T.at({ s: A([...s], { i }) }); T.n('Start index of the answer?', i, 'The surviving candidate.'); return s.slice(i); }
  });

  D('intersection-of-three-sorted-arrays', {
    t: 'Intersection of Three Sorted Arrays',
    r: 'Three pointers: if all three values are equal, output and advance all; otherwise advance the pointer at the smallest value.',
    g: R => ({ arr1: R.distinct(R.int(1, 5), 1, 9).sort((a, b) => a - b), arr2: R.distinct(R.int(1, 5), 1, 9).sort((a, b) => a - b), arr3: R.distinct(R.int(1, 5), 1, 9).sort((a, b) => a - b) }),
    s(I, T) { const a = I.arr1, b = I.arr2, c = I.arr3, out = []; let i = 0, j = 0, k = 0, asks = 0; while (i < a.length && j < b.length && k < c.length) { const m = Math.min(a[i], b[j], c[k]), eq = a[i] === b[j] && b[j] === c[k]; if (asks++ < 8) { T.at({ a: A(a, { i }), b: A(b, { j }), c: A(c, { k }) }); T.yn('All three equal?', eq, eq ? 'Output it.' : `Advance the pointer(s) at ${m}.`); } if (eq) { out.push(a[i]); i++; j++; k++; } else { if (a[i] === m) i++; else if (b[j] === m) j++; else k++; } } return out; }
  });

  D('meeting-scheduler', {
    t: 'Meeting Scheduler',
    r: 'Sort both slot lists by start. Two pointers: the overlap is [max(starts), min(ends)]; if it fits the duration, return its start + duration. Advance whichever slot ends first.',
    g: R => { const sl = () => { const a = []; let t = R.int(0, 5); for (let i = 0; i < R.int(1, 3); i++) { const s = t + R.int(0, 5), e = s + R.int(2, 10); a.push([s, e]); t = e + 1; } return R.shuffle(a); }; return { slots1: sl(), slots2: sl(), duration: R.int(1, 6) }; },
    s(I, T) { const a = I.slots1.slice().sort((x, y) => x[0] - y[0]), b = I.slots2.slice().sort((x, y) => x[0] - y[0]); let i = 0, j = 0, asks = 0; while (i < a.length && j < b.length) { const s = Math.max(a[i][0], b[j][0]), e = Math.min(a[i][1], b[j][1]); if (asks++ < 8) { T.at({ slot1: a[i].join('–'), slot2: b[j].join('–'), duration: I.duration }); T.n('Overlap length (0 if none)?', Math.max(0, e - s), 'min(ends) − max(starts).'); } if (e - s >= I.duration) return [s, s + I.duration]; if (a[i][1] < b[j][1]) i++; else j++; } return []; }
  });

  D('remove-palindromic-subsequences', {
    t: 'Remove Palindromic Subsequences',
    r: 'Only letters a and b: if s is a palindrome, one step removes it all; otherwise remove all a\'s (a palindrome) then all b\'s — 2 steps.',
    g: R => { const h = R.str(R.int(1, 4), 'ab'); return { s: R.chance(0.4) ? h + [...h].reverse().join('') : R.str(R.int(1, 7), 'ab') }; },
    s(I, T) { const res = (() => { const p = pal(I.s, 0, I.s.length - 1); T.at({ s: A([...I.s]) }); T.n('Distinct letters in s?', new Set(I.s).size, 'Only a and b, so at most 2 removals.'); T.yn('Is s a palindrome?', p, 'Two-pointer check.'); return p ? 1 : 2; })(); T.n('Fewest removals?', res, '1 if s is a palindrome, else 2.'); return res; }
  });

  D('count-negative-numbers-in-a-sorted-matrix', {
    t: 'Count Negative Numbers in a Sorted Matrix',
    r: 'Staircase from the bottom-left: if the cell is negative, the rest of its row is too — add n − c and move up; otherwise move right.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), g = Array.from({ length: m }, () => Array(n).fill(0)); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) g[i][j] = Math.min(i ? g[i - 1][j] : 5, j ? g[i][j - 1] : 5) - R.int(0, 2); return { grid: g }; },
    s(I, T) { const res = (() => { const g = I.grid, m = g.length, n = g[0].length; let r = m - 1, c = 0, cnt = 0, asks = 0; T.at({ grid: G(g) }); T.yn('Is the bottom-left value negative?', g[m - 1][0] < 0, 'The staircase walk starts there.'); while (r >= 0 && c < n) { if (g[r][c] < 0) { cnt += n - c; if (asks++ < 8) { T.at({ grid: G(g, { hl: [[r, c]] }) }); T.n('Count so far?', cnt, 'Whole rest of the row is negative.'); } r--; } else c++; } return cnt; })(); T.n('Negative numbers?', res, 'The final count.'); return res; }
  });

  D('the-k-strongest-values-in-an-array', {
    t: 'The k Strongest Values in an Array',
    r: 'Sort; the median is a[(n − 1) / 2]. Two pointers at the ends: take whichever end is stronger (|x − m| larger, ties to the larger value) k times.',
    g: R => { const a = R.ints(R.int(1, 7), 1, 9); return { arr: a, k: R.int(1, a.length) }; },
    cmp: 'set',
    s(I, T) { const a = I.arr.slice().sort((x, y) => x - y), m = a[(a.length - 1) >> 1], out = []; T.at({ sorted: A(a) }); T.n('Median?', m, 'a[(n − 1) / 2].'); let l = 0, r = a.length - 1; while (out.length < I.k) { const takeR = Math.abs(a[r] - m) >= Math.abs(a[l] - m); if (out.length < 6) { T.at({ sorted: A(a, { l, r }) }); T.c('Take which end?', ['right', 'left'], takeR ? 'right' : 'left', 'Stronger; ties go to the larger value.'); } out.push(takeR ? a[r--] : a[l++]); } return out; }
  });

  D('number-of-subsequences-that-satisfy-the-given-sum-condition', {
    t: 'Number of Subsequences That Satisfy the Given Sum Condition',
    r: 'Sort. For each left end l (the minimum), shrink r while a[l] + a[r] > target; then any subset of (l, r] can join: add 2^(r − l). Mod 1e9+7.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 9), target: R.int(1, 15) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), M = 1000000007n; let r = a.length - 1, c = 0n, asks = 0; for (let l = 0; l <= r; l++) { while (l <= r && a[l] + a[r] > I.target) r--; if (l > r) break; c = (c + (1n << BigInt(r - l))) % M; if (asks++ < 8) { T.at({ sorted: A(a, { l, r }), target: I.target }); T.n('Total so far?', Number(c), 'Add 2^(r − l).'); } } if (!asks) { T.at({ sorted: A(a) }); T.n('Valid subsequences?', 0, 'Even the minimum doubled exceeds target.'); } return Number(c); }
  });

  D('number-of-ways-where-square-of-number-is-equal-to-product-of-two-numbers', {
    t: 'Number of Ways Where Square of Number Is Equal to Product of Two Numbers',
    r: 'For each x in one array, count pairs j < k in the other with product x² — a count map of the other array checks x² / y for each y. Do both directions.',
    g: R => ({ nums1: R.ints(R.int(1, 5), 1, 6), nums2: R.ints(R.int(1, 5), 1, 6) }),
    s(I, T) { const res = (() => { const f = (A1, B) => { let c = 0; for (const x of A1) for (let j = 0; j < B.length; j++) for (let k = j + 1; k < B.length; k++) if (x * x === B[j] * B[k]) c++; return c; }; const t1 = f(I.nums1, I.nums2), t2 = f(I.nums2, I.nums1); T.at({ nums1: A(I.nums1), nums2: A(I.nums2) }); T.n('Type 1 triplets (square from nums1)?', t1, 'Pairs in nums2 with product x².'); T.n('Type 2 triplets (square from nums2)?', t2, 'Pairs in nums1.'); return t1 + t2; })(); T.n('Total triplets?', res, 'Type 1 plus type 2.'); return res; }
  });

  D('split-two-strings-to-make-palindrome', {
    t: 'Split Two Strings to Make Palindrome',
    r: 'Try a-prefix + b-suffix: match a[i] with b[n − 1 − i] from the outside in; where they stop matching, the middle of a or of b must itself be a palindrome. Then try the swapped roles.',
    g: R => { const n = R.int(1, 6); return { a: R.str(n, 'ab'), b: R.str(n, 'ab') }; },
    s(I, T) { const res = (() => { const chk = (a, b, nm) => { let i = 0, j = a.length - 1; while (i < j && a[i] === b[j]) { i++; j--; } const ok = pal(a, i, j) || pal(b, i, j); T.at({ prefixFrom: nm[0], suffixFrom: nm[1], stoppedAt: `${i} to ${j}` }); T.yn('Does this combination work?', ok, 'Outer chars match; the middle of either string is a palindrome.'); return ok; }; T.at({ a: I.a, b: I.b }); T.yn('Is a already a palindrome?', pal(I.a, 0, I.a.length - 1), 'Then splitting at 0 works.'); return chk(I.a, I.b, 'ab') || chk(I.b, I.a, 'ba'); })(); T.yn('Can a palindrome be formed?', res, 'Either combination is enough.'); return res; }
  });

  D('check-if-two-string-arrays-are-equivalent', {
    t: 'Check If Two String Arrays are Equivalent',
    r: 'Walk both arrays with (word index, char index) pointers, comparing one character at a time without building the full strings.',
    g: R => { const s = R.str(R.int(1, 6), 'ab'), split = x => { const o = []; let i = 0; while (i < x.length) { const k = R.int(1, x.length - i); o.push(x.slice(i, i + k)); i += k; } return o; }; return { word1: split(s), word2: split(R.chance(0.6) ? s : R.str(R.int(1, 6), 'ab')) }; },
    s(I, T) { const a = I.word1.join(''), b = I.word2.join(''); T.at({ word1: A(I.word1), word2: A(I.word2) }); T.n('Total characters in word1?', a.length, 'Sum of lengths.'); T.n('Total characters in word2?', b.length, 'Sum of lengths.'); T.yn('Same string?', a === b, 'Compare char by char.'); return a === b; }
  });

  D('minimum-length-of-string-after-deleting-similar-ends', {
    t: 'Minimum Length of String After Deleting Similar Ends',
    r: 'While s[l] == s[r] and l < r, strip the whole run of that character from both ends. The answer is r − l + 1 (never below 0).',
    g: R => ({ s: R.str(R.int(1, 9), 'abc') }),
    s(I, T) { const res = (() => { const s = I.s; let l = 0, r = s.length - 1, asks = 0; T.at({ s: A([...s]) }); T.n('Length of the run of the first letter?', s.length - s.replace(new RegExp('^' + s[0] + '+'), '').length, 'Equal letters at the start.'); while (l < r && s[l] === s[r]) { const c = s[l]; while (l <= r && s[l] === c) l++; while (r >= l && s[r] === c) r--; if (asks++ < 6) { T.at({ s: A([...s], { win: [l, r] }) }); T.n('Remaining length?', Math.max(0, r - l + 1), `Strip all '${c}' from both ends.`); } } if (!asks) { T.at({ s: A([...s]) }); T.yn('Can anything be removed?', false, 'Ends differ (or single char).'); } return Math.max(0, r - l + 1); })(); T.n('Minimum length?', res, 'What is left in the middle.'); return res; }
  });

  D('largest-merge-of-two-strings', {
    t: 'Largest Merge Of Two Strings',
    r: 'Greedy: take the first character from whichever remaining string is lexicographically larger as a whole suffix (comparing just one character fails on ties).',
    g: R => ({ word1: R.str(R.int(1, 5), 'abc'), word2: R.str(R.int(1, 5), 'abc') }),
    s(I, T) { let a = I.word1, b = I.word2, m = '', asks = 0; while (a || b) { const fromA = a > b; if (asks++ < 8) { T.at({ word1: a || '""', word2: b || '""', merge: m || '""' }); T.c('Take from…', ['word1', 'word2'], fromA ? 'word1' : 'word2', 'Compare the whole remaining strings.'); } if (fromA) { m += a[0]; a = a.slice(1); } else { m += b[0]; b = b.slice(1); } } return m; }
  });

  D('form-array-by-concatenating-subarrays-of-another-array', {
    t: 'Form Array by Concatenating Subarrays of Another Array',
    r: 'Greedy left to right: for each group in order, find its earliest match in nums at or after the pointer, then move the pointer past it. All groups placed → true.',
    g: R => { const nums = R.ints(R.int(1, 9), 1, 3), g = []; let i = 0; while (i < nums.length && g.length < 3) { i += R.int(0, 2); const k = R.int(1, 2); if (i + k <= nums.length) g.push(nums.slice(i, i + k)); i += k; } if (!g.length || R.chance(0.3)) g.push(R.ints(R.int(1, 2), 1, 3)); return { groups: g, nums }; },
    s(I, T) { let p = 0; for (const [gi, g] of I.groups.entries()) { let f = -1; for (let i = p; i + g.length <= I.nums.length; i++) if (g.every((x, k) => I.nums[i + k] === x)) { f = i; break; } T.at({ nums: A(I.nums, { p: Math.min(p, I.nums.length - 1) }), group: A(g) }); T.n(`Earliest start for group ${gi} (−1 if none)?`, f, 'Search from the pointer.'); if (f < 0) return false; p = f + g.length; } return true; }
  });

  D('merge-strings-alternately', {
    t: 'Merge Strings Alternately',
    r: 'One pointer per word, alternating characters; when one word runs out, append the rest of the other.',
    g: R => ({ word1: R.str(R.int(1, 5), 'abc'), word2: R.str(R.int(1, 5), 'xyz') }),
    s(I, T) { let m = ''; const n = Math.max(I.word1.length, I.word2.length); for (let i = 0; i < n; i++) { if (i < I.word1.length) m += I.word1[i]; if (i < I.word2.length) m += I.word2[i]; } T.at({ word1: I.word1, word2: I.word2 }); T.n('Length of the merge?', m.length, 'All characters used.'); T.c('Third character?', [...new Set([m[2] || m[0], m[1], m[0]])], m[2] || m[0], 'Alternate: word1, word2, word1, and so on.'); T.n('Characters left over from the longer word?', Math.abs(I.word1.length - I.word2.length), 'They are appended at the end.'); return m; }
  });
})();
