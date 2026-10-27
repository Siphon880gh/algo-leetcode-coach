`Activity(player_id, device_id, event_date, games_played)` with primary key `(player_id, event_date)`. Report `player_id` and `first_login`, the earliest `event_date` for each player. Any order. Sample: player 1 logged in 2016-03-01 and 2016-05-02 → 2016-03-01; player 2 → 2017-06-25; player 3 → 2016-03-02.

## One group per player

```sql
SELECT player_id, MIN(event_date) AS first_login
FROM Activity
GROUP BY player_id;
```

`GROUP BY player_id` makes one output row per player, and `MIN` picks the earliest date in each group. Dates compare in time order.

Pandas: `activity.groupby("player_id").agg(first_login=("event_date", "min")).reset_index()`.

Game Play Analysis II (512) needs the device at that first date, which `MIN` alone cannot give.

Do not `ORDER BY event_date LIMIT 1` — that returns one row for the whole table. Do not select `device_id` beside `MIN` — it is not tied to the minimum row.

Time: O(n) with hash grouping  
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
