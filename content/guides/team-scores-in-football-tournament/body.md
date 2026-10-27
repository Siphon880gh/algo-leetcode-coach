A teams table lists team ids and names, and a matches table records a host team, a guest team, and each side's goals. A win and a draw earn points as the statement specifies (typically 3 and 1). Report every team with its total points, including teams with none, sorted as the statement specifies (typically by points descending, then team id). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Score both sides

Using the column names the statement gives:

```sql
SELECT t.team_id, t.team_name,
       COALESCE(SUM(CASE
         WHEN m.host_team = t.team_id AND m.host_goals > m.guest_goals THEN 3
         WHEN m.guest_team = t.team_id AND m.guest_goals > m.host_goals THEN 3
         WHEN m.host_goals = m.guest_goals THEN 1
         ELSE 0 END), 0) AS num_points
FROM Teams t
LEFT JOIN Matches m
  ON t.team_id IN (m.host_team, m.guest_team)
GROUP BY t.team_id, t.team_name
ORDER BY num_points DESC, t.team_id;
```

Adjust the point values and the sort to match the statement.

Do not join only on the host column; teams earn points as guests too. Do not use an inner join; teams that never played must appear with 0.

Time: O(teams · matches) for the join, or O(n log n) with a union of both sides  
Space: O(teams)

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
