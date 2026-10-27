You get the height m and width n of a board and a starting cell for a knight. Find an order in which the knight, using only knight moves, visits every cell exactly once, starting from the given cell. Return the board with each cell holding the step at which it is visited, 0 for the start. The limits are in the official statement, and the inputs guarantee that a tour exists. For instance, a 1 × 1 board → [[0]]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Backtrack

1. `g` filled with −1; `g[r][c] = 0`.
2. `go(i, j, k)`: if `k = m · n − 1`, succeed. For each of the 8 knight moves to an unvisited in-board cell: set it to `k + 1`, recurse, and reset it to −1 if that failed.
3. Return g after `go(r, c, 0)` succeeds.

Constructed checks (searched in code): a 1 × 1 board → [[0]]; a 3 × 4 board from a corner has a tour; a 3 × 3 board has none from any start, since the centre cell has no knight moves.

Plain backtracking is exponential, so it suits only small boards; check the official limits. Ordering moves by how many unvisited moves each target has left cuts the search drastically.

Time: exponential in m · n in the worst case  
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
