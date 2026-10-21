A sales table records, per date and fruit (apples or oranges), how many were sold. Report, for each date, apples sold minus oranges sold, ordered as the statement specifies. For instance, 10 apples and 8 oranges on one day give 2. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One pass per date

Using the column names the statement gives:

1. `SUM(CASE WHEN fruit = 'apples' THEN sold_num ELSE −sold_num END)`, or two SUM(CASE …) terms subtracted.
2. `GROUP BY sale_date`, order as required.

Do not join without the date condition; that is a cross product. The conditional sum avoids the join entirely.

Time: O(rows)  
Space: O(dates)

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
