/* v2 games: dynamic programming (2). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const Q = v => v === undefined ? '?' : v;
  const tbl = (dp, o) => G(dp.map(r => r.map(Q)), o);
  const mk = (m, n, f) => Array.from({ length: m }, () => Array(n).fill(f));

  D('scramble-string', {
    t: 'Scramble String: try every split, kept or swapped',
    r: 'Same letters are required. Then for each split point k, either the two halves stay in order (s1[0 to k) ~ s2[0 to k)) or they were swapped (s1[0 to k) ~ the last k letters of s2). Recurse with memo.',
    g: R => { const s1 = [...R.shuffle([...'abcd'])].join('').slice(0, 4); const scr = s => { if (s.length < 2) return s; const k = R.int(1, s.length - 1), x = scr(s.slice(0, k)), y = scr(s.slice(k)); return R.chance(0.5) ? y + x : x + y; }; return { s1, s2: R.chance(0.65) ? scr(s1) : R.shuffle([...s1]).join('') }; },
    s(I, T) {
      const memo = new Map();
      const f = (a, b) => { const key = a + '|' + b; if (memo.has(key)) return memo.get(key); let r = false;
        if (a === b) r = true; else if ([...a].sort().join('') === [...b].sort().join('')) for (let k = 1; k < a.length && !r; k++) r = (f(a.slice(0, k), b.slice(0, k)) && f(a.slice(k), b.slice(k))) || (f(a.slice(0, k), b.slice(b.length - k)) && f(a.slice(k), b.slice(0, b.length - k)));
        memo.set(key, r); return r; };
      const { s1, s2 } = I, n = s1.length;
      T.at({ s1: A([...s1]), s2: A([...s2]) });
      const same = [...s1].sort().join('') === [...s2].sort().join('');
      T.yn('Do s1 and s2 use exactly the same letters?', same, 'Compare the letter counts.');
      if (same && s1 !== s2) for (let k = 1; k < n; k++) {
        const keep = f(s1.slice(0, k), s2.slice(0, k)) && f(s1.slice(k), s2.slice(k)), sw = f(s1.slice(0, k), s2.slice(n - k)) && f(s1.slice(k), s2.slice(0, n - k));
        T.at({ s1: A([...s1], { hl: Array.from({ length: k }, (_, i) => i) }), s2: A([...s2]) });
        T.c(`Split s1 after ${k} letters ("${s1.slice(0, k)}" | "${s1.slice(k)}"). Which case works?`, ['kept in order', 'swapped', 'neither'], keep ? 'kept in order' : sw ? 'swapped' : 'neither',
          `Kept: "${s1.slice(0, k)}"~"${s2.slice(0, k)}" and "${s1.slice(k)}"~"${s2.slice(k)}" is ${keep}. Swapped: "${s1.slice(0, k)}"~"${s2.slice(n - k)}" and "${s1.slice(k)}"~"${s2.slice(0, n - k)}" is ${sw}.`);
      }
      return f(s1, s2);
    }
  });

  D('interleaving-string', {
    t: 'Interleaving String: the next letter of s3 comes from s1 or s2',
    r: 'dp[i][j]: can s1[0 to i) and s2[0 to j) form s3[0 to i+j)? True if s1[i−1] == s3[i+j−1] and dp[i−1][j], or s2[j−1] == s3[i+j−1] and dp[i][j−1].',
    g: R => { const s1 = R.str(R.int(2, 3), 'ab'), s2 = R.str(R.int(2, 3), 'ab'); let i = 0, j = 0, s3 = ''; while (i < s1.length || j < s2.length) s3 += (j >= s2.length || (i < s1.length && R.chance(0.5))) ? s1[i++] : s2[j++]; if (R.chance(0.35)) { const k = R.int(0, s3.length - 1); s3 = s3.slice(0, k) + (s3[k] === 'a' ? 'b' : 'a') + s3.slice(k + 1); } return { s1, s2, s3 }; },
    s(I, T) {
      const { s1, s2, s3 } = I, m = s1.length, n = s2.length;
      if (m + n !== s3.length) return false;
      const dp = mk(m + 1, n + 1, undefined); const rh = ['ε', ...s1], ch = ['ε', ...s2];
      for (let i = 0; i <= m; i++) for (let j = 0; j <= n; j++) {
        let v; if (!i && !j) v = true; else v = (i > 0 && s1[i - 1] === s3[i + j - 1] && dp[i - 1][j]) || (j > 0 && s2[j - 1] === s3[i + j - 1] && dp[i][j - 1]);
        if (i && j) { T.at({ s3: A([...s3], { hl: [i + j - 1] }), dp: tbl(dp, { rh, ch, hl: [[i, j]] }) });
          T.yn(`dp[${i}][${j}]: next letter s3[${i + j - 1}] = "${s3[i + j - 1]}". Reachable?`, !!v, `From above: s1[${i - 1}]="${s1[i - 1]}" ${s1[i - 1] === s3[i + j - 1] ? 'equals' : 'does not equal'} "${s3[i + j - 1]}", dp[${i - 1}][${j}]=${dp[i - 1][j]}. From left: s2[${j - 1}]="${s2[j - 1]}" ${s2[j - 1] === s3[i + j - 1] ? 'equals' : 'does not equal'}, dp[${i}][${j - 1}]=${dp[i][j - 1]}.`); }
        dp[i][j] = !!v;
      }
      T.at({ dp: tbl(dp, { rh, ch, hl: [[m, n]] }) });
      return dp[m][n];
    }
  });

  D('distinct-subsequences', {
    t: 'Distinct Subsequences: use this letter or skip it',
    r: 'dp[i][j] = ways to form t[0 to j) from s[0 to i). Skipping s[i−1] always gives dp[i−1][j]; if s[i−1] == t[j−1], also add dp[i−1][j−1].',
    g: R => { const t = R.str(R.int(2, 3), 'ab'); return { s: R.str(R.int(5, 6), 'ab'), t }; },
    s(I, T) {
      const { s, t } = I, m = s.length, n = t.length, dp = mk(m + 1, n + 1, undefined);
      for (let i = 0; i <= m; i++) dp[i][0] = 1; for (let j = 1; j <= n; j++) dp[0][j] = 0;
      for (let i = 1; i <= m; i++) for (let j = 1; j <= n; j++) {
        const v = dp[i - 1][j] + (s[i - 1] === t[j - 1] ? dp[i - 1][j - 1] : 0);
        T.at({ dp: tbl(dp, { rh: ['ε', ...s], ch: ['ε', ...t], hl: [[i, j]] }) });
        T.n(`dp[${i}][${j}]: ways to make "${t.slice(0, j)}" from "${s.slice(0, i)}"?`, v, `Skip "${s[i - 1]}": ${dp[i - 1][j]}${s[i - 1] === t[j - 1] ? ' + use it: ' + dp[i - 1][j - 1] : ' (letters differ, cannot use it)'}.`);
        dp[i][j] = v;
      }
      return dp[m][n];
    }
  });

  D('pascals-triangle', {
    t: "Pascal's Triangle: each inside number is the sum of the two above",
    r: 'Rows start and end with 1. Every inside entry row[i][j] = row[i−1][j−1] + row[i−1][j].',
    g: R => ({ numRows: R.int(5, 6) }),
    s(I, T) {
      const rows = [];
      for (let i = 0; i < I.numRows; i++) { const row = [1];
        for (let j = 1; j < i; j++) { T.at({ above: A(rows[i - 1], { hl: [j - 1, j] }), row: A(row.concat(['?'])) }); T.n(`Row ${i}, entry ${j}?`, rows[i - 1][j - 1] + rows[i - 1][j], `${rows[i - 1][j - 1]} + ${rows[i - 1][j]}.`); row.push(rows[i - 1][j - 1] + rows[i - 1][j]); }
        if (i) row.push(1); rows.push(row); }
      return rows;
    }
  });

  D('pascals-triangle-ii', {
    t: "Pascal's Triangle II: update one row from right to left",
    r: 'Keep one array. For the next row, walk j from right to left: row[j] += row[j−1]. Going right to left means row[j−1] is still the old value.',
    g: R => ({ rowIndex: R.int(4, 5) }),
    s(I, T) {
      const row = [1];
      for (let i = 1; i <= I.rowIndex; i++) { row.push(1);
        for (let j = i - 1; j > 0; j--) { T.at({ row: A(row, { hl: [j - 1, j] }) }); T.n(`Building row ${i}: new row[${j}] = row[${j}] + row[${j - 1}] = ?`, row[j] + row[j - 1], `${row[j]} + ${row[j - 1]} (old values, since you move right to left).`); row[j] += row[j - 1]; } }
      return row;
    }
  });

  function stockK(I, T, k) {
    const p = I.prices, buy = Array(k + 1).fill(-Infinity), sell = Array(k + 1).fill(0);
    p.forEach((x, d) => {
      for (let t = 1; t <= k; t++) { buy[t] = Math.max(buy[t], sell[t - 1] - x); sell[t] = Math.max(sell[t], buy[t] + x); }
      T.at({ prices: A(p, { hl: [d] }), buy: A(buy.slice(1), { labels: buy.slice(1).map((_, i) => 't' + (i + 1)) }) });
      T.n(`Day ${d} (price ${x}). Best profit with at most ${k} sells so far (sell[${k}])?`, sell[k], `sell[t] = max(sell[t], buy[t] + price); buy[t] = max(buy[t], sell[t−1] − price).`);
    });
    return sell[k];
  }
  D('best-time-to-buy-and-sell-stock-iii', {
    t: 'Stock III: four states, buy1, then sell1, then buy2, then sell2',
    r: 'Track the best cash after each state: buy1 = max(buy1, −p), sell1 = max(sell1, buy1 + p), buy2 = max(buy2, sell1 − p), sell2 = max(sell2, buy2 + p).',
    g: R => ({ prices: R.ints(R.int(6, 7), 0, 9) }),
    s: (I, T) => stockK(I, T, 2)
  });
  D('best-time-to-buy-and-sell-stock-iv', {
    t: 'Stock IV: one buy or sell state pair per allowed transaction',
    r: 'For t = 1 to k: buy[t] = max(buy[t], sell[t−1] − p) and sell[t] = max(sell[t], buy[t] + p). The answer is sell[k].',
    g: R => ({ k: R.int(1, 3), prices: R.ints(6, 0, 9) }),
    s: (I, T) => stockK(I, T, I.k)
  });

  D('palindrome-partitioning-ii', {
    t: 'Palindrome Partitioning II: the last piece is a palindrome',
    r: 'cuts[i] = fewest cuts for s[0 to i]. If s[0 to i] is a palindrome, 0. Otherwise try every palindrome s[j to i] as the last piece: cuts[j−1] + 1.',
    g: R => ({ s: R.str(R.int(5, 7), R.pick(['ab', 'aab', 'abc'])) }),
    s(I, T) {
      const s = I.s, n = s.length, pal = (a, b) => { while (a < b) if (s[a++] !== s[b--]) return false; return true; }, cut = [];
      for (let i = 0; i < n; i++) { let best = Infinity, from = 0;
        for (let j = 0; j <= i; j++) if (pal(j, i)) { const c = j === 0 ? 0 : cut[j - 1] + 1; if (c < best) { best = c; from = j; } }
        T.at({ s: A([...s], { hl: [i] }), cuts: A(cut.concat('?')) });
        T.n(`cuts[${i}] for "${s.slice(0, i + 1)}"?`, best, from === 0 ? 'The whole prefix is a palindrome: 0 cuts.' : `Best last piece "${s.slice(from, i + 1)}": cuts[${from - 1}] + 1 = ${best}.`);
        cut.push(best); }
      return cut[n - 1];
    }
  });

  D('dungeon-game', {
    t: 'Dungeon Game: plan health backwards from the princess',
    r: 'need[i][j] = least health on entering (i,j). From the end: need = max(1, min(need below, need right) − dungeon[i][j]).',
    g: R => ({ dungeon: R.grid(R.int(2, 3), 3, -6, 4) }),
    s(I, T) {
      const d = I.dungeon, m = d.length, n = d[0].length, need = mk(m, n, undefined);
      for (let i = m - 1; i >= 0; i--) for (let j = n - 1; j >= 0; j--) {
        const nx = i === m - 1 && j === n - 1 ? 1 : Math.min(i + 1 < m ? need[i + 1][j] : Infinity, j + 1 < n ? need[i][j + 1] : Infinity);
        const v = Math.max(1, nx - d[i][j]);
        T.at({ dungeon: G(d, { hl: [[i, j]] }), need: tbl(need, { hl: [[i, j]] }) });
        T.n(`need[${i}][${j}] (room ${d[i][j]})?`, v, `max(1, ${nx} − (${d[i][j]})) = ${v}. ${i === m - 1 && j === n - 1 ? 'You must leave with at least 1.' : 'Take the cheaper of down or right.'}`);
        need[i][j] = v;
      }
      return need[0][0];
    }
  });

  D('number-of-digit-one', {
    t: 'Number of Digit One: count ones place by place',
    r: 'For each place value p (1, 10, 100, …): high = n divided by (10p), cur = (n divided by p) % 10, low = n % p. Ones there: high times p, plus p if cur > 1, plus low + 1 if cur == 1.',
    g: R => ({ n: R.int(10, 999) }),
    s(I, T) {
      const n = I.n; let total = 0;
      for (let p = 1; p <= n; p *= 10) {
        const high = Math.floor(n / (p * 10)), cur = Math.floor(n / p) % 10, low = n % p, c = high * p + (cur > 1 ? p : cur === 1 ? low + 1 : 0);
        T.at({ n, place: p, high, cur, low, total });
        T.n(`Ones in the ${p}s place?`, c, `${high} times ${p}${cur > 1 ? ' + ' + p + ' (cur > 1)' : cur === 1 ? ' + ' + (low + 1) + ' (cur == 1: low + 1)' : ' (cur == 0)'} = ${c}.`);
        total += c;
      }
      return total;
    }
  });

  D('different-ways-to-add-parentheses', {
    t: 'Different Ways to Add Parentheses: split at every operator',
    r: 'Each operator can be the last one applied. Compute all results of the left part and the right part, then combine every pair. Memoize by substring.',
    g: R => { const k = R.int(2, 3); let e = String(R.int(1, 9)); for (let i = 0; i < k; i++) e += R.pick(['+', '-', '*']) + R.int(1, 9); return { expression: e }; },
    s(I, T) {
      const memo = new Map();
      const f = e => { if (memo.has(e)) return memo.get(e); const out = [];
        for (let i = 0; i < e.length; i++) if ('+-*'.includes(e[i])) for (const a of f(e.slice(0, i))) for (const b of f(e.slice(i + 1))) out.push(e[i] === '+' ? a + b : e[i] === '-' ? a - b : a * b);
        if (!out.length) out.push(+e); memo.set(e, out); return out; };
      const e = I.expression, res = [];
      for (let i = 0; i < e.length; i++) if ('+-*'.includes(e[i])) {
        const L = f(e.slice(0, i)), Rr = f(e.slice(i + 1));
        T.at({ expression: A([...e], { hl: [i] }), left: A(L, { label: 'left results' }), right: A(Rr, { label: 'right results' }) });
        T.n(`Last operator "${e[i]}" at index ${i}: how many results does it contribute?`, L.length * Rr.length, `Every left result pairs with every right result: ${L.length} times ${Rr.length}.`);
        for (const a of L) for (const b of Rr) res.push(e[i] === '+' ? a + b : e[i] === '-' ? a - b : a * b);
      }
      return res.length ? res : [+e];
    },
    cmp: 'set'
  });

  const paint = (I, T, k) => {
    const c = I.costs, n = c.length, dp = [];
    for (let i = 0; i < n; i++) { const row = [];
      for (let j = 0; j < c[i].length; j++) { const prev = i ? Math.min(...dp[i - 1].filter((_, x) => x !== j)) : 0, v = c[i][j] + prev;
        T.at({ costs: G(c, { hl: [[i, j]] }), dp: tbl(dp.concat([row.concat(Array(c[i].length - row.length).fill(undefined))])) });
        T.n(`House ${i}, color ${j}: cheapest total?`, v, i ? `${c[i][j]} + the cheapest other color on house ${i - 1} (${prev}).` : `First house: just its cost ${c[i][j]}.`); row.push(v); }
      dp.push(row); }
    return Math.min(...dp[n - 1]);
  };
  D('paint-house', { t: 'Paint House: cheapest total ending in each color', r: 'dp[i][c] = costs[i][c] + the smaller of the other two colors at house i−1. The answer is the min of the last row.', g: R => ({ costs: R.grid(R.int(3, 4), 3, 1, 9) }), s: (I, T) => paint(I, T, 3) });
  D('paint-house-ii', { t: 'Paint House II: reuse the two smallest of the previous row', r: 'dp[i][c] = costs[i][c] + the smallest previous total with a different color. Keep the best and second best of the last row so each cell is O(1).', g: R => ({ costs: R.grid(3, R.int(3, 4), 1, 9) }), s: (I, T) => paint(I, T) });

  D('ugly-number-ii', {
    t: 'Ugly Number II: three pointers, take the smallest candidate',
    r: 'ugly[0] = 1. Pointers p2, p3, p5 point into the list. The next ugly number is min(2 times ugly[p2], 3 times ugly[p3], 5 times ugly[p5]); advance every pointer that produced it.',
    g: R => ({ n: R.int(8, 12) }),
    s(I, T) {
      const u = [1]; let a = 0, b = 0, c = 0;
      while (u.length < I.n) { const x = Math.min(2 * u[a], 3 * u[b], 5 * u[c]);
        T.at({ ugly: A(u, { p2: a, p3: b, p5: c }), candidates: `${2 * u[a]}, ${3 * u[b]}, ${5 * u[c]}` });
        T.n(`ugly[${u.length}]?`, x, `min(2 times ${u[a]}, 3 times ${u[b]}, 5 times ${u[c]}).`);
        u.push(x); if (x === 2 * u[a]) a++; if (x === 3 * u[b]) b++; if (x === 5 * u[c]) c++; }
      return u[I.n - 1];
    }
  });
  D('super-ugly-number', {
    t: 'Super Ugly Number: one pointer per prime',
    r: 'Like Ugly Number II with a pointer per prime: next = min over primes of prime times ugly[ptr]; advance every pointer that ties.',
    g: R => ({ n: R.int(7, 10), primes: R.pick([[2, 3, 7], [2, 5, 7], [3, 5, 7], [2, 7, 13]]) }),
    s(I, T) {
      const u = [1], ptr = I.primes.map(() => 0);
      while (u.length < I.n) { const cand = I.primes.map((p, i) => p * u[ptr[i]]), x = Math.min(...cand);
        T.at({ ugly: A(u), candidates: A(cand, { labels: I.primes.map(p => 'times ' + p) }) });
        T.n(`ugly[${u.length}]?`, x, `The smallest candidate: ${x}.`);
        u.push(x); cand.forEach((v, i) => { if (v === x) ptr[i]++; }); }
      return u[I.n - 1];
    }
  });

  D('paint-fence', {
    t: 'Paint Fence: end with a repeat or with a change',
    r: 'same[i] = diff[i−1] (repeat the last color once). diff[i] = (same[i−1] + diff[i−1]) times (k − 1). Total = same + diff.',
    g: R => ({ n: R.int(4, 5), k: R.int(2, 3) }),
    s(I, T) {
      const { n, k } = I; if (n === 1) return k; let same = 0, diff = k;
      for (let i = 1; i < n; i++) { const ns = diff, nd = (same + diff) * (k - 1);
        T.at({ post: i, same, diff }); T.n(`Post ${i}: ways ending in a repeat (same)?`, ns, `A repeat must follow a change: diff[${i - 1}] = ${diff}.`);
        T.n(`Post ${i}: ways ending in a change (diff)?`, nd, `(${same} + ${diff}) times (k − 1).`); same = ns; diff = nd; }
      return same + diff;
    }
  });

  D('best-time-to-buy-and-sell-stock-with-cooldown', {
    t: 'Stock with Cooldown: hold, just sold, or resting',
    r: 'hold = max(hold, rest − p); sold = hold_prev + p; rest = max(rest, sold_prev). You may only buy from rest, which forces the one-day cooldown.',
    g: R => ({ prices: R.ints(R.int(6, 7), 0, 9) }),
    s(I, T) {
      let hold = -Infinity, sold = 0, rest = 0;
      I.prices.forEach((p, d) => { const h = Math.max(hold, rest - p), s = hold + p, r = Math.max(rest, sold);
        T.at({ prices: A(I.prices, { hl: [d] }), hold, sold, rest });
        T.n(`Day ${d} (price ${p}): new sold = hold + price?`, s === -Infinity ? 0 : s, `${hold === -Infinity ? 'No share yet' : hold + ' + ' + p}.`);
        hold = h; sold = s; rest = r; });
      return Math.max(sold, rest, 0);
    }
  });

  D('burst-balloons', {
    t: 'Burst Balloons: choose the LAST balloon in each interval',
    r: 'Pad with 1s. dp[l][r] = best coins bursting everything strictly between l and r. Try each k as the last one: dp[l][k] + dp[k][r] + v[l] times v[k] times v[r].',
    g: R => ({ nums: R.ints(R.int(3, 4), 1, 8) }),
    s(I, T) {
      const v = [1, ...I.nums, 1], n = v.length, dp = mk(n, n, 0);
      for (let len = 2; len < n; len++) for (let l = 0; l + len < n; l++) { const r = l + len; let best = 0, bk = -1;
        for (let k = l + 1; k < r; k++) { const c = dp[l][k] + dp[k][r] + v[l] * v[k] * v[r]; if (c > best) { best = c; bk = k; } }
        T.at({ v: A(v, { l, r, hl: [bk] }) });
        T.n(`dp[${l}][${r}]: best coins for the balloons between ${l} and ${r}?`, best, `Best last balloon is index ${bk}: dp[${l}][${bk}] + dp[${bk}][${r}] + ${v[l]} times ${v[bk]} times ${v[r]} = ${best}.`);
        dp[l][r] = best; }
      return dp[0][n - 1];
    }
  });

  D('longest-increasing-path-in-a-matrix', {
    t: 'Longest Increasing Path: largest values first',
    r: 'Process cells from the largest value down. len[cell] = 1 + the best len among strictly larger neighbors (already final). The answer is the max len.',
    g: R => ({ matrix: R.grid(3, 3, 1, 9) }),
    s(I, T) {
      const M = I.matrix, m = M.length, n = M[0].length, len = mk(m, n, undefined), cells = [];
      for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) cells.push([i, j]);
      cells.sort((a, b) => M[b[0]][b[1]] - M[a[0]][a[1]]); let best = 0;
      for (const [i, j] of cells) { let b = 0;
        for (const [di, dj] of [[1, 0], [-1, 0], [0, 1], [0, -1]]) { const x = i + di, y = j + dj; if (x >= 0 && y >= 0 && x < m && y < n && M[x][y] > M[i][j]) b = Math.max(b, len[x][y]); }
        T.at({ matrix: G(M, { hl: [[i, j]] }), len: tbl(len, { hl: [[i, j]] }) });
        T.n(`len at (${i},${j}) = ${M[i][j]}?`, b + 1, `1 + the best larger neighbor (${b}).`); len[i][j] = b + 1; best = Math.max(best, b + 1); }
      return best;
    }
  });

  D('counting-bits', {
    t: 'Counting Bits: drop the last bit',
    r: 'ans[i] = ans[i >> 1] + (i & 1). Shifting right removes the last bit, whose count you already know.',
    g: R => ({ n: R.int(8, 12) }),
    s(I, T) { const a = [0]; for (let i = 1; i <= I.n; i++) { const v = a[i >> 1] + (i & 1); T.at({ ans: A(a.concat('?'), { hl: [i >> 1] }), i: i + ' = ' + i.toString(2) + 'b' }); T.n(`ans[${i}]?`, v, `ans[${i >> 1}] + ${i & 1} = ${v}.`); a.push(v); } return a; }
  });

  D('integer-break', {
    t: 'Integer Break: split off j, keep or break the rest',
    r: 'dp[i] = max over j of j times max(i − j, dp[i − j]). Each part is either kept whole or broken further.',
    g: R => ({ n: R.int(7, 10) }),
    s(I, T) { const dp = [0, 1]; for (let i = 2; i <= I.n; i++) { let b = 0, bj = 1; for (let j = 1; j < i; j++) { const c = j * Math.max(i - j, dp[i - j]); if (c > b) { b = c; bj = j; } } T.at({ dp: A(dp.concat('?')) }); T.n(`dp[${i}]?`, b, `Best split j = ${bj}: ${bj} times max(${i - bj}, dp[${i - bj}]) = ${b}.`); dp.push(b); } return dp[I.n]; }
  });

  D('russian-doll-envelopes', {
    t: 'Russian Doll Envelopes: sort, then LIS on heights',
    r: 'Sort by width ascending and, for equal widths, height descending (so two of the same width never nest). Then run patience LIS on heights: replace the first tail at least h, or append.',
    g: R => ({ envelopes: Array.from({ length: R.int(6, 7) }, () => [R.int(1, 6), R.int(1, 6)]) }),
    s(I, T) {
      const e = I.envelopes.slice().sort((a, b) => a[0] - b[0] || b[1] - a[1]), tails = [];
      T.at({ sorted: X(e.map(x => '[' + x + ']').join(' '), 'sorted (w asc, h desc)') });
      T.c('How must envelopes with equal width be ordered?', ['height ascending', 'height descending'], 'height descending', 'Ascending heights would let two envelopes of the same width chain in the LIS.');
      e.forEach(([w, h], i) => { let lo = 0, hi = tails.length; while (lo < hi) { const m = (lo + hi) >> 1; if (tails[m] < h) lo = m + 1; else hi = m; }
        T.at({ envelope: `[${w},${h}]`, tails: A(tails.length ? tails : []) });
        T.n(`Envelope [${w},${h}]: index in tails where height ${h} goes?`, lo, lo === tails.length ? 'Larger than every tail: append.' : `First tail at least ${h} is at ${lo}: replace it.`);
        tails[lo] = h; });
      return tails.length;
    }
  });

  D('count-numbers-with-unique-digits', {
    t: 'Count Numbers with Unique Digits: choices shrink digit by digit',
    r: 'Numbers with exactly k digits and no repeats: 9 times 9 times 8 times … (k factors). Add them up for k = 1 to n, plus 1 for zero.',
    g: R => ({ n: R.int(3, 5) }),
    s(I, T) { if (I.n === 0) return 1; let total = 10, cur = 9; T.at({ total }); for (let k = 2; k <= I.n; k++) { cur *= 11 - k; T.at({ digits: k, total }); T.n(`How many ${k}-digit numbers have unique digits?`, cur, `Previous count times (11 − ${k}) = ${cur}.`); total += cur; } return total; }
  });

  D('bomb-enemy', {
    t: 'Bomb Enemy: count until a wall in four directions',
    r: 'A bomb in an empty cell hits every enemy in its row and column until a wall. Reuse the row count until you pass a wall; same for each column.',
    g: R => ({ grid: R.cgrid(3, 4, ['0', '0', 'E', 'E', 'W']) }),
    s(I, T) {
      const g = I.grid, m = g.length, n = g[0].length; let best = 0;
      const kills = (i, j) => { let c = 0; for (const [di, dj] of [[1, 0], [-1, 0], [0, 1], [0, -1]]) { let x = i + di, y = j + dj; while (x >= 0 && y >= 0 && x < m && y < n && g[x][y] !== 'W') { if (g[x][y] === 'E') c++; x += di; y += dj; } } return c; };
      for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) if (g[i][j] === '0') { const k = kills(i, j); T.at({ grid: G(g, { hl: [[i, j]] }), best }); T.n(`Bomb at (${i},${j}) kills how many?`, k, 'Count enemies in all four directions until a wall.'); best = Math.max(best, k); }
      return best;
    }
  });

  D('largest-divisible-subset', {
    t: 'Largest Divisible Subset: sort, then extend chains',
    r: 'Sort. dp[i] = longest chain ending at nums[i] where each number divides the next: 1 + max dp[j] over j < i with nums[i] % nums[j] == 0. Follow parents back to rebuild it.',
    g: R => ({ nums: R.distinct(R.int(5, 6), 1, 24) }),
    s(I, T) {
      const a = I.nums.slice().sort((x, y) => x - y), dp = [], par = [];
      a.forEach((x, i) => { let b = 1, p = -1; for (let j = 0; j < i; j++) if (x % a[j] === 0 && dp[j] + 1 > b) { b = dp[j] + 1; p = j; }
        T.at({ sorted: A(a, { hl: [i] }), dp: A(dp.concat('?')) }); T.n(`dp[${i}] for ${x}?`, b, p < 0 ? 'Nothing before it divides it: 1.' : `${a[p]} divides ${x}: dp[${p}] + 1.`); dp.push(b); par.push(p); });
      let i = dp.indexOf(Math.max(...dp)); const out = []; while (i >= 0) { out.push(a[i]); i = par[i]; } return out.reverse();
    },
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && o.every(x => I.nums.includes(x)) && o.slice().sort((a, b) => a - b).every((x, i, s) => !i || x % s[i - 1] === 0)
  });
})();
