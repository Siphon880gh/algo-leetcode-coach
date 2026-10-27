## Reverse topological peeling

1. `out[u]` = the out-degree of `u`. Build reverse edges `v → u` for each `u → v`.
2. Queue every node with `out[u] == 0`; they are terminal and safe.
3. Pop `v`. For each `u` with an edge `u → v`, decrement `out[u]`. When it reaches 0, every edge from `u` leads to a safe node, so push `u`.
4. The safe nodes are those processed; return them sorted.

Nodes on or leading into a cycle never reach out-degree 0, so they are never marked safe.

**DFS alternative:** three colors (unvisited, visiting, safe). A node is unsafe if DFS from it reaches a visiting node (a cycle) or an unsafe node.

Do not mark a node safe when only one path from it ends at a terminal; every path must. Do not forget to sort the output.

Time: O(V + E)  
Space: O(V + E)

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
