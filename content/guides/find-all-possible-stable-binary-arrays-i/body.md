## Last run

1. dp[i][j][0] = Σ_{r = 1 … limit, r ≤ i} dp[i − r][j][1], counting 1 when i − r = j = 0. Symmetric for 1.
2. Answer = dp[zero][one][0] + dp[zero][one][1], mod 10^9 + 7.

Examples → 2, 1, 14. Checked against listing every arrangement for all zero, one ≤ 5 and limit ≤ 4.

At 200 the run sum costs 200³ = 8 · 10^6 steps; version II needs the subtraction trick instead.

Time: O(zero · one · limit)  
Space: O(zero · one)

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
