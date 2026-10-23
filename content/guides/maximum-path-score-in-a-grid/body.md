## 3D DP

1. dp[0][0][0] = 0; every other state is −1 (unreachable).
2. For each cell with value v and cost w (0 if v = 0, else 1), for c = w … k: dp[i][j][c] = v + max(dp[i − 1][j][c − w], dp[i][j − 1][c − w]) over reachable states.
3. Return max over c of dp[m − 1][n − 1][c], or −1.

Examples → 2, −1. Checked against trying every path on 1,500 random grids.

Charging 2 for value 2: example 1 → 1 instead of 2.

Time: O(m · n · k)  
Space: O(m · n · k), or O(n · k) row by row

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
