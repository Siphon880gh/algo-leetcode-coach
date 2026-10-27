## One GROUP BY

```sql
SELECT customer_id,
       COUNT(*) AS total_orders,
       CAST(ROUND(100.0 * SUM(CASE WHEN time(order_timestamp) BETWEEN '11:00:00' AND '14:00:00'
                                     OR time(order_timestamp) BETWEEN '18:00:00' AND '21:00:00' THEN 1 ELSE 0 END) / COUNT(*)) AS INTEGER) AS peak_hour_percentage,
       ROUND(AVG(order_rating), 2) AS average_rating
FROM restaurant_orders
GROUP BY customer_id
HAVING COUNT(*) >= 3
   AND 100.0 * SUM(CASE WHEN time(order_timestamp) BETWEEN '11:00:00' AND '14:00:00'
                         OR time(order_timestamp) BETWEEN '18:00:00' AND '21:00:00' THEN 1 ELSE 0 END) / COUNT(*) >= 60
   AND ROUND(AVG(order_rating), 2) >= 4.0
   AND 1.0 * COUNT(order_rating) / COUNT(*) >= 0.5
ORDER BY average_rating DESC, customer_id DESC;
```

Example (run in SQLite) → 103 (3, 100, 4.67), 101 (4, 100, 4.67), 105 (3, 100, 4.33). This counts both ends of each peak window as peak, an assumption, since the statement writes the windows as 11:00 - 14:00 and 18:00 - 21:00. AVG and COUNT(order_rating) skip NULL ratings. In MySQL, TIME(order_timestamp) and ROUND work the same way.

Counting unrated orders as 0: customer 101 averages 3.5 and drops out.

Time: O(rows)  
Space: O(customers)

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
