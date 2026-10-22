## Lists plus Dijkstra

1. Constructor: `adj[from]` gets `(to, cost)` for each edge.
2. `addEdge`: append to `adj[from]`.
3. `shortestPath(a, b)`: Dijkstra from a with a min-heap; return the distance when b is popped, else −1.

Example → [null,6,−1,null,6].

With n ≤ 100 and at most 100 queries, a fresh Dijkstra each time is cheap. Floyd–Warshall plus an O(n²) update per added edge is the alternative when queries dominate.

Time: O(m log n) per query, O(1) per edge  
Space: O(n + m)

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
