## Telescoping

1. pm[i][j] = min of grid over the rectangle up to (i, j).
2. Before including (i, j): p = min(pm[i − 1][j], pm[i][j − 1]); ans = max(ans, grid[i][j] − p).
3. Return ans (it can be negative).

Examples → 9, −1. Checked against every pair of cells on 500 random grids.

At least one move is required: clamping at 0 gives example 2 → 0 instead of −1.

Time: O(m n)  
Space: O(m n)

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
