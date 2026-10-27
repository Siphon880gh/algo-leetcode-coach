## Low-link test

1. Build the adjacency list.
2. DFS from 0 with a timer: `disc[u] = low[u] = t++`.
3. For each neighbour `v` other than the edge back to the parent:
   - Unvisited: recurse, then `low[u] = min(low[u], low[v])`; if `low[v] > disc[u]`, add `[u, v]`.
   - Visited: `low[u] = min(low[u], disc[v])`.

`n = 4`, `[[0,1],[1,2],[2,0],[1,3]]` → `[[1,3]]`.

Do not remove each edge and test connectivity; that is O(E · (V + E)). Do not skip only the parent node when there can be parallel edges; skip the parent edge. Use an iterative DFS or raise the recursion limit for 10⁵ nodes.

Time: O(V + E)  
Space: O(V + E)

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
