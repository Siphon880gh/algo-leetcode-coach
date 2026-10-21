A countries table maps ids to names, and a weather table records a weather_state per country per day. For the month the statement names, classify each country by its average weather_state into the statement's labels: cold up to one cutoff, hot from a higher cutoff, warm otherwise. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Filter, group, CASE

Using the column names the statement gives:

```sql
-- @start_date / @end_date bound the month in the statement;
-- @cold / @hot are its cutoffs, and the labels follow its wording.
SELECT c.country_name,
       CASE WHEN AVG(w.weather_state) <= @cold THEN 'Cold'
            WHEN AVG(w.weather_state) >= @hot  THEN 'Hot'
            ELSE 'Warm' END AS weather_type
FROM Countries c
JOIN Weather w ON w.country_id = c.country_id
WHERE w.day BETWEEN @start_date AND @end_date
GROUP BY c.country_id, c.country_name;
```

For instance, with cutoffs 15 and 25, daily states `10, 20` average 15 → cold, and `24, 28` average 26 → hot.

Do not filter on the average in `WHERE`; aggregates belong in `CASE` or `HAVING`. Do not forget the month filter; other days would skew the average.

Time: O(n)  
Space: O(countries)

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
