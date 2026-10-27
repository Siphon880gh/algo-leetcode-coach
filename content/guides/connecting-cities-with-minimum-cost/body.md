There are `n` cities labeled 1 to `n` and a list of possible connections `[x, y, cost]`, each joining two cities in both directions. Return the minimum total cost to connect every city, or −1 if that is impossible. For instance, `n = 3` with `[[1,2,5],[1,3,6],[2,3,1]]` costs 6 (edges 2–3 and 1–2), while `n = 4` with `[[1,2,3],[3,4,4]]` gives −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Cheapest edges that join components

1. Sort `connections` by cost.
2. Union-find over cities 1 to `n`; `total = 0`, `used = 0`.
3. For each `[x, y, c]`: if `x` and `y` have different roots, union them, `total += c`, `used += 1`; stop when `used == n − 1`.
4. Return `total` if `used == n − 1`, else −1.

Prim's algorithm with a heap gives the same total.

Do not take each city's cheapest edge alone; that can leave separate groups. Do not forget the −1 case when the graph is disconnected.

Time: O(E log E)  
Space: O(n)

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
