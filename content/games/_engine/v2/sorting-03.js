/* v2 games: sorting (3). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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

  const isPalN = x => isPal(String(x));
  const primesTo = n => { const s = Array(n + 1).fill(true), out = []; for (let i = 2; i <= n; i++) if (s[i]) { out.push(i); for (let j = i * i; j <= n; j += i) s[j] = false; } return out; };


  const SX = [{ in: { nums: [3, 1, 4, 2] }, out: [1, 2, 3, 4] }, { in: { nums: [5, 2, 3, 1] }, out: [1, 2, 3, 5] }];
  const nums47 = R => ({ nums: R.ints(R.int(4, 7), 1, 9) });

  D('bubble-sort', {
    t: 'Bubble Sort',
    r: 'Each pass walks left to right and swaps neighbors that are out of order, so the largest unsorted value bubbles to the end. After pass p the last p + 1 slots are final. Stop early when a pass makes no swaps.',
    exs: SX, g: nums47,
    s(I, T) { const a = I.nums.slice(), n = a.length; let inv = 0; for (let x = 0; x < n; x++) for (let y = x + 1; y < n; y++) if (a[x] > a[y]) inv++; T.at({ nums: A(a) }); T.n('How many swaps will bubble sort make in total? (Count pairs i < j with a[i] > a[j].)', inv, 'Each neighbor swap fixes exactly one out-of-order pair.'); for (let p = 0; p < n - 1; p++) { const before = a.slice(); let sw = 0; for (let j = 0; j < n - 1 - p; j++) if (a[j] > a[j + 1]) { [a[j], a[j + 1]] = [a[j + 1], a[j]]; sw++; } T.at({ nums: A(before, { dim: range(n - p, n) }), pass: p }); T.n(`How many swaps does pass ${p} make?`, sw, 'Count the neighbor pairs that are out of order as you walk.'); if (!sw) { T.yn('Can bubble sort stop now?', true, 'A pass with no swaps means the array is sorted.'); break; } T.at({ nums: A(a, { ok: range(n - 1 - p, n) }) }); T.n(`Which value is now fixed at index ${n - 1 - p}?`, a[n - 1 - p], 'The largest unsorted value bubbles to the end.'); } return a; }
  });

  D('bucket-sort', {
    t: 'Bucket Sort',
    r: 'For values in [0, 1) and k buckets, value x goes to bucket floor(x times k). Sort each bucket (they are small), then join the buckets in order.',
    exs: [{ in: { nums: [0.42, 0.11, 0.75, 0.08], buckets: 4 }, out: [0.08, 0.11, 0.42, 0.75] }],
    g: R => ({ nums: R.ints(R.int(4, 7), 0, 99).map(x => x / 100), buckets: R.int(3, 5) }),
    s(I, T) { const k = I.buckets, B = Array.from({ length: k }, () => []); I.nums.forEach((x, i) => { const b = Math.floor(x * k); T.at({ nums: A(I.nums, { hl: i }), buckets: K(B.map((v, j) => ['bucket ' + j, show(v)])) }); T.n(`Which bucket gets ${x}?`, b, `floor(${x} times ${k}) = ${b}.`); B[b].push(x); }); const big = B.reduce((m, v, j) => v.length > B[m].length ? j : m, 0); T.at({ buckets: K(B.map((v, j) => ['bucket ' + j, show(v)])) }); T.n('How many values sit in the fullest bucket?', B[big].length, 'Count each bucket.'); const out = [].concat(...B.map(v => v.slice().sort((x, y) => x - y))); return out; }
  });

  D('counting-sort', {
    t: 'Counting Sort',
    r: 'For small integer keys 0 to k: count each key, turn counts into prefix sums (prefix[v] = how many keys are at most v), then scan the input from right to left and place each key at index prefix[key] − 1, decreasing prefix[key]. That keeps it stable.',
    exs: [{ in: { nums: [2, 0, 2, 1, 0] }, out: [0, 0, 1, 2, 2] }],
    g: R => ({ nums: R.ints(R.int(5, 8), 0, 3) }),
    s(I, T) { const a = I.nums, k = Math.max(...a), cnt = Array(k + 1).fill(0); a.forEach(x => cnt[x]++); for (let v = 0; v <= k; v++) { T.at({ nums: A(a, { hl: a.map((x, i) => x === v ? i : -1).filter(i => i >= 0) }) }); T.n(`count[${v}]?`, cnt[v], `How many times does ${v} appear?`); } const pre = []; cnt.reduce((s, c, v) => (pre[v] = s + c), 0); T.at({ count: A(cnt) }); T.n(`prefix[${k}] (keys at most ${k})?`, pre[k], 'The last prefix is the array length.'); const p = pre.slice(), out = Array(a.length).fill(null); for (let i = a.length - 1; i >= 0; i--) { const pos = --p[a[i]]; if (i >= a.length - 2) { T.at({ nums: A(a, { hl: i }), prefix: A(p.map((x, v) => v === a[i] ? x + 1 : x)), output: A(out) }); T.n(`Scanning right to left, at which output index does ${a[i]} (input index ${i}) land?`, pos, `prefix[${a[i]}] − 1 = ${pos}.`); } out[pos] = a[i]; } return out; }
  });

  D('insertion-sort', {
    t: 'Insertion Sort',
    r: 'Grow a sorted prefix. Take the next key, shift every larger value in the prefix one slot right, and drop the key into the hole.',
    exs: SX, g: nums47,
    s(I, T) { const a = I.nums.slice(); for (let i = 1; i < a.length; i++) { const key = a[i]; let j = i - 1; T.at({ nums: A(a, { hl: i, ok: range(0, i) }), key }); while (j >= 0 && a[j] > key) { a[j + 1] = a[j]; j--; } a[j + 1] = key; T.n(`Key ${key}: how many values shift right?`, i - 1 - j, 'Count prefix values greater than the key.'); if (i <= 3) T.n(`At which index does ${key} land?`, j + 1, 'Right after the last value that is not greater.'); } return a; }
  });

  D('merge-sort', {
    t: 'Merge Sort',
    r: 'Split the array in half (the left half gets the first floor(n divided by 2) items), sort each half, then merge: compare the fronts of the two sorted runs and take the smaller, taking from the left on ties.',
    exs: SX, g: nums47,
    s(I, T) { const go = a => { if (a.length < 2) return a; const m = Math.floor(a.length / 2), L = go(a.slice(0, m)), Rr = go(a.slice(m)), out = []; let i = 0, j = 0; while (i < L.length && j < Rr.length) { const fromL = L[i] <= Rr[j]; if (a.length > 2 || T.asks < 3) { T.v(A(L, { i, label: 'left run' }), A(Rr, { j, label: 'right run' }), A(out, { label: 'merged' })); T.c(`Merge step: take ${L[i]} from the left or ${Rr[j]} from the right?`, [`left ${L[i]}`, `right ${Rr[j]}`], fromL ? `left ${L[i]}` : `right ${Rr[j]}`, 'Take the smaller front. On a tie take the left one so the sort stays stable.'); } out.push(fromL ? L[i++] : Rr[j++]); } return out.concat(L.slice(i), Rr.slice(j)); }; return go(I.nums.slice()); }
  });

  D('quick-sort', {
    t: 'Quick Sort (Last-Element Pivot)',
    r: 'Partition with the last value as pivot: values smaller than the pivot move to the front, then the pivot is swapped into the slot right after them. The pivot is now final. Recurse on the left part and the right part.',
    exs: SX, g: nums47,
    s(I, T) { const a = I.nums.slice(); const qs = (lo, hi) => { if (lo >= hi) return; const pv = a[hi], seg = a.slice(lo, hi + 1); let b = lo; for (let k = lo; k < hi; k++) if (a[k] < pv) { [a[b], a[k]] = [a[k], a[b]]; b++; } [a[b], a[hi]] = [a[hi], a[b]]; T.at({ nums: A(a.map((x, k) => k >= lo && k <= hi ? seg[k - lo] : x), { hl: hi, win: [lo, hi] }), pivot: pv }); T.n(`Range [${lo}, ${hi}], pivot ${pv}: how many values are smaller?`, b - lo, 'Count the strictly smaller values in the range.'); T.n(`At which index does pivot ${pv} end up?`, b, `${lo} + ${b - lo}.`); qs(lo, b - 1); qs(b + 1, hi); }; qs(0, a.length - 1); return a; }
  });

  D('radix-sort', {
    t: 'Radix Sort (LSD, Base 10)',
    r: 'Sort by the ones digit, then the tens digit, then the hundreds digit, each pass a stable sort on that digit alone. Stability keeps the earlier digit order inside equal digits, so the list ends fully sorted.',
    exs: [{ in: { nums: [170, 45, 75, 90, 802, 24, 2, 66] }, out: [2, 24, 45, 66, 75, 90, 170, 802] }],
    g: R => { const a = R.ints(R.int(4, 6), 1, 999); a[R.int(0, a.length - 1)] = R.int(100, 999); return { nums: a }; },
    s(I, T) { let a = I.nums.slice(); const passes = String(Math.max(...a)).length, names = ['ones', 'tens', 'hundreds']; for (let p = 0, d = 1; p < passes; p++, d *= 10) { const dig = x => Math.floor(x / d) % 10; T.at({ nums: A(a, { labels: a.map(x => String(dig(x))) }), digit: names[p] }); a = a.slice().sort((x, y) => dig(x) - dig(y)); T.n(`After the ${names[p]} pass, which value is first?`, a[0], 'Smallest digit first; ties keep their current order.'); T.n(`After the ${names[p]} pass, which value is last?`, a[a.length - 1], 'Largest digit last; ties keep their current order.'); } return a; }
  });

  D('selection-sort', {
    t: 'Selection Sort',
    r: 'For each position i from the left, find the smallest value in a[i to n − 1] and swap it into position i. After pass i the first i + 1 slots are final.',
    exs: SX, g: nums47,
    s(I, T) { const a = I.nums.slice(), n = a.length; for (let i = 0; i < n - 1; i++) { let m = i; for (let j = i + 1; j < n; j++) if (a[j] < a[m]) m = j; T.at({ nums: A(a, { ok: range(0, i), i }) }); T.n(`Pass ${i}: index of the smallest value in a[${i}..${n - 1}]?`, m, 'Scan the unsorted part; keep the first smallest.'); [a[i], a[m]] = [a[m], a[i]]; } return a; }
  });
})();
