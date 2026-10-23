## Tiny example

You have a bag that holds weight **4**, and three items (weight, value):

- A: `(1, 15)`
- B: `(3, 20)`
- C: `(4, 30)`

Each item at most **once**. Best pack: A+B → value **35** (beats C alone = 30).

Draw a table `dp[i][c]` = best value using the **first i items** with capacity **c**:

| i \ c | 0 | 1 | 2 | 3 | 4 |
|-------|---|---|---|---|---|
| 0 (none) | 0 | 0 | 0 | 0 | 0 |
| 1 (A) | 0 | 15 | 15 | 15 | 15 |
| 2 (A,B) | 0 | 15 | 15 | 20 | **35** |
| 3 (A,B,C) | 0 | 15 | 15 | 20 | **35** |

For each cell, compare:

- **Skip** item i → `dp[i-1][c]`
- **Take** item i (if `c >= w`) → `dp[i-1][c-w] + v`

Notice take always reads the **previous row** — that is what keeps each item once.

## How

1. Rows = items `0…n`, columns = capacities `0…W`
2. Row 0 is all zeros
3. For each item, fill its row left→right with skip vs take
4. Answer = `dp[n][W]`

## Trap

Taking from the **same** row (`dp[i][c-w]`) — that accidentally allows a second copy of the item.

**Fix:** For 0-1, take reads `dp[i-1][…]` only.

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
