## Doubled costs

1. p = positions where s1 and s2 differ; odd count → −1.
2. Work in doubled units: `dp[1] = x`, `dp[i] = min(dp[i − 1] + x, dp[i − 2] + 2·(p[i] − p[i − 1]))`.
3. Return `dp[m] / 2`.

Examples → 4, −1. Checked against a shortest-path search over all strings on 500 random inputs with n ≤ 8.

Pairing the mismatches in fixed consecutive pairs is not enough: mismatches at 0, 5, 6, 11 with x = 3 cost 6 that way, but 4 by pairing 0 with 11 (cost 3) and 5 with 6 (cost 1).

Time: O(n)  
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
