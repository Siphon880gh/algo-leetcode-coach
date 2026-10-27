## Tiny example

The items, as (weight, value), are `(10, 60)`, `(20, 100)` and `(30, 120)`. The capacity is `50`, and you may take part of an item.

The value per unit of weight is `6`, `5` and `4`. Take the best ratio first:

1. Take all of the first item (weight 10). The value so far is 60, and 40 capacity is left.
2. Take all of the second item (weight 20). The value so far is 160, and 20 capacity is left.
3. Take 20 of the third item's 30 units of weight. That adds 80.

The total is **240**. This greedy choice is optimal because you are allowed to take fractions.

## How

1. Sort the items by value per unit of weight, highest first.
2. Take whole items while they fit.
3. Take a fraction of the next item to fill the rest of the bag.

## Trap

Using this greedy method on the **0-1** knapsack, where fractions are not allowed. It can give the wrong answer there.

**Fix:** If fractions are not allowed, use dynamic programming. The ratio greedy only works when you can split items.

**Time:** O(n log n) for the sort · **Space:** O(1) beyond the sort

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
