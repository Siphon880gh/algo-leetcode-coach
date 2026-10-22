A table lists people, each with an id, a name and a profession. For every person, return the id together with a label made of the name followed by the first letter of the profession in parentheses; the column names and row order are in the official statement. For instance, Alex the Singer → Alex(S). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## CONCAT and LEFT

Using the column names the statement gives:

1. Select the id and `CONCAT(name, '(', LEFT(profession, 1), ')')` under the output name the statement shows.
2. Apply the `ORDER BY` the statement asks for.

Constructed check (run in SQLite, using `||` and `substr`): Alex the Singer, Bob the Player and Alice the Actor → Alex(S), Bob(P), Alice(A).

No join or grouping is needed. Watch the exact format: no space before the parenthesis, and only one letter of the profession.

Time: O(n log n) for the ordering  
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
