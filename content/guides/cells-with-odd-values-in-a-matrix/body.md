## Parity of rows and columns

1. Flip `row[r]` and `col[c]` parity for each index.
2. `R` = odd rows, `C` = odd columns.
3. Return `R · (n − C) + (m − R) · C`.

`m = 2, n = 3, [[0,1],[1,1]]`: rows 0 and 1 are each toggled once (R = 2) and column 1 twice (C = 0) → 2 · 3 = 6.

Simulating on the m × n matrix also works for these small sizes.

Do not add row and column counts; a cell touched by both an odd row and an odd column is even. Do not forget each index affects both a row and a column.

Time: O(m + n + indices)  
Space: O(m + n)

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
