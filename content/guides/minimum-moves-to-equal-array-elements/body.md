## Flip the move around

Adding 1 to everything except one element leaves the differences the same as subtracting 1 from that one element. Only differences decide when all values are equal, so think of each move as "lower one element by 1". Lowering never helps a value go below the minimum, so every element drops to `min(nums)`. Moves = `Σ (x − min)` = `sum(nums) − min(nums) · n`.

Use 64-bit math for the sum: `n · |min|` can reach 1e14 even though the final answer fits in 32 bits. You can also add `x − min` one value at a time.

Minimum Moves to Equal Array Elements II (462) moves one element by ±1 per move, and its target is the median.

Do not simulate moves (the answer can be about 2e9). Do not aim for the maximum or the mean.

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
