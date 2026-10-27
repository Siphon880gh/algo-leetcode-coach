## Smallest letter as representative

`parent[c] = c` for 26 letters. `find` with path compression.

For each `i`: `a = find(s1[i])`, `b = find(s2[i])`; if they differ, set the parent of the larger to the smaller.

Answer: `find(c)` for each `c` in `baseStr`.

Keeping the smallest letter as the root makes the lookup the answer directly.

Do not union by size or rank; that can make a larger letter the root. Do not map letters only through direct pairs; equivalence is transitive.

Time: O((n + m) · α(26))  
Space: O(26)

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
