A confirmations table records each confirmation request with a user id, a timestamp and an action (a signups table also exists). Report the ids of users who requested two confirmation messages within 24 hours of each other (boundary handling as the statement specifies), using the column name it gives. For instance, user 3 requesting at 03:30 and 15:00 on the same day qualifies, as does user 2 requesting at 00:00 and 23:00; user 7 requesting two days apart does not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Pairs inside the window

Using the column names the statement gives:

1. `a JOIN b ON same user AND b.time > a.time`.
2. Keep pairs with `b.time − a.time` within 24 hours (`TIMESTAMPDIFF(SECOND, …) <= 86400` in MySQL), matching the statement's boundary rule.
3. `SELECT DISTINCT` the user.

Constructed check (run in SQLite with `julianday`, the example above): users 2 and 3.

Window version: `LEAD(time) OVER (PARTITION BY user ORDER BY time)`; the closest pair is always consecutive. Compare in seconds, not dates, or 23:00 to 01:00 the next day would look like a day apart.

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
