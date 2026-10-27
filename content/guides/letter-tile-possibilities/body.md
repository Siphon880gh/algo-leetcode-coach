## Choose a letter, not a tile

`cnt` = count of each letter. `dfs()`:

- `total = 0`. For each letter with `cnt[c] > 0`: `cnt[c] −= 1`; `total += 1 + dfs()`; `cnt[c] += 1`.
- Return `total`.

Answer: `dfs()`.

Branching on distinct letters means equal tiles never produce the same sequence twice, so no set of strings is needed.

Do not generate permutations of tile indices and deduplicate with a set; it does far more work. With at most 7 tiles, the search is small either way.

Time: O(number of sequences · 26)  
Space: O(n) recursion

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
