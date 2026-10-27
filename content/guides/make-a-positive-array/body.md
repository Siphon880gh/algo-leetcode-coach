An array is positive when every subarray with more than two elements has a positive sum. In one operation you may replace any element with any integer in a very wide range. Return the fewest operations that make the array positive. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Greedy on right ends

This assumes, as restated, that a replacement can be any large value.

1. ops = 0, last = −1, best = −∞.
2. For each i: once i − 2 > last, best = max(best, pre[i − 2]). If pre[i + 1] − best ≤ 0: ops += 1, nums[i] = huge, last = i, best = −∞.
3. Answer ops.

Constructed checks (run in code): [4, −9, 2] → 1; [−1, −1, −1, −1, −1, −1] → 2; [2, −1, 2, −5, 3] → 1. Checked against trying every set of replacements on 600 random arrays.

Checking only windows of length 3: [−5, 3, 3, −5] → 0 instead of 1.

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
