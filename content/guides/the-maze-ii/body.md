`maze` is `m` by `n` (up to 100 each) of 0 and 1, walls around the border. The ball rolls until the next cell is a wall. Return the shortest distance — the number of cells rolled, start excluded and destination included — for the ball to **stop** at `destination`, or −1. The sample from `[0,4]` to `[4,4]` → 12. To `[3,2]` → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Weighted edges, so Dijkstra

From a stop `(i, j)`, roll in each direction counting steps until blocked; that gives a neighbor stop `(x, y)` and an edge weight `steps`. Keep `dist` for every cell, starting at infinity except the start. Pop the smallest distance from a min-heap; skip stale entries; for each roll, relax `dist[x][y]` with `dist[i][j] + steps` and push on improvement. Return `dist[destination]` or −1.

A queue-based version that re-queues a cell whenever its distance improves (what the doocs solution does) also reaches the right answer, but it can process cells many times; Dijkstra bounds the work.

The Maze (490) only asks reachability. The Maze III (499) adds a hole you can drop into mid-roll and lexicographic tie-breaking on the path.

Do not count one step per stop — the weight is the roll length. Do not use plain BFS with a visited set, which assumes equal weights. Do not count the start cell.

Time: O(m n · (m + n) · log(m n)) worst case  
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
