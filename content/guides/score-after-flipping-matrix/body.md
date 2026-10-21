## Greedy by bit weight

For an `m × n` grid, column `j` has weight `2^(n − 1 − j)`.

1. Rows: flip any row whose first cell is 0. A leading 1 is worth more than all lower bits together.
2. Columns `j ≥ 1`: after step 1, count ones as `ones = number of rows where grid[r][j] == grid[r][0]`. The column contributes `max(ones, m − ones) · 2^(n − 1 − j)` (flip it when zeros win).
3. Column 0 contributes `m · 2^(n − 1)`.

You do not need to modify the grid: comparing with `grid[r][0]` accounts for the row flip.

Do not flip rows after step 1; that would lose leading 1s. Do not just maximize the total number of ones; bits have different weights.

Time: O(m · n)  
Space: O(1)

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
