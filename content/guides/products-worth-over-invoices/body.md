Given a product table and an invoices table (each invoice for one product with several amount categories, such as rest, paid, canceled and refunded), report each product's name with the totals of every category over its invoices, ordered as the statement specifies. For instance, two invoices for product A with paid 10 and 5 give A a paid total of 15. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Group and sum

Using the column names the statement gives:

1. `FROM` products `LEFT JOIN` invoices on the product id.
2. `GROUP BY` product id and name; `IFNULL(SUM(category), 0)` for each amount column.
3. Order as required (typically by product name).

Constructed check: A has invoices (paid 10, refunded 0) and (paid 5, refunded 2) → paid 15, refunded 2. B with no invoices → zeros (with a LEFT JOIN).

Group by the product id, not only the name, if names can repeat.

Time: O(rows)  
Space: O(products)

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
