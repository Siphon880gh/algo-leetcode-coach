/* v2 games: strings (02). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const cnt = s => { const m = {}; for (const c of s) m[c] = (m[c] || 0) + 1; return m; };
  const chars = s => A([...s]);
  const words = (R, n, al, lo, hi) => Array.from({ length: n }, () => R.str(R.int(lo || 1, hi || 4), al || 'abc'));

  D('word-subsets', {
    t: 'Word Subsets: merge requirements by max count',
    r: 'Combine words2 into one requirement: for each letter, the max count over all b. A word in words1 is universal iff it meets that requirement.',
    g: R => ({ words1: words(R, R.int(1, 5), 'abc', 1, 5), words2: words(R, R.int(1, 3), 'abc', 1, 2) }),
    s(I, T) { const need = {}; for (const b of I.words2) { const c = cnt(b); for (const k in c) need[k] = Math.max(need[k] || 0, c[k]); } T.at({ words2: A(I.words2), need: K(need) }); T.n(`Merged requirement for '${Object.keys(need)[0]}'?`, need[Object.keys(need)[0]], 'Max count across words2.'); return I.words1.filter(w => { const c = cnt(w); return Object.keys(need).every(k => (c[k] || 0) >= need[k]); }); }
  });

  D('unique-email-addresses', {
    t: 'Unique Email Addresses: normalize the local name',
    r: 'In the local name, drop everything after the first "+" and remove dots; the domain stays. Count distinct normalized addresses.',
    g: R => ({ emails: Array.from({ length: R.int(1, 4) }, () => R.pick(['a.b', 'ab', 'a', 'ab+x', 'a.b+c.d']) + '@' + R.pick(['x.com', 'y.com'])) }),
    s(I, T) { const set = new Set(); for (const e of I.emails) { const [l, d] = e.split('@'), n = l.split('+')[0].replace(/\./g, '') + '@' + d; T.at({ email: e, seen: A([...set]) }); T.c(`Normalized form of "${e}"?`, [...new Set([n, e, l.replace(/\./g, '') + '@' + d])], n, 'Cut at +, drop dots, keep the domain.'); set.add(n); } return set.size; }
  });

  D('reorder-data-in-log-files', {
    t: 'Reorder Log Files: letter logs sorted, digit logs kept',
    r: 'Letter-logs come first, sorted by content then identifier; digit-logs follow in their original order.',
    g: R => ({ logs: Array.from({ length: R.int(1, 5) }, (_, i) => `${'abc'[i % 3]}${i} ` + (R.chance(0.5) ? Array.from({ length: R.int(1, 2) }, () => R.int(0, 9)).join(' ') : Array.from({ length: R.int(1, 2) }, () => R.pick(['art', 'can', 'own'])).join(' '))) }),
    s(I, T) { const L = [], Dg = []; for (const g of I.logs) { const body = g.slice(g.indexOf(' ') + 1), dig = /^\d/.test(body); T.at({ log: g }); T.c('Which kind of log?', ['letter', 'digit'], dig ? 'digit' : 'letter', 'Look at the first word after the identifier.'); (dig ? Dg : L).push(g); } L.sort((a, b) => { const x = a.slice(a.indexOf(' ') + 1), y = b.slice(b.indexOf(' ') + 1); return x < y ? -1 : x > y ? 1 : a < b ? -1 : a > b ? 1 : 0; }); return [...L, ...Dg]; }
  });

  D('delete-columns-to-make-sorted', {
    t: 'Delete Columns to Make Sorted: count unsorted columns',
    r: 'A column must be deleted if any row has a smaller letter than the row above it in that column.',
    g: R => { const m = R.int(1, 4); return { strs: words(R, R.int(1, 4), 'abc', m, m) }; },
    s(I, T) { let d = 0; for (let j = 0; j < I.strs[0].length; j++) { const bad = I.strs.some((w, i) => i && w[j] < I.strs[i - 1][j]); T.at({ grid: G(I.strs.map(w => [...w]), { cols: [j] }) }); T.yn(`Must column ${j} be deleted?`, bad, 'Is it out of order anywhere?'); if (bad) d++; } return d; }
  });

  D('largest-time-for-given-digits', {
    t: 'Largest Time for Given Digits: try all permutations',
    r: 'Try all 24 orderings; keep those with HH < 24 and MM < 60; return the latest as "HH:MM" (or "").',
    g: R => ({ arr: R.ints(4, 0, 6) }),
    s(I, T) { let best = -1; const a = I.arr; for (let i = 0; i < 4; i++) for (let j = 0; j < 4; j++) for (let k = 0; k < 4; k++) { if (i === j || j === k || i === k) continue; const l = 6 - i - j - k, h = a[i] * 10 + a[j], m = a[k] * 10 + a[l]; if (h < 24 && m < 60) best = Math.max(best, h * 60 + m); } T.at({ digits: A(a) }); T.yn('Can any valid time be made?', best >= 0, 'Some ordering with HH < 24 and MM < 60.'); return best < 0 ? '' : String(Math.floor(best / 60)).padStart(2, '0') + ':' + String(best % 60).padStart(2, '0'); }
  });

  D('verifying-an-alien-dictionary', {
    t: 'Verifying an Alien Dictionary: compare neighbors',
    r: 'Rank letters by the alien order. Each adjacent pair must be in order: compare at the first differing letter; if none, the shorter word must come first.',
    g: R => ({ words: words(R, R.int(2, 4), 'abc', 1, 3), order: R.shuffle([...'abcdefghijklmnopqrstuvwxyz']).join('') }),
    s(I, T) { const rk = {}; [...I.order].forEach((c, i) => rk[c] = i); for (let i = 1; i < I.words.length; i++) { const a = I.words[i - 1], b = I.words[i]; let ok = a.length <= b.length; for (let j = 0; j < Math.min(a.length, b.length); j++) if (a[j] !== b[j]) { ok = rk[a[j]] < rk[b[j]]; break; } T.at({ order: I.order.slice(0, 8) + '…', pair: A([a, b]) }); T.yn(`Is "${a}" ≤ "${b}" in alien order?`, ok, 'First differing letter decides.'); if (!ok) return false; } return true; }
  });

  D('vowel-spellchecker', {
    t: 'Vowel Spellchecker: exact, case-insensitive, vowel-insensitive',
    r: 'Check exact match; else the first word matching case-insensitively; else the first word matching with vowels as wildcards; else "".',
    g: R => ({ wordlist: words(R, R.int(1, 4), 'kKiItT', 2, 3), queries: words(R, R.int(1, 4), 'kKiIeTt', 2, 3) }),
    s(I, T) { const ex = new Set(I.wordlist), ci = new Map(), vi = new Map(), dv = w => w.toLowerCase().replace(/[aeiou]/g, '*'); for (const w of I.wordlist) { if (!ci.has(w.toLowerCase())) ci.set(w.toLowerCase(), w); if (!vi.has(dv(w))) vi.set(dv(w), w); } return I.queries.map(q => { const lvl = ex.has(q) ? 'exact' : ci.has(q.toLowerCase()) ? 'case' : vi.has(dv(q)) ? 'vowel' : 'none'; T.at({ wordlist: A(I.wordlist), query: q }); T.c(`Which rule matches "${q}"?`, ['exact', 'case', 'vowel', 'none'], lvl, 'Try the rules in order.'); return lvl === 'exact' ? q : lvl === 'case' ? ci.get(q.toLowerCase()) : lvl === 'vowel' ? vi.get(dv(q)) : ''; }); }
  });

  D('find-common-characters', {
    t: 'Find Common Characters: min counts',
    r: 'Take the minimum count of each letter across all words; output each letter that many times.',
    cmp: 'set',
    g: R => ({ words: words(R, R.int(1, 4), 'abcl', 2, 5) }),
    s(I, T) { let m = cnt(I.words[0]); for (const w of I.words.slice(1)) { const c = cnt(w); for (const k in m) m[k] = Math.min(m[k], c[k] || 0); } T.at({ words: A(I.words), common: K(m) }); const out = Object.keys(m).flatMap(k => Array(m[k]).fill(k)); T.n('How many characters are common?', out.length, 'Sum of min counts.'); return out; }
  });

  D('occurrences-after-bigram', {
    t: 'Occurrences After Bigram',
    r: 'Scan word triples; when words i, i+1 are first and second, collect word i+2.',
    g: R => ({ text: Array.from({ length: R.int(3, 8) }, () => R.pick(['a', 'b', 'c'])).join(' '), first: 'a', second: 'b' }),
    s(I, T) { const w = I.text.split(' '), out = []; for (let i = 0; i + 2 < w.length; i++) if (w[i] === I.first && w[i + 1] === I.second) { T.at({ words: A(w, { hl: [i, i + 1] }) }); T.c('Word that follows?', [...new Set([w[i + 2], 'a', 'b', 'c'])], w[i + 2], 'The third word.'); out.push(w[i + 2]); } if (!out.length) { T.at({ words: A(w) }); T.yn(`Does "${I.first} ${I.second}" appear with a following word?`, false, 'No match.'); } return out; }
  });

  D('defanging-an-ip-address', {
    t: 'Defanging an IP Address',
    r: 'Replace every "." with "[.]".',
    g: R => ({ address: Array.from({ length: 4 }, () => R.int(0, 255)).join('.') }),
    s(I, T) { T.at({ address: I.address }); T.n('How many dots to replace?', 3, 'An IPv4 address has 4 parts.'); return I.address.split('.').join('[.]'); }
  });

  D('remove-vowels-from-a-string', {
    t: 'Remove Vowels from a String',
    r: 'Keep only characters that are not a, e, i, o, u.',
    g: R => ({ s: R.str(R.int(1, 8), 'aeiolcd') }),
    s(I, T) { const v = [...I.s].filter(c => 'aeiou'.includes(c)).length; T.at({ s: chars(I.s) }); T.n('How many vowels are removed?', v, 'Count a, e, i, o, u.'); return I.s.replace(/[aeiou]/g, ''); }
  });

  D('alphabet-board-path', {
    t: 'Alphabet Board Path: up/left before down/right',
    r: 'Letter c sits at (⌊c/5⌋, c mod 5). Move U and L first, then D and R, so you never step off the board around "z".',
    g: R => ({ target: R.str(R.int(1, 4), 'abcelotz') }),
    s(I, T) { let r = 0, c = 0, out = ''; for (const ch of I.target) { const k = ch.charCodeAt(0) - 97, nr = Math.floor(k / 5), nc = k % 5; T.at({ at: `(${r},${c})`, to: ch }); T.n(`Row of '${ch}'?`, nr, `⌊${k}/5⌋.`); if (nr < r) out += 'U'.repeat(r - nr); if (nc < c) out += 'L'.repeat(c - nc); if (nr > r) out += 'D'.repeat(nr - r); if (nc > c) out += 'R'.repeat(nc - c); out += '!'; r = nr; c = nc; } return out; }
  });

  D('find-words-that-can-be-formed-by-characters', {
    t: 'Words Formed by Characters',
    r: 'A word is good if its letter counts fit within chars\' counts; sum the lengths of good words.',
    g: R => ({ words: words(R, R.int(1, 4), 'abct', 1, 4), chars: R.str(R.int(1, 6), 'abct') }),
    s(I, T) { const c = cnt(I.chars); let s = 0; for (const w of I.words) { const m = cnt(w), ok = Object.keys(m).every(k => (c[k] || 0) >= m[k]); T.at({ chars: K(c), word: w }); T.yn(`Can "${w}" be formed?`, ok, 'Each letter used at most its count.'); if (ok) s += w.length; } return s; }
  });

  D('single-row-keyboard', {
    t: 'Single-Row Keyboard: sum of finger moves',
    r: 'Record each letter\'s position; total time = Σ |pos(next) − pos(current)| starting at 0.',
    g: R => ({ keyboard: R.shuffle([...'abcdefghijklmnopqrstuvwxyz']).join(''), word: R.str(R.int(1, 4), 'abcde') }),
    s(I, T) { let p = 0, t = 0; for (const c of I.word) { const q = I.keyboard.indexOf(c); T.at({ at: p, key: c }); T.n(`Move cost to '${c}'?`, Math.abs(q - p), `|${q} − ${p}|.`); t += Math.abs(q - p); p = q; } return t; }
  });

  D('invalid-transactions', {
    t: 'Invalid Transactions: amount or nearby other-city',
    r: 'A transaction is invalid if its amount > 1000, or another transaction with the same name in a different city is within 60 minutes.',
    cmp: 'set',
    g: R => ({ transactions: Array.from({ length: R.int(1, 4) }, () => `${R.pick(['alice', 'bob'])},${R.int(0, 120)},${R.pick([100, 800, 1200])},${R.pick(['mtv', 'nyc'])}`) }),
    s(I, T) { const t = I.transactions.map(x => x.split(',')); return I.transactions.filter((x, i) => { const [n, tm, am, c] = t[i]; const bad = +am > 1000 || t.some(([n2, t2, , c2], j) => j !== i && n2 === n && c2 !== c && Math.abs(+t2 - +tm) <= 60); T.at({ tx: x }); T.yn(`Is "${x}" invalid?`, bad, 'Amount > 1000 or same name, other city, ≤ 60 min apart.'); return bad; }); }
  });

  D('before-and-after-puzzle', {
    t: 'Before and After Puzzle: last word meets first word',
    r: 'For every ordered pair i ≠ j where the last word of phrase i equals the first word of phrase j, join them sharing that word. Return distinct results sorted.',
    g: R => ({ phrases: Array.from({ length: R.int(2, 4) }, () => Array.from({ length: R.int(1, 3) }, () => R.pick(['a', 'b', 'c'])).join(' ')) }),
    s(I, T) { const set = new Set(), p = I.phrases; for (let i = 0; i < p.length; i++) for (let j = 0; j < p.length; j++) { if (i === j) continue; const a = p[i].split(' '), b = p[j].split(' '); if (a[a.length - 1] === b[0]) set.add([...a, ...b.slice(1)].join(' ')); } T.at({ phrases: A(p) }); T.n('How many distinct puzzles?', set.size, 'Pairs whose ends match.'); return [...set].sort(); }
  });

  D('maximum-number-of-balloons', {
    t: 'Maximum Number of Balloons',
    r: '"balloon" needs b, a, n once and l, o twice. The answer is the min of count(b), count(a), count(l)/2, count(o)/2, count(n).',
    g: R => ({ text: R.str(R.int(3, 14), 'balonx') }),
    s(I, T) { const c = cnt(I.text), v = Math.min(c.b || 0, c.a || 0, Math.floor((c.l || 0) / 2), Math.floor((c.o || 0) / 2), c.n || 0); T.at({ counts: K(c) }); T.n('Copies available from l alone?', Math.floor((c.l || 0) / 2), 'Two l per balloon.'); return v; }
  });

  D('decrypt-string-from-alphabet-to-integer-mapping', {
    t: 'Decrypt String: look ahead for #',
    r: 'At index i, if s[i+2] is "#", read two digits (10–26 → j–z); else read one digit (1–9 → a–i).',
    g: R => ({ s: Array.from({ length: R.int(1, 4) }, () => { const v = R.int(1, 26); return v > 9 ? v + '#' : String(v); }).join('') }),
    s(I, T) { let i = 0, out = ''; while (i < I.s.length) { const two = I.s[i + 2] === '#', v = two ? +I.s.slice(i, i + 2) : +I.s[i]; T.at({ s: chars(I.s), at: i }); T.c('Letter here?', [...new Set([String.fromCharCode(96 + v), String.fromCharCode(96 + +I.s[i]), 'z'])], String.fromCharCode(96 + v), two ? 'Two digits then #.' : 'Single digit.'); out += String.fromCharCode(96 + v); i += two ? 3 : 1; } return out; }
  });

  D('distinct-echo-substrings', {
    t: 'Distinct Echo Substrings: a + a',
    r: 'For each start and half-length L, the substring is an echo if text[i..i+L) equals text[i+L..i+2L). Count distinct ones (hashing makes the comparison O(1)).',
    g: R => ({ text: R.str(R.int(1, 9), 'ab') }),
    s(I, T) { const s = I.text, set = new Set(); for (let L = 1; 2 * L <= s.length; L++) { let k = 0; for (let i = 0; i + 2 * L <= s.length; i++) if (s.substr(i, L) === s.substr(i + L, L)) { set.add(s.substr(i, 2 * L)); k++; } if (L <= 3) { T.at({ text: chars(s), half: L }); T.n(`Echo positions with half-length ${L}?`, k, 'Compare the two halves.'); } } return set.size; }
  });

  D('print-words-vertically', {
    t: 'Print Words Vertically',
    r: 'Row j takes the j-th letter of each word (space if too short); trim trailing spaces.',
    g: R => ({ s: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 3), 'ABC')).join(' ') }),
    s(I, T) { const w = I.s.split(' '), m = Math.max(...w.map(x => x.length)), out = []; T.at({ words: A(w) }); T.n('How many output rows?', m, 'Length of the longest word.'); for (let j = 0; j < m; j++) out.push(w.map(x => x[j] || ' ').join('').replace(/ +$/, '')); return out; }
  });

  D('minimum-number-of-steps-to-make-two-strings-anagram', {
    t: 'Steps to Make an Anagram: surplus letters',
    r: 'Count s up and t down; the answer is the total positive surplus (letters t is missing).',
    g: R => { const n = R.int(1, 7); return { s: R.str(n, 'abc'), t: R.str(n, 'abc') }; },
    s(I, T) { const c = cnt(I.s); for (const x of I.t) c[x] = (c[x] || 0) - 1; T.at({ diff: K(c) }); const v = Object.values(c).reduce((a, b) => a + Math.max(0, b), 0); T.n('Replacements needed?', v, 'Sum of positive differences.'); return v; }
  });

  D('increasing-decreasing-string', {
    t: 'Increasing Decreasing String: sweep counts up and down',
    r: 'Using letter counts, repeatedly sweep a→z taking one of each available letter, then z→a, until all are used.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc') }),
    s(I, T) { const c = Array(26).fill(0); for (const x of I.s) c[x.charCodeAt(0) - 97]++; let out = '', pass = 0; while (out.length < I.s.length) { const ord = pass % 2 ? [...Array(26).keys()].reverse() : [...Array(26).keys()]; let piece = ''; for (const i of ord) if (c[i]) { c[i]--; piece += String.fromCharCode(97 + i); } T.at({ out, pass: pass % 2 ? 'down' : 'up' }); T.n('Letters taken in this sweep?', piece.length, 'One of each remaining letter.'); out += piece; pass++; } return out; }
  });

  D('generate-a-string-with-characters-that-have-odd-counts', {
    t: 'String With Odd Counts',
    r: 'If n is odd, n copies of one letter work. If n is even, use n − 1 copies plus one different letter.',
    cmp: (o, e, I) => typeof o === 'string' && o.length === I.n && /^[a-z]*$/.test(o) && Object.values(cnt(o)).every(x => x % 2 === 1),
    g: R => ({ n: R.int(1, 12) }),
    s(I, T) { T.at({ n: I.n }); T.yn('Is n odd?', I.n % 2 === 1, 'Odd n → a single repeated letter.'); return I.n % 2 ? 'a'.repeat(I.n) : 'a'.repeat(I.n - 1) + 'b'; }
  });

  D('longest-happy-prefix', {
    t: 'Longest Happy Prefix: prefix function',
    r: 'The KMP prefix function\'s last value is the length of the longest proper prefix that is also a suffix.',
    g: R => ({ s: R.str(R.int(1, 9), 'ab') }),
    s(I, T) { const s = I.s, pi = Array(s.length).fill(0); for (let i = 1; i < s.length; i++) { let k = pi[i - 1]; while (k && s[i] !== s[k]) k = pi[k - 1]; if (s[i] === s[k]) k++; pi[i] = k; if (i <= 6) { T.at({ s: chars(s), pi: A(pi.slice(0, i + 1)) }); T.n(`pi[${i}]?`, k, 'Extend or fall back.'); } } return s.slice(0, pi[s.length - 1] || 0); }
  });

  D('string-matching-in-an-array', {
    t: 'String Matching in an Array',
    r: 'Keep each word that is a substring of some other word.',
    cmp: 'set',
    g: R => ({ words: [...new Set(words(R, R.int(2, 5), 'ab', 1, 4))] }),
    s(I, T) { return I.words.filter((w, i) => { const ok = I.words.some((x, j) => j !== i && x.includes(w)); T.at({ words: A(I.words, { hl: [i] }) }); T.yn(`Is "${w}" inside another word?`, ok, 'Substring check.'); return ok; }); }
  });

  D('html-entity-parser', {
    t: 'HTML Entity Parser: replace known entities',
    r: 'Scan for "&…;" and replace only &quot; &apos; &amp; &gt; &lt; &frasl;. Process left to right so "&amp;gt;" becomes "&gt;", not ">".',
    g: R => ({ text: Array.from({ length: R.int(1, 4) }, () => R.pick(['&amp;', '&gt;', '&lt;', '&quot;', '&x;', 'a', ' ', '&amp;gt;'])).join('') }),
    s(I, T) { const E = { '&quot;': '"', '&apos;': "'", '&amp;': '&', '&gt;': '>', '&lt;': '<', '&frasl;': '/' }; let out = '', i = 0, k = 0; while (i < I.text.length) { let hit = null; if (I.text[i] === '&') for (const e in E) if (I.text.startsWith(e, i)) hit = e; if (hit) { out += E[hit]; i += hit.length; k++; } else out += I.text[i++]; } T.at({ text: I.text }); T.n('How many entities are replaced?', k, 'Known entities only, left to right.'); return out; }
  });

  D('reformat-the-string', {
    t: 'Reformat the String: alternate letters and digits',
    r: 'Split letters and digits. If their counts differ by more than 1, return "". Otherwise alternate, starting with the larger group.',
    cmp: (o, e) => e === '' ? o === '' : typeof o === 'string' && [...o].sort().join('') === [...e].sort().join('') && [...o].every((c, i) => !i || /\d/.test(c) !== /\d/.test(o[i - 1])),
    g: R => ({ s: R.str(R.int(1, 7), 'ab12') }),
    s(I, T) { const L = [...I.s].filter(c => /[a-z]/.test(c)), Dg = [...I.s].filter(c => /\d/.test(c)); T.at({ letters: A(L), digits: A(Dg) }); T.yn('Is a valid alternation possible?', Math.abs(L.length - Dg.length) <= 1, 'Counts differ by at most 1.'); if (Math.abs(L.length - Dg.length) > 1) return ''; const [a, b] = L.length >= Dg.length ? [L, Dg] : [Dg, L]; let out = ''; for (let i = 0; i < a.length; i++) out += a[i] + (b[i] || ''); return out; }
  });

  D('destination-city', {
    t: 'Destination City: no outgoing path',
    r: 'Collect all source cities; the destination is the one city that only appears as a target.',
    g: R => { const c = R.shuffle(['A', 'B', 'C', 'D', 'E']).slice(0, R.int(2, 5)); return { paths: R.shuffle(c.slice(1).map((x, i) => [c[i], x])) }; },
    s(I, T) { const src = new Set(I.paths.map(p => p[0])); T.at({ paths: A(I.paths.map(p => p.join('→'))), sources: A([...src]) }); const d = I.paths.find(p => !src.has(p[1]))[1]; T.c('Destination city?', [...new Set(I.paths.flat())], d, 'Never a source.'); return d; }
  });

  D('consecutive-characters', {
    t: 'Consecutive Characters: longest run',
    r: 'Track the current run length (reset when the letter changes) and the best run.',
    g: R => ({ s: R.str(R.int(1, 10), 'aab') }),
    s(I, T) { let run = 1, best = 1; for (let i = 1; i < I.s.length; i++) { run = I.s[i] === I.s[i - 1] ? run + 1 : 1; best = Math.max(best, run); if (i <= 8) { T.at({ s: chars(I.s), at: i }); T.n(`Run length ending at ${i}?`, run, 'Extend if the same letter.'); } } if (I.s.length === 1) T.n('Power of a one-letter string?', 1, 'One run.'); return best; }
  });

  D('rearrange-words-in-a-sentence', {
    t: 'Rearrange Words by Length: stable sort',
    r: 'Lower-case all words, stable-sort by length, then capitalize the first word.',
    g: R => { const w = Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 4), 'abc')); w[0] = w[0][0].toUpperCase() + w[0].slice(1); return { text: w.join(' ') }; },
    s(I, T) { const w = I.text.toLowerCase().split(' '), s = w.slice().sort((a, b) => a.length - b.length); T.at({ words: A(w) }); T.c('Which word comes first?', [...new Set(w)], s[0], 'Shortest; ties keep the original order.'); s[0] = s[0][0].toUpperCase() + s[0].slice(1); return s.join(' '); }
  });

  D('people-whose-list-of-favorite-companies-is-not-a-subset-of-another-list', {
    t: 'Favorite Companies Not a Subset',
    r: 'For each person, check whether their set is contained in some other person\'s set; keep those that are not.',
    g: R => ({ favoriteCompanies: (() => { const out = []; while (out.length < R.int(2, 5)) { const l = [...new Set(Array.from({ length: R.int(1, 3) }, () => R.pick(['a', 'b', 'c', 'd'])))]; if (!out.some(x => x.length === l.length && x.every(y => l.includes(y)))) out.push(l); } return out; })() }),
    s(I, T) { const sets = I.favoriteCompanies.map(l => new Set(l)); return I.favoriteCompanies.map((l, i) => i).filter(i => { const sub = sets.some((s, j) => j !== i && I.favoriteCompanies[i].every(x => s.has(x))); T.at({ lists: A(I.favoriteCompanies.map(x => x.join(',')), { hl: [i] }) }); T.yn(`Is list ${i} a subset of another?`, sub, 'Every company appears in some other list.'); return !sub; }); }
  });

  D('check-if-a-word-occurs-as-a-prefix-of-any-word-in-a-sentence', {
    t: 'Search Word as a Prefix',
    r: 'Return the 1-based index of the first word that starts with searchWord, or −1.',
    g: R => ({ sentence: Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 4), 'ab')).join(' '), searchWord: R.str(R.int(1, 2), 'ab') }),
    s(I, T) { const w = I.sentence.split(' '); for (let i = 0; i < w.length; i++) { const ok = w[i].startsWith(I.searchWord); T.at({ words: A(w, { hl: [i] }), search: I.searchWord }); T.yn(`Does "${w[i]}" start with "${I.searchWord}"?`, ok, 'Prefix check.'); if (ok) return i + 1; } return -1; }
  });

  D('making-file-names-unique', {
    t: 'Making File Names Unique: next free suffix',
    r: 'Keep a map name → next k to try. If a name is taken, try name(k), name(k+1)… until free; record both the result and the updated k.',
    g: R => ({ names: Array.from({ length: R.int(1, 6) }, () => R.pick(['a', 'a', 'b', 'a(1)', 'a(2)'])) }),
    s(I, T) { const used = new Map(), out = []; for (const n of I.names) { let r = n; if (used.has(n)) { let k = used.get(n); while (used.has(`${n}(${k})`)) k++; r = `${n}(${k})`; used.set(n, k + 1); } used.set(r, used.get(r) || 1); T.at({ name: n, taken: A([...used.keys()]) }); T.c(`Final name for "${n}"?`, [...new Set([r, n, n + '(1)', n + '(2)'])], r, 'Smallest free suffix.'); out.push(r); } return out; }
  });

  D('path-crossing', {
    t: 'Path Crossing: visited set',
    r: 'Walk the path recording visited points; return true the first time you step on a visited point.',
    g: R => ({ path: R.str(R.int(1, 8), 'NESW') }),
    s(I, T) { let x = 0, y = 0; const seen = new Set(['0,0']); for (const c of I.path) { if (c === 'N') y++; else if (c === 'S') y--; else if (c === 'E') x++; else x--; const k = x + ',' + y; T.at({ path: chars(I.path), at: `(${x},${y})` }); T.yn(`Is (${x},${y}) already visited?`, seen.has(k), 'Check the set.'); if (seen.has(k)) return true; seen.add(k); } return false; }
  });

  D('reformat-date', {
    t: 'Reformat Date: Day Month Year → YYYY-MM-DD',
    r: 'Strip the day suffix, map the month name to 01–12, pad, and reorder.',
    g: R => ({ date: (d => d + (d % 10 === 1 && d !== 11 ? 'st' : d % 10 === 2 && d !== 12 ? 'nd' : d % 10 === 3 && d !== 13 ? 'rd' : 'th'))(R.int(1, 28)) + ' ' + R.pick(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']) + ' ' + R.int(1900, 2100) }),
    s(I, T) { const [d, m, y] = I.date.split(' '), M = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'].indexOf(m) + 1; T.at({ date: I.date }); T.n(`Month number of ${m}?`, M, 'Jan = 1.'); return `${y}-${String(M).padStart(2, '0')}-${String(parseInt(d)).padStart(2, '0')}`; }
  });

  D('shuffle-string', {
    t: 'Shuffle String: place by index',
    r: 'Put s[i] at position indices[i] of the result.',
    g: R => { const n = R.int(1, 7); return { s: R.str(n, 'abcde'), indices: R.perm(n) }; },
    s(I, T) { const out = Array(I.s.length); I.indices.forEach((j, i) => out[j] = I.s[i]); const j0 = I.indices.indexOf(0); T.at({ s: chars(I.s), indices: A(I.indices) }); T.c('First character of the result?', [...new Set([I.s[j0], I.s[0]])], I.s[j0], `Index ${j0} maps to 0.`); return out.join(''); }
  });

  D('can-convert-string-in-k-moves', {
    t: 'Convert String in k Moves: shifts collide every 26',
    r: 'Each position needs shift d = (t − s) mod 26. The j-th position needing the same d must use move d + 26·(j − 1). All must be ≤ k.',
    g: R => { const n = R.int(1, 6); return { s: R.str(n, 'abc'), t: R.str(R.chance(0.9) ? n : n + 1, 'abc'), k: R.int(0, 40) }; },
    s(I, T) { if (I.s.length !== I.t.length) { T.at({ s: I.s, t: I.t }); T.yn('Same length?', false, 'Conversion keeps the length.'); return false; } const used = {}; for (let i = 0; i < I.s.length; i++) { const d = (I.t.charCodeAt(i) - I.s.charCodeAt(i) + 26) % 26; if (!d) continue; const mv = d + 26 * (used[d] || 0); used[d] = (used[d] || 0) + 1; T.at({ s: chars(I.s), t: chars(I.t), at: i }); T.n(`Move number needed for index ${i}?`, mv, `Shift ${d}, used ${used[d] - 1} times before.`); if (mv > I.k) return false; } return true; }
  });

  D('find-kth-bit-in-nth-binary-string', {
    t: 'Kth Bit in Nth Binary String: mirror recursion',
    r: 'S_n has length 2^n − 1 with middle 1. If k is the middle, answer 1; left half recurses into S_{n−1}; right half mirrors to position 2^n − k and inverts.',
    g: R => { const n = R.int(1, 5); return { n, k: R.int(1, 2 ** n - 1) }; },
    s(I, T) { let n = I.n, k = I.k, inv = 0; while (n > 1) { const mid = 2 ** (n - 1); T.at({ n, k, inverted: inv }); T.c('Where is k?', ['middle', 'left', 'right'], k === mid ? 'middle' : k < mid ? 'left' : 'right', `Middle is ${mid}.`); if (k === mid) return String(1 ^ inv); if (k > mid) { k = 2 ** n - k; inv ^= 1; } n--; } return String(inv); }
  });

  D('strings-differ-by-one-character', {
    t: 'Strings Differ by One Character: wildcard keys',
    r: 'For each string and position, replace that character with "*"; if two strings produce the same key, they differ by exactly one character there.',
    g: R => { const m = R.int(1, 4); return { dict: [...new Set(words(R, R.int(2, 5), 'abc', m, m))] }; },
    s(I, T) { const m = I.dict[0].length; for (let j = 0; j < m; j++) { const seen = new Set(); for (const w of I.dict) { const k = w.slice(0, j) + '*' + w.slice(j + 1); if (seen.has(k)) { T.at({ dict: A(I.dict), position: j }); T.yn(`Does key "${k}" repeat?`, true, 'Two strings differ only here.'); return true; } seen.add(k); } T.at({ dict: A(I.dict), keys: A([...seen]) }); T.yn(`Any repeated key at position ${j}?`, false, 'All keys distinct.'); } return false; }
  });

  D('thousand-separator', {
    t: 'Thousand Separator',
    r: 'Insert a dot every three digits counting from the right.',
    g: R => ({ n: R.int(0, 10 ** R.int(1, 9)) }),
    s(I, T) { const s = String(I.n); T.at({ n: s }); T.n('How many dots?', Math.floor((s.length - 1) / 3), 'One per group of three after the first.'); let out = ''; for (let i = 0; i < s.length; i++) { if (i && (s.length - i) % 3 === 0) out += '.'; out += s[i]; } return out; }
  });
})();
