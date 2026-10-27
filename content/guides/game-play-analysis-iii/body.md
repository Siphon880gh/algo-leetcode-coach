With the same per-player, per-date activity table, report for every row the player, the date, and the total games that player has played up to and including that date. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## A running sum per player

Using the column names the statement gives:

```sql
SELECT player_id, event_date,
       SUM(games_played) OVER (
           PARTITION BY player_id
           ORDER BY event_date
       ) AS games_played_so_far
FROM Activity;
```

`PARTITION BY player_id` restarts the sum for each player, and `ORDER BY event_date` makes the default frame "from the first row up to this one", which is a running total. Dates are unique per player, so ties do not matter.

Without window functions: join `Activity a` with `Activity b` on `a.player_id = b.player_id AND b.event_date <= a.event_date`, then `GROUP BY a.player_id, a.event_date` and `SUM(b.games_played)`.

Pandas: sort by `player_id, event_date`, then `groupby("player_id")["games_played"].cumsum()`.

Do not omit `ORDER BY` in the window — then every row gets the player's grand total. Do not omit `PARTITION BY` — the sum would run across players.

Time: O(n log n) for the sort inside the window  
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
