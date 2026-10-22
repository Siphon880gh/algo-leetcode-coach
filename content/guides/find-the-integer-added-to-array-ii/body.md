## Three candidates

1. Sort both arrays. Two removals leave one of nums1[0], nums1[1], nums1[2] as the minimum.
2. For i = 2, 1, 0 (smallest x first): x = nums2[0] − nums1[i].
3. Two pointers: if nums2 is a subsequence of nums1 + x, return x.

Examples → −2, 2. Checked against trying every pair of removals on 500 random arrays.

Version I’s difference of minimums fails here: example 1 → 10 − 4 = 6, which does not fit; the removed values are 4 and 8.

Time: O(n log n)  
Space: O(1) beyond sorting

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
