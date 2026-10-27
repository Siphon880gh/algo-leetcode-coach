## Position map

1. pos[grid[i][j]] = (i, j).
2. adjacentSum: add neighbours at (±1, 0), (0, ±1) inside the grid; diagonalSum: (±1, ±1).

Examples → [null, 6, 16, 16, 4], [null, 23, 45].

Python’s negative indices wrap: without a 0 ≤ check, adjacentSum(1) → 13 instead of 6.

Time: O(n²) to build, O(1) per call  
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
