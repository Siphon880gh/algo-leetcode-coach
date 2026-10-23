In an m × n grid, entering cell (i, j) costs (i + 1) · (j + 1), and the path starts by entering (0, 0). Odd-numbered moves must go right or down; even-numbered moves must go left or up. Return the minimum total cost to reach (m − 1, n − 1), or −1 if it cannot be reached. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Case check

1. If m = n = 1, return 1.
2. If the grid is 1 × 2 or 2 × 1, return 1 + 2 = 3.
3. Otherwise return −1.

Constructed checks (run in code): (1, 1) → 1, (2, 1) → 3, (2, 2) → −1. Checked against searching every alternating walk on grids up to 5 × 5.

Treating it as an ordinary right-or-down path: (2, 2) → 1 + 2 + 4 = 7 instead of −1.

Time: O(1)  
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
