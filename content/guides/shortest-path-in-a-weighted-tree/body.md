## Subtree ranges

1. DFS from 1: tin, tout (subtree = [tin, tout)), parent of each node.
2. Setting edge (u, v) to w: c = the child end; d = w − current; add d on [tin[c], tout[c]).
3. Query x: the point value at tin[x].

Examples → [7, 4], [0, 4, 2, 7], [8, 3, 2, 5]. Checked against recomputing distances on 200 random trees.

Adding each edge weight only at its child node: edges [[1, 2, 1], [2, 3, 1]], update (1, 2) to 5, query 3 → 1 instead of 6.

Time: O((n + q) log n)  
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
