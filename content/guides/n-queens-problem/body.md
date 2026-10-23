## Tiny example (N = 4)

Goal: put **4 queens** on a **4×4** board so no two share a **row**, **column**, or **diagonal**.

Start from an empty board (`.` = empty, rows top→bottom, columns `0`–`3` left→right):

```
. . . .
. . . .
. . . .
. . . .
```

Place **one queen per row**, starting at row `0`. Put the first queen at column `1` → cell `(0, 1)`:

```
. Q . .
. . . .
. . . .
. . . .
```

That queen attacks:

- its whole **column** (`1`)
- the **↘ diagonal** where `row − col` stays `0 − 1 = −1` → next cells `(1, 2)`, `(2, 3)`
- the **↙ diagonal** where `row + col` stays `0 + 1 = 1` → next cell `(1, 0)`

So in **row 1**, columns `0`, `1`, and `2` are under attack. Only column `3` is free → place `(1, 3)`:

```
. Q . .
. . . Q
. . . .
. . . .
```

Row `2`: check each column against the queens already placed.

1. Column `0` — free of those attacks → try `(2, 0)`
2. Columns `1` and `3` share a column with a queen
3. Column `2` sits on a diagonal from `(0, 1)` (`2 − 2 = 0 − 1 = −1`)

```
. Q . .
. . . Q
Q . . .
. . . .
```

Row `3`: only column `2` is free → place `(3, 2)`. Full solution:

```
. Q . .
. . . Q
Q . . .
. . Q .
```

Positions: `(0, 1)`, `(1, 3)`, `(2, 0)`, `(3, 2)`.

If a row has **no** free column, undo the previous placement and try the next column (backtrack). N=4 has a second distinct solution found the same way.

## Bookkeeping (after you can see the board)

Scanning every placed queen on each try works for tiny `n`, but is easy to mistype. Track three “already used” sets instead:

1. **Columns** — which `c` already has a queen
2. **Diag `r − c`** — one key per ↘ diagonal (same difference)
3. **Diag `r + c`** — one key per ↙ diagonal (same sum)

“Can I place at `(r, c)`?” → `c` not in cols, `r−c` not in diag1, `r+c` not in diag2. Place → add those three keys; recurse to row `r + 1`; on return, remove them (backtrack).

## Trap

Forgetting one diagonal family (only banning columns, or only one slash direction). Solutions look almost right until two queens share the ignored diagonal.

**Fix:** Always ban **column + both** diagonal keys. Draw one placement and list the three keys before coding.

**Time:** about O(n!) with pruning (tiny `n` in practice)  
**Space:** O(n) for the path and the three ban sets

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
