In a grid with your start cell, food cells, free cells and obstacles, return the fewest 4-directional steps to reach any food cell, or −1. For instance, a single row [start, free, food] → 2, and [start, obstacle, food] → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## BFS until food

1. Queue the start with distance 0; mark visited.
2. Pop a cell; if it is food, return its distance.
3. Push free or food neighbours not yet visited; skip obstacles.
4. Return −1 if the queue empties.

Constructed check: `[[start, free, food]]` → 2. `[[start, obstacle, food]]` → −1. With two foods at distances 3 and 1 → 1.

Mark cells when pushing, not when popping, to avoid duplicates. Use the cell symbols the statement defines.

Time: O(m · n)  
Space: O(m · n)

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
