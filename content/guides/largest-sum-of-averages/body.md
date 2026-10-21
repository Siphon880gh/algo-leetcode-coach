## Last group decides

`avg(j, i) = (P[i] − P[j]) / (i − j)` with prefix sums `P`.

- `dp[1][i] = avg(0, i)`.
- `dp[k][i] = max over j in [k − 1, i − 1] of dp[k − 1][j] + avg(j, i)`.

Return `dp[K][n]`.

More groups never hurt (splitting a group gives a score at least as high, because the average of a whole is at most the sum of the parts' averages), so "at most k" and "exactly k" give the same answer when `k ≤ n`.

Space can drop to one row by iterating `i` downward within each `k`.

Do not try all ways to place the cuts; that is exponential. Do not recompute group sums in a loop; prefix sums make each average O(1).

Time: O(k · n²)  
Space: O(n)

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
