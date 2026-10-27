## Tiny example

In the multiple (bounded) knapsack, item i may be taken at most `k_i` times.

A tiny case: one item with weight 2 and value 5, `k = 2`, and `W = 5`. You can take 0, 1 or 2 copies. The best value is `10`, from two copies with total weight 4.

Three approaches:

1. Expand the item into `k` separate 0-1 items. This is the simple version.
2. Split the count into binary packs (`1, 2, 4, …`), then solve it as 0-1.
3. Loop over the number of copies as an extra dimension, carefully.

## How

1. Build the copy limit into the model.
2. Prefer binary splitting when k is large.
3. After expanding, solve it with ordinary 0-1 DP.

## Trap

Treating bounded items as unbounded, with a forward loop that has no cap on the count.

**Fix:** Cap the copies, either by expanding or with an explicit count loop.

**Time:** depends on the expansion; binary splitting is about O(n log k · W) · **Space:** O(W)

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
