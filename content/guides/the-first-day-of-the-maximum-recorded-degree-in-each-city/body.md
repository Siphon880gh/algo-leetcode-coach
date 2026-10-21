A table Weather records city_id, day and degree, one row per city and day. For each city, report the day with the highest degree, the earliest such day on ties, together with that degree, ordered by city_id. For instance, a city whose highest reading of 37 occurs on two days reports the earlier day; a city with readings of −7 and −6 reports the −6 day. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Highest degree, earliest day

Using the column names the statement gives:

1. `rk = ROW_NUMBER() OVER (PARTITION BY city_id ORDER BY degree DESC, day)`.
2. `SELECT city_id, day, degree … WHERE rk = 1 ORDER BY city_id`.

Constructed check (run in SQLite; three cities including the two described above): (1, 2022-07-07, 24), (2, 2022-08-07, 37), (3, 2022-12-07, −6).

The second sort key settles ties; RANK over degree alone would return both tied days. Negative degrees need no special case.

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
