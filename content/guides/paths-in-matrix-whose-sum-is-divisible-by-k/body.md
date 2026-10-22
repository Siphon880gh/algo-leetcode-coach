## Remainder as a third index

1. `dp[0][0][grid[0][0] mod k] = 1`.
2. For other cells: `dp[i][j][(r + grid[i][j]) mod k] += dp[i − 1][j][r] + dp[i][j − 1][r]` for every `r`, mod 10^9 + 7.
3. Return `dp[m − 1][n − 1][0]`.

Examples → 2, 1, 10.

Sums themselves reach 100 · (m + n − 1), but only the remainder matters. There are at most 5 · 10^4 · 50 = 2.5 · 10^6 states; keeping one row of them saves memory.

Time: O(m · n · k)  
Space: O(n · k)

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
