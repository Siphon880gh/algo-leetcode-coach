With a per-player, per-date activity table, a player's install date is their first login date. For each install date, report how many players installed that day and the day-1 retention: the share of those players who logged in again on the next day, rounded as the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## First date, then the next day

Using the column names the statement gives:

```sql
WITH first_login AS (
    SELECT player_id, MIN(event_date) AS install_dt
    FROM Activity
    GROUP BY player_id
)
SELECT f.install_dt,
       COUNT(*) AS installs,
       ROUND(COUNT(a.player_id) / COUNT(*), 2) AS Day1_retention
FROM first_login f
LEFT JOIN Activity a
  ON a.player_id = f.player_id
 AND a.event_date = DATE_ADD(f.install_dt, INTERVAL 1 DAY)
GROUP BY f.install_dt;
```

The primary key allows at most one row per player and day, so the left join keeps one row per player. `COUNT(a.player_id)` counts only the players who came back.

Do not use an inner join; players who did not return must still count as installs. Do not compute retention over all logins on the next day; only that date's installers count.

Time: O(n) with hashing  
Space: O(players)

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
