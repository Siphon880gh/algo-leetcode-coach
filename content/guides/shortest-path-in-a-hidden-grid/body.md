An interactive problem: a robot sits in an unknown grid and can ask whether it can move in a direction, move in a direction, and check whether its current cell is the target. Return the fewest moves from the start to the target, or −1 if it cannot be reached. For instance, a grid with rows "S.#" and "#.T" (S start, T target, # blocked) → 3, and a single row "S#T" → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Map, then measure

1. Start at relative `(0, 0)`. DFS: if `isTarget`, record the cell. For each direction not yet seen where `canMove` is true: mark it, `move`, recurse, then move back the opposite way.
2. No target recorded → −1.
3. BFS over the marked cells from `(0, 0)`; return the target's distance.

Constructed checks (verified with a simulated grid): `"S.#" / "#.T"` → 3, `"S#T"` → −1, `"ST"` → 1, `"S..." / "##.#" / "T..."` → 6.

Always step back after each recursive call, or the robot's real position drifts away from the DFS state. DFS paths are not shortest; that is why BFS runs afterwards.

Time: O(cells)  
Space: O(cells)

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
