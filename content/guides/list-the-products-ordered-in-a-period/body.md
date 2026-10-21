## Month filter plus HAVING

```sql
SELECT p.product_name, SUM(o.unit) AS unit
FROM Orders o
JOIN Products p ON p.product_id = o.product_id
WHERE o.order_date >= '2020-02-01' AND o.order_date < '2020-03-01'
GROUP BY p.product_id, p.product_name
HAVING SUM(o.unit) >= 100;
```

In the example, Leetcode Solutions totals 60 + 70 = 130 and Leetcode Kit 50 + 50 = 100; the March order for the kit is excluded.

Do not put the 100-unit condition in `WHERE`; it applies to the total. Do not use `BETWEEN '2020-02-01' AND '2020-02-29'` on a datetime column; a half-open range is safer.

Time: O(n log n)  
Space: O(products)

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
