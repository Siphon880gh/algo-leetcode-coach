One table gives each employee the number of hours they must work, and another logs their work sessions with entry and exit times. Report the employees who worked less than required, which includes employees with no sessions at all; how each session’s length is rounded is set in the statement. For instance, an employee needing 12 hours who logged one session just under 12 hours is reported, and so is an employee who logged nothing. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Total time, then compare

Using the column names the statement gives:

1. Subquery: per employee, `SUM` of each session’s exit minus entry, in minutes, rounded as the statement says.
2. `employees LEFT JOIN` that subquery; keep rows with `COALESCE(total, 0) < required hours · 60`.
3. Return the employee ids in the statement’s output format.

Constructed check (run in SQLite, rounding each session up to whole minutes for the test): one employee with about 20 hours against 20 needed is not reported; one 1 second short of 12 hours and one with no sessions are.

An inner join drops employees who never logged a session, though they certainly fell short: in the check it reports one employee instead of two. Compare in one unit, minutes against hours · 60.

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
