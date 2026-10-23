/* v2 games: simulation (01). */
(function () {
  'use strict';
  const { D, A, G, K, X } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);
  const stripComments = src => { let inB = false, buf = ''; const out = []; for (const line of src) { if (!inB) buf = ''; let i = 0; while (i < line.length) { const two = line.slice(i, i + 2); if (!inB && two === '/*') { inB = true; i += 2; } else if (inB && two === '*/') { inB = false; i += 2; } else if (!inB && two === '//') break; else { if (!inB) buf += line[i]; i++; } } if (!inB && buf) out.push(buf); } return { out, open: inB }; };

  D('zigzag-conversion', {
    t: 'Zigzag Conversion',
    r: 'Walk the characters, appending each to the current row; bounce the row index between 0 and numRows − 1. Concatenate the rows.',
    g: R => ({ s: R.str(R.int(1, 10), 'ABCDEFGHIJ'), numRows: R.int(1, 4) }),
    s(I, T) { if (I.numRows === 1) { T.at({ s: I.s }); T.yn('Does anything change with one row?', false, 'No zigzag.'); return I.s; } const rows = Array.from({ length: I.numRows }, () => ''); let r = 0, d = 1; [...I.s].forEach((c, i) => { rows[r] += c; if (i < 7) { T.at({ s: A([...I.s], { i }), rows: A(rows.slice()) }); T.n(`Row of "${c}"?`, r, 'Bounce between top and bottom.'); } if (r === 0) d = 1; else if (r === I.numRows - 1) d = -1; r += d; }); return rows.join(''); }
  });

  D('count-and-say', {
    t: 'Count and Say',
    r: 'Start from "1". Each term reads the previous one as runs: for every run of equal digits, write its length then the digit.',
    g: R => ({ n: R.int(1, 8) }),
    s(I, T) { let s = '1'; for (let k = 2; k <= I.n; k++) { let t = ''; for (let i = 0; i < s.length;) { let j = i; while (j < s.length && s[j] === s[i]) j++; t += (j - i) + s[i]; i = j; } if (k <= 6) { T.at({ previous: s }); T.n(`Length of term ${k}?`, t.length, 'Two characters per run.'); } s = t; } return s; }
  });

  D('read-n-characters-given-read4', {
    t: 'Read N Characters Given Read4',
    r: 'Call read4 repeatedly, copying min(got, n − copied) characters each time; stop when read4 returns fewer than 4 or n is reached.',
    g: R => ({ file: R.str(R.int(1, 10), 'abcde'), n: R.int(1, 12) }),
    s(I, T) { let p = 0, copied = 0; while (copied < I.n) { const got = Math.min(4, I.file.length - p); p += got; const take = Math.min(got, I.n - copied); copied += take; T.at({ file: A([...I.file], { i: Math.max(0, p - 1) }), copied }); T.n('Characters read4 returned?', got, 'Up to 4 per call.'); if (got < 4) break; } return copied; }
  });

  D('read-n-characters-given-read4-ii', {
    t: 'Read N Characters Given read4 II - Call Multiple Times',
    r: 'Keep leftover characters from the last read4 in an internal buffer across calls. Each read first drains the buffer, then calls read4 as needed.',
    g: R => ({ file: R.str(R.int(1, 10), 'abc'), queries: R.ints(R.int(1, 4), 1, 5) }),
    s(I, T) { let p = 0, buf = []; return I.queries.map((n, i) => { let c = 0; while (c < n) { if (!buf.length) { buf = [...I.file.slice(p, p + 4)]; p += buf.length; if (!buf.length) break; } buf.shift(); c++; } if (i < 5) { T.at({ request: n, buffered: A(buf.slice()) }); T.n('Characters returned?', c, 'Buffer first, then read4.'); } return c; }); }
  });

  D('flip-game', {
    t: 'Flip Game',
    r: 'Scan every i where s[i] and s[i+1] are both "+", and record the string with that pair flipped to "--".',
    g: R => ({ currentState: R.str(R.int(1, 7), '++-') }),
    s(I, T) { const s = I.currentState, out = []; for (let i = 0; i + 1 < s.length; i++) if (s[i] === '+' && s[i + 1] === '+') out.push(s.slice(0, i) + '--' + s.slice(i + 2)); T.at({ state: A([...s]) }); T.n('How many "++" pairs?', out.length, 'Each gives one next state.'); return out; }
  });

  D('number-of-segments-in-a-string', {
    t: 'Number of Segments in a String',
    r: 'Count positions where a non-space character starts a segment (previous character is a space or it is the first character).',
    g: R => ({ s: R.str(R.int(0, 12), 'ab  ,') }),
    s(I, T) { let c = 0; [...I.s].forEach((ch, i) => { const st = ch !== ' ' && (i === 0 || I.s[i - 1] === ' '); if (st) c++; if (i < 6) { T.at({ s: A([...I.s].map(x => x === ' ' ? '␣' : x), { i }) }); T.yn('Does a segment start here?', st, 'Non-space after a space.'); } }); return c; }
  });

  D('license-key-formatting', {
    t: 'License Key Formatting',
    r: 'Remove dashes and uppercase. Group from the right in chunks of k, so only the first group may be shorter.',
    g: R => ({ s: R.str(R.int(1, 10), 'a1-B2-c'), k: R.int(1, 4) }),
    s(I, T) { const c = I.s.replace(/-/g, '').toUpperCase(); T.at({ cleaned: c }); T.n('Length of the first group?', c.length % I.k || (c.length ? I.k : 0), 'Remainder (or k).'); const out = []; for (let i = c.length; i > 0; i -= I.k) out.unshift(c.slice(Math.max(0, i - I.k), i)); return out.join('-'); }
  });

  D('output-contest-matches', {
    t: 'Output Contest Matches',
    r: 'Start with "1".."n". Each round pair team i with team (m − 1 − i) as "(a,b)", halving the list until one string remains.',
    g: R => ({ n: 2 ** R.int(1, 4) }),
    s(I, T) { let t = Array.from({ length: I.n }, (_, i) => String(i + 1)); while (t.length > 1) { const nx = []; for (let i = 0; i < t.length / 2; i++) nx.push(`(${t[i]},${t[t.length - 1 - i]})`); T.at({ teams: A(t) }); T.c('First match of this round?', [...new Set([nx[0], `(${t[0]},${t[1]})`])], nx[0], 'Strongest vs weakest.'); t = nx; } return t[0]; }
  });

  D('robot-return-to-origin', {
    t: 'Robot Return to Origin',
    r: 'Track (x, y): U/D change y, L/R change x. The robot returns iff both are 0 at the end.',
    g: R => ({ moves: R.str(R.int(1, 8), 'UDLR') }),
    s(I, T) { let x = 0, y = 0; [...I.moves].forEach((m, i) => { if (m === 'U') y++; else if (m === 'D') y--; else if (m === 'L') x--; else x++; if (i < 6) { T.at({ moves: A([...I.moves], { i }) }); T.n('x after this move?', x, 'L/R move horizontally.'); } }); return x === 0 && y === 0; }
  });

  D('remove-comments', {
    t: 'Remove Comments',
    r: 'Scan characters with an "in block comment" flag. "/*" opens (outside), "*/" closes (inside), "//" drops the rest of the line (outside). Lines only flush when not inside a block, so a block can join two lines.',
    g: R => { const tok = ['a', 'b;', 'x=1', '/*', '*/', '//c', ' ']; const src = Array.from({ length: R.int(1, 4) }, () => Array.from({ length: R.int(1, 4) }, () => R.pick(tok)).join('')); if (stripComments(src).open) src[src.length - 1] += '*/'; return { source: src }; },
    s(I, T) { const r = stripComments(I.source); I.source.slice(0, 5).forEach((l, i) => { const before = stripComments(I.source.slice(0, i)), inB = before.open; T.at({ line: X(l) }); T.yn('Does this line start inside a block comment?', inB, 'Carried over from earlier lines.'); }); return r.out; }
  });

  D('pour-water', {
    t: 'Pour Water',
    r: 'For each droplet at k: try moving left while the ground does not rise, remembering the lowest strictly-lower spot; if found, it settles there. Otherwise try the right the same way; otherwise it stays at k.',
    g: R => { const n = R.int(1, 6); return { heights: R.ints(n, 0, 3), volume: R.int(0, 4), k: R.int(0, n - 1) }; },
    s(I, T) { const h = I.heights.slice(), n = h.length; for (let v = 0; v < I.volume; v++) { let pos = I.k; for (const d of [-1, 1]) { let i = I.k, best = I.k; while (i + d >= 0 && i + d < n && h[i + d] <= h[i]) { if (h[i + d] < h[i]) best = i + d; i += d; } if (best !== I.k) { pos = best; break; } } h[pos]++; T.at({ heights: A(h.slice(), { i: pos }) }); T.n('Where did this droplet settle?', pos, 'Left first, then right, else k.'); } if (!I.volume) { T.at({ heights: A(h) }); T.n('Droplets poured?', 0, 'Nothing changes.'); } return h; }
  });

  D('number-of-lines-to-write-string', {
    t: 'Number of Lines To Write String',
    r: 'Add each letter\'s width to the current line; if it would exceed 100, start a new line with that letter. Return [lines, width of last line].',
    g: R => ({ widths: R.ints(26, 2, 10), s: R.str(R.int(1, 30), 'abcde') }),
    s(I, T) { let lines = 1, w = 0; [...I.s].forEach((c, i) => { const x = I.widths[c.charCodeAt(0) - 97]; if (w + x > 100) { lines++; w = 0; } w += x; if (i < 4 || i === I.s.length - 1) { T.at({ letter: c, width: x }); T.n('Current line width?', w, 'Wrap when over 100.'); } }); return [lines, w]; }
  });

  D('goat-latin', {
    t: 'Goat Latin',
    r: 'For word i (1-based): vowel-initial words keep their letters; others move the first letter to the end. Then add "ma" and i copies of "a".',
    g: R => ({ sentence: Array.from({ length: R.int(1, 4) }, () => R.pick(['I', 'speak', 'Goat', 'apple', 'the', 'Eel'])).join(' ') }),
    s(I, T) { return I.sentence.split(' ').map((w, i) => { const v = /^[aeiou]/i.test(w), r = (v ? w : w.slice(1) + w[0]) + 'ma' + 'a'.repeat(i + 1); T.at({ word: w, position: i + 1 }); T.yn('Starts with a vowel?', v, 'Otherwise rotate the first letter.'); return r; }).join(' '); }
  });

  D('masking-personal-information', {
    t: 'Masking Personal Information',
    r: 'Email: lowercase, keep the first and last letters of the name with "*****" between. Phone: keep digits; last 4 are local, the rest beyond 10 form a country code shown as "+**-".',
    g: R => R.chance(0.5) ? { s: R.pick(['Al', 'Bob', 'LeetCode', 'xY']) + '@' + R.pick(['Qq', 'mail']) + '.com' } : { s: (R.chance(0.5) ? '+' + R.str(R.int(1, 3), '123') + ' ' : '') + '(' + R.str(3, '0123456789') + ') ' + R.str(3, '0123456789') + '-' + R.str(4, '0123456789') },
    s(I, T) { if (I.s.includes('@')) { const [nm, dom] = I.s.toLowerCase().split('@'); T.at({ s: I.s }); T.yn('Is this an email?', true, 'Contains "@".'); return nm[0] + '*****' + nm[nm.length - 1] + '@' + dom; } const d = I.s.replace(/\D/g, ''), c = d.length - 10; T.at({ digits: d }); T.n('Country-code digits?', c, 'Digits beyond 10.'); return (c ? '+' + '*'.repeat(c) + '-' : '') + '***-***-' + d.slice(-4); }
  });

  D('walking-robot-simulation', {
    t: 'Walking Robot Simulation',
    r: 'Keep a direction index (N, E, S, W). −2 turns left, −1 turns right; a move k steps one unit at a time, stopping before an obstacle. Track the max of x² + y².',
    g: R => ({ commands: Array.from({ length: R.int(1, 5) }, () => R.pick([-2, -1, R.int(1, 4)])), obstacles: Array.from({ length: R.int(0, 3) }, () => [R.int(-3, 3), R.int(-3, 3)]).filter(([x, y]) => x || y) }),
    s(I, T) { const ob = new Set(I.obstacles.map(o => o.join(','))), dir = [[0, 1], [1, 0], [0, -1], [-1, 0]]; let d = 0, x = 0, y = 0, best = 0; I.commands.forEach((c, i) => { if (c === -2) d = (d + 3) % 4; else if (c === -1) d = (d + 1) % 4; else for (let s = 0; s < c; s++) { const nx = x + dir[d][0], ny = y + dir[d][1]; if (ob.has(nx + ',' + ny)) break; x = nx; y = ny; best = Math.max(best, x * x + y * y); } if (i < 6) { T.at({ command: c, facing: 'NESW'[d] }); T.n('x² + y² after this command?', x * x + y * y, 'Stop before obstacles.'); } }); return best; }
  });

  D('sum-of-even-numbers-after-queries', {
    t: 'Sum of Even Numbers After Queries',
    r: 'Maintain the even sum. For each query, subtract the old value if it was even, update it, then add the new value if it is even.',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, -5, 9), queries: Array.from({ length: R.int(1, 4) }, () => [R.int(-4, 4), R.int(0, n - 1)]) }; },
    s(I, T) { const a = I.nums.slice(); let s = sum(a.filter(x => x % 2 === 0)); return I.queries.map(([v, i]) => { if (a[i] % 2 === 0) s -= a[i]; a[i] += v; if (a[i] % 2 === 0) s += a[i]; T.at({ nums: A(a.slice(), { i }) }); T.n('Even sum now?', s, 'Remove old, add new if even.'); return s; }); }
  });

  D('array-transformation', {
    t: 'Array Transformation',
    r: 'Each day, using the previous day\'s array: an interior element smaller than both neighbors gains 1, larger than both loses 1. Repeat until nothing changes.',
    g: R => ({ arr: R.ints(R.int(1, 6), 1, 9) }),
    s(I, T) { let a = I.arr.slice(), day = 0; for (;;) { const b = a.slice(); for (let i = 1; i + 1 < a.length; i++) { if (a[i] < a[i - 1] && a[i] < a[i + 1]) b[i]++; else if (a[i] > a[i - 1] && a[i] > a[i + 1]) b[i]--; } const ch = b.some((v, i) => v !== a[i]); if (day++ < 4) { T.at({ arr: A(a) }); T.yn('Does anything change today?', ch, 'Valleys rise, peaks fall.'); } if (!ch) return a; a = b; } }
  });

  D('create-target-array-in-the-given-order', {
    t: 'Create Target Array in the Given Order',
    r: 'Insert nums[i] at position index[i] in order, shifting later elements right.',
    g: R => { const n = R.int(1, 6), nums = R.ints(n, 0, 9), index = []; for (let i = 0; i < n; i++) index.push(R.int(0, i)); return { nums, index }; },
    s(I, T) { const t = []; I.nums.forEach((v, i) => { t.splice(I.index[i], 0, v); if (i < 6) { T.at({ target: A(t.slice(), { i: I.index[i] }) }); T.n('Target length now?', t.length, `Inserted ${v} at ${I.index[i]}.`); } }); return t; }
  });

  D('queries-on-a-permutation-with-key', {
    t: 'Queries on a Permutation With Key',
    r: 'Start with P = [1..m]. For each query, record its position in P, then move it to the front.',
    g: R => { const m = R.int(1, 6); return { queries: R.ints(R.int(1, 5), 1, m), m }; },
    s(I, T) { const P = Array.from({ length: I.m }, (_, i) => i + 1); return I.queries.map(q => { const i = P.indexOf(q); T.at({ P: A(P.slice(), { i }) }); T.n(`Position of ${q}?`, i, 'Then move it to the front.'); P.splice(i, 1); P.unshift(q); return i; }); }
  });

  D('minimum-number-of-frogs-croaking', {
    t: 'Minimum Number of Frogs Croaking',
    r: 'Count how many frogs are at each stage of "croak". Each letter must follow a frog at the previous stage; "c" starts a new frog (or reuses a finished one). Track the max simultaneously active frogs; leftovers mean −1.',
    g: R => ({ croakOfFrogs: R.chance(0.6) ? (() => { const k = R.int(1, 3), pos = Array(k).fill(0); let s = ''; while (pos.some(p => p < 5)) { const i = R.pick(pos.map((p, j) => p < 5 ? j : -1).filter(j => j >= 0)); s += 'croak'[pos[i]++]; } return s; })() : R.str(R.int(1, 10), 'croak') }),
    s(I, T) { const st = { c: 0, r: 1, o: 2, a: 3, k: 4 }, cnt = [0, 0, 0, 0, 0]; let active = 0, best = 0; for (const [i, ch] of [...I.croakOfFrogs].entries()) { const k = st[ch]; if (k === 0) { cnt[0]++; active++; best = Math.max(best, active); } else { if (!cnt[k - 1]) { T.at({ s: A([...I.croakOfFrogs], { i }) }); T.yn('Is a frog ready for this letter?', false, 'Out of order → −1.'); return -1; } cnt[k - 1]--; if (k === 4) active--; else cnt[k]++; } if (i < 6) { T.at({ s: A([...I.croakOfFrogs], { i }), stages: K({ c: cnt[0], r: cnt[1], o: cnt[2], a: cnt[3] }) }); T.n('Frogs croaking right now?', active, '"c" starts one, "k" finishes one.'); } } return active ? -1 : best; }
  });

  D('find-the-winner-of-an-array-game', {
    t: 'Find the Winner of an Array Game',
    r: 'Keep the current champion and a win streak; compare with each next element. If the streak reaches k, it wins. If the array runs out, the champion is the maximum and wins.',
    g: R => ({ arr: R.distinct(R.int(2, 7), 1, 20), k: R.int(1, 8) }),
    s(I, T) { let cur = I.arr[0], w = 0; for (let i = 1; i < I.arr.length; i++) { if (I.arr[i] > cur) { cur = I.arr[i]; w = 1; } else w++; if (i < 6) { T.at({ arr: A(I.arr, { i }), champion: cur }); T.n('Current win streak?', w, 'Reset to 1 when a new champion appears.'); } if (w === I.k) return cur; } return cur; }
  });

  D('count-unhappy-friends', {
    t: 'Count Unhappy Friends',
    r: 'Precompute rank[x][y] (how much x likes y). x paired with y is unhappy if some u (paired with v) satisfies rank[x][u] < rank[x][y] and rank[u][x] < rank[u][v].',
    g: R => { const n = 2 * R.int(1, 3), p = R.perm(n), pairs = []; for (let i = 0; i < n; i += 2) pairs.push([p[i], p[i + 1]]); return { n, preferences: Array.from({ length: n }, (_, i) => R.shuffle(Array.from({ length: n }, (_, j) => j).filter(j => j !== i))), pairs }; },
    s(I, T) { const n = I.n, rk = Array.from({ length: n }, () => Array(n).fill(0)), mate = []; I.preferences.forEach((l, x) => l.forEach((y, r) => rk[x][y] = r)); I.pairs.forEach(([a, b]) => { mate[a] = b; mate[b] = a; }); let c = 0; for (let x = 0; x < n; x++) { const y = mate[x]; const un = I.preferences[x].slice(0, rk[x][y]).some(u => rk[u][x] < rk[u][mate[u]]); if (un) c++; if (x < 5) { T.at({ friend: x, partner: y, prefers: A(I.preferences[x]) }); T.yn('Unhappy?', un, 'Someone they prefer also prefers them.'); } } return c; }
  });

  D('crawler-log-folder', {
    t: 'Crawler Log Folder',
    r: 'Track depth: "../" goes up (not below 0), "./" stays, anything else goes one level deeper. The answer is the final depth.',
    g: R => ({ logs: Array.from({ length: R.int(1, 7) }, () => R.pick(['d1/', 'd2/', '../', './', 'x/'])) }),
    s(I, T) { let d = 0; I.logs.forEach((l, i) => { if (l === '../') d = Math.max(0, d - 1); else if (l !== './') d++; if (i < 6) { T.at({ logs: A(I.logs, { i }) }); T.n('Depth now?', d, 'Never above the main folder.'); } }); return d; }
  });

  D('maximum-profit-of-operating-a-centennial-wheel', {
    t: 'Maximum Profit of Operating a Centennial Wheel',
    r: 'Each rotation: add the arriving customers to the queue, board up to 4, and update profit (boarded × boardingCost − runningCost). Continue while customers wait; return the rotation count with the best positive profit (−1 if never positive).',
    g: R => ({ customers: R.ints(R.int(1, 4), 0, 10), boardingCost: R.int(1, 8), runningCost: R.int(1, 20) }),
    s(I, T) { let wait = 0, p = 0, best = 0, ans = -1, rot = 0, i = 0; while (i < I.customers.length || wait > 0) { if (i < I.customers.length) wait += I.customers[i++]; const b = Math.min(4, wait); wait -= b; rot++; p += b * I.boardingCost - I.runningCost; if (p > best) { best = p; ans = rot; } if (rot <= 5) { T.at({ rotation: rot, waiting: wait }); T.n('Profit so far?', p, 'boarded × boardingCost − runningCost.'); } } return ans; }
  });

  D('get-maximum-in-generated-array', {
    t: 'Get Maximum in Generated Array',
    r: 'Build nums: nums[2i] = nums[i], nums[2i+1] = nums[i] + nums[i+1]. Track the maximum.',
    g: R => ({ n: R.int(0, 20) }),
    s(I, T) { if (I.n === 0) { T.at({ n: 0 }); T.n('Max of [0]?', 0, 'Only nums[0].'); return 0; } const a = [0, 1]; for (let i = 2; i <= I.n; i++) { a[i] = i % 2 ? a[i >> 1] + a[(i >> 1) + 1] : a[i >> 1]; if (i < 8) { T.at({ nums: A(a.slice(), { i }) }); T.n(`nums[${i}]?`, a[i], i % 2 ? 'nums[i] + nums[i+1].' : 'Copy nums[i].'); } } return Math.max(...a); }
  });

  D('reformat-phone-number', {
    t: 'Reformat Phone Number',
    r: 'Keep the digits. Take blocks of 3 while more than 4 remain; then 4 digits become 2-2, 3 stay as one block, 2 stay as one block.',
    g: R => ({ number: R.int(1, 9) + Array.from({ length: R.int(1, 10) }, () => R.pick(['1', '2', '3', '4', '5', '-', ' '])).join('') + R.int(0, 9) }),
    s(I, T) { let d = I.number.replace(/\D/g, ''); const out = []; while (d.length > 4) { out.push(d.slice(0, 3)); d = d.slice(3); } if (d.length === 4) out.push(d.slice(0, 2), d.slice(2)); else out.push(d); T.at({ digits: I.number.replace(/\D/g, '') }); T.n('How many blocks?', out.length, '3s first, then the tail.'); return out.join('-'); }
  });

  D('average-waiting-time', {
    t: 'Average Waiting Time',
    r: 'The chef starts each order at max(current time, arrival); the customer waits finish − arrival. Average the waits.',
    g: R => { let t = 0; return { customers: Array.from({ length: R.int(1, 5) }, () => [t += R.int(0, 4), R.int(1, 5)]) }; },
    cmp: 'float',
    s(I, T) { let t = 0, w = 0; I.customers.forEach(([a, d], i) => { t = Math.max(t, a) + d; w += t - a; if (i < 5) { T.at({ customer: `arrives ${a}, needs ${d}` }); T.n('Wait for this customer?', t - a, 'Finish time − arrival.'); } }); return w / I.customers.length; }
  });

  D('build-array-from-permutation', {
    t: 'Build Array from Permutation',
    r: 'ans[i] = nums[nums[i]]. (The O(1)-space trick stores both values in one slot as a + n·b.)',
    g: R => ({ nums: R.perm(R.int(1, 7)) }),
    s(I, T) { return I.nums.map((v, i) => { const r = I.nums[v]; if (i < 5) { T.at({ nums: A(I.nums, { i, j: v }) }); T.n(`ans[${i}]?`, r, `nums[nums[${i}]] = nums[${v}].`); } return r; }); }
  });

  D('concatenation-of-array', {
    t: 'Concatenation of Array',
    r: 'ans[i] = ans[i + n] = nums[i].',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 9) }),
    s(I, T) { const n = I.nums.length; T.at({ nums: A(I.nums) }); T.n('Length of the answer?', 2 * n, 'Two copies.'); T.n(`ans[${n}]?`, I.nums[0], 'Second copy starts over.'); return [...I.nums, ...I.nums]; }
  });

  D('sum-of-digits-of-string-after-convert', {
    t: 'Sum of Digits of String After Convert',
    r: 'Replace each letter by its alphabet position (as digits), then replace the number by its digit sum, k times.',
    g: R => ({ s: R.str(R.int(1, 6), 'abiklz'), k: R.int(1, 3) }),
    s(I, T) { let d = [...I.s].map(c => c.charCodeAt(0) - 96).join(''); for (let i = 0; i < I.k; i++) { const v = [...d].reduce((a, c) => a + +c, 0); T.at({ number: d }); T.n(`After transform #${i + 1}?`, v, 'Sum of digits.'); d = String(v); } return +d; }
  });
})();
