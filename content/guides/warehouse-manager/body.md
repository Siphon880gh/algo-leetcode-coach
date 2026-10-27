A warehouse table records how many units of each product each warehouse holds, and a products table gives each product's dimensions. Report each warehouse's total cubic volume of stored items, with column names as the statement specifies. For instance, 2 units of a 2 × 3 × 4 product add 48. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One join, one aggregate

Using the column names the statement gives:

1. `JOIN Products p ON w.product_id = p.product_id`.
2. `SUM(units × width × length × height)`, using the column names the statement gives.
3. `GROUP BY w.name`.

For instance, 2 units of 2 × 3 × 4 plus 1 unit of 1 × 1 × 10 → 58.

Do not sum dimensions before multiplying by units; volume is per unit times count.

Time: O(rows)  
Space: O(warehouses)

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
