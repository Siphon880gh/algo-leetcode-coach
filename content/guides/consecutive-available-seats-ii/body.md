A table lists cinema seats and whether each one is free. Report the longest run (or runs) of consecutive free seats: where each run starts, where it ends and how long it is. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Gaps and islands

This assumes seat ids are consecutive integers and that every tied longest run is reported; check the official statement.

Using the column names the statement gives:

1. Over free seats: `seat_id - ROW_NUMBER() OVER (ORDER BY seat_id)` as the run key.
2. Group by the key: `MIN`, `MAX` and `COUNT(*)`.
3. Keep the runs whose count equals the maximum; order as asked.

Constructed check (run in SQLite): free seats 1, 3–5, 7–9 and 11–12 → runs 3–5 and 7–9, length 3.

Without the key you get one row, 1–12 with 9 seats; `ORDER BY ... LIMIT 1` drops the tied run 7–9.

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
