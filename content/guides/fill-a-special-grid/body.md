## Quadrant order

1. fill(r, c, size, base): if size = 1, grid[r][c] = base.
2. Otherwise h = size / 2, q = h²; fill top-right with base, bottom-right with base + q, bottom-left with base + 2q, top-left with base + 3q.

Examples → [[0]], [[3, 0], [2, 1]], the 4 × 4 grid in example 3. Checked against the definition for n = 0 … 5.

Starting at the top-left and going clockwise: n = 1 → [[0, 1], [3, 2]], which breaks bottom-left < top-left.

Time: O(4^n)  
Space: O(4^n)

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
