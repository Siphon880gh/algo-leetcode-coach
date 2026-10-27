An employee table lists each employee's company and salary. For each company, return the rows holding the median salary: the middle row for an odd count, the two middle rows for an even count, sorting by salary and then by id. For instance, salaries 10, 20, 30, 40 give the 20 and 30 rows. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Rank inside each company

Using the column names the statement gives:

```sql
WITH t AS (
    SELECT *,
        ROW_NUMBER() OVER (PARTITION BY company ORDER BY salary, id) AS rk,
        COUNT(*) OVER (PARTITION BY company) AS n
    FROM Employee
)
SELECT id, company, salary
FROM t
WHERE rk >= n / 2 AND rk <= n / 2 + 1;
```

With real division, the median positions are exactly those with `n/2 ≤ rk ≤ n/2 + 1`. For `n = 5` that keeps only `rk = 3` (2.5 to 3.5). For `n = 4` it keeps 2 and 3.

Do not use `RANK()` or `DENSE_RANK()`: tied salaries would share a rank and break the position math. Do not average the two middle salaries; the problem asks for the rows.

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
