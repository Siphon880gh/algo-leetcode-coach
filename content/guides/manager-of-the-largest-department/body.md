A table lists employees with their department and position. Find the department or departments with the most employees and report each one’s manager (the employee whose position marks them as the manager) with the department. The exact position value, names and ordering are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Count, max, join

Using the column names the statement gives:

1. CTE: `SELECT dep, COUNT(*) AS n … GROUP BY dep`.
2. Join employees to it, keep the manager rows with `n = (SELECT MAX(n) FROM cte)`, ordered as the statement asks.

Constructed check (run in SQLite): departments 1 and 2 have three employees each, department 3 has two → both managers of 1 and 2.

`ORDER BY n DESC LIMIT 1` keeps only one of the tied departments.

Time: O(n)  
Space: O(number of departments)

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
