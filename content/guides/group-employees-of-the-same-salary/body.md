An employees table gives each employee's id, name and salary. Employees who share a salary with at least one other employee form a team; employees with a unique salary are left out. Teams get ids by salary rank, lowest salary first (as the statement specifies). Report each team member with their team id, ordered as the statement specifies (typically by team id, then employee id). For instance, with salaries 3000, 3000, 7400, 6100, 7400 for employees 2, 3, 7, 8, 9: employees 2 and 3 form team 1, 7 and 9 form team 2, and 8 is left out. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Filter, then rank

Using the column names the statement gives:

1. `s` = salaries with `COUNT(*) ≥ 2`.
2. Join employees to `s`; `DENSE_RANK() OVER (ORDER BY salary)` as the team id.
3. Order as required.

Constructed check (run in SQLite, the example above): (2, 3000, 1), (3, 3000, 1), (7, 7400, 2), (9, 7400, 2).

Filter before ranking; ranking all employees would let the unique 6100 take team id 2. Use `DENSE_RANK`, not `RANK`, so team ids stay consecutive.

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
