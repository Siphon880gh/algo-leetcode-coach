## Layers of n cells

1. `dp = grid[0]`.
2. For each next row `r`: `new[j] = grid[r][j] + min over i of (dp[i] + moveCost[grid[r − 1][i]][j])`; `dp = new`.
3. Return `min(dp)`.

Examples → 17, 6.

moveCost is indexed by the value in the cell you leave, not by its position, and by the column you enter. The last row makes no move, so nothing is added after it.

Time: O(m · n²)  
Space: O(n)

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
