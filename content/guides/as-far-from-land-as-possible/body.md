## Expand from every land cell

1. Push all land cells. If there are none or every cell is land, return −1.
2. BFS: pop a cell, and for each water neighbour set `dist = dist + 1`, mark it land, and push it.
3. Return the distance of the last cell set.

`[[1,0,1],[0,0,0],[1,0,1]]` → 2. `[[1,0,0],[0,0,0],[0,0,0]]` → 4.

Moving one step at a time on the grid gives Manhattan distance, so BFS layers are exact.

Do not BFS from each water cell; that is O(n⁴). Do not forget the −1 cases.

Time: O(n²)  
Space: O(n²)

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
