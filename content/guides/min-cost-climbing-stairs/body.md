## Pay when you leave a step

Let `dp[i]` be the cheapest cost to stand on step `i`, where the top is `i = n`. Starting on 0 or 1 is free: `dp[0] = dp[1] = 0`.

`dp[i] = min(dp[i − 1] + cost[i − 1], dp[i − 2] + cost[i − 2])`.

Return `dp[n]`. Only the last two values are needed, so O(1) space.

Example: `[10,15,20]` → start on step 1, pay 15, jump two to the top → 15.

Do not stop at the last step; the top is past it. Do not charge the starting step on entry; costs are paid when you climb from a step.

Time: O(n)  
Space: O(1)

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
