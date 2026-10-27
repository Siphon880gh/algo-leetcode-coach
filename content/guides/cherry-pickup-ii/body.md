## Joint state per row

1. `dp[r][a][b]` = most cherries from row `r` down, with the robots at columns `a`, `b`.
2. Gain `g = grid[r][a] + (a ≠ b ? grid[r][b] : 0)`.
3. `dp[r][a][b] = g + max over da, db in {−1,0,1} of dp[r+1][a+da][b+db]` (columns in range).
4. Return `dp[0][0][C−1]`.

`[[3,1,1],[2,5,1],[1,5,5],[2,1,1]]` → 24. The 5 × 7 example → 28.

Do not run the robots separately and add; they interact through shared cells. Rows are tied together, so there is no separate time dimension.

Time: O(R · C² · 9)  
Space: O(C²) rolled

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
