A flights table gives each flight’s capacity, and a passengers table records which flight each passenger booked and when. Seats go to the earliest bookings, up to the capacity; everyone else is waitlisted. Report each passenger’s status, ordered as the statement says. The exact columns, status labels and output names are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Rank within a flight

Using the column names the statement gives:

1. `rn = ROW_NUMBER() OVER (PARTITION BY flight ORDER BY booking time)`.
2. Join to flights; status is confirmed when `rn ≤ capacity`, else waitlisted (use the statement’s labels).
3. Order the rows as the statement says.

Constructed check (run in SQLite): flight 1 with capacity 2 and passengers 10, 11, 12 booked at times 3, 1, 2, and flight 2 with capacity 2 and passenger 13 → 11, 12 and 13 confirmed, 10 waitlisted.

Ranking by passenger id instead of booking time seats the wrong people: the check above → 10 and 11 confirmed, 12 waitlisted.

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
