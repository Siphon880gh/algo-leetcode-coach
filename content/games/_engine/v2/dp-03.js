/* v2 games: dynamic programming (3). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const Q = v => v === undefined ? '?' : v;
  const tbl = (dp, o) => G(dp.map(r => r.map(Q)), o);
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;

  D('guess-number-higher-or-lower-ii', {
    t: 'Guess Number II: minimize the worst case of each guess',
    r: 'dp[l][r] = money needed to guarantee a win on [l, r]. Try every guess g: g + max(dp[l][g−1], dp[g+1][r]); keep the smallest.',
    g: R => ({ n: R.int(4, 6) }),
    s(I, T) {
      const n = I.n, dp = mk(n + 2, n + 2, 0);
      for (let len = 2; len <= n; len++) for (let l = 1; l + len - 1 <= n; l++) { const r = l + len - 1; let b = Infinity, bg = l;
        for (let g = l; g <= r; g++) { const c = g + Math.max(dp[l][g - 1] || 0, g + 1 <= r ? dp[g + 1][r] : 0); if (c < b) { b = c; bg = g; } }
        T.at({ range: `[${l}, ${r}]`, nums: A(Array.from({ length: n }, (_, i) => i + 1), { hl: [bg - 1], win: [l - 1, r - 1] }) });
        T.n(`dp[${l}][${r}]: cheapest guaranteed cost?`, b, `Best first guess ${bg}: ${bg} + worse side = ${b}.`); dp[l][r] = b; }
      return dp[1][n] || 0;
    }
  });

  D('wiggle-subsequence', {
    t: 'Wiggle Subsequence: extend the opposite direction',
    r: 'up = longest wiggle ending on a rise, down = ending on a fall. A rise sets up = down + 1; a fall sets down = up + 1; equal values change nothing.',
    g: R => ({ nums: R.ints(R.int(7, 8), 1, 9) }),
    s(I, T) {
      const a = I.nums; let up = 1, down = 1;
      for (let i = 1; i < a.length; i++) { const d = a[i] - a[i - 1];
        T.at({ nums: A(a, { hl: [i - 1, i] }), up, down });
        T.c(`${a[i - 1]} → ${a[i]}: which length changes?`, ['up = down + 1', 'down = up + 1', 'neither'], d > 0 ? 'up = down + 1' : d < 0 ? 'down = up + 1' : 'neither', d > 0 ? 'A rise extends a sequence that ended on a fall.' : d < 0 ? 'A fall extends a sequence that ended on a rise.' : 'Equal neighbours never help a wiggle.');
        if (d > 0) up = down + 1; else if (d < 0) down = up + 1; }
      return a.length ? Math.max(up, down) : 0;
    }
  });

  D('combination-sum-iv', {
    t: 'Combination Sum IV: count by the last number used',
    r: 'dp[t] = number of ordered sequences summing to t. dp[0] = 1, and dp[t] = Σ dp[t − x] over every x ≤ t (x is the last number).',
    g: R => ({ nums: R.distinct(R.int(2, 3), 1, 4).sort((a, b) => a - b), target: R.int(4, 7) }),
    s(I, T) { const dp = [1]; for (let t = 1; t <= I.target; t++) { const v = I.nums.reduce((s, x) => s + (x <= t ? dp[t - x] : 0), 0); T.at({ nums: A(I.nums), dp: A(dp.concat('?')) }); T.n(`dp[${t}]?`, v, I.nums.filter(x => x <= t).map(x => `dp[${t - x}]`).join(' + ') + ` = ${v}.`); dp.push(v); } return dp[I.target]; }
  });

  D('rotate-function', {
    t: 'Rotate Function: slide F(k) from F(k−1)',
    r: 'F(k) = F(k−1) + sum(nums) − n · (the element that moves from the end to the front). No need to recompute the whole sum.',
    g: R => ({ nums: R.ints(R.int(4, 5), -3, 9) }),
    s(I, T) {
      const a = I.nums, n = a.length, sum = a.reduce((x, y) => x + y, 0); let F = a.reduce((s, x, i) => s + i * x, 0), best = F;
      T.at({ nums: A(a), sum, 'F(0)': F });
      for (let k = 1; k < n; k++) { const nf = F + sum - n * a[n - k];
        T.at({ nums: A(a, { hl: [n - k] }), sum, ['F(' + (k - 1) + ')']: F, best });
        T.n(`F(${k}) = F(${k - 1}) + sum − n·nums[${n - k}] = ?`, nf, `${F} + ${sum} − ${n}·${a[n - k]}.`); F = nf; best = Math.max(best, F); }
      return best;
    }
  });

  D('frog-jump', {
    t: 'Frog Jump: carry the set of jump sizes per stone',
    r: 'For each stone keep the jump sizes that can land on it. From a stone with size k, try k−1, k, k+1 forward; a stone with no sizes was never reached.',
    g: R => { const s = [0, 1]; while (s.length < R.int(6, 7)) s.push(s[s.length - 1] + R.int(1, 3)); return { stones: s }; },
    s(I, T) {
      const st = I.stones, map = new Map(st.map(x => [x, new Set()])); map.get(0).add(0);
      st.forEach((x, i) => { const ks = map.get(x);
        if (i) { T.at({ stones: A(st, { hl: [i] }), sizes: X([...ks].join(', ') || '(none)', 'jump sizes landing here') }); T.yn(`Can the frog reach stone ${x}?`, ks.size > 0, 'Reached only if some earlier stone added a jump size that lands here.'); }
        for (const k of ks) for (const d of [k - 1, k, k + 1]) if (d > 0 && map.has(x + d)) map.get(x + d).add(d); });
      return map.get(st[st.length - 1]).size > 0;
    }
  });

  D('arithmetic-slices', {
    t: 'Arithmetic Slices: extend the current run',
    r: 'If nums[i] − nums[i−1] equals the previous difference, every slice ending at i−1 extends and one more starts: cur = cur + 1. Otherwise cur = 0. Add cur each step.',
    g: R => { const a = [R.int(1, 5)]; let d = R.int(-2, 2); while (a.length < 8) { if (R.chance(0.25)) d = R.int(-2, 2); a.push(a[a.length - 1] + d); } return { nums: a }; },
    s(I, T) { const a = I.nums; let cur = 0, tot = 0; for (let i = 2; i < a.length; i++) { cur = a[i] - a[i - 1] === a[i - 1] - a[i - 2] ? cur + 1 : 0; T.at({ nums: A(a, { hl: [i - 2, i - 1, i] }), total: tot }); T.n(`Slices ending at index ${i}?`, cur, a[i] - a[i - 1] === a[i - 1] - a[i - 2] ? 'Same difference: previous + 1.' : 'Difference changed: 0.'); tot += cur; } return tot; }
  });

  D('sentence-screen-fitting', {
    t: 'Sentence Screen Fitting: fill row by row, words never split',
    r: 'On each row place words while the word fits (plus one space between words). Count a full sentence every time the last word is placed.',
    g: R => ({ sentence: Array.from({ length: R.int(2, 3) }, () => R.str(R.int(1, 3), 'abcde')), rows: R.int(3, 4), cols: R.int(5, 8) }),
    s(I, T) {
      const w = I.sentence; if (w.some(x => x.length > I.cols)) return 0; let idx = 0, count = 0;
      for (let r = 0; r < I.rows; r++) { let col = 0, line = [];
        while (col + w[idx].length <= I.cols) { line.push(w[idx]); col += w[idx].length + 1; idx++; if (idx === w.length) { idx = 0; count++; } }
        T.at({ row: r, placed: line.join(' '), sentences: count });
        T.n(`After row ${r}, which word index starts the next row?`, idx, `Row ${r} holds "${line.join(' ')}".`); }
      return count;
    }
  });

  D('arithmetic-slices-ii-subsequence', {
    t: 'Arithmetic Slices II: count by (end, difference)',
    r: 'dp[i][d] = arithmetic subsequences of length ≥ 2 ending at i with difference d. For each j < i: d = a[i] − a[j]; dp[j][d] of them become length ≥ 3 (count them), and dp[i][d] += dp[j][d] + 1.',
    g: R => ({ nums: R.ints(5, 1, 6) }),
    s(I, T) {
      const a = I.nums, dp = a.map(() => new Map()); let total = 0;
      for (let i = 0; i < a.length; i++) { let add = 0;
        for (let j = 0; j < i; j++) { const d = a[i] - a[j], c = dp[j].get(d) || 0; add += c; dp[i].set(d, (dp[i].get(d) || 0) + c + 1); }
        if (i >= 2) { T.at({ nums: A(a, { hl: [i] }), total }); T.n(`New subsequences of length ≥ 3 ending at index ${i}?`, add, 'Σ dp[j][a[i] − a[j]] over j < i.'); }
        total += add; }
      return total;
    }
  });

  D('can-i-win', {
    t: 'Can I Win: a pick wins if it leaves the opponent losing',
    r: 'Memoize on the set of used numbers. You win if some unused x reaches the total now, or leaves a position where the opponent cannot win.',
    g: R => ({ maxChoosableInteger: R.int(3, 5), desiredTotal: R.int(5, 11) }),
    s(I, T) {
      const M = I.maxChoosableInteger, D0 = I.desiredTotal;
      if (D0 <= 0) return true; if (M * (M + 1) / 2 < D0) return false;
      const memo = new Map(), win = (mask, rem) => { if (memo.has(mask)) return memo.get(mask); let r = false; for (let x = 1; x <= M && !r; x++) if (!(mask & (1 << x))) r = x >= rem || !win(mask | (1 << x), rem - x); memo.set(mask, r); return r; };
      for (let x = 1; x <= M; x++) { const w = x >= D0 || !win(1 << x, D0 - x); T.at({ numbers: A(Array.from({ length: M }, (_, i) => i + 1), { hl: [x - 1] }), total: D0 }); T.yn(`First pick ${x}: does it guarantee a win?`, w, w ? (x >= D0 ? 'It reaches the total right away.' : 'Every reply leaves you a winning move.') : 'The opponent has a winning reply.'); }
      return win(0, D0);
    }
  });

  D('count-the-repetitions', {
    t: 'Count the Repetitions: scan s1 copies, count finished s2',
    r: 'Walk through n1 copies of s1, advancing a pointer in s2 on every match. Each time the pointer wraps, one more s2 is done. The answer is s2 count / n2.',
    g: R => ({ s1: R.str(3, 'abc'), n1: R.int(3, 4), s2: R.str(2, 'abc'), n2: R.int(1, 2) }),
    s(I, T) {
      let j = 0, cnt = 0;
      for (let c = 0; c < I.n1; c++) { for (const ch of I.s1) if (ch === I.s2[j]) { j++; if (j === I.s2.length) { j = 0; cnt++; } }
        T.at({ s1: A([...I.s1]), s2: A([...I.s2], { j }) }); T.n(`After ${c + 1} copies of s1, how many full s2 found?`, cnt, 'Count each time the s2 pointer wraps.'); }
      return Math.floor(cnt / I.n2);
    }
  });

  D('unique-substrings-in-wraparound-string', {
    t: 'Unique Substrings in Wraparound String: longest run per ending letter',
    r: 'Track the length of the current consecutive run (…, y, z, a, …). For each ending letter keep the longest run; the answer is the sum of those maxima.',
    g: R => ({ s: R.str(R.int(6, 8), 'abcdz') }),
    s(I, T) {
      const s = I.s, best = {}; let run = 0;
      for (let i = 0; i < s.length; i++) { run = i && (s.charCodeAt(i) - s.charCodeAt(i - 1) + 26) % 26 === 1 ? run + 1 : 1;
        T.at({ s: A([...s], { hl: [i] }), best: Object.assign({}, best) }); T.n(`Run length ending at index ${i} ("${s[i]}")?`, run, i && (s.charCodeAt(i) - s.charCodeAt(i - 1) + 26) % 26 === 1 ? 'It follows the previous letter: run + 1.' : 'Run restarts: 1.');
        best[s[i]] = Math.max(best[s[i]] || 0, run); }
      return Object.values(best).reduce((a, b) => a + b, 0);
    }
  });

  const decode = e => { let out = '', i = 0; while (i < e.length) { if (/\d/.test(e[i])) { let k = 0; while (/\d/.test(e[i])) k = k * 10 + +e[i++]; i++; let d = 1, j = i; while (d) { if (e[j] === '[') d++; if (e[j] === ']') d--; j++; } out += decode(e.slice(i, j - 1)).repeat(k); i = j; } else out += e[i++]; } return out; };
  D('encode-string-with-shortest-length', {
    t: 'Encode String with Shortest Length: best of split or repeat',
    r: 'dp[i][j] = shortest encoding of s[i..j]. Either split it into two encoded parts, or, if it is a repeated pattern, write k[pattern] with the pattern encoded.',
    g: R => { const u = R.str(R.int(1, 2), 'ab'); return { s: R.chance(0.7) ? u.repeat(R.int(3, 5)) + R.str(R.int(0, 1), 'ab') : R.str(6, 'ab') }; },
    s(I, T) {
      const s = I.s, n = s.length, dp = mk(n, n, '');
      for (let len = 1; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1, sub = s.slice(i, j + 1); let b = sub;
        if (len >= 5) { for (let k = i; k < j; k++) if (dp[i][k].length + dp[k + 1][j].length < b.length) b = dp[i][k] + dp[k + 1][j];
          const p = (sub + sub).indexOf(sub, 1); if (p < len) { const e = len / p + '[' + dp[i][i + p - 1] + ']'; if (e.length < b.length) b = e; } }
        if (len >= 4 && j === n - 1) { T.at({ s: A([...s], { win: [i, j] }) }); T.n(`Shortest encoded length of "${sub}"?`, b.length, `Best: "${b}".`); }
        dp[i][j] = b; }
      return dp[0][n - 1];
    },
    cmp: (o, e, I) => typeof o === 'string' && o.length === e.length && decode(o) === I.s
  });

  D('ones-and-zeroes', {
    t: 'Ones and Zeroes: 0/1 knapsack with two budgets',
    r: 'dp[z][o] = most strings using at most z zeros and o ones. For each string (zeros c0, ones c1), go backwards: dp[z][o] = max(dp[z][o], dp[z−c0][o−c1] + 1).',
    g: R => ({ strs: Array.from({ length: R.int(4, 5) }, () => R.str(R.int(1, 3), '01')), m: R.int(2, 3), n: R.int(2, 3) }),
    s(I, T) {
      const dp = mk(I.m + 1, I.n + 1, 0);
      I.strs.forEach(s => { const z = [...s].filter(c => c === '0').length, o = s.length - z;
        for (let a = I.m; a >= z; a--) for (let b = I.n; b >= o; b--) dp[a][b] = Math.max(dp[a][b], dp[a - z][b - o] + 1);
        T.at({ string: `"${s}" (${z} zeros, ${o} ones)`, dp: G(dp, { hl: [[I.m, I.n]] }) }); T.n(`After "${s}": dp[${I.m}][${I.n}]?`, dp[I.m][I.n], 'Take it or leave it, budgets permitting.'); });
      return dp[I.m][I.n];
    }
  });

  D('predict-the-winner', {
    t: 'Predict the Winner: best lead the mover can force',
    r: 'dp[l][r] = the lead the player to move can force on nums[l..r]: max(nums[l] − dp[l+1][r], nums[r] − dp[l][r−1]). Player 1 wins if dp[0][n−1] ≥ 0.',
    g: R => ({ nums: R.ints(R.int(4, 5), 1, 9) }),
    s(I, T) {
      const a = I.nums, n = a.length, dp = mk(n, n, 0); for (let i = 0; i < n; i++) dp[i][i] = a[i];
      for (let len = 2; len <= n; len++) for (let l = 0; l + len <= n; l++) { const r = l + len - 1, v = Math.max(a[l] - dp[l + 1][r], a[r] - dp[l][r - 1]);
        T.at({ nums: A(a, { win: [l, r] }) }); T.n(`dp[${l}][${r}]: the lead the mover can force?`, v, `max(${a[l]} − ${dp[l + 1][r]}, ${a[r]} − ${dp[l][r - 1]}).`); dp[l][r] = v; }
      return dp[0][n - 1] >= 0;
    }
  });

  D('max-consecutive-ones-ii', {
    t: 'Max Consecutive Ones II: a window with at most one zero',
    r: 'Grow the window to the right. When it holds two zeros, move the left edge just past the older zero. The answer is the widest window.',
    g: R => ({ nums: Array.from({ length: R.int(8, 9) }, () => R.chance(0.7) ? 1 : 0) }),
    s(I, T) { const a = I.nums; let l = 0, last = -1, best = 0; a.forEach((x, r) => { if (x === 0) { l = last + 1; last = r; } T.at({ nums: A(a, { win: [l, r], l, r }), best }); T.n(`Window length ending at ${r}?`, r - l + 1, x === 0 ? 'A new zero: left jumps past the previous zero.' : 'Extend by one.'); best = Math.max(best, r - l + 1); }); return best; }
  });

  D('fibonacci-number', {
    t: 'Fibonacci Number: keep only the last two',
    r: 'F(i) = F(i−1) + F(i−2). Two variables are enough: slide them forward.',
    g: R => ({ n: R.int(5, 9) }),
    s(I, T) { if (I.n < 2) return I.n; let a = 0, b = 1; for (let i = 2; i <= I.n; i++) { T.at({ 'F(i−2)': a, 'F(i−1)': b }); T.n(`F(${i})?`, a + b, `${a} + ${b}.`); [a, b] = [b, a + b]; } return b; }
  });

  D('freedom-trail', {
    t: 'Freedom Trail: cheapest ring position for each key letter',
    r: 'dp[i][p] = fewest rotations to spell key[0..i] with ring position p (holding key[i]) at 12 o\'clock. Moving from q to p costs min(|p−q|, n − |p−q|). Add one press per letter.',
    g: R => { const ring = R.str(6, 'abcd'); return { ring, key: Array.from({ length: R.int(2, 3) }, () => R.pick([...ring])).join('') }; },
    s(I, T) {
      const { ring, key } = I, n = ring.length, dist = (a, b) => Math.min(Math.abs(a - b), n - Math.abs(a - b)); let prev = new Map([[0, 0]]);
      for (let i = 0; i < key.length; i++) { const cur = new Map();
        for (let p = 0; p < n; p++) if (ring[p] === key[i]) { let b = Infinity; for (const [q, c] of prev) b = Math.min(b, c + dist(p, q));
          T.at({ ring: A([...ring], { hl: [p] }), prev: X([...prev].map(([q, c]) => q + ':' + c).join('  '), 'cost at each previous position') }); T.n(`Rotations to put "${key[i]}" at index ${p} on top (after spelling "${key.slice(0, i)}")?`, b, 'min over previous positions q of cost[q] + ring distance.'); cur.set(p, b); }
        prev = cur; }
      return Math.min(...prev.values()) + key.length;
    }
  });

  D('longest-palindromic-subsequence', {
    t: 'Longest Palindromic Subsequence: match the ends or drop one',
    r: 'dp[l][r]: if s[l] == s[r], 2 + dp[l+1][r−1]; else max(dp[l+1][r], dp[l][r−1]). Fill by increasing length.',
    g: R => ({ s: R.str(R.int(5, 6), 'abc') }),
    s(I, T) {
      const s = I.s, n = s.length, dp = mk(n, n, 0); for (let i = 0; i < n; i++) dp[i][i] = 1;
      for (let len = 2; len <= n; len++) for (let l = 0; l + len <= n; l++) { const r = l + len - 1, v = s[l] === s[r] ? 2 + (len > 2 ? dp[l + 1][r - 1] : 0) : Math.max(dp[l + 1][r], dp[l][r - 1]);
        T.at({ s: A([...s], { win: [l, r], hl: [l, r] }) }); T.n(`dp[${l}][${r}] for "${s.slice(l, r + 1)}"?`, v, s[l] === s[r] ? `Ends match: 2 + inside.` : `Ends differ: max(drop left ${dp[l + 1][r]}, drop right ${dp[l][r - 1]}).`); dp[l][r] = v; }
      return dp[0][n - 1];
    }
  });

  D('remove-boxes', {
    t: 'Remove Boxes: carry the same-color boxes waiting on the left',
    r: 'f(l, r, k) = best for boxes[l..r] with k boxes equal to boxes[l] glued in front. Either remove boxes[l] with its k friends now ((k+1)² + f(l+1, r, 0)), or save it for a later equal box m: f(l+1, m−1, 0) + f(m, r, k+1).',
    g: R => ({ boxes: R.ints(R.int(4, 6), 1, 3) }),
    s(I, T) {
      const b = I.boxes, memo = new Map();
      const f = (l, r, k) => { if (l > r) return 0; const key = l + ',' + r + ',' + k; if (memo.has(key)) return memo.get(key);
        let best = (k + 1) * (k + 1) + f(l + 1, r, 0); for (let m = l + 1; m <= r; m++) if (b[m] === b[l]) best = Math.max(best, f(l + 1, m - 1, 0) + f(m, r, k + 1)); memo.set(key, best); return best; };
      for (let r = 1; r < b.length; r++) { T.at({ boxes: A(b, { win: [0, r] }) }); T.n(`Best points for the first ${r + 1} boxes alone?`, f(0, r, 0), 'Group equal colors before removing them: k boxes at once give k².'); }
      return f(0, b.length - 1, 0);
    }
  });

  D('student-attendance-record-ii', {
    t: 'Student Attendance Record II: states by absences and trailing lates',
    r: 'State (a, l): a absences so far (0 or 1), l late days at the end (0..2). Each day: P resets l, L adds one (only if l < 2), A needs a = 0 and resets l.',
    g: R => ({ n: R.int(2, 5) }),
    s(I, T) {
      let st = [[1, 0, 0], [0, 0, 0]];
      for (let d = 1; d <= I.n; d++) { const nx = [[0, 0, 0], [0, 0, 0]];
        for (let a = 0; a < 2; a++) for (let l = 0; l < 3; l++) { const c = st[a][l]; if (!c) continue; nx[a][0] = (nx[a][0] + c) % MOD; if (l < 2) nx[a][l + 1] = (nx[a][l + 1] + c) % MOD; if (!a) nx[1][0] = (nx[1][0] + c) % MOD; }
        st = nx; const tot = st.flat().reduce((x, y) => (x + y) % MOD, 0);
        T.at({ states: G(st, { rh: ['A=0', 'A=1'], ch: ['L0', 'L1', 'L2'] }) }); T.n(`Valid records of length ${d}?`, tot, 'Sum all six states.'); }
      return st.flat().reduce((x, y) => (x + y) % MOD, 0);
    }
  });

  D('longest-line-of-consecutive-one-in-matrix', {
    t: 'Longest Line of Ones: four running counts per cell',
    r: 'For a 1 at (i,j): horizontal = left + 1, vertical = up + 1, diagonal = up-left + 1, anti-diagonal = up-right + 1. The answer is the largest count anywhere.',
    g: R => ({ mat: R.grid(3, 4, 0, 1) }),
    s(I, T) {
      const M = I.mat, m = M.length, n = M[0].length, dp = Array.from({ length: m }, () => Array.from({ length: n }, () => [0, 0, 0, 0])); let best = 0;
      for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) if (M[i][j]) { const g = (x, y, k) => x >= 0 && y >= 0 && y < n ? dp[x][y][k] : 0;
        dp[i][j] = [g(i, j - 1, 0) + 1, g(i - 1, j, 1) + 1, g(i - 1, j - 1, 2) + 1, g(i - 1, j + 1, 3) + 1]; const mx = Math.max(...dp[i][j]);
        T.at({ mat: G(M, { hl: [[i, j]] }), best }); T.n(`Longest line ending at (${i},${j}) in any direction?`, mx, `horizontal ${dp[i][j][0]}, vertical ${dp[i][j][1]}, diagonal ${dp[i][j][2]}, anti ${dp[i][j][3]}.`); best = Math.max(best, mx); }
      return best;
    }
  });

  D('out-of-boundary-paths', {
    t: 'Out of Boundary Paths: spread counts one move at a time',
    r: 'cnt[r][c] = ways to be at (r,c) after t moves. Each move pushes every count to its 4 neighbors; a push off the grid is an exit and adds to the answer.',
    g: R => { const m = R.int(1, 3), n = R.int(2, 3); return { m, n, maxMove: R.int(2, 3), startRow: R.int(0, m - 1), startColumn: R.int(0, n - 1) }; },
    s(I, T) {
      let cnt = mk(I.m, I.n, 0); cnt[I.startRow][I.startColumn] = 1; let total = 0;
      for (let t = 1; t <= I.maxMove; t++) { const nx = mk(I.m, I.n, 0); let ex = 0;
        for (let r = 0; r < I.m; r++) for (let c = 0; c < I.n; c++) if (cnt[r][c]) for (const [dr, dc] of [[1, 0], [-1, 0], [0, 1], [0, -1]]) { const x = r + dr, y = c + dc; if (x < 0 || y < 0 || x >= I.m || y >= I.n) ex = (ex + cnt[r][c]) % MOD; else nx[x][y] = (nx[x][y] + cnt[r][c]) % MOD; }
        T.at({ counts: G(cnt, { label: 'ways to be here before move ' + t }), exited: total }); T.n(`Paths that exit on move ${t}?`, ex, 'For each cell, count its neighbors outside the grid times its ways.'); total = (total + ex) % MOD; cnt = nx; }
      return total;
    }
  });

  D('delete-operation-for-two-strings', {
    t: 'Delete Operation for Two Strings: keep the longest common subsequence',
    r: 'Fill the LCS table: equal letters extend the diagonal, otherwise take the larger of up/left. Deletions = len1 + len2 − 2·LCS.',
    g: R => ({ word1: R.str(R.int(3, 4), 'abc'), word2: R.str(R.int(3, 4), 'abc') }),
    s(I, T) {
      const a = I.word1, b = I.word2, dp = mk(a.length + 1, b.length + 1, 0);
      for (let i = 1; i <= a.length; i++) for (let j = 1; j <= b.length; j++) { const v = a[i - 1] === b[j - 1] ? dp[i - 1][j - 1] + 1 : Math.max(dp[i - 1][j], dp[i][j - 1]);
        T.at({ lcs: G(dp, { rh: ['ε', ...a], ch: ['ε', ...b], hl: [[i, j]] }) }); T.n(`LCS[${i}][${j}]?`, v, a[i - 1] === b[j - 1] ? 'Letters match: diagonal + 1.' : 'No match: max(up, left).'); dp[i][j] = v; }
      return a.length + b.length - 2 * dp[a.length][b.length];
    }
  });

  D('non-negative-integers-without-consecutive-ones', {
    t: 'No Consecutive Ones: count by the highest differing bit',
    r: 'f[k] = binary strings of length k with no "11" (Fibonacci). Walk n\'s bits from the top: at each 1-bit at position k, add f[k] (put 0 there, anything valid below). Stop if two 1s are adjacent; otherwise count n itself.',
    g: R => ({ n: R.int(5, 60) }),
    s(I, T) {
      const f = [1, 2]; for (let i = 2; i < 32; i++) f.push(f[i - 1] + f[i - 2]);
      const bits = I.n.toString(2); let ans = 0, prev = '0', stop = false;
      for (let i = 0; i < bits.length && !stop; i++) if (bits[i] === '1') { const k = bits.length - 1 - i;
        T.at({ bits: A([...bits], { hl: [i] }), counted: ans }); T.n(`1-bit with ${k} bits below it: how many numbers to add?`, f[k], `f[${k}] strings of length ${k} without "11".`); ans += f[k]; if (prev === '1') stop = true; prev = '1'; } else prev = '0';
      return stop ? ans : ans + 1;
    }
  });

  D('k-inverse-pairs-array', {
    t: 'K Inverse Pairs Array: where the largest number goes',
    r: 'Placing n in an array of n−1 numbers creates 0..n−1 new inverse pairs (by how far from the end it sits). dp[n][k] = Σ dp[n−1][k−j] for j = 0..min(k, n−1).',
    g: R => ({ n: R.int(3, 4), k: R.int(1, 3) }),
    s(I, T) {
      const dp = mk(I.n + 1, I.k + 1, 0); dp[0][0] = 1;
      for (let i = 1; i <= I.n; i++) for (let k = 0; k <= I.k; k++) { let v = 0; for (let j = 0; j <= Math.min(k, i - 1); j++) v = (v + dp[i - 1][k - j]) % MOD;
        if (i >= 2) { T.at({ dp: G(dp, { rh: [...Array(I.n + 1).keys()].map(x => 'n=' + x), ch: [...Array(I.k + 1).keys()].map(x => 'k=' + x), hl: [[i, k]] }) }); T.n(`dp[${i}][${k}]?`, v, `Σ dp[${i - 1}][${k} − j] for j = 0..${Math.min(k, i - 1)}.`); }
        dp[i][k] = v; }
      return dp[I.n][I.k];
    }
  });

  D('find-the-derangement-of-an-array', {
    t: 'Derangements: where does element 1 go?',
    r: 'd(n) = (n − 1) · (d(n−1) + d(n−2)). Element 1 goes to one of n−1 spots; the displaced element either swaps back (d(n−2)) or does not (d(n−1)).',
    g: R => ({ n: R.int(4, 8) }),
    s(I, T) { if (I.n === 1) return 0; let a = 0, b = 1; for (let i = 3; i <= I.n; i++) { const c = (i - 1) * (a + b) % MOD; T.at({ 'd(i−2)': a, 'd(i−1)': b }); T.n(`d(${i})?`, c, `(${i} − 1)·(${b} + ${a}).`); [a, b] = [b, c]; } return b; }
  });

  D('decode-ways-ii', {
    t: 'Decode Ways II: count what a star can stand for',
    r: 'dp[i] = ways for the first i characters. One character: "*" gives 9 · dp[i−1], a nonzero digit 1 · dp[i−1]. Two characters: count valid pairs 10..26 (a star covers 1..9) times dp[i−2].',
    g: R => ({ s: R.str(R.int(3, 4), '12**3906') }),
    s(I, T) {
      const s = I.s, one = c => c === '*' ? 9 : c === '0' ? 0 : 1;
      const two = (a, b) => { if (a === '*' && b === '*') return 15; if (a === '*') return b <= '6' ? 2 : 1; if (b === '*') return a === '1' ? 9 : a === '2' ? 6 : 0; const v = +(a + b); return v >= 10 && v <= 26 ? 1 : 0; };
      let p2 = 1, p1 = one(s[0]);
      T.at({ s: A([...s], { hl: [0] }) }); T.n('Ways to decode the first character?', p1, `"${s[0]}" stands for ${one(s[0])} letter(s).`);
      for (let i = 1; i < s.length; i++) { const v = (one(s[i]) * p1 + two(s[i - 1], s[i]) * p2) % MOD;
        T.at({ s: A([...s], { hl: [i - 1, i] }), 'dp[i−1]': p1, 'dp[i−2]': p2 }); T.n(`Ways for the first ${i + 1} characters?`, v, `${one(s[i])}·${p1} + ${two(s[i - 1], s[i])}·${p2}.`); p2 = p1; p1 = v; }
      return p1;
    }
  });

  D('maximum-length-of-pair-chain', {
    t: 'Maximum Length of Pair Chain: sort by end, take greedily',
    r: 'Sort pairs by their right end. Take a pair whenever its left end is greater than the end of the last pair taken.',
    g: R => ({ pairs: Array.from({ length: R.int(5, 6) }, () => { const a = R.int(0, 10); return [a, a + R.int(1, 4)]; }) }),
    s(I, T) { const p = I.pairs.slice().sort((a, b) => a[1] - b[1]); let end = -Infinity, c = 0; p.forEach((x, i) => { T.at({ sorted: X(p.map(q => '[' + q + ']').join(' '), 'sorted by end'), 'last end': end, chain: c }); T.yn(`Take [${x}]?`, x[0] > end, x[0] > end ? `${x[0]} > last end ${end}.` : `${x[0]} ≤ last end ${end}: it would overlap.`); if (x[0] > end) { end = x[1]; c++; } }); return c; }
  });

  D('palindromic-substrings', {
    t: 'Palindromic Substrings: count while expanding each center',
    r: 'Each of the 2n − 1 centers (letters and gaps) expands while both ends match; every successful expansion is one more palindrome.',
    g: R => ({ s: R.str(R.int(5, 6), R.pick(['ab', 'aab', 'abc'])) }),
    s(I, T) { const s = I.s; let tot = 0; for (let c = 0; c < 2 * s.length - 1; c++) { let l = Math.floor(c / 2), r = l + c % 2, k = 0; while (l >= 0 && r < s.length && s[l] === s[r]) { k++; l--; r++; } T.at({ s: A([...s], { hl: c % 2 ? [Math.floor(c / 2), Math.floor(c / 2) + 1] : [c / 2] }), total: tot }); T.n(`Palindromes centered here?`, k, 'Count expansions while the ends match.'); tot += k; } return tot; }
  });

  D('2-keys-keyboard', {
    t: '2 Keys Keyboard: build i from a divisor',
    r: 'To reach i copies, reach some divisor d, Copy All once, then paste i/d − 1 times: dp[i] = min over d | i of dp[d] + i/d.',
    g: R => ({ n: R.int(6, 12) }),
    s(I, T) { const dp = [0, 0]; for (let i = 2; i <= I.n; i++) { let b = i, bd = 1; for (let d = 2; d < i; d++) if (i % d === 0 && dp[d] + i / d < b) { b = dp[d] + i / d; bd = d; } T.at({ dp: A(dp.concat('?')) }); T.n(`dp[${i}]?`, b, bd === 1 ? `Prime: copy once, paste ${i - 1} times = ${i}.` : `From ${bd}: dp[${bd}] + ${i / bd}.`); dp.push(b); } return dp[I.n]; }
  });
})();
