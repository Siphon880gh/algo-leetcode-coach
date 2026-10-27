## Per-cell sets

1. For each cell (r, c): `a` = distinct values at (r − k, c − k), `b` = distinct values at (r + k, c + k), for k ≥ 1 inside the grid.
2. `answer[r][c] = |a − b|`.

Examples → [[1,1,0],[1,0,1],[0,1,1]], [[0]].

With m, n ≤ 50 the direct walk is fast. To do better, sweep each diagonal once forwards and once backwards with a running set. Exclude the cell itself on both sides.

Time: O(m · n · min(m, n))  
Space: O(min(m, n))

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
