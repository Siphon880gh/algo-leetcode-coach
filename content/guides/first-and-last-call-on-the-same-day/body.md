A calls table records a caller, a recipient and a call time. Counting calls in both directions, report the ids of users whose first and last calls on at least one day were with the same person, as the statement specifies. For instance, with calls 8→4 and 4→8 on one day, a single call 5→1 on another, and on a third day 8→3, 11→3, 8→11: users 1, 4, 5 and 8 qualify (8 through the first day), while 3 and 11 do not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Earliest and latest per day

Using the column names the statement gives:

1. `a` = `(caller, recipient, time)` `UNION ALL` `(recipient, caller, time)`.
2. Per user and date: `ROW_NUMBER()` by time ascending (first) and descending (last).
3. Join first-call rows to last-call rows on user and date with the same other party; `SELECT DISTINCT` the user.

Constructed check (run in SQLite, the example above): 1, 4, 5, 8.

A single call that day is both first and last, so it qualifies. Group by calendar date, not by 24-hour windows.

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
