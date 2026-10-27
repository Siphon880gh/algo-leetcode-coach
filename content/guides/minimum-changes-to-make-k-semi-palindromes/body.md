## Two stages

1. For every substring of length ≥ 2: for each divisor d < length, sum the mismatched mirror pairs in each class `t[r], t[r + d], …`; cost = the minimum.
2. `dp[j][p]` = min over i ≤ j − 2 of `dp[i][p − 1] + cost[i][j]`. Return `dp[n][k]`.

Examples → 1, 2, 0. The cost was checked against trying every target string on 300 random substrings.

Ordinary palindromes are not enough: abab with k = 1 costs 0 (d = 2) but 2 as a palindrome.

Time: O(n³ · divisors) for the costs (n ≤ 200), O(n² k) for the DP  
Space: O(n² + nk)

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
