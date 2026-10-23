## Unbounded knapsack forward

1. dp = [1, 0, …]; coins = [].
2. For i = 1 … n: if numWays[i] = dp[i] + 1, add i to coins and do dp[s] += dp[s − i] for s ≥ i.
3. If numWays[i] ≠ dp[i] now, return [].
4. Return coins.

Examples → [2, 4, 6], [1, 2, 5], []. Checked on 300 random coin sets and their perturbed arrays.

Adding i whenever numWays[i] > dp[i]: example 3 → [1, 2, 3, 5] instead of [].

Time: O(n²)  
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
