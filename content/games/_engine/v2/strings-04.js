/* v2 games: strings (04). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const cnt = s => { const m = {}; for (const c of s) m[c] = (m[c] || 0) + 1; return m; };
  const chars = s => A([...s]);
  const words = (R, n, al, lo, hi) => Array.from({ length: n }, () => R.str(R.int(lo || 1, hi || 4), al || 'abc'));
  const evalParen = e => { const m = e.match(/^(\d*)\((\d+)\+(\d+)\)(\d*)$/); return m ? (m[1] ? +m[1] : 1) * (+m[2] + +m[3]) * (m[4] ? +m[4] : 1) : NaN; };
  const mins = t => +t.slice(0, 2) * 60 + +t.slice(-2);

  D('cells-in-a-range-on-an-excel-sheet', {
    t: 'Cells in an Excel Range',
    r: 'Loop columns from the first letter to the last, and inside it rows from the first digit to the last.',
    g: R => { const c1 = R.int(0, 4), r1 = R.int(1, 5); return { s: `${String.fromCharCode(65 + c1)}${r1}:${String.fromCharCode(65 + c1 + R.int(0, 2))}${r1 + R.int(0, 2)}` }; },
    s(I, T) { const s = I.s, out = []; const nc = s.charCodeAt(3) - s.charCodeAt(0) + 1, nr = +s[4] - +s[1] + 1; T.at({ range: s }); T.n('How many columns?', nc, 'From the first letter to the last.'); T.n('How many rows?', nr, 'From the first number to the last.'); T.n('How many cells?', nc * nr, `${nc} columns times ${nr} rows.`); for (let c = s.charCodeAt(0); c <= s.charCodeAt(3); c++) for (let r = +s[1]; r <= +s[4]; r++) out.push(String.fromCharCode(c) + r); return out; }
  });

  D('minimize-result-by-adding-parentheses-to-expression', {
    t: 'Minimize Result With Parentheses',
    r: 'Try every left split of num1 and right split of num2: value = (left prefix or 1) × (inner sum) × (right suffix or 1). Keep the smallest.',
    cmp: (o, e) => evalParen(o) === evalParen(e),
    g: R => ({ expression: R.str(R.int(1, 3), '123456789') + '+' + R.str(R.int(1, 3), '123456789') }),
    s(I, T) { const [a, b] = I.expression.split('+'); let best = Infinity, out = ''; for (let i = 0; i < a.length; i++) for (let j = 1; j <= b.length; j++) { const e = `${a.slice(0, i)}(${a.slice(i)}+${b.slice(0, j)})${b.slice(j)}`, v = evalParen(e); if (v < best) { best = v; out = e; } } T.at({ expression: I.expression }); T.n('How many placements are there to try?', a.length * b.length, 'Every left split of num1 times every right split of num2.'); T.n('Value with the parentheses around the whole sum?', +a + +b, 'Nothing is multiplied outside.'); T.n('Smallest possible value?', best, 'Try every placement.'); return out; }
  });

  D('count-prefixes-of-a-given-string', {
    t: 'Count Prefixes of a String',
    r: 'Count words (with duplicates) that s starts with.',
    g: R => ({ words: words(R, R.int(1, 5), 'ab', 1, 3), s: R.str(R.int(1, 4), 'ab') }),
    s(I, T) { return I.words.filter(w => { const ok = I.s.startsWith(w); T.at({ s: I.s, word: w }); T.yn(`Is "${w}" a prefix of "${I.s}"?`, ok, 'Prefix check.'); return ok; }).length; }
  });

  D('largest-3-same-digit-number-in-string', {
    t: 'Largest 3-Same-Digit Number',
    r: 'Scan windows of three equal digits; return the largest such digit tripled, or "".',
    g: R => ({ num: R.str(R.int(3, 9), '0779') }),
    s(I, T) { let best = ''; for (let i = 0; i + 2 < I.num.length; i++) if (I.num[i] === I.num[i + 1] && I.num[i] === I.num[i + 2] && I.num.substr(i, 3) > best) best = I.num.substr(i, 3); T.at({ num: chars(I.num) }); T.n('How many windows of three digits are there?', I.num.length - 2, 'One starting at each index except the last two.'); T.yn('Is there any run of three equal digits?', best !== '', 'Check every window.'); T.n('Value of the answer as a number (−1 if empty)?', best === '' ? -1 : +best, 'Keep the largest run.'); return best; }
  });

  D('find-resultant-array-after-removing-anagrams', {
    t: 'Remove Adjacent Anagrams',
    r: 'Keep a word unless it is an anagram of the last kept word.',
    g: R => ({ words: words(R, R.int(1, 6), 'ab', 1, 3) }),
    s(I, T) { const key = w => [...w].sort().join(''), out = [I.words[0]]; for (const w of I.words.slice(1)) { const an = key(w) === key(out[out.length - 1]); T.at({ kept: A(out), word: w }); T.yn(`Is "${w}" an anagram of the last kept word?`, an, 'Compare sorted letters.'); if (!an) out.push(w); } if (I.words.length === 1) T.n('Words kept?', 1, 'Nothing to compare.'); return out; }
  });

  D('percentage-of-letter-in-string', {
    t: 'Percentage of Letter',
    r: '⌊100 × count / length⌋.',
    g: R => ({ s: R.str(R.int(1, 9), 'abo'), letter: R.pick(['a', 'o', 'k']) }),
    s(I, T) { const c = [...I.s].filter(x => x === I.letter).length; T.at({ s: chars(I.s), letter: I.letter }); T.n(`How many '${I.letter}'?`, c, 'Count.'); T.n('Length of s?', I.s.length, 'The denominator.'); T.n('Percentage, rounded down?', Math.floor(100 * c / I.s.length), '100 times count divided by length, rounded down.'); return Math.floor(100 * c / I.s.length); }
  });

  D('check-if-number-has-equal-digit-count-and-digit-value', {
    t: 'Digit Count Equals Digit Value',
    r: 'For each index i, digit i must occur exactly num[i] times.',
    g: R => ({ num: R.chance(0.3) ? R.pick(['1210', '2020', '21200']) : R.str(R.int(1, 5), '0123') }),
    s(I, T) { const c = cnt(I.num); for (let i = 0; i < I.num.length; i++) { const ok = (c[String(i)] || 0) === +I.num[i]; T.at({ num: chars(I.num), counts: K(c) }); T.yn(`Does digit ${i} occur ${I.num[i]} times?`, ok, `It occurs ${c[String(i)] || 0} times.`); if (!ok) return false; } return true; }
  });

  D('sender-with-largest-word-count', {
    t: 'Sender With Largest Word Count',
    r: 'Sum words per sender; pick the max, breaking ties by the lexicographically larger name.',
    g: R => { const n = R.int(1, 5); return { messages: Array.from({ length: n }, () => Array.from({ length: R.int(1, 3) }, () => 'w').join(' ')), senders: Array.from({ length: n }, () => R.pick(['Alice', 'bob', 'Bob'])) }; },
    s(I, T) { const m = {}; I.senders.forEach((s, i) => { m[s] = (m[s] || 0) + I.messages[i].split(' ').length; }); T.at({ words: K(m) }); const best = Object.keys(m).sort((a, b) => m[b] - m[a] || (a < b ? 1 : -1))[0]; T.n('Largest word count?', m[best], 'Max over senders.'); T.n('How many different senders?', Object.keys(m).length, 'Names are case-sensitive.'); T.c('Sender with the largest word count?', Object.keys(m), best, 'Ties go to the lexicographically larger name.'); return best; }
  });

  D('rearrange-characters-to-make-target-string', {
    t: 'Copies of Target From s',
    r: 'Answer = min over target letters of ⌊count_s(c) / count_target(c)⌋.',
    g: R => ({ s: R.str(R.int(1, 12), 'abcdeo'), target: R.str(R.int(1, 3), 'abc') }),
    s(I, T) { const a = cnt(I.s), b = cnt(I.target); let r = Infinity; for (const k in b) { const v = Math.floor((a[k] || 0) / b[k]); T.at({ s: K(a), need: K(b) }); T.n(`Copies limited by '${k}'?`, v, `${a[k] || 0} divided by ${b[k]}, rounded down.`); r = Math.min(r, v); } T.n('Copies of target you can make?', r, 'The smallest limit over all letters.'); return r; }
  });

  D('apply-discount-to-prices', {
    t: 'Apply Discount to Prices',
    r: 'A word is a price if it is "$" followed by digits only. Replace it with price × (100 − d)/100 to two decimals.',
    g: R => ({ sentence: Array.from({ length: R.int(1, 5) }, () => R.pick(['$1', '$20', '5$', '$', '$1e', 'a', '$7'])).join(' '), discount: R.pick([0, 10, 50, 100]) }),
    s(I, T) { return I.sentence.split(' ').map(w => { const ok = /^\$\d+$/.test(w); T.at({ word: w }); T.yn(`Is "${w}" a price?`, ok, '$ then digits only.'); return ok ? '$' + (Number(w.slice(1)) * (100 - I.discount) / 100).toFixed(2) : w; }).join(' '); }
  });

  D('strong-password-checker-ii', {
    t: 'Strong Password Checker II',
    r: 'Need length ≥ 8, a lower, an upper, a digit, a special from "!@#$%^&*()-+", and no two equal adjacent characters.',
    g: R => ({ password: R.str(R.int(4, 12), 'aAb1!-') }),
    s(I, T) { const p = I.password; T.at({ password: chars(p) }); T.yn('Two equal adjacent characters?', /(.)\1/.test(p), 'Scan neighbors.'); T.yn('At least 8 characters?', p.length >= 8, `Length ${p.length}.`); T.yn('Has a lower case letter, an upper case letter, a digit and a special character?', /[a-z]/.test(p) && /[A-Z]/.test(p) && /\d/.test(p) && /[!@#$%^&*()\-+]/.test(p), 'All four kinds are required.'); return p.length >= 8 && /[a-z]/.test(p) && /[A-Z]/.test(p) && /\d/.test(p) && /[!@#$%^&*()\-+]/.test(p) && !/(.)\1/.test(p); }
  });

  D('match-substring-after-replacement', {
    t: 'Match Substring After Replacement',
    r: 'For each start i, every sub[j] must equal s[i + j] or be mappable to it (mapping set of pairs). Each sub character may be replaced at most once, which a per-position check satisfies.',
    g: R => ({ s: R.str(R.int(2, 7), 'ab13'), sub: R.str(R.int(1, 2), 'ab'), mappings: Array.from({ length: R.int(0, 2) }, () => [R.pick(['a', 'b']), R.pick(['1', '3'])]) }),
    s(I, T) { const m = new Set(I.mappings.map(([a, b]) => a + b)); for (let i = 0; i + I.sub.length <= I.s.length; i++) { const ok = [...I.sub].every((c, j) => c === I.s[i + j] || m.has(c + I.s[i + j])); T.at({ s: chars(I.s), at: i, sub: I.sub }); T.yn(`Does sub match at index ${i}?`, ok, 'Equal or mapped at every position.'); if (ok) return true; } return false; }
  });

  D('greatest-english-letter-in-upper-and-lower-case', {
    t: 'Greatest Letter in Both Cases',
    r: 'Scan Z down to A; return the first letter whose upper and lower forms both appear.',
    g: R => ({ s: R.str(R.int(1, 8), 'aAbBcz') }),
    s(I, T) { const set = new Set(I.s); T.at({ s: chars(I.s) }); T.n('Distinct characters in s?', set.size, 'Upper and lower case count separately.'); T.n('Letters that appear in both cases?', [...Array(26).keys()].filter(c => set.has(String.fromCharCode(65 + c)) && set.has(String.fromCharCode(97 + c))).length, 'Check each letter for both forms.'); for (let c = 25; c >= 0; c--) { const U = String.fromCharCode(65 + c), L = String.fromCharCode(97 + c); if (set.has(U) && set.has(L)) { T.at({ s: chars(I.s) }); T.c('Greatest letter in both cases?', [...new Set([U, 'A', 'B', 'C'])], U, 'Scan from Z down.'); return U; } } T.at({ s: chars(I.s) }); T.yn('Does any letter appear in both cases?', false, 'Then return "".'); return ''; }
  });

  D('count-asterisks', {
    t: 'Count Asterisks Outside Bar Pairs',
    r: 'Toggle "inside" at every |; count * only when outside.',
    g: R => ({ s: Array.from({ length: R.int(0, 2) }, () => R.str(R.int(0, 3), 'a*') + '|' + R.str(R.int(0, 3), 'a*') + '|').join('') + R.str(R.int(1, 3), 'a*') }),
    s(I, T) { let inside = false, c = 0; for (const ch of I.s) { if (ch === '|') inside = !inside; else if (ch === '*' && !inside) c++; } T.at({ s: chars(I.s) }); T.n('How many bars are there?', [...I.s].filter(x => x === '|').length, 'They come in pairs.'); T.n('Asterisks in total?', [...I.s].filter(x => x === '*').length, 'Inside and outside the pairs.'); T.n('Asterisks outside bar pairs?', c, 'Toggle at each |.'); return c; }
  });

  D('decode-the-message', {
    t: 'Decode the Message',
    r: 'Build the substitution table from the first appearance of each letter in key (first → a, second → b, …); spaces stay.',
    g: R => ({ key: R.shuffle([...'abcdefghijklmnopqrstuvwxyz']).join(''), message: Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 4), 'abcdef')).join(' ') }),
    s(I, T) { const m = {}; let k = 0; for (const c of I.key) if (c !== ' ' && !(c in m)) m[c] = String.fromCharCode(97 + k++); const f = I.message.replace(' ', '')[0]; T.at({ key: I.key }); T.c(`'${f}' decodes to?`, [...new Set([m[f], 'a', 'b', 'c'])], m[f], 'Its rank of first appearance in key.'); const first = [...I.key].find(c => c !== ' '); T.c('Which key letter decodes to a?', [...new Set([first, 'a', 'b', 'z'])], first, 'The first letter to appear in key.'); T.n('Spaces kept in the decoded message?', [...I.message].filter(c => c === ' ').length, 'Spaces are not substituted.'); return [...I.message].map(c => c === ' ' ? ' ' : m[c]).join(''); }
  });

  D('check-distances-between-same-letters', {
    t: 'Check Distances Between Same Letters',
    r: 'For each letter, the gap between its two occurrences (letters strictly between) must equal distance[letter].',
    g: R => { const l = R.shuffle(['a', 'b', 'c']).slice(0, R.int(1, 3)); const s = R.shuffle([...l, ...l]).join(''); const d = Array(26).fill(0); l.forEach(c => d[c.charCodeAt(0) - 97] = R.chance(0.7) ? s.lastIndexOf(c) - s.indexOf(c) - 1 : R.int(0, 3)); return { s, distance: d }; },
    s(I, T) { for (const c of new Set(I.s)) { const g = I.s.lastIndexOf(c) - I.s.indexOf(c) - 1, ok = g === I.distance[c.charCodeAt(0) - 97]; T.at({ s: chars(I.s), letter: c }); T.n(`Letters between the two '${c}'s?`, g, 'Index gap − 1.'); if (!ok) return false; } return true; }
  });

  D('length-of-the-longest-alphabetical-continuous-substring', {
    t: 'Longest Alphabetical Continuous Substring',
    r: 'Extend the run when s[i] is the next letter after s[i − 1]; otherwise restart at 1.',
    g: R => ({ s: R.str(R.int(1, 10), 'abcd') }),
    s(I, T) { let run = 1, best = 1; for (let i = 1; i < I.s.length; i++) { run = I.s.charCodeAt(i) === I.s.charCodeAt(i - 1) + 1 ? run + 1 : 1; best = Math.max(best, run); if (i < 8) { T.at({ s: chars(I.s), at: i }); T.n(`Run length ending at ${i}?`, run, 'Next letter extends.'); } } if (I.s.length === 1) T.n('Answer for one letter?', 1, 'Single run.'); return best; }
  });

  D('sort-the-people', {
    t: 'Sort the People by Height',
    r: 'Sort indices by height descending, then map to names.',
    g: R => { const n = R.int(1, 5); return { names: words(R, n, 'abc', 1, 3), heights: R.distinct(n, 150, 190) }; },
    s(I, T) { const o = I.names.map((_, i) => i).sort((a, b) => I.heights[b] - I.heights[a]); T.at({ names: A(I.names), heights: A(I.heights) }); T.c('Who is first?', [...new Set(I.names)], I.names[o[0]], 'Tallest first.'); T.n('Height of the tallest person?', Math.max(...I.heights), 'They go first.'); T.c('Who is last?', [...new Set(I.names)], I.names[o[o.length - 1]], 'The shortest goes last.'); return o.map(i => I.names[i]); }
  });

  D('remove-letter-to-equalize-frequency', {
    t: 'Remove One Letter to Equalize Frequency',
    r: 'Try removing each distinct letter once and check whether all remaining positive counts are equal.',
    g: R => ({ word: R.str(R.int(2, 7), 'abc') }),
    s(I, T) { const c = cnt(I.word); for (const k of Object.keys(c).sort()) { c[k]--; const v = Object.values(c).filter(x => x > 0), ok = new Set(v).size === 1; T.at({ counts: K(c), removed: k }); T.yn(`After removing one '${k}', are counts equal?`, ok, 'One distinct positive count.'); c[k]++; if (ok) return true; } return false; }
  });

  D('number-of-valid-clock-times', {
    t: 'Number of Valid Clock Times',
    r: 'Count hours 00–23 matching the hh pattern and minutes 00–59 matching mm; multiply.',
    g: R => ({ time: [R.pick(['0', '1', '2', '?']), R.pick(['0', '3', '5', '?']), ':', R.pick(['0', '4', '?']), R.pick(['0', '9', '?'])].join('') }),
    s(I, T) { const fit = (p, v) => [...p].every((c, i) => c === '?' || c === v[i]); let h = 0, m = 0; for (let x = 0; x < 24; x++) if (fit(I.time.slice(0, 2), String(x).padStart(2, '0'))) h++; for (let x = 0; x < 60; x++) if (fit(I.time.slice(3), String(x).padStart(2, '0'))) m++; T.at({ time: I.time }); T.n('Valid hours?', h, 'Match 00 to 23.'); T.n('Valid minutes?', m, 'Match 00 to 59.'); T.n('Valid times?', h * m, 'Hours times minutes.'); return h * m; }
  });

  D('determine-if-two-events-have-conflict', {
    t: 'Two Events Conflict',
    r: 'Inclusive intervals overlap iff start1 ≤ end2 and start2 ≤ end1 (HH:MM strings compare correctly).',
    g: R => { const t = () => `${String(R.int(1, 4)).padStart(2, '0')}:${R.pick(['00', '30'])}`; const ev = () => [t(), t()].sort(); return { event1: ev(), event2: ev() }; },
    s(I, T) { T.at({ event1: A(I.event1), event2: A(I.event2) }); T.yn('Does event 1 start no later than event 2 ends?', I.event1[0] <= I.event2[1], 'First condition.'); T.yn('Does event 2 start no later than event 1 ends?', I.event2[0] <= I.event1[1], 'Second condition.'); T.yn('Do the events conflict?', I.event1[0] <= I.event2[1] && I.event2[0] <= I.event1[1], 'Both conditions must hold.'); return I.event1[0] <= I.event2[1] && I.event2[0] <= I.event1[1]; }
  });

  D('odd-string-difference', {
    t: 'Odd String Difference',
    r: 'Compute each word\'s difference array; exactly one word\'s array differs from the others.',
    g: R => { const n = R.int(2, 3), base = R.str(n, 'abc'); const ws = Array.from({ length: R.int(2, 4) }, (_, i) => [...base].map(c => String.fromCharCode(c.charCodeAt(0) + i)).join('')); let odd; do odd = R.str(n, 'abcd'); while ([...odd].slice(1).map((c, i) => c.charCodeAt(0) - odd.charCodeAt(i)).join() === [...base].slice(1).map((c, i) => c.charCodeAt(0) - base.charCodeAt(i)).join()); ws.splice(R.int(0, ws.length), 0, odd); return { words: ws }; },
    s(I, T) { const key = w => [...w].slice(1).map((c, i) => c.charCodeAt(0) - w.charCodeAt(i)).join(','), ks = I.words.map(key), c = cnt(ks); T.at({ words: A(I.words), diffs: A(ks) }); const i = ks.findIndex(k => c[k] === 1); T.n('How many distinct difference arrays are there?', Object.keys(c).length, 'One shared by most words, and one odd one.'); T.n('Index of the odd word?', i, 'Its difference array is unique.'); T.c('Which word is odd?', [...new Set(I.words)], I.words[i], 'The one with the unique difference array.'); return I.words[i]; }
  });

  D('circular-sentence', {
    t: 'Circular Sentence',
    r: 'Each word\'s last letter must equal the next word\'s first letter, wrapping around to the first word.',
    g: R => ({ sentence: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 3), 'ab')).join(' ') }),
    s(I, T) { const w = I.sentence.split(' '); T.at({ words: A(w) }); T.n('How many links to check, including the wrap-around?', w.length, 'One after each word.'); for (let i = 0; i < w.length; i++) { const a = w[i], b = w[(i + 1) % w.length], ok = a[a.length - 1] === b[0]; T.at({ words: A(w, { hl: [i] }) }); T.yn(`Does "${a}" connect to "${b}"?`, ok, 'Last letter = next first letter.'); if (!ok) { T.yn('Is the sentence circular?', false, 'One broken link is enough.'); return false; } } T.yn('Is the sentence circular?', true, 'Every link holds.'); return true; }
  });

  D('maximum-value-of-a-string-in-an-array', {
    t: 'Maximum Value of a String',
    r: 'A digits-only string\'s value is its number; otherwise its length. Take the max.',
    g: R => ({ strs: words(R, R.int(1, 5), 'a0193', 1, 4) }),
    s(I, T) { return Math.max(...I.strs.map(s => { const v = /^\d+$/.test(s) ? +s : s.length; T.at({ str: s }); T.n(`Value of "${s}"?`, v, /^\d+$/.test(s) ? 'Digits only → number.' : 'Has a letter → length.'); return v; })); }
  });

  D('shortest-distance-to-target-string-in-a-circular-array', {
    t: 'Shortest Distance in a Circular Array',
    r: 'For each index holding target, distance = min(|i − start|, n − |i − start|). Take the min (or −1).',
    g: R => { const n = R.int(1, 6); return { words: words(R, n, 'ab', 1, 1), target: 'a', startIndex: R.int(0, n - 1) }; },
    s(I, T) { const n = I.words.length; let best = -1; I.words.forEach((w, i) => { if (w !== I.target) return; const d = Math.min(Math.abs(i - I.startIndex), n - Math.abs(i - I.startIndex)); T.at({ words: A(I.words, { hl: [i] }), start: I.startIndex }); T.n(`Circular distance to index ${i}?`, d, 'Shorter way around.'); if (best < 0 || d < best) best = d; }); if (best < 0) { T.at({ words: A(I.words) }); T.yn('Is the target present?', false, 'Return −1.'); } return best; }
  });

  D('make-number-of-distinct-characters-equal', {
    t: 'Equalize Distinct Characters With One Swap',
    r: 'Try all 26 × 26 letter pairs (x from word1, y from word2) that exist; simulate the swap on the counts and compare distinct counts.',
    g: R => ({ word1: R.str(R.int(1, 5), 'abc'), word2: R.str(R.int(1, 5), 'abcd') }),
    s(I, T) { const a = cnt(I.word1), b = cnt(I.word2), d = m => Object.values(m).filter(v => v > 0).length; T.at({ counts1: K(a), counts2: K(b) }); T.n('Distinct letters in word1 now?', d(a), 'Before any swap.'); T.n('Distinct letters in word2 now?', d(b), 'Before any swap.'); for (const x in a) for (const y in b) { const A1 = { ...a }, B1 = { ...b }; A1[x]--; A1[y] = (A1[y] || 0) + 1; B1[y]--; B1[x] = (B1[x] || 0) + 1; if (d(A1) === d(B1)) { T.yn('Can one swap make the distinct counts equal?', true, 'A pair of letters works.'); return true; } } T.yn('Can one swap make the distinct counts equal?', false, 'No pair of letters works.'); return false; }
  });

  D('count-the-number-of-vowel-strings-in-range', {
    t: 'Vowel Strings in Range',
    r: 'Count words in [left, right] that start and end with a vowel.',
    g: R => { const n = R.int(1, 5), l = R.int(0, n - 1); return { words: words(R, n, 'aeb', 1, 3), left: l, right: R.int(l, n - 1) }; },
    s(I, T) { let c = 0; for (let i = I.left; i <= I.right; i++) { const w = I.words[i], ok = 'aeiou'.includes(w[0]) && 'aeiou'.includes(w[w.length - 1]); T.at({ words: A(I.words, { hl: [i] }) }); T.yn(`Is "${w}" a vowel string?`, ok, 'Starts and ends with a vowel.'); if (ok) c++; } T.n('Vowel strings in the range?', c, 'Count the yes answers.'); return c; }
  });

  D('find-the-longest-balanced-substring-of-a-binary-string', {
    t: 'Longest Balanced Binary Substring',
    r: 'For each block of zeros followed by a block of ones, the balanced length is 2 × min(zeros, ones).',
    g: R => ({ s: R.str(R.int(1, 10), '01') }),
    s(I, T) { const runs = I.s.match(/0+|1+/g); let best = 0; T.at({ runs: A(runs) }); T.n('How many runs of equal digits?', runs.length, 'Split s wherever the digit changes.'); for (let i = 0; i + 1 < runs.length; i++) if (runs[i][0] === '0') { const v = 2 * Math.min(runs[i].length, runs[i + 1].length); T.at({ runs: A(runs, { hl: [i, i + 1] }) }); T.n('Balanced length here?', v, 'Twice the smaller of the two runs.'); best = Math.max(best, v); } if (!best) { T.at({ runs: A(runs) }); T.yn('Is there a 0-run followed by a 1-run?', false, 'Then the answer is 0.'); } T.n('Longest balanced length?', best, 'The best over every zeros-then-ones pair.'); return best; }
  });

  D('number-of-senior-citizens', {
    t: 'Number of Senior Citizens',
    r: 'Age is characters 11–12; count ages > 60.',
    g: R => ({ details: Array.from({ length: R.int(1, 4) }, () => R.str(10, '0123456789') + R.pick(['M', 'F', 'O']) + String(R.int(10, 99)) + R.str(2, '0123456789')) }),
    s(I, T) { return I.details.filter(d => { const a = +d.slice(11, 13); T.at({ details: d }); T.n('Age?', a, 'Characters 11–12.'); return a > 60; }).length; }
  });

  D('remove-trailing-zeros-from-a-string', {
    t: 'Remove Trailing Zeros',
    r: 'Strip zeros from the end.',
    g: R => ({ num: R.str(1, '123456789') + R.str(R.int(0, 4), '01') + '0'.repeat(R.int(0, 3)) }),
    s(I, T) { const r = I.num.replace(/0+$/, ''); T.at({ num: chars(I.num) }); T.n('Trailing zeros removed?', I.num.length - r.length, 'Count from the end.'); T.yn('Does num end with 0?', I.num.endsWith('0'), 'Otherwise nothing changes.'); T.n('Length of the result?', r.length, 'Original length minus the zeros removed.'); return r; }
  });

  D('minimize-string-length', {
    t: 'Minimize String Length',
    r: 'Deletions can remove every duplicate, so the minimum is the number of distinct characters.',
    g: R => ({ s: R.str(R.int(1, 8), 'abcd') }),
    s(I, T) { T.at({ s: chars(I.s) }); const v = new Set(I.s).size; T.n('Letters that appear more than once?', Object.values(cnt(I.s)).filter(x => x > 1).length, 'Their extra copies can be deleted.'); T.n('Distinct characters?', v, 'Each letter survives once.'); T.n('Minimum length?', v, 'One copy of each distinct letter.'); return v; }
  });

  D('find-maximum-number-of-string-pairs', {
    t: 'Maximum Number of String Pairs',
    r: 'For each word, if its reverse was seen before, form a pair; then mark it seen.',
    g: R => ({ words: [...new Set(words(R, R.int(1, 6), 'abc', 2, 2))] }),
    s(I, T) { const seen = new Set(); let c = 0; for (const w of I.words) { const r = [...w].reverse().join(''), hit = seen.has(r); T.at({ seen: A([...seen]), word: w }); T.yn(`Was "${r}" seen before?`, hit, 'Reverse lookup.'); if (hit) c++; seen.add(w); } return c; }
  });

  D('sort-vowels-in-a-string', {
    t: 'Sort Vowels in a String',
    r: 'Collect vowels, sort by ASCII (uppercase first), and write them back into the vowel positions.',
    g: R => ({ s: R.str(R.int(1, 8), 'lEetcOdA') }),
    s(I, T) { const v = [...I.s].filter(c => 'aeiouAEIOU'.includes(c)).sort(); T.at({ s: chars(I.s), vowels: A(v) }); T.n('How many vowels?', v.length, 'Positions to refill.'); T.n('Upper case vowels?', v.filter(c => c < 'a').length, 'They sort before lower case.'); if (v.length) T.c('Which vowel goes into the first vowel position?', [...new Set([v[0], 'A', 'a', 'E', 'e'])], v[0], 'The smallest by ASCII.'); let k = 0; return [...I.s].map(c => 'aeiouAEIOU'.includes(c) ? v[k++] : c).join(''); }
  });

  D('split-strings-by-separator', {
    t: 'Split Strings by Separator',
    r: 'Split each word on the separator and drop empty pieces.',
    g: R => ({ words: words(R, R.int(1, 3), 'ab.', 1, 5), separator: '.' }),
    s(I, T) { const out = I.words.flatMap(w => w.split(I.separator).filter(Boolean)); T.at({ words: A(I.words) }); T.n('Non-empty pieces?', out.length, 'Split and drop empties.'); const pieces = I.words.reduce((s, w) => s + w.split(I.separator).length, 0); T.n('Pieces before dropping empties?', pieces, 'Each separator adds one piece.'); T.n('Empty pieces dropped?', pieces - out.length, 'Separators at the ends or next to each other leave empties.'); return out; }
  });

  D('check-if-a-string-is-an-acronym-of-words', {
    t: 'Is s an Acronym of Words',
    r: 's must equal the concatenation of each word\'s first letter.',
    g: R => { const w = words(R, R.int(1, 4), 'abc', 1, 3); return { words: w, s: R.chance(0.6) ? w.map(x => x[0]).join('') : R.str(R.int(1, 4), 'abc') }; },
    s(I, T) { const a = I.words.map(x => x[0]).join(''); T.at({ words: A(I.words), s: I.s }); T.c('Acronym of the words?', [...new Set([a, I.s, a.slice(1) || 'z'])], a, 'First letters.'); T.n('Length of the acronym?', a.length, 'One letter per word.'); T.yn('Does s equal the acronym?', a === I.s, 'Compare them exactly.'); return a === I.s; }
  });

  D('furthest-point-from-origin', {
    t: 'Furthest Point From Origin',
    r: 'Send every "_" the same way as the majority: answer = |#L − #R| + #_.',
    g: R => ({ moves: R.str(R.int(1, 9), 'LR_') }),
    s(I, T) { const c = cnt(I.moves); T.at({ counts: K(c) }); T.n('|L − R|?', Math.abs((c.L || 0) - (c.R || 0)), 'Fixed moves cancel.'); T.n('How many underscores?', c._ || 0, 'Each one follows the majority direction.'); T.n('Furthest distance?', Math.abs((c.L || 0) - (c.R || 0)) + (c._ || 0), 'The fixed gap plus every underscore.'); return Math.abs((c.L || 0) - (c.R || 0)) + (c._ || 0); }
  });

  D('check-if-strings-can-be-made-equal-with-operations-i', {
    t: 'Equal With Distance-2 Swaps (length 4)',
    r: 'Swaps only exchange i and i + 2, so the multisets at even indices and at odd indices must match.',
    g: R => { const s1 = R.str(4, 'abc'), g = [...s1]; if (R.chance(0.5)) [g[0], g[2]] = [g[2], g[0]]; if (R.chance(0.5)) [g[1], g[3]] = [g[3], g[1]]; if (R.chance(0.3)) g[R.int(0, 3)] = 'c'; return { s1, s2: g.join('') }; },
    s(I, T) { const p = (s, k) => [s[k], s[k + 2]].sort().join(''); T.at({ s1: chars(I.s1), s2: chars(I.s2) }); T.yn('Do the even positions hold the same letters?', p(I.s1, 0) === p(I.s2, 0), 'Compare {0, 2}.'); T.yn('Do the odd positions hold the same letters?', p(I.s1, 1) === p(I.s2, 1), 'Compare {1, 3}.'); T.yn('Can the strings be made equal?', p(I.s1, 0) === p(I.s2, 0) && p(I.s1, 1) === p(I.s2, 1), 'Both parities must match.'); return p(I.s1, 0) === p(I.s2, 0) && p(I.s1, 1) === p(I.s2, 1); }
  });

  D('check-if-strings-can-be-made-equal-with-operations-ii', {
    t: 'Equal With Even-Distance Swaps',
    r: 'Swaps keep each character on the same index parity, and any rearrangement within a parity is possible. Compare sorted even letters and sorted odd letters.',
    g: R => { const n = R.int(1, 7), s1 = R.str(n, 'abc'); return { s1, s2: R.chance(0.5) ? s1 : R.str(n, 'abc') }; },
    s(I, T) { const k = (s, r) => [...s].filter((_, i) => i % 2 === r).sort().join(''); T.at({ s1: chars(I.s1), s2: chars(I.s2) }); T.yn('Same letters on even indices?', k(I.s1, 0) === k(I.s2, 0), 'Sorted comparison.'); T.yn('Same letters on odd indices?', k(I.s1, 1) === k(I.s2, 1), 'Sorted comparison.'); T.yn('Can the strings be made equal?', k(I.s1, 0) === k(I.s2, 0) && k(I.s1, 1) === k(I.s2, 1), 'Both parities must match.'); return k(I.s1, 0) === k(I.s2, 0) && k(I.s1, 1) === k(I.s2, 1); }
  });

  D('minimum-number-of-changes-to-make-binary-string-beautiful', {
    t: 'Make a Binary String Beautiful',
    r: 'Look at aligned pairs (2i, 2i + 1); each mismatched pair needs exactly one change.',
    g: R => ({ s: R.str(2 * R.int(1, 5), '01') }),
    s(I, T) { let c = 0; for (let i = 0; i < I.s.length; i += 2) { const bad = I.s[i] !== I.s[i + 1]; T.at({ s: chars(I.s), pair: `${i},${i + 1}` }); T.yn(`Does pair ${i / 2} need a change?`, bad, 'The two characters differ.'); if (bad) c++; } return c; }
  });

  D('high-access-employees', {
    t: 'High-Access Employees',
    r: 'Group times per employee, sort, and flag anyone with t[i + 2] − t[i] < 60 minutes.',
    cmp: 'set',
    g: R => ({ access_times: Array.from({ length: R.int(1, 7) }, () => [R.pick(['a', 'b']), String(R.int(5, 6)).padStart(2, '0') + String(R.int(0, 59)).padStart(2, '0')]) }),
    s(I, T) { const m = new Map(); for (const [n, t] of I.access_times) (m.get(n) || m.set(n, []).get(n)).push(mins(t)); const out = []; T.at({ employees: A([...m.keys()]) }); T.n('How many distinct employees?', m.size, 'Group the access times by name.'); for (const [n, ts] of m) { ts.sort((a, b) => a - b); const hi = ts.some((t, i) => i + 2 < ts.length && ts[i + 2] - t < 60); T.at({ employee: n, minutes: A(ts) }); T.yn(`Is ${n} high-access?`, hi, 'Three accesses within under an hour.'); if (hi) out.push(n); } T.n('How many high-access employees?', out.length, 'Count the yes answers.'); return out; }
  });
})();
