You get an integer array nums and an integer k. For each index i, count the indices j with j > i + k and nums[j] = nums[i]. Return the counts as an array. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Reverse sweep

1. cnt = empty counter; ans = zeros.
2. For i = n − 1 down to 0: if i + k + 1 < n, cnt[nums[i + k + 1]]++. Then ans[i] = cnt[nums[i]].
3. Return ans.

Assumed here: "after the delay" means j > i + k, as restated above.

Constructed checks (made-up values, run in code): nums = [2, 5, 2, 2, 5], k = 1 → [2, 1, 0, 0, 0]; nums = [7, 7, 7], k = 0 → [2, 1, 0]. Checked against a double loop on 2,000 random arrays.

Counting j ≥ i + k instead: the first check → [2, 1, 1, 0, 0] instead of [2, 1, 0, 0, 0].

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
