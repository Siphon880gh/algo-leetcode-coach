`wall` has 1 to 1e4 rows, each a list of brick widths with the same total (up to 2^31 − 1), and at most 2e4 bricks overall. Draw a vertical line through the wall that crosses the fewest bricks; passing along a brick edge does not count as crossing. The line cannot be on either outer edge. Return the minimum number of crossed bricks. `[[1,2,2,1],[3,1,2],[1,3,2],[2,4],[3,1,2],[1,3,1,1]]` → 2. `[[1],[1],[1]]` → 3.

## Count edges, not bricks

A line at position `x` misses a brick in a row exactly when that row has an edge at `x`. For each row, walk its bricks except the last, and count each running sum in a hash map. If the most common position appears `m` times, the line there crosses `rows − m` bricks.

Widths sum to as much as 2^31 − 1, so iterate over bricks, not over positions.

Do not include the last brick of each row — its end is the outer edge, which is not allowed. Do not scan every x coordinate.

Time: O(total bricks)  
Space: O(distinct edge positions)

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
