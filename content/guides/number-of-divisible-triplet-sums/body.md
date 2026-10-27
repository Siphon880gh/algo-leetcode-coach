Given an integer array nums and an integer d, count the index triples i < j < k with nums[i] + nums[j] + nums[k] divisible by d. Limits are in the official statement. For instance, [3, 3, 4, 7, 8] with d = 5 → 3, and [1, 2, 3] with d = 3 → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## O(n²) with a remainder map

This assumes n is small enough for O(n²) pairs; check the official limits.

1. cnt = empty map.
2. For each j: for each k > j, add `cnt[(−nums[j] − nums[k]) mod d]`; then add nums[j] mod d to cnt.

Constructed checks (run in code): the examples above; 800 random arrays match testing every triple.

Time: O(n²)  
Space: O(min(n, d))

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
