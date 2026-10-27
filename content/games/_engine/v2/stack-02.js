/* v2 games: stacks & queues (02). */
(function () {
  'use strict';
  const { D, A, K, S, Q } = LCGame.H;
  const gcd = (a, b) => b ? gcd(b, a % b) : a;

  D('remove-all-adjacent-duplicates-in-string-ii', {
    t: 'Remove All Adjacent Duplicates in String II',
    r: 'Stack of [char, run count]. Push or increment; when a run reaches k, pop it. Rebuild the string from the stack.',
    g: R => ({ s: R.str(R.int(1, 12), 'abbd'), k: R.int(2, 3) }),
    s(I, T) { const st = []; [...I.s].forEach((c, i) => { if (st.length && st[st.length - 1][0] === c) st[st.length - 1][1]++; else st.push([c, 1]); const top = st[st.length - 1][1]; if (top === I.k) st.pop(); if (i < 7) { T.at({ s: A([...I.s], { i }), stack: S(st.map(x => x[0] + '×' + x[1])) }); T.n('Run count of this letter before removal?', top, `Remove at ${I.k}.`); } }); return st.map(([c, n]) => c.repeat(n)).join(''); }
  });

  D('build-an-array-with-stack-operations', {
    t: 'Build an Array With Stack Operations',
    r: 'Stream 1, 2, … up to the last target value: push each; if it is not the next target value, pop it immediately.',
    g: R => ({ target: R.distinct(R.int(1, 4), 1, 7).sort((a, b) => a - b), n: 7 }),
    s(I, T) { const out = [], need = new Set(I.target), last = I.target[I.target.length - 1]; for (let x = 1; x <= last; x++) { out.push('Push'); if (!need.has(x)) out.push('Pop'); if (x <= 6) { T.at({ stream: x, target: A(I.target) }); T.yn(`Keep ${x}?`, need.has(x), 'Otherwise Push then Pop.'); } } return out; }
  });

  D('minimum-insertions-to-balance-a-parentheses-string', {
    t: 'Minimum Insertions to Balance a Parentheses String',
    r: 'Track how many ")" are still needed. "(" adds 2 (inserting a ")" first if the need is odd). ")" uses one; if none was needed, insert a "(" and now need one more.',
    g: R => ({ s: R.str(R.int(1, 9), '())') }),
    s(I, T) { let ins = 0, need = 0; [...I.s].forEach((c, i) => { if (c === '(') { need += 2; if (need % 2) { ins++; need--; } } else { need--; if (need === -1) { ins++; need = 1; } } if (i < 7) { T.at({ s: A([...I.s], { i }), inserted: ins }); T.n('")" still needed?', need, 'Each "(" needs "))".'); } }); return ins + need; }
  });

  D('check-if-string-is-transformable-with-substring-sort-operations', {
    t: 'Check If String Is Transformable With Substring Sort Operations',
    r: 'Keep a queue of positions for each digit in s. For each digit d of t, take the earliest unused d; it can move left only past larger digits, so fail if any smaller digit has an unused position before it.',
    g: R => { const s = R.str(R.int(1, 6), '12345'); return { s, t: R.chance(0.5) ? (() => { const a = [...s]; const i = R.int(0, a.length - 1), j = R.int(i, a.length - 1); return [...a.slice(0, i), ...a.slice(i, j + 1).sort(), ...a.slice(j + 1)].join(''); })() : R.shuffle([...s]).join('') }; },
    s(I, T) { const q = Array.from({ length: 10 }, () => []); [...I.s].forEach((c, i) => q[+c].push(i)); for (const [k, c] of [...I.t].entries()) { const d = +c; if (!q[d].length) return false; const p = q[d][0]; const blocked = q.slice(0, d).some(x => x.length && x[0] < p); if (k < 6) { T.at({ t: A([...I.t], { i: k }), s: A([...I.s], { i: p }) }); T.yn(`Is a smaller digit stuck before this ${d}?`, blocked, 'A digit cannot jump left over smaller ones.'); } if (blocked) return false; q[d].shift(); } return true; }
  });

  D('maximum-nesting-depth-of-the-parentheses', {
    t: 'Maximum Nesting Depth of the Parentheses',
    r: 'Track the current depth (+1 on "(", −1 on ")") and its maximum.',
    g: R => { let s = '', d = 0; for (let i = 0; i < R.int(1, 12); i++) { const r = R.int(0, 2); if (r === 0) { s += '('; d++; } else if (r === 1 && d) { s += ')'; d--; } else s += R.pick(['1', '+', '2']); } return { s: s + ')'.repeat(d) }; },
    s(I, T) { let d = 0, m = 0; [...I.s].forEach((c, i) => { if (c === '(') d++; else if (c === ')') d--; m = Math.max(m, d); if (i < 7) { T.at({ s: A([...I.s], { i }) }); T.n('Depth now?', d, 'Parentheses only.'); } }); return m; }
  });

  D('number-of-students-unable-to-eat-lunch', {
    t: 'Number of Students Unable to Eat Lunch',
    r: 'Order in the queue does not matter: count students wanting each type. Serve sandwiches from the top while someone wants it; when nobody wants the top sandwich, the rest are stuck.',
    g: R => { const n = R.int(1, 6); return { students: R.ints(n, 0, 1), sandwiches: R.ints(n, 0, 1) }; },
    s(I, T) { const c = [0, 0]; I.students.forEach(x => c[x]++); for (const [i, s] of I.sandwiches.entries()) { T.at({ sandwiches: A(I.sandwiches, { i }), want: K({ circular: c[0], square: c[1] }) }); T.yn('Does someone want the top sandwich?', c[s] > 0, 'Otherwise everyone left is stuck.'); if (!c[s]) return I.sandwiches.length - i; c[s]--; } return 0; }
  });

  D('maximum-score-from-removing-substrings', {
    t: 'Maximum Score From Removing Substrings',
    r: 'Greedy: remove the more valuable pair ("ab" if x ≥ y, else "ba") everywhere with a stack first, then remove the other pair from what remains.',
    g: R => ({ s: R.str(R.int(1, 12), 'abbac'), x: R.int(1, 6), y: R.int(1, 6) }),
    s(I, T) { const res = (() => { const [p1, v1, p2, v2] = I.x >= I.y ? ['ab', I.x, 'ba', I.y] : ['ba', I.y, 'ab', I.x]; const pass = (s, p, v) => { const st = []; let sc = 0; for (const c of s) { if (st.length && st[st.length - 1] === p[0] && c === p[1]) { st.pop(); sc += v; } else st.push(c); } return [st.join(''), sc]; }; const [r1, s1] = pass(I.s, p1, v1); T.at({ s: I.s, first: p1 }); T.n(`Points from removing "${p1}" first?`, s1, 'Higher-value pair first.'); const [r2, s2] = pass(r1, p2, v2); T.at({ left: r1 }); T.n(`Points from "${p2}" afterwards?`, s2, 'Clean up what remains.'); return s1 + s2; })(); T.n('Maximum score?', res, 'Both passes together.'); return res; }
  });

  D('remove-all-occurrences-of-a-substring', {
    t: 'Remove All Occurrences of a Substring',
    r: 'Build the result like a stack: append each character, and whenever the result ends with part, chop it off.',
    g: R => { const part = R.str(R.int(1, 3), 'ab'); let s = R.str(R.int(0, 4), 'abc'); for (let i = 0; i < R.int(1, 3); i++) { const p = R.int(0, s.length); s = s.slice(0, p) + part + s.slice(p); } return { s, part }; },
    s(I, T) { let r = '', k = 0; for (const c of I.s) { r += c; const hit = r.endsWith(I.part); if (hit) r = r.slice(0, -I.part.length); if (k++ < 7) { T.at({ result: r }); T.yn('Did part just appear at the end?', hit, 'Then remove it.'); } } return r; }
  });

  D('minimum-number-of-swaps-to-make-the-string-balanced', {
    t: 'Minimum Number of Swaps to Make the String Balanced',
    r: 'Cancel matched pairs with a counter; let m be the unmatched "]" count. Each swap fixes two of them, so the answer is ⌈m / 2⌉.',
    g: R => { const n = R.int(1, 4); return { s: R.shuffle([...'['.repeat(n) + ']'.repeat(n)]).join('') }; },
    s(I, T) { let open = 0, bad = 0; [...I.s].forEach((c, i) => { if (c === '[') open++; else if (open) open--; else bad++; if (i < 7) { T.at({ s: A([...I.s], { i }) }); T.n('Unmatched "]" so far?', bad, 'No "[" available to pair.'); } }); return Math.ceil(bad / 2); }
  });

  D('time-needed-to-buy-tickets', {
    t: 'Time Needed to Buy Tickets',
    r: 'People before or at k buy min(t[i], t[k]) tickets before k finishes; people after k buy min(t[i], t[k] − 1).',
    g: R => { const t = R.ints(R.int(1, 6), 1, 5); return { tickets: t, k: R.int(0, t.length - 1) }; },
    s(I, T) { let s = 0; I.tickets.forEach((x, i) => { const c = Math.min(x, i <= I.k ? I.tickets[I.k] : I.tickets[I.k] - 1); s += c; if (i < 6) { T.at({ tickets: A(I.tickets, { i, j: I.k }) }); T.n('Tickets this person buys before k is done?', c, i <= I.k ? 'Up to t[k].' : 'Up to t[k] − 1.'); } }); return s; }
  });

  D('check-if-a-parentheses-string-can-be-valid', {
    t: 'Check if a Parentheses String Can Be Valid',
    r: 'Odd length fails. Left to right, treat unlocked characters as "(" — the balance must never go negative. Right to left, treat unlocked as ")" — likewise.',
    g: R => { const n = 2 * R.int(1, 4) - (R.chance(0.15) ? 1 : 0); return { s: R.str(n, '()'), locked: R.str(n, '01') }; },
    s(I, T) { const res = (() => { const n = I.s.length; T.at({ s: I.s, locked: I.locked }); T.n('Free positions?', [...I.locked].filter(c => c === '0').length, 'They can be either bracket.'); T.yn('Even length?', n % 2 === 0, 'Required.'); if (n % 2) return false; let b = 0; for (let i = 0; i < n; i++) { b += I.locked[i] === '0' || I.s[i] === '(' ? 1 : -1; if (b < 0) { T.at({ s: A([...I.s], { i }) }); T.yn('Too many locked ")" from the left?', true, 'Even with all free as "(".'); return false; } } b = 0; for (let i = n - 1; i >= 0; i--) { b += I.locked[i] === '0' || I.s[i] === ')' ? 1 : -1; if (b < 0) { T.at({ s: A([...I.s], { i }) }); T.yn('Too many locked "(" from the right?', true, 'Even with all free as ")".'); return false; } } return true; })(); T.yn('Can it be made valid?', res, 'Both scans stayed non-negative.'); return res; }
  });

  D('replace-non-coprime-numbers-in-array', {
    t: 'Replace Non-Coprime Numbers in Array',
    r: 'Use a stack: push each number, then while the top two are non-coprime, replace them with their LCM (which may merge further down).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 12) }),
    s(I, T) { const st = []; I.nums.forEach((x, i) => { let v = x; while (st.length && gcd(st[st.length - 1], v) > 1) { const t = st.pop(); v = t / gcd(t, v) * v; } st.push(v); if (i < 6) { T.at({ nums: A(I.nums, { i }), stack: S(st.slice()) }); T.n('Top after merging?', v, 'LCM while gcd > 1.'); } }); return st; }
  });

  D('count-collisions-on-a-road', {
    t: 'Count Collisions on a Road',
    r: 'Cars moving L at the far left and R at the far right escape. Every other moving car eventually collides and stops, adding 1 each.',
    g: R => ({ directions: R.str(R.int(1, 8), 'LRS') }),
    s(I, T) { const res = (() => { const d = I.directions; let i = 0, j = d.length - 1; while (i < d.length && d[i] === 'L') i++; while (j >= 0 && d[j] === 'R') j--; T.at({ road: A([...d], { i, j }) }); T.n('Cars escaping to the left?', i, 'Leading L cars.'); T.n('Cars escaping to the right?', d.length - 1 - j, 'Trailing R cars.'); let c = 0; for (let k = i; k <= j; k++) if (d[k] !== 'S') c++; return c; })(); T.n('Total collisions?', res, 'Every moving car in the middle stops.'); return res; }
  });

  D('minimum-deletions-to-make-array-beautiful', {
    t: 'Minimum Deletions to Make Array Beautiful',
    r: 'Scan, tracking the length of the kept array. If the kept length is even (a pair starts) and the next element equals the current one, delete it. Finally delete one more if the kept length is odd.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 3) }),
    s(I, T) { const kept = []; let del = 0; I.nums.forEach((x, i) => { const bad = kept.length % 2 === 1 && kept[kept.length - 1] === x; if (bad) del++; else kept.push(x); if (i < 7) { T.at({ nums: A(I.nums, { i }), kept: A(kept.slice()) }); T.yn('Delete this element?', bad, 'It would equal its pair partner.'); } }); return del + (kept.length % 2); }
  });

  D('removing-stars-from-a-string', {
    t: 'Removing Stars From a String',
    r: 'Stack: push letters; a star pops the most recent letter.',
    g: R => { let s = '', n = 0; for (let i = 0; i < R.int(1, 10); i++) { if (n && R.chance(0.35)) { s += '*'; n--; } else { s += R.pick(['a', 'b', 'c']); n++; } } return { s }; },
    s(I, T) { const st = []; [...I.s].forEach((c, i) => { if (c === '*') st.pop(); else st.push(c); if (i < 7) { T.at({ s: A([...I.s], { i }), stack: S(st.slice()) }); T.n('Letters kept so far?', st.length, 'A star removes the closest letter.'); } }); return st.join(''); }
  });

  D('using-a-robot-to-print-the-lexicographically-smallest-string', {
    t: 'Using a Robot to Print the Lexicographically Smallest String',
    r: 'Precompute suffix minima of s. Push each character onto t (a stack); then pop to the output while the top of t is ≤ the smallest character still remaining in s.',
    g: R => ({ s: R.str(R.int(1, 7), 'abcz') }),
    s(I, T) { const s = I.s, n = s.length, mn = Array(n + 1).fill('{'); for (let i = n - 1; i >= 0; i--) mn[i] = s[i] < mn[i + 1] ? s[i] : mn[i + 1]; const st = []; let out = ''; [...s].forEach((c, i) => { st.push(c); while (st.length && st[st.length - 1] <= mn[i + 1]) out += st.pop(); if (i < 6) { T.at({ s: A([...s], { i }), t: S(st.slice()) }); T.n('Characters written so far?', out.length, 'Pop while the top ≤ remaining minimum.'); } }); return out; }
  });

  D('time-taken-to-cross-the-door', {
    t: 'Time Taken to Cross the Door',
    r: 'Simulate seconds with an enter queue and an exit queue. If the door was idle last second or last used to exit, exiting goes first; if it was used to enter, entering goes first. Idle seconds reset the priority to exit.',
    g: R => { const n = R.int(1, 6); return { arrival: R.sorted(n, 0, 5), state: R.ints(n, 0, 1) }; },
    s(I, T) { const n = I.arrival.length, ans = Array(n), qe = [], qx = []; let t = 0, i = 0, last = 1, done = 0, k = 0; while (done < n) { while (i < n && I.arrival[i] <= t) (I.state[i] ? qx : qe).push(i++); if (!qe.length && !qx.length) { last = 1; t = I.arrival[i]; continue; } let p; if (qx.length && (last === 1 || !qe.length)) { p = qx.shift(); last = 1; } else { p = qe.shift(); last = 0; } ans[p] = t; done++; if (k++ < 5) { T.at({ time: t, enter: Q(qe.slice()), exit: Q(qx.slice()) }); T.n('Who uses the door this second?', p, 'Priority depends on last second.'); } t++; } return ans; }
  });

  D('minimum-string-length-after-removing-substrings', {
    t: 'Minimum String Length After Removing Substrings',
    r: 'Stack: push each letter; if it completes "AB" or "CD" with the top, pop instead. The stack size is the answer.',
    g: R => ({ s: R.str(R.int(1, 10), 'ABCDF') }),
    s(I, T) { const st = []; [...I.s].forEach((c, i) => { const top = st[st.length - 1]; const hit = (top === 'A' && c === 'B') || (top === 'C' && c === 'D'); if (hit) st.pop(); else st.push(c); if (i < 7) { T.at({ s: A([...I.s], { i }), stack: S(st.slice()) }); T.yn('Removed a pair?', hit, '"AB" or "CD".'); } }); return st.length; }
  });

  D('robot-collisions', {
    t: 'Robot Collisions',
    r: 'Sort robots by position. Keep a stack of right-moving survivors. A left-mover fights the stack top: the weaker one dies, the stronger loses 1 health; equal health kills both. Return survivors\' health in original order.',
    g: R => { const n = R.int(1, 6); return { positions: R.distinct(n, 1, 20), healths: R.ints(n, 1, 6), directions: R.str(n, 'LR') }; },
    s(I, T) { const res = (() => { const n = I.positions.length, h = I.healths.slice(), ord = I.positions.map((_, i) => i).sort((a, b) => I.positions[a] - I.positions[b]), st = []; let k = 0; for (const i of ord) { if (I.directions[i] === 'R') { st.push(i); continue; } while (h[i] > 0 && st.length) { const j = st[st.length - 1]; const res = h[j] < h[i] ? 'left-mover' : h[j] > h[i] ? 'right-mover' : 'both die'; if (h[j] < h[i]) { st.pop(); h[j] = 0; h[i]--; } else if (h[j] > h[i]) { h[i] = 0; h[j]--; } else { st.pop(); h[i] = h[j] = 0; } if (k++ < 5) { T.at({ fight: `Robot ${j + 1} going right meets robot ${i + 1} going left`, healths: A(h.slice()) }); T.c('Outcome?', ['left-mover', 'right-mover', 'both die'], res, 'The stronger one survives with 1 less health.'); } } } return h.filter(x => x > 0); })(); T.n('Robots left?', res.length, 'Survivors in input order.'); return res; }
  });

  D('lexicographically-minimum-string-after-removing-stars', {
    t: 'Lexicographically Minimum String After Removing Stars',
    r: 'Keep a stack of indices per letter. Each "*" deletes the smallest letter to its left, choosing its rightmost occurrence (pop from that letter\'s stack). Output the surviving letters in order.',
    g: R => { let s = '', n = 0; for (let i = 0; i < R.int(1, 9); i++) { if (n && R.chance(0.3)) { s += '*'; n--; } else { s += R.pick(['a', 'b', 'c']); n++; } } return { s }; },
    s(I, T) { const res = (() => { const st = Array.from({ length: 26 }, () => []), gone = new Set(); T.at({ s: A([...I.s]) }); T.n('Stars?', [...I.s].filter(c => c === '*').length, 'Each removes one letter.'); let k = 0; [...I.s].forEach((c, i) => { if (c !== '*') { st[c.charCodeAt(0) - 97].push(i); return; } gone.add(i); const L = st.findIndex(x => x.length), j = st[L].pop(); gone.add(j); if (k++ < 5) { T.at({ s: A([...I.s], { i, j }) }); T.n('Index of the letter removed?', j, 'Smallest letter, rightmost copy.'); } }); return [...I.s].filter((_, i) => !gone.has(i)).join(''); })(); T.n('Length of the result?', res.length, 'Letters minus stars.'); return res; }
  });

  D('clear-digits', {
    t: 'Clear Digits',
    r: 'Stack: push letters; a digit pops the closest letter to its left.',
    g: R => { let s = '', n = 0; for (let i = 0; i < R.int(1, 9); i++) { if (n && R.chance(0.35)) { s += R.int(0, 9); n--; } else { s += R.pick(['a', 'b', 'c']); n++; } } return { s }; },
    s(I, T) { const st = []; [...I.s].forEach((c, i) => { if (/\d/.test(c)) st.pop(); else st.push(c); if (i < 7) { T.at({ s: A([...I.s], { i }), stack: S(st.slice()) }); T.n('Letters left so far?', st.length, 'A digit deletes the nearest letter on its left.'); } }); return st.join(''); }
  });

  D('find-mirror-score-of-a-string', {
    t: 'Find Mirror Score of a String',
    r: 'Keep a stack of unmarked indices per letter. At index i, if the stack for mirror(s[i]) is non-empty, pop j and add i − j; otherwise push i onto s[i]\'s stack.',
    g: R => ({ s: R.str(R.int(1, 9), 'abyz') }),
    s(I, T) { const st = Array.from({ length: 26 }, () => []); let sc = 0; [...I.s].forEach((c, i) => { const x = c.charCodeAt(0) - 97, m = 25 - x; let add = 0; if (st[m].length) { add = i - st[m].pop(); sc += add; } else st[x].push(i); if (i < 7) { T.at({ s: A([...I.s], { i }) }); T.n('Score added here?', add, `Closest unmarked "${String.fromCharCode(97 + m)}" to the left.`); } }); return sc; }
  });
})();
