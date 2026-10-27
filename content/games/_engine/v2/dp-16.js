/* v2 games: dp (16). Guides scored in the 3483–4041 pass. */
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

  D('zero-array-transformation-iv', {
    t: 'Zero Array Transformation IV',
    r: 'Each index is independent: it needs a subset of the vals of queries covering it to sum to exactly nums[i]. Keep a reachable-sum set per index, add queries one by one, and stop at the first k where every index can hit its target.',
    g: R => { const n = R.int(2, 4); return { nums: R.ints(n, 0, 4), queries: Array.from({ length: R.int(2, 5) }, () => { const l = R.int(0, n - 1); return [l, R.int(l, n - 1), R.int(1, 3)]; }) }; },
    s(I, T) { const n = I.nums.length, reach = I.nums.map(() => new Set([0])); const done = () => reach.filter((s, i) => s.has(I.nums[i])).length; T.at({ nums: A(I.nums), reachable: K(reach.map((s, i) => [i, [...s].sort((a, b) => a - b).join(',')])) }); T.n('Before any query, how many indices already match (sum 0 = nums[i])?', done(), 'Only zeros match with the empty subset.'); if (done() === n) return 0; for (let k = 0; k < I.queries.length; k++) { const [l, r, v] = I.queries[k]; for (let i = l; i <= r; i++) { const add = [...reach[i]].map(x => x + v).filter(x => x <= I.nums[i]); add.forEach(x => reach[i].add(x)); } T.at({ nums: A(I.nums, { win: [l, r] }), query: `[${l},${r}] val ${v}`, reachable: K(reach.map((s, i) => [i, [...s].sort((a, b) => a - b).join(',')])) }); T.n(`After query ${k + 1}, how many indices can reach exactly nums[i]?`, done(), 'An index matches when its own target is in its subset-sum set.'); if (done() === n) return k + 1; } return -1; }
  });

  D('count-beautiful-numbers', {
    t: 'Count Beautiful Numbers',
    r: 'A number is beautiful when the product of its digits is divisible by their sum. Any 0 digit makes the product 0, which every sum divides. The full solution is a digit DP over (sum, product); here you check numbers one at a time.',
    g: R => { const l = R.int(1, 60); return { l, r: l + R.int(3, 9) }; },
    s(I, T) { let c = 0; for (let x = I.l; x <= I.r; x++) { const d = digits(x), s = sum(d), p = d.reduce((a, b) => a * b, 1), ok = p % s === 0; if (ok) c++; if (T.room()) { T.at({ x, digits: A(d), sum: s, product: p }); T.yn(`Is ${x} beautiful?`, ok, ok ? `${p} is a multiple of ${s}.` : `${p} mod ${s} = ${p % s}.`); } } return c; }
  });

  D('minimum-cost-to-divide-array-into-subarrays', {
    t: 'Minimum Cost to Divide Array into Subarrays',
    r: 'The k · i term telescopes: starting a new piece at l adds k × (cost of everything from l to the end). So dp[i] = min over j of dp[j] + pre[i] × (cost[j..i−1]) + k × (cost[j..n−1]).',
    g: R => { const n = R.int(2, 5); return { nums: R.ints(n, 1, 5), cost: R.ints(n, 1, 5), k: R.int(1, 3) }; },
    s(I, T) { const n = I.nums.length, P = [0], C = [0]; for (let i = 0; i < n; i++) { P.push(P[i] + I.nums[i]); C.push(C[i] + I.cost[i]); } const dp = [0]; for (let i = 1; i <= n; i++) { let b = Infinity, bj = 0; for (let j = 0; j < i; j++) { const v = dp[j] + P[i] * (C[i] - C[j]) + I.k * (C[n] - C[j]); if (v < b) { b = v; bj = j; } } dp.push(b); T.at({ nums: A(I.nums, { win: [bj, i - 1] }), cost: A(I.cost), dp: A(dp.slice()), k: I.k }); T.n(`dp[${i}] (best cost for the first ${i} elements)?`, b, `Best last piece starts at ${bj}: dp[${bj}] + ${P[i]}×${C[i] - C[bj]} + ${I.k}×${C[n] - C[bj]}.`); } return dp[n]; }
  });

  D('minimum-operations-to-make-elements-within-k-subarrays-equal', {
    t: 'Minimum Operations to Make Elements Within K Subarrays Equal',
    r: 'A window of size x is cheapest to flatten to its median: cost = Σ|a − median|. Then dp[i][j] = min(dp[i−1][j], dp[i−x][j−1] + cost of the window ending at i−1).',
    g: R => { const x = R.int(2, 3), k = R.int(1, 2), n = x * k + R.int(0, 3); return { nums: R.ints(n, -3, 6), x, k }; },
    s(I, T) { const { nums, x, k } = I, n = nums.length, c = []; for (let s = 0; s + x <= n; s++) { const w = nums.slice(s, s + x).sort((a, b) => a - b), m = w[(x - 1) >> 1]; c.push(sum(w.map(v => Math.abs(v - m)))); if (s < 5) { T.at({ nums: A(nums, { win: [s, s + x - 1] }), median: m }); T.n(`Cost to make window [${s}..${s + x - 1}] equal?`, c[s], 'Move every value to the median.'); } } const dp = Array.from({ length: n + 1 }, () => Array(k + 1).fill(Infinity)); for (let i = 0; i <= n; i++) dp[i][0] = 0; for (let i = 1; i <= n; i++) for (let j = 1; j <= k; j++) { dp[i][j] = dp[i - 1][j]; if (i >= x && dp[i - x][j - 1] < Infinity) dp[i][j] = Math.min(dp[i][j], dp[i - x][j - 1] + c[i - x]); } T.at({ windowCost: A(c), k }); T.n(`Minimum total for ${k} non-overlapping windows?`, dp[n][k], 'dp: skip element i, or end a window at i.'); return dp[n][k]; }
  });

  D('maximum-product-of-subsequences-with-an-alternating-sum-equal-to-k', {
    t: 'Maximum Product of Subsequences With an Alternating Sum Equal to K',
    r: 'DP over states (alternating sum, sign of the next pick, product capped at limit+1). Each number either starts a subsequence, extends a state with the next sign, or is skipped. A 0 resets any product, even an over-limit one.',
    g: R => ({ nums: R.ints(R.int(2, 5), 0, 4), k: R.int(-2, 4), limit: R.int(4, 20) }),
    s(I, T) { const L = I.limit, st = new Map(); let best = -1; const add = (s, p, q) => st.set(s + ',' + p + ',' + q, [s, p, q]); I.nums.forEach((x, i) => { const cur = [...st.values()]; add(x, 1, Math.min(x, L + 1)); cur.forEach(([s, p, q]) => add(s + (p ? -x : x), p ^ 1, Math.min(q * x, L + 1))); best = -1; for (const [s, , q] of st.values()) if (s === I.k && q <= L && q > best) best = q; T.at({ nums: A(I.nums, { i }), k: I.k, limit: L, states: st.size }); T.n(`After nums[${i}] = ${x}, best product ≤ limit with alternating sum ${I.k}? (−1 if none)`, best, 'Look over every subsequence so far: even positions add, odd positions subtract.'); }); return best; }
  });

  D('find-x-value-of-array-i', {
    t: 'Find X Value of Array I',
    r: 'Removing a prefix and a suffix leaves a subarray. Track cnt[r] = number of subarrays ending here with product ≡ r (mod k): the new element x maps every r to r·x mod k and starts one new subarray at x mod k.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 9), k: R.int(2, 5) }),
    s(I, T) { const k = I.k, res = Array(k).fill(0); let cur = Array(k).fill(0); I.nums.forEach((x, i) => { const nx = Array(k).fill(0); cur.forEach((c, r) => nx[r * x % k] += c); nx[x % k]++; cur = nx; cur.forEach((c, r) => res[r] += c); const r0 = i % k; T.at({ nums: A(I.nums, { i }), k, endingHere: A(cur.slice(), { labels: range(0, k).map(String) }) }); T.n(`Subarrays ending at index ${i} with product % ${k} = ${r0}?`, cur[r0], `Old counts shift r → r×${x} mod ${k}, plus [${x}] alone.`); }); return res; }
  });

  D('maximum-profit-from-valid-topological-order-in-dag', {
    t: 'Maximum Profit from Valid Topological Order in DAG',
    r: 'Bitmask DP: dp[mask] is the best profit with the nodes in mask placed first. A node v can come next only if all its parents are in mask, and it earns score[v] × (|mask| + 1).',
    g: R => { const n = R.int(2, 5), edges = []; const p = R.perm(n); for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.3)) edges.push([p[i], p[j]]); return { n, edges, score: R.ints(n, 1, 9) }; },
    s(I, T) { const n = I.n, need = Array(n).fill(0); I.edges.forEach(([u, v]) => need[v] |= 1 << u); const F = 1 << n, dp = Array(F).fill(-Infinity), from = Array(F).fill(-1); dp[0] = 0; for (let m = 0; m < F; m++) { if (dp[m] === -Infinity) continue; const pos = popc(m) + 1; for (let v = 0; v < n; v++) if (!(m >> v & 1) && (need[v] & m) === need[v]) { const nm = m | 1 << v, val = dp[m] + I.score[v] * pos; if (val > dp[nm]) { dp[nm] = val; from[nm] = v; } } } const order = []; for (let m = F - 1; m; m ^= 1 << from[m]) order.unshift(from[m]); let m = 0; order.forEach((v, i) => { m |= 1 << v; if (i >= n - 4) { T.v(GR(n, I.edges, { dir: true, cls: Object.fromEntries(range(0, n).filter(x => m >> x & 1).map(x => [x, 'ok'])), tag: Object.fromEntries(I.score.map((s, x) => [x, 's=' + s])) })); T.n(`Best profit with nodes {${range(0, n).filter(x => m >> x & 1).join(',')}} placed first?`, dp[m], 'Try each valid last node of the set: dp[set − v] + score[v] × |set|.'); } }); return dp[F - 1]; }
  });

  D('concatenated-divisibility', {
    t: 'Concatenated Divisibility',
    r: 'Bitmask DP over (used numbers, current remainder) tells whether a prefix can still be finished into a multiple of k. Build the answer greedily: try the smallest remaining number first and keep it only if the rest can still succeed.',
    g: R => ({ nums: R.ints(R.int(2, 4), 1, 30), k: R.int(2, 9) }),
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length, k = I.k, p10 = a.map(x => Math.pow(10, String(x).length) % k), memo = new Map(); const ok = (m, r) => { if (m === (1 << n) - 1) return r === 0; const key = m * 101 + r; if (memo.has(key)) return memo.get(key); let res = false; for (let i = 0; i < n && !res; i++) if (!(m >> i & 1)) res = ok(m | 1 << i, (r * p10[i] + a[i]) % k); memo.set(key, res); return res; }; if (!ok(0, 0)) { T.at({ nums: A(a), k }); T.yn('Can any order be divisible by k?', false, 'The DP from (empty, 0) never reaches remainder 0 with all numbers used.'); return []; } let m = 0, r = 0; const out = []; for (let step = 0; step < n; step++) { let pick = -1; for (let i = 0; i < n; i++) if (!(m >> i & 1) && ok(m | 1 << i, (r * p10[i] + a[i]) % k)) { pick = i; break; } const opts = [...new Set(a.filter((_, i) => !(m >> i & 1)))]; T.at({ nums: A(a, { dim: range(0, n).filter(i => m >> i & 1) }), built: out.join('') || '(empty)', remainder: r, k }); T.c('Which number goes next?', opts, a[pick], 'Take the smallest number that still leaves a finishable state.'); out.push(a[pick]); m |= 1 << pick; r = (r * p10[pick] + a[pick]) % k; } return out; }
  });

  D('merge-operations-for-minimum-travel-time', {
    t: 'Merge Operations for Minimum Travel Time',
    r: 'Merging sign i into i+1 removes sign i and adds its rate to the next sign, so each kept sign\'s rate is the sum of the removed run before it. DP over (last kept sign, merges used, rate of the run) finds the cheapest k merges.',
    g: R => { const n = R.int(3, 6), pos = [0]; for (let i = 1; i < n; i++) pos.push(pos[i - 1] + R.int(1, 4)); return { l: pos[n - 1], n, k: R.int(0, Math.min(2, n - 2)), position: pos, time: R.ints(n, 1, 9) }; },
    s(I, T) { const cost = (p, t) => { let c = 0; for (let i = 0; i + 1 < p.length; i++) c += (p[i + 1] - p[i]) * t[i]; return c; }; const best = (p, t, k) => { if (!k) return cost(p, t); let b = Infinity; for (let i = 1; i + 1 < p.length; i++) { const t2 = t.slice(); t2[i + 1] += t2[i]; t2.splice(i, 1); const p2 = p.slice(); p2.splice(i, 1); b = Math.min(b, best(p2, t2, k - 1)); } return b; }; T.at({ position: A(I.position), time: A(I.time) }); T.n('Travel time with no merges?', cost(I.position, I.time), 'Σ (next position − position) × time of the sign you leave from.'); if (I.k) for (let i = 1; i + 1 < I.n; i++) { const t2 = I.time.slice(); t2[i + 1] += t2[i]; t2.splice(i, 1); const p2 = I.position.slice(); p2.splice(i, 1); T.at({ position: A(I.position, { i }), time: A(I.time, { i }), merges: I.k }); T.n(`Best total if the first merge removes sign ${i}?`, best(p2, t2, I.k - 1), `Sign ${i + 1} now runs at ${I.time[i] + I.time[i + 1]} per km from position ${I.position[i + 1]}.`); } return best(I.position, I.time, I.k); }
  });

  D('maximum-weighted-k-edge-path', {
    t: 'Maximum Weighted K-Edge Path',
    r: 'DP by number of edges: reach[j][v] is the set of path sums (all < t) of paths with exactly j edges ending at v. Extend every sum along each edge, drop sums ≥ t, and read the max at j = k.',
    g: R => { const n = R.int(3, 5), p = R.perm(n), edges = []; for (let i = 0; i < n; i++) for (let j = i + 1; j < n; j++) if (R.chance(0.45)) edges.push([p[i], p[j], R.int(1, 6)]); return { n, edges, k: R.int(1, 3), t: R.int(4, 14) }; },
    s(I, T) { let cur = Array.from({ length: I.n }, () => new Set([0])); const best = c => { let b = -1; c.forEach(s => s.forEach(x => b = Math.max(b, x))); return b; }; for (let j = 1; j <= I.k; j++) { const nx = Array.from({ length: I.n }, () => new Set()); I.edges.forEach(([u, v, w]) => cur[u].forEach(x => { if (x + w < I.t) nx[v].add(x + w); })); cur = nx; T.v(GR(I.n, I.edges.map(e => [e[0], e[1]]), { dir: true, tag: Object.fromEntries(I.edges.map(e => [e[1], ''])) }), K(cur.map((s, v) => [v, [...s].sort((a, b) => a - b).join(',') || '–'])), K([['edges used', j], ['t', I.t]])); T.n(`Largest sum < t over paths with exactly ${j} edge${j > 1 ? 's' : ''}? (−1 if none)`, best(cur), 'Extend every stored sum along each outgoing edge; discard sums ≥ t.'); } return best(cur); }
  });

  D('lexicographically-smallest-string-after-adjacent-removals', {
    t: 'Lexicographically Smallest String After Adjacent Removals',
    r: 'Interval DP: s[i..j] can vanish if s[i] pairs with some s[m] (consecutive letters) and both s[i+1..m−1] and s[m+1..j] can vanish. Then best(i) = min(s[i] + best(i+1), best(j+1) for every removable s[i..j]).',
    g: R => ({ s: R.str(R.int(2, 7), 'abcd') }),
    s(I, T) { const s = I.s, n = s.length, adj = (a, b) => { const d = Math.abs(a.charCodeAt(0) - b.charCodeAt(0)); return d === 1 || d === 25; }; const can = Array.from({ length: n + 1 }, () => Array(n + 1).fill(false)); const ok = (i, j) => i > j ? true : can[i][j]; for (let len = 2; len <= n; len += 2) for (let i = 0; i + len - 1 < n; i++) { const j = i + len - 1; for (let m = i + 1; m <= j; m += 2) if (adj(s[i], s[m]) && ok(i + 1, m - 1) && ok(m + 1, j)) { can[i][j] = true; break; } } const best = Array(n + 1).fill(''); for (let i = n - 1; i >= 0; i--) { let b = s[i] + best[i + 1]; for (let j = i + 1; j < n; j += 2) if (can[i][j] && best[j + 1] < b) b = best[j + 1]; best[i] = b; } let asked = 0; for (let i = 0; i < n && asked < 4; i++) for (let j = i + 1; j < n && asked < 4; j += 2) { asked++; T.at({ s: A(s.split(''), { win: [i, j] }) }); T.yn(`Can s[${i}..${j}] be removed completely?`, can[i][j], can[i][j] ? 'Some pairing of consecutive letters clears it.' : 'No way to pair every letter.'); } for (let i = Math.min(n - 1, 2); i >= 0; i--) { const opts = [best[i], s[i] + best[i + 1], s.slice(i)]; T.at({ s: A(s.split(''), { i }), ['best(' + (i + 1) + ')']: JSON.stringify(best[i + 1]) }); T.c(`Smallest string from suffix s[${i}..]?`, opts.map(x => JSON.stringify(x)), JSON.stringify(best[i]), 'Keep s[i], or delete a removable block s[i..j] and continue after it.'); } return best[0]; }
  });

  D('best-time-to-buy-and-sell-stock-v', {
    t: 'Best Time to Buy and Sell Stock V',
    r: 'DP over days with states free / holding a long / holding a short, and the number of finished transactions. Open a long (−p) or a short (+p) from free; close a long (+p) or short (−p) to finish one. Use yesterday\'s values so one day has one action.',
    g: R => ({ prices: R.ints(R.int(3, 7), 1, 12), k: R.int(1, 3) }),
    s(I, T) { const k = I.k, NEG = -Infinity; let free = Array(k + 1).fill(NEG), lng = Array(k + 1).fill(NEG), sht = Array(k + 1).fill(NEG); free[0] = 0; I.prices.forEach((p, d) => { const f = free.slice(), l = lng.slice(), s = sht.slice(); for (let j = 0; j <= k; j++) { if (free[j] > NEG && j < k) { l[j] = Math.max(l[j], free[j] - p); s[j] = Math.max(s[j], free[j] + p); } if (j > 0) { if (lng[j - 1] > NEG) f[j] = Math.max(f[j], lng[j - 1] + p); if (sht[j - 1] > NEG) f[j] = Math.max(f[j], sht[j - 1] - p); } } free = f; lng = l; sht = s; T.at({ prices: A(I.prices, { i: d }), k }); T.n(`Best profit with nothing open after day ${d}?`, Math.max(...free.filter(x => x > NEG)), 'Max over j of free[j]: close a long at +p or a short at −p, or keep yesterday\'s.'); }); return Math.max(...free.filter(x => x > NEG)); }
  });

  D('minimum-steps-to-convert-string-with-operations', {
    t: 'Minimum Steps to Convert String with Operations',
    r: 'dp[i] = min over j of dp[j] + cost(word1[j..i−1] → word2[j..i−1]). A piece costs (mismatches − swappable pairs), where a pair a→b and b→a is fixed by one swap; or 1 more for reversing it first.',
    g: R => { const n = R.int(2, 5); return { word1: R.str(n, 'abc'), word2: R.str(n, 'abc') }; },
    s(I, T) { const n = I.word1.length; const f = (a, b) => { const c = {}; let mis = 0, sw = 0; for (let i = 0; i < a.length; i++) if (a[i] !== b[i]) { mis++; const k = b[i] + a[i]; if (c[k]) { c[k]--; sw++; } else c[a[i] + b[i]] = (c[a[i] + b[i]] || 0) + 1; } return mis - sw; }; const cost = (j, i) => { const a = I.word1.slice(j, i), b = I.word2.slice(j, i); return Math.min(f(a, b), 1 + f(a.split('').reverse().join(''), b)); }; T.at({ word1: A(I.word1.split('')), word2: A(I.word2.split('')) }); T.n('Cost of converting the whole string as one piece?', cost(0, n), 'Mismatches minus swap pairs, or reverse first for +1.'); const dp = [0]; for (let i = 1; i <= n; i++) { let b = Infinity, bj = 0; for (let j = 0; j < i; j++) { const v = dp[j] + cost(j, i); if (v < b) { b = v; bj = j; } } dp.push(b); T.at({ word1: A(I.word1.split(''), { win: [bj, i - 1] }), word2: A(I.word2.split(''), { win: [bj, i - 1] }), dp: A(dp.slice()) }); T.n(`dp[${i}]?`, b, `Best last piece starts at ${bj}.`); } return dp[n]; }
  });

  D('inverse-coin-change', {
    t: 'Inverse Coin Change',
    r: 'Rebuild coins from small to large. With the coins found so far, count ways to make i. If that is one less than numWays[i], i itself must be a coin (add it and update the counts); if equal, it is not; anything else means no coin set works.',
    g: R => { const n = R.int(3, 8), coins = range(1, n + 1).filter(() => R.chance(0.35)); const w = Array(n + 1).fill(0); w[0] = 1; coins.forEach(c => { for (let i = c; i <= n; i++) w[i] += w[i - c]; }); if (R.chance(0.2)) w[R.int(1, n)] += 1; return { numWays: w.slice(1) }; },
    s(I, T) { const n = I.numWays.length, w = Array(n + 1).fill(0), coins = []; w[0] = 1; for (let i = 1; i <= n; i++) { const need = I.numWays[i - 1], d = need - w[i]; T.at({ numWays: A(I.numWays, { i: i - 1 }), ways: A(w.slice(1)), coins: A(coins.slice()) }); T.c(`Amount ${i}: target ${need}, current coins make ${w[i]}. Verdict?`, ['coin', 'not a coin', 'impossible'], d === 1 ? 'coin' : d === 0 ? 'not a coin' : 'impossible', 'Adding coin i adds exactly one new way to make i (the coin alone).'); if (d === 1) { coins.push(i); for (let j = i; j <= n; j++) w[j] += w[j - i]; } else if (d !== 0) return []; } return coins; }
  });

  D('partition-array-to-minimize-xor', {
    t: 'Partition Array to Minimize XOR',
    r: 'dp[j][i] = smallest possible max-XOR when the first i elements form j pieces: try every start p of the last piece, max(dp[j−1][p], xor(p..i−1)), using prefix XORs.',
    g: R => { const n = R.int(2, 5); return { nums: R.ints(n, 1, 7), k: R.int(1, n) }; },
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] ^ x)); let prev = Array(n + 1).fill(Infinity); prev[0] = 0; for (let j = 1; j <= I.k; j++) { const cur = Array(n + 1).fill(Infinity); for (let i = j; i <= n; i++) for (let p = j - 1; p < i; p++) cur[i] = Math.min(cur[i], Math.max(prev[p], P[i] ^ P[p])); if (j >= I.k - 1 || j <= 2) { const i = j === I.k ? n : Math.min(n, j + 1); T.at({ nums: A(a), prefixXor: A(P), pieces: j }); T.n(`Best max-XOR for the first ${i} elements in ${j} piece${j > 1 ? 's' : ''}?`, cur[i], 'Try each start of the last piece; its XOR is P[i] ^ P[p].'); } prev = cur; } return prev[n]; }
  });

  D('minimum-cost-path-with-alternating-directions-ii', {
    t: 'Minimum Cost Path with Alternating Directions II',
    r: 'Moves (right or down) alternate with one-second waits, so every cell you pass through except the start and the goal also charges its wait cost. dp[i][j] = (i+1)(j+1) + min(dp[up] + wait[up], dp[left] + wait[left]), with no wait charged on (0,0).',
    g: R => { const m = R.int(1, 3), n = R.int(m === 1 ? 2 : 1, 4); return { m, n, waitCost: R.grid(m, n, 0, 6) }; },
    s(I, T) { const { m, n } = I, W = I.waitCost, dp = Array.from({ length: m }, () => Array(n).fill(null)); const w = (i, j) => i || j ? W[i][j] : 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { if (!i && !j) { dp[0][0] = 1; continue; } let b = Infinity; if (i) b = Math.min(b, dp[i - 1][j] + w(i - 1, j)); if (j) b = Math.min(b, dp[i][j - 1] + w(i, j - 1)); dp[i][j] = b + (i + 1) * (j + 1); if (T.room()) { T.at({ waitCost: G(W, { hl: [[i, j]] }), dp: G(dp.map(r => r.map(x => x === null ? '·' : x))) }); T.n(`dp[${i}][${j}]?`, dp[i][j], `Entry ${(i + 1) * (j + 1)} + cheaper of (up + its wait) and (left + its wait).`); } } return dp[m - 1][n - 1]; }
  });

  D('minimum-number-of-primes-to-sum-to-target', {
    t: 'Minimum Number of Primes to Sum to Target',
    r: 'Unbounded coin change with the first m primes as coins: dp[x] = 1 + min dp[x − p] over those primes, dp[0] = 0.',
    g: R => ({ n: R.int(2, 25), m: R.int(1, 4) }),
    s(I, T) { const P = []; for (let x = 2; P.length < I.m; x++) if (isPrime(x)) P.push(x); const dp = Array(I.n + 1).fill(Infinity); dp[0] = 0; for (let x = 1; x <= I.n; x++) for (const p of P) if (p <= x && dp[x - p] + 1 < dp[x]) dp[x] = dp[x - p] + 1; const ask = [...new Set([Math.max(1, I.n - P[0]), Math.max(1, I.n - (P[1] || P[0])), I.n])]; ask.forEach(x => { T.at({ primes: A(P), dp: A(dp.slice(0, x).map(v => v === Infinity ? '∞' : v)) }); T.n(`dp[${x}]? (−1 if impossible)`, dp[x] === Infinity ? -1 : dp[x], 'One more than the best dp[x − p].'); }); return dp[I.n] === Infinity ? -1 : dp[I.n]; }
  });

  D('trionic-array-ii', {
    t: 'Trionic Array II',
    r: 'Three running DP values ending at i: up1 (a rising run of length ≥ 2), down (up1 then a strict fall), up2 (down then a strict rise). Each extends the previous phase or itself when the step direction fits; the answer is the max up2.',
    g: R => { const n = R.int(4, 7); let a; do a = R.ints(n, -4, 6); while (!(() => { for (let l = 0; l < n; l++) for (let p = l + 1; p < n; p++) for (let q = p + 1; q < n - 1; q++) { let ok = true; for (let i = l; i < p; i++) ok = ok && a[i] < a[i + 1]; for (let i = p; i < q; i++) ok = ok && a[i] > a[i + 1]; if (ok && a[q] < a[q + 1]) return true; } return false; })()); return { nums: a }; },
    s(I, T) { const a = I.nums, N = -Infinity; let u1 = N, dn = N, u2 = N, best = N; const f = x => x === N ? '−∞' : x; for (let i = 1; i < a.length; i++) { const x = a[i], y = a[i - 1]; const nu1 = x > y ? x + Math.max(y, u1) : N, ndn = x < y ? x + Math.max(u1, dn) : N, nu2 = x > y ? x + Math.max(dn, u2) : N; u1 = nu1; dn = ndn; u2 = nu2; best = Math.max(best, u2); if (i <= 6) { T.at({ nums: A(a, { i }), up1: f(u1), down: f(dn) }); if (u2 > N) T.n(`up2 at index ${i}? (best trionic sum ending here)`, u2, 'nums[i] plus the better of down[i−1] and up2[i−1].'); else T.n(`down at index ${i}? (−999 for −∞)`, dn === N ? -999 : dn, x < y ? 'nums[i] plus the better of up1[i−1] and down[i−1].' : 'A rise cannot extend a falling phase.'); } } return best; }
  });

  D('maximum-weight-in-two-bags', {
    t: 'Maximum Weight in Two Bags',
    r: 'Two-dimensional 0/1 knapsack: can[a][b] = can bag 1 hold exactly a and bag 2 exactly b. Each item either skips, goes to bag 1, or goes to bag 2; loop capacities downward so it is used once. Answer = max a + b reachable.',
    g: R => ({ weights: R.ints(R.int(2, 5), 1, 6), w1: R.int(1, 8), w2: R.int(1, 8) }),
    s(I, T) { const { w1, w2 } = I; let can = Array.from({ length: w1 + 1 }, () => Array(w2 + 1).fill(false)); can[0][0] = true; const best = () => { let b = 0; for (let a = 0; a <= w1; a++) for (let c = 0; c <= w2; c++) if (can[a][c]) b = Math.max(b, a + c); return b; }; I.weights.forEach((w, i) => { for (let a = w1; a >= 0; a--) for (let c = w2; c >= 0; c--) if (!can[a][c] && ((a >= w && can[a - w][c]) || (c >= w && can[a][c - w]))) can[a][c] = true; T.at({ weights: A(I.weights, { i }), w1, w2 }); T.n(`Best total after considering item ${i} (weight ${w})?`, best(), 'Max a + b over reachable (bag 1, bag 2) loads.'); }); return best(); }
  });

  D('minimum-cost-path-with-teleportations', {
    t: 'Minimum Cost Path with Teleportations',
    r: 'Layer by teleports used. Layer 0 is the usual right/down path DP. For layer t, a cell can be reached for free from any cell with a value ≥ its own, costing the best layer t−1 cost among those; then rerun the right/down DP on top.',
    g: R => { const m = R.int(2, 3), n = R.int(2, 3); return { grid: R.grid(m, n, 0, 6), k: R.int(0, 2) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; const walk = base => { const d = base.map(r => r.slice()); for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { if (i) d[i][j] = Math.min(d[i][j], d[i - 1][j] + g[i][j]); if (j) d[i][j] = Math.min(d[i][j], d[i][j - 1] + g[i][j]); } return d; }; const init = Array.from({ length: m }, () => Array(n).fill(Infinity)); init[0][0] = 0; let d = walk(init); T.at({ grid: G(g), dp: G(d) }); T.n('Cost to the corner with no teleports?', d[m - 1][n - 1], 'Classic right/down path sum (start cell is free).'); for (let t = 1; t <= I.k; t++) { const tele = Array.from({ length: m }, (_, x) => Array.from({ length: n }, (_, y) => { let b = d[x][y]; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) if (g[i][j] >= g[x][y]) b = Math.min(b, d[i][j]); return b; })); d = walk(tele); T.at({ grid: G(g), dp: G(d), teleports: t }); T.n(`Cost to the corner with at most ${t} teleport${t > 1 ? 's' : ''}?`, d[m - 1][n - 1], 'Free jumps go to cells with a value ≤ the cell you leave.'); } return d[m - 1][n - 1]; }
  });

  D('maximum-walls-destroyed-by-robots', {
    t: 'Maximum Walls Destroyed by Robots',
    r: 'Sort robots. Each robot\'s bullet covers [pos − d, pos] or [pos, pos + d], clipped so it stops at a neighboring robot. DP left to right on the direction of each robot, counting walls once when two neighbors\' ranges overlap.',
    g: R => { const k = R.int(1, 3), pos = R.distinct(k, 1, 15).sort((a, b) => a - b); return { robots: pos, distance: R.ints(k, 1, 4), walls: R.distinct(R.int(1, 5), 1, 16) }; },
    s(I, T) { const idx = range(0, I.robots.length).sort((a, b) => I.robots[a] - I.robots[b]), P = idx.map(i => I.robots[i]), Dd = idx.map(i => I.distance[i]), n = P.length; const rng = (i, dir) => dir ? [P[i], Math.min(P[i] + Dd[i], i + 1 < n ? P[i + 1] - 1 : Infinity)] : [Math.max(P[i] - Dd[i], i ? P[i - 1] + 1 : -Infinity), P[i]]; const cnt = ([a, b]) => I.walls.filter(w => w >= a && w <= b).length; let best = 0; for (let m = 0; m < 1 << n; m++) { const hit = new Set(); for (let i = 0; i < n; i++) { const [a, b] = rng(i, m >> i & 1); I.walls.forEach(w => { if (w >= a && w <= b) hit.add(w); }); } best = Math.max(best, hit.size); } for (let i = 0; i < n && i < 3; i++) { T.at({ robots: A(P, { i }), distance: A(Dd, { i }), walls: A(I.walls.slice().sort((a, b) => a - b)) }); T.n(`Walls robot at ${P[i]} hits firing left?`, cnt(rng(i, 0)), 'Range [pos − d, pos], cut short by the robot to its left.'); T.n(`Walls it hits firing right?`, cnt(rng(i, 1)), 'Range [pos, pos + d], cut short by the robot to its right.'); } return best; }
  });

  D('twisted-mirror-path-count', {
    t: 'Twisted Mirror Path Count',
    r: 'Count paths with DP from the goal backwards. From a cell, a right move into a mirror slides down (and keeps bouncing through mirrors), a down move into a mirror slides right. Each landing cell is further down-right, so ways(cell) = ways(right landing) + ways(down landing).',
    g: R => { const m = R.int(2, 4), n = R.int(2, 4), g = Array.from({ length: m }, () => Array.from({ length: n }, () => R.chance(0.3) ? 1 : 0)); g[0][0] = 0; g[m - 1][n - 1] = 0; return { grid: g }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length; const land = (i, j, dir) => { let x = i, y = j, d = dir; while (true) { if (d === 'R') y++; else x++; if (x >= m || y >= n) return null; if (!g[x][y]) return [x, y]; d = d === 'R' ? 'D' : 'R'; } }; const memo = new Map(); const ways = (i, j) => { if (i === m - 1 && j === n - 1) return 1; const k = i * n + j; if (memo.has(k)) return memo.get(k); let s = 0; for (const d of ['R', 'D']) { const L = land(i, j, d); if (L) s = (s + ways(L[0], L[1])) % MOD; } memo.set(k, s); return s; }; const total = ways(0, 0); const cells = []; for (let i = m - 1; i >= 0; i--) for (let j = n - 1; j >= 0; j--) if (!g[i][j] && !(i === m - 1 && j === n - 1)) cells.push([i, j]); cells.slice(0, 5).forEach(([i, j]) => { T.at({ grid: G(g, { hl: [[i, j]] }) }); T.n(`Valid paths from (${i},${j}) to the corner?`, ways(i, j), 'Sum the counts of the two landing cells (mirrors bounce you).'); }); return total; }
  });

  D('subsequence-sum-after-capping-elements', {
    t: 'Subsequence Sum After Capping Elements',
    r: 'Sort. For cap x, elements below x keep their value (a subset-sum bitset you grow as x rises), and the c elements ≥ x all become x. Sum k is possible if some j ≤ c has k − j·x reachable by the small elements.',
    g: R => { const n = R.int(2, 6); return { nums: R.ints(n, 1, n), k: R.int(1, 10) }; },
    s(I, T) { const a = I.nums.slice().sort((x, y) => x - y), n = a.length, k = I.k; let reach = new Set([0]), p = 0; const out = []; for (let x = 1; x <= n; x++) { while (p < n && a[p] < x) { const v = a[p++]; [...reach].forEach(s => { if (s + v <= k) reach.add(s + v); }); } const c = n - p; let ok = false; for (let j = 0; j <= c && j * x <= k; j++) if (reach.has(k - j * x)) ok = true; out.push(ok); if (x <= 5) { T.at({ sorted: A(a, { win: [p, n - 1] }), cap: x, smallSums: A([...reach].sort((u, v) => u - v)) }); T.yn(`Can a subsequence sum to ${k} with cap ${x}?`, ok, `${c} capped elements worth ${x} each, plus any reachable small sum.`); } } return out; }
  });

  D('number-of-stable-subsequences', {
    t: 'Number of Stable Subsequences',
    r: 'Track subsequences by their last parity and the length of the final same-parity run (1 or 2). A new element of parity p starts a run of 1 after any opposite-parity subsequence (or alone), or extends a run of 1 to 2; a run of 2 cannot grow.',
    g: R => ({ nums: R.ints(R.int(2, 6), 1, 9) }),
    s(I, T) { const d = [[0, 0], [0, 0]]; I.nums.forEach((x, i) => { const p = x % 2, q = 1 - p; const one = (d[q][0] + d[q][1] + 1) % MOD, two = d[p][0]; d[p][0] = (d[p][0] + one) % MOD; d[p][1] = (d[p][1] + two) % MOD; T.at({ nums: A(I.nums, { i }), state: K([['even run1', d[0][0]], ['even run2', d[0][1]], ['odd run1', d[1][0]], ['odd run2', d[1][1]]]) }); T.n(`Stable subsequences among the first ${i + 1} elements?`, (d[0][0] + d[0][1] + d[1][0] + d[1][1]) % MOD, `${x} starts ${one} new run-1 subsequences and extends ${two} run-1s to run-2.`); }); return (d[0][0] + d[0][1] + d[1][0] + d[1][1]) % MOD; }
  });

  D('climbing-stairs-ii', {
    t: 'Climbing Stairs II',
    r: 'dp[j] = min over i in {j−1, j−2, j−3} (i ≥ 0) of dp[i] + costs[j] + (j − i)². dp[0] = 0; the answer is dp[n].',
    g: R => { const n = R.int(1, 6); return { n, costs: R.ints(n, 1, 9) }; },
    s(I, T) { const n = I.n, c = [0, ...I.costs], dp = [0]; for (let j = 1; j <= n; j++) { dp[j] = Infinity; for (let s = 1; s <= 3 && j - s >= 0; s++) dp[j] = Math.min(dp[j], dp[j - s] + c[j] + s * s); T.at({ costs: A(c, { i: j }), dp: A(dp.slice()) }); T.n(`dp[${j}]?`, dp[j], 'Best of jumping 1, 2 or 3 steps: dp[i] + cost + distance².'); } return dp[n]; }
  });

  D('number-of-zigzag-arrays-i', {
    t: 'Number of ZigZag Arrays I',
    r: 'up[v] = arrays ending at v whose last step went up; down[v] = last step went down. Next up[v] = Σ down[u] for u < v and next down[v] = Σ up[u] for u > v (prefix sums make it O(m) per length).',
    g: R => { const l = R.int(1, 3); return { n: R.int(3, 6), l, r: l + R.int(1, 3) }; },
    s(I, T) { const m = I.r - I.l + 1; let up = range(0, m).map(v => v), dn = range(0, m).map(v => m - 1 - v); for (let len = 3; len <= I.n; len++) { const nu = range(0, m).map(v => sum(dn.slice(0, v)) % MOD), nd = range(0, m).map(v => sum(up.slice(v + 1)) % MOD); up = nu; dn = nd; if (len <= 5) { T.at({ values: A(range(I.l, I.r + 1)), up: A(up), down: A(dn) }); T.n(`Zigzag arrays of length ${len}?`, (sum(up) + sum(dn)) % MOD, 'An up step must follow a down step and vice versa.'); } } return (sum(up) + sum(dn)) % MOD; }
  });

  D('number-of-zigzag-arrays-ii', {
    t: 'Number of ZigZag Arrays II',
    r: 'Same up/down DP as part I, but n is huge and r − l ≤ 74: the step from one length to the next is a fixed linear map on the 2m-length state, so raise that matrix to the power n − 2.',
    g: R => { const l = R.int(1, 3); return { n: R.int(3, 7), l, r: l + R.int(1, 3) }; },
    s(I, T) { const m = I.r - I.l + 1; let up = range(0, m).map(v => v), dn = range(0, m).map(v => m - 1 - v); T.at({ values: A(range(I.l, I.r + 1)), up: A(up), down: A(dn) }); T.n('Size of the state vector the matrix acts on?', 2 * m, 'An up count and a down count for each of the m values.'); for (let len = 3; len <= I.n; len++) { const nu = range(0, m).map(v => sum(dn.slice(0, v)) % MOD), nd = range(0, m).map(v => sum(up.slice(v + 1)) % MOD); up = nu; dn = nd; if (len <= 4) { T.at({ values: A(range(I.l, I.r + 1)), up: A(up), down: A(dn) }); T.n(`Zigzag arrays of length ${len}?`, (sum(up) + sum(dn)) % MOD, 'One application of the transition.'); } } return (sum(up) + sum(dn)) % MOD; }
  });

  D('minimum-operations-to-make-the-array-beautiful', {
    t: 'Minimum Operations to Make the Array Beautiful',
    r: 'DP over the value the previous element ended at. For each reachable previous value p, the current element can become any multiple of p that is at least nums[i]; cost is the increase. Keep the cheapest cost per final value.',
    g: R => ({ nums: R.ints(R.int(1, 5), 1, 9) }),
    s(I, T) { const LIM = 120; let dp = new Map([[I.nums[0], 0]]); for (let i = 1; i < I.nums.length; i++) { const nd = new Map(), x = I.nums[i]; for (const [p, c] of dp) for (let v = Math.ceil(x / p) * p; v <= LIM; v += p) { const cc = c + v - x; if (!nd.has(v) || cc < nd.get(v)) nd.set(v, cc); } dp = nd; T.at({ nums: A(I.nums, { i }), states: K([...dp].sort((a, b) => a[0] - b[0]).slice(0, 6)) }); T.n(`Cheapest total cost after fixing index ${i}?`, Math.min(...dp.values()), 'Raise nums[i] to a multiple of the previous final value.'); } return Math.min(...dp.values()); }
  });

  D('longest-non-decreasing-subarray-after-replacing-at-most-one-element', {
    t: 'Longest Non-Decreasing Subarray After Replacing at Most One Element',
    r: 'left[i] = non-decreasing run ending at i, right[i] = run starting at i. Replacing nums[i] joins left[i−1] and right[i+1] if nums[i−1] ≤ nums[i+1]; otherwise it only extends one side by 1.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6) }),
    s(I, T) { const a = I.nums, n = a.length, L = [], Rr = Array(n); a.forEach((x, i) => L.push(i && a[i - 1] <= x ? L[i - 1] + 1 : 1)); for (let i = n - 1; i >= 0; i--) Rr[i] = i < n - 1 && a[i] <= a[i + 1] ? Rr[i + 1] + 1 : 1; let best = Math.max(...L); for (let i = 0; i < n; i++) { const l = i ? L[i - 1] : 0, r = i < n - 1 ? Rr[i + 1] : 0, v = (i && i < n - 1 && a[i - 1] <= a[i + 1]) ? l + 1 + r : Math.max(l, r) + 1; best = Math.max(best, v); if (i < 6) { T.at({ nums: A(a, { i }), left: A(L), right: A(Rr) }); T.n(`Longest run if nums[${i}] is replaced?`, v, i && i < n - 1 && a[i - 1] <= a[i + 1] ? 'Neighbours fit together: join both runs.' : 'Only one side can be extended.'); } } return best; }
  });

  D('maximum-path-score-in-a-grid', {
    t: 'Maximum Path Score in a Grid',
    r: 'dp[i][j][c] = best score reaching (i, j) with total cost c, coming from the top or left. A 1 costs 1 and scores 1, a 2 costs 1 and scores 2. The answer is the max over c ≤ k at the end, or −1.',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3), g = Array.from({ length: m }, () => R.ints(n, 0, 2)); g[0][0] = 0; return { grid: g, k: R.int(0, 4) }; },
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, K2 = I.k, NEG = -1e9, dp = Array.from({ length: m }, () => Array.from({ length: n }, () => Array(K2 + 1).fill(NEG))); dp[0][0][0] = 0; let asks = 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { if (i || j) { const c = g[i][j] ? 1 : 0; for (let k = c; k <= K2; k++) { const p = Math.max(i ? dp[i - 1][j][k - c] : NEG, j ? dp[i][j - 1][k - c] : NEG); if (p > NEG) dp[i][j][k] = p + g[i][j]; } } if (asks < 5) { asks++; const b = Math.max(...dp[i][j]); T.at({ grid: G(g, { hl: [[i, j]] }), k: K2 }); T.n(`Best score reaching (${i}, ${j}) within cost ${K2}? (−1 if none)`, b > NEG ? b : -1, 'Take the better of top and left at each cost.'); } } const b = Math.max(...dp[m - 1][n - 1]); return b > NEG ? b : -1; }
  });

  D('maximize-cyclic-partition-score', {
    t: 'Maximize Cyclic Partition Score',
    r: 'Choose where the cycle is cut, then run a linear DP: best[j][p] = best score splitting the first j elements into p pieces, adding max − min of the last piece. (The real solution avoids trying every cut by tracking open "max" and "min" picks.)',
    g: R => { const n = R.int(1, 5); return { nums: R.ints(n, 1, 6), k: R.int(1, n) }; },
    s(I, T) { const n = I.nums.length; let best = 0; for (let s = 0; s < n; s++) { const a = [...I.nums.slice(s), ...I.nums.slice(0, s)], dp = Array.from({ length: n + 1 }, () => Array(I.k + 1).fill(-Infinity)); dp[0][0] = 0; for (let j = 1; j <= n; j++) for (let p = 1; p <= I.k; p++) for (let i = 0; i < j; i++) if (dp[i][p - 1] > -Infinity) { const seg = a.slice(i, j); dp[j][p] = Math.max(dp[j][p], dp[i][p - 1] + Math.max(...seg) - Math.min(...seg)); } const b = Math.max(...dp[n]); best = Math.max(best, b); if (s < 4) { T.at({ nums: A(a), cut: s, k: I.k }); T.n(`Best score when the cycle is cut before index ${s}?`, b, 'Linear DP over at most k pieces.'); } } return best; }
  });

  D('total-waviness-of-numbers-in-range-i', {
    t: 'Total Waviness of Numbers in Range I',
    r: 'The range is at most 1e5 numbers, so check each: for every inner digit, count it if it is strictly above or strictly below both neighbours. Add everything up.',
    g: R => { const a = R.int(100, 9900); return { num1: a, num2: a + R.int(0, 6) }; },
    s(I, T) { const w = x => { const d = String(x); let c = 0; for (let i = 1; i < d.length - 1; i++) if ((d[i] > d[i - 1] && d[i] > d[i + 1]) || (d[i] < d[i - 1] && d[i] < d[i + 1])) c++; return c; }; let tot = 0; for (let x = I.num1; x <= I.num2; x++) { const v = w(x); tot += v; if (x - I.num1 < 5) { T.at({ digits: A(String(x).split('')), total: tot - v }); T.n(`Waviness of ${x}?`, v, 'Peaks and valleys among the inner digits.'); } } return tot; }
  });

  D('total-waviness-of-numbers-in-range-ii', {
    t: 'Total Waviness of Numbers in Range II',
    r: 'Up to 1e15: digit DP for f(N) = total waviness of 1..N, state (position, previous two digits, tight, started), returning (count of numbers, total waviness). The answer is f(num2) − f(num1 − 1).',
    g: R => { const a = R.int(100, 9900); return { num1: a, num2: a + R.int(0, 8) }; },
    s(I, T) { const w = x => { const d = String(x); let c = 0; for (let i = 1; i < d.length - 1; i++) if ((d[i] > d[i - 1] && d[i] > d[i + 1]) || (d[i] < d[i - 1] && d[i] < d[i + 1])) c++; return c; }; let tot = 0; for (let x = I.num1; x <= I.num2; x++) tot += w(x); const f = N => { let t = 0; for (let x = Math.max(100, Math.floor(N / 10) * 10); x <= N; x++) t += w(x); return t; }; T.at({ num1: I.num1, num2: I.num2 }); T.c('How is the answer split?', ['f(num2) − f(num1 − 1)', 'f(num2) − f(num1)', 'f(num2) + f(num1)'], 'f(num2) − f(num1 − 1)', 'Prefix totals make the range inclusive.'); [I.num1, I.num2].forEach(x => { T.at({ digits: A(String(x).split('')) }); T.n(`Waviness of ${x}?`, w(x), 'A digit counts when it is a strict peak or valley.'); }); return tot; }
  });
})();
