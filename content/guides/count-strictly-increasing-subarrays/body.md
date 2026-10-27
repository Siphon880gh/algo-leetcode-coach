You are given an array of positive integers. Return how many of its subarrays are strictly increasing; a single element counts as one. For instance, [1,3,5,4,4,6] → 10 and [1,1,1] → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Add the run ending here

1. `run = 0`, `total = 0`.
2. For each index: `run = run + 1` if the value is bigger than the previous one, else `run = 1`; `total += run`.
3. Return `total`.

Constructed checks (verified against testing every subarray on 300 random arrays): the cases above → 10, 3; [1,2,3] → 6.

A strictly increasing subarray ending at i is a suffix of the run ending at i, and there are exactly `run` of them. For a long increasing array the total is about n²/2, so use 64-bit.

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
