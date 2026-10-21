An interactive problem: a robot in an unknown grid can ask whether it can move in a direction, move (which returns the cost of the cell it enters), and check whether it is on the target. Return the minimum total of the entry costs along a route to the target, or −1 if it is unreachable. For instance, in the grid [[1,2,3],[blocked,1,5]] from the top-left to the bottom-right, the cheapest route costs 2 + 1 + 5 = 8. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Map, then weigh

1. DFS from relative `(0, 0)`: for each unseen direction with `canMove`, `cost[next] = move(d)`, recurse, move back.
2. No target found → −1.
3. Dijkstra from `(0, 0)` with edge weight `cost[next]`.

Constructed checks (verified with a simulated grid): the example above → 8; `[[1, blocked, 3]]` → −1; `[[9,1],[1,9]]` to the opposite corner → 10.

Plain BFS is wrong here: costs differ per cell. The DFS move back returns the cost of the cell you came from; ignore it.

Time: O(cells log cells)  
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
