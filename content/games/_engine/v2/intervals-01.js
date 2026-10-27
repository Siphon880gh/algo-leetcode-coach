/* v2 games: intervals and sweep lines (01). */
(function () {
  'use strict';
  const { D, A } = LCGame.H;

  D('missing-ranges', {
    t: 'Missing Ranges',
    r: 'Walk the sorted numbers with a "next expected" value starting at lower; each jump past it emits [expected, num − 1]. Finish with [expected, upper] if anything is left.',
    g: R => { const lo = R.int(-3, 3), up = lo + R.int(0, 12); return { nums: R.distinct(R.int(0, Math.min(5, up - lo + 1)), lo, up).sort((a, b) => a - b), lower: lo, upper: up }; },
    s(I, T) { const out = []; let exp = I.lower; I.nums.forEach((x, i) => { if (x > exp) out.push([exp, x - 1]); exp = x + 1; if (i < 5) { T.at({ nums: A(I.nums, { i }), missing: A(out.map(r => r.join(' to '))) }); T.n('Next expected value?', exp, 'One past the current number.'); } }); if (exp <= I.upper) out.push([exp, I.upper]); if (!I.nums.length) { T.at({ range: `${I.lower}..${I.upper}` }); T.n('Size of the single missing range?', I.upper - I.lower + 1, 'Nothing is present.'); } return out; }
  });

  D('teemo-attacking', {
    t: 'Teemo Attacking',
    r: 'Each attack adds min(duration, gap to the next attack) of poison; the last attack adds the full duration.',
    g: R => ({ timeSeries: R.distinct(R.int(1, 6), 0, 15).sort((a, b) => a - b), duration: R.int(1, 4) }),
    s(I, T) { const t = I.timeSeries; let s = 0; t.forEach((x, i) => { const add = i + 1 < t.length ? Math.min(I.duration, t[i + 1] - x) : I.duration; s += add; if (i < 5) { T.at({ attacks: A(t, { i }) }); T.n('Poison seconds this attack contributes?', add, 'Cut short by the next attack.'); } }); return s; }
  });

  D('set-intersection-size-at-least-two', {
    t: 'Set Intersection Size At Least Two',
    r: 'Sort by end ascending (start descending on ties). Keep the two largest chosen points a < b. If an interval misses both, add end − 1 and end; if it contains only b, add end; otherwise nothing.',
    g: R => ({ intervals: Array.from({ length: R.int(1, 5) }, () => { const a = R.int(0, 8); return [a, a + R.int(1, 4)]; }) }),
    s(I, T) { const iv = I.intervals.slice().sort((p, q) => p[1] - q[1] || q[0] - p[0]); let a = -Infinity, b = -Infinity, c = 0; iv.forEach(([s, e], i) => { let add = 0; if (s > b) { add = 2; a = e - 1; b = e; } else if (s > a) { add = 1; a = b; b = e; } c += add; if (i < 5) { T.at({ interval: `[${s}, ${e}]`, lastTwo: `${a}, ${b}` }); T.n('Points added for this interval?', add, 'Reuse the largest chosen points when they fall inside.'); } }); return c; }
  });

  D('remove-interval', {
    t: 'Remove Interval',
    r: 'For each sorted disjoint interval keep the part left of the removed range and the part right of it (if non-empty).',
    g: R => { const pts = R.distinct(2 * R.int(1, 3), 0, 14).sort((a, b) => a - b), iv = []; for (let i = 0; i < pts.length; i += 2) iv.push([pts[i], pts[i + 1]]); const a = R.int(0, 12); return { intervals: iv, toBeRemoved: [a, a + R.int(1, 5)] }; },
    s(I, T) { const [x, y] = I.toBeRemoved, out = []; I.intervals.forEach(([a, b], i) => { const before = out.length; if (a < x) out.push([a, Math.min(b, x)]); if (b > y) out.push([Math.max(a, y), b]); if (i < 4) { T.at({ interval: `[${a}, ${b})`, remove: `[${x}, ${y})` }); T.n('Pieces kept from this interval?', out.length - before, 'Left part and or or right part.'); } }); return out; }
  });

  D('remove-covered-intervals', {
    t: 'Remove Covered Intervals',
    r: 'Sort by start ascending, end descending. An interval is covered exactly when its end at most the max end seen so far; count the rest.',
    g: R => ({ intervals: Array.from({ length: R.int(1, 6) }, () => { const a = R.int(0, 8); return [a, a + R.int(1, 5)]; }).filter((v, i, arr) => arr.findIndex(w => w[0] === v[0] && w[1] === v[1]) === i) }),
    s(I, T) { const iv = I.intervals.slice().sort((p, q) => p[0] - q[0] || q[1] - p[1]); let mx = -Infinity, c = 0; iv.forEach(([a, b], i) => { const cov = b <= mx; if (!cov) c++; mx = Math.max(mx, b); if (i < 5) { T.at({ sorted: A(iv.map(v => v.join(' to ')), { i }) }); T.yn('Covered by an earlier interval?', cov, 'End within the max end so far.'); } }); return c; }
  });

  D('minimum-number-of-taps-to-open-to-water-a-garden', {
    t: 'Minimum Number of Taps to Open to Water a Garden',
    r: 'Convert taps to "from x you can reach y" (max reach per left end), then greedy jump-game: extend the current coverage with the farthest reach; count jumps, −1 if stuck.',
    g: R => { const n = R.int(1, 8); return { n, ranges: R.ints(n + 1, 0, 3) }; },
    s(I, T) { const res = (() => { const n = I.n, reach = Array(n + 1).fill(0); I.ranges.forEach((r, i) => { const l = Math.max(0, i - r); reach[l] = Math.max(reach[l], Math.min(n, i + r)); }); T.at({ reach: A(reach) }); T.n('Farthest reach starting from position 0?', reach[0], 'Best tap whose left end is 0.'); let taps = 0, end = 0, far = 0; for (let i = 0; i <= n; i++) { if (i > far) return -1; if (i > end) { taps++; end = far; if (taps <= 4) { T.at({ reach: A(reach, { i }) }); T.n('Coverage end after opening this tap?', end, 'Farthest reach from the covered part.'); } } far = Math.max(far, reach[i]); } return taps + (end < n ? 1 : 0); })(); T.n('Fewest taps? (−1 if impossible)', res, 'Count of coverage extensions.'); return res; }
  });

  D('maximum-number-of-non-overlapping-substrings', {
    t: 'Maximum Number of Non-Overlapping Substrings',
    r: 'For each letter, expand [first, last] until it contains every occurrence of every letter inside; discard it if that needs going left. Valid intervals nest or are disjoint, so greedily take them by smallest end.',
    cmp: 'set',
    g: R => ({ s: R.str(R.int(1, 9), 'abcd') }),
    s(I, T) { const s = I.s, f = {}, l = {}; [...s].forEach((c, i) => { if (f[c] === undefined) f[c] = i; l[c] = i; }); const iv = []; Object.keys(f).sort().forEach(c => { let a = f[c], b = l[c], ok = true; for (let i = a; i <= b; i++) { if (f[s[i]] < a) { ok = false; break; } b = Math.max(b, l[s[i]]); } if (iv.length < 4) { T.at({ letter: c, s: A([...s], { l: f[c], r: l[c] }) }); T.yn('Is its closed-up interval valid?', ok, 'No letter inside may appear before it.'); } if (ok) iv.push([a, b]); }); iv.sort((p, q) => p[1] - q[1]); const out = []; let end = -1; iv.forEach(([a, b]) => { if (a > end) { out.push(s.slice(a, b + 1)); end = b; } }); return out; }
  });

  D('describe-the-painting', {
    t: 'Describe the Painting',
    r: 'Sweep line: add color at start, subtract at end. Between consecutive event points the mixed set is constant; emit [x, nextX, sum] when the sum is non-zero.',
    cmp: 'set',
    g: R => ({ segments: R.distinct(R.int(1, 4), 1, 15).map(c => { const a = R.int(1, 8); return [a, a + R.int(1, 4), c]; }) }),
    s(I, T) { const ev = new Map(); I.segments.forEach(([a, b, c]) => { ev.set(a, (ev.get(a) || 0) + c); ev.set(b, (ev.get(b) || 0) - c); }); const xs = [...ev.keys()].sort((a, b) => a - b), out = []; let cur = 0; xs.forEach((x, i) => { cur += ev.get(x); if (i < 5) { T.at({ x, events: A(xs, { i }) }); T.n('Mixed color sum right after this point?', cur, 'Running sum of start or end deltas.'); } if (cur && i + 1 < xs.length) out.push([x, xs[i + 1], cur]); }); return out; }
  });

  D('average-height-of-buildings-in-each-segment', {
    t: 'Average Height of Buildings in Each Segment',
    r: 'Sweep events tracking (total height, count). Between event points the average is floor(total divided by count); merge adjacent segments with equal averages and skip empty stretches.',
    cmp: 'set',
    g: R => ({ buildings: Array.from({ length: R.int(1, 4) }, () => { const a = R.int(1, 8); return [a, a + R.int(1, 4), R.int(1, 5)]; }) }),
    s(I, T) { const ev = new Map(); I.buildings.forEach(([a, b, h]) => { const p = ev.get(a) || [0, 0], q = ev.get(b) || [0, 0]; ev.set(a, [p[0] + h, p[1] + 1]); ev.set(b, [q[0] - h, q[1] - 1]); }); const xs = [...ev.keys()].sort((a, b) => a - b), out = []; let s = 0, c = 0; xs.forEach((x, i) => { s += ev.get(x)[0]; c += ev.get(x)[1]; if (!c || i + 1 === xs.length) return; const avg = Math.floor(s / c); if (out.length < 4) { T.at({ x, height: s, count: c }); T.n('Average height on the next stretch?', avg, 'floor(total divided by count).'); } const last = out[out.length - 1]; if (last && last[1] === x && last[2] === avg) last[1] = xs[i + 1]; else out.push([x, xs[i + 1], avg]); }); return out; }
  });

  D('brightest-position-on-street', {
    t: 'Brightest Position on Street',
    r: 'Each lamp lights [p − r, p + r]: +1 at the left end, −1 just after the right end. Sweep sorted event points and keep the first position with the highest running brightness.',
    g: R => ({ lights: Array.from({ length: R.int(1, 5) }, () => [R.int(-5, 5), R.int(0, 3)]) }),
    s(I, T) { const ev = new Map(); I.lights.forEach(([p, r]) => { ev.set(p - r, (ev.get(p - r) || 0) + 1); ev.set(p + r + 1, (ev.get(p + r + 1) || 0) - 1); }); const xs = [...ev.keys()].sort((a, b) => a - b); let cur = 0, best = -1, pos = 0; xs.forEach((x, i) => { cur += ev.get(x); if (cur > best) { best = cur; pos = x; } if (i < 5) { T.at({ x, events: A(xs, { i }) }); T.n('Brightness from here?', cur, 'Running sum of +1 and −1 events.'); } }); return pos; }
  });
})();
