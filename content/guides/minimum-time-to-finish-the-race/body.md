## Stints, then a knapsack over laps

1. For each tire, add laps `f · r^(x−1)` while a lap costs at most `changeTime + f`; update `best[x]`.
2. `dp[0] = 0`; `dp[i] = min(best[x] + changeTime + dp[i − x])` over `x ≤ i` with `best[x]` finite.
3. Return `dp[numLaps] − changeTime`.

Examples → 21, 25. Checked against a full search over tire choices on 200 small races.

Once a lap costs more than changing and starting fresh on the same tire, continuing never helps. With `r ≥ 2`, that limit keeps stints short.

Time: O(n · L + numLaps · L), L ≈ 18  
Space: O(numLaps)

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
