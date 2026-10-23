## Runs

1. For each row and column, best sum of a run of length ≥ 2 (Kadane, extending the best run ending one cell earlier).
2. Also each cell with 0 < r < m − 1 and 0 < c < n − 1.
3. Return the maximum.

Examples → 4, 3. Which shared sets are possible was found by listing every pair of paths on grids up to 4 × 4; the formula matched that brute force on 1,500 random grids.

Allowing any single cell: example 2 → 4 instead of 3.

Time: O(m · n)  
Space: O(max(m, n))

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
