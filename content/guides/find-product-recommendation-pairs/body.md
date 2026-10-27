## Self-join

```sql
SELECT a.product_id AS product1_id, b.product_id AS product2_id,
       i1.category AS product1_category, i2.category AS product2_category,
       COUNT(*) AS customer_count
FROM ProductPurchases a
JOIN ProductPurchases b
  ON a.user_id = b.user_id AND a.product_id < b.product_id
JOIN ProductInfo i1 ON i1.product_id = a.product_id
JOIN ProductInfo i2 ON i2.product_id = b.product_id
GROUP BY a.product_id, b.product_id, i1.category, i2.category
HAVING COUNT(*) >= 3
ORDER BY customer_count DESC, product1_id, product2_id;
```

Example (run in SQLite) → (101, 102), (101, 103), (102, 104), each with 3.

Joining on <> instead of <: each pair appears twice, 6 rows instead of 3.

Time: O(Σ products per user²)  
Space: the same

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
