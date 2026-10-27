A table Products records product_id and price, and a table Purchases records invoice_id, product_id and quantity. Find the invoice with the highest total price (the sum of quantity times price over its rows), breaking ties as the statement specifies, and report that invoice’s products with their quantity and line price (quantity times price). For instance, if invoices total 130, 180 and 50, report the lines of the 180 invoice. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Pick the invoice, then list it

Using the column names the statement gives:

1. `t` = `SELECT invoice_id, SUM(quantity · price) AS tot FROM Purchases JOIN Products USING (product_id) GROUP BY invoice_id`.
2. `best` = the top row of `t` by `tot DESC`, then the statement’s tie-break, `LIMIT 1`.
3. `SELECT product_id, quantity, quantity · price FROM Purchases JOIN Products USING (product_id) WHERE invoice_id = best`.

Constructed check (run in SQLite; prices 50, 120, 30; invoices total 130, 180, 50): the 180 invoice → (2, 1, 120), (3, 2, 60).

The totals and the line prices both multiply before summing. Pick the single invoice first; filtering lines by the maximum total alone can return two tied invoices.

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
