## Filter, then LEAD

```sql
WITH top AS (
    SELECT user_id
    FROM course_completions
    GROUP BY user_id
    HAVING COUNT(*) >= 5 AND AVG(course_rating) >= 4
),
seq AS (
    SELECT c.user_id, c.course_name,
           LEAD(c.course_name) OVER (PARTITION BY c.user_id ORDER BY c.completion_date) AS next_course
    FROM course_completions c
    JOIN top t ON t.user_id = c.user_id
)
SELECT course_name AS first_course, next_course AS second_course, COUNT(*) AS transition_count
FROM seq
WHERE next_course IS NOT NULL
GROUP BY course_name, next_course
ORDER BY transition_count DESC, first_course, second_course;
```

Example (run in SQLite) → Node.js → Docker 2, React Basics → Node.js 2, then five pairs with 1. The same query runs in MySQL 8.

Skipping the top-performer filter: React Basics → Node.js is counted 3 times instead of 2.

Time: O(rows log rows)  
Space: O(rows)

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
