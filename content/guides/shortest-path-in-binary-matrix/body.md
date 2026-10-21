## Level by level

1. If `grid[0][0]` or `grid[n − 1][n − 1]` is 1, return −1.
2. Queue `(0, 0)` with distance 1; mark it visited (for example by setting it to 1).
3. Pop a cell; if it is the bottom-right, return its distance. Otherwise push each of the 8 neighbours that is inside the grid and 0, with distance + 1, marking it when pushed.
4. Return −1 if the queue empties.

Mark cells when they are pushed, not when popped, so no cell enters the queue twice.

Do not use DFS; it finds a path, not the shortest one. Do not forget the diagonals, and do not count edges instead of cells (a 1 × 1 clear grid has answer 1).

Time: O(n²)  
Space: O(n²)

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
