A players table assigns each player to a group, and a matches table records two players and the points each scored. In every group, the winner is the player with the most total points across all their matches, with ties broken as the statement specifies (typically the lower player id). Report each group with its winner. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Unpivot, total, rank

Using the column names the statement gives:

```sql
WITH pts AS (
  SELECT first_player AS player_id, first_score AS score FROM Matches
  UNION ALL
  SELECT second_player, second_score FROM Matches
),
tot AS (
  SELECT p.group_id, p.player_id, COALESCE(SUM(t.score), 0) AS total
  FROM Players p
  LEFT JOIN pts t ON t.player_id = p.player_id
  GROUP BY p.group_id, p.player_id
)
SELECT group_id, player_id
FROM (SELECT tot.*,
             ROW_NUMBER() OVER (PARTITION BY group_id
                                ORDER BY total DESC, player_id) AS rn
      FROM tot) r
WHERE rn = 1;
```

Do not use `UNION`; it would merge two identical (player, score) rows. Do not use `RANK`; ties must resolve to one player. Adjust the tie-break in `ORDER BY` if the statement differs.

Time: O(n log n)  
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
