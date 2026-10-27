## Bottleneck path

**Dijkstra variant:** a min-heap of `(max elevation so far, r, c)` from `(grid[0][0], 0, 0)`. Pop the smallest; when you pop the bottom-right corner, return its key. Push each unvisited neighbor with `max(key, grid[nr][nc])`.

**Binary search:** for time `t`, can you reach the corner using only cells `≤ t`? BFS checks it. The smallest feasible `t` in `[grid[0][0], n² − 1]` is the answer.

**Union-find:** add cells in increasing elevation order, union each with already-added neighbors, and stop when `(0, 0)` and `(n − 1, n − 1)` connect; that cell's elevation is the answer.

Do not sum elevations; the cost is the maximum, not the total. Do not forget the start cell's own elevation; you cannot leave before it is covered.

Time: O(n² log n)  
Space: O(n²)

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
