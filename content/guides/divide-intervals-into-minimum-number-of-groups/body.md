## Reuse a group if it ended before

1. Sort intervals by `left`.
2. For each `[l, r]`: if the heap’s smallest end is `< l`, replace it with `r`; otherwise push `r`.
3. Return the heap size.

Examples → 3, 1. Checked against the largest number of intervals covering one point on 300 random cases.

Intervals are inclusive, so [1,5] and [5,8] need different groups: use `<`, not `≤`. A difference array over 1 … 10^6 also finds the largest overlap.

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
