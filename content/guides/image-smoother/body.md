## Clip at the edges

For each `(i, j)`: loop `di, dj` over −1, 0, 1. Add `img[i + di][j + dj]` when it is inside the image, and count it. Store `total // count` in a new grid.

Corners average 4 cells, edges 6, and inner cells 9, which the count handles automatically. A 2D prefix sum computes each block sum in O(1), which pays off for larger windows.

Do not write into the input while you read it; neighbors would see smoothed values. (Pack the new value into the high bits of each cell if you need O(1) extra space: values are at most 255.) Do not divide by 9 everywhere; edge cells have fewer neighbors.

Time: O(m · n)  
Space: O(m · n) for the output

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
