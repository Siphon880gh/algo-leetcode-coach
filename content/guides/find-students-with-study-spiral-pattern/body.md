## Runs and a self-join

This reads the pattern as: within one run, the subject sequence repeats with period c, where c is the number of distinct subjects in the run, and the hours are summed over the whole run.

```sql
WITH s AS (
  SELECT student_id, subject, hours_studied,
         ROW_NUMBER() OVER (PARTITION BY student_id ORDER BY session_date) AS rn,
         julianday(session_date)
           - julianday(LAG(session_date) OVER (PARTITION BY student_id ORDER BY session_date)) AS gap
  FROM study_sessions
),
g AS (
  SELECT *,
         SUM(CASE WHEN gap IS NULL OR gap > 2 THEN 1 ELSE 0 END)
           OVER (PARTITION BY student_id ORDER BY rn) AS grp
  FROM s
),
r AS (
  SELECT *, ROW_NUMBER() OVER (PARTITION BY student_id, grp ORDER BY rn) AS pos
  FROM g
),
runs AS (
  SELECT student_id, grp, COUNT(*) AS n, COUNT(DISTINCT subject) AS c, SUM(hours_studied) AS hours
  FROM r
  GROUP BY student_id, grp
)
SELECT st.student_id, st.student_name, st.major,
       runs.c AS cycle_length, runs.hours AS total_study_hours
FROM runs
JOIN students st ON st.student_id = runs.student_id
WHERE runs.c >= 3 AND runs.n >= 2 * runs.c
  AND NOT EXISTS (
    SELECT 1
    FROM r a
    JOIN r b ON b.student_id = a.student_id AND b.grp = a.grp AND b.pos = a.pos - runs.c
    WHERE a.student_id = runs.student_id AND a.grp = runs.grp AND a.subject <> b.subject
  )
ORDER BY cycle_length DESC, total_study_hours DESC;
```

Example (run in SQLite) → Bob Johnson 4, 26.0; Alice Chen 3, 15.0. In MySQL, use DATEDIFF(session_date, LAG(session_date) OVER (…)) for the gap.

Skipping the repeat check: a student studying A, B, C, C, B, A on six straight days is reported with cycle length 3.

Time: O(sessions log sessions)  
Space: O(sessions)

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
