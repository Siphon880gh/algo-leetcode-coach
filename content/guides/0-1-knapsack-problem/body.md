## Tiny example

The bag holds weight **4**. There are three items, written as (weight, value):

- `(1, 15)`
- `(3, 20)`
- `(4, 30)`

You may take each item **at most once**.

Compare a few packings:

- Take only `(4, 30)`. The value is 30.
- Take `(1, 15)` and `(3, 20)`. The value is **35**, the best answer.
- Take `(1, 15)` alone. The value is 15.

To solve it with one array, let `dp[c]` be the best value that fits in capacity `c`. For each item, update `c` from 4 down to the item's weight `w`:

```
dp[c] = max(dp[c], dp[c - w] + v)
```

Going from high to low capacity keeps `dp[c - w]` meaning "the best value without this item", so no item is counted twice.

## How

1. Start with `dp` filled with zeros.
2. For each item, scan the capacities from high to low.
3. At each capacity, keep the better of skipping the item and taking it, using the `max` above.
4. The answer is `dp[W]`.

## Trap

Scanning capacity upward. Then the same item can be counted more than once, and you have accidentally solved the unbounded knapsack.

**Fix:** For 0-1 knapsack, scan capacity backward. For unbounded knapsack, scan it forward.

**Time:** O(nW)  
**Space:** O(W)

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
