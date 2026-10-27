/* v2 games: stack (03). Guides scored in the 3483–4041 pass. */
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

  D('resulting-string-after-adjacent-removals', {
    t: 'Resulting String After Adjacent Removals',
    r: 'A stack replays "remove the leftmost consecutive pair": push each letter, but if it is next to the top letter in the circular alphabet (a–z wraps), pop the top instead of pushing.',
    g: R => ({ s: R.str(R.int(3, 9), 'abcdz') }),
    s(I, T) { const st = []; const adj = (a, b) => { const d = Math.abs(a.charCodeAt(0) - b.charCodeAt(0)); return d === 1 || d === 25; }; for (const c of I.s) { const pop = st.length > 0 && adj(st[st.length - 1], c); T.v(S(st.slice()), K([['next', c]])); T.c(`Next letter "${c}": push or pop?`, ['push', 'pop the top'], pop ? 'pop the top' : 'push', pop ? `"${st[st.length - 1]}" and "${c}" are consecutive, so they cancel.` : st.length ? `"${st[st.length - 1]}" and "${c}" are not consecutive.` : 'The stack is empty.'); if (pop) st.pop(); else st.push(c); } return st.join(''); }
  });

  D('remove-k-balanced-substrings', {
    t: 'Remove K-Balanced Substrings',
    r: 'Keep a stack of runs (char, length). Push each character, merging with an equal top run. When a ")" run reaches k and the run below is "(" with at least k, delete k of each; the runs that meet afterwards merge naturally.',
    g: R => ({ s: R.str(R.int(2, 10), '()'), k: R.int(1, 2) }),
    s(I, T) { const st = []; [...I.s].forEach((ch, i) => { if (st.length && st[st.length - 1][0] === ch) st[st.length - 1][1]++; else st.push([ch, 1]); const t = st[st.length - 1]; if (ch === ')' && t[1] === I.k && st.length > 1 && st[st.length - 2][0] === '(' && st[st.length - 2][1] >= I.k) { st.pop(); st[st.length - 1][1] -= I.k; if (!st[st.length - 1][1]) st.pop(); } if (i < 8) { T.at({ s: A(I.s.split(''), { i }), runs: S(st.map(([c, n]) => c + '×' + n)) }); T.n(`Length of what remains after reading index ${i}?`, sum(st.map(r => r[1])), 'Merge runs; remove a k-balanced block when one forms.'); } }); return st.map(([c, n]) => c.repeat(n)).join(''); }
  });

  D('evaluate-valid-expressions', {
    t: 'Evaluate Valid Expressions',
    r: 'Parse recursively (or with an explicit stack): a literal is read as a signed integer; op(a,b) evaluates a, skips the comma, evaluates b, and applies add, sub, mul or div (integer division toward zero). Inner expressions finish first.',
    g: R => { const mk = d => { if (!d || R.chance(0.3)) return String(R.int(-5, 9)); const op = R.pick(['add', 'sub', 'mul', 'div']), a = mk(d - 1); let b = mk(d - 1); if (op === 'div') b = String(R.int(1, 4)); return `${op}(${a},${b})`; }; return { expression: mk(R.int(1, 3)) }; },
    s(I, T) { const e = I.expression; let p = 0; const vals = []; const go = () => { if (/[-\d]/.test(e[p])) { let q = p + 1; while (q < e.length && /\d/.test(e[q])) q++; const v = Number(e.slice(p, q)); p = q; return v; } const op = e.slice(p, p + 3), st = p; p += 4; const a = go(); p++; const b = go(); p++; const v = op === 'add' ? a + b : op === 'sub' ? a - b : op === 'mul' ? a * b : Math.trunc(a / b); vals.push([e.slice(st, p), v, op, a, b]); return v; }; const ans = go(); vals.slice(0, 5).forEach(([sub, v, op, a, b]) => { T.at({ expression: e, evaluating: sub }); T.n(`Value of ${sub}?`, v, `${op}(${a}, ${b}).`); }); if (!vals.length) { T.at({ expression: e }); T.yn('Is the expression just a literal?', true, 'No operator to apply.'); T.n('Its value?', ans, 'Read the signed integer.'); } return ans; }
  });

  D('lexicographically-smallest-string-after-deleting-duplicate-characters', {
    t: 'Lexicographically Smallest String After Deleting Duplicate Characters',
    r: 'Monotonic stack with letter counts (in the stack plus still to come). Before pushing c, pop tops that are larger than c while another copy of that letter survives elsewhere. At the end, drop trailing letters that still have a copy earlier, since a shorter prefix is smaller.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc') }),
    s(I, T) { const left = {}, inSt = {}; for (const ch of I.s) left[ch] = (left[ch] || 0) + 1; const st = []; I.s.split('').forEach((ch, i) => { left[ch]--; while (st.length && st[st.length - 1] > ch && (inSt[st[st.length - 1]] - 1 + left[st[st.length - 1]]) >= 1) { inSt[st.pop()]--; } st.push(ch); inSt[ch] = (inSt[ch] || 0) + 1; if (i < 7) { T.at({ s: A(I.s.split(''), { i }), stack: S(st.slice()) }); T.n(`Stack size after reading index ${i}?`, st.length, 'Pop bigger letters that have another copy, then push.'); } }); while (st.length && inSt[st[st.length - 1]] > 1) inSt[st.pop()]--; return st.join(''); }
  });

  D('merge-adjacent-equal-elements', {
    t: 'Merge Adjacent Equal Elements',
    r: 'Use a stack. Push each value; while the top two are equal, pop both and push their sum. The leftmost equal pair is always at the top of what has been processed, so this matches the rule.',
    g: R => ({ nums: R.ints(R.int(1, 8), 1, 4) }),
    s(I, T) { const st = []; I.nums.forEach((x, i) => { st.push(x); while (st.length > 1 && st[st.length - 1] === st[st.length - 2]) { const v = st.pop() * 2; st.pop(); st.push(v); } if (i < 7) { T.at({ nums: A(I.nums, { i }), stack: S(st.slice()) }); T.n(`Top of the stack after processing index ${i}?`, st[st.length - 1], 'Merge while the top two are equal.'); } }); return st; }
  });

  D('count-good-subarrays', {
    t: 'Count Good Subarrays',
    r: 'OR equals some element only if that element contains every bit, i.e. it is the maximum and a superset of the rest. For each index as the owner, extend left and right while elements are submasks of it (stopping at an equal value on one side to avoid double counting); monotonic stacks find those borders fast.',
    g: R => ({ nums: R.ints(R.int(1, 7), 0, 7) }),
    s(I, T) { const a = I.nums; let tot = 0; for (let i = 0; i < a.length; i++) { let o = 0, c = 0; const set = new Set(); for (let j = i; j < a.length; j++) { o |= a[j]; set.add(a[j]); if (set.has(o)) c++; } tot += c; if (i < 5) { T.at({ nums: A(a, { i }) }); T.n(`Good subarrays starting at index ${i}?`, c, 'The running OR must equal some element inside.'); } } return tot; }
  });
})();
