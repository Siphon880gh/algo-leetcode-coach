One table lists employees with a salary and a department. Return the employees who earn the second-highest salary in their department, including every employee tied at that salary. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Dense rank

This assumes second-highest means the second distinct salary level in the department; take the exact rule from the official statement.

Using the column names the statement gives:

1. `DENSE_RANK() OVER (PARTITION BY dept ORDER BY salary DESC)`.
2. Keep rank 2; order as the statement asks.

Constructed check (run in SQLite): A has 50, 40, 40, 30 (ids 1–4), B has 60, 60, 20 (ids 5–7), C has 70 (id 8) → ids 2 and 3 from A, 7 from B.

ROW_NUMBER instead picks id 6 in B (a top earner) and drops id 3.

Time: O(n log n)  
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
