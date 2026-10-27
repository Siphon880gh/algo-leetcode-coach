Starting at index 0, you hop forward to later indices until you reach the last index. Each hop earns a score that depends on its length and the value where it lands, as the statement defines it. Return the largest total score. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Suffix maxima

This assumes a hop from i to j scores (j − i) · nums[j]; check the official statement.

1. From the right, keep m = max(nums[k …]); add m for k = n − 1 … 1.

Constructed checks (run in code): [1, 5, 8] → 16; [4, 5, 2, 8, 9, 1, 3] → 42. Checked against the O(n²) DP on 300 random arrays.

Hopping one index at a time: [4, 5, 2, 8, 9, 1, 3] → 28 instead of 42.

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
