/* v2 games: dynamic programming (4). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const Q = v => v === undefined ? '?' : v;
  const tbl = (dp, o) => G(dp.map(r => r.map(Q)), o);
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));
  const MOD = 1e9 + 7;
  const r4 = x => Math.round(x * 1e4) / 1e4;

  D('4-keys-keyboard', {
    t: '4 Keys Keyboard: type, or finish with select-copy-paste runs',
    r: 'dp[i] = most A\'s with i presses: either dp[i−1] + 1 (press A), or for a break point j: dp[j] times (i − j − 1) (Ctrl-A, Ctrl-C at j, then i − j − 2 pastes).',
    g: R => ({ n: R.int(6, 10) }),
    s(I, T) { const dp = [0]; for (let i = 1; i <= I.n; i++) { let b = dp[i - 1] + 1, bj = -1; for (let j = 1; j <= i - 3; j++) if (dp[j] * (i - j - 1) > b) { b = dp[j] * (i - j - 1); bj = j; } T.at({ dp: A(dp.concat('?')) }); T.n(`dp[${i}]?`, b, bj < 0 ? 'Just press A once more.' : `Copy dp[${bj}] = ${dp[bj]} and paste ${i - bj - 2} times: ${dp[bj]} times ${i - bj - 1}.`); dp.push(b); } return dp[I.n]; }
  });

  D('coin-path', {
    t: 'Coin Path: cheapest cost to the end, ties to the smaller index',
    r: 'Work backwards: cost[i] = coins[i] + min cost[j] for j in i+1 to i+maxJump (skip −1 cells). Taking the first j on ties makes the path lexicographically smallest.',
    g: R => ({ coins: [R.int(0, 5), ...Array.from({ length: R.int(4, 6) }, () => R.chance(0.2) ? -1 : R.int(0, 5))], maxJump: R.int(1, 3) }),
    s(I, T) {
      const c = I.coins, n = c.length, cost = Array(n).fill(Infinity), nx = Array(n).fill(-1);
      if (c[n - 1] === -1) return []; cost[n - 1] = c[n - 1];
      for (let i = n - 2; i >= 0; i--) { if (c[i] === -1) continue;
        for (let j = i + 1; j <= Math.min(n - 1, i + I.maxJump); j++) if (cost[j] + c[i] < cost[i]) { cost[i] = cost[j] + c[i]; nx[i] = j; }
        T.at({ coins: A(c, { hl: [i] }), cost: A(cost.map(x => x === Infinity ? '∞' : x)) }); T.n(`cost[${i}] (type inf if unreachable)?`, cost[i], nx[i] < 0 ? 'No reachable cell within maxJump.' : `coins[${i}] + cost[${nx[i]}].`); }
      if (cost[0] === Infinity) return []; const p = []; for (let i = 0; i >= 0; i = nx[i]) p.push(i + 1); return p;
    }
  });

  D('strange-printer', {
    t: 'Strange Printer: let the last letter ride on an earlier equal print',
    r: 'dp[i][j] = turns to print s[i to j]. Start with dp[i][j−1] + 1. For every k with s[k] == s[j], the print of s[k] can extend to j: dp[i][k] + dp[k+1][j−1].',
    g: R => ({ s: R.str(R.int(4, 5), 'abc') }),
    s(I, T) {
      const s = I.s, n = s.length, dp = mk(n, n, 0); for (let i = 0; i < n; i++) dp[i][i] = 1;
      for (let len = 2; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1; let b = dp[i][j - 1] + 1;
        for (let k = i; k < j; k++) if (s[k] === s[j]) b = Math.min(b, dp[i][k] + (k + 1 <= j - 1 ? dp[k + 1][j - 1] : 0));
        T.at({ s: A([...s], { win: [i, j] }) }); T.n(`Turns for "${s.slice(i, j + 1)}"?`, b, 'Either one more turn for s[j], or merge s[j] into an earlier print of the same letter.'); dp[i][j] = b; }
      return dp[0][n - 1];
    }
  });

  D('number-of-longest-increasing-subsequence', {
    t: 'Number of LIS: track length and count together',
    r: 'For each i, look at every j < i with nums[j] < nums[i]: a longer len[j] + 1 replaces len[i] and takes cnt[j]; an equal one adds cnt[j].',
    g: R => ({ nums: R.ints(R.int(5, 6), 1, 6) }),
    s(I, T) {
      const a = I.nums, len = [], cnt = [];
      a.forEach((x, i) => { let L = 1, C = 1; for (let j = 0; j < i; j++) if (a[j] < x) { if (len[j] + 1 > L) { L = len[j] + 1; C = cnt[j]; } else if (len[j] + 1 === L) C += cnt[j]; }
        T.at({ nums: A(a, { hl: [i] }), len: A(len.concat('?')), cnt: A(cnt.concat('?')) }); T.n(`len[${i}]?`, L, 'Longest smaller predecessor + 1.'); len.push(L);
        T.at({ nums: A(a, { hl: [i] }), len: A(len), cnt: A(cnt.concat('?')) }); T.n(`cnt[${i}]?`, C, 'Sum cnt[j] over predecessors that reach that length.'); cnt.push(C); });
      const m = Math.max(...len); return a.reduce((s, _, i) => s + (len[i] === m ? cnt[i] : 0), 0);
    }
  });

  D('knight-probability-in-chessboard', {
    t: 'Knight Probability: count the paths that stay on the board',
    r: 'ways[r][c] = move sequences still on the board ending at (r,c). Each move sends every count to its 8 knight targets that are on the board. Probability = remaining ways divided by 8 to the power k.',
    g: R => { const n = R.int(3, 4); return { n, k: R.int(1, 3), row: R.int(0, n - 1), column: R.int(0, n - 1) }; },
    s(I, T) {
      const n = I.n, mv = [[1, 2], [2, 1], [-1, 2], [-2, 1], [1, -2], [2, -1], [-1, -2], [-2, -1]]; let w = mk(n, n, 0); w[I.row][I.column] = 1;
      for (let t = 1; t <= I.k; t++) { const nx = mk(n, n, 0); for (let r = 0; r < n; r++) for (let c = 0; c < n; c++) if (w[r][c]) for (const [dr, dc] of mv) { const x = r + dr, y = c + dc; if (x >= 0 && y >= 0 && x < n && y < n) nx[x][y] += w[r][c]; }
        const tot = nx.flat().reduce((a, b) => a + b, 0); T.at({ ways: G(w, { label: 'ways before move ' + t }) }); T.n(`Move ${t}: how many sequences are still on the board?`, tot, 'Push each count to the on-board knight targets.'); w = nx; }
      return w.flat().reduce((a, b) => a + b, 0) / Math.pow(8, I.k);
    }
  });

  D('maximum-sum-of-3-non-overlapping-subarrays', {
    t: 'Max Sum of 3 Non-Overlapping Subarrays: fix the middle window',
    r: 'Window sums W[i]. left[i] = best window start in 0 to i, right[i] = best in i to end. For each middle start j, total = W[left[j−k]] + W[j] + W[right[j+k]].',
    g: R => ({ nums: R.ints(R.int(7, 9), 1, 9), k: 2 }),
    s(I, T) {
      const a = I.nums, k = I.k, n = a.length, W = []; for (let i = 0; i + k <= n; i++) W.push(a.slice(i, i + k).reduce((x, y) => x + y, 0));
      const L = [], Rt = Array(W.length); L[0] = 0; for (let i = 1; i < W.length; i++) L[i] = W[i] > W[L[i - 1]] ? i : L[i - 1];
      Rt[W.length - 1] = W.length - 1; for (let i = W.length - 2; i >= 0; i--) Rt[i] = W[i] >= W[Rt[i + 1]] ? i : Rt[i + 1];
      let best = null, bs = -1;
      for (let j = k; j + k < W.length; j++) { const l = L[j - k], r = Rt[j + k], s = W[l] + W[j] + W[r];
        T.at({ W: A(W, { hl: [l, j, r] }), best: bs < 0 ? '-' : bs }); T.n(`Middle window at ${j}: total with the best left (${l}) and right (${r})?`, s, `${W[l]} + ${W[j]} + ${W[r]}.`); if (s > bs) { bs = s; best = [l, j, r]; } }
      return best;
    }
  });

  D('stickers-to-spell-word', {
    t: 'Stickers to Spell Word: always cover the first missing letter',
    r: 'Memoize on the letters still needed. Only try stickers that contain the first needed letter (some sticker must cover it); each one removes what it can, then recurse.',
    g: R => ({ stickers: Array.from({ length: R.int(2, 3) }, () => R.str(R.int(2, 4), 'abcde')), target: R.str(R.int(3, 5), 'abcde') }),
    s(I, T) {
      const memo = new Map(), sub = (t, st) => { const c = [...st]; let out = ''; for (const ch of t) { const k = c.indexOf(ch); if (k >= 0) c.splice(k, 1); else out += ch; } return out; };
      const f = t => { if (!t) return 0; if (memo.has(t)) return memo.get(t); let b = Infinity; for (const st of I.stickers) if (st.includes(t[0])) b = Math.min(b, 1 + f(sub(t, st))); memo.set(t, b); return b; };
      let t = [...I.target].sort().join(''); if (f(t) === Infinity) { T.at({ need: t }); T.yn('Can the target be spelled at all?', false, 'Some letter appears on no sticker.'); return -1; }
      while (t) { const opts = I.stickers.map((st, i) => [String(i), st]), ok = I.stickers.map((st, i) => st.includes(t[0]) && 1 + f(sub(t, st)) === f(t) ? String(i) : null).filter(x => x !== null);
        T.at({ need: A([...t], { hl: [0] }), stickers: A(I.stickers) }); T.k(`Still need "${t}". Which sticker next (an optimal choice)?`, opts, ok, `An optimal sticker covers "${t[0]}" and leaves a remainder needing ${f(t) - 1} more.`);
        t = sub(t, I.stickers[+ok[0]]); }
      return f([...I.target].sort().join(''));
    }
  });

  D('minimum-ascii-delete-sum-for-two-strings', {
    t: 'Minimum ASCII Delete Sum: pay for every letter you drop',
    r: 'dp[i][j] = cheapest deletions to equalize s1[0 to i) and s2[0 to j). Equal letters: dp[i−1][j−1]. Otherwise min(dp[i−1][j] + s1[i−1], dp[i][j−1] + s2[j−1]) in ASCII.',
    g: R => ({ s1: R.str(R.int(2, 3), 'abc'), s2: R.str(R.int(2, 3), 'abc') }),
    s(I, T) {
      const a = I.s1, b = I.s2, dp = mk(a.length + 1, b.length + 1, 0), c = x => x.charCodeAt(0);
      for (let i = 1; i <= a.length; i++) dp[i][0] = dp[i - 1][0] + c(a[i - 1]); for (let j = 1; j <= b.length; j++) dp[0][j] = dp[0][j - 1] + c(b[j - 1]);
      for (let i = 1; i <= a.length; i++) for (let j = 1; j <= b.length; j++) { const v = a[i - 1] === b[j - 1] ? dp[i - 1][j - 1] : Math.min(dp[i - 1][j] + c(a[i - 1]), dp[i][j - 1] + c(b[j - 1]));
        T.at({ dp: G(dp, { rh: ['ε', ...a], ch: ['ε', ...b], hl: [[i, j]] }), ascii: 'a=97 b=98 c=99' }); T.n(`dp[${i}][${j}]?`, v, a[i - 1] === b[j - 1] ? 'Letters match: copy the diagonal.' : `min(${dp[i - 1][j]} + ${c(a[i - 1])}, ${dp[i][j - 1]} + ${c(b[j - 1])}).`); dp[i][j] = v; }
      return dp[a.length][b.length];
    }
  });

  D('best-time-to-buy-and-sell-stock-with-transaction-fee', {
    t: 'Stock with Fee: pay the fee when you sell',
    r: 'cash = max(cash, hold + p − fee); hold = max(hold, cash − p). Two states, one pass.',
    g: R => ({ prices: R.ints(R.int(6, 7), 1, 9), fee: R.int(1, 3) }),
    s(I, T) { let cash = 0, hold = -I.prices[0]; I.prices.forEach((p, d) => { const c = Math.max(cash, hold + p - I.fee); T.at({ prices: A(I.prices, { hl: [d] }), cash, hold }); T.n(`Day ${d} (price ${p}): new cash?`, c, `max(${cash}, ${hold} + ${p} − ${I.fee}).`); hold = Math.max(hold, cash - p); cash = c; }); return cash; }
  });

  D('maximum-length-of-repeated-subarray', {
    t: 'Maximum Length of Repeated Subarray: extend the diagonal',
    r: 'dp[i][j] = length of the common run ending at nums1[i−1] and nums2[j−1]: diagonal + 1 if they are equal, else 0. Track the max.',
    g: R => ({ nums1: R.ints(4, 1, 3), nums2: R.ints(4, 1, 3) }),
    s(I, T) { const a = I.nums1, b = I.nums2, dp = mk(a.length + 1, b.length + 1, 0); let best = 0; for (let i = 1; i <= a.length; i++) for (let j = 1; j <= b.length; j++) { const v = a[i - 1] === b[j - 1] ? dp[i - 1][j - 1] + 1 : 0; T.at({ dp: G(dp, { rh: ['', ...a], ch: ['', ...b], hl: [[i, j]] }), best }); T.n(`dp[${i}][${j}]?`, v, a[i - 1] === b[j - 1] ? 'Equal: diagonal + 1.' : 'Different: 0.'); dp[i][j] = v; best = Math.max(best, v); } return best; }
  });

  D('minimum-window-subsequence', {
    t: 'Minimum Window Subsequence: match forward, then shrink backward',
    r: 'From each start, walk s1 forward matching s2 in order. When s2 is done at end e, walk backward from e matching s2 in reverse to find the tightest start. Keep the shortest window (earliest on ties).',
    g: R => ({ s1: R.str(R.int(7, 9), 'abcd'), s2: R.str(R.int(2, 3), 'abcd') }),
    s(I, T) {
      const s = I.s1, t = I.s2; let best = '', i = 0; T.at({ s1: A([...s]), s2: A([...t]) }); T.n('Length of s2?', t.length, 'Every window must contain s2 in order.'); T.yn('Does s1 contain s2 as a subsequence at all?', (() => { let j = 0; for (const c of s) if (c === t[j]) j++; return j === t.length; })(), 'If not, the answer is the empty string.');
      while (i < s.length) { let j = 0, k = i; while (k < s.length && j < t.length) { if (s[k] === t[j]) j++; k++; } if (j < t.length) break;
        let e = k - 1; j = t.length - 1; let st = e; while (j >= 0) { if (s[st] === t[j]) j--; st--; } st++;
        T.at({ s1: A([...s], { win: [st, e] }), s2: A([...t]), best: JSON.stringify(best) }); T.n(`Window found: length of the tightest window ending at ${e}?`, e - st + 1, `Backward match from ${e} lands on start ${st}.`);
        if (!best || e - st + 1 < best.length) best = s.slice(st, e + 1); i = st + 1; }
      T.at({ s1: A([...s]), best: JSON.stringify(best) }); T.n('Length of the shortest window? (0 if none)', best.length, 'The smallest of all tight windows, leftmost on ties.'); return best;
    }
  });

  D('count-different-palindromic-subsequences', {
    t: 'Count Different Palindromic Subsequences: handle equal ends carefully',
    r: 'If s[i] not equal to s[j]: dp[i+1][j] + dp[i][j−1] − dp[i+1][j−1]. If equal, find the next equal letters inside: none gives 2 times inner + 2; one gives 2 times inner + 1; two or more gives 2 times inner − dp between them.',
    g: R => ({ s: R.str(R.int(4, 5), 'ab') }),
    s(I, T) {
      const s = I.s, n = s.length, dp = mk(n + 1, n + 1, 0), g = (i, j) => i > j ? 0 : dp[i][j]; for (let i = 0; i < n; i++) dp[i][i] = 1;
      for (let len = 2; len <= n; len++) for (let i = 0; i + len <= n; i++) { const j = i + len - 1; let v, why;
        if (s[i] !== s[j]) { v = g(i + 1, j) + g(i, j - 1) - g(i + 1, j - 1); why = 'Ends differ: inclusion-exclusion.'; }
        else { let l = i + 1, r = j - 1; while (l <= r && s[l] !== s[i]) l++; while (l <= r && s[r] !== s[i]) r--; const inner = g(i + 1, j - 1);
          if (l > r) { v = 2 * inner + 2; why = 'No equal letter inside: wrap every inner one, plus "x" and "xx".'; } else if (l === r) { v = 2 * inner + 1; why = 'One equal letter inside: "x" is already counted.'; } else { v = 2 * inner - g(l + 1, r - 1); why = 'Two or more inside: subtract the ones counted twice.'; } }
        v = ((v % MOD) + MOD) % MOD; T.at({ s: A([...s], { win: [i, j] }) }); T.n(`Distinct palindromic subsequences of "${s.slice(i, j + 1)}"?`, v, why); dp[i][j] = v; }
      return dp[0][n - 1];
    }
  });

  D('delete-and-earn', {
    t: 'Delete and Earn: House Robber over values',
    r: 'Total points per value: pts[v] = v times count(v). Taking v forbids v−1 and v+1, so dp[v] = max(dp[v−1], dp[v−2] + pts[v]).',
    g: R => ({ nums: R.ints(R.int(5, 7), 1, 6) }),
    s(I, T) { const m = Math.max(...I.nums), pts = Array(m + 1).fill(0); I.nums.forEach(x => pts[x] += x); let a = 0, b = 0; for (let v = 1; v <= m; v++) { const c = Math.max(b, a + pts[v]); T.at({ points: A(pts, { hl: [v] }), 'dp[v−2]': a, 'dp[v−1]': b }); T.n(`dp[${v}]?`, c, `max(skip ${b}, take ${a} + ${pts[v]}).`); a = b; b = c; } return b; }
  });

  D('cherry-pickup', {
    t: 'Cherry Pickup: two walkers move together',
    r: 'Walk two paths from the top-left at the same time; after t steps each is on anti-diagonal t. dp[r1][r2] = most cherries; a shared cell counts once. Thorns (−1) kill a state.',
    g: R => ({ grid: (() => { const g = R.grid(3, 3, 0, 1); for (let i = 0; i < 2; i++) if (R.chance(0.5)) g[R.int(0, 2)][R.int(0, 2)] = -1; g[0][0] = Math.max(0, g[0][0]); g[2][2] = Math.max(0, g[2][2]); return g; })() }),
    s(I, T) {
      const g = I.grid, n = g.length; let dp = mk(n, n, -Infinity); dp[0][0] = g[0][0];
      for (let t = 1; t <= 2 * n - 2; t++) { const nx = mk(n, n, -Infinity);
        for (let r1 = 0; r1 < n; r1++) for (let r2 = 0; r2 < n; r2++) { const c1 = t - r1, c2 = t - r2; if (c1 < 0 || c2 < 0 || c1 >= n || c2 >= n || g[r1][c1] < 0 || g[r2][c2] < 0) continue;
          let b = -Infinity; for (const a of [r1, r1 - 1]) for (const c of [r2, r2 - 1]) if (a >= 0 && c >= 0) b = Math.max(b, dp[a][c]); if (b === -Infinity) continue;
          nx[r1][r2] = b + g[r1][c1] + (r1 !== r2 ? g[r2][c2] : 0); }
        dp = nx; const mx = Math.max(...dp.flat()); if (mx === -Infinity) { T.at({ grid: G(g), step: t }); T.yn(`After ${t} steps, can both walkers still be on open cells?`, false, 'Thorns block every state on this diagonal: the answer is 0.'); return 0; } T.at({ grid: G(g), step: t }); T.n(`After ${t} steps, the most cherries both walkers can hold?`, mx, 'Best over all (r1, r2) states on this diagonal.'); }
      return Math.max(0, dp[n - 1][n - 1]);
    }
  });

  D('number-of-corner-rectangles', {
    t: 'Number of Corner Rectangles: count column pairs per row pair',
    r: 'For each pair of rows, count columns where both are 1 (c of them). Any two such columns make a rectangle: c times (c−1) divided by 2.',
    g: R => ({ grid: R.grid(R.int(3, 4), 4, 0, 1) }),
    s(I, T) { const g = I.grid; let tot = 0; for (let a = 0; a < g.length; a++) for (let b = a + 1; b < g.length; b++) { const c = g[a].filter((x, j) => x && g[b][j]).length, v = c * (c - 1) / 2; T.at({ grid: G(g, { hl: g[a].map((_, j) => [a, j]).concat(g[b].map((_, j) => [b, j])) }), total: tot }); T.n(`Rows ${a} and ${b}: rectangles?`, v, `${c} shared columns: ${c} times ${c - 1} divided by 2.`); tot += v; } return tot; }
  });

  D('largest-plus-sign', {
    t: 'Largest Plus Sign: the shortest of four arms',
    r: 'For each cell, count consecutive 1s up, down, left and right including itself. The plus order there is the smallest of the four.',
    g: R => { const n = R.int(4, 5); return { n, mines: Array.from({ length: R.int(1, 4) }, () => [R.int(0, n - 1), R.int(0, n - 1)]).filter((m, i, a) => a.findIndex(x => x[0] === m[0] && x[1] === m[1]) === i) }; },
    s(I, T) {
      const n = I.n, g = mk(n, n, 1); I.mines.forEach(([x, y]) => g[x][y] = 0); let best = 0;
      const arm = (i, j, di, dj) => { let c = 0; while (i >= 0 && j >= 0 && i < n && j < n && g[i][j]) { c++; i += di; j += dj; } return c; };
      for (let i = 0; i < n; i++) for (let j = 0; j < n; j++) if (g[i][j]) { const o = Math.min(arm(i, j, 1, 0), arm(i, j, -1, 0), arm(i, j, 0, 1), arm(i, j, 0, -1)); if (o >= 2 || i === Math.floor(n / 2)) { T.at({ grid: G(g, { hl: [[i, j]] }), best }); T.n(`Plus order centered at (${i},${j})?`, o, 'The shortest of the four arms (counting the center).'); } best = Math.max(best, o); }
      return best;
    }
  });

  D('rotated-digits', {
    t: 'Rotated Digits: every digit valid, at least one changes',
    r: 'Digits 0, 1, 8 stay the same; 2, 5, 6, 9 change; 3, 4, 7 break the number. A number is good if all digits are valid and at least one changes.',
    g: R => ({ n: R.int(10, 30) }),
    s(I, T) { let c = 0; const start = Math.max(1, I.n - 13); for (let x = 1; x <= I.n; x++) { const s = String(x), ok = !/[347]/.test(s) && /[2569]/.test(s); if (x >= start) { T.at({ x, good: c }); T.yn(`Is ${x} good?`, ok, /[347]/.test(s) ? 'It has 3, 4 or 7, which cannot rotate.' : /[2569]/.test(s) ? 'All digits rotate and one changes.' : 'It rotates to itself.'); } if (ok) c++; } return c; }
  });

  D('domino-and-tromino-tiling', {
    t: 'Domino and Tromino Tiling: dp[n] = 2 times dp[n−1] + dp[n−3]',
    r: 'Counting full boards: dp[0] = 1, dp[1] = 1, dp[2] = 2, then dp[i] = 2 times dp[i−1] + dp[i−3] (from summing the partial-board states).',
    g: R => ({ n: R.int(4, 8) }),
    s(I, T) { const dp = [1, 1, 2]; for (let i = 3; i <= I.n; i++) { const v = (2 * dp[i - 1] + dp[i - 3]) % MOD; T.at({ dp: A(dp.concat('?')) }); T.n(`dp[${i}]?`, v, `2 times ${dp[i - 1]} + ${dp[i - 3]}.`); dp.push(v); } return dp[I.n]; }
  });

  D('champagne-tower', {
    t: 'Champagne Tower: overflow splits in half',
    r: 'Pour everything into the top glass. Any glass holding more than 1 keeps 1 and sends (x − 1) divided by 2 to each glass below it.',
    g: R => ({ poured: R.int(2, 9), query_row: R.int(1, 3), query_glass: 0 }),
    s(I, T) {
      let row = [I.poured];
      for (let r = 0; r < I.query_row; r++) { const nx = Array(row.length + 1).fill(0); row.forEach((x, i) => { const o = Math.max(0, x - 1) / 2; nx[i] += o; nx[i + 1] += o; });
        T.at({ row: A(row.map(r4), { label: 'row ' + r }) }); T.n(`Row ${r + 1}, glass 0 receives how much?`, nx[0], `(${r4(row[0])} − 1) divided by 2 if it overflows.`); row = nx; }
      return Math.min(1, row[I.query_glass]);
    }
  });

  D('minimum-swaps-to-make-sequences-increasing', {
    t: 'Minimum Swaps to Make Sequences Increasing: keep or swap each column',
    r: 'keep[i] and swap[i] = fewest swaps with column i unswapped or swapped. If both stay increasing in order, keep follows keep and swap follows swap. If they stay increasing crossed, keep follows swap and swap follows keep.',
    g: R => { const a = [], b = []; let x = 0, y = 0; for (let i = 0; i < 5; i++) { x += R.int(1, 3); y += R.int(1, 3); if (R.chance(0.4)) { a.push(y); b.push(x); } else { a.push(x); b.push(y); } } return { nums1: a, nums2: b }; },
    s(I, T) {
      const a = I.nums1, b = I.nums2; let keep = 0, sw = 1;
      for (let i = 1; i < a.length; i++) { let k = Infinity, s = Infinity;
        if (a[i - 1] < a[i] && b[i - 1] < b[i]) { k = Math.min(k, keep); s = Math.min(s, sw + 1); }
        if (a[i - 1] < b[i] && b[i - 1] < a[i]) { k = Math.min(k, sw); s = Math.min(s, keep + 1); }
        T.at({ nums1: A(a, { hl: [i - 1, i] }), nums2: A(b, { hl: [i - 1, i] }), keep, swap: sw }); T.n(`Column ${i}: fewest swaps if it is NOT swapped?`, k, 'Use whichever previous state keeps both rows increasing.'); keep = k; sw = s; }
      return Math.min(keep, sw);
    }
  });

  D('split-array-with-same-average', {
    t: 'Split Array With Same Average: a size-k subset with sum S times k divided by n',
    r: 'Both halves have the overall average, so some subset of size k (k from 1 to n divided by 2) must sum to S times k divided by n, which must be an integer. Build reachable sums by subset size.',
    g: R => ({ nums: R.ints(R.int(4, 6), 0, 9) }),
    s(I, T) {
      const a = I.nums, n = a.length, S = a.reduce((x, y) => x + y, 0), sums = Array.from({ length: n + 1 }, () => new Set()); sums[0].add(0);
      for (const x of a) for (let k = n - 1; k >= 0; k--) for (const s of sums[k]) sums[k + 1].add(s + x);
      let res = false;
      for (let k = 1; k <= Math.floor(n / 2); k++) { const ok = (S * k) % n === 0 && sums[k].has(S * k / n);
        T.at({ nums: A(a), total: S, k }); T.yn(`Is there a subset of size ${k} with sum ${S} times ${k} divided by ${n}${(S * k) % n ? ' (not an integer)' : ' = ' + S * k / n}?`, ok, (S * k) % n ? 'The target is not an integer.' : 'Check the reachable sums for size k.'); if (ok) res = true; }
      return res;
    }
  });

  D('soup-servings', {
    t: 'Soup Servings: recurse on servings of 25 mL',
    r: 'Work in units of 25 mL. f(a, b) = average of the four next states (a−4,b), (a−3,b−1), (a−2,b−2), (a−1,b−3). Both empty: 0.5. A empty first: 1. B empty first: 0. For large n the answer is about 1.',
    g: R => ({ n: R.pick([25, 50, 75, 100, 125]) }),
    s(I, T) {
      if (I.n > 4800) return 1; const N = Math.ceil(I.n / 25), memo = new Map();
      const f = (a, b) => { if (a <= 0 && b <= 0) return 0.5; if (a <= 0) return 1; if (b <= 0) return 0; const k = a + ',' + b; if (memo.has(k)) return memo.get(k); const v = 0.25 * (f(a - 4, b) + f(a - 3, b - 1) + f(a - 2, b - 2) + f(a - 1, b - 3)); memo.set(k, v); return v; };
      for (let u = 1; u <= N; u++) { T.at({ units: u }); T.n(`f(${u}, ${u}): probability answer with ${u * 25} mL of each?`, f(u, u), 'Average the four serving outcomes.'); }
      return f(N, N);
    }
  });

  D('largest-sum-of-averages', {
    t: 'Largest Sum of Averages: where does the last group start?',
    r: 'dp[g][i] = best score for the first i numbers in g groups = max over j of dp[g−1][j] + average(nums[j to i)). With more groups allowed, splitting never hurts.',
    g: R => ({ nums: R.ints(R.int(4, 5), 1, 9), k: R.int(2, 3) }),
    s(I, T) {
      const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); const avg = (j, i) => (P[i] - P[j]) / (i - j);
      let dp = Array.from({ length: n + 1 }, (_, i) => i ? avg(0, i) : 0); T.at({ nums: A(a), k: I.k }); T.n('Score with one group (average of everything, 4 decimals)?', r4(avg(0, n)), 'Sum divided by n.');
      for (let g = 2; g <= I.k; g++) { const nx = dp.slice();
        for (let i = g; i <= n; i++) { let b = -1, bj = 0; for (let j = g - 1; j < i; j++) { const v = dp[j] + avg(j, i); if (v > b + 1e-12) { b = v; bj = j; } }
          nx[i] = Math.max(b, dp[i]); if (i === n) { T.at({ nums: A(a, { win: [bj, i - 1] }), groups: g }); T.n(`With ${g} groups over all ${n} numbers, at which index does the best last group start?`, bj, `Last group starts at ${bj}: score ${r4(b)}.`); } }
        dp = nx; }
      T.at({ nums: A(a), k: I.k }); T.n('Largest score (4 decimals)?', r4(dp[n]), 'More groups never hurt, so use all k.'); return dp[n];
    }
  });

  D('binary-trees-with-factors', {
    t: 'Binary Trees With Factors: children multiply to the parent',
    r: 'Sort. dp[x] = 1 (a leaf) + the sum of dp[a] times dp[x divided by a] over factor pairs a times b = x with both in the array.',
    g: R => ({ arr: R.pick([[2, 4], [2, 4, 8], [2, 3, 6, 12], [2, 4, 5, 10], [2, 3, 4, 6, 12], [2, 4, 8, 16], [3, 9, 27]]) }),
    s(I, T) { const a = I.arr.slice().sort((x, y) => x - y), dp = new Map(); for (const x of a) { let v = 1; for (const y of a) if (x % y === 0 && dp.has(x / y)) v = (v + dp.get(y) * dp.get(x / y)) % MOD; T.at({ arr: A(a, { hl: [a.indexOf(x)] }), dp: Object.fromEntries(dp) }); T.n(`dp[${x}]?`, v, '1 + the sum of dp[a] times dp[x divided by a].'); dp.set(x, v); } return [...dp.values()].reduce((s, v) => (s + v) % MOD, 0); }
  });

  D('count-unique-characters-of-all-substrings-of-a-given-string', {
    t: 'Count Unique Characters of All Substrings: count by contribution',
    r: 'Letter s[i] is unique in every substring that starts after the previous same letter and ends before the next one: (i − prev) times (next − i).',
    g: R => ({ s: R.str(R.int(5, 7), 'ABC') }),
    s(I, T) { const s = I.s; let tot = 0; for (let i = 0; i < s.length; i++) { let p = i - 1, q = i + 1; while (p >= 0 && s[p] !== s[i]) p--; while (q < s.length && s[q] !== s[i]) q++; const c = (i - p) * (q - i); T.at({ s: A([...s], { hl: [i], win: [p + 1, q - 1] }), total: tot }); T.n(`Contribution of s[${i}] = "${s[i]}"?`, c, `(${i} − ${p}) times (${q} − ${i}).`); tot += c; } return tot; }
  });

  D('new-21-game', {
    t: 'New 21 Game: a sliding window of probabilities', cmp: 'float',
    r: 'P[x] = probability of ever having x points = (sum of P[x−maxPts to x−1] still drawing) divided by maxPts. Points at least k stop drawing. The answer is the sum of P[x] for x from k to n.',
    g: R => { const k = R.int(1, 3); return { n: k + R.int(0, 3), k, maxPts: R.int(2, 4) }; },
    s(I, T) {
      const { n, k, maxPts } = I; if (k === 0 || n >= k + maxPts) return 1; const P = [1]; let W = 1, res = 0;
      for (let x = 1; x <= n; x++) { P[x] = W / maxPts; T.at({ P: A(P.map(r4)), window: r4(W) }); if (x <= 6) T.n(`P[${x}]?`, P[x], `Window sum ${r4(W)} divided by ${maxPts}.`); if (x < k) W += P[x]; else res += P[x]; if (x - maxPts >= 0 && x - maxPts < k) W -= P[x - maxPts]; }
      return res;
    }
  });

  D('push-dominoes', {
    t: 'Push Dominoes: decide each gap by its two neighbors',
    r: 'Look at each run of "." with its bounding forces. L…L: all fall left. R…R: all fall right. R…L: they meet in the middle. L…R: they stay up.',
    g: R => ({ dominoes: R.str(R.int(8, 10), '..LR.') }),
    s(I, T) {
      const s = ('L' + I.dominoes + 'R').split(''), out = s.slice(); let i = 0;
      for (let j = 1; j < s.length; j++) if (s[j] !== '.') { const len = j - i - 1;
        if (len > 0) { const a = s[i], b = s[j], c = a === b ? (a === 'L' ? 'all fall left' : 'all fall right') : a === 'R' ? 'meet in the middle' : 'stay up';
          T.at({ dominoes: A(I.dominoes.split(''), { win: [i, j - 2] }) }); T.c(`Gap of ${len} between "${i === 0 ? 'wall(L)' : a}" and "${j === s.length - 1 ? 'wall(R)' : b}":`, ['all fall left', 'all fall right', 'meet in the middle', 'stay up'], c, 'Only the two forces around a gap decide it.');
          for (let k = i + 1; k < j; k++) out[k] = a === b ? a : a === 'R' ? (k - i < j - k ? 'R' : k - i > j - k ? 'L' : '.') : '.'; }
        i = j; }
      return out.slice(1, -1).join('');
    }
  });

  D('longest-mountain-in-array', {
    t: 'Longest Mountain: climb up, then down',
    r: 'up[i] = rising steps ending at i, down[i] = falling steps starting at i. A peak with both > 0 has a mountain of up + down + 1.',
    g: R => ({ arr: R.ints(R.int(8, 9), 0, 6) }),
    s(I, T) { const res = (() => { const a = I.arr, n = a.length, up = Array(n).fill(0), dn = Array(n).fill(0); for (let i = 1; i < n; i++) if (a[i] > a[i - 1]) up[i] = up[i - 1] + 1; for (let i = n - 2; i >= 0; i--) if (a[i] > a[i + 1]) dn[i] = dn[i + 1] + 1; T.at({ arr: A(a), up: A(up), down: A(dn) }); T.n('How many peaks (a rise before and a fall after)?', a.filter((_, i) => up[i] && dn[i]).length, 'Both counts must be positive.'); let best = 0; for (let i = 0; i < n; i++) if (up[i] && dn[i]) { T.at({ arr: A(a, { hl: [i] }), up: A(up), down: A(dn), best }); T.n(`Mountain length with peak at ${i}?`, up[i] + dn[i] + 1, `${up[i]} going up, ${dn[i]} going down, plus the peak.`); best = Math.max(best, up[i] + dn[i] + 1); } return best; })(); T.n('Longest mountain? (0 if none)', res, 'Best over all peaks.'); return res; }
  });

  D('minimum-number-of-refueling-stops', {
    t: 'Minimum Refueling Stops: refuel late, from the biggest station passed',
    r: 'Drive as far as the fuel allows, remembering every station passed in a max-heap. When stuck, refuel from the largest one passed (one stop). If the heap is empty, return −1.',
    g: R => { const target = R.int(20, 40); const st = []; let p = 0; while (st.length < 4) { p += R.int(3, 8); if (p >= target) break; st.push([p, R.int(3, 15)]); } return { target, startFuel: R.int(5, 12), stations: st }; },
    s(I, T) {
      let fuel = I.startFuel, stops = 0, i = 0; const heap = [];
      while (fuel < I.target) { while (i < I.stations.length && I.stations[i][0] <= fuel) heap.push(I.stations[i++][1]);
        if (!heap.length) { T.at({ reach: fuel, passed: A([]) }); T.yn('Stuck with no station passed. Can you still reach the target?', false, 'Nothing left to refuel from: −1.'); return -1; }
        heap.sort((a, b) => a - b); const big = heap[heap.length - 1];
        T.at({ reach: fuel, target: I.target, passed: A(heap), stops }); T.n(`You can reach ${fuel}. Refuel from which amount?`, big, 'The largest fuel among the stations passed.'); heap.pop(); fuel += big; stops++; }
      return stops;
    }
  });

  D('length-of-longest-fibonacci-subsequence', {
    t: 'Longest Fibonacci Subsequence: extend pairs (i, j) to k',
    r: 'dp[j][k] = length of the Fibonacci-like sequence ending with arr[j], arr[k]. If arr[k] − arr[j] = arr[i] for some i < j, dp[j][k] = dp[i][j] + 1 (pairs start at 2).',
    g: R => ({ arr: R.distinct(R.int(6, 7), 1, 14).sort((a, b) => a - b) }),
    s(I, T) {
      const a = I.arr, idx = new Map(a.map((x, i) => [x, i])), dp = new Map(); let best = 0;
      for (let k = 0; k < a.length; k++) for (let j = 0; j < k; j++) { const i = idx.get(a[k] - a[j]); if (i !== undefined && i < j) { const v = (dp.get(i * 100 + j) || 2) + 1; dp.set(j * 100 + k, v);
        T.at({ arr: A(a, { hl: [i, j, k] }), best }); T.n(`Length ending with ${a[j]}, ${a[k]}?`, v, `${a[i]} + ${a[j]} = ${a[k]}: extend the (${a[i]}, ${a[j]}) sequence.`); best = Math.max(best, v); } }
      return best;
    }
  });

  D('profitable-schemes', {
    t: 'Profitable Schemes: knapsack on members, profit capped at the minimum',
    r: 'dp[g][p] = schemes using g members with profit p (capped at minProfit). For each crime, go backwards over g and add dp[g − group][p − profit] into dp[g][min(p, ...)].',
    g: R => ({ n: R.int(3, 5), minProfit: R.int(1, 4), group: R.ints(3, 1, 3), profit: R.ints(3, 0, 4) }),
    s(I, T) {
      const P = I.minProfit, dp = mk(I.n + 1, P + 1, 0); dp[0][0] = 1;
      I.group.forEach((g, c) => { const pr = I.profit[c]; for (let m = I.n; m >= g; m--) for (let p = P; p >= 0; p--) { const to = Math.min(P, p + pr); dp[m][to] = (dp[m][to] + dp[m - g][p]) % MOD; }
        T.at({ crime: `#${c}: ${g} members, profit ${pr}`, dp: G(dp, { rh: dp.map((_, i) => 'm' + i), ch: dp[0].map((_, i) => i === P ? 'at least ' + i : 'p' + i) }) });
        T.n(`After crime #${c}: schemes reaching profit at least ${P}?`, dp.reduce((s, r) => (s + r[P]) % MOD, 0), 'Sum the last column.'); });
      return dp.reduce((s, r) => (s + r[P]) % MOD, 0);
    }
  });

  D('super-egg-drop', {
    t: 'Super Egg Drop: how many floors can m moves cover?',
    r: 'f[m][k] = floors you can fully test with m moves and k eggs = f[m−1][k−1] (egg breaks) + f[m−1][k] (survives) + 1. The answer is the first m with f[m][k] at least n.',
    g: R => ({ k: R.int(1, 3), n: R.int(4, 20) }),
    s(I, T) { let f = Array(I.k + 1).fill(0), m = 0; while (f[I.k] < I.n) { m++; const g = f.slice(); for (let e = 1; e <= I.k; e++) g[e] = f[e - 1] + f[e] + 1; T.at({ moves: m, 'f[m−1]': A(f, { labels: f.map((_, i) => i + ' eggs') }) }); T.n(`With ${m} moves and ${I.k} eggs, floors covered?`, g[I.k], `f[${m - 1}][${I.k - 1}] + f[${m - 1}][${I.k}] + 1.`); f = g; } return m; }
  });
})();
