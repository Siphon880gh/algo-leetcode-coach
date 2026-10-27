An orders table records, for each order, a customer, a date and a price. A customer qualifies when their total spending per year strictly increases every year from their first order year to their last, where a year in between with no orders counts as 0. Return the qualifying customers. For instance, a customer spending 100 in 2019, 150 in 2020 and 300 in 2021 qualifies; one spending 100 in 2019 and 300 in 2021 with nothing in 2020 does not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Yearly totals, then LAG

Using the column names the statement gives:

1. Group by customer and the year of the order date; `SUM` the price.
2. Over each customer’s years in order, use `LAG` for the previous year and its total.
3. Keep customers with no row where the year is not the previous year + 1, or the total is not above the previous total.

Constructed check (run in SQLite): customer 1 with 100, 150 and 200 + 100 over 2019 – 2021 qualifies; customer 2 with orders only in 2019 and 2021, and customer 3 with 200 then 200, do not.

Prices are positive, so a missing year, counted as 0, always breaks the increase; failing on any gap is the same test. A customer with a single year passes these checks, so confirm how the statement treats them.

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
