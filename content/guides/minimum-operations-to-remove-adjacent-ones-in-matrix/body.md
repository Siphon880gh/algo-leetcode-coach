Given a 0-indexed binary matrix grid, one operation flips a 1 to 0. A grid is well-isolated when no 1 is 4-directionally adjacent to another 1. Return the minimum number of operations to make the grid well-isolated. For instance, [[1,1,0],[0,1,1],[1,1,1]] → 3; an all-zero 3 × 3 grid → 0; [[0,1],[1,0]] → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Vertex cover = matching

1. Nodes: cells with 1. Edges: 4-adjacent pairs of 1s; every edge joins an even `(r + c)` cell to an odd one.
2. For each even cell, try an augmenting path (Kuhn's algorithm) through odd neighbours.
3. The number of successful augmentations is the answer.

Constructed checks (verified against trying every set of removed cells on small random grids): the three cases above → 3, 0, 0.

Each flip deletes a node; well-isolated means no edge survives, i.e. the removed cells cover every edge. In a bipartite graph the smallest cover equals the largest matching. Hopcroft–Karp speeds it up for large grids.

Time: O(V · E) with Kuhn  
Space: O(V)

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
