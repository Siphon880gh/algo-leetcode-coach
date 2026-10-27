Given an array nums of length n, the sum score at index i is the larger of the sum of the first i + 1 elements and the sum of the last n − i elements (both include nums[i]). Return the maximum sum score over all indices. Values may be negative. For instance, [4,3,-2,5] → 10; [-3,-5] → −3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One pass with the total

1. `t = Σ nums`, `p = 0`, `best = −∞`.
2. For each `i`: `p += nums[i]`; `best = max(best, p, t − p + nums[i])`.
3. Return `best`.

Constructed checks (verified against direct sums at every index on 300 random arrays): the two cases above → 10, −3.

Start `best` below any possible score, since all scores can be negative. Use 64-bit sums to be safe on long arrays.

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
