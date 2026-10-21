## DFS with visit counts

1. `dfs(u, time, quality)`: if `u == 0`, `best = max(best, quality)`.
2. For each edge `(v, t)` with `time + t ≤ maxTime`: `vis[v] += 1`; recurse with `quality + values[v]` if `vis[v] == 1`, else `quality`; `vis[v] −= 1`.
3. Start with `vis[0] = 1`, `quality = values[0]`.

Examples → 75, 25, 7.

At most 10 edges and 4 choices each bounds the search near 4^10 ≈ 10^6. Pruning with shortest distances back to 0 (Dijkstra) speeds it up further. Counting visits, not a boolean, keeps the value correct when a node is passed twice.

Time: O(4^(maxTime / minTime))  
Space: O(n + E)

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
