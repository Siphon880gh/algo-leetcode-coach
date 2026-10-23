## Pivot the newest three

```sql
WITH r AS (
  SELECT employee_id, rating,
         ROW_NUMBER() OVER (PARTITION BY employee_id ORDER BY review_date DESC) AS rn
  FROM performance_reviews
),
last3 AS (
  SELECT employee_id,
         MAX(CASE WHEN rn = 1 THEN rating END) AS r1,
         MAX(CASE WHEN rn = 2 THEN rating END) AS r2,
         MAX(CASE WHEN rn = 3 THEN rating END) AS r3
  FROM r
  WHERE rn <= 3
  GROUP BY employee_id
)
SELECT e.employee_id, e.name, l.r1 - l.r3 AS improvement_score
FROM last3 l
JOIN employees e ON e.employee_id = l.employee_id
WHERE l.r3 IS NOT NULL AND l.r3 < l.r2 AND l.r2 < l.r1
ORDER BY improvement_score DESC, e.name;
```

Example (run in SQLite) → Bob Smith 3, Alice Johnson 2, Carol Davis 2. The same query runs in MySQL 8.

Allowing equal ratings (≤): David Wilson is added with 0.

Time: O(reviews log reviews)  
Space: O(reviews)

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
