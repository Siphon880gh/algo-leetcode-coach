## Two maxima per cell

1. `rowMax[r]` = the maximum of row `r`; `colMax[c]` = the maximum of column `c`.
2. Answer = `Σ (min(rowMax[r], colMax[c]) − grid[r][c])`.

Raising a building above `rowMax[r]` would change the view from the side; above `colMax[c]`, the view from the front. Up to the smaller of the two, neither view changes, and each cell is independent.

Do not cap by the global maximum; each cell has its own limit. Do not update the maxima as you raise buildings; the cap never exceeds them, so they stay the same.

Time: O(n²)  
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
