You are given a weighted tree rooted at node 0, described by each node’s parent and the weight of the edge to that parent (the root has none). Choose a set of edges so that no two chosen edges share a node, maximising the total weight; choosing no edges gives 0, so negative edges are never needed. For instance, root 0 with children 1 (weight 5) and 2 (weight 10), and node 2 with children 3 (weight 6) and 4 (weight 4) → 11; a path whose edges weigh −3 and −2 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Free or matched to one child

1. Process nodes children first. `best(c) = max(free[c], used[c])`.
2. `free[u] = Σ best(c)` over children.
3. `used[u] = free[u] + max over c of (free[c] + w(c) − best(c))`, or `free[u]` if no swap is positive.
4. Return `best(0)`.

Constructed checks (verified against every edge subset on 400 random trees): the cases above → 11, 0; the path 0 – 1 – 2 – 3 with weights 4, 3, 5 → 9.

A node can be matched to at most one child, and matching it to c forces c to be free. Process nodes in reverse order of index or with an explicit stack to avoid deep recursion.

Time: O(n)  
Space: O(n)

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
