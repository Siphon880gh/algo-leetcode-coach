## Longest common substring

`dp[i][j] = dp[i − 1][j − 1] + 1` if `nums1[i − 1] == nums2[j − 1]`, else `0`. Track the maximum.

A mismatch resets to 0, because the subarray must be contiguous; that is what separates this from LCS.

Space can drop to one row: iterate `j` **backward** so `dp[j − 1]` still holds the previous row's value.

Faster: binary search the length `L`, and check for a common subarray of length `L` with rolling hashes of every window in both arrays. That gives O((m + n) log min(m, n)) expected time.

Do not use the LCS recurrence `max(dp[i − 1][j], dp[i][j − 1])`; that allows gaps. Do not iterate `j` forward in the one-row version.

Time: O(m · n)  
Space: O(min(m, n)) with one row

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
