An employee table maps each employee to a team. Report every employee with the size of the team they belong to. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Window count

Using the column names the statement gives:

```sql
SELECT employee_id,
       COUNT(*) OVER (PARTITION BY team_id) AS team_size
FROM Employee;
```

Without window functions, join a grouped subquery:

```sql
SELECT e.employee_id, t.team_size
FROM Employee e
JOIN (SELECT team_id, COUNT(*) AS team_size
      FROM Employee GROUP BY team_id) t
  ON t.team_id = e.team_id;
```

For instance, employees 1, 2, 3 in team 8 and employee 4 in team 7 give sizes 3, 3, 3, and 1.

Do not `GROUP BY team_id` alone; that returns one row per team, not per employee. Do not count distinct teams; count employees in the team.

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
