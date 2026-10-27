## Suffix DP

1. `lcp[i][j]` = length of the common prefix of the suffixes at `i` and `j`: `lcp[i + 1][j + 1] + 1` if `s[i] = s[j]`, else 0, filled from the end.
2. For `i = n − 1 … 0`: `dp[i] = 1`; for each `j` with `i + 2j ≤ n` and `lcp[i][i + j] ≥ j`, `dp[i] = max(dp[i], 1 + dp[i + j])`.
3. Return `dp[0]`.

Examples → 2, 4, 5. Checked against trying every sequence of deletions on 300 random strings.

Greedily deleting the shortest repeat is not always best: bbaabbaa gives 2 that way instead of 3. So try every j. The table has 4000² = 1.6 · 10^7 entries; use small integers or keep only the row below to save memory.

Time: O(n²)  
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
