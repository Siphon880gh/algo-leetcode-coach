/* v2 games: hash (6). Extras: guides with no LeetCode number (hello-algo, labuladong, leetcode-master). */
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


  const letterSum = s => s.split('').reduce((t, c) => t + c.charCodeAt(0) - 96, 0);

  D('hash-algorithm', {
    t: 'Hash Algorithm: Sum of Letters',
    r: 'A weak hash: add the letter positions (a = 1, b = 2, ..., z = 26) and take the result mod the bucket count. Anagrams always collide, which is why real hashes mix bits so similar keys spread out.',
    exs: [{ in: { keys: ['cat', 'act', 'dog'], capacity: 8 }, out: [0, 0, 2] }],
    g: R => { const ks = []; for (let i = R.int(3, 5); i > 0; i--) ks.push(R.str(R.int(2, 3), 'abcdeo')); if (R.chance(0.5)) ks.push(ks[0].split('').reverse().join('')); return { keys: ks, capacity: R.int(4, 8) }; },
    s(I, T) { const out = [], used = new Map(); let col = 0; I.keys.forEach((k, i) => { const s = letterSum(k), b = s % I.capacity; T.at({ keys: A(I.keys.map(x => JSON.stringify(x)), { hl: i }), capacity: I.capacity, used: K([...used].map(([x, y]) => ['bucket ' + x, y.join(', ')])) }); T.n(`Bucket for "${k}"? (letter sum ${s})`, b, `${s} mod ${I.capacity} = ${b}.`); if (used.has(b)) col++; used.set(b, (used.get(b) || []).concat(k)); out.push(b); }); T.at({ buckets: A(out), used: K([...used].map(([x, y]) => ['bucket ' + x, y.join(', ')])) }); T.n('How many keys landed in a bucket that was already taken?', col, 'Count inserts into a non-empty bucket.'); return out; }
  });

  D('hash-collision', {
    t: 'Hash Collisions: Linear Probing',
    r: 'Open addressing with linear probing: key x starts at slot x mod m. If that slot is taken, try the next slot, wrapping from m − 1 to 0, until an empty slot appears.',
    exs: [{ in: { keys: [5, 9, 2], capacity: 4 }, out: [null, 5, 9, 2] }],
    g: R => { const m = R.int(5, 7); return { keys: R.distinct(R.int(3, m - 1), 1, 30), capacity: m }; },
    s(I, T) { const m = I.capacity, t = Array(m).fill(null); I.keys.forEach(x => { const h = x % m; let i = h, probes = 0; while (t[i] !== null) { i = (i + 1) % m; probes++; } T.at({ table: A(t, { hl: h }), key: x }); T.n(`Home slot of ${x}?`, h, `${x} mod ${m}.`); if (t[h] !== null || probes) T.n(`${x} collides. In which slot does it end up?`, i, 'Step right (wrapping) until an empty slot.'); t[i] = x; }); return t; }
  });

  D('hash-optimization-strategy', {
    t: 'Hash Optimization: Two Sum in One Pass',
    r: 'Replace the inner loop with a hash map from value to index. At index i, compute need = target − nums[i]. If need is in the map, the pair is found; otherwise store nums[i] and move on. O(n) time for O(n) memory.',
    exs: [{ in: { nums: [2, 7, 11, 15], target: 9 }, out: [0, 1] }],
    g: R => { const n = R.int(4, 6), a = R.distinct(n, 1, 20), i = R.int(0, n - 2), j = R.int(i + 1, n - 1); return { nums: a, target: a[i] + a[j] }; },
    s(I, T) { const seen = new Map(); for (let i = 0; i < I.nums.length; i++) { const x = I.nums[i], need = I.target - x; T.at({ nums: A(I.nums, { hl: i }), seen: K([...seen].map(([k, v]) => [String(k), 'index ' + v])), target: I.target }); T.n(`need at index ${i}?`, need, `${I.target} − ${x}.`); const hit = seen.has(need); T.yn(`Is ${need} already in the map?`, hit, hit ? `Yes, at index ${seen.get(need)}.` : 'Not yet; store this value and move on.'); if (hit) return [seen.get(need), i]; seen.set(x, i); } return []; }
  });

  D('hash-table', {
    t: 'Hash Table with Chaining',
    r: 'Each key goes to bucket key mod capacity; keys that share a bucket are chained in a list. A lookup jumps to the bucket and compares keys only inside that chain, so it is expected O(1) when chains stay short.',
    exs: [{ in: { keys: [12836, 15937, 16750], capacity: 8, query: 15937 }, out: 1 }],
    g: R => { const m = R.int(3, 5), ks = R.distinct(R.int(4, 6), 10, 60); return { keys: ks, capacity: m, query: ks[R.int(0, ks.length - 1)] }; },
    s(I, T) { const m = I.capacity, B = Array.from({ length: m }, () => []); const view = () => K(B.map((c, j) => ['bucket ' + j, c.join(', ') || '(empty)'])); I.keys.forEach((k, i) => { T.at({ keys: A(I.keys, { hl: i }), table: view() }); T.n(`Bucket for key ${k}?`, k % m, `${k} mod ${m}.`); B[k % m].push(k); }); const b = I.query % m, pos = B[b].indexOf(I.query); T.at({ table: view(), query: I.query }); T.n(`Lookup ${I.query}: how many key comparisons inside bucket ${b}?`, pos + 1, 'Walk the chain from the front until the key matches.'); return b; }
  });

  D('labu-topic-e17e99e920a0', {
    t: 'Hash Set: Seen Before?',
    r: 'Scan left to right with a hash set. For each value, ask the set first: if it is there, a duplicate exists. Otherwise add it. Expected O(n) instead of O(n²) nested loops.',
    exs: [{ in: { nums: [3, 1, 4, 1] }, out: true }, { in: { nums: [1, 2, 3] }, out: false }],
    g: R => { const n = R.int(4, 7), a = R.ints(n, 1, 9); return { nums: a }; },
    s(I, T) { const s = new Set(); let looks = 0; for (let i = 0; i < I.nums.length; i++) { const x = I.nums[i]; looks++; T.at({ nums: A(I.nums, { hl: i }), set: A([...s], { label: 'set' }) }); const hit = s.has(x); T.yn(`Is ${x} already in the set?`, hit, hit ? 'It was added earlier: duplicate found.' : 'New value: add it.'); if (hit) { T.n('How many set lookups did the scan make?', looks, 'One lookup per scanned value.'); return true; } s.add(x); } T.n('How many values ended up in the set?', s.size, 'Every value was new.'); return false; }
  });
})();
