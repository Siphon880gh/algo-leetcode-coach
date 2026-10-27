## Tiny example

An undirected graph:

```
A — B
|   |
C — D
```

There are two common ways to store it.

**Adjacency list:** `A: [B, C]`, `B: [A, D]`, `C: [A, D]`, `D: [B, C]`. It uses O(V + E) space, and looping over a vertex's neighbors is fast.

**Adjacency matrix:** a 4 × 4 grid of bits where `M[A][B] = 1` means there is an edge. Checking one edge is O(1), but the grid uses O(V²) space.

## Directed and undirected edges

A directed edge from `A` to `B` appears only in `A`'s list. An undirected edge is usually stored in both directions, once in each endpoint's list.

## Trap

Using a matrix for a huge sparse graph, with millions of vertices but few edges, and running out of memory.

**Fix:** Use adjacency lists for sparse graphs. Use a matrix for dense graphs, or when constant-time edge checks matter most.

**Time to list every edge using adjacency lists:** O(V + E)  
**Space:** O(V + E) for lists; O(V²) for a matrix

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
