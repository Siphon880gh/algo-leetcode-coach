## Cover n walls

1. `dp[j]` = cheapest cost to cover j walls, capped at n; `dp[0] = 0`, rest infinity.
2. For each wall i, for j from n down to 1: `dp[j] = min(dp[j], dp[max(0, j − time[i] − 1)] + cost[i])`.
3. Return `dp[n]`.

Examples → 3, 4. Checked against trying every set of paid walls on 300 random small cases.

Cap the index at n: covering more than n walls is as good as n, and without the cap the table needs up to 500 · 501 slots instead of n + 1.

Time: O(n²)  
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
