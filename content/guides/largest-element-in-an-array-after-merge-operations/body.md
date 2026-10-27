## Right to left

1. `cur = nums[n − 1]`, `best = cur`.
2. For i from n − 2 down: `cur = cur + nums[i]` if `nums[i] ≤ cur`, else `cur = nums[i]`; `best = max(best, cur)`.
3. Return best.

Examples → 21, 11. Checked against trying every merge order on 400 random small arrays.

Merging only grows the right element, so absorbing everything allowed from the right is never worse. Going left to right stops too early: example 1 → 12 instead of 21. Sums reach 10^11, so use 64-bit.

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
