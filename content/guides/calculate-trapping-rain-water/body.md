A table lists bar heights by position. Report the total amount of rain water trapped between the bars, as in the classic trapping-rain-water problem. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Two window maxima

Using the column names the statement gives:

1. l = `MAX(height) OVER (ORDER BY id ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW)`.
2. r = the same with `CURRENT ROW AND UNBOUNDED FOLLOWING`.
3. Return `SUM(MIN(l, r) − height)` (LEAST in MySQL).

Constructed check (run in SQLite): heights 0, 1, 0, 2, 1, 0, 1, 3, 2, 1, 2, 1 → 6; 4, 2, 0, 3, 2, 5 → 9.

Both sides matter: filling up to the overall maximum gives 22 instead of 6.

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
