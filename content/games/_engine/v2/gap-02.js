/* v2 games: former gap games (02), rebuilt as step-by-step v2 rounds. */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);
  const range = (a, b) => Array.from({ length: Math.max(0, b - a) }, (_, i) => a + i);

  D('maximum-unique-subarray-sum-after-deletion', {
    t: 'Maximum Unique Subarray Sum After Deletion',
    r: 'Deleting is free, so keep one copy of every positive value. If nothing is positive, the best is the single largest element.',
    g: R => ({ nums: R.ints(R.int(1, 7), -4, 5) }),
    s(I, T) {
      const a = I.nums, pos = [...new Set(a.filter(x => x > 0))], mx = Math.max(...a), res = pos.length ? sum(pos) : mx;
      T.at({ nums: A(a) }); T.n('Largest element?', mx, 'Used when nothing is positive.');
      T.n('Distinct positive values?', pos.length, 'Keep one copy of each.');
      T.n('Maximum sum?', res, pos.length ? 'Add the distinct positive values.' : 'No positives, so take the largest element.');
      return res;
    }
  });

  D('minimum-cost-to-reach-every-position', {
    t: 'Minimum Cost to Reach Every Position',
    r: 'Pay once to swap with someone ahead, and everyone behind them then swaps with you for free. So reaching position i costs the cheapest cost among positions 0 to i: a running minimum.',
    g: R => ({ cost: R.ints(R.int(3, 7), 1, 9) }),
    s(I, T) {
      let m = Infinity; const res = I.cost.map(x => (m = Math.min(m, x)));
      res.slice(0, 5).forEach((v, i) => { T.at({ cost: A(I.cost, { i, win: [0, i] }), 'answers so far': A(res.slice(0, i)) }); T.n(`Cost to reach position ${i}?`, v, `Cheapest cost among positions 0 to ${i}.`); });
      return res;
    }
  });

  D('minimum-deletions-for-at-most-k-distinct-characters', {
    t: 'Minimum Deletions for At Most K Distinct Characters',
    r: 'Keep the k most frequent letters and delete every copy of the rest.',
    g: R => ({ s: R.str(R.int(1, 9), 'abcd'), k: R.int(1, 3) }),
    s(I, T) {
      const c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const f = Object.values(c).sort((a, b) => b - a), kept = sum(f.slice(0, I.k)), res = I.s.length - kept;
      T.at({ s: A(I.s.split('')), counts: K(Object.entries(c).sort()), k: I.k }); T.n('Distinct letters?', f.length, 'Count the keys.');
      T.n(`Letters kept by the ${I.k} most frequent?`, kept, 'Add the largest counts.');
      T.n('Minimum deletions?', res, 'Length minus what is kept.');
      return res;
    }
  });

  D('minimum-operations-to-convert-all-elements-to-zero', {
    t: 'Minimum Operations to Convert All Elements to Zero',
    r: 'One operation on a value covers every occurrence not separated by a smaller value (zeros included). Scan with an increasing stack: pop larger values, and count a new operation whenever a positive value is pushed that is not already on top.',
    g: R => ({ nums: R.ints(R.int(2, 7), 0, 4) }),
    s(I, T) {
      const st = []; let ops = 0;
      I.nums.forEach((x, i) => { while (st.length && st[st.length - 1] > x) st.pop(); const nw = x > 0 && (!st.length || st[st.length - 1] < x); if (i < 5) { T.at({ nums: A(I.nums, { i }), stack: A(st.slice()) }); T.yn(`Does ${x} at index ${i} need a new operation?`, nw, x === 0 ? 'Zero needs nothing.' : nw ? 'It is not on top after popping larger values.' : `${x} is already on top, so the same operation covers it.`); } if (nw) { st.push(x); ops++; } });
      T.at({ nums: A(I.nums) }); T.n('Minimum operations?', ops, 'Number of new pushes.');
      return ops;
    }
  });

  D('minimum-operations-to-make-array-sum-divisible-by-k', {
    t: 'Minimum Operations to Make Array Sum Divisible by K',
    r: 'Each operation lowers the sum by 1, so the answer is the remainder of the sum divided by k.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 9), k: R.int(1, 8) }),
    s(I, T) {
      const s = sum(I.nums), r = s % I.k;
      T.at({ nums: A(I.nums), k: I.k }); T.n('Sum of nums?', s, 'Add everything.');
      T.yn('Is the sum already divisible by k?', r === 0, `${s} divided by ${I.k} leaves ${r}.`);
      T.n('Minimum operations?', r, 'Subtract the remainder one at a time.');
      return r;
    }
  });

  D('minimum-pair-removal-to-sort-array-i', {
    t: 'Minimum Pair Removal to Sort Array I',
    r: 'The array is short, so follow the rule literally: while the array is not non-decreasing, merge the leftmost adjacent pair with the smallest sum.',
    g: R => ({ nums: R.ints(R.int(2, 6), -3, 6) }),
    s(I, T) {
      let a = I.nums.slice(), ops = 0; const sorted = x => x.every((v, i) => !i || x[i - 1] <= v);
      T.at({ nums: A(a) }); T.yn('Is the array already non-decreasing?', sorted(a), sorted(a) ? 'No merges needed.' : 'Some neighbour drops.');
      T.n('Smallest adjacent pair sum at the start?', Math.min(...range(0, a.length - 1).map(i => a[i] + a[i + 1])), 'Check every neighbour pair.');
      while (!sorted(a)) { let b = 0; for (let i = 1; i + 1 < a.length; i++) if (a[i] + a[i + 1] < a[b] + a[b + 1]) b = i; if (ops < 3) { T.at({ nums: A(a, { win: [b, b + 1] }) }); T.n(`Merge ${ops + 1}: index where the merged pair starts?`, b, 'Leftmost pair with the smallest sum.'); } a.splice(b, 2, a[b] + a[b + 1]); ops++; }
      T.at({ nums: A(a) }); T.n('Minimum operations?', ops, 'Merges until the array is non-decreasing.');
      return ops;
    }
  });

  D('multiply-two-polynomials', {
    t: 'Multiply Two Polynomials',
    r: 'The product coefficients are the convolution of the two coefficient arrays: coefficient i plus j gets poly1[i] times poly2[j]. A double loop costs n times m; an FFT (or NTT with an offset for negatives) is faster for big inputs. Round each floating result to the nearest integer.',
    g: R => ({ poly1: R.ints(R.int(1, 4), -3, 5), poly2: R.ints(R.int(1, 4), -3, 5) }),
    s(I, T) {
      const a = I.poly1, b = I.poly2, c = Array(a.length + b.length - 1).fill(0); a.forEach((x, i) => b.forEach((y, j) => { c[i + j] += x * y; }));
      T.at({ poly1: A(a), poly2: A(b) }); T.n('Length of the product?', c.length, 'n plus m minus 1.');
      T.n('Coefficient 0?', c[0], 'poly1[0] times poly2[0].');
      T.n(`Last coefficient (index ${c.length - 1})?`, c[c.length - 1], 'The last entries multiplied.');
      if (c.length > 2) T.n('Coefficient 1?', c[1], 'poly1[0] times poly2[1] plus poly1[1] times poly2[0], where they exist.');
      return c;
    }
  });

  D('number-of-unique-xor-triplets-i', {
    t: 'Number of Unique XOR Triplets I',
    r: 'nums is a permutation of 1 to n. For n at least 3, every value from 0 up to 2 to the power (bits of n), minus 1, is reachable. For n = 1 or 2 the answer is n.',
    g: R => ({ nums: R.perm(R.int(1, 9), 1) }),
    s(I, T) {
      const n = I.nums.length, bits = n.toString(2).length, res = n < 3 ? n : 1 << bits;
      T.at({ nums: A(I.nums), n }); T.n('Bits needed to write n?', bits, `${n} in binary is ${n.toString(2)}.`);
      T.yn('Is n at least 3?', n >= 3, n >= 3 ? 'Then every value below the next power of two appears.' : 'Small cases: only n values.');
      T.n('Distinct XOR triplet values?', res, n < 3 ? 'n itself.' : `2 to the power ${bits}.`);
      return res;
    }
  });

  D('number-of-unique-xor-triplets-ii', {
    t: 'Number of Unique XOR Triplets II',
    r: 'Values are small (below 2048). Build the set of a XOR b over distinct values (a may equal b), then XOR each with every value, and count the results.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 15) }),
    s(I, T) {
      const v = [...new Set(I.nums)], pairs = new Set(), all = new Set(); v.forEach(a => v.forEach(b => pairs.add(a ^ b))); pairs.forEach(p => v.forEach(c => all.add(p ^ c)));
      T.at({ nums: A(I.nums) }); T.n('Distinct values?', v.length, 'Repeats add nothing new.');
      T.n('Distinct values of a XOR b?', pairs.size, 'Includes 0 from a value with itself.');
      T.n('Distinct XOR triplet values?', all.size, 'XOR every pair result with every value.');
      return all.size;
    }
  });

  D('phone-number-prefix', {
    t: 'Phone Number Prefix',
    r: 'Sort the numbers as strings. If some number is a prefix of another, it is also a prefix of the number right after it, so one sort and a neighbour check are enough. Return true when no number is a prefix of another.',
    g: R => { const s = new Set(), n = R.int(2, 5); while (s.size < n) s.add(R.str(R.int(1, 3), '012')); return { numbers: R.perm(n).map(i => [...s][i]) }; },
    s(I, T) {
      const o = I.numbers.slice().sort(); let ok = true;
      T.at({ numbers: A(I.numbers) }); T.c('First number in sorted (dictionary) order?', [...new Set(I.numbers)], o[0], 'Compare character by character.');
      for (let i = 0; i + 1 < o.length; i++) { const p = o[i + 1].startsWith(o[i]); if (i < 3) { T.at({ sorted: A(o, { i, j: i + 1 }) }); T.yn(`Is "${o[i]}" a prefix of "${o[i + 1]}"?`, p, p ? 'The next number starts with it.' : 'They differ before it ends.'); } if (p) ok = false; }
      T.yn('Is the list prefix-free (answer true)?', ok, ok ? 'No neighbour pair failed.' : 'A neighbour pair has a prefix.');
      return ok;
    }
  });

  D('reverse-degree-of-a-string', {
    t: 'Reverse Degree of a String',
    r: 'Each letter has a reverse value: 26 for a, 25 for b, down to 1 for z. Multiply it by the letter position (starting at 1) and add everything up.',
    g: R => ({ s: R.str(R.int(1, 6), 'abcxyz') }),
    s(I, T) {
      const s = I.s, rv = c => 26 - (c.charCodeAt(0) - 97), res = sum(s.split('').map((c, i) => rv(c) * (i + 1)));
      T.at({ s: A(s.split('')) }); T.n(`Reverse value of "${s[0]}"?`, rv(s[0]), '26 minus its distance from a.');
      T.n(`Contribution of the last letter (position ${s.length})?`, rv(s[s.length - 1]) * s.length, 'Reverse value times position.');
      T.n('Reverse degree?', res, 'Add every contribution.');
      return res;
    }
  });

  D('unique-3-digit-even-numbers', {
    t: 'Unique 3-Digit Even Numbers',
    r: 'There are only 450 even numbers from 100 to 998. Keep those whose digit counts fit inside the given digit counts.',
    g: R => ({ digits: R.ints(R.int(3, 5), 0, 9) }),
    s(I, T) {
      const c = Array(10).fill(0); I.digits.forEach(d => c[d]++); let res = 0;
      for (let x = 100; x < 1000; x += 2) { const u = Array(10).fill(0); String(x).split('').forEach(d => u[+d]++); if (u.every((v, i) => v <= c[i])) res++; }
      T.at({ digits: A(I.digits) }); T.n('Distinct even digits available for the last place?', new Set(I.digits.filter(d => d % 2 === 0)).size, 'The number must end in an even digit.');
      T.yn('Is there a non-zero digit for the first place?', I.digits.some(d => d > 0), 'The first digit cannot be 0.');
      T.n('Distinct 3-digit even numbers?', res, 'Check every even number from 100 to 998 against the digit counts.');
      return res;
    }
  });
})();
