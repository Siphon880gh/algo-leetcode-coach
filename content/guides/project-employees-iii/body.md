A project table links projects to employees, and an employee table records each employee's years of experience. For every project, report the most experienced employee or employees on it, including ties. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Rank inside each project

Using the column names the statement gives:

```sql
SELECT project_id, employee_id
FROM (
    SELECT p.project_id, p.employee_id,
           RANK() OVER (PARTITION BY p.project_id ORDER BY e.experience_years DESC) AS rnk
    FROM Project p
    JOIN Employee e ON p.employee_id = e.employee_id
) t
WHERE rnk = 1;
```

`RANK` gives tied employees the same rank, so all of them stay.

Do not use `ROW_NUMBER`; it keeps one employee per project. Without window functions, join each project to its `MAX(experience_years)` from a grouped subquery and match on both columns.

Time: O(n log n) for the partition sort  
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
