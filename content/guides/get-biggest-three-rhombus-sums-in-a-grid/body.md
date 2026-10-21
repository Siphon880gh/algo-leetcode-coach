## Walk each border

1. For each cell `(i, j)`: add `grid[i][j]` (radius 0).
2. For `k = 1, 2, …` while the corners `(i ± k, j)` and `(i, j ± k)` fit: walk the four edges, `k` cells each, without double-counting corners; add the sum.
3. Return the three largest distinct values.

Example 1 → `[228,216,211]`. Example 2 → `[20,9,8]`. Example 3 → `[7]`.

Keep a set (or a top-3 list with a distinctness check); duplicates must not fill the three slots. Diagonal prefix sums cut each border to O(1) but are optional for 50 × 50.

Time: O(m · n · min(m, n)²)  
Space: O(1) besides the set

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
