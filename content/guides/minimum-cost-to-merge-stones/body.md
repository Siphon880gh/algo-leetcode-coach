## Feasibility first

If `(n − 1) % (k − 1) != 0`, return −1.

Prefix sums give `sum(i, j)`.

`dp[i][j]` = minimum cost to merge `stones[i..j]` into the fewest piles possible. `dp[i][i] = 0`.

For lengths from 2 up, for each `i, j`:

- `dp[i][j] = min over m = i, i + k − 1, i + 2(k − 1), … < j of dp[i][m] + dp[m + 1][j]`.
- If `(j − i) % (k − 1) == 0`, the range can become one pile: `dp[i][j] += sum(i, j)`.

Return `dp[0][n − 1]`.

Stepping `m` by `k − 1` keeps the left part collapsible to a single pile, so only valid splits are tried.

Do not merge greedily by the smallest neighboring sum; that fails for k > 2. Do not forget the feasibility check.

Time: O(n³ / k)  
Space: O(n²)

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
