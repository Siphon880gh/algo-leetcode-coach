A traffic table logs user activities, logins among them, with dates, and may contain duplicate rows. For each date in a recent window that ends on a fixed reference date (the statement gives both; the window is roughly the last 90 days), report how many users had their first-ever login on that date. Dates with no new users are omitted. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## First login over all history

Using the column names the statement gives:

```sql
-- @ref_date and @window_days stand for the reference date and window length in the statement.
SELECT login_date, COUNT(*) AS user_count
FROM (
    SELECT user_id, MIN(activity_date) AS login_date
    FROM Traffic
    WHERE activity = 'login'
    GROUP BY user_id
) first_login
WHERE login_date >= DATE_SUB(@ref_date, INTERVAL @window_days DAY)
GROUP BY login_date;
```

The window filter goes outside the subquery: a user who first logged in long ago and again recently is not new.

Do not filter dates inside the subquery; that turns old users into new ones. Do not count logins; count users by their first login only.

Time: O(n) with hashing  
Space: O(users)

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
