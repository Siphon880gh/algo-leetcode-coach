## Dependencies from rectangles

1. For each colour, record its min/max row and column.
2. For each cell `(i, j)` inside colour `c`'s box with `grid[i][j] ≠ c`, add edge `c → grid[i][j]` (that colour goes on top later).
3. Return true if the graph is acyclic (DFS three-colour or Kahn).

Example 1 → true. Example 2 → true. `[[1,2,1],[2,1,2],[1,2,1]]` → false (1 and 2 each need to be on top of the other).

With at most 60 colours and a 60 × 60 grid, scanning every box is cheap. Do not assume colours appear in numeric order.

Time: O(C · m · n)  
Space: O(C²)

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
