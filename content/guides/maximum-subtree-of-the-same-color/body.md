A tree rooted at node 0 is given by its edges, and every node has a color. Return the size of the largest subtree whose nodes all have the same color. Limits are in the official statement. For instance, edges [[0, 1], [0, 2], [2, 3], [2, 4]] with colors [1, 2, 2, 2, 2] → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## DFS

This assumes a subtree means a node together with all of its descendants.

1. dfs(u): size = 1, ok = true; for each child v, `(s, o) = dfs(v)`; size += s; ok = ok and o and color[v] = color[u].
2. If ok, best = max(best, size). Return best.

Constructed checks (run in code): the example above; 800 random trees match testing every node’s subtree directly.

Counting the most common color is not enough: the example has four nodes of color 2, but they do not form one subtree.

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
