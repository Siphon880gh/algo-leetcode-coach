## Three layers

1. dp[0][0][0] = coins[0][0]; if it is negative, dp[0][0][1] = 0 too; everything else starts at −∞.
2. From the up or left cell: dp[i][j][k] = prev[k] + coins[i][j]; for a robber and k ≥ 1, also try prev[k − 1].
3. Answer max over k of dp[m − 1][n − 1][k].

Examples → 8, 40. Checked against every path on 400 random grids.

Clamping profits at 0: [[−1, −2, −3, −4]] → 0 instead of −3.

Time: O(mn)  
Space: O(mn), or O(n) row by row

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
