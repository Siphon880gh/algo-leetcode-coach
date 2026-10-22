A purchases table records, for each purchase, a user, an item, a date and an amount, and it may contain duplicate rows. A user is active when they made a purchase within 7 days of another of their purchases. Return the active users in any order. Whether duplicate rows count as separate purchases, and the exact window boundary, are in the official statement. For instance, purchases on May 31 and June 7 count as within 7 days, while May 1 and May 20 do not. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## LEAD over dates

Using the column names the statement gives:

1. Over each user’s rows ordered by date, take the next date with `LEAD`.
2. Keep rows where the next date minus this date is at most 7 days.
3. Return the distinct users.

Constructed check (run in SQLite): a user buying on May 31 and June 7 is active; one buying on May 1 and May 20 is not; one buying on May 1, May 9 and May 12 is active through the last two.

Comparing only neighbours is enough: if any two purchases are within 7 days, two adjacent ones are too. Duplicates decide a corner case: a user whose only near pair is one duplicated row qualifies when rows are compared directly and does not when you take distinct dates first, so follow the statement.

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
