A visits table records a user's visit on a date, and a transactions table records each transaction a user made on a date. For every k from 0 up to the largest number of transactions in one visit, report how many visits had exactly k transactions, including k values with zero visits. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count, then fill the gaps

Using the column names the statement gives:

```sql
WITH RECURSIVE per_visit AS (
  SELECT v.user_id, v.visit_date, COUNT(t.transaction_date) AS cnt
  FROM Visits v
  LEFT JOIN Transactions t
    ON t.user_id = v.user_id AND t.transaction_date = v.visit_date
  GROUP BY v.user_id, v.visit_date
), nums AS (
  SELECT 0 AS k
  UNION ALL
  SELECT k + 1 FROM nums WHERE k < (SELECT MAX(cnt) FROM per_visit)
)
SELECT n.k AS transactions_count, COUNT(p.cnt) AS visits_count
FROM nums n
LEFT JOIN per_visit p ON p.cnt = n.k
GROUP BY n.k
ORDER BY n.k;
```

For instance, visits with 0, 0, 1, and 3 transactions give rows `0→2`, `1→1`, `2→0`, `3→1`.

Do not start from transactions; visits without any would disappear. Do not skip the series; a count such as 2 with no visits must still appear with 0.

Time: O(n log n)  
Space: O(n)

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
