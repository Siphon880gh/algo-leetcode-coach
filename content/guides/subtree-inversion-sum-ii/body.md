You get a tree rooted at node 0 as an edge list, node values nums (some may be negative) and an integer k. Inverting a node multiplies every value in its subtree by −1. Choose any set of nodes to invert, as long as every two chosen nodes are at least k edges apart. Return the largest possible sum of all values. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## DP

1. dp[v][p][d]: best sum of v's subtree when p inversions above are odd (p = 1), with the nearest inversion inside at depth d (k means none closer than k).
2. Invert v: parity flips; every child must have its nearest inversion at depth ≥ k − 1. d = 0.
3. Skip v: merge children one by one, keeping the current minimum m of d_c + 1. Combine only when m + (d_c + 1) ≥ k.
4. Return max over d of dp[0][0][d].

Assumed here: the distance limit applies to every pair of inverted nodes, and two inversions over a node cancel.

Constructed checks (made-up values, run in code): edges [[0, 1], [0, 2], [1, 3], [1, 4]], nums = [2, −6, −4, 1, −3], k = 2 → 14; edges [[0, 1], [1, 2], [1, 3]], nums = [3, −1, −5, −6], k = 3 → 15. Checked against every set of inversions on 600 random trees. If only ancestor–descendant pairs were limited, edges [[0, 1], [0, 2], [0, 3]], nums = [5, −7, −1, −7], k = 4 would give 20 instead of 10.

Treating a node as negative when any ancestor is inverted: edges [[0, 1], [0, 2], [1, 3]], nums = [−8, −8, 2, 2], k = 2 → 12 instead of 16.

Time: O(n · k²)  
Space: O(n · k)

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
