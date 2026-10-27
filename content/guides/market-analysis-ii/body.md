Using tables of users (with a favourite brand), orders (with a date, item, buyer, and seller), and items (with a brand), report for every user whether the brand of the second item they sold, by date, is their favourite brand. Users who sold fewer than two items get a no. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Second sale per seller

Using the column names the statement gives:

```sql
WITH ranked AS (
  SELECT seller_id, item_id,
         ROW_NUMBER() OVER (PARTITION BY seller_id ORDER BY order_date) AS rn
  FROM Orders
)
SELECT u.user_id AS seller_id,
       CASE WHEN i.item_brand = u.favorite_brand THEN 'yes' ELSE 'no' END AS answer
FROM Users u
LEFT JOIN ranked r ON r.seller_id = u.user_id AND r.rn = 2
LEFT JOIN Items i ON i.item_id = r.item_id;
```

When there is no second sale, `item_brand` is NULL, the comparison is not true, and the answer falls to no.

Do not filter `rn = 2` in `WHERE`; that drops users with fewer than two sales. Do not rank by order id unless the statement says so; the order is by date.

Time: O(n log n)  
Space: O(n)

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
