## Subset maximum

1. B = bit length of max(nums); F[x] = x for each value.
2. For each bit b and mask with bit b set: F[mask] = max(F[mask], F[mask without b]).
3. Return max over x of x · F[(2^B − 1) XOR x] (0 when F is 0).

Examples → 12, 0, 2048. Checked against testing every pair on 2,000 random arrays.

Only testing the two largest values: example 1 → 0 instead of 12.

Time: O(n + B · 2^B), B ≤ 20  
Space: O(2^B)

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
