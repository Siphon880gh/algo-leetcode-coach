## Place every legal stamp

1. `P` = 2D prefix sums of `grid`.
2. For each top-left `(i, j)` with the block inside the grid and block sum 0: add 1 to the difference array over that block.
3. Prefix-sum the difference array into coverage counts.
4. True iff every cell with 0 has coverage > 0.

Examples → true, false. Checked against marking every legal placement cell by cell on random grids.

Stamps may overlap, so using every legal placement can only help. The whole check is O(m · n), even with up to 2 · 10^5 cells.

Time: O(m · n)  
Space: O(m · n)

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
