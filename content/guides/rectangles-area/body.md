A points table gives each point's id and coordinates. For every pair of points treated as opposite corners of an axis-aligned rectangle with non-zero area, report the two ids and the area, ordered as the statement specifies. For instance, points (2, 7) and (4, 8) give area 2 · 1 = 2; points sharing an x or y give zero area and are excluded. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Pairs once each

Using the column names the statement gives:

1. `FROM Points p1 JOIN Points p2 ON p1.id < p2.id`.
2. `WHERE p1.x <> p2.x AND p1.y <> p2.y`.
3. `SELECT p1.id, p2.id, ABS(p1.x − p2.x) * ABS(p1.y − p2.y) AS area`, ordered as required.

Do not use `<>` on ids; each pair would appear twice. Do not filter on `area > 0` before computing it in dialects that cannot reference aliases in WHERE.

Time: O(n²)  
Space: O(n²) output

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
