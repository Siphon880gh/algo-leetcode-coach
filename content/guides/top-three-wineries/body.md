A table lists wineries’ entries, each with a country and points. For each country, report the top three wineries by total points, each shown with its points in the format the statement gives, breaking ties as it says and using its placeholder text when a country has fewer than three wineries. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Sum, number, pivot

Using the column names the statement gives:

1. CTE: `GROUP BY country, winery` with `SUM(points)`.
2. `ROW_NUMBER() OVER (PARTITION BY country ORDER BY total DESC, <tie-break from the statement>)`.
3. `GROUP BY country` with `MAX(CASE WHEN rn = 1 THEN <formatted winery> END)` and the same for 2 and 3, each wrapped in `COALESCE(…, <placeholder>)`, ordered as the statement asks.

This assumes a winery’s points are totalled over all its rows in a country, and that ties are broken by winery name, ascending. Check the statement for both.

Constructed check (run in SQLite): country P has Bel 90, Ama 85 + 50, Cor 70, Dal 70; Q has Eno 80; R has Fin 60, Gio 95 → P: Ama (135), Bel (90), Cor (70); Q: Eno (80) and two placeholders; R: Gio (95), Fin (60), one placeholder.

Ranking single rows instead of totals puts Bel first in P.

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
