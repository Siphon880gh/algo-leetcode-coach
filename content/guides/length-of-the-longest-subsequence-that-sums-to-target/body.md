## Knapsack

1. `dp[0] = 0`, others −1.
2. For each x, for s = target down to x: if `dp[s − x] ≥ 0`, `dp[s] = max(dp[s], dp[s − x] + 1)`.
3. Return dp[target].

Examples → 3, 4, −1. Checked against testing every subsequence on 400 random inputs.

Looping s upward reuses x: example 3 → 3 (1 + 1 + 1 with a 1 used twice) instead of −1.

Time: O(n · target) ≈ 10^6  
Space: O(target)

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
