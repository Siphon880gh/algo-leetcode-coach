A table lists teams with their wins, draws and losses. Compute each team’s points and rank the teams by points, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Window rank

This assumes 3 points for a win, 1 for a draw, tied teams sharing a rank, and ties listed by name; check the official statement.

Using the column names the statement gives:

1. `SELECT id, name, 3 * wins + draws AS points, RANK() OVER (ORDER BY 3 * wins + draws DESC) AS position FROM teams ORDER BY points DESC, name`

Constructed check (run in SQLite): Ash 3-1-0, Elm 2-4-0, Oak 1-0-3, Yew 3-0-1 → Ash 10 (1), Elm 10 (1), Yew 9 (3), Oak 3 (4).

ROW_NUMBER instead of RANK gives Ash and Elm different positions.

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
