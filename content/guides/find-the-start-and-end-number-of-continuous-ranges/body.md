A logs table holds distinct integer ids. Report each maximal run of consecutive ids as its start and end, ordered by start. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Gaps and islands

Using the column names the statement gives:

```sql
SELECT MIN(log_id) AS start_id, MAX(log_id) AS end_id
FROM (SELECT log_id,
             log_id - ROW_NUMBER() OVER (ORDER BY log_id) AS grp
      FROM Logs) t
GROUP BY grp
ORDER BY start_id;
```

For instance, ids `1,2,3,7,8,10` give differences `0,0,0,3,3,4`, so the runs are `1–3`, `7–8`, and `10–10`.

Do not compare each row only with its predecessor and then try to stitch runs in SQL; the difference trick does it in one pass. Do not forget single-id runs; their start equals their end.

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
