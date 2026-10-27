A teams table gives team ids and names; a matches table records the home and away team ids and each side's goals. Report per team the matches played, points (as the statement defines them, typically 3 for a win, 1 for a draw, 0 for a loss), goals for, goals against and goal difference, ordered as the statement specifies (typically by points, then goal difference, then name). For instance, with Ajax losing 0–1 to Dortmund, drawing 3–3 with Arsenal, losing 2–5 at Dortmund and drawing 0–0 at Arsenal, Ajax has 4 games, 2 points, 5 for, 9 against. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One row per team per match

Using the column names the statement gives:

1. `g` = `SELECT home id AS team, home goals AS gf, away goals AS ga UNION ALL SELECT away id, away goals, home goals`.
2. Join teams; `GROUP BY` team: `COUNT(*)`, `SUM(CASE WHEN gf > ga THEN 3 WHEN gf = ga THEN 1 ELSE 0 END)`, `SUM(gf)`, `SUM(ga)`, `SUM(gf) − SUM(ga)`.
3. Order as required.

Constructed check (run in SQLite, the example above): Dortmund (2 games, 6 points, 6–2, +4), Arsenal (2, 2, 3–3, 0), Ajax (4, 2, 5–9, −4).

Unpivoting once avoids writing every statistic twice. Use the point values the statement gives.

Time: O(matches log teams)  
Space: O(teams)

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
