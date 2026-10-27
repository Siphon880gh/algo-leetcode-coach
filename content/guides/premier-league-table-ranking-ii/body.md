A table lists teams with their wins, draws and losses. Compute each team’s points and position, and place each team in one of three tiers by position, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Rank, then tier

This assumes 3 points for a win and 1 for a draw, tied teams sharing a position, and tiers cut at the first and second thirds of the positions, with tied teams staying together in the higher tier; check the official statement for the exact cut-offs.

Using the column names the statement gives:

1. `WITH p AS (SELECT name, 3 * wins + draws AS pts, RANK() OVER (ORDER BY 3 * wins + draws DESC) AS pos, COUNT(*) OVER () AS n FROM teams)`.
2. `SELECT name, pts, pos, CASE WHEN pos <= n / 3.0 THEN 1 WHEN pos <= 2 * n / 3.0 THEN 2 ELSE 3 END FROM p ORDER BY pts DESC, name`

Constructed check (run in SQLite): Ash 10, Elm 10, Yew 9, Bay 6, Oak 3, Fir 2 → positions 1, 1, 3, 4, 5, 6 and tiers 1, 1, 2, 2, 3, 3. Because tied teams share a position, they land in the same tier.

ROW_NUMBER instead of RANK gives Elm position 2 although it ties Ash.

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
