## Two counts per cell

1. r[0][0] = 1.
2. For each cell in row-major order:
   - Mirror: d[i + 1][j] += r[i][j]; r[i][j + 1] += d[i][j].
   - Empty: s = r[i][j] + d[i][j]; r[i][j + 1] += s; d[i + 1][j] += s.
3. Return s at the bottom-right, mod 10^9 + 7. Anything sent outside the grid is dropped.

Examples → 5, 2, 1. Checked against following every path on 1,500 random grids.

Treating mirrors as walls: example 1 → 1 instead of 5.

Time: O(m · n)  
Space: O(m · n)

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
