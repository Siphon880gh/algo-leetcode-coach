## Build words letter by letter

Sort the words (shorter words and their prefixes come first). Start with `built = {""}`.

For each word, if `word[:-1]` is in `built`, add the word to `built` and compare it with the best: longer wins, and on equal length the alphabetically smaller wins.

Sorting lexicographically puts every prefix before the words that extend it, so the check is always ready.

Trie alternative: insert all words, then DFS only through nodes that end a word, tracking the deepest node. Visiting children in alphabetical order handles the ties.

Do not accept a word just because it is in the list; `"apple"` needs `"a"`, `"ap"`, `"app"`, and `"appl"` too. Do not break ties by input order.

Time: O(Σ len · log n) for sorting  
Space: O(Σ len)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
