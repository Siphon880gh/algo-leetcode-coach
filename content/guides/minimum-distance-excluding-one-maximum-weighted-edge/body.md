You get a connected undirected graph with positive edge weights. The cost of a path from node 0 to node n − 1 is its total weight without its heaviest edge (one copy only, if several tie). Return the smallest cost over all paths. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two-layer Dijkstra

1. dist[v][0] = no edge dropped yet; dist[v][1] = one edge dropped.
2. From (u, f) along (v, w): relax (v, f) with cost + w; if f = 0, also relax (v, 1) with cost + 0.
3. Return dist[n − 1][1].

Assumed here: weights are positive and 0 ≠ n − 1.

Constructed checks (made-up graphs, run in code): path 0–1–2–3 with weights 1, 1, 1 plus edge 0–3 of weight 20 → 0; edges 0–1 (3), 1–2 (5) → 3; a square 0–1 (2), 1–3 (9), 0–2 (4), 2–3 (4) → 2. Checked against listing every simple path on 800 random graphs.

Taking the shortest path first and then dropping its heaviest edge: the first graph → 2 instead of 0.

Time: O(m log n)  
Space: O(n + m)

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
