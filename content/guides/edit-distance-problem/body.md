## Tiny example

Turn `cat` into `cut`.

You only need **one** edit: replace `a` with `u`.

Imagine a grid whose rows are prefixes of `cat` and columns are prefixes of `cut`:

|   | "" | c | cu | cut |
|---|----|---|----|-----|
| "" | 0 | 1 | 2 | 3 |
| c | 1 | 0 | 1 | 2 |
| ca | 2 | 1 | 1 | 2 |
| cat | 3 | 2 | 2 | **1** |

Reading `dp[row][col]` = “edits to turn that row-prefix into that col-prefix”:

- Empty → any string of length `j` costs `j` inserts (top row)
- Any string → empty costs `i` deletes (left column)
- When the last letters **match** (`c`/`c`), copy the diagonal with **no** +1
- When they **differ** (`a`/`u`), take `1 + min(insert, delete, replace)`

Answer for full strings: bottom-right = **1**.

Same idea scales to `kitten` → `sitting` = **3**.

## How

1. Build an `(m+1) × (n+1)` table for prefixes of `a` and `b`
2. Fill borders with pure inserts / deletes
3. For each cell: match → diagonal; else `1 + min` of three neighbors
4. Return `dp[m][n]`

## Trap

Always paying a replace even when the two letters are equal.

**Fix:** If `a[i-1] == b[j-1]`, take `dp[i-1][j-1]` with **no** extra cost.

**Time:** O(mn)  
**Space:** O(mn) (or O(min(m,n)) with a rolling row)

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
