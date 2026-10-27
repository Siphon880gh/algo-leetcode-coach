Tables list students and their major, courses with their major and whether each is mandatory or elective, and enrollments with a grade and a GPA. Return the students who meet the statement’s conditions on their major’s mandatory courses, their elective courses and their GPA. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One CTE per condition

This assumes the conditions are: every mandatory course of the major at the top grade, at least :k electives of the major at or above a grade, and an average GPA of at least :g. The exact grades, :k and :g are in the official statement.

Using the column names the statement gives:

1. m: students with `NOT EXISTS` a mandatory major course lacking their top-grade enrollment.
2. el: `GROUP BY student HAVING COUNT(*) >= :k` over elective major courses with a qualifying grade.
3. g: `GROUP BY student HAVING AVG(gpa) >= :g`.
4. Return ids in all three, ordered as asked.

Constructed check (run in SQLite, :k = 2, :g = 2.5): student 1 passes everything; student 3 has a B in the mandatory course; student 4 has a low GPA → 1. With :g = 0 → 1, 4.

Counting top grades in any course against the number of mandatory courses also admits student 3.

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
