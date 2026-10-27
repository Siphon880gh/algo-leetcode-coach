## Three conditional counts

```sql
SELECT 'Low Salary' AS category, SUM(income < 20000) AS accounts_count FROM Accounts
UNION ALL
SELECT 'Average Salary', SUM(income BETWEEN 20000 AND 50000) FROM Accounts
UNION ALL
SELECT 'High Salary', SUM(income > 50000) FROM Accounts;
```

Example → Low 1, Average 0, High 3 (run in SQLite).

`BETWEEN` is inclusive, matching [20000, 50000]. `SUM` over a comparison counts matches in MySQL; elsewhere use `SUM(CASE WHEN … THEN 1 ELSE 0 END)`. Note that an empty table would give NULL sums; wrap in `COALESCE` if that matters.

Time: O(n)  
Space: O(1)

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
