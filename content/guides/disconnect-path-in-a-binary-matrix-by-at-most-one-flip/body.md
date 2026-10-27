## Two searches

1. `dfs(i, j)`: return true at the bottom-right; otherwise set the cell to 0 and try down, then right.
2. Return `!dfs(0, 0) || !dfs(0, 0)`.

Examples → true, false. Checked against flipping every cell on 400 random small grids.

Moves only go down or right, so every path from top-left to bottom-right crosses each anti-diagonal i + j = d once. Trying down first makes the first path the outermost one on its side, so if two cell-disjoint paths exist, some path avoids it. A cell the first search gave up on could only continue through erased cells, so erasing it hides nothing from the second search. Use an explicit stack for grids with 10^5 cells.

Time: O(m · n)  
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
