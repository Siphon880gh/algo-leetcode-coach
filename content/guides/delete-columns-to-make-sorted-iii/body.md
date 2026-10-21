## LIS where "≤" checks every row

`dp[j]` = the most columns you can keep ending with column `j`.

For each `j`, `dp[j] = 1`; for each `i < j`:

- If `all(row[i] ≤ row[j] for row in strs)`, `dp[j] = max(dp[j], dp[i] + 1)`.

Return `m − max(dp)`.

Here each row must be sorted on its own, unlike part II, where rows are compared with each other.

Do not keep columns greedily; an early column can block a longer chain. Do not compare only the first row; all rows must agree.

Time: O(m² · n)  
Space: O(m)

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
