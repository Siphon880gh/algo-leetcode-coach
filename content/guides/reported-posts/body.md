An actions table logs what users do to posts (views, likes, reports, and more) by date, and rows may repeat. For reports, an extra column holds the reason. For each report reason, count the distinct posts reported on one specific day; the statement fixes that date as "yesterday" relative to a given today. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Filter, group, count distinct

Using the column names the statement gives:

```sql
-- @yesterday stands for the date the statement asks about.
SELECT extra AS report_reason,
       COUNT(DISTINCT post_id) AS report_count
FROM Actions
WHERE action = 'report'
  AND action_date = @yesterday
GROUP BY extra;
```

Several users can report the same post for the same reason, and duplicate rows exist, so count distinct posts.

Do not use `COUNT(*)`; that counts reports, not posts. Do not forget the action filter; `extra` is also used by other actions.

Time: O(n) with hashing  
Space: O(reasons · posts)

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
