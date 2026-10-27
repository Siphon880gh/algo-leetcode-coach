## Two cases

For the last values (x, y) = (nums1[n − 1], nums2[n − 1]) with cost 0, and swapped with cost 1:

1. For each i < n − 1: fine if `nums1[i] ≤ x and nums2[i] ≤ y`; else +1 if `nums2[i] ≤ x and nums1[i] ≤ y`; else this case fails.
2. Return the smaller cost, or −1 if both fail.

Examples → 1, 2, −1. Checked against trying every set of swaps on 800 random small inputs.

Never swapping the last index misses better answers: example 1 → 2 instead of 1.

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
