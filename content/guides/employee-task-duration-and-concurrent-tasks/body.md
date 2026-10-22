A table lists tasks with an employee and start and end times. For each employee, report the total time covered by their tasks, counting overlapping time once, in the unit the statement gives, and the largest number of their tasks running at the same moment. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Event sweep

This assumes a task ending exactly when another starts does not overlap it, and that the total is reported in whole hours rounded down; check the official statement.

Using the column names the statement gives:

1. Events: (employee, start, +1) UNION ALL (employee, end, −1).
2. `SUM(d) OVER (PARTITION BY employee ORDER BY t, d ROWS UNBOUNDED PRECEDING)` as run; `LEAD(t)` as the next time (ends sort before starts at ties).
3. Covered = Σ (next − t) where run > 0; concurrency = MAX(run).

Constructed check (run in SQLite): employee 1 has 9:00–12:00, 11:00–13:30, 11:30–12:30 and 15:00–16:00 → 5 hours, 3 at once; employee 2 has 9–10 and 10–11 → 2 hours, 1 at once.

Adding raw durations double-counts overlaps: employee 1 → 7. Putting starts before ends at ties gives employee 2 concurrency 2.

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
