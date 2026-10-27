A table lists events, each with a hall and a start day and end day. Within each hall, events that overlap are merged, and chains of overlapping events become one event. Return each hall’s merged events with their first and last days. For instance, one hall with events 1–5, 3–4 and 6–7 → 1–5 and 6–7. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Gaps and islands

Using the column names the statement gives:

1. Per hall, ordered by start day then end day, take `MAX(end)` over all earlier rows (`ROWS BETWEEN UNBOUNDED PRECEDING AND 1 PRECEDING`).
2. Flag a row 1 when that value is `NULL` or before its start day; a running `SUM` of the flag is the block number.
3. Group by hall and block; return `MIN(start)` and `MAX(end)`.

Constructed check (run in SQLite, and against a merge in code on 300 random tables): hall 1 with 1–5, 3–4, 6–7 and hall 2 with 2–3, 3–4 → (1, 1, 5), (1, 6, 7), (2, 2, 4).

Use the running maximum, not just the previous row’s end: a long event can cover several later short ones. Follow the statement’s definition of overlap; with a shared day counting, 1–3 and 3–5 merge, while 1–3 and 4–5 stay apart.

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
