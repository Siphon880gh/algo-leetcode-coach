## k layers

1. pre = prefix sums; dp[0][i] = 0.
2. For j = 1 … k: best = −∞; for i = 1 … n: if i ≥ m, best = max(best, dp[j − 1][i − m] − pre[i − m]); dp[j][i] = max(dp[j][i − 1], best + pre[i]).
3. Answer dp[k][n].

Examples → 13, −10. Checked against trying every choice on 300 random arrays.

Using subarrays of length exactly m: example 1 → 10 instead of 13.

Time: O(k · n)  
Space: O(n)

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
