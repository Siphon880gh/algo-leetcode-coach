A students table names students, and an exam table records each student's score per exam. A quiet student took at least one exam and never had the highest or the lowest score in any exam they took. Report the quiet students, ordered as the statement specifies (typically by student id). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Mark extremes, then exclude

Using the column names the statement gives:

```sql
WITH marked AS (
  SELECT student_id,
         score = MAX(score) OVER (PARTITION BY exam_id)
      OR score = MIN(score) OVER (PARTITION BY exam_id) AS extreme
  FROM Exam
)
SELECT s.student_id, s.student_name
FROM Student s
JOIN marked m ON m.student_id = s.student_id
GROUP BY s.student_id, s.student_name
HAVING SUM(m.extreme) = 0
ORDER BY s.student_id;
```

For instance, in an exam with scores 70, 80, 90, only the student with 80 stays quiet for that exam.

Do not include students who took no exams; the join drops them. Do not compare with a global max or min; extremes are per exam.

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
