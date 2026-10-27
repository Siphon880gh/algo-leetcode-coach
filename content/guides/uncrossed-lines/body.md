## Recognize LCS

`dp[i][j]` = most lines using `nums1[:i]` and `nums2[:j]`.

- If `nums1[i − 1] == nums2[j − 1]`: `dp[i][j] = dp[i − 1][j − 1] + 1`.
- Else: `dp[i][j] = max(dp[i − 1][j], dp[i][j − 1])`.

Answer: `dp[m][n]`. One row plus a saved diagonal value is enough memory.

Do not greedily connect the first matching pair; an early match can block two later ones. Do not allow a value to connect twice; each index is used at most once, which the table already ensures.

Time: O(m · n)  
Space: O(min(m, n)) with a rolling row

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
