You are given a tree of n nodes numbered 0 … n − 1 as a list of edges, and queries [start, end, node]. For each query, return the node on the path from start to end that is closest to node. For instance, n = 7, edges [[0,1],[0,2],[0,3],[1,4],[2,5],[2,6]], queries [[5,3,4],[5,3,6]] → [0,2]; n = 3, edges [[0,1],[1,2]], query [[0,1,2]] → [1]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Meeting point of three nodes

1. Root at 0; BFS for parents and depths; build binary lifting for LCA.
2. For each query: `x = lca(s, e)`, `y = lca(s, v)`, `z = lca(e, v)`; return the deepest of the three.

Constructed checks (verified against BFS distances from every node on 300 random trees): the cases above → [0,2], [1].

Any path from `v` to the `s`–`e` path enters it at that meeting node, so it is the unique closest point. For small n, BFS from every node and taking the path node with the least distance also works.

Time: O(n log n + q log n)  
Space: O(n log n)

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
