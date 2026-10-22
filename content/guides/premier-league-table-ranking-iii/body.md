One table holds each team’s season stats: wins, draws, losses, and goals for and against. For each team and season, return points, goal difference and the position within the season, ranked by points, then goal difference, then name, as the statement specifies. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Compute, then rank

This assumes 3 points per win and 1 per draw, and that equal points and goal difference fall back to name order; take the exact rules from the official statement.

Using the column names the statement gives:

1. `pts = 3 * w + d`, `gd = gf - ga`.
2. `ROW_NUMBER() OVER (PARTITION BY season ORDER BY pts DESC, gd DESC, name)`.
3. Order by season, position, name.

Constructed check (run in SQLite): season 1 Ash 3-1-0 (9:3), Elm 3-1-0 (8:2), Fir 2-4-0, Oak 1-0-3 → Ash 1, Elm 2, Fir 3, Oak 4.

Ranking by points alone gives Ash, Elm and Fir all position 1.

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
