## Two passes

1. Label: give each island an id starting at 2 (so ids do not collide with 0 and 1), overwrite its cells with the id, and store `size[id]`.
2. For each 0 cell, collect the **distinct** ids among its 4 neighbors and compute `1 + Σ size[id]`.
3. The answer is the maximum of those values, or `n²` if there is no 0 (the grid is all land).

Distinctness matters: a water cell touching the same island on two sides must count it once.

Do not flip each 0 and re-run a full flood fill; that is O(n⁴). Do not forget the all-land case; it has no cell to flip.

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
