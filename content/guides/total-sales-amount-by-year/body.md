A product table names products, and a sales table gives, per product, a sales period (start and end dates) and the average daily sales over it. Report each product's total sales amount for each calendar year the period touches, with years limited to those the statement covers. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Overlap days per year

Using the column names the statement gives:

```sql
-- @first_year / @last_year are the years in the statement.
WITH RECURSIVE years AS (
  SELECT @first_year AS y
  UNION ALL
  SELECT y + 1 FROM years WHERE y < @last_year
)
SELECT s.product_id, p.product_name, CAST(y.y AS CHAR) AS report_year,
       (DATEDIFF(LEAST(s.period_end, MAKEDATE(y.y + 1, 1) - INTERVAL 1 DAY),
                 GREATEST(s.period_start, MAKEDATE(y.y, 1))) + 1)
       * s.average_daily_sales AS total_amount
FROM Sales s
JOIN Product p ON p.product_id = s.product_id
JOIN years y ON y.y BETWEEN YEAR(s.period_start) AND YEAR(s.period_end)
ORDER BY s.product_id, report_year;
```

For instance, a period from December 30 to January 2 at 10 per day → 20 in the first year and 20 in the next.

Do not multiply the whole period by the average once; each year needs its own share. Do not forget the `+ 1`; both end dates are included.

Time: O(sales · years)  
Space: O(years)

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
