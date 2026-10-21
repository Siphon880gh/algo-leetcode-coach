A flights table lists a departure airport, an arrival airport and a flight count for that route. An airport's traffic is the total number of flights that depart from it or arrive at it. Report every airport with the largest traffic. For instance, routes 1 → 2 (4 flights), 2 → 1 (5) and 2 → 4 (5) give traffic 9, 14 and 5, so the answer is airport 2; with routes 1 → 2 (4), 2 → 1 (5), 3 → 4 (5), 4 → 3 (4) and 5 → 6 (7), airports 1, 2, 3 and 4 tie at 9. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count each route at both ends

Using the column names the statement gives:

1. `t` = `SELECT departure_airport AS a, flights_count AS f` UNION ALL `SELECT arrival_airport, flights_count`.
2. `s` = `SELECT a, SUM(f) AS tot FROM t GROUP BY a`.
3. `SELECT a FROM s WHERE tot = (SELECT MAX(tot) FROM s)`.

Constructed check (run in SQLite, the examples above): 2, then 1, 2, 3, 4.

UNION ALL keeps duplicate rows (two routes with the same count); plain UNION would drop them. Comparing to the maximum returns every tied airport.

Time: O(n log n)  
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
