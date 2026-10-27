## Coloring

`color = [−1] * n`. For each node `s` still uncolored, set `color[s] = 0` and BFS:

- For each neighbor `v` of `u`: if uncolored, `color[v] = 1 − color[u]` and enqueue it. If `color[v] == color[u]`, return false.

Return true when every component is colored.

A graph is bipartite exactly when it has no odd cycle, and two-coloring finds such a cycle as a same-color edge.

**Union-find variant:** for each node, union all of its neighbors together; if a node ends up in the same set as one of its neighbors, it is not bipartite.

Do not start BFS only from node 0; the graph may be disconnected, and every component must be two-colorable.

Time: O(V + E)  
Space: O(V)

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
