## Clip and query

1. `P[i + 1][j + 1] = mat[i][j] + P[i][j + 1] + P[i + 1][j] − P[i][j]`.
2. For `(i, j)`: `r1 = max(0, i − k)`, `c1 = max(0, j − k)`, `r2 = min(m, i + k + 1)`, `c2 = min(n, j + k + 1)`.
3. `ans[i][j] = P[r2][c2] − P[r1][c2] − P[r2][c1] + P[r1][c1]`.

`[[1,2,3],[4,5,6],[7,8,9]]`, k = 1 → `[[12,21,16],[27,45,33],[24,39,28]]`; k = 2 → every cell 45.

Do not sum each block directly; that is O(k²) per cell. Do not forget to clip at the borders.

Time: O(m · n)  
Space: O(m · n)

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
