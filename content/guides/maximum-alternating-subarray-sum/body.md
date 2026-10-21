The alternating sum of a subarray nums[i … j] is nums[i] − nums[i + 1] + nums[i + 2] − … ending with ± nums[j]. Return the maximum alternating sum over all non-empty subarrays. For instance, [3,-1,1,2] → 5, [2,2,2,2,2] → 2, [1] → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Kadane with signs

1. `pos = nums[0]`, `neg = −∞`, `best = nums[0]`.
2. For each next `x`: `pos, neg = max(x, neg + x), pos − x`; `best = max(best, pos, neg)`.

Constructed checks (verified against every subarray on random arrays): the three cases above → 5, 2, 1.

A subarray always starts with a plus sign, which is why only `pos` may restart at `x`. Ending on a minus is allowed, so `neg` counts toward the answer too.

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
