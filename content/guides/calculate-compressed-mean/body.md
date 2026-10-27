Each row of a table says that some number of orders each had a given item count. Report the average number of items per order over all orders, rounded as the statement asks. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Weighted average

Using the column names the statement gives:

1. `SELECT ROUND(SUM(item_count * occurrences) * 1.0 / SUM(occurrences), 2)`, with the rounding the statement asks for.

Constructed check (run in SQLite): rows (1 item, 500 orders), (3, 100), (5, 20), (2, 380) → 1660 / 1000 = 1.66.

A plain `AVG(item_count)` gives 2.75 on the same rows. Multiply by 1.0 (or cast) so integer division does not truncate.

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
