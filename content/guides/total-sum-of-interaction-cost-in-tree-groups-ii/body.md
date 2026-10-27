You get a tree with n nodes (given as an edge list, rooted at node 0) and a group label for every node. Two nodes are in the same group when their labels match, and the cost of a pair is the number of edges between them. Return the total cost over all unordered pairs in the same group. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Small-to-large

1. total[g] = size of each group. f(g, c) = c · (total[g] − c).
2. Post-order. Each node starts with {group: 1} and S = f(group, 1).
3. Merge each child's map into the larger one. For each moved (g, c2) with c1 already there: S += f(g, c1 + c2) − f(g, c1) − f(g, c2). The merged S also adds the child's S.
4. Add S for every node except the root.

Constructed checks (made-up values, run in code): n = 5, edges [[0, 1], [0, 2], [1, 3], [2, 4]], group = [1, 2, 2, 1, 1] → 10; n = 4, edges [[0, 1], [1, 2], [1, 3]], all in one group → 9. Matched BFS from every node on 1,500 random trees. n = 10^5 ran in 0.2 s, and the total can pass 10^14, so use 64-bit integers.

Adding |depth[u] − depth[v]| for each pair: the first check → 4 instead of 10.

Time: O(n log n)  
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
