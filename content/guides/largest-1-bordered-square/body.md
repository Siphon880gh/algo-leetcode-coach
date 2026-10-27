## Four sides from two tables

1. `left[i][j]` = consecutive 1s ending at `(i, j)` in its row; `up[i][j]` = the same in its column (0 where the cell is 0).
2. For each cell `(i, j)`, for `k` from `min(left[i][j], up[i][j])` down to `best + 1`:
   - If `up[i][j − k + 1] ≥ k` and `left[i − k + 1][j] ≥ k`, set `best = k` and stop.
3. Return `best²`.

The bottom and right sides are covered by the starting cell's runs; the two lookups check the left and top sides.

Do not test every square by walking its border; that is O(n⁴). Do not return the side length; the answer is the number of cells.

Time: O(m · n · min(m, n))  
Space: O(m · n)

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
