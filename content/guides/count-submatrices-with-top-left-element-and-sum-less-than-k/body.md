## Prefix sums

1. P[i + 1][j + 1] = grid[i][j] + P[i][j + 1] + P[i + 1][j] − P[i][j].
2. Count cells with P ≤ k.

Examples → 4, 6.

Only submatrices with the top-left cell count: counting every submatrix with sum ≤ k gives example 1 → 16. Sums stay below 10^9 + 1, since 10^6 cells hold at most 1,000 each.

Time: O(m n)  
Space: O(m n), or O(n) with one row

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
