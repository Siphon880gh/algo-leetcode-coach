Given customers, orders (customer, product, date) and products tables, report for each customer the product or products they ordered most often, with the product details the statement asks for. Ties are all reported. For instance, a customer who ordered product A twice and B once gets only A. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count, rank, keep the top

Using the column names the statement gives:

1. Count orders per (customer, product) with `GROUP BY`.
2. `RANK() OVER (PARTITION BY customer ORDER BY count DESC)`.
3. Keep rank 1; join the product table for the requested product columns.

Constructed check: orders (1, A), (1, A), (1, B) → customer 1 reports A only. With (2, A), (2, B) customer 2 reports both.

Use RANK or DENSE_RANK, not ROW_NUMBER (that drops ties). Customers with no orders produce no rows.

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
