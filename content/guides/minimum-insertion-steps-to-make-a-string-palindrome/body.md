## Interval DP

1. `dp[i][j]` = insertions for `s[i..j]`; `dp[i][i] = 0`.
2. If `s[i] == s[j]`: `dp[i][j] = dp[i + 1][j − 1]`; else `1 + min(dp[i + 1][j], dp[i][j − 1])`.
3. Return `dp[0][n − 1]`, which equals `n − LPS`.

`"zzazz"` → 0. `"mbadm"` → 2. `"leetcode"` → 5.

Do not count mismatched mirror pairs; insertions can realign the string. Do not fill `dp` in the wrong order; go by increasing length or `i` from the end.

Time: O(n²)  
Space: O(n²), or O(n) with rolling rows

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
