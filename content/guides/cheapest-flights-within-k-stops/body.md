## Limit the number of edges

`dist[src] = 0`, everything else ∞. Repeat `k + 1` times:

- `next = dist.copy()`.
- For each flight `(u, v, w)`: if `dist[u] + w < next[v]`, set `next[v] = dist[u] + w`.
- `dist = next`.

Return `dist[dst]`, or `-1` if it is still ∞.

Reading from `dist` and writing to `next` is the key: relaxing in place could chain several flights within one round and break the stop limit.

**BFS/Dijkstra variant:** a queue of `(node, cost, stops)` works if you prune by the best cost seen at each `(node, stops)`. Plain Dijkstra on cost alone is wrong, because a cheaper path with more stops can block a pricier path that fits the limit.

Do not relax edges in place. Do not count stops as flights; `k` stops means `k + 1` flights.

Time: O(k · E)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
