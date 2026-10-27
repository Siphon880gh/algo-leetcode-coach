Tables list students and their major, courses and the major each belongs to, and enrollments with the grade a student got in a course. Return the students who took every course in their major and earned the top grade in each, as the statement defines it. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Relational division

This assumes the top grade is a single value (written 'A' below) and that only courses of the student’s own major count; check the official statement.

Using the column names the statement gives:

1. For each student s: `NOT EXISTS (SELECT 1 FROM courses c WHERE c.major = s.major AND NOT EXISTS (SELECT 1 FROM enrollments e WHERE e.student = s.id AND e.course = c.id AND e.grade = 'A'))`.
2. Order as asked.

Constructed check (run in SQLite): major X has courses 10, 11; Y has 20. Student 1 (X) gets A, A; student 2 (X) gets A, B and an A in 20; student 3 (Y) gets A; student 4 (Y) gets B → 1, 3.

Counting a student’s A grades against the number of major courses also admits student 2, whose second A is outside the major.

Time: O(students · courses) with indexes  
Space: O(1) beyond the tables

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
