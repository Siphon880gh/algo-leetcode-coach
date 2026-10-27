## House robber with a count

1. `n = len / 3`.
2. For a line `a`: `dp[i][j] = max(dp[i + 1][j], a[i] + dp[i + 2][j − 1])`, the best sum choosing `j` non-adjacent from `a[i:]`.
3. Return `max(best(slices[1:]), best(slices[:−1]))`.

`[1,2,3,4,5,6]` → 10. `[8,9,8,6,1,1]` → 16.

Do not simulate the friends' picks; any non-adjacent set of n slices is achievable. Do not run one linear DP on the whole circle; the first and last slices are adjacent.

Time: O(len · n)  
Space: O(len · n)

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
