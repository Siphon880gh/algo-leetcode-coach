/* v2 games: strings (03). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const cnt = s => { const m = {}; for (const c of s) m[c] = (m[c] || 0) + 1; return m; };
  const chars = s => A([...s]);
  const words = (R, n, al, lo, hi) => Array.from({ length: n }, () => R.str(R.int(lo || 1, hi || 4), al || 'abc'));
  const sent = (R, n, pool) => Array.from({ length: n }, () => R.pick(pool)).join(' ');

  D('rearrange-spaces-between-words', {
    t: 'Rearrange Spaces Between Words',
    r: 'Count spaces S and words w. Each gap gets S divided by (w − 1) (rounded down) spaces; leftovers go to the end (all of them if w = 1).',
    g: R => ({ text: (() => { let s = ''; const n = R.int(1, 4); for (let i = 0; i < n; i++) s += ' '.repeat(R.int(i ? 1 : 0, 2)) + R.str(R.int(1, 3), 'ab'); return s + ' '.repeat(R.int(0, 2)); })() }),
    s(I, T) { const S = [...I.text].filter(c => c === ' ').length, w = I.text.trim().split(/ +/); const gap = w.length > 1 ? Math.floor(S / (w.length - 1)) : 0; T.at({ words: A(w), spaces: S }); T.n('How many spaces in total?', S, 'Count every space in text.'); T.n('Spaces per gap?', gap, w.length > 1 ? `${S} divided by ${w.length - 1}, rounded down.` : 'One word: no gaps.'); T.n('Spaces left over at the end?', S - gap * (w.length - 1), 'Whatever the gaps could not share evenly.'); return w.join(' '.repeat(gap)) + ' '.repeat(S - gap * (w.length - 1)); }
  });

  D('alert-using-same-key-card-three-or-more-times-in-a-one-hour-period', {
    t: 'Key-Card Alerts: three uses within an hour',
    r: 'Group times by name and sort them. Alert if some t[i + 2] − t[i] at most 60 minutes. Return alerted names sorted.',
    g: R => { const n = R.int(1, 7); return { keyName: Array.from({ length: n }, () => R.pick(['ann', 'bob'])), keyTime: Array.from({ length: n }, () => `${String(R.int(9, 11)).padStart(2, '0')}:${String(R.int(0, 59)).padStart(2, '0')}`) }; },
    s(I, T) { const m = new Map(); I.keyName.forEach((n, i) => { const [h, mi] = I.keyTime[i].split(':'); (m.get(n) || m.set(n, []).get(n)).push(+h * 60 + +mi); }); const out = []; T.at({ names: A([...m.keys()]) }); T.n('How many different people used a card?', m.size, 'Group the times by name.'); for (const [n, ts] of [...m].sort()) { ts.sort((a, b) => a - b); const bad = ts.some((t, i) => i + 2 < ts.length && ts[i + 2] - t <= 60); T.at({ name: n, minutes: A(ts) }); T.yn(`Alert for ${n}?`, bad, 'Any 3 consecutive uses within 60 minutes.'); if (bad) out.push(n); } T.n('How many people get an alert?', out.length, 'Count the yes answers.'); return out; }
  });

  D('largest-substring-between-two-equal-characters', {
    t: 'Largest Substring Between Equal Characters',
    r: 'Remember each letter\'s first index; at a later index j, the gap is j − first − 1. Track the max (−1 if none).',
    g: R => ({ s: R.str(R.int(1, 8), 'abcd') }),
    s(I, T) { const f = {}; let best = -1; [...I.s].forEach((c, j) => { if (c in f) { T.at({ s: chars(I.s), first: K(f) }); T.n(`Gap for '${c}' at index ${j}?`, j - f[c] - 1, `${j} − ${f[c]} − 1.`); best = Math.max(best, j - f[c] - 1); } else f[c] = j; }); if (best < 0) T.yn('Does any letter repeat?', false, 'No repeats: −1.'); return best; }
  });

  D('slowest-key', {
    t: 'Slowest Key: longest press, ties go to the larger letter',
    r: 'Duration i = release[i] − release[i − 1] (first is release[0]). Keep the longest; on ties keep the lexicographically larger key.',
    g: R => { const n = R.int(2, 6); let t = 0; return { releaseTimes: Array.from({ length: n }, () => t += R.int(1, 5)), keysPressed: R.str(n, 'abcd') }; },
    s(I, T) { let best = I.keysPressed[0], d = I.releaseTimes[0]; for (let i = 1; i < I.releaseTimes.length; i++) { const x = I.releaseTimes[i] - I.releaseTimes[i - 1], k = I.keysPressed[i]; T.at({ release: A(I.releaseTimes, { hl: [i] }), best: `${best}:${d}` }); T.n(`Duration of press ${i}?`, x, 'Difference of release times.'); if (x > d || (x === d && k > best)) { d = x; best = k; } } return best; }
  });

  D('determine-if-two-strings-are-close', {
    t: 'Close Strings: same letters, same count multiset',
    r: 'Swaps rearrange freely; relabeling swaps counts between letters. So both strings need the same set of letters and the same sorted list of counts.',
    g: R => ({ word1: R.str(R.int(1, 6), 'abc'), word2: R.str(R.int(1, 6), 'abc') }),
    s(I, T) { const a = cnt(I.word1), b = cnt(I.word2); const sameSet = Object.keys(a).sort().join() === Object.keys(b).sort().join(); T.at({ counts1: K(a), counts2: K(b) }); T.yn('Same set of letters?', sameSet, 'Relabeling cannot create new letters.'); const sameCounts = Object.values(a).sort().join() === Object.values(b).sort().join(); T.yn('Same list of counts, once sorted?', sameCounts, 'Swapping letters can move counts between letters.'); T.yn('Are the strings close?', sameSet && sameCounts, 'Both conditions must hold.'); return sameSet && sameCounts; }
  });

  D('maximum-repeating-substring', {
    t: 'Maximum Repeating Substring',
    r: 'Increase k while word repeated k + 1 times is still a substring of sequence.',
    g: R => { const w = R.str(R.int(1, 2), 'ab'); return { sequence: R.str(R.int(0, 2), 'ab') + w.repeat(R.int(0, 3)) + R.str(R.int(0, 2), 'ab') || 'a', word: w }; },
    s(I, T) { let k = 0; for (;;) { const ok = I.sequence.includes(I.word.repeat(k + 1)); T.at({ sequence: I.sequence, word: I.word }); T.yn(`Is "${I.word}" times ${k + 1} inside?`, ok, 'Substring check.'); if (!ok) return k; k++; } }
  });

  D('goal-parser-interpretation', {
    t: 'Goal Parser Interpretation',
    r: '"G" becomes G, "()" becomes o, "(al)" becomes al.',
    g: R => ({ command: Array.from({ length: R.int(1, 5) }, () => R.pick(['G', '()', '(al)'])).join('') }),
    s(I, T) { let i = 0, out = ''; const c = I.command; while (i < c.length) { const tok = c[i] === 'G' ? 'G' : c[i + 1] === ')' ? '()' : '(al)', v = tok === 'G' ? 'G' : tok === '()' ? 'o' : 'al'; T.at({ command: chars(c), at: i }); T.c(`Meaning of "${tok}"?`, ['G', 'o', 'al'], v, 'Fixed table.'); out += v; i += tok.length; } return out; }
  });

  D('determine-if-string-halves-are-alike', {
    t: 'String Halves Alike: vowel counts',
    r: 'Count vowels (either case) in each half and compare.',
    g: R => ({ s: R.str(2 * R.int(1, 4), 'aEbkoT') }),
    s(I, T) { const h = I.s.length / 2, v = x => [...x].filter(c => 'aeiouAEIOU'.includes(c)).length; T.at({ left: I.s.slice(0, h), right: I.s.slice(h) }); T.n('Vowels in the first half?', v(I.s.slice(0, h)), 'Count both cases.'); T.n('Vowels in the second half?', v(I.s.slice(h)), 'Count both cases.'); T.yn('Are the halves alike?', v(I.s.slice(0, h)) === v(I.s.slice(h)), 'Same number of vowels.'); return v(I.s.slice(0, h)) === v(I.s.slice(h)); }
  });

  D('minimum-changes-to-make-alternating-binary-string', {
    t: 'Minimum Changes to Alternate',
    r: 'Count mismatches against "0101…"; the other pattern needs n − that many. Take the smaller.',
    g: R => ({ s: R.str(R.int(1, 9), '01') }),
    s(I, T) { const m = [...I.s].filter((c, i) => +c !== i % 2).length; T.at({ s: chars(I.s) }); T.n('Mismatches against 0101…?', m, 'Compare to i mod 2.'); T.n('Mismatches against 1010…?', I.s.length - m, 'Every other position flips.'); T.n('Fewest changes?', Math.min(m, I.s.length - m), 'Take the cheaper pattern.'); return Math.min(m, I.s.length - m); }
  });

  D('longest-nice-substring', {
    t: 'Longest Nice Substring',
    r: 'A substring is nice if every letter in it appears in both cases. Check all substrings (or divide at a "bad" letter); keep the longest, earliest on ties.',
    g: R => ({ s: R.str(R.int(1, 8), 'aAbBc') }),
    s(I, T) { const s = I.s, nice = x => [...x].every(c => x.includes(c.toLowerCase()) && x.includes(c.toUpperCase())); let best = ''; for (let i = 0; i < s.length; i++) for (let j = i + 2; j <= s.length; j++) if (j - i > best.length && nice(s.slice(i, j))) best = s.slice(i, j); const bad = [...s].filter(c => !s.includes(c.toLowerCase()) || !s.includes(c.toUpperCase())); T.at({ s: chars(s) }); T.n('Letters that can never be in a nice substring?', bad.length, 'Their other case is missing everywhere.'); T.yn('Is s itself nice?', nice(s), 'Every letter appears in both cases.'); T.n('Length of the longest nice substring?', best.length, 'Take the earliest one on ties.'); return best; }
  });

  D('sort-features-by-popularity', {
    t: 'Sort Features by Popularity',
    r: 'Popularity = number of responses mentioning the feature (once per response). Sort descending, ties by original index.',
    g: R => ({ features: ['a', 'b', 'c'].slice(0, R.int(1, 3)), responses: Array.from({ length: R.int(1, 4) }, () => sent(R, R.int(1, 3), ['a', 'b', 'c', 'd'])) }),
    s(I, T) { const sets = I.responses.map(r => new Set(r.split(' '))), p = I.features.map(f => sets.filter(s => s.has(f)).length); I.features.forEach((f, i) => { T.at({ responses: A(I.responses) }); T.n(`Popularity of "${f}"?`, p[i], 'Responses that mention it.'); }); return I.features.map((f, i) => i).sort((a, b) => p[b] - p[a] || a - b).map(i => I.features[i]); }
  });

  D('count-items-matching-a-rule', {
    t: 'Count Items Matching a Rule',
    r: 'Map ruleKey to column 0, 1 or 2 (type, color or name) and count matching items.',
    g: R => ({ items: Array.from({ length: R.int(1, 5) }, () => [R.pick(['phone', 'pc']), R.pick(['blue', 'gold']), R.pick(['x', 'y'])]), ruleKey: R.pick(['type', 'color', 'name']), ruleValue: R.pick(['phone', 'gold', 'x']) }),
    s(I, T) { const k = ['type', 'color', 'name'].indexOf(I.ruleKey); T.at({ items: A(I.items.map(x => x.join(' '))) }); T.n(`Column index for "${I.ruleKey}"?`, k, 'type is 0, color is 1, name is 2.'); T.yn('Does the first item match the rule?', I.items[0][k] === I.ruleValue, `Compare column ${k} with "${I.ruleValue}".`); T.n('Items matching the rule?', I.items.filter(x => x[k] === I.ruleValue).length, 'Check every item the same way.'); return I.items.filter(x => x[k] === I.ruleValue).length; }
  });

  D('sum-of-beauty-of-all-substrings', {
    t: 'Sum of Beauty of All Substrings',
    r: 'For each start, extend the end while updating counts; beauty = max count − min positive count. Sum over all substrings.',
    g: R => ({ s: R.str(R.int(1, 7), 'abc') }),
    s(I, T) { let tot = 0; for (let i = 0; i < I.s.length; i++) { const c = {}; let rowSum = 0; for (let j = i; j < I.s.length; j++) { c[I.s[j]] = (c[I.s[j]] || 0) + 1; const v = Object.values(c); rowSum += Math.max(...v) - Math.min(...v); } if (i < 5) { T.at({ s: chars(I.s), start: i }); T.n(`Total beauty of substrings starting at ${i}?`, rowSum, 'Extend the end, max − min each time.'); } tot += rowSum; } return tot; }
  });

  D('check-if-binary-string-has-at-most-one-segment-of-ones', {
    t: 'At Most One Segment of Ones',
    r: 'Since s starts with 1, a second segment exists exactly when "01" appears.',
    g: R => ({ s: '1' + R.str(R.int(0, 6), '01') }),
    s(I, T) { T.at({ s: chars(I.s) }); T.yn('Does "01" appear?', I.s.includes('01'), 'A 1 after a 0 starts a new segment.'); T.n('How many segments of ones?', I.s.match(/1+/g).length, 'Each block of consecutive ones.'); T.yn('At most one segment?', !I.s.includes('01'), 'No 0 is followed by a 1.'); return !I.s.includes('01'); }
  });

  D('check-if-one-string-swap-can-make-strings-equal', {
    t: 'One Swap to Make Equal',
    r: 'Equal strings need no swap. Otherwise there must be exactly two mismatches with crossed letters.',
    g: R => { const s = R.str(R.int(1, 5), 'abc'), g = [...s]; if (R.chance(0.6)) { const i = R.int(0, s.length - 1), j = R.int(0, s.length - 1); [g[i], g[j]] = [g[j], g[i]]; } else g[0] = R.pick(['a', 'b', 'c']); return { s1: s, s2: g.join('') }; },
    s(I, T) { const d = []; for (let i = 0; i < I.s1.length; i++) if (I.s1[i] !== I.s2[i]) d.push(i); T.at({ s1: chars(I.s1), s2: chars(I.s2) }); T.n('Mismatched positions?', d.length, 'Compare letter by letter.'); const res = !d.length || (d.length === 2 && I.s1[d[0]] === I.s2[d[1]] && I.s1[d[1]] === I.s2[d[0]]); T.yn('Same letters overall, once sorted?', [...I.s1].sort().join('') === [...I.s2].sort().join(''), 'A swap never changes which letters there are.'); T.yn('Can at most one swap make them equal?', res, 'No mismatch, or two crossed mismatches.'); return res; }
  });

  D('second-largest-digit-in-a-string', {
    t: 'Second Largest Digit',
    r: 'Track the largest and second largest distinct digits seen.',
    g: R => ({ s: R.str(R.int(1, 8), 'ab1239') }),
    s(I, T) { const d = [...new Set([...I.s].filter(c => /\d/.test(c)).map(Number))].sort((a, b) => b - a); T.at({ s: chars(I.s), digits: A(d) }); T.n('How many distinct digits?', d.length, 'Set of digits.'); T.n('Largest digit (−1 if none)?', d.length ? d[0] : -1, 'The first in sorted order.'); T.n('Second largest digit (−1 if none)?', d.length > 1 ? d[1] : -1, 'The next distinct digit.'); return d.length > 1 ? d[1] : -1; }
  });

  D('number-of-different-integers-in-a-string', {
    t: 'Different Integers in a String',
    r: 'Split on letters, strip leading zeros from each digit run, and count distinct strings.',
    g: R => ({ word: R.str(R.int(1, 10), 'a01x2') }),
    s(I, T) { const runs = I.word.split(/[a-z]+/).filter(Boolean), set = new Set(runs.map(r => r.replace(/^0+/, '') || '0')); T.at({ runs: A(runs) }); T.n('How many digit runs?', runs.length, 'Split on letters.'); T.n('Runs with leading zeros?', runs.filter(r => r.length > 1 && r[0] === '0').length, 'Strip them before comparing.'); T.n('Different integers?', set.size, 'Distinct values after stripping zeros.'); return set.size; }
  });

  D('evaluate-the-bracket-pairs-of-a-string', {
    t: 'Evaluate Bracket Pairs',
    r: 'Store knowledge in a map. Replace each (key) with its value, or "?" if unknown.',
    g: R => ({ s: Array.from({ length: R.int(1, 4) }, () => R.chance(0.5) ? `(${R.pick(['a', 'b', 'c'])})` : R.str(R.int(1, 2), 'xy')).join(''), knowledge: [['a', 'one'], ['b', 'two']].slice(0, R.int(0, 2)) }),
    s(I, T) { const m = new Map(I.knowledge); T.at({ s: I.s }); T.n('How many bracket pairs?', (I.s.match(/\(/g) || []).length, 'Count the opening brackets.'); return I.s.replace(/\(([a-z]+)\)/g, (_, k) => { const v = m.has(k) ? m.get(k) : '?'; T.at({ s: I.s, known: K(Object.fromEntries(m)) }); T.c(`Replacement for (${k})?`, [...new Set([v, '?', k])], v, 'Look up the key.'); return v; }); }
  });

  D('truncate-sentence', {
    t: 'Truncate Sentence',
    r: 'Keep the first k words.',
    g: R => { const n = R.int(1, 6); return { s: sent(R, n, ['Hi', 'how', 'are', 'you', 'ok']), k: R.int(1, n) }; },
    s(I, T) { const w = I.s.split(' '); T.at({ words: A(w) }); T.n('Words in s?', w.length, 'Split on spaces.'); T.n('Words removed?', w.length - I.k, 'Everything after word k.'); T.c('Last word kept?', [...new Set(w)], w[I.k - 1], `Word ${I.k}.`); return w.slice(0, I.k).join(' '); }
  });

  D('check-if-the-sentence-is-pangram', {
    t: 'Pangram Check',
    r: 'Collect letters in a set; a pangram has all 26.',
    g: R => ({ sentence: R.chance(0.4) ? R.shuffle([...'abcdefghijklmnopqrstuvwxyz', ...R.str(R.int(0, 5))]).join('') : R.str(R.int(1, 30), 'abcdefghijklmnopqrstuvwxy') }),
    s(I, T) { const n = new Set(I.sentence).size; T.at({ sentence: I.sentence }); T.n('Distinct letters?', n, 'Size of the set.'); T.n('Letters missing?', 26 - n, 'Out of 26.'); T.yn('Is it a pangram?', n === 26, 'No letters missing.'); return n === 26; }
  });

  D('replace-all-digits-with-characters', {
    t: 'Replace Digits With Characters',
    r: 'At each odd index i, replace the digit d with shift(s[i − 1], d).',
    g: R => ({ s: Array.from({ length: R.int(1, 7) }, (_, i) => i % 2 ? String(R.int(0, 5)) : R.pick(['a', 'c', 'm'])).join('') }),
    s(I, T) { let out = ''; for (let i = 0; i < I.s.length; i++) { if (i % 2) { const v = String.fromCharCode(I.s.charCodeAt(i - 1) + +I.s[i]); T.at({ s: chars(I.s), at: i }); T.c(`shift('${I.s[i - 1]}', ${I.s[i]})?`, [...new Set([v, I.s[i - 1], String.fromCharCode(I.s.charCodeAt(i - 1) + 1)])], v, 'Move forward d letters.'); out += v; } else out += I.s[i]; } if (I.s.length === 1) T.yn('Any digits?', false, 'Single letter.'); return out; }
  });

  D('sorting-the-sentence', {
    t: 'Sorting the Sentence',
    r: 'Each word ends with its 1-based position; place it there and strip the digit.',
    g: R => { const w = Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 3), 'abc')); return { s: R.shuffle(w.map((x, i) => x + (i + 1))).join(' ') }; },
    s(I, T) { const w = I.s.split(' '), out = []; for (const x of w) out[+x.slice(-1) - 1] = x.slice(0, -1); T.at({ words: A(w) }); T.n('Words in s?', w.length, 'Each one carries its position as the last digit.'); T.c('Last word of the sentence?', [...new Set(w.map(x => x.slice(0, -1)))], out[w.length - 1], `The one tagged ${w.length}.`); T.c('First word of the sentence?', [...new Set(w.map(x => x.slice(0, -1)))], out[0], 'The one tagged 1.'); return out.join(' '); }
  });

  D('longer-contiguous-segments-of-ones-than-zeros', {
    t: 'Longer Runs of Ones Than Zeros',
    r: 'Compute the longest run of 1s and of 0s; compare strictly.',
    g: R => ({ s: R.str(R.int(1, 9), '01') }),
    s(I, T) { const run = c => Math.max(0, ...(I.s.match(new RegExp(c + '+', 'g')) || []).map(x => x.length)); T.at({ s: chars(I.s) }); T.n('Longest run of 1s?', run('1'), 'Scan runs.'); T.n('Longest run of 0s?', run('0'), 'Scan runs.'); T.yn('Is the longest run of 1s strictly longer?', run('1') > run('0'), 'Equal lengths give false.'); return run('1') > run('0'); }
  });

  D('redistribute-characters-to-make-all-strings-equal', {
    t: 'Redistribute Characters',
    r: 'Characters can move freely, so every letter count must be divisible by the number of words.',
    g: R => ({ words: words(R, R.int(1, 4), 'abc', 1, 4) }),
    s(I, T) { const c = cnt(I.words.join('')), n = I.words.length; T.at({ counts: K(c), words: n }); T.n('How many distinct letters?', Object.keys(c).length, 'Each one must split evenly.'); for (const k of Object.keys(c).sort()) { const ok = c[k] % n === 0; T.at({ counts: K(c), words: n }); T.yn(`Can '${k}' (${c[k]}) be split evenly?`, ok, `Divisible by ${n}?`); if (!ok) { T.yn('Can all strings be made equal?', false, 'One letter cannot be shared out evenly.'); return false; } } T.yn('Can all strings be made equal?', true, 'Every letter divides evenly.'); return true; }
  });

  D('check-if-string-is-decomposable-into-value-equal-substrings', {
    t: 'Decompose Into Value-Equal Substrings',
    r: 'Split into runs. A run of length L works with blocks of 3 if L mod 3 = 0, needs exactly one block of 2 if L mod 3 = 2, and fails if L mod 3 = 1. Exactly one length-2 block overall.',
    g: R => ({ s: Array.from({ length: R.int(1, 4) }, (_, i) => String(i % 3).repeat(R.int(1, 5))).join('') }),
    s(I, T) { const runs = I.s.match(/(.)\1*/g); let twos = 0; T.at({ runs: A(runs) }); T.n('How many runs of equal digits?', runs.length, 'Each run is handled on its own.'); for (const r of runs) { const m = r.length % 3; T.at({ runs: A(runs), twos }); T.n(`Length of run "${r}" mod 3?`, m, `${r.length} mod 3.`); if (m === 1) { T.yn('Is s decomposable?', false, 'A leftover of 1 can never be used.'); return false; } if (m === 2) twos++; } T.yn('Is s decomposable?', twos === 1, 'Exactly one run must leave a piece of length 2.'); return twos === 1; }
  });

  D('maximum-number-of-words-you-can-type', {
    t: 'Words You Can Type',
    r: 'A word is typeable if none of its letters is broken.',
    g: R => ({ text: sent(R, R.int(1, 5), ['hello', 'world', 'leet', 'code', 'ab']), brokenLetters: [...new Set(R.str(R.int(0, 2), 'adlt'))].join('') }),
    s(I, T) { const b = new Set(I.brokenLetters); return I.text.split(' ').filter(w => { const ok = ![...w].some(c => b.has(c)); T.at({ broken: A([...b]), word: w }); T.yn(`Can "${w}" be typed?`, ok, 'No broken letters.'); return ok; }).length; }
  });

  D('check-if-all-characters-have-equal-number-of-occurrences', {
    t: 'Equal Character Occurrences',
    r: 'Count letters; all counts must be equal.',
    g: R => ({ s: R.chance(0.4) ? R.shuffle([...'abc'.slice(0, R.int(1, 3)).repeat(R.int(1, 3))]).join('') : R.str(R.int(1, 7), 'abc') }),
    s(I, T) { const c = cnt(I.s), v = Object.values(c); T.at({ counts: K(c) }); T.n('How many distinct characters?', v.length, 'Count the keys.'); T.n('How many distinct counts?', new Set(v).size, 'Good only when it is 1.'); T.yn('Do all characters occur equally often?', new Set(v).size === 1, 'Only one count value.'); return new Set(v).size === 1; }
  });

  D('number-of-strings-that-appear-as-substrings-in-word', {
    t: 'Patterns That Appear in Word',
    r: 'Count patterns (with duplicates) that are substrings of word.',
    g: R => ({ patterns: words(R, R.int(1, 5), 'abc', 1, 3), word: R.str(R.int(1, 6), 'abc') }),
    s(I, T) { return I.patterns.filter(p => { const ok = I.word.includes(p); T.at({ word: I.word, pattern: p }); T.yn(`Is "${p}" inside "${I.word}"?`, ok, 'Substring check.'); return ok; }).length; }
  });

  D('number-of-pairs-of-strings-with-concatenation-equal-to-target', {
    t: 'Pairs Concatenating to Target',
    r: 'Count ordered pairs i not equal to j with nums[i] + nums[j] = target. With a count map: for each prefix match, add the count of the needed suffix (minus self if equal).',
    g: R => { const t = R.str(R.int(2, 4), '17'); return { nums: Array.from({ length: R.int(2, 5) }, () => R.chance(0.7) ? (R.chance(0.5) ? t.slice(0, R.int(1, t.length - 1)) : t.slice(R.int(1, t.length - 1))) : R.str(R.int(1, 2), '17')), target: t }; },
    s(I, T) { const c = cnt(I.nums); let tot = 0; I.nums.forEach((a, i) => { if (!I.target.startsWith(a) || a.length >= I.target.length) return; const b = I.target.slice(a.length), k = (c[b] || 0) - (a === b ? 1 : 0); T.at({ nums: A(I.nums, { hl: [i] }), need: b }); T.n(`Partners for "${a}"?`, k, `Copies of "${b}" (not itself).`); tot += k; }); if (!tot) T.n('Total pairs?', 0, 'No valid splits.'); return tot; }
  });

  D('check-if-numbers-are-ascending-in-a-sentence', {
    t: 'Numbers Ascending in a Sentence',
    r: 'Scan numeric tokens; each must be strictly larger than the previous one.',
    g: R => ({ s: Array.from({ length: R.int(2, 6) }, () => R.chance(0.5) ? String(R.int(1, 12)) : R.pick(['box', 'red'])).join(' ') }),
    s(I, T) { let prev = 0; T.at({ tokens: A(I.s.split(' ')) }); T.n('How many numbers are in s?', I.s.split(' ').filter(t => /^\d+$/.test(t)).length, 'Skip the words.'); for (const t of I.s.split(' ')) if (/^\d+$/.test(t)) { const ok = +t > prev; T.at({ prev, token: t }); T.yn(`Is ${t} > ${prev}?`, ok, 'Strictly increasing.'); if (!ok) { T.yn('Are the numbers strictly ascending?', false, 'One number did not beat the one before.'); return false; } prev = +t; } if (!prev) T.yn('Any numbers?', false, 'Vacuously ascending.'); T.yn('Are the numbers strictly ascending?', true, 'Every number beat the one before.'); return true; }
  });

  D('number-of-valid-words-in-a-sentence', {
    t: 'Valid Words in a Sentence',
    r: 'A token is valid if: no digits; at most one hyphen, with letters on both sides; at most one punctuation mark (!.,), and only at the end.',
    g: R => ({ sentence: Array.from({ length: R.int(1, 4) }, () => R.pick(['cat', 'a-b', '-ab', 'ab!', 'a!b', 'b8d', 'x.', '!', 'a-b-c'])).join(' ') }),
    s(I, T) { const ok = w => /^([a-z]+(-[a-z]+)?)?[!.,]?$/.test(w) && w.length > 0; return I.sentence.split(/ +/).filter(Boolean).filter(w => { T.at({ token: w }); T.yn(`Is "${w}" valid?`, ok(w), 'Hyphen between letters, punctuation only at the end, no digits.'); return ok(w); }).length; }
  });

  D('kth-distinct-string-in-an-array', {
    t: 'Kth Distinct String',
    r: 'Count occurrences; walk the array in order and return the k-th string with count 1 (or "").',
    g: R => ({ arr: words(R, R.int(1, 6), 'abc', 1, 1), k: R.int(1, 3) }),
    s(I, T) { const c = cnt(I.arr), d = I.arr.filter(x => c[x] === 1); T.at({ arr: A(I.arr), counts: K(c) }); T.n('How many different values are in arr?', Object.keys(c).length, 'Count the keys.'); T.n('How many distinct strings?', d.length, 'Strings whose count is 1.'); T.yn(`Is there a distinct string number ${I.k}?`, d.length >= I.k, 'Otherwise the answer is empty.'); return d[I.k - 1] || ''; }
  });

  D('check-whether-two-strings-are-almost-equivalent', {
    t: 'Almost Equivalent Strings',
    r: 'For every letter, |count1 − count2| must be at most 3.',
    g: R => { const n = R.int(1, 8); return { word1: R.str(n, 'abc'), word2: R.str(n, 'abc') }; },
    s(I, T) { const a = cnt(I.word1), b = cnt(I.word2); let mx = 0; for (const k of new Set([...I.word1, ...I.word2])) mx = Math.max(mx, Math.abs((a[k] || 0) - (b[k] || 0))); T.at({ counts1: K(a), counts2: K(b) }); T.n('Largest frequency difference?', mx, 'Must be at most 3.'); T.n('Distinct letters across both words?', new Set([...I.word1, ...I.word2]).size, 'Check each of them.'); T.yn('Almost equivalent?', mx <= 3, 'No difference above 3.'); return mx <= 3; }
  });

  D('count-common-words-with-one-occurrence', {
    t: 'Common Words With One Occurrence',
    r: 'Count words in each array; count words with count 1 in both.',
    g: R => ({ words1: words(R, R.int(1, 5), 'ab', 1, 2), words2: words(R, R.int(1, 5), 'ab', 1, 2) }),
    s(I, T) { const a = cnt(I.words1), b = cnt(I.words2); const r = Object.keys(a).filter(k => a[k] === 1 && b[k] === 1).length; T.at({ counts1: K(a), counts2: K(b) }); T.n('Words that appear once in words1?', Object.keys(a).filter(k => a[k] === 1).length, 'Count is 1.'); T.n('Words that appear once in words2?', Object.keys(b).filter(k => b[k] === 1).length, 'Count is 1.'); T.n('Words appearing exactly once in each?', r, 'Both counts equal 1.'); return r; }
  });

  D('maximum-number-of-words-found-in-sentences', {
    t: 'Most Words in a Sentence',
    r: 'Words = spaces + 1; take the max.',
    g: R => ({ sentences: Array.from({ length: R.int(1, 4) }, () => sent(R, R.int(1, 5), ['a', 'b', 'c'])) }),
    s(I, T) { let best = 0; for (const s of I.sentences) { const w = s.split(' ').length; T.at({ sentence: s }); T.n('Words in this sentence?', w, 'Spaces + 1.'); best = Math.max(best, w); } return best; }
  });

  D('check-if-all-as-appears-before-all-bs', {
    t: 'All A\'s Before All B\'s',
    r: 'Invalid exactly when "ba" appears.',
    g: R => ({ s: R.str(R.int(1, 7), 'ab') }),
    s(I, T) { T.at({ s: chars(I.s) }); T.yn('Does "ba" appear?', I.s.includes('ba'), 'An a after a b.'); T.n('Index of the first b (−1 if none)?', I.s.indexOf('b'), 'No a may come after it.'); T.yn('Do all a letters come before all b letters?', !I.s.includes('ba'), 'True when "ba" never appears.'); return !I.s.includes('ba'); }
  });

  D('capitalize-the-title', {
    t: 'Capitalize the Title',
    r: 'Words of length at most 2 become all lower case; longer words get a capital first letter and the rest lower case.',
    g: R => ({ title: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 5), 'aBcD')).join(' ') }),
    s(I, T) { return I.title.split(' ').map(w => { const l = w.toLowerCase(), r = l.length <= 2 ? l : l[0].toUpperCase() + l.slice(1); T.at({ word: w }); T.c(`Result for "${w}"?`, [...new Set([r, l, w.toUpperCase()])], r, l.length <= 2 ? 'Short: lower case.' : 'Capitalize.'); return r; }).join(' '); }
  });

  D('unique-substrings-with-equal-digit-frequency', {
    t: 'Unique Substrings With Equal Digit Frequency',
    r: 'For each start, extend while tracking counts, the max count and the number of distinct digits: equal exactly when maxCount times distinct = length. Collect distinct substrings in a set (or by rolling hash).',
    g: R => ({ s: R.str(R.int(1, 7), '123') }),
    s(I, T) { const set = new Set(); for (let i = 0; i < I.s.length; i++) { const c = {}; let mx = 0, k = 0; for (let j = i; j < I.s.length; j++) { c[I.s[j]] = (c[I.s[j]] || 0) + 1; if (c[I.s[j]] === 1) k++; mx = Math.max(mx, c[I.s[j]]); if (mx * k === j - i + 1) set.add(I.s.slice(i, j + 1)); } if (i < 4) { T.at({ s: chars(I.s), start: i, found: set.size }); T.n(`Distinct good substrings found after start ${i}?`, set.size, 'Running set size.'); } } return set.size; }
  });

  D('counting-words-with-a-given-prefix', {
    t: 'Counting Words With a Prefix',
    r: 'Count words that start with pref.',
    g: R => ({ words: words(R, R.int(1, 5), 'ap', 1, 4), pref: R.str(R.int(1, 2), 'ap') }),
    s(I, T) { return I.words.filter(w => { const ok = w.startsWith(I.pref); T.at({ word: w, pref: I.pref }); T.yn(`Does "${w}" start with "${I.pref}"?`, ok, 'Prefix check.'); return ok; }).length; }
  });

  D('minimum-number-of-steps-to-make-two-strings-anagram-ii', {
    t: 'Steps to Make Anagrams II',
    r: 'Appending can only add letters, so the answer is the sum of |count_s − count_t| over all letters.',
    g: R => ({ s: R.str(R.int(1, 7), 'abc'), t: R.str(R.int(1, 7), 'abc') }),
    s(I, T) { const c = cnt(I.s); for (const x of I.t) c[x] = (c[x] || 0) - 1; T.at({ diff: K(c) }); const v = Object.values(c).reduce((a, b) => a + Math.abs(b), 0); T.n('Letters to append to s?', Object.values(c).filter(x => x < 0).reduce((a, b) => a - b, 0), 'Where t has more.'); T.n('Letters to append to t?', Object.values(c).filter(x => x > 0).reduce((a, b) => a + b, 0), 'Where s has more.'); T.n('Total appends needed?', v, 'Sum of absolute differences.'); return v; }
  });
})();
