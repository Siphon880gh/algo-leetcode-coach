You get two integer arrays nums1 and nums2 of equal length; index i stands for the point (nums1[i], nums2[i]). Find the pair of indices whose points are closest in Manhattan distance |nums1[i] − nums1[j]| + |nums2[i] − nums2[j]|, and return it as two indices. Ties between pairs are broken by an index rule given in the official statement, along with the exact limits. For instance, nums1 = [1,4,9,5], nums2 = [1,6,2,5] → [1,3], at distance 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Divide and conquer

1. Sort points (with their indices) by x.
2. Recurse on the left and right halves; `d` = best distance so far.
3. Collect points with `|x − mid x| ≤ d`, sort them by y, and compare each with following points while their y difference is at most d.
4. Compare candidates by distance, then by the statement’s index rule, and return the best pair.

Constructed checks (verified against all pairs on 1000 random point sets, using smallest indices as the tie rule): the case above → [1,3].

Points at distance at most d from a strip point fit in a small box, so each point is compared with a constant number of others. Using ≤ rather than < keeps tied pairs in play for the index rule. Duplicate points give distance 0.

Time: O(n log² n), or O(n log n) with merge sort by y  
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
