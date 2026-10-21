You are given integer arrays nums and costs of length n and start at index 0. From index i you may jump to an index j > i if either nums[i] ≤ nums[j] and every element strictly between them is smaller than nums[i], or nums[i] > nums[j] and every element strictly between them is at least nums[i]. Jumping to j costs costs[j]. Return the minimum total cost to reach index n − 1. For instance, nums [3,2,4,4,1], costs [3,7,6,4,2] → 8; nums [0,1,2], costs [1,1,1] → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two edges per index

1. `ge[i]` = first `j > i` with `nums[j] ≥ nums[i]`; `lt[i]` = first `j > i` with `nums[j] < nums[i]` (one monotonic stack each).
2. `dp[0] = 0`, others infinite. For `i = 0 … n − 1`: for `j` in `ge[i], lt[i]` (if they exist): `dp[j] = min(dp[j], dp[i] + costs[j])`.
3. Return `dp[n − 1]`.

Constructed checks (verified against testing every pair i < j on 500 small cases): the cases above → 8, 2.

Any later j for the first rule would have the first such index strictly between, breaking the condition, and the same holds for the second rule. Every jump goes right, so one left-to-right pass settles dp.

Time: O(n)  
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
