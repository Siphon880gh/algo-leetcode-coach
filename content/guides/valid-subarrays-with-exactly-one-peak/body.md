You get an integer array nums and an integer k. A peak is an index whose value is greater than both neighbors. Count the subarrays that contain exactly one peak and stay within k positions of it on each side. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Per peak

1. peaks = indices i in 1 … n − 2 with nums[i] above both neighbors.
2. For peak p: lo = max(p − k, previous peak + 1, 0); hi = min(p + k, next peak − 1, n − 1).
3. ans += (p − lo + 1) · (hi − p + 1).

Assumed here: peaks are judged in the whole array, and a valid subarray reaches at most k positions on each side of its peak.

Constructed checks (made-up values, run in code): [1, 3, 1, 2, 5, 2] → 8 with k = 1 and 12 with k = 5. Checked against every subarray on 1,500 random arrays under the same reading.

Ignoring the distance limit: the first check → 12 instead of 8.

Time: O(n)  
Space: O(n)

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
