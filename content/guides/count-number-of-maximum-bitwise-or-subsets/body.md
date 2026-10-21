## Target is fixed

1. `target = OR of all nums`.
2. `dfs(i, cur)`: at `i == n`, return `cur == target`; else `dfs(i + 1, cur | nums[i]) + dfs(i + 1, cur)`.

Examples → 2, 7, 6.

Adding elements never lowers an OR, so the full array reaches the maximum. A DP map from OR value to subset count is an alternative (for each `x`, add `cnt[v]` to `cnt[v | x]` over a snapshot of the map); with 2^16 subsets plain enumeration is already fast.

Time: O(2^n)  
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
