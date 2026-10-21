Given a customers table of ids, report the ids between 1 and the maximum present id that are missing from the table, ordered as the statement specifies (typically ascending). For instance, ids {1, 4, 5} → 2 and 3. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Number series

Using the column names the statement gives:

1. `WITH RECURSIVE seq(n) AS (SELECT 1 UNION ALL SELECT n + 1 FROM seq WHERE n < (SELECT MAX(id) FROM …))`.
2. `SELECT n FROM seq LEFT JOIN customers ON id = n WHERE id IS NULL ORDER BY n`.

Constructed check: ids {1, 4, 5} → 2, 3. Ids {1, 2} → no rows.

The maximum id is typically small; if not, watch the CTE recursion limit (1000 by default in MySQL). Do not compute gaps from adjacent ids only (that gives ranges, not each missing id).

Time: O(max id)  
Space: O(max id)

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
