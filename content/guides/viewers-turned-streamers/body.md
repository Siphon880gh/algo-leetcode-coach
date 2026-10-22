A table lists users’ sessions, each with a start time and a type, either viewer or streamer. For users whose first session was as a viewer, report how many streaming sessions they have. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## First row per user

Using the column names the statement gives:

1. CTE: `ROW_NUMBER() OVER (PARTITION BY user ORDER BY start)`.
2. Join sessions to the CTE rows with number 1 and viewer type; `WHERE type = streamer`, `GROUP BY user`, `COUNT(*)`, ordered as the statement asks.

This assumes users with no streaming session are left out. Check the statement.

Constructed check (run in SQLite): user 101 views, then streams twice; 102 streams, views, streams; 103 views, then streams once; 104 only views → 101 with 2 and 103 with 1.

Requiring only some viewer session also reports 102, whose first session was a stream.

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
