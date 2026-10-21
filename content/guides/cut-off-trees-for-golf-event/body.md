## The order is forced

Trees must be cut from shortest to tallest, so the only freedom is the route between stops.

1. Collect every cell with a value `> 1` and sort by height.
2. Start at `(0, 0)`. For each tree in order, BFS from the current cell to the tree, moving through any non-zero cell, and add the distance. If it is unreachable, return `-1`.
3. Move to the tree. A cut tree becomes ground (1), but it was walkable anyway, so the grid never needs updating.

Do not try to cut trees in a better order; the order is given. Do not use Dijkstra or A* unless needed; plain BFS is enough on an unweighted grid. A* with a Manhattan heuristic is a valid speedup.

Time: O(T · m · n), for T trees  
Space: O(m · n)

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
