## Inclusion–exclusion

1. dp[i][0][0] = 1 for 1 ≤ i ≤ limit; dp[0][j][1] = 1 for 1 ≤ j ≤ limit.
2. dp[i][j][0] = dp[i − 1][j][0] + dp[i − 1][j][1] − dp[i − limit − 1][j][1] (if i > limit). Symmetric for 1.
3. Answer = sum of both, mod 10^9 + 7 (keep it non-negative).

Examples → 2, 1, 14. Checked against listing every arrangement for all zero, one ≤ 5 and limit ≤ 4.

Without the subtraction, runs are unbounded: example 3 → 18 instead of 14.

Time: O(zero · one)  
Space: O(zero · one)

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
