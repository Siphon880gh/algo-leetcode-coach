## Validate, then act

1. `ins`: if the table is missing or the row length differs from its column count, return false; else give it id `next++` and store it.
2. `rmv`: delete the id if the table and the row exist.
3. `sel`: return the cell if the table, the row and `1 ≤ columnId ≤ columns` all exist; otherwise `<null>`.
4. `exp`: each remaining row as its id and cells joined with commas, in id order; empty for a missing table.

Both examples’ call sequences, replayed against this design, return exactly the expected outputs.

Ids keep counting after removals, so never reuse the map size as the next id. A map that keeps insertion order, or ids sorted on export, gives id order.

Time: O(row length) per call, O(rows) for exp  
Space: O(total cells)

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
