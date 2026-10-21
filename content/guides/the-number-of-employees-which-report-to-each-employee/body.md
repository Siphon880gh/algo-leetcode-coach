## Manager ← reports

1. `FROM Employees m JOIN Employees e ON e.reports_to = m.employee_id`.
2. `SELECT m.employee_id, m.name, COUNT(*) AS reports_count, ROUND(AVG(e.age)) AS average_age`
3. `GROUP BY m.employee_id, m.name ORDER BY m.employee_id`.

Example 1: Hercy has Alice (41) and Bob (36) → 2 reports, average 38.5 → 39.

The inner join keeps only real managers. MySQL `ROUND` on the exact decimal from `AVG` rounds 38.5 up; a float average could round differently in other engines.

Time: O(rows)  
Space: O(managers)

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
