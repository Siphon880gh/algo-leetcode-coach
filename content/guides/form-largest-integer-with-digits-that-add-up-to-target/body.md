## Length first, digits second

1. `dp[0] = 0`, others −∞. `dp[t] = max(dp[t − cost[d]] + 1)` over digits d.
2. If `dp[target] < 0`, return `"0"`.
3. For `d` from 9 down to 1: while `cost[d] ≤ t` and `dp[t − cost[d]] == dp[t] − 1`, append `d` and subtract.

`[4,3,2,5,6,7,2,5,5]`, 9 → `"7772"`. `[7,6,5,5,5,6,8,7,8]`, 12 → `"85"`. `[2,4,6,2,4,6,4,4,4]`, 5 → `"0"`.

Do not compare candidate strings in the DP; track lengths. Do not return `""` when impossible; the statement wants `"0"`.

Time: O(9 · target)  
Space: O(target)

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
