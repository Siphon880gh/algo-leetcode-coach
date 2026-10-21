Customers, orders (product, date), and products (names) are given. For each product that was ordered, report its most recent order(s) — every order sharing the latest date — with the columns and ordering the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Keep all ties

Using the column names the statement gives:

1. `RANK() OVER (PARTITION BY product_id ORDER BY order_date DESC) AS rk` (or compare with the per-product MAX).
2. `WHERE rk = 1`; join products for names.
3. Order as the statement specifies.

For instance, two orders of a product on its latest date both appear.

Do not use ROW_NUMBER; it keeps only one of the tied orders.

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
