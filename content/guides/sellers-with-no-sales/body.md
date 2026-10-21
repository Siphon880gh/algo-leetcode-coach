Given customers, orders (with sale date and seller) and sellers tables, report the names of sellers who made no sales in 2020, ordered as the statement specifies (typically by name). For instance, a seller whose only order is in 2019 is reported. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Anti-join

Using the column names the statement gives:

1. Select seller names from the seller table.
2. `LEFT JOIN` orders on the seller id `AND` the order's year = 2020 (inside `ON`).
3. Keep rows where the joined order is NULL; order the output as required.

Constructed check: seller A sold in 2019 only, B in 2020, C never → report A and C.

Do not put the year test in WHERE with a LEFT JOIN; that turns it into an inner join and loses sellers like A. `NOT IN` works only if the subquery has no NULL seller ids.

Time: O(rows)  
Space: O(sellers)

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
