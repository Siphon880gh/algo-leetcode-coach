You get a connected undirected graph with weighted edges, a source s, a destination d and an integer k. You may treat up to k edges as having weight 0. Return the length of the shortest path from s to d. The exact limits are in the official statement. For instance, with edges 0–1 of weight 4, 1–2 of weight 5, 0–3 of weight 10 and 3–2 of weight 1, from 0 to 2: k = 0 → 9, k = 1 → 1, k = 2 → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Layered Dijkstra

1. `dist[(s, 0)] = 0`; heap of (distance, node, used).
2. From (u, j) along edge (u, v, w): relax (v, j) with w, and if `j < k`, relax (v, j + 1) with 0.
3. Return the first popped distance at d.

Constructed checks: the example above → 9, 1, 0. Checked against trying every set of at most k free edges on 200 random small graphs.

Zeroing the heaviest edges of the plain shortest path is not enough: there 0–1–2 costs 9, and freeing its weight-5 edge gives 4 instead of 1 via 0–3–2.

Time: O(k · m log(k · n))  
Space: O(k · n)

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
