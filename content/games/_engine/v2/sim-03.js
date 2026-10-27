/* v2 games: sim (03). Guides scored in the 3483–4041 pass. */
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

  D('minimum-pair-removal-to-sort-array-ii', {
    t: 'Minimum Pair Removal to Sort Array II',
    r: 'Repeat until the array is non-decreasing: merge the adjacent pair with the smallest sum (leftmost on ties). The fast version keeps pairs in a heap and the array as a doubly linked list.',
    g: R => ({ nums: R.ints(R.int(3, 7), -3, 6) }),
    s(I, T) { const a = I.nums.slice(); let ops = 0; const sorted = () => a.every((v, i) => !i || v >= a[i - 1]); while (!sorted()) { let b = 0; for (let i = 1; i + 1 < a.length; i++) if (a[i] + a[i + 1] < a[b] + a[b + 1]) b = i; T.at({ nums: A(a.slice(), { win: [b, b + 1] }) }); T.n('Left index of the pair that merges next?', b, 'Smallest adjacent sum, leftmost on ties.'); a.splice(b, 2, a[b] + a[b + 1]); ops++; } T.at({ nums: A(a.slice()) }); T.n('Operations used?', ops, 'Count the merges.'); return ops; }
  });

  D('process-string-with-special-operations-i', {
    t: 'Process String with Special Operations I',
    r: 'Build the result left to right: a letter appends, * deletes the last character, # doubles the whole string, % reverses it.',
    g: R => ({ s: R.str(R.int(3, 7), 'ab*#%') }),
    s(I, T) { let r = ''; for (const c of I.s) { const prev = r; if (c === '*') r = r.slice(0, -1); else if (c === '#') r = r + r; else if (c === '%') r = r.split('').reverse().join(''); else r += c; if (/[*#%]/.test(c) && prev) { T.at({ s: A(I.s.split('')), op: c, before: JSON.stringify(prev) }); T.c(`Result after "${c}"?`, [r, prev + prev, prev.split('').reverse().join(''), prev.slice(0, -1)].map(x => JSON.stringify(x)), JSON.stringify(r), { '*': 'Remove the last character.', '#': 'Append a copy of itself.', '%': 'Reverse the string.' }[c]); } } return r; }
  });

  D('process-string-with-special-operations-ii', {
    t: 'Process String with Special Operations II',
    r: 'Never build the string. Track only its length forward, then walk backwards: undo # by folding k into the first half (k − len divided by 2), undo % by mirroring (len − 1 − k), and when a letter sits at position k, that letter is the answer.',
    g: R => ({ s: R.str(R.int(3, 7), 'abc*#%'), k: R.int(0, 6) }),
    s(I, T) { const L = [0]; for (const c of I.s) { const l = L[L.length - 1]; L.push(c === '*' ? Math.max(0, l - 1) : c === '#' ? 2 * l : c === '%' ? l : l + 1); } let k = I.k; const fin = L[L.length - 1]; T.at({ s: A(I.s.split('')), lengths: A(L.slice(1)) }); T.n('Length of the final result?', fin, 'Letters +1, * −1 (not below 0), # doubles, % keeps.'); if (k >= fin) return '.'; for (let i = I.s.length - 1; i >= 0; i--) { const c = I.s[i], len = L[i + 1]; if (c === '#') { const nk = k >= len / 2 ? k - len / 2 : k; T.at({ s: A(I.s.split(''), { i }), k, len }); T.n(`Undo "#" (length ${len}): new k?`, nk, 'The second half is a copy of the first.'); k = nk; } else if (c === '%') { T.at({ s: A(I.s.split(''), { i }), k, len }); T.n(`Undo "%" (length ${len}): new k?`, len - 1 - k, 'Reversal mirrors the position.'); k = len - 1 - k; } else if (c !== '*' && k === len - 1) return c; } return '.'; }
  });

  D('xor-after-range-multiplication-queries-i', {
    t: 'XOR After Range Multiplication Queries I',
    r: 'Simulate each query: start at l, multiply nums[idx] by v (mod 1e9+7), jump by k, stop past r. Then XOR everything.',
    g: R => { const n = R.int(2, 6); return { nums: R.ints(n, 1, 5), queries: Array.from({ length: R.int(1, 3) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1), R.int(1, 2), R.int(2, 3)]; }) }; },
    s(I, T) { const a = I.nums.slice(); I.queries.forEach(([l, r, k, v]) => { const hit = []; for (let i = l; i <= r; i += k) { a[i] = a[i] * v % MOD; hit.push(i); } T.at({ nums: A(a.slice(), { hl: hit }), query: `l=${l} r=${r} k=${k} v=${v}` }); T.n(`nums[${l}] after this query?`, a[l], `It is multiplied by ${v}.`); }); const x = a.reduce((p, q) => p ^ q, 0); T.at({ nums: A(a) }); T.n('XOR of all elements?', x, 'XOR them one by one.'); return x; }
  });

  D('library-late-fee-calculator', {
    t: 'Library Late Fee Calculator',
    r: 'Go book by book: 1 day costs 1, 2 to 5 days cost 2 per day, more than 5 days cost 3 per day. Add up the penalties.',
    g: R => ({ daysLate: R.ints(R.int(1, 5), 1, 9) }),
    s(I, T) { let tot = 0; I.daysLate.forEach((d, i) => { const p = d === 1 ? 1 : d <= 5 ? 2 * d : 3 * d; tot += p; T.at({ daysLate: A(I.daysLate, { i }), total: tot - p }); T.n(`Penalty for book ${i} (${d} days late)?`, p, d === 1 ? 'Exactly 1 day: 1.' : d <= 5 ? '2 to 5 days: 2 per day.' : 'Over 5 days: 3 per day.'); }); return tot; }
  });

  D('compute-alternating-sum', {
    t: 'Compute Alternating Sum',
    r: 'Add the elements at even indices and subtract the ones at odd indices, keeping a running total.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 9) }),
    s(I, T) { let s = 0; I.nums.forEach((x, i) => { s += i % 2 ? -x : x; T.at({ nums: A(I.nums, { i }) }); T.n(`Running alternating sum after index ${i}?`, s, i % 2 ? `Odd index: subtract ${x}.` : `Even index: add ${x}.`); }); return s; }
  });

  D('score-validator', {
    t: 'Score Validator',
    r: 'Process events in order: numbers add to the score, "WD" and "NB" add 1, "W" increments the counter. Stop as soon as the counter reaches 10.',
    g: R => ({ events: Array.from({ length: R.int(1, 8) }, () => R.pick(['0', '1', '4', '6', 'W', 'WD', 'NB'])) }),
    s(I, T) { let sc = 0, c = 0; for (let i = 0; i < I.events.length && c < 10; i++) { const e = I.events[i]; if (e === 'W') c++; else if (e === 'WD' || e === 'NB') sc++; else sc += +e; if (i < 7) { T.at({ events: A(I.events, { i }), counter: c }); T.n(`Score after event ${i} ("${e}")?`, sc, e === 'W' ? 'A wicket adds nothing.' : e.length === 2 ? 'Extras add 1.' : `Add ${e}.`); } } return [sc, c]; }
  });

  D('minimum-generations-to-target-point', {
    t: 'Minimum Generations to Target Point',
    r: 'Coordinates stay in 0 to 6, so there are at most 343 points. Simulate generations: from all points so far, form the floored midpoint of every distinct pair; stop when the target appears or a generation adds nothing new.',
    g: R => { const pts = new Set(); while (pts.size < R.int(2, 4)) pts.add([R.int(0, 6), R.int(0, 6), R.int(0, 6)].join(',')); return { points: [...pts].map(p => p.split(',').map(Number)), target: [R.int(0, 6), R.int(0, 6), R.int(0, 6)] }; },
    s(I, T) { const key = p => p.join(','), tk = key(I.target), have = new Set(I.points.map(key)); T.at({ points: A([...have].map(p => `(${p})`)), target: `(${tk})` }); T.yn('Is the target already present?', have.has(tk), have.has(tk) ? 'Generation 0.' : 'Start generating.'); if (have.has(tk)) return 0; for (let g = 1; ; g++) { const pts = [...have].map(p => p.split(',').map(Number)), nw = new Set(); for (let i = 0; i < pts.length; i++) for (let j = i + 1; j < pts.length; j++) { const c = key(pts[i].map((x, t) => Math.floor((x + pts[j][t]) / 2))); if (!have.has(c)) nw.add(c); } nw.forEach(p => have.add(p)); if (g <= 3) { T.at({ known: have.size, target: `(${tk})` }); T.n(`New points in generation ${g}?`, nw.size, 'Floored midpoints of every distinct pair.'); } if (have.has(tk)) return g; if (!nw.size) return -1; } }
  });

  D('elevator-requests-i', {
    t: 'Elevator Requests I',
    r: 'Serve requests in order from floor 0; each one costs the distance from the current floor to the requested floor.',
    g: R => { const n = R.int(2, 9); return { n, requests: R.ints(R.int(1, 6), 0, n - 1) }; },
    s(I, T) { let cur = 0, t = 0; I.requests.forEach((f, i) => { const d = Math.abs(f - cur); if (i < 6) { T.at({ requests: A(I.requests, { i }), floor: cur, time: t }); T.n(`Seconds to reach floor ${f}?`, d, `From floor ${cur}.`); } t += d; cur = f; }); return t; }
  });

  D('nearest-available-drone', {
    t: 'Nearest Available Drone',
    r: 'For each drone compute the Manhattan distance to the target; it qualifies if that is within its range. Keep the qualifying drone with the smallest distance, preferring the lower index on ties.',
    g: R => ({ drones: Array.from({ length: R.int(1, 4) }, () => [R.int(-5, 5), R.int(-5, 5), R.int(1, 8)]), target: [R.int(-5, 5), R.int(-5, 5)] }),
    s(I, T) { let best = -1, bd = Infinity; I.drones.forEach(([x, y, r], i) => { const d = Math.abs(x - I.target[0]) + Math.abs(y - I.target[1]); if (i < 4) { T.at({ drones: A(I.drones.map(q => `(${q[0]},${q[1]}) r${q[2]}`), { i }), target: `(${I.target})` }); T.yn(`Can drone ${i} reach the target?`, d <= r, `Distance ${d}, range ${r}.`); } if (d <= r && d < bd) { bd = d; best = i; } }); return best; }
  });
})();
