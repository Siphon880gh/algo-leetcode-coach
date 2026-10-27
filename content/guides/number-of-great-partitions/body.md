## Complement counting

1. If `Σ nums < 2k`, return 0.
2. `dp[s]` = subsets with sum `s` for `s < k`, a 0/1 knapsack.
3. Return `2^n − 2 · Σ dp[s]` mod 10^9 + 7.

Examples → 6, 0, 2. Checked against trying every split on 300 random arrays.

The groups are ordered, so a bad subset is bad as the first group and its complement is bad as the second; with total at least 2k the two cases never overlap. Without step 1 they can, and the formula subtracts too much. The DP is O(n · k) = 10^6.

Time: O(n · k)  
Space: O(k)

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
