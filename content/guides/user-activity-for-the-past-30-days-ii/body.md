An activity table logs user actions with a session id and a date; each session belongs to one user. Report the average number of sessions per user over a 30-day period ending on a given date, rounded as the statement specifies (0 when there are no users). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two distinct counts

Using the column names the statement gives:

```sql
-- @end_date stands for the last day of the window given in the statement.
SELECT ROUND(IFNULL(COUNT(DISTINCT session_id) / COUNT(DISTINCT user_id), 0), 2)
       AS average_sessions_per_user
FROM Activity
WHERE activity_date > DATE_SUB(@end_date, INTERVAL 30 DAY)
  AND activity_date <= @end_date;
```

With no rows, the division is null, and `IFNULL` turns it into 0.

Do not average per-user session counts that include users with no activity; only active users count. Count distinct sessions, since one session has many activity rows.

Time: O(n) with hashing  
Space: O(sessions + users)

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
