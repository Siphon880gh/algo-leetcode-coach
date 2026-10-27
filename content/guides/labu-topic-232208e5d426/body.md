## Tiny example

The items are A `(1, 15)`, B `(3, 20)` and C `(4, 30)`, and the bag holds **4**.

This time each item may be taken **any number of times**.

The best packing is four copies of A, worth **60**.

In the two-dimensional table, the take option changes:

- **0-1 take:** `dp[i-1][c-w] + v`, reading the previous item's row.
- **Complete take:** `dp[i][c-w] + v`, reading the **same** row, which may already include earlier copies.

Here is the row for item A alone, for capacities 0 to 4:

| c | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| after A (unlimited) | 0 | 15 | 30 | 45 | **60** |

The cell for c = 4 reads the cell for c = 3 in the **same** row (already 45) and adds 15, giving 60.

## How

1. The rows are items and the columns are capacities.
2. For each cell with `c >= w`, take the larger of skip, `dp[i-1][c]`, and take, `dp[i][c-w] + v`.
3. Fill each row from left to right, so earlier copies already exist.
4. The answer is `dp[n][W]`.

## Trap

Copying the 0-1 take rule, `dp[i-1][c-w]`, when the problem allows unlimited copies.

**Fix:** For the complete (unbounded) knapsack, the take option reads the **same** row. A one-array forward loop also works.

**Time:** O(nW)  
**Space:** O(nW)

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
