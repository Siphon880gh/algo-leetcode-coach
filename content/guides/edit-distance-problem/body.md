## Tiny example

Turn `cat` into `cut`.

You only need **one** edit: replace `a` with `u`.

Picture a grid. The rows are prefixes of `cat` and the columns are prefixes of `cut`:

|   | "" | c | cu | cut |
|---|----|---|----|-----|
| "" | 0 | 1 | 2 | 3 |
| c | 1 | 0 | 1 | 2 |
| ca | 2 | 1 | 1 | 2 |
| cat | 3 | 2 | 2 | **1** |

`dp[row][col]` is the number of edits needed to turn the row's prefix into the column's prefix.

- Turning the empty string into a string of length `j` takes `j` inserts. That fills the top row.
- Turning a string of length `i` into the empty string takes `i` deletes. That fills the left column.
- When the last letters **match** (like `c` and `c`), copy the diagonal value with **no** extra cost.
- When they **differ** (like `a` and `u`), take 1 plus the smallest of the insert, delete and replace neighbors.

The answer for the full strings is the bottom-right cell: **1**.

The same method gives `kitten` to `sitting` = **3**.

## How

1. Build an `(m+1) × (n+1)` table for the prefixes of `a` and `b`.
2. Fill the top row with inserts and the left column with deletes.
3. For each other cell: if the letters match, copy the diagonal. Otherwise take 1 plus the smallest of the three neighbors.
4. Return `dp[m][n]`.

## Trap

Always paying for a replace, even when the two letters are equal.

**Fix:** If `a[i-1] == b[j-1]`, take `dp[i-1][j-1]` with **no** extra cost.

**Time:** O(mn)  
**Space:** O(mn), or O(min(m, n)) if you keep only one row

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
