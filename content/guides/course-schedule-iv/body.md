## Precompute reach

1. `r[a][b] = true` for each prerequisite `[a, b]`.
2. For `k`, `i`, `j`: `r[i][j] |= r[i][k] and r[k][j]`.
3. Answer each query `[u, v]` with `r[u][v]`.

n = 2, `[[1,0]]`, queries `[[0,1],[1,0]]` → `[false,true]`. n = 3, `[[1,2],[1,0],[2,0]]`, `[[1,0],[1,2]]` → `[true,true]`.

Do not run a search per query if queries are many; precompute. Do not mix up direction: `[a, b]` means a is a prerequisite of b.

Time: O(n³ + q)  
Space: O(n²)

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
