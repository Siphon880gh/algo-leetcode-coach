A table Rides records ride_id, driver_id and passenger_id. For every distinct driver id, return how many rides that same id took as a passenger, including 0. For instance, rides (7 drives 1), (7 drives 2), (11 drives 1), (11 drives 7) twice, (11 drives 3) → driver 7 was a passenger 2 times and driver 11 was a passenger 0 times. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Drivers on the passenger side

Using the column names the statement gives:

1. `d = SELECT DISTINCT driver_id FROM Rides`.
2. `d LEFT JOIN Rides r ON r.passenger_id = d.driver_id`.
3. `GROUP BY d.driver_id`; `COUNT(r.ride_id)`.

Constructed check (run in SQLite, the example above): (7, 2), (11, 0).

COUNT on a column of the right side ignores the NULL row, giving 0 instead of 1.

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
