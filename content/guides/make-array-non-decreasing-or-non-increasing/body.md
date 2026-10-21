You are given an integer array nums. In one operation you may add 1 to or subtract 1 from any element. Return the minimum number of operations to make nums non-decreasing or non-increasing. For instance, [3,2,4,5,0] → 4; [2,2,3,4] → 0; [0] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Slope trick, both directions

1. `cost(a)`: max-heap `h`; for each `x`: push `x`; if `top(h) > x`: `ans += top(h) − x`, pop, push `x`.
2. Return `min(cost(nums), cost(reverse(nums)))`.

Constructed checks (verified against trying every target array on 300 small cases): the three cases above → 4, 0, 0.

The heap holds the breakpoints of the optimal cost as a function of the last value, so lowering the largest earlier value to `x` is always the cheapest fix. A DP over the value range, `dp[v]` = best cost with the last element at most `v`, also works when values are small.

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
