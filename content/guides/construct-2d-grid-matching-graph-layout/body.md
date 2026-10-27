## Row by row

1. If a node has degree 1, the first row is just it.
2. Else if no node has degree 4 (two rows or columns), the row is a corner plus its degree-2 neighbour.
3. Else walk from a corner along neighbours of degree below 4 while the degree is above 2, ending at the next corner.
4. Repeat n / |row| − 1 times: the next row is the unvisited neighbour of each cell in the current row.

Examples → valid grids for all three (any valid grid is accepted). Checked with an adjacency test on 400 random relabelled grids.

Using BFS layers from a corner as rows: on example 1 they are [0], [1, 2], [3], which is not a rectangle.

Time: O(n + e)  
Space: O(n + e)

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
