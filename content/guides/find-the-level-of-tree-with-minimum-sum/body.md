Given the root of a binary tree, return the level whose node values add up to the smallest sum. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Level sums

This assumes levels count from 1 at the root and a tie goes to the shallower level; check the official statement.

1. BFS: for each level, sum its values.
2. Keep the first level with a strictly smaller sum.

Constructed checks (run in code): [50, 6, 2, 30, 80, 7] → sums 50, 8, 117 → level 2; [5, 2, 1, null, null, 3] → sums 5, 3, 3 → level 2.

Updating on ≤ picks the deeper tie: level 3 on the second check. Sums can pass 32 bits when the values are large; use 64-bit.

Time: O(n)  
Space: O(width)

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
