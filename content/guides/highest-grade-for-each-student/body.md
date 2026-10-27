An enrollments table gives each student's grade in each course. For each student, report the course with their highest grade and that grade, choosing the smallest course id on a tie, ordered by student id. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One row per student

Using the column names the statement gives:

```sql
SELECT student_id, course_id, grade
FROM (
    SELECT student_id, course_id, grade,
           ROW_NUMBER() OVER (
               PARTITION BY student_id
               ORDER BY grade DESC, course_id ASC
           ) AS rn
    FROM Enrollments
) t
WHERE rn = 1
ORDER BY student_id;
```

The second sort key settles ties, so `ROW_NUMBER` is right here: exactly one row per student.

Do not group by student and select `MAX(grade)` with a bare `course_id`; the course is not guaranteed to match the grade. Without window functions, join the grouped maximum back and take `MIN(course_id)` among the matches.

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
