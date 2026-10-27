A table lists user sessions with a start time, an end time and a session type. Report the users who have two sessions of the same type where the later one starts within the time window the statement gives after the earlier one ends. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## LAG per user and type

Using the column names the statement gives:

1. `LAG(session_end) OVER (PARTITION BY user_id, session_type ORDER BY session_start)` as pe.
2. Keep users with a row where the start minus pe is within the window; return distinct users, ordered as asked.

This assumes the gap is measured from the earlier end to the later start, as restated above.

Constructed check (run in SQLite, 12-hour window): user 101 has type V at 08:00–09:00 and 15:00–16:00; user 102 has V a day apart; user 103 has V then S three hours later → only 101.

Partition by type too: comparing with any previous session also returns 103.

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
