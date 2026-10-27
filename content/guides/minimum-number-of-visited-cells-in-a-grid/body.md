## BFS with skip pointers

1. `dist[0][0] = 1`; for each row and column, a union-find “next unvisited index” structure.
2. Pop `(i, j)` with `v = grid[i][j]`. In row i, repeatedly jump to the next unvisited column in `j + 1 … j + v`; give it `dist + 1`, enqueue it, mark it visited in its row and its column.
3. Do the same down column j for rows `i + 1 … i + v`.
4. Return `dist` at the bottom-right, or −1.

Examples → 4, 3, −1. Checked against a plain BFS that scans every move on 500 random grids.

BFS settles each cell at its first, smallest distance, so a visited cell never needs to be seen again. Min-heaps per row and column are another standard way.

Time: O(m · n · α)  
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
