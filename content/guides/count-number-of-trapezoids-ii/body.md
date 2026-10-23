## Two tallies

1. For every pair of points: reduced direction (dx, dy) with a fixed sign, line key dy · x − dx · y, midpoint (x1 + x2, y1 + y2).
2. For each direction: add pairs of segments on different lines.
3. For each midpoint: subtract pairs of segments with different directions (the diagonals of a parallelogram).

Examples → 2, 1. Checked against testing every 4 points on 200 random sets.

Not subtracting parallelograms: the unit square → 2 instead of 1.

Time: O(n² log C)  
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
