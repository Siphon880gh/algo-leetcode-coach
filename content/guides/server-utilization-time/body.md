A table logs when servers start and stop. Add up the time all servers were running and report the total in the unit and rounding the statement gives. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## LEAD per server

This assumes starts and stops alternate per server and the total is reported in whole days rounded down; check the official statement.

Using the column names the statement gives:

1. `LEAD(time) OVER (PARTITION BY server ORDER BY time)` as the next event.
2. Keep start rows; sum next − time in seconds.
3. Convert to the asked unit.

Constructed check (run in SQLite): server 1 runs 36 h and 18 h, server 2 runs 24 h → 78 h → 3 whole days.

Pair with the next stop only: joining every later stop gives 6 days.

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
