One table lists user activities (sending or opening snaps) with the time spent; another gives each user’s age group. For each age group, report the percentage of total time spent on each activity type, rounded as the statement asks. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Conditional sums

Using the column names the statement gives:

1. Join activities to ages on the user.
2. Per age group: `100.0 * SUM(CASE WHEN type = <send> THEN time ELSE 0 END) / SUM(time)`, and the same for the other type, rounded as asked.

Constructed check (run in SQLite): group X spends 9.5 sending of 16 total → 59.38; group Y 6 of 9 → 66.67.

Weigh by time, not by row count: counting rows gives X → 50.0.

Time: O(n)  
Space: O(number of groups)

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
