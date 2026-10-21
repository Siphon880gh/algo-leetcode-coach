## Match or skip

`dp[i][j]` for `0 ≤ i ≤ m`, `0 ≤ j ≤ n`, with row and column 0 equal to 0.

- If `text1[i − 1] == text2[j − 1]`: `dp[i][j] = dp[i − 1][j − 1] + 1`.
- Else: `dp[i][j] = max(dp[i − 1][j], dp[i][j − 1])`.

Answer: `dp[m][n]`.

Only the previous row is needed; keep one row and a saved diagonal value for O(min(m, n)) memory.

Do not match greedily on the first equal letters; a later match may be longer. Do not confuse this with longest common substring, which resets to 0 on a mismatch.

Time: O(m · n)  
Space: O(min(m, n)) with a rolling row

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
