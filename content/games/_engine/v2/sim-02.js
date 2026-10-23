/* v2 games: simulation (02). */
(function () {
  'use strict';
  const { D, A, G, K } = LCGame.H;
  const sum = a => a.reduce((x, y) => x + y, 0);

  D('final-value-of-variable-after-performing-operations', {
    t: 'Final Value of Variable After Performing Operations',
    r: 'Each operation contains either "++" (add 1) or "--" (subtract 1); the position of X does not matter.',
    g: R => ({ operations: Array.from({ length: R.int(1, 6) }, () => R.pick(['++X', 'X++', '--X', 'X--'])) }),
    s(I, T) { let x = 0; I.operations.forEach((o, i) => { x += o.includes('+') ? 1 : -1; if (i < 6) { T.at({ ops: A(I.operations, { i }) }); T.n('X now?', x, '"++" adds, "--" subtracts.'); } }); return x; }
  });

  D('watering-plants', {
    t: 'Watering Plants',
    r: 'Walk right one step per plant. If the can holds less than the next plant needs, walk back to the river (i steps) and return (i steps), refilling.',
    g: R => { const p = R.ints(R.int(1, 6), 1, 5); return { plants: p, capacity: R.int(Math.max(...p), 8) }; },
    s(I, T) { let w = I.capacity, st = 0; I.plants.forEach((p, i) => { if (w < p) { st += 2 * i; w = I.capacity; } st++; w -= p; if (i < 6) { T.at({ plants: A(I.plants, { i }), water: w }); T.n('Steps so far?', st, 'Round trip to the river costs 2·i.'); } }); return st; }
  });

  D('execution-of-all-suffix-instructions-staying-in-a-grid', {
    t: 'Execution of All Suffix Instructions Staying in a Grid',
    r: 'For each starting index i, replay s[i..] from startPos and count moves until the robot would leave the grid.',
    g: R => { const n = R.int(1, 3); return { n, startPos: [R.int(0, n - 1), R.int(0, n - 1)], s: R.str(R.int(1, 6), 'LRUD') }; },
    s(I, T) { const mv = { L: [0, -1], R: [0, 1], U: [-1, 0], D: [1, 0] }; return [...I.s].map((_, i) => { let [r, c] = I.startPos, k = 0; for (let j = i; j < I.s.length; j++) { r += mv[I.s[j]][0]; c += mv[I.s[j]][1]; if (r < 0 || c < 0 || r >= I.n || c >= I.n) break; k++; } if (i < 5) { T.at({ s: A([...I.s], { i }) }); T.n('Moves executed from here?', k, 'Stop before leaving the grid.'); } return k; }); }
  });

  D('divide-a-string-into-groups-of-size-k', {
    t: 'Divide a String Into Groups of Size k',
    r: 'Cut s into chunks of k; pad the last chunk with the fill character.',
    g: R => ({ s: R.str(R.int(1, 10), 'abcdef'), k: R.int(1, 4), fill: 'x' }),
    s(I, T) { const out = []; for (let i = 0; i < I.s.length; i += I.k) out.push(I.s.slice(i, i + I.k).padEnd(I.k, I.fill)); T.at({ s: I.s, k: I.k }); T.n('Number of groups?', out.length, '⌈n / k⌉.'); return out; }
  });

  D('keep-multiplying-found-values-by-two', {
    t: 'Keep Multiplying Found Values by Two',
    r: 'Put nums in a set; while original is in it, double original.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 16), original: R.pick([1, 2, 3, 4]) }),
    s(I, T) { const S = new Set(I.nums); let x = I.original; for (;;) { const hit = S.has(x); T.at({ nums: A(I.nums), original: x }); T.yn(`Is ${x} in nums?`, hit, 'If so, double it.'); if (!hit) return x; x *= 2; } }
  });

  D('count-artifacts-that-can-be-extracted', {
    t: 'Count Artifacts That Can Be Extracted',
    r: 'Mark dug cells in a set; an artifact is extractable if every cell of its rectangle is dug.',
    g: R => { const n = R.int(1, 4), used = new Set(), arts = []; for (let t = 0; t < 4; t++) { const r1 = R.int(0, n - 1), c1 = R.int(0, n - 1), r2 = R.int(r1, Math.min(n - 1, r1 + 1)), c2 = R.int(c1, Math.min(n - 1, c1 + 1)), cells = []; for (let r = r1; r <= r2; r++) for (let c = c1; c <= c2; c++) cells.push(r + ',' + c); if (cells.some(x => used.has(x))) continue; cells.forEach(x => used.add(x)); arts.push([r1, c1, r2, c2]); } const dig = [...new Set(Array.from({ length: R.int(1, n * n) }, () => R.int(0, n - 1) + ',' + R.int(0, n - 1)))].map(x => x.split(',').map(Number)); return { n, artifacts: arts, dig }; },
    s(I, T) { const S = new Set(I.dig.map(d => d.join(','))); let c = 0; I.artifacts.forEach(([r1, c1, r2, c2]) => { let ok = true; for (let r = r1; r <= r2; r++) for (let x = c1; x <= c2; x++) if (!S.has(r + ',' + x)) ok = false; if (ok) c++; T.at({ artifact: `(${r1},${c1})–(${r2},${c2})` }); T.yn('Fully dug?', ok, 'Every cell must be uncovered.'); }); return c; }
  });

  D('calculate-digit-sum-of-a-string', {
    t: 'Calculate Digit Sum of a String',
    r: 'While length > k: split into groups of k, replace each group by its digit sum (as a string), and concatenate.',
    g: R => ({ s: R.str(R.int(1, 12), '0123456789'), k: R.int(2, 4) }),
    s(I, T) { let s = I.s; while (s.length > I.k) { let t = ''; for (let i = 0; i < s.length; i += I.k) t += [...s.slice(i, i + I.k)].reduce((a, c) => a + +c, 0); T.at({ s }); T.c('Next string?', [...new Set([t, t.slice(0, -1) || '0'])], t, 'Digit sums of each k-group.'); s = t; } return s; }
  });

  D('min-max-game', {
    t: 'Min Max Game',
    r: 'While more than one element: newNums[i] = min of the pair for even i, max for odd i.',
    g: R => ({ nums: R.ints(2 ** R.int(0, 3), 1, 9) }),
    s(I, T) { let a = I.nums.slice(); while (a.length > 1) { const b = []; for (let i = 0; i < a.length / 2; i++) b.push(i % 2 ? Math.max(a[2 * i], a[2 * i + 1]) : Math.min(a[2 * i], a[2 * i + 1])); T.at({ nums: A(a) }); T.n('First element of the next round?', b[0], 'min of the first pair.'); a = b; } return a[0]; }
  });

  D('replace-elements-in-an-array', {
    t: 'Replace Elements in an Array',
    r: 'Map each value to its index. For [from, to], look up the index of from, overwrite it with to, and update the map.',
    g: R => { const nums = R.distinct(R.int(1, 5), 1, 9), cur = new Set(nums), ops = []; for (let i = 0; i < R.int(1, 4); i++) { const f = R.pick([...cur]); let t; do t = R.int(1, 12); while (cur.has(t)); cur.delete(f); cur.add(t); ops.push([f, t]); } return { nums, operations: ops }; },
    s(I, T) { const a = I.nums.slice(), pos = new Map(a.map((v, i) => [v, i])); I.operations.forEach(([f, t]) => { const i = pos.get(f); T.at({ nums: A(a.slice(), { i }) }); T.n(`Index holding ${f}?`, i, 'Hash map lookup.'); a[i] = t; pos.delete(f); pos.set(t, i); }); return a; }
  });

  D('calculate-amount-paid-in-taxes', {
    t: 'Calculate Amount Paid in Taxes',
    r: 'For each bracket, the taxed slice is min(income, upper) − previous upper (if positive), times its percent.',
    g: R => { let u = 0; return { brackets: Array.from({ length: R.int(1, 4) }, () => [u += R.int(1, 5), R.int(0, 10) * 10]), income: R.int(0, 12) }; },
    cmp: 'float',
    s(I, T) { let prev = 0, tax = 0; for (const [u, p] of I.brackets) { const slice = Math.max(0, Math.min(I.income, u) - prev); tax += slice * p / 100; T.at({ bracket: `up to ${u} @ ${p}%` }); T.n('Income taxed in this bracket?', slice, 'min(income, upper) − previous upper.'); prev = u; if (I.income <= u) break; } return tax; }
  });

  D('task-scheduler-ii', {
    t: 'Task Scheduler II',
    r: 'Track the last day each task type ran. Each task runs on max(day + 1, last + space + 1).',
    g: R => ({ tasks: R.ints(R.int(1, 6), 1, 3), space: R.int(0, 3) }),
    s(I, T) { const last = {}; let d = 0; I.tasks.forEach((t, i) => { d = last[t] !== undefined ? Math.max(d + 1, last[t] + I.space + 1) : d + 1; last[t] = d; if (i < 6) { T.at({ tasks: A(I.tasks, { i }), lastRun: K({ ...last }) }); T.n('Day this task runs?', d, 'Next day, or after the cooldown.'); } }); return d; }
  });

  D('separate-the-digits-in-an-array', {
    t: 'Separate the Digits in an Array',
    r: 'Append the digits of each number in order.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 999) }),
    s(I, T) { const out = []; I.nums.forEach((x, i) => { const d = [...String(x)].map(Number); out.push(...d); if (i < 4) { T.at({ nums: A(I.nums, { i }) }); T.n('Digits contributed?', d.length, 'One per digit.'); } }); return out; }
  });

  D('determine-the-winner-of-a-bowling-game', {
    t: 'Determine the Winner of a Bowling Game',
    r: 'A turn counts double if either of the previous two turns hit 10 pins. Compare totals: 1, 2, or 0 for a tie.',
    g: R => { const n = R.int(1, 5); return { player1: R.ints(n, 0, 10), player2: R.ints(n, 0, 10) }; },
    s(I, T) { const score = (p, who) => p.reduce((s, x, i) => { const dbl = p[i - 1] === 10 || p[i - 2] === 10; if (i < 4 && who === 1) { T.at({ player1: A(p, { i }) }); T.yn('Does this turn count double?', dbl, 'A 10 in either of the previous two turns.'); } return s + (dbl ? 2 : 1) * x; }, 0); const a = score(I.player1, 1), b = score(I.player2, 2); return a > b ? 1 : b > a ? 2 : 0; }
  });

  D('find-the-losers-of-the-circular-game', {
    t: 'Find the Losers of the Circular Game',
    r: 'Pass the ball i·k steps on turn i; stop when someone receives it a second time. Everyone who never received it loses.',
    g: R => ({ n: R.int(1, 8), k: R.int(1, 8) }),
    s(I, T) { const got = new Set([0]); let cur = 0; for (let i = 1; ; i++) { cur = (cur + i * I.k) % I.n; T.at({ turn: i, holders: A([...got].map(x => x + 1)) }); T.n('Friend who receives the ball?', cur + 1, `Move ${i}·k steps.`); if (got.has(cur)) break; got.add(cur); } return Array.from({ length: I.n }, (_, i) => i + 1).filter(x => !got.has(x - 1)); }
  });

  D('semi-ordered-permutation', {
    t: 'Semi-Ordered Permutation',
    r: 'Move 1 to the front (its index swaps) and n to the end (n − 1 − its index swaps); subtract 1 if 1 starts to the right of n, since they cross once.',
    g: R => ({ nums: R.perm(R.int(2, 7)).map(x => x + 1) }),
    s(I, T) { const n = I.nums.length, a = I.nums.indexOf(1), b = I.nums.indexOf(n); T.at({ nums: A(I.nums, { i: a, j: b }) }); T.n('Swaps to move 1 to the front?', a, 'Its index.'); T.n(`Swaps to move ${n} to the end?`, n - 1 - b, 'Distance to the end.'); return a + n - 1 - b - (a > b ? 1 : 0); }
  });

  D('relocate-marbles', {
    t: 'Relocate Marbles',
    r: 'Keep the set of occupied positions; each move removes moveFrom[i] and adds moveTo[i]. Return the sorted set.',
    g: R => { const nums = R.ints(R.int(1, 5), 1, 9), occ = new Set(nums), mf = [], mt = []; for (let i = 0; i < R.int(1, 4); i++) { const f = R.pick([...occ]), t = R.int(1, 9); occ.delete(f); occ.add(t); mf.push(f); mt.push(t); } return { nums, moveFrom: mf, moveTo: mt }; },
    s(I, T) { const S = new Set(I.nums); I.moveFrom.forEach((f, i) => { S.delete(f); S.add(I.moveTo[i]); T.at({ move: `${f} → ${I.moveTo[i]}` }); T.n('Occupied positions now?', S.size, 'All marbles at f move together.'); }); return [...S].sort((a, b) => a - b); }
  });

  D('faulty-keyboard', {
    t: 'Faulty Keyboard',
    r: 'Build the string; typing "i" reverses it instead of appending.',
    g: R => ({ s: R.pick(['s', 'p', 'a']) + R.str(R.int(0, 7), 'abiti') }),
    s(I, T) { let t = ''; [...I.s].forEach((c, k) => { t = c === 'i' ? [...t].reverse().join('') : t + c; if (k < 7) { T.at({ typed: A([...I.s], { i: k }) }); T.c('Screen now?', [...new Set([t, [...t].reverse().join(''), t + 'i'])], t, '"i" reverses.'); } }); return t; }
  });

  D('last-visited-integers', {
    t: 'Last Visited Integers',
    r: 'Keep seen positives newest-first. For a run of k consecutive −1s, the k-th one reads seen[k − 1] (or −1 if too few).',
    g: R => ({ nums: [R.int(1, 9), ...Array.from({ length: R.int(0, 6) }, () => R.chance(0.5) ? -1 : R.int(1, 9))] }),
    s(I, T) { const seen = [], out = []; let k = 0; I.nums.forEach((x, i) => { if (x > 0) { seen.unshift(x); k = 0; } else { k++; const v = k <= seen.length ? seen[k - 1] : -1; out.push(v); T.at({ nums: A(I.nums, { i }), seen: A(seen.slice()) }); T.n('Last visited integer?', v, `${k}-th most recent.`); } }); return out; }
  });

  D('count-tested-devices-after-test-operations', {
    t: 'Count Tested Devices After Test Operations',
    r: 'Each tested device lowers all later batteries by 1, so device i is tested iff battery[i] − (devices tested so far) > 0.',
    g: R => ({ batteryPercentages: R.ints(R.int(1, 7), 0, 4) }),
    s(I, T) { let c = 0; I.batteryPercentages.forEach((b, i) => { const ok = b - c > 0; if (ok) c++; if (i < 6) { T.at({ battery: A(I.batteryPercentages, { i }) }); T.yn('Is this device tested?', ok, `Effective battery ${b} − ${ok ? c - 1 : c}.`); } }); return c; }
  });

  D('maximum-number-of-operations-with-the-same-score-i', {
    t: 'Maximum Number of Operations With the Same Score I',
    r: 'The first pair fixes the score. Keep taking the next pair while its sum matches.',
    g: R => ({ nums: R.ints(R.int(2, 8), 1, 4) }),
    s(I, T) { const s = I.nums[0] + I.nums[1]; let c = 0; for (let i = 0; i + 1 < I.nums.length; i += 2) { const ok = I.nums[i] + I.nums[i + 1] === s; T.at({ nums: A(I.nums, { i, j: i + 1 }), score: s }); T.yn('Does this pair match the score?', ok, 'Stop at the first mismatch.'); if (!ok) break; c++; } return c; }
  });

  D('distribute-elements-into-two-arrays-i', {
    t: 'Distribute Elements Into Two Arrays I',
    r: 'arr1 gets nums[1], arr2 gets nums[2]. Each later element goes to arr1 if arr1\'s last > arr2\'s last, else arr2. Return arr1 + arr2.',
    g: R => ({ nums: R.distinct(R.int(3, 7), 1, 20) }),
    s(I, T) { const a = [I.nums[0]], b = [I.nums[1]]; I.nums.slice(2).forEach((x, i) => { const to1 = a[a.length - 1] > b[b.length - 1]; (to1 ? a : b).push(x); if (i < 5) { T.at({ arr1: A(a.slice()), arr2: A(b.slice()) }); T.c(`Where did ${x} go?`, ['arr1', 'arr2'], to1 ? 'arr1' : 'arr2', 'Compare the last elements.'); } }); return [...a, ...b]; }
  });

  D('find-the-number-of-distinct-colors-among-the-balls', {
    t: 'Find the Number of Distinct Colors Among the Balls',
    r: 'Map ball → color and color → count. Recoloring decrements the old color (dropping it at 0) and increments the new one; the answer is the number of colors with positive count.',
    g: R => ({ limit: 4, queries: Array.from({ length: R.int(1, 6) }, () => [R.int(0, 4), R.int(1, 4)]) }),
    s(I, T) { const ball = new Map(), cnt = new Map(); return I.queries.map(([x, y], i) => { if (ball.has(x)) { const o = ball.get(x); cnt.set(o, cnt.get(o) - 1); if (!cnt.get(o)) cnt.delete(o); } ball.set(x, y); cnt.set(y, (cnt.get(y) || 0) + 1); if (i < 6) { T.at({ query: `ball ${x} → color ${y}`, colors: K(Object.fromEntries(cnt)) }); T.n('Distinct colors now?', cnt.size, 'Colors with a positive count.'); } return cnt.size; }); }
  });

  D('minimum-number-of-chairs-in-a-waiting-room', {
    t: 'Minimum Number of Chairs in a Waiting Room',
    r: 'Track occupancy: E adds 1, L removes 1. The answer is the maximum occupancy.',
    g: R => { let c = 0, s = ''; for (let i = 0; i < R.int(1, 9); i++) { if (c && R.chance(0.4)) { s += 'L'; c--; } else { s += 'E'; c++; } } return { s }; },
    s(I, T) { let c = 0, m = 0; [...I.s].forEach((ch, i) => { c += ch === 'E' ? 1 : -1; m = Math.max(m, c); if (i < 7) { T.at({ s: A([...I.s], { i }) }); T.n('People in the room?', c, 'E enters, L leaves.'); } }); return m; }
  });

  D('find-the-first-player-to-win-k-games-in-a-row', {
    t: 'Find the First Player to Win K Games in a Row',
    r: 'Keep the current winner and its streak while scanning players in order. If the streak reaches k, done; otherwise the strongest player eventually wins forever.',
    g: R => ({ skills: R.distinct(R.int(2, 7), 1, 20), k: R.int(1, 8) }),
    s(I, T) { let cur = 0, w = 0; for (let i = 1; i < I.skills.length; i++) { if (I.skills[i] > I.skills[cur]) { cur = i; w = 1; } else w++; if (i < 6) { T.at({ skills: A(I.skills, { i: cur, j: i }) }); T.n('Current streak?', w, 'Reset when a stronger player arrives.'); } if (w === I.k) return cur; } return cur; }
  });

  D('alt-and-tab-simulation', {
    t: 'Alt and Tab Simulation',
    r: 'The last query ends on top, then earlier queries in reverse order (skipping repeats), then untouched windows in their original order.',
    g: R => { const n = R.int(1, 5), w = R.perm(n).map(x => x + 1); return { windows: w, queries: R.ints(R.int(1, 4), 1, n) }; },
    s(I, T) { const seen = new Set(), out = []; for (let i = I.queries.length - 1; i >= 0; i--) { const q = I.queries[i]; const fresh = !seen.has(q); if (fresh) { seen.add(q); out.push(q); } T.at({ queries: A(I.queries, { i }), order: A(out.slice()) }); T.yn('New window for the top of the list?', fresh, 'Later queries already placed it higher.'); } I.windows.forEach(w => { if (!seen.has(w)) out.push(w); }); return out; }
  });

  D('snake-in-matrix', {
    t: 'Snake in Matrix',
    r: 'Track (row, col): UP/DOWN change the row, LEFT/RIGHT the column. The final cell is row · n + col.',
    g: R => { const n = R.int(2, 4); let r = 0, c = 0; const cmd = []; for (let i = 0; i < R.int(1, 6); i++) { const ok = []; if (r > 0) ok.push('UP'); if (r < n - 1) ok.push('DOWN'); if (c > 0) ok.push('LEFT'); if (c < n - 1) ok.push('RIGHT'); const m = R.pick(ok); cmd.push(m); if (m === 'UP') r--; else if (m === 'DOWN') r++; else if (m === 'LEFT') c--; else c++; } return { n, commands: cmd }; },
    s(I, T) { let r = 0, c = 0; I.commands.forEach((m, i) => { if (m === 'UP') r--; else if (m === 'DOWN') r++; else if (m === 'LEFT') c--; else c++; if (i < 6) { T.at({ commands: A(I.commands, { i }) }); T.n('Cell number now?', r * I.n + c, 'row · n + col.'); } }); return r * I.n + c; }
  });

  D('hash-divided-string', {
    t: 'Hash Divided String',
    r: 'Split s into chunks of k; for each, sum the letters\' alphabet indices (a = 0), take mod 26, and append that letter.',
    g: R => { const k = R.int(1, 3); return { s: R.str(k * R.int(1, 4), 'abcmxz'), k }; },
    s(I, T) { let out = ''; for (let i = 0; i < I.s.length; i += I.k) { const v = [...I.s.slice(i, i + I.k)].reduce((a, c) => a + c.charCodeAt(0) - 97, 0) % 26; out += String.fromCharCode(97 + v); if (i / I.k < 4) { T.at({ chunk: I.s.slice(i, i + I.k) }); T.n('Hashed value (0–25)?', v, 'Sum of indices mod 26.'); } } return out; }
  });

  D('find-the-sequence-of-strings-appeared-on-the-screen', {
    t: 'Find the Sequence of Strings Appeared on the Screen',
    r: 'For each target letter: append "a", then press the cycle key until it becomes the target letter, recording every screen state.',
    g: R => ({ target: R.str(R.int(1, 3), 'abcde') }),
    s(I, T) { const out = []; let cur = ''; for (const ch of I.target) { for (let c = 97; c <= ch.charCodeAt(0); c++) out.push(cur + String.fromCharCode(c)); cur += ch; T.at({ screen: cur }); T.n('States recorded so far?', out.length, 'One per key press.'); } return out; }
  });

  D('transformed-array', {
    t: 'Transformed Array',
    r: 'result[i] = nums[(i + nums[i]) mod n], using a non-negative modulo for negative moves.',
    g: R => ({ nums: R.ints(R.int(1, 6), -5, 5) }),
    s(I, T) { const n = I.nums.length; return I.nums.map((v, i) => { const j = ((i + v) % n + n) % n; if (i < 5) { T.at({ nums: A(I.nums, { i, j }) }); T.n('Index landed on?', j, `(${i} + ${v}) mod ${n}.`); } return I.nums[j]; }); }
  });

  D('fruits-into-baskets-ii', {
    t: 'Fruits Into Baskets II',
    r: 'Place each fruit type in the leftmost unused basket with capacity ≥ its quantity; count fruits that fit nowhere.',
    g: R => { const n = R.int(1, 5); return { fruits: R.ints(n, 1, 8), baskets: R.ints(n, 1, 8) }; },
    s(I, T) { const used = I.baskets.map(() => false); let c = 0; I.fruits.forEach((f, i) => { const j = I.baskets.findIndex((b, k) => !used[k] && b >= f); if (j < 0) c++; else used[j] = true; if (i < 5) { T.at({ fruit: f, baskets: A(I.baskets, { i: j >= 0 ? j : undefined }) }); T.n('Basket index used (−1 if none)?', j, 'Leftmost free one that fits.'); } }); return c; }
  });
})();
