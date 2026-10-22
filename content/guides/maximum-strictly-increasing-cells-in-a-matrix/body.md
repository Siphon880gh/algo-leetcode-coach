## Value order

1. `R[r]`, `C[c]` = best path length ending in row r, column c, all 0.
2. For each group of equal values in increasing order: compute `v = 1 + max(R[r], C[c])` for every cell, then update `R[r]`, `C[c]` with v.
3. Return the largest v.

Examples → 2, 1, 4. Checked against memoised search on 300 random small matrices.

Updating inside a group lets equal values extend each other: [[1,1],[1,1]] → 3 instead of 1. Only the best value per row and column matters, because any cell in that line is reachable from a smaller one.

Time: O(mn log(mn))  
Space: O(mn)

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
