## 26 counters per node

1. Kahn's queue from in-degree-0 nodes.
2. Pop `u`: `dp[u][colour(u)] += 1`; update the answer with `max(dp[u])`.
3. For each edge `u → v`: `dp[v][c] = max(dp[v][c], dp[u][c])` for all 26 colours; decrement in-degree.
4. Fewer than n nodes popped → cycle → −1.

`"abaca"` example → 3. `"a"` with a self-loop → −1.

Self-loops count as cycles. Do not run a DFS per colour; one topological pass handles all 26 at once.

Time: O(26 · (n + m))  
Space: O(26 · n)

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
