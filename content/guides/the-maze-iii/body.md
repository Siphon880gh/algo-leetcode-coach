`maze` is `m` by `n` (up to 100 each) of 0 and 1, with walls around the border. The ball rolls up, down, left, or right until it hits a wall, and it falls in if it passes over the `hole`. Distance counts cells rolled over. Return the instructions (letters `u`, `d`, `l`, `r`) for the shortest route; on a tie, the lexicographically smallest string; or `"impossible"`. Ball `[4,3]`, hole `[0,1]` in the sample → `"lul"` (both `"lul"` and `"ul"` have distance 6, and `"lul" < "ul"`). Hole `[3,0]` → `"impossible"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Dijkstra with a two-part key

Nodes are stopping cells (plus the hole). From a stop, roll in each direction: move while the next cell is open, counting steps, and **stop immediately if you are on the hole**. The edge weight is the number of cells rolled, and the edge label is that direction's letter.

Use a priority queue keyed by `(distance, path)`. Pop the smallest; if it is the hole, return its path. For each roll to `(x, y)` with new distance `d'` and path `p + letter`, push it if `(d', p')` beats the best known for `(x, y)`. Comparing tuples gives shortest distance first, then smallest string.

BFS without a priority queue is wrong here because rolls have different lengths.

The Maze (490) asks only whether you can stop at a cell. The Maze II (505) wants the shortest distance with no hole and no path string.

Do not roll past the hole. Do not keep only the distance — two routes with the same distance can differ in string order. Do not stop a roll one cell early; it goes until the next cell is a wall.

Time: O(m n · (m + n) · log(m n)) roughly (path strings add their length to comparisons)  
Space: O(m n)

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
