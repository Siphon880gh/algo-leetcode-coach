## Threshold counting

1. Sort nums. D = sorted distinct values nums[j] − nums[i] (i < j).
2. cnt(d): dp[i][j] = length-j subsequences ending at i with all gaps ≥ d; dp[i][j] = Σ dp[p][j − 1] over p with nums[i] − nums[p] ≥ d. Those p form a prefix, so prefix sums make each cnt O(n k).
3. Answer = Σ (d_t − d_{t−1}) · cnt(d_t), with d_0 = 0, mod 10^9 + 7.

Examples → 4, 0, 10. Checked against listing every subsequence on 300 random small arrays.

Sort first: the smallest gap in input order is not the power. [1, 4, 2] with k = 3 has power 1, but its input-order gaps 3 and 2 give 2.

Time: O(n³ k)  
Space: O(n k)

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
