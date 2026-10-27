A table lists students with their scores on several assignments. Report the difference between the highest and the lowest total score, where a student’s total is the sum of their assignment scores. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One aggregate

Using the column names the statement gives:

1. `SELECT MAX(a1 + a2 + a3) − MIN(a1 + a2 + a3)` over the table.

Constructed check (run in SQLite): totals 240, 240, 150 and 150 from rows (90, 80, 70), (60, 95, 85), (50, 40, 60), (100, 20, 30) → 90.

The difference is between totals: the highest single score minus the lowest single score gives 80 here.

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
