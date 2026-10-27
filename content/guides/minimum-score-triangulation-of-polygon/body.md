## Fix the edge, choose the apex

`dp[i][j]` = least score to triangulate vertices `i..j` (0 when `j − i < 2`).

For lengths from 3 up to `n`, for each `i` with `j = i + len − 1`:

`dp[i][j] = min over i < k < j of dp[i][k] + dp[k][j] + v[i] · v[k] · v[j]`.

Answer: `dp[0][n − 1]`.

Fill by increasing length so the smaller ranges are ready.

Do not greedily cut the smallest triangle first; local choices do not combine into the best total. Do not forget the base case of two adjacent vertices costing 0.

Time: O(n³)  
Space: O(n²)

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
