/* v2 games: strings (01). */
(function () {
  'use strict';
  const { D, A, K, X } = LCGame.H;
  const cnt = s => { const m = {}; for (const c of s) m[c] = (m[c] || 0) + 1; return m; };
  const chars = s => A([...s]);
  const words = (R, n, al, lo, hi) => Array.from({ length: n }, () => R.str(R.int(lo || 1, hi || 4), al || 'abc'));

  D('string-to-integer-atoi', {
    t: 'String to Integer (atoi): skip, sign, digits, clamp',
    r: 'Skip leading spaces, read one optional sign, read digits until a non-digit, then clamp to [−2^31, 2^31 − 1].',
    g: R => ({ s: R.pick(['', ' ', '  ']) + R.pick(['', '-', '+']) + R.str(R.int(0, 2), '0') + R.str(R.int(0, 6), '0123456789') + R.pick(['', 'abc', ' 42', '.5']) + (R.chance(0.15) ? '99999999999' : '') }),
    s(I, T) { const s = I.s; let i = 0; while (s[i] === ' ') i++; T.at({ s: chars(s) }); T.n('Index of the first non-space character?', i, 'Skip leading spaces.'); let sg = 1; if (s[i] === '-' || s[i] === '+') { sg = s[i] === '-' ? -1 : 1; i++; } T.n('Sign (1 or −1)?', sg, 'At most one sign.'); let v = 0; while (i < s.length && s[i] >= '0' && s[i] <= '9') { v = v * 10 + (+s[i]); i++; if (v > 2 ** 31) break; } const r = Math.max(-(2 ** 31), Math.min(2 ** 31 - 1, sg * v)); T.n('Result after clamping?', r === 0 ? 0 : r, 'Sign times the digits read, limited to the 32-bit range.'); return r === 0 ? 0 : r; }
  });

  D('longest-common-prefix', {
    t: 'Longest Common Prefix: scan columns',
    r: 'Check column i across all strings; stop at the first string that is too short or differs.',
    g: R => { const p = R.str(R.int(0, 3), 'ab'); return { strs: Array.from({ length: R.int(1, 4) }, () => p.slice(0, R.int(p.length - 1, p.length)) + R.str(R.int(0, 3), 'abc')) }; },
    s(I, T) { const s = I.strs; let i = 0; for (;;) { const c = s[0][i], ok = c !== undefined && s.every(w => w[i] === c); T.at({ strs: A(s), column: i }); T.yn(`Do all strings share column ${i}?`, ok, ok ? `All have '${c}'.` : 'A string ends or differs.'); if (!ok) return s[0].slice(0, i); i++; } }
  });

  D('group-anagrams', {
    t: 'Group Anagrams: sorted-letter keys',
    r: 'Sort each word\'s letters to form a key; words with the same key are anagrams.',
    cmp: 'sets',
    g: R => ({ strs: words(R, R.int(1, 6), 'abt', 0, 3) }),
    s(I, T) { const m = new Map(); for (const w of I.strs) { const k = [...w].sort().join(''); T.at({ word: w, groups: K(Object.fromEntries([...m].map(([a, b]) => [a || '""', b.join(',')]))) }); T.c(`Key for "${w}"?`, [...new Set([k, [...w].reverse().join(''), w, k + 'a'])], k, 'Letters sorted.'); (m.get(k) || m.set(k, []).get(k)).push(w); } return [...m.values()]; }
  });

  D('valid-number', {
    t: 'Valid Number: digits, dot, exponent',
    r: 'A valid number is an optional sign, digits with at most one dot (at least one digit overall), optionally followed by e/E, an optional sign and at least one digit.',
    g: R => ({ s: R.pick(['', '+', '-']) + R.str(R.int(0, 2), '0123456789') + R.pick(['', '.', '.5']) + R.pick(['', 'e', 'E3', 'e-2', 'e+', 'a']) + R.pick(['', '', '1', '.']) }),
    s(I, T) { const s = I.s, m = s.match(/^([+-]?(\d+\.?\d*|\.\d+))([eE][+-]?\d+)?$/); const base = s.split(/[eE]/)[0]; T.at({ s: chars(s) }); T.yn(`Is the part before any exponent ("${base}") a valid decimal?`, /^[+-]?(\d+\.?\d*|\.\d+)$/.test(base), 'Optional sign, digits, at most one dot, and at least 1 digit.'); T.yn('Does s contain an exponent marker (e or E)?', /[eE]/.test(s), 'If so, an integer must follow it.'); T.yn('Is s a valid number?', !!m, 'A valid decimal, then an optional exponent with an integer.'); return !!m; }
  });

  D('isomorphic-strings', {
    t: 'Isomorphic Strings: two-way mapping',
    r: 'Map s[i] → t[i] and t[i] → s[i]; any conflict in either direction means not isomorphic.',
    g: R => { const n = R.int(1, 6), s = R.str(n, 'abc'); const p = R.shuffle(['x', 'y', 'z']); let t = [...s].map(c => p['abc'.indexOf(c)]).join(''); if (R.chance(0.4)) t = R.str(n, 'xyz'); return { s, t }; },
    s(I, T) { const a = new Map(), b = new Map(); for (let i = 0; i < I.s.length; i++) { const x = I.s[i], y = I.t[i]; const ok = (!a.has(x) || a.get(x) === y) && (!b.has(y) || b.get(y) === x); T.at({ s: chars(I.s), t: chars(I.t), map: K(Object.fromEntries(a)) }); T.yn(`Is ${x} → ${y} consistent?`, ok, 'Both directions must agree.'); if (!ok) return false; a.set(x, y); b.set(y, x); } return true; }
  });

  D('shortest-palindrome', {
    t: 'Shortest Palindrome: KMP on s + # + reverse',
    r: 'The longest palindromic prefix of s has length = the last prefix-function value of s + "#" + reverse(s). Prepend the reversed rest.',
    g: R => ({ s: R.str(R.int(0, 7), 'ab') }),
    s(I, T) { const s = I.s, t = s + '#' + [...s].reverse().join(''), pi = Array(t.length).fill(0); for (let i = 1; i < t.length; i++) { let k = pi[i - 1]; while (k && t[i] !== t[k]) k = pi[k - 1]; if (t[i] === t[k]) k++; pi[i] = k; } const L = t.length ? pi[t.length - 1] : 0; T.at({ t: chars(t), pi: A(pi) }); T.n('Length of the longest palindromic prefix?', L, 'Last prefix-function value.'); T.n('Characters to add in front?', s.length - L, 'Everything after the palindromic prefix, reversed.'); T.n('Length of the result?', 2 * s.length - L, 'Added characters plus s.'); return [...s.slice(L)].reverse().join('') + s; }
  });

  D('valid-anagram', {
    t: 'Valid Anagram: letter counts',
    r: 'Count letters of s up and t down; it is an anagram iff every count ends at 0.',
    g: R => { const s = R.str(R.int(1, 6), 'abc'); return { s, t: R.chance(0.5) ? R.shuffle([...s]).join('') : R.str(R.int(1, 6), 'abc') }; },
    s(I, T) { T.at({ s: I.s, t: I.t }); T.yn('Same length?', I.s.length === I.t.length, 'Different lengths cannot be anagrams.'); if (I.s.length !== I.t.length) return false; const c = cnt(I.s); for (const ch of I.t) c[ch] = (c[ch] || 0) - 1; T.at({ counts: K(c) }); T.n('Letters whose count is not zero?', Object.values(c).filter(x => x !== 0).length, 'Each one is a mismatch.'); const ok = Object.values(c).every(x => x === 0); T.yn('Are all counts zero?', ok, 'Same multiset of letters.'); return ok; }
  });

  D('group-shifted-strings', {
    t: 'Group Shifted Strings: difference keys',
    r: 'Key each string by the gaps (s[i] − s[i−1]) mod 26; strings in the same shifting sequence share a key.',
    cmp: 'sets',
    g: R => ({ strings: words(R, R.int(1, 6), 'abyz', 1, 3) }),
    s(I, T) { const m = new Map(); for (const w of I.strings) { const k = [...w].slice(1).map((c, i) => (c.charCodeAt(0) - w.charCodeAt(i) + 26) % 26).join(','); T.at({ word: w, groups: m.size }); T.c(`Gap key for "${w}"?`, [...new Set([k || '(empty)', '0', '1', '25'])], k || '(empty)', 'Differences mod 26.'); (m.get(k) || m.set(k, []).get(k)).push(w); } return [...m.values()]; }
  });

  D('word-pattern', {
    t: 'Word Pattern: letter ↔ word bijection',
    r: 'Split s into words; counts must match. Keep two maps (letter → word, word → letter) and reject on any conflict.',
    g: R => { const p = R.str(R.int(1, 5), 'ab'); const w = { a: 'dog', b: 'cat' }; const ws = [...p].map(c => R.chance(0.85) ? w[c] : R.pick(['dog', 'cat', 'fish'])); if (R.chance(0.1)) ws.push('dog'); return { pattern: p, s: ws.join(' ') }; },
    s(I, T) { const w = I.s.split(' '); T.at({ pattern: chars(I.pattern), words: A(w) }); T.yn('Same number of letters and words?', w.length === I.pattern.length, `${I.pattern.length} vs ${w.length}.`); if (w.length !== I.pattern.length) return false; const a = new Map(), b = new Map(); for (let i = 0; i < w.length; i++) { const c = I.pattern[i]; if ((a.has(c) && a.get(c) !== w[i]) || (b.has(w[i]) && b.get(w[i]) !== c)) { T.n('Pairs checked before the conflict?', i, 'Every earlier letter and word matched.'); T.yn(`Is pairing '${c}' with "${w[i]}" consistent?`, false, 'It conflicts with an earlier pairing.'); return false; } a.set(c, w[i]); b.set(w[i], c); } T.n('Distinct letters, each paired with its own word?', a.size, 'The mapping works in both directions.'); return true; }
  });

  D('bulls-and-cows', {
    t: 'Bulls and Cows: exact matches, then shared counts',
    r: 'Bulls are positions with equal digits. Among the rest, cows = Σ min(count in secret, count in guess) per digit.',
    g: R => { const n = R.int(1, 6); return { secret: R.str(n, '0123'), guess: R.str(n, '0123') }; },
    s(I, T) { let b = 0; const cs = {}, cg = {}; for (let i = 0; i < I.secret.length; i++) { if (I.secret[i] === I.guess[i]) b++; else { cs[I.secret[i]] = (cs[I.secret[i]] || 0) + 1; cg[I.guess[i]] = (cg[I.guess[i]] || 0) + 1; } } T.at({ secret: chars(I.secret), guess: chars(I.guess) }); T.n('Bulls?', b, 'Same digit, same position.'); let c = 0; for (const d in cs) c += Math.min(cs[d], cg[d] || 0); T.at({ secretLeft: K(cs), guessLeft: K(cg) }); T.n('Cows?', c, 'Shared counts among non-bull digits.'); T.n('Digits that match somewhere (bulls plus cows)?', b + c, 'Add the two counts.'); return `${b}A${c}B`; }
  });

  D('ransom-note', {
    t: 'Ransom Note: enough letters in the magazine',
    r: 'Count magazine letters; consume one per ransom-note letter; fail if a count goes negative.',
    g: R => ({ ransomNote: R.str(R.int(1, 4), 'abc'), magazine: R.str(R.int(1, 7), 'abc') }),
    s(I, T) { const c = cnt(I.magazine); for (const ch of I.ransomNote) { T.at({ magazine: K(c), need: ch }); const ok = (c[ch] || 0) > 0; T.yn(`Is a '${ch}' left?`, ok, 'Each magazine letter is used once.'); if (!ok) return false; c[ch]--; } return true; }
  });

  D('first-unique-character-in-a-string', {
    t: 'First Unique Character: count, then scan',
    r: 'Count every letter; the answer is the first index whose letter has count 1, else −1.',
    g: R => ({ s: R.str(R.int(1, 8), 'abcd') }),
    s(I, T) { const c = cnt(I.s); T.at({ s: chars(I.s), counts: K(c) }); const i = [...I.s].findIndex(x => c[x] === 1); T.n('Distinct letters?', Object.keys(c).length, 'Count the keys.'); T.n('Letters that appear exactly once?', Object.values(c).filter(x => x === 1).length, 'The candidates.'); T.n('Index of the first unique letter (−1 if none)?', i, 'First letter with count 1.'); return i; }
  });

  D('sort-characters-by-frequency', {
    t: 'Sort Characters by Frequency: bucket by count',
    r: 'Count each character and emit characters from the highest count down, each repeated count times.',
    cmp: (o, e) => typeof o === 'string' && [...o].sort().join('') === [...e].sort().join('') && (() => { const c = cnt(o); for (let i = 1; i < o.length; i++) if (o[i] !== o[i - 1] && (c[o[i]] > c[o[i - 1]] || o.indexOf(o[i]) !== i)) return false; return true; })(),
    g: R => ({ s: R.str(R.int(1, 8), 'abcA1') }),
    s(I, T) { const c = cnt(I.s), ks = Object.keys(c).sort((a, b) => c[b] - c[a]); T.at({ counts: K(c) }); T.n('Highest frequency?', c[ks[0]], 'Largest count.'); T.n('Distinct characters?', ks.length, 'One block per character.'); T.n('Characters tied at the highest frequency?', ks.filter(k => c[k] === c[ks[0]]).length, 'Any of them may come first.'); return ks.map(k => k.repeat(c[k])).join(''); }
  });

  D('repeated-substring-pattern', {
    t: 'Repeated Substring Pattern: (s + s) trick',
    r: 's is built from a repeated block iff s appears in (s + s) with the first and last characters removed. Equivalently, try each divisor length.',
    g: R => { const b = R.str(R.int(1, 3), 'ab'); return { s: R.chance(0.5) ? b.repeat(R.int(1, 3)) : R.str(R.int(1, 6), 'ab') }; },
    s(I, T) { const s = I.s, n = s.length; let ok = false; T.at({ s: chars(s) }); T.n('How many block lengths up to n / 2 divide n?', [...Array(Math.floor(n / 2)).keys()].filter(x => n % (x + 1) === 0).length, 'Only those can tile s exactly.'); for (let L = 1; L <= n / 2; L++) { if (n % L) continue; const r = s.slice(0, L).repeat(n / L) === s; T.at({ s: chars(s), block: s.slice(0, L) }); T.yn(`Does block "${s.slice(0, L)}" rebuild s?`, r, `Repeat it ${n / L} times.`); if (r) { ok = true; break; } } if (n < 2) T.yn('Can a single character be a repeat of a shorter block?', false, 'Needs at least two copies.'); T.yn('Is s a repeat of a shorter block?', ok, 'Some block rebuilt s.'); return ok; }
  });

  D('validate-ip-address', {
    t: 'Validate IP Address: IPv4 or IPv6 rules',
    r: 'IPv4: 4 decimal parts 0–255, no leading zeros. IPv6: 8 hex parts of length 1–4. Otherwise "Neither".',
    g: R => ({ queryIP: R.chance(0.5) ? Array.from({ length: R.int(3, 5) }, () => R.pick(['0', '1', '01', '255', '256', '172', 'a'])).join('.') : Array.from({ length: R.int(7, 9) }, () => R.pick(['2001', '0db8', '0', 'ffff', '00000', 'g1', ''])).join(':') }),
    s(I, T) { const q = I.queryIP; const v4 = q.split('.'), v6 = q.split(':'); const kind = v4.length === 4 ? 'IPv4' : v6.length === 8 ? 'IPv6' : 'Neither'; T.at({ ip: q }); T.n('Pieces when splitting on dots?', v4.length, 'IPv4 needs exactly 4.'); T.n('Pieces when splitting on colons?', v6.length, 'IPv6 needs exactly 8.'); T.c('Which format should we try?', ['IPv4', 'IPv6', 'Neither'], kind, 'Count the separators.'); if (kind === 'IPv4' && v4.every(p => /^(0|[1-9]\d{0,2})$/.test(p) && +p <= 255)) return 'IPv4'; if (kind === 'IPv6' && v6.every(p => /^[0-9a-fA-F]{1,4}$/.test(p))) return 'IPv6'; return 'Neither'; }
  });

  D('keyboard-row', {
    t: 'Keyboard Row: one row per word',
    r: 'Map each letter to its keyboard row; keep words whose letters (case-insensitive) all share a row.',
    g: R => ({ words: words(R, R.int(1, 5), 'qwasdzxAQ', 1, 4) }),
    s(I, T) { const row = c => 'qwertyuiop'.includes(c) ? 1 : 'asdfghjkl'.includes(c) ? 2 : 3; return I.words.filter(w => { const l = w.toLowerCase(), ok = [...l].every(c => row(c) === row(l[0])); T.at({ word: w }); T.yn(`Can "${w}" be typed on one row?`, ok, `Row of '${l[0]}' is ${row(l[0])}.`); return ok; }); }
  });

  D('detect-capital', {
    t: 'Detect Capital: three allowed shapes',
    r: 'Valid if all upper, all lower, or only the first letter upper.',
    g: R => ({ word: R.str(R.int(1, 5), 'aAbB') }),
    s(I, T) { const w = I.word, up = [...w].filter(c => c === c.toUpperCase()).length; T.at({ word: chars(w) }); T.n('How many capitals?', up, 'Count upper-case letters.'); T.yn('Is the first letter a capital?', w[0] === w[0].toUpperCase(), 'A single capital must be the first letter.'); T.yn('Is the use of capitals correct?', up === 0 || up === w.length || (up === 1 && w[0] === w[0].toUpperCase()), 'All lower, all upper, or only the first.'); return up === 0 || up === w.length || (up === 1 && w[0] === w[0].toUpperCase()); }
  });

  D('longest-uncommon-subsequence-i', {
    t: 'Longest Uncommon Subsequence I: compare whole strings',
    r: 'If a ≠ b, the longer whole string is not a subsequence of the other, so the answer is max length; if equal, −1.',
    g: R => { const a = R.str(R.int(1, 4), 'ab'); return { a, b: R.chance(0.3) ? a : R.str(R.int(1, 4), 'ab') }; },
    s(I, T) { T.at({ a: I.a, b: I.b }); T.yn('Are the strings equal?', I.a === I.b, 'Equal strings share every subsequence.'); T.n('Length of the longer string?', Math.max(I.a.length, I.b.length), 'The longer string cannot be a subsequence of the shorter one.'); T.n('Answer?', I.a === I.b ? -1 : Math.max(I.a.length, I.b.length), 'Equal strings give −1.'); return I.a === I.b ? -1 : Math.max(I.a.length, I.b.length); }
  });

  D('student-attendance-record-i', {
    t: 'Student Attendance Record I',
    r: 'Eligible if fewer than 2 absences and never 3 lates in a row.',
    g: R => ({ s: R.str(R.int(1, 8), 'PPLLA') }),
    s(I, T) { const a = [...I.s].filter(c => c === 'A').length; T.at({ s: chars(I.s) }); T.n('Absences?', a, 'Count A.'); T.yn('Three lates in a row?', I.s.includes('LLL'), 'Look for LLL.'); T.yn('Is the student eligible for an award?', a < 2 && !I.s.includes('LLL'), 'Fewer than 2 absences and never 3 lates in a row.'); return a < 2 && !I.s.includes('LLL'); }
  });

  D('minimum-index-sum-of-two-lists', {
    t: 'Minimum Index Sum of Two Lists',
    r: 'Index list1 in a map. For each common string in list2, compute i + j; keep all strings with the smallest sum.',
    cmp: 'set',
    g: R => { const p = ['a', 'b', 'c', 'd', 'e']; const l1 = R.shuffle(p).slice(0, R.int(1, 4)); const l2 = R.shuffle([R.pick(l1), ...R.shuffle(p).slice(0, R.int(0, 3))]); return { list1: l1, list2: [...new Set(l2)] }; },
    s(I, T) { const m = new Map(I.list1.map((s, i) => [s, i])); let best = Infinity, out = []; T.at({ list1: A(I.list1), list2: A(I.list2) }); T.n('Strings common to both lists?', I.list2.filter(s => m.has(s)).length, 'Only these have an index sum.'); I.list2.forEach((s, j) => { if (!m.has(s)) return; const v = m.get(s) + j; T.at({ list1: A(I.list1), list2: A(I.list2, { hl: [j] }) }); T.n(`Index sum for "${s}"?`, v, `${m.get(s)} + ${j}.`); if (v < best) { best = v; out = [s]; } else if (v === best) out.push(s); }); T.n('Smallest index sum?', best, 'Keep every string that reaches it.'); return out; }
  });

  D('find-duplicate-file-in-system', {
    t: 'Find Duplicate Files: group by content',
    r: 'Parse each "dir file(content) …" entry; map content → list of full paths; keep groups with at least two files.',
    cmp: 'sets',
    g: R => ({ paths: Array.from({ length: R.int(1, 3) }, (_, i) => `root/${'abc'[i]} ` + Array.from({ length: R.int(1, 2) }, (_, j) => `${j + 1}.txt(${R.pick(['x', 'y', 'z'])})`).join(' ')) }),
    s(I, T) { const m = new Map(); for (const p of I.paths) { const [dir, ...fs] = p.split(' '); for (const f of fs) { const k = f.indexOf('('), name = f.slice(0, k), c = f.slice(k + 1, -1); (m.get(c) || m.set(c, []).get(c)).push(dir + '/' + name); } } const g = [...m.values()].filter(x => x.length > 1); T.at({ byContent: K(Object.fromEntries([...m].map(([a, b]) => [a, b.length]))) }); T.n('How many duplicate groups?', g.length, 'Contents shared by at least 2 files.'); T.n('Files in total?', [...m.values()].reduce((s, x) => s + x.length, 0), 'Every file in every directory.'); T.n('Files that belong to a duplicate group?', g.reduce((s, x) => s + x.length, 0), 'Add up the group sizes.'); return g; }
  });

  D('next-closest-time', {
    t: 'Next Closest Time: step minutes forward',
    r: 'Advance one minute at a time (wrapping at midnight) until every digit of the time is one of the original digits.',
    g: R => ({ time: String(R.int(0, 23)).padStart(2, '0') + ':' + String(R.int(0, 59)).padStart(2, '0') }),
    s(I, T) { const ok = new Set(I.time.replace(':', '')); let t = +I.time.slice(0, 2) * 60 + +I.time.slice(3), steps = 0; for (;;) { t = (t + 1) % 1440; steps++; const s = String(Math.floor(t / 60)).padStart(2, '0') + ':' + String(t % 60).padStart(2, '0'); if ([...s.replace(':', '')].every(c => ok.has(c))) { T.at({ digits: A([...ok]), time: I.time }); T.n('Distinct digits available?', ok.size, 'Only these digits may be reused.'); T.n('Minutes until the next valid time?', steps, 'Step forward one minute at a time.'); T.c('Next valid time?', [...new Set([s, I.time, '00:00'])], s, `${steps} minutes later.`); return s; } } }
  });

  D('repeated-string-match', {
    t: 'Repeated String Match: enough copies to cover b',
    r: 'Repeat a until its length ≥ b\'s length (q copies). b must appear in q or q + 1 copies; otherwise −1.',
    g: R => { const a = R.str(R.int(1, 3), 'ab'); const x = a.repeat(R.int(1, 4)), i = R.int(0, x.length - 1); return { a, b: R.chance(0.7) ? x.slice(i) + a.slice(0, R.int(0, a.length)) || a : R.str(R.int(1, 4), 'abc') }; },
    s(I, T) { const q = Math.ceil(I.b.length / I.a.length); T.at({ a: I.a, b: I.b }); T.n('Minimum copies so the length is at least the length of b?', q, `${I.b.length} divided by ${I.a.length}, rounded up.`); const inQ = I.a.repeat(q).includes(I.b); T.yn(`Is b inside ${q} copies?`, inQ, 'Check the shortest repeat first.'); if (inQ) { T.n('Fewest copies needed?', q, 'That many copies already contain b.'); return q; } const r = I.a.repeat(q + 1).includes(I.b); T.yn(`Is b inside ${q + 1} copies?`, r, 'One more copy covers any offset.'); T.n('Fewest copies needed (−1 if impossible)?', r ? q + 1 : -1, 'One extra copy is the last chance.'); return r ? q + 1 : -1; }
  });

  D('to-lower-case', {
    t: 'To Lower Case: shift A–Z by 32',
    r: 'For each character between A and Z, add 32 to its code; others stay.',
    g: R => ({ s: R.str(R.int(1, 6), 'aBcD1!') }),
    s(I, T) { let out = ''; for (const c of I.s) { const up = c >= 'A' && c <= 'Z'; if (up) { T.at({ s: chars(I.s), out }); T.c(`Lower case of '${c}'?`, [c.toLowerCase(), c], c.toLowerCase(), 'Code + 32.'); } out += up ? String.fromCharCode(c.charCodeAt(0) + 32) : c; } if (out === I.s) { T.at({ s: I.s }); T.yn('Any upper-case letters?', false, 'Nothing changes.'); } T.n('Characters that changed?', [...I.s].filter(c => c >= 'A' && c <= 'Z').length, 'Only upper case letters change.'); return out; }
  });

  D('sentence-similarity', {
    t: 'Sentence Similarity: pairwise check',
    r: 'Lengths must match; each position must be equal or listed as a similar pair (either order). Similarity is not transitive.',
    g: R => { const n = R.int(1, 3), w = ['a', 'b', 'c', 'd']; const s1 = Array.from({ length: n }, () => R.pick(w)); const pairs = Array.from({ length: R.int(0, 3) }, () => [R.pick(w), R.pick(w)]); return { sentence1: s1, sentence2: R.chance(0.15) ? [...s1, 'a'] : s1.map(x => R.chance(0.5) ? x : R.pick(w)), similarPairs: pairs }; },
    s(I, T) { T.at({ s1: A(I.sentence1), s2: A(I.sentence2) }); T.yn('Same length?', I.sentence1.length === I.sentence2.length, 'Required.'); if (I.sentence1.length !== I.sentence2.length) return false; const set = new Set(I.similarPairs.flatMap(([a, b]) => [a + '|' + b, b + '|' + a])); for (let i = 0; i < I.sentence1.length; i++) { const a = I.sentence1[i], b = I.sentence2[i], ok = a === b || set.has(a + '|' + b); T.yn(`Are "${a}" and "${b}" similar?`, ok, 'Equal or a listed pair.'); if (!ok) return false; } return true; }
  });

  D('shortest-completing-word', {
    t: 'Shortest Completing Word: letter counts',
    r: 'Count the plate\'s letters (ignore digits/spaces/case). A word completes it if it has at least those counts; pick the shortest, earliest on ties.',
    g: R => ({ licensePlate: R.str(R.int(1, 5), 'aB1 s'), words: words(R, R.int(1, 5), 'absx', 1, 6) }),
    s(I, T) { const need = cnt(I.licensePlate.toLowerCase().replace(/[^a-z]/g, '')); let best = null; for (const w of I.words) { const c = cnt(w), ok = Object.keys(need).every(k => (c[k] || 0) >= need[k]); T.at({ need: K(need), word: w }); T.yn(`Does "${w}" complete the plate?`, ok, 'Enough of every letter.'); if (ok && (!best || w.length < best.length)) best = w; } return best === null ? '' : best; }
  });

  D('bold-words-in-string', {
    t: 'Bold Words in String: mark, then merge',
    r: 'Mark every character covered by an occurrence of any keyword, then wrap each maximal marked run in <b>…</b>.',
    g: R => ({ words: words(R, R.int(0, 3), 'ab', 1, 2), s: R.str(R.int(1, 7), 'abc') }),
    s(I, T) { const s = I.s, m = Array(s.length).fill(0); for (const w of I.words) for (let i = s.indexOf(w); i >= 0; i = s.indexOf(w, i + 1)) for (let j = i; j < i + w.length; j++) m[j] = 1; T.at({ s: chars(s), bold: A(m) }); T.n('How many characters are bold?', m.reduce((a, b) => a + b, 0), 'Union of all occurrences.'); let out = ''; for (let i = 0; i < s.length; i++) { if (m[i] && !m[i - 1]) out += '<b>'; out += s[i]; if (m[i] && !m[i + 1]) out += '</b>'; } T.n('How many bold runs (pairs of tags)?', m.filter((x, i) => x && !m[i - 1]).length, 'Neighbouring bold characters share one pair of tags.'); T.n('Length of the output?', out.length, 'Characters plus 7 for each pair of tags.'); return out; }
  });

  D('special-binary-string', {
    t: 'Special Binary String: sort mountains descending',
    r: 'Split s into top-level special chunks "1" + inner + "0". Recursively fix each inner part, then sort the chunks in descending order and join.',
    g: R => { const mk = d => { let s = ''; const k = R.int(1, d > 2 ? 1 : 2); for (let i = 0; i < k; i++) s += '1' + (d < 3 && R.chance(0.5) ? mk(d + 1) : '') + '0'; return s; }; return { s: mk(0) }; },
    s(I, T) { const go = (s, top) => { const parts = []; let b = 0, st = 0; for (let i = 0; i < s.length; i++) { b += s[i] === '1' ? 1 : -1; if (!b) { parts.push('1' + go(s.slice(st + 1, i), false) + '0'); st = i + 1; } } if (top) { T.at({ s: chars(s), chunks: A(parts) }); T.n('How many top-level chunks?', parts.length, 'Balance returns to 0.'); } parts.sort().reverse(); return parts.join(''); }; let dep = 0, md = 0; for (const ch of I.s) { dep += ch === '1' ? 1 : -1; md = Math.max(md, dep); } T.n('Depth of the deepest nesting?', md, 'The highest running balance.'); const res = go(I.s, true); T.yn('Was s already in its largest form?', res === I.s, 'Compare the result with s.'); return res; }
  });

  D('jewels-and-stones', {
    t: 'Jewels and Stones: set lookup',
    r: 'Put jewels in a set; count stones whose type is in the set (case-sensitive).',
    g: R => ({ jewels: [...new Set(R.str(R.int(1, 3), 'aAb'))].join(''), stones: R.str(R.int(1, 8), 'aAbB') }),
    s(I, T) { const j = new Set(I.jewels), c = [...I.stones].filter(x => j.has(x)).length; T.at({ jewels: A([...j]), stones: chars(I.stones) }); [...I.stones].slice(0, 6).forEach((x, i) => { T.at({ jewels: A([...j]), stones: A([...I.stones], { hl: [i] }) }); T.yn(`Is stone '${x}' a jewel?`, j.has(x), 'Look it up in the jewel set. Case matters.'); }); T.at({ jewels: A([...j]), stones: chars(I.stones) }); T.n('How many stones are jewels?', c, 'Case matters.'); return c; }
  });

  D('custom-sort-string', {
    t: 'Custom Sort String: emit by order, then the rest',
    r: 'Count s\'s letters; output each letter of order as many times as it appears, then any remaining letters.',
    g: R => ({ order: R.shuffle([...'abcd']).slice(0, R.int(1, 4)).join(''), s: R.str(R.int(1, 7), 'abcde') }),
    s(I, T) { const c = cnt(I.s); let out = ''; for (const ch of I.order) { if (c[ch]) { T.at({ order: chars(I.order), left: K(c), out }); T.n(`How many '${ch}' to emit?`, c[ch], 'All copies in s.'); out += ch.repeat(c[ch]); delete c[ch]; } } T.n('Letters left over for the end?', Object.values(c).reduce((a, b) => a + b, 0), 'Letters not in order go after the rest.'); for (const ch of I.s) if (c[ch]) { out += ch; c[ch]--; } return out; }
  });

  D('rotate-string', {
    t: 'Rotate String: look inside s + s',
    r: 'goal is a rotation of s iff they have the same length and goal appears in s + s.',
    g: R => { const s = R.str(R.int(1, 6), 'abc'), k = R.int(0, s.length - 1); return { s, goal: R.chance(0.6) ? s.slice(k) + s.slice(0, k) : R.str(s.length, 'abc') }; },
    s(I, T) { const ok = I.s.length === I.goal.length && (I.s + I.s).includes(I.goal); T.at({ doubled: chars(I.s + I.s), goal: I.goal }); T.yn('Do s and goal have the same length?', I.s.length === I.goal.length, 'A rotation never changes the length.'); T.n('Length of s + s?', 2 * I.s.length, 'Every rotation of s appears inside it.'); T.yn('Is goal inside s + s (same length)?', ok, 'Every rotation is a window of s + s.'); return ok; }
  });

  D('unique-morse-code-words', {
    t: 'Unique Morse Code Words: set of encodings',
    r: 'Translate every word letter by letter and count distinct transformations.',
    g: R => ({ words: words(R, R.int(1, 5), 'gimnsz', 1, 3) }),
    s(I, T) { const M = '.- -... -.-. -.. . ..-. --. .... .. .--- -.- .-.. -- -. --- .--. --.- .-. ... - ..- ...- .-- -..- -.-- --..'.split(' '); const set = new Set(); for (const w of I.words) { const e = [...w].map(c => M[c.charCodeAt(0) - 97]).join(''); T.at({ word: w, code: e, seen: A([...set]) }); T.yn(`Is "${e}" new?`, !set.has(e), 'Different words can share a code.'); set.add(e); } return set.size; }
  });

  D('subdomain-visit-count', {
    t: 'Subdomain Visit Count: credit every suffix',
    r: 'For "count a.b.c", add count to "a.b.c", "b.c" and "c". Output each domain with its total.',
    cmp: 'set',
    g: R => ({ cpdomains: Array.from({ length: R.int(1, 3) }, () => `${R.int(1, 50)} ${R.pick(['a.', 'b.', ''])}${R.pick(['x', 'y'])}.com`) }),
    s(I, T) { const m = new Map(); for (const e of I.cpdomains) { const [c, d] = e.split(' '), p = d.split('.'); for (let i = 0; i < p.length; i++) { const k = p.slice(i).join('.'); m.set(k, (m.get(k) || 0) + +c); } T.at({ entry: e, totals: K(Object.fromEntries(m)) }); T.n(`How many domains does "${d}" credit?`, p.length, 'One per suffix.'); } return [...m].map(([d, c]) => `${c} ${d}`); }
  });

  D('ambiguous-coordinates', {
    t: 'Ambiguous Coordinates: split, then place dots',
    r: 'Try every split of the digits. For each side, list valid numbers: no leading zeros (unless "0"), and a decimal part cannot end in 0.',
    cmp: 'set',
    g: R => ({ s: '(' + R.str(R.int(2, 5), '0012') + ')' }),
    s(I, T) { const d = I.s.slice(1, -1); const opts = x => { const r = []; for (let i = 1; i <= x.length; i++) { const a = x.slice(0, i), b = x.slice(i); if ((a.length > 1 && a[0] === '0') || (b && b.endsWith('0'))) continue; r.push(b ? a + '.' + b : a); } return r; }; const out = []; for (let i = 1; i < d.length; i++) { const L = opts(d.slice(0, i)), Rr = opts(d.slice(i)); if (i <= 3) { T.at({ left: d.slice(0, i), right: d.slice(i) }); T.n(`Valid forms of "${d.slice(0, i)}"?`, L.length, 'No bad leading or trailing zeros.'); } for (const a of L) for (const b of Rr) out.push(`(${a}, ${b})`); } return out; }
  });

  D('most-common-word', {
    t: 'Most Common Word: normalize and count',
    r: 'Lower-case, split on non-letters, skip banned words, and return the most frequent remaining word.',
    g: R => ({ paragraph: Array.from({ length: R.int(2, 6) }, () => R.pick(['Bob', 'hit', 'ball', 'BALL,', 'a', 'the.'])).join(' ') + ' ball!', banned: [R.pick(['hit', 'zz'])] }),
    s(I, T) { const ban = new Set(I.banned), c = {}; for (const w of I.paragraph.toLowerCase().split(/[^a-z]+/)) if (w && !ban.has(w)) c[w] = (c[w] || 0) + 1; T.at({ counts: K(c) }); const best = Object.keys(c).reduce((a, b) => c[b] > c[a] ? b : a); T.n('Highest count?', c[best], 'Largest non-banned count.'); T.n('Distinct non-banned words?', Object.keys(c).length, 'Lower-cased, punctuation removed.'); T.c('Most common word?', Object.keys(c), best, 'The word with the highest count.'); return best; }
  });

  D('find-and-replace-in-string', {
    t: 'Find and Replace in String: match against the original',
    r: 'Each replacement checks the original s at its index. Apply matches from right to left (or build left to right by index) so indices stay valid.',
    g: R => { const s = R.str(R.int(2, 7), 'abc'); const idx = R.distinct(R.int(1, 3), 0, s.length - 1).sort((x, y) => x - y); const ops = idx.map((i, k) => { const nx = k + 1 < idx.length ? idx[k + 1] : s.length, L = R.int(1, nx - i); return [i, R.chance(0.7) ? s.substr(i, L) : R.str(L, 'abc'), R.str(R.int(1, 3), 'xy')]; }); const o = R.shuffle(ops); return { s, indices: o.map(x => x[0]), sources: o.map(x => x[1]), targets: o.map(x => x[2]) }; },
    s(I, T) { let { s } = I; const { indices, sources, targets } = I; const ops = indices.map((i, k) => [i, sources[k], targets[k]]).sort((a, b) => b[0] - a[0]); for (const [i, src, tg] of ops) { const ok = I.s.startsWith(src, i); T.at({ s: chars(s), at: i, source: src }); T.yn(`Does "${src}" match at index ${i}?`, ok, 'Compare with the original string.'); if (ok) s = s.slice(0, i) + tg + s.slice(i + src.length); } return s; }
  });

  D('buddy-strings', {
    t: 'Buddy Strings: exactly two mismatches, swapped',
    r: 'If s == goal, a swap works only if some letter repeats. Otherwise there must be exactly two mismatched positions whose letters are crossed.',
    g: R => { const s = R.str(R.int(1, 5), 'abc'); const g = [...s]; if (R.chance(0.6) && s.length > 1) { const i = R.int(0, s.length - 1), j = R.int(0, s.length - 1); [g[i], g[j]] = [g[j], g[i]]; } return { s, goal: g.join('') }; },
    s(I, T) { if (I.s.length !== I.goal.length) return false; const d = []; for (let i = 0; i < I.s.length; i++) if (I.s[i] !== I.goal[i]) d.push(i); T.at({ s: chars(I.s), goal: chars(I.goal) }); T.n('Mismatched positions?', d.length, 'Compare letter by letter.'); T.yn('Does s have a repeated letter?', new Set(I.s).size < I.s.length, 'Swapping two equal letters keeps s the same.'); const res = !d.length ? new Set(I.s).size < I.s.length : d.length === 2 && I.s[d[0]] === I.goal[d[1]] && I.s[d[1]] === I.goal[d[0]]; T.yn('Can one swap turn s into goal?', res, 'Either two crossed mismatches, or no mismatch and a repeated letter.'); return res; }
  });

  D('uncommon-words-from-two-sentences', {
    t: 'Uncommon Words: count across both sentences',
    r: 'A word is uncommon iff it appears exactly once in the combined sentences.',
    cmp: 'set',
    g: R => ({ s1: Array.from({ length: R.int(1, 4) }, () => R.pick(['a', 'b', 'c'])).join(' '), s2: Array.from({ length: R.int(1, 4) }, () => R.pick(['b', 'c', 'd'])).join(' ') }),
    s(I, T) { const c = cnt((I.s1 + ' ' + I.s2).split(' ')); T.at({ counts: K(c) }); const r = Object.keys(c).filter(k => c[k] === 1); T.n('How many words appear exactly once?', r.length, 'Count over both sentences.'); T.n('Words in total?', Object.values(c).reduce((a, b) => a + b, 0), 'Both sentences together.'); T.n('Distinct words?', Object.keys(c).length, 'Count the keys.'); return r; }
  });

  D('find-and-replace-pattern', {
    t: 'Find and Replace Pattern: bijection test',
    r: 'A word matches if a consistent one-to-one letter mapping turns the pattern into it.',
    g: R => { const n = R.int(1, 3); return { words: words(R, R.int(1, 5), 'abc', n, n), pattern: R.str(n, 'xy') }; },
    s(I, T) { return I.words.filter(w => { const a = new Map(), b = new Map(); let ok = true; for (let i = 0; i < w.length; i++) { const p = I.pattern[i]; if ((a.has(p) && a.get(p) !== w[i]) || (b.has(w[i]) && b.get(w[i]) !== p)) { ok = false; break; } a.set(p, w[i]); b.set(w[i], p); } T.at({ pattern: I.pattern, word: w }); T.yn(`Does "${w}" match?`, ok, 'One-to-one mapping both ways.'); return ok; }); }
  });

  D('groups-of-special-equivalent-strings', {
    t: 'Special-Equivalent Groups: sort even and odd letters',
    r: 'Swaps keep letters on even/odd positions. Key = sorted even letters + sorted odd letters; count distinct keys.',
    g: R => { const n = R.int(1, 4); return { words: words(R, R.int(1, 6), 'ab', n, n) }; },
    s(I, T) { const set = new Set(); for (const w of I.words) { const e = [...w].filter((_, i) => i % 2 === 0).sort().join(''), o = [...w].filter((_, i) => i % 2).sort().join(''), k = e + '|' + o; T.at({ word: w, groups: A([...set]) }); T.yn(`Does "${w}" start a new group?`, !set.has(k), `Key ${k}.`); set.add(k); } return set.size; }
  });
})();
