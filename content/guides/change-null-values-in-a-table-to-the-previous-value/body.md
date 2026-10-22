A table lists rows, each with an id and a drink that may be NULL. Replace each NULL drink with the most recent non-NULL drink above it, in the row order the statement uses, and return the rows in that order. For instance, rows (9, Tea), (6, NULL), (7, NULL), (3, Latte), (1, Mocha), (2, NULL) become Tea, Tea, Tea, Latte, Mocha, Mocha. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Running count makes groups

Using the column names the statement gives:

1. `rn = ROW_NUMBER() OVER ()`, numbering rows in their given order.
2. `grp = COUNT(drink) OVER (ORDER BY rn)`; COUNT skips NULLs, so a NULL row keeps the previous group.
3. `FIRST_VALUE(drink) OVER (PARTITION BY grp ORDER BY rn)`, output in `rn` order.

Constructed check (run in SQLite, the rows above): Tea, Tea, Tea, Latte, Mocha, Mocha.

Ordering by id instead gives Mocha, Mocha, Latte, Latte, Latte, Tea for ids 1, 2, 3, 6, 7, 9, which fills from the wrong neighbours. How the row order is fixed depends on the statement and the engine.

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
