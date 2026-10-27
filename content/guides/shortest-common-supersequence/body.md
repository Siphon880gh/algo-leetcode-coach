## Build from the LCS table

1. `dp[i][j]` = LCS length of `s1[:i]` and `s2[:j]`.
2. From `i = m`, `j = n`, while both are positive:
   - If `s1[i − 1] == s2[j − 1]`: emit it, `i −= 1`, `j −= 1`.
   - Else if `dp[i − 1][j] ≥ dp[i][j − 1]`: emit `s1[i − 1]`, `i −= 1`.
   - Else emit `s2[j − 1]`, `j −= 1`.
3. Emit the rest of whichever string remains, then reverse.

The result has length `m + n − LCS`, the minimum possible.

Do not just merge the strings greedily; without the LCS you may duplicate shared letters. Do not store whole strings in the table; lengths are enough and the walk-back rebuilds the answer.

Time: O(m · n)  
Space: O(m · n)

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
