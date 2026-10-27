/* v2 games: former gap games (01), rebuilt as step-by-step v2 rounds. */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);
  const range = (a, b) => Array.from({ length: Math.max(0, b - a) }, (_, i) => a + i);
  const popc = x => { let c = 0; while (x) { c += x & 1; x >>>= 1; } return c; };

  D('calculate-score-after-performing-instructions', {
    t: 'Calculate Score After Performing Instructions',
    r: 'Start at index 0 with score 0. Mark each index before running it. "add" adds values[i] and moves to i plus 1; "jump" moves to i plus values[i]. Stop when the index leaves the array or was already marked.',
    g: R => { const n = R.int(1, 7); return { instructions: Array.from({ length: n }, () => R.pick(['add', 'jump'])), values: R.ints(n, -3, 3) }; },
    s(I, T) {
      const ins = I.instructions, v = I.values, n = ins.length, seen = new Set(); let i = 0, score = 0, asked = 0;
      while (i >= 0 && i < n && !seen.has(i)) {
        seen.add(i); const op = ins[i];
        if (op === 'add') score += v[i];
        const nx = op === 'add' ? i + 1 : i + v[i];
        if (asked < 5) { T.at({ instructions: A(ins, { i }), values: A(v, { i }), score }); if (op === 'add') T.n(`Score after running "add" at index ${i}?`, score, `Add values[${i}] = ${v[i]}.`); else T.n(`Next index after "jump" at index ${i}?`, nx, `${i} plus values[${i}] = ${v[i]}.`); asked++; }
        i = nx;
      }
      const out = i < 0 || i >= n;
      T.at({ instructions: A(ins), visited: A([...seen].sort((a, b) => a - b)), next: i });
      T.c('Why does the walk stop?', ['The index leaves the array', 'The index was already visited'], out ? 'The index leaves the array' : 'The index was already visited', out ? `Index ${i} is outside 0 to ${n - 1}.` : `Index ${i} is already marked.`);
      T.n('Final score?', score, 'Only "add" steps change the score.');
      return score;
    }
  });

  D('closest-equal-element-queries', {
    t: 'Closest Equal Element Queries',
    r: 'Group indices by value. Going around the circle, the closest equal index is the previous or next one in that sorted list, wrapping around. The distance between i and j is the smaller of d and n minus d, where d is their difference. A value that appears once gives -1.',
    g: R => { const n = R.int(3, 8), q = R.int(1, Math.min(3, n)); return { nums: R.ints(n, 1, 3), queries: R.perm(n).slice(0, q) }; },
    s(I, T) {
      const a = I.nums, n = a.length, pos = new Map(); a.forEach((x, i) => { if (!pos.has(x)) pos.set(x, []); pos.get(x).push(i); });
      const dist = (i, j) => { const d = Math.abs(i - j); return Math.min(d, n - d); };
      T.at({ nums: A(a) }); T.n('How many distinct values?', pos.size, 'One index list per value.');
      const q0 = I.queries[0]; T.at({ nums: A(a, { i: q0, hl: pos.get(a[q0]) }) }); T.n(`How many indices hold the value ${a[q0]}?`, pos.get(a[q0]).length, 'Its sorted index list.');
      const res = I.queries.map(q => { const L = pos.get(a[q]); if (L.length < 2) return -1; const k = L.indexOf(q); return Math.min(dist(q, L[(k + 1) % L.length]), dist(q, L[(k - 1 + L.length) % L.length])); });
      I.queries.slice(0, 3).forEach((q, t) => { const L = pos.get(a[q]); T.at({ nums: A(a, { i: q, hl: L }), list: A(L) }); T.n(`Answer for query index ${q}? (-1 if the value appears once)`, res[t], L.length < 2 ? 'No other index has this value.' : 'Check the previous and next index in the list, wrapping around.'); });
      return res;
    }
  });

  D('fill-a-special-grid', {
    t: 'Fill a Special Grid',
    r: 'The grid has side 2 to the power n. Split it into four quadrants and give them consecutive blocks of numbers in the order top-right, bottom-right, bottom-left, top-left; fill each quadrant the same way.',
    g: R => ({ n: R.int(0, 3) }),
    s(I, T) {
      const N = 1 << I.n, g = Array.from({ length: N }, () => Array(N).fill(0));
      const f = (r, c, sz, base) => { if (sz === 1) { g[r][c] = base; return; } const h = sz / 2, q = h * h; f(r, c + h, h, base); f(r + h, c + h, h, base + q); f(r + h, c, h, base + 2 * q); f(r, c, h, base + 3 * q); };
      f(0, 0, N, 0);
      T.at({ n: I.n }); T.n('Side length of the grid?', N, '2 to the power n.');
      T.n('Numbers in each top-level quadrant? (1 if the grid is a single cell)', N === 1 ? 1 : N * N / 4, 'A quarter of all the cells.');
      T.at({ n: I.n, side: N }); T.n('Value in the top-left cell?', g[0][0], 'The top-left quadrant gets the last block, and inside it the top-left again.');
      if (N > 1) { T.at({ grid: G(g.map(r => r.map(() => '?')), { hl: [[0, N - 1]] }) }); T.n('Value in the top-right cell?', g[0][N - 1], 'The top-right quadrant starts at 0, and its own top-right comes first.'); }
      return g;
    }
  });

  D('find-closest-person', {
    t: 'Find Closest Person',
    r: 'Person 1 is at x, Person 2 at y, Person 3 at z. Compare the distance from x to z with the distance from y to z. Return 1 or 2 for whoever is closer, or 0 on a tie.',
    g: R => ({ x: R.int(1, 12), y: R.int(1, 12), z: R.int(1, 12) }),
    s(I, T) {
      const a = Math.abs(I.x - I.z), b = Math.abs(I.y - I.z), res = a < b ? 1 : b < a ? 2 : 0;
      T.at({ x: I.x, y: I.y, z: I.z }); T.n('Distance from Person 1 to Person 3?', a, 'Difference between x and z.');
      T.n('Distance from Person 2 to Person 3?', b, 'Difference between y and z.');
      const o = ['Person 1 (answer 1)', 'Person 2 (answer 2)', 'They tie (answer 0)'];
      T.c('Who reaches Person 3 first?', o, o[res === 1 ? 0 : res === 2 ? 1 : 2], 'The smaller distance wins; equal distances tie.');
      return res;
    }
  });

  D('find-most-frequent-vowel-and-consonant', {
    t: 'Find Most Frequent Vowel and Consonant',
    r: 'Count every letter. Add the largest vowel count and the largest consonant count, using 0 for a group that does not appear.',
    g: R => ({ s: R.str(R.int(1, 10), 'aeioubcst') }),
    s(I, T) {
      const c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const V = 'aeiou'; let mv = 0, mc = 0;
      Object.entries(c).forEach(([k, x]) => { if (V.includes(k)) mv = Math.max(mv, x); else mc = Math.max(mc, x); });
      T.at({ s: A(I.s.split('')), counts: K(Object.entries(c).sort()) });
      T.n('Highest vowel count? (0 if no vowels)', mv, 'Look only at a, e, i, o, u.');
      T.n('Highest consonant count? (0 if none)', mc, 'Every other letter.');
      T.n('Answer?', mv + mc, 'Add the two maxima.');
      return mv + mc;
    }
  });

  D('find-sum-of-array-product-of-magical-sequences', {
    t: 'Find Sum of Array Product of Magical Sequences',
    r: 'A sequence picks m indices (repeats allowed). It is magical when 2 to the power of each index, added up, has exactly k set bits. Only how many times each index is used matters: choose a count for each index from low to high, carry into the next bit, and weight each choice by nums[i] to the power count, divided by count factorial. Multiply by m factorial at the end to count the orderings.',
    g: R => { const m = R.int(1, 4); return { m, k: R.int(1, m), nums: R.ints(R.int(1, 4), 1, 9) }; },
    s(I, T) {
      const { m, k, nums } = I, n = nums.length, P = 1000000007n; let total = 0n, cnt = 0;
      const go = (d, s, p) => { if (d === m) { if (popc(s) === k) { total = (total + p) % P; cnt++; } return; } for (let i = 0; i < n; i++) go(d + 1, s + 2 ** i, p * BigInt(nums[i]) % P); };
      go(0, 0, 1n);
      T.at({ m, k, nums: A(nums) }); T.n('Sequences in total (n to the power m)?', n ** m, 'Each of the m picks has n choices.');
      T.yn('Does using index 0 for every pick give exactly k set bits?', popc(m) === k, `The sum is then ${m}, which has ${popc(m)} set bits.`);
      T.n('How many sequences are magical?', cnt, 'Count only how often each index is used, then multiply by the orderings.');
      const res = Number(total); T.n('Sum of their products (remainder by 1e9+7)?', res, 'Each magical sequence adds the product of its nums values.');
      return res;
    }
  });

  D('find-the-minimum-amount-of-time-to-brew-potions', {
    t: 'Find the Minimum Amount of Time to Brew Potions',
    r: 'A potion must flow through the wizards without waiting. With prefix skill sums pre, wizard i starts potion j at t plus mana[j] times pre[i], and that must be no earlier than when wizard i finished the previous potion. So t is the largest done[i] minus mana[j] times pre[i].',
    g: R => ({ skill: R.ints(R.int(1, 4), 1, 5), mana: R.ints(R.int(2, 4), 1, 5) }),
    s(I, T) {
      const sk = I.skill, mn = I.mana, n = sk.length, pre = [0]; sk.forEach(x => pre.push(pre[pre.length - 1] + x)); let done = Array(n).fill(0);
      T.at({ skill: A(sk), mana: A(mn), prefix: A(pre) }); T.n('Total skill of all wizards?', pre[n], 'Add skill.');
      T.n('Finish time of potion 0?', mn[0] * pre[n], 'It starts at 0 and passes every wizard: mana[0] times the total skill.');
      for (let j = 0; j < mn.length; j++) { let t = 0; for (let i = 0; i < n; i++) t = Math.max(t, done[i] - mn[j] * pre[i]); if (j && j <= 3) { T.at({ skill: A(sk), mana: A(mn, { i: j }), finished: A(done) }); T.n(`Start time of potion ${j}?`, t, 'Largest finish time minus mana times the skill before that wizard.'); } done = range(0, n).map(i => t + mn[j] * pre[i + 1]); }
      T.at({ finished: A(done) }); T.n('Time when the last potion is done?', done[n - 1], 'The last wizard finishes the last potion.');
      return done[n - 1];
    }
  });

  D('find-the-most-common-response', {
    t: 'Find the Most Common Response',
    r: 'Count each response at most once per day, using a set for each day. Take the response with the highest count, breaking ties by the smallest string.',
    g: R => ({ responses: Array.from({ length: R.int(1, 4) }, () => Array.from({ length: R.int(1, 4) }, () => R.pick(['good', 'ok', 'bad', 'great']))) }),
    s(I, T) {
      const c = new Map(); I.responses.forEach(day => new Set(day).forEach(x => c.set(x, (c.get(x) || 0) + 1)));
      const mx = Math.max(...c.values()), res = [...c].filter(e => e[1] === mx).map(e => e[0]).sort()[0];
      T.at({ day0: A(I.responses[0]) }); T.n('Distinct responses on day 0?', new Set(I.responses[0]).size, 'Repeats on the same day count once.');
      T.at({ counts: K([...c].sort()) }); T.n('Highest count?', mx, 'Days that mention the response.');
      const opts = [...new Set(['bad', 'good', 'great', 'ok', ...c.keys()])].sort();
      T.c('Most common response?', opts, res, 'Highest count, then the smallest string.');
      return res;
    }
  });

  D('find-time-required-to-eliminate-bacterial-strains', {
    t: 'Find Time Required to Eliminate Bacterial Strains',
    r: 'Think backwards: the last split joins two groups and costs splitTime plus the slower group. Like Huffman coding, keep merging the two smallest times a and b (a at most b) into b plus splitTime.',
    g: R => ({ timeReq: R.ints(R.int(2, 6), 1, 12), splitTime: R.int(1, 5) }),
    s(I, T) {
      const h = I.timeReq.slice().sort((a, b) => a - b); let step = 0;
      T.at({ timeReq: A(I.timeReq), splitTime: I.splitTime }); T.n('Merges needed?', h.length - 1, 'Each merge joins two groups into one.');
      while (h.length > 1) { const a = h.shift(), b = h.shift(), c = b + I.splitTime; if (step < 3) { T.at({ sorted: A([a, b, ...h], { hl: [0, 1] }), splitTime: I.splitTime }); T.n(`Merge ${step + 1}: new time from ${a} and ${b}?`, c, 'The larger one plus splitTime.'); } step++; let i = 0; while (i < h.length && h[i] < c) i++; h.splice(i, 0, c); }
      T.n('Total time?', h[0], 'The one group left.');
      return h[0];
    }
  });

  const lpConcat = (I, T) => {
    const s = I.s, t = I.t, n = s.length, m = t.length;
    const palStart = x => { const L = x.length, b = Array(L).fill(1); for (let c = 0; c < 2 * L - 1; c++) { let l = Math.floor(c / 2), r = l + c % 2; while (l >= 0 && r < L && x[l] === x[r]) { b[l] = Math.max(b[l], r - l + 1); l--; r++; } } return b; };
    const ps = palStart(s), pt = palStart(t.split('').reverse().join('')).reverse();
    const f = Array.from({ length: n }, () => Array(m + 1).fill(0)); let best = Math.max(...ps, ...pt), mir = 0;
    for (let i = 0; i < n; i++) for (let j = m - 1; j >= 0; j--) if (s[i] === t[j]) { const k = 1 + (i > 0 ? f[i - 1][j + 1] : 0); f[i][j] = k; mir = Math.max(mir, k); best = Math.max(best, 2 * k + (i + 1 < n ? ps[i + 1] : 0), 2 * k + (j > 0 ? pt[j - 1] : 0)); }
    T.at({ s: A(s.split('')), t: A(t.split('')) });
    T.n('Longest palindrome inside s alone?', Math.max(...ps), 'Expand around every center.');
    T.n('Longest palindrome inside t alone?', Math.max(...pt), 'Same check in t.');
    T.n('Longest piece of s that matches a piece of t read backwards? (0 if none)', mir, 'f[i][j] is 1 plus f[i minus 1][j plus 1] when s[i] equals t[j].');
    T.n('Longest palindrome after concatenation?', best, 'Twice the mirrored match plus the longest palindrome next to it, or a palindrome inside one string.');
    return best;
  };
  D('longest-palindrome-after-substring-concatenation-i', {
    t: 'Longest Palindrome After Substring Concatenation I',
    r: 'The answer is a palindrome inside s or t, or X then P from s with reverse(X) from t (P a palindrome in s right after X), or X from s with P then reverse(X) from t. Matching s ending at i against t read backwards from j gives the possible X lengths.',
    g: R => ({ s: R.str(R.int(1, 6), 'abc'), t: R.str(R.int(1, 6), 'abc') }),
    s: lpConcat
  });
  D('longest-palindrome-after-substring-concatenation-ii', {
    t: 'Longest Palindrome After Substring Concatenation II',
    r: 'Same plan as part I, but the strings are long, so use the DP: f[i][j] gives the mirrored part, and the extra middle is the longest palindrome starting right after it in s or ending right before it in t. Build both palindrome tables by expanding around centers.',
    g: R => ({ s: R.str(R.int(1, 7), 'ab'), t: R.str(R.int(1, 7), 'ab') }),
    s: lpConcat
  });

  D('make-a-positive-array', {
    t: 'Make a Positive Array',
    r: 'Scan left to right with prefix sums. A window of length at least 3 ending at i is bad when pre[i plus 1] is at most the largest pre[l] with l at most i minus 2, counting only since the last replacement. Replace nums[i] with a huge value, which fixes every window through i, and restart the tracking after it.',
    g: R => ({ nums: R.ints(R.int(3, 7), -6, 6) }),
    s(I, T) {
      const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); let ops = 0, st = 0, asked = 0;
      T.at({ nums: A(a), prefix: A(P) }); T.n('Windows of length 3 or more?', (n - 2) * (n - 1) / 2, 'Every start and end at least 2 apart.');
      for (let i = 2; i < n; i++) { if (i - 2 < st) continue; let mx = -Infinity; for (let l = st; l <= i - 2; l++) mx = Math.max(mx, P[l]); const bad = P[i + 1] <= mx; if (asked < 4) { T.at({ nums: A(a, { i, win: [st, i] }), prefix: A(P), 'last replacement': st ? st - 1 : 'none' }); T.yn(`Is there a bad window ending at index ${i}?`, bad, bad ? `pre[${i + 1}] = ${P[i + 1]} is at most ${mx}.` : `pre[${i + 1}] = ${P[i + 1]} is above ${mx}.`); asked++; } if (bad) { ops++; st = i + 1; } }
      T.at({ nums: A(a) }); T.n('Fewest replacements?', ops, 'One per bad window right end found by the scan.');
      return ops;
    }
  });

  D('make-array-non-decreasing', {
    t: 'Make Array Non-decreasing',
    r: 'A merged block becomes its maximum, so a block can stand alone only if its first element is at least everything before it. Count the elements that are at least the running maximum.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 9) }),
    s(I, T) {
      const a = I.nums; let mx = -Infinity, c = 0;
      T.at({ nums: A(a) }); T.n('Largest value overall?', Math.max(...a), 'Everything after it merges unless it ties.');
      a.forEach((x, i) => { const ok = x >= mx; if (i < 5) { T.at({ nums: A(a, { i }), 'running max': mx === -Infinity ? 'none' : mx }); T.yn(`Can ${x} at index ${i} start a new block?`, ok, ok ? 'It is at least the running maximum.' : 'It is below the running maximum, so it merges.'); } if (ok) c++; mx = Math.max(mx, x); });
      T.n('Maximum length after the operations?', c, 'Number of new running maxima.');
      return c;
    }
  });

  D('maximize-score-after-pair-deletions', {
    t: 'Maximize Score After Pair Deletions',
    r: 'Every operation removes from the ends, so what remains is one element (odd length) or two neighbours (even length), and any such choice is reachable. The score is the total minus the smallest possible remainder.',
    g: R => ({ nums: R.ints(R.int(3, 7), -5, 9) }),
    s(I, T) {
      const a = I.nums, n = a.length, tot = sum(a), odd = n % 2 === 1, rem = odd ? Math.min(...a) : Math.min(...range(0, n - 1).map(i => a[i] + a[i + 1]));
      T.at({ nums: A(a) }); T.n('Total sum?', tot, 'Add every element.');
      T.yn('Is the length odd, so one element stays?', odd, odd ? 'One element remains.' : 'Two neighbours remain.');
      T.n('Smallest possible remainder?', rem, odd ? 'The smallest element.' : 'The smallest sum of two neighbours.');
      T.n('Maximum score?', tot - rem, 'Total minus the remainder.');
      return tot - rem;
    }
  });

  D('maximum-containers-on-a-ship', {
    t: 'Maximum Containers on a Ship',
    r: 'The deck has n times n cells, and the weight limit allows maxWeight divided by w containers, rounded down. The answer is the smaller of the two.',
    g: R => ({ n: R.int(1, 6), w: R.int(1, 9), maxWeight: R.int(1, 120) }),
    s(I, T) {
      const cells = I.n * I.n, byW = Math.floor(I.maxWeight / I.w), res = Math.min(cells, byW);
      T.at({ n: I.n, w: I.w, maxWeight: I.maxWeight }); T.n('Cells on the deck?', cells, 'n times n.');
      T.n('Containers the weight limit allows?', byW, 'maxWeight divided by w, rounded down.');
      T.n('Maximum containers?', res, 'The smaller limit wins.');
      return res;
    }
  });

  D('maximum-product-of-two-digits', {
    t: 'Maximum Product of Two Digits',
    r: 'Digits are never negative, so the best product uses the two largest digits. The same digit value can be used twice only if it appears twice.',
    g: R => ({ n: R.int(10, 99999) }),
    s(I, T) {
      const d = String(I.n).split('').map(Number).sort((a, b) => b - a), res = d[0] * d[1];
      T.at({ n: I.n, digits: A(String(I.n).split('')) }); T.n('Largest digit?', d[0], 'Scan the digits.');
      T.n('Second largest digit (it may equal the first if it repeats)?', d[1], 'The next one in sorted order.');
      T.n('Maximum product?', res, 'Multiply the two.');
      return res;
    }
  });
})();
