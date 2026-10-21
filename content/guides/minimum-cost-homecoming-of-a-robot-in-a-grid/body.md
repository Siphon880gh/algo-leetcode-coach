## Order does not matter

1. Rows: sum `rowCosts[r]` for every `r` strictly after `startPos[0]` up to and including `homePos[0]` (in either direction).
2. Columns: the same with `colCosts`.
3. Return the total.

Examples → 18, 0.

Each move into row `r` costs `rowCosts[r]` whatever the column, so the row part depends only on which rows are entered. Every route must enter each row between start and home at least once, and costs are non-negative, so the straight route is optimal. The start cell is free.

Time: O(m + n)  
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
