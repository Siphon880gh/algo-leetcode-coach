## Length by (end, difference)

`dp[j][d]` = length of the longest arithmetic subsequence ending at `j` with difference `d`.

For each `j`, for each `i < j`:

- `d = nums[j] − nums[i]`.
- `dp[j][d] = dp[i].get(d, 1) + 1` (a lone `nums[i]` counts as length 1).
- `ans = max(ans, dp[j][d])`.

Values are at most 500, so `d` lies in [−500, 500]; an array of 1001 slots per index works instead of a map.

Do not fix the difference first and scan for each one separately unless you bound the differences; the pairwise DP covers them all at once. Do not start a new pair at length 1; a pair already has length 2.

Time: O(n²)  
Space: O(n · range)

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
