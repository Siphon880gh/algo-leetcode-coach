A table Teams lists team_name, one row per team. Every team plays every other team twice, once at home and once away. Report every match as its home team and away team, with the output names the statement gives, in any order. For instance, three teams produce six matches. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Every ordered pair

Using the column names the statement gives:

`SELECT t1.team_name AS ‹home›, t2.team_name AS ‹away› FROM Teams t1 JOIN Teams t2 ON t1.team_name <> t2.team_name`.

Constructed check (run in SQLite; teams A, B, C): 6 rows, (A, B), (A, C), (B, A), (B, C), (C, A), (C, B).

The inequality keeps both orders, which are the home and away legs, and drops a team playing itself. Using `<` instead would keep only one leg of each pairing.

Time: O(n²)  
Space: O(n²) for the output

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
