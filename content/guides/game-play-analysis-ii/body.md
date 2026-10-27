An activity table has one row per player per login date, with the device used and the number of games played. Report each player with the device of their first login. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Find the date, then the row

Using the column names the statement gives:

```sql
SELECT player_id, device_id
FROM Activity
WHERE (player_id, event_date) IN (
    SELECT player_id, MIN(event_date)
    FROM Activity
    GROUP BY player_id
);
```

The subquery is Game Play Analysis I (511). Because `(player_id, event_date)` is unique, each player matches exactly one row.

Window version: `RANK() OVER (PARTITION BY player_id ORDER BY event_date) AS rk` in a subquery, then `WHERE rk = 1`. A join on `player_id` and the min date works too.

Do not write `SELECT player_id, device_id, MIN(event_date) ... GROUP BY player_id` — `device_id` is not from the minimum row (MySQL may pick any row or reject it).

Time: O(n) with hashing (O(n log n) with sorting for the window)  
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
