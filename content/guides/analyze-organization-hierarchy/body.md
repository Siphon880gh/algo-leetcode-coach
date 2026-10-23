## Levels and subtrees

```sql
WITH RECURSIVE lv(employee_id, level) AS (
  SELECT employee_id, 1 FROM Employees WHERE manager_id IS NULL
  UNION ALL
  SELECT e.employee_id, lv.level + 1
  FROM Employees e JOIN lv ON e.manager_id = lv.employee_id
),
sub(boss, emp) AS (
  SELECT employee_id, employee_id FROM Employees
  UNION ALL
  SELECT sub.boss, e.employee_id
  FROM sub JOIN Employees e ON e.manager_id = sub.emp
)
SELECT e.employee_id, e.employee_name, lv.level,
       COUNT(*) - 1 AS team_size, SUM(x.salary) AS budget
FROM Employees e
JOIN lv ON lv.employee_id = e.employee_id
JOIN sub ON sub.boss = e.employee_id
JOIN Employees x ON x.employee_id = sub.emp
GROUP BY e.employee_id, e.employee_name, lv.level
ORDER BY lv.level, budget DESC, e.employee_name;
```

Example (run in SQLite) → the official output, Alice (1, 9, 84500) first.

Counting only direct reports: Alice’s team_size → 2 instead of 9.

Time: O(n · depth)  
Space: O(n · depth)

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
