## Fix the middle

1. `p[i]` = position of `nums1[i]` in `nums2`.
2. Left to right with a Fenwick tree: `less = count of seen values < p[i]`.
3. `greater = (n − 1 − p[i]) − (i − less)`; add `less · greater`; insert `p[i]`.

Examples → 1, 4. Checked against trying every triple on 200 random permutation pairs.

The values on the right larger than `p[i]` are all larger values minus those already seen on the left. Counts reach about n³/6, so use 64-bit.

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
