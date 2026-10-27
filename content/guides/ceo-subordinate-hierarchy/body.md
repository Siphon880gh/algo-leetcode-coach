A table lists employees with their manager and salary; the CEO has no manager. For every employee under the CEO, directly or indirectly, report how many levels below the CEO they are and how their salary compares with the CEO’s, as the statement defines. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Walk down the tree

This assumes direct reports are level 1 and the comparison is employee salary − CEO salary; check the official statement.

Using the column names the statement gives:

1. `WITH RECURSIVE h AS (SELECT id, 0 AS lvl, salary FROM emp WHERE mgr IS NULL UNION ALL SELECT e.id, h.lvl + 1, e.salary FROM emp e JOIN h ON e.mgr = h.id)`.
2. Select rows with lvl > 0 and salary − (the CEO’s salary).

Constructed check (run in SQLite): CEO 1 earns 200; 2 and 3 report to 1, 4 to 2, 5 to 4 → (2, 1, −80), (3, 1, −100), (4, 2, −110), (5, 3, −140).

Joining only on mgr = CEO returns just 2 and 3.

Time: O(n) rows through the recursion  
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
