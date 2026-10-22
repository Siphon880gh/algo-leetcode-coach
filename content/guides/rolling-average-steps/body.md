A steps table records a user’s step count on a date. For each user and date, report the average over that date and the two dates just before it, but only when all three consecutive dates have rows. Rounding, the columns, output names and ordering are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Window plus a gap check

Using the column names the statement gives:

This assumes at most one row per user per date.

1. Per user ordered by date: `AVG(steps) OVER (ROWS BETWEEN 2 PRECEDING AND CURRENT ROW)` and `LAG(date, 2)`.
2. Keep rows where that lagged date is the current date minus 2 days; round as the statement says.

Constructed check (run in SQLite): user 1 on Jan 1, 2, 3, 5, 6, 7 with 100 … 600 and user 2 on Jan 1, 2 → user 1 Jan 3 at 200 and Jan 7 at 500.

A rows-only frame also reports partial and gapped windows, such as Jan 5 at 300.

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
