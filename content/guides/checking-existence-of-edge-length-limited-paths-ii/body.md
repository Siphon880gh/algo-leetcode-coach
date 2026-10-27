Design a class built from an undirected weighted graph (n nodes and an edge list) that answers queries (p, q, limit): is there a path from p to q using only edges strictly shorter than limit? Queries arrive online. For instance, with edges (0,1,2), (1,2,4), (2,0,8), query (0, 1, 2) → false and (0, 2, 5) → true. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## DSU with union weights

1. Sort edges by weight; Kruskal with union by rank and **no** path compression; `w[child] = weight` of the edge that attached it.
2. `find(x, limit)`: climb `x = parent[x]` while `parent[x] ≠ x` and `w[x] < limit`.
3. `query(p, q, limit)` → `find(p, limit) == find(q, limit)`.

Constructed check: edges (0,1,2), (1,2,4), (2,0,8): (0, 1, 2) → false; (0, 2, 5) → true; (0, 2, 4) → false.

Union by rank keeps tree height O(log n), so each query is O(log n). Path compression would destroy the recorded weights. Alternatives: binary lifting on the MST or a Kruskal reconstruction tree.

Time: O(E log E) build, O(log n) per query  
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
