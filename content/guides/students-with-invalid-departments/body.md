A departments table lists valid departments, and a students table gives each student a department id. Report the students whose department id does not exist in the departments table. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Keep the unmatched

Using the column names the statement gives:

```sql
SELECT s.id, s.name
FROM Students s
LEFT JOIN Departments d ON d.id = s.department_id
WHERE d.id IS NULL;
```

For instance, with departments 1 and 7, students in departments 1, 7, and 14 → only the student in 14.

Do not use an inner join; it drops exactly the rows you want. Do not use `NOT IN` against a column that can hold NULL; one NULL makes it match nothing.

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
