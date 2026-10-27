A table Purchases records user_id, time_stamp and amount. Given a start date, an end date and a minimum amount, count the distinct users who made at least one purchase within the date range the statement defines with an amount of at least the minimum. For instance, with a range covering only mid-March and a minimum of 1000, users with one 4523 purchase in range, one 678 purchase in range, and one big purchase in April → 1. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Filter, then count distinct

Using the column names the statement gives: take the date-range rule and parameters from it too.

1. `WHERE time_stamp` within the given range `AND amount ≥ minAmount`.
2. `SELECT COUNT(DISTINCT user_id)`.

Constructed check (run in SQLite, the example above, no purchase on a boundary): 1.

DISTINCT matters because one user can have several qualifying purchases. Follow the statement exactly on how the end date’s time of day is treated.

Time: O(n)  
Space: O(1)

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
