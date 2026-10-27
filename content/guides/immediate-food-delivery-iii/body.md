A deliveries table records, for each order, a customer, an order date and the customer’s preferred delivery date. An order is immediate when the preferred date equals the order date. For each order date, report the percentage of that day’s orders that were immediate, rounded and ordered as the statement says. The exact columns and output names are in the official statement. For instance, a day with 3 orders of which 2 are immediate → 66.67. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Ratio per day

Using the column names the statement gives:

1. `GROUP BY` the order date.
2. Compute `100.0 · SUM(order date = preferred date) / COUNT(*)`, then `ROUND(…, 2)`.
3. `ORDER BY` the order date.

Constructed check (run in SQLite): a day with 2 of 3 immediate → 66.67, a day with none → 0.0, a day with 1 of 1 → 100.0.

Write 100.0 rather than 100: with integer division SQLite gives 66 for the first day.

Time: O(n log n)  
Space: O(number of days)

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
