## Two CTEs

```sql
WITH last_event AS (
    SELECT user_id, event_type, plan_name, monthly_amount,
           ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY event_date DESC, event_id DESC) AS rn
    FROM subscription_events
),
history AS (
    SELECT user_id,
           MAX(monthly_amount) AS max_historical_amount,
           SUM(CASE WHEN event_type = 'downgrade' THEN 1 ELSE 0 END) AS downgrades,
           CAST(julianday(MAX(event_date)) - julianday(MIN(event_date)) AS INTEGER) AS days_as_subscriber
    FROM subscription_events
    GROUP BY user_id
)
SELECT l.user_id, l.plan_name AS current_plan, l.monthly_amount AS current_monthly_amount,
       h.max_historical_amount, h.days_as_subscriber
FROM last_event l
JOIN history h ON h.user_id = l.user_id
WHERE l.event_type <> 'cancel'
  AND l.rn = 1
  AND h.downgrades >= 1
  AND l.monthly_amount < 0.5 * h.max_historical_amount
  AND h.days_as_subscriber >= 60
ORDER BY h.days_as_subscriber DESC, l.user_id;
```

Example (run in SQLite) → 501 (basic, 9.99, 29.99, 79), 502 (basic, 9.99, 29.99, 70). In MySQL, use DATEDIFF(MAX(event_date), MIN(event_date)) for the days.

Not excluding users whose last event is cancel: 504 is added.

Time: O(rows log rows)  
Space: O(rows)

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
