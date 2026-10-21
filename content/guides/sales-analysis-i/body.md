A product table lists products, and a sales table records sales with seller, buyer, date, quantity, and the sale's total price; rows may repeat. Report the seller or sellers with the highest total sales price, including ties. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Compare with the top total

Using the column names the statement gives:

```sql
SELECT seller_id
FROM Sales
GROUP BY seller_id
HAVING SUM(price) = (
    SELECT SUM(price)
    FROM Sales
    GROUP BY seller_id
    ORDER BY SUM(price) DESC
    LIMIT 1
);
```

Every row counts, duplicates included, because each is a recorded sale.

Do not use `ORDER BY … LIMIT 1` on the outer query; it drops tied sellers. Do not multiply by `quantity`; `price` is already the sale's total.

Time: O(n) with hashing  
Space: O(sellers)

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
