Given drivers (with join dates), rides and accepted-ride tables, report for every month of 2020 the number of drivers active by the end of that month and the number of rides accepted that month, with the columns and ordering the statement specifies. For instance, one driver who joined in December 2019 and another in March 2020 give 1 active driver in January and 2 in March. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Calendar first

Using the column names the statement gives:

1. Recursive CTE `months(m)` for 1 … 12.
2. Active drivers: for each `m`, count drivers whose join date ≤ the last day of month `m` of 2020 (a correlated subquery or a join with `COUNT`).
3. Accepted rides: join accepted rides to rides, filter year 2020, `GROUP BY MONTH(date)`; left join to `months` with `COALESCE(…, 0)`.

Constructed check: drivers joined 2019-12-10 and 2020-03-05; no rides → Jan 1, Feb 1, Mar 2, …, Dec 2; rides 0 every month.

Do not start from the rides table; months with no rides must still appear. Drivers who joined before 2020 count from January.

Time: O(12 · rows)  
Space: O(12)

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
