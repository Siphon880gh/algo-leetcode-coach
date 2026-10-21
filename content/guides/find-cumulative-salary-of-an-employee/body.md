A table records each employee's salary for each month they worked. For each employee and each such month except their most recent one, report a running total: that month's salary plus the previous two calendar months, where months not worked count as 0. Order by employee id ascending, then month descending. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Range window by calendar month

Using the column names the statement gives:

```sql
SELECT id, month,
    SUM(salary) OVER (
        PARTITION BY id ORDER BY month
        RANGE BETWEEN 2 PRECEDING AND CURRENT ROW
    ) AS Salary
FROM Employee
WHERE (id, month) NOT IN (
    SELECT id, MAX(month) FROM Employee GROUP BY id
)
ORDER BY id, month DESC;
```

`RANGE` uses month values, not row positions, so a missing month simply adds nothing. Dropping the latest month before the window is safe, because the window only looks backward. A self join on `e2.month BETWEEN e1.month − 2 AND e1.month` works the same way.

Do not use `ROWS 2 PRECEDING`: with a gap it reaches back past the three-month range. Do not drop the latest month of the whole table; drop it per employee.

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
