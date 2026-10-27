A products table lists, per product and store, the product's price in that store; there is a small fixed set of stores. Report one row per product with its price in each store as a separate column, or null where the product is not sold there, with the column names the statement specifies. For instance, product 0 priced 95, 100, 105 in the three stores and product 1 priced 70 in the first and 80 in the third give (0, 95, 100, 105) and (1, 70, null, 80). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One column per store

Using the column names the statement gives:

1. `GROUP BY` the product id.
2. For each store value: `MAX(CASE WHEN store = '<that store>' THEN price END) AS <its column>`.

Constructed check (run in SQLite): the example above → `(0, 95, 100, 105)`, `(1, 70, NULL, 80)`.

Leave out `ELSE 0`; a missing store must be NULL, not 0. `MAX` (or `SUM`) just collapses the single matching row.

Time: O(rows)  
Space: O(products)

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
