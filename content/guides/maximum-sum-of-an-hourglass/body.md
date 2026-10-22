## Seven cells per corner

1. For `i` in `0 … m − 3`, `j` in `0 … n − 3`: `s = grid[i][j … j + 2] + grid[i + 1][j + 1] + grid[i + 2][j … j + 2]`.
2. Return the largest `s`.

Examples → 30, 35.

The grid is at most 150 × 150, so about 2 · 10^4 corners with 7 cells each. A sum is at most 7 · 10^6, which fits in 32-bit. Row prefix sums save little here.

Time: O(m · n)  
Space: O(1)

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
