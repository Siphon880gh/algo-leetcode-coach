A table lists chemical elements, each with a symbol and a type, where the types include metals and nonmetals. Return every pair of one metal and one nonmetal. For instance, metals Na and Ca with nonmetals Cl and N give four pairs. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Self cross join

Using the column names the statement gives:

1. Take the rows whose type is the metal value, and separately the rows whose type is the nonmetal value.
2. `CROSS JOIN` the two sets, or join with both filters in the `ON` clause.
3. Return the metal symbol and the nonmetal symbol for each pair.

Constructed check (run in SQLite, with Na and Ca as metals, Cl and N as nonmetals, and He of another type): (Na, Cl), (Na, N), (Ca, Cl), (Ca, N); He appears in none.

Use the exact type strings the statement shows. Elements of any other type drop out of both sides.

Time: O(metals · nonmetals)  
Space: O(1) beyond the output

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
