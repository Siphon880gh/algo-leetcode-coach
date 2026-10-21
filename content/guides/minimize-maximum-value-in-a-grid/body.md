You are given an m × n grid of distinct positive integers. Replace every value with a positive integer so that the relative order of any two values in the same row, and of any two values in the same column, stays the same, and the largest value in the new grid is as small as possible. Return the new grid. For instance, [[3,1],[2,5]] → [[2,1],[1,2]]; [[10]] → [[1]]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Smallest value that fits

1. `rowMax`, `colMax` = 0 for every row and column.
2. For cells `(i, j)` in increasing order of value: `x = max(rowMax[i], colMax[j]) + 1`; write `x`; `rowMax[i] = colMax[j] = x`.
3. Return the grid.

Constructed checks (verified on 300 random grids that order is kept and every cell equals the longest increasing chain through rows and columns that ends there): the cases above, and [[2,4,5],[7,6,1]] → [[1,2,3],[4,3,1]].

Every value must exceed all smaller values in its row and column, so the longest such chain ending at a cell is a lower bound. The greedy meets that bound in every cell at once.

Time: O(mn log(mn))  
Space: O(m + n)

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
