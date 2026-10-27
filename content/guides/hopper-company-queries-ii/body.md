Using the same drivers, rides and accepted-ride tables as Hopper Company Queries I, report for every month of 2020 the percentage of available drivers who accepted at least one ride that month, rounded as the statement specifies, with 0 when no driver is available. For instance, 2 available drivers and 1 working driver in a month give 50. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two counts per month

Using the column names the statement gives:

1. Recursive CTE for months 1 … 12.
2. `available(m)`: drivers whose join date ≤ the end of month `m` in 2020.
3. `working(m)`: `COUNT(DISTINCT driver)` over accepted rides requested in month `m` of 2020.
4. `percentage = ROUND(IF(available = 0, 0, 100 · working / available), 2)`.

Constructed check: drivers joined 2019-11 and 2020-01; in March one of them accepts two rides → March: 1 / 2 → 50.00.

Count distinct drivers, not rides. Do not divide by zero for months before anyone joined.

Time: O(12 · rows)  
Space: O(12)

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
