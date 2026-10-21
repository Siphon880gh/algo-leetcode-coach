A table Data has two integer columns, first_col and second_col. Return a result with the same number of rows where first_col is sorted in ascending order and second_col is sorted in descending order, each sorted independently of the other. For instance, rows (4, 2), (2, 3), (3, 1), (1, 4) → (1, 4), (2, 3), (3, 2), (4, 1). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two independent orders

Using the column names the statement gives:

1. `a = SELECT first_col, ROW_NUMBER() OVER (ORDER BY first_col) AS r FROM Data`.
2. `b = SELECT second_col, ROW_NUMBER() OVER (ORDER BY second_col DESC) AS r FROM Data`.
3. `SELECT a.first_col, b.second_col FROM a JOIN b ON a.r = b.r ORDER BY a.r`.

Constructed check (run in SQLite, the example above): (1, 4), (2, 3), (3, 2), (4, 1).

A plain `ORDER BY first_col, second_col DESC` keeps rows together, so it only breaks ties; the columns must be split apart to sort them separately.

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
