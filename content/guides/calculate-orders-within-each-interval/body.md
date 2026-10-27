A table records how many orders were placed in each minute. Split the minutes into consecutive intervals of a fixed length given in the official statement, numbered from 1, and report each interval’s number with its total orders, ordered by interval number. The table, column and output names, and the interval length, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Group by interval

Using the column names the statement gives:

This assumes minutes start at 1.

1. Interval number = `(minute + L − 1) / L` with integer division.
2. `GROUP BY` it, `SUM` the order counts, `ORDER BY` the interval number.

Constructed check (run in SQLite) with L = 6: minutes 1–12 with counts 4, 7, 3, 6, 2, 5, 1, 4, 7, 3, 6, 2 → (1, 27), (2, 23).

Plain `minute / L` puts minute 6 in the next interval and starts at 0: three groups (0, 22), (1, 26), (2, 2).

Time: O(n)  
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
