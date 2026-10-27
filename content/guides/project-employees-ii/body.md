A project table links projects to employees, and an employee table describes the employees. Report every project that has the largest number of employees, including ties. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Compare with the top count

Using the column names the statement gives:

```sql
SELECT project_id
FROM Project
GROUP BY project_id
HAVING COUNT(*) = (
    SELECT COUNT(*)
    FROM Project
    GROUP BY project_id
    ORDER BY COUNT(*) DESC
    LIMIT 1
);
```

The primary key rules out duplicate rows, so `COUNT(*)` counts employees.

Do not use `ORDER BY … LIMIT 1` on the outer query; it drops tied projects. A window version: rank the grouped counts with `RANK() OVER (ORDER BY COUNT(*) DESC)` and keep rank 1.

Time: O(n) with hashing  
Space: O(projects)

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
