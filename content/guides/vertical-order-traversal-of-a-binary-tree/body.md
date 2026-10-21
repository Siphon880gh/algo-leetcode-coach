## Coordinates, then one sort

1. DFS (or BFS) from the root at `(row 0, col 0)`. Left child: `(row + 1, col − 1)`; right child: `(row + 1, col + 1)`. Record `(col, row, val)`.
2. Sort the triples.
3. Walk them in order, starting a new group whenever the column changes.

Return the groups.

Sorting by value third handles the tie rule: nodes in the same row and column are listed by value.

Do not use a plain BFS order for ties; same position nodes must be sorted by value, not by visit order. Do not forget negative columns; a map or an offset handles them.

Time: O(n log n)  
Space: O(n)

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
