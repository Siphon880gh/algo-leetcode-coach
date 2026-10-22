## Prefix-sum DP

1. dp[v] = 1 for v ≤ nums[0].
2. For each i: new[v] = prefix(dp)[min(v, v − nums[i] + nums[i − 1])] for v ≤ nums[i], or 0 if that bound is negative.
3. Return the sum mod 10^9 + 7.

Examples → 4, 126. Checked against every arr1 on 200 random small arrays.

Enforcing only u ≤ v lets arr2 rise: example 1 → 10 instead of 4.

Time: O(n · max)  
Space: O(max)

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
