Two tables list the dates on which a daily task failed and the dates on which it succeeded. For the date range in the statement, report each maximal run of consecutive days with the same state, giving the state and the run's first and last dates, ordered by start date. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Date minus row number

Using the column names the statement gives:

```sql
-- @start_date and @end_date stand for the range in the statement.
WITH days AS (
  SELECT fail_date AS d, 'failed' AS state FROM Failed
  UNION ALL
  SELECT success_date, 'succeeded' FROM Succeeded
),
keyed AS (
  SELECT d, state,
         DATE_SUB(d, INTERVAL ROW_NUMBER() OVER (PARTITION BY state ORDER BY d) DAY) AS grp
  FROM days
  WHERE d BETWEEN @start_date AND @end_date
)
SELECT state AS period_state, MIN(d) AS start_date, MAX(d) AS end_date
FROM keyed
GROUP BY state, grp
ORDER BY start_date;
```

Consecutive dates of one state get the same `grp`, because the date and the row number rise together.

Do not filter the range after numbering; numbering must cover only the kept days. Do not number across both states together; each state needs its own sequence.

Time: O(n log n)  
Space: O(n)

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
