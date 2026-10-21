A table TeamPoints lists each team_id, its name and its points, and a table PointsChange gives each team_id a points_change. Teams are ranked by points, highest first, with ties broken by name in alphabetical order. Return each team_id and name with rank_diff, its rank before the change minus its rank after. For instance, A 10, B 8, C 8 with changes −5, 0, +3 → A −2, B 0, C 2. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two orderings of the same rows

Using the column names the statement gives: take the ranking rule from it too.

1. `o = TeamPoints JOIN PointsChange USING (team_id)`, with `p1 = points + points_change`.
2. `r0 = ROW_NUMBER() OVER (ORDER BY points DESC, name)`, `r1 = ROW_NUMBER() OVER (ORDER BY p1 DESC, name)`.
3. Return `team_id, name, r0 − r1`.

Constructed check (run in SQLite, the example above): (1, A, −2), (2, B, 0), (3, C, 2).

The name tie-break gives every team its own position, which is exactly what ROW_NUMBER numbers.

Time: O(n log n)  
Space: O(n)

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
