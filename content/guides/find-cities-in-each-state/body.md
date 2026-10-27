A table lists cities and the state each is in. For each state, report its cities as one list in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Group and concatenate

This assumes cities are listed alphabetically and joined with a comma and a space; check the official statement for the separator and the ordering.

Using the column names the statement gives:

1. `SELECT state, GROUP_CONCAT(city ORDER BY city SEPARATOR ', ') FROM cities GROUP BY state ORDER BY state` (MySQL).
2. Without ORDER BY inside the aggregate, concatenate from a subquery sorted by state and city.

Constructed check (run in SQLite, via the sorted subquery): Texas has Houston, Austin, Dallas and Ohio has Dayton, Akron → Ohio: Akron, Dayton; Texas: Austin, Dallas, Houston.

Grouping by state and city returns one row per city.

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
