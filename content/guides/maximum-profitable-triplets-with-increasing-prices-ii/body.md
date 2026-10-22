Given two arrays of the same length, prices and profits, choose three indices i < j < k whose prices strictly increase. Return the largest total profit of the three items; what to return when no such triple exists, and the limits, are in the official statement. This version allows larger inputs than part I. For instance, prices [10, 2, 3, 4] with profits [100, 2, 7, 10] → 19. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two Fenwick passes

This assumes −1 when no triple exists.

1. Compress prices to ranks.
2. Left to right: `L[j]` = max profit among ranks < rank[j]; then insert profit[j].
3. Right to left with reversed ranks: `Rt[j]` = max profit among larger prices.
4. Return the max of `L[j] + profit[j] + Rt[j]` where both exist.

Constructed checks (run in code): the example above; prices [4, 3, 2, 1] → −1; [2, 2, 3, 4] with profits [5, 9, 1, 2] → 12; 500 random inputs match testing every triple.

Prices must strictly increase: equal prices are excluded by querying ranks strictly below.

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
