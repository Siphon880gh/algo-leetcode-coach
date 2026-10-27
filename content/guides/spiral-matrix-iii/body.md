## Lengths grow every two turns

`dirs = [(0,1), (1,0), (0,−1), (−1,0)]` (east, south, west, north). Start at `(rStart, cStart)` and record it.

`step = 1`, `d = 0`. While fewer than `rows · cols` cells are recorded:

- Repeat twice: walk `step` cells in direction `d`, recording each one inside the grid; then `d = (d + 1) % 4`.
- `step += 1`.

Return the recorded list.

The spiral leaves the grid for long stretches; it just keeps walking until it has covered every cell.

Do not stop the walk when it leaves the grid. Do not grow the length after every turn; it grows after every two.

Time: O(max(rows, cols)²)  
Space: O(rows · cols) for the answer

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
