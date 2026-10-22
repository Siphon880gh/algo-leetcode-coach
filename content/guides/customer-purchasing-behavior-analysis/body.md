Two tables describe purchases: one lists transactions with a customer, a product, an amount and a date, and one gives each product’s category. For each customer, report summary figures about their purchases, such as totals, counts and averages, their top category, and a score built from these, all as the statement defines. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Aggregate and rank

This assumes the top category is the one bought most often, ties going to the most recent purchase; check the official statement for that rule, the exact figures, rounding and the score formula.

Using the column names the statement gives:

1. `c`: per customer and category, `COUNT(*)` and `MAX(ts)` from transactions joined to products.
2. `top`: `ROW_NUMBER() OVER (PARTITION BY customer ORDER BY n DESC, last DESC)`, keep rank 1.
3. Per customer: `SUM(amount)`, `COUNT(*)`, `COUNT(DISTINCT category)`, `AVG(amount)`, joined to `top`; compute the score from these as the statement defines.

Constructed check (run in SQLite): customer 7 buys Books 10, Toys 20, Toys 30; customer 8 buys Books 15, Games 25 later → (7: 60, 3, 2, 20, Toys), (8: 40, 2, 2, 20, Games).

Grouping the totals by customer and category returns one row per category.

Time: O(n log n)  
Space: O(n)

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
