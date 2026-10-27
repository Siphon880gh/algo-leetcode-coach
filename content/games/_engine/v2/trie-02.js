/* v2 games: tries (02). */
(function () {
  'use strict';
  const { D, A, GR } = LCGame.H;
  const uniq = a => [...new Set(a)];
  const bits = x => x.toString(2).padStart(4, '0');

  D('maximum-xor-with-an-element-from-array', {
    t: 'Maximum XOR With an Element From Array',
    r: 'Offline: sort nums and queries by m; insert nums ≤ m into a binary trie, then greedily walk opposite bits for x. Empty trie → −1.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 15), queries: Array.from({ length: R.int(1, 4) }, () => [R.int(0, 15), R.int(0, 15)]) }),
    s(I, T) { return I.queries.map(([x, m], i) => { const ok = I.nums.filter(v => v <= m), b = ok.length ? Math.max(...ok.map(v => v ^ x)) : -1; if (i < 4) { T.at({ x: bits(x), allowed: A(ok) }); T.n('Best XOR (−1 if no allowed value)?', b, 'Trie holds only values ≤ m.'); } return b; }); }
  });

  D('count-pairs-with-xor-in-a-range', {
    t: 'Count Pairs With XOR in a Range',
    r: 'count(< high + 1) − count(< low). With a binary trie storing subtree counts, count earlier values whose XOR with x is < K by walking K\'s bits: where K has a 1, add the subtree that keeps the XOR bit 0.',
    g: R => { const lo = R.int(0, 8); return { nums: R.ints(R.int(1, 6), 0, 15), low: lo, high: lo + R.int(0, 7) }; },
    s(I, T) { let c = 0; I.nums.forEach((x, j) => { const k = I.nums.slice(0, j).filter(y => { const v = x ^ y; return I.low <= v && v <= I.high; }).length; c += k; if (j < 5) { T.at({ nums: A(I.nums, { i: j }) }); T.n('Earlier partners with XOR in range?', k, 'Two trie prefix-counts.'); } }); return c; }
  });

  D('longest-word-with-all-prefixes', {
    t: 'Longest Word With All Prefixes',
    r: 'Insert words into a trie; a word qualifies iff every node along its path is a word end. Keep the longest, tie-breaking lexicographically.',
    g: R => { const w = []; for (let i = R.int(1, 3); i > 0; i--) { const s = R.str(R.int(1, 4), 'ab'); for (let k = 1; k <= s.length; k++) if (R.chance(0.75)) w.push(s.slice(0, k)); } if (!w.length) w.push('b'); return { words: uniq(w) }; },
    s(I, T) { const set = new Set(I.words); let best = ''; I.words.forEach((w, i) => { let ok = true; for (let k = 1; k < w.length; k++) if (!set.has(w.slice(0, k))) ok = false; if (i < 5) { T.at({ word: w }); T.yn('Are all its prefixes words?', ok, 'Every trie node on the path must end a word.'); } if (ok && (w.length > best.length || (w.length === best.length && w < best))) best = w; }); return best; }
  });

  D('maximum-genetic-difference-query', {
    t: 'Maximum Genetic Difference Query',
    r: 'DFS from the root, inserting each node\'s value into a binary trie on entry and removing it on exit. At node u, the trie holds exactly its path to the root; answer its queries by greedy opposite-bit walks.',
    g: R => { const n = R.int(1, 7), o = R.perm(n), parents = Array(n); parents[o[0]] = -1; for (let k = 1; k < n; k++) parents[o[k]] = o[R.int(0, k - 1)]; return { parents, queries: Array.from({ length: R.int(1, 4) }, () => [R.int(0, n - 1), R.int(0, 15)]) }; },
    s(I, T) { return I.queries.map(([u, v], i) => { const path = []; for (let x = u; x !== -1; x = I.parents[x]) path.push(x); const b = Math.max(...path.map(p => p ^ v)); if (i < 4) { T.at({ path: A(path), val: v }); T.n('Max val XOR a node on the root path?', b, 'Trie contains exactly the path values.'); } return b; }); }
  });

  D('delete-duplicate-folders-in-system', {
    t: 'Delete Duplicate Folders in System',
    r: 'Build a folder trie, serialize each node\'s subtree (sorted children), count non-empty serializations, then DFS again skipping every node whose serialization appears twice or more.',
    cmp: 'set',
    g: R => { const set = new Set(); for (let i = R.int(1, 5); i > 0; i--) { const p = Array.from({ length: R.int(1, 3) }, () => R.pick(['a', 'b', 'x'])); for (let k = 1; k <= p.length; k++) set.add(p.slice(0, k).join('/')); } return { paths: [...set].map(s => s.split('/')) }; },
    s(I, T) { const root = {}; I.paths.forEach(p => { let n = root; p.forEach(x => n = n[x] = n[x] || {}); }); const ser = new Map(), cnt = {}; const go = n => { const s = Object.keys(n).sort().map(k => k + '(' + go(n[k]) + ')').join(''); ser.set(n, s); if (s) cnt[s] = (cnt[s] || 0) + 1; return s; }; go(root); const out = []; let k = 0; const walk = (n, path) => Object.keys(n).sort().forEach(c => { const s = ser.get(n[c]), dup = !!s && cnt[s] > 1; if (k++ < 4) { T.at({ folder: '/' + [...path, c].join('/'), structure: s || '(empty)' }); T.yn('Deleted as a duplicate?', dup, 'Same non-empty subtree shape appears elsewhere.'); } if (!dup) { out.push([...path, c]); walk(n[c], [...path, c]); } }); walk(root, []); return out; }
  });

  D('k-divisible-elements-subarrays', {
    t: 'K Divisible Elements Subarrays',
    r: 'For each start, extend right while the count of multiples of p stays ≤ k, inserting each subarray into a trie keyed by values; new nodes are new distinct subarrays.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 4), k: R.int(1, 3), p: R.int(1, 3) }),
    s(I, T) { const seen = new Set(); I.nums.forEach((_, i) => { let c = 0, fresh = 0; for (let j = i; j < I.nums.length; j++) { if (I.nums[j] % I.p === 0) c++; if (c > I.k) break; const key = I.nums.slice(i, j + 1).join(','); if (!seen.has(key)) { seen.add(key); fresh++; } } if (i < 5) { T.at({ nums: A(I.nums, { i }) }); T.n('New distinct subarrays starting here?', fresh, 'New trie nodes before exceeding k multiples.'); } }); return seen.size; }
  });

  D('sum-of-prefix-scores-of-strings', {
    t: 'Sum of Prefix Scores of Strings',
    r: 'Insert all words into a trie, incrementing a pass-through counter at each node. A word\'s score is the sum of counters along its path.',
    g: R => ({ words: Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 4), 'ab')) }),
    s(I, T) { return I.words.map((w, i) => { let s = 0; for (let k = 1; k <= w.length; k++) s += I.words.filter(o => o.startsWith(w.slice(0, k))).length; if (i < 4) { T.at({ word: w, words: A(I.words) }); T.n('Score?', s, 'Sum of pass counts on its trie path.'); } return s; }); }
  });

  D('words-within-two-edits-of-dictionary', {
    t: 'Words Within Two Edits of Dictionary',
    r: 'For each query, compare against dictionary words (or DFS a trie allowing at most two mismatches) — keep it if some word differs in ≤ 2 positions. Preserve query order.',
    g: R => { const L = R.int(1, 5); return { queries: Array.from({ length: R.int(1, 4) }, () => R.str(L, 'abc')), dictionary: Array.from({ length: R.int(1, 3) }, () => R.str(L, 'abc')) }; },
    s(I, T) { return I.queries.filter((q, i) => { const d = Math.min(...I.dictionary.map(w => [...w].filter((c, k) => c !== q[k]).length)); if (i < 4) { T.at({ query: q, dictionary: A(I.dictionary) }); T.n('Fewest edits to some dictionary word?', d, 'Count mismatched positions.'); } return d <= 2; }); }
  });

  D('maximum-xor-of-two-non-overlapping-subtrees', {
    t: 'Maximum XOR of Two Non-Overlapping Subtrees',
    r: 'Compute subtree sums. DFS: before entering a node, query a binary trie of sums from fully finished, non-ancestor subtrees; after finishing a node, insert its sum. Max XOR found (0 if none).',
    g: R => { const n = R.int(2, 7), edges = []; for (let i = 1; i < n; i++) edges.push([R.int(0, i - 1), i]); return { n, edges, values: R.ints(n, 1, 9) }; },
    s(I, T) { const res = (() => { const adj = Array.from({ length: I.n }, () => []); I.edges.forEach(([a, b]) => { adj[a].push(b); adj[b].push(a); }); const sum = [], tin = [], tout = []; let t = 0; const dfs = (u, p) => { tin[u] = t++; sum[u] = I.values[u]; adj[u].forEach(v => { if (v !== p) { dfs(v, u); sum[u] += sum[v]; } }); tout[u] = t; }; dfs(0, -1); T.at({ tree: GR(I.n, I.edges), sums: A(sum) }); T.n('Subtree sum of the root?', sum[0], 'All values together.'); if (adj[0].length) T.n(`Subtree sum of node ${adj[0][0]}?`, sum[adj[0][0]], 'Its value plus all its descendants.'); else T.n('Nodes in the tree?', I.n, 'Only the root.'); let best = 0; for (let a = 0; a < I.n; a++) for (let b = 0; b < I.n; b++) { const anc = (x, y) => tin[x] <= tin[y] && tout[y] <= tout[x]; if (a !== b && !anc(a, b) && !anc(b, a)) best = Math.max(best, sum[a] ^ sum[b]); } return best; })(); T.n('Maximum XOR? (0 if none)', res, 'Best pair of subtrees where neither contains the other.'); return res; }
  });

  D('extra-characters-in-a-string', {
    t: 'Extra Characters in a String',
    r: 'dp[i] = fewest extra characters in s[i..]. Either skip s[i] (1 + dp[i+1]) or, walking a trie from i, jump past any dictionary word: dp[j+1].',
    g: R => ({ s: R.str(R.int(1, 8), 'ab'), dictionary: uniq(Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 3), 'ab'))) }),
    s(I, T) { const s = I.s, n = s.length, dp = Array(n + 1).fill(0); for (let i = n - 1; i >= 0; i--) { dp[i] = 1 + dp[i + 1]; I.dictionary.forEach(w => { if (s.startsWith(w, i)) dp[i] = Math.min(dp[i], dp[i + w.length]); }); if (n - i <= 5) { T.at({ s: A([...s], { i }), dp: A(dp.slice(i)) }); T.n('dp here?', dp[i], 'Skip the char, or jump over a word.'); } } return dp[0]; }
  });

  D('maximum-strong-pair-xor-ii', {
    t: 'Maximum Strong Pair XOR II',
    r: 'Sort; y pairs with x ≤ y iff y ≤ 2x. Sliding window over sorted values with a binary trie supporting insert/delete; query max XOR within the window.',
    g: R => ({ nums: R.ints(R.int(1, 6), 1, 20) }),
    s(I, T) { let best = 0; const a = I.nums.slice().sort((x, y) => x - y); a.forEach((x, i) => { const w = a.filter(y => Math.abs(x - y) <= Math.min(x, y)), b = Math.max(...w.map(y => x ^ y)); best = Math.max(best, b); if (i < 4) { T.at({ sorted: A(a, { i }), strong: A(w) }); T.n('Best XOR with a strong partner?', b, 'Partners within [x/2, 2x].'); } }); return best; }
  });

  D('minimum-cost-to-convert-string-ii', {
    t: 'Minimum Cost to Convert String II',
    r: 'Floyd-Warshall over the rule strings of each length gives cheapest substring conversions (trie ids make lookups fast). Then dp over positions: copy equal chars for free or convert a whole substring at once.',
    g: R => { const n = R.int(1, 4), k = R.int(1, 4), L = Array.from({ length: k }, () => R.int(1, 2)); return { source: R.str(n, 'ab'), target: R.str(n, 'ab'), original: L.map(l => R.str(l, 'ab')), changed: L.map(l => R.str(l, 'ab')), cost: R.ints(k, 1, 9) }; },
    s(I, T) { const res = (() => { const dist = {}; I.original.forEach((a, i) => { const b = I.changed[i], d = dist[a.length] = dist[a.length] || {}; [a, b].forEach(x => { d[x] = d[x] || { [x]: 0 }; }); d[a][b] = Math.min(d[a][b] ?? Infinity, I.cost[i]); }); Object.values(dist).forEach(d => { const ks = Object.keys(d); ks.forEach(m => ks.forEach(a => ks.forEach(b => { const v = (d[a][m] ?? Infinity) + (d[m][b] ?? Infinity); if (v < (d[a][b] ?? Infinity)) d[a][b] = v; }))); }); const s = I.source, t = I.target, n = s.length, dp = Array(n + 1).fill(Infinity); dp[0] = 0; for (let i = 0; i < n; i++) { if (dp[i] === Infinity) continue; if (s[i] === t[i]) dp[i + 1] = Math.min(dp[i + 1], dp[i]); Object.keys(dist).forEach(L => { L = +L; if (i + L > n) return; const c = dist[L][s.slice(i, i + L)]?.[t.slice(i, i + L)]; if (c !== undefined) dp[i + L] = Math.min(dp[i + L], dp[i] + c); }); } T.at({ source: A([...s]), target: A([...t]) }); T.n('Positions that already match?', [...s].filter((c, i) => c === t[i]).length, 'Those can be copied for free.'); T.n('Different rule lengths?', Object.keys(dist).length, 'One cheapest-cost table per length.'); return dp[n] === Infinity ? -1 : dp[n]; })(); T.n('Minimum cost? (−1 if impossible)', res, 'dp over positions.'); return res; }
  });

  D('count-prefix-and-suffix-pairs-i', {
    t: 'Count Prefix and Suffix Pairs I',
    r: 'For each pair i < j, check whether words[i] is both a prefix and a suffix of words[j]. (Part II uses a trie keyed by (s[k], s[n−1−k]) pairs.)',
    g: R => ({ words: Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 4), 'ab')) }),
    s(I, T) { let c = 0; I.words.forEach((w, j) => { const k = I.words.slice(0, j).filter(v => w.startsWith(v) && w.endsWith(v)).length; c += k; if (j < 5) { T.at({ words: A(I.words, { i: j }) }); T.n('Earlier words that are prefix and suffix of this one?', k, 'Check both ends.'); } }); return c; }
  });

  D('find-the-length-of-the-longest-common-prefix', {
    t: 'Find the Length of the Longest Common Prefix',
    r: 'Insert all digit-prefixes of arr1 into a set (or a digit trie); for each number in arr2, walk its digits and record the longest prefix found.',
    g: R => ({ arr1: R.ints(R.int(1, 4), 1, 300), arr2: R.ints(R.int(1, 4), 1, 300) }),
    s(I, T) { const set = new Set(); I.arr1.forEach(x => { const s = String(x); for (let k = 1; k <= s.length; k++) set.add(s.slice(0, k)); }); let best = 0; I.arr2.forEach((y, i) => { const s = String(y); let L = 0; for (let k = 1; k <= s.length; k++) if (set.has(s.slice(0, k))) L = k; best = Math.max(best, L); if (i < 4) { T.at({ arr1: A(I.arr1), number: y }); T.n('Longest common prefix length for it?', L, 'Deepest trie node reached.'); } }); return best; }
  });

  D('count-prefix-and-suffix-pairs-ii', {
    t: 'Count Prefix and Suffix Pairs II',
    r: 'Trie keyed by character pairs (s[k], s[n−1−k]): a word is both prefix and suffix of s exactly when its pair-path is a prefix of s\'s pair-path. Insert each word, counting end markers passed.',
    g: R => ({ words: Array.from({ length: R.int(1, 6) }, () => R.str(R.int(1, 4), 'ab')) }),
    s(I, T) { let c = 0; I.words.forEach((w, j) => { const k = I.words.slice(0, j).filter(v => w.startsWith(v) && w.endsWith(v)).length; c += k; if (j < 5) { T.at({ words: A(I.words, { i: j }), pairs: A([...w].map((ch, i) => ch + w[w.length - 1 - i])) }); T.n('End markers passed on its pair-path?', k, 'Earlier words that are both prefix and suffix.'); } }); return c; }
  });

  D('shortest-uncommon-substring-in-an-array', {
    t: 'Shortest Uncommon Substring in an Array',
    r: 'Count, for every substring, which strings contain it (a suffix trie with owner sets). For each string, the answer is its shortest, then lexicographically smallest, substring owned by it alone — or "".',
    g: R => ({ arr: Array.from({ length: R.int(2, 4) }, () => R.str(R.int(1, 4), 'ab')) }),
    s(I, T) { return I.arr.map((s, i) => { let best = null; for (let a = 0; a < s.length; a++) for (let b = a + 1; b <= s.length; b++) { const t = s.slice(a, b); if (I.arr.some((o, j) => j !== i && o.includes(t))) continue; if (!best || t.length < best.length || (t.length === best.length && t < best)) best = t; } const ans = best || ''; if (i < 4) { T.at({ arr: A(I.arr, { i }) }); T.n('Length of its shortest uncommon substring (0 if none)?', ans.length, 'Substrings no other string contains.'); } return ans; }); }
  });

  D('longest-common-suffix-queries', {
    t: 'Longest Common Suffix Queries',
    r: 'Insert reversed container words into a trie; each node remembers the best index (shortest word, then earliest). Walk the reversed query as far as possible and return that node\'s index.',
    g: R => ({ wordsContainer: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 4), 'ab')), wordsQuery: Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 4), 'ab')) }),
    s(I, T) { const W = I.wordsContainer, cs = (a, b) => { let k = 0; while (k < a.length && k < b.length && a[a.length - 1 - k] === b[b.length - 1 - k]) k++; return k; }; return I.wordsQuery.map((q, i) => { let bi = 0; W.forEach((w, j) => { const x = cs(w, q), y = cs(W[bi], q); if (x > y || (x === y && w.length < W[bi].length)) bi = j; }); if (i < 4) { T.at({ query: q, container: A(W) }); T.n('Longest common suffix length?', cs(W[bi], q), 'Depth reached in the reversed trie.'); } return bi; }); }
  });

  D('minimum-number-of-valid-strings-to-form-target-i', {
    t: 'Minimum Number of Valid Strings to Form Target I',
    r: 'Trie of all words. dp[i] = min pieces for target[..i]; from each reachable i, walk the trie along target[i..] and relax dp[j] for every node reached (each node is a valid prefix).',
    g: R => ({ words: Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 4), 'ab')), target: R.str(R.int(1, 7), 'ab') }),
    s(I, T) { const t = I.target, n = t.length, dp = Array(n + 1).fill(Infinity); dp[0] = 0; for (let i = 0; i < n; i++) { if (dp[i] === Infinity) continue; let m = 0; I.words.forEach(w => { let k = 0; while (k < w.length && i + k < n && w[k] === t[i + k]) k++; m = Math.max(m, k); }); for (let k = 1; k <= m; k++) dp[i + k] = Math.min(dp[i + k], dp[i] + 1); if (i < 5) { T.at({ target: A([...t], { i }) }); T.n('How deep does the trie walk go from here?', m, 'Every node on the way is a valid prefix.'); } } return dp[n] === Infinity ? -1 : dp[n]; }
  });
})();
