While the array has more than two elements, remove either the first two, the last two, or the first and last element, and add their sum to the score. Return the largest total score. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Remainder

1. Odd n: total − min(nums).
2. Even n: total − the smallest sum of two neighbors.

Constructed checks (run in code): [3, −2, 5] → 8; [1, 9, 9, 1] → 10; [4, −1, 2, 6, 0] → 12. Checked against trying every order of operations on 500 random arrays.

Leaving the two smallest values even when they are not neighbors: [1, 9, 9, 1] → 18 instead of 10.

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
