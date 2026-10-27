## LPS with a crossing pair

1. `s = word1 + word2`, `m = len(word1)`.
2. Standard LPS: `dp[i][j] = dp[i + 1][j − 1] + 2` if `s[i] == s[j]`, else `max(dp[i + 1][j], dp[i][j − 1])`.
3. When `s[i] == s[j]`, `i < m ≤ j`: `best = max(best, dp[i][j])`.

`"cacb", "cbba"` → 5. `"ab", "ab"` → 3. `"aa", "bb"` → 0.

Do not take `dp[0][n − 1]` directly; it may use letters from only one word. Pinning the outermost matched pair across the boundary guarantees both parts are non-empty.

Time: O((m + n)²)  
Space: O((m + n)²)

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
