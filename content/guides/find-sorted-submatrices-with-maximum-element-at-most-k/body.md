Given a grid and an integer k, count the submatrices whose largest element is at most k and whose every row is sorted in non-increasing order. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Widths, then histograms

1. w[i][j] = 0 if grid[i][j] > k; else 1 + w[i][j + 1] when grid[i][j] ≥ grid[i][j + 1] and w[i][j + 1] > 0, else 1.
2. For each column j, go down the rows keeping a stack of (width, count) and cur = Σ width · count; add cur at each row.

Constructed checks (run in code): [[2, 1], [1, 2]], k = 2 → 7; [[1, 1], [1, 1]], k = 1 → 9; [[3, 2, 5], [2, 2, 1]], k = 3 → 12. Checked against every submatrix on 300 random grids.

Ignoring the row order: [[2, 1], [1, 2]], k = 2 → 9 instead of 7.

Time: O(mn)  
Space: O(mn)

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
