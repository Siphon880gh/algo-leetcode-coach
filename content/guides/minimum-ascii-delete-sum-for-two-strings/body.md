## Edit distance with deletions only

`dp[i][j]` for suffixes:

- `dp[n1][j]` = the ASCII sum of `s2[j:]`; `dp[i][n2]` = the ASCII sum of `s1[i:]`.
- `s1[i] == s2[j]` → `dp[i][j] = dp[i + 1][j + 1]`.
- Otherwise → `min(ord(s1[i]) + dp[i + 1][j], ord(s2[j]) + dp[i][j + 1])`.

Equivalent view: find the common subsequence with the largest ASCII sum `K`. The answer is `sum(s1) + sum(s2) − 2K`.

One row suffices if you sweep carefully, giving O(min(n1, n2)) space.

Do not use the plain LCS length; the longest common subsequence is not always the most valuable one. Do not forget the base rows; deleting the rest of the other string costs its full ASCII sum.

Time: O(n1 · n2)  
Space: O(n1 · n2), or one row

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
