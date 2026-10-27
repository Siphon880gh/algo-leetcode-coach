## Week buckets

```sql
WITH w AS (
  SELECT employee_id,
         date(meeting_date, '-' || ((CAST(strftime('%w', meeting_date) AS INTEGER) + 6) % 7) || ' days') AS week_start,
         SUM(duration_hours) AS hours
  FROM meetings
  GROUP BY employee_id, week_start
)
SELECT e.employee_id, e.employee_name, e.department, COUNT(*) AS meeting_heavy_weeks
FROM w
JOIN employees e ON e.employee_id = w.employee_id
WHERE w.hours > 20
GROUP BY e.employee_id, e.employee_name, e.department
HAVING COUNT(*) >= 2
ORDER BY meeting_heavy_weeks DESC, e.employee_name;
```

Example (run in SQLite) → Alice Johnson 2, David Wilson 2. In MySQL, use DATE_SUB(meeting_date, INTERVAL WEEKDAY(meeting_date) DAY) for week_start.

Keeping employees with one heavy week: Bob Smith is added with 1.

Time: O(meetings log meetings)  
Space: O(meetings)

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
