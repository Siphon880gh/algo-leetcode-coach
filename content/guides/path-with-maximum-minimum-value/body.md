Given an `m × n` grid of non-negative integers, a path goes from the top-left to the bottom-right cell using 4-directional moves. A path's score is the smallest value on it. Return the largest score over all paths. `[[5,4,5],[1,2,6],[7,4,6]]` → 4. `[[2,2,1,2,2,2],[1,2,2,2,1,2]]` → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Always take the best frontier cell

1. Max-heap with `(grid[0][0], 0, 0)`; mark the start visited. `ans = grid[0][0]`.
2. Pop `(v, r, c)`; `ans = min(ans, v)`. If `(r, c)` is the bottom-right cell, return `ans`.
3. Push every unvisited 4-neighbour with its value and mark it visited.

The search only ever takes the highest-value frontier cell, so the lowest value it accepts is as high as any path allows.

Alternatives: sort cells by value descending and union them until start and end connect, or binary search the score with a BFS check. Do not use plain BFS or DFS; they ignore the values.

Time: O(m · n · log(m · n))  
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
