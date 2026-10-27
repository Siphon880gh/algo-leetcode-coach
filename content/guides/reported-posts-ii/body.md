An actions table logs what users do to posts, including reports with a reason such as spam, and a removals table records which posts were removed and when. For each day, compute the percentage of posts reported as spam that day that were removed (at any time). Report the average of those daily percentages, rounded as the statement specifies. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two levels of averaging

Using the column names the statement gives:

```sql
WITH daily AS (
    SELECT a.action_date,
           100 * COUNT(DISTINCT r.post_id) / COUNT(DISTINCT a.post_id) AS pct
    FROM Actions a
    LEFT JOIN Removals r ON a.post_id = r.post_id
    WHERE a.action = 'report' AND a.extra = 'spam'
    GROUP BY a.action_date
)
SELECT ROUND(AVG(pct), 2) AS average_daily_percent
FROM daily;
```

The left join keeps reported posts that were never removed, and `COUNT(DISTINCT r.post_id)` ignores their nulls.

Do not compute one overall ratio across all days; the question asks for the average of daily percentages. Count distinct posts, since a post can be reported several times.

Time: O(n) with hashing  
Space: O(days + posts)

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
