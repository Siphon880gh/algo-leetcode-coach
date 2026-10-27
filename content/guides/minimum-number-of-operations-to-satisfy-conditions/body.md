## Column DP

1. cost[j][v] = m − (cells in column j equal to v), v = 0 … 9 (ten values always leave a choice).
2. dp[v] = cost[0][v]; then dp’[v] = cost[j][v] + min_{u ≠ v} dp[u].
3. Return min dp.

Examples → 0, 3, 2. Checked against trying every column assignment on 600 random small grids.

Greedy per column fails: picking the cheapest value that differs from the previous column gives [[0, 1, 1], [0, 1, 1], [0, 0, 1]] → 4 instead of 3.

Time: O(m n + 100 n)  
Space: O(10 n)

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
