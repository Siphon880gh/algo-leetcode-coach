A table logs calls, each with a time and a city. For each city, find the hour of the day with the most calls and report it with that number of calls; if several hours tie, report each of them. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count, then rank

Using the column names the statement gives:

1. CTE: `GROUP BY city, hour(call time)` with `COUNT(*)`.
2. `RANK() OVER (PARTITION BY city ORDER BY count DESC)`; keep rank 1, ordered as the statement asks.

Constructed check (run in SQLite): city A has calls at 8:15, 8:40, 9:10, 9:20 and 10:00; city B at 22:05, 22:55 and 7:00 → A at hours 8 and 9 (2 each), B at hour 22 (2).

`MAX(count)` per city alone gives the count but not the hour, and a `LIMIT 1` per city would drop A’s tie.

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
