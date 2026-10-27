## Tiny example (N = 4)

Goal: put **4 queens** on a **4×4** board so that no two share a **row**, a **column** or a **diagonal**.

Start from an empty board. A `.` is an empty square. Rows are numbered from the top, and columns `0` to `3` from the left:

```
. . . .
. . . .
. . . .
. . . .
```

Place **one queen per row**, starting at row `0`. Put the first queen in column `1`, at cell `(0, 1)`:

```
. Q . .
. . . .
. . . .
. . . .
```

That queen attacks:

- its whole **column**, column `1`
- the **down-right diagonal**, where `row − col` stays `0 − 1 = −1`. In the next rows this is cells `(1, 2)` and `(2, 3)`.
- the **down-left diagonal**, where `row + col` stays `0 + 1 = 1`. In the next row this is cell `(1, 0)`.

So in **row 1**, columns `0`, `1` and `2` are under attack. Only column `3` is free, so place a queen at `(1, 3)`:

```
. Q . .
. . . Q
. . . .
. . . .
```

In row `2`, check each column against the queens already placed:

1. Column `0` is not attacked, so try `(2, 0)`.
2. Columns `1` and `3` already have a queen.
3. Column `2` is on a diagonal from `(0, 1)`, because `2 − 2 = 0 − 1 = −1`.

```
. Q . .
. . . Q
Q . . .
. . . .
```

In row `3`, only column `2` is free, so place `(3, 2)`. The full solution:

```
. Q . .
. . . Q
Q . . .
. . Q .
```

The positions are `(0, 1)`, `(1, 3)`, `(2, 0)` and `(3, 2)`.

If a row has **no** free column, undo the previous placement and try that queen's next column. This is backtracking. N = 4 has a second solution, found the same way.

## Bookkeeping (once you can see the board)

Checking every placed queen on each try works for tiny `n`, but it is easy to get wrong. Track three sets of "already used" keys instead:

1. **Columns:** which columns `c` already have a queen.
2. **Down-right diagonals, keyed by `r − c`:** every cell on one of these diagonals has the same difference.
3. **Down-left diagonals, keyed by `r + c`:** every cell on one of these diagonals has the same sum.

You can place a queen at `(r, c)` when `c` is not in the columns set, `r − c` is not in the first diagonal set and `r + c` is not in the second.

When you place a queen, add those three keys and recurse to row `r + 1`. When the call returns, remove them again. That is the backtrack step.

## Trap

Forgetting one family of diagonals, for example banning only columns, or only one diagonal direction. Solutions look almost right until two queens share the diagonal you ignored.

**Fix:** Always ban the **column and both** diagonal keys. Draw one placement and list its three keys before coding.

**Time:** about O(n!) with pruning (in practice n is small)  
**Space:** O(n) for the path and the three sets

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
