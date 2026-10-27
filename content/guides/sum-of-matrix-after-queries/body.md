## Reverse sweep

1. `rows`, `cols` = sets of lines already set; `sum = 0`.
2. For each query from last to first: if it is a row not in rows, add `val · (n − |cols|)` and add the row; same for a column with `n − |rows|`.
3. Return sum.

Examples → 23, 17. Checked against filling the matrix on 300 random cases.

Going forwards undercounts later overwrites: example 1 → 17 instead of 23. The sum can reach 10^4 · 10^4 · 10^5 = 10^13, so use 64-bit.

Time: O(q)  
Space: O(n)

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
