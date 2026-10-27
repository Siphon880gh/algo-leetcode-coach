## Distances define a DAG

1. Dijkstra from `n` → `dist`.
2. `ways[n] = 1`. Process nodes in increasing `dist`: `ways[u] = Σ ways[v]` over neighbours with `dist[v] < dist[u]`, mod 1e9+7.
3. Return `ways[1]`.

Example 1 → 3. Example 2 → 1.

Run Dijkstra from the last node, not the first; the restriction compares distances to node n. Strict `<` keeps ties out.

Time: O(E log n)  
Space: O(n + E)

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
