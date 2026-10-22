A grid has a start, a destination, empty cells, stones and flooded cells. Each second you move to an adjacent cell, and the flood spreads to adjacent empty cells. You cannot walk through stones or step where the water is. Return the fewest seconds to reach the destination, or −1. Exactly how the moves and the spreading interleave, and which cells the flood can enter, are in the official statement. For instance, in a 1 × 3 row of start, empty, destination with no water, the answer is 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two BFS passes

This assumes water spreads into empty cells and the start but not stones or the destination, and that you may not enter a cell in the same second it floods. Adapt the comparison if the statement differs.

1. Multi-source BFS from the flooded cells: `f[c]` = second when c floods (∞ if never).
2. BFS from the start; step to c at time t + 1 only if `t + 1 < f[c]` and c is not a stone.
3. Return the time at the destination, or −1.

Constructed checks (run in code, against a second-by-second simulation of those rules on 2000 random small grids): the row above → 2; start and two empty cells over water, stone, destination → 3.

Allowing t + 1 = f[c] means entering as the water arrives: in one random grid that gives 3 instead of −1.

Time: O(rows · cols)  
Space: O(rows · cols)

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
