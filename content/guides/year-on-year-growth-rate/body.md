A table records transactions, each with a product, an amount and a date. For each product and year, report that year’s total, the previous year’s total and the growth rate between them, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Group, then LAG

This assumes the rate is (current − previous) / previous · 100, rounded to two decimals, with NULL for a product’s first year, and that each product has a row for every year between its first and last; check the official statement.

Using the column names the statement gives:

1. `WITH y AS (SELECT product, YEAR(ts) AS yr, SUM(amount) AS total FROM sales GROUP BY product, yr)`.
2. `SELECT yr, product, total, LAG(total) OVER (PARTITION BY product ORDER BY yr) AS prev FROM y`, then `ROUND((total - prev) * 100 / prev, 2)` in an outer query.

Constructed check (run in SQLite with strftime for YEAR): product 1 has 150, 300, 240 in 2019–2021 and product 2 has 80, 40 in 2020–2021 → rates NULL, 100.00, −20.00 and NULL, −50.00.

Dividing by the current year instead: 50.00, −25.00, −100.00.

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
