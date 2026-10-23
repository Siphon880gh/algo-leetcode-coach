## Tiny example

Items: A `(1,15)`, B `(3,20)`, C `(4,30)`, bag size **4**.

This time each item may be taken **any number of times**.

Best pack: four copies of A → value **60**.

In the 2D table, the take branch changes:

- **0-1 take:** `dp[i-1][c-w] + v` (previous item row)
- **Complete take:** `dp[i][c-w] + v` (**same** item row — already may hold earlier copies)

Sketch for item A alone on capacities 0…4:

| c | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| after A (unlimited) | 0 | 15 | 30 | 45 | **60** |

Cell c=4 reads c=3 in the **same** row (already 45) + 15 → 60.

## How

1. Rows = items, columns = capacities
2. For each cell: `max(skip = dp[i-1][c], take = dp[i][c-w]+v)` when `c>=w`
3. Fill left→right inside a row so earlier copies exist
4. Answer `dp[n][W]`

## Trap

Copying the 0-1 take (`dp[i-1][c-w]`) while the problem allows unlimited copies.

**Fix:** Complete/unbounded take reads the **same** row (or use a 1D forward loop).

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
