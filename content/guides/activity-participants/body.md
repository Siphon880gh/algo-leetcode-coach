A friends table records which activity each person does, and an activities table lists the activities. Report the activities whose number of participants is neither the largest nor the smallest count among activities. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count, then compare with the extremes

Using the column names the statement gives:

```sql
WITH c AS (
  SELECT activity, COUNT(*) AS cnt
  FROM Friends
  GROUP BY activity
)
SELECT activity
FROM c
WHERE cnt <> (SELECT MAX(cnt) FROM c)
  AND cnt <> (SELECT MIN(cnt) FROM c);
```

For instance, counts 3, 2, and 1 for three activities → only the activity with 2.

Do not use `LIMIT` to drop one top and one bottom row; ties mean several activities can share the max or min. Do not compare with the overall row count; compare with the per-activity counts.

Time: O(n log n)  
Space: O(activities)

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
