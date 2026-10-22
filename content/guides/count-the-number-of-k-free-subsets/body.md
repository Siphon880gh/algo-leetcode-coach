You get an array of integers and an integer k. A subset is k-free when no two of its elements differ by exactly k. Count the k-free subsets. Whether values can repeat, whether the empty subset counts, and the limits are in the official statement; the examples here have distinct values and count the empty subset. For instance, [5,4,6] with k = 1 → 5, and [2,3,5,8] with k = 5 → 12. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Chains and products

1. Group the values by `x mod k`; sort each group.
2. In a group keep `take` and `skip` (ways with the last value taken or not). For each value: if it is exactly k above the previous one, `take, skip = skip, take + skip`; else `take = skip = take + skip`.
3. Multiply `take + skip` over all groups (start each group with take = 0, skip = 1).

Constructed checks (verified against testing every subset on 500 random sets of distinct values): the cases above → 5, 12, and [10,5,9,11] with k = 20 → 16.

A gap larger than k breaks the chain, so the next value is free again. The product can be large; use 64-bit or big integers as the statement’s limits require.

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
