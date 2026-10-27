/* v2 games: strings (06). Guides scored in the 3483–4041 pass. */
(function () {
  'use strict';
  const { D, A, G, K, S, Q, X, Tr, TR, GR, LL, Ls, IV, show } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);
  const gcd = (a, b) => b ? gcd(b, a % b) : Math.abs(a);
  const lcm = (a, b) => a / gcd(a, b) * b;
  const MOD = 1000000007;
  const range = (a, b) => Array.from({ length: Math.max(0, b - a) }, (_, i) => a + i);
  const fmt = a => typeof a === 'string' ? JSON.stringify(a) : Array.isArray(a) ? JSON.stringify(a) : String(a);
  const digits = x => String(Math.abs(x)).split('').map(Number);
  const isPal = s => s === s.split('').reverse().join('');
  const popc = x => { let c = 0; while (x) { c += x & 1; x >>>= 1; } return c; };
  const isPrime = x => { if (x < 2) return false; for (let d = 2; d * d <= x; d++) if (x % d === 0) return false; return true; };
  // Design problems: ops[0] constructs, the rest are method calls; asks about returned values.
  // o.view(obj) -> board, o.why(op, args, r, obj) -> feedback, o.strOpts / o.arrOpts(obj, r) -> distractors, o.skip(op) -> don't ask.
  const play = (I, T, make, o) => { o = o || {}; const obj = make(...(I.args[0] || [])), out = [null]; let asks = 0; const max = o.max || 7; for (let i = 1; i < I.ops.length; i++) { const op = I.ops[i], args = I.args[i] || [], before = o.view ? o.view(obj) : {}; let r = obj[op](...args); if (r === undefined) r = null; out.push(r); if (asks >= max || r === null || (o.skip && o.skip(op))) continue; const label = `${op}(${args.map(fmt).join(', ')})`, why = o.why ? o.why(op, args, r, obj) : 'Follow the structure\'s invariant.'; T.at(Object.assign({ call: label }, before)); if (typeof r === 'number' && Number.isFinite(r)) { T.n(`What does ${label} return?`, r, why); asks++; } else if (typeof r === 'boolean') { T.yn(`Does ${label} return true?`, r, why); asks++; } else if (typeof r === 'string') { const opts = [...new Set([r, ...(o.strOpts ? o.strOpts(obj, r) : []), r === '' ? 'null' : ''])].slice(0, 4); if (opts.length > 1) { T.c(`What does ${label} return?`, opts.map(x => x === '' ? '""' : x), r === '' ? '""' : r, why); asks++; } } else if (Array.isArray(r)) { const opts = o.arrOpts ? o.arrOpts(obj, r, op) : null; if (opts) { T.c(`What does ${label} return?`, [r, ...opts].map(show), show(r), why); } else T.n(`How many items does ${label} return?`, r.length, why); asks++; } } if (!asks) { T.at({ calls: I.ops.length - 1 }); T.n('How many method calls follow the constructor?', I.ops.length - 1, 'Count the operations.'); } return out; };
  const seq = (R, ctor, ctorArgs, n, step, st) => { const ops = [ctor], args = [ctorArgs]; st = st || {}; for (let i = 0; i < n; i++) { const x = step(R, st); if (!x) break; ops.push(x[0]); args.push(x[1]); } return { ops, args }; };
  // Children lists of a tree given as undirected edges ([u, v] or [u, v, w]); ids 0..n-1 (or 1..n with base 1).
  const kids = (n, edges, root, base) => { base = base || 0; const adj = Array.from({ length: n + base }, () => []); edges.forEach(e => { adj[e[0]].push([e[1], e[2]]); adj[e[1]].push([e[0], e[2]]); }); const ch = Array.from({ length: n + base }, () => []), par = Array(n + base).fill(-1), order = [root], seen = new Set([root]); for (let i = 0; i < order.length; i++) for (const [v, w] of adj[order[i]]) if (!seen.has(v)) { seen.add(v); par[v] = order[i]; ch[order[i]].push(v); order.push(v); } return { ch, par, order, adj }; };

  D('maximize-active-section-with-trade-i', {
    t: 'Maximize Active Section with Trade I',
    r: 'Erasing a 1-block that sits between two 0-blocks merges them, and the merged block then flips to 1. The gain is the sum of two consecutive 0-blocks, so take the best adjacent pair and add it to the count of 1s.',
    g: R => ({ s: R.str(R.int(3, 10), '01') }),
    s(I, T) { const s = I.s, z = []; let ones = 0; for (let i = 0; i < s.length;) { let j = i; while (j < s.length && s[j] === s[i]) j++; if (s[i] === '0') z.push(j - i); else ones += j - i; i = j; } T.at({ s: A(s.split('')) }); T.n('How many 1s before any trade?', ones, 'Count the active sections.'); let g = 0; for (let i = 0; i + 1 < z.length; i++) { T.at({ zeroBlocks: A(z, { i, j: i + 1 }) }); T.n(`Gain from merging zero blocks ${i} and ${i + 1}?`, z[i] + z[i + 1], 'Both blocks flip to 1s.'); g = Math.max(g, z[i] + z[i + 1]); } return ones + g; }
  });

  D('maximize-active-section-with-trade-ii', {
    t: 'Maximize Active Section with Trade II',
    r: 'The trade happens inside s[l to r] only, so the result is all 1s in s plus the best sum of two consecutive 0-blocks inside the substring (cut at the query edges). The full solution answers this with a sparse table over block pairs.',
    g: R => { const s = R.str(R.int(4, 9), '01'); return { s, queries: Array.from({ length: R.int(2, 4) }, () => { const l = R.int(0, s.length - 1); return [l, R.int(l, s.length - 1)]; }) }; },
    s(I, T) { const ones = I.s.split('').filter(c => c === '1').length; return I.queries.map(([l, r]) => { const t = I.s.slice(l, r + 1), z = []; for (let i = 0; i < t.length;) { let j = i; while (j < t.length && t[j] === t[i]) j++; if (t[i] === '0') z.push(j - i); i = j; } let g = 0; for (let i = 0; i + 1 < z.length; i++) g = Math.max(g, z[i] + z[i + 1]); T.at({ s: A(I.s.split(''), { win: [l, r] }), zeroBlocks: A(z.length ? z : ['none']), ones }); T.n(`Best gain inside s[${l}..${r}]?`, g, z.length < 2 ? 'Fewer than two zero blocks: no trade helps.' : 'Largest sum of two consecutive zero blocks.'); return ones + g; }); }
  });

  D('smallest-palindromic-rearrangement-i', {
    t: 'Smallest Palindromic Rearrangement I',
    r: 'The first half decides everything: sort it ascending, keep the odd middle letter in the middle, and mirror the half to the right.',
    g: R => { const h = R.str(R.int(1, 4), 'abcd'), m = R.chance(0.5) ? R.pick('abcd') : ''; return { s: h + m + h.split('').reverse().join('') }; },
    s(I, T) { const n = I.s.length, half = I.s.slice(0, n >> 1).split('').sort(), mid = n % 2 ? I.s[n >> 1] : ''; const left = half.slice(); half.forEach((c, i) => { T.at({ s: A(I.s.split('')), built: A(half.slice(0, i)), pool: A(left.slice().sort()) }); T.c(`Letter at position ${i}?`, [...new Set(left)], c, 'Take the smallest letter still available for the half.'); left.splice(left.indexOf(c), 1); }); return half.join('') + mid + half.slice().reverse().join(''); }
  });

  D('smallest-palindromic-rearrangement-ii', {
    t: 'Smallest Palindromic Rearrangement II',
    r: 'Count permutations of the half multiset. At each position try letters in order: if the arrangements starting with a letter are fewer than k, subtract them from k and move on; otherwise fix that letter.',
    g: R => { const h = R.str(R.int(2, 4), 'abc'), m = R.chance(0.4) ? R.pick('abc') : ''; return { s: h + m + h.split('').reverse().join(''), k: R.int(1, 8) }; },
    s(I, T) { const n = I.s.length, cnt = {}; for (const c of I.s.slice(0, n >> 1)) cnt[c] = (cnt[c] || 0) + 1; const f = x => x <= 1 ? 1 : x * f(x - 1); const perms = () => { const v = Object.values(cnt), t = sum(v); return v.reduce((a, c) => a / f(c), f(t)); }; let k = I.k; if (perms() < k) { T.at({ half: K(Object.assign({}, cnt)), k }); T.n('How many distinct arrangements of the half are there?', perms(), 'Multinomial: (half length)! over each letter count!.'); return ''; } const out = [], L = n >> 1; for (let i = 0; i < L; i++) { for (const c of Object.keys(cnt).sort()) { if (!cnt[c]) continue; cnt[c]--; const p = perms(); if (p >= k) { T.at({ built: A(out.slice()), k, startsWith: `${c}: ${p} ways` }); T.c(`Letter at position ${i}?`, Object.keys(cnt).filter(x => cnt[x] || x === c).sort(), c, 'Arrangements starting with smaller letters are fewer than k, so skip them.'); out.push(c); break; } k -= p; cnt[c]++; } } const mid = n % 2 ? I.s[L] : ''; return out.join('') + mid + out.slice().reverse().join(''); }
  });

  D('count-cells-in-overlapping-horizontal-and-vertical-substrings', {
    t: 'Count Cells in Overlapping Horizontal and Vertical Substrings',
    r: 'Read the grid row by row into one string and column by column into another. Find every match of the pattern in each (KMP or rolling hash), mark the covered cells, and count cells marked by both.',
    g: R => { const m = R.int(2, 4), n = R.int(2, 4); return { grid: R.cgrid(m, n, 'ab'), pattern: R.str(R.int(1, 3), 'ab') }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, p = I.pattern, L = p.length; const H = g.map(r => r.join('')).join(''); let V = ''; for (let j = 0; j < n; j++) for (let i = 0; i < m; i++) V += g[i][j]; const hm = new Set(), vm = new Set(); let hc = 0, vc = 0; for (let s = 0; s + L <= m * n; s++) { if (H.slice(s, s + L) === p) { hc++; for (let t = s; t < s + L; t++) hm.add(t); } if (V.slice(s, s + L) === p) { vc++; for (let t = s; t < s + L; t++) vm.add((t % m) * n + Math.floor(t / m)); } } T.at({ grid: G(g), pattern: p, rowMajor: H }); T.n('Matches in the row-major string?', hc, 'Rows wrap into the next row.'); T.at({ grid: G(g), pattern: p, colMajor: V }); T.n('Matches in the column-major string?', vc, 'Columns wrap into the next column.'); const both = [...hm].filter(x => vm.has(x)); T.at({ grid: G(g, { hl: both.map(x => [Math.floor(x / n), x % n]) }), horizontalCells: hm.size, verticalCells: vm.size }); T.n('Cells covered by both a horizontal and a vertical match?', both.length, 'Intersect the two covered sets.'); return both.length; }
  });

  D('find-the-shortest-superstring-ii', {
    t: 'Find the Shortest Superstring II',
    r: 'If one string contains the other, return the longer one. Otherwise overlap them as much as possible both ways (a suffix of one that equals a prefix of the other) and keep the shorter result.',
    g: R => ({ s1: R.str(R.int(1, 5), 'ab'), s2: R.str(R.int(1, 5), 'ab') }),
    cmp: (o, e, I) => typeof o === 'string' && o.length === e.length && o.includes(I.s1) && o.includes(I.s2),
    s(I, T) { const res = (() => { const { s1, s2 } = I; T.at({ s1, s2 }); T.n('Length if you simply join them?', s1.length + s2.length, 'The worst case, with no overlap.'); if (s1.includes(s2) || s2.includes(s1)) { T.at({ s1, s2 }); T.yn('Does one string contain the other?', true, 'Then the longer string is the answer.'); return s1.includes(s2) ? s1 : s2; } const ov = (a, b) => { for (let L = Math.min(a.length, b.length); L > 0; L--) if (a.endsWith(b.slice(0, L))) return L; return 0; }; const x = ov(s1, s2), y = ov(s2, s1); T.at({ s1, s2 }); T.n('Longest suffix of s1 that is a prefix of s2?', x, 'Try lengths from longest down.'); T.n('Longest suffix of s2 that is a prefix of s1?', y, 'Same check the other way.'); return x >= y ? s1 + s2.slice(x) : s2 + s1.slice(y); })(); T.n('Length of the shortest superstring?', res.length, 'Joined length minus the best overlap.'); return res; }
  });

  D('generate-tag-for-video-caption', {
    t: 'Generate Tag for Video Caption',
    r: 'Split into words. The first word becomes all lowercase; every later word gets a capital first letter and lowercase rest. Join after "#", keep only letters, and cut to 100 characters.',
    g: R => ({ caption: Array.from({ length: R.int(1, 4) }, () => R.pick(['leetcode', 'Daily', 'GO', 'tHere', 'can', 'I', 'streak'])).join(' ') }),
    s(I, T) { const w = I.caption.split(' ').filter(Boolean); const out = w.map((x, i) => i ? x[0].toUpperCase() + x.slice(1).toLowerCase() : x.toLowerCase()); out.forEach((x, i) => { T.at({ words: A(w, { i }), built: '#' + out.slice(0, i).join('') }); T.c(`Word ${i} becomes?`, [x, w[i], w[i].toLowerCase(), w[i][0].toUpperCase() + w[i].slice(1).toLowerCase()], x, i ? 'Later words: capital first letter, rest lowercase.' : 'The first word is all lowercase.'); }); return ('#' + out.join('')).replace(/[^A-Za-z#]/g, '').slice(0, 100); }
  });

  D('partition-string', {
    t: 'Partition String',
    r: 'Grow the current segment one letter at a time and stop as soon as it is not in the seen set; record it, add it to the set, and start fresh. A leftover tail that is already seen is dropped.',
    g: R => ({ s: R.str(R.int(4, 10), 'ab') }),
    s(I, T) { const seen = new Set(), out = []; let cur = '', st = 0; for (let i = 0; i < I.s.length; i++) { cur += I.s[i]; if (!seen.has(cur)) { T.at({ s: A(I.s.split(''), { win: [st, i] }), seen: A([...seen]) }); T.n(`Length of the segment starting at index ${st}?`, cur.length, 'Extend until the segment is new.'); seen.add(cur); out.push(cur); cur = ''; st = i + 1; } } return out; }
  });

  D('longest-common-prefix-between-adjacent-strings-after-removals', {
    t: 'Longest Common Prefix Between Adjacent Strings After Removals',
    r: 'Precompute lcp of each adjacent pair, plus prefix and suffix maxima of those values. Removing i kills pairs (i−1, i) and (i, i+1) and creates the new pair (i−1, i+1): answer = max(prefixMax before i−1, suffixMax after i, lcp(words[i−1], words[i+1])).',
    g: R => ({ words: Array.from({ length: R.int(2, 6) }, () => R.str(R.int(1, 3), 'ab')) }),
    s(I, T) { const w = I.words, n = w.length, lcp = (a, b) => { let i = 0; while (i < a.length && i < b.length && a[i] === b[i]) i++; return i; }; const P = range(0, n - 1).map(i => lcp(w[i], w[i + 1])); T.at({ words: A(w), pairLcp: A(P) }); if (P.length) T.n('lcp of words[0] and words[1]?', P[0], 'Count matching leading characters.'); return w.map((_, i) => { const rest = w.filter((_, j) => j !== i); let b = 0; for (let j = 0; j + 1 < rest.length; j++) b = Math.max(b, lcp(rest[j], rest[j + 1])); if (i > 0 && i < n - 1 && i < 5) { T.at({ words: A(w, { i, dim: [i] }), pairLcp: A(P) }); T.n(`lcp of the new pair words[${i - 1}] and words[${i + 1}]?`, lcp(w[i - 1], w[i + 1]), 'Removing i makes its neighbors adjacent.'); T.n(`answer[${i}]?`, b, 'Max of untouched pairs and the new pair.'); } return b; }); }
  });

  D('lexicographically-smallest-permutation-greater-than-target', {
    t: 'Lexicographically Smallest Permutation Greater Than Target',
    r: 'Match target for as long a prefix as possible, then at position i place the smallest available letter greater than target[i] and finish with the leftovers in ascending order. Try the longest feasible i first, moving left.',
    g: R => { const n = R.int(1, 5); return { s: R.str(n, 'abc'), target: R.str(n, 'abc') }; },
    s(I, T) { const n = I.s.length, cnt = {}; for (const ch of I.s) cnt[ch] = (cnt[ch] || 0) + 1; const pre = [Object.assign({}, cnt)]; let ok = n; for (let i = 0; i < n; i++) { const c = Object.assign({}, pre[i]); if (!c[I.target[i]]) { ok = i; break; } c[I.target[i]]--; pre.push(c); } let ans = '', q = 0; T.at({ s: A(I.s.split('')), target: A(I.target.split('')) }); T.n('Longest prefix of target that the letters of s can copy?', ok, 'Spend letters of s on target until one runs out.'); for (let i = Math.min(ok, n - 1); i >= 0; i--) { const c = pre[i], up = Object.keys(c).filter(ch => c[ch] && ch > I.target[i]).sort()[0]; if (q++ < 4) { T.at({ s: A(I.s.split('')), target: A(I.target.split(''), { i }) }); T.yn(`Keep target[0..${i - 1}] and raise position ${i}?`, !!up, up ? `Use "${up}", then the rest in sorted order.` : 'No leftover letter beats target[' + i + '].'); } if (up) { const r = Object.assign({}, c); r[up]--; ans = I.target.slice(0, i) + up + Object.keys(r).sort().map(ch => ch.repeat(r[ch])).join(''); break; } } return ans; }
  });

  D('lexicographically-smallest-palindromic-permutation-greater-than-target', {
    t: 'Lexicographically Smallest Palindromic Permutation Greater Than Target',
    r: 'A palindrome is fixed by its first half (plus the middle letter if n is odd). Use the "match a prefix, then raise one position" trick on the half, filling the rest in ascending order, and compare the mirrored result with target.',
    g: R => { const n = R.int(1, 6), h = R.str(Math.floor(n / 2), 'abc'), m = n % 2 ? R.pick(['a', 'b', 'c']) : ''; return { s: R.shuffle((h + m + h).split('')).join(''), target: R.str(n, 'abc') }; },
    s(I, T) { const n = I.s.length, c = {}; for (const ch of I.s) c[ch] = (c[ch] || 0) + 1; const odd = Object.keys(c).filter(ch => c[ch] % 2); T.at({ s: A(I.s.split('')), counts: K(Object.entries(c).sort()) }); T.yn('Can s form any palindrome?', odd.length <= n % 2, 'At most one letter may have an odd count (only when n is odd).'); if (odd.length > n % 2) return ''; const mid = odd[0] || '', half = Object.keys(c).sort().map(ch => ch.repeat(c[ch] >> 1)).join(''); const perms = x => x.length <= 1 ? [x] : [...new Set([].concat(...x.split('').map((ch, i) => perms(x.slice(0, i) + x.slice(i + 1)).map(p => ch + p))))]; const cands = perms(half).map(h => h + mid + h.split('').reverse().join('')).filter(p => p > I.target).sort(); if (n % 2) T.c('Which letter sits in the middle?', [...new Set([mid, ...Object.keys(c)])].sort(), mid, 'The one letter with an odd count.'); T.yn('Is any palindrome permutation greater than target?', cands.length > 0, cands.length ? `Smallest is "${cands[0]}".` : 'Even the largest half arrangement is not above target.'); return cands[0] || ''; }
  });

  D('find-kth-character-in-expanded-string', {
    t: 'Find Kth Character in Expanded String',
    r: 'A word of length L expands to L times (L plus 1), halved, characters, followed by one space. Skip whole words while k is past them; inside the right word, skip 1, 2, 3 and so on copies until k lands.',
    g: R => { const s = Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 4), 'abcde')).join(' '), len = s.split(' ').reduce((t, w) => t + w.length * (w.length + 1) / 2, 0) + s.split(' ').length - 1; return { s, k: R.int(0, len - 1) }; },
    s(I, T) { const res = (() => { let k = I.k; const ws = I.s.split(' '); T.at({ words: A(ws), k }); T.n('How many words?', ws.length, 'Split on spaces.'); for (let w = 0; w < ws.length; w++) { const L = ws[w].length, sz = L * (L + 1) / 2; T.at({ words: A(ws, { i: w }), k }); T.yn(`Does index k land inside word "${ws[w]}" (${sz} chars)?`, k < sz, k < sz ? 'Walk its letters.' : k === sz ? 'It lands on the following space.' : `Skip ${sz}, plus 1 for the space.`); if (k < sz) { for (let i = 0; i < L; i++) { if (k < i + 1) return ws[w][i]; k -= i + 1; } } if (k === sz) return ' '; k -= sz + 1; } return ' '; })(); T.yn('Is the answer a space?', res === ' ', 'k can land between words.'); return res; }
  });

  D('reverse-words-with-same-vowel-count', {
    t: 'Reverse Words With Same Vowel Count',
    r: 'Count the vowels of the first word. For every later word, count its vowels and reverse it in place (two pointers) only when the count matches.',
    g: R => ({ s: Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 5), 'abeiost')).join(' ') }),
    s(I, T) { const v = w => w.split('').filter(c => 'aeiou'.includes(c)).length, ws = I.s.split(' '), k = v(ws[0]); T.at({ words: A(ws, { i: 0 }) }); T.n('Vowels in the first word?', k, 'The count every later word is compared with.'); const out = ws.map((w, i) => { if (!i) return w; const r = v(w) === k; if (i < 6) { T.at({ words: A(ws, { i }), target: k }); T.yn(`Reverse "${w}"?`, r, `It has ${v(w)} vowels.`); } return r ? w.split('').reverse().join('') : w; }); return out.join(' '); }
  });

  D('good-indices-in-a-digit-string', {
    t: 'Good Indices in a Digit String',
    r: 'For each index i, write i in decimal (at most 6 digits) and check whether s ends with exactly those digits at position i.',
    g: R => ({ s: R.str(R.int(1, 14), '0123456789') }),
    s(I, T) { const out = []; for (let i = 0; i < I.s.length; i++) { const d = String(i), ok = i - d.length + 1 >= 0 && I.s.slice(i - d.length + 1, i + 1) === d; if (ok) out.push(i); if (i < 6 || (ok && T.asks < 8)) { T.at({ s: A(I.s.split(''), { win: [Math.max(0, i - d.length + 1), i] }) }); T.yn(`Is index ${i} good?`, ok, ok ? `The substring ending here reads "${d}".` : `It would need "${d}" ending at ${i}.`); } } return out; }
  });

  D('weighted-word-mapping', {
    t: 'Weighted Word Mapping',
    r: 'For each word add its letters\' weights, take the sum mod 26, and map r to the letter "z" − r. Concatenate the letters.',
    g: R => ({ words: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 4), 'abcde')), weights: R.ints(26, 1, 9) }),
    s(I, T) { return I.words.map((w, i) => { const s = sum(w.split('').map(ch => I.weights[ch.charCodeAt(0) - 97])), ch = String.fromCharCode(122 - s % 26); if (i < 4) { T.at({ word: A(w.split('')), weights: K(w.split('').map(c => [c, I.weights[c.charCodeAt(0) - 97]])) }); T.n(`Weight of "${w}" mod 26?`, s % 26, `Sum is ${s}.`); } return ch; }).join(''); }
  });

  D('total-distance-to-type-a-string-using-one-finger', {
    t: 'Total Distance to Type a String Using One Finger',
    r: 'Map each letter to its (row, column) on the keyboard. Start at "a" and add the Manhattan distance between consecutive keys.',
    g: R => ({ s: R.str(R.int(1, 6), 'qazplm') }),
    s(I, T) { const rows = ['qwertyuiop', 'asdfghjkl', 'zxcvbnm'], pos = {}; rows.forEach((r, i) => r.split('').forEach((c, j) => pos[c] = [i, j])); let cur = 'a', tot = 0; I.s.split('').forEach((ch, i) => { const d = Math.abs(pos[cur][0] - pos[ch][0]) + Math.abs(pos[cur][1] - pos[ch][1]); tot += d; if (i < 6) { T.at({ s: A(I.s.split(''), { i }), from: `${cur} (${pos[cur]})`, to: `${ch} (${pos[ch]})` }); T.n(`Distance from "${cur}" to "${ch}"?`, d, '|Δrow| + |Δcol|.'); } cur = ch; }); return tot; }
  });

  D('merge-close-characters', {
    t: 'Merge Close Characters',
    r: 'Simulate (n at most 100): find the smallest left index i that has an equal character within k to its right, merge the nearest such one into it (delete it), and repeat on the updated string.',
    g: R => ({ s: R.str(R.int(1, 8), 'aby'), k: R.int(1, 3) }),
    s(I, T) { let s = I.s.split(''), asks = 0; for (;;) { let hit = null; for (let i = 0; i < s.length && !hit; i++) for (let j = i + 1; j <= Math.min(s.length - 1, i + I.k); j++) if (s[j] === s[i]) { hit = [i, j]; break; } if (asks < 5) { T.at({ s: A(s.slice(), hit ? { i: hit[0], j: hit[1] } : {}), k: I.k }); T.yn('Is any merge still possible?', !!hit, hit ? `"${s[hit[1]]}" at ${hit[1]} merges into index ${hit[0]}.` : 'No equal pair within distance k.'); asks++; } if (!hit) break; s.splice(hit[1], 1); } return s.join(''); }
  });

  D('unique-email-groups', {
    t: 'Unique Email Groups',
    r: 'Normalize each address: in the local part drop everything from the first "+", remove dots and lowercase it; lowercase the domain. Put the normalized forms in a set and count it.',
    g: R => ({ emails: Array.from({ length: R.int(1, 5) }, () => `${R.pick(['a.b', 'ab', 'A.b+x', 'ab+y.z', 'b'])}@${R.pick(['d.com', 'D.com', 'e.com'])}`) }),
    s(I, T) { const set = new Set(); I.emails.forEach((e, i) => { const [l, d] = e.split('@'), n = l.split('+')[0].replace(/\./g, '').toLowerCase() + '@' + d.toLowerCase(), nw = !set.has(n); set.add(n); if (i < 6) { T.at({ email: e, groups: A([...set]) }); T.yn(`Does "${e}" (normalized to ${n}) start a new group?`, nw, nw ? 'First time this normalized address appears.' : 'Same as an earlier address.'); } }); return set.size; }
  });

  D('minimum-operations-to-sort-a-string', {
    t: 'Minimum Operations to Sort a String',
    r: 'Sorted already: 0. With 2 letters the only allowed substrings are single letters: −1. One op works if s[0] is a minimum (sort the rest) or s[n−1] is a maximum. Two ops work if a minimum sits anywhere before the end or a maximum anywhere after the start. Otherwise 3.',
    g: R => ({ s: R.str(R.int(1, 6), 'abcd') }),
    s(I, T) { const s = I.s, n = s.length, srt = s.split('').sort().join(''), mn = srt[0], mx = srt[n - 1]; T.at({ s: A(s.split('')) }); T.yn('Is s already sorted?', s === srt, s === srt ? 'No operation needed.' : 'At least one operation.'); if (s === srt) return 0; if (n === 2) { T.yn('Can a 2-letter string be fixed?', false, 'Only single letters may be sorted.'); return -1; } const one = s[0] === mn || s[n - 1] === mx; T.yn('Can one operation sort it?', one, one ? 'An end already holds its final letter: sort the rest.' : 'Neither end is in place.'); if (one) return 1; const two = s.slice(0, n - 1).includes(mn) || s.slice(1).includes(mx); T.yn('Can two operations sort it?', two, two ? 'First bring an extreme to its end, then sort the rest.' : 'The minimum is only at the end and the maximum only at the start.'); return two ? 2 : 3; }
  });

  D('sort-vowels-by-frequency', {
    t: 'Sort Vowels by Frequency',
    r: 'Count each vowel and note its first position. Order the vowels by count (high first), then by first position; write that sequence back into the vowel slots, leaving consonants in place.',
    g: R => ({ s: R.str(R.int(1, 9), 'aeiobt') }),
    s(I, T) { const V = 'aeiou', c = {}, first = {}; I.s.split('').forEach((ch, i) => { if (V.includes(ch)) { c[ch] = (c[ch] || 0) + 1; if (first[ch] === undefined) first[ch] = i; } }); const ord = Object.keys(c).sort((a, b) => c[b] - c[a] || first[a] - first[b]); T.at({ s: A(I.s.split('')), counts: K(Object.entries(c)) }); if (!ord.length) { T.yn('Are there any vowels?', false, 'Nothing to rearrange.'); T.n('Length of the result?', I.s.length, 'Unchanged.'); return I.s; } ord.slice(0, 3).forEach((v, i) => T.c(`Which vowel comes ${['first', 'second', 'third'][i]}?`, ord, v, 'Higher count first; ties by earlier first appearance.')); const seq = ord.flatMap(v => Array(c[v]).fill(v)); let p = 0; return I.s.split('').map(ch => V.includes(ch) ? seq[p++] : ch).join(''); }
  });

  D('minimum-flips-to-make-binary-string-coherent', {
    t: 'Minimum Flips to Make Binary String Coherent',
    r: 'Coherent strings are few: at most one "1", all "1"s, or exactly "1 0…0 1" (two ones at the ends, zeros between). Compute the flips for each shape and take the cheapest.',
    g: R => ({ s: R.str(R.int(1, 7), '01') }),
    s(I, T) { const s = I.s, n = s.length, ones = s.split('').filter(c => c === '1').length, a = Math.max(0, ones - 1), b = n - ones; T.at({ s: A(s.split('')) }); T.n('Flips to leave at most one "1"?', a, 'Flip all ones but one.'); T.n('Flips to make every character "1"?', b, 'Flip every zero.'); let c = Infinity; if (n >= 2) { c = (s[0] === '0') + (s[n - 1] === '0') + s.slice(1, n - 1).split('').filter(x => x === '1').length; T.n('Flips to make the shape "1 0…0 1"?', c, 'Ones at both ends, zeros inside.'); } return Math.min(a, b, c); }
  });

  D('count-valid-word-occurrences', {
    t: 'Count Valid Word Occurrences',
    r: 'Join the chunks, then scan: a word is a maximal run of letters and hyphens that sit between two letters. Split on everything else, count words in a hash map, and answer each query by lookup.',
    g: R => ({ chunks: [R.pick(['ab a-b ', 'a--b ', '-ab ']), R.pick(['ab', 'a-', 'b a'])], queries: ['ab', 'a-b', 'a', 'b'] }),
    s(I, T) { const s = I.chunks.join(''), words = []; let cur = ''; for (let i = 0; i < s.length; i++) { const ch = s[i]; if (/[a-z]/.test(ch)) cur += ch; else if (ch === '-' && i > 0 && i + 1 < s.length && /[a-z]/.test(s[i - 1]) && /[a-z]/.test(s[i + 1])) cur += ch; else { if (cur) words.push(cur); cur = ''; } } if (cur) words.push(cur); const c = new Map(); words.forEach(w => c.set(w, (c.get(w) || 0) + 1)); T.at({ s: A(s.split('')) }); T.n('How many words does s contain?', words.length, 'Letters plus joiner hyphens; anything else separates.'); return I.queries.map((q, i) => { const v = c.get(q) || 0; if (i < 3) { T.at({ words: A(words), query: q }); T.n(`Occurrences of "${q}"?`, v, 'Look it up in the word counts.'); } return v; }); }
  });

  D('check-adjacent-digit-differences', {
    t: 'Check Adjacent Digit Differences',
    r: 'Walk adjacent pairs; the first pair whose digits differ by more than 2 makes the answer false.',
    g: R => ({ s: R.str(R.int(2, 7), '0123459') }),
    s(I, T) { for (let i = 1; i < I.s.length; i++) { const d = Math.abs(I.s[i] - I.s[i - 1]), ok = d <= 2; T.at({ s: A(I.s.split(''), { i: i - 1, j: i }) }); T.yn(`Are digits ${i - 1} and ${i} close enough?`, ok, `|${I.s[i - 1]} − ${I.s[i]}| = ${d}.`); if (!ok) return false; } return true; }
  });

  D('password-strength', {
    t: 'Password Strength',
    r: 'Put characters in a set so repeats count once, then add 1 per lowercase letter, 2 per uppercase, 3 per digit and 5 per special character.',
    g: R => ({ password: R.str(R.int(1, 8), 'abAB12!#') }),
    s(I, T) { const set = [...new Set(I.password)], w = c => /[a-z]/.test(c) ? 1 : /[A-Z]/.test(c) ? 2 : /[0-9]/.test(c) ? 3 : 5; T.at({ password: A(I.password.split('')) }); T.n('How many distinct characters?', set.length, 'Repeats count once.'); let s = 0; set.slice(0, 4).forEach(c => { T.at({ distinct: A(set), char: c }); T.n(`Points for "${c}"?`, w(c), 'lower 1, upper 2, digit 3, special 5.'); }); set.forEach(c => s += w(c)); return s; }
  });

  D('transform-binary-string-using-subsequence-sort', {
    t: 'Transform Binary String Using Subsequence Sort',
    r: 'Sorting a subsequence can only move 0s left. So s can become t exactly when they have the same number of 1s and every prefix of t has at least as many 0s as the same prefix of s. For "?", fill the needed 0s into the leftmost "?"s, which maximises every prefix\'s zero count, then check.',
    g: R => { const n = R.int(1, 5); return { s: R.str(n, '01'), strs: Array.from({ length: R.int(1, 3) }, () => R.str(n, '01?')) }; },
    s(I, T) { const s = I.s, n = s.length, z = s.split('').filter(c => c === '0').length; return I.strs.map((p, qi) => { const fixedZ = p.split('').filter(c => c === '0').length, q = p.split('').filter(c => c === '?').length, need = z - fixedZ; let ok = need >= 0 && need <= q; let t = ''; if (ok) { let left = need; t = p.split('').map(c => c === '?' ? (left-- > 0 ? '0' : '1') : c).join(''); let a = 0, b = 0; for (let i = 0; i < n; i++) { if (s[i] === '0') a++; if (t[i] === '0') b++; if (b < a) ok = false; } } if (qi < 3) { T.at({ s: A(s.split('')), pattern: A(p.split('')) }); T.n(`How many "?" in pattern ${qi} must become 0?`, Math.max(need, 0), 'Zero counts must match s.'); T.yn(`Can s become pattern ${qi}?`, ok, ok ? 'Every prefix has at least as many zeros as s.' : 'Counts differ, or some prefix has too few zeros.'); } return ok; }); }
  });

  D('minimum-number-of-string-groups-through-transformations', {
    t: 'Minimum Number of String Groups Through Transformations',
    r: 'Two strings are equivalent exactly when their even-index characters are rotations of each other and so are their odd-index characters. Map each word to (smallest rotation of E, smallest rotation of O) using Booth\'s algorithm, and count distinct keys.',
    g: R => ({ words: Array.from({ length: R.int(1, 5) }, () => R.str(R.int(2, 4), 'ab')) }),
    s(I, T) { const mr = x => { let b = x; for (let i = 1; i < x.length; i++) { const r = x.slice(i) + x.slice(0, i); if (r < b) b = r; } return b; }, key = w => { const e = w.split('').filter((_, i) => i % 2 === 0).join(''), o = w.split('').filter((_, i) => i % 2).join(''); return mr(e) + '|' + mr(o); }; const ks = new Set(); I.words.forEach((w, i) => { const k = key(w); if (i < 4) { T.at({ words: A(I.words, { i }), groups: ks.size }); T.c(`Canonical key of "${w}"?`, [...new Set([k, key(w.split('').reverse().join('')), w + '|', 'no key'])], k, 'Smallest rotation of the even characters | smallest rotation of the odd ones.'); } ks.add(k); }); return ks.size; }
  });

  D('count-valid-prefixes', {
    t: 'Count Valid Prefixes',
    r: 'A binary string can be rearranged to alternate exactly when its zero and one counts differ by at most 1. Grow the prefix one character at a time and count the prefixes that pass.',
    g: R => ({ s: R.str(R.int(1, 8), '01') }),
    s(I, T) { let z = 0, o = 0, c = 0; I.s.split('').forEach((ch, i) => { ch === '0' ? z++ : o++; const ok = Math.abs(z - o) <= 1; if (ok) c++; if (i < 6) { T.at({ s: A(I.s.split(''), { i }), zeros: z, ones: o }); T.yn(`Is the prefix of length ${i + 1} valid?`, ok, `|${z} − ${o}| ${ok ? 'is at most' : 'is more than'} 1.`); } }); return c; }
  });

  D('merge-close-characters-ii', {
    t: 'Merge Close Characters II',
    r: 'Scan left to right building the result. Remember where each letter last appeared in the result; a new character is merged away (dropped) if the same letter sits within k positions before it in the result, otherwise append it. Since removals shift later indices left, distances use result positions.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc'), k: R.int(1, 3) }),
    s(I, T) { let s = I.s.split(''), asks = 0; for (;;) { let found = null; for (let i = 0; i < s.length && !found; i++) for (let j = i + 1; j <= Math.min(s.length - 1, i + I.k); j++) if (s[i] === s[j]) { found = [i, j]; break; } if (!found) break; if (asks++ < 4) { T.at({ s: A(s.slice(), { i: found[0], j: found[1] }), k: I.k }); T.n('Which index gets removed next?', found[1], `Smallest i with a close twin; s[${found[0]}] = s[${found[1]}].`); } s.splice(found[1], 1); } if (!asks) { T.at({ s: A(s), k: I.k }); T.yn('Is there any close pair?', false, 'Nothing within k matches.'); T.n('Length of the result?', s.length, 'Unchanged.'); } return s.join(''); }
  });

  D('minimum-operations-to-make-a-rotated-palindrome-i', {
    t: 'Minimum Operations to Make a Rotated Palindrome I',
    r: 'Try every rotation r (cost r). For the rotated string, each mirrored pair (a, b) costs the shorter cyclic increment distance: min((b − a) mod 26, (a − b) mod 26). Sum the pairs, add r, take the minimum.',
    g: R => ({ s: R.str(R.int(2, 5), 'abcyz') }),
    s(I, T) { const s = I.s, n = s.length, pc = t => { let c = 0; for (let i = 0; i < n >> 1; i++) { const d = ((t.charCodeAt(i) - t.charCodeAt(n - 1 - i)) % 26 + 26) % 26; c += Math.min(d, 26 - d); } return c; }; let best = Infinity; for (let r = 0; r < n; r++) { const t = s.slice(r) + s.slice(0, r), c = r + pc(t); best = Math.min(best, c); if (r < 3) { T.at({ rotated: A(t.split('')), rotations: r }); T.n(`Total cost with ${r} left rotation${r === 1 ? '' : 's'}?`, c, 'Rotations plus the cyclic distance of each mirrored pair.'); } } return best; }
  });

  D('minimum-operations-to-make-a-rotated-palindrome-ii', {
    t: 'Minimum Operations to Make a Rotated Palindrome II',
    r: 'n is now 5 times 10 to the power 4, so you cannot re-price all n rotations pair by pair. Treat the string as cyclic: rotation r pairs position r + i with r − 1 − i. Group the pair costs by i + j mod n (the "anti-diagonal" each rotation uses), computed with 26 convolutions or an FFT over letter indicators, then add r.',
    g: R => ({ s: R.str(R.int(2, 5), 'abcyz') }),
    s(I, T) { const s = I.s, n = s.length, pc = t => { let c = 0; for (let i = 0; i < n >> 1; i++) { const d = ((t.charCodeAt(i) - t.charCodeAt(n - 1 - i)) % 26 + 26) % 26; c += Math.min(d, 26 - d); } return c; }; const cost = range(0, n).map(r => pc(s.slice(r) + s.slice(0, r))); T.at({ s: A(s.split('')) }); T.n('Pair cost with no rotation?', cost[0], 'Sum of cyclic distances of mirrored letters.'); if (n > 1) T.n('Pair cost after one rotation?', cost[1], 'The mirror pairs shift by one.'); const best = Math.min(...cost.map((c, r) => c + r)); T.n('Best total including rotation cost?', best, 'Minimise pair cost + r.'); return best; }
  });
})();
