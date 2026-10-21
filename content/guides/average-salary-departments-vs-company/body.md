One table records salary payments per employee with a pay date; another maps employees to departments. For each pay month and department, compare the department's average pay that month with the company-wide average that month, labeling it higher, lower, or the same. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Average per group, compared per row

Using the column names the statement gives:

```sql
WITH t AS (
    SELECT DATE_FORMAT(s.pay_date, '%Y-%m') AS pay_month,
        e.department_id,
        AVG(s.amount) OVER (PARTITION BY DATE_FORMAT(s.pay_date, '%Y-%m'), e.department_id) AS dept_avg,
        AVG(s.amount) OVER (PARTITION BY DATE_FORMAT(s.pay_date, '%Y-%m')) AS company_avg
    FROM Salary AS s
    JOIN Employee AS e ON s.employee_id = e.employee_id
)
SELECT DISTINCT pay_month, department_id,
    CASE
        WHEN dept_avg > company_avg THEN 'higher'
        WHEN dept_avg < company_avg THEN 'lower'
        ELSE 'same'
    END AS comparison
FROM t;
```

Both averages are over payments, so they come from the same joined rows with different partitions. `DISTINCT` collapses the payment rows to one per month and department. Two grouped subqueries (by month, and by month and department) joined on the month give the same answer.

Do not average the department averages to get the company average; departments of different sizes would be weighted equally. Do not group by the full date; the comparison is per month.

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
