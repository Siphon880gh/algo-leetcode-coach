## Tiny example

Graph with vertices `{A,B,C}` and one edge `A→B` stored as adj lists.

1. Add edge `B→C` → append `C` to `B`’s list — O(1) amortized
2. Check “is `A→C` present?” → scan `A`’s list — O(degree(A))
3. Same check on a matrix → O(1) read of `M[A][C]`


## How

1. Choose representation (list vs matrix)
2. Implement add/remove vertex/edge with that cost model
3. Iterate neighbors with `for v in adj[u]` (lists) or a row scan (matrix)


## Trap

Removing a vertex from adj lists but leaving dangling neighbor entries elsewhere.

**Fix:** Delete the vertex’s list and scrub its id from every other list (or use tombstones carefully).

**Time:** list edge add O(1); matrix edge query O(1); list edge query O(deg) · **Space:** lists O(V+E); matrix O(V²)

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
