A customers table records each customer's revenue per year. Report the customers whose revenue in the specific year the statement names is strictly positive, with the column name it specifies. For instance, with the year 2021, a customer with 30 that year is reported, while customers with −50 or 0 that year, or revenue only in other years, are not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two conditions

Using the column names the statement gives:

`SELECT` the customer id `FROM` customers `WHERE` year = the given year `AND` revenue `> 0`.

Constructed check (run in SQLite, year 2021): rows (1, 2018, 50), (1, 2021, 30), (2, 2021, −50), (3, 2021, 0), (4, 2020, 10) → customer 1.

Use strict `> 0`; zero revenue is not positive.

Time: O(rows)  
Space: O(1)

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
