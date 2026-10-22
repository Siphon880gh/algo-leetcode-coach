A users table lists users and a rides table records each ride’s user and distance. Report every user with their total distance, using 0 for users with no rides, ordered as the statement says. The exact columns and output names are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Sum with a default

Using the column names the statement gives:

1. Left join users to rides on the user.
2. `COALESCE(SUM(distance), 0)` per user.
3. Order as the statement says.

Constructed check (run in SQLite): user 1 with rides of 10 and 5, user 2 with none, user 3 with one of 7 → 15, 0, 7.

Without COALESCE user 2 shows NULL; with an inner join user 2 disappears.

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
