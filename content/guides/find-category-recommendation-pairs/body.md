## Distinct first

```sql
WITH uc AS (
  SELECT DISTINCT p.user_id, i.category
  FROM ProductPurchases p
  JOIN ProductInfo i ON i.product_id = p.product_id
)
SELECT a.category AS category1, b.category AS category2,
       COUNT(*) AS customer_count
FROM uc a
JOIN uc b ON a.user_id = b.user_id AND a.category < b.category
GROUP BY a.category, b.category
HAVING COUNT(*) >= 3
ORDER BY customer_count DESC, category1, category2;
```

Example (run in SQLite) → (Books, Clothing), (Books, Electronics), (Clothing, Electronics), (Electronics, Sports), each with 3. The same query runs in MySQL 8.

Joining raw purchases without DISTINCT, so a user with two books counts twice: Books–Clothing → 7 instead of 3.

Time: O(Σ categories per user²)  
Space: O(users · categories)

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
