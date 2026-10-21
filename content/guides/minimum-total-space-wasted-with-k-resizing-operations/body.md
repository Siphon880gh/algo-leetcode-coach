## Segments at their max

1. `cost[i][j] = max(nums[i..j]) · (j − i + 1) − sum(nums[i..j])` (extend `j` with running max and sum).
2. `dp[0][0] = 0`; `dp[j][s] = min_i dp[i][s − 1] + cost[i][j − 1]`.
3. Return `min over s ≤ k + 1 of dp[n][s]`.

`[10,20], 0` → 10. `[10,20,30], 1` → 10. `[10,20,15,30,20], 2` → 15.

The initial size is free, so k resizes give k + 1 segments. Using fewer resizes is allowed, hence the min over `s`.

Time: O(n² · k)  
Space: O(n² + n · k)

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
