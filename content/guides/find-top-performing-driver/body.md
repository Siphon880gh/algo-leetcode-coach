Three tables describe drivers (each with an accident count), vehicles (each with its driver and fuel type) and trips (each with its vehicle, distance and rating). For each fuel type, return the top-performing driver by average trip rating, rounded as the statement says, with ties broken as the statement specifies. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Aggregate, then rank

This assumes ties go to the larger total distance, then to fewer accidents; take the exact order and rounding from the official statement.

Using the column names the statement gives:

1. `s`: per fuel and driver, `ROUND(AVG(rating), 2)` and `SUM(dist)` from vehicles joined to trips.
2. Join drivers; `ROW_NUMBER() OVER (PARTITION BY fuel ORDER BY avg_rating DESC, total DESC, accidents)`.
3. Return rank 1, ordered by fuel.

Constructed check (run in SQLite): on fuel g, driver 1 (2 accidents) and driver 2 (1 accident) both average 4.5 with distances 150 and 100; on fuel e, drivers 1 and 3 tie on rating and distance → (e, 3, 3.0), (g, 1, 4.5).

Skipping the distance tie-break picks driver 2 for g.

Time: O(n log n)  
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
