A table lists coordinate pairs (X, Y); rows may repeat. Two rows are symmetric when one’s X equals the other’s Y and one’s Y equals the other’s X. Report each symmetric coordinate once, as the one with X ≤ Y. Column names, the output columns and the ordering are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Self-join with row identity

Using the column names the statement gives:

1. Number the rows (for example with ROW_NUMBER) so equal rows stay distinct.
2. Join a to b on `a.X = b.Y AND a.Y = b.X AND a.id <> b.id`.
3. `SELECT DISTINCT a.X, a.Y … WHERE a.X <= a.Y`, ordered as the statement asks.

This assumes a point on the diagonal needs a second copy of itself to count.

Constructed check (run in SQLite): rows (20, 20), (20, 20), (20, 21), (23, 22), (22, 23), (21, 20), (5, 5), (1, 9) → (20, 20), (20, 21), (22, 23). Without the row identity (5, 5) wrongly matches itself.

Time: O(n²) worst case for the join  
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
