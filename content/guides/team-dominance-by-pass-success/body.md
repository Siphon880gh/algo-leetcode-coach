Two tables list players with their team and timestamped passes from one player to another. For each team and each half of the match, score +1 for every pass to a teammate and −1 for every pass the other team receives. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Score each pass

This assumes times are zero-padded mm:ss strings and a pass at exactly 45:00 belongs to the first half; take the exact split from the official statement.

Using the column names the statement gives:

1. Join passes to teams twice: t1 on the passer, t2 on the receiver.
2. half = `CASE WHEN ts <= '45:00' THEN 1 ELSE 2 END`.
3. `SUM(CASE WHEN t2.team = t1.team THEN 1 ELSE -1 END)` grouped by t1.team and half; order by team, half.

Constructed check (run in SQLite): Lions (players 1, 2) and Tigers (3, 4) with 11 passes → Lions 1 and 3, Tigers 1 and 2 for halves 1 and 2.

Using `ts < '45:00'`: the Lions pass at 45:00 moves to half 2 → Lions 0 and 4.

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
