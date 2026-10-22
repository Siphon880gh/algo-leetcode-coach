## Prefix-sum DP

1. dp[v] = 1 for v ≤ nums[0].
2. new[v] = prefix(dp)[min(v, v − nums[i] + nums[i − 1])], 0 if negative.
3. Return the sum mod 10^9 + 7.

Examples → 4, 126.

Summing over u directly is O(n · max²) = 2000 · 1000² = 2 · 10^9 steps.

Time: O(n · max) = 2 · 10^6  
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
