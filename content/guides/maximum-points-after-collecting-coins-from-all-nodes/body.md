## Tree DP

1. `c = coins[u] >> h`.
2. `dp[u][h] = max(c − k + Σ dp[v][h], (c >> 1) + Σ dp[v][min(h + 1, 14)])` over children v.
3. Return dp[0][0]; process nodes in reverse BFS order so deep trees need no recursion.

Examples → 11, 16. Checked against trying every choice per node on 300 random trees.

coins ≤ 10^4 < 2^14 = 16384, so h never needs to go past 14.

Time: O(15n)  
Space: O(15n)

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
