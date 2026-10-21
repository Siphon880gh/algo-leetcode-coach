## Apex height

1. From the bottom row up: `f[i][j] = 0` if barren; `1` on the last row or the side columns; else `1 + min(f[i+1][j−1], f[i+1][j], f[i+1][j+1])`.
2. Add `f[i][j] − 1` for every cell (heights 2 … f all fit).
3. Repeat on the grid with rows reversed for inverse pyramids; return the sum.

Examples → 2, 2, 13. Checked against testing every apex and height on random grids.

A pyramid of height `h` at `(i, j)` is the cell plus pyramids of height `h − 1` at the three cells below, which is why the minimum gives the tallest.

Time: O(m · n)  
Space: O(m · n), or one row

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
