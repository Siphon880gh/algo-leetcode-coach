## Islands, then rank

```sql
WITH one AS (
    SELECT user_id, action_date
    FROM activity
    GROUP BY user_id, action_date
    HAVING COUNT(*) = 1
),
d AS (
    SELECT a.user_id, a.action, a.action_date,
           julianday(a.action_date)
             - ROW_NUMBER() OVER (PARTITION BY a.user_id, a.action ORDER BY a.action_date) AS grp
    FROM activity a
    JOIN one o ON o.user_id = a.user_id AND o.action_date = a.action_date
),
s AS (
    SELECT user_id, action, COUNT(*) AS streak_length,
           MIN(action_date) AS start_date, MAX(action_date) AS end_date
    FROM d
    GROUP BY user_id, action, grp
    HAVING COUNT(*) >= 5
),
r AS (
    SELECT *, ROW_NUMBER() OVER (
        PARTITION BY user_id
        ORDER BY streak_length DESC, action, start_date DESC) AS rk
    FROM s
)
SELECT user_id, action, streak_length, start_date, end_date
FROM r
WHERE rk = 1
ORDER BY streak_length DESC, user_id;
```

Example (run in SQLite) → user 3 view 7 (2024-01-01 to 2024-01-07), then user 1 login 5 (2024-01-01 to 2024-01-05). Checked against a direct scan on 300 random tables. In MySQL 8, compute the row number as rn in a subquery and group by DATE_SUB(action_date, INTERVAL rn DAY) instead of julianday(…) − rn.

Skipping the one-action-per-day filter: a made-up user with login on five straight days plus a click on day 3 is kept instead of dropped.

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
