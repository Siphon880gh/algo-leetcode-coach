## Deque instead of a heap

1. `dist[0][0] = 0`; deque with `(0, 0)`.
2. Pop from the front; for each neighbour with `dist[u] + grid[v] < dist[v]`: update it, push to the front if `grid[v] = 0`, else to the back.
3. Return `dist[m − 1][n − 1]`.

Examples → 2, 0.

Removing an obstacle is the same as walking through it at cost 1, so this is a shortest path with weights 0 and 1, where a deque keeps the order Dijkstra needs. Plain BFS counts cells, not obstacles. m · n ≤ 10^5.

Time: O(m · n)  
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
