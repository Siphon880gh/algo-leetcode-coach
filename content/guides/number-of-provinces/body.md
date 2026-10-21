`isConnected` is an `n` by `n` symmetric 0/1 matrix (`n` up to 200) with 1s on the diagonal. `isConnected[i][j] = 1` means cities `i` and `j` are directly connected. A province is a group of cities connected directly or indirectly. Count provinces. `[[1,1,0],[1,1,0],[0,0,1]]` → 2. `[[1,0,0],[0,1,0],[0,0,1]]` → 3.

## Components

**DFS:** keep `visited`. For each city `i` not visited, count one province and DFS: mark `i`, and for each `j` with `isConnected[i][j] == 1` and not visited, recurse. The matrix row is the adjacency list.

**Union-find:** start with `n` components. For each `i < j` with a 1, union them; each successful union (different roots) lowers the count by one. Path compression keeps finds fast.

Number of Islands (200) counts components on a grid instead of a matrix graph.

Do not treat the matrix as a grid of islands — cell `(i, j)` is an edge, not a land square. Do not count 1s; connected cities share a province even without a direct edge.

Time: O(n²)  
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
