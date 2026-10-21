## The Tian Ji horse race

1. Sort `nums1` ascending; `lo = 0`, `hi = n − 1`.
2. Sort the indices of `nums2` by value, descending.
3. For each index `i` in that order:
   - If `nums1[hi] > nums2[i]`: `res[i] = nums1[hi]`, `hi −= 1`.
   - Else: `res[i] = nums1[lo]`, `lo += 1` (nothing beats it, so spend the weakest).

Return `res`.

When your best cannot win, no card can, so the cheapest loss is right. When it can win, using it here is safe: if an optimal answer used it on another opponent, swapping it with the card placed here never loses a win.

Do not sort `nums2` itself; the answer must line up with its original order. Do not use `≥`; a tie is not an advantage.

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
