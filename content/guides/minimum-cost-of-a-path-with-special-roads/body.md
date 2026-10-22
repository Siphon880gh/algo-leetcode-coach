## Dense Dijkstra

1. Nodes: start, plus the end of each road; `D[start] = 0`.
2. Pop the closest unfinished node u; update `best = min(best, D[u] + |u − target|)`.
3. For each road (a → b, cost): `D[b] = min(D[b], D[u] + |u − a| + min(cost, |a − b|))`.
4. Return best after all nodes are finished.

Examples → 5, 7, 8.

Walking between any two points costs their Manhattan distance, so a shortest path only ever turns at road endpoints. With r ≤ 200 roads, the O(r²) scan without a heap is simplest.

Time: O(r²)  
Space: O(r)

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
