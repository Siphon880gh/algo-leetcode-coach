/* v2 games: dp (17). Guides scored in the 3483–4041 pass. */
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

  D('number-of-balanced-integers-in-a-range', {
    t: 'Number of Balanced Integers in a Range',
    r: 'Digit DP for count(≤ N): state (position, odd-sum − even-sum offset, tight, started), counting numbers with at least two digits whose offset ends at 0. The answer is count(high) − count(low − 1).',
    g: R => { const a = R.int(1, 990); return { low: a, high: a + R.int(0, 15) }; },
    s(I, T) { const bal = x => { const d = String(x); if (d.length < 2) return false; let e = 0; d.split('').forEach((c, i) => e += (i % 2 ? -1 : 1) * Number(c)); return e === 0; }; let c = 0; const hits = []; for (let x = I.low; x <= I.high; x++) if (bal(x)) { c++; hits.push(x); } const probe = [I.low, I.high, hits[0]].filter((x, i, s) => x !== undefined && s.indexOf(x) === i); probe.forEach(x => { const d = String(x).split(''); T.at({ digits: A(d) }); T.yn(`Is ${x} balanced?`, bal(x), `Odd positions sum ${sum(d.filter((_, i) => !(i % 2)).map(Number))}, even positions ${sum(d.filter((_, i) => i % 2).map(Number))}.`); }); T.at({ low: I.low, high: I.high }); T.n('Balanced integers in the range?', c, 'count(high) − count(low − 1).'); return c; }
  });

  D('count-routes-to-climb-a-rectangular-grid', {
    t: 'Count Routes to Climb a Rectangular Grid',
    r: 'Process rows bottom to top. arrive[c] = ways to enter (r, c). A route may then make one sideways move within distance d: fin[c] = arrive[c] + Σ arrive[c\'] over open c\' ≠ c with |c − c\'| ≤ d. Moving up needs (Δc)² + 1 ≤ d². Sliding-window prefix sums make each row O(m).',
    g: R => { const n = R.int(1, 3), m = R.int(1, 3); return { grid: Array.from({ length: n }, () => R.str(m, '..#')), d: R.int(1, 2) }; },
    s(I, T) { const g = I.grid, n = g.length, m = g[0].length, d = I.d; let arr = range(0, m).map(c => g[n - 1][c] === '.' ? 1 : 0), fin = []; for (let r = n - 1; r >= 0; r--) { if (r < n - 1) { const nx = range(0, m).map(c => g[r][c] !== '.' ? 0 : sum(range(0, m).filter(c2 => (c - c2) * (c - c2) + 1 <= d * d).map(c2 => fin[c2])) % MOD); arr = nx; } fin = range(0, m).map(c => g[r][c] !== '.' ? 0 : (arr[c] + sum(range(0, m).filter(c2 => c2 !== c && Math.abs(c - c2) <= d && g[r][c2] === '.').map(c2 => arr[c2]))) % MOD); T.at({ grid: G(g.map(row => row.split('')), { row: r }), arrive: A(arr), afterSideStep: A(fin) }); T.n(`Total ways to be in row ${r} (after its optional sideways move)?`, sum(fin) % MOD, 'Arrivals plus one sideways move within distance d.'); } return sum(fin) % MOD; }
  });

  D('minimum-cost-to-merge-sorted-lists', {
    t: 'Minimum Cost to Merge Sorted Lists',
    r: 'The merged content of any subset of lists is fixed, so its length and median are too. Bitmask DP: dp[mask] = min over splitting mask into A and B of dp[A] + dp[B] + len(A) + len(B) + |med(A) − med(B)|.',
    g: R => ({ lists: Array.from({ length: R.int(2, 4) }, () => R.ints(R.int(1, 3), 1, 9).sort((a, b) => a - b)) }),
    s(I, T) { const k = I.lists.length, F = (1 << k) - 1, all = [], dp = Array(1 << k).fill(Infinity); for (let m = 1; m <= F; m++) all[m] = [].concat(...I.lists.filter((_, i) => m >> i & 1)).sort((a, b) => a - b); const med = m => all[m][(all[m].length - 1) >> 1]; for (let i = 0; i < k; i++) dp[1 << i] = 0; let asks = 0; for (let m = 1; m <= F; m++) { if (!(m & (m - 1))) continue; for (let a = (m - 1) & m; a; a = (a - 1) & m) { const b = m ^ a; if (a < b) continue; dp[m] = Math.min(dp[m], dp[a] + dp[b] + all[m].length + Math.abs(med(a) - med(b))); } if (asks++ < 4 || m === F) { T.at({ lists: A(I.lists.map(l => '[' + l + ']'), { hl: range(0, k).filter(i => m >> i & 1) }), merged: A(all[m]) }); T.n(`Cheapest cost to merge the highlighted lists into one?`, dp[m], 'Best split into two groups merged last.'); } } return dp[F]; }
  });

  D('number-of-alternating-xor-partitions', {
    t: 'Number of Alternating XOR Partitions',
    r: 'With prefix XOR P, a block (j, i] has XOR P[i] ⊕ P[j]. f[i] = partitions of the prefix ending in a target1 block, g[i] = ending in target2. Hash maps keyed by P[j] give f[i] = (start or g-ways at P[i]⊕t1) and g[i] = f-ways at P[i]⊕t2.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 3), target1: R.int(0, 3), target2: R.int(0, 3) }),
    s(I, T) { if (I.target1 === I.target2) I.target2 = (I.target1 + 1) % 4; const mf = new Map(), mg = new Map([[0, 1]]); let p = 0, f = 0, g = 0; I.nums.forEach((x, i) => { p ^= x; f = (mg.get(p ^ I.target1) || 0) % MOD; g = (mf.get(p ^ I.target2) || 0) % MOD; mf.set(p, ((mf.get(p) || 0) + f) % MOD); mg.set(p, ((mg.get(p) || 0) + g) % MOD); if (i < 6) { T.at({ nums: A(I.nums, { i }), prefixXor: p, t1: I.target1, t2: I.target2 }); T.n(`Valid partitions of nums[0..${i}] whose last block has XOR target1?`, f, 'Earlier cuts with prefix P ⊕ target1, after a target2 block or at the start.'); } }); return (f + g) % MOD; }
  });

  D('minimum-partition-score', {
    t: 'Minimum Partition Score',
    r: 'dp[j][i] = min over p < i of dp[j−1][p] + v(P[i] − P[p]) with v(x) = x(x+1)/2. The cost is convex in the split, so divide-and-conquer optimization (or a convex hull trick) speeds up each layer.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 1, 6), k: R.int(1, n) }; },
    s(I, T) { const n = I.nums.length, P = [0]; I.nums.forEach(x => P.push(P[P.length - 1] + x)); const v = x => x * (x + 1) / 2; let prev = range(0, n + 1).map(i => i ? Infinity : 0); for (let j = 1; j <= I.k; j++) { const cur = Array(n + 1).fill(Infinity); for (let i = j; i <= n; i++) for (let p = j - 1; p < i; p++) if (prev[p] < Infinity) cur[i] = Math.min(cur[i], prev[p] + v(P[i] - P[p])); prev = cur; if (j <= 4) { T.at({ nums: A(I.nums), [`dp with ${j} part(s)`]: A(cur.map(x => x === Infinity ? '∞' : x)) }); T.n(`Best score splitting the whole array into ${j} part(s)?`, cur[n], 'Try every start of the last part.'); } } return prev[n]; }
  });

  D('longest-alternating-subarray-after-removing-at-most-one-element', {
    t: 'Longest Alternating Subarray After Removing at Most One Element',
    r: 'Compute the alternating run ending at each index (by last direction) from the left, and starting at each index from the right. Removing index i lets the run ending at i−1 join the run starting at i+1 when nums[i−1], nums[i+1] differ and the directions keep alternating.',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 5) }),
    s(I, T) { const alt = a => { let best = 1; for (let i = 0; i < a.length; i++) { let L = 1; for (let j = i + 1; j < a.length; j++) { if (a[j] === a[j - 1]) break; if (j - i >= 2 && Math.sign(a[j] - a[j - 1]) === Math.sign(a[j - 1] - a[j - 2])) break; L++; } best = Math.max(best, L); } return best; }; const base = alt(I.nums); let best = base; T.at({ nums: A(I.nums) }); T.n('Longest alternating subarray without removing anything?', base, 'Comparisons must flip between < and >.'); range(0, I.nums.length).forEach(i => { const r = alt([...I.nums.slice(0, i), ...I.nums.slice(i + 1)]); best = Math.max(best, r); if (i < 4) { T.at({ nums: A(I.nums, { dim: [i] }) }); T.n(`Longest alternating subarray after removing index ${i}?`, r, 'Join the runs on both sides if they fit.'); } }); return best; }
  });

  D('maximum-score-using-exactly-k-pairs', {
    t: 'Maximum Score Using Exactly K Pairs',
    r: 'dp[i][j][t] = best score using the first i of nums1 and first j of nums2 with t pairs: skip nums1[i−1], skip nums2[j−1], or pair them. Values can be negative, so unreachable states are −∞ and exactly k pairs are required.',
    g: R => { const n = R.int(1, 4), m = R.int(1, 4); return { nums1: R.ints(n, -4, 5), nums2: R.ints(m, -4, 5), k: R.int(1, Math.min(n, m)) }; },
    s(I, T) { const a = I.nums1, b = I.nums2, n = a.length, m = b.length, K2 = I.k, NEG = -Infinity, dp = Array.from({ length: n + 1 }, () => Array.from({ length: m + 1 }, () => Array(K2 + 1).fill(NEG))); for (let i = 0; i <= n; i++) for (let j = 0; j <= m; j++) dp[i][j][0] = 0; for (let i = 1; i <= n; i++) for (let j = 1; j <= m; j++) for (let t = 1; t <= K2; t++) dp[i][j][t] = Math.max(dp[i - 1][j][t], dp[i][j - 1][t], dp[i - 1][j - 1][t - 1] + a[i - 1] * b[j - 1]); for (let t = 1; t <= K2; t++) { T.at({ nums1: A(a), nums2: A(b) }); T.n(`Best total with exactly ${t} pair(s)?`, dp[n][m][t], 'Skip from either array or pair the current two.'); } if (K2 === 1) { T.at({ nums1: A(a), nums2: A(b) }); T.n('Best single product?', dp[n][m][1], 'Any i with any j.'); } return dp[n][m][K2]; }
  });

  D('house-robber-v', {
    t: 'House Robber V',
    r: 'Keep two states per house: take[i] = nums[i] + max(skip[i−1], take[i−1] if the colors differ), skip[i] = max(take[i−1], skip[i−1]).',
    g: R => { const n = R.int(1, 7); return { nums: R.ints(n, 1, 9), colors: R.ints(n, 1, 2) }; },
    s(I, T) { let tk = 0, sk = 0; I.nums.forEach((x, i) => { const nt = x + Math.max(sk, i && I.colors[i] !== I.colors[i - 1] ? tk : (i ? -Infinity : 0)), ns = Math.max(tk, sk); tk = nt; sk = ns; T.at({ nums: A(I.nums, { i }), colors: A(I.colors, { i }) }); T.n(`Best total if house ${i} is robbed?`, tk, i && I.colors[i] === I.colors[i - 1] ? 'Same color as the previous house: it must be skipped.' : 'Different color: the previous house may be robbed too.'); }); return Math.max(tk, sk); }
  });

  D('longest-almost-palindromic-substring', {
    t: 'Longest Almost-Palindromic Substring',
    r: 'Expand around each center; when the two ends first differ, try skipping the left or the right character and keep expanding. The longest span reached (with exactly one removal, so length ≥ 2) is the answer.',
    g: R => ({ s: R.str(R.int(2, 8), 'abc') }),
    s(I, T) { const s = I.s, n = s.length, isP = x => x === x.split('').reverse().join(''), ok = x => x.length >= 2 && range(0, x.length).some(i => isP(x.slice(0, i) + x.slice(i + 1))); let best = 0; for (let i = 0; i < n; i++) { let b = 0; for (let j = i + 1; j < n; j++) if (ok(s.slice(i, j + 1))) b = j - i + 1; best = Math.max(best, b); if (i < 5) { T.at({ s: A(s.split(''), { i }) }); T.n(`Longest almost-palindromic substring starting at ${i}? (0 if none)`, b, 'Removing one character must leave a palindrome.'); } } return best; }
  });

  D('count-sequences-to-k', {
    t: 'Count Sequences to K',
    r: 'Every number is at most 6, so the value is always 2^a·3^b·5^c with integer (possibly negative) exponents. DP over a map from (a, b, c) to the number of ways; each step multiplies, divides or skips. Answer the count at k\'s exponents (0 if k has another prime).',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 6), k: R.pick([1, 2, 3, 4, 6, 12, 5, 10, 7]) }),
    s(I, T) { const ex = x => { const e = [0, 0, 0]; [2, 3, 5].forEach((p, i) => { while (x % p === 0) { x /= p; e[i]++; } }); return [e, x]; }; let dp = new Map([['0,0,0', 1]]); I.nums.forEach((x, i) => { const [e] = ex(x), nd = new Map(); for (const [key, c] of dp) { const v = key.split(',').map(Number); [[0, 0, 0], e, e.map(y => -y)].forEach(d => { const k2 = v.map((y, j) => y + d[j]).join(','); nd.set(k2, (nd.get(k2) || 0) + c); }); } dp = nd; if (i < 5) { T.at({ nums: A(I.nums, { i }), states: K([...dp].slice(0, 6)) }); T.n(`Distinct values reachable after index ${i}?`, dp.size, 'Each state is a triple of exponents of 2, 3, 5.'); } }); const [ke, rest] = ex(I.k); return rest !== 1 ? 0 : dp.get(ke.join(',')) || 0; }
  });

  D('minimum-cost-to-partition-a-binary-string', {
    t: 'Minimum Cost to Partition a Binary String',
    r: 'Recurse on segments: a segment costs flatCost with no sensitive elements, else L × X × encCost. If its length is even, it may instead split into two halves, each solved the same way. Prefix counts give X in O(1).',
    g: R => ({ s: R.str(R.pick([1, 2, 4, 8, 3, 6]), '01'), encCost: R.int(1, 4), flatCost: R.int(1, 9) }),
    s(I, T) { const P = [0]; I.s.split('').forEach(c => P.push(P[P.length - 1] + (c === '1' ? 1 : 0))); let asks = 0; const go = (l, L) => { const X = P[l + L] - P[l], base = X ? L * X * I.encCost : I.flatCost; let best = base; if (L % 2 === 0) best = Math.min(base, go(l, L / 2) + go(l + L / 2, L / 2)); if (asks++ < 5 && L > 1) { T.at({ s: A(I.s.split(''), { win: [l, l + L - 1] }), enc: I.encCost, flat: I.flatCost }); T.n(`Cheapest cost for s[${l}..${l + L - 1}]?`, best, L % 2 ? `Odd length: must pay ${base}.` : `Keep (${base}) or split into halves.`); } return best; }; const ans = go(0, I.s.length); if (asks < 2) { T.at({ s: A(I.s.split('')) }); T.n('Cost of the whole string?', ans, 'A single element cannot split.'); } return ans; }
  });

  D('count-fancy-numbers-in-a-range', {
    t: 'Count Fancy Numbers in a Range',
    r: 'Strictly monotone numbers are few (subsets of digits), so count them in [l, r] directly. For the digit-sum condition, a digit DP counts numbers whose digit sum is one of the good sums (≤ 135), and inclusion–exclusion avoids double counting.',
    g: R => { const a = R.int(1, 300); return { l: a, r: a + R.int(0, 12) }; },
    s(I, T) { const good = x => { const d = String(x); if (d.length === 1) return true; let inc = true, dec = true; for (let i = 1; i < d.length; i++) { if (d[i] <= d[i - 1]) inc = false; if (d[i] >= d[i - 1]) dec = false; } return inc || dec; }, ds = x => sum(String(x).split('').map(Number)), fancy = x => good(x) || good(ds(x)); let c = 0; for (let x = I.l; x <= I.r; x++) if (fancy(x)) c++; [I.l, I.r].filter((x, i, s) => s.indexOf(x) === i).forEach(x => { T.at({ digits: A(String(x).split('')), digitSum: ds(x) }); T.yn(`Is ${x} fancy?`, fancy(x), good(x) ? 'Its digits are strictly monotone.' : good(ds(x)) ? `Its digit sum ${ds(x)} is good.` : 'Neither the number nor its digit sum is monotone.'); }); T.at({ l: I.l, r: I.r }); T.n('Fancy numbers in the range?', c, 'Monotone numbers plus numbers with a good digit sum.'); return c; }
  });

  D('minimum-removals-to-achieve-target-xor', {
    t: 'Minimum Removals to Achieve Target XOR',
    r: 'DP over XOR values: best[x] = most elements we can keep with XOR x (−∞ if unreachable). Each element either is removed or keeps x → x ⊕ v with one more kept. Answer n − best[target], or −1.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 7), target: R.int(0, 7) }),
    s(I, T) { const M = 16384; let dp = new Map([[0, 0]]); I.nums.forEach((v, i) => { const nd = new Map(dp); for (const [x, c] of dp) { const y = x ^ v; if (!nd.has(y) || nd.get(y) < c + 1) nd.set(y, c + 1); } dp = nd; if (i < 6) { T.at({ nums: A(I.nums, { i }), best: K([...dp].sort((a, b) => a[0] - b[0]).slice(0, 8)) }); T.n(`Most elements kept with XOR ${I.target} using the first ${i + 1}? (−1 if impossible)`, dp.has(I.target) ? dp.get(I.target) : -1, `Keep ${v} (x → x ⊕ ${v}) or remove it.`); } }); return dp.has(I.target) ? I.nums.length - dp.get(I.target) : -1; }
  });

  D('minimum-xor-path-in-a-grid', {
    t: 'Minimum XOR Path in a Grid',
    r: 'XOR is not monotone, so keep every reachable value: each cell holds a set (bitset of 1024) of XORs from top and left paths, XORed with its own value. The answer is the smallest value in the last cell.',
    g: R => ({ grid: R.grid(R.int(1, 3), R.int(1, 3), 0, 7) }),
    s(I, T) { const g = I.grid, m = g.length, n = g[0].length, S = Array.from({ length: m }, () => Array(n)); let asks = 0; for (let i = 0; i < m; i++) for (let j = 0; j < n; j++) { let from = !i && !j ? new Set([0]) : new Set([...(i ? S[i - 1][j] : []), ...(j ? S[i][j - 1] : [])]); S[i][j] = new Set([...from].map(x => x ^ g[i][j])); if ((i || j) && asks++ < 5) { T.at({ grid: G(g, { hl: [[i, j]] }), values: A([...S[i][j]].sort((a, b) => a - b)) }); T.n(`How many different XOR values can reach (${i}, ${j})?`, S[i][j].size, 'Union of top and left sets, XORed with this cell.'); } } if (asks < 2) { T.at({ grid: G(g) }); T.n('XOR of the only path?', Math.min(...S[m - 1][n - 1]), 'With one row or column there is one path.'); } return Math.min(...S[m - 1][n - 1]); }
  });

  D('count-non-decreasing-arrays-with-given-digit-sums', {
    t: 'Count Non-Decreasing Arrays With Given Digit Sums',
    r: 'For each position list the values ≤ 5000 with the required digit sum (sorted). ways[v] for the current position = Σ ways of previous values ≤ v; a running prefix sum over the merged sorted lists makes each step linear.',
    g: R => ({ digitSum: R.ints(R.int(1, 3), 1, 6) }),
    s(I, T) { const ds = x => sum(String(x).split('').map(Number)), by = d => range(0, 5001).filter(x => ds(x) === d); let prevV = [], prevW = [], first = true; I.digitSum.forEach((d, i) => { const vs = by(d); let w; if (first) w = vs.map(() => 1); else { let p = 0, acc = 0; w = vs.map(v => { while (p < prevV.length && prevV[p] <= v) acc = (acc + prevW[p++]) % MOD; return acc; }); } first = false; prevV = vs; prevW = w; T.at({ digitSum: A(I.digitSum, { i }), candidates: A(vs.slice(0, 8).concat(vs.length > 8 ? ['…'] : [])) }); T.n(`Valid prefixes ending at index ${i}?`, sum(w) % MOD, `${vs.length} values have digit sum ${d}; each takes the ways of previous values ≤ it.`); }); return sum(prevW) % MOD; }
  });

  D('minimum-increase-to-maximize-special-indices', {
    t: 'Minimum Increase to Maximize Special Indices',
    r: 'Making i special costs max(0, max(nums[i−1], nums[i+1]) + 1 − nums[i]), and special indices cannot be adjacent. The most we can get is ⌊(n−1)/2⌋. DP over i: (count, cost) taking i (jump from i−2) or skipping it, preferring more specials, then less cost.',
    g: R => ({ nums: R.ints(R.int(3, 7), 1, 6) }),
    s(I, T) { const a = I.nums, n = a.length, c = i => Math.max(0, Math.max(a[i - 1], a[i + 1]) + 1 - a[i]), better = (x, y) => x[0] > y[0] || (x[0] === y[0] && x[1] < y[1]) ? x : y, dp = Array(n).fill([0, 0]); for (let i = 1; i < n - 1; i++) { const take = [(i >= 2 ? dp[i - 2][0] : 0) + 1, (i >= 2 ? dp[i - 2][1] : 0) + c(i)]; dp[i] = better(take, dp[i - 1]); if (i < 6) { T.at({ nums: A(a, { i }), [`cost to make ${i} special`]: c(i) }); T.n(`Cost to make index ${i} special?`, c(i), 'Rise one above the taller neighbour.'); } } const best = dp[n - 2]; T.at({ nums: A(a) }); T.n('Most special indices possible?', best[0], '⌊(n − 1) / 2⌋, never adjacent.'); return best[1]; }
  });

  D('minimum-operations-to-achieve-at-least-k-peaks', {
    t: 'Minimum Operations to Achieve at Least K Peaks',
    r: 'Peaks can never be adjacent on the circle, so more than ⌊n/2⌋ is impossible. Each index has a cost to become a peak. Choose k non-adjacent indices with minimum total cost: run a DP twice (index 0 unused, or index 0 used and n−1 unused).',
    g: R => ({ nums: R.ints(R.int(2, 7), 1, 6), k: R.int(0, 3) }),
    s(I, T) { const a = I.nums, n = a.length, c = i => Math.max(0, Math.max(a[(i - 1 + n) % n], a[(i + 1) % n]) + 1 - a[i]); T.at({ nums: A(a), k: I.k }); T.yn('Is k peaks possible on this circle?', I.k <= Math.floor(n / 2), `At most ⌊${n}/2⌋ = ${Math.floor(n / 2)} non-adjacent peaks.`); if (I.k > Math.floor(n / 2)) return -1; if (!I.k) return 0; range(0, Math.min(n, 3)).forEach(i => { T.at({ nums: A(a, { i }) }); T.n(`Cost to make index ${i} a peak?`, c(i), 'Rise one above the taller circular neighbour.'); }); const run = (lo, hi) => { const INF = Infinity, L = hi - lo + 1; let p2 = Array(I.k + 1).fill(INF), p1 = Array(I.k + 1).fill(INF); p2[0] = 0; p1[0] = 0; for (let t = 0; t < L; t++) { const i = lo + t, cur = p1.slice(); for (let j = 1; j <= I.k; j++) if (p2[j - 1] < INF) cur[j] = Math.min(cur[j], p2[j - 1] + c(i)); p2 = p1; p1 = cur; } return p1[I.k]; }; if (n === 2) return Math.min(c(0), c(1)); return Math.min(run(1, n - 1), c(0) + (I.k === 1 ? 0 : (() => { const sub = I.k - 1, INF = Infinity; let p2 = Array(sub + 1).fill(INF), p1 = Array(sub + 1).fill(INF); p2[0] = 0; p1[0] = 0; for (let i = 2; i <= n - 2; i++) { const cur = p1.slice(); for (let j = 1; j <= sub; j++) if (p2[j - 1] < INF) cur[j] = Math.min(cur[j], p2[j - 1] + c(i)); p2 = p1; p1 = cur; } return p1[sub]; })())); }
  });

  D('count-good-integers-on-a-grid-path', {
    t: 'Count Good Integers on a Grid Path',
    r: 'Only the 7 cells on the path matter, and they must be non-decreasing. A digit DP over the 16 padded digits (tight flag, last path digit) counts good numbers ≤ N; answer f(r) − f(l − 1).',
    g: R => { const a = R.int(1, 99); return { l: a, r: a + R.int(0, 15), directions: R.shuffle('DDDRRR'.split('')).join('') }; },
    s(I, T) { const path = [0]; let r = 0, c = 0; I.directions.split('').forEach(d => { if (d === 'D') r++; else c++; path.push(r * 4 + c); }); const good = x => { const s = String(x).padStart(16, '0'), v = path.map(p => +s[p]); return v.every((d, i) => !i || d >= v[i - 1]); }; T.at({ directions: I.directions }); T.c('Which grid cells (row-major index) does the path visit?', [path.join(','), [0, 1, 2, 3, 7, 11, 15].join(','), [0, 4, 8, 12, 13, 14, 15].join(',')], path.join(','), 'Follow D (+4) and R (+1) from cell 0.'); let cnt = 0; for (let x = I.l; x <= I.r; x++) if (good(x)) cnt++; [I.l, I.r].filter((x, i, s) => s.indexOf(x) === i).forEach(x => { T.at({ padded: String(x).padStart(16, '0') }); T.yn(`Is ${x} good?`, good(x), 'Digits along the path must never decrease.'); }); return cnt; }
  });

  D('maximum-sum-of-alternating-subsequence-with-distance-at-least-k', {
    t: 'Maximum Sum of Alternating Subsequence With Distance at Least K',
    r: 'up[i] = best sum ending at i where the last step went up (previous value smaller), down[i] the opposite. up[i] = nums[i] + max(nums-alone, down[j]) over j ≤ i − k with nums[j] < nums[i]. Segment trees keyed by value over the indices that became eligible give O(n log n).',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 6), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, up = Array(n), dn = Array(n); let best = 0; for (let i = 0; i < n; i++) { up[i] = a[i]; dn[i] = a[i]; for (let j = 0; j <= i - I.k; j++) { if (a[j] < a[i]) up[i] = Math.max(up[i], dn[j] + a[i]); if (a[j] > a[i]) dn[i] = Math.max(dn[i], up[j] + a[i]); } best = Math.max(best, up[i], dn[i]); if (i < 6) { T.at({ nums: A(a, { i }), up: A(up.slice(0, i + 1)), down: A(dn.slice(0, i + 1)), k: I.k }); T.n(`Best score ending at index ${i}?`, Math.max(up[i], dn[i]), 'Extend a sequence that ended at least k earlier with the opposite direction.'); } } return best; }
  });

  D('number-of-zigzag-arrays-iii', {
    t: 'Number of ZigZag Arrays III',
    r: 'r − l is huge but n ≤ 200: the count of zigzag arrays over m values is a polynomial in m of degree ≤ n. Compute it with the up/down prefix-sum DP for m = 2 … n + 2 and evaluate at the real m by Lagrange interpolation.',
    g: R => { const l = R.int(1, 3); return { n: R.int(3, 6), l, r: l + R.int(1, 3) }; },
    s(I, T) { const f = (m, n) => { let up = range(0, m).map(v => v), dn = range(0, m).map(v => m - 1 - v); for (let len = 3; len <= n; len++) { const nu = range(0, m).map(v => sum(dn.slice(0, v)) % MOD), nd = range(0, m).map(v => sum(up.slice(v + 1)) % MOD); up = nu; dn = nd; } return (sum(up) + sum(dn)) % MOD; }; const m = I.r - I.l + 1; [2, 3].forEach(x => { T.at({ n: I.n, values: x }); T.n(`Zigzag arrays of length ${I.n} using ${x} values?`, f(x, I.n), 'A sample point for the interpolation.'); }); T.at({ n: I.n, values: m }); T.n(`Zigzag arrays with ${m} values?`, f(m, I.n), 'Evaluate the polynomial at m.'); return f(m, I.n); }
  });

  D('minimum-partition-score-ii', {
    t: 'Minimum Partition Score II',
    r: 'Same cost as part I, but n is 5·10^4. The best score is convex in the number of parts, so use the Aliens trick: add a penalty λ per part, solve the unconstrained DP with a convex hull, and binary search λ until the DP uses k parts.',
    g: R => { const n = R.int(1, 6); return { nums: R.ints(n, 1, 6), k: R.int(1, n) }; },
    s(I, T) { const n = I.nums.length, P = [0]; I.nums.forEach(x => P.push(P[P.length - 1] + x)); const v = x => x * (x + 1) / 2, layers = []; let prev = range(0, n + 1).map(i => i ? Infinity : 0); for (let j = 1; j <= n; j++) { const cur = Array(n + 1).fill(Infinity); for (let i = j; i <= n; i++) for (let p = j - 1; p < i; p++) if (prev[p] < Infinity) cur[i] = Math.min(cur[i], prev[p] + v(P[i] - P[p])); layers.push(cur[n]); prev = cur; } T.at({ nums: A(I.nums), prefix: A(P) }); T.n('Score with a single part?', layers[0], 'S(S+1)/2 of the whole sum.'); if (n > 1) T.n('Score with two parts?', layers[1], 'Best single cut.'); T.c('How does the best score change as parts increase?', ['never increases (convex)', 'always increases', 'random'], 'never increases (convex)', 'Splitting a part never raises s(s+1)/2 totals, with shrinking gains.'); return layers[I.k - 1]; }
  });

  D('maximum-sum-of-m-non-overlapping-subarrays-i', {
    t: 'Maximum Sum of M Non-Overlapping Subarrays I',
    r: 'dp[j][i] = best sum of exactly j subarrays inside the first i elements. Either skip element i, or end a subarray at i of length L in [l, r]: dp[j−1][i−L] + P[i] − P[i−L]. Take the best over j = 1..m at i = n. O(n·m·(r − l)) fits n ≤ 1000.',
    g: R => { const n = R.int(1, 6), l = R.int(1, n); return { nums: R.ints(n, -5, 8), m: R.int(1, 3), l, r: R.int(l, n) }; },
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); let prev = Array(n + 1).fill(0), best = -Infinity; for (let j = 1; j <= I.m; j++) { const cur = Array(n + 1).fill(-Infinity); for (let i = 1; i <= n; i++) { cur[i] = cur[i - 1]; for (let L = I.l; L <= Math.min(I.r, i); L++) if (prev[i - L] > -Infinity) cur[i] = Math.max(cur[i], prev[i - L] + P[i] - P[i - L]); } best = Math.max(best, cur[n]); if (j <= 3) { T.at({ nums: A(a), prefix: A(P), count: j, l: I.l, r: I.r }); T.n(`Best total using exactly ${j} subarray${j > 1 ? 's' : ''}? (−999 if impossible)`, cur[n] === -Infinity ? -999 : cur[n], 'Skip an element, or close a subarray of allowed length there.'); } prev = cur; } return best; }
  });

  D('maximum-sum-of-m-non-overlapping-subarrays-ii', {
    t: 'Maximum Sum of M Non-Overlapping Subarrays II',
    r: 'Same DP, but n is 10^5. For layer j, dp[j−1][i−L] − P[i−L] over L in [l, r] is a sliding-window maximum, so keep a monotonic deque per layer, and use the Aliens trick (a per-subarray penalty) to avoid the m layers.',
    g: R => { const n = R.int(1, 6), l = R.int(1, n); return { nums: R.ints(n, -5, 8), m: R.int(1, 3), l, r: R.int(l, n) }; },
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); let prev = Array(n + 1).fill(0), best = -Infinity; for (let j = 1; j <= I.m; j++) { const cur = Array(n + 1).fill(-Infinity); for (let i = 1; i <= n; i++) { cur[i] = cur[i - 1]; let w = -Infinity; for (let L = I.l; L <= Math.min(I.r, i); L++) if (prev[i - L] > -Infinity) w = Math.max(w, prev[i - L] - P[i - L]); if (w > -Infinity) cur[i] = Math.max(cur[i], w + P[i]); if (j === 1 && i <= 4) { T.at({ prefix: A(P, { i }), window: `start in [${Math.max(0, i - I.r)}, ${i - I.l}]` }); T.n(`Window max of −P[start] for a subarray ending at ${i}? (−999 if empty)`, w === -Infinity ? -999 : w, 'Deque front after pushing and popping.'); } } best = Math.max(best, cur[n]); prev = cur; } return best; }
  });

  D('maximum-subarray-sum-after-multiplier', {
    t: 'Maximum Subarray Sum After Multiplier',
    r: 'Kadane with three phases: before the operated block, inside it, after it. Inside, each element contributes x·k (or x divided by k, rounded toward zero). Run it once for multiply and once for divide, and take the best non-empty sum.',
    g: R => ({ nums: R.ints(R.int(1, 6), -6, 6), k: R.int(1, 3) }),
    s(I, T) { const a = I.nums, n = a.length, div = x => x >= 0 ? Math.floor(x / I.k) : Math.ceil(x / I.k), kad = b => { let best = -Infinity, cur = -Infinity; b.forEach(x => { cur = Math.max(x, cur + x); best = Math.max(best, cur); }); return best; }; let bm = -Infinity, bd = -Infinity; for (let l = 0; l < n; l++) for (let r = l; r < n; r++) { bm = Math.max(bm, kad(a.map((x, i) => i >= l && i <= r ? x * I.k : x))); bd = Math.max(bd, kad(a.map((x, i) => i >= l && i <= r ? div(x) : x))); } T.at({ nums: A(a), k: I.k }); T.n('Best subarray sum with no change (plain Kadane)?', kad(a), 'Baseline.'); T.n('Best sum if you multiply a block by k?', bm, 'Three-phase Kadane: before, inside (×k), after.'); T.n('Best sum if you divide a block by k?', bd, 'Same, with x/k rounded toward zero inside.'); return Math.max(bm, bd); }
  });

  D('count-distinct-ways-to-form-target-from-two-strings', {
    t: 'Count Distinct Ways to Form Target From Two Strings',
    r: 'f[t][i][j] counts ways to build target[t..] using word1 from index i and word2 from index j; with suffix sums over i and j each state is O(1). Count all ways, then subtract the ways using only word1 and only word2 (plain subsequence counts).',
    g: R => ({ word1: R.str(R.int(1, 4), 'ab'), word2: R.str(R.int(1, 4), 'ab'), target: R.str(R.int(1, 3), 'ab') }),
    s(I, T) { const w1 = I.word1, w2 = I.word2, tg = I.target, memo = new Map(), f = (t, i, j) => { if (t === tg.length) return 1; const k = t + ',' + i + ',' + j; if (memo.has(k)) return memo.get(k); let s = 0; for (let x = i; x < w1.length; x++) if (w1[x] === tg[t]) s += f(t + 1, x + 1, j); for (let y = j; y < w2.length; y++) if (w2[y] === tg[t]) s += f(t + 1, i, y + 1); s %= MOD; memo.set(k, s); return s; }, sub = w => { const dp = Array(tg.length + 1).fill(0); dp[0] = 1; for (const c of w) for (let t = tg.length - 1; t >= 0; t--) if (tg[t] === c) dp[t + 1] = (dp[t + 1] + dp[t]) % MOD; return dp[tg.length]; }; const all = f(0, 0, 0), a = sub(w1), b = sub(w2); T.at({ word1: A(w1.split('')), word2: A(w2.split('')), target: A(tg.split('')) }); T.n('Ways to form target using word1 only?', a, 'Subsequence-count DP.'); T.n('Ways using word2 only?', b, 'Same DP.'); T.n('Ways with any mix (including pure ones)?', all, 'Three-index DP over target, word1 and word2.'); return ((all - a - b) % MOD + MOD) % MOD; }
  });

  D('palindromic-subarray-sum', {
    t: 'Palindromic Subarray Sum',
    r: 'Values are positive, so for each centre the longest palindrome there gives the best sum. Find every centre\'s radius with Manacher (or hashing plus binary search) and read sums from prefix sums.',
    g: R => ({ nums: R.ints(R.int(1, 7), 1, 4) }),
    s(I, T) { const a = I.nums, n = a.length, P = [0]; a.forEach(x => P.push(P[P.length - 1] + x)); let best = 0, asks = 0; for (let c = 0; c < 2 * n - 1; c++) { let l = c >> 1, r = l + (c & 1); if (r >= n || a[l] !== a[r]) continue; while (l > 0 && r < n - 1 && a[l - 1] === a[r + 1]) { l--; r++; } const s = P[r + 1] - P[l]; best = Math.max(best, s); if (asks < 4 && r > l) { asks++; T.at({ nums: A(a, { win: [l, r] }), prefix: A(P) }); T.n(`Sum of the longest palindrome around centre ${c / 2}?`, s, 'Expand while both ends match; prefix sums give its sum.'); } } if (!asks) { T.at({ nums: A(a) }); T.n('Largest single element?', Math.max(...a), 'Every single element is a palindrome.'); T.yn('Is any longer palindrome present?', false, 'No equal neighbours or mirror pairs.'); } return best; }
  });

  D('maximum-consistent-columns-in-a-grid', {
    t: 'Maximum Consistent Columns in a Grid',
    r: 'Think of columns as a sequence: column b may follow column a if every row differs by at most limit. dp[b] = 1 + max dp[a] over compatible a < b, exactly like the longest increasing subsequence in O(n²·m).',
    g: R => ({ grid: R.grid(R.int(1, 3), R.int(1, 6), -4, 4), limit: R.int(0, 4) }),
    s(I, T) { const g = I.grid, n = g[0].length, ok = (a, b) => g.every(r => Math.abs(r[b] - r[a]) <= I.limit), dp = []; for (let b = 0; b < n; b++) { dp[b] = 1; for (let a = 0; a < b; a++) if (ok(a, b)) dp[b] = Math.max(dp[b], dp[a] + 1); if (b < 6) { T.at({ grid: G(g), dp: A(dp.slice()), limit: I.limit }); T.n(`Longest chain ending at column ${b}?`, dp[b], 'Extend the best earlier column whose every row is within limit.'); } } return Math.max(...dp); }
  });

  D('minimum-cost-to-convert-string-iii', {
    t: 'Minimum Cost to Convert String III',
    r: 'Every position is used at most once, so rules always match against the original source. dp[i] = cheapest way to fix the prefix of length i: copy one character if source[i] already equals target[i], or apply a rule starting at i whose pattern matches source (\'*\' matches anything) and whose replacement equals target there, paying its cost plus its wildcards.',
    g: R => { const n = R.int(1, 5), src = R.str(n, 'ab'), tg = R.str(n, 'ab'), rules = [], costs = []; for (let t = 0; t < R.int(1, 3); t++) { const L = R.int(1, Math.min(2, n)), l = R.int(0, n - L); rules.push([src.slice(l, l + L).split('').map(c => R.chance(0.3) ? '*' : c).join(''), tg.slice(l, l + L)]); costs.push(R.int(1, 4)); } return { source: src, target: tg, rules, costs }; },
    s(I, T) { const s = I.source, t = I.target, n = s.length, dp = Array(n + 1).fill(Infinity); dp[0] = 0; for (let i = 0; i < n; i++) { if (dp[i] === Infinity) continue; if (s[i] === t[i]) dp[i + 1] = Math.min(dp[i + 1], dp[i]); I.rules.forEach(([p, rp], k) => { const L = p.length; if (i + L > n) return; for (let j = 0; j < L; j++) if ((p[j] !== '*' && p[j] !== s[i + j]) || rp[j] !== t[i + j]) return; const c = I.costs[k] + p.split('').filter(x => x === '*').length; dp[i + L] = Math.min(dp[i + L], dp[i] + c); }); } for (let i = 1; i <= Math.min(n, 4); i++) { T.at({ source: A(s.split(''), { i: i - 1 }), target: A(t.split(''), { i: i - 1 }), rules: A(I.rules.map((r, k) => `${r[0]}→${r[1]} $${I.costs[k]}`)) }); T.n(`Cheapest cost to fix the first ${i} characters? (−1 if impossible)`, dp[i] === Infinity ? -1 : dp[i], 'Copy a matching character, or end a rule application here.'); } return dp[n] === Infinity ? -1 : dp[n]; }
  });

  D('minimum-possible-maximum-waiting-time', {
    t: 'Minimum Possible Maximum Waiting Time',
    r: 'Search over cars in order with state (fuel left at each dispenser, time each frees up, current time). Each car picks a dispenser with enough fuel, waits until it frees, and then the next car becomes allowed. Memoise on the state, maximising cars served first and then minimising the worst wait.',
    g: R => ({ demand: R.ints(R.int(1, 5), 1, 6), fuel: [R.int(1, 12), R.int(1, 12)] }),
    s(I, T) { const d = I.demand, n = d.length; let bestCnt = 0, bestW = Infinity; const go = (i, f0, f1, t0, t1, now, cnt, w) => { if (cnt > bestCnt || (cnt === bestCnt && w < bestW)) { bestCnt = cnt; bestW = w; } if (i === n) return; [[0, f0, t0], [1, f1, t1]].forEach(([j, f, tf]) => { if (f < d[i]) return; const st = Math.max(now, tf), nw = Math.max(w, st - now); if (j === 0) go(i + 1, f0 - d[i], f1, st + d[i], t1, st, cnt + 1, nw); else go(i + 1, f0, f1 - d[i], t0, st + d[i], st, cnt + 1, nw); }); }; go(0, I.fuel[0], I.fuel[1], 0, 0, 0, 0, 0); T.at({ demand: A(d), fuel: A(I.fuel) }); T.yn('Can car 0 be served at all?', d[0] <= Math.max(...I.fuel), 'Some dispenser must hold enough fuel.'); T.n('Most cars that can be served?', bestCnt, 'Each car must pick a dispenser with enough fuel left.'); T.n('Smallest possible worst wait among those plans? (−1 if none)', bestCnt ? bestW : -1, 'Among plans serving that many, minimise the longest wait.'); return bestCnt ? bestW : -1; }
  });

  D('elevator-requests-ii', {
    t: 'Elevator Requests II',
    r: 'The served floors always form a contiguous range around the start in sorted order, so use interval DP: dp[l][r][side] = least penalty once requests l..r are served and the elevator stands at the left or right end. Each move costs its distance times the number of requests still waiting.',
    g: R => { const n = R.int(3, 10); return { n, start: R.int(0, n - 1), requests: R.distinct(R.int(1, 4), 0, n - 1) }; },
    s(I, T) { const F = I.requests.slice().sort((a, b) => a - b), k = F.length, memo = new Map(); const go = (l, r, pos, left) => { if (l === 0 && r === k - 1) return 0; const key = `${l},${r},${pos}`; if (memo.has(key)) return memo.get(key); let b = Infinity; if (l > 0) b = Math.min(b, Math.abs(pos - F[l - 1]) * left + go(l - 1, r, F[l - 1], left - 1)); if (r < k - 1) b = Math.min(b, Math.abs(pos - F[r + 1]) * left + go(l, r + 1, F[r + 1], left - 1)); memo.set(key, b); return b; }; let best = Infinity, first = []; F.forEach((f, i) => { const c = Math.abs(I.start - f) * k + go(i, i, f, k - 1); first.push(c); best = Math.min(best, c); }); T.at({ floors: A(F), start: I.start }); T.n('How many requests are still waiting at time 0?', k, 'Each second costs 1 per waiting request.'); const near = F.reduce((b, f) => Math.abs(f - I.start) < Math.abs(b - I.start) ? f : b, F[0]); T.n(`Penalty if the first floor served is ${near}?`, first[F.indexOf(near)], 'Distance × waiting count, then the best interval DP from there.'); T.n('Minimum total penalty?', best, 'Best over every first stop.'); return best; }
  });

  D('elevator-requests-iii', {
    t: 'Elevator Requests III',
    r: 'With at most 16 requests, use a bitmask DP over the order of fulfilment: dp[mask][last] = earliest time standing on request last\'s floor having fulfilled mask. Going next to j takes max(time + distance, arrival_j), since you can always wait at the floor.',
    g: R => { const n = R.int(3, 9); return { n, start: R.int(0, n - 1), requests: Array.from({ length: R.int(1, 4) }, () => [R.int(0, 8), R.int(0, n - 1)]) }; },
    s(I, T) { const q = I.requests, k = q.length, F = 1 << k, dp = range(0, F).map(() => Array(k).fill(Infinity)); for (let j = 0; j < k; j++) dp[1 << j][j] = Math.max(Math.abs(I.start - q[j][1]), q[j][0]); for (let m = 1; m < F; m++) for (let i = 0; i < k; i++) if (dp[m][i] < Infinity) for (let j = 0; j < k; j++) if (!(m >> j & 1)) { const t = Math.max(dp[m][i] + Math.abs(q[i][1] - q[j][1]), q[j][0]); if (t < dp[m | 1 << j][j]) dp[m | 1 << j][j] = t; } T.at({ requests: A(q.map(r => `t${r[0]}→f${r[1]}`)), start: I.start }); range(0, Math.min(k, 2)).forEach(j => T.n(`Earliest time to fulfil request ${j} first?`, dp[1 << j][j], 'Travel there, then wait for its arrival if early.')); T.n('Minimum time to fulfil everything?', Math.min(...dp[F - 1]), 'Best over the full mask and any last request.'); return Math.min(...dp[F - 1]); }
  });

  D('elevator-requests-iv', {
    t: 'Elevator Requests IV',
    r: 'With up to 500 requests a bitmask is out. Sort by arrival; at any time the useful plan is to sweep an interval of floors, so think of the unmet requests\' floor span and use an interval DP over sorted floors with time states, or binary search the finishing time and check whether a left/right sweep covers every request after its arrival.',
    g: R => { const n = R.int(3, 9); return { n, start: R.int(0, n - 1), requests: Array.from({ length: R.int(1, 4) }, () => [R.int(0, 8), R.int(0, n - 1)]) }; },
    s(I, T) { const q = I.requests, k = q.length, F = 1 << k, dp = range(0, F).map(() => Array(k).fill(Infinity)); for (let j = 0; j < k; j++) dp[1 << j][j] = Math.max(Math.abs(I.start - q[j][1]), q[j][0]); for (let m = 1; m < F; m++) for (let i = 0; i < k; i++) if (dp[m][i] < Infinity) for (let j = 0; j < k; j++) if (!(m >> j & 1)) { const t = Math.max(dp[m][i] + Math.abs(q[i][1] - q[j][1]), q[j][0]); if (t < dp[m | 1 << j][j]) dp[m | 1 << j][j] = t; } const ans = Math.min(...dp[F - 1]), lastArr = Math.max(...q.map(r => r[0])); T.at({ requests: A(q.map(r => `t${r[0]}→f${r[1]}`)), start: I.start }); T.n('Latest arrival time (a lower bound on the answer)?', lastArr, 'Nothing can finish before every request exists.'); if (ans > 0) T.yn(`Can everything be done by time ${ans - 1}?`, false, 'Just below the optimum the check fails.'); T.yn(`Can everything be done by time ${ans}?`, true, 'The smallest time the check accepts.'); return ans; }
  });

  D('minimum-operations-to-form-subset-sum-i', {
    t: 'Minimum Operations to Form Subset Sum I',
    r: 'Each element becomes (x·2^a) >> b for a + b operations (all doublings first). List, per element, the cheapest cost for every reachable value ≤ sum. Then a 0/1 knapsack: dp[s] = fewest operations for a subset summing to s, where each element is skipped or contributes one of its values.',
    g: R => ({ nums: R.ints(R.int(1, 3), 1, 9), sum: R.int(1, 15) }),
    s(I, T) { const S = I.sum, opts = I.nums.map(x => { const m = new Map(); for (let a = 0; (x << a) <= 2 * S + 2 && a < 10; a++) { let v = x << a; for (let b = 0; ; b++) { if (v <= S && (!m.has(v) || m.get(v) > a + b)) m.set(v, a + b); if (v === 0) break; v >>= 1; } } return m; }); let dp = Array(S + 1).fill(Infinity); dp[0] = 0; opts.forEach((m, i) => { const nd = dp.slice(); for (let s = 0; s <= S; s++) if (dp[s] < Infinity) m.forEach((c, v) => { if (s + v <= S && dp[s] + c < nd[s + v]) nd[s + v] = dp[s] + c; }); dp = nd; if (i < 3) { T.at({ nums: A(I.nums, { i }), target: S }); T.n(`Fewest operations to hit ${S} using the first ${i + 1} element${i ? 's' : ''}? (−1 if not yet)`, dp[S] === Infinity ? -1 : dp[S], 'Knapsack: skip the element or use one of its reachable values.'); } }); return dp[S] === Infinity ? -1 : dp[S]; }
  });

  D('minimum-operations-to-form-subset-sum-ii', {
    t: 'Minimum Operations to Form Subset Sum II',
    r: 'Now doublings and halvings can mix in any order, so halving first and then doubling reaches new values (6 → 3 → … → 6·… ). BFS from each element over values up to about 2·sum to get the fewest operations per reachable value, then run the same 0/1 knapsack.',
    g: R => ({ nums: R.ints(R.int(1, 3), 1, 9), sum: R.int(1, 15) }),
    s(I, T) { const S = I.sum, cap = 4 * S + 20, opts = I.nums.map(x => { const d = new Map([[x, 0]]), q = [x]; while (q.length) { const u = q.shift(); [u * 2, u >> 1].forEach(v => { if (v <= Math.max(cap, x) && !d.has(v)) { d.set(v, d.get(u) + 1); q.push(v); } }); } return new Map([...d].filter(([v]) => v <= S)); }); T.at({ nums: A(I.nums), sum: S }); T.n(`Fewest operations to turn ${I.nums[0]} into 1?`, opts[0].has(1) ? opts[0].get(1) : -1, 'Halve repeatedly.'); let dp = Array(S + 1).fill(Infinity); dp[0] = 0; opts.forEach(m => { const nd = dp.slice(); for (let s = 0; s <= S; s++) if (dp[s] < Infinity) m.forEach((c, v) => { if (s + v <= S && dp[s] + c < nd[s + v]) nd[s + v] = dp[s] + c; }); dp = nd; }); T.n('How many element values can reach exactly the target alone?', opts.filter(m => m.has(S)).length, 'Elements with the target in their BFS map.'); T.n('Fewest operations overall? (−1 if impossible)', dp[S] === Infinity ? -1 : dp[S], 'Knapsack over BFS costs.'); return dp[S] === Infinity ? -1 : dp[S]; }
  });
})();
