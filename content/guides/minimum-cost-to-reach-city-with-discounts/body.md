There are n cities numbered 0 to n − 1 and a list of highways, each connecting two cities in both directions with a toll. You also have a number of discounts; using one on a highway lets you pay toll / 2 (integer division) for that highway. Each discount can be used once and at most one per highway. Return the minimum total cost from city 0 to city n − 1, or −1 if it cannot be reached. For instance, n = 5, highways 0-1 (4), 2-1 (3), 1-4 (11), 3-2 (3), 3-4 (2) with 1 discount → 9; n = 4, highways 1-3 (17), 1-2 (7), 3-2 (5), 0-1 (6), 3-0 (20) with 20 discounts → 8; n = 4, highways 0-1 (3), 2-3 (2) with 0 discounts → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Layered graph

1. `dist[(0, 0)] = 0`; min-heap of `(cost, city, used)`.
2. Pop; if `city == n − 1`, return `cost`.
3. For each highway `(city, v, toll)`: push `(cost + toll, v, used)`, and if `used < discounts`, `(cost + toll // 2, v, used + 1)`.
4. Return −1.

Constructed checks (verified against every simple path and discount choice on random graphs): the three cases above → 9, 8, −1.

Copying the graph once per discount count turns the choice into an ordinary shortest path. Tolls are non-negative, so Dijkstra applies and the optimum never repeats a city.

Time: O((n · d + E · d) log(n · d))  
Space: O(n · d)

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
