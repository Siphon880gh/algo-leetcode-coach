The same task as part I: choose as many distinct integers from 1 to n as possible, skipping a banned list, with their sum at most maxSum. Here n and maxSum are far too large to walk the numbers one by one; the exact limits are in the official statement. For instance, banned [1,4,6], n = 6, maxSum = 10 → 3 (2 + 3 + 5), and with maxSum = 4 → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Gap by gap

1. Sort the distinct banned values `≤ n` and add `n + 1` as a sentinel; `prev = 0`.
2. For each banned `b`: the gap is `prev + 1 … b − 1`. Binary search the largest `t` with `sum + t · (2 · (prev + 1) + t − 1) / 2 ≤ maxSum`; add `t` to the count and its sum.
3. If `t` is less than the gap length, stop; else `prev = b`.
4. Return the count.

Constructed checks (verified against the part I greedy on 500 random cases): the cases above → 3, 1.

Smallest first is optimal for the same exchange reason as part I. Sums of a gap can exceed 32-bit by far, so use 64-bit, and keep the product inside the binary search from overflowing.

Time: O(b log b + b log n) for b banned values  
Space: O(b)

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
