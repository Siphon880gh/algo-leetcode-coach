## Minimum sums

1. `a = sum1 + zeros1`, `b = sum2 + zeros2`.
2. If a < b and zeros1 = 0, or b < a and zeros2 = 0, return −1.
3. Return max(a, b).

Examples → 12, −1. Checked against trying every target sum on 500 random small inputs.

Without step 2, example 2 → 6 instead of −1. Sums reach 10^11 (10^5 values of 10^6), so use 64-bit.

Time: O(n + m)  
Space: O(1)

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
