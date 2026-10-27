A salary table holds employee rows with names, a department and a yearly salary; old rows with outdated salaries were never removed, so an employee can appear several times. Salaries only increase over the years, so each employee’s current salary is their largest one. Return each employee’s current row, ordered as the statement says. The exact columns and output format are in the official statement. For instance, an employee with rows at 99000 and 110000 → the 110000 row. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Max per employee

Using the column names the statement gives:

1. In a subquery, group by employee and take `MAX` of the salary.
2. Join the table to that subquery on employee and salary.
3. Order by employee id.

Constructed check (run in SQLite): employee 1 with 99000 and 110000 → 110000; employee 2 with 70000 and 72000 → 72000; employee 3 with one row keeps it.

If the salary column is stored as text, cast it before taking MAX: as text, 99000 sorts above 110000, and the check above then returns 99000 for employee 1.

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
