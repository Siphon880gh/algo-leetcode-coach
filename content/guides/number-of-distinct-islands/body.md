Given a binary grid, count the islands (4-directionally connected groups of 1s) whose shapes are different. Two islands count as the same if one can be moved onto the other by translation only, without rotating or reflecting. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Normalize by the starting cell

Scan the grid in row-major order. When you hit an unvisited 1, flood-fill its island and record `(r − r0, c − c0)` for each cell, where `(r0, c0)` is the cell where the island was found.

Because every island is found at its top-left-most cell (first in scan order) and the DFS visits neighbors in a fixed order, two translated copies produce the same offset list. Store it as a tuple (or sort it first to be safe) in a set.

An alternative signature is the DFS path: append the direction taken on entering each cell and a "back" marker on leaving. The back markers are required, or different shapes can give the same direction string.

Do not record absolute coordinates; that makes every island unique. Do not drop the back markers in the path version.

Time: O(m · n)  
Space: O(m · n)

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
