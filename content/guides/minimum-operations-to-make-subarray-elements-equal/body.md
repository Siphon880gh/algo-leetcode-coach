Given an integer array nums and an integer k, one operation adds or subtracts 1 from any element. Return the fewest operations so that some window of k consecutive elements holds a single repeated value. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Median of each window

This assumes n is too large for sorting every window; check the official limits.

1. Keep the k window values split into a lower half (size ⌈k / 2⌉) and an upper half, with the sum of each.
2. Median m = largest of the lower half; cost = m · |lower| − sum(lower) + sum(upper) − m · |upper|.
3. Slide: insert the new value, remove the old one, rebalance; answer the smallest cost.

Constructed checks (run in code): [5, 1, 3, 8], k = 2 → 2; [1, 10, 2, 9, 3], k = 3 → 7. Checked against trying every target value on 400 random cases.

Using the rounded-down mean instead of the median: [1, 10, 2, 9, 3], k = 3 → 8 instead of 7.

Time: O(n log k)  
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
