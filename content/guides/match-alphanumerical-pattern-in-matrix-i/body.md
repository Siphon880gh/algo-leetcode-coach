You are given a grid of digits and a smaller pattern grid of digits and letters. Find a placement of the pattern inside the grid where each pattern digit equals the grid digit under it and each letter stands for one digit consistently. Return the top-left cell of the placement, choosing among several as the statement says, or a not-found value. Exact rules, tie-breaks and limits are in the official statement. For instance, grid [[1, 2, 2], [2, 2, 3], [2, 3, 3]] with pattern rows ab and bb → [0, 0]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Brute force with two maps

This assumes different letters must stand for different digits; check the official statement.

1. For each top-left (r, c) in scan order: maps L→D and D→L empty.
2. For each pattern cell: a digit must equal the grid digit; a letter must agree with both maps (set them on first sight).
3. Return the first (r, c) that passes; otherwise the not-found value.

Constructed checks (run in code): the example above; [[1, 1, 2], [3, 3, 4], [6, 6, 6]] with ab, 66 → [1, 1]; [[1, 2], [2, 1]] with xx → not found.

One map is not enough under that assumption: grid [[1, 1], [2, 2]] with pattern ab passes at [0, 0] with only letter → digit, though a and b both mean 1.

Time: O(m n p q)  
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
