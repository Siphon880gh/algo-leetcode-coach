/* v2 games: heaps & priority queues (01). */
(function () {
  'use strict';
  const { D, A, G, K, Q } = LCGame.H;
  // Tiny priority queue (sorted insert is fine for game-sized inputs).
  const PQ = cmp => { const a = []; return { push(x) { let i = a.length; a.push(x); while (i > 0 && cmp(a[i - 1], x) > 0) { a[i] = a[i - 1]; i--; } a[i] = x; }, pop() { return a.shift(); }, peek() { return a[0]; }, get size() { return a.length; }, items() { return a.slice(); } }; };
  const cnt = s => { const c = {}; for (const x of s) c[x] = (c[x] || 0) + 1; return c; };
  const sameMultiset = (a, b) => JSON.stringify([...a].sort()) === JSON.stringify([...b].sort());

  D('the-skyline-problem', {
    t: 'The Skyline Problem',
    r: 'Sweep the x-coordinates of all edges. Keep a max-heap of active building heights (removing those that ended). Whenever the current max height changes, emit [x, height].',
    g: R => ({ buildings: Array.from({ length: R.int(1, 4) }, () => { const l = R.int(0, 8); return [l, l + R.int(1, 5), R.int(1, 9)]; }).sort((a, b) => a[0] - b[0]) }),
    s(I, T) { const xs = [...new Set(I.buildings.flatMap(b => [b[0], b[1]]))].sort((a, b) => a - b), out = []; let prev = 0; xs.forEach((x, i) => { const h = Math.max(0, ...I.buildings.filter(b => b[0] <= x && x < b[1]).map(b => b[2])); if (i < 6) { T.at({ x, active: A(I.buildings.filter(b => b[0] <= x && x < b[1]).map(b => b[2])) }); T.n('Max active height at this x?', h, 'Top of the max-heap after adding/removing.'); } if (h !== prev) { out.push([x, h]); prev = h; } }); return out; }
  });

  D('top-k-frequent-elements', {
    t: 'Top K Frequent Elements',
    r: 'Count frequencies, then keep a min-heap of size k keyed by frequency (or bucket by frequency); the heap ends with the k most frequent values.',
    g: R => { const v = R.distinct(R.int(1, 5), 1, 9), nums = []; v.forEach((x, i) => { for (let j = 0; j <= i; j++) nums.push(x); }); return { nums: R.shuffle(nums), k: R.int(1, v.length) }; },
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== I.k || new Set(o).size !== o.length) return false; const c = cnt(I.nums), lo = Math.min(...o.map(x => c[x] || 0)); return Object.keys(c).filter(x => !o.includes(+x)).every(x => c[x] <= lo) && o.every(x => c[x]); },
    s(I, T) { const res = (() => { const c = cnt(I.nums), h = PQ((a, b) => a[1] - b[1]); Object.entries(c).forEach(([v, f]) => { h.push([+v, f]); if (h.size > I.k) h.pop(); }); T.at({ freq: K(c), k: I.k }); T.n('Distinct values?', Object.keys(c).length, 'Each one is pushed once.'); T.n('Smallest frequency kept in the heap?', h.peek()[1], 'Min-heap of size k.'); return h.items().map(x => x[0]); })(); const c = cnt(I.nums); T.n('Largest frequency in the answer?', Math.max(...res.map(x => c[x])), 'The most frequent value is always kept.'); return res; }
  });

  D('rearrange-string-k-distance-apart', {
    t: 'Rearrange String k Distance Apart',
    r: 'Greedy with a max-heap by remaining count: take the most frequent available letter, then park it in a cooldown queue for k steps before it can return. If the heap empties early, it is impossible.',
    g: R => ({ s: R.str(R.int(1, 7), 'aabc'), k: R.int(0, 3) }),
    cmp: (o, e, I) => { if (e === '') return o === ''; if (typeof o !== 'string' || !sameMultiset(o, I.s)) return false; for (let i = 0; i < o.length; i++) for (let j = i + 1; j < Math.min(o.length, i + I.k); j++) if (o[i] === o[j]) return false; return true; },
    s(I, T) { if (I.k <= 1) { T.at({ k: I.k }); T.yn('Is any arrangement fine?', true, 'k ≤ 1 imposes no gap.'); return I.s; } const c = cnt(I.s), h = PQ((a, b) => b[1] - a[1] || (a[0] < b[0] ? -1 : 1)); Object.entries(c).forEach(e => h.push(e)); const wait = []; let out = ''; while (out.length < I.s.length) { if (!h.size) { T.at({ built: out }); T.yn('Is any letter available now?', false, 'All are cooling down → impossible.'); return ''; } const [ch, f] = h.pop(); out += ch; if (out.length <= 5) { T.at({ built: out, cooling: Q(wait.map(w => w[0])) }); T.n('Letters placed?', out.length, `Use "${ch}", the most frequent available.`); } wait.push([ch, f - 1]); if (wait.length >= I.k) { const [c2, f2] = wait.shift(); if (f2) h.push([c2, f2]); } } return out; }
  });

  D('trapping-rain-water-ii', {
    t: 'Trapping Rain Water II',
    r: 'Push all border cells into a min-heap. Repeatedly pop the lowest wall, visit its unvisited neighbors: water there = max(0, wall − height); push the neighbor with height max(wall, height).',
    g: R => ({ heightMap: R.grid(R.int(3, 4), R.int(3, 4), 0, 5) }),
    s(I, T) { const g = I.heightMap, m = g.length, n = g[0].length, vis = g.map(r => r.map(() => false)), h = PQ((a, b) => a[0] - b[0]); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) if (!i || !j || i === m - 1 || j === n - 1) { vis[i][j] = true; h.push([g[i][j], i, j]); } let w = 0, asks = 0; while (h.size) { const [ht, i, j] = h.pop(); for (const [a, b] of [[i + 1, j], [i - 1, j], [i, j + 1], [i, j - 1]]) if (a >= 0 && b >= 0 && a < m && b < n && !vis[a][b]) { vis[a][b] = true; const add = Math.max(0, ht - g[a][b]); w += add; if (asks++ < 4) { T.at({ heights: G(g, { hl: [[a, b]] }), wall: ht }); T.n('Water trapped at this cell?', add, 'wall − height, if positive.'); } h.push([Math.max(ht, g[a][b]), a, b]); } } return w; }
  });

  D('strong-password-checker', {
    t: 'Strong Password Checker',
    r: 'Count missing types (lower/upper/digit) and runs of ≥ 3. Short: max(6 − n, missing). Medium: max(missing, Σ⌊run/3⌋). Long: spend n − 20 deletions first on runs with len % 3 == 0, then % 3 == 1 (2 each), then 3 per replacement; answer = deletions + max(missing, replacements left).',
    g: R => ({ password: R.str(R.int(1, 24), 'aaB1.') }),
    s(I, T) { const res = (() => { const p = I.password, n = p.length, missing = (/[a-z]/.test(p) ? 0 : 1) + (/[A-Z]/.test(p) ? 0 : 1) + (/\d/.test(p) ? 0 : 1); let rep = 0, one = 0, two = 0; for (let i = 0; i < n;) { let j = i; while (j < n && p[j] === p[i]) j++; const L = j - i; if (L >= 3) { rep += Math.floor(L / 3); if (L % 3 === 0) one++; else if (L % 3 === 1) two++; } i = j; } T.at({ password: p, length: n }); T.yn('Is the length between 6 and 20?', n >= 6 && n <= 20, 'Otherwise insert or delete characters.'); T.n('Missing character types?', missing, 'Lowercase, uppercase, digit.'); if (n < 6) return Math.max(6 - n, missing); T.n('Replacements needed to break runs?', rep, 'A run of length L needs L divided by 3, rounded down.'); if (n <= 20) return Math.max(missing, rep); const d = n - 20; rep -= Math.min(d, one); rep -= Math.floor(Math.min(Math.max(d - one, 0), two * 2) / 2); rep -= Math.floor(Math.max(d - one - 2 * two, 0) / 3); return d + Math.max(missing, rep); })(); T.n('Minimum steps?', res, 'Combine length fixes, missing types and run breaks.'); return res; }
  });

  D('ipo', {
    t: 'IPO',
    r: 'Sort projects by capital. Each round, push every affordable project\'s profit into a max-heap, then take the top profit. Stop after k projects or when nothing is affordable.',
    g: R => { const n = R.int(1, 5); return { k: R.int(1, 3), w: R.int(0, 3), profits: R.ints(n, 1, 6), capital: R.ints(n, 0, 6) }; },
    s(I, T) { const pr = I.capital.map((c, i) => [c, I.profits[i]]).sort((a, b) => a[0] - b[0]), h = PQ((a, b) => b - a); let w = I.w, i = 0; T.at({ capital: A(I.capital), profits: A(I.profits), w: I.w }); T.n('Projects affordable right away?', I.capital.filter(c => c <= I.w).length, 'Capital at most w.'); for (let r = 0; r < I.k; r++) { while (i < pr.length && pr[i][0] <= w) h.push(pr[i++][1]); if (!h.size) break; const p = h.pop(); w += p; T.at({ capital: w - p, available: A(h.items().concat([p]).sort((a, b) => b - a)) }); T.n('Capital after this project?', w, `Take the best profit ${p}.`); } return w; }
  });

  D('relative-ranks', {
    t: 'Relative Ranks',
    r: 'Sort indices by score descending (a max-heap works too). Places 1–3 get medals, the rest get their place number.',
    g: R => ({ score: R.distinct(R.int(1, 6), 1, 30) }),
    s(I, T) { const idx = I.score.map((_, i) => i).sort((a, b) => I.score[b] - I.score[a]), out = []; idx.forEach((i, p) => { out[i] = p === 0 ? 'Gold Medal' : p === 1 ? 'Silver Medal' : p === 2 ? 'Bronze Medal' : String(p + 1); }); I.score.slice(0, 4).forEach((s, i) => { T.at({ score: A(I.score, { i }) }); T.n(`Place of athlete ${i}?`, idx.indexOf(i) + 1, 'Rank by score.'); }); return out; }
  });

  D('task-scheduler', {
    t: 'Task Scheduler',
    r: 'Let f be the max frequency and c the number of tasks with it. The schedule needs at least (f − 1)(n + 1) + c slots, and never fewer than the number of tasks.',
    g: R => ({ tasks: [...R.str(R.int(1, 9), 'AABC')], n: R.int(0, 3) }),
    s(I, T) { const res = (() => { const c = cnt(I.tasks), f = Math.max(...Object.values(c)), top = Object.values(c).filter(v => v === f).length; T.at({ counts: K(c), n: I.n }); T.n('Maximum frequency?', f, 'The busiest task sets the frame.'); T.n('Tasks sharing that frequency?', top, 'They fill the last row.'); return Math.max(I.tasks.length, (f - 1) * (I.n + 1) + top); })(); T.n('Fewest time units?', res, 'Frame size or the task count, whichever is larger.'); return res; }
  });

  D('course-schedule-iii', {
    t: 'Course Schedule III',
    r: 'Sort by deadline. Take each course, pushing its duration into a max-heap; if total time exceeds the deadline, drop the longest course taken so far.',
    g: R => ({ courses: Array.from({ length: R.int(1, 6) }, () => [R.int(1, 5), R.int(1, 12)]) }),
    s(I, T) { const cs = I.courses.slice().sort((a, b) => a[1] - b[1]), h = PQ((a, b) => b - a); let t = 0; cs.forEach(([d, e], i) => { h.push(d); t += d; if (t > e) t -= h.pop(); if (i < 6) { T.at({ course: `${d} by ${e}`, taken: A(h.items()) }); T.n('Courses taken so far?', h.size, 'Drop the longest when late.'); } }); return h.size; }
  });

  D('split-array-into-consecutive-subsequences', {
    t: 'Split Array into Consecutive Subsequences',
    r: 'Greedy with counts and "ends": for each x, extend a subsequence ending at x − 1 if possible; otherwise start x, x+1, x+2 (fail if missing). (A heap per end value also works.)',
    g: R => ({ nums: R.sorted(R.int(1, 9), 1, 6) }),
    s(I, T) { const res = (() => { const c = cnt(I.nums), end = {}; for (const [i, x] of I.nums.entries()) { if (!c[x]) continue; c[x]--; let how; if (end[x - 1]) { end[x - 1]--; end[x] = (end[x] || 0) + 1; how = 'extend'; } else if (c[x + 1] && c[x + 2]) { c[x + 1]--; c[x + 2]--; end[x + 2] = (end[x + 2] || 0) + 1; how = 'start'; } else how = 'fail'; if (i < 7) { T.at({ nums: A(I.nums, { i }), endsAt: K({ ...end }) }); T.c(`What happens with ${x}?`, ['extend', 'start', 'fail'], how, 'Prefer extending an existing run.'); } if (how === 'fail') return false; } return true; })(); T.yn('Can the array be split?', res, 'Every value found a place.'); return res; }
  });

  D('top-k-frequent-words', {
    t: 'Top K Frequent Words',
    r: 'Count words; order by frequency descending, then lexicographically (a heap of size k with the reverse order works).',
    g: R => { const w = Array.from({ length: R.int(1, 8) }, () => R.pick(['a', 'b', 'cat', 'dog', 'b'])); return { words: w, k: R.int(1, new Set(w).size) }; },
    s(I, T) { const res = (() => { const c = cnt(I.words); T.at({ counts: K(c) }); T.n('Distinct words?', Object.keys(c).length, 'Candidates.'); T.n('Highest count?', Math.max(...Object.values(c)), 'The heap keeps the most frequent words.'); return Object.keys(c).sort((a, b) => c[b] - c[a] || (a < b ? -1 : 1)).slice(0, I.k); })(); T.c('Most frequent word?', Object.keys(cnt(I.words)), res[0], 'Ties go to the alphabetically smaller word.'); return res; }
  });

  D('employee-free-time', {
    t: 'Employee Free Time',
    r: 'Merge all intervals in start order (a heap over each employee\'s next interval). Every gap between the current merged end and the next start is common free time.',
    g: R => ({ schedule: Array.from({ length: R.int(1, 3) }, () => { const out = []; let t = R.int(0, 3); for (let i = 0; i < R.int(1, 3); i++) { const s = t + R.int(0, 2), e = s + R.int(1, 3); out.push([s, e]); t = e + 1; } return out; }) }),
    s(I, T) { const res = (() => { const all = I.schedule.flat().sort((a, b) => a[0] - b[0]), out = []; let end = all[0][1]; T.at({ intervals: A(all.map(x => x.join(' to '))) }); T.n('Working intervals in total?', all.length, 'Merge all employees together.'); for (let i = 1; i < all.length; i++) { const [s, e] = all[i]; if (s > end) { out.push([end, s]); T.at({ mergedEnd: end, next: `[${s}, ${e}]` }); T.n('Length of this free gap?', s - end, 'Next start minus merged end.'); } end = Math.max(end, e); } if (!out.length) { T.at({ intervals: A(all.map(x => x.join(' to '))) }); T.yn('Is there any free time?', false, 'Everything overlaps.'); } return out; })(); T.n('Free gaps?', res.length, 'One for each break between merged intervals.'); return res; }
  });

  D('reorganize-string', {
    t: 'Reorganize String',
    r: 'If some letter appears more than ⌈n/2⌉ times it is impossible. Otherwise repeatedly pop the two most frequent letters from a max-heap, append both, and push them back with decremented counts.',
    g: R => ({ s: R.str(R.int(1, 7), 'aabc') }),
    cmp: (o, e, I) => e === '' ? o === '' : typeof o === 'string' && sameMultiset(o, I.s) && [...o].every((ch, i) => !i || o[i - 1] !== ch),
    s(I, T) { const res = (() => { const c = cnt(I.s), mx = Math.max(...Object.values(c)); T.at({ counts: K(c) }); T.n('Highest letter count?', mx, 'The hardest letter to spread out.'); T.yn('Is that more than half of n, rounded up?', mx > Math.ceil(I.s.length / 2), 'Then no arrangement works.'); if (mx > Math.ceil(I.s.length / 2)) return ''; const h = PQ((a, b) => b[1] - a[1] || (a[0] < b[0] ? -1 : 1)); Object.entries(c).forEach(e => h.push(e)); let out = ''; while (h.size >= 2) { const a = h.pop(), b = h.pop(); out += a[0] + b[0]; if (--a[1]) h.push(a); if (--b[1]) h.push(b); } if (h.size) out += h.pop()[0]; return out; })(); T.n('Length of the answer? (0 if impossible)', res.length, 'All letters, or the empty string.'); return res; }
  });

  D('minimum-cost-to-hire-k-workers', {
    t: 'Minimum Cost to Hire K Workers',
    r: 'Sort workers by wage/quality ratio. The highest ratio in the group sets the pay rate, so scan in ratio order keeping a max-heap of the k smallest qualities; cost = ratio × quality sum.',
    g: R => { const n = R.int(1, 5); return { quality: R.ints(n, 1, 10), wage: R.ints(n, 5, 40), k: R.int(1, n) }; },
    cmp: 'float',
    s(I, T) { const w = I.quality.map((q, i) => [I.wage[i] / q, q]).sort((a, b) => a[0] - b[0]), h = PQ((a, b) => b - a); let sum = 0, best = Infinity; w.forEach(([r, q], i) => { h.push(q); sum += q; if (h.size > I.k) sum -= h.pop(); if (h.size === I.k) { best = Math.min(best, r * sum); if (i < 5) { T.at({ ratio: +r.toFixed(3), qualities: A(h.items()) }); T.n('Quality sum of the cheapest k so far?', sum, 'Drop the largest quality.'); } } }); return best; }
  });

  D('last-stone-weight', {
    t: 'Last Stone Weight',
    r: 'Max-heap: smash the two heaviest; if they differ, push back the difference. The last stone (or 0) remains.',
    g: R => ({ stones: R.ints(R.int(1, 6), 1, 10) }),
    s(I, T) { const h = PQ((a, b) => b - a); I.stones.forEach(x => h.push(x)); let k = 0; while (h.size > 1) { const a = h.pop(), b = h.pop(); if (a !== b) h.push(a - b); if (k++ < 5) { T.at({ smash: `${a} vs ${b}`, heap: A(h.items()) }); T.n('Stones left?', h.size, 'Equal stones both vanish.'); } } return h.size ? h.pop() : 0; }
  });

  D('high-five', {
    t: 'High Five',
    r: 'For each student keep a min-heap of size 5 of their scores; the average of the heap (integer division) is their high-five. Output sorted by id.',
    g: R => ({ items: [1, 2].flatMap(id => Array.from({ length: 5 + R.int(0, 2) }, () => [id, R.int(50, 100)])) }),
    s(I, T) { const m = {}; I.items.forEach(([id, s]) => (m[id] = m[id] || []).push(s)); T.at({ items: A(I.items.map(x => x.join(', '))) }); T.n('How many students?', Object.keys(m).length, 'Group scores by id.'); return Object.keys(m).map(Number).sort((a, b) => a - b).map(id => { const top = m[id].sort((a, b) => b - a).slice(0, 5), v = Math.floor(top.reduce((a, b) => a + b, 0) / 5); T.at({ student: id, top5: A(top) }); T.n('High-five average?', v, 'Integer division of the top-5 sum.'); return [id, v]; }); }
  });

  D('minimum-cost-to-connect-sticks', {
    t: 'Minimum Cost to Connect Sticks',
    r: 'Huffman-style: always join the two shortest sticks (min-heap); add the joined length to the cost and push it back.',
    g: R => ({ sticks: R.ints(R.int(1, 6), 1, 9) }),
    s(I, T) { const h = PQ((a, b) => a - b); I.sticks.forEach(x => h.push(x)); let c = 0; while (h.size > 1) { const s = h.pop() + h.pop(); c += s; h.push(s); T.at({ heap: A(h.items()) }); T.n('Cost so far?', c, 'Join the two shortest.'); } if (I.sticks.length === 1) { T.at({ sticks: A(I.sticks) }); T.n('Cost?', 0, 'Nothing to join.'); } return c; }
  });

  D('minimum-time-to-build-blocks', {
    t: 'Minimum Time to Build Blocks',
    r: 'Think backwards (Huffman): pop the two smallest blocks a ≤ b and push split + b (one worker splits, then both build). The last value is the answer.',
    g: R => ({ blocks: R.ints(R.int(1, 5), 1, 9), split: R.int(1, 4) }),
    s(I, T) { const h = PQ((a, b) => a - b); I.blocks.forEach(x => h.push(x)); while (h.size > 1) { h.pop(); const b = h.pop(); h.push(I.split + b); T.at({ heap: A(h.items()) }); T.n('Value pushed back?', I.split + b, 'split + the larger of the two.'); } if (I.blocks.length === 1) { T.at({ blocks: A(I.blocks) }); T.n('Time?', I.blocks[0], 'One worker builds it.'); } return h.pop(); }
  });

  D('maximum-number-of-events-that-can-be-attended', {
    t: 'Maximum Number of Events That Can Be Attended',
    r: 'Sweep days in order. Add events starting today to a min-heap of end days, drop expired ones, and attend the event ending soonest.',
    g: R => ({ events: Array.from({ length: R.int(1, 6) }, () => { const s = R.int(1, 6); return [s, s + R.int(0, 2)]; }) }),
    s(I, T) { const ev = I.events.slice().sort((a, b) => a[0] - b[0]), h = PQ((a, b) => a - b); let i = 0, c = 0; for (let d = 1; d <= 10; d++) { while (i < ev.length && ev[i][0] === d) h.push(ev[i++][1]); while (h.size && h.peek() < d) h.pop(); if (h.size) { h.pop(); c++; if (c <= 5) { T.at({ day: d, waitingEnds: A(h.items()) }); T.n('Events attended so far?', c, 'Attend the one ending soonest.'); } } } return c; }
  });

  D('construct-target-array-with-multiple-sums', {
    t: 'Construct Target Array With Multiple Sums',
    r: 'Work backwards with a max-heap: the largest value x was last set to the sum of the array, so its previous value is x mod (rest sum). Fail if rest ≥ x or the value hits 0 (unless rest is 1).',
    g: R => { if (R.chance(0.6)) { const a = Array(R.int(1, 4)).fill(1); for (let s = 0; s < R.int(1, 4); s++) { const i = R.int(0, a.length - 1); a[i] = a.reduce((x, y) => x + y, 0); } return { target: a }; } return { target: R.ints(R.int(1, 4), 1, 12) }; },
    s(I, T) { const res = (() => { const a = I.target.slice(); let sum = a.reduce((x, y) => x + y, 0), k = 0; T.at({ target: A(a) }); T.n('Sum of the target?', sum, 'Work backwards from it.'); for (;;) { let mi = 0; a.forEach((v, i) => { if (v > a[mi]) mi = i; }); const x = a[mi], rest = sum - x; if (x === 1 || rest === 1) return true; if (rest === 0 || rest >= x || x % rest === 0) { T.at({ array: A(a, { i: mi }) }); T.yn('Can the largest value be undone?', false, 'Rest must be smaller and not divide it.'); return false; } a[mi] = x % rest; sum = rest + a[mi]; if (k++ < 4) { T.at({ array: A(a.slice(), { i: mi }) }); T.n('Previous value of the largest element?', a[mi], 'The remainder of x divided by the sum of the others.'); } } })(); T.yn('Can the target be built?', res, 'Undo until every value is 1.'); return res; }
  });

  D('maximum-performance-of-a-team', {
    t: 'Maximum Performance of a Team',
    r: 'Sort engineers by efficiency descending; each is the minimum efficiency of a team built from those so far. Keep a min-heap of the k largest speeds and maximize sumSpeed × efficiency (mod 1e9+7 at the end).',
    g: R => { const n = R.int(1, 6); return { n, speed: R.ints(n, 1, 10), efficiency: R.ints(n, 1, 10), k: R.int(1, n) }; },
    s(I, T) { const e = I.speed.map((s, i) => [I.efficiency[i], s]).sort((a, b) => b[0] - a[0]), h = PQ((a, b) => a - b); let sum = 0, best = 0; e.forEach(([ef, sp], i) => { h.push(sp); sum += sp; if (h.size > I.k) sum -= h.pop(); best = Math.max(best, sum * ef); if (i < 5) { T.at({ efficiency: ef, speeds: A(h.items()) }); T.n('Performance with this as the minimum efficiency?', sum * ef, 'speed sum × efficiency.'); } }); return best % 1000000007; }
  });

  D('longest-happy-string', {
    t: 'Longest Happy String',
    r: 'Greedy with a max-heap of letter counts: append the most frequent letter unless it would make three in a row, in which case use the next one; stop when neither fits.',
    g: R => ({ a: R.int(0, 6), b: R.int(0, 6), c: R.int(0, 6) }),
    cmp: (o, e, I) => typeof o === 'string' && o.length === e.length && !/aaa|bbb|ccc/.test(o) && [...'abc'].every(ch => o.split(ch).length - 1 <= I[ch]),
    s(I, T) { const c = { a: I.a, b: I.b, c: I.c }; let out = '', k = 0; for (;;) { const order = Object.keys(c).filter(x => c[x]).sort((x, y) => c[y] - c[x]); let used = null; for (const ch of order) { if (out.endsWith(ch + ch)) continue; used = ch; break; } if (!used) break; out += used; c[used]--; if (k++ < 6) { T.at({ built: out, left: K({ ...c }) }); T.n('Length so far?', out.length, `Append "${used}".`); } } return out; }
  });

  D('find-the-kth-smallest-sum-of-a-matrix-with-sorted-rows', {
    t: 'Find the Kth Smallest Sum of a Matrix With Sorted Rows',
    r: 'Fold the rows: keep the k smallest sums so far; combine them with the next row (all pairs, or a heap of candidates) and keep the k smallest again.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3); return { mat: Array.from({ length: m }, () => R.sorted(n, 1, 9)), k: R.int(1, Math.min(6, n ** m)) }; },
    s(I, T) { let cur = [0]; I.mat.forEach((row, i) => { cur = cur.flatMap(s => row.map(v => s + v)).sort((a, b) => a - b).slice(0, I.k); T.at({ row: A(row), kept: A(cur) }); T.n(`Smallest sum after ${i + 1} row(s)?`, cur[0], 'Keep only the k best.'); }); return cur[I.k - 1]; }
  });

  D('find-servers-that-handled-most-number-of-requests', {
    t: 'Find Servers That Handled Most Number of Requests',
    r: 'Keep busy servers in a min-heap by finish time and free servers in an ordered set. For request i, free servers whose time passed, then pick the first free index ≥ i mod k (wrapping); drop the request if none.',
    g: R => { const n = R.int(1, 7); let t = 0; return { k: R.int(1, 3), arrival: Array.from({ length: n }, () => t += R.int(1, 2)), load: R.ints(n, 1, 4) }; },
    cmp: 'set',
    s(I, T) { const busy = Array(I.k).fill(0), c = Array(I.k).fill(0); I.arrival.forEach((t, i) => { let pick = -1; for (let d = 0; d < I.k; d++) { const s = (i + d) % I.k; if (busy[s] <= t) { pick = s; break; } } if (i < 6) { T.at({ request: i, time: t, busyUntil: A(busy.slice()) }); T.n('Server chosen (−1 if dropped)?', pick, `First free from ${i % I.k}, wrapping.`); } if (pick >= 0) { busy[pick] = t + I.load[i]; c[pick]++; } }); const mx = Math.max(...c); return c.map((v, i) => v === mx ? i : -1).filter(i => i >= 0); }
  });

  D('furthest-building-you-can-reach', {
    t: 'Furthest Building You Can Reach',
    r: 'Use ladders on the largest climbs: push each climb into a min-heap; when it holds more than `ladders` climbs, pay the smallest with bricks. Stop when bricks go negative.',
    g: R => ({ heights: R.ints(R.int(2, 8), 1, 12), bricks: R.int(0, 8), ladders: R.int(0, 2) }),
    s(I, T) { const h = PQ((a, b) => a - b); let b = I.bricks; for (let i = 0; i + 1 < I.heights.length; i++) { const d = I.heights[i + 1] - I.heights[i]; if (d <= 0) continue; h.push(d); if (h.size > I.ladders) b -= h.pop(); T.at({ heights: A(I.heights, { i: i + 1 }), ladderClimbs: A(h.items()) }); T.n('Bricks left after reaching this building?', b, 'Bricks pay for the smallest climbs.'); if (b < 0) return i; } return I.heights.length - 1; }
  });

  D('minimize-deviation-in-array', {
    t: 'Minimize Deviation in Array',
    r: 'Double every odd number (its maximum). Then repeatedly halve the current maximum while it is even (max-heap), tracking the minimum and the best max − min.',
    g: R => ({ nums: R.ints(R.int(2, 5), 1, 20) }),
    s(I, T) { const h = PQ((a, b) => b - a); let mn = Infinity; I.nums.forEach(x => { const v = x % 2 ? 2 * x : x; h.push(v); mn = Math.min(mn, v); }); let best = h.peek() - mn, k = 0; while (h.peek() % 2 === 0) { const x = h.pop() / 2; h.push(x); mn = Math.min(mn, x); best = Math.min(best, h.peek() - mn); if (k++ < 5) { T.at({ heap: A(h.items()), min: mn }); T.n('Deviation now?', h.peek() - mn, 'max − min.'); } } return best; }
  });

  D('maximum-number-of-eaten-apples', {
    t: 'Maximum Number of Eaten Apples',
    r: 'Each day push (rot day, count) into a min-heap by rot day, discard rotten or empty batches, and eat one apple from the batch rotting soonest. Continue after the last day until the heap empties.',
    g: R => { const n = R.int(1, 5); return { apples: R.ints(n, 0, 3), days: R.ints(n, 1, 3) }; },
    s(I, T) { const h = PQ((a, b) => a[0] - b[0]); let eaten = 0; for (let d = 0; d < I.apples.length || h.size; d++) { if (d < I.apples.length && I.apples[d]) h.push([d + I.days[d], I.apples[d]]); while (h.size && (h.peek()[0] <= d || !h.peek()[1])) h.pop(); if (h.size) { h.peek()[1]--; eaten++; } if (d < 6) { T.at({ day: d, batches: A(h.items().map(x => `${x[1]}@${x[0]}`)) }); T.n('Apples eaten so far?', eaten, 'Eat from the batch rotting soonest.'); } } return eaten; }
  });

  D('maximum-average-pass-ratio', {
    t: 'Maximum Average Pass Ratio',
    r: 'Give each extra student to the class with the largest gain (p+1)/(t+1) − p/t, using a max-heap keyed by that gain; then average the ratios.',
    g: R => ({ classes: Array.from({ length: R.int(1, 4) }, () => { const t = R.int(1, 6); return [R.int(0, t), t]; }), extraStudents: R.int(1, 4) }),
    cmp: 'float',
    s(I, T) { const c = I.classes.map(x => x.slice()), gain = ([p, t]) => (p + 1) / (t + 1) - p / t; for (let e = 0; e < I.extraStudents; e++) { let bi = 0; c.forEach((x, i) => { if (gain(x) > gain(c[bi])) bi = i; }); if (e < 4) { T.at({ classes: A(c.map(x => x.join('/'))), student: e + 1 }); T.n('Class index that gets this student?', bi, 'Largest ratio gain.'); } c[bi][0]++; c[bi][1]++; } return c.reduce((s, [p, t]) => s + p / t, 0) / c.length; }
  });

  D('number-of-orders-in-the-backlog', {
    t: 'Number of Orders in the Backlog',
    r: 'Keep buy orders in a max-heap and sell orders in a min-heap by price. A buy matches the cheapest sells ≤ its price; a sell matches the highest buys ≥ its price. Leftovers go into the backlog; sum remaining amounts mod 1e9+7.',
    g: R => ({ orders: Array.from({ length: R.int(1, 5) }, () => [R.int(1, 30), R.int(1, 5), R.int(0, 1)]) }),
    s(I, T) { const buy = PQ((a, b) => b[0] - a[0]), sell = PQ((a, b) => a[0] - b[0]); I.orders.forEach(([p, amt, ty], i) => { let a = amt; if (ty === 0) { while (a && sell.size && sell.peek()[0] <= p) { const m = Math.min(a, sell.peek()[1]); a -= m; sell.peek()[1] -= m; if (!sell.peek()[1]) sell.pop(); } if (a) buy.push([p, a]); } else { while (a && buy.size && buy.peek()[0] >= p) { const m = Math.min(a, buy.peek()[1]); a -= m; buy.peek()[1] -= m; if (!buy.peek()[1]) buy.pop(); } if (a) sell.push([p, a]); } if (i < 5) { T.at({ order: `${ty ? 'sell' : 'buy'} ${amt} @ ${p}`, buys: A(buy.items().map(x => x.join('×'))), sells: A(sell.items().map(x => x.join('×'))) }); T.n('Amount of this order left in the backlog?', a, 'After matching the best opposite orders.'); } }); return [...buy.items(), ...sell.items()].reduce((s, x) => s + x[1], 0) % 1000000007; }
  });

  D('single-threaded-cpu', {
    t: 'Single-Threaded CPU',
    r: 'Sort tasks by enqueue time. When idle, jump time to the next task; push all tasks that have arrived into a min-heap by (processing time, index) and run the top.',
    g: R => ({ tasks: Array.from({ length: R.int(1, 6) }, () => [R.int(1, 8), R.int(1, 4)]) }),
    s(I, T) { const ord = I.tasks.map((t, i) => [t[0], t[1], i]).sort((a, b) => a[0] - b[0]), h = PQ((a, b) => a[1] - b[1] || a[2] - b[2]), out = []; let t = 0, i = 0; while (out.length < ord.length) { if (!h.size && t < ord[i][0]) t = ord[i][0]; while (i < ord.length && ord[i][0] <= t) h.push(ord[i++]); const x = h.pop(); if (out.length < 5) { T.at({ time: t, ready: A(h.items().concat([x]).map(y => `#${y[2]}(${y[1]})`)) }); T.n('Task index run next?', x[2], 'Shortest processing time, then smallest index.'); } t += x[1]; out.push(x[2]); } return out; }
  });

  D('minimum-interval-to-include-each-query', {
    t: 'Minimum Interval to Include Each Query',
    r: 'Sort intervals by left and queries ascending. For each query push intervals starting ≤ q into a min-heap by size, pop those ending before q; the top is the answer (−1 if empty).',
    g: R => ({ intervals: Array.from({ length: R.int(1, 5) }, () => { const l = R.int(1, 8); return [l, l + R.int(0, 4)]; }), queries: R.ints(R.int(1, 4), 1, 12) }),
    s(I, T) { return I.queries.map((q, i) => { const c = I.intervals.filter(([l, r]) => l <= q && q <= r).map(([l, r]) => r - l + 1), v = c.length ? Math.min(...c) : -1; if (i < 5) { T.at({ query: q, containing: A(c) }); T.n('Smallest interval size containing it (−1 if none)?', v, 'Heap top after cleanup.'); } return v; }); }
  });

  D('process-tasks-using-servers', {
    t: 'Process Tasks Using Servers',
    r: 'Free servers in a min-heap by (weight, index); busy servers by (free time, weight, index). Task j arrives at time j: release finished servers; if none is free, jump to the earliest finish. Assign the top free server.',
    g: R => ({ servers: R.ints(R.int(1, 3), 1, 5), tasks: R.ints(R.int(1, 6), 1, 4) }),
    s(I, T) { const free = PQ((a, b) => a[0] - b[0] || a[1] - b[1]), busy = PQ((a, b) => a[0] - b[0] || a[1] - b[1] || a[2] - b[2]); I.servers.forEach((w, i) => free.push([w, i])); const out = []; I.tasks.forEach((d, j) => { let t = j; while (busy.size && busy.peek()[0] <= t) { const [, w, i] = busy.pop(); free.push([w, i]); } if (!free.size) { t = busy.peek()[0]; while (busy.size && busy.peek()[0] === t) { const [, w, i] = busy.pop(); free.push([w, i]); } } const [w, i] = free.pop(); busy.push([t + d, w, i]); out.push(i); if (j < 5) { T.at({ task: j, start: t }); T.n('Server assigned?', i, 'Smallest weight, then index.'); } }); return out; }
  });

  D('the-number-of-the-smallest-unoccupied-chair', {
    t: 'The Number of the Smallest Unoccupied Chair',
    r: 'Process arrivals in time order. Before each arrival, free the chairs of friends who left (min-heap by leave time, pushing chairs into a min-heap of free chairs). The arriving friend takes the smallest free chair.',
    g: R => { const n = R.int(1, 5), s = R.distinct(n, 1, 12); return { times: s.map(a => [a, a + R.int(1, 5)]), targetFriend: R.int(0, n - 1) }; },
    s(I, T) { const ord = I.times.map((t, i) => [t[0], t[1], i]).sort((a, b) => a[0] - b[0]), leave = PQ((a, b) => a[0] - b[0]), free = PQ((a, b) => a - b); let next = 0; for (const [a, l, i] of ord) { while (leave.size && leave.peek()[0] <= a) free.push(leave.pop()[1]); const ch = free.size ? free.pop() : next++; T.at({ time: a, friend: i, freeChairs: A(free.items()) }); T.n('Chair taken?', ch, 'Smallest free chair.'); if (i === I.targetFriend) return ch; leave.push([l, ch]); } }
  });

  D('remove-stones-to-minimize-the-total', {
    t: 'Remove Stones to Minimize the Total',
    r: 'k times: pop the largest pile (max-heap), remove ⌊x/2⌋ stones, push it back. Sum what remains.',
    g: R => ({ piles: R.ints(R.int(1, 5), 1, 20), k: R.int(1, 4) }),
    s(I, T) { const h = PQ((a, b) => b - a); I.piles.forEach(x => h.push(x)); for (let i = 0; i < I.k; i++) { const x = h.pop(); h.push(x - Math.floor(x / 2)); if (i < 4) { T.at({ piles: A(h.items()) }); T.n('Pile size after halving the largest?', x - Math.floor(x / 2), `${x} − ⌊${x}/2⌋.`); } } return h.items().reduce((a, b) => a + b, 0); }
  });

  D('find-the-kth-largest-integer-in-the-array', {
    t: 'Find the Kth Largest Integer in the Array',
    r: 'Compare numeric strings by length, then lexicographically. Keep a min-heap of size k (or sort) and return its top.',
    g: R => { const a = Array.from({ length: R.int(1, 6) }, () => String(R.int(0, 120))); return { nums: a, k: R.int(1, a.length) }; },
    s(I, T) { const res = (() => { const cmp = (a, b) => a.length - b.length || (a < b ? -1 : a > b ? 1 : 0), h = PQ(cmp); I.nums.forEach(x => { h.push(x); if (h.size > I.k) h.pop(); }); T.at({ nums: A(I.nums), k: I.k }); T.n('How many strings stay in the heap?', I.k, 'Size k.'); return h.peek(); })(); T.n('Digits in the kth largest?', res.length, 'Compare by length first.'); T.n('Numbers with more digits than it?', I.nums.filter(x => x.length > res.length).length, 'They are all larger.'); return res; }
  });

  D('find-subsequence-of-length-k-with-the-largest-sum', {
    t: 'Find Subsequence of Length K With the Largest Sum',
    r: 'Pick the k largest values (heap), keeping their indices; output them in original index order.',
    g: R => { const a = R.ints(R.int(1, 7), -5, 9); return { nums: a, k: R.int(1, a.length) }; },
    cmp: (o, e, I) => { if (!Array.isArray(o) || o.length !== I.k) return false; let j = 0; for (const x of I.nums) if (j < o.length && x === o[j]) j++; return j === o.length && o.reduce((a, b) => a + b, 0) === e.reduce((a, b) => a + b, 0); },
    s(I, T) { const res = (() => { const idx = I.nums.map((v, i) => i).sort((a, b) => I.nums[b] - I.nums[a] || a - b).slice(0, I.k).sort((a, b) => a - b); T.at({ nums: A(I.nums) }); T.n('Largest possible sum?', idx.reduce((s, i) => s + I.nums[i], 0), 'Sum of the k largest.'); T.n('Smallest value kept?', Math.min(...idx.map(i => I.nums[i])), 'The kth largest value.'); return idx.map(i => I.nums[i]); })(); T.n('First value of the answer?', res[0], 'Keep the original order.'); return res; }
  });

  D('construct-string-with-repeat-limit', {
    t: 'Construct String With Repeat Limit',
    r: 'Greedy from the largest letter: append it up to repeatLimit times; if more remain, insert one copy of the next smaller letter as a separator and continue. Stop when no separator exists.',
    g: R => ({ s: R.str(R.int(1, 8), 'aabcz'), repeatLimit: R.int(1, 3) }),
    s(I, T) { const c = Array(26).fill(0); for (const ch of I.s) c[ch.charCodeAt(0) - 97]++; let out = '', k = 0; for (let i = 25; i >= 0;) { if (!c[i]) { i--; continue; } const take = Math.min(c[i], I.repeatLimit); out += String.fromCharCode(97 + i).repeat(take); c[i] -= take; if (k++ < 5) { T.at({ built: out }); T.n(`Copies of "${String.fromCharCode(97 + i)}" just added?`, take, 'At most repeatLimit in a row.'); } if (c[i]) { let j = i - 1; while (j >= 0 && !c[j]) j--; if (j < 0) break; out += String.fromCharCode(97 + j); c[j]--; } else i--; } return out; }
  });
})();
