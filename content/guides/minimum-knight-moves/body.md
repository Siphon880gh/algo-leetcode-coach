On an infinite chessboard, a knight starts at (0, 0). Return the minimum number of moves to reach (x, y). For instance, (2, 1) takes 1 move, (1, 1) takes 2, and (5, 5) takes 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Fold the board

1. `x, y = abs(x), abs(y)`.
2. BFS from `(0, 0)` over the 8 knight moves, skipping cells with a coordinate below −2 and cells already seen.
3. Return the distance when `(x, y)` is popped.

Some shortest paths step just past an axis (reaching (1, 1) needs two moves through a negative coordinate), so a bound of 0 would be wrong; −2 is enough.

A bidirectional BFS or a closed-form formula is faster for very large targets.

Do not BFS over all four quadrants; the search grows four times larger. Do not use DFS; it does not give shortest paths.

Time: O(|x| · |y|) roughly  
Space: O(|x| · |y|)

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
