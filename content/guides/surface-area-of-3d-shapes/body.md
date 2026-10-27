## Start with every tower alone

For each cell with `v = grid[i][j] > 0`:

- Add `4v + 2`: four sides of height `v`, plus top and bottom.
- If there is a cell below, subtract `2 · min(v, grid[i + 1][j])`.
- If there is a cell to the right, subtract `2 · min(v, grid[i][j + 1])`.

Return the total.

Cubes stacked within a tower already lose their shared faces in `4v + 2`. Between two towers, the lower one's side is fully covered, and so is the matching part of the taller one's side: `2 · min`.

Do not add 2 for empty cells. Do not subtract for all four neighbors; each shared wall would be removed twice.

Time: O(n²)  
Space: O(1)

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
