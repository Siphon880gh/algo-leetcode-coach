## Nine cells per answer

`out[i][j] = max(grid[r][c])` over `r ∈ i … i + 2`, `c ∈ j … j + 2`, for `0 ≤ i, j ≤ n − 3`.

Examples → [[9,9],[8,6]], [[2,2,2],[2,2,2],[2,2,2]].

With n ≤ 100 the direct scan is about 9 · 98² ≈ 86,000 steps. Taking row-wise maxima of width 3 first and then column-wise maxima cuts the work to 6 per cell.

Time: O(n²)  
Space: O(n²) for the output

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
