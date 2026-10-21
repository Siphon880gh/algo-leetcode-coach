Boxes (heights) are pushed into a warehouse of rooms (heights) from the left only; a box stops before a room lower than itself, and boxes cannot be stacked. Boxes may be reordered. Return the maximum number of boxes placed. For instance, boxes `[4,3,4,1]` with rooms `[5,3,3,4,1]` → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Effective heights

1. `eff[i] = min(rooms[0..i])`.
2. Sort boxes ascending; `j = 0`.
3. For rooms from the last to the first: if `boxes[j] ≤ eff[i]`, place it, `j += 1`.

Boxes `[4,3,4,1]`, rooms `[5,3,3,4,1]`: eff `[5,3,3,3,1]` → place 1, 3, then 4 at the front → 3.

Do not use raw room heights; a low room blocks everything behind it. Filling the back first with the smallest boxes leaves taller rooms for taller boxes.

Time: O(n log n + m)  
Space: O(m)

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
