/* v2 games: backtracking (02). */
(function () {
  'use strict';
  const { D, A, G, K, S } = LCGame.H;
  const isPal = s => s === [...s].reverse().join('');
  const perms = a => a.length <= 1 ? [a] : a.flatMap((x, i) => perms([...a.slice(0, i), ...a.slice(i + 1)]).map(p => [x, ...p]));
  const gcd = (a, b) => b ? gcd(b, a % b) : a;
  const archScore = (bob, alice) => bob.reduce((s, b, k) => s + (b > alice[k] ? k : 0), 0);

  D('confusing-number-ii', {
    t: 'Confusing Number II',
    r: 'Build numbers from digits {0,1,6,8,9} by DFS (no leading zero) up to n; a number is confusing if its 180° rotation differs from itself. Count them.',
    g: R => ({ n: R.int(1, 200) }),
    s(I, T) { const rot = { 0: 0, 1: 1, 6: 9, 8: 8, 9: 6 }, isConf = x => { let y = 0, t = x; while (t) { y = y * 10 + rot[t % 10]; t = Math.floor(t / 10); } return y !== x; }; let c = 0, asks = 0; const go = x => { if (x > I.n) return; if (x && isConf(x)) { c++; if (asks++ < 5) { T.at({ number: x }); T.n('Confusing numbers found so far?', c, 'Rotation differs.'); } } for (const d of [0, 1, 6, 8, 9]) { if (!x && !d) continue; const y = x * 10 + d; if (y <= I.n) go(y); } }; go(0); if (!asks) { T.at({ n: I.n }); T.n('Confusing numbers at most n?', 0, 'None yet (6 is the first).'); } return c; }
  });

  D('brace-expansion-ii', {
    t: 'Brace Expansion II',
    r: 'Recursive descent: an expression is a comma-separated union of terms; a term is a concatenation (cartesian product) of factors; a factor is a letter or a braced expression. Return the sorted set.',
    g: R => { const f = d => d > 1 || R.chance(0.5) ? R.pick(['a', 'b', 'c']) : '{' + Array.from({ length: R.int(2, 3) }, () => Array.from({ length: R.int(1, 2) }, () => f(d + 1)).join('')).join(',') + '}'; return { expression: Array.from({ length: R.int(1, 3) }, () => f(0)).join('') }; },
    s(I, T) { const s = I.expression; let i = 0; const expr = () => { const res = new Set(); for (;;) { term().forEach(x => res.add(x)); if (s[i] === ',') { i++; continue; } return res; } }; const term = () => { let cur = new Set(['']); while (i < s.length && s[i] !== ',' && s[i] !== '}') { let f; if (s[i] === '{') { i++; f = expr(); i++; } else f = new Set([s[i++]]); const nx = new Set(); cur.forEach(a => f.forEach(b => nx.add(a + b))); cur = nx; } return cur; }; const out = [...expr()].sort(); T.at({ expression: s }); let dep = 0, parts = 1; for (const ch of s) { if (ch === '{') dep++; else if (ch === '}') dep--; else if (ch === ',' && !dep) parts++; } T.n('Comma-separated parts at the top level?', parts, 'Commas inside braces belong to inner expressions.'); T.n('Distinct words?', out.length, 'Union of products.'); T.c('First word in sorted order?', [out[0], out[out.length - 1], out[0] + out[0]], out[0], 'The result set is sorted.'); return out; }
  });

  D('path-with-maximum-gold', {
    t: 'Path with Maximum Gold',
    r: 'From every gold cell, DFS collecting gold, marking the cell 0 while on the path and restoring on return. Track the best total.',
    g: R => ({ grid: R.grid(R.int(1, 3), R.int(1, 4), 0, 9).map(r => r.map(v => R.chance(0.25) ? 0 : v)) }),
    s(I, T) { const g = I.grid.map(r => r.slice()), m = g.length, n = g[0].length; const dfs = (r, c) => { if (r < 0 || c < 0 || r >= m || c >= n || !g[r][c]) return 0; const v = g[r][c]; g[r][c] = 0; const best = Math.max(dfs(r + 1, c), dfs(r - 1, c), dfs(r, c + 1), dfs(r, c - 1)); g[r][c] = v; return v + best; }; let best = 0, asks = 0; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (g[r][c]) { const v = dfs(r, c); best = Math.max(best, v); if (asks++ < 4) { T.at({ grid: G(I.grid, { hl: [[r, c]] }) }); T.n('Most gold starting here?', v, 'Backtracking DFS.'); } } return best; }
  });

  D('maximum-length-of-a-concatenated-string-with-unique-characters', {
    t: 'Maximum Length of a Concatenated String with Unique Characters',
    r: 'Drop strings with repeated letters; convert the rest to bitmasks. Backtrack over include or exclude, including a string only if its mask does not overlap the current mask.',
    g: R => ({ arr: Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 3), 'abcdef')) }),
    s(I, T) { const ms = I.arr.filter(w => new Set(w).size === w.length).map(w => [...w].reduce((m, c) => m | 1 << (c.charCodeAt(0) - 97), 0)); T.at({ arr: A(I.arr) }); T.n('Strings usable on their own (no repeated letter)?', ms.length, 'Others are skipped.'); const pc = x => x.toString(2).split('').filter(b => b === '1').length; const go = (i, m) => i === ms.length ? pc(m) : Math.max(go(i + 1, m), ms[i] & m ? 0 : go(i + 1, m | ms[i])); T.n('Length of the longest usable string on its own?', Math.max(0, ...ms.map(pc)), 'A starting point for the search.'); const r = go(0, 0); T.n('Longest concatenation with all letters unique?', r, 'Take or skip each usable string.'); return r; }
  });

  D('tiling-a-rectangle-with-the-fewest-squares', {
    t: 'Tiling a Rectangle with the Fewest Squares',
    r: 'Skyline backtracking: keep column heights; always fill the lowest, leftmost gap with the largest square that fits, trying smaller ones on backtrack; prune when the count reaches the best found.',
    g: R => ({ n: R.int(1, 6), m: R.int(1, 6) }),
    s(I, T) { const W = I.m, H = I.n, h = Array(W).fill(0); let best = W * H; const go = cnt => { if (cnt >= best) return; let mn = Infinity, pos = -1; for (let i = 0; i < W; i++) if (h[i] < mn) { mn = h[i]; pos = i; } if (mn === H) { best = cnt; return; } let e = pos; while (e < W && h[e] === mn) e++; const maxS = Math.min(e - pos, H - mn); for (let sz = maxS; sz >= 1; sz--) { for (let i = pos; i < pos + sz; i++) h[i] += sz; go(cnt + 1); for (let i = pos; i < pos + sz; i++) h[i] -= sz; } }; go(0); T.at({ rectangle: `${I.n} by ${I.m}` }); T.n('Largest square that fits first?', Math.min(I.n, I.m), 'Try big squares first.'); T.yn('Is the rectangle already a square?', I.n === I.m, 'Then one tile is enough.'); T.n('Fewest squares?', best, 'Best count found by the skyline search.'); return best; }
  });

  D('maximum-score-words-formed-by-letters', {
    t: 'Maximum Score Words Formed by Letters',
    r: 'Backtrack over words (take or skip); take a word only if the remaining letter counts allow it, subtracting its letters and adding its score.',
    g: R => ({ words: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 3), 'abcd')), letters: [...R.str(R.int(1, 8), 'abcd')], score: [...R.ints(4, 0, 5), ...Array(22).fill(0)] }),
    s(I, T) { const c = Array(26).fill(0); I.letters.forEach(l => c[l.charCodeAt(0) - 97]++); const go = i => { if (i === I.words.length) return 0; let best = go(i + 1); const w = I.words[i]; let ok = true, sc = 0; for (const ch of w) { const k = ch.charCodeAt(0) - 97; c[k]--; sc += I.score[k]; if (c[k] < 0) ok = false; } if (ok) best = Math.max(best, sc + go(i + 1)); for (const ch of w) c[ch.charCodeAt(0) - 97]++; return best; }; const w0 = I.words[0], cc = c.slice(); let can = true; for (const ch of w0) if (--cc[ch.charCodeAt(0) - 97] < 0) can = false; T.at({ word: w0, letters: A(I.letters) }); T.yn('Can the first word be formed on its own?', can, 'Enough copies of each letter.'); T.n('Score of the first word?', [...w0].reduce((s, ch) => s + I.score[ch.charCodeAt(0) - 97], 0), 'Add the score of each of its letters.'); const r = go(0); T.n('Best total score?', r, 'Take or skip each word while letters last.'); return r; }
  });

  D('verbal-arithmetic-puzzle', {
    t: 'Verbal Arithmetic Puzzle',
    r: 'Give each letter a weight = the sum of place values in the words − place values in the result; we need the sum of weight times digit = 0. Backtrack over letters (largest |weight| first) with distinct digits, no leading zeros, pruning by the max remaining contribution.',
    g: R => { const L = R.shuffle([...'ABCDE']), w = Array.from({ length: R.int(2, 3) }, () => Array.from({ length: R.int(1, 2) }, () => R.pick(L)).join('')); if (R.chance(0.5)) { const d = {}; L.forEach((c, i) => d[c] = (i + 3) % 10); const val = s => +[...s].map(c => d[c]).join(''), sum = w.reduce((a, b) => a + val(b), 0); const inv = {}; Object.entries(d).forEach(([c, v]) => inv[v] = c); const res = String(sum).split('').map(ch => inv[ch]); if (res.every(Boolean)) return { words: w, result: res.join('') }; } return { words: w, result: Array.from({ length: R.int(1, 3) }, () => R.pick(L)).join('') }; },
    s(I, T) { const wt = {}, lead = new Set(); [...I.words, I.result].forEach((s, k) => { const sign = k < I.words.length ? 1 : -1; [...s].forEach((c, i) => { wt[c] = (wt[c] || 0) + sign * 10 ** (s.length - 1 - i); }); if (s.length > 1) lead.add(s[0]); }); const L = Object.keys(wt).sort((a, b) => Math.abs(wt[b]) - Math.abs(wt[a])); T.at({ weights: K({ ...wt }) }); T.n('Distinct letters to assign?', L.length, 'Each gets a different digit.'); if (L.length > 10) return false; const suf = L.map((_, i) => L.slice(i).reduce((s, c) => s + Math.abs(wt[c]) * 9, 0)), used = Array(10).fill(false); const go = (i, sum) => { if (i === L.length) return sum === 0; if (Math.abs(sum) > suf[i]) return false; for (let d = lead.has(L[i]) ? 1 : 0; d <= 9; d++) { if (used[d]) continue; used[d] = true; if (go(i + 1, sum + wt[L[i]] * d)) return true; used[d] = false; } return false; }; T.n('Letters that cannot be 0 (leading letters)?', lead.size, 'A word longer than one letter cannot start with 0.'); const r = go(0, 0); T.yn('Can the digits be assigned so the equation holds?', r, 'The weighted sum of the digits must be 0.'); return r; }
  });

  D('the-k-th-lexicographical-string-of-all-happy-strings-of-length-n', {
    t: 'The k-th Lexicographical String of All Happy Strings of Length n',
    r: 'There are 3 times 2 to the power (n−1) happy strings. Choose letters greedily: each choice of the next letter covers 2 to the power (remaining) strings; skip blocks until k falls inside one.',
    g: R => { const n = R.int(1, 4); return { n, k: R.int(1, 3 * 2 ** (n - 1) + 2) }; },
    s(I, T) { const tot = 3 * 2 ** (I.n - 1); T.at({ n: I.n, k: I.k }); T.n('How many happy strings of length n?', tot, '3 times 2 to the power (n minus 1).'); T.yn('Is k within the number of happy strings?', I.k <= tot, 'Otherwise the answer is empty.'); if (I.k > tot) return ''; let k = I.k - 1, out = ''; for (let i = 0; i < I.n; i++) { const opts = 'abc'.split('').filter(c => c !== out[out.length - 1]), block = 2 ** (I.n - 1 - i), idx = Math.floor(k / block); out += opts[idx]; k %= block; } T.c('First letter of the k-th happy string?', ['a', 'b', 'c'], out[0], 'Each first letter covers 2 to the power (n−1) strings.'); return out; }
  });

  D('probability-of-a-two-boxes-having-the-same-number-of-distinct-balls', {
    t: 'Probability of a Two Boxes Having the Same Number of Distinct Balls',
    r: 'Backtrack over colors choosing how many balls of each go into box 1 (weighted by C(count, x)). Count weighted splits with n balls in each box, and those with equal distinct-color counts; divide.',
    g: R => { let b = R.ints(R.int(1, 4), 1, 3); if (b.reduce((a, x) => a + x, 0) % 2) b[0]++; return { balls: b }; },
    cmp: 'float',
    s(I, T) { const C = (n, k) => { let r = 1; for (let i = 0; i < k; i++) r = r * (n - i) / (i + 1); return r; }, half = I.balls.reduce((a, b) => a + b, 0) / 2; let good = 0, all = 0; const go = (i, s1, d1, d2, w) => { if (s1 > half) return; if (i === I.balls.length) { if (s1 === half) { all += w; if (d1 === d2) good += w; } return; } const c = I.balls[i]; for (let x = 0; x <= c; x++) go(i + 1, s1 + x, d1 + (x > 0), d2 + (x < c), w * C(c, x)); }; go(0, 0, 0, 0, 1); T.at({ balls: A(I.balls), perBox: half }); T.n('Weighted splits with equal box sizes?', all, 'Multiply the ways to choose each value, then add over the splits.'); T.n('Weighted splits where both boxes have the same number of colours?', good, 'Count only those splits.'); T.n('Probability?', good / all, 'Good splits divided by all splits.'); return good / all; }
  });

  D('split-a-string-into-the-max-number-of-unique-substrings', {
    t: 'Split a String Into the Max Number of Unique Substrings',
    r: 'Backtrack over the next cut, keeping a set of used pieces; a piece can be used only if it is not already in the set. Prune when the remaining length cannot beat the best.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc') }),
    s(I, T) { const used = new Set(); let best = 0; const go = i => { if (used.size + (I.s.length - i) <= best) return; if (i === I.s.length) { best = Math.max(best, used.size); return; } for (let j = i + 1; j <= I.s.length; j++) { const p = I.s.slice(i, j); if (used.has(p)) continue; used.add(p); go(j); used.delete(p); } }; go(0); T.at({ s: I.s }); T.n('Upper bound on the number of pieces?', I.s.length, 'At most one piece per character.'); T.n('Distinct letters in s?', new Set(I.s).size, 'Single letters alone give at least this many pieces.'); T.n('Most unique pieces?', best, 'Best split found by backtracking.'); return best; }
  });

  D('maximum-number-of-achievable-transfer-requests', {
    t: 'Maximum Number of Achievable Transfer Requests',
    r: 'Backtrack over requests (take or skip) tracking each building\'s net change; at the end, the chosen set is valid exactly when every net change is 0. Maximize the count.',
    g: R => { const n = R.int(1, 4); return { n, requests: Array.from({ length: R.int(1, 6) }, () => [R.int(0, n - 1), R.int(0, n - 1)]) }; },
    s(I, T) { const net = Array(I.n).fill(0); let best = 0; const go = (i, c) => { if (i === I.requests.length) { if (net.every(v => !v)) best = Math.max(best, c); return; } const [a, b] = I.requests[i]; net[a]--; net[b]++; go(i + 1, c + 1); net[a]++; net[b]--; go(i + 1, c); }; go(0, 0); const self = I.requests.filter(([a, b]) => a === b).length; T.at({ requests: A(I.requests.map(r => r.join(' to '))) }); T.n('Self-transfer requests (always achievable)?', self, 'They do not change any balance.'); T.yn('Can every request be accepted together?', best === I.requests.length, 'Only if all the net changes already cancel.'); T.n('Most achievable requests?', best, 'The largest chosen set where every building nets to 0.'); return best; }
  });

  D('distribute-repeating-integers', {
    t: 'Distribute Repeating Integers',
    r: 'Only the value counts matter. Sort customers by quantity descending and backtrack assigning each to a count bucket with enough left (skip buckets with equal remaining amounts).',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3), quantity: R.ints(R.int(1, 3), 1, 3) }),
    s(I, T) { const c = {}; I.nums.forEach(x => c[x] = (c[x] || 0) + 1); const b = Object.values(c), q = I.quantity.slice().sort((x, y) => y - x); T.at({ counts: A(b.slice()), quantities: A(q) }); T.n('Distinct values available?', b.length, 'Each customer takes copies of one value.'); const go = i => { if (i === q.length) return true; const tried = new Set(); for (let j = 0; j < b.length; j++) { if (b[j] < q[i] || tried.has(b[j])) continue; tried.add(b[j]); b[j] -= q[i]; if (go(i + 1)) return true; b[j] += q[i]; } return false; }; T.n('Largest single quantity?', q[0], 'Serve the biggest order first.'); const r = go(0); T.yn('Can every customer be served?', r, 'Backtracking assigns each order to a value with enough copies.'); return r; }
  });

  D('construct-the-lexicographically-largest-valid-sequence', {
    t: 'Construct the Lexicographically Largest Valid Sequence',
    r: 'Fill positions left to right, trying numbers from n down to 1: 1 occupies one slot, x > 1 occupies i and i + x. The first complete fill is the largest.',
    g: R => ({ n: R.int(1, 6) }),
    s(I, T) { const n = I.n, L = 2 * n - 1, a = Array(L).fill(0), used = Array(n + 1).fill(false); let asks = 0; const go = i => { if (i === L) return true; if (a[i]) return go(i + 1); for (let x = n; x >= 1; x--) { if (used[x]) continue; if (x > 1 && (i + x >= L || a[i + x])) continue; a[i] = x; if (x > 1) a[i + x] = x; used[x] = true; if (go(i + 1)) { if (asks++ < 3) { T.at({ position: i, sequence: A(a.slice()) }); T.n(`Number placed at position ${i}?`, x, 'Largest that still completes.'); } return true; } a[i] = 0; if (x > 1) a[i + x] = 0; used[x] = false; } return false; }; go(0); return a; }
  });

  D('find-minimum-time-to-finish-all-jobs', {
    t: 'Find Minimum Time to Finish All Jobs',
    r: 'Sort jobs descending and backtrack assigning each job to a worker; prune when a worker exceeds the best answer, and skip workers with the same current load (and stop after the first empty worker).',
    g: R => { const j = R.ints(R.int(1, 7), 1, 9); return { jobs: j, k: R.int(1, j.length) }; },
    s(I, T) { const a = I.jobs.slice().sort((x, y) => y - x), w = Array(I.k).fill(0); let best = a.reduce((s, x) => s + x, 0); const go = i => { if (i === a.length) { best = Math.min(best, Math.max(...w)); return; } const seen = new Set(); for (let j = 0; j < I.k; j++) { if (seen.has(w[j]) || w[j] + a[i] >= best) continue; seen.add(w[j]); w[j] += a[i]; go(i + 1); w[j] -= a[i]; } }; go(0); T.at({ jobs: A(a), k: I.k }); T.n('Lower bound (the largest job)?', a[0], 'Some worker must do it.'); T.n('Another lower bound: total work divided by k, rounded up?', Math.ceil(a.reduce((s, x) => s + x, 0) / I.k), 'Some worker gets at least an even share.'); T.n('Minimum possible maximum working time?', best, 'Best assignment found by backtracking.'); return best; }
  });

  D('closest-dessert-cost', {
    t: 'Closest Dessert Cost',
    r: 'For each base, backtrack over toppings choosing 0, 1 or 2 of each; track the cost closest to target (smaller cost on ties). Stop early once cost exceeds target.',
    g: R => ({ baseCosts: R.ints(R.int(1, 3), 1, 10), toppingCosts: R.ints(R.int(1, 3), 1, 6), target: R.int(1, 20) }),
    s(I, T) { let best = Infinity; const better = c => Math.abs(c - I.target) < Math.abs(best - I.target) || (Math.abs(c - I.target) === Math.abs(best - I.target) && c < best); const go = (i, c) => { if (better(c)) best = c; if (i === I.toppingCosts.length || c >= I.target) return; for (let q = 0; q <= 2; q++) go(i + 1, c + q * I.toppingCosts[i]); }; I.baseCosts.forEach((b, k) => { go(0, b); if (k < 3) { T.at({ base: b, toppings: A(I.toppingCosts) }); T.n('Closest cost so far?', best, 'Ties go to the cheaper dessert.'); } }); return best; }
  });

  D('splitting-a-string-into-descending-consecutive-values', {
    t: 'Splitting a String Into Descending Consecutive Values',
    r: 'Try every first piece (not the whole string); then each next piece must equal previous − 1 (leading zeros allowed). Backtrack over piece lengths.',
    g: R => { if (R.chance(0.5)) { let x = R.int(2, 12), s = ''; for (let k = 0; k < R.int(2, 3) && x >= 0; k++) s += (R.chance(0.2) ? '0' : '') + x--; return { s }; } return { s: R.str(R.int(2, 6), '0123') }; },
    s(I, T) { const s = I.s; const go = (i, prev) => { if (i === s.length) return true; for (let j = i + 1; j <= s.length; j++) { const v = +s.slice(i, j); if (v === prev - 1 && go(j, v)) return true; if (v >= prev) break; } return false; }; let asks = 0; for (let j = 1; j < s.length; j++) { const v = +s.slice(0, j), ok = go(j, v); if (asks++ < 4) { T.at({ s, firstPiece: s.slice(0, j) }); T.yn('Does this first piece lead to a valid split?', ok, 'Each next piece is previous − 1.'); } if (ok) return true; } return false; }
  });

  D('sum-of-all-subset-xor-totals', {
    t: 'Sum of All Subset XOR Totals',
    r: 'Each bit present in any element is set in exactly half of the 2 to the power n subset XORs, so the answer is (OR of all) times 2 to the power (n−1). (Or backtrack over include or exclude.)',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 12) }),
    s(I, T) { const o = I.nums.reduce((a, b) => a | b, 0); T.at({ nums: A(I.nums) }); T.n('OR of all elements?', o, 'Bits that appear somewhere.'); T.n('How many subsets are there?', 2 ** I.nums.length, 'Each element is in or out.'); T.n('Sum of all subset XOR totals?', o * 2 ** (I.nums.length - 1), 'Each set bit appears in half of the subsets.'); return o * 2 ** (I.nums.length - 1); }
  });

  D('maximum-compatibility-score-sum', {
    t: 'Maximum Compatibility Score Sum',
    r: 'Precompute the score of every student-mentor pair (matching answers). Backtrack assigning mentors to students with a used mask (or bitmask DP) and maximize the sum.',
    g: R => { const m = R.int(1, 4), n = R.int(1, 4); return { students: Array.from({ length: m }, () => R.ints(n, 0, 1)), mentors: Array.from({ length: m }, () => R.ints(n, 0, 1)) }; },
    s(I, T) { const m = I.students.length, sc = I.students.map(s => I.mentors.map(t => s.filter((v, i) => v === t[i]).length)); T.at({ student0: A(I.students[0]), mentor0: A(I.mentors[0]) }); T.n('Score of student 0 with mentor 0?', sc[0][0], 'Matching answers.'); let best = 0; perms([...Array(m).keys()]).forEach(p => best = Math.max(best, p.reduce((s, j, i) => s + sc[i][j], 0))); T.n('Best score student 0 can get with any mentor?', Math.max(...sc[0]), 'Look across student 0\'s row of scores.'); T.n('Maximum total score?', best, 'Best assignment over all mentor orders.'); return best; }
  });

  D('maximum-product-of-the-length-of-two-palindromic-subsequences', {
    t: 'Maximum Product of the Length of Two Palindromic Subsequences',
    r: 'Enumerate all masks; keep those whose subsequence is a palindrome. For every pair of disjoint palindromic masks, maximize popcount(a) times popcount(b).',
    g: R => ({ s: R.str(R.int(2, 8), 'abc') }),
    s(I, T) { const n = I.s.length, pal = []; for (let m = 1; m < 1 << n; m++) { let t = ''; for (let i = 0; i < n; i++) if (m >> i & 1) t += I.s[i]; if (isPal(t)) pal.push([m, t.length]); } T.at({ s: I.s }); T.n('Palindromic subsequence masks?', pal.length, 'Including single letters.'); let best = 0; for (const [a, la] of pal) for (const [b, lb] of pal) if (!(a & b)) best = Math.max(best, la * lb); T.n('Length of the longest palindromic subsequence?', Math.max(...pal.map(p => p[1])), 'The longest mask on its own.'); T.n('Maximum product?', best, 'Best pair of masks with no shared index.'); return best; }
  });

  D('longest-subsequence-repeated-k-times', {
    t: 'Longest Subsequence Repeated k Times',
    r: 'Only letters with count at least k can appear, and the answer is short (at most n divided by k). BFS over candidates by length, extending with each usable letter and keeping those where candidate times k is a subsequence; the last level\'s lexicographically largest wins.',
    g: R => { const base = R.str(R.int(1, 3), 'abc'), k = R.int(2, 3); return { s: Array.from({ length: k }, () => base + R.str(R.int(0, 2), 'abc')).join(''), k }; },
    s(I, T) { const isSub = t => { let i = 0; for (const c of I.s) if (c === t[i]) i++; return i === t.length; }, c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const letters = Object.keys(c).filter(x => c[x] >= I.k).sort(); T.at({ counts: K(c), k: I.k }); T.n('Letters usable (count at least k)?', letters.length, 'Others can never repeat k times.'); let lvl = [''], best = ''; while (lvl.length) { const nx = []; for (const p of lvl) for (const ch of letters) { const q = p + ch; if (isSub(q.repeat(I.k))) nx.push(q); } if (nx.length) best = nx.sort()[nx.length - 1]; lvl = nx; } T.n('Upper bound on the answer length (n divided by k, rounded down)?', Math.floor(I.s.length / I.k), 'The answer repeated k times must fit inside s.'); T.n('Length of the answer?', best.length, 'The deepest level the search reached.'); return best; }
  });

  D('count-number-of-maximum-bitwise-or-subsets', {
    t: 'Count Number of Maximum Bitwise-OR Subsets',
    r: 'The maximum OR is the OR of all. Backtrack include or exclude carrying the OR and count subsets reaching it.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 8) }),
    s(I, T) { const mx = I.nums.reduce((a, b) => a | b, 0); T.at({ nums: A(I.nums) }); T.n('Maximum possible OR?', mx, 'OR of everything.'); const go = (i, o) => i === I.nums.length ? (o === mx ? 1 : 0) : go(i + 1, o | I.nums[i]) + go(i + 1, o); T.n('Elements equal to the maximum OR on their own?', I.nums.filter(x => x === mx).length, 'Each one alone already reaches it.'); const r = go(0, 0); T.n('Subsets reaching the maximum OR?', r, 'Take or skip each element and count.'); return r; }
  });

  D('next-greater-numerically-balanced-number', {
    t: 'Next Greater Numerically Balanced Number',
    r: 'A number is balanced when every digit d occurs exactly d times. Check numbers n + 1, n + 2, … (or generate balanced numbers by backtracking over digit multisets) and return the first.',
    g: R => ({ n: R.int(0, 5000) }),
    s(I, T) { const bal = x => { const c = {}; for (const d of String(x)) c[d] = (c[d] || 0) + 1; return Object.entries(c).every(([d, k]) => +d === k); }; let x = I.n + 1, asks = 0; while (!bal(x)) { if (asks++ < 3) { T.at({ candidate: x }); T.yn('Balanced?', false, 'Each digit d must appear d times.'); } x++; } return x; }
  });

  D('number-of-valid-move-combinations-on-chessboard', {
    t: 'Number of Valid Move Combinations On Chessboard',
    r: 'Each piece picks a direction and distance (or stays). Backtrack over pieces, simulating all chosen moves second by second; reject a combination if two pieces ever share a square at the same time.',
    g: R => { const n = R.int(1, 3), types = ['rook', 'bishop', 'queen'], pieces = [], pos = [], seen = new Set(); for (let i = 0; i < n; i++) { let t = R.pick(types); if (t === 'queen' && pieces.includes('queen')) t = 'rook'; let p; do p = [R.int(1, 8), R.int(1, 8)]; while (seen.has(p.join())); seen.add(p.join()); pieces.push(t); pos.push(p); } return { pieces, positions: pos }; },
    s(I, T) { const dirs = { rook: [[1, 0], [-1, 0], [0, 1], [0, -1]], bishop: [[1, 1], [1, -1], [-1, 1], [-1, -1]] }; dirs.queen = [...dirs.rook, ...dirs.bishop]; const moves = I.pieces.map((p, i) => { const [r, c] = I.positions[i], out = [[0, 0, 0]]; for (const [dr, dc] of dirs[p]) for (let d = 1; ; d++) { const a = r + dr * d, b = c + dc * d; if (a < 1 || b < 1 || a > 8 || b > 8) break; out.push([dr, dc, d]); } return out; }); moves.forEach((mv, i) => { if (i < 3) { T.at({ piece: I.pieces[i], at: I.positions[i].join(',') }); T.n('Move options for this piece (including staying)?', mv.length, 'Every direction times distance, plus stay.'); } }); const pick = []; const ok = () => { for (let t = 1; t <= 7; t++) { const S = new Set(); for (let i = 0; i < pick.length; i++) { const [dr, dc, d] = pick[i], s = Math.min(t, d), key = (I.positions[i][0] + dr * s) + ',' + (I.positions[i][1] + dc * s); if (S.has(key)) return false; S.add(key); } } return true; }; const go = i => { if (i === moves.length) return ok() ? 1 : 0; let c = 0; for (const m of moves[i]) { pick.push(m); c += go(i + 1); pick.pop(); } return c; }; return go(0); }
  });

  D('maximum-good-people-based-on-statements', {
    t: 'Maximum Good People Based on Statements',
    r: 'Try every subset of people as "good". It is consistent if every good person\'s statements (0 bad or 1 good) match the subset. Maximize the subset size.',
    g: R => { const n = R.int(2, 4); return { statements: Array.from({ length: n }, (_, i) => Array.from({ length: n }, (_, j) => i === j ? 2 : R.int(0, 2))) }; },
    s(I, T) { const n = I.statements.length; let best = 0, asks = 0; for (let m = 0; m < 1 << n; m++) { let ok = true; for (let i = 0; i < n && ok; i++) if (m >> i & 1) for (let j = 0; j < n; j++) { const s = I.statements[i][j]; if (s < 2 && s !== (m >> j & 1)) { ok = false; break; } } const c = m.toString(2).split('').filter(b => b === '1').length; if (ok) best = Math.max(best, c); if (asks++ < 4) { T.at({ goodSet: m.toString(2).padStart(n, '0') }); T.yn('Is this assumption consistent?', ok, 'Good people only tell the truth.'); } } return best; }
  });

  D('maximum-split-of-positive-even-integers', {
    t: 'Maximum Split of Positive Even Integers',
    r: 'Odd sums are impossible. Greedily take 2, 4, 6, … while the remainder stays larger than the next number; add whatever is left to the last term.',
    g: R => ({ finalSum: R.int(1, 40) }),
    cmp: (o, e, I) => Array.isArray(o) && o.length === e.length && new Set(o).size === o.length && o.every(x => x > 0 && x % 2 === 0) && (o.length === 0 || o.reduce((a, b) => a + b, 0) === I.finalSum),
    s(I, T) { T.at({ finalSum: I.finalSum }); T.yn('Is finalSum even?', I.finalSum % 2 === 0, 'Otherwise no split.'); if (I.finalSum % 2) return []; const out = []; let rem = I.finalSum, x = 2; while (rem >= x) { out.push(x); rem -= x; x += 2; } out[out.length - 1] += rem; T.n('How many integers in the split?', out.length, 'Greedy 2, 4, 6, …'); T.n('Largest integer in the split?', out[out.length - 1], 'The leftover is added to the last term.'); return out; }
  });

  D('maximum-points-in-an-archery-competition', {
    t: 'Maximum Points in an Archery Competition',
    r: 'Winning section k costs alice[k] + 1 arrows and gives k points. Try all 2 to the power 12 subsets (backtracking) within the arrow budget; dump leftover arrows anywhere (e.g. section 0).',
    g: R => { const n = R.int(1, 12); const a = Array(12).fill(0); for (let i = 0; i < n; i++) a[R.int(0, 11)]++; return { numArrows: n, aliceArrows: a }; },
    cmp: (o, e, I) => Array.isArray(o) && o.length === 12 && o.every(x => Number.isInteger(x) && x >= 0) && o.reduce((a, b) => a + b, 0) === I.numArrows && archScore(o, I.aliceArrows) === archScore(e, I.aliceArrows),
    s(I, T) { let best = -1, bm = 0; for (let m = 0; m < 1 << 12; m++) { let cost = 0, sc = 0; for (let k = 0; k < 12; k++) if (m >> k & 1) { cost += I.aliceArrows[k] + 1; sc += k; } if (cost <= I.numArrows && sc > best) { best = sc; bm = m; } } const bob = Array(12).fill(0); let used = 0; for (let k = 0; k < 12; k++) if (bm >> k & 1) { bob[k] = I.aliceArrows[k] + 1; used += bob[k]; } bob[0] += I.numArrows - used; T.at({ alice: A(I.aliceArrows), arrows: I.numArrows }); T.n('Best score Bob can get?', best, 'Win the most valuable affordable sections.'); T.n('Arrows needed to win section 11?', I.aliceArrows[11] + 1, 'One more than Alice shot there.'); T.n('Arrows left over for section 0?', I.numArrows - used, 'Unused arrows go anywhere, such as section 0.'); return bob; }
  });

  D('fair-distribution-of-cookies', {
    t: 'Fair Distribution of Cookies',
    r: 'Backtrack giving each bag to one of k children, pruning when a child exceeds the best unfairness found; skip children with equal current totals.',
    g: R => { const c = R.ints(R.int(2, 7), 1, 12); return { cookies: c, k: R.int(2, c.length) }; },
    s(I, T) { const kids = Array(I.k).fill(0); let best = Infinity; const go = i => { if (i === I.cookies.length) { best = Math.min(best, Math.max(...kids)); return; } const seen = new Set(); for (let j = 0; j < I.k; j++) { if (seen.has(kids[j]) || kids[j] + I.cookies[i] >= best) continue; seen.add(kids[j]); kids[j] += I.cookies[i]; go(i + 1); kids[j] -= I.cookies[i]; } }; go(0); T.at({ cookies: A(I.cookies), k: I.k }); T.n('Lower bound (largest bag)?', Math.max(...I.cookies), 'Some child gets it.'); T.n('Another lower bound: total cookies divided by k, rounded up?', Math.ceil(I.cookies.reduce((a, b) => a + b, 0) / I.k), 'Some child gets at least an even share.'); T.n('Minimum unfairness?', best, 'Best distribution found by backtracking.'); return best; }
  });

  D('construct-smallest-number-from-di-string', {
    t: 'Construct Smallest Number From DI String',
    r: 'Push 1 to n+1 onto a stack; whenever the pattern has I (or at the end), pop everything — reversing each run of D\'s.',
    g: R => ({ pattern: R.str(R.int(1, 7), 'ID') }),
    s(I, T) { const st = []; let out = ''; for (let i = 0; i <= I.pattern.length; i++) { st.push(i + 1); if (i === I.pattern.length || I.pattern[i] === 'I') { while (st.length) out += st.pop(); if (i < 6) { T.at({ pattern: A([...I.pattern], { i: Math.min(i, I.pattern.length - 1) }), built: out }); T.n('Digits placed so far?', out.length, 'Flush the stack on I.'); } } } return out; }
  });

  D('maximum-rows-covered-by-columns', {
    t: 'Maximum Rows Covered by Columns',
    r: 'Encode each row as a column bitmask. Enumerate all column subsets of size numSelect (backtracking); a row is covered if its mask is a subset. Maximize covered rows.',
    g: R => { const n = R.int(1, 4); return { matrix: Array.from({ length: R.int(1, 4) }, () => R.ints(n, 0, 1)), numSelect: R.int(1, n) }; },
    s(I, T) { const n = I.matrix[0].length, rows = I.matrix.map(r => r.reduce((m, v, j) => v ? m | 1 << j : m, 0)), pc = x => x.toString(2).split('').filter(b => b === '1').length; let best = 0; for (let m = 0; m < 1 << n; m++) if (pc(m) === I.numSelect) best = Math.max(best, rows.filter(r => (r & m) === r).length); T.at({ matrix: G(I.matrix), numSelect: I.numSelect }); T.n('Rows with no 1s (always covered)?', rows.filter(r => !r).length, 'Empty mask is a subset of anything.'); T.n('How many column subsets are there to try?', [...Array(1 << n).keys()].filter(m => pc(m) === I.numSelect).length, 'Choose numSelect of the n columns.'); T.n('Most rows covered?', best, 'Best over all column subsets.'); return best; }
  });

  D('the-number-of-beautiful-subsets', {
    t: 'The Number of Beautiful Subsets',
    r: 'Backtrack over elements with a count map: include x only if neither x − k nor x + k is currently chosen. Count non-empty subsets.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 8), k: R.int(1, 3) }),
    s(I, T) { const c = new Map(); const go = i => { if (i === I.nums.length) return 1; let t = go(i + 1); const x = I.nums[i]; if (!c.get(x - I.k) && !c.get(x + I.k)) { c.set(x, (c.get(x) || 0) + 1); t += go(i + 1); c.set(x, c.get(x) - 1); } return t; }; const r = go(0) - 1; T.at({ nums: A(I.nums), k: I.k }); T.n('Pairs (i < j) that conflict (differ by k)?', I.nums.reduce((s, x, i) => s + I.nums.slice(i + 1).filter(y => Math.abs(x - y) === I.k).length, 0), 'Such pairs can never be together.'); T.n('Non-empty subsets in total?', 2 ** I.nums.length - 1, 'Before removing any with a conflict.'); T.n('Beautiful subsets?', r, 'Subsets with no two values differing by k.'); return r; }
  });

  D('the-knights-tour', {
    t: 'The Knight’s Tour',
    r: 'Backtracking DFS over knight moves, marking each cell with its visit number; Warnsdorff\'s rule (try the neighbor with the fewest onward moves first) finds a tour quickly.',
    g: R => { const o = R.pick([[1, 1, 0, 0], [3, 4, 0, 0], [3, 4, 2, 3], [4, 3, 0, 0], [5, 5, 0, 0], [5, 5, 2, 2], [5, 5, 4, 4], [4, 5, 0, 0], [5, 4, 0, 0], [3, 4, 0, 3]]); return { m: o[0], n: o[1], r: o[2], c: o[3] }; },
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== I.m) return false; const pos = []; for (let r = 0; r < I.m; r++) for (let c = 0; c < I.n; c++) pos[o[r][c]] = [r, c]; if (pos.length !== I.m * I.n || pos.some(p => !p) || o[I.r][I.c] !== 0) return false; for (let k = 1; k < pos.length; k++) { const dr = Math.abs(pos[k][0] - pos[k - 1][0]), dc = Math.abs(pos[k][1] - pos[k - 1][1]); if (!((dr === 1 && dc === 2) || (dr === 2 && dc === 1))) return false; } return true; },
    s(I, T) { const b = Array.from({ length: I.m }, () => Array(I.n).fill(-1)), mv = [[1, 2], [2, 1], [-1, 2], [-2, 1], [1, -2], [2, -1], [-1, -2], [-2, -1]], free = (r, c) => r >= 0 && c >= 0 && r < I.m && c < I.n && b[r][c] < 0, deg = (r, c) => mv.filter(([a, d]) => free(r + a, c + d)).length; let asks = 0; const go = (r, c, k) => { b[r][c] = k; if (k === I.m * I.n - 1) return true; const nx = mv.map(([a, d]) => [r + a, c + d]).filter(([x, y]) => free(x, y)).sort((p, q) => deg(...p) - deg(...q)); if (asks++ < 4) { T.at({ board: G(b.map(x => x.map(v => v < 0 ? '.' : v)), { hl: [[r, c]] }) }); T.n('Unvisited knight moves from here?', nx.length, 'Warnsdorff: try the most constrained first.'); } for (const [x, y] of nx) if (go(x, y, k + 1)) return true; b[r][c] = -1; return false; }; go(I.r, I.c, 0); return b; }
  });

  D('find-the-punishment-number-of-an-integer', {
    t: 'Find the Punishment Number of an Integer',
    r: 'For each i at most n, backtrack over ways to cut the decimal string of i² into pieces; if some partition sums to i, add i².',
    g: R => ({ n: R.int(1, 40) }),
    s(I, T) { const can = (s, t) => { if (!s) return t === 0; for (let j = 1; j <= s.length; j++) { const v = +s.slice(0, j); if (v > t) break; if (can(s.slice(j), t - v)) return true; } return false; }; let tot = 0, asks = 0; for (let i = 1; i <= I.n; i++) { const ok = can(String(i * i), i); if (ok) { tot += i * i; if (asks++ < 4) { T.at({ i, square: i * i }); T.n('Punishment number so far?', tot, `${i * i} splits into parts summing to ${i}.`); } } } return tot; }
  });

  D('maximum-strength-of-a-group', {
    t: 'Maximum Strength of a Group',
    r: 'Backtrack over non-empty subsets tracking the product (or greedily: take all positives, all negatives except possibly the one closest to zero when their count is odd; handle the all-zero and single-negative cases).',
    g: R => ({ nums: R.ints(R.int(1, 7), -5, 5) }),
    s(I, T) { let best = -Infinity; const go = (i, p, k) => { if (i === I.nums.length) { if (k) best = Math.max(best, p); return; } go(i + 1, p * I.nums[i], k + 1); go(i + 1, p, k); }; go(0, 1, 0); const neg = I.nums.filter(x => x < 0).length; T.at({ nums: A(I.nums) }); T.n('How many negatives?', neg, 'Pairs of them multiply to a positive.'); T.n('How many positives?', I.nums.filter(x => x > 0).length, 'Every positive helps the product.'); T.n('Maximum strength?', best, 'Best product over all non-empty groups.'); return best; }
  });

  D('partition-string-into-minimum-beautiful-substrings', {
    t: 'Partition String Into Minimum Beautiful Substrings',
    r: 'A beautiful piece has no leading zero and is a power of 5 in binary. Backtrack (or DP) over cut positions minimizing the number of pieces; −1 if impossible.',
    g: R => { const P = ['1', '101', '11001', '1111101']; return { s: R.chance(0.6) ? Array.from({ length: R.int(1, 3) }, () => R.pick(P)).join('') : R.str(R.int(1, 7), '01') }; },
    s(I, T) { const pow5 = new Set(); for (let v = 1; v < 2 ** 16; v *= 5) pow5.add(v.toString(2)); const s = I.s, dp = Array(s.length + 1).fill(Infinity); dp[s.length] = 0; for (let i = s.length - 1; i >= 0; i--) for (let j = i + 1; j <= s.length; j++) if (pow5.has(s.slice(i, j))) dp[i] = Math.min(dp[i], 1 + dp[j]); T.at({ s, powersOf5: A([...pow5].slice(0, 4)) }); T.yn('Is the whole string a single power of 5?', pow5.has(s), 'Then the answer is 1.'); T.yn('Does the string start with 1?', s[0] === '1', 'A piece cannot have a leading zero.'); T.n('Fewest pieces (−1 if impossible)?', dp[0] === Infinity ? -1 : dp[0], 'Best cut found from the right.'); return dp[0] === Infinity ? -1 : dp[0]; }
  });

  D('minimum-moves-to-spread-stones-over-grid', {
    t: 'Minimum Moves to Spread Stones Over Grid',
    r: 'List each extra stone (cells with > 1, repeated) and each empty cell. Try every matching (permutation) of extras to empties and minimize the total Manhattan distance.',
    g: R => { const g = Array(9).fill(0); for (let i = 0; i < 9; i++) g[R.int(0, 8)]++; return { grid: [g.slice(0, 3), g.slice(3, 6), g.slice(6, 9)] }; },
    s(I, T) { const extra = [], empty = []; I.grid.forEach((r, i) => r.forEach((v, j) => { for (let k = 1; k < v; k++) extra.push([i, j]); if (!v) empty.push([i, j]); })); T.at({ grid: G(I.grid) }); T.n('Empty cells to fill?', empty.length, 'Each needs one extra stone.'); let best = Infinity; perms([...Array(empty.length).keys()]).forEach(p => { best = Math.min(best, p.reduce((s, e, i) => s + Math.abs(extra[i][0] - empty[e][0]) + Math.abs(extra[i][1] - empty[e][1]), 0)); }); T.n('Extra stones to move?', extra.length, 'Every stone beyond the first in a cell.'); T.n('Fewest moves?', empty.length ? best : 0, 'Best matching of extra stones to empty cells by distance.'); return empty.length ? best : 0; }
  });

  D('number-of-self-divisible-permutations', {
    t: 'Number of Self-Divisible Permutations',
    r: 'Backtrack (or bitmask DP) filling positions i = 1 to n with unused numbers x where gcd(x, i) = 1.',
    g: R => ({ n: R.int(1, 8) }),
    s(I, T) { const used = Array(I.n + 1).fill(false); const go = i => { if (i > I.n) return 1; let c = 0; for (let x = 1; x <= I.n; x++) if (!used[x] && gcd(x, i) === 1) { used[x] = true; c += go(i + 1); used[x] = false; } return c; }; T.at({ n: I.n, position: Math.min(2, I.n) }); T.n(`Numbers coprime with ${Math.min(2, I.n)}?`, [...Array(I.n).keys()].filter(x => gcd(x + 1, Math.min(2, I.n)) === 1).length, 'Allowed at that position.'); T.n(`Numbers coprime with ${I.n}?`, [...Array(I.n).keys()].filter(x => gcd(x + 1, I.n) === 1).length, `Allowed at position ${I.n}.`); const r = go(1); T.n('Self-divisible permutations?', r, 'Count every complete placement.'); return r; }
  });

  D('generate-binary-strings-without-adjacent-zeros', {
    t: 'Generate Binary Strings Without Adjacent Zeros',
    r: 'Backtrack character by character: you can always append 1, and append 0 only if the previous character is not 0.',
    g: R => ({ n: R.int(1, 5) }),
    cmp: 'set',
    s(I, T) { let out = ['0', '1']; for (let L = 2; L <= I.n; L++) { out = out.flatMap(s => s.endsWith('0') ? [s + '1'] : [s + '0', s + '1']); T.at({ length: L }); T.n('Valid strings of this length?', out.length, 'Fibonacci growth.'); } if (I.n === 1) { T.at({ n: 1 }); T.n('Valid strings?', 2, '"0" and "1".'); } return out; }
  });

  D('smallest-divisible-digit-product-ii', {
    t: 'Smallest Divisible Digit Product II',
    r: 'If t has a prime factor above 7, answer −1. Otherwise find the longest prefix we can keep, bump one digit, and fill the suffix greedily from the right with the largest digits needed to cover the remaining factors of 2, 3, 5, 7 (padding with 1s); fall back to a longer number.',
    g: R => ({ num: String(R.int(1, 999)), t: R.pick([1, 2, 6, 10, 12, 26, 49, 64, 90, 120]) }),
    s(I, T) { let t = I.t; for (const p of [2, 3, 5, 7]) while (t % p === 0) t /= p; T.at({ t: I.t }); let f2 = 0, tt = I.t; while (tt % 2 === 0) { tt /= 2; f2++; } T.n('How many factors of 2 does t have?', f2, 'Digits 2, 4, 6 and 8 supply these.'); T.yn('Does t only have prime factors 2, 3, 5, 7?', t === 1, 'Otherwise no digit product can be divisible.'); if (t !== 1) return '-1'; const prod = s => [...s].reduce((p, d) => p * BigInt(d), 1n); let x = BigInt(I.num); for (;;) { const s = x.toString(); if (!s.includes('0') && prod(s) % BigInt(I.t) === 0n) { T.n('Digits in the answer?', s.length, 'The smallest zero-free number at least num whose digit product works.'); return s; } x++; } }
  });

  D('minimum-time-to-break-locks-i', {
    t: 'Minimum Time to Break Locks I',
    r: 'Breaking a lock of strength s with factor x takes s divided by x (rounded up) minutes; afterwards x grows by k. Try every order of the locks (backtracking with a used mask) and minimize the total time.',
    g: R => ({ strength: R.ints(R.int(1, 6), 1, 12), k: R.int(1, 4) }),
    s(I, T) { const n = I.strength.length, used = Array(n).fill(false); let best = Infinity; const go = (i, x, t) => { if (t >= best) return; if (i === n) { best = t; return; } for (let j = 0; j < n; j++) if (!used[j]) { used[j] = true; go(i + 1, x + I.k, t + Math.ceil(I.strength[j] / x)); used[j] = false; } }; go(0, 1, 0); T.at({ strength: A(I.strength), k: I.k }); T.n('Minutes to break the first lock in the given order?', I.strength[0], 'Factor starts at 1.'); T.n('Factor x when the last lock is broken?', 1 + (n - 1) * I.k, 'It grows by k after each lock.'); T.n('Minimum total time?', best, 'Best lock order found.'); return best; }
  });

  D('permutations-iii', {
    t: 'Permutations III',
    r: 'Backtrack in increasing order, appending only numbers whose parity differs from the last one; results come out in lexicographic order.',
    g: R => ({ n: R.int(1, 6) }),
    s(I, T) { const used = Array(I.n + 1).fill(false), out = [], path = []; const go = () => { if (path.length === I.n) { out.push(path.slice()); return; } for (let x = 1; x <= I.n; x++) { if (used[x] || (path.length && x % 2 === path[path.length - 1] % 2)) continue; used[x] = true; path.push(x); go(); path.pop(); used[x] = false; } }; go(); T.at({ n: I.n }); T.n('Odd numbers from 1 to n?', Math.ceil(I.n / 2), 'Odd and even must alternate, so their counts differ by at most one.'); T.n('Permutations that start with 1?', out.filter(p => p[0] === 1).length, 'Then odd numbers sit at every even index.'); T.n('Alternating permutations?', out.length, 'Parity must switch every step.'); return out; }
  });
})();
