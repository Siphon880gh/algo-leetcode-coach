A grid holds the numbers 1 … k once each and 0 everywhere else. Find a path that starts anywhere, moves between side-adjacent cells, visits every cell exactly once, and meets the numbered cells in increasing order; return its cells in order, or an empty list if there is none. This guide assumes the grid is small enough for backtracking. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## DFS with the next number

1. For each start cell with value 0 or 1: path = [start], next = 2 if it is 1 else 1.
2. dfs(cell, next): if the path covers every cell, succeed when next = k + 1.
3. Otherwise try each unvisited neighbour whose value is 0 or next; advance next when it is next; undo on failure.
4. Return the first full path, or [].

Constructed checks (run in code): [[0, 1, 2]], k = 2 → [[0, 0], [0, 1], [0, 2]]; [[1, 0], [0, 2]], k = 2 → a valid 4-cell path; [[1, 2], [0, 0], [0, 3]], k = 3 → a valid 6-cell path. Checked against trying every cell order on 200 small grids.

Starting only at the cell holding 1: [[0, 1, 2]] → [] although a path exists.

Time: exponential in m · n in the worst case  
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
