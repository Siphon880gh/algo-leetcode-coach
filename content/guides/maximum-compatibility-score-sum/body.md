## Assignment by subset

1. `score[i][j]` = matching answers.
2. `dp[0] = 0`; for each `mask`, `i = popcount(mask)`; for free `j`: `dp[mask | 1 << j] = max(…, dp[mask] + score[i][j])`.
3. Return `dp[full]`.

Example 1 → 8. Example 2 → 0.

Trying all 8! = 40320 permutations also passes; the DP is 2^8 · 8. Greedy best-pair-first is not optimal in general.

Time: O(2^m · m + m² · n)  
Space: O(2^m)

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
