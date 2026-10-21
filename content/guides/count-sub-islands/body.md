## One flood per island

1. For each unvisited land cell of `grid2`: flood its island (iterative DFS/BFS), clearing cells.
2. Track `ok = ok and grid1[cell] == 1` for every cell.
3. Count islands with `ok`.

Example 1 → 3. Example 2 → 2.

Do not stop the flood at the first water cell in `grid1`; the rest of the island would later be counted as a new island. Use an explicit stack: 500 × 500 cells can overflow recursion.

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
