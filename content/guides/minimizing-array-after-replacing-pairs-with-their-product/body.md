Given an array of non-negative integers and an integer k, you may repeatedly replace two adjacent elements with their product when that product is at most k. Return the smallest length the array can reach. The exact conditions and limits are in the official statement. For instance, [2, 3, 3, 7, 3, 5] with k = 20 → 3 and [3, 9, 0] with k = 4 → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Greedy

This assumes non-negative values and that a merge needs x · y ≤ k.

1. If any value is 0, return 1.
2. `cur = a[0]`, `count = 1`; for each next x: if `cur · x ≤ k`, `cur *= x`; else `count += 1`, `cur = x`.
3. Return count.

Constructed checks (run in code): the examples above; 1500 random arrays match a search over every merge order.

The zero check is needed: greedy alone gives [3, 9, 0] → 2, but merging 9 and 0 first, then 3 and 0, reaches 1.

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
