## Ordered knapsack

1. Sort indices by nums2 ascending.
2. `dp[0 … n] = 0`; for each index i, for j from n down to 1: `dp[j] = max(dp[j], dp[j − 1] + nums1[i] + j · nums2[i])`.
3. Return the smallest t ≤ n with `sum(nums1) + t · sum(nums2) − dp[t] ≤ x`, else −1.

Examples → 3, −1. Checked against simulating every reset sequence on 400 random small inputs.

Without the sort the j-th reset can be given to a slow grower: nums1 = [6, 4, 6], nums2 = [0, 6, 1], x = 1 → −1 instead of 3. More than n seconds never helps, since every index has already been reset once.

Time: O(n²)  
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
