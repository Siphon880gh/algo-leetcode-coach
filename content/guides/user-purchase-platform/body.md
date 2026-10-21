A spending table records, for each user and date, the platform used (mobile or desktop) and the amount spent. For each date, report the total amount and the number of users in each of three groups: those who used only mobile that day, only desktop, or both. Every date must show all three groups, with zeros where a group is empty. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Per user-day first, then a complete grid

Using the column names the statement gives:

```sql
WITH user_day AS (
    SELECT spend_date, user_id,
           CASE WHEN COUNT(DISTINCT platform) = 2 THEN 'both' ELSE MAX(platform) END AS platform,
           SUM(amount) AS amount
    FROM Spending
    GROUP BY spend_date, user_id
),
grid AS (
    SELECT DISTINCT s.spend_date, p.platform
    FROM Spending s
    CROSS JOIN (SELECT 'desktop' AS platform UNION ALL SELECT 'mobile' UNION ALL SELECT 'both') p
)
SELECT g.spend_date, g.platform,
       COALESCE(SUM(u.amount), 0) AS total_amount,
       COUNT(u.user_id) AS total_users
FROM grid g
LEFT JOIN user_day u
  ON u.spend_date = g.spend_date AND u.platform = g.platform
GROUP BY g.spend_date, g.platform;
```

A user who used both platforms on a date counts once, in the both group, with the sum of both amounts.

Do not group by platform directly; a both-platform user would be counted in two groups. Do not skip the grid; dates where a group has no users must still show a zero row.

Time: O(n) with hashing  
Space: O(n)

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
