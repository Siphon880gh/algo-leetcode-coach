/* v2 games: binary search (05). */
(function () {
  'use strict';
  const { D, A, K } = LCGame.H;
  const lowerBound = (a, x) => { let lo = 0, hi = a.length; while (lo < hi) { const m = (lo + hi) >> 1; if (a[m] < x) lo = m + 1; else hi = m; } return lo; };
  const lastTrue = (lo, hi, ok, T, show, label) => { let asks = 0; while (lo < hi) { const mid = Math.floor((lo + hi + 1) / 2), v = ok(mid); if (asks < 5) { T.at(Object.assign({ lo, hi, mid }, show ? show(mid) : {})); T.yn(label(mid), v, v ? 'Feasible: search right (lo = mid).' : 'Not feasible: search left (hi = mid − 1).'); asks++; } if (v) lo = mid; else hi = mid - 1; } if (!asks) { T.at({ answer: lo }); T.n('The range has one value. What is it?', lo, 'lo = hi.'); } return lo; };

  D('maximize-the-minimum-game-score', {
    t: 'Maximize the Minimum Game Score',
    r: 'Binary search the target v. Index i needs v divided by points[i] (rounded up) visits. Walk left to right: enter i once, then bounce from i to i + 1 and back to i for each extra visit (2 moves each), which also pre-pays visits to i + 1. Feasible if the moves stay at most m.',
    g: R => ({ points: R.ints(R.int(2, 4), 1, 5), m: R.int(1, 12) }),
    s(I, T) { const p = I.points, n = p.length; const moves = v => { let mv = 0, prev = 0; for (let i = 0; i < n; i++) { let k = Math.ceil(v / p[i]) - prev; if (i === n - 1 && k <= 0) break; k = Math.max(k, 1); mv += 2 * k - 1; prev = k - 1; if (mv > I.m) return mv; } return mv; }; return lastTrue(0, Math.min(...p) * I.m, v => moves(v) <= I.m, T, v => ({ points: A(p), movesNeeded: moves(v) }), v => `Can every game reach score ${v} within ${I.m} moves?`); }
  });

  D('separate-squares-i', {
    t: 'Separate Squares I',
    r: 'Area below a line y grows continuously with y (overlaps count twice). Binary search on real y for the lowest line where area below reaches half the total.',
    g: R => ({ squares: Array.from({ length: R.int(1, 4) }, () => [R.int(0, 5), R.int(0, 6), R.int(1, 4)]) }),
    cmp: 'float',
    s(I, T) { const below = y => I.squares.reduce((s, [, y0, l]) => s + l * Math.min(l, Math.max(0, y - y0)), 0), tot = I.squares.reduce((s, [, , l]) => s + l * l, 0); T.at({ squares: A(I.squares.map(q => q.join('/'))) }); T.n('Total area?', tot, 'the sum of l², overlaps counted separately.'); let lo = Math.min(...I.squares.map(q => q[1])), hi = Math.max(...I.squares.map(q => q[1] + q[2])), asks = 0; for (let it = 0; it < 100; it++) { const mid = (lo + hi) / 2, v = below(mid) >= tot / 2; if (asks < 3 && Number.isInteger(mid * 2)) { T.at({ lo, hi, y: mid, areaBelow: below(mid) }); T.yn(`At y = ${mid}, is the area below at least half (${tot / 2})?`, v, v ? 'Move hi down.' : 'Move lo up.'); asks++; } if (v) hi = mid; else lo = mid; } return hi; }
  });

  D('shortest-matching-substring', {
    t: 'Shortest Substring Matching a*b*c',
    r: 'Split p into a, b, c around the stars and list all occurrences of each (KMP). For each start of a, binary search the earliest b after it, then the earliest c after that b; the window ends at the end of c.',
    g: R => { const s = R.str(R.int(1, 10), 'ab'), p = [R.str(R.int(0, 2), 'ab'), R.str(R.int(0, 2), 'ab'), R.str(R.int(0, 2), 'ab')].join('*'); return { s, p }; },
    s(I, T) { const res = (() => { const s = I.s, [a, b, c] = I.p.split('*'); const occ = x => { const r = []; for (let i = 0; i + x.length <= s.length; i++) if (s.startsWith(x, i)) r.push(i); return r; }; const oa = occ(a), ob = occ(b), oc = occ(c); T.at({ s: A([...s]), a, b, c }); T.n(`How many places does "${b}" occur (empty matches every gap)?`, ob.length, 'Collect all occurrences.'); T.n(`How many places does "${a}" occur?`, oa.length, 'Each one is a possible window start.'); let best = Infinity; for (const i of oa) { const j = lowerBound(ob, i + a.length); if (j === ob.length) continue; const k = lowerBound(oc, ob[j] + b.length); if (k === oc.length) continue; best = Math.min(best, oc[k] + c.length - i); } return best === Infinity ? -1 : best; })(); T.n('Shortest matching length? (−1 if none)', res, 'Best window over all starts.'); return res; }
  });

  D('maximize-the-distance-between-points-on-a-square', {
    t: 'Maximize the Distance Between Points on a Square',
    r: 'Unroll the boundary into a line of length 4 times side; for answers at most side, Manhattan distance equals the perimeter distance. Binary search d: from each start, greedily jump to the next point at least d further (binary search), k − 1 times, and check the wrap-around gap.',
    g: R => { const side = R.int(1, 4), all = []; for (let x = 0; x <= side; x++) for (let y = 0; y <= side; y++) if (x === 0 || y === 0 || x === side || y === side) all.push([x, y]); const pts = R.shuffle(all).slice(0, Math.max(4, R.int(4, Math.min(all.length, 8)))); return { side, points: pts, k: R.int(4, Math.min(pts.length, 5)) }; },
    s(I, T) { const S = I.side, P = 4 * S, pos = I.points.map(([x, y]) => x === 0 ? y : y === S ? S + x : x === S ? 3 * S - y : P - x).sort((a, b) => a - b); T.at({ side: S, perimeterPos: A(pos) }); T.n('Perimeter position of the point farthest along?', pos[pos.length - 1], 'Walk up the left edge, right on top, down the right, left along the bottom.'); const ok = d => { for (let s = 0; s < pos.length; s++) { let cur = pos[s], j = s, good = true; for (let t = 1; t < I.k; t++) { j = lowerBound(pos, cur + d); if (j >= pos.length) { good = false; break; } cur = pos[j]; } if (good && P - (cur - pos[s]) >= d) return true; } return false; }; return lastTrue(0, S, ok, T, d => ({ feasible: ok(d) }), d => `Can ${I.k} points be at least ${d} apart?`); }
  });
})();
