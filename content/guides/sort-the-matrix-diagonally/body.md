## Diagonal key

1. For each cell, append `mat[i][j]` to `diag[i − j]`.
2. Sort each list (descending, so `pop()` yields the smallest).
3. Refill row by row: `mat[i][j] = diag[i − j].pop()`.

`[[3,3,1,1],[2,2,1,2],[1,1,1,2]]` → `[[1,1,1,1],[1,2,2,2],[1,2,3,3]]`.

Do not use `i + j`; that groups anti-diagonals. Do not sort rows or columns; only diagonals change.

Time: O(m · n · log min(m, n))  
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
