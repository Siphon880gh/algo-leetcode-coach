With the same product and sales tables, report the buyers who bought one named product but never another. From memory, the statement uses an S8 phone and an iPhone; check the exact names there. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Conditional counts per buyer

Using the column names the statement gives:

```sql
SELECT s.buyer_id
FROM Sales s
JOIN Product p ON s.product_id = p.product_id
GROUP BY s.buyer_id
HAVING SUM(p.product_name = 'S8') > 0
   AND SUM(p.product_name = 'iPhone') = 0;
```

In MySQL a comparison is 1 or 0, so `SUM(...)` counts matching rows. In other engines, write `SUM(CASE WHEN … THEN 1 ELSE 0 END)`.

Do not filter rows with `WHERE product_name = 'S8'` first; that hides the iPhone purchases you need to exclude. `NOT IN` with a subquery of iPhone buyers also works.

Time: O(n) with hashing  
Space: O(buyers)

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
