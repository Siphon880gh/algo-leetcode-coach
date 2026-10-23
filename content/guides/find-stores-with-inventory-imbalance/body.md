## Two ranks

```sql
WITH r AS (
  SELECT store_id, product_name, quantity,
         ROW_NUMBER() OVER (PARTITION BY store_id ORDER BY price DESC) AS hi,
         ROW_NUMBER() OVER (PARTITION BY store_id ORDER BY price) AS lo,
         COUNT(*) OVER (PARTITION BY store_id) AS products
  FROM inventory
),
e AS (SELECT store_id, product_name, quantity FROM r WHERE hi = 1 AND products >= 3),
c AS (SELECT store_id, product_name, quantity FROM r WHERE lo = 1 AND products >= 3)
SELECT s.store_id, s.store_name, s.location,
       e.product_name AS most_exp_product,
       c.product_name AS cheapest_product,
       ROUND(1.0 * c.quantity / e.quantity, 2) AS imbalance_ratio
FROM e
JOIN c ON c.store_id = e.store_id
JOIN stores s ON s.store_id = e.store_id
WHERE e.quantity < c.quantity
ORDER BY imbalance_ratio DESC, s.store_name;
```

Example (run in SQLite) → City Center 40.00, Suburb Mall 25.00, Downtown Tech 10.00. The 1.0 * avoids integer division in SQLite; MySQL’s / already returns a decimal.

Dropping the 3-product rule: Corner Shop 2.50 and Plaza Store 1.50 are added.

Time: O(rows log rows)  
Space: O(rows)

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
