## Enumerate cuts

1. For every pair of row cuts, every pair of column cuts, and every row-and-column cut in the four T shapes, add the bounding-box area of each part.
2. Return the minimum.

Examples → 5, 5. Checked against trying every set of three rectangles on 80 random small grids.

Trying only strips misses the T shapes: [[0, 0, 0, 1], [1, 0, 0, 1], [0, 0, 0, 0]] → 4 instead of 3.

Time: O((m² + n² + m n) · m n)  
Space: O(1)

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
