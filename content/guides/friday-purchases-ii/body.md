Same purchases table as Friday Purchases I. Now report every Friday of the month, with its week of the month, the date and the total spent, using 0 for a Friday with no purchases. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Calendar CTE, then LEFT JOIN

Using the column names the statement gives:

1. Recursive CTE from the month’s first Friday, adding 7 days while still in the month.
2. `LEFT JOIN` purchases on date; `GROUP BY` Friday; `COALESCE(SUM(amount), 0)`; week as in part I, ordered as the statement asks.

This assumes the same week numbering as part I.

Constructed check (run in SQLite) on part I’s sample → weeks 1 … 5 with 150, 0, 30, 0, 25.

An inner join drops the empty Fridays and gives part I’s answer.

Time: O(n)  
Space: O(number of Fridays)

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
