Customers and orders (with dates) are given. For each customer, report up to their three most recent orders (fewer if they have fewer), ordered as the statement specifies. For instance, a customer with five orders shows only the latest three. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Top-3 per group

Using the column names the statement gives:

1. `ROW_NUMBER() OVER (PARTITION BY customer_id ORDER BY order_date DESC) AS rn`.
2. `WHERE rn <= 3`; join customers for names.
3. Order as the statement specifies.

Do not use `LIMIT 3` globally; it is per customer. A correlated count of newer orders (< 3) also works without window functions.

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
