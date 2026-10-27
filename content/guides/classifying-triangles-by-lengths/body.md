A table lists three side lengths per row. Classify each row as equilateral, isosceles, scalene, or not a triangle, using the labels the statement gives. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Ordered CASE

Using the column names the statement gives:

1. `CASE WHEN A + B <= C OR A + C <= B OR B + C <= A THEN <not a triangle> WHEN A = B AND B = C THEN <equilateral> WHEN A = B OR B = C OR A = C THEN <isosceles> ELSE <scalene> END`.

Constructed check (run in SQLite): (20, 20, 20), (20, 20, 23), (20, 21, 22), (13, 14, 30), (2, 2, 5) → equilateral, isosceles, scalene, not a triangle, not a triangle.

CASE stops at the first true branch, so the order matters: testing equal sides first labels (2, 2, 5) isosceles.

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
