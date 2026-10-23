You get an integer array nums. For each index, count the elements after it that are smaller and have the opposite parity, and return the counts. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Right to left

1. Compress values.
2. For i = n − 1 … 0: ans[i] = count of values < nums[i] in the opposite-parity tree; add nums[i] to its own tree.

Assumed here: you count elements after index i.

Constructed checks (made-up values, run in code): [5, 2, 4, 1, 3] → [2, 1, 2, 0, 0]; [4, 7, 2, 9, 6] → [0, 2, 0, 1, 0]. Checked against all pairs on 2,000 random arrays.

Counting same-parity elements: the first check → [2, 0, 0, 0, 0].

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
