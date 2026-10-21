## Count edges, subtract shared ones

Each land cell has 4 sides. When two land cells touch, the side between them is not perimeter, and it was counted twice (once per cell). So: perimeter = `4 × land − 2 × shared`, where `shared` counts each touching pair once. Walk every cell; for land, add 4, and subtract 2 if the cell below is land and 2 if the cell to the right is land. Checking only down and right counts each pair once.

Alternative: for every land cell, add 1 for each of its four neighbors that is water or off the grid.

A DFS from one land cell works too, but it is not needed — the formula touches each cell once with no recursion. Number of Islands (200) counts islands; Max Area of Island (695) sums area.

Do not subtract 1 per shared side (each shared side removes 2). Do not look in all four directions and also subtract 2 — that counts each pair twice.

Time: O(row × col)  
Space: O(1)

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
