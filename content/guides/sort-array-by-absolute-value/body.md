Given an integer array, rearrange it so the absolute values are in non-decreasing order and return it. This assumes any order of elements with the same absolute value is accepted. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sort by key

1. Return nums sorted by |x|.

Constructed checks (run in code): [2, −3, 1] → [1, 2, −3]; [−5, 5, 0] → [0, −5, 5]. Checked on 500 random arrays that the result is a rearrangement with non-decreasing absolute values.

Sorting by value: [2, −3, 1] → [−3, 1, 2] instead of [1, 2, −3].

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
