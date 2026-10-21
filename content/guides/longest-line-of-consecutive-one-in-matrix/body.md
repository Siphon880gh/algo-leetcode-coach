`mat` is `m` by `n` of 0 and 1 with `m · n <= 1e4`. Return the longest line of consecutive 1s, horizontal, vertical, diagonal, or anti-diagonal. `[[0,1,1,0],[0,1,1,0],[0,0,0,1]]` → 3 (the diagonal `(0,1)`, `(1,2)`, `(2,3)`). `[[1,1,1,1],[0,1,1,0],[0,0,0,1]]` → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Four running counts per cell

For each cell with a 1, keep four values:

- `h[i][j] = h[i][j − 1] + 1`
- `v[i][j] = v[i − 1][j] + 1`
- `d[i][j] = d[i − 1][j − 1] + 1`
- `a[i][j] = a[i − 1][j + 1] + 1`

(out of range counts as 0; a 0 cell resets all four to 0). The answer is the largest value seen. Scanning row by row means every neighbor used is already computed. Only the previous row is needed, so space can be O(n).

Do not forget the anti-diagonal — it runs up-right, so it reads `j + 1` from the row above. Do not run four separate full scans if one pass covers all four.

Time: O(m n)  
Space: O(m n), or O(n) with rolling rows

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
