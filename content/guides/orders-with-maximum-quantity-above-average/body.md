An order-details table lists, for each order, the products and the quantity of each. An order's average quantity is its total quantity divided by its number of distinct products, and its maximum quantity is its largest single quantity. An order is imbalanced if its maximum quantity is strictly greater than the average quantity of every order (itself included). Report the imbalanced orders' ids, in the order the statement specifies. For instance, with order 1 = {12, 10, 15}, order 2 = {8, 4, 6}, order 3 = {5, 18, 20} and order 4 = {2, 8}, orders 1 and 3 are imbalanced. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Per-order stats, then one comparison

Using the column names the statement gives:

1. `s` = `SELECT order id, MAX(quantity) AS mx, AVG(quantity) AS av ... GROUP BY order id`.
2. `SELECT order id FROM s WHERE mx > (SELECT MAX(av) FROM s)`.

Constructed check (run in SQLite, the example above): averages ≈ 12.33, 6, 14.33, 5; the largest is ≈ 14.33, so maxima 15 and 20 qualify → orders 1 and 3.

`> ALL (...)` works too, but comparing against the maximum is clearer. Use strict `>`; an order whose max equals the largest average is not imbalanced.

Time: O(rows)  
Space: O(orders)

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
