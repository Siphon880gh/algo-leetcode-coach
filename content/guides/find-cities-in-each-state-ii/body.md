One table lists cities with their state. For each state with enough cities and at least one city starting with the same letter as the state, return the state, its cities joined into one string, and how many cities share the state’s first letter, ordered as the statement specifies. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Group and filter

This assumes a state needs at least 3 cities, cities are joined in alphabetical order with a comma and space, and results go by match count descending, then state; take the exact rules from the official statement.

Using the column names the statement gives:

1. Per state: `COUNT(*)`, `SUM(LEFT(city, 1) = LEFT(state, 1))` and the city names concatenated in order.
2. `HAVING COUNT(*) >= 3 AND matches >= 1`.
3. Order by matches descending, then state.

Constructed check (run in SQLite): Texas (Austin, Dallas, Temple, Tyler), Ohio (Akron, Dayton, Toledo), Utah (Ogden, Provo), Maine (Bath, Mars, Milo) → Maine 2, Texas 2.

Dropping the letter filter also returns Ohio with 0 matches.

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
