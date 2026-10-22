A table lists employees’ shifts with start and end date-times. For each employee, report the largest number of shifts that overlap at one time and the total overlap time between pairs of shifts, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Events and pairs

This assumes overlap is measured in minutes, ends sort before starts at equal times, and that the statement’s other overlap rules (such as dates) are added to the join; check the official statement.

Using the column names the statement gives:

1. Events: starts as +1 and ends as −1. `SUM(d) OVER (PARTITION BY emp ORDER BY t, d ROWS UNBOUNDED PRECEDING)`; take the MAX per employee.
2. Pairs: `a LEFT JOIN b ON a.emp = b.emp AND a.st < b.st AND a.en > b.st`; sum LEAST(a.en, b.en) − b.st in minutes.

Constructed check (run in SQLite): employee 1 works 09–17, 15–23, 16–20; employee 2 works 09–12, 13–15 → (1: 3, 420), (2: 1, 0).

Taking each employee’s shift count as the maximum overlap gives employee 2 a 2.

Time: O(n log n + k²) per employee  
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
