`picture` is `m` by `n` (up to 200 each) of `'B'` and `'W'`, and `1 <= target <= min(m, n)`. A black pixel at `(r, c)` is lonely if row `r` and column `c` each contain exactly `target` blacks, and every row with a black at column `c` is identical to row `r`. Count them. Sample 1 (three equal rows `WBWBBW` plus `WWBWBW`, target 3) → 6 (all blacks in columns 1 and 3). `[["W","W","B"],["W","W","B"],["W","W","B"]]`, 1 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Check column by column

Precompute `rows[i]` and `cols[j]` (black counts) and, for each column `c`, the list of rows with a black there.

For each column `c` with `cols[c] == target`: let `r` be the first row with a black at `c`. If `rows[r] == target` and every other row in the list equals row `r`, then all `target` blacks in column `c` are lonely: add `target`. Otherwise add 0.

Comparing rows as strings (or tuples) makes the equality check simple. Since all those rows are equal, checking `rows[r]` once covers them all.

Lonely Pixel I (531) is the special case `target = 1` with no row-equality rule needed.

Do not test only the counts — in the sample, column 4 has 4 blacks, and columns with the right count can still contain a different row. Do not count per pixel without the identical-rows check.

Time: O(m n · m) worst case for the row comparisons (O(m n) with row hashing)  
Space: O(m n)

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
