## Tiny example

A graph has vertices `A`, `B` and `C`, and one directed edge from `A` to `B`. It is stored as adjacency lists.

1. To add an edge from `B` to `C`, append `C` to the list for `B`. This is O(1) amortized.
2. To check whether there is an edge from `A` to `C`, scan the list for `A`. This costs O(degree of A).
3. With an adjacency matrix instead, the same check is one O(1) read of `M[A][C]`.

## How

1. Choose a representation: adjacency lists or an adjacency matrix.
2. Add and remove vertices and edges using that representation's costs.
3. To visit the neighbors of `u`, loop over `adj[u]` for lists, or scan row `u` for a matrix.

## Trap

Removing a vertex's own list but leaving its id in other vertices' lists.

**Fix:** Delete the vertex's list and also remove its id from every other list. Tombstones also work if you handle them carefully.

**Time with lists:** add an edge in O(1); check an edge in O(degree)  
**Time with a matrix:** check an edge in O(1)  
**Space:** O(V + E) for lists, O(V²) for a matrix

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
