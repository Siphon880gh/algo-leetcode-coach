You control a robot in an unknown grid of open cells and walls. You do not see the grid or know where you start (it is open). The API: `move()` returns true and moves if the cell ahead is open, or false and stays; `turnLeft()` and `turnRight()` turn 90°; `clean()` cleans the current cell. Clean every reachable open cell. The grid is up to 100 by 200. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Your own coordinates, explicit backtracking

Call the start `(0, 0)` and the starting direction "up". Keep a visited set of relative coordinates and the current direction index `d` (0 up, 1 right, 2 down, 3 left).

`dfs(x, y, d)`: mark `(x, y)` visited and `clean()`. Then four times: compute the cell ahead `(x + dx[d], y + dy[d])`. If it is not visited and `move()` succeeds, recurse with that cell and direction `d`, then **go back**: `turnRight(); turnRight(); move(); turnRight(); turnRight();` — this returns to `(x, y)` with the same facing as before. Then `turnRight()` and `d = (d + 1) % 4`. After four turns the robot faces its original direction again, which the caller relies on.

The robot must physically return after every branch because the API has no teleport. That is the whole difference from a normal grid DFS.

The Maze (490) gives you the grid. Number of Islands (200) is DFS on a known grid.

Do not forget to restore direction after backing up. Do not rely on absolute coordinates — you do not have them. Do not visit a cell twice; the visited set prevents loops.

Time: O(open cells × 4)  
Space: O(open cells)

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
