/* v2 games: strings (05). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const cnt = s => { const m = {}; for (const c of s) m[c] = (m[c] || 0) + 1; return m; };
  const chars = s => A([...s]);
  const words = (R, n, al, lo, hi) => Array.from({ length: n }, () => R.str(R.int(lo || 1, hi || 4), al || 'abc'));
  const revert = (I, T) => { const n = I.word.length; let t = 1; for (; t * I.k < n; t++) { const ok = I.word.startsWith(I.word.slice(t * I.k)); T.at({ word: chars(I.word), removed: t * I.k }); T.yn(`After ${t} seconds, is the remaining suffix a prefix of word?`, ok, 'Then the appended letters can restore it.'); if (ok) return t; } T.at({ word: chars(I.word) }); T.n('Seconds to remove everything?', t, `${n} divided by ${I.k}, rounded up.`); return t; };
  const patCount = (I, T) => { const sg = I.nums.slice(1).map((x, i) => Math.sign(x - I.nums[i])), m = I.pattern.length; T.at({ nums: A(I.nums), signs: A(sg), pattern: A(I.pattern) }); T.n('First sign (nums[1] vs nums[0])?', sg[0], 'Compare neighbors: 1, 0 or −1.'); const t = [...I.pattern, 9, ...sg], z = Array(t.length).fill(0); let l = 0, r = 0, c = 0; for (let i = 1; i < t.length; i++) { if (i < r) z[i] = Math.min(r - i, z[i - l]); while (i + z[i] < t.length && t[z[i]] === t[i + z[i]]) z[i]++; if (i + z[i] > r) { l = i; r = i + z[i]; } if (i > m && z[i] >= m) c++; } T.n('How many windows of signs are there to check?', Math.max(0, sg.length - m + 1), 'One per possible start.'); T.n('Subarrays that match the pattern?', c, 'Windows whose signs equal the pattern.'); return c; };

  D('make-three-strings-equal', {
    t: 'Make Three Strings Equal',
    r: 'Only deletions from the right, so all three must keep their common prefix. If it is empty: −1; else delete everything beyond it.',
    g: R => { const p = R.str(R.int(0, 2), 'ab'); return { s1: p + R.str(R.int(1, 3), 'abc'), s2: p + R.str(R.int(0, 3), 'abc'), s3: p + R.str(R.int(0, 2), 'abc') }; },
    s(I, T) { const res = (() => { const a = [I.s1, I.s2, I.s3]; let L = 0; while (L < Math.min(...a.map(x => x.length)) && a.every(x => x[L] === a[0][L])) L++; T.at({ strings: A(a) }); T.n('Common prefix length?', L, 'Scan columns.'); T.yn('Is there a common prefix at all?', L > 0, 'Otherwise they can never be equal.'); return L ? a.reduce((s, x) => s + x.length - L, 0) : -1; })(); T.n('Fewest operations (−1 if impossible)?', res, 'Delete everything after the common prefix.'); return res; }
  });

  D('find-words-containing-character', {
    t: 'Words Containing a Character',
    r: 'Return indices of words containing x.',
    g: R => ({ words: words(R, R.int(1, 5), 'abce', 1, 4), x: R.pick(['a', 'e']) }),
    s(I, T) { return I.words.map((w, i) => i).filter(i => { const ok = I.words[i].includes(I.x); T.at({ words: A(I.words, { hl: [i] }), x: I.x }); T.yn(`Does "${I.words[i]}" contain '${I.x}'?`, ok, 'Membership.'); return ok; }); }
  });

  D('number-of-changing-keys', {
    t: 'Number of Changing Keys',
    r: 'Compare letters case-insensitively; count positions where the key differs from the previous one.',
    g: R => ({ s: R.str(R.int(1, 8), 'aAbB') }),
    s(I, T) { const l = I.s.toLowerCase(); let c = 0; for (let i = 1; i < l.length; i++) if (l[i] !== l[i - 1]) c++; T.at({ s: chars(I.s) }); for (let i = 1; i < Math.min(l.length, 6); i++) { T.at({ s: A([...I.s], { hl: [i - 1, i] }) }); T.yn(`Is index ${i} a different key from index ${i - 1}?`, l[i] !== l[i - 1], 'Ignore case.'); } T.at({ s: chars(I.s) }); T.n('Key changes?', c, 'Ignore case.'); return c; }
  });

  D('minimum-time-to-revert-word-to-initial-state-i', {
    t: 'Revert Word to Initial State I',
    r: 'After t seconds the first t times k characters are gone and we may append anything. The word can be restored exactly when word[t times k..] is a prefix of word (or everything was removed).',
    g: R => { const b = R.str(R.int(1, 3), 'ab'); return { word: (b.repeat(R.int(1, 3)) + R.str(R.int(0, 2), 'ab')), k: R.int(1, 3) }; },
    exIn: I => ({ word: I.word, k: Math.min(I.k, I.word.length) }),
    s(I, T) { return revert({ word: I.word, k: Math.min(I.k, I.word.length) }, T); }
  });

  D('minimum-time-to-revert-word-to-initial-state-ii', {
    t: 'Revert Word to Initial State II: Z-function',
    r: 'Same idea with n up to 10 to the power 6: compute the Z-array; the first t with t times k at least n or z[t times k] at least n − t times k is the answer.',
    g: R => { const b = R.str(R.int(1, 3), 'ab'); return { word: b.repeat(R.int(1, 4)) + R.str(R.int(0, 2), 'ab'), k: R.int(1, 3) }; },
    exIn: I => ({ word: I.word, k: Math.min(I.k, I.word.length) }),
    s(I, T) { return revert({ word: I.word, k: Math.min(I.k, I.word.length) }, T); }
  });

  D('number-of-subarrays-that-match-a-pattern-i', {
    t: 'Subarrays Matching a Pattern I',
    r: 'Convert nums into the sign sequence of neighbors (1, 0, −1) and count occurrences of pattern in it.',
    g: R => ({ nums: R.ints(R.int(3, 8), 1, 4), pattern: Array.from({ length: R.int(1, 2) }, () => R.int(-1, 1)) }),
    s(I, T) { return patCount(I, T); }
  });

  D('number-of-subarrays-that-match-a-pattern-ii', {
    t: 'Subarrays Matching a Pattern II: Z divided by KMP',
    r: 'Build the neighbor sign sequence, then count pattern occurrences in linear time with Z on pattern + separator + signs.',
    g: R => ({ nums: R.ints(R.int(3, 9), 1, 4), pattern: Array.from({ length: R.int(1, 3) }, () => R.int(-1, 1)) }),
    s(I, T) { return patCount(I, T); }
  });

  D('existence-of-a-substring-in-a-string-and-its-reverse', {
    t: 'Length-2 Substring Also in the Reverse',
    r: 'Put every pair s[i]s[i+1] in a set; check whether any reversed pair is in it.',
    g: R => ({ s: R.str(R.int(1, 7), 'abcd') }),
    s(I, T) { const res = (() => { const set = new Set(); for (let i = 0; i + 1 < I.s.length; i++) set.add(I.s.substr(i, 2)); T.at({ pairs: A([...set]) }); T.n('Distinct pairs of neighbouring letters?', set.size, 'Every substring of length 2.'); for (const p of set) if (set.has(p[1] + p[0])) { T.at({ pairs: A([...set]) }); T.yn(`Is "${p[1] + p[0]}" also a pair?`, true, 'Found in the reverse.'); return true; } T.at({ pairs: A([...set]) }); T.yn('Does any reversed pair exist?', false, 'None found.'); return false; })(); T.yn('Does some substring of length 2 also appear in the reverse?', res, 'A pair and its mirror image.'); return res; }
  });

  D('find-longest-self-contained-substring', {
    t: 'Longest Self-Contained Substring',
    r: 'A substring is self-contained if no letter inside also appears outside. Start at a letter\'s first occurrence and extend; a block closes whenever j reaches the furthest last occurrence seen. Stop if a letter appeared before the start. Exclude the whole string.',
    g: R => ({ s: R.str(R.int(2, 8), 'abcd') }),
    s(I, T) { const s = I.s, f = {}, l = {}; [...s].forEach((c, i) => { if (!(c in f)) f[c] = i; l[c] = i; }); let best = -1; for (const c of Object.keys(f)) { const i = f[c]; let end = i, here = -1; for (let j = i; j < s.length; j++) { if (f[s[j]] < i) break; end = Math.max(end, l[s[j]]); if (j === end && j - i + 1 < s.length) here = j - i + 1; } best = Math.max(best, here); T.at({ s: chars(s), start: i }); T.n(`Longest self-contained block starting at ${i} (−1 if none)?`, here, 'Extend while no letter appears before the start; close when j reaches the furthest last occurrence.'); } return best; }
  });

  D('score-of-a-string', {
    t: 'Score of a String',
    r: 'Sum |code(s[i]) − code(s[i − 1])|.',
    g: R => ({ s: R.str(R.int(2, 6), 'aehz') }),
    s(I, T) { let t = 0; for (let i = 1; i < I.s.length; i++) { const d = Math.abs(I.s.charCodeAt(i) - I.s.charCodeAt(i - 1)); T.at({ s: chars(I.s), at: i }); T.n(`|'${I.s[i]}' − '${I.s[i - 1]}'|?`, d, 'ASCII difference.'); t += d; } return t; }
  });

  D('latest-time-you-can-obtain-after-replacing-characters', {
    t: 'Latest 12-Hour Time',
    r: 'Try times from 11:59 down to 00:00 and return the first that matches the pattern.',
    g: R => ({ s: [R.pick(['0', '1', '?']), R.pick(['0', '1', '?']), ':', R.pick(['0', '5', '?']), R.pick(['4', '9', '?'])].join('') }),
    s(I, T) { const res = (() => { T.at({ s: I.s }); T.n('How many ? marks?', [...I.s].filter(c => c === '?').length, 'Each one is chosen as large as possible.'); for (let t = 719; t >= 0; t--) { const v = String(Math.floor(t / 60)).padStart(2, '0') + ':' + String(t % 60).padStart(2, '0'); if ([...I.s].every((c, i) => c === '?' || c === v[i])) { T.at({ s: I.s }); T.n('Hour of the latest match?', Math.floor(t / 60), 'Scan down from 11:59.'); return v; } } return ''; })(); T.c('Latest time?', [...new Set([res, '11:59', '10:59', '00:00'])], res, 'Fill each ? with the largest digit that keeps a valid time.'); return res; }
  });

  D('count-the-number-of-special-characters-i', {
    t: 'Special Characters I',
    r: 'Count letters appearing in both lower and upper case.',
    g: R => ({ word: R.str(R.int(1, 8), 'aAbBc') }),
    s(I, T) { const set = new Set(I.word); let c = 0; for (let i = 0; i < 26; i++) { const lo = String.fromCharCode(97 + i); if (set.has(lo) && set.has(lo.toUpperCase())) c++; } T.at({ word: chars(I.word) }); T.n('Distinct lower case letters?', [...set].filter(x => x >= 'a').length, 'Count them.'); T.n('Distinct upper case letters?', [...set].filter(x => x < 'a').length, 'Count them.'); T.n('Special letters?', c, 'Both cases present.'); return c; }
  });

  D('count-the-number-of-special-characters-ii', {
    t: 'Special Characters II: last lower before first upper',
    r: 'A letter is special if it appears in both cases and its last lowercase index is before its first uppercase index.',
    g: R => ({ word: R.str(R.int(1, 8), 'aAbBc') }),
    s(I, T) { const res = (() => { let c = 0; T.at({ word: chars(I.word) }); T.n('Letters that appear in both cases?', [...'abc'].filter(lo => I.word.includes(lo) && I.word.includes(lo.toUpperCase())).length, 'Only these can be special.'); for (const lo of 'abc') { const L = I.word.lastIndexOf(lo), U = I.word.indexOf(lo.toUpperCase()); if (L < 0 || U < 0) continue; T.at({ word: chars(I.word) }); T.yn(`Is '${lo}' special?`, L < U, `Last lower ${L}, first upper ${U}.`); if (L < U) c++; } return c; })(); T.n('Special letters?', res, 'Every lower case copy comes before every upper case copy.'); return res; }
  });

  D('valid-word', {
    t: 'Valid Word',
    r: 'At least 3 characters, only letters or digits, at least one vowel and one consonant.',
    g: R => ({ word: R.str(R.int(1, 6), 'aB3$k') }),
    s(I, T) { const res = (() => { const w = I.word; T.at({ word: chars(w) }); T.yn('Only letters and digits?', /^[a-zA-Z0-9]+$/.test(w), 'No @, # or $.'); T.yn('Has a vowel?', /[aeiouAEIOU]/.test(w), 'At least one is needed.'); T.yn('Has a consonant?', /[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z]/.test(w), 'At least one is needed.'); return w.length >= 3 && /^[a-zA-Z0-9]+$/.test(w) && /[aeiouAEIOU]/.test(w) && /[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z]/.test(w); })(); T.yn('Is the word valid?', res, 'Length 3 or more, and every rule holds.'); return res; }
  });

  D('minimum-number-of-operations-to-make-word-k-periodic', {
    t: 'Make a Word k-Periodic',
    r: 'Split into n divided by k blocks; keep the most frequent block and overwrite the rest: answer = blocks − max frequency.',
    g: R => { const k = R.int(1, 3); return { word: words(R, R.int(1, 4), 'ab', k, k).join(''), k }; },
    s(I, T) { const res = (() => { const b = []; for (let i = 0; i < I.word.length; i += I.k) b.push(I.word.substr(i, I.k)); const c = cnt(b), mx = Math.max(...Object.values(c)); T.at({ blocks: A(b), counts: K(c) }); T.n('How many blocks of length k?', b.length, 'Length divided by k.'); T.n('Most frequent block count?', mx, 'Keep that block.'); return b.length - mx; })(); T.n('Fewest operations?', res, 'Replace every other block.'); return res; }
  });

  D('minimum-length-of-anagram-concatenation', {
    t: 'Minimum Anagram Block Length',
    r: 'Try each divisor L of n in increasing order; L works if every block of length L has the same letter counts.',
    g: R => { const t = R.str(R.int(1, 3), 'abc'); return { s: Array.from({ length: R.int(1, 3) }, () => R.shuffle([...t]).join('')).join('') + (R.chance(0.2) ? 'c' : '') }; },
    s(I, T) { const res = (() => { const n = I.s.length, key = x => [...x].sort().join(''); for (let L = 1; L <= n; L++) { if (n % L) continue; const k0 = key(I.s.slice(0, L)); let ok = true; for (let i = L; i < n; i += L) if (key(I.s.substr(i, L)) !== k0) { ok = false; break; } T.at({ s: chars(I.s), L }); T.yn(`Does block length ${L} work?`, ok, 'All blocks are anagrams.'); if (ok) return L; } return n; })(); T.n('Minimum length of t?', res, 'The first block length that works.'); return res; }
  });

  D('permutation-difference-between-two-strings', {
    t: 'Permutation Difference',
    r: 'Sum |index in s − index in t| over all characters.',
    g: R => { const s = R.shuffle([...'abcde']).slice(0, R.int(1, 5)).join(''); return { s, t: R.shuffle([...s]).join('') }; },
    s(I, T) { let t = 0; for (const c of I.s) { const d = Math.abs(I.s.indexOf(c) - I.t.indexOf(c)); T.at({ s: chars(I.s), t: chars(I.t) }); T.n(`Difference for '${c}'?`, d, 'Index gap.'); t += d; } return t; }
  });

  D('string-compression-iii', {
    t: 'String Compression III: runs capped at 9',
    r: 'Take the longest prefix of one repeated letter, at most 9 long; append count + letter; repeat.',
    g: R => ({ word: Array.from({ length: R.int(1, 4) }, () => R.pick(['a', 'b']).repeat(R.int(1, 12))).join('') }),
    s(I, T) { let i = 0, out = ''; while (i < I.word.length) { let j = i; while (j < I.word.length && I.word[j] === I.word[i] && j - i < 9) j++; T.at({ word: I.word.length > 30 ? I.word.slice(i, i + 20) : I.word, at: i }); T.n('Length of this chunk?', j - i, 'Same letter, at most 9.'); out += (j - i) + I.word[i]; i = j; } return out; }
  });

  D('better-compression-of-string', {
    t: 'Better Compression of String',
    r: 'Parse letter + number pairs, add counts per letter, and output letters alphabetically.',
    g: R => ({ compressed: Array.from({ length: R.int(1, 4) }, () => R.pick(['a', 'b', 'c']) + R.int(1, 12)).join('') }),
    s(I, T) { const res = (() => { const m = {}; for (const [, c, n] of I.compressed.matchAll(/([a-z])(\d+)/g)) m[c] = (m[c] || 0) + +n; const f = Object.keys(m).sort()[0]; T.at({ totals: K(m) }); T.n('Distinct letters?', Object.keys(m).length, 'One piece each in the answer.'); T.n(`Total count of '${f}'?`, m[f], 'Sum its pieces.'); return Object.keys(m).sort().map(k => k + m[k]).join(''); })(); T.n('Length of the result?', res.length, 'Letters plus their digits.'); return res; }
  });

  D('find-the-encrypted-string', {
    t: 'Find the Encrypted String',
    r: 'Character i becomes s[(i + k) mod n].',
    g: R => ({ s: R.str(R.int(1, 6), 'dart'), k: R.int(1, 12) }),
    s(I, T) { const n = I.s.length; T.at({ s: chars(I.s), k: I.k }); T.n('Source index for position 0?', I.k % n, 'The remainder of k divided by n.'); T.n('Source index for the last position?', (n - 1 + I.k) % n, 'Move k places, wrapping around.'); T.c('First letter of the result?', [...new Set([I.s[I.k % n], 'd', 'a', 'r', 't'])], I.s[I.k % n], 'The letter at the source index.'); return [...I.s].map((_, i) => I.s[(i + I.k) % n]).join(''); }
  });

  D('minimum-length-of-string-after-operations', {
    t: 'Minimum Length After Operations',
    r: 'Each operation removes two copies of a letter while one remains between. A letter with count c ends at 1 if c is odd, 2 if c is even.',
    g: R => ({ s: R.str(R.int(1, 10), 'abc') }),
    s(I, T) { const c = cnt(I.s); let t = 0; for (const k of Object.keys(c).sort()) { const v = c[k] % 2 ? 1 : 2; T.at({ counts: K(c) }); T.n(`Copies of '${k}' left?`, v, `${c[k]} is ${c[k] % 2 ? 'odd' : 'even'}.`); t += v; } return t; }
  });

  D('count-the-number-of-substrings-with-dominant-ones', {
    t: 'Substrings With Dominant Ones',
    r: 'A substring is dominant if ones at least zeros². Since zeros at most √n in any dominant substring, enumerate start and zero count; here we check every substring.',
    g: R => ({ s: R.str(R.int(1, 7), '0111') }),
    s(I, T) { let tot = 0; for (let i = 0; i < I.s.length; i++) { let o = 0, z = 0, row = 0; for (let j = i; j < I.s.length; j++) { if (I.s[j] === '1') o++; else z++; if (o >= z * z) row++; } if (i < 5) { T.at({ s: chars(I.s), start: i }); T.n(`Dominant substrings starting at ${i}?`, row, 'ones at least zeros².'); } tot += row; } return tot; }
  });

  D('report-spam-message', {
    t: 'Report Spam Message',
    r: 'Put banned words in a set; spam if at least two message words are in it.',
    g: R => ({ message: words(R, R.int(1, 5), 'ab', 1, 2), bannedWords: words(R, R.int(1, 3), 'ab', 1, 2) }),
    s(I, T) { const b = new Set(I.bannedWords); let c = 0; for (const w of I.message) { const hit = b.has(w); T.at({ banned: A([...b]), word: w, hits: c }); T.yn(`Is "${w}" banned?`, hit, 'Set lookup.'); if (hit && ++c >= 2) return true; } return false; }
  });

  D('find-the-occurrence-of-first-almost-equal-substring', {
    t: 'First Almost-Equal Substring',
    r: 'Return the smallest i where s[i to i+m) differs from pattern in at most one place. Z-functions on pattern+s and on the reverses make each check O(1).',
    g: R => { const s = R.str(R.int(3, 9), 'ab'); return { s, pattern: R.str(R.int(1, s.length - 1), 'ab') }; },
    s(I, T) { const res = (() => { const m = I.pattern.length; for (let i = 0; i + m <= I.s.length; i++) { let d = 0; for (let j = 0; j < m && d < 2; j++) if (I.s[i + j] !== I.pattern[j]) d++; T.at({ s: chars(I.s), at: i, pattern: I.pattern }); T.yn(`At most one mismatch at index ${i}?`, d <= 1, 'Count differences.'); if (d <= 1) return i; } return -1; })(); T.n('Answer (−1 if none)?', res, 'The first window that works.'); return res; }
  });

  D('find-the-original-typed-string-i', {
    t: 'Original Typed String I',
    r: 'At most one key was held too long. The original is word itself, or any run shortened: 1 + the sum of (run length − 1).',
    g: R => ({ word: R.str(R.int(1, 8), 'aab') }),
    s(I, T) { const res = (() => { let extra = 0; for (let i = 1; i < I.word.length; i++) if (I.word[i] === I.word[i - 1]) extra++; T.at({ word: chars(I.word) }); T.n('Runs of equal letters?', I.word.length - extra, 'Each run starts with a new letter.'); T.n('Positions equal to their predecessor?', extra, 'Each could be the last of a shortened run.'); return 1 + extra; })(); T.n('Possible original strings?', res, 'The word itself, plus one per extra position.'); return res; }
  });

  D('check-balanced-string', {
    t: 'Check Balanced String',
    r: 'Compare the digit sum at even indices with the digit sum at odd indices.',
    g: R => ({ num: R.str(R.int(2, 7), '0123') }),
    s(I, T) { const res = (() => { let e = 0, o = 0; [...I.num].forEach((c, i) => i % 2 ? o += +c : e += +c); T.at({ num: chars(I.num) }); T.n('Sum at even indices?', e, 'Indices 0, 2, 4…'); T.n('Sum at odd indices?', o, 'Indices 1, 3, 5…'); return e === o; })(); T.yn('Is the string balanced?', res, 'The two sums must match.'); return res; }
  });

  D('rearrange-k-substrings-to-form-target-string', {
    t: 'Rearrange k Substrings',
    r: 'Split both strings into k blocks of length n divided by k; possible exactly when the multisets of blocks match.',
    g: R => { const k = R.int(1, 4), L = R.int(1, 2); const b = words(R, k, 'ab', L, L); return { s: b.join(''), t: (R.chance(0.6) ? R.shuffle(b) : [...b.join('')].reverse().join('').match(new RegExp(`.{${L}}`, 'g'))).join(''), k }; },
    s(I, T) { const res = (() => { const L = I.s.length / I.k, sp = x => x.match(new RegExp(`.{${L}}`, 'g')), a = cnt(sp(I.s)), b = cnt(sp(I.t)); T.at({ sBlocks: K(a), tBlocks: K(b) }); T.n('Block length?', L, 'Length of s divided by k.'); T.n('Distinct blocks in s?', Object.keys(a).length, 'Compare the block counts.'); return Object.keys(a).length === Object.keys(b).length && Object.keys(a).every(x => a[x] === b[x]); })(); T.yn('Can the blocks be rearranged into t?', res, 'Same blocks, same counts.'); return res; }
  });

  D('substring-matching-pattern', {
    t: 'Substring Matching a * Pattern',
    r: 'Split p at "*": find the left part at the earliest index i, then the right part anywhere at or after i + |left|.',
    g: R => ({ s: R.str(R.int(1, 7), 'abc'), p: R.str(R.int(0, 2), 'ab') + '*' + R.str(R.int(0, 2), 'bc') }),
    s(I, T) { const res = (() => { const [L, Rt] = I.p.split('*'), i = I.s.indexOf(L); T.at({ s: chars(I.s), left: L, right: Rt }); T.n('Earliest index of the left part (−1 if none)?', i, 'Search from the start.'); if (i < 0) return false; T.n('Earliest index of the right part after it (−1 if none)?', I.s.indexOf(Rt, i + L.length), 'Search after the left part ends.'); return I.s.indexOf(Rt, i + L.length) >= 0; })(); T.yn('Does s contain a match?', res, 'Both parts must be found in order.'); return res; }
  });

  D('find-valid-pair-of-adjacent-digits-in-string', {
    t: 'Valid Pair of Adjacent Digits',
    r: 'Count digits. Return the first adjacent pair of different digits where each digit d occurs exactly d times (or "").',
    g: R => ({ s: R.str(R.int(2, 8), '1223') }),
    s(I, T) { const c = cnt(I.s); for (let i = 0; i + 1 < I.s.length; i++) { const a = I.s[i], b = I.s[i + 1], ok = a !== b && c[a] === +a && c[b] === +b; T.at({ s: chars(I.s), counts: K(c) }); T.yn(`Is "${a}${b}" valid?`, ok, 'Different digits, each count equals its value.'); if (ok) return a + b; } return ''; }
  });

  D('maximum-difference-between-even-and-odd-frequency-i', {
    t: 'Max Odd Frequency − Min Even Frequency',
    r: 'Take the largest odd frequency and the smallest even frequency; subtract.',
    g: R => ({ s: 'aab' + R.str(R.int(0, 6), 'abc') }),
    s(I, T) { const res = (() => { const v = Object.values(cnt(I.s)), o = Math.max(...v.filter(x => x % 2)), e = Math.min(...v.filter(x => x % 2 === 0)); T.at({ counts: K(cnt(I.s)) }); T.n('Largest odd frequency?', o, 'Among odd counts.'); T.n('Smallest even frequency?', e, 'Among even counts.'); return o - e; })(); T.n('Maximum difference?', res, 'Largest odd minus smallest even.'); return res; }
  });

  D('find-special-substring-of-length-k', {
    t: 'Special Substring of Length k',
    r: 'Look for a run of one letter of length exactly k (the neighbors on both sides differ).',
    g: R => ({ s: R.str(R.int(1, 8), 'aab'), k: R.int(1, 3) }),
    s(I, T) { const runs = I.s.match(/(.)\1*/g); for (const r of runs) { T.at({ runs: A(runs), k: I.k }); T.yn(`Is run "${r}" exactly ${I.k} long?`, r.length === I.k, 'Whole runs only.'); if (r.length === I.k) return true; } return false; }
  });
})();
