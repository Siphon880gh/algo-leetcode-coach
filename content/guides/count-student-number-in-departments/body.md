One table lists students with their department; another lists departments. Report every department's name with its number of students, including departments with none, ordered by that count descending and then by name. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Every department, even the empty ones

Using the column names the statement gives:

```sql
SELECT d.dept_name, COUNT(s.student_id) AS student_number
FROM Department AS d
LEFT JOIN Student AS s ON d.dept_id = s.dept_id
GROUP BY d.dept_id, d.dept_name
ORDER BY student_number DESC, d.dept_name;
```

Start from `Department` so a department with no students still has one row, with `NULL` student columns. `COUNT(s.student_id)` skips nulls and gives 0 there.

Do not use `COUNT(*)`; it counts the null row and reports 1 for an empty department. Do not start from `Student`, which loses the empty departments.

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
