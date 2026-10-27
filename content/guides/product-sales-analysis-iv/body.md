A table Sales records sale_id, product_id, user_id and quantity, and a table Product records product_id and price. For each user, report the product or products on which they spent the most money (quantity times price, summed over their sales), keeping all products on a tie. For instance, a user who spent 100 on one product and 105 on another reports the second; a user who spent 150 on each of three products reports all three. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Spend per user and product

Using the column names the statement gives:

1. `spend = SUM(s.quantity · p.price)` from `Sales s JOIN Product p` on `product_id`, `GROUP BY s.user_id, s.product_id`.
2. `rk = RANK() OVER (PARTITION BY user_id ORDER BY spend DESC)`; keep `rk = 1`.

Constructed check (run in SQLite; the two users described above): (101, 3), (102, 1), (102, 2), (102, 3).

RANK keeps every tied product, which ROW_NUMBER would not. A user’s several sales of one product must be summed before ranking.

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
