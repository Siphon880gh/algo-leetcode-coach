## One GROUP BY

```sql
SELECT session_id, user_id,
       CAST(ROUND((julianday(MAX(event_timestamp)) - julianday(MIN(event_timestamp))) * 1440) AS INTEGER) AS session_duration_minutes,
       SUM(CASE WHEN event_type = 'scroll' THEN 1 ELSE 0 END) AS scroll_count
FROM app_events
GROUP BY session_id, user_id
HAVING (julianday(MAX(event_timestamp)) - julianday(MIN(event_timestamp))) * 1440 > 30
   AND SUM(CASE WHEN event_type = 'scroll' THEN 1 ELSE 0 END) >= 5
   AND 1.0 * SUM(CASE WHEN event_type = 'click' THEN 1 ELSE 0 END) / SUM(CASE WHEN event_type = 'scroll' THEN 1 ELSE 0 END) < 0.2
   AND SUM(CASE WHEN event_type = 'purchase' THEN 1 ELSE 0 END) = 0
ORDER BY scroll_count DESC, session_id;
```

Example (run in SQLite) → S001, 201, 35, 6. In MySQL, use TIMESTAMPDIFF(MINUTE, MIN(event_timestamp), MAX(event_timestamp)) for the duration.

Using ≤ 0.20 for the ratio: S003 (1 / 5 = 0.20) is added.

Time: O(rows)  
Space: O(sessions)

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
