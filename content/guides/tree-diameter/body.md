Given the edges of an undirected tree with nodes numbered from 0, return the number of edges on its longest path. For instance, `[[0,1],[0,2]]` gives 2 and `[[0,1],[1,2],[2,3],[1,4],[4,5]]` gives 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Farthest from the farthest

1. Build the adjacency list.
2. BFS from node 0; let `u` be the farthest node.
3. BFS from `u`; return the largest distance.

In a tree, the farthest node from any start is an end of some diameter.

A single DFS that returns the two deepest child heights at each node also works.

Do not run BFS from every node; that is O(n²). Do not count nodes instead of edges.

Time: O(n)  
Space: O(n)

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
