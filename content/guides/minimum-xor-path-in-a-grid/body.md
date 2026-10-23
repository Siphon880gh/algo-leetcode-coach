## Sets per cell

1. S[0][0] = {grid[0][0]}.
2. S[i][j] = {x ⊕ grid[i][j] : x in S[i − 1][j] ∪ S[i][j − 1]}.
3. Return min S[m − 1][n − 1].

Examples → 6, 9, 0. Checked against every path on 500 random grids.

Keeping only the smallest XOR at each cell: constructed check (run in code) [[1, 5], [2, 4]] → 7 instead of 0.

Time: O(m · n · 1024)  
Space: O(m · n · 1024) bits

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
