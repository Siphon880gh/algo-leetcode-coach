/* v2 games: backtracking (01). */
(function () {
  'use strict';
  const { D, A, G, K, S } = LCGame.H;
  const isPal = s => s === [...s].reverse().join('');
  const perms = a => a.length <= 1 ? [a] : a.flatMap((x, i) => perms([...a.slice(0, i), ...a.slice(i + 1)]).map(p => [x, ...p]));
  const abbrOk = (w, ab) => { let i = 0, j = 0; while (j < ab.length) { if (/\d/.test(ab[j])) { if (ab[j] === '0') return false; let k = 0; while (j < ab.length && /\d/.test(ab[j])) k = k * 10 + +ab[j++]; i += k; } else { if (w[i] !== ab[j]) return false; i++; j++; } } return i === w.length; };
  const abbrLen = ab => ab.replace(/\d+/g, '#').length;
  const abbrOf = (w, m) => { let out = '', run = 0; for (let i = 0; i < w.length; i++) { if (m >> i & 1) { if (run) { out += run; run = 0; } out += w[i]; } else run++; } return run ? out + run : out; };

  D('letter-combinations-of-a-phone-number', {
    t: 'Letter Combinations of a Phone Number',
    r: 'Backtrack digit by digit: for each letter mapped to the current digit, append it and recurse; a full-length path is one combination.',
    g: R => ({ digits: R.str(R.int(0, 3), '23456789') }),
    cmp: 'set',
    s(I, T) { const M = { 2: 'abc', 3: 'def', 4: 'ghi', 5: 'jkl', 6: 'mno', 7: 'pqrs', 8: 'tuv', 9: 'wxyz' }; if (!I.digits) { T.at({ digits: '""' }); T.n('Combinations?', 0, 'Empty input → empty list.'); return []; } let out = ['']; [...I.digits].forEach(d => { out = out.flatMap(p => [...M[d]].map(c => p + c)); T.at({ digit: d, letters: M[d] }); T.n('Combinations so far?', out.length, `Each extends by ${M[d].length} letters.`); }); return out; }
  });

  D('sudoku-solver', {
    t: 'Sudoku Solver',
    r: 'Find an empty cell, try digits 1–9 that do not clash with its row, column or 3×3 box, recurse, and undo on failure. Bitmasks per row/column/box make the checks O(1).',
    g: R => { const d = R.shuffle([1, 2, 3, 4, 5, 6, 7, 8, 9]), b = Array.from({ length: 9 }, (_, r) => Array.from({ length: 9 }, (_, c) => String(d[(r * 3 + Math.floor(r / 3) + c) % 9]))); for (let k = 0; k < R.int(3, 14); k++) b[R.int(0, 8)][R.int(0, 8)] = '.'; return { board: b }; },
    s(I, T) { const b = I.board.map(r => r.slice()), ok = (r, c, v) => { for (let i = 0; i < 9; i++) if (b[r][i] === v || b[i][c] === v || b[3 * Math.floor(r / 3) + Math.floor(i / 3)][3 * Math.floor(c / 3) + i % 3] === v) return false; return true; }; let asks = 0; const solve = () => { for (let r = 0; r < 9; r++) for (let c = 0; c < 9; c++) if (b[r][c] === '.') { const cand = [...'123456789'].filter(v => ok(r, c, v)); if (asks < 6 && cand.length === 1) { asks++; T.at({ board: G(b.map(x => x.slice()), { hl: [[r, c]] }) }); T.n(`Only digit that fits at (${r}, ${c})?`, +cand[0], 'Row, column and box rule out the rest.'); } for (const v of cand) { b[r][c] = v; if (solve()) return true; b[r][c] = '.'; } return false; } return true; }; solve(); if (!asks) { T.at({ board: G(b) }); T.n('Digits in the first row summed?', b[0].reduce((s, v) => s + +v, 0), 'Always 45 when solved.'); } return b; }
  });

  D('combination-sum-ii', {
    t: 'Combination Sum II',
    r: 'Sort. Backtrack from index i: skip equal values at the same depth (to avoid duplicate combinations), stop when the value exceeds the remainder, use each element once.',
    g: R => ({ candidates: R.ints(R.int(1, 7), 1, 6), target: R.int(1, 10) }),
    cmp: 'sets',
    s(I, T) { const a = I.candidates.slice().sort((x, y) => x - y), out = [], path = []; let asks = 0; const go = (i, rem) => { if (!rem) { out.push(path.slice()); if (asks++ < 5) { T.at({ path: S(path.slice()) }); T.n('Combinations found so far?', out.length, 'Remainder hit 0.'); } return; } for (let j = i; j < a.length && a[j] <= rem; j++) { if (j > i && a[j] === a[j - 1]) continue; path.push(a[j]); go(j + 1, rem - a[j]); path.pop(); } }; T.at({ sorted: A(a), target: I.target }); T.n('How many candidates are small enough to use at all?', a.filter(x => x <= I.target).length, 'A value above the target can never be part of a combination.'); go(0, I.target); if (!out.length) { T.at({ sorted: A(a), target: I.target }); T.n('Combinations?', 0, 'None reach the target.'); } T.n('Total distinct combinations?', out.length, 'Each path whose remainder hit 0.'); return out; }
  });

  D('permutations-ii', {
    t: 'Permutations II',
    r: 'Sort, then backtrack with a used[] array; skip nums[i] when it equals nums[i − 1] and nums[i − 1] is not used (so equal values are placed in a fixed order).',
    g: R => ({ nums: R.ints(R.int(1, 4), 1, 3) }),
    cmp: 'set',
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), used = Array(a.length).fill(false), out = [], path = []; const go = () => { if (path.length === a.length) { out.push(path.slice()); return; } for (let i = 0; i < a.length; i++) { const skip = used[i] || (i && a[i] === a[i - 1] && !used[i - 1]); if (!path.length) { T.at({ sorted: A(a, { hl: [i] }) }); T.yn(`Start a permutation with index ${i} (value ${a[i]})?`, !skip, 'Skip a value equal to the one before it when that one is unused.'); } if (skip) continue; used[i] = true; path.push(a[i]); go(); path.pop(); used[i] = false; } }; go(); T.at({ sorted: A(a), found: out.length }); T.n('Unique permutations?', out.length, 'n! / Π(count!)'); return out; }
  });

  D('n-queens-ii', {
    t: 'N-Queens II',
    r: 'Place queens row by row, tracking used columns and both diagonals (r − c, r + c) in sets; count complete placements.',
    g: R => ({ n: R.int(1, 7) }),
    s(I, T) { const n = I.n, cols = new Set(), d1 = new Set(), d2 = new Set(); let c = 0; const go = r => { if (r === n) { c++; return; } for (let x = 0; x < n; x++) { if (cols.has(x) || d1.has(r - x) || d2.has(r + x)) continue; cols.add(x); d1.add(r - x); d2.add(r + x); go(r + 1); cols.delete(x); d1.delete(r - x); d2.delete(r + x); } }; let first = 0; for (let x = 0; x < n; x++) { cols.add(x); d1.add(-x); d2.add(x); const before = c; go(1); cols.delete(x); d1.delete(-x); d2.delete(x); if (x < 4) { T.at({ n, firstQueenColumn: x }); T.n('Solutions with the first queen here?', c - before, 'Backtrack the remaining rows.'); } first++; } return c; }
  });

  D('combinations', {
    t: 'Combinations',
    r: 'Backtrack choosing increasing numbers: from start..n add a number and recurse until k are chosen (prune when not enough numbers remain).',
    g: R => { const n = R.int(1, 6); return { n, k: R.int(1, n) }; },
    cmp: 'set',
    s(I, T) { const out = [], path = []; const go = s => { if (path.length === I.k) { out.push(path.slice()); return; } for (let x = s; x <= I.n - (I.k - path.length) + 1; x++) { path.push(x); go(x + 1); path.pop(); } }; go(1); T.at({ n: I.n, k: I.k }); T.n('Largest number that can start a combination?', I.n - I.k + 1, 'Enough numbers must remain after it to finish.'); T.n('Combinations that start with 1?', out.filter(c => c[0] === 1).length, 'Choose the other k − 1 from 2 to n.'); T.n('How many combinations?', out.length, 'C(n, k).'); return out; }
  });

  D('subsets-ii', {
    t: 'Subsets II',
    r: 'Sort, then backtrack: every node is a subset; at each depth skip a value equal to the previous sibling to avoid duplicate subsets.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 3) }),
    cmp: 'sets',
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), out = [], path = []; const go = i => { out.push(path.slice()); for (let j = i; j < a.length; j++) { if (!path.length) { T.at({ sorted: A(a, { hl: [j] }) }); T.yn(`At the top level, use index ${j} (value ${a[j]})?`, !(j > i && a[j] === a[j - 1]), 'Skip a value equal to the previous sibling.'); } if (j > i && a[j] === a[j - 1]) continue; path.push(a[j]); go(j + 1); path.pop(); } }; go(0); const c = {}; a.forEach(x => c[x] = (c[x] || 0) + 1); T.at({ counts: K(c) }); T.n('How many distinct subsets?', out.length, 'Π(count + 1).'); return out; }
  });

  D('restore-ip-addresses', {
    t: 'Restore IP Addresses',
    r: 'Backtrack over 4 parts: each takes 1–3 digits, must be ≤ 255, and cannot have a leading zero unless it is "0". Accept when 4 parts consume the whole string.',
    g: R => ({ s: R.str(R.int(4, 9), '0125') }),
    cmp: 'set',
    s(I, T) { const out = [], parts = []; const go = i => { if (parts.length === 4) { if (i === I.s.length) out.push(parts.join('.')); return; } for (let L = 1; L <= 3 && i + L <= I.s.length; L++) { const p = I.s.substr(i, L); if ((p.length > 1 && p[0] === '0') || +p > 255) continue; parts.push(p); go(i + L); parts.pop(); } }; go(0); T.at({ s: I.s }); T.yn('Is the length between 4 and 12?', I.s.length >= 4 && I.s.length <= 12, 'Four parts of 1 to 3 digits each.'); T.n('How many lengths work for the first part?', [1, 2, 3].filter(L => L <= I.s.length && !(L > 1 && I.s[0] === '0') && +I.s.substr(0, L) <= 255).length, 'Up to 3 digits, at most 255, and no leading zero.'); T.n('Valid addresses?', out.length, 'Each part from 0 to 255, no leading zeros.'); return out; }
  });

  D('palindrome-partitioning', {
    t: 'Palindrome Partitioning',
    r: 'Backtrack over cut positions: from index i try every end j where s[i..j] is a palindrome (precompute a table), recurse from j + 1.',
    g: R => ({ s: R.str(R.int(1, 6), 'ab') }),
    cmp: 'set',
    s(I, T) { const out = [], path = []; let asks = 0; const go = i => { if (i === I.s.length) { out.push(path.slice()); return; } for (let j = i; j < I.s.length; j++) { const p = I.s.slice(i, j + 1); if (asks < 6 && i === 0) { asks++; T.at({ s: A([...I.s], { win: [i, j] }) }); T.yn(`Is "${p}" a palindrome?`, isPal(p), 'Only palindromic pieces may be cut.'); } if (!isPal(p)) continue; path.push(p); go(j + 1); path.pop(); } }; go(0); return out; }
  });

  D('combination-sum-iii', {
    t: 'Combination Sum III',
    r: 'Backtrack over digits 1–9 in increasing order, using each at most once; accept paths with k numbers summing to n.',
    g: R => ({ k: R.int(1, 4), n: R.int(1, 25) }),
    cmp: 'sets',
    s(I, T) { const out = [], path = []; const go = (s, rem) => { if (path.length === I.k) { if (!rem) out.push(path.slice()); return; } for (let d = s; d <= 9 && d <= rem; d++) { path.push(d); go(d + 1, rem - d); path.pop(); } }; go(1, I.n); T.at({ k: I.k, n: I.n }); T.n('Smallest sum k distinct digits can make?', I.k * (I.k + 1) / 2, '1 + 2 + … + k.'); T.n('Largest sum k distinct digits can make?', I.k * (19 - I.k) / 2, '9 + 8 + … down k digits.'); T.n('Combinations found?', out.length, 'Increasing digits, each once.'); return out; }
  });

  D('strobogrammatic-number-ii', {
    t: 'Strobogrammatic Number II',
    r: 'Build from the middle outward: length 0 → [""], length 1 → ["0","1","8"]; wrap each inner string with pairs 00, 11, 69, 88, 96 (no 00 on the outermost layer).',
    g: R => ({ n: R.int(1, 4) }),
    cmp: 'set',
    s(I, T) { const go = (m, top) => { if (m === 0) return ['']; if (m === 1) return ['0', '1', '8']; const inner = go(m - 2, false), out = []; for (const s of inner) for (const [a, b] of [['0', '0'], ['1', '1'], ['6', '9'], ['8', '8'], ['9', '6']]) if (!(top && a === '0')) out.push(a + s + b); T.at({ length: m, innerCount: inner.length }); T.n(`Strobogrammatic strings of length ${m}${top ? ' (no leading 0)' : ''}?`, out.length, 'Wrap each inner string with a pair.'); return out; }; T.at({ n: I.n }); T.n('How many middle choices does this length start from?', I.n % 2 ? 3 : 1, 'An odd length needs 0, 1 or 8 in the middle. An even length starts from the empty string.'); T.n('How many layers of pairs wrap the middle?', Math.floor(I.n / 2), 'Each layer adds two digits.'); return go(I.n, true); }
  });

  D('factor-combinations', {
    t: 'Factor Combinations',
    r: 'Backtrack with non-decreasing factors: for f from start while f·f ≤ n, if f divides n, record path + [f, n/f] and recurse on n/f starting at f.',
    g: R => ({ n: R.pick([1, 8, 12, 16, 24, 30, 32, 36, 37]) }),
    cmp: 'sets',
    s(I, T) { const out = []; const go = (n, s, path) => { for (let f = s; f * f <= n; f++) if (n % f === 0) { out.push([...path, f, n / f]); go(n / f, f, [...path, f]); } }; go(I.n, 2, []); T.at({ n: I.n }); let d0 = 0; for (let f = 2; f * f <= I.n; f++) if (I.n % f === 0) { d0 = f; break; } T.yn('Is there a factor f above 1 with f times f at most n?', d0 > 0, 'Without one, n has no factor combinations.'); if (d0) T.n(`Combinations that start with ${d0}?`, out.filter(c => c[0] === d0).length, 'The smallest factor leads the most combinations.'); T.n('Factor combinations?', out.length, 'Non-decreasing factors > 1.'); return out; }
  });

  D('palindrome-permutation-ii', {
    t: 'Palindrome Permutation II',
    r: 'If more than one letter has an odd count, there are none. Otherwise backtrack over permutations of half the letters (skipping duplicate choices) and mirror each around the odd letter.',
    g: R => ({ s: R.str(R.int(1, 6), 'abc') }),
    cmp: 'set',
    s(I, T) { const c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const odd = Object.keys(c).filter(k => c[k] % 2); T.at({ counts: K(c) }); T.n('Letters with odd count?', odd.length, 'At most one allowed.'); if (odd.length > 1) return []; const half = Object.keys(c).sort().flatMap(k => Array(c[k] >> 1).fill(k)), mid = odd[0] || '', out = new Set(); T.n('Letters in each half?', half.length, 'Half of every pair.'); perms(half).forEach(p => out.add(p.join('') + mid + p.slice().reverse().join(''))); T.n('Distinct palindromes?', out.size, 'One per distinct ordering of the half.'); return [...out]; }
  });

  D('expression-add-operators', {
    t: 'Expression Add Operators',
    r: 'Backtrack over the next operand (no leading zeros) with value so far and the last multiplied term: + adds it, − subtracts it, * replaces last by last·x (value − last + last·x).',
    g: R => ({ num: R.str(R.int(1, 5), '1203'), target: R.int(-3, 12) }),
    cmp: 'set',
    s(I, T) { const out = [], s = I.num; let asks = 0; const go = (i, expr, val, last) => { if (i === s.length) { if (val === I.target) { out.push(expr); if (asks++ < 4) { T.at({ expression: expr }); T.n('Expressions found so far?', out.length, `Evaluates to ${I.target}.`); } } return; } for (let j = i; j < s.length; j++) { if (j > i && s[i] === '0') break; const t = s.slice(i, j + 1), x = +t; if (i === 0) go(j + 1, t, x, x); else { go(j + 1, expr + '+' + t, val + x, x); go(j + 1, expr + '-' + t, val - x, -x); go(j + 1, expr + '*' + t, val - last + last * x, last * x); } } }; go(0, '', 0, 0); if (!out.length) { T.at({ num: s, target: I.target }); T.n('Expressions found?', 0, 'None hit the target.'); } return out; }
  });

  D('word-pattern-ii', {
    t: 'Word Pattern II',
    r: 'Backtrack: for each pattern letter, either use its existing mapping (must match the next chunk) or try every new chunk not already used by another letter.',
    g: R => { const p = R.str(R.int(1, 4), 'ab'), m = { a: R.str(R.int(1, 2), 'xy'), b: R.str(R.int(1, 2), 'xy') }; return { pattern: p, s: R.chance(0.7) ? [...p].map(c => m[c]).join('') : R.str(R.int(1, 6), 'xy') }; },
    s(I, T) { const map = {}, used = new Set(); const go = (i, j) => { if (i === I.pattern.length) return j === I.s.length; const c = I.pattern[i]; if (map[c]) return I.s.startsWith(map[c], j) && go(i + 1, j + map[c].length); for (let e = j + 1; e <= I.s.length; e++) { const w = I.s.slice(j, e); if (used.has(w)) continue; map[c] = w; used.add(w); if (go(i + 1, e)) return true; delete map[c]; used.delete(w); } return false; }; const ok = go(0, 0); T.at({ pattern: I.pattern, s: I.s, mapping: ok ? K({ ...map }) : 'none' }); T.n('Distinct letters in the pattern?', new Set(I.pattern).size, 'Each needs its own chunk of s.'); T.yn('Is s at least as long as the pattern?', I.s.length >= I.pattern.length, 'Every letter maps to at least one character.'); T.yn('Does a bijective mapping exist?', ok, 'Backtracking over chunk lengths.'); return ok; }
  });

  D('flip-game-ii', {
    t: 'Flip Game II',
    r: 'Memoized game search: a state is winning if some "++" → "--" flip leads to a losing state for the opponent.',
    g: R => ({ currentState: R.str(R.int(1, 8), '++-') }),
    s(I, T) { const memo = new Map(); const win = s => { if (memo.has(s)) return memo.get(s); let r = false; for (let i = 0; i + 1 < s.length && !r; i++) if (s[i] === '+' && s[i + 1] === '+' && !win(s.slice(0, i) + '--' + s.slice(i + 2))) r = true; memo.set(s, r); return r; }; const s = I.currentState; let asks = 0; for (let i = 0; i + 1 < s.length; i++) if (s[i] === '+' && s[i + 1] === '+' && asks++ < 4) { const nx = s.slice(0, i) + '--' + s.slice(i + 2); T.at({ state: s, afterFlip: nx }); T.yn('Does this flip leave the opponent losing?', !win(nx), 'Look for a move into a losing state.'); } if (!asks) { T.at({ state: s }); T.yn('Any move available?', false, 'No "++" → lose.'); } return win(s); }
  });

  D('remove-invalid-parentheses', {
    t: 'Remove Invalid Parentheses',
    r: 'BFS by number of removals: start with s; at each level remove one parenthesis from each string; the first level with any valid strings gives all answers (dedupe with a set).',
    g: R => ({ s: R.str(R.int(1, 7), '()a') }),
    cmp: 'set',
    s(I, T) { const valid = s => { let b = 0; for (const c of s) { if (c === '(') b++; else if (c === ')' && --b < 0) return false; } return b === 0; }; let lvl = new Set([I.s]), d = 0; for (;;) { const ok = [...lvl].filter(valid); T.at({ removals: d, candidates: lvl.size }); T.n('Valid strings at this level?', ok.length, 'BFS level = number of removals.'); if (ok.length) return ok; const nx = new Set(); for (const s of lvl) for (let i = 0; i < s.length; i++) if (s[i] === '(' || s[i] === ')') nx.add(s.slice(0, i) + s.slice(i + 1)); lvl = nx; d++; } }
  });

  D('additive-number', {
    t: 'Additive Number',
    r: 'Choose the first two numbers (no leading zeros); then the rest is forced: repeatedly check the string continues with their sum. Try all first/second splits.',
    g: R => { if (R.chance(0.5)) { let a = R.int(0, 9), b = R.int(0, 9), s = '' + a + b; for (let i = 0; i < R.int(1, 3); i++) { const c = a + b; s += c; a = b; b = c; } return { num: s }; } return { num: R.str(R.int(3, 8), '0123') }; },
    s(I, T) { const s = I.num, n = s.length; let asks = 0; for (let i = 1; i <= n / 2; i++) for (let j = 1; Math.max(i, j) <= n - i - j; j++) { if ((s[0] === '0' && i > 1) || (s[i] === '0' && j > 1)) continue; let a = BigInt(s.slice(0, i)), b = BigInt(s.slice(i, i + j)), k = i + j, ok = true; while (k < n) { const c = (a + b).toString(); if (!s.startsWith(c, k)) { ok = false; break; } k += c.length; a = b; b = BigInt(c); } if (asks++ < 4) { T.at({ num: s, first: s.slice(0, i), second: s.slice(i, i + j) }); T.yn('Does this start produce the whole string?', ok, 'Each next number is the sum of the previous two.'); } if (ok) return true; } return false; }
  });

  D('generalized-abbreviation', {
    t: 'Generalized Abbreviation',
    r: 'Each letter is kept or abbreviated (2^n masks). Backtrack carrying the current run of abbreviated letters; flush the count before a kept letter and at the end.',
    g: R => ({ word: R.str(R.int(1, 4), 'abc') }),
    cmp: 'set',
    s(I, T) { const n = I.word.length, out = []; for (let m = 0; m < 1 << n; m++) out.push(abbrOf(I.word, m)); T.at({ word: I.word }); T.n('How many abbreviations?', out.length, '2^n choices.'); T.at({ word: I.word, keep: 'first letter only' }); T.yn(`Is "${abbrOf(I.word, 1)}" one of them?`, true, 'Keep letter 0, abbreviate the rest.'); T.c('Abbreviation when every letter is abbreviated?', [String(I.word.length), I.word, '1'.repeat(I.word.length)], String(I.word.length), 'One run covers the whole word, so it becomes a single number.'); return out; }
  });

  D('android-unlock-patterns', {
    t: 'Android Unlock Patterns',
    r: 'DFS from each start key with a visited set; moving between two keys that have a key in between (e.g. 1→3 over 2) is allowed only if that middle key was visited. Use symmetry: corners × 4, edges × 4, center × 1.',
    g: R => { const m = R.int(1, 3); return { m, n: R.int(m, 4) }; },
    s(I, T) { const skip = {}; const set = (a, b, c) => { skip[a + ',' + b] = c; skip[b + ',' + a] = c; }; set(1, 3, 2); set(4, 6, 5); set(7, 9, 8); set(1, 7, 4); set(2, 8, 5); set(3, 9, 6); set(1, 9, 5); set(3, 7, 5); const vis = Array(10).fill(false); const dfs = (cur, len) => { if (len > I.n) return 0; let c = len >= I.m ? 1 : 0; vis[cur] = true; for (let nx = 1; nx <= 9; nx++) { if (vis[nx]) continue; const mid = skip[cur + ',' + nx]; if (mid && !vis[mid]) continue; c += dfs(nx, len + 1); } vis[cur] = false; return c; }; const corner = dfs(1, 1), edge = dfs(2, 1), center = dfs(5, 1); T.at({ m: I.m, n: I.n, start: 'corner key 1' }); T.n('Patterns starting at a corner?', corner, 'DFS with the skip-over rule.'); T.at({ m: I.m, n: I.n, start: 'center key 5' }); T.n('Patterns starting at the center?', center, 'Same DFS.'); T.at({ m: I.m, n: I.n, start: 'edge key 2' }); T.n('Patterns starting at an edge key?', edge, 'Same DFS from key 2.'); T.n('Total patterns?', 4 * corner + 4 * edge + center, 'Four corners, four edges and one center.'); return 4 * corner + 4 * edge + center; }
  });

  D('binary-watch', {
    t: 'Binary Watch',
    r: 'Enumerate hours 0–11 and minutes 0–59; keep times whose total set bits equals turnedOn, formatted h:mm.',
    g: R => ({ turnedOn: R.int(0, 9) }),
    cmp: 'set',
    s(I, T) { const pc = x => x.toString(2).split('').filter(c => c === '1').length, out = []; for (let h = 0; h < 12; h++) for (let m = 0; m < 60; m++) if (pc(h) + pc(m) === I.turnedOn) out.push(`${h}:${String(m).padStart(2, '0')}`); T.at({ turnedOn: I.turnedOn }); T.yn('Is turnedOn more than 8?', I.turnedOn > 8, 'At most 3 hour LEDs and 5 minute LEDs can be on at once.'); T.n('Times with hour 0?', out.filter(t => t.startsWith('0:')).length, 'Then every lit LED is a minute LED.'); T.n('How many times can the watch show?', out.length, 'Hour bits + minute bits = turnedOn.'); return out; }
  });

  D('minimum-unique-word-abbreviation', {
    t: 'Minimum Unique Word Abbreviation',
    r: 'Only dictionary words of the same length can conflict. Encode, for each such word, a mask of positions where it differs from target. An abbreviation (mask of kept letters) is unique iff it hits every difference mask. Search masks by increasing abbreviation length.',
    g: R => { const n = R.int(2, 5); return { target: R.str(n, 'ab'), dictionary: Array.from({ length: R.int(0, 3) }, () => R.str(R.chance(0.7) ? n : R.int(1, 5), 'ab')) }; },
    cmp: (o, e, I) => typeof o === 'string' && abbrOk(I.target, o) && abbrLen(o) === abbrLen(e) && !I.dictionary.some(w => w !== I.target && abbrOk(w, o)),
    s(I, T) { const n = I.target.length, diffs = I.dictionary.filter(w => w.length === n).map(w => [...w].reduce((m, c, i) => c !== I.target[i] ? m | 1 << i : m, 0)); T.at({ target: I.target, sameLength: A(I.dictionary.filter(w => w.length === n)) }); T.n('Dictionary words that could conflict?', diffs.length, 'Same length only.'); T.yn('Does the plain number (abbreviate every letter) work?', diffs.length === 0, 'It only works when no same-length word can conflict.'); let best = null, bl = Infinity; for (let m = 0; m < 1 << n; m++) { if (!diffs.every(d => d & m)) continue; const ab = abbrOf(I.target, m), L = abbrLen(ab); if (L < bl) { bl = L; best = ab; } } T.n('Length of the shortest unique abbreviation?', bl, 'Letters + number groups.'); return best; }
  });

  D('optimal-account-balancing', {
    t: 'Optimal Account Balancing',
    r: 'Compute each person\'s net balance and drop zeros. DFS: settle the first non-zero debt with each later opposite-sign balance, recurse, and take the minimum number of transactions.',
    g: R => ({ transactions: Array.from({ length: R.int(1, 5) }, () => { const a = R.int(0, 4); let b = R.int(0, 4); if (a === b) b = (a + 1) % 5; return [a, b, R.int(1, 10)]; }) }),
    s(I, T) { const bal = {}; I.transactions.forEach(([a, b, v]) => { bal[a] = (bal[a] || 0) - v; bal[b] = (bal[b] || 0) + v; }); const d = Object.values(bal).filter(x => x); T.at({ balances: K(bal) }); T.n('People with a non-zero balance?', d.length, 'Only they need transactions.'); const go = s => { while (s < d.length && !d[s]) s++; if (s === d.length) return 0; let best = Infinity; for (let i = s + 1; i < d.length; i++) if (d[i] * d[s] < 0) { d[i] += d[s]; best = Math.min(best, 1 + go(s + 1)); d[i] -= d[s]; } return best; }; T.n('Largest amount anyone is owed?', Math.max(0, ...d), 'The biggest positive balance.'); const r = go(0); T.n('Fewest transactions?', r, 'Settle each debt against an opposite balance and keep the best.'); return r; }
  });

  D('matchsticks-to-square', {
    t: 'Matchsticks to Square',
    r: 'Total must be divisible by 4. Sort descending and backtrack placing each stick on one of four sides without exceeding total/4 (skip sides with equal current length to avoid symmetric work).',
    g: R => { const a = R.ints(R.int(4, 8), 1, 5); if (R.chance(0.8)) { const r = a.reduce((x, y) => x + y, 0) % 4; if (r) a[a.length - 1] += 4 - r; } return { matchsticks: a }; },
    s(I, T) { const tot = I.matchsticks.reduce((a, b) => a + b, 0); T.at({ sticks: A(I.matchsticks), total: tot }); T.yn('Is the total divisible by 4?', tot % 4 === 0, 'Each side gets total/4.'); if (tot % 4 || I.matchsticks.length < 4) return false; const side = tot / 4, a = I.matchsticks.slice().sort((x, y) => y - x), s = [0, 0, 0, 0]; T.n('Length of each side?', side, 'total / 4.'); if (a[0] > side) return false; const go = i => { if (i === a.length) return true; const tried = new Set(); for (let k = 0; k < 4; k++) { if (s[k] + a[i] > side || tried.has(s[k])) continue; tried.add(s[k]); s[k] += a[i]; if (go(i + 1)) return true; s[k] -= a[i]; } return false; }; const r = go(0); T.yn('Can every stick be placed on a side?', r, 'Backtracking tries each stick on each side.'); return r; }
  });

  D('zuma-game', {
    t: 'Zuma Game',
    r: 'BFS over (board, remaining hand) states: insert each distinct hand ball at each position, collapse runs of ≥ 3 repeatedly, and return the depth when the board empties (−1 if never).',
    g: R => ({ board: R.str(R.int(1, 5), 'RGB'), hand: R.str(R.int(1, 3), 'RGB') }),
    s(I, T) { const collapse = b => { for (;;) { let i = 0, ch = false; while (i < b.length) { let j = i; while (j < b.length && b[j] === b[i]) j++; if (j - i >= 3) { b = b.slice(0, i) + b.slice(j); ch = true; break; } i = j; } if (!ch) return b; } }; const start = [I.board, [...I.hand].sort().join('')]; let fr = [start], seen = new Set([start.join('|')]), d = 0; while (fr.length) { if (fr.some(([b]) => !b)) return d; d++; const nf = []; for (const [b, h] of fr) for (let k = 0; k < h.length; k++) { if (k && h[k] === h[k - 1]) continue; const nh = h.slice(0, k) + h.slice(k + 1); for (let p = 0; p <= b.length; p++) { const nb = collapse(b.slice(0, p) + h[k] + b.slice(p)), key = nb + '|' + nh; if (!seen.has(key)) { seen.add(key); nf.push([nb, nh]); } } } fr = nf; if (d <= 3) { T.at({ step: d, states: fr.length }); T.yn('Can the board be cleared with this many balls?', fr.some(([b]) => !b), 'BFS level = balls used.'); } } return -1; }
  });

  D('robot-room-cleaner', {
    t: 'Robot Room Cleaner',
    r: 'DFS with relative coordinates and a visited set: at each cell clean, then try the 4 directions (turning right each time); after exploring a neighbor, back up (turn 180°, move, turn 180°). Every reachable open cell gets cleaned.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4), room = R.grid(m, n, 0, 1).map(r => r.map(v => R.chance(0.75) ? 1 : v)), r = R.int(0, m - 1), c = R.int(0, n - 1); room[r][c] = 1; return { room, row: r, col: c }; },
    s(I, T) { const m = I.room.length, n = I.room[0].length, seen = new Set([I.row + ',' + I.col]), st = [[I.row, I.col]]; while (st.length) { const [r, c] = st.pop(); for (const [dr, dc] of [[-1, 0], [0, 1], [1, 0], [0, -1]]) { const a = r + dr, b = c + dc; if (a >= 0 && b >= 0 && a < m && b < n && I.room[a][b] && !seen.has(a + ',' + b)) { seen.add(a + ',' + b); st.push([a, b]); } } } T.at({ room: G(I.room, { hl: [[I.row, I.col]] }) }); const open = I.room.flat().filter(v => v).length; T.n('Open cells in the room?', open, 'Count the 1s.'); T.n('How many cells will the robot clean?', seen.size, 'All open cells reachable from the start.'); T.n('Open cells the robot can never reach?', open - seen.size, 'Walls cut them off.'); return seen.size; }
  });

  D('non-decreasing-subsequences', {
    t: 'Non-decreasing Subsequences',
    r: 'Backtrack from index i: at each level use a set so the same value is not chosen twice as the next element; extend only with values ≥ the last. Record paths of length ≥ 2.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 4) }),
    cmp: 'set',
    s(I, T) { const out = [], path = []; const go = i => { if (path.length >= 2) out.push(path.slice()); const used = new Set(); for (let j = i; j < I.nums.length; j++) { const x = I.nums[j]; if (!path.length) { T.at({ nums: A(I.nums, { hl: [j] }) }); T.yn(`At the top level, start with index ${j} (value ${x})?`, !used.has(x), 'A value already used at this level would repeat the same subsequences.'); } if (used.has(x) || (path.length && x < path[path.length - 1])) continue; used.add(x); path.push(x); go(j + 1); path.pop(); } }; go(0); T.at({ nums: A(I.nums) }); T.n('How many distinct non-decreasing subsequences?', out.length, 'Length at least 2, with duplicates skipped at each level.'); return out; }
  });

  D('target-sum', {
    t: 'Target Sum',
    r: 'Let P be the + set: sum(P) = (total + target) / 2. Count subsets with that sum by 0/1 knapsack (or backtrack ± with memo).',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 4), target: R.int(-5, 5) }),
    s(I, T) { const tot = I.nums.reduce((a, b) => a + b, 0); T.at({ nums: A(I.nums), target: I.target, total: tot }); const ok = (tot + I.target) % 2 === 0 && Math.abs(I.target) <= tot; T.n('Total of nums?', tot, 'Add every number.'); T.yn('Is (total + target) even and reachable?', ok, 'Needed for a + set to exist.'); if (!ok) return 0; const P = (tot + I.target) / 2; T.n('Sum needed for the plus set?', P, '(total + target) / 2.'); const dp = Array(P + 1).fill(0); dp[0] = 1; for (const x of I.nums) for (let s = P; s >= x; s--) dp[s] += dp[s - x]; T.n(`Subsets summing to ${P}?`, dp[P], 'Each is one sign assignment.'); return dp[P]; }
  });

  D('beautiful-arrangement', {
    t: 'Beautiful Arrangement',
    r: 'Fill positions 1..n with unused numbers; place x at position i only if x % i == 0 or i % x == 0. Count complete placements (filling from the back prunes faster).',
    g: R => ({ n: R.int(1, 8) }),
    s(I, T) { const used = Array(I.n + 1).fill(false); const go = i => { if (i > I.n) return 1; let c = 0; for (let x = 1; x <= I.n; x++) if (!used[x] && (x % i === 0 || i % x === 0)) { used[x] = true; c += go(i + 1); used[x] = false; } return c; }; T.at({ n: I.n, position: I.n }); T.n(`Numbers allowed at position ${I.n}?`, [...Array(I.n).keys()].map(x => x + 1).filter(x => x % I.n === 0 || I.n % x === 0).length, 'x % i == 0 or i % x == 0.'); if (I.n > 1) { const p = I.n - 1; T.at({ n: I.n, position: p }); T.n(`Numbers allowed at position ${p}?`, [...Array(I.n).keys()].map(x => x + 1).filter(x => x % p === 0 || p % x === 0).length, 'x % i == 0 or i % x == 0.'); } const r = go(1); T.n('Beautiful arrangements?', r, 'Count every complete placement.'); return r; }
  });

  D('shopping-offers', {
    t: 'Shopping Offers',
    r: 'DFS with memo on the needs vector: either buy everything at list price, or apply any special that does not exceed needs and recurse. Take the cheapest.',
    g: R => { const k = R.int(1, 3), price = R.ints(k, 1, 6); return { price, special: Array.from({ length: R.int(1, 3) }, () => [...R.ints(k, 0, 2), R.int(1, 12)]), needs: R.ints(k, 0, 3) }; },
    s(I, T) { const memo = new Map(), k = I.price.length; const go = need => { const key = need.join(','); if (memo.has(key)) return memo.get(key); let best = need.reduce((s, q, i) => s + q * I.price[i], 0); for (const sp of I.special) { if (sp.slice(0, k).some((q, i) => q > need[i]) || sp.slice(0, k).every(q => q === 0)) continue; best = Math.min(best, sp[k] + go(need.map((q, i) => q - sp[i]))); } memo.set(key, best); return best; }; const list = I.needs.reduce((s, q, i) => s + q * I.price[i], 0); T.at({ needs: A(I.needs), price: A(I.price) }); T.n('Cost with no specials?', list, 'Add need times price for every item.'); T.n('Specials that fit within the needs?', I.special.filter(sp => !sp.slice(0, k).some((q, i) => q > I.needs[i]) && !sp.slice(0, k).every(q => q === 0)).length, 'A special that buys more than you need is not allowed.'); const r = go(I.needs); T.n('Lowest cost?', r, 'Best of list price and every special.'); return r; }
  });

  D('24-game', {
    t: '24 Game',
    r: 'Pick any two numbers, replace them with each result of +, −, ×, ÷ (both orders, skip ÷0), and recurse on the shorter list; succeed when one number ≈ 24.',
    g: R => ({ cards: R.ints(4, 1, 9) }),
    s(I, T) { const go = a => { if (a.length === 1) return Math.abs(a[0] - 24) < 1e-6; for (let i = 0; i < a.length; i++) for (let j = 0; j < a.length; j++) { if (i === j) continue; const rest = a.filter((_, k) => k !== i && k !== j), x = a[i], y = a[j], c = [x + y, x - y, x * y]; if (Math.abs(y) > 1e-9) c.push(x / y); for (const v of c) if (go([...rest, v])) return true; } return false; }; const r = go(I.cards); T.at({ cards: A(I.cards) }); const g2 = a => { if (a.length === 1) return Math.abs(a[0] - 24) < 1e-6; for (let i = 0; i < a.length; i++) for (let j = i + 1; j < a.length; j++) { const rest = a.filter((_, k) => k !== i && k !== j); if (g2([...rest, a[i] + a[j]]) || g2([...rest, a[i] * a[j]])) return true; } return false; }; T.yn('Does adding all four cards give 24?', I.cards.reduce((x, y) => x + y, 0) === 24, 'The simplest check first.'); T.yn('Can 24 be made using only addition and multiplication?', g2(I.cards), 'Try every pair with just those two operators.'); T.yn('Can these four cards make 24?', r, 'Try every pair and operator recursively.'); return r; }
  });

  D('partition-to-k-equal-sum-subsets', {
    t: 'Partition to K Equal Sum Subsets',
    r: 'total % k must be 0. Sort descending and fill buckets of size total/k by backtracking (skip buckets with equal current sums; fail fast if the largest element is too big).',
    g: R => { const a = R.ints(R.int(1, 7), 1, 6); return { nums: a, k: R.int(1, Math.min(4, a.length)) }; },
    s(I, T) { const tot = I.nums.reduce((a, b) => a + b, 0); T.at({ nums: A(I.nums), k: I.k }); T.yn('Is the total divisible by k?', tot % I.k === 0, 'Each bucket gets total/k.'); if (tot % I.k) return false; const t = tot / I.k, a = I.nums.slice().sort((x, y) => y - x), b = Array(I.k).fill(0); T.n('Target sum per bucket?', t, 'total / k.'); if (a[0] > t) return false; const go = i => { if (i === a.length) return true; const tried = new Set(); for (let j = 0; j < I.k; j++) { if (b[j] + a[i] > t || tried.has(b[j])) continue; tried.add(b[j]); b[j] += a[i]; if (go(i + 1)) return true; b[j] -= a[i]; } return false; }; const r = go(0); T.yn('Does every number fit into a bucket?', r, 'Backtracking places each number, largest first.'); return r; }
  });

  D('pyramid-transition-matrix', {
    t: 'Pyramid Transition Matrix',
    r: 'Map each pair to its allowed tops. Build the next row left to right by backtracking over choices; recurse upward with memoization on rows; success at a single block.',
    g: R => ({ bottom: R.str(R.int(2, 4), 'ABC'), allowed: [...new Set(Array.from({ length: R.int(2, 7) }, () => R.str(3, 'ABC')))] }),
    s(I, T) { const m = {}; I.allowed.forEach(s => (m[s.slice(0, 2)] = m[s.slice(0, 2)] || []).push(s[2])); const memo = new Map(); const solve = row => { if (row.length === 1) return true; if (memo.has(row)) return memo.get(row); const build = (i, cur) => { if (i === row.length - 1) return solve(cur); for (const c of m[row.slice(i, i + 2)] || []) if (build(i + 1, cur + c)) return true; return false; }; const r = build(0, ''); memo.set(row, r); return r; }; const pairs = [...Array(I.bottom.length - 1).keys()].map(i => I.bottom.slice(i, i + 2)); T.at({ bottom: I.bottom, allowed: A(I.allowed) }); T.n('Bottom pairs with no allowed top?', pairs.filter(p => !m[p]).length, 'Any such pair blocks the pyramid.'); T.n('Rows to build above the bottom?', I.bottom.length - 1, 'Each row is one block shorter.'); const r = solve(I.bottom); T.yn('Can the pyramid reach a single top block?', r, 'Backtracking over the allowed tops.'); return r; }
  });

  D('letter-case-permutation', {
    t: 'Letter Case Permutation',
    r: 'Backtrack over characters: digits stay, letters branch into lower and upper case. 2^(letters) results.',
    g: R => ({ s: R.str(R.int(1, 4), 'a1b2') }),
    cmp: 'set',
    s(I, T) { let out = ['']; for (const c of I.s) out = /[a-z]/i.test(c) ? out.flatMap(p => [p + c.toLowerCase(), p + c.toUpperCase()]) : out.map(p => p + c); const L = [...I.s].filter(c => /[a-z]/i.test(c)).length; T.at({ s: I.s }); T.n('How many letters (each doubles the count)?', L, '2^letters strings.'); T.n('How many results?', out.length, '2 to the power of the number of letters.'); T.n('Results whose first letter is upper case?', L ? out.length / 2 : 0, 'Half of them, if there is any letter.'); return out; }
  });

  D('split-array-into-fibonacci-sequence', {
    t: 'Split Array into Fibonacci Sequence',
    r: 'Backtrack: choose the next piece (no leading zeros, < 2^31); once two pieces exist, the next must equal the sum of the previous two. Accept when the string is consumed with ≥ 3 pieces.',
    g: R => { if (R.chance(0.6)) { let a = R.int(0, 9), b = R.int(0, 9), s = '' + a + b; for (let i = 0; i < R.int(1, 3); i++) { const c = a + b; s += c; a = b; b = c; } return { num: s }; } return { num: R.str(R.int(3, 7), '0112') }; },
    cmp: (o, e, I) => { if (!e.length) return Array.isArray(o) && !o.length; return Array.isArray(o) && o.length >= 3 && o.map(String).join('') === I.num && o.every(x => x < 2 ** 31) && o.every((x, i) => i < 2 || o[i - 2] + o[i - 1] === x); },
    s(I, T) { const s = I.num, path = []; let asks = 0; const go = i => { if (i === s.length) return path.length >= 3; for (let j = i; j < s.length; j++) { if (j > i && s[i] === '0') break; const x = +s.slice(i, j + 1); if (x >= 2 ** 31) break; const L = path.length; if (L >= 2 && x !== path[L - 1] + path[L - 2]) { if (x > path[L - 1] + path[L - 2]) break; continue; } path.push(x); if (asks++ < 5) { T.at({ num: s, pieces: S(path.slice()) }); T.n('Pieces so far?', path.length, 'Each after the second is the sum of the two before.'); } if (go(j + 1)) return true; path.pop(); } return false; }; return go(0) ? path : []; }
  });

  D('numbers-with-same-consecutive-differences', {
    t: 'Numbers With Same Consecutive Differences',
    r: 'Grow numbers digit by digit from 1–9: the next digit is last ± k (staying 0–9; only one branch when k = 0).',
    g: R => ({ n: R.int(2, 4), k: R.int(0, 9) }),
    cmp: 'set',
    s(I, T) { let cur = [1, 2, 3, 4, 5, 6, 7, 8, 9]; for (let L = 2; L <= I.n; L++) { cur = cur.flatMap(x => { const d = x % 10, nx = new Set([d + I.k, d - I.k].filter(v => v >= 0 && v <= 9)); return [...nx].map(v => x * 10 + v); }); T.at({ length: L, k: I.k }); T.n(`Valid numbers of length ${L}?`, cur.length, 'Extend each by last ± k.'); } return cur; }
  });

  D('unique-paths-iii', {
    t: 'Unique Paths III',
    r: 'Count empty cells (+ start). DFS from the start marking visited cells; reaching the end counts only if every non-obstacle cell was visited. Unmark on return.',
    g: R => { const m = R.int(1, 3), n = R.int(2, 4), g = R.grid(m, n, 0, 0).map(r => r.map(() => R.chance(0.15) ? -1 : 0)); const cells = R.shuffle([...Array(m * n).keys()]); g[Math.floor(cells[0] / n)][cells[0] % n] = 1; g[Math.floor(cells[1] / n)][cells[1] % n] = 2; return { grid: g }; },
    s(I, T) { const g = I.grid.map(r => r.slice()), m = g.length, n = g[0].length; let sr, sc, empty = 0; g.forEach((r, i) => r.forEach((v, j) => { if (v === 1) { sr = i; sc = j; } if (v !== -1) empty++; })); T.at({ grid: G(I.grid, { hl: [[sr, sc]] }) }); T.n('Cells every path must visit (including start and end)?', empty, 'All non-obstacles.'); T.n('Open cells next to the start?', [[1, 0], [-1, 0], [0, 1], [0, -1]].filter(([dr, dc]) => { const a = sr + dr, b = sc + dc; return a >= 0 && b >= 0 && a < m && b < n && g[a][b] !== -1; }).length, 'Each is a first move to explore.'); const go = (r, c, left) => { if (r < 0 || c < 0 || r >= m || c >= n || g[r][c] === -1) return 0; if (g[r][c] === 2) return left === 1 ? 1 : 0; const v = g[r][c]; g[r][c] = -1; const t = go(r + 1, c, left - 1) + go(r - 1, c, left - 1) + go(r, c + 1, left - 1) + go(r, c - 1, left - 1); g[r][c] = v; return t; }; const res = go(sr, sc, empty); T.n('Paths that visit every open cell?', res, 'Only paths reaching the end after covering everything count.'); return res; }
  });

  D('number-of-squareful-arrays', {
    t: 'Number of Squareful Arrays',
    r: 'Sort and backtrack like Permutations II (skip duplicate choices), extending only when last + next is a perfect square.',
    g: R => ({ nums: Array.from({ length: R.int(1, 5) }, () => R.pick([1, 3, 8, 17, 2, 7, 0])) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), used = Array(a.length).fill(false), sq = x => Number.isInteger(Math.sqrt(x)); let c = 0; const path = []; const go = () => { if (path.length === a.length) { c++; return; } for (let i = 0; i < a.length; i++) { if (used[i] || (i && a[i] === a[i - 1] && !used[i - 1])) continue; if (path.length && !sq(path[path.length - 1] + a[i])) continue; used[i] = true; path.push(a[i]); go(); path.pop(); used[i] = false; } }; go(); T.at({ sorted: A(a) }); T.n('Adjacent-square pairs available (i < j)?', a.reduce((s, x, i) => s + a.slice(i + 1).filter(y => sq(x + y)).length, 0), 'Edges of the "square sum" graph.'); T.n('Distinct values?', new Set(a).size, 'Equal values are placed in a fixed order.'); T.n('Squareful permutations?', c, 'Every complete path where each neighbouring pair sums to a square.'); return c; }
  });

  D('letter-tile-possibilities', {
    t: 'Letter Tile Possibilities',
    r: 'Backtrack on letter counts: for each letter with count > 0, use it (count one sequence), recurse, and restore. Counting by letter avoids duplicates.',
    g: R => ({ tiles: R.str(R.int(1, 5), 'AAB') }),
    s(I, T) { const c = {}; for (const ch of I.tiles) c[ch] = (c[ch] || 0) + 1; const go = () => { let t = 0; for (const k of Object.keys(c)) if (c[k]) { c[k]--; t += 1 + go(); c[k]++; } return t; }; T.at({ counts: K({ ...c }) }); T.n('Distinct one-letter sequences?', Object.keys(c).length, 'One per letter type.'); const ks = Object.keys(c); T.n('Distinct two-letter sequences?', ks.reduce((s, x) => s + ks.filter(y => y !== x || c[x] >= 2).length, 0), 'Two different letters, or the same letter if it has two tiles.'); const r = go(); T.n('All distinct non-empty sequences?', r, 'Use each letter count once per branch.'); return r; }
  });

  D('brace-expansion', {
    t: 'Brace Expansion',
    r: 'Parse into groups (sorted options inside braces, single letters otherwise) and take the cartesian product in order; output sorted.',
    g: R => ({ s: Array.from({ length: R.int(1, 3) }, () => R.chance(0.5) ? '{' + R.distinct(R.int(2, 3), 0, 3).map(i => 'abcd'[i]).join(',') + '}' : R.pick(['x', 'y'])).join('') }),
    s(I, T) { const groups = []; for (let i = 0; i < I.s.length; i++) { if (I.s[i] === '{') { const j = I.s.indexOf('}', i); groups.push(I.s.slice(i + 1, j).split(',').sort()); i = j; } else groups.push([I.s[i]]); } let out = ['']; groups.forEach((g, k) => { out = out.flatMap(p => g.map(c => p + c)); if (k < 4) { T.at({ group: A(g) }); T.n('Strings so far?', out.length, 'Multiply by the group size.'); } }); return out.sort(); }
  });
})();
