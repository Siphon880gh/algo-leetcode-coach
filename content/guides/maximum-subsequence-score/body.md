## Sort by the multiplier

1. Pair `(nums2[i], nums1[i])`; sort by nums2, largest first.
2. Push each nums1 value into a min-heap and add it to `sum`; if the heap holds more than `k`, pop the smallest and subtract it.
3. When the heap holds exactly `k`, `best = max(best, sum · nums2[i])`.
4. Return `best`.

Examples → 12, 30. Checked against trying every index set on 300 random arrays.

The current index stays in the set even when its nums1 is small: if it is popped at once, the product uses a nums2 that is too small, which only undercounts a set already counted earlier. Scores reach about 10^15, so use 64-bit.

Time: O(n log n)  
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
