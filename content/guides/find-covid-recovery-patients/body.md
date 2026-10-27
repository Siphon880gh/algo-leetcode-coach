## Two steps

```sql
WITH fp AS (
  SELECT patient_id, MIN(test_date) AS pos_date
  FROM covid_tests
  WHERE result = 'Positive'
  GROUP BY patient_id
),
fn AS (
  SELECT t.patient_id, MIN(t.test_date) AS neg_date
  FROM covid_tests t
  JOIN fp ON fp.patient_id = t.patient_id
  WHERE t.result = 'Negative' AND t.test_date > fp.pos_date
  GROUP BY t.patient_id
)
SELECT p.patient_id, p.patient_name, p.age,
       CAST(julianday(fn.neg_date) - julianday(fp.pos_date) AS INTEGER) AS recovery_time
FROM patients p
JOIN fp ON fp.patient_id = p.patient_id
JOIN fn ON fn.patient_id = p.patient_id
ORDER BY recovery_time, p.patient_name;
```

Example (run in SQLite) → Alice Smith 10, Carol Davis 10, Bob Johnson 11. In MySQL, use DATEDIFF(fn.neg_date, fp.pos_date) instead of the julianday difference.

Taking the first negative regardless of date: Carol Davis gets −21.

Time: O(tests log tests)  
Space: O(patients)

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
