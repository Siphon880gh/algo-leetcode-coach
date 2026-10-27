Given two arrays of the same length, you may rotate the first one to the right any number of times. Return the largest number of indices where the two arrays hold equal values. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## All rotations

This assumes n is small enough for O(n²) (a few thousand); check the official limits.

1. For s = 0 … n − 1: count i with nums1[(i − s) mod n] = nums2[i].
2. Answer the maximum.

Constructed checks (run in code): [3, 1, 2, 3, 1, 2] and [1, 2, 3, 1, 2, 3] → 6; [1, 2, 3] and [1, 3, 2] → 1. Checked against rotating step by step on 300 random pairs.

Counting common values regardless of position: [1, 2, 3] and [1, 3, 2] → 3 instead of 1.

Time: O(n²)  
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
