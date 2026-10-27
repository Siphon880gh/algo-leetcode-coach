## Corners, then prefix sums

1. For each query: `d[r1][c1] += 1`, `d[r1][c2 + 1] −= 1`, `d[r2 + 1][c1] −= 1`, `d[r2 + 1][c2 + 1] += 1`, in an (n + 1) × (n + 1) grid.
2. Take 2D prefix sums.
3. Return the top-left n × n part.

Examples → [[1,1,0],[1,2,1],[0,1,1]], [[1,1],[1,1]].

Filling each submatrix directly costs up to 10^4 · 500² = 2.5 · 10^9 steps. Row-wise 1D differences, O(q · n + n²), also pass.

Time: O(q + n²)  
Space: O(n²)

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
