Tables list purchases (a user, a date, an amount) and users with a membership type. For the Fridays of the period the statement gives, report the total spent by each membership type the statement names. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Calendar first

This assumes every Friday and type must appear, with 0 when there were no purchases; check the official statement.

Using the column names the statement gives:

1. f = Fridays from the first one in the period, adding 7 days while inside it.
2. Cross join f with the listed types; left join users of that type and their purchases on that date.
3. `COALESCE(SUM(amount), 0)`, grouped by Friday and type, labelled and ordered as asked.

Constructed check (run in SQLite, November 2023, two types): Fridays 3, 10, 17 and 24 → eight rows, including 0 rows for the 17th; a Saturday purchase, a December one and a third type are excluded.

Grouping the purchases alone loses the empty Fridays.

Time: O(F · T + n)  
Space: O(F · T)

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
