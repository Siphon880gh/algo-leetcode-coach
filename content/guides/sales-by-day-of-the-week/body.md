An orders table records item quantities with order dates, and an items table gives each item's category. Report, for every category, the total quantity ordered on each day of the week as separate columns, with 0 where nothing was ordered, ordered as the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Pivot by weekday

Using the column names the statement gives:

1. `FROM Items i LEFT JOIN Orders o ON i.item_id = o.item_id`.
2. For each day: `SUM(CASE WHEN DAYOFWEEK(o.order_date) = d THEN o.quantity ELSE 0 END)` (or `DAYNAME`).
3. `GROUP BY i.item_category`, order as required.

For instance, a category ordered only on a Tuesday shows its quantity under Tuesday and 0 elsewhere.

Do not start from orders; categories with no orders would vanish. Check your dialect's weekday numbering (Sunday may be 1).

Time: O(rows)  
Space: O(categories)

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
