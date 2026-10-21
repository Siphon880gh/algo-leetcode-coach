## Latest change, or 10

```sql
SELECT p.product_id,
       COALESCE(c.new_price, 10) AS price
FROM (SELECT DISTINCT product_id FROM Products) p
LEFT JOIN Products c
  ON c.product_id = p.product_id
 AND c.change_date = (SELECT MAX(change_date)
                      FROM Products
                      WHERE product_id = p.product_id
                        AND change_date <= '2019-08-16');
```

In the example, product 1 → 35 (changed on the date itself), product 2 → 50, product 3 → 10 (first change is later).

Do not filter the date in `WHERE` on the outer query; products with only later changes would vanish. Do not use `<`; a change on the date counts.

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
