/* v2 games: dynamic programming (1). See ../def.js for the D/T helpers. */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const dpView = (dp, rh, ch, hl) => G(dp.map(r => r.map(v => v === undefined ? '?' : v)), { rh, ch, hl: hl ? [hl] : [], label: 'dp' });
  const isPal = s => s === [...s].reverse().join('');

  D('longest-palindromic-substring', {
    t: 'Longest Palindromic Substring: expand around every center',
    r: 'Every palindrome has a center: a letter (odd length) or a gap between two letters (even length). Expand outward while both ends match; keep the longest.',
    g: R => ({ s: R.str(R.int(6, 8), R.pick(['ab', 'abc', 'aab'])) }),
    s(I, T) {
      const s = I.s; let best = s[0] || '';
      for (let c = 0; c < 2 * s.length - 1; c++) {
        let l = Math.floor(c / 2), r = l + (c % 2);
        while (l >= 0 && r < s.length && s[l] === s[r]) { l--; r++; }
        const len = r - l - 1;
        T.at({ s: A([...s], { hl: c % 2 ? [Math.floor(c / 2), Math.floor(c / 2) + 1] : [c / 2], ok: len ? Array.from({ length: len }, (_, k) => l + 1 + k) : [] }), best: JSON.stringify(best) });
        T.n(`Center ${c % 2 ? 'between ' + Math.floor(c / 2) + ' and ' + (Math.floor(c / 2) + 1) : 'at ' + c / 2}: length of the palindrome it grows?`, len, 'Expand while s[l] == s[r]; length = r − l − 1.');
        if (len > best.length) best = s.slice(l + 1, r);
      }
      return best;
    },
    cmp: (o, e, I) => typeof o === 'string' && o.length === e.length && isPal(o) && I.s.includes(o)
  });

  function regexGen(R, wild) {
    const s = R.str(R.int(2, 4), 'ab'); let p = '';
    for (const ch of s) {
      const o = ch === 'a' ? 'b' : 'a', x = R.int(0, 6);
      if (wild) p += [ch, '?', '*', ch + '*', o, '*' + ch, ch][x];
      else p += [ch, '.', ch + '*', o + '*' + ch, '.*', o, ch][x];
    }
    if (!wild) p = p.replace(/\*\*+/g, '*');
    return { s, p: p.length > 5 ? p.slice(0, p[4] === '*' || p[5] !== '*' ? 5 : 4) : p };
  }

  D('regular-expression-matching', {
    t: 'Regular Expression Matching: a star means zero copies or one more',
    r: 'dp[i][j]: does s[0 to i) match p[0 to j)? A letter or "." must match s[i−1] and inherit dp[i−1][j−1]. "x*" is either skipped (dp[i][j−2]) or eats one more matching letter (dp[i−1][j]).',
    g: R => regexGen(R, false),
    s(I, T) {
      const { s, p } = I, m = s.length, n = p.length, dp = Array.from({ length: m + 1 }, () => Array(n + 1).fill(undefined));
      const rh = ['ε', ...s], ch = ['ε', ...p], mt = (i, j) => p[j - 1] === '.' || p[j - 1] === s[i - 1];
      dp[0][0] = true;
      for (let j = 1; j <= n; j++) dp[0][j] = p[j - 1] === '*' && dp[0][j - 2];
      for (let i = 1; i <= m; i++) { dp[i][0] = false; for (let j = 1; j <= n; j++) {
        let v, why;
        if (p[j - 1] === '*') { v = dp[i][j - 2] || (mt(i, j - 1) && dp[i - 1][j]); why = `"${p[j - 2]}*": skip it, so dp[${i}][${j - 2}] = ${dp[i][j - 2]}; or eat s[${i - 1}]="${s[i - 1]}" (${mt(i, j - 1) ? 'matches' : 'no match'}): dp[${i - 1}][${j}] = ${dp[i - 1][j]}.`; }
        else { v = mt(i, j) && dp[i - 1][j - 1]; why = `"${p[j - 1]}" vs "${s[i - 1]}": ${mt(i, j) ? 'match, so copy dp[' + (i - 1) + '][' + (j - 1) + '] = ' + dp[i - 1][j - 1] : 'no match: false'}.`; }
        T.at({ dp: dpView(dp, rh, ch, [i, j]) });
        T.yn(`dp[${i}][${j}]: does "${s.slice(0, i)}" match "${p.slice(0, j)}"?`, v, why);
        dp[i][j] = v;
      } }
      T.at({ dp: dpView(dp, rh, ch, [m, n]) });
      return dp[m][n];
    }
  });

  D('wildcard-matching', {
    t: 'Wildcard Matching: "*" eats nothing or one more letter',
    r: 'dp[i][j]: does s[0 to i) match p[0 to j)? "?" or the same letter inherits dp[i−1][j−1]. "*" matches empty (dp[i][j−1]) or one more letter (dp[i−1][j]).',
    g: R => regexGen(R, true),
    s(I, T) {
      const { s, p } = I, m = s.length, n = p.length, dp = Array.from({ length: m + 1 }, () => Array(n + 1).fill(undefined));
      const rh = ['ε', ...s], ch = ['ε', ...p];
      dp[0][0] = true;
      for (let j = 1; j <= n; j++) dp[0][j] = p[j - 1] === '*' && dp[0][j - 1];
      for (let i = 1; i <= m; i++) { dp[i][0] = false; for (let j = 1; j <= n; j++) {
        let v, why;
        if (p[j - 1] === '*') { v = dp[i][j - 1] || dp[i - 1][j]; why = `"*" as empty: dp[${i}][${j - 1}] = ${dp[i][j - 1]}; or eat "${s[i - 1]}" using dp[${i - 1}][${j}] = ${dp[i - 1][j]}.`; }
        else { const ok = p[j - 1] === '?' || p[j - 1] === s[i - 1]; v = ok && dp[i - 1][j - 1]; why = ok ? `"${p[j - 1]}" matches "${s[i - 1]}", so copy dp[${i - 1}][${j - 1}] = ${dp[i - 1][j - 1]}.` : `"${p[j - 1]}" not equal to "${s[i - 1]}".`; }
        T.at({ dp: dpView(dp, rh, ch, [i, j]) });
        T.yn(`dp[${i}][${j}]: does "${s.slice(0, i)}" match "${p.slice(0, j)}"?`, v, why);
        dp[i][j] = v;
      } }
      T.at({ dp: dpView(dp, rh, ch, [m, n]) });
      return dp[m][n];
    }
  });
})();
