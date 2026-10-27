Tables list calls (a contact, a call type, a duration) and contacts with names. For each call type, report the longest calls (as many as the statement asks) with the contact’s name and the duration in the format the statement gives. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Window ranking

This assumes durations are stored in seconds and shown as HH:MM:SS; check the official statement.

Using the column names the statement gives:

1. `ROW_NUMBER() OVER (PARTITION BY type ORDER BY duration DESC)`.
2. Keep ranks up to the asked count; join contacts for the name.
3. Format: hours = duration / 3600, minutes = duration % 3600 / 60, seconds = duration % 60, each two digits.

Constructed check (run in SQLite, top 3): incoming → 02:00:00, 01:02:05, 00:10:00; outgoing → 01:06:40, 00:00:45, 00:00:10.

Rank per type: a single overall ranking drops the shorter outgoing calls.

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
