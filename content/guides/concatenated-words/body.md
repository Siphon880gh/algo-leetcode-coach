## Word Break against shorter words

Sort words by length. Keep a dictionary (hash set or trie) of words seen so far. For each word `w` in order:

- Run Word Break on `w` with the current dictionary: `ok[0] = true`; `ok[i]` is true if some `j < i` has `ok[j]` and `w[j..i−1]` in the dictionary. If `ok[|w|]`, `w` is concatenated — every piece is a strictly shorter word, so at least two pieces are used.
- Add `w` to the dictionary afterwards.

Because only shorter words are in the dictionary when `w` is checked, `w` can never match itself as a single piece.

A trie makes the inner check faster: from position `j`, walk the trie and recurse at every word end.

Word Break (139) answers this for one string. Word Break II (140) lists all splits.

Do not let a word count as its own concatenation. Do not include the empty string in the dictionary (if it appears in input, skip it). Do not run each check against the full list including longer words.

Time: O(Σ |w|²) for the DP checks (plus sorting)  
Space: O(total length)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
