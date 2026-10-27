## Window

1. `k` = number of distinct values; counts `c`, `l = 0`.
2. For each r: add nums[r]; while `c` has k keys, remove nums[l] and `l += 1`.
3. Add l (the starts 0 … l − 1 all work for this r).

Examples → 4, 10. Checked against testing every subarray on 400 random arrays.

A window can never have more than k distinct values, so complete means exactly k. With n ≤ 1000, testing each start with a growing set in O(n²) also passes.

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
