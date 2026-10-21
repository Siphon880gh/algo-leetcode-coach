## Do not build the subdivided graph

An edge `(u, v, cnt)` becomes a path of `cnt + 1` steps, and `cnt` can be 10⁴, so keep the original nodes only.

1. Dijkstra from 0 with weight `cnt + 1` per edge to get `dist`.
2. `ans` = number of original nodes with `dist ≤ maxMoves`.
3. For each edge: `a = max(0, maxMoves − dist[u])`, `b = max(0, maxMoves − dist[v])`. Add `min(cnt, a + b)`.

`a` is how far into the edge you can walk from `u` (unreachable nodes have infinite distance and contribute 0). Capping at `cnt` stops the two sides from double counting where they meet.

Do not expand each edge into `cnt` nodes; the graph could have up to 10⁸ of them. Do not count the middle nodes from one end only.

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
