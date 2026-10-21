## Blocked nodes are walls

1. Build adjacency lists; `blocked = set(restricted)`.
2. Search from 0, visiting a neighbour only when it is neither seen nor blocked.
3. Return the number of visited nodes.

Examples → 4, 3.

A tree has one path between any two nodes, so a node is reachable exactly when its path from 0 avoids restricted nodes, which the search checks edge by edge. Union-find over edges with both ends unrestricted, then the size of 0’s set, works too. Use an explicit stack for a path of 10^5 nodes.

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
