## BFS per start

1. For each `s`: BFS with `dist` and `parent`.
2. For an edge `u–v` with `v` already visited and `v ≠ parent[u]`: `best = min(best, dist[u] + dist[v] + 1)`.
3. Return `best`, or −1 if none.

Examples → 3, −1. Checked against trying every vertex cycle on 200 random graphs with up to 6 vertices.

A single BFS can overestimate a cycle that does not pass through s, but the BFS started on that cycle finds it exactly. With n and m up to 1000 that is about 10^6 steps.

Time: O(n · (n + m))  
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
