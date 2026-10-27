/* v2 games: greedy (04). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const sorted = a => a.slice().sort((x, y) => x - y);
  const cnt = a => { const m = new Map(); for (const x of a) m.set(x, (m.get(x) || 0) + 1); return m; };
  const M = 1000000007n;
  const pw = (b, e) => { let r = 1n; b %= M; while (e > 0n) { if (e & 1n) r = r * b % M; b = b * b % M; e >>= 1n; } return r; };

  D('sum-game', {
    t: 'Sum Game: can Bob balance the ?s?',
    r: 'Let L, R be the digit sums and qL, qR the ? counts of each half. Bob wins only if qL + qR is even and 2(L − R) = 9(qR − qL); otherwise Alice wins.',
    g: R => { const h = R.int(1, 3); return { num: R.str(2 * h, '0123456789??') }; },
    s(I, T) { const res = (() => { const n = I.num.length, h = n / 2; let L = 0, Rs = 0, ql = 0, qr = 0; [...I.num].forEach((c, i) => { if (c === '?') i < h ? ql++ : qr++; else i < h ? L += +c : Rs += +c; }); T.at({ left: `${I.num.slice(0, h)} (sum ${L})`, right: `${I.num.slice(h)} (sum ${Rs})` }); T.n('Number of ? marks in total?', ql + qr, 'An odd count gives Alice the last move.'); const bob = (ql + qr) % 2 === 0 && 2 * (L - Rs) === 9 * (qr - ql); T.yn('Can Bob force a tie?', bob, 'Twice the gap in sums must equal 9 times the gap in ? marks, right minus left.'); return !bob; })(); T.yn('Does Alice win?', res, 'She wins unless Bob can force a tie.'); return res; }
  });

  D('add-minimum-number-of-rungs', {
    t: 'Add Minimum Number of Rungs: fill each gap',
    r: 'For each gap g between consecutive heights (starting from the floor at 0), add ⌊(g − 1) / dist⌋ rungs.',
    g: R => ({ rungs: sorted(R.distinct(R.int(1, 5), 1, 20)), dist: R.int(1, 4) }),
    s(I, T) { let prev = 0, t = 0; I.rungs.forEach((h, i) => { const add = Math.floor((h - prev - 1) / I.dist); T.at({ rungs: A(I.rungs, { hl: [i] }), from: prev, dist: I.dist }); T.n(`Rungs to add below ${h}?`, add, `⌊(${h - prev} − 1) / ${I.dist}⌋.`); t += add; prev = h; }); return t; }
  });

  D('largest-number-after-mutating-substring', {
    t: 'Largest Number After Mutating Substring: start at the first gain',
    r: 'Start mutating at the first digit where change[d] > d; continue while change[d] ≥ d; stop at the first digit that would get smaller.',
    g: R => ({ num: R.str(R.int(1, 6), '0123456789'), change: R.ints(10, 0, 9) }),
    s(I, T) { const s = [...I.num], c = I.change; let i = 0; while (i < s.length && c[+s[i]] <= +s[i]) i++; T.at({ num: A(s), change: A(c) }); T.n('Start index of the mutation (length if none)?', i, 'First digit with change[d] > d.'); while (i < s.length && c[+s[i]] >= +s[i]) { s[i] = String(c[+s[i]]); i++; } T.n('How many digits are changed?', s.filter((x, k) => x !== I.num[k]).length, 'Stop when change[d] is smaller than d.'); T.yn('Did the number change at all?', s.join('') !== I.num, 'Only if some digit could grow.'); return s.join(''); }
  });

  D('maximum-number-of-weeks-for-which-you-can-work', {
    t: 'Maximum Weeks You Can Work: the biggest project vs the rest',
    r: 'Let m be the largest project and rest the sum of the others. If m > rest + 1, you can do 2·rest + 1 weeks; otherwise all milestones.',
    g: R => ({ milestones: R.ints(R.int(1, 4), 1, 9) }),
    s(I, T) { const res = (() => { const m = Math.max(...I.milestones), s = I.milestones.reduce((a, b) => a + b, 0), rest = s - m; T.at({ milestones: A(I.milestones) }); T.n('Sum of all but the largest?', rest, `${s} − ${m}.`); T.yn('Is the largest project more than the rest plus 1?', m > rest + 1, 'Then it cannot be finished.'); return m > rest + 1 ? 2 * rest + 1 : s; })(); T.n('Most weeks?', res, 'Everything, or twice the rest plus 1.'); return res; }
  });

  D('delete-characters-to-make-fancy-string', {
    t: 'Make a Fancy String: no three in a row',
    r: 'Append each character unless the last two kept characters are already equal to it.',
    g: R => ({ s: R.str(R.int(1, 10), 'aab') }),
    s(I, T) { const o = []; [...I.s].forEach((c, i) => { const skip = o.length >= 2 && o[o.length - 1] === c && o[o.length - 2] === c; T.at({ s: A([...I.s], { hl: [i] }), kept: o.join('') }); T.yn(`Delete "${c}" at ${i}?`, skip, 'It would be the third in a row.'); if (!skip) o.push(c); }); return o.join(''); }
  });

  D('array-with-elements-not-equal-to-average-of-neighbors', {
    t: 'Not Equal to Average of Neighbors: wiggle the sorted array',
    r: 'Sort, then swap each pair (1,2), (3,4), …: every element becomes a local max or min, so it can never be the average of its neighbors.',
    g: R => ({ nums: R.distinct(R.int(3, 7), 0, 20) }),
    cmp: (out, exp, I) => out.length === I.nums.length && sorted(out).join() === sorted(I.nums).join() && out.every((v, i) => !i || i === out.length - 1 || 2 * v !== out[i - 1] + out[i + 1]),
    s(I, T) { const a = sorted(I.nums); for (let i = 1; i + 1 < a.length; i += 2) { [a[i], a[i + 1]] = [a[i + 1], a[i]]; T.at({ arr: A(a, { hl: [i, i + 1] }) }); T.n(`Value at index ${i} after the swap?`, a[i], 'Swap neighbors to form peaks.'); } return a; }
  });

  D('minimum-non-zero-product-of-the-array-elements', {
    t: 'Minimum Non-Zero Product: pair into 1 and max − 1',
    r: 'Swapping bits can turn each pair (x, max − 1 − x) into (1, max − 1). With max = 2^p − 1 the answer is max · (max − 1)^(2^(p−1) − 1) mod 1e9+7.',
    g: R => ({ p: R.int(1, 12) }),
    s(I, T) { const res = (() => { const mx = (1n << BigInt(I.p)) - 1n; T.at({ p: I.p }); T.n('Largest value, 2^p − 1?', Number(mx), 'All p bits set.'); T.n('How many pairs become (1, max − 1)?', 2 ** (I.p - 1) - 1, '2^(p−1) − 1 pairs.'); return Number(mx % M * pw(mx - 1n, (1n << BigInt(I.p - 1)) - 1n) % M); })(); T.n('Minimum product, mod 1000000007?', res, 'max times (max − 1) to the power of the pair count.'); return res; }
  });

  D('minimum-time-to-type-word-using-special-typewriter', {
    t: 'Special Typewriter: shorter way around the circle',
    r: 'From the pointer to the next letter, move min(d, 26 − d) steps, plus 1 second to type.',
    g: R => ({ word: R.str(R.int(1, 5), 'abcxyz') }),
    s(I, T) { let p = 0, t = 0; [...I.word].forEach((c, i) => { const d = Math.abs(c.charCodeAt(0) - 97 - p), m = Math.min(d, 26 - d); T.at({ word: A([...I.word], { hl: [i] }), pointer: String.fromCharCode(97 + p) }); T.n(`Moves to reach "${c}"?`, m, 'Shorter direction.'); t += m + 1; p = c.charCodeAt(0) - 97; }); return t; }
  });

  D('the-number-of-weak-characters-in-the-game', {
    t: 'Weak Characters: sort by attack, track best defense',
    r: 'Sort by attack descending, defense ascending within equal attack. Scanning, a character is weak if its defense is below the max defense seen so far.',
    g: R => ({ properties: Array.from({ length: R.int(2, 5) }, () => [R.int(1, 5), R.int(1, 5)]) }),
    s(I, T) { const p = I.properties.slice().sort((a, b) => b[0] - a[0] || a[1] - b[1]); let mx = 0, w = 0; for (const [a, d] of p) { T.at({ order: A(p.map(x => `[${x}]`)), maxDef: mx }); T.yn(`Is [${a},${d}] weak?`, d < mx, 'Defense below the best of stronger attacks.'); if (d < mx) w++; mx = Math.max(mx, d); } return w; }
  });

  D('find-original-array-from-doubled-array', {
    t: 'Find Original Array From Doubled Array: smallest first',
    r: 'Sort. The smallest unmatched value must be original; remove one copy of it and one copy of its double. If a double is missing, return [].',
    g: R => R.chance(0.6) ? (() => { const o = R.ints(R.int(1, 4), 0, 6); return { changed: R.shuffle([...o, ...o.map(x => 2 * x)]) }; })() : { changed: R.ints(R.int(1, 6), 0, 8) },
    cmp: (out, exp) => sorted(out).join() === sorted(exp).join(),
    s(I, T) { if (I.changed.length % 2) return []; const c = cnt(I.changed), o = []; for (const x of sorted(I.changed)) { if (!c.get(x)) continue; c.set(x, c.get(x) - 1); const ok = (c.get(2 * x) || 0) > 0; T.at({ original: A(o), value: x }); T.yn(`Is a ${2 * x} available for ${x}?`, ok, 'Its double must remain.'); if (!ok) return []; c.set(2 * x, c.get(2 * x) - 1); o.push(x); } return o; }
  });

  D('maximum-difference-between-increasing-elements', {
    t: 'Maximum Difference Between Increasing Elements',
    r: 'Track the minimum so far; at each j with nums[j] > min, update the best difference.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 12) }),
    s(I, T) { let mn = I.nums[0], best = -1; for (let j = 1; j < I.nums.length; j++) { if (I.nums[j] > mn) best = Math.max(best, I.nums[j] - mn); T.at({ nums: A(I.nums, { hl: [j] }), min: mn }); T.n(`Best difference after index ${j}?`, best, '−1 while none.'); mn = Math.min(mn, I.nums[j]); } return best; }
  });

  D('minimum-moves-to-convert-string', {
    t: 'Minimum Moves to Convert String: cover from the first X',
    r: 'Scan; at each X, spend a move covering it and the next two, then jump 3 ahead.',
    g: R => ({ s: R.str(R.int(3, 10), 'XO') }),
    s(I, T) { let i = 0, m = 0; while (i < I.s.length) { if (I.s[i] === 'X') { m++; T.at({ s: A([...I.s], { win: [i, Math.min(i + 2, I.s.length - 1)] }) }); T.n('Moves so far?', m, 'Cover this X and the next two.'); i += 3; } else i++; } return m; }
  });

  D('stone-game-ix', {
    t: 'Stone Game IX: count residues mod 3',
    r: 'Count c0, c1, c2 of values mod 3. If c0 is even, Alice wins iff c1 ≥ 1 and c2 ≥ 1. If c0 is odd, Alice wins iff |c1 − c2| > 2.',
    g: R => ({ stones: R.ints(R.int(1, 8), 1, 9) }),
    s(I, T) { const res = (() => { const c = [0, 0, 0]; I.stones.forEach(x => c[x % 3]++); T.at({ stones: A(I.stones), residues: A(I.stones.map(x => x % 3)) }); T.n('How many stones are divisible by 3?', c[0], 'Each one flips who must move into danger.'); T.n('Stones with remainder 1?', c[1], 'Compare with the stones with remainder 2.'); return c[0] % 2 === 0 ? c[1] >= 1 && c[2] >= 1 : Math.abs(c[1] - c[2]) > 2; })(); T.yn('Does Alice win?', res, 'Depends on the parity of the zeros and the two other counts.'); return res; }
  });

  D('minimum-number-of-moves-to-seat-everyone', {
    t: 'Seat Everyone: match sorted to sorted',
    r: 'Sort seats and students; pair them in order and add the distances.',
    g: R => { const n = R.int(1, 5); return { seats: R.ints(n, 1, 12), students: R.ints(n, 1, 12) }; },
    s(I, T) { const a = sorted(I.seats), b = sorted(I.students); let t = 0; a.forEach((x, i) => { T.at({ seats: A(a, { hl: [i] }), students: A(b, { hl: [i] }) }); T.n(`Moves for pair ${i}?`, Math.abs(x - b[i]), 'Distance between the i-th smallest of each.'); t += Math.abs(x - b[i]); }); return t; }
  });

  D('remove-colored-pieces-if-both-neighbors-are-the-same-color', {
    t: 'Remove Colored Pieces: count each player\'s moves',
    r: 'Moves never affect the other player, so count interior As in runs of AAA (Alice) and interior Bs (Bob). Alice wins iff her count is larger.',
    g: R => ({ colors: R.str(R.int(1, 10), 'AB') }),
    s(I, T) { const res = (() => { let a = 0, b = 0; const c = I.colors; for (let i = 1; i + 1 < c.length; i++) if (c[i - 1] === c[i] && c[i] === c[i + 1]) c[i] === 'A' ? a++ : b++; T.at({ colors: A([...c]) }); T.n('Moves available to Alice?', a, 'A with A on both sides.'); T.n('Moves available to Bob?', b, 'B with B on both sides.'); return a > b; })(); T.yn('Does Alice win?', res, 'She needs strictly more moves than Bob.'); return res; }
  });

  D('two-furthest-houses-with-different-colors', {
    t: 'Two Furthest Houses With Different Colors',
    r: 'One end of the optimal pair is an end of the street: furthest house unlike house 0, or unlike house n − 1.',
    g: R => { let c; do c = R.ints(R.int(2, 7), 1, 3); while (new Set(c).size < 2); return { colors: c }; },
    s(I, T) { const res = (() => { const c = I.colors, n = c.length; let j = n - 1; while (c[j] === c[0]) j--; let i = 0; while (c[i] === c[n - 1]) i++; T.at({ colors: A(c) }); T.n('Furthest index unlike house 0?', j, 'Scan from the right.'); T.n('Nearest index unlike the last house?', i, 'Scan from the left.'); return Math.max(j, n - 1 - i); })(); T.n('Largest distance?', res, 'One end of the street is always used.'); return res; }
  });

  D('minimum-number-of-food-buckets-to-feed-the-hamsters', {
    t: 'Food Buckets for Hamsters: prefer the right side',
    r: 'For each hamster not already fed by a bucket on its left, put a bucket on its right if empty (it may feed the next one), else on its left, else impossible.',
    g: R => ({ hamsters: R.str(R.int(1, 8), 'H..') }),
    s(I, T) { const res = (() => { const s = [...I.hamsters]; let b = 0; for (let i = 0; i < s.length; i++) if (s[i] === 'H') { if (s[i - 1] === 'B') continue; let w; if (s[i + 1] === '.') w = 'right'; else if (s[i - 1] === '.') w = 'left'; else w = 'none'; T.at({ street: A(s, { hl: [i] }) }); T.c(`Where does the bucket for hamster ${i} go?`, ['right', 'left', 'none'], w, 'Right first: it may feed the next hamster.'); if (w === 'none') return -1; s[w === 'right' ? i + 1 : i - 1] = 'B'; b++; } return b; })(); T.n('Fewest buckets (−1 if impossible)?', res, 'Count the buckets placed.'); return res; }
  });

  D('removing-minimum-and-maximum-from-array', {
    t: 'Removing Minimum and Maximum: three ways to cut',
    r: 'With min/max positions i ≤ j: delete both from the front (j + 1), both from the back (n − i), or i from the front and j from the back (i + 1 + n − j).',
    g: R => ({ nums: R.distinct(R.int(1, 8), -10, 10) }),
    s(I, T) { const a = I.nums, n = a.length; let x = a.indexOf(Math.min(...a)), y = a.indexOf(Math.max(...a)); const i = Math.min(x, y), j = Math.max(x, y); T.at({ nums: A(a, { hl: [x, y] }) }); T.n('Deletions if both are taken from the front?', j + 1, 'Up to the farther one.'); T.n('Deletions if both are taken from the back?', n - i, 'Back to the nearer one.'); T.n('Deletions taking one from each end?', i + 1 + n - j, 'Front to the nearer one, back to the farther one.'); return Math.min(j + 1, n - i, i + 1 + n - j); }
  });

  D('subsequence-of-size-k-with-the-largest-even-sum', {
    t: 'Largest Even Sum of Size k: fix the parity with one swap',
    r: 'Take the k largest. If the sum is odd, swap out the smallest odd taken for the largest even left, or the smallest even taken for the largest odd left; take the better, or −1.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 0, 9), k: R.int(1, n) }; },
    s(I, T) { const res = (() => { const a = sorted(I.nums).reverse(), k = I.k, top = a.slice(0, k), rest = a.slice(k); const s = top.reduce((x, y) => x + y, 0); T.at({ top: A(top), rest: A(rest) }); T.n('Sum of the k largest?', s, 'Greedy start.'); T.yn('Is that sum even?', s % 2 === 0, 'If not, swap one number to fix the parity.'); if (s % 2 === 0) return s; let best = -1; const so = top.filter(x => x % 2).pop(), se = top.filter(x => x % 2 === 0).pop(), le = rest.find(x => x % 2 === 0), lo = rest.find(x => x % 2); if (so !== undefined && le !== undefined) best = Math.max(best, s - so + le); if (se !== undefined && lo !== undefined) best = Math.max(best, s - se + lo); return best; })(); T.n('Largest even sum (−1 if none)?', res, 'Best single swap of parity.'); return res; }
  });

  D('recover-the-original-array', {
    t: 'Recover the Original Array: guess k from the smallest',
    r: 'The smallest value is a lower. Try each 2k = nums[i] − nums[0] (positive, even); greedily match each smallest unused value x with x + 2k. The first k that matches everything gives arr = x + k.',
    g: R => { const n = R.int(1, 4), k = R.int(1, 4), arr = R.ints(n, k + 1, 12); return { nums: R.shuffle([...arr.map(x => x - k), ...arr.map(x => x + k)]) }; },
    cmp: (out, exp, I) => { if (out.length * 2 !== I.nums.length) return false; const k = Math.min(...out) - Math.min(...I.nums); return k > 0 && sorted([...out.map(x => x - k), ...out.map(x => x + k)]).join() === sorted(I.nums).join(); },
    s(I, T) { const a = sorted(I.nums); T.at({ nums: A(a) }); T.n('Smallest value in nums?', a[0], 'It must be a lower value, original minus k.'); for (let i = 1; i < a.length; i++) { const d = a[i] - a[0]; if (d <= 0 || d % 2) continue; const k = d / 2, c = cnt(a), arr = []; let ok = true; for (const x of a) { if (!c.get(x)) continue; c.set(x, c.get(x) - 1); if (!c.get(x + d)) { ok = false; break; } c.set(x + d, c.get(x + d) - 1); arr.push(x + k); } T.at({ nums: A(a), tryK: k }); T.yn(`Does k = ${k} work?`, ok, 'Every lower must find its higher.'); if (ok) { T.n('Smallest value of the original array?', arr[0], 'The lowest value plus k.'); return arr; } } return []; }
  });

  D('destroying-asteroids', {
    t: 'Destroying Asteroids: smallest first',
    r: 'Sort asteroids and absorb them in order; if one is heavier than the planet, the planet is destroyed.',
    g: R => ({ mass: R.int(1, 8), asteroids: R.ints(R.int(1, 6), 1, 20) }),
    s(I, T) { let m = I.mass; for (const x of sorted(I.asteroids)) { T.at({ asteroids: A(sorted(I.asteroids)), mass: m }); T.yn(`Can the planet absorb ${x}?`, m >= x, `${m} vs ${x}.`); if (m < x) return false; m += x; } return true; }
  });

  D('longest-palindrome-by-concatenating-two-letter-words', {
    t: 'Longest Palindrome From Two-Letter Words',
    r: 'Pair each "ab" with a "ba" (4 letters per pair). Pair "aa" words with each other; one leftover "aa" may sit in the middle (+2).',
    g: R => ({ words: Array.from({ length: R.int(1, 7) }, () => R.str(2, 'ab')) }),
    s(I, T) { const res = (() => { const c = cnt(I.words); let len = 0, mid = false; for (const [w, v] of c) { if (w[0] === w[1]) { len += 4 * Math.floor(v / 2); if (v % 2) mid = true; } else if (w < w[1] + w[0]) len += 4 * Math.min(v, c.get(w[1] + w[0]) || 0); } T.at({ counts: K([...c]) }); T.n('Length from pairs (before the middle word)?', len, 'Mirrored pairs and doubled "aa" words.'); T.yn('Can a word sit in the middle?', mid, 'A leftover double-letter word.'); return len + (mid ? 2 : 0); })(); T.n('Longest palindrome length?', res, 'Pairs, plus 2 for a middle word.'); return res; }
  });

  D('earliest-possible-day-of-full-bloom', {
    t: 'Earliest Full Bloom: plant slow growers first',
    r: 'Planting is sequential; growing is parallel. Plant in order of growTime descending and track max(plant finish + grow).',
    g: R => { const n = R.int(1, 5); return { plantTime: R.ints(n, 1, 5), growTime: R.ints(n, 1, 5) }; },
    s(I, T) { const o = I.plantTime.map((_, i) => i).sort((a, b) => I.growTime[b] - I.growTime[a]); let t = 0, ans = 0; for (const i of o) { t += I.plantTime[i]; ans = Math.max(ans, t + I.growTime[i]); T.at({ order: A(o), planted: t }); T.n(`Bloom day of seed ${i}?`, t + I.growTime[i], 'Planting finished + grow time.'); } return ans; }
  });

  D('minimum-moves-to-reach-target-score', {
    t: 'Minimum Moves to Reach Target: work backwards',
    r: 'From target: if even and doubles remain, halve; if odd, subtract 1. When doubles run out, the rest is target − 1 increments.',
    g: R => ({ target: R.int(1, 60), maxDoubles: R.int(0, 4) }),
    s(I, T) { let t = I.target, d = I.maxDoubles, m = 0; while (t > 1 && d > 0) { const half = t % 2 === 0; T.at({ target: t, doubles: d, moves: m }); T.c(`Next step back from ${t}?`, ['halve', 'minus 1'], half ? 'halve' : 'minus 1', 'Halve when even.'); if (half) { t /= 2; d--; } else t--; m++; } return m + t - 1; }
  });

  D('minimum-cost-of-buying-candies-with-discount', {
    t: 'Buying Candies With Discount: every third is free',
    r: 'Sort descending; buy two, get the third free, repeat.',
    g: R => ({ cost: R.ints(R.int(1, 7), 1, 9) }),
    s(I, T) { const c = sorted(I.cost).reverse(); let t = 0; c.forEach((x, i) => { T.at({ sorted: A(c, { hl: [i] }), paid: t }); T.yn(`Is candy ${x} (position ${i}) free?`, i % 3 === 2, 'Every third one.'); if (i % 3 !== 2) t += x; }); return t; }
  });

  D('minimum-sum-of-four-digit-number-after-splitting-digits', {
    t: 'Minimum Sum of Split Four-Digit Number',
    r: 'Sort the digits; the two smallest are the tens digits and the two largest the ones digits: 10(d0 + d1) + d2 + d3.',
    g: R => ({ num: R.int(1000, 9999) }),
    s(I, T) { const res = (() => { const d = sorted([...String(I.num)].map(Number)); T.at({ digits: A(d) }); T.n('Sum of the two tens digits?', d[0] + d[1], 'Smallest two.'); T.n('Sum of the two ones digits?', d[2] + d[3], 'The largest two.'); return 10 * (d[0] + d[1]) + d[2] + d[3]; })(); T.n('Minimum sum?', res, '10 times the tens digits, plus the ones digits.'); return res; }
  });

  D('minimum-operations-to-make-the-array-alternating', {
    t: 'Make the Array Alternating: top two per parity',
    r: 'Count values at even and odd indices. Keep the most common at each parity; if they are the same value, try the second best for one side.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3) }),
    s(I, T) { const res = (() => { const top = p => { const c = cnt(I.nums.filter((_, i) => i % 2 === p)); const e = [...c].sort((a, b) => b[1] - a[1]); return [e[0] || [0, 0], e[1] || [0, 0]]; }; const [e1, e2] = top(0), [o1, o2] = top(1); T.at({ nums: A(I.nums) }); T.n('Most common count at even indices?', e1[1], 'Keep the most frequent value.'); T.n('Most common count at odd indices?', o1[1], 'Same for odd indices.'); const keep = e1[0] !== o1[0] ? e1[1] + o1[1] : Math.max(e1[1] + o2[1], e2[1] + o1[1]); return I.nums.length - keep; })(); T.n('Fewest operations?', res, 'Length minus the values we keep.'); return res; }
  });

  D('append-k-integers-with-minimal-sum', {
    t: 'Append k Integers With Minimal Sum: skip the taken ones',
    r: 'Start with 1 … k. For each distinct value x in nums (sorted) with x ≤ the current limit, the limit grows by 1 (the next number replaces x).',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 12), k: R.int(1, 6) }),
    s(I, T) { const res = (() => { let lim = I.k, s = I.k * (I.k + 1) / 2; T.at({ nums: A(sorted([...new Set(I.nums)])), k: I.k }); T.n('Sum of 1 to k, before skipping anything?', s, 'k times (k + 1), halved.'); for (const x of [...new Set(I.nums)].sort((a, b) => a - b)) { if (x > lim) break; lim++; s += lim - x; T.at({ nums: A(sorted([...new Set(I.nums)])), limit: lim }); T.n(`Sum after skipping ${x}?`, s, `Swap ${x} for ${lim}.`); } return s; })(); T.n('Minimal sum?', res, 'The sum after every skip.'); return res; }
  });

  D('maximize-the-topmost-element-after-k-moves', {
    t: 'Maximize the Topmost Element After k Moves',
    r: 'Either remove k − 1 elements and put back the best of them (max of nums[0 … k−2]), or remove k and expose nums[k]. Special cases: one element with odd k → −1.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 9), k: R.int(0, 7) }),
    s(I, T) { const res = (() => { const a = I.nums, n = a.length, k = I.k; T.at({ nums: A(a), k }); T.yn('Is the pile only one element long?', n === 1, 'Then the pile alternates between empty and full.'); if (k === 0) return a[0]; if (n === 1) return k % 2 ? -1 : a[0]; let best = -1; for (let i = 0; i < Math.min(k - 1, n); i++) best = Math.max(best, a[i]); T.at({ nums: A(a, { win: [0, Math.min(k - 1, n) - 1] }), k }); T.n('Best value you can put back (−1 if none)?', best, 'Max among the first k − 1.'); if (k < n) best = Math.max(best, a[k]); return best; })(); T.n('Largest possible top (−1 if empty)?', res, 'The best removed value, or the one now on top.'); return res; }
  });

  D('minimum-health-to-beat-game', {
    t: 'Minimum Health to Beat Game: armor the biggest hit',
    r: 'Use the armor on the largest damage: health = Σ damage − min(max, armor) + 1.',
    g: R => ({ damage: R.ints(R.int(1, 5), 0, 9), armor: R.int(0, 9) }),
    s(I, T) { const res = (() => { const s = I.damage.reduce((a, b) => a + b, 0), m = Math.max(...I.damage); T.at({ damage: A(I.damage), armor: I.armor }); T.n('Total damage?', s, 'Add every level.'); T.n('Damage blocked by the armor?', Math.min(m, I.armor), 'Use it on the largest hit.'); return s - Math.min(m, I.armor) + 1; })(); T.n('Minimum starting health?', res, 'Total damage minus what is blocked, plus 1.'); return res; }
  });

  D('minimum-number-of-operations-to-convert-time', {
    t: 'Operations to Convert Time: biggest steps first',
    r: 'Take the minute difference and greedily use 60, 15, 5 and 1 minute steps.',
    g: R => { const a = R.int(0, 1439), b = R.int(a, 1439), f = x => String(Math.floor(x / 60)).padStart(2, '0') + ':' + String(x % 60).padStart(2, '0'); return { current: f(a), correct: f(b) }; },
    s(I, T) { const res = (() => { const m = s => +s.slice(0, 2) * 60 + +s.slice(3); let d = m(I.correct) - m(I.current), ops = 0; T.at({ current: I.current, correct: I.correct }); T.n('Minutes to add?', d, 'Difference in minutes.'); T.n('Steps of 60 minutes?', Math.floor(d / 60), 'Use the biggest step first.'); for (const s of [60, 15, 5, 1]) { ops += Math.floor(d / s); d %= s; } return ops; })(); T.n('Fewest operations?', res, 'Then 15, 5 and 1 minute steps.'); return res; }
  });

  D('minimum-rounds-to-complete-all-tasks', {
    t: 'Minimum Rounds to Complete All Tasks: groups of three',
    r: 'For each difficulty count c: c = 1 is impossible; otherwise ⌈c / 3⌉ rounds.',
    g: R => ({ tasks: R.ints(R.int(1, 10), 1, 4) }),
    s(I, T) { let r = 0; for (const [v, c] of cnt(I.tasks)) { T.at({ tasks: A(I.tasks), difficulty: v, count: c }); T.n(`Rounds for difficulty ${v} (−1 if impossible)?`, c === 1 ? -1 : Math.ceil(c / 3), '⌈c / 3⌉, but 1 task cannot be done.'); if (c === 1) return -1; r += Math.ceil(c / 3); } return r; }
  });

  D('remove-digit-from-number-to-maximize-result', {
    t: 'Remove Digit to Maximize Result',
    r: 'Remove the first occurrence of digit followed by a larger digit; if none, remove the last occurrence.',
    g: R => { const s = R.str(R.int(2, 7), '1234'); return { number: s, digit: R.pick([...s]) }; },
    s(I, T) { const s = I.number; let i = -1; for (let k = 0; k < s.length; k++) if (s[k] === I.digit) { i = k; if (k + 1 < s.length && s[k + 1] > s[k]) break; } T.at({ number: A([...s]), digit: I.digit }); T.n('Index to remove?', i, 'First one followed by a larger digit, else the last.'); T.n('Copies of the digit in number?', [...s].filter(c => c === I.digit).length, 'Each one is a candidate.'); T.yn('Is the removed copy followed by a larger digit?', i + 1 < s.length && s[i + 1] > s[i], 'Otherwise it was the last copy.'); return s.slice(0, i) + s.slice(i + 1); }
  });

  D('minimum-number-of-keypresses', {
    t: 'Minimum Number of Keypresses: frequent letters first',
    r: 'Sort letter counts descending; the first 9 letters cost 1 press, the next 9 cost 2, the rest 3.',
    g: R => ({ s: R.str(R.int(1, 25), 'abcdefghijkl') }),
    s(I, T) { const res = (() => { const f = [...cnt([...I.s]).values()].sort((a, b) => b - a); let t = 0; f.forEach((c, i) => t += c * (Math.floor(i / 9) + 1)); T.at({ counts: A(f) }); T.n('Presses for the most frequent letter?', f[0], 'It gets a first-slot position.'); T.n('How many distinct letters need two or more presses?', Math.max(0, f.length - 9), 'Only 9 first-slot positions.'); return t; })(); T.n('Total keypresses?', res, 'Each group of 9 letters costs one more press.'); return res; }
  });

  D('maximum-bags-with-full-capacity-of-rocks', {
    t: 'Maximum Bags With Full Capacity: fill the nearly full first',
    r: 'Compute capacity − rocks for each bag, sort ascending and fill while extra rocks remain.',
    g: R => { const n = R.int(1, 5), c = R.ints(n, 1, 8); return { capacity: c, rocks: c.map(x => R.int(0, x)), additionalRocks: R.int(1, 10) }; },
    s(I, T) { const need = sorted(I.capacity.map((c, i) => c - I.rocks[i])); let left = I.additionalRocks, f = 0; for (const x of need) { if (x > left) break; left -= x; f++; T.at({ need: A(need, { hl: [f - 1] }) }); T.n('Rocks left?', left, `Filled a bag needing ${x}.`); } return f; }
  });

  D('partition-array-such-that-maximum-difference-is-k', {
    t: 'Partition Array With Max Difference k',
    r: 'Sort; start a group at the smallest ungrouped value and extend it while values stay within k of the start.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 12), k: R.int(0, 4) }),
    s(I, T) { const a = sorted(I.nums); let g = 0, st = -Infinity; a.forEach((x, i) => { const nw = x - st > I.k; T.at({ sorted: A(a, { hl: [i] }), groupStart: g ? st : '—' }); T.yn(`Does ${x} start a new group?`, nw, `More than ${I.k} above the group start?`); if (nw) { g++; st = x; } }); return g; }
  });
})();
