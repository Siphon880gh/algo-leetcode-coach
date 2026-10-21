Each of several virus variants starts at its own grid point on day 0 and spreads one step up, down, left or right per day. Return the minimum number of days until some grid point contains at least k distinct variants. For instance, points [[1,1],[6,1]] with k = 2 → 3; [[3,3],[1,2],[9,2]] with k = 2 → 2; and the same points with k = 3 → 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Best meeting cell

1. For each integer cell in the bounding box of the points: sort (or partially select) the Manhattan distances to all points; take the k-th smallest.
2. Return the minimum.

Constructed checks (verified with code against a wider search on random point sets): the three cases above → 3, 2, 4.

Clamping a cell into the bounding box never increases a distance, so cells outside cannot be better. When coordinates are small (as the statement bounds them), this enumeration is fast enough. Otherwise, binary search the day `d` and test whether k rotated squares (`u = x + y`, `v = x − y`, radius `d`) share an integer cell of the right parity.

Time: O(X · Y · n log n) for the enumeration  
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
