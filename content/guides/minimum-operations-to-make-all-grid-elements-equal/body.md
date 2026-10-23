You get an m × n integer grid and an integer k. In one operation you pick a k × k subgrid and increase every cell in it by 1. Return the minimum number of operations that make all cells equal, or −1 if that cannot happen. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Greedy in T

1. Scan cells in row order, keeping a 2D prefix sum of counts as pairs (a, b) meaning a + b · T.
2. cur = grid value + counts of windows already covering the cell.
3. If a k × k window can start here: count = T − cur, which must be ≥ 0.
4. Otherwise: cur = T must hold.
5. Equalities fix T or rule it out; inequalities give a range. The total count is affine in T, so take the cheaper end of the range.

Assumed here: an operation adds 1 to every cell of a k × k subgrid, and the answer is −1 when no T works.

Constructed checks (made-up grids, run in code): [[5, 0, 5], [5, 0, 5]], k = 2 → 10; [[1, 2], [3, 4]], k = 1 → 6; [[0, 0, 0], [0, 1, 1], [0, 1, 1]], k = 2 → −1. Checked against trying every set of counts on 700 random small grids.

Trying only T = max(grid): the first check → −1 instead of 10.

Time: O(m · n)  
Space: O(m · n)

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
