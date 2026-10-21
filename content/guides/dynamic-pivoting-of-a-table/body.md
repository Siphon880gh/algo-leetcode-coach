A table Products has columns product_id, store and price, where each (product_id, store) pair is unique and the set of stores is not known in advance. Write a procedure that returns one row per product with one column per store, columns ordered by store name, holding that product’s price in the store or null if it is not sold there. For instance, products sold at Shop and LC_Store, at Nozama and Souq, and at Shop and Souq → columns LC_Store, Nozama, Shop, Souq with nulls where missing. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Generate the pivot query

Using the column names the statement gives: take the table and procedure name from it too.

1. `SELECT GROUP_CONCAT(DISTINCT CONCAT('MAX(CASE WHEN store = ', QUOTE(store), ' THEN price END) AS ', store) ORDER BY store) INTO @cols FROM Products`.
2. `SET @sql = CONCAT('SELECT product_id, ', @cols, ' FROM Products GROUP BY product_id')`.
3. `PREPARE s FROM @sql; EXECUTE s; DEALLOCATE PREPARE s`.

Constructed check (the query generated in Python and run in SQLite, the example above): (1, 100, null, 110, null), (2, null, 200, null, 190), (3, null, null, 1000, 1900).

MAX picks the single price for each pair and leaves null where there is none. Raise group_concat_max_len first if there are many stores.

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
