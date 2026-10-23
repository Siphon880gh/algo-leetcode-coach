## Path DP

1. dp[0][0] = 1.
2. dp[i][j] = min(dp[i − 1][j], dp[i][j − 1]) + (i + 1)(j + 1) + waitCost[i][j].
3. Answer dp[m − 1][n − 1] − waitCost[m − 1][n − 1] (no wait after the last move).

Examples → 3, 9. Checked against simulating every right/down path on 300 random grids.

Paying the wait on the start and the target too: example 2 → 16 instead of 9.

Time: O(m · n)  
Space: O(m · n), or O(n) with one row

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
