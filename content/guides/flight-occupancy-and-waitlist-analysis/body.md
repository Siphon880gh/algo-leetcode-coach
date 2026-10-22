A flights table gives each flight’s capacity, and a passengers table records which flight each passenger booked. For each flight, report how many booked passengers get a seat and how many are on the waitlist, ordered as the statement says. The exact columns and output names are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Cap and overflow

Using the column names the statement gives:

1. Left join flights to passengers and count passengers per flight.
2. Seated = `LEAST(count, capacity)`; waitlisted = `GREATEST(count − capacity, 0)` (MIN and MAX with two arguments in SQLite).
3. Order the rows as the statement says.

Constructed check (run in SQLite): flight 1 with capacity 2 and three bookings, flight 2 with capacity 2 and one booking, flight 3 with capacity 1 and none → (2, 1), (1, 0), (0, 0).

An inner join drops flight 3 entirely. Count a passenger column, not `*`, so an empty flight counts 0 rather than 1.

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
