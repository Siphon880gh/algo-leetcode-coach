## Two passes

1. For `i = 0 … n − 2`: if `nums[i] = nums[i + 1]`, set `nums[i] *= 2` and `nums[i + 1] = 0`.
2. Write every non-zero value to the front, keeping their order; fill the rest with 0.
3. Return `nums`.

Examples → [1,4,2,0,0,0], [1,0].

The operations are sequential: in Example 1, after index 1 merges, index 2 compares the new 0 with the next 1. Compact with one write pointer, as in Move Zeroes.

Time: O(n)  
Space: O(1)

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
