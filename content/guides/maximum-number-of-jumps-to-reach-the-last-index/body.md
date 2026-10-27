## Longest path DP

1. `dp[0] = 0`, others −∞.
2. For j, for i < j: if `dp[i] > −∞` and `|nums[j] − nums[i]| ≤ target`, `dp[j] = max(dp[j], dp[i] + 1)`.
3. Return dp[n − 1], or −1 if −∞.

Examples → 3, 5, −1. Checked against trying every jump path on 300 random arrays.

Starting unreachable indices at 0 lets paths begin anywhere: [4, 0, −2] with target 2 → 1 instead of −1. Differences reach 2 · 10^9, past 32-bit.

Time: O(n²)  
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
