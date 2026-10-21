## Memo DFS; strict increase is a DAG

Longest Increasing Subsequence (300) is a 1-D subsequence. Here the moves are grid edges. Equals do not extend. Naive DFS from every cell without a cache is exponential.

`dfs(i, j)`: if cached, return it. Else try four neighbors in-bounds with `matrix[x][y] > matrix[i][j]`, take the max of those `dfs` values (0 if none), store `1 + that max`, return it. Answer is max `dfs` over all cells. Because each edge goes to a strictly larger value, there are no cycles: memoization visits each cell once.

Topo / Kahn from local minima (or sort cells by value) also works: process increasing values and relax `f[next] = max(f[next], f[here] + 1)`. Same O(m n) after the sort or degree pass. Number of Increasing Paths in a Grid (2328) counts paths; this problem wants the longest length.

Do not allow equal neighbors. Do not move diagonally. Do not reuse 300’s tails array. Do not skip the cache.

Time: O(m n) memo DFS  
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
