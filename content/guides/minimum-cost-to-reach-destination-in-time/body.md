## Time-layered relaxation

1. `dp[0][0] = fee[0]`, others ∞.
2. For `t = 0 … maxTime`, for each edge `(u, v, w)` both ways: if `t + w ≤ maxTime`, `dp[t + w][v] = min(…, dp[t][u] + fee[v])`.
3. `min(dp[t][n − 1])`, or −1.

Example 1 → 11. Example 2 → 48. Example 3 → −1.

Plain Dijkstra on cost ignores the time limit, and on time ignores cost. Dijkstra on (cost, time) state with pruning by best time per node also works.

Time: O(maxTime · (n + E))  
Space: O(maxTime · n)

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
