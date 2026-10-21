A user activity table records each user's activities with start and end dates. For each user, report the second most recent activity, or the only activity if the user has just one. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Rank plus count

Using the column names the statement gives:

```sql
SELECT username, activity, startDate, endDate
FROM (
  SELECT *,
         ROW_NUMBER() OVER (PARTITION BY username ORDER BY startDate DESC) AS rn,
         COUNT(*)     OVER (PARTITION BY username) AS cnt
  FROM UserActivity
) t
WHERE rn = 2 OR cnt = 1;
```

For instance, a user with activities starting on days 1, 5, and 9 → the one starting on day 5; a user with one activity → that activity.

Do not use `rn = 2` alone; single-activity users would vanish. Do not order ascending; "most recent" means the latest start.

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
