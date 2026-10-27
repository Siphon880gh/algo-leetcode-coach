A table Products has a product_id column and one price column per store, where the store columns are not known in advance and a null price means the product is not sold there. Write a procedure that returns rows (product_id, store, price) for every non-null price. For instance, product 1 with LC_Store 100 and Shop 110 and nulls elsewhere → (1, LC_Store, 100), (1, Shop, 110). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Generate the unpivot query

Using the column names the statement gives: take the table and procedure name from it too.

1. From `information_schema.columns` for the table, take every column except `product_id`.
2. `GROUP_CONCAT(CONCAT('SELECT product_id, ', QUOTE(c), ' AS store, ', c, ' AS price FROM Products WHERE ', c, ' IS NOT NULL') SEPARATOR ' UNION ALL ')` into `@sql`.
3. `PREPARE`, `EXECUTE`, `DEALLOCATE`.

Constructed check (the query generated in Python and run in SQLite on the pivoted table from 2252): the same six (product_id, store, price) rows.

Filter the schema rows to the current database too, so a same-named table elsewhere does not add columns.

Time: O(n · stores)  
Space: O(n · stores)

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
