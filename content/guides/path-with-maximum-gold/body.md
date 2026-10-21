## DFS with restore

1. For each cell with gold, `best = max(best, dfs(r, c))`.
2. `dfs(r, c)`: `v = grid[r][c]`, set it to 0, take `v + max(dfs(neighbour))` over neighbours with gold (0 if none), restore `grid[r][c] = v`, return.

`[[0,6,0],[5,8,7],[0,9,0]]` → 24 (9 → 8 → 7). The second example → 28.

At most 25 cells have gold, which keeps backtracking fast.

Do not memoise by cell; the best path depends on which cells are already used. Do not forget to restore the cell; other paths need it.

Time: O(k · 3ᵏ) for k gold cells  
Space: O(k) recursion

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
