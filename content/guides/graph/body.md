## Tiny example

Undirected graph:

```
A — B
|   |
C — D
```

Two common stores:

**Adj list:** `A:[B,C]`, `B:[A,D]`, `C:[A,D]`, `D:[B,C]` — space O(V+E), iterate neighbors fast.

**Adj matrix:** 4×4 bit grid; `M[A][B]=1` — O(1) edge query, O(V²) space.

## Directed vs undirected

Directed edge `A→B` appears only in `A`’s list. Undirected usually stores both `A→B` and `B→A`.

## Trap

Using a matrix on a huge sparse graph (millions of vertices, few edges) and running out of memory.

**Fix:** Prefer adj lists for sparse graphs; matrices for dense graphs or when O(1) “is edge?” dominates.

**Time (list all edges via lists):** O(V+E)  
**Space:** lists O(V+E); matrix O(V²)

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
