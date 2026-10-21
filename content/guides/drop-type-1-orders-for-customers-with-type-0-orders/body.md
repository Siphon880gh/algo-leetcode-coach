An orders table lists an order id, a customer id and an order type, which is 0 or 1. Report the orders that remain after this rule: if a customer has at least one type 0 order, leave out all of that customer's type 1 orders; customers with only type 1 orders keep them. For instance, customer 1 with two type 0 orders, customer 2 with one of each type, customer 3 with one type 1 order and customer 4 with one type 0 and two type 1 orders keep order ids 1, 2, 11, 21, 22. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One WHERE clause

Using the column names the statement gives:

`SELECT * FROM Orders WHERE order_type = 0 OR customer_id NOT IN (SELECT customer_id FROM Orders WHERE order_type = 0)`.

Constructed check (run in SQLite, the example above): 1, 2, 11, 21, 22.

Type 0 rows always stay. A type 1 row stays only when its customer never placed a type 0 order. The subquery returns no NULLs here, so `NOT IN` is safe; `NOT EXISTS` works the same.

Time: O(n)  
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
