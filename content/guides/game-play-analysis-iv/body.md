`Activity(player_id, device_id, event_date, games_played)`, primary key `(player_id, event_date)`. Report `fraction`: the number of players who logged in on the day immediately after their first login, divided by the number of players, rounded to 2 decimals. Sample: only player 1 returned the next day out of 3 players → 0.33.

## First date, then look one day later

```sql
SELECT ROUND(AVG(b.event_date IS NOT NULL), 2) AS fraction
FROM (
    SELECT player_id, MIN(event_date) AS event_date
    FROM Activity
    GROUP BY player_id
) AS a
LEFT JOIN Activity AS b
    ON a.player_id = b.player_id
   AND DATEDIFF(b.event_date, a.event_date) = 1;
```

The subquery is Game Play Analysis I (511). The left join keeps every player once (`(player_id, event_date)` is unique, so at most one match). `b.event_date IS NOT NULL` is 1 for a return and 0 otherwise, so its average is the fraction.

Equivalent: `COUNT(b.player_id) / COUNT(*)`, or a window `MIN(event_date) OVER (PARTITION BY player_id)` and count rows exactly one day after it.

Do not count players who returned on any later day — it must be the next day after the **first** login. Do not divide by the number of rows in `Activity`; divide by distinct players.

Time: O(n) with hashing  
Space: O(players)

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
