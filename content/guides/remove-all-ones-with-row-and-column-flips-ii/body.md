Given a small binary grid (its total number of cells is at most 15), one operation picks a cell that holds 1 and sets every cell in its row and its column to 0. Return the minimum number of operations to make the grid all zeros. For instance, [[1,1,1],[1,1,1],[0,1,0]] → 2; [[0,1,0],[1,0,1],[0,1,0]] → 2; an all-zero grid → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Shortest path over at most 2^15 states

1. `start` = bitmask of the 1 cells; BFS queue with `dist[start] = 0`.
2. Pop `x`; if `x = 0`, return `dist[x]`.
3. For each set bit `(i, j)`: clear row `i` and column `j` to get `y`; push unseen `y` with `dist[x] + 1`.

Constructed checks (computed with this BFS): the three cases above → 2, 2, 0.

Each move only clears bits, so states never repeat in a cycle, and BFS gives the fewest moves. Precomputing a row-and-column mask for each cell makes a move one AND.

Time: O(2^(mn) · mn)  
Space: O(2^(mn))

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
