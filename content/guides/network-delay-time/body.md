## Shortest paths, then a max

1. Build an adjacency list of `u → (v, w)`.
2. `dist[k] = 0`, push `(0, k)` on a min-heap.
3. Pop `(d, u)`. Skip it if `d > dist[u]` (stale). Otherwise relax each edge: if `d + w < dist[v]`, update and push.
4. If any `dist` is still ∞, return `-1`; else return `max(dist)`.

All weights are non-negative, so Dijkstra applies. With `n ≤ 100`, Bellman-Ford (O(n · E)) or Floyd-Warshall (O(n³)) also pass.

Do not use plain BFS; the edges have different weights. Do not return the sum of the distances; signals travel in parallel, so the answer is the slowest arrival.

Time: O(E log V)  
Space: O(V + E)

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
