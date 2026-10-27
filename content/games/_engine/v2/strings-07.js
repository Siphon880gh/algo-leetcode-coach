/* v2 games: strings (07). Guides scored in the 4042–4095 pass. */
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

  D('count-rotations-with-exactly-k-equal-adjacent-pairs', {
    t: 'Count Rotations with Exactly K Equal Adjacent Pairs',
    r: 'Read s as a circle and count its equal neighbour pairs E, including the last character with the first. The rotation starting at p cuts the circle between p − 1 and p, so its score is E, minus 1 if that cut pair was equal.',
    g: R => { const n = R.int(2, 6); return { s: R.str(n, 'ab'), k: R.int(0, n - 1) }; },
    s(I, T) { const s = I.s, n = s.length; let E = 0; for (let i = 0; i < n; i++) if (s[i] === s[(i + 1) % n]) E++; T.at({ s: A(s.split('')), k: I.k }); T.n('Equal neighbour pairs around the circle, including last with first?', E, 'Check every i, with i + 1 wrapping to 0.'); let c = 0; for (let p = 0; p < n; p++) { const cut = s[(p - 1 + n) % n] === s[p], sc = E - (cut ? 1 : 0); if (p < 6) { T.at({ s: A(s.split(''), { p }), E, k: I.k }); T.n(`Score of the rotation starting at index ${p}?`, sc, cut ? 'The cut pair was equal, so E − 1.' : 'The cut pair differs, so still E.'); } if (sc === I.k) c++; } T.at({ s: A(s.split('')), k: I.k }); T.n(`How many rotations score exactly ${I.k}?`, c, 'Count the matching scores.'); return c; }
  });

  D('count-magical-substring-pairs-i', {
    t: 'Count Magical Substring Pairs I',
    r: 'Fix the split after index j. Walk left from j counting distinct letters to tally how many s1 have each distinct count, do the same rightwards from j + 1 for s2, and add the products of matching tallies.',
    g: R => ({ s: R.str(R.int(2, 6), 'abc') }),
    s(I, T) { const s = I.s, n = s.length; let tot = 0; for (let j = 0; j + 1 < n; j++) { const L = {}, Rr = {}; let st = new Set(); for (let i = j; i >= 0; i--) { st.add(s[i]); L[st.size] = (L[st.size] || 0) + 1; } st = new Set(); for (let k = j + 1; k < n; k++) { st.add(s[k]); Rr[st.size] = (Rr[st.size] || 0) + 1; } let c = 0; for (const d in L) c += L[d] * (Rr[d] || 0); if (j < 5) { T.at({ s: A(s.split(''), { j }), total: tot }); T.n(`How many s1 ending at ${j} have exactly 1 distinct letter?`, L[1] || 0, 'Walk left while the letter stays the same.'); T.at({ s: A(s.split(''), { j }), left: L, right: Rr }); T.n(`Magical pairs at the split after index ${j}?`, c, 'Multiply the matching tallies and add.'); } tot += c; } T.at({ s: A(s.split('')), total: tot }); T.n('Total magical triplets?', tot, 'Add every split.'); return tot; }
  });
})();
