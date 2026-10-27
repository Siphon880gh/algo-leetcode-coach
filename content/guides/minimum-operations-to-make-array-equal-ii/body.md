## Surplus over k

1. If `k = 0`, return 0 when the arrays are equal, else −1.
2. For each `i`: `d = nums1[i] − nums2[i]`; if `d mod k ≠ 0`, return −1; add `d` to `total` and `max(d, 0)` to `up`.
3. Return `up / k` if `total = 0`, else −1.

Examples → 2, −1.

Each operation lowers the surplus by exactly k and the deficit by exactly k, so up / k operations are needed and enough. Check k = 0 before any modulo. The differences can sum to about 10^14, so use 64-bit.

Time: O(n)  
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
