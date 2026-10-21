An orders table records order id, date, customer, and invoice amount. For each month, report the number of orders and the number of distinct customers, considering only orders whose invoice exceeds the threshold the statement specifies. For instance, a customer with two qualifying orders in one month counts once among customers but twice among orders. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Filter first

Using the column names the statement gives:

1. `WHERE invoice > @threshold`.
2. `GROUP BY DATE_FORMAT(order_date, '%Y-%m')`.
3. `COUNT(order_id)`, `COUNT(DISTINCT customer_id)`.

Do not filter in HAVING; the condition is per order, not per month. Months with no qualifying orders simply do not appear.

Time: O(rows log rows)  
Space: O(months)

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
