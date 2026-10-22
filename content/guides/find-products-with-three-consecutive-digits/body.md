One table lists products with an id and a name. Return the products whose name contains a run of exactly three digits in a row (a longer run does not count), ordered by id. Table, column and output names are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Bounded run

This assumes a name counts when at least one of its digit runs is exactly three long; check the official statement.

Using the column names the statement gives:

1. Keep rows where `name REGEXP '(^|[^0-9])[0-9]{3}([^0-9]|$)'`.
2. Order by `id`.

Constructed check (run in SQLite with a REGEXP function added): names AB123, X12Y34, Z45678, NoDigits, 999Box, K1234M567 → ids 1, 5, 6.

Matching `[0-9]{3}` alone: also returns 3 (Z45678).

Time: O(total name length)  
Space: O(1)

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
