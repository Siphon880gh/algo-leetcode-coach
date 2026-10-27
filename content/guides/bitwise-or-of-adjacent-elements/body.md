Given an integer array nums, return the array whose i-th value is the bitwise OR of nums[i] and nums[i + 1]. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Adjacent OR

This assumes the result has one value per adjacent pair, so n − 1 values; check the official statement.

1. For i = 0 … n − 2: ans[i] = nums[i] | nums[i + 1].

Constructed checks (run in code): [1, 3, 7, 15] → [3, 7, 15]; [8, 4, 2] → [12, 6].

Adding instead of OR: [1, 3, 7, 15] → [4, 10, 22].

Time: O(n)  
Space: O(1) beyond the output

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
