A terms table lists a power and a factor for each term of a polynomial (one row per power). Build the equation as a single string: the terms in descending order of power, each written as a sign, the absolute factor, and X with its power in the format the statement gives (special forms for powers 1 and 0), followed by =0. For instance, with a sample format, powers 2, 1, 0 with factors 1, −4, 2 → +1X^2-4X+2=0, and powers 4, 2, 1 with factors −4, 1, −1 → -4X^4+1X^2-1X=0. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Term strings, then an ordered concatenation

Using the column names the statement gives: take the term format from it too.

1. Term: `CASE WHEN factor > 0 THEN '+' ELSE '-' END` ‖ `ABS(factor)` ‖ `CASE power WHEN 0 THEN '' WHEN 1 THEN 'X' ELSE 'X^' ‖ power END`.
2. `GROUP_CONCAT(term ORDER BY power DESC SEPARATOR '')` (MySQL) ‖ `'=0'`.

Constructed check (run in SQLite, the sample format above): `+1X^2-4X+2=0` and `-4X^4+1X^2-1X=0`.

The sign is written even for the first term, and the order must come from power, not from the table. In SQLite, order a subquery and then GROUP_CONCAT it.

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
