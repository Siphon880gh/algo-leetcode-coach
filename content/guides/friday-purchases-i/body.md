A table lists purchases with a user, a date within one month named in the statement, and an amount. For each Friday of that month that has at least one purchase, report its week of the month, the date and the total amount spent. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Filter Fridays, group

Using the column names the statement gives:

1. `WHERE weekday(date) = Friday` (in SQLite `strftime('%w', date) = '5'`; in MySQL `DAYOFWEEK(date) = 6`).
2. `GROUP BY date` with `SUM(amount)`; week = `(day of month + 6) / 7` with integer division, ordered as the statement asks.

This assumes the week number counts the Friday’s 7-day block from the 1st, so the first Friday is week 1. Check the statement’s numbering.

Constructed check (run in SQLite) on a sample month whose Fridays are the 1st, 8th, 15th, 22nd and 29th: purchases of 100 and 50 on the 1st, 30 on the 15th, 20 and 5 on the 29th, plus a Tuesday and a Saturday → weeks 1, 3 and 5 with 150, 30 and 25.

Weeks without a Friday purchase are left out; part II fills them with 0.

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
