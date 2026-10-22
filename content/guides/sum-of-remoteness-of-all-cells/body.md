Given a square grid in which some cells are blocked and the rest hold positive values, the remoteness of an open cell is the sum of the values in open cells it cannot reach by moving up, down, left or right through open cells. Return the sum of the remoteness of all open cells. How blocked cells are marked and the limits are in the official statement. For instance, with B blocked, [[1, B], [B, 2]] → 3 and [[1, 2], [B, 3]] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Per component

1. S = sum of all open values.
2. Flood fill each component, getting its sum c and size z.
3. Add `z · (S − c)` per component.

Constructed checks (run in code): the examples above; [[2, B, 3], [B, B, B], [4, 5, B]] → 33; 300 random grids match a search from every cell.

A search from every cell is O(cells²); one flood fill visits each cell once.

Time: O(n²)  
Space: O(n²)

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
