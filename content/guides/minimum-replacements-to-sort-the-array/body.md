## Fewest parts, largest smallest part

1. `cap = nums[n − 1]`, `ops = 0`.
2. For `x` from `nums[n − 2]` down to `nums[0]`: `k = ceil(x / cap)`; `ops += k − 1`; `cap = floor(x / k)`.
3. Return `ops`.

Examples → 2, 0. Checked against trying every part count with memoised search on 300 random small arrays.

The last element never needs splitting, since splitting it only lowers the cap. k is the fewest parts that each fit under the cap, and an even split maximises the smallest part, which leaves the most room to the left. Operations can reach about 10^14, so use 64-bit.

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
