## Directions as an index

`dirs = [(0,1), (1,0), (0,−1), (−1,0)]` (north, east, south, west), `d = 0`, `x = y = 0`.

Put every obstacle `(ox, oy)` in a set.

For each command:

- `−2`: `d = (d + 3) % 4` (turn left).
- `−1`: `d = (d + 1) % 4` (turn right).
- `k > 0`: repeat `k` times: if `(x + dx, y + dy)` is an obstacle, stop this command; else move and update `best = max(best, x² + y²)`.

Return `best`.

Each command moves at most 9 squares, so stepping is cheap.

Do not jump `k` squares at once; you would pass through obstacles. Do not return the final distance; the answer is the maximum over the whole walk.

Time: O(commands · 9 + obstacles)  
Space: O(obstacles)

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
