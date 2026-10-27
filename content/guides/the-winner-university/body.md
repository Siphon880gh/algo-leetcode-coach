Two tables, one per university (New York and California), list student ids and exam scores. A student is excellent when the score reaches a threshold the statement gives. Report the university with more excellent students, or that there is no winner when the counts are equal. For instance, with a sample threshold of 90, New York scores 90, 87 and California scores 89, 95, 91 → California University; dropping the 91 makes it a tie. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Compare two scalar counts

Using the column names the statement gives: take the threshold and output strings from it too.

1. `n = (SELECT COUNT(*) FROM NewYork WHERE score ≥ threshold)`, `c` likewise for California.
2. `CASE WHEN n > c THEN New York WHEN c > n THEN California ELSE no winner END`.

Constructed check (run in SQLite, the example above): California University, then No Winner after the tie.

Scalar subqueries avoid joining the two tables, which would multiply rows.

Time: O(n + m)  
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
