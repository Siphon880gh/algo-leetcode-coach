Using the same two tables as Team Dominance by Pass Success, find for each team its longest run of consecutive passes, in time order, that reach a teammate. A pass received by the other team ends the run. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Islands between interceptions

This assumes teams with no successful pass are left out; check the official statement.

Using the column names the statement gives:

1. ok = 1 when the receiver’s team equals the passer’s team, else 0.
2. grp = `SUM(1 - ok) OVER (PARTITION BY team ORDER BY ts)`.
3. Count rows with ok = 1 per (team, grp); take the maximum per team; order by team.

Constructed check (run in SQLite): the same Lions and Tigers data as the dominance guide → Lions 4, Tigers 3.

Counting every successful pass per team: Lions 5, Tigers 4.

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
