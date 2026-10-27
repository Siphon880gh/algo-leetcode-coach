## Rank per season

```sql
WITH s AS (
  SELECT CASE
           WHEN CAST(strftime('%m', sale_date) AS INTEGER) IN (12, 1, 2) THEN 'Winter'
           WHEN CAST(strftime('%m', sale_date) AS INTEGER) IN (3, 4, 5) THEN 'Spring'
           WHEN CAST(strftime('%m', sale_date) AS INTEGER) IN (6, 7, 8) THEN 'Summer'
           ELSE 'Fall'
         END AS season,
         p.category, s.quantity, s.quantity * s.price AS revenue
  FROM sales s
  JOIN products p ON p.product_id = s.product_id
),
t AS (
  SELECT season, category,
         SUM(quantity) AS total_quantity, SUM(revenue) AS total_revenue,
         ROW_NUMBER() OVER (PARTITION BY season
                            ORDER BY SUM(quantity) DESC, SUM(revenue) DESC, category) AS rn
  FROM s
  GROUP BY season, category
)
SELECT season, category, total_quantity, ROUND(total_revenue, 2) AS total_revenue
FROM t
WHERE rn = 1
ORDER BY season;
```

Example (run in SQLite) → Fall Apparel 10 / 120, Spring Kitchen 3 / 54, Summer Tech 5 / 100, Winter Apparel 9 / 110. In MySQL, write MONTH(sale_date) instead of CAST(strftime('%m', sale_date) AS INTEGER).

Breaking the quantity tie by category name before revenue: Summer → Fitness instead of Tech.

Time: O(rows log rows)  
Space: O(rows)

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
