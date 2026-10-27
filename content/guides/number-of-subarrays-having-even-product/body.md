Given an integer array nums, count the subarrays whose product is even. For instance, [9,6,7,13] → 6 and [7,3,5] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Last even position

1. `last = −1`, `ans = 0`.
2. For each `i`: if `nums[i]` is even, `last = i`; `ans += last + 1`.
3. Return `ans`.

Constructed checks (verified against multiplying every subarray on 300 random arrays): the cases above → 6, 0.

Counting all-odd subarrays and subtracting from n(n + 1) / 2 gives the same result. The count passes 32-bit range once n reaches 65,536, so keep it in 64-bit for large inputs, and never form the product itself.

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
