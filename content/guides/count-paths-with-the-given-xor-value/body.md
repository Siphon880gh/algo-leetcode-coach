## 16 states per cell

1. dp[0][0][grid[0][0]] = 1.
2. dp[i][j][x ^ grid[i][j]] += dp[i − 1][j][x] + dp[i][j − 1][x], mod 10^9 + 7.
3. Answer dp[m − 1][n − 1][k].

Examples → 3, 5, 0. Checked against every path on 200 random grids.

Leaving the start cell out of the XOR: example 1 → 0 instead of 3.

Time: O(16 · mn), at most about 1.4 · 10^6  
Space: O(16 · mn), or O(16 · n) row by row

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
