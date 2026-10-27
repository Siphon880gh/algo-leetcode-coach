## Two passes

1. BFS from 0 for parents and depths. Walk `bob → 0` by parents, setting `bt[u] = t` for t = 0, 1, …; every other node gets ∞.
2. BFS or DFS from 0: at depth `t`, gain `amount[u]` if `t < bt[u]`, `amount[u] / 2` if `t = bt[u]`, else 0; add the parent’s total.
3. Return the largest total over the leaves, nodes other than 0 with one neighbour.

Examples → 6, −7280. Checked against a step-by-step simulation of both walks on 300 random trees.

The answer can be negative, so start the maximum below any possible total, as Example 2 shows. Amounts are even, so halving is exact.

Time: O(n)  
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
