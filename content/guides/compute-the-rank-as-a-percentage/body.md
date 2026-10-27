A table Students records student_id, department_id and mark. For each student, report their percentage within their department, computed as the statement defines from the student’s rank (marks from highest to lowest, tied marks sharing a rank) and the size of the department, rounded as the statement specifies. A student alone in a department needs the special case the statement gives. For instance, in a department with marks 920, 610 and 530 the ranks are 1, 2 and 3 out of 3. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Rank and size per department

Using the column names the statement gives:

1. `rk = RANK() OVER (PARTITION BY department_id ORDER BY mark DESC)`, `cnt = COUNT(*) OVER (PARTITION BY department_id)`.
2. Combine `rk` and `cnt` with the statement’s formula and rounding, handling `cnt = 1` as the statement says.

Constructed check of rank and size (run in SQLite; three departments, one with a tie and one with a single student), as (student, department, rk, cnt): (1, 1, 2, 3), (2, 2, 1, 2), (3, 1, 3, 3), (5, 3, 1, 1), (7, 1, 1, 3), (8, 2, 1, 2).

Tied marks share a rank, so students 2 and 8 both get rk = 1. A formula that divides by the department size minus one needs a guard for a single-student department.

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
