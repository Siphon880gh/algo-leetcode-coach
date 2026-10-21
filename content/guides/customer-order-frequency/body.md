Customers, products (with prices), and orders (product, quantity, date) are given. Report customers whose spending reached at least the amount the statement specifies in each of the months it names. For instance, a customer who met the bar in one month but not the other is excluded. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One HAVING per month

Using the column names the statement gives:

1. `JOIN Product p USING (product_id)`, and `JOIN Customers` for names.
2. `GROUP BY customer_id`.
3. `HAVING SUM(CASE WHEN <in month 1> THEN price * quantity ELSE 0 END) >= @amount AND SUM(CASE WHEN <in month 2> …) >= @amount`.

Do not filter with WHERE on one month; that loses the other. Do not sum quantity alone; spending is price × quantity.

Time: O(rows)  
Space: O(customers)

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
