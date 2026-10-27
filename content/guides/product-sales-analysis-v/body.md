A table Sales records sale_id, product_id, user_id and quantity, and a table Product records product_id and price. For each user, report their total spending (quantity times price, summed over all their sales), ordered by spending from highest to lowest, with ties broken as the statement specifies. For instance, a user who bought 10 units at 10 and 1 unit at 25 spent 125. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Join, sum, sort

Using the column names the statement gives:

1. `SELECT s.user_id, SUM(s.quantity · p.price) AS spending` from `Sales s JOIN Product p` on `product_id`.
2. `GROUP BY s.user_id ORDER BY spending DESC`, then the tie-break key the statement names.

Constructed check (run in SQLite; four users including the ones described above): (101, 125), (102, 75), (103, 75), (104, 70), with 102 and 103 tied.

Multiply before summing: one user’s sales can be for different products at different prices. Without the second sort key, tied users can come out in any order.

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
