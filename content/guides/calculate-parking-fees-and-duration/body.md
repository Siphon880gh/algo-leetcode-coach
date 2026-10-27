A table logs parking sessions: a car, a lot, entry and exit times and the fee paid. For each car, report the total fee, the fee per hour over all of its parking time (rounded as the statement asks), and the lot where it spent the most time. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two aggregates

This assumes the hourly rate is total fee over total hours and that one lot has the most time per car; check the official statement for rounding and ties.

Using the column names the statement gives:

1. Hours per row: `(strftime('%s', exit) - strftime('%s', entry)) / 3600.0` (use your engine’s time difference).
2. Per car: `SUM(fee)` and `ROUND(SUM(fee) / SUM(hours), 2)`.
3. Per (car, lot): `SUM(hours)`; `ROW_NUMBER() OVER (PARTITION BY car ORDER BY SUM(hours) DESC)` = 1. Join and order as asked.

Constructed check (run in SQLite): car 1 parks 2 h at lot 1 and 1 h + 2.5 h at lot 2 for 12 → 12, 2.18, lot 2; car 2 → 10, 2.00, lot 3.

Averaging per-session rates gives car 1 2.37 instead of 2.18.

Time: O(n log n)  
Space: O(n)

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
