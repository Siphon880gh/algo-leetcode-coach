Given a string `s` and an integer `k`, return whether `s` can become a palindrome by removing at most `k` characters. For instance, `"abca"` with `k = 1` gives true, and `"abcd"` with `k = 2` gives false. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Remove the rest of the LPS

1. `dp[i][j]` = LPS length of `s[i..j]`; `dp[i][i] = 1`.
2. If `s[i] == s[j]`: `dp[i][j] = dp[i + 1][j − 1] + 2`; else `max(dp[i + 1][j], dp[i][j − 1])`.
3. Return `n − dp[0][n − 1] ≤ k`.

Fill `i` from right to left so the inner states are ready; one row of memory per `i` is enough.

`"abcd"`: LPS = 1, so 3 removals are needed, more than 2.

Do not greedily delete one side on a mismatch; the wrong choice can cost more later. Do not compare with `<`; exactly `k` removals is allowed.

Time: O(n²)  
Space: O(n) with rolling rows

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
