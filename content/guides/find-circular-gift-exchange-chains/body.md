One table records gifts: a giver, a receiver and a gift value. Find every loop of exchanges (A gives to B, B to C, …, back to A) and report each loop’s length and total gift value, numbered and ordered by length and then total, both descending. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Follow the gifts

This assumes each employee gives at most one gift, so a walk never branches; check the official statement.

Using the column names the statement gives:

1. Recursive CTE walk(start, cur, len, total, mn): start with every gift; extend with the gift whose giver = cur while cur ≠ start, capped at the row count.
2. Loops are rows with cur = start; keep those with start = mn.
3. `ROW_NUMBER() OVER (ORDER BY len DESC, total DESC)` as the chain number; order the same way. SQLite’s two-argument MIN is LEAST in MySQL.

Constructed check (run in SQLite): loops 1→2→3→1 (10, 20, 30), 4↔5 (50, 15), 10↔11 (40, 20) and the open path 6→7→8 → (1, 3, 60), (2, 2, 65), (3, 2, 60).

Keeping every loop row without the smallest-member filter: 7 rows instead of 3.

Time: O(n²) in the worst case  
Space: O(n²)

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
