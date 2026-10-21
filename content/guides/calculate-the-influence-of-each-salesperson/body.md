Three tables describe the salespeople, the customers each salesperson serves, and the sales made to those customers with their prices. For every salesperson, report the total price of the sales made to their customers, including salespeople whose total is 0. For instance, a salesperson with customers who bought for 40, 5 and 25 has 70; one whose only customer bought nothing has 0. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Keep every salesperson

Using the column names the statement gives:

1. `Salesperson s LEFT JOIN Customer c ON c.salesperson_id = s.salesperson_id LEFT JOIN Sales x ON x.customer_id = c.customer_id`.
2. `GROUP BY s.salesperson_id`; total `COALESCE(SUM(x.price), 0)`, with the statement’s output columns.

Constructed check (run in SQLite; three salespeople, one with a customer who bought nothing): (1, 70), (2, 60), (3, 0).

Inner joins drop salesperson 3 entirely, and without COALESCE the sum is NULL rather than 0.

Time: O(n log n)  
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
