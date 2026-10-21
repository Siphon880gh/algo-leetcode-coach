A sessions table records each session's duration. Report how many sessions fall into each of a fixed set of duration bins (labels and boundaries as the statement specifies), including bins with zero sessions. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## One SELECT per bin

Using the column names the statement gives:

1. Convert the duration to the unit the bins use (for instance, seconds to minutes).
2. For each bin: `SELECT '<label>' AS bin, SUM(CASE WHEN <in range> THEN 1 ELSE 0 END) AS total FROM Sessions`.
3. `UNION ALL` the bin rows.

Do not `GROUP BY` a computed bin label alone; bins with no sessions would disappear. Watch half-open boundaries so a value on an edge lands in exactly one bin.

Time: O(bins · rows)  
Space: O(bins)

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
