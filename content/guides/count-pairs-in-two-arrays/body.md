Given two equal-length integer arrays nums1 and nums2, count pairs of indices i < j with nums1[i] + nums1[j] > nums2[i] + nums2[j]. For instance, [2,1,2,1] and [1,2,1,2] → 1, and [1,10,6,2] and [1,4,1,5] → 5. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Reduce to one array

1. `d[i] = nums1[i] − nums2[i]`; sort.
2. `l = 0`, `r = n − 1`; while `l < r`: if `d[l] + d[r] > 0`, add `r − l` and `r −= 1`; else `l += 1`.

Constructed checks (verified against brute force on random arrays): the two cases above → 1 and 5.

Sorting is safe because the condition is symmetric in the pair, so only unordered pairs matter. Use strict `>`; equal sums do not count.

Time: O(n log n)  
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
