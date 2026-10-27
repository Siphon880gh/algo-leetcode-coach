Given two integer arrays nums1 and nums2 of the same length, find indices i and j with nums1[i] = nums2[j] that minimize i + j, and return that sum, or −1 if the arrays share no value. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Hash map

1. first = {} ; for i, x in nums1: keep only the first i for x.
2. ans = min over j with nums2[j] in first of first[nums2[j]] + j.
3. Return ans, or −1 if no value is shared.

Constructed checks (run in code): [4, 7, 2] and [2, 9, 4] → 2; [5, 6] and [6, 5] → 1; [1, 2] and [3, 4] → −1. Checked against testing every pair on 3,000 random cases.

Storing the last index of each value: [1, 1] and [1, 5] → 1 instead of 0.

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
