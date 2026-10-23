/* v2 games: greedy (01). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const sorted = a => a.slice().sort((x, y) => x - y);
  const sameMultiset = (a, b) => JSON.stringify(sorted(a)) === JSON.stringify(sorted(b));

  D('integer-to-roman', {
    t: 'Integer to Roman: take the biggest symbol that fits',
    r: 'Walk the values 1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1; append each symbol as many times as it fits and subtract.',
    g: R => ({ num: R.int(1, 3999) }),
    s(I, T) { const v = [1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1], s = ['M', 'CM', 'D', 'CD', 'C', 'XC', 'L', 'XL', 'X', 'IX', 'V', 'IV', 'I']; let n = I.num, out = ''; v.forEach((x, i) => { const c = Math.floor(n / x); if (c || (i % 4 === 0 && n >= 1)) { T.at({ left: n, roman: out || '—' }); T.n(`How many "${s[i]}" (${x}) now?`, c, `⌊${n} / ${x}⌋.`); } out += s[i].repeat(c); n -= c * x; }); return out; }
  });

  D('text-justification', {
    t: 'Text Justification: pack greedily, spread the spaces',
    r: 'Pack as many words as fit (with single spaces). Spread the extra spaces over the gaps, giving the left gaps one more when it does not divide evenly. The last line, and one-word lines, are left-justified and padded.',
    g: R => ({ words: Array.from({ length: R.int(2, 6) }, () => R.str(R.int(1, 5), 'abcde')), maxWidth: R.int(6, 12) }),
    s(I, T) { const w = I.words, W = I.maxWidth, out = []; let i = 0; while (i < w.length) { let j = i, len = w[i].length; while (j + 1 < w.length && len + 1 + w[j + 1].length <= W) { j++; len += 1 + w[j].length; } T.at({ words: A(w, { win: [i, j] }), width: W }); T.n(`How many words fit on line ${out.length + 1}?`, j - i + 1, 'Add words while length + spaces ≤ maxWidth.'); const line = w.slice(i, j + 1), gaps = j - i; if (j === w.length - 1 || !gaps) out.push(line.join(' ').padEnd(W)); else { const sp = W - line.reduce((a, x) => a + x.length, 0), q = Math.floor(sp / gaps), r = sp % gaps; T.n('Spaces in the first gap?', q + (r ? 1 : 0), `${sp} spaces over ${gaps} gaps; the left ones get the extra.`); out.push(line.map((x, k) => k < gaps ? x + ' '.repeat(q + (k < r ? 1 : 0)) : x).join('')); } i = j + 1; } return out; }
  });

  D('candy', {
    t: 'Candy: left pass, then right pass',
    r: 'Give everyone 1. Left to right: if rating rises, candy[i] = candy[i−1] + 1. Right to left: if rating[i] > rating[i+1], candy[i] = max(candy[i], candy[i+1] + 1). Sum.',
    g: R => ({ ratings: R.ints(R.int(2, 7), 0, 4) }),
    s(I, T) { const r = I.ratings, n = r.length, c = Array(n).fill(1); for (let i = 1; i < n; i++) if (r[i] > r[i - 1]) c[i] = c[i - 1] + 1; T.at({ ratings: A(r), candy: A(c) }); T.n('Total after the left-to-right pass?', c.reduce((a, b) => a + b, 0), 'Rising ratings climb by 1.'); for (let i = n - 2; i >= 0; i--) if (r[i] > r[i + 1] && c[i] <= c[i + 1]) { c[i] = c[i + 1] + 1; T.at({ ratings: A(r, { hl: [i, i + 1] }), candy: A(c) }); T.n(`Candy for child ${i} after the right pass?`, c[i], 'One more than the right neighbor.'); } return c.reduce((a, b) => a + b, 0); }
  });

  D('largest-number', {
    t: 'Largest Number: order by a + b vs b + a',
    r: 'Sort the numbers as strings so that x comes before y when x + y > y + x. Join; if the result starts with 0, it is "0".',
    g: R => ({ nums: R.ints(R.int(2, 5), 0, 99) }),
    s(I, T) { const s = I.nums.map(String).sort((a, b) => (b + a).localeCompare(a + b)); for (let i = 1; i < s.length && i < 5; i++) { T.at({ order: A(s, { hl: [i - 1, i] }) }); T.c(`Which goes first: ${s[i - 1]} or ${s[i]}?`, [...new Set([s[i - 1], s[i]])], s[i - 1], `${s[i - 1]}${s[i]} ≥ ${s[i]}${s[i - 1]}.`); } const r = s.join(''); return r[0] === '0' ? '0' : r; }
  });

  D('wiggle-sort', {
    t: 'Wiggle Sort: fix each neighbor pair as you go',
    r: 'Walk i = 1 … n−1. At odd i we need nums[i] ≥ nums[i−1], at even i nums[i] ≤ nums[i−1]; swap when violated. Swapping never breaks the previous pair.',
    g: R => ({ nums: R.ints(R.int(2, 7), 0, 9) }),
    cmp: (out, exp, I) => sameMultiset(out, I.nums) && out.every((v, i) => !i || (i % 2 ? v >= out[i - 1] : v <= out[i - 1])),
    s(I, T) { const a = I.nums.slice(); for (let i = 1; i < a.length; i++) { const bad = i % 2 ? a[i] < a[i - 1] : a[i] > a[i - 1]; T.at({ nums: A(a, { hl: [i - 1, i] }) }); T.yn(`Swap positions ${i - 1} and ${i}?`, bad, i % 2 ? 'Odd index must be ≥ its left neighbor.' : 'Even index must be ≤ its left neighbor.'); if (bad) [a[i], a[i - 1]] = [a[i - 1], a[i]]; } return a; }
  });

  D('wiggle-sort-ii', {
    t: 'Wiggle Sort II: interleave reversed halves',
    r: 'Sort. Split into the smaller half and the larger half, reverse both (so equal middle values are far apart), and alternate small, large, small, large, ….',
    g: R => { const n = R.int(2, 7), b = R.ints(n, 1, 9).sort((x, y) => x - y); const s = b.slice(0, Math.ceil(n / 2)).reverse(), l = b.slice(Math.ceil(n / 2)).reverse(), out = b.map((_, i) => i % 2 ? l[i >> 1] : s[i >> 1]); const ok = out.every((v, i) => !i || (i % 2 ? v > out[i - 1] : v < out[i - 1])); return { nums: ok ? R.shuffle(out) : [1, 3, 2, 2, 3, 1] }; },
    cmp: (out, exp, I) => sameMultiset(out, I.nums) && out.every((v, i) => !i || (i % 2 ? v > out[i - 1] : v < out[i - 1])),
    s(I, T) { const b = sorted(I.nums), n = b.length, h = Math.ceil(n / 2), s = b.slice(0, h).reverse(), l = b.slice(h).reverse(); T.at({ sorted: A(b), small: A(s), large: A(l) }); T.n('Size of the smaller half?', h, '⌈n/2⌉ (even positions).'); return b.map((_, i) => i % 2 ? l[i >> 1] : s[i >> 1]); }
  });

  D('patching-array', {
    t: 'Patching Array: extend the reachable range',
    r: 'miss = smallest sum not yet reachable (start 1). If the next number ≤ miss, use it: miss += num. Otherwise patch with miss itself: miss doubles. Stop once miss > n.',
    g: R => ({ nums: sorted(R.ints(R.int(1, 4), 1, 12)), n: R.int(1, 40) }),
    s(I, T) { let miss = 1, i = 0, p = 0; while (miss <= I.n) { const use = i < I.nums.length && I.nums[i] <= miss; T.at({ nums: A(I.nums, { hl: i < I.nums.length ? [i] : [] }), miss, patches: p }); T.yn(`Can the next number cover miss = ${miss}?`, use, use ? `${I.nums[i]} ≤ ${miss}.` : `Patch with ${miss}.`); if (use) miss += I.nums[i++]; else { miss *= 2; p++; } } return p; }
  });

  D('increasing-triplet-subsequence', {
    t: 'Increasing Triplet: keep the two smallest tails',
    r: 'first = smallest so far, second = smallest value that has something smaller before it. A number above second completes a triplet.',
    g: R => ({ nums: R.ints(R.int(3, 7), 0, 9) }),
    s(I, T) { let f = Infinity, s = Infinity; for (const x of I.nums) { const act = x <= f ? 'update first' : x <= s ? 'update second' : 'triplet found'; T.at({ nums: A(I.nums), first: f === Infinity ? '∞' : f, second: s === Infinity ? '∞' : s, x }); T.c(`What does ${x} do?`, ['update first', 'update second', 'triplet found'], act, 'Compare with first, then second.'); if (x <= f) f = x; else if (x <= s) s = x; else return true; } return false; }
  });

  D('integer-replacement', {
    t: 'Integer Replacement: aim for trailing zeros',
    r: 'Even: halve. Odd: go to whichever neighbor is divisible by 4 (n + 1 if n mod 4 = 3), except n = 3, where n − 1 is better.',
    g: R => ({ n: R.int(1, 200) }),
    s(I, T) { let n = I.n, c = 0; while (n !== 1) { const nx = n % 2 === 0 ? n / 2 : n === 3 || n % 4 === 1 ? n - 1 : n + 1; if (n % 2) { T.at({ n, steps: c }); T.c(`${n} is odd. Which move?`, ['n − 1', 'n + 1'], nx === n - 1 ? 'n − 1' : 'n + 1', n === 3 ? '3 → 2 → 1 is shortest.' : 'Pick the neighbor divisible by 4.'); } n = nx; c++; } return c; }
  });

  D('queue-reconstruction-by-height', {
    t: 'Queue Reconstruction by Height: tallest first, insert at k',
    r: 'Sort by height descending (k ascending on ties). Insert each person at index k: everyone already placed is at least as tall, so exactly k of them stand before.',
    g: R => { const n = R.int(2, 5), h = R.ints(n, 1, 6), q = R.shuffle(h.map(x => x)); return { people: q.map((x, i) => [x, q.slice(0, i).filter(y => y >= x).length]) }; },
    s(I, T) { const p = I.people.slice().sort((a, b) => b[0] - a[0] || a[1] - b[1]), q = []; for (const x of p) { T.at({ queue: A(q.map(y => `[${y}]`)), next: `[${x}]` }); T.n(`Insert [${x}] at which index?`, x[1], 'Its k value.'); q.splice(x[1], 0, x); } return q; }
  });

  D('longest-palindrome', {
    t: 'Longest Palindrome: use pairs, plus one middle',
    r: 'Every letter contributes 2·⌊count/2⌋. If any count is odd, one letter can sit in the middle: +1.',
    g: R => ({ s: R.str(R.int(1, 9), 'aabbcC') }),
    s(I, T) { const c = {}; for (const x of I.s) c[x] = (c[x] || 0) + 1; const pairs = Object.values(c).reduce((a, v) => a + Math.floor(v / 2), 0), odd = Object.values(c).some(v => v % 2); T.at({ counts: K(c) }); T.n('How many pairs?', pairs, 'Σ ⌊count / 2⌋.'); T.yn('Can a letter sit in the middle?', odd, 'Some count is odd.'); return 2 * pairs + (odd ? 1 : 0); }
  });

  D('split-concatenated-strings', {
    t: 'Split Concatenated Strings: best orientation, then try each cut',
    r: 'Every string except the one we cut should use its larger orientation. For each string i, both orientations, and every cut point k: candidate = t[k:] + (others in loop order) + t[:k]. Keep the largest.',
    g: R => ({ strs: Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 3), 'abcz')) }),
    s(I, T) { const s = I.strs.map(x => { const r = [...x].reverse().join(''); return r > x ? r : x; }); I.strs.forEach((x, i) => { const r = [...x].reverse().join(''); T.at({ strs: A(I.strs, { hl: [i] }) }); T.yn(`Is "${x}" reversed ("${r}") larger?`, r > x, 'Use the larger orientation for uncut strings.'); }); let best = ''; for (let i = 0; i < s.length; i++) { const mid = s.slice(i + 1).join('') + s.slice(0, i).join(''); for (const t of [s[i], [...s[i]].reverse().join('')]) for (let k = 0; k < t.length; k++) { const c = t.slice(k) + mid + t.slice(0, k); if (c > best) best = c; } } return best; }
  });

  D('array-partition', {
    t: 'Array Partition: sort and pair neighbors',
    r: 'Sort; pairing neighbors wastes the least. The answer is the sum of every other element starting at index 0.',
    g: R => ({ nums: R.ints(2 * R.int(1, 4), -5, 9) }),
    s(I, T) { const a = sorted(I.nums); let s = 0; for (let i = 0; i < a.length; i += 2) { T.at({ sorted: A(a, { hl: [i, i + 1] }), sum: s }); T.n(`min of the pair (${a[i]}, ${a[i + 1]})?`, a[i], 'The smaller of two neighbors.'); s += a[i]; } return s; }
  });

  D('squirrel-simulation', {
    t: 'Squirrel Simulation: pick the best first nut',
    r: 'Every nut costs 2·dist(nut, tree) as round trips. Only the first nut differs: the squirrel walks squirrel → nut instead of tree → nut. Choose the nut with the biggest saving dist(nut, tree) − dist(nut, squirrel).',
    g: R => ({ height: 5, width: 5, tree: [R.int(0, 4), R.int(0, 4)], squirrel: [R.int(0, 4), R.int(0, 4)], nuts: Array.from({ length: R.int(1, 3) }, () => [R.int(0, 4), R.int(0, 4)]) }),
    s(I, T) { const d = (a, b) => Math.abs(a[0] - b[0]) + Math.abs(a[1] - b[1]); let tot = 0, best = -Infinity; I.nuts.forEach(n => { tot += 2 * d(n, I.tree); const sv = d(n, I.tree) - d(n, I.squirrel); T.at({ tree: `(${I.tree})`, squirrel: `(${I.squirrel})`, nut: `(${n})` }); T.n(`Saving if (${n}) is collected first?`, sv, 'dist(nut, tree) − dist(nut, squirrel).'); best = Math.max(best, sv); }); return tot - best; }
  });

  D('distribute-candies', {
    t: 'Distribute Candies: distinct types, capped at n/2',
    r: 'Alice eats n/2 candies; the most types she can get is min(number of distinct types, n/2).',
    g: R => ({ candyType: R.ints(2 * R.int(1, 4), 1, 5) }),
    s(I, T) { const d = new Set(I.candyType).size; T.at({ candies: A(I.candyType) }); T.n('Distinct types?', d, 'Use a set.'); return Math.min(d, I.candyType.length / 2); }
  });

  D('maximum-distance-in-arrays', {
    t: 'Maximum Distance in Arrays: compare with earlier extremes',
    r: 'Keep the min and max seen in previous arrays. For each array, distance = max(its last − prevMin, prevMax − its first); then update the extremes.',
    g: R => ({ arrays: Array.from({ length: R.int(2, 4) }, () => sorted(R.ints(R.int(1, 3), -5, 9))) }),
    s(I, T) { let mn = I.arrays[0][0], mx = I.arrays[0][I.arrays[0].length - 1], best = 0; for (let i = 1; i < I.arrays.length; i++) { const a = I.arrays[i], d = Math.max(a[a.length - 1] - mn, mx - a[0]); T.at({ arrays: A(I.arrays.map(x => `[${x}]`), { hl: [i] }), prevMin: mn, prevMax: mx }); T.n(`Best distance using array ${i}?`, d, 'Its ends against the earlier extremes.'); best = Math.max(best, d); mn = Math.min(mn, a[0]); mx = Math.max(mx, a[a.length - 1]); } return best; }
  });

  D('minimum-factorization', {
    t: 'Minimum Factorization: divide by 9 down to 2',
    r: 'num < 10 is its own answer. Otherwise divide out 9, 8, …, 2 greedily (bigger digits mean fewer digits), then write the digits in increasing order. Leftover > 1 or overflow → 0.',
    g: R => ({ num: R.pick([R.int(1, 200), 48, 15, 2 ** R.int(1, 10), 11 * R.int(1, 5)]) }),
    s(I, T) { let n = I.num; if (n < 10) return n; const d = []; for (let k = 9; k >= 2; k--) { let c = 0; while (n % k === 0) { n /= k; d.push(k); c++; } if (c) { T.at({ num: I.num, left: n }); T.n(`How many ${k}s?`, c, `Divide out ${k} while possible.`); } } if (n > 1) return 0; const r = +d.reverse().join(''); return r > 2 ** 31 - 1 ? 0 : r; }
  });

  D('non-decreasing-array', {
    t: 'Non-decreasing Array: fix the drop the safe way',
    r: 'At the first drop nums[i] < nums[i−1], lower nums[i−1] to nums[i] if nums[i−2] allows; otherwise raise nums[i] to nums[i−1]. A second drop means false.',
    g: R => ({ nums: R.ints(R.int(2, 6), 0, 6) }),
    s(I, T) { const a = I.nums.slice(); let used = false; for (let i = 1; i < a.length; i++) if (a[i] < a[i - 1]) { T.at({ nums: A(a, { hl: [i - 1, i] }) }); T.yn('Has the one change already been used?', used, 'Only one modification is allowed.'); if (used) return false; used = true; const lower = i < 2 || a[i - 2] <= a[i]; T.c('Which fix?', ['lower nums[i−1]', 'raise nums[i]'], lower ? 'lower nums[i−1]' : 'raise nums[i]', lower ? 'Lowering keeps the future as small as possible.' : 'nums[i−2] is too big to lower nums[i−1].'); if (lower) a[i - 1] = a[i]; else a[i] = a[i - 1]; } return true; }
  });

  D('maximum-swap', {
    t: 'Maximum Swap: swap with the last occurrence of a bigger digit',
    r: 'Record the last index of each digit. From the left, find the first digit that has a bigger digit later (check 9 down), and swap it with the last occurrence of that bigger digit.',
    g: R => ({ num: R.int(0, 99999) }),
    s(I, T) { const d = [...String(I.num)], last = {}; d.forEach((c, i) => last[c] = i); for (let i = 0; i < d.length; i++) for (let k = 9; k > +d[i]; k--) if (last[k] > i) { T.at({ digits: A(d, { hl: [i] }) }); T.n('Swap it with which index?', last[k], `The last ${k}.`); [d[i], d[last[k]]] = [d[last[k]], d[i]]; return +d.join(''); } T.at({ digits: A(d) }); T.yn('Is any swap useful?', false, 'Digits are already non-increasing.'); return I.num; }
  });

  D('1-bit-and-2-bit-characters', {
    t: '1-bit and 2-bit Characters: jump through the bits',
    r: 'From index 0, a 1 starts a 2-bit character (jump 2), a 0 is a 1-bit character (jump 1). The last character is 1-bit if we land exactly on the final index.',
    g: R => ({ bits: [...R.ints(R.int(0, 5), 0, 1), 0] }),
    s(I, T) { let i = 0; while (i < I.bits.length - 1) { const j = I.bits[i] ? 2 : 1; T.at({ bits: A(I.bits, { hl: [i] }) }); T.n(`Jump from index ${i}?`, j, I.bits[i] ? '1 starts a 2-bit char.' : '0 is a 1-bit char.'); i += j; } return i === I.bits.length - 1; }
  });

  D('monotone-increasing-digits', {
    t: 'Monotone Increasing Digits: lower at the drop, fill 9s',
    r: 'Scan from the right: whenever d[i−1] > d[i], decrease d[i−1] and mark everything from i onward to become 9.',
    g: R => ({ n: R.int(0, 99999) }),
    s(I, T) { const d = [...String(I.n)].map(Number); let mark = d.length; for (let i = d.length - 1; i > 0; i--) if (d[i - 1] > d[i]) { d[i - 1]--; mark = i; T.at({ digits: A(d, { hl: [i - 1] }) }); T.n(`Digit at index ${i - 1} after lowering?`, d[i - 1], 'Drop by one; later digits become 9.'); } for (let i = mark; i < d.length; i++) d[i] = 9; return +d.join(''); }
  });

  D('max-chunks-to-make-sorted', {
    t: 'Max Chunks to Make Sorted: prefix max equals index',
    r: 'For a permutation of 0…n−1, a chunk can end at i exactly when max(arr[0..i]) = i.',
    g: R => ({ arr: R.shuffle([...Array(R.int(1, 7)).keys()]) }),
    s(I, T) { let mx = -1, c = 0; I.arr.forEach((x, i) => { mx = Math.max(mx, x); T.at({ arr: A(I.arr, { hl: [i] }), prefixMax: mx }); T.yn(`Can a chunk end at index ${i}?`, mx === i, 'Prefix max equals the index.'); if (mx === i) c++; }); return c; }
  });

  D('rabbits-in-forest', {
    t: 'Rabbits in Forest: groups of answer + 1',
    r: 'Rabbits answering x come in color groups of x + 1. With c such answers you need ⌈c / (x + 1)⌉ groups: add that times (x + 1).',
    g: R => ({ answers: R.ints(R.int(1, 7), 0, 3) }),
    s(I, T) { const c = {}; I.answers.forEach(x => c[x] = (c[x] || 0) + 1); let t = 0; for (const [x, k] of Object.entries(c)) { const v = Math.ceil(k / (+x + 1)) * (+x + 1); T.at({ counts: K(c) }); T.n(`Rabbits implied by ${k} answer(s) of ${x}?`, v, `⌈${k} / ${+x + 1}⌉ groups of ${+x + 1}.`); t += v; } return t; }
  });

  D('guess-the-word', {
    t: 'Guess the Word: guess, then keep only consistent words',
    r: 'Guess a word (minimax: the one whose worst match-count bucket is smallest). Master returns the number of exact-position matches; keep only words with the same match count against the guess. Repeat.',
    g: R => { const base = R.str(6, 'abc'), words = new Set([base]); while (words.size < R.int(3, 6)) words.add([...base].map(c => R.chance(0.4) ? R.pick(['a', 'b', 'c', 'z']) : c).join('')); const w = [...words]; return { secret: R.pick(w), words: w, allowedGuesses: 10 }; },
    s(I, T) { const m = (a, b) => [...a].filter((c, i) => c === b[i]).length; let cand = I.words.slice(); for (let g = 0; g < I.allowedGuesses && cand.length; g++) { let pick = cand[0], bestW = Infinity; for (const w of cand) { const b = {}; cand.forEach(x => { const k = m(w, x); b[k] = (b[k] || 0) + 1; }); const worst = Math.max(...Object.values(b)); if (worst < bestW) { bestW = worst; pick = w; } } const r = m(pick, I.secret); T.at({ candidates: A(cand), guess: pick }); T.n(`Master.guess("${pick}") returns?`, r, 'Count positions where it matches the secret.'); if (r === 6) return 'You guessed the secret word correctly.'; cand = cand.filter(x => x !== pick && m(x, pick) === r); } return 'Either you took too many guesses, or you did not find the secret word.'; }
  });

  D('hand-of-straights', {
    t: 'Hand of Straights: start groups at the smallest card',
    r: 'Count cards. Repeatedly take the smallest remaining card x; the group x, x+1, …, x+groupSize−1 must all be available. Decrease their counts.',
    g: R => { const k = R.int(1, 3), h = []; for (let i = 0; i < R.int(1, 3); i++) { const s = R.int(1, 6); for (let j = 0; j < k; j++) h.push(s + j); } if (R.chance(0.3)) h.push(R.int(1, 9)); return { hand: R.shuffle(h), groupSize: k }; },
    s(I, T) { if (I.hand.length % I.groupSize) return false; const c = {}; I.hand.forEach(x => c[x] = (c[x] || 0) + 1); for (const x of Object.keys(c).map(Number).sort((a, b) => a - b)) { const k = c[x]; if (!k) continue; for (let j = 0; j < I.groupSize; j++) { const ok = (c[x + j] || 0) >= k; T.at({ counts: K(c), start: x }); T.yn(`Are there at least ${k} card(s) of ${x + j}?`, ok, `${k} group(s) start at ${x}.`); if (!ok) return false; c[x + j] -= k; } } return true; }
  });

  D('lemonade-change', {
    t: 'Lemonade Change: give a 10 before two 5s',
    r: 'Track $5 and $10 bills. A $10 needs one $5 back. A $20 needs $15: prefer $10 + $5 (keeps more fives), else three $5s.',
    g: R => ({ bills: Array.from({ length: R.int(2, 7) }, () => R.pick([5, 5, 10, 20])) }),
    s(I, T) { let f = 0, t = 0; for (const b of I.bills) { if (b === 5) { f++; continue; } let how; if (b === 10) { how = f ? 'one $5' : 'cannot'; if (f) f--; t++; } else { how = t && f ? '$10 + $5' : f >= 3 ? 'three $5' : 'cannot'; if (how === '$10 + $5') { t--; f--; } else if (how === 'three $5') f -= 3; } T.at({ fives: f, tens: t, paid: b }); T.c(`Customer pays $${b}. Change given?`, b === 10 ? ['one $5', 'cannot'] : ['$10 + $5', 'three $5', 'cannot'], how, 'Prefer handing out tens.'); if (how === 'cannot') return false; } return true; }
  });

  D('smallest-range-ii', {
    t: 'Smallest Range II: split sorted values into up and down',
    r: 'Sort. Some prefix gets +k and the rest −k. For split i: high = max(a[n−1] − k, a[i] + k), low = min(a[0] + k, a[i+1] − k). Best of high − low, or the original range.',
    g: R => ({ nums: R.ints(R.int(1, 5), 0, 12), k: R.int(0, 5) }),
    s(I, T) { const a = sorted(I.nums), n = a.length, k = I.k; let best = a[n - 1] - a[0]; for (let i = 0; i < n - 1; i++) { const hi = Math.max(a[n - 1] - k, a[i] + k), lo = Math.min(a[0] + k, a[i + 1] - k); T.at({ sorted: A(a, { win: [0, i] }), k }); T.n(`Score if indices 0…${i} go up?`, hi - lo, `high ${hi} − low ${lo}.`); best = Math.min(best, hi - lo); } return best; }
  });

  D('minimum-increment-to-make-array-unique', {
    t: 'Minimum Increment to Make Unique: sort, then push up',
    r: 'Sort. Each element must be at least previous + 1; raise it to that and add the difference.',
    g: R => ({ nums: R.ints(R.int(2, 7), 0, 5) }),
    s(I, T) { const a = sorted(I.nums); let need = -Infinity, t = 0; a.forEach((x, i) => { const v = Math.max(x, need); T.at({ sorted: A(a, { hl: [i] }), next: need === -Infinity ? '—' : need }); T.n(`Moves for ${x}?`, v - x, `It must become at least ${need === -Infinity ? x : need}.`); t += v - x; need = v + 1; }); return t; }
  });

  D('array-of-doubled-pairs', {
    t: 'Array of Doubled Pairs: smallest absolute value first',
    r: 'Sort by absolute value. Each value x (still unused) must pair with 2x; take them from the counts. If 2x is missing, it fails.',
    g: R => { const b = R.ints(R.int(1, 3), -4, 4).filter(x => x); const a = b.flatMap(x => [x, 2 * x]); if (R.chance(0.3) || !a.length) a.push(R.int(1, 5), R.int(1, 5)); return { arr: R.shuffle(a) }; },
    s(I, T) { const c = new Map(); I.arr.forEach(x => c.set(x, (c.get(x) || 0) + 1)); for (const x of [...c.keys()].sort((a, b) => Math.abs(a) - Math.abs(b))) { const k = c.get(x); if (!k) continue; if (x === 0) { if (k % 2) return false; continue; } const ok = (c.get(2 * x) || 0) >= k; T.at({ counts: K([...c].map(([a, b]) => [String(a), b])) }); T.yn(`Enough ${2 * x}s for ${k} × ${x}?`, ok, 'Each x needs its double.'); if (!ok) return false; c.set(2 * x, c.get(2 * x) - k); } return true; }
  });

  D('delete-columns-to-make-sorted-ii', {
    t: 'Delete Columns to Make Sorted II: keep columns that never break order',
    r: 'Track which adjacent pairs are already strictly ordered. A column must be deleted if it puts some unresolved pair out of order; otherwise keep it and mark pairs it resolves.',
    g: R => { const L = R.int(1, 3); return { strs: Array.from({ length: R.int(2, 4) }, () => R.str(L, 'abc')) }; },
    s(I, T) { const s = I.strs, n = s.length, done = Array(n - 1).fill(false); let del = 0; for (let c = 0; c < s[0].length; c++) { const bad = done.some((d, i) => !d && s[i][c] > s[i + 1][c]); T.at({ column: A(s.map(x => x[c])), resolved: A(done.map(d => d ? '✓' : '·')) }); T.yn(`Delete column ${c}?`, bad, bad ? 'It puts an unresolved pair out of order.' : 'It is safe to keep.'); if (bad) { del++; continue; } done.forEach((d, i) => { if (!d && s[i][c] < s[i + 1][c]) done[i] = true; }); } return del; }
  });

  D('pancake-sorting', {
    t: 'Pancake Sorting: bring the largest to the top, then down',
    r: 'For size = n down to 2: find the largest remaining value; flip it to the front (if needed), then flip the first size elements to put it in place.',
    g: R => ({ arr: R.shuffle(Array.from({ length: R.int(1, 6) }, (_, i) => i + 1)) }),
    cmp: (out, exp, I) => { const a = I.arr.slice(); if (out.length > 10 * a.length) return false; for (const k of out) { if (k < 1 || k > a.length) return false; a.splice(0, k, ...a.slice(0, k).reverse()); } return a.every((v, i) => !i || v > a[i - 1]); },
    s(I, T) { const a = I.arr.slice(), out = []; for (let sz = a.length; sz > 1; sz--) { const i = a.indexOf(sz); T.at({ arr: A(a, { hl: [i], win: [0, sz - 1] }) }); T.n(`Index of ${sz}?`, i, 'Find the largest unplaced value.'); if (i === sz - 1) continue; if (i > 0) { out.push(i + 1); a.splice(0, i + 1, ...a.slice(0, i + 1).reverse()); } out.push(sz); a.splice(0, sz, ...a.slice(0, sz).reverse()); } return out; }
  });

  D('largest-perimeter-triangle', {
    t: 'Largest Perimeter Triangle: sorted triples from the top',
    r: 'Sort descending; the first three consecutive values with a[i] < a[i+1] + a[i+2] give the largest perimeter.',
    g: R => ({ nums: R.ints(R.int(3, 6), 1, 12) }),
    s(I, T) { const a = sorted(I.nums).reverse(); for (let i = 0; i + 2 < a.length; i++) { const ok = a[i] < a[i + 1] + a[i + 2]; T.at({ sorted: A(a, { hl: [i, i + 1, i + 2] }) }); T.yn(`Do ${a[i]}, ${a[i + 1]}, ${a[i + 2]} form a triangle?`, ok, `${a[i + 1]} + ${a[i + 2]} ${ok ? '>' : '≤'} ${a[i]}.`); if (ok) return a[i] + a[i + 1] + a[i + 2]; } return 0; }
  });

  D('string-without-aaa-or-bbb', {
    t: 'String Without AAA or BBB: write the more common letter',
    r: 'Each step, write the letter with more remaining, unless the last two letters already are that letter; then write the other one.',
    g: R => { const a = R.int(0, 6); return { a, b: R.int(Math.max(0, Math.floor((a - 1) / 2)), 2 * a + 2) }; },
    cmp: (out, exp, I) => typeof out === 'string' && out.length === I.a + I.b && [...out].filter(c => c === 'a').length === I.a && !out.includes('aaa') && !out.includes('bbb'),
    s(I, T) { let a = I.a, b = I.b, s = ''; while (a || b) { const two = s.slice(-2); let ch = a >= b ? 'a' : 'b'; if (two === ch + ch) ch = ch === 'a' ? 'b' : 'a'; T.at({ built: s || '—', a, b }); T.c('Next letter?', ['a', 'b'], ch, 'More remaining wins, unless it would make three in a row.'); s += ch; if (ch === 'a') a--; else b--; } return s; }
  });

  D('broken-calculator', {
    t: 'Broken Calculator: work backwards from the target',
    r: 'Reverse the operations: while target > start, halve it if even, otherwise add 1. Then add start − target for the remaining decrements.',
    g: R => ({ startValue: R.int(1, 20), target: R.int(1, 60) }),
    s(I, T) { let t = I.target, c = 0; while (t > I.startValue) { const nx = t % 2 ? t + 1 : t / 2; T.at({ start: I.startValue, target: t, ops: c }); T.n('Target after the reverse step?', nx, t % 2 ? 'Odd: add 1 (undo a −1).' : 'Even: halve (undo ×2).'); t = nx; c++; } return c + I.startValue - t; }
  });
})();
