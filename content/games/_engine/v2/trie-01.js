/* v2 games: tries (01). */
(function () {
  'use strict';
  const { D, A, G } = LCGame.H;
  const isPal = s => s === [...s].reverse().join('');
  const uniq = a => [...new Set(a)];

  D('word-break-ii', {
    t: 'Word Break II',
    r: 'DFS from each start index, walking a trie of the dictionary to find every word that begins there; memoize the sentences for each suffix.',
    cmp: 'set',
    g: R => ({ s: R.str(R.int(1, 7), 'ab'), wordDict: uniq(Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 3), 'ab'))) }),
    s(I, T) { const res = (() => { const s = I.s, memo = {}; const go = i => { if (i === s.length) return ['']; if (memo[i]) return memo[i]; const out = []; I.wordDict.forEach(w => { if (s.startsWith(w, i)) go(i + w.length).forEach(t => out.push(t ? w + ' ' + t : w)); }); return memo[i] = out; }; const words0 = I.wordDict.filter(w => s.startsWith(w)); T.at({ s: A([...s]), dict: A(I.wordDict) }); T.n('Longest dictionary word?', Math.max(...I.wordDict.map(w => w.length)), 'No match can be longer.'); T.n('Dictionary words starting at index 0?', words0.length, 'Walk the trie from s[0].'); return go(0); })(); T.n('How many sentences?', res.length, 'Every full split of s.'); return res; }
  });

  D('word-search-ii', {
    t: 'Word Search II',
    r: 'Build a trie of the words and DFS from every cell, following only trie edges; record a word when you reach its end node. One pass finds all words.',
    cmp: 'set',
    g: R => { const m = R.int(1, 3), n = R.int(1, 3); return { board: Array.from({ length: m }, () => [...R.str(n, 'abc')]), words: uniq(Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 4), 'abc'))) }; },
    s(I, T) { const B = I.board, m = B.length, n = B[0].length, found = w => { const seen = new Set(); const dfs = (r, c, k) => { if (r < 0 || c < 0 || r >= m || c >= n || seen.has(r * n + c) || B[r][c] !== w[k]) return false; if (k === w.length - 1) return true; seen.add(r * n + c); const ok = dfs(r + 1, c, k + 1) || dfs(r - 1, c, k + 1) || dfs(r, c + 1, k + 1) || dfs(r, c - 1, k + 1); seen.delete(r * n + c); return ok; }; for (let r = 0; r < m; r++) for (let c = 0; c < n; c++) if (dfs(r, c, 0)) return true; return false; }; return I.words.filter((w, i) => { const ok = found(w); if (i < 4) { T.at({ board: G(B), word: w }); T.yn('Is this word on the board?', ok, 'Adjacent cells, no reuse.'); } return ok; }); }
  });

  D('palindrome-pairs', {
    t: 'Palindrome Pairs',
    r: 'For each word, split it into prefix + suffix. If prefix is a palindrome and reverse(suffix) is a word, pair it before; if suffix is a palindrome and reverse(prefix) is a word, pair it after. A trie of reversed words makes the lookups fast.',
    cmp: 'set',
    g: R => ({ words: uniq(Array.from({ length: R.int(2, 5) }, () => R.str(R.int(0, 3), 'ab'))) }),
    s(I, T) { const res = (() => { const W = I.words, out = []; W.forEach((a, i) => W.forEach((b, j) => { if (i !== j && isPal(a + b)) out.push([i, j]); })); T.at({ words: A(W.map(w => w || '""')) }); T.n('Ordered pairs to check?', W.length * (W.length - 1), 'Every word with every other word.'); T.yn(`Is "${W[0]}" + "${W[1]}" a palindrome?`, isPal(W[0] + W[1]), 'Check the concatenation.'); return out; })(); T.n('Palindrome pairs?', res.length, 'Ordered pairs whose join reads the same both ways.'); return res; }
  });

  D('lexicographical-numbers', {
    t: 'Lexicographical Numbers',
    r: 'Preorder walk of the implicit digit trie: from x go to x·10 if ≤ n; otherwise step to x + 1, first stripping trailing 9s / overflow by dividing by 10.',
    g: R => ({ n: R.int(1, 130) }),
    s(I, T) { const out = []; let x = 1; for (let i = 0; i < I.n; i++) { out.push(x); if (x * 10 <= I.n) x *= 10; else { while (x % 10 === 9 || x + 1 > I.n) x = Math.floor(x / 10); x++; } if (i < 6 && i + 1 < I.n) { T.at({ sofar: A(out.slice()) }); T.n('Next number?', x, 'Go deeper (×10) if possible, else to the next sibling.'); } } return out; }
  });

  D('maximum-xor-of-two-numbers-in-an-array', {
    t: 'Maximum XOR of Two Numbers in an Array',
    r: 'Insert numbers into a binary trie (high bit first). For each number, greedily walk toward the opposite bit at every level to maximize XOR.',
    g: R => ({ nums: R.ints(R.int(1, 6), 0, 31) }),
    s(I, T) { let best = 0; I.nums.forEach((x, i) => { const m = Math.max(...I.nums.map(y => x ^ y)); best = Math.max(best, m); if (i < 4) { T.at({ nums: A(I.nums, { i }), bits: x.toString(2).padStart(5, '0') }); T.n('Best XOR partner value for this number?', m, 'Prefer the opposite bit at each trie level.'); } }); return best; }
  });

  D('word-squares', {
    t: 'Word Squares',
    r: 'Backtrack row by row: row k must start with the prefix formed by column k of rows 0..k−1. A trie (or prefix map) lists candidate words for that prefix instantly.',
    cmp: 'set',
    g: R => { const L = R.int(1, 3); return { words: uniq(Array.from({ length: R.int(1, 5) }, () => R.str(L, 'ab'))) }; },
    s(I, T) { const W = I.words, L = W[0].length, out = [], rows = []; let k = 0; const go = () => { if (rows.length === L) { out.push(rows.slice()); return; } const p = rows.map(r => r[rows.length]).join(''), cand = W.filter(w => w.startsWith(p)); if (k++ < 4) { T.at({ rows: A(rows.slice()), prefix: p || '∅' }); T.n('Candidate words for the next row?', cand.length, 'Words starting with the column prefix.'); } cand.forEach(w => { rows.push(w); go(); rows.pop(); }); }; go(); return out; }
  });

  D('k-th-smallest-in-lexicographical-order', {
    t: 'K-th Smallest in Lexicographical Order',
    r: 'Count how many numbers ≤ n live under prefix p (level by level in the digit trie). If that count < k, skip the subtree (p + 1); otherwise descend (p × 10).',
    g: R => { const n = R.int(1, 200); return { n, k: R.int(1, n) }; },
    s(I, T) { const n = I.n, cnt = p => { let c = 0, a = p, b = p + 1; while (a <= n) { c += Math.min(n + 1, b) - a; a *= 10; b *= 10; } return c; }; let p = 1, k = I.k - 1, st = 0; while (k > 0) { const c = cnt(p); if (st++ < 5) { T.at({ prefix: p, kLeft: k }); T.n('Numbers under this prefix?', c, 'Sum the range sizes level by level.'); } if (c <= k) { k -= c; p++; } else { k--; p *= 10; } } return p; }
  });

  D('concatenated-words', {
    t: 'Concatenated Words',
    r: 'Sort by length; for each word, word-break it using a trie of the shorter words already inserted (needs ≥ 2 pieces), then insert it.',
    cmp: 'set',
    g: R => { const base = uniq(Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 2), 'ab'))); const w = base.slice(); for (let i = R.int(0, 3); i > 0; i--) w.push(R.pick(base) + R.pick(base) + (R.chance(0.3) ? R.pick(base) : '')); if (R.chance(0.3)) w.push(R.str(3, 'ab')); return { words: uniq(w) }; },
    s(I, T) { const set = new Set(I.words); const ok = w => { const dp = Array(w.length + 1).fill(0); dp[0] = 1; for (let i = 0; i < w.length; i++) if (dp[i]) for (let j = i + 1; j <= w.length; j++) { const p = w.slice(i, j); if (p !== w && set.has(p)) dp[j] = 1; } return !!dp[w.length]; }; return I.words.filter((w, i) => { const r = ok(w); if (i < 5) { T.at({ word: w, dict: A(I.words) }); T.yn('Built from ≥ 2 other words?', r, 'Word-break over shorter words.'); } return r; }); }
  });

  D('word-abbreviation', {
    t: 'Word Abbreviation',
    r: 'Start every word at prefix length 1 (first + count + last). While abbreviations collide, lengthen the prefix of every word in the colliding group. Keep the original if the abbreviation is not shorter. A trie per group gives the needed prefix directly.',
    g: R => ({ words: uniq(Array.from({ length: R.int(1, 5) }, () => R.str(R.int(2, 6), 'ab'))) }),
    s(I, T) { const W = I.words, ab = (w, k) => w.length - k <= 2 ? w : w.slice(0, k) + (w.length - k - 1) + w[w.length - 1], pre = W.map(() => 1), ans = W.map(w => ab(w, 1)); for (let i = 0; i < W.length; i++) { for (;;) { const dup = ans.map((a, j) => a === ans[i] ? j : -1).filter(j => j >= 0); if (dup.length === 1) break; dup.forEach(j => { pre[j]++; ans[j] = ab(W[j], pre[j]); }); } } W.forEach((w, i) => { if (i < 4) { T.at({ words: A(W, { i }) }); T.n('Prefix length kept in the final abbreviation?', pre[i], 'Grown until unique among its group.'); } }); return ans; }
  });

  D('add-bold-tag-in-string', {
    t: 'Add Bold Tag in String',
    r: 'Mark every character covered by some word occurrence (trie scan from each index), then wrap each maximal run of marked characters in <b>…</b>.',
    g: R => ({ s: R.str(R.int(1, 8), 'abc'), words: uniq(Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 3), 'abc'))) }),
    s(I, T) { const res = (() => { const s = I.s, b = Array(s.length).fill(false); for (let i = 0; i < s.length; i++) { let end = i; I.words.forEach(w => { if (s.startsWith(w, i)) end = Math.max(end, i + w.length); }); for (let j = i; j < end; j++) b[j] = true; } T.at({ s: A([...s]) }); T.n('Positions where some word starts?', [...s].filter((_, i) => I.words.some(w => w && s.startsWith(w, i))).length, 'Check every word at every index.'); T.n('How many characters end up bold?', b.filter(Boolean).length, 'Union of all word occurrences.'); let out = ''; for (let i = 0; i < s.length; i++) { if (b[i] && (i === 0 || !b[i - 1])) out += '<b>'; out += s[i]; if (b[i] && (i === s.length - 1 || !b[i + 1])) out += '</b>'; } return out; })(); T.n('Bold tags opened?', res.split('<b>').length - 1, 'One per run of bold characters.'); return res; }
  });

  D('replace-words', {
    t: 'Replace Words',
    r: 'Insert roots into a trie. For each word, walk the trie and stop at the first end-of-root node — that shortest root replaces the word.',
    g: R => ({ dictionary: uniq(Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 2), 'ab'))), sentence: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 4), 'abc')).join(' ') }),
    s(I, T) { const res = (() => { T.at({ sentence: I.sentence, roots: A(I.dictionary) }); T.n('Words in the sentence?', I.sentence.split(' ').length, 'Replace each one separately.'); return I.sentence.split(' ').map((w, i) => { let r = w; for (let k = 1; k <= w.length; k++) if (I.dictionary.includes(w.slice(0, k))) { r = w.slice(0, k); break; } if (i < 4) { T.at({ word: w, roots: A(I.dictionary) }); T.c('Replacement?', uniq([w, r, ...I.dictionary.filter(d => w.startsWith(d))]), r, 'Shortest root that prefixes the word.'); } return r; }).join(' '); })(); const o = I.sentence.split(' '); T.n('Words replaced?', res.split(' ').filter((w, i) => w !== o[i]).length, 'Words that had a shorter root.'); return res; }
  });

  D('longest-word-in-dictionary', {
    t: 'Longest Word in Dictionary',
    r: 'Insert all words into a trie; DFS only through nodes that end a word. The deepest reachable word wins, ties broken lexicographically.',
    g: R => { const w = []; for (let i = R.int(1, 3); i > 0; i--) { const s = R.str(R.int(1, 4), 'ab'); for (let k = 1; k <= s.length; k++) if (R.chance(0.8)) w.push(s.slice(0, k)); } if (!w.length) w.push('a'); return { words: uniq(w) }; },
    s(I, T) { const set = new Set(I.words); let best = ''; I.words.forEach((w, i) => { let ok = true; for (let k = 1; k < w.length; k++) if (!set.has(w.slice(0, k))) ok = false; if (i < 5) { T.at({ word: w, words: A(I.words) }); T.yn('Can it be built one letter at a time?', ok, 'Every prefix must be a word.'); } if (ok && (w.length > best.length || (w.length === best.length && w < best))) best = w; }); return best; }
  });

  D('short-encoding-of-words', {
    t: 'Short Encoding of Words',
    r: 'Insert reversed words into a trie; only leaves need their own "word#" segment. Answer = Σ (length + 1) over words that are not a suffix of another word.',
    g: R => ({ words: Array.from({ length: R.int(1, 5) }, () => R.str(R.int(1, 4), 'ab')) }),
    s(I, T) { const W = uniq(I.words); let tot = 0; W.forEach((w, i) => { const covered = W.some(o => o !== w && o.endsWith(w)); if (!covered) tot += w.length + 1; if (i < 5) { T.at({ word: w, words: A(W) }); T.yn('Hidden as a suffix of another word?', covered, 'Then it costs nothing extra.'); } }); return tot; }
  });

  D('camelcase-matching', {
    t: 'Camelcase Matching',
    r: 'Two pointers per query: consume pattern characters in order; any extra character in the query must be lowercase. All pattern characters must be used.',
    g: R => ({ queries: Array.from({ length: R.int(1, 4) }, () => R.str(R.int(1, 6), 'aAbB')), pattern: R.str(R.int(1, 3), 'aAB') }),
    s(I, T) { const p = I.pattern; return I.queries.map((q, i) => { let j = 0, ok = true; for (const c of q) { if (j < p.length && c === p[j]) j++; else if (c >= 'A' && c <= 'Z') { ok = false; break; } } ok = ok && j === p.length; if (i < 4) { T.at({ query: q, pattern: p }); T.yn('Matches?', ok, 'Only lowercase letters may be inserted.'); } return ok; }); }
  });

  D('index-pairs-of-a-string', {
    t: 'Index Pairs of a String',
    r: 'Insert words into a trie; from each start index walk the trie along text and emit [i, j] whenever a word ends. Results come out sorted naturally.',
    g: R => ({ text: R.str(R.int(1, 8), 'ab'), words: uniq(Array.from({ length: R.int(1, 3) }, () => R.str(R.int(1, 3), 'ab'))) }),
    s(I, T) { const out = []; for (let i = 0; i < I.text.length; i++) { const here = []; for (let j = i; j < I.text.length; j++) if (I.words.includes(I.text.slice(i, j + 1))) { out.push([i, j]); here.push(j); } if (i < 4) { T.at({ text: A([...I.text], { i }) }); T.n('Words starting at this index?', here.length, 'Trie walk from i.'); } } return out; }
  });

  D('remove-sub-folders-from-the-filesystem', {
    t: 'Remove Sub-Folders from the Filesystem',
    r: 'Sort paths; a path is a sub-folder iff it starts with the last kept folder + "/". (Equivalently, insert into a trie and stop at the first folder-end node.)',
    cmp: 'set',
    g: R => ({ folder: uniq(Array.from({ length: R.int(1, 6) }, () => '/' + Array.from({ length: R.int(1, 3) }, () => R.pick(['a', 'b', 'c'])).join('/'))) }),
    s(I, T) { const f = I.folder.slice().sort(), out = []; f.forEach((p, i) => { const sub = out.length > 0 && p.startsWith(out[out.length - 1] + '/'); if (i < 5) { T.at({ sorted: A(f, { i }), kept: A(out.slice()) }); T.yn('Is it a sub-folder of a kept folder?', sub, 'Prefix check with a trailing "/".'); } if (!sub) out.push(p); }); return out; }
  });

  D('search-suggestions-system', {
    t: 'Search Suggestions System',
    r: 'Sort products; for each typed prefix, binary search (or walk a trie storing the 3 smallest words per node) and take up to three matches.',
    g: R => ({ products: uniq(Array.from({ length: R.int(1, 6) }, () => R.str(R.int(1, 4), 'ab'))), searchWord: R.str(R.int(1, 4), 'ab') }),
    s(I, T) { const P = I.products.slice().sort(); return [...I.searchWord].map((_, i) => { const p = I.searchWord.slice(0, i + 1), m = P.filter(w => w.startsWith(p)).slice(0, 3); if (i < 4) { T.at({ prefix: p, products: A(P) }); T.n('How many suggestions?', m.length, 'Up to three smallest with this prefix.'); } return m; }); }
  });

  D('number-of-distinct-substrings-in-a-string', {
    t: 'Number of Distinct Substrings in a String',
    r: 'Insert every suffix into a trie; each newly created node is a new distinct substring. (A suffix array/automaton does it faster.)',
    g: R => ({ s: R.str(R.int(1, 7), 'ab') }),
    s(I, T) { const seen = new Set(); for (let i = 0; i < I.s.length; i++) { let fresh = 0; for (let j = i + 1; j <= I.s.length; j++) { const t = I.s.slice(i, j); if (!seen.has(t)) { seen.add(t); fresh++; } } if (i < 5) { T.at({ s: A([...I.s], { i }) }); T.n('New trie nodes when inserting this suffix?', fresh, 'Prefixes of the suffix not seen before.'); } } return seen.size; }
  });
})();
