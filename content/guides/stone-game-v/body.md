## Keep the lighter side

1. Prefix sums for O(1) range sums.
2. `dp[i][j] = max over k of`: `L + dp[i][k]` if `L < R`; `R + dp[k+1][j]` if `L > R`; `L + max(dp[i][k], dp[k+1][j])` if equal.
3. `dp[i][i] = 0`.

`[6,2,3,4,5,5]` → 18. Seven 7s → 28. `[4]` → 0.

Do not keep the heavier side; Bob throws it away. O(n³) passes for n ≤ 500; monotone-split tricks reach O(n²).

Time: O(n³)  
Space: O(n²)

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
