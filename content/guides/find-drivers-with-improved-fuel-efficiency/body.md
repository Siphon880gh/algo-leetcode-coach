## Conditional averages

```sql
WITH h AS (
  SELECT driver_id,
         AVG(CASE WHEN CAST(strftime('%m', trip_date) AS INTEGER) <= 6 THEN distance_km / fuel_consumed END) AS first_avg,
         AVG(CASE WHEN CAST(strftime('%m', trip_date) AS INTEGER) >= 7 THEN distance_km / fuel_consumed END) AS second_avg
  FROM trips
  GROUP BY driver_id
)
SELECT d.driver_id, d.driver_name,
       ROUND(h.first_avg, 2) AS first_half_avg,
       ROUND(h.second_avg, 2) AS second_half_avg,
       ROUND(h.second_avg - h.first_avg, 2) AS efficiency_improvement
FROM h
JOIN drivers d ON d.driver_id = h.driver_id
WHERE h.first_avg IS NOT NULL AND h.second_avg IS NOT NULL
  AND h.second_avg > h.first_avg
ORDER BY efficiency_improvement DESC, d.driver_name;
```

Example (run in SQLite) → Bob Smith 11.24, 13.33, 2.10; Alice Johnson 11.97, 14.02, 2.05. In MySQL, use MONTH(trip_date) instead of the strftime cast; SQLite shows 2.10 as 2.1.

Rounding the averages before subtracting: Bob Smith gets 2.09 instead of 2.10.

Time: O(trips log trips)  
Space: O(drivers)

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
